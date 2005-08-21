<?php
/*
	Test call to the nucleus XML-RPC server sending a metaWeblog.newMediaObject request
	
	Wouter Demuynck / 2003-08-31
*/

// URL of XML-RPC server
$serverHost = 'localhost';
$serverPort = 8080;
$serverPath = '/nucleus/nucleus/xmlrpc/server.php';

include('../../config.php');
include($DIR_LIBS . 'xmlrpc.inc.php');

// get file data
$filename = '../../nucleus/nucleus.gif';
$fh = fopen($filename,'rb');
$data = fread ($fh, filesize ($filename));
fclose($fh);

$f=new xmlrpcmsg(
	'metaWeblog.newMediaObject',
	 array(
	 	new xmlrpcval('1', 'string'),			// memberid
	 	new xmlrpcval('example', 'string'),			// username
	 	new xmlrpcval('example', 'string'),		// password
	 	new xmlrpcval(array(					// data
	 			'name' => new xmlrpcval('myImage.gif', 'string'),
	 			'type' => new xmlrpcval('image/gif', 'string'),
	 			'bits' => new xmlrpcval($data, 'base64')
	 		),		
	 		'struct'
	 	)
	 )
 );
	 

  $c=new xmlrpc_client($serverPath, $serverHost, $serverPort);
  $c->setDebug(1);
  $r=$c->send($f);
  $v=$r->value();


  if (!$r->faultCode()) {
  	echo 'succes!';
  } else {
      print "Fault: ";
      print "Code: " . $r->faultCode() . 
            " Reason '" .$r->faultString()."'<BR>";
  }
	

	
?>