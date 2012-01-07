<?php
// German Nucleus Language File
// Date: 2009-02-26
// Author: Kai Greve
// Formerly based on translations by: Dieter Mayer, Holger Laschka, Thorsten Bonck
// Nucleus version: v1.0-v3.4
//
// Please note: if you want to translate this file to your own language, be aware
// that in a next Nucleus version, new variables might be added and some other ones
// might be deleted. Therefor, it's important to list the Nucleus version for which
// the file was written in your document.
//
// Fully translated language file can be sent to us and will be made
// available for download (with proper credit to the author, of course)

// START additional added for the german translation of Nucleus CMS 3.40
define('_QMENU_MANAGE_SYSTEM',						'System info');
define('_ADMINPAGEFOOT_COPYRIGHT',					'The Nucleus Group');
define('_ADMINPAGEFOOT_DONATE',						'Spenden fü;r Nucleus CMS!');
define('_ADMINPAGEFOOT_DONATEURL',					'http://nucleuscms.org/donate.php');
define('_ADMINPAGEFOOT_OFFICIALURL',				'http://nucleuscms.org/');
define('_LIST_ITEM_NOCONTENT',						'Kein Kommentar');
define('_LIST_SKIN_README_TXT',						'Weitere Informationen lesen');
define('_SKINEDIT_ALLOWEDBLOGS',					'Erlaubte Blog Namen');
define('_SKINEDIT_ALLOWEDTEMPLATESS',				'Erlaubte Template Namen');
define('_BMLET_CANCEL',								'Abbrechen');
define('_EBLOG_CURRENT_TEAM_MEMBER',				'Mitglieder im Team:');
define('_EBLOG_REQUIREDEMAIL',						'E-Mail Addresse fü;r Kommentare voraussetzen?');
define('_BMLET_BACKTODRAFTS',						'Zurü;ck zu den Entwü;rfen verschieben');
// END additional added for the german translation of Nucleus CMS 3.40

/********************************************
 *        Start New for 3.40                *
 ********************************************/

// START changed/added after 3.33 START
define('_MEMBERS_USEAUTOSAVE',						'Funktion Automatisches Speichern verwenden?');
define('_TEMPLATE_PLUGIN_FIELDS',					'Zusä;tzliche Plugin Felder');
define('_TEMPLATE_BLOGLIST',						'Template Blog Liste');
define('_TEMPLATE_BLOGHEADER',						'Blog Liste Kopfzeile');
define('_TEMPLATE_BLOGITEM',						'Blog Liste Eintrag');
define('_TEMPLATE_BLOGFOOTER',						'Blog Liste Fusszeile');
define('_SETTINGS_DEFAULTLISTSIZE',					'Default Size of Lists in Admin Area');
define('_CREATE_ACCOUNT_TITLE',						'Benutzer Konto erstellen');
define('_CREATE_ACCOUNT0',							'Konto erstellen');
define('_CREATE_ACCOUNT1',							'Besuchern ist es nicht gestattet ein Benutzer Konto zu erstellen.<br /><br />');
define('_CREATE_ACCOUNT2',							'Bitte setzen Sie ishc mit den Website Administrator in Verbindung, um weitere Informationen zu erhalten.');
define('_CREATE_ACCOUNT_USER_DATA',					'Konto Informationen');
define('_CREATE_ACCOUNT_LOGIN_NAME',				'Login Name (erforderlich):');
define('_CREATE_ACCOUNT_LOGIN_NAME_VALID',			'nur a-z und 0-9 erlaubt, keine Leerzeichen am Start oder Ende');
define('_CREATE_ACCOUNT_REAL_NAME',					'Echter Name (erforderlich):');
define('_CREATE_ACCOUNT_EMAIL',						'Email (erforderlich):');
define('_CREATE_ACCOUNT_EMAIL2',					'(must be valid, because an activation link will be sent over there)');
define('_CREATE_ACCOUNT_URL',						'URL:');
define('_CREATE_ACCOUNT_SUBMIT',					'Konto erstellen');
define('_SETTINGS_DEBUGVARS',		'Debug Vars');
// END changed/added after 3.33 END

// START merge UTF-8 and EUC-JP

// Create New blog
define('_ADMIN_NOTABILIA',							'Some information');
define('_ADMIN_PLEASE_READ',						"Before you start, here's some <strong>important information</strong>");
define('_ADMIN_HOW_TO_ACCESS',						"After you've created a new weblog, you'll need to perform some actions to make your blog accessible. There are two possibilities:");
define('_ADMIN_SIMPLE_WAY',							"<strong>Simple:</strong> Create a copy of <code>index.php</code> and modify it to display your new weblog. Further instructions on how to do this will be provided after you've submitted this first form.");
define('_ADMIN_ADVANCED_WAY',						"<strong>Advanced:</strong> Insert the blog content into your current skins using skinvars like <code>&lt;%otherblog()&gt;</code>. This way, you can place multiple blogs on the same page.");
define('_ADMIN_HOW_TO_CREATE',						'Create Weblog');


define('_BOOKMARKLET_NEW_CATEGORY',					'Item was added, and a new category was created. ');
define('_BOOKMARKLET_NEW_CATEGORY_EDIT',			'Click here to edit the name and description of the category.');
define('_BOOKMARKLET_NEW_WINDOW',					'Opens in new window');
define('_BOOKMARKLET_SEND_PING',					'Item was added successfully. Now pinging weblogs.com. Please hold on... (can take a while)');
// END merge UTF-8 and EUC-JP

// send Weblogupdate.ping
define('_UPDATEDPING_MESSAGE',						'<h2>Website aktualisiert, jetzt werden verschiedene Weblog Sservices angepingt...</h2><p>This can take a while...</p><p>If you aren\'t automatically passed through, ');
define('_UPDATEDPING_GOPINGPAGE',					'nocheinmal versuchen');
define('_UPDATEDPING_PINGING',						'Pinging Services, bitte warten ...');
define('_UPDATEDPING_VIEWITEM',						'Siehe Liste für aktuelle Artikel für ');
define('_UPDATEDPING_VISITOWNSITE',					'Besuchen Sie Ihre Website');
define('_UPDATEDPING_GOSENDPING',					'Sende Update Ping');

// ADMIN.php systemoverview()
define('_ADMIN_SYSTEMOVERVIEW_HEADING',				'System info');
define('_ADMIN_SYSTEMOVERVIEW_PHPANDMYSQL',			'PHP und MySQL');
define('_ADMIN_SYSTEMOVERVIEW_VERSIONS',			'Versionen');
define('_ADMIN_SYSTEMOVERVIEW_PHPVERSION',			'PHP Version');
define('_ADMIN_SYSTEMOVERVIEW_MYSQLVERSION',		'MySQL Version');
define('_ADMIN_SYSTEMOVERVIEW_SETTINGS',			'Einstellungen');
define('_ADMIN_SYSTEMOVERVIEW_GDLIBRALY',			'GD Libraly');
define('_ADMIN_SYSTEMOVERVIEW_MODULES',				'Module');
define('_ADMIN_SYSTEMOVERVIEW_ENABLE',				'aktiviert (enabled)');
define('_ADMIN_SYSTEMOVERVIEW_DISABLE',				'deaktiviert (disabled)');
define('_ADMIN_SYSTEMOVERVIEW_NUCLEUSSYSTEM',		'Ihr Nucleus CMS System');
define('_ADMIN_SYSTEMOVERVIEW_NUCLEUSVERSION',		'Nucleus CMS version');
define('_ADMIN_SYSTEMOVERVIEW_NUCLEUSPATCHLEVEL',	'Nucleus CMS patch level');
define('_ADMIN_SYSTEMOVERVIEW_NUCLEUSSETTINGS',		'Wichtige Einstellungen');
define('_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK',		'Prü;fen ob eine neue Version erhä;ltlich ist');
define('_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_TXT',	'Prü;fen, ob eine neue Version erhä;ltlich ist: ');
define('_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_URL',	'http://nucleuscms.org/version.php?v=%d&amp;pl=%d');
define('_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_TITLE',	'Prü;fen ob eine neue Version/Uprgrade erhä;ltlich ist');
define('_ADMIN_SYSTEMOVERVIEW_NOT_ADMIN',			"Sie haben nicht genü;gend Rechte, um die System informationen einzusehen.");

// START changed/added after 315 START

define('_LIST_PLUG_SUBS_NEEDUPDATE','Bitte benutzen Sie den \'Update Subscribtion list\'-Taste zum Update der Plugin-Abonnementliste.');
define('_LIST_PLUGS_DEP',			'Plugin(s) erfordert:');

// END changed/added after 3.15

// START changed/added after 3.1 START

// comments list per weblog
define('_COMMENTS_BLOG',			'Alle Kommentare fü;r das Blog');
define('_NOCOMMENTS_BLOG',			'Keine Kommentare in diesem Blog vorhanden');
define('_BLOGLIST_COMMENTS',		'Kommentare');
define('_BLOGLIST_TT_COMMENTS',		'Liste aller Kommentaren in diesem Blog');


// for use in archivetype-skinvar
define('_ARCHIVETYPE_DAY',			'Tag');
define('_ARCHIVETYPE_MONTH',		'Monat');

// tickets (prevents malicious users to trick an admin to perform actions he doesn't want)
define('_ERROR_BADTICKET',			'Ungü;ltiges oder erloschenes Ticket.');

// plugin dependency
define('_ERROR_INSREQPLUGIN',		'Plugin-Installation misslungen, erfordert ');
define('_ERROR_DELREQPLUGIN',		'Lö;schen des Plugins misslungen, benö;tigt von ');

// cookie prefix
define('_SETTINGS_COOKIEPREFIX',	'Cookie-Prä;fix');

// account activation
define('_ERROR_NOLOGON_NOACTIVATE',	'Kann Aktivierungslink nicht senden. Erlaubnis zum Login verweigert.');
define('_ERROR_ACTIVATE',			'Aktivierungsschlü;ssel nicht vorhanden, ungü;ltig oder abgelaufen.');
define('_ACTIONLOG_ACTIVATIONLINK', 'Aktivierungslink gesendet');
define('_MSG_ACTIVATION_SENT',		'Ein Aktivierungslink wurde per eMail ü;bermittelt.');

// activation link emails
define('_ACTIVATE_REGISTER_MAIL',	"Hi <%memberName%>,\n\nSie mü;ssen Ihren Konto auf <%siteName%> (<%siteUrl%>) aktivieren.\nSie kö;nnen dies durch Klick auf den nachstehenden Link erledigen: \n\n\t<%activationUrl%>\n\nSie haben dafü;r zwei Tage. Danach wird dieser Aktivierungslink ungü;ltig.");
define('_ACTIVATE_REGISTER_MAILTITLE',	"Aktivieren Sie Ihren '<%memberName%>'-Konto");
define('_ACTIVATE_REGISTER_TITLE',	'Willkommen, <%memberName%>');
define('_ACTIVATE_REGISTER_TEXT',	'Sie sind fast fertig. Bitte wä;hlen Sie ein Passwort fü;r den nachstehenden Konto.');
define('_ACTIVATE_FORGOT_MAIL',		"Hi <%memberName%>,\n\nMit dem nachstehenden Link kö;nnen Sie ein neues Passwort fü;r Ihren Konto auf <%siteName%> (<%siteUrl%>) bestimmen.\n\n\t<%activationUrl%>\n\nSie haben dafü;r zwei Tage. Danach wird dieser Aktivierungslink ungü;ltig.");
define('_ACTIVATE_FORGOT_MAILTITLE',"Reaktivieren Sie Ihren '<%memberName%>'-Konto");
define('_ACTIVATE_FORGOT_TITLE',	'Willkommen, <%memberName%>');
define('_ACTIVATE_FORGOT_TEXT',		'Sie kö;nnen fü;r den nachstehenden Konto ein neues Passwort bestimmen:');
define('_ACTIVATE_CHANGE_MAIL',		"Hallo <%memberName%>,\n\nDa Ihre eMail-Adresse geä;ndert wurde, mü;ssen Sie Ihren Konto bei <%siteName%> (<%siteUrl%>) neu aktivieren.\nSie kö;nnen dies durch Klick auf den nachstehenden Link erledigen: \n\n\t<%activationUrl%>\n\nSie haben dafü;r zwei Tage. Danach wird dieser Aktivierungslink ungü;ltig.");
define('_ACTIVATE_CHANGE_MAILTITLE',"Ereute Aktivierung Ihres '<%memberName%>'-Konto");
define('_ACTIVATE_CHANGE_TITLE',	'Willkommen, <%memberName%>');
define('_ACTIVATE_CHANGE_TEXT',		'Ihre Adressä;nderung wurde ü;berprü;ft. Vielen Dank!');
define('_ACTIVATE_SUCCESS_TITLE',	'Aktivierung erfolgreich abgeschlossen');
define('_ACTIVATE_SUCCESS_TEXT',	'Ihr Konto wurde erfolgreich aktiviert.');
define('_MEMBERS_SETPWD',			'Passwort festlegen');
define('_MEMBERS_SETPWD_BTN',		'Passwort festlegen');
define('_QMENU_ACTIVATE',			'Konto Aktivierung');
define('_QMENU_ACTIVATE_TEXT',		'<p>Nachdem Sie Ihr Konto aktiviert haben, kö;nnen Sie sich <a href="index.php?action=showlogin">anmelden</a>.</p>');

define('_PLUGS_BTN_UPDATE',			'Abonnementliste aktualisieren');

// global settings
define('_SETTINGS_JSTOOLBAR',		'Javascript Werkzeugleisten-Stil');
define('_SETTINGS_JSTOOLBAR_FULL',	'Vollstä;ndige Werkzeugleiste (IE)');
define('_SETTINGS_JSTOOLBAR_SIMPLE','Einfache Werkzeugleiste (Nicht-IE)');
define('_SETTINGS_JSTOOLBAR_NONE',	'Deaktiviere Werkzeugleiste');
define('_SETTINGS_URLMODE_HELP',	'(Info: <a href="documentation/tips.html#searchengines-fancyurls">Wie werden Fancy URLs aktiviert</a>)');

// extra plugin settings part when editing categories/members/blogs/...
define('_PLUGINS_EXTRA',			'Zusä;tzliche Plugin Einstellungen');

// itemlist info column keys
define('_LIST_ITEM_BLOG',			'Blog:');
define('_LIST_ITEM_CAT',			'Kategorie:');
define('_LIST_ITEM_AUTHOR',			'Autor:');
define('_LIST_ITEM_DATE',			'Datum:');
define('_LIST_ITEM_TIME',			'Zeit:');

// indication of registered members in comments list
define('_LIST_COMMENTS_MEMBER', 	'(Mitglied)');

// batch operations
define('_BATCH_WITH_SEL',			'Mit ausgewä;hlten:');
define('_BATCH_EXEC',				'Ausfü;hren');

// quickmenu
define('_QMENU_HOME',				'Home');
define('_QMENU_ADD',				'Neuer Artikel');
define('_QMENU_ADD_SELECT',			'-- auswä;hlen --');
define('_QMENU_USER_SETTINGS',		'Einstellungen');
define('_QMENU_USER_ITEMS',			'Artikel');
define('_QMENU_USER_COMMENTS',		'Kommentare');
define('_QMENU_MANAGE',				'Verwaltung');
define('_QMENU_MANAGE_LOG',			'Logdatei');
define('_QMENU_MANAGE_SETTINGS',	'Konfiguration');
define('_QMENU_MANAGE_MEMBERS',		'Benutzer');
define('_QMENU_MANAGE_NEWBLOG',		'Neues Weblog');
define('_QMENU_MANAGE_BACKUPS',		'Backups');
define('_QMENU_MANAGE_PLUGINS',		'Plugins');
define('_QMENU_LAYOUT',				'Layout');
define('_QMENU_LAYOUT_SKINS',		'Designvorlagen');
define('_QMENU_LAYOUT_TEMPL',		'Templates');
define('_QMENU_LAYOUT_IEXPORT',		'Import/Export');
define('_QMENU_PLUGINS',			'Plugins');

// quickmenu on logon screen
define('_QMENU_INTRO',				'Einfü;hrung');
define('_QMENU_INTRO_TEXT',			'<p>Dies ist die Login-Seite fü;r das Nucleus CMS, dem Content Management-System zur Verwaltung dieser Website.</p><p>Wenn Sie ein Benutzerkonto besitzen, kö;nnen Sie sich anmelden und mit der Eingabe neuer Artikel beginnen.</p>');

// helppages for plugins
define('_ERROR_PLUGNOHELPFILE',		'Die Hilfedatei fü;r dieses Plugin wurde nicht gefunden');
define('_PLUGS_HELP_TITLE',			'Hilfe fü; das Plugin');
define('_LIST_PLUGS_HELP', 			'Hilfe');


// END changed/started after 3.1

// START changed/added after v2.5beta START

// general settings (security)
define('_SETTINGS_EXTAUTH',			'Externe Authentifizierung gestatten');
define('_WARNING_EXTAUTH',			'Achtung: nur wenn wirklich erforderlich gestatten.');

// member profile
define('_MEMBERS_BYPASS',			'Externe Authentifizierung verwenden');

// 'always include in search' blog setting (yes/no) [in v2.5beta, the 'always' part wasn't clear]
define('_EBLOG_SEARCH',				'<em>Immer</em> in die Suche einbeziehen');

// END changed/added after v2.5beta

// START introduced after v2.0 START

// media library
define('_MEDIA_VIEW',				'anzeigen');
define('_MEDIA_VIEW_TT',			'Datei anzeigen (ö;ffnet sich in einem neuen Fenster)');
define('_MEDIA_FILTER_APPLY',		'Filter anwenden');
define('_MEDIA_FILTER_LABEL',		'Filter: ');
define('_MEDIA_UPLOAD_TO',			'Upload nach...');
define('_MEDIA_UPLOAD_NEW',			'Neue Datei hochladen...');
define('_MEDIA_COLLECTION_SELECT',	'Auswahl');
define('_MEDIA_COLLECTION_TT',		'Zu dieser Kategorie wechseln');
define('_MEDIA_COLLECTION_LABEL',	'Aktuelle Sammlung: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'Linksbü;ndig ausrichten');
define('_ADD_ALIGNRIGHT_TT',		'Rechtsbü;ndig ausrichten');
define('_ADD_ALIGNCENTER_TT',		'Mittig ausrichten');


// generic upload failure
define('_ERROR_UPLOADFAILED',		'Upload nicht erfolgreich');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'Posten zu vergangenem Datum erlauben');
define('_ADD_CHANGEDATE',			'Zeitstempel ä;ndern');
define('_BMLET_CHANGEDATE',			'Zeitstempel ä;ndern');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'Designvorlage importieren/exportieren...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Normal');
define('_PARSER_INCMODE_SKINDIR',	'Designvorlagenverzeichnis benutzen ');
define('_SKIN_INCLUDE_MODE',		'Include-Modus');
define('_SKIN_INCLUDE_PREFIX',		'Include-Prfix');

// global settings
define('_SETTINGS_BASESKIN',		'Standard-Designvorlage');
define('_SETTINGS_SKINSURL',		'Designvorlagen-URL');
define('_SETTINGS_ACTIONSURL',		'URL zur action.php');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'Standardkategorie kann nicht verschoben werden');
define('_ERROR_MOVETOSELF',			'Kategorie kann nicht verschoben werden (Ziel und Ursprung sind identisch)');
define('_MOVECAT_TITLE',			'Zielblog auswhlen');
define('_MOVECAT_BTN',				'Kategorie verschieben');

// URLMode setting
define('_SETTINGS_URLMODE',			'URL-Modus');
define('_SETTINGS_URLMODE_NORMAL',	'Normal');
define('_SETTINGS_URLMODE_PATHINFO','Fancy');

// Batch operations
define('_BATCH_NOSELECTION',		'Kein Ziel fü;r die Aktion ausgewä;hlt');
define('_BATCH_ITEMS',				'Stapelaktionen fü;r Beiträ;ge');
define('_BATCH_CATEGORIES',			'Stapelaktionen fü;r Kategorien');
define('_BATCH_MEMBERS',			'Stapeloperationen fü;r Mitglieder');
define('_BATCH_TEAM',				'Stapeloperationen fü;r Teammitglieder');
define('_BATCH_COMMENTS',			'Stapeloperationen fü;r Kommentare');
define('_BATCH_UNKNOWN',			'Unbekannte Stapeloperation: ');
define('_BATCH_EXECUTING',			'Wird ausgefü;hrt:');
define('_BATCH_ONCATEGORY',			'in Kategorie');
define('_BATCH_ONITEM',				'an Beitrag');
define('_BATCH_ONCOMMENT',			'an Kommentar');
define('_BATCH_ONMEMBER',			'an Mitglied');
define('_BATCH_ONTEAM',				'an Teammitglied');
define('_BATCH_SUCCESS',			'Erfolgreich beendet!');
define('_BATCH_DONE',				'Erledigt!');
define('_BATCH_DELETE_CONFIRM',		'Lö;schen im Batchbetrieb bestä;tigen');
define('_BATCH_DELETE_CONFIRM_BTN',	'Lö;schen bestä;tigen');
define('_BATCH_SELECTALL',			'Alle auswä;hlen');
define('_BATCH_DESELECTALL',		'Alle abwä;hlen');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'Lö;schen');
define('_BATCH_ITEM_MOVE',			'Verschieben');
define('_BATCH_MEMBER_DELETE',		'Lö;schen');
define('_BATCH_MEMBER_SET_ADM',		'Administratorrechte geben');
define('_BATCH_MEMBER_UNSET_ADM',	'Administratorrechte nehmen');
define('_BATCH_TEAM_DELETE',		'Aus Team lö;schen');
define('_BATCH_TEAM_SET_ADM',		'Administratorrechte geben');
define('_BATCH_TEAM_UNSET_ADM',		'Administratorrechte nehmen');
define('_BATCH_CAT_DELETE',			'Lö;schen');
define('_BATCH_CAT_MOVE',			'In anderes Blog verschieben');
define('_BATCH_COMMENT_DELETE',		'Lö;schen');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'Neuen Artikel Hinzufü;gen');
define('_ADD_PLUGIN_EXTRAS',		'Zusä;tzliche Plugin Optionen');

// errors
define('_ERROR_CATCREATEFAIL',		'Neue Kategorie konnte nicht angelegt werden');
define('_ERROR_NUCLEUSVERSIONREQ',	'Das Plugin braucht eine neuere Nucleus Version: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Zurü;ck zu den Blog Einstellungen');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Importieren');
define('_SKINIE_TITLE_EXPORT',		'Exportieren');
define('_SKINIE_BTN_IMPORT',		'Importieren');
define('_SKINIE_BTN_EXPORT',		'Exportieren der ausgewä;hlten Designvorlagen/Templates');
define('_SKINIE_LOCAL',				'Importieren von lokaler Datei:');
define('_SKINIE_NOCANDIDATES',		'Keine Dateien zum Importieren gefunden');
define('_SKINIE_FROMURL',			'Importieren von URL:');
define('_SKINIE_EXPORT_INTRO',		'Unten auswä;hlen, was exportiert werden soll');
define('_SKINIE_EXPORT_SKINS',		'Designvorlagen');
define('_SKINIE_EXPORT_TEMPLATES',	'Templates');
define('_SKINIE_EXPORT_EXTRA',		'Extra Info');
define('_SKINIE_CONFIRM_OVERWRITE',	'Bestehende Designvorlagen ü;berschreiben (siehe unten)');
define('_SKINIE_CONFIRM_IMPORT',	'Ja, importieren');
define('_SKINIE_CONFIRM_TITLE',		'Designvorlagen und Templates importieren');
define('_SKINIE_INFO_SKINS',		'Designvorlagen in der Datei:');
define('_SKINIE_INFO_TEMPLATES',	'Templates in der Datei:');
define('_SKINIE_INFO_GENERAL',		'Info:');
define('_SKINIE_INFO_SKINCLASH',	'Designvorlagennamen kollidieren:');
define('_SKINIE_INFO_TEMPLCLASH',	'Templatenamen kollidieren:');
define('_SKINIE_INFO_IMPORTEDSKINS','Importierte Designvorlagen:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Importierte Templates:');
define('_SKINIE_DONE',				'Importiert');
define('_AND',						'und');
define('_OR',						'oder');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'leeres Feld (zum Bearbeiten anklicken)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'Include-Modus:');
define('_LIST_SKINS_INCPREFIX',		'Include-Prä;fix:');
define('_LIST_SKINS_DEFINED',		'Definierte Teile:');

// backup
define('_BACKUPS_TITLE',			'Sichern / Wiederherstellen');
define('_BACKUP_TITLE',				'Sichern');
define('_BACKUP_INTRO',				'Die Taste klicken, um eine Sicherungskopie der Datenbank zu erstellen.');
define('_BACKUP_ZIP_YES',			'Komprimierung versuchen');
define('_BACKUP_ZIP_NO',			'Keine Komprimierung verwenden');
define('_BACKUP_BTN',				'Sicherungskopie erstellen');
define('_BACKUP_NOTE',				'<b>Achtung:</b> Nur die Datenbank wird gespeichert. Media-Dateien und Einstellungen in der config.php werden <b>NICHT</b> gespeichert.');
define('_RESTORE_TITLE',			'Wiederherstellen');
define('_RESTORE_NOTE',				'<b>WARNUNG:</b> Wiederherstellen wird alle bestehenden Daten <b>Lö;SCHEN</b>!<br />	<b>Achtung:</b> Die Version von Sicherungskopie und Laufzeitsystem muss ü;bereinstimmen, ansonsten wird es nicht funktionieren!');
define('_RESTORE_INTRO',			'Sicherungsdatei auswä;hlen, danach startet das Wiederherstellen.');
define('_RESTORE_IMSURE',			'Ja, ich will wiederherstellen!');
define('_RESTORE_BTN',				'Von Datei wiederherstellen');
define('_RESTORE_WARNING',			'(sichergehen, dass die Sicherungsdatei aktuell ist)');
define('_ERROR_BACKUP_NOTSURE',		'Die CheckBox muss aktiviert sein!');
define('_RESTORE_COMPLETE',			'Wiederherstellen komplett!');

// new item notification
define('_NOTIFY_NI_MSG',			'Ein neuer Eintrag wurde verfasst:');
define('_NOTIFY_NI_TITLE',			'Neuer Beitrag!');
define('_NOTIFY_KV_MSG',			'Karma bei Eintrag:');
define('_NOTIFY_KV_TITLE',			'Nucleus Karma:');
define('_NOTIFY_NC_MSG',			'Kommentar bei Beitrag:');
define('_NOTIFY_NC_TITLE',			'Nucleus Kommentar:');
define('_NOTIFY_USERID',			'Benutzer-ID:');
define('_NOTIFY_USER',				'Benutzer:');
define('_NOTIFY_COMMENT',			'Kommentar:');
define('_NOTIFY_VOTE',				'Abstimmung:');
define('_NOTIFY_HOST',				'Host:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'Mitglied:');
define('_NOTIFY_TITLE',				'ü;berschrift:');
define('_NOTIFY_CONTENTS',			'Inhalt:');

// member mail message
define('_MMAIL_MSG',				'Eine Nachricht von');
define('_MMAIL_FROMANON',			'ein anonymer Besucher');
define('_MMAIL_FROMNUC',			'Geschrieben von einem Nucleus Weblog bei');
define('_MMAIL_TITLE',				'Eine Nachricht von');
define('_MMAIL_MAIL',				'Nachricht:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'Hinzufü;gen');
define('_BMLET_EDIT',				'Bearbeiten');
define('_BMLET_DELETE',				'Lö;schen');
define('_BMLET_BODY',				'Einfü;hrung');
define('_BMLET_MORE',				'Erweitert');
define('_BMLET_OPTIONS',			'Optionen');
define('_BMLET_PREVIEW',			'Vorschau');

// used in bookmarklet
define('_ITEM_UPDATED',				'Bookmarklet wurde aktualisiert');
define('_ITEM_DELETED',				'Bookmarklet wurde gelö;scht');

// plugins
define('_CONFIRMTXT_PLUGIN',		'Plugin wirklich lö;schen');
define('_ERROR_NOSUCHPLUGIN',		'Kein solches Plugin');
define('_ERROR_DUPPLUGIN',			'Dieses Plugin ist bereits installiert');
define('_ERROR_PLUGFILEERROR',		'Dieses Plugin existiert nicht oder es sind unzureichende Zugriffsrechte vorhanden');
define('_PLUGS_NOCANDIDATES',		'Kein Plugin gefunden');

define('_PLUGS_TITLE_MANAGE',		'Plugins verwalten');
define('_PLUGS_TITLE_INSTALLED',	'Derzeit installiert');
define('_PLUGS_TITLE_UPDATE',		'Liste aktualisieren');
define('_PLUGS_TEXT_UPDATE',		'Nucleus CMS verwendet einen Cache um die Events, die Plugins abonniert haben, zu speichern. Nach dem Aktualisieren oder der Neuinstallation eines Plugins kann es notwendig werden, die Abonnentenliste zu aktualisieren.');
define('_PLUGS_TITLE_NEW',			'Neues Plugin installieren');
define('_PLUGS_ADD_TEXT',			'Unten steht eine Liste von mö;glichen, nicht installierten Plugins. Bitte <strong>vor dem Installieren sicherstellen</strong>, dass es tatschlich ein Plugin ist.');
define('_PLUGS_BTN_INSTALL',		'Plugin installieren');
define('_BACKTOOVERVIEW',			'Zurü;ck zur übersicht');

// editlink
define('_TEMPLATE_EDITLINK',		'Link bearbeiten');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'Linke Box hinzufü;gen');
define('_ADD_RIGHT_TT',				'Rechte Box hinzufü;gen');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'Neue Kategorie...');

// new settings
define('_SETTINGS_PLUGINURL',		'Plugin-URL');
define('_SETTINGS_MAXUPLOADSIZE',	'Max. Upload-Dateigrö;ße (Bytes)');
define('_SETTINGS_NONMEMBERMSGS',	'Erlaube Nicht-Mitgliedern das Senden von Nachrichten');
define('_SETTINGS_PROTECTMEMNAMES',	'Mitgliedernamen schü;tzen');

// overview screen
define('_OVERVIEW_PLUGINS',			'Plugins verwalten...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'Neue Mitgliederanmeldung:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'Ihre eMail-Adresse:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'Du hast in keinem Blog dieselben Administratorrechte wie eines der Mitglieder in der Teamliste. Deshalb ist es Dir nicht gestattet, Dateien in das Media-Verzeichnis des Mitgleids hochzuladen.');

// plugin list
define('_LISTS_INFO',				'Information');
define('_LIST_PLUGS_AUTHOR',		'Von:');
define('_LIST_PLUGS_VER',			'Version:');
define('_LIST_PLUGS_SITE',			'Seite besuchen');
define('_LIST_PLUGS_DESC',			'Beschreibung:');
define('_LIST_PLUGS_SUBS',			'Folgende Ereignisse ü;bermitteln:');
define('_LIST_PLUGS_UP',			'nach oben');
define('_LIST_PLUGS_DOWN',			'nach unten');
define('_LIST_PLUGS_UNINSTALL',		'deinstallieren');
define('_LIST_PLUGS_ADMIN',			'administrieren');
define('_LIST_PLUGS_OPTIONS',		'Optionen bearbeiten');

// plugin option list
define('_LISTS_VALUE',				'Wert');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'Dieses Plugin hat keine Optionen eingestellt');
define('_PLUGS_BACK',				'Zurü;ck zur Plugin ü;bersicht');
define('_PLUGS_SAVE',				'Optionen speichern');
define('_PLUGS_OPTIONS_UPDATED',	'Plugin-Optionen aktualisiert');
define('_OVERVIEW_MANAGEMENT',		'Verwaltung');
define('_OVERVIEW_MANAGE',			'Nucleus verwalten...');
define('_MANAGE_GENERAL',			'Verschiedene Einstellungen');
define('_MANAGE_SKINS',				'Skins und Vorlagen');
define('_MANAGE_EXTRA',				'Spezielle Einstellungen');
define('_BACKTOMANAGE',				'Zurü;ck zur Nucleus Verwaltung');

// END introduced after v1.1 END

// charset to use
define('_CHARSET',					'iso-8859-1');

// global stuff
define('_LOGOUT',					'Abmelden');
define('_LOGIN',					'Anmelden');
define('_YES',						'Ja');
define('_NO',						'Nein');
define('_SUBMIT',					'Absenden');
define('_ERROR',					'Fehler');
define('_ERRORMSG',					'Es ist ein Fehler aufgetreten!');
define('_BACK',						'Zurü;ck');
define('_NOTLOGGEDIN',				'Nicht angemeldet');
define('_LOGGEDINAS',				'Angemeldet als');
define('_ADMINHOME',				'Admin Startseite');
define('_NAME',						'Name');
define('_BACKHOME',					'Zurü;ck zur Admin Startseite');
define('_BADACTION',				'Angefragte Aktion existiert nicht');
define('_MESSAGE',					'Nachricht');
define('_HELP_TT',					'Hilfe!');
define('_YOURSITE',					'Ihre Website');
define('_POPUP_CLOSE',				'Fenster schließen');
define('_LOGIN_PLEASE',				'Bitte zuerst anmelden');

// commentform
define('_COMMENTFORM_YOUARE',		'Sie sind');
define('_COMMENTFORM_SUBMIT',		'Kommentar hinzufü;gen');
define('_COMMENTFORM_COMMENT',		'Ihr Kommentar');
define('_COMMENTFORM_NAME',			'Name');
define('_COMMENTFORM_MAIL',			'eMail/HTTP');
define('_COMMENTFORM_REMEMBER',		'Informiere mich');

// loginform
// #################################
define('_LOGINFORM_SHARED',			'Shared Computer');
define('_LOGINFORM_NAME',			'Benutzer');
define('_LOGINFORM_PWD',			'Passwort');
define('_LOGINFORM_YOUARE',			'Angemeldet als');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'Nachricht absenden');

// search form
define('_SEARCHFORM_SUBMIT',		'Suchen');

// add item form

define('_ADD_ADDTO',				'Neuen Artikel hinzufü;gen zu');
define('_ADD_CREATENEW',			'Neuen Artikel erstellen');
define('_ADD_BODY',					'Inhalt');
define('_ADD_TITLE',				'ü;berschrift');
define('_ADD_MORE',					'Erweitert (optional)');
define('_ADD_CATEGORY',				'Kategorie');
define('_ADD_PREVIEW',				'Vorschau');
define('_ADD_DISABLE_COMMENTS',		'Kommentare verbieten?');
define('_ADD_ADDITEM',				'Artikel hinzufü;gen');
define('_ADD_ADDNOW',				'Jetzt hinzufü;gen');
define('_ADD_ADDLATER',				'Spä;ter hinzufü;gen');
define('_ADD_PLACE_ON',				'am');
define('_ADD_ADDDRAFT',				'Zu Entwü;rfen hinzufü;gen');
define('_ADD_DRAFTNFUTURE',			'Entwü;rfe &amp; zukü;nftige Inhalte');
define('_ADD_NOPASTDATES',			'(Datum und Zeiten aus der Vergangenheit sind ungü;ltig, wird durch aktuelles Datum ersetzt)');
define('_ADD_BOLD_TT',				'Fett');
define('_ADD_ITALIC_TT',			'Kursiv');
define('_ADD_HREF_TT',				'Link erstellen');
define('_ADD_MEDIA_TT',				'Bild hinzufü;gen');
define('_ADD_PREVIEW_TT',			'Zeige/Verberge Vorschau');
define('_ADD_CUT_TT',				'Lö;schen');
define('_ADD_COPY_TT',				'Kopieren');
define('_ADD_PASTE_TT',				'Einfü;gen');

// edit item form
define('_EDIT_ITEM',				'Artikel bearbeiten');
define('_EDIT_SUBMIT',				'Artikel freigeben');
define('_EDIT_ORIG_AUTHOR',			'Autor - Urheber');
define('_EDIT_BACKTODRAFTS',		'Entwurf um Hintergrund ergä;nzen');
define('_EDIT_COMMENTSNOTE',		'(Achtung: Beim Ausschalten der Kommentarfunktion bleiben bisherige Kommentare online)');

// used on delete screens
define('_CONFIRMTXT_CATEGORY',		'Sie sind dabei, folgende Kategorie zu lö;schen: ');
define('_DELETE_CONFIRM',			'Bitte Lö;schen bestä;tigen');
define('_DELETE_CONFIRM_BTN',		'Lö;schen bestä;tigen');
define('_CONFIRMTXT_ITEM',			'Sie sind dabei, folgenden Artikel zu lö;schen:');
define('_CONFIRMTXT_COMMENT',		'Sie sind dabei, den folgenden Kommentar zu lö;schen:');
define('_CONFIRMTXT_TEAM1',			'Sie sind dabei ');
define('_CONFIRMTXT_TEAM2',			' aus der Teamliste oder dem Blog zu lö;schen ');
define('_CONFIRMTXT_BLOG',			'Folgendes Weblog soll gelö;scht werden: ');
define('_WARNINGTXT_BLOGDEL',		'Achtung! Beim Lö;schung des Weblogs werden alle Artikel und Kommentare mitgelö;scht. Bitte bestä;tigen Sie diese Aktion noch einmal!<br />Bitte Nukleus wä;hrend des Lö;schvorgangs nicht unterbrechen.');
define('_CONFIRMTXT_MEMBER',		'Sie sind dabei, folgendes Mitglied zu lö;schen: ');
define('_CONFIRMTXT_TEMPLATE',		'Sie sind dabei, folgendes Template zu lö;schen ');
define('_CONFIRMTXT_SKIN',			'Sie sind dabei, folgende Designvorlage zu lö;schen ');
define('_CONFIRMTXT_BAN',			'Sie sind dabei, folgende blockierte IP-Adressen freizugeben');

// some status messages
define('_DELETED_CATEGORY',			'Kategorie gelö;scht');
define('_SKIN_UPDATED',				'Designvorlage wurde gespeichert');
define('_TEMPLATE_UPDATED',			'Template Daten wurden gespeichert');
define('_DELETED_ITEM',				'Artikel gelö;scht');
define('_DELETED_MEMBER',			'Mitglied gelö;scht');
define('_DELETED_COMMENT',			'Kommentar gelö;scht');
define('_DELETED_BLOG',				'Blog gelö;scht');
define('_ITEM_MOVED',				'Artikel verschoben');
define('_ITEM_ADDED',				'Artikel hinzugefü;gt');
define('_COMMENT_UPDATED',			'Kommentar geä;ndert');

// errors
define('_ERROR_COMMENT_LONGWORD',	'Bitte keine Worte mit mehr als 90 Zeichen bei Kommentaren verwenden');
define('_ERROR_COMMENT_NOCOMMENT',	'Bitte einen Kommentar abgeben');
define('_ERROR_COMMENT_NOUSERNAME',	'Username nicht zulä;ssig');
define('_ERROR_COMMENT_TOOLONG',	'Ihr Kommentar ist zu lang (max. 5.000 Zeichen)');
define('_ERROR_COMMENTS_DISABLED',	'Kommentare sind in diesem Bereich momentan nicht mö;glich.');
define('_ERROR_COMMENTS_NONPUBLIC',	'Kommentare kö;nnen hier nur von Mitgliedern abgegeben werden');
define('_ERROR_COMMENTS_MEMBERNICK','Dieser Benutzername ist bereits vergeben. Bitte einen neuen auswä;hlen.');
define('_ERROR_SKIN',				'Fehler in der Designvorlage');
define('_ERROR_ITEMCLOSED',			'Dieser Diskussionspunkt ist geschlossen. Es kö;nnen keine Kommentare vergeben werden.');
define('_ERROR_NOSUCHITEM',			'Dieser Diskussionspunkt existiert nicht');
define('_ERROR_NOSUCHBLOG',			'Weblog nicht vorhanden');
define('_ERROR_NOSUCHSKIN',			'Designvorlage nicht vorhanden');
define('_ERROR_NOSUCHMEMBER',		'Benutzer nicht vorhanden');
define('_ERROR_NOTONTEAM',			'Sie stehen nicht in der Teamliste fü;r dieses Weblog.');
define('_ERROR_BADDESTBLOG',		'Aufgerufenes Weblog existiert nicht');
define('_ERROR_NOTONDESTTEAM',		'Artikel kann nicht in dieses Weblog verschoben werden. Sie sind kein Mitglied dort');
define('_ERROR_NOEMPTYITEMS',		'Leerer Artikel kann nicht hinzugefü;gt werden');
define('_ERROR_BADMAILADDRESS',		'Keine gü;ltige E-Mail-Adresse');
define('_ERROR_BADNOTIFY',			'Eine oder mehrere der angegebenen E-Mail-Adressen ist ungü;ltig');
define('_ERROR_BADNAME',			'Benutzername ungü;ltig (nur a-z und 0-9 gestattet, keine Leerzeichen am Beginn und am Ende)');

define('_ERROR_NICKNAMEINUSE',		'Dieser Spitzname wird von einem anderen Mitglied benutzt');
define('_ERROR_PASSWORDMISMATCH',	'Die Passwö;rter mü;sen ü;bereinstimmen');
define('_ERROR_PASSWORDTOOSHORT',	'Das Passwort sollte aus mindestens 6 Zeichen bestehen');
define('_ERROR_PASSWORDMISSING',	'Das Passwort darf nicht leer sein');
define('_ERROR_REALNAMEMISSING',	'Sie mü;ssen einen echten Namen angeben');
define('_ERROR_ATLEASTONEADMIN',	'Es muss immer ein Super-Administrator vorhanden sein.');
define('_ERROR_ATLEASTONEBLOGADMIN','Wenn Sie dies tun, ist Ihr Weblog nicht mehr bearbeitbar. Sie mü;ssen mindestens einen Administrator bestimmen.');
define('_ERROR_ALREADYONTEAM',		'Mitglied schon vorhanden, kann nicht hinzugefü;gt werden');
define('_ERROR_BADSHORTBLOGNAME',	'Der Kurzname fü;r das Weblog kann nur a-z and 0-9 enthalten, ohne Leerzeichen');
define('_ERROR_DUPSHORTBLOGNAME',	'Dieser Kurzname fü;r ein Weblog ist bereits vergeben');
define('_ERROR_UPDATEFILE',			'Habe keine Schreibrechte fü;r die Update-Datei. Bitte Rechte korrekt einstellen (chmod 666). Bitte berü;cksichtigen, dass der Speicherplatz relativ zum Admin-Verzeichnis liegt, eventuell also absoluten Pfad angeben (z.B. /home/www/site10/web/nucleus/)');
define('_ERROR_DELDEFBLOG',			'Standard Weblog kann nicht gelö;scht werden');
define('_ERROR_DELETEMEMBER',		'Dieses Mitglied kann nicht gelö;scht werden. Vermutlich ist es als Autor gefü;hrt');
define('_ERROR_BADTEMPLATENAME',	'Ungü;ltiger Template Name, nur a-z und 0-9 verwenden, ohne Leerzeichen');
define('_ERROR_DUPTEMPLATENAME',	'Ein Template mit diesem Namen ist bereits vorhanden');
define('_ERROR_BADSKINNAME',		'Ungü;ltiger Name fü;r Designvorlage (nur a-z, 0-9 erlaubt, keine Leerzeichen)');
define('_ERROR_DUPSKINNAME',		'Eine Designvorlage mit diesem Namen ist bereits vorhanden');
define('_ERROR_DEFAULTSKIN',		'Es muss immer eine Designvorlage mit dem Namen "default" vorhanden sein');
define('_ERROR_SKINDEFDELETE',		'Designvorlage \'default\' kann nicht gelö;scht werden fü;r das folgende Weblog: ');
define('_ERROR_DISALLOWED',			'Sie sind zu dieser Aktion nicht berechtigt');
define('_ERROR_DELETEBAN',			'Fehler beim lö;schen des IP-Ban (existiert nicht)');
define('_ERROR_ADDBAN',				'Fehler beim hinzufü;gen des IP-Ban. Mö;glicherweise nicht in allen Weblogs korrekt hinzugefü;gt.');

define('_ERROR_BADACTION',			'Diese Aktion ist nicht mö;glich');
define('_ERROR_MEMBERMAILDISABLED',	'eMails von Mitglied zu Mitglied sind gesperrt');
define('_ERROR_MEMBERCREATEDISABLED','Mitgliedereintrag ist gesperrt');
define('_ERROR_INCORRECTEMAIL',		'Falsche eMail-Adresse');
define('_ERROR_VOTEDBEFORE',		'Sie haben zu diesem Thema schon abgestimmt');
define('_ERROR_BANNED1',			'Aktion nicht durchfü;hrbar, weil Sie (IP-Bereich ');
define('_ERROR_BANNED2',			') hierfü;r gesperrt sind. Ihre Nachricht: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'Fü;r diese Aktion mü;ssen Sie angemeldet sein');
define('_ERROR_CONNECT',			'Verbindungsfehler');
define('_ERROR_FILE_TOO_BIG',		'Datei ist zu gross!');
define('_ERROR_BADFILETYPE',		'Dieser Dateityp ist nicht gestattet');
define('_ERROR_BADREQUEST',			'Upload fehlgeschlagen');
define('_ERROR_DISALLOWEDUPLOAD',	'Sie sind kein Teammitglied. Deshalb dü;rfen Sie keine Dateien hochladen');
define('_ERROR_BADPERMISSIONS',		'Zugriffsrechte fü;r Datei oder Verzeichnis falsch eingestellt');
define('_ERROR_UPLOADMOVEP',		'Datei konnte nicht verschoben werden');
define('_ERROR_UPLOADCOPY',			'Datei konnte nicht kopiert werden');
define('_ERROR_UPLOADDUPLICATE',	'Datei mit diesem Namen bereits vorhanden. Bitte vor dem Upload umbenennen.');
define('_ERROR_LOGINDISALLOWED',	'Sie sind fü;r den Administrationsbereich nicht freigeschaltet. Sie kö;nnen sich als Benutzer anmelden.');
define('_ERROR_DBCONNECT',			'Keine Verbindung zum mySQL-Server');
define('_ERROR_DBSELECT',			'Nucleus Datenbank nicht gefunden');
define('_ERROR_NOSUCHLANGUAGE',		'Keine entsprechende Sprachdatei gefunden');
define('_ERROR_NOSUCHCATEGORY',		'Keine entsprechende Kategorie vorhanden');
define('_ERROR_DELETELASTCATEGORY',	'Es muss mindestens eine Kategorie existieren');
define('_ERROR_DELETEDEFCATEGORY',	'Standard Kategorie kann nicht gelö;scht werden');
define('_ERROR_BADCATEGORYNAME',	'Ungü;ltiger Kategoriename');
define('_ERROR_DUPCATEGORYNAME',	'Eine andere Kategorie deses Namens existiert bereits');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'Achtung: Dieser Wert ist kein Verzeichnis!');
define('_WARNING_NOTREADABLE',		'Achtung: Dieser Wert ist ein nicht-lesbares Verzeichnis!');
define('_WARNING_NOTWRITABLE',		'Achtung: Dieser Wert ist ein kein beschreibbares Verzeichnis!');

// media and upload
define('_MEDIA_UPLOADLINK',			'Neue Datei hochladen');
define('_MEDIA_MODIFIED',			'geä;ndert');
define('_MEDIA_FILENAME',			'Dateiname');
define('_MEDIA_DIMENSIONS',			'Abmessungen');
define('_MEDIA_INLINE',				'Im Text eingebunden');
define('_MEDIA_POPUP',				'Als Popup');
define('_UPLOAD_TITLE',				'Datei auswä;hlen');
define('_UPLOAD_MSG',				'Datei, die Sie hochladen mö;chten, auswä;hlen, und Hochladen-Taste klicken.');
define('_UPLOAD_BUTTON',			'Hochladen');

// some status messages
define('_MSG_ACCOUNTCREATED',		'Konto erstellt, Passwort wird per eMail zugestellt');
define('_MSG_PASSWORDSENT',			'Passwort wurde per eMail zugestellt.');
define('_MSG_LOGINAGAIN',			'Sie mü;ssen sich neu anmelden, da sich Ihre Benutzerdaten geä;ndert haben');
define('_MSG_SETTINGSCHANGED',		'Einstellungen geä;ndert');
define('_MSG_ADMINCHANGED',			'Administrator geä;ndert');
define('_MSG_NEWBLOG',				'Neues Weblog angelegt');
define('_MSG_ACTIONLOGCLEARED',		'Logdatei gelö;scht');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'Verbotene Aktion: ');
define('_ACTIONLOG_PWDREMINDERSENT','Neues Passwort geschickt an ');
define('_ACTIONLOG_TITLE',			'Logdatei');
define('_ACTIONLOG_CLEAR_TITLE',	'Logdatei lö;schen');
define('_ACTIONLOG_CLEAR_TEXT',		'Logdatei jetzt lö;schen');

// team management
define('_TEAM_TITLE',				'Team verwalten fü;r Blog ');
define('_TEAM_CURRENT',				'Derzeitiges Team');
define('_TEAM_ADDNEW',				'Neues Teammitglied hinzufü;gen');
define('_TEAM_CHOOSEMEMBER',		'Teammitglied auswä;hlen');
define('_TEAM_ADMIN',				'Administratorrechte? ');
define('_TEAM_ADD',					'Zum Team hinzufü;gen');
define('_TEAM_ADD_BTN',				'Zum Team hinzufü;gen');

// blogsettings
define('_EBLOG_DEFCAT',				'Standard Kategorie');
define('_EBLOG_NOTIFY_ON',			'Benachrichtigung ein');
define('_EBLOG_NOTIFY_COMMENT',		'Neue Kommentare');
define('_EBLOG_NOTIFY_KARMA',		'Neue Karma-Abstimmungsergebnisse');
define('_EBLOG_NOTIFY_ITEM',		'Neue Weblog Einträ;ge');
define('_EBLOG_CAT_TITLE',			'Kategorien');
define('_EBLOG_CAT_NAME',			'Kategoriename');
define('_EBLOG_CAT_DESC',			'Kategoriebeschreibung');
define('_EBLOG_CAT_CREATE',			'Erzeuge neue Kategorie');
define('_EBLOG_CAT_UPDATE',			'Kategorie aktualisieren');
define('_EBLOG_CAT_UPDATE_BTN',		'Kategorie aktualisieren');
define('_EBLOG_TITLE',				'Weblog Einstellungen bearbeiten');
define('_EBLOG_TEAM_TITLE',			'Team verwalten');
define('_EBLOG_TEAM_TEXT',			'Hier klicken um das Team zu verwalten');
define('_EBLOG_SETTINGS_TITLE',		'Einstellungen');
define('_EBLOG_NAME',				'Name');
define('_EBLOG_SHORTNAME',			'Kurzname');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(nur a-z und keine Leerzeichen)');
define('_EBLOG_DESC',				'Beschreibung');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'Standard Designvorlage');
define('_EBLOG_LINEBREAKS',			'Zeilenumbrü;che automatisch konvertieren');
define('_EBLOG_DISABLECOMMENTS',	'Kommentare erlauben?<br /><small>(Wenn nicht erlaubt, sind Kommentare unmö;glich.)</small>');
define('_EBLOG_ANONYMOUS',			'Kommentare auch Nicht-Mitgliedern gestatten?');
define('_EBLOG_NOTIFY',				'Benachrichtigungs Addresse(n) (verwenden Sie ; als Trennzeichen)');
define('_EBLOG_PING',				'Weblogs.com bei ä;nderungen anpingen?');
define('_EBLOG_MAXCOMMENTS',		'Maximale Kommentarzahl');
define('_EBLOG_UPDATE',				'Update Datei');
define('_EBLOG_OFFSET',				'Zeitverschiebung');
define('_EBLOG_STIME',				'Aktuelle Serverzeit ist');
define('_EBLOG_BTIME',				'Aktuelle Systemzeit ist');
define('_EBLOG_CHANGE',				'ä;ndern');
define('_EBLOG_CHANGE_BTN',			'ä;ndern');
define('_EBLOG_ADMIN',				'Administrator');
define('_EBLOG_ADMIN_MSG',			'Sie besitzen Administratorrechte');
define('_EBLOG_CREATE_TITLE',		'Neues Weblog erstellen');
define('_EBLOG_CREATE_TEXT',		'Formular ausfü;llen, um ein neues Weblog zu erstellen. <br /><br /> <b>Achtung:</b> Nur die notwendigsten Einstellungen sind hier aufgefü;hrt. Weitere Einstellungen lassen sich anschliessend ü;ber die Weblog-Einstellungen vornehmen.');
define('_EBLOG_CREATE',				'Erstellen!');
define('_EBLOG_CREATE_BTN',			'Weblog erstellen');

// templates
define('_TEMPLATE_TITLE',			'Templates bearbeiten');
define('_TEMPLATE_AVAILABLE_TITLE',	'Verfü;gbare Templates');
define('_TEMPLATE_NEW_TITLE',		'Neues Template');
define('_TEMPLATE_NAME',			'Template Name');
define('_TEMPLATE_DESC',			'Template Beschreibung');
define('_TEMPLATE_CREATE',			'Template erstellen');
define('_TEMPLATE_CREATE_BTN',		'Template erstellen');
define('_TEMPLATE_EDIT_TITLE',		'Template bearbeiten');
define('_TEMPLATE_BACK',			'Zurü;ck zur Template ü;bersicht');
define('_TEMPLATE_EDIT_MSG',		'Nicht alle Teile des Templates werden gebraucht, bitte nicht benö;tigte einfach leer lassen.');
define('_TEMPLATE_SETTINGS',		'Template Einstellungen');
define('_TEMPLATE_ITEMS',			'Artikel');
define('_TEMPLATE_ITEMHEADER',		'Artikel Kopfzeile');
define('_TEMPLATE_ITEMBODY',		'Artikel Inhalt');
define('_TEMPLATE_ITEMFOOTER',		'Artikel Fusszeile');
define('_TEMPLATE_MORELINK',		'Link zu ausfü;hrlicherem Beitrag');
define('_TEMPLATE_NEW',				'Eigenschaften des neuen Artikels');
define('_TEMPLATE_COMMENTS_ANY',	'Kommentare (falls vorhanden)');
define('_TEMPLATE_CHEADER',			'Kommentar ü;berschrift');
define('_TEMPLATE_CBODY',			'Kommentar Inhalt');
define('_TEMPLATE_CFOOTER',			'Kommentar Fusszeile');
define('_TEMPLATE_CONE',			'Ein Kommentar');
define('_TEMPLATE_CMANY',			'Zwei (oder mehr) Kommentare');
define('_TEMPLATE_CMORE',			'Weitere Kommentare lesen');
define('_TEMPLATE_CMEXTRA',			'Mitglieder Extra');
define('_TEMPLATE_COMMENTS_NONE',	'Kommentare (falls keine vorhanden)');
define('_TEMPLATE_CNONE',			'Keine Kommentare');
define('_TEMPLATE_COMMENTS_TOOMUCH','Kommentare (falls vorhanden, aber zu viele, um sie hier darzustellen)');
define('_TEMPLATE_CTOOMUCH',		'Zu viele Kommentare');
define('_TEMPLATE_ARCHIVELIST',		'Archivliste');
define('_TEMPLATE_AHEADER',			'Archivliste ü;berschriften');
define('_TEMPLATE_AITEM',			'Archivliste Artikel');
define('_TEMPLATE_AFOOTER',			'Archivliste Fusszeilen');
define('_TEMPLATE_DATETIME',		'Datum und Uhrzeit');
define('_TEMPLATE_DHEADER',			'Datum Kopfzeile');
define('_TEMPLATE_DFOOTER',			'Datum Fusszeile');
define('_TEMPLATE_DFORMAT',			'Datum Format');
define('_TEMPLATE_TFORMAT',			'Uhrzeit Format');
define('_TEMPLATE_LOCALE',			'Lokale Umgebungseinstellung');
define('_TEMPLATE_IMAGE',			'Bild-Popups');
define('_TEMPLATE_PCODE',			'Popup Link Code');
define('_TEMPLATE_ICODE',			'Eingebundenes Bild Code');
define('_TEMPLATE_MCODE',			'Media Link Code');
define('_TEMPLATE_SEARCH',			'Suchen');
define('_TEMPLATE_SHIGHLIGHT',		'Hervorheben');
define('_TEMPLATE_SNOTFOUND',		'Suche ergab keine Ergebnisse');
define('_TEMPLATE_UPDATE',			'Neu speichern');
define('_TEMPLATE_UPDATE_BTN',		'Template neu speichern');
define('_TEMPLATE_RESET_BTN',		'Zurü;cksetzen');
define('_TEMPLATE_CATEGORYLIST',	'Kategorielisten');
define('_TEMPLATE_CATHEADER',		'Kategorielisten ü;berschriften');
define('_TEMPLATE_CATITEM',			'Kategorielisten Artikel');
define('_TEMPLATE_CATFOOTER',		'Kategorielisten Fusszeilen');

// skins
define('_SKIN_TYPE',				'Inhaltstyp');
define('_SKIN_EDIT_TITLE',			'Designvorlagen bearbeiten');
define('_SKIN_AVAILABLE_TITLE',		'Verfü;gbare Designvorlagen');
define('_SKIN_NEW_TITLE',			'Neue Designvorlage');
define('_SKIN_NAME',				'Name');
define('_SKIN_DESC',				'Beschreibung');
define('_SKIN_CREATE',				'Erstellen');
define('_SKIN_CREATE_BTN',			'Designvorlage erstellen');
define('_SKIN_EDITONE_TITLE',		'Designvorlage bearbeiten');
define('_SKIN_BACK',				'Zurü;ck zum ü;berblick Designvorlagen');
define('_SKIN_PARTS_TITLE',			'Designvorlagen-Teile');
define('_SKIN_PARTS_MSG',			'Nicht alle Teile werden fü;r Designvorlagen benö;tigt. Nicht benö;tigte Teile leer lassen. Designvorlage zum Bearbeiten auswä;hlen:');
define('_SKIN_PART_MAIN',			'Hauptseite');
define('_SKIN_PART_ITEM',			'Artikelseiten');
define('_SKIN_PART_ALIST',			'Archivliste');
define('_SKIN_PART_ARCHIVE',		'Archiv');
define('_SKIN_PART_SEARCH',			'Suchen');
define('_SKIN_PART_ERROR',			'Fehler');
define('_SKIN_PART_MEMBER',			'Benutzerinformationen');
define('_SKIN_PART_POPUP',			'Popup-Bilder');
define('_SKIN_GENSETTINGS_TITLE',	'Allgemeine Einstellungen');
define('_SKIN_CHANGE',				'ä;ndern');
define('_SKIN_CHANGE_BTN',			'Diese Einstellungen ä;ndern');
define('_SKIN_UPDATE_BTN',			'Designvorlage neu speichern');
define('_SKIN_RESET_BTN',			'Zurü;cksetzen');
define('_SKIN_EDITPART_TITLE',		'Designvorlage bearbeiten');
define('_SKIN_GOBACK',				'Zurü;ck');
define('_SKIN_ALLOWEDVARS',			'Gü;ltige Variablen (klicken fü;r mehr Infos):');

// global settings
define('_SETTINGS_COOKIEPATH',		'Cookie-Pfad (fortgeschritten)');
define('_SETTINGS_COOKIEDOMAIN',	'Cookie-Domain (fortgeschritten)');
define('_SETTINGS_COOKIESECURE',	'Secure Cookie (fortgeschritten)');
define('_SETTINGS_MEDIA',			'Media/Upload Einstellungen');
define('_SETTINGS_MEDIAPREFIX',		'Hochgeladenen Dateien ein Datum voranstellen');
define('_SETTINGS_MEMBERS',			'Mitglieder Einstellungen');
define('_SETTINGS_TITLE',			'Allgemeine Einstellungen');
define('_SETTINGS_SUB_GENERAL',		'Allgemeine Einstellungen');
define('_SETTINGS_DEFBLOG',			'Standard Weblog');
define('_SETTINGS_ADMINMAIL',		'Administrator eMail');
define('_SETTINGS_SITENAME',		'Site-Name');
define('_SETTINGS_SITEURL',			'URL der Website (endet mit /)');
define('_SETTINGS_ADMINURL',		'URL des Administrator-Bereichs (endet mit /)');
define('_SETTINGS_DIRS',			'Nucleus Verzeichnisse');
define('_SETTINGS_MEDIADIR',		'Medien-Verzeichnis');
define('_SETTINGS_SEECONFIGPHP',	'(config.php beachten)');
define('_SETTINGS_MEDIAURL',		'Medien-URL (endet mit /)');
define('_SETTINGS_ALLOWUPLOAD',		'Datei-Upload gestatten?');
define('_SETTINGS_ALLOWUPLOADTYPES','Gü;ltige Dateitypen fü;r den Upload');
define('_SETTINGS_CHANGELOGIN',		'Benutzer dü;rfen Name/Passwort ä;ndern');
define('_SETTINGS_COOKIELIFE',		'Lebensdauer Cookie fü;r Benutzer');
define('_SETTINGS_COOKIESESSION',	'Sitzungs-Cookies');
define('_SETTINGS_COOKIEMONTH',		'Lebensdauer ein Monat');
define('_SETTINGS_LASTVISIT',		'Cookie des letzten Besuchs speichern');
define('_SETTINGS_ALLOWCREATE',		'Besuchern die Einrichtung eines Benutzer-Konto gestatten');
define('_SETTINGS_NEWLOGIN',		'Anmelden mit selbst erstelltem Konto gestatten');
define('_SETTINGS_NEWLOGIN2',		'(gilt nur fü;r neue Benutzer-Konten)');
define('_SETTINGS_MEMBERMSGS',		'Mitglied-zu-Mitglied-Kommunikation gestatten');
define('_SETTINGS_LANGUAGE',		'Standard Sprachmodul');
define('_SETTINGS_DISABLESITE',		'Seite offline schalten');
define('_SETTINGS_DBLOGIN',			'mySQL Anmeldung &amp; Datenbank');
define('_SETTINGS_UPDATE',			'Einstellungen speichern');
define('_SETTINGS_UPDATE_BTN',		'Einstellungen speichern');
define('_SETTINGS_DISABLEJS',		'JavaScript Werkzeuge ausschalten');

// bans
define('_BAN_TITLE',				'Zugriff verweigern fü;r');
define('_BAN_NONE',					'Keine Zugriffsperren fü;r dieses Weblog');
define('_BAN_NEW_TITLE',			'Neue Zugriffssperre erstellen');
define('_BAN_NEW_TEXT',				'Neue Zugriffssperre hinzufü;gen');
define('_BAN_REMOVE_TITLE',			'Zugriffssperre lö;schen');
define('_BAN_IPRANGE',				'IP-Bereich');
define('_BAN_BLOGS',				'Welche Weblogs?');
define('_BAN_DELETE_TITLE',			'Zugriffssperre lö;schen');
define('_BAN_ALLBLOGS',				'Alle Zugriffssperren in Ihrem Admin-Bereich.');
define('_BAN_REMOVED_TITLE',		'Zugriffssperre gelö;scht');
define('_BAN_REMOVED_TEXT',			'Zugriffssperre in folgenden Weblogs gelö;scht:');
define('_BAN_ADD_TITLE',			'Zugriffssperre hinzufü;gen');
define('_BAN_IPRANGE_TEXT',			'Zu sperrenden IP-Bereich auswä;hlen. Je weniger Nummern, desto mehr Benutzer werden blockiert.');
define('_BAN_BLOGS_TEXT',			'Sie kö;nnen wahlweise nur ein Weblog sperren oder alle Punkte in Ihrem Admin-Bereich. Bitte auswä;hlen.');
define('_BAN_REASON_TITLE',			'Grund');
define('_BAN_REASON_TEXT',			'Sie kö;nnen die Zugriffssperre begrü;nden, dies wird dem Benutzer angezeigt. Maximal 256 Zeichen.');
define('_BAN_ADD_BTN',				'Zugriffssperre hinzufü;gen');

// LOGIN screen
define('_LOGIN_MESSAGE',			'Nachricht');
define('_LOGIN_NAME',				'Name');
define('_LOGIN_PASSWORD',			'Passwort');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'Passwort vergessen?');

// membermanagement
define('_MEMBERS_DEFLANG',			'Sprache');
define('_MEMBERS_USESITELANG',		'- Site-Einstellungen verwenden -');
define('_MEMBERS_TITLE',			'Benutzerverwaltung');
define('_MEMBERS_CURRENT',			'Aktuelle Benutzer');
define('_MEMBERS_NEW',				'Neuer Benutzer');
define('_MEMBERS_DISPLAY',			'Name anzeigen');
define('_MEMBERS_DISPLAY_INFO',		'(Mit diesem Namen melden Sie sich an)');
define('_MEMBERS_REALNAME',			'Vollstä;ndiger Name');
define('_MEMBERS_PWD',				'Passwort');
define('_MEMBERS_REPPWD',			'Paswort wiederholen');
define('_MEMBERS_EMAIL',			'eMail');
define('_MEMBERS_EMAIL_EDIT',		'(Beim ä;ndern der eMail-Adresse erhalten Sie umgehend ein neues Passwort per Mail)');
define('_MEMBERS_URL',				'Homepage Adresse (URL)');
define('_MEMBERS_SUPERADMIN',		'Administratorrechte');
define('_MEMBERS_CANLOGIN',			'Darf sich in den Admin-Bereich einloggen');
define('_MEMBERS_NOTES',			'Bemerkungen');
define('_MEMBERS_NEW_BTN',			'Benutzer hinzufü;gen');
define('_MEMBERS_EDIT',				'Benutzer bearbeiten');
define('_MEMBERS_EDIT_BTN',			'Einstellungen ä;ndern');
define('_MEMBERS_BACKTOOVERVIEW',	'Zurü;ck zur Benutzerverwaltung');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Bookmarklet');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_TT_VISIT',		'Webseite auswä;hlen');
define('_BLOGLIST_ADD',				'Artikel hinzufü;gen');
define('_BLOGLIST_TT_ADD',			'Neuen Artikel zu diesem Weblog hinzufü;gen');
define('_BLOGLIST_EDIT',			'Artikel bearbeiten oder lö;schen');
define('_BLOGLIST_BMLET',			'Favoritenverwaltung');
define('_BLOGLIST_SETTINGS',		'Einstellungen');
define('_BLOGLIST_TT_SETTINGS',		'Einstellungen ä;ndern oder Team verwalten');
define('_BLOGLIST_BANS',			'Zugriffssperren');
define('_BLOGLIST_TT_BANS',			'Zugriffssperren verwalten');
define('_BLOGLIST_DELETE',			'Alles lö;schen');
define('_BLOGLIST_TT_DELETE',		'Lö;sche dieses Weblog');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'Ihre Weblogs');
define('_OVERVIEW_YRDRAFTS',		'Ihre Entwü;rfe');
define('_OVERVIEW_YRSETTINGS',		'Ihre Einstellungen');
define('_OVERVIEW_GSETTINGS',		'Allgemeine Einstellungen');
define('_OVERVIEW_NOBLOGS',			'Sie sind nicht als Benutzer aufgefü;hrt');
define('_OVERVIEW_NODRAFTS',		'Keine Entwü;rfe');
define('_OVERVIEW_EDITSETTINGS',	'Ihre Einstellungen bearbeiten...');
define('_OVERVIEW_BROWSEITEMS',		'Ihre Artikel auflisten...');
define('_OVERVIEW_BROWSECOMM',		'Ihre Kommentare auflisten...');
define('_OVERVIEW_VIEWLOG',			'Logdatei anschauen...');
define('_OVERVIEW_MEMBERS',			'Benutzer verwalten...');
define('_OVERVIEW_NEWLOG',			'Neues Weblog erstellen...');
define('_OVERVIEW_SETTINGS',		'Einstellungen bearbeiten...');
define('_OVERVIEW_TEMPLATES',		'Templates bearbeiten...');
define('_OVERVIEW_SKINS',			'Designvorlagen bearbeiten...');
define('_OVERVIEW_BACKUP',			'Sichern/Wiederherstellen...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'Artikel in diesem Blog');
define('_ITEMLIST_YOUR',			'Ihre Artikel');

// Comments
define('_COMMENTS',					'Kommentare');
define('_NOCOMMENTS',				'Keine Kommentare zu diesem Artikel');
define('_COMMENTS_YOUR',			'Ihre Kommentare');
define('_NOCOMMENTS_YOUR',			'Sie haben keine Kommentare verfasst.');


// LISTS (general)
define('_LISTS_TYPE',				'Typ');
define('_LISTS_NOMORE',				'Keine (weiteren) Ergebnisse');
define('_LISTS_PREV',				'Zurü;ck');
define('_LISTS_NEXT',				'Weiter');
define('_LISTS_SEARCH',				'Suchen');
define('_LISTS_CHANGE',				'ä;ndern');
define('_LISTS_PERPAGE',			'Artikel/Seite');
define('_LISTS_ACTIONS',			'Aktionen');
define('_LISTS_DELETE',				'Lö;schen');
define('_LISTS_EDIT',				'Bearbeiten');
define('_LISTS_MOVE',				'Verschieben');
define('_LISTS_CLONE',				'Kopieren');
define('_LISTS_TITLE',				'Titel');
define('_LISTS_BLOG',				'Hauptpunkt');
define('_LISTS_NAME',				'Name');
define('_LISTS_DESC',				'Beschreibung');
define('_LISTS_TIME',				'Uhrzeit');
define('_LISTS_COMMENTS',			'Kommentare');

// member list
define('_LIST_MEMBER_NAME',			'Name anzeigen');
define('_LIST_MEMBER_RNAME',		'Vollstä;ndiger Name');
define('_LIST_MEMBER_ADMIN',		'Super-Administrator? ');
define('_LIST_MEMBER_LOGIN',		'Kann sich anmelden? ');
define('_LIST_MEMBER_URL',			'Homepage');

// banlist
define('_LIST_BAN_IPRANGE',			'IP-Bereich');
define('_LIST_BAN_REASON',			'Grund');

// actionlist
define('_LIST_ACTION_MSG',			'Nachricht');

// commentlist
define('_LIST_COMMENT_BANIP',		'IP sperren');
define('_LIST_COMMENT_WHO',			'Autor');
define('_LIST_COMMENT',				'Kommentar');
define('_LIST_COMMENT_HOST',		'Host');

// itemlist
define('_LIST_ITEM_INFO',			'Info');
define('_LIST_ITEM_CONTENT',		'ü;berschrift und Text');


// teamlist
define('_LIST_TEAM_ADMIN',			'Administrator ');
define('_LIST_TEAM_CHADMIN',		'Administrator ä;ndern');

// edit comments
define('_EDITC_TITLE',				'Kommentare bearbeiten');
define('_EDITC_WHO',				'Autor');
define('_EDITC_HOST',				'Von wo?');
define('_EDITC_WHEN',				'Wann?');
define('_EDITC_TEXT',				'Text');
define('_EDITC_EDIT',				'Kommentar bearbeiten');
define('_EDITC_MEMBER',				'Mitglied');
define('_EDITC_NONMEMBER',			'kein Mitglied');

// move item
define('_MOVE_TITLE',				'In welchen Hauptpunkt verschieben?');
define('_MOVE_BTN',					'Artikel verschieben');
