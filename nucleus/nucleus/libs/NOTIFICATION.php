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
 * Class used to represent a collection of e-mail addresses, to which a
 * message can be sent (e.g. comment or karma vote notification).
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 */
class NOTIFICATION {

	// array of addresses that need to get a notification
	var $addresses = array();

	/**
	  * takes one string as argument, containing multiple e-mail addresses
	  * separated by semicolons
	  * eg: site@demuynck.org;nucleus@demuynck.org;foo@bar.com
	  */
	function NOTIFICATION($addresses) {
		$this->addresses = i18n::explode(';' , $addresses);
	}

	/**
	  * returns true if all addresses are valid
	  */
	function validAddresses() {
		foreach ( $this->addresses as $address ) {
			if (!isValidMailAddress(trim($address)))
				return 0;
		}
		return 1;
	}

	/**
	  * Sends email messages to all the email addresses
	  */
	function notify($title, $message, $from)
	{
		global $member;
		$addresses = array();
		
		foreach ($this->addresses as $address)
		{
			if ( $member->isLoggedIn() && ($member->getEmail() == $address) )
			{
				continue;
			}
			$addresses[] = $address;
		}
		
		i18n::mail(implode(',', $addresses), $title, $message , $from);
		return;
	}
}

