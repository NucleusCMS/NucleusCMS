<?php

/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2007 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */
/**
 * A class representing a single comment
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2007 The Nucleus Group
 * @version $Id$
 */
class COMMENT {

	/**
	  * Returns the requested comment
	  * 
	  * @static
	  */
	function getComment($commentid) {
		$query =  'SELECT cnumber as commentid, cbody as body, cuser as user, cmail as userid, cemail as email, cmember as memberid, ctime, chost as host, mname as member, cip as ip, cblog as blogid'
			   . ' FROM '.sql_table('comment').' left outer join '.sql_table('member').' on cmember=mnumber'
			   . ' WHERE cnumber=' . intval($commentid);
		$comments = sql_query($query);

		$aCommentInfo = sql_fetch_assoc($comments);
		if ($aCommentInfo)
		{
			$aCommentInfo['timestamp'] = strtotime($aCommentInfo['ctime']);
		}
		return $aCommentInfo;
	}

	/**
	  * Prepares a comment to be saved
	  * 	  
	  * @static
	  */
	function prepare($comment) {
		$comment['user'] = strip_tags($comment['user']);
		$comment['userid'] = strip_tags($comment['userid']);
		$comment['email'] = strip_tags($comment['email']);

		// remove quotes and newlines from user and userid
		$comment['user'] = strtr($comment['user'], "\'\"\n",'-- ');
		$comment['userid'] = strtr($comment['userid'], "\'\"\n",'-- ');
		$comment['email'] = strtr($comment['email'], "\'\"\n",'-- ');

		$comment['body'] = COMMENT::prepareBody($comment['body']);

		return $comment;
	}

	/**
	 * Prepares the body of a comment
	 *
	 * @ static
	 */	 	
	function prepareBody($body) {

		// remove newlines when too many in a row
		$body = ereg_replace("\n.\n.\n","\n",$body);

		// encode special characters as entities
		$body = htmlspecialchars($body);

		// trim away whitespace and newlines at beginning and end
		$body = trim($body);

		// add <br /> tags
		$body = addBreaks($body);

		// create hyperlinks for http:// addresses
		// there's a testcase for this in /build/testcases/urllinking.txt
		$replaceFrom = array(
			'/([^:\/\/\w]|^)((https:\/\/)([\w\.-]+)([\/\w+\.~%&?@=_:;#,-]+))/ie',
			'/([^:\/\/\w]|^)((http:\/\/|www\.)([\w\.-]+)([\/\w+\.~%&?@=_:;#,-]+))/ie',
			'/([^:\/\/\w]|^)((ftp:\/\/|ftp\.)([\w\.-]+)([\/\w+\.~%&?@=_:;#,-]+))/ie',
			'/([^:\/\/\w]|^)(mailto:(([a-zA-Z\@\%\.\-\+_])+))/ie'
		);
		$replaceTo = array(
			'COMMENT::createLinkCode("\\1", "\\2","https")',
			'COMMENT::createLinkCode("\\1", "\\2","http")',
			'COMMENT::createLinkCode("\\1", "\\2","ftp")',
			'COMMENT::createLinkCode("\\1", "\\3","mailto")'
		);
		$body = preg_replace($replaceFrom, $replaceTo, $body);

		return $body;
	}

	/**
	 * Creates a link code for unlinked URLs with different protocols
	 *
	 * @ static
	 */	
	function createLinkCode($pre, $url, $protocol = 'http') {
		$post = '';

		// it's possible that $url ends contains entities we don't want,
		// since htmlspecialchars is applied _before_ URL linking
		// move the part of URL, starting from the disallowed entity to the 'post' link part
		$aBadEntities = array('&quot;', '&gt;', '&lt;');
		foreach ($aBadEntities as $entity)
		{
			$pos = strpos($url, $entity);
			if ($pos)
			{
				$post = substr($url, $pos) . $post;
				$url = substr($url, 0, $pos);

			}
		}

		// remove entities at end (&&&&)
		if (preg_match('/(&\w+;)+$/i', $url, $matches)) {
			$post = $matches[0] . $post;	// found entities (1 or more)
			$url = substr($url, 0, strlen($url) - strlen($post));
		}

		// move ending comma from url to 'post' part
		if (substr($url, strlen($url) - 1) == ',')
		{
			$url = substr($url, 0, strlen($url) - 1);
			$post = ',' . $post;
		}

		if (!ereg('^'.$protocol.'://',$url))
			$linkedUrl = $protocol . (($protocol == 'mailto') ? ':' : '://') . $url;
		else
			$linkedUrl = $url;


		if ($protocol != 'mailto')
			$displayedUrl = $linkedUrl;
		else
			$displayedUrl = $url;
		return $pre . '<a href="'.$linkedUrl.'" rel="nofollow">'.shorten($displayedUrl,30,'...').'</a>' . $post;
	}

}

?>