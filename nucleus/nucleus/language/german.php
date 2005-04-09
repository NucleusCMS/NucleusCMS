<?php
// German Nucleus Language File
//
// Author: Dieter Mayer
// Formerly based on translations by: Holger Laschka, Thorsten Bonck, Dieter Mayer
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

define('_LIST_PLUG_SUBS_NEEDUPDATE','Bitte benutzen Sie den \'Update Subscribtion list\'-Taste zum Update der Plugin-Abonnementliste.');
define('_LIST_PLUGS_DEP',			'Plugin(s) erfordert:');

// END changed/added after 3.15

// START changed/added after 3.1 START

// comments list per weblog
define('_COMMENTS_BLOG',			'Alle Kommentare f&uuml;r das Blog');
define('_NOCOMMENTS_BLOG',			'Keine Kommentare zu Themen in diesem Blog vorhanden');
define('_BLOGLIST_COMMENTS',		'Kommentare');
define('_BLOGLIST_TT_COMMENTS',		'Liste aller Kommentaren zu Themen in diesem Blog');


// for use in archivetype-skinvar
define('_ARCHIVETYPE_DAY',			'Tag');
define('_ARCHIVETYPE_MONTH',		'Monat');

// tickets (prevents malicious users to trick an admin to perform actions he doesn't want)
define('_ERROR_BADTICKET',			'Ung&uuml;ltiges oder erloschenes Ticket.');

// plugin dependency
define('_ERROR_INSREQPLUGIN',		'Plugin-Installation misslungen, erfordert ');
define('_ERROR_DELREQPLUGIN',		'L&ouml;schen des Plugins misslungen, ben&ouml;tigt von ');

// cookie prefix
define('_SETTINGS_COOKIEPREFIX',	'Cookie-Pr&auml;fix');

// account activation
define('_ERROR_NOLOGON_NOACTIVATE',	'Kann Aktivierungslink nicht senden. Erlaubnis zum Login verweigert.');
define('_ERROR_ACTIVATE',			'Aktivierungsschl&uuml;ssel nicht vorhanden, ung&uuml;ltig oder abgelaufen.');
define('_ACTIONLOG_ACTIVATIONLINK', 'Aktivierungslink gesendet');
define('_MSG_ACTIVATION_SENT',		'Ein Aktivierungslink wurde per eMail &uuml;bermittelt.');

// activation link emails
define('_ACTIVATE_REGISTER_MAIL',	"Hi <%memberName%>,\n\nSie m&uuml;ssen Ihren Konto auf <%siteName%> (<%siteUrl%>) aktivieren.\nSie k&ouml;nnen dies durch Klick auf den nachstehenden Link erledigen: \n\n\t<%activationUrl%>\n\nSie haben daf&uuml;r zwei Tage. Danach wird dieser Aktivierungslink ung&uuml;ltig.");
define('_ACTIVATE_REGISTER_MAILTITLE',	"Aktivieren Sie Ihren '<%memberName%>'-Konto");
define('_ACTIVATE_REGISTER_TITLE',	'Willkommen, <%memberName%>');
define('_ACTIVATE_REGISTER_TEXT',	'Sie sind fast fertig. Bitte w&auml;hlen Sie ein Passwort f&uuml;