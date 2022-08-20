<?php
class NP_PrePluginOptionsUpdate_TestCase1 extends NucleusPlugin {
  
// --------- Plug-in Info ---------------------------------
	// name of plugin
	function getName() {
	  return 'NP_PrePluginOptionsUpdate_TestCase1';
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
	  return 'A plugin to test the PrePluginOptionsUpdate event and the enhancement to the PrePluginOptionsEdit event';
	}
	
	function getEventList() { return array('PrePluginOptionsUpdate', 'PrePluginOptionsEdit'); }
	
	function install() {
		$this->createItemOption('TestValue', 'TestOption', 'text', 'foobar', '');
		$this->createMemberOption('MemberTestOptions', 'TestOption', 'text', 'foobar-member', '');
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
	
	function event_PrePluginOptionsUpdate(&$data) {
		if ($this->getID() == $data['plugid']) {
			//this belongs to us :-)
			//echo "PrePluginOptionsUpdate: TestCase-plugin<br/>";
			//echo "optionname: ".$data['optionname']."<br/>";
			//echo "context: ".$data['context']."<br/>";
			//echo "contextid: ".$data['contextid']."<br/>";
			//echo "value: ".$data['value']."<br/>";
			if ($data['value'] == '') {
				$data['value'] = 'no-value';
			} else {
				$data['value'] .= '-TEST';
			}
			//echo "new value: ".$data['value']."<br /><br/>";
		}
		
		if ($data['optionname'] == 'TestValue') {
			$data['value'] .= '|||'.requestVar('np_testcase_item');
		}
	}
	
	
	// function event_PrePluginOptionsEdit(&$data){
		// echo 'event: PrePluginOptionsEdit<br/>';
		// echo '$data: '.$data.'<br/>';
		// echo 'context: '.$data['context'].'<br/>';
		// echo 'contextid: '.$data['contextid'].'<br/>';
		// for ($i == 0; $i < count($data['options']); $i++) {
			// echo 'option-name: '.$data['options'][$i]['name'].' value: '.$data['options'][$i]['value'].'<br/>';
			// echo 'extra: '.$data['options'][$i]['extra'].'<br/>';
			// // $data['options'][$i]['extra'] .= 'test';
			// // echo 'new extra: '.$data['options'][$i]['extra'].'<br/>';
		// }
	// }
	
	function event_PrePluginOptionsEdit(&$data) {
		//echo 'PrePluginOptionsEdit ';
		// if ($data['context'] == 'item') {
			//foreach($data['options'] as $option) {
			foreach (array_keys($data['options']) as $optionKey) {
				$option = &$data['options'][$optionKey];
				// if (($option['pid'] == $this->getID)&&($option['name'] == 'TestValue')) {
				if (($option['name'] == 'TestValue') && ($option['pid'] == $this->getID())) {
					$option['extra'] .= ' <input type="text" name="np_testcase_item" />';
					//echo 'Extra: '.$option['extra'].'<br/>';
				}
			// } 
		}
	}
}
?>
