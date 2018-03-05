<?php

class SEARCH_JA extends SEARCH {
    
    private $encoding;
    
    public function SEARCH($keywords) { $this->__construct($keywords); }
    
    function __construct($keywords) {
        
        $this->encoding = strtolower(preg_replace('/[^a-z0-9_]/i', '', _CHARSET));
        if ($this->encoding != 'utf-8') {
            $keywords = mb_convert_encoding($keywords, 'UTF-8', $this->encoding);
        }
        
        parent::__construct($keywords);
    }

    private function strip_chars($keywords) {
        return preg_replace ("/[<>=?!#^()[\]:;\\%]/",'',$keywords);
    }
    
    public function get_score($fields=''){
        return false;
    }
    
    public function boolean_sql_where($fields='') {
        
        if($fields) $this->fields = $fields;
        
        $result = $this->boolean_sql_where_short($this->keywords);
        if ($this->encoding != 'utf-8') {
            $result = mb_convert_encoding($result, $this->encoding, 'UTF-8');
        }
        return $result;
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
