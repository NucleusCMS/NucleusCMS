<?php
/**
  * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/) 
  * Copyright (C) 2003 The Nucleus Group
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
  */

class SEARCH {
    function SEARCH($text) {
        global $blogid;
        $text = preg_replace ("/[<,>,=,?,!,#,^,(,),[,\],:,;,\\\,%]/","",$text);
        $this->querystring = $text;
        $this->marked      = $this->boolean_mark_atoms($text);
        $this->inclusive   = $this->boolean_inclusive_atoms($this->querystring);

        // get all public searchable blogs, no matter what, include the current blog allways.
		$res = sql_query('SELECT bnumber FROM '.sql_table('blog').' WHERE bincludesearch ');
		$i = 0;
		while ($obj = mysql_fetch_object($res)) {
		    $this->blogs[$i] = $obj->bnumber;
		    $i++;
        }
    }

    function  boolean_sql_select($match){
        $string = $this->inclusive;
        if (strlen($string) > 0) {
    	   /* build sql for determining score for each record */
	       preg_match_all(
		                   "([A-Za-z0-9]{1,}[A-Za-z0-9\-\.\_]{0,})",
    		               $string,
	    	               $result);
           $result = $result[0];
	       for($cth=0;$cth<count($result);$cth++){
               if(strlen($result[$cth])>=4){
                   $stringsum_long .=  " $result[$cth] ";
    		   }else{
	    	       $stringsum_a[] = ' '.$this->boolean_sql_select_short($result[$cth],$match).' ';
    		   }
	       }
    	   if(strlen($stringsum_long)>0){
	    		$stringsum_a[] = " match ($match) against ('$stringsum_long') ";
    	   }
	       $stringsum .= implode("+",$stringsum_a);
    	   return $stringsum;
   	    }
    }
    
    function boolean_inclusive_atoms($string){
    	$result=trim($string);
    	$result=preg_replace("/([[:space:]]{2,})/",' ',$result);

    	/* convert normal boolean operators to shortened syntax */
    	$result=eregi_replace(' not ',' -',$result);
    	$result=eregi_replace(' and ',' ',$result);
    	$result=eregi_replace(' or ',',',$result);

    	/* drop unnecessary spaces */
    	$result=str_replace(' ,',',',$result);
    	$result=str_replace(', ',',',$result);
    	$result=str_replace('- ','-',$result);
    	$result=str_replace('+','',$result);

    	/* strip exlusive atoms */
    	$result=preg_replace(
    		"(\-\([A-Za-z0-9]{1,}[A-Za-z0-9\-\.\_\,]{0,}\))",
    		'',
    		$result);
    	$result=preg_replace(
    		"(\-[A-Za-z0-9]{1,}[A-Za-z0-9\-\.\_]{0,})",
    		'',
    		$result);
    	$result=str_replace('(',' ',$result);
    	$result=str_replace(')',' ',$result);
    	$result=str_replace(',',' ',$result);

    	return $result;
    }
    
   
    function boolean_sql_where($match){
        $result = $this->marked;
    	$result = preg_replace(
    		"/foo\[\(\'([^\)]{4,})\'\)\]bar/",
    		" match ($match) against ('$1') > 0 ",
    		$result);

    	$result = preg_replace(     		
            "/foo\[\(\'([^\)]{1,3})\'\)\]bar/e",
            " '('.\$this->boolean_sql_where_short(\"$1\",\"$match\").')' ",    		
            $result);

    	return $result;
    }

    function boolean_mark_atoms($string){
    	$result=trim($string);
    	$result=preg_replace("/([[:space:]]{2,})/",' ',$result);

    	/* convert normal boolean operators to shortened syntax */
    	$result=eregi_replace(' not ',' -',$result);
    	$result=eregi_replace(' and ',' ',$result);
    	$result=eregi_replace(' or ',',',$result);

    	/* strip excessive whitespace */
    	$result=str_replace('( ','(',$result);
    	$result=str_replace(' )',')',$result);
    	$result=str_replace(', ',',',$result);
    	$result=str_replace(' ,',',',$result);
    	$result=str_replace('- ','-',$result);
    	$result=str_replace('+','',$result);
    	/* apply arbitrary function to all 'word' atoms */
	    $result=preg_replace("/([@-Za-z!-9]{1,}[@-Za-z!-9\.\_-]{0,})/", "foo[('$0')]bar", $result);

    	/* dispatch ' ' to ' AND ' */
    	$result=str_replace(' ',' AND ',$result);

    	/* dispatch ',' to ' OR ' */
    	$result=str_replace(',',' OR ',$result);

    	/* dispatch '-' to ' NOT ' */
    	$result=str_replace(' -',' NOT ',$result);

    	return $result;
    }
    
    function boolean_sql_where_short($string,$match){
    	$match_a = explode(',',$match);
    	for($ith=0;$ith<count($match_a);$ith++){
    		$like_a[$ith] = " $match_a[$ith] LIKE '% $string %' ";
    	}
    	$like = implode(" OR ",$like_a);

    	return $like;
    }
    function boolean_sql_select_short($string,$match){
        $match_a = explode(',',$match);
        $score_unit_weight = .2;
        for($ith=0;$ith<count($match_a);$ith++){
            $score_a[$ith] =
                           " $score_unit_weight*(
                           LENGTH($match_a[$ith]) -
                           LENGTH(REPLACE(LOWER($match_a[$ith]),LOWER('$string'),'')))
			               /LENGTH('$string') ";
        }
	    $score = implode(" + ",$score_a);

        return $score;
    }
}
?>
