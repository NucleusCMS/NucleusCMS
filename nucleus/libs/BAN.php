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
 */
/**
 * PHP class responsible for ban-management.
 */

class BAN
{
    /**
      * Checks if a given IP is banned from commenting/voting
      *
      * Returns false when not banned, or a BANINFO object containing the
      * message and other information of the ban
      */
    public static function isBanned($blogid, $ip): object|false
    {
        $blogid = (int) $blogid;
        $query  = sprintf(
            'SELECT * FROM `%s` WHERE blogid=%d',
            sql_table('ban'),
            $blogid
        );
        if ($res = sql_query($query)) {
            while ($obj = sql_fetch_object($res)) {
                $found = (0 === strncmp($ip, $obj->iprange, strlen($obj->iprange)));
                if ( ! (false === $found)) {
                    // found a match!
                    return new BANINFO($obj->iprange, $obj->reason);
                }
            }
        }
        return false;
    }

    /**
      * Adds a new ban to the banlist. Returns 1 on success, 0 on error
      */
    public static function addBan($blogid, $iprange, $reason)
    {
        global $manager;
        $blogid = (int) $blogid;

        $notify_data = [
                'blogid'  => $blogid,
                'iprange' => &$iprange,
                'reason'  => &$reason,
            ];
        $manager->notify('PreAddBan', $notify_data);

        $query = sprintf(
            'INSERT INTO `%s` (blogid, iprange, reason) VALUES( %d , ? , ? ) ',
            sql_table('ban'),
            $blogid
        );
        $res = sql_prepare_execute($query, [$iprange, $reason]);

        $notify_data = [
                'blogid'  => $blogid,
                'iprange' => $iprange,
                'reason'  => $reason,
            ];
        $manager->notify('PostAddBan', $notify_data);

        return $res ? 1 : 0;
    }

    /**
      * Removes a ban from the banlist (correct iprange is needed as argument)
      * Returns 1 on success, 0 on error
      */
    public static function removeBan($blogid, $iprange)
    {
        global $manager;
        $blogid = (int) $blogid;

        $notify_data = [
            'blogid' => $blogid,
            'range'  => $iprange,
        ];
        $manager->notify('PreDeleteBan', $notify_data);

        $sql    = sprintf('DELETE FROM `%s` WHERE blogid=:blogid AND iprange=:iprange', sql_table('ban'));
        $res    = sql_prepare_execute($sql, [':blogid' => $blogid, ':iprange' => $iprange]);
        $result = (sql_affected_rows($res) > 0);

        $notify_data = [
            'blogid' => $blogid,
            'range'  => $iprange,
        ];
        $manager->notify('PostDeleteBan', $notify_data);

        return $result;
    }
}

class BANINFO
{
    public $iprange;
    public $message;

    public function __construct($iprange, $message)
    {
        $this->iprange = $iprange;
        $this->message = $message;
    }
}
