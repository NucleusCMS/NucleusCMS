CREATE TABLE nucleus_actionlog (
  timestamp datetime NOT NULL default '0000-00-00 00:00:00',
  message varchar(255) NOT NULL default ''
) TYPE=MyISAM;

CREATE TABLE nucleus_ban (
  iprange varchar(15) NOT NULL default '',
  reason varchar(255) NOT NULL default '',
  blogid int(11) NOT NULL default '0'
) TYPE=MyISAM;

CREATE TABLE nucleus_blog (
  bnumber int(11) NOT NULL auto_increment,
  bname varchar(60) NOT NULL default '',
  bshortname varchar(15) NOT NULL default '',
  bdesc varchar(200) default NULL,
  bcomments tinyint(2) NOT NULL default '1',
  bmaxcomments int(11) NOT NULL default '0',
  btimeoffset decimal(3,1) NOT NULL default '0.0',
  bnotify varchar(60) default NULL,
  burl varchar(100) default NULL,
  bupdate varchar(60) default NULL,
  bdefskin int(11) NOT NULL default '1',
  bpublic tinyint(2) NOT NULL default '1',
  bsendping tinyint(2) NOT NULL default '0',
  bconvertbreaks tinyint(2) NOT NULL default '1',
  bdefcat int(11) default NULL,
  bnotifytype int(11) NOT NULL default '15',
  ballowpast tinyint(2) NOT NULL default '0',
  bincludesearch tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (bnumber),
  UNIQUE KEY bshortname (bshortname),
  UNIQUE KEY bnumber (bnumber)
) TYPE=MyISAM;

INSERT INTO nucleus_blog VALUES (1, 'My Nucleus Weblog', 'myweblog', '', 1, 0, '0.0', '', 'http://localhost/release/', '', 1, 1, 0, 1, 1, 1, 0, 0);

CREATE TABLE nucleus_category (
  catid int(11) NOT NULL auto_increment,
  cblog int(11) NOT NULL default '0',
  cname varchar(40) default NULL,
  cdesc varchar(200) default NULL,
  PRIMARY KEY  (catid)
) TYPE=MyISAM;

INSERT INTO nucleus_category VALUES (1, 1, 'General', 'Items that do not fit in other categories');

CREATE TABLE nucleus_comment (
  cnumber int(11) NOT NULL auto_increment,
  cbody text NOT NULL,
  cuser varchar(40) default NULL,
  cmail varchar(100) default NULL,
  cmember int(11) default NULL,
  citem int(11) NOT NULL default '0',
  ctime datetime NOT NULL default '0000-00-00 00:00:00',
  chost varchar(60) default NULL,
  cip varchar(15) NOT NULL default '',
  cblog int(11) NOT NULL default '0',
  PRIMARY KEY  (cnumber),
  UNIQUE KEY cnumber (cnumber),
  KEY citem (citem),
  FULLTEXT KEY cbody (cbody)  
) TYPE=MyISAM;

CREATE TABLE nucleus_config (
  name varchar(20) NOT NULL default '',
  value varchar(128) default NULL,
  PRIMARY KEY  (name)
) TYPE=MyISAM;

INSERT INTO nucleus_config VALUES ('DefaultBlog', '1');
INSERT INTO nucleus_config VALUES ('AdminEmail', 'you@yourprovider.com');
INSERT INTO nucleus_config VALUES ('IndexURL', 'http://localhost/release/');
INSERT INTO nucleus_config VALUES ('Language', 'english');
INSERT INTO nucleus_config VALUES ('SessionCookie', '0');
INSERT INTO nucleus_config VALUES ('AllowMemberCreate', '0');
INSERT INTO nucleus_config VALUES ('AllowMemberMail', '1');
INSERT INTO nucleus_config VALUES ('SiteName', 'My Nucleus Site');
INSERT INTO nucleus_config VALUES ('AdminURL', 'http://localhost/release/nucleus/');
INSERT INTO nucleus_config VALUES ('NewMemberCanLogon', '1');
INSERT INTO nucleus_config VALUES ('DisableSite', '0');
INSERT INTO nucleus_config VALUES ('DisableSiteURL', 'http://www.this-page-intentionally-left-blank.org/');
INSERT INTO nucleus_config VALUES ('LastVisit', '0');
INSERT INTO nucleus_config VALUES ('MediaURL', 'http://localhost/release/media/');
INSERT INTO nucleus_config VALUES ('AllowedTypes', 'jpg,jpeg,gif,mpg,mpeg,avi,mov,mp3,swf,png');
INSERT INTO nucleus_config VALUES ('AllowLoginEdit', '0');
INSERT INTO nucleus_config VALUES ('AllowUpload', '1');
INSERT INTO nucleus_config VALUES ('DisableJsTools', '2');
INSERT INTO nucleus_config VALUES ('CookiePath', '/');
INSERT INTO nucleus_config VALUES ('CookieDomain', '');
INSERT INTO nucleus_config VALUES ('CookieSecure', '0');
INSERT INTO nucleus_config VALUES ('MediaPrefix', '1');
INSERT INTO nucleus_config VALUES ('MaxUploadSize', '1048576');
INSERT INTO nucleus_config VALUES ('NonmemberMail', '0');
INSERT INTO nucleus_config VALUES ('PluginURL', 'http://localhost/release/nucleus/plugins/');
INSERT INTO nucleus_config VALUES ('ProtectMemNames', '1');
INSERT INTO nucleus_config VALUES ('BaseSkin', '1');
INSERT INTO nucleus_config VALUES ('SkinsURL', 'http://localhost/release/skins/');
INSERT INTO nucleus_config VALUES ('ActionURL', 'http://localhost/release/action.php');
INSERT INTO nucleus_config VALUES ('URLMode', 'normal');
INSERT INTO nucleus_config VALUES ('DatabaseVersion', '250');

CREATE TABLE nucleus_item (
  inumber int(11) NOT NULL auto_increment,
  ititle varchar(160) default NULL,
  ibody text NOT NULL,
  imore text,
  iblog int(11) NOT NULL default '0',
  iauthor int(11) NOT NULL default '0',
  itime datetime NOT NULL default '0000-00-00 00:00:00',
  iclosed tinyint(2) NOT NULL default '0',
  idraft tinyint(2) NOT NULL default '0',
  ikarmapos int(11) NOT NULL default '0',
  icat int(11) default NULL,
  ikarmaneg int(11) NOT NULL default '0',
  PRIMARY KEY  (inumber),
  UNIQUE KEY inumber (inumber),
  KEY itime (itime),
  FULLTEXT KEY ibody (ibody,ititle,imore)
) TYPE=MyISAM;

INSERT INTO nucleus_item VALUES (1, 'First Item!', 'This is the first item in your weblog. Feel free to delete it.', '', 1, 1, '2001-09-04 14:47:39', 0, 0, 0, 1, 0);

CREATE TABLE nucleus_karma (
  itemid int(11) NOT NULL default '0',
  ip char(15) NOT NULL default ''
) TYPE=MyISAM;

CREATE TABLE nucleus_member (
  mnumber int(11) NOT NULL auto_increment,
  mname varchar(16) NOT NULL default '',
  mrealname varchar(60) default NULL,
  mpassword varchar(40) NOT NULL default '',
  memail varchar(60) default NULL,
  murl varchar(100) default NULL,
  mnotes varchar(100) default NULL,
  madmin tinyint(2) NOT NULL default '0',
  mcanlogin tinyint(2) NOT NULL default '1',
  mcookiekey varchar(40) default NULL,
  deflang varchar(20) NOT NULL default '',
  PRIMARY KEY  (mnumber),
  UNIQUE KEY mnumber (mnumber),
  UNIQUE KEY mname (mname)
) TYPE=MyISAM;

INSERT INTO nucleus_member VALUES (1, 'God', 'God In Heaven', 'eb31870669f13fd8444c2bc918375f09', 'nucleus@demuynck.org', 'http://nucleuscms.org/', '', 1, 1, '9236486e417623c336b2a10274e4d58e', '');

CREATE TABLE nucleus_plugin (
  pid int(11) NOT NULL auto_increment,
  pfile varchar(40) NOT NULL default '',
  porder int(11) NOT NULL default '0',
  PRIMARY KEY  (pid),
  KEY pid (pid),
  KEY porder (porder)
) TYPE=MyISAM;

CREATE TABLE nucleus_plugin_event (
  pid int(11) NOT NULL default '0',
  event varchar(40) default NULL,
  KEY pid (pid)
) TYPE=MyISAM;

CREATE TABLE nucleus_plugin_option (
  ovalue TEXT NOT NULL default '',
  oid int(11) NOT NULL auto_increment,
  ocontextid int(11) NOT NULL default '0',
  PRIMARY KEY  (oid,ocontextid)
) TYPE=MyISAM;

CREATE TABLE nucleus_plugin_option_desc (
  oid int(11) NOT NULL auto_increment,
  opid int(11) NOT NULL default '0',
  oname varchar(20) NOT NULL default '',
  ocontext varchar(20) NOT NULL default '',
  odesc varchar(255) default NULL,
  otype varchar(20) default NULL,
  odef text,
  oextra text,
  PRIMARY KEY  (opid,oname,ocontext),
  UNIQUE KEY oid (oid)
) TYPE=MyISAM;

CREATE TABLE nucleus_skin (
  sdesc int(11) NOT NULL default '0',
  stype varchar(20) NOT NULL default '',
  scontent text NOT NULL,
  PRIMARY KEY  (sdesc,stype)
) TYPE=MyISAM;

INSERT INTO nucleus_skin VALUES (3, 'index', '<?xml version="1.0" encoding="ISO-8859-1"?>\r\n\r\n<!DOCTYPE rss PUBLIC "-//Netscape Communications//DTD RSS 0.91//EN" "http://my.netscape.com/publish/formats/rss-0.91.dtd">\r\n\r\n<rss version="0.91">\r\n\r\n  <channel>\r\n    <title><%blogsetting(name)%></title>\r\n    <link><%blogsetting(url)%></link>\r\n    <description><%blogsetting(desc)%></description>\r\n    <docs>http://backend.userland.com/rss091</docs>\r\n    <language>en</language>\r\n    <image>\r\n      <url><%adminurl%>nucleus2.gif</url>\r\n      <title><%blogsetting(name)%></title>\r\n      <link><%blogsetting(url)%></link>\r\n    </image>\r\n\r\n<%blog(xmlrss,10)%>\r\n\r\n</channel>\r\n</rss>');
INSERT INTO nucleus_skin VALUES (1, 'archivelist', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\n\n<html>\n<head>\n  <title><%blogsetting(name)%></title>\n\n  <!-- some meta information (search engines might read this) -->\n  <meta name="generator" content="<%version%>" />\n  <meta name="description" content="<%blogsetting(desc)%>" />\n\n  <!-- stylesheet definition (points to the place where colors -->\n  <!-- and layout is defined -->\n  <link rel="stylesheet" type="text/css" href="<%skinfile(default.css)%>" />\n\n  <!-- prevent caching (can be removed) -->\n  <meta http-equiv="Pragma" content="no-cache" />\n  <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />\n  <meta http-equiv="Expires" content="-1" />\n  \n  <!-- extra navigational links -->\n  <link rel="bookmark" title="Nucleus" href="http://nucleuscms.org/" />\n  <link rel="alternate" type="application/xml+rss" title="RSS" href="xml-rss2.php" />\n  <link rel="archives" title="Archives" href="<%archivelink%>" />\n  <link rel="top" title="Today" href="<%sitevar(url)%>" />\n  <link rel="up" href="<%todaylink%>" title="Today" />\n\n</head>\n<body>\n\n<!-- here starts the code that will be displayed in your browser -->\n<div class="contents">\n\n<!-- a title -->\n<h1><%blogsetting(name)%></h1>\n\n <!-- this is a normally hidden link, included for accessibility reasons -->\n <a href="#navigation" class="skip">Jump to navigation</a>\n\n <h2>Archives</h2>\n <!-- This tag inserts the archivelist using the default template -->\n <%archivelist(default)%>\n\n</div><!-- end of the contents div -->\n\n<!-- definition of the logo left-top -->\n<div class="logo">\n <img src="<%skinfile(atom.gif)%>" width="150" height="150" alt="" /> \n</div>\n\n<!-- definition of the menu -->\n<div class="menu">\n <!-- accessibility anchor -->\n <a name="navigation" id="navigation" class="skip"></a>\n <h1 class="skip">Navigation</h1>\n\n <h2>Navigation</h2>\n <ul class="nobullets">\n   <li><a href="<%todaylink%>">Today</a></li>\n   <li><a href="<%archivelink%>">Archives</a></li>\n   <li><a href="<%adminurl%>">Admin Area</a></li>\n </ul>\n\n <h2>Categories</h2>\n <%categorylist(default)%>\n \n <h2>Search</h2>\n <%searchform%>\n \n <h2>Login</h2>\n <%loginform%>\n\n <h2>powered by</h2>\n <%nucleusbutton(nucleus2.gif,46,43)%>\n\n</div>\n\n</body>\n</html>');
INSERT INTO nucleus_skin VALUES (1, 'error', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\n\n<html>\n<head>\n  <title><%sitevar(name)%></title>\n\n  <!-- some meta information (search engines might read this) -->\n  <meta name="generator" content="<%version%>" />\n\n  <!-- stylesheet definition (points to the place where colors -->\n  <!-- and layout is defined -->\n  <link rel="stylesheet" type="text/css" href="<%skinfile(default.css)%>" />\n\n  <!-- prevent caching (can be removed) -->\n  <meta http-equiv="Pragma" content="no-cache" />\n  <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />\n  <meta http-equiv="Expires" content="-1" />\n  \n  <!-- extra navigational links -->\n  <link rel="bookmark" title="Nucleus" href="http://nucleuscms.org/" />\n  <link rel="top" title="Today" href="<%todaylink%>" />\n  <link rel="up" href="<%todaylink%>" title="Today" />\n\n</head>\n<body>\n\n<!-- here starts the code that will be displayed in your browser -->\n<div class="contents">\n\n <!-- this is a normally hidden link, included for accessibility reasons -->\n <a href="#navigation" class="skip">Jump to navigation</a>\n\n <!-- a title -->\n <h1><%sitevar(name)%></h1>\n\n <h2>Error!</h2>\n\n <p><%errormessage%></p>\n\n <p><a href="javascript:history.go(-1);">Go back</a></p>\n\n</div><!-- end of the contents div -->\n\n<!-- definition of the logo left-top -->\n<div class="logo">\n <img src="<%skinfile(atom.gif)%>" width="150" height="150" alt="" /> \n</div>\n\n<!-- definition of the menu -->\n<div class="menu">\n <!-- accessibility anchor -->\n <a name="navigation" id="navigation" class="skip"></a>\n <h1 class="skip">Navigation</h1>\n\n <h2>Navigation</h2>\n\n <ul class="nobullets">\n  <li><a href="<%todaylink%>">Today</a></li>\n  <li><a href="<%adminurl%>">Admin Area</a></li>\n </ul>\n \n <h2>Login</h2>\n <%loginform%>\n\n <h2>powered by</h2>\n <%nucleusbutton(nucleus2.gif,46,43)%>\n\n</div>\n\n</body>\n</html>');
INSERT INTO nucleus_skin VALUES (1, 'archive', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\n\n<html>\n<head>\n  <title><%blogsetting(name)%></title>\n\n  <!-- some meta information (search engines might read this) -->\n  <meta name="generator" content="<%version%>" />\n  <meta name="description" content="<%blogsetting(desc)%>" />\n\n  <!-- stylesheet definition (points to the place where colors -->\n  <!-- and layout is defined -->\n  <link rel="stylesheet" type="text/css" href="<%skinfile(default.css)%>" />\n\n  <!-- prevent caching (can be removed) -->\n  <meta http-equiv="Pragma" content="no-cache" />\n  <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />\n  <meta http-equiv="Expires" content="-1" />\n  \n  <!-- extra navigational links -->\n  <link rel="bookmark" title="Nucleus" href="http://nucleuscms.org/" />\n  <link rel="alternate" type="application/xml+rss" title="RSS" href="xml-rss2.php" />\n  <link rel="archives" title="Archives" href="<%archivelink%>" />\n  <link rel="top" title="Today" href="<%sitevar(url)%>" />\n  <link rel="up" href="<%todaylink%>" title="Today" />\n\n</head>\n<body>\n\n<!-- here starts the code that will be displayed in your browser -->\n<div class="contents">\n\n <!-- this is a normally hidden link, included for accessibility reasons -->\n <a href="#navigation" class="skip">Jump to navigation</a>\n\n <!-- a title -->\n <h1><%blogsetting(name)%></h1>\n\n <!-- This tag inserts the archive using the default template -->\n <%archive(default)%>\n\n</div><!-- end of the contents div -->\n\n<!-- definition of the logo left-top -->\n<div class="logo">\n <img src="<%skinfile(atom.gif)%>" width="150" height="150" alt="" /> \n</div>\n\n<!-- definition of the menu -->\n<div class="menu">\n <!-- accessibility anchor -->\n <a name="navigation" id="navigation" class="skip"></a>\n <h1 class="skip">Navigation</h1>\n\n <h2>Navigation</h2>\n\n <ul class="nobullets">\n   <li><a href="<%prevlink%>">Previous <%archivetype%></a></li>\n   <li><a href="<%nextlink%>">Next <%archivetype%></a></li>\n   <li><a href="<%todaylink%>">Today</a></li>\n   <li><a href="<%archivelink%>">Archives</a></li>\n   <li><a href="<%adminurl%>">Admin Area</a></li>\n </ul>\n\n <h2>Categories</h2>\n <%categorylist(default)%>\n\n <h2>Search</h2>\n <%searchform%>\n \n <h2>Login</h2>\n <%loginform%>\n \n <h2>powered by</h2>\n <%nucleusbutton(nucleus2.gif,46,43)%>\n\n</div>\n\n</body>\n</html>');
INSERT INTO nucleus_skin VALUES (1, 'index', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\r\n\r\n<html>\r\n<head>\r\n  <title><%blogsetting(name)%></title>\r\n\r\n  <!-- some meta information (search engines might read this) -->\r\n  <meta name="generator" content="<%version%>" />\r\n  <meta name="description" content="<%blogsetting(desc)%>" />\r\n\r\n  <!-- stylesheet definition (points to the place where colors -->\r\n  <!-- and layout is defined -->\r\n  <link rel="stylesheet" type="text/css" href="<%skinfile(default.css)%>" />\r\n\r\n  <!-- prevent caching (can be removed) -->\r\n  <meta http-equiv="Pragma" content="no-cache" />\r\n  <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />\r\n  <meta http-equiv="Expires" content="-1" />\r\n  \r\n  <!-- extra navigational links -->\r\n  <link rel="bookmark" title="Nucleus" href="http://nucleuscms.org/" />\r\n  <link rel="archives" title="Archives" href="<%archivelink%>" />\r\n  <link rel="top" title="Today" href="<%todaylink%>" />\r\n\r\n  <!-- link RSS as alternate version -->\r\n  <link rel="alternate" type="application/xml+rss" title="RSS" href="xml-rss2.php" />\r\n\r\n  <!-- RSD support -->\r\n  <link rel="EditURI" type="application/rsd+xml" title="RSD" href="rsd.php" />\r\n\r\n</head>\r\n<body>\r\n\r\n<!-- here starts the code that will be displayed in your browser -->\r\n<div class="contents">\r\n <!-- page title -->\r\n <h1><%blogsetting(name)%></h1>\r\n\r\n <!-- this is a normally hidden link, included for accessibility reasons -->\r\n <a href="#navigation" class="skip">Jump to navigation</a>\r\n\r\n <!-- this tag inserts a weblog using the template named \'default\' and  -->\r\n <!-- showing 15 entries                                                -->\r\n <%blog(default,15)%>\r\n\r\n</div><!-- end of the contents div -->\r\n\r\n<!-- definition of the logo (left-top) -->\r\n<div class="logo">\r\n <img src="<%skinfile(atom.gif)%>" width="150" height="150" alt="" /> \r\n</div>\r\n\r\n<!-- definition of the menu -->\r\n<div class="menu">\r\n <!-- accessibility anchor -->\r\n <a name="navigation" id="navigation" class="skip"></a>\r\n <h1 class="skip">Navigation</h1>\r\n\r\n <h2>Navigation</h2>\r\n <ul class="nobullets">\r\n  <li><a href="<%todaylink%>">Today</a></li>\r\n  <li><a href="<%archivelink%>">Archives</a></li>\r\n  <li><a href="<%adminurl%>">Admin Area</a></li>\r\n </ul>\r\n\r\n <h2>Categories</h2>\r\n <%categorylist(default)%>\r\n\r\n <h2>Search</h2>\r\n <%searchform%>\r\n \r\n <h2>Login</h2>\r\n <%loginform%>\r\n\r\n <h2>My Links</h2>\r\n\r\n <ul class="nobullets">\r\n  <li><a href="http://nucleuscms.org/" title="This site is Nucleus-powered">Nucleus</a></li>\r\n  <li><a href="http://www.weblogs.com/" title="latest updates">Weblogs.com</a></li>\r\n  <li><a href="http://www.daypop.com/" title="Search news &amp; weblog sites">DayPop</a></li>\r\n  <li><a href="http://www.google.com/" title="Search the web">Google</a></li>\r\n </ul>\r\n\r\n <h2>powered by</h2>\r\n <%nucleusbutton(nucleus2.gif,46,43)%>\r\n\r\n</div>\r\n\r\n</body>\r\n</html>');
INSERT INTO nucleus_skin VALUES (1, 'search', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\n\n<html>\n<head>\n  <title><%blogsetting(name)%></title>\n\n  <!-- some meta information (search engines might read this) -->\n  <meta name="generator" content="<%version%>" />\n  <meta name="description" content="<%blogsetting(desc)%>" />\n\n  <!-- stylesheet definition (points to the place where colors -->\n  <!-- and layout is defined -->\n  <link rel="stylesheet" type="text/css" href="<%skinfile(default.css)%>" />\n  \n  <!-- prevent caching (can be removed) -->\n  <meta http-equiv="Pragma" content="no-cache" />\n  <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />\n  <meta http-equiv="Expires" content="-1" />\n  \n  <!-- extra navigational links -->\n  <link rel="bookmark" title="Nucleus" href="http://nucleuscms.org/" />\n  <link rel="alternate" type="application/xml+rss" title="RSS" href="xml-rss2.php" />\n  <link rel="archives" title="Archives" href="<%archivelink%>" />\n  <link rel="top" title="Today" href="<%sitevar(url)%>" />\n  <link rel="up" href="<%todaylink%>" title="Today" />\n\n</head>\n<body>\n\n<!-- here starts the code that will be displayed in your browser -->\n<div class="contents">\n\n <!-- this is a normally hidden link, included for accessibility reasons -->\n <a href="#navigation" class="skip">Jump to navigation</a>\n\n <!-- a title -->\n <h1><%blogsetting(name)%></h1>\n\n <h2>Search</h2>\n <%searchform%>\n\n <h2>Search results</h2>\n <%searchresults(default)%>\n\n</div><!-- end of the contents div -->\n\n<!-- definition of the logo left-top -->\n<div class="logo">\n <img src="<%skinfile(atom.gif)%>" width="150" height="150" alt="" /> \n</div>\n\n<!-- definition of the menu -->\n<div class="menu">\n <!-- accessibility anchor -->\n <a name="navigation" id="navigation" class="skip"></a>\n <h1 class="skip">Navigation</h1>\n\n <h2>Navigation</h2>\n\n <ul class="nobullets">\n   <li><a href="<%todaylink%>">Today</a></li>\n   <li><a href="<%archivelink%>">Archives</a></li>\n   <li><a href="<%adminurl%>">Admin Area</a></li>\n </ul>\n\n <h2>Search</h2>\n <%searchform%>\n \n <h2>Login</h2>\n <%loginform%>\n\n <h2>powered by</h2>\n <%nucleusbutton(nucleus2.gif,46,43)%>\n\n</div>\n\n</body>\n</html>');
INSERT INTO nucleus_skin VALUES (1, 'member', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\n\n<html>\n<head>\n  <title><%sitevar(name)%></title>\n\n  <!-- some meta information (search engines might read this) -->\n  <meta name="generator" content="<%version%>" />\n\n  <!-- stylesheet definition (points to the place where colors -->\n  <!-- and layout is defined -->\n  <link rel="stylesheet" type="text/css" href="<%skinfile(default.css)%>" />\n\n  <!-- prevent caching (can be removed) -->\n  <meta http-equiv="Pragma" content="no-cache" />\n  <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />\n  <meta http-equiv="Expires" content="-1" />\n  \n  <!-- extra navigational links -->\n  <link rel="bookmark" title="Nucleus" href="http://nucleuscms.org/" />\n  <link rel="top" title="Today" href="<%todaylink%>" />\n  <link rel="up" href="<%todaylink%>" title="Today" />\n\n</head>\n<body>\n\n<!-- here starts the code that will be displayed in your browser -->\n<div class="contents">\n\n <!-- this is a normally hidden link, included for accessibility reasons -->\n <a href="#navigation" class="skip">Jump to navigation</a>\n\n <!-- a title -->\n <h1><%sitevar(name)%></h1>\n\n <h2>Info about <%member(name)%></h2>\n\n <ul>\n  <li>Real name: <%member(realname)%></li>\n  <li>Website: <a href="<%member(url)%>"><%member(url)%></a></li>\n </ul>\n\n <h2>Send Message</h2>\n <%membermailform%>\n\n</div><!-- end of the contents div -->\n\n<!-- definition of the logo left-top -->\n<div class="logo">\n <img src="<%skinfile(atom.gif)%>" width="150" height="150" alt="" /> \n</div>\n\n<!-- definition of the menu -->\n<div class="menu">\n <!-- accessibility anchor -->\n <a name="navigation" id="navigation" class="skip"></a>\n <h1 class="skip">Navigation</h1>\n\n <h2>Navigation</h2>\n\n <ul class="nobullets">\n  <li><a href="<%todaylink%>">Today</a></li>\n  <li><a href="<%adminurl%>">Admin Area</a></li>\n </ul>\n \n <h2>Login</h2>\n <%loginform%>\n\n <h2>powered by</h2>\n <%nucleusbutton(nucleus2.gif,46,43)%>\n\n</div>\n\n</body>\n</html>');
INSERT INTO nucleus_skin VALUES (1, 'item', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\n\n<html>\n<head>\n  <title><%itemtitle%> - <%blogsetting(name)%></title>\n\n  <!-- some meta information (search engines might read this) -->\n  <meta name="generator" content="<%version%>" />\n  <meta name="description" content="<%blogsetting(desc)%>" />\n\n  <!-- stylesheet definition (points to the place where colors -->\n  <!-- and layout is defined -->\n  <link rel="stylesheet" type="text/css" href="<%skinfile(default.css)%>" />\n\n  <!-- prevent caching (can be removed) -->\n  <meta http-equiv="Pragma" content="no-cache" />\n  <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />\n  <meta http-equiv="Expires" content="-1" />\n  \n  <!-- extra navigational links -->\n  <link rel="bookmark" title="Nucleus" href="http://nucleuscms.org/" />\n  <link rel="alternate" type="application/xml+rss" title="RSS" href="xml-rss2.php" />\n  <link rel="archives" title="Archives" href="<%archivelink%>" />\n  <link rel="top" title="Today" href="<%sitevar(url)%>" />\n  <link rel="next" href="<%nextlink%>" title="Next Item" />\n  <link rel="prev" href="<%prevlink%>" title="Previous Item" />\n  <link rel="up" href="<%todaylink%>" title="Today" />\n\n</head>\n<body>\n\n<!-- here starts the code that will be displayed in your browser -->\n<div class="contents">\n\n <!-- page title -->\n <h1><%blogsetting(name)%></h1>\n\n <!-- this is a normally hidden link, included for accessibility reasons -->\n <a href="#navigation" class="skip">Jump to navigation</a>\n\n <!-- inserts the selected item using the template named \'detailed\' -->\n <%item(detailed)%>\n\n <!-- this tag inserts the comments on the selected item, also using the -->\n <!-- template with name \'detailed\'                                      -->\n <h2>Comments</h2>\n <%comments(detailed)%>\n\n <h2>Add Comments</h2>\n <%commentform%>\n\n</div><!-- end of the contents div -->\n\n<!-- definition of the logo left-top -->\n<div class="logo">\n <img src="<%skinfile(atom.gif)%>" width="150" height="150" alt="" /> \n</div>\n\n<!-- definition of the menu -->\n<div class="menu">\n\n <!-- accessibility anchor -->\n <a name="navigation" id="navigation" class="skip"></a>\n <h1 class="skip">Navigation</h1>\n\n <h2>Navigation</h2>\n <ul class="nobullets">\n  <li><a href="<%nextlink%>">Previous Item</a></li>\n  <li><a href="<%prevlink%>">Next Item</a></li>\n  <li><a href="<%todaylink%>">Today</a></li>\n  <li><a href="<%archivelink%>">Archives</a></li>\n  <li><a href="<%adminurl%>">Admin Area</a></li>\n </ul>\n\n <h2>Categories</h2>\n <%categorylist(default)%>\n\n <h2>Search</h2>\n <%searchform%>\n \n <h2>Login</h2>\n <%loginform%>\n\n <h2>powered by</h2>\n <%nucleusbutton(nucleus2.gif,46,43)%>\n\n\n</body>\n</html>');
INSERT INTO nucleus_skin VALUES (1, 'imagepopup', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\n<html>\n<head>\n  <title><%imagetext%></title>\n  <style type="text/css">\n   img { border: none; }\n   body { margin: 0px; }\n  </style>\n</head>\n<body onblur="window.close()">\n  <a href="javascript:window.close();"><%image%></a>\n</body>\n</html>');
INSERT INTO nucleus_skin VALUES (15, 'index', '<?xml version="1.0"?>\r\n<rsd version="1.0">\r\n <service>\r\n  <engineName><%version%></engineName>\r\n  <engineLink>http://nucleuscms.org/</engineLink>\r\n  <homepageLink><%sitevar(url)%></homepageLink>\r\n  <apis>\r\n   <api name="MetaWeblog" preferred="true" apiLink="<%adminurl%>xmlrpc/server.php" blogID="<%blogsetting(id)%>">\r\n    <docs>http://nucleuscms.org/documentation/devdocs/xmlrpc.html</docs>\r\n   </api>\r\n   <api name="Blogger" preferred="false" apiLink="<%adminurl%>xmlrpc/server.php" blogID="<%blogsetting(id)%>">\r\n    <docs>http://nucleuscms.org/documentation/devdocs/xmlrpc.html</docs>\r\n   </api>\r\n  </apis>\r\n </service>\r\n</rsd>');
INSERT INTO nucleus_skin VALUES (13, 'index', '<?xml version="1.0" encoding="ISO-8859-1"?>\n<rss version="2.0">\n  <channel>\n    <title><%blogsetting(name)%></title>\n    <link><%blogsetting(url)%></link>\n    <description><%blogsetting(desc)%></description>\n    <!-- optional tags -->\n    <language>en-us</language>           <!-- valid langugae goes here -->\n    <generator><%version%></generator>\n    <copyright>©</copyright>             <!-- Copyright notice -->\n    <category>Weblog</category>\n    <docs>http://backend.userland.com/rss</docs>\n    <image>\n      <url><%blogsetting(url)%>/nucleus/nucleus2.gif</url>\n      <title><%blogsetting(name)%></title>\n      <link><%blogsetting(url)%></link>\n    </image>\n    <%blog(xmlrss2,10)%>\n  </channel>\n</rss>');

CREATE TABLE nucleus_skin_desc (
  sdnumber int(11) NOT NULL auto_increment,
  sdname varchar(20) NOT NULL default '',
  sddesc varchar(200) default NULL,
  sdtype varchar(40) NOT NULL default 'text/html',
  sdincmode varchar(10) NOT NULL default 'normal',
  sdincpref varchar(50) NOT NULL default '',
  PRIMARY KEY  (sdnumber),
  UNIQUE KEY sdnumber (sdnumber),
  UNIQUE KEY sdname (sdname)
) TYPE=MyISAM;

INSERT INTO nucleus_skin_desc VALUES (1, 'default', 'Default skin to display your blog', 'text/html', 'skindir', 'base/');
INSERT INTO nucleus_skin_desc VALUES (3, 'xmlrss', 'RSS syndication of weblogs', 'text/xml', 'normal', '');
INSERT INTO nucleus_skin_desc VALUES (13, 'xmlrss2', 'RSS 2.0 syndication of weblogs', 'text/xml', 'normal', '');
INSERT INTO nucleus_skin_desc VALUES (15, 'rsd', 'RSD (Really Simple Discovery) information', 'text/xml', 'normal', '');

CREATE TABLE nucleus_team (
  tmember int(11) NOT NULL default '0',
  tblog int(11) NOT NULL default '0',
  tadmin tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (tmember,tblog)
) TYPE=MyISAM;

INSERT INTO nucleus_team VALUES (1, 1, 1);

CREATE TABLE nucleus_template (
  tdesc int(11) NOT NULL default '0',
  tpartname varchar(20) NOT NULL default '',
  tcontent text NOT NULL,
  PRIMARY KEY  (tdesc,tpartname)
) TYPE=MyISAM;

INSERT INTO nucleus_template VALUES (22, 'ITEM', '<item>\r\n <title><%syndicate_title%></title>\r\n <link><%blogurl%>index.php?itemid=<%itemid%></link>\r\n<description><%syndicate_description%></description>\r\n <category><%category%></category>\r\n<comments><%blogurl%>index.php?itemid=<%itemid%></comments>\r\n <pubDate><%date(rfc822)%></pubDate>\r\n</item>');
INSERT INTO nucleus_template VALUES (14, 'POPUP_CODE', '<%popuplink%>');
INSERT INTO nucleus_template VALUES (14, 'MEDIA_CODE', '<%media%>');
INSERT INTO nucleus_template VALUES (14, 'IMAGE_CODE', '<%image%>');
INSERT INTO nucleus_template VALUES (14, 'COMMENTS_NONE', '<div class="comments">No comments yet</div>');
INSERT INTO nucleus_template VALUES (14, 'FORMAT_DATE', '%x');
INSERT INTO nucleus_template VALUES (14, 'FORMAT_TIME', '%X');
INSERT INTO nucleus_template VALUES (14, 'LOCALE', 'en');
INSERT INTO nucleus_template VALUES (14, 'SEARCH_HIGHLIGHT', '<span class="highlight">\\0</span>');
INSERT INTO nucleus_template VALUES (14, 'COMMENTS_BODY', '<h3 class="comment"><%userlink%> wrote:</h3>\r\n\r\n<div class="commentbody">\r\n  <%body%>\r\n</div>\r\n\r\n<div class="commentinfo">\r\n  <%date%> <%time%>\r\n</div>');
INSERT INTO nucleus_template VALUES (14, 'EDITLINK', '- <a href="<%editlink%>" onclick="<%editpopupcode%>">edit</a>');
INSERT INTO nucleus_template VALUES (6, 'ITEM', '<item>\r\n <title><%syndicate_title%></title>\r\n <link><%blogurl%>?itemid=<%itemid%></link>\r\n <description><%syndicate_description%></description>\r\n</item>');
INSERT INTO nucleus_template VALUES (6, 'FORMAT_DATE', '%x');
INSERT INTO nucleus_template VALUES (6, 'FORMAT_TIME', '%X');
INSERT INTO nucleus_template VALUES (22, 'FORMAT_DATE', '%x');
INSERT INTO nucleus_template VALUES (22, 'EDITLINK', '<a href="<%editlink%>" onclick="<%editpopupcode%>">edit</a>');
INSERT INTO nucleus_template VALUES (7, 'LOCALE', 'en');
INSERT INTO nucleus_template VALUES (7, 'MEDIA_CODE', '<%media%>');
INSERT INTO nucleus_template VALUES (7, 'MORELINK', '<a href="<%itemlink%>">[Read More!]</a>');
INSERT INTO nucleus_template VALUES (7, 'POPUP_CODE', '<%popuplink%>');
INSERT INTO nucleus_template VALUES (7, 'SEARCH_HIGHLIGHT', '<span class="highlight">\\0</span>');
INSERT INTO nucleus_template VALUES (7, 'SEARCH_NOTHINGFOUND', 'No search results found for <b><%query%></b>');
INSERT INTO nucleus_template VALUES (7, 'ITEM', '<h3 class="item"><%title%></h3>\n\n<div class="itembody">\n  <%body%>\n  <%morelink%>\n</div>\n\n<div class="iteminfo">\n  <%time%> -\n  <a href="<%authorlink%>"><%author%></a> -\n  <%edit%>\n  <%comments%>\n</div>\n');
INSERT INTO nucleus_template VALUES (7, 'FORMAT_TIME', '%X');
INSERT INTO nucleus_template VALUES (7, 'IMAGE_CODE', '<%image%>');
INSERT INTO nucleus_template VALUES (14, 'COMMENTS_ONE', 'comment');
INSERT INTO nucleus_template VALUES (14, 'COMMENTS_MANY', 'comments');
INSERT INTO nucleus_template VALUES (7, 'FORMAT_DATE', '%x');
INSERT INTO nucleus_template VALUES (7, 'DATE_HEADER', '<h2>%d %B</h2>\n');
INSERT INTO nucleus_template VALUES (7, 'EDITLINK', '<a href="<%editlink%>" onclick="<%editpopupcode%>">edit</a> -');
INSERT INTO nucleus_template VALUES (7, 'ARCHIVELIST_FOOTER', '</ul>');
INSERT INTO nucleus_template VALUES (7, 'ARCHIVELIST_HEADER', '<ul>');
INSERT INTO nucleus_template VALUES (14, 'ITEM', '<h2><%title%></h2>\r\n\r\n<div class="itembody">\r\n  <%body%>\r\n  <br /><br />\r\n  <%more%>\r\n</div>\r\n\r\n<div class="iteminfo">\r\n  posted at <%time%> on <%date%>\r\n  by <a href="?memberid=<%authorid%>"><%author%></a> -\r\n  Category: <a href="<%categorylink%>"><%category%></a>\r\n  <%edit%>\r\n</div>\r\n');
INSERT INTO nucleus_template VALUES (7, 'COMMENTS_TOOMUCH', '<a href="<%itemlink%>" rel="bookmark"><%commentcount%> <%commentword%></a>');
INSERT INTO nucleus_template VALUES (7, 'COMMENTS_ONE', 'comment');
INSERT INTO nucleus_template VALUES (7, 'COMMENTS_MANY', 'comments');
INSERT INTO nucleus_template VALUES (7, 'COMMENTS_NONE', '<a href="<%itemlink%>" rel="bookmark">No <%commentword%></a>');
INSERT INTO nucleus_template VALUES (7, 'CATLIST_LISTITEM', ' <li><a href="<%catlink%>"><%catname%></a></li>');
INSERT INTO nucleus_template VALUES (22, 'FORMAT_TIME', '%X');
INSERT INTO nucleus_template VALUES (7, 'ARCHIVELIST_LISTITEM', '<li><a href="<%archivelink%>">%B, %Y</a></li>');
INSERT INTO nucleus_template VALUES (7, 'CATLIST_FOOTER', '</ul>');
INSERT INTO nucleus_template VALUES (7, 'CATLIST_HEADER', '<ul class="nobullets">\n <li><a href="<%blogurl%>">All</a></li>');

CREATE TABLE nucleus_template_desc (
  tdnumber int(11) NOT NULL auto_increment,
  tdname varchar(20) NOT NULL default '',
  tddesc varchar(200) default NULL,
  PRIMARY KEY  (tdnumber),
  UNIQUE KEY tdname (tdname),
  UNIQUE KEY tdnumber (tdnumber)
) TYPE=MyISAM;

INSERT INTO nucleus_template_desc VALUES (6, 'xmlrss', 'Used for RSS syndication of your blog');
INSERT INTO nucleus_template_desc VALUES (7, 'default', 'The default template that is used to display your Nucleus blog');
INSERT INTO nucleus_template_desc VALUES (14, 'detailed', 'Used for detailed item pages');
INSERT INTO nucleus_template_desc VALUES (22, 'xmlrss2', 'Used for RSS 2.0 syndication of your blog');
