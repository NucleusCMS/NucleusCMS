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
        $this->id = (int)$templateid;
    }

    public function getID()
    {
        return intval($this->id);
    }

    // (static)
    public static function createFromName($name)
    {
        return new TEMPLATE(TEMPLATE::getIdFromName($name));
    }

    // (static)
    public static function getIdFromName($name)
    {
        $query = 'SELECT tdnumber'
               . ' FROM '.sql_table('template_desc')
               . ' WHERE tdname="'.sql_real_escape_string($name).'"';
        $res = sql_query($query);
        $obj = sql_fetch_object($res);
        return $obj->tdnumber;
    }

    /**
     * Updates the general information about the template
     */
    public function updateGeneralInfo($name, $desc)
    {
        $query = 'UPDATE '.sql_table('template_desc').' SET'
               . " tdname='" . sql_real_escape_string($name) . "',"
               . " tddesc='" . sql_real_escape_string($desc) . "'"
               . " WHERE tdnumber=" . $this->getID();
        sql_query($query);
    }

    /**
     * Updates the contents of one part of the template
     */
    public function update($type, $content)
    {
        $id = $this->getID();

        // delete old thingie
        sql_query('DELETE FROM '.sql_table('template')." WHERE tpartname='". sql_real_escape_string($type) ."' and tdesc=" . intval($id));

        // write new thingie
        if ($content) {
            sql_query('INSERT INTO '.sql_table('template')." SET tcontent='" . sql_real_escape_string($content) . "', tpartname='" . sql_real_escape_string($type) . "', tdesc=" . intval($id));
        }
    }

    /**
     * Deletes all template parts from the database
     */
    public function deleteAllParts()
    {
        sql_query('DELETE FROM '.sql_table('template').' WHERE tdesc='.$this->getID());
    }

    /**
     * Creates a new template
     *
     * (static)
     */
    public static function createNew($name, $desc)
    {
        global $manager;

        $param = array(
            'name'        => &$name,
            'description' => &$desc
        );
        $manager->notify('PreAddTemplate', $param);

        sql_query('INSERT INTO '.sql_table('template_desc')." (tdname, tddesc) VALUES ('" . sql_real_escape_string($name) . "','" . sql_real_escape_string($desc) . "')");
        $newId = sql_insert_id();

        $param = array(
            'templateid'  => $newId,
            'name'        => $name,
            'description' => $desc
        );
        $manager->notify('PostAddTemplate', $param);

        return $newId;
    }

    /**
     * Reads a template and returns an array with the parts.
     * (static)
     *
     * @param $name name of the template file
     */
    public static function read($name)
    {
        global $manager;

        $param = array(
            'template' => &$name
        );
        $manager->notify('PreTemplateRead', $param);

        $template = array();
        $query    = 'SELECT tpartname, tcontent'
               . ' FROM '.sql_table('template_desc').', '.sql_table('template')
               . ' WHERE tdesc=tdnumber and tdname="' . sql_real_escape_string($name) . '"';
        $res = sql_query($query);
        while ($obj = sql_fetch_object($res)) {
            $template[$obj->tpartname] = $obj->tcontent;
        }

        // set locale according to template:
        if (isset($template['LOCALE'])) {
            setlocale(LC_TIME, $template['LOCALE']);
        } else {
            setlocale(LC_TIME, '');
        }

        return $template;
    }

    /**
      * fills a template with values
      * (static)
      *
      * @param $template
      *        Template to be used
      * @param $values
      *        Array of all the values
      */
    public static function fill($template, $values)
    {
        if (count($values) != 0) {
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
    public static function exists($name)
    {
        $sql = 'select count(*) as result FROM '.sql_table('template_desc')
              . sprintf(" WHERE tdname='%s' limit 1", sql_real_escape_string($name));
        $res = quickQuery($sql);
        return (intval($res) > 0);
    }

    // returns true if there is a template with the given ID
    // (static)
    public static function existsID($id)
    {
        $sql = 'select count(*) as result FROM '.sql_table('template_desc')
              . sprintf(" WHERE tdnumber=%d limit 1", intval($id));
        $res = quickQuery($sql);
        return (intval($res) > 0);
    }

    // (static)
    public static function getNameFromId($id)
    {
        return quickQuery('SELECT tdname as result FROM '.sql_table('template_desc').' WHERE tdnumber=' . intval($id));
    }

    // (static)
    public static function getDesc($id)
    {
        $query = 'SELECT tddesc FROM '.sql_table('template_desc').' WHERE tdnumber='. intval($id);
        $res   = sql_query($query);
        $obj   = sql_fetch_object($res);
        return $obj->tddesc;
    }
}
