<?php

class SEARCH_JA extends SEARCH {
    public function SEARCH($text) { $this->__construct($text); }
    public function SEARCH_JA($text) { $this->__construct($text); }
    function __construct($text) {
        global $blogid;

        $this->encoding = strtolower(preg_replace('|[^a-z0-9-_]|i', '', _CHARSET));
        if ($this->encoding != 'utf-8') {
            $text = mb_convert_encoding($text, "UTF-8", $this->encoding);
        }
        $text = str_replace ("\xE3\x80\x80",' ',$text);
        $text = preg_replace ("/[<>=?!#^()[\]:;\\%]/",'',$text);

        $this->ascii  = '[\x00-\x7F]';
        $this->two    = '[\xC0-\xDF][\x80-\xBF]';
        $this->three  = '[\xE0-\xEF][\x80-\xBF][\x80-\xBF]';

        $this->marked = $this->boolean_mark_atoms($text);
        /* * * * * * * * * * * * * * * * */

        $this->querystring    = $text;
        $this->inclusive    = $this->boolean_inclusive_atoms($text);
        $this->blogs        = array();

        // get all public searchable blogs, no matter what, include the current blog allways.
        $res = sql_query( parseQuery('SELECT bnumber FROM <%prefix%>blog WHERE bincludesearch=1') );
        while ($obj = sql_fetch_object($res)) {
            $this->blogs[] = intval($obj->bnumber);
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
        $pattern = "#\-\(([A-Za-z0-9]|$this->two|$this->three){1,}([A-Za-z0-9\-\.\_\,]|$this->two|$this->three){0,}\)#";
        $result = preg_replace($pattern, '', $result);
        
        $result = str_replace('(', ' ', $result);
        $result = str_replace(')', ' ', $result);
        $result = str_replace(',', ' ', $result);
        if ($this->encoding != 'utf-8') {
            $result = mb_convert_encoding($result, $this->encoding, "UTF-8");
        }

        return $result;
    }

    function boolean_sql_where($match) {
        $result = $this->marked;
        $result = $this->boolean_sql_where_short($result, $match);
        if ($this->encoding != 'utf-8') {
            $result = mb_convert_encoding($result, $this->encoding, 'UTF-8');
        }
        return $result;
    }

/***********************************************
    Make "WHERE"
***********************************************/

    function boolean_mark_atoms($string) {
        $result = trim($string);
        $result = preg_replace("/([[:space:]]{2,})/", ' ', $result);

        /* convert normal boolean operators to shortened syntax */
        $result = str_ireplace(' not ', ' -', $result);
        $result = str_ireplace(' and ', ' ',  $result);
        $result = str_ireplace(' or ',  ',',  $result);

        /* strip excessive whitespace */
        $result = str_replace(', ', ',',  $result);
        $result = str_replace(' ,', ',',  $result);
        $result = str_replace('- ', '-',  $result);
        $result = str_replace('+',  '',   $result);
        $result = str_replace(',',  ' ,', $result);

        return $result;
}

    function boolean_sql_where_short($string, $match) {
        $match_a = explode(',', $match);
        $key_a   = explode(' ', $string);

        $total = count($match_a);
        for ($ith=0; $ith<$total; $ith++) {
            $binKey = preg_match('/[a-zA-Z]/', $key_a[0]) ? '' : 'BINARY';
            $temp_a[$ith] = "(i.$match_a[$ith] LIKE " . $binKey . " '%" . sql_real_escape_string($key_a[0]) . "%') ";
        }
        $like = '('.join(' or ',$temp_a).')';

        for ($kn = 1; $kn < count($key_a); $kn++) {
            $binKey	   = preg_match('/[a-zA-Z]/', $key_a[$kn]) ? '' : 'BINARY';
            if (substr($key_a[$kn], 0, 1) == ",") {
                for($ith = 0; $ith < count($match_a); $ith++) {
                    $temp_a[$ith] = " (i.$match_a[$ith] LIKE " . $binKey . " '%" . sql_real_escape_string(substr($key_a[$kn], 1)) . "%') ";
                }
                $like .=' OR ('. join(' or ', $temp_a).')';
            }elseif(substr($key_a[$kn],0,1) != '-'){
                for($ith=0;$ith<count($match_a);$ith++){
                    $temp_a[$ith] = " (i.$match_a[$ith] LIKE " . $binKey . " '%" . sql_real_escape_string($key_a[$kn]) . "%') ";
                }
                $like .=' AND ('. join(' or ', $temp_a).')';
            }else{
                for($ith=0;$ith<count($match_a);$ith++){
                    $temp_a[$ith] = " NOT(i.$match_a[$ith] LIKE " . $binKey . " '%" . sql_real_escape_string(substr($key_a[$kn], 1)) . "%') ";
                }
                $like .=' AND ('. join(' and ', $temp_a).')';
            }
        }

        $like = '('.$like.')';
        return $like;
    }
}
