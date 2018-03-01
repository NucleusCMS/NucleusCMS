<?php

/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 *
 * SEARCH(querystring) offers different functionality to create an
 * SQL query to find certain items. (and comments)
 *
 * based on code by David Altherr:
 * http://www.evolt.org/article/Boolean_Fulltext_Searching_with_PHP_and_MySQL/18/15665/
 * http://davidaltherr.net/web/php_functions/boolean/funcs.mysql.boolean.txt
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group
 */

class SEARCH {

    public $querystring;
    public $marked;
    public $inclusive;
    public $blogs;

    public function SEARCH($text) { $this->__construct($text); }
    function __construct($text) {
        global $blogid;

        $text = preg_replace ("/[<,>,=,?,!,#,^,(,),[,\],:,;,\\\,%]/",'',$text);

        $this->querystring = $text;
        $this->marked      = $this->boolean_mark_atoms($text);
        $this->inclusive   = $this->boolean_inclusive_atoms($text);
        $this->blogs       = array();

        // get all public searchable blogs, no matter what, include the current blog allways.
        $res = sql_query( parseQuery('SELECT bnumber FROM <%prefix%>blog WHERE bincludesearch=1') );
        while ($obj = sql_fetch_object($res)) {
            $this->blogs[] = intval($obj->bnumber);
        }
    }

    function  boolean_sql_select($match){
        if (strlen($this->inclusive) > 0) {
            $min_word_len = 4;
            $Engine = '';
            $res = sql_query( parseQuery("SHOW TABLE STATUS LIKE '<%prefix%>blog'") );
            if ($res && (($row = sql_fetch_assoc($res)) !== FALSE))
                $Engine = $row['Engine'];
            $v = '';
            if ($Engine == 'MyISAM')
                $v = 'ft_min_word_len';
            if ($Engine == 'InnoDB')
                $min_word_len = 3;
            if ($v)
            {
               $res = sql_query("SHOW VARIABLES LIKE 'ft_min_word_len'");
               if ($res && (($row = sql_fetch_assoc($res)) !== FALSE))
                 $min_word_len = max($row['Value'], 1);
            }

           $stringsum_long = '';
           /* build sql for determining score for each record */
           $result = explode(" ",$this->inclusive);
           for($cth=0; $cth<count($result); $cth++) {
               if(strlen($result[$cth]) >= $min_word_len) {
                   $stringsum_long .=  " $result[$cth] ";
               } else {
                   $stringsum_a[] = ' '.$this->boolean_sql_select_short($result[$cth],$match).' ';
               }
           }

           if(strlen($stringsum_long)>0) {
                $stringsum_long = sql_quote_string($stringsum_long);
                $stringsum_a[] = " match ($match) against ($stringsum_long) ";
           }

           $stringsum = join('+', $stringsum_a);

           return $stringsum;
        }
    }

    

    function boolean_inclusive_atoms($string) {
        $result = trim($string);
        $result = preg_replace("#([[:space:]]{2,})#", ' ', $result);
        
        # just added delimiters to regex and the 'i' for case-insensitive matching
        
        /* convert normal boolean operators to shortened syntax */
        $result = str_ireplace(' not ', ' -', $result);
        $result = str_ireplace(' and ', ' ', $result);
        $result = str_ireplace(' or ', ',', $result);
        
        /* drop unnecessary spaces */
        $result = str_replace(' ,', ',', $result);
        $result = str_replace(', ', ',', $result);
        $result = str_replace('- ', '-', $result);
        $result = str_replace('+', '', $result);
        
        /* strip exlusive atoms */
        $pattern = "#\-\([A-Za-z0-9]{1,}[A-Za-z0-9\-\.\_\,]{0,}\)#";
        $result = preg_replace($pattern, '', $result);
        
        $result = str_replace('(', ' ', $result);
        $result = str_replace(')', ' ', $result);
        $result = str_replace(',', ' ', $result);

        return $result;
    }

    function boolean_sql_where($match) {
        $result = $this->marked;

        $this->boolean_sql_where_cb1($match); // set the static $match

        $result = preg_replace_callback(
           "/foo\[\(\'([^\)]{4,})\'\)\]bar/",
            array($this,'boolean_sql_where_cb1'),
            $result);

        $this->boolean_sql_where_cb2($match); // set the static $match

        $result = preg_replace_callback(
            "/foo\[\(\'([^\)]{1,3})\'\)\]bar/",
            array($this,'boolean_sql_where_cb2'),
            $result);

        return $result;
    }

    function boolean_sql_where_cb1($matches) {
        static $match;
        if (!is_array($matches))
            $match = $matches; // set $match mode
        else
            return sprintf(" match (%s) against (%s) > 0 ", $match, sql_quote_string($matches[1]));
    }

    function boolean_sql_where_cb2($matches) {
        static $match;
        if (!is_array($matches))
            $match = $matches; // set $match mode
        else
            return sprintf(" (%s) ", $this->boolean_sql_where_short(sql_real_escape_string($matches[1]), $match));
    }

    function boolean_mark_atoms($string){
        $result = trim($string);
        $result = preg_replace("/([[:space:]]{2,})/",' ',$result);

        # just added delimiters to regex and the 'i' for case-insensitive matching

        $result = str_ireplace(' not i', ' -', $result);
        $result = str_ireplace(' and ', ' ', $result);
        $result = str_ireplace(' or ', ',', $result);

        // strip excessive whitespace
        $result = str_replace('( ', '(', $result);
        $result = str_replace(' )', ')', $result);
        $result = str_replace(', ', ',', $result);
        $result = str_replace(' ,', ',', $result);
        $result = str_replace('- ', '-', $result);
        $result = str_replace('+', '', $result);

        // remove double spaces (we might have introduced some new ones above)
        $result = trim($result);
        $result = preg_replace("#([[:space:]]{2,})#", ' ', $result);

        // apply arbitrary function to all 'word' atoms

        $result_a = explode(' ', $result);

        for($word = 0;$word<count($result_a);$word++)
        {
            $result_a[$word] = "foo[('" . $result_a[$word] . "')]bar";
        }

        $result = join(' ', $result_a);

        // dispatch ' ' to ' AND '
        $result = str_replace(' ', ' AND ', $result);

        // dispatch ',' to ' OR '
        $result = str_replace(',', ' OR ', $result);

        // dispatch '-' to ' NOT '
        $result = str_replace(' -', ' NOT ', $result);
        return $result;
    }

    function boolean_sql_where_short($string,$match) {
        $match_a = explode(',',$match);
        for($ith=0;$ith<count($match_a);$ith++){
            $like_a[$ith] = " $match_a[$ith] LIKE '% $string %' ";
        }
        $like = join(' OR ',$like_a);

        return $like;
    }

    protected function boolean_sql_select_short($string, $match) {
        $match_a = explode(',',$match);
        $score_unit_weight = .2;
        for($ith=0;$ith<count($match_a);$ith++){
            $score_a[$ith] =
                           " $score_unit_weight*(
                           LENGTH(" . sql_real_escape_string($match_a[$ith]) . ") -
                           LENGTH(REPLACE(LOWER(" . sql_real_escape_string($match_a[$ith]) . "),LOWER(" . sql_quote_string($string) . "),'')))
                           /LENGTH(" . sql_quote_string($string) . ") ";
        }
        $score = join(' + ',$score_a);

        return $score;
    }
}
