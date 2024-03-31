-- tinyint(2) を booleanにするとエラーが発生するので、smallintで定義してください。 ERROR: 演算子が存在しません: boolean = integer 
-- [Tips]
-- SQLの構文
-- https://www.postgresql.jp/docs/9.2/sql-syntax-lexical.html#SQL-SYNTAX-IDENTIFIERS
-- データ型: https://www.postgresql.jp/docs/9.2/datatype.html
--  連番型 SERIAL 型 : AUTO_INCREMENTはこれに置き換える
-- MySQLからの変換で困ったときは Copilot に聞くといい
-- 例:　下記SQL文をpostgres用に修正して
-- 例:　下記SQL文をpostgres用に変換せよ

CREATE TABLE "nucleus_actionlog" (
  "timestamp"  timestamp with time zone     NOT NULL default CURRENT_TIMESTAMP,
  "message"    varchar(255) NOT NULL default ''
);

CREATE TABLE "nucleus_activation" (
  "vkey"    varchar(40)  NOT NULL default '',
  "vtime"   timestamp with time zone     NOT NULL default CURRENT_TIMESTAMP,
  "vmember" integer      NOT NULL default '0',
  "vtype"   varchar(15)  NOT NULL default '',
  "vextra"  varchar(128) NOT NULL default '',
  PRIMARY KEY  ("vkey")
);

CREATE TABLE "nucleus_ban" (
  "iprange" varchar(15)  NOT NULL default '',
  "reason"  varchar(255) NOT NULL default '',
  "blogid"  integer      NOT NULL default '0'
);

CREATE TABLE "nucleus_blog" (
  "bnumber"        SERIAL      NOT NULL,
  "bname"          varchar(60)  NOT NULL default '',
  "bshortname"     varchar(15)  NOT NULL default '',
  "bdesc"          varchar(200)          default NULL,
  "bcomments"      smallint   NOT NULL default '1',
  "bmaxcomments"   integer      NOT NULL default '0',
  "btimeoffset"    decimal(3,1) NOT NULL default '0.0',
  "bnotify"        varchar(128)          default NULL,
  "burl"           varchar(100)          default NULL,
  "bupdate"        varchar(60)           default NULL,
  "bdefskin"       integer      NOT NULL default '1',
  "bpublic"        smallint   NOT NULL default '1',
  "bconvertbreaks" smallint   NOT NULL default '1',
  "bdefcat"        integer               default NULL,
  "bnotifytype"    integer      NOT NULL default '15',
  "ballowpast"     smallint   NOT NULL default '1',
  "bincludesearch" smallint   NOT NULL default '0',
  "breqemail"      smallint   NOT NULL default '0',
  "bfuturepost"    smallint   NOT NULL default '0',
  "bauthorvisible" smallint   NOT NULL default '1',
  "blast_modyfied" timestamp with time zone     NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  ("bnumber"),
  UNIQUE ("bshortname")
);


INSERT INTO "nucleus_blog" VALUES (
    1,                                  /* bnumber */
    'My Nucleus CMS',                   /* bname */
    'mynucleuscms',                     /* bshortname */
    '',                                 /* bdesc */
    '1',                                /* bcomments */
    0,                                  /* bmaxcomments */
    0.0,                                /* btimeoffset */
    '',                                 /* bnotify */
    'http://localhost:8080/nucleus/',   /* burl */
    '',                                 /* bupdate */
    4,                                  /* bdefskin */
    '0',                                /* bpublic */
    '1',                                /* bconvertbreaks */
    1,                                  /* bdefcat */
    1,                                  /* bnotifytype */
    '1',                                /* ballowpast */
    '0',                                /* bincludesearch */
    '0',                                /* breqemail */
    '0',                                /* bfuturepost */
    '1',                                /* bauthorvisible */
    '1970-01-01 00:00:00'               /* blast_modyfied */
);

CREATE TABLE "nucleus_category" (
  "catid" SERIAL NOT NULL,
  "cblog" integer NOT NULL default '0',
  "cname" varchar(200) default NULL,
  "cdesc" varchar(200) default NULL,
  "corder" integer     NOT NULL default '100',
  PRIMARY KEY  ("catid")
);

CREATE INDEX nucleus_category_cblog_index ON nucleus_category(cblog);
CREATE INDEX nucleus_category_corder_index ON nucleus_category(corder);

INSERT INTO "nucleus_category"
VALUES (1, 1, 'General', 'Items that do not fit in other categories',100);

CREATE TABLE "nucleus_comment" (
  "cnumber" SERIAL      NOT NULL,
  "cbody"   text        NOT NULL,
  "cuser"   varchar(40) default NULL,
  "cmail"   varchar(100) default NULL,
  "cemail"  varchar(100),
  "cmember" integer     default NULL,
  "citem"   integer     NOT NULL default '0',
  "ctime"   timestamp with time zone   NOT NULL default CURRENT_TIMESTAMP,
  "chost"   varchar(60) default NULL,
  "cip"     varchar(15) NOT NULL default '',
  "cblog"   integer     NOT NULL default '0',
  PRIMARY KEY  ("cnumber")
);

CREATE INDEX nucleus_comment_citem_index ON nucleus_comment(citem);
CREATE INDEX nucleus_comment_cblog_index ON nucleus_comment(cblog);


CREATE TABLE "nucleus_config" (
  "name"  varchar(200)  NOT NULL default '',
  "value" varchar(255)          default NULL,
  PRIMARY KEY  ("name")
);

INSERT INTO "nucleus_config" ("name", "value") VALUES
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
    ('BaseSkin',          '4'),
    ('SkinsURL',          'http://localhost/skins/'),
    ('ActionURL',         'http://localhost/action.php'),
    ('URLMode',           'normal'),
    ('DatabaseName',      'Nucleus'),
    ('DatabaseVersion',   '380'),
    ('DebugVars',         '0'),
    ('DefaultListSize',   '10'),
    ('DisableRSS',        '1'),
    ('ENABLE_PLUGIN_ADMIN_V1', '1'),
    ('ENABLE_PLUGIN_UPDATE_CHECK', '1'),
    ('AdminCSS',          'contemporary_jp');

CREATE TABLE "nucleus_item" (
  "inumber"   SERIAL      NOT NULL,
  "ititle"    varchar(160) NOT NULL,
  "ibody"     text   NOT NULL,
  "imore"     text   NOT NULL,
  "iblog"     integer      NOT NULL default '0',
  "iauthor"   integer      NOT NULL default '0',
  "itime"     timestamp with time zone   NOT NULL default CURRENT_TIMESTAMP,
  "iclosed"   smallint   NOT NULL default '0',
  "idraft"    smallint   NOT NULL default '0',
  "ikarmapos" integer      NOT NULL default '0',
  "icat"      integer     default NULL,
  "ikarmaneg" integer      NOT NULL default '0',
  "iposted"   smallint   NOT NULL default '1',
  "ipublic"   smallint   NOT NULL default '1',
  "ipublic_enable_term_start"  smallint   NOT NULL default '0',
  "ipublic_enable_term_end"    smallint   NOT NULL default '0',
  "ipublic_term_start"         timestamp with time zone     NOT NULL default '2000-01-01 00:00:00',
  "ipublic_term_end"           timestamp with time zone     NOT NULL default '2099-01-01 00:00:00',
  PRIMARY KEY  ("inumber")
);

CREATE INDEX itime_index ON nucleus_item(itime);
CREATE INDEX iblog_index ON nucleus_item(iblog);
CREATE INDEX idraft_index ON nucleus_item(idraft);
CREATE INDEX icat_index ON nucleus_item(icat);
CREATE INDEX ipublic_index ON nucleus_item(ipublic);
CREATE INDEX ipublic_enable_term_start_index ON nucleus_item(ipublic_enable_term_start);
CREATE INDEX ipublic_enable_term_end_index ON nucleus_item(ipublic_enable_term_end);
CREATE INDEX ipublic_term_start_index ON nucleus_item(ipublic_term_start);
CREATE INDEX ipublic_term_end_index ON nucleus_item(ipublic_term_end);


CREATE TABLE "nucleus_karma" (
  "itemid" integer  NOT NULL default '0',
  "ip"     char(15) NOT NULL default ''
);

CREATE TABLE "nucleus_member" (
  "mnumber"    SERIAL      NOT NULL,
  "mname"      varchar(32)  NOT NULL default '',
  "mrealname"  varchar(60)           default NULL,
  "mpassword"  varchar(255)  NOT NULL default '',
  "memail"     varchar(60)           default NULL,
  "murl"       varchar(100)          default NULL,
  "mnotes"     varchar(100)          default NULL,
  "madmin"     smallint   NOT NULL default '0',
  "mcanlogin"  smallint   NOT NULL default '1',
  "mcookiekey" varchar(40)           default NULL,
  "deflang"    varchar(20)  NOT NULL default '',
  "mautosave"  smallint   NOT NULL default '0',
  "mhalt"      smallint   NOT NULL default '0',
  "mhalt_reason"  varchar(100) NOT NULL default '',
  "mtoken"     varchar(100)          default NULL,
  PRIMARY KEY  ("mnumber")
);

CREATE UNIQUE INDEX mname_index ON nucleus_member(mname);
CREATE INDEX mhalt_index ON nucleus_member(mhalt);


INSERT INTO "nucleus_member" (
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
    '1',                                /* madmin */
    '1',                                /* mcanlogin */
    'd767aefc60415859570d64c649257f19', /* mcookiekey */
    '',                                 /* deflang */
    '1'                                 /* mautosave */
);

CREATE TABLE "nucleus_member_option" (
  "omember"  integer      NOT NULL,
  "ocontext" varchar(20)  NOT NULL default '',
  "name"     varchar(100) NOT NULL,
  "value"    varchar(255) NOT NULL default '',
  PRIMARY KEY ("omember", "name", "ocontext")
);

CREATE TABLE "nucleus_plugin" (
  "pid"    SERIAL      NOT NULL,
  "pfile"  varchar(40) NOT NULL default '',
  "porder" integer     NOT NULL default '0',
  PRIMARY KEY  ("pid")
);

CREATE INDEX porder_index ON nucleus_plugin(porder);
CREATE TABLE "nucleus_plugin_event" (
  "pid"   integer     NOT NULL default '0',
  "event" varchar(40) default NULL
);

CREATE INDEX pid_index ON nucleus_plugin_event(pid);

CREATE TABLE "nucleus_plugin_option" (
  "ovalue"     text    NOT NULL,
  "oid"        SERIAL NOT NULL,
  "ocontextid" integer NOT NULL default '0',
  PRIMARY KEY  ("oid", "ocontextid")
);


CREATE TABLE "nucleus_plugin_option_desc" (
  "oid"      SERIAL     NOT NULL,
  "opid"     integer    NOT NULL default '0',
  "oname"    varchar(200) NOT NULL default '',
  "ocontext" varchar(20) NOT NULL default '',
  "odesc"    varchar(255) default NULL,
  "otype"    varchar(20) default NULL,
  "odef"     text,
  "oextra"   text,
  PRIMARY KEY  ("opid", "oname", "ocontext")
);

CREATE UNIQUE INDEX oid_index ON nucleus_plugin_option_desc(oid);

CREATE TABLE "nucleus_skin" (
  "sdesc"    integer     NOT NULL default '0',
  "stype"    varchar(20) NOT NULL default '',
  "scontent" text        NOT NULL,
  "spartstype"  varchar(20) NOT NULL default 'parts' ,
  PRIMARY KEY  ("sdesc","stype","spartstype")
);


CREATE TABLE "nucleus_skin_desc" (
  "sdnumber"  SERIAL     NOT NULL,
  "sdname"    varchar(20) NOT NULL default '',
  "sddesc"    varchar(200) default NULL,
  "sdtype"    varchar(40) NOT NULL default 'text/html',
  "sdincmode" varchar(10) NOT NULL default 'normal',
  "sdincpref" varchar(50) NOT NULL default '',
  PRIMARY KEY  ("sdnumber")
);

CREATE UNIQUE INDEX sdname_index ON nucleus_skin_desc(sdname);

CREATE TABLE "nucleus_systemlog" (
  "logyear"        SMALLINT     NOT NULL,
  "logid"          BIGINT       NOT NULL,
  "logtype"        varchar(30)  NOT NULL,
  "subtype"        varchar(30)  NOT NULL default '',
  "mnumber"        varchar(30)  NOT NULL default '0',
  "timestamp_utc"  timestamp with time zone    NOT NULL,
  "message"        TEXT   NOT NULL default '',
  "message_hash"   varchar(64)  NOT NULL,
  PRIMARY KEY  ("logyear", "logid")
);

CREATE INDEX logtype_index ON nucleus_systemlog(logtype);


CREATE TABLE "nucleus_team" (
  "tmember" integer     NOT NULL default '0',
  "tblog"   integer     NOT NULL default '0',
  "tadmin"  smallint NOT NULL default '0',
  PRIMARY KEY  ("tmember", "tblog")
);

INSERT INTO "nucleus_team" VALUES (1, 1, 1);

CREATE TABLE "nucleus_template" (
  "tdesc"     integer     NOT NULL default '0',
  "tpartname" varchar(64) NOT NULL default '',
  "tcontent"  text        NOT NULL,
  PRIMARY KEY  ("tdesc", "tpartname")
);

CREATE TABLE "nucleus_template_desc" (
  "tdnumber" SERIAL     NOT NULL,
  "tdname"   varchar(64) NOT NULL default '',
  "tddesc"   varchar(200) default NULL,
  PRIMARY KEY ("tdnumber")
);

CREATE UNIQUE INDEX tdname_index ON nucleus_template_desc(tdname);

CREATE TABLE "nucleus_tickets" (
  "ticket" varchar(40) NOT NULL default '',
  "ctime" timestamp with time zone     NOT NULL default CURRENT_TIMESTAMP,
  "member" integer     NOT NULL default '0',
  PRIMARY KEY  ("ticket","member")
);
