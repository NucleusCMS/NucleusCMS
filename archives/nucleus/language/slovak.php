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
define('_MEDIA_VIEW',				'zobrazi»');
define('_MEDIA_VIEW_TT',			'Zobrazi» súbor (v novom okne)');
define('_MEDIA_FILTER_APPLY',		'Pou¾i» filter');
define('_MEDIA_FILTER_LABEL',		'Filter: ');
define('_MEDIA_UPLOAD_TO',			'Nahra» do...');
define('_MEDIA_UPLOAD_NEW',			'Nahra» nový súbor...');
define('_MEDIA_COLLECTION_SELECT',	'Výber');
define('_MEDIA_COLLECTION_TT',		'Prepnú» sa do tejto kategórie');
define('_MEDIA_COLLECTION_LABEL',	'Aktuálna kolekcia:: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'Zarovna» doµava');
define('_ADD_ALIGNRIGHT_TT',		'Zarovna» doprava');
define('_ADD_ALIGNCENTER_TT',		'Zarovna» na stred');

// searchable blog setting (yes/no)
define('_EBLOG_SEARCH',				'Zahrnú» do hµadania');

// generic upload failure
define('_ERROR_UPLOADFAILED',		'Nahrávanie zlyhalo');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'Povoli» publikovanie do minulosti');
define('_ADD_CHANGEDATE',			'Prepísa» dátum/èas');
define('_BMLET_CHANGEDATE',			'Prepísa» dátum/èas');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'Import/export vzhµadu...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Normálny');
define('_PARSER_INCMODE_SKINDIR',	'Pou¾i» adr. vzhµadu');
define('_SKIN_INCLUDE_MODE',		'Re¾im vkladania');
define('_SKIN_INCLUDE_PREFIX',		'Prefix');

// global settings
define('_SETTINGS_BASESKIN',		'Základný vzhµad');
define('_SETTINGS_SKINSURL',		'URL so vzhµadmi');
define('_SETTINGS_ACTIONSURL',		'Plné URL k action.php');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'Nie je mo¾né presunú» ¹tandardnú kategóriu');
define('_ERROR_MOVETOSELF',			'Nie je mo¾né presunú» kategóriu (cieµový blog je rovnaký, ako zdrojový blog)');
define('_MOVECAT_TITLE',			'Vyberte blog, do ktorého chcete presunút kategóriu');
define('_MOVECAT_BTN',				'Presunú» kategóriu');

// URLMode setting
define('_SETTINGS_URLMODE',			'Re¾im URL');
define('_SETTINGS_URLMODE_NORMAL',	'Normálny');
define('_SETTINGS_URLMODE_PATHINFO','Pestré');

// Batch operations
define('_BATCH_NOSELECTION',		'Pre prevedenie akcie nieje niè vybrané');
define('_BATCH_ITEMS',				'Dávková operácia na èlánkoch');
define('_BATCH_CATEGORIES',			'Dávková operácia na kategoriách');
define('_BATCH_MEMBERS',			'Dávková operácia na u¾ívateµoch');
define('_BATCH_TEAM',				'Dávková operácia na èlenoch tímu');
define('_BATCH_COMMENTS',			'Dávková operácia na komentároch');
define('_BATCH_UNKNOWN',			'Neznáma dávková operácia: ');
define('_BATCH_EXECUTING',			'Spú¹»a sa');
define('_BATCH_ONCATEGORY',			'na kategorii');
define('_BATCH_ONITEM',				'na èlánku');
define('_BATCH_ONCOMMENT',			'na komentári');
define('_BATCH_ONMEMBER',			'na u¾ivateµovi');
define('_BATCH_ONTEAM',				'na èlenovi tímu');
define('_BATCH_SUCCESS',			'Úspech!');
define('_BATCH_DONE',				'Hotovo!');
define('_BATCH_DELETE_CONFIRM',		'Potvrïte dávkové odstránenie');
define('_BATCH_DELETE_CONFIRM_BTN',	'Potvrïte dávkové odstránenie');
define('_BATCH_SELECTALL',			'vybra» v¹etko');
define('_BATCH_DESELECTALL',		'nevybra» niè');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'Odstráni»');
define('_BATCH_ITEM_MOVE',			'Pøesunú»');
define('_BATCH_MEMBER_DELETE',		'Odstráni»');
define('_BATCH_MEMBER_SET_ADM',		'Nastavi» správcovské práva');
define('_BATCH_MEMBER_UNSET_ADM',	'Odebrat správcovské práva');
define('_BATCH_TEAM_DELETE',		'Odstráni» z tímu');
define('_BATCH_TEAM_SET_ADM',		'Nastavi» správcovské práva');
define('_BATCH_TEAM_UNSET_ADM',		'Odobra» správcovské práva');
define('_BATCH_CAT_DELETE',			'Odstráni»');
define('_BATCH_CAT_MOVE',			'Presunú» do iného blogu');
define('_BATCH_COMMENT_DELETE',		'Odstráni»');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'Pridat nový èlánok...');
define('_ADD_PLUGIN_EXTRAS',		'Nastavenie pre pluginy');

// errors
define('_ERROR_CATCREATEFAIL',		'Nie je mo¾né vytvori» novú kategóriu');
define('_ERROR_NUCLEUSVERSIONREQ',	'Tento plugin vy¾aduje nov¹iu verziu Nucleusu: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Spä» na nastavenie blogu');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Import');
define('_SKINIE_TITLE_EXPORT',		'Export');
define('_SKINIE_BTN_IMPORT',		'Import');
define('_SKINIE_BTN_EXPORT',		'Export vybraných vzhµadov/¹ablón');
define('_SKINIE_LOCAL',				'Import z lokálneho súboru:');
define('_SKINIE_NOCANDIDATES',		'V adresári vzhµadov neboli nájdené ¾iadne polo¾ky pre import');
define('_SKINIE_FROMURL',			'Import z URL:');
define('_SKINIE_EXPORT_INTRO',		'Vyberte vzhµady a ¹ablóny, ktoré chcete exportova»');
define('_SKINIE_EXPORT_SKINS',		'Vzhµady');
define('_SKINIE_EXPORT_TEMPLATES',	'©ablóny');
define('_SKINIE_EXPORT_EXTRA',		'Extra info');
define('_SKINIE_CONFIRM_OVERWRITE',	'Prepísa» vzhµady, ktoré u¾ existujú (viï konflikty mien)');
define('_SKINIE_CONFIRM_IMPORT',	'Áno, toto chcem naimportova»');
define('_SKINIE_CONFIRM_TITLE',		'Budú naimportované vzhµady a ¹ablóny');
define('_SKINIE_INFO_SKINS',		'Vzhµady v súbore:');
define('_SKINIE_INFO_TEMPLATES',	'©ablóny v súbore:');
define('_SKINIE_INFO_GENERAL',		'Info:');
define('_SKINIE_INFO_SKINCLASH',	'Konflikty v názvoch vzhµadov:');
define('_SKINIE_INFO_TEMPLCLASH',	'Konflikty v názvoch ¹ablón:');
define('_SKINIE_INFO_IMPORTEDSKINS','Importované vzhµady:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Importované ¹ablóny::');
define('_SKINIE_DONE',				'Import dokonèený');

define('_AND',						'a');
define('_OR',						'alebo');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'prázdne pole (kliknite pre editáciu)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'Re¾im vkladania:');
define('_LIST_SKINS_INCPREFIX',		'Prefix:');
define('_LIST_SKINS_DEFINED',		'Definované èasti:');

// backup
define('_BACKUPS_TITLE',			'Záloha / obnovenie');
define('_BACKUP_TITLE',				'Záloha');
define('_BACKUP_INTRO',				'Kliknite na tlaèítko pre vytvorenie zálohy Nucleus databázy. Budete vyzvaní k ulo¾eniu súboru so zálohou. Tento súbor potom uschovajte na bezpeènom mieste.');
define('_BACKUP_ZIP_YES',			'Pokúsi» sa pou¾i» kompresiu');
define('_BACKUP_ZIP_NO',			'Nepou¾íva» kompresiu');
define('_BACKUP_BTN',				'Vytvori» zálohu');
define('_BACKUP_NOTE',				'<b>Poznámka:</b> Zálohuje sa iba obsah databázy. Obrázky a nastavenia v config.php teda <b>NIESU</b> súèás»ou zálohy.');
define('_RESTORE_TITLE',			'Obnovi»');
define('_RESTORE_NOTE',				'<b>POZOR:</b> Obnova zo zálohy <b>VYMA®E</b> súèasné dáta v databázi! Túto akciu preveïte iba ak ste si naozaj istí!	<br />	<b>Poznámka:</b> Uistite sa, ¾e verzia Nucleusu, v ktorej ste previedol zálohu, je rovnaká, ako verzia, ktorú pou¾ívate teraz! Inak obnova nebude fungova».');
define('_RESTORE_INTRO',			'Tu vyberte súbor so zálohou (bude nahraný na server) a kliknite na tlaèítko "Obnovi»" pre zahájenie akcie.');
define('_RESTORE_IMSURE',			'Áno, som si istý, ¾e to chcem urobi»!');
define('_RESTORE_BTN',				'Obnovi» zo súboru');
define('_RESTORE_WARNING',			'(uistite sa, ¾e obnovujete správnu zálohu, prípadnì si najprv zazálohujte teraj¹ie dáta)');
define('_ERROR_BACKUP_NOTSURE',		'Musíte za¹krtnú» políèko \'Som si istý\'');
define('_RESTORE_COMPLETE',			'Obnova bola dokonèená');

// new item notification
define('_NOTIFY_NI_MSG',			'Bol publikovaný nový èlánok:');
define('_NOTIFY_NI_TITLE',			'Nový èlánok!');
define('_NOTIFY_KV_MSG',			'Karma voµba pri èlánku:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'Komentár k èlánku:');
define('_NOTIFY_NC_TITLE',			'Nucleus komentár:');
define('_NOTIFY_USERID',			'ID u¾ívateµa:');
define('_NOTIFY_USER',				'U¾ívateµ:');
define('_NOTIFY_COMMENT',			'Komentár:');
define('_NOTIFY_VOTE',				'Voµba:');
define('_NOTIFY_HOST',				'Server:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'Èlen:');
define('_NOTIFY_TITLE',				'Nadpis:');
define('_NOTIFY_CONTENTS',			'Text:');

// member mail message
define('_MMAIL_MSG',				'Obdr¾al ste novú správu od');
define('_MMAIL_FROMANON',			'anonymného náv¹tìvníka');
define('_MMAIL_FROMNUC',			'Odoslané v systéme Nucleus weblog v');
define('_MMAIL_TITLE',				'Správa od');
define('_MMAIL_MAIL',				'Správa:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'Prida» èlánok');
define('_BMLET_EDIT',				'Upravi» èlánok');
define('_BMLET_DELETE',				'Odstráni» èlánok');
define('_BMLET_BODY',				'Text');
define('_BMLET_MORE',				'Roz¹írený text');
define('_BMLET_OPTIONS',			'Volby');
define('_BMLET_PREVIEW',			'Náhµad');

// used in bookmarklet
define('_ITEM_UPDATED',				'Èlánok bol upravený');
define('_ITEM_DELETED',				'Èlánok bol odstránený');

// plugins
define('_CONFIRMTXT_PLUGIN',		'Skutoène chcete odstráni» plugin');
define('_ERROR_NOSUCHPLUGIN',		'Taký plugin neexistuje');
define('_ERROR_DUPPLUGIN',			'Tento plugin u¾ bol nain¹talovaný');
define('_ERROR_PLUGFILEERROR',		'Plugin neexistuje, alebo sú zle nastavené prístupové práva');
define('_PLUGS_NOCANDIDATES',		'®iadne pluginy neboli nájdené');

define('_PLUGS_TITLE_MANAGE',		'Správa pluginov');
define('_PLUGS_TITLE_INSTALLED',	'Momentálne nain¹talované');
define('_PLUGS_TITLE_UPDATE',		'Aktualizova» zoznam odberov');
define('_PLUGS_TEXT_UPDATE',		'Nucleus si udr¾uje databázu odberov udalostí pre pluginy. Ak nahráte novú verziu pluginu, mali by ste spusti» túto aktualizáciu, aby boli odbery obnovené.');
define('_PLUGS_TITLE_NEW',			'Nain¹talova» nový plugin');
define('_PLUGS_ADD_TEXT',			'Dole vidíte zoznam súborov z adresára pluginov, ktoré asi sú  nenain¹talované pluginy. Pred ich nain¹talovaním sa uistite, ¾e to sú <strong>urèite</strong> pluginy.');
define('_PLUGS_BTN_INSTALL',		'Nain¹talova» plugin');
define('_BACKTOOVERVIEW',			'Spä» na prehµad');

// editlink
define('_TEMPLATE_EDITLINK',		'Odkaz na editáciu èlánku');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'Prida» rámèek vµavo');
define('_ADD_RIGHT_TT',				'Prida» rámèek vpravo');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'Nová kategória...');

// new settings
define('_SETTINGS_PLUGINURL',		'URL s pluginmi');
define('_SETTINGS_MAXUPLOADSIZE',	'Max. veµkos» súboru pre nahranie (bytes)');
define('_SETTINGS_NONMEMBERMSGS',	'Povoli» neregistrovaným posiela» aprávy');
define('_SETTINGS_PROTECTMEMNAMES',	'Chráni» mená èlenov');

// overview screen
define('_OVERVIEW_PLUGINS',			'Správa pluginov...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'Registrácia nového èlena:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'Va¹a emailová adresa:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'Nemáte správcovské práva pre ¾iadny z blogov, ktoré majú príjemcu vo svojom tíme. Preto nesmiete nahráva» súbory do adresára tetjo osoby.');

// plugin list
define('_LISTS_INFO',				'Informácie');
define('_LIST_PLUGS_AUTHOR',		'Od:');
define('_LIST_PLUGS_VER',			'Verzia:');
define('_LIST_PLUGS_SITE',			'Nav¹tívi» stránku');
define('_LIST_PLUGS_DESC',			'Popis:');
define('_LIST_PLUGS_SUBS',			'Odberate» týchto udalostí:');
define('_LIST_PLUGS_UP',			'nahor');
define('_LIST_PLUGS_DOWN',			'nadol');
define('_LIST_PLUGS_UNINSTALL',		'odin¹talova»');
define('_LIST_PLUGS_ADMIN',			'správca');
define('_LIST_PLUGS_OPTIONS',		'upravi»&nbsp;nastavenie');

// plugin option list
define('_LISTS_VALUE',				'Hodnota');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'tento plugin nemá ¾iadne nastavenia');
define('_PLUGS_BACK',				'Spä» na prehµad pluginov');
define('_PLUGS_SAVE',				'Ulo¾i» nastavenia');
define('_PLUGS_OPTIONS_UPDATED',	'Nastavenia pluginu boli upravené');

define('_OVERVIEW_MANAGEMENT',		'Správa');
define('_OVERVIEW_MANAGE',			'Správa Nucleusu...');
define('_MANAGE_GENERAL',			'V¹eobecné nastavenia');
define('_MANAGE_SKINS',				'Vzhµad a ¹ablóny');
define('_MANAGE_EXTRA',				'Extra voµby');

define('_BACKTOMANAGE',				'Spä» na správu Nucleusu');


// END introduced after v1.1 END




// charset to use 
define('_CHARSET',					'ISO-8859-2');

// global stuff
define('_LOGOUT',					'Odhlási» sa');
define('_LOGIN',					'Prihlási» sa');
define('_YES',						'Áno');
define('_NO',						'Nie');
define('_SUBMIT',					'Odosla»');
define('_ERROR',					'Chyba');
define('_ERRORMSG',					'Vyskytla se chyba!');
define('_BACK',						'Spä»');
define('_NOTLOGGEDIN',				'Nie ste prihlásení');
define('_LOGGEDINAS',				'Prihlásený ako');
define('_ADMINHOME',				'Správca');
define('_NAME',						'Meno');
define('_BACKHOME',					'Spä» na správcovskú stránku');
define('_BADACTION',				'Bola po¾adovaná neexistujúca akcia');
define('_MESSAGE',					'Správa');
define('_HELP_TT',					'Pomoc!');
define('_YOURSITE',					'Va¹a stránka');


define('_POPUP_CLOSE',				'Zatvori» okno');

define('_LOGIN_PLEASE',				'Prosím, najprv sa prihláste');

// commentform
define('_COMMENTFORM_YOUARE',		'Ste');
define('_COMMENTFORM_SUBMIT',		'Prida» komentár');
define('_COMMENTFORM_COMMENT',		'Vá¹ komentár');
define('_COMMENTFORM_NAME',			'Meno');
define('_COMMENTFORM_MAIL',			'E-mail/HTTP');
define('_COMMENTFORM_REMEMBER',		'Pamätaj si mna');

// loginform
define('_LOGINFORM_NAME',			'Meno');
define('_LOGINFORM_PWD',			'Heslo');
define('_LOGINFORM_YOUARE',			'Prihlásený ako');
define('_LOGINFORM_SHARED',			'Neuklada» údaje');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'Poslat správu');

// search form
define('_SEARCHFORM_SUBMIT',		'Hµadanie');

// add item form
define('_ADD_ADDTO',				'Prida» nový èlánok do');
define('_ADD_CREATENEW',			'Vytvori» nový èlánok');
define('_ADD_BODY',					'Perex');
define('_ADD_TITLE',				'Nadpis');
define('_ADD_MORE',					'Celý èlánok');
define('_ADD_CATEGORY',				'Kategória');
define('_ADD_PREVIEW',				'Náhµad');
define('_ADD_DISABLE_COMMENTS',		'Zakáza» komentáre?');
define('_ADD_DRAFTNFUTURE',			'Koncepty a èlánky pre neskor¹ie publikovanie');
define('_ADD_ADDITEM',				'Prida» èlánok');
define('_ADD_ADDNOW',				'Prida» teraz');
define('_ADD_ADDLATER',				'Prida» neskôr');
define('_ADD_PLACE_ON',				'Umiestni» na');
define('_ADD_ADDDRAFT',				'Prida» medzi koncepty');
define('_ADD_NOPASTDATES',			'(dátumy a èasy v minulosti NIE SÚ platné, v tom prípade bude pou¾itý aktuálny èas)');
define('_ADD_BOLD_TT',				'Tuèné');
define('_ADD_ITALIC_TT',			'Kurzíva');
define('_ADD_HREF_TT',				'Vytvori» odkaz');
define('_ADD_MEDIA_TT',				'Prida» obrázok');
define('_ADD_PREVIEW_TT',			'Zobrazi»/skry» náhµad');
define('_ADD_CUT_TT',				'Vybra»');
define('_ADD_COPY_TT',				'Kopírova»');
define('_ADD_PASTE_TT',				'Vlo¾it');


// edit item form
define('_EDIT_ITEM',				'Upravi» èlánok');
define('_EDIT_SUBMIT',				'Upravi» èlánok');
define('_EDIT_ORIG_AUTHOR',			'Pôvodný autor');
define('_EDIT_BACKTODRAFTS',		'Prida» spä» medzi koncepty');
define('_EDIT_COMMENTSNOTE',		'(poznámka: zakázanie komentárov _neskryje_ skôr pridané komentáre)');

// used on delete screens
define('_DELETE_CONFIRM',			'Prosím, potvrïte odstranenie');
define('_DELETE_CONFIRM_BTN',		'Potvrdenie odstranenia');
define('_CONFIRMTXT_ITEM',			'Chystáte sa odstráni» nasledujúcí èlánok:');
define('_CONFIRMTXT_COMMENT',		'Chystáte sa odstráni» následujúcí komentár:');
define('_CONFIRMTXT_TEAM1',			'Chystáte sa odstráni» u¾ivateµa ');
define('_CONFIRMTXT_TEAM2',			' z tímu pre blog ');
define('_CONFIRMTXT_BLOG',			'Blog, ktorý sa chystáte odstráni», je: ');
define('_WARNINGTXT_BLOGDEL',		'Pozor! Odstránením blogu dojde k vymazaniu V©ETKÝCH èlánkov tohoto blogu a v¹etkých komentárov. Prosím, potvrïte, ¾e to NAOZAJ chcete urobi»!<br />Behom odstraòovania blogu nepreru¹ujte Nucleus.');
define('_CONFIRMTXT_MEMBER',		'Chystáte sa odstráni» profil následujúceho èlena: ');
define('_CONFIRMTXT_TEMPLATE',		'Chystáte se odstráni» ¹ablónu ');
define('_CONFIRMTXT_SKIN',			'Chystáte sa odstráni» vzhµad ');
define('_CONFIRMTXT_BAN',			'Chystáte sa odstráni» obmedzenie prístupu pre ip adresy');
define('_CONFIRMTXT_CATEGORY',		'Chystáte sa odstráni» kategóriu ');

// some status messages
define('_DELETED_ITEM',				'Èlánok odstránený');
define('_DELETED_MEMBER',			'Reg. u¾ívateµ odstráný');
define('_DELETED_COMMENT',			'Komentáø odstranìn');
define('_DELETED_BLOG',				'Blog odstránený');
define('_DELETED_CATEGORY',			'Kategória odstránená');
define('_ITEM_MOVED',				'Èlánok presunutý');
define('_ITEM_ADDED',				'Èlánok pridaný');
define('_COMMENT_UPDATED',			'Komentár upravený');
define('_SKIN_UPDATED',				'Vzhµad bol ulo¾ený');
define('_TEMPLATE_UPDATED',			'©ablóna bola ulo¾ená');

// errors
define('_ERROR_COMMENT_LONGWORD',	'Prosím, v komentároch nepou¾ívajte slová dlh¹ie ne¾ 90 znakov');
define('_ERROR_COMMENT_NOCOMMENT',	'Prosím, vlo¾te komentár');
define('_ERROR_COMMENT_NOUSERNAME',	'Neplatné u¾ivateµské meno');
define('_ERROR_COMMENT_TOOLONG',	'Vá¹ komentár je príli¹ dlhý (max. 5000 znakov)');
define('_ERROR_COMMENTS_DISABLED',	'Komentáre pre tento blog sú momentálne zakázané.');
define('_ERROR_COMMENTS_NONPUBLIC',	'Aby ste mohli pridáva» komentáre do tohoto blogu, musíte by» prihlásení');
define('_ERROR_COMMENTS_MEMBERNICK','Meno, pod ktorým chcete odoslat komentár, pou¾íva iný registrovaný u¾ivateµ. Pou¾ite nejaké iné.');
define('_ERROR_SKIN',				'Chyba v definícii vzhµadu');
define('_ERROR_ITEMCLOSED',			'Tento èlánok bol uzatvorený. U¾ nie je mo¾né k nemu pridáva» komentáre ani hlasova»');
define('_ERROR_NOSUCHITEM',			'Èlánok nenájdený');
define('_ERROR_NOSUCHBLOG',			'Blog nenájdený');
define('_ERROR_NOSUCHSKIN',			'Vzhµad nenájdený');
define('_ERROR_NOSUCHMEMBER',		'Registrovaný u¾ívateµ nenájdený');
define('_ERROR_NOTONTEAM',			'Nie ste èlenom tímu tohto blogu');
define('_ERROR_BADDESTBLOG',		'Cieµový blog neexistuje');
define('_ERROR_NOTONDESTTEAM',		'Nie je mo¾né presunú» èlánok, preto¾e nie ste èlenom tímu cieµového blogu');
define('_ERROR_NOEMPTYITEMS',		'Nie je mo¾né prida» prázdny èlánok!');
define('_ERROR_BADMAILADDRESS',		'Emailová adresa nie je platná');
define('_ERROR_BADNOTIFY',			'Jedna alebo viac z udaných adries pre oznamovanie nie je platná emailová adresa');
define('_ERROR_BADNAME',			'Meno nie je platné (sú dovolené iba znaky a-z a 0-9, ¾iadne medzery na zaèiatku a na konci)');
define('_ERROR_NICKNAMEINUSE',		'Túto prezývku u¾ pou¾íva iný registrovaný èlen');
define('_ERROR_PASSWORDMISMATCH',	'Heslá musia by» rovnaké');
define('_ERROR_PASSWORDTOOSHORT',	'Heslo by malo ma» aspoò 6 znakov');
define('_ERROR_PASSWORDMISSING',	'Heslo nesmie by» prázdne');
define('_ERROR_REALNAMEMISSING',	'Musíte vlo¾i» skutoèné meno');
define('_ERROR_ATLEASTONEADMIN',	'Mal by by» v¾dy aspoò jeden super-správca, ktorý ss mô¾e prihlási» do správcovskej sekcie.');
define('_ERROR_ATLEASTONEBLOGADMIN','Vykonsnie tejto akcie by spôsobilo, ¾e by vá¹ blog nemal kto spravova».  Uistite sa, ¾e v¾dy existuje aspoò jeden správca.');
define('_ERROR_ALREADYONTEAM',		'Nemô¾ete prida» u¾ívateµa, ktorý u¾ je èlenom tímu');
define('_ERROR_BADSHORTBLOGNAME',	'Krátke meno blogu by malo obsahova» len znaky a-z a 0-9, bez medzier');
define('_ERROR_DUPSHORTBLOGNAME',	'Toto krátke meno u¾ pou¾íva iný blog. Tieto mená musia by» unikátne.');
define('_ERROR_UPDATEFILE',			'Nie je mo¾né zapisova» do update-souboru. Uistite sa, ¾e sú správne nastavené prístupové práva (skúste chmod 666). Tie¾ pozor na to, ¾e umiestnenie je relatívne k adresáru správcovskej oblasti, tak¾e by ste mohli skúsi» absolútnu cestu (nieèo ako /your/path/to/nucleus/)');
define('_ERROR_DELDEFBLOG',			'Nie je mo¾né odstráni» prednastavený blog');
define('_ERROR_DELETEMEMBER',		'Tento u¾ívateµ nemô¾e by» odstránený. Pravdepodobne preto, proto¾e je autorom nejakých èlánkov, alebo komentárov.');
define('_ERROR_BADTEMPLATENAME',	'Neplatné meno ¹ablóny. Pou¾ite iba znaky a-z a 0-9, ¾iadne medzery.');
define('_ERROR_DUPTEMPLATENAME',	'U¾ existuje ¹ablóna s týmto názvom.');
define('_ERROR_BADSKINNAME',		'Neplatné meno vzhµadu (pou¾ite iba znaky a-z a 0-9, ¾iadne medzery)');
define('_ERROR_DUPSKINNAME',		'U¾ existuje vzhµad s týmto názvom.');
define('_ERROR_DEFAULTSKIN',		'Vzhµad s názvom "default" musí by» v¾dy dostupný.');
define('_ERROR_SKINDEFDELETE',		'Nie je mo¾né odstráni» vzhµad, preto¾e je to ¹tandardný vzhµad pre nssledujúci blog: ');
define('_ERROR_DISALLOWED',			'Prepáète, ale nie ste oprávnení k tejto akci.');
define('_ERROR_DELETEBAN',			'Chyba pri odstraòovaní obmedzenia pøístupu (obmedzenie prístupu neexistuje)');
define('_ERROR_ADDBAN',				'Chyba pri pridávaní obmedzenia prístupu. Obmedzenie prístupu asi nebolo korektne pridané do v¹etkých blogov.');
define('_ERROR_BADACTION',			'Po¾adovaná akcia neexistuje');
define('_ERROR_MEMBERMAILDISABLED',	'Mailové správy medzi èlenmi sú zakázané.');
define('_ERROR_MEMBERCREATEDISABLED','Vytváranie u¾ívateµských kont je zakázané.');
define('_ERROR_INCORRECTEMAIL',		'Neplatná mailová adresa');
define('_ERROR_VOTEDBEFORE',		'Pre tento èlánok u¾ ste hlasovali');
define('_ERROR_BANNED1',			'Akciu nie je mo¾né vykona», proto¾e vám (rozsah adries ');
define('_ERROR_BANNED2',			') byl obmedzený prístup. Správa bola: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'Aby ste mohli vykona» túto akciu, musíte sa prihlási».');
define('_ERROR_CONNECT',			'Chyba spojenia');
define('_ERROR_FILE_TOO_BIG',		'Súbor je príli¹ veµký!');
define('_ERROR_BADFILETYPE',		'Prepáète, ale tento typ súboru nie je povolený.');
define('_ERROR_BADREQUEST',			'Neplatný po¾iadavok pre nahranie súboru');
define('_ERROR_DISALLOWEDUPLOAD',	'Nie ste èlenom tímu ¾iadneho blogu, a preto nemô¾ete nahráva» súbory.');
define('_ERROR_BADPERMISSIONS',		'Práva pre súbor/adresár nie sú správne nastavené');
define('_ERROR_UPLOADMOVEP',		'Chyba pri presune nahraného súboru');
define('_ERROR_UPLOADCOPY',			'Chyba pri kopírovaní súboru');
define('_ERROR_UPLOADDUPLICATE',	'Súbor s týmto názvom u¾ existuje. Pred nahraním ho skúste premenova».');
define('_ERROR_LOGINDISALLOWED',	'Prepáète, ale nemô¾ete sa prihlási» do správcovskej oblasti. Av¹ak mô¾ete sa prihlási» ako iný u¾ívateµ.');
define('_ERROR_DBCONNECT',			'Nie je mo¾né pripoji» sa k mySQL serveru');
define('_ERROR_DBSELECT',			'Nie je mo¾né vybra» databázu nucleus.');
define('_ERROR_NOSUCHLANGUAGE',		'Tento jazykový súbor neexistuje');
define('_ERROR_NOSUCHCATEGORY',		'Taká kategória neexistuje');
define('_ERROR_DELETELASTCATEGORY',	'Musí existova» aspoò jedna kategória');
define('_ERROR_DELETEDEFCATEGORY',	'Nie je mo¾né odstráni» defaultnú kategóriu');
define('_ERROR_BADCATEGORYNAME',	'Neplatný názov kategória');
define('_ERROR_DUPCATEGORYNAME',	'Kategória s týmto názvom u¾ existuje');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'Pozor: Aktuálna hodnota nie je adresár!');
define('_WARNING_NOTREADABLE',		'Pozor: Aktuálna hodnota nie je adresár na èítanie!');
define('_WARNING_NOTWRITABLE',		'Pozor: Aktuálna hodnota NIE JE adresár, do ktorého sa dá zapisova»!');

// media and upload
define('_MEDIA_UPLOADLINK',			'Nahra» nový súbor');
define('_MEDIA_MODIFIED',			'modifikovaný');
define('_MEDIA_FILENAME',			'názov súboru');
define('_MEDIA_DIMENSIONS',			'rozmery');
define('_MEDIA_INLINE',				'Vo vnútri');
define('_MEDIA_POPUP',				'Okno');
define('_UPLOAD_TITLE',				'Zvoµte súbor');
define('_UPLOAD_MSG',				'Vyberte súbor pre nahratie, a potom stlaète tlaèítko \'Nahra»\'.');
define('_UPLOAD_BUTTON',			'Nahra»');

// some status messages
define('_MSG_ACCOUNTCREATED',		'Úèet bol vytvorený. Heslo obdr¾íte e-mailom.');
define('_MSG_PASSWORDSENT',			'Heslo vám bolo odoslané e-mailom.');
define('_MSG_LOGINAGAIN',			'Budete sa musie» znova prihlási», preto¾e va¹e údaje boli zmenené.');
define('_MSG_SETTINGSCHANGED',		'Nastavenia zmenené');
define('_MSG_ADMINCHANGED',			'Správca zmenený');
define('_MSG_NEWBLOG',				'Nový blog bol vytvorený');
define('_MSG_ACTIONLOGCLEARED',		'Log akcií bol zmazaný');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'Nepovolená akcia: ');
define('_ACTIONLOG_PWDREMINDERSENT','Odoslané nové heslo pre ');
define('_ACTIONLOG_TITLE',			'Log akcií');
define('_ACTIONLOG_CLEAR_TITLE',	'Zmaza» log akcií');
define('_ACTIONLOG_CLEAR_TEXT',		'Vymaza» log akcií');

// team management
define('_TEAM_TITLE',				'Správa tímu pre blog ');
define('_TEAM_CURRENT',				'Aktuálny tím');
define('_TEAM_ADDNEW',				'Prida» èlena do tímu');
define('_TEAM_CHOOSEMEMBER',		'Zvoµte èlena');
define('_TEAM_ADMIN',				'Správcovské práva? ');
define('_TEAM_ADD',					'Prida» do tímu');
define('_TEAM_ADD_BTN',				'Prida» do tímu');

// blogsettings
define('_EBLOG_TITLE',				'Upravi» nastavenie blogu');
define('_EBLOG_TEAM_TITLE',			'Upravi» tím');
define('_EBLOG_TEAM_TEXT',			'Kliknite tu pre úpravu tímu...');
define('_EBLOG_SETTINGS_TITLE',		'Nastavenie blogu');
define('_EBLOG_NAME',				'Meno blogu');
define('_EBLOG_SHORTNAME',			'Krátke meno blogu');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(iba znaky a-z bez medzier)');
define('_EBLOG_DESC',				'Popis blogu');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'©tandardný vzhµad');
define('_EBLOG_DEFCAT',				'¹tandardná kategória');
define('_EBLOG_LINEBREAKS',			'Odriadkováva»');
define('_EBLOG_DISABLECOMMENTS',	'Povoli» komentáre?<br /><small>(Urèuje, èi je mo¾né pridáva» komentáre)</small>');
define('_EBLOG_ANONYMOUS',			'Povoli» komentáre od neregistrovaných náv¹tìvníkov?');
define('_EBLOG_NOTIFY',				'Adresa/adresy pre oznamovanie (pou¾ite ; ako oddeµovaè)');
define('_EBLOG_NOTIFY_ON',			'Oznamova» zaslanie');
define('_EBLOG_NOTIFY_COMMENT',		'Nových komentárov');
define('_EBLOG_NOTIFY_KARMA',		'Nových karma hlasov');
define('_EBLOG_NOTIFY_ITEM',		'Nových èlánkov blogu');
define('_EBLOG_PING',				'Ping na Weblogs.com pri zmenách?');
define('_EBLOG_MAXCOMMENTS',		'Maximálny poèet komentárov');
define('_EBLOG_UPDATE',				'Zapísa» zmeny do súboru');
define('_EBLOG_OFFSET',				'Èasový posun');
define('_EBLOG_STIME',				'Aktuálny èas serveru je');
define('_EBLOG_BTIME',				'Aktuálny èas blogu je');
define('_EBLOG_CHANGE',				'Zmeni» nastavenie');
define('_EBLOG_CHANGE_BTN',			'Zmìnit nastavení');
define('_EBLOG_ADMIN',				'Správca blogu');
define('_EBLOG_ADMIN_MSG',			'Obdr¾íte správcovské práva');
define('_EBLOG_CREATE_TITLE',		'Vytvori» nový blog');
define('_EBLOG_CREATE_TEXT',		'Pre vytvorenie nového blogu vyplòte nasledujúcí formulár. <br /><br /> <b>Poznámka:</b> Sú tu vypísané iba najnutnej¹ie voµby. Ak chcete zmìnit daµ¹ie nastavenia, po vytvorení blogu nav¹tivte stránku s vlastnos»ami blogu.');
define('_EBLOG_CREATE',				'Vytvori»!');
define('_EBLOG_CREATE_BTN',			'Vytvori» blog');
define('_EBLOG_CAT_TITLE',			'Kategória');
define('_EBLOG_CAT_NAME',			'Názov kategórie');
define('_EBLOG_CAT_DESC',			'Popis kategórie');
define('_EBLOG_CAT_CREATE',			'Vytvori» novú kategóriu');
define('_EBLOG_CAT_UPDATE',			'Upravi» kategóriu');
define('_EBLOG_CAT_UPDATE_BTN',		'Upravi» kategóriu');

// templates
define('_TEMPLATE_TITLE',			'Upravi» ¹ablóny');
define('_TEMPLATE_AVAILABLE_TITLE',	'Dostupné ¹ablóny');
define('_TEMPLATE_NEW_TITLE',		'Nová ¹ablóna');
define('_TEMPLATE_NAME',			'Názov ¹ablóny');
define('_TEMPLATE_DESC',			'Popis ¹ablóny');
define('_TEMPLATE_CREATE',			'Vytvori» ¹ablónu');
define('_TEMPLATE_CREATE_BTN',		'Vytvori» ¹ablónu');
define('_TEMPLATE_EDIT_TITLE',		'Upravi» ¹ablónu');
define('_TEMPLATE_BACK',			'Spä» na prehµad ¹ablón');
define('_TEMPLATE_EDIT_MSG',		'Nie v¹etky èasti ¹ablóny sú vy¾adované. Nepotrebné èasti nechajte prázdne.');
define('_TEMPLATE_SETTINGS',		'Nastavenie ¹ablóny');
define('_TEMPLATE_ITEMS',			'Èlánky');
define('_TEMPLATE_ITEMHEADER',		'Hlavièka èlánku');
define('_TEMPLATE_ITEMBODY',		'Telo èlánku');
define('_TEMPLATE_ITEMFOOTER',		'Pätièka èlánku');
define('_TEMPLATE_MORELINK',		'Odkaz na roz¹irujúcí text');
define('_TEMPLATE_NEW',				'Oznaèenie nového èlánku');
define('_TEMPLATE_COMMENTS_ANY',	'Komentáre (ak sú)');
define('_TEMPLATE_CHEADER',			'Hlavièka komentára');
define('_TEMPLATE_CBODY',			'Telo komentára');
define('_TEMPLATE_CFOOTER',			'Pätièka komentára');
define('_TEMPLATE_CONE',			'Jeden komentár');
define('_TEMPLATE_CMANY',			'Dva (a viac) komentárov');
define('_TEMPLATE_CMORE',			'\'Èíta» viac\' pri komentároch');
define('_TEMPLATE_CMEXTRA',			'Daµ¹ie údaje iba pre èlenov');
define('_TEMPLATE_COMMENTS_NONE',	'Komentáre (ak nejaké sú)');
define('_TEMPLATE_CNONE',			'®iadne komentáre');
define('_TEMPLATE_COMMENTS_TOOMUCH','Komentáre (pokia» sú, ale je ich viac, ne¾ sa dá zobrazi» priamo)');
define('_TEMPLATE_CTOOMUCH',		'Príli¹ mnoho komentárov');
define('_TEMPLATE_ARCHIVELIST',		'Zeznam archívov');
define('_TEMPLATE_AHEADER',			'Hlavièka zoznamu archívov');
define('_TEMPLATE_AITEM',			'Polo¾ka zoznamu archívov');
define('_TEMPLATE_AFOOTER',			'Pätièka zoznamu archívov');
define('_TEMPLATE_DATETIME',		'Dátum a èas');
define('_TEMPLATE_DHEADER',			'Hlavièka dátumu');
define('_TEMPLATE_DFOOTER',			'Pätièka dátumu');
define('_TEMPLATE_DFORMAT',			'Formát dátumu');
define('_TEMPLATE_TFORMAT',			'Formát èasu');
define('_TEMPLATE_LOCALE',			'Miestne nastavenie');
define('_TEMPLATE_IMAGE',			'Okna s obrázkom');
define('_TEMPLATE_PCODE',			'Kód odkazu pre okná s obrázkom');
define('_TEMPLATE_ICODE',			'Kód pro vlo¾ný obrázok');
define('_TEMPLATE_MCODE',			'Kód odkazu na soubor médií');
define('_TEMPLATE_SEARCH',			'Hµadanie');
define('_TEMPLATE_SHIGHLIGHT',		'Zvýraznenie');
define('_TEMPLATE_SNOTFOUND',		'Pri hµadaní nebolo niè nájdené');
define('_TEMPLATE_UPDATE',			'Upravi»');
define('_TEMPLATE_UPDATE_BTN',		'Upravi» ¹ablónu');
define('_TEMPLATE_RESET_BTN',		'Pôvodné dáta');
define('_TEMPLATE_CATEGORYLIST',	'Zoznamy kategórií');
define('_TEMPLATE_CATHEADER',		'Hlavièka zoznamu kategórií');
define('_TEMPLATE_CATITEM',			'Polo¾ka zoznamu kategórií');
define('_TEMPLATE_CATFOOTER',		'Pätièka zoznamu kategórií');

// skins
define('_SKIN_EDIT_TITLE',			'Upravi» vzhµady');
define('_SKIN_AVAILABLE_TITLE',		'Dostupné vzhµady');
define('_SKIN_NEW_TITLE',			'Nový vzhµad');
define('_SKIN_NAME',				'Názov');
define('_SKIN_DESC',				'Popis');
define('_SKIN_TYPE',				'Typ obsahu');
define('_SKIN_CREATE',				'Vytvori»');
define('_SKIN_CREATE_BTN',			'Vytvori» vzhµad');
define('_SKIN_EDITONE_TITLE',		'Upravi» vzhµad');
define('_SKIN_BACK',				'Spä» na prehµad vzhµadov');
define('_SKIN_PARTS_TITLE',			'Èasti vzhµadu');
define('_SKIN_PARTS_MSG',			'Pre ka¾dý vzhµad nie sú potrebné v¹etky typy. Tie, ktoré nepotrebujete, nechajte prázdne. Zvoµte typ vzhµadu, ktorý chcete upravi»::');
define('_SKIN_PART_MAIN',			'Hlavný prehµad');
define('_SKIN_PART_ITEM',			'Stránky èlánkov');
define('_SKIN_PART_ALIST',			'Zoznam archívov');
define('_SKIN_PART_ARCHIVE',		'Archív');
define('_SKIN_PART_SEARCH',			'Hµadanie');
define('_SKIN_PART_ERROR',			'Chyby');
define('_SKIN_PART_MEMBER',			'Detaily reg. u¾ívateµa');
define('_SKIN_PART_POPUP',			'Okna s obrázkom');
define('_SKIN_GENSETTINGS_TITLE',	'V¹eobecné nastavenia');
define('_SKIN_CHANGE',				'Zmeni»');
define('_SKIN_CHANGE_BTN',			'Zmeni» tieto nastavenia');
define('_SKIN_UPDATE_BTN',			'Uloµi» vzhµad');
define('_SKIN_RESET_BTN',			'Pôvodné dáta');
define('_SKIN_EDITPART_TITLE',		'Upravi» vzhµad');
define('_SKIN_GOBACK',				'Spä»');
define('_SKIN_ALLOWEDVARS',			'Dostupné premenné (kliknite pre bli¾¹ie informácie):');

// global settings
define('_SETTINGS_TITLE',			'V¹eobecné nastavenia');
define('_SETTINGS_SUB_GENERAL',		'V¹eobecné nastavenia');
define('_SETTINGS_DEFBLOG',			'©tandardný blog');
define('_SETTINGS_ADMINMAIL',		'E-mail správcu');
define('_SETTINGS_SITENAME',		'Názov stránky');
define('_SETTINGS_SITEURL',			'URL stránky (malo by konèi» lomítkom)');
define('_SETTINGS_ADMINURL',		'URL správcovskej oblasti (malo by konèi» lomítkom)');
define('_SETTINGS_DIRS',			'AdresáreNucleusu');
define('_SETTINGS_MEDIADIR',		'Adresár s médiami');
define('_SETTINGS_SEECONFIGPHP',	'(viï config.php)');
define('_SETTINGS_MEDIAURL',		'URL médií (malo by konèi» lomítkom)');
define('_SETTINGS_ALLOWUPLOAD',		'Povoli» nahrávanie (upload) souborov?');
define('_SETTINGS_ALLOWUPLOADTYPES','Typy súborov, ktoré je mo¾né nahra»');
define('_SETTINGS_CHANGELOGIN',		'Povoli» registrovaným u¾ívateµom meni» meno/heslo');
define('_SETTINGS_COOKIES_TITLE',	'Nastavenie cookies');
define('_SETTINGS_COOKIELIFE',		'Doba ¾ivotnosti prihlasovacieho cookie');
define('_SETTINGS_COOKIESESSION',	'Jednorazové cookies (session)');
define('_SETTINGS_COOKIEMONTH',		'Mesiac');
define('_SETTINGS_COOKIEPATH',		'Cesta cookie (pokroèilé)');
define('_SETTINGS_COOKIEDOMAIN',	'Doména cookie (pokroèilé)');
define('_SETTINGS_COOKIESECURE',	'Zabezpeèené cookie (pokroèilé)');
define('_SETTINGS_LASTVISIT',		'Uklada» cookies poslednej náv¹tevy');
define('_SETTINGS_ALLOWCREATE',		'Povoli» náv¹tevníkom vytvori» si registrovaný úèet');
define('_SETTINGS_NEWLOGIN',		'Povoli» prihlásenie z úètov, vytvorených náv¹tevníkmi');
define('_SETTINGS_NEWLOGIN2',		'(iba pre novo vytvorené úèty)');
define('_SETTINGS_MEMBERMSGS',		'Povoli» slu¾by medzi èlenmi');
define('_SETTINGS_LANGUAGE',		'©tandardný jazyk');
define('_SETTINGS_DISABLESITE',		'Vypnú» stránku');
define('_SETTINGS_DBLOGIN',			'mySQL Login a Databáza');
define('_SETTINGS_UPDATE',			'Ulo¾i» nastavenia');
define('_SETTINGS_UPDATE_BTN',		'Ulo¾i» nastavenia');
define('_SETTINGS_DISABLEJS',		'Zakáza» JavaScript Toolbar');
define('_SETTINGS_MEDIA',			'Nastavenia pre média/nahrávánie súborov');
define('_SETTINGS_MEDIAPREFIX',		'Nahraným súborom prida» pred meno dátum');
define('_SETTINGS_MEMBERS',			'Nastavenie registrovaných u¾ívateµom');

// bans
define('_BAN_TITLE',				'Zoznam obmedzení prístupu pre');
define('_BAN_NONE',					'Tento blog nemá ¾iadne obmedzenia prístupu');
define('_BAN_NEW_TITLE',			'Pridat nové obmedzenie prístupu');
define('_BAN_NEW_TEXT',				'Prida» obmedzenie');
define('_BAN_REMOVE_TITLE',			'Odstráni» obmedzenie');
define('_BAN_IPRANGE',				'Rozsah IP adries');
define('_BAN_BLOGS',				'Ktoré blogy?');
define('_BAN_DELETE_TITLE',			'Odstráni» obmedzenie');
define('_BAN_ALLBLOGS',				'V¹etky blogy, ku ktorým máte správcovské práva.');
define('_BAN_REMOVED_TITLE',		'Obmedzenie prístupu bolo odstránené');
define('_BAN_REMOVED_TEXT',			'Bolo odstránené obmedzenie prístupu pre nasledujúce blogy:');
define('_BAN_ADD_TITLE',			'Prida» obmedzenie prístupu');
define('_BAN_IPRANGE_TEXT',			'Zadajte rozsah IP adries, ktoré chcete blokova». Èím men¹ie èísla, tým viac adries bude blokovaných.');
define('_BAN_BLOGS_TEXT',			'Mô¾ete zablokova» rozsah IP adries iba pre jeden blog, alebo pre v¹etky blogy, ku ktorým máte správcovské práva.');
define('_BAN_REASON_TITLE',			'Dôvod');
define('_BAN_REASON_TEXT',			'Mô¾ete zada» dôvod obmedzenia prístupu, ktorý bude zobrazený, ak sa vlastník blokovanej IP adresy pokúsi pridat komentár, alebo odosla» karma hlas. Maximálna då¾ka je 256 znakov.');
define('_BAN_ADD_BTN',				'Prida» obmedzenie');

// LOGIN screen
define('_LOGIN_MESSAGE',			'Správa');
define('_LOGIN_NAME',				'Meno');
define('_LOGIN_PASSWORD',			'Heslo');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'Zabudli ste heslo?');

// membermanagement
define('_MEMBERS_TITLE',			'Správa registrovaných u¾ívateµov');
define('_MEMBERS_CURRENT',			'Aktuálni u¾ívatelia');
define('_MEMBERS_NEW',				'Nový u¾ívateµ');
define('_MEMBERS_DISPLAY',			'Zobrazované meno');
define('_MEMBERS_DISPLAY_INFO',		'(Toto je meno, pod ktorým sa prihlasujete)');
define('_MEMBERS_REALNAME',			'Skutoèné meno');
define('_MEMBERS_PWD',				'Heslo');
define('_MEMBERS_REPPWD',			'Zopakova» heslo');
define('_MEMBERS_EMAIL',			'E-mailová adresa');
define('_MEMBERS_EMAIL_EDIT',		'(Ak zmeníte e-mailovú adresu, bude vám na òu automaticky odoslané nové heslo)');
define('_MEMBERS_URL',				'Adresa webovej stránky (URL)');
define('_MEMBERS_SUPERADMIN',		'Správcovské práva');
define('_MEMBERS_CANLOGIN',			'Mô¾e sa prihlási» do správcovskej oblasti');
define('_MEMBERS_NOTES',			'Poznámky');
define('_MEMBERS_NEW_BTN',			'Prida» u¾ívatele');
define('_MEMBERS_EDIT',				'Upravi» u¾ívateµa');
define('_MEMBERS_EDIT_BTN',			'Ulo¾i» nastavenia');
define('_MEMBERS_BACKTOOVERVIEW',	'Spä» na prehµad u¾ívateµov');
define('_MEMBERS_DEFLANG',			'Jazyk');
define('_MEMBERS_USESITELANG',		'- ¹tandardný jazyk stránky -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'Nav¹tívi» stránku');
define('_BLOGLIST_ADD',				'Prida» èlánok');
define('_BLOGLIST_TT_ADD',			'Prida» nový èlánok do tohto blogu');
define('_BLOGLIST_EDIT',			'Upravi»/odstráni» èlánky');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Bookmarklet');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'Nastavenia');
define('_BLOGLIST_TT_SETTINGS',		'Upravi» nastavenia alebo spravova» tím');
define('_BLOGLIST_BANS',			'Obmedzenie prístupu');
define('_BLOGLIST_TT_BANS',			'Zobrazi», prida» alebo odstráni» blokované IP adresy');
define('_BLOGLIST_DELETE',			'Odstráni» v¹etko');
define('_BLOGLIST_TT_DELETE',		'Odstráni» tento blog');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'Sekcia hulan.info');
define('_OVERVIEW_YRDRAFTS',		'Va¹e koncepty');
define('_OVERVIEW_YRSETTINGS',		'Va¹e nastavenia');
define('_OVERVIEW_GSETTINGS',		'V¹eobecné nastavenia');
define('_OVERVIEW_NOBLOGS',			'Nie ste èlenom tímu ¾iadneho z blogov');
define('_OVERVIEW_NODRAFTS',		'®iadne koncepty');
define('_OVERVIEW_EDITSETTINGS',	'Upravi» va¹e nastavenia...');
define('_OVERVIEW_BROWSEITEMS',		'Prezera» va¹e èlánky...');
define('_OVERVIEW_BROWSECOMM',		'Prezera» va¹e komentáre...');
define('_OVERVIEW_VIEWLOG',			'Prezera» zoznam akcií...');
define('_OVERVIEW_MEMBERS',			'Správa reg. u¾ívateµov...');
define('_OVERVIEW_NEWLOG',			'Vytvori» nový blog...');
define('_OVERVIEW_SETTINGS',		'Upravi» nastavenia...');
define('_OVERVIEW_TEMPLATES',		'Upravi» ¹ablóny...');
define('_OVERVIEW_SKINS',			'Upravi» vzhµady...');
define('_OVERVIEW_BACKUP',			'Záloha/obnova...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'Èlánky pre blog'); 
define('_ITEMLIST_YOUR',			'Va¹e èlánky');

// Comments
define('_COMMENTS',					'Komentáre');
define('_NOCOMMENTS',				'Tento èlánok nemá ¾iadne komentáre');
define('_COMMENTS_YOUR',			'Va¹e komentáre');
define('_NOCOMMENTS_YOUR',			'Nenapísal ste ¾iadne komentáre');

// LISTS (general)
define('_LISTS_NOMORE',				'®iadne daµ¹ie alebo vôbec ¾iadne výsledky');
define('_LISTS_PREV',				'Predo¹lé');
define('_LISTS_NEXT',				'Daµ¹ie');
define('_LISTS_SEARCH',				'Hµada»');
define('_LISTS_CHANGE',				'Zmeni»');
define('_LISTS_PERPAGE',			'èlánkov/strana');
define('_LISTS_ACTIONS',			'Akcia');
define('_LISTS_DELETE',				'Odstráni»');
define('_LISTS_EDIT',				'Upravi»');
define('_LISTS_MOVE',				'Presunú»');
define('_LISTS_CLONE',				'Skopírova»');
define('_LISTS_TITLE',				'Titulok');
define('_LISTS_BLOG',				'Blog');
define('_LISTS_NAME',				'Názov');
define('_LISTS_DESC',				'Popis');
define('_LISTS_TIME',				'Èas');
define('_LISTS_COMMENTS',			'Komentáre');
define('_LISTS_TYPE',				'Typ');


// member list 
define('_LIST_MEMBER_NAME',			'Zobrazované meno');
define('_LIST_MEMBER_RNAME',		'Skutoèné meno');
define('_LIST_MEMBER_ADMIN',		'Super-správca? ');
define('_LIST_MEMBER_LOGIN',		'Mô¾e sa prihlási»? ');
define('_LIST_MEMBER_URL',			'Stránka');

// banlist
define('_LIST_BAN_IPRANGE',			'Rozsah IP adres');
define('_LIST_BAN_REASON',			'Dôvod');

// actionlist
define('_LIST_ACTION_MSG',			'Správa');

// commentlist
define('_LIST_COMMENT_BANIP',		'Blokova» IP adresu');
define('_LIST_COMMENT_WHO',			'Autor');
define('_LIST_COMMENT',				'Komentár');
define('_LIST_COMMENT_HOST',		'Server');

// itemlist
define('_LIST_ITEM_INFO',			'Info');
define('_LIST_ITEM_CONTENT',		'Titulok a text');


// teamlist
define('_LIST_TEAM_ADMIN',			'Správca ');
define('_LIST_TEAM_CHADMIN',		'Zmeni» správcu');

// edit comments
define('_EDITC_TITLE',				'Upravi» komentáre');
define('_EDITC_WHO',				'Autor');
define('_EDITC_HOST',				'Odkiaµ?');
define('_EDITC_WHEN',				'Kedy?');
define('_EDITC_TEXT',				'Text');
define('_EDITC_EDIT',				'Upravi» komentár');
define('_EDITC_MEMBER',				'èlen');
define('_EDITC_NONMEMBER',			'nie je èlenom');

// move item
define('_MOVE_TITLE',				'Presunú» do akého blogu?');
define('_MOVE_BTN',					'Presunú» èlánok');

?>