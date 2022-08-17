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

class NP_ItemOptionTestCase3 extends NucleusPlugin {

// --------- Plug-in Info ---------------------------------
  // name of plugin
  function getName() {
    return 'ItemOptionTestCase3';
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

  function getEventList() {
    return array('PrePluginOptionsEdit', 'PostPluginOptionsUpdate');
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
    $this->createItemOption('TestCase3', 'TestCaseOption:TextArea', 'textarea', 'This is the default value for my textareatest');
  }
  
  function event_PrePluginOptionsEdit($data){
	  echo 'event: PrePluginOptionsEdit<br/>';
	  echo '$data: '.$data.'<br/>';
	  echo 'context: '.$data['context'].'<br/>';
	  echo 'contextid: '.$data['contextid'].'<br/>';
	  for ($i = 0; $i < count($data['options']); $i++) {
		  echo 'option-name: '.$data['options'][$i]['name'].' value: '.$data['options'][$i]['value'].'<br/>';
	  }
  }

  function event_PostPluginOptionsUpdate($data){
	  echo 'event: PostPluginOptionsEdit';
	  echo '$data: '.$data.' | context: '.$data['context'].'<br/>';
	  echo 'itemid: '.$data['itemid'].'<br/>';
	  echo 'item title: '.$data['item']['title'].'<br/>';
  }

// --------- do...-Functions ------------------------------
  function doTemplateVar(&$item) {
      //currently we do nothing :-)
	  echo $this->getItemOption($item->itemid, 'TestCase3');
  }
  
  function doSkinVar($skinType) {
      global $blog;
	  $mostTest = $this->getItemOptionTop('TestCase3', 15, 'asc');
	for($i=0; $i < count($mostTest); $i++) {
		echo '<br/>item: '.$mostTest[$i]['id'].': '.$mostTest[$i]['value'];
	}
  }
  
}
?>
