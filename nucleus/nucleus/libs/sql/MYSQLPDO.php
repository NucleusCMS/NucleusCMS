<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2012 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */
/**
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2012 The Nucleus Group
 * @version $Id$
 */

if ( !class_exists('PDO') )
{

	/**
	 * Dummy constant of the PDO class
	 */
	class PDO
	{
		/* constant values */
		const PARAM_NULL = 0;
		const PARAM_INT = 1;
		const PARAM_STR = 2;
		const PARAM_LOB = 3;
		const PARAM_STMT = 4;
		const PARAM_BOOL = 5;
		const PARAM_INPUT_OUTPUT = 128; // orignal is undefined.
		const FETCH_LAZY = 1;
		const FETCH_ASSOC = 2;
		const FETCH_NUM = 3;
		const FETCH_BOTH = 4;
		const FETCH_OBJ = 5;
		const FETCH_BOUND = 6;
		const FETCH_COLUMN = 7;
		const FETCH_CLASS = 8;
		const FETCH_INTO = 9;
		const FETCH_FUNC = 10;
		const FETCH_NAMED = 11;
		const FETCH_KEY_PAIR = 12;
		const FETCH_GROUP = 65536;
		const FETCH_UNIQUE = 196608;
		const FETCH_CLASSTYPE = 262144;
		const FETCH_SERIALIZE = 524288;
		const FETCH_PROPS_LATE = 1048576;
		const ATTR_AUTOCOMMIT = 0;
		const ATTR_PREFETCH = 1;
		const ATTR_TIMEOUT = 2;
		const ATTR_ERRMODE = 3;
		const ATTR_SERVER_VERSION = 4;
		const ATTR_CLIENT_VERSION = 5;
		const ATTR_SERVER_INFO = 6;
		const ATTR_CONNECTION_STATUS = 7;
		const ATTR_CASE = 8;
		const ATTR_CURSOR_NAME = 9;
		const ATTR_CURSOR = 10;
		const ATTR_ORACLE_NULLS = 11;
		const ATTR_PERSISTENT = 12;
		const ATTR_STATEMENT_CLASS = 13;
		const ATTR_FETCH_TABLE_NAMES = 14;
		const ATTR_FETCH_CATALOG_NAMES = 15;
		const ATTR_DRIVER_NAME = 16;
		const ATTR_STRINGIFY_FETCHES = 17;
		const ATTR_MAX_COLUMN_LEN = 18;
		const ATTR_DEFAULT_FETCH_MODE = 19;
		const ATTR_EMULATE_PREPARES = 20;
		const ERRMODE_SILENT = 0;
		const ERRMODE_WARNING = 1;
		const ERRMODE_EXCEPTION = 2;
		const CASE_NATURAL = 0;
		const CASE_UPPER = 1;
		const CASE_LOWER = 2;
		const NULL_NATURAL = 0;
		const NULL_EMPTY_STRING = 1;
		const NULL_TO_STRING = 2;
		const FETCH_ORI_NEXT = 0;
		const FETCH_ORI_PRIOR = 1;
		const FETCH_ORI_FIRST = 2;
		const FETCH_ORI_LAST = 3;
		const FETCH_ORI_ABS = 4;
		const FETCH_ORI_REL = 5;
		const CURSOR_FWDONLY = 0;
		const CURSOR_SCROLL = 1;
		// from here orignal is undefined.
		const ERR_CANT_MAP = 0;
		const ERR_SYNTAX = 0;
		const ERR_CONSTRAINT = 0;
		const ERR_NOT_FOUND = 0;
		const ERR_ALREADY_EXISTS = 0;
		const ERR_NOT_IMPLEMENTED = 0;
		const ERR_MISMATCH = 0;
		const ERR_TRUNCATED = 0;
		const ERR_DISCONNECTED = 0;
		const ERR_NO_PERM = 0;
		// so far
		const ERR_NONE = '00000';
		const PARAM_EVT_ALLOC = 0;
		const PARAM_EVT_FREE = 1;
		const PARAM_EVT_EXEC_PRE = 2;
		const PARAM_EVT_EXEC_POST = 3;
		const PARAM_EVT_FETCH_PRE = 4;
		const PARAM_EVT_FETCH_POST = 5;
		const PARAM_EVT_NORMALIZE = 6;

		const MYSQL_ATTR_INIT_COMMAND = 1002;
	}

	/**
	 * PDOException class of dummy
	 */
	class PDOException extends Exception
	{}
}

/**
 * MysqlPDO class that wraps the mysql_ or mysqli_ function like PDO class
 */
class MysqlPDO
{
	// Prefix function name
	public static $handler;

	private $dbcon;

	/**
	 * Creates a PDO instance representing a connection to a MySQL database.
	 * @param string $dsn DSN
	 * @param string $username UserName
	 * @param string $password Password
	 * @param mixed $driver_options Options[optional]
	 * @throws PDOException Thrown when failed to connect to the database.
	 */
	public function __construct($dsn, $username, $password, $driver_options = '')
	{
		// select use function
		if ( function_exists('mysql_query') )
		{
			MysqlPDO::$handler = 'mysql_';
		}
		else if ( function_exists('mysqli_query') )
		{
			MysqlPDO::$handler = 'mysqli_';
		}
		else
		{
			throw new PDOException('Can not be found mysql_ or mysqli_ functions.', 'IM000');
		}

		if ( preg_match('/host=([^;]+)/', $dsn, $matches) )
		{
			$host = $matches[1];
		}
		else
		{
			throw new PDOException('Host has not been set.', '01000');
		}
		if ( preg_match('/port=([^;]+)/', $dsn, $matches) )
		{
			$host .= ':' . $matches[1];
		}

		// mysql connect
		$this->dbcon = @call_user_func(MysqlPDO::$handler . 'connect', $host, $username, $password);

		if ( $this->dbcon == FALSE )
		{
			throw new PDOException('Failed to connect to the server.', '01000');
		}

		// select database
		if ( preg_match('/dbname=([^;]+)/', $dsn, $matches) )
		{
			$dbname = $matches[1];
			if ( $dbname )
			{
				if ( MysqlPDO::$handler == 'mysql_' )
				{
					call_user_func(MysqlPDO::$handler . 'select_db', $dbname, $this->dbcon);
				}
				else
				{
					call_user_func(MysqlPDO::$handler . 'select_db', $this->dbcon, $dbname);
				}

				// set use character
				$charset = 'utf8';
				if ( is_array($driver_options) && array_key_exists(PDO::MYSQL_ATTR_INIT_COMMAND, $driver_options) )
				{
					if ( preg_match('/SET\s+CHARACTER\s+SET\s+\'?([a-z0-9_-]+)\'?/', $driver_options[PDO::MYSQL_ATTR_INIT_COMMAND], $matches) )
					{
						$charset = $matches[1];
					}
				}
				$server_info = call_user_func(MysqlPDO::$handler . 'get_server_info', $this->dbcon);
				$mysql_version = preg_replace('/^([0-9]{1,2})\.([0-9]{1,2})\.([0-9]{1,2})(.*)$/', '$1.$2.$3', $server_info);

				if ( version_compare($mysql_version, '5.0.7', '>=') && function_exists(MysqlPDO::$handler . 'set_charset') )
				{
					call_user_func(MysqlPDO::$handler . 'set_charset', $charset);
				}
				else if ( version_compare($mysql_version, '5.0.7', '<') )
				{
					$this->exec("SET CHARACTER SET '{$charset}';");
				}
				else
				{
					$this->exec("SET NAMES '{$charset}';");
				}
			}
		}
	}

	/**
	 * Close the connection to the MySQL server.
	 */
	public function __destruct()
	{
		if ( $this->dbcon )
		{
			@call_user_func(MysqlPDO::$handler . 'close', $this->dbcon);
		}
	}

	/**
	 * Not supported
	 */
	public function beginTransaction()
	{
		return FALSE;
	}

	/**
	 * Not supported
	 */
	public function commit()
	{
		return FALSE;
	}

	/**
	 * Fetch the SQLSTATE associated with the last operation.
	 * However, if successful '00000' Otherwise, the return to '01000'.
	 * @return string Error code
	 */
	public function errorCode()
	{
		$errno = call_user_func(MysqlPDO::$handler . 'errno', $this->dbcon);
		return $errno === 0 ? '00000' : '01000';
	}

	/**
	 * To get extended error information associated with the last operation.
	 * Element 0: if successful '00000' Otherwise, the return to '01000'
	 * Element 1: The return value of mysql_errno()
	 * Element 2: The return value of mysql_error()
	 * @return array Array of error information
	 */
	public function errorInfo()
	{
		$errno = call_user_func(MysqlPDO::$handler . 'errno', $this->dbcon);
		$error = call_user_func(MysqlPDO::$handler . 'error', $this->dbcon);
		return array($errno === 0 ? '00000' : '01000', $errno, $error);
	}

	public function exec($statement)
	{
		$result = @call_user_func(MysqlPDO::$handler . 'query', $statement, $this->dbcon);
		if ( $result === TRUE )
		{
			return @call_user_func(MysqlPDO::$handler . 'affected_rows', $this->dbcon);
		}
		else if ( is_resource($result) )
		{
			return;
		}
		return FALSE;
	}

	public function getAttribute($attribute)
	{
		switch ( $attribute )
		{
			case PDO::ATTR_SERVER_VERSION:
				return call_user_func(MysqlPDO::$handler . 'get_server_info', $this->dbcon);
				break;
			case PDO::ATTR_CLIENT_VERSION:
				return call_user_func(MysqlPDO::$handler . 'get_client_info');
				break;
			default:
				return FALSE;
		}
	}

	public static function getAvailableDrivers()
	{
		return array('mysql');
	}

	/**
	 * Not supported
	 */
	public function inTransaction()
	{
		return FALSE;
	}

	public function lastInsertId($name = null)
	{
		return call_user_func(MysqlPDO::$handler . 'insert_id', $this->dbcon);
	}

	/**
	 * Not supported
	 */
	public function prepare($statement, $driver_options = array())
	{
		return FALSE;
	}

	public function query($statement)
	{
		$result = @call_user_func(MysqlPDO::$handler . 'query', $statement, $this->dbcon);
		return ($result == FALSE) ? FALSE : new MysqlPDOStatement($statement, $result, $this->dbcon);
	}

	public function quote($string, $parameter_type = PDO::PARAM_STR)
	{
		switch ( $parameter_type )
		{
			case PDO::PARAM_NULL:
				return 'null';
			case PDO::PARAM_BOOL:
				return $string ? '1' : '0';
			default:
				if ( $parameter_type == PDO::PARAM_INT && is_numeric($string) )
				{
					return $string;
				}
				else
				{
					return '\'' . call_user_func(MysqlPDO::$handler . 'real_escape_string', $string) . '\'';
				}
		}
	}

	/**
	 * Not supported
	 */
	public function rollBack()
	{
		return FALSE;
	}

	/**
	 * Not supported
	 */
	public function setAttribute($attribute, $value)
	{
		return FALSE;
	}
}

/**
 * MysqlPDOStatement class PDOStatement class like.
 */
class MysqlPDOStatement implements Iterator
{
	private $result;
	private $dbcon;
	private $_queryString = '';

	private $def_fetch_mode = PDO::FETCH_BOTH;
	private $def_col_num = 0;
	private $def_class_name = 'stdClass';
	private $def_ctorargs = null;
	private $bind_object = null;

	public function __get($name)
	{
		if ( $name == 'queryString' )
		{
			return $this->_queryString;
		}
	}

	public function __construct($query, $result, $dbconnect = null)
	{
		$this->dbcon = $dbconnect;
		$this->_queryString = $query;
		$this->result = $result;
	}

	public function __destruct()
	{
		$this->result = null;
	}

	/**
	 * Not supported
	 */
	public function bindColumn($column, &$param, $type, $maxlen, $driverdata)
	{
		return FALSE;
	}

	/**
	 * Not supported
	 */
	public function bindParam($parameter, &$variable, $data_type = PDO::PARAM_STR, $length, $driver_options)
	{
		return FALSE;
	}

	/**
	 * Not supported
	 */
	public function bindValue($parameter, $value, $data_type = PDO::PARAM_STR)
	{
		return FALSE;
	}

	public function closeCursor()
	{
		return call_user_func(MysqlPDO::$handler . 'free_result', $this->result);
	}

	public function columnCount()
	{
		return call_user_func(MysqlPDO::$handler . 'num_fields', $this->result);
	}

	/**
	 * Not supported
	 */
	public function debugDumpParams()
	{
		return;
	}

	public function errorCode()
	{
		$errno = call_user_func(MysqlPDO::$handler . 'errno', $this->dbcon);
		return $errno === 0 ? '00000' : '01000';
	}

	public function errorInfo()
	{
		$errno = call_user_func(MysqlPDO::$handler . 'errno', $this->dbcon);
		$error = call_user_func(MysqlPDO::$handler . 'error', $this->dbcon);
		return array($errno === 0 ? '00000' : '01000', $errno, $error);
	}

	/**
	 * Not supported
	 */
	public function execute($input_parameters)
	{
		return FALSE;
	}

	public function fetch($fetch_style = PDO::ATTR_DEFAULT_FETCH_MODE, $cursor_orientation = PDO::FETCH_ORI_NEXT, $cursor_offset = 0)
	{
		if ( !is_resource($this->result) || $cursor_orientation != PDO::FETCH_ORI_NEXT )
		{
			return FALSE;
		}
		
		if ( $fetch_style == PDO::ATTR_DEFAULT_FETCH_MODE )
		{
			$fetch_style = $this->def_fetch_mode;
		}

		switch ( $fetch_style )
		{
			case PDO::FETCH_ASSOC:
				return @call_user_func(MysqlPDO::$handler . 'fetch_array', $this->result, MYSQL_ASSOC);
			case PDO::FETCH_BOTH:
				return @call_user_func(MysqlPDO::$handler . 'fetch_array', $this->result, MYSQL_BOTH);
			case PDO::FETCH_NUM:
				return @call_user_func(MysqlPDO::$handler . 'fetch_array', $this->result, MYSQL_NUM);
			case PDO::FETCH_OBJ:
				return $this->fetchObject();
			case PDO::FETCH_CLASS:
				return $this->fetchObject($this->def_class_name, $this->def_ctorargs);
			case PDO::FETCH_COLUMN:
				return $this->fetchColumn($this->def_col_num);
			case PDO::FETCH_BOUND:
				return FALSE; // Not supported
			case PDO::FETCH_INTO:
				return FALSE; // Not supported
			case PDO::FETCH_LAZY:
				return FALSE; // Not supported
			default:
				return FALSE;
		}
	}

	public function fetchAll($fetch_style = PDO::ATTR_DEFAULT_FETCH_MODE, $fetch_argument = null, $ctor_args = array())
	{
		if ( $fetch_style == PDO::ATTR_DEFAULT_FETCH_MODE )
		{
			$fetch_style = PDO::FETCH_BOTH;
		}
		
		$ret = array();
		if ( ($fetch_style & PDO::FETCH_COLUMN) != 0 )
		{
			if ( $fetch_style == PDO::FETCH_COLUMN )
			{
				$column = $fetch_argument == null ? 0 : intval($fetch_argument);
				while ( $row = $this->fetchColumn($column) )
				{
					$ret[] = $row;
				}
			}
			elseif ( ($fetch_style & PDO::FETCH_UNIQUE) != 0 )
			{
				return FALSE;
			}
			elseif ( ($fetch_style & PDO::FETCH_GROUP) != 0 )
			{
				return FALSE;
			}
		}
		elseif ( $fetch_style == PDO::FETCH_CLASS )
		{
			while ( $row = $this->fetchObject($fetch_argument, $ctor_args) )
			{
				$ret[] = $row;
			}
		}
		elseif ( $fetch_style == PDO::FETCH_FUNC )
		{
			while ( $row = $this->fetch(PDO::FETCH_ASSOC) )
			{
				$ret[] = call_user_func_array($fetch_argument, array_values($row));
			}
		}
		else
		{
			while ( $row = $this->fetch($fetch_style) )
			{
				$ret[] = $row;
			}
		}
		return $ret;
	}

	public function fetchColumn($column_number = 0)
	{
		if ( $ret = $this->fetch(PDO::FETCH_NUM) )
		{
			return $ret[$column_number];
		}
		return FALSE;
	}

	public function fetchObject($class_name = 'stdClass', $ctor_args = null)
	{
		if ( is_array($ctor_args) && !empty($ctor_args) )
		{
			return @call_user_func(MysqlPDO::$handler . 'fetch_object', $this->result, $class_name, $ctor_args);
		}
		else
		{
			return @call_user_func(MysqlPDO::$handler . 'fetch_object', $this->result, $class_name);
		}
	}

	public function getAttribute($attribute)
	{
		switch ( $attribute )
		{
			default:
				return FALSE;
		}
	}

	/**
	 * Not supported
	 */
	public function getColumnMeta($column)
	{
		$result = array();
		if ( MysqlPDO::$handler == 'mysql_' )
		{
			$result['name'] = @call_user_func(MysqlPDO::$handler . 'field_name', $this->result, $column);
		}
		return $result;
	}

	/**
	 * Not supported
	 */
	public function nextRowset()
	{
		return FALSE;
	}

	public function rowCount()
	{
		return @call_user_func(MysqlPDO::$handler . 'affected_rows', $this->dbcon);
	}

	/**
	 * Not supported
	 */
	public function setAttribute($attribute, $value)
	{
		return FALSE;
	}

	public function setFetchMode($mode, &$mode_argument, $ctorargs)
	{
		switch ( $mode )
		{
			case PDO::FETCH_COLUMN:
				$this->def_col_num = $mode_argument;
				break;
			case PDO::FETCH_CLASS:
				$this->def_class_name = $mode_argument;
				$this->def_ctorargs = $ctorargs;
				break;
			case PDO::FETCH_INTO:
				$this->bind_object = &$mode_argument;
				return FALSE; // Not supported
			default:
				$this->def_fetch_mode = $mode;
				break;
		}
		return 1;
	}

	// Iterator
	private $iterator_value;

	function rewind()
	{}

	function next()
	{}

	function valid()
	{
		return ($this->iterator_value = $this->fetch());
	}

	function current()
	{
		return $this->iterator_value;
	}

	function key()
	{
		return null;
	}
}
