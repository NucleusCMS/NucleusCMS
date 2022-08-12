CREATE TABLE IF NOT EXISTS `nucleus_actionlog` (
  `timestamp`  datetime     NOT NULL default '0000-00-00 00:00:00',
  `message`    varchar(255) NOT NULL default '' COLLATE NOCASE 
);

CREATE TABLE IF NOT EXISTS `nucleus_activation` (
  `vkey`    varchar(40)  NOT NULL default '',
  `vtime`   datetime     NOT NULL default '0000-00-00 00:00:00',
  `vmember` int(11)      NOT NULL default '0',
  `vtype`   varchar(15)  NOT NULL default '',
  `vextra`  varchar(128) NOT NULL default '',
  PRIMARY KEY  (`vkey`)
);

CREATE TABLE IF NOT EXISTS `nucleus_ban` (
  `iprange` varchar(15)  NOT NULL default '' COLLATE NOCASE ,
  `reason`  varchar(255) NOT NULL default '' COLLATE NOCASE ,
  `blogid`  int(11)	NOT NULL default '0'
);

CREATE TABLE IF NOT EXISTS `nucleus_blog` (
  `bnumber`        INTEGER PRIMARY KEY AUTOINCREMENT ,
  `bname`          varchar(60)  NOT NULL default '' COLLATE NOCASE ,
  `bshortname`     varchar(15)  NOT NULL default '' COLLATE NOCASE ,
  `bdesc`          varchar(200)          default NULL COLLATE NOCASE ,
  `bcomments`      tinyint(2)   NOT NULL default '0',
  `bmaxcomments`   int(11)      NOT NULL default '0',
  `btimeoffset`    decimal(3,1) NOT NULL default '0.0',
  `bnotify`        varchar(128)           default NULL,
  `burl`           varchar(100)          default NULL COLLATE NOCASE ,
  `bupdate`        varchar(60)           default NULL COLLATE NOCASE ,
  `bdefskin`       int(11)      NOT NULL default '1',
  `bpublic`        tinyint(2)   NOT NULL default '0',
  `bconvertbreaks` tinyint(2)   NOT NULL default '1',
  `bdefcat`        int(11)               default NULL,
  `bnotifytype`    int(11)      NOT NULL default '15',
  `ballowpast`     tinyint(2)   NOT NULL default '1',
  `bincludesearch` tinyint(2)   NOT NULL default '0',
  `breqemail`      tinyint(2)   NOT NULL default '0',
  `bfuturepost`    tinyint(2)   NOT NULL default '0',
  `bauthorvisible` tinyint(2)   NOT NULL default '1',
  UNIQUE (`bshortname`)
);

INSERT INTO `nucleus_blog` VALUES (
    1,                     /* bnumber */
    'My Nucleus CMS',      /* bname */
    'mynucleuscms',        /* bshortname */
    '',                    /* bdesc */
    1,                     /* bcomments */
    0,                     /* bmaxcomments */
    0.0,                   /* btimeoffset */
    '',                    /* bnotify */
    'http://localhost/',   /* burl */
    '',                    /* bupdate */
    5,                     /* bdefskin */
    0,                     /* bpublic */
    1,                     /* bconvertbreaks */
    1,                     /* bdefcat */
    1,                     /* bnotifytype */
    1,                     /* ballowpast */
    0,                     /* bincludesearch */
    0,                     /* breqemail */
    0,                     /* bfuturepost */
    1                      /* bauthorvisible */
);

CREATE TABLE IF NOT EXISTS `nucleus_category` (
  `catid` INTEGER PRIMARY KEY AUTOINCREMENT  NOT NULL ,
  `cblog` int(11) NOT NULL default '0',
  `cname` varchar(200) default NULL COLLATE NOCASE ,
  `cdesc` varchar(200) default NULL COLLATE NOCASE ,
  `corder`  int(11)      NOT NULL default '100'
);

INSERT INTO `nucleus_category` (catid, cblog,cname,cdesc) VALUES (1, 1, 'General', 'Items that do not fit in other categories');

CREATE TABLE IF NOT EXISTS `nucleus_comment` (
  `cnumber` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,
  `cbody`   text         NOT NULL COLLATE NOCASE ,
  `cuser`   varchar(40)           default NULL COLLATE NOCASE ,
  `cmail`   varchar(100)          default NULL COLLATE NOCASE ,
  `cemail`  varchar(100)  COLLATE NOCASE ,
  `cmember` int(11)               default NULL,
  `citem`   int(11)      NOT NULL default '0',
  `ctime`   datetime     NOT NULL default '0000-00-00 00:00:00',
  `chost`   varchar(60)           default NULL COLLATE NOCASE ,
  `cip`     varchar(15)  NOT NULL default '' COLLATE NOCASE ,
  `cblog`   int(11)      NOT NULL default '0' 

/*  ,  FULLTEXT KEY `cbody` (`cbody`) */
);

/* DROP TABLE IF EXISTS nucleus_comment_fts; */
CREATE VIRTUAL TABLE nucleus_comment_fts USING fts4(cbody);

/*
INSERT INTO nucleus_comment_fts(docid, cbody)
  SELECT cnumber , cbody FROM nucleus_comment order by cnumber ASC;
*/

CREATE INDEX IF NOT EXISTS `nucleus_category_idx_cblog` on `nucleus_category` (`cblog`);
CREATE INDEX IF NOT EXISTS `nucleus_category_idx_corder` on `nucleus_category` (`corder`);


CREATE TRIGGER nucleus_comment_trig_insert
AFTER INSERT ON nucleus_comment FOR EACH ROW
BEGIN
  INSERT INTO nucleus_comment_fts(docid, cbody) VALUES(NEW.cnumber ,NEW.cbody);
END;

CREATE TRIGGER nucleus_comment_trig_delete
AFTER DELETE ON nucleus_comment FOR EACH ROW
BEGIN
  DELETE FROM nucleus_comment_fts WHERE docid = OLD.cnumber;
END;

CREATE TRIGGER nucleus_comment_trig_update
AFTER UPDATE ON nucleus_comment FOR EACH ROW
BEGIN
  UPDATE nucleus_comment_fts SET cbody = NEW.cbody WHERE docid = NEW.cnumber;
END;


CREATE INDEX IF NOT EXISTS `nucleus_comment_idx_citem` on `nucleus_comment` (`citem`);
CREATE INDEX IF NOT EXISTS `nucleus_comment_idx_cblog` on `nucleus_comment` (`cblog`);
/* warning : overflow index size */
  CREATE INDEX IF NOT EXISTS `nucleus_comment_idx_cbody` on `nucleus_comment` (`cbody`);

CREATE TABLE IF NOT EXISTS `nucleus_config` (
  `name`  varchar(50)  NOT NULL default '' COLLATE NOCASE ,
  `value` varchar(128)          default NULL COLLATE NOCASE ,
  PRIMARY KEY  (`name`)
);

INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('DefaultBlog',       '1');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('AdminEmail',        'example@example.org');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('IndexURL',          'http://localhost/');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('BaseURL',           '/');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('Language',          'japanese-utf8');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('SessionCookie',     '');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('AllowMemberCreate', '');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('AllowMemberMail',   '1');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('SiteName',          'My Nucleus CMS');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('AdminURL',          'http://localhost/nucleus/');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('NewMemberCanLogon', '1');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('DisableSite',       '');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('DisableSiteURL',    '');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('LastVisit',         '');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('MediaURL',          'http://localhost/media/');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('AllowedTypes',      'jpg,jpeg,gif,mpg,mpeg,avi,mov,mp3,swf,png');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('AllowLoginEdit',    '');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('AllowUpload',       '1');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('DisableJsTools',    '2');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('CookiePath',        '/');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('CookieDomain',      '');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('CookieSecure',      '');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('CookiePrefix',      '');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('MediaPrefix',       '1');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('MaxUploadSize',     '5000000');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('NonmemberMail',     '');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('PluginURL',         'http://localhost/nucleus/plugins/');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('ProtectMemNames',   '1');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('BaseSkin',          '5');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('SkinsURL',          'http://localhost/skins/');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('ActionURL',         'http://localhost/action.php');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('URLMode',           'normal');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('DatabaseName',      'Nucleus');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('DatabaseVersion',   '380');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('DebugVars',         '0');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('DefaultListSize',   '10');
INSERT INTO `nucleus_config` (`name`, `value`) VALUES
    ('AdminCSS',          'contemporary');

CREATE TABLE IF NOT EXISTS `nucleus_item` (
  `inumber`   INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,
  `ititle`    varchar(160) NOT NULL default '' COLLATE NOCASE ,
  `ibody`     text         NOT NULL default '' COLLATE NOCASE ,
  `imore`     text         NOT NULL default '' COLLATE NOCASE ,
  `iblog`     int(11)      NOT NULL default '0',
  `iauthor`   int(11)      NOT NULL default '0',
  `itime`     datetime     NOT NULL default '0000-00-00 00:00:00',
  `iclosed`   tinyint(2)   NOT NULL default '0',
  `idraft`    tinyint(2)   NOT NULL default '0',
  `ikarmapos` int(11)      NOT NULL default '0',
  `icat`      int(11)               default NULL,
  `ikarmaneg` int(11)      NOT NULL default '0',
  `iposted`   tinyint(2)   NOT NULL default '1'
/* ,  FULLTEXT KEY `ibody` (`ibody`, `ititle`, `imore`) */
);

/* DROP TABLE IF EXISTS nucleus_item_fts; */
CREATE VIRTUAL TABLE nucleus_item_fts USING fts4(ifts_body, ifts_title, ifts_more);
/*
  INSERT INTO nucleus_item_fts(docid, ifts_body, ifts_title, ifts_more)
  SELECT inumber , ibody, ititle, imore FROM nucleus_item order by inumber ASC;
*/
CREATE TRIGGER nucleus_item_trig_insert
AFTER INSERT ON nucleus_item FOR EACH ROW
BEGIN
  INSERT INTO nucleus_item_fts(docid, ifts_body, ifts_title, ifts_more)
	 VALUES(NEW.inumber ,NEW.ibody,NEW.ititle,NEW.imore);
END;

CREATE TRIGGER nucleus_item_trig_delete
AFTER DELETE ON nucleus_item FOR EACH ROW
BEGIN
  DELETE FROM nucleus_item_fts WHERE docid = OLD.inumber;
END;

CREATE TRIGGER nucleus_item_trig_update
AFTER UPDATE ON nucleus_item FOR EACH ROW
BEGIN
  UPDATE nucleus_item_fts SET ifts_body = NEW.ibody ,
   ifts_title = NEW.ititle , ifts_more = NEW.imore 
  WHERE docid = NEW.inumber;
END;


CREATE INDEX IF NOT EXISTS `nucleus_item_idx_itime` on `nucleus_item` (`itime`);
CREATE INDEX IF NOT EXISTS `nucleus_item_idx_iblog` on `nucleus_item` (`iblog`);
CREATE INDEX IF NOT EXISTS `nucleus_item_idx_idraft` on `nucleus_item` (`idraft`);
CREATE INDEX IF NOT EXISTS `nucleus_item_idx_icat` on `nucleus_item` (`icat`);
/* warning : overflow index size */
  CREATE INDEX IF NOT EXISTS `nucleus_item_idx_ibody` on `nucleus_item` (`ibody`, `ititle`, `imore`);


CREATE TABLE IF NOT EXISTS `nucleus_karma` (
  `itemid` int(11)  NOT NULL default '0',
  `ip`     char(15) NOT NULL default '' COLLATE NOCASE 
);

CREATE TABLE IF NOT EXISTS `nucleus_member` (
  `mnumber`    INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,
  `mname`      varchar(32)  NOT NULL default '' COLLATE NOCASE ,
  `mrealname`  varchar(60)           default NULL COLLATE NOCASE ,
  `mpassword`  varchar(255)  NOT NULL default '',
  `memail`     varchar(60)           default NULL COLLATE NOCASE ,
  `murl`       varchar(100)          default NULL COLLATE NOCASE ,
  `mnotes`     varchar(100)          default NULL COLLATE NOCASE ,
  `madmin`     tinyint(2)   NOT NULL default '0',
  `mcanlogin`  tinyint(2)   NOT NULL default '0',
  `mcookiekey` varchar(40)           default NULL,
  `deflang`    varchar(20)  NOT NULL default '' COLLATE NOCASE ,
  `mautosave`  tinyint(2)   NOT NULL default '1',
  `mhalt`      tinyint(2)   NOT NULL default '0',
  `mhalt_reason`  varchar(100) NOT NULL default '' COLLATE NOCASE ,
  UNIQUE (`mname`)
);

CREATE INDEX IF NOT EXISTS `nucleus_member_idx_mhalt` on `nucleus_member` (`mhalt`);

INSERT INTO `nucleus_member` (
  mnumber, mname, mrealname,
  mpassword,
  memail, murl, mnotes,
  madmin, mcanlogin, mcookiekey
  )
  VALUES (
    1, 'example', 'example',
    '1a79a4d60de6718e8e5b326e338ae533', /* mpassword */
    'example@example.org', 'http://localhost/', '',
    1, 1, 'd767aefc60415859570d64c649257f19'
);

CREATE TABLE IF NOT EXISTS `nucleus_member_option` (
  `omember`  int(11)      NOT NULL,
  `ocontext` varchar(20)  NOT NULL default '' COLLATE NOCASE,
  `name`     varchar(100) NOT NULL COLLATE NOCASE ,
  `value`    varchar(255) NOT NULL default '',
  UNIQUE (`omember`, `ocontext`, `name`)
);

CREATE TABLE IF NOT EXISTS `nucleus_plugin` (
  `pid`    INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,
  `pfile`  varchar(40) NOT NULL default '' COLLATE NOCASE ,
  `porder` int(11)     NOT NULL default '0'
);

CREATE INDEX IF NOT EXISTS `nucleus_plugin_idx_porder` on `nucleus_plugin` (`porder`);


CREATE TABLE IF NOT EXISTS `nucleus_plugin_event` (
  `pid`   int(11)     NOT NULL default '0',
  `event` varchar(40)          default NULL COLLATE NOCASE 
/*  ,  KEY `pid` (`pid`) */
);

CREATE INDEX IF NOT EXISTS `nucleus_plugin_event_idx_pid` on `nucleus_plugin_event` (`pid`);

CREATE TABLE IF NOT EXISTS `nucleus_plugin_option` (
  `ovalue`     text    NOT NULL COLLATE NOCASE ,
  `oid`        int(11) NOT NULL /* auto_increment */,
  `ocontextid` int(11) NOT NULL default '0' ,
 PRIMARY KEY  (`oid`, `ocontextid`)
);

CREATE INDEX IF NOT EXISTS `nucleus_plugin_option_idx_ocontextid` on `nucleus_plugin_option` (`ocontextid`);


CREATE TABLE IF NOT EXISTS `nucleus_plugin_option_desc` (
  `oid`      INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,
  `opid`     int(11)     NOT NULL default '0',
  `oname`    varchar(50) NOT NULL default '' COLLATE NOCASE ,
  `ocontext` varchar(20) NOT NULL default '' COLLATE NOCASE ,
  `odesc`    varchar(255)         default NULL COLLATE NOCASE ,
  `otype`    varchar(20)          default NULL COLLATE NOCASE ,
  `odef`     text COLLATE NOCASE ,
  `oextra`   text COLLATE NOCASE ,
  UNIQUE (`opid`, `oname`, `ocontext`)
);

CREATE TABLE `nucleus_cached_data` (
  `cd_type`        varchar(50)   NOT NULL default '' COLLATE NOCASE,
  `cd_sub_type`    varchar(50)   NOT NULL default '' COLLATE NOCASE,
  `cd_sub_id`      int(11)       NOT NULL,
  `cd_allow_auto_clean`  tinyint(2)   NOT NULL default '1',
  `cd_name`        varchar(100)  NOT NULL COLLATE NOCASE,
  `cd_value`       mediumtext    NOT NULL,
  `cd_datetime`    datetime      NOT NULL,
  PRIMARY KEY  (`cd_type`, `cd_sub_type`, `cd_sub_id`, `cd_name`)
);

CREATE TABLE IF NOT EXISTS `nucleus_skin` (
  `sdesc`    int(11)     NOT NULL default '0',
  `stype`    varchar(20) NOT NULL default '' COLLATE NOCASE ,
  `scontent` text        NOT NULL ,
  `spartstype`  varchar(20) NOT NULL default 'parts' ,
  PRIMARY KEY  (`sdesc`,`stype`)
);

CREATE TABLE IF NOT EXISTS `nucleus_skin_desc` (
  `sdnumber`  INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,
  `sdname`    varchar(20) NOT NULL default '' COLLATE NOCASE ,
  `sddesc`    varchar(200)         default NULL COLLATE NOCASE ,
  `sdtype`    varchar(40) NOT NULL default 'text/html' COLLATE NOCASE ,
  `sdincmode` varchar(10) NOT NULL default 'normal' COLLATE NOCASE ,
  `sdincpref` varchar(50) NOT NULL default '' COLLATE NOCASE ,
  UNIQUE (`sdname`)
);

CREATE TABLE `nucleus_systemlog` (
  `logyear`        SMALLINT     NOT NULL,
  `logid`          BIGINT       NOT NULL,
  `logtype`        varchar(30)  NOT NULL,
  `subtype`        varchar(30)  NOT NULL default '',
  `mnumber`        varchar(30)  NOT NULL default '0',
  `timestamp_utc`  datetime     NOT NULL,
  `message`        MEDIUMTEXT   NOT NULL default '',
  `message_hash`   varchar(64)  NOT NULL,
   PRIMARY KEY  (`logyear`, `logid`)
);

CREATE INDEX IF NOT EXISTS `nucleus_systemlog_idx_logtype` on `nucleus_systemlog` (`logtype`);

CREATE TABLE IF NOT EXISTS `nucleus_team` (
  `tmember` int(11)     NOT NULL default '0',
  `tblog`   int(11)     NOT NULL default '0',
  `tadmin`   tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (`tmember`, `tblog`)
);

INSERT INTO `nucleus_team` VALUES (1, 1, 1);

CREATE TABLE IF NOT EXISTS `nucleus_template` (
  `tdesc`     int(11)     NOT NULL default '0',
  `tpartname` varchar(64) NOT NULL default '' COLLATE NOCASE,
  `tcontent`  text        NOT NULL COLLATE NOCASE ,
  PRIMARY KEY  (`tdesc`, `tpartname`)
);

CREATE TABLE IF NOT EXISTS `nucleus_template_desc` (
  `tdnumber` INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL ,
  `tdname`   varchar(64) NOT NULL default '' COLLATE NOCASE ,
  `tddesc`   varchar(200)         default NULL COLLATE NOCASE ,
  UNIQUE (`tdname`)
) ;

CREATE TABLE IF NOT EXISTS `nucleus_tickets` (
  `ticket` varchar(40) NOT NULL default '',
  `ctime` datetime     NOT NULL default '0000-00-00 00:00:00',
  `member` int(11)     NOT NULL default '0',
  PRIMARY KEY  (`ticket`,`member`)
);

