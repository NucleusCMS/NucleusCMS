<?

/**
  * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/) 
  * Copyright (C) 2002 The Nucleus Group
  *
  * This program is free software; you can redistribute it and/or
  * modify it under the terms of the GNU General Public License
  * as published by the Free Software Foundation; either version 2
  * of the License, or (at your option) any later version.
  * (see nucleus/documentation/index.html#license for more info)
  *
  * Class used to represent a collection of e-mail addresses, to which a
  * message can be sent (e.g. comment or karma vote notification).
  */
class NOTIFICATION {

	/**
	  * takes one string as argument, containing multiple e-mail addresses
	  * separated by semicolons
	  * eg: site@demuynck.org;nucleus@demuynck.org;foo@bar.com
	  */
	function NOTIFICATION($addresses) {
		$this->addresses = explode(';' , $addresses);
	}

	/**
	  * returns true if all addresses are valid
	  */
	function validAddresses() {
		foreach ( $this->addresses as $address ) {
			if (!isValidMailAddress($address)) 
				return 0;
		}
		return 1;
	}
	
	/**
	  * Sends email messages to all the email addresses
	  */
	function notify($title, $message, $from) {
		foreach ( $this->addresses as $address ) {
			@mail($address, $title, $message , "From: ". $from . "\nContent-Type: text/plain; charset=iso-8859-1");
		}
	}
}

?>