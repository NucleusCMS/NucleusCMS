<?php
// Czech Nucleus Language File
// 
// Author: Mnemonic (mnemonic@dead-code.org)
// Nucleus version: v1.0-v2.0
//
// Please note: if you want to translate this file to your own language, be aware
// that in a next Nucleus version, new variables might be added and some other ones
// might be deleted. Therefor, it's important to list the Nucleus version for which 
// the file was written in your document.
//
// Fully translated language file can be sent to Wouter Demuynck (nucleus@demuynck.org)
// and will be available for download (with proper credit to the author, of course)

// START introduced after v2.0 START

// media library
define('_MEDIA_VIEW',				'zobrazit');
define('_MEDIA_VIEW_TT',			'Zobrazit soubor (v novém oknì)');
define('_MEDIA_FILTER_APPLY',		'Použít filtr');
define('_MEDIA_FILTER_LABEL',		'Filtr: ');
define('_MEDIA_UPLOAD_TO',			'Nahrát do...');
define('_MEDIA_UPLOAD_NEW',			'Nahrát nový soubor...');
define('_MEDIA_COLLECTION_SELECT',	'Výbìr');
define('_MEDIA_COLLECTION_TT',		'Pøepnout se do této kategorie');
define('_MEDIA_COLLECTION_LABEL',	'Aktuální kolekce:: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'Zarovnat doleva');
define('_ADD_ALIGNRIGHT_TT',		'Zarovnat doprava');
define('_ADD_ALIGNCENTER_TT',		'Zarovnat na støed');

// searchable blog setting (yes/no)
define('_EBLOG_SEARCH',				'Zahrnout do hledání');

// generic upload failure
define('_ERROR_UPLOADFAILED',		'Nahrávání selhalo');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'Povolit publikování do minulosti');
define('_ADD_CHANGEDATE',			'Pøepsat datum/èas');
define('_BMLET_CHANGEDATE',			'Pøepsat datum/èas');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'Import/export vzhledu...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Normální');
define('_PARSER_INCMODE_SKINDIR',	'Použít adr. vzhledu');
define('_SKIN_INCLUDE_MODE',		'Režim vkládání');
define('_SKIN_INCLUDE_PREFIX',		'Prefix');

// global settings
define('_SETTINGS_BASESKIN',		'Základní vzhled');
define('_SETTINGS_SKINSURL',		'URL se vzhledy');
define('_SETTINGS_ACTIONSURL',		'Plné URL k action.php');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'Nelze pøesunout výchozí kategorii');
define('_ERROR_MOVETOSELF',			'Nelze pøesunout kategorii (cílový blog je stejný, jako zdrojový blog)');
define('_MOVECAT_TITLE',			'Vyberte blog, do kterého chcete pøesunout kategorii');
define('_MOVECAT_BTN',				'Pøesunout kategorii');

// URLMode setting
define('_SETTINGS_URLMODE',			'Režim URL');
define('_SETTINGS_URLMODE_NORMAL',	'Normální');
define('_SETTINGS_URLMODE_PATHINFO','Pestré');

// Batch operations
define('_BATCH_NOSELECTION',		'Pro provedení akce není nic vybráno');
define('_BATCH_ITEMS',				'Dávková operace na èláncích');
define('_BATCH_CATEGORIES',			'Dávková operace na kategoriích');
define('_BATCH_MEMBERS',			'Dávková operace na uživatelích');
define('_BATCH_TEAM',				'Dávková operace na èlenech týmu');
define('_BATCH_COMMENTS',			'Dávková operace na komentáøích');
define('_BATCH_UNKNOWN',			'Neznámá dávková operace: ');
define('_BATCH_EXECUTING',			'Spouští se');
define('_BATCH_ONCATEGORY',			'na kategorii');
define('_BATCH_ONITEM',				'na èlánku');
define('_BATCH_ONCOMMENT',			'na komentáøi');
define('_BATCH_ONMEMBER',			'na uživateli');
define('_BATCH_ONTEAM',				'na èlenovi týmu');
define('_BATCH_SUCCESS',			'Úspìch!');
define('_BATCH_DONE',				'Hotovo!');
define('_BATCH_DELETE_CONFIRM',		'Potvrïte dávkové odstranìní');
define('_BATCH_DELETE_CONFIRM_BTN',	'Potvrïte dávkové odstranìní');
define('_BATCH_SELECTALL',			'vybrat vše');
define('_BATCH_DESELECTALL',		'nevybrat nic');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'Odstranit');
define('_BATCH_ITEM_MOVE',			'Pøesunout');
define('_BATCH_MEMBER_DELETE',		'Odstranit');
define('_BATCH_MEMBER_SET_ADM',		'Nastavit správcovská práva');
define('_BATCH_MEMBER_UNSET_ADM',	'Odebrat správcovská práva');
define('_BATCH_TEAM_DELETE',		'Odstranit z týmu');
define('_BATCH_TEAM_SET_ADM',		'Nastavit správcovská práva');
define('_BATCH_TEAM_UNSET_ADM',		'Odebrat správcovská práva');
define('_BATCH_CAT_DELETE',			'Odstranit');
define('_BATCH_CAT_MOVE',			'Pøesunout do jiného blogu');
define('_BATCH_COMMENT_DELETE',		'Odstranit');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'Pøidat nový èlánek...');
define('_ADD_PLUGIN_EXTRAS',		'Nastavení pro pluginy');

// errors
define('_ERROR_CATCREATEFAIL',		'Nelze vytvoøit novou kategorii');
define('_ERROR_NUCLEUSVERSIONREQ',	'Tento plugin vyžaduje novìjší verzi Nucleusu: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Zpìt na nastavení blogu');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Import');
define('_SKINIE_TITLE_EXPORT',		'Export');
define('_SKINIE_BTN_IMPORT',		'Import');
define('_SKINIE_BTN_EXPORT',		'Export vybraných vzhledù/šablon');
define('_SKINIE_LOCAL',				'Import z lokálního souboru:');
define('_SKINIE_NOCANDIDATES',		'V adresáøi vzhledù nebyly nalezeny žádné položky pro import');
define('_SKINIE_FROMURL',			'Import z URL:');
define('_SKINIE_EXPORT_INTRO',		'Vyberte vzhledy a šablony, které chcete exportovat');
define('_SKINIE_EXPORT_SKINS',		'Vzhledy');
define('_SKINIE_EXPORT_TEMPLATES',	'Šablony');
define('_SKINIE_EXPORT_EXTRA',		'Extra info');
define('_SKINIE_CONFIRM_OVERWRITE',	'Pøepsat vzhledy, které již existují (viz konflikty jmen)');
define('_SKINIE_CONFIRM_IMPORT',	'Ano, toto chci naimportovat');
define('_SKINIE_CONFIRM_TITLE',		'Budou naimportovány vzhledy a šablony');
define('_SKINIE_INFO_SKINS',		'Vzhledy v souboru:');
define('_SKINIE_INFO_TEMPLATES',	'Šablony v souboru:');
define('_SKINIE_INFO_GENERAL',		'Info:');
define('_SKINIE_INFO_SKINCLASH',	'Konflikty v názvech vzhledù:');
define('_SKINIE_INFO_TEMPLCLASH',	'Konflikty v názvech šablon:');
define('_SKINIE_INFO_IMPORTEDSKINS','Importované vzhledy:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Importované šablony::');
define('_SKINIE_DONE',				'Import dokonèen');

define('_AND',						'a');
define('_OR',						'nebo');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'prázdné pole (kliknìte pro editaci)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'Režim vkládání:');
define('_LIST_SKINS_INCPREFIX',		'Prefix:');
define('_LIST_SKINS_DEFINED',		'Definované èásti:');

// backup
define('_BACKUPS_TITLE',			'Záloha / obnovení');
define('_BACKUP_TITLE',				'Záloha');
define('_BACKUP_INTRO',				'Kliknìte na tlaèítko pro vytvoøení zálohy Nucleus databáze. Budete vyzván k uložení souboru se zálohou. Tento soubor poté uschovejte na bezpeèném místì.');
define('_BACKUP_ZIP_YES',			'Pokusit se použít kompresi');
define('_BACKUP_ZIP_NO',			'Nepoužívat kompresi');
define('_BACKUP_BTN',				'Vytvoøit zálohu');
define('_BACKUP_NOTE',				'<b>Poznámka:</b> Zálohuje se pouze obsah databáze. Obrázky a nastavení v config.php tudíž <b>NEJSOU</b> souèástí zálohy.');
define('_RESTORE_TITLE',			'Obnovit');
define('_RESTORE_NOTE',				'<b>POZOR:</b> Obnova ze zálohy <b>VYMAŽE</b> stávající data v databázi! Tuto akci proveïte pouze pokud jste si opravdu jistý!	<br />	<b>Poznámka:</b> Ujistìte se, že verze Nucleusu, ve které jste provedl zálohu, je stejná, jako verze, kterou používáte nyní! Jinak obnova nebude fungovat.');
define('_RESTORE_INTRO',			'Zde vyberte soubor se zálohou (bude nahrán na server) a kliknìte na tlaèítko "Obnovit" pro zahájení akce.');
define('_RESTORE_IMSURE',			'Ano, jsem si jistý, že to chci udìlat!');
define('_RESTORE_BTN',				'Obnovit ze souboru');
define('_RESTORE_WARNING',			'(ujistìte se, že obnovujete správnou zálohu, pøípadnì si nejprve zazálohujte stávající data)');
define('_ERROR_BACKUP_NOTSURE',		'Musíte zaškrtnout políèko \'Jsem si jistý\'');
define('_RESTORE_COMPLETE',			'Obnova byla dokonèena');

// new item notification
define('_NOTIFY_NI_MSG',			'Byl publikován nový èlánek:');
define('_NOTIFY_NI_TITLE',			'Nový èlánek!');
define('_NOTIFY_KV_MSG',			'Karma volba u èlánku:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'Komentáø ke èlánku:');
define('_NOTIFY_NC_TITLE',			'Nucleus komentáø:');
define('_NOTIFY_USERID',			'ID uživatele:');
define('_NOTIFY_USER',				'Uživatel:');
define('_NOTIFY_COMMENT',			'Komentáø:');
define('_NOTIFY_VOTE',				'Volba:');
define('_NOTIFY_HOST',				'Server:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'Èlen:');
define('_NOTIFY_TITLE',				'Nadpis:');
define('_NOTIFY_CONTENTS',			'Text:');

// member mail message
define('_MMAIL_MSG',				'Obdržel jste novou zprávu od');
define('_MMAIL_FROMANON',			'anonymního návštìvníka');
define('_MMAIL_FROMNUC',			'Odesláno v systému Nucleus weblog v');
define('_MMAIL_TITLE',				'Zpráva od');
define('_MMAIL_MAIL',				'Zpráva:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'Pøidat èlánek');
define('_BMLET_EDIT',				'Upravit èlánek');
define('_BMLET_DELETE',				'Odstranit èlánek');
define('_BMLET_BODY',				'Text');
define('_BMLET_MORE',				'Rozšíøený text');
define('_BMLET_OPTIONS',			'Volby');
define('_BMLET_PREVIEW',			'Náhled');

// used in bookmarklet
define('_ITEM_UPDATED',				'Èlánek byl upraven');
define('_ITEM_DELETED',				'Èlánek byl odstranìn');

// plugins
define('_CONFIRMTXT_PLUGIN',		'Skuteènì chcete odstranit plugin');
define('_ERROR_NOSUCHPLUGIN',		'Takový plugin neexistuje');
define('_ERROR_DUPPLUGIN',			'Tento plugin již byl nainstalován');
define('_ERROR_PLUGFILEERROR',		'Plugin neexistuje, nebo jsou špatnì nastavena pøístupová práva');
define('_PLUGS_NOCANDIDATES',		'Žádné pluginy nebyly nalezeny');

define('_PLUGS_TITLE_MANAGE',		'Správa pluginù');
define('_PLUGS_TITLE_INSTALLED',	'Momentálnì nainstalované');
define('_PLUGS_TITLE_UPDATE',		'Aktualizovat seznam odbìrù');
define('_PLUGS_TEXT_UPDATE',		'Nucleus si udržuje databázi odbìrù událostí pro pluginy. Pokud nahrajete novou verzi pluginu, mìl byste spustit tuto aktualizaci, aby byly odbìry obnoveny.');
define('_PLUGS_TITLE_NEW',			'Nainstalovat nový plugin');
define('_PLUGS_ADD_TEXT',			'Dole vidíte seznam souborù z adresáøe pluginù, které jsou patrnì nenainstalované pluginy. Pøed jejich nainstalováním se ujistìte, že to jsou <strong>urèitì</strong> pluginy.');
define('_PLUGS_BTN_INSTALL',		'Nainstalovat plugin');
define('_BACKTOOVERVIEW',			'Zpátky k pøehledu');

// editlink
define('_TEMPLATE_EDITLINK',		'Odkaz na editaci èlánku');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'Pøidat rámeèek vlevo');
define('_ADD_RIGHT_TT',				'Pøidat rámeèek vpravo');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'Nová kategorie...');

// new settings
define('_SETTINGS_PLUGINURL',		'URL s pluginy');
define('_SETTINGS_MAXUPLOADSIZE',	'Max. velikost souboru pro nahrání (bytes)');
define('_SETTINGS_NONMEMBERMSGS',	'Povolit neregistrovaným posílat zprávy');
define('_SETTINGS_PROTECTMEMNAMES',	'Chránit jména èlenù');

// overview screen
define('_OVERVIEW_PLUGINS',			'Správa pluginù...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'Registrace nového èlena:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'Vaše emailová adresa:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'Nemáte správcovská práva pro žádný z blogù, které mají pøíjemce ve svém týmu. Proto nesmíte nahrávat soubory do adresáøe této osoby.');

// plugin list
define('_LISTS_INFO',				'Informace');
define('_LIST_PLUGS_AUTHOR',		'Od:');
define('_LIST_PLUGS_VER',			'Verze:');
define('_LIST_PLUGS_SITE',			'Navštívit stránku');
define('_LIST_PLUGS_DESC',			'Popis:');
define('_LIST_PLUGS_SUBS',			'Odbìratel tìchto událostí:');
define('_LIST_PLUGS_UP',			'nahoru');
define('_LIST_PLUGS_DOWN',			'dolù');
define('_LIST_PLUGS_UNINSTALL',		'odinstalovat');
define('_LIST_PLUGS_ADMIN',			'správce');
define('_LIST_PLUGS_OPTIONS',		'upravit&nbsp;nastavení');

// plugin option list
define('_LISTS_VALUE',				'Hodnota');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'tento plugin nemá žádná nastavení');
define('_PLUGS_BACK',				'Zpìt na pøehled pluginù');
define('_PLUGS_SAVE',				'Uložit nastavení');
define('_PLUGS_OPTIONS_UPDATED',	'Nastavení pluginu byla upravena');

define('_OVERVIEW_MANAGEMENT',		'Správa');
define('_OVERVIEW_MANAGE',			'Správa Nucleusu...');
define('_MANAGE_GENERAL',			'Obecná nastavení');
define('_MANAGE_SKINS',				'Vzhled a šablony');
define('_MANAGE_EXTRA',				'Extra volby');

define('_BACKTOMANAGE',				'Zpìt na správu Nucleusu');


// END introduced after v1.1 END




// charset to use 
define('_CHARSET',					'windows-1250');

// global stuff
define('_LOGOUT',					'Odhlásit se');
define('_LOGIN',					'Pøihlásit se');
define('_YES',						'Ano');
define('_NO',						'Ne');
define('_SUBMIT',					'Odeslat');
define('_ERROR',					'Chyba');
define('_ERRORMSG',					'Vyskytla se chyba!');
define('_BACK',						'Zpìt');
define('_NOTLOGGEDIN',				'Nejste pøihlášen');
define('_LOGGEDINAS',				'Pøihlášen jako');
define('_ADMINHOME',				'Správce');
define('_NAME',						'Jméno');
define('_BACKHOME',					'Zpìt na správcovskou stránku');
define('_BADACTION',				'Byla požadována neexistující akce');
define('_MESSAGE',					'Zpráva');
define('_HELP_TT',					'Pomoc!');
define('_YOURSITE',					'Vaše stránka');


define('_POPUP_CLOSE',				'Zavøít okno');

define('_LOGIN_PLEASE',				'Prosím, nejprve se pøihlašte');

// commentform
define('_COMMENTFORM_YOUARE',		'Jste');
define('_COMMENTFORM_SUBMIT',		'Pøidat komentáø');
define('_COMMENTFORM_COMMENT',		'Váš komentáø');
define('_COMMENTFORM_NAME',			'Jméno');
define('_COMMENTFORM_MAIL',			'E-mail/HTTP');
define('_COMMENTFORM_REMEMBER',		'Pamatuj si mne');

// loginform
define('_LOGINFORM_NAME',			'Jméno');
define('_LOGINFORM_PWD',			'Heslo');
define('_LOGINFORM_YOUARE',			'Pøihlášen jako');
define('_LOGINFORM_SHARED',			'Sdílený poèítaè');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'Poslat zprávu');

// search form
define('_SEARCHFORM_SUBMIT',		'Hledání');

// add item form
define('_ADD_ADDTO',				'Pøidat nový èlánek do');
define('_ADD_CREATENEW',			'Vytvoøit nový èlánek');
define('_ADD_BODY',					'Text');
define('_ADD_TITLE',				'Nadpis');
define('_ADD_MORE',					'Rozšíøený text (volitelnì)');
define('_ADD_CATEGORY',				'Kategorie');
define('_ADD_PREVIEW',				'Náhled');
define('_ADD_DISABLE_COMMENTS',		'Zakázat komentáøe?');
define('_ADD_DRAFTNFUTURE',			'Koncepty a èlánky pro pozdìjší publikování');
define('_ADD_ADDITEM',				'Pøidat èlánek');
define('_ADD_ADDNOW',				'Pøidat nyní');
define('_ADD_ADDLATER',				'Pøidat pozdìji');
define('_ADD_PLACE_ON',				'Umístit na');
define('_ADD_ADDDRAFT',				'Pøidat mezi koncepty');
define('_ADD_NOPASTDATES',			'(data a èasy v minulosti NEJSOU platné, v tom pøípadì bude použit aktuální èas)');
define('_ADD_BOLD_TT',				'Tuèné');
define('_ADD_ITALIC_TT',			'Kurzíva');
define('_ADD_HREF_TT',				'Vytvoøit odkaz');
define('_ADD_MEDIA_TT',				'Pøidat obrázek');
define('_ADD_PREVIEW_TT',			'Zobrazit/skrýt náhled');
define('_ADD_CUT_TT',				'Vyjmout');
define('_ADD_COPY_TT',				'Kopírovat');
define('_ADD_PASTE_TT',				'Vložit');


// edit item form
define('_EDIT_ITEM',				'Upravit èlánek');
define('_EDIT_SUBMIT',				'Upravit èlánek');
define('_EDIT_ORIG_AUTHOR',			'Pùvodní autor');
define('_EDIT_BACKTODRAFTS',		'Pøidat zpátky mezi koncepty');
define('_EDIT_COMMENTSNOTE',		'(poznámka: zakázání komentáøù _neskryje_ døíve pøidané komentáøe)');

// used on delete screens
define('_DELETE_CONFIRM',			'Prosím, potvrïte odstranìní');
define('_DELETE_CONFIRM_BTN',		'Potvrzení odstranìní');
define('_CONFIRMTXT_ITEM',			'Chystáte se odstranit následující èlánek:');
define('_CONFIRMTXT_COMMENT',		'Chystáte se odstranit následující komentáø:');
define('_CONFIRMTXT_TEAM1',			'Chystáte se odstranit uživatele ');
define('_CONFIRMTXT_TEAM2',			' z týmu pro blog ');
define('_CONFIRMTXT_BLOG',			'Blog, který hodláte odstranit, je: ');
define('_WARNINGTXT_BLOGDEL',		'Pozor! Odstranìním blogu dojde k vymazání VŠECH èlánkù tohoto blogu a všech komentáøù. Prosím, potvrïte, že to OPRAVDU chcete udìlat!<br />Bìhem odstraòování blogu nepøerušujte Nucleus.');
define('_CONFIRMTXT_MEMBER',		'Chystáte se odstranit profil následujícího èlena: ');
define('_CONFIRMTXT_TEMPLATE',		'Chystáte se odstranit šablonu ');
define('_CONFIRMTXT_SKIN',			'Chystáte se odstranit vzhled ');
define('_CONFIRMTXT_BAN',			'Chystáte se odstranit omezení pøístupu pro ip adresy');
define('_CONFIRMTXT_CATEGORY',		'Chystáte se odstranit kategorii ');

// some status messages
define('_DELETED_ITEM',				'Èlánek odstranìn');
define('_DELETED_MEMBER',			'Reg. uživatel odstranìn');
define('_DELETED_COMMENT',			'Komentáø odstranìn');
define('_DELETED_BLOG',				'Blog odstranìn');
define('_DELETED_CATEGORY',			'Kategorie odstranìna');
define('_ITEM_MOVED',				'Èlánek pøesunut');
define('_ITEM_ADDED',				'Èlánek pøidán');
define('_COMMENT_UPDATED',			'Komentáø upraven');
define('_SKIN_UPDATED',				'Vzhled byl uložen');
define('_TEMPLATE_UPDATED',			'Šablona byla uložena');

// errors
define('_ERROR_COMMENT_LONGWORD',	'Prosím, v komentáøích nepoužívejte slova delší než 90 znakù');
define('_ERROR_COMMENT_NOCOMMENT',	'Prosím, vložte komentáø');
define('_ERROR_COMMENT_NOUSERNAME',	'Špatné uživatelské jméno');
define('_ERROR_COMMENT_TOOLONG',	'Váš komentáø je pøíliš dlouhý (max. 5000 znakù)');
define('_ERROR_COMMENTS_DISABLED',	'Komentáøe pro tento blog jsou momentálnì zakázány.');
define('_ERROR_COMMENTS_NONPUBLIC',	'Abyste mohl pøidávat komentáøe do tohoto blogu, musíte být pøihlášen');
define('_ERROR_COMMENTS_MEMBERNICK','Jméno, pod kterým chcete odeslat komentáø, používá jiný registrovaný uživatel. Použijte nìjaké jiné.');
define('_ERROR_SKIN',				'Chyba v definici vzhledu');
define('_ERROR_ITEMCLOSED',			'Tento èlánek byl uzavøen. Už není možné k nìmu pøidávat komentáøe ani hlasovat');
define('_ERROR_NOSUCHITEM',			'Èlánek nenalezen');
define('_ERROR_NOSUCHBLOG',			'Blog nenalezen');
define('_ERROR_NOSUCHSKIN',			'Vzhled nenalezen');
define('_ERROR_NOSUCHMEMBER',		'Registrovaný uživatel nenalezen');
define('_ERROR_NOTONTEAM',			'Nejste èlenem týmu tohoto blogu');
define('_ERROR_BADDESTBLOG',		'Cílový blog neexistuje');
define('_ERROR_NOTONDESTTEAM',		'Nelze pøesunout èlánek, protože nejste èlenem týmu cílového blogu');
define('_ERROR_NOEMPTYITEMS',		'Nelze pøidat prázdný èlánek!');
define('_ERROR_BADMAILADDRESS',		'Emailová adresa není platná');
define('_ERROR_BADNOTIFY',			'Jedna nebo více z udaných adres pro oznamování není platná emailová adresa');
define('_ERROR_BADNAME',			'Jméno není platné (jsou dovoleny pouze znaky a-z a 0-9, žádné mezery na zaèátku a na konci)');
define('_ERROR_NICKNAMEINUSE',		'Tuto pøezdívku již používá jiný registrovaný èlen');
define('_ERROR_PASSWORDMISMATCH',	'Hesla musejí být stejná');
define('_ERROR_PASSWORDTOOSHORT',	'Heslo by mìlo mít alespoò 6 znakù');
define('_ERROR_PASSWORDMISSING',	'Heslo nesmí být prázdné');
define('_ERROR_REALNAMEMISSING',	'Musíte vložit skuteèné jméno');
define('_ERROR_ATLEASTONEADMIN',	'Mìl by být vždy aspoò jeden super-správce, který se mùže pøihlásit do správcovské sekce.');
define('_ERROR_ATLEASTONEBLOGADMIN','Vykonání této akce by zpùsobilo, že by váš blog nemìl kdo spravovat.  Ujistìte se, že vždy existuje alespoò jeden správce.');
define('_ERROR_ALREADYONTEAM',		'Nemùžete pøidat uživatele, který už je èlenem týmu');
define('_ERROR_BADSHORTBLOGNAME',	'Krátké jméno blogu by mìlo obsahovat jen znaky a-z a 0-9, bez mezer');
define('_ERROR_DUPSHORTBLOGNAME',	'Toto krátké jméno již používá jiný blog. Tato jména musejí být unikátní.');
define('_ERROR_UPDATEFILE',			'Nelze zapisovat to update-souboru. Ujistìte se, že jsou správnì nastavena pøístupová práva (zkuste chmod 666). Také pozor na to, že umístìní je relativní k adresáøi správcovské oblasti, takže byste mohl zkusit absolutní cestu (nìco jako /your/path/to/nucleus/)');
define('_ERROR_DELDEFBLOG',			'Nelze odstranit výchozí blog');
define('_ERROR_DELETEMEMBER',		'Tento uživatel nemùže být odstranìn. Patrnì protože je autorem nìjakých èlánkù, nebo komentáøù.');
define('_ERROR_BADTEMPLATENAME',	'Neplatné jméno šablony. Použijte pouze znaky a-z a 0-9, žádné mezery.');
define('_ERROR_DUPTEMPLATENAME',	'Již existuje šablona s tímto názvem.');
define('_ERROR_BADSKINNAME',		'Neplatné jméno vzhledu (použijte pouze znaky a-z a 0-9, žádné mezery)');
define('_ERROR_DUPSKINNAME',		'Již existuje vzhled s tímto názvem.');
define('_ERROR_DEFAULTSKIN',		'Vzhled s názvem "default" musí být vždy dostupný.');
define('_ERROR_SKINDEFDELETE',		'Nelze odstranit vzhled, protože že to výchozí vzhled pro následující blog: ');
define('_ERROR_DISALLOWED',			'Promiòte, ale nejste oprávnìn provádìt tuto akci.');
define('_ERROR_DELETEBAN',			'Chyba pøi odstraòování omezení pøístupu (omezení pøístupu neexistuje)');
define('_ERROR_ADDBAN',				'Chyba pøi pøidávání omezení pøístupu. Omezení pøístupu asi nebylo korektnì pøidáno do všech blogù.');
define('_ERROR_BADACTION',			'Požadovaná akce neexistuje');
define('_ERROR_MEMBERMAILDISABLED',	'Mailové zprávy mezi èleny jsou zakázány.');
define('_ERROR_MEMBERCREATEDISABLED','Vytváøení uživatelských kont je zakázáno.');
define('_ERROR_INCORRECTEMAIL',		'Špatná mailová adresa');
define('_ERROR_VOTEDBEFORE',		'Pro tento èlánek už jste hlasoval');
define('_ERROR_BANNED1',			'Akci nelze vykonat, protože vám (rozsah adres ');
define('_ERROR_BANNED2',			') byl omezen pøístup. Zpráva byla: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'Abyste mohl vykonat tuto akci, musíte se pøihlásit.');
define('_ERROR_CONNECT',			'Chyba spojení');
define('_ERROR_FILE_TOO_BIG',		'Soubor je pøíliš velký!');
define('_ERROR_BADFILETYPE',		'Promiòte, ale tento typ souboru není povolen.');
define('_ERROR_BADREQUEST',			'Špatný požadavek pro nahrání souboru');
define('_ERROR_DISALLOWEDUPLOAD',	'Nejste èlenem týmu žádného blogu, a proto nemùžete nahrávat soubory.');
define('_ERROR_BADPERMISSIONS',		'Práva pro soubor/adresáø nejsou správnì nastavena');
define('_ERROR_UPLOADMOVEP',		'Chyba pøi pøesunu nahraného souboru');
define('_ERROR_UPLOADCOPY',			'Chyba pøi kopírování souboru');
define('_ERROR_UPLOADDUPLICATE',	'Soubor s tímto názvem již existuje. Pøed nahráním ho zkuste pøejmenovat.');
define('_ERROR_LOGINDISALLOWED',	'Promiòte, ale nemùžete se pøihlásit do správcovské oblasti. Nicménì mùžete se pøihlásit jako jiný uživatel.');
define('_ERROR_DBCONNECT',			'Nelze se pøipojit k mySQL serveru');
define('_ERROR_DBSELECT',			'Nelze vybrat databázi nucleus.');
define('_ERROR_NOSUCHLANGUAGE',		'Tento jazykový soubor neexistuje');
define('_ERROR_NOSUCHCATEGORY',		'Taková kategorie neexistuje');
define('_ERROR_DELETELASTCATEGORY',	'Musí existovat alespoò jedna kategorie');
define('_ERROR_DELETEDEFCATEGORY',	'Nelze odstranit výchozí kategorii');
define('_ERROR_BADCATEGORYNAME',	'Špatný název kategorie');
define('_ERROR_DUPCATEGORYNAME',	'Kategorie s tímto názvem už existuje');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'Pozor: Aktuální hodnota není adresáø!');
define('_WARNING_NOTREADABLE',		'Pozor: Aktuální hodnota není adresáø pro ètení!');
define('_WARNING_NOTWRITABLE',		'Pozor: Aktuální hodnota NENÍ adresáø, do kterého lze zapisovat!');

// media and upload
define('_MEDIA_UPLOADLINK',			'Nahrát nový soubor');
define('_MEDIA_MODIFIED',			'modifikován');
define('_MEDIA_FILENAME',			'název souboru');
define('_MEDIA_DIMENSIONS',			'rozmìry');
define('_MEDIA_INLINE',				'Uvnitø');
define('_MEDIA_POPUP',				'Okno');
define('_UPLOAD_TITLE',				'Zvolte soubor');
define('_UPLOAD_MSG',				'Vyberte soubor pro nahrání, a potom stisknìte tlaèítko \'Nahrát\'.');
define('_UPLOAD_BUTTON',			'Nahrát');

// some status messages
define('_MSG_ACCOUNTCREATED',		'Úèet byl vytvoøen. Heslo obdržíte emailem.');
define('_MSG_PASSWORDSENT',			'Heslo vám bylo odesláno emailem.');
define('_MSG_LOGINAGAIN',			'Budete se muset znovu pøihlásit, protože vaše údaje byly zmìnìny.');
define('_MSG_SETTINGSCHANGED',		'Nastavení zmìnìna');
define('_MSG_ADMINCHANGED',			'Správce zmìnìn');
define('_MSG_NEWBLOG',				'Nový blog byl vytvoøen');
define('_MSG_ACTIONLOGCLEARED',		'Log akcí byl smazán');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'Nepovolená akce: ');
define('_ACTIONLOG_PWDREMINDERSENT','Odesláno nové heslo pro ');
define('_ACTIONLOG_TITLE',			'Log akcí');
define('_ACTIONLOG_CLEAR_TITLE',	'Smazat log akcí');
define('_ACTIONLOG_CLEAR_TEXT',		'Vymazat log akcí');

// team management
define('_TEAM_TITLE',				'Správa týmu pro blog ');
define('_TEAM_CURRENT',				'Aktuální tým');
define('_TEAM_ADDNEW',				'Pøidat èlena do týmu');
define('_TEAM_CHOOSEMEMBER',		'Zvolte èlena');
define('_TEAM_ADMIN',				'Správcovská práva? ');
define('_TEAM_ADD',					'Pøidat do týmu');
define('_TEAM_ADD_BTN',				'Pøidat do týmu');

// blogsettings
define('_EBLOG_TITLE',				'Upravit nastavení blogu');
define('_EBLOG_TEAM_TITLE',			'Upravit tým');
define('_EBLOG_TEAM_TEXT',			'Kliknìte zde pro úpravu týmu...');
define('_EBLOG_SETTINGS_TITLE',		'Nastavení blogu');
define('_EBLOG_NAME',				'Jméno blogu');
define('_EBLOG_SHORTNAME',			'Krátké jméno blogu');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(pouze znaky a-z bez mezer)');
define('_EBLOG_DESC',				'Popis blogu');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'Výchozí vzhled');
define('_EBLOG_DEFCAT',				'Výchozí kategorie');
define('_EBLOG_LINEBREAKS',			'Pøevádìt odøádkování');
define('_EBLOG_DISABLECOMMENTS',	'Povolit komentáøe?<br /><small>(Urèuje, zda lze pøidávat komentáøe)</small>');
define('_EBLOG_ANONYMOUS',			'Povolit komentáøe od neregistrovaných návštìvníkù?');
define('_EBLOG_NOTIFY',				'Adresa/adresy pro oznamování (použijte ; jako oddìlovaè)');
define('_EBLOG_NOTIFY_ON',			'Oznamovat zaslání');
define('_EBLOG_NOTIFY_COMMENT',		'Nových komentáøù');
define('_EBLOG_NOTIFY_KARMA',		'Nových karma hlasù');
define('_EBLOG_NOTIFY_ITEM',		'Nových èlánkù blogu');
define('_EBLOG_PING',				'Ping na Weblogs.com pøi zmìnách?');
define('_EBLOG_MAXCOMMENTS',		'Maximální poèet komentáøù');
define('_EBLOG_UPDATE',				'Zapsat zmìny do souboru');
define('_EBLOG_OFFSET',				'Èasový posun');
define('_EBLOG_STIME',				'Aktuální èas serveru je');
define('_EBLOG_BTIME',				'Aktuální èas blogu je');
define('_EBLOG_CHANGE',				'Zmìnit nastavení');
define('_EBLOG_CHANGE_BTN',			'Zmìnit nastavení');
define('_EBLOG_ADMIN',				'Správce blogu');
define('_EBLOG_ADMIN_MSG',			'Obdržíte správcovská práva');
define('_EBLOG_CREATE_TITLE',		'Vytvoøit nový blog');
define('_EBLOG_CREATE_TEXT',		'Pro vytvoøení nového blogu vyplòte následující formuláø. <br /><br /> <b>Poznámka:</b> Jsou zde vypsány pouze nejnutnìjší volby. Pokud chcete zmìnit další nastavení, po vytvoøení blogu navštivte stránku s vlastnostmi blogu.');
define('_EBLOG_CREATE',				'Vytvoøit!');
define('_EBLOG_CREATE_BTN',			'Vytvoøit blog');
define('_EBLOG_CAT_TITLE',			'Kategorie');
define('_EBLOG_CAT_NAME',			'Název kategorie');
define('_EBLOG_CAT_DESC',			'Popis kategorie');
define('_EBLOG_CAT_CREATE',			'Vytvoøit novou kategorii');
define('_EBLOG_CAT_UPDATE',			'Upravit kategorii');
define('_EBLOG_CAT_UPDATE_BTN',		'Upravit kategorii');

// templates
define('_TEMPLATE_TITLE',			'Upravit šablony');
define('_TEMPLATE_AVAILABLE_TITLE',	'Dostupné šablony');
define('_TEMPLATE_NEW_TITLE',		'Nová šablona');
define('_TEMPLATE_NAME',			'Název šablony');
define('_TEMPLATE_DESC',			'Popis šablony');
define('_TEMPLATE_CREATE',			'Vytvoøit šablonu');
define('_TEMPLATE_CREATE_BTN',		'Vytvoøit šablonu');
define('_TEMPLATE_EDIT_TITLE',		'Upravit šablonu');
define('_TEMPLATE_BACK',			'Zpìt na pøehled šablon');
define('_TEMPLATE_EDIT_MSG',		'Ne všechny èásti šablony jsou vyžadovány. Nepotøebné èásti nechte prázdné.');
define('_TEMPLATE_SETTINGS',		'Nastavení šablony');
define('_TEMPLATE_ITEMS',			'Èlánky');
define('_TEMPLATE_ITEMHEADER',		'Hlavièka èlánku');
define('_TEMPLATE_ITEMBODY',		'Tìlo èlánku');
define('_TEMPLATE_ITEMFOOTER',		'Patièka èlánku');
define('_TEMPLATE_MORELINK',		'Odkaz na rozšiøující text');
define('_TEMPLATE_NEW',				'Oznaèení nového èlánku');
define('_TEMPLATE_COMMENTS_ANY',	'Komentáøe (pokud jsou)');
define('_TEMPLATE_CHEADER',			'Hlavièka komentáøe');
define('_TEMPLATE_CBODY',			'Tìlo komentáøe');
define('_TEMPLATE_CFOOTER',			'Patièka komentáøe');
define('_TEMPLATE_CONE',			'Jeden komentáø');
define('_TEMPLATE_CMANY',			'Dva (a více) komentáøù');
define('_TEMPLATE_CMORE',			'\'Èíst více\' u komentáøù');
define('_TEMPLATE_CMEXTRA',			'Další údaje jen pro èleny');
define('_TEMPLATE_COMMENTS_NONE',	'Komentáøe (nejsou-li žádné)');
define('_TEMPLATE_CNONE',			'Žádné komentáøe');
define('_TEMPLATE_COMMENTS_TOOMUCH','Komentáøe (pokud jsou, ale je jich víc, než se dá zobrazit pøímo)');
define('_TEMPLATE_CTOOMUCH',		'Pøíliš mnoho komentáøù');
define('_TEMPLATE_ARCHIVELIST',		'Seznam archivù');
define('_TEMPLATE_AHEADER',			'Hlavièka seznamu archivù');
define('_TEMPLATE_AITEM',			'Položka seznamu archivù');
define('_TEMPLATE_AFOOTER',			'Patièka seznamu archivù');
define('_TEMPLATE_DATETIME',		'Datum a èas');
define('_TEMPLATE_DHEADER',			'Hlavièka datumu');
define('_TEMPLATE_DFOOTER',			'Patièka datumu');
define('_TEMPLATE_DFORMAT',			'Formát datumu');
define('_TEMPLATE_TFORMAT',			'Formát èasu');
define('_TEMPLATE_LOCALE',			'Místní nastavení');
define('_TEMPLATE_IMAGE',			'Okna s obrázkem');
define('_TEMPLATE_PCODE',			'Kód odkazu pro okna s obrázkem');
define('_TEMPLATE_ICODE',			'Kód pro vložený obrázek');
define('_TEMPLATE_MCODE',			'Kód odkazu na soubor médií');
define('_TEMPLATE_SEARCH',			'Hledání');
define('_TEMPLATE_SHIGHLIGHT',		'Zvýraznìní');
define('_TEMPLATE_SNOTFOUND',		'Pøi hledání nebylo nic nalezeno');
define('_TEMPLATE_UPDATE',			'Upravit');
define('_TEMPLATE_UPDATE_BTN',		'Upravit šablonu');
define('_TEMPLATE_RESET_BTN',		'Pùvodní data');
define('_TEMPLATE_CATEGORYLIST',	'Seznamy kategorií');
define('_TEMPLATE_CATHEADER',		'Hlavièka seznamu kategorií');
define('_TEMPLATE_CATITEM',			'Položka seznamu kategorií');
define('_TEMPLATE_CATFOOTER',		'Patièka seznamu kategorií');

// skins
define('_SKIN_EDIT_TITLE',			'Upravit vzhledy');
define('_SKIN_AVAILABLE_TITLE',		'Dostupné vzhledy');
define('_SKIN_NEW_TITLE',			'Nový vzhled');
define('_SKIN_NAME',				'Název');
define('_SKIN_DESC',				'Popis');
define('_SKIN_TYPE',				'Typ obsahu');
define('_SKIN_CREATE',				'Vytvoøit');
define('_SKIN_CREATE_BTN',			'Vytvoøit vzhled');
define('_SKIN_EDITONE_TITLE',		'Upravit vzhled');
define('_SKIN_BACK',				'Zpìt na pøehled vzhledù');
define('_SKIN_PARTS_TITLE',			'Èásti vzhledu');
define('_SKIN_PARTS_MSG',			'Pro každý vzhled nejsou potøeba všechny typy. Ty, které nepotøebujete, nechte prázdné. Zvolte typ vzhledu, který chcete upravit::');
define('_SKIN_PART_MAIN',			'Hlavní pøehled');
define('_SKIN_PART_ITEM',			'Stránky èlánku');
define('_SKIN_PART_ALIST',			'Seznam archivù');
define('_SKIN_PART_ARCHIVE',		'Archiv');
define('_SKIN_PART_SEARCH',			'Hledání');
define('_SKIN_PART_ERROR',			'Chyby');
define('_SKIN_PART_MEMBER',			'Detaily reg. uživatele');
define('_SKIN_PART_POPUP',			'Okna s obrázkem');
define('_SKIN_GENSETTINGS_TITLE',	'Obecná nastavení');
define('_SKIN_CHANGE',				'Zmìnit');
define('_SKIN_CHANGE_BTN',			'Zmìnit tato nastavení');
define('_SKIN_UPDATE_BTN',			'Uložit vzhled');
define('_SKIN_RESET_BTN',			'Pùvodní data');
define('_SKIN_EDITPART_TITLE',		'Upravit vzhled');
define('_SKIN_GOBACK',				'Zpìt');
define('_SKIN_ALLOWEDVARS',			'Dostupné promìnné (kliknìte pro bližší informace):');

// global settings
define('_SETTINGS_TITLE',			'Obecná nastavení');
define('_SETTINGS_SUB_GENERAL',		'Obecná nastavení');
define('_SETTINGS_DEFBLOG',			'Výchozí blog');
define('_SETTINGS_ADMINMAIL',		'Email správce');
define('_SETTINGS_SITENAME',		'Název stránky');
define('_SETTINGS_SITEURL',			'URL stránky (mìlo by konèit lomítkem)');
define('_SETTINGS_ADMINURL',		'URL správcovské oblasti (mìlo by konèit lomítkem)');
define('_SETTINGS_DIRS',			'Adresáøe Nucleusu');
define('_SETTINGS_MEDIADIR',		'Adresáø s médii');
define('_SETTINGS_SEECONFIGPHP',	'(viz config.php)');
define('_SETTINGS_MEDIAURL',		'URL médií (mìlo by konèit lomítkem)');
define('_SETTINGS_ALLOWUPLOAD',		'Povolit nahrávání (upload) souborù?');
define('_SETTINGS_ALLOWUPLOADTYPES','Typy souborù, které lze nahrát');
define('_SETTINGS_CHANGELOGIN',		'Povolit registrovaným uživatelùm mìnit jméno/heslo');
define('_SETTINGS_COOKIES_TITLE',	'Nastavení cookies');
define('_SETTINGS_COOKIELIFE',		'Doba životnosti pøihlašovacího cookie');
define('_SETTINGS_COOKIESESSION',	'Jednorázové cookies (session)');
define('_SETTINGS_COOKIEMONTH',		'Mìsíc');
define('_SETTINGS_COOKIEPATH',		'Cesta cookie (pokroèilé)');
define('_SETTINGS_COOKIEDOMAIN',	'Doména cookie (pokroèilé)');
define('_SETTINGS_COOKIESECURE',	'Zabezpeèné cookie (pokroèilé)');
define('_SETTINGS_LASTVISIT',		'Ukládat cookies poslední návštìvy');
define('_SETTINGS_ALLOWCREATE',		'Povolit návštìvníkùm vytvoøit si registrovaný úèet');
define('_SETTINGS_NEWLOGIN',		'Povolit pøihlášení z úètù, vytvoøených návštìvníky');
define('_SETTINGS_NEWLOGIN2',		'(pouze pro novì vytvoøené úèty)');
define('_SETTINGS_MEMBERMSGS',		'Povolit služby mezi èleny');
define('_SETTINGS_LANGUAGE',		'Výchozí jazyk');
define('_SETTINGS_DISABLESITE',		'Vypnout stránku');
define('_SETTINGS_DBLOGIN',			'mySQL Login a Databáze');
define('_SETTINGS_UPDATE',			'Uložit nastavení');
define('_SETTINGS_UPDATE_BTN',		'Uložit nastavení');
define('_SETTINGS_DISABLEJS',		'Zakázat JavaScript Toolbar');
define('_SETTINGS_MEDIA',			'Nastavení pro média/nahrávání souborù');
define('_SETTINGS_MEDIAPREFIX',		'Nahraným souborùm pøidat pøed jméno datum');
define('_SETTINGS_MEMBERS',			'Nastavení registrovaných uživatelù');

// bans
define('_BAN_TITLE',				'Seznam omezení pøístupu pro');
define('_BAN_NONE',					'Tento blog nemá žádná omezení pøístupu');
define('_BAN_NEW_TITLE',			'Pøidat nové omezení pøístupu');
define('_BAN_NEW_TEXT',				'Pøidat omezení');
define('_BAN_REMOVE_TITLE',			'Odstranit omezení');
define('_BAN_IPRANGE',				'Rozsah IP adres');
define('_BAN_BLOGS',				'Které blogy?');
define('_BAN_DELETE_TITLE',			'Odstranit omezení');
define('_BAN_ALLBLOGS',				'Všechny blogy, ke kterým máte správcovská práva.');
define('_BAN_REMOVED_TITLE',		'Omezení pøístupu bylo odstranìno');
define('_BAN_REMOVED_TEXT',			'Bylo odstranìno omezení pøístupu pro následující blogy:');
define('_BAN_ADD_TITLE',			'Pøidat omezení pøístupu');
define('_BAN_IPRANGE_TEXT',			'Zadejte rozsah IP adres, které chcete blokovat. Èím menší èísla, tím více adres bude blokováno.');
define('_BAN_BLOGS_TEXT',			'Mùžete zablokovat rozsah IP adres pouze pro jeden blog, nebo pro všechny blogy, ke kterým máte správcovská práva.');
define('_BAN_REASON_TITLE',			'Dùvod');
define('_BAN_REASON_TEXT',			'Mùžete zadat dùvod omezení pøístupu, který bude zobrazen, pokud se vlastník blokované IP adresy pokusí pøidat komentáø, nebo odeslat karma hlas. Maximální délka je 256 znakù.');
define('_BAN_ADD_BTN',				'Pøidat omezení');

// LOGIN screen
define('_LOGIN_MESSAGE',			'Zpráva');
define('_LOGIN_NAME',				'Jméno');
define('_LOGIN_PASSWORD',			'Heslo');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'Zapomnìl jste heslo?');

// membermanagement
define('_MEMBERS_TITLE',			'Správa registrovaných uživatelù');
define('_MEMBERS_CURRENT',			'Aktuální uživatelé');
define('_MEMBERS_NEW',				'Nový uživatel');
define('_MEMBERS_DISPLAY',			'Zobrazované jméno');
define('_MEMBERS_DISPLAY_INFO',		'(Toto je jméno, pod kterým se pøihlašujete)');
define('_MEMBERS_REALNAME',			'Skuteèné jméno');
define('_MEMBERS_PWD',				'Heslo');
define('_MEMBERS_REPPWD',			'Zopakovat heslo');
define('_MEMBERS_EMAIL',			'Emailová adresa');
define('_MEMBERS_EMAIL_EDIT',		'(Pokud zmìníte emailovou adresu, bude vám na ni automaticky odesláno nové heslo)');
define('_MEMBERS_URL',				'Adresa webové stránky (URL)');
define('_MEMBERS_SUPERADMIN',		'Správcovská práva');
define('_MEMBERS_CANLOGIN',			'Mùže se pøihlásit do správcovské oblasti');
define('_MEMBERS_NOTES',			'Poznámky');
define('_MEMBERS_NEW_BTN',			'Pøidat uživatele');
define('_MEMBERS_EDIT',				'Upravit uživatele');
define('_MEMBERS_EDIT_BTN',			'Uložit nastavení');
define('_MEMBERS_BACKTOOVERVIEW',	'Zpìt na pøehled uživatelù');
define('_MEMBERS_DEFLANG',			'Jazyk');
define('_MEMBERS_USESITELANG',		'- výchozí jazyk stránky -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'Navštívit stránku');
define('_BLOGLIST_ADD',				'Pøidat èlánek');
define('_BLOGLIST_TT_ADD',			'Pøidat nový èlánek do tohoto blogu');
define('_BLOGLIST_EDIT',			'Upravit/odstranit èlánky');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Bookmarklet');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'Nastavení');
define('_BLOGLIST_TT_SETTINGS',		'Upravit nastavení nebo spravovat tým');
define('_BLOGLIST_BANS',			'Omezení pøístupu');
define('_BLOGLIST_TT_BANS',			'Zobrazit, pøidat nebo odstranit blokované IP adresy');
define('_BLOGLIST_DELETE',			'Odstranit vše');
define('_BLOGLIST_TT_DELETE',		'Odstranit tento blog');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'Vaše blogy');
define('_OVERVIEW_YRDRAFTS',		'Vaše koncepty');
define('_OVERVIEW_YRSETTINGS',		'Vaše nastavení');
define('_OVERVIEW_GSETTINGS',		'Obecná nastavení');
define('_OVERVIEW_NOBLOGS',			'Nejste èlenem týmu žádného z blogù');
define('_OVERVIEW_NODRAFTS',		'Žádné koncepty');
define('_OVERVIEW_EDITSETTINGS',	'Upravit vaše nastavení...');
define('_OVERVIEW_BROWSEITEMS',		'Prohlížet vaše èlánky...');
define('_OVERVIEW_BROWSECOMM',		'Prohlížet vaše komentáøe...');
define('_OVERVIEW_VIEWLOG',			'Prohlížet seznam akcí...');
define('_OVERVIEW_MEMBERS',			'Správa reg. uživatelù...');
define('_OVERVIEW_NEWLOG',			'Vytvoøit nový blog...');
define('_OVERVIEW_SETTINGS',		'Upravit nastavení...');
define('_OVERVIEW_TEMPLATES',		'Upravit šablony...');
define('_OVERVIEW_SKINS',			'Upravit vzhledy...');
define('_OVERVIEW_BACKUP',			'Záloha/obnova...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'Èlánky pro blog'); 
define('_ITEMLIST_YOUR',			'Vaše èlánky');

// Comments
define('_COMMENTS',					'Komentáøe');
define('_NOCOMMENTS',				'Tento èlánek nemá žádné komentáøe');
define('_COMMENTS_YOUR',			'Vaše komentáøe');
define('_NOCOMMENTS_YOUR',			'Nenapsal jste žádné komentáøe');

// LISTS (general)
define('_LISTS_NOMORE',				'Žádné další nebo vùbec žádné výsledky');
define('_LISTS_PREV',				'Pøedchozí');
define('_LISTS_NEXT',				'Další');
define('_LISTS_SEARCH',				'Hledat');
define('_LISTS_CHANGE',				'Zmìnit');
define('_LISTS_PERPAGE',			'èlánkù/strana');
define('_LISTS_ACTIONS',			'Akce');
define('_LISTS_DELETE',				'Odstranit');
define('_LISTS_EDIT',				'Upravit');
define('_LISTS_MOVE',				'Pøesunout');
define('_LISTS_CLONE',				'Zkopírovat');
define('_LISTS_TITLE',				'Titulek');
define('_LISTS_BLOG',				'Blog');
define('_LISTS_NAME',				'Název');
define('_LISTS_DESC',				'Popis');
define('_LISTS_TIME',				'Èas');
define('_LISTS_COMMENTS',			'Komentáøe');
define('_LISTS_TYPE',				'Typ');


// member list 
define('_LIST_MEMBER_NAME',			'Zobrazované jméno');
define('_LIST_MEMBER_RNAME',		'Skuteèné jméno');
define('_LIST_MEMBER_ADMIN',		'Super-správce? ');
define('_LIST_MEMBER_LOGIN',		'Mùže se pøihlásit? ');
define('_LIST_MEMBER_URL',			'Stránka');

// banlist
define('_LIST_BAN_IPRANGE',			'Rozsah IP adres');
define('_LIST_BAN_REASON',			'Dùvod');

// actionlist
define('_LIST_ACTION_MSG',			'Zpráva');

// commentlist
define('_LIST_COMMENT_BANIP',		'Blokovat IP adresu');
define('_LIST_COMMENT_WHO',			'Autor');
define('_LIST_COMMENT',				'Komentáø');
define('_LIST_COMMENT_HOST',		'Server');

// itemlist
define('_LIST_ITEM_INFO',			'Info');
define('_LIST_ITEM_CONTENT',		'Titulek a text');


// teamlist
define('_LIST_TEAM_ADMIN',			'Správce ');
define('_LIST_TEAM_CHADMIN',		'Zmìnit správce');

// edit comments
define('_EDITC_TITLE',				'Upravit komentáøe');
define('_EDITC_WHO',				'Autor');
define('_EDITC_HOST',				'Odkud?');
define('_EDITC_WHEN',				'Kdy?');
define('_EDITC_TEXT',				'Text');
define('_EDITC_EDIT',				'Upravit komentáø');
define('_EDITC_MEMBER',				'èlen');
define('_EDITC_NONMEMBER',			'není èlen');

// move item
define('_MOVE_TITLE',				'Pøesunout do jakého blogu?');
define('_MOVE_BTN',					'Pøesunout èlánek');

?>