<?php
/*
	Test call to the nucleus XML-RPC server sending a metaWeblog.getRecentPosts request
	
	Wouter Demuynck / 2003-08-31
*/

// URL of XML-RPC server
$serverHost = 'localhost';
$serverPort = 8080;
$serverPath = '/nucleus/nucleus/xmlrpc/server.php';
	
include('../../config.php');
include($DIR_LIBS . 'xmlrpc.inc.php');

$f=new xmlrpcmsg(
	'metaWeblog.editPost',
	 array(
	 	new xmlrpcval('2', 'string'),			// itemid
	 	new xmlrpcval('example', 'string'),			// username
	 	new xmlrpcval('example', 'string'),		// password
	 	new xmlrpcval(							// post info
	 		array(
	 			'description' => new xmlrpcval('Just a test','string'),
	 			'title' => new xmlrpcval('Edit Post Test', 'string')
/*	 			'categories' => new xmlrpcval(array(new xmlrpcval('General','string')), 'array')*/
	 		),'struct'),
	 	new xmlrpcval(1, 'boolean'),			// publish
	 )
 );
	 
  $c=new xmlrpc_client($serverPath, $serverHost, $serverPort);
  $c->setDebug(1);
  $r=$c->send($f);
  $v=$r->value();


  if (!$r->faultCode()) {
  	echo 'success!';
  } else {
      print "Fault: ";
      print "Code: " . $r->faultCode() . 
            " Reason '" .$r->faultString()."'<BR>";
  }
	

	
?>