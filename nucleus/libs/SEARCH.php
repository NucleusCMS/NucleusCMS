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

class SEARCH
{

    public $querystring;
    public $marked;
    public $inclusive;
    public $blogs;

    function __construct($keywords)
    {
        global $blogid;
//        $keywords = preg_replace ("/[<,>,=,?,!,#,^,(,),[,\],:,;,\\\,%]/","",$keywords);
        /* * * for jp * * * * * * * * * * */
        $this->encoding = strtolower(preg_replace('|[^a-z0-9-_]|i', '', _CHARSET));
        if ($this->encoding != 'utf-8') {
            $keywords = mb_convert_encoding($keywords, "UTF-8", $this->encoding);
        }
        $keywords = str_replace("\xE3\x80\x80", ' ', $keywords);
        $keywords = preg_replace("/[<>=?!#^()[\]:;\\%]/", "", $keywords);

        $this->ascii = '[\x00-\x7F]';
        $this->two = '[\xC0-\xDF][\x80-\xBF]';
        $this->three = '[\xE0-\xEF][\x80-\xBF][\x80-\xBF]';

        $this->jpmarked = $this->boolean_mark_atoms_jp($keywords);
        /* * * * * * * * * * * * * * * * */

        $this->querystring = $keywords;
//        $this->marked      = $this->boolean_mark_atoms($keywords);
        $this->inclusive = $this->boolean_inclusive_atoms($keywords);
        $this->blogs = array();

        // get all public searchable blogs, no matter what, include the current blog allways.
        $res = sql_query('SELECT bnumber FROM ' . sql_table('blog') . ' WHERE bincludesearch=1 ');
        while ($obj = sql_fetch_object($res)) {
            $this->blogs[] = intval($obj->bnumber);
        }
    }

    public function SEARCH($keywords)
    {
        $this->__construct($keywords);
    }

    function boolean_sql_select($match)
    {

        if (strlen($this->inclusive) == 0) {
            return;
        }

        if (!isset($stringsum)) {
            $stringsum = '';
        }

        /* build sql for determining score for each record */
        $result = explode(' ', $this->inclusive);
        if (!isset($stringsum_long)) {
            $stringsum_long = '';
        }
        for ($cth = 0; $cth < count($result); $cth++) {
            if (strlen($result[$cth]) >= 4) {
                $stringsum_long .= " $result[$cth] ";
            } else {
                $stringsum_a[] = ' ' . $this->boolean_sql_select_short($result[$cth], $match) . ' ';
            }
        }

        if (strlen($stringsum_long) > 0) {
            $stringsum_long = sql_real_escape_string($stringsum_long);
            $stringsum_long = trim($stringsum_long);
            $stringsum_a[] = sprintf(" match (%s) against ('%s') ", $match, $stringsum_long);
        }

        $stringsum .= implode("+", $stringsum_a);

        return $stringsum;
    }


    function boolean_inclusive_atoms($keywords)
    {
        $keywords = trim($keywords);
        $keywords = preg_replace("#([[:space:]]{2,})#", ' ', $keywords);

        # just added delimiters to regex and the 'i' for case-insensitive matching

        /* convert normal boolean operators to shortened syntax */
        $keywords = preg_replace('# not #i', ' -', $keywords);
        $keywords = preg_replace('# and #i', ' ', $keywords);
        $keywords = preg_replace('# or #i', ',', $keywords);

        /* drop unnecessary spaces */
        $keywords = str_replace(' ,', ',', $keywords);
        $keywords = str_replace(', ', ',', $keywords);
        $keywords = str_replace('- ', '-', $keywords);
        $keywords = str_replace('+', '', $keywords);

        /* strip exlusive atoms */
        $keywords = preg_replace(
            "#\-\(([A-Za-z0-9]|$this->two|$this->three){1,}([A-Za-z0-9\-\.\_\,]|$this->two|$this->three){0,}\)#",
            '',
            $keywords
        );

        $keywords = str_replace('(', ' ', $keywords);
        $keywords = str_replace(')', ' ', $keywords);
        $keywords = str_replace(',', ' ', $keywords);
        if ($this->encoding != 'utf-8') {
            $keywords = mb_convert_encoding($keywords, $this->encoding, "UTF-8");
        }
        return $keywords;
    }

    function boolean_sql_where($match)
    {
        $keywords = $this->jpmarked; /* for jp */
        $where = $this->boolean_sql_where_jp_short($keywords, $match);/* for jp */
        if ($this->encoding != 'utf-8') {
            $where = mb_convert_encoding($where, $this->encoding, "UTF-8");
        }
        return $where;
    }

    // there must be a simple way to simply copy a value with backslashes in it through
    // the preg_replace, but I cannot currently find it (karma 2003-12-30)
    function copyvalue($foo)
    {
        return $foo;
    }

    function boolean_sql_select_short($string, $match)
    {
        $match = explode(',', $match);
        $score_unit_weight = .2;
        for ($ith = 0; $ith < count($match); $ith++) {
            $score_a[$ith] =
                " $score_unit_weight*(
                           LENGTH(" . sql_real_escape_string($match[$ith]) . ") -
                           LENGTH(REPLACE(LOWER(" . sql_real_escape_string($match[$ith]) . "),LOWER('" . sql_real_escape_string($string) . "'),'')))
                           /LENGTH('" . sql_real_escape_string($string) . "') ";
        }
        $score = implode(" + ", $score_a);

        return $score;
    }

    /***********************************************
     * Make "WHERE" (jp)
     ***********************************************/

    function boolean_mark_atoms_jp($keywords)
    {
        $keywords = trim($keywords);
        $keywords = preg_replace("/([[:space:]]{2,})/", ' ', $keywords);

        /* convert normal boolean operators to shortened syntax */
        $keywords = preg_replace('# not #i', ' -', $keywords);
        $keywords = preg_replace('# and #i', ' ', $keywords);
        $keywords = preg_replace('# or #i', ',', $keywords);

        // strip excessive whitespace
        $keywords = str_replace(', ', ',', $keywords);
        $keywords = str_replace(' ,', ',', $keywords);
        $keywords = str_replace('- ', '-', $keywords);
        $keywords = str_replace('+', '', $keywords);
        $keywords = str_replace(',', ' ,', $keywords);

        return $keywords;
    }

    function boolean_sql_where_jp_short($keywords, $fields)
    {
        $fields = explode(',', $fields);
        $keywords = explode(' ', $keywords);

        $binKey = preg_match('/[a-zA-Z]/', $keywords[0]) ? '' : 'BINARY';
        $ph = array('bin' => $binKey, 'keyword' => sql_real_escape_string($keywords[0]));
        for ($i = 0; $i < count($fields); $i++) {
            $ph['field'] = $fields[$i];
            $_[$i] = parseText("(i.<%field%> LIKE <%bin%> '%<%keyword%>%') ", $ph);
        }
        $like = '(' . implode(' or ', $_) . ')';

        for ($kn = 1; $kn < count($keywords); $kn++) {
            $binKey = preg_match('/[a-zA-Z]/', $keywords[$kn]) ? '' : 'BINARY';
            if (substr($keywords[$kn], 0, 1) == ",") {
                $ph = array('bin' => $binKey, 'keyword' => sql_real_escape_string(substr($keywords[$kn], 1)));
                for ($i = 0; $i < count($fields); $i++) {
                    $ph['field'] = $fields[$i];
                    $_[$i] = parseText(" (i.<%field%> LIKE <%bin%> '%<%keyword%>%') ", $ph);
                }
                $like .= ' OR (' . implode(' or ', $_) . ')';
            } elseif (substr($keywords[$kn], 0, 1) != '-') {
                $ph = array('bin' => $binKey, 'keyword' => sql_real_escape_string($keywords[$kn]));
                for ($i = 0; $i < count($fields); $i++) {
                    $ph['field'] = $fields[$i];
                    $_[$i] = parseText(" (i.<%field%> LIKE <%bin%> '%<%keyword%>%') ", $ph);
                }
                $like .= ' AND (' . implode(' or ', $_) . ')';
            } else {
                $ph = array('bin' => $binKey, 'keyword' => sql_real_escape_string(substr($keywords[$kn], 1)));
                for ($i = 0; $i < count($fields); $i++) {
                    $ph['field'] = $fields[$i];
                    $_[$i] = parseText(" NOT(i.<%field%> LIKE <%bin%> '%<%keyword%>%') ", $ph);
                }
                $like .= ' AND (' . implode(' and ', $_) . ')';
            }
        }

        $like = '(' . $like . ')';
        return $like;
    }
}
