CREATE TABLE `nucleus_actionlog` (
  `timestamp` datetime NOT NULL default '0000-00-00 00:00:00',
  `message` varchar(255) NOT NULL default ''
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
  PRIMARY KEY  (`bnumber`),
  UNIQUE KEY `bnumber` (`bnumber`),
  UNIQUE KEY `bshortname` (`bshortname`)
) TYPE=MyISAM;

INSERT INTO `nucleus_blog` VALUES (1, 'My Nucleus Weblog', 'myweblog', '', 1, 0, 0.0, '', 'http://localhost:8080/nucleus/', '', 1, 1, 0, 1, 1, 1, 1, 0);

CREATE TABLE `nucleus_category` (
  `catid` int(11) NOT NULL auto_increment,
  `cblog` int(11) NOT NULL default '0',
  `cname` varchar(40) default NULL,
  `cdesc` varchar(200) default NULL,
  PRIMARY KEY  (`catid`)
) TYPE=MyISAM;

INSERT INTO `nucleus_category` VALUES (1, 1, 'General', 'Items that do not fit in other categories');

CREATE TABLE `nucleus_comment` (
  `cnumber` int(11) NOT NULL auto_increment,
  `cbody` text NOT NULL,
  `cuser` varchar(40) default NULL,
  `cmail` varchar(100) default NULL,
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
INSERT INTO `nucleus_config` VALUES ('SiteName', 'My Nucleus Weblog');
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
INSERT INTO `nucleus_config` VALUES ('PluginURL', 'http://localhost:8080/plugins/');
INSERT INTO `nucleus_config` VALUES ('ProtectMemNames', '1');
INSERT INTO `nucleus_config` VALUES ('BaseSkin', '1');
INSERT INTO `nucleus_config` VALUES ('SkinsURL', 'http://localhost:8080/nucleus/skins/');
INSERT INTO `nucleus_config` VALUES ('ActionURL', 'http://localhost:8080/nucleus/action.php');
INSERT INTO `nucleus_config` VALUES ('URLMode', 'normal');
INSERT INTO `nucleus_config` VALUES ('DatabaseVersion', '310');

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
  PRIMARY KEY  (`inumber`),
  UNIQUE KEY `inumber` (`inumber`),
  KEY `itime` (`itime`),
  FULLTEXT KEY `ibody` (`ibody`,`ititle`,`imore`)
) TYPE=MyISAM PACK_KEYS=0;

INSERT INTO `nucleus_item` VALUES (1, 'Welcome to Nucleus v3.1', 'The building blocks are here to help you create a web presence. Be it a blog, a family page, a hobby site or maybe you just don\'t have any idea.\r<br />\n\r<br />\nWell you came to the right place, cause we didn\'t know what you wanted either.', '<b>Read Me</b>\r<br />\n\r<br />\nThis is the first entry in your site. We\'ve loaded it up with links and information to get you started. \r<br />\n\r<br />\nThough you can delete this entry, it will eventually scroll off the main page as you add entries to your site. Add your notes as comments while you work with Nucleus and bookmark this page to gain access to it in the future.\r<br />\n\r<br />\n<b>Links</b>\r<br />\n\r<br />\nNucleus CMS <a href="http://nucleuscms.org">home</a> page.\r<br />\n\r<br />\nNucleus CMS SourceForge <a href="http://sourceforge.net/projects/nucleuscms/">project</a> page.\r<br />\n\r<br />\nNucleus CMS Plugins <a href="http://wakka.xiffy.nl/Plugin/">repository</a> page.\r<br />\n\r<br />\n<b>Documentation</b>\r<br />\n\r<br />\nThe Nucleus <a href="http://nucleuscms.org/faq.php">frequently asked questions</a> page.\r<br />\n\r<br />\nThe install process places <a href="/nucleus/documentation/">user</a> and <a href="/nucleus/documentation/devdocs/">developer</a> documentation on your web server. \r<br />\n\r<br />\nPop-up <a href="/nucleus/documentation/help.html">help</a> is available throughout the administration area and will assist you in customizing and designing your site.\r<br />\n\r<br />\nOnce you\'ve read through the available documentation, please visit the <a href="http://wakka.xiffy.nl/Nucleus">Wiki</a> for user written how-tos and tips.\r<br />\n\r<br />\n<b>Support</b>\r<br />\n\r<br />\nThanks to the <a href="http://forum.nucleuscms.org/groupcp.php?g=3">beheerders</a> and all the volunteers manning the <a href="http://forum.nucleuscms.org/">support forums</a>.\r<br />\n\r<br />\n- <a href="http://edmondhui.homeip.net/blog/">admun</a> - Ottawa, ON, Canada   	  	\r<br />\n- <a href="http://www.tamizhan.com/">anand</a> - Bangalore, India\r<br />\n- <a href="http://hcgtv.com">hcgtv</a> - Miami, Florida, USA\r<br />\n- <a href="http://www.adrenalinsports.nl/">ikeizer</a> - Maastricht\r<br />\n- <a href="http://www.tipos.com.br/">moraes</a> - Brazil\r<br />\n- <a href="http://roelgroeneveld.com/">roel </a>- The Netherlands\r<br />\n- <a href="http://budts.be/weblog/">TeRanEX </a>- Ekeren, Antwerp, Belgium\r<br />\n- <a href="http://www.trentadams.com/">Trent </a>- Alberta, Canada\r<br />\n- <a href="http://xiffy.nl/weblog/">xiffy </a>- Deventer\r<br />\n\r<br />\nIf you should require assistance, please don\'t hesitate to <a href="http://forum.nucleuscms.org/faq.php">join</a> the 1100+ registered users in our forums. With it\'s built in search capability and 18,000+ posted articles, your answers are just a few clicks away.\r<br />\n\r<br />\n<b>Developer Resources</b>\r<br />\n\r<br />\nSome enthusiastic Nucleus users have started the <a href="http://dev.nucleuscms.org">Nucleus Developer Network</a>, a site/weblog that will bring you the latest news from the development team and pointers to relevant information for developers.\r<br />\n\r<br />\n<b>Featured Sites</b>\r<br />\n\r<br />\nThe featured sites are a sampling of the 582 <a href="http://nucleuscms.org/sites.php">sites running Nucleus</a>.\r<br />\n\r<br />\n- <a href="http://bloggard.com/">bloggard.com</a> - The Adventures of Bloggard\r<br />\n- <a href="http://battleangel.org/">battleangel.org</a> - Giving meaning to the meaningless.\r<br />\n- <a href="http://tipos.com.br/">tipos.com.br</a> - Blogging community: multiple user blogs.\r<br />\n- <a href="http://hsbluebird.com/">hsbluebird.com</a> - Hot Springs, Montana\'s Online Resource for Guests.\r<br />\n- <a href="http://alloutgames.com/">alloutgames.com</a> - Hard core without the hate!\r<br />\n- <a href="http://adrenalinsports.nl/">adrenalinsports.nl</a> - Extreme sports.\r<br />\n- <a href="http://reductioadabsurdum.net/">reductioadabsurdum.net</a> - A Conservative Review of Politics and Culture.\r<br />\n\r<br />\nThe combination of multi-weblogs and skins/templates make for a powerful duo in personalizing your site or designing one for a friend, relative or client.\r<br />\n\r<br />\nThe supplied grey skin and templates are a great starting point and a visual guide to becoming familiar with Nucleus.\r<br />\n\r<br />\n<b>Donator Roll</b>\r<br />\n\r<br />\nI would like to thank these <a href="http://nucleuscms.org/donators.php">nice people</a> for their <a href="http://nucleuscms.org/donate.php">support</a>. <em>Thanks all!</em>\r<br />\n\r<br />\n- <a href="http://cheapweb.us/">CheapWeb.us</a>\r<br />\n- Robert Seyfriedsberger\r<br />\n- <a href="http://www.toxicologie.nl/">Toxicologie.nl</a>\r<br />\n- Gordon Shum\r<br />\n- <a href="http://www.subsim.com/">Neal Stevens</a>\r<br />\n- <a href="http://www.GamblingHelper.com/">GamblingHelper</a>\r<br />\n- Oliver Kirstein\r<br />\n- <a href="http://www.dominiek.be/">Dominiek</a>\r<br />\n- <a href="http://www.aardschok.net/">Aardschok</a>\r<br />\n- <a href="http://www.nieuwevoordeur.be/">nieuwevoordeur.be</a>\r<br />\n- <a href="http://www.scene24.net/">Scene24</a>\r<br />\n- <a href="http://www.eug.be/">Eug\'s Weblog</a>\r<br />\n- <a href="http://www.bloggard.com/">The Adventures of Bloggard</a>\r<br />\n- <a href="http://www.voltos.com/">Arthur Cronos from Voltos</a>\r<br />\n- <a href="http://www.webmaster-toolkit.com/">Free Webmaster Tools and Resources</a>\r<br />\n- <a href="http://www.domilog.be/">Domi\'s Weblog</a>\r<br />\n- Infodoma\r<br />\n- <a href="http://carvingcode.com/">carvingCode.com</a>\r<br />\n- <a href="http://www.traweb.com/">Traweb</a>\r<br />\n- <a href="http://gene.mm2u.com/">Gene\'s MoBlog</a>\r<br />\n- <a href="http://interfacethis.com/">InterfaceThis</a>\r<br />\n- <a href="http://www.thefinsters.com/flog/">The Finster Log</a>\r<br />\n- <a href="http://www.mrhop.com/">Hop Nguyen</a>\r<br />\n- <a href="http://www.zwavel.com/~zwavelaars" title="Zwavelaars">Zwavelaars</a>\r<br />\n- <a href="http://beefcake.nl/">Joaquin Scholten</a>\r<br />\n- <a href="http://www.roelgroeneveld.com/">Roel Groeneveld</a>\r<br />\n- <a href="http://lvb.net/">LVBlog</a>\r<br />\n- <a href="http://xandermol.com/">Xander Mol</a>\r<br />\n- Danilo Massa\r<br />\n- <a href="http://01FTP.com/">01FTP.com</a>\r<br />\n- <a href="http://www.adrenalinsports.nl/">Irmo Keizer</a>\r<br />\n- <a href="http://www.jasonkrogh.com/">Jason Krogh</a>\r<br />\n- <a href="http://www.higuchi.com/">Osamu Higuchi</a>\r<br />\n- <a href="http://www.trentadams.com/">Trent Adams</a>\r<br />\n- <a href="http://www.ppcw.net/">Arne Hess</a>\r<br />\n- <a href="http://hsbluebird.com/">The Bluebird</a>\r<br />\n- Rainer Bickel\r<br />\n- Fritz Elfers\r<br />\n- <a href="http://www.seobook.com/">SEO Book</a>\r<br />\n- <a href="http://www.brandweerdematen.nl/">Brandweer de Maten</a>\r<br />\n- Andy Fuchs\r<br />\n- <a href="http://www.sumoforce.com/">Sumoforce</a>\r<br />\n- <a href="http://love.silverindigo.com/">Al\'ky\'mie</a>\r<br />\n- <a href="http://www.pejo.us/">Peter Johnson</a>\r<br />\n- <a href="http://www.triv.nl/">TriV Internet Solutions</a>\r<br />\n- Margaret Stowe\r<br />\n- <a href="http://www.zenkey.org/">zenkey dot org</a>\r<br />\n- <a href="http://www.golb.org/">Blots of Info</a>\r<br />\n- <a href="http://www.zonderpartij.be/">Rudi De Kerpel</a>\r<br />\n- <a href="http://staylorx.com/">Steve Taylor</a>\r<br />\n- <a href="http://lmhcave.com/">Malcolm Farnsworth</a>\r<br />\n- Birgit Kellner\r<br />\n- <a href="http://www.tobiasly.com/">Toby Johnson</a>\r<br />\n- <a href="http://www.kapingamarangi.be/">Kapingamarangi</a>\r<br />\n- <a href="http://www.pallalink.net/">Pallalink</a>\r<br />\n- <a href="http://publiustx.net/">PubliusTX Weblog</a>\r<br />\n- <a href="http://www.reductioadabsurdum.net/">Reductio Ad Absurdum</a>\r<br />\n- <a href="http://www.gagaweb.org/">GagaWeb</a>\r<br />\n- <a href="http://www.videokid.be/">Videokid</a>\r<br />\n- Jon Marr\r<br />\n- <a href="http://www.docblog.org/">Luigi Cristiano</a>\r<br />\n- J Keith Lehman\r<br />\n- Bohemian Cachet\r<br />\n- Jesus Mourazos\r<br />\n- <a href="http://ltp-design.com/">Stephen Jones</a>\r<br />\n- <a href="http://oha.nu/">One-Handed Apps</a>\r<br />\n- Alwin Hawkins\r<br />\n- <a href="http://jstigall.bloomington.in.us">Justin Stigall</a>\r<br />\n- <a href="http://www.itismylife.com/">It is my life</a>\r<br />\n- Greg Morrill\r<br />\n- <a href="http://www.dutchsubmarines.com/">Dutch Submarines</a>\r<br />\n- <a href="http://www.7thwatch.com/">Seventh Watch Design Studios</a>\r<br />\n- <a href="http://www.macnet2.com/">MacNetv2</a>\r<br />\n- Richard Noordhof\r<br />\n- <a href="http://www.jamier.net/">Jamie Rytlewski</a>\r<br />\n\r<br />\nLike Nucleus? Vote for us at <a href="http://www.hotscripts.com/Detailed/13368.html?RID=nucleus@demuynck.org">HotScripts</a>.\r<br />\n\r<br />\n<b>License</b>\r<br />\n\r<br />\nWhen we speak of free software, we are referring to freedom, not price. Our <a href="http://www.gnu.org/licenses/gpl.html">General Public Licenses</a> are designed to make sure that you have the freedom to distribute copies of free software (and charge for this service if you wish), that you receive source code or can get it if you want it, that you can change the software or use pieces of it in new free programs; and that you know you can do these things.\r<br />\n', 1, 1, '2004-07-27 18:45:00', 0, 0, 0, 1, 0);

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

INSERT INTO `nucleus_member` VALUES (1, 'God', 'Test User', '714d82a0a84f9c6e3495fe2aa5618627', 'example@example.org', 'http://localhost:8080/nucleus/', '', 1, 1, 'd95a775494f1b589011aed122f197c8a', '');

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

INSERT INTO `nucleus_skin` VALUES (2, 'index', '<?xml version="1.0" encoding="utf-8"?>\r\n<feed version="0.3" xmlns="http://purl.org/atom/ns#">\r\n    <title><%blogsetting(name)%></title>\r\n    <link rel="alternate" type="text/html" href="<%blogsetting(url)%>" />\r\n    <generator url="http://nucleuscms.org/"><%version%></generator>\r\n    <modified><%blog(feeds/atom/modified,1)%></modified>\r\n    <%blog(feeds/atom/entries,10)%>\r\n</feed>');
INSERT INTO `nucleus_skin` VALUES (4, 'index', '<?xml version="1.0"?>\r\n<rsd version="1.0">\r\n <service>\r\n  <engineName><%version%></engineName>\r\n  <engineLink>http://nucleuscms.org/</engineLink>\r\n  <homepageLink><%sitevar(url)%></homepageLink>\r\n  <apis>\r\n   <api name="MetaWeblog" preferred="true" apiLink="<%adminurl%>xmlrpc/server.php" blogID="<%blogsetting(id)%>">\r\n    <docs>http://nucleuscms.org/documentation/devdocs/xmlrpc.html</docs>\r\n   </api>\r\n   <api name="Blogger" preferred="false" apiLink="<%adminurl%>xmlrpc/server.php" blogID="<%blogsetting(id)%>">\r\n    <docs>http://nucleuscms.org/documentation/devdocs/xmlrpc.html</docs>\r\n   </api>\r\n  </apis>\r\n </service>\r\n</rsd>');
INSERT INTO `nucleus_skin` VALUES (3, 'index', '<?xml version="1.0" encoding="ISO-8859-1"?>\r\n<rss version="2.0">\r\n  <channel>\r\n    <title><%blogsetting(name)%></title>\r\n    <link><%blogsetting(url)%></link>\r\n    <description><%blogsetting(desc)%></description>\r\n    <!-- optional tags -->\r\n    <language>en-us</language>           <!-- valid langugae goes here -->\r\n    <generator><%version%></generator>\r\n    <copyright>©</copyright>             <!-- Copyright notice -->\r\n    <category>Weblog</category>\r\n    <docs>http://backend.userland.com/rss</docs>\r\n    <image>\r\n      <url><%blogsetting(url)%>/nucleus/nucleus2.gif</url>\r\n      <title><%blogsetting(name)%></title>\r\n      <link><%blogsetting(url)%></link>\r\n    </image>\r\n    <%blog(feeds/rss20,10)%>\r\n  </channel>\r\n</rss>');
INSERT INTO `nucleus_skin` VALUES (1, 'item', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\n\n<html>\n<head>\n  <title><%itemtitle%> - <%blogsetting(name)%></title>\n\n  <!-- some meta information (search engines might read this) -->\n  <meta name="generator" content="<%version%>" />\n  <meta name="description" content="<%blogsetting(desc)%>" />\n\n  <!-- stylesheet definition (points to the place where colors -->\n  <!-- and layout is defined -->\n  <link rel="stylesheet" type="text/css" href="<%skinfile(grey.css)%>" />\n\n  <!-- prevent caching (can be removed) -->\n  <meta http-equiv="Pragma" content="no-cache" />\n  <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />\n  <meta http-equiv="Expires" content="-1" />\n  \n  <!-- extra navigational links -->\n  <link rel="bookmark" title="Nucleus" href="http://nucleuscms.org/" />\n  <link rel="alternate" type="application/rss+xml" title="RSS" href="xml-rss2.php" />\n  <link rel="archives" title="Archives" href="<%archivelink%>" />\n  <link rel="top" title="Today" href="<%sitevar(url)%>" />\n  <link rel="next" href="<%nextlink%>" title="Next Item" />\n  <link rel="prev" href="<%prevlink%>" title="Previous Item" />\n  <link rel="up" href="<%todaylink%>" title="Today" />\n\n</head>\n<body>\n\n<!-- here starts the code that will be displayed in your browser -->\n<div class="contents">\n\n <!-- page title -->\n <h1><%blogsetting(name)%></h1>\n\n <!-- this is a normally hidden link, included for accessibility reasons -->\n <a href="#navigation" class="skip">Jump to navigation</a>\n\n <!-- inserts the selected item using the template named ''grey/full''     -->\n <%item(grey/full)%>\n\n <!-- this tag inserts the comments on the selected item, also using the -->\n <!-- template with name ''grey/full''                                     -->\n <h2>Comments</h2>\n <%comments(grey/full)%>\n\n <h2>Add Comments</h2>\n <%commentform%>\n\n</div><!-- end of the contents div -->\n\n<!-- definition of the logo left-top -->\n<div class="logo">\n <a href="<%sitevar(url)%>"><img src="<%skinfile(atom3.gif)%>" width="155" height="137" alt="" /></a>\n</div>\n\n<!-- definition of the menu -->\n<div class="menu">\n\n <!-- accessibility anchor -->\n <a name="navigation" id="navigation" class="skip"></a>\n <h1 class="skip">Navigation</h1>\n\n <h2>Navigation</h2>\n <ul class="nobullets">\n  <li><a href="<%nextlink%>">Previous Item</a></li>\n  <li><a href="<%prevlink%>">Next Item</a></li>\n  <li><a href="<%todaylink%>">Today</a></li>\n  <li><a href="<%archivelink%>">Archives</a></li>\n  <li><a href="<%adminurl%>">Admin Area</a></li>\n </ul>\n\n <h2>Categories</h2>\n <%categorylist(grey/short)%>\n\n <h2>Search</h2>\n <%searchform%>\n \n <h2>Login</h2>\n <%loginform%>\n\n <h2>Powered by</h2>\n <%nucleusbutton(nucleus.gif,85,31)%>\n\n</div>\n\n</body>\n</html>');
INSERT INTO `nucleus_skin` VALUES (1, 'member', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\n\n<html>\n<head>\n  <title><%sitevar(name)%></title>\n\n  <!-- some meta information (search engines might read this) -->\n  <meta name="generator" content="<%version%>" />\n\n  <!-- stylesheet definition (points to the place where colors -->\n  <!-- and layout is defined -->\n  <link rel="stylesheet" type="text/css" href="<%skinfile(grey.css)%>" />\n\n  <!-- prevent caching (can be removed) -->\n  <meta http-equiv="Pragma" content="no-cache" />\n  <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />\n  <meta http-equiv="Expires" content="-1" />\n  \n  <!-- extra navigational links -->\n  <link rel="bookmark" title="Nucleus" href="http://nucleuscms.org/" />\n  <link rel="top" title="Today" href="<%todaylink%>" />\n  <link rel="up" href="<%todaylink%>" title="Today" />\n\n</head>\n<body>\n\n<!-- here starts the code that will be displayed in your browser -->\n<div class="contents">\n\n <!-- this is a normally hidden link, included for accessibility reasons -->\n <a href="#navigation" class="skip">Jump to navigation</a>\n\n <!-- a title -->\n <h1><%sitevar(name)%></h1>\n\n <h2>Info about <%member(name)%></h2>\n\n <ul>\n  <li>Real name: <%member(realname)%></li>\n  <li>Website: <a href="<%member(url)%>"><%member(url)%></a></li>\n </ul>\n\n <h2>Send Message</h2>\n <%membermailform%>\n\n</div><!-- end of the contents div -->\n\n<!-- definition of the logo left-top -->\n<div class="logo">\n <a href="<%sitevar(url)%>"><img src="<%skinfile(atom3.gif)%>" width="155" height="137" alt="" /></a>\n</div>\n\n<!-- definition of the menu -->\n<div class="menu">\n <!-- accessibility anchor -->\n <a name="navigation" id="navigation" class="skip"></a>\n <h1 class="skip">Navigation</h1>\n\n <h2>Navigation</h2>\n\n <ul class="nobullets">\n  <li><a href="<%todaylink%>">Today</a></li>\n  <li><a href="<%adminurl%>">Admin Area</a></li>\n </ul>\n \n <h2>Login</h2>\n <%loginform%>\n\n <h2>Powered by</h2>\n <%nucleusbutton(nucleus.gif,85,31)%>\n\n</div>\n\n</body>\n</html>');
INSERT INTO `nucleus_skin` VALUES (1, 'search', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\n\n<html>\n<head>\n  <title><%blogsetting(name)%></title>\n\n  <!-- some meta information (search engines might read this) -->\n  <meta name="generator" content="<%version%>" />\n  <meta name="description" content="<%blogsetting(desc)%>" />\n\n  <!-- stylesheet definition (points to the place where colors -->\n  <!-- and layout is defined -->\n  <link rel="stylesheet" type="text/css" href="<%skinfile(grey.css)%>" />\n  \n  <!-- prevent caching (can be removed) -->\n  <meta http-equiv="Pragma" content="no-cache" />\n  <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />\n  <meta http-equiv="Expires" content="-1" />\n  \n  <!-- extra navigational links -->\n  <link rel="bookmark" title="Nucleus" href="http://nucleuscms.org/" />\n  <link rel="alternate" type="application/rss+xml" title="RSS" href="xml-rss2.php" />\n  <link rel="archives" title="Archives" href="<%archivelink%>" />\n  <link rel="top" title="Today" href="<%sitevar(url)%>" />\n  <link rel="up" href="<%todaylink%>" title="Today" />\n\n</head>\n<body>\n\n<!-- here starts the code that will be displayed in your browser -->\n<div class="contents">\n\n <!-- this is a normally hidden link, included for accessibility reasons -->\n <a href="#navigation" class="skip">Jump to navigation</a>\n\n <!-- a title -->\n <h1><%blogsetting(name)%></h1>\n\n <h2>Search</h2>\n <%searchform%>\n\n <h2>Search results</h2>\n <%searchresults(grey/short)%>\n\n</div><!-- end of the contents div -->\n\n<!-- definition of the logo left-top -->\n<div class="logo">\n <a href="<%sitevar(url)%>"><img src="<%skinfile(atom3.gif)%>" width="155" height="137" alt="" /></a>\n</div>\n\n<!-- definition of the menu -->\n<div class="menu">\n <!-- accessibility anchor -->\n <a name="navigation" id="navigation" class="skip"></a>\n <h1 class="skip">Navigation</h1>\n\n <h2>Navigation</h2>\n\n <ul class="nobullets">\n   <li><a href="<%todaylink%>">Today</a></li>\n   <li><a href="<%archivelink%>">Archives</a></li>\n   <li><a href="<%adminurl%>">Admin Area</a></li>\n </ul>\n\n <h2>Search</h2>\n <%searchform%>\n \n <h2>Login</h2>\n <%loginform%>\n\n <h2>Powered by</h2>\n <%nucleusbutton(nucleus.gif,85,31)%>\n\n</div>\n\n</body>\n</html>');
INSERT INTO `nucleus_skin` VALUES (1, 'error', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\n\n<html>\n<head>\n  <title><%sitevar(name)%></title>\n\n  <!-- some meta information (search engines might read this) -->\n  <meta name="generator" content="<%version%>" />\n\n  <!-- stylesheet definition (points to the place where colors -->\n  <!-- and layout is defined -->\n  <link rel="stylesheet" type="text/css" href="<%skinfile(grey.css)%>" />\n\n  <!-- prevent caching (can be removed) -->\n  <meta http-equiv="Pragma" content="no-cache" />\n  <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />\n  <meta http-equiv="Expires" content="-1" />\n  \n  <!-- extra navigational links -->\n  <link rel="bookmark" title="Nucleus" href="http://nucleuscms.org/" />\n  <link rel="top" title="Today" href="<%todaylink%>" />\n  <link rel="up" href="<%todaylink%>" title="Today" />\n</div>\n\n</head>\n<body>\n\n<!-- here starts the code that will be displayed in your browser -->\n<div class="contents">\n\n <!-- this is a normally hidden link, included for accessibility reasons -->\n <a href="#navigation" class="skip">Jump to navigation</a>\n\n <!-- a title -->\n <h1><%sitevar(name)%></h1>\n\n <h2>Error!</h2>\n\n <p><%errormessage%></p>\n\n <p><a href="javascript:history.go(-1);">Go back</a></p>\n\n</div><!-- end of the contents div -->\n\n<!-- definition of the logo left-top -->\n<div class="logo">\n <a href="<%sitevar(url)%>"><img src="<%skinfile(atom3.gif)%>" width="155" height="137" alt="" /></a>\n</div>\n\n<!-- definition of the menu -->\n<div class="menu">\n <!-- accessibility anchor -->\n <a name="navigation" id="navigation" class="skip"></a>\n <h1 class="skip">Navigation</h1>\n\n <h2>Navigation</h2>\n\n <ul class="nobullets">\n  <li><a href="<%todaylink%>">Today</a></li>\n  <li><a href="<%adminurl%>">Admin Area</a></li>\n </ul>\n \n <h2>Login</h2>\n <%loginform%>\n\n <h2>Powered by</h2>\n <%nucleusbutton(nucleus.gif,85,31)%>\n\n</div>\n\n</body>\n</html>');
INSERT INTO `nucleus_skin` VALUES (1, 'imagepopup', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\n\n<html>\n<head>\n  <title><%imagetext%></title>\n  <style type="text/css">\n   img { border: none; }\n   body { margin: 0px; }\n  </style>\n</head>\n<body onblur="window.close()">\n  <a href="javascript:window.close();"><%image%></a>\n</body>\n</html>');
INSERT INTO `nucleus_skin` VALUES (1, 'index', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\n\n<html>\n<head>\n  <title><%blogsetting(name)%></title>\n\n  <!-- some meta information (search engines might read this) -->\n  <meta name="generator" content="<%version%>" />\n  <meta name="description" content="<%blogsetting(desc)%>" />\n\n  <!-- stylesheet definition (points to the place where colors -->\n  <!-- and layout is defined -->\n  <link rel="stylesheet" type="text/css" href="<%skinfile(grey.css)%>" />\n\n  <!-- prevent caching (can be removed) -->\n  <meta http-equiv="Pragma" content="no-cache" />\n  <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />\n  <meta http-equiv="Expires" content="-1" />\n  \n  <!-- extra navigational links -->\n  <link rel="bookmark" title="Nucleus" href="http://nucleuscms.org/" />\n  <link rel="archives" title="Archives" href="<%archivelink%>" />\n  <link rel="top" title="Today" href="<%todaylink%>" />\n\n  <!-- link RSS as alternate version -->\n  <link rel="alternate" type="application/rss+xml" title="RSS" href="xml-rss2.php" />\n\n  <!-- RSD support -->\n  <link rel="EditURI" type="application/rsd+xml" title="RSD" href="rsd.php" />\n\n</head>\n<body>\n\n<!-- here starts the code that will be displayed in your browser -->\n<div class="contents">\n <!-- page title -->\n <h1><%blogsetting(name)%></h1>\n\n <!-- this is a normally hidden link, included for accessibility reasons -->\n <a href="#navigation" class="skip">Jump to navigation</a>\n\n <!-- this tag inserts a weblog using the template named ''grey/short''   -->\n <!-- and showing 15 entries                                                -->\n <%blog(grey/short,15)%>\n\n</div><!-- end of the contents div -->\n\n<!-- definition of the logo (left-top) -->\n<div class="logo">\n <a href="<%sitevar(url)%>"><img src="<%skinfile(atom3.gif)%>" width="155" height="137" alt="" /></a>\n</div>\n\n<!-- definition of the menu -->\n<div class="menu">\n <!-- accessibility anchor -->\n <a name="navigation" id="navigation" class="skip"></a>\n <h1 class="skip">Navigation</h1>\n\n <h2>Navigation</h2>\n <ul class="nobullets">\n  <li><a href="<%todaylink%>">Today</a></li>\n  <li><a href="<%archivelink%>">Archives</a></li>\n  <li><a href="<%adminurl%>">Admin Area</a></li>\n </ul>\n\n <h2>Categories</h2>\n <%categorylist(grey/short)%>\n\n <h2>Search</h2>\n <%searchform%>\n \n <h2>Login</h2>\n <%loginform%>\n\n <h2>My Links</h2>\n\n <ul class="nobullets">\n  <li><a href="http://nucleuscms.org/" title="This site is Nucleus-powered">Nucleus</a></li>\n  <li><a href="http://www.weblogs.com/" title="latest updates">Weblogs</a></li>\n  <li><a href="http://www.daypop.com/" title="Search news &amp; weblog sites">DayPop</a></li>\n  <li><a href="http://www.google.com/" title="Search the web">Google</a></li>\n </ul>\n\n <h2>Powered by</h2>\n <%nucleusbutton(nucleus.gif,85,31)%>\n\n</div>\n\n</body>\n</html>');
INSERT INTO `nucleus_skin` VALUES (1, 'archivelist', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\n\n<html>\n<head>\n  <title><%blogsetting(name)%></title>\n\n  <!-- some meta information (search engines might read this) -->\n  <meta name="generator" content="<%version%>" />\n  <meta name="description" content="<%blogsetting(desc)%>" />\n\n  <!-- stylesheet definition (points to the place where colors -->\n  <!-- and layout is defined -->\n  <link rel="stylesheet" type="text/css" href="<%skinfile(grey.css)%>" />\n\n  <!-- prevent caching (can be removed) -->\n  <meta http-equiv="Pragma" content="no-cache" />\n  <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />\n  <meta http-equiv="Expires" content="-1" />\n  \n  <!-- extra navigational links -->\n  <link rel="bookmark" title="Nucleus" href="http://nucleuscms.org/" />\n  <link rel="alternate" type="application/rss+xml" title="RSS" href="xml-rss2.php" />\n  <link rel="archives" title="Archives" href="<%archivelink%>" />\n  <link rel="top" title="Today" href="<%sitevar(url)%>" />\n  <link rel="up" href="<%todaylink%>" title="Today" />\n\n</head>\n<body>\n\n<!-- here starts the code that will be displayed in your browser -->\n<div class="contents">\n\n<!-- a title -->\n<h1><%blogsetting(name)%></h1>\n\n <!-- this is a normally hidden link, included for accessibility reasons -->\n <a href="#navigation" class="skip">Jump to navigation</a>\n\n <h2>Archives</h2>\n <!-- This tag inserts the archivelist using the grey/short template -->\n <%archivelist(grey/short)%>\n\n</div><!-- end of the contents div -->\n\n<!-- definition of the logo left-top -->\n<div class="logo">\n <a href="<%sitevar(url)%>"><img src="<%skinfile(atom3.gif)%>" width="155" height="137" alt="" /></a> \n</div>\n\n<!-- definition of the menu -->\n<div class="menu">\n <!-- accessibility anchor -->\n <a name="navigation" id="navigation" class="skip"></a>\n <h1 class="skip">Navigation</h1>\n\n <h2>Navigation</h2>\n <ul class="nobullets">\n   <li><a href="<%todaylink%>">Today</a></li>\n   <li><a href="<%archivelink%>">Archives</a></li>\n   <li><a href="<%adminurl%>">Admin Area</a></li>\n </ul>\n\n <h2>Categories</h2>\n <%categorylist(grey/short)%>\n \n <h2>Search</h2>\n <%searchform%>\n \n <h2>Login</h2>\n <%loginform%>\n\n <h2>Powered by</h2>\n <%nucleusbutton(nucleus.gif,85,31)%>\n\n</div>\n\n</body>\n</html>');
INSERT INTO `nucleus_skin` VALUES (1, 'archive', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\n\n<html>\n<head>\n  <title><%blogsetting(name)%></title>\n\n  <!-- some meta information (search engines might read this) -->\n  <meta name="generator" content="<%version%>" />\n  <meta name="description" content="<%blogsetting(desc)%>" />\n\n  <!-- stylesheet definition (points to the place where colors -->\n  <!-- and layout is defined -->\n  <link rel="stylesheet" type="text/css" href="<%skinfile(grey.css)%>" />\n\n  <!-- prevent caching (can be removed) -->\n  <meta http-equiv="Pragma" content="no-cache" />\n  <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />\n  <meta http-equiv="Expires" content="-1" />\n  \n  <!-- extra navigational links -->\n  <link rel="bookmark" title="Nucleus" href="http://nucleuscms.org/" />\n  <link rel="alternate" type="application/rss+xml" title="RSS" href="xml-rss2.php" />\n  <link rel="archives" title="Archives" href="<%archivelink%>" />\n  <link rel="top" title="Today" href="<%sitevar(url)%>" />\n  <link rel="up" href="<%todaylink%>" title="Today" />\n\n</head>\n<body>\n\n<!-- here starts the code that will be displayed in your browser -->\n<div class="contents">\n\n <!-- this is a normally hidden link, included for accessibility reasons -->\n <a href="#navigation" class="skip">Jump to navigation</a>\n\n <!-- a title -->\n <h1><%blogsetting(name)%></h1>\n\n <!-- This tag inserts the archive using the grey/short template -->\n <%archive(grey/short)%>\n\n</div><!-- end of the contents div -->\n\n<!-- definition of the logo left-top -->\n<div class="logo">\n <a href="<%sitevar(url)%>"><img src="<%skinfile(atom3.gif)%>" width="155" height="137" alt="" /></a>\n</div>\n\n<!-- definition of the menu -->\n<div class="menu">\n <!-- accessibility anchor -->\n <a name="navigation" id="navigation" class="skip"></a>\n <h1 class="skip">Navigation</h1>\n\n <h2>Navigation</h2>\n\n <ul class="nobullets">\n   <li><a href="<%prevlink%>">Previous <%archivetype%></a></li>\n   <li><a href="<%nextlink%>">Next <%archivetype%></a></li>\n   <li><a href="<%todaylink%>">Today</a></li>\n   <li><a href="<%archivelink%>">Archives</a></li>\n   <li><a href="<%adminurl%>">Admin Area</a></li>\n </ul>\n\n <h2>Categories</h2>\n <%categorylist(grey/short)%>\n\n <h2>Search</h2>\n <%searchform%>\n \n <h2>Login</h2>\n <%loginform%>\n\n <h2>Powered by</h2>\n <%nucleusbutton(nucleus.gif,85,31)%>\n \n</div>\n\n</body>\n</html>');

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

INSERT INTO `nucleus_skin_desc` VALUES (2, 'feeds/atom', 'Atom 0.3 weblog syndication', 'application/atom+xml', 'normal', '');
INSERT INTO `nucleus_skin_desc` VALUES (3, 'feeds/rss20', 'RSS 2.0 syndication of weblogs', 'text/xml', 'normal', '');
INSERT INTO `nucleus_skin_desc` VALUES (4, 'api/rsd', 'RSD (Really Simple Discovery) information for weblog clients', 'text/xml', 'normal', '');
INSERT INTO `nucleus_skin_desc` VALUES (1, 'grey', 'Default skin to display your blog', 'text/html', 'skindir', 'grey/');

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

INSERT INTO `nucleus_template` VALUES (3, 'ITEM', '<item>\r\n <title><![CDATA[<%title%>]]></title>\r\n <link><%blogurl%>index.php?itemid=<%itemid%></link>\r\n<description><![CDATA[<%body%><%more%>]]></description>\r\n <category><%category%></category>\r\n<comments><%blogurl%>index.php?itemid=<%itemid%></comments>\r\n <pubDate><%date(rfc822)%></pubDate>\r\n</item>');
INSERT INTO `nucleus_template` VALUES (3, 'EDITLINK', '<a href="<%editlink%>" onclick="<%editpopupcode%>">edit</a>');
INSERT INTO `nucleus_template` VALUES (4, 'ITEM', '<%date(utc)%>');
INSERT INTO `nucleus_template` VALUES (5, 'ITEM', '<entry>\r\n <title type="text/html" mode="escaped"><![CDATA[<%title%>]]></title>\r\n <link rel="alternate" type="text/html" href="<%blogurl%>index.php?itemid=<%itemid%>" />\r\n <author>\r\n  <name><%author%></name>\r\n </author>\r\n <modified><%date(utc)%></modified>\r\n <issued><%date(iso8601)%></issued>\r\n <content type="text/html" mode="escaped"><![CDATA[<%body%><%more%>]]></content>\r\n <id><%blogurl%>:<%blogid%>:<%itemid%></id>\r\n</entry>');
INSERT INTO `nucleus_template` VALUES (1, 'ITEM', '\n<h3 class="item"><%title%></h3>\n\n<div class="itembody">\n  <%body%>\n  <%morelink%>\n</div>\n\n<div class="iteminfo">\n  <%time%> -\n  <a href="<%authorlink%>"><%author%></a> -\n  <%edit%>\n  <%comments%>\n</div>\n');
INSERT INTO `nucleus_template` VALUES (1, 'FORMAT_TIME', '%X');
INSERT INTO `nucleus_template` VALUES (1, 'IMAGE_CODE', '<%image%>');
INSERT INTO `nucleus_template` VALUES (1, 'FORMAT_DATE', '%x');
INSERT INTO `nucleus_template` VALUES (1, 'EDITLINK', '<a href="<%editlink%>" onclick="<%editpopupcode%>">edit</a> -');
INSERT INTO `nucleus_template` VALUES (1, 'DATE_HEADER', '<h2>%d %B</h2>');
INSERT INTO `nucleus_template` VALUES (1, 'COMMENTS_TOOMUCH', '<a href="<%itemlink%>" rel="bookmark"><%commentcount%> <%commentword%></a>');
INSERT INTO `nucleus_template` VALUES (1, 'COMMENTS_ONE', 'comment');
INSERT INTO `nucleus_template` VALUES (1, 'COMMENTS_NONE', '<a href="<%itemlink%>" rel="bookmark">No <%commentword%></a>');
INSERT INTO `nucleus_template` VALUES (1, 'CATLIST_LISTITEM', ' <li><a href="<%catlink%>"><%catname%></a></li>');
INSERT INTO `nucleus_template` VALUES (1, 'COMMENTS_MANY', 'comments');
INSERT INTO `nucleus_template` VALUES (1, 'CATLIST_HEADER', '<ul class="nobullets"><li><a href="<%blogurl%>">All</a></li>');
INSERT INTO `nucleus_template` VALUES (1, 'CATLIST_FOOTER', '</ul>');
INSERT INTO `nucleus_template` VALUES (1, 'ARCHIVELIST_LISTITEM', '<li><a href="<%archivelink%>">%B, %Y</a></li>');
INSERT INTO `nucleus_template` VALUES (1, 'ARCHIVELIST_HEADER', '<ul>');
INSERT INTO `nucleus_template` VALUES (1, 'ARCHIVELIST_FOOTER', '</ul>');
INSERT INTO `nucleus_template` VALUES (2, 'ITEM', '\n<h2><%date(%d %B)%></h2>\n<h3 class="item"><%title%></h3>\n\n<div class="itembody">\n  <%body%>\n  <br /><br />\n  <%more%>\n</div>\n\n<div class="iteminfo">\n  posted at <%time%> on <%date%>\n  by <a href="?memberid=<%authorid%>"><%author%></a> -\n  Category: <a href="<%categorylink%>"><%category%></a>\n  <%edit%>\n</div>\n');
INSERT INTO `nucleus_template` VALUES (2, 'COMMENTS_NONE', '<div class="comments">No comments yet</div>');
INSERT INTO `nucleus_template` VALUES (2, 'COMMENTS_ONE', 'comment');
INSERT INTO `nucleus_template` VALUES (2, 'EDITLINK', '- <a href="<%editlink%>" onclick="<%editpopupcode%>">edit</a>');
INSERT INTO `nucleus_template` VALUES (2, 'FORMAT_DATE', '%x');
INSERT INTO `nucleus_template` VALUES (2, 'FORMAT_TIME', '%X');
INSERT INTO `nucleus_template` VALUES (2, 'IMAGE_CODE', '<%image%>');
INSERT INTO `nucleus_template` VALUES (3, 'FORMAT_DATE', '%x');
INSERT INTO `nucleus_template` VALUES (3, 'FORMAT_TIME', '%X');
INSERT INTO `nucleus_template` VALUES (2, 'COMMENTS_MANY', 'comments');
INSERT INTO `nucleus_template` VALUES (2, 'COMMENTS_BODY', '<h3 class="comment"><%userlink%> wrote:</h3>\n\n<div class="commentbody">\n  <%body%>\n</div>\n\n<div class="commentinfo">\n  <%date%> <%time%>\n</div>');
INSERT INTO `nucleus_template` VALUES (1, 'LOCALE', 'en');
INSERT INTO `nucleus_template` VALUES (1, 'MEDIA_CODE', '<%media%>');
INSERT INTO `nucleus_template` VALUES (1, 'MORELINK', '<a href="<%itemlink%>">[Read More!]</a>');
INSERT INTO `nucleus_template` VALUES (1, 'POPUP_CODE', '<%popuplink%>');
INSERT INTO `nucleus_template` VALUES (1, 'SEARCH_HIGHLIGHT', '<span class="highlight">\\0</span>');
INSERT INTO `nucleus_template` VALUES (1, 'SEARCH_NOTHINGFOUND', 'No search results found for <b><%query%></b>');
INSERT INTO `nucleus_template` VALUES (2, 'LOCALE', 'en');
INSERT INTO `nucleus_template` VALUES (2, 'MEDIA_CODE', '<%media%>');
INSERT INTO `nucleus_template` VALUES (2, 'POPUP_CODE', '<%popuplink%>');
INSERT INTO `nucleus_template` VALUES (2, 'SEARCH_HIGHLIGHT', '<span class="highlight">\\0</span>');

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
INSERT INTO `nucleus_template_desc` VALUES (1, 'grey/short', 'The default template that is used to display your Nucleus blog');
INSERT INTO `nucleus_template_desc` VALUES (2, 'grey/full', 'Used for detailed item pages');

CREATE TABLE `nucleus_activation` (
  `vkey` varchar(40) NOT NULL default '',
  `vtime` datetime NOT NULL default '0000-00-00 00:00:00',
  `vmember` int(11) NOT NULL default '0',
  `vtype` varchar(15) NOT NULL default '',
  `vextra` varchar(128) NOT NULL default '',
  PRIMARY KEY  (`vkey`)
) TYPE=MyISAM;
        