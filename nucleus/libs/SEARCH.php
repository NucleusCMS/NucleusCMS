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

    function  boolean_sql_select($field){
        if (!strlen($this->inclusive) ) return false;
        
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
       $keywords = explode(' ',$this->inclusive);
       foreach ($keywords as $keyword) {
           if(strlen($keyword) >= $min_word_len) {
               $stringsum_long .=  " $keyword ";
           } else {
               $stringsum_a[] = ' ' . $this->boolean_sql_select_short($keyword,$field) . ' ';
           }
       }

       if(strlen($stringsum_long)>0) {
            $stringsum_long = sql_quote_string($stringsum_long);
            $stringsum_a[] = " match ($field) against ($stringsum_long) ";
       }

       $stringsum = join('+', $stringsum_a);

       return $stringsum;
    }

    

    function boolean_inclusive_atoms($string) {
        
        $keywords = $this->_prepare($string);
        
        /* strip exlusive atoms */
        $pattern = "#\-\([A-Za-z0-9]{1,}[A-Za-z0-9\-\.\_\,]{0,}\)#";
        $keywords = preg_replace($pattern, '', $keywords);
        
        $keywords = str_replace(array('(', ')', ','), ' ', $keywords);

        return $keywords;
    }

    function boolean_sql_where($field) {
        $result = $this->marked;

        $this->boolean_sql_where_cb1($field); // set the static $field

        $result = preg_replace_callback(
           "/foo\[\(\'([^\)]{4,})\'\)\]bar/",
            array($this,'boolean_sql_where_cb1'),
            $result);

        $this->boolean_sql_where_cb2($field); // set the static $field

        return preg_replace_callback(
            "/foo\[\(\'([^\)]{1,3})\'\)\]bar/", array($this,'boolean_sql_where_cb2'), $result);
    }

    function boolean_sql_where_cb1($fields) {
        static $field;
        if (!is_array($fields))
            $field = $fields; // set $field mode
        else
            return sprintf(' match (%s) against (%s) > 0 ', $field, sql_quote_string($fields[1]));
    }

    function boolean_sql_where_cb2($fields) {
        static $field;
        if (!is_array($fields))
            $field = $fields; // set $field mode
        else
            return sprintf(' (%s) ', $this->boolean_sql_where_short($fields[1], $field));
    }

    function boolean_mark_atoms($string){
        
        $keywords = $this->_prepare($string);

        // strip excessive whitespace
        $keywords = str_replace(array('( ', ' )'), array('(', ')'), $keywords);

        // apply arbitrary function to all 'word' atoms
        $keywords_array = preg_split('/ +/', $keywords);

        foreach($keywords_array as $keyword) {
            $keywords_a[] = sprintf("foo[('%s')]bar", $keyword);
        }

        $keywords = str_replace(array(' ', ',', ' -'), array(' AND ',' OR ',' NOT '), join(' ', $keywords_a));
        
        return $keywords;
    }

    function _prepare($string) {
        $keywords = preg_replace("/([[:space:]]{2,})/", ' ', trim($string));
        
        /* convert normal boolean operators to shortened syntax */
        $keywords = preg_replace('/ *not */i', ' -', $keywords);
        $keywords = preg_replace('/ *and */i', ' ', $keywords);
        $keywords = preg_replace('/ *or */i', ',', $keywords);
        
        $keywords = preg_replace('/ *, */', ',', $keywords);
        $keywords = str_replace('- ', '-', $keywords);
        $keywords = str_replace('+', '', $keywords);
        
        return trim($keywords);
    }
    
    function boolean_sql_where_short($string,$field) {
        $fields = explode(',',$field);
        $string = sql_real_escape_string($string);
        $like_a = array();
        foreach($fields as $field){
            $like_a[] = " $field LIKE '% $string %' ";
        }
        $like = join(' OR ',$like_a);

        return $like;
    }

    protected function boolean_sql_select_short($string, $field) {
        $fields = explode(',',$field);
        $ph['score_unit_weight'] = .2;
        $score_a = array();
        foreach($fields as $field){
            $ph['field']  = sql_real_escape_string($field);
            $ph['string'] = sql_quote_string($string);
            $tpl = " <%score_unit_weight%>*(LENGTH(<%field%>) - LENGTH(REPLACE(LOWER(<%field%>), LOWER(<%string%>), '')))/LENGTH(<%string%>) ";
            $score_a[] = parseText($tpl, $ph);
        }
        $score = join(' + ',$score_a);

        return $score;
    }
}
