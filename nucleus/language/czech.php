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
define('_MEDIA_VIEW_TT',			'Zobrazit soubor (v nov�m okn�)');
define('_MEDIA_FILTER_APPLY',		'Pou��t filtr');
define('_MEDIA_FILTER_LABEL',		'Filtr: ');
define('_MEDIA_UPLOAD_TO',			'Nahr�t do...');
define('_MEDIA_UPLOAD_NEW',			'Nahr�t nov� soubor...');
define('_MEDIA_COLLECTION_SELECT',	'V�b�r');
define('_MEDIA_COLLECTION_TT',		'P�epnout se do t�to kategorie');
define('_MEDIA_COLLECTION_LABEL',	'Aktu�ln� kolekce:: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'Zarovnat doleva');
define('_ADD_ALIGNRIGHT_TT',		'Zarovnat doprava');
define('_ADD_ALIGNCENTER_TT',		'Zarovnat na st�ed');

// searchable blog setting (yes/no)
define('_EBLOG_SEARCH',				'Zahrnout do hled�n�');

// generic upload failure
define('_ERROR_UPLOADFAILED',		'Nahr�v�n� selhalo');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'Povolit publikov�n� do minulosti');
define('_ADD_CHANGEDATE',			'P�epsat datum/�as');
define('_BMLET_CHANGEDATE',			'P�epsat datum/�as');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'Import/export vzhledu...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Norm�ln�');
define('_PARSER_INCMODE_SKINDIR',	'Pou��t adr. vzhledu');
define('_SKIN_INCLUDE_MODE',		'Re�im vkl�d�n�');
define('_SKIN_INCLUDE_PREFIX',		'Prefix');

// global settings
define('_SETTINGS_BASESKIN',		'Z�kladn� vzhled');
define('_SETTINGS_SKINSURL',		'URL se vzhledy');
define('_SETTINGS_ACTIONSURL',		'Pln� URL k action.php');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'Nelze p�esunout v�choz� kategorii');
define('_ERROR_MOVETOSELF',			'Nelze p�esunout kategorii (c�lov� blog je stejn�, jako zdrojov� blog)');
define('_MOVECAT_TITLE',			'Vyberte blog, do kter�ho chcete p�esunout kategorii');
define('_MOVECAT_BTN',				'P�esunout kategorii');

// URLMode setting
define('_SETTINGS_URLMODE',			'Re�im URL');
define('_SETTINGS_URLMODE_NORMAL',	'Norm�ln�');
define('_SETTINGS_URLMODE_PATHINFO','Pestr�');

// Batch operations
define('_BATCH_NOSELECTION',		'Pro proveden� akce nen� nic vybr�no');
define('_BATCH_ITEMS',				'D�vkov� operace na �l�nc�ch');
define('_BATCH_CATEGORIES',			'D�vkov� operace na kategori�ch');
define('_BATCH_MEMBERS',			'D�vkov� operace na u�ivatel�ch');
define('_BATCH_TEAM',				'D�vkov� operace na �lenech t�mu');
define('_BATCH_COMMENTS',			'D�vkov� operace na koment���ch');
define('_BATCH_UNKNOWN',			'Nezn�m� d�vkov� operace: ');
define('_BATCH_EXECUTING',			'Spou�t� se');
define('_BATCH_ONCATEGORY',			'na kategorii');
define('_BATCH_ONITEM',				'na �l�nku');
define('_BATCH_ONCOMMENT',			'na koment��i');
define('_BATCH_ONMEMBER',			'na u�ivateli');
define('_BATCH_ONTEAM',				'na �lenovi t�mu');
define('_BATCH_SUCCESS',			'�sp�ch!');
define('_BATCH_DONE',				'Hotovo!');
define('_BATCH_DELETE_CONFIRM',		'Potvr�te d�vkov� odstran�n�');
define('_BATCH_DELETE_CONFIRM_BTN',	'Potvr�te d�vkov� odstran�n�');
define('_BATCH_SELECTALL',			'vybrat v�e');
define('_BATCH_DESELECTALL',		'nevybrat nic');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'Odstranit');
define('_BATCH_ITEM_MOVE',			'P�esunout');
define('_BATCH_MEMBER_DELETE',		'Odstranit');
define('_BATCH_MEMBER_SET_ADM',		'Nastavit spr�vcovsk� pr�va');
define('_BATCH_MEMBER_UNSET_ADM',	'Odebrat spr�vcovsk� pr�va');
define('_BATCH_TEAM_DELETE',		'Odstranit z t�mu');
define('_BATCH_TEAM_SET_ADM',		'Nastavit spr�vcovsk� pr�va');
define('_BATCH_TEAM_UNSET_ADM',		'Odebrat spr�vcovsk� pr�va');
define('_BATCH_CAT_DELETE',			'Odstranit');
define('_BATCH_CAT_MOVE',			'P�esunout do jin�ho blogu');
define('_BATCH_COMMENT_DELETE',		'Odstranit');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'P�idat nov� �l�nek...');
define('_ADD_PLUGIN_EXTRAS',		'Nastaven� pro pluginy');

// errors
define('_ERROR_CATCREATEFAIL',		'Nelze vytvo�it novou kategorii');
define('_ERROR_NUCLEUSVERSIONREQ',	'Tento plugin vy�aduje nov�j�� verzi Nucleusu: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Zp�t na nastaven� blogu');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Import');
define('_SKINIE_TITLE_EXPORT',		'Export');
define('_SKINIE_BTN_IMPORT',		'Import');
define('_SKINIE_BTN_EXPORT',		'Export vybran�ch vzhled�/�ablon');
define('_SKINIE_LOCAL',				'Import z lok�ln�ho souboru:');
define('_SKINIE_NOCANDIDATES',		'V adres��i vzhled� nebyly nalezeny ��dn� polo�ky pro import');
define('_SKINIE_FROMURL',			'Import z URL:');
define('_SKINIE_EXPORT_INTRO',		'Vyberte vzhledy a �ablony, kter� chcete exportovat');
define('_SKINIE_EXPORT_SKINS',		'Vzhledy');
define('_SKINIE_EXPORT_TEMPLATES',	'�ablony');
define('_SKINIE_EXPORT_EXTRA',		'Extra info');
define('_SKINIE_CONFIRM_OVERWRITE',	'P�epsat vzhledy, kter� ji� existuj� (viz konflikty jmen)');
define('_SKINIE_CONFIRM_IMPORT',	'Ano, toto chci naimportovat');
define('_SKINIE_CONFIRM_TITLE',		'Budou naimportov�ny vzhledy a �ablony');
define('_SKINIE_INFO_SKINS',		'Vzhledy v souboru:');
define('_SKINIE_INFO_TEMPLATES',	'�ablony v souboru:');
define('_SKINIE_INFO_GENERAL',		'Info:');
define('_SKINIE_INFO_SKINCLASH',	'Konflikty v n�zvech vzhled�:');
define('_SKINIE_INFO_TEMPLCLASH',	'Konflikty v n�zvech �ablon:');
define('_SKINIE_INFO_IMPORTEDSKINS','Importovan� vzhledy:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Importovan� �ablony::');
define('_SKINIE_DONE',				'Import dokon�en');

define('_AND',						'a');
define('_OR',						'nebo');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'pr�zdn� pole (klikn�te pro editaci)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'Re�im vkl�d�n�:');
define('_LIST_SKINS_INCPREFIX',		'Prefix:');
define('_LIST_SKINS_DEFINED',		'Definovan� ��sti:');

// backup
define('_BACKUPS_TITLE',			'Z�loha / obnoven�');
define('_BACKUP_TITLE',				'Z�loha');
define('_BACKUP_INTRO',				'Klikn�te na tla��tko pro vytvo�en� z�lohy Nucleus datab�ze. Budete vyzv�n k ulo�en� souboru se z�lohou. Tento soubor pot� uschovejte na bezpe�n�m m�st�.');
define('_BACKUP_ZIP_YES',			'Pokusit se pou��t kompresi');
define('_BACKUP_ZIP_NO',			'Nepou��vat kompresi');
define('_BACKUP_BTN',				'Vytvo�it z�lohu');
define('_BACKUP_NOTE',				'<b>Pozn�mka:</b> Z�lohuje se pouze obsah datab�ze. Obr�zky a nastaven� v config.php tud� <b>NEJSOU</b> sou��st� z�lohy.');
define('_RESTORE_TITLE',			'Obnovit');
define('_RESTORE_NOTE',				'<b>POZOR:</b> Obnova ze z�lohy <b>VYMA�E</b> st�vaj�c� data v datab�zi! Tuto akci prove�te pouze pokud jste si opravdu jist�!	<br />	<b>Pozn�mka:</b> Ujist�te se, �e verze Nucleusu, ve kter� jste provedl z�lohu, je stejn�, jako verze, kterou pou��v�te nyn�! Jinak obnova nebude fungovat.');
define('_RESTORE_INTRO',			'Zde vyberte soubor se z�lohou (bude nahr�n na server) a klikn�te na tla��tko "Obnovit" pro zah�jen� akce.');
define('_RESTORE_IMSURE',			'Ano, jsem si jist�, �e to chci ud�lat!');
define('_RESTORE_BTN',				'Obnovit ze souboru');
define('_RESTORE_WARNING',			'(ujist�te se, �e obnovujete spr�vnou z�lohu, p��padn� si nejprve zaz�lohujte st�vaj�c� data)');
define('_ERROR_BACKUP_NOTSURE',		'Mus�te za�krtnout pol��ko \'Jsem si jist�\'');
define('_RESTORE_COMPLETE',			'Obnova byla dokon�ena');

// new item notification
define('_NOTIFY_NI_MSG',			'Byl publikov�n nov� �l�nek:');
define('_NOTIFY_NI_TITLE',			'Nov� �l�nek!');
define('_NOTIFY_KV_MSG',			'Karma volba u �l�nku:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'Koment�� ke �l�nku:');
define('_NOTIFY_NC_TITLE',			'Nucleus koment��:');
define('_NOTIFY_USERID',			'ID u�ivatele:');
define('_NOTIFY_USER',				'U�ivatel:');
define('_NOTIFY_COMMENT',			'Koment��:');
define('_NOTIFY_VOTE',				'Volba:');
define('_NOTIFY_HOST',				'Server:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'�len:');
define('_NOTIFY_TITLE',				'Nadpis:');
define('_NOTIFY_CONTENTS',			'Text:');

// member mail message
define('_MMAIL_MSG',				'Obdr�el jste novou zpr�vu od');
define('_MMAIL_FROMANON',			'anonymn�ho n�v�t�vn�ka');
define('_MMAIL_FROMNUC',			'Odesl�no v syst�mu Nucleus weblog v');
define('_MMAIL_TITLE',				'Zpr�va od');
define('_MMAIL_MAIL',				'Zpr�va:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'P�idat �l�nek');
define('_BMLET_EDIT',				'Upravit �l�nek');
define('_BMLET_DELETE',				'Odstranit �l�nek');
define('_BMLET_BODY',				'Text');
define('_BMLET_MORE',				'Roz���en� text');
define('_BMLET_OPTIONS',			'Volby');
define('_BMLET_PREVIEW',			'N�hled');

// used in bookmarklet
define('_ITEM_UPDATED',				'�l�nek byl upraven');
define('_ITEM_DELETED',				'�l�nek byl odstran�n');

// plugins
define('_CONFIRMTXT_PLUGIN',		'Skute�n� chcete odstranit plugin');
define('_ERROR_NOSUCHPLUGIN',		'Takov� plugin neexistuje');
define('_ERROR_DUPPLUGIN',			'Tento plugin ji� byl nainstalov�n');
define('_ERROR_PLUGFILEERROR',		'Plugin neexistuje, nebo jsou �patn� nastavena p��stupov� pr�va');
define('_PLUGS_NOCANDIDATES',		'��dn� pluginy nebyly nalezeny');

define('_PLUGS_TITLE_MANAGE',		'Spr�va plugin�');
define('_PLUGS_TITLE_INSTALLED',	'Moment�ln� nainstalovan�');
define('_PLUGS_TITLE_UPDATE',		'Aktualizovat seznam odb�r�');
define('_PLUGS_TEXT_UPDATE',		'Nucleus si udr�uje datab�zi odb�r� ud�lost� pro pluginy. Pokud nahrajete novou verzi pluginu, m�l byste spustit tuto aktualizaci, aby byly odb�ry obnoveny.');
define('_PLUGS_TITLE_NEW',			'Nainstalovat nov� plugin');
define('_PLUGS_ADD_TEXT',			'Dole vid�te seznam soubor� z adres��e plugin�, kter� jsou patrn� nenainstalovan� pluginy. P�ed jejich nainstalov�n�m se ujist�te, �e to jsou <strong>ur�it�</strong> pluginy.');
define('_PLUGS_BTN_INSTALL',		'Nainstalovat plugin');
define('_BACKTOOVERVIEW',			'Zp�tky k p�ehledu');

// editlink
define('_TEMPLATE_EDITLINK',		'Odkaz na editaci �l�nku');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'P�idat r�me�ek vlevo');
define('_ADD_RIGHT_TT',				'P�idat r�me�ek vpravo');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'Nov� kategorie...');

// new settings
define('_SETTINGS_PLUGINURL',		'URL s pluginy');
define('_SETTINGS_MAXUPLOADSIZE',	'Max. velikost souboru pro nahr�n� (bytes)');
define('_SETTINGS_NONMEMBERMSGS',	'Povolit neregistrovan�m pos�lat zpr�vy');
define('_SETTINGS_PROTECTMEMNAMES',	'Chr�nit jm�na �len�');

// overview screen
define('_OVERVIEW_PLUGINS',			'Spr�va plugin�...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'Registrace nov�ho �lena:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'Va�e emailov� adresa:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'Nem�te spr�vcovsk� pr�va pro ��dn� z blog�, kter� maj� p��jemce ve sv�m t�mu. Proto nesm�te nahr�vat soubory do adres��e t�to osoby.');

// plugin list
define('_LISTS_INFO',				'Informace');
define('_LIST_PLUGS_AUTHOR',		'Od:');
define('_LIST_PLUGS_VER',			'Verze:');
define('_LIST_PLUGS_SITE',			'Nav�t�vit str�nku');
define('_LIST_PLUGS_DESC',			'Popis:');
define('_LIST_PLUGS_SUBS',			'Odb�ratel t�chto ud�lost�:');
define('_LIST_PLUGS_UP',			'nahoru');
define('_LIST_PLUGS_DOWN',			'dol�');
define('_LIST_PLUGS_UNINSTALL',		'odinstalovat');
define('_LIST_PLUGS_ADMIN',			'spr�vce');
define('_LIST_PLUGS_OPTIONS',		'upravit&nbsp;nastaven�');

// plugin option list
define('_LISTS_VALUE',				'Hodnota');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'tento plugin nem� ��dn� nastaven�');
define('_PLUGS_BACK',				'Zp�t na p�ehled plugin�');
define('_PLUGS_SAVE',				'Ulo�it nastaven�');
define('_PLUGS_OPTIONS_UPDATED',	'Nastaven� pluginu byla upravena');

define('_OVERVIEW_MANAGEMENT',		'Spr�va');
define('_OVERVIEW_MANAGE',			'Spr�va Nucleusu...');
define('_MANAGE_GENERAL',			'Obecn� nastaven�');
define('_MANAGE_SKINS',				'Vzhled a �ablony');
define('_MANAGE_EXTRA',				'Extra volby');

define('_BACKTOMANAGE',				'Zp�t na spr�vu Nucleusu');


// END introduced after v1.1 END




// charset to use 
define('_CHARSET',					'windows-1250');

// global stuff
define('_LOGOUT',					'Odhl�sit se');
define('_LOGIN',					'P�ihl�sit se');
define('_YES',						'Ano');
define('_NO',						'Ne');
define('_SUBMIT',					'Odeslat');
define('_ERROR',					'Chyba');
define('_ERRORMSG',					'Vyskytla se chyba!');
define('_BACK',						'Zp�t');
define('_NOTLOGGEDIN',				'Nejste p�ihl�en');
define('_LOGGEDINAS',				'P�ihl�en jako');
define('_ADMINHOME',				'Spr�vce');
define('_NAME',						'Jm�no');
define('_BACKHOME',					'Zp�t na spr�vcovskou str�nku');
define('_BADACTION',				'Byla po�adov�na neexistuj�c� akce');
define('_MESSAGE',					'Zpr�va');
define('_HELP_TT',					'Pomoc!');
define('_YOURSITE',					'Va�e str�nka');


define('_POPUP_CLOSE',				'Zav��t okno');

define('_LOGIN_PLEASE',				'Pros�m, nejprve se p�ihla�te');

// commentform
define('_COMMENTFORM_YOUARE',		'Jste');
define('_COMMENTFORM_SUBMIT',		'P�idat koment��');
define('_COMMENTFORM_COMMENT',		'V� koment��');
define('_COMMENTFORM_NAME',			'Jm�no');
define('_COMMENTFORM_MAIL',			'E-mail/HTTP');
define('_COMMENTFORM_REMEMBER',		'Pamatuj si mne');

// loginform
define('_LOGINFORM_NAME',			'Jm�no');
define('_LOGINFORM_PWD',			'Heslo');
define('_LOGINFORM_YOUARE',			'P�ihl�en jako');
define('_LOGINFORM_SHARED',			'Sd�len� po��ta�');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'Poslat zpr�vu');

// search form
define('_SEARCHFORM_SUBMIT',		'Hled�n�');

// add item form
define('_ADD_ADDTO',				'P�idat nov� �l�nek do');
define('_ADD_CREATENEW',			'Vytvo�it nov� �l�nek');
define('_ADD_BODY',					'Text');
define('_ADD_TITLE',				'Nadpis');
define('_ADD_MORE',					'Roz���en� text (voliteln�)');
define('_ADD_CATEGORY',				'Kategorie');
define('_ADD_PREVIEW',				'N�hled');
define('_ADD_DISABLE_COMMENTS',		'Zak�zat koment��e?');
define('_ADD_DRAFTNFUTURE',			'Koncepty a �l�nky pro pozd�j�� publikov�n�');
define('_ADD_ADDITEM',				'P�idat �l�nek');
define('_ADD_ADDNOW',				'P�idat nyn�');
define('_ADD_ADDLATER',				'P�idat pozd�ji');
define('_ADD_PLACE_ON',				'Um�stit na');
define('_ADD_ADDDRAFT',				'P�idat mezi koncepty');
define('_ADD_NOPASTDATES',			'(data a �asy v minulosti NEJSOU platn�, v tom p��pad� bude pou�it aktu�ln� �as)');
define('_ADD_BOLD_TT',				'Tu�n�');
define('_ADD_ITALIC_TT',			'Kurz�va');
define('_ADD_HREF_TT',				'Vytvo�it odkaz');
define('_ADD_MEDIA_TT',				'P�idat obr�zek');
define('_ADD_PREVIEW_TT',			'Zobrazit/skr�t n�hled');
define('_ADD_CUT_TT',				'Vyjmout');
define('_ADD_COPY_TT',				'Kop�rovat');
define('_ADD_PASTE_TT',				'Vlo�it');


// edit item form
define('_EDIT_ITEM',				'Upravit �l�nek');
define('_EDIT_SUBMIT',				'Upravit �l�nek');
define('_EDIT_ORIG_AUTHOR',			'P�vodn� autor');
define('_EDIT_BACKTODRAFTS',		'P�idat zp�tky mezi koncepty');
define('_EDIT_COMMENTSNOTE',		'(pozn�mka: zak�z�n� koment��� _neskryje_ d��ve p�idan� koment��e)');

// used on delete screens
define('_DELETE_CONFIRM',			'Pros�m, potvr�te odstran�n�');
define('_DELETE_CONFIRM_BTN',		'Potvrzen� odstran�n�');
define('_CONFIRMTXT_ITEM',			'Chyst�te se odstranit n�sleduj�c� �l�nek:');
define('_CONFIRMTXT_COMMENT',		'Chyst�te se odstranit n�sleduj�c� koment��:');
define('_CONFIRMTXT_TEAM1',			'Chyst�te se odstranit u�ivatele ');
define('_CONFIRMTXT_TEAM2',			' z t�mu pro blog ');
define('_CONFIRMTXT_BLOG',			'Blog, kter� hodl�te odstranit, je: ');
define('_WARNINGTXT_BLOGDEL',		'Pozor! Odstran�n�m blogu dojde k vymaz�n� V�ECH �l�nk� tohoto blogu a v�ech koment���. Pros�m, potvr�te, �e to OPRAVDU chcete ud�lat!<br />B�hem odstra�ov�n� blogu nep�eru�ujte Nucleus.');
define('_CONFIRMTXT_MEMBER',		'Chyst�te se odstranit profil n�sleduj�c�ho �lena: ');
define('_CONFIRMTXT_TEMPLATE',		'Chyst�te se odstranit �ablonu ');
define('_CONFIRMTXT_SKIN',			'Chyst�te se odstranit vzhled ');
define('_CONFIRMTXT_BAN',			'Chyst�te se odstranit omezen� p��stupu pro ip adresy');
define('_CONFIRMTXT_CATEGORY',		'Chyst�te se odstranit kategorii ');

// some status messages
define('_DELETED_ITEM',				'�l�nek odstran�n');
define('_DELETED_MEMBER',			'Reg. u�ivatel odstran�n');
define('_DELETED_COMMENT',			'Koment�� odstran�n');
define('_DELETED_BLOG',				'Blog odstran�n');
define('_DELETED_CATEGORY',			'Kategorie odstran�na');
define('_ITEM_MOVED',				'�l�nek p�esunut');
define('_ITEM_ADDED',				'�l�nek p�id�n');
define('_COMMENT_UPDATED',			'Koment�� upraven');
define('_SKIN_UPDATED',				'Vzhled byl ulo�en');
define('_TEMPLATE_UPDATED',			'�ablona byla ulo�ena');

// errors
define('_ERROR_COMMENT_LONGWORD',	'Pros�m, v koment���ch nepou��vejte slova del�� ne� 90 znak�');
define('_ERROR_COMMENT_NOCOMMENT',	'Pros�m, vlo�te koment��');
define('_ERROR_COMMENT_NOUSERNAME',	'�patn� u�ivatelsk� jm�no');
define('_ERROR_COMMENT_TOOLONG',	'V� koment�� je p��li� dlouh� (max. 5000 znak�)');
define('_ERROR_COMMENTS_DISABLED',	'Koment��e pro tento blog jsou moment�ln� zak�z�ny.');
define('_ERROR_COMMENTS_NONPUBLIC',	'Abyste mohl p�id�vat koment��e do tohoto blogu, mus�te b�t p�ihl�en');
define('_ERROR_COMMENTS_MEMBERNICK','Jm�no, pod kter�m chcete odeslat koment��, pou��v� jin� registrovan� u�ivatel. Pou�ijte n�jak� jin�.');
define('_ERROR_SKIN',				'Chyba v definici vzhledu');
define('_ERROR_ITEMCLOSED',			'Tento �l�nek byl uzav�en. U� nen� mo�n� k n�mu p�id�vat koment��e ani hlasovat');
define('_ERROR_NOSUCHITEM',			'�l�nek nenalezen');
define('_ERROR_NOSUCHBLOG',			'Blog nenalezen');
define('_ERROR_NOSUCHSKIN',			'Vzhled nenalezen');
define('_ERROR_NOSUCHMEMBER',		'Registrovan� u�ivatel nenalezen');
define('_ERROR_NOTONTEAM',			'Nejste �lenem t�mu tohoto blogu');
define('_ERROR_BADDESTBLOG',		'C�lov� blog neexistuje');
define('_ERROR_NOTONDESTTEAM',		'Nelze p�esunout �l�nek, proto�e nejste �lenem t�mu c�lov�ho blogu');
define('_ERROR_NOEMPTYITEMS',		'Nelze p�idat pr�zdn� �l�nek!');
define('_ERROR_BADMAILADDRESS',		'Emailov� adresa nen� platn�');
define('_ERROR_BADNOTIFY',			'Jedna nebo v�ce z udan�ch adres pro oznamov�n� nen� platn� emailov� adresa');
define('_ERROR_BADNAME',			'Jm�no nen� platn� (jsou dovoleny pouze znaky a-z a 0-9, ��dn� mezery na za��tku a na konci)');
define('_ERROR_NICKNAMEINUSE',		'Tuto p�ezd�vku ji� pou��v� jin� registrovan� �len');
define('_ERROR_PASSWORDMISMATCH',	'Hesla musej� b�t stejn�');
define('_ERROR_PASSWORDTOOSHORT',	'Heslo by m�lo m�t alespo� 6 znak�');
define('_ERROR_PASSWORDMISSING',	'Heslo nesm� b�t pr�zdn�');
define('_ERROR_REALNAMEMISSING',	'Mus�te vlo�it skute�n� jm�no');
define('_ERROR_ATLEASTONEADMIN',	'M�l by b�t v�dy aspo� jeden super-spr�vce, kter� se m��e p�ihl�sit do spr�vcovsk� sekce.');
define('_ERROR_ATLEASTONEBLOGADMIN','Vykon�n� t�to akce by zp�sobilo, �e by v� blog nem�l kdo spravovat.  Ujist�te se, �e v�dy existuje alespo� jeden spr�vce.');
define('_ERROR_ALREADYONTEAM',		'Nem��ete p�idat u�ivatele, kter� u� je �lenem t�mu');
define('_ERROR_BADSHORTBLOGNAME',	'Kr�tk� jm�no blogu by m�lo obsahovat jen znaky a-z a 0-9, bez mezer');
define('_ERROR_DUPSHORTBLOGNAME',	'Toto kr�tk� jm�no ji� pou��v� jin� blog. Tato jm�na musej� b�t unik�tn�.');
define('_ERROR_UPDATEFILE',			'Nelze zapisovat to update-souboru. Ujist�te se, �e jsou spr�vn� nastavena p��stupov� pr�va (zkuste chmod 666). Tak� pozor na to, �e um�st�n� je relativn� k adres��i spr�vcovsk� oblasti, tak�e byste mohl zkusit absolutn� cestu (n�co jako /your/path/to/nucleus/)');
define('_ERROR_DELDEFBLOG',			'Nelze odstranit v�choz� blog');
define('_ERROR_DELETEMEMBER',		'Tento u�ivatel nem��e b�t odstran�n. Patrn� proto�e je autorem n�jak�ch �l�nk�, nebo koment���.');
define('_ERROR_BADTEMPLATENAME',	'Neplatn� jm�no �ablony. Pou�ijte pouze znaky a-z a 0-9, ��dn� mezery.');
define('_ERROR_DUPTEMPLATENAME',	'Ji� existuje �ablona s t�mto n�zvem.');
define('_ERROR_BADSKINNAME',		'Neplatn� jm�no vzhledu (pou�ijte pouze znaky a-z a 0-9, ��dn� mezery)');
define('_ERROR_DUPSKINNAME',		'Ji� existuje vzhled s t�mto n�zvem.');
define('_ERROR_DEFAULTSKIN',		'Vzhled s n�zvem "default" mus� b�t v�dy dostupn�.');
define('_ERROR_SKINDEFDELETE',		'Nelze odstranit vzhled, proto�e �e to v�choz� vzhled pro n�sleduj�c� blog: ');
define('_ERROR_DISALLOWED',			'Promi�te, ale nejste opr�vn�n prov�d�t tuto akci.');
define('_ERROR_DELETEBAN',			'Chyba p�i odstra�ov�n� omezen� p��stupu (omezen� p��stupu neexistuje)');
define('_ERROR_ADDBAN',				'Chyba p�i p�id�v�n� omezen� p��stupu. Omezen� p��stupu asi nebylo korektn� p�id�no do v�ech blog�.');
define('_ERROR_BADACTION',			'Po�adovan� akce neexistuje');
define('_ERROR_MEMBERMAILDISABLED',	'Mailov� zpr�vy mezi �leny jsou zak�z�ny.');
define('_ERROR_MEMBERCREATEDISABLED','Vytv��en� u�ivatelsk�ch kont je zak�z�no.');
define('_ERROR_INCORRECTEMAIL',		'�patn� mailov� adresa');
define('_ERROR_VOTEDBEFORE',		'Pro tento �l�nek u� jste hlasoval');
define('_ERROR_BANNED1',			'Akci nelze vykonat, proto�e v�m (rozsah adres ');
define('_ERROR_BANNED2',			') byl omezen p��stup. Zpr�va byla: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'Abyste mohl vykonat tuto akci, mus�te se p�ihl�sit.');
define('_ERROR_CONNECT',			'Chyba spojen�');
define('_ERROR_FILE_TOO_BIG',		'Soubor je p��li� velk�!');
define('_ERROR_BADFILETYPE',		'Promi�te, ale tento typ souboru nen� povolen.');
define('_ERROR_BADREQUEST',			'�patn� po�adavek pro nahr�n� souboru');
define('_ERROR_DISALLOWEDUPLOAD',	'Nejste �lenem t�mu ��dn�ho blogu, a proto nem��ete nahr�vat soubory.');
define('_ERROR_BADPERMISSIONS',		'Pr�va pro soubor/adres�� nejsou spr�vn� nastavena');
define('_ERROR_UPLOADMOVEP',		'Chyba p�i p�esunu nahran�ho souboru');
define('_ERROR_UPLOADCOPY',			'Chyba p�i kop�rov�n� souboru');
define('_ERROR_UPLOADDUPLICATE',	'Soubor s t�mto n�zvem ji� existuje. P�ed nahr�n�m ho zkuste p�ejmenovat.');
define('_ERROR_LOGINDISALLOWED',	'Promi�te, ale nem��ete se p�ihl�sit do spr�vcovsk� oblasti. Nicm�n� m��ete se p�ihl�sit jako jin� u�ivatel.');
define('_ERROR_DBCONNECT',			'Nelze se p�ipojit k mySQL serveru');
define('_ERROR_DBSELECT',			'Nelze vybrat datab�zi nucleus.');
define('_ERROR_NOSUCHLANGUAGE',		'Tento jazykov� soubor neexistuje');
define('_ERROR_NOSUCHCATEGORY',		'Takov� kategorie neexistuje');
define('_ERROR_DELETELASTCATEGORY',	'Mus� existovat alespo� jedna kategorie');
define('_ERROR_DELETEDEFCATEGORY',	'Nelze odstranit v�choz� kategorii');
define('_ERROR_BADCATEGORYNAME',	'�patn� n�zev kategorie');
define('_ERROR_DUPCATEGORYNAME',	'Kategorie s t�mto n�zvem u� existuje');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'Pozor: Aktu�ln� hodnota nen� adres��!');
define('_WARNING_NOTREADABLE',		'Pozor: Aktu�ln� hodnota nen� adres�� pro �ten�!');
define('_WARNING_NOTWRITABLE',		'Pozor: Aktu�ln� hodnota NEN� adres��, do kter�ho lze zapisovat!');

// media and upload
define('_MEDIA_UPLOADLINK',			'Nahr�t nov� soubor');
define('_MEDIA_MODIFIED',			'modifikov�n');
define('_MEDIA_FILENAME',			'n�zev souboru');
define('_MEDIA_DIMENSIONS',			'rozm�ry');
define('_MEDIA_INLINE',				'Uvnit�');
define('_MEDIA_POPUP',				'Okno');
define('_UPLOAD_TITLE',				'Zvolte soubor');
define('_UPLOAD_MSG',				'Vyberte soubor pro nahr�n�, a potom stiskn�te tla��tko \'Nahr�t\'.');
define('_UPLOAD_BUTTON',			'Nahr�t');

// some status messages
define('_MSG_ACCOUNTCREATED',		'��et byl vytvo�en. Heslo obdr��te emailem.');
define('_MSG_PASSWORDSENT',			'Heslo v�m bylo odesl�no emailem.');
define('_MSG_LOGINAGAIN',			'Budete se muset znovu p�ihl�sit, proto�e va�e �daje byly zm�n�ny.');
define('_MSG_SETTINGSCHANGED',		'Nastaven� zm�n�na');
define('_MSG_ADMINCHANGED',			'Spr�vce zm�n�n');
define('_MSG_NEWBLOG',				'Nov� blog byl vytvo�en');
define('_MSG_ACTIONLOGCLEARED',		'Log akc� byl smaz�n');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'Nepovolen� akce: ');
define('_ACTIONLOG_PWDREMINDERSENT','Odesl�no nov� heslo pro ');
define('_ACTIONLOG_TITLE',			'Log akc�');
define('_ACTIONLOG_CLEAR_TITLE',	'Smazat log akc�');
define('_ACTIONLOG_CLEAR_TEXT',		'Vymazat log akc�');

// team management
define('_TEAM_TITLE',				'Spr�va t�mu pro blog ');
define('_TEAM_CURRENT',				'Aktu�ln� t�m');
define('_TEAM_ADDNEW',				'P�idat �lena do t�mu');
define('_TEAM_CHOOSEMEMBER',		'Zvolte �lena');
define('_TEAM_ADMIN',				'Spr�vcovsk� pr�va? ');
define('_TEAM_ADD',					'P�idat do t�mu');
define('_TEAM_ADD_BTN',				'P�idat do t�mu');

// blogsettings
define('_EBLOG_TITLE',				'Upravit nastaven� blogu');
define('_EBLOG_TEAM_TITLE',			'Upravit t�m');
define('_EBLOG_TEAM_TEXT',			'Klikn�te zde pro �pravu t�mu...');
define('_EBLOG_SETTINGS_TITLE',		'Nastaven� blogu');
define('_EBLOG_NAME',				'Jm�no blogu');
define('_EBLOG_SHORTNAME',			'Kr�tk� jm�no blogu');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(pouze znaky a-z bez mezer)');
define('_EBLOG_DESC',				'Popis blogu');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'V�choz� vzhled');
define('_EBLOG_DEFCAT',				'V�choz� kategorie');
define('_EBLOG_LINEBREAKS',			'P�ev�d�t od��dkov�n�');
define('_EBLOG_DISABLECOMMENTS',	'Povolit koment��e?<br /><small>(Ur�uje, zda lze p�id�vat koment��e)</small>');
define('_EBLOG_ANONYMOUS',			'Povolit koment��e od neregistrovan�ch n�v�t�vn�k�?');
define('_EBLOG_NOTIFY',				'Adresa/adresy pro oznamov�n� (pou�ijte ; jako odd�lova�)');
define('_EBLOG_NOTIFY_ON',			'Oznamovat zasl�n�');
define('_EBLOG_NOTIFY_COMMENT',		'Nov�ch koment���');
define('_EBLOG_NOTIFY_KARMA',		'Nov�ch karma hlas�');
define('_EBLOG_NOTIFY_ITEM',		'Nov�ch �l�nk� blogu');
define('_EBLOG_PING',				'Ping na Weblogs.com p�i zm�n�ch?');
define('_EBLOG_MAXCOMMENTS',		'Maxim�ln� po�et koment���');
define('_EBLOG_UPDATE',				'Zapsat zm�ny do souboru');
define('_EBLOG_OFFSET',				'�asov� posun');
define('_EBLOG_STIME',				'Aktu�ln� �as serveru je');
define('_EBLOG_BTIME',				'Aktu�ln� �as blogu je');
define('_EBLOG_CHANGE',				'Zm�nit nastaven�');
define('_EBLOG_CHANGE_BTN',			'Zm�nit nastaven�');
define('_EBLOG_ADMIN',				'Spr�vce blogu');
define('_EBLOG_ADMIN_MSG',			'Obdr��te spr�vcovsk� pr�va');
define('_EBLOG_CREATE_TITLE',		'Vytvo�it nov� blog');
define('_EBLOG_CREATE_TEXT',		'Pro vytvo�en� nov�ho blogu vypl�te n�sleduj�c� formul��. <br /><br /> <b>Pozn�mka:</b> Jsou zde vyps�ny pouze nejnutn�j�� volby. Pokud chcete zm�nit dal�� nastaven�, po vytvo�en� blogu nav�tivte str�nku s vlastnostmi blogu.');
define('_EBLOG_CREATE',				'Vytvo�it!');
define('_EBLOG_CREATE_BTN',			'Vytvo�it blog');
define('_EBLOG_CAT_TITLE',			'Kategorie');
define('_EBLOG_CAT_NAME',			'N�zev kategorie');
define('_EBLOG_CAT_DESC',			'Popis kategorie');
define('_EBLOG_CAT_CREATE',			'Vytvo�it novou kategorii');
define('_EBLOG_CAT_UPDATE',			'Upravit kategorii');
define('_EBLOG_CAT_UPDATE_BTN',		'Upravit kategorii');

// templates
define('_TEMPLATE_TITLE',			'Upravit �ablony');
define('_TEMPLATE_AVAILABLE_TITLE',	'Dostupn� �ablony');
define('_TEMPLATE_NEW_TITLE',		'Nov� �ablona');
define('_TEMPLATE_NAME',			'N�zev �ablony');
define('_TEMPLATE_DESC',			'Popis �ablony');
define('_TEMPLATE_CREATE',			'Vytvo�it �ablonu');
define('_TEMPLATE_CREATE_BTN',		'Vytvo�it �ablonu');
define('_TEMPLATE_EDIT_TITLE',		'Upravit �ablonu');
define('_TEMPLATE_BACK',			'Zp�t na p�ehled �ablon');
define('_TEMPLATE_EDIT_MSG',		'Ne v�echny ��sti �ablony jsou vy�adov�ny. Nepot�ebn� ��sti nechte pr�zdn�.');
define('_TEMPLATE_SETTINGS',		'Nastaven� �ablony');
define('_TEMPLATE_ITEMS',			'�l�nky');
define('_TEMPLATE_ITEMHEADER',		'Hlavi�ka �l�nku');
define('_TEMPLATE_ITEMBODY',		'T�lo �l�nku');
define('_TEMPLATE_ITEMFOOTER',		'Pati�ka �l�nku');
define('_TEMPLATE_MORELINK',		'Odkaz na roz�i�uj�c� text');
define('_TEMPLATE_NEW',				'Ozna�en� nov�ho �l�nku');
define('_TEMPLATE_COMMENTS_ANY',	'Koment��e (pokud jsou)');
define('_TEMPLATE_CHEADER',			'Hlavi�ka koment��e');
define('_TEMPLATE_CBODY',			'T�lo koment��e');
define('_TEMPLATE_CFOOTER',			'Pati�ka koment��e');
define('_TEMPLATE_CONE',			'Jeden koment��');
define('_TEMPLATE_CMANY',			'Dva (a v�ce) koment���');
define('_TEMPLATE_CMORE',			'\'��st v�ce\' u koment���');
define('_TEMPLATE_CMEXTRA',			'Dal�� �daje jen pro �leny');
define('_TEMPLATE_COMMENTS_NONE',	'Koment��e (nejsou-li ��dn�)');
define('_TEMPLATE_CNONE',			'��dn� koment��e');
define('_TEMPLATE_COMMENTS_TOOMUCH','Koment��e (pokud jsou, ale je jich v�c, ne� se d� zobrazit p��mo)');
define('_TEMPLATE_CTOOMUCH',		'P��li� mnoho koment���');
define('_TEMPLATE_ARCHIVELIST',		'Seznam archiv�');
define('_TEMPLATE_AHEADER',			'Hlavi�ka seznamu archiv�');
define('_TEMPLATE_AITEM',			'Polo�ka seznamu archiv�');
define('_TEMPLATE_AFOOTER',			'Pati�ka seznamu archiv�');
define('_TEMPLATE_DATETIME',		'Datum a �as');
define('_TEMPLATE_DHEADER',			'Hlavi�ka datumu');
define('_TEMPLATE_DFOOTER',			'Pati�ka datumu');
define('_TEMPLATE_DFORMAT',			'Form�t datumu');
define('_TEMPLATE_TFORMAT',			'Form�t �asu');
define('_TEMPLATE_LOCALE',			'M�stn� nastaven�');
define('_TEMPLATE_IMAGE',			'Okna s obr�zkem');
define('_TEMPLATE_PCODE',			'K�d odkazu pro okna s obr�zkem');
define('_TEMPLATE_ICODE',			'K�d pro vlo�en� obr�zek');
define('_TEMPLATE_MCODE',			'K�d odkazu na soubor m�di�');
define('_TEMPLATE_SEARCH',			'Hled�n�');
define('_TEMPLATE_SHIGHLIGHT',		'Zv�razn�n�');
define('_TEMPLATE_SNOTFOUND',		'P�i hled�n� nebylo nic nalezeno');
define('_TEMPLATE_UPDATE',			'Upravit');
define('_TEMPLATE_UPDATE_BTN',		'Upravit �ablonu');
define('_TEMPLATE_RESET_BTN',		'P�vodn� data');
define('_TEMPLATE_CATEGORYLIST',	'Seznamy kategori�');
define('_TEMPLATE_CATHEADER',		'Hlavi�ka seznamu kategori�');
define('_TEMPLATE_CATITEM',			'Polo�ka seznamu kategori�');
define('_TEMPLATE_CATFOOTER',		'Pati�ka seznamu kategori�');

// skins
define('_SKIN_EDIT_TITLE',			'Upravit vzhledy');
define('_SKIN_AVAILABLE_TITLE',		'Dostupn� vzhledy');
define('_SKIN_NEW_TITLE',			'Nov� vzhled');
define('_SKIN_NAME',				'N�zev');
define('_SKIN_DESC',				'Popis');
define('_SKIN_TYPE',				'Typ obsahu');
define('_SKIN_CREATE',				'Vytvo�it');
define('_SKIN_CREATE_BTN',			'Vytvo�it vzhled');
define('_SKIN_EDITONE_TITLE',		'Upravit vzhled');
define('_SKIN_BACK',				'Zp�t na p�ehled vzhled�');
define('_SKIN_PARTS_TITLE',			'��sti vzhledu');
define('_SKIN_PARTS_MSG',			'Pro ka�d� vzhled nejsou pot�eba v�echny typy. Ty, kter� nepot�ebujete, nechte pr�zdn�. Zvolte typ vzhledu, kter� chcete upravit::');
define('_SKIN_PART_MAIN',			'Hlavn� p�ehled');
define('_SKIN_PART_ITEM',			'Str�nky �l�nku');
define('_SKIN_PART_ALIST',			'Seznam archiv�');
define('_SKIN_PART_ARCHIVE',		'Archiv');
define('_SKIN_PART_SEARCH',			'Hled�n�');
define('_SKIN_PART_ERROR',			'Chyby');
define('_SKIN_PART_MEMBER',			'Detaily reg. u�ivatele');
define('_SKIN_PART_POPUP',			'Okna s obr�zkem');
define('_SKIN_GENSETTINGS_TITLE',	'Obecn� nastaven�');
define('_SKIN_CHANGE',				'Zm�nit');
define('_SKIN_CHANGE_BTN',			'Zm�nit tato nastaven�');
define('_SKIN_UPDATE_BTN',			'Ulo�it vzhled');
define('_SKIN_RESET_BTN',			'P�vodn� data');
define('_SKIN_EDITPART_TITLE',		'Upravit vzhled');
define('_SKIN_GOBACK',				'Zp�t');
define('_SKIN_ALLOWEDVARS',			'Dostupn� prom�nn� (klikn�te pro bli��� informace):');

// global settings
define('_SETTINGS_TITLE',			'Obecn� nastaven�');
define('_SETTINGS_SUB_GENERAL',		'Obecn� nastaven�');
define('_SETTINGS_DEFBLOG',			'V�choz� blog');
define('_SETTINGS_ADMINMAIL',		'Email spr�vce');
define('_SETTINGS_SITENAME',		'N�zev str�nky');
define('_SETTINGS_SITEURL',			'URL str�nky (m�lo by kon�it lom�tkem)');
define('_SETTINGS_ADMINURL',		'URL spr�vcovsk� oblasti (m�lo by kon�it lom�tkem)');
define('_SETTINGS_DIRS',			'Adres��e Nucleusu');
define('_SETTINGS_MEDIADIR',		'Adres�� s m�dii');
define('_SETTINGS_SEECONFIGPHP',	'(viz config.php)');
define('_SETTINGS_MEDIAURL',		'URL m�di� (m�lo by kon�it lom�tkem)');
define('_SETTINGS_ALLOWUPLOAD',		'Povolit nahr�v�n� (upload) soubor�?');
define('_SETTINGS_ALLOWUPLOADTYPES','Typy soubor�, kter� lze nahr�t');
define('_SETTINGS_CHANGELOGIN',		'Povolit registrovan�m u�ivatel�m m�nit jm�no/heslo');
define('_SETTINGS_COOKIES_TITLE',	'Nastaven� cookies');
define('_SETTINGS_COOKIELIFE',		'Doba �ivotnosti p�ihla�ovac�ho cookie');
define('_SETTINGS_COOKIESESSION',	'Jednor�zov� cookies (session)');
define('_SETTINGS_COOKIEMONTH',		'M�s�c');
define('_SETTINGS_COOKIEPATH',		'Cesta cookie (pokro�il�)');
define('_SETTINGS_COOKIEDOMAIN',	'Dom�na cookie (pokro�il�)');
define('_SETTINGS_COOKIESECURE',	'Zabezpe�n� cookie (pokro�il�)');
define('_SETTINGS_LASTVISIT',		'Ukl�dat cookies posledn� n�v�t�vy');
define('_SETTINGS_ALLOWCREATE',		'Povolit n�v�t�vn�k�m vytvo�it si registrovan� ��et');
define('_SETTINGS_NEWLOGIN',		'Povolit p�ihl�en� z ��t�, vytvo�en�ch n�v�t�vn�ky');
define('_SETTINGS_NEWLOGIN2',		'(pouze pro nov� vytvo�en� ��ty)');
define('_SETTINGS_MEMBERMSGS',		'Povolit slu�by mezi �leny');
define('_SETTINGS_LANGUAGE',		'V�choz� jazyk');
define('_SETTINGS_DISABLESITE',		'Vypnout str�nku');
define('_SETTINGS_DBLOGIN',			'mySQL Login a Datab�ze');
define('_SETTINGS_UPDATE',			'Ulo�it nastaven�');
define('_SETTINGS_UPDATE_BTN',		'Ulo�it nastaven�');
define('_SETTINGS_DISABLEJS',		'Zak�zat JavaScript Toolbar');
define('_SETTINGS_MEDIA',			'Nastaven� pro m�dia/nahr�v�n� soubor�');
define('_SETTINGS_MEDIAPREFIX',		'Nahran�m soubor�m p�idat p�ed jm�no datum');
define('_SETTINGS_MEMBERS',			'Nastaven� registrovan�ch u�ivatel�');

// bans
define('_BAN_TITLE',				'Seznam omezen� p��stupu pro');
define('_BAN_NONE',					'Tento blog nem� ��dn� omezen� p��stupu');
define('_BAN_NEW_TITLE',			'P�idat nov� omezen� p��stupu');
define('_BAN_NEW_TEXT',				'P�idat omezen�');
define('_BAN_REMOVE_TITLE',			'Odstranit omezen�');
define('_BAN_IPRANGE',				'Rozsah IP adres');
define('_BAN_BLOGS',				'Kter� blogy?');
define('_BAN_DELETE_TITLE',			'Odstranit omezen�');
define('_BAN_ALLBLOGS',				'V�echny blogy, ke kter�m m�te spr�vcovsk� pr�va.');
define('_BAN_REMOVED_TITLE',		'Omezen� p��stupu bylo odstran�no');
define('_BAN_REMOVED_TEXT',			'Bylo odstran�no omezen� p��stupu pro n�sleduj�c� blogy:');
define('_BAN_ADD_TITLE',			'P�idat omezen� p��stupu');
define('_BAN_IPRANGE_TEXT',			'Zadejte rozsah IP adres, kter� chcete blokovat. ��m men�� ��sla, t�m v�ce adres bude blokov�no.');
define('_BAN_BLOGS_TEXT',			'M��ete zablokovat rozsah IP adres pouze pro jeden blog, nebo pro v�echny blogy, ke kter�m m�te spr�vcovsk� pr�va.');
define('_BAN_REASON_TITLE',			'D�vod');
define('_BAN_REASON_TEXT',			'M��ete zadat d�vod omezen� p��stupu, kter� bude zobrazen, pokud se vlastn�k blokovan� IP adresy pokus� p�idat koment��, nebo odeslat karma hlas. Maxim�ln� d�lka je 256 znak�.');
define('_BAN_ADD_BTN',				'P�idat omezen�');

// LOGIN screen
define('_LOGIN_MESSAGE',			'Zpr�va');
define('_LOGIN_NAME',				'Jm�no');
define('_LOGIN_PASSWORD',			'Heslo');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'Zapomn�l jste heslo?');

// membermanagement
define('_MEMBERS_TITLE',			'Spr�va registrovan�ch u�ivatel�');
define('_MEMBERS_CURRENT',			'Aktu�ln� u�ivatel�');
define('_MEMBERS_NEW',				'Nov� u�ivatel');
define('_MEMBERS_DISPLAY',			'Zobrazovan� jm�no');
define('_MEMBERS_DISPLAY_INFO',		'(Toto je jm�no, pod kter�m se p�ihla�ujete)');
define('_MEMBERS_REALNAME',			'Skute�n� jm�no');
define('_MEMBERS_PWD',				'Heslo');
define('_MEMBERS_REPPWD',			'Zopakovat heslo');
define('_MEMBERS_EMAIL',			'Emailov� adresa');
define('_MEMBERS_EMAIL_EDIT',		'(Pokud zm�n�te emailovou adresu, bude v�m na ni automaticky odesl�no nov� heslo)');
define('_MEMBERS_URL',				'Adresa webov� str�nky (URL)');
define('_MEMBERS_SUPERADMIN',		'Spr�vcovsk� pr�va');
define('_MEMBERS_CANLOGIN',			'M��e se p�ihl�sit do spr�vcovsk� oblasti');
define('_MEMBERS_NOTES',			'Pozn�mky');
define('_MEMBERS_NEW_BTN',			'P�idat u�ivatele');
define('_MEMBERS_EDIT',				'Upravit u�ivatele');
define('_MEMBERS_EDIT_BTN',			'Ulo�it nastaven�');
define('_MEMBERS_BACKTOOVERVIEW',	'Zp�t na p�ehled u�ivatel�');
define('_MEMBERS_DEFLANG',			'Jazyk');
define('_MEMBERS_USESITELANG',		'- v�choz� jazyk str�nky -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'Nav�t�vit str�nku');
define('_BLOGLIST_ADD',				'P�idat �l�nek');
define('_BLOGLIST_TT_ADD',			'P�idat nov� �l�nek do tohoto blogu');
define('_BLOGLIST_EDIT',			'Upravit/odstranit �l�nky');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Bookmarklet');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'Nastaven�');
define('_BLOGLIST_TT_SETTINGS',		'Upravit nastaven� nebo spravovat t�m');
define('_BLOGLIST_BANS',			'Omezen� p��stupu');
define('_BLOGLIST_TT_BANS',			'Zobrazit, p�idat nebo odstranit blokovan� IP adresy');
define('_BLOGLIST_DELETE',			'Odstranit v�e');
define('_BLOGLIST_TT_DELETE',		'Odstranit tento blog');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'Va�e blogy');
define('_OVERVIEW_YRDRAFTS',		'Va�e koncepty');
define('_OVERVIEW_YRSETTINGS',		'Va�e nastaven�');
define('_OVERVIEW_GSETTINGS',		'Obecn� nastaven�');
define('_OVERVIEW_NOBLOGS',			'Nejste �lenem t�mu ��dn�ho z blog�');
define('_OVERVIEW_NODRAFTS',		'��dn� koncepty');
define('_OVERVIEW_EDITSETTINGS',	'Upravit va�e nastaven�...');
define('_OVERVIEW_BROWSEITEMS',		'Prohl�et va�e �l�nky...');
define('_OVERVIEW_BROWSECOMM',		'Prohl�et va�e koment��e...');
define('_OVERVIEW_VIEWLOG',			'Prohl�et seznam akc�...');
define('_OVERVIEW_MEMBERS',			'Spr�va reg. u�ivatel�...');
define('_OVERVIEW_NEWLOG',			'Vytvo�it nov� blog...');
define('_OVERVIEW_SETTINGS',		'Upravit nastaven�...');
define('_OVERVIEW_TEMPLATES',		'Upravit �ablony...');
define('_OVERVIEW_SKINS',			'Upravit vzhledy...');
define('_OVERVIEW_BACKUP',			'Z�loha/obnova...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'�l�nky pro blog'); 
define('_ITEMLIST_YOUR',			'Va�e �l�nky');

// Comments
define('_COMMENTS',					'Koment��e');
define('_NOCOMMENTS',				'Tento �l�nek nem� ��dn� koment��e');
define('_COMMENTS_YOUR',			'Va�e koment��e');
define('_NOCOMMENTS_YOUR',			'Nenapsal jste ��dn� koment��e');

// LISTS (general)
define('_LISTS_NOMORE',				'��dn� dal�� nebo v�bec ��dn� v�sledky');
define('_LISTS_PREV',				'P�edchoz�');
define('_LISTS_NEXT',				'Dal��');
define('_LISTS_SEARCH',				'Hledat');
define('_LISTS_CHANGE',				'Zm�nit');
define('_LISTS_PERPAGE',			'�l�nk�/strana');
define('_LISTS_ACTIONS',			'Akce');
define('_LISTS_DELETE',				'Odstranit');
define('_LISTS_EDIT',				'Upravit');
define('_LISTS_MOVE',				'P�esunout');
define('_LISTS_CLONE',				'Zkop�rovat');
define('_LISTS_TITLE',				'Titulek');
define('_LISTS_BLOG',				'Blog');
define('_LISTS_NAME',				'N�zev');
define('_LISTS_DESC',				'Popis');
define('_LISTS_TIME',				'�as');
define('_LISTS_COMMENTS',			'Koment��e');
define('_LISTS_TYPE',				'Typ');


// member list 
define('_LIST_MEMBER_NAME',			'Zobrazovan� jm�no');
define('_LIST_MEMBER_RNAME',		'Skute�n� jm�no');
define('_LIST_MEMBER_ADMIN',		'Super-spr�vce? ');
define('_LIST_MEMBER_LOGIN',		'M��e se p�ihl�sit? ');
define('_LIST_MEMBER_URL',			'Str�nka');

// banlist
define('_LIST_BAN_IPRANGE',			'Rozsah IP adres');
define('_LIST_BAN_REASON',			'D�vod');

// actionlist
define('_LIST_ACTION_MSG',			'Zpr�va');

// commentlist
define('_LIST_COMMENT_BANIP',		'Blokovat IP adresu');
define('_LIST_COMMENT_WHO',			'Autor');
define('_LIST_COMMENT',				'Koment��');
define('_LIST_COMMENT_HOST',		'Server');

// itemlist
define('_LIST_ITEM_INFO',			'Info');
define('_LIST_ITEM_CONTENT',		'Titulek a text');


// teamlist
define('_LIST_TEAM_ADMIN',			'Spr�vce ');
define('_LIST_TEAM_CHADMIN',		'Zm�nit spr�vce');

// edit comments
define('_EDITC_TITLE',				'Upravit koment��e');
define('_EDITC_WHO',				'Autor');
define('_EDITC_HOST',				'Odkud?');
define('_EDITC_WHEN',				'Kdy?');
define('_EDITC_TEXT',				'Text');
define('_EDITC_EDIT',				'Upravit koment��');
define('_EDITC_MEMBER',				'�len');
define('_EDITC_NONMEMBER',			'nen� �len');

// move item
define('_MOVE_TITLE',				'P�esunout do jak�ho blogu?');
define('_MOVE_BTN',					'P�esunout �l�nek');

?>