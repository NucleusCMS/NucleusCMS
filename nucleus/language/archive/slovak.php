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
define('_MEDIA_VIEW',				'zobrazi�');
define('_MEDIA_VIEW_TT',			'Zobrazi� s�bor (v novom okne)');
define('_MEDIA_FILTER_APPLY',		'Pou�i� filter');
define('_MEDIA_FILTER_LABEL',		'Filter: ');
define('_MEDIA_UPLOAD_TO',			'Nahra� do...');
define('_MEDIA_UPLOAD_NEW',			'Nahra� nov� s�bor...');
define('_MEDIA_COLLECTION_SELECT',	'V�ber');
define('_MEDIA_COLLECTION_TT',		'Prepn�� sa do tejto kateg�rie');
define('_MEDIA_COLLECTION_LABEL',	'Aktu�lna kolekcia:: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'Zarovna� do�ava');
define('_ADD_ALIGNRIGHT_TT',		'Zarovna� doprava');
define('_ADD_ALIGNCENTER_TT',		'Zarovna� na stred');

// searchable blog setting (yes/no)
define('_EBLOG_SEARCH',				'Zahrn�� do h�adania');

// generic upload failure
define('_ERROR_UPLOADFAILED',		'Nahr�vanie zlyhalo');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'Povoli� publikovanie do minulosti');
define('_ADD_CHANGEDATE',			'Prep�sa� d�tum/�as');
define('_BMLET_CHANGEDATE',			'Prep�sa� d�tum/�as');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'Import/export vzh�adu...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Norm�lny');
define('_PARSER_INCMODE_SKINDIR',	'Pou�i� adr. vzh�adu');
define('_SKIN_INCLUDE_MODE',		'Re�im vkladania');
define('_SKIN_INCLUDE_PREFIX',		'Prefix');

// global settings
define('_SETTINGS_BASESKIN',		'Z�kladn� vzh�ad');
define('_SETTINGS_SKINSURL',		'URL so vzh�admi');
define('_SETTINGS_ACTIONSURL',		'Pln� URL k action.php');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'Nie je mo�n� presun�� �tandardn� kateg�riu');
define('_ERROR_MOVETOSELF',			'Nie je mo�n� presun�� kateg�riu (cie�ov� blog je rovnak�, ako zdrojov� blog)');
define('_MOVECAT_TITLE',			'Vyberte blog, do ktor�ho chcete presun�t kateg�riu');
define('_MOVECAT_BTN',				'Presun�� kateg�riu');

// URLMode setting
define('_SETTINGS_URLMODE',			'Re�im URL');
define('_SETTINGS_URLMODE_NORMAL',	'Norm�lny');
define('_SETTINGS_URLMODE_PATHINFO','Pestr�');

// Batch operations
define('_BATCH_NOSELECTION',		'Pre prevedenie akcie nieje ni� vybran�');
define('_BATCH_ITEMS',				'D�vkov� oper�cia na �l�nkoch');
define('_BATCH_CATEGORIES',			'D�vkov� oper�cia na kategori�ch');
define('_BATCH_MEMBERS',			'D�vkov� oper�cia na u��vate�och');
define('_BATCH_TEAM',				'D�vkov� oper�cia na �lenoch t�mu');
define('_BATCH_COMMENTS',			'D�vkov� oper�cia na koment�roch');
define('_BATCH_UNKNOWN',			'Nezn�ma d�vkov� oper�cia: ');
define('_BATCH_EXECUTING',			'Sp���a sa');
define('_BATCH_ONCATEGORY',			'na kategorii');
define('_BATCH_ONITEM',				'na �l�nku');
define('_BATCH_ONCOMMENT',			'na koment�ri');
define('_BATCH_ONMEMBER',			'na u�ivate�ovi');
define('_BATCH_ONTEAM',				'na �lenovi t�mu');
define('_BATCH_SUCCESS',			'�spech!');
define('_BATCH_DONE',				'Hotovo!');
define('_BATCH_DELETE_CONFIRM',		'Potvr�te d�vkov� odstr�nenie');
define('_BATCH_DELETE_CONFIRM_BTN',	'Potvr�te d�vkov� odstr�nenie');
define('_BATCH_SELECTALL',			'vybra� v�etko');
define('_BATCH_DESELECTALL',		'nevybra� ni�');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'Odstr�ni�');
define('_BATCH_ITEM_MOVE',			'P�esun��');
define('_BATCH_MEMBER_DELETE',		'Odstr�ni�');
define('_BATCH_MEMBER_SET_ADM',		'Nastavi� spr�vcovsk� pr�va');
define('_BATCH_MEMBER_UNSET_ADM',	'Odebrat spr�vcovsk� pr�va');
define('_BATCH_TEAM_DELETE',		'Odstr�ni� z t�mu');
define('_BATCH_TEAM_SET_ADM',		'Nastavi� spr�vcovsk� pr�va');
define('_BATCH_TEAM_UNSET_ADM',		'Odobra� spr�vcovsk� pr�va');
define('_BATCH_CAT_DELETE',			'Odstr�ni�');
define('_BATCH_CAT_MOVE',			'Presun�� do in�ho blogu');
define('_BATCH_COMMENT_DELETE',		'Odstr�ni�');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'Pridat nov� �l�nok...');
define('_ADD_PLUGIN_EXTRAS',		'Nastavenie pre pluginy');

// errors
define('_ERROR_CATCREATEFAIL',		'Nie je mo�n� vytvori� nov� kateg�riu');
define('_ERROR_NUCLEUSVERSIONREQ',	'Tento plugin vy�aduje nov�iu verziu Nucleusu: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Sp� na nastavenie blogu');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Import');
define('_SKINIE_TITLE_EXPORT',		'Export');
define('_SKINIE_BTN_IMPORT',		'Import');
define('_SKINIE_BTN_EXPORT',		'Export vybran�ch vzh�adov/�abl�n');
define('_SKINIE_LOCAL',				'Import z lok�lneho s�boru:');
define('_SKINIE_NOCANDIDATES',		'V adres�ri vzh�adov neboli n�jden� �iadne polo�ky pre import');
define('_SKINIE_FROMURL',			'Import z URL:');
define('_SKINIE_EXPORT_INTRO',		'Vyberte vzh�ady a �abl�ny, ktor� chcete exportova�');
define('_SKINIE_EXPORT_SKINS',		'Vzh�ady');
define('_SKINIE_EXPORT_TEMPLATES',	'�abl�ny');
define('_SKINIE_EXPORT_EXTRA',		'Extra info');
define('_SKINIE_CONFIRM_OVERWRITE',	'Prep�sa� vzh�ady, ktor� u� existuj� (vi� konflikty mien)');
define('_SKINIE_CONFIRM_IMPORT',	'�no, toto chcem naimportova�');
define('_SKINIE_CONFIRM_TITLE',		'Bud� naimportovan� vzh�ady a �abl�ny');
define('_SKINIE_INFO_SKINS',		'Vzh�ady v s�bore:');
define('_SKINIE_INFO_TEMPLATES',	'�abl�ny v s�bore:');
define('_SKINIE_INFO_GENERAL',		'Info:');
define('_SKINIE_INFO_SKINCLASH',	'Konflikty v n�zvoch vzh�adov:');
define('_SKINIE_INFO_TEMPLCLASH',	'Konflikty v n�zvoch �abl�n:');
define('_SKINIE_INFO_IMPORTEDSKINS','Importovan� vzh�ady:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Importovan� �abl�ny::');
define('_SKINIE_DONE',				'Import dokon�en�');

define('_AND',						'a');
define('_OR',						'alebo');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'pr�zdne pole (kliknite pre edit�ciu)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'Re�im vkladania:');
define('_LIST_SKINS_INCPREFIX',		'Prefix:');
define('_LIST_SKINS_DEFINED',		'Definovan� �asti:');

// backup
define('_BACKUPS_TITLE',			'Z�loha / obnovenie');
define('_BACKUP_TITLE',				'Z�loha');
define('_BACKUP_INTRO',				'Kliknite na tla��tko pre vytvorenie z�lohy Nucleus datab�zy. Budete vyzvan� k ulo�eniu s�boru so z�lohou. Tento s�bor potom uschovajte na bezpe�nom mieste.');
define('_BACKUP_ZIP_YES',			'Pok�si� sa pou�i� kompresiu');
define('_BACKUP_ZIP_NO',			'Nepou��va� kompresiu');
define('_BACKUP_BTN',				'Vytvori� z�lohu');
define('_BACKUP_NOTE',				'<b>Pozn�mka:</b> Z�lohuje sa iba obsah datab�zy. Obr�zky a nastavenia v config.php teda <b>NIESU</b> s���s�ou z�lohy.');
define('_RESTORE_TITLE',			'Obnovi�');
define('_RESTORE_NOTE',				'<b>POZOR:</b> Obnova zo z�lohy <b>VYMA�E</b> s��asn� d�ta v datab�zi! T�to akciu preve�te iba ak ste si naozaj ist�!	<br />	<b>Pozn�mka:</b> Uistite sa, �e verzia Nucleusu, v ktorej ste previedol z�lohu, je rovnak�, ako verzia, ktor� pou��vate teraz! Inak obnova nebude fungova�.');
define('_RESTORE_INTRO',			'Tu vyberte s�bor so z�lohou (bude nahran� na server) a kliknite na tla��tko "Obnovi�" pre zah�jenie akcie.');
define('_RESTORE_IMSURE',			'�no, som si ist�, �e to chcem urobi�!');
define('_RESTORE_BTN',				'Obnovi� zo s�boru');
define('_RESTORE_WARNING',			'(uistite sa, �e obnovujete spr�vnu z�lohu, pr�padn� si najprv zaz�lohujte teraj�ie d�ta)');
define('_ERROR_BACKUP_NOTSURE',		'Mus�te za�krtn�� pol��ko \'Som si ist�\'');
define('_RESTORE_COMPLETE',			'Obnova bola dokon�en�');

// new item notification
define('_NOTIFY_NI_MSG',			'Bol publikovan� nov� �l�nok:');
define('_NOTIFY_NI_TITLE',			'Nov� �l�nok!');
define('_NOTIFY_KV_MSG',			'Karma vo�ba pri �l�nku:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'Koment�r k �l�nku:');
define('_NOTIFY_NC_TITLE',			'Nucleus koment�r:');
define('_NOTIFY_USERID',			'ID u��vate�a:');
define('_NOTIFY_USER',				'U��vate�:');
define('_NOTIFY_COMMENT',			'Koment�r:');
define('_NOTIFY_VOTE',				'Vo�ba:');
define('_NOTIFY_HOST',				'Server:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'�len:');
define('_NOTIFY_TITLE',				'Nadpis:');
define('_NOTIFY_CONTENTS',			'Text:');

// member mail message
define('_MMAIL_MSG',				'Obdr�al ste nov� spr�vu od');
define('_MMAIL_FROMANON',			'anonymn�ho n�v�t�vn�ka');
define('_MMAIL_FROMNUC',			'Odoslan� v syst�me Nucleus weblog v');
define('_MMAIL_TITLE',				'Spr�va od');
define('_MMAIL_MAIL',				'Spr�va:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'Prida� �l�nok');
define('_BMLET_EDIT',				'Upravi� �l�nok');
define('_BMLET_DELETE',				'Odstr�ni� �l�nok');
define('_BMLET_BODY',				'Text');
define('_BMLET_MORE',				'Roz��ren� text');
define('_BMLET_OPTIONS',			'Volby');
define('_BMLET_PREVIEW',			'N�h�ad');

// used in bookmarklet
define('_ITEM_UPDATED',				'�l�nok bol upraven�');
define('_ITEM_DELETED',				'�l�nok bol odstr�nen�');

// plugins
define('_CONFIRMTXT_PLUGIN',		'Skuto�ne chcete odstr�ni� plugin');
define('_ERROR_NOSUCHPLUGIN',		'Tak� plugin neexistuje');
define('_ERROR_DUPPLUGIN',			'Tento plugin u� bol nain�talovan�');
define('_ERROR_PLUGFILEERROR',		'Plugin neexistuje, alebo s� zle nastaven� pr�stupov� pr�va');
define('_PLUGS_NOCANDIDATES',		'�iadne pluginy neboli n�jden�');

define('_PLUGS_TITLE_MANAGE',		'Spr�va pluginov');
define('_PLUGS_TITLE_INSTALLED',	'Moment�lne nain�talovan�');
define('_PLUGS_TITLE_UPDATE',		'Aktualizova� zoznam odberov');
define('_PLUGS_TEXT_UPDATE',		'Nucleus si udr�uje datab�zu odberov udalost� pre pluginy. Ak nahr�te nov� verziu pluginu, mali by ste spusti� t�to aktualiz�ciu, aby boli odbery obnoven�.');
define('_PLUGS_TITLE_NEW',			'Nain�talova� nov� plugin');
define('_PLUGS_ADD_TEXT',			'Dole vid�te zoznam s�borov z adres�ra pluginov, ktor� asi s�  nenain�talovan� pluginy. Pred ich nain�talovan�m sa uistite, �e to s� <strong>ur�ite</strong> pluginy.');
define('_PLUGS_BTN_INSTALL',		'Nain�talova� plugin');
define('_BACKTOOVERVIEW',			'Sp� na preh�ad');

// editlink
define('_TEMPLATE_EDITLINK',		'Odkaz na edit�ciu �l�nku');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'Prida� r�m�ek v�avo');
define('_ADD_RIGHT_TT',				'Prida� r�m�ek vpravo');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'Nov� kateg�ria...');

// new settings
define('_SETTINGS_PLUGINURL',		'URL s pluginmi');
define('_SETTINGS_MAXUPLOADSIZE',	'Max. ve�kos� s�boru pre nahranie (bytes)');
define('_SETTINGS_NONMEMBERMSGS',	'Povoli� neregistrovan�m posiela� apr�vy');
define('_SETTINGS_PROTECTMEMNAMES',	'Chr�ni� men� �lenov');

// overview screen
define('_OVERVIEW_PLUGINS',			'Spr�va pluginov...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'Registr�cia nov�ho �lena:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'Va�a emailov� adresa:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'Nem�te spr�vcovsk� pr�va pre �iadny z blogov, ktor� maj� pr�jemcu vo svojom t�me. Preto nesmiete nahr�va� s�bory do adres�ra tetjo osoby.');

// plugin list
define('_LISTS_INFO',				'Inform�cie');
define('_LIST_PLUGS_AUTHOR',		'Od:');
define('_LIST_PLUGS_VER',			'Verzia:');
define('_LIST_PLUGS_SITE',			'Nav�t�vi� str�nku');
define('_LIST_PLUGS_DESC',			'Popis:');
define('_LIST_PLUGS_SUBS',			'Odberate� t�chto udalost�:');
define('_LIST_PLUGS_UP',			'nahor');
define('_LIST_PLUGS_DOWN',			'nadol');
define('_LIST_PLUGS_UNINSTALL',		'odin�talova�');
define('_LIST_PLUGS_ADMIN',			'spr�vca');
define('_LIST_PLUGS_OPTIONS',		'upravi�&nbsp;nastavenie');

// plugin option list
define('_LISTS_VALUE',				'Hodnota');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'tento plugin nem� �iadne nastavenia');
define('_PLUGS_BACK',				'Sp� na preh�ad pluginov');
define('_PLUGS_SAVE',				'Ulo�i� nastavenia');
define('_PLUGS_OPTIONS_UPDATED',	'Nastavenia pluginu boli upraven�');

define('_OVERVIEW_MANAGEMENT',		'Spr�va');
define('_OVERVIEW_MANAGE',			'Spr�va Nucleusu...');
define('_MANAGE_GENERAL',			'V�eobecn� nastavenia');
define('_MANAGE_SKINS',				'Vzh�ad a �abl�ny');
define('_MANAGE_EXTRA',				'Extra vo�by');

define('_BACKTOMANAGE',				'Sp� na spr�vu Nucleusu');


// END introduced after v1.1 END




// charset to use 
define('_CHARSET',					'ISO-8859-2');

// global stuff
define('_LOGOUT',					'Odhl�si� sa');
define('_LOGIN',					'Prihl�si� sa');
define('_YES',						'�no');
define('_NO',						'Nie');
define('_SUBMIT',					'Odosla�');
define('_ERROR',					'Chyba');
define('_ERRORMSG',					'Vyskytla se chyba!');
define('_BACK',						'Sp�');
define('_NOTLOGGEDIN',				'Nie ste prihl�sen�');
define('_LOGGEDINAS',				'Prihl�sen� ako');
define('_ADMINHOME',				'Spr�vca');
define('_NAME',						'Meno');
define('_BACKHOME',					'Sp� na spr�vcovsk� str�nku');
define('_BADACTION',				'Bola po�adovan� neexistuj�ca akcia');
define('_MESSAGE',					'Spr�va');
define('_HELP_TT',					'Pomoc!');
define('_YOURSITE',					'Va�a str�nka');


define('_POPUP_CLOSE',				'Zatvori� okno');

define('_LOGIN_PLEASE',				'Pros�m, najprv sa prihl�ste');

// commentform
define('_COMMENTFORM_YOUARE',		'Ste');
define('_COMMENTFORM_SUBMIT',		'Prida� koment�r');
define('_COMMENTFORM_COMMENT',		'V� koment�r');
define('_COMMENTFORM_NAME',			'Meno');
define('_COMMENTFORM_MAIL',			'E-mail/HTTP');
define('_COMMENTFORM_REMEMBER',		'Pam�taj si mna');

// loginform
define('_LOGINFORM_NAME',			'Meno');
define('_LOGINFORM_PWD',			'Heslo');
define('_LOGINFORM_YOUARE',			'Prihl�sen� ako');
define('_LOGINFORM_SHARED',			'Neuklada� �daje');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'Poslat spr�vu');

// search form
define('_SEARCHFORM_SUBMIT',		'H�adanie');

// add item form
define('_ADD_ADDTO',				'Prida� nov� �l�nok do');
define('_ADD_CREATENEW',			'Vytvori� nov� �l�nok');
define('_ADD_BODY',					'Perex');
define('_ADD_TITLE',				'Nadpis');
define('_ADD_MORE',					'Cel� �l�nok');
define('_ADD_CATEGORY',				'Kateg�ria');
define('_ADD_PREVIEW',				'N�h�ad');
define('_ADD_DISABLE_COMMENTS',		'Zak�za� koment�re?');
define('_ADD_DRAFTNFUTURE',			'Koncepty a �l�nky pre neskor�ie publikovanie');
define('_ADD_ADDITEM',				'Prida� �l�nok');
define('_ADD_ADDNOW',				'Prida� teraz');
define('_ADD_ADDLATER',				'Prida� nesk�r');
define('_ADD_PLACE_ON',				'Umiestni� na');
define('_ADD_ADDDRAFT',				'Prida� medzi koncepty');
define('_ADD_NOPASTDATES',			'(d�tumy a �asy v minulosti NIE S� platn�, v tom pr�pade bude pou�it� aktu�lny �as)');
define('_ADD_BOLD_TT',				'Tu�n�');
define('_ADD_ITALIC_TT',			'Kurz�va');
define('_ADD_HREF_TT',				'Vytvori� odkaz');
define('_ADD_MEDIA_TT',				'Prida� obr�zok');
define('_ADD_PREVIEW_TT',			'Zobrazi�/skry� n�h�ad');
define('_ADD_CUT_TT',				'Vybra�');
define('_ADD_COPY_TT',				'Kop�rova�');
define('_ADD_PASTE_TT',				'Vlo�it');


// edit item form
define('_EDIT_ITEM',				'Upravi� �l�nok');
define('_EDIT_SUBMIT',				'Upravi� �l�nok');
define('_EDIT_ORIG_AUTHOR',			'P�vodn� autor');
define('_EDIT_BACKTODRAFTS',		'Prida� sp� medzi koncepty');
define('_EDIT_COMMENTSNOTE',		'(pozn�mka: zak�zanie koment�rov _neskryje_ sk�r pridan� koment�re)');

// used on delete screens
define('_DELETE_CONFIRM',			'Pros�m, potvr�te odstranenie');
define('_DELETE_CONFIRM_BTN',		'Potvrdenie odstranenia');
define('_CONFIRMTXT_ITEM',			'Chyst�te sa odstr�ni� nasleduj�c� �l�nok:');
define('_CONFIRMTXT_COMMENT',		'Chyst�te sa odstr�ni� n�sleduj�c� koment�r:');
define('_CONFIRMTXT_TEAM1',			'Chyst�te sa odstr�ni� u�ivate�a ');
define('_CONFIRMTXT_TEAM2',			' z t�mu pre blog ');
define('_CONFIRMTXT_BLOG',			'Blog, ktor� sa chyst�te odstr�ni�, je: ');
define('_WARNINGTXT_BLOGDEL',		'Pozor! Odstr�nen�m blogu dojde k vymazaniu V�ETK�CH �l�nkov tohoto blogu a v�etk�ch koment�rov. Pros�m, potvr�te, �e to NAOZAJ chcete urobi�!<br />Behom odstra�ovania blogu nepreru�ujte Nucleus.');
define('_CONFIRMTXT_MEMBER',		'Chyst�te sa odstr�ni� profil n�sleduj�ceho �lena: ');
define('_CONFIRMTXT_TEMPLATE',		'Chyst�te se odstr�ni� �abl�nu ');
define('_CONFIRMTXT_SKIN',			'Chyst�te sa odstr�ni� vzh�ad ');
define('_CONFIRMTXT_BAN',			'Chyst�te sa odstr�ni� obmedzenie pr�stupu pre ip adresy');
define('_CONFIRMTXT_CATEGORY',		'Chyst�te sa odstr�ni� kateg�riu ');

// some status messages
define('_DELETED_ITEM',				'�l�nok odstr�nen�');
define('_DELETED_MEMBER',			'Reg. u��vate� odstr�n�');
define('_DELETED_COMMENT',			'Koment�� odstran�n');
define('_DELETED_BLOG',				'Blog odstr�nen�');
define('_DELETED_CATEGORY',			'Kateg�ria odstr�nen�');
define('_ITEM_MOVED',				'�l�nok presunut�');
define('_ITEM_ADDED',				'�l�nok pridan�');
define('_COMMENT_UPDATED',			'Koment�r upraven�');
define('_SKIN_UPDATED',				'Vzh�ad bol ulo�en�');
define('_TEMPLATE_UPDATED',			'�abl�na bola ulo�en�');

// errors
define('_ERROR_COMMENT_LONGWORD',	'Pros�m, v koment�roch nepou��vajte slov� dlh�ie ne� 90 znakov');
define('_ERROR_COMMENT_NOCOMMENT',	'Pros�m, vlo�te koment�r');
define('_ERROR_COMMENT_NOUSERNAME',	'Neplatn� u�ivate�sk� meno');
define('_ERROR_COMMENT_TOOLONG',	'V� koment�r je pr�li� dlh� (max. 5000 znakov)');
define('_ERROR_COMMENTS_DISABLED',	'Koment�re pre tento blog s� moment�lne zak�zan�.');
define('_ERROR_COMMENTS_NONPUBLIC',	'Aby ste mohli prid�va� koment�re do tohoto blogu, mus�te by� prihl�sen�');
define('_ERROR_COMMENTS_MEMBERNICK','Meno, pod ktor�m chcete odoslat koment�r, pou��va in� registrovan� u�ivate�. Pou�ite nejak� in�.');
define('_ERROR_SKIN',				'Chyba v defin�cii vzh�adu');
define('_ERROR_ITEMCLOSED',			'Tento �l�nok bol uzatvoren�. U� nie je mo�n� k nemu prid�va� koment�re ani hlasova�');
define('_ERROR_NOSUCHITEM',			'�l�nok nen�jden�');
define('_ERROR_NOSUCHBLOG',			'Blog nen�jden�');
define('_ERROR_NOSUCHSKIN',			'Vzh�ad nen�jden�');
define('_ERROR_NOSUCHMEMBER',		'Registrovan� u��vate� nen�jden�');
define('_ERROR_NOTONTEAM',			'Nie ste �lenom t�mu tohto blogu');
define('_ERROR_BADDESTBLOG',		'Cie�ov� blog neexistuje');
define('_ERROR_NOTONDESTTEAM',		'Nie je mo�n� presun�� �l�nok, preto�e nie ste �lenom t�mu cie�ov�ho blogu');
define('_ERROR_NOEMPTYITEMS',		'Nie je mo�n� prida� pr�zdny �l�nok!');
define('_ERROR_BADMAILADDRESS',		'Emailov� adresa nie je platn�');
define('_ERROR_BADNOTIFY',			'Jedna alebo viac z udan�ch adries pre oznamovanie nie je platn� emailov� adresa');
define('_ERROR_BADNAME',			'Meno nie je platn� (s� dovolen� iba znaky a-z a 0-9, �iadne medzery na za�iatku a na konci)');
define('_ERROR_NICKNAMEINUSE',		'T�to prez�vku u� pou��va in� registrovan� �len');
define('_ERROR_PASSWORDMISMATCH',	'Hesl� musia by� rovnak�');
define('_ERROR_PASSWORDTOOSHORT',	'Heslo by malo ma� aspo� 6 znakov');
define('_ERROR_PASSWORDMISSING',	'Heslo nesmie by� pr�zdne');
define('_ERROR_REALNAMEMISSING',	'Mus�te vlo�i� skuto�n� meno');
define('_ERROR_ATLEASTONEADMIN',	'Mal by by� v�dy aspo� jeden super-spr�vca, ktor� ss m��e prihl�si� do spr�vcovskej sekcie.');
define('_ERROR_ATLEASTONEBLOGADMIN','Vykonsnie tejto akcie by sp�sobilo, �e by v� blog nemal kto spravova�.  Uistite sa, �e v�dy existuje aspo� jeden spr�vca.');
define('_ERROR_ALREADYONTEAM',		'Nem��ete prida� u��vate�a, ktor� u� je �lenom t�mu');
define('_ERROR_BADSHORTBLOGNAME',	'Kr�tke meno blogu by malo obsahova� len znaky a-z a 0-9, bez medzier');
define('_ERROR_DUPSHORTBLOGNAME',	'Toto kr�tke meno u� pou��va in� blog. Tieto men� musia by� unik�tne.');
define('_ERROR_UPDATEFILE',			'Nie je mo�n� zapisova� do update-souboru. Uistite sa, �e s� spr�vne nastaven� pr�stupov� pr�va (sk�ste chmod 666). Tie� pozor na to, �e umiestnenie je relat�vne k adres�ru spr�vcovskej oblasti, tak�e by ste mohli sk�si� absol�tnu cestu (nie�o ako /your/path/to/nucleus/)');
define('_ERROR_DELDEFBLOG',			'Nie je mo�n� odstr�ni� prednastaven� blog');
define('_ERROR_DELETEMEMBER',		'Tento u��vate� nem��e by� odstr�nen�. Pravdepodobne preto, proto�e je autorom nejak�ch �l�nkov, alebo koment�rov.');
define('_ERROR_BADTEMPLATENAME',	'Neplatn� meno �abl�ny. Pou�ite iba znaky a-z a 0-9, �iadne medzery.');
define('_ERROR_DUPTEMPLATENAME',	'U� existuje �abl�na s t�mto n�zvom.');
define('_ERROR_BADSKINNAME',		'Neplatn� meno vzh�adu (pou�ite iba znaky a-z a 0-9, �iadne medzery)');
define('_ERROR_DUPSKINNAME',		'U� existuje vzh�ad s t�mto n�zvom.');
define('_ERROR_DEFAULTSKIN',		'Vzh�ad s n�zvom "default" mus� by� v�dy dostupn�.');
define('_ERROR_SKINDEFDELETE',		'Nie je mo�n� odstr�ni� vzh�ad, preto�e je to �tandardn� vzh�ad pre nssleduj�ci blog: ');
define('_ERROR_DISALLOWED',			'Prep��te, ale nie ste opr�vnen� k tejto akci.');
define('_ERROR_DELETEBAN',			'Chyba pri odstra�ovan� obmedzenia p��stupu (obmedzenie pr�stupu neexistuje)');
define('_ERROR_ADDBAN',				'Chyba pri prid�van� obmedzenia pr�stupu. Obmedzenie pr�stupu asi nebolo korektne pridan� do v�etk�ch blogov.');
define('_ERROR_BADACTION',			'Po�adovan� akcia neexistuje');
define('_ERROR_MEMBERMAILDISABLED',	'Mailov� spr�vy medzi �lenmi s� zak�zan�.');
define('_ERROR_MEMBERCREATEDISABLED','Vytv�ranie u��vate�sk�ch kont je zak�zan�.');
define('_ERROR_INCORRECTEMAIL',		'Neplatn� mailov� adresa');
define('_ERROR_VOTEDBEFORE',		'Pre tento �l�nok u� ste hlasovali');
define('_ERROR_BANNED1',			'Akciu nie je mo�n� vykona�, proto�e v�m (rozsah adries ');
define('_ERROR_BANNED2',			') byl obmedzen� pr�stup. Spr�va bola: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'Aby ste mohli vykona� t�to akciu, mus�te sa prihl�si�.');
define('_ERROR_CONNECT',			'Chyba spojenia');
define('_ERROR_FILE_TOO_BIG',		'S�bor je pr�li� ve�k�!');
define('_ERROR_BADFILETYPE',		'Prep��te, ale tento typ s�boru nie je povolen�.');
define('_ERROR_BADREQUEST',			'Neplatn� po�iadavok pre nahranie s�boru');
define('_ERROR_DISALLOWEDUPLOAD',	'Nie ste �lenom t�mu �iadneho blogu, a preto nem��ete nahr�va� s�bory.');
define('_ERROR_BADPERMISSIONS',		'Pr�va pre s�bor/adres�r nie s� spr�vne nastaven�');
define('_ERROR_UPLOADMOVEP',		'Chyba pri presune nahran�ho s�boru');
define('_ERROR_UPLOADCOPY',			'Chyba pri kop�rovan� s�boru');
define('_ERROR_UPLOADDUPLICATE',	'S�bor s t�mto n�zvom u� existuje. Pred nahran�m ho sk�ste premenova�.');
define('_ERROR_LOGINDISALLOWED',	'Prep��te, ale nem��ete sa prihl�si� do spr�vcovskej oblasti. Av�ak m��ete sa prihl�si� ako in� u��vate�.');
define('_ERROR_DBCONNECT',			'Nie je mo�n� pripoji� sa k mySQL serveru');
define('_ERROR_DBSELECT',			'Nie je mo�n� vybra� datab�zu nucleus.');
define('_ERROR_NOSUCHLANGUAGE',		'Tento jazykov� s�bor neexistuje');
define('_ERROR_NOSUCHCATEGORY',		'Tak� kateg�ria neexistuje');
define('_ERROR_DELETELASTCATEGORY',	'Mus� existova� aspo� jedna kateg�ria');
define('_ERROR_DELETEDEFCATEGORY',	'Nie je mo�n� odstr�ni� defaultn� kateg�riu');
define('_ERROR_BADCATEGORYNAME',	'Neplatn� n�zov kateg�ria');
define('_ERROR_DUPCATEGORYNAME',	'Kateg�ria s t�mto n�zvom u� existuje');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'Pozor: Aktu�lna hodnota nie je adres�r!');
define('_WARNING_NOTREADABLE',		'Pozor: Aktu�lna hodnota nie je adres�r na ��tanie!');
define('_WARNING_NOTWRITABLE',		'Pozor: Aktu�lna hodnota NIE JE adres�r, do ktor�ho sa d� zapisova�!');

// media and upload
define('_MEDIA_UPLOADLINK',			'Nahra� nov� s�bor');
define('_MEDIA_MODIFIED',			'modifikovan�');
define('_MEDIA_FILENAME',			'n�zov s�boru');
define('_MEDIA_DIMENSIONS',			'rozmery');
define('_MEDIA_INLINE',				'Vo vn�tri');
define('_MEDIA_POPUP',				'Okno');
define('_UPLOAD_TITLE',				'Zvo�te s�bor');
define('_UPLOAD_MSG',				'Vyberte s�bor pre nahratie, a potom stla�te tla��tko \'Nahra�\'.');
define('_UPLOAD_BUTTON',			'Nahra�');

// some status messages
define('_MSG_ACCOUNTCREATED',		'��et bol vytvoren�. Heslo obdr��te e-mailom.');
define('_MSG_PASSWORDSENT',			'Heslo v�m bolo odoslan� e-mailom.');
define('_MSG_LOGINAGAIN',			'Budete sa musie� znova prihl�si�, preto�e va�e �daje boli zmenen�.');
define('_MSG_SETTINGSCHANGED',		'Nastavenia zmenen�');
define('_MSG_ADMINCHANGED',			'Spr�vca zmenen�');
define('_MSG_NEWBLOG',				'Nov� blog bol vytvoren�');
define('_MSG_ACTIONLOGCLEARED',		'Log akci� bol zmazan�');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'Nepovolen� akcia: ');
define('_ACTIONLOG_PWDREMINDERSENT','Odoslan� nov� heslo pre ');
define('_ACTIONLOG_TITLE',			'Log akci�');
define('_ACTIONLOG_CLEAR_TITLE',	'Zmaza� log akci�');
define('_ACTIONLOG_CLEAR_TEXT',		'Vymaza� log akci�');

// team management
define('_TEAM_TITLE',				'Spr�va t�mu pre blog ');
define('_TEAM_CURRENT',				'Aktu�lny t�m');
define('_TEAM_ADDNEW',				'Prida� �lena do t�mu');
define('_TEAM_CHOOSEMEMBER',		'Zvo�te �lena');
define('_TEAM_ADMIN',				'Spr�vcovsk� pr�va? ');
define('_TEAM_ADD',					'Prida� do t�mu');
define('_TEAM_ADD_BTN',				'Prida� do t�mu');

// blogsettings
define('_EBLOG_TITLE',				'Upravi� nastavenie blogu');
define('_EBLOG_TEAM_TITLE',			'Upravi� t�m');
define('_EBLOG_TEAM_TEXT',			'Kliknite tu pre �pravu t�mu...');
define('_EBLOG_SETTINGS_TITLE',		'Nastavenie blogu');
define('_EBLOG_NAME',				'Meno blogu');
define('_EBLOG_SHORTNAME',			'Kr�tke meno blogu');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(iba znaky a-z bez medzier)');
define('_EBLOG_DESC',				'Popis blogu');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'�tandardn� vzh�ad');
define('_EBLOG_DEFCAT',				'�tandardn� kateg�ria');
define('_EBLOG_LINEBREAKS',			'Odriadkov�va�');
define('_EBLOG_DISABLECOMMENTS',	'Povoli� koment�re?<br /><small>(Ur�uje, �i je mo�n� prid�va� koment�re)</small>');
define('_EBLOG_ANONYMOUS',			'Povoli� koment�re od neregistrovan�ch n�v�t�vn�kov?');
define('_EBLOG_NOTIFY',				'Adresa/adresy pre oznamovanie (pou�ite ; ako odde�ova�)');
define('_EBLOG_NOTIFY_ON',			'Oznamova� zaslanie');
define('_EBLOG_NOTIFY_COMMENT',		'Nov�ch koment�rov');
define('_EBLOG_NOTIFY_KARMA',		'Nov�ch karma hlasov');
define('_EBLOG_NOTIFY_ITEM',		'Nov�ch �l�nkov blogu');
define('_EBLOG_PING',				'Ping na Weblogs.com pri zmen�ch?');
define('_EBLOG_MAXCOMMENTS',		'Maxim�lny po�et koment�rov');
define('_EBLOG_UPDATE',				'Zap�sa� zmeny do s�boru');
define('_EBLOG_OFFSET',				'�asov� posun');
define('_EBLOG_STIME',				'Aktu�lny �as serveru je');
define('_EBLOG_BTIME',				'Aktu�lny �as blogu je');
define('_EBLOG_CHANGE',				'Zmeni� nastavenie');
define('_EBLOG_CHANGE_BTN',			'Zm�nit nastaven�');
define('_EBLOG_ADMIN',				'Spr�vca blogu');
define('_EBLOG_ADMIN_MSG',			'Obdr��te spr�vcovsk� pr�va');
define('_EBLOG_CREATE_TITLE',		'Vytvori� nov� blog');
define('_EBLOG_CREATE_TEXT',		'Pre vytvorenie nov�ho blogu vypl�te nasleduj�c� formul�r. <br /><br /> <b>Pozn�mka:</b> S� tu vyp�san� iba najnutnej�ie vo�by. Ak chcete zm�nit da��ie nastavenia, po vytvoren� blogu nav�tivte str�nku s vlastnos�ami blogu.');
define('_EBLOG_CREATE',				'Vytvori�!');
define('_EBLOG_CREATE_BTN',			'Vytvori� blog');
define('_EBLOG_CAT_TITLE',			'Kateg�ria');
define('_EBLOG_CAT_NAME',			'N�zov kateg�rie');
define('_EBLOG_CAT_DESC',			'Popis kateg�rie');
define('_EBLOG_CAT_CREATE',			'Vytvori� nov� kateg�riu');
define('_EBLOG_CAT_UPDATE',			'Upravi� kateg�riu');
define('_EBLOG_CAT_UPDATE_BTN',		'Upravi� kateg�riu');

// templates
define('_TEMPLATE_TITLE',			'Upravi� �abl�ny');
define('_TEMPLATE_AVAILABLE_TITLE',	'Dostupn� �abl�ny');
define('_TEMPLATE_NEW_TITLE',		'Nov� �abl�na');
define('_TEMPLATE_NAME',			'N�zov �abl�ny');
define('_TEMPLATE_DESC',			'Popis �abl�ny');
define('_TEMPLATE_CREATE',			'Vytvori� �abl�nu');
define('_TEMPLATE_CREATE_BTN',		'Vytvori� �abl�nu');
define('_TEMPLATE_EDIT_TITLE',		'Upravi� �abl�nu');
define('_TEMPLATE_BACK',			'Sp� na preh�ad �abl�n');
define('_TEMPLATE_EDIT_MSG',		'Nie v�etky �asti �abl�ny s� vy�adovan�. Nepotrebn� �asti nechajte pr�zdne.');
define('_TEMPLATE_SETTINGS',		'Nastavenie �abl�ny');
define('_TEMPLATE_ITEMS',			'�l�nky');
define('_TEMPLATE_ITEMHEADER',		'Hlavi�ka �l�nku');
define('_TEMPLATE_ITEMBODY',		'Telo �l�nku');
define('_TEMPLATE_ITEMFOOTER',		'P�ti�ka �l�nku');
define('_TEMPLATE_MORELINK',		'Odkaz na roz�iruj�c� text');
define('_TEMPLATE_NEW',				'Ozna�enie nov�ho �l�nku');
define('_TEMPLATE_COMMENTS_ANY',	'Koment�re (ak s�)');
define('_TEMPLATE_CHEADER',			'Hlavi�ka koment�ra');
define('_TEMPLATE_CBODY',			'Telo koment�ra');
define('_TEMPLATE_CFOOTER',			'P�ti�ka koment�ra');
define('_TEMPLATE_CONE',			'Jeden koment�r');
define('_TEMPLATE_CMANY',			'Dva (a viac) koment�rov');
define('_TEMPLATE_CMORE',			'\'��ta� viac\' pri koment�roch');
define('_TEMPLATE_CMEXTRA',			'Da��ie �daje iba pre �lenov');
define('_TEMPLATE_COMMENTS_NONE',	'Koment�re (ak nejak� s�)');
define('_TEMPLATE_CNONE',			'�iadne koment�re');
define('_TEMPLATE_COMMENTS_TOOMUCH','Koment�re (pokia� s�, ale je ich viac, ne� sa d� zobrazi� priamo)');
define('_TEMPLATE_CTOOMUCH',		'Pr�li� mnoho koment�rov');
define('_TEMPLATE_ARCHIVELIST',		'Zeznam arch�vov');
define('_TEMPLATE_AHEADER',			'Hlavi�ka zoznamu arch�vov');
define('_TEMPLATE_AITEM',			'Polo�ka zoznamu arch�vov');
define('_TEMPLATE_AFOOTER',			'P�ti�ka zoznamu arch�vov');
define('_TEMPLATE_DATETIME',		'D�tum a �as');
define('_TEMPLATE_DHEADER',			'Hlavi�ka d�tumu');
define('_TEMPLATE_DFOOTER',			'P�ti�ka d�tumu');
define('_TEMPLATE_DFORMAT',			'Form�t d�tumu');
define('_TEMPLATE_TFORMAT',			'Form�t �asu');
define('_TEMPLATE_LOCALE',			'Miestne nastavenie');
define('_TEMPLATE_IMAGE',			'Okna s obr�zkom');
define('_TEMPLATE_PCODE',			'K�d odkazu pre okn� s obr�zkom');
define('_TEMPLATE_ICODE',			'K�d pro vlo�n� obr�zok');
define('_TEMPLATE_MCODE',			'K�d odkazu na soubor m�di�');
define('_TEMPLATE_SEARCH',			'H�adanie');
define('_TEMPLATE_SHIGHLIGHT',		'Zv�raznenie');
define('_TEMPLATE_SNOTFOUND',		'Pri h�adan� nebolo ni� n�jden�');
define('_TEMPLATE_UPDATE',			'Upravi�');
define('_TEMPLATE_UPDATE_BTN',		'Upravi� �abl�nu');
define('_TEMPLATE_RESET_BTN',		'P�vodn� d�ta');
define('_TEMPLATE_CATEGORYLIST',	'Zoznamy kateg�ri�');
define('_TEMPLATE_CATHEADER',		'Hlavi�ka zoznamu kateg�ri�');
define('_TEMPLATE_CATITEM',			'Polo�ka zoznamu kateg�ri�');
define('_TEMPLATE_CATFOOTER',		'P�ti�ka zoznamu kateg�ri�');

// skins
define('_SKIN_EDIT_TITLE',			'Upravi� vzh�ady');
define('_SKIN_AVAILABLE_TITLE',		'Dostupn� vzh�ady');
define('_SKIN_NEW_TITLE',			'Nov� vzh�ad');
define('_SKIN_NAME',				'N�zov');
define('_SKIN_DESC',				'Popis');
define('_SKIN_TYPE',				'Typ obsahu');
define('_SKIN_CREATE',				'Vytvori�');
define('_SKIN_CREATE_BTN',			'Vytvori� vzh�ad');
define('_SKIN_EDITONE_TITLE',		'Upravi� vzh�ad');
define('_SKIN_BACK',				'Sp� na preh�ad vzh�adov');
define('_SKIN_PARTS_TITLE',			'�asti vzh�adu');
define('_SKIN_PARTS_MSG',			'Pre ka�d� vzh�ad nie s� potrebn� v�etky typy. Tie, ktor� nepotrebujete, nechajte pr�zdne. Zvo�te typ vzh�adu, ktor� chcete upravi�::');
define('_SKIN_PART_MAIN',			'Hlavn� preh�ad');
define('_SKIN_PART_ITEM',			'Str�nky �l�nkov');
define('_SKIN_PART_ALIST',			'Zoznam arch�vov');
define('_SKIN_PART_ARCHIVE',		'Arch�v');
define('_SKIN_PART_SEARCH',			'H�adanie');
define('_SKIN_PART_ERROR',			'Chyby');
define('_SKIN_PART_MEMBER',			'Detaily reg. u��vate�a');
define('_SKIN_PART_POPUP',			'Okna s obr�zkom');
define('_SKIN_GENSETTINGS_TITLE',	'V�eobecn� nastavenia');
define('_SKIN_CHANGE',				'Zmeni�');
define('_SKIN_CHANGE_BTN',			'Zmeni� tieto nastavenia');
define('_SKIN_UPDATE_BTN',			'Ulo�i� vzh�ad');
define('_SKIN_RESET_BTN',			'P�vodn� d�ta');
define('_SKIN_EDITPART_TITLE',		'Upravi� vzh�ad');
define('_SKIN_GOBACK',				'Sp�');
define('_SKIN_ALLOWEDVARS',			'Dostupn� premenn� (kliknite pre bli��ie inform�cie):');

// global settings
define('_SETTINGS_TITLE',			'V�eobecn� nastavenia');
define('_SETTINGS_SUB_GENERAL',		'V�eobecn� nastavenia');
define('_SETTINGS_DEFBLOG',			'�tandardn� blog');
define('_SETTINGS_ADMINMAIL',		'E-mail spr�vcu');
define('_SETTINGS_SITENAME',		'N�zov str�nky');
define('_SETTINGS_SITEURL',			'URL str�nky (malo by kon�i� lom�tkom)');
define('_SETTINGS_ADMINURL',		'URL spr�vcovskej oblasti (malo by kon�i� lom�tkom)');
define('_SETTINGS_DIRS',			'Adres�reNucleusu');
define('_SETTINGS_MEDIADIR',		'Adres�r s m�diami');
define('_SETTINGS_SEECONFIGPHP',	'(vi� config.php)');
define('_SETTINGS_MEDIAURL',		'URL m�di� (malo by kon�i� lom�tkom)');
define('_SETTINGS_ALLOWUPLOAD',		'Povoli� nahr�vanie (upload) souborov?');
define('_SETTINGS_ALLOWUPLOADTYPES','Typy s�borov, ktor� je mo�n� nahra�');
define('_SETTINGS_CHANGELOGIN',		'Povoli� registrovan�m u��vate�om meni� meno/heslo');
define('_SETTINGS_COOKIES_TITLE',	'Nastavenie cookies');
define('_SETTINGS_COOKIELIFE',		'Doba �ivotnosti prihlasovacieho cookie');
define('_SETTINGS_COOKIESESSION',	'Jednorazov� cookies (session)');
define('_SETTINGS_COOKIEMONTH',		'Mesiac');
define('_SETTINGS_COOKIEPATH',		'Cesta cookie (pokro�il�)');
define('_SETTINGS_COOKIEDOMAIN',	'Dom�na cookie (pokro�il�)');
define('_SETTINGS_COOKIESECURE',	'Zabezpe�en� cookie (pokro�il�)');
define('_SETTINGS_LASTVISIT',		'Uklada� cookies poslednej n�v�tevy');
define('_SETTINGS_ALLOWCREATE',		'Povoli� n�v�tevn�kom vytvori� si registrovan� ��et');
define('_SETTINGS_NEWLOGIN',		'Povoli� prihl�senie z ��tov, vytvoren�ch n�v�tevn�kmi');
define('_SETTINGS_NEWLOGIN2',		'(iba pre novo vytvoren� ��ty)');
define('_SETTINGS_MEMBERMSGS',		'Povoli� slu�by medzi �lenmi');
define('_SETTINGS_LANGUAGE',		'�tandardn� jazyk');
define('_SETTINGS_DISABLESITE',		'Vypn�� str�nku');
define('_SETTINGS_DBLOGIN',			'mySQL Login a Datab�za');
define('_SETTINGS_UPDATE',			'Ulo�i� nastavenia');
define('_SETTINGS_UPDATE_BTN',		'Ulo�i� nastavenia');
define('_SETTINGS_DISABLEJS',		'Zak�za� JavaScript Toolbar');
define('_SETTINGS_MEDIA',			'Nastavenia pre m�dia/nahr�v�nie s�borov');
define('_SETTINGS_MEDIAPREFIX',		'Nahran�m s�borom prida� pred meno d�tum');
define('_SETTINGS_MEMBERS',			'Nastavenie registrovan�ch u��vate�om');

// bans
define('_BAN_TITLE',				'Zoznam obmedzen� pr�stupu pre');
define('_BAN_NONE',					'Tento blog nem� �iadne obmedzenia pr�stupu');
define('_BAN_NEW_TITLE',			'Pridat nov� obmedzenie pr�stupu');
define('_BAN_NEW_TEXT',				'Prida� obmedzenie');
define('_BAN_REMOVE_TITLE',			'Odstr�ni� obmedzenie');
define('_BAN_IPRANGE',				'Rozsah IP adries');
define('_BAN_BLOGS',				'Ktor� blogy?');
define('_BAN_DELETE_TITLE',			'Odstr�ni� obmedzenie');
define('_BAN_ALLBLOGS',				'V�etky blogy, ku ktor�m m�te spr�vcovsk� pr�va.');
define('_BAN_REMOVED_TITLE',		'Obmedzenie pr�stupu bolo odstr�nen�');
define('_BAN_REMOVED_TEXT',			'Bolo odstr�nen� obmedzenie pr�stupu pre nasleduj�ce blogy:');
define('_BAN_ADD_TITLE',			'Prida� obmedzenie pr�stupu');
define('_BAN_IPRANGE_TEXT',			'Zadajte rozsah IP adries, ktor� chcete blokova�. ��m men�ie ��sla, t�m viac adries bude blokovan�ch.');
define('_BAN_BLOGS_TEXT',			'M��ete zablokova� rozsah IP adries iba pre jeden blog, alebo pre v�etky blogy, ku ktor�m m�te spr�vcovsk� pr�va.');
define('_BAN_REASON_TITLE',			'D�vod');
define('_BAN_REASON_TEXT',			'M��ete zada� d�vod obmedzenia pr�stupu, ktor� bude zobrazen�, ak sa vlastn�k blokovanej IP adresy pok�si pridat koment�r, alebo odosla� karma hlas. Maxim�lna d�ka je 256 znakov.');
define('_BAN_ADD_BTN',				'Prida� obmedzenie');

// LOGIN screen
define('_LOGIN_MESSAGE',			'Spr�va');
define('_LOGIN_NAME',				'Meno');
define('_LOGIN_PASSWORD',			'Heslo');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'Zabudli ste heslo?');

// membermanagement
define('_MEMBERS_TITLE',			'Spr�va registrovan�ch u��vate�ov');
define('_MEMBERS_CURRENT',			'Aktu�lni u��vatelia');
define('_MEMBERS_NEW',				'Nov� u��vate�');
define('_MEMBERS_DISPLAY',			'Zobrazovan� meno');
define('_MEMBERS_DISPLAY_INFO',		'(Toto je meno, pod ktor�m sa prihlasujete)');
define('_MEMBERS_REALNAME',			'Skuto�n� meno');
define('_MEMBERS_PWD',				'Heslo');
define('_MEMBERS_REPPWD',			'Zopakova� heslo');
define('_MEMBERS_EMAIL',			'E-mailov� adresa');
define('_MEMBERS_EMAIL_EDIT',		'(Ak zmen�te e-mailov� adresu, bude v�m na �u automaticky odoslan� nov� heslo)');
define('_MEMBERS_URL',				'Adresa webovej str�nky (URL)');
define('_MEMBERS_SUPERADMIN',		'Spr�vcovsk� pr�va');
define('_MEMBERS_CANLOGIN',			'M��e sa prihl�si� do spr�vcovskej oblasti');
define('_MEMBERS_NOTES',			'Pozn�mky');
define('_MEMBERS_NEW_BTN',			'Prida� u��vatele');
define('_MEMBERS_EDIT',				'Upravi� u��vate�a');
define('_MEMBERS_EDIT_BTN',			'Ulo�i� nastavenia');
define('_MEMBERS_BACKTOOVERVIEW',	'Sp� na preh�ad u��vate�ov');
define('_MEMBERS_DEFLANG',			'Jazyk');
define('_MEMBERS_USESITELANG',		'- �tandardn� jazyk str�nky -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'Nav�t�vi� str�nku');
define('_BLOGLIST_ADD',				'Prida� �l�nok');
define('_BLOGLIST_TT_ADD',			'Prida� nov� �l�nok do tohto blogu');
define('_BLOGLIST_EDIT',			'Upravi�/odstr�ni� �l�nky');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Bookmarklet');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'Nastavenia');
define('_BLOGLIST_TT_SETTINGS',		'Upravi� nastavenia alebo spravova� t�m');
define('_BLOGLIST_BANS',			'Obmedzenie pr�stupu');
define('_BLOGLIST_TT_BANS',			'Zobrazi�, prida� alebo odstr�ni� blokovan� IP adresy');
define('_BLOGLIST_DELETE',			'Odstr�ni� v�etko');
define('_BLOGLIST_TT_DELETE',		'Odstr�ni� tento blog');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'Sekcia hulan.info');
define('_OVERVIEW_YRDRAFTS',		'Va�e koncepty');
define('_OVERVIEW_YRSETTINGS',		'Va�e nastavenia');
define('_OVERVIEW_GSETTINGS',		'V�eobecn� nastavenia');
define('_OVERVIEW_NOBLOGS',			'Nie ste �lenom t�mu �iadneho z blogov');
define('_OVERVIEW_NODRAFTS',		'�iadne koncepty');
define('_OVERVIEW_EDITSETTINGS',	'Upravi� va�e nastavenia...');
define('_OVERVIEW_BROWSEITEMS',		'Prezera� va�e �l�nky...');
define('_OVERVIEW_BROWSECOMM',		'Prezera� va�e koment�re...');
define('_OVERVIEW_VIEWLOG',			'Prezera� zoznam akci�...');
define('_OVERVIEW_MEMBERS',			'Spr�va reg. u��vate�ov...');
define('_OVERVIEW_NEWLOG',			'Vytvori� nov� blog...');
define('_OVERVIEW_SETTINGS',		'Upravi� nastavenia...');
define('_OVERVIEW_TEMPLATES',		'Upravi� �abl�ny...');
define('_OVERVIEW_SKINS',			'Upravi� vzh�ady...');
define('_OVERVIEW_BACKUP',			'Z�loha/obnova...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'�l�nky pre blog'); 
define('_ITEMLIST_YOUR',			'Va�e �l�nky');

// Comments
define('_COMMENTS',					'Koment�re');
define('_NOCOMMENTS',				'Tento �l�nok nem� �iadne koment�re');
define('_COMMENTS_YOUR',			'Va�e koment�re');
define('_NOCOMMENTS_YOUR',			'Nenap�sal ste �iadne koment�re');

// LISTS (general)
define('_LISTS_NOMORE',				'�iadne da��ie alebo v�bec �iadne v�sledky');
define('_LISTS_PREV',				'Predo�l�');
define('_LISTS_NEXT',				'Da��ie');
define('_LISTS_SEARCH',				'H�ada�');
define('_LISTS_CHANGE',				'Zmeni�');
define('_LISTS_PERPAGE',			'�l�nkov/strana');
define('_LISTS_ACTIONS',			'Akcia');
define('_LISTS_DELETE',				'Odstr�ni�');
define('_LISTS_EDIT',				'Upravi�');
define('_LISTS_MOVE',				'Presun��');
define('_LISTS_CLONE',				'Skop�rova�');
define('_LISTS_TITLE',				'Titulok');
define('_LISTS_BLOG',				'Blog');
define('_LISTS_NAME',				'N�zov');
define('_LISTS_DESC',				'Popis');
define('_LISTS_TIME',				'�as');
define('_LISTS_COMMENTS',			'Koment�re');
define('_LISTS_TYPE',				'Typ');


// member list 
define('_LIST_MEMBER_NAME',			'Zobrazovan� meno');
define('_LIST_MEMBER_RNAME',		'Skuto�n� meno');
define('_LIST_MEMBER_ADMIN',		'Super-spr�vca? ');
define('_LIST_MEMBER_LOGIN',		'M��e sa prihl�si�? ');
define('_LIST_MEMBER_URL',			'Str�nka');

// banlist
define('_LIST_BAN_IPRANGE',			'Rozsah IP adres');
define('_LIST_BAN_REASON',			'D�vod');

// actionlist
define('_LIST_ACTION_MSG',			'Spr�va');

// commentlist
define('_LIST_COMMENT_BANIP',		'Blokova� IP adresu');
define('_LIST_COMMENT_WHO',			'Autor');
define('_LIST_COMMENT',				'Koment�r');
define('_LIST_COMMENT_HOST',		'Server');

// itemlist
define('_LIST_ITEM_INFO',			'Info');
define('_LIST_ITEM_CONTENT',		'Titulok a text');


// teamlist
define('_LIST_TEAM_ADMIN',			'Spr�vca ');
define('_LIST_TEAM_CHADMIN',		'Zmeni� spr�vcu');

// edit comments
define('_EDITC_TITLE',				'Upravi� koment�re');
define('_EDITC_WHO',				'Autor');
define('_EDITC_HOST',				'Odkia�?');
define('_EDITC_WHEN',				'Kedy?');
define('_EDITC_TEXT',				'Text');
define('_EDITC_EDIT',				'Upravi� koment�r');
define('_EDITC_MEMBER',				'�len');
define('_EDITC_NONMEMBER',			'nie je �lenom');

// move item
define('_MOVE_TITLE',				'Presun�� do ak�ho blogu?');
define('_MOVE_BTN',					'Presun�� �l�nok');

?>