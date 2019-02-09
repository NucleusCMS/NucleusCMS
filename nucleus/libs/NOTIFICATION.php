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
 * Class used to represent a collection of e-mail addresses, to which a
 * message can be sent (e.g. comment or karma vote notification).
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group
 */
class NOTIFICATION {

    // array of addresses that need to get a notification
    public $addresses = array();

    /**
      * takes one string as argument, containing multiple e-mail addresses
      * separated by semicolons
      * eg: site@demuynck.org;nucleus@demuynck.org;foo@bar.com
      */
    function __construct($addresses) {
        $this->addresses = explode(';' , $addresses);
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
    function notify($title, $message, $from) {
        global $member;

        foreach ( $this->addresses as $address ) {
            $address = trim($address);

            if (!$address)
                continue;

            // don't send messages to yourself
            if ($member->isLoggedIn() && ($member->getEmail() == $address))
                continue;

            @Utils::mail($address, $title, $message , "From: ". $from);
        }
    }
}
