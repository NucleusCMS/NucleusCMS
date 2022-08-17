<?php

/** 
  * Plugin for Nucleus CMS (http://plugins.nucleuscms.org/) 
  * Copyright (C) 2003-2006 The Nucleus Plugins Project
  *
  * This program is free software; you can redistribute it and/or
  * modify it under the terms of the GNU General Public License
  * as published by the Free Software Foundation; either version 2
  * of the License, or (at your option) any later version.
  *
  * see license.txt for the full license
  */

class NP_OptionTest extends NucleusPlugin {

	// name of plugin
	function getName() {
		return 'OptionTest'; 
	}
	
	// author of plugin
	function getAuthor()  { 
		return 'Wouter Demuynck'; 
	}
	
	// an URL to the plugin website
	// can also be of the form mailto:foor@bar.com
	function getURL() 
	{
		return 'http://nucleuscms.org/'; 
	}
	
	// version of the plugin
	function getVersion() {
		return '1.0'; 
	}
	
	// a description to be shown on the installed plugins listing
	function getDescription() { 
		return 'Plugin to test blog and member options by plugins';
	}
	
	function getMinNucleusVersion() {
		return 220;
	}

	function install() {
		$aErrors = array();
	
		echo '<h1>Creating some options</h1>';
	
		if (!$this->createBlogOption('my option', 'my description', 'text', 'initial value', 'extra'))
			array_push($aErrors, 'create blog option failed');
			
		if (!$this->createBlogOption('my option2', 'my description2', 'yesno', 'no'))
			array_push($aErrors, 'create blog option 2 failed');
			
		if (!$this->createMemberOption('my option3', 'my description3', 'yesno', 'no'))
			array_push($aErrors, 'create member option failed');
			
		if (!$this->createCategoryOption('my option4', 'my description4', 'yesno', 'yes'))
			array_push($aErrors, 'create catgeory option failed');

		echo '<h1>Creating some more options</h1>';
		// add some thingies with the same name
		$this->createCategoryOption('idem', 'idemd', 'text', 'category');
		$this->createOption('idem', 'idemd', 'text', 'global');
		$this->createBlogOption('idem', 'idemd', 'text', 'blog');
		$this->createMemberOption('idem', 'idemd', 'text', 'member');		
		
		echo '<h1>Checking options</h1>';		
		if ($this->getOption('idem') != 'global') 
			array_push($aErrors, 'get should return "global" ' . $this->getOption('idem'));			
		if ($this->getCategoryOption(1, 'idem') != 'category') 
			array_push($aErrors, 'get should return "category" ' . $this->getCategoryOption(1, 'idem'));			
		if ($this->getBlogOption(1, 'idem') != 'blog') 
			array_push($aErrors, 'get should return "blog" ' . $this->getBlogOption(1, 'idem'));			
		if ($this->getMemberOption(1, 'idem') != 'member') 
			array_push($aErrors, 'get should return "member" ' . $this->getMemberOption(1, 'idem'));			
			
		echo '<h1>Setting options</h1>';			
		if (!$this->setOption('idem','edit-global'))
			array_push($aErrors, 'set option failed');
		if (!$this->setCategoryOption(1, 'idem', 'edit-category'))
			array_push($aErrors, 'set catgeory option failed');
		if (!$this->setBlogOption(1, 'idem', 'edit-blog'))
			array_push($aErrors, 'set blog option failed');
		if (!$this->setMemberOption(1, 'idem', 'edit-member'))
			array_push($aErrors, 'set member option failed');

		echo '<h1>Checking options</h1>';
		if ($this->getOption('idem') != 'edit-global') 
			array_push($aErrors, 'get should return "edit-global"');			
		if ($this->getCategoryOption(1, 'idem') != 'edit-category') 
			array_push($aErrors, 'get should return "edit-category"');			
		if ($this->getBlogOption(1, 'idem') != 'edit-blog') 
			array_push($aErrors, 'get should return "edit-blog"');			
		if ($this->getMemberOption(1, 'idem') != 'edit-member') 
			array_push($aErrors, 'get should return "edit-member"');			
			
		if (count($aErrors) > 0);
			echo '<ul><li>' . implode('</li><li>', $aErrors). '</li></ul>';
		
		echo '<pre>';
		echo "All blog options:\n";
		print_r($this->getAllBlogOptions('idem'));
		
		echo "\nAll category options:\n";
		print_r($this->getAllCategoryOptions('idem'));

		echo "\nAll member options:\n";
		print_r($this->getAllMemberOptions('idem'));

		echo '</pre>';
		
	}
	
}
?>