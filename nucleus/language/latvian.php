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
define('_MEDIA_VIEW_TT',			'Skatît failu (jaunâ logâ)');
define('_MEDIA_FILTER_APPLY',		'Pievienot filtru');
define('_MEDIA_FILTER_LABEL',		'Filtrs: ');
define('_MEDIA_UPLOAD_TO',			'Uzlikt uz...');
define('_MEDIA_UPLOAD_NEW',			'Uzlikt jaunu failu...');
define('_MEDIA_COLLECTION_SELECT',	'Izvçlçties');
define('_MEDIA_COLLECTION_TT',		'Pâriet uz sadaïu');
define('_MEDIA_COLLECTION_LABEL',	'Paðreizçjâ kolekcija: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'Kreisajâ pusç');
define('_ADD_ALIGNRIGHT_TT',		'Labajâ pusç');
define('_ADD_ALIGNCENTER_TT',		'Iecentrçts');

// searchable blog setting (yes/no)
define('_EBLOG_SEARCH',				'Pievienot meklçðanas indeksam');

// generic upload failure
define('_ERROR_UPLOADFAILED',		'Kïûdas rezultâtâ fails netika pievienots.');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'Atïaut sûtît ar atpakaïejoðu datumu');
define('_ADD_CHANGEDATE',			'Izmainît laiku');
define('_BMLET_CHANGEDATE',			'Izmainît laiku');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'Noformçjuma imports/eksports...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Vienkârði');
define('_PARSER_INCMODE_SKINDIR',	'Izmantot skins direktoriju');
define('_SKIN_INCLUDE_MODE',		'Pievienoðanas veids');
define('_SKIN_INCLUDE_PREFIX',		'Pievienoðanas prefikss');

// global settings
define('_SETTINGS_BASESKIN',		'Pamatnoformçjums');
define('_SETTINGS_SKINSURL',		'Noformçjuma pakotnes URL');
define('_SETTINGS_ACTIONSURL',		'Pilns URL uz action.php');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'Nevar pârvietot pamatsadaïu');
define('_ERROR_MOVETOSELF',			'Nevar pârvietot sadaïu (abas sadaïas ir viens un tas pats)');
define('_MOVECAT_TITLE',			'Izvçlies kura bloga sadaïu pârvietot');
define('_MOVECAT_BTN',				'Pârvietot sadaïu');

// URLMode setting
define('_SETTINGS_URLMODE',			'URL reþîms');
define('_SETTINGS_URLMODE_NORMAL',	'Normal');
define('_SETTINGS_URLMODE_PATHINFO','Fancy');

// Batch operations
define('_BATCH_NOSELECTION',		'Nav iezîmçti objekti');
define('_BATCH_ITEMS',				'Strâdât ar ierakstiem');
define('_BATCH_CATEGORIES',			'Strâdât ar sadaïâm');
define('_BATCH_MEMBERS',			'Strâdât ar lietotâjiem');
define('_BATCH_TEAM',				'Strâdât ar lietotâju grupu');
define('_BATCH_COMMENTS',			'Strâdât ar komentâriem');
define('_BATCH_UNKNOWN',			'Nepareiza operâcija: ');
define('_BATCH_EXECUTING',			'Izpildîðana');
define('_BATCH_ONCATEGORY',			'sadaïa');
define('_BATCH_ONITEM',				'ieraksts');
define('_BATCH_ONCOMMENT',			'komentârs');
define('_BATCH_ONMEMBER',			'lietotâjs');
define('_BATCH_ONTEAM',				'lietotâju grupa');
define('_BATCH_SUCCESS',			'Veiksmîgi!');
define('_BATCH_DONE',				'Padarîts!');
define('_BATCH_DELETE_CONFIRM',		'Apstiprinât dzçðanu');
define('_BATCH_DELETE_CONFIRM_BTN',	'Apstiprinât dzçðanu');
define('_BATCH_SELECTALL',			'iezîmçt visu');
define('_BATCH_DESELECTALL',		'noòemt visus iezîmçjumus');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'Dzçst');
define('_BATCH_ITEM_MOVE',			'Pârvietot');
define('_BATCH_MEMBER_DELETE',		'Dzçst');
define('_BATCH_MEMBER_SET_ADM',		'Pieðíirt administratora tiesîbas');
define('_BATCH_MEMBER_UNSET_ADM',	'Atòemt administratora tiesîbas');
define('_BATCH_TEAM_DELETE',		'Dzçst no grupas');
define('_BATCH_TEAM_SET_ADM',		'Pieðíirt administratora tiesîbas');
define('_BATCH_TEAM_UNSET_ADM',		'Atòemt administratora tiesîbas');
define('_BATCH_CAT_DELETE',			'Dzçst');
define('_BATCH_CAT_MOVE',			'Pârvietot uz citu blogu');
define('_BATCH_COMMENT_DELETE',		'Dzçst');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'Pievienot jaunu ierakstu...');
define('_ADD_PLUGIN_EXTRAS',		'Pluginu ekstra opcijas');

// errors
define('_ERROR_CATCREATEFAIL',		'Nevar izveidot jaunu sadaïu');
define('_ERROR_NUCLEUSVERSIONREQ',	'Ðî plugina aktivizçðanai nepiecieðama jaunâka Nucleus versija: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Atpakaï uz bloga uzstâdîjumiem');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Importçt');
define('_SKINIE_TITLE_EXPORT',		'Eksportçt');
define('_SKINIE_BTN_IMPORT',		'Importçt');
define('_SKINIE_BTN_EXPORT',		'Eksportçt izvçlçtos noformçjumus/sagataves');
define('_SKINIE_LOCAL',				'Importçt no lokâla faila:');
define('_SKINIE_NOCANDIDATES',		'Skins direktorijâ nekas importçjams nav atrasts');
define('_SKINIE_FROMURL',			'importçt no URL:');
define('_SKINIE_EXPORT_INTRO',		'Izvçlies noformçjumu un sagataves, kuras eksportçt');
define('_SKINIE_EXPORT_SKINS',		'Noformçjums (skins)');
define('_SKINIE_EXPORT_TEMPLATES',	'Sagataves');
define('_SKINIE_EXPORT_EXTRA',		'Papildus info');
#define('_SKINIE_CONFIRM_OVERWRITE', 'Pârrakstît jau eksistçjoðus noformçjumus (see nameclashes)');
define('_SKINIE_CONFIRM_OVERWRITE',	'Pârrakstît jau eksistçjoðus noformçjumus');
define('_SKINIE_CONFIRM_IMPORT',	'Jâ, importçt');
define('_SKINIE_CONFIRM_TITLE',		'Noformçjuma un sagatavju importçðana');
define('_SKINIE_INFO_SKINS',		'Noformçjumi failâ:');
define('_SKINIE_INFO_TEMPLATES',	'Sagataves failâ:');
define('_SKINIE_INFO_GENERAL',		'Info:');
define('_SKINIE_INFO_SKINCLASH',	'Noformçjuma nesaderîba (clashes):');
define('_SKINIE_INFO_TEMPLCLASH',	'Sagatavju nosaukumu nesaderîba (clashes):');
define('_SKINIE_INFO_IMPORTEDSKINS','Importçtie noformçjumi:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Importçtâs sagataves:');
define('_SKINIE_DONE',				'Importçðana veiksmîgi paveikta');

define('_AND',						'un');
define('_OR',						'vai');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'tukðs lauks (klikðíini, lai modificçtu)');

// skin overview list
//
// need to see in reality, then translate.
// will be translated l8r       -Kaspars
//
define('_LIST_SKINS_INCMODE',		'IncludeMode:');
define('_LIST_SKINS_INCPREFIX',		'IncludePrefix:');
define('_LIST_SKINS_DEFINED',		'Defined parts:');

// backup
define('_BACKUPS_TITLE',			'Rezerves kopija / Atjaunoðana');
define('_BACKUP_TITLE',				'Rezerves kopija');
define('_BACKUP_INTRO',				'Klikðíini uz pogas, lai izveidotu Nucleus rezerves kopiju. Rezerves kopija bûs jasaglabâ uz tava cietâ diska.');
define('_BACKUP_ZIP_YES',			'Kompresçt');
define('_BACKUP_ZIP_NO',			'Nekompresçt');
define('_BACKUP_BTN',				'Izveidot kopiju');
define('_BACKUP_NOTE',				'<b>Piezîme:</b> Rezerves kopijâ tiek uzglabâti tikai datu bâzç esoðie dati. Attçli un citi faili <b>NETIEK</b> iekïauti.');
define('_RESTORE_TITLE',			'Atjaunot');
define('_RESTORE_NOTE',				'<b>UZMANÎBU:</b> Atjaunoðanas rezultâtâ visi Nucleus datu bâzç esoðie dati tiks <b>DZÇSTI</b>, tâpçc vairâkkârt pârliecinies, vai ir izveidota rezerves kopija1<br />	<b>Piezîme:</b> Rezerves kopijas datiem jâbût no tâs paðas Nucleus versijas, kas paðlaik ir uzinstalçta pretçjâ gadîjumâ Nucleus nestrâdâs!');
define('_RESTORE_INTRO',			'Izvçlies attiecîgu failu, no kura atjaunot datu bâzi.');
define('_RESTORE_IMSURE',			'Jâ, esmu gatavs!');
define('_RESTORE_BTN',				'Atjaunot no faila');
define('_RESTORE_WARNING',			'(vçlreiz pârliecinies, vai ir izveidota rezerves kopija)');
define('_ERROR_BACKUP_NOTSURE',		'Jâiezîmç \'Jâ, esmu gatavs!\' lauciòð');
define('_RESTORE_COMPLETE',			'Atjaunoðana pabeigta');

// new item notification
define('_NOTIFY_NI_MSG',			'Jauns ieraksts:');
define('_NOTIFY_NI_TITLE',			'Jauns!');
// ""wtf is karma here? And how to tranlsate it? :)"  -Kaspars
//define('_NOTIFY_KV_MSG',            'Karma vote on item:');
//define('_NOTIFY_KV_TITLE',            'Nucleus karma:');
define('_NOTIFY_KV_MSG',			'Karma ierakstam:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'Ieraksta komentârs:');
define('_NOTIFY_NC_TITLE',			'Nucleus komentârs:');
define('_NOTIFY_USERID',			'Lietotâja ID:');
define('_NOTIFY_USER',				'Lietotâjs:');
define('_NOTIFY_COMMENT',			'Komentârs:');
define('_NOTIFY_VOTE',				'Vçrtçjums:');
define('_NOTIFY_HOST',				'Adrese:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'Lietotâjs:');
define('_NOTIFY_TITLE',				'Virsraksts:');
define('_NOTIFY_CONTENTS',			'Saturs:');

// member mail message
define('_MMAIL_MSG',				'Nosûtîjusi');
define('_MMAIL_FROMANON',			'anonîma persona');
define('_MMAIL_FROMNUC',			'Nosûtîts no Nucleus [web]bloga');
define('_MMAIL_TITLE',				'Vçstule no');
define('_MMAIL_MAIL',				'Ziòa:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',                'Pievienot');
define('_BMLET_EDIT',                'Modificçt');
define('_BMLET_DELETE',                'Dzçst');
define('_BMLET_BODY',                'Paplaðinâti');
define('_BMLET_MORE',                'Vienkârði');
define('_BMLET_OPTIONS',            'Opcijas');
define('_BMLET_PREVIEW',            'Apskatît');

// used in bookmarklet
define('_ITEM_UPDATED',                'Ieraksts izmainîts');
define('_ITEM_DELETED',                'Ieraksts dzçsts');

// plugins
define('_CONFIRMTXT_PLUGIN',        'Tieðâm dzçst pluginu ');
define('_ERROR_NOSUCHPLUGIN',        'Nav tâda plugina');
define('_ERROR_DUPPLUGIN',            'Tâds plugins jau ir');
define('_ERROR_PLUGFILEERROR',        'Nav tâda plugina vai arî nav piekïuves tiesîbu');
define('_PLUGS_NOCANDIDATES',        'Nav atrasts neviens plugins');

define('_PLUGS_TITLE_MANAGE',        'Plugini');
define('_PLUGS_TITLE_INSTALLED',    'Paðlaik aktîvie');
define('_PLUGS_TITLE_UPDATE',        'Atjaunot sarakstu');
define('_PLUGS_TEXT_UPDATE',        'Nucleus saglabâ keðâ pluginu sarakstu. Atjaunojot/mainot pluginus, jâpârliecinâs vai ðis saraksts arî tiek atjaunots');
define('_PLUGS_TITLE_NEW',            'Pievienot pluginus');
define('_PLUGS_ADD_TEXT',            'Zemâk redzams visu pieejamo pluginu saraksts, kas nav uzinstalçti. Vçlreiz papildus pârliecinies, vai ðajâ saraksta atrodamie plugini tieðâm ir plugini!');
define('_PLUGS_BTN_INSTALL',        'Instalçt pluginu');
define('_BACKTOOVERVIEW',            'Atpakaï uz aprakstu');

// editlink
define('_TEMPLATE_EDITLINK',        'Modificçt linku');

// add left / add right tooltips
define('_ADD_LEFT_TT',                'Pievienot lodziòu kreisajâ pusç');
define('_ADD_RIGHT_TT',                'Pievienot lodziòu labajâ pusç');

// add/edit item: new category (in dropdown box)
// category = sadaïa
define('_ADD_NEWCAT',                'Jauna sadaïa');

// new settings
define('_SETTINGS_PLUGINURL',        'Plugina URL');
define('_SETTINGS_MAXUPLOADSIZE',    'Max. faila izmçrs (bytes)');
define('_SETTINGS_NONMEMBERMSGS',    'Atïaut sûtît ciemiòiem');
define('_SETTINGS_PROTECTMEMNAMES',    'Aizsargât dalîbnieku vârdus');

// overview screen
define('_OVERVIEW_PLUGINS',            'Administrçt pluginus...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',        'Jauna dalîbnieka reìistrâcija:');

// membermail (when not logged in)
// email = epasts
define('_MEMBERMAIL_MAIL',            'Tava epasta adrese:');

// file upload
//You do not have admin rights on any of the blogs that have the destination member on the //teamlist. Therefor, you\'re not allowed to upload files to this member\'s media directory
define('_ERROR_DISALLOWEDUPLOAD2',    'Tev nav pieejamas upload tiesîbas attiecîgâ dalîbnieka media katalogâ');


// plugin list
define('_LISTS_INFO',                'Informâcija');
define('_LIST_PLUGS_AUTHOR',        'Autors:');
define('_LIST_PLUGS_VER',            'Versija:');
define('_LIST_PLUGS_SITE',            'Mâjas lapa');
define('_LIST_PLUGS_DESC',            'Apraksts:');
define('_LIST_PLUGS_SUBS',            'Tiek pierakstîts sekojoðiem notikumiem:');
define('_LIST_PLUGS_UP',            'pârvietot uz augðu');
define('_LIST_PLUGS_DOWN',            'pârvietot uz leju');
define('_LIST_PLUGS_UNINSTALL',        'deinstalçt');
define('_LIST_PLUGS_ADMIN',            'admin');
define('_LIST_PLUGS_OPTIONS',        'modificçðanas&nbsp;opcijas');

// plugin option list
define('_LISTS_VALUE',                'Iestatîjums');

// plugin options
define('_ERROR_NOPLUGOPTIONS',        'ðim pluginam paðlaik nav neviena iestatîjuma');
define('_PLUGS_BACK',                'Atpakaï uz plugina aprakstu');
define('_PLUGS_SAVE',                'Saglabât izmaiòas');
define('_PLUGS_OPTIONS_UPDATED',    'Plugina opcijas saglabâtas');

define('_OVERVIEW_MANAGEMENT',        'Menedþments');
define('_OVERVIEW_MANAGE',            'Nucleus menedþments...');
define('_MANAGE_GENERAL',            'Galvenais menedþments');
define('_MANAGE_SKINS',                'Tçmas un veidnes');
define('_MANAGE_EXTRA',                'Extra fîèas');

define('_BACKTOMANAGE',                'Atpakaï uz Nucleus menedþmentu');


// END introduced after v1.1 END




// charset to use
define('_CHARSET',                    'windows-1257');

// global stuff
define('_LOGOUT',                    'Atslçgties');
define('_LOGIN',                    'Pieslçgties');
define('_YES',                        'Jâ');
define('_NO',                        'Nç');
define('_SUBMIT',                    'Apstiprinât');
define('_ERROR',                    'Kïûda');
define('_ERRORMSG',                    'Kïûda!');
define('_BACK',                        'Atgriezties');
define('_NOTLOGGEDIN',                'Nav pieslçguma');
define('_LOGGEDINAS',                'Pieslçdzies kâ');
define('_ADMINHOME',                'Admina sadaïa');
define('_NAME',                        'Vârds/nosaukums');
define('_BACKHOME',                    'Atpakaï uz admina sadaïu');
define('_BADACTION',                'Pieprasîjumu nav iespçjams izpildît');
define('_MESSAGE',                    'Ziòojums');
define('_HELP_TT',                    'Palîgâ!');
define('_YOURSITE',                    'Galvenâ lapa');


define('_POPUP_CLOSE',                'Aizvçrt logu');

define('_LOGIN_PLEASE',                'Vispirms pieslçdzies sistçmai');

// commentform
define('_COMMENTFORM_YOUARE',        'Tu esi');
define('_COMMENTFORM_SUBMIT',        'Komentçt');
define('_COMMENTFORM_COMMENT',        'Tavs komentârs');
define('_COMMENTFORM_NAME',            'Vârds');
define('_COMMENTFORM_MAIL',            'Epasts/HTTP');
define('_COMMENTFORM_REMEMBER',        'Atcerçties mani turpmâk');

// loginform
define('_LOGINFORM_NAME',            'Dalîbnieks');
define('_LOGINFORM_PWD',            'Parole');
define('_LOGINFORM_YOUARE',            'Pieslçdzies kâ');
define('_LOGINFORM_SHARED',            'Koplietoðanas dators (piem. e-cafe)');

// member mailform
define('_MEMBERMAIL_SUBMIT',        'Nosûtît');

// search form
define('_SEARCHFORM_SUBMIT',        'Meklçt');

// add item form
define('_ADD_ADDTO',                'Pievienot pie');
define('_ADD_CREATENEW',            'Izveidot jaunu');
define('_ADD_BODY',                    'Teksts');
define('_ADD_TITLE',                'Virsraksts');
define('_ADD_MORE',                    'Pievienot tekstu (nav obligâti)');
define('_ADD_CATEGORY',                'Sadaïa (JÂIZVÇLAS SAVÇJÂ!)');
define('_ADD_PREVIEW',                'Apskatît');
define('_ADD_DISABLE_COMMENTS',        'Atslçgt komentârus?');
define('_ADD_DRAFTNFUTURE',            'Sagataves nâkotnei');
define('_ADD_ADDITEM',                'Pievienot');
define('_ADD_ADDNOW',                'Pievienot tagad');
define('_ADD_ADDLATER',                'Pievienot vçlâk');
define('_ADD_PLACE_ON',                'Vieta');
define('_ADD_ADDDRAFT',                'Pievienot sagatavçm');
define('_ADD_NOPASTDATES',            '(pagâtnes datumi un laiki nav iespçjami, ðajâ gadîjumâ tiks lietots ðâbrîþa laiks)');
define('_ADD_BOLD_TT',                'Treknrakstâ');
define('_ADD_ITALIC_TT',            'Slîprakstâ');
define('_ADD_HREF_TT',                'Haiperlinks');
define('_ADD_MEDIA_TT',                'Pievienot mçdiju');
define('_ADD_PREVIEW_TT',            'Parâdît/paslçpt to, kâ izskatîsies');
define('_ADD_CUT_TT',                'Izòemt');
define('_ADD_COPY_TT',                'Kopçt');
define('_ADD_PASTE_TT',                'Ielîmçt (paste)');


// edit item form
define('_EDIT_ITEM',                'Modificçt');
define('_EDIT_SUBMIT',                'Modificçt');
define('_EDIT_ORIG_AUTHOR',            'Oriìinâla autors');
define('_EDIT_BACKTODRAFTS',        'Pievienot atpakaï, sagatavçs');
define('_EDIT_COMMENTSNOTE',        '(piezîme: visi iepriekð ierakstîtie komentâri netiks paslçpti)');


// used on delete screens
define('_DELETE_CONFIRM',            'Lûdzu apstiprini dzçðanu');
define('_DELETE_CONFIRM_BTN',        'Apstiprinât');
define('_CONFIRMTXT_ITEM',            'Tu vçlies izdzçst sekojoðu ziòu:');
define('_CONFIRMTXT_COMMENT',        'Tu vçlies izdzçst sekojoðu komentâru:');
define('_CONFIRMTXT_TEAM1',            'Tu vçlies izdzçst ');
define('_CONFIRMTXT_TEAM2',            ' no dalîbnieku komandas ');
define('_CONFIRMTXT_BLOG',            'Tiks izdzçsts sekojoðs blogs: ');
define('_WARNINGTXT_BLOGDEL',        'UZMANÎBU! Tiks izdzçsts gan pats blogs, gan visi tâ komentâri. Pârleicinies, vai tieðâm to vçlies.<br />Un, lûdzu, nepârtrauc procesu, kad notiks dzçðana!');

define('_CONFIRMTXT_MEMBER',        'Tu vçlies dzçst sekojoða dalîbnieka datus: ');
define('_CONFIRMTXT_TEMPLATE',        'Tu vçlies dzçst veidni ');
define('_CONFIRMTXT_SKIN',            'Tu vçlies dzçst tçmu ');
define('_CONFIRMTXT_BAN',            'Tu vçlies dzçst aizliegumu sekojoðam IP adreðu apgabalam');
define('_CONFIRMTXT_CATEGORY',        'Tu vçlies dzçst sadaïu ');

// some status messages
define('_DELETED_ITEM',                'Ziòa tika izdzçsta');
define('_DELETED_MEMBER',            'Dalîbnieks tika izdzçsta');
define('_DELETED_COMMENT',            'Komentâri tika izdzçsti');
define('_DELETED_BLOG',                'Blogs tika izdzçsts');
define('_DELETED_CATEGORY',            'Sadaïa tika izdzçsta');
define('_ITEM_MOVED',                'Ziòa tika veiksmîgi pârvietota');
define('_ITEM_ADDED',                'Ziòa tika veiksmîgi pievienota');
define('_COMMENT_UPDATED',            'Komentâri tika modificçti');
define('_SKIN_UPDATED',                'Tçmas informâcija tika saglabâta');
define('_TEMPLATE_UPDATED',            'Veidnes informâcija tika saglabâta');

// errors
define('_ERROR_COMMENT_LONGWORD',    'Lûdzu nelieto komentâros vârdus, kas satur vairâk par 90 simboliem');
define('_ERROR_COMMENT_NOCOMMENT',    'Lûdzu uzraksti arî komentâru');
define('_ERROR_COMMENT_NOUSERNAME',    'Hm. Izskatâs, ka neesi dalîbnieks vai arî kaut kas nav kârtîba ar tavu vârdu.');
define('_ERROR_COMMENT_TOOLONG',    'Pârâk liels komentârs (max. 5000 simboli)');
define('_ERROR_COMMENTS_DISABLED',    'Ðeit nevar komentçt.');
define('_ERROR_COMMENTS_NONPUBLIC',    'Hm, nesanâks komentçt, jo neesi iegâjis sistçmâ');
define('_ERROR_COMMENTS_MEMBERNICK','Ir jau tâds vârds. Izvçlies citu.');
define('_ERROR_SKIN',                'Tçmas kïûda');
define('_ERROR_ITEMCLOSED',            'Tçma slçgta, komentâri slçgti, balsot nevar');
define('_ERROR_NOSUCHITEM',            'Nekâ nav');
define('_ERROR_NOSUCHBLOG',            'Nav tâda bloga');
define('_ERROR_NOSUCHSKIN',            'Nav tâdas tçmas');
define('_ERROR_NOSUCHMEMBER',        'Nav tâda dalîbnieka');
define('_ERROR_NOTONTEAM',            'Izskatâs, ka neesi komandâ kâ blog dalîbnieks.');
//define('_ERROR_BADDESTBLOG',        'Destination blog does not exist');
define('_ERROR_BADDESTBLOG',        'Ðis blogs neeksistç');
define('_ERROR_NOTONDESTTEAM',        'Nevar pârvietot ðo blogu tur, kur tu neesi pierakstîts');
define('_ERROR_NOEMPTYITEMS',        'Neaizpildîtas lietas netiks pievienotas!');
define('_ERROR_BADMAILADDRESS',        'Nepareiza epasta adrese');
define('_ERROR_BADNOTIFY',            'Epasta adrese(s) nav pareiza(s)');
define('_ERROR_BADNAME',            'Vârds nepareizs (atïauti burti a-z, cipari 0-9 un bez atstarpçm sâkumâ/beigâs)');
define('_ERROR_NICKNAMEINUSE',        'Kâdam citam ir ðâds vârds');
define('_ERROR_PASSWORDMISMATCH',    'Parolçm jâsakrît');
define('_ERROR_PASSWORDTOOSHORT',    'Parolei jâbût ar minimums 6 simboliem');
define('_ERROR_PASSWORDMISSING',    'Parole nedrîkst bût tukða');
define('_ERROR_REALNAMEMISSING',    'Hm, kautkas nav kârtîbâ ar vârdu');
define('_ERROR_ATLEASTONEADMIN',    'Vienmçr jâbût vismaz vienam super-adminam, kas var administrçt.');
define('_ERROR_ATLEASTONEBLOGADMIN','Darot ðâdi, iespçjams blog sistçma vairs nebûs administrçjama. Pârliecinies, lai vienmçr bûtu vismaz viens admins.');
define('_ERROR_ALREADYONTEAM',        'Nevar pievienot jau esoðus dalîbniekus');
define('_ERROR_BADSHORTBLOGNAME',    'Îss tava bloga nosaukums (ar burtiem a-z, cipariem 0-9 un bez atstarpçm sâkumâ/beigâs');
define('_ERROR_DUPSHORTBLOGNAME',    'Ir jau tâds blogs');
define('_ERROR_UPDATEFILE',            'Atjaunoðanas fails nepieejams. Vai failam var piekïût (pamçìini uzlikt chmod 666). Ieteicams lietot pilnu ceïu (piem. /sisteemas/celshs/uz/nucleus/)');
//'Cannot get write access to the update-file. Make sure the file permissions are set ok (try chmodding it to 666). Also note that the location is relative to the admin-area directory, so you might want to use an absolute path (something like /your/path/to/nucleus/)');
define('_ERROR_DELDEFBLOG',            'Ðis ir galvenais blogs, to nevar dzçst');
define('_ERROR_DELETEMEMBER',        'Nevar dzçst ðo dalîbnieku, iespçjams tâpçc, ka viòð ir kâdu rakstu vai komentâru autors');
define('_ERROR_BADTEMPLATENAME',    'Nepareizs sagataves nosaukums, atïauti burti a-z, cipari 0-9 un bez atstarpçm');
define('_ERROR_DUPTEMPLATENAME',    'Ir jau tâda sagatave');
define('_ERROR_BADSKINNAME',        'Nepareizs tçmas nosaukums (atïauti burti a-z, cipari 0-9 un bez atstarpçm)');
define('_ERROR_DUPSKINNAME',        'Ir jau tçma ar tâdu nosaukumu');
define('_ERROR_DEFAULTSKIN',        'Tçmai "default" jâbût un tur neko nevar darît');
define('_ERROR_SKINDEFDELETE',        'Nevar izdzçst ðo tçmu, jo tâ ir galvenâ sekojoðam blogam: ');
define('_ERROR_DISALLOWED',            'Ðâdas darbîbas ir aizliegtas');
define('_ERROR_DELETEBAN',            'Kïûda, dzçðot aizliegumu (nav tâda aizlieguma)');
define('_ERROR_ADDBAN',                'Kïûda. Ðâds aizliegums var netikt pievienots visos blogos.');
define('_ERROR_BADACTION',            'Netiklas..em.. darbîbas sodâmas pçc kriminâllikuma');
define('_ERROR_MEMBERMAILDISABLED',    'Dalîbnieks-dalîbniekam ziòu sûtîðana aizliegta');
define('_ERROR_MEMBERCREATEDISABLED','Dalîbnieku pievienoðana atslçgta');
define('_ERROR_INCORRECTEMAIL',        'Nepareiza epasta adrese');
define('_ERROR_VOTEDBEFORE',        'Par ðo jau esi balsojis');
define('_ERROR_BANNED1',            'Diemþçl man tevi jâapbçdina, jo tava IP adrese ir iekïauta aizliegto IP adreðu apgabalâ ');
define('_ERROR_BANNED2',            ' . Tu rakstîji: \'');
define('_ERROR_BANNED3',            '\'');
define('_ERROR_LOGINNEEDED',        'Pieslçdzies sistçmai, lai veiktu ðâdu darbîbu');
define('_ERROR_CONNECT',            'Pieslçgðanâs kïûda');
define('_ERROR_FILE_TOO_BIG',        'Fails ir pârâk liels!');
define('_ERROR_BADFILETYPE',        'Ðâda formâta faili ðeit ir aizliegti');
define('_ERROR_BADREQUEST',            'Fuj! Slikti darîji.');
define('_ERROR_DISALLOWEDUPLOAD',    'Nevar atrast tevi mûsu komandâ. Nu, lîdz ar to tev nesanâks uzlikt failus');
define('_ERROR_BADPERMISSIONS',        'Nepareizi uzstâdîtas failu/direktoriju atïaujas');
define('_ERROR_UPLOADMOVEP',        'Kïûda dzçðot failu');
define('_ERROR_UPLOADCOPY',            'Kïûda kopçjot failu');
define('_ERROR_UPLOADDUPLICATE',    'Fails ar ðâdu nosaukumu jau eksistç. Pirms uzlikðanas to pârsauc.');
define('_ERROR_LOGINDISALLOWED',    'Piedod, tev nav dota atïauja ðeit ârdîties kâ adminam. Bet vismaz vari padarboties kâ dalîbnieks. Uzraksti kaut ko labu');
define('_ERROR_DBCONNECT',            'Hm, mySQL serveris nokâries? Piezvani adminam');
define('_ERROR_DBSELECT',            'Hm, problçma ar blogu datu bâzi.');
define('_ERROR_NOSUCHLANGUAGE',        'Hm, problçma ar valodu failu (nav atrasts)');
define('_ERROR_NOSUCHCATEGORY',        'Hm, sadaïa netika atrasta');
define('_ERROR_DELETELASTCATEGORY',    'Jâbût vismaz vienai sadaïai');
define('_ERROR_DELETEDEFCATEGORY',    'Pamatsadaïu nedrîkst dzçst');
define('_ERROR_BADCATEGORYNAME',    'Slikts nosaukums priekð sadaïas');
define('_ERROR_DUPCATEGORYNAME',    'Ir, ir jau tâda sadaïa');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',            'Uzmanîbu: Ðis uzstâdîjums neizskatâs pçc direktorijas!');
define('_WARNING_NOTREADABLE',        'Uzmanîbu: Ðî direktorija nav redzama, ar domu - nevar nolasît!');
define('_WARNING_NOTWRITABLE',        'Uzmanîbu: Ðajâ direktorijâ neko nevar saglabât!');

// media and upload
define('_MEDIA_UPLOADLINK',            'Pievienot jaunu failu');
define('_MEDIA_MODIFIED',            'izmaiòas');
define('_MEDIA_FILENAME',            'nosaukums');
define('_MEDIA_DIMENSIONS',            'izmçri');
define('_MEDIA_INLINE',                'Iekïaut lapâ');
define('_MEDIA_POPUP',                'Atseviðís logs');
define('_UPLOAD_TITLE',                'Izvçlçties failu');
define('_UPLOAD_MSG',                'Izvçlies failu un spied \'Uzlikt\' pogu.');
define('_UPLOAD_BUTTON',            'Uzlikt');

// some status messages
define('_MSG_ACCOUNTCREATED',        'Konts izveidots, parole nosûtîta pa epastu');
define('_MSG_PASSWORDSENT',            'Parole tika nosûtîta uz attiecîgo epasta adresi.');
define('_MSG_LOGINAGAIN',            'Tev jâpieslçdzas vçleiz, jo informâcija par tevi tika izmainîta');
define('_MSG_SETTINGSCHANGED',        'Uzstâdîjumi izmainîti');
define('_MSG_ADMINCHANGED',            'Admins nomainîts');
define('_MSG_NEWBLOG',                'Jauns blogs izveidots');
define('_MSG_ACTIONLOGCLEARED',        'Statistika dzçsta');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',        'Aizliegta rîcîba: ');
define('_ACTIONLOG_PWDREMINDERSENT','Jaunâ parole nosûtîta dalîbniekam ');
define('_ACTIONLOG_TITLE',            'Statistika');
define('_ACTIONLOG_CLEAR_TITLE',    'Dzçst statistiku');
define('_ACTIONLOG_CLEAR_TEXT',        'Dzçst statistiku tûlît');

// team management
define('_TEAM_TITLE',                'Menedþçt bloga komandu ');
define('_TEAM_CURRENT',                '\'Tekoðâ\' komanda');
define('_TEAM_ADDNEW',                'Pievienot komandai jaunu dalîbnieku');
define('_TEAM_CHOOSEMEMBER',        'Izvçlçties dalîbnieku');
define('_TEAM_ADMIN',                'Admina tiesîbas? ');
define('_TEAM_ADD',                    'Pievienot komandai');
define('_TEAM_ADD_BTN',                'Pievienot komandai');

// blogsettings
define('_EBLOG_TITLE',                'Bloga modificçðana');
define('_EBLOG_TEAM_TITLE',            'Modificçt komandu');
define('_EBLOG_TEAM_TEXT',            'Spied ðeit, lai modificçtu komandu...');
define('_EBLOG_SETTINGS_TITLE',        'Bloga uzstâdîjumi');
define('_EBLOG_NAME',                'Bloga nosaukums');
define('_EBLOG_SHORTNAME',            'Îss bloga nosaukums');
define('_EBLOG_SHORTNAME_EXTRA',    '<br />(jâsatur burtus a-z un bez atstarpçm)');
define('_EBLOG_DESC',                'Bloga apraksts');
define('_EBLOG_URL',                'URL');
define('_EBLOG_DEFSKIN',            'Pamattçma');
define('_EBLOG_DEFCAT',                'Pamatsadaïa');
define('_EBLOG_LINEBREAKS',            'Konvertçt rindu pârnesumus jaunâ rindâ');
define('_EBLOG_DISABLECOMMENTS',    'Komentâri atïauti?<br /><small>(Atslçdzot komentârus, komentçðana nebûs iespçjama.)</small>');
define('_EBLOG_ANONYMOUS',            'Atïaut komentçt ciemiòiem?');
define('_EBLOG_NOTIFY',                'Apziòoðanas adrese(s) (vairâkus atdalît ar ;)');
define('_EBLOG_NOTIFY_ON',            'Apziòoðana ieslçgta');
define('_EBLOG_NOTIFY_COMMENT',        'Apziòot par jauniem komentâriem');
define('_EBLOG_NOTIFY_KARMA',        'Apziòot par balsojumiem');
define('_EBLOG_NOTIFY_ITEM',        'Apziòot par jauniem rakstiem');
define('_EBLOG_PING',                'Nosûtît ping uz Weblogs.com pçc izmaiòu veikðanas Nucleus sistçmâ?');
define('_EBLOG_MAXCOMMENTS',        'Maksimâlais atïautais komentâru skaits');
define('_EBLOG_UPDATE',                'Atjaunoðanas fails');
define('_EBLOG_OFFSET',                'Laika nobîde');
define('_EBLOG_STIME',                'Paðreizçjais servera laiks');
define('_EBLOG_BTIME',                'Paðreizçjais bloga laiks');
define('_EBLOG_CHANGE',                'Izmainît uzstâdîjumus');
define('_EBLOG_CHANGE_BTN',            'Izmainît uzstâdîjumus');
define('_EBLOG_ADMIN',                'Bloga admins');
define('_EBLOG_ADMIN_MSG',            'tev pieðíirtas admina tiesîbas');
define('_EBLOG_CREATE_TITLE',        'Izveidot jaunu blogu');
define('_EBLOG_CREATE_TEXT',        'Aizpildi formu, lai izveidotu jaunu blogu. <br /><br /> <b>Piezîme:</b> Ðeit atrodami tikai nepiecieðamâkie uzstâdîjumi. Ekstra uzstâdîjumi atrodami bloga uzstâdîjumu sadaïâ.');
define('_EBLOG_CREATE',                'Izveidot!');
define('_EBLOG_CREATE_BTN',            'Izveidot blogu');
define('_EBLOG_CAT_TITLE',            'Sadaïas');
define('_EBLOG_CAT_NAME',            'Nosaukums');
define('_EBLOG_CAT_DESC',            'Apraksts');
define('_EBLOG_CAT_CREATE',            'Jaunas sadaïas izveidoðana');
define('_EBLOG_CAT_UPDATE',            'Atjauninât sadaïu');
define('_EBLOG_CAT_UPDATE_BTN',        'Atjauninât sadaïu');

// templates
define('_TEMPLATE_TITLE',            'Modificçt veidnes');
define('_TEMPLATE_AVAILABLE_TITLE',    'Pieejamâs veidnes');
define('_TEMPLATE_NEW_TITLE',        'Jauna veidne');
define('_TEMPLATE_NAME',            'Veidnes nosaukums');
define('_TEMPLATE_DESC',            'Apraksts');
define('_TEMPLATE_CREATE',            'Izveidot veidni');
define('_TEMPLATE_CREATE_BTN',        'Izveidot veidni');
define('_TEMPLATE_EDIT_TITLE',        'Modificçt veidni');
define('_TEMPLATE_BACK',            'Atpakaï uz veidòu aprakstu');
define('_TEMPLATE_EDIT_MSG',        'Vairâkus uzstâdîjumus drîkst atstât tukðus.');
define('_TEMPLATE_SETTINGS',        'Veidnes uzstâdîjumi');
define('_TEMPLATE_ITEMS',            'Raksti');
define('_TEMPLATE_ITEMHEADER',        'Raksta aukðdaïa');
define('_TEMPLATE_ITEMBODY',        'Raksta vidusdaïa');
define('_TEMPLATE_ITEMFOOTER',        'Raksta apakðdaïa');
define('_TEMPLATE_MORELINK',        'Norâde uz pilnu rakstu');
define('_TEMPLATE_NEW',                'Norâde uz jaunu rakstu');
define('_TEMPLATE_COMMENTS_ANY',    'Komentâri (ja ir)');
define('_TEMPLATE_CHEADER',            'Komentâru aukðdaïa');
define('_TEMPLATE_CBODY',            'Komentâru vidusdaïa');
define('_TEMPLATE_CFOOTER',            'Komentâru apakðdaïa');
define('_TEMPLATE_CONE',            'Viens komentârs');
define('_TEMPLATE_CMANY',            'Divi (vai vairâk) komentâri');
define('_TEMPLATE_CMORE',            'Lasît vairâk komentârus');
define('_TEMPLATE_CMEXTRA',            'Member Extra');
define('_TEMPLATE_COMMENTS_NONE',    'Ja nav komentâru');
define('_TEMPLATE_CNONE',            'Komentâru nav');
define('_TEMPLATE_COMMENTS_TOOMUCH','Ja ir pârâk daudz komentâru');
define('_TEMPLATE_CTOOMUCH',        'Pârâk daudz komentâru');
define('_TEMPLATE_ARCHIVELIST',        'Kâ izskatâs arhîvi');
define('_TEMPLATE_AHEADER',            'Arhîva augðdaïa');
define('_TEMPLATE_AITEM',            'Arhîva vidusdaïa');
define('_TEMPLATE_AFOOTER',            'Arhîva apakðdaïa');
define('_TEMPLATE_DATETIME',        'Datums un laiks');
define('_TEMPLATE_DHEADER',            'Datuma augðdaïa');
define('_TEMPLATE_DFOOTER',            'Datuma apakðdaïa');
define('_TEMPLATE_DFORMAT',            'Datuma formâts');
define('_TEMPLATE_TFORMAT',            'Laika formâts');
define('_TEMPLATE_LOCALE',            'Lokâlais uzstâdîjums');
define('_TEMPLATE_IMAGE',            'Izlecoðie attçli');
define('_TEMPLATE_PCODE',            'Kods izlecoðajam linkam');
define('_TEMPLATE_ICODE',            'Lapâ iekïaujamâ attçla kods');
define('_TEMPLATE_MCODE',            'Mçdija objekta kods');
define('_TEMPLATE_SEARCH',            'Meklçðanas sistçma');
define('_TEMPLATE_SHIGHLIGHT',        'Vârdu izcelðana');
define('_TEMPLATE_SNOTFOUND',        'Ja nekas nav atrasts');
define('_TEMPLATE_UPDATE',            'Izmaiòu veikðana');
define('_TEMPLATE_UPDATE_BTN',        'Saglabât izmaiòas veidnç');
define('_TEMPLATE_RESET_BTN',        'Noklusçtâs vçrtîbas');
define('_TEMPLATE_CATEGORYLIST',    'Sadaïu saraksti');
define('_TEMPLATE_CATHEADER',        'Sadaïu saraksta augðdaïa');
define('_TEMPLATE_CATITEM',            'Sadaïu saraksta vidusdaïa');
define('_TEMPLATE_CATFOOTER',        'Sadaïu saraksta apakðdaïa');

// skins
define('_SKIN_EDIT_TITLE',            'Modificçt tçmas');
define('_SKIN_AVAILABLE_TITLE',        'Pieejamâs tçmas');
define('_SKIN_NEW_TITLE',            'Jauna tçma');
define('_SKIN_NAME',                'Nosaukums');
define('_SKIN_DESC',                'Apraksts');
define('_SKIN_TYPE',                '"Content Type"');
define('_SKIN_CREATE',                'Izveidoðana');
define('_SKIN_CREATE_BTN',            'Izveidot tçmu');
define('_SKIN_EDITONE_TITLE',        'Modificçt tçmu');
define('_SKIN_BACK',                'Atpakaï pie tçmu apraksta');
define('_SKIN_PARTS_TITLE',            'Katras lapas tçma');
define('_SKIN_PARTS_MSG',            'Ne visi uzstâdîjumi ir obligâti. Nevajadzîgos var atstât tukðus. Tçmas iespçjams mainît ðâdâm sadaïâm:');
define('_SKIN_PART_MAIN',            'Galvenâ lapa');
define('_SKIN_PART_ITEM',            'Raksti');
define('_SKIN_PART_ALIST',            'Arhîvu saraksts');
define('_SKIN_PART_ARCHIVE',        'Arhîvs');
define('_SKIN_PART_SEARCH',            'Meklçðana');
define('_SKIN_PART_ERROR',            'Kïûdu paziòojumi');
define('_SKIN_PART_MEMBER',            'Informâcija par dalîbniekiem');
define('_SKIN_PART_POPUP',            'Izlecoðie attçli');
define('_SKIN_GENSETTINGS_TITLE',    'Infomâcija par tçmu');
define('_SKIN_CHANGE',                'Izmaiòas');
define('_SKIN_CHANGE_BTN',            'Saglabât izmaiòas');
define('_SKIN_UPDATE_BTN',            'Saglabât izmaiòas');
define('_SKIN_RESET_BTN',            'Noklusçtie uzstâdîjumi');
define('_SKIN_EDITPART_TITLE',        'Modificçt tçmu');
define('_SKIN_GOBACK',                'Atpakaï');
define('_SKIN_ALLOWEDVARS',            'Pieejamie uzstâdîjumi (sîkâka informâcija, uzklikðíinot):');

// global settings
define('_SETTINGS_TITLE',            'Galvenie uzstâdîjumi');
define('_SETTINGS_SUB_GENERAL',        'Galvenie uzstâdîjumi');
define('_SETTINGS_DEFBLOG',            'Primârais blogs');
define('_SETTINGS_ADMINMAIL',        'Admina epasta adrese');
define('_SETTINGS_SITENAME',        'Mâjas lapas nosaukums');
define('_SETTINGS_SITEURL',            'Lapas URL (ar slîpsvîtru beigâs)');
define('_SETTINGS_ADMINURL',        'Administrçðanas URL (ar slîpsvîtru beigâs)');
define('_SETTINGS_DIRS',            'Nucleus pilna atraðanâs vieta sistçmâ');
define('_SETTINGS_MEDIADIR',        'Mçdiju direktorija');
define('_SETTINGS_SEECONFIGPHP',    '(skat. config.php)');
define('_SETTINGS_MEDIAURL',        'Mçdiju URL (ar slîpsvîtru beigâs)');
define('_SETTINGS_ALLOWUPLOAD',        'Atïaut likt failus?');
define('_SETTINGS_ALLOWUPLOADTYPES','Atïautie failu formâti');
define('_SETTINGS_CHANGELOGIN',        'Atïaut dalîbniekiem mainît vârdu/paroli');
define('_SETTINGS_COOKIES_TITLE',    'Cookie uzstâdîjumi');
define('_SETTINGS_COOKIELIFE',        'Sistçmas Cookie ilgums');
define('_SETTINGS_COOKIESESSION',    'tik pat, cik sesija');
define('_SETTINGS_COOKIEMONTH',        'viens mçnesis');
define('_SETTINGS_COOKIEPATH',        'Cookie ceïð (advanced)');
define('_SETTINGS_COOKIEDOMAIN',    'Cookie domçns (advanced)');
define('_SETTINGS_COOKIESECURE',    'Droðie Cookie (advanced)');
define('_SETTINGS_LASTVISIT',        'Saglabât pçdçjâ apmeklçjuma Cookies');
define('_SETTINGS_ALLOWCREATE',        'Atïaut visiem apmeklçtâjiem reìistrçties');
define('_SETTINGS_NEWLOGIN',        'Atïaut pieslçgties kâ administratoram uzreiz pçc reìistrçðanâs');
define('_SETTINGS_NEWLOGIN2',        '(tikai jaunizveidotiem)');
define('_SETTINGS_MEMBERMSGS',        'Atïaut izmantot dalîbnieks-dalîbniekam servisu');
define('_SETTINGS_LANGUAGE',        'Valoda');
define('_SETTINGS_DISABLESITE',        'Apstâdinât sistçmu');
define('_SETTINGS_DBLOGIN',            'mySQL DB informâcija');
define('_SETTINGS_UPDATE',            'Uzstâdîjumu saglabâðana');
define('_SETTINGS_UPDATE_BTN',        'Saglabât izmaiòas');
define('_SETTINGS_DISABLEJS',        'Atslçgt JavaScript paneli');
define('_SETTINGS_MEDIA',            'Mediju/Failu uzstâdîjumi');
define('_SETTINGS_MEDIAPREFIX',        'Failu nosaukumu sâkumu likt tekoðo datumu');
define('_SETTINGS_MEMBERS',            'Dalîbnieku uzstâdîjumi');

// bans
define('_BAN_TITLE',                'Aizliegumi: ');
define('_BAN_NONE',                    'Ðim blogam nav IP adreðu aizliegumu');
define('_BAN_NEW_TITLE',            'Pievienot jaunu aizliegumu');
define('_BAN_NEW_TEXT',                'Pievienot aizliegumu(s)');
define('_BAN_REMOVE_TITLE',            'Noòemt aizliegumu(s)');
define('_BAN_IPRANGE',                'IP adreðu apgabals');
define('_BAN_BLOGS',                'Kâdiem blogiem?');
define('_BAN_DELETE_TITLE',            'Dzçst aizliegumu');
define('_BAN_ALLBLOGS',                'Visi blogi, kurâ esi admins.');
define('_BAN_REMOVED_TITLE',        'Aizliegums noòemts');
define('_BAN_REMOVED_TEXT',            'Aizliegums noòemts no sekojoðiem blogiem:');
define('_BAN_ADD_TITLE',            'Pievienot aizliegumu');
define('_BAN_IPRANGE_TEXT',            'Izvçlies bloíçjamo IP adreðu apgabalu. Jo mazâk ciparu IP adresç, jo lielâks apgabals tiks bloíçts.');
define('_BAN_BLOGS_TEXT',            'Var bloíçt pieeju vienam noteiktam blogam vai arî visiem blogiem, kurâ esi administrators.');
define('_BAN_REASON_TITLE',            'Iemesls');
define('_BAN_REASON_TEXT',            'Pievieno iemeslu, kâpçc dalîbniekam tiek bloíçta pieeja. Maksimums 256 simboli.');
define('_BAN_ADD_BTN',                'Pievienot aizliegumu');

// LOGIN screen
define('_LOGIN_MESSAGE',            'Ziòojums');
define('_LOGIN_NAME',                'Vârds/nosaukums');
define('_LOGIN_PASSWORD',            'Parole');
define('_LOGIN_SHARED',                _LOGINFORM_SHARED);
define('_LOGIN_FORGOT',                'Aizmirsâs parole?');

// membermanagement
define('_MEMBERS_TITLE',            'Dalîbnieku menedþments');
define('_MEMBERS_CURRENT',            'Reìistrçtie dalîbnieki');
define('_MEMBERS_NEW',                'Jauns dalîbnieks');
define('_MEMBERS_DISPLAY',            'Atspoguïojamais vârds');
define('_MEMBERS_DISPLAY_INFO',        '(segvârds, ar kuru pieslçdzas sistçmai)');
define('_MEMBERS_REALNAME',            'Pilnais vârds');
define('_MEMBERS_PWD',                'Parole');
define('_MEMBERS_REPPWD',            'Atkârtot paroli');
define('_MEMBERS_EMAIL',            'Epasta adrese');
define('_MEMBERS_EMAIL_EDIT',        '(Mainot epasta adresi, jaunâ parole<br /> automâtiski nosûtîsies uz jauno adresi)');
define('_MEMBERS_URL',                'Mâjas lapa (URL)');
define('_MEMBERS_SUPERADMIN',        'Admina tiesîbas');
define('_MEMBERS_CANLOGIN',            'Var pieslçgties adminu sadaïai');
define('_MEMBERS_NOTES',            'Piezîmes');
define('_MEMBERS_NEW_BTN',            'Pievienot');
define('_MEMBERS_EDIT',                'Modificçt dalîbnieka informâciju');
define('_MEMBERS_EDIT_BTN',            'Mainît uzstâdîjumus');
define('_MEMBERS_BACKTOOVERVIEW',    'Atpakaï uz Dalîbnieku informâciju');
define('_MEMBERS_DEFLANG',            'Valoda');
define('_MEMBERS_USESITELANG',        '- sistçmas pamatvaloda -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',        'apmeklçt saitu');
define('_BLOGLIST_ADD',                'Pievienot');
define('_BLOGLIST_TT_ADD',            'Pievienot jaunu rakstu ðim blogam');
define('_BLOGLIST_EDIT',            'Modificçt/dzçst');
define('_BLOGLIST_TT_EDIT',            '');
define('_BLOGLIST_BMLET',            'Noderîgas saites');
define('_BLOGLIST_TT_BMLET',        '');
define('_BLOGLIST_SETTINGS',        'Uzstâdîjumi');
define('_BLOGLIST_TT_SETTINGS',        'Modificçt uzstâdîjumus vai informâciju par komandu');
define('_BLOGLIST_BANS',            'Aizliegumi');
define('_BLOGLIST_TT_BANS',            'Skatît/pievienot/dzçst bloíçtâs IP');
define('_BLOGLIST_DELETE',            'Dzçst visu');
define('_BLOGLIST_TT_DELETE',        'Dzçst ðo blogu');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',            'Tavi blogi');
define('_OVERVIEW_YRDRAFTS',        'Tavas sagataves');
define('_OVERVIEW_YRSETTINGS',        'Tavi uzstâdîjumi');
define('_OVERVIEW_GSETTINGS',        'Galvenie uzstâdîjumi');
define('_OVERVIEW_NOBLOGS',            'Tu neesi nevienâ blogu komandâ');
define('_OVERVIEW_NODRAFTS',        'Sagatavju nav');
define('_OVERVIEW_EDITSETTINGS',    'Modificçt savus uzstâdîjumus...');
define('_OVERVIEW_BROWSEITEMS',        'Skatîties savus rakstus...');
define('_OVERVIEW_BROWSECOMM',        'Skatîties savus komentârus...');
define('_OVERVIEW_VIEWLOG',            'Skatîties statistiku...');
define('_OVERVIEW_MEMBERS',            'Administrçt dalîbniekus...');
define('_OVERVIEW_NEWLOG',            'Izveidot jaunu blogu...');
define('_OVERVIEW_SETTINGS',        'Modificçt uzstâdîjumus...');
define('_OVERVIEW_TEMPLATES',        'Modificçt veidnes...');
define('_OVERVIEW_SKINS',            'Modificçt tçmas...');
define('_OVERVIEW_BACKUP',            'Rezerves kopija/Atjaunoðana...');

// ITEMLIST
define('_ITEMLIST_BLOG',            'Kas atrodams blogâ, ar nosaukumu');
define('_ITEMLIST_YOUR',            'Tavi raksti');

// Comments
define('_COMMENTS',                    'Komentâri');
define('_NOCOMMENTS',                'Nav komentâru');
define('_COMMENTS_YOUR',            'Tavi komentâri');
define('_NOCOMMENTS_YOUR',            'Neesi rakstîjis komentârus');

// LISTS (general)
define('_LISTS_NOMORE',                'Vairâk rezultâtu nav vai rezultâtu nav vispâr');
define('_LISTS_PREV',                'Iepriekðçjie');
define('_LISTS_NEXT',                'Nâkamie');
define('_LISTS_SEARCH',                'Meklçt');
define('_LISTS_CHANGE',                'Modificçt');
define('_LISTS_PERPAGE',            'rezultâti/lapâ');
define('_LISTS_ACTIONS',            'Darbîbas');
define('_LISTS_DELETE',                'Dzçst');
define('_LISTS_EDIT',                'Modificçt');
define('_LISTS_MOVE',                'Pârvietot');
define('_LISTS_CLONE',                'Klonçt');
define('_LISTS_TITLE',                'Virsraksts');
define('_LISTS_BLOG',                'Blogs');
define('_LISTS_NAME',                'Nosaukums');
define('_LISTS_DESC',                'Apraksts');
define('_LISTS_TIME',                'Laiks');
define('_LISTS_COMMENTS',            'Komentâri');
define('_LISTS_TYPE',                'Formâts');


// member list
define('_LIST_MEMBER_NAME',            'Publicçjamais vârds');
define('_LIST_MEMBER_RNAME',        'Îstais vârds');
define('_LIST_MEMBER_ADMIN',        'Super-admins? ');
define('_LIST_MEMBER_LOGIN',        'Var pieslçgties? ');
define('_LIST_MEMBER_URL',            'Mâjas lapa');

// banlist
define('_LIST_BAN_IPRANGE',            'IP apgabals');
define('_LIST_BAN_REASON',            'Iemesls');

// actionlist
define('_LIST_ACTION_MSG',            'Ziòojums');

// commentlist
define('_LIST_COMMENT_BANIP',        'Bloíçt IP');
define('_LIST_COMMENT_WHO',            'Autors');
define('_LIST_COMMENT',                'Komentâri');
define('_LIST_COMMENT_HOST',        'Hosts');

// itemlist
define('_LIST_ITEM_INFO',            'Info');
define('_LIST_ITEM_CONTENT',        'Virsraksts un teksts');


// teamlist
define('_LIST_TEAM_ADMIN',            'Admins ');
define('_LIST_TEAM_CHADMIN',        'Mainam adminu');

// edit comments
define('_EDITC_TITLE',                'Modificçt komentârus');
define('_EDITC_WHO',                'Autors');
define('_EDITC_HOST',                'No kurienes?');
define('_EDITC_WHEN',                'Kad?');
define('_EDITC_TEXT',                'Teksts');
define('_EDITC_EDIT',                'Modificçt komentâru');
define('_EDITC_MEMBER',                'dalîbnieks');
define('_EDITC_NONMEMBER',            'ciemiòð');

// move item
define('_MOVE_TITLE',                'Uz kuru blogu?');
define('_MOVE_BTN',                    'Pârvietot...');

?>