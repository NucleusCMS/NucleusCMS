<?php
/**
 *
 * Send weblog updates ping
 *     plugin for NucleusCMS(version 3.30 or lator)
 *     Note: based on NP_PingPong, adapt for the new ping mechanism
 * PHP versions 4 and 5
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 *
 * @author    admun (Edmond Hui)
 * @license   http://www.gnu.org/licenses/gpl.txt  GNU GENERAL PUBLIC LICENSE Version 2, June 1991
 * @version   1.8
 * @link      http://edmondhui.homeip.net/nudn
 * $id$
 * History
 *   v1.0 - Initial version
 *   v1.1 - Add JustPosted event support
 *   v1.2 - JustPosted event handling in background
 *   v1.3 - pinged variable support
 *   v1.4 - language file support
 *   v1.5 - remove arg1 in exec() call
 *   v1.6 - move send update ping override option to plugin
 *   v1.7 - move send ping option from blog to plugin/blog level
 *        - remove ping override option
 *   v1.8 - remove sendPing event handle, switch to use PostAddItem and PostUpdateItem event for new item ping
 *   v1.81 - fix bug in _sendPingCheck() where ITEM class not found when creating new weblog
 */

class NP_Ping extends NucleusPlugin
{

    function getName()
    {
        return 'Ping';
    }

    function getAuthor()
    {
        return 'admun (Edmond Hui)';
    }

    function getURL()
    {
        return 'http://edmondhui.homeip.net/nudn';
    }

    function getVersion()
    {
        return '1.81';
    }

    function getMinNucleusVersion()
    {
        return '330';
    }

    function getDescription()
    {
        return _PING_DESC;
    }

    function supportsFeature($what)
    {
        switch($what) {
            case 'SqlTablePrefix':
                return 1;
            default:
                return 0;
        }
    }

    function init()
    {
//        $language = ereg_replace( '[\\|/]', '', getLanguageName());
        $language = preg_replace( '@\\|/@', '', getLanguageName());
        if (file_exists($this->getDirectory()  . $language . '.php')) {
            include_once($this->getDirectory() . $language . '.php');
        } else {
            include_once($this->getDirectory() . 'english.php');
        }
    }

    function install()
    {
        // Default, http://pingomatic.com
        $this->createOption('pingpong_pingomatic',  _PING_PINGOM,    'yesno', 'yes');
        // http://weblogs.com
        $this->createOption('pingpong_weblogs',     _PING_WEBLOGS,   'yesno', 'no');
        // http://www.technorati.com
        $this->createOption('pingpong_technorati',  _PING_TECHNOR,   'yesno', 'no');
        // http://www.blogrolling.com
        $this->createOption('pingpong_blogrolling', _PING_BLOGR,     'yesno', 'no');
        // http://blo.gs
        $this->createOption('pingpong_blogs',       _PING_BLOGS,     'yesno', 'no');
        // http://weblogues.com/
        $this->createOption('pingpong_weblogues',   _PING_WEBLOGUES, 'yesno', 'no');
        // http://blogg.de
        $this->createOption('pingpong_bloggde',     _PING_BLOGGDE,   'yesno', 'no');

        // Pinging on background
        $this->createOption('ping_background',      _PING_BG,        'yesno', 'no');

        $this->createBlogOption('ping_sendping',    _PING_SENDPING,  'yesno', 'yes');
    }

    function getEventList()
    {
        return array(
            'JustPosted',
            'PostAddItem',
            'PostUpdateItem'
        );
    }

    function event_JustPosted($data)
    {
        global $DIR_PLUGINS, $DIR_NUCLEUS;

        // exit is another plugin already send ping
        if ($data['pinged'] == true) {
            return;
        }

        $bid = intval($data['blogid']);
        if ($this->getBlogOption($bid, 'ping_sendping') == "yes") {
            if ($this->getOption('ping_background') == "yes") {
                exec("php $DIR_PLUGINS/ping/ping.php " . $data['blogid'] . " &");
            } else {
                $this->sendPings($data['blogid']);
            }
        }
        // mark the ping has been sent
        $data['pinged'] = true;
    }

    function event_PostAddItem($data)
    {
//        global $manager;
//        $blogId =  getBlogIDFromItemID($data['itemid']);
//        $item   =& ITEM::getitem($data['itemid'], 0, 0); // draft or future post return 0
//        if ($item != 0) {
//            if ($this->getBlogOption($blogId, 'ping_sendping') == "yes") {
//                $this->sendPings(array('blogid' => $blogId));
//            }
//        }
        $this->_sendPingCheck($data['itemid']);
    }

    function event_PostUpdateItem($data)
    {
//        global $manager;
//        $blogId =  getBlogIDFromItemID($data['itemid']);
//        $blog   =& $manager->getBlog($blogId);    // <- why?
//        $item   =& ITEM::getitem($data['itemid'], 0, 0); // draft or future post return 0
//        if ($item != 0) {
//            if ($this->getBlogOption($blogId,'ping_sendping') == "yes" ) {
//                $this->sendPings(array('blogid' => $blogId));
//            }
//        }
        $this->_sendPingCheck($data['itemid']);
    }

    function _sendPingCheck($itemid)
    {
        $iid  = intval($itemid);
        global $manager;
		$item = $manager->getItem($iid,0,0);
        if ($item) {
            $bid = intval(getBlogIDFromItemID($iid));
            if ($this->getBlogOption($bid, 'ping_sendping') == "yes" ) {
                $this->sendPings(array('blogid' => $bid));
            }
        }
    }

    function sendPings($data) {

        if (!class_exists('xmlrpcmsg')) {
            include_libs('xmlrpc.inc.php');
        }
        $this->myBlogId = $data['blogid'];

        $ping_result = '';

        if ($this->getOption('pingpong_pingomatic') == 'yes') {
            $ping_result .= _PINGING . "Ping-o-matic:\n";
            $ping_result .= $this->pingPingomatic();
            $ping_result .= " | ";
        }

        if ($this->getOption('pingpong_weblogs') == 'yes') { 
            $ping_result .= _PINGING . "Weblogs.com:\n";
            $ping_result .= $this->pingWeblogs();
            $ping_result .= " | ";
        }

        if ($this->getOption('pingpong_technorati') == 'yes') {
            $ping_result .= _PINGING . "Technorati:\n";
            $ping_result .= $this->pingTechnorati();
            $ping_result .= " | ";
        }

        if ($this->getOption('pingpong_blogrolling') == 'yes') {
            $ping_result .= _PINGING . "Blogrolling.com:\n";
            $ping_result .= $this->pingBlogRollingDotCom();
            $ping_result .= " | ";
        }

        if ($this->getOption('pingpong_blogs') == 'yes') {
            $ping_result .= _PINGING . "Blog.gs:\n";
            $ping_result .= $this->pingBloGs();
            $ping_result .= " | ";
        }

        if ($this->getOption('pingpong_weblogues') == 'yes') {
            $ping_result .= _PINGING . "Weblogues.com:\n";
            $ping_result .= $this->pingWebloguesDotCom();
            $ping_result .= " | ";
        }

        if ($this->getOption('pingpong_bloggde') == 'yes') {
            $ping_result .= _PINGING . "Blog.de:\n";
            $ping_result .= $this->pingBloggDe();
            $ping_result .= " | ";
        }

        ACTIONLOG::add(INFO, $ping_result);
    }

    function pingPingomatic() {
        $b = new BLOG($this->myBlogId);
        $message = new xmlrpcmsg(
                            'weblogUpdates.ping',
                            array(
                                new xmlrpcval($b->getName(), 'string'),
                                new xmlrpcval($b->getURL(), 'string')
                            )
                   );

        $c = new xmlrpc_client('/', 'rpc.pingomatic.com', 80);
        //$c->setDebug(1);

        $r = $c->send($message,30); // 30 seconds timeout...
        return $this->processPingResult($r);
    }

    function pingWeblogs() {
        $b = new BLOG($this->myBlogId);
        $message = new xmlrpcmsg(
                            'weblogupdates.ping',
                            array(
                                new xmlrpcval($b->getName(), 'string'),
                                new xmlrpcval($b->getURL(), 'string')
                            )
                   );

        $c = new xmlrpc_client('/rpc2', 'rpc.weblogs.com', 80);
        //$c->setdebug(1);

        $r = $c->send($message,30); // 30 seconds timeout...
        return $this->processPingResult($r);
    } 

    function pingTechnorati() {
        $b = new BLOG($this->myBlogId);
        $message = new xmlrpcmsg(
                            'weblogUpdates.ping',
                            array(
                                new xmlrpcval($b->getName(),'string'),
                                new xmlrpcval($b->getURL(),'string')
                            )
                   );

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
                                new xmlrpcval($b->getName(),'string'),
                                new xmlrpcval($b->getURL(),'string')
                            )
                   );

        $c = new xmlrpc_client('/pinger/', 'rpc.blogrolling.com', 80);
        //$c->setDebug(1);

        $r = $c->send($message,30); // 30 seconds timeout...     
        return $this->processPingResult($r);
    } 

    function pingBloGs() {
        $b = new BLOG($this->myBlogId);
        $message = new xmlrpcmsg(
                            'weblogUpdates.extendedPing',
                            array(
                                new xmlrpcval($b->getName(),'string'),
                                new xmlrpcval($b->getURL(),'string')
                            )
                   );

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
                                new xmlrpcval($b->getName(),'string'),
                                new xmlrpcval($b->getURL(),'string')
                            )
                   );

        $c = new xmlrpc_client('/RPC/', 'www.weblogues.com', 80);
        //$c->setDebug(1);

        $r = $c->send($message,30); // 30 seconds timeout...     
        return $this->processPingResult($r);
    }

    function pingBloggDe() {
        $b = new BLOG($this->myBlogId);
        $message = new xmlrpcmsg(
                            'bloggUpdates.ping',
                            array(
                                new xmlrpcval($b->getName(),'string'),
                                new xmlrpcval($b->getURL(),'string')
                            )
                   );

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
            $r = $r->value();   // get response struct

            // get values
            $flerror = $r->structmem('flerror');
            $flerror = $flerror->scalarval();

            $message = $r->structmem('message');
            $message = $message->scalarval();

            if ($flerror != 0) {
                return _PING_ERROR . ' (flerror=1): ' . $message;
            } else {
                return _PING_SUCCESS . ': ' . $message;
            }
        }
    }
}

?>
