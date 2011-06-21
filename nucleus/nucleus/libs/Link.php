<?php 
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2011 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */
/**
 * This class is a collections of functions that produce links
 * 
 * All functions in this clss should only be called statically,
 * for example: Link::createItemLink(...)
 * 
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2011 The Nucleus Group
 * @version $Id: $
 */
class Link {

	/**
	 * Create a link to an item
	 * @param $itemid	item id
	 * @param $extra	extra parameter
	 */
	function createItemLink($itemid, $extra = '') {
		return Link::createLink('item', array('itemid' => $itemid, 'extra' => $extra) );
	}

	/**
	 * Create a link to a member
	 * 
	 * @param $memberid	member id
	 * @param $extra	extra parameter
	 */
	function createMemberLink($memberid, $extra = '') {
		return Link::createLink('member', array('memberid' => $memberid, 'extra' => $extra) );
	}
	
	/**
	 * Create a link to a category
	 * 
	 * @param $catid	category id
	 * @param $extra	extra parameter
	 */
	function createCategoryLink($catid, $extra = '') {
		return Link::createLink('category', array('catid' => $catid, 'extra' => $extra) );
	}

	/**
	 * Create a link to an archive
	 * 
	 * @param $blogid	blog id
	 * @param $archive	archive identifier
	 * @param $extra	extra parameter
	 */
	function createArchiveLink($blogid, $archive, $extra = '') {
		return Link::createLink('archive', array('blogid' => $blogid, 'archive' => $archive, 'extra' => $extra) );
	}

	/**
	 * Create a link to an archive list
	 * 
	 * @param $blogid	blog id
	 * @param $extra	extra parameter
	 */
	function createArchiveListLink($blogid = '', $extra = '') {
		return Link::createLink('archivelist', array('blogid' => $blogid, 'extra' => $extra) );
	}

	/**
	 * Create a link to a blog
	 * 
	 * @param $blogid	blog id
	 * @param $extra	extra parameter
	 */
	function createBlogidLink($blogid, $params = '') {
		return Link::createLink('blog', array('blogid' => $blogid, 'extra' => $params) );
	}

	/**
	 * Create a link
	 * 
	 * Universell function that creates link of different types (like item, blog ...)
	 * and with an array of parameters
	 * 
	 * @param $type		type of the link
	 * @param $params	array with parameters
	 */
	function createLink($type, $params) {
		global $manager, $CONF;
	
		$generatedURL = '';
		$usePathInfo = ($CONF['URLMode'] == 'pathinfo');
	
		// ask plugins first
		$created = false;
	
		if ($usePathInfo) {
			$manager->notify(
				'GenerateURL',
				array(
					'type' => $type,
					'params' => $params,
					'completed' => &$created,
					'url' => &$url
				)
			);
		}
	
		// if a plugin created the URL, return it
		if ($created) {
			return $url;
		}
	
		// default implementation
		switch ($type) {
			case 'item':
				if ($usePathInfo) {
					$url = $CONF['ItemURL'] . '/' . $CONF['ItemKey'] . '/' . $params['itemid'];
				} else {
					$url = $CONF['ItemURL'] . '?itemid=' . $params['itemid'];
				}
				break;
	
			case 'member':
				if ($usePathInfo) {
					$url = $CONF['MemberURL'] . '/' . $CONF['MemberKey'] . '/' . $params['memberid'];
				} else {
					$url = $CONF['MemberURL'] . '?memberid=' . $params['memberid'];
				}
				break;
	
			case 'category':
				if ($usePathInfo) {
					$url = $CONF['CategoryURL'] . '/' . $CONF['CategoryKey'] . '/' . $params['catid'];
				} else {
					$url = $CONF['CategoryURL'] . '?catid=' . $params['catid'];
				}
				break;
	
			case 'archivelist':
				if (!$params['blogid']) {
					$params['blogid'] = $CONF['DefaultBlog'];
				}
	
				if ($usePathInfo) {
					$url = $CONF['ArchiveListURL'] . '/' . $CONF['ArchivesKey'] . '/' . $params['blogid'];
				} else {
					$url = $CONF['ArchiveListURL'] . '?archivelist=' . $params['blogid'];
				}
				break;
	
			case 'archive':
				if ($usePathInfo) {
					$url = $CONF['ArchiveURL'] . '/' . $CONF['ArchiveKey'] . '/'.$params['blogid'].'/' . $params['archive'];
				} else {
					$url = $CONF['ArchiveURL'] . '?blogid='.$params['blogid'].'&amp;archive=' . $params['archive'];
				}
				break;
	
			case 'blog':
				if ($usePathInfo) {
					$url = $CONF['BlogURL'] . '/' . $CONF['BlogKey'] . '/' . $params['blogid'];
				} else {
					$url = $CONF['BlogURL'] . '?blogid=' . $params['blogid'];
				}
				break;
		}
	
		return Link::addLinkParams($url, (isset($params['extra'])? $params['extra'] : null));
	}

	function addLinkParams($link, $params) {
		global $CONF;
	
		if (is_array($params) ) {
	
			if ($CONF['URLMode'] == 'pathinfo') {
	
				foreach ($params as $param => $value) {
					// change in 3.63 to fix problem where URL generated with extra params mike look like category/4/blogid/1
					// but they should use the URL keys like this: category/4/blog/1
					// if user wants old urls back, set $CONF['NoURLKeysInExtraParams'] = 1; in config.php
					if (isset($CONF['NoURLKeysInExtraParams']) && $CONF['NoURLKeysInExtraParams'] == 1) 
					{
						$link .= '/' . $param . '/' . urlencode($value);
					} else {
						switch ($param) {
							case 'itemid':
								$link .= '/' . $CONF['ItemKey'] . '/' . urlencode($value);
							break;
							case 'memberid':
								$link .= '/' . $CONF['MemberKey'] . '/' . urlencode($value);
							break;
							case 'catid':
								$link .= '/' . $CONF['CategoryKey'] . '/' . urlencode($value);
							break;
							case 'archivelist':
								$link .= '/' . $CONF['ArchivesKey'] . '/' . urlencode($value);
							break;
							case 'archive':
								$link .= '/' . $CONF['ArchiveKey'] . '/' . urlencode($value);
							break;
							case 'blogid':
								$link .= '/' . $CONF['BlogKey'] . '/' . urlencode($value);
							break;
							default:
								$link .= '/' . $param . '/' . urlencode($value);
							break;
						}
					}
				}
	
			} else {
	
				foreach ($params as $param => $value) {
					$link .= '&amp;' . $param . '=' . urlencode($value);
				}
	
			}
		}
	
		return $link;
	}

	/**
	 * Create an link to a blog
	 * 
	 * This function considers the URLMode of the blog
	 * 
	 * @param $url		url
	 * @param $params	parameters
	 */
	function createBlogLink($url, $params) {
		global $CONF;
		if ($CONF['URLMode'] == 'normal') {
			if (i18n::strpos($url, '?') === FALSE && is_array($params)) {
				$fParam = reset($params);
				$fKey   = key($params);
				array_shift($params);
				$url .= '?' . $fKey . '=' . $fParam;
			}
		} elseif ($CONF['URLMode'] == 'pathinfo' && i18n::substr($url, -1) == '/') {
			$url = i18n::substr($url, 0, -1);
		}
		return addLinkParams($url, $params);
	}

}
?>