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
INSERT INTO `nucleus_config` VALUES ('Language', 'japanese-euc');
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

INSERT INTO `nucleus_item` VALUES (1, 'Nucleus �С������3.1�ؤ褦����', '�����֥ڡ����κ�������������Ѥ��ڤ������ˤ���ޤ�������Ͽ�����blog�ˤʤ뤫�⤷��ޤ��󤷡��Ѥ��Τ��¤ޤ����²�Υڡ����ˤʤ뤫�⤷��ޤ��󤷡��¤�¿����̣�Υ����Ȥˤʤ뤫�⤷��ޤ��󡣤��뤤�ϸ��ߤΤ��ʤ��ˤ��������Ĥ��ʤ���Τˤʤ뤳�Ȥ��äƤ���Ǥ��礦��<br />\r\n<br />\r\n���Ӥ��פ��Ĥ��ޤ���Ǥ�������������ʤ餳�����������Ǥ����ʤ��ʤ餢�ʤ�Ʊ�ͻ䤿���ˤ�狼��ʤ��ΤǤ����顣', '<b>Read Me</b><br />\r\n<br />\r\n����ϥ����Ȥˤ�����ǽ�Υ���ȥ꡼�Ǥ����������Ȥ��ڤ�䤹���褦�ˡ���󥯤Ⱦ��������Ƥ����ޤ�����<br />\r\n<br />\r\n���ε����������뤳�Ȥ�Ǥ��ޤ������ɤ���ˤ��赭�����ɲä��Ƥ������Ȥˤ�äƤ䤬�ƥᥤ��ڡ�������ϸ����ʤ��ʤ�ޤ���Nucleus�򰷤����������������򥳥��ȤȤ����ɲä������襢�������Ǥ���褦�ˤ��Υڡ�����֥å��ޡ������Ƥ����Τ��Ǥ���<br />\r\n<br />\r\n<b>���</b><br />\r\n<br />\r\nNucleus CMS��<a href="http://nucleuscms.org">�ܲ�</a>��<a href="http://japan.nucleuscms.org">���ܸ����</a>�ڡ�����<br />\r\n<br />\r\nNucleus CMS��SourceForge<a href="http://sourceforge.net/projects/nucleuscms/">�ץ�������</a>�ڡ�����<br />\r\n<br />\r\nNucleus CMS�Υץ饰����<a href="http://wakka.xiffy.nl/Plugin/">�Ҹ�</a>��<a href="http://japan.nucleuscms.org/wakka/CategorizedPlugin">���ܸ�Υꥹ��</a>�ڡ�����<br />\r\n<br />\r\n<b>�ɥ������</b><br />\r\n<br />\r\nNucleus��<a href="http://japan.nucleuscms.org/faq.php">FAQ�ʤ褯������佸��</a>��<a href="http://nucleuscms.org/faq.php">��ʸ</a>�˥ڡ�����<br />\r\n<br />\r\n���󥹥ȡ�����ˡ����<a href="./nucleus/documentation/">�桼��������</a>��<a href="./nucleus/documentation/devdocs/">��ȯ�Ը���</a>ʸ�񤬥ե�����˴ޤޤ�Ƥ��ޤ���<br />\r\n<br />\r\n�ݥåץ��å�<a href="./nucleus/documentation/help.html">�إ��</a>���������ꥢ�Τ�����Ȥ���ˤ��ꡢ�����ȤΥ������ޥ�����ǥ�������������Ƥ���뤳�ȤǤ��礦��<br />\r\n<br />\r\n�����Ѱդ���Ƥ���ɥ�����Ȥ��ܤ��̤����顢<a href="http://wakka.xiffy.nl/Nucleus">Wiki</a>��<a href="http://japan.nucleuscms.org/wakka/Nucleus">������</a>�ˤ�ˬ��Ƥ����������桼�����ν񤤤��ϥ��ġ��侮�����Ǻܤ���Ƥ��ޤ���<br />\r\n<br />\r\n<b>���ݡ���</b><br />\r\n<br />\r\n<a href="http://forum.nucleuscms.org/groupcp.php?g=3">beheerders�ʳ�ȯ�ء���</a>��<a href="http://nucleus.fel-is.info/bb/">���ݡ��ȥե������</a>��<a href="http://forum.nucleuscms.org/">�ܲ�</a>�ˤǳ�ư����ܥ��ƥ����˴��դ��ޤ���<br />\r\n<br />\r\n- <a href="http://edmondhui.homeip.net/blog/">admun</a> - Ottawa, ON, Canada   	  	<br />\r\n- <a href="http://www.tamizhan.com/">anand</a> - Bangalore, India<br />\r\n- <a href="http://hcgtv.homelinux.com">hcgtv</a> - Miami, Florida, USA<br />\r\n- <a href="http://www.adrenalinsports.nl/">ikeizer</a> - Maastricht<br />\r\n- <a href="http://www.tipos.com.br/">moraes</a> - Brazil<br />\r\n- <a href="http://roelgroeneveld.com/">roel </a>- The Netherlands<br />\r\n- <a href="http://budts.be/weblog/">TeRanEX </a>- Ekeren, Antwerp, Belgium<br />\r\n- <a href="http://www.trentadams.com/">Trent </a>- Alberta, Canada<br />\r\n- <a href="http://xiffy.nl/weblog/">xiffy </a>- Deventer<br />\r\n<br />\r\n�⤷�������ɬ�פʤ顢1000��Ķ������Ͽ�桼�����Τ���䤿���Υե������˻��ä��Ƥ���������15000��Ķ������Ƥ��줿�����򸡺��Ǥ���褦�ˤʤäƤ���ޤ��Τǡ����������˿���Υ���å��Ǥ��ɤ��失�뤫�⤷��ޤ���<br />\r\n<br />\r\n<b>���ѥ����Ȥΰ���</b><br />\r\n<br />\r\n531����Ͽ���줿<a href="http://nucleuscms.org/sites.php">Nucleus�Ǳ��Ѥ���Ƥ��륵����</a>��<a href="http://japan.nucleuscms.org/sites.php">������</a>�ˤ��椫���ÿ����륵���Ȥ򥵥�ץ�Ȥ��Ƥ��Ҳ𤷤ޤ���<br />\r\n<br />\r\n- <a href="http://bloggard.com/">bloggard.com</a> - The Adventures of Bloggard<br />\r\n- <a href="http://battleangel.org/">battleangel.org</a> - Giving meaning to the meaningless.<br />\r\n- <a href="http://tipos.com.br/">tipos.com.br</a> - Blogging community: multiple user blogs.<br />\r\n- <a href="http://hsbluebird.com/">hsbluebird.com</a> - Hot Springs, Montana\'s Online Resource for Guests.<br />\r\n- <a href="http://alloutgames.com/">alloutgames.com</a> - Hard core without the hate!<br />\r\n- <a href="http://adrenalinsports.nl/">adrenalinsports.nl</a> - Extreme sports.<br />\r\n- <a href="http://reductioadabsurdum.net/">reductioadabsurdum.net</a> - A Conservative Review of Politics and Culture.<br />\r\n<br />\r\n�ޥ�������֥��ȥ�����/�ƥ�ץ졼�Ȥ��Ȥ߹�碌�϶��Ϥ������̤����߽Ф��ޤ����Ŀ�Ū�ʥ����Ⱥ�����ͧ�ͤ���̤��뤤�ϥ��饤����Ȥ��Ф��륵���ȥǥ����󤤤�����Ф��Ƥ�Ǥ���<br />\r\n<br />\r\n�ǥե���Ȥ��󶡤���Ƥ���grey������ȥƥ�ץ졼�Ȥϡ�Nucleus�˿Ƥ���Ǥ�������μ�Ϥ�Ȼ��Ū�ʥ����ɤȤ�����Ω�Ĥ��ȤǤ��礦��<br />\r\n<br />\r\n<b>���ռ԰���</b><br />\r\n<br />\r\n�ʲ���<a href="http://nucleuscms.org/donators.php">�����餷���͡�</a>�ˤ��<a href="http://nucleuscms.org/donate.php">���</a>�˴��դ������ޤ���<em>���꤬�Ȥ���</em><br />\r\n<br />\r\n- Gordon Shum<br />\r\n- <a href="http://www.subsim.com/">Neal Stevens</a><br />\r\n- <a href="http://www.GamblingHelper.com/">GamblingHelper</a><br />\r\n- Oliver Kirstein<br />\r\n- <a href="http://www.dominiek.be/">Dominiek</a><br />\r\n- <a href="http://www.aardschok.net/">Aardschok</a><br />\r\n- <a href="http://www.nieuwevoordeur.be/">nieuwevoordeur.be</a><br />\r\n- <a href="http://www.scene24.net/">Scene24</a><br />\r\n- <a href="http://www.eug.be/">Eug\'s Weblog</a><br />\r\n- <a href="http://www.bloggard.com/">The Adventures of Bloggard</a><br />\r\n- <a href="http://www.voltos.com/">Arthur Cronos from Voltos</a><br />\r\n- <a href="http://www.webmaster-toolkit.com/">Free Webmaster Tools and Resources</a><br />\r\n- <a href="http://www.domilog.be/">Domi\'s Weblog</a><br />\r\n- Infodoma<br />\r\n- <a href="http://carvingcode.com/">carvingCode.com</a><br />\r\n- <a href="http://www.traweb.com/">Traweb</a><br />\r\n- <a href="http://gene.mm2u.com/">Gene\'s MoBlog</a><br />\r\n- <a href="http://interfacethis.com/">InterfaceThis</a><br />\r\n- <a href="http://www.thefinsters.com/flog/">The Finster Log</a><br />\r\n- <a href="http://www.mrhop.com/">Hop Nguyen</a><br />\r\n- <a href="http://www.zwavel.com/~zwavelaars" title="Zwavelaars">Zwavelaars</a><br />\r\n- <a href="http://beefcake.nl/">Joaquin Scholten</a><br />\r\n- <a href="http://www.roelgroeneveld.com/">Roel Groeneveld</a><br />\r\n- <a href="http://lvb.net/">LVBlog</a><br />\r\n- <a href="http://xandermol.com/">Xander Mol</a><br />\r\n- Danilo Massa<br />\r\n- <a href="http://01FTP.com/">01FTP.com</a><br />\r\n- <a href="http://www.adrenalinsports.nl/">Irmo Keizer</a><br />\r\n- <a href="http://www.jasonkrogh.com/">Jason Krogh</a><br />\r\n- <a href="http://www.higuchi.com/">Osamu Higuchi</a><br />\r\n- <a href="http://www.trentadams.com/">Trent Adams</a><br />\r\n- <a href="http://www.ppcw.net/">Arne Hess</a><br />\r\n- <a href="http://hsbluebird.com/">The Bluebird</a><br />\r\n- Rainer Bickel<br />\r\n- Fritz Elfers<br />\r\n- Andy Fuchs<br />\r\n- <a href="http://www.sumoforce.com/">Sumoforce</a><br />\r\n- <a href="http://love.silverindigo.com/">Al\'ky\'mie</a><br />\r\n- <a href="http://www.pejo.us/">Peter Johnson</a><br />\r\n- <a href="http://www.triv.nl/">TriV Internet Solutions</a><br />\r\n- Margaret Stowe<br />\r\n- <a href="http://www.zenkey.org/">zenkey dot org</a><br />\r\n- <a href="http://www.golb.org/">Blots of Info</a><br />\r\n- <a href="http://www.zonderpartij.be/">Rudi De Kerpel</a><br />\r\n- <a href="http://staylorx.com/">Steve Taylor</a><br />\r\n- <a href="http://lmhcave.com/">Malcolm Farnsworth</a><br />\r\n- Birgit Kellner<br />\r\n- <a href="http://www.tobiasly.com/">Toby Johnson</a><br />\r\n- <a href="http://www.kapingamarangi.be/">Kapingamarangi</a><br />\r\n- <a href="http://www.pallalink.net/">Pallalink</a><br />\r\n- <a href="http://publiustx.net/">PubliusTX Weblog</a><br />\r\n- <a href="http://www.reductioadabsurdum.net/">Reductio Ad Absurdum</a><br />\r\n- <a href="http://www.gagaweb.org/">GagaWeb</a><br />\r\n- <a href="http://www.videokid.be/">Videokid</a><br />\r\n- Jon Marr<br />\r\n- <a href="http://www.docblog.org/">Luigi Cristiano</a><br />\r\n- J Keith Lehman<br />\r\n- <a href="http://www.bohemiancachet.org/">Bohemian Cachet</a><br />\r\n- Jesus Mourazos<br />\r\n- <a href="http://ltp-design.com/">Stephen Jones</a><br />\r\n- <a href="http://oha.nu/">One-Handed Apps</a><br />\r\n- Alwin Hawkins<br />\r\n- <a href="http://jstigall.bloomington.in.us">Justin Stigall</a><br />\r\n- <a href="http://www.itismylife.com/">It is my life</a><br />\r\n- Greg Morrill<br />\r\n- <a href="http://www.dutchsubmarines.com/">Dutch Submarines</a><br />\r\n- <a href="http://www.7thwatch.com/">Seventh Watch Design Studios</a><br />\r\n- <a href="http://www.macnet2.com/">MacNetv2</a><br />\r\n- Richard Noordhof<br />\r\n- <a href="http://www.jamier.net/">Jamie Rytlewski</a><br />\r\n<br />\r\nNucleus����������ޤ���������<a href="http://www.hotscripts.com/Detailed/13368.html?RID=nucleus@demuynck.org">HotScripts</a>�Ǥ���ɼ�򤪴ꤤ���ޤ���<br />\r\n<br />\r\n<b>�饤����</b><br />\r\n<br />\r\n�䤿�����ե꡼�����եȥ������ˤĤ��Ƹ��ˤ�����ϼ�ͳ�Τ��Ȥ˸��ڤ��Ƥ���ΤǤ��äơ����ʤΤ��ȤǤϤ���ޤ��󡣻䤿����<a href="http://www.gnu.org/licenses/gpl.html">���̸�ͭ���ѵ�����</a>��<a href="http://www.key.ne.jp/Report/Counter/files/gpl2-j.text">���ܸ���</a>��<a href="http://www.atmarkit.co.jp/aig/03linux/gpl.html">����</a>�ˤϡ��ե꡼�����եȥ�������ʣ��ʪ��ͳ�����ۤǤ��뤳��(�����ơ�˾��ʤ餳�Υ����ӥ����Ф����в�������Ǥ��뤳��)���������������ɤ�ºݤ˼�����뤫��˾��������������ꤹ�뤳�Ȥ���ǽ�Ǥ��뤳�ȡ����ꤷ�����եȥ��������ѹ������꿷�����ե꡼���ץ����ΰ����Ȥ��ƻ��ѤǤ��뤳�ȡ��ʾ�γ����Ƥ�Ԥʤ����Ȥ��Ǥ���Ȥ������Ȥ�桼�����Ȥ��ΤäƤ��뤳�Ȥ�¸��Ǥ���褦�˥ǥ����󤵤�Ƥ��ޤ���<br />\r\n', 1, 1, '2004-05-29 13:29:21', 0, 0, 0, 1, 0);

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

INSERT INTO `nucleus_skin` VALUES (2, 'index', '<?xml version="1.0" encoding="UTF-8"?>\r\n<feed version="0.3" xmlns="http://purl.org/atom/ns#">\r\n    <title><%blogsetting(name)%></title>\r\n    <link rel="alternate" type="text/html" href="<%blogsetting(url)%>" />\r\n    <generator url="http://nucleuscms.org/"><%version%></generator>\r\n    <modified><%blog(feeds/atom/modified,1)%></modified>\r\n    <%blog(feeds/atom/entries,10)%>\r\n</feed>');
INSERT INTO `nucleus_skin` VALUES (4, 'index', '<?xml version="1.0"?>\r\n<rsd version="1.0">\r\n <service>\r\n  <engineName><%version%></engineName>\r\n  <engineLink>http://nucleuscms.org/</engineLink>\r\n  <homepageLink><%sitevar(url)%></homepageLink>\r\n  <apis>\r\n   <api name="MetaWeblog" preferred="true" apiLink="<%adminurl%>xmlrpc/server.php" blogID="<%blogsetting(id)%>">\r\n    <docs>http://nucleuscms.org/documentation/devdocs/xmlrpc.html</docs>\r\n   </api>\r\n   <api name="Blogger" preferred="false" apiLink="<%adminurl%>xmlrpc/server.php" blogID="<%blogsetting(id)%>">\r\n    <docs>http://nucleuscms.org/documentation/devdocs/xmlrpc.html</docs>\r\n   </api>\r\n  </apis>\r\n </service>\r\n</rsd>');
INSERT INTO `nucleus_skin` VALUES (3, 'index', '<?xml version="1.0" encoding="UTF-8"?>\r\n<rss version="2.0">\r\n  <channel>\r\n    <title><%blogsetting(name)%></title>\r\n    <link><%blogsetting(url)%></link>\r\n    <description><%blogsetting(desc)%></description>\r\n    <!-- optional tags -->\r\n    <language>ja</language>           <!-- valid langugae goes here -->\r\n    <generator><%version%></generator>\r\n    <copyright>&#169;</copyright>             <!-- Copyright notice -->\r\n    <category>Weblog</category>\r\n    <docs>http://backend.userland.com/rss</docs>\r\n    <image>\r\n      <url><%adminurl%>nucleus2.gif</url>\r\n      <title><%blogsetting(name)%></title>\r\n      <link><%blogsetting(url)%></link>\r\n    </image>\r\n    <%blog(feeds/rss20,10)%>\r\n  </channel>\r\n</rss>');
INSERT INTO `nucleus_skin` VALUES (1, 'imagepopup', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\n<html>\n<head>\n  <meta http-equiv="Content-Type" content="text/html; charset=EUC-JP" />\n  <title><%imagetext%></title>\n  <style type="text/css">\n   img { border: none; }\n   body { margin: 0px; }\n  </style>\n</head>\n<body onblur="window.close()">\n  <a href="javascript:window.close();"><%image%></a>\n</body>\n</html>');
INSERT INTO `nucleus_skin` VALUES (1, 'index', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\r\n\r\n<html>\r\n<head>\r\n  <meta http-equiv="Content-Type" content="text/html; charset=EUC-JP" />\r\n  <title><%blogsetting(name)%></title>\r\n\r\n  <!-- some meta information (search engines might read this) -->\r\n  <meta name="generator" content="<%version%>" />\r\n  <meta name="description" content="<%blogsetting(desc)%>" />\r\n\r\n  <!-- stylesheet definition (points to the place where colors -->\r\n  <!-- and layout is defined -->\r\n  <link rel="stylesheet" type="text/css" href="<%skinfile(grey.css)%>" />\r\n\r\n  <!-- prevent caching (can be removed) -->\r\n  <meta http-equiv="Pragma" content="no-cache" />\r\n  <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />\r\n  <meta http-equiv="Expires" content="-1" />\r\n  \r\n  <!-- extra navigational links -->\r\n  <link rel="bookmark" title="Nucleus" href="http://nucleuscms.org/" />\r\n  <link rel="archives" title="Archives" href="<%archivelink%>" />\r\n  <link rel="top" title="Today" href="<%todaylink%>" />\r\n\r\n  <!-- link RSS as alternate version -->\r\n  <link rel="alternate" type="application/rss+xml" title="RSS" href="xml-rss2.php" />\r\n\r\n  <!-- RSD support -->\r\n  <link rel="EditURI" type="application/rsd+xml" title="RSD" href="rsd.php" />\r\n\r\n</head>\r\n<body>\r\n\r\n<!-- here starts the code that will be displayed in your browser -->\r\n<div class="contents">\r\n <!-- page title -->\r\n <h1><%blogsetting(name)%></h1>\r\n\r\n <!-- this is a normally hidden link, included for accessibility reasons -->\r\n <a href="#navigation" class="skip">Jump to navigation</a>\r\n\r\n <!-- this tag inserts a weblog using the template named \'grey/short\'   -->\r\n <!-- and showing 15 entries                                                -->\r\n <%blog(grey/short,15)%>\r\n\r\n</div><!-- end of the contents div -->\r\n\r\n<!-- definition of the logo (left-top) -->\r\n<div class="logo">\r\n <a href="<%sitevar(url)%>"><img src="<%skinfile(atom3.gif)%>" width="155" height="137" alt="" /></a>\r\n</div>\r\n\r\n<!-- definition of the menu -->\r\n<div class="menu">\r\n <!-- accessibility anchor -->\r\n <a name="navigation" id="navigation" class="skip"></a>\r\n <h1 class="skip">Navigation</h1>\r\n\r\n <h2>Navigation</h2>\r\n <ul class="nobullets">\r\n  <li><a href="<%todaylink%>">Today</a></li>\r\n  <li><a href="<%archivelink%>">Archives</a></li>\r\n  <li><a href="<%adminurl%>">Admin Area</a></li>\r\n </ul>\r\n\r\n <h2>Categories</h2>\r\n <%categorylist(grey/short)%>\r\n\r\n <h2>Search</h2>\r\n <%searchform%>\r\n \r\n <h2>Login</h2>\r\n <%loginform%>\r\n\r\n <h2>My Links</h2>\r\n\r\n <ul class="nobullets">\r\n  <li><a href="http://nucleuscms.org/" title="This site is Nucleus-powered">Nucleus</a></li>\r\n  <li><a href="http://www.weblogs.com/" title="latest updates">Weblogs</a></li>\r\n  <li><a href="http://www.daypop.com/" title="Search news &amp; weblog sites">DayPop</a></li>\r\n  <li><a href="http://www.google.com/" title="Search the web">Google</a></li>\r\n </ul>\r\n\r\n <h2>Powered by</h2>\r\n <%nucleusbutton(nucleus.gif,85,31)%>\r\n\r\n</div>\r\n\r\n</body>\r\n</html>');
INSERT INTO `nucleus_skin` VALUES (1, 'archive', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\r\n\r\n<html>\r\n<head>\r\n  <meta http-equiv="Content-Type" content="text/html; charset=EUC-JP" />\r\n  <title><%blogsetting(name)%></title>\r\n\r\n  <!-- some meta information (search engines might read this) -->\r\n  <meta name="generator" content="<%version%>" />\r\n  <meta name="description" content="<%blogsetting(desc)%>" />\r\n\r\n  <!-- stylesheet definition (points to the place where colors -->\r\n  <!-- and layout is defined -->\r\n  <link rel="stylesheet" type="text/css" href="<%skinfile(grey.css)%>" />\r\n\r\n  <!-- prevent caching (can be removed) -->\r\n  <meta http-equiv="Pragma" content="no-cache" />\r\n  <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />\r\n  <meta http-equiv="Expires" content="-1" />\r\n  \r\n  <!-- extra navigational links -->\r\n  <link rel="bookmark" title="Nucleus" href="http://nucleuscms.org/" />\r\n  <link rel="alternate" type="application/rss+xml" title="RSS" href="xml-rss2.php" />\r\n  <link rel="archives" title="Archives" href="<%archivelink%>" />\r\n  <link rel="top" title="Today" href="<%sitevar(url)%>" />\r\n  <link rel="up" href="<%todaylink%>" title="Today" />\r\n\r\n</head>\r\n<body>\r\n\r\n<!-- here starts the code that will be displayed in your browser -->\r\n<div class="contents">\r\n\r\n <!-- this is a normally hidden link, included for accessibility reasons -->\r\n <a href="#navigation" class="skip">Jump to navigation</a>\r\n\r\n <!-- a title -->\r\n <h1><%blogsetting(name)%></h1>\r\n\r\n <!-- This tag inserts the archive using the grey/short template -->\r\n <%archive(grey/short)%>\r\n\r\n</div><!-- end of the contents div -->\r\n\r\n<!-- definition of the logo left-top -->\r\n<div class="logo">\r\n <a href="<%sitevar(url)%>"><img src="<%skinfile(atom3.gif)%>" width="155" height="137" alt="" /></a>\r\n</div>\r\n\r\n<!-- definition of the menu -->\r\n<div class="menu">\r\n <!-- accessibility anchor -->\r\n <a name="navigation" id="navigation" class="skip"></a>\r\n <h1 class="skip">Navigation</h1>\r\n\r\n <h2>Navigation</h2>\r\n\r\n <ul class="nobullets">\r\n   <li><a href="<%prevlink%>">���� <%archivetype%></a></li>\r\n   <li><a href="<%nextlink%>">���� <%archivetype%></a></li>\r\n   <li><a href="<%todaylink%>">Today</a></li>\r\n   <li><a href="<%archivelink%>">Archives</a></li>\r\n   <li><a href="<%adminurl%>">Admin Area</a></li>\r\n </ul>\r\n\r\n <h2>Categories</h2>\r\n <%categorylist(grey/short)%>\r\n\r\n <h2>Search</h2>\r\n <%searchform%>\r\n \r\n <h2>Login</h2>\r\n <%loginform%>\r\n\r\n <h2>Powered by</h2>\r\n <%nucleusbutton(nucleus.gif,85,31)%>\r\n \r\n</div>\r\n\r\n</body>\r\n</html>');
INSERT INTO `nucleus_skin` VALUES (1, 'archivelist', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\r\n\r\n<html>\r\n<head>\r\n  <meta http-equiv="Content-Type" content="text/html; charset=EUC-JP" />\r\n  <title><%blogsetting(name)%></title>\r\n\r\n  <!-- some meta information (search engines might read this) -->\r\n  <meta name="generator" content="<%version%>" />\r\n  <meta name="description" content="<%blogsetting(desc)%>" />\r\n\r\n  <!-- stylesheet definition (points to the place where colors -->\r\n  <!-- and layout is defined -->\r\n  <link rel="stylesheet" type="text/css" href="<%skinfile(grey.css)%>" />\r\n\r\n  <!-- prevent caching (can be removed) -->\r\n  <meta http-equiv="Pragma" content="no-cache" />\r\n  <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />\r\n  <meta http-equiv="Expires" content="-1" />\r\n  \r\n  <!-- extra navigational links -->\r\n  <link rel="bookmark" title="Nucleus" href="http://nucleuscms.org/" />\r\n  <link rel="alternate" type="application/rss+xml" title="RSS" href="xml-rss2.php" />\r\n  <link rel="archives" title="Archives" href="<%archivelink%>" />\r\n  <link rel="top" title="Today" href="<%sitevar(url)%>" />\r\n  <link rel="up" href="<%todaylink%>" title="Today" />\r\n\r\n</head>\r\n<body>\r\n\r\n<!-- here starts the code that will be displayed in your browser -->\r\n<div class="contents">\r\n\r\n<!-- a title -->\r\n<h1><%blogsetting(name)%></h1>\r\n\r\n <!-- this is a normally hidden link, included for accessibility reasons -->\r\n <a href="#navigation" class="skip">Jump to navigation</a>\r\n\r\n <h2>Archives</h2>\r\n <!-- This tag inserts the archivelist using the grey/short template -->\r\n <%archivelist(grey/short)%>\r\n\r\n</div><!-- end of the contents div -->\r\n\r\n<!-- definition of the logo left-top -->\r\n<div class="logo">\r\n <a href="<%sitevar(url)%>"><img src="<%skinfile(atom3.gif)%>" width="155" height="137" alt="" /></a>\r\n</div>\r\n\r\n<!-- definition of the menu -->\r\n<div class="menu">\r\n <!-- accessibility anchor -->\r\n <a name="navigation" id="navigation" class="skip"></a>\r\n <h1 class="skip">Navigation</h1>\r\n\r\n <h2>Navigation</h2>\r\n <ul class="nobullets">\r\n   <li><a href="<%todaylink%>">Today</a></li>\r\n   <li><a href="<%archivelink%>">Archives</a></li>\r\n   <li><a href="<%adminurl%>">Admin Area</a></li>\r\n </ul>\r\n\r\n <h2>Categories</h2>\r\n <%categorylist(grey/short)%>\r\n \r\n <h2>Search</h2>\r\n <%searchform%>\r\n \r\n <h2>Login</h2>\r\n <%loginform%>\r\n\r\n <h2>Powered by</h2>\r\n <%nucleusbutton(nucleus.gif,85,31)%>\r\n\r\n</div>\r\n\r\n</body>\r\n</html>');
INSERT INTO `nucleus_skin` VALUES (1, 'error', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\r\n\r\n<html>\r\n<head>\r\n  <meta http-equiv="Content-Type" content="text/html; charset=EUC-JP" />\r\n  <title><%sitevar(name)%></title>\r\n\r\n  <!-- some meta information (search engines might read this) -->\r\n  <meta name="generator" content="<%version%>" />\r\n\r\n  <!-- stylesheet definition (points to the place where colors -->\r\n  <!-- and layout is defined -->\r\n  <link rel="stylesheet" type="text/css" href="<%skinfile(grey.css)%>" />\r\n\r\n  <!-- prevent caching (can be removed) -->\r\n  <meta http-equiv="Pragma" content="no-cache" />\r\n  <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />\r\n  <meta http-equiv="Expires" content="-1" />\r\n  \r\n  <!-- extra navigational links -->\r\n  <link rel="bookmark" title="Nucleus" href="http://nucleuscms.org/" />\r\n  <link rel="top" title="Today" href="<%todaylink%>" />\r\n  <link rel="up" href="<%todaylink%>" title="Today" />\r\n</div>\r\n\r\n</head>\r\n<body>\r\n\r\n<!-- here starts the code that will be displayed in your browser -->\r\n<div class="contents">\r\n\r\n <!-- this is a normally hidden link, included for accessibility reasons -->\r\n <a href="#navigation" class="skip">Jump to navigation</a>\r\n\r\n <!-- a title -->\r\n <h1><%sitevar(name)%></h1>\r\n\r\n <h2>Error!</h2>\r\n\r\n <p><%errormessage%></p>\r\n\r\n <p><a href="javascript:history.go(-1);">Go back</a></p>\r\n\r\n</div><!-- end of the contents div -->\r\n\r\n<!-- definition of the logo left-top -->\r\n<div class="logo">\r\n <a href="<%sitevar(url)%>"><img src="<%skinfile(atom3.gif)%>" width="155" height="137" alt="" /></a>\r\n</div>\r\n\r\n<!-- definition of the menu -->\r\n<div class="menu">\r\n <!-- accessibility anchor -->\r\n <a name="navigation" id="navigation" class="skip"></a>\r\n <h1 class="skip">Navigation</h1>\r\n\r\n <h2>Navigation</h2>\r\n\r\n <ul class="nobullets">\r\n  <li><a href="<%todaylink%>">Today</a></li>\r\n  <li><a href="<%adminurl%>">Admin Area</a></li>\r\n </ul>\r\n \r\n <h2>Login</h2>\r\n <%loginform%>\r\n\r\n <h2>Powered by</h2>\r\n <%nucleusbutton(nucleus.gif,85,31)%>\r\n\r\n</div>\r\n\r\n</body>\r\n</html>');
INSERT INTO `nucleus_skin` VALUES (1, 'item', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\r\n\r\n<html>\r\n<head>\r\n  <meta http-equiv="Content-Type" content="text/html; charset=EUC-JP" />\r\n  <title><%itemtitle%> - <%blogsetting(name)%></title>\r\n\r\n  <!-- some meta information (search engines might read this) -->\r\n  <meta name="generator" content="<%version%>" />\r\n  <meta name="description" content="<%blogsetting(desc)%>" />\r\n\r\n  <!-- stylesheet definition (points to the place where colors -->\r\n  <!-- and layout is defined -->\r\n  <link rel="stylesheet" type="text/css" href="<%skinfile(grey.css)%>" />\r\n\r\n  <!-- prevent caching (can be removed) -->\r\n  <meta http-equiv="Pragma" content="no-cache" />\r\n  <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />\r\n  <meta http-equiv="Expires" content="-1" />\r\n  \r\n  <!-- extra navigational links -->\r\n  <link rel="bookmark" title="Nucleus" href="http://nucleuscms.org/" />\r\n  <link rel="alternate" type="application/rss+xml" title="RSS" href="xml-rss2.php" />\r\n  <link rel="archives" title="Archives" href="<%archivelink%>" />\r\n  <link rel="top" title="Today" href="<%sitevar(url)%>" />\r\n  <link rel="next" href="<%nextlink%>" title="Next Item" />\r\n  <link rel="prev" href="<%prevlink%>" title="Previous Item" />\r\n  <link rel="up" href="<%todaylink%>" title="Today" />\r\n\r\n</head>\r\n<body>\r\n\r\n<!-- here starts the code that will be displayed in your browser -->\r\n<div class="contents">\r\n\r\n <!-- page title -->\r\n <h1><%blogsetting(name)%></h1>\r\n\r\n <!-- this is a normally hidden link, included for accessibility reasons -->\r\n <a href="#navigation" class="skip">Jump to navigation</a>\r\n\r\n <!-- inserts the selected item using the template named \'grey/full\'     -->\r\n <%item(grey/full)%>\r\n\r\n <!-- this tag inserts the comments on the selected item, also using the -->\r\n <!-- template with name \'grey/full\'                                     -->\r\n <h2>Comments</h2>\r\n <%comments(grey/full)%>\r\n\r\n <h2>Add Comments</h2>\r\n <%commentform%>\r\n\r\n</div><!-- end of the contents div -->\r\n\r\n<!-- definition of the logo left-top -->\r\n<div class="logo">\r\n <a href="<%sitevar(url)%>"><img src="<%skinfile(atom3.gif)%>" width="155" height="137" alt="" /></a>\r\n</div>\r\n\r\n<!-- definition of the menu -->\r\n<div class="menu">\r\n\r\n <!-- accessibility anchor -->\r\n <a name="navigation" id="navigation" class="skip"></a>\r\n <h1 class="skip">Navigation</h1>\r\n\r\n <h2>Navigation</h2>\r\n <ul class="nobullets">\r\n  <li><a href="<%nextlink%>">Previous Item</a></li>\r\n  <li><a href="<%prevlink%>">Next Item</a></li>\r\n  <li><a href="<%todaylink%>">Today</a></li>\r\n  <li><a href="<%archivelink%>">Archives</a></li>\r\n  <li><a href="<%adminurl%>">Admin Area</a></li>\r\n </ul>\r\n\r\n <h2>Categories</h2>\r\n <%categorylist(grey/short)%>\r\n\r\n <h2>Search</h2>\r\n <%searchform%>\r\n \r\n <h2>Login</h2>\r\n <%loginform%>\r\n\r\n <h2>Powered by</h2>\r\n <%nucleusbutton(nucleus.gif,85,31)%>\r\n\r\n</div>\r\n\r\n</body>\r\n</html>');
INSERT INTO `nucleus_skin` VALUES (1, 'member', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\r\n\r\n<html>\r\n<head>\r\n  <meta http-equiv="Content-Type" content="text/html; charset=EUC-JP" />\r\n  <title><%sitevar(name)%></title>\r\n\r\n  <!-- some meta information (search engines might read this) -->\r\n  <meta name="generator" content="<%version%>" />\r\n\r\n  <!-- stylesheet definition (points to the place where colors -->\r\n  <!-- and layout is defined -->\r\n  <link rel="stylesheet" type="text/css" href="<%skinfile(grey.css)%>" />\r\n\r\n  <!-- prevent caching (can be removed) -->\r\n  <meta http-equiv="Pragma" content="no-cache" />\r\n  <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />\r\n  <meta http-equiv="Expires" content="-1" />\r\n  \r\n  <!-- extra navigational links -->\r\n  <link rel="bookmark" title="Nucleus" href="http://nucleuscms.org/" />\r\n  <link rel="top" title="Today" href="<%todaylink%>" />\r\n  <link rel="up" href="<%todaylink%>" title="Today" />\r\n\r\n</head>\r\n<body>\r\n\r\n<!-- here starts the code that will be displayed in your browser -->\r\n<div class="contents">\r\n\r\n <!-- this is a normally hidden link, included for accessibility reasons -->\r\n <a href="#navigation" class="skip">Jump to navigation</a>\r\n\r\n <!-- a title -->\r\n <h1><%sitevar(name)%></h1>\r\n\r\n <h2>Info about <%member(name)%></h2>\r\n\r\n <ul>\r\n  <li>Real name: <%member(realname)%></li>\r\n  <li>Website: <a href="<%member(url)%>"><%member(url)%></a></li>\r\n </ul>\r\n\r\n <h2>Send Message</h2>\r\n <%membermailform%>\r\n\r\n</div><!-- end of the contents div -->\r\n\r\n<!-- definition of the logo left-top -->\r\n<div class="logo">\r\n <a href="<%sitevar(url)%>"><img src="<%skinfile(atom3.gif)%>" width="155" height="137" alt="" /></a>\r\n</div>\r\n\r\n<!-- definition of the menu -->\r\n<div class="menu">\r\n <!-- accessibility anchor -->\r\n <a name="navigation" id="navigation" class="skip"></a>\r\n <h1 class="skip">Navigation</h1>\r\n\r\n <h2>Navigation</h2>\r\n\r\n <ul class="nobullets">\r\n  <li><a href="<%todaylink%>">Today</a></li>\r\n  <li><a href="<%adminurl%>">Admin Area</a></li>\r\n </ul>\r\n \r\n <h2>Login</h2>\r\n <%loginform%>\r\n\r\n <h2>Powered by</h2>\r\n <%nucleusbutton(nucleus.gif,85,31)%>\r\n\r\n</div>\r\n\r\n</body>\r\n</html>');
INSERT INTO `nucleus_skin` VALUES (1, 'search', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">\r\n\r\n<html>\r\n<head>\r\n  <meta http-equiv="Content-Type" content="text/html; charset=EUC-JP" />\r\n  <title><%blogsetting(name)%></title>\r\n\r\n  <!-- some meta information (search engines might read this) -->\r\n  <meta name="generator" content="<%version%>" />\r\n  <meta name="description" content="<%blogsetting(desc)%>" />\r\n\r\n  <!-- stylesheet definition (points to the place where colors -->\r\n  <!-- and layout is defined -->\r\n  <link rel="stylesheet" type="text/css" href="<%skinfile(grey.css)%>" />\r\n  \r\n  <!-- prevent caching (can be removed) -->\r\n  <meta http-equiv="Pragma" content="no-cache" />\r\n  <meta http-equiv="Cache-Control" content="no-cache, must-revalidate" />\r\n  <meta http-equiv="Expires" content="-1" />\r\n  \r\n  <!-- extra navigational links -->\r\n  <link rel="bookmark" title="Nucleus" href="http://nucleuscms.org/" />\r\n  <link rel="alternate" type="application/rss+xml" title="RSS" href="xml-rss2.php" />\r\n  <link rel="archives" title="Archives" href="<%archivelink%>" />\r\n  <link rel="top" title="Today" href="<%sitevar(url)%>" />\r\n  <link rel="up" href="<%todaylink%>" title="Today" />\r\n\r\n</head>\r\n<body>\r\n\r\n<!-- here starts the code that will be displayed in your browser -->\r\n<div class="contents">\r\n\r\n <!-- this is a normally hidden link, included for accessibility reasons -->\r\n <a href="#navigation" class="skip">Jump to navigation</a>\r\n\r\n <!-- a title -->\r\n <h1><%blogsetting(name)%></h1>\r\n\r\n <h2>Search</h2>\r\n <%searchform%>\r\n\r\n <h2>Search results</h2>\r\n <%searchresults(grey/short)%>\r\n\r\n</div><!-- end of the contents div -->\r\n\r\n<!-- definition of the logo left-top -->\r\n<div class="logo">\r\n <a href="<%sitevar(url)%>"><img src="<%skinfile(atom3.gif)%>" width="155" height="137" alt="" /></a>\r\n</div>\r\n\r\n<!-- definition of the menu -->\r\n<div class="menu">\r\n <!-- accessibility anchor -->\r\n <a name="navigation" id="navigation" class="skip"></a>\r\n <h1 class="skip">Navigation</h1>\r\n\r\n <h2>Navigation</h2>\r\n\r\n <ul class="nobullets">\r\n   <li><a href="<%todaylink%>">Today</a></li>\r\n   <li><a href="<%archivelink%>">Archives</a></li>\r\n   <li><a href="<%adminurl%>">Admin Area</a></li>\r\n </ul>\r\n\r\n <h2>Search</h2>\r\n <%searchform%>\r\n \r\n <h2>Login</h2>\r\n <%loginform%>\r\n\r\n <h2>Powered by</h2>\r\n <%nucleusbutton(nucleus.gif,85,31)%>\r\n\r\n</div>\r\n\r\n</body>\r\n</html>');

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

INSERT INTO `nucleus_template` VALUES (3, 'ITEM', '<item>\r\n <title><![CDATA[<%title%>]]></title>\r\n <link><%blogurl%>?itemid=<%itemid%></link>\r\n<description><![CDATA[<%body%><%more%>]]></description>\r\n <category><%category%></category>\r\n<comments><%blogurl%>?itemid=<%itemid%></comments>\r\n <pubDate><%date(rfc822)%></pubDate>\r\n</item>');
INSERT INTO `nucleus_template` VALUES (3, 'EDITLINK', '<a href="<%editlink%>" onclick="<%editpopupcode%>">edit</a>');
INSERT INTO `nucleus_template` VALUES (4, 'ITEM', '<%date(utc)%>');
INSERT INTO `nucleus_template` VALUES (5, 'ITEM', '<entry>\r\n <title type="text/html" mode="escaped"><![CDATA[<%title%>]]></title>\r\n <link rel="alternate" type="text/html" href="<%blogurl%>?itemid=<%itemid%>" />\r\n <author>\r\n  <name><%author%></name>\r\n </author>\r\n <modified><%date(utc)%></modified>\r\n <issued><%date(iso8601)%></issued>\r\n <content type="text/html" mode="escaped"><![CDATA[<%body%><%more%>]]></content>\r\n <id><%blogurl%>:<%blogid%>:<%itemid%></id>\r\n</entry>');
INSERT INTO `nucleus_template` VALUES (1, 'ARCHIVELIST_FOOTER', '</ul>');
INSERT INTO `nucleus_template` VALUES (1, 'ARCHIVELIST_HEADER', '<ul>');
INSERT INTO `nucleus_template` VALUES (1, 'ARCHIVELIST_LISTITEM', '<li><a href="<%archivelink%>">%Y-%m</a></li>');
INSERT INTO `nucleus_template` VALUES (1, 'CATLIST_FOOTER', '</ul>');
INSERT INTO `nucleus_template` VALUES (1, 'CATLIST_HEADER', '<ul class="nobullets">\n <li><a href="<%blogurl%>">All</a></li>');
INSERT INTO `nucleus_template` VALUES (1, 'CATLIST_LISTITEM', ' <li><a href="<%catlink%>"><%catname%></a></li>');
INSERT INTO `nucleus_template` VALUES (1, 'COMMENTS_MANY', 'comments');
INSERT INTO `nucleus_template` VALUES (1, 'COMMENTS_NONE', '<a href="<%itemlink%>" rel="bookmark">No <%commentword%></a>');
INSERT INTO `nucleus_template` VALUES (1, 'COMMENTS_ONE', 'comment');
INSERT INTO `nucleus_template` VALUES (1, 'COMMENTS_TOOMUCH', '<a href="<%itemlink%>" rel="bookmark"><%commentcount%> <%commentword%></a>');
INSERT INTO `nucleus_template` VALUES (1, 'DATE_HEADER', '<h2>%Y-%m-%d</h2>\n');
INSERT INTO `nucleus_template` VALUES (1, 'EDITLINK', '<a href="<%editlink%>" onclick="<%editpopupcode%>">edit</a> -');
INSERT INTO `nucleus_template` VALUES (1, 'FORMAT_DATE', '%Y-%m-%d');
INSERT INTO `nucleus_template` VALUES (1, 'FORMAT_TIME', '%H:%M:%S');
INSERT INTO `nucleus_template` VALUES (1, 'IMAGE_CODE', '<%image%>');
INSERT INTO `nucleus_template` VALUES (1, 'ITEM', '<h3 class="item"><%title%></h3>\n\n<div class="itembody">\n  <%body%>\n  <%morelink%>\n</div>\n\n<div class="iteminfo">\n  <%time%> -\n  <a href="<%authorlink%>"><%author%></a> -\n  <%edit%>\n  <%comments%>\n</div>\n');
INSERT INTO `nucleus_template` VALUES (1, 'LOCALE', 'ja_JP.EUC-JP');
INSERT INTO `nucleus_template` VALUES (1, 'MEDIA_CODE', '<%media%>');
INSERT INTO `nucleus_template` VALUES (1, 'MORELINK', '<a href="<%itemlink%>">[Read More!]</a>');
INSERT INTO `nucleus_template` VALUES (1, 'POPUP_CODE', '<%popuplink%>');
INSERT INTO `nucleus_template` VALUES (1, 'SEARCH_HIGHLIGHT', '<span class="highlight">\\0</span>');
INSERT INTO `nucleus_template` VALUES (1, 'SEARCH_NOTHINGFOUND', 'No search results found for <b><%query%></b>');
INSERT INTO `nucleus_template` VALUES (2, 'COMMENTS_ONE', 'comment');
INSERT INTO `nucleus_template` VALUES (2, 'COMMENTS_MANY', 'comments');
INSERT INTO `nucleus_template` VALUES (2, 'COMMENTS_BODY', '<h3 class="comment"><%userlink%> wrote:</h3>\r\n\r\n<div class="commentbody">\r\n  <%body%>\r\n</div>\r\n\r\n<div class="commentinfo">\r\n  <%date%> <%time%>\r\n</div>');
INSERT INTO `nucleus_template` VALUES (2, 'EDITLINK', '- <a href="<%editlink%>" onclick="<%editpopupcode%>">edit</a>');
INSERT INTO `nucleus_template` VALUES (2, 'ITEM', '<h2><%date(%Y-%m-%d)%></h2>\r\n<h3 class="item"><%title%></h3>\r\n\r\n<div class="itembody">\r\n  <%body%>\r\n  <br /><br />\r\n  <%more%>\r\n</div>\r\n\r\n<div class="iteminfo">\r\n  posted at <%time%> on <%date%>\r\n  by <a href="?memberid=<%authorid%>"><%author%></a> -\r\n  Category: <a href="<%categorylink%>"><%category%></a>\r\n  <%edit%>\r\n</div>\r\n');
INSERT INTO `nucleus_template` VALUES (3, 'FORMAT_DATE', '%Y-%m-%d');
INSERT INTO `nucleus_template` VALUES (3, 'FORMAT_TIME', '%H:%M:%S');
INSERT INTO `nucleus_template` VALUES (2, 'COMMENTS_NONE', '<div class="comments">No comments yet</div>');
INSERT INTO `nucleus_template` VALUES (2, 'FORMAT_DATE', '%Y-%m-%d');
INSERT INTO `nucleus_template` VALUES (2, 'FORMAT_TIME', '%H:%M:%S');
INSERT INTO `nucleus_template` VALUES (2, 'LOCALE', 'ja_JP.EUC-JP');
INSERT INTO `nucleus_template` VALUES (2, 'SEARCH_HIGHLIGHT', '<span class="highlight">\\0</span>');
INSERT INTO `nucleus_template` VALUES (2, 'POPUP_CODE', '<%popuplink%>');
INSERT INTO `nucleus_template` VALUES (2, 'MEDIA_CODE', '<%media%>');
INSERT INTO `nucleus_template` VALUES (2, 'IMAGE_CODE', '<%image%>');

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

CREATE TABLE `nucleus_tickets` (
  `ticket` varchar(40) NOT NULL default '',
  `ctime` datetime NOT NULL default '0000-00-00 00:00:00',
  `member` int(11) NOT NULL default '0',
  PRIMARY KEY  (`ticket`, `member`)
) TYPE=MyISAM;
