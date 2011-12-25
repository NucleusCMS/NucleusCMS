<?php
// Hungarian Nucleus Language File
//
// Author: Konczér Tamás (konczer@gmail.com)
// Nucleus version: v1.0-v3.2
//

// START changed/added after 3.15 START

define('_LIST_PLUG_SUBS_NEEDUPDATE','Kérlek használd a \'Csatolási lista frissítése\'-gomot a plugin(ok) csatolási listájának frissítésére.');
define('_LIST_PLUGS_DEP',			'Szükséges plugin(ok):');

// END changed/added after 3.15

// START changed/added after 3.1 START

// comments list per weblog
define('_COMMENTS_BLOG',			'Összes hozzászólás a bloghoz');
define('_NOCOMMENTS_BLOG',			'Nem volt hozzászólás ehhez a bloghoz.');
define('_BLOGLIST_COMMENTS',		'Hozzászólások');
define('_BLOGLIST_TT_COMMENTS',		'Lista az összes ehhez a bloghoz tartozó hozzászólásról');


// for use in archivetype-skinvar
define('_ARCHIVETYPE_DAY',			'nap');
define('_ARCHIVETYPE_MONTH',		'hónap');

// tickets (prevents malicious users to trick an admin to perform actions he doesn't want)
define('_ERROR_BADTICKET',			'Hamis vagy lejárt címke.');

// plugin dependency
define('_ERROR_INSREQPLUGIN',		'Plugin installáció sikertelen, szükséges: ');
define('_ERROR_DELREQPLUGIN',		'Plugin törlése sikertelen, szükséges: ');

// cookie prefix
define('_SETTINGS_COOKIEPREFIX',	'Süti elõtag');

// account activation
define('_ERROR_NOLOGON_NOACTIVATE',	'Nem lejet aktivációs linket küldeni. Nem vagy jogosult a belépésre.');
define('_ERROR_ACTIVATE',			'Hiányzik/hibás/lejárt az aktivációs kulcs.');
define('_ACTIONLOG_ACTIVATIONLINK', 'Aktivációs link elküldve!');
define('_MSG_ACTIVATION_SENT',		'Az aktivációs linket elküldtük e-mailben.');

// activation link emails
define('_ACTIVATE_REGISTER_MAIL',	"Üdv <%memberName%>,\n\nAktiválnod kell a hozzáférésedet a <%siteName%> (<%siteUrl%>) honlapon.\nEzt az alábbi link segítségével teheted meg: \n\n\t<%activationUrl%>\n\n2 napod van erre a mûveletre, utána az aktivációs link lejár.");
define('_ACTIVATE_REGISTER_MAILTITLE',	"Aktiváld a '<%memberName%>' hozzáférésedet!");
define('_ACTIVATE_REGISTER_TITLE',	'Üdv <%memberName%>');
define('_ACTIVATE_REGISTER_TEXT',	'Már majdnem kész vagy. Kérlek, válassz jelszót a hozzáférésedhez!');
define('_ACTIVATE_FORGOT_MAIL',		"Üdv <%memberName%>,\n\nAz alábbi link segítségével új jelszót állíthatsz be a(z) <%siteName%> (<%siteUrl%>) weboldalon.\n\n\t<%activationUrl%>\n\n2 napod van erre a mûveletre, utána az aktivációs link lejár.");
define('_ACTIVATE_FORGOT_MAILTITLE',"'<%memberName%>' hozzáférésének újraaktiválása");
define('_ACTIVATE_FORGOT_TITLE',	'Üdv <%memberName%>');
define('_ACTIVATE_FORGOT_TEXT',		'Az új jelszavad:');
define('_ACTIVATE_CHANGE_MAIL',		"Üdv <%memberName%>,\n\nAz e-mail címed megváltozása miatt a hozzáférésed újraaktiválása szükséges a <%siteName%> (<%siteUrl%>) honlapon.\nEzt az alábbi link segítségével teheted meg: \n\n\t<%activationUrl%>\n\n2 napod van erre a mûveletre, utána az aktivációs link lejár.");
define('_ACTIVATE_CHANGE_MAILTITLE',"A hozzáférésed aktiválása '<%memberName%>' account");
define('_ACTIVATE_CHANGE_TITLE',	'Üdv <%memberName%>');
define('_ACTIVATE_CHANGE_TEXT',		'A címed változása ellenõrizve. Köszönjük!');
define('_ACTIVATE_SUCCESS_TITLE',	'Sikeres aktiválás!');
define('_ACTIVATE_SUCCESS_TEXT',	'A hozzáférésedet sikeresen aktiváltuk.!');
define('_MEMBERS_SETPWD',			'Jelszó beállítása');
define('_MEMBERS_SETPWD_BTN',		'Jelszó beállítása');
define('_QMENU_ACTIVATE',			'Hozzáférés aktiváció');
define('_QMENU_ACTIVATE_TEXT',		'<p>A hozzáférésed aktiválása után be tudsz jelentkezni <a href="index.php?action=showlogin">itt</a>.</p>');

define('_PLUGS_BTN_UPDATE',			'Csatolási lista frissítése');

// global settings
define('_SETTINGS_JSTOOLBAR',		'Javascript eszköztár');
define('_SETTINGS_JSTOOLBAR_FULL',	'Teljes eszköztár (Internet Explorer)');
define('_SETTINGS_JSTOOLBAR_SIMPLE','Egyszerû eszköztár (nem Internet Explorer)');
define('_SETTINGS_JSTOOLBAR_NONE',	'Eszköztár letiltása');
define('_SETTINGS_URLMODE_HELP',	'(Információ: <a href="documentation/tips.html#searchengines-fancyurls">kedvenc URL-ek aktiválálása</a>)');

// extra plugin settings part when editing categories/members/blogs/...
define('_PLUGINS_EXTRA',			'Extra plugin beállítások');

// itemlist info column keys
define('_LIST_ITEM_BLOG',			'blog:');
define('_LIST_ITEM_CAT',			'kategória:');
define('_LIST_ITEM_AUTHOR',			'szerzõ:');
define('_LIST_ITEM_DATE',			'dátum:');
define('_LIST_ITEM_TIME',			'idõ:');

// indication of registered members in comments list
define('_LIST_COMMENTS_MEMBER', 	'(tag)');

// batch operations
define('_BATCH_WITH_SEL',			'A kijelöltekkel:');
define('_BATCH_EXEC',				'végrehajt');

// quickmenu
define('_QMENU_HOME',				'Fõoldal');
define('_QMENU_ADD',				'Elem hozzáadása');
define('_QMENU_ADD_SELECT',			'-- válassz --');
define('_QMENU_USER_SETTINGS',		'Beállítások');
define('_QMENU_USER_ITEMS',			'Elemek');
define('_QMENU_USER_COMMENTS',		'Megjegyzések');
define('_QMENU_MANAGE',				'Menedzsment');
define('_QMENU_MANAGE_LOG',			'Eseménynapló');
define('_QMENU_MANAGE_SETTINGS',	'Globális beállítások');
define('_QMENU_MANAGE_MEMBERS',		'Tagok');
define('_QMENU_MANAGE_NEWBLOG',		'Új blog');
define('_QMENU_MANAGE_BACKUPS',		'Backups');
define('_QMENU_MANAGE_PLUGINS',		'Pluginok');
define('_QMENU_LAYOUT',				'Layout');
define('_QMENU_LAYOUT_SKINS',		'Bõrök');
define('_QMENU_LAYOUT_TEMPL',		'Sablonok');
define('_QMENU_LAYOUT_IEXPORT',		'Importálás/Exportálás');
define('_QMENU_PLUGINS',			'Pluginok');

// quickmenu on logon screen
define('_QMENU_INTRO',				'Bemutatkozás');
define('_QMENU_INTRO_TEXT',			'<p>Ez a Nucleus CMS belépési oldala.</p><p>Ha van hozzáférésed, itt be tudsz lépni, hogy hozzászólásokat tudj írni.</p>');

// helppages for plugins
define('_ERROR_PLUGNOHELPFILE',		'Nem található segítség fájl ehhez pluginhoz');
define('_PLUGS_HELP_TITLE',			'Segítség a  pluginokhoz');
define('_LIST_PLUGS_HELP', 			'Segítség');


// END changed/started after 3.1

// START changed/added after v2.5beta START

// general settings (security)
define('_SETTINGS_EXTAUTH',			'Külsõ hitelesítés engedélyezése');
define('_WARNING_EXTAUTH',			'Vigyázat: engedélyezés csak ha szükséges.');

// member profile
define('_MEMBERS_BYPASS',			'Külsõ hitelesítés használata');

// 'always include in search' blog setting (yes/no) [in v2.5beta, the 'always' part wasn't clear]
define('_EBLOG_SEARCH',				'<em>Mindig</em> tartalmazza a keresésnél');

// END changed/added after v2.5beta

// START introduced after v2.0 START

// media library
define('_MEDIA_VIEW',				'Nézet');
define('_MEDIA_VIEW_TT',			'Fájl nézõ (új ablakban)');
define('_MEDIA_FILTER_APPLY',		'Szûrõ engedélyezése');
define('_MEDIA_FILTER_LABEL',		'Szûrõ:');
define('_MEDIA_UPLOAD_TO',			'Feltölt...');
define('_MEDIA_UPLOAD_NEW',			'Új fájl feltöltése...');
define('_MEDIA_COLLECTION_SELECT',	'Választ');
define('_MEDIA_COLLECTION_TT',		'Kategória áltás');
define('_MEDIA_COLLECTION_LABEL',	'Jelenlegi kollekció:');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'Balra igazítás');
define('_ADD_ALIGNRIGHT_TT',		'Jobbra igazítás');
define('_ADD_ALIGNCENTER_TT',		'Középre igazítás');


// generic upload failure
define('_ERROR_UPLOADFAILED',		'Hibás feltöltés!');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'Régebbi idõpont engedélyezése cikkek jóváhagyásakor/írásakor');
define('_ADD_CHANGEDATE',			'Keletbélyegzõ frissítése');
define('_BMLET_CHANGEDATE',			'Keletbélyegzõ frissítése');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'Bõr import/export...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Normál');
define('_PARSER_INCMODE_SKINDIR',	'Bõr könyvtár');
define('_SKIN_INCLUDE_MODE',		'Mód');
define('_SKIN_INCLUDE_PREFIX',		'Prefix');

// global settings
define('_SETTINGS_BASESKIN',		'Alap bõr');
define('_SETTINGS_SKINSURL',		'Bõrök URL-jei');
define('_SETTINGS_ACTIONSURL',		'Teljes URL az action.php-hez');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'Az alap kategóriát nem lehet mozgatni.');
define('_ERROR_MOVETOSELF',			'A kategóriát nem lehet mozgatni (cél blog ugyanaz, mint a forrás blog.)');
define('_MOVECAT_TITLE',			'Blog kiválasztása kategóriába való áthelyezéshez');
define('_MOVECAT_BTN',				'Kategória áthelyezése');

// URLMode setting
define('_SETTINGS_URLMODE',			'URL Mód');
define('_SETTINGS_URLMODE_NORMAL',	'Normál');
define('_SETTINGS_URLMODE_PATHINFO','Díszes');

// Batch operations
define('_BATCH_NOSELECTION',		'Nincs semmi kiválasztva a tevékenység végrehajtásához!');
define('_BATCH_ITEMS',				'Kötegelt operáció az elemeken.');
define('_BATCH_CATEGORIES',			'Kötegelt operáció a kategóriákon.');
define('_BATCH_MEMBERS',			'Kötegelt operáció a tagokon.');
define('_BATCH_TEAM',				'Kötegelt operáció a csapat tagjain.');
define('_BATCH_COMMENTS',			'Kötegelt operáció a megjegyzéseken.');
define('_BATCH_UNKNOWN',			'Ismeretlen kötegelt mûvelet:');
define('_BATCH_EXECUTING',			'Végrehajtás');
define('_BATCH_ONCATEGORY',			'a kategórián');
define('_BATCH_ONITEM',				'az elemen');
define('_BATCH_ONCOMMENT',			'a megjegyzésen');
define('_BATCH_ONMEMBER',			'tagon');
define('_BATCH_ONTEAM',				'csapattagon');
define('_BATCH_SUCCESS',			'Siker!');
define('_BATCH_DONE',				'Kész!');
define('_BATCH_DELETE_CONFIRM',		'Kötegelt opráció törlésének megerõsítése');
define('_BATCH_DELETE_CONFIRM_BTN',	'Kötegelt opráció törlésének megerõsítése');
define('_BATCH_SELECTALL',			'Mindent kiválaszt');
define('_BATCH_DESELECTALL',		'Vissza');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'Töröl');
define('_BATCH_ITEM_MOVE',			'Mozgat');
define('_BATCH_MEMBER_DELETE',		'Töröl');
define('_BATCH_MEMBER_SET_ADM',		'Admin jogok adása');
define('_BATCH_MEMBER_UNSET_ADM',	'Admin jogok elvétele');
define('_BATCH_TEAM_DELETE',		'Törlés a csapatból');
define('_BATCH_TEAM_SET_ADM',		'Admin jogok adása');
define('_BATCH_TEAM_UNSET_ADM',		'Admin jogok elvétele');
define('_BATCH_CAT_DELETE',			'Töröl');
define('_BATCH_CAT_MOVE',			'Másik blogba való mozgatás');
define('_BATCH_COMMENT_DELETE',		'Töröl');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'Új elem adása...');
define('_ADD_PLUGIN_EXTRAS',		'Extra kiegészítõ opciók');

// errors
define('_ERROR_CATCREATEFAIL',		'Nem lehetséges új kategória készítése!');
define('_ERROR_NUCLEUSVERSIONREQ',	'Ehhez a kiegészítõhöz újabb Nucleus verzióra van szükség:');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Vissza a blogbeállításokhoz');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Import');
define('_SKINIE_TITLE_EXPORT',		'Export');
define('_SKINIE_BTN_IMPORT',		'Import');
define('_SKINIE_BTN_EXPORT',		'Kiválasztott bõr(ök) exportálása');
define('_SKINIE_LOCAL',				'Helyi fájl importálása:');
define('_SKINIE_NOCANDIDATES',		'A skins könyvtár üres!');
define('_SKINIE_FROMURL',			'Importálás URL-bõl:');
define('_SKINIE_EXPORT_INTRO',		'Válaszd ki a bõröket és sablonokat, amiket exportálni szeretnél.');
define('_SKINIE_EXPORT_SKINS',		'Bõrök');
define('_SKINIE_EXPORT_TEMPLATES',	'Sablonok');
define('_SKINIE_EXPORT_EXTRA',		'Extra információ');
define('_SKINIE_CONFIRM_OVERWRITE',	'Létezõ bõrök felülírása (lásd. névegyezések!)');
define('_SKINIE_CONFIRM_IMPORT',	'Igen, importálni akarom!');
define('_SKINIE_CONFIRM_TITLE',		'Információk bõrök és sablonok importálásáról');
define('_SKINIE_INFO_SKINS',		'Bõrök fájlban:');
define('_SKINIE_INFO_TEMPLATES',	'Sablonok fájlban:');
define('_SKINIE_INFO_GENERAL',		'Információ:');
define('_SKINIE_INFO_SKINCLASH',	'Bõrök neveinek egyezése:');
define('_SKINIE_INFO_TEMPLCLASH',	'Sablokon neveinek egyezése:');
define('_SKINIE_INFO_IMPORTEDSKINS','Importált bõrök:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Importált sablonok:');
define('_SKINIE_DONE',				'Importálás kész.');

define('_AND',						'és');
define('_OR',						'vagy');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'üres mezõ (kattints ide a szerkesztéshez)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'Mód szerint:');
define('_LIST_SKINS_INCPREFIX',		'Prefixek szerint:');
define('_LIST_SKINS_DEFINED',		'Definiált részek:');

// backup
define('_BACKUPS_TITLE',			'Biztonsági mentés / Visszaállítás');
define('_BACKUP_TITLE',				'Biztonsági mentés');
define('_BACKUP_INTRO',				'Az adatbázis biztonsági mentéséhez kattints a gombra. (Tárold biztonságos helyen.)');
define('_BACKUP_ZIP_YES',			'Tömörítés használata');
define('_BACKUP_ZIP_NO',			'Nincs tömörítés');
define('_BACKUP_BTN',				'Biztonsági mentés készítése');
define('_BACKUP_NOTE',				'<b>FONTOS:</b> Csak az adatbázis tartalma mentõdik. A média fájlok és a config.php beállításai így <b>NEM</b> mentõdnek el.');
define('_RESTORE_TITLE',			'Visszaállítás');
define('_RESTORE_NOTE',				'<b>FIGYELMEZTETÉS:</b> A biztonsági mentésbõl való visszaállítás <b>TÖRÖL</b> minden aktuális Nucleus adatot az adatbázisból! Csak akkor tedd ezt, ha biztos vag a dolgodban!<br/>	<b>Fontos:</b> Legyél biztos benne, hogy a Nucleus verzió, amibõl a biztonsági mentést készítetted, megegyezik azzal a Nucleus verzióval, amit jelenleg futtatsz. Ha nem így van, ne használd ezt a funkciót.');
define('_RESTORE_INTRO',			'Válaszd ki a biztosnági mentés fájlt (ami fel lesz töltve a szerverre) és kattints a "Visszaállítás" gombra.');
define('_RESTORE_IMSURE',			'Igen, biztosan ezt akarom tenni!');
define('_RESTORE_BTN',				'Visszaállítás fájlból.');
define('_RESTORE_WARNING',			'(legyél biztos benne, hogy a megfelelõ biztonsági mentés fájl áll a rendelkezésedre)');
define('_ERROR_BACKUP_NOTSURE',		'Be kell jelölnöd a \'biztos vagyok benne\' rubrikát.');
define('_RESTORE_COMPLETE',			'Visszaállítás kész!');

// new item notification
define('_NOTIFY_NI_MSG',			'Új elem lett postázva:');
define('_NOTIFY_NI_TITLE',			'Új elem!');
define('_NOTIFY_KV_MSG',			'Karma szavazat az elemre:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'Megjegyzés az elemre vonatkoztatva:');
define('_NOTIFY_NC_TITLE',			'Nucleus megjegyzés:');
define('_NOTIFY_USERID',			'Felhasználói azonosító:');
define('_NOTIFY_USER',				'Felhasználó:');
define('_NOTIFY_COMMENT',			'Megjegyzés:');
define('_NOTIFY_VOTE',				'Szavazat:');
define('_NOTIFY_HOST',				'Host:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'Tag:');
define('_NOTIFY_TITLE',				'Cím:');
define('_NOTIFY_CONTENTS',			'Tartalom:');

// member mail message
define('_MMAIL_MSG',				'Az üzenet küldte:');
define('_MMAIL_FROMANON',			'ismeretelen látogató');
define('_MMAIL_FROMNUC',			'Küldve a Nucleus weblogból');
define('_MMAIL_TITLE',				'Az üzenet küldve:');
define('_MMAIL_MAIL',				'Üzenet:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'Új elem hozzáadása');
define('_BMLET_EDIT',				'Elem szerkesztése');
define('_BMLET_DELETE',				'Elem törlése');
define('_BMLET_BODY',				'Test');
define('_BMLET_MORE',				'Kiterjesztett');
define('_BMLET_OPTIONS',			'Opciók');
define('_BMLET_PREVIEW',			'Elõnézet');

// used in bookmarklet
define('_ITEM_UPDATED',				'Elem frissítve!');
define('_ITEM_DELETED',				'Elem törölve!');

// plugins
define('_CONFIRMTXT_PLUGIN',		'Biztos, hogy törölni akarod a kiegészítõt?');
define('_ERROR_NOSUCHPLUGIN',		'Nincs ilyen kiegészítõ.');
define('_ERROR_DUPPLUGIN',			'Sajnálom, ez a plugin már installálva van.');
define('_ERROR_PLUGFILEERROR',		'Nem létezõ kiegészítõ vagy a jogosultság rosszul van beállítva.');
define('_PLUGS_NOCANDIDATES',		'Nem találtam kiegészítõket');

define('_PLUGS_TITLE_MANAGE',		'Pluginok menedzselése');
define('_PLUGS_TITLE_INSTALLED',	'Aktuálisan installált');
define('_PLUGS_TITLE_UPDATE',		'Csatolási lista frissítése');
define('_PLUGS_TEXT_UPDATE',		'A Nucleus a gyorsítótárban hagyja a kiegészítõk beállításait. Amikor upgrade-elsz egy kiegészítõt, azzal, hogy felülírod a fájlt, végre kell hajtanod ezt a frissítést, hogy meggyõzõdhess róla: a beállítások helyesen kerültek a gyorsítótárba.');
define('_PLUGS_TITLE_NEW',			'Új kiegészítõ installálása');
define('_PLUGS_ADD_TEXT',			'Az alábbi listában mindazon kiegészítõk szerepelnek, melyek nincsenek installálva. Legyél biztos benne <strong>- egészen biztos -</strong>, hogy amit hozzá akarsz adni a rendszerhez, valóban egy kiegészítõ.');
define('_PLUGS_BTN_INSTALL',		'Plugin installálása');
define('_BACKTOOVERVIEW',			'Vissza az áttekintéshez');

// editlink
define('_TEMPLATE_EDITLINK',		'Elem linkjének szerkesztése');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'Hozzáad a bal oldalhoz');
define('_ADD_RIGHT_TT',				'Hozzáad a jobb oldalhoz');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'Új kategória...');

// new settings
define('_SETTINGS_PLUGINURL',		'Kiegészítõ URL');
define('_SETTINGS_MAXUPLOADSIZE',	'Maximum feltölthetõ fájlméret (byte-ban)');
define('_SETTINGS_NONMEMBERMSGS',	'Üzenetek küldésének engedélyezése a látogatóknak is.');
define('_SETTINGS_PROTECTMEMNAMES',	'Tagok neveinek védelme');

// overview screen
define('_OVERVIEW_PLUGINS',			'Pluginok menedzselése...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'Új tag regisztrálása:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'Email:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'Nem rendelkezel adminisztrátori joggal a blogokat illetõen, ennélfogva nincs engedélyed fájlok feltöltésére ennek a tagnak a média könyvtárába');

// plugin list
define('_LISTS_INFO',				'Információ');
define('_LIST_PLUGS_AUTHOR',		'Küldte:');
define('_LIST_PLUGS_VER',			'Verzió:');
define('_LIST_PLUGS_SITE',			'Oldal meglátogatása.');
define('_LIST_PLUGS_DESC',			'Leírás:');
define('_LIST_PLUGS_SUBS',			'A következõk jóváhagyása:');
define('_LIST_PLUGS_UP',			'Mozgatás fel');
define('_LIST_PLUGS_DOWN',			'Mozgatás le');
define('_LIST_PLUGS_UNINSTALL',		'uninstallálás');
define('_LIST_PLUGS_ADMIN',			'admin');
define('_LIST_PLUGS_OPTIONS',		'szerkeszt&nbsp;opciók');

// plugin option list
define('_LISTS_VALUE',				'Érték');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'Ez a kiegészítõ nem rendelkezik semmilyen beállítással');
define('_PLUGS_BACK',				'Vissza a kiegészítõk beállításihoz');
define('_PLUGS_SAVE',				'Opciók mentése');
define('_PLUGS_OPTIONS_UPDATED',	'A kiegészítõk opciói frissültek!');

define('_OVERVIEW_MANAGEMENT',		'Menedzselés');
define('_OVERVIEW_MANAGE',			'Nucleus menedzselése...');
define('_MANAGE_GENERAL',			'Általános beállítások');
define('_MANAGE_SKINS',				'Bõrök és sablonok');
define('_MANAGE_EXTRA',				'Extra tulajdonságok');

define('_BACKTOMANAGE',				'Vissza a Nucleus menedzseléséhez');


// END introduced after v1.1 END




// charset to use 
define('_CHARSET',					'iso-8859-2');

// global stuff
define('_LOGOUT',					'Kilépés');
define('_LOGIN',					'Belépés');
define('_YES',						'Igen');
define('_NO',						'Nem');
define('_SUBMIT',					'Küld');
define('_ERROR',					'Hiba');
define('_ERRORMSG',					'Hiba történt!');
define('_BACK',						'Vissza');
define('_NOTLOGGEDIN',				'Nem vagy bejelentkezve');
define('_LOGGEDINAS',				'Bejelentkezve, mint');
define('_ADMINHOME',				'Admin fõoldal');
define('_NAME',						'Név');
define('_BACKHOME',					'Vissza az adminisztrációs fõoldalra');
define('_BADACTION',				'Nem létezõ feladat végrehajtását kérted.');
define('_MESSAGE',					'Üzenet');
define('_HELP_TT',					'Segítség!');
define('_YOURSITE',					'Oldalad');


define('_POPUP_CLOSE',				'Bezár');

define('_LOGIN_PLEASE',				'Elõször be kell jelentkezned!');

// commentform
define('_COMMENTFORM_YOUARE',		'Te vagy');
define('_COMMENTFORM_SUBMIT',		'Megjegyzés írása');
define('_COMMENTFORM_COMMENT',		'Üzeneted');
define('_COMMENTFORM_NAME',			'Neved');
define('_COMMENTFORM_MAIL',			'E-mail/HTTP');
define('_COMMENTFORM_REMEMBER',		'Megjegyez');

// loginform
define('_LOGINFORM_NAME',			'Felhasználóneved:');
define('_LOGINFORM_PWD',			'Jelszavad:');
define('_LOGINFORM_YOUARE',			'Bejelentkezve, mint');
define('_LOGINFORM_SHARED',			'Megosztott számítógép');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'Üzenetküldés');

// search form
define('_SEARCHFORM_SUBMIT',		'Keresés');

// add item form
define('_ADD_ADDTO',				'Új elem hozzáadása');
define('_ADD_CREATENEW',			'Új elem létrehozása');
define('_ADD_BODY',					'Test');
define('_ADD_TITLE',				'Cím');
define('_ADD_MORE',					'Kiterjesztett (opcionális)');
define('_ADD_CATEGORY',				'Kategória');
define('_ADD_PREVIEW',				'Elõnézet');
define('_ADD_DISABLE_COMMENTS',		'Megjegyzések tiltása');
define('_ADD_DRAFTNFUTURE',			'Piszkozat &amp; Jövõbeni elemek');
define('_ADD_ADDITEM',				'Elem hozzáadása');
define('_ADD_ADDNOW',				'Hozzáadás azonnal');
define('_ADD_ADDLATER',				'Hozzáadás késõbb');
define('_ADD_PLACE_ON',				'Place on');
define('_ADD_ADDDRAFT',				'Hozzáadás a piszkozathoz');
define('_ADD_NOPASTDATES',			'(A régebbi dátum és idõ NEM érvényes, így ebben az esetben a mostani idõ lesz)');
define('_ADD_BOLD_TT',				'félkövér');
define('_ADD_ITALIC_TT',			'dõlt');
define('_ADD_HREF_TT',				'Linket készít');
define('_ADD_MEDIA_TT',				'Média hozzáadása');
define('_ADD_PREVIEW_TT',			'Mutatja/elrejti az elõnézetet');
define('_ADD_CUT_TT',				'Kivág');
define('_ADD_COPY_TT',				'Másol');
define('_ADD_PASTE_TT',				'Beilleszt');


// edit item form
define('_EDIT_ITEM',				'Elem szerkesztése');
define('_EDIT_SUBMIT',				'Elem szerkesztése');
define('_EDIT_ORIG_AUTHOR',			'Eredeti szerzõ');
define('_EDIT_BACKTODRAFTS',		'Hozzáadja a piszkozatokhoz');
define('_EDIT_COMMENTSNOTE',		'(megjegyzés: a megjegyzések tiltásakor a régebbi megjegyzések ugyanúgy kint maradnak)');

// used on delete screens
define('_DELETE_CONFIRM',			'Erõsítsd meg a törlési mûveletet.');
define('_DELETE_CONFIRM_BTN',		'Erõsítsd meg a törlési mûveletet.');
define('_CONFIRMTXT_ITEM',			'A következõnél tartasz: az alábbi elem törlése:');
define('_CONFIRMTXT_COMMENT',		'A következõnél tartasz: a alábbi megjegyzés törlése:');
define('_CONFIRMTXT_TEAM1',			'A következõnél tartasz: törlés');
define('_CONFIRMTXT_TEAM2',			' a teamlista blogjából.');
define('_CONFIRMTXT_BLOG',			'A blog, amit készülsz, hogy törölj: ');
define('_WARNINGTXT_BLOGDEL',		'Vigyázat! A blog törlésekor a blognak minden elemét és az összes megjegyzést törölni fogod. Kérlek erõsítsd meg a törlési kérelmet<br/>Ne kapcsold ki a Nucleust a törlési folyamat közben.');
define('_CONFIRMTXT_MEMBER',		'A következõnél tartasz: a alábbi tag profiljának törlése: ');
define('_CONFIRMTXT_TEMPLATE',		'A következõnél tartasz: a alábbi sablon törlése: ');
define('_CONFIRMTXT_SKIN',			'A következõnél tartasz: a alábbi bõr törlése: ');
define('_CONFIRMTXT_BAN',			'A következõnél tartasz: a alábbi IP bannolása ebbebn a tartománybban:');
define('_CONFIRMTXT_CATEGORY',		'A következõnél tartasz: kategória törlése: ');

// some status messages
define('_DELETED_ITEM',				'Elem törölve!');
define('_DELETED_MEMBER',			'Tag törölve!');
define('_DELETED_COMMENT',			'Megjegyzés törölve!');
define('_DELETED_BLOG',				'Blog törölve!');
define('_DELETED_CATEGORY',			'Kategória törölve!');
define('_ITEM_MOVED',				'Elem áthelyezve!');
define('_ITEM_ADDED',				'Elem hozzáadva!');
define('_COMMENT_UPDATED',			'Megjegyzés frissítve!');
define('_SKIN_UPDATED',				'A bõr adatai elmentve.');
define('_TEMPLATE_UPDATED',			'A sablon adatai elmentve.');

// errors
define('_ERROR_COMMENT_LONGWORD',	'Kérlek, ne használj 90 karakternél hosszabb szavakat megjegyzés írásánál.');
define('_ERROR_COMMENT_NOCOMMENT',	'Kérlek, írj megjegyzést');
define('_ERROR_COMMENT_NOUSERNAME',	'Rossz felhasználónév');
define('_ERROR_COMMENT_TOOLONG',	'A megjegyzésed túl hosszú (max. 5000 karakter lehet)');
define('_ERROR_COMMENTS_DISABLED',	'Ehhez a bloghoz nem lehetséges megjegyzést írni.');
define('_ERROR_COMMENTS_NONPUBLIC',	'Tagként kell belépned ahhoz, hogy megjegyzést írhass ehhez a bloghoz.');
define('_ERROR_COMMENTS_MEMBERNICK','A nevet, amit használni szeretnél, már használja valaki. Kérlek, válassz másikat.');
define('_ERROR_SKIN',				'Bõr hiba!');
define('_ERROR_ITEMCLOSED',			'Az elem zárva van, ne mlehetséges új megjegyzés írása és szavazás');
define('_ERROR_NOSUCHITEM',			'Nem létezik ilyen elem!');
define('_ERROR_NOSUCHBLOG',			'Nem létezik ilyen blog');
define('_ERROR_NOSUCHSKIN',			'Nem létezik ilyen bõr');
define('_ERROR_NOSUCHMEMBER',		'Nem létezik ilyen tag');
define('_ERROR_NOTONTEAM',			'Nem vagy a csapattag, ehhez a bloghoz.');
define('_ERROR_BADDESTBLOG',		'Cél blog nem létezik!');
define('_ERROR_NOTONDESTTEAM',		'Mivel nem vagy a cél blog csapat tagja, nem mozgathatod ezt az elemet.');
define('_ERROR_NOEMPTYITEMS',		'Üres elem hozzáadása nem lehetséges!');
define('_ERROR_BADMAILADDRESS',		'Az email cím nem érvényes.');
define('_ERROR_BADNOTIFY',			'Egy vagy több megadott kapcsolattartó email cím nem érvényes');
define('_ERROR_BADNAME',			'Érvénytelen név. (a-z és 0-9, az elején és végén nem lehet szóköz)');
define('_ERROR_NICKNAMEINUSE',		'Ez a név már foglalt.');
define('_ERROR_PASSWORDMISMATCH',	'A jelszavaknak egyezniük kell.');
define('_ERROR_PASSWORDTOOSHORT',	'A jelszónak legaláb 6 karakterbõl kell állnia');
define('_ERROR_PASSWORDMISSING',	'Nem lehet üres a jelszó mezõ');
define('_ERROR_REALNAMEMISSING',	'Valódi nevet kell beírnod.');
define('_ERROR_ATLEASTONEADMIN',	'Legalább egy szuper-adminnak lennie kell.');
define('_ERROR_ATLEASTONEBLOGADMIN','Ezzel a mûvelettel jár, hogy a bloghoz nem lehet hozzáférni késõbb, ezért legyél biztos benne, hogy van adminisztráora az oldalnak.');
define('_ERROR_ALREADYONTEAM',		'Nem adhatsz hozzá olyan tagot, aki már tagj a csapatnak!');
define('_ERROR_BADSHORTBLOGNAME',	'A blog rövid neve a-z és 0-9 lehet szóköz nélkül.');
define('_ERROR_DUPSHORTBLOGNAME',	'Egy másik blog rövid neve ugyanez.');
define('_ERROR_UPDATEFILE',			'Nem lehet írni az update fájlba. Legyél biztos benne, hogy az attribútumok jól vannak beálítva a fájlokon (666). Másrészt a hely relatív az admin könyvtárhoz. abszolút útvonalat adj meg (valahogy így /te/útvonalad/nucleus/)');
define('_ERROR_DELDEFBLOG',			'Az alap blog nem törölhetõ!');
define('_ERROR_DELETEMEMBER',		'Ez a tag nem törölhetõ, lehet, hogy azért, mivel õ a szerzõje ennek az megjegyzésnek');
define('_ERROR_BADTEMPLATENAME',	'Helytelen sablon elnevezés (a-z és 0-9 lehet, szóközök nélkül)');
define('_ERROR_DUPTEMPLATENAME',	'Egy másik sablon már létezik ezzel a névvel.');
define('_ERROR_BADSKINNAME',		'Helytelen bõr elnevezés (a-z és 0-9 lehet, szóközök nélkül)');
define('_ERROR_DUPSKINNAME',		'Egy másik bõr már létezik ezzel a névvel.');
define('_ERROR_DEFAULTSKIN',		'Egy bõrnek mindig "default" elnevezésûnek kell lennie!');
define('_ERROR_SKINDEFDELETE',		'Nem lehet a bõrt törölni, amíg az alap bõr az alábbi bloghoz: ');
define('_ERROR_DISALLOWED',			'Sajnálom, nem hajthatod végre ezt a mûveletet.');
define('_ERROR_DELETEBAN',			'Hiba a ban törlése közben (nem létezõ ban)');
define('_ERROR_ADDBAN',				'Hiba ban hozzáadása közben. Lehet, hogy a ban nem lett korrektül hozzáadva valamelyik bloghoz.');
define('_ERROR_BADACTION',			'A szükséges mûvelet nem létezik.');
define('_ERROR_MEMBERMAILDISABLED',	'Tag a taghoz email üzenet tiltott');
define('_ERROR_MEMBERCREATEDISABLED','Tag létrehozása tiltva');
define('_ERROR_INCORRECTEMAIL',		'Helytelen email cím');
define('_ERROR_VOTEDBEFORE',		'Már szavaztál!');
define('_ERROR_BANNED1',			'Nem végrehajtható a mûvelet, amíg az alábbi IP tartományból jössz: ');
define('_ERROR_BANNED2',			' . Az üzenet a következõ: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'Be kell jelentkezned a mûvelet végrehajtásához.');
define('_ERROR_CONNECT',			'Kapcsolódási hiba');
define('_ERROR_FILE_TOO_BIG',		'Túl nagy fájl!');
define('_ERROR_BADFILETYPE',		'Sajnálom, ez a fájltípus nem megengedett!');
define('_ERROR_BADREQUEST',			'Hibás feltöltés kérés!');
define('_ERROR_DISALLOWEDUPLOAD',	'Egyik blog csapatlistájában sem szerepelsz. Ezért nem tölthetsz fel fájlokat.');
define('_ERROR_BADPERMISSIONS',		'A fájl/könyvtár jogok rosszul vannak beálítva.');
define('_ERROR_UPLOADMOVEP',		'Hiba a feltöltött fájl mozgatása közben.');
define('_ERROR_UPLOADCOPY',			'Hiba fájl másolásakor.');
define('_ERROR_UPLOADDUPLICATE',	'Egy fájl már létezik ezzel a névvel. Nevezd át, és úgy próbálkozz a feltöltéssel.');
define('_ERROR_LOGINDISALLOWED',	'Sajnálom, nem engedélyezett az adminisztrációs területre való belépés. Jelentkezz be felhasználóként.');
define('_ERROR_DBCONNECT',			'Nem tudok kapcsolódni a mySQL szerverhez.');
define('_ERROR_DBSELECT',			'Nem látom a nucleus adatbázisát.');
define('_ERROR_NOSUCHLANGUAGE',		'Nem létezõ nelvi fájl!');
define('_ERROR_NOSUCHCATEGORY',		'Nem létezõ kategória!');
define('_ERROR_DELETELASTCATEGORY',	'Egy kategóriának léteznie kell!');
define('_ERROR_DELETEDEFCATEGORY',	'Az alap kategóriát nem lehet törölni!');
define('_ERROR_BADCATEGORYNAME',	'Rossz kategória név!');
define('_ERROR_DUPCATEGORYNAME',	'Egy másik kategória ezzel a névvel már létezik!');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'Figyelmeztetés: az aktuális érték nem könyvtár!');
define('_WARNING_NOTREADABLE',		'Figyelmeztetés: az aktuális érték nem olvasható könyvtár!');
define('_WARNING_NOTWRITABLE',		'Figyelmeztetés: az aktuális érték nem írható könyvtár!');

// media and upload
define('_MEDIA_UPLOADLINK',			'Új fájl feltöltése');
define('_MEDIA_MODIFIED',			'módosítva');
define('_MEDIA_FILENAME',			'fájlnév');
define('_MEDIA_DIMENSIONS',			'méret');
define('_MEDIA_INLINE',				'sor');
define('_MEDIA_POPUP',				'elõugró');
define('_UPLOAD_TITLE',				'Válassz fájlt!');
define('_UPLOAD_MSG',				'Válaszd ki a feltölteni kívánt fájlt és kattints a \'feltöltés\' gombra.');
define('_UPLOAD_BUTTON',			'Feltöltés');

// some status messages
define('_MSG_ACCOUNTCREATED',		'Felhasználói fiókod létrehozva. A jelszavadat emailben küldjük.');
define('_MSG_PASSWORDSENT',			'Jelszó elküldve! (emailben)');
define('_MSG_LOGINAGAIN',			'Mégegyszer be kell jelentkezned, mert megváltoztak az adataid.');
define('_MSG_SETTINGSCHANGED',		'Beálítások megváltoztatva.');
define('_MSG_ADMINCHANGED',			'Admin megváltoztatva.');
define('_MSG_NEWBLOG',				'Új blog létrehozva');
define('_MSG_ACTIONLOGCLEARED',		'Mûveletek log törölve.');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'Tiltott mûvelet: ');
define('_ACTIONLOG_PWDREMINDERSENT','Új jelszó elküldve: ');
define('_ACTIONLOG_TITLE',			'Mûveletek logja');
define('_ACTIONLOG_CLEAR_TITLE',	'Mûveletek logjának törlése');
define('_ACTIONLOG_CLEAR_TEXT',		'Mûveletek logjának törlése most');

// team management
define('_TEAM_TITLE',				'Csapat menedzselése a bloghoz');
define('_TEAM_CURRENT',				'Jelenlegi csapat');
define('_TEAM_ADDNEW',				'Új tag hozzáadása a csapathoz');
define('_TEAM_CHOOSEMEMBER',		'Válassz tagot');
define('_TEAM_ADMIN',				'Admin privilégiumok?');
define('_TEAM_ADD',					'Hozzáadás a csapathoz');
define('_TEAM_ADD_BTN',				'Hozzáadás a csapathoz');

// blogsettings
define('_EBLOG_TITLE',				'Blog beállítások szerkesztése');
define('_EBLOG_TEAM_TITLE',			'Csapat szerkesztése');
define('_EBLOG_TEAM_TEXT',			'Kattints ide a csapat szerkesztéséhez');
define('_EBLOG_SETTINGS_TITLE',		'Blog beállítások');
define('_EBLOG_NAME',				'Blog Név');
define('_EBLOG_SHORTNAME',			'Rövid blog név');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(a-z-ig szóköz nélkül)');
define('_EBLOG_DESC',				'Blog leírás');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'Alap bõr');
define('_EBLOG_DEFCAT',				'Alap kategória');
define('_EBLOG_LINEBREAKS',			'Sortörések konvertálása');
define('_EBLOG_DISABLECOMMENTS',	'Megengeded a megjegyzéseket?<br /><small>(A megjegyzések tiltása azt jelenti, hogy nem lehet megjegyzést adni a rendszerhez.)</small>');
define('_EBLOG_ANONYMOUS',			'Megjegyzést a látogatók is írhatnak? (nem csak a tagok)');
define('_EBLOG_NOTIFY',				'Értesítõ címek (használata; mint elválasztó)');
define('_EBLOG_NOTIFY_ON',			'Éresítés:');
define('_EBLOG_NOTIFY_COMMENT',		'Új megjegyzés');
define('_EBLOG_NOTIFY_KARMA',		'Új karma szavazat');
define('_EBLOG_NOTIFY_ITEM',		'Új blog elem');
define('_EBLOG_PING',				'Ping Weblogs.com a frissítésért?');
define('_EBLOG_MAXCOMMENTS',		'Max. mennyiség a megjegyzésekbõl!');
define('_EBLOG_UPDATE',				'Fájl frissítése');
define('_EBLOG_OFFSET',				'Idõeltolódás');
define('_EBLOG_STIME',				'Aktuális szerveridõ: ');
define('_EBLOG_BTIME',				'Aktuális blog idõ: ');
define('_EBLOG_CHANGE',				'Beállítások változtatása');
define('_EBLOG_CHANGE_BTN',			'Beállítások változtatása');
define('_EBLOG_ADMIN',				'Blog admin');
define('_EBLOG_ADMIN_MSG',			'Hozzá lettél rendelve az adminisztrátori jogokhoz!');
define('_EBLOG_CREATE_TITLE',		'Új blog létrehozása');
define('_EBLOG_CREATE_TEXT',		'Töltsd ki az alábbi mezõt új blog létrehozásához. <br /><br /> <b>Figyelem:</b> Csak a szükséges opciók vannak kilistázva. Ha extra opciókat szeretnél beállítani, kattints a blogbeállításokra a lap alján az "új blog létrehozása" alatt.');
define('_EBLOG_CREATE',				'Létrehoz!');
define('_EBLOG_CREATE_BTN',			'Blog létrehozása');
define('_EBLOG_CAT_TITLE',			'Kategóriák');
define('_EBLOG_CAT_NAME',			'Kategória név');
define('_EBLOG_CAT_DESC',			'Kategória leírása');
define('_EBLOG_CAT_CREATE',			'Új kategória létrehozása');
define('_EBLOG_CAT_UPDATE',			'Kategória frissítése');
define('_EBLOG_CAT_UPDATE_BTN',		'Kategória frissítése');

// templates
define('_TEMPLATE_TITLE',			'Sablonok szerkesztése');
define('_TEMPLATE_AVAILABLE_TITLE',	'Elérhetõ sablonok');
define('_TEMPLATE_NEW_TITLE',		'Új sablon');
define('_TEMPLATE_NAME',			'A sablon neve: ');
define('_TEMPLATE_DESC',			'Sablon leírása');
define('_TEMPLATE_CREATE',			'Sablon létrehozása');
define('_TEMPLATE_CREATE_BTN',		'Sablon létrehozása');
define('_TEMPLATE_EDIT_TITLE',		'Sablon szerkesztése');
define('_TEMPLATE_BACK',			'Vissza a sablonok beállításaihoz');
define('_TEMPLATE_EDIT_MSG',		'Nincs szükség az összes sablon részletre, hagyd üresen amire nincs szükséged.');
define('_TEMPLATE_SETTINGS',		'Sablonok beállításai');
define('_TEMPLATE_ITEMS',			'Elemek');
define('_TEMPLATE_ITEMHEADER',		'Elem fejléc');
define('_TEMPLATE_ITEMBODY',		'Elem test');
define('_TEMPLATE_ITEMFOOTER',		'elem lábléc');
define('_TEMPLATE_MORELINK',		'Kiterjesztett mód');
define('_TEMPLATE_NEW',				'Új elem indikációja');
define('_TEMPLATE_COMMENTS_ANY',	'Megjegyzések (ha van)');
define('_TEMPLATE_CHEADER',			'Megjegyzések fejléce');
define('_TEMPLATE_CBODY',			'Megjegyzések teste');
define('_TEMPLATE_CFOOTER',			'Megjegzések lábléceComments Footer');
define('_TEMPLATE_CONE',			'Egy megjegyzés');
define('_TEMPLATE_CMANY',			'Kettõ vagy (több) megjegyzés');
define('_TEMPLATE_CMORE',			'Többi megjegyzés olvasása');
define('_TEMPLATE_CMEXTRA',			'Tagok extrái');
define('_TEMPLATE_COMMENTS_NONE',	'Megjegyzések (ha nincs)');
define('_TEMPLATE_CNONE',			'Nincsenek megjegyzések.');
define('_TEMPLATE_COMMENTS_TOOMUCH','Megjegyzések (han nincs, de túl sok, hogy az összeset meg lehessen jeleníteni)');
define('_TEMPLATE_CTOOMUCH',		'Túl sok megjegyzés');
define('_TEMPLATE_ARCHIVELIST',		'Archív lista');
define('_TEMPLATE_AHEADER',			'Archív lista fejléce');
define('_TEMPLATE_AITEM',			'Archív lista eleme');
define('_TEMPLATE_AFOOTER',			'Archív lista lábléce');
define('_TEMPLATE_DATETIME',		'Dátum és idõ');
define('_TEMPLATE_DHEADER',			'Dátum fejléc');
define('_TEMPLATE_DFOOTER',			'Dátum lábléc');
define('_TEMPLATE_DFORMAT',			'Dátum formátum');
define('_TEMPLATE_TFORMAT',			'Idõ formátum');
define('_TEMPLATE_LOCALE',			'Lokális');
define('_TEMPLATE_IMAGE',			'Felbukkanó képek');
define('_TEMPLATE_PCODE',			'Felbukkanó link kód');
define('_TEMPLATE_ICODE',			'Képek sorban kód');
define('_TEMPLATE_MCODE',			'Média objektum link kódja');
define('_TEMPLATE_SEARCH',			'Keresés');
define('_TEMPLATE_SHIGHLIGHT',		'Kiemelés');
define('_TEMPLATE_SNOTFOUND',		'A keresés nem eredményezett találatot.');
define('_TEMPLATE_UPDATE',			'Frissítés');
define('_TEMPLATE_UPDATE_BTN',		'Sablonok frissítése');
define('_TEMPLATE_RESET_BTN',		'Adatok visszaállítása');
define('_TEMPLATE_CATEGORYLIST',	'Kategória lista');
define('_TEMPLATE_CATHEADER',		'Kategória lista fejléce');
define('_TEMPLATE_CATITEM',			'Kategória lista eleme');
define('_TEMPLATE_CATFOOTER',		'Kategória lista lábléce');

// skins
define('_SKIN_EDIT_TITLE',			'Bõrök szerkesztése');
define('_SKIN_AVAILABLE_TITLE',		'Elérhetõ bõrök');
define('_SKIN_NEW_TITLE',			'Új bõr');
define('_SKIN_NAME',				'Név');
define('_SKIN_DESC',				'Leírás');
define('_SKIN_TYPE',				'Tartalom típusa');
define('_SKIN_CREATE',				'Létrehozás');
define('_SKIN_CREATE_BTN',			'Bõr létrehozása');
define('_SKIN_EDITONE_TITLE',		'Bõr szerkesztése');
define('_SKIN_BACK',				'Vissza a bõrök beállításaihoz');
define('_SKIN_PARTS_TITLE',			'Bõrök részei');
define('_SKIN_PARTS_MSG',			'Nem szükséges az összs típus a bõrökhöz. Hagyd üresen, amire nincs szükséged. Válassz egy alábbi bõrtípust a szerkesztéshez:');
define('_SKIN_PART_MAIN',			'Fõoldal');
define('_SKIN_PART_ITEM',			'Elem lapok');
define('_SKIN_PART_ALIST',			'Archív lista');
define('_SKIN_PART_ARCHIVE',		'Archív');
define('_SKIN_PART_SEARCH',			'Keresés');
define('_SKIN_PART_ERROR',			'Hibák');
define('_SKIN_PART_MEMBER',			'Tagok részletei');
define('_SKIN_PART_POPUP',			'Felbukkanó lépek');
define('_SKIN_GENSETTINGS_TITLE',	'Alap beállítások');
define('_SKIN_CHANGE',				'Változtatás');
define('_SKIN_CHANGE_BTN',			'Változtasd meg ezeket a beállításokat');
define('_SKIN_UPDATE_BTN',			'Bõr frissítése');
define('_SKIN_RESET_BTN',			'Adat visszaállítás');
define('_SKIN_EDITPART_TITLE',		'Bõr szerkesztése');
define('_SKIN_GOBACK',				'Vissza');
define('_SKIN_ALLOWEDVARS',			'Elérhetõ változók (kattints rá a bõvebb információért):');

// global settings
define('_SETTINGS_TITLE',			'Alap beállítások');
define('_SETTINGS_SUB_GENERAL',		'Alap beállítások');
define('_SETTINGS_DEFBLOG',			'Alap blog');
define('_SETTINGS_ADMINMAIL',		'Adminisztrátor email');
define('_SETTINGS_SITENAME',		'Oldal neve');
define('_SETTINGS_SITEURL',			'Oldal URL-je (/-vel a végén)');
define('_SETTINGS_ADMINURL',		'URL az admin területhez (/-vel a végén)');
define('_SETTINGS_DIRS',			'Nucleus könyvtárak');
define('_SETTINGS_MEDIADIR',		'Média könyvtár');
define('_SETTINGS_SEECONFIGPHP',	'(config.php)');
define('_SETTINGS_MEDIAURL',		'Média URL (/-vel a végén)');
define('_SETTINGS_ALLOWUPLOAD',		'Engedélyezed a fájl feltöltést?');
define('_SETTINGS_ALLOWUPLOADTYPES','Engedélyezett fájltípusok feltöltéshez');
define('_SETTINGS_CHANGELOGIN',		'Engedély a tagoknak a login/jelszó változatására.');
define('_SETTINGS_COOKIES_TITLE',	'Süti beállítások');
define('_SETTINGS_COOKIELIFE',		'Belépés süti életideje');
define('_SETTINGS_COOKIESESSION',	'Cookie-k ideje');
define('_SETTINGS_COOKIEMONTH',		'Egy hónap életidõ');
define('_SETTINGS_COOKIEPATH',		'Süti út (speciális)');
define('_SETTINGS_COOKIEDOMAIN',	'Süti domain (speciális)');
define('_SETTINGS_COOKIESECURE',	'Süti védelem (speciális)');
define('_SETTINGS_LASTVISIT',		'Utolsó látogatás sütijének mentése');
define('_SETTINGS_ALLOWCREATE',		'Engedély a látogatók számára felhasználói fiók létrehozásához.');
define('_SETTINGS_NEWLOGIN',		'Belépés engedélyezése felhasználók által létrehozott felhasználói fiókokhoz.');
define('_SETTINGS_NEWLOGIN2',		'(Csak az újonnan létrehozott felhasználói fiókokhoz jár)');
define('_SETTINGS_MEMBERMSGS',		'Tag a tagnak szolgáltatás engedélezése');
define('_SETTINGS_LANGUAGE',		'Alap nyelv');
define('_SETTINGS_DISABLESITE',		'Oldal tiltása');
define('_SETTINGS_DBLOGIN',			'mySQL belépés &amp; adatbázis');
define('_SETTINGS_UPDATE',			'Beállítások frissítése');
define('_SETTINGS_UPDATE_BTN',		'Beállítások frissítése');
define('_SETTINGS_DISABLEJS',		'JavaScript eszköztár tiltása');
define('_SETTINGS_MEDIA',			'Media/feltöltés beállítások');
define('_SETTINGS_MEDIAPREFIX',		'Feltöltött fájlok jelölése dátum prefixszel');
define('_SETTINGS_MEMBERS',			'Tagok beállításai');

// bans
define('_BAN_TITLE',				'Ban lista: ');
define('_BAN_NONE',					'Nincs ban ehhez a bloghoz: ');
define('_BAN_NEW_TITLE',			'Új ban hozzáadása');
define('_BAN_NEW_TEXT',				'Új ban hozzáadása azonnal');
define('_BAN_REMOVE_TITLE',			'Ban eltávolítása');
define('_BAN_IPRANGE',				'IP tartomány');
define('_BAN_BLOGS',				'Melyik blogokat?');
define('_BAN_DELETE_TITLE',			'Ban törlése');
define('_BAN_ALLBLOGS',				'Az összes bloghoz, amihez adminisztrátori jogaid vannak.');
define('_BAN_REMOVED_TITLE',		'Ban eltávolítva.');
define('_BAN_REMOVED_TEXT',			'A ban eltávolítva az alábbi blogokból: ');
define('_BAN_ADD_TITLE',			'Ban hozzáadása');
define('_BAN_IPRANGE_TEXT',			'Válaszd ki az IP tartományt, amit blokkolni szertnél. Minél kevesebb számot tartalmaz, annál több cím lesz blokkolva.');
define('_BAN_BLOGS_TEXT',			'Lehetõséged van választani egy bloghoz kötött IP-t bannolni, vagy pedig bannolni az IP-t az összes bloghoz, ahol admininsztrátori jogokkal rendelkezel.');
define('_BAN_REASON_TITLE',			'Ok');
define('_BAN_REASON_TEXT',			'Meg tudod védeni a ban okát, ami akkor jelenik meg, amikor az IP birtokosa megpróbál megjegyzést írni, vagy szavazni (max. 256 karakter).');
define('_BAN_ADD_BTN',				'Ban hozzáadása');

// LOGIN screen
define('_LOGIN_MESSAGE',			'Üzenet');
define('_LOGIN_NAME',				'Név');
define('_LOGIN_PASSWORD',			'Jelszó');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'Elfelejetted a jelszavad?');

// membermanagement
define('_MEMBERS_TITLE',			'Tagok menedzselése');
define('_MEMBERS_CURRENT',			'Jelenlegi tagok');
define('_MEMBERS_NEW',				'Új tag');
define('_MEMBERS_DISPLAY',			'Név megjelenítése');
define('_MEMBERS_DISPLAY_INFO',		'(Ezt a nevet használod belépéshez.)');
define('_MEMBERS_REALNAME',			'Valódi név');
define('_MEMBERS_PWD',				'Jelszó');
define('_MEMBERS_REPPWD',			'Jelszó mégegyszer');
define('_MEMBERS_EMAIL',			'Email cím');
define('_MEMBERS_EMAIL_EDIT',		'(Amikor változtatod a címed, az új jelszó automatikusan érkezik a címedre.)');
define('_MEMBERS_URL',				'Weboldal cím (URL)');
define('_MEMBERS_SUPERADMIN',		'Adminisztrátor jogok');
define('_MEMBERS_CANLOGIN',			'Be tud lépni adminisztrátor területre');
define('_MEMBERS_NOTES',			'Megejgyzések');
define('_MEMBERS_NEW_BTN',			'Tag hozzáadása');
define('_MEMBERS_EDIT',				'Tag szerkesztése');
define('_MEMBERS_EDIT_BTN',			'Beállítások változtatása');
define('_MEMBERS_BACKTOOVERVIEW',	'Vissza a tagok beállításaihoz');
define('_MEMBERS_DEFLANG',			'Nyelv');
define('_MEMBERS_USESITELANG',		'- oldal beállításainak használata -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'Oldal meglátogatása');
define('_BLOGLIST_ADD',				'Elem hozzáadása');
define('_BLOGLIST_TT_ADD',			'Új elem hozzáadása ehhez a bloghoz.');
define('_BLOGLIST_EDIT',			'Elemek szerkesztése/törlése');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Könyvjelzõ');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'Beállítások');
define('_BLOGLIST_TT_SETTINGS',		'Beállítások szerkesztése vagy a csapat menedzselés');
define('_BLOGLIST_BANS',			'Banok');
define('_BLOGLIST_TT_BANS',			'Bannolt IP-k megnézése, hozzáadása vagy eltávolítása.');
define('_BLOGLIST_DELETE',			'Összes törlése');
define('_BLOGLIST_TT_DELETE',		'Törli ezt a blogot.');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'A blogjaid');
define('_OVERVIEW_YRDRAFTS',		'Piszkozataid');
define('_OVERVIEW_YRSETTINGS',		'Beállításaid');
define('_OVERVIEW_GSETTINGS',		'Alap beállítások');
define('_OVERVIEW_NOBLOGS',			'Egyik blog csapatlistájában sem vagy benne.');
define('_OVERVIEW_NODRAFTS',		'Nincsenek piszkozatok');
define('_OVERVIEW_EDITSETTINGS',	'Beállításaid mentése...');
define('_OVERVIEW_BROWSEITEMS',		'Böngészsés az elemeid között...');
define('_OVERVIEW_BROWSECOMM',		'Böngészsés az megjegyzéseid között...');
define('_OVERVIEW_VIEWLOG',			'Log megtekintése...');
define('_OVERVIEW_MEMBERS',			'Tagok menedzselése...');
define('_OVERVIEW_NEWLOG',			'Új blog létrehozása...');
define('_OVERVIEW_SETTINGS',		'Beállítások szerkesztése...');
define('_OVERVIEW_TEMPLATES',		'Sablonok szerkesztése...');
define('_OVERVIEW_SKINS',			'Bõrök szerkesztése...');
define('_OVERVIEW_BACKUP',			'Biztonsági mentés/Visszaállítás...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'Elemek a bloghoz'); 
define('_ITEMLIST_YOUR',			'Elemeid');

// Comments
define('_COMMENTS',					'Megjegyzések');
define('_NOCOMMENTS',				'Nincsenek megjegyzések ehhez az elemhez.');
define('_COMMENTS_YOUR',			'Megjegyzéseid');
define('_NOCOMMENTS_YOUR',			'Nem írtál megjegyzést!');

// LISTS (general)
define('_LISTS_NOMORE',				'Nincs több találat vagy a keresés egyáltalán nem eredményezett találatot.');
define('_LISTS_PREV',				'Elõzõ');
define('_LISTS_NEXT',				'Következõ');
define('_LISTS_SEARCH',				'Keres');
define('_LISTS_CHANGE',				'Változtat');
define('_LISTS_PERPAGE',			'elemek/lap');
define('_LISTS_ACTIONS',			'Akciók');
define('_LISTS_DELETE',				'Töröl');
define('_LISTS_EDIT',				'Szerkeszt');
define('_LISTS_MOVE',				'Áthelyez');
define('_LISTS_CLONE',				'Klón');
define('_LISTS_TITLE',				'Cím');
define('_LISTS_BLOG',				'Blog');
define('_LISTS_NAME',				'Név');
define('_LISTS_DESC',				'Leírás');
define('_LISTS_TIME',				'Idõpont');
define('_LISTS_COMMENTS',			'Megjegyzés');
define('_LISTS_TYPE',				'Típus');


// member list 
define('_LIST_MEMBER_NAME',			'Név mutatása');
define('_LIST_MEMBER_RNAME',		'Valódi név');
define('_LIST_MEMBER_ADMIN',		'Szuper-admin?');
define('_LIST_MEMBER_LOGIN',		'Beléphet?');
define('_LIST_MEMBER_URL',			'Weboldal');

// banlist
define('_LIST_BAN_IPRANGE',			'IP tartomány');
define('_LIST_BAN_REASON',			'Ok');

// actionlist
define('_LIST_ACTION_MSG',			'Üzenet');

// commentlist
define('_LIST_COMMENT_BANIP',		'IP bannolása');
define('_LIST_COMMENT_WHO',			'Szerzõ');
define('_LIST_COMMENT',				'Megjegyzés');
define('_LIST_COMMENT_HOST',		'Hoszt');

// itemlist
define('_LIST_ITEM_INFO',			'Információ');
define('_LIST_ITEM_CONTENT',		'Cím és szöveg');


// teamlist
define('_LIST_TEAM_ADMIN',			'Admin');
define('_LIST_TEAM_CHADMIN',		'Admin változtatása');

// edit comments
define('_EDITC_TITLE',				'Megjegyzések szerkesztése');
define('_EDITC_WHO',				'Szerzõ');
define('_EDITC_HOST',				'Honnan?');
define('_EDITC_WHEN',				'Mikor?');
define('_EDITC_TEXT',				'Szöveg');
define('_EDITC_EDIT',				'Megjegyzés szerkesztése');
define('_EDITC_MEMBER',				'Tag');
define('_EDITC_NONMEMBER',			'Nem tag');

// move item
define('_MOVE_TITLE',				'Melyik blogba mozgassam?');
define('_MOVE_BTN',					'Elem áthelyezése');

?>