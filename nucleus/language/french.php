<?php
// French Nucleus Language File
// 
// Auteur: Papachango (pfffouitt@yahoo.fr)
// Nucleus version: v1.0-v2.5
//
// Nota bene : si vous souhaitez traduire ce fichier dans votre propre langue, soyez conscient
// que dans une version ultérieure de Nucleus, de nouvelles variables peuvent être apparues et
// d'autres avoir été supprimées. Il est donc important de spécifier la version de Nucleus pour
// laquelle le fichier a été écrit, dans votre document.
//
// Le fichier traduit peut-être envoyé à Wouter Demuynck (nucleus@demuynck.org)
// et sera disponible en téléchargement (avec le crédit de l'auteur, bien entendu)

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

// searchable blog setting (yes/no)
define('_EBLOG_SEARCH',			'Inclure dans la recherche');

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
define('_SKINIE_BTN_IMPORT',		'Importation');
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

// Modules (plugins)
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




// charset to use 
define('_CHARSET',			'iso-8859-1');

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
define('_BACKHOME',			'Retout à l\'accueil');
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
define('_CONFIRMTXT_BAN',		'Vous allez annuler l\'exclusion du rang d\'IP');
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
define('_ERROR_BANNED1',		'Action impossible car vous (ip range ');
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
define('_MSG_ACCOUNTCREATED',		'Compte créé, le mot de passe sera envoyé par email');
define('_MSG_PASSWORDSENT',		'Mot de passe envoyé par email');
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
define('_BAN_IPRANGE',			'Rangs d\'IP');
define('_BAN_BLOGS',			'Quels blogs?');
define('_BAN_DELETE_TITLE',		'Supprimer une exclusion');
define('_BAN_ALLBLOGS',			'Tous les blogs dont vous êtes administrateur.');
define('_BAN_REMOVED_TITLE',		'Exclusion supprimée');
define('_BAN_REMOVED_TEXT',		'L\'exclusion a été supprimée pour les blogs suivants:');
define('_BAN_ADD_TITLE',		'Définir des exclusions');
define('_BAN_IPRANGE_TEXT',		'Choisissez le rang d\'IP que vous voulez bloquer. Moins il y aura de nombres, plus il y aura d\'IP bloquées.');
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
define('_LIST_BAN_IPRANGE',		'IP Range');
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

?>