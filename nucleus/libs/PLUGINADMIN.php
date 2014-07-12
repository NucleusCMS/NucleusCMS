<?php

/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2009 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */
/**
 * code to make it easier to create plugin admin areas
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2009 The Nucleus Group
 * @version $Id$
 */

class PluginAdmin {

	var $strFullName;		// NP_SomeThing
	var $plugin;			// ref. to plugin object
	var $bValid;			// evaluates to true when object is considered valid
	var $admin;				// ref to an admin object

	function PluginAdmin($pluginName)
	{
		global $manager, $DIR_LIBS;
                include_once($DIR_LIBS . 'ADMIN.php');

		$this->strFullName = 'NP_' . $pluginName;

		// check if plugin exists and is installed
		if (!$manager->pluginInstalled($this->strFullName))
			doError(_ERROR_INVALID_PLUGIN);

		$this->plugin =& $manager->getPlugin($this->strFullName);
		$this->bValid = $this->plugin;

		if (!$this->bValid)
			doError(_ERROR_INVALID_PLUGIN);

		$this->admin = new ADMIN();
		$this->admin->action = 'plugin_' . $pluginName;
	}

	function start($extraHead = '')
	{
		global $CONF;
		$strBaseHref  = '<base href="' . htmlspecialchars($CONF['AdminURL'],ENT_QUOTES,_CHARSET) . '" />';
		$extraHead .= $strBaseHref;

		$this->admin->pagehead($extraHead);
	}

	function end()
	{
		$this->_AddTicketByJS();
		$this->admin->pagefoot();
	}

/** 
 * Add ticket when not used in plugin's admin page
 * to avoid CSRF.
 */
	function _AddTicketByJS(){
		global $CONF,$ticketforplugin;
		if (!($ticket=$ticketforplugin['ticket'])) {
			//echo "\n<!--TicketForPlugin skipped-->\n";
			return;
		}
		$ticket=htmlspecialchars($ticket,ENT_QUOTES,_CHARSET);
 
?><script type="text/javascript">
/*<![CDATA[*/
/* Add tickets for available links (outside blog excluded) */
for (i=0;document.links[i];i++){
  if (document.links[i].href.indexOf('<?php echo $CONF['PluginURL']; ?>',0)<0
    && !(document.links[i].href.indexOf('//',0)<0)) continue;
  if ((j=document.links[i].href.indexOf('?',0))<0) continue;
  if (document.links[i].href.indexOf('ticket=',j)>=0) continue;
  document.links[i].href=document.links[i].href.substring(0,j+1)+'ticket=<?php echo $ticket; ?>&'+document.links[i].href.substring(j+1);
}
/* Add tickets for forms (outside blog excluded) */
for (i=0;document.forms[i];i++){
  /* check if ticket is already used */
  for (j=0;document.forms[i].elements[j];j++) {
    if (document.forms[i].elements[j].name=='ticket') {
      j=-1;
      break;
    }
  }
  if (j==-1) continue;
 
  /* check if the modification works */
  try{document.forms[i].innerHTML+='';}catch(e){
    /* Modificaion falied: this sometime happens on IE */
    if (!document.forms[i].action.name && document.forms[i].method.toUpperCase()=="POST") {
      /* <input name="action"/> is not used for POST method*/
      if (document.forms[i].action.indexOf('<?php echo $CONF['PluginURL']; ?>',0)<0
        && !(document.forms[i].action.indexOf('//',0)<0)) continue;
      if (0<(j=document.forms[i].action.indexOf('?',0))) if (0<document.forms[i].action.indexOf('ticket=',j)) continue;
      if (j<0) document.forms[i].action+='?'+'ticket=<?php echo $ticket; ?>';
      else document.forms[i].action+='&'+'ticket=<?php echo $ticket; ?>';
      continue;
    }
    document.write('<?php echo _PLUGINADMIN_TICKETS_JAVASCRIPT ?>');
    j=document.forms[i].outerHTML;
    while (j!=j.replace('<','&lt;')) j=j.replace('<','&lt;');
    document.write('<p>'+j+'</p>');
    continue;
  }
  /* check the action paramer in form tag */
  /* note that <input name="action"/> may be used here */
  j=document.forms[i].innerHTML;
  document.forms[i].innerHTML='';
  if ((document.forms[i].action+'').indexOf('<?php echo $CONF['PluginURL']; ?>',0)<0
      && !((document.forms[i].action+'').indexOf('//',0)<0)) {
    document.forms[i].innerHTML=j;
    continue;
  }
  /* add ticket */
  document.forms[i].innerHTML=j+'<input type="hidden" name="ticket" value="<?php echo $ticket; ?>"/>';
}
/*]]>*/
</script><?php
 
	}
}



?>
