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
try_define('_CHARSET', 'UTF-8'); // charset to use
try_define('_LOCALE', 'fr_FR');
try_define('_LOCALE_NAME_WINDOWS', 'french');
try_define('_HTML_5_LANG_CODE', 'fr');

/********************************************
 *        Admin Links Settings                *
 ********************************************/
try_define('_MANAGE_LINKS_ITEMS', '<li><a href="http://nucleuscms.org" title="Nucleus CMS Home">nucleuscms.org</a></li>
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
try_define('_SETTINGS_ENABLE_RSS',          'Enable RSS output');

try_define('_ERROR_NOSUCHPAGE',				'No such page');
try_define('_SKIN_PARTS_SPECIAL_PAGE',     'Special skin page');
try_define('_CONFIRMTXT_SKIN_PARTS_SPECIAL_PAGE',  'Do you really want to delete this special skin page?');
try_define('_CONFIRMTXT_SKIN_PARTS_SPECIAL_STYPE_CHANGE',  'Do you really want to change this special skin parts type?');
try_define('_ERROR_SKIN_PARTS_SPECIAL_NOT_EXIST',          'There are no special skin parts.');
try_define('_ERROR_SKIN_PARTS_SPECIAL_PAGE_NOT_EXIST',     'There are no special skin page.');
try_define('_ERROR_SKIN_PARTS_SPECIAL_STYPE_CHANGE',       'can not change the type of special skin part');
try_define('_ERROR_SKIN_PARTS_SPECIAL_PAGE_STYPE_CHANGE',  'can not change the type of special skin page');
try_define('_ADMIN_TEXT_CHANGE_CONFIRM',     'Please check the change');
try_define('_ADMIN_TEXT_CHANGE',             'change');
try_define('_ADMIN_TEXT_SKIN_PARTS_CHANGE_TO_PAGE',     'Change to special skin page');
try_define('_ADMIN_TEXT_SKIN_PARTS_CHANGE_TO_PARTS',    'Change to special skin part');

try_define('_ADMIN_TEXT_UPGRADE_REQUIRED',       'Database upgrade is required.');
try_define('_ADMIN_TEXT_CLICK_HERE_TO_UPGRADE',  'Click here to upgrade the database to Nucleus v%s');

try_define('_LISTS_FORM_SELECT_ITEM_FILTER',                     'Filter');
try_define('_LISTS_FORM_SELECT_ITEM_OPTION_ALL',                 'All');
try_define('_LISTS_FORM_SELECT_ITEM_OPTION_NORMAL',              'Normal published');
try_define('_LISTS_FORM_SELECT_ITEM_OPTION_NORMAL_TERM_FUTURE',  'Normal future');
try_define('_LISTS_FORM_SELECT_ITEM_OPTION_DRAFT',             'Draft');

try_define('_EDIT_DATE_FORMAT',           'day,month,year');
try_define('_EDIT_DATE_FORMAT_SEPARATOR', '/,/,at,:,');
try_define('_EDIT_DATE_FORMAT_DESC',      '(dd/mm/yyyy hh:mm)');

try_define('_ADD_DATEINPUTNOW',       'now');
try_define('_ADD_DATEINPUTRESET',     'reset');

try_define('_LINKS',                                'Links');
try_define('_MEMBERS_PASSWORD_INFO',				'(Password should be at least 6 characters)');

try_define('_NUMBER_OF_POST',		'Number of post');
try_define('_NUMBER_OF_COMMENT',	'Number of comment');

try_define('_ADMIN_CAN_DELETE',	'Can be deleted');
try_define('_ADMIN_MEMBER_HALT_TITLE' ,             'Halt a member');
try_define('_ADMIN_MEMBER_HALT_CONFIRM_TITLE' ,     'Halt a member');
try_define('_ADMIN_MEMBER_HALT_CONFIRM_TEXT' ,      'Trying to stop the following member');
try_define('_ADMIN_MEMBER_HALT_CONFIRM_DONE_BTN' ,  'Execute stop a member');
try_define('_ADMIN_MEMBER_SUPERADMIN',              'Sper admin');
try_define('_LISTS_HALT',		'Halt');
try_define('_LISTS_HALTING',  	'Under suspension');
try_define('_ERROR_ADMIN_MEMBER_HALT_SELF',         'Perhaps this member, because it is the management\'s own logged in, you can not stop.');
try_define('_ERROR_ADMIN_MEMBER_ALREADY_HALTED',    'This member is already stopped.');
try_define('_ERROR_LOGIN_MEMBER_HALT_OR_INVALID',   'This member is invalid or stop.');
try_define('_ERROR_LOGIN_DISALLOWED_BY_HALT',       'This member is currently disabled. Logon is not permitted. If you\'re have an account of the administrative user, please log back in as an administrative user.');
try_define('_GFUNCTIONS_LOGIN_FAILED_HALT_TXT',     'Member [% s] is disabled or stopped. You can not log in.');

try_define('_ADMIN_DATABASE_OPTIMIZATION_REPAIR',      'Database Optimization/Repair');
try_define('_ADMIN_TITLE_OPTIMIZE',      'Optimize');
try_define('_ADMIN_TITLE_REPAIR',        'Repair');
try_define('_ADMIN_FILESIZE',            'File size');
try_define('_ADMIN_NEW',                 'New');
try_define('_ADMIN_OLD',                 'Old');
try_define('_ADMIN_TABLENAME',           'Table name');
try_define('_ADMIN_CONFIRM_TITLE_OPTIMIZE',    'Are you sure you want to optimize the tables?');
try_define('_ADMIN_CONFIRM_TITLE_AUTO_REPAIR', 'Are you sure you want to automatically repair the tables?');
try_define('_ADMIN_EXEC_TITLE_AUTO_REPAIR',    'tables repaired.');
try_define('_ADMIN_EXEC_TITLE_OPTIMIZE',       'tables optimized.');
try_define('_ADMIN_BTN_TITLE_AUTO_REPAIR',     'Repair');
try_define('_ADMIN_BTN_TITLE_OPTIMIZE',        'Optimize');
try_define('_ADMIN_PLEASE_OPTIMIZE',           'Optimize please');

try_define('_PROBLEMS_FOUND_ON_TABLE',   'problems found on table');
try_define('_NO_PROBLEMS_FOUND',         'No problems found');
try_define('_NOT_IMPLEMENTED_YET',       'Not implemented yet.');
try_define('_SIZE',                      'Size');
try_define('_OVERHEAD',                  'Overhead');

try_define('_MANAGER_PLUGINSQLAPI_DRIVER_NOTSUPPORT',   "Plugin %s was not loaded (does not support SqlApi_%s or SqlApi_SQL92. Please upgrade to the latest version of the plug-ins that support this feature.)");

try_define('_DEFAULT_DATE_FORMAT_YMD',         '%d/%m/%Y');
try_define('_DEFAULT_DATE_FORMAT_YBD',         '%d %B %Y');
try_define('_DEFAULT_DATE_FORMAT_YM',          '%m %Y');
try_define('_DEFAULT_DATE_FORMAT_YB',          '%B %Y');
try_define('_DEFAULT_DATE_FORMAT_MD',          '%m %d');
try_define('_DEFAULT_DATE_FORMAT_BD',          '%B %d');
try_define('_DEFAULT_DATE_FORMAT_Y',           '%Y');

try_define('_ADMIN_SYSTEMOVERVIEW_CORE_SYSTEM',      'About system core');
try_define('_ADMIN_SYSTEMOVERVIEW_CORE_VERSION',     'Core version');
try_define('_ADMIN_SYSTEMOVERVIEW_CORE_PATCHLEVEL',  'Core patch level');
try_define('_ADMIN_SYSTEMOVERVIEW_CORE_DB_VERSION', 'Core database version');
try_define('_ADMIN_SYSTEMOVERVIEW_CORE_SETTINGS',    'Core important settings');

try_define('_ADMIN_SYSTEMOVERVIEW_DB_VERSION',  'Database version');

// Blog option
try_define('_EBLOG_VISIBLE_ITEM_AUTHOR',           "allow the display of the item's author");

try_define('_ADMIN_LOST_PSWD_TEXT_TITLE', "Forgot your password?");
try_define('_ADMIN_LOST_PSWD_TEXT_1', "Enter your username and email address below, and you'll be sent an e-mail with a link where you can choose a new password.");
try_define('_ADMIN_LOST_PSWD_TEXT_2', "If you don't remember your exact username, contact the site administrator.");
try_define('_ADMIN_LOST_PSWD_TEXT_3', "Send Activation Link");
try_define('_ADMIN_LOST_PSWD_TEXT_USENAME', "Username:");
try_define('_ADMIN_LOST_PSWD_TEXT_EMAIL', "Email address:");

/********************************************
 *        Start New for 3.71                *
 ********************************************/
try_define('_ADMIN_SYSTEMOVERVIEW_DBANDVERSION',  'Database and Version');
try_define('_ADMIN_SYSTEMOVERVIEW_DBDRIVER',      'Database Driver');
try_define('_ADMIN_SYSTEMOVERVIEW_PHPANDDB',      'PHP and Database');

try_define('_TEAM_NO_SELECTABLE_MEMBERS',         'team does not have selectable members');

try_define('_LISTS_FORM_SELECT_ALL_CATEGORY',    'All categories');

try_define('_LIST_BACK_TO',				'Back to %s');
try_define('_LIST_COMMENT_LIST_FOR_BLOG',		'Blog comments list');
try_define('_LIST_COMMENT_LIST_FOR_ITEM',		'Comments list of items');
try_define('_LIST_COMMENT_VIEW_ITEM',			'Show item');
try_define('_LISTS_VIEW',						'Show');

try_define('_LISTS_ITEM_COUNT',      'Item count');
try_define('_LISTS_ORDER',           'order');

try_define('_EBLOG_CAT_ORDER',            "This is the order of the category.<br />\nInput value will be on the smaller in number (standard 100)");
try_define('_EBLOG_CAT_ORDER_DESC2',      "Input value will be on the smaller in number (standard 100)");

// category order changes (batch)
try_define('_BATCH_CAT_CAHANGE_ORDER',                 'change the order');
try_define('_ERROR_CAHANGE_CATEGORY_ORDER',            'You can not change the sort');
try_define('_CAHANGE_CATEGORY_ORDER_TITLE',            'Please specify the order of the category');
try_define('_CAHANGE_CATEGORY_ORDER_CONFIRM_DESC',     'The order of the following categories will be changed at once.If it is good, please press the button.');
try_define('_CAHANGE_CATEGORY_ORDER_BTN_TITLE',        'Change the order');

// Skin import/export
try_define('_SKINIE_ERROR_FAILEDLOAD_XML',        'Failed to Load XML');

 /********************************************
 *        Start New for 3.65                *
 ********************************************/
try_define('_LISTS_AUTHOR', 'Author');
try_define('_OVERVIEW_OTHER_DRAFTS', 'Other Drafts');
 
/********************************************
 *        Start New for 3.64                *
 ********************************************/
try_define('_ERROR_USER_TOO_LONG', 'Please enter a name shorter than 40 characters.');
try_define('_ERROR_EMAIL_TOO_LONG', 'Please enter an email shorter than 100 characters.');
try_define('_ERROR_URL_TOO_LONG', 'Please enter a website shorter than 100 characters.');

/********************************************
 *        Start New for 3.62                *
 ********************************************/
try_define('_SETTINGS_ADMINCSS',		'Admin Area Style');

/********************************************
 *        Start New for 3.50                *
 ********************************************/
try_define('_PLUGS_TITLE_GETPLUGINS',		'obtenir plus de plugins...');
try_define('_ARCHIVETYPE_YEAR', 'année');
try_define('_ADMIN_SYSTEMOVERVIEW_LATESTVERSION_TITLE',		'Nouvelle version disponible');
try_define('_ADMIN_SYSTEMOVERVIEW_LATESTVERSION_TEXT',		'Mise à jour disponible : v');
try_define('_MANAGER_PLUGINSQLAPI_NOTSUPPORT', "Le plugin %s n'a pas été chargé (il ne supporte pas SqlApi et vous essayez d'utiliser une base de données non-mysql)");


/********************************************
 *        Start New for 3.40                *
 ********************************************/

// START changed/added after 3.33 START
try_define('_MEMBERS_USEAUTOSAVE',						'Utiliser la fonction de sauvegarde automatique ?');

try_define('_TEMPLATE_PLUGIN_FIELDS',					'Champs de plugin personnalisés');
try_define('_TEMPLATE_BLOGLIST',						'Liste des modèles de blog');
try_define('_TEMPLATE_BLOGHEADER',						'En-tête de la liste de blog');
try_define('_TEMPLATE_BLOGITEM',						'Elément de la liste de blog');
try_define('_TEMPLATE_BLOGFOOTER',						'Pied de page de la liste de blog');

try_define('_SETTINGS_DEFAULTLISTSIZE',					'Taille par défaut des listes dans la zone d\'administration');
try_define('_SETTINGS_DEBUGVARS',		'Variables de débogage');

try_define('_CREATE_ACCOUNT_TITLE',						'Créer un compte de membre');
try_define('_CREATE_ACCOUNT0',							'Créer un compte');
try_define('_CREATE_ACCOUNT1',							'Les visiteurs ne sont pas autorisés à créer un compte de membre.<br /><br />');
try_define('_CREATE_ACCOUNT2',							'Veuillez contacter l\'administrateur du site web pour plus d\'informations.');
try_define('_CREATE_ACCOUNT_USER_DATA',					'Informations sur le compte.');
try_define('_CREATE_ACCOUNT_LOGIN_NAME',				'Nom du compte (requis):');
try_define('_CREATE_ACCOUNT_LOGIN_NAME_VALID',			'a-z et 0-9 autorisés uniquement, pas d\'espaces au début et/ou à la fin');
try_define('_CREATE_ACCOUNT_REAL_NAME',					'Nom réel (requis):');
try_define('_CREATE_ACCOUNT_EMAIL',						'Email (requis):');
try_define('_CREATE_ACCOUNT_EMAIL2',					'(doit être vlide, parce qu\'un lien d\'activation sera envoyé)');
try_define('_CREATE_ACCOUNT_URL',						'URL:');
try_define('_CREATE_ACCOUNT_SUBMIT',					'Créer le compte');

try_define('_BMLET_BACKTODRAFTS',		'Déplacer vers les brouillons');
try_define('_BMLET_CANCEL',				'Annuler');

try_define('_LIST_ITEM_NOCONTENT',						'Aucun commentaire');
try_define('_LIST_ITEM_COMMENTS',						'%d commentaires');

try_define('_EDITC_URL',				'Site web');
try_define('_EDITC_EMAIL',				'E-mail');

try_define('_MANAGER_PLUGINFILE_NOTFOUND',				"Le plugin %s n'a pas été chargé (fichier introuvable)");
/* changed */
// plugin dependency 
try_define('_ERROR_INSREQPLUGIN',		'Echec de l\'installation du plugin, %s nécessaire');
try_define('_ERROR_DELREQPLUGIN',		'Echec de la suppression du plugin, requis par %s');

//try_define('_ADD_ADDLATER',								'Add Later');
try_define('_ADD_ADDLATER',								'Add the dates specified');

try_define('_LOGIN_NAME',				'Nom :');
try_define('_LOGIN_PASSWORD',			'Mot de passe :');

// changed from _BOOKMARLET_BMARKLFOLLOW
try_define('_BOOKMARKLET_BMARKFOLLOW',					' (Fonctionne avec presque tous les navigateurs)');
// END changed/added after 3.33 END

// START merge UTF-8 and EUC-JP

// Create New blog
try_define('_ADMIN_NOTABILIA',							'Quelques informations');
try_define('_ADMIN_PLEASE_READ',						"Avant de commencer, voici quelques <strong>informations importantes</strong>");
try_define('_ADMIN_HOW_TO_ACCESS',						"Après la création d'un nouveau blog, vous devrez rendre votre blog accessible. Il y deux possibilités :");
try_define('_ADMIN_SIMPLE_WAY',							"<strong>Simple :</strong> Créer une copie d'<code>index.php</code> et le modifier afind 'afficher votre nouveau blog. Plus d'informations vous seront fourniées après l'envoie de ce formulaire.");
try_define('_ADMIN_ADVANCED_WAY',						"<strong>Avancé :</strong> Insérer le contenu du blog dans vos skins actuels en utilisant des variables comme <code>&lt;%otherblog()&gt;</code>. De cette façon, vous pouvez placer plusieurs blogs sur la même page.");
try_define('_ADMIN_HOW_TO_CREATE',						'Créer un blog');


try_define('_BOOKMARKLET_NEW_CATEGORY',					'L\'élément a été ajouté et une nouvelle catégorie a été crée.');
try_define('_BOOKMARKLET_NEW_CATEGORY_EDIT',			'Cliquez ici pour modifier le nom et la description de la catégorie.');
try_define('_BOOKMARKLET_NEW_WINDOW',					'S\'ouvre dans une nouvelle fenêtre.');
try_define('_BOOKMARKLET_SEND_PING',					'L\'élément a ajouté avec succès. Maintenant, ping de weblogs.com. Veuillez patienter... (peut prendre longtemps.'); // NOTE: This string is no longer in used

// END merge UTF-8 and EUC-JP

// <add by shizuki>
// OVERVIEW screen
try_define('_OVERVIEW_SHOWALL',							'Afficher tous les blogs');	// <add by shizuki />

// Edit skins
try_define('_SKINEDIT_ALLOWEDBLOGS',						'Noms courts des blogs :');			// <add by shizuki>
try_define('_SKINEDIT_ALLOWEDTEMPLATESS',					'Noms des modèles :');		// <add by shizuki>

// delete member
try_define('_WARNINGTXT_NOTDELMEDIAFILES',				'Veuillez noter que les fichiers média ne seront <b>PAS</b> supprimés. (Du moins pas dans cette version de Nucleus)');	// <add by shizuki />

// send Weblogupdate.ping
try_define('_UPDATEDPING_MESSAGE',						'<h2>Site mis à jour, ping de plusieurs services de liste de blogs...</h2><p>Cela peut prendre un moment...</p><p>Si vous n\'êtes pas automatiquement redirigé, '); // NOTE: This string is no longer in used
try_define('_UPDATEDPING_GOPINGPAGE',					'réessayez'); // NOTE: This string is no longer in used
try_define('_UPDATEDPING_PINGING',						'Ping des services, veuillez patienter...'); // NOTE: This string is no longer in used
try_define('_UPDATEDPING_VIEWITEM',						'Afficher une liste des billets récents pour '); // NOTE: This string is no longer in used
try_define('_UPDATEDPING_VISITOWNSITE',					'Visitez votre propre site web'); // NOTE: This string is no longer in used

// General category
try_define('_EBLOGDEFAULTCATEGORY_NAME',				'Général');
try_define('_EBLOGDEFAULTCATEGORY_DESC',				'Billets qui ne rentrent pas dans les autres catégories');

// First ITEM
try_define('_EBLOG_FIRSTITEM_TITLE',					'Premier billet');
try_define('_EBLOG_FIRSTITEM_BODY',						'Ceci est le premier billet de votre blog. Vous pouvez le supprimer si vous le souhaitez.');

// New weblog was created
try_define('_BLOGCREATED_TITLE',						'Nouveau blog créé');
try_define('_BLOGCREATED_ADDEDTXT',						"Votre nouveau blog (%s) a été créé. Pour continuer, choisissez une façon de l'afficher :");
try_define('_BLOGCREATED_SIMPLEWAY',					"Facile : Une copie de <code>%s.php</code>");
try_define('_BLOGCREATED_ADVANCEDWAY',					"Avancé : Appeler le blog depuis des habillages existants");
try_define('_BLOGCREATED_SIMPLEDESC1',					"Méthode 1 : Créer un autre fichier <code>%s.php</code>");
try_define('_BLOGCREATED_SIMPLEDESC2',					"Créez un fichier nommé <code>%s.php</code> et copier le code suivant dedans :");
try_define('_BLOGCREATED_SIMPLEDESC3',					"Uploadez le fichier près de votre fichier <code>index.php</code> et cela devrait être bon.");
try_define('_BLOGCREATED_SIMPLEDESC4',					"Pour finir le processus de création du blog, veuillez entrer l'URL final de votre blog (La valeur proposée est juste une <em>conjecture</em>) :");
try_define('_BLOGCREATED_ADVANCEDWAY2',					"Méthode 2 : Appeler le blog depuis des habillages existants");
try_define('_BLOGCREATED_ADVANCEDWAY3',					"Pour finir le processus de création du blog, entrez simplement l'URL final de votre blog : (peut être la même qu'un blog existant)");

// Donate!
try_define('_ADMINPAGEFOOT_OFFICIALURL',				'http://nucleuscms.org/');
try_define('_ADMINPAGEFOOT_DONATEURL',					'http://nucleuscms.org/donate.php');
try_define('_ADMINPAGEFOOT_DONATE',						'Faire un don !');
try_define('_ADMINPAGEFOOT_COPYRIGHT',					'The Nucleus Group');

// Quick menu
try_define('_QMENU_MANAGE_SYSTEM',						'Informations système');

// REG file
try_define('_WINREGFILE_TEXT',							'Poster dans &Nucleus (%s)');

// Bookmarklet
try_define('_BOOKMARKLET_TITLE',						'Bookmarklet<!-- et menu clic droit -->');
try_define('_BOOKMARKLET_DESC1',						'Les bookmarklets permettent d\'ajouter des billets à votre blog en un seul clic. ');
try_define('_BOOKMARKLET_DESC2',						'Après avoir installé ces bookmarklets, vous pourrez cliquer sur le bouton \'ajouter au blog\' de la barre d\'outils de votre navigateur ');
try_define('_BOOKMARKLET_DESC3',						'et une fenêtre d\'ajout de billet apparaitra, ');
try_define('_BOOKMARKLET_DESC4',						'contenant les titre et lien de la page que vous visitiez, ');
try_define('_BOOKMARKLET_DESC5',						'ainsi que le texte sélectionné.');
try_define('_BOOKMARKLET_BOOKARKLET',					'bookmarklet');
try_define('_BOOKMARKLET_ANCHOR',						'Ajouter à %s');
try_define('_BOOKMARKLET_BMARKTEXT',					'Vous pouvez glisser le lien suivant vers vos favoris ou la barre d\'outils de votre navigateur : ');
try_define('_BOOKMARKLET_BMARKTEST',					'(si vous voulez d\'abord tester le bookmarklet, cliquez sur le lien)');
try_define('_BOOKMARKLET_RIGHTCLICK',					'Accès au menu clic droit (IE &amp; Windows)');
try_define('_BOOKMARKLET_RIGHTLABEL',					'élément du menu clic droit');
try_define('_BOOKMARKLET_RIGHTTEXT1',					'Ou vous pouvez installer le ');
try_define('_BOOKMARKLET_RIGHTTEXT2',					' (choisissez \'ouvrir un fichier\' et ajoutez le au registre)');
try_define('_BOOKMARKLET_RIGHTTEXT3',					'Vous devrez redémarrer Internet Explorer pour que l\'option s\'affiche dans le menu contextuel.');
try_define('_BOOKMARKLET_UNINSTALLTT',					'Désinstallation');
try_define('_BOOKMARKLET_DELETEBAR',					'Pour le bookmarklet, vous pouvez simplement le supprimer.');
try_define('_BOOKMARKLET_DELETERIGHTT',					'Pour l\'élément du menu clic droit, suivez la procédure ci-dessous :');
try_define('_BOOKMARKLET_DELETERIGHT1',					'Sélectionnez "Lancer..." dans le menu Démarrer');
try_define('_BOOKMARKLET_DELETERIGHT2',					'Tapez : "regedit"');
try_define('_BOOKMARKLET_DELETERIGHT3',					'Cliquez sur "OK"');
try_define('_BOOKMARKLET_DELETERIGHT4',					'Recherchez "\HKEY_CURRENT_USER\Software\Microsoft\Internet Explorer\MenuExt" dans l\'arbre');
try_define('_BOOKMARKLET_DELETERIGHT5',					'Supprimez l\'élément "add to \'Votre blog\'"');

try_define('_BOOKMARKLET_ERROR_SOMETHINGWRONG',			'Quelque chose n\'a pas fonctionné');
try_define('_BOOKMARKLET_ERROR_COULDNTNEWCAT',			'Impossible de créer une nouvelle catégorie');

// BAN
try_define('_BAN_EXAMPLE_TITLE',						'Un exemple');
try_define('_BAN_EXAMPLE_TEXT',							': "134.58.253.193" bloquera un seul ordinateur, tandis que "134.58.253" bloquera 256 adresses IP, y compris celle du premier exemple.');
try_define('_BAN_IP_CUSTOM',							'Personnalisé : ');
try_define('_BAN_BANBLOGNAME',							'Seulement le blog %s');

// Plugin Options
try_define('_PLUGIN_OPTIONS_TITLE',							'Options pour %s');

// Plugin file loda error
try_define('_PLUGINFILE_COULDNT_BELOADED',				'Erreur : le fichier de plugin <strong>%s.php</strong> n\'a pas pu être chargé ou bien il est inactif parce qu\'il ne supporte pas certains fonctions (vérifiez le <a href="?action=actionlog">journal</a> pour plus d\'informations)');

//ITEM add/edit template (for japanese only)
try_define('_ITEM_ADDEDITTEMPLATE_FORMAT',				'Format :');
try_define('_ITEM_ADDEDITTEMPLATE_YEAR',				'Année');
try_define('_ITEM_ADDEDITTEMPLATE_MONTH',				'Mois');
try_define('_ITEM_ADDEDITTEMPLATE_DAY',					'Jour');
try_define('_ITEM_ADDEDITTEMPLATE_HOUR',				'Heure');
try_define('_ITEM_ADDEDITTEMPLATE_MINUTE',				'Minutes');

// Errors
try_define('_ERRORS_INSTALLSQL',						'install.sql devrait être supprimé');
try_define('_ERRORS_INSTALLDIR',						'le répertoire install devrait être supprimé');  // <add by shizuki />
try_define('_ERRORS_INSTALLPHP',						'install.php devrait être supprimé');
try_define('_ERRORS_UPGRADESDIR',						'le répertoire nucleus/upgrades devrait être supprimé');
try_define('_ERRORS_CONVERTDIR',						'le répertoire nucleus/convert devrait être supprimé');
try_define('_ERRORS_CONFIGPHP',							'config.php devrait être en lecture seule (chmod 444)');
try_define('_ERRORS_STARTUPERROR1',						'<p>Certains fichiers d\'installation de Nucleus sont toujours présent sur le serveur web ou sont modifiables.</p><p>Vous devriez retirer ces fichiers ou modifier leur permissions. Voici les fichiers trouvés par Nucleus</p> <ul><li>');
try_define('_ERRORS_STARTUPERROR2',						'</li></ul><p>Si vous ne voulez plus voir ce message sans résoudre le problème, définissez <code>$CONF[\'alertOnSecurityRisk\']</code> dans <code>globalfunctions.php</code> à <code>0</code> ou bien faites le à la fin de <code>config.php</code>.</p>');
try_define('_ERRORS_STARTUPERROR3',						'Problème de sécurité');

// PluginAdmin tickets by javascript
try_define('_PLUGINADMIN_TICKETS_JAVASCRIPT',			'<p><b>Une erreur est survenu pendant l\'ajout automatique de tickets.</b></p>');

// Global settings disablesite URL
try_define('_SETTINGS_DISABLESITEURL',					'URL de redirection :');

// Skin import/export
try_define('_SKINIE_SEELEMENT_UNEXPECTEDTAG',			'TAG INATTENDU');
try_define('_SKINIE_ERROR_FAILEDOPEN_FILEURL',			'Impossible d\'ouvrir le fichier/URL');
try_define('_SKINIE_NAME_CLASHES_DETECTED',				'Conflit de noms détecté, relancez avec allowOverwrite = 1 pour forcer le remplacement');

// ACTIONS.php parse_commentform
try_define('_ACTIONURL_NOTLONGER_PARAMATER',			'actionurl n\'est plus un paramètre de la variable commentform. Déplacé vers un paramètre global à la place.');

// ADMIN.php addToTemplate 'Query error: '
try_define('_ADMIN_SQLDIE_QUERYERROR',					'Erreur de requête : ');

// backyp.php Backup WARNING
try_define('_BACKUP_BACKUPFILE_TITLE',					'Ceci est un fichier de sauvegarde généré par Nucleus');
try_define('_BACKUP_BACKUPFILE_BACKUPDATE',				'date de la sauvegarde :');
try_define('_BACKUP_BACKUPFILE_NUCLEUSVERSION',			'Version de Nucleus :');
try_define('_BACKUP_BACKUPFILE_DATABASE_NAME',			'Nom de la base de données de Nucleus :');
try_define('_BACKUP_BACKUPFILE_TABLE_NAME',				'TABLE:');
try_define('_BACKUP_BACKUPFILE_TABLEDATAFOR',			'Données de table pour %s');
try_define('_BACKUP_WARNING_NUCLEUSVERSION',			'AVERTISSEMENT : Tentez une restauration uniquement sur les serveurs utilisant exactement la même version de Nucleus');
try_define('_BACKUP_RESTOR_NOFILEUPLOADED',				'Aucun fichier envoyé');
try_define('_BACKUP_RESTOR_UPLOAD_ERROR',				'Erreur d\'envoi du fichier');
try_define('_BACKUP_RESTOR_UPLOAD_NOCORRECTTYPE',		'Le fichier envoyé n\'est pas du bon type');
try_define('_BACKUP_RESTOR_UPLOAD_NOZLIB',				'Impossible de décompresser une sauvegarde gzip (zlib n\'est pas installé)');
try_define('_BACKUP_RESTOR_SQL_ERROR',					'Erreur SQL : ');

// BLOG.php addTeamMember
try_define('_TEAM_ADD_NEWTEAMMEMBER',					'Ajouté %s (ID=%d) à l\'équipe du blog "%s"');

// ADMIN.php systemoverview()
try_define('_ADMIN_SYSTEMOVERVIEW_HEADING',				'Aperçu du système');
try_define('_ADMIN_SYSTEMOVERVIEW_PHPANDMYSQL',			'PHP et MySQL');
try_define('_ADMIN_SYSTEMOVERVIEW_VERSIONS',			'Versions');
try_define('_ADMIN_SYSTEMOVERVIEW_PHPVERSION',			'Version de PHP');
try_define('_ADMIN_SYSTEMOVERVIEW_MYSQLVERSION',		'Version de MySQL');
try_define('_ADMIN_SYSTEMOVERVIEW_SETTINGS',			'Paramètres');
try_define('_ADMIN_SYSTEMOVERVIEW_GDLIBRALY',			'Bibliothèque GD');
try_define('_ADMIN_SYSTEMOVERVIEW_MODULES',				'Modules');
try_define('_ADMIN_SYSTEMOVERVIEW_ENABLE',				'activé');
try_define('_ADMIN_SYSTEMOVERVIEW_DISABLE',				'désactivé');
try_define('_ADMIN_SYSTEMOVERVIEW_NUCLEUSSYSTEM',		'Votre système Nucleus');
try_define('_ADMIN_SYSTEMOVERVIEW_NUCLEUSVERSION',		'Version de Nucleus');
try_define('_ADMIN_SYSTEMOVERVIEW_NUCLEUSPATCHLEVEL',	'Niveau de patch de Nucleus');
try_define('_ADMIN_SYSTEMOVERVIEW_NUCLEUSSETTINGS',		'Paramètres importants');
try_define('_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK',		'Rechercher une nouvelle version');
try_define('_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_TXT',	'Vérifie sur nucleuscms.org si une nouvelle version est disponible : ');
try_define('_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_URL',	'http://nucleuscms.org/version.php?v=%d&amp;pl=%d');
try_define('_ADMIN_SYSTEMOVERVIEW_VERSIONCHECK_TITLE',	'Recherche une mise à jour');
try_define('_ADMIN_SYSTEMOVERVIEW_NOT_ADMIN',			"Vous n'avez pas les droit nécessaires pour voir les informations systèmes.");

// ENCAPSULATE.php
try_define('_ENCAPSULATE_ENCAPSULATE_NOENTRY',			'Aucune entrée');

// globalfunctions.php
try_define('_GFUNCTIONS_LOGINPCSHARED_YES',				'sur un ordinateur partagé');
try_define('_GFUNCTIONS_LOGINPCSHARED_NO',				'sur un ordinateur non-partagé');
try_define('_GFUNCTIONS_LOGINSUCCESSFUL_TXT',			'Connexion réussie pour %s (%s)');
try_define('_GFUNCTIONS_LOGINFAILED_TXT',				'Echec de la connexion pour %s');
try_define('_GFUNCTIONS_LOGOUT_TXT',					'%s est déconnecté');
try_define('_GFUNCTIONS_HEADERSALREADYSENT_FILE',		' dans <code>%s</code> ligne <code>%s</code>');
try_define('_GFUNCTIONS_HEADERSALREADYSENT_TITLE',		' En-têtes de page déjà envoyés');
try_define('_GFUNCTIONS_HEADERSALREADYSENT_TXT',		'<p>Les en-têtes de la page ont déjà été envoyés %s. Ceci pour empêcher Nucleus de fonctionner correctement.</p><p>Habituellement, ceci est causé par des espaces ou des retours à la ligne à la fin du fichier <code>config.php</code> file, à la fin du fichier de langue ou à la fin d\'un fichier de plugin. Veuillez essayer de corriger ceci et réessayer.</p><p>Si vous ne souhaitez plus voir ce message, sans résoudre le problème, définissez <code>$CONF[\'alertOnHeadersSent\']</code> dans <code>globalfunctions.php</code> à <code>0</code></p>');
try_define('_GFUNCTIONS_PARSEFILE_FILEMISSING',			'Il manque un fichier');
try_define('_GFUNCTIONS_AN_ERROR_OCCURRED',				'Désolé. Une erreur est survenue.');
try_define('_GFUNCTIONS_YOU_AERNT_LOGGEDIN',			"Vous n'êtes pas connecté.");

// MANAGER.php
try_define('_MANAGER_PLUGINFILE_NOCLASS',				"Le plugin %s n'a pas été chargé (Classe introuvable dans le fichier, erreur de traitement possible)");
try_define('_MANAGER_PLUGINTABLEPREFIX_NOTSUPPORT',		"Le plugin %s n'a pas été chargé (ne supporte pas SqlTablePrefix)");

// mysql.php
try_define('_NO_SUITABLE_MYSQL_LIBRARY',				"<p>Aucun bibliothèque mySQL appropriée trouvée pour lancer Nucleus</p>");

// PLUGIN.php
try_define('_ERROR_PLUGIN_NOSUCHACTION',				'Action introuvable');

// PLUGINADMIN.php
try_define('_ERROR_INVALID_PLUGIN',						'Plugin invalide');

// showlist.php
try_define('_LIST_PLUGS_DEPREQ',						'Le(s) plugin(s) nécessite(nt) :');
try_define('_LIST_SKIN_PREVIEW',						"Aperçu de l'habillage '%s'");
try_define('_LIST_SKIN_PREVIEW_VIEWLARGER',				"Voir en grand");
try_define('_LIST_SKIN_README',							"Plus d'informations sur l'habillage '%s'");
try_define('_LIST_SKIN_README_TXT',						'Lisez-moi');

// BLOG.php createNewCategory()
try_define('_CREATED_NEW_CATEGORY_NAME',				'newcat');
try_define('_CREATED_NEW_CATEGORY_DESC',				'Nouvelle catégorie');

// ADMIN.php blog settings
try_define('_EBLOG_CURRENT_TEAM_MEMBER',				'Membres actuels de l\'équipe :');

// HTML outputs
try_define('_HTML_XML_NAME_SPACE_AND_LANG_CODE',		'xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr-fr" lang="fr-fr"');
try_define('_LANG_CODE',		'fr');

// Language Files
try_define('_LANGUAGEFILES_JAPANESE-UTF8',				'Japonais - &#26085;&#26412;&#35486; (UTF-8)');
try_define('_LANGUAGEFILES_JAPANESE-EUC',				'Japonais - &#26085;&#26412;&#35486; (EUC)');
try_define('_LANGUAGEFILES_ENGLISH-UTF8',				'Anglais - English (UTF-8)');
try_define('_LANGUAGEFILES_ENGLISH',					'Anglais - English (iso-8859-1)');
/*
try_define('_LANGUAGEFILES_BULGARIAN',					'Bulgarian - &#1041;&#1098;&#1083;&#1075;&#1072;&#1088;&#1089;&#1082;&#1080; (iso-8859-5)');
try_define('_LANGUAGEFILES_CATALAN',					'Catalan - Catal&agrave; (iso-8859-1)');
try_define('_LANGUAGEFILES_CHINESE-GBK',				'Simplified Chinese - &#31777;&#20307;&#23383;&#20013;&#25991; (gbk)');
try_define('_LANGUAGEFILES_SIMCHINESE',					'Simplified Chinese - &#31777;&#20307;&#23383;&#20013;&#25991; (gb2312)');
try_define('_LANGUAGEFILES_CHINESE-UTF8',				'Simplified Chinese - &#31777;&#20307;&#23383;&#20013;&#25991; (utf-8)');
try_define('_LANGUAGEFILES_CHINESEB5',					'Tranditional Chinese - &#32321;&#20307;&#23383;&#20013;&#25991; (big5)');
try_define('_LANGUAGEFILES_CHINESEB5-UTF8',				'Tranditional Chinese - &#32321;&#20307;&#23383;&#20013;&#25991; (utf-8)');
try_define('_LANGUAGEFILES_TRADITIONAL_CHINESE',		'Tranditional Chinese - &#32321;&#20307;&#23383;&#20013;&#25991; (big5)');
try_define('_LANGUAGEFILES_TRADITIONAL_CHINESE-UTF-8',	'Tranditional Chinese - &#32321;&#20307;&#23383;&#20013;&#25991; (utf-8)');
try_define('_LANGUAGEFILES_CZECH',						'Czech - &#268;esky (windows-1250)');
try_define('_LANGUAGEFILES_FINNISH',					'Finnish - Suomi (iso-8859-1)');
try_define('_LANGUAGEFILES_FRENCH',						'French - Fran&ccedil;ais (iso-8859-1)');
try_define('_LANGUAGEFILES_GALEGO',						'Galego - Galego (iso-8859-1)');
try_define('_LANGUAGEFILES_GERMAN',						'German - Deutsch (iso-8859-1)');
try_define('_LANGUAGEFILES_HUNGARIAN',					'Hungarian - Magyar (iso-8859-2)');
try_define('_LANGUAGEFILES_ITALIANO',					'Italiano - Italiano (iso-8859-1)');
try_define('_LANGUAGEFILES_KOREAN-EUC-KR',				'Korean - &#54620;&#44397;&#50612; (euc-kr)');
try_define('_LANGUAGEFILES_KOREAN-UTF',					'Korean - &#54620;&#44397;&#50612; (utf-8)');
try_define('_LANGUAGEFILES_LATVIAN',					'Latvian - Latvie&scaron;u (windows-1257)');
try_define('_LANGUAGEFILES_NEDERLANDS',					'Duch - Nederlands (iso-8859-15)');
try_define('_LANGUAGEFILES_PERSIAN',					'Persian - &#1601;&#1575;&#1585;&#1587;&#1740; (utf-8)');
try_define('_LANGUAGEFILES_PORTUGUESE_BRAZIL',			'Portuguese Brazil - Portugu&ecirc;s (iso-8859-1)');
try_define('_LANGUAGEFILES_RUSSIAN',					'Russian - &#1056;&#1091;&#1089;&#1089;&#1082;&#1080;&#1081; (windows-1251)');
try_define('_LANGUAGEFILES_SLOVAK',						'Slovak - Sloven&#269;ina (ISO-8859-2)');
try_define('_LANGUAGEFILES_SPANISH-UTF8',				'Spanish - Espa&ntilde;ol (utf-8)');
try_define('_LANGUAGEFILES_SPANISH',					'Spanish - Espa&ntilde;ol (iso-8859-1)');
*/

// </add by shizuki>

/********************************************
 *        End New for 3.40                  *
 ********************************************/

// START changed/added after 3.3 START
try_define('_AUTOSAVEDRAFT',		'Sauvegarde automatique du brouillon');
try_define('_AUTOSAVEDRAFT_LASTSAVED',	'Dernière sauvegarde : ');
try_define('_AUTOSAVEDRAFT_NOTYETSAVED',	'Aucune sauvegarde n\'a été effectuée pour l\'instant');
try_define('_AUTOSAVEDRAFT_NOW',		'Sauvegarder maintenant');
try_define('_SKIN_PARTS_SPECIAL',		'Parties d\'habillage spéciales');
try_define('_ERROR_SKIN_PARTS_SPECIAL_FORMAT',		'You must enter a name that exists only out of lowercase letters and digits');
try_define('_ERROR_SKIN_PARTS_SPECIAL_DELETE',		'Impossible de supprimer cette partie d\'habillage');
try_define('_CONFIRMTXT_SKIN_PARTS_SPECIAL',		'Voulez vous vraiment supprimer cette partie d\'habillage spéciale ?');
try_define('_ERROR_PLUGIN_LOAD',		'Impossible de charger le plugin ou bien il ne supporte pas certains fonctions requises pour le lancer sur votre installation de Nucleus (vérifiez le <a href="?action=actionlog">journal</a> pour plus d\'informations)');
// END changed/added after 3.3 END

// START changed/added after 3.22 START
try_define('_SEARCHFORM_QUERY',			'Mots clef à rechercher');
try_define('_ERROR_EMAIL_REQUIRED',		'Une adresse email est nécessaire');
try_define('_COMMENTFORM_MAIL',			'Site web :');
try_define('_COMMENTFORM_EMAIL',		'E-mail:');
try_define('_EBLOG_REQUIREDEMAIL',		'Demander une adresse email avec les commentaires ?');
try_define('_ERROR_COMMENTS_SPAM',      'Votre commentaire a été rejeté parce qu\'il n\'a pas passé le test anti-spam');
// END changed/added after 3.22 END

// START changed/added after 3.15 START

try_define('_LIST_PLUG_SUBS_NEEDUPDATE',	'Veuillez utiliser le bouton \'Mettre à jour la liste des installations\' pour mettre à jour la liste des modules installés.');
try_define('_LIST_PLUGS_DEP',		'Ce module nécessite:');

// END changed/added after 3.15

// START changed/added after 3.1 START

// comments list per weblog
try_define('_COMMENTS_BLOG',		'Tous les commentaires du blog');
try_define('_NOCOMMENTS_BLOG',		'Aucun commentaire n\'a été fait sur les billets de ce blog');
try_define('_BLOGLIST_COMMENTS',		'Commentaires');
try_define('_BLOGLIST_TT_COMMENTS',		'Liste de tous les commentaires apportés aux billets de blog');


// for use in archivetype-skinvar
try_define('_ARCHIVETYPE_DAY',		'jour');
try_define('_ARCHIVETYPE_MONTH',		'mois');

// tickets (prevents malicious users to trick an admin to perform actions he doesn't want)
try_define('_ERROR_BADTICKET',		'Ticket invalide ou expiré.');

// plugin dependency
try_define('_ERROR_INSREQPLUGIN',		'L\'installation a échoué car le module nécessite ');
try_define('_ERROR_DELREQPLUGIN',		'L\'désinstallation a échoué car le module est requis par ');

// cookie prefix
try_define('_SETTINGS_COOKIEPREFIX',	'Préfixe du cookie');

// account activation
try_define('_ERROR_NOLOGON_NOACTIVATE',	'Impossible d\'envoyer le lien d\'activation. Vous n\'êtes pas autorisé à vous authentifier.');
try_define('_ERROR_ACTIVATE',		'La clef d\'activation key n\'existe pas, est invalide, ou a expiré.');
try_define('_ACTIONLOG_ACTIVATIONLINK', 	'Lien d\'activation envoyé');
try_define('_MSG_ACTIVATION_SENT',		'Lien d\'activation a été envoyé par mail.');

// activation link emails
try_define('_ACTIVATE_REGISTER_MAIL',	"Bonjour <%memberName%>,\n\nvous devez activer votre compte sur <%siteName%> (<%siteUrl%>).\nVous pouvez le faire en suivant le lien ci-dessous :\n\n\t<%activationUrl%>\n\nPassés 2 jours le lien d\'activation sera invalide.");
try_define('_ACTIVATE_REGISTER_MAILTITLE',	"Activez votre compte '<%memberName%>'");
try_define('_ACTIVATE_REGISTER_TITLE',	'Bienvenue <%memberName%>');
try_define('_ACTIVATE_REGISTER_TEXT',	'Une dernière étape : choisissez un mot de passe pour votre compte.');
try_define('_ACTIVATE_FORGOT_MAIL',		"Bonjour <%memberName%>,\n\nEn suivant le lien ci-dessous, vous pouvez choisir un nouveau mot de passe pour votre compte sur <%siteName%> (<%siteUrl%>).\n\n\t<%activationUrl%>\n\nPassés 2 jours le lien d\'activation sera invalide.");
try_define('_ACTIVATE_FORGOT_MAILTITLE',	"Procédez à la réactivation de votre compte '<%memberName%>'");
try_define('_ACTIVATE_FORGOT_TITLE',	'Bienvenue <%memberName%>');
try_define('_ACTIVATE_FORGOT_TEXT',		'Vous pouvez choisir un nouveau mot de passe pour votre compte ci-dessous :');
try_define('_ACTIVATE_CHANGE_MAIL',		"Bonjour <%memberName%>,\n\nMaintenant que votre adresse email a été changée, vous devez réactivation de votre compte sur <%siteName%> (<%siteUrl%>).\nVous pouvez le faire en suivant le lien ci-dessous :\n\n\t<%activationUrl%>\n\nPassés 2 jours le lien d\'activation sera invalide.");
try_define('_ACTIVATE_CHANGE_MAILTITLE',	"Procédez à la réactivation de votre compte '<%memberName%>'");
try_define('_ACTIVATE_CHANGE_TITLE',	'Bienvenue <%memberName%>');
try_define('_ACTIVATE_CHANGE_TEXT',		'Votre changement d\'adresse email a été validé. Merci !');
try_define('_ACTIVATE_SUCCESS_TITLE',	'Activation réussie');
try_define('_ACTIVATE_SUCCESS_TEXT',	'Votre compte a été réactivé.');
try_define('_MEMBERS_SETPWD',		'Choisissez un mot de passe');
try_define('_MEMBERS_SETPWD_BTN',		'Choisissez un mot de passe');
try_define('_QMENU_ACTIVATE',		'Activation de compte');
try_define('_QMENU_ACTIVATE_TEXT',		'<p>Dès l\'activation de votre compte, vous pouvez commencer à l\'utiliser en <a href="index.php?action=showlogin">vous authentifiant</a>.</p>');

try_define('_PLUGS_BTN_UPDATE',		'Mettre à jour la liste des installations');

// global settings
try_define('_SETTINGS_JSTOOLBAR',		'Type de barre d\'édition');
try_define('_SETTINGS_JSTOOLBAR_FULL',	'Barre d\'édition complète (IE)');
try_define('_SETTINGS_JSTOOLBAR_SIMPLE',	'Barre d\'édition simplifiée (Non-IE)');
try_define('_SETTINGS_JSTOOLBAR_NONE',	'Désactiver la barre d\'édition');
try_define('_SETTINGS_URLMODE_HELP',	'(Info: <a href="documentation/tips.html#searchengines-fancyurls">activer l\'utilisation des URLs pour la recherche</a>)');

// extra plugin settings part when editing categories/members/blogs/...
try_define('_PLUGINS_EXTRA',		'Autres paramètres du module');

// itemlist info column keys
try_define('_LIST_ITEM_BLOG',		'blog:');
try_define('_LIST_ITEM_CAT',		'thème:');
try_define('_LIST_ITEM_AUTHOR',		'auteur:');
try_define('_LIST_ITEM_DATE',		'date:');
try_define('_LIST_ITEM_TIME',		'heure:');

// indication of registered members in comments list
try_define('_LIST_COMMENTS_MEMBER', 	'(participant)');

// batch operations
try_define('_BATCH_WITH_SEL',		'Ayant pour sélection:');
try_define('_BATCH_EXEC',			'Executer');

// quickmenu
try_define('_QMENU_HOME',			'Accueil');
try_define('_QMENU_ADD',			'Ajouter un billet');
try_define('_QMENU_ADD_SELECT',		'-- sélectionnez --');
try_define('_QMENU_USER_SETTINGS',		'Préférences');
try_define('_QMENU_USER_ITEMS',		'Billets');
try_define('_QMENU_USER_COMMENTS',		'Commentaires');
try_define('_QMENU_MANAGE',			'Paramètres');
try_define('_QMENU_MANAGE_LOG',		'Log');
try_define('_QMENU_MANAGE_SETTINGS',	'Configuration');
try_define('_QMENU_MANAGE_MEMBERS',		'Participants');
try_define('_QMENU_MANAGE_NEWBLOG',		'Nouveau blog');
try_define('_QMENU_MANAGE_BACKUPS',		'Sauvegardes');
try_define('_QMENU_MANAGE_PLUGINS',		'Modules');
try_define('_QMENU_LAYOUT',			'Mise en page');
try_define('_QMENU_LAYOUT_SKINS',		'Habillages');
try_define('_QMENU_LAYOUT_TEMPL',		'Modèles');
try_define('_QMENU_LAYOUT_IEXPORT',		'Importer/Exporter');
try_define('_QMENU_PLUGINS',		'Modules');

// quickmenu on logon screen
try_define('_QMENU_INTRO',			'Introduction');
try_define('_QMENU_INTRO_TEXT',		'<p>Ceci est la page d\'authentification de Nucleus CMS, le système permettant la mise à jour du contenu de ce site.</p><p>Pour mettre en ligne de nouveaux billets, authentifiez-vous.</p>');

// helppages for plugins
try_define('_ERROR_PLUGNOHELPFILE',		'Impossible de trouver le fichier d\'aide correspondant à ce module');
try_define('_PLUGS_HELP_TITLE',		'Page d\'aide pour le module');
try_define('_LIST_PLUGS_HELP', 		'aide');


// END changed/started after 3.1

// START changed/added after v2.5beta START

// general settings (security)
try_define('_SETTINGS_EXTAUTH',		'Activer le système d\'authentification externe');
try_define('_WARNING_EXTAUTH',		'Attention: à n\'activer que si nécessaire.');

// member profile
try_define('_MEMBERS_BYPASS',		'Utiliser le système d\'authentification externe');

// 'always include in search' blog setting (yes/no) [in v2.5beta, the 'always' part wasn't clear]
try_define('_EBLOG_SEARCH',			'<em>Toujours</em> inclure dans la recherche');

// END changed/added after v2.5beta

// START introduced after v2.0 START

// media library
try_define('_MEDIA_VIEW',			'afficher');
try_define('_MEDIA_VIEW_TT',		'Afficher la page (ouvrir une nouvelle fenêtre)');
try_define('_MEDIA_FILTER_APPLY',		'Appliquer le filtre');
try_define('_MEDIA_FILTER_LABEL',		'Filtre: ');
try_define('_MEDIA_UPLOAD_TO',		'Télécharger dans...');
try_define('_MEDIA_UPLOAD_NEW',		'Télécharger un nouveau fichier...');
try_define('_MEDIA_COLLECTION_SELECT',	'Sélectionner');
try_define('_MEDIA_COLLECTION_TT',		'Changer de bibliothèque');
try_define('_MEDIA_COLLECTION_LABEL',	'Bibliothèque actuelle: ');

// tooltips on toolbar
try_define('_ADD_ALIGNLEFT_TT',		'Aligner à gauche');
try_define('_ADD_ALIGNRIGHT_TT',		'Aligner à droite');
try_define('_ADD_ALIGNCENTER_TT',		'Centrer');


// generic upload failure
try_define('_ERROR_UPLOADFAILED',		'Echec du téléchargement');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
try_define('_EBLOG_ALLOWPASTPOSTING',	'Permettre d\'antidater');
try_define('_ADD_CHANGEDATE',		'Mise à  jour  de la date');
try_define('_BMLET_CHANGEDATE',		'Mise à  jour de la date');

// skin import/export
try_define('_OVERVIEW_SKINIMPORT',		'Habillage import/export...');

// skin settings
try_define('_PARSER_INCMODE_NORMAL',	'Normal');
try_define('_PARSER_INCMODE_SKINDIR',	'Utiliser un dossier d\'habillage');
try_define('_SKIN_INCLUDE_MODE',		'Type d\'inclusion');
try_define('_SKIN_INCLUDE_PREFIX',		'Préfixe d\'inclusion');

// global settings
try_define('_SETTINGS_BASESKIN',		'Habillage de base');
try_define('_SETTINGS_SKINSURL',		'URL pour l\'habillage');
try_define('_SETTINGS_ACTIONSURL',		'URL complet pour action.php');

// category moves (batch)
try_define('_ERROR_MOVEDEFCATEGORY',	'Impossible de déplacer le thème par défaut');
try_define('_ERROR_MOVETOSELF',		'Impossible de déplacer le thème (le blog de destination est identique au blog source)');
try_define('_MOVECAT_TITLE',		'Sélectionner le blog dans lequel vous souhaitez déplacer ce thème');
try_define('_MOVECAT_BTN',			'Déplacer le thème');

// URLMode setting
try_define('_SETTINGS_URLMODE',		'Type de lien');
try_define('_SETTINGS_URLMODE_NORMAL',	'Normal');
try_define('_SETTINGS_URLMODE_PATHINFO',	'Fancy');

// Batch operations
try_define('_BATCH_NOSELECTION',		'Aucune action sélectionnée');
try_define('_BATCH_ITEMS',			'Action sur les billets');
try_define('_BATCH_CATEGORIES',		'Action sur les thèmes');
try_define('_BATCH_MEMBERS',		'Action sur les participants');
try_define('_BATCH_TEAM',			'Action sur les participants d\'un blog');
try_define('_BATCH_COMMENTS',		'Action sur les commentaires');
try_define('_BATCH_UNKNOWN',		'Action inconnue: ');
try_define('_BATCH_EXECUTING',		'En cours');
try_define('_BATCH_ONCATEGORY',		'sur un thème');
try_define('_BATCH_ONITEM',			'sur un élément');
try_define('_BATCH_ONCOMMENT',		'sur un commentaire');
try_define('_BATCH_ONMEMBER',		'sur un participant');
try_define('_BATCH_ONTEAM',			'sur le participant du blog');
try_define('_BATCH_SUCCESS',		'Action réussie!');
try_define('_BATCH_DONE',			'Terminé!');
try_define('_BATCH_DELETE_CONFIRM',		'Confirmer la suppression');
try_define('_BATCH_DELETE_CONFIRM_BTN',	'Confirmer');
try_define('_BATCH_SELECTALL',		'Tout sélectionner');
try_define('_BATCH_DESELECTALL',		'Annuler la sélection');

// batch operations: options in dropdowns
try_define('_BATCH_ITEM_DELETE',		'Supprimer');
try_define('_BATCH_ITEM_MOVE',		'Déplacer');
try_define('_BATCH_MEMBER_DELETE',		'Supprimer');
try_define('_BATCH_MEMBER_SET_ADM',		'Donner les droits d\'administrateur');
try_define('_BATCH_MEMBER_UNSET_ADM',	'Retirer les droits d\'administrateur');
try_define('_BATCH_TEAM_DELETE',		'Retirer de l\'équipe');
try_define('_BATCH_TEAM_SET_ADM',		'Donner les droits d\'administrateur');
try_define('_BATCH_TEAM_UNSET_ADM',		'Retirer les droits d\'administrateur');
try_define('_BATCH_CAT_DELETE',		'Supprimer');
try_define('_BATCH_CAT_MOVE',		'Déplacer vers un autre blog');
try_define('_BATCH_COMMENT_DELETE',		'Supprimer');

// itemlist: Add new item...
try_define('_ITEMLIST_ADDNEW',		'Ajouter un nouveau billet...');
try_define('_ADD_PLUGIN_EXTRAS',		'Options supplémentaires des modules');

// errors
try_define('_ERROR_CATCREATEFAIL',		'Impossible de créer le nouveau thème');
try_define('_ERROR_NUCLEUSVERSIONREQ',	'Ce module requiert une version ultérieure de Nucleus: ');

// backlinks
try_define('_BACK_TO_BLOGSETTINGS',		'Retour au menu de configuration des blogs');

// skin import export
try_define('_SKINIE_TITLE_IMPORT',		'Importation');
try_define('_SKINIE_TITLE_EXPORT',		'Exportation');
try_define('_SKINIE_BTN_IMPORT',		'Importer');
try_define('_SKINIE_BTN_EXPORT',		'Exporter les habillages/modèles sélectionnés');
try_define('_SKINIE_LOCAL',			'Importer depuis un fichier local:');
try_define('_SKINIE_NOCANDIDATES',		'Aucun habillage trouvé dans le répertoire skins');
try_define('_SKINIE_FROMURL',		'Importer à partir d\'un lien:');
try_define('_SKINIE_EXPORT_INTRO',		'Sélectionnez ci-dessous les habillages et modèles que vous souhaitez exporter:');
try_define('_SKINIE_EXPORT_SKINS',		'Habillages');
try_define('_SKINIE_EXPORT_TEMPLATES',	'Modèles');
try_define('_SKINIE_EXPORT_EXTRA',		'Notes');
try_define('_SKINIE_CONFIRM_OVERWRITE',	'Ecraser l\'ancienne version?');
try_define('_SKINIE_CONFIRM_IMPORT',	'Oui, je veux importer ceci');
try_define('_SKINIE_CONFIRM_TITLE',		'A propos de l\'importation d\'habillage et de modèle');
try_define('_SKINIE_INFO_SKINS',		'Habillages dans le fichier:');
try_define('_SKINIE_INFO_TEMPLATES',	'Modèles dans le fichier:');
try_define('_SKINIE_INFO_GENERAL',		'Notes:');
try_define('_SKINIE_INFO_SKINCLASH',	'Nom de l\'habillage:');
try_define('_SKINIE_INFO_TEMPLCLASH',	'Nom du modèle:');
try_define('_SKINIE_INFO_IMPORTEDSKINS',	'Habillage importé:');
try_define('_SKINIE_INFO_IMPORTEDTEMPLS',	'Modèle importé:');
try_define('_SKINIE_DONE',			'Importation réussie');

try_define('_AND',				'et');
try_define('_OR',				'ou');

// empty fields on template edit
try_define('_EDITTEMPLATE_EMPTY',		'Champ vide (cliquer pour modifier)');

// skin overview list
try_define('_LIST_SKINS_INCMODE',		'Type d\'inclusion:');
try_define('_LIST_SKINS_INCPREFIX',		'Préfixe d\'inclusion:');
try_define('_LIST_SKINS_DEFINED',		'Habillages définis:');

// backup
try_define('_BACKUPS_TITLE',		'Sauvegarde / Récupération');
try_define('_BACKUP_TITLE',			'Sauvegarde');
try_define('_BACKUP_INTRO',			'Cliquez sur le bouton ci-dessous pour créer une sauvegarde de votre base de données Nucleus. Enregistrez-la dans un fichier. Gardez-le en lieu sûr.');
try_define('_BACKUP_ZIP_YES',		'Essayer d\'utiliser la compression');
try_define('_BACKUP_ZIP_NO',		'Ne pas utiliser la compression');
try_define('_BACKUP_BTN',			'Sauvegarder!');
try_define('_BACKUP_NOTE',			'<b>NB:</b> Seul le contenu de la base de données est sauvegardé. Les fichiers Media importés et la configuration de config.php <b>NE SONT PAS</b> inclus dans la sauvegarde.');
try_define('_RESTORE_TITLE',		'Récupération');
try_define('_RESTORE_NOTE',			'<b>ATTENTION:</b> Restaurer une sauvegarde <b>EFFACERA</b> toutes les données contenues dans la base de données Nucleus! N\'agissez qu\'en connaissance de cause!<br /><b>NB:</b> Vérifiez que la version de Nucleus de votre sauvegarde soit la même que celle que vous utilisez actuellement autrement cela ne fonctionnera pas.');
try_define('_RESTORE_INTRO',		'Sélectionnez le fichier de récupération ci-dessous (il sera téléchargé sur le serveur) et cliquez sur le bouton "Récupération" pour procéder.');
try_define('_RESTORE_IMSURE',		'Oui, je suis sûr!');
try_define('_RESTORE_BTN',			'Récupération');
try_define('_RESTORE_WARNING',		'(Vérifiez que vous restaurez le bon fichier de sauvegarde. Faites une nouvelle sauvegarde avant de commencer si vous n\'êtes pas sûr.)');
try_define('_ERROR_BACKUP_NOTSURE',		'Vous devez cliquer sur le bouton \'je suis sûr\'');
try_define('_RESTORE_COMPLETE',		'Récupération terminée');

// new item notification
try_define('_NOTIFY_NI_MSG',		'Nouveau billet:');
try_define('_NOTIFY_NI_TITLE',		'Nouveau!');
try_define('_NOTIFY_KV_MSG',		'Votes Karma pour le billet:');
try_define('_NOTIFY_KV_TITLE',		'Nucleus karma:');
try_define('_NOTIFY_NC_MSG',		'Commentaires sur le billet:');
try_define('_NOTIFY_NC_TITLE',		'Commentaire Nucleus:');
try_define('_NOTIFY_USERID',		'Utilisateur:');
try_define('_NOTIFY_USER',			'Utilisateur:');
try_define('_NOTIFY_COMMENT',		'Commentaire:');
try_define('_NOTIFY_VOTE',			'Vote:');
try_define('_NOTIFY_HOST',			'Hôte:');
try_define('_NOTIFY_IP',			'IP:');
try_define('_NOTIFY_MEMBER',		'Participant:');
try_define('_NOTIFY_TITLE',			'Titre:');
try_define('_NOTIFY_CONTENTS',		'Contenu:');

// member mail message
try_define('_MMAIL_MSG',			'Vous avez reçu un message de');
try_define('_MMAIL_FROMANON',		'un visiteur anonyme');
try_define('_MMAIL_FROMNUC',		'Posté depuis un weblog Nucleus à');
try_define('_MMAIL_TITLE',			'Un message de');
try_define('_MMAIL_MAIL',			'Message:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
try_define('_BMLET_ADD',			'Ajouter un  billet');
try_define('_BMLET_EDIT',			'Modifier un billet');
try_define('_BMLET_DELETE',			'Effacer un billet');
try_define('_BMLET_BODY',			'Corps');
try_define('_BMLET_MORE',			'Développement');
try_define('_BMLET_OPTIONS',		'Options');
try_define('_BMLET_PREVIEW',		'Prévisualisation');

// used in bookmarklet
try_define('_ITEM_UPDATED',			'Billet mis à jour');
try_define('_ITEM_DELETED',			'Billet effacé');

// plugins
try_define('_CONFIRMTXT_PLUGIN',		'Etes-vous sur de vouloir supprimer ce module?');
try_define('_ERROR_NOSUCHPLUGIN',		'Pas de module correspondant');
try_define('_ERROR_DUPPLUGIN',		'Désolé, ce module est déjà installé');
try_define('_ERROR_PLUGFILEERROR',		'Ce module n\'existe pas, ou les permissions sont mal configurées');
try_define('_PLUGS_NOCANDIDATES',		'Pas de module valide trouvé');

try_define('_PLUGS_TITLE_MANAGE',		'Gérer les modules');
try_define('_PLUGS_TITLE_INSTALLED',	'Déjà installés');
try_define('_PLUGS_TITLE_UPDATE',		'Mettre à jour la liste des installations');
try_define('_PLUGS_TEXT_UPDATE',		'Nucleus garde un cache des inscriptions des modules. Quand vous mettez à jour un module en remplaçant son fichier, vous devez utiliser cette fonction pour mettre à jour le cache.');
try_define('_PLUGS_TITLE_NEW',		'Installer un nouveau module');
try_define('_PLUGS_ADD_TEXT',		'Vous trouverez ci-dessous la liste de tous les fichiers contenus dans votre répertoire de plugins. Il peut s\'agir de modules non-installés. Soyez <strong>vraiment</strong> sûr qu\'il s\'agit d\'un module avant de l\'ajouter.');
try_define('_PLUGS_BTN_INSTALL',		'Installer le module');
try_define('_BACKTOOVERVIEW',		'Retour au sommaire');

// editlink
try_define('_TEMPLATE_EDITLINK',		'Modifier le lien du billet');

// add left / add right tooltips
try_define('_ADD_LEFT_TT',			'Ajouter un cadre à gauche');
try_define('_ADD_RIGHT_TT',			'Ajouter un cadre à droite');

// add/edit item: new category (in dropdown box)
try_define('_ADD_NEWCAT',			'Nouveau thème...');

// new settings
try_define('_SETTINGS_PLUGINURL',		'URL des modules');
try_define('_SETTINGS_MAXUPLOADSIZE',	'Taille maxi. du fichier téléchargé (bytes)');
try_define('_SETTINGS_NONMEMBERMSGS',	'Autoriser les non-participants à envoyer des messages');
try_define('_SETTINGS_PROTECTMEMNAMES',	'Protéger les noms des participants');

// overview screen
try_define('_OVERVIEW_PLUGINS',		'Gérer les modules...');

// actionlog
try_define('_ACTIONLOG_NEWMEMBER',		'Inscription d\'un nouveau participant:');

// membermail (when not logged in)
try_define('_MEMBERMAIL_MAIL',		'Votre adresse email:');

// file upload
try_define('_ERROR_DISALLOWEDUPLOAD2',	'Vous n\'avez pas les droits d\'admin sur les blogs de ce participant. Vous n\'êtes donc pas autorisé à télécharger de fichier sur le répertoire media de ce participant.');

// plugin list
try_define('_LISTS_INFO',			'Information');
try_define('_LIST_PLUGS_AUTHOR',		'de:');
try_define('_LIST_PLUGS_VER',		'Version:');
try_define('_LIST_PLUGS_SITE',		'Visiter le site');
try_define('_LIST_PLUGS_DESC',		'Description:');
try_define('_LIST_PLUGS_SUBS',		'Inscription aux évènements suivants:');
try_define('_LIST_PLUGS_UP',		'monter');
try_define('_LIST_PLUGS_DOWN',		'descendre');
try_define('_LIST_PLUGS_UNINSTALL',		'désinstaller');
try_define('_LIST_PLUGS_ADMIN',		'admin');
try_define('_LIST_PLUGS_OPTIONS',		'modifier les options');

// plugin option list
try_define('_LISTS_VALUE',			'Valeur');

// plugin options
try_define('_ERROR_NOPLUGOPTIONS',		'ce plugin n\'a pas d\'option');
try_define('_PLUGS_BACK',			'Retour au menu des modules');
try_define('_PLUGS_SAVE',			'Sauvegarder les options');
try_define('_PLUGS_OPTIONS_UPDATED',	'Options du module mises à jour');

try_define('_OVERVIEW_MANAGEMENT',		'Gestion');
try_define('_OVERVIEW_MANAGE',		'Gestion de Nucleus...');
try_define('_MANAGE_GENERAL',		'Gestion globale');
try_define('_MANAGE_SKINS',			'Habillages et modèles');
try_define('_MANAGE_EXTRA',			'Options supplémentaires');

try_define('_BACKTOMANAGE',			'Retour au menu de gestion de Nucleus');


// END introduced after v1.1 END





// global stuff
try_define('_LOGOUT',			'Déconnexion');
try_define('_LOGIN',			'Connexion');
try_define('_YES',				'Oui');
try_define('_NO',				'Non');
try_define('_SUBMIT',			'Envoyer');
try_define('_ERROR',			'Erreur');
try_define('_ERRORMSG',			'Une erreur est survenue!');
try_define('_BACK',				'Retour');
try_define('_NOTLOGGEDIN',			'Non connecté');
try_define('_LOGGEDINAS',			'Connecté en tant que');
try_define('_ADMINHOME',			'Accueil');
try_define('_NAME',				'Nom');
try_define('_BACKHOME',			'Retour à l\'accueil');
try_define('_BADACTION',			'Action inconnue');
try_define('_MESSAGE',			'Message');
try_define('_HELP_TT',			'Aide!');
try_define('_YOURSITE',			'Votre site');


try_define('_POPUP_CLOSE',			'Fermer la fenêtre');

try_define('_LOGIN_PLEASE',			'Connectez-vous d\'abord, SVP');

// commentform
try_define('_COMMENTFORM_YOUARE',		'Vous êtes');
try_define('_COMMENTFORM_SUBMIT',		'Ajouter un commentaire');
try_define('_COMMENTFORM_COMMENT',		'Votre commentaire');
try_define('_COMMENTFORM_NAME',		'Nom');
try_define('_COMMENTFORM_MAIL',		'Email/HTTP');
try_define('_COMMENTFORM_REMEMBER',		'Retenir votre nom');

// loginform
try_define('_LOGINFORM_NAME',		'Nom d\'utilisateur');
try_define('_LOGINFORM_PWD',		'Mot de passe');
try_define('_LOGINFORM_YOUARE',		'Connecté en tant que');
try_define('_LOGINFORM_SHARED',		'Ordinateur partagé');

// member mailform
try_define('_MEMBERMAIL_SUBMIT',		'Envoyer un message');

// search form
try_define('_SEARCHFORM_SUBMIT',		'Rechercher');

// add item form
try_define('_ADD_ADDTO',			'Ajouter un billet à');
try_define('_ADD_CREATENEW',		'Créer un nouveau billet');
try_define('_ADD_BODY',			'Corps');
try_define('_ADD_TITLE',			'Titre');
try_define('_ADD_MORE',			'Développement (facultatif)');
try_define('_ADD_CATEGORY',			'Thème');
try_define('_ADD_PREVIEW',			'Prévisualisation');
try_define('_ADD_DISABLE_COMMENTS',		'Interdire les commentaires?');
try_define('_ADD_DRAFTNFUTURE',		'Brouillons &amp; billets à venir');
try_define('_ADD_ADDITEM',			'Ajouter le billet');
try_define('_ADD_ADDNOW',			'Ajouter maintenant');
try_define('_ADD_ADDLATER',			'Ajouter plus tard');
try_define('_ADD_PLACE_ON',			'Daté du');
try_define('_ADD_ADDDRAFT',			'Ajouter aux brouillons');
try_define('_ADD_NOPASTDATES',		'(Les dates et heures passées ne sont pas valides, la date d\'aujourd\'hui sera utilisée)');
try_define('_ADD_BOLD_TT',			'Gras');
try_define('_ADD_ITALIC_TT',		'Italiques');
try_define('_ADD_HREF_TT',			'Faire un lien');
try_define('_ADD_MEDIA_TT',			'Ajouter un document');
try_define('_ADD_PREVIEW_TT',		'Montrer/cacher la prévisualisation');
try_define('_ADD_CUT_TT',			'Couper');
try_define('_ADD_COPY_TT',			'Copier');
try_define('_ADD_PASTE_TT',			'Coller');


// edit item form
try_define('_EDIT_ITEM',			'Modifier le billet');
try_define('_EDIT_SUBMIT',			'Valider');
try_define('_EDIT_ORIG_AUTHOR',		'Auteur');
try_define('_EDIT_BACKTODRAFTS',		'Remettre aux brouillons');
try_define('_EDIT_COMMENTSNOTE',		'(NB: Désactiver les commentaires ne cachera pas les anciens)');

// used on delete screens
try_define('_DELETE_CONFIRM',		'SVP, confirmez la suppression');
try_define('_DELETE_CONFIRM_BTN',		'Confirmer');
try_define('_CONFIRMTXT_ITEM',		'Vous allez effacer le billet suivant:');
try_define('_CONFIRMTXT_COMMENT',		'Vous allez effacer le commentaire suivant:');
try_define('_CONFIRMTXT_TEAM1',		'Vous allez effacer ');
try_define('_CONFIRMTXT_TEAM2',		' de l\'équipe pour le blog ');
try_define('_CONFIRMTXT_BLOG',		'Le blog que vous allez effacer est: ');
try_define('_WARNINGTXT_BLOGDEL',		'Attention! Effacer un blog effarcera TOUS les billets de ce blog et tous les commentaires associés. Soyez certain de ne pas faire erreur. <br />Et n\'interrompez pas le processus.');
try_define('_CONFIRMTXT_MEMBER',		'Vous allez effacer le profil du participant suivant: ');
try_define('_CONFIRMTXT_TEMPLATE',		'Vous allez effacer le modèle  ');
try_define('_CONFIRMTXT_SKIN',		'Vous allez effacer l\'habillage ');
try_define('_CONFIRMTXT_BAN',		'Vous allez annuler l\'exclusion de la plage IP');
try_define('_CONFIRMTXT_CATEGORY',		'Vous allez effacer le thème ');

// some status messages
try_define('_DELETED_ITEM',			'Billet supprimé');
try_define('_DELETED_MEMBER',		'Participant effacé');
try_define('_DELETED_COMMENT',		'Commentaire supprimé');
try_define('_DELETED_BLOG',			'Blog effacé');
try_define('_DELETED_CATEGORY',		'Categorie supprimée');
try_define('_ITEM_MOVED',			'Billet déplacé');
try_define('_ITEM_ADDED',			'Billet ajouté');
try_define('_COMMENT_UPDATED',		'Commentaire mis à jour');
try_define('_SKIN_UPDATED',			'Habillage modifié');
try_define('_TEMPLATE_UPDATED',		'Modèle modifié');

// errors
try_define('_ERROR_COMMENT_LONGWORD',	'SVP, n\'employez pas de mot de plus de 90 caractères dans votre commentaire');
try_define('_ERROR_COMMENT_NOCOMMENT',	'Tapez votre commentaire');
try_define('_ERROR_COMMENT_NOUSERNAME',	'Nom invalide');
try_define('_ERROR_COMMENT_TOOLONG',	'Votre commentaire est trop long (max. 5000 cars)');
try_define('_ERROR_COMMENTS_DISABLED',	'Les commentaires sur ce blog sont actuellement désactivés.');
try_define('_ERROR_COMMENTS_NONPUBLIC',	'Vous devez être connecté en tant que participant pour pouvoir commenter ce blog.');
try_define('_ERROR_COMMENTS_MEMBERNICK',	'Ce nom est déjà utilisé par un participant du blog. Choisissez autre chose.');
try_define('_ERROR_SKIN',			'Erreur d\'habillage');
try_define('_ERROR_ITEMCLOSED',		'Ce billet est protégé. Il n\'est pas possible de le commenter ni de voter pour lui.');
try_define('_ERROR_NOSUCHITEM',		'Billet inexistant');
try_define('_ERROR_NOSUCHBLOG',		'Blog inexistant');
try_define('_ERROR_NOSUCHSKIN',		'Habillage inexistant');
try_define('_ERROR_NOSUCHMEMBER',		'Participant inexistant');
try_define('_ERROR_NOTONTEAM',		'Vous n\'appartenez pas à l\'équipe de ce blog.');
try_define('_ERROR_BADDESTBLOG',		'Le blog de destination n\'existe pas.');
try_define('_ERROR_NOTONDESTTEAM',		'Impossible de déplacer le billet car vous ne faites pas partie de l\'équipe du blog de destination.');
try_define('_ERROR_NOEMPTYITEMS',		'Impossible d\'ajouter un billet vide!');
try_define('_ERROR_BADMAILADDRESS',		'Adresse email incorrecte');
try_define('_ERROR_BADNOTIFY',		'Adresse(s) de notification incorrecte(s)');
try_define('_ERROR_BADNAME',		'Nom incorrect (seuls les lettres de a à z et les chiffres de 0 à 9 sont autorisés, sans espace au début ni à la fin)');
try_define('_ERROR_NICKNAMEINUSE',		'Un autre participant utilise déjà ce nom');
try_define('_ERROR_PASSWORDMISMATCH',	'Les mots de passe doivent correspondre');
try_define('_ERROR_PASSWORDTOOSHORT',	'Le mot de passe doit commprendre au moins 6 caractères');
try_define('_ERROR_PASSWORDMISSING',	'Il FAUT un mot de passe');
try_define('_ERROR_REALNAMEMISSING',	'Vous devez inscrire votre nom');
try_define('_ERROR_ATLEASTONEADMIN',	'Il doit toujours y avoir un super admin qui puisse se connecter.');
try_define('_ERROR_ATLEASTONEBLOGADMIN',	'Cela empêcherait la gestion de votre blog. Assurez-vous qu\'il y ait toujours au-moins un administrateur.');
try_define('_ERROR_ALREADYONTEAM',		'Ce participant est déjà dans l\'équipe');
try_define('_ERROR_BADSHORTBLOGNAME',	'Le diminutif du blog ne peut contenir que des lettres de a à z et des chiffres de 0 à 9, sans espace.');
try_define('_ERROR_DUPSHORTBLOGNAME',	'Un autre blog utilise déjà ce diminutif. Les diminutifs doivent être uniques.');
try_define('_ERROR_UPDATEFILE',		'Impossible de mettre à jour le fichier. Vérifiez le réglage de permissions d\'écriture (faites un chmod 666). Remarquez aussi que le chemin est relatif au répertoire de la zone admin ; vous devriez utiliser un chemin absolu (quelque chose comme /votre/chemin/vers/nucleus/)');
try_define('_ERROR_DELDEFBLOG',		'Impossible d\'effacer le blog par défaut');
try_define('_ERROR_DELETEMEMBER',		'Impossible de supprimer ce participant car il est probablement l\'auteur de billets ou de commentaires.');
try_define('_ERROR_BADTEMPLATENAME',	'Nom de modèle incorrect, n\'utilisez que des lettres de a à z et des chiffres de 0 à 9, sans espace.');
try_define('_ERROR_DUPTEMPLATENAME',	'Il existe déjà un modèle de ce nom');
try_define('_ERROR_BADSKINNAME',		'Nom d\'habillage incorrect, n\'utilisez que des lettres de a à z et des chiffres de 0 à 9, sans espace.');
try_define('_ERROR_DUPSKINNAME',		'Il existe déjà un habillage de ce nom');
try_define('_ERROR_DEFAULTSKIN',		'Il doit toujours subsister un habillage nommé "default"');
try_define('_ERROR_SKINDEFDELETE',		'Impossible de supprimer l\'habillage car il s\'agit de l\'habillage par défaut du blog: ');
try_define('_ERROR_DISALLOWED',		'Vous n\'êtes pas autorisé à faire cela');
try_define('_ERROR_DELETEBAN',		'Erreur en essayant de supprimer l\'exclusion (elle n\'existe pas)');
try_define('_ERROR_ADDBAN',			'Erreur en essayant d\'ajouter l\'exclusion. L\'exclusion n\'a pas été ajoutée correctement dans tous vos blogs.');
try_define('_ERROR_BADACTION',		'L\'action demandée n\'existe pas');
try_define('_ERROR_MEMBERMAILDISABLED',	'Messages de participant à participant désactivés');
try_define('_ERROR_MEMBERCREATEDISABLED',	'Creation de nouveaux comptes désactivée');
try_define('_ERROR_INCORRECTEMAIL',		'Email incorrect');
try_define('_ERROR_VOTEDBEFORE',		'Vous avez déjà voté pour ce billet');
try_define('_ERROR_BANNED1',		'Action impossible car vous (plage IP ');
try_define('_ERROR_BANNED2',			') êtes exclu. Le message était: \'');
try_define('_ERROR_BANNED3',			'\'');
try_define('_ERROR_LOGINNEEDED',		'Vous devez être connecté pour faire cela');
try_define('_ERROR_CONNECT',		'Erreur de connexion');
try_define('_ERROR_FILE_TOO_BIG',		'Fichier trop gros!');
try_define('_ERROR_BADFILETYPE',		'Désolé, cette extension n\'est pas autorisée');
try_define('_ERROR_BADREQUEST',		'Mauvaise demande de téléchargement');
try_define('_ERROR_DISALLOWEDUPLOAD',	'Vous ne faites partie d\'aucune équipe. Vous n\'êtes donc pas autorisé à télécharger des fichiers.');
try_define('_ERROR_BADPERMISSIONS',		'Les permissions de fichiers/répertoires ne sont pas correctement configurées');
try_define('_ERROR_UPLOADMOVEP',		'Erreur de déplacement de fichier');
try_define('_ERROR_UPLOADCOPY',		'Erreur de copie de fichier');
try_define('_ERROR_UPLOADDUPLICATE',	'Un fichier de ce nom existe déjà. Essayez de le renommer avant de le télécharger.');
try_define('_ERROR_LOGINDISALLOWED',	'Désolé, vous n\'êtes pas autorisé à vous connecter à la zone admin. Vous pouvez vous connecter sous un autre nom');
try_define('_ERROR_DBCONNECT',		'Impossible de se connecter au serveur mySQL');
try_define('_ERROR_DBSELECT',		'Impossible de sélectionner la base Nucleus.');
try_define('_ERROR_NOSUCHLANGUAGE',		'Fichier de langue indisponible');
try_define('_ERROR_NOSUCHCATEGORY',		'Thème indisponible');
try_define('_ERROR_DELETELASTCATEGORY',	'Il doit y avoir au moins un thème');
try_define('_ERROR_DELETEDEFCATEGORY',	'Impossible d\'effacerle thème par défaut');
try_define('_ERROR_BADCATEGORYNAME',	'Nom de thème incorrect');
try_define('_ERROR_DUPCATEGORYNAME',	'Ce thème existe déjà');

// some warnings (used for mediadir setting)
try_define('_WARNING_NOTADIR',		'Attention: ceci n\'est pas un répertoire!');
try_define('_WARNING_NOTREADABLE',		'Attention: ceci n\'est pas un répertoire avec droit de lecture!');
try_define('_WARNING_NOTWRITABLE',		'Attention: ceci n\'est pas un répertoire avec droit d\'écriture!');

// media and upload
try_define('_MEDIA_UPLOADLINK',		'Télécharger un nouveau fichier');
try_define('_MEDIA_MODIFIED',		'modifié');
try_define('_MEDIA_FILENAME',		'nom de fichier');
try_define('_MEDIA_DIMENSIONS',		'dimensions');
try_define('_MEDIA_INLINE',			'Inséré');
try_define('_MEDIA_POPUP',			'Popup');
try_define('_UPLOAD_TITLE',			'Choisir le fichier');
try_define('_UPLOAD_MSG',			'Sélectionnez le fichier à télécharger ci-dessous et pressez le bouton \'Télécharger\'.');
try_define('_UPLOAD_BUTTON',		'Télécharger');

// some status messages
//try_define('_MSG_ACCOUNTCREATED',		'Compte créé, le mot de passe sera envoyé par email');
//try_define('_MSG_PASSWORDSENT',		'Mot de passe envoyé par email');
try_define('_MSG_LOGINAGAIN',		'Vous devrez vous reconnecter car vos informations ont changé');
try_define('_MSG_SETTINGSCHANGED',		'Réglages modifiés');
try_define('_MSG_ADMINCHANGED',		'Admin changé');
try_define('_MSG_NEWBLOG',			'Nouveau blog créé');
try_define('_MSG_ACTIONLOGCLEARED',		'Journal effacé');

// actionlog in admin area
try_define('_ACTIONLOG_DISALLOWED',		'Action interdite: ');
try_define('_ACTIONLOG_PWDREMINDERSENT',	'Nouveau mot de passe envoyé pour ');
try_define('_ACTIONLOG_TITLE',		'Journal des événements');
try_define('_ACTIONLOG_CLEAR_TITLE',	'Effacer le journal des événements');
try_define('_ACTIONLOG_CLEAR_TEXT',		'Effacer le journal des événements maintenant');

// team management
try_define('_TEAM_TITLE',			'Gérer les participants ');
try_define('_TEAM_CURRENT',			'Equipe actuelle');
try_define('_TEAM_ADDNEW',			'Ajouter un participant');
try_define('_TEAM_CHOOSEMEMBER',		'Choisir un participant');
try_define('_TEAM_ADMIN',			'Privilèges d\'administrateur? ');
try_define('_TEAM_ADD',			'Ajouter à l\'équipe');
try_define('_TEAM_ADD_BTN',			'Ajouter!');

// blogsettings
try_define('_EBLOG_TITLE',			'Modifier les réglages du blog');
try_define('_EBLOG_TEAM_TITLE',		'Modifier l\'équipe');
try_define('_EBLOG_TEAM_TEXT',		'Cliquez ici pour modifier votre équipe...');
try_define('_EBLOG_SETTINGS_TITLE',		'Réglages du blog');
try_define('_EBLOG_NAME',			'Nom du blog');
try_define('_EBLOG_SHORTNAME',		'Diminutif');
try_define('_EBLOG_SHORTNAME_EXTRA',	'<br />(seulement de a à z et sans espace)');
try_define('_EBLOG_DESC',			'Description');
try_define('_EBLOG_URL',			'URL');
try_define('_EBLOG_DEFSKIN',		'Habillage par défaut');
try_define('_EBLOG_DEFCAT',			'Thème par défaut');
try_define('_EBLOG_LINEBREAKS',		'Convertir les sauts de ligne');
try_define('_EBLOG_DISABLECOMMENTS',	'Activer les commentaires?<br /><small>(Cela signifie qu\'il sera impossible d\'en ajouter.)</small>');
try_define('_EBLOG_ANONYMOUS',		'Autoriser les commentaires par des non-participants?');
try_define('_EBLOG_NOTIFY',			'Adresse(s) de notification (séparées par des ;)');
try_define('_EBLOG_NOTIFY_ON',		'Notification activée');
try_define('_EBLOG_NOTIFY_COMMENT',		'Nouveaux commentaires');
try_define('_EBLOG_NOTIFY_KARMA',		'Nouveaux votes karma');
try_define('_EBLOG_NOTIFY_ITEM',		'Nouveau billet');
try_define('_EBLOG_PING',			'Pinger Weblogs.com à la mise à jour?');
try_define('_EBLOG_MAXCOMMENTS',		'Nombre maximum de commentaires');
try_define('_EBLOG_UPDATE',			'Fichier de mise-à-jour');
try_define('_EBLOG_OFFSET',			'Décalage horaire');
try_define('_EBLOG_STIME',			'Heure du serveur:');
try_define('_EBLOG_BTIME',			'Heure du blog:');
try_define('_EBLOG_CHANGE',			'Changer les réglages');
try_define('_EBLOG_CHANGE_BTN',		'Valider');
try_define('_EBLOG_ADMIN',			'Gérer le blog');
try_define('_EBLOG_ADMIN_MSG',		'Les privilèges d\'administrateur vous seront attribués');
try_define('_EBLOG_CREATE_TITLE',		'Créer un nouveau blog');
try_define('_EBLOG_CREATE_TEXT',		'Remplissez le formulaire ci-dessous pour créer un nouveau blog. <br /><br /> <b>NB:</b> Seules les options nécessaires sont listées. Pour plus d\'options, changez les paramètres après la création.');
try_define('_EBLOG_CREATE',			'Créer le blog');
try_define('_EBLOG_CREATE_BTN',		'Créer');
try_define('_EBLOG_CAT_TITLE',		'Thèmes');
try_define('_EBLOG_CAT_NAME',		'Thèmes');
try_define('_EBLOG_CAT_DESC',		'Description du thème');
try_define('_EBLOG_CAT_CREATE',		'Créer un nouveau thème');
try_define('_EBLOG_CAT_UPDATE',		'Mettre à jour le thème');
try_define('_EBLOG_CAT_UPDATE_BTN',		'Mettre à jour le thème');

// templates
try_define('_TEMPLATE_TITLE',		'Modifier les modèles');
try_define('_TEMPLATE_AVAILABLE_TITLE',	'Modèles disponibles');
try_define('_TEMPLATE_NEW_TITLE',		'Nouveau modèle');
try_define('_TEMPLATE_NAME',		'Nom du modèle');
try_define('_TEMPLATE_DESC',		'Description du modèle');
try_define('_TEMPLATE_CREATE',		'Créer le modèle');
try_define('_TEMPLATE_CREATE_BTN',		'Créer le modèle');
try_define('_TEMPLATE_EDIT_TITLE',		'Modifier le modèle');
try_define('_TEMPLATE_BACK',		'Retour au sommaire des modèles');
try_define('_TEMPLATE_EDIT_MSG',		'Tous les éléments de modèle ne sont pas nécessaires. Laissez vides ceux dont vous n\'avez pas besoin');
try_define('_TEMPLATE_SETTINGS',		'Réglages de modèle');
try_define('_TEMPLATE_ITEMS',		'Billet');
try_define('_TEMPLATE_ITEMHEADER',		'En-tête du billet');
try_define('_TEMPLATE_ITEMBODY',		'Corps du billet');
try_define('_TEMPLATE_ITEMFOOTER',		'Pied du billet');
try_define('_TEMPLATE_MORELINK',		'Lien vers le développement');
try_define('_TEMPLATE_NEW',			'Indication de nouveau billet');
try_define('_TEMPLATE_COMMENTS_ANY',	'Commentaires (si nécessaire)');
try_define('_TEMPLATE_CHEADER',		'En-tête des commentaires');
try_define('_TEMPLATE_CBODY',		'Corps des commentaires');
try_define('_TEMPLATE_CFOOTER',		'Pied des commentaires');
try_define('_TEMPLATE_CONE',		'Un seul commentaire');
try_define('_TEMPLATE_CMANY',		'Deux (ou plus) commentaires');
try_define('_TEMPLATE_CMORE',		'Commentaires: en voir plus');
try_define('_TEMPLATE_CMEXTRA',		'Infos participant');
try_define('_TEMPLATE_COMMENTS_NONE',	'Commentaire (si aucun)');
try_define('_TEMPLATE_CNONE',		'Pas de commentaire');
try_define('_TEMPLATE_COMMENTS_TOOMUCH',	'Commentaires (s\'il y en a, mais trop pour les montrer tous)');
try_define('_TEMPLATE_CTOOMUCH',		'Trop de commentaires');
try_define('_TEMPLATE_ARCHIVELIST',		'Listes d\'archives');
try_define('_TEMPLATE_AHEADER',		'En-tête d\'archives');
try_define('_TEMPLATE_AITEM',		'Archive (billet)');
try_define('_TEMPLATE_AFOOTER',		'Pied de liste d\'archives');
try_define('_TEMPLATE_DATETIME',		'Date et heure');
try_define('_TEMPLATE_DHEADER',		'En-tête de date');
try_define('_TEMPLATE_DFOOTER',		'Pied de date');
try_define('_TEMPLATE_DFORMAT',		'Format de la date');
try_define('_TEMPLATE_TFORMAT',		'Format de l\'heure');
try_define('_TEMPLATE_LOCALE',		'Locale');
try_define('_TEMPLATE_IMAGE',		'Fenêtre popup');
try_define('_TEMPLATE_PCODE',		'Code de lien popup');
try_define('_TEMPLATE_ICODE',		'Code d\'image insérée');
try_define('_TEMPLATE_MCODE',		'Code lien objet media');
try_define('_TEMPLATE_SEARCH',		'Recherche');
try_define('_TEMPLATE_SHIGHLIGHT',		'Surbrillance');
try_define('_TEMPLATE_SNOTFOUND',		'Rien trouvé');
try_define('_TEMPLATE_UPDATE',		'Mettre à jour');
try_define('_TEMPLATE_UPDATE_BTN',		'Mettre à jour le modème');
try_define('_TEMPLATE_RESET_BTN',		'Rétablir les données');
try_define('_TEMPLATE_CATEGORYLIST',	'Listes de thèmes');
try_define('_TEMPLATE_CATHEADER',		'En-tête de liste de thèmes');
try_define('_TEMPLATE_CATITEM',		'Liste des thèmes (billet)');
try_define('_TEMPLATE_CATFOOTER',		'Pied de liste de thèmes');

// skins
try_define('_SKIN_EDIT_TITLE',		'Modification des habillages');
try_define('_SKIN_AVAILABLE_TITLE',		'Habillages disponibles');
try_define('_SKIN_NEW_TITLE',		'Nouvel habillage');
try_define('_SKIN_NAME',			'Nom');
try_define('_SKIN_DESC',			'Description');
try_define('_SKIN_TYPE',			'Type de contenu');
try_define('_SKIN_CREATE',			'Créer l\'habillage');
try_define('_SKIN_CREATE_BTN',		'Créer');
try_define('_SKIN_EDITONE_TITLE',		'Modifier l\'habillage');
try_define('_SKIN_BACK',			'Retour au menu habillage');
try_define('_SKIN_PARTS_TITLE',		'Elements d\'habillage');
try_define('_SKIN_PARTS_MSG',		'Tous les éléments ne sont pas requis. Laissez vides ceux dont vous n\'avez pas esoin. Choisissez ci-dessous l\'élément d\'habillage à modifier:');
try_define('_SKIN_PART_MAIN',		'Page index');
try_define('_SKIN_PART_ITEM',		'Page billet');
try_define('_SKIN_PART_ALIST',		'Liste des archives');
try_define('_SKIN_PART_ARCHIVE',		'Archive');
try_define('_SKIN_PART_SEARCH',		'Recherche');
try_define('_SKIN_PART_ERROR',		'Erreurs');
try_define('_SKIN_PART_MEMBER',		'Fiches des participants');
try_define('_SKIN_PART_POPUP',		'Fenêtres Popups');
try_define('_SKIN_GENSETTINGS_TITLE',	'Réglages d\'ensemble');
try_define('_SKIN_CHANGE',			'Modifier');
try_define('_SKIN_CHANGE_BTN',		'Modifier ces réglages');
try_define('_SKIN_UPDATE_BTN',		'Mettre à jour');
try_define('_SKIN_RESET_BTN',		'Rétablir');
try_define('_SKIN_EDITPART_TITLE',		'Modifier l\'habillage');
try_define('_SKIN_GOBACK',			'Retour');
try_define('_SKIN_ALLOWEDVARS',		'Variables autorisées (cliquer pour info):');

// global settings
try_define('_SETTINGS_TITLE',		'Réglages d\'ensemble');
try_define('_SETTINGS_SUB_GENERAL',		'Réglages d\'ensemble');
try_define('_SETTINGS_DEFBLOG',		'Blog par défaut');
try_define('_SETTINGS_ADMINMAIL',		'Email de l\'administrateur');
try_define('_SETTINGS_SITENAME',		'Nom du site');
try_define('_SETTINGS_SITEURL',		'URL du site (terminé par un /)');
try_define('_SETTINGS_ADMINURL',		'URL de la zone admin (terminé par un /)');
try_define('_SETTINGS_DIRS',		'Répertoires Nucleus');
try_define('_SETTINGS_MEDIADIR',		'Répertoire media');
try_define('_SETTINGS_SEECONFIGPHP',	'(voir config.php)');
try_define('_SETTINGS_MEDIAURL',		'URL du repertoire media (terminé par un /)');
try_define('_SETTINGS_ALLOWUPLOAD',		'Autoriser le téléchargement ascendant de fichier?');
try_define('_SETTINGS_ALLOWUPLOADTYPES',	'Indiquer les extensions de fichier autorisées');
try_define('_SETTINGS_CHANGELOGIN',		'Autoriser les participants à changer de login/mot de passe?');
try_define('_SETTINGS_COOKIES_TITLE',	'Paramètres des cookies');
try_define('_SETTINGS_COOKIELIFE',		'Durée de vie du cookie de connexion');
try_define('_SETTINGS_COOKIESESSION',	'Cookies de session');
try_define('_SETTINGS_COOKIEMONTH',		'Durée de vie d\'un mois');
try_define('_SETTINGS_COOKIEPATH',		'Chemin du cookie (utilisateur averti)');
try_define('_SETTINGS_COOKIEDOMAIN',	'Domaine du cookie (utilisateur averti)');
try_define('_SETTINGS_COOKIESECURE',	'Cookie de sécurité (utilisateur averti)');
try_define('_SETTINGS_LASTVISIT',		'Garder les cookies de la dernière visite');
try_define('_SETTINGS_ALLOWCREATE',		'Autoriser les visiteurs à créer un compte');
try_define('_SETTINGS_NEWLOGIN',		'Connexion autorisée pour les comptes créés par des utilisateurs');
try_define('_SETTINGS_NEWLOGIN2',		'(ne vaut que pour les comptes récemment créés)');
try_define('_SETTINGS_MEMBERMSGS',		'Autoriser les services de participant à participant');
try_define('_SETTINGS_LANGUAGE',		'Langue par défaut');
try_define('_SETTINGS_DISABLESITE',		'Désactiver le site');
try_define('_SETTINGS_DBLOGIN',		'mySQL Login &amp; Database');
try_define('_SETTINGS_UPDATE',		'Mettre à jour les réglages');
try_define('_SETTINGS_UPDATE_BTN',		'Mettre à jour');
try_define('_SETTINGS_DISABLEJS',		'Désactiver la barre d\'outils JavaScript');
try_define('_SETTINGS_MEDIA',		'Paramètres de téléchargement de médias');
try_define('_SETTINGS_MEDIAPREFIX',		'Préfixer le nom des fichiers avec la date');
try_define('_SETTINGS_MEMBERS',		'Réglages des participants');

// bans
try_define('_BAN_TITLE',			'Liste des exclusions pour');
try_define('_BAN_NONE',			'Pas d\'exclusion pour ce blog');
try_define('_BAN_NEW_TITLE',		'Ajouter une exclusion');
try_define('_BAN_NEW_TEXT',			'Ajouter une exclusion maintenant');
try_define('_BAN_REMOVE_TITLE',		'Retirer une exclusion');
try_define('_BAN_IPRANGE',			'Plage IP');
try_define('_BAN_BLOGS',			'Quels blogs?');
try_define('_BAN_DELETE_TITLE',		'Supprimer une exclusion');
try_define('_BAN_ALLBLOGS',			'Tous les blogs dont vous êtes administrateur.');
try_define('_BAN_REMOVED_TITLE',		'Exclusion supprimée');
try_define('_BAN_REMOVED_TEXT',		'L\'exclusion a été supprimée pour les blogs suivants:');
try_define('_BAN_ADD_TITLE',		'Définir des exclusions');
try_define('_BAN_IPRANGE_TEXT',		'Choisissez la plage IP que vous voulez bloquer. Moins il y aura de nombres, plus il y aura d\'IP bloquées.');
try_define('_BAN_BLOGS_TEXT',		'Vous pouvez choisir d\'exclure une IP pour un blog seulement ou pour tous ceux dont vous êtes admin. Choisissez ici.');
try_define('_BAN_REASON_TITLE',		'Motif');
try_define('_BAN_REASON_TEXT',		'Vous pouvez motiver l\'exclusion: La raison s\'affichera quand l\'IP concernée essaiera d\'ajouter un commentaire ou un vote. Longueur max. 256 caractères.');
try_define('_BAN_ADD_BTN',			'Exclure');

// LOGIN screen
try_define('_LOGIN_MESSAGE',		'Message');
try_define('_LOGIN_NAME',			'Nom');
try_define('_LOGIN_PASSWORD',		'Mot de passe');
try_define('_LOGIN_SHARED',			_LOGINFORM_SHARED);
try_define('_LOGIN_FORGOT',			'Mot de passe oublié?');

// membermanagement
try_define('_MEMBERS_TITLE',		'Gestion des participants');
try_define('_MEMBERS_CURRENT',		'Participants actuels');
try_define('_MEMBERS_NEW',			'Nouveau participant');
try_define('_MEMBERS_DISPLAY',		'Nom affiché');
try_define('_MEMBERS_DISPLAY_INFO',		'(C\'est le nom que vous utilisez pour vous connecter)');
try_define('_MEMBERS_REALNAME',		'Nom');
try_define('_MEMBERS_PWD',			'Mot de passe');
try_define('_MEMBERS_REPPWD',		'Répéter le mot de passe');
try_define('_MEMBERS_EMAIL',		'Adresse email');
try_define('_MEMBERS_EMAIL_EDIT',		'(Quand vous changez d\'adresse email, un nouveau mot de passe est envoyé à cette adresse)');
try_define('_MEMBERS_URL',			'Adresse du site (URL)');
try_define('_MEMBERS_SUPERADMIN',		'Privilèges de super admin');
try_define('_MEMBERS_CANLOGIN',		'Peut ouvrir une session comme admin');
try_define('_MEMBERS_NOTES',		'Notes');
try_define('_MEMBERS_NEW_BTN',		'Ajouter un participant');
try_define('_MEMBERS_EDIT',			'Modifier les participants');
try_define('_MEMBERS_EDIT_BTN',		'Modifier');
try_define('_MEMBERS_BACKTOOVERVIEW',	'Retour au sommaire des participants');
try_define('_MEMBERS_DEFLANG',		'Langue');
try_define('_MEMBERS_USESITELANG',		'- utiliser les réglages du site -');

// List of blogs (TT = tooltip)
try_define('_BLOGLIST_TT_VISIT',		'Visiter le site');
try_define('_BLOGLIST_ADD',			'Ajouter un billet');
try_define('_BLOGLIST_TT_ADD',		'Ajouter un billet à ce blog');
try_define('_BLOGLIST_EDIT',		'Modifier/Supprimer les billets');
try_define('_BLOGLIST_TT_EDIT',		'');
try_define('_BLOGLIST_BMLET',		'Bookmarklet');
try_define('_BLOGLIST_TT_BMLET',		'');
try_define('_BLOGLIST_SETTINGS',		'Paramètres');
try_define('_BLOGLIST_TT_SETTINGS',		'Modifier réglages ou gérer équipe');
try_define('_BLOGLIST_BANS',		'Exclusions');
try_define('_BLOGLIST_TT_BANS',		'Consulter, ajouter ou supprimer les exclusions IP');
try_define('_BLOGLIST_DELETE',		'Tout effacer');
try_define('_BLOGLIST_TT_DELETE',		'Effacer ce blog');

// OVERVIEW screen
try_define('_OVERVIEW_YRBLOGS',		'Vos blogs');
try_define('_OVERVIEW_YRDRAFTS',		'Vos brouillons');
try_define('_OVERVIEW_YRSETTINGS',		'Vos réglages');
try_define('_OVERVIEW_GSETTINGS',		'Réglages d\'ensemble');
try_define('_OVERVIEW_NOBLOGS',		'Vous ne faites partie d\'aucune équipe');
try_define('_OVERVIEW_NODRAFTS',		'Pas  de brouillon');
try_define('_OVERVIEW_EDITSETTINGS',	'Modifier vos réglages...');
try_define('_OVERVIEW_BROWSEITEMS',		'Consulter vos billets...');
try_define('_OVERVIEW_BROWSECOMM',		'Consulter vos commentaires...');
try_define('_OVERVIEW_VIEWLOG',		'Consulter le journal des événements...');
try_define('_OVERVIEW_MEMBERS',		'Gérer les participants...');
try_define('_OVERVIEW_NEWLOG',		'Créer un nouveau blog...');
try_define('_OVERVIEW_SETTINGS',		'Modifier les réglages...');
try_define('_OVERVIEW_TEMPLATES',		'Modifier les modèles...');
try_define('_OVERVIEW_SKINS',		'Modifier les habillages...');
try_define('_OVERVIEW_BACKUP',		'Sauvegarde/Récupération...');

// ITEMLIST
try_define('_ITEMLIST_BLOG',		'Billets du blog');
try_define('_ITEMLIST_YOUR',		'Vos billets');

// Comments
try_define('_COMMENTS',			'Commentaires');
try_define('_NOCOMMENTS',			'Pas de commentaire pour ce billet');
try_define('_COMMENTS_YOUR',		'Vos commentaires');
try_define('_NOCOMMENTS_YOUR',		'Vous n\'avez pas écrit de commentaire');

// LISTS (general)
try_define('_LISTS_NOMORE',			'Rien de plus ou pas de résultat du tout');
try_define('_LISTS_PREV',			'Précédent');
try_define('_LISTS_NEXT',			'Suivant');
try_define('_LISTS_SEARCH',			'Rechercher');
try_define('_LISTS_CHANGE',			'Changer');
try_define('_LISTS_PERPAGE',		'billets/page');
try_define('_LISTS_ACTIONS',		'Actions');
try_define('_LISTS_DELETE',			'Supprimer');
try_define('_LISTS_EDIT',			'Modifier');
try_define('_LISTS_MOVE',			'Déplacer');
try_define('_LISTS_CLONE',			'Dupliquer');
try_define('_LISTS_TITLE',			'Titre');
try_define('_LISTS_BLOG',			'Blog');
try_define('_LISTS_NAME',			'Nom');
try_define('_LISTS_DESC',			'Description');
try_define('_LISTS_TIME',			'Heure');
try_define('_LISTS_COMMENTS',		'Commentaires');
try_define('_LISTS_TYPE',			'Type');


// member list
try_define('_LIST_MEMBER_NAME',		'Nom affiché');
try_define('_LIST_MEMBER_RNAME',		'Nom');
try_define('_LIST_MEMBER_ADMIN',		'Super admin? ');
try_define('_LIST_MEMBER_LOGIN',		'Peut se connecter? ');
try_define('_LIST_MEMBER_URL',		'Site');

// banlist
try_define('_LIST_BAN_IPRANGE',		'Plage IP');
try_define('_LIST_BAN_REASON',		'Motif');

// actionlist
try_define('_LIST_ACTION_MSG',		'Message');

// commentlist
try_define('_LIST_COMMENT_BANIP',		'Exclure l\'IP');
try_define('_LIST_COMMENT_WHO',		'Auteur');
try_define('_LIST_COMMENT',			'Commentaire');
try_define('_LIST_COMMENT_HOST',		'Hôte');

// itemlist
try_define('_LIST_ITEM_INFO',		'Info');
try_define('_LIST_ITEM_CONTENT',		'Titre et contenu');


// teamlist
try_define('_LIST_TEAM_ADMIN',		'Admin ');
try_define('_LIST_TEAM_CHADMIN',		'Changer l\'admin');

// edit comments
try_define('_EDITC_TITLE',			'Modifier les commentaires');
try_define('_EDITC_WHO',			'Auteur');
try_define('_EDITC_HOST',			'D\'où?');
try_define('_EDITC_WHEN',			'Quand?');
try_define('_EDITC_TEXT',			'Contenu');
try_define('_EDITC_EDIT',			'Modifier le commentaire');
try_define('_EDITC_MEMBER',			'participant');
try_define('_EDITC_NONMEMBER',		'non participant');

// move item
try_define('_MOVE_TITLE',			'Déplacer dans quel blog?');
try_define('_MOVE_BTN',			'Déplacer le billet');

