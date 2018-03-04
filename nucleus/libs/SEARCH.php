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

    public $highlight;
    public $fields;
    public $keywords;
    public $min_word_len;

    public function SEARCH($keywords) { $this->__construct($keywords); }
    
    public function __construct($keywords) {
        global $blogid;

        $this->field = 'ititle,ibody,imore';
        
        $this->min_word_len = $this->get_min_word_len();
        
        $keywords = preg_replace ("/[<,>,=,?,!,#,^,(,),[,\],:,;,\\\,%]/",'',$keywords);
        $this->keywords = $this->_prepare($keywords);
        $this->highlight = $this->get_highlight_words();
    }

    public function get_blogs() {
        // get all public searchable blogs, no matter what, include the current blog allways.
        $res = sql_query( parseQuery('SELECT bnumber FROM <%prefix%>blog WHERE bincludesearch=1') );
        $blogs = array();
        while ($obj = sql_fetch_object($res)) {
            $bnumber = (int)$obj->bnumber;
            $blogs[$bnumber] = $bnumber;
        }
        return $blogs;
    }
    
    public function set($key, $value) {
        $this->$key = $value;
    }
    
    public function  get_score($fields=''){
        
        if (!strlen($this->highlight) ) return false;
        
        if ($fields) $this->fields = $fields;
        
        preg_match_all('/([\-\+a-zA-Z0-9]+)/', $this->keywords, $keywords);
        $m_against_stmt = array();
        foreach($keywords[1] as $keyword) {
            if(preg_match('@[0-9a-zA-Z\-\+]+@',$keyword) && $this->min_word_len <= strlen(trim($keyword,'-+ '))) {
                $m_against_stmt[] = $keyword;
            }
            if(substr($keyword,0,1)!=='-') {
                $score[] = sprintf(' %s ', $this->score_for_short_str($keyword));
            }
        }
        if($m_against_stmt) {
            $ph['field']    = $this->fields;
            $ph['keywords'] = sql_quote_string(join(' ', $m_against_stmt));
            $ph['score2'] = join(' + ',$score);
            return parseQuery('<%score2%> + match (<%field%>) against (<%keywords%> IN BOOLEAN MODE) ', $ph);
        }
    }

    public function get_min_word_len() {
        
        $res = sql_query( parseQuery("SHOW TABLE STATUS LIKE '<%prefix%>blog'") );
        if (!$res) return 4;
        
        $row = sql_fetch_assoc($res);
        if ($row['Engine'] == 'InnoDB') {
            return 3;
        }
        elseif ($row['Engine'] == 'MyISAM') {
            $rs = sql_query("SHOW VARIABLES LIKE 'ft_min_word_len'");
            $row = sql_fetch_assoc($res);
            if ($row) {
                return max($row['Value'], 1);
            }
        }
        
        return 4;
    }
    
    public function get_highlight_words() {
        
        /* strip exlusive atoms */
        $keywords =  explode(' ', $this->keywords);
        foreach($keywords as $i=>$keyword) {
            $keywords[$i] = ltrim($keyword,'-+');
        }

        return join(' ', $keywords);
    }
    
    public function _prepare($keywords) {
        $keywords = preg_replace("/(  +)/", ' ', trim($keywords));
        
        /* convert normal boolean operators to shortened syntax */
        $keywords = preg_replace('/ *not */i', ' -', $keywords);
        $keywords = preg_replace('/ *and */i', ' +', $keywords);
        $keywords = preg_replace('/ *or */i', ' ', $keywords);
        
        $keywords = preg_replace('/ *, */', ',', $keywords);
        
        return trim($keywords);
    }
    
    public function boolean_sql_where($fields='') {
        
        if ($fields) $this->fields = $fields;
        
        preg_match_all('/([^ ]+)/', $this->keywords, $keywords);
        $m_against_stmt = array();
        $like_stmt      = array();
        foreach($keywords[1] as $keyword) {
            if(preg_match('@[0-9a-zA-Z\-\+]+@',$keyword) && $this->min_word_len <= strlen(trim($keyword,'-+ '))) {
                $m_against_stmt[] = $keyword;
            }
            else  $like_stmt[]    = $keyword;
        }
        $_ = array();
        if($m_against_stmt) $_[] = $this->get_against_stmt(join(' ', $m_against_stmt));
        if($like_stmt) {
            foreach($like_stmt as $keyword) {
                $_[] = $this->get_like_stmt($keyword);
            }
        }
        return join(' AND ', $_);
    }

    public function get_against_stmt($keyword) {
        $ph['field']    = $this->fields;
        $ph['keywords'] = sql_quote_string($keyword);
        return parseQuery(' match (<%field%>) against (<%keywords%> IN BOOLEAN MODE) > 0 ', $ph);
    }

    function get_like_stmt($keyword) {
        $ph['like'] = $this->boolean_sql_where_short($keyword);
        return parseQuery(' (<%like%>) ', $ph);
    }

    public function boolean_sql_where_short($keyword) {
        
        $isNotLike = (substr($keyword,0,1)==='-');
        
        $keyword = ltrim($keyword,'-+');
        
        $fields = explode(',',$this->fields);
        $ph['keyword'] = sql_real_escape_string($keyword);
        $like = array();
        foreach($fields as $field){
            $ph['field'] = $field;
            if($isNotLike)
                $like[] = parseQuery(" <%field%> NOT LIKE '%<%keyword%>%' ", $ph);
            else
                $like[] = parseQuery(" <%field%> LIKE '%<%keyword%>%' ", $ph);
        }
        
        if($isNotLike) {
            return join(' AND ',$like);
        }
        
        return join(' OR ',$like);
    }

    protected function score_for_short_str($keyword) {
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
