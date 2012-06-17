<?php
class NP_Medium extends NucleusPlugin
{
	private $skin = '';
	
	public $type = '';
	
	public $collection = '';
	public $description = '';
	public $filter = '';
	public $message = '';
	
	public $amount = 0;
	public $media = array();
	public $offset = 0;
	public $prev = 0;
	public $next = 0;
	
	public function getName()
	{
		return 'Medium';
	}
	
	public function getAuthor()
	{
		return 'Sakamoto Takashi';
	}
	
	public function getURL()
	{
		return '';
	}
	
	public function getVersion()
	{
		return '0.9(beta)';
	}
	
	public function getMinNucleusVersion()
	{
		return '400';
	}
	
	public function getDescription()
	{
		return NP_MEDIUM_DESC;
	}
	
	public function supportsFeature($what)
	{
		return ( $what == 'SqlTablePrefix' );
	}
	
	public function getEventList()
	{
		return array('AdminPrePageHead', 'AdminTemplateExtraFields');
	}
	
	public function init()
	{
		// include translation file for this plugin
		if ( file_exists($this->getDirectory() . 'locales/' . i18n::get_current_locale() . '.' . i18n::get_current_charset() . '.php') )
		{
			include_once($this->getDirectory() . 'locales/' . i18n::get_current_locale() . '.' . i18n::get_current_charset() . '.php');
		}
		else
		{
			include_once($this->getDirectory() . 'locales/en_Latn_US.UTF-8.php');
		}
		return;
	}
	
	public function install()
	{
		$this->createOption('collectionlist_head', 'NP_MEDIUM_COLLECTIONLIST_HEAD', 'textarea',
			  "<label for=\"media_collection\">"
			. "<%text(_MEDIA_COLLECTION_LABEL)%>"
			. "</label>"
			. "<select name=\"collection\" id=\"media_collection\">\n");
		
		$this->createOption('collectionlist_body', 'NP_MEDIUM_COLLECTIONLIST_BODY', 'textarea',
			  "<option value=\"<%name%>\" <%selected%>>"
			. "<%desc%>"
			. "</option>\n");
			
		$this->createOption('collectionlist_foot', 'NP_MEDIUM_COLLECTIONLIST_FOOT', 'textarea',
			"</select>\n");
		
		$this->createOption('medialist_head', 'NP_MEDIUM_MEDIALIST_HEAD', 'textarea',
			  "<table frame=\"box\" rules=\"frame\" sumary=\"<%text(Media List)%>\">\n"
			. "<caption><%text(_MEDIA_COLLECTION_LABEL)%> <%description%></caption>\n"
			. "<thead>\n"
			. "<tr>\n"
			. "<th><%text(_MEDIA_MODIFIED)%></th>\n"
			. "<th><%text(_MEDIA_FILENAME)%></th>\n"
			. "<th><%text(_MEDIA_DIMENSIONS)%></th>\n"
			. "</tr>\n"
			. "</thead>\n"
			. "<tbody>\n");
		
		$this->createOption('medialist_body_image', 'NP_MEDIUM_MEDIALIST_BODY_IMAGE', 'textarea',
			  "<tr>\n"
			. "<td><%timestamp%></td>\n"
			. "<td>\n"
			. "<a href=\"<%mediumurl%>\" onclick=\"medium.chooseImage('<%collection%>', '<%filename%>', <%width%>, <%height%>);\" title=\"<%filename%>\">\n"
			. "<%shortfilename%>\n"
			. "</a>\n"
			. "(\n"
			. "<a href=\"<%mediumurl%>\" onclick=\"window.open(this.href); return false;\" title=\"<%text(_MEDIA_VIEW_TT%>\">\n"
			. "<%text(_MEDIA_VIEW)%>\n"
			. "</a>\n"
			. ")\n"
			. "</td>\n"
			. "<td><%width%> x <%height%></td>\n"
			. "</tr>\n");
		
		$this->createOption('medialist_body_other', 'NP_MEDIUM_MEDIALIST_BODY_OTHER', 'textarea',
			  "<tr>\n"
			. "<td><%timestamp%></td>\n"
			. "<td>\n"
			. "<a href=\"<%mediumurl%>\" onclick=\"medium.chooseOther('<%collection%>', '<%filename%>');\" title=\"<%filename%>\">\n"
			. "<%shortfilename%>\n"
			. "</a>\n"
			. "</td>\n"
			. "<td><%size%> KB</td>\n"
			. "</tr>\n");
		
		$this->createOption('medialist_foot', 'NP_MEDIUM_MEDIALIST_FOOT', 'textarea',
			  "</tbody>\n"
			. "</table>\n");
		
		$this->createOption('medialist_blank', 'NP_MEDIUM_MEDIALIST_BLANK', 'textarea',
			  "<p>Nothing</p>\n");
		
		return;
	}
	
	public function event_AdminPrePageHead($data)
	{
		global $CONF;
		
		if ( !in_array($data['action'], array('createitem', 'itemedit')) )
		{
			return;
		}
		
		$data['extrahead'] .= "<script type=\"text/javascript\" src=\"{$CONF['PluginURL']}/medium/scripts/medium.js\"></script>\n"
		                    . "<script type=\"text/javascript\">\n"
		                    . "	medium.url = '{$CONF['ActionURL']}?action=plugin&name=medium';\n"
		                    . '</script>'."\n";
		
		return;
	}
	
	public function doAction($type)
	{
		global $CONF, $DIR_MEDIA, $manager, $member;
		
		/*
		 * defines how much media items will be shown per page. You can override this
		 * in config.php if you like. (changing it in config.php instead of here will
		 * allow your settings to be kept even after a Nucleus upgrade)
		 */
		$CONF['MediaPerPage'] = 10;
		
		/* include all classes */
		if ( !class_exists('Media', FALSE) )
		{
			include_libs('MEDIA.php', FALSE, FALSE);
		}
		
		/* include all classes */
		if ( !class_exists('BaseActions', FALSE) )
		{
			include_libs('BaseActions.php', FALSE, FALSE);
		}
		
		if ( !class_exists('MediumActions', FALSE) )
		{
			include($this->getDirectory() . 'MediumActions.php');
		}
		
		/* get skin object */
		$skinid = $CONF['AdminSkin'];
		if ( !Skin::existsID($skinid) )
		{
			echo _ERROR_SKIN;
			exit;
		}
		$this->skin = new Skin($skinid, 'MediumActions', 'MediumSkin');
		
		/* user needs to be logged in to use this */
		if ( !$member->isLoggedIn() )
		{
			$this->login();
			exit;
		}
		
		/* check if member is on at least one teamlist */
		$query = 'SELECT * FROM %s WHERE tmember=%d;';
		$query = sprintf($query, sql_table('team'), $member->getID());
		$teams = DB::getResult($query);
		if ( $teams->rowCount() == 0 && !$member->isAdmin() )
		{
			$this->error(_ERROR_DISALLOWEDUPLOAD);
			return;
		}
		
		/* avoid directory travarsal and accessing invalid directory */
		$this->collection = requestVar('collection');
		$this->description = $this->collection;
		if ( !$this->collection || $this->collection == $member->getID()
		   || !@is_dir("{$DIR_MEDIA}{$this->collection}") )
		{
			$this->collection = $member->getID();
			$this->description = PRIVATE_COLLECTION;
		}
		else if ( !Media::isValidCollection($this->collection) )
		{
			$this->error(_ERROR_DISALLOWED);
			return;
		}
		
		/* check type */
		if ( !in_array($type, array('select', 'choose', 'upload')) )
		{
			$type = 'select';
		}
		
		/* check ticket */
		$needless_to_check = array('select', 'choose');
		if ( !in_array($type, $needless_to_check) )
		{
			if ( !$manager->checkTicket() )
			{
				$this->error(_ERROR_BADTICKET);
			return;
			}
		}
		
		/* processing */
		switch ( $type )
		{
		case 'choose':
			if ( !$member->isAdmin() && !$CONF['AllowUpload'] )
			{
				$this->error(_ERROR_DISALLOWED);
				return;
			}
			$this->choose();
			break;
		case 'upload':
			if ( !$member->isAdmin() && !$CONF['AllowUpload'] )
			{
				$this->error(_ERROR_DISALLOWED);
				return;
			}
			$this->upload();
			break;
		case 'select':
		default:
			$this->select();
			break;
		}
		exit;
	}
	
	private function select()
	{
		global $CONF;
		
		$this->type = 'select';
		$this->filter = requestVar('filter');
		
		$media = Media::getMediaListByCollection($this->collection, $this->filter);
		
		$this->amount = count($media);
		$this->offset = intRequestVar('offset');
		
		if ( $this->amount > 0 )
		{
			if ( ($this->offset + $CONF['MediaPerPage']) >= $this->amount )
			{
				$this->offset = $this->amount - $CONF['MediaPerPage'];
			}
			
			if ( $this->offset < 0 )
			{
				$this->offset = 0;
			}
			
			$start = $this->offset;
			$end = $this->offset + $CONF['MediaPerPage'];
			$next = $end;
			$prev = $start - $CONF['MediaPerPage'];
			
			if ( $prev < 0 )
			{
				$prev = 0;
			}
			
			if ( $end > $this->amount )
			{
				$end = $this->amount;
			}
			
			if ( $start > 0 )
			{
				$this->prev = $prev;
			}
			
			if ( $end < $this->amount )
			{
				$this->next = $next;
			}
			
			for( $index = $start; $index < $end; $index++ )
			{
				$this->media[] = $media[$index];
			}
			
			unset($media);
		}
		
		$this->skin->parse('fileparse', $this->getDirectory() . 'skins/select.skn');
		return;
	}
	
	private function choose()
	{
		$this->type = 'choose';
		$this->skin->parse('fileparse', $this->getDirectory() . 'skins/choose.skn');
	}
	
	private function upload()
	{
		global $CONF;
		
		$this->type = 'upload';
		
		$uploadInfo = postFileInfo('uploadfile');
		
		$filename = $uploadInfo['name'];
		$filetype = $uploadInfo['type'];
		$filesize = $uploadInfo['size'];
		$filetempname = $uploadInfo['tmp_name'];
		$fileerror = (integer) $uploadInfo['error'];
		
		switch ( $fileerror )
		{
			// include error code for debugging
			// (see http://www.php.net/manual/en/features.file-upload.errors.php)
			case 0:		// = UPLOAD_ERR_OK
				break;
			case 1:		// = UPLOAD_ERR_INI_SIZE
			case 2:		// = UPLOAD_ERR_FORM_SIZE
				$this->error(_ERROR_FILE_TOO_BIG);
				return;
			case 3:		// = UPLOAD_ERR_PARTIAL
			case 4:		// = UPLOAD_ERR_NO_FILE
			case 6:		// = UPLOAD_ERR_NO_TMP_DIR
			case 7:		// = UPLOAD_ERR_CANT_WRITE
			default:
				$this->error(_ERROR_BADREQUEST . ' (' . $fileerror . ')');
				return;
		}
		
		if ( $filesize > $CONF['MaxUploadSize'] )
		{
			$this->error(_ERROR_FILE_TOO_BIG);
			return;
		}
		
		// check file type against allowed types
		$ok = 0;
		$allowedtypes = preg_split('#,#', $CONF['AllowedTypes']);
		foreach ( $allowedtypes as $type )
		{
			if ( preg_match("#.{$type}$#i", $filename) )
			{
				$ok = 1;
			}
		}
		if ( !$ok )
		{
			$this->error(_ERROR_BADFILETYPE);
			return;
		}
		
		if ( !is_uploaded_file($filetempname) )
		{
			$this->error(_ERROR_BADREQUEST);
			return;
		}
		// prefix filename with current date (YYYY-MM-DD-)
		// this to avoid nameclashes
		if ( $CONF['MediaPrefix'] )
		{
			$filename = i18n::formatted_datetime("%Y%m%d-", time()) . $filename;
		}
		
		$res = Media::addMediaObject($this->collection, $filetempname, $filename);
		
		if ( $res != '' )
		{
			$this->error($res);
			return;
		}
		
		$this->select();
		return;
	}
	
	private function login()
	{
		$this->type = 'login';
		$this->skin->parse('fileparse', $this->getDirectory() . 'skins/login.skn');
		return;
	}
	
	private function error($msg)
	{
		$this->type = 'error';
		$this->message = $msg;
		$this->skin->parse('fileparse', $this->getDirectory() . 'skins/error.skn');
		return;
	}
}
