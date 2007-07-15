CREATE TABLE `nucleus_actionlog` (
  `timestamp` datetime NOT NULL default '0000-00-00 00:00:00',
  `message` varchar(255) NOT NULL default ''
) TYPE=MyISAM;

CREATE TABLE `nucleus_activation` (
  `vkey` varchar(40) NOT NULL default '',
  `vtime` datetime NOT NULL default '0000-00-00 00:00:00',
  `vmember` int(11) NOT NULL default '0',
  `vtype` varchar(15) NOT NULL default '',
  `vextra` varchar(128) NOT NULL default '',
  PRIMARY KEY  (`vkey`)
) TYPE=MyISAM;

CREATE TABLE `nucleus_ban` (
  `iprange` varchar(15) NOT NULL default '',
  `reason` varchar(255) NOT NULL default '',
  `blogid` int(11) NOT NULL default '0'
) TYPE=MyISAM;

CREATE TABLE `nucleus_blog` (
  `bnumber` int(11) NOT NULL auto_increment,
  `bname` varchar(60) NOT NULL default '',
  `bshortname` varchar(15) NOT NULL default '',
  `bdesc` varchar(200) default NULL,
  `bcomments` tinyint(2) NOT NULL default '1',
  `bmaxcomments` int(11) NOT NULL default '0',
  `btimeoffset` decimal(3,1) NOT NULL default '0.0',
  `bnotify` varchar(60) default NULL,
  `burl` varchar(100) default NULL,
  `bupdate` varchar(60) default NULL,
  `bdefskin` int(11) NOT NULL default '1',
  `bpublic` tinyint(2) NOT NULL default '1',
  `bsendping` tinyint(2) NOT NULL default '0',
  `bconvertbreaks` tinyint(2) NOT NULL default '1',
  `bdefcat` int(11) default NULL,
  `bnotifytype` int(11) NOT NULL default '15',
  `ballowpast` tinyint(2) NOT NULL default '0',
  `bincludesearch` tinyint(2) NOT NULL default '0',
  `breqemail` TINYINT( 2 ) DEFAULT '0' NOT NULL,
  `bfuturepost` TINYINT(2) DEFAULT '0' NOT NULL,
  PRIMARY KEY  (`bnumber`),
  UNIQUE KEY `bnumber` (`bnumber`),
  UNIQUE KEY `bshortname` (`bshortname`)
) TYPE=MyISAM;

INSERT INTO `nucleus_blog` VALUES (1, 'My Nucleus CMS', 'mynucleuscms', '', 1, 0, 0.0, '', 'http://localhost:8080/nucleus/', '', 5, 1, 0, 1, 1, 1, 1, 0, 0, 0);

CREATE TABLE `nucleus_category` (
  `catid` int(11) NOT NULL auto_increment,
  `cblog` int(11) NOT NULL default '0',
  `cname` varchar(200) default NULL,
  `cdesc` varchar(200) default NULL,
  PRIMARY KEY  (`catid`)
) TYPE=MyISAM;

INSERT INTO `nucleus_category` VALUES (1, 1, 'General', 'Items that do not fit in other categories');

CREATE TABLE `nucleus_comment` (
  `cnumber` int(11) NOT NULL auto_increment,
  `cbody` text NOT NULL,
  `cuser` varchar(40) default NULL,
  `cmail` varchar(100) default NULL,
  `cemail` VARCHAR( 100 ),
  `cmember` int(11) default NULL,
  `citem` int(11) NOT NULL default '0',
  `ctime` datetime NOT NULL default '0000-00-00 00:00:00',
  `chost` varchar(60) default NULL,
  `cip` varchar(15) NOT NULL default '',
  `cblog` int(11) NOT NULL default '0',
  PRIMARY KEY  (`cnumber`),
  UNIQUE KEY `cnumber` (`cnumber`),
  KEY `citem` (`citem`),
  FULLTEXT KEY `cbody` (`cbody`)
) TYPE=MyISAM;

CREATE TABLE `nucleus_config` (
  `name` varchar(20) NOT NULL default '',
  `value` varchar(128) default NULL,
  PRIMARY KEY  (`name`)
) TYPE=MyISAM;

INSERT INTO `nucleus_config` VALUES ('DefaultBlog', '1');
INSERT INTO `nucleus_config` VALUES ('AdminEmail', 'example@example.org');
INSERT INTO `nucleus_config` VALUES ('IndexURL', 'http://localhost:8080/nucleus/');
INSERT INTO `nucleus_config` VALUES ('Language', 'english');
INSERT INTO `nucleus_config` VALUES ('SessionCookie', '');
INSERT INTO `nucleus_config` VALUES ('AllowMemberCreate', '');
INSERT INTO `nucleus_config` VALUES ('AllowMemberMail', '1');
INSERT INTO `nucleus_config` VALUES ('SiteName', 'My Nucleus CMS');
INSERT INTO `nucleus_config` VALUES ('AdminURL', 'http://localhost:8080/nucleus/nucleus/');
INSERT INTO `nucleus_config` VALUES ('NewMemberCanLogon', '1');
INSERT INTO `nucleus_config` VALUES ('DisableSite', '');
INSERT INTO `nucleus_config` VALUES ('DisableSiteURL', 'http://www.this-page-intentionally-left-blank.org/');
INSERT INTO `nucleus_config` VALUES ('LastVisit', '');
INSERT INTO `nucleus_config` VALUES ('MediaURL', 'http://localhost:8080/nucleus/media/');
INSERT INTO `nucleus_config` VALUES ('AllowedTypes', 'jpg,jpeg,gif,mpg,mpeg,avi,mov,mp3,swf,png');
INSERT INTO `nucleus_config` VALUES ('AllowLoginEdit', '');
INSERT INTO `nucleus_config` VALUES ('AllowUpload', '1');
INSERT INTO `nucleus_config` VALUES ('DisableJsTools', '2');
INSERT INTO `nucleus_config` VALUES ('CookiePath', '/');
INSERT INTO `nucleus_config` VALUES ('CookieDomain', '');
INSERT INTO `nucleus_config` VALUES ('CookieSecure', '');
INSERT INTO `nucleus_config` VALUES ('CookiePrefix', '');
INSERT INTO `nucleus_config` VALUES ('MediaPrefix', '1');
INSERT INTO `nucleus_config` VALUES ('MaxUploadSize', '1048576');
INSERT INTO `nucleus_config` VALUES ('NonmemberMail', '');
INSERT INTO `nucleus_config` VALUES ('PluginURL', 'http://localhost:8080/nucleus/nucleus/plugins/');
INSERT INTO `nucleus_config` VALUES ('ProtectMemNames', '1');
INSERT INTO `nucleus_config` VALUES ('BaseSkin', '5');
INSERT INTO `nucleus_config` VALUES ('SkinsURL', 'http://localhost:8080/nucleus/skins/');
INSERT INTO `nucleus_config` VALUES ('ActionURL', 'http://localhost:8080/nucleus/action.php');
INSERT INTO `nucleus_config` VALUES ('URLMode', 'normal');
INSERT INTO `nucleus_config` VALUES ('DatabaseVersion', '330');

CREATE TABLE `nucleus_item` (
  `inumber` int(11) NOT NULL auto_increment,
  `ititle` varchar(160) default NULL,
  `ibody` text NOT NULL,
  `imore` text,
  `iblog` int(11) NOT NULL default '0',
  `iauthor` int(11) NOT NULL default '0',
  `itime` datetime NOT NULL default '0000-00-00 00:00:00',
  `iclosed` tinyint(2) NOT NULL default '0',
  `idraft` tinyint(2) NOT NULL default '0',
  `ikarmapos` int(11) NOT NULL default '0',
  `icat` int(11) default NULL,
  `ikarmaneg` int(11) NOT NULL default '0',
  `iposted` tinyint(2) NOT NULL default '1',
  PRIMARY KEY  (`inumber`),
  UNIQUE KEY `inumber` (`inumber`),
  KEY `itime` (`itime`),
  FULLTEXT KEY `ibody` (`ibody`,`ititle`,`imore`)
) TYPE=MyISAM PACK_KEYS=0;

INSERT INTO `nucleus_item` VALUES (1, 'Welcome to Nucleus CMS v3.3', 'This is the first post on your Nucleus CMS. Nucleus offers you the building blocks you need to create a web presence. Whether you want to create a personal blog, a family page, or an online business site, Nucleus CMS can help you achieve your goals.<br />
<br />
We\'ve loaded this first entry with links and information to get you started. Though you can delete this entry, it will eventually scroll off the main page as you add content to your site. Add your comments while you learn to work with Nucleus CMS, or bookmark this page so you can come back to it when you need to.', '<b>Home - <a href=\"http://nucleuscms.org/\" title=\"Nucleus CMS home\">nucleuscms.org</a></b><br />
Welcome to the world of Nucleus CMS. In 2001 a set of PHP scripts were let loose on the open Internet. Those scripts, which took user-generated data and used it to dynamically create html pages, contained the ideas and the algorithms that are the core of today’s Nucleus CMS. Though Nucleus CMS 3.3 is far more flexible and powerful than the scripts from which it emerged, it still expresses the values that guided its birth: flexibility, security, and computational elegance.<br />
<br />
Thanks to an international community of sophisticated developers and designers, Nucleus CMS remains simple enough for anyone to learn, and expandable enough to allow you to build almost any website you can imagine. Nucleus CMS lets you integrate text, images, and user comments in a seamless package that will make your web presence as serious, professional, personal, or fun as you want it to be. We hope you enjoy its power.<br />
<br />
<b>Documentation - <a href=\"http://docs.nucleuscms.org/\" title=\"Nucleus CMS Documentation\">docs.nucleuscms.org</a></b><br />
The install process places a <a href=\"nucleus/documentation/\">user</a> and a <a href=\"nucleus/documentation/devdocs/\">developer</a> documentation on your web server. Pop-up <a href=\"/nucleus/documentation/help.html\">help</a> is available throughout the administration area to assist you in maintaining and customizing your site. When in the Nucleus CMS admin area, click on this symbol <img src=\"nucleus/documentation/icon-help.gif\" width=\"15\" height=\"15\" alt=\"help icon\" /> for context-sensitive help. You can also read this documentation online under <a href=\"http://docs.nucleuscms.org/\" title=\"Nucleus CMS Documentation\">docs.nucleuscms.org</a>.<br />
<br />
<b>Frequently Asked Questions - <a nicetitle=\"Nucleus CMS FAQ\" href=\"http://faq.nucleuscms.org/\">faq.nucleuscms.org</a></b><br />
If you need more information about managing, extending or troubleshooting your Nucleus CMS the Nucleus FAQ is the first place to search information. Over 170 frequently asked questions are answered from experienced Nucleus users.<br />
<br />
<b>Support - <a href=\"http://forum.nucleuscms.org/\" title=\"Nucleus CMS Support Forum\">forum.nucleuscms.org</a></b><br />
Should you require assistance, please don\'t hesitate to <a href=\"http://forum.nucleuscms.org/faq.php\">join</a> the 6,800+ registered users on our forums. With its built-in search capability of the 73,000+ posted articles, your answers are just a few clicks away. Remember: almost any question you think of has already been asked on the forums, and almost anything you want to do with Nucleus has been tried and explained there. Be sure to check them out.<br />
<br />
<b>Demonstration - <a href=\"http://demo.nucleuscms.org/\" title=\"Nucleus CMS Demonstration\">demo.nucleuscms.org</a></b><br />
Want to play around, test changes or tell a friend or relative about Nucleus CMS? Visit our live <a href=\"http://demo.nucleuscms.org/\">demo site</a>.<br />
<br />
<b>Skins - <a href=\"http://skins.nucleuscms.org/\" title=\"Nucleus CMS Skins\">skins.nucleuscms.org</a></b><br />
The combination of multi-weblogs and skins/templates make for a powerful duo in personalizing your site or designing one for a friend, relative or business client. Import new skins to change the look of your website, or create your own skins and share them with the Nucleus community! Help designing or modifying skins is only a few clicks away in the Nucleus forums.<br />
<br />
<b>Plugins - <a href=\"http://plugins.nucleuscms.org/\" title=\"Nucleus plugins\">plugins.nucleuscms.org</a></b><br />
Looking to add some extra functionality to the base Nucleus CMS package? Our <a href=\"http://wiki.nucleuscms.org/plugin\">plugin repository</a> gives you plenty of ways to extend and expand what Nucleus CMS can do; your imagination and creativity are the only limit on how Nucleus CMS can work for you.<br />
<br />
<b>Development - <a href=\"http://dev.nucleuscms.org/\" title=\"Nucleus Development\">dev.nucleuscms.org</a></b><br />
If you need more information about the Nucleus development you can find Informations in the developer documents at <a href=\"http://dev.nucleuscms.org/\" title=\"Nucleus Development\">dev.nucleuscms.org</a> or in the <a href=\"http://forum.nucleuscms.org/\">Support Forum</a>. Sourceforge.net graciously hosts our <a href=\"http://sourceforge.net/projects/nucleuscms/\">Open Source project page</a> which contains our software downloads and CVS repository.<br />
<br />
<b>Donators</b><br />
We would like to thank these <a href=\"http://nucleuscms.org/donators.php\">nice people</a> for their <a href=\"http://nucleuscms.org/donate.php\">support</a>. <em>Thanks all!</em><br />
<br />
<b>Vote for Nucleus CMS</b><br />
Like Nucleus CMS? Vote for us at <a href=\"http://www.hotscripts.com/Detailed/13368.html?RID=nucleus@demuynck.org\">HotScripts</a> and <a href=\"http://www.opensourcecms.com/index.php?option=content&task=view&id=145\">opensourceCMS</a>.<br />
<br />
<b>License</b><br />
When we speak of free software, we are referring to freedom, not price. Our <a href=\"http://www.gnu.org/licenses/gpl.html\">General Public Licenses</a> are designed to make sure that you have the freedom to distribute copies of free software (and charge for this service if you wish), that you receive source code or can get it if you want it, that you can change the software or use pieces of it in new free programs; and that you know you can do these things.', 1, 1, '2005-08-15 11:04:26', 0, 0, 0, 1, 0, 1);

CREATE TABLE `nucleus_karma` (
  `itemid` int(11) NOT NULL default '0',
  `ip` char(15) NOT NULL default ''
) TYPE=MyISAM;

CREATE TABLE `nucleus_member` (
  `mnumber` int(11) NOT NULL auto_increment,
  `mname` varchar(16) NOT NULL default '',
  `mrealname` varchar(60) default NULL,
  `mpassword` varchar(40) NOT NULL default '',
  `memail` varchar(60) default NULL,
  `murl` varchar(100) default NULL,
  `mnotes` varchar(100) default NULL,
  `madmin` tinyint(2) NOT NULL default '0',
  `mcanlogin` tinyint(2) NOT NULL default '1',
  `mcookiekey` varchar(40) default NULL,
  `deflang` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`mnumber`),
  UNIQUE KEY `mname` (`mname`),
  UNIQUE KEY `mnumber` (`mnumber`)
) TYPE=MyISAM;

INSERT INTO `nucleus_member` VALUES (1, 'example', 'example', '1a79a4d60de6718e8e5b326e338ae533', 'example@example.org', 'http://localhost:8080/nucleus/', '', 1, 1, 'd767aefc60415859570d64c649257f19', '');

CREATE TABLE `nucleus_plugin` (
  `pid` int(11) NOT NULL auto_increment,
  `pfile` varchar(40) NOT NULL default '',
  `porder` int(11) NOT NULL default '0',
  PRIMARY KEY  (`pid`),
  KEY `pid` (`pid`),
  KEY `porder` (`porder`)
) TYPE=MyISAM;

CREATE TABLE `nucleus_plugin_event` (
  `pid` int(11) NOT NULL default '0',
  `event` varchar(40) default NULL,
  KEY `pid` (`pid`)
) TYPE=MyISAM;

CREATE TABLE `nucleus_plugin_option` (
  `ovalue` text NOT NULL,
  `oid` int(11) NOT NULL auto_increment,
  `ocontextid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`oid`,`ocontextid`)
) TYPE=MyISAM;

CREATE TABLE `nucleus_plugin_option_desc` (
  `oid` int(11) NOT NULL auto_increment,
  `opid` int(11) NOT NULL default '0',
  `oname` varchar(20) NOT NULL default '',
  `ocontext` varchar(20) NOT NULL default '',
  `odesc` varchar(255) default NULL,
  `otype` varchar(20) default NULL,
  `odef` text,
  `oextra` text,
  PRIMARY KEY  (`opid`,`oname`,`ocontext`),
  UNIQUE KEY `oid` (`oid`)
) TYPE=MyISAM;

CREATE TABLE `nucleus_skin` (
  `sdesc` int(11) NOT NULL default '0',
  `stype` varchar(20) NOT NULL default '',
  `scontent` text NOT NULL,
  PRIMARY KEY  (`sdesc`,`stype`)
) TYPE=MyISAM;

INSERT INTO `nucleus_skin` VALUES (2, 'index', '<?xml version=\"1.0\" encoding=\"<%charset%>\"?>\n\n<feed xml:lang=\"en-us\" xmlns=\"http://www.w3.org/2005/Atom\">\n    <title><%blogsetting(name)%></title>\n    <id><%blogsetting(url)%>:<%blogsetting(id)%></id>\n\n    <link rel=\"alternate\" type=\"text/html\" href=\"<%blogsetting(url)%>\" />\n    <link rel=\"self\" type=\"application/atom+xml\" href=\"<%blogsetting(url)%><%self%>\" />\n    <generator uri=\"http://nucleuscms.org/\"><%version%></generator>\n    <updated><%blog(feeds/atom/modified,1)%></updated>\n\n    <%blog(feeds/atom/entries,10)%>\n</feed>');
INSERT INTO `nucleus_skin` VALUES (4, 'index', '<?xml version="1.0"?>\r\n<rsd version="1.0">\r\n <service>\r\n  <engineName><%version%></engineName>\r\n  <engineLink>http://nucleuscms.org/</engineLink>\r\n  <homepageLink><%sitevar(url)%></homepageLink>\r\n  <apis>\r\n   <api name="MetaWeblog" preferred="true" apiLink="<%adminurl%>xmlrpc/server.php" blogID="<%blogsetting(id)%>">\r\n    <docs>http://nucleuscms.org/documentation/devdocs/xmlrpc.html</docs>\r\n   </api>\r\n   <api name="Blogger" preferred="false" apiLink="<%adminurl%>xmlrpc/server.php" blogID="<%blogsetting(id)%>">\r\n    <docs>http://nucleuscms.org/documentation/devdocs/xmlrpc.html</docs>\r\n   </api>\r\n  </apis>\r\n </service>\r\n</rsd>');
INSERT INTO `nucleus_skin` VALUES (3, 'index', '<?xml version="1.0" encoding="<%charset%>"?>\r\n<rss version="2.0">\r\n  <channel>\r\n    <title><%blogsetting(name)%></title>\r\n    <link><%blogsetting(url)%></link>\r\n    <description><%blogsetting(desc)%></description>\r\n    <language>en-us</language>           \r\n    <generator><%version%></generator>\r\n    <copyright>�</copyright>             \r\n    <category>Weblog</category>\r\n    <docs>http://backend.userland.com/rss</docs>\r\n    <image>\r\n      <url><%blogsetting(url)%>/nucleus/nucleus2.gif</url>\r\n      <title><%blogsetting(name)%></title>\r\n      <link><%blogsetting(url)%></link>\r\n    </image>\r\n    <%blog(feeds/rss20,10)%>\r\n  </channel>\r\n</rss>');

CREATE TABLE `nucleus_skin_desc` (
  `sdnumber` int(11) NOT NULL auto_increment,
  `sdname` varchar(20) NOT NULL default '',
  `sddesc` varchar(200) default NULL,
  `sdtype` varchar(40) NOT NULL default 'text/html',
  `sdincmode` varchar(10) NOT NULL default 'normal',
  `sdincpref` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`sdnumber`),
  UNIQUE KEY `sdname` (`sdname`),
  UNIQUE KEY `sdnumber` (`sdnumber`)
) TYPE=MyISAM;

INSERT INTO `nucleus_skin_desc` VALUES (2, 'feeds/atom', 'Atom 1.0 weblog syndication', 'application/atom+xml', 'normal', '');
INSERT INTO `nucleus_skin_desc` VALUES (3, 'feeds/rss20', 'RSS 2.0 syndication of weblogs', 'text/xml', 'normal', '');
INSERT INTO `nucleus_skin_desc` VALUES (4, 'xml/rsd', 'RSD (Really Simple Discovery) information for weblog clients', 'text/xml', 'normal', '');
INSERT INTO `nucleus_skin_desc` VALUES (5, 'default', 'Nucleus CMS default skin', 'text/html', 'skindir', 'default/');

CREATE TABLE `nucleus_team` (
  `tmember` int(11) NOT NULL default '0',
  `tblog` int(11) NOT NULL default '0',
  `tadmin` tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (`tmember`,`tblog`)
) TYPE=MyISAM;

INSERT INTO `nucleus_team` VALUES (1, 1, 1);

CREATE TABLE `nucleus_template` (
  `tdesc` int(11) NOT NULL default '0',
  `tpartname` varchar(20) NOT NULL default '',
  `tcontent` text NOT NULL,
  PRIMARY KEY  (`tdesc`,`tpartname`)
) TYPE=MyISAM;

INSERT INTO `nucleus_template` VALUES (3, 'ITEM', '<item>\r\n <title><%title(xml)%></title>\r\n <link><%blogurl%>index.php?itemid=<%itemid%></link>\r\n<description><![CDATA[<%body%><%more%>]]></description>\r\n <category><%category%></category>\r\n<comments><%blogurl%>index.php?itemid=<%itemid%></comments>\r\n <pubDate><%date(rfc822)%></pubDate>\r\n</item>');
INSERT INTO `nucleus_template` VALUES (3, 'EDITLINK', '<a href="<%editlink%>" onclick="<%editpopupcode%>">edit</a>');
INSERT INTO `nucleus_template` VALUES (3, 'FORMAT_DATE', '%x');
INSERT INTO `nucleus_template` VALUES (3, 'FORMAT_TIME', '%X');
INSERT INTO `nucleus_template` VALUES (4, 'ITEM', '<%date(utc)%>');
INSERT INTO `nucleus_template` VALUES (5, 'ITEM', '<entry>\n <title type=\"html\"><![CDATA[<%title%>]]></title>\n <link rel=\"alternate\" type=\"text/html\" href=\"<%blogurl%>index.php?itemid=<%itemid%>\" />\n <author>\n  <name><%author%></name>\n </author>\n <updated><%date(utc)%></updated>\n <published><%date(iso8601)%></published>\n <content type=\"html\"><![CDATA[<%body%><%more%>]]></content>\n <id><%blogurl%>:<%blogid%>:<%itemid%></id>\n</entry>');
INSERT INTO `nucleus_template` VALUES (5, 'POPUP_CODE', '<%media%>');
INSERT INTO `nucleus_template` VALUES (5, 'IMAGE_CODE', '<%image%>');
INSERT INTO `nucleus_template` VALUES (5, 'MEDIA_CODE', '<%media%>');
INSERT INTO `nucleus_template` VALUES (3, 'POPUP_CODE', '<%image%>');
INSERT INTO `nucleus_template` VALUES (3, 'MEDIA_CODE', '<%media%>');
INSERT INTO `nucleus_template` VALUES (3, 'IMAGE_CODE', '<%media%>');

CREATE TABLE `nucleus_template_desc` (
  `tdnumber` int(11) NOT NULL auto_increment,
  `tdname` varchar(20) NOT NULL default '',
  `tddesc` varchar(200) default NULL,
  PRIMARY KEY  (`tdnumber`),
  UNIQUE KEY `tdnumber` (`tdnumber`),
  UNIQUE KEY `tdname` (`tdname`)
) TYPE=MyISAM;

INSERT INTO `nucleus_template_desc` VALUES (4, 'feeds/atom/modified', 'Atom feeds: Inserts last modification date');
INSERT INTO `nucleus_template_desc` VALUES (5, 'feeds/atom/entries', 'Atom feeds: Feed items');
INSERT INTO `nucleus_template_desc` VALUES (3, 'feeds/rss20', 'Used for RSS 2.0 syndication of your blog');
INSERT INTO `nucleus_template_desc` VALUES (8, 'default/index', 'Nucleus CMS default index template');
INSERT INTO `nucleus_template_desc` VALUES (9, 'default/item', 'Nucleus CMS default item template');

CREATE TABLE `nucleus_tickets` (
  `ticket` varchar(40) NOT NULL default '',
  `ctime` datetime NOT NULL default '0000-00-00 00:00:00',
  `member` int(11) NOT NULL default '0',
  PRIMARY KEY  (`ticket`,`member`)
) TYPE=MyISAM;
