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
 * A class representing a template
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group
 */

class TEMPLATE
{
    public $id;

    public function __construct($templateid)
    {
        $this->id = (int) $templateid;
    }

    public function getID()
    {
        return (int) $this->id;
    }

    // (static)
    public static function createFromName($name)
    {
        return new TEMPLATE(TEMPLATE::getIdFromName($name));
    }

    // (static)
    public static function getIdFromName($name)
    {
        $query = sprintf(
            "SELECT tdnumber FROM `%s` WHERE tdname='%s'",
            sql_table('template_desc'),
            sql_real_escape_string($name)
        );
        if (($res = sql_query($query)) && ($obj = sql_fetch_object($res))) {
            return $obj->tdnumber;
        }

        return 0;
    }

    /**
     * Updates the general information about the template
     */
    public function updateGeneralInfo($name, $desc)
    {
        sql_query(sprintf(
            "UPDATE %s SET tdname='%s', tddesc='%s' WHERE tdnumber=%d",
            sql_table('template_desc'),
            sql_real_escape_string($name),
            sql_real_escape_string($desc),
            $this->getID()
        ));
    }

    /**
     * Updates the contents of one part of the template
     */
    public function update($type, $content)
    {
        $id = $this->getID();

        // delete old thingie
        sql_query(sprintf(
            "DELETE FROM %s WHERE tpartname='%s' and tdesc=%d",
            sql_table('template'),
            sql_real_escape_string($type),
            (int) $id
        ));

        // write new thingie
        if (strlen($content) > 0) {
            $sql = sprintf(
                'INSERT INTO %s(tcontent, tpartname, tdesc) VALUES',
                sql_table('template')
            );

            sql_prepare_execute(
                $sql . '(?, ?, ?)',
                [$content, $type, (int) $id]
            );
        }
    }

    /**
     * Deletes all template parts from the database
     */
    public function deleteAllParts()
    {
        sql_query(
            sprintf(
                "DELETE FROM %s WHERE tdesc=%d",
                sql_table('template'),
                $this->getID()
            )
        );
    }

    /**
     * Creates a new template
     *
     * (static)
     */
    public static function createNew($name, $desc)
    {
        global $manager;

        $param = [
            'name'        => &$name,
            'description' => &$desc,
        ];
        $manager->notify('PreAddTemplate', $param);

        sql_query(sprintf(
            "INSERT INTO %s (tdname, tddesc) VALUES ('%s','%s')",
            sql_table('template_desc'),
            sql_real_escape_string($name),
            sql_real_escape_string($desc)
        ));
        $newId = sql_insert_id();

        $param = [
            'templateid'  => $newId,
            'name'        => $name,
            'description' => $desc,
        ];
        $manager->notify('PostAddTemplate', $param);

        return $newId;
    }

    /**
     * Reads a template and returns an array with the parts.
     * (static)
     *
     * @param $name name of the template file
     */
    public static function read(string $name): array
    {
        global $manager;
        static $rs = null;

        $param = [
            'template' => &$name,
        ];
        $manager->notify('PreTemplateRead', $param);

        if (isset($rs[$name])) {
            return $rs[$name];
        }

        $template = [];
        $res      = sql_query(sprintf(
            "SELECT tpartname, tcontent FROM `%s`, `%s` WHERE tdesc=tdnumber AND tdname='%s'",
            sql_table('template_desc'),
            sql_table('template'),
            sql_real_escape_string($name)
        ));
        while ($obj = sql_fetch_object($res)) {
            $template[$obj->tpartname] = $obj->tcontent;
        }

        // set locale according to template:
        if (isset($template['LOCALE'])) {
            setlocale(LC_TIME, $template['LOCALE']);
        } else {
            setlocale(LC_TIME, '');
        }

        $rs[$name] = $template;

        return $template;
    }

    /**
     * fills a template with values
     * (static)
     *
     * @param $template
     *                  Template to be used
     * @param $values
     *                  Array of all the values
     */
    public static function fill($template, $values)
    {
        if (null === $template) {
            return '';
        }
        if (0 != count($values)) {
            // go through all the values
            for (reset($values); $key = key($values); next($values)) {
                $template = str_replace("<%{$key}%>", $values[$key], $template);
            }
        }

        // remove non matched template-tags
        return preg_replace('/<%[a-zA-Z]+%>/', '', $template);
    }

    // returns true if there is a template with the given shortname
    // (static)
    public static function exists(string $name): bool
    {
        $res = sql_direct_getValue_AsInt(sprintf(
            "select count(*) as result FROM %s WHERE tdname='%s' limit 1",
            sql_table('template_desc'),
            sql_real_escape_string($name)
        ));
        return ((int) $res > 0);
    }

    // returns true if there is a template with the given ID
    // (static)
    public static function existsID(int $id): bool
    {
        $res = sql_direct_getValue_AsInt(sprintf(
            'SELECT count(*) AS result FROM %s WHERE tdnumber=%d LIMIT 1',
            sql_table('template_desc'),
            (int) $id
        ));
        return ((int) $res > 0);
    }

    // (static)
    public static function getNameFromId(int $id): string|false
    {
        $sql = sprintf(
            'SELECT tdname AS result FROM %s WHERE tdnumber=%d LIMIT 1',
            sql_table('template_desc'),
            (int) $id
        );
        $sth = sql_get_db()?->prepare($sql);
        if ($sth && $sth->execute() && ($res = $sth->fetch(PDO::FETCH_NUM))) {
            return (string) $res[0];
        }
        return false;
    }

    // (static)
    public static function getDesc(int $id): string|false
    {
        $sql = sprintf(
            'SELECT tddesc FROM %s WHERE tdnumber=%d LIMIT 1',
            sql_table('template_desc'),
            (int) $id
        );
        $sth = sql_get_db()?->prepare($sql);
        if ($sth && $sth->execute() && ($res = $sth->fetch(PDO::FETCH_NUM))) {
            return $res[0];
        }
        return false;
    }
}
