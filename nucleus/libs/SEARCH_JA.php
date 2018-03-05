<?php

class SEARCH_JA extends SEARCH {
    
    public function SEARCH($keywords) { $this->__construct($keywords); }
    
    public function get_score($fields=''){
        return false;
    }
    
    private function get_like_phrase($keyword) {
        $c = substr($keyword,0,1);
        
        $like = array();
        $fields = explode(',',$this->fields);
        $keyword = sql_real_escape_string(ltrim($keyword,'-+|'));
        $is_ascii = preg_match('/\-?[0-9a-zA-Z]+/', $keyword); // 英数字のみの場合は大文字小文字を判別しない曖昧検索
        $tpl_ascii  = "LIKE '%<%keyword%>%'";
        $tpl_binary = "LIKE BINARY '%<%keyword%>%'";
        $ph['keyword'] = $keyword;
        foreach($fields as $field){
            $ph['field'] = $field;
            if(preg_match('/\-?[0-9a-zA-Z]+/', $keyword)) {
                if($c==='-') $like[] = parseQuery('<%field%> NOT ' . $tpl_ascii, $ph);
                else         $like[] = parseQuery('<%field%> ' . $tpl_ascii, $ph);
            }
            else {
                if($c==='-') $like[] = parseQuery('<%field%> NOT ' . $tpl_binary, $ph);
                else         $like[] = parseQuery('<%field%> ' . $tpl_binary, $ph);
            }
        }
        
        if($c==='-') $ph['likes'] = join(' AND ',$like);
        else         $ph['likes'] = join(' OR ',$like);
        
        return parseQuery(' (<%likes%>) ', $ph);
    }
    
    public function get_where_phrase($fields='') {
        
        if ($fields) $this->fields = $fields;
        
        $keywords = explode(' ',$this->keywords);
        
        foreach($keywords as $keyword) {
            $c = substr($keyword,0,1);
            $like_phrase = $this->get_like_phrase($keyword);
            if(!$_)         $_[] = $like_phrase;
            elseif($c=='|') $_[] = 'OR' .  $like_phrase;
            else            $_[] = 'AND' . $like_phrase;
        }
        return join(' ', $_);
    }
}
