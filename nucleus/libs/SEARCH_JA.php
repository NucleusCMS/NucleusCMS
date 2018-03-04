<?php

class SEARCH_JA extends SEARCH {
    
    private $encoding;
    
    public function SEARCH($keywords) { $this->__construct($keywords); }
    
    function __construct($keywords) {
        
        global $blogid;

        $this->encoding = strtolower(preg_replace('/[^a-z0-9-_]/i', '', _CHARSET));
        if ($this->encoding != 'utf-8') {
            $keywords = mb_convert_encoding($keywords, 'UTF-8', $this->encoding);
        }
        $keywords = str_replace ("\xE3\x80\x80",' ',$keywords);
        $keywords = preg_replace ("/[<>=?!#^()[\]:;\\%]/",'',$keywords);

        $this->marked = $this->boolean_mark_atoms($keywords);

        $this->highlight    = $this->get_highlight_words($keywords);
        $this->blogs        = array();

        // get all public searchable blogs, no matter what, include the current blog allways.
        $res = sql_query( parseQuery('SELECT bnumber FROM <%prefix%>blog WHERE bincludesearch=1') );
        while ($obj = sql_fetch_object($res)) {
            $this->blogs[] = intval($obj->bnumber);
        }
    }

    public function get_score($fields=''){
        return false;
    }
    
    public function get_highlight_words($string) {
        $result = $this->boolean_mark_atoms($string);
        
        /* strip exlusive atoms */
        $two    = '[\xC0-\xDF][\x80-\xBF]';
        $three  = '[\xE0-\xEF][\x80-\xBF][\x80-\xBF]';
        $pattern = "#\-\(([A-Za-z0-9]|$two|$three){1,}([A-Za-z0-9\-\.\_\,]|$two|$three){0,}\)#";
        $result = preg_replace($pattern, '', $result);
        if ($this->encoding != 'utf-8') {
            $result = mb_convert_encoding($result, $this->encoding, 'UTF-8');
        }
        $result = str_replace(array('(', ')', ','), ' ', $result);
        return $result;
    }

    public function boolean_sql_where($fields='') {
        
        if($fields) $this->fields = $fields;
        
        $result = $this->boolean_sql_where_short($this->marked);
        if ($this->encoding != 'utf-8') {
            $result = mb_convert_encoding($result, $this->encoding, 'UTF-8');
        }
        return $result;
    }

    public function boolean_mark_atoms($keywords) {
        $keywords = preg_replace("/([[:space:]]{2,})/", ' ', trim($keywords));

        /* convert normal boolean operators to shortened syntax */
        $keywords = str_ireplace(array(' not ',' and ',' or '), array(' -',' ',','), $keywords);

        /* strip excessive whitespace */
        $keywords = str_replace(array(' ,', ', '), ',', $keywords);
        $keywords = str_replace(array('- ','+'), array('-',''), $keywords);

        return $keywords;
}

    public function boolean_sql_where_short($input_value) {
        
        $fields   = explode(',', $this->fields);
        $keywords = explode(' ', $input_value);
        
        $ph['keyword'] = sql_real_escape_string(array_shift($keywords));
        
        $tpl_ascii  = "(i.<%field%> LIKE '%<%keyword%>%')";
        $tpl_binary = "(i.<%field%> LIKE BINARY '%<%keyword%>%')";
        
        $_ = array();
        $is_ascii = preg_match('/[0-9a-zA-Z]+/', $ph['keyword']);
        foreach($fields as $field) {
            $ph['field'] = $field;
            if($is_ascii) $_[] = parseQuery($tpl_ascii, $ph);
            else          $_[] = parseQuery($tpl_binary, $ph);
        }
        
        $like = array();
        $like[] = sprintf('(%s)', join(' OR ',$_));
        
        foreach ($keywords as $keyword) {
            $is_ascii = preg_match('/[0-9a-zA-Z]+/', $keyword); // 英数字のみの場合は大文字小文字を判別しない曖昧検索
            $ph['keyword'] = sql_real_escape_string(ltrim($keyword, ',-'));
            $_ = array();
            
            if(substr($keyword,0,1) == '-') {
                foreach($fields as $field) {
                    $ph['field'] = $field;
                    if($is_ascii) $_[] = parseQuery('NOT'.$tpl_ascii, $ph);
                    else          $_[] = parseQuery('NOT'.$tpl_binary, $ph);
                }
                $like[] = sprintf(' AND (%s)', join(' AND ', $_));
            }
            else {
                foreach($fields as $field) {
                    $ph['field'] = $field;
                    if($is_ascii) $_[] = parseQuery($tpl_ascii, $ph);
                    else          $_[] = parseQuery($tpl_binary, $ph);
                }
                if (substr($keyword, 0, 1) == ',')
                    $like[] = sprintf(' OR (%s)', join(' OR ', $_));
                else
                    $like[] = sprintf(' AND (%s)', join(' OR ', $_));
            }
        }
        
        return '('.join(' ', $like).')';
    }
}
