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
 * PHP class responsible for ban-management.
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 */

class Ban
{
	/**
	 * Checks if a given IP is banned from commenting/voting
	 *
	 * Returns 0 when not banned, or a BanInfo object containing the
	 * message and other information of the ban
	 */
	public function isBanned($blogid, $ip)
	{
		$blogid = intval($blogid);
		$query = sprintf('SELECT * FROM %s WHERE blogid=%d', sql_table('ban'), intval($blogid));
		$res = DB::getResult($query);
		foreach ( $res as $row )
		{
			$found = i18n::strpos ($ip, $row['iprange']);
			if ( $found !== false )
			{
				// found a match!
				return new BanInfo($row['iprange'], $row['reason']);
			}
		}
		return 0;
	}

	/**
	 * Ban::addBan()
	 * Adds a new ban to the banlist. Returns 1 on success, 0 on error
	 * 
	 * @param	Integer	$blogid	ID for weblog
	 * @param	String 	$iprange	IP range
	 * @param	String 	$reason	reason for banning
	 * @return	Boolean
	 * 
	 */
	public function addBan($blogid, $iprange, $reason)
	{
		global $manager;
		
		$manager->notify(
			'PreAddBan',
			array(
				'blogid' => $blogid,
				'iprange' => &$iprange,
				'reason' => &$reason
			)
		);
		
		$query = 'INSERT INTO %s (blogid, iprange, reason) VALUES (%d, %s, %s)';
		$query = sprintf($query, sql_table('ban'), intval($blogid), DB::quoteValue($iprange), DB::quoteValue($reason));
		$res = DB::execute($query);
		
		$manager->notify(
			'PostAddBan',
			array(
				'blogid' => $blogid,
				'iprange' => $iprange,
				'reason' => $reason
			)
		);
		
		return $res !== FALSE ? 1 : 0;
	}
	
	/**
	 * Removes a ban from the banlist (correct iprange is needed as argument)
	 * Returns 1 on success, 0 on error
	 */
	public function removeBan($blogid, $iprange)
	{
		global $manager;
		
		$manager->notify(
			'PreDeleteBan',
			array(
				'blogid' => $blogid,
				'range' => $iprange
			)
		);
		
		$query = 'DELETE FROM %s WHERE blogid=%d and iprange=%s';
		$query = sprintf($query, sql_table('ban'), intval($blogid), DB::quoteValue($iprange));
		$res = DB::execute($query);
		
		$manager->notify(
			'PostDeleteBan',
			array(
				'blogid' => $blogid,
				'range' => $iprange
			)
		);
		
		return $res !== FALSE ? 1 : 0;
	}
}

class BanInfo
{
	public $iprange;
	public $message;
	
	public function __construct($iprange, $message)
	{
		$this->iprange = $iprange;
		$this->message = $message;
		return;
	}
}
