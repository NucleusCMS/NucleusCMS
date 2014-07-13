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

class BAN {

	/**
	  * Checks if a given IP is banned from commenting/voting
	  *
	  * Returns 0 when not banned, or a BANINFO object containing the
	  * message and other information of the ban
	  */
	function isBanned($blogid, $ip) {
		$blogid = intval($blogid);
		$query = 'SELECT * FROM '.sql_table('ban').' WHERE blogid='.$blogid;
		$res = sql_query($query);
		while ($obj = sql_fetch_object($res)) {
			$found = ! strncmp($ip, $obj->iprange, strlen($obj->iprange));
			if (!($found === false))
				// found a match!
					return new BANINFO($obj->iprange, $obj->reason);
		}
		return 0;
	}

	/**
	  * Adds a new ban to the banlist. Returns 1 on success, 0 on error
	  */
	function addBan($blogid, $iprange, $reason) {
		global $manager;

		$blogid = intval($blogid);

		$data = array(
			'blogid'	=> $blogid,
			'iprange'	=> &$iprange,
			'reason'	=> &$reason
		);
		$manager->notify('PreAddBan', $data);

		$query = 'INSERT INTO '.sql_table('ban')." (blogid, iprange, reason) VALUES "
			   . "($blogid,'".sql_real_escape_string($iprange)."','".sql_real_escape_string($reason)."')";
		$res = sql_query($query);

		$data = array(
			'blogid'	=> $blogid,
			'iprange'	=> $iprange,
			'reason'	=> $reason
		);
		$manager->notify('PostAddBan', $data);

		return $res ? 1 : 0;
	}

	/**
	  * Removes a ban from the banlist (correct iprange is needed as argument)
	  * Returns 1 on success, 0 on error
	  */
	function removeBan($blogid, $iprange) {
		global $manager;
		$blogid = intval($blogid);

		$data = array(
			'blogid'	=> $blogid,
			'range'		=> $iprange
		);
		$manager->notify('PreDeleteBan', $data);

		$query = 'DELETE FROM '.sql_table('ban')." WHERE blogid=$blogid and iprange='" .sql_real_escape_string($iprange). "'";
		sql_query($query);

		$result = (sql_affected_rows() > 0);

		$data = array(
		'blogid'	=> $blogid,
		'range'		=> $iprange
		);
		$manager->notify('PostDeleteBan', $data);

		return $result;
	}
}

class BANINFO {
	var $iprange;
	var $message;

	function BANINFO($iprange, $message) {
		$this->iprange = $iprange;
		$this->message = $message;
	}
}


?>