<?
// French Nucleus Language File
// 
// Author: SECURIS team http://securis.info
// Nucleus version: v1.0-v2.0
//
// Please note: if you want to translate this file to your own language, be aware
// that in a next Nucleus version, new variables might be added and some other ones
// might be deleted. Therefor, it's important to list the Nucleus version for which 
// the file was written in your document.
//
// Fully translated language file can be sent to Wouter Demuynck (nucleus@demuynck.org)
// and will be available for download (with proper credit to the author, of course)

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'Permet de poster avec une date passée');
define('_ADD_CHANGEDATE',			'Mise à jour de la date');
define('_BMLET_CHANGEDATE',			'Mise à jour de la date');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'Habillage import/export...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Normal');
define('_PARSER_INCMODE_SKINDIR',	'Utiliser dossier habillage');
define('_SKIN_INCLUDE_MODE',		'Type d\'inclusion');
define('_SKIN_INCLUDE_PREFIX',		'Préfixe d\'inclusion');

// global settings
define('_SETTINGS_BASESKIN',		'Interface basique');
define('_SETTINGS_SKINSURL',		'Lien pour interface');
define('_SETTINGS_ACTIONSURL',		'Lien complet pour action.php');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'Ne peut pas déplacer la catégorie par défaut');
define('_ERROR_MOVETOSELF',			'Ne peut pas déplacer cette catégorie (le blogue de destination est le même que le blogue de source)');
define('_MOVECAT_TITLE',			'Sélectionnez le blogue dans lequel vous souhaitez déplacer cette catégorie');
define('_MOVECAT_BTN',				'Déplacer categorie');

// URLMode setting
define('_SETTINGS_URLMODE',			'Type de lien');
define('_SETTINGS_URLMODE_NORMAL',	'Normal');
define('_SETTINGS_URLMODE_PATHINFO','Fancy');

// Batch operations
define('_BATCH_NOSELECTION',		'Aucune action sélectionnée');
define('_BATCH_ITEMS',				'Actions pour les objets');
define('_BATCH_CATEGORIES',			'Actions pour les catégories');
define('_BATCH_MEMBERS',			'Actions pour les membres');
define('_BATCH_TEAM',				'Actions pour les membres d\une équipe');
define('_BATCH_COMMENTS',			'Actions pour les commentaires');
define('_BATCH_UNKNOWN',			'Action inconnue: ');
define('_BATCH_EXECUTING',			'En cours d\'exécution');
define('_BATCH_ONCATEGORY',			'pour une catégorie');
define('_BATCH_ONITEM',				'pour un objet');
define('_BATCH_ONCOMMENT',			'pour un commentaire');
define('_BATCH_ONMEMBER',			'pour un membre');
define('_BATCH_ONTEAM',				'pour le membre d\'une équipe');
define('_BATCH_SUCCESS',			'félicitation!');
define('_BATCH_DONE',				'réussi!');
define('_BATCH_DELETE_CONFIRM',		'Confirmer la suppression');
define('_BATCH_DELETE_CONFIRM_BTN',	'Confirmer la suppression');
define('_BATCH_SELECTALL',			'Tout sélectionner');
define('_BATCH_DESELECTALL',		'Tout désélectionner');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'Supprimer');
define('_BATCH_ITEM_MOVE',			'Déplacer');
define('_BATCH_MEMBER_DELETE',		'Supprimer');
define('_BATCH_MEMBER_SET_ADM',		'Donne les droits admin');
define('_BATCH_MEMBER_UNSET_ADM',	'Enlève les droits admin');
define('_BATCH_TEAM_DELETE',		'Supprimer de l\'équipe');
define('_BATCH_TEAM_SET_ADM',		'Donne les droits admin');
define('_BATCH_TEAM_UNSET_ADM',		'Enlève les droits admin');
define('_BATCH_CAT_DELETE',			'Supprimer');
define('_BATCH_CAT_MOVE',			'Déplacer dans un autre blogue');
define('_BATCH_COMMENT_DELETE',		'Supprimer');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'Ajouter un nouvel objet...');
define('_ADD_PLUGIN_EXTRAS',		'Extra Plugin Options');

// errors
define('_ERROR_CATCREATEFAIL',		'Impossible de créer une nouvelle catégorie');
define('_ERROR_NUCLEUSVERSIONREQ',	'Ce plugin requiert une version plus récente de Nucleus: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Retour configuration Blogue');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Importer');
define('_SKINIE_TITLE_EXPORT',		'Exporter');
define('_SKINIE_BTN_IMPORT',		'Importer');
define('_SKINIE_BTN_EXPORT',		'Exporter les habillages/modèles séléctionnés');
define('_SKINIE_LOCAL',				'Importer d\'un fichier local:');
define('_SKINIE_NOCANDIDATES',		'Pas d\'habillage valide trouvé dans le dossier skins');
define('_SKINIE_FROMURL',			'Importer à partir d\'un lien:');
define('_SKINIE_EXPORT_INTRO',		'Sélectionnez l\'habillage et le modèle que vous souhaitez exporter');
define('_SKINIE_EXPORT_SKINS',		'Habillages');
define('_SKINIE_EXPORT_TEMPLATES',	'Modèles');
define('_SKINIE_EXPORT_EXTRA',		'Info suplémentaire');
define('_SKINIE_CONFIRM_OVERWRITE',	'Réecrire par dessus l\'habillage existant');
define('_SKINIE_CONFIRM_IMPORT',	'Oui, je veux importe ceci');
define('_SKINIE_CONFIRM_TITLE',		'A propos de l\'importation d\'habillage et de modèles');
define('_SKINIE_INFO_SKINS',		'Habillage dans le fichier:');
define('_SKINIE_INFO_TEMPLATES',	'Modèle dans le fichier:');
define('_SKINIE_INFO_GENERAL',		'Information:');
define('_SKINIE_INFO_SKINCLASH',	'Nom de l\'habillage:');
define('_SKINIE_INFO_TEMPLCLASH',	'Nom du modèle:');
define('_SKINIE_INFO_IMPORTEDSKINS','Habillage importé:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Modèle importé:');
define('_SKINIE_DONE',				'Importation réussie');

define('_AND',						'et');
define('_OR',						'ou');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'Champs vide (cliquez pour modifier)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'Type d\'inclusion:');
define('_LIST_SKINS_INCPREFIX',		'Préfixe d\'inclusion');
define('_LIST_SKINS_DEFINED',		'Habillages définies:');

// backup
define('_BACKUPS_TITLE',			'Sauvegarde / Restauration');
define('_BACKUP_TITLE',				'Sauvegarde');
define('_BACKUP_INTRO',				'Cliquez le bouton ci-dessous pour créer une sauvegarde de votre base de donnée Nucleus. Vous pourrez la stocker dans un fichier. Gardez ce fichier en lieu sûr.');
define('_BACKUP_ZIP_YES',			'Utiliser la compression');
define('_BACKUP_ZIP_NO',			'Ne pas utiliser la compression');
define('_BACKUP_BTN',				'Créer sauvegarde');
define('_BACKUP_NOTE',				'<b>Note:</b> Seul le contenu de la base de données est sauvegardé. Les fichiers Media importés et la configuration de config.php <b>NE SONT PAS</b> inclus dans la sauvegarde.');
define('_RESTORE_TITLE',			'Restaurer');
define('_RESTORE_NOTE',				'<b>ATTENTION:</b> Restaurer une sauvegarde <b>EFFACERA</b> toutes les données contenues dans la base de données Nucleus! Ne faîtes ceci que si vous êtes sûr! <br />	<b>Note:</b> Vérifiez que la version de Nucleus pour laquelle vous souhaitez faire une sauvegarde soit la même que celle que vous utilisez actuellement, sinon rien ne fonctionnera');
define('_RESTORE_INTRO',			'Sélectionnez le fichier de sauvegarde ci-dessous (il sera transmis sur le serveur) et cliquez sur le bouton "restaurer" pour démarrer.');
define('_RESTORE_IMSURE',			'Oui, je suis sûr de vouloir faire ceci!');
define('_RESTORE_BTN',				'Restaurer à partir d\'un fichier');
define('_RESTORE_WARNING',			'(Vérifiez que vous restaurez le bon fichier de sauvegarde. Faîtes une nouvelle sauvegarde avant de commencer si vous n\'êtes pas sûr)');
define('_ERROR_BACKUP_NOTSURE',		'Vous devez cliquer la boîte \'je suis sûr\'');
define('_RESTORE_COMPLETE',			'Restauration Complète');

// new item notification
define('_NOTIFY_NI_MSG',			'Un nouvel objet a été posté:');
define('_NOTIFY_NI_TITLE',			'Nouvel objet!');
define('_NOTIFY_KV_MSG',			'Karma vote pour l\'objet:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'Commentaire pour l\objet:');
define('_NOTIFY_NC_TITLE',			'Commentaire Nucleus:');
define('_NOTIFY_USERID',			'Utilisateur ID:');
define('_NOTIFY_USER',				'Utilisateur:');
define('_NOTIFY_COMMENT',			'Commentaire:');
define('_NOTIFY_VOTE',				'Vote:');
define('_NOTIFY_HOST',				'Hôte:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'Membre:');
define('_NOTIFY_TITLE',				'Titre:');
define('_NOTIFY_CONTENTS',			'Informations:');

// member mail message
define('_MMAIL_MSG',				'Un message envoyé pour vous par');
define('_MMAIL_FROMANON',			'un visiteur anonyme');
define('_MMAIL_FROMNUC',			'Posté par un Weblog Nucleus à');
define('_MMAIL_TITLE',				'Un message de');
define('_MMAIL_MAIL',				'Message:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'Ajouter un objet');
define('_BMLET_EDIT',				'Modifier un objet');
define('_BMLET_DELETE',				'Supprimer un objet');
define('_BMLET_BODY',				'Corps');
define('_BMLET_MORE',				'Étendu');
define('_BMLET_OPTIONS',			'Options');
define('_BMLET_PREVIEW',			'Prévisualisation');

// used in bookmarklet
define('_ITEM_UPDATED',				'l\'objet a été mis à jour');
define('_ITEM_DELETED',				'l\'objet a été supprimé');

// plugiciels
define('_CONFIRMTXT_PLUGIN',		'Êtes-vous sûr de vouloir supprimer le plugin nommé');
define('_ERROR_NOSUCHPLUGIN',		'Pas de plugin correspondant');
define('_ERROR_DUPPLUGIN',			'Désolé ce plugin est déjà installé');
define('_ERROR_PLUGFILEERROR',		'Ce plugin n\'existe pas, ou bien les permissions ne sont pas correctement configurées');
define('_PLUGS_NOCANDIDATES',		'Pas de plugins valides trouvés');

define('_PLUGS_TITLE_MANAGE',		'Gérer les plugins');
define('_PLUGS_TITLE_INSTALLED',	'Déjà installés');
define('_PLUGS_TITLE_UPDATE',		'Mettre à jour la liste des inscriptions');
define('_PLUGS_TEXT_UPDATE',		'Nucleus garde un cache des inscriptions des plugins. Quand vous mettez à jour un plugin en remplaçant son fichier, vous devez utiliser cette fonction pour mettre à jour le cache');
define('_PLUGS_TITLE_NEW',			'Installer un nouveau plugin');
define('_PLUGS_ADD_TEXT',			'Ci-dessous vous avez la liste de tous les fichers contenus dans votre répertoire de plugins. Il peut s\'agir de plugins non-installés. Soyez <strong>vraiment</strong> sûr qu\'il s\'agit d\'un plugins avant de l\'ajouter.');
define('_PLUGS_BTN_INSTALL',		'Installer le plugin');
define('_BACKTOOVERVIEW',			'Retour au sommaire');

// editlink
define('_TEMPLATE_EDITLINK',		'Modifier le lien de l\'objet');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'Ajouter un cadre à gauche');
define('_ADD_RIGHT_TT',				'Ajouter un cadre à droite');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'Nouvelle catégorie');

// new settings
define('_SETTINGS_PLUGINURL',		'lien du plugin');
define('_SETTINGS_MAXUPLOADSIZE',	'Taille max. de fichier téléchargé (bytes)');
define('_SETTINGS_NONMEMBERMSGS',	'Autoriser les non-membres à envoyer des messages');
define('_SETTINGS_PROTECTMEMNAMES',	'Protéger les noms des membres');
// overview screen

define('_OVERVIEW_PLUGINS',			'Gérer les plugins...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'Enregistrement d\'un nouveau membre:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'Votre adresse courriel:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'Vous n\'avez pas les droits d\'admin sur les blogues qui contiennent ce membre sur la liste des rédacteurs. En conséquence, vous n\'êtes pas autorisés à uploader des fichiers dans le répertoire de ce membre');

// plugiciel list
define('_LISTS_INFO',				'Information');
define('_LIST_PLUGS_AUTHOR',		'Par:');
define('_LIST_PLUGS_VER',			'Version:');
define('_LIST_PLUGS_SITE',			'Visiter les sites');
define('_LIST_PLUGS_DESC',			'Description:');
define('_LIST_PLUGS_SUBS',			'Inscription aux évènements suivants:');
define('_LIST_PLUGS_UP',			'déplacer vers le haut');
define('_LIST_PLUGS_DOWN',			'déplacer vers le bas');
define('_LIST_PLUGS_UNINSTALL',		'désinstaller');
define('_LIST_PLUGS_ADMIN',			'admin');
define('_LIST_PLUGS_OPTIONS',		'modifier les options');

// plugiciel option list
define('_LISTS_VALUE',				'Valeur');

// plugiciel options
define('_ERROR_NOPLUGOPTIONS',		'ce plugin n\'a aucun ensemble d\'options');
define('_PLUGS_BACK',				'Retour au sommaire des plugins');
define('_PLUGS_SAVE',				'Sauver les options');
define('_PLUGS_OPTIONS_UPDATED',	'Options de plugin mises à jour');

define('_OVERVIEW_MANAGEMENT',		'Gestion');
define('_OVERVIEW_MANAGE',			'Gestion de Nucleus...');
define('_MANAGE_GENERAL',			'Gestion générale');
define('_MANAGE_SKINS',				'Habillage et modèles');
define('_MANAGE_EXTRA',				'Options supplémentaires');

define('_BACKTOMANAGE',				'Retour à la gestion de Nucleus');


// END introduced after v1.1 END




// charset to use 
define('_CHARSET',					'iso-8859-1');

// global stuff
define('_LOGOUT',					'Fin de session');
define('_LOGIN',					'Ouvrir session');
define('_YES',						'Oui');
define('_NO',						'Non');
define('_SUBMIT',					'Envoyer');
define('_ERROR',					'Erreur');
define('_ERRORMSG',					'Il y a eu une erreur');
define('_BACK',						'Retour');
define('_NOTLOGGEDIN',				'Pas de session ouverte');
define('_LOGGEDINAS',				'Session ouverte sous');
define('_ADMINHOME',				'Sommaire admin');
define('_NAME',						'Nom');
define('_BACKHOME',					'Revenir au sommaire admin');
define('_BADACTION',				'Action non prévue');
define('_MESSAGE',					'Message');
define('_HELP_TT',					'Aide!');
define('_YOURSITE',					'Votre site');


define('_POPUP_CLOSE',				'Fermer la fenêtre');

define('_LOGIN_PLEASE',				'Ouvrez une session d\'abord');

// commentform
define('_COMMENTFORM_YOUARE',		'Vous êtes');
define('_COMMENTFORM_SUBMIT',		'Ajouter un commentaire');
define('_COMMENTFORM_COMMENT',		'Votre commentaire');
define('_COMMENTFORM_NAME',			'Nom');
define('_COMMENTFORM_MAIL',			'Courriel/HTTP');
define('_COMMENTFORM_REMEMBER',		'Se souvenir');

// loginform
define('_LOGINFORM_NAME',			'Nom d\'usager');
define('_LOGINFORM_PWD',			'Mot de passe');
define('_LOGINFORM_YOUARE',			'Session ouverte sous');
define('_LOGINFORM_SHARED',			'Ordinateur partagé');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'Envoyer le message');

// search form
define('_SEARCHFORM_SUBMIT',		'Chercher');

// add item form
define('_ADD_ADDTO',				'Ajouter une nouvelle');
define('_ADD_CREATENEW',			'Créer une nouvelle');
define('_ADD_BODY',					'Corps');
define('_ADD_TITLE',				'Titre');
define('_ADD_MORE',					'Suite (optionel)');
define('_ADD_CATEGORY',				'Catégorie');
define('_ADD_PREVIEW',				'Prévisualisation');
define('_ADD_DISABLE_COMMENTS',		'Interdire les commentaires?');
define('_ADD_DRAFTNFUTURE',			'Brouillon &amp; items futures');
define('_ADD_ADDITEM',				'Ajouter nouvelle');
define('_ADD_ADDNOW',				'Ajouter maintenant');
define('_ADD_ADDLATER',				'Ajouter + tard');
define('_ADD_PLACE_ON',				'Daté du');
define('_ADD_ADDDRAFT',				'Ajouter aux brouillons');
define('_ADD_NOPASTDATES',			'(Les dates et heures passées ne sont pas valides, la date d\'aujourd\'hui sera utilisée)');
define('_ADD_BOLD_TT',				'Gras');
define('_ADD_ITALIC_TT',			'Italique');
define('_ADD_HREF_TT',				'Faire un lien');
define('_ADD_MEDIA_TT',				'Ajouter un média');
define('_ADD_PREVIEW_TT',			'Montrer/cacher la prévisualisation');
define('_ADD_CUT_TT',				'Couper');
define('_ADD_COPY_TT',				'Copier');
define('_ADD_PASTE_TT',				'Coller');


// edit item form
define('_EDIT_ITEM',				'Modifier nouvelle');
define('_EDIT_SUBMIT',				'Soumettre');
define('_EDIT_ORIG_AUTHOR',			'Auteur original');
define('_EDIT_BACKTODRAFTS',		'Remettre dans les brouillons');
define('_EDIT_COMMENTSNOTE',		'(note: désactiver les commentaires ne cachera pas les commentaires antérieures)');

// used on delete screens
define('_DELETE_CONFIRM',			'SVP, confirmez la suppression');
define('_DELETE_CONFIRM_BTN',		'Je confirme');
define('_CONFIRMTXT_ITEM',			'Vous êtes sur le point de supprimer la nouvelle suivante:');
define('_CONFIRMTXT_COMMENT',		'Vous êtes sur le point de supprimer le commentaire suivant:');
define('_CONFIRMTXT_TEAM1',			'Vous allez supprimer');
define('_CONFIRMTXT_TEAM2',			' de la liste des rédacteurs du blogue ');
define('_CONFIRMTXT_BLOG',			'Le blogue que vous allez effacer est: ');
define('_WARNINGTXT_BLOGDEL',		'Attention!  L\'effacement d\'un blogue effacera TOUT les objets de ce blogue ainsi que tout les commentaires.  Veuillez confirmer afin de s\'assurer que vous êtes CERTAIN de ce que vous faites<br />De plus, n\'interrompez pas Nucleus pendant l\'effacement de votre blogue.');
define('_CONFIRMTXT_MEMBER',		'Vous allez supprimer le profil utilisateur: ');
define('_CONFIRMTXT_TEMPLATE',		'Vous allez supprimer le modèle nommé ');
define('_CONFIRMTXT_SKIN',			'Vous allez supprimer l\'habillage d\'interface nommé ');
define('_CONFIRMTXT_BAN',			'Vous allez supprimer le bannissement pour le rang IP');
define('_CONFIRMTXT_CATEGORY',		'Vous allez supprimer la catégorie ');

// some status messages
define('_DELETED_ITEM',				'Nouvelle supprimée');
define('_DELETED_MEMBER',			'Membre supprimé');
define('_DELETED_COMMENT',			'Commentaire supprimé');
define('_DELETED_BLOG',				'Blogue supprimé');
define('_DELETED_CATEGORY',			'Catégorie supprimée');
define('_ITEM_MOVED',				'Nouvelle déplacée');
define('_ITEM_ADDED',				'Nouvelle ajoutée');
define('_COMMENT_UPDATED',			'Commentaire mis à jour');
define('_SKIN_UPDATED',				'Configuration d\'habillage d\'interface sauvée');
define('_TEMPLATE_UPDATED',			'Donnée du modèle sauvegardée');

// errors
define('_ERROR_COMMENT_LONGWORD',	'SVP ne pas mettre de mots dépassant 90 caractères');
define('_ERROR_COMMENT_NOCOMMENT',	'SVP, entrez un commentaire');
define('_ERROR_COMMENT_NOUSERNAME',	'Mauvais nom d\'utilisateur');
define('_ERROR_COMMENT_TOOLONG',	'Votre commentaire est trop long (max. 5000 chars)');
define('_ERROR_COMMENTS_DISABLED',	'Les commentaires sont désactivés.');
define('_ERROR_COMMENTS_NONPUBLIC',	'Vous devez être membre pour ajouter un commentaire');
define('_ERROR_COMMENTS_MEMBERNICK','Le nom que vous avez choisi pour poster votre commentaire est déjà utilisé par un membre. Choisissez en un autre.');
define('_ERROR_SKIN',				'Erreur d\'habillage d\'interface');
define('_ERROR_ITEMCLOSED',			'Cette nouvelle est fermée, Il est impossible d\'ajouter un commentaire ou de voter');
define('_ERROR_NOSUCHITEM',			'Pas de nouvelle correspondante');
define('_ERROR_NOSUCHBLOG',			'Pas de blogue');
define('_ERROR_NOSUCHSKIN',			'Pas d\'habillage d\'interface correspondante');
define('_ERROR_NOSUCHMEMBER',		'Pas de membre correspondant');
define('_ERROR_NOTONTEAM',			'Vous ne faites pas partie de l\'équipe éditoriale.');
define('_ERROR_BADDESTBLOG',		'Le blogue de destination n\'existe pas');
define('_ERROR_NOTONDESTTEAM',		'Impossible de déplacer la nouvelle tant que vous ne faites pas partie de l\'équipe éditoriale');
define('_ERROR_NOEMPTYITEMS',		'Impossible d\'ajouter une nouvelle vide');
define('_ERROR_BADMAILADDRESS',		'Adresse courriel non-valide');
define('_ERROR_BADNOTIFY',			'Une ou plusieurs adresses courriel de notification ne sont pas valides');
define('_ERROR_BADNAME',			'Nom non-valide (signes : a-z et 0-9 autorisés, pas d\'espaces au début ni à la fin)');
define('_ERROR_NICKNAMEINUSE',		'Un autre membre utilise ce surnom');
define('_ERROR_PASSWORDMISMATCH',	'Les mots de passe doivent correspondre');
define('_ERROR_PASSWORDTOOSHORT',	'Le mot de passe doit contenir au moins 6 caractères');
define('_ERROR_PASSWORDMISSING',	'Le mot de passe ne doit pas être vide');
define('_ERROR_REALNAMEMISSING',	'Vous devez rentrer un vrai nom');
define('_ERROR_ATLEASTONEADMIN',	'Il doit toujours exister un super admin qui puisse entrer dans l\'administration du blogue.');
define('_ERROR_ATLEASTONEBLOGADMIN','Faire ceci rendra votre administration inaccessible. Assurez vous qu\'il y a toujours un admin.');
define('_ERROR_ALREADYONTEAM',		'Vous ne pouvez ajouter un utilisateur déjà dans l\'équipe');
define('_ERROR_BADSHORTBLOGNAME',	'Le nom court du blogue ne peux contenir que a-z et 0-9 sans espace');
define('_ERROR_DUPSHORTBLOGNAME',	'Un autre blogue a le même nom court. Les noms courts doivent être uniques');
define('_ERROR_UPDATEFILE',			'Impossible d\'accéder en écriture au fichier d\'update. Assurez vous que les permissions sont OK (chmod 666). Le chemin est relatif au chemin d\'admin, utilisez un chemin absolu (quelque chose comme /your/path/to/nucleus/)');
define('_ERROR_DELDEFBLOG',			'Vous ne pouvez effacer le blogue par défaut');
define('_ERROR_DELETEMEMBER',		'Cet utilisateur ne peux être effacé, probablement qu\'il est auteur de commentaires');
define('_ERROR_BADTEMPLATENAME',	'Nom invalide pour ce modèle, utilisez a-z et 0-9 sans espaces');
define('_ERROR_DUPTEMPLATENAME',	'Un autre modèle avec ce nom existe');
define('_ERROR_BADSKINNAME',		'Nom de habillage d\'interface invalide (seulement a-z, 0-9 sont autorisés, pas d\'espaces)');
define('_ERROR_DUPSKINNAME',		'Un autre habillage d\'interface avec ce nom existe');
define('_ERROR_DEFAULTSKIN',		'Il doit toujours y avoir un habillage d\'interface avec le nom "default"');
define('_ERROR_SKINDEFDELETE',		'Impossible d\'effacer l\'habillage d\'interface tant qu\'elle est active par défaut au blogue suivant: ');
define('_ERROR_DISALLOWED',			'Désolé vous n\'êtes pas autorisé à faire cela');
define('_ERROR_DELETEBAN',			'Erreur en essayant d\'effacer le bannissement (pas de bannissement)');
define('_ERROR_ADDBAN',				'Erreur en essayant d\'ajouter le bannissement. Le bannissement n\'a pas été ajoué correctement dans tous vos blogues.');
define('_ERROR_BADACTION',			'L\'action demandée n\'existe pas');
define('_ERROR_MEMBERMAILDISABLED',	'Les messages de membre à membre sont désactivés');
define('_ERROR_MEMBERCREATEDISABLED','La création de nouveaux utilisateurs est désactivée');
define('_ERROR_INCORRECTEMAIL',		'Adresse courriel incorrecte');
define('_ERROR_VOTEDBEFORE',		'Vous avez déjà voté pour cette nouvelle');
define('_ERROR_BANNED1',			'Impossible d\'effectuer cette action (ip range ');
define('_ERROR_BANNED2',			') votre ip est bannie. Le message était: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'Vous devez être loggé pour effectuer cette action');
define('_ERROR_CONNECT',			'Erreur de connexion');
define('_ERROR_FILE_TOO_BIG',		'Fichier trop grand!');
define('_ERROR_BADFILETYPE',		'Désolé ce type de fichier n\est pas accepté');
define('_ERROR_BADREQUEST',			'Mauvaise demande de téléchargement');
define('_ERROR_DISALLOWEDUPLOAD',	'Vous n\'êtes dans aucune équipe éditoriale. Vous ne pouvez donc pas transmettre de fichier');
define('_ERROR_BADPERMISSIONS',		'Les permissions de fichiers ne sont pas correctement configurées');
define('_ERROR_UPLOADMOVEP',		'Erreur pendant le déplacement du fichier transmis');
define('_ERROR_UPLOADCOPY',			'Erreur pendant la copie de fichier');
define('_ERROR_UPLOADDUPLICATE',	'Un autre fichier du même nom existe. Essayez de le renommer avant de l\'envoyer.');
define('_ERROR_LOGINDISALLOWED',	'Désolé vous ne pouvez rentrer dans l\'admin. Vous pouvez aussi vous logger en tant qu\' utilisateur différent');
define('_ERROR_DBCONNECT',			'Impossible de se connecter au serveur mySQL');
define('_ERROR_DBSELECT',			'Impossible de sélectionner la table de Nucleus.');
define('_ERROR_NOSUCHLANGUAGE',		'Ce fichier de langue n\'existe pas');
define('_ERROR_NOSUCHCATEGORY',		'Cette catégorie n\'existe pas');
define('_ERROR_DELETELASTCATEGORY',	'Il doit y avoir au moins une catégorie');
define('_ERROR_DELETEDEFCATEGORY',	'Impossible d\'effacer la catégorie par défaut');
define('_ERROR_BADCATEGORYNAME',	'Mauvais nom de catégorie');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'Attention: la valeur courante n\'est pas un répertoire!');
define('_WARNING_NOTREADABLE',		'Attention: la valeur courante n\'est pas un répertoire avec droit de lecture!');
define('_WARNING_NOTWRITABLE',		'Attention: la valeur courante n\'est pas un répertoire avec droit d\'écriture!');

// media and upload
define('_MEDIA_UPLOADLINK',			'Téléchargement d\'un nouveau fichier');
define('_MEDIA_MODIFIED',			'modifié');
define('_MEDIA_FILENAME',			'nom de fichier');
define('_MEDIA_DIMENSIONS',			'dimensions');
define('_MEDIA_INLINE',				'Insérée');
define('_MEDIA_POPUP',				'Fenêtrée');
define('_UPLOAD_TITLE',				'Choisir un fichier');
define('_UPLOAD_MSG',				'Sélectionnez le fichier à télécharger et cliquez sur le bouton ENVOYER.');
define('_UPLOAD_BUTTON',			'Envoyer');

// some status messages
define('_MSG_ACCOUNTCREATED',		'Compte créé, le mot de passe sera envoyé par courriel');
define('_MSG_PASSWORDSENT',			'Le mot de passe a été envoyé par courriel.');
define('_MSG_LOGINAGAIN',			'Vous allez devoir ouvrir une nouvelle session car vos infos ont changé');
define('_MSG_SETTINGSCHANGED',		'Réglages modifiés');
define('_MSG_ADMINCHANGED',			'Admin changé');
define('_MSG_NEWBLOG',				'Nouveau blogue créé');
define('_MSG_ACTIONLOGCLEARED',		'Journal des actions effacés');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'Action non autorisée: ');
define('_ACTIONLOG_PWDREMINDERSENT','Nouveau mot de passe envoyé pour ');
define('_ACTIONLOG_TITLE',			'Journal des actions');
define('_ACTIONLOG_CLEAR_TITLE',	'Effacer le journal des actions');
define('_ACTIONLOG_CLEAR_TEXT',		'Effacer le journal des actions maintenant');

// team management
define('_TEAM_TITLE',				'Gérer l\'équipe du blogue ');
define('_TEAM_CURRENT',				'Equipe courante');
define('_TEAM_ADDNEW',				'Ajouter un membre à l\'équipe');
define('_TEAM_CHOOSEMEMBER',		'Choisir un membre');
define('_TEAM_ADMIN',				'Privilèges d\'admin? ');
define('_TEAM_ADD',					'Ajouter à l\'équipe');
define('_TEAM_ADD_BTN',				'Ajouter à l\'équipe');

// bloguesettings
define('_EBLOG_TITLE',				'Modifier les paramètres du Blogue');
define('_EBLOG_TEAM_TITLE',			'Modifier l\'équipe');
define('_EBLOG_TEAM_TEXT',			'Cliquer ici pour modifier votre équipe.');
define('_EBLOG_SETTINGS_TITLE',		'Paramètres du blogue');
define('_EBLOG_NAME',				'Nom du blogue');
define('_EBLOG_SHORTNAME',			'Nom court du blogue');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(lettres a-z et pas d\'espaces)');
define('_EBLOG_DESC',				'Description du blogue ');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'Habillage par défaut');
define('_EBLOG_DEFCAT',				'Catégorie par défaut');
define('_EBLOG_LINEBREAKS',			'Convertir les sauts de lignes');
define('_EBLOG_DISABLECOMMENTS',	'Commentaires autorisés?<br /><small>(Ajouter des commentaires sera impossible si non coché.)</small>');
define('_EBLOG_ANONYMOUS',			'Autoriser les commentaires pour les non-membres?');
define('_EBLOG_NOTIFY',				'Adresses de notification (utiliser ; comme séparateur)');
define('_EBLOG_NOTIFY_ON',			'Notification activée');
define('_EBLOG_NOTIFY_COMMENT',		'Nouveaux commentaires');
define('_EBLOG_NOTIFY_KARMA',		'Nouveaux votes Karma');
define('_EBLOG_NOTIFY_ITEM',		'Nouvelles blogue');
define('_EBLOG_PING',				'Pinger Weblogues.com à la mise à jour?');
define('_EBLOG_MAXCOMMENTS',		'Nombre max de commentaires');
define('_EBLOG_UPDATE',				'Fichier de mise-à-jour');
define('_EBLOG_OFFSET',				'Différentiel de temps');
define('_EBLOG_STIME',				'Heure courante du serveur');
define('_EBLOG_BTIME',				'Heure courante du blogue');
define('_EBLOG_CHANGE',				'Changer les paramètres');
define('_EBLOG_CHANGE_BTN',			'Changer les paramètres');
define('_EBLOG_ADMIN',				'Administrer le blogue');
define('_EBLOG_ADMIN_MSG',			'Vous bénéficierez des privilèges d\'administration');
define('_EBLOG_CREATE_TITLE',		'Créer un nouveau blogue');
define('_EBLOG_CREATE_TEXT',		'Remplissez le formulaire pour créer un nouveau blogue. <br /><br /> <b>Note:</b> Seules les options nécessaires sont listées. Pour plus d\'options, changez les paramètres après la création.');
define('_EBLOG_CREATE',				'Créer!');
define('_EBLOG_CREATE_BTN',			'Créer le Weblogue');
define('_EBLOG_CAT_TITLE',			'Catégories');
define('_EBLOG_CAT_NAME',			'Nom de catégorie');
define('_EBLOG_CAT_DESC',			'Description de catégorie');
define('_EBLOG_CAT_CREATE',			'Créer une nouvelle catégorie');
define('_EBLOG_CAT_UPDATE',			'Mettre à jour la catégorie');
define('_EBLOG_CAT_UPDATE_BTN',		'Mettre à jour la catégorie');

// modèles
define('_TEMPLATE_TITLE',			'Modifier les modèles');
define('_TEMPLATE_AVAILABLE_TITLE',	'Modèles disponibles');
define('_TEMPLATE_NEW_TITLE',		'Nouveau modèle');
define('_TEMPLATE_NAME',			'Nom du modèle');
define('_TEMPLATE_DESC',			'Description du modèle');
define('_TEMPLATE_CREATE',			'Créer un modèle');
define('_TEMPLATE_CREATE_BTN',		'Créer un modèle');
define('_TEMPLATE_EDIT_TITLE',		'Modifier le modèle');
define('_TEMPLATE_BACK',			'Revenir au sommaire du modèle');
define('_TEMPLATE_EDIT_MSG',		'Toutes les parties du modèles ne sont pas nécessaires, laissez vides celles qui ne sont pas nécessaires.');
define('_TEMPLATE_SETTINGS',		'Paramètres du modèle');
define('_TEMPLATE_ITEMS',			'Nouvelles');
define('_TEMPLATE_ITEMHEADER',		'En-tête de nouvelles');
define('_TEMPLATE_ITEMBODY',		'Corps de nouvelles');
define('_TEMPLATE_ITEMFOOTER',		'Pied de nouvelles');
define('_TEMPLATE_MORELINK',		'Lien vers la nouvelle étendue');
define('_TEMPLATE_NEW',				'Indication de nouvelles récentes');
define('_TEMPLATE_COMMENTS_ANY',	'Commentaires (si nécessaire)');
define('_TEMPLATE_CHEADER',			'En-tête de commentaire');
define('_TEMPLATE_CBODY',			'Corps de commentaire');
define('_TEMPLATE_CFOOTER',			'Pied de commentaire');
define('_TEMPLATE_CONE',			'Un commentaire');
define('_TEMPLATE_CMANY',			'Deux (ou plus) commentaires');
define('_TEMPLATE_CMORE',			'Commentaires en voir +');
define('_TEMPLATE_CMEXTRA',			'Infos utilisateur');
define('_TEMPLATE_COMMENTS_NONE',	'Commentaires (si aucun)');
define('_TEMPLATE_CNONE',			'Pas de commentaires');
define('_TEMPLATE_COMMENTS_TOOMUCH','Commentaires (si il y en a, mais trop pour les montrer tous)');
define('_TEMPLATE_CTOOMUCH',		'Trop de commentaires');
define('_TEMPLATE_ARCHIVELIST',		'Listes d\'archives');
define('_TEMPLATE_AHEADER',			'En-tête d\'archive');
define('_TEMPLATE_AITEM',			'Archive (item)');
define('_TEMPLATE_AFOOTER',			'Pied de liste d\'archive');
define('_TEMPLATE_DATETIME',		'date et heure');
define('_TEMPLATE_DHEADER',			'En-tête de date');
define('_TEMPLATE_DFOOTER',			'Pied de date');
define('_TEMPLATE_DFORMAT',			'Format de date');
define('_TEMPLATE_TFORMAT',			'Format d\'heure');
define('_TEMPLATE_LOCALE',			'Locale');
define('_TEMPLATE_IMAGE',			'Fenêtres d\'images');
define('_TEMPLATE_PCODE',			'Code de lien fenêtrage');
define('_TEMPLATE_ICODE',			'Code d\'image en ligne');
define('_TEMPLATE_MCODE',			'Code lien objet media');
define('_TEMPLATE_SEARCH',			'Chercher');
define('_TEMPLATE_SHIGHLIGHT',		'Surbrillance');
define('_TEMPLATE_SNOTFOUND',		'Rien n\'a été trouvé');
define('_TEMPLATE_UPDATE',			'Mettre à jour');
define('_TEMPLATE_UPDATE_BTN',		'Mettre à jour le modèle');
define('_TEMPLATE_RESET_BTN',		'Effacer les données');
define('_TEMPLATE_CATEGORYLIST',	'Listes de catégories');
define('_TEMPLATE_CATHEADER',		'En-tête de Liste de catégories');
define('_TEMPLATE_CATITEM',			'Liste de catégorie (item)');
define('_TEMPLATE_CATFOOTER',		'pied de liste de catégories');

// habillages d\'interface
define('_SKIN_EDIT_TITLE',			'Modifier les habillages d\'interface');
define('_SKIN_AVAILABLE_TITLE',		'Habillages disponibles');
define('_SKIN_NEW_TITLE',			'Nouvel habillage d\'interface');
define('_SKIN_NAME',				'Nom');
define('_SKIN_DESC',				'Description');
define('_SKIN_TYPE',				'Type de contenu');
define('_SKIN_CREATE',				'Créer');
define('_SKIN_CREATE_BTN',			'Créer l\'habillage d\'interface');
define('_SKIN_EDITONE_TITLE',		'Modifier l\'habillage d\'interface');
define('_SKIN_BACK',				'Retour au sommaire de l\'habillage d\'interface');
define('_SKIN_PARTS_TITLE',			'Parties de l\'habillage d\'interface');
define('_SKIN_PARTS_MSG',			'Tous les types ne sont pas nécessaires pour chaque habillage d\'interface. Laissez vides ceux dont vous n\'avez pas besoin. Choisir l\'habillage d\'interface à éditer en dessous:');
define('_SKIN_PART_MAIN',			'Index général');
define('_SKIN_PART_ITEM',			'Pages de nouvelles');
define('_SKIN_PART_ALIST',			'Liste des archives');
define('_SKIN_PART_ARCHIVE',		'Archive');
define('_SKIN_PART_SEARCH',			'recherche');
define('_SKIN_PART_ERROR',			'Erreurs');
define('_SKIN_PART_MEMBER',			'Détails utilisateurs');
define('_SKIN_PART_POPUP',			'Fenêtrage d\'images');
define('_SKIN_GENSETTINGS_TITLE',	'paramètres généraux');
define('_SKIN_CHANGE',				'Changer');
define('_SKIN_CHANGE_BTN',			'Changer ces paramètres');
define('_SKIN_UPDATE_BTN',			'Mettre à jour l\'habillage d\'interface');
define('_SKIN_RESET_BTN',			'Données par défaut');
define('_SKIN_EDITPART_TITLE',		'Modifier l\'habillage d\'interface');
define('_SKIN_GOBACK',				'Retour');
define('_SKIN_ALLOWEDVARS',			'Variables autorisées (cliquer pour des infos):');

// global settings
define('_SETTINGS_TITLE',			'Paramètres généraux');
define('_SETTINGS_SUB_GENERAL',		'Paramètres généraux');
define('_SETTINGS_DEFBLOG',			'Blogue par défaut');
define('_SETTINGS_ADMINMAIL',		'courriel de l\'admin');
define('_SETTINGS_SITENAME',		'Nom du site');
define('_SETTINGS_SITEURL',			'URL du site (doit finir avec un slash)');
define('_SETTINGS_ADMINURL',		'URL de l\'admin (doit finir avec un slash)');
define('_SETTINGS_DIRS',			'Répertoires de Nucleus');
define('_SETTINGS_MEDIADIR',		'Répertoire media');
define('_SETTINGS_SEECONFIGPHP',	'(voir config.php)');
define('_SETTINGS_MEDIAURL',		'URL media (doit finir avec un slash)');
define('_SETTINGS_ALLOWUPLOAD',		'Autoriser les téléversements?');
define('_SETTINGS_ALLOWUPLOADTYPES','Fichiers autorisés pour les téléversements');
define('_SETTINGS_CHANGELOGIN',		'Autoriser les utilisateurs à changer le mot de passe de session');
define('_SETTINGS_COOKIES_TITLE',	'Paramètres des fichiers témoins');
define('_SETTINGS_COOKIELIFE',		'Durée de vie du fichier témoin de session');
define('_SETTINGS_COOKIESESSION',	'Fichiers témoins de session');
define('_SETTINGS_COOKIEMONTH',		'Durée de vie d\'un mois');
define('_SETTINGS_COOKIEPATH',		'Chemin du fichier témoin (niveau avancé)');
define('_SETTINGS_COOKIEDOMAIN',	'Domaine du fichier témoin (niveau avancé)');
define('_SETTINGS_COOKIESECURE',	'Fichier témoin sécurisé(niveau avancé)');
define('_SETTINGS_LASTVISIT',		'Sauver les fichiers témoins de la dernière visite');
define('_SETTINGS_ALLOWCREATE',		'Autoriser les visiteurs à créer un compte');
define('_SETTINGS_NEWLOGIN',		'Ouvrir une session autorisée pour les comptes créés par des utilisateurs');
define('_SETTINGS_NEWLOGIN2',		'(ne vaut que pour les comptes récemment créés)');
define('_SETTINGS_MEMBERMSGS',		'Autoriser les services de membres à membres');
define('_SETTINGS_LANGUAGE',		'Langage par défaut');
define('_SETTINGS_DISABLESITE',		'Désactiver le site');
define('_SETTINGS_DBLOGIN',			'Ouvrir une session mySQL &amp; base de données');
define('_SETTINGS_UPDATE',			'Mettre à jour les paramètres');
define('_SETTINGS_UPDATE_BTN',		'Mettre à jour les paramètres');
define('_SETTINGS_DISABLEJS',		'Désactiver la barre d\'outils javascript');
define('_SETTINGS_MEDIA',			'Paramètres de téléversement de médias');
define('_SETTINGS_MEDIAPREFIX',		'Préfixer le nom des fichiers avec la date');
define('_SETTINGS_MEMBERS',			'Paramètres des membres');

// bans
define('_BAN_TITLE',				'Liste de bannissement pour');
define('_BAN_NONE',					'pas de bannissement pour ce blogue');
define('_BAN_NEW_TITLE',			'Ajouter un bannissement');
define('_BAN_NEW_TEXT',				'Ajouter un bannissement maintenant');
define('_BAN_REMOVE_TITLE',			'Supprimer un bannissement');
define('_BAN_IPRANGE',				'Rang d\'IP');
define('_BAN_BLOGS',				'Quels blogues?');
define('_BAN_DELETE_TITLE',			'Supprimer le bannissement');
define('_BAN_ALLBLOGS',				'Tous les blogues pour lesquels vous avez l\'admin.');
define('_BAN_REMOVED_TITLE',		'Bannissement supprimé');
define('_BAN_REMOVED_TEXT',			'Le bannissement a été supprimé pour les blogues suivants:');
define('_BAN_ADD_TITLE',			'Ajouter un bannissement');
define('_BAN_IPRANGE_TEXT',			'Choisir le rang d\'IP que vous voulez bloquer. Moins il y aura de nombres, plus le nombre d\IP bloquées sera grand.');
define('_BAN_BLOGS_TEXT',			'Vous pouvez choisir de bannir une IP pour un blogue seulement ou pour tous ceux où vous êtes admin. Faites votre choix ici.');
define('_BAN_REASON_TITLE',			'Raison');
define('_BAN_REASON_TEXT',			'Vous pouvez fournir une raison de bannissement qui sera affichée quand l\'IP concernée essaiera d\'ajouter un commentaire ou un vote. Longueur max. 256 caractères.');
define('_BAN_ADD_BTN',				'Ajouter le bannissement');

// LOGIN screen
define('_LOGIN_MESSAGE',			'Message');
define('_LOGIN_NAME',				'Nom');
define('_LOGIN_PASSWORD',			'Mot de passe');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'Mot de passe oublié?');

// membermanagement
define('_MEMBERS_TITLE',			'Gestion des utilisateurs');
define('_MEMBERS_CURRENT',			'Utilisateurs actuels');
define('_MEMBERS_NEW',				'Nouvel utilisateur');
define('_MEMBERS_DISPLAY',			'Nom affiché');
define('_MEMBERS_DISPLAY_INFO',		'(Nom utilisé pour le login)');
define('_MEMBERS_REALNAME',			'Nom réel');
define('_MEMBERS_PWD',				'Mot de passe');
define('_MEMBERS_REPPWD',			'Répéter le mot de passe');
define('_MEMBERS_EMAIL',			'Addresse courriel');
define('_MEMBERS_EMAIL_EDIT',		'(Quand vous changez d\'adresse courriel, un nouveau mot de passe est envoyé à cette adresse)');
define('_MEMBERS_URL',				'Adresse web (URL)');
define('_MEMBERS_SUPERADMIN',		'Privilèges de super-admin');
define('_MEMBERS_CANLOGIN',			'Peut ouvrir une session comme admin');
define('_MEMBERS_NOTES',			'Notes');
define('_MEMBERS_NEW_BTN',			'Ajouter l\'utilisateur');
define('_MEMBERS_EDIT',				'Modifier l\'utilisateur');
define('_MEMBERS_EDIT_BTN',			'Changer les paramètres');
define('_MEMBERS_BACKTOOVERVIEW',	'Retour au sommaire utilisateur');
define('_MEMBERS_DEFLANG',			'Langage');
define('_MEMBERS_USESITELANG',		'- utiliser les paramètres du site -');

// List of blogues (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'Visiter le site');
define('_BLOGLIST_ADD',				'Ajouter une nouvelle');
define('_BLOGLIST_TT_ADD',			'Ajouter une nouvelle à ce blogue');
define('_BLOGLIST_EDIT',			'Modifier/supprimer des nouvelles');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Bookmarklet');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'Paramètres');
define('_BLOGLIST_TT_SETTINGS',		'Modifier des paramètres ou gérer l\'équipe');
define('_BLOGLIST_BANS',			'Bannissements');
define('_BLOGLIST_TT_BANS',			'Voir, ajouter ou supprimer des IP bannies');
define('_BLOGLIST_DELETE',			'Tout supprimer');
define('_BLOGLIST_TT_DELETE',		'Supprimer ce blogue');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'Votre blogue');
define('_OVERVIEW_YRDRAFTS',		'Vos brouillons');
define('_OVERVIEW_YRSETTINGS',		'Vos paramètres');
define('_OVERVIEW_GSETTINGS',		'Paramètres généraux');
define('_OVERVIEW_NOBLOGS',			'Vous n\'êtes dans aucune équipe de rédaction');
define('_OVERVIEW_NODRAFTS',		'Pas de brouillons');
define('_OVERVIEW_EDITSETTINGS',	'Modifiez vos paramètres...');
define('_OVERVIEW_BROWSEITEMS',		'Consultez vos nouvelles...');
define('_OVERVIEW_BROWSECOMM',		'Consultez vos commentaires...');
define('_OVERVIEW_VIEWLOG',			'Regardez le journal d\'actions...');
define('_OVERVIEW_MEMBERS',			'Gérer les utilisateurs...');
define('_OVERVIEW_NEWLOG',			'Créer un nouveau blogue...');
define('_OVERVIEW_SETTINGS',		'Modifier les paramètres...');
define('_OVERVIEW_TEMPLATES',		'Modifier les modèles...');
define('_OVERVIEW_SKINS',			'Modifier les habillages d\'interface...');
define('_OVERVIEW_BACKUP',			'Sauvegarde/Récupération...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'Nouvelles pour le blogue'); 
define('_ITEMLIST_YOUR',			'Vos nouvelles');

// Comments
define('_COMMENTS',					'Commentaires');
define('_NOCOMMENTS',				'Pas de commentaires pour cette nouvelle');
define('_COMMENTS_YOUR',			'Vos commentaires');
define('_NOCOMMENTS_YOUR',			'Vous n\'avez écrit aucun commentaire');

// LISTS (general)
define('_LISTS_NOMORE',				'Plus de résultats ou pas de résultat du tout');
define('_LISTS_PREV',				'Précédent');
define('_LISTS_NEXT',				'Suivant');
define('_LISTS_SEARCH',				'Chercher');
define('_LISTS_CHANGE',				'Changer');
define('_LISTS_PERPAGE',			'Nouvelles/page');
define('_LISTS_ACTIONS',			'Actions');
define('_LISTS_DELETE',				'Supprimer');
define('_LISTS_EDIT',				'Modifier');
define('_LISTS_MOVE',				'Déplacer');
define('_LISTS_CLONE',				'Cloner');
define('_LISTS_TITLE',				'Titre');
define('_LISTS_BLOG',				'Blogue');
define('_LISTS_NAME',				'Nom');
define('_LISTS_DESC',				'Description');
define('_LISTS_TIME',				'Heure');
define('_LISTS_COMMENTS',			'Commentaires');
define('_LISTS_TYPE',				'Type');


// member list 
define('_LIST_MEMBER_NAME',			'Nom affiché');
define('_LIST_MEMBER_RNAME',		'Nom réel');
define('_LIST_MEMBER_ADMIN',		'Super-admin? ');
define('_LIST_MEMBER_LOGIN',		'Ouvrir une session autorisée? ');
define('_LIST_MEMBER_URL',			'Site web');

// banlist
define('_LIST_BAN_IPRANGE',			'Rang d\'IP');
define('_LIST_BAN_REASON',			'Raison');

// actionlist
define('_LIST_ACTION_MSG',			'Message');

// commentlist
define('_LIST_COMMENT_BANIP',		'IP bannie');
define('_LIST_COMMENT_WHO',			'Auteur');
define('_LIST_COMMENT',				'Commentaire');
define('_LIST_COMMENT_HOST',		'Hôte');

// itemlist
define('_LIST_ITEM_INFO',			'Info');
define('_LIST_ITEM_CONTENT',		'Titre et texte');


// teamlist
define('_LIST_TEAM_ADMIN',			'Admin ');
define('_LIST_TEAM_CHADMIN',		'Changer Admin');

// edit comments
define('_EDITC_TITLE',				'Modifier les commentaires');
define('_EDITC_WHO',				'Auteur');
define('_EDITC_HOST',				'Depuis où?');
define('_EDITC_WHEN',				'Quand?');
define('_EDITC_TEXT',				'Texte');
define('_EDITC_EDIT',				'Modifier commentaire');
define('_EDITC_MEMBER',				'membre');
define('_EDITC_NONMEMBER',			'non membre');

// move item
define('_MOVE_TITLE',				'Déplacer vers quel blogue?');
define('_MOVE_BTN',					'Déplacer nouvelle');

?>