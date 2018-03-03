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

    public $marked;
    public $inclusive;
    public $blogs;
    public $fields;

    public function SEARCH($keywords) { $this->__construct($keywords); }
    
    public function __construct($keywords) {
        global $blogid;

        $keywords = preg_replace ("/[<,>,=,?,!,#,^,(,),[,\],:,;,\\\,%]/",'',$keywords);

        $this->field     = 'ititle,ibody,imore';
        
        $this->marked    = $this->boolean_mark_atoms($keywords);
        $this->inclusive = $this->boolean_inclusive_atoms($keywords);
        $this->blogs     = array();

        // get all public searchable blogs, no matter what, include the current blog allways.
        $res = sql_query( parseQuery('SELECT bnumber FROM <%prefix%>blog WHERE bincludesearch=1') );
        while ($obj = sql_fetch_object($res)) {
            $this->blogs[] = intval($obj->bnumber);
        }
    }

    public function set($key, $value) {
        $this->$key = $value;
    }
    
    public function  boolean_sql_select($fields=''){
        
        if (!strlen($this->inclusive) ) return false;
        
        if ($fields) $this->fields = $fields;
        
        $min_word_len = $this->get_min_word_len();
        
        $stringsum_long = '';
        /* build sql for determining score for each record */
        $keywords = explode(' ',$this->inclusive);
        foreach ($keywords as $keyword) {
            if($min_word_len <= strlen($keyword)) {
                $stringsum_long .=  sprintf(' %s ', $keyword);
            } else {
                $stringsum_a[] = sprintf(' %s ', $this->boolean_sql_select_short($keyword));
            }
        }
        
        if(strlen($stringsum_long)>0) {
            $stringsum_long = sql_quote_string($stringsum_long);
            $stringsum_a[] = sprintf(' match (%s) against (%s) ', $this->fields, $stringsum_long);
        }
        return join('+', $stringsum_a);
    }

    public function get_min_word_len() {
        $res = sql_query( parseQuery("SHOW TABLE STATUS LIKE '<%prefix%>blog'") );
        $min_word_len = 4;
        if ($res) {
            $row = sql_fetch_assoc($res);
            if ($row['Engine'] == 'InnoDB') {
                $min_word_len = 3;
            }
            elseif ($row['Engine'] == 'MyISAM') {
               $rs = sql_query("SHOW VARIABLES LIKE 'ft_min_word_len'");
               $row = sql_fetch_assoc($res);
               if ($row) $min_word_len = max($row['Value'], 1);
            }
        }
        return $min_word_len;
    }
    
    public function boolean_mark_atoms($keywords){
        
        $keywords = $this->_prepare($keywords);

        // strip excessive whitespace
        $keywords = str_replace(array('( ', ' )'), array('(', ')'), $keywords);

        // apply arbitrary function to all 'word' atoms
        $keywords_array = preg_split('/ +/', $keywords);

        foreach($keywords_array as $keyword) {
            $_[] = sprintf("#foo#%s#bar#", $keyword);
        }

        $keywords = str_replace(array(' ', ',', ' -'), array(' AND ',' OR ',' NOT '), join(' ', $_) );
        
        return $keywords;
    }

    public function boolean_inclusive_atoms($string) {
        
        $keywords = $this->_prepare($string);
        
        /* strip exlusive atoms */
        $keywords = preg_replace("#\-\([A-Za-z0-9]{1,}[A-Za-z0-9\-\.\_\,]{0,}\)#", '', $keywords);
        $keywords = str_replace(array('(', ')', ','), ' ', $keywords);

        return $keywords;
    }

    public function _prepare($keywords) {
        $keywords = preg_replace("/([[:space:]]{2,})/", ' ', trim($keywords));
        
        /* convert normal boolean operators to shortened syntax */
        $keywords = preg_replace('/ *not */i', ' -', $keywords);
        $keywords = preg_replace('/ *and */i', ' ', $keywords);
        $keywords = preg_replace('/ *or */i', ',', $keywords);
        
        $keywords = preg_replace('/ *, */', ',', $keywords);
        $keywords = str_replace('- ', '-', $keywords);
        $keywords = str_replace('+', '', $keywords);
        
        return trim($keywords);
    }
    
    public function boolean_sql_where($fields='') {
        
        if ($fields) $this->fields = $fields;
        
        $result = preg_replace_callback("/#foo#(.{4,})#bar#/", array($this,'boolean_sql_where_cb1'), $this->marked);
        
        return preg_replace_callback(
            "/#foo#(.{1,3})#bar#/", array($this,'boolean_sql_where_cb2'), $result);
    }

    public function boolean_sql_where_cb1($keyword) {
        $ph['field']    = $this->fields;
        $ph['keywords'] = sql_quote_string($keyword[1]);
        return parseQuery(' match (<%field%>) against (<%keywords%>) > 0 ', $ph);
    }

    function boolean_sql_where_cb2($keyword) {
        $ph['like'] = $this->boolean_sql_where_short($keyword[1]);
        return parseQuery(' (<%like%>) ', $ph);
    }

    public function boolean_sql_where_short($keyword) {
        $fields = explode(',',$this->fields);
        $ph['keyword'] = sql_real_escape_string($keyword);
        $like = array();
        foreach($fields as $field){
            $ph['field'] = $field;
            $like[] = parseQuery(" <%field%> LIKE '% <%keyword%> %' ", $ph);
        }
        return join(' OR ',$like);
    }

    protected function boolean_sql_select_short($keyword) {
        $fields = explode(',',$this->fields);
        $ph['score_unit_weight'] = .2;
        $score = array();
        $tpl = " <%score_unit_weight%>*(LENGTH(<%field%>) - LENGTH(REPLACE(LOWER(<%field%>), LOWER(<%keyword%>), '')))/LENGTH(<%keyword%>) ";
        foreach($fields as $field){
            $ph['field']   = sql_real_escape_string($field);
            $ph['keyword'] = sql_quote_string($keyword);
            $score[] = parseQuery($tpl, $ph);
        }
        
        return join(' + ', $score);
    }
}
