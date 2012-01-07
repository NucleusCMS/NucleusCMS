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
define('_MEDIA_VIEW_TT',			'Zobrazit soubor (v novém okně)');
define('_MEDIA_FILTER_APPLY',		'Použít filtr');
define('_MEDIA_FILTER_LABEL',		'Filtr: ');
define('_MEDIA_UPLOAD_TO',			'Nahrát do...');
define('_MEDIA_UPLOAD_NEW',			'Nahrát nový soubor...');
define('_MEDIA_COLLECTION_SELECT',	'Výběr');
define('_MEDIA_COLLECTION_TT',		'Přepnout se do této kategorie');
define('_MEDIA_COLLECTION_LABEL',	'Aktuální kolekce:: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'Zarovnat doleva');
define('_ADD_ALIGNRIGHT_TT',		'Zarovnat doprava');
define('_ADD_ALIGNCENTER_TT',		'Zarovnat na střed');

// searchable blog setting (yes/no)
define('_EBLOG_SEARCH',				'Zahrnout do hledání');

// generic upload failure
define('_ERROR_UPLOADFAILED',		'Nahrávání selhalo');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'Povolit publikování do minulosti');
define('_ADD_CHANGEDATE',			'Přepsat datum/čas');
define('_BMLET_CHANGEDATE',			'Přepsat datum/čas');

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
define('_ERROR_MOVEDEFCATEGORY',	'Nelze přesunout výchozí kategorii');
define('_ERROR_MOVETOSELF',			'Nelze přesunout kategorii (cílový blog je stejný, jako zdrojový blog)');
define('_MOVECAT_TITLE',			'Vyberte blog, do kterého chcete přesunout kategorii');
define('_MOVECAT_BTN',				'Přesunout kategorii');

// URLMode setting
define('_SETTINGS_URLMODE',			'Režim URL');
define('_SETTINGS_URLMODE_NORMAL',	'Normální');
define('_SETTINGS_URLMODE_PATHINFO','Pestré');

// Batch operations
define('_BATCH_NOSELECTION',		'Pro provedení akce není nic vybráno');
define('_BATCH_ITEMS',				'Dávková operace na článcích');
define('_BATCH_CATEGORIES',			'Dávková operace na kategoriích');
define('_BATCH_MEMBERS',			'Dávková operace na uživatelích');
define('_BATCH_TEAM',				'Dávková operace na členech týmu');
define('_BATCH_COMMENTS',			'Dávková operace na komentářích');
define('_BATCH_UNKNOWN',			'Neznámá dávková operace: ');
define('_BATCH_EXECUTING',			'Spouští se');
define('_BATCH_ONCATEGORY',			'na kategorii');
define('_BATCH_ONITEM',				'na článku');
define('_BATCH_ONCOMMENT',			'na komentáři');
define('_BATCH_ONMEMBER',			'na uživateli');
define('_BATCH_ONTEAM',				'na členovi týmu');
define('_BATCH_SUCCESS',			'Úspěch!');
define('_BATCH_DONE',				'Hotovo!');
define('_BATCH_DELETE_CONFIRM',		'Potvrďte dávkové odstranění');
define('_BATCH_DELETE_CONFIRM_BTN',	'Potvrďte dávkové odstranění');
define('_BATCH_SELECTALL',			'vybrat vše');
define('_BATCH_DESELECTALL',		'nevybrat nic');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'Odstranit');
define('_BATCH_ITEM_MOVE',			'Přesunout');
define('_BATCH_MEMBER_DELETE',		'Odstranit');
define('_BATCH_MEMBER_SET_ADM',		'Nastavit správcovská práva');
define('_BATCH_MEMBER_UNSET_ADM',	'Odebrat správcovská práva');
define('_BATCH_TEAM_DELETE',		'Odstranit z týmu');
define('_BATCH_TEAM_SET_ADM',		'Nastavit správcovská práva');
define('_BATCH_TEAM_UNSET_ADM',		'Odebrat správcovská práva');
define('_BATCH_CAT_DELETE',			'Odstranit');
define('_BATCH_CAT_MOVE',			'Přesunout do jiného blogu');
define('_BATCH_COMMENT_DELETE',		'Odstranit');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'Přidat nový článek...');
define('_ADD_PLUGIN_EXTRAS',		'Nastavení pro pluginy');

// errors
define('_ERROR_CATCREATEFAIL',		'Nelze vytvořit novou kategorii');
define('_ERROR_NUCLEUSVERSIONREQ',	'Tento plugin vyžaduje novější verzi Nucleusu: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Zpět na nastavení blogu');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Import');
define('_SKINIE_TITLE_EXPORT',		'Export');
define('_SKINIE_BTN_IMPORT',		'Import');
define('_SKINIE_BTN_EXPORT',		'Export vybraných vzhledů/šablon');
define('_SKINIE_LOCAL',				'Import z lokálního souboru:');
define('_SKINIE_NOCANDIDATES',		'V adresáři vzhledů nebyly nalezeny žádné položky pro import');
define('_SKINIE_FROMURL',			'Import z URL:');
define('_SKINIE_EXPORT_INTRO',		'Vyberte vzhledy a šablony, které chcete exportovat');
define('_SKINIE_EXPORT_SKINS',		'Vzhledy');
define('_SKINIE_EXPORT_TEMPLATES',	'Šablony');
define('_SKINIE_EXPORT_EXTRA',		'Extra info');
define('_SKINIE_CONFIRM_OVERWRITE',	'Přepsat vzhledy, které již existují (viz konflikty jmen)');
define('_SKINIE_CONFIRM_IMPORT',	'Ano, toto chci naimportovat');
define('_SKINIE_CONFIRM_TITLE',		'Budou naimportovány vzhledy a šablony');
define('_SKINIE_INFO_SKINS',		'Vzhledy v souboru:');
define('_SKINIE_INFO_TEMPLATES',	'Šablony v souboru:');
define('_SKINIE_INFO_GENERAL',		'Info:');
define('_SKINIE_INFO_SKINCLASH',	'Konflikty v názvech vzhledů:');
define('_SKINIE_INFO_TEMPLCLASH',	'Konflikty v názvech šablon:');
define('_SKINIE_INFO_IMPORTEDSKINS','Importované vzhledy:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Importované šablony::');
define('_SKINIE_DONE',				'Import dokončen');

define('_AND',						'a');
define('_OR',						'nebo');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'prázdné pole (klikněte pro editaci)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'Režim vkládání:');
define('_LIST_SKINS_INCPREFIX',		'Prefix:');
define('_LIST_SKINS_DEFINED',		'Definované části:');

// backup
define('_BACKUPS_TITLE',			'Záloha / obnovení');
define('_BACKUP_TITLE',				'Záloha');
define('_BACKUP_INTRO',				'Klikněte na tlačítko pro vytvoření zálohy Nucleus databáze. Budete vyzván k uložení souboru se zálohou. Tento soubor poté uschovejte na bezpečném místě.');
define('_BACKUP_ZIP_YES',			'Pokusit se použít kompresi');
define('_BACKUP_ZIP_NO',			'Nepoužívat kompresi');
define('_BACKUP_BTN',				'Vytvořit zálohu');
define('_BACKUP_NOTE',				'<b>Poznámka:</b> Zálohuje se pouze obsah databáze. Obrázky a nastavení v config.php tudíž <b>NEJSOU</b> součástí zálohy.');
define('_RESTORE_TITLE',			'Obnovit');
define('_RESTORE_NOTE',				'<b>POZOR:</b> Obnova ze zálohy <b>VYMAŽE</b> stávající data v databázi! Tuto akci proveďte pouze pokud jste si opravdu jistý!	<br />	<b>Poznámka:</b> Ujistěte se, že verze Nucleusu, ve které jste provedl zálohu, je stejná, jako verze, kterou používáte nyní! Jinak obnova nebude fungovat.');
define('_RESTORE_INTRO',			'Zde vyberte soubor se zálohou (bude nahrán na server) a klikněte na tlačítko "Obnovit" pro zahájení akce.');
define('_RESTORE_IMSURE',			'Ano, jsem si jistý, že to chci udělat!');
define('_RESTORE_BTN',				'Obnovit ze souboru');
define('_RESTORE_WARNING',			'(ujistěte se, že obnovujete správnou zálohu, případně si nejprve zazálohujte stávající data)');
define('_ERROR_BACKUP_NOTSURE',		'Musíte zaškrtnout políčko \'Jsem si jistý\'');
define('_RESTORE_COMPLETE',			'Obnova byla dokončena');

// new item notification
define('_NOTIFY_NI_MSG',			'Byl publikován nový článek:');
define('_NOTIFY_NI_TITLE',			'Nový článek!');
define('_NOTIFY_KV_MSG',			'Karma volba u článku:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'Komentář ke článku:');
define('_NOTIFY_NC_TITLE',			'Nucleus komentář:');
define('_NOTIFY_USERID',			'ID uživatele:');
define('_NOTIFY_USER',				'Uživatel:');
define('_NOTIFY_COMMENT',			'Komentář:');
define('_NOTIFY_VOTE',				'Volba:');
define('_NOTIFY_HOST',				'Server:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'Člen:');
define('_NOTIFY_TITLE',				'Nadpis:');
define('_NOTIFY_CONTENTS',			'Text:');

// member mail message
define('_MMAIL_MSG',				'Obdržel jste novou zprávu od');
define('_MMAIL_FROMANON',			'anonymního návštěvníka');
define('_MMAIL_FROMNUC',			'Odesláno v systému Nucleus weblog v');
define('_MMAIL_TITLE',				'Zpráva od');
define('_MMAIL_MAIL',				'Zpráva:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'Přidat článek');
define('_BMLET_EDIT',				'Upravit článek');
define('_BMLET_DELETE',				'Odstranit článek');
define('_BMLET_BODY',				'Text');
define('_BMLET_MORE',				'Rozšířený text');
define('_BMLET_OPTIONS',			'Volby');
define('_BMLET_PREVIEW',			'Náhled');

// used in bookmarklet
define('_ITEM_UPDATED',				'Článek byl upraven');
define('_ITEM_DELETED',				'Článek byl odstraněn');

// plugins
define('_CONFIRMTXT_PLUGIN',		'Skutečně chcete odstranit plugin');
define('_ERROR_NOSUCHPLUGIN',		'Takový plugin neexistuje');
define('_ERROR_DUPPLUGIN',			'Tento plugin již byl nainstalován');
define('_ERROR_PLUGFILEERROR',		'Plugin neexistuje, nebo jsou špatně nastavena přístupová práva');
define('_PLUGS_NOCANDIDATES',		'Žádné pluginy nebyly nalezeny');

define('_PLUGS_TITLE_MANAGE',		'Správa pluginů');
define('_PLUGS_TITLE_INSTALLED',	'Momentálně nainstalované');
define('_PLUGS_TITLE_UPDATE',		'Aktualizovat seznam odběrů');
define('_PLUGS_TEXT_UPDATE',		'Nucleus si udržuje databázi odběrů událostí pro pluginy. Pokud nahrajete novou verzi pluginu, měl byste spustit tuto aktualizaci, aby byly odběry obnoveny.');
define('_PLUGS_TITLE_NEW',			'Nainstalovat nový plugin');
define('_PLUGS_ADD_TEXT',			'Dole vidíte seznam souborů z adresáře pluginů, které jsou patrně nenainstalované pluginy. Před jejich nainstalováním se ujistěte, že to jsou <strong>určitě</strong> pluginy.');
define('_PLUGS_BTN_INSTALL',		'Nainstalovat plugin');
define('_BACKTOOVERVIEW',			'Zpátky k přehledu');

// editlink
define('_TEMPLATE_EDITLINK',		'Odkaz na editaci článku');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'Přidat rámeček vlevo');
define('_ADD_RIGHT_TT',				'Přidat rámeček vpravo');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'Nová kategorie...');

// new settings
define('_SETTINGS_PLUGINURL',		'URL s pluginy');
define('_SETTINGS_MAXUPLOADSIZE',	'Max. velikost souboru pro nahrání (bytes)');
define('_SETTINGS_NONMEMBERMSGS',	'Povolit neregistrovaným posílat zprávy');
define('_SETTINGS_PROTECTMEMNAMES',	'Chránit jména členů');

// overview screen
define('_OVERVIEW_PLUGINS',			'Správa pluginů...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'Registrace nového člena:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'Vaše emailová adresa:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'Nemáte správcovská práva pro žádný z blogů, které mají příjemce ve svém týmu. Proto nesmíte nahrávat soubory do adresáře této osoby.');

// plugin list
define('_LISTS_INFO',				'Informace');
define('_LIST_PLUGS_AUTHOR',		'Od:');
define('_LIST_PLUGS_VER',			'Verze:');
define('_LIST_PLUGS_SITE',			'Navštívit stránku');
define('_LIST_PLUGS_DESC',			'Popis:');
define('_LIST_PLUGS_SUBS',			'Odběratel těchto událostí:');
define('_LIST_PLUGS_UP',			'nahoru');
define('_LIST_PLUGS_DOWN',			'dolů');
define('_LIST_PLUGS_UNINSTALL',		'odinstalovat');
define('_LIST_PLUGS_ADMIN',			'správce');
define('_LIST_PLUGS_OPTIONS',		'upravit&nbsp;nastavení');

// plugin option list
define('_LISTS_VALUE',				'Hodnota');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'tento plugin nemá žádná nastavení');
define('_PLUGS_BACK',				'Zpět na přehled pluginů');
define('_PLUGS_SAVE',				'Uložit nastavení');
define('_PLUGS_OPTIONS_UPDATED',	'Nastavení pluginu byla upravena');

define('_OVERVIEW_MANAGEMENT',		'Správa');
define('_OVERVIEW_MANAGE',			'Správa Nucleusu...');
define('_MANAGE_GENERAL',			'Obecná nastavení');
define('_MANAGE_SKINS',				'Vzhled a šablony');
define('_MANAGE_EXTRA',				'Extra volby');

define('_BACKTOMANAGE',				'Zpět na správu Nucleusu');


// END introduced after v1.1 END





// global stuff
define('_LOGOUT',					'Odhlásit se');
define('_LOGIN',					'Přihlásit se');
define('_YES',						'Ano');
define('_NO',						'Ne');
define('_SUBMIT',					'Odeslat');
define('_ERROR',					'Chyba');
define('_ERRORMSG',					'Vyskytla se chyba!');
define('_BACK',						'Zpět');
define('_NOTLOGGEDIN',				'Nejste přihlášen');
define('_LOGGEDINAS',				'Přihlášen jako');
define('_ADMINHOME',				'Správce');
define('_NAME',						'Jméno');
define('_BACKHOME',					'Zpět na správcovskou stránku');
define('_BADACTION',				'Byla požadována neexistující akce');
define('_MESSAGE',					'Zpráva');
define('_HELP_TT',					'Pomoc!');
define('_YOURSITE',					'Vaše stránka');


define('_POPUP_CLOSE',				'Zavřít okno');

define('_LOGIN_PLEASE',				'Prosím, nejprve se přihlašte');

// commentform
define('_COMMENTFORM_YOUARE',		'Jste');
define('_COMMENTFORM_SUBMIT',		'Přidat komentář');
define('_COMMENTFORM_COMMENT',		'Váš komentář');
define('_COMMENTFORM_NAME',			'Jméno');
define('_COMMENTFORM_MAIL',			'E-mail/HTTP');
define('_COMMENTFORM_REMEMBER',		'Pamatuj si mne');

// loginform
define('_LOGINFORM_NAME',			'Jméno');
define('_LOGINFORM_PWD',			'Heslo');
define('_LOGINFORM_YOUARE',			'Přihlášen jako');
define('_LOGINFORM_SHARED',			'Sdílený počítač');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'Poslat zprávu');

// search form
define('_SEARCHFORM_SUBMIT',		'Hledání');

// add item form
define('_ADD_ADDTO',				'Přidat nový článek do');
define('_ADD_CREATENEW',			'Vytvořit nový článek');
define('_ADD_BODY',					'Text');
define('_ADD_TITLE',				'Nadpis');
define('_ADD_MORE',					'Rozšířený text (volitelně)');
define('_ADD_CATEGORY',				'Kategorie');
define('_ADD_PREVIEW',				'Náhled');
define('_ADD_DISABLE_COMMENTS',		'Zakázat komentáře?');
define('_ADD_DRAFTNFUTURE',			'Koncepty a články pro pozdější publikování');
define('_ADD_ADDITEM',				'Přidat článek');
define('_ADD_ADDNOW',				'Přidat nyní');
define('_ADD_ADDLATER',				'Přidat později');
define('_ADD_PLACE_ON',				'Umístit na');
define('_ADD_ADDDRAFT',				'Přidat mezi koncepty');
define('_ADD_NOPASTDATES',			'(data a časy v minulosti NEJSOU platné, v tom případě bude použit aktuální čas)');
define('_ADD_BOLD_TT',				'Tučné');
define('_ADD_ITALIC_TT',			'Kurzíva');
define('_ADD_HREF_TT',				'Vytvořit odkaz');
define('_ADD_MEDIA_TT',				'Přidat obrázek');
define('_ADD_PREVIEW_TT',			'Zobrazit/skrýt náhled');
define('_ADD_CUT_TT',				'Vyjmout');
define('_ADD_COPY_TT',				'Kopírovat');
define('_ADD_PASTE_TT',				'Vložit');


// edit item form
define('_EDIT_ITEM',				'Upravit článek');
define('_EDIT_SUBMIT',				'Upravit článek');
define('_EDIT_ORIG_AUTHOR',			'Původní autor');
define('_EDIT_BACKTODRAFTS',		'Přidat zpátky mezi koncepty');
define('_EDIT_COMMENTSNOTE',		'(poznámka: zakázání komentářů _neskryje_ dříve přidané komentáře)');

// used on delete screens
define('_DELETE_CONFIRM',			'Prosím, potvrďte odstranění');
define('_DELETE_CONFIRM_BTN',		'Potvrzení odstranění');
define('_CONFIRMTXT_ITEM',			'Chystáte se odstranit následující článek:');
define('_CONFIRMTXT_COMMENT',		'Chystáte se odstranit následující komentář:');
define('_CONFIRMTXT_TEAM1',			'Chystáte se odstranit uživatele ');
define('_CONFIRMTXT_TEAM2',			' z týmu pro blog ');
define('_CONFIRMTXT_BLOG',			'Blog, který hodláte odstranit, je: ');
define('_WARNINGTXT_BLOGDEL',		'Pozor! Odstraněním blogu dojde k vymazání VŠECH článků tohoto blogu a všech komentářů. Prosím, potvrďte, že to OPRAVDU chcete udělat!<br />Během odstraňování blogu nepřerušujte Nucleus.');
define('_CONFIRMTXT_MEMBER',		'Chystáte se odstranit profil následujícího člena: ');
define('_CONFIRMTXT_TEMPLATE',		'Chystáte se odstranit šablonu ');
define('_CONFIRMTXT_SKIN',			'Chystáte se odstranit vzhled ');
define('_CONFIRMTXT_BAN',			'Chystáte se odstranit omezení přístupu pro ip adresy');
define('_CONFIRMTXT_CATEGORY',		'Chystáte se odstranit kategorii ');

// some status messages
define('_DELETED_ITEM',				'Článek odstraněn');
define('_DELETED_MEMBER',			'Reg. uživatel odstraněn');
define('_DELETED_COMMENT',			'Komentář odstraněn');
define('_DELETED_BLOG',				'Blog odstraněn');
define('_DELETED_CATEGORY',			'Kategorie odstraněna');
define('_ITEM_MOVED',				'Článek přesunut');
define('_ITEM_ADDED',				'Článek přidán');
define('_COMMENT_UPDATED',			'Komentář upraven');
define('_SKIN_UPDATED',				'Vzhled byl uložen');
define('_TEMPLATE_UPDATED',			'Šablona byla uložena');

// errors
define('_ERROR_COMMENT_LONGWORD',	'Prosím, v komentářích nepoužívejte slova delší než 90 znaků');
define('_ERROR_COMMENT_NOCOMMENT',	'Prosím, vložte komentář');
define('_ERROR_COMMENT_NOUSERNAME',	'Špatné uživatelské jméno');
define('_ERROR_COMMENT_TOOLONG',	'Váš komentář je příliš dlouhý (max. 5000 znaků)');
define('_ERROR_COMMENTS_DISABLED',	'Komentáře pro tento blog jsou momentálně zakázány.');
define('_ERROR_COMMENTS_NONPUBLIC',	'Abyste mohl přidávat komentáře do tohoto blogu, musíte být přihlášen');
define('_ERROR_COMMENTS_MEMBERNICK','Jméno, pod kterým chcete odeslat komentář, používá jiný registrovaný uživatel. Použijte nějaké jiné.');
define('_ERROR_SKIN',				'Chyba v definici vzhledu');
define('_ERROR_ITEMCLOSED',			'Tento článek byl uzavřen. Už není možné k němu přidávat komentáře ani hlasovat');
define('_ERROR_NOSUCHITEM',			'Článek nenalezen');
define('_ERROR_NOSUCHBLOG',			'Blog nenalezen');
define('_ERROR_NOSUCHSKIN',			'Vzhled nenalezen');
define('_ERROR_NOSUCHMEMBER',		'Registrovaný uživatel nenalezen');
define('_ERROR_NOTONTEAM',			'Nejste členem týmu tohoto blogu');
define('_ERROR_BADDESTBLOG',		'Cílový blog neexistuje');
define('_ERROR_NOTONDESTTEAM',		'Nelze přesunout článek, protože nejste členem týmu cílového blogu');
define('_ERROR_NOEMPTYITEMS',		'Nelze přidat prázdný článek!');
define('_ERROR_BADMAILADDRESS',		'Emailová adresa není platná');
define('_ERROR_BADNOTIFY',			'Jedna nebo více z udaných adres pro oznamování není platná emailová adresa');
define('_ERROR_BADNAME',			'Jméno není platné (jsou dovoleny pouze znaky a-z a 0-9, žádné mezery na začátku a na konci)');
define('_ERROR_NICKNAMEINUSE',		'Tuto přezdívku již používá jiný registrovaný člen');
define('_ERROR_PASSWORDMISMATCH',	'Hesla musejí být stejná');
define('_ERROR_PASSWORDTOOSHORT',	'Heslo by mělo mít alespoň 6 znaků');
define('_ERROR_PASSWORDMISSING',	'Heslo nesmí být prázdné');
define('_ERROR_REALNAMEMISSING',	'Musíte vložit skutečné jméno');
define('_ERROR_ATLEASTONEADMIN',	'Měl by být vždy aspoň jeden super-správce, který se může přihlásit do správcovské sekce.');
define('_ERROR_ATLEASTONEBLOGADMIN','Vykonání této akce by způsobilo, že by váš blog neměl kdo spravovat.  Ujistěte se, že vždy existuje alespoň jeden správce.');
define('_ERROR_ALREADYONTEAM',		'Nemůžete přidat uživatele, který už je členem týmu');
define('_ERROR_BADSHORTBLOGNAME',	'Krátké jméno blogu by mělo obsahovat jen znaky a-z a 0-9, bez mezer');
define('_ERROR_DUPSHORTBLOGNAME',	'Toto krátké jméno již používá jiný blog. Tato jména musejí být unikátní.');
define('_ERROR_UPDATEFILE',			'Nelze zapisovat to update-souboru. Ujistěte se, že jsou správně nastavena přístupová práva (zkuste chmod 666). Také pozor na to, že umístění je relativní k adresáři správcovské oblasti, takže byste mohl zkusit absolutní cestu (něco jako /your/path/to/nucleus/)');
define('_ERROR_DELDEFBLOG',			'Nelze odstranit výchozí blog');
define('_ERROR_DELETEMEMBER',		'Tento uživatel nemůže být odstraněn. Patrně protože je autorem nějakých článků, nebo komentářů.');
define('_ERROR_BADTEMPLATENAME',	'Neplatné jméno šablony. Použijte pouze znaky a-z a 0-9, žádné mezery.');
define('_ERROR_DUPTEMPLATENAME',	'Již existuje šablona s tímto názvem.');
define('_ERROR_BADSKINNAME',		'Neplatné jméno vzhledu (použijte pouze znaky a-z a 0-9, žádné mezery)');
define('_ERROR_DUPSKINNAME',		'Již existuje vzhled s tímto názvem.');
define('_ERROR_DEFAULTSKIN',		'Vzhled s názvem "default" musí být vždy dostupný.');
define('_ERROR_SKINDEFDELETE',		'Nelze odstranit vzhled, protože že to výchozí vzhled pro následující blog: ');
define('_ERROR_DISALLOWED',			'Promiňte, ale nejste oprávněn provádět tuto akci.');
define('_ERROR_DELETEBAN',			'Chyba při odstraňování omezení přístupu (omezení přístupu neexistuje)');
define('_ERROR_ADDBAN',				'Chyba při přidávání omezení přístupu. Omezení přístupu asi nebylo korektně přidáno do všech blogů.');
define('_ERROR_BADACTION',			'Požadovaná akce neexistuje');
define('_ERROR_MEMBERMAILDISABLED',	'Mailové zprávy mezi členy jsou zakázány.');
define('_ERROR_MEMBERCREATEDISABLED','Vytváření uživatelských kont je zakázáno.');
define('_ERROR_INCORRECTEMAIL',		'Špatná mailová adresa');
define('_ERROR_VOTEDBEFORE',		'Pro tento článek už jste hlasoval');
define('_ERROR_BANNED1',			'Akci nelze vykonat, protože vám (rozsah adres ');
define('_ERROR_BANNED2',			') byl omezen přístup. Zpráva byla: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'Abyste mohl vykonat tuto akci, musíte se přihlásit.');
define('_ERROR_CONNECT',			'Chyba spojení');
define('_ERROR_FILE_TOO_BIG',		'Soubor je příliš velký!');
define('_ERROR_BADFILETYPE',		'Promiňte, ale tento typ souboru není povolen.');
define('_ERROR_BADREQUEST',			'Špatný požadavek pro nahrání souboru');
define('_ERROR_DISALLOWEDUPLOAD',	'Nejste členem týmu žádného blogu, a proto nemůžete nahrávat soubory.');
define('_ERROR_BADPERMISSIONS',		'Práva pro soubor/adresář nejsou správně nastavena');
define('_ERROR_UPLOADMOVEP',		'Chyba při přesunu nahraného souboru');
define('_ERROR_UPLOADCOPY',			'Chyba při kopírování souboru');
define('_ERROR_UPLOADDUPLICATE',	'Soubor s tímto názvem již existuje. Před nahráním ho zkuste přejmenovat.');
define('_ERROR_LOGINDISALLOWED',	'Promiňte, ale nemůžete se přihlásit do správcovské oblasti. Nicméně můžete se přihlásit jako jiný uživatel.');
define('_ERROR_DBCONNECT',			'Nelze se připojit k mySQL serveru');
define('_ERROR_DBSELECT',			'Nelze vybrat databázi nucleus.');
define('_ERROR_NOSUCHLANGUAGE',		'Tento jazykový soubor neexistuje');
define('_ERROR_NOSUCHCATEGORY',		'Taková kategorie neexistuje');
define('_ERROR_DELETELASTCATEGORY',	'Musí existovat alespoň jedna kategorie');
define('_ERROR_DELETEDEFCATEGORY',	'Nelze odstranit výchozí kategorii');
define('_ERROR_BADCATEGORYNAME',	'Špatný název kategorie');
define('_ERROR_DUPCATEGORYNAME',	'Kategorie s tímto názvem už existuje');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'Pozor: Aktuální hodnota není adresář!');
define('_WARNING_NOTREADABLE',		'Pozor: Aktuální hodnota není adresář pro čtení!');
define('_WARNING_NOTWRITABLE',		'Pozor: Aktuální hodnota NENÍ adresář, do kterého lze zapisovat!');

// media and upload
define('_MEDIA_UPLOADLINK',			'Nahrát nový soubor');
define('_MEDIA_MODIFIED',			'modifikován');
define('_MEDIA_FILENAME',			'název souboru');
define('_MEDIA_DIMENSIONS',			'rozměry');
define('_MEDIA_INLINE',				'Uvnitř');
define('_MEDIA_POPUP',				'Okno');
define('_UPLOAD_TITLE',				'Zvolte soubor');
define('_UPLOAD_MSG',				'Vyberte soubor pro nahrání, a potom stiskněte tlačítko \'Nahrát\'.');
define('_UPLOAD_BUTTON',			'Nahrát');

// some status messages
define('_MSG_ACCOUNTCREATED',		'Účet byl vytvořen. Heslo obdržíte emailem.');
define('_MSG_PASSWORDSENT',			'Heslo vám bylo odesláno emailem.');
define('_MSG_LOGINAGAIN',			'Budete se muset znovu přihlásit, protože vaše údaje byly změněny.');
define('_MSG_SETTINGSCHANGED',		'Nastavení změněna');
define('_MSG_ADMINCHANGED',			'Správce změněn');
define('_MSG_NEWBLOG',				'Nový blog byl vytvořen');
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
define('_TEAM_ADDNEW',				'Přidat člena do týmu');
define('_TEAM_CHOOSEMEMBER',		'Zvolte člena');
define('_TEAM_ADMIN',				'Správcovská práva? ');
define('_TEAM_ADD',					'Přidat do týmu');
define('_TEAM_ADD_BTN',				'Přidat do týmu');

// blogsettings
define('_EBLOG_TITLE',				'Upravit nastavení blogu');
define('_EBLOG_TEAM_TITLE',			'Upravit tým');
define('_EBLOG_TEAM_TEXT',			'Klikněte zde pro úpravu týmu...');
define('_EBLOG_SETTINGS_TITLE',		'Nastavení blogu');
define('_EBLOG_NAME',				'Jméno blogu');
define('_EBLOG_SHORTNAME',			'Krátké jméno blogu');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(pouze znaky a-z bez mezer)');
define('_EBLOG_DESC',				'Popis blogu');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'Výchozí vzhled');
define('_EBLOG_DEFCAT',				'Výchozí kategorie');
define('_EBLOG_LINEBREAKS',			'Převádět odřádkování');
define('_EBLOG_DISABLECOMMENTS',	'Povolit komentáře?<br /><small>(Určuje, zda lze přidávat komentáře)</small>');
define('_EBLOG_ANONYMOUS',			'Povolit komentáře od neregistrovaných návštěvníků?');
define('_EBLOG_NOTIFY',				'Adresa/adresy pro oznamování (použijte ; jako oddělovač)');
define('_EBLOG_NOTIFY_ON',			'Oznamovat zaslání');
define('_EBLOG_NOTIFY_COMMENT',		'Nových komentářů');
define('_EBLOG_NOTIFY_KARMA',		'Nových karma hlasů');
define('_EBLOG_NOTIFY_ITEM',		'Nových článků blogu');
define('_EBLOG_PING',				'Ping na Weblogs.com při změnách?');
define('_EBLOG_MAXCOMMENTS',		'Maximální počet komentářů');
define('_EBLOG_UPDATE',				'Zapsat změny do souboru');
define('_EBLOG_OFFSET',				'Časový posun');
define('_EBLOG_STIME',				'Aktuální čas serveru je');
define('_EBLOG_BTIME',				'Aktuální čas blogu je');
define('_EBLOG_CHANGE',				'Změnit nastavení');
define('_EBLOG_CHANGE_BTN',			'Změnit nastavení');
define('_EBLOG_ADMIN',				'Správce blogu');
define('_EBLOG_ADMIN_MSG',			'Obdržíte správcovská práva');
define('_EBLOG_CREATE_TITLE',		'Vytvořit nový blog');
define('_EBLOG_CREATE_TEXT',		'Pro vytvoření nového blogu vyplňte následující formulář. <br /><br /> <b>Poznámka:</b> Jsou zde vypsány pouze nejnutnější volby. Pokud chcete změnit další nastavení, po vytvoření blogu navštivte stránku s vlastnostmi blogu.');
define('_EBLOG_CREATE',				'Vytvořit!');
define('_EBLOG_CREATE_BTN',			'Vytvořit blog');
define('_EBLOG_CAT_TITLE',			'Kategorie');
define('_EBLOG_CAT_NAME',			'Název kategorie');
define('_EBLOG_CAT_DESC',			'Popis kategorie');
define('_EBLOG_CAT_CREATE',			'Vytvořit novou kategorii');
define('_EBLOG_CAT_UPDATE',			'Upravit kategorii');
define('_EBLOG_CAT_UPDATE_BTN',		'Upravit kategorii');

// templates
define('_TEMPLATE_TITLE',			'Upravit šablony');
define('_TEMPLATE_AVAILABLE_TITLE',	'Dostupné šablony');
define('_TEMPLATE_NEW_TITLE',		'Nová šablona');
define('_TEMPLATE_NAME',			'Název šablony');
define('_TEMPLATE_DESC',			'Popis šablony');
define('_TEMPLATE_CREATE',			'Vytvořit šablonu');
define('_TEMPLATE_CREATE_BTN',		'Vytvořit šablonu');
define('_TEMPLATE_EDIT_TITLE',		'Upravit šablonu');
define('_TEMPLATE_BACK',			'Zpět na přehled šablon');
define('_TEMPLATE_EDIT_MSG',		'Ne všechny části šablony jsou vyžadovány. Nepotřebné části nechte prázdné.');
define('_TEMPLATE_SETTINGS',		'Nastavení šablony');
define('_TEMPLATE_ITEMS',			'Články');
define('_TEMPLATE_ITEMHEADER',		'Hlavička článku');
define('_TEMPLATE_ITEMBODY',		'Tělo článku');
define('_TEMPLATE_ITEMFOOTER',		'Patička článku');
define('_TEMPLATE_MORELINK',		'Odkaz na rozšiřující text');
define('_TEMPLATE_NEW',				'Označení nového článku');
define('_TEMPLATE_COMMENTS_ANY',	'Komentáře (pokud jsou)');
define('_TEMPLATE_CHEADER',			'Hlavička komentáře');
define('_TEMPLATE_CBODY',			'Tělo komentáře');
define('_TEMPLATE_CFOOTER',			'Patička komentáře');
define('_TEMPLATE_CONE',			'Jeden komentář');
define('_TEMPLATE_CMANY',			'Dva (a více) komentářů');
define('_TEMPLATE_CMORE',			'\'Číst více\' u komentářů');
define('_TEMPLATE_CMEXTRA',			'Další údaje jen pro členy');
define('_TEMPLATE_COMMENTS_NONE',	'Komentáře (nejsou-li žádné)');
define('_TEMPLATE_CNONE',			'Žádné komentáře');
define('_TEMPLATE_COMMENTS_TOOMUCH','Komentáře (pokud jsou, ale je jich víc, než se dá zobrazit přímo)');
define('_TEMPLATE_CTOOMUCH',		'Příliš mnoho komentářů');
define('_TEMPLATE_ARCHIVELIST',		'Seznam archivů');
define('_TEMPLATE_AHEADER',			'Hlavička seznamu archivů');
define('_TEMPLATE_AITEM',			'Položka seznamu archivů');
define('_TEMPLATE_AFOOTER',			'Patička seznamu archivů');
define('_TEMPLATE_DATETIME',		'Datum a čas');
define('_TEMPLATE_DHEADER',			'Hlavička datumu');
define('_TEMPLATE_DFOOTER',			'Patička datumu');
define('_TEMPLATE_DFORMAT',			'Formát datumu');
define('_TEMPLATE_TFORMAT',			'Formát času');
define('_TEMPLATE_LOCALE',			'Místní nastavení');
define('_TEMPLATE_IMAGE',			'Okna s obrázkem');
define('_TEMPLATE_PCODE',			'Kód odkazu pro okna s obrázkem');
define('_TEMPLATE_ICODE',			'Kód pro vložený obrázek');
define('_TEMPLATE_MCODE',			'Kód odkazu na soubor médií');
define('_TEMPLATE_SEARCH',			'Hledání');
define('_TEMPLATE_SHIGHLIGHT',		'Zvýraznění');
define('_TEMPLATE_SNOTFOUND',		'Při hledání nebylo nic nalezeno');
define('_TEMPLATE_UPDATE',			'Upravit');
define('_TEMPLATE_UPDATE_BTN',		'Upravit šablonu');
define('_TEMPLATE_RESET_BTN',		'Původní data');
define('_TEMPLATE_CATEGORYLIST',	'Seznamy kategorií');
define('_TEMPLATE_CATHEADER',		'Hlavička seznamu kategorií');
define('_TEMPLATE_CATITEM',			'Položka seznamu kategorií');
define('_TEMPLATE_CATFOOTER',		'Patička seznamu kategorií');

// skins
define('_SKIN_EDIT_TITLE',			'Upravit vzhledy');
define('_SKIN_AVAILABLE_TITLE',		'Dostupné vzhledy');
define('_SKIN_NEW_TITLE',			'Nový vzhled');
define('_SKIN_NAME',				'Název');
define('_SKIN_DESC',				'Popis');
define('_SKIN_TYPE',				'Typ obsahu');
define('_SKIN_CREATE',				'Vytvořit');
define('_SKIN_CREATE_BTN',			'Vytvořit vzhled');
define('_SKIN_EDITONE_TITLE',		'Upravit vzhled');
define('_SKIN_BACK',				'Zpět na přehled vzhledů');
define('_SKIN_PARTS_TITLE',			'Části vzhledu');
define('_SKIN_PARTS_MSG',			'Pro každý vzhled nejsou potřeba všechny typy. Ty, které nepotřebujete, nechte prázdné. Zvolte typ vzhledu, který chcete upravit::');
define('_SKIN_PART_MAIN',			'Hlavní přehled');
define('_SKIN_PART_ITEM',			'Stránky článku');
define('_SKIN_PART_ALIST',			'Seznam archivů');
define('_SKIN_PART_ARCHIVE',		'Archiv');
define('_SKIN_PART_SEARCH',			'Hledání');
define('_SKIN_PART_ERROR',			'Chyby');
define('_SKIN_PART_MEMBER',			'Detaily reg. uživatele');
define('_SKIN_PART_POPUP',			'Okna s obrázkem');
define('_SKIN_GENSETTINGS_TITLE',	'Obecná nastavení');
define('_SKIN_CHANGE',				'Změnit');
define('_SKIN_CHANGE_BTN',			'Změnit tato nastavení');
define('_SKIN_UPDATE_BTN',			'Uložit vzhled');
define('_SKIN_RESET_BTN',			'Původní data');
define('_SKIN_EDITPART_TITLE',		'Upravit vzhled');
define('_SKIN_GOBACK',				'Zpět');
define('_SKIN_ALLOWEDVARS',			'Dostupné proměnné (klikněte pro bližší informace):');

// global settings
define('_SETTINGS_TITLE',			'Obecná nastavení');
define('_SETTINGS_SUB_GENERAL',		'Obecná nastavení');
define('_SETTINGS_DEFBLOG',			'Výchozí blog');
define('_SETTINGS_ADMINMAIL',		'Email správce');
define('_SETTINGS_SITENAME',		'Název stránky');
define('_SETTINGS_SITEURL',			'URL stránky (mělo by končit lomítkem)');
define('_SETTINGS_ADMINURL',		'URL správcovské oblasti (mělo by končit lomítkem)');
define('_SETTINGS_DIRS',			'Adresáře Nucleusu');
define('_SETTINGS_MEDIADIR',		'Adresář s médii');
define('_SETTINGS_SEECONFIGPHP',	'(viz config.php)');
define('_SETTINGS_MEDIAURL',		'URL médií (mělo by končit lomítkem)');
define('_SETTINGS_ALLOWUPLOAD',		'Povolit nahrávání (upload) souborů?');
define('_SETTINGS_ALLOWUPLOADTYPES','Typy souborů, které lze nahrát');
define('_SETTINGS_CHANGELOGIN',		'Povolit registrovaným uživatelům měnit jméno/heslo');
define('_SETTINGS_COOKIES_TITLE',	'Nastavení cookies');
define('_SETTINGS_COOKIELIFE',		'Doba životnosti přihlašovacího cookie');
define('_SETTINGS_COOKIESESSION',	'Jednorázové cookies (session)');
define('_SETTINGS_COOKIEMONTH',		'Měsíc');
define('_SETTINGS_COOKIEPATH',		'Cesta cookie (pokročilé)');
define('_SETTINGS_COOKIEDOMAIN',	'Doména cookie (pokročilé)');
define('_SETTINGS_COOKIESECURE',	'Zabezpečné cookie (pokročilé)');
define('_SETTINGS_LASTVISIT',		'Ukládat cookies poslední návštěvy');
define('_SETTINGS_ALLOWCREATE',		'Povolit návštěvníkům vytvořit si registrovaný účet');
define('_SETTINGS_NEWLOGIN',		'Povolit přihlášení z účtů, vytvořených návštěvníky');
define('_SETTINGS_NEWLOGIN2',		'(pouze pro nově vytvořené účty)');
define('_SETTINGS_MEMBERMSGS',		'Povolit služby mezi členy');
define('_SETTINGS_LANGUAGE',		'Výchozí jazyk');
define('_SETTINGS_DISABLESITE',		'Vypnout stránku');
define('_SETTINGS_DBLOGIN',			'mySQL Login a Databáze');
define('_SETTINGS_UPDATE',			'Uložit nastavení');
define('_SETTINGS_UPDATE_BTN',		'Uložit nastavení');
define('_SETTINGS_DISABLEJS',		'Zakázat JavaScript Toolbar');
define('_SETTINGS_MEDIA',			'Nastavení pro média/nahrávání souborů');
define('_SETTINGS_MEDIAPREFIX',		'Nahraným souborům přidat před jméno datum');
define('_SETTINGS_MEMBERS',			'Nastavení registrovaných uživatelů');

// bans
define('_BAN_TITLE',				'Seznam omezení přístupu pro');
define('_BAN_NONE',					'Tento blog nemá žádná omezení přístupu');
define('_BAN_NEW_TITLE',			'Přidat nové omezení přístupu');
define('_BAN_NEW_TEXT',				'Přidat omezení');
define('_BAN_REMOVE_TITLE',			'Odstranit omezení');
define('_BAN_IPRANGE',				'Rozsah IP adres');
define('_BAN_BLOGS',				'Které blogy?');
define('_BAN_DELETE_TITLE',			'Odstranit omezení');
define('_BAN_ALLBLOGS',				'Všechny blogy, ke kterým máte správcovská práva.');
define('_BAN_REMOVED_TITLE',		'Omezení přístupu bylo odstraněno');
define('_BAN_REMOVED_TEXT',			'Bylo odstraněno omezení přístupu pro následující blogy:');
define('_BAN_ADD_TITLE',			'Přidat omezení přístupu');
define('_BAN_IPRANGE_TEXT',			'Zadejte rozsah IP adres, které chcete blokovat. Čím menší čísla, tím více adres bude blokováno.');
define('_BAN_BLOGS_TEXT',			'Můžete zablokovat rozsah IP adres pouze pro jeden blog, nebo pro všechny blogy, ke kterým máte správcovská práva.');
define('_BAN_REASON_TITLE',			'Důvod');
define('_BAN_REASON_TEXT',			'Můžete zadat důvod omezení přístupu, který bude zobrazen, pokud se vlastník blokované IP adresy pokusí přidat komentář, nebo odeslat karma hlas. Maximální délka je 256 znaků.');
define('_BAN_ADD_BTN',				'Přidat omezení');

// LOGIN screen
define('_LOGIN_MESSAGE',			'Zpráva');
define('_LOGIN_NAME',				'Jméno');
define('_LOGIN_PASSWORD',			'Heslo');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'Zapomněl jste heslo?');

// membermanagement
define('_MEMBERS_TITLE',			'Správa registrovaných uživatelů');
define('_MEMBERS_CURRENT',			'Aktuální uživatelé');
define('_MEMBERS_NEW',				'Nový uživatel');
define('_MEMBERS_DISPLAY',			'Zobrazované jméno');
define('_MEMBERS_DISPLAY_INFO',		'(Toto je jméno, pod kterým se přihlašujete)');
define('_MEMBERS_REALNAME',			'Skutečné jméno');
define('_MEMBERS_PWD',				'Heslo');
define('_MEMBERS_REPPWD',			'Zopakovat heslo');
define('_MEMBERS_EMAIL',			'Emailová adresa');
define('_MEMBERS_EMAIL_EDIT',		'(Pokud změníte emailovou adresu, bude vám na ni automaticky odesláno nové heslo)');
define('_MEMBERS_URL',				'Adresa webové stránky (URL)');
define('_MEMBERS_SUPERADMIN',		'Správcovská práva');
define('_MEMBERS_CANLOGIN',			'Může se přihlásit do správcovské oblasti');
define('_MEMBERS_NOTES',			'Poznámky');
define('_MEMBERS_NEW_BTN',			'Přidat uživatele');
define('_MEMBERS_EDIT',				'Upravit uživatele');
define('_MEMBERS_EDIT_BTN',			'Uložit nastavení');
define('_MEMBERS_BACKTOOVERVIEW',	'Zpět na přehled uživatelů');
define('_MEMBERS_DEFLANG',			'Jazyk');
define('_MEMBERS_USESITELANG',		'- výchozí jazyk stránky -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'Navštívit stránku');
define('_BLOGLIST_ADD',				'Přidat článek');
define('_BLOGLIST_TT_ADD',			'Přidat nový článek do tohoto blogu');
define('_BLOGLIST_EDIT',			'Upravit/odstranit články');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Bookmarklet');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'Nastavení');
define('_BLOGLIST_TT_SETTINGS',		'Upravit nastavení nebo spravovat tým');
define('_BLOGLIST_BANS',			'Omezení přístupu');
define('_BLOGLIST_TT_BANS',			'Zobrazit, přidat nebo odstranit blokované IP adresy');
define('_BLOGLIST_DELETE',			'Odstranit vše');
define('_BLOGLIST_TT_DELETE',		'Odstranit tento blog');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'Vaše blogy');
define('_OVERVIEW_YRDRAFTS',		'Vaše koncepty');
define('_OVERVIEW_YRSETTINGS',		'Vaše nastavení');
define('_OVERVIEW_GSETTINGS',		'Obecná nastavení');
define('_OVERVIEW_NOBLOGS',			'Nejste členem týmu žádného z blogů');
define('_OVERVIEW_NODRAFTS',		'Žádné koncepty');
define('_OVERVIEW_EDITSETTINGS',	'Upravit vaše nastavení...');
define('_OVERVIEW_BROWSEITEMS',		'Prohlížet vaše články...');
define('_OVERVIEW_BROWSECOMM',		'Prohlížet vaše komentáře...');
define('_OVERVIEW_VIEWLOG',			'Prohlížet seznam akcí...');
define('_OVERVIEW_MEMBERS',			'Správa reg. uživatelů...');
define('_OVERVIEW_NEWLOG',			'Vytvořit nový blog...');
define('_OVERVIEW_SETTINGS',		'Upravit nastavení...');
define('_OVERVIEW_TEMPLATES',		'Upravit šablony...');
define('_OVERVIEW_SKINS',			'Upravit vzhledy...');
define('_OVERVIEW_BACKUP',			'Záloha/obnova...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'Články pro blog'); 
define('_ITEMLIST_YOUR',			'Vaše články');

// Comments
define('_COMMENTS',					'Komentáře');
define('_NOCOMMENTS',				'Tento článek nemá žádné komentáře');
define('_COMMENTS_YOUR',			'Vaše komentáře');
define('_NOCOMMENTS_YOUR',			'Nenapsal jste žádné komentáře');

// LISTS (general)
define('_LISTS_NOMORE',				'Žádné další nebo vůbec žádné výsledky');
define('_LISTS_PREV',				'Předchozí');
define('_LISTS_NEXT',				'Další');
define('_LISTS_SEARCH',				'Hledat');
define('_LISTS_CHANGE',				'Změnit');
define('_LISTS_PERPAGE',			'článků/strana');
define('_LISTS_ACTIONS',			'Akce');
define('_LISTS_DELETE',				'Odstranit');
define('_LISTS_EDIT',				'Upravit');
define('_LISTS_MOVE',				'Přesunout');
define('_LISTS_CLONE',				'Zkopírovat');
define('_LISTS_TITLE',				'Titulek');
define('_LISTS_BLOG',				'Blog');
define('_LISTS_NAME',				'Název');
define('_LISTS_DESC',				'Popis');
define('_LISTS_TIME',				'Čas');
define('_LISTS_COMMENTS',			'Komentáře');
define('_LISTS_TYPE',				'Typ');


// member list 
define('_LIST_MEMBER_NAME',			'Zobrazované jméno');
define('_LIST_MEMBER_RNAME',		'Skutečné jméno');
define('_LIST_MEMBER_ADMIN',		'Super-správce? ');
define('_LIST_MEMBER_LOGIN',		'Může se přihlásit? ');
define('_LIST_MEMBER_URL',			'Stránka');

// banlist
define('_LIST_BAN_IPRANGE',			'Rozsah IP adres');
define('_LIST_BAN_REASON',			'Důvod');

// actionlist
define('_LIST_ACTION_MSG',			'Zpráva');

// commentlist
define('_LIST_COMMENT_BANIP',		'Blokovat IP adresu');
define('_LIST_COMMENT_WHO',			'Autor');
define('_LIST_COMMENT',				'Komentář');
define('_LIST_COMMENT_HOST',		'Server');

// itemlist
define('_LIST_ITEM_INFO',			'Info');
define('_LIST_ITEM_CONTENT',		'Titulek a text');


// teamlist
define('_LIST_TEAM_ADMIN',			'Správce ');
define('_LIST_TEAM_CHADMIN',		'Změnit správce');

// edit comments
define('_EDITC_TITLE',				'Upravit komentáře');
define('_EDITC_WHO',				'Autor');
define('_EDITC_HOST',				'Odkud?');
define('_EDITC_WHEN',				'Kdy?');
define('_EDITC_TEXT',				'Text');
define('_EDITC_EDIT',				'Upravit komentář');
define('_EDITC_MEMBER',				'člen');
define('_EDITC_NONMEMBER',			'není člen');

// move item
define('_MOVE_TITLE',				'Přesunout do jakého blogu?');
define('_MOVE_BTN',					'Přesunout článek');
