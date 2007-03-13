<?
/*
  Note: based on NP_PingPong, adapt for the new ping mechanism

  History
    v1.0 - Initial version
 */

class NP_Ping extends NucleusPlugin {

	function getName() { return 'Ping'; }

	function getAuthor() { return 'admun (Edmond Hui)'; }
	function getURL()    { return 'http://edmondhui.homeip.net/nudn'; }
	function getVersion() { return '1.0'; }

	function getMinNucleusVersion() { return '330'; }

	function getDescription() {
		return 'This plugin can be used to ping many blog tracking services';
	}

	function supportsFeature($what) {
		switch($what) {
			case 'SqlTablePrefix':
				return 1;
			default:
				return 0;
		}
	}

	function install() {
		$this->createOption('pingpong_pingomatic','Ping-o-matic','yesno','yes');  // Default, http://pingomatic.com
		$this->createOption('pingpong_weblogs','weblogs.com','yesno','no'); // http://weblogs.com
		$this->createOption('pingpong_technorati',"Technorati",'yesno','no'); // http://www.technorati.com
		$this->createOption('pingpong_blogrolling',"Blogrolling",'yesno','no'); // http://www.blogrolling.com
		$this->createOption('pingpong_blogs','Blo.gs (no longer works?)','yesno','no'); // http://blo.gs
		$this->createOption('pingpong_weblogues','Weblogues (no longer works?)','yesno','no'); // http://weblogues.com/
		$this->createOption('pingpong_bloggde',"Blogg.de (not working??)",'yesno','no'); // http://blogg.de
	}

	function getEventList() {
		return array('SendPing');
	}

	function event_SendPing($data) {
		if (!class_exists('xmlrpcmsg')) {
			global $DIR_LIBS;
			include($DIR_LIBS . 'xmlrpc.inc.php');
		}

                $this->myBlogId = $data['blogid'];

		if ($this->getOption('pingpong_pingomatic')=='yes') {
			echo "Pinging Ping-o-matic:<br/>";
			echo $this->pingPingomatic();
			echo "<br/>";
		}

		if ($this->getOption('pingpong_weblogs')=='yes') { 
			echo "Pinging Weblogs.com:<br/>";
			echo $this->pingWeblogs();
			echo "<br/>";
		}

		if ($this->getOption('pingpong_technorati')=='yes') {
			echo "Pinging Technorati:<br/>";
			echo $this->pingTechnorati();
			echo "<br/>";
		}

		if ($this->getOption('pingpong_blogrolling')=='yes') {
			echo "Pinging Blogrolling.com:<br/>";
			echo $this->pingBlogRollingDotCom();
			echo "<br/>";
		}

		if ($this->getOption('pingpong_blogs')=='yes') {
			echo "Pinging Blog.gs:<br/>";
			echo $this->pingBloGs();
			echo "<br/>";
		}

		if ($this->getOption('pingpong_weblogues')=='yes') {
			echo "Pinging Weblogues.com:<br/>";
			echo $this->pingWebloguesDotCom();
			echo "<br/>";
		}

		if ($this->getOption('pingpong_bloggde')=='yes') {
			echo "Pinging Blog.de:<br/>";
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
		// $c->setdebug(1);

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
			return 'Error ' . $r->errno . ' : ' . $r->errstring;
		} elseif (($r == 0) && ($php_errormsg)) {
			return 'PHP Error: ' . $php_errormsg;
		} elseif ($r == 0) {
			return 'Error while trying to send ping. Sorry about that.';
		} elseif ($r->faultCode() != 0) {
			return 'Error: ' . $r->faultString();
		} else {
			$r = $r->value();	// get response struct

			// get values
			$flerror = $r->structmem('flerror');
			$flerror = $flerror->scalarval();

			$message = $r->structmem('message');
			$message = $message->scalarval();

			if ($flerror != 0) {
      				return 'Error (flerror=1): ' . $message;
			}
			else {
				return 'Success: ' . $message;
			}
		}
	}
}

?>
