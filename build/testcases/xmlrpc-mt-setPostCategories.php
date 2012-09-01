<?php
/*
	Test call to the nucleus XML-RPC server sending a mt.setPostCategories request
	
	Wouter Demuynck / 2003-09-01
*/

// URL of XML-RPC server
$serverHost = 'localhost';
$serverPort = 8080;
$serverPath = '/nucleus/nucleus/xmlrpc/server.php';
	
include('../../config.php');
include($DIR_LIBS . 'xmlrpc.inc.php');

$f=new xmlrpcmsg(
	'mt.setPostCategories',
	 array(
	 	new xmlrpcval('2', 'string'),			// itemid
	 	new xmlrpcval('example', 'string'),			// username
	 	new xmlrpcval('example', 'string'),		// password
	 	new xmlrpcval(
	 		array(					
	 			new xmlrpcval(
	 				array(
	 					'categoryId' => new xmlrpcval('Test','string')
	 				),
	 				'struct'
	 			)
/*	 			,
				new xmlrpcval(
	 				array(
//	 					'isPrimary' => new xmlrpcval(1, 'boolean'),
	 					'categoryId' => new xmlrpcval('newcat1','string')
	 				),
	 				'struct'
	 			),
	 			new xmlrpcval(
	 				array(
	 					'categoryId' => new xmlrpcval('General','string')
	 				),
	 				'struct'
	 			)	 		
*/	 			
	 		),		
	 		'array'
	 	)
	 )
 );
	 
	echo 'ready';
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