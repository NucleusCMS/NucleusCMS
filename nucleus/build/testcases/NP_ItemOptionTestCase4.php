<?php
/**
 * +-------------------------------------------------------
 * |            Nucleus ItemOption TestCase              
 * +-------------------------------------------------------
 * |
 * +-INFO--------------------------------------------------
 * |  Author:   Jeroen Budts (TeRanEX)
 * |  URL:      http://budts.be/weblog/
 * |  JabberID: teranex@jabber.org
 * |
 * +-TODO--------------------------------------------------
 * | 
 * +-HISTORY-----------------------------------------------
 * |  
 * |
 * +-CVS---------------------------------------------------
 * | $Id$
 * |
 * +-------------------------------------------------------
 */

class NP_ItemOptionTestCase4 extends NucleusPlugin {

// --------- Plug-in Info ---------------------------------
  // name of plugin
  function getName() {
    return 'ItemOptionTestCase4';
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
    return 'A plugin to test the itemoptions';
  }

  //supported features
  function supportsFeature($what) {
    switch($what) {
      case 'SqlTablePrefix':
        return 1;
      default:
        return 0;
    }
  }
  
  function getMinNucleusVersion() {
    return 250;
  }
// --------- Install and Uninstall functions --------------
  function install() {
    $this->createItemOption('TestCase4', 'TestCaseOption:select(numerical)', 'select', '0', '0|0|1|1|2|2|test|test;datatype=numerical');
  }
  
// --------- do...-Functions ------------------------------
  function doTemplateVar(&$item) {
      //currently we do nothing :-)
	  echo $this->getItemOption($item->itemid, 'TestCase4');
  }
  
  function doSkinVar($skinType) {
      global $blog;
	  $mostTest = $this->getItemOptionTop('TestCase4', 15, 'asc');
	for($i=0; $i < count($mostTest); $i++) {
		echo '<br/>item: '.$mostTest[$i]['id'].': '.$mostTest[$i]['value'];
	}
  }
  
}
?>
