CREATE TABLE `nucleus_actionlog` (
  `timestamp`  datetime     NOT NULL default '00-01-01 00:00:00',
  `message`    varchar(255) NOT NULL default ''
) ENGINE=MyISAM;

CREATE TABLE `nucleus_activation` (
  `vkey`    varchar(40)  NOT NULL default '',
  `vtime`   datetime     NOT NULL default '00-01-01 00:00:00',
  `vmember` int(11)      NOT NULL default '0',
  `vtype`   varchar(15)  NOT NULL default '',
  `vextra`  varchar(128) NOT NULL default '',
  PRIMARY KEY  (`vkey`)
) ENGINE=MyISAM;

CREATE TABLE `nucleus_ban` (
  `iprange` varchar(15)  NOT NULL default '',
  `reason`  varchar(255) NOT NULL default '',
  `blogid`  int(11)      NOT NULL default '0'
) ENGINE=MyISAM;

CREATE TABLE `nucleus_blog` (
  `bnumber`        int(11)      NOT NULL auto_increment,
  `bname`          varchar(60)  NOT NULL default '',
  `bshortname`     varchar(15)  NOT NULL default '',
  `bdesc`          varchar(200)          default NULL,
  `bcomments`      tinyint(2)   NOT NULL default '1',
  `bmaxcomments`   int(11)      NOT NULL default '0',
  `btimeoffset`    decimal(3,1) NOT NULL default '0.0',
  `bnotify`        varchar(128)          default NULL,
  `burl`           varchar(100)          default NULL,
  `bupdate`        varchar(60)           default NULL,
  `bdefskin`       int(11)      NOT NULL default '1',
  `bpublic`        tinyint(2)   NOT NULL default '1',
  `bconvertbreaks` tinyint(2)   NOT NULL default '1',
  `bdefcat`        int(11)               default NULL,
  `bnotifytype`    int(11)      NOT NULL default '15',
  `ballowpast`     tinyint(2)   NOT NULL default '1',
  `bincludesearch` tinyint(2)   NOT NULL default '0',
  `breqemail`      tinyint(2)   NOT NULL default '0',
  `bfuturepost`    tinyint(2)   NOT NULL default '0',
  `bauthorvisible` tinyint(2)   NOT NULL default '1',
  PRIMARY KEY  (`bnumber`),
  UNIQUE KEY `bshortname` (`bshortname`)
) ENGINE=MyISAM;

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
    0,                                  /* bpublic */
    1,                                  /* bconvertbreaks */
    1,                                  /* bdefcat */
    1,                                  /* bnotifytype */
    1,                                  /* ballowpast */
    0,                                  /* bincludesearch */
    0,                                  /* breqemail */
    0,                                  /* bfuturepost */
    1                                   /* bauthorvisible */
);

CREATE TABLE `nucleus_category` (
  `catid` int(11) NOT NULL auto_increment,
  `cblog` int(11) NOT NULL default '0',
  `cname` varchar(200) default NULL,
  `cdesc` varchar(200) default NULL,
  `corder` int(11)     NOT NULL default '100',
  PRIMARY KEY  (`catid`),
  INDEX `cblog` (`cblog`),
  INDEX `corder` (`corder`)
) ENGINE=MyISAM;

INSERT INTO `nucleus_category` VALUES (1, 1, 'General', 'Items that do not fit in other categories',100);

CREATE TABLE `nucleus_comment` (
  `cnumber` int(11)      NOT NULL auto_increment,
  `cbody`   text         NOT NULL,
  `cuser`   varchar(40)           default NULL,
  `cmail`   varchar(100)          default NULL,
  `cemail`  varchar(100),
  `cmember` int(11)               default NULL,
  `citem`   int(11)      NOT NULL default '0',
  `ctime`   datetime     NOT NULL default '00-01-01 00:00:00',
  `chost`   varchar(60)           default NULL,
  `cip`     varchar(15)  NOT NULL default '',
  `cblog`   int(11)      NOT NULL default '0',
  PRIMARY KEY  (`cnumber`),
  KEY `citem` (`citem`),
  FULLTEXT KEY `cbody` (`cbody`),
  INDEX `cblog` (`cblog`)
) ENGINE=MyISAM;

CREATE TABLE `nucleus_config` (
  `name`  varchar(50)  NOT NULL default '',
  `value` varchar(128)          default NULL,
  PRIMARY KEY  (`name`)
) ENGINE=MyISAM;

INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('DefaultBlog',       '1'),
    ('AdminEmail',        'example@example.org'),
    ('IndexURL',          'http://localhost/'),
    ('BaseURL',           '/'),
    ('Language',          'japanese-utf8'),
    ('SessionCookie',     ''),
    ('AllowMemberCreate', ''),
    ('AllowMemberMail',   '1'),
    ('SiteName',          'My Nucleus CMS'),
    ('AdminURL',          'http://localhost/nucleus/'),
    ('NewMemberCanLogon', '1'),
    ('DisableSite',       ''),
    ('DisableSiteURL',    ''),
    ('LastVisit',         ''),
    ('MediaURL',          'http://localhost/media/'),
    ('AllowedTypes',      'jpg,jpeg,gif,mpg,mpeg,avi,mov,mp3,swf,png'),
    ('AllowLoginEdit',    ''),
    ('AllowUpload',       '1'),
    ('DisableJsTools',    '2'),
    ('CookiePath',        '/'),
    ('CookieDomain',      ''),
    ('CookieSecure',      ''),
    ('CookiePrefix',      ''),
    ('MediaPrefix',       '1'),
    ('MaxUploadSize',     '3145728'),
    ('NonmemberMail',     ''),
    ('PluginURL',         'http://localhost/nucleus/plugins/'),
    ('ProtectMemNames',   '1'),
    ('BaseSkin',          '5'),
    ('SkinsURL',          'http://localhost/skins/'),
    ('ActionURL',         'http://localhost/action.php'),
    ('URLMode',           'normal'),
    ('DatabaseName',      'Nucleus'),
    ('DatabaseVersion',   '380'),
    ('DebugVars',         '0'),
    ('DefaultListSize',   '10'),
    ('DisableRSS',        '1'),
    ('AdminCSS',          'contemporary_jp');

CREATE TABLE `nucleus_item` (
  `inumber`   int(11)      NOT NULL auto_increment,
  `ititle`    varchar(160) NOT NULL default '',
  `ibody`     mediumtext   NOT NULL default '',
  `imore`     mediumtext   NOT NULL default '',
  `iblog`     int(11)      NOT NULL default '0',
  `iauthor`   int(11)      NOT NULL default '0',
  `itime`     datetime     NOT NULL default '00-01-01 00:00:00',
  `iclosed`   tinyint(2)   NOT NULL default '0',
  `idraft`    tinyint(2)   NOT NULL default '0',
  `ikarmapos` int(11)      NOT NULL default '0',
  `icat`      int(11)               default NULL,
  `ikarmaneg` int(11)      NOT NULL default '0',
  `iposted`   tinyint(2)   NOT NULL default '1',
  PRIMARY KEY  (`inumber`),
  KEY `itime` (`itime`),
  INDEX `iblog` (`iblog`),
  INDEX `idraft` (`idraft`),
  INDEX `icat` (`icat`),
  FULLTEXT KEY `ibody` (`ibody`, `ititle`, `imore`)
) ENGINE=MyISAM PACK_KEYS=0;

CREATE TABLE `nucleus_karma` (
  `itemid` int(11)  NOT NULL default '0',
  `ip`     char(15) NOT NULL default ''
) ENGINE=MyISAM;

CREATE TABLE `nucleus_member` (
  `mnumber`    int(11)      NOT NULL auto_increment,
  `mname`      varchar(32)  NOT NULL default '',
  `mrealname`  varchar(60)           default NULL,
  `mpassword`  varchar(255)  NOT NULL default '',
  `memail`     varchar(60)           default NULL,
  `murl`       varchar(100)          default NULL,
  `mnotes`     varchar(100)          default NULL,
  `madmin`     tinyint(2)   NOT NULL default '0',
  `mcanlogin`  tinyint(2)   NOT NULL default '1',
  `mcookiekey` varchar(40)           default NULL,
  `deflang`    varchar(20)  NOT NULL default '',
  `mautosave`  tinyint(2)   NOT NULL default '0',
  `mhalt`      tinyint(2)   NOT NULL default '0',
  `mhalt_reason`  varchar(100) NOT NULL default '',
  PRIMARY KEY         (`mnumber`),
  UNIQUE  KEY `mname` (`mname`)
) ENGINE=MyISAM;

INSERT INTO `nucleus_member` (
  mnumber, mname, mrealname,
  mpassword,
  memail, murl, mnotes,
  madmin, mcanlogin, mcookiekey,
  deflang, mautosave
  )
  VALUES (
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

CREATE TABLE `nucleus_member_option` (
  `omember`  int(11)      NOT NULL,
  `ocontext` varchar(20)  NOT NULL default '',
  `name`     varchar(100) NOT NULL,
  `value`    varchar(255) NOT NULL default '',
  PRIMARY KEY (`omember`),
  UNIQUE  KEY (`omember`, `name`, `ocontext`)
) ENGINE=MyISAM;

CREATE TABLE `nucleus_plugin` (
  `pid`    int(11)     NOT NULL auto_increment,
  `pfile`  varchar(40) NOT NULL default '',
  `porder` int(11)     NOT NULL default '0',
  PRIMARY KEY     (`pid`),
  KEY    `porder` (`porder`)
) ENGINE=MyISAM;

CREATE TABLE `nucleus_plugin_event` (
  `pid`   int(11)     NOT NULL default '0',
  `event` varchar(40)          default NULL,
  KEY `pid` (`pid`)
) ENGINE=MyISAM;

CREATE TABLE `nucleus_plugin_option` (
  `ovalue`     text    NOT NULL,
  `oid`        int(11) NOT NULL auto_increment,
  `ocontextid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`oid`, `ocontextid`)
) ENGINE=MyISAM;

CREATE TABLE `nucleus_plugin_option_desc` (
  `oid`      int(11)     NOT NULL auto_increment,
  `opid`     int(11)     NOT NULL default '0',
  `oname`    varchar(50) NOT NULL default '',
  `ocontext` varchar(20) NOT NULL default '',
  `odesc`    varchar(255)         default NULL,
  `otype`    varchar(20)          default NULL,
  `odef`     text,
  `oextra`   text,
  PRIMARY KEY  (`opid`, `oname`, `ocontext`),
  UNIQUE KEY `oid` (`oid`)
) ENGINE=MyISAM;

CREATE TABLE `nucleus_cached_data` (
  `cd_type`        varchar(50)   NOT NULL default '',
  `cd_sub_type`    varchar(50)   NOT NULL default '',
  `cd_sub_id`      int(11)       NOT NULL,
  `cd_allow_auto_clean`  tinyint(2)   NOT NULL default '1',
  `cd_name`        varchar(100)  NOT NULL,
  `cd_value`       mediumtext    NOT NULL,
  `cd_datetime`    datetime      NOT NULL,
  PRIMARY KEY  (`cd_type`, `cd_sub_type`, `cd_sub_id`, `cd_name`)
) ENGINE=MyISAM;

CREATE TABLE `nucleus_skin` (
  `sdesc`    int(11)     NOT NULL default '0',
  `stype`    varchar(20) NOT NULL default '',
  `scontent` text        NOT NULL,
  `spartstype`  varchar(20) NOT NULL default 'parts' ,
  PRIMARY KEY  (`sdesc`,`stype`)
) ENGINE=MyISAM;

CREATE TABLE `nucleus_skin_desc` (
  `sdnumber`  int(11)     NOT NULL auto_increment,
  `sdname`    varchar(20) NOT NULL default '',
  `sddesc`    varchar(200)         default NULL,
  `sdtype`    varchar(40) NOT NULL default 'text/html',
  `sdincmode` varchar(10) NOT NULL default 'normal',
  `sdincpref` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`sdnumber`),
  UNIQUE KEY `sdname` (`sdname`)
) ENGINE=MyISAM;

CREATE TABLE `nucleus_systemlog` (
  `logyear`        SMALLINT     NOT NULL,
  `logid`          BIGINT       NOT NULL AUTO_INCREMENT,
  `logtype`        varchar(30)  NOT NULL,
  `subtype`        varchar(30)  NOT NULL default '',
  `mnumber`        varchar(30)  NOT NULL default '0',
  `timestamp_utc`  datetime     NOT NULL,
  `message`        MEDIUMTEXT   NOT NULL,
  `message_hash`   varchar(64)  NOT NULL,
  PRIMARY KEY  (`logyear`, `logid`),
  INDEX `logtype` (`logtype`)
) ENGINE=MyISAM;

CREATE TABLE `nucleus_team` (
  `tmember` int(11)     NOT NULL default '0',
  `tblog`   int(11)     NOT NULL default '0',
  `tadmin`   tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (`tmember`, `tblog`)
) ENGINE=MyISAM;

INSERT INTO `nucleus_team` VALUES (1, 1, 1);

CREATE TABLE `nucleus_template` (
  `tdesc`     int(11)     NOT NULL default '0',
  `tpartname` varchar(64) NOT NULL default '',
  `tcontent`  text        NOT NULL,
  PRIMARY KEY  (`tdesc`, `tpartname`)
) ENGINE=MyISAM;

CREATE TABLE `nucleus_template_desc` (
  `tdnumber` int(11)     NOT NULL auto_increment,
  `tdname`   varchar(64) NOT NULL default '',
  `tddesc`   varchar(200)         default NULL,
  PRIMARY KEY (`tdnumber`),
  UNIQUE  KEY `tdname` (`tdname`)
) ENGINE=MyISAM;

CREATE TABLE `nucleus_tickets` (
  `ticket` varchar(40) NOT NULL default '',
  `ctime` datetime     NOT NULL default '00-01-01 00:00:00',
  `member` int(11)     NOT NULL default '0',
  PRIMARY KEY  (`ticket`,`member`)
) ENGINE=MyISAM;
