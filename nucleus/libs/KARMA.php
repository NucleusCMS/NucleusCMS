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
 * Class representing the karma votes for a certain item
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group
 */
class KARMA
{
    // id of item about which this object contains information
    public $itemid;

    // indicates if the karma vote info has already been intialized from the DB
    public $inforead;

    // amount of positive/negative votes
    public $karmapos;
    public $karmaneg;

    public function __construct($itemid, $initpos = 0, $initneg = 0, $initread = 0)
    {
        // itemid
        $this->itemid = (int)$itemid;

        // have we read the karma info yet?
        $this->inforead = (int)$initread;

        // number of positive and negative votes
        $this->karmapos = (int)$initpos;
        $this->karmaneg = (int)$initneg;
    }

    public function getNbPosVotes()
    {
        if (!$this->inforead) {
            $this->readFromDatabase();
        }
        return $this->karmapos;
    }
    public function getNbNegVotes()
    {
        if (!$this->inforead) {
            $this->readFromDatabase();
        }
        return $this->karmaneg;
    }
    public function getNbOfVotes()
    {
        if (!$this->inforead) {
            $this->readFromDatabase();
        }
        return ($this->karmapos + $this->karmaneg);
    }
    public function getTotalScore()
    {
        if (!$this->inforead) {
            $this->readFromDatabase();
        }
        return ($this->karmapos - $this->karmaneg);
    }

    public function setNbPosVotes($val)
    {
        $this->karmapos = (int)$val;
    }
    public function setNbNegVotes($val)
    {
        $this->karmaneg = (int)$val;
    }

    // adds a positive vote
    public function votePositive()
    {
        $newKarma = $this->getNbPosVotes() + 1;
        $this->setNbPosVotes($newKarma);
        $this->writeToDatabase();
        $this->saveIP();
    }

    // adds a negative vote
    public function voteNegative()
    {
        $newKarma = $this->getNbNegVotes() + 1;
        $this->setNbNegVotes($newKarma);
        $this->writeToDatabase();
        $this->saveIP();
    }

    // these methods shouldn't be called directly
    public function readFromDatabase()
    {
        $query = 'SELECT ikarmapos, ikarmaneg FROM '.sql_table('item').' WHERE inumber=' . $this->itemid;
        $res   = sql_query($query);
        $obj   = sql_fetch_object($res);

        $this->karmapos = $obj->ikarmapos;
        $this->karmaneg = $obj->ikarmaneg;
        $this->inforead = 1;
    }

    public function writeToDatabase()
    {
        $query = 'UPDATE '.sql_table('item').' SET ikarmapos=' . $this->karmapos . ', ikarmaneg='.$this->karmaneg.' WHERE inumber=' . $this->itemid;
        sql_query($query);
    }

    // checks if a vote is still allowed for an IP
    public function isVoteAllowed($ip)
    {
        $sql = 'SELECT count(*) AS result FROM ' . sql_table('karma')
             . sprintf(" WHERE itemid=%d AND ip='%s' LIMIT 1", $this->itemid, sql_real_escape_string($ip));
        return (intval(quickQuery($sql)) == 0);
    }

    // save IP in database so no multiple votes are possible
    public function saveIP()
    {
        $query = 'INSERT INTO '.sql_table('karma').' (itemid, ip) VALUES ('.$this->itemid.",'".sql_real_escape_string(serverVar('REMOTE_ADDR'))."')";
        sql_query($query);
    }
}
