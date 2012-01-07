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
define('_MEDIA_VIEW_TT',			'Skatīt failu (jaunā logā)');
define('_MEDIA_FILTER_APPLY',		'Pievienot filtru');
define('_MEDIA_FILTER_LABEL',		'Filtrs: ');
define('_MEDIA_UPLOAD_TO',			'Uzlikt uz...');
define('_MEDIA_UPLOAD_NEW',			'Uzlikt jaunu failu...');
define('_MEDIA_COLLECTION_SELECT',	'Izvēlēties');
define('_MEDIA_COLLECTION_TT',		'Pāriet uz sadaļu');
define('_MEDIA_COLLECTION_LABEL',	'Pašreizējā kolekcija: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'Kreisajā pusē');
define('_ADD_ALIGNRIGHT_TT',		'Labajā pusē');
define('_ADD_ALIGNCENTER_TT',		'Iecentrēts');

// searchable blog setting (yes/no)
define('_EBLOG_SEARCH',				'Pievienot meklēšanas indeksam');

// generic upload failure
define('_ERROR_UPLOADFAILED',		'Kļūdas rezultātā fails netika pievienots.');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'Atļaut sūtīt ar atpakaļejošu datumu');
define('_ADD_CHANGEDATE',			'Izmainīt laiku');
define('_BMLET_CHANGEDATE',			'Izmainīt laiku');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'Noformējuma imports/eksports...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Vienkārši');
define('_PARSER_INCMODE_SKINDIR',	'Izmantot skins direktoriju');
define('_SKIN_INCLUDE_MODE',		'Pievienošanas veids');
define('_SKIN_INCLUDE_PREFIX',		'Pievienošanas prefikss');

// global settings
define('_SETTINGS_BASESKIN',		'Pamatnoformējums');
define('_SETTINGS_SKINSURL',		'Noformējuma pakotnes URL');
define('_SETTINGS_ACTIONSURL',		'Pilns URL uz action.php');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'Nevar pārvietot pamatsadaļu');
define('_ERROR_MOVETOSELF',			'Nevar pārvietot sadaļu (abas sadaļas ir viens un tas pats)');
define('_MOVECAT_TITLE',			'Izvēlies kura bloga sadaļu pārvietot');
define('_MOVECAT_BTN',				'Pārvietot sadaļu');

// URLMode setting
define('_SETTINGS_URLMODE',			'URL režīms');
define('_SETTINGS_URLMODE_NORMAL',	'Normal');
define('_SETTINGS_URLMODE_PATHINFO','Fancy');

// Batch operations
define('_BATCH_NOSELECTION',		'Nav iezīmēti objekti');
define('_BATCH_ITEMS',				'Strādāt ar ierakstiem');
define('_BATCH_CATEGORIES',			'Strādāt ar sadaļām');
define('_BATCH_MEMBERS',			'Strādāt ar lietotājiem');
define('_BATCH_TEAM',				'Strādāt ar lietotāju grupu');
define('_BATCH_COMMENTS',			'Strādāt ar komentāriem');
define('_BATCH_UNKNOWN',			'Nepareiza operācija: ');
define('_BATCH_EXECUTING',			'Izpildīšana');
define('_BATCH_ONCATEGORY',			'sadaļa');
define('_BATCH_ONITEM',				'ieraksts');
define('_BATCH_ONCOMMENT',			'komentārs');
define('_BATCH_ONMEMBER',			'lietotājs');
define('_BATCH_ONTEAM',				'lietotāju grupa');
define('_BATCH_SUCCESS',			'Veiksmīgi!');
define('_BATCH_DONE',				'Padarīts!');
define('_BATCH_DELETE_CONFIRM',		'Apstiprināt dzēšanu');
define('_BATCH_DELETE_CONFIRM_BTN',	'Apstiprināt dzēšanu');
define('_BATCH_SELECTALL',			'iezīmēt visu');
define('_BATCH_DESELECTALL',		'noņemt visus iezīmējumus');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'Dzēst');
define('_BATCH_ITEM_MOVE',			'Pārvietot');
define('_BATCH_MEMBER_DELETE',		'Dzēst');
define('_BATCH_MEMBER_SET_ADM',		'Piešķirt administratora tiesības');
define('_BATCH_MEMBER_UNSET_ADM',	'Atņemt administratora tiesības');
define('_BATCH_TEAM_DELETE',		'Dzēst no grupas');
define('_BATCH_TEAM_SET_ADM',		'Piešķirt administratora tiesības');
define('_BATCH_TEAM_UNSET_ADM',		'Atņemt administratora tiesības');
define('_BATCH_CAT_DELETE',			'Dzēst');
define('_BATCH_CAT_MOVE',			'Pārvietot uz citu blogu');
define('_BATCH_COMMENT_DELETE',		'Dzēst');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'Pievienot jaunu ierakstu...');
define('_ADD_PLUGIN_EXTRAS',		'Pluginu ekstra opcijas');

// errors
define('_ERROR_CATCREATEFAIL',		'Nevar izveidot jaunu sadaļu');
define('_ERROR_NUCLEUSVERSIONREQ',	'Šī plugina aktivizēšanai nepieciešama jaunāka Nucleus versija: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Atpakaļ uz bloga uzstādījumiem');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Importēt');
define('_SKINIE_TITLE_EXPORT',		'Eksportēt');
define('_SKINIE_BTN_IMPORT',		'Importēt');
define('_SKINIE_BTN_EXPORT',		'Eksportēt izvēlētos noformējumus/sagataves');
define('_SKINIE_LOCAL',				'Importēt no lokāla faila:');
define('_SKINIE_NOCANDIDATES',		'Skins direktorijā nekas importējams nav atrasts');
define('_SKINIE_FROMURL',			'importēt no URL:');
define('_SKINIE_EXPORT_INTRO',		'Izvēlies noformējumu un sagataves, kuras eksportēt');
define('_SKINIE_EXPORT_SKINS',		'Noformējums (skins)');
define('_SKINIE_EXPORT_TEMPLATES',	'Sagataves');
define('_SKINIE_EXPORT_EXTRA',		'Papildus info');
#define('_SKINIE_CONFIRM_OVERWRITE', 'Pārrakstīt jau eksistējošus noformējumus (see nameclashes)');
define('_SKINIE_CONFIRM_OVERWRITE',	'Pārrakstīt jau eksistējošus noformējumus');
define('_SKINIE_CONFIRM_IMPORT',	'Jā, importēt');
define('_SKINIE_CONFIRM_TITLE',		'Noformējuma un sagatavju importēšana');
define('_SKINIE_INFO_SKINS',		'Noformējumi failā:');
define('_SKINIE_INFO_TEMPLATES',	'Sagataves failā:');
define('_SKINIE_INFO_GENERAL',		'Info:');
define('_SKINIE_INFO_SKINCLASH',	'Noformējuma nesaderība (clashes):');
define('_SKINIE_INFO_TEMPLCLASH',	'Sagatavju nosaukumu nesaderība (clashes):');
define('_SKINIE_INFO_IMPORTEDSKINS','Importētie noformējumi:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Importētās sagataves:');
define('_SKINIE_DONE',				'Importēšana veiksmīgi paveikta');

define('_AND',						'un');
define('_OR',						'vai');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'tukšs lauks (klikšķini, lai modificētu)');

// skin overview list
//
// need to see in reality, then translate.
// will be translated l8r       -Kaspars
//
define('_LIST_SKINS_INCMODE',		'IncludeMode:');
define('_LIST_SKINS_INCPREFIX',		'IncludePrefix:');
define('_LIST_SKINS_DEFINED',		'Defined parts:');

// backup
define('_BACKUPS_TITLE',			'Rezerves kopija / Atjaunošana');
define('_BACKUP_TITLE',				'Rezerves kopija');
define('_BACKUP_INTRO',				'Klikšķini uz pogas, lai izveidotu Nucleus rezerves kopiju. Rezerves kopija būs jasaglabā uz tava cietā diska.');
define('_BACKUP_ZIP_YES',			'Kompresēt');
define('_BACKUP_ZIP_NO',			'Nekompresēt');
define('_BACKUP_BTN',				'Izveidot kopiju');
define('_BACKUP_NOTE',				'<b>Piezīme:</b> Rezerves kopijā tiek uzglabāti tikai datu bāzē esošie dati. Attēli un citi faili <b>NETIEK</b> iekļauti.');
define('_RESTORE_TITLE',			'Atjaunot');
define('_RESTORE_NOTE',				'<b>UZMANĪBU:</b> Atjaunošanas rezultātā visi Nucleus datu bāzē esošie dati tiks <b>DZĒSTI</b>, tāpēc vairākkārt pārliecinies, vai ir izveidota rezerves kopija1<br />	<b>Piezīme:</b> Rezerves kopijas datiem jābūt no tās pašas Nucleus versijas, kas pašlaik ir uzinstalēta pretējā gadījumā Nucleus nestrādās!');
define('_RESTORE_INTRO',			'Izvēlies attiecīgu failu, no kura atjaunot datu bāzi.');
define('_RESTORE_IMSURE',			'Jā, esmu gatavs!');
define('_RESTORE_BTN',				'Atjaunot no faila');
define('_RESTORE_WARNING',			'(vēlreiz pārliecinies, vai ir izveidota rezerves kopija)');
define('_ERROR_BACKUP_NOTSURE',		'Jāiezīmē \'Jā, esmu gatavs!\' lauciņš');
define('_RESTORE_COMPLETE',			'Atjaunošana pabeigta');

// new item notification
define('_NOTIFY_NI_MSG',			'Jauns ieraksts:');
define('_NOTIFY_NI_TITLE',			'Jauns!');
// ""wtf is karma here? And how to tranlsate it? :)"  -Kaspars
//define('_NOTIFY_KV_MSG',            'Karma vote on item:');
//define('_NOTIFY_KV_TITLE',            'Nucleus karma:');
define('_NOTIFY_KV_MSG',			'Karma ierakstam:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'Ieraksta komentārs:');
define('_NOTIFY_NC_TITLE',			'Nucleus komentārs:');
define('_NOTIFY_USERID',			'Lietotāja ID:');
define('_NOTIFY_USER',				'Lietotājs:');
define('_NOTIFY_COMMENT',			'Komentārs:');
define('_NOTIFY_VOTE',				'Vērtējums:');
define('_NOTIFY_HOST',				'Adrese:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'Lietotājs:');
define('_NOTIFY_TITLE',				'Virsraksts:');
define('_NOTIFY_CONTENTS',			'Saturs:');

// member mail message
define('_MMAIL_MSG',				'Nosūtījusi');
define('_MMAIL_FROMANON',			'anonīma persona');
define('_MMAIL_FROMNUC',			'Nosūtīts no Nucleus [web]bloga');
define('_MMAIL_TITLE',				'Vēstule no');
define('_MMAIL_MAIL',				'Ziņa:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',                'Pievienot');
define('_BMLET_EDIT',                'Modificēt');
define('_BMLET_DELETE',                'Dzēst');
define('_BMLET_BODY',                'Paplašināti');
define('_BMLET_MORE',                'Vienkārši');
define('_BMLET_OPTIONS',            'Opcijas');
define('_BMLET_PREVIEW',            'Apskatīt');

// used in bookmarklet
define('_ITEM_UPDATED',                'Ieraksts izmainīts');
define('_ITEM_DELETED',                'Ieraksts dzēsts');

// plugins
define('_CONFIRMTXT_PLUGIN',        'Tiešām dzēst pluginu ');
define('_ERROR_NOSUCHPLUGIN',        'Nav tāda plugina');
define('_ERROR_DUPPLUGIN',            'Tāds plugins jau ir');
define('_ERROR_PLUGFILEERROR',        'Nav tāda plugina vai arī nav piekļuves tiesību');
define('_PLUGS_NOCANDIDATES',        'Nav atrasts neviens plugins');

define('_PLUGS_TITLE_MANAGE',        'Plugini');
define('_PLUGS_TITLE_INSTALLED',    'Pašlaik aktīvie');
define('_PLUGS_TITLE_UPDATE',        'Atjaunot sarakstu');
define('_PLUGS_TEXT_UPDATE',        'Nucleus saglabā kešā pluginu sarakstu. Atjaunojot/mainot pluginus, jāpārliecinās vai šis saraksts arī tiek atjaunots');
define('_PLUGS_TITLE_NEW',            'Pievienot pluginus');
define('_PLUGS_ADD_TEXT',            'Zemāk redzams visu pieejamo pluginu saraksts, kas nav uzinstalēti. Vēlreiz papildus pārliecinies, vai šajā saraksta atrodamie plugini tiešām ir plugini!');
define('_PLUGS_BTN_INSTALL',        'Instalēt pluginu');
define('_BACKTOOVERVIEW',            'Atpakaļ uz aprakstu');

// editlink
define('_TEMPLATE_EDITLINK',        'Modificēt linku');

// add left / add right tooltips
define('_ADD_LEFT_TT',                'Pievienot lodziņu kreisajā pusē');
define('_ADD_RIGHT_TT',                'Pievienot lodziņu labajā pusē');

// add/edit item: new category (in dropdown box)
// category = sadaļa
define('_ADD_NEWCAT',                'Jauna sadaļa');

// new settings
define('_SETTINGS_PLUGINURL',        'Plugina URL');
define('_SETTINGS_MAXUPLOADSIZE',    'Max. faila izmērs (bytes)');
define('_SETTINGS_NONMEMBERMSGS',    'Atļaut sūtīt ciemiņiem');
define('_SETTINGS_PROTECTMEMNAMES',    'Aizsargāt dalībnieku vārdus');

// overview screen
define('_OVERVIEW_PLUGINS',            'Administrēt pluginus...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',        'Jauna dalībnieka reģistrācija:');

// membermail (when not logged in)
// email = epasts
define('_MEMBERMAIL_MAIL',            'Tava epasta adrese:');

// file upload
//You do not have admin rights on any of the blogs that have the destination member on the //teamlist. Therefor, you\'re not allowed to upload files to this member\'s media directory
define('_ERROR_DISALLOWEDUPLOAD2',    'Tev nav pieejamas upload tiesības attiecīgā dalībnieka media katalogā');


// plugin list
define('_LISTS_INFO',                'Informācija');
define('_LIST_PLUGS_AUTHOR',        'Autors:');
define('_LIST_PLUGS_VER',            'Versija:');
define('_LIST_PLUGS_SITE',            'Mājas lapa');
define('_LIST_PLUGS_DESC',            'Apraksts:');
define('_LIST_PLUGS_SUBS',            'Tiek pierakstīts sekojošiem notikumiem:');
define('_LIST_PLUGS_UP',            'pārvietot uz augšu');
define('_LIST_PLUGS_DOWN',            'pārvietot uz leju');
define('_LIST_PLUGS_UNINSTALL',        'deinstalēt');
define('_LIST_PLUGS_ADMIN',            'admin');
define('_LIST_PLUGS_OPTIONS',        'modificēšanas&nbsp;opcijas');

// plugin option list
define('_LISTS_VALUE',                'Iestatījums');

// plugin options
define('_ERROR_NOPLUGOPTIONS',        'šim pluginam pašlaik nav neviena iestatījuma');
define('_PLUGS_BACK',                'Atpakaļ uz plugina aprakstu');
define('_PLUGS_SAVE',                'Saglabāt izmaiņas');
define('_PLUGS_OPTIONS_UPDATED',    'Plugina opcijas saglabātas');

define('_OVERVIEW_MANAGEMENT',        'Menedžments');
define('_OVERVIEW_MANAGE',            'Nucleus menedžments...');
define('_MANAGE_GENERAL',            'Galvenais menedžments');
define('_MANAGE_SKINS',                'Tēmas un veidnes');
define('_MANAGE_EXTRA',                'Extra fīčas');

define('_BACKTOMANAGE',                'Atpakaļ uz Nucleus menedžmentu');


// END introduced after v1.1 END




// charset to use
define('_CHARSET',                    'windows-1257');

// global stuff
define('_LOGOUT',                    'Atslēgties');
define('_LOGIN',                    'Pieslēgties');
define('_YES',                        'Jā');
define('_NO',                        'Nē');
define('_SUBMIT',                    'Apstiprināt');
define('_ERROR',                    'Kļūda');
define('_ERRORMSG',                    'Kļūda!');
define('_BACK',                        'Atgriezties');
define('_NOTLOGGEDIN',                'Nav pieslēguma');
define('_LOGGEDINAS',                'Pieslēdzies kā');
define('_ADMINHOME',                'Admina sadaļa');
define('_NAME',                        'Vārds/nosaukums');
define('_BACKHOME',                    'Atpakaļ uz admina sadaļu');
define('_BADACTION',                'Pieprasījumu nav iespējams izpildīt');
define('_MESSAGE',                    'Ziņojums');
define('_HELP_TT',                    'Palīgā!');
define('_YOURSITE',                    'Galvenā lapa');


define('_POPUP_CLOSE',                'Aizvērt logu');

define('_LOGIN_PLEASE',                'Vispirms pieslēdzies sistēmai');

// commentform
define('_COMMENTFORM_YOUARE',        'Tu esi');
define('_COMMENTFORM_SUBMIT',        'Komentēt');
define('_COMMENTFORM_COMMENT',        'Tavs komentārs');
define('_COMMENTFORM_NAME',            'Vārds');
define('_COMMENTFORM_MAIL',            'Epasts/HTTP');
define('_COMMENTFORM_REMEMBER',        'Atcerēties mani turpmāk');

// loginform
define('_LOGINFORM_NAME',            'Dalībnieks');
define('_LOGINFORM_PWD',            'Parole');
define('_LOGINFORM_YOUARE',            'Pieslēdzies kā');
define('_LOGINFORM_SHARED',            'Koplietošanas dators (piem. e-cafe)');

// member mailform
define('_MEMBERMAIL_SUBMIT',        'Nosūtīt');

// search form
define('_SEARCHFORM_SUBMIT',        'Meklēt');

// add item form
define('_ADD_ADDTO',                'Pievienot pie');
define('_ADD_CREATENEW',            'Izveidot jaunu');
define('_ADD_BODY',                    'Teksts');
define('_ADD_TITLE',                'Virsraksts');
define('_ADD_MORE',                    'Pievienot tekstu (nav obligāti)');
define('_ADD_CATEGORY',                'Sadaļa (JĀIZVĒLAS SAVĒJĀ!)');
define('_ADD_PREVIEW',                'Apskatīt');
define('_ADD_DISABLE_COMMENTS',        'Atslēgt komentārus?');
define('_ADD_DRAFTNFUTURE',            'Sagataves nākotnei');
define('_ADD_ADDITEM',                'Pievienot');
define('_ADD_ADDNOW',                'Pievienot tagad');
define('_ADD_ADDLATER',                'Pievienot vēlāk');
define('_ADD_PLACE_ON',                'Vieta');
define('_ADD_ADDDRAFT',                'Pievienot sagatavēm');
define('_ADD_NOPASTDATES',            '(pagātnes datumi un laiki nav iespējami, šajā gadījumā tiks lietots šābrīža laiks)');
define('_ADD_BOLD_TT',                'Treknrakstā');
define('_ADD_ITALIC_TT',            'Slīprakstā');
define('_ADD_HREF_TT',                'Haiperlinks');
define('_ADD_MEDIA_TT',                'Pievienot mēdiju');
define('_ADD_PREVIEW_TT',            'Parādīt/paslēpt to, kā izskatīsies');
define('_ADD_CUT_TT',                'Izņemt');
define('_ADD_COPY_TT',                'Kopēt');
define('_ADD_PASTE_TT',                'Ielīmēt (paste)');


// edit item form
define('_EDIT_ITEM',                'Modificēt');
define('_EDIT_SUBMIT',                'Modificēt');
define('_EDIT_ORIG_AUTHOR',            'Oriģināla autors');
define('_EDIT_BACKTODRAFTS',        'Pievienot atpakaļ, sagatavēs');
define('_EDIT_COMMENTSNOTE',        '(piezīme: visi iepriekš ierakstītie komentāri netiks paslēpti)');


// used on delete screens
define('_DELETE_CONFIRM',            'Lūdzu apstiprini dzēšanu');
define('_DELETE_CONFIRM_BTN',        'Apstiprināt');
define('_CONFIRMTXT_ITEM',            'Tu vēlies izdzēst sekojošu ziņu:');
define('_CONFIRMTXT_COMMENT',        'Tu vēlies izdzēst sekojošu komentāru:');
define('_CONFIRMTXT_TEAM1',            'Tu vēlies izdzēst ');
define('_CONFIRMTXT_TEAM2',            ' no dalībnieku komandas ');
define('_CONFIRMTXT_BLOG',            'Tiks izdzēsts sekojošs blogs: ');
define('_WARNINGTXT_BLOGDEL',        'UZMANĪBU! Tiks izdzēsts gan pats blogs, gan visi tā komentāri. Pārleicinies, vai tiešām to vēlies.<br />Un, lūdzu, nepārtrauc procesu, kad notiks dzēšana!');

define('_CONFIRMTXT_MEMBER',        'Tu vēlies dzēst sekojoša dalībnieka datus: ');
define('_CONFIRMTXT_TEMPLATE',        'Tu vēlies dzēst veidni ');
define('_CONFIRMTXT_SKIN',            'Tu vēlies dzēst tēmu ');
define('_CONFIRMTXT_BAN',            'Tu vēlies dzēst aizliegumu sekojošam IP adrešu apgabalam');
define('_CONFIRMTXT_CATEGORY',        'Tu vēlies dzēst sadaļu ');

// some status messages
define('_DELETED_ITEM',                'Ziņa tika izdzēsta');
define('_DELETED_MEMBER',            'Dalībnieks tika izdzēsta');
define('_DELETED_COMMENT',            'Komentāri tika izdzēsti');
define('_DELETED_BLOG',                'Blogs tika izdzēsts');
define('_DELETED_CATEGORY',            'Sadaļa tika izdzēsta');
define('_ITEM_MOVED',                'Ziņa tika veiksmīgi pārvietota');
define('_ITEM_ADDED',                'Ziņa tika veiksmīgi pievienota');
define('_COMMENT_UPDATED',            'Komentāri tika modificēti');
define('_SKIN_UPDATED',                'Tēmas informācija tika saglabāta');
define('_TEMPLATE_UPDATED',            'Veidnes informācija tika saglabāta');

// errors
define('_ERROR_COMMENT_LONGWORD',    'Lūdzu nelieto komentāros vārdus, kas satur vairāk par 90 simboliem');
define('_ERROR_COMMENT_NOCOMMENT',    'Lūdzu uzraksti arī komentāru');
define('_ERROR_COMMENT_NOUSERNAME',    'Hm. Izskatās, ka neesi dalībnieks vai arī kaut kas nav kārtība ar tavu vārdu.');
define('_ERROR_COMMENT_TOOLONG',    'Pārāk liels komentārs (max. 5000 simboli)');
define('_ERROR_COMMENTS_DISABLED',    'Šeit nevar komentēt.');
define('_ERROR_COMMENTS_NONPUBLIC',    'Hm, nesanāks komentēt, jo neesi iegājis sistēmā');
define('_ERROR_COMMENTS_MEMBERNICK','Ir jau tāds vārds. Izvēlies citu.');
define('_ERROR_SKIN',                'Tēmas kļūda');
define('_ERROR_ITEMCLOSED',            'Tēma slēgta, komentāri slēgti, balsot nevar');
define('_ERROR_NOSUCHITEM',            'Nekā nav');
define('_ERROR_NOSUCHBLOG',            'Nav tāda bloga');
define('_ERROR_NOSUCHSKIN',            'Nav tādas tēmas');
define('_ERROR_NOSUCHMEMBER',        'Nav tāda dalībnieka');
define('_ERROR_NOTONTEAM',            'Izskatās, ka neesi komandā kā blog dalībnieks.');
//define('_ERROR_BADDESTBLOG',        'Destination blog does not exist');
define('_ERROR_BADDESTBLOG',        'Šis blogs neeksistē');
define('_ERROR_NOTONDESTTEAM',        'Nevar pārvietot šo blogu tur, kur tu neesi pierakstīts');
define('_ERROR_NOEMPTYITEMS',        'Neaizpildītas lietas netiks pievienotas!');
define('_ERROR_BADMAILADDRESS',        'Nepareiza epasta adrese');
define('_ERROR_BADNOTIFY',            'Epasta adrese(s) nav pareiza(s)');
define('_ERROR_BADNAME',            'Vārds nepareizs (atļauti burti a-z, cipari 0-9 un bez atstarpēm sākumā/beigās)');
define('_ERROR_NICKNAMEINUSE',        'Kādam citam ir šāds vārds');
define('_ERROR_PASSWORDMISMATCH',    'Parolēm jāsakrīt');
define('_ERROR_PASSWORDTOOSHORT',    'Parolei jābūt ar minimums 6 simboliem');
define('_ERROR_PASSWORDMISSING',    'Parole nedrīkst būt tukša');
define('_ERROR_REALNAMEMISSING',    'Hm, kautkas nav kārtībā ar vārdu');
define('_ERROR_ATLEASTONEADMIN',    'Vienmēr jābūt vismaz vienam super-adminam, kas var administrēt.');
define('_ERROR_ATLEASTONEBLOGADMIN','Darot šādi, iespējams blog sistēma vairs nebūs administrējama. Pārliecinies, lai vienmēr būtu vismaz viens admins.');
define('_ERROR_ALREADYONTEAM',        'Nevar pievienot jau esošus dalībniekus');
define('_ERROR_BADSHORTBLOGNAME',    'Īss tava bloga nosaukums (ar burtiem a-z, cipariem 0-9 un bez atstarpēm sākumā/beigās');
define('_ERROR_DUPSHORTBLOGNAME',    'Ir jau tāds blogs');
define('_ERROR_UPDATEFILE',            'Atjaunošanas fails nepieejams. Vai failam var piekļūt (pamēģini uzlikt chmod 666). Ieteicams lietot pilnu ceļu (piem. /sisteemas/celshs/uz/nucleus/)');
//'Cannot get write access to the update-file. Make sure the file permissions are set ok (try chmodding it to 666). Also note that the location is relative to the admin-area directory, so you might want to use an absolute path (something like /your/path/to/nucleus/)');
define('_ERROR_DELDEFBLOG',            'Šis ir galvenais blogs, to nevar dzēst');
define('_ERROR_DELETEMEMBER',        'Nevar dzēst šo dalībnieku, iespējams tāpēc, ka viņš ir kādu rakstu vai komentāru autors');
define('_ERROR_BADTEMPLATENAME',    'Nepareizs sagataves nosaukums, atļauti burti a-z, cipari 0-9 un bez atstarpēm');
define('_ERROR_DUPTEMPLATENAME',    'Ir jau tāda sagatave');
define('_ERROR_BADSKINNAME',        'Nepareizs tēmas nosaukums (atļauti burti a-z, cipari 0-9 un bez atstarpēm)');
define('_ERROR_DUPSKINNAME',        'Ir jau tēma ar tādu nosaukumu');
define('_ERROR_DEFAULTSKIN',        'Tēmai "default" jābūt un tur neko nevar darīt');
define('_ERROR_SKINDEFDELETE',        'Nevar izdzēst šo tēmu, jo tā ir galvenā sekojošam blogam: ');
define('_ERROR_DISALLOWED',            'Šādas darbības ir aizliegtas');
define('_ERROR_DELETEBAN',            'Kļūda, dzēšot aizliegumu (nav tāda aizlieguma)');
define('_ERROR_ADDBAN',                'Kļūda. Šāds aizliegums var netikt pievienots visos blogos.');
define('_ERROR_BADACTION',            'Netiklas..em.. darbības sodāmas pēc krimināllikuma');
define('_ERROR_MEMBERMAILDISABLED',    'Dalībnieks-dalībniekam ziņu sūtīšana aizliegta');
define('_ERROR_MEMBERCREATEDISABLED','Dalībnieku pievienošana atslēgta');
define('_ERROR_INCORRECTEMAIL',        'Nepareiza epasta adrese');
define('_ERROR_VOTEDBEFORE',        'Par šo jau esi balsojis');
define('_ERROR_BANNED1',            'Diemžēl man tevi jāapbēdina, jo tava IP adrese ir iekļauta aizliegto IP adrešu apgabalā ');
define('_ERROR_BANNED2',            ' . Tu rakstīji: \'');
define('_ERROR_BANNED3',            '\'');
define('_ERROR_LOGINNEEDED',        'Pieslēdzies sistēmai, lai veiktu šādu darbību');
define('_ERROR_CONNECT',            'Pieslēgšanās kļūda');
define('_ERROR_FILE_TOO_BIG',        'Fails ir pārāk liels!');
define('_ERROR_BADFILETYPE',        'Šāda formāta faili šeit ir aizliegti');
define('_ERROR_BADREQUEST',            'Fuj! Slikti darīji.');
define('_ERROR_DISALLOWEDUPLOAD',    'Nevar atrast tevi mūsu komandā. Nu, līdz ar to tev nesanāks uzlikt failus');
define('_ERROR_BADPERMISSIONS',        'Nepareizi uzstādītas failu/direktoriju atļaujas');
define('_ERROR_UPLOADMOVEP',        'Kļūda dzēšot failu');
define('_ERROR_UPLOADCOPY',            'Kļūda kopējot failu');
define('_ERROR_UPLOADDUPLICATE',    'Fails ar šādu nosaukumu jau eksistē. Pirms uzlikšanas to pārsauc.');
define('_ERROR_LOGINDISALLOWED',    'Piedod, tev nav dota atļauja šeit ārdīties kā adminam. Bet vismaz vari padarboties kā dalībnieks. Uzraksti kaut ko labu');
define('_ERROR_DBCONNECT',            'Hm, mySQL serveris nokāries? Piezvani adminam');
define('_ERROR_DBSELECT',            'Hm, problēma ar blogu datu bāzi.');
define('_ERROR_NOSUCHLANGUAGE',        'Hm, problēma ar valodu failu (nav atrasts)');
define('_ERROR_NOSUCHCATEGORY',        'Hm, sadaļa netika atrasta');
define('_ERROR_DELETELASTCATEGORY',    'Jābūt vismaz vienai sadaļai');
define('_ERROR_DELETEDEFCATEGORY',    'Pamatsadaļu nedrīkst dzēst');
define('_ERROR_BADCATEGORYNAME',    'Slikts nosaukums priekš sadaļas');
define('_ERROR_DUPCATEGORYNAME',    'Ir, ir jau tāda sadaļa');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',            'Uzmanību: Šis uzstādījums neizskatās pēc direktorijas!');
define('_WARNING_NOTREADABLE',        'Uzmanību: Šī direktorija nav redzama, ar domu - nevar nolasīt!');
define('_WARNING_NOTWRITABLE',        'Uzmanību: Šajā direktorijā neko nevar saglabāt!');

// media and upload
define('_MEDIA_UPLOADLINK',            'Pievienot jaunu failu');
define('_MEDIA_MODIFIED',            'izmaiņas');
define('_MEDIA_FILENAME',            'nosaukums');
define('_MEDIA_DIMENSIONS',            'izmēri');
define('_MEDIA_INLINE',                'Iekļaut lapā');
define('_MEDIA_POPUP',                'Atsevišķs logs');
define('_UPLOAD_TITLE',                'Izvēlēties failu');
define('_UPLOAD_MSG',                'Izvēlies failu un spied \'Uzlikt\' pogu.');
define('_UPLOAD_BUTTON',            'Uzlikt');

// some status messages
define('_MSG_ACCOUNTCREATED',        'Konts izveidots, parole nosūtīta pa epastu');
define('_MSG_PASSWORDSENT',            'Parole tika nosūtīta uz attiecīgo epasta adresi.');
define('_MSG_LOGINAGAIN',            'Tev jāpieslēdzas vēleiz, jo informācija par tevi tika izmainīta');
define('_MSG_SETTINGSCHANGED',        'Uzstādījumi izmainīti');
define('_MSG_ADMINCHANGED',            'Admins nomainīts');
define('_MSG_NEWBLOG',                'Jauns blogs izveidots');
define('_MSG_ACTIONLOGCLEARED',        'Statistika dzēsta');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',        'Aizliegta rīcība: ');
define('_ACTIONLOG_PWDREMINDERSENT','Jaunā parole nosūtīta dalībniekam ');
define('_ACTIONLOG_TITLE',            'Statistika');
define('_ACTIONLOG_CLEAR_TITLE',    'Dzēst statistiku');
define('_ACTIONLOG_CLEAR_TEXT',        'Dzēst statistiku tūlīt');

// team management
define('_TEAM_TITLE',                'Menedžēt bloga komandu ');
define('_TEAM_CURRENT',                '\'Tekošā\' komanda');
define('_TEAM_ADDNEW',                'Pievienot komandai jaunu dalībnieku');
define('_TEAM_CHOOSEMEMBER',        'Izvēlēties dalībnieku');
define('_TEAM_ADMIN',                'Admina tiesības? ');
define('_TEAM_ADD',                    'Pievienot komandai');
define('_TEAM_ADD_BTN',                'Pievienot komandai');

// blogsettings
define('_EBLOG_TITLE',                'Bloga modificēšana');
define('_EBLOG_TEAM_TITLE',            'Modificēt komandu');
define('_EBLOG_TEAM_TEXT',            'Spied šeit, lai modificētu komandu...');
define('_EBLOG_SETTINGS_TITLE',        'Bloga uzstādījumi');
define('_EBLOG_NAME',                'Bloga nosaukums');
define('_EBLOG_SHORTNAME',            'Īss bloga nosaukums');
define('_EBLOG_SHORTNAME_EXTRA',    '<br />(jāsatur burtus a-z un bez atstarpēm)');
define('_EBLOG_DESC',                'Bloga apraksts');
define('_EBLOG_URL',                'URL');
define('_EBLOG_DEFSKIN',            'Pamattēma');
define('_EBLOG_DEFCAT',                'Pamatsadaļa');
define('_EBLOG_LINEBREAKS',            'Konvertēt rindu pārnesumus jaunā rindā');
define('_EBLOG_DISABLECOMMENTS',    'Komentāri atļauti?<br /><small>(Atslēdzot komentārus, komentēšana nebūs iespējama.)</small>');
define('_EBLOG_ANONYMOUS',            'Atļaut komentēt ciemiņiem?');
define('_EBLOG_NOTIFY',                'Apziņošanas adrese(s) (vairākus atdalīt ar ;)');
define('_EBLOG_NOTIFY_ON',            'Apziņošana ieslēgta');
define('_EBLOG_NOTIFY_COMMENT',        'Apziņot par jauniem komentāriem');
define('_EBLOG_NOTIFY_KARMA',        'Apziņot par balsojumiem');
define('_EBLOG_NOTIFY_ITEM',        'Apziņot par jauniem rakstiem');
define('_EBLOG_PING',                'Nosūtīt ping uz Weblogs.com pēc izmaiņu veikšanas Nucleus sistēmā?');
define('_EBLOG_MAXCOMMENTS',        'Maksimālais atļautais komentāru skaits');
define('_EBLOG_UPDATE',                'Atjaunošanas fails');
define('_EBLOG_OFFSET',                'Laika nobīde');
define('_EBLOG_STIME',                'Pašreizējais servera laiks');
define('_EBLOG_BTIME',                'Pašreizējais bloga laiks');
define('_EBLOG_CHANGE',                'Izmainīt uzstādījumus');
define('_EBLOG_CHANGE_BTN',            'Izmainīt uzstādījumus');
define('_EBLOG_ADMIN',                'Bloga admins');
define('_EBLOG_ADMIN_MSG',            'tev piešķirtas admina tiesības');
define('_EBLOG_CREATE_TITLE',        'Izveidot jaunu blogu');
define('_EBLOG_CREATE_TEXT',        'Aizpildi formu, lai izveidotu jaunu blogu. <br /><br /> <b>Piezīme:</b> Šeit atrodami tikai nepieciešamākie uzstādījumi. Ekstra uzstādījumi atrodami bloga uzstādījumu sadaļā.');
define('_EBLOG_CREATE',                'Izveidot!');
define('_EBLOG_CREATE_BTN',            'Izveidot blogu');
define('_EBLOG_CAT_TITLE',            'Sadaļas');
define('_EBLOG_CAT_NAME',            'Nosaukums');
define('_EBLOG_CAT_DESC',            'Apraksts');
define('_EBLOG_CAT_CREATE',            'Jaunas sadaļas izveidošana');
define('_EBLOG_CAT_UPDATE',            'Atjaunināt sadaļu');
define('_EBLOG_CAT_UPDATE_BTN',        'Atjaunināt sadaļu');

// templates
define('_TEMPLATE_TITLE',            'Modificēt veidnes');
define('_TEMPLATE_AVAILABLE_TITLE',    'Pieejamās veidnes');
define('_TEMPLATE_NEW_TITLE',        'Jauna veidne');
define('_TEMPLATE_NAME',            'Veidnes nosaukums');
define('_TEMPLATE_DESC',            'Apraksts');
define('_TEMPLATE_CREATE',            'Izveidot veidni');
define('_TEMPLATE_CREATE_BTN',        'Izveidot veidni');
define('_TEMPLATE_EDIT_TITLE',        'Modificēt veidni');
define('_TEMPLATE_BACK',            'Atpakaļ uz veidņu aprakstu');
define('_TEMPLATE_EDIT_MSG',        'Vairākus uzstādījumus drīkst atstāt tukšus.');
define('_TEMPLATE_SETTINGS',        'Veidnes uzstādījumi');
define('_TEMPLATE_ITEMS',            'Raksti');
define('_TEMPLATE_ITEMHEADER',        'Raksta aukšdaļa');
define('_TEMPLATE_ITEMBODY',        'Raksta vidusdaļa');
define('_TEMPLATE_ITEMFOOTER',        'Raksta apakšdaļa');
define('_TEMPLATE_MORELINK',        'Norāde uz pilnu rakstu');
define('_TEMPLATE_NEW',                'Norāde uz jaunu rakstu');
define('_TEMPLATE_COMMENTS_ANY',    'Komentāri (ja ir)');
define('_TEMPLATE_CHEADER',            'Komentāru aukšdaļa');
define('_TEMPLATE_CBODY',            'Komentāru vidusdaļa');
define('_TEMPLATE_CFOOTER',            'Komentāru apakšdaļa');
define('_TEMPLATE_CONE',            'Viens komentārs');
define('_TEMPLATE_CMANY',            'Divi (vai vairāk) komentāri');
define('_TEMPLATE_CMORE',            'Lasīt vairāk komentārus');
define('_TEMPLATE_CMEXTRA',            'Member Extra');
define('_TEMPLATE_COMMENTS_NONE',    'Ja nav komentāru');
define('_TEMPLATE_CNONE',            'Komentāru nav');
define('_TEMPLATE_COMMENTS_TOOMUCH','Ja ir pārāk daudz komentāru');
define('_TEMPLATE_CTOOMUCH',        'Pārāk daudz komentāru');
define('_TEMPLATE_ARCHIVELIST',        'Kā izskatās arhīvi');
define('_TEMPLATE_AHEADER',            'Arhīva augšdaļa');
define('_TEMPLATE_AITEM',            'Arhīva vidusdaļa');
define('_TEMPLATE_AFOOTER',            'Arhīva apakšdaļa');
define('_TEMPLATE_DATETIME',        'Datums un laiks');
define('_TEMPLATE_DHEADER',            'Datuma augšdaļa');
define('_TEMPLATE_DFOOTER',            'Datuma apakšdaļa');
define('_TEMPLATE_DFORMAT',            'Datuma formāts');
define('_TEMPLATE_TFORMAT',            'Laika formāts');
define('_TEMPLATE_LOCALE',            'Lokālais uzstādījums');
define('_TEMPLATE_IMAGE',            'Izlecošie attēli');
define('_TEMPLATE_PCODE',            'Kods izlecošajam linkam');
define('_TEMPLATE_ICODE',            'Lapā iekļaujamā attēla kods');
define('_TEMPLATE_MCODE',            'Mēdija objekta kods');
define('_TEMPLATE_SEARCH',            'Meklēšanas sistēma');
define('_TEMPLATE_SHIGHLIGHT',        'Vārdu izcelšana');
define('_TEMPLATE_SNOTFOUND',        'Ja nekas nav atrasts');
define('_TEMPLATE_UPDATE',            'Izmaiņu veikšana');
define('_TEMPLATE_UPDATE_BTN',        'Saglabāt izmaiņas veidnē');
define('_TEMPLATE_RESET_BTN',        'Noklusētās vērtības');
define('_TEMPLATE_CATEGORYLIST',    'Sadaļu saraksti');
define('_TEMPLATE_CATHEADER',        'Sadaļu saraksta augšdaļa');
define('_TEMPLATE_CATITEM',            'Sadaļu saraksta vidusdaļa');
define('_TEMPLATE_CATFOOTER',        'Sadaļu saraksta apakšdaļa');

// skins
define('_SKIN_EDIT_TITLE',            'Modificēt tēmas');
define('_SKIN_AVAILABLE_TITLE',        'Pieejamās tēmas');
define('_SKIN_NEW_TITLE',            'Jauna tēma');
define('_SKIN_NAME',                'Nosaukums');
define('_SKIN_DESC',                'Apraksts');
define('_SKIN_TYPE',                '"Content Type"');
define('_SKIN_CREATE',                'Izveidošana');
define('_SKIN_CREATE_BTN',            'Izveidot tēmu');
define('_SKIN_EDITONE_TITLE',        'Modificēt tēmu');
define('_SKIN_BACK',                'Atpakaļ pie tēmu apraksta');
define('_SKIN_PARTS_TITLE',            'Katras lapas tēma');
define('_SKIN_PARTS_MSG',            'Ne visi uzstādījumi ir obligāti. Nevajadzīgos var atstāt tukšus. Tēmas iespējams mainīt šādām sadaļām:');
define('_SKIN_PART_MAIN',            'Galvenā lapa');
define('_SKIN_PART_ITEM',            'Raksti');
define('_SKIN_PART_ALIST',            'Arhīvu saraksts');
define('_SKIN_PART_ARCHIVE',        'Arhīvs');
define('_SKIN_PART_SEARCH',            'Meklēšana');
define('_SKIN_PART_ERROR',            'Kļūdu paziņojumi');
define('_SKIN_PART_MEMBER',            'Informācija par dalībniekiem');
define('_SKIN_PART_POPUP',            'Izlecošie attēli');
define('_SKIN_GENSETTINGS_TITLE',    'Infomācija par tēmu');
define('_SKIN_CHANGE',                'Izmaiņas');
define('_SKIN_CHANGE_BTN',            'Saglabāt izmaiņas');
define('_SKIN_UPDATE_BTN',            'Saglabāt izmaiņas');
define('_SKIN_RESET_BTN',            'Noklusētie uzstādījumi');
define('_SKIN_EDITPART_TITLE',        'Modificēt tēmu');
define('_SKIN_GOBACK',                'Atpakaļ');
define('_SKIN_ALLOWEDVARS',            'Pieejamie uzstādījumi (sīkāka informācija, uzklikšķinot):');

// global settings
define('_SETTINGS_TITLE',            'Galvenie uzstādījumi');
define('_SETTINGS_SUB_GENERAL',        'Galvenie uzstādījumi');
define('_SETTINGS_DEFBLOG',            'Primārais blogs');
define('_SETTINGS_ADMINMAIL',        'Admina epasta adrese');
define('_SETTINGS_SITENAME',        'Mājas lapas nosaukums');
define('_SETTINGS_SITEURL',            'Lapas URL (ar slīpsvītru beigās)');
define('_SETTINGS_ADMINURL',        'Administrēšanas URL (ar slīpsvītru beigās)');
define('_SETTINGS_DIRS',            'Nucleus pilna atrašanās vieta sistēmā');
define('_SETTINGS_MEDIADIR',        'Mēdiju direktorija');
define('_SETTINGS_SEECONFIGPHP',    '(skat. config.php)');
define('_SETTINGS_MEDIAURL',        'Mēdiju URL (ar slīpsvītru beigās)');
define('_SETTINGS_ALLOWUPLOAD',        'Atļaut likt failus?');
define('_SETTINGS_ALLOWUPLOADTYPES','Atļautie failu formāti');
define('_SETTINGS_CHANGELOGIN',        'Atļaut dalībniekiem mainīt vārdu/paroli');
define('_SETTINGS_COOKIES_TITLE',    'Cookie uzstādījumi');
define('_SETTINGS_COOKIELIFE',        'Sistēmas Cookie ilgums');
define('_SETTINGS_COOKIESESSION',    'tik pat, cik sesija');
define('_SETTINGS_COOKIEMONTH',        'viens mēnesis');
define('_SETTINGS_COOKIEPATH',        'Cookie ceļš (advanced)');
define('_SETTINGS_COOKIEDOMAIN',    'Cookie domēns (advanced)');
define('_SETTINGS_COOKIESECURE',    'Drošie Cookie (advanced)');
define('_SETTINGS_LASTVISIT',        'Saglabāt pēdējā apmeklējuma Cookies');
define('_SETTINGS_ALLOWCREATE',        'Atļaut visiem apmeklētājiem reģistrēties');
define('_SETTINGS_NEWLOGIN',        'Atļaut pieslēgties kā administratoram uzreiz pēc reģistrēšanās');
define('_SETTINGS_NEWLOGIN2',        '(tikai jaunizveidotiem)');
define('_SETTINGS_MEMBERMSGS',        'Atļaut izmantot dalībnieks-dalībniekam servisu');
define('_SETTINGS_LANGUAGE',        'Valoda');
define('_SETTINGS_DISABLESITE',        'Apstādināt sistēmu');
define('_SETTINGS_DBLOGIN',            'mySQL DB informācija');
define('_SETTINGS_UPDATE',            'Uzstādījumu saglabāšana');
define('_SETTINGS_UPDATE_BTN',        'Saglabāt izmaiņas');
define('_SETTINGS_DISABLEJS',        'Atslēgt JavaScript paneli');
define('_SETTINGS_MEDIA',            'Mediju/Failu uzstādījumi');
define('_SETTINGS_MEDIAPREFIX',        'Failu nosaukumu sākumu likt tekošo datumu');
define('_SETTINGS_MEMBERS',            'Dalībnieku uzstādījumi');

// bans
define('_BAN_TITLE',                'Aizliegumi: ');
define('_BAN_NONE',                    'Šim blogam nav IP adrešu aizliegumu');
define('_BAN_NEW_TITLE',            'Pievienot jaunu aizliegumu');
define('_BAN_NEW_TEXT',                'Pievienot aizliegumu(s)');
define('_BAN_REMOVE_TITLE',            'Noņemt aizliegumu(s)');
define('_BAN_IPRANGE',                'IP adrešu apgabals');
define('_BAN_BLOGS',                'Kādiem blogiem?');
define('_BAN_DELETE_TITLE',            'Dzēst aizliegumu');
define('_BAN_ALLBLOGS',                'Visi blogi, kurā esi admins.');
define('_BAN_REMOVED_TITLE',        'Aizliegums noņemts');
define('_BAN_REMOVED_TEXT',            'Aizliegums noņemts no sekojošiem blogiem:');
define('_BAN_ADD_TITLE',            'Pievienot aizliegumu');
define('_BAN_IPRANGE_TEXT',            'Izvēlies bloķējamo IP adrešu apgabalu. Jo mazāk ciparu IP adresē, jo lielāks apgabals tiks bloķēts.');
define('_BAN_BLOGS_TEXT',            'Var bloķēt pieeju vienam noteiktam blogam vai arī visiem blogiem, kurā esi administrators.');
define('_BAN_REASON_TITLE',            'Iemesls');
define('_BAN_REASON_TEXT',            'Pievieno iemeslu, kāpēc dalībniekam tiek bloķēta pieeja. Maksimums 256 simboli.');
define('_BAN_ADD_BTN',                'Pievienot aizliegumu');

// LOGIN screen
define('_LOGIN_MESSAGE',            'Ziņojums');
define('_LOGIN_NAME',                'Vārds/nosaukums');
define('_LOGIN_PASSWORD',            'Parole');
define('_LOGIN_SHARED',                _LOGINFORM_SHARED);
define('_LOGIN_FORGOT',                'Aizmirsās parole?');

// membermanagement
define('_MEMBERS_TITLE',            'Dalībnieku menedžments');
define('_MEMBERS_CURRENT',            'Reģistrētie dalībnieki');
define('_MEMBERS_NEW',                'Jauns dalībnieks');
define('_MEMBERS_DISPLAY',            'Atspoguļojamais vārds');
define('_MEMBERS_DISPLAY_INFO',        '(segvārds, ar kuru pieslēdzas sistēmai)');
define('_MEMBERS_REALNAME',            'Pilnais vārds');
define('_MEMBERS_PWD',                'Parole');
define('_MEMBERS_REPPWD',            'Atkārtot paroli');
define('_MEMBERS_EMAIL',            'Epasta adrese');
define('_MEMBERS_EMAIL_EDIT',        '(Mainot epasta adresi, jaunā parole<br /> automātiski nosūtīsies uz jauno adresi)');
define('_MEMBERS_URL',                'Mājas lapa (URL)');
define('_MEMBERS_SUPERADMIN',        'Admina tiesības');
define('_MEMBERS_CANLOGIN',            'Var pieslēgties adminu sadaļai');
define('_MEMBERS_NOTES',            'Piezīmes');
define('_MEMBERS_NEW_BTN',            'Pievienot');
define('_MEMBERS_EDIT',                'Modificēt dalībnieka informāciju');
define('_MEMBERS_EDIT_BTN',            'Mainīt uzstādījumus');
define('_MEMBERS_BACKTOOVERVIEW',    'Atpakaļ uz Dalībnieku informāciju');
define('_MEMBERS_DEFLANG',            'Valoda');
define('_MEMBERS_USESITELANG',        '- sistēmas pamatvaloda -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',        'apmeklēt saitu');
define('_BLOGLIST_ADD',                'Pievienot');
define('_BLOGLIST_TT_ADD',            'Pievienot jaunu rakstu šim blogam');
define('_BLOGLIST_EDIT',            'Modificēt/dzēst');
define('_BLOGLIST_TT_EDIT',            '');
define('_BLOGLIST_BMLET',            'Noderīgas saites');
define('_BLOGLIST_TT_BMLET',        '');
define('_BLOGLIST_SETTINGS',        'Uzstādījumi');
define('_BLOGLIST_TT_SETTINGS',        'Modificēt uzstādījumus vai informāciju par komandu');
define('_BLOGLIST_BANS',            'Aizliegumi');
define('_BLOGLIST_TT_BANS',            'Skatīt/pievienot/dzēst bloķētās IP');
define('_BLOGLIST_DELETE',            'Dzēst visu');
define('_BLOGLIST_TT_DELETE',        'Dzēst šo blogu');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',            'Tavi blogi');
define('_OVERVIEW_YRDRAFTS',        'Tavas sagataves');
define('_OVERVIEW_YRSETTINGS',        'Tavi uzstādījumi');
define('_OVERVIEW_GSETTINGS',        'Galvenie uzstādījumi');
define('_OVERVIEW_NOBLOGS',            'Tu neesi nevienā blogu komandā');
define('_OVERVIEW_NODRAFTS',        'Sagatavju nav');
define('_OVERVIEW_EDITSETTINGS',    'Modificēt savus uzstādījumus...');
define('_OVERVIEW_BROWSEITEMS',        'Skatīties savus rakstus...');
define('_OVERVIEW_BROWSECOMM',        'Skatīties savus komentārus...');
define('_OVERVIEW_VIEWLOG',            'Skatīties statistiku...');
define('_OVERVIEW_MEMBERS',            'Administrēt dalībniekus...');
define('_OVERVIEW_NEWLOG',            'Izveidot jaunu blogu...');
define('_OVERVIEW_SETTINGS',        'Modificēt uzstādījumus...');
define('_OVERVIEW_TEMPLATES',        'Modificēt veidnes...');
define('_OVERVIEW_SKINS',            'Modificēt tēmas...');
define('_OVERVIEW_BACKUP',            'Rezerves kopija/Atjaunošana...');

// ITEMLIST
define('_ITEMLIST_BLOG',            'Kas atrodams blogā, ar nosaukumu');
define('_ITEMLIST_YOUR',            'Tavi raksti');

// Comments
define('_COMMENTS',                    'Komentāri');
define('_NOCOMMENTS',                'Nav komentāru');
define('_COMMENTS_YOUR',            'Tavi komentāri');
define('_NOCOMMENTS_YOUR',            'Neesi rakstījis komentārus');

// LISTS (general)
define('_LISTS_NOMORE',                'Vairāk rezultātu nav vai rezultātu nav vispār');
define('_LISTS_PREV',                'Iepriekšējie');
define('_LISTS_NEXT',                'Nākamie');
define('_LISTS_SEARCH',                'Meklēt');
define('_LISTS_CHANGE',                'Modificēt');
define('_LISTS_PERPAGE',            'rezultāti/lapā');
define('_LISTS_ACTIONS',            'Darbības');
define('_LISTS_DELETE',                'Dzēst');
define('_LISTS_EDIT',                'Modificēt');
define('_LISTS_MOVE',                'Pārvietot');
define('_LISTS_CLONE',                'Klonēt');
define('_LISTS_TITLE',                'Virsraksts');
define('_LISTS_BLOG',                'Blogs');
define('_LISTS_NAME',                'Nosaukums');
define('_LISTS_DESC',                'Apraksts');
define('_LISTS_TIME',                'Laiks');
define('_LISTS_COMMENTS',            'Komentāri');
define('_LISTS_TYPE',                'Formāts');


// member list
define('_LIST_MEMBER_NAME',            'Publicējamais vārds');
define('_LIST_MEMBER_RNAME',        'Īstais vārds');
define('_LIST_MEMBER_ADMIN',        'Super-admins? ');
define('_LIST_MEMBER_LOGIN',        'Var pieslēgties? ');
define('_LIST_MEMBER_URL',            'Mājas lapa');

// banlist
define('_LIST_BAN_IPRANGE',            'IP apgabals');
define('_LIST_BAN_REASON',            'Iemesls');

// actionlist
define('_LIST_ACTION_MSG',            'Ziņojums');

// commentlist
define('_LIST_COMMENT_BANIP',        'Bloķēt IP');
define('_LIST_COMMENT_WHO',            'Autors');
define('_LIST_COMMENT',                'Komentāri');
define('_LIST_COMMENT_HOST',        'Hosts');

// itemlist
define('_LIST_ITEM_INFO',            'Info');
define('_LIST_ITEM_CONTENT',        'Virsraksts un teksts');


// teamlist
define('_LIST_TEAM_ADMIN',            'Admins ');
define('_LIST_TEAM_CHADMIN',        'Mainam adminu');

// edit comments
define('_EDITC_TITLE',                'Modificēt komentārus');
define('_EDITC_WHO',                'Autors');
define('_EDITC_HOST',                'No kurienes?');
define('_EDITC_WHEN',                'Kad?');
define('_EDITC_TEXT',                'Teksts');
define('_EDITC_EDIT',                'Modificēt komentāru');
define('_EDITC_MEMBER',                'dalībnieks');
define('_EDITC_NONMEMBER',            'ciemiņš');

// move item
define('_MOVE_TITLE',                'Uz kuru blogu?');
define('_MOVE_BTN',                    'Pārvietot...');
