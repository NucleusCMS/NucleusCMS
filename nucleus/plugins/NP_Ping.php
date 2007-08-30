<?
/*
  Note: based on NP_PingPong, adapt for the new ping mechanism

  History
    v1.0 - Initial version
    v1.1 - Add JustPosted event support
    v1.2 - JustPosted event handling in background
    v1.3 - pinged variable support
    v1.4 - language file support
    v1.5 - remove arg1 in exec() call
 */

class NP_Ping extends NucleusPlugin {

	function getName() { return 'Ping'; }

	function getAuthor() { return 'admun (Edmond Hui)'; }
	function getURL()    { return 'http://edmondhui.homeip.net/nudn'; }
	function getVersion() { return '1.5'; }

	function getMinNucleusVersion() { return '330'; }

	function getDescription() {
		return _PING_DESC;
	}

	function supportsFeature($what) {
		switch($what) {
			case 'SqlTablePrefix':
				return 1;
			default:
				return 0;
		}
	}

	function init()
	{
		$language = ereg_replace( '[\\|/]', '', getLanguageName());
		if (file_exists($this->getDirectory()  . $language . '.php')) {
			include_once($this->getDirectory() . $language . '.php');
		}else {
			include_once($this->getDirectory() . 'english.php');
		}
	}

	function install() {
		$this->createOption('pingpong_pingomatic',_PING_PINGOM,'yesno','yes');  // Default, http://pingomatic.com
		$this->createOption('pingpong_weblogs',_PING_WEBLOGS,'yesno','no'); // http://weblogs.com
		$this->createOption('pingpong_technorati',_PING_TECHNOR,'yesno','no'); // http://www.technorati.com
		$this->createOption('pingpong_blogrolling',_PING_BLOGR,'yesno','no'); // http://www.blogrolling.com
		$this->createOption('pingpong_blogs',_PING_BLOGS,'yesno','no'); // http://blo.gs
		$this->createOption('pingpong_weblogues',_PING_WEBLOGUES,'yesno','no'); // http://weblogues.com/
		$this->createOption('pingpong_bloggde',_PING_BLOGGDE,'yesno','no'); // http://blogg.de
		$this->createOption('ping_background',_PING_BG,'yesno','yes');
	}

	function getEventList() {
		return array('SendPing', 'JustPosted');
	}

	function event_JustPosted($data) {
		global $DIR_PLUGINS, $DIR_NUCLEUS;

		// exit is another plugin already send ping
		if ($data['pinged'] == true) {
			return;
		}

		if ($this->getOption('ping_background') == "yes") {
			exec("php $DIR_PLUGINS/ping/ping.php " . $data['blogid'] . " &");
		} else {
			$this->sendPings($data['blogid']);

        		ACTIONLOG::add(INFO, 'NP_Ping: Sending ping (from foreground)');
		}

		// mark the ping has been sent
		$data['pinged'] = true;
        }

	function event_SendPing($data) {
                $this->sendPings($data);
	}

        function sendPings($data) {
		if (!class_exists('xmlrpcmsg')) {
			global $DIR_LIBS;
			include($DIR_LIBS . 'xmlrpc.inc.php');
		}

                $this->myBlogId = $data['blogid'];

		if ($this->getOption('pingpong_pingomatic')=='yes') {
			echo _PINGING . "Ping-o-matic:<br/>";
			echo $this->pingPingomatic();
			echo "<br/>";
		}

		if ($this->getOption('pingpong_weblogs')=='yes') { 
			echo _PINGING . "Weblogs.com:<br/>";
			echo $this->pingWeblogs();
			echo "<br/>";
		}

		if ($this->getOption('pingpong_technorati')=='yes') {
			echo _PINGING . "Technorati:<br/>";
			echo $this->pingTechnorati();
			echo "<br/>";
		}

		if ($this->getOption('pingpong_blogrolling')=='yes') {
			echo _PINGING . "Blogrolling.com:<br/>";
			echo $this->pingBlogRollingDotCom();
			echo "<br/>";
		}

		if ($this->getOption('pingpong_blogs')=='yes') {
			echo _PINGING . "Blog.gs:<br/>";
			echo $this->pingBloGs();
			echo "<br/>";
		}

		if ($this->getOption('pingpong_weblogues')=='yes') {
			echo _PINGING . "Weblogues.com:<br/>";
			echo $this->pingWebloguesDotCom();
			echo "<br/>";
		}

		if ($this->getOption('pingpong_bloggde')=='yes') {
			echo _PINGING . "Blog.de:<br/>";
			echo $this->pingBloggDe();
			echo "<br/>";
		}
        }

	function pingPingomatic() {
		$b = new BLOG($this->myBlogId);
		$message = new xmlrpcmsg(
					'weblogUpdates.ping', array(
					new xmlrpcval($b->getName(),'string'),
					new xmlrpcval($b->getURL(),'string')
					));

		$c = new xmlrpc_client('/', 'rpc.pingomatic.com', 80);
		//$c->setDebug(1);

		$r = $c->send($message,30); // 30 seconds timeout...
		return $this->processPingResult($r);
	}

	function pingWeblogs() {
		$b = new BLOG($this->myBlogId);
		$message = new xmlrpcmsg(
					'weblogupdates.ping',array(
					new xmlrpcval($b->getName(),'string'),
					new xmlrpcval($b->getUrl(),'string')
					));

		$c = new xmlrpc_client('/rpc2', 'rpc.weblogs.com', 80);
		//$c->setdebug(1);

		$r = $c->send($message,30); // 30 seconds timeout...
		return $this->processPingResult($r);
	} 

	function pingTechnorati() {
		$b = new BLOG($this->myBlogId);
		$message = new xmlrpcmsg(
					'weblogUpdates.ping', array(
					new xmlrpcval($b->getName(),'string'),
					new xmlrpcval($b->getURL(),'string')
					));

		$c = new xmlrpc_client('/rpc/ping/', 'rpc.technorati.com', 80);
		//$c->setDebug(1);

		$r = $c->send($message,30); // 30 seconds timeout...
		return $this->processPingResult($r);
	}

	function pingBlogRollingDotCom() {
		$b = new BLOG($this->myBlogId);         
		$message = new xmlrpcmsg(
					'weblogUpdates.ping',
					array(
					new xmlrpcval($b->getName(),'string'), // your blog title
					new xmlrpcval($b->getURL(),'string')  // your blog url
					));

		$c = new xmlrpc_client('/pinger/', 'rpc.blogrolling.com', 80);
		//$c->setDebug(1);

		$r = $c->send($message,30); // 30 seconds timeout...     
		return $this->processPingResult($r);
	} 

	function pingBloGs() {
		$b = new BLOG($this->myBlogId);
		$message = new xmlrpcmsg(
					'weblogUpdates.extendedPing', array(
					new xmlrpcval($b->getName(),'string'),
					new xmlrpcval($b->getURL(),'string')
					));

		$c = new xmlrpc_client('/', 'ping.blo.gs', 80);
		//$c->setDebug(1);

		$r = $c->send($message,30); // 30 seconds timeout...    
		return $this->processPingResult($r);
	} 

	function pingWebloguesDotCom() {
		$b = new BLOG($this->myBlogId);
		$message = new xmlrpcmsg(
					'weblogUpdates.extendedPing',
					array(
					new xmlrpcval($b->getName(),'string'), // your blog title
					new xmlrpcval($b->getURL(),'string')  // your blog url
					));

		$c = new xmlrpc_client('/RPC/', 'www.weblogues.com', 80);
		//$c->setDebug(1);

		$r = $c->send($message,30); // 30 seconds timeout...     
		return $this->processPingResult($r);
	}

	function pingBloggDe() {
		$b = new BLOG($this->myBlogId);
		$message = new xmlrpcmsg(
					'bloggUpdates.ping', array(
					new xmlrpcval($b->getName(),'string'),
					new xmlrpcval($b->getURL(),'string')
					));

		$c = new xmlrpc_client('/', 'xmlrpc.blogg.de', 80);
		//$c->setDebug(1);

		$r = $c->send($message,30); // 30 seconds timeout...   
		return $this->processPingResult($r);
	} 

	function processPingResult($r) {
		global $php_errormsg;

		if (($r == 0) && ($r->errno || $r->errstring)) {
			return _PING_ERROR . " " . $r->errno . ' : ' . $r->errstring;
		} elseif (($r == 0) && ($php_errormsg)) {
			return _PING_PHP_ERROR . $php_errormsg;
		} elseif ($r == 0) {
			return _PING_PHP_PING_ERROR;
		} elseif ($r->faultCode() != 0) {
			return _PING_ERROR . ': ' . $r->faultString();
		} else {
			$r = $r->value();	// get response struct

			// get values
			$flerror = $r->structmem('flerror');
			$flerror = $flerror->scalarval();

			$message = $r->structmem('message');
			$message = $message->scalarval();

			if ($flerror != 0) {
      				return _PING_ERROR . ' (flerror=1): ' . $message;
			}
			else {
				return _PING_SUCCESS . ': ' . $message;
			}
		}
	}
}

?>
