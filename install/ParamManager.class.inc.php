<?php

class ParamManager
{
	/* process parameter */
	public $state;
	public $locale;

	/* mysql connection parameters */
	public $mysql_host;
	public $mysql_user;
	public $mysql_password;
	public $mysql_database;
	public $mysql_tablePrefix;

	/* weblog configuration parameters */
	public $blog_name;
	public $blog_shortname;

	/* member configuration parameters */
	public $user_name;
	public $user_realname;
	public $user_password;
	private $user_password2;
	public $user_email;

	/* URI parameters  */
	private $root_url;
	public $IndexURL;
	public $AdminURL;
	public $MediaURL;
	public $SkinsURL;
	public $PluginURL;
	public $ActionURL;

	/* path parameters */
	private $root_path;
	public $AdminPath;
	public $MediaPath;
	public $SkinsPath;

	/**
	 * constructor
	 */
	public function __construct()
	{
		$this->init();
	}

	public function init()
	{
		// set default values
		$this->state = 'locale';
		$this->install_mode = 'simple';
		$this->locale = '';
		$this->mysql_host = @ini_get('mysql.default_host');
		$this->blog_name = 'My Nucleus CMS';
		$this->blog_shortname = 'mynucleuscms';

		/* root path */
		$directory_separator = preg_quote(DIRECTORY_SEPARATOR, '|');
		$this->root_path = implode('/', preg_split("|$directory_separator|", realpath(dirname(__FILE__) . '/..')));
		if ( substr($this->root_path, -1, 1) !== '/' )
		{
			$this->root_path .= '/';
		}
		$base_path_pcre = preg_quote($this->root_path, '|');

		/* current directry name */
		$directory_name = preg_replace("#{$base_path_pcre}#", '', implode('/', preg_split("#{$directory_separator}#", realpath(dirname(__FILE__)))));
		$directory_name_pcre = preg_quote($directory_name, '|');

		/* root uri */
		$root_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
		$this->root_url = preg_replace("|$directory_name_pcre(.*)$|", '', $root_url);

		$this->AdminPath = $this->root_path . 'nucleus/';
		$this->MediaPath = $this->root_path . 'media/';
		$this->SkinsPath = $this->root_path . 'skins/';

		$this->IndexURL  = $this->root_url;
		$this->AdminURL  = $this->root_url . 'nucleus/';
		$this->MediaURL  = $this->root_url . 'media/';
		$this->SkinsURL  = $this->root_url . 'skins/';
		$this->PluginURL = $this->root_url . 'nucleus/plugins/';
		$this->ActionURL = $this->root_url . 'action.php';
	}

	private function read_parameter($parameter)
	{
		foreach ( $parameter as $element )
		{
			if ( array_key_exists($element, $_POST) )
			{
				$this->$element = $_POST[$element];
			}
		}
	}

	public function set_state($state)
	{
		$states = array('locale', 'mysql', 'weblog', 'detail', 'install');
		if ( in_array($state, $states) )
		{
			$this->state = $state;
		}
	}

	public function set_locale()
	{
				if (defined('_DEFINED'))
				{
					return;
				}
		$this->read_parameter(array('locale'));

		if ( !$this->locale )
		{
			/**
			 * default locale select simple implementation
			 *
			 * NOTE:
			 * RFC2616: Hypertext Transfer Protocol -- HTTP/1.1
			 * http://www.ietf.org/rfc/rfc2616.txt
			 *
			 * 14.4 Accept-Language
			 *
			 *    The Accept-Language request-header field is similar to Accept, but
			 *    restricts the set of natural languages that are preferred as a
			 *    response to the request. Language tags are defined in section 3.10.
			 *
			 *        Accept-Language = "Accept-Language" ":"
			 *                          1#( language-range [ ";" "q" "=" qvalue ] )
			 *        language-range  = ( ( 1*8ALPHA *( "-" 1*8ALPHA ) ) | "*" )
			 *
			 *    Each language-range MAY be given an associated quality value which
			 *    represents an estimate of the user's preference for the languages
			 *    specified by that range. The quality value defaults to "q=1". For
			 *    example,
			 *
			 *        Accept-Language: da, en-gb;q=0.8, en;q=0.7
			 *
			 *    would mean: "I prefer Danish, but will accept British English and
			 *    other types of English." A language-range matches a language-tag if
			 *    it exactly equals the tag, or if it exactly equals a prefix of the
			 *    tag such that the first tag character following the prefix is "-".
			 *    The special range "*", if present in the Accept-Language field,
			 *    matches every tag not matched by any other range present in the
			 *    Accept-Language field.
			 *
			 * TODO: this is appropriate implement or not
			 */
			$languages = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);

			/* retrieve language token of language tag from first token */
			$language = '';
			if ( is_array($languages) && count($languages) > 0 )
			{
				$language = preg_replace('#^([\w]+).*$#', '$1', $languages[0]);
			}

			$locales = i18n::get_available_locale_list();
			foreach ( $locales as $locale )
			{
				if ( i18n::strpos($locale, $language) === 0 )
				{
					$this->locale = $locale;
					break;
				}
			}
		}

		/* include installer translation messages */
		$translation_file = "./locales/{$this->locale}." . i18n::get_current_charset() . '.php';
		if ( !file_exists($translation_file) )
		{
			$translation_file = './locales/en_Latn_US.UTF-8.php';
		}
		include($translation_file);

		/* include global translation messages */
		$translation_file = "../nucleus/locales/{$this->locale}." . i18n::get_current_charset() . '.php';
		if ( !file_exists($translation_file) )
		{
			$translation_file = './locales/en_Latn_US.UTF-8.php';
		}
		include($translation_file);

		i18n::set_current_locale($this->locale);

		return;
	}

	public function check_mysql_parameters()
	{
		global $MYSQL_HANDLER;

		$parameters = array('mysql_host', 'mysql_user', 'mysql_password', 'mysql_database', 'mysql_tablePrefix');
		$this->read_parameter($parameters);

		$errors = array();
		if ( $this->mysql_host == '' )
		{
			$errors[] = sprintf(_VALID_ERROR1, _DB_FIELD1);
		}

		if ( $this->mysql_user == '' )
		{
			$errors[] = sprintf(_VALID_ERROR1, _DB_FIELD2);
		}

		if ( $this->mysql_user != ''
			&& !preg_match('/^[a-z0-9_\-]+$/i', $this->mysql_user) )
		{
			$errors[] = sprintf(_VALID_ERROR2, _DB_FIELD2);
		}

		if ( $this->mysql_database == '' )
		{
			$errors[] = sprintf(_VALID_ERROR1, _DB_FIELD4);
		}

		if ( $this->mysql_database != ''
			&& !preg_match('/^[a-z0-9_\-]+$/i', $this->mysql_database) )
		{
			$errors[] = sprintf(_VALID_ERROR2, _DB_FIELD4);
		}

		if ( $this->mysql_tablePrefix != ''
			&& !preg_match('/^[a-z0-9_]+$/i', $this->mysql_tablePrefix) )
		{
			$errors[] = sprintf(_VALID_ERROR3, _DB_FIELD5);
		}

		if ( count($errors) == 0 )
		{
			$mysql_conn = @DB::setConnectionInfo($MYSQL_HANDLER[1], $this->mysql_host, $this->mysql_user, $this->mysql_password);
			if ( $mysql_conn == false )
			{
				$errors[] = _DBCONNECT_ERROR;
			}
			else
			{
				@DB::disConnect();
			}
		}

		return $errors;
	}

	public function check_user_parameters()
	{
		$parameters = array('user_name', 'user_realname', 'user_password', 'user_password2', 'user_email');
		$this->read_parameter($parameters);

		$errors = array();
		if ( $this->user_realname == '' )
		{
			$errors[] = sprintf(_VALID_ERROR1, _ADMIN_FIELD1);
		}

		if ( $this->user_name == '' )
		{
			$errors[] = sprintf(_VALID_ERROR1, _ADMIN_FIELD2);
		}
		elseif ( !preg_match("/^[a-z0-9]+([ a-z0-9]*[a-z0-9]+)?$/i", $this->user_name) )
		{
			$errors[] = _VALID_ERROR5;
		}

		if ( $this->user_password == '' || $this->user_password2 == '' )
		{
			$errors[] = sprintf(_VALID_ERROR1, _ADMIN_FIELD3);
			$this->user_password = '';
		}
		elseif ( $this->user_password != $this->user_password2 )
		{
			$errors[] = _VALID_ERROR6;
			$this->user_password = '';
		}

		if ( !preg_match("/^[a-z0-9\._+\-]+@[a-z0-9\._\-]+\.[a-z]{2,6}$/i", $this->user_email) )
		{
			$errors[] = _VALID_ERROR7;
		}

		return $errors;
	}

	public function check_weblog_parameters()
	{
		$parameters = array('blog_name', 'blog_shortname');
		$this->read_parameter($parameters);

		$errors = array();
		if ( $this->blog_name == '' )
		{
			$errors[] = sprintf(_VALID_ERROR1, _BLOG_FIELD1);
		}

		if ( $this->blog_shortname == '' )
		{
			$errors[] = sprintf(_VALID_ERROR1, _BLOG_FIELD2);
		}

		if ( !preg_match("/^[a-z0-9]+$/i", $this->blog_shortname) )
		{
			$errors[] = _VALID_ERROR4;
		}

		return $errors;
	}

	public function check_uri_parameters()
	{
		$parameters = array('IndexURL', 'AdminURL', 'MediaURL', 'SkinsURL', 'PluginURL', 'ActionURL');
		$this->read_parameter($parameters);

		$errors = array();
		if ( substr($this->IndexURL, -1, 1) !== '/' )
		{
			$errors[] = sprintf(_VALID_ERROR8, _PATH_FIELD1);
		}

		if ( substr($this->AdminURL, -1, 1) !== '/' )
		{
			$errors[] = sprintf(_VALID_ERROR8, _PATH_FIELD2);
		}

		if ( substr($this->MediaURL, -1, 1) !== '/' )
		{
			$errors[] = sprintf(_VALID_ERROR8, _PATH_FIELD4);
		}

		if ( substr($this->SkinsURL, -1, 1) !== '/' )
		{
			$errors[] = sprintf(_VALID_ERROR8, _PATH_FIELD6);
		}

		if ( substr($this->PluginURL, -1, 1) !== '/' )
		{
			$errors[] = sprintf(_VALID_ERROR8, _PATH_FIELD8);
		}

		if ( strrchr($this->ActionURL, '/') != '/action.php' )
		{
			$errors[] = sprintf(_VALID_ERROR9, _PATH_FIELD9);
		}

		return $errors;
	}

	public function check_path_parameters()
	{
		$parameters = array('AdminPath', 'MediaPath', 'SkinsPath');
		$this->read_parameter($parameters);

		$separators = array('/', DIRECTORY_SEPARATOR);
		$errors = array();
		if ( !in_array(substr($this->AdminPath, -1, 1), $separators) )
		{
			$errors[] = sprintf(_VALID_ERROR10, _PATH_FIELD3);
		}
		elseif ( !file_exists($this->AdminPath) )
		{
			$errors[] = sprintf(_VALID_ERROR11, _PATH_FIELD3);
		}

		if ( !in_array(substr($this->MediaPath, -1, 1), $separators) )
		{
			$errors[] = sprintf(_VALID_ERROR10, _PATH_FIELD5);
		}
		elseif ( !file_exists($this->MediaPath) )
		{
			$errors[] = sprintf(_VALID_ERROR11, _PATH_FIELD5);
		}

		if ( !in_array(substr($this->SkinsPath, -1, 1), $separators) )
		{
			$errors[] = sprintf(_VALID_ERROR10, _PATH_FIELD7);
		}
		elseif ( !file_exists($this->SkinsPath) )
		{
			$errors[] = sprintf(_VALID_ERROR11, _PATH_FIELD7);
		}

		return $errors;
	}

	/**
	 * check all parameters
	 * @return bool
	 */
	public function check_all_parameters()
	{
		$this->set_locale();

		$isValid = true;
		$isValid &= (count($this->check_mysql_parameters()) == 0);
		$isValid &= (count($this->check_user_parameters()) == 0);
		$isValid &= (count($this->check_weblog_parameters()) == 0);
		$isValid &= (count($this->check_uri_parameters()) == 0);
		$isValid &= (count($this->check_path_parameters()) == 0);

		return $isValid;
	}
}
