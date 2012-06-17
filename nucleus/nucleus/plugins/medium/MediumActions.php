<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2009 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */
/**
 * Media popup window for Nucleus
 *
 * Purpose:
 *   - can be openen from an add-item form or bookmarklet popup
 *   - shows a list of recent files, allowing browsing, search and
 *     upload of new files
 *   - close the popup by selecting a file in the list. The file gets
 *     passed through to the add-item form (linkto, popupimg or inline img)
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 *
 */

class MediumActions extends BaseActions
{
	private $type = '';
	
	static private $default_actions = array(
		'actionurl',
		'adminurl',
		'collection',
		'conf',
		'pagehead',
		'pagefoot',
		'collectionlist',
		'stylesheet',
		'script'
		);
	
	static public $normal_skin_types = array(
		'login'		=> 'NP_Medium',
		'choose'	=> _UPLOAD_TITLE,
		'select'	=> _SKIN_PART_ALIST,
		'error'		=> _ERROR
	);
	
	static public function getNormalSkinTypes()
	{
		return self::$normal_skin_types;
	}
	
	public function getAvailableActions()
	{
		global $manager;
		
		$extra_actions = array();
		
		switch ( $manager->getPlugin('NP_Medium')->type )
		{
			case 'login':
				$extra_actions = array(
					'name',
				);
				break;
			case 'select':
				$extra_actions = array(
					'amount',
					'filter',
					'medialist',
					'next',
					'prev'
				);
				break;
			case 'choose':
				$extra_actions = array(
					'pluginextras',
					'ticket',
				);
				break;
			case 'error':
				$extra_actions = array(
					'message',
				);
				break;
		}
		
		$defined_actions = array_merge(self::$default_actions, $extra_actions);
		
		return array_merge($defined_actions, parent::getAvailableActions());
	}
	
	/**
	 * MediumActions::_construct
	 * 
	 * @param	string	$type	always 'fileparse'
	 * @return	void
	 */
	public function __construct($type)
	{
		parent::__construct();
		return;
	}
	
	public function parse_conf($key)
	{
		global $CONF;
		if ( array_key_exists($key, $CONF) )
		{
			echo $CONF[$key];
		}
		return;
	}
	
	public function parse_actionurl()
	{
		global $CONF;
		echo "{$CONF['ActionURL']}?action=plugin&amp;name=medium";
		return;
	}
	
	public function parse_collection()
	{
		global $manager;
		echo (string) $manager->getPlugin('NP_Medium')->collection;
		return;
	}
	
	public function parse_pagehead()
	{
		global $manager;
		$path = $manager->getPlugin('NP_Medium')->getDirectory() . 'skins/pagehead.skn';
		$contents = $this->parser->skin->getContentFromFile($path);
		$this->parser->parse($contents);
		return;
	}
	
	public function parse_pagefoot()
	{
		global $manager;
		$path = $manager->getPlugin('NP_Medium')->getDirectory() . 'skins/pagefoot.skn';
		$contents = $this->parser->skin->getContentFromFile($path);
		$this->parser->parse($contents);
		return;
	}
	
	public function parse_stylesheet($name)
	{
		global $CONF;
		echo "{$CONF['PluginURL']}medium/styles/{$name}";
		return;
	}
	
	public function parse_script($name)
	{
		global $CONF;
		echo "{$CONF['PluginURL']}medium/scripts/{$name}";
		return;
	}
	
	public function parse_name()
	{
		global $member;
		
		if ( !$member->isLoggedIn() )
		{
			echo (string) requestVar('login');
		}
		else
		{
			echo (string) $member->getDisplayName();
		}
		return;
	}
	
	public function parse_filter()
	{
		global $manager;
		echo (string) $manager->getPlugin('NP_Medium')->filter;
		return;
	}
	
	public function parse_ticket()
	{
		global $manager;
		echo $manager->addTicketHidden();
		return;
	}
	
	public function parse_message()
	{
		global $manager;
		echo (string) $manager->getPlugin('NP_Medium')->message;
		return;
	}
	
	public function parse_pluginextras()
	{
		global $manager;
		$manager->notify("MediaUploadFormExtras", array());
		return;
	}
	
	public function parse_amount()
	{
		global $manager;
		echo (string) $manager->getPlugin('NP_Medium')->amount;
		return;
	}
	
	public function parseoffset()
	{
		global $manager;
		echo (string) $manager->getPlugin('NP_Medium')->offset;
		return;
	}
	
	public function parse_prev()
	{
		global $manager;
		echo (string) $manager->getPlugin('NP_Medium')->prev;
		return;
	}
	
	public function parse_next()
	{
		global $manager;
		echo (string) $manager->getPlugin('NP_Medium')->next;
		return;
	}
	
	public function parse_collectionlist()
	{
		global $CONF, $manager;
		
		$plugin = $manager->getPlugin('NP_Medium');
		
		$data = array(
			'actionurl'	=> "{$CONF['ActionURL']}?action=plugin&amp;type=medium"
		);
		$this->parser->parse(Template::fill($plugin->getOption('collectionlist_head'), $data));
		
		$collections = Media::getCollectionList();
		foreach ( $collections as $name => $desc )
		{
			$data = array(
				'name'	=> $name,
				'desc'	=> $desc
			);
			
			if ( $plugin->collection ==  $name )
			{
				$data['selected'] = 'selected="selected"';
			}
			
			$this->parser->parse(Template::fill($plugin->getOption('collectionlist_body'), $data));
		}
		
		$data = array(
			'actionurl'		=> "{$CONF['ActionURL']}?action=plugin&amptype=medium",
			'collection'	=> $plugin->collection
		);
		$this->parser->parse(Template::fill($plugin->getOption('collectionlist_foot'), $data));
	}
	
	public function parse_medialist()
	{
		global $CONF, $manager;
		
		$plugin = $manager->getPlugin('NP_Medium');
		
		$data = array(
			'actionurl'		=> "{$CONF['ActionURL']}?action=plugin&amp;type=medium",
			'collection'	=> $plugin->collection,
			'description'	=> $plugin->description
		);
		$this->parser->parse(Template::fill($plugin->getOption('medialist_head'), $data));
		
		$image_template = $plugin->getOption('medialist_body_image');
		$other_template = $plugin->getOption('medialist_body_other');
		
		foreach ( $plugin->media as $medium )
		{
			$medium->refine();
			$data = array(
				'mime'			=> $medium->mime,
				'collection'	=> $medium->collection,
				'filename'		=> $medium->filename,
				'shortfilename'	=> Entity::shorten($medium->filename, 24, '...'),
				'prefix'		=> $medium->prefix,
				'name'			=> $medium->name,
				'suffix'		=> $medium->suffix,
				'timestamp'		=> date("Y-m-d", $medium->timestamp),
				'size'			=> round($medium->size / 1000),
				'width'			=> $medium->width,
				'height'		=> $medium->height,
				'mediumurl'		=> "{$CONF['MediaURL']}{$medium->collection}/{$medium->filename}"
			);
			
			if ( !array_key_exists($medium->mime, Media::$image_mime) )
			{
				$this->parser->parse(Template::fill($other_template, $data));
			}
			else
			{
				$this->parser->parse(Template::fill($image_template, $data));
			}
		}
		
		$data = array();
		$this->parser->parse(Template::fill($plugin->getOption('medialist_foot'), $data));
		
		return;
	}
	
	protected function checkCondition($field, $name='', $value = '')
	{
		global $manager;
		
		$plugin = $manager->getPlugin('NP_Medium');
		
		$condition = 0;
		switch ( $field )
		{
			case 'prev':
				$condition = (boolean) ($plugin->prev != $plugin->offset );
				break;
			case 'next':
				$condition = (boolean) $plugin->next;
				break;
			default:
				break;
		}
		return $condition;
	}
}
