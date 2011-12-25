<?php
// Slovak Nucleus Language File
// 
// Author: Fujinmi (fujinmi@seznam.cz)
// Nucleus version: v1.0-v2.5.1.0
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
define('_MEDIA_VIEW',				'zobraziť');
define('_MEDIA_VIEW_TT',			'Zobraziť súbor (v novom okne)');
define('_MEDIA_FILTER_APPLY',		'Použiť filter');
define('_MEDIA_FILTER_LABEL',		'Filter: ');
define('_MEDIA_UPLOAD_TO',			'Nahrať do...');
define('_MEDIA_UPLOAD_NEW',			'Nahrať nový súbor...');
define('_MEDIA_COLLECTION_SELECT',	'Výber');
define('_MEDIA_COLLECTION_TT',		'Prepnúť sa do tejto kategórie');
define('_MEDIA_COLLECTION_LABEL',	'Aktuálna kolekcia:: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'Zarovnať doľava');
define('_ADD_ALIGNRIGHT_TT',		'Zarovnať doprava');
define('_ADD_ALIGNCENTER_TT',		'Zarovnať na stred');

// searchable blog setting (yes/no)
define('_EBLOG_SEARCH',				'Zahrnúť do hľadania');

// generic upload failure
define('_ERROR_UPLOADFAILED',		'Nahrávanie zlyhalo');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'Povoliť publikovanie do minulosti');
define('_ADD_CHANGEDATE',			'Prepísať dátum/čas');
define('_BMLET_CHANGEDATE',			'Prepísať dátum/čas');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'Import/export vzhľadu...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Normálny');
define('_PARSER_INCMODE_SKINDIR',	'Použiť adr. vzhľadu');
define('_SKIN_INCLUDE_MODE',		'Režim vkladania');
define('_SKIN_INCLUDE_PREFIX',		'Prefix');

// global settings
define('_SETTINGS_BASESKIN',		'Základný vzhľad');
define('_SETTINGS_SKINSURL',		'URL so vzhľadmi');
define('_SETTINGS_ACTIONSURL',		'Plné URL k action.php');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'Nie je možné presunúť štandardnú kategóriu');
define('_ERROR_MOVETOSELF',			'Nie je možné presunúť kategóriu (cieľový blog je rovnaký, ako zdrojový blog)');
define('_MOVECAT_TITLE',			'Vyberte blog, do ktorého chcete presunút kategóriu');
define('_MOVECAT_BTN',				'Presunúť kategóriu');

// URLMode setting
define('_SETTINGS_URLMODE',			'Režim URL');
define('_SETTINGS_URLMODE_NORMAL',	'Normálny');
define('_SETTINGS_URLMODE_PATHINFO','Pestré');

// Batch operations
define('_BATCH_NOSELECTION',		'Pre prevedenie akcie nieje nič vybrané');
define('_BATCH_ITEMS',				'Dávková operácia na článkoch');
define('_BATCH_CATEGORIES',			'Dávková operácia na kategoriách');
define('_BATCH_MEMBERS',			'Dávková operácia na užívateľoch');
define('_BATCH_TEAM',				'Dávková operácia na členoch tímu');
define('_BATCH_COMMENTS',			'Dávková operácia na komentároch');
define('_BATCH_UNKNOWN',			'Neznáma dávková operácia: ');
define('_BATCH_EXECUTING',			'Spúšťa sa');
define('_BATCH_ONCATEGORY',			'na kategorii');
define('_BATCH_ONITEM',				'na článku');
define('_BATCH_ONCOMMENT',			'na komentári');
define('_BATCH_ONMEMBER',			'na uživateľovi');
define('_BATCH_ONTEAM',				'na členovi tímu');
define('_BATCH_SUCCESS',			'Úspech!');
define('_BATCH_DONE',				'Hotovo!');
define('_BATCH_DELETE_CONFIRM',		'Potvrďte dávkové odstránenie');
define('_BATCH_DELETE_CONFIRM_BTN',	'Potvrďte dávkové odstránenie');
define('_BATCH_SELECTALL',			'vybrať všetko');
define('_BATCH_DESELECTALL',		'nevybrať nič');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'Odstrániť');
define('_BATCH_ITEM_MOVE',			'Přesunúť');
define('_BATCH_MEMBER_DELETE',		'Odstrániť');
define('_BATCH_MEMBER_SET_ADM',		'Nastaviť správcovské práva');
define('_BATCH_MEMBER_UNSET_ADM',	'Odebrat správcovské práva');
define('_BATCH_TEAM_DELETE',		'Odstrániť z tímu');
define('_BATCH_TEAM_SET_ADM',		'Nastaviť správcovské práva');
define('_BATCH_TEAM_UNSET_ADM',		'Odobrať správcovské práva');
define('_BATCH_CAT_DELETE',			'Odstrániť');
define('_BATCH_CAT_MOVE',			'Presunúť do iného blogu');
define('_BATCH_COMMENT_DELETE',		'Odstrániť');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'Pridat nový článok...');
define('_ADD_PLUGIN_EXTRAS',		'Nastavenie pre pluginy');

// errors
define('_ERROR_CATCREATEFAIL',		'Nie je možné vytvoriť novú kategóriu');
define('_ERROR_NUCLEUSVERSIONREQ',	'Tento plugin vyžaduje novšiu verziu Nucleusu: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Späť na nastavenie blogu');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Import');
define('_SKINIE_TITLE_EXPORT',		'Export');
define('_SKINIE_BTN_IMPORT',		'Import');
define('_SKINIE_BTN_EXPORT',		'Export vybraných vzhľadov/šablón');
define('_SKINIE_LOCAL',				'Import z lokálneho súboru:');
define('_SKINIE_NOCANDIDATES',		'V adresári vzhľadov neboli nájdené žiadne položky pre import');
define('_SKINIE_FROMURL',			'Import z URL:');
define('_SKINIE_EXPORT_INTRO',		'Vyberte vzhľady a šablóny, ktoré chcete exportovať');
define('_SKINIE_EXPORT_SKINS',		'Vzhľady');
define('_SKINIE_EXPORT_TEMPLATES',	'Šablóny');
define('_SKINIE_EXPORT_EXTRA',		'Extra info');
define('_SKINIE_CONFIRM_OVERWRITE',	'Prepísať vzhľady, ktoré už existujú (viď konflikty mien)');
define('_SKINIE_CONFIRM_IMPORT',	'Áno, toto chcem naimportovať');
define('_SKINIE_CONFIRM_TITLE',		'Budú naimportované vzhľady a šablóny');
define('_SKINIE_INFO_SKINS',		'Vzhľady v súbore:');
define('_SKINIE_INFO_TEMPLATES',	'Šablóny v súbore:');
define('_SKINIE_INFO_GENERAL',		'Info:');
define('_SKINIE_INFO_SKINCLASH',	'Konflikty v názvoch vzhľadov:');
define('_SKINIE_INFO_TEMPLCLASH',	'Konflikty v názvoch šablón:');
define('_SKINIE_INFO_IMPORTEDSKINS','Importované vzhľady:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Importované šablóny::');
define('_SKINIE_DONE',				'Import dokončený');

define('_AND',						'a');
define('_OR',						'alebo');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'prázdne pole (kliknite pre editáciu)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'Režim vkladania:');
define('_LIST_SKINS_INCPREFIX',		'Prefix:');
define('_LIST_SKINS_DEFINED',		'Definované časti:');

// backup
define('_BACKUPS_TITLE',			'Záloha / obnovenie');
define('_BACKUP_TITLE',				'Záloha');
define('_BACKUP_INTRO',				'Kliknite na tlačítko pre vytvorenie zálohy Nucleus databázy. Budete vyzvaní k uloženiu súboru so zálohou. Tento súbor potom uschovajte na bezpečnom mieste.');
define('_BACKUP_ZIP_YES',			'Pokúsiť sa použiť kompresiu');
define('_BACKUP_ZIP_NO',			'Nepoužívať kompresiu');
define('_BACKUP_BTN',				'Vytvoriť zálohu');
define('_BACKUP_NOTE',				'<b>Poznámka:</b> Zálohuje sa iba obsah databázy. Obrázky a nastavenia v config.php teda <b>NIESU</b> súčásťou zálohy.');
define('_RESTORE_TITLE',			'Obnoviť');
define('_RESTORE_NOTE',				'<b>POZOR:</b> Obnova zo zálohy <b>VYMAŽE</b> súčasné dáta v databázi! Túto akciu preveďte iba ak ste si naozaj istí!	<br />	<b>Poznámka:</b> Uistite sa, že verzia Nucleusu, v ktorej ste previedol zálohu, je rovnaká, ako verzia, ktorú používate teraz! Inak obnova nebude fungovať.');
define('_RESTORE_INTRO',			'Tu vyberte súbor so zálohou (bude nahraný na server) a kliknite na tlačítko "Obnoviť" pre zahájenie akcie.');
define('_RESTORE_IMSURE',			'Áno, som si istý, že to chcem urobiť!');
define('_RESTORE_BTN',				'Obnoviť zo súboru');
define('_RESTORE_WARNING',			'(uistite sa, že obnovujete správnu zálohu, prípadně si najprv zazálohujte terajšie dáta)');
define('_ERROR_BACKUP_NOTSURE',		'Musíte zaškrtnúť políčko \'Som si istý\'');
define('_RESTORE_COMPLETE',			'Obnova bola dokončená');

// new item notification
define('_NOTIFY_NI_MSG',			'Bol publikovaný nový článok:');
define('_NOTIFY_NI_TITLE',			'Nový článok!');
define('_NOTIFY_KV_MSG',			'Karma voľba pri článku:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'Komentár k článku:');
define('_NOTIFY_NC_TITLE',			'Nucleus komentár:');
define('_NOTIFY_USERID',			'ID užívateľa:');
define('_NOTIFY_USER',				'Užívateľ:');
define('_NOTIFY_COMMENT',			'Komentár:');
define('_NOTIFY_VOTE',				'Voľba:');
define('_NOTIFY_HOST',				'Server:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'Člen:');
define('_NOTIFY_TITLE',				'Nadpis:');
define('_NOTIFY_CONTENTS',			'Text:');

// member mail message
define('_MMAIL_MSG',				'Obdržal ste novú správu od');
define('_MMAIL_FROMANON',			'anonymného návštěvníka');
define('_MMAIL_FROMNUC',			'Odoslané v systéme Nucleus weblog v');
define('_MMAIL_TITLE',				'Správa od');
define('_MMAIL_MAIL',				'Správa:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'Pridať článok');
define('_BMLET_EDIT',				'Upraviť článok');
define('_BMLET_DELETE',				'Odstrániť článok');
define('_BMLET_BODY',				'Text');
define('_BMLET_MORE',				'Rozšírený text');
define('_BMLET_OPTIONS',			'Volby');
define('_BMLET_PREVIEW',			'Náhľad');

// used in bookmarklet
define('_ITEM_UPDATED',				'Článok bol upravený');
define('_ITEM_DELETED',				'Článok bol odstránený');

// plugins
define('_CONFIRMTXT_PLUGIN',		'Skutočne chcete odstrániť plugin');
define('_ERROR_NOSUCHPLUGIN',		'Taký plugin neexistuje');
define('_ERROR_DUPPLUGIN',			'Tento plugin už bol nainštalovaný');
define('_ERROR_PLUGFILEERROR',		'Plugin neexistuje, alebo sú zle nastavené prístupové práva');
define('_PLUGS_NOCANDIDATES',		'Žiadne pluginy neboli nájdené');

define('_PLUGS_TITLE_MANAGE',		'Správa pluginov');
define('_PLUGS_TITLE_INSTALLED',	'Momentálne nainštalované');
define('_PLUGS_TITLE_UPDATE',		'Aktualizovať zoznam odberov');
define('_PLUGS_TEXT_UPDATE',		'Nucleus si udržuje databázu odberov udalostí pre pluginy. Ak nahráte novú verziu pluginu, mali by ste spustiť túto aktualizáciu, aby boli odbery obnovené.');
define('_PLUGS_TITLE_NEW',			'Nainštalovať nový plugin');
define('_PLUGS_ADD_TEXT',			'Dole vidíte zoznam súborov z adresára pluginov, ktoré asi sú  nenainštalované pluginy. Pred ich nainštalovaním sa uistite, že to sú <strong>určite</strong> pluginy.');
define('_PLUGS_BTN_INSTALL',		'Nainštalovať plugin');
define('_BACKTOOVERVIEW',			'Späť na prehľad');

// editlink
define('_TEMPLATE_EDITLINK',		'Odkaz na editáciu článku');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'Pridať rámček vľavo');
define('_ADD_RIGHT_TT',				'Pridať rámček vpravo');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'Nová kategória...');

// new settings
define('_SETTINGS_PLUGINURL',		'URL s pluginmi');
define('_SETTINGS_MAXUPLOADSIZE',	'Max. veľkosť súboru pre nahranie (bytes)');
define('_SETTINGS_NONMEMBERMSGS',	'Povoliť neregistrovaným posielať aprávy');
define('_SETTINGS_PROTECTMEMNAMES',	'Chrániť mená členov');

// overview screen
define('_OVERVIEW_PLUGINS',			'Správa pluginov...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'Registrácia nového člena:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'Vaša emailová adresa:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'Nemáte správcovské práva pre žiadny z blogov, ktoré majú príjemcu vo svojom tíme. Preto nesmiete nahrávať súbory do adresára tetjo osoby.');

// plugin list
define('_LISTS_INFO',				'Informácie');
define('_LIST_PLUGS_AUTHOR',		'Od:');
define('_LIST_PLUGS_VER',			'Verzia:');
define('_LIST_PLUGS_SITE',			'Navštíviť stránku');
define('_LIST_PLUGS_DESC',			'Popis:');
define('_LIST_PLUGS_SUBS',			'Odberateť týchto udalostí:');
define('_LIST_PLUGS_UP',			'nahor');
define('_LIST_PLUGS_DOWN',			'nadol');
define('_LIST_PLUGS_UNINSTALL',		'odinštalovať');
define('_LIST_PLUGS_ADMIN',			'správca');
define('_LIST_PLUGS_OPTIONS',		'upraviť&nbsp;nastavenie');

// plugin option list
define('_LISTS_VALUE',				'Hodnota');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'tento plugin nemá žiadne nastavenia');
define('_PLUGS_BACK',				'Späť na prehľad pluginov');
define('_PLUGS_SAVE',				'Uložiť nastavenia');
define('_PLUGS_OPTIONS_UPDATED',	'Nastavenia pluginu boli upravené');

define('_OVERVIEW_MANAGEMENT',		'Správa');
define('_OVERVIEW_MANAGE',			'Správa Nucleusu...');
define('_MANAGE_GENERAL',			'Všeobecné nastavenia');
define('_MANAGE_SKINS',				'Vzhľad a šablóny');
define('_MANAGE_EXTRA',				'Extra voľby');

define('_BACKTOMANAGE',				'Späť na správu Nucleusu');


// END introduced after v1.1 END




// charset to use 
define('_CHARSET',					'ISO-8859-2');

// global stuff
define('_LOGOUT',					'Odhlásiť sa');
define('_LOGIN',					'Prihlásiť sa');
define('_YES',						'Áno');
define('_NO',						'Nie');
define('_SUBMIT',					'Odoslať');
define('_ERROR',					'Chyba');
define('_ERRORMSG',					'Vyskytla se chyba!');
define('_BACK',						'Späť');
define('_NOTLOGGEDIN',				'Nie ste prihlásení');
define('_LOGGEDINAS',				'Prihlásený ako');
define('_ADMINHOME',				'Správca');
define('_NAME',						'Meno');
define('_BACKHOME',					'Späť na správcovskú stránku');
define('_BADACTION',				'Bola požadovaná neexistujúca akcia');
define('_MESSAGE',					'Správa');
define('_HELP_TT',					'Pomoc!');
define('_YOURSITE',					'Vaša stránka');


define('_POPUP_CLOSE',				'Zatvoriť okno');

define('_LOGIN_PLEASE',				'Prosím, najprv sa prihláste');

// commentform
define('_COMMENTFORM_YOUARE',		'Ste');
define('_COMMENTFORM_SUBMIT',		'Pridať komentár');
define('_COMMENTFORM_COMMENT',		'Váš komentár');
define('_COMMENTFORM_NAME',			'Meno');
define('_COMMENTFORM_MAIL',			'E-mail/HTTP');
define('_COMMENTFORM_REMEMBER',		'Pamätaj si mna');

// loginform
define('_LOGINFORM_NAME',			'Meno');
define('_LOGINFORM_PWD',			'Heslo');
define('_LOGINFORM_YOUARE',			'Prihlásený ako');
define('_LOGINFORM_SHARED',			'Neukladať údaje');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'Poslat správu');

// search form
define('_SEARCHFORM_SUBMIT',		'Hľadanie');

// add item form
define('_ADD_ADDTO',				'Pridať nový článok do');
define('_ADD_CREATENEW',			'Vytvoriť nový článok');
define('_ADD_BODY',					'Perex');
define('_ADD_TITLE',				'Nadpis');
define('_ADD_MORE',					'Celý článok');
define('_ADD_CATEGORY',				'Kategória');
define('_ADD_PREVIEW',				'Náhľad');
define('_ADD_DISABLE_COMMENTS',		'Zakázať komentáre?');
define('_ADD_DRAFTNFUTURE',			'Koncepty a články pre neskoršie publikovanie');
define('_ADD_ADDITEM',				'Pridať článok');
define('_ADD_ADDNOW',				'Pridať teraz');
define('_ADD_ADDLATER',				'Pridať neskôr');
define('_ADD_PLACE_ON',				'Umiestniť na');
define('_ADD_ADDDRAFT',				'Pridať medzi koncepty');
define('_ADD_NOPASTDATES',			'(dátumy a časy v minulosti NIE SÚ platné, v tom prípade bude použitý aktuálny čas)');
define('_ADD_BOLD_TT',				'Tučné');
define('_ADD_ITALIC_TT',			'Kurzíva');
define('_ADD_HREF_TT',				'Vytvoriť odkaz');
define('_ADD_MEDIA_TT',				'Pridať obrázok');
define('_ADD_PREVIEW_TT',			'Zobraziť/skryť náhľad');
define('_ADD_CUT_TT',				'Vybrať');
define('_ADD_COPY_TT',				'Kopírovať');
define('_ADD_PASTE_TT',				'Vložit');


// edit item form
define('_EDIT_ITEM',				'Upraviť článok');
define('_EDIT_SUBMIT',				'Upraviť článok');
define('_EDIT_ORIG_AUTHOR',			'Pôvodný autor');
define('_EDIT_BACKTODRAFTS',		'Pridať späť medzi koncepty');
define('_EDIT_COMMENTSNOTE',		'(poznámka: zakázanie komentárov _neskryje_ skôr pridané komentáre)');

// used on delete screens
define('_DELETE_CONFIRM',			'Prosím, potvrďte odstranenie');
define('_DELETE_CONFIRM_BTN',		'Potvrdenie odstranenia');
define('_CONFIRMTXT_ITEM',			'Chystáte sa odstrániť nasledujúcí článok:');
define('_CONFIRMTXT_COMMENT',		'Chystáte sa odstrániť následujúcí komentár:');
define('_CONFIRMTXT_TEAM1',			'Chystáte sa odstrániť uživateľa ');
define('_CONFIRMTXT_TEAM2',			' z tímu pre blog ');
define('_CONFIRMTXT_BLOG',			'Blog, ktorý sa chystáte odstrániť, je: ');
define('_WARNINGTXT_BLOGDEL',		'Pozor! Odstránením blogu dojde k vymazaniu VŠETKÝCH článkov tohoto blogu a všetkých komentárov. Prosím, potvrďte, že to NAOZAJ chcete urobiť!<br />Behom odstraňovania blogu neprerušujte Nucleus.');
define('_CONFIRMTXT_MEMBER',		'Chystáte sa odstrániť profil následujúceho člena: ');
define('_CONFIRMTXT_TEMPLATE',		'Chystáte se odstrániť šablónu ');
define('_CONFIRMTXT_SKIN',			'Chystáte sa odstrániť vzhľad ');
define('_CONFIRMTXT_BAN',			'Chystáte sa odstrániť obmedzenie prístupu pre ip adresy');
define('_CONFIRMTXT_CATEGORY',		'Chystáte sa odstrániť kategóriu ');

// some status messages
define('_DELETED_ITEM',				'Článok odstránený');
define('_DELETED_MEMBER',			'Reg. užívateľ odstráný');
define('_DELETED_COMMENT',			'Komentář odstraněn');
define('_DELETED_BLOG',				'Blog odstránený');
define('_DELETED_CATEGORY',			'Kategória odstránená');
define('_ITEM_MOVED',				'Článok presunutý');
define('_ITEM_ADDED',				'Článok pridaný');
define('_COMMENT_UPDATED',			'Komentár upravený');
define('_SKIN_UPDATED',				'Vzhľad bol uložený');
define('_TEMPLATE_UPDATED',			'Šablóna bola uložená');

// errors
define('_ERROR_COMMENT_LONGWORD',	'Prosím, v komentároch nepoužívajte slová dlhšie než 90 znakov');
define('_ERROR_COMMENT_NOCOMMENT',	'Prosím, vložte komentár');
define('_ERROR_COMMENT_NOUSERNAME',	'Neplatné uživateľské meno');
define('_ERROR_COMMENT_TOOLONG',	'Váš komentár je príliš dlhý (max. 5000 znakov)');
define('_ERROR_COMMENTS_DISABLED',	'Komentáre pre tento blog sú momentálne zakázané.');
define('_ERROR_COMMENTS_NONPUBLIC',	'Aby ste mohli pridávať komentáre do tohoto blogu, musíte byť prihlásení');
define('_ERROR_COMMENTS_MEMBERNICK','Meno, pod ktorým chcete odoslat komentár, používa iný registrovaný uživateľ. Použite nejaké iné.');
define('_ERROR_SKIN',				'Chyba v definícii vzhľadu');
define('_ERROR_ITEMCLOSED',			'Tento článok bol uzatvorený. Už nie je možné k nemu pridávať komentáre ani hlasovať');
define('_ERROR_NOSUCHITEM',			'Článok nenájdený');
define('_ERROR_NOSUCHBLOG',			'Blog nenájdený');
define('_ERROR_NOSUCHSKIN',			'Vzhľad nenájdený');
define('_ERROR_NOSUCHMEMBER',		'Registrovaný užívateľ nenájdený');
define('_ERROR_NOTONTEAM',			'Nie ste členom tímu tohto blogu');
define('_ERROR_BADDESTBLOG',		'Cieľový blog neexistuje');
define('_ERROR_NOTONDESTTEAM',		'Nie je možné presunúť článok, pretože nie ste členom tímu cieľového blogu');
define('_ERROR_NOEMPTYITEMS',		'Nie je možné pridať prázdny článok!');
define('_ERROR_BADMAILADDRESS',		'Emailová adresa nie je platná');
define('_ERROR_BADNOTIFY',			'Jedna alebo viac z udaných adries pre oznamovanie nie je platná emailová adresa');
define('_ERROR_BADNAME',			'Meno nie je platné (sú dovolené iba znaky a-z a 0-9, žiadne medzery na začiatku a na konci)');
define('_ERROR_NICKNAMEINUSE',		'Túto prezývku už používa iný registrovaný člen');
define('_ERROR_PASSWORDMISMATCH',	'Heslá musia byť rovnaké');
define('_ERROR_PASSWORDTOOSHORT',	'Heslo by malo mať aspoň 6 znakov');
define('_ERROR_PASSWORDMISSING',	'Heslo nesmie byť prázdne');
define('_ERROR_REALNAMEMISSING',	'Musíte vložiť skutočné meno');
define('_ERROR_ATLEASTONEADMIN',	'Mal by byť vždy aspoň jeden super-správca, ktorý ss môže prihlásiť do správcovskej sekcie.');
define('_ERROR_ATLEASTONEBLOGADMIN','Vykonsnie tejto akcie by spôsobilo, že by váš blog nemal kto spravovať.  Uistite sa, že vždy existuje aspoň jeden správca.');
define('_ERROR_ALREADYONTEAM',		'Nemôžete pridať užívateľa, ktorý už je členom tímu');
define('_ERROR_BADSHORTBLOGNAME',	'Krátke meno blogu by malo obsahovať len znaky a-z a 0-9, bez medzier');
define('_ERROR_DUPSHORTBLOGNAME',	'Toto krátke meno už používa iný blog. Tieto mená musia byť unikátne.');
define('_ERROR_UPDATEFILE',			'Nie je možné zapisovať do update-souboru. Uistite sa, že sú správne nastavené prístupové práva (skúste chmod 666). Tiež pozor na to, že umiestnenie je relatívne k adresáru správcovskej oblasti, takže by ste mohli skúsiť absolútnu cestu (niečo ako /your/path/to/nucleus/)');
define('_ERROR_DELDEFBLOG',			'Nie je možné odstrániť prednastavený blog');
define('_ERROR_DELETEMEMBER',		'Tento užívateľ nemôže byť odstránený. Pravdepodobne preto, protože je autorom nejakých článkov, alebo komentárov.');
define('_ERROR_BADTEMPLATENAME',	'Neplatné meno šablóny. Použite iba znaky a-z a 0-9, žiadne medzery.');
define('_ERROR_DUPTEMPLATENAME',	'Už existuje šablóna s týmto názvom.');
define('_ERROR_BADSKINNAME',		'Neplatné meno vzhľadu (použite iba znaky a-z a 0-9, žiadne medzery)');
define('_ERROR_DUPSKINNAME',		'Už existuje vzhľad s týmto názvom.');
define('_ERROR_DEFAULTSKIN',		'Vzhľad s názvom "default" musí byť vždy dostupný.');
define('_ERROR_SKINDEFDELETE',		'Nie je možné odstrániť vzhľad, pretože je to štandardný vzhľad pre nssledujúci blog: ');
define('_ERROR_DISALLOWED',			'Prepáčte, ale nie ste oprávnení k tejto akci.');
define('_ERROR_DELETEBAN',			'Chyba pri odstraňovaní obmedzenia přístupu (obmedzenie prístupu neexistuje)');
define('_ERROR_ADDBAN',				'Chyba pri pridávaní obmedzenia prístupu. Obmedzenie prístupu asi nebolo korektne pridané do všetkých blogov.');
define('_ERROR_BADACTION',			'Požadovaná akcia neexistuje');
define('_ERROR_MEMBERMAILDISABLED',	'Mailové správy medzi členmi sú zakázané.');
define('_ERROR_MEMBERCREATEDISABLED','Vytváranie užívateľských kont je zakázané.');
define('_ERROR_INCORRECTEMAIL',		'Neplatná mailová adresa');
define('_ERROR_VOTEDBEFORE',		'Pre tento článok už ste hlasovali');
define('_ERROR_BANNED1',			'Akciu nie je možné vykonať, protože vám (rozsah adries ');
define('_ERROR_BANNED2',			') byl obmedzený prístup. Správa bola: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'Aby ste mohli vykonať túto akciu, musíte sa prihlásiť.');
define('_ERROR_CONNECT',			'Chyba spojenia');
define('_ERROR_FILE_TOO_BIG',		'Súbor je príliš veľký!');
define('_ERROR_BADFILETYPE',		'Prepáčte, ale tento typ súboru nie je povolený.');
define('_ERROR_BADREQUEST',			'Neplatný požiadavok pre nahranie súboru');
define('_ERROR_DISALLOWEDUPLOAD',	'Nie ste členom tímu žiadneho blogu, a preto nemôžete nahrávať súbory.');
define('_ERROR_BADPERMISSIONS',		'Práva pre súbor/adresár nie sú správne nastavené');
define('_ERROR_UPLOADMOVEP',		'Chyba pri presune nahraného súboru');
define('_ERROR_UPLOADCOPY',			'Chyba pri kopírovaní súboru');
define('_ERROR_UPLOADDUPLICATE',	'Súbor s týmto názvom už existuje. Pred nahraním ho skúste premenovať.');
define('_ERROR_LOGINDISALLOWED',	'Prepáčte, ale nemôžete sa prihlásiť do správcovskej oblasti. Avšak môžete sa prihlásiť ako iný užívateľ.');
define('_ERROR_DBCONNECT',			'Nie je možné pripojiť sa k mySQL serveru');
define('_ERROR_DBSELECT',			'Nie je možné vybrať databázu nucleus.');
define('_ERROR_NOSUCHLANGUAGE',		'Tento jazykový súbor neexistuje');
define('_ERROR_NOSUCHCATEGORY',		'Taká kategória neexistuje');
define('_ERROR_DELETELASTCATEGORY',	'Musí existovať aspoň jedna kategória');
define('_ERROR_DELETEDEFCATEGORY',	'Nie je možné odstrániť defaultnú kategóriu');
define('_ERROR_BADCATEGORYNAME',	'Neplatný názov kategória');
define('_ERROR_DUPCATEGORYNAME',	'Kategória s týmto názvom už existuje');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'Pozor: Aktuálna hodnota nie je adresár!');
define('_WARNING_NOTREADABLE',		'Pozor: Aktuálna hodnota nie je adresár na čítanie!');
define('_WARNING_NOTWRITABLE',		'Pozor: Aktuálna hodnota NIE JE adresár, do ktorého sa dá zapisovať!');

// media and upload
define('_MEDIA_UPLOADLINK',			'Nahrať nový súbor');
define('_MEDIA_MODIFIED',			'modifikovaný');
define('_MEDIA_FILENAME',			'názov súboru');
define('_MEDIA_DIMENSIONS',			'rozmery');
define('_MEDIA_INLINE',				'Vo vnútri');
define('_MEDIA_POPUP',				'Okno');
define('_UPLOAD_TITLE',				'Zvoľte súbor');
define('_UPLOAD_MSG',				'Vyberte súbor pre nahratie, a potom stlačte tlačítko \'Nahrať\'.');
define('_UPLOAD_BUTTON',			'Nahrať');

// some status messages
define('_MSG_ACCOUNTCREATED',		'Účet bol vytvorený. Heslo obdržíte e-mailom.');
define('_MSG_PASSWORDSENT',			'Heslo vám bolo odoslané e-mailom.');
define('_MSG_LOGINAGAIN',			'Budete sa musieť znova prihlásiť, pretože vaše údaje boli zmenené.');
define('_MSG_SETTINGSCHANGED',		'Nastavenia zmenené');
define('_MSG_ADMINCHANGED',			'Správca zmenený');
define('_MSG_NEWBLOG',				'Nový blog bol vytvorený');
define('_MSG_ACTIONLOGCLEARED',		'Log akcií bol zmazaný');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'Nepovolená akcia: ');
define('_ACTIONLOG_PWDREMINDERSENT','Odoslané nové heslo pre ');
define('_ACTIONLOG_TITLE',			'Log akcií');
define('_ACTIONLOG_CLEAR_TITLE',	'Zmazať log akcií');
define('_ACTIONLOG_CLEAR_TEXT',		'Vymazať log akcií');

// team management
define('_TEAM_TITLE',				'Správa tímu pre blog ');
define('_TEAM_CURRENT',				'Aktuálny tím');
define('_TEAM_ADDNEW',				'Pridať člena do tímu');
define('_TEAM_CHOOSEMEMBER',		'Zvoľte člena');
define('_TEAM_ADMIN',				'Správcovské práva? ');
define('_TEAM_ADD',					'Pridať do tímu');
define('_TEAM_ADD_BTN',				'Pridať do tímu');

// blogsettings
define('_EBLOG_TITLE',				'Upraviť nastavenie blogu');
define('_EBLOG_TEAM_TITLE',			'Upraviť tím');
define('_EBLOG_TEAM_TEXT',			'Kliknite tu pre úpravu tímu...');
define('_EBLOG_SETTINGS_TITLE',		'Nastavenie blogu');
define('_EBLOG_NAME',				'Meno blogu');
define('_EBLOG_SHORTNAME',			'Krátke meno blogu');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(iba znaky a-z bez medzier)');
define('_EBLOG_DESC',				'Popis blogu');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'Štandardný vzhľad');
define('_EBLOG_DEFCAT',				'štandardná kategória');
define('_EBLOG_LINEBREAKS',			'Odriadkovávať');
define('_EBLOG_DISABLECOMMENTS',	'Povoliť komentáre?<br /><small>(Určuje, či je možné pridávať komentáre)</small>');
define('_EBLOG_ANONYMOUS',			'Povoliť komentáre od neregistrovaných návštěvníkov?');
define('_EBLOG_NOTIFY',				'Adresa/adresy pre oznamovanie (použite ; ako oddeľovač)');
define('_EBLOG_NOTIFY_ON',			'Oznamovať zaslanie');
define('_EBLOG_NOTIFY_COMMENT',		'Nových komentárov');
define('_EBLOG_NOTIFY_KARMA',		'Nových karma hlasov');
define('_EBLOG_NOTIFY_ITEM',		'Nových článkov blogu');
define('_EBLOG_PING',				'Ping na Weblogs.com pri zmenách?');
define('_EBLOG_MAXCOMMENTS',		'Maximálny počet komentárov');
define('_EBLOG_UPDATE',				'Zapísať zmeny do súboru');
define('_EBLOG_OFFSET',				'Časový posun');
define('_EBLOG_STIME',				'Aktuálny čas serveru je');
define('_EBLOG_BTIME',				'Aktuálny čas blogu je');
define('_EBLOG_CHANGE',				'Zmeniť nastavenie');
define('_EBLOG_CHANGE_BTN',			'Změnit nastavení');
define('_EBLOG_ADMIN',				'Správca blogu');
define('_EBLOG_ADMIN_MSG',			'Obdržíte správcovské práva');
define('_EBLOG_CREATE_TITLE',		'Vytvoriť nový blog');
define('_EBLOG_CREATE_TEXT',		'Pre vytvorenie nového blogu vyplňte nasledujúcí formulár. <br /><br /> <b>Poznámka:</b> Sú tu vypísané iba najnutnejšie voľby. Ak chcete změnit daľšie nastavenia, po vytvorení blogu navštivte stránku s vlastnosťami blogu.');
define('_EBLOG_CREATE',				'Vytvoriť!');
define('_EBLOG_CREATE_BTN',			'Vytvoriť blog');
define('_EBLOG_CAT_TITLE',			'Kategória');
define('_EBLOG_CAT_NAME',			'Názov kategórie');
define('_EBLOG_CAT_DESC',			'Popis kategórie');
define('_EBLOG_CAT_CREATE',			'Vytvoriť novú kategóriu');
define('_EBLOG_CAT_UPDATE',			'Upraviť kategóriu');
define('_EBLOG_CAT_UPDATE_BTN',		'Upraviť kategóriu');

// templates
define('_TEMPLATE_TITLE',			'Upraviť šablóny');
define('_TEMPLATE_AVAILABLE_TITLE',	'Dostupné šablóny');
define('_TEMPLATE_NEW_TITLE',		'Nová šablóna');
define('_TEMPLATE_NAME',			'Názov šablóny');
define('_TEMPLATE_DESC',			'Popis šablóny');
define('_TEMPLATE_CREATE',			'Vytvoriť šablónu');
define('_TEMPLATE_CREATE_BTN',		'Vytvoriť šablónu');
define('_TEMPLATE_EDIT_TITLE',		'Upraviť šablónu');
define('_TEMPLATE_BACK',			'Späť na prehľad šablón');
define('_TEMPLATE_EDIT_MSG',		'Nie všetky časti šablóny sú vyžadované. Nepotrebné časti nechajte prázdne.');
define('_TEMPLATE_SETTINGS',		'Nastavenie šablóny');
define('_TEMPLATE_ITEMS',			'Články');
define('_TEMPLATE_ITEMHEADER',		'Hlavička článku');
define('_TEMPLATE_ITEMBODY',		'Telo článku');
define('_TEMPLATE_ITEMFOOTER',		'Pätička článku');
define('_TEMPLATE_MORELINK',		'Odkaz na rozširujúcí text');
define('_TEMPLATE_NEW',				'Označenie nového článku');
define('_TEMPLATE_COMMENTS_ANY',	'Komentáre (ak sú)');
define('_TEMPLATE_CHEADER',			'Hlavička komentára');
define('_TEMPLATE_CBODY',			'Telo komentára');
define('_TEMPLATE_CFOOTER',			'Pätička komentára');
define('_TEMPLATE_CONE',			'Jeden komentár');
define('_TEMPLATE_CMANY',			'Dva (a viac) komentárov');
define('_TEMPLATE_CMORE',			'\'Čítať viac\' pri komentároch');
define('_TEMPLATE_CMEXTRA',			'Daľšie údaje iba pre členov');
define('_TEMPLATE_COMMENTS_NONE',	'Komentáre (ak nejaké sú)');
define('_TEMPLATE_CNONE',			'Žiadne komentáre');
define('_TEMPLATE_COMMENTS_TOOMUCH','Komentáre (pokiať sú, ale je ich viac, než sa dá zobraziť priamo)');
define('_TEMPLATE_CTOOMUCH',		'Príliš mnoho komentárov');
define('_TEMPLATE_ARCHIVELIST',		'Zeznam archívov');
define('_TEMPLATE_AHEADER',			'Hlavička zoznamu archívov');
define('_TEMPLATE_AITEM',			'Položka zoznamu archívov');
define('_TEMPLATE_AFOOTER',			'Pätička zoznamu archívov');
define('_TEMPLATE_DATETIME',		'Dátum a čas');
define('_TEMPLATE_DHEADER',			'Hlavička dátumu');
define('_TEMPLATE_DFOOTER',			'Pätička dátumu');
define('_TEMPLATE_DFORMAT',			'Formát dátumu');
define('_TEMPLATE_TFORMAT',			'Formát času');
define('_TEMPLATE_LOCALE',			'Miestne nastavenie');
define('_TEMPLATE_IMAGE',			'Okna s obrázkom');
define('_TEMPLATE_PCODE',			'Kód odkazu pre okná s obrázkom');
define('_TEMPLATE_ICODE',			'Kód pro vložný obrázok');
define('_TEMPLATE_MCODE',			'Kód odkazu na soubor médií');
define('_TEMPLATE_SEARCH',			'Hľadanie');
define('_TEMPLATE_SHIGHLIGHT',		'Zvýraznenie');
define('_TEMPLATE_SNOTFOUND',		'Pri hľadaní nebolo nič nájdené');
define('_TEMPLATE_UPDATE',			'Upraviť');
define('_TEMPLATE_UPDATE_BTN',		'Upraviť šablónu');
define('_TEMPLATE_RESET_BTN',		'Pôvodné dáta');
define('_TEMPLATE_CATEGORYLIST',	'Zoznamy kategórií');
define('_TEMPLATE_CATHEADER',		'Hlavička zoznamu kategórií');
define('_TEMPLATE_CATITEM',			'Položka zoznamu kategórií');
define('_TEMPLATE_CATFOOTER',		'Pätička zoznamu kategórií');

// skins
define('_SKIN_EDIT_TITLE',			'Upraviť vzhľady');
define('_SKIN_AVAILABLE_TITLE',		'Dostupné vzhľady');
define('_SKIN_NEW_TITLE',			'Nový vzhľad');
define('_SKIN_NAME',				'Názov');
define('_SKIN_DESC',				'Popis');
define('_SKIN_TYPE',				'Typ obsahu');
define('_SKIN_CREATE',				'Vytvoriť');
define('_SKIN_CREATE_BTN',			'Vytvoriť vzhľad');
define('_SKIN_EDITONE_TITLE',		'Upraviť vzhľad');
define('_SKIN_BACK',				'Späť na prehľad vzhľadov');
define('_SKIN_PARTS_TITLE',			'Časti vzhľadu');
define('_SKIN_PARTS_MSG',			'Pre každý vzhľad nie sú potrebné všetky typy. Tie, ktoré nepotrebujete, nechajte prázdne. Zvoľte typ vzhľadu, ktorý chcete upraviť::');
define('_SKIN_PART_MAIN',			'Hlavný prehľad');
define('_SKIN_PART_ITEM',			'Stránky článkov');
define('_SKIN_PART_ALIST',			'Zoznam archívov');
define('_SKIN_PART_ARCHIVE',		'Archív');
define('_SKIN_PART_SEARCH',			'Hľadanie');
define('_SKIN_PART_ERROR',			'Chyby');
define('_SKIN_PART_MEMBER',			'Detaily reg. užívateľa');
define('_SKIN_PART_POPUP',			'Okna s obrázkom');
define('_SKIN_GENSETTINGS_TITLE',	'Všeobecné nastavenia');
define('_SKIN_CHANGE',				'Zmeniť');
define('_SKIN_CHANGE_BTN',			'Zmeniť tieto nastavenia');
define('_SKIN_UPDATE_BTN',			'Uloľiť vzhľad');
define('_SKIN_RESET_BTN',			'Pôvodné dáta');
define('_SKIN_EDITPART_TITLE',		'Upraviť vzhľad');
define('_SKIN_GOBACK',				'Späť');
define('_SKIN_ALLOWEDVARS',			'Dostupné premenné (kliknite pre bližšie informácie):');

// global settings
define('_SETTINGS_TITLE',			'Všeobecné nastavenia');
define('_SETTINGS_SUB_GENERAL',		'Všeobecné nastavenia');
define('_SETTINGS_DEFBLOG',			'Štandardný blog');
define('_SETTINGS_ADMINMAIL',		'E-mail správcu');
define('_SETTINGS_SITENAME',		'Názov stránky');
define('_SETTINGS_SITEURL',			'URL stránky (malo by končiť lomítkom)');
define('_SETTINGS_ADMINURL',		'URL správcovskej oblasti (malo by končiť lomítkom)');
define('_SETTINGS_DIRS',			'AdresáreNucleusu');
define('_SETTINGS_MEDIADIR',		'Adresár s médiami');
define('_SETTINGS_SEECONFIGPHP',	'(viď config.php)');
define('_SETTINGS_MEDIAURL',		'URL médií (malo by končiť lomítkom)');
define('_SETTINGS_ALLOWUPLOAD',		'Povoliť nahrávanie (upload) souborov?');
define('_SETTINGS_ALLOWUPLOADTYPES','Typy súborov, ktoré je možné nahrať');
define('_SETTINGS_CHANGELOGIN',		'Povoliť registrovaným užívateľom meniť meno/heslo');
define('_SETTINGS_COOKIES_TITLE',	'Nastavenie cookies');
define('_SETTINGS_COOKIELIFE',		'Doba životnosti prihlasovacieho cookie');
define('_SETTINGS_COOKIESESSION',	'Jednorazové cookies (session)');
define('_SETTINGS_COOKIEMONTH',		'Mesiac');
define('_SETTINGS_COOKIEPATH',		'Cesta cookie (pokročilé)');
define('_SETTINGS_COOKIEDOMAIN',	'Doména cookie (pokročilé)');
define('_SETTINGS_COOKIESECURE',	'Zabezpečené cookie (pokročilé)');
define('_SETTINGS_LASTVISIT',		'Ukladať cookies poslednej návštevy');
define('_SETTINGS_ALLOWCREATE',		'Povoliť návštevníkom vytvoriť si registrovaný účet');
define('_SETTINGS_NEWLOGIN',		'Povoliť prihlásenie z účtov, vytvorených návštevníkmi');
define('_SETTINGS_NEWLOGIN2',		'(iba pre novo vytvorené účty)');
define('_SETTINGS_MEMBERMSGS',		'Povoliť služby medzi členmi');
define('_SETTINGS_LANGUAGE',		'Štandardný jazyk');
define('_SETTINGS_DISABLESITE',		'Vypnúť stránku');
define('_SETTINGS_DBLOGIN',			'mySQL Login a Databáza');
define('_SETTINGS_UPDATE',			'Uložiť nastavenia');
define('_SETTINGS_UPDATE_BTN',		'Uložiť nastavenia');
define('_SETTINGS_DISABLEJS',		'Zakázať JavaScript Toolbar');
define('_SETTINGS_MEDIA',			'Nastavenia pre média/nahrávánie súborov');
define('_SETTINGS_MEDIAPREFIX',		'Nahraným súborom pridať pred meno dátum');
define('_SETTINGS_MEMBERS',			'Nastavenie registrovaných užívateľom');

// bans
define('_BAN_TITLE',				'Zoznam obmedzení prístupu pre');
define('_BAN_NONE',					'Tento blog nemá žiadne obmedzenia prístupu');
define('_BAN_NEW_TITLE',			'Pridat nové obmedzenie prístupu');
define('_BAN_NEW_TEXT',				'Pridať obmedzenie');
define('_BAN_REMOVE_TITLE',			'Odstrániť obmedzenie');
define('_BAN_IPRANGE',				'Rozsah IP adries');
define('_BAN_BLOGS',				'Ktoré blogy?');
define('_BAN_DELETE_TITLE',			'Odstrániť obmedzenie');
define('_BAN_ALLBLOGS',				'Všetky blogy, ku ktorým máte správcovské práva.');
define('_BAN_REMOVED_TITLE',		'Obmedzenie prístupu bolo odstránené');
define('_BAN_REMOVED_TEXT',			'Bolo odstránené obmedzenie prístupu pre nasledujúce blogy:');
define('_BAN_ADD_TITLE',			'Pridať obmedzenie prístupu');
define('_BAN_IPRANGE_TEXT',			'Zadajte rozsah IP adries, ktoré chcete blokovať. Čím menšie čísla, tým viac adries bude blokovaných.');
define('_BAN_BLOGS_TEXT',			'Môžete zablokovať rozsah IP adries iba pre jeden blog, alebo pre všetky blogy, ku ktorým máte správcovské práva.');
define('_BAN_REASON_TITLE',			'Dôvod');
define('_BAN_REASON_TEXT',			'Môžete zadať dôvod obmedzenia prístupu, ktorý bude zobrazený, ak sa vlastník blokovanej IP adresy pokúsi pridat komentár, alebo odoslať karma hlas. Maximálna dĺžka je 256 znakov.');
define('_BAN_ADD_BTN',				'Pridať obmedzenie');

// LOGIN screen
define('_LOGIN_MESSAGE',			'Správa');
define('_LOGIN_NAME',				'Meno');
define('_LOGIN_PASSWORD',			'Heslo');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'Zabudli ste heslo?');

// membermanagement
define('_MEMBERS_TITLE',			'Správa registrovaných užívateľov');
define('_MEMBERS_CURRENT',			'Aktuálni užívatelia');
define('_MEMBERS_NEW',				'Nový užívateľ');
define('_MEMBERS_DISPLAY',			'Zobrazované meno');
define('_MEMBERS_DISPLAY_INFO',		'(Toto je meno, pod ktorým sa prihlasujete)');
define('_MEMBERS_REALNAME',			'Skutočné meno');
define('_MEMBERS_PWD',				'Heslo');
define('_MEMBERS_REPPWD',			'Zopakovať heslo');
define('_MEMBERS_EMAIL',			'E-mailová adresa');
define('_MEMBERS_EMAIL_EDIT',		'(Ak zmeníte e-mailovú adresu, bude vám na ňu automaticky odoslané nové heslo)');
define('_MEMBERS_URL',				'Adresa webovej stránky (URL)');
define('_MEMBERS_SUPERADMIN',		'Správcovské práva');
define('_MEMBERS_CANLOGIN',			'Môže sa prihlásiť do správcovskej oblasti');
define('_MEMBERS_NOTES',			'Poznámky');
define('_MEMBERS_NEW_BTN',			'Pridať užívatele');
define('_MEMBERS_EDIT',				'Upraviť užívateľa');
define('_MEMBERS_EDIT_BTN',			'Uložiť nastavenia');
define('_MEMBERS_BACKTOOVERVIEW',	'Späť na prehľad užívateľov');
define('_MEMBERS_DEFLANG',			'Jazyk');
define('_MEMBERS_USESITELANG',		'- štandardný jazyk stránky -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'Navštíviť stránku');
define('_BLOGLIST_ADD',				'Pridať článok');
define('_BLOGLIST_TT_ADD',			'Pridať nový článok do tohto blogu');
define('_BLOGLIST_EDIT',			'Upraviť/odstrániť články');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Bookmarklet');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'Nastavenia');
define('_BLOGLIST_TT_SETTINGS',		'Upraviť nastavenia alebo spravovať tím');
define('_BLOGLIST_BANS',			'Obmedzenie prístupu');
define('_BLOGLIST_TT_BANS',			'Zobraziť, pridať alebo odstrániť blokované IP adresy');
define('_BLOGLIST_DELETE',			'Odstrániť všetko');
define('_BLOGLIST_TT_DELETE',		'Odstrániť tento blog');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'Sekcia hulan.info');
define('_OVERVIEW_YRDRAFTS',		'Vaše koncepty');
define('_OVERVIEW_YRSETTINGS',		'Vaše nastavenia');
define('_OVERVIEW_GSETTINGS',		'Všeobecné nastavenia');
define('_OVERVIEW_NOBLOGS',			'Nie ste členom tímu žiadneho z blogov');
define('_OVERVIEW_NODRAFTS',		'Žiadne koncepty');
define('_OVERVIEW_EDITSETTINGS',	'Upraviť vaše nastavenia...');
define('_OVERVIEW_BROWSEITEMS',		'Prezerať vaše články...');
define('_OVERVIEW_BROWSECOMM',		'Prezerať vaše komentáre...');
define('_OVERVIEW_VIEWLOG',			'Prezerať zoznam akcií...');
define('_OVERVIEW_MEMBERS',			'Správa reg. užívateľov...');
define('_OVERVIEW_NEWLOG',			'Vytvoriť nový blog...');
define('_OVERVIEW_SETTINGS',		'Upraviť nastavenia...');
define('_OVERVIEW_TEMPLATES',		'Upraviť šablóny...');
define('_OVERVIEW_SKINS',			'Upraviť vzhľady...');
define('_OVERVIEW_BACKUP',			'Záloha/obnova...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'Články pre blog'); 
define('_ITEMLIST_YOUR',			'Vaše články');

// Comments
define('_COMMENTS',					'Komentáre');
define('_NOCOMMENTS',				'Tento článok nemá žiadne komentáre');
define('_COMMENTS_YOUR',			'Vaše komentáre');
define('_NOCOMMENTS_YOUR',			'Nenapísal ste žiadne komentáre');

// LISTS (general)
define('_LISTS_NOMORE',				'Žiadne daľšie alebo vôbec žiadne výsledky');
define('_LISTS_PREV',				'Predošlé');
define('_LISTS_NEXT',				'Daľšie');
define('_LISTS_SEARCH',				'Hľadať');
define('_LISTS_CHANGE',				'Zmeniť');
define('_LISTS_PERPAGE',			'článkov/strana');
define('_LISTS_ACTIONS',			'Akcia');
define('_LISTS_DELETE',				'Odstrániť');
define('_LISTS_EDIT',				'Upraviť');
define('_LISTS_MOVE',				'Presunúť');
define('_LISTS_CLONE',				'Skopírovať');
define('_LISTS_TITLE',				'Titulok');
define('_LISTS_BLOG',				'Blog');
define('_LISTS_NAME',				'Názov');
define('_LISTS_DESC',				'Popis');
define('_LISTS_TIME',				'Čas');
define('_LISTS_COMMENTS',			'Komentáre');
define('_LISTS_TYPE',				'Typ');


// member list 
define('_LIST_MEMBER_NAME',			'Zobrazované meno');
define('_LIST_MEMBER_RNAME',		'Skutočné meno');
define('_LIST_MEMBER_ADMIN',		'Super-správca? ');
define('_LIST_MEMBER_LOGIN',		'Môže sa prihlásiť? ');
define('_LIST_MEMBER_URL',			'Stránka');

// banlist
define('_LIST_BAN_IPRANGE',			'Rozsah IP adres');
define('_LIST_BAN_REASON',			'Dôvod');

// actionlist
define('_LIST_ACTION_MSG',			'Správa');

// commentlist
define('_LIST_COMMENT_BANIP',		'Blokovať IP adresu');
define('_LIST_COMMENT_WHO',			'Autor');
define('_LIST_COMMENT',				'Komentár');
define('_LIST_COMMENT_HOST',		'Server');

// itemlist
define('_LIST_ITEM_INFO',			'Info');
define('_LIST_ITEM_CONTENT',		'Titulok a text');


// teamlist
define('_LIST_TEAM_ADMIN',			'Správca ');
define('_LIST_TEAM_CHADMIN',		'Zmeniť správcu');

// edit comments
define('_EDITC_TITLE',				'Upraviť komentáre');
define('_EDITC_WHO',				'Autor');
define('_EDITC_HOST',				'Odkiaľ?');
define('_EDITC_WHEN',				'Kedy?');
define('_EDITC_TEXT',				'Text');
define('_EDITC_EDIT',				'Upraviť komentár');
define('_EDITC_MEMBER',				'člen');
define('_EDITC_NONMEMBER',			'nie je členom');

// move item
define('_MOVE_TITLE',				'Presunúť do akého blogu?');
define('_MOVE_BTN',					'Presunúť článok');

?>
