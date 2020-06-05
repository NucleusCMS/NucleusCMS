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
    public $mode; // hybrid | likeonly | fulltext

    public function __construct($keywords) {
        $this->fields = 'ititle,ibody,imore';
        $this->mode = 'hybrid';
        $this->keywords = $this->forge_keywords($keywords);
    }

    public function SEARCH($keywords) {
        $this->__construct($keywords);
    }

    public function forge_keywords($keywords) {
        $chars = explode(' ', '/ ] [ < > = ? ! # ^ ( ) : ; \\ %');
        $keywords = str_replace($chars, ' ', $keywords);

        $keywords = str_replace('|', ' |', $keywords);
        $keywords = preg_replace('/(  +)/', ' ', trim($keywords));
        $keywords = str_ireplace(' not ', ' -', $keywords);
        $keywords = str_replace('- ', '-', $keywords);
        $keywords = str_ireplace(' and ', ' +', $keywords);
        $keywords = str_replace('+ ', '+', $keywords);
        $keywords = str_ireplace(' or ', ' |', $keywords);
        $keywords = str_replace('| ', '|', $keywords);

        return trim($keywords, ', ');
    }

    public function set($key, $value) {
        $this->$key = $value;
    }

    public function get_score() {
        if ($this->mode === 'likeonly') {
            return false;
        }

        $keywords = explode(' ', $this->keywords);
        $long_keywords = array();
        foreach ($keywords as $keyword) {
            if ($this->is_long_word($keyword)) {
                $long_keywords[] = $keyword;
            } elseif (substr($keyword, 0, 1) !== '-') {
                $score[] = sprintf(' %s ', $this->score_for_like_phrase($keyword));
            }
        }
        if ($long_keywords) {
            $long_keywords = $this->add_boolean($long_keywords);
            $ph['field'] = $this->fields;
            $ph['keywords'] = sql_quote_string(join(' ', $long_keywords));
            $ph['like_score'] = join(' + ', $score);

            return parseQuery('[@like_score@] + match ([@field@]) against ([@keywords@] IN BOOLEAN MODE) ', $ph);
        }
    }

    private function is_long_word($keyword) {
        return ($this->get_min_word_len() <= strlen(trim($keyword, '-+| ')));
    }

    private function add_boolean($keys = array()) {
        foreach ($keys as $i => $key) {
            $c = substr($key, 0, 1);
            $prev = $i - 1;
            if ($c == '+') {
                $keys[$i] = '#' . $key;
            } elseif ($c == '-') {
                $keys[$i] = '#' . $key;
            } elseif ($c === '|') {
                $keys[$i] = ltrim($key, '+-|');
                if (0 < $i) {
                    $keys[$prev] = ltrim($keys[$prev], '+-|');
                }
            } else {
                $keys[$i] = '+' . $key;
            }
        }
        foreach ($keys as $i => $key) {
            $keys[$i] = ltrim($key, '#');
        }
        return $keys;
    }

    private function get_min_word_len() {
        $res = sql_query(parseQuery("SHOW TABLE STATUS LIKE '[@prefix@]item'"));
        if ( ! $res) {
            return 4;
        }

        $row = sql_fetch_assoc($res);
        if ($row['Engine'] == 'InnoDB') {
            return 3;
        } elseif ($row['Engine'] == 'MyISAM') {
            $rs = sql_query("SHOW VARIABLES LIKE 'ft_min_word_len'");
            $row = sql_fetch_assoc($res);
            if ($row) {
                return max($row['Value'], 1);
            }
        }

        return 4;
    }

    public function remove_boolean_operators() {
        $keywords = explode(' ', $this->keywords);
        foreach ($keywords as $i => $keyword) {
            $keywords[$i] = ltrim($keyword, '-+|');
        }
        return join(' ', $keywords);
    }

    public function get_where_phrase() {
        if ($this->mode === 'likeonly') {
            return $this->get_where_phrase_ja($this->keywords);
        }

        $keywords = explode(' ', $this->keywords);
        $long_keywords = array();
        foreach ($keywords as $i => $keyword) {
            if ($this->is_long_word($keyword)) {
                $long_keywords[] = $keyword;
                unset($keywords[$i]);
            }
        }
        $_ = array();
        if ($long_keywords) {
            $long_keywords = $this->add_boolean($long_keywords);
            $_[] = $this->get_ft_phrase(join(' ', $long_keywords));
        }
        if ($keywords) {
            foreach ($keywords as $keyword) {
                $c = substr($keyword, 0, 1);
                $like_phrase = $this->get_like_phrase($keyword);
                if ( ! $_) {
                    $_[] = $like_phrase;
                } elseif ($c == '|') {
                    $_[] = 'OR ' . $like_phrase;
                } else {
                    $_[] = 'AND ' . $like_phrase;
                }
            }
        }
        return join(' ', $_);
    }

    public function get_where_phrase_ja($keywords) {
        $keywords = explode(' ', $keywords);

        $_ = array();
        foreach ($keywords as $keyword) {
            $c = substr($keyword, 0, 1);
            $like_phrase = $this->get_like_phrase($keyword);
            if ( ! $_) {
                $_[] = $like_phrase;
            } elseif ($c == '|') {
                $_[] = 'OR ' . $like_phrase;
            } else {
                $_[] = 'AND ' . $like_phrase;
            }
        }
        return join(' ', $_);
    }

    private function get_ft_phrase($long_keywords) {
        $ph['field'] = $this->fields;
        $ph['keywords'] = sql_quote_string($long_keywords);
        return parseQuery(' match ([@field@]) against ([@keywords@] IN BOOLEAN MODE) > 0 ', $ph);
    }

    private function get_like_phrase($keyword) {
        $c = substr($keyword, 0, 1);

        $keyword = sql_real_escape_string(ltrim($keyword, '-+|'));
        $ph['keyword'] = $keyword;
        $ph['concat_field'] = $this->fields_concat();
        if ( ! preg_match('/[\x80-\xfe]/', $keyword)) {
            if ($c === '-') {
                $like = parseQuery("[@concat_field@] NOT LIKE '%[@keyword@]%'", $ph);
            } else {
                $like = parseQuery("[@concat_field@] LIKE '%[@keyword@]%'", $ph);
            }
        } else {
            if ($c === '-') {
                $like = parseQuery("[@concat_field@] NOT LIKE BINARY '%[@keyword@]%'", $ph);
            } else {
                $like = parseQuery("[@concat_field@] LIKE BINARY '%[@keyword@]%'", $ph);
            }
        }
        return $like;
    }

    private function score_for_like_phrase($keyword) {
        $fields = explode(',', $this->fields);
        $score = array();
        $tpl = " 0.2*(LENGTH([@field@]) - LENGTH(REPLACE(LOWER([@field@]), LOWER([@keyword@]), '')))/LENGTH([@keyword@]) ";
        $ph['keyword'] = sql_quote_string($keyword);
        foreach ($fields as $field) {
            $ph['field'] = $field;
            $score[] = parseQuery($tpl, $ph);
        }
        return join(' + ', $score);
    }

    private function fields_concat() {
        $fields = explode(',', $this->fields);
        return sprintf('CONCAT(%s)', join(",'/',", $fields));
    }
}
