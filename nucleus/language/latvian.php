<?php
// Latvian Nucleus Language File
//
// Author: Kaspars Priedols (house@tvertne.nu)
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
define('_MEDIA_VIEW',				'skats');
define('_MEDIA_VIEW_TT',			'Skat�t failu (jaun� log�)');
define('_MEDIA_FILTER_APPLY',		'Pievienot filtru');
define('_MEDIA_FILTER_LABEL',		'Filtrs: ');
define('_MEDIA_UPLOAD_TO',			'Uzlikt uz...');
define('_MEDIA_UPLOAD_NEW',			'Uzlikt jaunu failu...');
define('_MEDIA_COLLECTION_SELECT',	'Izv�l�ties');
define('_MEDIA_COLLECTION_TT',		'P�riet uz sada�u');
define('_MEDIA_COLLECTION_LABEL',	'Pa�reiz�j� kolekcija: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'Kreisaj� pus�');
define('_ADD_ALIGNRIGHT_TT',		'Labaj� pus�');
define('_ADD_ALIGNCENTER_TT',		'Iecentr�ts');

// searchable blog setting (yes/no)
define('_EBLOG_SEARCH',				'Pievienot mekl��anas indeksam');

// generic upload failure
define('_ERROR_UPLOADFAILED',		'K��das rezult�t� fails netika pievienots.');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'At�aut s�t�t ar atpaka�ejo�u datumu');
define('_ADD_CHANGEDATE',			'Izmain�t laiku');
define('_BMLET_CHANGEDATE',			'Izmain�t laiku');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'Noform�juma imports/eksports...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Vienk�r�i');
define('_PARSER_INCMODE_SKINDIR',	'Izmantot skins direktoriju');
define('_SKIN_INCLUDE_MODE',		'Pievieno�anas veids');
define('_SKIN_INCLUDE_PREFIX',		'Pievieno�anas prefikss');

// global settings
define('_SETTINGS_BASESKIN',		'Pamatnoform�jums');
define('_SETTINGS_SKINSURL',		'Noform�juma pakotnes URL');
define('_SETTINGS_ACTIONSURL',		'Pilns URL uz action.php');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'Nevar p�rvietot pamatsada�u');
define('_ERROR_MOVETOSELF',			'Nevar p�rvietot sada�u (abas sada�as ir viens un tas pats)');
define('_MOVECAT_TITLE',			'Izv�lies kura bloga sada�u p�rvietot');
define('_MOVECAT_BTN',				'P�rvietot sada�u');

// URLMode setting
define('_SETTINGS_URLMODE',			'URL re��ms');
define('_SETTINGS_URLMODE_NORMAL',	'Normal');
define('_SETTINGS_URLMODE_PATHINFO','Fancy');

// Batch operations
define('_BATCH_NOSELECTION',		'Nav iez�m�ti objekti');
define('_BATCH_ITEMS',				'Str�d�t ar ierakstiem');
define('_BATCH_CATEGORIES',			'Str�d�t ar sada��m');
define('_BATCH_MEMBERS',			'Str�d�t ar lietot�jiem');
define('_BATCH_TEAM',				'Str�d�t ar lietot�ju grupu');
define('_BATCH_COMMENTS',			'Str�d�t ar koment�riem');
define('_BATCH_UNKNOWN',			'Nepareiza oper�cija: ');
define('_BATCH_EXECUTING',			'Izpild��ana');
define('_BATCH_ONCATEGORY',			'sada�a');
define('_BATCH_ONITEM',				'ieraksts');
define('_BATCH_ONCOMMENT',			'koment�rs');
define('_BATCH_ONMEMBER',			'lietot�js');
define('_BATCH_ONTEAM',				'lietot�ju grupa');
define('_BATCH_SUCCESS',			'Veiksm�gi!');
define('_BATCH_DONE',				'Padar�ts!');
define('_BATCH_DELETE_CONFIRM',		'Apstiprin�t dz��anu');
define('_BATCH_DELETE_CONFIRM_BTN',	'Apstiprin�t dz��anu');
define('_BATCH_SELECTALL',			'iez�m�t visu');
define('_BATCH_DESELECTALL',		'no�emt visus iez�m�jumus');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'Dz�st');
define('_BATCH_ITEM_MOVE',			'P�rvietot');
define('_BATCH_MEMBER_DELETE',		'Dz�st');
define('_BATCH_MEMBER_SET_ADM',		'Pie��irt administratora ties�bas');
define('_BATCH_MEMBER_UNSET_ADM',	'At�emt administratora ties�bas');
define('_BATCH_TEAM_DELETE',		'Dz�st no grupas');
define('_BATCH_TEAM_SET_ADM',		'Pie��irt administratora ties�bas');
define('_BATCH_TEAM_UNSET_ADM',		'At�emt administratora ties�bas');
define('_BATCH_CAT_DELETE',			'Dz�st');
define('_BATCH_CAT_MOVE',			'P�rvietot uz citu blogu');
define('_BATCH_COMMENT_DELETE',		'Dz�st');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'Pievienot jaunu ierakstu...');
define('_ADD_PLUGIN_EXTRAS',		'Pluginu ekstra opcijas');

// errors
define('_ERROR_CATCREATEFAIL',		'Nevar izveidot jaunu sada�u');
define('_ERROR_NUCLEUSVERSIONREQ',	'�� plugina aktiviz��anai nepiecie�ama jaun�ka Nucleus versija: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Atpaka� uz bloga uzst�d�jumiem');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Import�t');
define('_SKINIE_TITLE_EXPORT',		'Eksport�t');
define('_SKINIE_BTN_IMPORT',		'Import�t');
define('_SKINIE_BTN_EXPORT',		'Eksport�t izv�l�tos noform�jumus/sagataves');
define('_SKINIE_LOCAL',				'Import�t no lok�la faila:');
define('_SKINIE_NOCANDIDATES',		'Skins direktorij� nekas import�jams nav atrasts');
define('_SKINIE_FROMURL',			'import�t no URL:');
define('_SKINIE_EXPORT_INTRO',		'Izv�lies noform�jumu un sagataves, kuras eksport�t');
define('_SKINIE_EXPORT_SKINS',		'Noform�jums (skins)');
define('_SKINIE_EXPORT_TEMPLATES',	'Sagataves');
define('_SKINIE_EXPORT_EXTRA',		'Papildus info');
#define('_SKINIE_CONFIRM_OVERWRITE', 'P�rrakst�t jau eksist�jo�us noform�jumus (see nameclashes)');
define('_SKINIE_CONFIRM_OVERWRITE',	'P�rrakst�t jau eksist�jo�us noform�jumus');
define('_SKINIE_CONFIRM_IMPORT',	'J�, import�t');
define('_SKINIE_CONFIRM_TITLE',		'Noform�juma un sagatavju import��ana');
define('_SKINIE_INFO_SKINS',		'Noform�jumi fail�:');
define('_SKINIE_INFO_TEMPLATES',	'Sagataves fail�:');
define('_SKINIE_INFO_GENERAL',		'Info:');
define('_SKINIE_INFO_SKINCLASH',	'Noform�juma nesader�ba (clashes):');
define('_SKINIE_INFO_TEMPLCLASH',	'Sagatavju nosaukumu nesader�ba (clashes):');
define('_SKINIE_INFO_IMPORTEDSKINS','Import�tie noform�jumi:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Import�t�s sagataves:');
define('_SKINIE_DONE',				'Import��ana veiksm�gi paveikta');

define('_AND',						'un');
define('_OR',						'vai');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'tuk�s lauks (klik��ini, lai modific�tu)');

// skin overview list
//
// need to see in reality, then translate.
// will be translated l8r       -Kaspars
//
define('_LIST_SKINS_INCMODE',		'IncludeMode:');
define('_LIST_SKINS_INCPREFIX',		'IncludePrefix:');
define('_LIST_SKINS_DEFINED',		'Defined parts:');

// backup
define('_BACKUPS_TITLE',			'Rezerves kopija / Atjauno�ana');
define('_BACKUP_TITLE',				'Rezerves kopija');
define('_BACKUP_INTRO',				'Klik��ini uz pogas, lai izveidotu Nucleus rezerves kopiju. Rezerves kopija b�s jasaglab� uz tava ciet� diska.');
define('_BACKUP_ZIP_YES',			'Kompres�t');
define('_BACKUP_ZIP_NO',			'Nekompres�t');
define('_BACKUP_BTN',				'Izveidot kopiju');
define('_BACKUP_NOTE',				'<b>Piez�me:</b> Rezerves kopij� tiek uzglab�ti tikai datu b�z� eso�ie dati. Att�li un citi faili <b>NETIEK</b> iek�auti.');
define('_RESTORE_TITLE',			'Atjaunot');
define('_RESTORE_NOTE',				'<b>UZMAN�BU:</b> Atjauno�anas rezult�t� visi Nucleus datu b�z� eso�ie dati tiks <b>DZ�STI</b>, t�p�c vair�kk�rt p�rliecinies, vai ir izveidota rezerves kopija1<br />	<b>Piez�me:</b> Rezerves kopijas datiem j�b�t no t�s pa�as Nucleus versijas, kas pa�laik ir uzinstal�ta pret�j� gad�jum� Nucleus nestr�d�s!');
define('_RESTORE_INTRO',			'Izv�lies attiec�gu failu, no kura atjaunot datu b�zi.');
define('_RESTORE_IMSURE',			'J�, esmu gatavs!');
define('_RESTORE_BTN',				'Atjaunot no faila');
define('_RESTORE_WARNING',			'(v�lreiz p�rliecinies, vai ir izveidota rezerves kopija)');
define('_ERROR_BACKUP_NOTSURE',		'J�iez�m� \'J�, esmu gatavs!\' lauci��');
define('_RESTORE_COMPLETE',			'Atjauno�ana pabeigta');

// new item notification
define('_NOTIFY_NI_MSG',			'Jauns ieraksts:');
define('_NOTIFY_NI_TITLE',			'Jauns!');
// ""wtf is karma here? And how to tranlsate it? :)"  -Kaspars
//define('_NOTIFY_KV_MSG',            'Karma vote on item:');
//define('_NOTIFY_KV_TITLE',            'Nucleus karma:');
define('_NOTIFY_KV_MSG',			'Karma ierakstam:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'Ieraksta koment�rs:');
define('_NOTIFY_NC_TITLE',			'Nucleus koment�rs:');
define('_NOTIFY_USERID',			'Lietot�ja ID:');
define('_NOTIFY_USER',				'Lietot�js:');
define('_NOTIFY_COMMENT',			'Koment�rs:');
define('_NOTIFY_VOTE',				'V�rt�jums:');
define('_NOTIFY_HOST',				'Adrese:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'Lietot�js:');
define('_NOTIFY_TITLE',				'Virsraksts:');
define('_NOTIFY_CONTENTS',			'Saturs:');

// member mail message
define('_MMAIL_MSG',				'Nos�t�jusi');
define('_MMAIL_FROMANON',			'anon�ma persona');
define('_MMAIL_FROMNUC',			'Nos�t�ts no Nucleus [web]bloga');
define('_MMAIL_TITLE',				'V�stule no');
define('_MMAIL_MAIL',				'Zi�a:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',                'Pievienot');
define('_BMLET_EDIT',                'Modific�t');
define('_BMLET_DELETE',                'Dz�st');
define('_BMLET_BODY',                'Papla�in�ti');
define('_BMLET_MORE',                'Vienk�r�i');
define('_BMLET_OPTIONS',            'Opcijas');
define('_BMLET_PREVIEW',            'Apskat�t');

// used in bookmarklet
define('_ITEM_UPDATED',                'Ieraksts izmain�ts');
define('_ITEM_DELETED',                'Ieraksts dz�sts');

// plugins
define('_CONFIRMTXT_PLUGIN',        'Tie��m dz�st pluginu ');
define('_ERROR_NOSUCHPLUGIN',        'Nav t�da plugina');
define('_ERROR_DUPPLUGIN',            'T�ds plugins jau ir');
define('_ERROR_PLUGFILEERROR',        'Nav t�da plugina vai ar� nav piek�uves ties�bu');
define('_PLUGS_NOCANDIDATES',        'Nav atrasts neviens plugins');

define('_PLUGS_TITLE_MANAGE',        'Plugini');
define('_PLUGS_TITLE_INSTALLED',    'Pa�laik akt�vie');
define('_PLUGS_TITLE_UPDATE',        'Atjaunot sarakstu');
define('_PLUGS_TEXT_UPDATE',        'Nucleus saglab� ke�� pluginu sarakstu. Atjaunojot/mainot pluginus, j�p�rliecin�s vai �is saraksts ar� tiek atjaunots');
define('_PLUGS_TITLE_NEW',            'Pievienot pluginus');
define('_PLUGS_ADD_TEXT',            'Zem�k redzams visu pieejamo pluginu saraksts, kas nav uzinstal�ti. V�lreiz papildus p�rliecinies, vai �aj� saraksta atrodamie plugini tie��m ir plugini!');
define('_PLUGS_BTN_INSTALL',        'Instal�t pluginu');
define('_BACKTOOVERVIEW',            'Atpaka� uz aprakstu');

// editlink
define('_TEMPLATE_EDITLINK',        'Modific�t linku');

// add left / add right tooltips
define('_ADD_LEFT_TT',                'Pievienot lodzi�u kreisaj� pus�');
define('_ADD_RIGHT_TT',                'Pievienot lodzi�u labaj� pus�');

// add/edit item: new category (in dropdown box)
// category = sada�a
define('_ADD_NEWCAT',                'Jauna sada�a');

// new settings
define('_SETTINGS_PLUGINURL',        'Plugina URL');
define('_SETTINGS_MAXUPLOADSIZE',    'Max. faila izm�rs (bytes)');
define('_SETTINGS_NONMEMBERMSGS',    'At�aut s�t�t ciemi�iem');
define('_SETTINGS_PROTECTMEMNAMES',    'Aizsarg�t dal�bnieku v�rdus');

// overview screen
define('_OVERVIEW_PLUGINS',            'Administr�t pluginus...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',        'Jauna dal�bnieka re�istr�cija:');

// membermail (when not logged in)
// email = epasts
define('_MEMBERMAIL_MAIL',            'Tava epasta adrese:');

// file upload
//You do not have admin rights on any of the blogs that have the destination member on the //teamlist. Therefor, you\'re not allowed to upload files to this member\'s media directory
define('_ERROR_DISALLOWEDUPLOAD2',    'Tev nav pieejamas upload ties�bas attiec�g� dal�bnieka media katalog�');


// plugin list
define('_LISTS_INFO',                'Inform�cija');
define('_LIST_PLUGS_AUTHOR',        'Autors:');
define('_LIST_PLUGS_VER',            'Versija:');
define('_LIST_PLUGS_SITE',            'M�jas lapa');
define('_LIST_PLUGS_DESC',            'Apraksts:');
define('_LIST_PLUGS_SUBS',            'Tiek pierakst�ts sekojo�iem notikumiem:');
define('_LIST_PLUGS_UP',            'p�rvietot uz aug�u');
define('_LIST_PLUGS_DOWN',            'p�rvietot uz leju');
define('_LIST_PLUGS_UNINSTALL',        'deinstal�t');
define('_LIST_PLUGS_ADMIN',            'admin');
define('_LIST_PLUGS_OPTIONS',        'modific��anas&nbsp;opcijas');

// plugin option list
define('_LISTS_VALUE',                'Iestat�jums');

// plugin options
define('_ERROR_NOPLUGOPTIONS',        '�im pluginam pa�laik nav neviena iestat�juma');
define('_PLUGS_BACK',                'Atpaka� uz plugina aprakstu');
define('_PLUGS_SAVE',                'Saglab�t izmai�as');
define('_PLUGS_OPTIONS_UPDATED',    'Plugina opcijas saglab�tas');

define('_OVERVIEW_MANAGEMENT',        'Mened�ments');
define('_OVERVIEW_MANAGE',            'Nucleus mened�ments...');
define('_MANAGE_GENERAL',            'Galvenais mened�ments');
define('_MANAGE_SKINS',                'T�mas un veidnes');
define('_MANAGE_EXTRA',                'Extra f��as');

define('_BACKTOMANAGE',                'Atpaka� uz Nucleus mened�mentu');


// END introduced after v1.1 END




// charset to use
define('_CHARSET',                    'windows-1257');

// global stuff
define('_LOGOUT',                    'Atsl�gties');
define('_LOGIN',                    'Piesl�gties');
define('_YES',                        'J�');
define('_NO',                        'N�');
define('_SUBMIT',                    'Apstiprin�t');
define('_ERROR',                    'K��da');
define('_ERRORMSG',                    'K��da!');
define('_BACK',                        'Atgriezties');
define('_NOTLOGGEDIN',                'Nav piesl�guma');
define('_LOGGEDINAS',                'Piesl�dzies k�');
define('_ADMINHOME',                'Admina sada�a');
define('_NAME',                        'V�rds/nosaukums');
define('_BACKHOME',                    'Atpaka� uz admina sada�u');
define('_BADACTION',                'Piepras�jumu nav iesp�jams izpild�t');
define('_MESSAGE',                    'Zi�ojums');
define('_HELP_TT',                    'Pal�g�!');
define('_YOURSITE',                    'Galven� lapa');


define('_POPUP_CLOSE',                'Aizv�rt logu');

define('_LOGIN_PLEASE',                'Vispirms piesl�dzies sist�mai');

// commentform
define('_COMMENTFORM_YOUARE',        'Tu esi');
define('_COMMENTFORM_SUBMIT',        'Koment�t');
define('_COMMENTFORM_COMMENT',        'Tavs koment�rs');
define('_COMMENTFORM_NAME',            'V�rds');
define('_COMMENTFORM_MAIL',            'Epasts/HTTP');
define('_COMMENTFORM_REMEMBER',        'Atcer�ties mani turpm�k');

// loginform
define('_LOGINFORM_NAME',            'Dal�bnieks');
define('_LOGINFORM_PWD',            'Parole');
define('_LOGINFORM_YOUARE',            'Piesl�dzies k�');
define('_LOGINFORM_SHARED',            'Koplieto�anas dators (piem. e-cafe)');

// member mailform
define('_MEMBERMAIL_SUBMIT',        'Nos�t�t');

// search form
define('_SEARCHFORM_SUBMIT',        'Mekl�t');

// add item form
define('_ADD_ADDTO',                'Pievienot pie');
define('_ADD_CREATENEW',            'Izveidot jaunu');
define('_ADD_BODY',                    'Teksts');
define('_ADD_TITLE',                'Virsraksts');
define('_ADD_MORE',                    'Pievienot tekstu (nav oblig�ti)');
define('_ADD_CATEGORY',                'Sada�a (J�IZV�LAS SAV�J�!)');
define('_ADD_PREVIEW',                'Apskat�t');
define('_ADD_DISABLE_COMMENTS',        'Atsl�gt koment�rus?');
define('_ADD_DRAFTNFUTURE',            'Sagataves n�kotnei');
define('_ADD_ADDITEM',                'Pievienot');
define('_ADD_ADDNOW',                'Pievienot tagad');
define('_ADD_ADDLATER',                'Pievienot v�l�k');
define('_ADD_PLACE_ON',                'Vieta');
define('_ADD_ADDDRAFT',                'Pievienot sagatav�m');
define('_ADD_NOPASTDATES',            '(pag�tnes datumi un laiki nav iesp�jami, �aj� gad�jum� tiks lietots ��br��a laiks)');
define('_ADD_BOLD_TT',                'Treknrakst�');
define('_ADD_ITALIC_TT',            'Sl�prakst�');
define('_ADD_HREF_TT',                'Haiperlinks');
define('_ADD_MEDIA_TT',                'Pievienot m�diju');
define('_ADD_PREVIEW_TT',            'Par�d�t/pasl�pt to, k� izskat�sies');
define('_ADD_CUT_TT',                'Iz�emt');
define('_ADD_COPY_TT',                'Kop�t');
define('_ADD_PASTE_TT',                'Iel�m�t (paste)');


// edit item form
define('_EDIT_ITEM',                'Modific�t');
define('_EDIT_SUBMIT',                'Modific�t');
define('_EDIT_ORIG_AUTHOR',            'Ori�in�la autors');
define('_EDIT_BACKTODRAFTS',        'Pievienot atpaka�, sagatav�s');
define('_EDIT_COMMENTSNOTE',        '(piez�me: visi iepriek� ierakst�tie koment�ri netiks pasl�pti)');


// used on delete screens
define('_DELETE_CONFIRM',            'L�dzu apstiprini dz��anu');
define('_DELETE_CONFIRM_BTN',        'Apstiprin�t');
define('_CONFIRMTXT_ITEM',            'Tu v�lies izdz�st sekojo�u zi�u:');
define('_CONFIRMTXT_COMMENT',        'Tu v�lies izdz�st sekojo�u koment�ru:');
define('_CONFIRMTXT_TEAM1',            'Tu v�lies izdz�st ');
define('_CONFIRMTXT_TEAM2',            ' no dal�bnieku komandas ');
define('_CONFIRMTXT_BLOG',            'Tiks izdz�sts sekojo�s blogs: ');
define('_WARNINGTXT_BLOGDEL',        'UZMAN�BU! Tiks izdz�sts gan pats blogs, gan visi t� koment�ri. P�rleicinies, vai tie��m to v�lies.<br />Un, l�dzu, nep�rtrauc procesu, kad notiks dz��ana!');

define('_CONFIRMTXT_MEMBER',        'Tu v�lies dz�st sekojo�a dal�bnieka datus: ');
define('_CONFIRMTXT_TEMPLATE',        'Tu v�lies dz�st veidni ');
define('_CONFIRMTXT_SKIN',            'Tu v�lies dz�st t�mu ');
define('_CONFIRMTXT_BAN',            'Tu v�lies dz�st aizliegumu sekojo�am IP adre�u apgabalam');
define('_CONFIRMTXT_CATEGORY',        'Tu v�lies dz�st sada�u ');

// some status messages
define('_DELETED_ITEM',                'Zi�a tika izdz�sta');
define('_DELETED_MEMBER',            'Dal�bnieks tika izdz�sta');
define('_DELETED_COMMENT',            'Koment�ri tika izdz�sti');
define('_DELETED_BLOG',                'Blogs tika izdz�sts');
define('_DELETED_CATEGORY',            'Sada�a tika izdz�sta');
define('_ITEM_MOVED',                'Zi�a tika veiksm�gi p�rvietota');
define('_ITEM_ADDED',                'Zi�a tika veiksm�gi pievienota');
define('_COMMENT_UPDATED',            'Koment�ri tika modific�ti');
define('_SKIN_UPDATED',                'T�mas inform�cija tika saglab�ta');
define('_TEMPLATE_UPDATED',            'Veidnes inform�cija tika saglab�ta');

// errors
define('_ERROR_COMMENT_LONGWORD',    'L�dzu nelieto koment�ros v�rdus, kas satur vair�k par 90 simboliem');
define('_ERROR_COMMENT_NOCOMMENT',    'L�dzu uzraksti ar� koment�ru');
define('_ERROR_COMMENT_NOUSERNAME',    'Hm. Izskat�s, ka neesi dal�bnieks vai ar� kaut kas nav k�rt�ba ar tavu v�rdu.');
define('_ERROR_COMMENT_TOOLONG',    'P�r�k liels koment�rs (max. 5000 simboli)');
define('_ERROR_COMMENTS_DISABLED',    '�eit nevar koment�t.');
define('_ERROR_COMMENTS_NONPUBLIC',    'Hm, nesan�ks koment�t, jo neesi ieg�jis sist�m�');
define('_ERROR_COMMENTS_MEMBERNICK','Ir jau t�ds v�rds. Izv�lies citu.');
define('_ERROR_SKIN',                'T�mas k��da');
define('_ERROR_ITEMCLOSED',            'T�ma sl�gta, koment�ri sl�gti, balsot nevar');
define('_ERROR_NOSUCHITEM',            'Nek� nav');
define('_ERROR_NOSUCHBLOG',            'Nav t�da bloga');
define('_ERROR_NOSUCHSKIN',            'Nav t�das t�mas');
define('_ERROR_NOSUCHMEMBER',        'Nav t�da dal�bnieka');
define('_ERROR_NOTONTEAM',            'Izskat�s, ka neesi komand� k� blog dal�bnieks.');
//define('_ERROR_BADDESTBLOG',        'Destination blog does not exist');
define('_ERROR_BADDESTBLOG',        '�is blogs neeksist�');
define('_ERROR_NOTONDESTTEAM',        'Nevar p�rvietot �o blogu tur, kur tu neesi pierakst�ts');
define('_ERROR_NOEMPTYITEMS',        'Neaizpild�tas lietas netiks pievienotas!');
define('_ERROR_BADMAILADDRESS',        'Nepareiza epasta adrese');
define('_ERROR_BADNOTIFY',            'Epasta adrese(s) nav pareiza(s)');
define('_ERROR_BADNAME',            'V�rds nepareizs (at�auti burti a-z, cipari 0-9 un bez atstarp�m s�kum�/beig�s)');
define('_ERROR_NICKNAMEINUSE',        'K�dam citam ir ��ds v�rds');
define('_ERROR_PASSWORDMISMATCH',    'Parol�m j�sakr�t');
define('_ERROR_PASSWORDTOOSHORT',    'Parolei j�b�t ar minimums 6 simboliem');
define('_ERROR_PASSWORDMISSING',    'Parole nedr�kst b�t tuk�a');
define('_ERROR_REALNAMEMISSING',    'Hm, kautkas nav k�rt�b� ar v�rdu');
define('_ERROR_ATLEASTONEADMIN',    'Vienm�r j�b�t vismaz vienam super-adminam, kas var administr�t.');
define('_ERROR_ATLEASTONEBLOGADMIN','Darot ��di, iesp�jams blog sist�ma vairs neb�s administr�jama. P�rliecinies, lai vienm�r b�tu vismaz viens admins.');
define('_ERROR_ALREADYONTEAM',        'Nevar pievienot jau eso�us dal�bniekus');
define('_ERROR_BADSHORTBLOGNAME',    '�ss tava bloga nosaukums (ar burtiem a-z, cipariem 0-9 un bez atstarp�m s�kum�/beig�s');
define('_ERROR_DUPSHORTBLOGNAME',    'Ir jau t�ds blogs');
define('_ERROR_UPDATEFILE',            'Atjauno�anas fails nepieejams. Vai failam var piek��t (pam��ini uzlikt chmod 666). Ieteicams lietot pilnu ce�u (piem. /sisteemas/celshs/uz/nucleus/)');
//'Cannot get write access to the update-file. Make sure the file permissions are set ok (try chmodding it to 666). Also note that the location is relative to the admin-area directory, so you might want to use an absolute path (something like /your/path/to/nucleus/)');
define('_ERROR_DELDEFBLOG',            '�is ir galvenais blogs, to nevar dz�st');
define('_ERROR_DELETEMEMBER',        'Nevar dz�st �o dal�bnieku, iesp�jams t�p�c, ka vi�� ir k�du rakstu vai koment�ru autors');
define('_ERROR_BADTEMPLATENAME',    'Nepareizs sagataves nosaukums, at�auti burti a-z, cipari 0-9 un bez atstarp�m');
define('_ERROR_DUPTEMPLATENAME',    'Ir jau t�da sagatave');
define('_ERROR_BADSKINNAME',        'Nepareizs t�mas nosaukums (at�auti burti a-z, cipari 0-9 un bez atstarp�m)');
define('_ERROR_DUPSKINNAME',        'Ir jau t�ma ar t�du nosaukumu');
define('_ERROR_DEFAULTSKIN',        'T�mai "default" j�b�t un tur neko nevar dar�t');
define('_ERROR_SKINDEFDELETE',        'Nevar izdz�st �o t�mu, jo t� ir galven� sekojo�am blogam: ');
define('_ERROR_DISALLOWED',            '��das darb�bas ir aizliegtas');
define('_ERROR_DELETEBAN',            'K��da, dz��ot aizliegumu (nav t�da aizlieguma)');
define('_ERROR_ADDBAN',                'K��da. ��ds aizliegums var netikt pievienots visos blogos.');
define('_ERROR_BADACTION',            'Netiklas..em.. darb�bas sod�mas p�c krimin�llikuma');
define('_ERROR_MEMBERMAILDISABLED',    'Dal�bnieks-dal�bniekam zi�u s�t��ana aizliegta');
define('_ERROR_MEMBERCREATEDISABLED','Dal�bnieku pievieno�ana atsl�gta');
define('_ERROR_INCORRECTEMAIL',        'Nepareiza epasta adrese');
define('_ERROR_VOTEDBEFORE',        'Par �o jau esi balsojis');
define('_ERROR_BANNED1',            'Diem��l man tevi j�apb�dina, jo tava IP adrese ir iek�auta aizliegto IP adre�u apgabal� ');
define('_ERROR_BANNED2',            ' . Tu rakst�ji: \'');
define('_ERROR_BANNED3',            '\'');
define('_ERROR_LOGINNEEDED',        'Piesl�dzies sist�mai, lai veiktu ��du darb�bu');
define('_ERROR_CONNECT',            'Piesl�g�an�s k��da');
define('_ERROR_FILE_TOO_BIG',        'Fails ir p�r�k liels!');
define('_ERROR_BADFILETYPE',        '��da form�ta faili �eit ir aizliegti');
define('_ERROR_BADREQUEST',            'Fuj! Slikti dar�ji.');
define('_ERROR_DISALLOWEDUPLOAD',    'Nevar atrast tevi m�su komand�. Nu, l�dz ar to tev nesan�ks uzlikt failus');
define('_ERROR_BADPERMISSIONS',        'Nepareizi uzst�d�tas failu/direktoriju at�aujas');
define('_ERROR_UPLOADMOVEP',        'K��da dz��ot failu');
define('_ERROR_UPLOADCOPY',            'K��da kop�jot failu');
define('_ERROR_UPLOADDUPLICATE',    'Fails ar ��du nosaukumu jau eksist�. Pirms uzlik�anas to p�rsauc.');
define('_ERROR_LOGINDISALLOWED',    'Piedod, tev nav dota at�auja �eit �rd�ties k� adminam. Bet vismaz vari padarboties k� dal�bnieks. Uzraksti kaut ko labu');
define('_ERROR_DBCONNECT',            'Hm, mySQL serveris nok�ries? Piezvani adminam');
define('_ERROR_DBSELECT',            'Hm, probl�ma ar blogu datu b�zi.');
define('_ERROR_NOSUCHLANGUAGE',        'Hm, probl�ma ar valodu failu (nav atrasts)');
define('_ERROR_NOSUCHCATEGORY',        'Hm, sada�a netika atrasta');
define('_ERROR_DELETELASTCATEGORY',    'J�b�t vismaz vienai sada�ai');
define('_ERROR_DELETEDEFCATEGORY',    'Pamatsada�u nedr�kst dz�st');
define('_ERROR_BADCATEGORYNAME',    'Slikts nosaukums priek� sada�as');
define('_ERROR_DUPCATEGORYNAME',    'Ir, ir jau t�da sada�a');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',            'Uzman�bu: �is uzst�d�jums neizskat�s p�c direktorijas!');
define('_WARNING_NOTREADABLE',        'Uzman�bu: �� direktorija nav redzama, ar domu - nevar nolas�t!');
define('_WARNING_NOTWRITABLE',        'Uzman�bu: �aj� direktorij� neko nevar saglab�t!');

// media and upload
define('_MEDIA_UPLOADLINK',            'Pievienot jaunu failu');
define('_MEDIA_MODIFIED',            'izmai�as');
define('_MEDIA_FILENAME',            'nosaukums');
define('_MEDIA_DIMENSIONS',            'izm�ri');
define('_MEDIA_INLINE',                'Iek�aut lap�');
define('_MEDIA_POPUP',                'Atsevi��s logs');
define('_UPLOAD_TITLE',                'Izv�l�ties failu');
define('_UPLOAD_MSG',                'Izv�lies failu un spied \'Uzlikt\' pogu.');
define('_UPLOAD_BUTTON',            'Uzlikt');

// some status messages
define('_MSG_ACCOUNTCREATED',        'Konts izveidots, parole nos�t�ta pa epastu');
define('_MSG_PASSWORDSENT',            'Parole tika nos�t�ta uz attiec�go epasta adresi.');
define('_MSG_LOGINAGAIN',            'Tev j�piesl�dzas v�leiz, jo inform�cija par tevi tika izmain�ta');
define('_MSG_SETTINGSCHANGED',        'Uzst�d�jumi izmain�ti');
define('_MSG_ADMINCHANGED',            'Admins nomain�ts');
define('_MSG_NEWBLOG',                'Jauns blogs izveidots');
define('_MSG_ACTIONLOGCLEARED',        'Statistika dz�sta');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',        'Aizliegta r�c�ba: ');
define('_ACTIONLOG_PWDREMINDERSENT','Jaun� parole nos�t�ta dal�bniekam ');
define('_ACTIONLOG_TITLE',            'Statistika');
define('_ACTIONLOG_CLEAR_TITLE',    'Dz�st statistiku');
define('_ACTIONLOG_CLEAR_TEXT',        'Dz�st statistiku t�l�t');

// team management
define('_TEAM_TITLE',                'Mened��t bloga komandu ');
define('_TEAM_CURRENT',                '\'Teko��\' komanda');
define('_TEAM_ADDNEW',                'Pievienot komandai jaunu dal�bnieku');
define('_TEAM_CHOOSEMEMBER',        'Izv�l�ties dal�bnieku');
define('_TEAM_ADMIN',                'Admina ties�bas? ');
define('_TEAM_ADD',                    'Pievienot komandai');
define('_TEAM_ADD_BTN',                'Pievienot komandai');

// blogsettings
define('_EBLOG_TITLE',                'Bloga modific��ana');
define('_EBLOG_TEAM_TITLE',            'Modific�t komandu');
define('_EBLOG_TEAM_TEXT',            'Spied �eit, lai modific�tu komandu...');
define('_EBLOG_SETTINGS_TITLE',        'Bloga uzst�d�jumi');
define('_EBLOG_NAME',                'Bloga nosaukums');
define('_EBLOG_SHORTNAME',            '�ss bloga nosaukums');
define('_EBLOG_SHORTNAME_EXTRA',    '<br />(j�satur burtus a-z un bez atstarp�m)');
define('_EBLOG_DESC',                'Bloga apraksts');
define('_EBLOG_URL',                'URL');
define('_EBLOG_DEFSKIN',            'Pamatt�ma');
define('_EBLOG_DEFCAT',                'Pamatsada�a');
define('_EBLOG_LINEBREAKS',            'Konvert�t rindu p�rnesumus jaun� rind�');
define('_EBLOG_DISABLECOMMENTS',    'Koment�ri at�auti?<br /><small>(Atsl�dzot koment�rus, koment��ana neb�s iesp�jama.)</small>');
define('_EBLOG_ANONYMOUS',            'At�aut koment�t ciemi�iem?');
define('_EBLOG_NOTIFY',                'Apzi�o�anas adrese(s) (vair�kus atdal�t ar ;)');
define('_EBLOG_NOTIFY_ON',            'Apzi�o�ana iesl�gta');
define('_EBLOG_NOTIFY_COMMENT',        'Apzi�ot par jauniem koment�riem');
define('_EBLOG_NOTIFY_KARMA',        'Apzi�ot par balsojumiem');
define('_EBLOG_NOTIFY_ITEM',        'Apzi�ot par jauniem rakstiem');
define('_EBLOG_PING',                'Nos�t�t ping uz Weblogs.com p�c izmai�u veik�anas Nucleus sist�m�?');
define('_EBLOG_MAXCOMMENTS',        'Maksim�lais at�autais koment�ru skaits');
define('_EBLOG_UPDATE',                'Atjauno�anas fails');
define('_EBLOG_OFFSET',                'Laika nob�de');
define('_EBLOG_STIME',                'Pa�reiz�jais servera laiks');
define('_EBLOG_BTIME',                'Pa�reiz�jais bloga laiks');
define('_EBLOG_CHANGE',                'Izmain�t uzst�d�jumus');
define('_EBLOG_CHANGE_BTN',            'Izmain�t uzst�d�jumus');
define('_EBLOG_ADMIN',                'Bloga admins');
define('_EBLOG_ADMIN_MSG',            'tev pie��irtas admina ties�bas');
define('_EBLOG_CREATE_TITLE',        'Izveidot jaunu blogu');
define('_EBLOG_CREATE_TEXT',        'Aizpildi formu, lai izveidotu jaunu blogu. <br /><br /> <b>Piez�me:</b> �eit atrodami tikai nepiecie�am�kie uzst�d�jumi. Ekstra uzst�d�jumi atrodami bloga uzst�d�jumu sada��.');
define('_EBLOG_CREATE',                'Izveidot!');
define('_EBLOG_CREATE_BTN',            'Izveidot blogu');
define('_EBLOG_CAT_TITLE',            'Sada�as');
define('_EBLOG_CAT_NAME',            'Nosaukums');
define('_EBLOG_CAT_DESC',            'Apraksts');
define('_EBLOG_CAT_CREATE',            'Jaunas sada�as izveido�ana');
define('_EBLOG_CAT_UPDATE',            'Atjaunin�t sada�u');
define('_EBLOG_CAT_UPDATE_BTN',        'Atjaunin�t sada�u');

// templates
define('_TEMPLATE_TITLE',            'Modific�t veidnes');
define('_TEMPLATE_AVAILABLE_TITLE',    'Pieejam�s veidnes');
define('_TEMPLATE_NEW_TITLE',        'Jauna veidne');
define('_TEMPLATE_NAME',            'Veidnes nosaukums');
define('_TEMPLATE_DESC',            'Apraksts');
define('_TEMPLATE_CREATE',            'Izveidot veidni');
define('_TEMPLATE_CREATE_BTN',        'Izveidot veidni');
define('_TEMPLATE_EDIT_TITLE',        'Modific�t veidni');
define('_TEMPLATE_BACK',            'Atpaka� uz veid�u aprakstu');
define('_TEMPLATE_EDIT_MSG',        'Vair�kus uzst�d�jumus dr�kst atst�t tuk�us.');
define('_TEMPLATE_SETTINGS',        'Veidnes uzst�d�jumi');
define('_TEMPLATE_ITEMS',            'Raksti');
define('_TEMPLATE_ITEMHEADER',        'Raksta auk�da�a');
define('_TEMPLATE_ITEMBODY',        'Raksta vidusda�a');
define('_TEMPLATE_ITEMFOOTER',        'Raksta apak�da�a');
define('_TEMPLATE_MORELINK',        'Nor�de uz pilnu rakstu');
define('_TEMPLATE_NEW',                'Nor�de uz jaunu rakstu');
define('_TEMPLATE_COMMENTS_ANY',    'Koment�ri (ja ir)');
define('_TEMPLATE_CHEADER',            'Koment�ru auk�da�a');
define('_TEMPLATE_CBODY',            'Koment�ru vidusda�a');
define('_TEMPLATE_CFOOTER',            'Koment�ru apak�da�a');
define('_TEMPLATE_CONE',            'Viens koment�rs');
define('_TEMPLATE_CMANY',            'Divi (vai vair�k) koment�ri');
define('_TEMPLATE_CMORE',            'Las�t vair�k koment�rus');
define('_TEMPLATE_CMEXTRA',            'Member Extra');
define('_TEMPLATE_COMMENTS_NONE',    'Ja nav koment�ru');
define('_TEMPLATE_CNONE',            'Koment�ru nav');
define('_TEMPLATE_COMMENTS_TOOMUCH','Ja ir p�r�k daudz koment�ru');
define('_TEMPLATE_CTOOMUCH',        'P�r�k daudz koment�ru');
define('_TEMPLATE_ARCHIVELIST',        'K� izskat�s arh�vi');
define('_TEMPLATE_AHEADER',            'Arh�va aug�da�a');
define('_TEMPLATE_AITEM',            'Arh�va vidusda�a');
define('_TEMPLATE_AFOOTER',            'Arh�va apak�da�a');
define('_TEMPLATE_DATETIME',        'Datums un laiks');
define('_TEMPLATE_DHEADER',            'Datuma aug�da�a');
define('_TEMPLATE_DFOOTER',            'Datuma apak�da�a');
define('_TEMPLATE_DFORMAT',            'Datuma form�ts');
define('_TEMPLATE_TFORMAT',            'Laika form�ts');
define('_TEMPLATE_LOCALE',            'Lok�lais uzst�d�jums');
define('_TEMPLATE_IMAGE',            'Izleco�ie att�li');
define('_TEMPLATE_PCODE',            'Kods izleco�ajam linkam');
define('_TEMPLATE_ICODE',            'Lap� iek�aujam� att�la kods');
define('_TEMPLATE_MCODE',            'M�dija objekta kods');
define('_TEMPLATE_SEARCH',            'Mekl��anas sist�ma');
define('_TEMPLATE_SHIGHLIGHT',        'V�rdu izcel�ana');
define('_TEMPLATE_SNOTFOUND',        'Ja nekas nav atrasts');
define('_TEMPLATE_UPDATE',            'Izmai�u veik�ana');
define('_TEMPLATE_UPDATE_BTN',        'Saglab�t izmai�as veidn�');
define('_TEMPLATE_RESET_BTN',        'Noklus�t�s v�rt�bas');
define('_TEMPLATE_CATEGORYLIST',    'Sada�u saraksti');
define('_TEMPLATE_CATHEADER',        'Sada�u saraksta aug�da�a');
define('_TEMPLATE_CATITEM',            'Sada�u saraksta vidusda�a');
define('_TEMPLATE_CATFOOTER',        'Sada�u saraksta apak�da�a');

// skins
define('_SKIN_EDIT_TITLE',            'Modific�t t�mas');
define('_SKIN_AVAILABLE_TITLE',        'Pieejam�s t�mas');
define('_SKIN_NEW_TITLE',            'Jauna t�ma');
define('_SKIN_NAME',                'Nosaukums');
define('_SKIN_DESC',                'Apraksts');
define('_SKIN_TYPE',                '"Content Type"');
define('_SKIN_CREATE',                'Izveido�ana');
define('_SKIN_CREATE_BTN',            'Izveidot t�mu');
define('_SKIN_EDITONE_TITLE',        'Modific�t t�mu');
define('_SKIN_BACK',                'Atpaka� pie t�mu apraksta');
define('_SKIN_PARTS_TITLE',            'Katras lapas t�ma');
define('_SKIN_PARTS_MSG',            'Ne visi uzst�d�jumi ir oblig�ti. Nevajadz�gos var atst�t tuk�us. T�mas iesp�jams main�t ��d�m sada��m:');
define('_SKIN_PART_MAIN',            'Galven� lapa');
define('_SKIN_PART_ITEM',            'Raksti');
define('_SKIN_PART_ALIST',            'Arh�vu saraksts');
define('_SKIN_PART_ARCHIVE',        'Arh�vs');
define('_SKIN_PART_SEARCH',            'Mekl��ana');
define('_SKIN_PART_ERROR',            'K��du pazi�ojumi');
define('_SKIN_PART_MEMBER',            'Inform�cija par dal�bniekiem');
define('_SKIN_PART_POPUP',            'Izleco�ie att�li');
define('_SKIN_GENSETTINGS_TITLE',    'Infom�cija par t�mu');
define('_SKIN_CHANGE',                'Izmai�as');
define('_SKIN_CHANGE_BTN',            'Saglab�t izmai�as');
define('_SKIN_UPDATE_BTN',            'Saglab�t izmai�as');
define('_SKIN_RESET_BTN',            'Noklus�tie uzst�d�jumi');
define('_SKIN_EDITPART_TITLE',        'Modific�t t�mu');
define('_SKIN_GOBACK',                'Atpaka�');
define('_SKIN_ALLOWEDVARS',            'Pieejamie uzst�d�jumi (s�k�ka inform�cija, uzklik��inot):');

// global settings
define('_SETTINGS_TITLE',            'Galvenie uzst�d�jumi');
define('_SETTINGS_SUB_GENERAL',        'Galvenie uzst�d�jumi');
define('_SETTINGS_DEFBLOG',            'Prim�rais blogs');
define('_SETTINGS_ADMINMAIL',        'Admina epasta adrese');
define('_SETTINGS_SITENAME',        'M�jas lapas nosaukums');
define('_SETTINGS_SITEURL',            'Lapas URL (ar sl�psv�tru beig�s)');
define('_SETTINGS_ADMINURL',        'Administr��anas URL (ar sl�psv�tru beig�s)');
define('_SETTINGS_DIRS',            'Nucleus pilna atra�an�s vieta sist�m�');
define('_SETTINGS_MEDIADIR',        'M�diju direktorija');
define('_SETTINGS_SEECONFIGPHP',    '(skat. config.php)');
define('_SETTINGS_MEDIAURL',        'M�diju URL (ar sl�psv�tru beig�s)');
define('_SETTINGS_ALLOWUPLOAD',        'At�aut likt failus?');
define('_SETTINGS_ALLOWUPLOADTYPES','At�autie failu form�ti');
define('_SETTINGS_CHANGELOGIN',        'At�aut dal�bniekiem main�t v�rdu/paroli');
define('_SETTINGS_COOKIES_TITLE',    'Cookie uzst�d�jumi');
define('_SETTINGS_COOKIELIFE',        'Sist�mas Cookie ilgums');
define('_SETTINGS_COOKIESESSION',    'tik pat, cik sesija');
define('_SETTINGS_COOKIEMONTH',        'viens m�nesis');
define('_SETTINGS_COOKIEPATH',        'Cookie ce�� (advanced)');
define('_SETTINGS_COOKIEDOMAIN',    'Cookie dom�ns (advanced)');
define('_SETTINGS_COOKIESECURE',    'Dro�ie Cookie (advanced)');
define('_SETTINGS_LASTVISIT',        'Saglab�t p�d�j� apmekl�juma Cookies');
define('_SETTINGS_ALLOWCREATE',        'At�aut visiem apmekl�t�jiem re�istr�ties');
define('_SETTINGS_NEWLOGIN',        'At�aut piesl�gties k� administratoram uzreiz p�c re�istr��an�s');
define('_SETTINGS_NEWLOGIN2',        '(tikai jaunizveidotiem)');
define('_SETTINGS_MEMBERMSGS',        'At�aut izmantot dal�bnieks-dal�bniekam servisu');
define('_SETTINGS_LANGUAGE',        'Valoda');
define('_SETTINGS_DISABLESITE',        'Apst�din�t sist�mu');
define('_SETTINGS_DBLOGIN',            'mySQL DB inform�cija');
define('_SETTINGS_UPDATE',            'Uzst�d�jumu saglab��ana');
define('_SETTINGS_UPDATE_BTN',        'Saglab�t izmai�as');
define('_SETTINGS_DISABLEJS',        'Atsl�gt JavaScript paneli');
define('_SETTINGS_MEDIA',            'Mediju/Failu uzst�d�jumi');
define('_SETTINGS_MEDIAPREFIX',        'Failu nosaukumu s�kumu likt teko�o datumu');
define('_SETTINGS_MEMBERS',            'Dal�bnieku uzst�d�jumi');

// bans
define('_BAN_TITLE',                'Aizliegumi: ');
define('_BAN_NONE',                    '�im blogam nav IP adre�u aizliegumu');
define('_BAN_NEW_TITLE',            'Pievienot jaunu aizliegumu');
define('_BAN_NEW_TEXT',                'Pievienot aizliegumu(s)');
define('_BAN_REMOVE_TITLE',            'No�emt aizliegumu(s)');
define('_BAN_IPRANGE',                'IP adre�u apgabals');
define('_BAN_BLOGS',                'K�diem blogiem?');
define('_BAN_DELETE_TITLE',            'Dz�st aizliegumu');
define('_BAN_ALLBLOGS',                'Visi blogi, kur� esi admins.');
define('_BAN_REMOVED_TITLE',        'Aizliegums no�emts');
define('_BAN_REMOVED_TEXT',            'Aizliegums no�emts no sekojo�iem blogiem:');
define('_BAN_ADD_TITLE',            'Pievienot aizliegumu');
define('_BAN_IPRANGE_TEXT',            'Izv�lies blo��jamo IP adre�u apgabalu. Jo maz�k ciparu IP adres�, jo liel�ks apgabals tiks blo��ts.');
define('_BAN_BLOGS_TEXT',            'Var blo��t pieeju vienam noteiktam blogam vai ar� visiem blogiem, kur� esi administrators.');
define('_BAN_REASON_TITLE',            'Iemesls');
define('_BAN_REASON_TEXT',            'Pievieno iemeslu, k�p�c dal�bniekam tiek blo��ta pieeja. Maksimums 256 simboli.');
define('_BAN_ADD_BTN',                'Pievienot aizliegumu');

// LOGIN screen
define('_LOGIN_MESSAGE',            'Zi�ojums');
define('_LOGIN_NAME',                'V�rds/nosaukums');
define('_LOGIN_PASSWORD',            'Parole');
define('_LOGIN_SHARED',                _LOGINFORM_SHARED);
define('_LOGIN_FORGOT',                'Aizmirs�s parole?');

// membermanagement
define('_MEMBERS_TITLE',            'Dal�bnieku mened�ments');
define('_MEMBERS_CURRENT',            'Re�istr�tie dal�bnieki');
define('_MEMBERS_NEW',                'Jauns dal�bnieks');
define('_MEMBERS_DISPLAY',            'Atspogu�ojamais v�rds');
define('_MEMBERS_DISPLAY_INFO',        '(segv�rds, ar kuru piesl�dzas sist�mai)');
define('_MEMBERS_REALNAME',            'Pilnais v�rds');
define('_MEMBERS_PWD',                'Parole');
define('_MEMBERS_REPPWD',            'Atk�rtot paroli');
define('_MEMBERS_EMAIL',            'Epasta adrese');
define('_MEMBERS_EMAIL_EDIT',        '(Mainot epasta adresi, jaun� parole<br /> autom�tiski nos�t�sies uz jauno adresi)');
define('_MEMBERS_URL',                'M�jas lapa (URL)');
define('_MEMBERS_SUPERADMIN',        'Admina ties�bas');
define('_MEMBERS_CANLOGIN',            'Var piesl�gties adminu sada�ai');
define('_MEMBERS_NOTES',            'Piez�mes');
define('_MEMBERS_NEW_BTN',            'Pievienot');
define('_MEMBERS_EDIT',                'Modific�t dal�bnieka inform�ciju');
define('_MEMBERS_EDIT_BTN',            'Main�t uzst�d�jumus');
define('_MEMBERS_BACKTOOVERVIEW',    'Atpaka� uz Dal�bnieku inform�ciju');
define('_MEMBERS_DEFLANG',            'Valoda');
define('_MEMBERS_USESITELANG',        '- sist�mas pamatvaloda -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',        'apmekl�t saitu');
define('_BLOGLIST_ADD',                'Pievienot');
define('_BLOGLIST_TT_ADD',            'Pievienot jaunu rakstu �im blogam');
define('_BLOGLIST_EDIT',            'Modific�t/dz�st');
define('_BLOGLIST_TT_EDIT',            '');
define('_BLOGLIST_BMLET',            'Noder�gas saites');
define('_BLOGLIST_TT_BMLET',        '');
define('_BLOGLIST_SETTINGS',        'Uzst�d�jumi');
define('_BLOGLIST_TT_SETTINGS',        'Modific�t uzst�d�jumus vai inform�ciju par komandu');
define('_BLOGLIST_BANS',            'Aizliegumi');
define('_BLOGLIST_TT_BANS',            'Skat�t/pievienot/dz�st blo��t�s IP');
define('_BLOGLIST_DELETE',            'Dz�st visu');
define('_BLOGLIST_TT_DELETE',        'Dz�st �o blogu');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',            'Tavi blogi');
define('_OVERVIEW_YRDRAFTS',        'Tavas sagataves');
define('_OVERVIEW_YRSETTINGS',        'Tavi uzst�d�jumi');
define('_OVERVIEW_GSETTINGS',        'Galvenie uzst�d�jumi');
define('_OVERVIEW_NOBLOGS',            'Tu neesi nevien� blogu komand�');
define('_OVERVIEW_NODRAFTS',        'Sagatavju nav');
define('_OVERVIEW_EDITSETTINGS',    'Modific�t savus uzst�d�jumus...');
define('_OVERVIEW_BROWSEITEMS',        'Skat�ties savus rakstus...');
define('_OVERVIEW_BROWSECOMM',        'Skat�ties savus koment�rus...');
define('_OVERVIEW_VIEWLOG',            'Skat�ties statistiku...');
define('_OVERVIEW_MEMBERS',            'Administr�t dal�bniekus...');
define('_OVERVIEW_NEWLOG',            'Izveidot jaunu blogu...');
define('_OVERVIEW_SETTINGS',        'Modific�t uzst�d�jumus...');
define('_OVERVIEW_TEMPLATES',        'Modific�t veidnes...');
define('_OVERVIEW_SKINS',            'Modific�t t�mas...');
define('_OVERVIEW_BACKUP',            'Rezerves kopija/Atjauno�ana...');

// ITEMLIST
define('_ITEMLIST_BLOG',            'Kas atrodams blog�, ar nosaukumu');
define('_ITEMLIST_YOUR',            'Tavi raksti');

// Comments
define('_COMMENTS',                    'Koment�ri');
define('_NOCOMMENTS',                'Nav koment�ru');
define('_COMMENTS_YOUR',            'Tavi koment�ri');
define('_NOCOMMENTS_YOUR',            'Neesi rakst�jis koment�rus');

// LISTS (general)
define('_LISTS_NOMORE',                'Vair�k rezult�tu nav vai rezult�tu nav visp�r');
define('_LISTS_PREV',                'Iepriek��jie');
define('_LISTS_NEXT',                'N�kamie');
define('_LISTS_SEARCH',                'Mekl�t');
define('_LISTS_CHANGE',                'Modific�t');
define('_LISTS_PERPAGE',            'rezult�ti/lap�');
define('_LISTS_ACTIONS',            'Darb�bas');
define('_LISTS_DELETE',                'Dz�st');
define('_LISTS_EDIT',                'Modific�t');
define('_LISTS_MOVE',                'P�rvietot');
define('_LISTS_CLONE',                'Klon�t');
define('_LISTS_TITLE',                'Virsraksts');
define('_LISTS_BLOG',                'Blogs');
define('_LISTS_NAME',                'Nosaukums');
define('_LISTS_DESC',                'Apraksts');
define('_LISTS_TIME',                'Laiks');
define('_LISTS_COMMENTS',            'Koment�ri');
define('_LISTS_TYPE',                'Form�ts');


// member list
define('_LIST_MEMBER_NAME',            'Public�jamais v�rds');
define('_LIST_MEMBER_RNAME',        '�stais v�rds');
define('_LIST_MEMBER_ADMIN',        'Super-admins? ');
define('_LIST_MEMBER_LOGIN',        'Var piesl�gties? ');
define('_LIST_MEMBER_URL',            'M�jas lapa');

// banlist
define('_LIST_BAN_IPRANGE',            'IP apgabals');
define('_LIST_BAN_REASON',            'Iemesls');

// actionlist
define('_LIST_ACTION_MSG',            'Zi�ojums');

// commentlist
define('_LIST_COMMENT_BANIP',        'Blo��t IP');
define('_LIST_COMMENT_WHO',            'Autors');
define('_LIST_COMMENT',                'Koment�ri');
define('_LIST_COMMENT_HOST',        'Hosts');

// itemlist
define('_LIST_ITEM_INFO',            'Info');
define('_LIST_ITEM_CONTENT',        'Virsraksts un teksts');


// teamlist
define('_LIST_TEAM_ADMIN',            'Admins ');
define('_LIST_TEAM_CHADMIN',        'Mainam adminu');

// edit comments
define('_EDITC_TITLE',                'Modific�t koment�rus');
define('_EDITC_WHO',                'Autors');
define('_EDITC_HOST',                'No kurienes?');
define('_EDITC_WHEN',                'Kad?');
define('_EDITC_TEXT',                'Teksts');
define('_EDITC_EDIT',                'Modific�t koment�ru');
define('_EDITC_MEMBER',                'dal�bnieks');
define('_EDITC_NONMEMBER',            'ciemi��');

// move item
define('_MOVE_TITLE',                'Uz kuru blogu?');
define('_MOVE_BTN',                    'P�rvietot...');

?>