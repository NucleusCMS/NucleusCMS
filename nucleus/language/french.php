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
define('_EBLOG_ALLOWPASTPOSTING',	'Permet de poster avec une date pass�e');
define('_ADD_CHANGEDATE',			'Mise � jour de la date');
define('_BMLET_CHANGEDATE',			'Mise � jour de la date');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'Habillage import/export...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Normal');
define('_PARSER_INCMODE_SKINDIR',	'Utiliser dossier habillage');
define('_SKIN_INCLUDE_MODE',		'Type d\'inclusion');
define('_SKIN_INCLUDE_PREFIX',		'Pr�fixe d\'inclusion');

// global settings
define('_SETTINGS_BASESKIN',		'Interface basique');
define('_SETTINGS_SKINSURL',		'Lien pour interface');
define('_SETTINGS_ACTIONSURL',		'Lien complet pour action.php');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'Ne peut pas d�placer la cat�gorie par d�faut');
define('_ERROR_MOVETOSELF',			'Ne peut pas d�placer cette cat�gorie (le blogue de destination est le m�me que le blogue de source)');
define('_MOVECAT_TITLE',			'S�lectionnez le blogue dans lequel vous souhaitez d�placer cette cat�gorie');
define('_MOVECAT_BTN',				'D�placer categorie');

// URLMode setting
define('_SETTINGS_URLMODE',			'Type de lien');
define('_SETTINGS_URLMODE_NORMAL',	'Normal');
define('_SETTINGS_URLMODE_PATHINFO','Fancy');

// Batch operations
define('_BATCH_NOSELECTION',		'Aucune action s�lectionn�e');
define('_BATCH_ITEMS',				'Actions pour les objets');
define('_BATCH_CATEGORIES',			'Actions pour les cat�gories');
define('_BATCH_MEMBERS',			'Actions pour les membres');
define('_BATCH_TEAM',				'Actions pour les membres d\une �quipe');
define('_BATCH_COMMENTS',			'Actions pour les commentaires');
define('_BATCH_UNKNOWN',			'Action inconnue: ');
define('_BATCH_EXECUTING',			'En cours d\'ex�cution');
define('_BATCH_ONCATEGORY',			'pour une cat�gorie');
define('_BATCH_ONITEM',				'pour un objet');
define('_BATCH_ONCOMMENT',			'pour un commentaire');
define('_BATCH_ONMEMBER',			'pour un membre');
define('_BATCH_ONTEAM',				'pour le membre d\'une �quipe');
define('_BATCH_SUCCESS',			'f�licitation!');
define('_BATCH_DONE',				'r�ussi!');
define('_BATCH_DELETE_CONFIRM',		'Confirmer la suppression');
define('_BATCH_DELETE_CONFIRM_BTN',	'Confirmer la suppression');
define('_BATCH_SELECTALL',			'Tout s�lectionner');
define('_BATCH_DESELECTALL',		'Tout d�s�lectionner');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'Supprimer');
define('_BATCH_ITEM_MOVE',			'D�placer');
define('_BATCH_MEMBER_DELETE',		'Supprimer');
define('_BATCH_MEMBER_SET_ADM',		'Donne les droits admin');
define('_BATCH_MEMBER_UNSET_ADM',	'Enl�ve les droits admin');
define('_BATCH_TEAM_DELETE',		'Supprimer de l\'�quipe');
define('_BATCH_TEAM_SET_ADM',		'Donne les droits admin');
define('_BATCH_TEAM_UNSET_ADM',		'Enl�ve les droits admin');
define('_BATCH_CAT_DELETE',			'Supprimer');
define('_BATCH_CAT_MOVE',			'D�placer dans un autre blogue');
define('_BATCH_COMMENT_DELETE',		'Supprimer');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'Ajouter un nouvel objet...');
define('_ADD_PLUGIN_EXTRAS',		'Extra Plugin Options');

// errors
define('_ERROR_CATCREATEFAIL',		'Impossible de cr�er une nouvelle cat�gorie');
define('_ERROR_NUCLEUSVERSIONREQ',	'Ce plugin requiert une version plus r�cente de Nucleus: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Retour configuration Blogue');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Importer');
define('_SKINIE_TITLE_EXPORT',		'Exporter');
define('_SKINIE_BTN_IMPORT',		'Importer');
define('_SKINIE_BTN_EXPORT',		'Exporter les habillages/mod�les s�l�ctionn�s');
define('_SKINIE_LOCAL',				'Importer d\'un fichier local:');
define('_SKINIE_NOCANDIDATES',		'Pas d\'habillage valide trouv� dans le dossier skins');
define('_SKINIE_FROMURL',			'Importer � partir d\'un lien:');
define('_SKINIE_EXPORT_INTRO',		'S�lectionnez l\'habillage et le mod�le que vous souhaitez exporter');
define('_SKINIE_EXPORT_SKINS',		'Habillages');
define('_SKINIE_EXPORT_TEMPLATES',	'Mod�les');
define('_SKINIE_EXPORT_EXTRA',		'Info supl�mentaire');
define('_SKINIE_CONFIRM_OVERWRITE',	'R�ecrire par dessus l\'habillage existant');
define('_SKINIE_CONFIRM_IMPORT',	'Oui, je veux importe ceci');
define('_SKINIE_CONFIRM_TITLE',		'A propos de l\'importation d\'habillage et de mod�les');
define('_SKINIE_INFO_SKINS',		'Habillage dans le fichier:');
define('_SKINIE_INFO_TEMPLATES',	'Mod�le dans le fichier:');
define('_SKINIE_INFO_GENERAL',		'Information:');
define('_SKINIE_INFO_SKINCLASH',	'Nom de l\'habillage:');
define('_SKINIE_INFO_TEMPLCLASH',	'Nom du mod�le:');
define('_SKINIE_INFO_IMPORTEDSKINS','Habillage import�:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Mod�le import�:');
define('_SKINIE_DONE',				'Importation r�ussie');

define('_AND',						'et');
define('_OR',						'ou');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'Champs vide (cliquez pour modifier)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'Type d\'inclusion:');
define('_LIST_SKINS_INCPREFIX',		'Pr�fixe d\'inclusion');
define('_LIST_SKINS_DEFINED',		'Habillages d�finies:');

// backup
define('_BACKUPS_TITLE',			'Sauvegarde / Restauration');
define('_BACKUP_TITLE',				'Sauvegarde');
define('_BACKUP_INTRO',				'Cliquez le bouton ci-dessous pour cr�er une sauvegarde de votre base de donn�e Nucleus. Vous pourrez la stocker dans un fichier. Gardez ce fichier en lieu s�r.');
define('_BACKUP_ZIP_YES',			'Utiliser la compression');
define('_BACKUP_ZIP_NO',			'Ne pas utiliser la compression');
define('_BACKUP_BTN',				'Cr�er sauvegarde');
define('_BACKUP_NOTE',				'<b>Note:</b> Seul le contenu de la base de donn�es est sauvegard�. Les fichiers Media import�s et la configuration de config.php <b>NE SONT PAS</b> inclus dans la sauvegarde.');
define('_RESTORE_TITLE',			'Restaurer');
define('_RESTORE_NOTE',				'<b>ATTENTION:</b> Restaurer une sauvegarde <b>EFFACERA</b> toutes les donn�es contenues dans la base de donn�es Nucleus! Ne fa�tes ceci que si vous �tes s�r! <br />	<b>Note:</b> V�rifiez que la version de Nucleus pour laquelle vous souhaitez faire une sauvegarde soit la m�me que celle que vous utilisez actuellement, sinon rien ne fonctionnera');
define('_RESTORE_INTRO',			'S�lectionnez le fichier de sauvegarde ci-dessous (il sera transmis sur le serveur) et cliquez sur le bouton "restaurer" pour d�marrer.');
define('_RESTORE_IMSURE',			'Oui, je suis s�r de vouloir faire ceci!');
define('_RESTORE_BTN',				'Restaurer � partir d\'un fichier');
define('_RESTORE_WARNING',			'(V�rifiez que vous restaurez le bon fichier de sauvegarde. Fa�tes une nouvelle sauvegarde avant de commencer si vous n\'�tes pas s�r)');
define('_ERROR_BACKUP_NOTSURE',		'Vous devez cliquer la bo�te \'je suis s�r\'');
define('_RESTORE_COMPLETE',			'Restauration Compl�te');

// new item notification
define('_NOTIFY_NI_MSG',			'Un nouvel objet a �t� post�:');
define('_NOTIFY_NI_TITLE',			'Nouvel objet!');
define('_NOTIFY_KV_MSG',			'Karma vote pour l\'objet:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'Commentaire pour l\objet:');
define('_NOTIFY_NC_TITLE',			'Commentaire Nucleus:');
define('_NOTIFY_USERID',			'Utilisateur ID:');
define('_NOTIFY_USER',				'Utilisateur:');
define('_NOTIFY_COMMENT',			'Commentaire:');
define('_NOTIFY_VOTE',				'Vote:');
define('_NOTIFY_HOST',				'H�te:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'Membre:');
define('_NOTIFY_TITLE',				'Titre:');
define('_NOTIFY_CONTENTS',			'Informations:');

// member mail message
define('_MMAIL_MSG',				'Un message envoy� pour vous par');
define('_MMAIL_FROMANON',			'un visiteur anonyme');
define('_MMAIL_FROMNUC',			'Post� par un Weblog Nucleus �');
define('_MMAIL_TITLE',				'Un message de');
define('_MMAIL_MAIL',				'Message:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'Ajouter un objet');
define('_BMLET_EDIT',				'Modifier un objet');
define('_BMLET_DELETE',				'Supprimer un objet');
define('_BMLET_BODY',				'Corps');
define('_BMLET_MORE',				'�tendu');
define('_BMLET_OPTIONS',			'Options');
define('_BMLET_PREVIEW',			'Pr�visualisation');

// used in bookmarklet
define('_ITEM_UPDATED',				'l\'objet a �t� mis � jour');
define('_ITEM_DELETED',				'l\'objet a �t� supprim�');

// plugiciels
define('_CONFIRMTXT_PLUGIN',		'�tes-vous s�r de vouloir supprimer le plugin nomm�');
define('_ERROR_NOSUCHPLUGIN',		'Pas de plugin correspondant');
define('_ERROR_DUPPLUGIN',			'D�sol� ce plugin est d�j� install�');
define('_ERROR_PLUGFILEERROR',		'Ce plugin n\'existe pas, ou bien les permissions ne sont pas correctement configur�es');
define('_PLUGS_NOCANDIDATES',		'Pas de plugins valides trouv�s');

define('_PLUGS_TITLE_MANAGE',		'G�rer les plugins');
define('_PLUGS_TITLE_INSTALLED',	'D�j� install�s');
define('_PLUGS_TITLE_UPDATE',		'Mettre � jour la liste des inscriptions');
define('_PLUGS_TEXT_UPDATE',		'Nucleus garde un cache des inscriptions des plugins. Quand vous mettez � jour un plugin en rempla�ant son fichier, vous devez utiliser cette fonction pour mettre � jour le cache');
define('_PLUGS_TITLE_NEW',			'Installer un nouveau plugin');
define('_PLUGS_ADD_TEXT',			'Ci-dessous vous avez la liste de tous les fichers contenus dans votre r�pertoire de plugins. Il peut s\'agir de plugins non-install�s. Soyez <strong>vraiment</strong> s�r qu\'il s\'agit d\'un plugins avant de l\'ajouter.');
define('_PLUGS_BTN_INSTALL',		'Installer le plugin');
define('_BACKTOOVERVIEW',			'Retour au sommaire');

// editlink
define('_TEMPLATE_EDITLINK',		'Modifier le lien de l\'objet');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'Ajouter un cadre � gauche');
define('_ADD_RIGHT_TT',				'Ajouter un cadre � droite');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'Nouvelle cat�gorie');

// new settings
define('_SETTINGS_PLUGINURL',		'lien du plugin');
define('_SETTINGS_MAXUPLOADSIZE',	'Taille max. de fichier t�l�charg� (bytes)');
define('_SETTINGS_NONMEMBERMSGS',	'Autoriser les non-membres � envoyer des messages');
define('_SETTINGS_PROTECTMEMNAMES',	'Prot�ger les noms des membres');
// overview screen

define('_OVERVIEW_PLUGINS',			'G�rer les plugins...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'Enregistrement d\'un nouveau membre:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'Votre adresse courriel:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'Vous n\'avez pas les droits d\'admin sur les blogues qui contiennent ce membre sur la liste des r�dacteurs. En cons�quence, vous n\'�tes pas autoris�s � uploader des fichiers dans le r�pertoire de ce membre');

// plugiciel list
define('_LISTS_INFO',				'Information');
define('_LIST_PLUGS_AUTHOR',		'Par:');
define('_LIST_PLUGS_VER',			'Version:');
define('_LIST_PLUGS_SITE',			'Visiter les sites');
define('_LIST_PLUGS_DESC',			'Description:');
define('_LIST_PLUGS_SUBS',			'Inscription aux �v�nements suivants:');
define('_LIST_PLUGS_UP',			'd�placer vers le haut');
define('_LIST_PLUGS_DOWN',			'd�placer vers le bas');
define('_LIST_PLUGS_UNINSTALL',		'd�sinstaller');
define('_LIST_PLUGS_ADMIN',			'admin');
define('_LIST_PLUGS_OPTIONS',		'modifier les options');

// plugiciel option list
define('_LISTS_VALUE',				'Valeur');

// plugiciel options
define('_ERROR_NOPLUGOPTIONS',		'ce plugin n\'a aucun ensemble d\'options');
define('_PLUGS_BACK',				'Retour au sommaire des plugins');
define('_PLUGS_SAVE',				'Sauver les options');
define('_PLUGS_OPTIONS_UPDATED',	'Options de plugin mises � jour');

define('_OVERVIEW_MANAGEMENT',		'Gestion');
define('_OVERVIEW_MANAGE',			'Gestion de Nucleus...');
define('_MANAGE_GENERAL',			'Gestion g�n�rale');
define('_MANAGE_SKINS',				'Habillage et mod�les');
define('_MANAGE_EXTRA',				'Options suppl�mentaires');

define('_BACKTOMANAGE',				'Retour � la gestion de Nucleus');


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
define('_BADACTION',				'Action non pr�vue');
define('_MESSAGE',					'Message');
define('_HELP_TT',					'Aide!');
define('_YOURSITE',					'Votre site');


define('_POPUP_CLOSE',				'Fermer la fen�tre');

define('_LOGIN_PLEASE',				'Ouvrez une session d\'abord');

// commentform
define('_COMMENTFORM_YOUARE',		'Vous �tes');
define('_COMMENTFORM_SUBMIT',		'Ajouter un commentaire');
define('_COMMENTFORM_COMMENT',		'Votre commentaire');
define('_COMMENTFORM_NAME',			'Nom');
define('_COMMENTFORM_MAIL',			'Courriel/HTTP');
define('_COMMENTFORM_REMEMBER',		'Se souvenir');

// loginform
define('_LOGINFORM_NAME',			'Nom d\'usager');
define('_LOGINFORM_PWD',			'Mot de passe');
define('_LOGINFORM_YOUARE',			'Session ouverte sous');
define('_LOGINFORM_SHARED',			'Ordinateur partag�');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'Envoyer le message');

// search form
define('_SEARCHFORM_SUBMIT',		'Chercher');

// add item form
define('_ADD_ADDTO',				'Ajouter une nouvelle');
define('_ADD_CREATENEW',			'Cr�er une nouvelle');
define('_ADD_BODY',					'Corps');
define('_ADD_TITLE',				'Titre');
define('_ADD_MORE',					'Suite (optionel)');
define('_ADD_CATEGORY',				'Cat�gorie');
define('_ADD_PREVIEW',				'Pr�visualisation');
define('_ADD_DISABLE_COMMENTS',		'Interdire les commentaires?');
define('_ADD_DRAFTNFUTURE',			'Brouillon &amp; items futures');
define('_ADD_ADDITEM',				'Ajouter nouvelle');
define('_ADD_ADDNOW',				'Ajouter maintenant');
define('_ADD_ADDLATER',				'Ajouter + tard');
define('_ADD_PLACE_ON',				'Dat� du');
define('_ADD_ADDDRAFT',				'Ajouter aux brouillons');
define('_ADD_NOPASTDATES',			'(Les dates et heures pass�es ne sont pas valides, la date d\'aujourd\'hui sera utilis�e)');
define('_ADD_BOLD_TT',				'Gras');
define('_ADD_ITALIC_TT',			'Italique');
define('_ADD_HREF_TT',				'Faire un lien');
define('_ADD_MEDIA_TT',				'Ajouter un m�dia');
define('_ADD_PREVIEW_TT',			'Montrer/cacher la pr�visualisation');
define('_ADD_CUT_TT',				'Couper');
define('_ADD_COPY_TT',				'Copier');
define('_ADD_PASTE_TT',				'Coller');


// edit item form
define('_EDIT_ITEM',				'Modifier nouvelle');
define('_EDIT_SUBMIT',				'Soumettre');
define('_EDIT_ORIG_AUTHOR',			'Auteur original');
define('_EDIT_BACKTODRAFTS',		'Remettre dans les brouillons');
define('_EDIT_COMMENTSNOTE',		'(note: d�sactiver les commentaires ne cachera pas les commentaires ant�rieures)');

// used on delete screens
define('_DELETE_CONFIRM',			'SVP, confirmez la suppression');
define('_DELETE_CONFIRM_BTN',		'Je confirme');
define('_CONFIRMTXT_ITEM',			'Vous �tes sur le point de supprimer la nouvelle suivante:');
define('_CONFIRMTXT_COMMENT',		'Vous �tes sur le point de supprimer le commentaire suivant:');
define('_CONFIRMTXT_TEAM1',			'Vous allez supprimer');
define('_CONFIRMTXT_TEAM2',			' de la liste des r�dacteurs du blogue ');
define('_CONFIRMTXT_BLOG',			'Le blogue que vous allez effacer est: ');
define('_WARNINGTXT_BLOGDEL',		'Attention!  L\'effacement d\'un blogue effacera TOUT les objets de ce blogue ainsi que tout les commentaires.  Veuillez confirmer afin de s\'assurer que vous �tes CERTAIN de ce que vous faites<br />De plus, n\'interrompez pas Nucleus pendant l\'effacement de votre blogue.');
define('_CONFIRMTXT_MEMBER',		'Vous allez supprimer le profil utilisateur: ');
define('_CONFIRMTXT_TEMPLATE',		'Vous allez supprimer le mod�le nomm� ');
define('_CONFIRMTXT_SKIN',			'Vous allez supprimer l\'habillage d\'interface nomm� ');
define('_CONFIRMTXT_BAN',			'Vous allez supprimer le bannissement pour le rang IP');
define('_CONFIRMTXT_CATEGORY',		'Vous allez supprimer la cat�gorie ');

// some status messages
define('_DELETED_ITEM',				'Nouvelle supprim�e');
define('_DELETED_MEMBER',			'Membre supprim�');
define('_DELETED_COMMENT',			'Commentaire supprim�');
define('_DELETED_BLOG',				'Blogue supprim�');
define('_DELETED_CATEGORY',			'Cat�gorie supprim�e');
define('_ITEM_MOVED',				'Nouvelle d�plac�e');
define('_ITEM_ADDED',				'Nouvelle ajout�e');
define('_COMMENT_UPDATED',			'Commentaire mis � jour');
define('_SKIN_UPDATED',				'Configuration d\'habillage d\'interface sauv�e');
define('_TEMPLATE_UPDATED',			'Donn�e du mod�le sauvegard�e');

// errors
define('_ERROR_COMMENT_LONGWORD',	'SVP ne pas mettre de mots d�passant 90 caract�res');
define('_ERROR_COMMENT_NOCOMMENT',	'SVP, entrez un commentaire');
define('_ERROR_COMMENT_NOUSERNAME',	'Mauvais nom d\'utilisateur');
define('_ERROR_COMMENT_TOOLONG',	'Votre commentaire est trop long (max. 5000 chars)');
define('_ERROR_COMMENTS_DISABLED',	'Les commentaires sont d�sactiv�s.');
define('_ERROR_COMMENTS_NONPUBLIC',	'Vous devez �tre membre pour ajouter un commentaire');
define('_ERROR_COMMENTS_MEMBERNICK','Le nom que vous avez choisi pour poster votre commentaire est d�j� utilis� par un membre. Choisissez en un autre.');
define('_ERROR_SKIN',				'Erreur d\'habillage d\'interface');
define('_ERROR_ITEMCLOSED',			'Cette nouvelle est ferm�e, Il est impossible d\'ajouter un commentaire ou de voter');
define('_ERROR_NOSUCHITEM',			'Pas de nouvelle correspondante');
define('_ERROR_NOSUCHBLOG',			'Pas de blogue');
define('_ERROR_NOSUCHSKIN',			'Pas d\'habillage d\'interface correspondante');
define('_ERROR_NOSUCHMEMBER',		'Pas de membre correspondant');
define('_ERROR_NOTONTEAM',			'Vous ne faites pas partie de l\'�quipe �ditoriale.');
define('_ERROR_BADDESTBLOG',		'Le blogue de destination n\'existe pas');
define('_ERROR_NOTONDESTTEAM',		'Impossible de d�placer la nouvelle tant que vous ne faites pas partie de l\'�quipe �ditoriale');
define('_ERROR_NOEMPTYITEMS',		'Impossible d\'ajouter une nouvelle vide');
define('_ERROR_BADMAILADDRESS',		'Adresse courriel non-valide');
define('_ERROR_BADNOTIFY',			'Une ou plusieurs adresses courriel de notification ne sont pas valides');
define('_ERROR_BADNAME',			'Nom non-valide (signes : a-z et 0-9 autoris�s, pas d\'espaces au d�but ni � la fin)');
define('_ERROR_NICKNAMEINUSE',		'Un autre membre utilise ce surnom');
define('_ERROR_PASSWORDMISMATCH',	'Les mots de passe doivent correspondre');
define('_ERROR_PASSWORDTOOSHORT',	'Le mot de passe doit contenir au moins 6 caract�res');
define('_ERROR_PASSWORDMISSING',	'Le mot de passe ne doit pas �tre vide');
define('_ERROR_REALNAMEMISSING',	'Vous devez rentrer un vrai nom');
define('_ERROR_ATLEASTONEADMIN',	'Il doit toujours exister un super admin qui puisse entrer dans l\'administration du blogue.');
define('_ERROR_ATLEASTONEBLOGADMIN','Faire ceci rendra votre administration inaccessible. Assurez vous qu\'il y a toujours un admin.');
define('_ERROR_ALREADYONTEAM',		'Vous ne pouvez ajouter un utilisateur d�j� dans l\'�quipe');
define('_ERROR_BADSHORTBLOGNAME',	'Le nom court du blogue ne peux contenir que a-z et 0-9 sans espace');
define('_ERROR_DUPSHORTBLOGNAME',	'Un autre blogue a le m�me nom court. Les noms courts doivent �tre uniques');
define('_ERROR_UPDATEFILE',			'Impossible d\'acc�der en �criture au fichier d\'update. Assurez vous que les permissions sont OK (chmod 666). Le chemin est relatif au chemin d\'admin, utilisez un chemin absolu (quelque chose comme /your/path/to/nucleus/)');
define('_ERROR_DELDEFBLOG',			'Vous ne pouvez effacer le blogue par d�faut');
define('_ERROR_DELETEMEMBER',		'Cet utilisateur ne peux �tre effac�, probablement qu\'il est auteur de commentaires');
define('_ERROR_BADTEMPLATENAME',	'Nom invalide pour ce mod�le, utilisez a-z et 0-9 sans espaces');
define('_ERROR_DUPTEMPLATENAME',	'Un autre mod�le avec ce nom existe');
define('_ERROR_BADSKINNAME',		'Nom de habillage d\'interface invalide (seulement a-z, 0-9 sont autoris�s, pas d\'espaces)');
define('_ERROR_DUPSKINNAME',		'Un autre habillage d\'interface avec ce nom existe');
define('_ERROR_DEFAULTSKIN',		'Il doit toujours y avoir un habillage d\'interface avec le nom "default"');
define('_ERROR_SKINDEFDELETE',		'Impossible d\'effacer l\'habillage d\'interface tant qu\'elle est active par d�faut au blogue suivant: ');
define('_ERROR_DISALLOWED',			'D�sol� vous n\'�tes pas autoris� � faire cela');
define('_ERROR_DELETEBAN',			'Erreur en essayant d\'effacer le bannissement (pas de bannissement)');
define('_ERROR_ADDBAN',				'Erreur en essayant d\'ajouter le bannissement. Le bannissement n\'a pas �t� ajou� correctement dans tous vos blogues.');
define('_ERROR_BADACTION',			'L\'action demand�e n\'existe pas');
define('_ERROR_MEMBERMAILDISABLED',	'Les messages de membre � membre sont d�sactiv�s');
define('_ERROR_MEMBERCREATEDISABLED','La cr�ation de nouveaux utilisateurs est d�sactiv�e');
define('_ERROR_INCORRECTEMAIL',		'Adresse courriel incorrecte');
define('_ERROR_VOTEDBEFORE',		'Vous avez d�j� vot� pour cette nouvelle');
define('_ERROR_BANNED1',			'Impossible d\'effectuer cette action (ip range ');
define('_ERROR_BANNED2',			') votre ip est bannie. Le message �tait: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'Vous devez �tre logg� pour effectuer cette action');
define('_ERROR_CONNECT',			'Erreur de connexion');
define('_ERROR_FILE_TOO_BIG',		'Fichier trop grand!');
define('_ERROR_BADFILETYPE',		'D�sol� ce type de fichier n\est pas accept�');
define('_ERROR_BADREQUEST',			'Mauvaise demande de t�l�chargement');
define('_ERROR_DISALLOWEDUPLOAD',	'Vous n\'�tes dans aucune �quipe �ditoriale. Vous ne pouvez donc pas transmettre de fichier');
define('_ERROR_BADPERMISSIONS',		'Les permissions de fichiers ne sont pas correctement configur�es');
define('_ERROR_UPLOADMOVEP',		'Erreur pendant le d�placement du fichier transmis');
define('_ERROR_UPLOADCOPY',			'Erreur pendant la copie de fichier');
define('_ERROR_UPLOADDUPLICATE',	'Un autre fichier du m�me nom existe. Essayez de le renommer avant de l\'envoyer.');
define('_ERROR_LOGINDISALLOWED',	'D�sol� vous ne pouvez rentrer dans l\'admin. Vous pouvez aussi vous logger en tant qu\' utilisateur diff�rent');
define('_ERROR_DBCONNECT',			'Impossible de se connecter au serveur mySQL');
define('_ERROR_DBSELECT',			'Impossible de s�lectionner la table de Nucleus.');
define('_ERROR_NOSUCHLANGUAGE',		'Ce fichier de langue n\'existe pas');
define('_ERROR_NOSUCHCATEGORY',		'Cette cat�gorie n\'existe pas');
define('_ERROR_DELETELASTCATEGORY',	'Il doit y avoir au moins une cat�gorie');
define('_ERROR_DELETEDEFCATEGORY',	'Impossible d\'effacer la cat�gorie par d�faut');
define('_ERROR_BADCATEGORYNAME',	'Mauvais nom de cat�gorie');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'Attention: la valeur courante n\'est pas un r�pertoire!');
define('_WARNING_NOTREADABLE',		'Attention: la valeur courante n\'est pas un r�pertoire avec droit de lecture!');
define('_WARNING_NOTWRITABLE',		'Attention: la valeur courante n\'est pas un r�pertoire avec droit d\'�criture!');

// media and upload
define('_MEDIA_UPLOADLINK',			'T�l�chargement d\'un nouveau fichier');
define('_MEDIA_MODIFIED',			'modifi�');
define('_MEDIA_FILENAME',			'nom de fichier');
define('_MEDIA_DIMENSIONS',			'dimensions');
define('_MEDIA_INLINE',				'Ins�r�e');
define('_MEDIA_POPUP',				'Fen�tr�e');
define('_UPLOAD_TITLE',				'Choisir un fichier');
define('_UPLOAD_MSG',				'S�lectionnez le fichier � t�l�charger et cliquez sur le bouton ENVOYER.');
define('_UPLOAD_BUTTON',			'Envoyer');

// some status messages
define('_MSG_ACCOUNTCREATED',		'Compte cr��, le mot de passe sera envoy� par courriel');
define('_MSG_PASSWORDSENT',			'Le mot de passe a �t� envoy� par courriel.');
define('_MSG_LOGINAGAIN',			'Vous allez devoir ouvrir une nouvelle session car vos infos ont chang�');
define('_MSG_SETTINGSCHANGED',		'R�glages modifi�s');
define('_MSG_ADMINCHANGED',			'Admin chang�');
define('_MSG_NEWBLOG',				'Nouveau blogue cr��');
define('_MSG_ACTIONLOGCLEARED',		'Journal des actions effac�s');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'Action non autoris�e: ');
define('_ACTIONLOG_PWDREMINDERSENT','Nouveau mot de passe envoy� pour ');
define('_ACTIONLOG_TITLE',			'Journal des actions');
define('_ACTIONLOG_CLEAR_TITLE',	'Effacer le journal des actions');
define('_ACTIONLOG_CLEAR_TEXT',		'Effacer le journal des actions maintenant');

// team management
define('_TEAM_TITLE',				'G�rer l\'�quipe du blogue ');
define('_TEAM_CURRENT',				'Equipe courante');
define('_TEAM_ADDNEW',				'Ajouter un membre � l\'�quipe');
define('_TEAM_CHOOSEMEMBER',		'Choisir un membre');
define('_TEAM_ADMIN',				'Privil�ges d\'admin? ');
define('_TEAM_ADD',					'Ajouter � l\'�quipe');
define('_TEAM_ADD_BTN',				'Ajouter � l\'�quipe');

// bloguesettings
define('_EBLOG_TITLE',				'Modifier les param�tres du Blogue');
define('_EBLOG_TEAM_TITLE',			'Modifier l\'�quipe');
define('_EBLOG_TEAM_TEXT',			'Cliquer ici pour modifier votre �quipe.');
define('_EBLOG_SETTINGS_TITLE',		'Param�tres du blogue');
define('_EBLOG_NAME',				'Nom du blogue');
define('_EBLOG_SHORTNAME',			'Nom court du blogue');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(lettres a-z et pas d\'espaces)');
define('_EBLOG_DESC',				'Description du blogue ');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'Habillage par d�faut');
define('_EBLOG_DEFCAT',				'Cat�gorie par d�faut');
define('_EBLOG_LINEBREAKS',			'Convertir les sauts de lignes');
define('_EBLOG_DISABLECOMMENTS',	'Commentaires autoris�s?<br /><small>(Ajouter des commentaires sera impossible si non coch�.)</small>');
define('_EBLOG_ANONYMOUS',			'Autoriser les commentaires pour les non-membres?');
define('_EBLOG_NOTIFY',				'Adresses de notification (utiliser ; comme s�parateur)');
define('_EBLOG_NOTIFY_ON',			'Notification activ�e');
define('_EBLOG_NOTIFY_COMMENT',		'Nouveaux commentaires');
define('_EBLOG_NOTIFY_KARMA',		'Nouveaux votes Karma');
define('_EBLOG_NOTIFY_ITEM',		'Nouvelles blogue');
define('_EBLOG_PING',				'Pinger Weblogues.com � la mise � jour?');
define('_EBLOG_MAXCOMMENTS',		'Nombre max de commentaires');
define('_EBLOG_UPDATE',				'Fichier de mise-�-jour');
define('_EBLOG_OFFSET',				'Diff�rentiel de temps');
define('_EBLOG_STIME',				'Heure courante du serveur');
define('_EBLOG_BTIME',				'Heure courante du blogue');
define('_EBLOG_CHANGE',				'Changer les param�tres');
define('_EBLOG_CHANGE_BTN',			'Changer les param�tres');
define('_EBLOG_ADMIN',				'Administrer le blogue');
define('_EBLOG_ADMIN_MSG',			'Vous b�n�ficierez des privil�ges d\'administration');
define('_EBLOG_CREATE_TITLE',		'Cr�er un nouveau blogue');
define('_EBLOG_CREATE_TEXT',		'Remplissez le formulaire pour cr�er un nouveau blogue. <br /><br /> <b>Note:</b> Seules les options n�cessaires sont list�es. Pour plus d\'options, changez les param�tres apr�s la cr�ation.');
define('_EBLOG_CREATE',				'Cr�er!');
define('_EBLOG_CREATE_BTN',			'Cr�er le Weblogue');
define('_EBLOG_CAT_TITLE',			'Cat�gories');
define('_EBLOG_CAT_NAME',			'Nom de cat�gorie');
define('_EBLOG_CAT_DESC',			'Description de cat�gorie');
define('_EBLOG_CAT_CREATE',			'Cr�er une nouvelle cat�gorie');
define('_EBLOG_CAT_UPDATE',			'Mettre � jour la cat�gorie');
define('_EBLOG_CAT_UPDATE_BTN',		'Mettre � jour la cat�gorie');

// mod�les
define('_TEMPLATE_TITLE',			'Modifier les mod�les');
define('_TEMPLATE_AVAILABLE_TITLE',	'Mod�les disponibles');
define('_TEMPLATE_NEW_TITLE',		'Nouveau mod�le');
define('_TEMPLATE_NAME',			'Nom du mod�le');
define('_TEMPLATE_DESC',			'Description du mod�le');
define('_TEMPLATE_CREATE',			'Cr�er un mod�le');
define('_TEMPLATE_CREATE_BTN',		'Cr�er un mod�le');
define('_TEMPLATE_EDIT_TITLE',		'Modifier le mod�le');
define('_TEMPLATE_BACK',			'Revenir au sommaire du mod�le');
define('_TEMPLATE_EDIT_MSG',		'Toutes les parties du mod�les ne sont pas n�cessaires, laissez vides celles qui ne sont pas n�cessaires.');
define('_TEMPLATE_SETTINGS',		'Param�tres du mod�le');
define('_TEMPLATE_ITEMS',			'Nouvelles');
define('_TEMPLATE_ITEMHEADER',		'En-t�te de nouvelles');
define('_TEMPLATE_ITEMBODY',		'Corps de nouvelles');
define('_TEMPLATE_ITEMFOOTER',		'Pied de nouvelles');
define('_TEMPLATE_MORELINK',		'Lien vers la nouvelle �tendue');
define('_TEMPLATE_NEW',				'Indication de nouvelles r�centes');
define('_TEMPLATE_COMMENTS_ANY',	'Commentaires (si n�cessaire)');
define('_TEMPLATE_CHEADER',			'En-t�te de commentaire');
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
define('_TEMPLATE_AHEADER',			'En-t�te d\'archive');
define('_TEMPLATE_AITEM',			'Archive (item)');
define('_TEMPLATE_AFOOTER',			'Pied de liste d\'archive');
define('_TEMPLATE_DATETIME',		'date et heure');
define('_TEMPLATE_DHEADER',			'En-t�te de date');
define('_TEMPLATE_DFOOTER',			'Pied de date');
define('_TEMPLATE_DFORMAT',			'Format de date');
define('_TEMPLATE_TFORMAT',			'Format d\'heure');
define('_TEMPLATE_LOCALE',			'Locale');
define('_TEMPLATE_IMAGE',			'Fen�tres d\'images');
define('_TEMPLATE_PCODE',			'Code de lien fen�trage');
define('_TEMPLATE_ICODE',			'Code d\'image en ligne');
define('_TEMPLATE_MCODE',			'Code lien objet media');
define('_TEMPLATE_SEARCH',			'Chercher');
define('_TEMPLATE_SHIGHLIGHT',		'Surbrillance');
define('_TEMPLATE_SNOTFOUND',		'Rien n\'a �t� trouv�');
define('_TEMPLATE_UPDATE',			'Mettre � jour');
define('_TEMPLATE_UPDATE_BTN',		'Mettre � jour le mod�le');
define('_TEMPLATE_RESET_BTN',		'Effacer les donn�es');
define('_TEMPLATE_CATEGORYLIST',	'Listes de cat�gories');
define('_TEMPLATE_CATHEADER',		'En-t�te de Liste de cat�gories');
define('_TEMPLATE_CATITEM',			'Liste de cat�gorie (item)');
define('_TEMPLATE_CATFOOTER',		'pied de liste de cat�gories');

// habillages d\'interface
define('_SKIN_EDIT_TITLE',			'Modifier les habillages d\'interface');
define('_SKIN_AVAILABLE_TITLE',		'Habillages disponibles');
define('_SKIN_NEW_TITLE',			'Nouvel habillage d\'interface');
define('_SKIN_NAME',				'Nom');
define('_SKIN_DESC',				'Description');
define('_SKIN_TYPE',				'Type de contenu');
define('_SKIN_CREATE',				'Cr�er');
define('_SKIN_CREATE_BTN',			'Cr�er l\'habillage d\'interface');
define('_SKIN_EDITONE_TITLE',		'Modifier l\'habillage d\'interface');
define('_SKIN_BACK',				'Retour au sommaire de l\'habillage d\'interface');
define('_SKIN_PARTS_TITLE',			'Parties de l\'habillage d\'interface');
define('_SKIN_PARTS_MSG',			'Tous les types ne sont pas n�cessaires pour chaque habillage d\'interface. Laissez vides ceux dont vous n\'avez pas besoin. Choisir l\'habillage d\'interface � �diter en dessous:');
define('_SKIN_PART_MAIN',			'Index g�n�ral');
define('_SKIN_PART_ITEM',			'Pages de nouvelles');
define('_SKIN_PART_ALIST',			'Liste des archives');
define('_SKIN_PART_ARCHIVE',		'Archive');
define('_SKIN_PART_SEARCH',			'recherche');
define('_SKIN_PART_ERROR',			'Erreurs');
define('_SKIN_PART_MEMBER',			'D�tails utilisateurs');
define('_SKIN_PART_POPUP',			'Fen�trage d\'images');
define('_SKIN_GENSETTINGS_TITLE',	'param�tres g�n�raux');
define('_SKIN_CHANGE',				'Changer');
define('_SKIN_CHANGE_BTN',			'Changer ces param�tres');
define('_SKIN_UPDATE_BTN',			'Mettre � jour l\'habillage d\'interface');
define('_SKIN_RESET_BTN',			'Donn�es par d�faut');
define('_SKIN_EDITPART_TITLE',		'Modifier l\'habillage d\'interface');
define('_SKIN_GOBACK',				'Retour');
define('_SKIN_ALLOWEDVARS',			'Variables autoris�es (cliquer pour des infos):');

// global settings
define('_SETTINGS_TITLE',			'Param�tres g�n�raux');
define('_SETTINGS_SUB_GENERAL',		'Param�tres g�n�raux');
define('_SETTINGS_DEFBLOG',			'Blogue par d�faut');
define('_SETTINGS_ADMINMAIL',		'courriel de l\'admin');
define('_SETTINGS_SITENAME',		'Nom du site');
define('_SETTINGS_SITEURL',			'URL du site (doit finir avec un slash)');
define('_SETTINGS_ADMINURL',		'URL de l\'admin (doit finir avec un slash)');
define('_SETTINGS_DIRS',			'R�pertoires de Nucleus');
define('_SETTINGS_MEDIADIR',		'R�pertoire media');
define('_SETTINGS_SEECONFIGPHP',	'(voir config.php)');
define('_SETTINGS_MEDIAURL',		'URL media (doit finir avec un slash)');
define('_SETTINGS_ALLOWUPLOAD',		'Autoriser les t�l�versements?');
define('_SETTINGS_ALLOWUPLOADTYPES','Fichiers autoris�s pour les t�l�versements');
define('_SETTINGS_CHANGELOGIN',		'Autoriser les utilisateurs � changer le mot de passe de session');
define('_SETTINGS_COOKIES_TITLE',	'Param�tres des fichiers t�moins');
define('_SETTINGS_COOKIELIFE',		'Dur�e de vie du fichier t�moin de session');
define('_SETTINGS_COOKIESESSION',	'Fichiers t�moins de session');
define('_SETTINGS_COOKIEMONTH',		'Dur�e de vie d\'un mois');
define('_SETTINGS_COOKIEPATH',		'Chemin du fichier t�moin (niveau avanc�)');
define('_SETTINGS_COOKIEDOMAIN',	'Domaine du fichier t�moin (niveau avanc�)');
define('_SETTINGS_COOKIESECURE',	'Fichier t�moin s�curis�(niveau avanc�)');
define('_SETTINGS_LASTVISIT',		'Sauver les fichiers t�moins de la derni�re visite');
define('_SETTINGS_ALLOWCREATE',		'Autoriser les visiteurs � cr�er un compte');
define('_SETTINGS_NEWLOGIN',		'Ouvrir une session autoris�e pour les comptes cr��s par des utilisateurs');
define('_SETTINGS_NEWLOGIN2',		'(ne vaut que pour les comptes r�cemment cr��s)');
define('_SETTINGS_MEMBERMSGS',		'Autoriser les services de membres � membres');
define('_SETTINGS_LANGUAGE',		'Langage par d�faut');
define('_SETTINGS_DISABLESITE',		'D�sactiver le site');
define('_SETTINGS_DBLOGIN',			'Ouvrir une session mySQL &amp; base de donn�es');
define('_SETTINGS_UPDATE',			'Mettre � jour les param�tres');
define('_SETTINGS_UPDATE_BTN',		'Mettre � jour les param�tres');
define('_SETTINGS_DISABLEJS',		'D�sactiver la barre d\'outils javascript');
define('_SETTINGS_MEDIA',			'Param�tres de t�l�versement de m�dias');
define('_SETTINGS_MEDIAPREFIX',		'Pr�fixer le nom des fichiers avec la date');
define('_SETTINGS_MEMBERS',			'Param�tres des membres');

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
define('_BAN_REMOVED_TITLE',		'Bannissement supprim�');
define('_BAN_REMOVED_TEXT',			'Le bannissement a �t� supprim� pour les blogues suivants:');
define('_BAN_ADD_TITLE',			'Ajouter un bannissement');
define('_BAN_IPRANGE_TEXT',			'Choisir le rang d\'IP que vous voulez bloquer. Moins il y aura de nombres, plus le nombre d\IP bloqu�es sera grand.');
define('_BAN_BLOGS_TEXT',			'Vous pouvez choisir de bannir une IP pour un blogue seulement ou pour tous ceux o� vous �tes admin. Faites votre choix ici.');
define('_BAN_REASON_TITLE',			'Raison');
define('_BAN_REASON_TEXT',			'Vous pouvez fournir une raison de bannissement qui sera affich�e quand l\'IP concern�e essaiera d\'ajouter un commentaire ou un vote. Longueur max. 256 caract�res.');
define('_BAN_ADD_BTN',				'Ajouter le bannissement');

// LOGIN screen
define('_LOGIN_MESSAGE',			'Message');
define('_LOGIN_NAME',				'Nom');
define('_LOGIN_PASSWORD',			'Mot de passe');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'Mot de passe oubli�?');

// membermanagement
define('_MEMBERS_TITLE',			'Gestion des utilisateurs');
define('_MEMBERS_CURRENT',			'Utilisateurs actuels');
define('_MEMBERS_NEW',				'Nouvel utilisateur');
define('_MEMBERS_DISPLAY',			'Nom affich�');
define('_MEMBERS_DISPLAY_INFO',		'(Nom utilis� pour le login)');
define('_MEMBERS_REALNAME',			'Nom r�el');
define('_MEMBERS_PWD',				'Mot de passe');
define('_MEMBERS_REPPWD',			'R�p�ter le mot de passe');
define('_MEMBERS_EMAIL',			'Addresse courriel');
define('_MEMBERS_EMAIL_EDIT',		'(Quand vous changez d\'adresse courriel, un nouveau mot de passe est envoy� � cette adresse)');
define('_MEMBERS_URL',				'Adresse web (URL)');
define('_MEMBERS_SUPERADMIN',		'Privil�ges de super-admin');
define('_MEMBERS_CANLOGIN',			'Peut ouvrir une session comme admin');
define('_MEMBERS_NOTES',			'Notes');
define('_MEMBERS_NEW_BTN',			'Ajouter l\'utilisateur');
define('_MEMBERS_EDIT',				'Modifier l\'utilisateur');
define('_MEMBERS_EDIT_BTN',			'Changer les param�tres');
define('_MEMBERS_BACKTOOVERVIEW',	'Retour au sommaire utilisateur');
define('_MEMBERS_DEFLANG',			'Langage');
define('_MEMBERS_USESITELANG',		'- utiliser les param�tres du site -');

// List of blogues (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'Visiter le site');
define('_BLOGLIST_ADD',				'Ajouter une nouvelle');
define('_BLOGLIST_TT_ADD',			'Ajouter une nouvelle � ce blogue');
define('_BLOGLIST_EDIT',			'Modifier/supprimer des nouvelles');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Bookmarklet');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'Param�tres');
define('_BLOGLIST_TT_SETTINGS',		'Modifier des param�tres ou g�rer l\'�quipe');
define('_BLOGLIST_BANS',			'Bannissements');
define('_BLOGLIST_TT_BANS',			'Voir, ajouter ou supprimer des IP bannies');
define('_BLOGLIST_DELETE',			'Tout supprimer');
define('_BLOGLIST_TT_DELETE',		'Supprimer ce blogue');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'Votre blogue');
define('_OVERVIEW_YRDRAFTS',		'Vos brouillons');
define('_OVERVIEW_YRSETTINGS',		'Vos param�tres');
define('_OVERVIEW_GSETTINGS',		'Param�tres g�n�raux');
define('_OVERVIEW_NOBLOGS',			'Vous n\'�tes dans aucune �quipe de r�daction');
define('_OVERVIEW_NODRAFTS',		'Pas de brouillons');
define('_OVERVIEW_EDITSETTINGS',	'Modifiez vos param�tres...');
define('_OVERVIEW_BROWSEITEMS',		'Consultez vos nouvelles...');
define('_OVERVIEW_BROWSECOMM',		'Consultez vos commentaires...');
define('_OVERVIEW_VIEWLOG',			'Regardez le journal d\'actions...');
define('_OVERVIEW_MEMBERS',			'G�rer les utilisateurs...');
define('_OVERVIEW_NEWLOG',			'Cr�er un nouveau blogue...');
define('_OVERVIEW_SETTINGS',		'Modifier les param�tres...');
define('_OVERVIEW_TEMPLATES',		'Modifier les mod�les...');
define('_OVERVIEW_SKINS',			'Modifier les habillages d\'interface...');
define('_OVERVIEW_BACKUP',			'Sauvegarde/R�cup�ration...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'Nouvelles pour le blogue'); 
define('_ITEMLIST_YOUR',			'Vos nouvelles');

// Comments
define('_COMMENTS',					'Commentaires');
define('_NOCOMMENTS',				'Pas de commentaires pour cette nouvelle');
define('_COMMENTS_YOUR',			'Vos commentaires');
define('_NOCOMMENTS_YOUR',			'Vous n\'avez �crit aucun commentaire');

// LISTS (general)
define('_LISTS_NOMORE',				'Plus de r�sultats ou pas de r�sultat du tout');
define('_LISTS_PREV',				'Pr�c�dent');
define('_LISTS_NEXT',				'Suivant');
define('_LISTS_SEARCH',				'Chercher');
define('_LISTS_CHANGE',				'Changer');
define('_LISTS_PERPAGE',			'Nouvelles/page');
define('_LISTS_ACTIONS',			'Actions');
define('_LISTS_DELETE',				'Supprimer');
define('_LISTS_EDIT',				'Modifier');
define('_LISTS_MOVE',				'D�placer');
define('_LISTS_CLONE',				'Cloner');
define('_LISTS_TITLE',				'Titre');
define('_LISTS_BLOG',				'Blogue');
define('_LISTS_NAME',				'Nom');
define('_LISTS_DESC',				'Description');
define('_LISTS_TIME',				'Heure');
define('_LISTS_COMMENTS',			'Commentaires');
define('_LISTS_TYPE',				'Type');


// member list 
define('_LIST_MEMBER_NAME',			'Nom affich�');
define('_LIST_MEMBER_RNAME',		'Nom r�el');
define('_LIST_MEMBER_ADMIN',		'Super-admin? ');
define('_LIST_MEMBER_LOGIN',		'Ouvrir une session autoris�e? ');
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
define('_LIST_COMMENT_HOST',		'H�te');

// itemlist
define('_LIST_ITEM_INFO',			'Info');
define('_LIST_ITEM_CONTENT',		'Titre et texte');


// teamlist
define('_LIST_TEAM_ADMIN',			'Admin ');
define('_LIST_TEAM_CHADMIN',		'Changer Admin');

// edit comments
define('_EDITC_TITLE',				'Modifier les commentaires');
define('_EDITC_WHO',				'Auteur');
define('_EDITC_HOST',				'Depuis o�?');
define('_EDITC_WHEN',				'Quand?');
define('_EDITC_TEXT',				'Texte');
define('_EDITC_EDIT',				'Modifier commentaire');
define('_EDITC_MEMBER',				'membre');
define('_EDITC_NONMEMBER',			'non membre');

// move item
define('_MOVE_TITLE',				'D�placer vers quel blogue?');
define('_MOVE_BTN',					'D�placer nouvelle');

?>