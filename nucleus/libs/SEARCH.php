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

    public $fields;
    public $keywords;

    public function SEARCH($keywords) { $this->__construct($keywords); }
    
    public function __construct($keywords) {
        $this->field    = 'ititle,ibody,imore';
        $this->keywords = $this->_prepare($keywords);
    }

    private function _prepare($keywords) {
        
        $chars = explode(' ', '+ * / ] [ < > = ? ! # ^ ( ) : ; \\ %');
        $keywords = str_replace ($chars, ' ', $keywords);
        
        $keywords = preg_replace('/(  +)/', ' ', trim($keywords));
        $keywords = str_ireplace(' not ', ' -', $keywords);
        $keywords = str_replace('- ', '-',      $keywords);
        $keywords = str_ireplace(' and ', ' +', $keywords);
        $keywords = str_replace('+ ', '+',      $keywords);
        $keywords = str_ireplace(' or ', ' |',   $keywords);
        $keywords = str_replace('| ', '|',     $keywords);
        
        return trim($keywords, ', ');
    }
    
    public function get_blogs() {
        $res = sql_query( parseQuery('SELECT bnumber FROM <%prefix%>blog WHERE bincludesearch=1') );
        $blogs = array();
        while ($obj = sql_fetch_object($res)) {
            $blogs[] = (int)$obj->bnumber;
        }
        return $blogs;
    }
    
    public function set($key, $value) {
        $this->$key = $value;
    }
    
    public function  get_score($fields=''){
        
        if ($fields) $this->fields = $fields;
        
        $keywords = explode(' ', $this->keywords);
        $long_keywords = array();
        foreach($keywords as $keyword) {
            if($this->is_long_word($keyword)) {
                $long_keywords[] = $this->add_boolean($keyword);
            }
            elseif(substr($keyword,0,1)!=='-') {
                $score[] = sprintf(' %s ', $this->score_for_like_phrase($keyword));
            }
        }
        if($long_keywords) {
            $ph['field']    = $this->fields;
            $ph['keywords'] = sql_quote_string(ltrim(join(' ', $long_keywords),'+'));
            $ph['like_score'] = join(' + ',$score);
            return parseQuery('<%like_score%> + match (<%field%>) against (<%keywords%> IN BOOLEAN MODE) ', $ph);
        }
    }

    private function is_long_word($keyword) {
        return ($this->get_min_word_len() <= strlen(trim($keyword,'-+| ')));
    }
    
    private function add_boolean($keyword) {
        $c = substr($keyword,0,1);
        if(in_array($c,array('+','-'))) return $keyword;
        elseif($c==='|')                return ltrim($keyword,'|');
        else                            return '+'.$keyword;
    }
    
    public function get_min_word_len() {
        
        $res = sql_query( parseQuery("SHOW TABLE STATUS LIKE '<%prefix%>item'") );
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
    
    public function remove_boolean_operators() {
        
        $keywords =  explode(' ', $this->keywords);
        foreach($keywords as $i=>$keyword) {
            $keywords[$i] = ltrim($keyword,'-+|');
        }
        return join(' ', $keywords);
    }
    
    public function get_where_phrase($fields='') {
        
        if ($fields) $this->fields = $fields;
        
        $keywords = explode(' ',$this->keywords);
        $long_keywords  = array();
        $short_keywords = array();
        foreach($keywords as $keyword) {
            if($this->is_long_word($keyword)) {
                $long_keywords[] = $this->add_boolean($keyword);
            }
            else  $short_keywords[] = $keyword;
        }
        $_ = array();
        if($long_keywords) $_[] = $this->get_ft_phrase(ltrim(join(' ', $long_keywords),'+'));
        if($short_keywords) {
            foreach($short_keywords as $keyword) {
                $c = substr($keyword,0,1);
                $like_phrase = $this->get_like_phrase($keyword);
                if(!$_)         $_[] = $like_phrase;
                elseif($c=='|') $_[] = 'OR' .  $like_phrase;
                else            $_[] = 'AND' . $like_phrase;
            }
        }
        return join(' ', $_);
    }

    private function get_ft_phrase($long_keywords) {
        $ph['field']    = $this->fields;
        $ph['keywords'] = sql_quote_string($long_keywords);
        return parseQuery(' match (<%field%>) against (<%keywords%> IN BOOLEAN MODE) > 0 ', $ph);
    }

    private function get_like_phrase($keyword) {
        $c = substr($keyword,0,1);
        
        $like = array();
        $fields = explode(',',$this->fields);
        $ph['keyword'] = sql_real_escape_string(ltrim($keyword,'-+|'));
        foreach($fields as $field){
            $ph['field'] = $field;
            if($c==='-') $like[] = parseQuery(" <%field%> NOT LIKE '%<%keyword%>%' ", $ph);
            else         $like[] = parseQuery(" <%field%> LIKE '%<%keyword%>%' ", $ph);
        }
        
        if($c==='-') $ph['likes'] = join(' AND ',$like);
        else         $ph['likes'] = join(' OR ',$like);
        
        return parseQuery(' (<%likes%>) ', $ph);
    }

    private function score_for_like_phrase($keyword) {
        
        $fields = explode(',',$this->fields);
        $score = array();
        $tpl = " 0.2*(LENGTH(<%field%>) - LENGTH(REPLACE(LOWER(<%field%>), LOWER(<%keyword%>), '')))/LENGTH(<%keyword%>) ";
        $ph['keyword'] = sql_quote_string($keyword);
        foreach($fields as $field){
            $ph['field']   = $field;
            $score[] = parseQuery($tpl, $ph);
        }
        return join(' + ', $score);
    }
}
