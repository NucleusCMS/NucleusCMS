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

class NP_ItemOptionTestCase extends NucleusPlugin {

// --------- Plug-in Info ---------------------------------
  // name of plugin
  function getName() {
    return 'ItemOptionTestCase';
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
    $this->createItemOption('TestValue', 'TestOption', 'text', '0', 'datatype=numerical');
    $this->createItemOption('TestSelect', 'TestSelect', 'select', 'val1', 'de eerste optie|val1|de tweede optie|val2|de derde optie|val3');
  }
  

// --------- do...-Functions ------------------------------
  function doSkinVar($skinType, $counterType = 'visits', $counterMode = 'textual', $counterUpdate = 'count') {
      //currently we do nothing :-)
  }
  
}
?>