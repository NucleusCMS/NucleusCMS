<?php
// French Nucleus Language File
//
// Author: Papachango <pfffouitt@yahoo.fr> (updated by Julien Pauthier <julienpauthier@yahoo.fr> and Pierre Rudloff <tael67@gmail.com>)
// Nucleus version: v1.0-v3.8
//
// Please note: if you want to translate this file to your own language, be aware
// that in a next Nucleus version, new variables might be added and some other ones
// might be deleted. Therefore, it's important to list the Nucleus version for which
// the file was written in your document.
//
// Fully translated language file can be sent to us and will be made
// available for download (with proper credit to the author, of course)

/**
 * Nucleus Language File
 *
 */

/********************************************
 *        Important Settings                *
 ********************************************/
if (!defined('_CHARSET')) define('_CHARSET', 'UTF-8'); // charset to use
if (!defined('_LOCALE'))  define('_LOCALE', 'fr_FR');
if (!defined('_LOCALE_NAME_WINDOWS'))  define('_LOCALE_NAME_WINDOWS', 'french');
if (!defined('_HTML_5_LANG_CODE'))     define('_HTML_5_LANG_CODE', 'fr');

/********************************************
 *        Admin Links Settings                *
 ********************************************/
define('_MANAGE_LINKS_ITEMS', '<li><a href="http://nucleuscms.org" title="Nucleus CMS Home">nucleuscms.org</a></li>
<li><a href="http://nucleuscms.org/forum/" title="Nucleus CMS Support Forum">nucleuscms.org/forum/</a></li>
<li><a href="http://nucleuscms.org/docs/" title="Nucleus CMS Documentation">nucleuscms.org/docs/</a></li>
<li><a href="http://nucleuscms.org/wiki/" title="Nucleus CMS Wiki">nucleuscms.org/wiki/</a></li>
<li><a href="http://nucleuscms.org/skins/" title="Nucleus CMS Skins">nucleuscms.org/skins/</a></li>
<li><a href="http://nucleuscms.org/wiki/doku.php/plugin" title="Nucleus CMS Plugins">nucleuscms.org/wiki/doku.php/plugin</a></li>
<li><a href="http://nucleuscms.org/dev/" title="Nucleus Developer Network">nucleuscms.org/dev/</a></li>
');

/********************************************
 *        Start New for                     *
 ********************************************/

/********************************************
 *        Start New for 3.80                *
 ********************************************/
define('_SETTINGS_ENABLE_RSS',          'Enable RSS output');

define('_ERROR_NOSUCHPAGE',				'No such page');
define('_SKIN_PARTS_SPECIAL_PAGE',     'Special skin page');
define('_CONFIRMTXT_SKIN_PARTS_SPECIAL_PAGE',  'Do you really want to delete this special skin page?');
define('_CONFIRMTXT_SKIN_PARTS_SPECIAL_STYPE_CHANGE',  'Do you really want to change this special skin parts type?');
define('_ERROR_SKIN_PARTS_SPECIAL_NOT_EXIST',          'There are no special skin parts.');
define('_ERROR_SKIN_PARTS_SPECIAL_PAGE_NOT_EXIST',     'There are no special skin page.');
define('_ERROR_SKIN_PARTS_SPECIAL_STYPE_CHANGE',       'can not change the type of special skin part');
define('_ERROR_SKIN_PARTS_SPECIAL_PAGE_STYPE_CHANGE',  'can not change the type of special skin page');
define('_ADMIN_TEXT_CHANGE_CONFIRM',     'Please check the change');
define('_ADMIN_TEXT_CHANGE',             'change');
define('_ADMIN_TEXT_SKIN_PARTS_CHANGE_TO_PAGE',     'Change to special skin page');
define('_ADMIN_TEXT_SKIN_PARTS_CHANGE_TO_PARTS',    'Change to special skin part');

define('_ADMIN_TEXT_UPGRADE_REQUIRED',       'Database upgrade is required.');
define('_ADMIN_TEXT_CLICK_HERE_TO_UPGRADE',  'Click here to upgrade the database to Nucleus v%s');

define('_LISTS_FORM_SELECT_ITEM_FILTER',                     'Filter');
define('_LISTS_FORM_SELECT_ITEM_OPTION_ALL',                 'All');
define('_LISTS_FORM_SELECT_ITEM_OPTION_NORMAL',              'Normal published');
define('_LISTS_FORM_SELECT_ITEM_OPTION_NORMAL_TERM_FUTURE',  'Normal future');
define('_LISTS_FORM_SELECT_ITEM_OPTION_DRAFT',             'Draft');

define('_EDIT_DATE_FORMAT',           'day,month,year');
define('_EDIT_DATE_FORMAT_SEPARATOR', '/,/,at,:,');
define('_EDIT_DATE_FORMAT_DESC',      '(dd/mm/yyyy hh:mm)');

define('_ADD_DATEINPUTNOW',       'now');
define('_ADD_DATEINPUTRESET',     'reset');

define('_LINKS',                                'Links');
define('_MEMBERS_PASSWORD_INFO',				'(Password should be at least 6 characters)');

define('_NUMBER_OF_POST',		'Number of post');
define('_NUMBER_OF_COMMENT',	'Number of comment');

define('_ADMIN_CAN_DELETE',	'Can be deleted');
define('_ADMIN_MEMBER_HALT_TITLE' ,             'Halt a member');
define('_ADMIN_MEMBER_HALT_CONFIRM_TITLE' ,     'Halt a member');
define('_ADMIN_MEMBER_HALT_CONFIRM_TEXT' ,      'Trying to stop the following member');
define('_ADMIN_MEMBER_HALT_CONFIRM_DONE_BTN' ,  'Execute stop a member');
define('_ADMIN_MEMBER_SUPERADMIN',              'Sper admin');
define('_LISTS_HALT',		'Halt');
define('_LISTS_HALTING',  	'Under suspension');
define('_ERROR_ADMIN_MEMBER_HALT_SELF',         'Perhaps this member, because it is the management\'s own logged in, you can not stop.');
define('_ERROR_ADMIN_MEMBER_ALREADY_HALTED',    'This member is already stopped.');
define('_ERROR_LOGIN_MEMBER_HALT_OR_INVALID',   'This member is invalid or stop.');
define('_ERROR_LOGIN_DISALLOWED_BY_HALT',       'This member is currently disabled. Logon is not permitted. If you\'re have an account of the administrative user, please log back in as an administrative user.');
define('_GFUNCTIONS_LOGIN_FAILED_HALT_TXT',     'Member [% s] is disabled or stopped. You can not log in.');

define('_ADMIN_DATABASE_OPTIMIZATION_REPAIR',      'Database Optimization/Repair');
define('_ADMIN_TITLE_OPTIMIZE',      'Optimize');
define('_ADMIN_TITLE_REPAIR',        'Repair');
define('_ADMIN_FILESIZE',            'File size');
define('_ADMIN_NEW',                 'New');
define('_ADMIN_OLD',                 'Old');
define('_ADMIN_TABLENAME',           'Table name');
define('_ADMIN_CONFIRM_TITLE_OPTIMIZE',    'Are you sure you want to optimize the tables?');
define('_ADMIN_CONFIRM_TITLE_AUTO_REPAIR', 'Are you sure you want to automatically repair the tables?');
define('_ADMIN_EXEC_TITLE_AUTO_REPAIR',    'tables repaired.');
define('_ADMIN_EXEC_TITLE_OPTIMIZE',       'tables optimized.');
define('_ADMIN_BTN_TITLE_AUTO_REPAIR',     'Repair');
define('_ADMIN_BTN_TITLE_OPTIMIZE',        'Optimize');
define('_ADMIN_PLEASE_OPTIMIZE',           'Optimize please');

define('_PROBLEMS_FOUND_ON_TABLE',   'problems found on table');
define('_NO_PROBLEMS_FOUND',         'No problems found');
define('_NOT_IMPLEMENTED_YET',       'Not implemented yet.');
define('_SIZE',                      'Size');
define('_OVERHEAD',                  'Overhead');

define('_MANAGER_PLUGINSQLAPI_DRIVER_NOTSUPPORT',   "Plugin %s was not loaded (does not support SqlApi_%s or SqlApi_SQL92. Please upgrade to the latest version of the plug-ins that support this feature.)");

define('_DEFAULT_DATE_FORMAT_YMD',         '%d/%m/%Y');
define('_DEFAULT_DATE_FORMAT_YBD',         '%d %B %Y');
define('_DEFAULT_DATE_FORMAT_YM',          '%m %Y');
define('_DEFAULT_DATE_FORMAT_YB',          '%B %Y');
define('_DEFAULT_DATE_FORMAT_MD',          '%m %d');
define('_DEFAULT_DATE_FORMAT_BD',          '%B %d');
define('_DEFAULT_DATE_FORMAT_Y',           '%Y');

define('_ADMIN_SYSTEMOVERVIEW_CORE_SYSTEM',      'About system core');
define('_ADMIN_SYSTEMOVERVIEW_CORE_VERSION',     'Core version');
define('_ADMIN_SYSTEMOVERVIEW_CORE_PATCHLEVEL',  'Core patch level');
define('_ADMIN_SYSTEMOVERVIEW_CORE_DB_VERSION', 'Core database version');
define('_ADMIN_SYSTEMOVERVIEW_CORE_SETTINGS',    'Core important settings');

define('_ADMIN_SYSTEMOVERVIEW_DB_VERSION',  'Database version');

// Blog option
define('_EBLOG_VISIBLE_ITEM_AUTHOR',           "allow the display of the item's author");

define('_ADMIN_LOST_PSWD_TEXT_TITLE', "Forgot your password?");
define('_ADMIN_LOST_PSWD_TEXT_1', "Enter your username and email address below, and you'll be sent an e-mail with a link where you can choose a new password.");
define('_ADMIN_LOST_PSWD_TEXT_2', "If you don't remember your exact username, contact the site administrator.");
define('_ADMIN_LOST_PSWD_TEXT_3', "Send Activation Link");
define('_ADMIN_LOST_PSWD_TEXT_USENAME', "Username:");
define('_ADMIN_LOST_PSWD_TEXT_EMAIL', "Email address:");

/********************************************
 *        Start New for 3.71                *
 ********************************************/
define('_ADMIN_SYSTEMOVERVIEW_DBANDVERSION',  'Database and Version');
define('_ADMIN_SYSTEMOVERVIEW_DBDRIVER',      'Database Driver');
define('_ADMIN_SYSTEMOVERVIEW_PHPANDDB',      'PHP and Database');

define('_TEAM_NO_SELECTABLE_MEMBERS',         'team does not have selectable members');

define('_LISTS_FORM_SELECT_ALL_CATEGORY',    'All categories');

define('_LIST_BACK_TO',				'Back to %s');
define('_LIST_COMMENT_LIST_FOR_BLOG',		'Blog comments list');
define('_LIST_COMMENT_LIST_FOR_ITEM',		'Comments list of items');
define('_LIST_COMMENT_VIEW_ITEM',			'Show item');
define('_LISTS_VIEW',						'Show');

define('_LISTS_ITEM_COUNT',      'Item count');
define('_LISTS_ORDER',           'order');

define('_EBLOG_CAT_ORDER',            "This is the order of the category.<br />\nInput value will be on the smaller in number (standard 100)");
define('_EBLOG_CAT_ORDER_DESC2',      "Input value will be on the smaller in number (standard 100)");

// category order changes (batch)
define('_BATCH_CAT_CAHANGE_ORDER',                 'change the order');
define('_ERROR_CAHANGE_CATEGORY_ORDER',            'You can not change the sort');
define('_CAHANGE_CATEGORY_ORDER_TITLE',            'Please specify the order of the category');
define('_CAHANGE_CATEGORY_ORDER_CONFIRM_DESC',     'The order of the following categories will be changed at once.If it is good, please press the button.');
define('_CAHANGE_CATEGORY_ORDER_BTN_TITLE',        'Change the order');

// Skin import/export
define('_SKINIE_ERROR_FAILEDLOAD_XML',        'Failed to Load XML');

 /********************************************
 *        Start New for 3.65                *
 ********************************************/
define('_LISTS_AUTHOR', 'Author');
define('_OVERVIEW_OTHER_DRAFTS', 'Other Drafts');
 
/********************************************
 *        Start New for 3.64                *
 ********************************************/
define('_ERROR_USER_TOO_LONG', 'Please enter a name shorter than 40 characters.');
define('_ERROR_EMAIL_TOO_LONG', 'Please enter an email shorter than 100 characters.');
define('_ERROR_URL_TOO_LONG', 'Please enter a website shorter than 100 characters.');

/********************************************
 *        Start New for 3.62                *
 ********************************************/
define('_SETTINGS_ADMINCSS',		'Admin Area Style');

/********************************************
 *        Start New for 3.50                *
 ********************************************/
define('_PLUGS_TITLE_GETPLUGINS',		'obtenir plus de plugins...');
define('_ARCHIVETYPE_YEAR', 'année');
define('_ADMIN_SYSTEMOVERVIEW_LATESTVERSION_TITLE',		'Nouvelle version disponible');
define('_ADMIN_SYSTEMOVERVIEW_LATESTVERSION_TEXT',		'Mise à jour disponible : v');
define('_MANAGER_PLUGINSQLAPI_NOTSUPPORT', "Le plugin %s n'a pas été chargé (il ne supporte pas SqlApi et vous essayez d'utiliser une base de données non-mysql)");


/********************************************
 *        Start New for 3.40                *
 ********************************************/

// START changed/added after 3.33 START
define('_MEMBERS_USEAUTOSAVE',						'Utiliser la fonction de sauvegarde automatique ?');

define('_TEMPLATE_PLUGIN_FIELDS',					'Champs de plugin personnalisés');
define('_TEMPLATE_BLOGLIST',						'Liste des modèles de blog');
define('_TEMPLATE_BLOGHEADER',						'En-tête de la liste de blog');
define('_TEMPLATE_BLOGITEM',						'Elément de la liste de blog');
define('_TEMPLATE_BLOGFOOTER',						'Pied de page de la liste de blog');

define('_SETTINGS_DEFAULTLISTSIZE',					'Taille par défaut des listes dans la zone d\'administration');
define('_SETTINGS_DEBUGVARS',		'Variables de débogage');

define('_CREATE_ACCOUNT_TITLE',						'Créer un compte de membre');
define('_CREATE_ACCOUNT0',							'Créer un compte');
define('_CREATE_ACCOUNT1',							'Les visiteurs ne sont pas autorisés à créer un compte de membre.<br /><br />');
define('_CREATE_ACCOUNT2',							'Veuillez contacter l\'administrateur du site web pour plus d\'informations.');
define('_CREATE_ACCOUNT_USER_DATA',					'Informations sur le compte.');
define('_CREATE_ACCOUNT_LOGIN_NAME',				'Nom du compte (requis):');
define('_CREATE_ACCOUNT_LOGIN_NAME_VALID',			'a-z et 0-9 autorisés uniquement, pas d\'espaces au début et/ou à la fin');
define('_CREATE_ACCOUNT_REAL_NAME',					'Nom réel (requis):');
define('_CREATE_ACCOUNT_EMAIL',						'Email (requis):');
define('_CREATE_ACCOUNT_EMAIL2',					'(doit être vlide, parce qu\'un lien d\'activation sera envoyé)');
define('_CREATE_ACCOUNT_URL',						'URL:');
define('_CREATE_ACCOUNT_SUBMIT',					'Créer le compte');

define('_BMLET_BACKTODRAFTS',		'Déplacer vers les brouillons');
define('_BMLET_CANCEL',				'Annuler');

define('_LIST_ITEM_NOCONTENT',						'Aucun commentaire');
define('_LIST_ITEM_COMMENTS',						'%d commentaires');

define('_EDITC_URL',				'Site web');
define('_EDITC_EMAIL',				'E-mail');

define('_MANAGER_PLUGINFILE_NOTFOUND',				"Le plugin %s n'a pas été chargé (fichier introuvable)");
/* changed */
// plugin dependency 
define('_ERROR_INSREQPLUGIN',		'Echec de l\'installation du plugin, %s nécessaire');
define('_ERROR_DELREQPLUGIN',		'Echec de la suppression du plugin, requis par %s');

//define('_ADD_ADDLATER',								'Add Later');
define('_ADD_ADDLATER',								'Add the dates specified');

define('_LOGIN_NAME',				'Nom :');
define('_LOGIN_PASSWORD',			'Mot de passe :');

// changed from _BOOKMARLET_BMARKLFOLLOW
define('_BOOKMARKLET_BMARKFOLLOW',					' (Fonctionne avec presque tous les navigateurs)');
// END changed/added after 3.33 END

// START merge UTF-8 and EUC-JP

// Create New blog
define('_ADMIN_NOTABILIA',							'Quelques informations');
define('_ADMIN_PLEASE_READ',						"Avant de commencer, voici quelques <strong>informations importantes</strong>");
define('_ADMIN_HOW_TO_ACCESS',						"Après la création d'un nouveau blog, vous devrez rendre votre blog accessible. Il y deux possibilités :");
define('_ADMIN_SIMPLE_WAY',							"<strong>Simple :</strong> Créer une copie d'<code>index.php</code> et le modifier afind 'afficher votre nouveau blog. Plus d'informations vous seront fourniées après l'envoie de ce formulaire.");
define('_ADMIN_ADVANCED_WAY',						"<strong>Avancé :</strong> Insérer le contenu du blog dans vos skins actuels en utilisant des variables comme <code>&lt;%otherblog()&gt;</code>. De cette façon, vous pouvez placer plusieurs blogs sur la même page.");
define('_ADMIN_HOW_TO_CREATE',						'Créer un blog');


define('_BOOKMARKLET_NEW_CATEGORY',					'L\'élément a été ajouté et une nouvelle catégorie a été crée.');
define('_BOOKMARKLET_NEW_CATEGORY_EDIT',			'Cliquez ici pour modifier le nom et la description de la catégorie.');
define('_BOOKMARKLET_NEW_WINDOW',					'S\'ouvre dans une nouvelle fenêtre.');
define('_BOOKMARKLET_SEND_PING',					'L\'élément a ajouté avec succès. Maintenant, ping de weblogs.com. Veuillez patienter... (peut prendre longtemps.'); // NOTE: This string is no longer in used

// END merge UTF-8 and EUC-JP

// <add by shizuki>
// OVERVIEW screen
define('_OVERVIEW_SHOWALL',							'Afficher tous les blogs');	// <add by shizuki />

// Edit skins
define('_SKINEDIT_ALLOWEDBLOGS',						'Noms courts des blogs :');			// <add by shizuki>
define('_SKINEDIT_ALLOWEDTEMPLATESS',					'Noms des modèles :');		// <add by shizuki>

// delete member
define('_WARNINGTXT_NOTDELMEDIAFILES',				'Veuillez noter que les fichiers média ne seront <b>PAS</b> supprimés. (Du moins pas dans cette version de Nucleus)');	// <add by shizuki />

// send Weblogupdate.ping
define('_UPDATEDPING_MESSAGE',						'<h2>Site mis à jour, ping de plusieurs services de liste de blogs...</h2><p>Cela peut prendre un moment...</p><p>Si vous n\'êtes pas automatiquement redirigé, '); // NOTE: This string is no longer in used
define('_UPDATEDPING_GOPINGPAGE',					'réessayez'); // NOTE: This string is no longer in used
define('_UPDATEDPING_PINGING',						'Ping des services, veuillez patienter...'); // NOTE: This string is no longer in used
define('_UPDATEDPING_VIEWITEM',						'Afficher une liste des billets récents pour '); // NOTE: This string is no longer in used
define('_UPDATEDPING_VISITOWNSITE',					'Visitez votre propre site web'); // NOTE: This string is no longer in used

// General category
define('_EBLOGDEFAULTCATEGORY_NAME',				'Général');
define('_EBLOGDEFAULTCATEGORY_DESC',				'Billets qui ne rentrent pas dans les autres catégories');

// First ITEM
define('_EBLOG_FIRSTITEM_TITLE',					'Premier billet');
define('_EBLOG_FIRSTITEM_BODY',						'Ceci est le premier billet de votre blog. Vous pouvez le supprimer si vous le souhaitez.');

// New weblog was created
define('_BLOGCREATED_TITLE',						'Nouveau blog créé');
define('_BLOGCREATED_ADDEDTXT',						"Votre nouveau blog (%s) a été créé. Pour continuer, choisissez une façon de l'afficher :");
define('_BLOGCREATED_SIMPLEWAY',					"Facile : Une copie de <code>%s.php</code>");
define('_BLOGCREATED_ADVANCEDWAY',					"Avancé : Appeler le blog depuis des habillages existants");
define('_BLOGCREATED_SIMPLEDESC1',					"Méthode 1 : Créer un autre fichier <code>%s.php</code>");
define('_BLOGCREATED_SIMPLEDESC2',					"Créez un fichier nommé <code>%s.php</code> et copier le code suivant dedans :");
define('_BLOGCREATED_SIMPLEDESC3',					"Uploadez le fichier près de votre fichier <code>index.php</code> et cela devrait être bon.");
define('_BLOGCREATED_SIMPLEDESC4',					"Pour finir le processus de création du blog, veuillez entrer l'URL final de votre blog (La valeur proposée est juste une <em>conjecture</em>) :");
define('_BLOGCREATED_ADVANCEDWAY2',					"Méthode 2 : Appeler le blog depuis des habillages existants");
define('_BLOGCREATED_ADVANCEDWAY3',					"Pour finir le processus de création du blog, entrez simplement l'URL final de votre blog : (peut être la même qu'un blog existant)");

// Donate!
define('_ADMINPAGEFOOT_OFFICIALURL',				'http://nucleuscms.org/');
define('_ADMINPAGEFOOT_DONATEURL',					'http://nucleuscms.org/donate.php');
define('_ADMINPAGEFOOT_DONATE',						'Faire un don !');
define('_ADMINPAGEFOOT_COPYRIGHT',					'The Nucleus Group');

// Quick menu
define('_QMENU_MANAGE_SYSTEM',						'Informations système');

// REG file
define('_WINREGFILE_TEXT',							'Poster dans &Nucleus (%s)');

// Bookmarklet
define('_BOOKMARKLET_TITLE',						'Bookmarklet<!-- et menu clic droit -->');
define('_BOOKMARKLET_DESC1',						'Les bookmarklets permettent d\'ajouter des billets à votre blog en un seul clic. ');
define('_BOOKMARKLET_DESC2',						'Après avoir installé ces bookmarklets, vous pourrez cliquer sur le bouton \'ajouter au blog\' de la barre d\'outils de votre navigateur ');
define('_BOOKMARKLET_DESC3',						'et une fenêtre d\'ajout de billet apparaitra, ');
define('_BOOKMARKLET_DESC4',						'contenant les titre et lien de la page que vous visitiez, ');
define('_BOOKMARKLET_DESC5',						'ainsi que le texte sélectionné.');
define('_BOOKMARKLET_BOOKARKLET',					'bookmarklet');
define('_BOOKMARKLET_ANCHOR',						'Ajouter à %s');
define('_BOOKMARKLET_BMARKTEXT',					'Vous pouvez glisser le lien suivant vers vos favoris ou la barre d\'outils de votre navigateur : ');
define('_BOOKMARKLET_BMARKTEST',					'(si vous voulez d\'abord tester le bookmarklet, cliquez sur le lien)');
define('_BOOKMARKLET_RIGHTCLICK',					'Accès au menu clic droit (IE &amp; Windows)');
define('_BOOKMARKLET_RIGHTLABEL',					'élément du menu clic droit');
define('_BOOKMARKLET_RIGHTTEXT1',					'Ou vous pouvez installer le ');
define('_BOOKMARKLET_RIGHTTEXT2',					' (choisissez \'ouvrir un fichier\' et ajoutez le au registre)');
define('_BOOKMARKLET_RIGHTTEXT3',					'Vous devrez redémarrer Internet Explorer pour que l\'option s\'affiche dans le menu contextuel.');
define('_BOOKMARKLET_UNINSTALLTT',					'Désinstallation');
define('_BOOKMARKLET_DELETEBAR',					'Pour le bookmarklet, vous pouvez simplement le supprimer.');
define('_BOOKMARKLET_DELETERIGHTT',					'Pour l\'élément du menu clic droit, suivez la procédure ci-dessous :');
define('_BOOKMARKLET_DELETERIGHT1',					'Sélectionnez "Lancer..." dans le menu Démarrer');
define('_BOOKMARKLET_DELETERIGHT2',					'Tapez : "regedit"');
define('_BOOKMARKLET_DELETERIGHT3',					'Cliquez sur "OK"');
define('_BOOKMARKLET_DELETERIGHT4',					'Recherchez "\HKEY_CURRENT_USER\Software\Microsoft\Internet Explorer\MenuExt" dans l\'arbre');
define('_BOOKMARKLET_DELETERIGHT5',					'Supprimez l\'élément "add to \'Votre blog\'"');

define('_BOOKMARKLET_ERROR_SOMETHINGWRONG',			'Quelque chose n\'a pas fonctionné');
define('_BOOKMARKLET_ERROR_COULDNTNEWCAT',			'Impossible de créer une nouvelle catégorie');

// BAN
define('_BAN_EXAMPLE_TITLE',						'Un exemple');
define('_BAN_EXAMPLE_TEXT',							': "134.58.253.193" bloquera un seul ordinateur, tandis que "134.58.253" bloquera 256 adresses IP, y compris celle du premier exemple.');
define('_BAN_IP_CUSTOM',							'Personnalisé : ');
define('_BAN_BANBLOGNAME',							'Seulement le blog %s');

// Plugin Options
define('_PLUGIN_OPTIONS_TITLE',							'Options pour %s');

// Plugin file loda error
define('_PLUGINFILE_COULDNT_BELOADED',				'Erreur : le fichier de plugin <strong>%s.php</strong> n\'a pas pu être chargé ou bien il est inactif parce qu\'il ne supporte pas certains fonctions (vérifiez le <a href="?action=actionlog">journal</a> pour plus d\'informations)');

//ITEM add/edit template (for japanese only)
define('_ITEM_ADDEDITTEMPLATE_FORMAT',				'Format :');
define('_ITEM_ADDEDITTEMPLATE_YEAR',				'Année');
define('_ITEM_ADDEDITTEMPLATE_MONTH',				'Mois');
define('_ITEM_ADDEDITTEMPLATE_DAY',					'Jour');
define('_ITEM_ADDEDITTEMPLATE_HOUR',				'Heure');
define('_ITEM_ADDEDITTEMPLATE_MINUTE',				'Minutes');

// Errors
define('_ERRORS_INSTALLSQL',						'install.sql devrait être supprimé');
define('_ERRORS_INSTALLDIR',						'le répertoire install devrait être supprimé');  // <add by shizuki />
define('_ERRORS_INSTALLPHP',						'install.php devrait être supprimé');
define('_ERRORS_UPGRADESDIR',						'le répertoire nucleus/upgrades devrait être supprimé');
define('_ERRORS_CONVERTDIR',						'le répertoire nucleus/convert devrait être supprimé');
define('_ERRORS_CONFIGPHP',							'config.php devrait être en lecture seule (chmod 444)');
define('_ERRORS_STARTUPERROR1',						'<p>Certains fichiers d\'installation de Nucleus sont toujours présent sur le serveur web ou sont modifiables.</p><p>Vous devriez retirer ces fichiers ou modifier leur permissions. Voici les fichiers trouvés par Nucleus</p> <ul><li>');
define('_ERRORS_STARTUPERROR2',						'</li></ul><p>Si vous ne voulez plus voir ce message sans résoudre le problème, définissez <code>$CONF[\'alertOnSecurityRisk\']</code> dans <code>globalfunctions.php</code> à <code>0</code> ou bien faites le à la fin de <code>config.php</code>.</p>');
define('_ERRORS_STARTUPERROR3',						'Problème de sécurité');

// PluginAdmin tickets by javascript
define('_PLUGINADMIN_TICKETS_JAVASCRIPT',			'<p><b>Une erreur est survenu pendant l\'ajout automatique de tickets.</b></p>');

// Global settings disablesite URL
define('_SETTINGS_DISABLESITEURL',					'URL de redirection :');

// Skin import/export
define('_SKINIE_SEELEMENT_UNEXPECTEDTAG',			'TAG INATTENDU');
define('_SKINIE_ERROR_FAILEDOPEN_FILEURL',			'Impossible d\'ouvrir le fichier/URL');
define('_SKINIE_NAME_CLASHES_DETECTED',				'Conflit de noms détecté, relancez avec allowOverwrite = 1 pour forcer le remplacement');

// ACTIONS.php parse_commentform
define('_ACTIONURL_NOTLONGER_PARAMATER',			'actionurl n\'est plus un paramètre de la variable commentform. Déplacé vers un paramètre global à la place.');

// ADMIN.php addToTemplate 'Query error: '
define('_ADMIN_SQLDIE_QUERYERROR',					'Erreur de requête : ');

// backyp.php Backup WARNING
define('_BACKUP_BACKUPFILE_TITLE',					'Ceci est un fichier de sauvegarde généré par Nucleus');
define('_BACKUP_BACKUPFILE_BACKUPDATE',				'date de la sauvegarde :');
define('_BACKUP_BACKUPFILE_NUCLEUSVERSION',			'Version de Nucleus :');
define('_BACKUP_BACKUPFILE_DATABASE_NAME',			'Nom de la base de données de Nucleus :');
define('_BACKUP_BACKUPFILE_TABLE_NAME',				'TABLE:');
define('_BACKUP_BACKUPFILE_TABLEDATAFOR',			'Données de table pour %s');
define('_BACKUP_WARNING_NUCLEUSVERSION',			'AVERTISSEMENT : Tentez une restauration uniquement sur les serveurs utilisant exactement la même version de Nucleus');
define('_BACKUP_RESTOR_NOFILEUPLOADED',				'Aucun fichier envoyé');
define('_BACKUP_RESTOR_UPLOAD_ERROR',				'Erreur d\'envoi du fichier');
define('_BACKUP_RESTOR_UPLOAD_NOCORRECTTYPE',		'Le fichier envoyé n\'est pas du bon type');
define('_BACKUP_RESTOR_UPLOAD_NOZLIB',				'Impossible de décompresser une sauvegarde gzip (zlib n\'est pas installé)');
define('_BACKUP_RESTOR_SQL_ERROR',					'Erreur SQL : ');

// BLOG.php addTeamMember
define('_TEAM_ADD_NEWTEAMMEMBER',					'Ajouté %s (ID=%d) à l\'équipe du blog "%s"');

// ADMIN.php systemoverview()
define('_ADMIN_SYSTEMOVERVIEW_HEADING',				'Aperçu du système');
define('_ADMIN_SYSTEMOVERVIEW_PHPANDMYSQL',			'PHP et MySQL');
define('_ADMIN_SYSTEMOVERVIEW_VERSIONS',			'Versions');
define('_ADMIN_SYSTEMOVERVIEW_PHPVERSION',			'Version de PHP');
define('_ADMIN_SYSTEMOVERVIEW_MYSQLVERSION',		'Version de MySQL');
define('_ADMIN_SYSTEMOVERVIEW_SETTINGS',			'Paramètres');
define('_ADMIN_SYSTEMOVERVIEW_GDLIBRALY',			'Bibliothèque GD');
define('_ADMIN_SYSTEMOVERVIEW_MODULES',				'Modules');
define('_ADMIN_SYSTEMOVERVIEW_ENABLE',				'activé');
define('_ADMIN_SYSTEMOVERVIEW_DISABLE',				'désactivé');
define('_ADMIN_SYSTEMOVERVIEW_NUCLEUSSYSTEM',		'Votre système Nucleus');
define('_ADMIN_SYSTEMOVERVIEW_NUCLEUSVERSION',		'Version de Nucleus');
define('_ADMIN_SYSTEMOVERVIEW_NUCLEUSPATCHLEVEL',	'Niveau de patch de Nucleus');
define('_ADMIN_SYSTEMOVERVIEW_NUCLEUSSETTINGS',		'Paramètres importants');
define('_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK',		'Rechercher une nouvelle version');
define('_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_TXT',	'Vérifie sur nucleuscms.org si une nouvelle version est disponible : ');
define('_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_URL',	'http://nucleuscms.org/version.php?v=%d&amp;pl=%d');
define('_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_TITLE',	'Recherche une mise à jour');
define('_ADMIN_SYSTEMOVERVIEW_NOT_ADMIN',			"Vous n'avez pas les droit nécessaires pour voir les informations systèmes.");

// ENCAPSULATE.php
define('_ENCAPSULATE_ENCAPSULATE_NOENTRY',			'Aucune entrée');

// globalfunctions.php
define('_GFUNCTIONS_LOGINPCSHARED_YES',				'sur un ordinateur partagé');
define('_GFUNCTIONS_LOGINPCSHARED_NO',				'sur un ordinateur non-partagé');
define('_GFUNCTIONS_LOGINSUCCESSFUL_TXT',			'Connexion réussie pour %s (%s)');
define('_GFUNCTIONS_LOGINFAILED_TXT',				'Echec de la connexion pour %s');
define('_GFUNCTIONS_LOGOUT_TXT',					'%s est déconnecté');
define('_GFUNCTIONS_HEADERSALREADYSENT_FILE',		' dans <code>%s</code> ligne <code>%s</code>');
define('_GFUNCTIONS_HEADERSALREADYSENT_TITLE',		' En-têtes de page déjà envoyés');
define('_GFUNCTIONS_HEADERSALREADYSENT_TXT',		'<p>Les en-têtes de la page ont déjà été envoyés %s. Ceci pour empêcher Nucleus de fonctionner correctement.</p><p>Habituellement, ceci est causé par des espaces ou des retours à la ligne à la fin du fichier <code>config.php</code> file, à la fin du fichier de langue ou à la fin d\'un fichier de plugin. Veuillez essayer de corriger ceci et réessayer.</p><p>Si vous ne souhaitez plus voir ce message, sans résoudre le problème, définissez <code>$CONF[\'alertOnHeadersSent\']</code> dans <code>globalfunctions.php</code> à <code>0</code></p>');
define('_GFUNCTIONS_PARSEFILE_FILEMISSING',			'Il manque un fichier');
define('_GFUNCTIONS_AN_ERROR_OCCURRED',				'Désolé. Une erreur est survenue.');
define('_GFUNCTIONS_YOU_AERNT_LOGGEDIN',			"Vous n'êtes pas connecté.");

// MANAGER.php
define('_MANAGER_PLUGINFILE_NOCLASS',				"Le plugin %s n'a pas été chargé (Classe introuvable dans le fichier, erreur de traitement possible)");
define('_MANAGER_PLUGINTABLEPREFIX_NOTSUPPORT',		"Le plugin %s n'a pas été chargé (ne supporte pas SqlTablePrefix)");

// mysql.php
define('_NO_SUITABLE_MYSQL_LIBRARY',				"<p>Aucun bibliothèque mySQL appropriée trouvée pour lancer Nucleus</p>");

// PLUGIN.php
define('_ERROR_PLUGIN_NOSUCHACTION',				'Action introuvable');

// PLUGINADMIN.php
define('_ERROR_INVALID_PLUGIN',						'Plugin invalide');

// showlist.php
define('_LIST_PLUGS_DEPREQ',						'Le(s) plugin(s) nécessite(nt) :');
define('_LIST_SKIN_PREVIEW',						"Aperçu de l'habillage '%s'");
define('_LIST_SKIN_PREVIEW_VIEWLARGER',				"Voir en grand");
define('_LIST_SKIN_README',							"Plus d'informations sur l'habillage '%s'");
define('_LIST_SKIN_README_TXT',						'Lisez-moi');

// BLOG.php createNewCategory()
define('_CREATED_NEW_CATEGORY_NAME',				'newcat');
define('_CREATED_NEW_CATEGORY_DESC',				'Nouvelle catégorie');

// ADMIN.php blog settings
define('_EBLOG_CURRENT_TEAM_MEMBER',				'Membres actuels de l\'équipe :');

// HTML outputs
define('_HTML_XML_NAME_SPACE_AND_LANG_CODE',		'xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr-fr" lang="fr-fr"');
define('_LANG_CODE',		'fr');

// Language Files
define('_LANGUAGEFILES_JAPANESE-UTF8',				'Japonais - &#26085;&#26412;&#35486; (UTF-8)');
define('_LANGUAGEFILES_JAPANESE-EUC',				'Japonais - &#26085;&#26412;&#35486; (EUC)');
define('_LANGUAGEFILES_ENGLISH-UTF8',				'Anglais - English (UTF-8)');
define('_LANGUAGEFILES_ENGLISH',					'Anglais - English (iso-8859-1)');
/*
define('_LANGUAGEFILES_BULGARIAN',					'Bulgarian - &#1041;&#1098;&#1083;&#1075;&#1072;&#1088;&#1089;&#1082;&#1080; (iso-8859-5)');
define('_LANGUAGEFILES_CATALAN',					'Catalan - Catal&agrave; (iso-8859-1)');
define('_LANGUAGEFILES_CHINESE-GBK',				'Simplified Chinese - &#31777;&#20307;&#23383;&#20013;&#25991; (gbk)');
define('_LANGUAGEFILES_SIMCHINESE',					'Simplified Chinese - &#31777;&#20307;&#23383;&#20013;&#25991; (gb2312)');
define('_LANGUAGEFILES_CHINESE-UTF8',				'Simplified Chinese - &#31777;&#20307;&#23383;&#20013;&#25991; (utf-8)');
define('_LANGUAGEFILES_CHINESEB5',					'Tranditional Chinese - &#32321;&#20307;&#23383;&#20013;&#25991; (big5)');
define('_LANGUAGEFILES_CHINESEB5-UTF8',				'Tranditional Chinese - &#32321;&#20307;&#23383;&#20013;&#25991; (utf-8)');
define('_LANGUAGEFILES_TRADITIONAL_CHINESE',		'Tranditional Chinese - &#32321;&#20307;&#23383;&#20013;&#25991; (big5)');
define('_LANGUAGEFILES_TRADITIONAL_CHINESE-UTF-8',	'Tranditional Chinese - &#32321;&#20307;&#23383;&#20013;&#25991; (utf-8)');
define('_LANGUAGEFILES_CZECH',						'Czech - &#268;esky (windows-1250)');
define('_LANGUAGEFILES_FINNISH',					'Finnish - Suomi (iso-8859-1)');
define('_LANGUAGEFILES_FRENCH',						'French - Fran&ccedil;ais (iso-8859-1)');
define('_LANGUAGEFILES_GALEGO',						'Galego - Galego (iso-8859-1)');
define('_LANGUAGEFILES_GERMAN',						'German - Deutsch (iso-8859-1)');
define('_LANGUAGEFILES_HUNGARIAN',					'Hungarian - Magyar (iso-8859-2)');
define('_LANGUAGEFILES_ITALIANO',					'Italiano - Italiano (iso-8859-1)');
define('_LANGUAGEFILES_KOREAN-EUC-KR',				'Korean - &#54620;&#44397;&#50612; (euc-kr)');
define('_LANGUAGEFILES_KOREAN-UTF',					'Korean - &#54620;&#44397;&#50612; (utf-8)');
define('_LANGUAGEFILES_LATVIAN',					'Latvian - Latvie&scaron;u (windows-1257)');
define('_LANGUAGEFILES_NEDERLANDS',					'Duch - Nederlands (iso-8859-15)');
define('_LANGUAGEFILES_PERSIAN',					'Persian - &#1601;&#1575;&#1585;&#1587;&#1740; (utf-8)');
define('_LANGUAGEFILES_PORTUGUESE_BRAZIL',			'Portuguese Brazil - Portugu&ecirc;s (iso-8859-1)');
define('_LANGUAGEFILES_RUSSIAN',					'Russian - &#1056;&#1091;&#1089;&#1089;&#1082;&#1080;&#1081; (windows-1251)');
define('_LANGUAGEFILES_SLOVAK',						'Slovak - Sloven&#269;ina (ISO-8859-2)');
define('_LANGUAGEFILES_SPANISH-UTF8',				'Spanish - Espa&ntilde;ol (utf-8)');
define('_LANGUAGEFILES_SPANISH',					'Spanish - Espa&ntilde;ol (iso-8859-1)');
*/

// </add by shizuki>

/********************************************
 *        End New for 3.40                  *
 ********************************************/

// START changed/added after 3.3 START
define('_AUTOSAVEDRAFT',		'Sauvegarde automatique du brouillon');
define('_AUTOSAVEDRAFT_LASTSAVED',	'Dernière sauvegarde : ');
define('_AUTOSAVEDRAFT_NOTYETSAVED',	'Aucune sauvegarde n\'a été effectuée pour l\'instant');
define('_AUTOSAVEDRAFT_NOW',		'Sauvegarder maintenant');
define('_SKIN_PARTS_SPECIAL',		'Parties d\'habillage spéciales');
define('_ERROR_SKIN_PARTS_SPECIAL_FORMAT',		'You must enter a name that exists only out of lowercase letters and digits');
define('_ERROR_SKIN_PARTS_SPECIAL_DELETE',		'Impossible de supprimer cette partie d\'habillage');
define('_CONFIRMTXT_SKIN_PARTS_SPECIAL',		'Voulez vous vraiment supprimer cette partie d\'habillage spéciale ?');
define('_ERROR_PLUGIN_LOAD',		'Impossible de charger le plugin ou bien il ne supporte pas certains fonctions requises pour le lancer sur votre installation de Nucleus (vérifiez le <a href="?action=actionlog">journal</a> pour plus d\'informations)');
// END changed/added after 3.3 END

// START changed/added after 3.22 START
define('_SEARCHFORM_QUERY',			'Mots clef à rechercher');
define('_ERROR_EMAIL_REQUIRED',		'Une adresse email est nécessaire');
define('_COMMENTFORM_MAIL',			'Site web :');
define('_COMMENTFORM_EMAIL',		'E-mail:');
define('_EBLOG_REQUIREDEMAIL',		'Demander une adresse email avec les commentaires ?');
define('_ERROR_COMMENTS_SPAM',      'Votre commentaire a été rejeté parce qu\'il n\'a pas passé le test anti-spam');
// END changed/added after 3.22 END

// START changed/added after 3.15 START

define('_LIST_PLUG_SUBS_NEEDUPDATE',	'Veuillez utiliser le bouton \'Mettre à jour la liste des installations\' pour mettre à jour la liste des modules installés.');
define('_LIST_PLUGS_DEP',		'Ce module nécessite:');

// END changed/added after 3.15

// START changed/added after 3.1 START

// comments list per weblog
define('_COMMENTS_BLOG',		'Tous les commentaires du blog');
define('_NOCOMMENTS_BLOG',		'Aucun commentaire n\'a été fait sur les billets de ce blog');
define('_BLOGLIST_COMMENTS',		'Commentaires');
define('_BLOGLIST_TT_COMMENTS',		'Liste de tous les commentaires apportés aux billets de blog');


// for use in archivetype-skinvar
define('_ARCHIVETYPE_DAY',		'jour');
define('_ARCHIVETYPE_MONTH',		'mois');

// tickets (prevents malicious users to trick an admin to perform actions he doesn't want)
define('_ERROR_BADTICKET',		'Ticket invalide ou expiré.');

// plugin dependency
define('_ERROR_INSREQPLUGIN',		'L\'installation a échoué car le module nécessite ');
define('_ERROR_DELREQPLUGIN',		'L\'désinstallation a échoué car le module est requis par ');

// cookie prefix
define('_SETTINGS_COOKIEPREFIX',	'Préfixe du cookie');

// account activation
define('_ERROR_NOLOGON_NOACTIVATE',	'Impossible d\'envoyer le lien d\'activation. Vous n\'êtes pas autorisé à vous authentifier.');
define('_ERROR_ACTIVATE',		'La clef d\'activation key n\'existe pas, est invalide, ou a expiré.');
define('_ACTIONLOG_ACTIVATIONLINK', 	'Lien d\'activation envoyé');
define('_MSG_ACTIVATION_SENT',		'Lien d\'activation a été envoyé par mail.');

// activation link emails
define('_ACTIVATE_REGISTER_MAIL',	"Bonjour <%memberName%>,\n\nvous devez activer votre compte sur <%siteName%> (<%siteUrl%>).\nVous pouvez le faire en suivant le lien ci-dessous :\n\n\t<%activationUrl%>\n\nPassés 2 jours le lien d\'activation sera invalide.");
define('_ACTIVATE_REGISTER_MAILTITLE',	"Activez votre compte '<%memberName%>'");
define('_ACTIVATE_REGISTER_TITLE',	'Bienvenue <%memberName%>');
define('_ACTIVATE_REGISTER_TEXT',	'Une dernière étape : choisissez un mot de passe pour votre compte.');
define('_ACTIVATE_FORGOT_MAIL',		"Bonjour <%memberName%>,\n\nEn suivant le lien ci-dessous, vous pouvez choisir un nouveau mot de passe pour votre compte sur <%siteName%> (<%siteUrl%>).\n\n\t<%activationUrl%>\n\nPassés 2 jours le lien d\'activation sera invalide.");
define('_ACTIVATE_FORGOT_MAILTITLE',	"Procédez à la réactivation de votre compte '<%memberName%>'");
define('_ACTIVATE_FORGOT_TITLE',	'Bienvenue <%memberName%>');
define('_ACTIVATE_FORGOT_TEXT',		'Vous pouvez choisir un nouveau mot de passe pour votre compte ci-dessous :');
define('_ACTIVATE_CHANGE_MAIL',		"Bonjour <%memberName%>,\n\nMaintenant que votre adresse email a été changée, vous devez réactivation de votre compte sur <%siteName%> (<%siteUrl%>).\nVous pouvez le faire en suivant le lien ci-dessous :\n\n\t<%activationUrl%>\n\nPassés 2 jours le lien d\'activation sera invalide.");
define('_ACTIVATE_CHANGE_MAILTITLE',	"Procédez à la réactivation de votre compte '<%memberName%>'");
define('_ACTIVATE_CHANGE_TITLE',	'Bienvenue <%memberName%>');
define('_ACTIVATE_CHANGE_TEXT',		'Votre changement d\'adresse email a été validé. Merci !');
define('_ACTIVATE_SUCCESS_TITLE',	'Activation réussie');
define('_ACTIVATE_SUCCESS_TEXT',	'Votre compte a été réactivé.');
define('_MEMBERS_SETPWD',		'Choisissez un mot de passe');
define('_MEMBERS_SETPWD_BTN',		'Choisissez un mot de passe');
define('_QMENU_ACTIVATE',		'Activation de compte');
define('_QMENU_ACTIVATE_TEXT',		'<p>Dès l\'activation de votre compte, vous pouvez commencer à l\'utiliser en <a href="index.php?action=showlogin">vous authentifiant</a>.</p>');

define('_PLUGS_BTN_UPDATE',		'Mettre à jour la liste des installations');

// global settings
define('_SETTINGS_JSTOOLBAR',		'Type de barre d\'édition');
define('_SETTINGS_JSTOOLBAR_FULL',	'Barre d\'édition complète (IE)');
define('_SETTINGS_JSTOOLBAR_SIMPLE',	'Barre d\'édition simplifiée (Non-IE)');
define('_SETTINGS_JSTOOLBAR_NONE',	'Désactiver la barre d\'édition');
define('_SETTINGS_URLMODE_HELP',	'(Info: <a href="documentation/tips.html#searchengines-fancyurls">activer l\'utilisation des URLs pour la recherche</a>)');

// extra plugin settings part when editing categories/members/blogs/...
define('_PLUGINS_EXTRA',		'Autres paramètres du module');

// itemlist info column keys
define('_LIST_ITEM_BLOG',		'blog:');
define('_LIST_ITEM_CAT',		'thème:');
define('_LIST_ITEM_AUTHOR',		'auteur:');
define('_LIST_ITEM_DATE',		'date:');
define('_LIST_ITEM_TIME',		'heure:');

// indication of registered members in comments list
define('_LIST_COMMENTS_MEMBER', 	'(participant)');

// batch operations
define('_BATCH_WITH_SEL',		'Ayant pour sélection:');
define('_BATCH_EXEC',			'Executer');

// quickmenu
define('_QMENU_HOME',			'Accueil');
define('_QMENU_ADD',			'Ajouter un billet');
define('_QMENU_ADD_SELECT',		'-- sélectionnez --');
define('_QMENU_USER_SETTINGS',		'Préférences');
define('_QMENU_USER_ITEMS',		'Billets');
define('_QMENU_USER_COMMENTS',		'Commentaires');
define('_QMENU_MANAGE',			'Paramètres');
define('_QMENU_MANAGE_LOG',		'Log');
define('_QMENU_MANAGE_SETTINGS',	'Configuration');
define('_QMENU_MANAGE_MEMBERS',		'Participants');
define('_QMENU_MANAGE_NEWBLOG',		'Nouveau blog');
define('_QMENU_MANAGE_BACKUPS',		'Sauvegardes');
define('_QMENU_MANAGE_PLUGINS',		'Modules');
define('_QMENU_LAYOUT',			'Mise en page');
define('_QMENU_LAYOUT_SKINS',		'Habillages');
define('_QMENU_LAYOUT_TEMPL',		'Modèles');
define('_QMENU_LAYOUT_IEXPORT',		'Importer/Exporter');
define('_QMENU_PLUGINS',		'Modules');

// quickmenu on logon screen
define('_QMENU_INTRO',			'Introduction');
define('_QMENU_INTRO_TEXT',		'<p>Ceci est la page d\'authentification de Nucleus CMS, le système permettant la mise à jour du contenu de ce site.</p><p>Pour mettre en ligne de nouveaux billets, authentifiez-vous.</p>');

// helppages for plugins
define('_ERROR_PLUGNOHELPFILE',		'Impossible de trouver le fichier d\'aide correspondant à ce module');
define('_PLUGS_HELP_TITLE',		'Page d\'aide pour le module');
define('_LIST_PLUGS_HELP', 		'aide');


// END changed/started after 3.1

// START changed/added after v2.5beta START

// general settings (security)
define('_SETTINGS_EXTAUTH',		'Activer le système d\'authentification externe');
define('_WARNING_EXTAUTH',		'Attention: à n\'activer que si nécessaire.');

// member profile
define('_MEMBERS_BYPASS',		'Utiliser le système d\'authentification externe');

// 'always include in search' blog setting (yes/no) [in v2.5beta, the 'always' part wasn't clear]
define('_EBLOG_SEARCH',			'<em>Toujours</em> inclure dans la recherche');

// END changed/added after v2.5beta

// START introduced after v2.0 START

// media library
define('_MEDIA_VIEW',			'afficher');
define('_MEDIA_VIEW_TT',		'Afficher la page (ouvrir une nouvelle fenêtre)');
define('_MEDIA_FILTER_APPLY',		'Appliquer le filtre');
define('_MEDIA_FILTER_LABEL',		'Filtre: ');
define('_MEDIA_UPLOAD_TO',		'Télécharger dans...');
define('_MEDIA_UPLOAD_NEW',		'Télécharger un nouveau fichier...');
define('_MEDIA_COLLECTION_SELECT',	'Sélectionner');
define('_MEDIA_COLLECTION_TT',		'Changer de bibliothèque');
define('_MEDIA_COLLECTION_LABEL',	'Bibliothèque actuelle: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',		'Aligner à gauche');
define('_ADD_ALIGNRIGHT_TT',		'Aligner à droite');
define('_ADD_ALIGNCENTER_TT',		'Centrer');


// generic upload failure
define('_ERROR_UPLOADFAILED',		'Echec du téléchargement');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'Permettre d\'antidater');
define('_ADD_CHANGEDATE',		'Mise à  jour  de la date');
define('_BMLET_CHANGEDATE',		'Mise à  jour de la date');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'Habillage import/export...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Normal');
define('_PARSER_INCMODE_SKINDIR',	'Utiliser un dossier d\'habillage');
define('_SKIN_INCLUDE_MODE',		'Type d\'inclusion');
define('_SKIN_INCLUDE_PREFIX',		'Préfixe d\'inclusion');

// global settings
define('_SETTINGS_BASESKIN',		'Habillage de base');
define('_SETTINGS_SKINSURL',		'URL pour l\'habillage');
define('_SETTINGS_ACTIONSURL',		'URL complet pour action.php');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'Impossible de déplacer le thème par défaut');
define('_ERROR_MOVETOSELF',		'Impossible de déplacer le thème (le blog de destination est identique au blog source)');
define('_MOVECAT_TITLE',		'Sélectionner le blog dans lequel vous souhaitez déplacer ce thème');
define('_MOVECAT_BTN',			'Déplacer le thème');

// URLMode setting
define('_SETTINGS_URLMODE',		'Type de lien');
define('_SETTINGS_URLMODE_NORMAL',	'Normal');
define('_SETTINGS_URLMODE_PATHINFO',	'Fancy');

// Batch operations
define('_BATCH_NOSELECTION',		'Aucune action sélectionnée');
define('_BATCH_ITEMS',			'Action sur les billets');
define('_BATCH_CATEGORIES',		'Action sur les thèmes');
define('_BATCH_MEMBERS',		'Action sur les participants');
define('_BATCH_TEAM',			'Action sur les participants d\'un blog');
define('_BATCH_COMMENTS',		'Action sur les commentaires');
define('_BATCH_UNKNOWN',		'Action inconnue: ');
define('_BATCH_EXECUTING',		'En cours');
define('_BATCH_ONCATEGORY',		'sur un thème');
define('_BATCH_ONITEM',			'sur un élément');
define('_BATCH_ONCOMMENT',		'sur un commentaire');
define('_BATCH_ONMEMBER',		'sur un participant');
define('_BATCH_ONTEAM',			'sur le participant du blog');
define('_BATCH_SUCCESS',		'Action réussie!');
define('_BATCH_DONE',			'Terminé!');
define('_BATCH_DELETE_CONFIRM',		'Confirmer la suppression');
define('_BATCH_DELETE_CONFIRM_BTN',	'Confirmer');
define('_BATCH_SELECTALL',		'Tout sélectionner');
define('_BATCH_DESELECTALL',		'Annuler la sélection');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'Supprimer');
define('_BATCH_ITEM_MOVE',		'Déplacer');
define('_BATCH_MEMBER_DELETE',		'Supprimer');
define('_BATCH_MEMBER_SET_ADM',		'Donner les droits d\'administrateur');
define('_BATCH_MEMBER_UNSET_ADM',	'Retirer les droits d\'administrateur');
define('_BATCH_TEAM_DELETE',		'Retirer de l\'équipe');
define('_BATCH_TEAM_SET_ADM',		'Donner les droits d\'administrateur');
define('_BATCH_TEAM_UNSET_ADM',		'Retirer les droits d\'administrateur');
define('_BATCH_CAT_DELETE',		'Supprimer');
define('_BATCH_CAT_MOVE',		'Déplacer vers un autre blog');
define('_BATCH_COMMENT_DELETE',		'Supprimer');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',		'Ajouter un nouveau billet...');
define('_ADD_PLUGIN_EXTRAS',		'Options supplémentaires des modules');

// errors
define('_ERROR_CATCREATEFAIL',		'Impossible de créer le nouveau thème');
define('_ERROR_NUCLEUSVERSIONREQ',	'Ce module requiert une version ultérieure de Nucleus: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Retour au menu de configuration des blogs');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Importation');
define('_SKINIE_TITLE_EXPORT',		'Exportation');
define('_SKINIE_BTN_IMPORT',		'Importer');
define('_SKINIE_BTN_EXPORT',		'Exporter les habillages/modèles sélectionnés');
define('_SKINIE_LOCAL',			'Importer depuis un fichier local:');
define('_SKINIE_NOCANDIDATES',		'Aucun habillage trouvé dans le répertoire skins');
define('_SKINIE_FROMURL',		'Importer à partir d\'un lien:');
define('_SKINIE_EXPORT_INTRO',		'Sélectionnez ci-dessous les habillages et modèles que vous souhaitez exporter:');
define('_SKINIE_EXPORT_SKINS',		'Habillages');
define('_SKINIE_EXPORT_TEMPLATES',	'Modèles');
define('_SKINIE_EXPORT_EXTRA',		'Notes');
define('_SKINIE_CONFIRM_OVERWRITE',	'Ecraser l\'ancienne version?');
define('_SKINIE_CONFIRM_IMPORT',	'Oui, je veux importer ceci');
define('_SKINIE_CONFIRM_TITLE',		'A propos de l\'importation d\'habillage et de modèle');
define('_SKINIE_INFO_SKINS',		'Habillages dans le fichier:');
define('_SKINIE_INFO_TEMPLATES',	'Modèles dans le fichier:');
define('_SKINIE_INFO_GENERAL',		'Notes:');
define('_SKINIE_INFO_SKINCLASH',	'Nom de l\'habillage:');
define('_SKINIE_INFO_TEMPLCLASH',	'Nom du modèle:');
define('_SKINIE_INFO_IMPORTEDSKINS',	'Habillage importé:');
define('_SKINIE_INFO_IMPORTEDTEMPLS',	'Modèle importé:');
define('_SKINIE_DONE',			'Importation réussie');

define('_AND',				'et');
define('_OR',				'ou');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'Champ vide (cliquer pour modifier)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'Type d\'inclusion:');
define('_LIST_SKINS_INCPREFIX',		'Préfixe d\'inclusion:');
define('_LIST_SKINS_DEFINED',		'Habillages définis:');

// backup
define('_BACKUPS_TITLE',		'Sauvegarde / Récupération');
define('_BACKUP_TITLE',			'Sauvegarde');
define('_BACKUP_INTRO',			'Cliquez sur le bouton ci-dessous pour créer une sauvegarde de votre base de données Nucleus. Enregistrez-la dans un fichier. Gardez-le en lieu sûr.');
define('_BACKUP_ZIP_YES',		'Essayer d\'utiliser la compression');
define('_BACKUP_ZIP_NO',		'Ne pas utiliser la compression');
define('_BACKUP_BTN',			'Sauvegarder!');
define('_BACKUP_NOTE',			'<b>NB:</b> Seul le contenu de la base de données est sauvegardé. Les fichiers Media importés et la configuration de config.php <b>NE SONT PAS</b> inclus dans la sauvegarde.');
define('_RESTORE_TITLE',		'Récupération');
define('_RESTORE_NOTE',			'<b>ATTENTION:</b> Restaurer une sauvegarde <b>EFFACERA</b> toutes les données contenues dans la base de données Nucleus! N\'agissez qu\'en connaissance de cause!<br /><b>NB:</b> Vérifiez que la version de Nucleus de votre sauvegarde soit la même que celle que vous utilisez actuellement autrement cela ne fonctionnera pas.');
define('_RESTORE_INTRO',		'Sélectionnez le fichier de récupération ci-dessous (il sera téléchargé sur le serveur) et cliquez sur le bouton "Récupération" pour procéder.');
define('_RESTORE_IMSURE',		'Oui, je suis sûr!');
define('_RESTORE_BTN',			'Récupération');
define('_RESTORE_WARNING',		'(Vérifiez que vous restaurez le bon fichier de sauvegarde. Faites une nouvelle sauvegarde avant de commencer si vous n\'êtes pas sûr.)');
define('_ERROR_BACKUP_NOTSURE',		'Vous devez cliquer sur le bouton \'je suis sûr\'');
define('_RESTORE_COMPLETE',		'Récupération terminée');

// new item notification
define('_NOTIFY_NI_MSG',		'Nouveau billet:');
define('_NOTIFY_NI_TITLE',		'Nouveau!');
define('_NOTIFY_KV_MSG',		'Votes Karma pour le billet:');
define('_NOTIFY_KV_TITLE',		'Nucleus karma:');
define('_NOTIFY_NC_MSG',		'Commentaires sur le billet:');
define('_NOTIFY_NC_TITLE',		'Commentaire Nucleus:');
define('_NOTIFY_USERID',		'Utilisateur:');
define('_NOTIFY_USER',			'Utilisateur:');
define('_NOTIFY_COMMENT',		'Commentaire:');
define('_NOTIFY_VOTE',			'Vote:');
define('_NOTIFY_HOST',			'Hôte:');
define('_NOTIFY_IP',			'IP:');
define('_NOTIFY_MEMBER',		'Participant:');
define('_NOTIFY_TITLE',			'Titre:');
define('_NOTIFY_CONTENTS',		'Contenu:');

// member mail message
define('_MMAIL_MSG',			'Vous avez reçu un message de');
define('_MMAIL_FROMANON',		'un visiteur anonyme');
define('_MMAIL_FROMNUC',		'Posté depuis un weblog Nucleus à');
define('_MMAIL_TITLE',			'Un message de');
define('_MMAIL_MAIL',			'Message:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',			'Ajouter un  billet');
define('_BMLET_EDIT',			'Modifier un billet');
define('_BMLET_DELETE',			'Effacer un billet');
define('_BMLET_BODY',			'Corps');
define('_BMLET_MORE',			'Développement');
define('_BMLET_OPTIONS',		'Options');
define('_BMLET_PREVIEW',		'Prévisualisation');

// used in bookmarklet
define('_ITEM_UPDATED',			'Billet mis à jour');
define('_ITEM_DELETED',			'Billet effacé');

// plugins
define('_CONFIRMTXT_PLUGIN',		'Etes-vous sur de vouloir supprimer ce module?');
define('_ERROR_NOSUCHPLUGIN',		'Pas de module correspondant');
define('_ERROR_DUPPLUGIN',		'Désolé, ce module est déjà installé');
define('_ERROR_PLUGFILEERROR',		'Ce module n\'existe pas, ou les permissions sont mal configurées');
define('_PLUGS_NOCANDIDATES',		'Pas de module valide trouvé');

define('_PLUGS_TITLE_MANAGE',		'Gérer les modules');
define('_PLUGS_TITLE_INSTALLED',	'Déjà installés');
define('_PLUGS_TITLE_UPDATE',		'Mettre à jour la liste des installations');
define('_PLUGS_TEXT_UPDATE',		'Nucleus garde un cache des inscriptions des modules. Quand vous mettez à jour un module en remplaçant son fichier, vous devez utiliser cette fonction pour mettre à jour le cache.');
define('_PLUGS_TITLE_NEW',		'Installer un nouveau module');
define('_PLUGS_ADD_TEXT',		'Vous trouverez ci-dessous la liste de tous les fichiers contenus dans votre répertoire de plugins. Il peut s\'agir de modules non-installés. Soyez <strong>vraiment</strong> sûr qu\'il s\'agit d\'un module avant de l\'ajouter.');
define('_PLUGS_BTN_INSTALL',		'Installer le module');
define('_BACKTOOVERVIEW',		'Retour au sommaire');

// editlink
define('_TEMPLATE_EDITLINK',		'Modifier le lien du billet');

// add left / add right tooltips
define('_ADD_LEFT_TT',			'Ajouter un cadre à gauche');
define('_ADD_RIGHT_TT',			'Ajouter un cadre à droite');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',			'Nouveau thème...');

// new settings
define('_SETTINGS_PLUGINURL',		'URL des modules');
define('_SETTINGS_MAXUPLOADSIZE',	'Taille maxi. du fichier téléchargé (bytes)');
define('_SETTINGS_NONMEMBERMSGS',	'Autoriser les non-participants à envoyer des messages');
define('_SETTINGS_PROTECTMEMNAMES',	'Protéger les noms des participants');

// overview screen
define('_OVERVIEW_PLUGINS',		'Gérer les modules...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'Inscription d\'un nouveau participant:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',		'Votre adresse email:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'Vous n\'avez pas les droits d\'admin sur les blogs de ce participant. Vous n\'êtes donc pas autorisé à télécharger de fichier sur le répertoire media de ce participant.');

// plugin list
define('_LISTS_INFO',			'Information');
define('_LIST_PLUGS_AUTHOR',		'de:');
define('_LIST_PLUGS_VER',		'Version:');
define('_LIST_PLUGS_SITE',		'Visiter le site');
define('_LIST_PLUGS_DESC',		'Description:');
define('_LIST_PLUGS_SUBS',		'Inscription aux évènements suivants:');
define('_LIST_PLUGS_UP',		'monter');
define('_LIST_PLUGS_DOWN',		'descendre');
define('_LIST_PLUGS_UNINSTALL',		'désinstaller');
define('_LIST_PLUGS_ADMIN',		'admin');
define('_LIST_PLUGS_OPTIONS',		'modifier les options');

// plugin option list
define('_LISTS_VALUE',			'Valeur');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'ce plugin n\'a pas d\'option');
define('_PLUGS_BACK',			'Retour au menu des modules');
define('_PLUGS_SAVE',			'Sauvegarder les options');
define('_PLUGS_OPTIONS_UPDATED',	'Options du module mises à jour');

define('_OVERVIEW_MANAGEMENT',		'Gestion');
define('_OVERVIEW_MANAGE',		'Gestion de Nucleus...');
define('_MANAGE_GENERAL',		'Gestion globale');
define('_MANAGE_SKINS',			'Habillages et modèles');
define('_MANAGE_EXTRA',			'Options supplémentaires');

define('_BACKTOMANAGE',			'Retour au menu de gestion de Nucleus');


// END introduced after v1.1 END





// global stuff
define('_LOGOUT',			'Déconnexion');
define('_LOGIN',			'Connexion');
define('_YES',				'Oui');
define('_NO',				'Non');
define('_SUBMIT',			'Envoyer');
define('_ERROR',			'Erreur');
define('_ERRORMSG',			'Une erreur est survenue!');
define('_BACK',				'Retour');
define('_NOTLOGGEDIN',			'Non connecté');
define('_LOGGEDINAS',			'Connecté en tant que');
define('_ADMINHOME',			'Accueil');
define('_NAME',				'Nom');
define('_BACKHOME',			'Retour à l\'accueil');
define('_BADACTION',			'Action inconnue');
define('_MESSAGE',			'Message');
define('_HELP_TT',			'Aide!');
define('_YOURSITE',			'Votre site');


define('_POPUP_CLOSE',			'Fermer la fenêtre');

define('_LOGIN_PLEASE',			'Connectez-vous d\'abord, SVP');

// commentform
define('_COMMENTFORM_YOUARE',		'Vous êtes');
define('_COMMENTFORM_SUBMIT',		'Ajouter un commentaire');
define('_COMMENTFORM_COMMENT',		'Votre commentaire');
define('_COMMENTFORM_NAME',		'Nom');
define('_COMMENTFORM_MAIL',		'Email/HTTP');
define('_COMMENTFORM_REMEMBER',		'Retenir votre nom');

// loginform
define('_LOGINFORM_NAME',		'Nom d\'utilisateur');
define('_LOGINFORM_PWD',		'Mot de passe');
define('_LOGINFORM_YOUARE',		'Connecté en tant que');
define('_LOGINFORM_SHARED',		'Ordinateur partagé');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'Envoyer un message');

// search form
define('_SEARCHFORM_SUBMIT',		'Rechercher');

// add item form
define('_ADD_ADDTO',			'Ajouter un billet à');
define('_ADD_CREATENEW',		'Créer un nouveau billet');
define('_ADD_BODY',			'Corps');
define('_ADD_TITLE',			'Titre');
define('_ADD_MORE',			'Développement (facultatif)');
define('_ADD_CATEGORY',			'Thème');
define('_ADD_PREVIEW',			'Prévisualisation');
define('_ADD_DISABLE_COMMENTS',		'Interdire les commentaires?');
define('_ADD_DRAFTNFUTURE',		'Brouillons &amp; billets à venir');
define('_ADD_ADDITEM',			'Ajouter le billet');
define('_ADD_ADDNOW',			'Ajouter maintenant');
define('_ADD_ADDLATER',			'Ajouter plus tard');
define('_ADD_PLACE_ON',			'Daté du');
define('_ADD_ADDDRAFT',			'Ajouter aux brouillons');
define('_ADD_NOPASTDATES',		'(Les dates et heures passées ne sont pas valides, la date d\'aujourd\'hui sera utilisée)');
define('_ADD_BOLD_TT',			'Gras');
define('_ADD_ITALIC_TT',		'Italiques');
define('_ADD_HREF_TT',			'Faire un lien');
define('_ADD_MEDIA_TT',			'Ajouter un document');
define('_ADD_PREVIEW_TT',		'Montrer/cacher la prévisualisation');
define('_ADD_CUT_TT',			'Couper');
define('_ADD_COPY_TT',			'Copier');
define('_ADD_PASTE_TT',			'Coller');


// edit item form
define('_EDIT_ITEM',			'Modifier le billet');
define('_EDIT_SUBMIT',			'Valider');
define('_EDIT_ORIG_AUTHOR',		'Auteur');
define('_EDIT_BACKTODRAFTS',		'Remettre aux brouillons');
define('_EDIT_COMMENTSNOTE',		'(NB: Désactiver les commentaires ne cachera pas les anciens)');

// used on delete screens
define('_DELETE_CONFIRM',		'SVP, confirmez la suppression');
define('_DELETE_CONFIRM_BTN',		'Confirmer');
define('_CONFIRMTXT_ITEM',		'Vous allez effacer le billet suivant:');
define('_CONFIRMTXT_COMMENT',		'Vous allez effacer le commentaire suivant:');
define('_CONFIRMTXT_TEAM1',		'Vous allez effacer ');
define('_CONFIRMTXT_TEAM2',		' de l\'équipe pour le blog ');
define('_CONFIRMTXT_BLOG',		'Le blog que vous allez effacer est: ');
define('_WARNINGTXT_BLOGDEL',		'Attention! Effacer un blog effarcera TOUS les billets de ce blog et tous les commentaires associés. Soyez certain de ne pas faire erreur. <br />Et n\'interrompez pas le processus.');
define('_CONFIRMTXT_MEMBER',		'Vous allez effacer le profil du participant suivant: ');
define('_CONFIRMTXT_TEMPLATE',		'Vous allez effacer le modèle  ');
define('_CONFIRMTXT_SKIN',		'Vous allez effacer l\'habillage ');
define('_CONFIRMTXT_BAN',		'Vous allez annuler l\'exclusion de la plage IP');
define('_CONFIRMTXT_CATEGORY',		'Vous allez effacer le thème ');

// some status messages
define('_DELETED_ITEM',			'Billet supprimé');
define('_DELETED_MEMBER',		'Participant effacé');
define('_DELETED_COMMENT',		'Commentaire supprimé');
define('_DELETED_BLOG',			'Blog effacé');
define('_DELETED_CATEGORY',		'Categorie supprimée');
define('_ITEM_MOVED',			'Billet déplacé');
define('_ITEM_ADDED',			'Billet ajouté');
define('_COMMENT_UPDATED',		'Commentaire mis à jour');
define('_SKIN_UPDATED',			'Habillage modifié');
define('_TEMPLATE_UPDATED',		'Modèle modifié');

// errors
define('_ERROR_COMMENT_LONGWORD',	'SVP, n\'employez pas de mot de plus de 90 caractères dans votre commentaire');
define('_ERROR_COMMENT_NOCOMMENT',	'Tapez votre commentaire');
define('_ERROR_COMMENT_NOUSERNAME',	'Nom invalide');
define('_ERROR_COMMENT_TOOLONG',	'Votre commentaire est trop long (max. 5000 cars)');
define('_ERROR_COMMENTS_DISABLED',	'Les commentaires sur ce blog sont actuellement désactivés.');
define('_ERROR_COMMENTS_NONPUBLIC',	'Vous devez être connecté en tant que participant pour pouvoir commenter ce blog.');
define('_ERROR_COMMENTS_MEMBERNICK',	'Ce nom est déjà utilisé par un participant du blog. Choisissez autre chose.');
define('_ERROR_SKIN',			'Erreur d\'habillage');
define('_ERROR_ITEMCLOSED',		'Ce billet est protégé. Il n\'est pas possible de le commenter ni de voter pour lui.');
define('_ERROR_NOSUCHITEM',		'Billet inexistant');
define('_ERROR_NOSUCHBLOG',		'Blog inexistant');
define('_ERROR_NOSUCHSKIN',		'Habillage inexistant');
define('_ERROR_NOSUCHMEMBER',		'Participant inexistant');
define('_ERROR_NOTONTEAM',		'Vous n\'appartenez pas à l\'équipe de ce blog.');
define('_ERROR_BADDESTBLOG',		'Le blog de destination n\'existe pas.');
define('_ERROR_NOTONDESTTEAM',		'Impossible de déplacer le billet car vous ne faites pas partie de l\'équipe du blog de destination.');
define('_ERROR_NOEMPTYITEMS',		'Impossible d\'ajouter un billet vide!');
define('_ERROR_BADMAILADDRESS',		'Adresse email incorrecte');
define('_ERROR_BADNOTIFY',		'Adresse(s) de notification incorrecte(s)');
define('_ERROR_BADNAME',		'Nom incorrect (seuls les lettres de a à z et les chiffres de 0 à 9 sont autorisés, sans espace au début ni à la fin)');
define('_ERROR_NICKNAMEINUSE',		'Un autre participant utilise déjà ce nom');
define('_ERROR_PASSWORDMISMATCH',	'Les mots de passe doivent correspondre');
define('_ERROR_PASSWORDTOOSHORT',	'Le mot de passe doit commprendre au moins 6 caractères');
define('_ERROR_PASSWORDMISSING',	'Il FAUT un mot de passe');
define('_ERROR_REALNAMEMISSING',	'Vous devez inscrire votre nom');
define('_ERROR_ATLEASTONEADMIN',	'Il doit toujours y avoir un super admin qui puisse se connecter.');
define('_ERROR_ATLEASTONEBLOGADMIN',	'Cela empêcherait la gestion de votre blog. Assurez-vous qu\'il y ait toujours au-moins un administrateur.');
define('_ERROR_ALREADYONTEAM',		'Ce participant est déjà dans l\'équipe');
define('_ERROR_BADSHORTBLOGNAME',	'Le diminutif du blog ne peut contenir que des lettres de a à z et des chiffres de 0 à 9, sans espace.');
define('_ERROR_DUPSHORTBLOGNAME',	'Un autre blog utilise déjà ce diminutif. Les diminutifs doivent être uniques.');
define('_ERROR_UPDATEFILE',		'Impossible de mettre à jour le fichier. Vérifiez le réglage de permissions d\'écriture (faites un chmod 666). Remarquez aussi que le chemin est relatif au répertoire de la zone admin ; vous devriez utiliser un chemin absolu (quelque chose comme /votre/chemin/vers/nucleus/)');
define('_ERROR_DELDEFBLOG',		'Impossible d\'effacer le blog par défaut');
define('_ERROR_DELETEMEMBER',		'Impossible de supprimer ce participant car il est probablement l\'auteur de billets ou de commentaires.');
define('_ERROR_BADTEMPLATENAME',	'Nom de modèle incorrect, n\'utilisez que des lettres de a à z et des chiffres de 0 à 9, sans espace.');
define('_ERROR_DUPTEMPLATENAME',	'Il existe déjà un modèle de ce nom');
define('_ERROR_BADSKINNAME',		'Nom d\'habillage incorrect, n\'utilisez que des lettres de a à z et des chiffres de 0 à 9, sans espace.');
define('_ERROR_DUPSKINNAME',		'Il existe déjà un habillage de ce nom');
define('_ERROR_DEFAULTSKIN',		'Il doit toujours subsister un habillage nommé "default"');
define('_ERROR_SKINDEFDELETE',		'Impossible de supprimer l\'habillage car il s\'agit de l\'habillage par défaut du blog: ');
define('_ERROR_DISALLOWED',		'Vous n\'êtes pas autorisé à faire cela');
define('_ERROR_DELETEBAN',		'Erreur en essayant de supprimer l\'exclusion (elle n\'existe pas)');
define('_ERROR_ADDBAN',			'Erreur en essayant d\'ajouter l\'exclusion. L\'exclusion n\'a pas été ajoutée correctement dans tous vos blogs.');
define('_ERROR_BADACTION',		'L\'action demandée n\'existe pas');
define('_ERROR_MEMBERMAILDISABLED',	'Messages de participant à participant désactivés');
define('_ERROR_MEMBERCREATEDISABLED',	'Creation de nouveaux comptes désactivée');
define('_ERROR_INCORRECTEMAIL',		'Email incorrect');
define('_ERROR_VOTEDBEFORE',		'Vous avez déjà voté pour ce billet');
define('_ERROR_BANNED1',		'Action impossible car vous (plage IP ');
define('_ERROR_BANNED2',			') êtes exclu. Le message était: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'Vous devez être connecté pour faire cela');
define('_ERROR_CONNECT',		'Erreur de connexion');
define('_ERROR_FILE_TOO_BIG',		'Fichier trop gros!');
define('_ERROR_BADFILETYPE',		'Désolé, cette extension n\'est pas autorisée');
define('_ERROR_BADREQUEST',		'Mauvaise demande de téléchargement');
define('_ERROR_DISALLOWEDUPLOAD',	'Vous ne faites partie d\'aucune équipe. Vous n\'êtes donc pas autorisé à télécharger des fichiers.');
define('_ERROR_BADPERMISSIONS',		'Les permissions de fichiers/répertoires ne sont pas correctement configurées');
define('_ERROR_UPLOADMOVEP',		'Erreur de déplacement de fichier');
define('_ERROR_UPLOADCOPY',		'Erreur de copie de fichier');
define('_ERROR_UPLOADDUPLICATE',	'Un fichier de ce nom existe déjà. Essayez de le renommer avant de le télécharger.');
define('_ERROR_LOGINDISALLOWED',	'Désolé, vous n\'êtes pas autorisé à vous connecter à la zone admin. Vous pouvez vous connecter sous un autre nom');
define('_ERROR_DBCONNECT',		'Impossible de se connecter au serveur mySQL');
define('_ERROR_DBSELECT',		'Impossible de sélectionner la base Nucleus.');
define('_ERROR_NOSUCHLANGUAGE',		'Fichier de langue indisponible');
define('_ERROR_NOSUCHCATEGORY',		'Thème indisponible');
define('_ERROR_DELETELASTCATEGORY',	'Il doit y avoir au moins un thème');
define('_ERROR_DELETEDEFCATEGORY',	'Impossible d\'effacerle thème par défaut');
define('_ERROR_BADCATEGORYNAME',	'Nom de thème incorrect');
define('_ERROR_DUPCATEGORYNAME',	'Ce thème existe déjà');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',		'Attention: ceci n\'est pas un répertoire!');
define('_WARNING_NOTREADABLE',		'Attention: ceci n\'est pas un répertoire avec droit de lecture!');
define('_WARNING_NOTWRITABLE',		'Attention: ceci n\'est pas un répertoire avec droit d\'écriture!');

// media and upload
define('_MEDIA_UPLOADLINK',		'Télécharger un nouveau fichier');
define('_MEDIA_MODIFIED',		'modifié');
define('_MEDIA_FILENAME',		'nom de fichier');
define('_MEDIA_DIMENSIONS',		'dimensions');
define('_MEDIA_INLINE',			'Inséré');
define('_MEDIA_POPUP',			'Popup');
define('_UPLOAD_TITLE',			'Choisir le fichier');
define('_UPLOAD_MSG',			'Sélectionnez le fichier à télécharger ci-dessous et pressez le bouton \'Télécharger\'.');
define('_UPLOAD_BUTTON',		'Télécharger');

// some status messages
//define('_MSG_ACCOUNTCREATED',		'Compte créé, le mot de passe sera envoyé par email');
//define('_MSG_PASSWORDSENT',		'Mot de passe envoyé par email');
define('_MSG_LOGINAGAIN',		'Vous devrez vous reconnecter car vos informations ont changé');
define('_MSG_SETTINGSCHANGED',		'Réglages modifiés');
define('_MSG_ADMINCHANGED',		'Admin changé');
define('_MSG_NEWBLOG',			'Nouveau blog créé');
define('_MSG_ACTIONLOGCLEARED',		'Journal effacé');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'Action interdite: ');
define('_ACTIONLOG_PWDREMINDERSENT',	'Nouveau mot de passe envoyé pour ');
define('_ACTIONLOG_TITLE',		'Journal des événements');
define('_ACTIONLOG_CLEAR_TITLE',	'Effacer le journal des événements');
define('_ACTIONLOG_CLEAR_TEXT',		'Effacer le journal des événements maintenant');

// team management
define('_TEAM_TITLE',			'Gérer les participants ');
define('_TEAM_CURRENT',			'Equipe actuelle');
define('_TEAM_ADDNEW',			'Ajouter un participant');
define('_TEAM_CHOOSEMEMBER',		'Choisir un participant');
define('_TEAM_ADMIN',			'Privilèges d\'administrateur? ');
define('_TEAM_ADD',			'Ajouter à l\'équipe');
define('_TEAM_ADD_BTN',			'Ajouter!');

// blogsettings
define('_EBLOG_TITLE',			'Modifier les réglages du blog');
define('_EBLOG_TEAM_TITLE',		'Modifier l\'équipe');
define('_EBLOG_TEAM_TEXT',		'Cliquez ici pour modifier votre équipe...');
define('_EBLOG_SETTINGS_TITLE',		'Réglages du blog');
define('_EBLOG_NAME',			'Nom du blog');
define('_EBLOG_SHORTNAME',		'Diminutif');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(seulement de a à z et sans espace)');
define('_EBLOG_DESC',			'Description');
define('_EBLOG_URL',			'URL');
define('_EBLOG_DEFSKIN',		'Habillage par défaut');
define('_EBLOG_DEFCAT',			'Thème par défaut');
define('_EBLOG_LINEBREAKS',		'Convertir les sauts de ligne');
define('_EBLOG_DISABLECOMMENTS',	'Activer les commentaires?<br /><small>(Cela signifie qu\'il sera impossible d\'en ajouter.)</small>');
define('_EBLOG_ANONYMOUS',		'Autoriser les commentaires par des non-participants?');
define('_EBLOG_NOTIFY',			'Adresse(s) de notification (séparées par des ;)');
define('_EBLOG_NOTIFY_ON',		'Notification activée');
define('_EBLOG_NOTIFY_COMMENT',		'Nouveaux commentaires');
define('_EBLOG_NOTIFY_KARMA',		'Nouveaux votes karma');
define('_EBLOG_NOTIFY_ITEM',		'Nouveau billet');
define('_EBLOG_PING',			'Pinger Weblogs.com à la mise à jour?');
define('_EBLOG_MAXCOMMENTS',		'Nombre maximum de commentaires');
define('_EBLOG_UPDATE',			'Fichier de mise-à-jour');
define('_EBLOG_OFFSET',			'Décalage horaire');
define('_EBLOG_STIME',			'Heure du serveur:');
define('_EBLOG_BTIME',			'Heure du blog:');
define('_EBLOG_CHANGE',			'Changer les réglages');
define('_EBLOG_CHANGE_BTN',		'Valider');
define('_EBLOG_ADMIN',			'Gérer le blog');
define('_EBLOG_ADMIN_MSG',		'Les privilèges d\'administrateur vous seront attribués');
define('_EBLOG_CREATE_TITLE',		'Créer un nouveau blog');
define('_EBLOG_CREATE_TEXT',		'Remplissez le formulaire ci-dessous pour créer un nouveau blog. <br /><br /> <b>NB:</b> Seules les options nécessaires sont listées. Pour plus d\'options, changez les paramètres après la création.');
define('_EBLOG_CREATE',			'Créer le blog');
define('_EBLOG_CREATE_BTN',		'Créer');
define('_EBLOG_CAT_TITLE',		'Thèmes');
define('_EBLOG_CAT_NAME',		'Thèmes');
define('_EBLOG_CAT_DESC',		'Description du thème');
define('_EBLOG_CAT_CREATE',		'Créer un nouveau thème');
define('_EBLOG_CAT_UPDATE',		'Mettre à jour le thème');
define('_EBLOG_CAT_UPDATE_BTN',		'Mettre à jour le thème');

// templates
define('_TEMPLATE_TITLE',		'Modifier les modèles');
define('_TEMPLATE_AVAILABLE_TITLE',	'Modèles disponibles');
define('_TEMPLATE_NEW_TITLE',		'Nouveau modèle');
define('_TEMPLATE_NAME',		'Nom du modèle');
define('_TEMPLATE_DESC',		'Description du modèle');
define('_TEMPLATE_CREATE',		'Créer le modèle');
define('_TEMPLATE_CREATE_BTN',		'Créer le modèle');
define('_TEMPLATE_EDIT_TITLE',		'Modifier le modèle');
define('_TEMPLATE_BACK',		'Retour au sommaire des modèles');
define('_TEMPLATE_EDIT_MSG',		'Tous les éléments de modèle ne sont pas nécessaires. Laissez vides ceux dont vous n\'avez pas besoin');
define('_TEMPLATE_SETTINGS',		'Réglages de modèle');
define('_TEMPLATE_ITEMS',		'Billet');
define('_TEMPLATE_ITEMHEADER',		'En-tête du billet');
define('_TEMPLATE_ITEMBODY',		'Corps du billet');
define('_TEMPLATE_ITEMFOOTER',		'Pied du billet');
define('_TEMPLATE_MORELINK',		'Lien vers le développement');
define('_TEMPLATE_NEW',			'Indication de nouveau billet');
define('_TEMPLATE_COMMENTS_ANY',	'Commentaires (si nécessaire)');
define('_TEMPLATE_CHEADER',		'En-tête des commentaires');
define('_TEMPLATE_CBODY',		'Corps des commentaires');
define('_TEMPLATE_CFOOTER',		'Pied des commentaires');
define('_TEMPLATE_CONE',		'Un seul commentaire');
define('_TEMPLATE_CMANY',		'Deux (ou plus) commentaires');
define('_TEMPLATE_CMORE',		'Commentaires: en voir plus');
define('_TEMPLATE_CMEXTRA',		'Infos participant');
define('_TEMPLATE_COMMENTS_NONE',	'Commentaire (si aucun)');
define('_TEMPLATE_CNONE',		'Pas de commentaire');
define('_TEMPLATE_COMMENTS_TOOMUCH',	'Commentaires (s\'il y en a, mais trop pour les montrer tous)');
define('_TEMPLATE_CTOOMUCH',		'Trop de commentaires');
define('_TEMPLATE_ARCHIVELIST',		'Listes d\'archives');
define('_TEMPLATE_AHEADER',		'En-tête d\'archives');
define('_TEMPLATE_AITEM',		'Archive (billet)');
define('_TEMPLATE_AFOOTER',		'Pied de liste d\'archives');
define('_TEMPLATE_DATETIME',		'Date et heure');
define('_TEMPLATE_DHEADER',		'En-tête de date');
define('_TEMPLATE_DFOOTER',		'Pied de date');
define('_TEMPLATE_DFORMAT',		'Format de la date');
define('_TEMPLATE_TFORMAT',		'Format de l\'heure');
define('_TEMPLATE_LOCALE',		'Locale');
define('_TEMPLATE_IMAGE',		'Fenêtre popup');
define('_TEMPLATE_PCODE',		'Code de lien popup');
define('_TEMPLATE_ICODE',		'Code d\'image insérée');
define('_TEMPLATE_MCODE',		'Code lien objet media');
define('_TEMPLATE_SEARCH',		'Recherche');
define('_TEMPLATE_SHIGHLIGHT',		'Surbrillance');
define('_TEMPLATE_SNOTFOUND',		'Rien trouvé');
define('_TEMPLATE_UPDATE',		'Mettre à jour');
define('_TEMPLATE_UPDATE_BTN',		'Mettre à jour le modème');
define('_TEMPLATE_RESET_BTN',		'Rétablir les données');
define('_TEMPLATE_CATEGORYLIST',	'Listes de thèmes');
define('_TEMPLATE_CATHEADER',		'En-tête de liste de thèmes');
define('_TEMPLATE_CATITEM',		'Liste des thèmes (billet)');
define('_TEMPLATE_CATFOOTER',		'Pied de liste de thèmes');

// skins
define('_SKIN_EDIT_TITLE',		'Modification des habillages');
define('_SKIN_AVAILABLE_TITLE',		'Habillages disponibles');
define('_SKIN_NEW_TITLE',		'Nouvel habillage');
define('_SKIN_NAME',			'Nom');
define('_SKIN_DESC',			'Description');
define('_SKIN_TYPE',			'Type de contenu');
define('_SKIN_CREATE',			'Créer l\'habillage');
define('_SKIN_CREATE_BTN',		'Créer');
define('_SKIN_EDITONE_TITLE',		'Modifier l\'habillage');
define('_SKIN_BACK',			'Retour au menu habillage');
define('_SKIN_PARTS_TITLE',		'Elements d\'habillage');
define('_SKIN_PARTS_MSG',		'Tous les éléments ne sont pas requis. Laissez vides ceux dont vous n\'avez pas esoin. Choisissez ci-dessous l\'élément d\'habillage à modifier:');
define('_SKIN_PART_MAIN',		'Page index');
define('_SKIN_PART_ITEM',		'Page billet');
define('_SKIN_PART_ALIST',		'Liste des archives');
define('_SKIN_PART_ARCHIVE',		'Archive');
define('_SKIN_PART_SEARCH',		'Recherche');
define('_SKIN_PART_ERROR',		'Erreurs');
define('_SKIN_PART_MEMBER',		'Fiches des participants');
define('_SKIN_PART_POPUP',		'Fenêtres Popups');
define('_SKIN_GENSETTINGS_TITLE',	'Réglages d\'ensemble');
define('_SKIN_CHANGE',			'Modifier');
define('_SKIN_CHANGE_BTN',		'Modifier ces réglages');
define('_SKIN_UPDATE_BTN',		'Mettre à jour');
define('_SKIN_RESET_BTN',		'Rétablir');
define('_SKIN_EDITPART_TITLE',		'Modifier l\'habillage');
define('_SKIN_GOBACK',			'Retour');
define('_SKIN_ALLOWEDVARS',		'Variables autorisées (cliquer pour info):');

// global settings
define('_SETTINGS_TITLE',		'Réglages d\'ensemble');
define('_SETTINGS_SUB_GENERAL',		'Réglages d\'ensemble');
define('_SETTINGS_DEFBLOG',		'Blog par défaut');
define('_SETTINGS_ADMINMAIL',		'Email de l\'administrateur');
define('_SETTINGS_SITENAME',		'Nom du site');
define('_SETTINGS_SITEURL',		'URL du site (terminé par un /)');
define('_SETTINGS_ADMINURL',		'URL de la zone admin (terminé par un /)');
define('_SETTINGS_DIRS',		'Répertoires Nucleus');
define('_SETTINGS_MEDIADIR',		'Répertoire media');
define('_SETTINGS_SEECONFIGPHP',	'(voir config.php)');
define('_SETTINGS_MEDIAURL',		'URL du repertoire media (terminé par un /)');
define('_SETTINGS_ALLOWUPLOAD',		'Autoriser le téléchargement ascendant de fichier?');
define('_SETTINGS_ALLOWUPLOADTYPES',	'Indiquer les extensions de fichier autorisées');
define('_SETTINGS_CHANGELOGIN',		'Autoriser les participants à changer de login/mot de passe?');
define('_SETTINGS_COOKIES_TITLE',	'Paramètres des cookies');
define('_SETTINGS_COOKIELIFE',		'Durée de vie du cookie de connexion');
define('_SETTINGS_COOKIESESSION',	'Cookies de session');
define('_SETTINGS_COOKIEMONTH',		'Durée de vie d\'un mois');
define('_SETTINGS_COOKIEPATH',		'Chemin du cookie (utilisateur averti)');
define('_SETTINGS_COOKIEDOMAIN',	'Domaine du cookie (utilisateur averti)');
define('_SETTINGS_COOKIESECURE',	'Cookie de sécurité (utilisateur averti)');
define('_SETTINGS_LASTVISIT',		'Garder les cookies de la dernière visite');
define('_SETTINGS_ALLOWCREATE',		'Autoriser les visiteurs à créer un compte');
define('_SETTINGS_NEWLOGIN',		'Connexion autorisée pour les comptes créés par des utilisateurs');
define('_SETTINGS_NEWLOGIN2',		'(ne vaut que pour les comptes récemment créés)');
define('_SETTINGS_MEMBERMSGS',		'Autoriser les services de participant à participant');
define('_SETTINGS_LANGUAGE',		'Langue par défaut');
define('_SETTINGS_DISABLESITE',		'Désactiver le site');
define('_SETTINGS_DBLOGIN',		'mySQL Login &amp; Database');
define('_SETTINGS_UPDATE',		'Mettre à jour les réglages');
define('_SETTINGS_UPDATE_BTN',		'Mettre à jour');
define('_SETTINGS_DISABLEJS',		'Désactiver la barre d\'outils JavaScript');
define('_SETTINGS_MEDIA',		'Paramètres de téléchargement de médias');
define('_SETTINGS_MEDIAPREFIX',		'Préfixer le nom des fichiers avec la date');
define('_SETTINGS_MEMBERS',		'Réglages des participants');

// bans
define('_BAN_TITLE',			'Liste des exclusions pour');
define('_BAN_NONE',			'Pas d\'exclusion pour ce blog');
define('_BAN_NEW_TITLE',		'Ajouter une exclusion');
define('_BAN_NEW_TEXT',			'Ajouter une exclusion maintenant');
define('_BAN_REMOVE_TITLE',		'Retirer une exclusion');
define('_BAN_IPRANGE',			'Plage IP');
define('_BAN_BLOGS',			'Quels blogs?');
define('_BAN_DELETE_TITLE',		'Supprimer une exclusion');
define('_BAN_ALLBLOGS',			'Tous les blogs dont vous êtes administrateur.');
define('_BAN_REMOVED_TITLE',		'Exclusion supprimée');
define('_BAN_REMOVED_TEXT',		'L\'exclusion a été supprimée pour les blogs suivants:');
define('_BAN_ADD_TITLE',		'Définir des exclusions');
define('_BAN_IPRANGE_TEXT',		'Choisissez la plage IP que vous voulez bloquer. Moins il y aura de nombres, plus il y aura d\'IP bloquées.');
define('_BAN_BLOGS_TEXT',		'Vous pouvez choisir d\'exclure une IP pour un blog seulement ou pour tous ceux dont vous êtes admin. Choisissez ici.');
define('_BAN_REASON_TITLE',		'Motif');
define('_BAN_REASON_TEXT',		'Vous pouvez motiver l\'exclusion: La raison s\'affichera quand l\'IP concernée essaiera d\'ajouter un commentaire ou un vote. Longueur max. 256 caractères.');
define('_BAN_ADD_BTN',			'Exclure');

// LOGIN screen
define('_LOGIN_MESSAGE',		'Message');
define('_LOGIN_NAME',			'Nom');
define('_LOGIN_PASSWORD',		'Mot de passe');
define('_LOGIN_SHARED',			_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',			'Mot de passe oublié?');

// membermanagement
define('_MEMBERS_TITLE',		'Gestion des participants');
define('_MEMBERS_CURRENT',		'Participants actuels');
define('_MEMBERS_NEW',			'Nouveau participant');
define('_MEMBERS_DISPLAY',		'Nom affiché');
define('_MEMBERS_DISPLAY_INFO',		'(C\'est le nom que vous utilisez pour vous connecter)');
define('_MEMBERS_REALNAME',		'Nom');
define('_MEMBERS_PWD',			'Mot de passe');
define('_MEMBERS_REPPWD',		'Répéter le mot de passe');
define('_MEMBERS_EMAIL',		'Adresse email');
define('_MEMBERS_EMAIL_EDIT',		'(Quand vous changez d\'adresse email, un nouveau mot de passe est envoyé à cette adresse)');
define('_MEMBERS_URL',			'Adresse du site (URL)');
define('_MEMBERS_SUPERADMIN',		'Privilèges de super admin');
define('_MEMBERS_CANLOGIN',		'Peut ouvrir une session comme admin');
define('_MEMBERS_NOTES',		'Notes');
define('_MEMBERS_NEW_BTN',		'Ajouter un participant');
define('_MEMBERS_EDIT',			'Modifier les participants');
define('_MEMBERS_EDIT_BTN',		'Modifier');
define('_MEMBERS_BACKTOOVERVIEW',	'Retour au sommaire des participants');
define('_MEMBERS_DEFLANG',		'Langue');
define('_MEMBERS_USESITELANG',		'- utiliser les réglages du site -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'Visiter le site');
define('_BLOGLIST_ADD',			'Ajouter un billet');
define('_BLOGLIST_TT_ADD',		'Ajouter un billet à ce blog');
define('_BLOGLIST_EDIT',		'Modifier/Supprimer les billets');
define('_BLOGLIST_TT_EDIT',		'');
define('_BLOGLIST_BMLET',		'Bookmarklet');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'Paramètres');
define('_BLOGLIST_TT_SETTINGS',		'Modifier réglages ou gérer équipe');
define('_BLOGLIST_BANS',		'Exclusions');
define('_BLOGLIST_TT_BANS',		'Consulter, ajouter ou supprimer les exclusions IP');
define('_BLOGLIST_DELETE',		'Tout effacer');
define('_BLOGLIST_TT_DELETE',		'Effacer ce blog');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',		'Vos blogs');
define('_OVERVIEW_YRDRAFTS',		'Vos brouillons');
define('_OVERVIEW_YRSETTINGS',		'Vos réglages');
define('_OVERVIEW_GSETTINGS',		'Réglages d\'ensemble');
define('_OVERVIEW_NOBLOGS',		'Vous ne faites partie d\'aucune équipe');
define('_OVERVIEW_NODRAFTS',		'Pas  de brouillon');
define('_OVERVIEW_EDITSETTINGS',	'Modifier vos réglages...');
define('_OVERVIEW_BROWSEITEMS',		'Consulter vos billets...');
define('_OVERVIEW_BROWSECOMM',		'Consulter vos commentaires...');
define('_OVERVIEW_VIEWLOG',		'Consulter le journal des événements...');
define('_OVERVIEW_MEMBERS',		'Gérer les participants...');
define('_OVERVIEW_NEWLOG',		'Créer un nouveau blog...');
define('_OVERVIEW_SETTINGS',		'Modifier les réglages...');
define('_OVERVIEW_TEMPLATES',		'Modifier les modèles...');
define('_OVERVIEW_SKINS',		'Modifier les habillages...');
define('_OVERVIEW_BACKUP',		'Sauvegarde/Récupération...');

// ITEMLIST
define('_ITEMLIST_BLOG',		'Billets du blog');
define('_ITEMLIST_YOUR',		'Vos billets');

// Comments
define('_COMMENTS',			'Commentaires');
define('_NOCOMMENTS',			'Pas de commentaire pour ce billet');
define('_COMMENTS_YOUR',		'Vos commentaires');
define('_NOCOMMENTS_YOUR',		'Vous n\'avez pas écrit de commentaire');

// LISTS (general)
define('_LISTS_NOMORE',			'Rien de plus ou pas de résultat du tout');
define('_LISTS_PREV',			'Précédent');
define('_LISTS_NEXT',			'Suivant');
define('_LISTS_SEARCH',			'Rechercher');
define('_LISTS_CHANGE',			'Changer');
define('_LISTS_PERPAGE',		'billets/page');
define('_LISTS_ACTIONS',		'Actions');
define('_LISTS_DELETE',			'Supprimer');
define('_LISTS_EDIT',			'Modifier');
define('_LISTS_MOVE',			'Déplacer');
define('_LISTS_CLONE',			'Dupliquer');
define('_LISTS_TITLE',			'Titre');
define('_LISTS_BLOG',			'Blog');
define('_LISTS_NAME',			'Nom');
define('_LISTS_DESC',			'Description');
define('_LISTS_TIME',			'Heure');
define('_LISTS_COMMENTS',		'Commentaires');
define('_LISTS_TYPE',			'Type');


// member list
define('_LIST_MEMBER_NAME',		'Nom affiché');
define('_LIST_MEMBER_RNAME',		'Nom');
define('_LIST_MEMBER_ADMIN',		'Super admin? ');
define('_LIST_MEMBER_LOGIN',		'Peut se connecter? ');
define('_LIST_MEMBER_URL',		'Site');

// banlist
define('_LIST_BAN_IPRANGE',		'Plage IP');
define('_LIST_BAN_REASON',		'Motif');

// actionlist
define('_LIST_ACTION_MSG',		'Message');

// commentlist
define('_LIST_COMMENT_BANIP',		'Exclure l\'IP');
define('_LIST_COMMENT_WHO',		'Auteur');
define('_LIST_COMMENT',			'Commentaire');
define('_LIST_COMMENT_HOST',		'Hôte');

// itemlist
define('_LIST_ITEM_INFO',		'Info');
define('_LIST_ITEM_CONTENT',		'Titre et contenu');


// teamlist
define('_LIST_TEAM_ADMIN',		'Admin ');
define('_LIST_TEAM_CHADMIN',		'Changer l\'admin');

// edit comments
define('_EDITC_TITLE',			'Modifier les commentaires');
define('_EDITC_WHO',			'Auteur');
define('_EDITC_HOST',			'D\'où?');
define('_EDITC_WHEN',			'Quand?');
define('_EDITC_TEXT',			'Contenu');
define('_EDITC_EDIT',			'Modifier le commentaire');
define('_EDITC_MEMBER',			'participant');
define('_EDITC_NONMEMBER',		'non participant');

// move item
define('_MOVE_TITLE',			'Déplacer dans quel blog?');
define('_MOVE_BTN',			'Déplacer le billet');

