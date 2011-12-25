<?php
// Catalan Nucleus Language File
// 
// Author: Roger Pau Monn� (royger@gmail.com) 
// Nucleus version: v1.0-v3.2
//
// Please note: if you want to translate this file to your own language, be aware
// that in a next Nucleus version, new variables might be added and some other ones
// might be deleted. Therefor, it's important to list the Nucleus version for which 
// the file was written in your document.
//
// Fully translated language file can be sent to us and will be made
// available for download (with proper credit to the author, of course)

// Data language

@setlocale(LC_TIME, 'ca_ES@euro'); 

// START changed/added after 315 START

define('_LIST_PLUG_SUBS_NEEDUPDATE','Si us plau, utilitza el bot� \'Actualitzar la llista de subscripcions\' per actualitzar la llista');
define('_LIST_PLUGS_DEP',			'Requeriments del Plugin(s):');

// END changed/added after 3.15

// START changed/added after 3.1 START

// comments list per weblog
define('_COMMENTS_BLOG',			'Tots els comentaris pel bloc');
define('_NOCOMMENTS_BLOG',			'No s\ha fet cap comentari sobre algun article d\'aquest bloc');
define('_BLOGLIST_COMMENTS',		'Comentaris');
define('_BLOGLIST_TT_COMMENTS',		'Llista de tots els comentaris fets sobre articles d\'aquest bloc');


// for use in archivetype-skinvar
define('_ARCHIVETYPE_DAY',			'dia');
define('_ARCHIVETYPE_MONTH',		'mes');

// tickets (prevents malicious users to trick an admin to perform actions he doesn't want)
define('_ERROR_BADTICKET',			'Tiquet inv�lid o caducat.');

// plugin dependency
define('_ERROR_INSREQPLUGIN',		'La instal�laci� dels plugin ha fallat, necessita ');
define('_ERROR_DELREQPLUGIN',		'No es pot eliminar el plugin, es necessitat per ');

// cookie prefix
define('_SETTINGS_COOKIEPREFIX',	'Prefix de la "galeta"');

// account activation
define('_ERROR_NOLOGON_NOACTIVATE',	'No es pot enviar l\'enlla� d\'activaci�. No t\'est� perm�s registrar-te.');
define('_ERROR_ACTIVATE',			'La clau d\'activaci� no existeix, �s invallida, o ha caducat.');
define('_ACTIONLOG_ACTIVATIONLINK', 'Clau d\'activaci� enviada');
define('_MSG_ACTIVATION_SENT',		'S\'ha enviat una clau d\'activaci� al correu.');

// activation link emails
define('_ACTIVATE_REGISTER_MAIL',	"Hola <%memberName%>,\n\nHas d'activar el teu compte a <%siteName%> (<%siteUrl%>).\nPots fer-ho visitant el seguent enlla�: \n\n\t<%activationUrl%>\n\nTens dos dies per fer-ho. Passat aquest temps la clau d'activaci� caduca.");
define('_ACTIVATE_REGISTER_MAILTITLE',	"Activa el teu compte: '<%memberName%>'");
define('_ACTIVATE_REGISTER_TITLE',	'Benvingut <%memberName%>');
define('_ACTIVATE_REGISTER_TEXT',	'Casi ja est�. Si us plau, tria una contrasenya pel teu compte.');
define('_ACTIVATE_FORGOT_MAIL',		"Hola <%memberName%>,\n\nUtilitzant l'enlla� de m�s avall pots canviar la contrasenya del teu compte a <%siteName%> (<%siteUrl%>) i posar-ne una de nova.\n\n\t<%activationUrl%>\n\nTens dos dies per fer-ho. Despr�s d'aquest temps l'enlla� caduca.");
define('_ACTIVATE_FORGOT_MAILTITLE',"Re-activa el teu compte: '<%memberName%>'");
define('_ACTIVATE_FORGOT_TITLE',	'Benvingut <%memberName%>');
define('_ACTIVATE_FORGOT_TEXT',		'Pots triar una nova contrasenya pel teu compte m�s avall:');
define('_ACTIVATE_CHANGE_MAIL',		"Hola <%memberName%>,\n\nCom que la teva adre�a ha canviat �s necessari que re-activis el teu compte a <%siteName%> (<%siteUrl%>).\nPots fer-ho visitant el seguent enlla�: \n\n\t<%activationUrl%>\n\nTens dos dies per fer-ho. Despr�s d'aquest temps l'enlla� caduca.");
define('_ACTIVATE_CHANGE_MAILTITLE',"Re-activa el teu compte: '<%memberName%>'");
define('_ACTIVATE_CHANGE_TITLE',	'Benvingut <%memberName%>');
define('_ACTIVATE_CHANGE_TEXT',		'La teva adre�a ha estat verificada. Gr�cies!');
define('_ACTIVATE_SUCCESS_TITLE',	'Activaci� finalitzada');
define('_ACTIVATE_SUCCESS_TEXT',	'El teu compte ha estat activat correctament.');
define('_MEMBERS_SETPWD',			'Contrasenya desitjada');
define('_MEMBERS_SETPWD_BTN',		'Contrasenya desitjada');
define('_QMENU_ACTIVATE',			'Activaci� del compte');
define('_QMENU_ACTIVATE_TEXT',		'<p>Despr�s d\'activar el teu compte, ja pots <a href="index.php?action=showlogin">registrar-te</a>.</p>');

define('_PLUGS_BTN_UPDATE',			'Actualitzar la llista de subscripcions');

// global settings 
define('_SETTINGS_JSTOOLBAR',		'Barra d\'eines JavaScript');
define('_SETTINGS_JSTOOLBAR_FULL',	'Barra d\'eines completa (IE)');
define('_SETTINGS_JSTOOLBAR_SIMPLE','Barra d\'eines senzilla (Non-IE)');
define('_SETTINGS_JSTOOLBAR_NONE',	'Desaciva la barra d\'eines');
define('_SETTINGS_URLMODE_HELP',	'(Informaci�: <a href="documentation/tips.html#searchengines-fancyurls">Com activar "fancy URLs"</a>)');

// extra plugin settings part when editing categories/members/blogs/...
define('_PLUGINS_EXTRA',			'Opcions extra del plugin');

// itemlist info column keys
define('_LIST_ITEM_BLOG',			'bloc:');
define('_LIST_ITEM_CAT',			'cat:');
define('_LIST_ITEM_AUTHOR',			'autor:');
define('_LIST_ITEM_DATE',			'data:');
define('_LIST_ITEM_TIME',			'temps:');

// indication of registered members in comments list
define('_LIST_COMMENTS_MEMBER', 	'(membre)');

// batch operations
define('_BATCH_WITH_SEL',			'Amb els seleccionats:');
define('_BATCH_EXEC',				'Executa');

// quickmenu
define('_QMENU_HOME',				'Casa');
define('_QMENU_ADD',				'Afegir article');
define('_QMENU_ADD_SELECT',			'-- seleccionar --');
define('_QMENU_USER_SETTINGS',		'Opcions');
define('_QMENU_USER_ITEMS',			'Articles');
define('_QMENU_USER_COMMENTS',		'Comentaris');
define('_QMENU_MANAGE',				'Administraci�');
define('_QMENU_MANAGE_LOG',			'Registre d\'accions');
define('_QMENU_MANAGE_SETTINGS',	'Opcions globals');
define('_QMENU_MANAGE_MEMBERS',		'Membres');
define('_QMENU_MANAGE_NEWBLOG',		'Weblog nou');
define('_QMENU_MANAGE_BACKUPS',		'C�pia de seguretat');
define('_QMENU_MANAGE_PLUGINS',		'Plugins');
define('_QMENU_LAYOUT',				'Disseny');
define('_QMENU_LAYOUT_SKINS',		'Disposic�');
define('_QMENU_LAYOUT_TEMPL',		'Plantilles');
define('_QMENU_LAYOUT_IEXPORT',		'Importar/Exportar');
define('_QMENU_PLUGINS',			'Plugins');

// quickmenu on logon screen
define('_QMENU_INTRO',				'Introducci�');
define('_QMENU_INTRO_TEXT',			'<p>Aquesta �s la plantalla de registre de Nucleus CMS, el gestor de contigut utilitzar per mantenir aquesta p�gina.</p><p>Si tens un compte pots registrar-te i afegir nous articles.</p>');

// helppages for plugins
define('_ERROR_PLUGNOHELPFILE',		'El fitxer d\'ajuda \'aquest plugin no existeix');
define('_PLUGS_HELP_TITLE',			'P�gina d\'ajuda del plugin');
define('_LIST_PLUGS_HELP', 			'ajuda');


// END changed/started after 3.1

// START changed/added after v2.5beta START

// general settings (security)
define('_SETTINGS_EXTAUTH',			'Activa l\'autentificaci� externa');
define('_WARNING_EXTAUTH',			'Av�s: activa unicament si �s necessari.');

// member profile
define('_MEMBERS_BYPASS',			'Utilitza autentificaci� externa');

// 'always include in search' blog setting (yes/no) [in v2.5beta, the 'always' part wasn't clear]
define('_EBLOG_SEARCH',				'Inclou <em>sempre</em> a la b�squeda');

// END changed/added after v2.5beta
// START introduced after v2.0 START

// media library
define('_MEDIA_VIEW',				'veure');
define('_MEDIA_VIEW_TT',			'veure el fitxer (l\'obre en una nova finestra)');
define('_MEDIA_FILTER_APPLY',		'Aplicar el filtre');
define('_MEDIA_FILTER_LABEL',		'Filtre: ');
define('_MEDIA_UPLOAD_TO',			'Pujar a...');
define('_MEDIA_UPLOAD_NEW',			'Pujar un nou fitxer...');
define('_MEDIA_COLLECTION_SELECT',	'Seleccionar');
define('_MEDIA_COLLECTION_TT',		'Canvia a aquesta categoria');
define('_MEDIA_COLLECTION_LABEL',	'Col�lecci� actual: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'Alinea a l\'esquerra');
define('_ADD_ALIGNRIGHT_TT',		'Alinea a la dreta');
define('_ADD_ALIGNCENTER_TT',		'Alinea al centre');

// searchable blog setting (yes/no)
define('_EBLOG_SEARCH',				'Inclou a la cerca');

// generic upload failure
define('_ERROR_UPLOADFAILED',		'Enviament fallat');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'Permet publicar noticies amb data passada');
define('_ADD_CHANGEDATE',			'Actualitzar la data');
define('_BMLET_CHANGEDATE',			'Actualitzar la data');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'Importar/exportar disposici�...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Normal');
define('_PARSER_INCMODE_SKINDIR',	'Utilitzar el directori de les disposicions');
define('_SKIN_INCLUDE_MODE',		'mode d\'inclusi�');
define('_SKIN_INCLUDE_PREFIX',		'Incloure el prefix');

// global settings
define('_SETTINGS_BASESKIN',		'Disposici� base');
define('_SETTINGS_SKINSURL',		'URL de les disposicions');
define('_SETTINGS_ACTIONSURL',		'URL completa d\'action.php');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'No �s pot moure la cetegoria posada per defecte');
define('_ERROR_MOVETOSELF',			'No �s pot moure la categoria (el bloc d\'origen �s el mateix que el de destinaci�)');
define('_MOVECAT_TITLE',			'Selecciona el bloc al qual vols moure la categoria');
define('_MOVECAT_BTN',				'Moure una categoria');

// URLMode setting
define('_SETTINGS_URLMODE',			'Mode URL');
define('_SETTINGS_URLMODE_NORMAL',	'Normal');
define('_SETTINGS_URLMODE_PATHINFO','Extrany');

// Batch operations
define('_BATCH_NOSELECTION',		'No hi ha res seleccionat per realitzar accions');
define('_BATCH_ITEMS',				'Serie d\'operacions en articles');
define('_BATCH_CATEGORIES',			'Serie d\'operacions en categories');
define('_BATCH_MEMBERS',			'Serie d\'operacions en membres');
define('_BATCH_TEAM',				'Serie d\'operacions en membres d\'equip');
define('_BATCH_COMMENTS',			'Serie d\'operacions en cometaris');
define('_BATCH_UNKNOWN',			'Operacions en serie desconegudes: ');
define('_BATCH_EXECUTING',			'Executant');
define('_BATCH_ONCATEGORY',			'en la categoria');
define('_BATCH_ONITEM',				'en l\'article');
define('_BATCH_ONCOMMENT',			'en el comentari');
define('_BATCH_ONMEMBER',			'en el membre');
define('_BATCH_ONTEAM',				'en el membre d\'equip');
define('_BATCH_SUCCESS',			'Exit');
define('_BATCH_DONE',				'Fet!');
define('_BATCH_DELETE_CONFIRM',		'Confirma l\'eliminaci� m�ltiple');
define('_BATCH_DELETE_CONFIRM_BTN',	'Confirma l\'eliminaci� m�ltiple');
define('_BATCH_SELECTALL',			'selecciona\'ls tots');
define('_BATCH_DESELECTALL',		'deselecciona\'ls tots');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'Borrar');
define('_BATCH_ITEM_MOVE',			'Moure');
define('_BATCH_MEMBER_DELETE',		'Borrar');
define('_BATCH_MEMBER_SET_ADM',		'Atorgar privilegis d\'administrador');
define('_BATCH_MEMBER_UNSET_ADM',	'Treure privilegis d\'administrador');
define('_BATCH_TEAM_DELETE',		'Borrar de l\'equip');
define('_BATCH_TEAM_SET_ADM',		'Atorgar privilegis d\'administrador');
define('_BATCH_TEAM_UNSET_ADM',		'Treure privilegis d\'administrador');
define('_BATCH_CAT_DELETE',			'Borrar');
define('_BATCH_CAT_MOVE',			'Moure a un altre bloc');
define('_BATCH_COMMENT_DELETE',		'Borrar');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'Afegir un nou article...');
define('_ADD_PLUGIN_EXTRAS',		'Opcions extra del plugin');

// errors
define('_ERROR_CATCREATEFAIL',		'No s\'ha pogut crear una nova categoria');
define('_ERROR_NUCLEUSVERSIONREQ',	'Aquest plugin necessita una versi� de Nucleus superior: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Tornar a les opcions del bloc');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Importar');
define('_SKINIE_TITLE_EXPORT',		'Exportar');
define('_SKINIE_BTN_IMPORT',		'Importar');
define('_SKINIE_BTN_EXPORT',		'Exporta les disposicions/plantilles seleccionats');
define('_SKINIE_LOCAL',				'Importar des del fitxer local:');
define('_SKINIE_NOCANDIDATES',		'No hi ha candidats per importar al directori de disposicions');
define('_SKINIE_FROMURL',			'Importar des d\'una URL:');
define('_SKINIE_EXPORT_INTRO',		'Selecciona les disposicions i plantilles que vulguis exportar aqu� baix');
define('_SKINIE_EXPORT_SKINS',		'Disposicions');
define('_SKINIE_EXPORT_TEMPLATES',	'Plantilles');
define('_SKINIE_EXPORT_EXTRA',		'Informaci� extra');
define('_SKINIE_CONFIRM_OVERWRITE',	'Sobreescriure les disposicions que ja existeixen (veure nameclashes)');
define('_SKINIE_CONFIRM_IMPORT',	'S�, vull importar aix�');
define('_SKINIE_CONFIRM_TITLE',		'A punt d\'importar disposicions i plantilles');
define('_SKINIE_INFO_SKINS',		'Disposicions en el fitxer:');
define('_SKINIE_INFO_TEMPLATES',	'Plantilles en el fitxer:');
define('_SKINIE_INFO_GENERAL',		'Informaci�:');
define('_SKINIE_INFO_SKINCLASH',	'Nom de disposici� incompatible amb:');
define('_SKINIE_INFO_TEMPLCLASH',	'Nom de plantilla incompatible amb::');
define('_SKINIE_INFO_IMPORTEDSKINS','Disposicions importats:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Plantilles importades:');
define('_SKINIE_DONE',				'Finalitzat');

define('_AND',						'i');
define('_OR',						'o');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'espai bu�t (clica per editar)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'Mode d\'inclusi�:');
define('_LIST_SKINS_INCPREFIX',		'Prefix d\'inclusi�:');
define('_LIST_SKINS_DEFINED',		'Parts definides:');

// backup
define('_BACKUPS_TITLE',			'Backup / Restaura');
define('_BACKUP_TITLE',				'Backup');
define('_BACKUP_INTRO',				'Clica al but� de m�s aball per fer una c�pia de seguretat de la teva base de dades nucleus. Ara podr�s baixar-te un fitxer. Guarda\'l en un lloc segur.');
define('_BACKUP_ZIP_YES',			'Intentar utilitzar compressi�');
define('_BACKUP_ZIP_NO',			'No utilitzar compressi�');
define('_BACKUP_BTN',				'Crear el backup');
define('_BACKUP_NOTE',				'<b>Nota:</b> Nom�s els continguts de la base de dades �s guardada als backups. Els fitxer multimedia i la configuraci� estan a config.php i <b>NO</b> seran inclosos en aquests backup.');
define('_RESTORE_TITLE',			'Restaurar');
define('_RESTORE_NOTE',				'<b>Perill:</b> La restauraci� des d\'un backup <b>BORRAR�</b> totes les dades que hi hagin a la base de dades de Nucleus actualment! Nom�s fes aix� quan n\'estiguis completament segur!	<br />	<b>Nota:</b> Estigues segur que la versi� de Nucleus amb la qual s\'ha realitzar aquest backup �s la mateixa que est�s utilitzant actualment! Sin� no anir�');
define('_RESTORE_INTRO',			'Selecciona el ftixer de backup a sota (ser� enviat al servidor) i apreta el bot� "Restaurar" per comen�ar.');
define('_RESTORE_IMSURE',			'S�, estic segur que vull fer aix�!');
define('_RESTORE_BTN',				'Restaurar des del fitxer');
define('_RESTORE_WARNING',			'(Estigues segur que estas restaurant el backup correcte)');
define('_ERROR_BACKUP_NOTSURE',		'Et far� falta seleccionar l\'"\'I\'m sure\'"');
define('_RESTORE_COMPLETE',			'Restauraci� completa');

// new item notification
define('_NOTIFY_NI_MSG',			'Un nou article ha estat enviat:');
define('_NOTIFY_NI_TITLE',			'Nou article!');
define('_NOTIFY_KV_MSG',			'Vots Karma a l\'article:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'Commentaris en l\'article:');
define('_NOTIFY_NC_TITLE',			'Commentari Nucleus:');
define('_NOTIFY_USERID',			'ID d\'usuari:');
define('_NOTIFY_USER',				'Usuari:');
define('_NOTIFY_COMMENT',			'Commentari:');
define('_NOTIFY_VOTE',				'Vot:');
define('_NOTIFY_HOST',				'Host:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'Membre:');
define('_NOTIFY_TITLE',				'Titol:');
define('_NOTIFY_CONTENTS',			'Contingut:');

// member mail message
define('_MMAIL_MSG',				'Un missatge enviar a tu per');
define('_MMAIL_FROMANON',			'un visitant an�nim');
define('_MMAIL_FROMNUC',			'Enviat a un bloc Nucles a');
define('_MMAIL_TITLE',				'Missatge procedent de');
define('_MMAIL_MAIL',				'Missatge:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'Afegir article');
define('_BMLET_EDIT',				'Editar article');
define('_BMLET_DELETE',				'Borrar article');
define('_BMLET_BODY',				'Cos');
define('_BMLET_MORE',				'Ampliat');
define('_BMLET_OPTIONS',			'Opcions');
define('_BMLET_PREVIEW',			'Vista previa');

// used in bookmarklet
define('_ITEM_UPDATED',				'Article actualitzat');
define('_ITEM_DELETED',				'Article esborrat');

// plugins
define('_CONFIRMTXT_PLUGIN',		'Est�s segur que vols esborrar el plugin anomenat');
define('_ERROR_NOSUCHPLUGIN',		'No existeix aquest plugin');
define('_ERROR_DUPPLUGIN',			'Ho sentim molt, aquest plugin ja est� instal�lat');
define('_ERROR_PLUGFILEERROR',		'No existeix cap plugin aix�, o els permisos estan posats incorrectament');
define('_PLUGS_NOCANDIDATES',		'No s\'ha trobat cap candidat de plugin');

define('_PLUGS_TITLE_MANAGE',		'Adminstrar els plugins');
define('_PLUGS_TITLE_INSTALLED',	'Actualment instal�lats');
define('_PLUGS_TITLE_UPDATE',		'Actualitzar la llista');
define('_PLUGS_TEXT_UPDATE',		'Nucleus mant� un cache amb els events als quals esta subcrit cada plugin. Quan actualitzes un plugin reempla�ant els seu fitxer, has de realitzar aquesta actualitzaci� per estar segur que la llista d\'events �s correta');
define('_PLUGS_TITLE_NEW',			'Instal�la un nou plugin');
define('_PLUGS_ADD_TEXT',			'Aqu� sota i ha la llista de plugins the Nucleus, pot ser que no estiguin instal�lats. Estis segur que <strong>est�s completament segur</strong> que �s un plugin abans d\'afegir-lo.');
define('_PLUGS_BTN_INSTALL',		'Instal�lar el plugin');
define('_BACKTOOVERVIEW',			'Torna al �ndex');

// editlink
define('_TEMPLATE_EDITLINK',		'Edita l\'enlla� de l\'article');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'Afegeix una caixa a l\'esquerra');
define('_ADD_RIGHT_TT',				'Afegeix una caixa a la dreta');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'Nova categoria...');

// new settings
define('_SETTINGS_PLUGINURL',		'URL del plugin');
define('_SETTINGS_MAXUPLOADSIZE',	'Max. tamany de fitxer pujat (bytes)');
define('_SETTINGS_NONMEMBERMSGS',	'Permet al no-membres enviar missatges');
define('_SETTINGS_PROTECTMEMNAMES',	'Protegeix els noms dels membres');

// overview screen
define('_OVERVIEW_PLUGINS',			'Administrar els plugins...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'Registre d\'un nou membre:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'La teva adre�a e-mail:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'No tens drets d\'administraci� en cap dels blogs que tenen el membre de dest� a l\'equip. Per conseg�ent, no t\'�s perm�s pujar fitxers a aquest directori multim�dia');

// plugin list
define('_LISTS_INFO',				'Informaci�');
define('_LIST_PLUGS_AUTHOR',		'Per:');
define('_LIST_PLUGS_VER',			'Versi�:');
define('_LIST_PLUGS_SITE',			'Visitar la p�gina');
define('_LIST_PLUGS_DESC',			'Descripci�:');
define('_LIST_PLUGS_SUBS',			'Subscrit als seg�ents events:');
define('_LIST_PLUGS_UP',			'more amunt');
define('_LIST_PLUGS_DOWN',			'moure avall');
define('_LIST_PLUGS_UNINSTALL',		'esborrar');
define('_LIST_PLUGS_ADMIN',			'admin');
define('_LIST_PLUGS_OPTIONS',		'editar&nbsp;opcions');

// plugin option list
define('_LISTS_VALUE',				'Valor');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'aquest plugin no t� cap opci� posada');
define('_PLUGS_BACK',				'Tornar a la llista de plugins');
define('_PLUGS_SAVE',				'Guardar les opcions');
define('_PLUGS_OPTIONS_UPDATED',	'Les opcions del plugin han estat actualitzades');

define('_OVERVIEW_MANAGEMENT',		'Administraci�');
define('_OVERVIEW_MANAGE',			'Administraci� de Nucleus...');
define('_MANAGE_GENERAL',			'Administraci� general');
define('_MANAGE_SKINS',				'Disposisions i Plantilles');
define('_MANAGE_EXTRA',				'Opcions extra');

define('_BACKTOMANAGE',				'Tornar a l\'administraci� de Nucleus');


// END introduced after v1.1 END




// charset to use 
define('_CHARSET',					'iso-8859-1');

// global stuff
define('_LOGOUT',					'Sortir');
define('_LOGIN',					'Registrar-se');
define('_YES',						'S�');
define('_NO',						'No');
define('_SUBMIT',					'Enviar');
define('_ERROR',					'Error');
define('_ERRORMSG',					'Hi ha hagut un error!');
define('_BACK',						'Tira enrerre');
define('_NOTLOGGEDIN',				'No est�s registrat');
define('_LOGGEDINAS',				'Restistrat com a');
define('_ADMINHOME',				'Inici Administraci�');
define('_NAME',						'Nom');
define('_BACKHOME',					'Torna a l\'inici d\'adminstraci�');
define('_BADACTION',				'S\'ha intentat executar una acci� que no existeix');
define('_MESSAGE',					'Missatge');
define('_HELP_TT',					'Ajuda!');
define('_YOURSITE',					'La teva p�gina');


define('_POPUP_CLOSE',				'Tanca la finestra');

define('_LOGIN_PLEASE',				'Si us plau, reg�strat primer');

// commentform
define('_COMMENTFORM_YOUARE',		'Tu ets');
define('_COMMENTFORM_SUBMIT',		'Afegir comentari');
define('_COMMENTFORM_COMMENT',		'El teu comentari');
define('_COMMENTFORM_NAME',			'Nom');
define('_COMMENTFORM_MAIL',			'E-correu/web');
define('_COMMENTFORM_REMEMBER',		'Recorda\'t de mi');

// loginform
define('_LOGINFORM_NAME',			'Nom d\'usuari');
define('_LOGINFORM_PWD',			'Constrasenya');
define('_LOGINFORM_YOUARE',			'Resgistrat com a');
define('_LOGINFORM_SHARED',			'Ordinador compartit');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'Envia un missatge');

// search form
define('_SEARCHFORM_SUBMIT',		'Busca');

// add item form
define('_ADD_ADDTO',				'Afegir un nou article a');
define('_ADD_CREATENEW',			'Crear un nou article');
define('_ADD_BODY',					'Cos');
define('_ADD_TITLE',				'Titol');
define('_ADD_MORE',					'Ext�s (opcional)');
define('_ADD_CATEGORY',				'Categoria');
define('_ADD_PREVIEW',				'Vista preliminar');
define('_ADD_DISABLE_COMMENTS',		'Impedir comentaris?');
define('_ADD_DRAFTNFUTURE',			'Esborrany &amp; articles futurs');
define('_ADD_ADDITEM',				'Afegir un article');
define('_ADD_ADDNOW',				'Afegir ara');
define('_ADD_ADDLATER',				'Afegir despr�s');
define('_ADD_PLACE_ON',				'Posar a');
define('_ADD_ADDDRAFT',				'Afegir a esborranys');
define('_ADD_NOPASTDATES',			'(Les dates passades no s�n valides, el temps actual s\'utilitzar� si �s dona el cas)');
define('_ADD_BOLD_TT',				'Negreta');
define('_ADD_ITALIC_TT',			'Cursiva');
define('_ADD_HREF_TT',				'Fer un enlla�');
define('_ADD_MEDIA_TT',				'Afegir un fitxer multimedia');
define('_ADD_PREVIEW_TT',			'Mostrar/Ocultar la vista preliminar');
define('_ADD_CUT_TT',				'Retalla');
define('_ADD_COPY_TT',				'Copia');
define('_ADD_PASTE_TT',				'Enganxa');


// edit item form
define('_EDIT_ITEM',				'Editar l\'article');
define('_EDIT_SUBMIT',				'Editat l\'article');
define('_EDIT_ORIG_AUTHOR',			'Autor original');
define('_EDIT_BACKTODRAFTS',		'Afegir a esborranys');
define('_EDIT_COMMENTSNOTE',		'(note: impedir els comentaris _no_ amagar� els comentaris ja afegits)');

// used on delete screens
define('_DELETE_CONFIRM',			'Si us plau conforma l\'eliminaci�');
define('_DELETE_CONFIRM_BTN',		'Confirma l\'eliminaci�');
define('_CONFIRMTXT_ITEM',			'Est�s apunt d\'esborrar el seg�ent article:');
define('_CONFIRMTXT_COMMENT',		'Est�s apunt d\'esborrar el seg�ent comentari:');
define('_CONFIRMTXT_TEAM1',			'Estas apunt d\'esborrar ');
define('_CONFIRMTXT_TEAM2',			' de l\'equip del blog ');
define('_CONFIRMTXT_BLOG',			'EL blog que vols esborrar �s: ');
define('_WARNINGTXT_BLOGDEL',		'Atenci�! Si elimines un blog tamb� s\'esborraran TOTS els articles i comentaris que hi ha dintre d\'aquest. Si us plau confirma per asegurar que saps el que fas!<br />Recorda de no interrompre Nucleus mentre s\'est� esborrant el blog.');
define('_CONFIRMTXT_MEMBER',		'Est�s apunt d\'esborrar les dades del seg�ent membre: ');
define('_CONFIRMTXT_TEMPLATE',		'Est�s apunt d\'esborrar la plantilla anomenada ');
define('_CONFIRMTXT_SKIN',			'Est�s apunt d\'esborrar la disposici� anomenat ');
define('_CONFIRMTXT_BAN',			'Est�s apunt d\'esborrar la prohivici� al rang d\'ip');
define('_CONFIRMTXT_CATEGORY',		'Est�s apunt d\'esborrar la categoria ');

// some status messages
define('_DELETED_ITEM',				'Article esborrat');
define('_DELETED_MEMBER',			'Membre esborrat');
define('_DELETED_COMMENT',			'comentari esborrat');
define('_DELETED_BLOG',				'Blog esborrat');
define('_DELETED_CATEGORY',			'Categoria esborrada');
define('_ITEM_MOVED',				'Article mogut');
define('_ITEM_ADDED',				'Article afegit');
define('_COMMENT_UPDATED',			'Comentari actualitzat');
define('_SKIN_UPDATED',				'Les dades de la disposici� han estat guardades');
define('_TEMPLATE_UPDATED',			'Les dades de la plantilla han estat guardades');

// errors
define('_ERROR_COMMENT_LONGWORD',	'Si us plau, no utilitzis paraules de m�s de 90 car�cters en els teus comentaris');
define('_ERROR_COMMENT_NOCOMMENT',	'Escriu un comentari si us plau');
define('_ERROR_COMMENT_NOUSERNAME',	'Nom d\'usuari erroni');
define('_ERROR_COMMENT_TOOLONG',	'Els teus coemtnaris s�n massa llargs (El l�mit s�n 5000 car�cters)');
define('_ERROR_COMMENTS_DISABLED',	'En aquest moment els comentaris estan desactivats.');
define('_ERROR_COMMENTS_NONPUBLIC',	'Has d\'estar registrat per poder posar comentaris en aquest weblog');
define('_ERROR_COMMENTS_MEMBERNICK','El nom que vols utilitzar en el teu comentari ja est� utilitzat per unusuari registrat. Si us plau tria\'n un altre.');
define('_ERROR_SKIN',				'Error de disposici�');
define('_ERROR_ITEMCLOSED',			'Aquest article est� tancat, no �s posible posar nous comentaris ni votar-lo');
define('_ERROR_NOSUCHITEM',			'No existeix un article com aquest');
define('_ERROR_NOSUCHBLOG',			'No existeix aquest weblog');
define('_ERROR_NOSUCHSKIN',			'No existeix aquesta disposici�');
define('_ERROR_NOSUCHMEMBER',		'No existeix aquest usuari');
define('_ERROR_NOTONTEAM',			'No estas a l\'equip d\'aquest weblog.');
define('_ERROR_BADDESTBLOG',		'El weblog de desti no existeix');
define('_ERROR_NOTONDESTTEAM',		'No �s pot moure l\'article perqu� no est�s a l\'equip del weblog de dest�');
define('_ERROR_NOEMPTYITEMS',		'No �s poden afegir articles bu�ts!');
define('_ERROR_BADMAILADDRESS',		'L\'adre�a de correu no �s v�lida');
define('_ERROR_BADNOTIFY',			'Una o m�s de les adreces introdu�des no s�n v�lides');
define('_ERROR_BADNAME',			'El nom no �s v�lid (nom�s s\'admeten car�cters de l\'a a la z i 0-9, sense espais al principi o al final)');
define('_ERROR_NICKNAMEINUSE',		'Un altre usuari est� utilitzant el mateix �lies');
define('_ERROR_PASSWORDMISMATCH',	'Les contrasenyes han de coincidir');
define('_ERROR_PASSWORDTOOSHORT',	'La contrasenya ha de ser de 6 car�cters almenys');
define('_ERROR_PASSWORDMISSING',	'La contrasenya no pot estar en blanc');
define('_ERROR_REALNAMEMISSING',	'Has de posar un nom de deb�');
define('_ERROR_ATLEASTONEADMIN',	'Sempre hi ha d\'haver almenys un "super-admin" que pugui entrar a l\'area d\'administraci�.');
define('_ERROR_ATLEASTONEBLOGADMIN','Fent aquesta acci� deixaries el teu weblog sense manteniment. Si us plau, asegurat sempre que almenys hi ha 1 adminstrador.');
define('_ERROR_ALREADYONTEAM',		'No pots afegir un usuari que ja est� a la llista');
define('_ERROR_BADSHORTBLOGNAME',	'EL nom curt del weblog nom�s ha de contenir a-z i 0-9, sense espais');
define('_ERROR_DUPSHORTBLOGNAME',	'Ja hi ha un altre weblog amb aqwest nom. Aquests noms han de ser �nics');
define('_ERROR_UPDATEFILE',			'No �s pot tenir acc�s el fitxer d\'actualitzaci�. Asegurat que els permisos estan possats correctament (intenta fer-li un chmod 666). Ting�s en conte tamb� que la localitzaci� �s relativa al directori d\'administraci�, potser est�s interesat a utilitzar la ruta absoluta (una cosa semblant a /el/teu/directori/nucleus/)');
define('_ERROR_DELDEFBLOG',			'No �s pot esborrar el weblog per defecte');
define('_ERROR_DELETEMEMBER',		'Aquest usuari no pot ser esborrat, segurament perqu� �s l\'autor d\'articles o comentaris');
define('_ERROR_BADTEMPLATENAME',	'Nom de plantilla inv�lid, nom�s a-z i 0-9, sense espais');
define('_ERROR_DUPTEMPLATENAME',	'Ja hi ha una altre plantilla amb aquest nom');
define('_ERROR_BADSKINNAME',		'Nom de la disposici� inv�lid (nom�s a-z, 0-9 s�n permesos, sense espais)');
define('_ERROR_DUPSKINNAME',		'Ja existeix una altre disposici� amb aquest nom');
define('_ERROR_DEFAULTSKIN',		'Sempre hi ha d\'haver una disposici� anomenada "default"');
define('_ERROR_SKINDEFDELETE',		'No �s pot esborrar la disposici� perqu� �s la disposici� per defecte del seg�ent weblog: ');
define('_ERROR_DISALLOWED',			'Ho sento, no t\'�s perm�s realitzar aquesta acci�');
define('_ERROR_DELETEBAN',			'S\'ha produ�t un error mentres s\'estava borrant un bandeig (el bandeig no existeix)');
define('_ERROR_ADDBAN',				'S\'ha produ�t un error mentres s\'intentava afegir un bandeig. Pot ser que el bandeig no s\'hagi afegit correctament a tots els weblogs.');
define('_ERROR_BADACTION',			'L\'acci� demanada no existeix');
define('_ERROR_MEMBERMAILDISABLED',	'Els missatges entre usuaris estan desactivats');
define('_ERROR_MEMBERCREATEDISABLED','No est� permesa la creaci� de nous usuaris');
define('_ERROR_INCORRECTEMAIL',		'Adre�a de correu incorrecta');
define('_ERROR_VOTEDBEFORE',		'Ja has votat per aquest article');
define('_ERROR_BANNED1',			'No t\'�s perm�s realitzar aquesta acci� (rang ip ');
define('_ERROR_BANNED2',			'). El missatge �s: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'Has d\'estar registrat per poder realitzar aquesta acci�');
define('_ERROR_CONNECT',			'Error al connectar');
define('_ERROR_FILE_TOO_BIG',		'El fitxer �s massa gran!');
define('_ERROR_BADFILETYPE',		'Ho sento, aquest tipus de fitxer no est� perm�s');
define('_ERROR_BADREQUEST',			'Petici� de pujada erronia');
define('_ERROR_DISALLOWEDUPLOAD',	'No est�s a l\'equip de cap weblog. Per tant, no t\'�s perm�s pujar fitxers');
define('_ERROR_BADPERMISSIONS',		'Els permissos de fitxer/direcotri no s�n correctes');
define('_ERROR_UPLOADMOVEP',		'Error al moure el fitxer pujat');
define('_ERROR_UPLOADCOPY',			'Error al copiar el fitxer');
define('_ERROR_UPLOADDUPLICATE',	'Ja exiteix un altre fitxer amb awuest nom. Intenta canviar-li el nom abans de pujar-lo.');
define('_ERROR_LOGINDISALLOWED',	'No t\'�s perm�s entrar a l\'�rea d\'administraci�. No obstant aix�, pots registrar-te com un altre usuari');
define('_ERROR_DBCONNECT',			'No �s pot conectar al servidor MySQL');
define('_ERROR_DBSELECT',			'No ha estat possible sel�Lecci�nar la base de dades de nucleus.');
define('_ERROR_NOSUCHLANGUAGE',		'No existeix tal llenguatge');
define('_ERROR_NOSUCHCATEGORY',		'No existeix la categoria desitjada');
define('_ERROR_DELETELASTCATEGORY',	'Hi ha d\'haver almenys 1 categoria');
define('_ERROR_DELETEDEFCATEGORY',	'No �s pot esborrar la categoria per defecte');
define('_ERROR_BADCATEGORYNAME',	'Nom de categoria erroni');
define('_ERROR_DUPCATEGORYNAME',	'Ja existeix una altre categoria amb aquest nom');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'Av�s: el valor actual no correspon a un directori!');
define('_WARNING_NOTREADABLE',		'Av�s: el valor actual correspon a un directori sense perm�s de lectura!');
define('_WARNING_NOTWRITABLE',		'Warning: el valor actual correspon a un directori sense perm�s d\'escriptura!');

// media and upload
define('_MEDIA_UPLOADLINK',			'Pujar un fitxer nou');
define('_MEDIA_MODIFIED',			'modificat');
define('_MEDIA_FILENAME',			'nom');
define('_MEDIA_DIMENSIONS',			'dimensions');
define('_MEDIA_INLINE',				'EnL�nia');
define('_MEDIA_POPUP',				'Finestra');
define('_UPLOAD_TITLE',				'Tria el fitxer');
define('_UPLOAD_MSG',				'Selecciona el fitxer que vols pujar m�s avall i apreta el bot� de \'Pujar\'.');
define('_UPLOAD_BUTTON',			'Pujar');

// some status messages
define('_MSG_ACCOUNTCREATED',		'Usuari creat, la contrasenya s\'ha enviat a l\'adre�a de correu electr�nic');
define('_MSG_PASSWORDSENT',			'La contrasenya ha estat enviada per correu electr�nic.');
define('_MSG_LOGINAGAIN',			'Haur�s de registrat-te de nou degut al canvi de l\'informaci�');
define('_MSG_SETTINGSCHANGED',		'Valors canviats');
define('_MSG_ADMINCHANGED',			'Adminstrador canviat');
define('_MSG_NEWBLOG',				'Nou weblog creat');
define('_MSG_ACTIONLOGCLEARED',		'Bu�dat del registre d\'accions');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'Acci� no permesa: ');
define('_ACTIONLOG_PWDREMINDERSENT','Nova contrasenya enviada per ');
define('_ACTIONLOG_TITLE',			'Registre d\'accions');
define('_ACTIONLOG_CLEAR_TITLE',	'Bu�dar el registre d\'accions');
define('_ACTIONLOG_CLEAR_TEXT',		'Bu�dar el registre d\'accions ara');

// team management
define('_TEAM_TITLE',				'Modificar l\'equip pel weblog ');
define('_TEAM_CURRENT',				'Equip actual');
define('_TEAM_ADDNEW',				'Afegir un nou usuari a l\'equip');
define('_TEAM_CHOOSEMEMBER',		'Triar l\'usuari');
define('_TEAM_ADMIN',				'Privileguis d\'administraci�? ');
define('_TEAM_ADD',					'Afegir a l\'equip');
define('_TEAM_ADD_BTN',				'Afegir a l\'equip');

// blogsettings
define('_EBLOG_TITLE',				'Editar els par�metres del weblog');
define('_EBLOG_TEAM_TITLE',			'Editar l\'equip');
define('_EBLOG_TEAM_TEXT',			'Fes un clic aqu� per canviar el teu equip...');
define('_EBLOG_SETTINGS_TITLE',		'Par�metres del weblog');
define('_EBLOG_NAME',				'Nom del weblog');
define('_EBLOG_SHORTNAME',			'Nom curt del weblog');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(nom�s pot contenir a-z sense espais)');
define('_EBLOG_DESC',				'Descripci� del weblog');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'Disposici� per defecte');
define('_EBLOG_DEFCAT',				'Categoria per defecte');
define('_EBLOG_LINEBREAKS',			'convertir salts de l�nia');
define('_EBLOG_DISABLECOMMENTS',	'Comentaris actiavats?<br /><small>(Desactivar els comentaris significa que ser� impossible afegir opinions sobre els articles.)</small>');
define('_EBLOG_ANONYMOUS',			'Permetre comentaris per usuaris no registrats?');
define('_EBLOG_NOTIFY',				'Adreces de notificaci� (utilitza ; com a separador)');
define('_EBLOG_NOTIFY_ON',			'Notificar quan');
define('_EBLOG_NOTIFY_COMMENT',		'Nous comentaris');
define('_EBLOG_NOTIFY_KARMA',		'Nous vots karma');
define('_EBLOG_NOTIFY_ITEM',		'Nous articles');
define('_EBLOG_PING',				'Fer ping a weblog.com al actualizar?');
define('_EBLOG_MAXCOMMENTS',		'Nombre m�xim de comentaris');
define('_EBLOG_UPDATE',				'Fitxer d\'actualizaci�');
define('_EBLOG_OFFSET',				'Temps a compensar (offset)');
define('_EBLOG_STIME',				'L\'hora actual del servidor �s');
define('_EBLOG_BTIME',				'L\'hora actual del weblog �s');
define('_EBLOG_CHANGE',				'Canviar els par�metres');
define('_EBLOG_CHANGE_BTN',			'Canviar els par�metres');
define('_EBLOG_ADMIN',				'Administrador del weblog');
define('_EBLOG_ADMIN_MSG',			'Et ser�n assignats privilegis d\'administrador');
define('_EBLOG_CREATE_TITLE',		'Crear un nou weblog');
define('_EBLOG_CREATE_TEXT',		'Omple el formulari seg�ent per crear un nou weblog. <br /><br /> <b>Nota:</b> Nom�s les opcions necessaris estan llistades. Si vols posar opcions extra, entra a la p�gina amb els par�metres del weblog un cop hagi estat creat.');
define('_EBLOG_CREATE',				'Crear!');
define('_EBLOG_CREATE_BTN',			'Crear un weblog');
define('_EBLOG_CAT_TITLE',			'Categories');
define('_EBLOG_CAT_NAME',			'Nom de la categoria');
define('_EBLOG_CAT_DESC',			'Descripci� de la categoria');
define('_EBLOG_CAT_CREATE',			'Crear una nova categoria');
define('_EBLOG_CAT_UPDATE',			'Actualitzar una categoria');
define('_EBLOG_CAT_UPDATE_BTN',		'Actualitzar una categoria');

// templates
define('_TEMPLATE_TITLE',			'Editar les plantilles');
define('_TEMPLATE_AVAILABLE_TITLE',	'Plantilles disponibles');
define('_TEMPLATE_NEW_TITLE',		'Nova plantilla');
define('_TEMPLATE_NAME',			'Nom de la plantilla');
define('_TEMPLATE_DESC',			'Descripci� de la plantilla');
define('_TEMPLATE_CREATE',			'Crear la plantilla');
define('_TEMPLATE_CREATE_BTN',		'Crear la plantilla');
define('_TEMPLATE_EDIT_TITLE',		'Ediar la plantilla');
define('_TEMPLATE_BACK',			'Tornar al resum de plantilles');
define('_TEMPLATE_EDIT_MSG',		'No totes les parts de la plantilla s�n necessaries, deixa bu�des aquelles que no necessitis.');
define('_TEMPLATE_SETTINGS',		'Opcions de la plantilla');
define('_TEMPLATE_ITEMS',			'Articles');
define('_TEMPLATE_ITEMHEADER',		'Cap�alera de l\'article');
define('_TEMPLATE_ITEMBODY',		'Cos de l\'article');
define('_TEMPLATE_ITEMFOOTER',		'Peu de l\'article');
define('_TEMPLATE_MORELINK',		'Enlla� a l\'entrada extensa');
define('_TEMPLATE_NEW',				'Indicaci� d\'un nou article');
define('_TEMPLATE_COMMENTS_ANY',	'Comentaris (si �s que n\'hi ha algun)');
define('_TEMPLATE_CHEADER',			'Cap�alera dels comentaris');
define('_TEMPLATE_CBODY',			'Cos dels comentaris');
define('_TEMPLATE_CFOOTER',			'Peu dels comentaris');
define('_TEMPLATE_CONE',			'Un comentari');
define('_TEMPLATE_CMANY',			'Dos (o m�s) comentaris');
define('_TEMPLATE_CMORE',			'Llegir m�s sobre els comentaris');
define('_TEMPLATE_CMEXTRA',			'Opcions extres pels usuaris registrats');
define('_TEMPLATE_COMMENTS_NONE',	'Comentaris (si no n\'hi ha cap)');
define('_TEMPLATE_CNONE',			'No hi ha comentaris');
define('_TEMPLATE_COMMENTS_TOOMUCH','Comentaris (si n\'hi ha, per� s�n masses per mostrar-los en l�nia)');
define('_TEMPLATE_CTOOMUCH',		'Masses comentaris');
define('_TEMPLATE_ARCHIVELIST',		'Llista de l\'arxiu');
define('_TEMPLATE_AHEADER',			'Cap�alera de la llista de l\'arxiu');
define('_TEMPLATE_AITEM',			'Article de la llista d\'arxiu');
define('_TEMPLATE_AFOOTER',			'Peu de la llista d\'arxius');
define('_TEMPLATE_DATETIME',		'Data i hora');
define('_TEMPLATE_DHEADER',			'Cap�alera amb la data');
define('_TEMPLATE_DFOOTER',			'Peu amb la data');
define('_TEMPLATE_DFORMAT',			'Format de la data');
define('_TEMPLATE_TFORMAT',			'Format de l\'hora');
define('_TEMPLATE_LOCALE',			'Local');
define('_TEMPLATE_IMAGE',			'Finiestres d\'imatge');
define('_TEMPLATE_PCODE',			'Codi per les finestres d\'imatge');
define('_TEMPLATE_ICODE',			'Codi per la imatge en l�nia');
define('_TEMPLATE_MCODE',			'Codi per un article multimedia');
define('_TEMPLATE_SEARCH',			'B�squeda');
define('_TEMPLATE_SHIGHLIGHT',		'Subratllat');
define('_TEMPLATE_SNOTFOUND',		'No s\'ha trobat res en la b�squeda');
define('_TEMPLATE_UPDATE',			'Actualitzar');
define('_TEMPLATE_UPDATE_BTN',		'Actualitzar la plantilla');
define('_TEMPLATE_RESET_BTN',		'Posa les dades per defecte');
define('_TEMPLATE_CATEGORYLIST',	'Llista de cateorgies');
define('_TEMPLATE_CATHEADER',		'Cap�alera de la llista de categories');
define('_TEMPLATE_CATITEM',			'Article de la llista de categories');
define('_TEMPLATE_CATFOOTER',		'Peu de la llista de categories');

// skins
define('_SKIN_EDIT_TITLE',			'Edita la disposici�');
define('_SKIN_AVAILABLE_TITLE',		'Disposicions disponibles');
define('_SKIN_NEW_TITLE',			'Nova disposici�');
define('_SKIN_NAME',				'Nom');
define('_SKIN_DESC',				'Descripci�');
define('_SKIN_TYPE',				'Tipus de contingut');
define('_SKIN_CREATE',				'Crear');
define('_SKIN_CREATE_BTN',			'Crear una nova disposici�');
define('_SKIN_EDITONE_TITLE',		'Editar la disposici�');
define('_SKIN_BACK',				'Tornar al resumn de disposicions');
define('_SKIN_PARTS_TITLE',			'Parts de la disposici�');
define('_SKIN_PARTS_MSG',			'No totes les parts s�n necessaris per la disposici�. Deixa en blanc aquelles que no necessitis. Triar el tipus de disposici� a editar m�s avall:');
define('_SKIN_PART_MAIN',			'�ndex principal');
define('_SKIN_PART_ITEM',			'P�gina d\'article');
define('_SKIN_PART_ALIST',			'Llista d\'arxius');
define('_SKIN_PART_ARCHIVE',		'Arxiu');
define('_SKIN_PART_SEARCH',			'B�squeda');
define('_SKIN_PART_ERROR',			'Errors');
define('_SKIN_PART_MEMBER',			'Detalls dels usuaris');
define('_SKIN_PART_POPUP',			'Finestres d\'imatge');
define('_SKIN_GENSETTINGS_TITLE',	'Par�metres generals');
define('_SKIN_CHANGE',				'Canviar');
define('_SKIN_CHANGE_BTN',			'Canviar aquests par�metres');
define('_SKIN_UPDATE_BTN',			'Actualitzar la disposici�');
define('_SKIN_RESET_BTN',			'Posar les dades per defecte');
define('_SKIN_EDITPART_TITLE',		'Editar la disposici�');
define('_SKIN_GOBACK',				'Tirar enrere');
define('_SKIN_ALLOWEDVARS',			'P�matetre permesos (fes un clic per obtenir m�s informaci�):');

// global settings
define('_SETTINGS_TITLE',			'Par�metres generals');
define('_SETTINGS_SUB_GENERAL',		'Par�metres generals');
define('_SETTINGS_DEFBLOG',			'Weblog per defecte');
define('_SETTINGS_ADMINMAIL',		'Adre�a electr�nica de l\'administrador');
define('_SETTINGS_SITENAME',		'Nom del lloc');
define('_SETTINGS_SITEURL',			'URL del lloc web (ha d\'acabar amb una barra)');
define('_SETTINGS_ADMINURL',		'URL de l\'area d\'administraci� (ha d\'acabar amb una barra)');
define('_SETTINGS_DIRS',			'Directoris de nucleus');
define('_SETTINGS_MEDIADIR',		'Directori multimedia');
define('_SETTINGS_SEECONFIGPHP',	'(veure config.php)');
define('_SETTINGS_MEDIAURL',		'URL del directori multimedia (ha d\'acabar amb una barra)');
define('_SETTINGS_ALLOWUPLOAD',		'Permetre pujar fitxers?');
define('_SETTINGS_ALLOWUPLOADTYPES','Tipus de fitxers a pujar permesos');
define('_SETTINGS_CHANGELOGIN',		'Permetre als usuaris canviar el seu nom d\'usuari/contrasenya');
define('_SETTINGS_COOKIES_TITLE',	'Par�metres de les galetes (cookies del navegador)');
define('_SETTINGS_COOKIELIFE',		'Temps de durada de la galeta de registre');
define('_SETTINGS_COOKIESESSION',	'Galetes per sessi�');
define('_SETTINGS_COOKIEMONTH',		'Durada d\'un mes');
define('_SETTINGS_COOKIEPATH',		'Directori de les galetes (avan�at)');
define('_SETTINGS_COOKIEDOMAIN',	'Domini de les galetes (avan�at)');
define('_SETTINGS_COOKIESECURE',	'Galeta segura (avan�at)');
define('_SETTINGS_LASTVISIT',		'Guardar la galeta de l\'�ltima visita');
define('_SETTINGS_ALLOWCREATE',		'Permetre als visitants crear-se un usuari');
define('_SETTINGS_NEWLOGIN',		'Permetre el registre d\'usuaris creats per visitants');
define('_SETTINGS_NEWLOGIN2',		'(nom�s s\'aplica a usuaris recent creats)');
define('_SETTINGS_MEMBERMSGS',		'Permetre servei Usuari-a-Usuari');
define('_SETTINGS_LANGUAGE',		'Idiome per defecte');
define('_SETTINGS_DISABLESITE',		'Descativar la p�gina');
define('_SETTINGS_DBLOGIN',			'Usuari MySQL &amp; Base de dades');
define('_SETTINGS_UPDATE',			'Actualitzar els par�metres');
define('_SETTINGS_UPDATE_BTN',		'Actualitzar els par�metres');
define('_SETTINGS_DISABLEJS',		'Descativar la barra JavaScript');
define('_SETTINGS_MEDIA',			'Par�metres Multimedia/Pujada');
define('_SETTINGS_MEDIAPREFIX',		'Posar la data com a prefix als fitxers pujats');
define('_SETTINGS_MEMBERS',			'Par�metres d\'usuari');

// bans
define('_BAN_TITLE',				'Llista de bandejos per');
define('_BAN_NONE',					'No hi ha bandejos per aquest webblog');
define('_BAN_NEW_TITLE',			'Afegir un bandeig nou');
define('_BAN_NEW_TEXT',				'Afegir un nou bandeig ara');
define('_BAN_REMOVE_TITLE',			'Borrar un bandeig');
define('_BAN_IPRANGE',				'Rang IP');
define('_BAN_BLOGS',				'Quins weblogs?');
define('_BAN_DELETE_TITLE',			'Esborrar un bandeig');
define('_BAN_ALLBLOGS',				'Tots els weblogs en els quals tens privilegis d\'administraci�.');
define('_BAN_REMOVED_TITLE',		'Bandeig esborrat');
define('_BAN_REMOVED_TEXT',			'El bandeig ha estat esborat dels seg�ents weblogs:');
define('_BAN_ADD_TITLE',			'Afegir un bandeig');
define('_BAN_IPRANGE_TEXT',			'Tria el rang IP que vols bloquejar m�s avall. Com menys n�meros hi possis, m�s adre�es seran bloquejades.');
define('_BAN_BLOGS_TEXT',			'Pots triar bandejar la IP nom�s en un weblog, o bandejar-la en tots els weblogs on tens drets d\'administraci�. Fes la teva tria m�s avall.');
define('_BAN_REASON_TITLE',			'Ra�');
define('_BAN_REASON_TEXT',			'Pots posar una ra� pel bandeig, que ser� mostrada quan dita IP intenti posar comentaris o afegir vots karma. La llargada m�xima s�n 256 car�cters.');
define('_BAN_ADD_BTN',				'Afegir un bandeig');

// LOGIN screen
define('_LOGIN_MESSAGE',			'Missatge');
define('_LOGIN_NAME',				'Nom');
define('_LOGIN_PASSWORD',			'Contrasenya');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'Has oblidat la teva contrasenya?');

// membermanagement
define('_MEMBERS_TITLE',			'Administraci� d\'usuaris');
define('_MEMBERS_CURRENT',			'Usuaris actuals');
define('_MEMBERS_NEW',				'Nou usuari');
define('_MEMBERS_DISPLAY',			'Nom d\'usuari');
define('_MEMBERS_DISPLAY_INFO',		'(Aquest �s el nom que haur�s d\'utilitzar per registrar-te)');
define('_MEMBERS_REALNAME',			'Nom real');
define('_MEMBERS_PWD',				'Contrasenya');
define('_MEMBERS_REPPWD',			'Repetir la contrasenya');
define('_MEMBERS_EMAIL',			'Adre�a de correu');
define('_MEMBERS_EMAIL_EDIT',		'(Quan canvies l\'adre�a de correu una nova contrasenya ser� automaticament enviada all�)');
define('_MEMBERS_URL',				'Adre�a de la p�gina (URL)');
define('_MEMBERS_SUPERADMIN',		'Privilegis d\'administraci�');
define('_MEMBERS_CANLOGIN',			'Can login to admin area');
define('_MEMBERS_NOTES',			'Notes');
define('_MEMBERS_NEW_BTN',			'Afegir un usuari');
define('_MEMBERS_EDIT',				'Editar un usuari');
define('_MEMBERS_EDIT_BTN',			'Change Settings');
define('_MEMBERS_BACKTOOVERVIEW',	'Tornar al resum d\'usuaris');
define('_MEMBERS_DEFLANG',			'Idioma');
define('_MEMBERS_USESITELANG',		'- utilitzar els par�metres del lloc -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'Visitar la p�gina');
define('_BLOGLIST_ADD',				'Afegir un article');
define('_BLOGLIST_TT_ADD',			'Afegir un nou article en aquest weblog');
define('_BLOGLIST_EDIT',			'Editar/Esborrar articles');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Preferits');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'Par�metres');
define('_BLOGLIST_TT_SETTINGS',		'Canviar par�metres/editar la llista');
define('_BLOGLIST_BANS',			'Bandejos');
define('_BLOGLIST_TT_BANS',			'Veure, afegir o borrar IPs banejades');
define('_BLOGLIST_DELETE',			'Esborrar totes');
define('_BLOGLIST_TT_DELETE',		'Eliminar aquest weblog');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'Els teus weblogs');
define('_OVERVIEW_YRDRAFTS',		'Els teus esborranys');
define('_OVERVIEW_YRSETTINGS',		'Els teus par�metres');
define('_OVERVIEW_GSETTINGS',		'Par�metres generals');
define('_OVERVIEW_NOBLOGS',			'No est�s a la llista d\'usuaris de cap weblog');
define('_OVERVIEW_NODRAFTS',		'No hi ha esborranys');
define('_OVERVIEW_EDITSETTINGS',	'Edita els teus par�metres...');
define('_OVERVIEW_BROWSEITEMS',		'Mostra els teus articles...');
define('_OVERVIEW_BROWSECOMM',		'Mostra els teus comentaris...');
define('_OVERVIEW_VIEWLOG',			'Veure els registre d\'accions...');
define('_OVERVIEW_MEMBERS',			'Editars els usuaris...');
define('_OVERVIEW_NEWLOG',			'Crear un nou weblog...');
define('_OVERVIEW_SETTINGS',		'Editar els par�metres...');
define('_OVERVIEW_TEMPLATES',		'Editar les plantilles...');
define('_OVERVIEW_SKINS',			'Editar les disposicions...');
define('_OVERVIEW_BACKUP',			'Copia de seguretat/Restaurar...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'Articles pel weblog'); 
define('_ITEMLIST_YOUR',			'Els teus articles');

// Comments
define('_COMMENTS',					'Comentaris');
define('_NOCOMMENTS',				'No hi ha comentaris per aquest article');
define('_COMMENTS_YOUR',			'Els teus comentaris');
define('_NOCOMMENTS_YOUR',			'No has escrit cap comentari');

// LISTS (general)
define('_LISTS_NOMORE',				'No hi ha m�s resultats, o no n\'hi ha ni un');
define('_LISTS_PREV',				'Anterior');
define('_LISTS_NEXT',				'Seg�ent');
define('_LISTS_SEARCH',				'Buscar');
define('_LISTS_CHANGE',				'Canviar');
define('_LISTS_PERPAGE',			'articles/p�gina');
define('_LISTS_ACTIONS',			'Accions');
define('_LISTS_DELETE',				'Esborrar');
define('_LISTS_EDIT',				'Editar');
define('_LISTS_MOVE',				'Moure');
define('_LISTS_CLONE',				'Clonar');
define('_LISTS_TITLE',				'Titol');
define('_LISTS_BLOG',				'Weblog');
define('_LISTS_NAME',				'Nom');
define('_LISTS_DESC',				'Descripci�');
define('_LISTS_TIME',				'Data');
define('_LISTS_COMMENTS',			'Comentaris');
define('_LISTS_TYPE',				'Tipus');


// member list 
define('_LIST_MEMBER_NAME',			'Usuari');
define('_LIST_MEMBER_RNAME',		'Nom real');
define('_LIST_MEMBER_ADMIN',		'Super-admin? ');
define('_LIST_MEMBER_LOGIN',		'Pot registrar-se? ');
define('_LIST_MEMBER_URL',			'P�gina web');

// banlist
define('_LIST_BAN_IPRANGE',			'Rang IP');
define('_LIST_BAN_REASON',			'Ra�');

// actionlist
define('_LIST_ACTION_MSG',			'Missatge');

// commentlist
define('_LIST_COMMENT_BANIP',		'Banejar IP');
define('_LIST_COMMENT_WHO',			'Autor');
define('_LIST_COMMENT',				'Comentari');
define('_LIST_COMMENT_HOST',		'Host');

// itemlist
define('_LIST_ITEM_INFO',			'Informaci�');
define('_LIST_ITEM_CONTENT',		'Titol i text');


// teamlist
define('_LIST_TEAM_ADMIN',			'Administrador ');
define('_LIST_TEAM_CHADMIN',		'Canviar administrador');

// edit comments
define('_EDITC_TITLE',				'Editar els comentaris');
define('_EDITC_WHO',				'Autor');
define('_EDITC_HOST',				'Des d\'on?');
define('_EDITC_WHEN',				'Quan?');
define('_EDITC_TEXT',				'Text');
define('_EDITC_EDIT',				'Editar el comentari');
define('_EDITC_MEMBER',				'usuari');
define('_EDITC_NONMEMBER',			'usuari no registrat');

// move item
define('_MOVE_TITLE',				'Moure a quin weblog?');
define('_MOVE_BTN',					'Moure l\'article');

?>
