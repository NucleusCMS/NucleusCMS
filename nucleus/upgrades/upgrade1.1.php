<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */
/**
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group
 */

function upgrade_do110() {
    global $upgrade_failures;

    if (upgrade_checkinstall(110))
        return "already installed";
    
    // 1. add some options to nucleus_config
    if (!upgrade_checkIfCVExists('CookiePath')) {
        $query = 'INSERT INTO '.sql_table('config')." VALUES ('CookiePath', '/');";
        upgrade_query('CookiePath setting',$query);
    }
    if (!upgrade_checkIfCVExists('CookieDomain')) {
        $query = 'INSERT INTO '.sql_table('config')." VALUES ('CookieDomain', '');";
        upgrade_query('CookieDomain setting',$query);
    }
    if (!upgrade_checkIfCVExists('CookieSecure')) {
        $query = 'INSERT INTO '.sql_table('config')." VALUES ('CookieSecure', '0');";
        upgrade_query('CookieSecure setting',$query);
    }
    if (!upgrade_checkIfCVExists('MediaPrefix')) {
        $query = 'INSERT INTO '.sql_table('config')." VALUES ('MediaPrefix', '1');";
        upgrade_query('MediaPrefix setting',$query);
    }
    
    // 2. add language field to member table
    if(!upgrade_checkIfColumnExists('member', 'deflang')){
        upgrade_query("Language setting (member)", 
                      'ALTER TABLE '.sql_table('member')." ADD deflang varchar(20) NOT NULL default '';");
    }

    // 3. create category table and update other tables (nucleus_item and nucleus_blog)
    $mark=$upgrade_failures;
    if (!upgrade_checkIfTableExists('plugin')) {
        $query = 'CREATE TABLE '.sql_table('category').' ('
            ." catid int(11) NOT NULL auto_increment,"
            ." cblog int(11) NOT NULL, "
            ." cname varchar(40),"
            ." cdesc varchar(200),"
            ." PRIMARY KEY (catid)"
            .") ";
        upgrade_query('New table '.sql_table('category'), $query);
    }
    if(!upgrade_checkIfColumnExists('item', 'icat')){
        upgrade_query("Adding category attribute to item-table", 
            'ALTER TABLE '.sql_table('item').' ADD icat int(11)');
    }
    if(!upgrade_checkIfColumnExists('blog', 'bdefcat')){
        upgrade_query("Adding defcat attribute to blog-table", 
            'ALTER TABLE '.sql_table('blog').' ADD bdefcat int(11)');
    }
    
    //The following blocks should check for existing values and only update as needed.
    if($mark==$upgrade_failures){
        // 4. add 'general' categories for all blogs, and update nucleus_item
        $catid = 1;    // generate catids ourself
        $query = 'SELECT bnumber FROM '.sql_table('blog');
        $res = sql_query($query);
        while ($current = sql_fetch_object($res)) {
            $blogid = $current->bnumber;
            
            $query = 'INSERT INTO '.sql_table('category')." (catid, cblog, cname, cdesc) VALUES ($catid, $blogid, 'General', 'Items that do not fit in other categories')";
            $r = upgrade_query("Adding category 'general' for blog " . $blogid, $query);
            
            // only perform next actions when insert went ok
            if ($r) {
                $query = 'UPDATE '.sql_table('blog')." SET bdefcat=$catid WHERE bnumber=$blogid";
                upgrade_query("Setting the default category for blog $blogid to the 'General' category", $query);
            
                $query = 'UPDATE '.sql_table('item')." SET icat=$catid WHERE iblog=$blogid";
                upgrade_query("Assigning all existing items of blog $blogid to the 'General' category",$query);
            }
        
            $catid++;
        }
        
        // 5. add template parts for category lists to all templates
        $query = 'SELECT tdnumber FROM '.sql_table('template_desc');
        $res = sql_query($query);    // get all template ids
        while ($obj = sql_fetch_object($res)) {
            $tid = $obj->tdnumber;     // template id
        
            $query = 'INSERT INTO '.sql_table('template')." VALUES ($tid, 'CATLIST_HEADER', '<ul><li><a href=\"<%blogurl%>\">All</a></li>');";
            $query2 = 'INSERT INTO '.sql_table('template')." VALUES ($tid, 'CATLIST_LISTITEM', '<li><a href=\"<%catlink%>\"><%catname%></a></li>');";
            $query3 = 'INSERT INTO '.sql_table('template')." VALUES ($tid, 'CATLIST_FOOTER', '</ul>');";
            upgrade_query("Adding categorylist header to template $tid",$query);
            upgrade_query("Adding categorylist item to template $tid",$query2);
            upgrade_query("Adding categorylist footer to template $tid",$query3);
            
        }
    }
    
    // 6. add content type field to skins
    if(!upgrade_checkIfColumnExists('skin_desc', 'sdtype')){
        $query = 'ALTER TABLE '.sql_table('skin_desc')." ADD sdtype VARCHAR(40) NOT NULL DEFAULT 'text/html'";
        upgrade_query("Adding content type field to skins (text/html)", $query);
    }
    
    // 7. try to set content type for xml-rss skin to text/xml
    $query = 'UPDATE '.sql_table('skin_desc')." SET sdtype='text/xml' WHERE sdname='xmlrss'";
    upgrade_query("Setting content type for xmlrss skin to text/xml", $query);
    
    // 8. add bnotifytype column to blog tables
    if(0==$upgrade_failures && !upgrade_checkIfColumnExists('blog', 'bnotifytype')){
        upgrade_query("Adding Notify Type Setting", 
                      'ALTER TABLE '.sql_table('blog')." ADD bnotifytype INT(11) NOT NULL default '15';");
    }else{
        echo "<li>Adding Notify Type Setting ... <span class=\"warning\">NOT EXECUTED</span>\n<blockquote>Errors occurred during upgrade process.</blockquote>";
    }
}
