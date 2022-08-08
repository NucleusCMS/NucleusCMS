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
 * A class representing a single comment
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2007 The Nucleus Group
 */

class COMMENT
{

    /**
     * Returns the requested comment
     *
     * @static
     */
    public static function getComment($commentid)
    {
        $query    = sprintf(
            "SELECT `cnumber` AS commentid, `cbody` AS body, `cuser` AS user, `cmail` AS userid, `cemail` AS email, `cmember` AS memberid, `ctime`, `chost` AS host, `mname` AS member, `cip` AS ip, `cblog` AS blogid FROM %s LEFT OUTER JOIN %s ON `cmember`=`mnumber` WHERE `cnumber`=%s",
            sql_table('comment'),
            sql_table('member'),
            (int)$commentid
        );
        $comments = sql_query($query);

        $aCommentInfo = sql_fetch_assoc($comments);

        if ($aCommentInfo) {
            $aCommentInfo['timestamp'] = strtotime($aCommentInfo['ctime']);
        }

        return $aCommentInfo;
    }

    /**
     * Prepares a comment to be saved
     *
     * @static
     */
    public static function prepare($comment)
    {
        $comment['user']   = strip_tags($comment['user']);
        $comment['userid'] = strip_tags($comment['userid']);
        $comment['email']  = strip_tags($comment['email']);

        // remove newlines from user; remove quotes and newlines from userid and email; trim whitespace from beginning and end
        $comment['user']   = trim(strtr($comment['user'], "\n", ' '));
        $comment['userid'] = trim(strtr($comment['userid'], "\'\"\n", '-- '));
        $comment['email']  = trim(strtr($comment['email'], "\'\"\n", '-- '));

        // begin if: a comment userid is supplied, but does not have an "http://" or "https://" at the beginning - prepend an "http://"
        if (! empty($comment['userid'])
             && (strpos($comment['userid'], 'http://') !== 0)
             && (strpos(
                 $comment['userid'],
                 'https://'
             ) !== 0)) {
            $comment['userid'] = 'http://' . $comment['userid'];
        } // end if

        $comment['body'] = COMMENT::prepareBody($comment['body']);

        return $comment;
    }

    /**
     * Prepares the body of a comment
     *
     * @ static
     */
    public static function prepareBody($body)
    {
        // convert Windows and Mac style 'returns' to *nix newlines
        $body = preg_replace("/\r\n/", "\n", $body);
        $body = preg_replace("/\r/", "\n", $body);

        // then remove newlines when too many in a row (3 or more newlines get converted to 1 newline)
        $body = preg_replace("/\n{3,}/", "\n\n", $body);

        // encode special characters as entities
        $body = hsc($body);

        // trim away whitespace and newlines at beginning and end
        $body = trim($body);

        // add <br /> tags
        $body = addBreaks($body);

        // create hyperlinks for http:// addresses
        // there's a testcase for this in /build/testcases/urllinking.txt

        $replace_from = array(
            '/([^:\/\/\w]|^)((https:\/\/)([\w\.-]+)([\/\w+\.~%&?@=_:;#,-]+))/i',
            '/([^:\/\/\w]|^)((http:\/\/|www\.)([\w\.-]+)([\/\w+\.~%&?@=_:;#,-]+))/i',
            '/([^:\/\/\w]|^)((ftp:\/\/|ftp\.)([\w\.-]+)([\/\w+\.~%&?@=_:;#,-]+))/i',
            '/([^:\/\/\w]|^)(mailto:(([a-zA-Z\@\%\.\-\+_])+))/i',
        );
        $body = preg_replace_callback($replace_from, self::class . '::prepareBody_cb', $body);

        return $body;
    }


    /**
     * Creates a link code for unlinked URLs with different protocols
     *
     * @ static
     */
    public static function createLinkCode($pre, $url, $protocol = 'http')
    {
        $post = '';

        // it's possible that $url ends contains entities we don't want,
        // since htmlspecialchars is applied _before_ URL linking
        // move the part of URL, starting from the disallowed entity to the 'post' link part
        $aBadEntities = array('&quot;', '&gt;', '&lt;');
        foreach ($aBadEntities as $entity) {
            $pos = strpos($url, $entity);

            if ($pos) {
                $post = substr($url, $pos) . $post;
                $url  = substr($url, 0, $pos);
            }
        }

        // remove entities at end (&&&&)
        if (preg_match('/(&\w+;)+$/i', $url, $matches)) {
            $post = $matches[0] . $post;    // found entities (1 or more)
            $url  = substr($url, 0, strlen($url) - strlen($post));
        }

        // move ending comma from url to 'post' part
        if (substr($url, strlen($url) - 1) == ',') {
            $url  = substr($url, 0, strlen($url) - 1);
            $post = ',' . $post;
        }

        if (! preg_match('#^' . $protocol . '://#', $url)) {
            $linkedUrl = $protocol . (($protocol == 'mailto') ? ':' : '://')
                         . $url;
        } else {
            $linkedUrl = $url;
        }

        if ($protocol != 'mailto') {
            $displayedUrl = $linkedUrl;
        } else {
            $displayedUrl = $url;
        }

        return $pre . '<a href="' . $linkedUrl . '" rel="nofollow">'
               . shorten(
                   $displayedUrl,
                   30,
                   '...'
               ) . '</a>' . $post;
    }


    /**
     * This method is a callback for creating link codes
     *
     * @param   array  $match
     *
     * @return string
     */
    public static function prepareBody_cb($match)
    {
        if (! preg_match('/^[a-z]+/i', $match[2], $protocol)) {
            return $match[0];
        }

        switch (strtolower($protocol[0])) {
            case 'https':
                return self::createLinkCode($match[1], $match[2], 'https');
                break;

            case 'ftp':
                return self::createLinkCode($match[1], $match[2], 'ftp');
                break;

            case 'mailto':
                return self::createLinkCode($match[1], $match[3], 'mailto');
                break;

            default:
                return self::createLinkCode($match[1], $match[2], 'http');
                break;
        }
    }
}
