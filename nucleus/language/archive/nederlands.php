<?php
// Dutch Nucleus Language File
//
// Updates:
// - Nucleus v2.5-3.1 Norbert (beckerswna@yahoo.com)
// - Nucleus v1.0-2.5 Wouter Demuynck (nucleuscms.org)
//
// Please note: if you want to translate this file to your own language, be aware
// that in a next Nucleus version, new variables might be added and some other ones
// might be deleted. Therefor, it's important to list the Nucleus version for which
// the file was written in your document.
//
// Fully translated language file can be sent to us
// and will be available for download (with proper credit to the author, of course)
//
// Oct 7, 2005 - Translation fine-tuned and spellingcorrection by Errie (http://getverd.errie.com
//

// START changed/added after 3.22 START
define('_ERROR_EMAIL_REQUIRED',		'Email adres is verplicht');
define('_COMMENTFORM_MAIL',			'Website');
define('_COMMENTFORM_EMAIL',		'E-mail');
define('_EBLOG_REQUIREDEMAIL',		'Verplicht E-mail adres bij reacties?');
// END changed/added after 3.22 END


// START changed/added after 3.15 START
define('_LIST_PLUG_SUBS_NEEDUPDATE','Gelieve de \'Plugin Subscriptions vernieuwen\'-knop te gebruiken om de subscription-lijst van deze plugin te vernieuwen');
define('_LIST_PLUGS_DEP',			'Plugin(s) is afhankelijk van:');
// END changed/added after 3.15 STAT

// START changed/added after 3.1 START

// comments list per weblog
define('_COMMENTS_BLOG',			'Alle reacties voor blog');
define('_NOCOMMENTS_BLOG',			'Er zijn geen reacties voor dit weblog.');
define('_BLOGLIST_COMMENTS',		'Reacties');
define('_BLOGLIST_TT_COMMENTS',		'Een lijst van alle reacties voor dit weblog.');


// for use in archivetype-skinvar
define('_ARCHIVETYPE_DAY',			'dag');
define('_ARCHIVETYPE_MONTH',		'maand');

// tickets (prevents malicious users to trick an admin to perform actions he doesn't want)
define('_ERROR_BADTICKET',			'Ongeldig ticket.');

// plugin dependency
define('_ERROR_INSREQPLUGIN',		'Plugin kon niet ge�nstalleerd worden: vereist ');
define('_ERROR_DELREQPLUGIN',		'Plugin kon niet verwijderd worden: vereist door ');

// cookie prefix
define('_SETTINGS_COOKIEPREFIX',	'Cookie Prefix');

// account activation
define('_ERROR_NOLOGON_NOACTIVATE',	'Kan geen activatielink sturen. Het is jou niet toegestaan in te loggen.');
define('_ERROR_ACTIVATE',			'De activatiesleutel bestaat niet, is niet geldig of is verlopen.');
define('_ACTIONLOG_ACTIVATIONLINK', 'Activatielink verstuurd');
define('_MSG_ACTIVATION_SENT',		'Een activatielink is verstuurd per e-mail.');

// activation link emails
define('_ACTIVATE_REGISTER_MAIL',	"Hallo <%memberName%>,\n\nJe moet je account van <%siteName%> (<%siteUrl%>) activeren.\nDit kun je doen door op de volgende link te klikken: \n\n\t<%activationUrl%>\n\nHiervoor heb je 2 dagen de tijd. Hierna wordt de activatielink ongeldig.");
define('_ACTIVATE_REGISTER_MAILTITLE',	"Activeer je '<%memberName%>' account");
define('_ACTIVATE_REGISTER_TITLE',	'Welkom <%memberName%>');
define('_ACTIVATE_REGISTER_TEXT',	'Je bent er bijna. Kies AUB een wacht woord voor je account.');
define('_ACTIVATE_FORGOT_MAIL',		"Hallo <%memberName%>,\n\nMet de volgende link kan je een nieuw wachtwoord kiezen voor je account op <%siteName%> (<%siteUrl%>) door \'Nieuw wachtwoord\' te kiezen.\n\n\t<%activationUrl%>\n\nHiervoor heb je 2 dagen de tijd. Hierna wordt de activatielink ongeldig.");
define('_ACTIVATE_FORGOT_MAILTITLE',"Her-activeer je '<%memberName%>' account");
define('_ACTIVATE_FORGOT_TITLE',	'Welkom <%memberName%>');
define('_ACTIVATE_FORGOT_TEXT',		'Je kan een nieuw wachtwoord kiezen voor je account:');
define('_ACTIVATE_CHANGE_MAIL',		"Hallo <%memberName%>,\n\nJe account op <%siteName%> (<%siteUrl%>) moet opnieuw worden geactiveerd omdat je je adres hebt veranderd.\nDit kun je doen door op de volgende link te klikken: \n\n\t<%activationUrl%>\n\nHiervoor heb je 2 dagen de tijd. Hierna wordt de activatielink ongeldig.");
define('_ACTIVATE_CHANGE_MAILTITLE',"Her-activeer je '<%memberName%>' account");
define('_ACTIVATE_CHANGE_TITLE',	'Welkom <%memberName%>');
define('_ACTIVATE_CHANGE_TEXT',		'Jouw adres wijziging is bevestigd. Bedankt!');
define('_ACTIVATE_SUCCESS_TITLE',	'Activatie geslaagd');
define('_ACTIVATE_SUCCESS_TEXT',	'Je account is succesvol geactiveerd.');
define('_MEMBERS_SETPWD',			'Wachtwoord instellen');
define('_MEMBERS_SETPWD_BTN',		'Wachtwoord instellen');
define('_QMENU_ACTIVATE',			'Account Activatie');
define('_QMENU_ACTIVATE_TEXT',		'<p>Nadat je je account hebt geactiveerd kan je het beginnen te gebruiken door <a href="index.php?action=showlogin">in te loggen</a>.</p>');

define('_PLUGS_BTN_UPDATE',			'Aanmeldingslijst bijwerken');

// global settings
define('_SETTINGS_JSTOOLBAR',		'Javascript Toolbar Stijl');
define('_SETTINGS_JSTOOLBAR_FULL',	'Volledige Toolbar (IE)');
define('_SETTINGS_JSTOOLBAR_SIMPLE','Simpele Toolbar (Niet-IE)');
define('_SETTINGS_JSTOOLBAR_NONE',	'Toolbar uitschakelen');
define('_SETTINGS_URLMODE_HELP',	'(Info: <a href="documentation/tips.html#searchengines-fancyurls">Hoe schakel ik \'fancy URLs\' in</a>)');

// extra plugin settings part when editing categories/members/blogs/...
define('_PLUGINS_EXTRA',			'Extra Plugin Instellingen');

// itemlist info column keys
define('_LIST_ITEM_BLOG',			'blog:');
define('_LIST_ITEM_CAT',			'cat:');
define('_LIST_ITEM_AUTHOR',			'auteur:');
define('_LIST_ITEM_DATE',			'datum:');
define('_LIST_ITEM_TIME',			'tijd:');

// indication of registered members in comments list
define('_LIST_COMMENTS_MEMBER', 	'(lid)');

// batch operations
define('_BATCH_WITH_SEL',			'met geselecteerde:');
define('_BATCH_EXEC',				'Uitvoeren');

// quickmenu
define('_QMENU_HOME',				'Home');
define('_QMENU_ADD',				'Bericht toevoegen');
define('_QMENU_ADD_SELECT',			'- selecteren -');
define('_QMENU_USER_SETTINGS',		'Instellingen');
define('_QMENU_USER_ITEMS',			'Berichten');
define('_QMENU_USER_COMMENTS',		'Commentaar');
define('_QMENU_MANAGE',				'Beheer');
define('_QMENU_MANAGE_LOG',			'Actie Log');
define('_QMENU_MANAGE_SETTINGS',	'Globale instellingen');
define('_QMENU_MANAGE_MEMBERS',		'leden');
define('_QMENU_MANAGE_NEWBLOG',		'Nieuwe Weblog');
define('_QMENU_MANAGE_BACKUPS',		'Backups');
define('_QMENU_MANAGE_PLUGINS',		'Plugins');
define('_QMENU_LAYOUT',				'Layout');
define('_QMENU_LAYOUT_SKINS',		'Skins');
define('_QMENU_LAYOUT_TEMPL',		'Sjablonen');
define('_QMENU_LAYOUT_IEXPORT',		'Import/Export');
define('_QMENU_PLUGINS',			'Plugins');

// quickmenu on logon screen
define('_QMENU_INTRO',				'Introductie');
define('_QMENU_INTRO_TEXT',			'<p>Dit is het loginscherm van NucleusCMS, Het Content Beheer Systeem dat wordt gebruikt om deze website te beheren.</p><p>Als je een account hebt, kun je inloggen en beginnen met berichten te plaatsen.</p>');

// helppages for plugins
define('_ERROR_PLUGNOHELPFILE',		'Het helpbestand van de plugin kan niet worden gevonden');
define('_PLUGS_HELP_TITLE',			'Helppagina voor plugin');
define('_LIST_PLUGS_HELP', 			'help');

// END changed/started after 3.1

// START changed/added after v2.5beta START

// general settings (security)
define('_SETTINGS_EXTAUTH',			'Externe Authenticatie Toelaten');
define('_WARNING_EXTAUTH',			'Let op: Alleen inschakelen wanneer echt noodzakelijk!');

// member profile
define('_MEMBERS_BYPASS',			'Externe Authenticatie gebruiken');

// 'always include in search' blog setting (yes/no) [in v2.5beta, the 'always' part wasn't clear]
define('_EBLOG_SEARCH',				'<em>Altijd</em> opnemen in zoekopdrachten');

// END changed after v2.5beta

// START introduced after v2.0 START

// media library
define('_MEDIA_VIEW',				'bekijk');
define('_MEDIA_VIEW_TT',			'Bekijken (opent in nieuw venster)');
define('_MEDIA_FILTER_APPLY',		'Filter Toepassen');
define('_MEDIA_FILTER_LABEL',		'Filter: ');
define('_MEDIA_UPLOAD_TO',			'Upload naar...');
define('_MEDIA_UPLOAD_NEW',			'Upload nieuw bestand...');
define('_MEDIA_COLLECTION_SELECT',	'Kies');
define('_MEDIA_COLLECTION_TT',		'Overschakelen naar deze collectie');
define('_MEDIA_COLLECTION_LABEL',	'Huidige collectie: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'Links uitlijnen');
define('_ADD_ALIGNRIGHT_TT',		'Rechts uitlijnen');
define('_ADD_ALIGNCENTER_TT',		'Centreren');

// generic upload failure
define('_ERROR_UPLOADFAILED',		'Upload is mislukt');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'Berichten anti-dateren toelaten');
define('_ADD_CHANGEDATE',			'Datum aanpassen');
define('_BMLET_CHANGEDATE',			'Datum aanpassen');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'Skin import/export...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Normaal');
define('_PARSER_INCMODE_SKINDIR',	'Gebruik skin dir');
define('_SKIN_INCLUDE_MODE',		'Include mode');
define('_SKIN_INCLUDE_PREFIX',		'Include prefix');

// global settings
define('_SETTINGS_BASESKIN',		'Basis skin');
define('_SETTINGS_SKINSURL',		'Skins URL');
define('_SETTINGS_ACTIONSURL',		'Volledige URL naar action.php');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'Kan default categorie niet verplaatsen');
define('_ERROR_MOVETOSELF',			'Kan categorie niet verplaatsen (doelblog = bronblog)');
define('_MOVECAT_TITLE',			'Kies weblog waar categorie heen moet');
define('_MOVECAT_BTN',				'Categorie verplaatsen');

// URLMode setting
define('_SETTINGS_URLMODE',			'URL Mode');
define('_SETTINGS_URLMODE_NORMAL',	'Normaal');
define('_SETTINGS_URLMODE_PATHINFO','Fancy');

// Batch operations
define('_BATCH_NOSELECTION',		'Er werd niks geselecteerd');
define('_BATCH_ITEMS',				'Groepbewerking op berichten');
define('_BATCH_CATEGORIES',			'Groepbewerking op categorie�n');
define('_BATCH_MEMBERS',			'Groepbewerking op leden');
define('_BATCH_TEAM',				'Groepbewerking op teamleden');
define('_BATCH_COMMENTS',			'Groepbewerking op reacties');
define('_BATCH_UNKNOWN',			'Ongekende bewerking: ');
define('_BATCH_EXECUTING',			'Bezig met uivoeren van');
define('_BATCH_ONCATEGORY',			'op categorie');
define('_BATCH_ONITEM',				'op bericht');
define('_BATCH_ONMEMBER',			'op lid');
define('_BATCH_ONTEAM',				'op teamlid');
define('_BATCH_ONCOMMENT',			'op reactie');
define('_BATCH_SUCCESS',			'Succes!');
define('_BATCH_DONE',				'Klaar!');
define('_BATCH_DELETE_CONFIRM',		'Bevestigen wissen geselecteerde items');
define('_BATCH_DELETE_CONFIRM_BTN',	'Wissen bevestigen');
define('_BATCH_SELECTALL',			'selecteer alles');
define('_BATCH_DESELECTALL',		'deselecteer alles');


// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'Verwijderen');
define('_BATCH_ITEM_MOVE',			'Verplaatsen');
define('_BATCH_MEMBER_DELETE',		'Verwijderen');
define('_BATCH_MEMBER_SET_ADM',		'Admin-rechten toekennen');
define('_BATCH_MEMBER_UNSET_ADM',	'Admin-rechten wegnemen');
define('_BATCH_TEAM_DELETE',		'Uit team verwijderen');
define('_BATCH_TEAM_SET_ADM',		'Admin-rechten toekennen');
define('_BATCH_TEAM_UNSET_ADM',		'Admin-rechten wegnemen');
define('_BATCH_CAT_DELETE',			'Verwijderen');
define('_BATCH_CAT_MOVE',			'Verplaatsen naar andere weblog');
define('_BATCH_COMMENT_DELETE',		'Verwijderen');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'Nieuw bericht toevoegen...');
define('_ADD_PLUGIN_EXTRAS',		'Extra Plugin Opties');

// errors
define('_ERROR_CATCREATEFAIL',		'Kon nieuwe categorie niet aanmaken');
define('_ERROR_NUCLEUSVERSIONREQ',	'Deze plugin vereist een nieuwere Nucleus versie: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Terug naar instellingen');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Importeren');
define('_SKINIE_TITLE_EXPORT',		'Exporteren');
define('_SKINIE_BTN_IMPORT',		'Importeren');
define('_SKINIE_BTN_EXPORT',		'Geselecteerde skins/sjabloon exporteren');
define('_SKINIE_LOCAL',				'Importeren van bestand op server:');
define('_SKINIE_NOCANDIDATES',		'Geen skins gevonden');
define('_SKINIE_FROMURL',			'Importeren van URL:');
define('_SKINIE_EXPORT_INTRO',		'Selecteer de skins en templated die je wilt exporteren:');
define('_SKINIE_EXPORT_SKINS',		'Skins');
define('_SKINIE_EXPORT_TEMPLATES',	'Sjablonen');
define('_SKINIE_EXPORT_EXTRA',		'Extra Info');
define('_SKINIE_CONFIRM_OVERWRITE',	'Overschrijf bestaande data (zie dubbele namen)');
define('_SKINIE_CONFIRM_IMPORT',	'Ja, ik wil deze skins/templates importeren');
define('_SKINIE_CONFIRM_TITLE',		'Klaar om skins/templates te importeren');
define('_SKINIE_INFO_SKINS',		'Skins in bestand:');
define('_SKINIE_INFO_TEMPLATES',	'Sjablonen in bestand:');
define('_SKINIE_INFO_GENERAL',		'Info:');
define('_SKINIE_INFO_SKINCLASH',	'Dubbele skinnamen:');
define('_SKINIE_INFO_TEMPLCLASH',	'Dubbele templatenamen:');
define('_SKINIE_INFO_IMPORTEDSKINS','Ge�mporteerde skins:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Ge�mporteerde templats:');
define('_SKINIE_DONE',				'Klaar met importeren');

define('_AND',						'en');
define('_OR',						'of');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'Leeg veld (klik om te bewerken)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'IncludeMode:');
define('_LIST_SKINS_INCPREFIX',		'IncludePrefix:');
define('_LIST_SKINS_DEFINED',		'Gedefinieerde onderdelen:');

// backup
define('_BACKUPS_TITLE',			'Backup / Restore');
define('_BACKUP_TITLE',				'Backup');
define('_BACKUP_INTRO',				'Klik op de knop om een backup van uw Nucleus database te maken. Bewaar dit bestand op een veilige plaats...');
define('_BACKUP_ZIP_YES',			'Probeer compressie te gebruiken');
define('_BACKUP_ZIP_NO',			'Geen compressie gebruiken');
define('_BACKUP_BTN',				'Backup maken');
define('_BACKUP_NOTE',				'<b>Opmerking:</b> Enkel de inhoud van de database komt in de backup terecht. Media bestanden, instellingen uit config.php worden dus <b>NIET</b> opgenomen in de backup.');
define('_RESTORE_TITLE',			'Restore');
define('_RESTORE_NOTE',				'<b>WAARSCHUWING:</b> Het terugzetten van een backup zal alle huidige Nucleus data in de database <b>WISSEN</b>! Wees dus zeker dat je dit wilt doen!	<br />	<b>Opmerking:</b> Een backup-bestand kan enkel teruggezet worden op een Nucleus-installatie die dezelfde Nucleus-versie gebruikt. In andere gevallen kunnen onvoorspelbare resultaten opduiken.');
define('_RESTORE_INTRO',			'Selecteer het backup-bestand dat je wilt terugzetten (zal doorgestuurd worden naar de server)');
define('_RESTORE_IMSURE',			'Ja, ik ben 100% zeker dat ik dit wil doen');
define('_RESTORE_BTN',				'Terugzetten van backup');
define('_RESTORE_WARNING',			'(vergeet niet even te controleren of je wel het juiste backup-bestand geselecteerd hebt)');
define('_ERROR_BACKUP_NOTSURE',		'Je moet de \'ik ben 100% zeker\' checkbox aanklikken');
define('_RESTORE_COMPLETE',			'Backup Teruggezet');

// new item notification
define('_NOTIFY_NI_MSG',			'Een nieuw bericht:');
define('_NOTIFY_NI_TITLE',			'Nieuw bericht!');
define('_NOTIFY_KV_MSG',			'Karma vote voor bericht:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'Nieuwe reactie op bericht:');
define('_NOTIFY_NC_TITLE',			'Nucleus reactie:');
define('_NOTIFY_USERID',			'User ID:');
define('_NOTIFY_USER',				'User:');
define('_NOTIFY_COMMENT',			'Reactie:');
define('_NOTIFY_VOTE',				'Stem:');
define('_NOTIFY_HOST',				'Host:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'Lid:');
define('_NOTIFY_TITLE',				'Titel:');
define('_NOTIFY_CONTENTS',			'Inhoud:');

// member mail message
define('_MMAIL_MSG',				'Een bericht van');
define('_MMAIL_FROMANON',			'een anonieme bezoeker');
define('_MMAIL_FROMNUC',			'Gepost vanop het Nucleus weblog op');
define('_MMAIL_TITLE',				'Een bericht van');
define('_MMAIL_MAIL',				'Bericht:');



// END introduced after v1.5 END



// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'Toevoegen');
define('_BMLET_EDIT',				'Aanpassen');
define('_BMLET_DELETE',				'Bericht Wissen');
define('_BMLET_BODY',				'Inhoud');
define('_BMLET_MORE',				'Uitgebreid');
define('_BMLET_OPTIONS',			'Opties');
define('_BMLET_PREVIEW',			'Voorbeeld');

// used in bookmarklet
define('_ITEM_UPDATED',				'Bericht werd aangepast');
define('_ITEM_DELETED',				'Bericht werd verwijderd');

// plugins
define('_CONFIRMTXT_PLUGIN',		'Doorgaan met het verwijderen van plugin');
define('_ERROR_NOSUCHPLUGIN',		'Gevraagde plugin bestaat niet');
define('_ERROR_DUPPLUGIN',			'Sorry, deze plugin is reeds ge�nstalleerd');
define('_ERROR_PLUGFILEERROR',		'Er bestaat geen dergelijke plugin, ofwel zijn de bestandspermissies fout.');
define('_PLUGS_NOCANDIDATES',		'Geen kandidaat-plugins gevonden');

define('_PLUGS_TITLE_MANAGE',		'Beheer Plugins');
define('_PLUGS_TITLE_INSTALLED',	'Momenteel ge�nstalleerd');
define('_PLUGS_TITLE_UPDATE',		'Plugin Subscriptions vernieuwen');
define('_PLUGS_TEXT_UPDATE',		'Nucleus houdt een cache bij van de gebeurtenissen waarop een plugin ingeschreven is. Na een plugin upgrade kan het nodig zijn dat je de lijst van subscriptions vernieuwd.');
define('_PLUGS_TITLE_NEW',			'Nieuwe plugin installeren');
define('_PLUGS_ADD_TEXT',			'Hieronder vind je een lijst van mogelijke pluginkandidaten, gevonden in de plugin-directory. Zorg dat je <strong>helemaal zeker</strong> bent dat het echt om een plugin gaat voor je het probeert toe te voegen.');
define('_PLUGS_BTN_INSTALL',		'Installeren');
define('_BACKTOOVERVIEW',			'Terug naar overzicht');

// editlink
define('_TEMPLATE_EDITLINK',		'\'Bericht aanpassen\'-link');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'Hokje langs linkerkant');
define('_ADD_RIGHT_TT',				'Hokje langs rechterkant');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'Nieuwe Categorie');

// new settings
define('_SETTINGS_PLUGINURL',		'Plugin URL');
define('_SETTINGS_MAXUPLOADSIZE',	'Max. grootte voor uploads (bytes)');
define('_SETTINGS_NONMEMBERMSGS',	'Toelaten dat niet-leden berichten sturen');
define('_SETTINGS_PROTECTMEMNAMES',	'Leden-namen beschermen');

// overview screen
define('_OVERVIEW_PLUGINS',			'Plugins Beheren...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'Nieuwe gebruiker:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'Uw email adres:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'Je probeert een bestand op te laden in de media directory van een andere gebruiker. U beschikt echter niet over de nodige rechten om dit te doen (U heeft admin-rechten nodig voor minstens ��n blog dat de doelgebruiker in het team heeft).');

// plugin list
define('_LISTS_INFO',				'Informatie');
define('_LIST_PLUGS_AUTHOR',		'Auteur:');
define('_LIST_PLUGS_VER',			'Versie:');
define('_LIST_PLUGS_SITE',			'Bezoek Website');
define('_LIST_PLUGS_DESC',			'Beschrijving:');
define('_LIST_PLUGS_SUBS',			'Afhankelijk van:');
define('_LIST_PLUGS_UP',			'omhoog');
define('_LIST_PLUGS_DOWN',			'omlaag');
define('_LIST_PLUGS_UNINSTALL',		'verwijder');
define('_LIST_PLUGS_ADMIN',			'admin');
define('_LIST_PLUGS_OPTIONS',		'opties');

// plugin option list
define('_LISTS_VALUE',				'Waarde');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'Deze plugin heeft geen opties');
define('_PLUGS_BACK',				'Terug naar het plugin-overzicht');
define('_PLUGS_SAVE',				'Opties bewaren');
define('_PLUGS_OPTIONS_UPDATED',	'Plugin-opties werden aangepast');

define('_OVERVIEW_MANAGEMENT',		'Beheer');
define('_OVERVIEW_MANAGE',			'Nucleus Beheer...');
define('_MANAGE_GENERAL',			'Algemeen Beheer');
define('_MANAGE_SKINS',				'Skin en Sjablonen');
define('_MANAGE_EXTRA',				'Extra mogelijkheden');

define('_BACKTOMANAGE',				'Terug naar Nucleus beheer');
// END introduced after v1.1 END


// charset to use (iso-8859-15 = latin9)
define('_CHARSET',					'iso-8859-15');

// global stuff
define('_LOGOUT',					'Uitloggen');
define('_LOGIN',					'Inloggen');
define('_YES',						'Ja');
define('_NO',						'Nee');
define('_SUBMIT',					'Versturen');
define('_ERROR',					'Fout');
define('_ERRORMSG',					'Er heeft zich een fout voorgedaan!');
define('_BACK',						'Terug');
define('_NOTLOGGEDIN',				'Niet ingelogd');
define('_LOGGEDINAS',				'Ingelogd als');
define('_ADMINHOME',				'Admin Home');
define('_NAME',						'Naam');
define('_BACKHOME',					'Terug naar Admin Home');
define('_BADACTION',				'Gevraagde actie bestaat niet');
define('_MESSAGE',					'Bericht');
define('_HELP_TT',					'Help!');
define('_YOURSITE',					'Uw site');


define('_POPUP_CLOSE',				'Venster sluiten');

define('_LOGIN_PLEASE',				'Gelieve eerst in te loggen');

// commentform
define('_COMMENTFORM_YOUARE',		'U bent');
define('_COMMENTFORM_SUBMIT',		'Reactie toevoegen');
define('_COMMENTFORM_COMMENT',		'Uw reactie');
define('_COMMENTFORM_NAME',			'Naam');
define('_COMMENTFORM_MAIL',			'E-mail/HTTP');
define('_COMMENTFORM_REMEMBER',		'Onthoud wie ik ben');

// loginform
define('_LOGINFORM_NAME',			'Gebruikersnaam');
define('_LOGINFORM_PWD',			'Wachtwoord');
define('_LOGINFORM_YOUARE',			'Ingelogd als');
define('_LOGINFORM_SHARED',			'Gedeelde computer');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'Verzend Bericht');

// search form
define('_SEARCHFORM_SUBMIT',		'Zoek');

// add item form
define('_ADD_ADDTO',				'Bericht toevoegen aan');
define('_ADD_CREATENEW',			'Nieuw Bericht Aanmaken');
define('_ADD_BODY',					'Inhoud');
define('_ADD_TITLE',				'Titel');
define('_ADD_MORE',					'Uitgebreide teksts (optioneel)');
define('_ADD_CATEGORY',				'Categorie');
define('_ADD_PREVIEW',				'Voorbeeld');
define('_ADD_DISABLE_COMMENTS',		'Commentaar uitschakelen?');
define('_ADD_DRAFTNFUTURE',			'Kladversies &amp; Future Items');
define('_ADD_ADDITEM',				'Toevoegen');
define('_ADD_ADDNOW',				'Nu toevoegen');
define('_ADD_ADDLATER',				'Later toevoegen');
define('_ADD_PLACE_ON',				'Toevoegen op');
define('_ADD_ADDDRAFT',				'Als kladversie bewaren');
define('_ADD_NOPASTDATES',			'(Data in het verleden gelden niet. In dat geval wordt de huidige datum genomen)');
define('_ADD_BOLD_TT',				'Vet');
define('_ADD_ITALIC_TT',			'Cursief');
define('_ADD_HREF_TT',				'Link Maken');
define('_ADD_MEDIA_TT',				'Media Toevoegen');
define('_ADD_PREVIEW_TT',			'Voorbeeld Tonen/Verbergen');
define('_ADD_CUT_TT',				'Knippen');
define('_ADD_COPY_TT',				'Kopi�ren');
define('_ADD_PASTE_TT',				'Plakken');


// edit item form
define('_EDIT_ITEM',				'Bericht Aanpassen');
define('_EDIT_SUBMIT',				'Bericht Aanpassen');
define('_EDIT_ORIG_AUTHOR',			'Oorspronkelijke Auteur');
define('_EDIT_BACKTODRAFTS',		'Terug toevoegen aan kladversies');
define('_EDIT_COMMENTSNOTE',		'(opm.: reacties uitschakelen verhindert het tonen van reeds bestaande reacties niet)');

// used on delete screens
define('_DELETE_CONFIRM',			'Weet je het zeker?');
define('_DELETE_CONFIRM_BTN',		'Ja! Wissen!');
define('_CONFIRMTXT_ITEM',			'Je staat op het punt volgend bericht te verwijderen:');
define('_CONFIRMTXT_COMMENT',		'Je staat op het punt volgende reactie te verwijderen:');
define('_CONFIRMTXT_TEAM1',			'Je staat op het punt om ');
define('_CONFIRMTXT_TEAM2',			' uit het team te gooien voor het weblog ');
define('_CONFIRMTXT_BLOG',			'Je staat op het punt om volgend weblog te verwijderen: ');
define('_WARNINGTXT_BLOGDEL',		'Waarschuwing! Wanneer je dit weblog verwijdert, zullen all berichten en reacties die hierbij horen voor eeuwig verwijderd worden. Zorg er dus voor dat je 100% zeker bent dat je dit wel wilt doen.');
define('_CONFIRMTXT_MEMBER',		'Je staat op het punt om de volgende gebruiker te verwijderen: ');
define('_CONFIRMTXT_TEMPLATE',		'Je staat op het punt om het volgend sjabloon te verwijderen: ');
define('_CONFIRMTXT_SKIN',			'Je staat op het punt om de volgende skin te verwijderen: ');
define('_CONFIRMTXT_BAN',			'Je staat op het punt om een ban op de volgende IP-range op te heffen: ');
define('_CONFIRMTXT_CATEGORY',		'Je staat op het punt om de volgende categorie te verwijderen: ');

// some status messages
define('_DELETED_ITEM',				'Bericht verwijderd');
define('_DELETED_MEMBER',			'Gebruiker verwijderd');
define('_DELETED_COMMENT',			'Reactie verwijderd');
define('_DELETED_BLOG',				'Weblog verwijderd');
define('_DELETED_CATEGORY',			'Categorie verwijderd');
define('_ITEM_MOVED',				'Bericht verplaatst');
define('_ITEM_ADDED',				'Bericht toegevoegd');
define('_COMMENT_UPDATED',			'Reactie aangepast');
define('_SKIN_UPDATED',				'Skin data werd opgeslagen');
define('_TEMPLATE_UPDATED',			'Sjabloon data werd opgeslagen');

// errors
define('_ERROR_COMMENT_LONGWORD',	'Gelieve geen al te lange woorden in uw reactie op te nemen.');
define('_ERROR_COMMENT_NOCOMMENT',	'Gelieve minstens wat commentaar te geven');
define('_ERROR_COMMENT_NOUSERNAME',	'Foute gebruikersnaam');
define('_ERROR_COMMENT_TOOLONG',	'Uw reactie is te lang... (max. 5000 karakters)');
define('_ERROR_COMMENTS_DISABLED',	'Reageren is op dit ogenblik uitgeschakeld voor deze weblog.');
define('_ERROR_COMMENTS_NONPUBLIC',	'U moet ingelogd zijn om op dit bericht te reageren.');
define('_ERROR_COMMENTS_MEMBERNICK','De naam die je wilt gebruiken om mee te reageren, is geregistreerd door iemand anders. Kies iets anders, of log in.');
define('_ERROR_SKIN',				'Fout bij het kiezen van de gepaste skin');
define('_ERROR_ITEMCLOSED',			'Dit bericht is gesloten. Hierdoor zijn reacties of stemmen niet langer mogelijk.');
define('_ERROR_NOSUCHITEM',			'Het gevraagde bericht bestaat niet.');
define('_ERROR_NOSUCHBLOG',			'Het gevraagde weblog bestaat niet.');
define('_ERROR_NOSUCHSKIN',			'De gevraagde skin bestaat niet.');
define('_ERROR_NOSUCHMEMBER',		'De gevraagde gebruiker bestaat niet.');
define('_ERROR_NOTONTEAM',			'U staat niet in de teamlijst voor dit weblog.');
define('_ERROR_BADDESTBLOG',		'Doel-weblog bestaat niet.');
define('_ERROR_NOTONDESTTEAM',		'Kan bericht niet verplaatsen omdat u niet in het team van het doelblog zit.');
define('_ERROR_NOEMPTYITEMS',		'Kan geen lege berichten toevoegen!');
define('_ERROR_BADMAILADDRESS',		'Ongeldig e-mail adres');
define('_ERROR_BADNOTIFY',			'Een of meer van de gegeven notify-adressen zijn ongeldig');
define('_ERROR_BADNAME',			'Ongeldige naam (enkel aA-zZ en 0-9 toegelaten, geen spaties aan begin en einde)');
define('_ERROR_NICKNAMEINUSE',		'Een ander gebruiker gebruikt deze nickname reeds');
define('_ERROR_PASSWORDMISMATCH',	'Wachtwoorden komen niet overeen');
define('_ERROR_PASSWORDTOOSHORT',	'Een wachtwoord moet minstens zes tekens bevatten');
define('_ERROR_PASSWORDMISSING',	'Gelieve een wachtwoord op te geven');
define('_ERROR_REALNAMEMISSING',	'Gelieve een echte naam op te geven');
define('_ERROR_ATLEASTONEADMIN',	'Er moet op elk gegeven ogenblik een super-admin bestaan die kan inloggen');
define('_ERROR_ATLEASTONEBLOGADMIN','Deze actie zou uw weblog onbeheerbaar achterlaten. Zorg ervoor dat er steeds een admin overblijft');
define('_ERROR_ALREADYONTEAM',		'Gebruiker behoort al tot het team');
define('_ERROR_BADSHORTBLOGNAME',	'De korte blognaam mag enkel aA-zZ en 0-9 bevatten, zonder spaties');
define('_ERROR_DUPSHORTBLOGNAME',	'Een ander weblog gebruikt deze korte naam al. Kies een andere');
define('_ERROR_UPDATEFILE',			'Kan geen schrijftoegang krijgen tot de update-file. Zorg ervoor dat filepermissies goed staan (probeer chmod 666).');
define('_ERROR_DELDEFBLOG',			'Kan het default weblog niet verwijderen');
define('_ERROR_DELETEMEMBER',		'Kan deze gebruiker niet verwijderen omdat er nog berichten of reacties bestaan geschreven door deze gebruiker.');
define('_ERROR_BADTEMPLATENAME',	'Ongeldige sjabloon-naam, enkel aA-zZ en 0-9 zijn toegelaten, geen spaties');
define('_ERROR_DUPTEMPLATENAME',	'Een ander sjabloon met gebruikt deze sjabloon-naam al');
define('_ERROR_BADSKINNAME',		'Ongeldige skin-naam: enkel aA-zZ en 0-9 zijn toegelaten, spaties niet');
define('_ERROR_DUPSKINNAME',		'Er bestaat reeds een skin met de gegeven naam');
define('_ERROR_DEFAULTSKIN',		'Op elk ogenblik moet een skin met naam "default" bestaan...');
define('_ERROR_SKINDEFDELETE',		'Kan skin niet verwijderen omdat deze als default staat ingesteld voor een of meer weblogs: ');
define('_ERROR_DISALLOWED',			'Sorry, U bent niet gemachtigd om deze actie uit te voeren');
define('_ERROR_DELETEBAN',			'Fout bij verwijderen ban (ban bestaat niet)');
define('_ERROR_ADDBAN',				'Probleem bij het toevoegen van een ban. De ban is mogelijks niet correct toegevoegd in alle blogs');
define('_ERROR_BADACTION',			'De gevraagde actie bestaat niet');
define('_ERROR_MEMBERMAILDISABLED',	'Het zenden van e-mail berichten tussen gebruikers onderling is uitgeschakeld');
define('_ERROR_MEMBERCREATEDISABLED','Het aanmaken van accounts is momenteel uitgeschakeld');
define('_ERROR_INCORRECTEMAIL',		'Ongeldig email adres');
define('_ERROR_VOTEDBEFORE',		'U heeft reeds een stem uitgebracht voor dit bericht');
define('_ERROR_BANNED1',			'Kan actie niet uitvoeren omdat Uw (ip range ');
define('_ERROR_BANNED2',			') geband is. Bericht was: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'U moet ingelogd zijn om deze actie uit te voeren');
define('_ERROR_CONNECT',			'Connectieprobleem');
define('_ERROR_FILE_TOO_BIG',		'Bestand is te groot!');
define('_ERROR_BADFILETYPE',		'Sorry, dit bestandstype is niet toegelaten voor upload');
define('_ERROR_BADREQUEST',			'Foutief upload verzoek');
define('_ERROR_DISALLOWEDUPLOAD',	'U bent niet gemachtigd om bestanden op te laden');
define('_ERROR_BADPERMISSIONS',		'File/Dir permissies zijn niet correct ingesteld');
define('_ERROR_UPLOADMOVEP',		'Probleem bij verplaatsen van opgeladen bestand');
define('_ERROR_UPLOADCOPY',			'Probleem bij kopi�ren van bestand');
define('_ERROR_UPLOADDUPLICATE',	'Een bestand met dezelfde naam bestaat reeds. Probeer uw bestand eerst te hernoemen.');
define('_ERROR_LOGINDISALLOWED',	'Sorry, U bent niet gemachtigd om in te loggen op de admin area');
define('_ERROR_DBCONNECT',			'Kon geen verbinding maken met de MySQL database');
define('_ERROR_DBSELECT',			'Kon de databank niet correct selecteren.');
define('_ERROR_NOSUCHLANGUAGE',		'De gevraagde taal bestaat niet');
define('_ERROR_NOSUCHCATEGORY',		'Categorie bestaat niet');
define('_ERROR_DELETELASTCATEGORY',	'Er moet steeds minstens ��n categorie bestaan');
define('_ERROR_DELETEDEFCATEGORY',	'Kan default categorie niet wissen');
define('_ERROR_BADCATEGORYNAME',	'Ongeldige categorie-naam');
define('_ERROR_DUPCATEGORYNAME',	'Er bestaat reeds een categorie met die naam');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'Waarschuwing: Huidige waarde is geen directory!');
define('_WARNING_NOTREADABLE',		'Waarschuwing: Huidige waarde is geen leesbare directory!');
define('_WARNING_NOTWRITABLE',		'Waarschuwing: Huidige waarde is GEEN schrijfbare directory.!');

// media and upload
define('_MEDIA_UPLOADLINK',			'Bestand opladen');
define('_MEDIA_MODIFIED',			'gewijzigd');
define('_MEDIA_FILENAME',			'bestandsnaam');
define('_MEDIA_DIMENSIONS',			'dimensies');
define('_MEDIA_INLINE',				'Inline');
define('_MEDIA_POPUP',				'Popup');
define('_UPLOAD_TITLE',				'Kies Bestand');
define('_UPLOAD_MSG',				'Kies het bestand dat je wilt uploaden, en druk op de \'Upload\' knop.');
define('_UPLOAD_BUTTON',			'Upload');

// some status messages
define('_MSG_ACCOUNTCREATED',		'Gebruiker aangemaakt. Paswoord wordt via email doorgestuurd.');
define('_MSG_PASSWORDSENT',			'Paswoord is per e-mail verzonden.');
define('_MSG_LOGINAGAIN',			'U dient opnieuw in te loggen');
define('_MSG_SETTINGSCHANGED',		'Instellingen aangepast');
define('_MSG_ADMINCHANGED',			'Admin aangepast');
define('_MSG_NEWBLOG',				'Nieuw weblog aangemaakt');
define('_MSG_ACTIONLOGCLEARED',		'Action Log leeggemaakt');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'Actie niet toegelaten: ');
define('_ACTIONLOG_PWDREMINDERSENT','Nieuw paswoord gezonden voor ');
define('_ACTIONLOG_TITLE',			'Action Log');
define('_ACTIONLOG_CLEAR_TITLE',	'Action Log Leegmaken');
define('_ACTIONLOG_CLEAR_TEXT',		'action log nu leegmaken');

// team management
define('_TEAM_TITLE',				'Team voor weblog ');
define('_TEAM_CURRENT',				'Huidig team');
define('_TEAM_ADDNEW',				'Teamlid toevoegen');
define('_TEAM_CHOOSEMEMBER',		'Kies gebruiker');
define('_TEAM_ADMIN',				'Admin rechten? ');
define('_TEAM_ADD',					'Toevoegen aan team');
define('_TEAM_ADD_BTN',				'Toevoegen');

// blogsettings
define('_EBLOG_TITLE',				'Weblog Instellingen');
define('_EBLOG_TEAM_TITLE',			'Team');
define('_EBLOG_TEAM_TEXT',			'Klik hier om het team te beheren.');
define('_EBLOG_SETTINGS_TITLE',		'Instellingen');
define('_EBLOG_NAME',				'Blognaam');
define('_EBLOG_SHORTNAME',			'Korte blognaam');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(enkel aA-zZ tekens toegelaten)');
define('_EBLOG_DESC',				'Beschrijving');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'Default Skin');
define('_EBLOG_DEFCAT',				'Default Categorie');
define('_EBLOG_LINEBREAKS',			'Harde returns omzetten');
define('_EBLOG_DISABLECOMMENTS',	'Reactie ingeschakeld?<br /><small>(Indien uitgeschakeld kunnen geen reacties toegevoegd worden)</small>');
define('_EBLOG_ANONYMOUS',			'Anonieme reacties toelaten? (door niet-ingelogden)');
define('_EBLOG_NOTIFY',				'Notify Adres(sen) (gebruik ; als scheidingsteken)');
define('_EBLOG_NOTIFY_ON',			'Zend notify-bericht bij');
define('_EBLOG_NOTIFY_COMMENT',		'Nieuwe reacties');
define('_EBLOG_NOTIFY_KARMA',		'Nieuwe karma votes');
define('_EBLOG_NOTIFY_ITEM',		'Nieuwe items');
define('_EBLOG_PING',				'Pingen naar weblogs.com?');
define('_EBLOG_MAXCOMMENTS',		'Max aantal reacties op voorpagina');
define('_EBLOG_UPDATE',				'Update file');
define('_EBLOG_OFFSET',				'Time Offset');
define('_EBLOG_STIME',				'Huidige servertijd is');
define('_EBLOG_BTIME',				'Huidige blogtijd is');
define('_EBLOG_CHANGE',				'Instellingen Aanpassen');
define('_EBLOG_CHANGE_BTN',			'Instellingen Aanpassen');
define('_EBLOG_ADMIN',				'Blog Admin');
define('_EBLOG_ADMIN_MSG',			'U krijgt admin-rechten voor dit weblog');
define('_EBLOG_CREATE_TITLE',		'Nieuw weblog');
define('_EBLOG_CREATE_TEXT',		'Vul het onderstaande formulier in om een nieuw weblog aan te maken. <br /><br /> <b>Opmerking:</b> Enkel de verplichte velden worden hier getoond. Later kunt u extra opties instellen.');
define('_EBLOG_CREATE',				'Aanmaken');
define('_EBLOG_CREATE_BTN',			'Weblog Aanmaken');
define('_EBLOG_CAT_TITLE',			'Categorie�n');
define('_EBLOG_CAT_NAME',			'Naam');
define('_EBLOG_CAT_DESC',			'Omschrijving');
define('_EBLOG_CAT_CREATE',			'Categorie Aanmaken');
define('_EBLOG_CAT_UPDATE',			'Categorie Aanpassen');
define('_EBLOG_CAT_UPDATE_BTN',		'Categorie Aanpassen');

// templates
define('_TEMPLATE_TITLE',			'Sjablonen');
define('_TEMPLATE_AVAILABLE_TITLE',	'Beschikbare Sjablonen');
define('_TEMPLATE_NEW_TITLE',		'Nieuw Sjabloon');
define('_TEMPLATE_NAME',			'Sjabloon Naam');
define('_TEMPLATE_DESC',			'Sjabloon Beschrijving');
define('_TEMPLATE_CREATE',			'Sjabloon Aanmaken');
define('_TEMPLATE_CREATE_BTN',		'Sjabloon Aanmaken');
define('_TEMPLATE_EDIT_TITLE',		'Sjabloon Aanpassen');
define('_TEMPLATE_BACK',			'Terug naar sjabloon-overzicht');
define('_TEMPLATE_EDIT_MSG',		'Niet alle sjabloon-onderdelen zijn in alle gevallen nodig. Je kunt de overbodige velden gerust leeglaten');
define('_TEMPLATE_SETTINGS',		'Sjabloon Instellingen');
define('_TEMPLATE_ITEMS',			'Berichten');
define('_TEMPLATE_ITEMHEADER',		'Bericht Kop');
define('_TEMPLATE_ITEMBODY',		'Bericht Inhoud');
define('_TEMPLATE_ITEMFOOTER',		'Bericht Onderschrift');
define('_TEMPLATE_MORELINK',		'Link naar uitgebreide versie');
define('_TEMPLATE_NEW',				'Aanduiding voor nieuw bericht');
define('_TEMPLATE_COMMENTS_ANY',	'Reacties (indien er zijn)');
define('_TEMPLATE_CHEADER',			'Reacties Kop');
define('_TEMPLATE_CBODY',			'Reacties Inhoud');
define('_TEMPLATE_CFOOTER',			'Reacties Onderschrift');
define('_TEMPLATE_CONE',			'Een enkele reactie');
define('_TEMPLATE_CMANY',			'Twee (of meer) reacties');
define('_TEMPLATE_CMORE',			'Reacties "Lees verder"');
define('_TEMPLATE_CMEXTRA',			'Leden Extra ');
define('_TEMPLATE_COMMENTS_NONE',	'Reacties (indien geen)');
define('_TEMPLATE_CNONE',			'Geen reacties');
define('_TEMPLATE_COMMENTS_TOOMUCH','Reacties (indien teveel om op voorpagina te laten zien)');
define('_TEMPLATE_CTOOMUCH',		'Heel veel reacties');
define('_TEMPLATE_ARCHIVELIST',		'Archief Overzicht');
define('_TEMPLATE_AHEADER',			'Archief Overzicht (kop)');
define('_TEMPLATE_AITEM',			'Archief Overzicht (item)');
define('_TEMPLATE_AFOOTER',			'Archief Overzicht (onderschrift)');
define('_TEMPLATE_DATETIME',		'Tijd en Datum');
define('_TEMPLATE_DHEADER',			'Dag Kop');
define('_TEMPLATE_DFOOTER',			'Dag Onderschrift');
define('_TEMPLATE_DFORMAT',			'Datumformaat');
define('_TEMPLATE_TFORMAT',			'Tijdsformaat');
define('_TEMPLATE_LOCALE',			'Lokale');
define('_TEMPLATE_IMAGE',			'Image popups');
define('_TEMPLATE_PCODE',			'Popup Link Code');
define('_TEMPLATE_ICODE',			'Inline Image Code');
define('_TEMPLATE_MCODE',			'Media Object Link Code');
define('_TEMPLATE_SEARCH',			'Zoeken');
define('_TEMPLATE_SHIGHLIGHT',		'Highlight');
define('_TEMPLATE_SNOTFOUND',		'Geen resultaten gevonden');
define('_TEMPLATE_UPDATE',			'Update');
define('_TEMPLATE_UPDATE_BTN',		'Update Sjabloon');
define('_TEMPLATE_RESET_BTN',		'Herstellen');
define('_TEMPLATE_CATEGORYLIST',	'Categorie Overzicht');
define('_TEMPLATE_CATHEADER',		'Categorie Overzicht (kop)');
define('_TEMPLATE_CATITEM',			'Categorie Overzicht (item)');
define('_TEMPLATE_CATFOOTER',		'Categorie Overzicht (onderschrift)');


// skins
define('_SKIN_EDIT_TITLE',			'Skins');
define('_SKIN_AVAILABLE_TITLE',		'Beschikbare Skins');
define('_SKIN_NEW_TITLE',			'Nieuwe Skin');
define('_SKIN_NAME',				'Naam');
define('_SKIN_DESC',				'Beschrijving');
define('_SKIN_TYPE',				'Content Type');
define('_SKIN_CREATE',				'Aanmaken');
define('_SKIN_CREATE_BTN',			'Skin Aanmaken');
define('_SKIN_EDITONE_TITLE',		'Skin Aanpassen');
define('_SKIN_BACK',				'Terug naar skin overzicht');
define('_SKIN_PARTS_TITLE',			'Skin Onderdelen');
define('_SKIN_PARTS_MSG',			'Opmerking: niet alle onderdelen zijn noodzakelijk voor elke skin. Onderdelen die je niet nodig hebt mogen leeg blijven.');
define('_SKIN_PART_MAIN',			'Hoofdpagina');
define('_SKIN_PART_ITEM',			'Berichtenpagina\'s');
define('_SKIN_PART_ALIST',			'Overzicht archieven');
define('_SKIN_PART_ARCHIVE',		'Archief');
define('_SKIN_PART_SEARCH',			'Zoekresultaten');
define('_SKIN_PART_ERROR',			'Fouten');
define('_SKIN_PART_MEMBER',			'Details over gebruiker');
define('_SKIN_PART_POPUP',			'Image Popups');
define('_SKIN_GENSETTINGS_TITLE',	'Algemene Instellingen');
define('_SKIN_CHANGE',				'Aanpassen');
define('_SKIN_CHANGE_BTN',			'Toepassen');
define('_SKIN_UPDATE_BTN',			'Update Skin');
define('_SKIN_RESET_BTN',			'Reset Data');
define('_SKIN_EDITPART_TITLE',		'Skin Aanpassen');
define('_SKIN_GOBACK',				'Terug');
define('_SKIN_ALLOWEDVARS',			'Toegelaten variabelen (klik voor info):');

// global settings
define('_SETTINGS_TITLE',			'Algemene Instellingen');
define('_SETTINGS_SUB_GENERAL',		'Algemene Instellingen');
define('_SETTINGS_DEFBLOG',			'Default Blog');
define('_SETTINGS_ADMINMAIL',		'Administrator Email');
define('_SETTINGS_SITENAME',		'Sitenaam');
define('_SETTINGS_SITEURL',			'URL van Site (eindigt met een slash)');
define('_SETTINGS_ADMINURL',		'URL van Admin Area (eindigt met een slash)');
define('_SETTINGS_DIRS',			'Nucleus Directories');
define('_SETTINGS_MEDIADIR',		'Media Directory');
define('_SETTINGS_SEECONFIGPHP',	'(zie config.php)');
define('_SETTINGS_MEDIAURL',		'Media URL (eindigt met een slash)');
define('_SETTINGS_ALLOWUPLOAD',		'File Upload Toelaten?');
define('_SETTINGS_ALLOWUPLOADTYPES','Toegelaten bestandstypes voor upload');
define('_SETTINGS_CHANGELOGIN',		'Gebruikers toelaten naam en wachtwoord te wijzigen');
define('_SETTINGS_COOKIES_TITLE',	'Cookie Settings');
define('_SETTINGS_COOKIELIFE',		'Login Cookie Levensduur');
define('_SETTINGS_COOKIESESSION',	'Session Cookies');
define('_SETTINGS_COOKIEMONTH',		'1 maand');
define('_SETTINGS_COOKIEPATH',		'Cookie Path (geavanceerd)');
define('_SETTINGS_COOKIEDOMAIN',	'Cookie Domein (geavanceerd)');
define('_SETTINGS_COOKIESECURE',	'Secure Cookie (geavanceerd)');
define('_SETTINGS_LASTVISIT',		'Bewaar "Laatste Bezoek" Cookies');
define('_SETTINGS_ALLOWCREATE',		'Bezoekers toelaten een gebruikersaccount aan te maken');
define('_SETTINGS_NEWLOGIN',		'Login toegelaten voor nieuwe gebruikers');
define('_SETTINGS_NEWLOGIN2',		'(geldt enkel voor nieuwe accounts)');
define('_SETTINGS_MEMBERMSGS',		'Member-2-Member Service Toelaten');
define('_SETTINGS_LANGUAGE',		'Default Taal');
define('_SETTINGS_DISABLESITE',		'Site Uitschakelen');
define('_SETTINGS_DBLOGIN',			'mySQL Login &amp; Database');
define('_SETTINGS_UPDATE',			'Bewaren');
define('_SETTINGS_UPDATE_BTN',		'Instellingen Bewaren');
define('_SETTINGS_DISABLEJS',		'JavaScript Toolbar Uitschakelen');
define('_SETTINGS_MEDIA',			'Media/Upload Instellingen');
define('_SETTINGS_MEDIAPREFIX',		'Prefix opgeladen bestanden met datum');
define('_SETTINGS_MEMBERS',			'Account Instellingen');


// bans
define('_BAN_TITLE',				'Bans voor ');
define('_BAN_NONE',					'Er zijn geen bans voor dit weblog');
define('_BAN_NEW_TITLE',			'Nieuwe ban toevoegen');
define('_BAN_NEW_TEXT',				'Nieuwe ban toevoegen');
define('_BAN_REMOVE_TITLE',			'Ban verwijderen');
define('_BAN_IPRANGE',				'IP Range');
define('_BAN_BLOGS',				'Welke weblogs?');
define('_BAN_DELETE_TITLE',			'Ban Verwijderen');
define('_BAN_ALLBLOGS',				'Alle blogs waar U admin-rechten heeft.');
define('_BAN_REMOVED_TITLE',		'Ban Verwijderd');
define('_BAN_REMOVED_TEXT',			'Ban is verwijderd voor volgende weblogs:');
define('_BAN_ADD_TITLE',			'Ban Toevoegen');
define('_BAN_IPRANGE_TEXT',			'Kies de IP range die je wilt bannen. Hoe korter het fragment, hoe meer adressen geband zullen worden');
define('_BAN_BLOGS_TEXT',			'Kies hieronder of u de ban enkel voor dit blog wilt toevoegen, of voor alle blogs waarvoor u admin-rechten bezit.');
define('_BAN_REASON_TITLE',			'Reden');
define('_BAN_REASON_TEXT',			'Deze tekst zal getoond worden wanneer de gebande een actie probeert uit te voeren. Max. 256 tekens.');
define('_BAN_ADD_BTN',				'Ban Toevoegen');

// LOGIN screen
define('_LOGIN_MESSAGE',			'Bericht:');
define('_LOGIN_NAME',				'Naam');
define('_LOGIN_PASSWORD',			'Wachtwoord');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'Paswoord vergeten?');

// membermanagement
define('_MEMBERS_TITLE',			'Gebruikersbeheer');
define('_MEMBERS_CURRENT',			'Huidige Geregistreerde Gebruikers');
define('_MEMBERS_NEW',				'Nieuwe Gebruiker');
define('_MEMBERS_DISPLAY',			'Schermnaam');
define('_MEMBERS_DISPLAY_INFO',		'(deze naam wordt gebruikt om in te loggen)');
define('_MEMBERS_REALNAME',			'Echte Naam');
define('_MEMBERS_PWD',				'Wachtwoord');
define('_MEMBERS_REPPWD',			'Herhaal Wachtwoord');
define('_MEMBERS_EMAIL',			'Email adres');
define('_MEMBERS_EMAIL_EDIT',		'(Wanneer u uw emailadres wijzigt, zal een nieuw wachtwoord toegestuurd worden)');
define('_MEMBERS_URL',				'Website Adres (URL)');
define('_MEMBERS_SUPERADMIN',		'Administrator privileges');
define('_MEMBERS_CANLOGIN',			'Kan inloggen op de Admin Area');
define('_MEMBERS_NOTES',			'Notities');
define('_MEMBERS_NEW_BTN',			'Gebruiker Toevoegen');
define('_MEMBERS_EDIT',				'Wijzigen');
define('_MEMBERS_EDIT_BTN',			'Wijzigen');
define('_MEMBERS_BACKTOOVERVIEW',	'Terug naar gebruikersbeheer');
define('_MEMBERS_DEFLANG',			'Taal');
define('_MEMBERS_USESITELANG',		'- site-default -');


// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'Bezoek Site');
define('_BLOGLIST_ADD',				'Nieuw Bericht');
define('_BLOGLIST_TT_ADD',			'Voeg een nieuw bericht toe aan dit weblog');
define('_BLOGLIST_EDIT',			'Berichten');
define('_BLOGLIST_TT_EDIT',			'Berichten aanpassen/wissen');
define('_BLOGLIST_BMLET',			'Bookmarklet');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'Instellingen');
define('_BLOGLIST_TT_SETTINGS',		'Instellingen of team aanpassen');
define('_BLOGLIST_BANS',			'Bans');
define('_BLOGLIST_TT_BANS',			'Gebande IP-adressen beheren');
define('_BLOGLIST_DELETE',			'Alles Wissen');
define('_BLOGLIST_TT_DELETE',		'Dit weblog verwijderen');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'Uw weblogs');
define('_OVERVIEW_YRDRAFTS',		'Uw kladversies');
define('_OVERVIEW_YRSETTINGS',		'Uw instellingen');
define('_OVERVIEW_GSETTINGS',		'Algemene instellingen');
define('_OVERVIEW_NOBLOGS',			'U heeft geen schrijftoegang tot weblogs');
define('_OVERVIEW_NODRAFTS',		'Geen kladversies');
define('_OVERVIEW_EDITSETTINGS',	'Pas uw instellingen aan...');
define('_OVERVIEW_BROWSEITEMS',		'Al uw berichten...');
define('_OVERVIEW_BROWSECOMM',		'Al uw reacties...');
define('_OVERVIEW_VIEWLOG',			'Bekijk actie log...');
define('_OVERVIEW_MEMBERS',			'Gebruikersbeheer...');
define('_OVERVIEW_NEWLOG',			'Nieuw weblog aanmaken...');
define('_OVERVIEW_SETTINGS',		'Instellingen...');
define('_OVERVIEW_TEMPLATES',		'Sjablonen...');
define('_OVERVIEW_SKINS',			'Skins...');
define('_OVERVIEW_BACKUP',			'Backup/Restore...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'Berichten voor weblog');
define('_ITEMLIST_YOUR',			'Uw berichten');

// Comments
define('_COMMENTS',					'Reacties');
define('_NOCOMMENTS',				'Geen reacties voor dit bericht');
define('_COMMENTS_YOUR',			'Uw reacties');
define('_NOCOMMENTS_YOUR',			'U heeft nog geen reacties gegeven');

// LISTS (general)
define('_LISTS_NOMORE',				'Geen verdere resultaten, of totaal geen resultaten');
define('_LISTS_PREV',				'Vorige');
define('_LISTS_NEXT',				'Volgende');
define('_LISTS_SEARCH',				'Zoek');
define('_LISTS_CHANGE',				'Pas Aan');
define('_LISTS_PERPAGE',			'/pagina');
define('_LISTS_ACTIONS',			'Acties');
define('_LISTS_DELETE',				'Wissen');
define('_LISTS_EDIT',				'Wijzigen');
define('_LISTS_MOVE',				'Verplaatsen');
define('_LISTS_CLONE',				'Klonen');
define('_LISTS_TITLE',				'Titel');
define('_LISTS_BLOG',				'Blog');
define('_LISTS_NAME',				'Naam');
define('_LISTS_DESC',				'Omschrijving');
define('_LISTS_TIME',				'Tijd');
define('_LISTS_COMMENTS',			'Reacties');
define('_LISTS_TYPE',				'Type');


// member list
define('_LIST_MEMBER_NAME',			'Schermnaam');
define('_LIST_MEMBER_RNAME',		'Echte naam');
define('_LIST_MEMBER_ADMIN',		'Super-admin? ');
define('_LIST_MEMBER_LOGIN',		'Kan inloggen? ');
define('_LIST_MEMBER_URL',			'Website');

// banlist
define('_LIST_BAN_IPRANGE',			'IP Range');
define('_LIST_BAN_REASON',			'Reden');

// actionlist
define('_LIST_ACTION_MSG',			'Bericht');

// commentlist
define('_LIST_COMMENT_BANIP',		'Ban IP');
define('_LIST_COMMENT_WHO',			'Auteur');
define('_LIST_COMMENT',				'Reactie');
define('_LIST_COMMENT_HOST',		'Host');

// itemlist
define('_LIST_ITEM_INFO',			'Info');
define('_LIST_ITEM_CONTENT',		'Titel en Tekst');


// teamlist
define('_LIST_TEAM_ADMIN',			'Admin ');
define('_LIST_TEAM_CHADMIN',		'Verander Admin');

// edit comments
define('_EDITC_TITLE',				'Wijzig Reactie');
define('_EDITC_WHO',				'Auteur');
define('_EDITC_HOST',				'Host');
define('_EDITC_WHEN',				'Wanneer');
define('_EDITC_TEXT',				'Tekst');
define('_EDITC_EDIT',				'Wijzig');
define('_EDITC_MEMBER',				'geregistreerd');
define('_EDITC_NONMEMBER',			'niet geregistreerd');

// move item
define('_MOVE_TITLE',				'Verplaatsen naar welk blog?');
define('_MOVE_BTN',					'Verplaats');

?>