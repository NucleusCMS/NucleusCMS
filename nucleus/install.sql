
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
) TYPE=MyISAM AUTO_INCREMENT=2 ;

INSERT INTO `nucleus_blog` VALUES (1, 'My Nucleus', 'myweblog', '', 1, 0, '0.0', '', 'http://hcgtv.homelinux.net/', '', 1, 1, 0, 1, 1, 1, 1, 0);

CREATE TABLE `nucleus_category` (
  `catid` int(11) NOT NULL auto_increment,
  `cblog` int(11) NOT NULL default '0',
  `cname` varchar(40) default NULL,
  `cdesc` varchar(200) default NULL,
  PRIMARY KEY  (`catid`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

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
) TYPE=MyISAM AUTO_INCREMENT=1 ;

CREATE TABLE `nucleus_config` (
  `name` varchar(20) NOT NULL default '',
  `value` varchar(128) default NULL,
  PRIMARY KEY  (`name`)
) TYPE=MyISAM;


INSERT INTO `nucleus_config` VALUES ('DefaultBlog', '1');
INSERT INTO `nucleus_config` VALUES ('AdminEmail', 'hcgtv@myway.com');
INSERT INTO `nucleus_config` VALUES ('IndexURL', 'http://hcgtv.homelinux.net/');
INSERT INTO `nucleus_config` VALUES ('Language', 'english');
INSERT INTO `nucleus_config` VALUES ('SessionCookie', '0');
INSERT INTO `nucleus_config` VALUES ('AllowMemberCreate', '0');
INSERT INTO `nucleus_config` VALUES ('AllowMemberMail', '1');
INSERT INTO `nucleus_config` VALUES ('SiteName', 'My Nucleus');
INSERT INTO `nucleus_config` VALUES ('AdminURL', 'http://hcgtv.homelinux.net/nucleus/');
INSERT INTO `nucleus_config` VALUES ('NewMemberCanLogon', '1');
INSERT INTO `nucleus_config` VALUES ('DisableSite', '0');
INSERT INTO `nucleus_config` VALUES ('DisableSiteURL', 'http://www.this-page-intentionally-left-blank.org/');
INSERT INTO `nucleus_config` VALUES ('LastVisit', '0');
INSERT INTO `nucleus_config` VALUES ('MediaURL', 'http://hcgtv.homelinux.net/media/');
INSERT INTO `nucleus_config` VALUES ('AllowedTypes', 'jpg,jpeg,gif,mpg,mpeg,avi,mov,mp3,swf,png');
INSERT INTO `nucleus_config` VALUES ('AllowLoginEdit', '0');
INSERT INTO `nucleus_config` VALUES ('AllowUpload', '1');
INSERT INTO `nucleus_config` VALUES ('DisableJsTools', '2');
INSERT INTO `nucleus_config` VALUES ('CookiePath', '/');
INSERT INTO `nucleus_config` VALUES ('CookieDomain', '');
INSERT INTO `nucleus_config` VALUES ('CookieSecure', '0');
INSERT INTO `nucleus_config` VALUES ('MediaPrefix', '1');
INSERT INTO `nucleus_config` VALUES ('MaxUploadSize', '1048576');
INSERT INTO `nucleus_config` VALUES ('NonmemberMail', '0');
INSERT INTO `nucleus_config` VALUES ('PluginURL', 'http://hcgtv.homelinux.net/nucleus/plugins/');
INSERT INTO `nucleus_config` VALUES ('ProtectMemNames', '1');
INSERT INTO `nucleus_config` VALUES ('BaseSkin', '1');
INSERT INTO `nucleus_config` VALUES ('SkinsURL', 'http://hcgtv.homelinux.net/skins/');
INSERT INTO `nucleus_config` VALUES ('ActionURL', 'http://hcgtv.homelinux.net/action.php');
INSERT INTO `nucleus_config` VALUES ('URLMode', 'normal');
INSERT INTO `nucleus_config` VALUES ('DatabaseVersion', '250');

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
) TYPE=MyISAM AUTO_INCREMENT=5 ;


INSERT INTO `nucleus_item` VALUES (1, 'Welcome to Nucleus v3.0', 'The building blocks are here to help you create a web presence. Be it a blog, a family page, a hobby site or maybe you just don\'t have any idea.\r<br />\n\r<br />\nWell you came to the right place, cause we didn\'t know what you wanted either.\r<br />\n', '<b>Read Me</b>\r<br />\n\r<br />\nThis is the first entry in your site. We\'ve loaded it up with links and information to get you started. \r<br />\n\r<br />\nThough you can delete this entry, it will eventually scroll off the main page as you add entires to your site. Add your notes as comments while you work with Nucleus and bookmark this page to gain access to it in the future.\r<br />\n\r<br />\n\r<br />\n<b>Links</b>\r<br />\n\r<br />\nNucleus CMS <a href="http://nucleuscms.org">home</a> page.\r<br />\n\r<br />\nNucleus CMS SourceForge <a href="http://sourceforge.net/projects/nucleuscms/">project</a> page.\r<br />\n\r<br />\nNucleus CMS Plugins <a href="http://wakka.xiffy.nl/Plugin/">repository</a> page.\r<br />\n\r<br />\n\r<br />\n<b>Documentation</b>\r<br />\n\r<br />\nThe Nucleus <a href="http://nucleuscms.org/faq.php">frequently asked questions</a> page.\r<br />\n\r<br />\nThe install process places <a href="./nucleus/documentation/">user</a> and <a href="./nucleus/documentation/devdocs/">developer</a> documentation on your web server. \r<br />\n\r<br />\nPop-up <a href="./nucleus/documentation/help.html">help</a> is available throughout the administration area and will assist you in customizing and designing your site.\r<br />\n\r<br />\nOnce you\'ve read through the available documentation, please visit the <a href="http://wakka.xiffy.nl/Nucleus">Wiki</a> for user written how-tos and tips.\r<br />\n\r<br />\n\r<br />\n<b>Support</b>\r<br />\n\r<br />\nThanks to the <a href="http://forum.nucleuscms.org/groupcp.php?g=3">beheerders</a> and all the volunteers manning the <a href="http://forum.nucleuscms.org/">support forums</a>.<ul>\r<br />\n<li><a href="http://edmondhui.homeip.net/blog/">admun</a> - Ottawa, ON, Canada</li>  	   	  	\r<br />\n<li><a href="http://www.tamizhan.com/">anand</a> - Bangalore, India</li>\r<br />\n<li><a href="http://hcgtv.homelinux.com">hcgtv</a> - Miami, Florida, USA</li>\r<br />\n<li><a href="http://www.adrenalinsports.nl/">ikeizer</a> - Maastricht</li>\r<br />\n<li><a href="http://www.tipos.com.br/">moraes</a> - Brazil</li>\r<br />\n<li><a href="http://roelgroeneveld.com/">roel </a>- The Netherlands</li>\r<br />\n<li><a href="http://budts.be/weblog/">TeRanEX </a>- Ekeren, Antwerp, Belgium</li>\r<br />\n<li><a href="http://www.trentadams.com/">Trent </a>- Alberta, Canada</li>\r<br />\n<li><a href="http://xiffy.nl/weblog/">xiffy </a>- Deventer</li>\r<br />\n</ul>If you should require assistance, please don\'t hesitate to <a href="http://forum.nucleuscms.org/faq.php">join</a> the 1053 registered users in our forums. With it\'s built in search capability and 14,918 posted articles, your answers are just a few clicks away.\r<br />\n\r<br />\n\r<br />\n<b>Featured Sites</b>\r<br />\n\r<br />\nThe featured sites are a sampling of the 531 <a href="http://nucleuscms.org/sites.php">sites running Nucleus</a>.<ul>\r<br />\n<li><a href="http://bloggard.com/">bloggard.com</a> - The Adventures of Bloggard</li>\r<br />\n<li><a href="http://battleangel.org/">battleangel.org</a> - Giving meaning to the meaningless.</li>\r<br />\n<li><a href="http://tipos.com.br/">tipos.com.br</a> - Blogging community: multiple user blogs.</li>\r<br />\n<li><a href="http://hsbluebird.com/">hsbluebird.com</a> - Hot Springs, Montana\'s Online Resource for Guests.</li>\r<br />\n<li><a href="http://alloutgames.com/">alloutgames.com</a> - Hard core without the hate!</li>\r<br />\n<li><a href="http://adrenalinsports.nl/">adrenalinsports.nl</a> - Extreme sports.</li>\r<br />\n<li><a href="http://reductioadabsurdum.net/">reductioadabsurdum.net</a> - A Conservative Review of Politics and Culture.</li>\r<br />\n</ul>The combination of multi-weblogs and skins/templates make for a powerful duo in personalizing your site or designing one for a friend, relative or client.\r<br />\n\r<br />\nThe supplied grey skin and templates are a great starting point and a visual guide to becoming familiar with Nucleus.\r<br />\n\r<br />\n\r<br />\n<b>Donator Roll</b>\r<br />\n\r<br />\nI would like to thank these <a href="http://nucleuscms.org/donators.php">nice people</a> for their <a href="http://nucleuscms.org/donate.php">support</a>. <em>Thanks all!</em><ul>\r<br />\n<li>Gordon Shum</li>\r<br />\n<li><a href="http://www.subsim.com/">Neal Stevens</a></li>\r<br />\n<li><a href="http://www.GamblingHelper.com/">GamblingHelper</a></li>\r<br />\n<li>Oliver Kirstein</li>\r<br />\n<li><a href="http://www.dominiek.be/">Dominiek</a></li>\r<br />\n<li><a href="http://www.aardschok.net/">Aardschok</a></li>\r<br />\n<li><a href="http://www.nieuwevoordeur.be/">nieuwevoordeur.be</a></li>\r<br />\n<li><a href="http://www.scene24.net/">Scene24</a></li>\r<br />\n<li><a href="http://www.eug.be/">Eug\'s Weblog</a></li>\r<br />\n<li><a href="http://www.bloggard.com/">The Adventures of Bloggard</a></li>\r<br />\n<li><a href="http://www.voltos.com/">Arthur Cronos from Voltos</a></li>\r<br />\n<li><a href="http://www.webmaster-toolkit.com/">Free Webmaster Tools and Resources</a></li>\r<br />\n<li><a href="http://www.domilog.be/">Domi\'s Weblog</a></li>\r<br />\n<li>Infodoma</li>		\r<br />\n<li><a href="http://carvingcode.com/">carvingCode.com</a></li>\r<br />\n<li><a href="http://www.traweb.com/">Traweb</a></li>\r<br />\n<li><a href="http://gene.mm2u.com/">Gene\'s MoBlog</a></li>\r<br />\n<li><a href="http://interfacethis.com/">InterfaceThis</a></li>\r<br />\n<li><a href="http://www.thefinsters.com/flog/">The Finster Log</a></li>\r<br />\n<li><a href="http://www.mrhop.com/">Hop Nguyen</a></li>\r<br />\n<li><a href="http://www.zwavel.com/~zwavelaars" title="Zwavelaars">Zwavelaars</a></li>\r<br />\n<li><a href="http://beefcake.nl/">Joaquin Scholten</a></li>	\r<br />\n<li><a href="http://www.roelgroeneveld.com/">Roel Groeneveld</a></li>\r<br />\n<li><a href="http://lvb.net/">LVBlog</a></li>\r<br />\n<li><a href="http://xandermol.com/">Xander Mol</a></li>\r<br />\n<li>Danilo Massa</li>\r<br />\n<li><a href="http://01FTP.com/">01FTP.com</a></li>\r<br />\n<li><a href="http://www.adrenalinsports.nl/">Irmo Keizer</a></li>\r<br />\n<li><a href="http://www.jasonkrogh.com/">Jason Krogh</a></li>\r<br />\n<li><a href="http://www.higuchi.com/">Osamu Higuchi</a></li>\r<br />\n<li><a href="http://www.trentadams.com/">Trent Adams</a></li>\r<br />\n<li><a href="http://www.ppcw.net/">Arne Hess</a></li>\r<br />\n<li><a href="http://hsbluebird.com/">The Bluebird</a></li>\r<br />\n<li>Rainer Bickel</li>\r<br />\n<li>Fritz Elfers</li>\r<br />\n<li>Andy Fuchs</li>\r<br />\n<li><a href="http://www.sumoforce.com/">Sumoforce</a></li>\r<br />\n<li><a href="http://love.silverindigo.com/">Al\'ky\'mie</a></li>\r<br />\n<li><a href="http://www.pejo.us/">Peter Johnson</a></li>\r<br />\n<li><a href="http://www.triv.nl/">TriV Internet Solutions</a></li>\r<br />\n<li>Margaret Stowe</li>\r<br />\n<li><a href="http://www.zenkey.org/">zenkey dot org</a></li>\r<br />\n<li><a href="http://www.golb.org/">Blots of Info</a></li>\r<br />\n<li><a href="http://www.zonderpartij.be/">Rudi De Kerpel</a></li>\r<br />\n<li><a href="http://staylorx.com/">Steve Taylor</a></li>\r<br />\n<li><a href="http://lmhcave.com/">Malcolm Farnsworth</a></li>\r<br />\n<li>Birgit Kellner</li>\r<br />\n<li><a href="http://www.tobiasly.com/">Toby Johnson</a></li>\r<br />\n<li><a href="http://www.kapingamarangi.be/">Kapingamarangi</a></li>\r<br />\n<li><a href="http://www.pallalink.net/">Pallalink</a></li>\r<br />\n<li><a href="http://publiustx.net/">PubliusTX Weblog</a></li>\r<br />\n<li><a href="http://www.reductioadabsurdum.net/">Reductio Ad Absurdum</a></li>\r<br />\n<li><a href="http://www.gagaweb.org/">GagaWeb</a></li>\r<br />\n<li><a href="http://www.videokid.be/">Videokid</a></li>\r<br />\n<li>Jon Marr</li>\r<br />\n<li><a href="http://www.docblog.org/">Luigi Cristiano</a></li>\r<br />\n<li>J Keith Lehman</li>\r<br />\n<li><a href="http://www.bohemiancachet.org/">Bohemian Cachet</a></li>\r<br />\n<li>Jesus Mourazos</li>\r<br />\n<li><a href="http://ltp-design.com/">Stephen Jones</a></li>\r<br />\n<li><a href="http://oha.nu/">One-Handed Apps</a></li>\r<br />\n<li>Alwin Hawkins</li>\r<br />\n<li><a href="http://jstigall.bloomington.in.us">Justin Stigall</a></li>\r<br />\n<li><a href="http://www.itismylife.com/">It is my life</a></li>\r<br />\n<li>Greg Morrill</li>\r<br />\n<li><a href="http://www.dutchsubmarines.com/">Dutch Submarines</a></li>\r<br />\n<li><a href="http://www.7thwatch.com/">Seventh Watch Design Studios</a></li>		\r<br />\n<li><a href="http://www.macnet2.com/">MacNetv2</a></li>	\r<br />\n<li>Richard Noordhof</li>\r<br />\n<li><a href="http://www.jamier.net/">Jamie Rytlewski</a></li>\r<br />\n</ul>Like Nucleus, vote for us at <a href="http://www.hotscripts.com/Detailed/13368.html?RID=nucleus@demuynck.org">HotScripts</a>.\r<br />\n\r<br />\n\r<br />\n<b>License</b>\r<br />\n\r<br />\nWhen we speak of free software, we are referring to freedom, not price. Our <a href="http://www.gnu.org/licenses/gpl.html">General Public Licenses</a> are designed to make sure that you have the freedom to distribute copies of free software (and charge for this service if you wish), that you receive source code or can get it if you want it, that you can change the software or use pieces of it in new free programs; and that you know you can do these things.\r<br />\n<p> </p>', 1, 1, '2004-05-24 21:00:00', 0, 0, 0, 1, 0);


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
) TYPE=MyISAM AUTO_INCREMENT=2 ;

INSERT INTO nucleus_member VALUES (1, 'God', 'Administrator', 'eb31870669f13fd8444c2bc918375f09', 'example@example.org', 'http://localhost:8080/nucleus/', '', 1, 1, '56de3cb81b9f3e0ddf994b8e9d88a414', '');

CREATE TABLE `nucleus_plugin` (
  `pid` int(11) NOT NULL auto_increment,
  `pfile` varchar(40) NOT NULL default '',
  `porder` int(11) NOT NULL default '0',
  PRIMARY KEY  (`pid`),
  KEY `pid` (`pid`),
  KEY `porder` (`porder`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

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
) TYPE=MyISAM AUTO_INCREMENT=1 ;

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
) TYPE=MyISAM AUTO_INCREMENT=1 ;

CREATE TABLE `nucleus_skin` (
  `sdesc` int(11) NOT NULL default '0',
  `stype` varchar(20) NOT NULL default '',
  `scontent` text NOT NULL,
  PRIMARY KEY  (`sdesc`,`stype`)
) TYPE=MyISAM;

INSERT INTO `nucleus_skin` VALUES (2, 'index', '<?xml version="1.0" encoding="utf-8"?>\r\n<feed version="0.3" xmlns="http://purl.org/atom/ns#">\r\n    <title><%blogsetting(name)%></title>\r\n    <link rel="alternate" type="text/html" href="<%blogsetting(url)%>" />\r\n    <generator url="http://nucleuscms.org/"><%version%></generator>\r\n    <modified><%blog(feeds/atom/modified,1)%></modified>\r\n    <%blog(feeds/atom/entries,10)%>\r\n</feed>');
INSERT INTO `nucleus_skin` VALUES (4, 'index', '<?xml version="1.0"?>\r\n<rsd version="1.0">\r\n <service>\r\n  <engineName><%version%></engineName>\r\n  <engineLink>http://nucleuscms.org/</engineLink>\r\n  <homepageLink><%sitevar(url)%></homepageLink>\r\n  <apis>\r\n   <api name="MetaWeblog" preferred="true" apiLink="<%adminurl%>xmlrpc/server.php" blogID="<%blogsetting(id)%>">\r\n    <docs>http://nucleuscms.org/documentation/devdocs/xmlrpc.html</docs>\r\n   </api>\r\n   <api name="Blogger" preferred="false" apiLink="<%adminurl%>xmlrpc/server.php" blogID="<%blogsetting(id)%>">\r\n    <docs>http://nucleuscms.org/documentation/devdocs/xmlrpc.html</docs>\r\n   </api>\r\n  </apis>\r\n </service>\r\n</rsd>');
INSERT INTO `nucleus_skin` VALUES (3, 'index', '<?xml version="1.0" encoding="ISO-8859-1"?>\r\n<rss version="2.0">\r\n  <channel>\r\n    <title><%blogsetting(name)%></title>\r\n    <link><%blogsetting(url)%></link>\r\n    <description><%blogsetting(desc)%></description>\r\n    <!-- optional tags -->\r\n    <language>en-us</language>           <!-- valid langugae goes here -->\r\n    <generator><%version%></generator>\r\n    <copyright>©</copyright>             <!-- Copyright notice -->\r\n    <category>Weblog</category>\r\n    <docs>http://backend.userland.com/rss</docs>\r\n    <image>\r\n      <url><%blogsetting(url)%>/nucleus/nucleus2.gif</url>\r\n      <title><%blogsetting(name)%></title>\r\n      <link><%blogsetting(url)%></link>\r\n    </image>\r\n    <%blog(feeds/rss20,10)%>\r\n  </channel>\r\n</rss>');
INSERT INTO `nucleus_skin` VALUES (1, 'imagepopup', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\n<html>\n<head>\n  <title><%imagetext%></title>\n  <style type="text/css">\n   img { border: none; }\n   body { margin: 0px; }\n  </style>\n</head>\n<body onblur="window.close()">\n  <a href="javascript:window.close();"><%image%></a>\n</body>\n</html>');
INSERT INTO `nucleus_skin` VALUES (1, 'index', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\r\n\r\n<html>\r\n<head>\r\n  <title><%blogsetting(name)%></title>\r\n\r\n  <!-- some meta information (search engines might read this) -->\r\n  <meta name="generator" content="<%version%>" />\r\n  <meta name="description" content="<%blogsetting(desc)%>" />\r\n\r\n  <!-- stylesheet definition (points to the place where colors -->\r\n  <!-- and layout is defined -->\r\n  <link rel="stylesheet" type="text/css" href="<%skinfile(grey.css)%>" />\r\n\r\n  <!-- prevent caching (can be removed) -->\r\n  <meta http-equiv="Pragma" content="no-cache" />\r\n  <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />\r\n  <meta http-equiv="Expires" content="-1" />\r\n  \r\n  <!-- extra navigational links -->\r\n  <link rel="bookmark" title="Nucleus" href="http://nucleuscms.org/" />\r\n  <link rel="archives" title="Archives" href="<%archivelink%>" />\r\n  <link rel="top" title="Today" href="<%todaylink%>" />\r\n\r\n  <!-- link RSS as alternate version -->\r\n  <link rel="alternate" type="application/xml+rss" title="RSS" href="xml-rss2.php" />\r\n\r\n  <!-- RSD support -->\r\n  <link rel="EditURI" type="application/rsd+xml" title="RSD" href="rsd.php" />\r\n\r\n</head>\r\n<body>\r\n\r\n<!-- here starts the code that will be displayed in your browser -->\r\n<div class="contents">\r\n <!-- page title -->\r\n <h1><%blogsetting(name)%></h1>\r\n\r\n <!-- this is a normally hidden link, included for accessibility reasons -->\r\n <a href="#navigation" class="skip">Jump to navigation</a>\r\n\r\n <!-- this tag inserts a weblog using the template named \'grey/short\'   -->\r\n <!-- and showing 15 entries                                                -->\r\n <%blog(grey/short,15)%>\r\n\r\n</div><!-- end of the contents div -->\r\n\r\n<!-- definition of the logo (left-top) -->\r\n<div class="logo">\r\n <img src="<%skinfile(atom3.gif)%>" width="155" height="137" alt="" /> \r\n</div>\r\n\r\n<!-- definition of the menu -->\r\n<div class="menu">\r\n <!-- accessibility anchor -->\r\n <a name="navigation" id="navigation" class="skip"></a>\r\n <h1 class="skip">Navigation</h1>\r\n\r\n <h2>Navigation</h2>\r\n <ul class="nobullets">\r\n  <li><a href="<%todaylink%>">Today</a></li>\r\n  <li><a href="<%archivelink%>">Archives</a></li>\r\n  <li><a href="<%adminurl%>">Admin Area</a></li>\r\n </ul>\r\n\r\n <h2>Categories</h2>\r\n <%categorylist(grey/short)%>\r\n\r\n <h2>Search</h2>\r\n <%searchform%>\r\n \r\n <h2>Login</h2>\r\n <%loginform%>\r\n\r\n <h2>My Links</h2>\r\n\r\n <ul class="nobullets">\r\n  <li><a href="http://nucleuscms.org/" title="This site is Nucleus-powered">Nucleus</a></li>\r\n  <li><a href="http://www.weblogs.com/" title="latest updates">Weblogs</a></li>\r\n  <li><a href="http://www.daypop.com/" title="Search news &amp; weblog sites">DayPop</a></li>\r\n  <li><a href="http://www.google.com/" title="Search the web">Google</a></li>\r\n </ul>\r\n\r\n <h2>Powered by</h2>\r\n <%nucleusbutton(nucleus.gif,85,31)%>\r\n\r\n</div>\r\n\r\n</body>\r\n</html>');
INSERT INTO `nucleus_skin` VALUES (1, 'archive', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\r\n\r\n<html>\r\n<head>\r\n  <title><%blogsetting(name)%></title>\r\n\r\n  <!-- some meta information (search engines might read this) -->\r\n  <meta name="generator" content="<%version%>" />\r\n  <meta name="description" content="<%blogsetting(desc)%>" />\r\n\r\n  <!-- stylesheet definition (points to the place where colors -->\r\n  <!-- and layout is defined -->\r\n  <link rel="stylesheet" type="text/css" href="<%skinfile(grey.css)%>" />\r\n\r\n  <!-- prevent caching (can be removed) -->\r\n  <meta http-equiv="Pragma" content="no-cache" />\r\n  <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />\r\n  <meta http-equiv="Expires" content="-1" />\r\n  \r\n  <!-- extra navigational links -->\r\n  <link rel="bookmark" title="Nucleus" href="http://nucleuscms.org/" />\r\n  <link rel="alternate" type="application/xml+rss" title="RSS" href="xml-rss2.php" />\r\n  <link rel="archives" title="Archives" href="<%archivelink%>" />\r\n  <link rel="top" title="Today" href="<%sitevar(url)%>" />\r\n  <link rel="up" href="<%todaylink%>" title="Today" />\r\n\r\n</head>\r\n<body>\r\n\r\n<!-- here starts the code that will be displayed in your browser -->\r\n<div class="contents">\r\n\r\n <!-- this is a normally hidden link, included for accessibility reasons -->\r\n <a href="#navigation" class="skip">Jump to navigation</a>\r\n\r\n <!-- a title -->\r\n <h1><%blogsetting(name)%></h1>\r\n\r\n <!-- This tag inserts the archive using the grey/short template -->\r\n <%archive(grey/short)%>\r\n\r\n</div><!-- end of the contents div -->\r\n\r\n<!-- definition of the logo left-top -->\r\n<div class="logo">\r\n <img src="<%skinfile(atom3.gif)%>" width="155" height="137" alt="" /> \r\n</div>\r\n\r\n<!-- definition of the menu -->\r\n<div class="menu">\r\n <!-- accessibility anchor -->\r\n <a name="navigation" id="navigation" class="skip"></a>\r\n <h1 class="skip">Navigation</h1>\r\n\r\n <h2>Navigation</h2>\r\n\r\n <ul class="nobullets">\r\n   <li><a href="<%prevlink%>">Previous <%archivetype%></a></li>\r\n   <li><a href="<%nextlink%>">Next <%archivetype%></a></li>\r\n   <li><a href="<%todaylink%>">Today</a></li>\r\n   <li><a href="<%archivelink%>">Archives</a></li>\r\n   <li><a href="<%adminurl%>">Admin Area</a></li>\r\n </ul>\r\n\r\n <h2>Categories</h2>\r\n <%categorylist(grey/short)%>\r\n\r\n <h2>Search</h2>\r\n <%searchform%>\r\n \r\n <h2>Login</h2>\r\n <%loginform%>\r\n\r\n <h2>Powered by</h2>\r\n <%nucleusbutton(nucleus.gif,85,31)%>\r\n \r\n</div>\r\n\r\n</body>\r\n</html>');
INSERT INTO `nucleus_skin` VALUES (1, 'archivelist', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\r\n\r\n<html>\r\n<head>\r\n  <title><%blogsetting(name)%></title>\r\n\r\n  <!-- some meta information (search engines might read this) -->\r\n  <meta name="generator" content="<%version%>" />\r\n  <meta name="description" content="<%blogsetting(desc)%>" />\r\n\r\n  <!-- stylesheet definition (points to the place where colors -->\r\n  <!-- and layout is defined -->\r\n  <link rel="stylesheet" type="text/css" href="<%skinfile(grey.css)%>" />\r\n\r\n  <!-- prevent caching (can be removed) -->\r\n  <meta http-equiv="Pragma" content="no-cache" />\r\n  <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />\r\n  <meta http-equiv="Expires" content="-1" />\r\n  \r\n  <!-- extra navigational links -->\r\n  <link rel="bookmark" title="Nucleus" href="http://nucleuscms.org/" />\r\n  <link rel="alternate" type="application/xml+rss" title="RSS" href="xml-rss2.php" />\r\n  <link rel="archives" title="Archives" href="<%archivelink%>" />\r\n  <link rel="top" title="Today" href="<%sitevar(url)%>" />\r\n  <link rel="up" href="<%todaylink%>" title="Today" />\r\n\r\n</head>\r\n<body>\r\n\r\n<!-- here starts the code that will be displayed in your browser -->\r\n<div class="contents">\r\n\r\n<!-- a title -->\r\n<h1><%blogsetting(name)%></h1>\r\n\r\n <!-- this is a normally hidden link, included for accessibility reasons -->\r\n <a href="#navigation" class="skip">Jump to navigation</a>\r\n\r\n <h2>Archives</h2>\r\n <!-- This tag inserts the archivelist using the grey/short template -->\r\n <%archivelist(grey/short)%>\r\n\r\n</div><!-- end of the contents div -->\r\n\r\n<!-- definition of the logo left-top -->\r\n<div class="logo">\r\n <img src="<%skinfile(atom3.gif)%>" width="155" height="137" alt="" /> \r\n</div>\r\n\r\n<!-- definition of the menu -->\r\n<div class="menu">\r\n <!-- accessibility anchor -->\r\n <a name="navigation" id="navigation" class="skip"></a>\r\n <h1 class="skip">Navigation</h1>\r\n\r\n <h2>Navigation</h2>\r\n <ul class="nobullets">\r\n   <li><a href="<%todaylink%>">Today</a></li>\r\n   <li><a href="<%archivelink%>">Archives</a></li>\r\n   <li><a href="<%adminurl%>">Admin Area</a></li>\r\n </ul>\r\n\r\n <h2>Categories</h2>\r\n <%categorylist(grey/short)%>\r\n \r\n <h2>Search</h2>\r\n <%searchform%>\r\n \r\n <h2>Login</h2>\r\n <%loginform%>\r\n\r\n <h2>Powered by</h2>\r\n <%nucleusbutton(nucleus.gif,85,31)%>\r\n\r\n</div>\r\n\r\n</body>\r\n</html>');
INSERT INTO `nucleus_skin` VALUES (1, 'error', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\r\n\r\n<html>\r\n<head>\r\n  <title><%sitevar(name)%></title>\r\n\r\n  <!-- some meta information (search engines might read this) -->\r\n  <meta name="generator" content="<%version%>" />\r\n\r\n  <!-- stylesheet definition (points to the place where colors -->\r\n  <!-- and layout is defined -->\r\n  <link rel="stylesheet" type="text/css" href="<%skinfile(grey.css)%>" />\r\n\r\n  <!-- prevent caching (can be removed) -->\r\n  <meta http-equiv="Pragma" content="no-cache" />\r\n  <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />\r\n  <meta http-equiv="Expires" content="-1" />\r\n  \r\n  <!-- extra navigational links -->\r\n  <link rel="bookmark" title="Nucleus" href="http://nucleuscms.org/" />\r\n  <link rel="top" title="Today" href="<%todaylink%>" />\r\n  <link rel="up" href="<%todaylink%>" title="Today" />\r\n</div>\r\n\r\n</head>\r\n<body>\r\n\r\n<!-- here starts the code that will be displayed in your browser -->\r\n<div class="contents">\r\n\r\n <!-- this is a normally hidden link, included for accessibility reasons -->\r\n <a href="#navigation" class="skip">Jump to navigation</a>\r\n\r\n <!-- a title -->\r\n <h1><%sitevar(name)%></h1>\r\n\r\n <h2>Error!</h2>\r\n\r\n <p><%errormessage%></p>\r\n\r\n <p><a href="javascript:history.go(-1);">Go back</a></p>\r\n\r\n</div><!-- end of the contents div -->\r\n\r\n<!-- definition of the logo left-top -->\r\n<div class="logo">\r\n <img src="<%skinfile(atom3.gif)%>" width="155" height="137" alt="" /> \r\n</div>\r\n\r\n<!-- definition of the menu -->\r\n<div class="menu">\r\n <!-- accessibility anchor -->\r\n <a name="navigation" id="navigation" class="skip"></a>\r\n <h1 class="skip">Navigation</h1>\r\n\r\n <h2>Navigation</h2>\r\n\r\n <ul class="nobullets">\r\n  <li><a href="<%todaylink%>">Today</a></li>\r\n  <li><a href="<%adminurl%>">Admin Area</a></li>\r\n </ul>\r\n \r\n <h2>Login</h2>\r\n <%loginform%>\r\n\r\n <h2>Powered by</h2>\r\n <%nucleusbutton(nucleus.gif,85,31)%>\r\n\r\n</div>\r\n\r\n</body>\r\n</html>');
INSERT INTO `nucleus_skin` VALUES (1, 'item', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\r\n\r\n<html>\r\n<head>\r\n  <title><%itemtitle%> - <%blogsetting(name)%></title>\r\n\r\n  <!-- some meta information (search engines might read this) -->\r\n  <meta name="generator" content="<%version%>" />\r\n  <meta name="description" content="<%blogsetting(desc)%>" />\r\n\r\n  <!-- stylesheet definition (points to the place where colors -->\r\n  <!-- and layout is defined -->\r\n  <link rel="stylesheet" type="text/css" href="<%skinfile(grey.css)%>" />\r\n\r\n  <!-- prevent caching (can be removed) -->\r\n  <meta http-equiv="Pragma" content="no-cache" />\r\n  <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />\r\n  <meta http-equiv="Expires" content="-1" />\r\n  \r\n  <!-- extra navigational links -->\r\n  <link rel="bookmark" title="Nucleus" href="http://nucleuscms.org/" />\r\n  <link rel="alternate" type="application/xml+rss" title="RSS" href="xml-rss2.php" />\r\n  <link rel="archives" title="Archives" href="<%archivelink%>" />\r\n  <link rel="top" title="Today" href="<%sitevar(url)%>" />\r\n  <link rel="next" href="<%nextlink%>" title="Next Item" />\r\n  <link rel="prev" href="<%prevlink%>" title="Previous Item" />\r\n  <link rel="up" href="<%todaylink%>" title="Today" />\r\n\r\n</head>\r\n<body>\r\n\r\n<!-- here starts the code that will be displayed in your browser -->\r\n<div class="contents">\r\n\r\n <!-- page title -->\r\n <h1><%blogsetting(name)%></h1>\r\n\r\n <!-- this is a normally hidden link, included for accessibility reasons -->\r\n <a href="#navigation" class="skip">Jump to navigation</a>\r\n\r\n <!-- inserts the selected item using the template named \'grey/full\'     -->\r\n <%item(grey/full)%>\r\n\r\n <!-- this tag inserts the comments on the selected item, also using the -->\r\n <!-- template with name \'grey/full\'                                     -->\r\n <h2>Comments</h2>\r\n <%comments(grey/full)%>\r\n\r\n <h2>Add Comments</h2>\r\n <%commentform%>\r\n\r\n</div><!-- end of the contents div -->\r\n\r\n<!-- definition of the logo left-top -->\r\n<div class="logo">\r\n <img src="<%skinfile(atom3.gif)%>" width="155" height="137" alt="" /> \r\n</div>\r\n\r\n<!-- definition of the menu -->\r\n<div class="menu">\r\n\r\n <!-- accessibility anchor -->\r\n <a name="navigation" id="navigation" class="skip"></a>\r\n <h1 class="skip">Navigation</h1>\r\n\r\n <h2>Navigation</h2>\r\n <ul class="nobullets">\r\n  <li><a href="<%nextlink%>">Previous Item</a></li>\r\n  <li><a href="<%prevlink%>">Next Item</a></li>\r\n  <li><a href="<%todaylink%>">Today</a></li>\r\n  <li><a href="<%archivelink%>">Archives</a></li>\r\n  <li><a href="<%adminurl%>">Admin Area</a></li>\r\n </ul>\r\n\r\n <h2>Categories</h2>\r\n <%categorylist(grey/short)%>\r\n\r\n <h2>Search</h2>\r\n <%searchform%>\r\n \r\n <h2>Login</h2>\r\n <%loginform%>\r\n\r\n <h2>Powered by</h2>\r\n <%nucleusbutton(nucleus.gif,85,31)%>\r\n\r\n</div>\r\n\r\n</body>\r\n</html>');
INSERT INTO `nucleus_skin` VALUES (1, 'member', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\r\n\r\n<html>\r\n<head>\r\n  <title><%sitevar(name)%></title>\r\n\r\n  <!-- some meta information (search engines might read this) -->\r\n  <meta name="generator" content="<%version%>" />\r\n\r\n  <!-- stylesheet definition (points to the place where colors -->\r\n  <!-- and layout is defined -->\r\n  <link rel="stylesheet" type="text/css" href="<%skinfile(grey.css)%>" />\r\n\r\n  <!-- prevent caching (can be removed) -->\r\n  <meta http-equiv="Pragma" content="no-cache" />\r\n  <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />\r\n  <meta http-equiv="Expires" content="-1" />\r\n  \r\n  <!-- extra navigational links -->\r\n  <link rel="bookmark" title="Nucleus" href="http://nucleuscms.org/" />\r\n  <link rel="top" title="Today" href="<%todaylink%>" />\r\n  <link rel="up" href="<%todaylink%>" title="Today" />\r\n\r\n</head>\r\n<body>\r\n\r\n<!-- here starts the code that will be displayed in your browser -->\r\n<div class="contents">\r\n\r\n <!-- this is a normally hidden link, included for accessibility reasons -->\r\n <a href="#navigation" class="skip">Jump to navigation</a>\r\n\r\n <!-- a title -->\r\n <h1><%sitevar(name)%></h1>\r\n\r\n <h2>Info about <%member(name)%></h2>\r\n\r\n <ul>\r\n  <li>Real name: <%member(realname)%></li>\r\n  <li>Website: <a href="<%member(url)%>"><%member(url)%></a></li>\r\n </ul>\r\n\r\n <h2>Send Message</h2>\r\n <%membermailform%>\r\n\r\n</div><!-- end of the contents div -->\r\n\r\n<!-- definition of the logo left-top -->\r\n<div class="logo">\r\n <img src="<%skinfile(atom3.gif)%>" width="155" height="137" alt="" /> \r\n</div>\r\n\r\n<!-- definition of the menu -->\r\n<div class="menu">\r\n <!-- accessibility anchor -->\r\n <a name="navigation" id="navigation" class="skip"></a>\r\n <h1 class="skip">Navigation</h1>\r\n\r\n <h2>Navigation</h2>\r\n\r\n <ul class="nobullets">\r\n  <li><a href="<%todaylink%>">Today</a></li>\r\n  <li><a href="<%adminurl%>">Admin Area</a></li>\r\n </ul>\r\n \r\n <h2>Login</h2>\r\n <%loginform%>\r\n\r\n <h2>Powered by</h2>\r\n <%nucleusbutton(nucleus.gif,85,31)%>\r\n\r\n</div>\r\n\r\n</body>\r\n</html>');
INSERT INTO `nucleus_skin` VALUES (1, 'search', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\r\n\r\n<html>\r\n<head>\r\n  <title><%blogsetting(name)%></title>\r\n\r\n  <!-- some meta information (search engines might read this) -->\r\n  <meta name="generator" content="<%version%>" />\r\n  <meta name="description" content="<%blogsetting(desc)%>" />\r\n\r\n  <!-- stylesheet definition (points to the place where colors -->\r\n  <!-- and layout is defined -->\r\n  <link rel="stylesheet" type="text/css" href="<%skinfile(grey.css)%>" />\r\n  \r\n  <!-- prevent caching (can be removed) -->\r\n  <meta http-equiv="Pragma" content="no-cache" />\r\n  <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />\r\n  <meta http-equiv="Expires" content="-1" />\r\n  \r\n  <!-- extra navigational links -->\r\n  <link rel="bookmark" title="Nucleus" href="http://nucleuscms.org/" />\r\n  <link rel="alternate" type="application/xml+rss" title="RSS" href="xml-rss2.php" />\r\n  <link rel="archives" title="Archives" href="<%archivelink%>" />\r\n  <link rel="top" title="Today" href="<%sitevar(url)%>" />\r\n  <link rel="up" href="<%todaylink%>" title="Today" />\r\n\r\n</head>\r\n<body>\r\n\r\n<!-- here starts the code that will be displayed in your browser -->\r\n<div class="contents">\r\n\r\n <!-- this is a normally hidden link, included for accessibility reasons -->\r\n <a href="#navigation" class="skip">Jump to navigation</a>\r\n\r\n <!-- a title -->\r\n <h1><%blogsetting(name)%></h1>\r\n\r\n <h2>Search</h2>\r\n <%searchform%>\r\n\r\n <h2>Search results</h2>\r\n <%searchresults(grey/short)%>\r\n\r\n</div><!-- end of the contents div -->\r\n\r\n<!-- definition of the logo left-top -->\r\n<div class="logo">\r\n <img src="<%skinfile(atom3.gif)%>" width="155" height="137" alt="" /> \r\n</div>\r\n\r\n<!-- definition of the menu -->\r\n<div class="menu">\r\n <!-- accessibility anchor -->\r\n <a name="navigation" id="navigation" class="skip"></a>\r\n <h1 class="skip">Navigation</h1>\r\n\r\n <h2>Navigation</h2>\r\n\r\n <ul class="nobullets">\r\n   <li><a href="<%todaylink%>">Today</a></li>\r\n   <li><a href="<%archivelink%>">Archives</a></li>\r\n   <li><a href="<%adminurl%>">Admin Area</a></li>\r\n </ul>\r\n\r\n <h2>Search</h2>\r\n <%searchform%>\r\n \r\n <h2>Login</h2>\r\n <%loginform%>\r\n\r\n <h2>Powered by</h2>\r\n <%nucleusbutton(nucleus.gif,85,31)%>\r\n\r\n</div>\r\n\r\n</body>\r\n</html>');

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
) TYPE=MyISAM AUTO_INCREMENT=5 ;

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
INSERT INTO `nucleus_template` VALUES (1, 'ARCHIVELIST_FOOTER', '</ul>');
INSERT INTO `nucleus_template` VALUES (1, 'ARCHIVELIST_HEADER', '<ul>');
INSERT INTO `nucleus_template` VALUES (1, 'ARCHIVELIST_LISTITEM', '<li><a href="<%archivelink%>">%B, %Y</a></li>');
INSERT INTO `nucleus_template` VALUES (1, 'CATLIST_FOOTER', '</ul>');
INSERT INTO `nucleus_template` VALUES (1, 'CATLIST_HEADER', '<ul class="nobullets">\n <li><a href="<%blogurl%>">All</a></li>');
INSERT INTO `nucleus_template` VALUES (1, 'CATLIST_LISTITEM', ' <li><a href="<%catlink%>"><%catname%></a></li>');
INSERT INTO `nucleus_template` VALUES (1, 'COMMENTS_MANY', 'comments');
INSERT INTO `nucleus_template` VALUES (1, 'COMMENTS_NONE', '<a href="<%itemlink%>" rel="bookmark">No <%commentword%></a>');
INSERT INTO `nucleus_template` VALUES (1, 'COMMENTS_ONE', 'comment');
INSERT INTO `nucleus_template` VALUES (1, 'COMMENTS_TOOMUCH', '<a href="<%itemlink%>" rel="bookmark"><%commentcount%> <%commentword%></a>');
INSERT INTO `nucleus_template` VALUES (1, 'DATE_HEADER', '<h2>%d %B</h2>\n');
INSERT INTO `nucleus_template` VALUES (1, 'EDITLINK', '<a href="<%editlink%>" onclick="<%editpopupcode%>">edit</a> -');
INSERT INTO `nucleus_template` VALUES (1, 'FORMAT_DATE', '%x');
INSERT INTO `nucleus_template` VALUES (1, 'FORMAT_TIME', '%X');
INSERT INTO `nucleus_template` VALUES (1, 'IMAGE_CODE', '<%image%>');
INSERT INTO `nucleus_template` VALUES (1, 'ITEM', '<h3 class="item"><%title%></h3>\n\n<div class="itembody">\n  <%body%>\n  <%morelink%>\n</div>\n\n<div class="iteminfo">\n  <%time%> -\n  <a href="<%authorlink%>"><%author%></a> -\n  <%edit%>\n  <%comments%>\n</div>\n');
INSERT INTO `nucleus_template` VALUES (1, 'LOCALE', 'en');
INSERT INTO `nucleus_template` VALUES (1, 'MEDIA_CODE', '<%media%>');
INSERT INTO `nucleus_template` VALUES (1, 'MORELINK', '<a href="<%itemlink%>">[Read More!]</a>');
INSERT INTO `nucleus_template` VALUES (1, 'POPUP_CODE', '<%popuplink%>');
INSERT INTO `nucleus_template` VALUES (1, 'SEARCH_HIGHLIGHT', '<span class="highlight">\\0</span>');
INSERT INTO `nucleus_template` VALUES (1, 'SEARCH_NOTHINGFOUND', 'No search results found for <b><%query%></b>');
INSERT INTO `nucleus_template` VALUES (2, 'COMMENTS_BODY', '<h3 class="comment"><%userlink%> wrote:</h3>\n\n<div class="commentbody">\n  <%body%>\n</div>\n\n<div class="commentinfo">\n  <%date%> <%time%>\n</div>');
INSERT INTO `nucleus_template` VALUES (2, 'COMMENTS_MANY', 'comments');
INSERT INTO `nucleus_template` VALUES (2, 'COMMENTS_NONE', '<div class="comments">No comments yet</div>');
INSERT INTO `nucleus_template` VALUES (2, 'COMMENTS_ONE', 'comment');
INSERT INTO `nucleus_template` VALUES (2, 'EDITLINK', '- <a href="<%editlink%>" onclick="<%editpopupcode%>">edit</a>');
INSERT INTO `nucleus_template` VALUES (2, 'FORMAT_DATE', '%x');
INSERT INTO `nucleus_template` VALUES (2, 'FORMAT_TIME', '%X');
INSERT INTO `nucleus_template` VALUES (2, 'IMAGE_CODE', '<%image%>');
INSERT INTO `nucleus_template` VALUES (2, 'ITEM', '<h2><%title%></h2>\n\n<div class="itembody">\n  <%body%>\n  <br /><br />\n  <%more%>\n</div>\n\n<div class="iteminfo">\n  posted at <%time%> on <%date%>\n  by <a href="?memberid=<%authorid%>"><%author%></a> -\n  Category: <a href="<%categorylink%>"><%category%></a>\n  <%edit%>\n</div>\n');
INSERT INTO `nucleus_template` VALUES (2, 'LOCALE', 'en');
INSERT INTO `nucleus_template` VALUES (2, 'MEDIA_CODE', '<%media%>');
INSERT INTO `nucleus_template` VALUES (2, 'POPUP_CODE', '<%popuplink%>');
INSERT INTO `nucleus_template` VALUES (2, 'SEARCH_HIGHLIGHT', '<span class="highlight">\\0</span>');
INSERT INTO `nucleus_template` VALUES (3, 'FORMAT_DATE', '%x');
INSERT INTO `nucleus_template` VALUES (3, 'FORMAT_TIME', '%X');

CREATE TABLE `nucleus_template_desc` (
  `tdnumber` int(11) NOT NULL auto_increment,
  `tdname` varchar(20) NOT NULL default '',
  `tddesc` varchar(200) default NULL,
  PRIMARY KEY  (`tdnumber`),
  UNIQUE KEY `tdnumber` (`tdnumber`),
  UNIQUE KEY `tdname` (`tdname`)
) TYPE=MyISAM AUTO_INCREMENT=6 ;

INSERT INTO `nucleus_template_desc` VALUES (4, 'feeds/atom/modified', 'Atom feeds: Inserts last modification date');
INSERT INTO `nucleus_template_desc` VALUES (5, 'feeds/atom/entries', 'Atom feeds: Feed items');
INSERT INTO `nucleus_template_desc` VALUES (3, 'feeds/rss20', 'Used for RSS 2.0 syndication of your blog');
INSERT INTO `nucleus_template_desc` VALUES (1, 'grey/short', 'The default template that is used to display your Nucleus blog');
INSERT INTO `nucleus_template_desc` VALUES (2, 'grey/full', 'Used for detailed item pages');
