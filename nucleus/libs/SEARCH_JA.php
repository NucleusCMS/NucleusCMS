<?php

class SEARCH_JA extends SEARCH {
    public function SEARCH($text) { $this->__construct($text); }
    function __construct($text) {
        global $blogid;

        $this->encoding = strtolower(preg_replace('|[^a-z0-9-_]|i', '', _CHARSET));
        if ($this->encoding != 'utf-8') {
            $text = mb_convert_encoding($text, 'UTF-8', $this->encoding);
        }
        $text = str_replace ("\xE3\x80\x80",' ',$text);
        $text = preg_replace ("/[<>=?!#^()[\]:;\\%]/",'',$text);

        $this->ascii  = '[\x00-\x7F]';
        $this->two    = '[\xC0-\xDF][\x80-\xBF]';
        $this->three  = '[\xE0-\xEF][\x80-\xBF][\x80-\xBF]';

        $this->marked = $this->boolean_mark_atoms($text);

        $this->querystring  = $text;
        $this->inclusive    = $this->boolean_inclusive_atoms($text);
        $this->blogs        = array();

        // get all public searchable blogs, no matter what, include the current blog allways.
        $res = sql_query( parseQuery('SELECT bnumber FROM <%prefix%>blog WHERE bincludesearch=1') );
        while ($obj = sql_fetch_object($res)) {
            $this->blogs[] = intval($obj->bnumber);
        }
    }

    function boolean_inclusive_atoms($string) {
        $result = $this->boolean_mark_atoms($string);
        
        /* strip exlusive atoms */
        $pattern = "#\-\(([A-Za-z0-9]|$this->two|$this->three){1,}([A-Za-z0-9\-\.\_\,]|$this->two|$this->three){0,}\)#";
        $result = preg_replace($pattern, '', $result);
        
        $result = str_replace(array('(', ')', ','), ' ', $result);
        if ($this->encoding != 'utf-8') {
            $result = mb_convert_encoding($result, $this->encoding, 'UTF-8');
        }

        return $result;
    }

    function boolean_sql_where($field) {
        $result = $this->marked;
        $result = $this->boolean_sql_where_short($result, $field);
        if ($this->encoding != 'utf-8') {
            $result = mb_convert_encoding($result, $this->encoding, 'UTF-8');
        }
        return $result;
    }

    function boolean_mark_atoms($string) {
        $result = preg_replace("/([[:space:]]{2,})/", ' ', trim($string));

        /* convert normal boolean operators to shortened syntax */
        $result = str_ireplace(array(' not ',' and ',' or '), array(' -',' ',','), $result);

        /* strip excessive whitespace */
        $result = str_replace(array(' ,', ', '), ',', $result);
        $result = str_replace(array('- ','+'), array('-',''), $result);

        return $result;
}

    function boolean_sql_where_short($input_value, $field) {
        $fields   = explode(',', $field);
        $keywords = explode(' ', $input_value);

        $ph['keyword'] = sql_real_escape_string(array_shift($keywords));
        $_ = array();
        foreach($fields as $field) {
            $ph['field'] = $field;
            if(preg_match('/[a-zA-Z]/', $keywords[0]))
                $_[] = parseQuery("(i.<%field%> LIKE '%<%keyword%>%') ", $ph);
            else
                $_[] = parseQuery("(i.<%field%> LIKE BINARY '%<%keyword%>%') ", $ph);
        }
        $like = array();
        $like[] = '('.join(' OR ',$_).')';
        
        foreach ($keywords as $keyword) {
            $ascii_only = preg_match('/[0-9a-zA-Z]+/', $keyword); // 英数字のみの場合は大文字小文字を判別しない曖昧検索
            $ph['keyword'] = sql_real_escape_string(ltrim($keyword, ',-'));
            $_ = array();
            
            if(substr($keyword,0,1) == '-'){
                foreach($fields as $field) {
                    $ph['field'] = $field;
                    if($ascii_only)
                        $_[] = parseQuery(" NOT(i.<%field%> LIKE '%<%keyword%>%') ", $ph);
                    else
                        $_[] = parseQuery(" NOT(i.<%field%> LIKE BINARY '%<%keyword%>%') ", $ph);
                }
                $like[] =' AND ('. join(' AND ', $_).')';
            } else {
                foreach($fields as $field) {
                    $ph['field'] = $field;
                    if($ascii_only)
                        $_[] = parseQuery(" (i.<%field%> LIKE '%<%keyword%>%') ", $ph);
                    else
                        $_[] = parseQuery(" (i.<%field%> LIKE BINARY '%<%keyword%>%') ", $ph);
                }
                if (substr($keyword, 0, 1) == ',')
                    $like[] =' OR ('. join(' OR ', $_).')';
                else
                    $like[] =' AND ('. join(' OR ', $_).')';
            }
        }
        
        return '('.join(' ', $like).')';
    }
}
