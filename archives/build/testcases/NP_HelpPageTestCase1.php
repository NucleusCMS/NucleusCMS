<?php

class NP_HelpPageTestCase1 extends NucleusPlugin {

// --------- Plug-in Info ---------------------------------
  // name of plugin
  function getName() {
    return 'HelpPageTestCase1';
  }
  
  // author of plugin
  function getAuthor() {
    return 'TeRanEX';
  }
  // an URL to the plugin website
  function getURL() {
    return 'http://budts.be/weblog/';
  }
  
  // version of the plugin
  function getVersion() {
    return '0.1';
  }
  
  // a description to be shown on the installed plugins listing
  function getDescription() {
    return 'A plugin to test plugin helppages';
  }

  //supported features
  function supportsFeature($what) {
    switch($what) {
      case 'SqlTablePrefix':
        return 1;
	  case 'HelpPage':
	  	return 1;
      default:
        return 0;
    }
  } 
}
?>
