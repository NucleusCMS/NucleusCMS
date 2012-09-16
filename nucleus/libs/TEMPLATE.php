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
 * A class representing a template
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 */
class TEMPLATE {

	var $id;

	function TEMPLATE($templateid) {
		$this->id = intval($templateid);
	}

	function getID() {
		return intval($this->id);
	}

	// (static)
	function createFromName($name) {
		return new TEMPLATE(TEMPLATE::getIdFromName($name));
	}

	// (static)
	function getIdFromName($name) {
		$query =  'SELECT tdnumber'
			   . ' FROM '.sql_table('template_desc')
			   . ' WHERE tdname="'.sql_real_escape_string($name).'"';
		$res = sql_query($query);
		$obj = sql_fetch_object($res);
		return $obj->tdnumber;
	}

	/**
	 * Updates the general information about the template
	 */
	function updateGeneralInfo($name, $desc) {
		$query =  'UPDATE '.sql_table('template_desc').' SET'
			   . " tdname='" . sql_real_escape_string($name) . "',"
			   . " tddesc='" . sql_real_escape_string($desc) . "'"
			   . " WHERE tdnumber=" . $this->getID();
		sql_query($query);
	}

	/**
	 * Updates the contents of one part of the template
	 */
	function update($type, $content) {
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
	function deleteAllParts() {
		sql_query('DELETE FROM '.sql_table('template').' WHERE tdesc='.$this->getID());
	}

	/**
	 * Creates a new template
	 *
	 * (static)
	 */
	function createNew($name, $desc) {
		global $manager;
		
		$data = array(
			'name'			=> &$name,
			'description'	=> &$desc
		);
		
		$manager->notify('PreAddTemplate', $data);

		sql_query('INSERT INTO '.sql_table('template_desc')." (tdname, tddesc) VALUES ('" . sql_real_escape_string($name) . "','" . sql_real_escape_string($desc) . "')");
		$newId = sql_insert_id();

		$data = array(
			'templateid'	=> $newId,
			'name'			=> $name,
			'description'	=> $desc
		);
		$manager->notify('PostAddTemplate', $data);

		return $newId;
	}



	/**
	 * Reads a template and returns an array with the parts.
	 * (static)
	 *
	 * @param $name name of the template file
	 */
	function read($name) {
		global $manager;
		$data = array('template' => &$name);
		$manager->notify('PreTemplateRead', $data);

		$query = 'SELECT tpartname, tcontent'
			   . ' FROM '.sql_table('template_desc').', '.sql_table('template')
			   . ' WHERE tdesc=tdnumber and tdname="' . sql_real_escape_string($name) . '"';
		$res = sql_query($query);
		while ($obj = sql_fetch_object($res))
			$template[$obj->tpartname] = $obj->tcontent;

		// set locale according to template:
		if (isset($template['LOCALE']))
			setlocale(LC_TIME,$template['LOCALE']);
		else
			setlocale(LC_TIME,'');

		return $template;
	}

	/**
	  * fills a template with values
	  * (static)
	  *
	  * @param $template
	  *		Template to be used
	  * @param $values
	  *		Array of all the values
	  */
	function fill($template, $values) {

		if (sizeof($values) != 0) {
			// go through all the values
			for(reset($values); $key = key($values); next($values)) {
				$template = str_replace("<%$key%>",$values[$key],$template);
			}
		}

		// remove non matched template-tags
		return preg_replace('/<%[a-zA-Z]+%>/','',$template);
	}

	// returns true if there is a template with the given shortname
	// (static)
	function exists($name) {
		$r = sql_query('select * FROM '.sql_table('template_desc').' WHERE tdname="'.sql_real_escape_string($name).'"');
		return (sql_num_rows($r) != 0);
	}

	// returns true if there is a template with the given ID
	// (static)
	function existsID($id) {
		$r = sql_query('select * FROM '.sql_table('template_desc').' WHERE tdnumber='.intval($id));
		return (sql_num_rows($r) != 0);
	}

	// (static)
	function getNameFromId($id) {
		return quickQuery('SELECT tdname as result FROM '.sql_table('template_desc').' WHERE tdnumber=' . intval($id));
	}

	// (static)
	function getDesc($id) {
		$query = 'SELECT tddesc FROM '.sql_table('template_desc').' WHERE tdnumber='. intval($id);
		$res = sql_query($query);
		$obj = sql_fetch_object($res);
		return $obj->tddesc;
	}



}

?>