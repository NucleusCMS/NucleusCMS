<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2007 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */

/**
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2007 The Nucleus Group
 * @version $Id: install.php 1227 2007-12-14 16:48:40Z ehui $
 */

define('_ERROR1',	'Votre version de PHP ne prend pas en charge MySQL :(');
define('_ERROR2',	'Nom de la base de donn&eacute;e mySQL absente');
define('_ERROR3',	'Pr&eacute;fixe mySQL coch&eacute;, mais le champ "prefix" est vide');
define('_ERROR4',	'Le pr&eacute;fixe mySQL ne peut contenir que les caract&egrave;res A-Z, a-z, 0-9 ou soulignement');
define('_ERROR5',	'Une des URL ne se termine pas par un slash (\'/\'), ou l\'URL "action" ne se termine pas par "action.php"');
define('_ERROR6',	'Le chemin vers la zone d\'administration ne se termine pas avec un slash');
define('_ERROR7',	'Le chemin pour les medias path does ne se termine pas avec un slash)');
define('_ERROR8',	'Le chemin pour les skins ne se termine pas avec un slash');
define('_ERROR9',	'Le chemin vers la zone d\'administration n\'est pas pr&eacute;sent sur votre serveur');
define('_ERROR10',	'Adresse e-mail de l\'utilisateur invalide');
define('_ERROR11',	'Le nom d\'utilisateur est invalide (caract&egrave;res autoris&eacute;s: a-z, A-Z, 0-9 et espace)');
// define('_ERROR12',	'Mot de passe absent');
// define('_ERROR13',	'Mots de passe diff&eacute;rents');
define('_ERROR12',	'Mot de passe absent');
define('_ERROR13',	'Mots de passe diff&eacute;rents');
define('_ERROR14',	'Raccourci invalide pour le raccourci du blog (caract&egrave;res autoris&eacute;s: a-z, A-Z, 0-9 et espace)');
define('_ERROR15',	'Connexion impossible au serveur mySQL');
define('_ERROR16',	'Cr&eacute;ation de la base de donn&eacute;es impossible. Assurez-vous d\'avoir les droits pour le faire. Erreur SQL&nbsp;:');
define('_ERROR17',	'Impossible de s&eacute;lectionner la base de donn&eacute;es. Assurez-vous qu\'elle existe');
define('_ERROR18',	'Erreur lors de l\'ex&eacute;cution de la requ&ecirc;te');
define('_ERROR19',	'Erreur lors de la cr&eacute;ation des param&egrave;tres de l\'utilisateur');
define('_ERROR20',	'Erreur lors de la cr&eacute;ation des param&egrave;tres du weblog');
define('_ERROR21',	'Erreur lors de la requ&ecirc;te');
define('_ERROR22',	'Impossible d\'installer le plugin ');
define('_ERROR23_1',	'Impossible d\'importer ');
define('_ERROR23_2',	'Le fichier est absent');
define('_ERROR24',	'Impossible d\'importer ');
define('_ERROR25_1',	'Fichier <b>');
define('_ERROR25_2',	'</b> introuvable ou non lisible.');
define('_ERROR26',	'Erreur de requ&ecirc;te lors de la tentative de mise &agrave; jour de la configuration');
define('_ERROR27',	'Erreur!');
define('_ERROR28',	'Le message d\'erreur &eacute;tait');
define('_ERROR29',	'Les messages d\'erreur &eacute;taient');
define('_ERROR30',	'Erreur lors de l\'ex&eacute;cution de la requ&ecirc;te');

define('_NOTIFICATION1',	'Non disponible');

define('_ALT_NUCLEUS_CMS_LOGO',	'Logo de Nucleus CMS');
define('_TITLE',	'Installation de Nucleus');
define('_TITLE2',	'Erreurs d\'installation de Skin/Plugin');
define('_TITLE3',	'Installation presque achev&eacute;e!');
define('_TITLE4',	'Installation achev&eacute;e&nbsp;!');
define('_TITLE5',	'Lutte contre les spams');

define('_HEADER1', 	'Installer Nucleus');
define('_TEXT1',	'<p>Ce script va voius assister pour l\'installation de Nucleus. Il va c&eacute;n&eacute;rer votre basse de donn&eacute;es MySQL et demander ou donner les informations n&eacute;cessaires &agrave; <i>config.php</i>. Afin de r&eacute;ussir cela, vous devrez fournir quelques informations.</p><p>Toutes les entr&eacute;es sont n&eacute;cessaires. Les informations optionnelles peuvent &ecirc;tre cr&eacute;&eacute;es apr&egrave;s l\'installation, depuis la zone d\'administration de Nucleus.</p>');

define('_HEADER2',	'Versions PHP &amp; MySQL');
define('_TEXT2',	'<p>Ci-dessous figurent les num&eacute;ros de version de l\'interpr&eacute;teur PHP et du serveur MySQL de votre serveur. En rapportant des probl&egrave;mes sur le forum d\'aide de Nucleus, merci de fuornir ces indications.</p>');
define('_TEXT2_WARN',	'ATTENTION&nbsp;: Nucleus requiert au minimum PHP ');
define('_TEXT2_WARN2',	'INFORMATION&nbsp;: Nucleus requiert au minimum MySQL ');
define('_TEXT2_WARN3',	'ATTENTION&nbsp;: Vous installez NucleusCMS avec une ancienne version de PHP. Le support de PHP4 ne sera plus assur&eacute; dans le prochaines mises &agrave; jour, merci de bien vouloir assurer la prise en charge de PHP5.');

define('_HEADER3',	'Mise &agrave; jour automaticque de <i>config.php</i>');
define('_TEXT3',	'<p>Si vous souhaitez que Nucleus mette automatiquement &agrave; jour <em>config.php</em>, vous devez vous assurer qu\'il est modifiable. Pour cela, il doit avoir les droits <strong>666</strong>. Apr&egrave;s l\'installation r&eacute;ussie de Nucleus, vous pouvez remettre ces droits &agrave; <strong>444</strong> (<a href="nucleus/documentation/tips.html#filepermissions">Guide rapide sur le changement des droits des fichiers (anglais)</a>).</p> <p>Si vous pr&eacute;f&eacute;rez ne pas rendre le fichier modifiable ou ne pouvez le faire, pas d\'inqui&eacute;tude. La proc&eacute;dure d\'installation vous fournira le contenu &agrave; mettre dans <em>config.php</em>, que vous pourrez t&eacute;l&eacute;charger vous-m&ecirc;me.</p>');

define('_HEADER4',	'Donn&eacute;es de connexion MySQL');
define('_TEXT4',	'<p>Indiquez ci-dessous vos donn&eacute;es MySQL. Ce script d\'installation en a besoin pour cr&eacute;er et d&eacute;finir les tables de votre base de donn&eacute;es. Vous devrez aussi placer ces donn&eacute;es dans <i>config.php</i>.</p><p>Si vous ne connaissez pas ces informations, contactez votre administrateur syst&egrave;me pour les obtenir. Le nom d\'h&ocirc;te est souvent  \'localhost\'. Si Nucleus trouve un \'default MySQL host\' dans les param&egrave;tres de votre serveur, cet h&ocirc;te sera pris comme nom par d&eacute;faut. Il n\'y a cependant pas de certitude que ce nom soit le bon.</p>');
define('_TEXT4_TAB_HEAD',	'Param&egrave;tres g&eacute;n&eacute;raux de la base de donn&eacute;es');
define('_TEXT4_TAB_FIELD1',	'Nom de l\'h&ocirc;te');
define('_TEXT4_TAB_FIELD2',	'Utilisateur');
define('_TEXT4_TAB_FIELD3',	'Mot de passe');
define('_TEXT4_TAB_FIELD4',	'Base de donn&eacute;es');
define('_TEXT4_TAB_FIELD4_ADD',	'doit &ecirc;tre cr&eacute;&eacute;e');

define('_TEXT4_TAB2_HEAD',	'Param&egrave;tres avanc&eacute;s de la base de donn&eacute;es');
define('_TEXT4_TAB2_FIELD',	'Utiliser un pr&eacute;fixe pour les tables');
define('_TEXT4_TAB2_ADD',	'<p>Sauf si vous installez plusieurs Nucleus avec une m&ecirc;me base de donn&eacute;es et savez ce que vous faites, <strong>pas de n&eacute;cessit&eacute; &agrave; changer ceci</strong>.</p><p>Toutes les tables de la base de donn&eacute;es Nucleus auront ce pr&eacute;fixe.</p>');

define('_HEADER5',	'Dossiers et URL');
define('_TEXT5',	'<p>Le script d\'installation a essay&eacute; de d&eacute;finir les dossiers et URL o&ugrave; Nucleus est install&eacute;. Merci v&eacute;rifier les valeurs ci-dessous et de les corriger si n&eacute;cessaire. URL et dossiers doivent se terminer par un slash.</p>');

define('_TEXT5_TAB_HEAD',	'Dossiers et URL');
define('_TEXT5_TAB_FIELD1',	'<strong>URL</strong> du site');
define('_TEXT5_TAB_FIELD2',	'<strong>URL</strong> pour l\'administration');
define('_TEXT5_TAB_FIELD3',	'<strong>Dossier</strong> pour l\'administration');
define('_TEXT5_TAB_FIELD4',	'<strong>URL</strong> pour les fichiers m&eacute;dia');
define('_TEXT5_TAB_FIELD5',	'<strong>Dossier</strong> pour les fichiers m&eacute;dia');
define('_TEXT5_TAB_FIELD6',	'<strong>URL</strong> pour les fichiers compl&eacute;mentaires de \'skin\'');
define('_TEXT5_TAB_FIELD7',	'<strong>Dossier</strong> pour les fichiers compl&eacute;mentaires de \'skin\'');
define('_TEXT5_TAB_FIELD7_2',	'C\'est l&agrave; que les \'skins\' import&eacute; doivent placer leurs fichiers suppl&eacute;mentaires (extra files)');
define('_TEXT5_TAB_FIELD8',	'<strong>URL</strong> pour les plugins');
define('_TEXT5_TAB_FIELD9',	'<strong>URL</strong> pour les \'Actions\'');
define('_TEXT5_TAB_FIELD9_2',	'Localisation absolue du fichier <tt>action.php</tt>');
define('_TEXT5_2',	'<p class="note"><strong>Note: Utilisez des chemins absolus</strong> plut&ocirc;t que des chemins relatifs. Habituellement, un chemin absolu commence par quelque chose comme <tt>/home/username/public_html/</tt>. Sur les syst&egrave;mes Unix (cas de la plupart des serveurs), les chemins doivent commencer par un slash. Si vous avez un probl&egrave;me pour fournir cette information, vous devriez demander &agrave; votre adminsitrateur ce qu\'il faut placer ici.</p>');

define('_HEADER6',	'Administrateur');
define('_TEXT6',	'<p>Ci-dessous, vous devez fournir les informations permettant de cr&eacute;er le premier utilisateur du site.</p>');
define('_TEXT6_TAB_HEAD',	'Administrateur');
define('_TEXT6_TAB_FIELD1',	'Nom affich&eacute;');
define('_TEXT6_TAB_FIELD1_2',	'caract&egrave;res autoris&eacute;s: a-z et 0-9, espaces autoris&eacute;s &agrave; l\'int&eacute;rieur du nom');
define('_TEXT6_TAB_FIELD2',	'Nom de connexion');
define('_TEXT6_TAB_FIELD3',	'Mot de passe');
define('_TEXT6_TAB_FIELD4',	'Confirmation');
define('_TEXT6_TAB_FIELD5',	'Adresse e-mail');
define('_TEXT6_TAB_FIELD5_2',	'Doit &ecirc;tre une adresse e-mail valide');

define('_HEADER7',	'Donn&eacute;es du Weblog');
define('_TEXT7',	'<p>Ci-dessous, vous devez fournir les informations concernant le weblog initial. Le nom de ce weblog sera aussi celui de votre site.</p>');
define('_TEXT7_TAB_HEAD',	'Donn&eacute;es du Weblog');
define('_TEXT7_TAB_FIELD1',	'Nom du blog');
define('_TEXT7_TAB_FIELD2',	'Nom abr&eacute;g&eacute;');
define('_TEXT7_TAB_FIELD2_2',	'Les caract&egrave;res accept&eacute;s sont&nbsp;: a-z et 0-9, espaces interdits');

define('_HEADER9',	'Valider');
define('_TEXT9',	'<p>V&eacute;rifiez les informations ci-dessus et cliquez sur le bouton ci-dessous pour cr&eacute;er vos tables et les donn&eacute;es initiales. Ceci peut prendre un certain temps, donc ayez de la patience. <strong>CLIQUER SUR LE BOUTON UNE SEULE FOIS&nbsp;!</strong></p>');

define('_TEXT10',	'<p>Les tables ont &eacute;t&eacute; initialis&eacute;es avec succ&egrave;s. La derni&egrave;re op&eacute;ration &agrave; effectuer est de modifier le contenu de <i>config.php</i>. Ci-dessous vous pouvez voir les changements &agrave; enregistrer (le mot de passe MySQL est masqu&eacute;, vous devrez donc le saisir vous-m&ecirc;me).</p>');
define('_TEXT11',	'<p>Apr&egrave;s avoir modifi&eacute; le fichier localement, t&eacute;l&eacute;chargez-le sur votre serveur web <i>via</> FTP. Assurez-vous de choisir le mode d\'envoi de fichiers ASCII.</p>');
define('_TEXT12',	'<b>Note:</b> Assurez-vous qu\'il n\'y a pas d\'espaces au d&eacute;but ni &agrave; la fin du fichier <i>config.php</i>. Ceux-ci provoqueraient une erreur d\'interpr&eacute;tation lors de l\'ex&eacute;cution de certaines commandes.<br /> Le premier caract&egrave;re du fichier doit &ecirc;tre "&lt;" et le dernier, "&gt;".');
define('_TEXT13',	'<p>Nucleus a &eacute;t&eacute; install&eacute; et votre fichier <code>config.php</code> a &eacute;t&eacute; mis &agrave; jour.</p><p>N\'oubliez pas de remettre les droits sur le fichier <code>config.php</code> &agrave; 444 pour la s&eacute;curit&eacute; de votre site (<a href="nucleus/documentation/tips.html#filepermissions">Guide rapide sur le changement des droits des fichiers (anglais)</a>).</p>');
define('_TEXT14',	'<p>Nucleus CMS autorise tout visiteur &agrave; &eacute;crire des commentaires, ce qui pourrait inciter des spammeurs &agrave; abuser de cette fonction. Nous vous recommandons de prot&eacute;ger votre blog avec l\'une au moins des m&eacute;thodes suivantes:</p>');
define('_TEXT14_L1',	'Si vous ne souhaitez pas de commentaires vous pouvez les d&eacute;sactiver pour chaque blog. Rendez-vous &agrave; la page d\'accueil de l\'administration et s&eacute;lectionnez <b>Votre Weblog > Param&egrave;tres > Commentaires activ&eacute;s > Non</b>.');
define('_TEXT14_L2',	'Installer des plugins qui aident &agrave; &eacute;liminer les spams&nbsp;: <a href="http://faq.nucleuscms.org/item/45">Comment puis-je arr&ecirc;ter et retracer les spams&nbsp;? (FAQ en anglais)</a> (vous pouvez placer cette page dans les marque-pages pour la lire plus tard).');
define('_HEADER10',	'Supprimer les fichiers d\'installation');
define('_TEXT15',	'<p>Fichiers que vous devrez suprimer de votre serveur web&nbsp;:</p>');
define('_TEXT15_L1',	'<b>install/install.sql</b>: fichier contenant la structure des tables');
define('_TEXT15_L2',	'<b>install/index.php</b> (ce fichier)');

define('_TEXT16',	'<p>Si vous ne supprimez pas ces fichiers vous n\'aurez pas le droit d\'acc&eacute;der aux pages d\'administration</p>');

define('_HEADER11',	'Visitez votre site web');
define('_TEXT16_H',	'Votre site web est maintenant pr&ecirc;t.');
define('_TEXT16_L1',	'Connectez-vous comme administrateur pour configurer votre site');
define('_TEXT16_L2',	'Visiter votre site web maintenant');

define('_TEXT17',	'Pr&eacute;c&eacute;dent');

define('_BUTTON1',	'Installer Nucleus');

define('_1ST_POST_TITLE',	'Bienvenue sur Nucleus CMS %s');
define('_1ST_POST',	'Ceci est le premier billet de votre CMS Nucleus. Il vous permet de construire les blocs que vous souhaitez pour valoriser votre pr&eacute;sence sur le web. Que vous souhaitez cr&eacute;er un blog personnel, une page familiale ou un site commercial en ligne, Nucleus CMS vous permettra de r&eacute;aliser votre projet.<br /><br />Nous avons cr&eacute;&eacute; ce premier billet avec des liens et des informations qui peuvent vous aider &agrave; bien d&eacute;marrer. Quoique vous puissiez supprimer ce billet, il peut rester au bas de cette page sous les contenus que vous ajouterez. Vous pourrez ajouter vos commentaires sur la mani&egrave;re de travailler avec Nucleus CMS, ou marquer cette page pour y revenir quand vous en aurez besoin.');
define('_1ST_POST2',	'<b>Accueil - <a href=\"http://nucleuscms.org/\" title=\"Nucleus CMS home\">nucleuscms.org</a></b><br />Bienvenue dans le monde de Nucleus CMS. En 2001 un ensemble de scripts PHP a &eacute;t&eacute; diffus&eacute; sur l\'Internet ouvert. Ces scripts, qui manipulaient des donn&eacute;es cr&eacute;&eacute;es par les utilisateurs pour cr&eacute;er dynamiquement des pahes HTML, contenaient les id&eacute;es et les algorithmes qui forment aujourd\'hui le c&oelig;ur de Nucleus CMS. Si Nucleus CMS 3.5 est bien plus flexible et puissant que les scripts dont il est issu, il maintient les valeurs qui ont guid&eacute; sa naissance&nbsp;: flexibilit&eacute;, s&eacute;curit&eacute; et programmation &eacute;l&eacute;gante.<br /><br />Gr&acirc;ce &agrave; une communaut&eacute; de d&eacute;veloppeurs et de concepteurs subtils, Nucleus CMS demeure assez facile &agrave; comprendre pour tout le monde, et assez expansible pour permettre de construire &agrave;-peu-pr&egrave;s n\'importe site que vous pourriez imaginer. Nucleus CMS vous autorise &agrave; int&eacute;grer textes, images et commentaires dans un environnement homog&egrave;ne qui rendra votre pr&eacute;sence sur le web aussi pos&eacute;e, professionnelle, personne ou plaisant que vous le souhaitez. Nous esp&eacute;rons que sa puissance vous conviendra.<br /><br /><b>Documentation - <a href=\"http://docs.nucleuscms.org/\" title=\"Nucleus CMS Documentation\">docs.nucleuscms.org</a></b><br />Le processus d\'installation d&eacute;pose des documentations <a href=\"nucleus/documentation/\">utilisateur</a> et a <a href=\"nucleus/documentation/devdocs/\">developpeur</a> sur votre site web. Une <a href=\"/nucleus/documentation/help.html\">aide</a> \'pop-up\' est disponible dans les pages d\'administration pour vous assister dans la maintenance et la personnalisation de votre site. Une fois dans la zone d\'administration de Nucleus CMS cliquez sur le symbole <img src=\"nucleus/documentation/icon-help.gif\" width=\"15\" height=\"15\" alt=\"help icon\" /> pour une aide contextuelle. Vous pouvez aussi consulter cette documentation en ligne &agrave; <a href=\"http://docs.nucleuscms.org/\" title=\"Nucleus CMS Documentation\">docs.nucleuscms.org</a>.<br /><br /><b>Questions fr&eacute;quentes (FAQ) - <a nicetitle=\"Nucleus CMS FAQ\" href=\"http://faq.nucleuscms.org/\">faq.nucleuscms.org</a></b><br />Si vous avez besoin de plus d\'informations sur la gestion, l\'extension ou le d&eacute;pannage de votre site Nucleus, la FAQ Nucleus est le premier endroit pour les trouver. Plus de 170 questions fr&eacute;quentes ont leur r&eacute;ponse gr&acirc;ce &agrave; des utilisateurs exp&eacute;riment&eacute;s de Nucleus.<br /><br /><b>Support - <a href=\"http://forum.nucleuscms.org/\" title=\"Nucleus CMS Support Forum\">forum.nucleuscms.org</a></b><br />Si vous avez besoin d\'assistance, n\'h&eacute;sitez pas &agrave; <a href=\"http://forum.nucleuscms.org/faq.php\">rejoindre</a> les plus de 6.800 utilisateurs enregistr&eacute;s de notre forums. Avec son outil int&eacute;gr&eacute; de recherche dans plus de 73.000 articles, vos r&eacute;ponses sont &agrave; port&eacute;e de clic. N\'oubliez pas&nbsp;: &agrave;-peu-pr&egrave;s toutes les questions que vous vous poserez a d&eacute;j&agrave; une r&eacute;ponse sur nos forums, et &agrave;-peu-pr&egrave;s tout ce que vous souhaitez faire avec Nucleus a d&eacute;j&agrave; &eacute;t&eacute; tent&eacute; et est expliqu&eacute; ici. Assurez-vous de les y trouver. Remember: almost any question you think of has already been asked on the forums, and almost anything you want to do with Nucleus has been tried and explained there. Be sure to check them out.<br /><br /><b>D&eacute;monstration - <a href=\"http://demo.nucleuscms.org/\" title=\"Nucleus CMS Demonstration\">demo.nucleuscms.org</a></b><br />Vous souhaitez essayer, tester les modifications ou montrer Nucleus CMS &agrave; une connaissance&nbsp;? Visitez notre <a href=\"http://demo.nucleuscms.org/\">site d&eacute;mo</a>.<br /><br /><b>\'Skins\' - <a href=\"http://skins.nucleuscms.org/\" title=\"Nucleus CMS Skins\">skins.nucleuscms.org</a></b><br />L\'association de multi-weblogs et \'skins\'/mod&egrave;les offre un couple puissant pour personnaliser votre site ou en concevoir un pour un ami, une connaissance, un client. Importez de nouveaux \'skins\' pour modifier l\'aspect de votre site, ou cr&eacute;ez vos propres \'skins\' et partagez-les avec la communaut&eacute; Nucleus&nbsp;! L\'aide pour cr&eacute;er ou modifier des \'skins\' est &agrave; port&eacute;e de clic sur les forums Nucleus.<br /><br /><b>Plugins - <a href=\"http://plugins.nucleuscms.org/\" title=\"Nucleus plugins\">plugins.nucleuscms.org</a></b><br />Vous souhaitez ajouter des fonctionnalit&eacute;s &agrave; l\'ensemble de base de Nucleus CMS&nbsp;? Notre <a href=\"http://wiki.nucleuscms.org/plugin\">d&eacute;p&ocirc;t de plugins</a> vous propose de nombreuses mani&egrave;res d\'&eacute;tendre et d\'am&eacute;liorer ce que Nucleus CMS peut faire&nbsp;; Votre imagination et votre cr&eacute;ativit&eacute; sont les seules limites quant &agrave; ce que peut faire Nucleus CMS pour vous.<br /><br /><b>D&eacute;veloppement - <a href=\"http://dev.nucleuscms.org/\" title=\"Nucleus Development\">dev.nucleuscms.org</a></b><br />Si vous avez souhaitez plus d\'informations sur le d&eacute;veloppement de Nucleus vous les trouverz dans les documents sur la question &agrave; <a href=\"http://dev.nucleuscms.org/\" title=\"Nucleus Development\">dev.nucleuscms.org</a> ou dans le <a href=\"http://forum.nucleuscms.org/\">Forum du support</a>. Sourceforge.net h&eacute;berge gratuitement notre <a href=\"http://sourceforge.net/projects/nucleuscms/\">Open Source project page</a> qui comprend les t&eacute;l&eacute;chargements de nos logiciels et nos d&eacute;p&ocirc;ts CVS. <br /><br /> <b>Donateurs</b><br /> Nous remercions ces <a href=\"http://nucleuscms.org/donators.php\">aimables personnes</a> pour leur  <a href=\"http://nucleuscms.org/donate.php\">support</a>. <em>Merci &agrave; tous&nbsp;!</em><br /><br /><b>Votez pour Nucleus CMS</b><br /> Vous appr&eacute;ciez Nucleus CMS&nbsp;? Votez pour nous &agrave; <a href=\"http://www.hotscripts.com/Detailed/13368.html?RID=nucleus@demuynck.org\">HotScripts</a> et <a href=\"http://www.opensourcecms.com/index.php?option=content&task=view&id=145\">opensourceCMS</a>.<br /><br /><b>License</b><br /> Parlant de <i>free software</i> (logiciel libre), nous nous r&eacute;f&eacute;rons &agrave; la libert&eacute;, non au prix. Nos <a href=\"http://www.gnu.org/licenses/gpl.html\">General Public Licenses</a> sont con&ccedil;ues pour nous assurer que vous avez toute libert&eacute; de distribuer des copies de nos logiciels libres (et de vous faire r&eacute;mun&eacute;rer pour ce service si vous le souhaitez), que vous pouvez disposer du code source si vous le d&eacute;sirez, que vous pouvez modifier le logiciel ou int&eacute;grer ses &eacute;l&eacute;ments dans de nouveaux logiciels libres&nbsp;; et pour que vous sachiez que vous pouvez faire ces choses.');

define('_CONFIRM_RETRY_SEND_FORM',	'Souhaitez-vous réessayer de soumettre le formulaire?');
