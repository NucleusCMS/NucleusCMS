CREATE TABLE `nucleus_actionlog` (
  `timestamp`  datetime     NOT NULL default '0000-00-00 00:00:00',
  `message`    varchar(255) NOT NULL default ''
) TYPE=MyISAM;

CREATE TABLE `nucleus_activation` (
  `vkey`    varchar(40)  NOT NULL default '',
  `vtime`   datetime     NOT NULL default '0000-00-00 00:00:00',
  `vmember` int(11)      NOT NULL default '0',
  `vtype`   varchar(15)  NOT NULL default '',
  `vextra`  varchar(128) NOT NULL default '',
  PRIMARY KEY  (`vkey`)
) TYPE=MyISAM;

CREATE TABLE `nucleus_ban` (
  `iprange` varchar(15)  NOT NULL default '',
  `reason`  varchar(255) NOT NULL default '',
  `blogid`  int(11)      NOT NULL default '0'
) TYPE=MyISAM;

CREATE TABLE `nucleus_blog` (
  `bnumber`        int(11)      NOT NULL auto_increment,
  `bname`          varchar(60)  NOT NULL default '',
  `bshortname`     varchar(15)  NOT NULL default '',
  `bdesc`          varchar(200)          default NULL,
  `bcomments`      tinyint(2)   NOT NULL default '1',
  `bmaxcomments`   int(11)      NOT NULL default '0',
  `btimeoffset`    decimal(3,1) NOT NULL default '0.0',
  `bnotify`        varchar(60)           default NULL,
  `burl`           varchar(100)          default NULL,
  `bupdate`        varchar(60)           default NULL,
  `bdefskin`       int(11)      NOT NULL default '1',
  `bpublic`        tinyint(2)   NOT NULL default '1',
  `bconvertbreaks` tinyint(2)   NOT NULL default '1',
  `bdefcat`        int(11)               default NULL,
  `bnotifytype`    int(11)      NOT NULL default '15',
  `ballowpast`     tinyint(2)   NOT NULL default '0',
  `bincludesearch` tinyint(2)   NOT NULL default '0',
  `breqemail`      tinyint(2)   NOT NULL default '0',
  `bfuturepost`    tinyint(2)   NOT NULL default '0',
  PRIMARY KEY  (`bnumber`),
  UNIQUE KEY `bshortname` (`bshortname`)
) TYPE=MyISAM;

INSERT INTO `nucleus_blog` VALUES (
    1,                                  /* bnumber */
    'My Nucleus CMS',                   /* bname */
    'mynucleuscms',                     /* bshortname */
    '',                                 /* bdesc */
    1,                                  /* bcomments */
    0,                                  /* bmaxcomments */
    0.0,                                /* btimeoffset */
    '',                                 /* bnotify */
    'http://localhost:8080/nucleus/',   /* burl */
    '',                                 /* bupdate */
    5,                                  /* bdefskin */
    1,                                  /* bpublic */
    1,                                  /* bconvertbreaks */
    1,                                  /* bdefcat */
    1,                                  /* bnotifytype */
    1,                                  /* ballowpast */
    0,                                  /* bincludesearch */
    0,                                  /* breqemail */
    0                                   /* bfuturepost */
);

CREATE TABLE `nucleus_category` (
  `catid` int(11) NOT NULL auto_increment,
  `cblog` int(11) NOT NULL default '0',
  `cname` varchar(200) default NULL,
  `cdesc` varchar(200) default NULL,
  PRIMARY KEY  (`catid`)
) TYPE=MyISAM;

INSERT INTO `nucleus_category` VALUES (1, 1, 'General', 'Items that do not fit in other categories');

CREATE TABLE `nucleus_comment` (
  `cnumber` int(11)      NOT NULL auto_increment,
  `cbody`   text         NOT NULL,
  `cuser`   varchar(40)           default NULL,
  `cmail`   varchar(100)          default NULL,
  `cemail`  varchar(100),
  `cmember` int(11)               default NULL,
  `citem`   int(11)      NOT NULL default '0',
  `ctime`   datetime     NOT NULL default '0000-00-00 00:00:00',
  `chost`   varchar(60)           default NULL,
  `cip`     varchar(15)  NOT NULL default '',
  `cblog`   int(11)      NOT NULL default '0',
  PRIMARY KEY  (`cnumber`),
  KEY `citem` (`citem`),
  FULLTEXT KEY `cbody` (`cbody`)
) TYPE=MyISAM;

CREATE TABLE `nucleus_config` (
  `name`  varchar(20)  NOT NULL default '',
  `value` varchar(128)          default NULL,
  PRIMARY KEY  (`name`)
) TYPE=MyISAM;

INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('DefaultBlog',       '1'),
    ('AdminEmail',        'example@example.org'),
    ('IndexURL',          'http://localhost:8080/nucleus/'),
    ('Language',          'japanese-utf8'),
    ('SessionCookie',     ''),
    ('AllowMemberCreate', ''),
    ('AllowMemberMail',   '1'),
    ('SiteName',          'My Nucleus CMS'),
    ('AdminURL',          'http://localhost:8080/nucleus/nucleus/'),
    ('NewMemberCanLogon', '1'),
    ('DisableSite',       ''),
    ('DisableSiteURL',    'http://www.this-page-intentionally-left-blank.org/'),
    ('LastVisit',         ''),
    ('MediaURL',          'http://localhost:8080/nucleus/media/'),
    ('AllowedTypes',      'jpg,jpeg,gif,mpg,mpeg,avi,mov,mp3,swf,png'),
    ('AllowLoginEdit',    ''),
    ('AllowUpload',       '1'),
    ('DisableJsTools',    '2'),
    ('CookiePath',        '/'),
    ('CookieDomain',      ''),
    ('CookieSecure',      ''),
    ('CookiePrefix',      ''),
    ('MediaPrefix',       '1'),
    ('MaxUploadSize',     '1048576'),
    ('NonmemberMail',     ''),
    ('PluginURL',         'http://localhost:8080/nucleus/nucleus/plugins/'),
    ('ProtectMemNames',   '1'),
    ('BaseSkin',          '5'),
    ('SkinsURL',          'http://localhost:8080/nucleus/skins/'),
    ('ActionURL',         'http://localhost:8080/nucleus/action.php'),
    ('URLMode',           'normal'),
    ('DatabaseVersion',   '350'),
    ('DebugVars',         '0'),
    ('DefaultListSize',   '10');

CREATE TABLE `nucleus_item` (
  `inumber`   int(11)      NOT NULL auto_increment,
  `ititle`    varchar(160)          default NULL,
  `ibody`     text         NOT NULL,
  `imore`     text,
  `iblog`     int(11)      NOT NULL default '0',
  `iauthor`   int(11)      NOT NULL default '0',
  `itime`     datetime     NOT NULL default '0000-00-00 00:00:00',
  `iclosed`   tinyint(2)   NOT NULL default '0',
  `idraft`    tinyint(2)   NOT NULL default '0',
  `ikarmapos` int(11)      NOT NULL default '0',
  `icat`      int(11)               default NULL,
  `ikarmaneg` int(11)      NOT NULL default '0',
  `iposted`   tinyint(2)   NOT NULL default '1',
  PRIMARY KEY  (`inumber`),
  KEY `itime` (`itime`),
  FULLTEXT KEY `ibody` (`ibody`, `ititle`, `imore`)
) TYPE=MyISAM PACK_KEYS=0;

CREATE TABLE `nucleus_karma` (
  `itemid` int(11)  NOT NULL default '0',
  `ip`     char(15) NOT NULL default ''
) TYPE=MyISAM;

CREATE TABLE `nucleus_member` (
  `mnumber`    int(11)      NOT NULL auto_increment,
  `mname`      varchar(32)  NOT NULL default '',
  `mrealname`  varchar(60)           default NULL,
  `mpassword`  varchar(40)  NOT NULL default '',
  `memail`     varchar(60)           default NULL,
  `murl`       varchar(100)          default NULL,
  `mnotes`     varchar(100)          default NULL,
  `madmin`     tinyint(2)   NOT NULL default '0',
  `mcanlogin`  tinyint(2)   NOT NULL default '1',
  `mcookiekey` varchar(40)           default NULL,
  `deflang`    varchar(20)  NOT NULL default '',
  `mautosave`  tinyint(2)   NOT NULL default '1',
  PRIMARY KEY         (`mnumber`),
  UNIQUE  KEY `mname` (`mname`)
) TYPE=MyISAM;

INSERT INTO `nucleus_member` VALUES (
    1,                                  /* mnumber */
    'example',                          /* mname */
    'example',                          /* mrealname */
    '1a79a4d60de6718e8e5b326e338ae533', /* mpassword */
    'example@example.org',              /* memail */
    'http://localhost:8080/nucleus/',   /* murl */
    '',                                 /* mnotes */
    1,                                  /* madmin */
    1,                                  /* mcanlogin */
    'd767aefc60415859570d64c649257f19', /* mcookiekey */
    '',                                 /* deflang */
    1                                   /* mautosave */
);

CREATE TABLE `nucleus_plugin` (
  `pid`    int(11)     NOT NULL auto_increment,
  `pfile`  varchar(40) NOT NULL default '',
  `porder` int(11)     NOT NULL default '0',
  PRIMARY KEY     (`pid`),
  KEY    `porder` (`porder`)
) TYPE=MyISAM;

CREATE TABLE `nucleus_plugin_event` (
  `pid`   int(11)     NOT NULL default '0',
  `event` varchar(40)          default NULL,
  KEY `pid` (`pid`)
) TYPE=MyISAM;

CREATE TABLE `nucleus_plugin_option` (
  `ovalue`     text    NOT NULL,
  `oid`        int(11) NOT NULL auto_increment,
  `ocontextid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`oid`, `ocontextid`)
) TYPE=MyISAM;

CREATE TABLE `nucleus_plugin_option_desc` (
  `oid`      int(11)     NOT NULL auto_increment,
  `opid`     int(11)     NOT NULL default '0',
  `oname`    varchar(20) NOT NULL default '',
  `ocontext` varchar(20) NOT NULL default '',
  `odesc`    varchar(255)         default NULL,
  `otype`    varchar(20)          default NULL,
  `odef`     text,
  `oextra`   text,
  PRIMARY KEY  (`opid`, `oname`, `ocontext`),
  UNIQUE KEY `oid` (`oid`)
) TYPE=MyISAM;

CREATE TABLE `nucleus_skin` (
  `sdesc`    int(11)     NOT NULL default '0',
  `stype`    varchar(20) NOT NULL default '',
  `scontent` text        NOT NULL,
  PRIMARY KEY  (`sdesc`,`stype`)
) TYPE=MyISAM;

CREATE TABLE `nucleus_skin_desc` (
  `sdnumber`  int(11)     NOT NULL auto_increment,
  `sdname`    varchar(20) NOT NULL default '',
  `sddesc`    varchar(200)         default NULL,
  `sdtype`    varchar(40) NOT NULL default 'text/html',
  `sdincmode` varchar(10) NOT NULL default 'normal',
  `sdincpref` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`sdnumber`),
  UNIQUE KEY `sdname` (`sdname`)
) TYPE=MyISAM;

CREATE TABLE `nucleus_team` (
  `tmember` int(11)     NOT NULL default '0',
  `tblog`   int(11)     NOT NULL default '0',
  `tadmin`   tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (`tmember`, `tblog`)
) TYPE=MyISAM;

INSERT INTO `nucleus_team` VALUES (1, 1, 1);

CREATE TABLE `nucleus_template` (
  `tdesc`     int(11)     NOT NULL default '0',
  `tpartname` varchar(64) NOT NULL default '',
  `tcontent`  text        NOT NULL,
  PRIMARY KEY  (`tdesc`, `tpartname`)
) TYPE=MyISAM;

CREATE TABLE `nucleus_template_desc` (
  `tdnumber` int(11)     NOT NULL auto_increment,
  `tdname`   varchar(64) NOT NULL default '',
  `tddesc`   varchar(200)         default NULL,
  PRIMARY KEY (`tdnumber`),
  UNIQUE  KEY `tdname` (`tdname`)
) TYPE=MyISAM;

CREATE TABLE `nucleus_tickets` (
  `ticket` varchar(40) NOT NULL default '',
  `ctime` datetime     NOT NULL default '0000-00-00 00:00:00',
  `member` int(11)     NOT NULL default '0',
  PRIMARY KEY  (`ticket`,`member`)
) TYPE=MyISAM;
