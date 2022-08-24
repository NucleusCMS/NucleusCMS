<?php
// Spanish Nucleus Language File
// 
// Author: Alfonso Sanchez 
// Nucleus version: v1.0-v3.2
//
// Please note: if you want to translate this file to your own language, be aware
// that in a next Nucleus version, new variables might be added and some other ones
// might be deleted. Therefor, it's important to list the Nucleus version for which 
// the file was written in your document.
//
// Fully translated language file can be sent to us and will be made
// available for download (with proper credit to the author, of course)

// START changed/added after 315 START

define('_LIST_PLUG_SUBS_NEEDUPDATE','Por favor, usa el botón de la \'lista de suscripción de actualizaciones\' para actualizar la lista de suscripciones de los plugin\'s.');
define('_LIST_PLUGS_DEP',			'Plugin(s) requires:');

// END changed/added after 3.15

// START changed/added after 3.1 START

// comments list per weblog
define('_COMMENTS_BLOG',			'Todos los comentarios para la bitácora');
define('_NOCOMMENTS_BLOG',			'No se hicieron comentarios en los elementos de esta bitácora');
define('_BLOGLIST_COMMENTS',		'Comentarios');
define('_BLOGLIST_TT_COMMENTS',		'Una lista de los comentarios hechos en los elementos de esta bitácora');


// for use in archivetype-skinvar
define('_ARCHIVETYPE_DAY',			'dia');
define('_ARCHIVETYPE_MONTH',		'mes');

// tickets (prevents malicious users to trick an admin to perform actions he doesn't want)
define('_ERROR_BADTICKET',			'Ticket inválido o caducado.');

// plugin dependency
define('_ERROR_INSREQPLUGIN',		'Fracasó la instalación del plugin, requiere ');
define('_ERROR_DELREQPLUGIN',		'Fracasó la eliminación del plugin, es requerido por ');

// cookie prefix
define('_SETTINGS_COOKIEPREFIX',	'Prefijo de la Cookie');

// account activation
define('_ERROR_NOLOGON_NOACTIVATE',	'No se puede enviar el enlace de activación. No tienes permitido el acceso.');
define('_ERROR_ACTIVATE',			'La clave de activación no existe, es inválida, o ha caducado.');
define('_ACTIONLOG_ACTIVATIONLINK', 'Enlace de activación enviado');
define('_MSG_ACTIVATION_SENT',		'Un enlace de activación ha sido enviado por correo electrónico.');

// activation link emails
define('_ACTIVATE_REGISTER_MAIL',	"Hola <%memberName%>,\n\nNecesitas activar tu cuenta en <%siteName%> (<%siteUrl%>).\nPuedes hacerlo visitando el siguiente enlace: \n\n\t<%activationUrl%>\n\nTienes 2 dias para hacerlo. Después, el enlace de activación pierde su validez.");
define('_ACTIVATE_REGISTER_MAILTITLE',	"Activa tu cuenta '<%memberName%>'");
define('_ACTIVATE_REGISTER_TITLE',	'Bienvenido <%memberName%>');
define('_ACTIVATE_REGISTER_TEXT',	'Ya casi está. Por favor, selecciona una clave para tu cuenta aquí.');
define('_ACTIVATE_FORGOT_MAIL',		"Hola <%memberName%>,\n\nUsando el enlace inferior, puedes seleccionar una nueva clave para tu cuenta en <%siteName%> (<%siteUrl%>).\n\n\t<%activationUrl%>\n\nTienes 2 dias para hacerlo. Después, el enlace de activación pierde su validez.");
define('_ACTIVATE_FORGOT_MAILTITLE',"Reactiva tu cuenta '<%memberName%>'");
define('_ACTIVATE_FORGOT_TITLE',	'Bienvenido <%memberName%>');
define('_ACTIVATE_FORGOT_TEXT',		'Puedes elegir una nueva clave para tu cuenta aquí:');
define('_ACTIVATE_CHANGE_MAIL',		"Hola <%memberName%>,\n\nPuesto que tu dirección de correo electrónico ha cambiado, necesitarás reactivar tu cuenta en <%siteName%> (<%siteUrl%>).\nPuedes hacerlo visitando el siguiente enlace: \n\n\t<%activationUrl%>\n\nTienes 2 dias para hacerlo. Después, el enlace de activación pierde su validez.");
define('_ACTIVATE_CHANGE_MAILTITLE',"Reactiva tu cuenta '<%memberName%>'");
define('_ACTIVATE_CHANGE_TITLE',	'Bienvenido <%memberName%>');
define('_ACTIVATE_CHANGE_TEXT',		'Tu cambio de dirección ha sido verificado. ¡Gracias!');
define('_ACTIVATE_SUCCESS_TITLE',	'Activation Succeeded');
define('_ACTIVATE_SUCCESS_TEXT',	'Tu cuenta ha sido activada con éxito.');
define('_MEMBERS_SETPWD',			'Introduce clave');
define('_MEMBERS_SETPWD_BTN',		'Introduce clave');
define('_QMENU_ACTIVATE',			'Activación de la cuenta');
define('_QMENU_ACTIVATE_TEXT',		'<p>Después de que hayas activado tu cuenta, puedes empezar a usarla <a href="index.php?action=showlogin">accediendo</a>.</p>');

define('_PLUGS_BTN_UPDATE',			'Lista de suscripción de actualizaciones');

// global settings 
define('_SETTINGS_JSTOOLBAR',		'Estilo de barra de herramientas Javascript');
define('_SETTINGS_JSTOOLBAR_FULL',	'Barra de herramientas completa (IE)');
define('_SETTINGS_JSTOOLBAR_SIMPLE','Barra de herramientas simple (No IE)');
define('_SETTINGS_JSTOOLBAR_NONE',	'Deshabilita la barra de herramientas');
define('_SETTINGS_URLMODE_HELP',	'(Info: <a href="documentation/tips.html#searchengines-fancyurls">Cómo activar URLs atractivas</a>)');

// extra plugin settings part when editing categories/members/blogs/...
define('_PLUGINS_EXTRA',			'Configuración Extra de Plugins');

// itemlist info column keys
define('_LIST_ITEM_BLOG',			'bitácora:');
define('_LIST_ITEM_CAT',			'cat:');
define('_LIST_ITEM_AUTHOR',			'autor:');
define('_LIST_ITEM_DATE',			'fecha:');
define('_LIST_ITEM_TIME',			'hora:');

// indication of registered members in comments list
define('_LIST_COMMENTS_MEMBER', 	'(miembro)');

// batch operations
define('_BATCH_WITH_SEL',			'con los seleccionados:');
define('_BATCH_EXEC',				'Ejecutar');

// quickmenu
define('_QMENU_HOME',				'Inicio');
define('_QMENU_ADD',				'Agregar elemento');
define('_QMENU_ADD_SELECT',			'-- seleccionar --');
define('_QMENU_USER_SETTINGS',		'Configuración');
define('_QMENU_USER_ITEMS',			'Elementos');
define('_QMENU_USER_COMMENTS',		'Comentarios');
define('_QMENU_MANAGE',				'Gestión');
define('_QMENU_MANAGE_LOG',			'Historial de acciones');
define('_QMENU_MANAGE_SETTINGS',	'Configuración global');
define('_QMENU_MANAGE_MEMBERS',		'Miembros');
define('_QMENU_MANAGE_NEWBLOG',		'Nueva bitácora');
define('_QMENU_MANAGE_BACKUPS',		'Copias de seguridad');
define('_QMENU_MANAGE_PLUGINS',		'Plugins');
define('_QMENU_LAYOUT',				'Distribución');
define('_QMENU_LAYOUT_SKINS',		'Pieles');
define('_QMENU_LAYOUT_TEMPL',		'Plantillas');
define('_QMENU_LAYOUT_IEXPORT',		'Import/Export');
define('_QMENU_PLUGINS',			'Plugins');

// quickmenu on logon screen
define('_QMENU_INTRO',				'Introducción');
define('_QMENU_INTRO_TEXT',			'<p>Esta es la pantalla de entrada de Nucleus CMS, el sistema de gestión de contenido usado para mantener este sitio.</p><p>Si tienes una cuenta, puedes acceder e introducir nuevos elementos (historias o posts).</p>');

// helppages for plugins
define('_ERROR_PLUGNOHELPFILE',		'El archivo de ayuda de este plugin no se encuentra');
define('_PLUGS_HELP_TITLE',			'Página de ayuda del plugin');
define('_LIST_PLUGS_HELP', 			'ayuda');


// END changed/started after 3.1

// START changed/added after v2.5beta START

// general settings (security)
define('_SETTINGS_EXTAUTH',			'Habilita la autenticación externa');
define('_WARNING_EXTAUTH',			'Aviso: Habilita sólo si es necesario.');

// member profile
define('_MEMBERS_BYPASS',			'Usar Autenticación Externa');

// 'always include in search' blog setting (yes/no) [in v2.5beta, the 'always' part wasn't clear]
define('_EBLOG_SEARCH',				'<em>Siempre</em> incluir en la búsqueda');

// END changed/added after v2.5beta

// START introduced after v2.0 START

// media library
define('_MEDIA_VIEW',				'ver');
define('_MEDIA_VIEW_TT',			'Ver archivo (se abre en nueva ventana)');
define('_MEDIA_FILTER_APPLY',		'Aplicar filtro');
define('_MEDIA_FILTER_LABEL',		'Filtro: ');
define('_MEDIA_UPLOAD_TO',			'Subir a...');
define('_MEDIA_UPLOAD_NEW',			'Subir nuevo archivo...');
define('_MEDIA_COLLECTION_SELECT',	'Seleccionar');
define('_MEDIA_COLLECTION_TT',		'Cambiar a esta categoría');
define('_MEDIA_COLLECTION_LABEL',	'Colección actual: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'Alinear a la izquierda');
define('_ADD_ALIGNRIGHT_TT',		'Alinear a la derecha');
define('_ADD_ALIGNCENTER_TT',		'Alinear al centro');

// searchable blog setting (yes/no)
define('_EBLOG_SEARCH',				'Incluir en búsquedas');

// generic upload failure
define('_ERROR_UPLOADFAILED',		'Error al subir');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'Permite introducir entradas en el pasado');
define('_ADD_CHANGEDATE',			'Actualizar fecha y hora');
define('_BMLET_CHANGEDATE',			'Actualizar fecha y hora');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'Importar/exportar piel...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Normal');
define('_PARSER_INCMODE_SKINDIR',	'Usar el directorio de pieles');
define('_SKIN_INCLUDE_MODE',		'Incluir modo');
define('_SKIN_INCLUDE_PREFIX',		'Incluir prefijo');

// global settings
define('_SETTINGS_BASESKIN',		'Piel base');
define('_SETTINGS_SKINSURL',		'URL de pieles');
define('_SETTINGS_ACTIONSURL',		'URL completa para action.php');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'No se puede mover la categoría por defecto');
define('_ERROR_MOVETOSELF',			'No se puede mover la categoría (la bitácora de destino es la misma que la de origen)');
define('_MOVECAT_TITLE',			'Seleccionar la bitácora a la que mover la categoría');
define('_MOVECAT_BTN',				'Mover categoría');

// URLMode setting
define('_SETTINGS_URLMODE',			'Modo URL');
define('_SETTINGS_URLMODE_NORMAL',	'Normal');
define('_SETTINGS_URLMODE_PATHINFO','Atractivo');

// Batch operations
define('_BATCH_NOSELECTION',		'Nada seleccionado sobre lo que se pueda realizar una acción');
define('_BATCH_ITEMS',				'Operación de lotes sobre elementos');
define('_BATCH_CATEGORIES',			'Operación de lotes sobre categorías');
define('_BATCH_MEMBERS',			'Operación de lotes sobre miembros');
define('_BATCH_TEAM',				'Operación de lotes sobre miembros de equipos');
define('_BATCH_COMMENTS',			'Operación de lotes sobre comentarios');
define('_BATCH_UNKNOWN',			'Operación de lotes desconocida: ');
define('_BATCH_EXECUTING',			'Ejecutando');
define('_BATCH_ONCATEGORY',			'sobre la categoría');
define('_BATCH_ONITEM',				'sobre el elemento');
define('_BATCH_ONCOMMENT',			'sobre el comentario');
define('_BATCH_ONMEMBER',			'sobre el miembro');
define('_BATCH_ONTEAM',				'sobre el miembro de equipo');
define('_BATCH_SUCCESS',			'¡Sin problemas!');
define('_BATCH_DONE',				'¡Hecho!');
define('_BATCH_DELETE_CONFIRM',		'Confirmar eliminación de lote');
define('_BATCH_DELETE_CONFIRM_BTN',	'Confirmar eliminación de lote');
define('_BATCH_SELECTALL',			'seleccionar todo');
define('_BATCH_DESELECTALL',		'deseleccionar todo');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'Eliminar');
define('_BATCH_ITEM_MOVE',			'Mover');
define('_BATCH_MEMBER_DELETE',		'Eliminar');
define('_BATCH_MEMBER_SET_ADM',		'Dar derechos de administración');
define('_BATCH_MEMBER_UNSET_ADM',	'Quitar derechos de administración');
define('_BATCH_TEAM_DELETE',		'Borrar del equipo');
define('_BATCH_TEAM_SET_ADM',		'Dar derechos de administración');
define('_BATCH_TEAM_UNSET_ADM',		'Quitar derechos de administración');
define('_BATCH_CAT_DELETE',			'Eliminar');
define('_BATCH_CAT_MOVE',			'Mover a otra bitácora');
define('_BATCH_COMMENT_DELETE',		'Eliminar');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'Introducir nuevo elemento...');
define('_ADD_PLUGIN_EXTRAS',		'Opciones extra de plugin');

// errors
define('_ERROR_CATCREATEFAIL',		'No se puede crear una nueva categoría');
define('_ERROR_NUCLEUSVERSIONREQ',	'Este plugin necesita una versión más reciente de Nucleus: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Volver a preferencias de bitácora');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Importar');
define('_SKINIE_TITLE_EXPORT',		'Exportar');
define('_SKINIE_BTN_IMPORT',		'Importar');
define('_SKINIE_BTN_EXPORT',		'Exportar pieles/plantillas seleccionadas');
define('_SKINIE_LOCAL',				'Importar desde un archivo local:');
define('_SKINIE_NOCANDIDATES',		'No se han encontrado candidatos para importar en el directorio de pieles');
define('_SKINIE_FROMURL',			'Importar desde URL:');
define('_SKINIE_EXPORT_INTRO',		'Seleccionar abajo las pieles y plantillas a exportar');
define('_SKINIE_EXPORT_SKINS',		'Pieles');
define('_SKINIE_EXPORT_TEMPLATES',	'Plantillas');
define('_SKINIE_EXPORT_EXTRA',		'Información Extra');
define('_SKINIE_CONFIRM_OVERWRITE',	'Sobreescribe pieles que ya existan (ver conflictos de nombre)');
define('_SKINIE_CONFIRM_IMPORT',	'Sí, quiero importar ésto');
define('_SKINIE_CONFIRM_TITLE',		'Sobre importar pieles y plantillas');
define('_SKINIE_INFO_SKINS',		'Pieles en archivo:');
define('_SKINIE_INFO_TEMPLATES',	'Plantillas en archivo:');
define('_SKINIE_INFO_GENERAL',		'Información:');
define('_SKINIE_INFO_SKINCLASH',	'Nombre de piel conflictivo:');
define('_SKINIE_INFO_TEMPLCLASH',	'Nombre de plantilla conflictivo:');
define('_SKINIE_INFO_IMPORTEDSKINS','Pieles importadas:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Plantillas importadas:');
define('_SKINIE_DONE',				'Importación realizada');

define('_AND',						'y');
define('_OR',						'o');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'campo vacío (hacer clic para editar)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'Incluye modo:');
define('_LIST_SKINS_INCPREFIX',		'Incluye prefijo:');
define('_LIST_SKINS_DEFINED',		'Partes definidas:');

// backup
define('_BACKUPS_TITLE',			'Almacenar / Restaurar');
define('_BACKUP_TITLE',				'Almacenar');
define('_BACKUP_INTRO',				'Hacer clic sobre el siguiente botón para crear una copia de seguridad de la base de datos de Nucleus. Se pedirá que guarde un archivo de seguridad. Guárdelo en lugar seguro.');
define('_BACKUP_ZIP_YES',			'Intente usar la compresión');
define('_BACKUP_ZIP_NO',			'No use compresión');
define('_BACKUP_BTN',				'Crear copia de seguridad');
define('_BACKUP_NOTE',				'<b>Nota:</b> Sólo los contenidos de la base de datos se guardan en la copia de seguridad. Archivos de medios, imágenes y preferencias de config.php <b>NO</b> se incluyen en la copia de seguridad.');
define('_RESTORE_TITLE',			'Restaurar');
define('_RESTORE_NOTE',				'<b>AVISO:</b> Restaurar desde una copia de seguridad <b>BORRARÁ</b> todos los datos de Nucleus actuales! ¡Hacer ésto sólo se esté totalmente seguro!	<br />	<b>Nota:</b> Comprobar que la versión de Nucleus en la que se creó la copia es la misma que la versión que se está usando ahora! No funcionará si no es así');
define('_RESTORE_INTRO',			'Seleccionar el archivo de copia de seguridad (será enviado al servidor) y haga clic sobre el botón "Restaurar" para empezar.');
define('_RESTORE_IMSURE',			'¡Sí, estoy seguro de que quiero hacer eso!');
define('_RESTORE_BTN',				'Restaurar desde archivo');
define('_RESTORE_WARNING',			'(asegurarse de estar restaurando la copia de seguridad correcta, quizá sea mejor hacer una copia de seguridad antes de empezar)');
define('_ERROR_BACKUP_NOTSURE',		'Necesitará marcar la casilla \'Estoy seguro\'');
define('_RESTORE_COMPLETE',			'Restauración completada');

// new item notification
define('_NOTIFY_NI_MSG',			'Un nuevo elemento ha sido insertado:');
define('_NOTIFY_NI_TITLE',			'Nuevo elemento!');
define('_NOTIFY_KV_MSG',			'Voto Karma del elemento:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'Comentario sobre el elemento:');
define('_NOTIFY_NC_TITLE',			'Comentario de Nucleus:');
define('_NOTIFY_USERID',			'ID de usuario:');
define('_NOTIFY_USER',				'Usuario:');
define('_NOTIFY_COMMENT',			'Comentario:');
define('_NOTIFY_VOTE',				'Voto:');
define('_NOTIFY_HOST',				'Host:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'Miembro:');
define('_NOTIFY_TITLE',				'Título:');
define('_NOTIFY_CONTENTS',			'Contenido:');

// member mail message
define('_MMAIL_MSG',				'Un mensaje enviado por');
define('_MMAIL_FROMANON',			'un visitante anónimo');
define('_MMAIL_FROMNUC',			'Insertado desde una bitácora de Nucleus en');
define('_MMAIL_TITLE',				'Un mensaje de');
define('_MMAIL_MAIL',				'Mensaje:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'Introducir entrada');
define('_BMLET_EDIT',				'Editar entrada');
define('_BMLET_DELETE',				'Eliminar entrada');
define('_BMLET_BODY',				'Cuerpo');
define('_BMLET_MORE',				'Más');
define('_BMLET_OPTIONS',			'Opciones');
define('_BMLET_PREVIEW',			'Previsualizar');

// used in bookmarklet
define('_ITEM_UPDATED',				'La entrada ha sido actualizada');
define('_ITEM_DELETED',				'La entrada ha sido eliminada');

// plugins
define('_CONFIRMTXT_PLUGIN',		'Seguro que se desea eliminar el plugin llamado');
define('_ERROR_NOSUCHPLUGIN',		'No existe ese plugin');
define('_ERROR_DUPPLUGIN',			'Ese plugin ya ha sido instalado');
define('_ERROR_PLUGFILEERROR',		'No existe ese plugin, o los permisos no son los correctos');
define('_PLUGS_NOCANDIDATES',		'No se han encontrado candidatos para el plugin');

define('_PLUGS_TITLE_MANAGE',		'Gestionar plugins');
define('_PLUGS_TITLE_INSTALLED',	'Actualmente instalado');
define('_PLUGS_TITLE_UPDATE',		'Actualizar la lista de suscripción');
define('_PLUGS_TEXT_UPDATE',		'Nucleus mantiene una caché de las suscripciones a eventos de los plugins. Cuando se actualiza un plugin sustituyendo su archivo, se debe ejecutar esta actualización para asegurar que las suscripciones de la caché son correctas');
define('_PLUGS_TITLE_NEW',			'Instalar un nuevo plugin');
define('_PLUGS_ADD_TEXT',			'A continuación hay una lista de todos los archivos de tu directorio de plugins, algunos podrían ser plugins sin instalación. Asegúrate de estar <strong>totalmente seguro</strong> de que se trata de un plugin antes de introducirlo.');
define('_PLUGS_BTN_INSTALL',		'Instalar plugin');
define('_BACKTOOVERVIEW',			'Volver a principal');

// editlink
define('_TEMPLATE_EDITLINK',		'Editar el enlace de la entrada');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'Insertar cuadro a la izquierda');
define('_ADD_RIGHT_TT',				'Insertar cuadro a la derecha');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'Nueva categoría');

// new settings
define('_SETTINGS_PLUGINURL',		'URL del plugin');
define('_SETTINGS_MAXUPLOADSIZE',	'Max. tamaño de archivo para subida (bytes)');
define('_SETTINGS_NONMEMBERMSGS',	'Permitir a los no miembros que envien mensajes');
define('_SETTINGS_PROTECTMEMNAMES',	'Proteger los nombres de los miembros');

// overview screen
define('_OVERVIEW_PLUGINS',			'Gestionar plugins...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'Registro de un nuevo miembro:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'Tu email:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'Sin permiso de administración sobre ninguna de las bitácoras que tiene el miembro de destino del equipo. Por tanto, no es posible subir archivos al directorio de medios de este miembro');

// plugin list
define('_LISTS_INFO',				'Información');
define('_LIST_PLUGS_AUTHOR',		'Por:');
define('_LIST_PLUGS_VER',			'Versión:');
define('_LIST_PLUGS_SITE',			'Visitar sitio');
define('_LIST_PLUGS_DESC',			'Descripción:');
define('_LIST_PLUGS_SUBS',			'Suscribir a los siguientes eventos:');
define('_LIST_PLUGS_UP',			'desplazar arriba');
define('_LIST_PLUGS_DOWN',			'desplazar abajo');
define('_LIST_PLUGS_UNINSTALL',		'desinstalar');
define('_LIST_PLUGS_ADMIN',			'admin');
define('_LIST_PLUGS_OPTIONS',		'editar&nbsp;opciones');

// plugin option list
define('_LISTS_VALUE',				'Valor');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'este plugin no tiene establecida ninguna opción');
define('_PLUGS_BACK',				'Volver a la lista de plugins');
define('_PLUGS_SAVE',				'Guardar opciones');
define('_PLUGS_OPTIONS_UPDATED',	'Opciones de plugin actualizadas');

define('_OVERVIEW_MANAGEMENT',		'Gestión');
define('_OVERVIEW_MANAGE',			'Gestión de Nucleus...');
define('_MANAGE_GENERAL',			'Gestión general');
define('_MANAGE_SKINS',				'"Skins" y plantillas');
define('_MANAGE_EXTRA',				'Características extra');

define('_BACKTOMANAGE',				'Volver a la gestión de Nucleus');


// END introduced after v1.1 END




// charset to use 
define('_CHARSET',					'iso-8859-1');

// global stuff
define('_LOGOUT',					'Salir');
define('_LOGIN',					'Entrar');
define('_YES',						'Sí');
define('_NO',						'No');
define('_SUBMIT',					'Enviar');
define('_ERROR',					'Error');
define('_ERRORMSG',					'Ha sucedido un error!');
define('_BACK',						'Volver');
define('_NOTLOGGEDIN',				'No registrado');
define('_LOGGEDINAS',				'Registrado como');
define('_ADMINHOME',				'Administración');
define('_NAME',						'Nombre');
define('_BACKHOME',					'Volver a la administración');
define('_BADACTION',				'No existe la acción requerida');
define('_MESSAGE',					'Mensaje');
define('_HELP_TT',					'Ayuda!');
define('_YOURSITE',					'Ver web');


define('_POPUP_CLOSE',				'Cerrar ventana');

define('_LOGIN_PLEASE',				'Es necesario regístrarse primero');

// commentform
define('_COMMENTFORM_YOUARE',		'Eres');
define('_COMMENTFORM_SUBMIT',		'Introducir comentario');
define('_COMMENTFORM_COMMENT',		'Comentario');
define('_COMMENTFORM_NAME',			'Nombre');
define('_COMMENTFORM_MAIL',			'Email/HTTP');
define('_COMMENTFORM_REMEMBER',		'Recordar usuario');

// loginform
define('_LOGINFORM_NAME',			'Usuario');
define('_LOGINFORM_PWD',			'Clave');
define('_LOGINFORM_YOUARE',			'Registrado como');
define('_LOGINFORM_SHARED',			'Ordenador compartido');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'Enviar mensaje');

// search form
define('_SEARCHFORM_SUBMIT',		'Buscar');

// add item form
define('_ADD_ADDTO',				'Introducir nueva entrada a');
define('_ADD_CREATENEW',			'Crear nueva entrada');
define('_ADD_BODY',					'Cuerpo');
define('_ADD_TITLE',				'Título');
define('_ADD_MORE',					'Extensión (opcional)');
define('_ADD_CATEGORY',				'Categoría');
define('_ADD_PREVIEW',				'Previsualizar');
define('_ADD_DISABLE_COMMENTS',		'Deshabilitar comentarios?');
define('_ADD_DRAFTNFUTURE',			'Borrador y futuras entradas');
define('_ADD_ADDITEM',				'Introducir entrada');
define('_ADD_ADDNOW',				'Introducir ahora');
define('_ADD_ADDLATER',				'Introducir luego');
define('_ADD_PLACE_ON',				'Colocar en');
define('_ADD_ADDDRAFT',				'Introducir en el borrador');
define('_ADD_NOPASTDATES',			'(las fechas y horas pasadas no son válidas, se usará el momento actual)');
define('_ADD_BOLD_TT',				'Negrita');
define('_ADD_ITALIC_TT',			'Itálica');
define('_ADD_HREF_TT',				'Crear enlace');
define('_ADD_MEDIA_TT',				'Introducir imagen o multimedia');
define('_ADD_PREVIEW_TT',			'Mostrar/ocultar previsualización');
define('_ADD_CUT_TT',				'Cortar');
define('_ADD_COPY_TT',				'Copiar');
define('_ADD_PASTE_TT',				'Pegar');


// edit item form
define('_EDIT_ITEM',				'Editar entrada');
define('_EDIT_SUBMIT',				'Editar entrada');
define('_EDIT_ORIG_AUTHOR',			'Autor original');
define('_EDIT_BACKTODRAFTS',		'Enviar al borrador');
define('_EDIT_COMMENTSNOTE',		'(nota: deshabilitar los comentarios no ocultará los existentes)');

// used on delete screens
define('_DELETE_CONFIRM',			'Confirmar la eliminación');
define('_DELETE_CONFIRM_BTN',		'Confirmar la eliminación');
define('_CONFIRMTXT_ITEM',			'A punto de eliminar la siguiente entrada:');
define('_CONFIRMTXT_COMMENT',		'A punto de eliminar el siguiente comentario:');
define('_CONFIRMTXT_TEAM1',			'A punto de eliminar ');
define('_CONFIRMTXT_TEAM2',			' del equipo para la bitácora ');
define('_CONFIRMTXT_BLOG',			'La bitácora a eliminar es: ');
define('_WARNINGTXT_BLOGDEL',		'Cuidado! Eliminar una bitácora eliminará TODAS sus entradas y comentarios. Confirmar definitivamente la eliminación!<br />No interrumpir el sistema durante la eliminación.');
define('_CONFIRMTXT_MEMBER',		'A punto de eliminar al siguiente miembro: ');
define('_CONFIRMTXT_TEMPLATE',		'A punto de eliminar la plantilla llamada ');
define('_CONFIRMTXT_SKIN',			'A punto de eliminar la piel llamada ');
define('_CONFIRMTXT_BAN',			'A punto de eliminar la restricción para el rango IP');
define('_CONFIRMTXT_CATEGORY',		'A punto de eliminar la categoría ');

// some status messages
define('_DELETED_ITEM',				'Entrada eliminada');
define('_DELETED_MEMBER',			'Miembro eliminado');
define('_DELETED_COMMENT',			'Comentario eliminado');
define('_DELETED_BLOG',				'Bitácora eliminada');
define('_DELETED_CATEGORY',			'Categoría eliminada');
define('_ITEM_MOVED',				'Entrada movida');
define('_ITEM_ADDED',				'Entrada introducida');
define('_COMMENT_UPDATED',			'Comentario actualizado');
define('_SKIN_UPDATED',				'Datos de la piel actualizados');
define('_TEMPLATE_UPDATED',			'Datos de la plantilla guardados');

// errors
define('_ERROR_COMMENT_LONGWORD',	'No usar palabras de longitud mayor a 90 carácteres en los comentarios');
define('_ERROR_COMMENT_NOCOMMENT',	'Introducir el comentario');
define('_ERROR_COMMENT_NOUSERNAME',	'Usuario incorrecto');
define('_ERROR_COMMENT_TOOLONG',	'Comentario  demasiado largo (máximo : 5000 carácteres)');
define('_ERROR_COMMENTS_DISABLED',	'Comentarios deshabilitados para esta bitácora.');
define('_ERROR_COMMENTS_NONPUBLIC',	'Registrarse primero como miembro para introducir comentarios a esta bitácora');
define('_ERROR_COMMENTS_MEMBERNICK','El nombre indicado para introducir comentarios está siendo usado por otro miembro. Probar con otro distinto.');
define('_ERROR_SKIN',				'Error de piel');
define('_ERROR_ITEMCLOSED',			'Esta entrada ha sido cerrada, no es posible introducir nuevos comentarios o votar');
define('_ERROR_NOSUCHITEM',			'La entrada indicada no existe');
define('_ERROR_NOSUCHBLOG',			'La bitácora indicada no existe');
define('_ERROR_NOSUCHSKIN',			'La piel indicada no existe');
define('_ERROR_NOSUCHMEMBER',		'El miembro indicado no existe');
define('_ERROR_NOTONTEAM',			'El usuario no pertenece al equipo de esta bitácora.');
define('_ERROR_BADDESTBLOG',		'La bitácora de destino no existe');
define('_ERROR_NOTONDESTTEAM',		'No es posible mover la entrada, ya que el usuario no pertenece al equipo de la bitácora de destino');
define('_ERROR_NOEMPTYITEMS',		'No es posible introducir entradas vacias!');
define('_ERROR_BADMAILADDRESS',		'Dirección de correo incorrecta');
define('_ERROR_BADNOTIFY',			'Una o más de las direcciones de notificación no son direcciones correctas');
define('_ERROR_BADNAME',			'El nombre no es válido (sólo a-z y 0-9 permitidos, sin espacios al principio ni al final)');
define('_ERROR_NICKNAMEINUSE',		'Otro miembro está usando ya ese nombre');
define('_ERROR_PASSWORDMISMATCH',	'Las claves deben coincidir');
define('_ERROR_PASSWORDTOOSHORT',	'La clave debe tener al menos 6 carácteres');
define('_ERROR_PASSWORDMISSING',	'La clave no puede estar vacia');
define('_ERROR_REALNAMEMISSING',	'El nombre real introducido no es válido');
define('_ERROR_ATLEASTONEADMIN',	'Debe existir siempre al menos un superadministrador que pueda registrarse en la zona de administración.');
define('_ERROR_ATLEASTONEBLOGADMIN','Ejecutar esta acción dejaría la bitácora inmantenible. Debe existir siempre al menos un administrador.');
define('_ERROR_ALREADYONTEAM',		'No es posible introducir un miembro que ya pertenezca al equipo');
define('_ERROR_BADSHORTBLOGNAME',	'El nombre corto de la bitácora sólo debe contener a-z y 0-9, y sin espacios');
define('_ERROR_DUPSHORTBLOGNAME',	'Otra bitácora ya tiene ese nombre corto. Los nombres cortos deben ser únicos');
define('_ERROR_UPDATEFILE',			'Sin permiso de escritura para actualizar el archivo. Los permisos deben ser correctos (probar chmod 666). La localización debe ser relativa al directorio de administración, por lo que quizás convendría usar un camino absoluto (como /camino/hasta/nucleus/)');
define('_ERROR_DELDEFBLOG',			'No es posible eliminar la bitácora principal');
define('_ERROR_DELETEMEMBER',		'Este miembro no puede ser eliminado, probablemente porque es el autor de entradas o comentarios');
define('_ERROR_BADTEMPLATENAME',	'Nombre incorrecto para la plantilla, usar sólo a-z y 0-9, y sin espacios');
define('_ERROR_DUPTEMPLATENAME',	'Ya existe otra plantilla con ese nombre');
define('_ERROR_BADSKINNAME',		'Nombre incorrecto para la piel (sólo a-z, 0-9 están permitidos, y sin espacios)');
define('_ERROR_DUPSKINNAME',		'Ya existe otra piel con ese nombre');
define('_ERROR_DEFAULTSKIN',		'Siempre debe existir una piel llamada "default"');
define('_ERROR_SKINDEFDELETE',		'No es posible eliminar la piel ya que es la piel predeterminada para la siguiente bitácora: ');
define('_ERROR_DISALLOWED',			'Sin suficiente permiso para ejecutar esa acción');
define('_ERROR_DELETEBAN',			'Error al eliminar la restricción (la restricción no existe)');
define('_ERROR_ADDBAN',				'Error al introducir restricción. La restricción podría no haberse introducido correctamente en las bitácoras.');
define('_ERROR_BADACTION',			'La acción indicada no existe');
define('_ERROR_MEMBERMAILDISABLED',	'Los mensajes de miembro a miembro están deshabilitados');
define('_ERROR_MEMBERCREATEDISABLED','La creación de cuentas para miembros está deshabilitada');
define('_ERROR_INCORRECTEMAIL',		'Dirección de correo incorrecta');
define('_ERROR_VOTEDBEFORE',		'El voto del usuario para esta entrada ya existe');
define('_ERROR_BANNED1',			'No es posible ejecutar la acción ya que el (rango IP ');
define('_ERROR_BANNED2',			') está restringido. El mensaje era: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'El usuario debe estar registrado para hacer eso');
define('_ERROR_CONNECT',			'Error de conexión');
define('_ERROR_FILE_TOO_BIG',		'El archivo es demasiado grande!');
define('_ERROR_BADFILETYPE',		'Tipo de archivo no permitido');
define('_ERROR_BADREQUEST',			'Error en el envío del archivo');
define('_ERROR_DISALLOWEDUPLOAD',	'El usuario no pertenece al equipo de ninguna bitácora. No es posible enviar archivos');
define('_ERROR_BADPERMISSIONS',		'Los permisos no son correctos');
define('_ERROR_UPLOADMOVEP',		'Error al mover el archivo enviado');
define('_ERROR_UPLOADCOPY',			'Error al copiar el archivo enviado');
define('_ERROR_UPLOADDUPLICATE',	'Ya existe otro archivo con ese nombre. Intentar renombrarlo antes de enviarlo.');
define('_ERROR_LOGINDISALLOWED',	'Sin permiso para entrar en la administración. Es posible registrarse como otro usuario');
define('_ERROR_DBCONNECT',			'No es posible conectar con MySQL server');
define('_ERROR_DBSELECT',			'No es posible seleccionar la base de datos de Nucleus.');
define('_ERROR_NOSUCHLANGUAGE',		'No existe el archivo para el idioma');
define('_ERROR_NOSUCHCATEGORY',		'No existe la categoría');
define('_ERROR_DELETELASTCATEGORY',	'Debe haber al menos una categoría');
define('_ERROR_DELETEDEFCATEGORY',	'No es posible eliminar la categoría principal');
define('_ERROR_BADCATEGORYNAME',	'Nombre de categoría incorrecto');
define('_ERROR_DUPCATEGORYNAME',	'Ya existe otra categoría con ese nombre');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'Cuidado: El valor actual no es un directorio!');
define('_WARNING_NOTREADABLE',		'Cuidado: El valor actual es un directorio sin permiso de lectura!');
define('_WARNING_NOTWRITABLE',		'Cuidado: El valor actual NO es un directorio con permiso de escritura!');

// media and upload
define('_MEDIA_UPLOADLINK',			'Enviar un nuevo archivo');
define('_MEDIA_MODIFIED',			'modificado');
define('_MEDIA_FILENAME',			'nombre de archivo');
define('_MEDIA_DIMENSIONS',			'dimensiones');
define('_MEDIA_INLINE',				'Conectado');
define('_MEDIA_POPUP',				'Ventana popup');
define('_UPLOAD_TITLE',				'Seleccionar archivo');
define('_UPLOAD_MSG',				'Seleccionar el archivo a enviar, y pulsar el botón \'Enviar\'.');
define('_UPLOAD_BUTTON',			'Enviar');

// some status messages
define('_MSG_ACCOUNTCREATED',		'Cuenta creada, la clave será enviada por correo');
define('_MSG_PASSWORDSENT',			'La clave ha sido enviada por correo.');
define('_MSG_LOGINAGAIN',			'Es necesario registrarse de nuevo ya que los datos del usuario han sido modificados');
define('_MSG_SETTINGSCHANGED',		'Preferencias modificadas');
define('_MSG_ADMINCHANGED',			'Administrador modificado');
define('_MSG_NEWBLOG',				'Nueva bitácora creada');
define('_MSG_ACTIONLOGCLEARED',		'Registro de actividades vaciado');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'Acción no permitida: ');
define('_ACTIONLOG_PWDREMINDERSENT','Nueva clave enviada a ');
define('_ACTIONLOG_TITLE',			'Registro de actividades');
define('_ACTIONLOG_CLEAR_TITLE',	'Limpiar el registro de actividades');
define('_ACTIONLOG_CLEAR_TEXT',		'Limpiar el registro de actividades ahora');

// team management
define('_TEAM_TITLE',				'Modificar el equipo de la bitácora ');
define('_TEAM_CURRENT',				'Equipo actual');
define('_TEAM_ADDNEW',				'Introducir un nuevo miembro en el equipo');
define('_TEAM_CHOOSEMEMBER',		'Seleccionar miembro');
define('_TEAM_ADMIN',				'Privilegios de administración? ');
define('_TEAM_ADD',					'Introducir en el equipo');
define('_TEAM_ADD_BTN',				'Introducir en el equipo');

// blogsettings
define('_EBLOG_TITLE',				'Modificar las preferencias de la bitácora');
define('_EBLOG_TEAM_TITLE',			'Modificar el equipo');
define('_EBLOG_TEAM_TEXT',			'Pulsa aquí para modificar el equipo.');
define('_EBLOG_SETTINGS_TITLE',		'Preferencias de la bitácora');
define('_EBLOG_NAME',				'Nombre de la bitácora');
define('_EBLOG_SHORTNAME',			'Nombre corto de la bitácora');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(debe contener sólo letras y sin espacios)');
define('_EBLOG_DESC',				'Descripción de la bitácora');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'Piel por defecto');
define('_EBLOG_DEFCAT',				'Categoría por defecto');
define('_EBLOG_LINEBREAKS',			'Convertir saltos de línea');
define('_EBLOG_DISABLECOMMENTS',	'Habilitar comentarios?<br /><small>(Deshabilitar los comentarios implica no poder introducir nuevos.)</small>');
define('_EBLOG_ANONYMOUS',			'Se permite la introducción de comentarios por no miembros?');
define('_EBLOG_NOTIFY',				'Dirección(es) de notificación (usa ; como separador)');
define('_EBLOG_NOTIFY_ON',			'Notificar');
define('_EBLOG_NOTIFY_COMMENT',		'Nuevos comentarios');
define('_EBLOG_NOTIFY_KARMA',		'Nuevos votos');
define('_EBLOG_NOTIFY_ITEM',		'Nuevas entradas');
define('_EBLOG_PING',				'Ping Weblogs.com al actualizar?');
define('_EBLOG_MAXCOMMENTS',		'Máxima cantidad de comentarios');
define('_EBLOG_UPDATE',				'Actualizar archivo');
define('_EBLOG_OFFSET',				'Zona horaria');
define('_EBLOG_STIME',				'La hora actual del servidor es');
define('_EBLOG_BTIME',				'La hora actual de la bitácora es');
define('_EBLOG_CHANGE',				'Modificar las preferencias');
define('_EBLOG_CHANGE_BTN',			'Modificar preferencias');
define('_EBLOG_ADMIN',				'Administración de la bitácora');
define('_EBLOG_ADMIN_MSG',			'Se asignarán privilegios de administrador al usuario');
define('_EBLOG_CREATE_TITLE',		'Crear nueva bitácora');
define('_EBLOG_CREATE_TEXT',		'Rellenar el siguiente formulario para crear una nueva bitácora. <br /><br /> <b>Nota:</b> Sólo las opciones necesarios están listadas. Para opciones extra, entrar en la página de preferencias de la bitácora después de crearla.');
define('_EBLOG_CREATE',				'Crear!');
define('_EBLOG_CREATE_BTN',			'Crear bitácora');
define('_EBLOG_CAT_TITLE',			'Categorías');
define('_EBLOG_CAT_NAME',			'Nombre de la categoría');
define('_EBLOG_CAT_DESC',			'Descripción de la categoría');
define('_EBLOG_CAT_CREATE',			'Crear nueva categoría');
define('_EBLOG_CAT_UPDATE',			'Actualizar categoría');
define('_EBLOG_CAT_UPDATE_BTN',		'Actualizar categoría');

// templates
define('_TEMPLATE_TITLE',			'Modificar plantillas');
define('_TEMPLATE_AVAILABLE_TITLE',	'Plantillas disponibles');
define('_TEMPLATE_NEW_TITLE',		'Nueva plantilla');
define('_TEMPLATE_NAME',			'Nombre de plantilla');
define('_TEMPLATE_DESC',			'Descripción de la plantilla');
define('_TEMPLATE_CREATE',			'Crear plantilla');
define('_TEMPLATE_CREATE_BTN',		'Crear plantilla');
define('_TEMPLATE_EDIT_TITLE',		'Editar plantilla');
define('_TEMPLATE_BACK',			'Volver a la página de la plantilla');
define('_TEMPLATE_EDIT_MSG',		'No todas las partes de la plantilla son necesarias, es posible dejar en blanco las innecesarias.');
define('_TEMPLATE_SETTINGS',		'Preferencias de las plantillas');
define('_TEMPLATE_ITEMS',			'Entradas');
define('_TEMPLATE_ITEMHEADER',		'Cabecera de entrada');
define('_TEMPLATE_ITEMBODY',		'Cuerpo de la entrada');
define('_TEMPLATE_ITEMFOOTER',		'Pie de la entrada');
define('_TEMPLATE_MORELINK',		'Enlazar a extensión de la entrada');
define('_TEMPLATE_NEW',				'Indicación de nueva entrada');
define('_TEMPLATE_COMMENTS_ANY',	'Comentarios (si los hay)');
define('_TEMPLATE_CHEADER',			'Cabecera de los comentarios');
define('_TEMPLATE_CBODY',			'Cuerpo de los comentarios');
define('_TEMPLATE_CFOOTER',			'Pie de los comentarios');
define('_TEMPLATE_CONE',			'Un comentario');
define('_TEMPLATE_CMANY',			'Dos (o más) comentarios');
define('_TEMPLATE_CMORE',			'Comentarios Leer más');
define('_TEMPLATE_CMEXTRA',			'Miembro Extra');
define('_TEMPLATE_COMMENTS_NONE',	'Comentarios (si no hay)');
define('_TEMPLATE_CNONE',			'Sin comentarios');
define('_TEMPLATE_COMMENTS_TOOMUCH','Comentarios (si los hay, pero son demasiados para mostrar directamente)');
define('_TEMPLATE_CTOOMUCH',		'Demasiados comentarios');
define('_TEMPLATE_ARCHIVELIST',		'Listas de archivos');
define('_TEMPLATE_AHEADER',			'Cabecera de la lista de archivos');
define('_TEMPLATE_AITEM',			'Elemento de la lista de archivos');
define('_TEMPLATE_AFOOTER',			'Pie de la lista de archivos');
define('_TEMPLATE_DATETIME',		'Fecha y hora');
define('_TEMPLATE_DHEADER',			'Cabecera de la fecha');
define('_TEMPLATE_DFOOTER',			'Pie de la fecha');
define('_TEMPLATE_DFORMAT',			'Formato de la fecha');
define('_TEMPLATE_TFORMAT',			'Formato de hora');
define('_TEMPLATE_LOCALE',			'Local');
define('_TEMPLATE_IMAGE',			'Ventanas de imagen');
define('_TEMPLATE_PCODE',			'Código de enlace popup');
define('_TEMPLATE_ICODE',			'Código de imagen insertada');
define('_TEMPLATE_MCODE',			'Código de enlace a imagen o multimedia');
define('_TEMPLATE_SEARCH',			'Buscar');
define('_TEMPLATE_SHIGHLIGHT',		'Resaltar');
define('_TEMPLATE_SNOTFOUND',		'Nada encontrado en la búsqueda');
define('_TEMPLATE_UPDATE',			'Actualizar');
define('_TEMPLATE_UPDATE_BTN',		'Actualizar plantilla');
define('_TEMPLATE_RESET_BTN',		'Inicializar datos');
define('_TEMPLATE_CATEGORYLIST',	'Lista de categorías');
define('_TEMPLATE_CATHEADER',		'Cabecera de lista de categorías');
define('_TEMPLATE_CATITEM',			'Elemento de lista de categorías');
define('_TEMPLATE_CATFOOTER',		'Pie de lista de categorías');

// skins
define('_SKIN_EDIT_TITLE',			'Modificar pieles');
define('_SKIN_AVAILABLE_TITLE',		'Pieles disponibles');
define('_SKIN_NEW_TITLE',			'Nueva piel');
define('_SKIN_NAME',				'Nombre');
define('_SKIN_DESC',				'Descripción');
define('_SKIN_TYPE',				'Tipo de contenido');
define('_SKIN_CREATE',				'Crear');
define('_SKIN_CREATE_BTN',			'Crear piel');
define('_SKIN_EDITONE_TITLE',		'Modificar piel');
define('_SKIN_BACK',				'Volver a la página de la piel');
define('_SKIN_PARTS_TITLE',			'Partes de la piel');
define('_SKIN_PARTS_MSG',			'No todos los tipos son necesarios para cada piel. Dejar en blanco los innecesarios. Selecciona el tipo de piel a modificar:');
define('_SKIN_PART_MAIN',			'Índice principal');
define('_SKIN_PART_ITEM',			'Páginas del elemento');
define('_SKIN_PART_ALIST',			'Lista de archivo');
define('_SKIN_PART_ARCHIVE',		'Archivo');
define('_SKIN_PART_SEARCH',			'Buscar');
define('_SKIN_PART_ERROR',			'Errores');
define('_SKIN_PART_MEMBER',			'Detalles del miembro');
define('_SKIN_PART_POPUP',			'Imágenes de popup');
define('_SKIN_GENSETTINGS_TITLE',	'Preferencias generales');
define('_SKIN_CHANGE',				'Modificar');
define('_SKIN_CHANGE_BTN',			'Modificar estas preferencias');
define('_SKIN_UPDATE_BTN',			'Actualizar piel');
define('_SKIN_RESET_BTN',			'Inicializar datos');
define('_SKIN_EDITPART_TITLE',		'Modificar piel');
define('_SKIN_GOBACK',				'Volver');
define('_SKIN_ALLOWEDVARS',			'Variables permitidas (hacer clic para mayor información):');

// global settings
define('_SETTINGS_TITLE',			'Preferencias generales');
define('_SETTINGS_SUB_GENERAL',		'Preferencias generales');
define('_SETTINGS_DEFBLOG',			'Bitácora principal');
define('_SETTINGS_ADMINMAIL',		'Administrador de correo');
define('_SETTINGS_SITENAME',		'Nombre de la web');
define('_SETTINGS_SITEURL',			'URL de la web ( debe terminar con una barra / )');
define('_SETTINGS_ADMINURL',		'URL de la administración ( debe terminar con una barra / )');
define('_SETTINGS_DIRS',			'Directorios de Nucleus');
define('_SETTINGS_MEDIADIR',		'Directorios de imagenes y multimedia');
define('_SETTINGS_SEECONFIGPHP',	'(ver config.php)');
define('_SETTINGS_MEDIAURL',		'URL para imágenes o multimedia ( debe terminar con una barra / )');
define('_SETTINGS_ALLOWUPLOAD',		'Permitir el envío de archivos?');
define('_SETTINGS_ALLOWUPLOADTYPES','Tipos de archivo permitidos para envío');
define('_SETTINGS_CHANGELOGIN',		'Permitir a los miembros modificar sus datos de registro / clave');
define('_SETTINGS_COOKIES_TITLE',	'Preferencias de cookies');
define('_SETTINGS_COOKIELIFE',		'Tiempo de vida de la cookie de registro');
define('_SETTINGS_COOKIESESSION',	'Cookies de sesión');
define('_SETTINGS_COOKIEMONTH',		'Tiempo de vida de un mes');
define('_SETTINGS_COOKIEPATH',		'Camino de las cookies (avanzado)');
define('_SETTINGS_COOKIEDOMAIN',	'Dominio de las cookies (avanzado)');
define('_SETTINGS_COOKIESECURE',	'Cookies seguras (avanzado)');
define('_SETTINGS_LASTVISIT',		'Guardar las cookies de la última visita');
define('_SETTINGS_ALLOWCREATE',		'Permitir a los visitantes crear una cuenta de miembro');
define('_SETTINGS_NEWLOGIN',		'Registro permitido para las cuentas creadas por el usuario');
define('_SETTINGS_NEWLOGIN2',		'(sólo para cuentas nuevas)');
define('_SETTINGS_MEMBERMSGS',		'Permite un servicio de miembro a miembro');
define('_SETTINGS_LANGUAGE',		'Idioma por defecto');
define('_SETTINGS_DISABLESITE',		'Deshabilitar web');
define('_SETTINGS_DBLOGIN',			'MySQL Registro y base de datos');
define('_SETTINGS_UPDATE',			'Actualizar preferencias');
define('_SETTINGS_UPDATE_BTN',		'Actualizar preferencias');
define('_SETTINGS_DISABLEJS',		'Deshabilitar la barra de herramientas de JavaScript');
define('_SETTINGS_MEDIA',			'Preferencias de envío / imágenes / multimedia');
define('_SETTINGS_MEDIAPREFIX',		'Prefijar los archivos enviados con la fecha');
define('_SETTINGS_MEMBERS',			'Preferencias de los miembros');

// bans
define('_BAN_TITLE',				'Lista de restricciones para');
define('_BAN_NONE',					'No hay restricciones para esta bitácora');
define('_BAN_NEW_TITLE',			'Introducir nueva restricción');
define('_BAN_NEW_TEXT',				'Introducir una nueva restricción ahora');
define('_BAN_REMOVE_TITLE',			'Eliminar restricción');
define('_BAN_IPRANGE',				'Rango IP');
define('_BAN_BLOGS',				'Qué bitácoras?');
define('_BAN_DELETE_TITLE',			'Eliminar restricción');
define('_BAN_ALLBLOGS',				'Bitácoras para las que el usuario tiene privilegios de administrador.');
define('_BAN_REMOVED_TITLE',		'Restricción eliminada');
define('_BAN_REMOVED_TEXT',			'Restricción eliminada para las siguientes bitácoras:');
define('_BAN_ADD_TITLE',			'Introducir restricción');
define('_BAN_IPRANGE_TEXT',			'Seleccionar el rango IP a restringir. A menor cantidad de números, más direcciones restringidas.');
define('_BAN_BLOGS_TEXT',			'Es posible optar por restringir la IP para una sóla bitácora, o restringir la IP en todas las bitácoras en las que el usuario tenga privilegios de administrador.');
define('_BAN_REASON_TITLE',			'Razón');
define('_BAN_REASON_TEXT',			'Es posible incluir una razón para la restricción, que será mostrada cuando el usuario con esa IP intente añadir un comentario o votar. La longitud máxima es de 256 carácteres.');
define('_BAN_ADD_BTN',				'Introducir restricción');

// LOGIN screen
define('_LOGIN_MESSAGE',			'Mensaje');
define('_LOGIN_NAME',				'Nombre');
define('_LOGIN_PASSWORD',			'Clave');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'Has olvidado la clave?');

// membermanagement
define('_MEMBERS_TITLE',			'Gestión de los miembros');
define('_MEMBERS_CURRENT',			'Miembros actuales');
define('_MEMBERS_NEW',				'Nuevo miembro');
define('_MEMBERS_DISPLAY',			'Nombre mostrado');
define('_MEMBERS_DISPLAY_INFO',		'(Este es el nombre usado para registrarse)');
define('_MEMBERS_REALNAME',			'Nombre real');
define('_MEMBERS_PWD',				'Clave');
define('_MEMBERS_REPPWD',			'Repetir la clave');
define('_MEMBERS_EMAIL',			'Dirección de correo');
define('_MEMBERS_EMAIL_EDIT',		'(Cuando se cambie la dirección de correo, una nueva clave será enviada automáticamente a esa dirección)');
define('_MEMBERS_URL',				'Dirección de la web (URL)');
define('_MEMBERS_SUPERADMIN',		'Privilegios de administrador');
define('_MEMBERS_CANLOGIN',			'El usuario puede entrar en la administración');
define('_MEMBERS_NOTES',			'Notas');
define('_MEMBERS_NEW_BTN',			'Introducir miembro');
define('_MEMBERS_EDIT',				'Modificar miembro');
define('_MEMBERS_EDIT_BTN',			'Modificar las preferencias');
define('_MEMBERS_BACKTOOVERVIEW',	'Volver a la página del miembro');
define('_MEMBERS_DEFLANG',			'Idioma');
define('_MEMBERS_USESITELANG',		'- usar las preferencias de la web -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'Visitar web');
define('_BLOGLIST_ADD',				'Introducir entrada');
define('_BLOGLIST_TT_ADD',			'Introducir una nueva entrada en esta bitácora');
define('_BLOGLIST_EDIT',			'Modificar/Eliminar entradas');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Bookmarklet');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'Preferencias');
define('_BLOGLIST_TT_SETTINGS',		'Modificar preferencias o gestionar equipo');
define('_BLOGLIST_BANS',			'Restricciones');
define('_BLOGLIST_TT_BANS',			'Ver, introducir o eliminar IPs restringidas');
define('_BLOGLIST_DELETE',			'Eliminar todo');
define('_BLOGLIST_TT_DELETE',		'Eliminar esta bitácora');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'Tus bitácoras');
define('_OVERVIEW_YRDRAFTS',		'Tus borradores');
define('_OVERVIEW_YRSETTINGS',		'Preferencias personales');
define('_OVERVIEW_GSETTINGS',		'Preferencias generales');
define('_OVERVIEW_NOBLOGS',			'El usuario no está en ningún equipo de bitácora');
define('_OVERVIEW_NODRAFTS',		'No hay borradores');
define('_OVERVIEW_EDITSETTINGS',	'Modificar preferencias personales...');
define('_OVERVIEW_BROWSEITEMS',		'Examinar entradas...');
define('_OVERVIEW_BROWSECOMM',		'Examinar comentarios...');
define('_OVERVIEW_VIEWLOG',			'Ver el registro de actividades...');
define('_OVERVIEW_MEMBERS',			'Gestionar los miembros...');
define('_OVERVIEW_NEWLOG',			'Crear nueva bitácora...');
define('_OVERVIEW_SETTINGS',		'Modificar preferencias...');
define('_OVERVIEW_TEMPLATES',		'Modificar plantillas...');
define('_OVERVIEW_SKINS',			'Modificar pieles...');
define('_OVERVIEW_BACKUP',			'Copia de seguridad / Restauración...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'Entradas para la bitácora'); 
define('_ITEMLIST_YOUR',			'Entradas');

// Comments
define('_COMMENTS',					'Comentarios');
define('_NOCOMMENTS',				'Entrada sin comentarios');
define('_COMMENTS_YOUR',			'Comentarios');
define('_NOCOMMENTS_YOUR',			'No se ha escrito ningún comentario');

// LISTS (general)
define('_LISTS_NOMORE',				'No hay resultados (adicionales)');
define('_LISTS_PREV',				'Anterior');
define('_LISTS_NEXT',				'Siguiente');
define('_LISTS_SEARCH',				'Buscar');
define('_LISTS_CHANGE',				'Modificar');
define('_LISTS_PERPAGE',			'Entradas por página');
define('_LISTS_ACTIONS',			'Acciones');
define('_LISTS_DELETE',				'Eliminar');
define('_LISTS_EDIT',				'Modificar');
define('_LISTS_MOVE',				'Mover');
define('_LISTS_CLONE',				'Clonar');
define('_LISTS_TITLE',				'Título');
define('_LISTS_BLOG',				'Bitácora');
define('_LISTS_NAME',				'Nombre');
define('_LISTS_DESC',				'Descripción');
define('_LISTS_TIME',				'Tiempo');
define('_LISTS_COMMENTS',			'Comentarios');
define('_LISTS_TYPE',				'Tipo');


// member list 
define('_LIST_MEMBER_NAME',			'Nombre mostrado');
define('_LIST_MEMBER_RNAME',		'Nombre real');
define('_LIST_MEMBER_ADMIN',		'Superadministrador? ');
define('_LIST_MEMBER_LOGIN',		'Puede registrarse? ');
define('_LIST_MEMBER_URL',			'Web');

// banlist
define('_LIST_BAN_IPRANGE',			'Rango IP');
define('_LIST_BAN_REASON',			'Razón');

// actionlist
define('_LIST_ACTION_MSG',			'Mensaje');

// commentlist
define('_LIST_COMMENT_BANIP',		'Restricción de IP');
define('_LIST_COMMENT_WHO',			'Autor');
define('_LIST_COMMENT',				'Comentario');
define('_LIST_COMMENT_HOST',		'Host');

// itemlist
define('_LIST_ITEM_INFO',			'Info');
define('_LIST_ITEM_CONTENT',		'Título y texto');


// teamlist
define('_LIST_TEAM_ADMIN',			'Administrador ');
define('_LIST_TEAM_CHADMIN',		'Modificar administrador');

// edit comments
define('_EDITC_TITLE',				'Modificar comentarios');
define('_EDITC_WHO',				'Autor');
define('_EDITC_HOST',				'Desde dónde?');
define('_EDITC_WHEN',				'Cuándo?');
define('_EDITC_TEXT',				'Texto');
define('_EDITC_EDIT',				'Modificar comentario');
define('_EDITC_MEMBER',				'miembro');
define('_EDITC_NONMEMBER',			'no miembro');

// move item
define('_MOVE_TITLE',				'Mover a qué bitácora?');
define('_MOVE_BTN',					'Mover entrada');

?>