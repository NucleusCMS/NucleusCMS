<?
// Galician Nucleus Language File
// 
// Author: Xes Garc�a Santamarina (xes@afragamaldita.net)
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
define('_MEDIA_VIEW',				'ver');
define('_MEDIA_VIEW_TT',			'Ver arquivo (�brese nunha nova fiestra)');
define('_MEDIA_FILTER_APPLY',		'Aplicar filtro');
define('_MEDIA_FILTER_LABEL',		'Filtro: ');
define('_MEDIA_UPLOAD_TO',			'Subir a...');
define('_MEDIA_UPLOAD_NEW',			'Subir arquivo novo...');
define('_MEDIA_COLLECTION_SELECT',	'Seleccionar');
define('_MEDIA_COLLECTION_TT',		'Cambiar a esta categor�a');
define('_MEDIA_COLLECTION_LABEL',	'Colecci�n actual: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'Alinear � esquerda');
define('_ADD_ALIGNRIGHT_TT',		'Alinear � derieta');
define('_ADD_ALIGNCENTER_TT',		'Alinear � centro');

// searchable blog setting (yes/no)
define('_EBLOG_SEARCH',				'Incluir en b�squedas');

// generic upload failure
define('_ERROR_UPLOADFAILED',		'Erro � subir');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'Permite introducir entradas no pasado');
define('_ADD_CHANGEDATE',			'Actualizar data e hora');
define('_BMLET_CHANGEDATE',			'Actualizar data e hora');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'Importar/exportar pel...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Normal');
define('_PARSER_INCMODE_SKINDIR',	'Usa-lo directorio de peles');
define('_SKIN_INCLUDE_MODE',		'Incluir modo');
define('_SKIN_INCLUDE_PREFIX',		'Incluir prefixo');

// global settings
define('_SETTINGS_BASESKIN',		'Pel base');
define('_SETTINGS_SKINSURL',		'URL de peles');
define('_SETTINGS_ACTIONSURL',		'URL completa para action.php');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'Non se pode move-la categor�a por defecto');
define('_ERROR_MOVETOSELF',			'Non se pode move-la categor�a (a bit�cora de destino � a mesma que a de orixen)');
define('_MOVECAT_TITLE',			'Selecciona-la bit�cora � que move-la categor�a');
define('_MOVECAT_BTN',				'Mover categor�a');

// URLMode setting
define('_SETTINGS_URLMODE',			'Modo URL');
define('_SETTINGS_URLMODE_NORMAL',	'Normal');
define('_SETTINGS_URLMODE_PATHINFO','Atractivo');

// Batch operations
define('_BATCH_NOSELECTION',		'Nada seleccionado sobre o que se poida realizar unha acci�n');
define('_BATCH_ITEMS',				'Operaci�n de lotes sobre elementos');
define('_BATCH_CATEGORIES',			'Operaci�n de lotes sobre categor�as');
define('_BATCH_MEMBERS',			'Operaci�n de lotes sobre membros');
define('_BATCH_TEAM',				'Operaci�n de lotes sobre membros de equipos');
define('_BATCH_COMMENTS',			'Operaci�n de lotes sobre comentarios');
define('_BATCH_UNKNOWN',			'Operaci�n de lotes desconocida: ');
define('_BATCH_EXECUTING',			'Executando');
define('_BATCH_ONCATEGORY',			'sobre a categor�a');
define('_BATCH_ONITEM',				'sobre o elemento');
define('_BATCH_ONCOMMENT',			'sobre o comentario');
define('_BATCH_ONMEMBER',			'sobre o membro');
define('_BATCH_ONTEAM',				'sobre o membro de equipo');
define('_BATCH_SUCCESS',			'�Sin problemas!');
define('_BATCH_DONE',				'�Feito!');
define('_BATCH_DELETE_CONFIRM',		'Confirma-la eliminaci�n do lote');
define('_BATCH_DELETE_CONFIRM_BTN',	'Confirma-la eliminaci�n do lote');
define('_BATCH_SELECTALL',			'seleccionar todo');
define('_BATCH_DESELECTALL',		'deseleccionar todo');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'Eliminar');
define('_BATCH_ITEM_MOVE',			'Mover');
define('_BATCH_MEMBER_DELETE',		'Eliminar');
define('_BATCH_MEMBER_SET_ADM',		'Dar dereitos de administraci�n');
define('_BATCH_MEMBER_UNSET_ADM',	'Quitar dereitos de administraci�n');
define('_BATCH_TEAM_DELETE',		'Borrar do equipo');
define('_BATCH_TEAM_SET_ADM',		'Dar dereitos de administraci�n');
define('_BATCH_TEAM_UNSET_ADM',		'Quitar dereitos de administraci�n');
define('_BATCH_CAT_DELETE',			'Eliminar');
define('_BATCH_CAT_MOVE',			'Mover a outra bit�cora');
define('_BATCH_COMMENT_DELETE',		'Eliminar');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'Introducir novo elemento...');
define('_ADD_PLUGIN_EXTRAS',		'Opci�ns extra de plugin');

// errors
define('_ERROR_CATCREATEFAIL',		'Non se pode crear unha nova categor�a');
define('_ERROR_NUCLEUSVERSIONREQ',	'Este plugin necesita unha versi�n mais recente de Nucleus: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Voltar a preferencias de bit�cora');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Importar');
define('_SKINIE_TITLE_EXPORT',		'Exportar');
define('_SKINIE_BTN_IMPORT',		'Importar');
define('_SKINIE_BTN_EXPORT',		'Exportar peles/plantillas seleccionadas');
define('_SKINIE_LOCAL',				'Importar dende un arquivo local:');
define('_SKINIE_NOCANDIDATES',		'Non se atoparon candidatos para importar no directorio de peles');
define('_SKINIE_FROMURL',			'Importar desde URL:');
define('_SKINIE_EXPORT_INTRO',		'Seleccionar abaixo as peles e plantillas a exportar');
define('_SKINIE_EXPORT_SKINS',		'Peles');
define('_SKINIE_EXPORT_TEMPLATES',	'Plantillas');
define('_SKINIE_EXPORT_EXTRA',		'Informaci�n Extra');
define('_SKINIE_CONFIRM_OVERWRITE',	'Sobreescribe peeles que xa existan (ver conflictos de nome)');
define('_SKINIE_CONFIRM_IMPORT',	'S�, quero importar �sto');
define('_SKINIE_CONFIRM_TITLE',		'Sobre importar peles e plantillas');
define('_SKINIE_INFO_SKINS',		'Peles en arquivo:');
define('_SKINIE_INFO_TEMPLATES',	'Plantillas en arquivo:');
define('_SKINIE_INFO_GENERAL',		'Informaci�n:');
define('_SKINIE_INFO_SKINCLASH',	'nome de pel conflictivo:');
define('_SKINIE_INFO_TEMPLCLASH',	'nome de plantilla conflictivo:');
define('_SKINIE_INFO_IMPORTEDSKINS','Peles importadas:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Plantillas importadas:');
define('_SKINIE_DONE',				'Importaci�n feita');

define('_AND',						'y');
define('_OR',						'o');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'campo valeiro (facer clic para editar)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'incl�e modo:');
define('_LIST_SKINS_INCPREFIX',		'incl�e prefixo:');
define('_LIST_SKINS_DEFINED',		'Partes definidas:');

// backup
define('_BACKUPS_TITLE',			'gardar / Restaurar');
define('_BACKUP_TITLE',				'gardar');
define('_BACKUP_INTRO',				'Facer clic sobre o srguinte bot�n para crear unha copia de seguridade da base de datos de Nucleus. Pedir�selle que garde un arquivo de seguridade. Gardeo nun sitio seguro.');
define('_BACKUP_ZIP_YES',			'Intente usala compresi�n');
define('_BACKUP_ZIP_NO',			'Non use compresi�n');
define('_BACKUP_BTN',				'Crear copia de seguridade');
define('_BACKUP_NOTE',				'<b>Nota:</b> S� os contidos da base de datos se gardan na copia de seguridade. Arquivos de medios, im�xes e preferencias de config.php <b>NON</b> se incl�en na copia de seguridade.');
define('_RESTORE_TITLE',			'Restaurar');
define('_RESTORE_NOTE',				'<b>AVISO:</b> Restaurar dende unha copia de seguridade <b>BORRAR�</b> t�dolos datos de Nucleus actuales! �Facer �sto s� se est� totalmente seguro!	<br />	<b>Nota:</b> Comprobar a versi�n de Nucleus na que se creou a copia � a mesma que a versi�n que se est� usando agora! Non funcionar� se non � as�');
define('_RESTORE_INTRO',			'Seleccionar o arquivo de copia de seguridade (ser� enviado � servidor) e faga clic sobre o bot�n "Restaurar" para empezar.');
define('_RESTORE_IMSURE',			'�S�, estou seguro de que quero facer eso!');
define('_RESTORE_BTN',				'Restaurar dende arquivo');
define('_RESTORE_WARNING',			'(asegurarse de estar restaurando a copia de seguridade correcta, quizais sexa mellor facer una copia de seguridade antes de empezar)');
define('_ERROR_BACKUP_NOTSURE',		'Necesitar� marca-la casilla \'Estou seguro\'');
define('_RESTORE_COMPLETE',			'Restauraci�n feita');

// new item notification
define('_NOTIFY_NI_MSG',			'Un novo elemento foi insertado:');
define('_NOTIFY_NI_TITLE',			'Novo elemento!');
define('_NOTIFY_KV_MSG',			'Voto Karma del elemento:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'Comentario sobre o elemento:');
define('_NOTIFY_NC_TITLE',			'Comentario de Nucleus:');
define('_NOTIFY_USERID',			'ID de usuario:');
define('_NOTIFY_USER',				'Usuario:');
define('_NOTIFY_COMMENT',			'Comentario:');
define('_NOTIFY_VOTE',				'Voto:');
define('_NOTIFY_HOST',				'Host:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'Membro:');
define('_NOTIFY_TITLE',				'T�tulo:');
define('_NOTIFY_CONTENTS',			'Contido:');

// member mail message
define('_MMAIL_MSG',				'Unha mensaxe enviada por');
define('_MMAIL_FROMANON',			'un visitante an�nimo');
define('_MMAIL_FROMNUC',			'Insertado dende unha bit�cora de Nucleus en');
define('_MMAIL_TITLE',				'Unha mensaxe de');
define('_MMAIL_MAIL',				'Mensaxe:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'Introducir entrada');
define('_BMLET_EDIT',				'Editar entrada');
define('_BMLET_DELETE',				'Eliminar entrada');
define('_BMLET_BODY',				'Corpo');
define('_BMLET_MORE',				'Mais');
define('_BMLET_OPTIONS',			'Opci�ns');
define('_BMLET_PREVIEW',			'Previsualizar');

// used in bookmarklet
define('_ITEM_UPDATED',				'A entrada foi actualizada');
define('_ITEM_DELETED',				'A entrada foi eliminada');

// plugins
define('_CONFIRMTXT_PLUGIN',		'Seguro que se desexa elimina-lo plugin chamado');
define('_ERROR_NOSUCHPLUGIN',		'Non existe ese plugin');
define('_ERROR_DUPPLUGIN',			'Ese plugin xa foi instalado');
define('_ERROR_PLUGFILEERROR',		'Non existe ese plugin, ou os permisos no son os correctos');
define('_PLUGS_NOCANDIDATES',		'Non se atoparon candidatos para o plugin');

define('_PLUGS_TITLE_MANAGE',		'Xestionar plugins');
define('_PLUGS_TITLE_INSTALLED',	'Actualmente instalado');
define('_PLUGS_TITLE_UPDATE',		'Actualiza-la lista de suscripci�n');
define('_PLUGS_TEXT_UPDATE',		'Nucleus manten unha cach� das suscripcions a eventos dos plugins. Cando se actualiza un plugin sustituindo o seu arquivo, d�bese executar esta actualizaci�n para asegurar que as suscripcions da cach� son correctas');
define('_PLUGS_TITLE_NEW',			'Instalar un novo plugin');
define('_PLUGS_ADD_TEXT',			'A continuaci�n hai una lista de t�dolos arquivos do teu directorio de plugins, alg�ns poder�an ser plugins sin instalaci�n. Aseg�rate de estar <strong>totalmente seguro</strong> de que se trata de un plugin antes de introducirlo.');
define('_PLUGS_BTN_INSTALL',		'Instalar plugin');
define('_BACKTOOVERVIEW',			'voltar a principal');

// editlink
define('_TEMPLATE_EDITLINK',		'Editalo enlace da entrada');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'Insertar cadro � esquerda');
define('_ADD_RIGHT_TT',				'Insertar cadro � dereita');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'Nova categor�a');

// new settings
define('_SETTINGS_PLUGINURL',		'URL do plugin');
define('_SETTINGS_MAXUPLOADSIZE',	'Max. tama�o de arquivo para subida (bytes)');
define('_SETTINGS_NONMEMBERMSGS',	'Permitir �s non membros que envien mensaxes');
define('_SETTINGS_PROTECTMEMNAMES',	'Protexelos nomes dos membros');

// overview screen
define('_OVERVIEW_PLUGINS',			'Xestionar plugins...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'Rexistro dun novo membro:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'O teu e-mail:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'Sen permiso de administraci�n sobre ningunha das bit�coras que ten o membro de destino do equipo. Polo tanto, non � posible subir arquivos � directorio de medios de este membro');

// plugin list
define('_LISTS_INFO',				'Informaci�n');
define('_LIST_PLUGS_AUTHOR',		'Por:');
define('_LIST_PLUGS_VER',			'Versi�n:');
define('_LIST_PLUGS_SITE',			'Visitar sitio');
define('_LIST_PLUGS_DESC',			'Descripci�n:');
define('_LIST_PLUGS_SUBS',			'Suscribir �s seguintes eventos:');
define('_LIST_PLUGS_UP',			'desplazar arriba');
define('_LIST_PLUGS_DOWN',			'desplazar abaixo');
define('_LIST_PLUGS_UNINSTALL',		'desinstalar');
define('_LIST_PLUGS_ADMIN',			'admin');
define('_LIST_PLUGS_OPTIONS',		'editar&nbsp;opci�ns');

// plugin option list
define('_LISTS_VALUE',				'Valor');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'Este plugin non ten establecida ningunha opci�n');
define('_PLUGS_BACK',				'Voltar � lista de plugins');
define('_PLUGS_SAVE',				'Gardar opci�ns');
define('_PLUGS_OPTIONS_UPDATED',	'Opci�ns de plugin actualizadas');

define('_OVERVIEW_MANAGEMENT',		'Xesti�n');
define('_OVERVIEW_MANAGE',			'Xesti�n de Nucleus...');
define('_MANAGE_GENERAL',			'Xesti�n xeral');
define('_MANAGE_SKINS',				'"Skins" e plantillas');
define('_MANAGE_EXTRA',				'Caracter�sticas extra');

define('_BACKTOMANAGE',				'voltar � xesti�n de Nucleus');


// END introduced after v1.1 END




// charset to use 
define('_CHARSET',					'iso-8859-1');

// global stuff
define('_LOGOUT',					'Sair');
define('_LOGIN',					'Entrar');
define('_YES',						'S�');
define('_NO',						'Non');
define('_SUBMIT',					'Enviar');
define('_ERROR',					'Erro');
define('_ERRORMSG',					'Ha sucedido un error!');
define('_BACK',						'voltar');
define('_NOTLOGGEDIN',				'No registrado');
define('_LOGGEDINAS',				'Registrado como');
define('_ADMINHOME',				'Administraci�n');
define('_NAME',						'nome');
define('_BACKHOME',					'Voltar � administraci�n');
define('_BADACTION',				'No existe la acci�n requerida');
define('_MESSAGE',					'Mensaje');
define('_HELP_TT',					'Ayuda!');
define('_YOURSITE',					'Ver web');


define('_POPUP_CLOSE',				'Cerrar ventana');

define('_LOGIN_PLEASE',				'Es necesario reg�strarse primero');

// commentform
define('_COMMENTFORM_YOUARE',		'Eres');
define('_COMMENTFORM_SUBMIT',		'Introducir comentario');
define('_COMMENTFORM_COMMENT',		'Comentario');
define('_COMMENTFORM_NAME',			'Nome');
define('_COMMENTFORM_MAIL',			'Email/HTTP');
define('_COMMENTFORM_REMEMBER',		'Lembrar usuario');

// loginform
define('_LOGINFORM_NAME',			'Usuario');
define('_LOGINFORM_PWD',			'contrasinal');
define('_LOGINFORM_YOUARE',			'Rexistrado como');
define('_LOGINFORM_SHARED',			'Ordenador compartido');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'Enviar mensaxe');

// search form
define('_SEARCHFORM_SUBMIT',		'Buscar');

// add item form
define('_ADD_ADDTO',				'Introducir nova entrada a');
define('_ADD_CREATENEW',			'Crear nova entrada');
define('_ADD_BODY',					'Corpo');
define('_ADD_TITLE',				'T�tulo');
define('_ADD_MORE',					'Extensi�n (opcional)');
define('_ADD_CATEGORY',				'Categor�a');
define('_ADD_PREVIEW',				'Previsualizar');
define('_ADD_DISABLE_COMMENTS',		'Deshabilitar comentarios?');
define('_ADD_DRAFTNFUTURE',			'Borrador e futuras entradas');
define('_ADD_ADDITEM',				'Introducir entrada');
define('_ADD_ADDNOW',				'Introducir agora');
define('_ADD_ADDLATER',				'Introducir logo');
define('_ADD_PLACE_ON',				'Colocar en');
define('_ADD_ADDDRAFT',				'Introducir no borrador');
define('_ADD_NOPASTDATES',			'(As datas e horas pasadas non son v�lidas, usarase o momento actual)');
define('_ADD_BOLD_TT',				'Negrita');
define('_ADD_ITALIC_TT',			'It�lica');
define('_ADD_HREF_TT',				'Crear enlace');
define('_ADD_MEDIA_TT',				'Introducir imaxe ou multimedia');
define('_ADD_PREVIEW_TT',			'Mostrar/ocultar previsualizaci�n');
define('_ADD_CUT_TT',				'Cortar');
define('_ADD_COPY_TT',				'Copiar');
define('_ADD_PASTE_TT',				'Pegar');


// edit item form
define('_EDIT_ITEM',				'Editar entrada');
define('_EDIT_SUBMIT',				'Editar entrada');
define('_EDIT_ORIG_AUTHOR',			'Autor orixinal');
define('_EDIT_BACKTODRAFTS',		'Enviar � borrador');
define('_EDIT_COMMENTSNOTE',		'(nota: deshabilitalos comentarios non ocultar� os existentes)');

// used on delete screens
define('_DELETE_CONFIRM',			'Confirmala eliminaci�n');
define('_DELETE_CONFIRM_BTN',		'Confirmala eliminaci�n');
define('_CONFIRMTXT_ITEM',			'A punto de eliminala segunte entrada:');
define('_CONFIRMTXT_COMMENT',		'A punto de eliminalo seguinte comentario:');
define('_CONFIRMTXT_TEAM1',			'A punto de eliminar ');
define('_CONFIRMTXT_TEAM2',			' do equipo para a bit�cora ');
define('_CONFIRMTXT_BLOG',			'Aa bit�cora a eliminar �: ');
define('_WARNINGTXT_BLOGDEL',		'Cuidado! Eliminar unha bit�cora eliminar� TODALAS s�as entradas e comentarios. Confirmar definitivamente a eliminaci�n!<br />Non interrumpilo sistema durante a eliminaci�n.');
define('_CONFIRMTXT_MEMBER',		'A punto de eliminalo seguinte membro: ');
define('_CONFIRMTXT_TEMPLATE',		'A punto de eliminala plantilla chamada ');
define('_CONFIRMTXT_SKIN',			'A punto de eliminala pel chamada ');
define('_CONFIRMTXT_BAN',			'A punto de eliminala restricci�n para o rango IP');
define('_CONFIRMTXT_CATEGORY',		'A punto de eliminala categor�a ');

// some status messages
define('_DELETED_ITEM',				'Entrada eliminada');
define('_DELETED_MEMBER',			'Membro eliminado');
define('_DELETED_COMMENT',			'Comentario eliminado');
define('_DELETED_BLOG',				'Bit�cora eliminada');
define('_DELETED_CATEGORY',			'Categor�a eliminada');
define('_ITEM_MOVED',				'Entrada movida');
define('_ITEM_ADDED',				'Entrada introducida');
define('_COMMENT_UPDATED',			'Comentario actualizado');
define('_SKIN_UPDATED',				'Datos da pel actualizados');
define('_TEMPLATE_UPDATED',			'Datos da plantilla gardados');

// errors
define('_ERROR_COMMENT_LONGWORD',	'Non usar palabras de lonxitude maior a 90 car�cteres nos comentarios');
define('_ERROR_COMMENT_NOCOMMENT',	'Introducilo comentario');
define('_ERROR_COMMENT_NOUSERNAME',	'Usuario incorrecto');
define('_ERROR_COMMENT_TOOLONG',	'Comentario  demasiado longo (m�ximo : 5000 car�cteres)');
define('_ERROR_COMMENTS_DISABLED',	'Comentarios deshabilitados para esta bit�cora.');
define('_ERROR_COMMENTS_NONPUBLIC',	'Rexistrarse primeiro como membro para introducir comentarios nesta bit�cora');
define('_ERROR_COMMENTS_MEMBERNICK','O nome indicado para introducir comentarios est� sendo usado por outro membro. Probar con outro.');
define('_ERROR_SKIN',				'Erro de pel');
define('_ERROR_ITEMCLOSED',			'Esta entrada est� pechada, non � posible introducir novos comentarios � votar');
define('_ERROR_NOSUCHITEM',			'A entrada indicada non existe');
define('_ERROR_NOSUCHBLOG',			'A bit�cora indicada non existe');
define('_ERROR_NOSUCHSKIN',			'A pel indicada non existe');
define('_ERROR_NOSUCHMEMBER',		'O membro indicado non existe');
define('_ERROR_NOTONTEAM',			'O usuario non pertence � equipo desta bit�cora.');
define('_ERROR_BADDESTBLOG',		'A bit�cora de destino non existe');
define('_ERROR_NOTONDESTTEAM',		'Non � posible movela entrada, xa que o usuario non pertence � equipo da bit�cora de destino');
define('_ERROR_NOEMPTYITEMS',		'Non � posible introducir entradas valeiras!');
define('_ERROR_BADMAILADDRESS',		'Direcci�n de correo incorrecta');
define('_ERROR_BADNOTIFY',			'Unha ou mais das direcci�ns de notificaci�n non son direcci�ns correctas');
define('_ERROR_BADNAME',			'O nome non � v�lido (s�lo a-z y 0-9 permitidos, sin espacios � principio nin � final)');
define('_ERROR_NICKNAMEINUSE',		'Outro membro est� usando xa ese nome');
define('_ERROR_PASSWORDMISMATCH',	'As contrasinals deben coincidir');
define('_ERROR_PASSWORDTOOSHORT',	'A contrasinal debe ter polo menos 6 car�cteres');
define('_ERROR_PASSWORDMISSING',	'A contrasinal non pode estar valeira');
define('_ERROR_REALNAMEMISSING',	'O nome real introducido non � v�lido');
define('_ERROR_ATLEASTONEADMIN',	'Debe de existir sempre polo menos un superadministrador que poida rexistrarse na zona de administraci�n.');
define('_ERROR_ATLEASTONEBLOGADMIN','Executar esta acci�n deixar�a a bit�cora insostible. Debe de existir sempre polo menos un administrador.');
define('_ERROR_ALREADYONTEAM',		'Non � posible introducir un membro que xa pertenza � equipo');
define('_ERROR_BADSHORTBLOGNAME',	'O nome corto da bit�cora s� debe conter a-z y 0-9, y sen espacios');
define('_ERROR_DUPSHORTBLOGNAME',	'Outra bit�cora xa ten ese nome corto. Os nomes cortos deben de ser �nicos');
define('_ERROR_UPDATEFILE',			'Sen permiso de escritura para actualizalo arquivo. Os permisos deben de ser correctos (probar chmod 666). A localizaci�n debe ser relativa � directorio de administraci�n, polo que quizais conve�a usar un cami�o absoluto (como /cami�o/ata/nucleus/)');
define('_ERROR_DELDEFBLOG',			'Non � posible eliminala bit�cora principal');
define('_ERROR_DELETEMEMBER',		'Este membro non pode ser eliminado, probablemente porque � o autor de entradas ou comentarios');
define('_ERROR_BADTEMPLATENAME',	'Nome incorrecto para a plantilla, usar s� a-z y 0-9, y sen espacios');
define('_ERROR_DUPTEMPLATENAME',	'Xa existe outra plantilla con ese nome');
define('_ERROR_BADSKINNAME',		'Nome incorrecto para a pel (s� a-z, 0-9 est�n permitidos, e sen espacios)');
define('_ERROR_DUPSKINNAME',		'Xa existe outra pel con ese nome');
define('_ERROR_DEFAULTSKIN',		'Sempre debe de existir unha pel chamada "default"');
define('_ERROR_SKINDEFDELETE',		'Non � posible eliminala pel xa que � a pel predeterminada para a seguinte bit�cora: ');
define('_ERROR_DISALLOWED',			'Sen suficiente permiso para executar esa acci�n');
define('_ERROR_DELETEBAN',			'Erro � eliminala restricci�n (a restricci�n non existe)');
define('_ERROR_ADDBAN',				'Erro � introducir restricci�n. A poida que non se introducira correctamente nas bit�coras.');
define('_ERROR_BADACTION',			'A acci�n indicada non existe');
define('_ERROR_MEMBERMAILDISABLED',	'As mensaxes de membro a membro est�n deshabilitadas');
define('_ERROR_MEMBERCREATEDISABLED','A creaci�n de contas para membros est� deshabilitada');
define('_ERROR_INCORRECTEMAIL',		'Direcci�n de correo incorrecta');
define('_ERROR_VOTEDBEFORE',		'O voto do usuario para esta entrada xa existe');
define('_ERROR_BANNED1',			'Non � posible executala acci�n xa que el (rango IP ');
define('_ERROR_BANNED2',			') est� restrinxido. A mensaxe era: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'O usuario debe de estar rexistrado para facer eso');
define('_ERROR_CONNECT',			'Erro de conexi�n');
define('_ERROR_FILE_TOO_BIG',		'O arquivo � demasiado grande!');
define('_ERROR_BADFILETYPE',		'Tipo de arquivo non permitido');
define('_ERROR_BADREQUEST',			'Erro no env�o do arquivo');
define('_ERROR_DISALLOWEDUPLOAD',	'O usuario non pertence � equipo de ningunha bit�cora. Non � posible enviar arquivos');
define('_ERROR_BADPERMISSIONS',		'Los permisos non son correctos');
define('_ERROR_UPLOADMOVEP',		'Erro � movelo arquivo enviado');
define('_ERROR_UPLOADCOPY',			'Erro � copialo arquivo enviado');
define('_ERROR_UPLOADDUPLICATE',	'Xa existe otro arquivo con ese nome. Intente renomealo antes de envialo.');
define('_ERROR_LOGINDISALLOWED',	'Sen permiso para entrar na administraci�n. � posible rexistrarse como outro usuario');
define('_ERROR_DBCONNECT',			'Non � posible conectar con MySQL server');
define('_ERROR_DBSELECT',			'Non � posible seleccionala base de datos de Nucleus.');
define('_ERROR_NOSUCHLANGUAGE',		'Non existe o arquivo para o idioma');
define('_ERROR_NOSUCHCATEGORY',		'Non existe a categor�a');
define('_ERROR_DELETELASTCATEGORY',	'Debe de haber polo menos una categor�a');
define('_ERROR_DELETEDEFCATEGORY',	'Non � posible eliminala categor�a principal');
define('_ERROR_BADCATEGORYNAME',	'Nome de categor�a incorrecto');
define('_ERROR_DUPCATEGORYNAME',	'Xa existe outra categor�a con ese nome');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'Cuidado: O valor actual non � un directorio!');
define('_WARNING_NOTREADABLE',		'Cuidado: O valor actual � un directorio sin permiso de lectura!');
define('_WARNING_NOTWRITABLE',		'Cuidado: O valor actual NON � un directorio con permiso de escritura!');

// media and upload
define('_MEDIA_UPLOADLINK',			'Enviar un novo arquivo');
define('_MEDIA_MODIFIED',			'modificado');
define('_MEDIA_FILENAME',			'Nome de arquivo');
define('_MEDIA_DIMENSIONS',			'Dimensi�ns');
define('_MEDIA_INLINE',				'Conectado');
define('_MEDIA_POPUP',				'Vent� popup');
define('_UPLOAD_TITLE',				'Seleccionar arquivo');
define('_UPLOAD_MSG',				'Seleccionalo arquivo a enviar, e pulsalo bot�n \'Enviar\'.');
define('_UPLOAD_BUTTON',			'Enviar');

// some status messages
define('_MSG_ACCOUNTCREATED',		'Conta creada, a contrasinal ser� enviada por correo');
define('_MSG_PASSWORDSENT',			'A contrasinal foi enviada por correo.');
define('_MSG_LOGINAGAIN',			'� necesario rexistrarse de novo xa que los datos do usuario foron modificados');
define('_MSG_SETTINGSCHANGED',		'Preferencias modificadas');
define('_MSG_ADMINCHANGED',			'Administrador modificado');
define('_MSG_NEWBLOG',				'Nova bit�cora creada');
define('_MSG_ACTIONLOGCLEARED',		'Rexistro de actividades valeirado');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'Acci�n non permitida: ');
define('_ACTIONLOG_PWDREMINDERSENT','Nova contrasinal enviada a ');
define('_ACTIONLOG_TITLE',			'Rexistro de actividades');
define('_ACTIONLOG_CLEAR_TITLE',	'Limpalo rexistro de actividades');
define('_ACTIONLOG_CLEAR_TEXT',		'Limpalo rexistro de actividades ahora');

// team management
define('_TEAM_TITLE',				'Modificalo equipo da bit�cora ');
define('_TEAM_CURRENT',				'Equipo actual');
define('_TEAM_ADDNEW',				'Introducir un nuevo membro no equipo');
define('_TEAM_CHOOSEMEMBER',		'Seleccionar membro');
define('_TEAM_ADMIN',				'Privilexios de administraci�n? ');
define('_TEAM_ADD',					'Introducir no equipo');
define('_TEAM_ADD_BTN',				'Introducir no equipo');

// blogsettings
define('_EBLOG_TITLE',				'Modificalas preferencias da bit�cora');
define('_EBLOG_TEAM_TITLE',			'Modificarlo equipo');
define('_EBLOG_TEAM_TEXT',			'Pulsa aqu� para modificalo equipo.');
define('_EBLOG_SETTINGS_TITLE',		'Preferencias da bit�cora');
define('_EBLOG_NAME',				'Nome da bit�cora');
define('_EBLOG_SHORTNAME',			'Nome corto da bit�cora');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(debe conter s� letras e sen espacios)');
define('_EBLOG_DESC',				'Descripci�n da bit�cora');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'Pel por defecto');
define('_EBLOG_DEFCAT',				'Categor�a por defecto');
define('_EBLOG_LINEBREAKS',			'Convertir saltos de l�nea');
define('_EBLOG_DISABLECOMMENTS',	'Habilitar comentarios?<br /><small>(Deshabilitalos comentarios implica non poder introducir novos.)</small>');
define('_EBLOG_ANONYMOUS',			'Permitese a introducci�n de comentarios por non membros?');
define('_EBLOG_NOTIFY',				'Direcci�n(s) de notificaci�n (usa ; como separador)');
define('_EBLOG_NOTIFY_ON',			'Notificar');
define('_EBLOG_NOTIFY_COMMENT',		'Novos comentarios');
define('_EBLOG_NOTIFY_KARMA',		'Novos votos');
define('_EBLOG_NOTIFY_ITEM',		'Novas entradas');
define('_EBLOG_PING',				'Ping Weblogs.com � actualizar?');
define('_EBLOG_MAXCOMMENTS',		'M�xima cantidade de comentarios');
define('_EBLOG_UPDATE',				'Actualizalo arquivo');
define('_EBLOG_OFFSET',				'Zona horaria');
define('_EBLOG_STIME',				'A hora actual do servidor �');
define('_EBLOG_BTIME',				'A hora actual da bit�cora �');
define('_EBLOG_CHANGE',				'Modificalas preferencias');
define('_EBLOG_CHANGE_BTN',			'Modificar preferencias');
define('_EBLOG_ADMIN',				'Administraci�n da bit�cora');
define('_EBLOG_ADMIN_MSG',			'Asinar�nselle privilexios de administrador � usuario');
define('_EBLOG_CREATE_TITLE',		'Crear nova bit�cora');
define('_EBLOG_CREATE_TEXT',		'Cubrir o seguinte formulario para crear unha nueva bit�cora. <br /><br /> <b>Nota:</b> S� as opci�ns necesarias est�n listadas. Para opci�ns extra, entrar na p�xina de preferencias da bit�cora despois de creala.');
define('_EBLOG_CREATE',				'Crear!');
define('_EBLOG_CREATE_BTN',			'Crear bit�cora');
define('_EBLOG_CAT_TITLE',			'Categor�as');
define('_EBLOG_CAT_NAME',			'Nome da categor�a');
define('_EBLOG_CAT_DESC',			'Descripci�n da categor�a');
define('_EBLOG_CAT_CREATE',			'Crear categor�a');
define('_EBLOG_CAT_UPDATE',			'Actualizar categor�a');
define('_EBLOG_CAT_UPDATE_BTN',		'Actualizar categor�a');

// templates
define('_TEMPLATE_TITLE',			'Modificar plantillas');
define('_TEMPLATE_AVAILABLE_TITLE',	'Plantillas dispo�ibles');
define('_TEMPLATE_NEW_TITLE',		'Nova plantilla');
define('_TEMPLATE_NAME',			'Nome de plantilla');
define('_TEMPLATE_DESC',			'Descripci�n da plantilla');
define('_TEMPLATE_CREATE',			'Crear plantilla');
define('_TEMPLATE_CREATE_BTN',		'Crear plantilla');
define('_TEMPLATE_EDIT_TITLE',		'Editar plantilla');
define('_TEMPLATE_BACK',			'Voltar � p�xina da plantilla');
define('_TEMPLATE_EDIT_MSG',		'Non todalas partes da plantilla son necesarias, � posible deixar en blanco as innecesarias.');
define('_TEMPLATE_SETTINGS',		'Preferencias das plantillas');
define('_TEMPLATE_ITEMS',			'Entradas');
define('_TEMPLATE_ITEMHEADER',		'Cabeceira de entrada');
define('_TEMPLATE_ITEMBODY',		'Corpo da entrada');
define('_TEMPLATE_ITEMFOOTER',		'Pe da entrada');
define('_TEMPLATE_MORELINK',		'Enlazala extensi�n da entrada');
define('_TEMPLATE_NEW',				'Indicaci�n de nova entrada');
define('_TEMPLATE_COMMENTS_ANY',	'Comentarios (se os hai)');
define('_TEMPLATE_CHEADER',			'Cabeceira dos comentarios');
define('_TEMPLATE_CBODY',			'Corpo dos comentarios');
define('_TEMPLATE_CFOOTER',			'Pe dos comentarios');
define('_TEMPLATE_CONE',			'Un comentario');
define('_TEMPLATE_CMANY',			'Dous (ou mais) comentarios');
define('_TEMPLATE_CMORE',			'Comentarios Ler mais');
define('_TEMPLATE_CMEXTRA',			'membro Extra');
define('_TEMPLATE_COMMENTS_NONE',	'Comentarios (se non hai)');
define('_TEMPLATE_CNONE',			'Sen comentarios');
define('_TEMPLATE_COMMENTS_TOOMUCH','Comentarios (se os hai, pero son demasiados para mostralos directamente)');
define('_TEMPLATE_CTOOMUCH',		'Demasiados comentarios');
define('_TEMPLATE_ARCHIVELIST',		'Listas de arquivos');
define('_TEMPLATE_AHEADER',			'Cabeceira da lista de arquivos');
define('_TEMPLATE_AITEM',			'Elemento da lista de arquivos');
define('_TEMPLATE_AFOOTER',			'Pe da lista de arquivos');
define('_TEMPLATE_DATETIME',		'Data e hora');
define('_TEMPLATE_DHEADER',			'Cabeceira da data');
define('_TEMPLATE_DFOOTER',			'Pe da data');
define('_TEMPLATE_DFORMAT',			'Formato da data');
define('_TEMPLATE_TFORMAT',			'Formato da hora');
define('_TEMPLATE_LOCALE',			'Local');
define('_TEMPLATE_IMAGE',			'Vent�s de imaxe');
define('_TEMPLATE_PCODE',			'C�digo de enlace popup');
define('_TEMPLATE_ICODE',			'C�digo de imaxe insertada');
define('_TEMPLATE_MCODE',			'C�digo de enlace a imaxe ou multimedia');
define('_TEMPLATE_SEARCH',			'Buscar');
define('_TEMPLATE_SHIGHLIGHT',		'Resaltar');
define('_TEMPLATE_SNOTFOUND',		'Nada encontrado na busca');
define('_TEMPLATE_UPDATE',			'Actualizar');
define('_TEMPLATE_UPDATE_BTN',		'Actualizar plantilla');
define('_TEMPLATE_RESET_BTN',		'Inicializar datos');
define('_TEMPLATE_CATEGORYLIST',	'Lista de categor�as');
define('_TEMPLATE_CATHEADER',		'Cabeceira de lista de categor�as');
define('_TEMPLATE_CATITEM',			'Elemento de lista de categor�as');
define('_TEMPLATE_CATFOOTER',		'P� de lista de categor�as');

// skins
define('_SKIN_EDIT_TITLE',			'Modificar peles');
define('_SKIN_AVAILABLE_TITLE',		'Peles dispo�ibles');
define('_SKIN_NEW_TITLE',			'Nova pel');
define('_SKIN_NAME',				'Nome');
define('_SKIN_DESC',				'Descripci�n');
define('_SKIN_TYPE',				'Tipo de contido');
define('_SKIN_CREATE',				'Crear');
define('_SKIN_CREATE_BTN',			'Crear pel');
define('_SKIN_EDITONE_TITLE',		'Modificar pel');
define('_SKIN_BACK',				'Voltar � p�gina da pel');
define('_SKIN_PARTS_TITLE',			'Partes da piel');
define('_SKIN_PARTS_MSG',			'Non t�dolos tipos son necesarios para cada pel. Deixar en blanco os innecesarios. Selecciona o tipo de pel a modificar:');
define('_SKIN_PART_MAIN',			'�ndice principal');
define('_SKIN_PART_ITEM',			'P�xinas do elemento');
define('_SKIN_PART_ALIST',			'Lista de arquivos');
define('_SKIN_PART_ARCHIVE',		'arquivos');
define('_SKIN_PART_SEARCH',			'Buscar');
define('_SKIN_PART_ERROR',			'Erros');
define('_SKIN_PART_MEMBER',			'Detalles do membro');
define('_SKIN_PART_POPUP',			'Im�xes de popup');
define('_SKIN_GENSETTINGS_TITLE',	'Preferencias xerais');
define('_SKIN_CHANGE',				'Modificar');
define('_SKIN_CHANGE_BTN',			'Modificar estas preferencias');
define('_SKIN_UPDATE_BTN',			'Actualizar pel');
define('_SKIN_RESET_BTN',			'Inicializar datos');
define('_SKIN_EDITPART_TITLE',		'Modificar pel');
define('_SKIN_GOBACK',				'Voltar');
define('_SKIN_ALLOWEDVARS',			'Variables permitidas (facer clic para mais informaci�n):');

// global settings
define('_SETTINGS_TITLE',			'Preferencias xerais');
define('_SETTINGS_SUB_GENERAL',		'Preferencias xerais');
define('_SETTINGS_DEFBLOG',			'Bit�cora principal');
define('_SETTINGS_ADMINMAIL',		'Administrador de correo');
define('_SETTINGS_SITENAME',		'nome da web');
define('_SETTINGS_SITEURL',			'URL da web ( debe de rematar cunha barra / )');
define('_SETTINGS_ADMINURL',		'URL da administraci�n ( debe terminar cunha barra / )');
define('_SETTINGS_DIRS',			'Directorios de Nucleus');
define('_SETTINGS_MEDIADIR',		'Directorios de imaxes e multimedia');
define('_SETTINGS_SEECONFIGPHP',	'(ver config.php)');
define('_SETTINGS_MEDIAURL',		'URL para im�xes ou multimedia ( debe de rematar cunha barra / )');
define('_SETTINGS_ALLOWUPLOAD',		'�Permitilo env�o de arquivos?');
define('_SETTINGS_ALLOWUPLOADTYPES','Tipos de arquivo permitidos para env�o');
define('_SETTINGS_CHANGELOGIN',		'Permitirlles �s membros modificar os seus datos de rexistro / contrasinal');
define('_SETTINGS_COOKIES_TITLE',	'Preferencias de cookies');
define('_SETTINGS_COOKIELIFE',		'Tempo de vida da cookie de rexistro');
define('_SETTINGS_COOKIESESSION',	'Cookies de sesi�n');
define('_SETTINGS_COOKIEMONTH',		'Tempo de vida dun mes');
define('_SETTINGS_COOKIEPATH',		'Cami�o das cookies (avanzado)');
define('_SETTINGS_COOKIEDOMAIN',	'Dominio das cookies (avanzado)');
define('_SETTINGS_COOKIESECURE',	'Cookies seguras (avanzado)');
define('_SETTINGS_LASTVISIT',		'Gardalas cookies da �ltima visita');
define('_SETTINGS_ALLOWCREATE',		'Permitir �s visitantes crear unha conta de membro');
define('_SETTINGS_NEWLOGIN',		'Rexistro permitido para as contas creadas polo usuario');
define('_SETTINGS_NEWLOGIN2',		'(s� para contas novas)');
define('_SETTINGS_MEMBERMSGS',		'Permite un servicio de membro a membro');
define('_SETTINGS_LANGUAGE',		'Idioma por defecto');
define('_SETTINGS_DISABLESITE',		'Deshabilitar web');
define('_SETTINGS_DBLOGIN',			'MySQL Rexistro e base de datos');
define('_SETTINGS_UPDATE',			'Actualizar preferencias');
define('_SETTINGS_UPDATE_BTN',		'Actualizar preferencias');
define('_SETTINGS_DISABLEJS',		'Deshabilitala barra de ferramientas de JavaScript');
define('_SETTINGS_MEDIA',			'Preferencias de env�o / im�xes / multimedia');
define('_SETTINGS_MEDIAPREFIX',		'Prefixalos arquivos enviados coa data');
define('_SETTINGS_MEMBERS',			'Preferencias dos membros');

// bans
define('_BAN_TITLE',				'Lista de restriccions para');
define('_BAN_NONE',					'No hay restricci�ns para esta bit�cora');
define('_BAN_NEW_TITLE',			'Introducir nova restricci�n');
define('_BAN_NEW_TEXT',				'Introducir unha nova restricci�n agora');
define('_BAN_REMOVE_TITLE',			'Eliminar restricci�n');
define('_BAN_IPRANGE',				'Rango IP');
define('_BAN_BLOGS',				'�Qu� bit�coras?');
define('_BAN_DELETE_TITLE',			'Eliminar restricci�n');
define('_BAN_ALLBLOGS',				'Bit�coras para as que o usuario ten privilexios de administrador.');
define('_BAN_REMOVED_TITLE',		'Restricci�n eliminada');
define('_BAN_REMOVED_TEXT',			'Restricci�n eliminada para as seguintes bit�coras:');
define('_BAN_ADD_TITLE',			'Introducir restricci�n');
define('_BAN_IPRANGE_TEXT',			'Seleccionalo rango IP a restrinxir. A menor cantidade de n�meros, m�is direccions restrinxidas.');
define('_BAN_BLOGS_TEXT',			'� posible optar por restrinxila IP para unha s�a bit�cora, ou restrinxila IP en todalas bit�coras nas que o usuario te�a privilexios de administrador.');
define('_BAN_REASON_TITLE',			'Raz�n');
define('_BAN_REASON_TEXT',			'� posible incluir unha raz�n para a restricci�n, que ser� mostrada cuando o usuario con esa IP intente engadir un comentario ou votar. La longitud m�xima es de 256 car�cteres.');
define('_BAN_ADD_BTN',				'Introducir restricci�n');

// LOGIN screen
define('_LOGIN_MESSAGE',			'Mensaxe');
define('_LOGIN_NAME',				'nome');
define('_LOGIN_PASSWORD',			'contrasinal');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'�Esquencichela contrasinal?');

// membermanagement
define('_MEMBERS_TITLE',			'Xesti�n dos membros');
define('_MEMBERS_CURRENT',			'Membros actuais');
define('_MEMBERS_NEW',				'Novo membro');
define('_MEMBERS_DISPLAY',			'Nome mostrado');
define('_MEMBERS_DISPLAY_INFO',		'(Este � o nome usado para rexistrarse)');
define('_MEMBERS_REALNAME',			'Nome real');
define('_MEMBERS_PWD',				'Contrasinal');
define('_MEMBERS_REPPWD',			'Repetila contrasinal');
define('_MEMBERS_EMAIL',			'Direcci�n de correo');
define('_MEMBERS_EMAIL_EDIT',		'(Cando se cambie a direcci�n de correo, unha nova contrasinal ser� enviada autom�ticamente a esa direcci�n)');
define('_MEMBERS_URL',				'Direcci�n da web (URL)');
define('_MEMBERS_SUPERADMIN',		'Privilexios de administrador');
define('_MEMBERS_CANLOGIN',			'O usuario pode entrar na administraci�n');
define('_MEMBERS_NOTES',			'Notas');
define('_MEMBERS_NEW_BTN',			'Introducir membro');
define('_MEMBERS_EDIT',				'Modificar membro');
define('_MEMBERS_EDIT_BTN',			'Modificalas preferencias');
define('_MEMBERS_BACKTOOVERVIEW',	'Voltar � p�xina do membro');
define('_MEMBERS_DEFLANG',			'Lingua');
define('_MEMBERS_USESITELANG',		'- usalas preferencias da web -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'Visitar web');
define('_BLOGLIST_ADD',				'Introducir entrada');
define('_BLOGLIST_TT_ADD',			'Introducir unha nova entrada nesta bit�cora');
define('_BLOGLIST_EDIT',			'Modificar/Eliminar entradas');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Bookmarklet');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'Preferencias');
define('_BLOGLIST_TT_SETTINGS',		'Modificar preferencias o xestionar equipo');
define('_BLOGLIST_BANS',			'Restricci�ns');
define('_BLOGLIST_TT_BANS',			'Ver, introducir ou eliminar IPs restrinxidas');
define('_BLOGLIST_DELETE',			'Eliminar todo');
define('_BLOGLIST_TT_DELETE',		'Eliminar esta bit�cora');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'As t�as bit�coras');
define('_OVERVIEW_YRDRAFTS',		'Os teus borradores');
define('_OVERVIEW_YRSETTINGS',		'Preferencias persoais');
define('_OVERVIEW_GSETTINGS',		'Preferencias xerais');
define('_OVERVIEW_NOBLOGS',			'O usuario non est� en ning�n equipo da bit�cora');
define('_OVERVIEW_NODRAFTS',		'Non hai borradores');
define('_OVERVIEW_EDITSETTINGS',	'Modificar preferencias personais...');
define('_OVERVIEW_BROWSEITEMS',		'Examinar entradas...');
define('_OVERVIEW_BROWSECOMM',		'Examinar comentarios...');
define('_OVERVIEW_VIEWLOG',			'Ver o rexistro de actividades...');
define('_OVERVIEW_MEMBERS',			'Xestionalos membros...');
define('_OVERVIEW_NEWLOG',			'Crear unha nova bit�cora...');
define('_OVERVIEW_SETTINGS',		'Modificar preferencias...');
define('_OVERVIEW_TEMPLATES',		'Modificar plantillas...');
define('_OVERVIEW_SKINS',			'Modificar peles...');
define('_OVERVIEW_BACKUP',			'Copia de seguridade / Restauraci�n...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'Entradas para a bit�cora'); 
define('_ITEMLIST_YOUR',			'Entradas');

// Comments
define('_COMMENTS',					'Comentarios');
define('_NOCOMMENTS',				'Entrada sen comentarios');
define('_COMMENTS_YOUR',			'Comentarios');
define('_NOCOMMENTS_YOUR',			'Non se escribiu ning�n comentario');

// LISTS (general)
define('_LISTS_NOMORE',				'Non hai resultados (adicionais)');
define('_LISTS_PREV',				'Anterior');
define('_LISTS_NEXT',				'Seguinte');
define('_LISTS_SEARCH',				'Buscar');
define('_LISTS_CHANGE',				'Modificar');
define('_LISTS_PERPAGE',			'Entradas por p�xina');
define('_LISTS_ACTIONS',			'Acci�ns');
define('_LISTS_DELETE',				'Eliminar');
define('_LISTS_EDIT',				'Modificar');
define('_LISTS_MOVE',				'Mover');
define('_LISTS_CLONE',				'Clonar');
define('_LISTS_TITLE',				'T�tulo');
define('_LISTS_BLOG',				'Bit�cora');
define('_LISTS_NAME',				'Nome');
define('_LISTS_DESC',				'Descripci�n');
define('_LISTS_TIME',				'Tempo');
define('_LISTS_COMMENTS',			'Comentarios');
define('_LISTS_TYPE',				'Tipo');


// member list 
define('_LIST_MEMBER_NAME',			'Nome mostrado');
define('_LIST_MEMBER_RNAME',		'Nome real');
define('_LIST_MEMBER_ADMIN',		'Superadministrador? ');
define('_LIST_MEMBER_LOGIN',		'Pode rexistrarse? ');
define('_LIST_MEMBER_URL',			'Web');

// banlist
define('_LIST_BAN_IPRANGE',			'Rango IP');
define('_LIST_BAN_REASON',			'Raz�n');

// actionlist
define('_LIST_ACTION_MSG',			'Mensaxe');

// commentlist
define('_LIST_COMMENT_BANIP',		'Restricci�n de IP');
define('_LIST_COMMENT_WHO',			'Autor');
define('_LIST_COMMENT',				'Comentario');
define('_LIST_COMMENT_HOST',		'Host');

// itemlist
define('_LIST_ITEM_INFO',			'Info');
define('_LIST_ITEM_CONTENT',		'T�tulo e texto');


// teamlist
define('_LIST_TEAM_ADMIN',			'Administrador ');
define('_LIST_TEAM_CHADMIN',		'Modificar administrador');

// edit comments
define('_EDITC_TITLE',				'Modificar comentarios');
define('_EDITC_WHO',				'Autor');
define('_EDITC_HOST',				'Dende onde?');
define('_EDITC_WHEN',				'Cando?');
define('_EDITC_TEXT',				'Texto');
define('_EDITC_EDIT',				'Modificar comentario');
define('_EDITC_MEMBER',				'Nembro');
define('_EDITC_NONMEMBER',			'Non membro');

// move item
define('_MOVE_TITLE',				'Mover a qu� bit�cora?');
define('_MOVE_BTN',					'Mover entrada');

?>