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
 * +-CVS---------------------------------------------------
 * | $Id$
 * |
 * +-------------------------------------------------------
 */

class NP_Bug1058978_Testcase1 extends NucleusPlugin {

// --------- Plug-in Info ---------------------------------
  // name of plugin
  function getName() {
    return 'Bug1058978_Testcase1';
  }
  
  // author of plugin
  function getAuthor() {
    return 'TeRanEX';
  }
  // an URL to the plugin website
  function getURL() {
    return 'https://sourceforge.net/tracker/index.php?func=detail&aid=1058978&group_id=66479&atid=514643';
  }
  
  // version of the plugin
  function getVersion() {
    return '0.1';
  }
  
  // a description to be shown on the installed plugins listing
  function getDescription() {
    return 'A plugin to test the solution to Bug #1058978';
  }

  function getEventList() {
      // first install the plugin using this return-value
	  return array('PrePluginOptionsEdit', 'PostPluginOptionsUpdate');
	  // then comment it out and use the following instead. In a nucleus version that
	  // contains the bug you will now see that the the plugin is subscribed to the
	  // TEST_EVENT although this is not the case.
	  // in a fixed nucleus version you wont see the event until you hit the 'update
	  // subscription list'-button
	//  return array('PrePluginOptionsEdit', 'PostPluginOptionsUpdate', 'TEST_EVENT');
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

// --------- do...-Functions ------------------------------
  
  
}
?>
