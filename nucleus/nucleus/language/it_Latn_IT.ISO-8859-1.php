<?php
// Italian Nucleus Language File
//
// Author: Antonio Fragola - MrShark (http://www.mrshark.it)
// Previous Author: Roberto Bolli (http://www.rbnet.it)
// Previous Previous Author: Antonio Fragola - MrShark (http://www.mrshark.it)
// Nucleus version: v3.2
//
// Please note: if you want to translate this file to your own language, be aware
// that in a next Nucleus version, new variables might be added and some other ones
// might be deleted. Therefor, it's important to list the Nucleus version for which
// the file was written in your document.
//
// Fully translated language file can be sent to Wouter Demuynck (nucleus@demuynck.org)
// and will be available for download (with proper credit to the author, of course)

// START changed/added after 315 START

define('_LIST_PLUG_SUBS_NEEDUPDATE','Per favore usa il pulsante \'Aggiorna lista di sottoscrizione\' per aggiornare la lista di sottoscrizione dei plugin.');
define('_LIST_PLUGS_DEP',			'I Plugin richiedono:');

// END changed/added after 3.15

// START changed/added after 3.1 START

// comments list per weblog
define('_COMMENTS_BLOG',			'Tutti i commenti di un blog');
define('_NOCOMMENTS_BLOG',			'Nessun commento è stato fatto agli elementi di questo blog');
define('_BLOGLIST_COMMENTS',		'Commenti');
define('_BLOGLIST_TT_COMMENTS',		'Un elenco di tutti i commenti fatti agli elementi di questo blog');


// for use in archivetype-skinvar
define('_ARCHIVETYPE_DAY',			'giorno');
define('_ARCHIVETYPE_MONTH',		'mese');

// tickets (prevents malicious users to trick an admin to perform actions he doesn't want)
define('_ERROR_BADTICKET',			'Biglietto non valido o scaduto.');

// plugin dependency
define('_ERROR_INSREQPLUGIN',		'Installazione del plugin fallita, richiede ');
define('_ERROR_DELREQPLUGIN',		'Cancellazione del plugin fallita, è richiesto da ');

// cookie prefix
define('_SETTINGS_COOKIEPREFIX',	'Prefisso dei Cookie');

// account activation
define('_ERROR_NOLOGON_NOACTIVATE',	'Impossibile inviare il link di attivazione. Non sei autorizzato ad eseguire il login.');
define('_ERROR_ACTIVATE',			'La chiave di attivazione non esiste, non &egrave; valida o &egrave; scaduta.');
define('_ACTIONLOG_ACTIVATIONLINK', 'Link di attivazione inviato');
define('_MSG_ACTIVATION_SENT',		'Un link di attivazione &egrave; stato inviato per e-mail.');

// activation link emails
define('_ACTIVATE_REGISTER_MAIL',	"Ciao <%memberName%>,\n\nHai bisogno di attivare il tuo account su <%siteName%> (<%siteUrl%>).\nPuoi farlo visitando il link seguente: \n\n\t<%activationUrl%>\n\nHai 2 giorni di tempo per farlo. Dopo questo periodo, il link di attivazione non sar&agrave; pi&ugrave; valido.");
define('_ACTIVATE_REGISTER_MAILTITLE',	"Attiva il tuo account '<%memberName%>'");
define('_ACTIVATE_REGISTER_TITLE',	'Benvenuto <%memberName%>');
define('_ACTIVATE_REGISTER_TEXT',	'Ci sei quasi. Per favore scegli una password per il tuo account di seguito.');
define('_ACTIVATE_FORGOT_MAIL',		"Ciao <%memberName%>,\n\nUsando il link seguente, potrai scegliere una nuova password per il tuo account su <%siteName%> (<%siteUrl%>).\n\n\t<%activationUrl%>\n\nHai 2 giorni di tempo per farlo. Dopo questo periodo, il link di attivazione non sar&agrave; pi&ugrave; valido.");
define('_ACTIVATE_FORGOT_MAILTITLE',"Riattiva il tuo account '<%memberName%>'");
define('_ACTIVATE_FORGOT_TITLE',	'Benvenuto <%memberName%>');
define('_ACTIVATE_FORGOT_TEXT',		'Puoi scegliere una nuova password per il tuo account di seguito:');
define('_ACTIVATE_CHANGE_MAIL',		"Ciao <%memberName%>,\n\nDato che il tuo indirizzo e-mail &egrave; cambiato, devi riattivare il tuo account su <%siteName%> (<%siteUrl%>).\nPuoi farlo visitando il link seguente: \n\n\t<%activationUrl%>\n\nHai 2 giorni di tempo per farlo. Dopo questo periodo, il link di attivazione non sar&agrave; pi&ugrave; valido.");
define('_ACTIVATE_CHANGE_MAILTITLE',"Riattiva il tuo account '<%memberName%>'");
define('_ACTIVATE_CHANGE_TITLE',	'Benvenuto <%memberName%>');
define('_ACTIVATE_CHANGE_TEXT',		'Il tuo cambio di indirizzo &egrave; stato verificato. Grazie!');
define('_ACTIVATE_SUCCESS_TITLE',	'Attivazione avvenuta con successo');
define('_ACTIVATE_SUCCESS_TEXT',	'Il tuo account &egrave; stato attivato con successo.');
define('_MEMBERS_SETPWD',			'Imposta Password');
define('_MEMBERS_SETPWD_BTN',		'Imposta Password');
define('_QMENU_ACTIVATE',			'Attivazione account');
define('_QMENU_ACTIVATE_TEXT',		'<p>Dopo che avrai attivato il tuo account, potrai iniziare ad usarlo <a href="index.php?action=showlogin">eseguendo il login</a>.</p>');

define('_PLUGS_BTN_UPDATE',			'Aggiorna la lista di sottoscrizione');

// global settings
define('_SETTINGS_JSTOOLBAR',		'Stile della Barra degli Strumenti Javascript');
define('_SETTINGS_JSTOOLBAR_FULL',	'Barra degli Strumenti Completa (IE)');
define('_SETTINGS_JSTOOLBAR_SIMPLE','Barra degli Strumenti Semplice (Non-IE)');
define('_SETTINGS_JSTOOLBAR_NONE',	'Disabilita la Barra degli Strumenti');
define('_SETTINGS_URLMODE_HELP',	'(Info: <a href="documentation/tips.html#searchengines-fancyurls">Come puoi attivare le URL brevi</a>)');

// extra plugin settings part when editing categories/members/blogs/...
define('_PLUGINS_EXTRA',			'Impostazioni extra per i Plugin');

// itemlist info column keys
define('_LIST_ITEM_BLOG',			'blog:');
define('_LIST_ITEM_CAT',			'cat:');
define('_LIST_ITEM_AUTHOR',			'autore:');
define('_LIST_ITEM_DATE',			'data:');
define('_LIST_ITEM_TIME',			'ora:');

// indication of registered members in comments list
define('_LIST_COMMENTS_MEMBER', 	'(membro)');

// batch operations
define('_BATCH_WITH_SEL',			'Con la selezione:');
define('_BATCH_EXEC',				'Esegui');

// quickmenu
define('_QMENU_HOME',				'Home');
define('_QMENU_ADD',				'Aggiungi articoli');
define('_QMENU_ADD_SELECT',			'-- seleziona --');
define('_QMENU_USER_SETTINGS',		'Impostazioni');
define('_QMENU_USER_ITEMS',			'Articoli');
define('_QMENU_USER_COMMENTS',		'Commenti');
define('_QMENU_MANAGE',				'Gestione');
define('_QMENU_MANAGE_LOG',			'Log Azioni');
define('_QMENU_MANAGE_SETTINGS',	'Impostazioni Globali');
define('_QMENU_MANAGE_MEMBERS',		'Membri');
define('_QMENU_MANAGE_NEWBLOG',		'Nuovo Weblog');
define('_QMENU_MANAGE_BACKUPS',		'Backups');
define('_QMENU_MANAGE_PLUGINS',		'Plugins');
define('_QMENU_LAYOUT',				'Layout');
define('_QMENU_LAYOUT_SKINS',		'Temi');
define('_QMENU_LAYOUT_TEMPL',		'Modelli');
define('_QMENU_LAYOUT_IEXPORT',		'Importa/Esporta');
define('_QMENU_PLUGINS',			'Plugins');

// quickmenu on logon screen
define('_QMENU_INTRO',				'Introduzione');
define('_QMENU_INTRO_TEXT',			'<p>Questa &egrave; la schermata di Login per BLOG:CMS, il sistema di gestione contenuti che &egrave; usato per gestire questo sito web.</p><p>Se hai un account, puoi fare il login e iniziare a inviare nuovi articoli.</p>');

// helppages for plugins
define('_ERROR_PLUGNOHELPFILE',		'Il file di aiuto per questo plugin non pu&ograve; essere trovato');
define('_PLUGS_HELP_TITLE',			'Pagina di aiuto per il plugin');
define('_LIST_PLUGS_HELP', 			'aiuto');


// END changed/started after 3.1

// START changed/added after v2.5beta START

// general settings (security)
define('_SETTINGS_EXTAUTH',			'Abilita l\'Autenticazione Esterna');
define('_WARNING_EXTAUTH',			'Attenzione: Abilitare solo se necessario.');

// member profile
define('_MEMBERS_BYPASS',			'Usa l\'Autenticazione Esterna');

// 'always include in search' blog setting (yes/no) [in v2.5beta, the 'always' part wasn't clear]
define('_EBLOG_SEARCH',				'Includi <em>SEMPRE</em> nella ricerca');

// END changed/added after v2.5beta

// START introduced after v2.0 START

// media library
define('_MEDIA_VIEW',				'visualizza');
define('_MEDIA_VIEW_TT',			'Visualizza il file (apre una nuova finestra)');
define('_MEDIA_FILTER_APPLY',		'Applica filtro');
define('_MEDIA_FILTER_LABEL',		'Filtro: ');
define('_MEDIA_UPLOAD_TO',			'Carica in...');
define('_MEDIA_UPLOAD_NEW',			'Carica un nuovo file...');
define('_MEDIA_COLLECTION_SELECT',	'Seleziona');
define('_MEDIA_COLLECTION_TT',		'Passa a questa categoria');
define('_MEDIA_COLLECTION_LABEL',	'Collezione corrente: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'Allinea a sinistra');
define('_ADD_ALIGNRIGHT_TT',		'Allinea a destra');
define('_ADD_ALIGNCENTER_TT',		'Centra');


// generic upload failure
define('_ERROR_UPLOADFAILED',		'Caricamento fallito');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'Permetti l\'invio di articoli nel passato');
define('_ADD_CHANGEDATE',			'Aggiorna il timestamp');
define('_BMLET_CHANGEDATE',			'Aggiorna il timestamp');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'Importa/esporta temi...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Normale');
define('_PARSER_INCMODE_SKINDIR',	'Usa la directory dei temi');
define('_SKIN_INCLUDE_MODE',		'Modo inclusione');
define('_SKIN_INCLUDE_PREFIX',		'Prefisso inclusione');

// global settings
define('_SETTINGS_BASESKIN',		'Tema di base');
define('_SETTINGS_SKINSURL',		'URL dei temi');
define('_SETTINGS_ACTIONSURL',		'URL completa al file action.php');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'Non posso spostare la categoria di default');
define('_ERROR_MOVETOSELF',			'Non posso spostare la categoria (il blog di destinazione coincide con quello di partenza)');
define('_MOVECAT_TITLE',			'Seleziona il blog dove spostare la categoria selezionata');
define('_MOVECAT_BTN',				'Sposta la Categoria');

// URLMode setting
define('_SETTINGS_URLMODE',			'Modo URL');
define('_SETTINGS_URLMODE_NORMAL',	'Normale');
define('_SETTINGS_URLMODE_PATHINFO','Fancy');

// Batch operations
define('_BATCH_NOSELECTION',		'Non &egrave; stato selezionato nulla su cui eseguire le azioni richieste');
define('_BATCH_ITEMS',				'Operazione automatiche sugli articoli');
define('_BATCH_CATEGORIES',			'Operazioni automatiche sulle categorie');
define('_BATCH_MEMBERS',			'Operazioni automatiche sui membri');
define('_BATCH_TEAM',				'Operazioni automatiche sui membri del gruppo');
define('_BATCH_COMMENTS',			'Operazioni automatiche sui commenti');
define('_BATCH_UNKNOWN',			'Operazione automatica sconosciuta: ');
define('_BATCH_EXECUTING',			'Esecuzione dell\'operazione di');
define('_BATCH_ONCATEGORY',			'sulla categoria');
define('_BATCH_ONITEM',				'sull\'articolo');
define('_BATCH_ONCOMMENT',			'sul commento');
define('_BATCH_ONMEMBER',			'sull\'utente');
define('_BATCH_ONTEAM',				'sul ');
define('_BATCH_SUCCESS',			' Operazione effettuata con successo!');
define('_BATCH_DONE',				'Fatto!');
define('_BATCH_DELETE_CONFIRM',		'Conferma l\'operazione di eliminazione');
define('_BATCH_DELETE_CONFIRM_BTN',	'Conferma operazione eliminazione');
define('_BATCH_SELECTALL',			'seleziona tutti');
define('_BATCH_DESELECTALL',		'deseleziona tutti');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'Cancella');
define('_BATCH_ITEM_MOVE',			'Sposta');
define('_BATCH_MEMBER_DELETE',		'Cancella');
define('_BATCH_MEMBER_SET_ADM',		'Dai i permessi di amministrazione');
define('_BATCH_MEMBER_UNSET_ADM',	'Togli i permessi di amministrazione');
define('_BATCH_TEAM_DELETE',		'Cancellalo dal gruppo');
define('_BATCH_TEAM_SET_ADM',		'Dai i permessi di amministrazione');
define('_BATCH_TEAM_UNSET_ADM',		'Togli i privilegi di amministrazione');
define('_BATCH_CAT_DELETE',			'Cancella');
define('_BATCH_CAT_MOVE',			'Spostalo in un altro blog');
define('_BATCH_COMMENT_DELETE',		'Cancella');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'Aggiungi un nuovo articolo...');
define('_ADD_PLUGIN_EXTRAS',		'Moduli aggiuntivi - Opzioni extra ');

// errors
define('_ERROR_CATCREATEFAIL',		'Non posso creare una nuova categoria');
define('_ERROR_NUCLEUSVERSIONREQ',	'Questo modulo aggiuntivo richiede una versione di Nucleus pi&ugrave; recente: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Torna alle impostazioni del blog');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Importa');
define('_SKINIE_TITLE_EXPORT',		'Esporta');
define('_SKINIE_BTN_IMPORT',		'Importa');
define('_SKINIE_BTN_EXPORT',		'Esporta i temi o i modelli selezionati');
define('_SKINIE_LOCAL',				'Importa da un file locale:');
define('_SKINIE_NOCANDIDATES',		'Nessuna tema da importare &egrave; stato individuato nella directory dei temi');
define('_SKINIE_FROMURL',			'Importa dall\'URL:');
define('_SKINIE_EXPORT_INTRO',		'Seleziona i temi ed i modelli che vuoi esportare dalla lista che segue');
define('_SKINIE_EXPORT_SKINS',		'Temi');
define('_SKINIE_EXPORT_TEMPLATES',	'Modelli');
define('_SKINIE_EXPORT_EXTRA',		'Informazioni aggiuntive');
define('_SKINIE_CONFIRM_OVERWRITE',	'Sovrascrivi i temi esistenti (see nameclashes)');
define('_SKINIE_CONFIRM_IMPORT',	'Si, voglio importarlo');
define('_SKINIE_CONFIRM_TITLE',		'Sull\'importazioni di temi e modelli');
define('_SKINIE_INFO_SKINS',		'File del tema:');
define('_SKINIE_INFO_TEMPLATES',	'File del modello:');
define('_SKINIE_INFO_GENERAL',		'Informazioni:');
define('_SKINIE_INFO_SKINCLASH',	'Collisioni nomi dei temi:');
define('_SKINIE_INFO_TEMPLCLASH',	'Collisioni nomi dei modelli:');
define('_SKINIE_INFO_IMPORTEDSKINS','Temi importati:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Modelli importati:');
define('_SKINIE_DONE',				'Importazione effettuata');

define('_AND',						'e');
define('_OR',						'o');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'campo vuoto (clicca per modificare)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'Modo inclusione:');
define('_LIST_SKINS_INCPREFIX',		'Prefisso inclusione:');
define('_LIST_SKINS_DEFINED',		'Parti definite:');

// backup
define('_BACKUPS_TITLE',			'Salva / Ripristina');
define('_BACKUP_TITLE',				'Salvataggio');
define('_BACKUP_INTRO',				'Clicca sul pulsante qui sotto per eseguire un salvataggio (backup) del database di Nucleus. Ti verr&agrave; richiesto di salvare un file contenente il backup: scegli di conservare tale file in un posto sicuro.');
define('_BACKUP_ZIP_YES',			'Prova ad utilizzare la compressione dei dati');
define('_BACKUP_ZIP_NO',			'Non utilizzare la compressione dei dati');
define('_BACKUP_BTN',				'Crea il backup');
define('_BACKUP_NOTE',				'<b>Nota:</b> solo il contenuto del database verr&agrave; salvato nel backup. Tutti gli altri file, comprese le impostazioni presenti nel file config.php, <b>NON</b> verranno incluse nel salvataggio.');
define('_RESTORE_TITLE',			'Ripristina');
define('_RESTORE_NOTE',				'<b>ATTENZIONE:</b> il ripristino del database da una copia di backup  <b>CANCELLERA\'</b> tutto il contenuto corrente del database di Nucleus! Esegui questa operazione solo se sei veramente sicuro di ci&ograve; che stai facendo!	<br />	<b>Nota:</b> la versione di Nucleus da cui hai creato il file di backup deve essere identica alla versione che stai utilizzando in questo momento! Il ripristino dei dati tra versioni differenti di Nucleus non &egrave; assicurato.');
define('_RESTORE_INTRO',			'Seleziona il file contenente il backup: il file selezionato verr&agrave; caricato sul server. Clicca sul pulsante &quot;Ripristina&quot; per eseguire il recupero dei dati.');
define('_RESTORE_IMSURE',			'Si, sono sicuro! Voglio procedere con il ripristino dei dati.');
define('_RESTORE_BTN',				'Ripristina');
define('_RESTORE_WARNING',			'(assicurati di selezionare il backup corretto; &egrave; consigliato effettuare un nuovo backup prima di procedere con il ripristino di un precedente salvataggio)');
define('_ERROR_BACKUP_NOTSURE',		'Devi spuntare la casellina \'Si, sono sicuro\' per poter procedere con il ripristino dei dati');
define('_RESTORE_COMPLETE',			'Ripristino dati completato');

// new item notification
define('_NOTIFY_NI_MSG',			'E\' stato inserito un nuovo articolo:');
define('_NOTIFY_NI_TITLE',			'nuovo Articolo!');
define('_NOTIFY_KV_MSG',			'Voto karma sull\'articolo:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'Comment per sull\'articolo:');
define('_NOTIFY_NC_TITLE',			'Commento Nucleus:');
define('_NOTIFY_USERID',			'ID Utente:');
define('_NOTIFY_USER',				'Utente:');
define('_NOTIFY_COMMENT',			'Commento:');
define('_NOTIFY_VOTE',				'Vota:');
define('_NOTIFY_HOST',				'Host:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'Membro:');
define('_NOTIFY_TITLE',				'Titolo:');
define('_NOTIFY_CONTENTS',			'Contenuti:');

// member mail message
define('_MMAIL_MSG',				'Ti &egrave; stato inviato un messaggio da');
define('_MMAIL_FROMANON',			'un visitatore anonimo');
define('_MMAIL_FROMNUC',			'il messaggio ti &egrave; stato inviato utilizzando i servizi di nucleus utilizzato dal sito ');
define('_MMAIL_TITLE',				'Un messaggio da');
define('_MMAIL_MAIL',				'Messaggio:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'Aggiungi un articolo');
define('_BMLET_EDIT',				'Modifica un articolo');
define('_BMLET_DELETE',				'Cancella un articolo');
define('_BMLET_BODY',				'Corpo');
define('_BMLET_MORE',				'Corpo (esteso)');
define('_BMLET_OPTIONS',			'Opzioni');
define('_BMLET_PREVIEW',			'Anteprima');

// used in bookmarklet
define('_ITEM_UPDATED',				'L\'articolo &egrave; stato aggiornato');
define('_ITEM_DELETED',				'L\'articolo &egrave; stato cancellato');

// plugins
define('_CONFIRMTXT_PLUGIN',		'Sei sicuro di volere eliminare il modulo aggiuntivo chiamato');
define('_ERROR_NOSUCHPLUGIN',		'Modulo aggiuntivo inesistente');
define('_ERROR_DUPPLUGIN',			'Questo modulo aggiuntivo &egrave; gi&agrave; stato installato');
define('_ERROR_PLUGFILEERROR',		'Modulo aggiuntivo inesistente, o permessi impostati non correttamente');
define('_PLUGS_NOCANDIDATES',		'Non &egrave; stato trovato alcun modulo aggiuntivo');

define('_PLUGS_TITLE_MANAGE',		'Gestisci i moduli aggiuntivi');
define('_PLUGS_TITLE_INSTALLED',	'Moduli attualmente installati');
define('_PLUGS_TITLE_UPDATE',		'Aggiorna elenco sottoscrittori');
define('_PLUGS_TEXT_UPDATE',		'Nucleus mantiene una cache degli eventi sottoscritti dai moduli aggiuntivi. Quando aggiorni un modulo aggiuntivo sovrascrivendone il file, devi eseguire questa opzione per essere sicuro che vengano aggiornate le sottoscrizioni corrette');
define('_PLUGS_TITLE_NEW',			'Installa un nuovo modulo aggiuntivo');
define('_PLUGS_ADD_TEXT',			'Qui sotto sono elencati tutti i file contenuti nella directory dei moduli aggiuntivi. Dovrebbero essere elencati solo i moduli non ancora installati. Prima di procedere con l\'installazione di uno qualsiasi dei file elencati accertati che lo stesso sia <strong>sicuramente</strong> un modulo aggiuntivo valido.');
define('_PLUGS_BTN_INSTALL',		'Installa');
define('_BACKTOOVERVIEW',			'Torna alla pagina principale dei moduli aggiuntivi');

// editlink
define('_TEMPLATE_EDITLINK',		'Link per la modifica dell\'articolo');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'Aggiungi un riquadro laterale a sinistra');
define('_ADD_RIGHT_TT',				'Aggiungi un riquadro laterale a destra');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'Nuova categoria...');

// new settings
define('_SETTINGS_PLUGINURL',		'URL moduli aggiuntivi');
define('_SETTINGS_MAXUPLOADSIZE',	'Max. grandezza file caricabili (in byte)');
define('_SETTINGS_NONMEMBERMSGS',	'Abilita gli utenti non registrati ad inviare messaggi');
define('_SETTINGS_PROTECTMEMNAMES',	'Proteggi i nomi degli utenti registrati');

// overview screen
define('_OVERVIEW_PLUGINS',			'Gestisci i moduli aggiuntivi...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'Registrazione nuovo membro:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'Il tuo indirizzo email:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'Non hai diritti di amministrazione su nessuno dei blog che hanno il membro di destinazione nel loro gruppo. Per questo motivo non sei abilitato a caricare file nella directory media di questi mebri.');

// plugin list
define('_LISTS_INFO',				'Informazioni');
define('_LIST_PLUGS_AUTHOR',		'Da:');
define('_LIST_PLUGS_VER',			'Versione:');
define('_LIST_PLUGS_SITE',			'Visita il sito');
define('_LIST_PLUGS_DESC',			'Descrizione:');
define('_LIST_PLUGS_SUBS',			'Sottoscrive i seguenti eventi:');
define('_LIST_PLUGS_UP',			'sposta sopra');
define('_LIST_PLUGS_DOWN',			'sposta sotto');
define('_LIST_PLUGS_UNINSTALL',		'disinstalla');
define('_LIST_PLUGS_ADMIN',			'amministra');
define('_LIST_PLUGS_OPTIONS',		'modifica&nbsp;opzioni');

// plugin option list
define('_LISTS_VALUE',				'Valore');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'questo modulo non ha alcuna opzione impostata');
define('_PLUGS_BACK',				'Torna alla pagina principale dei moduli aggiuntivi');
define('_PLUGS_SAVE',				'Salva le opzioni');
define('_PLUGS_OPTIONS_UPDATED',	'Opzioni del modulo aggiuntivo modificate');

define('_OVERVIEW_MANAGEMENT',		'Amministrazione');
define('_OVERVIEW_MANAGE',			'Amministrazione Nucleus...');
define('_MANAGE_GENERAL',			'Gestione Generale');
define('_MANAGE_SKINS',				'Temi e Modelli');
define('_MANAGE_EXTRA',				'Caratteristiche aggiuntive');

define('_BACKTOMANAGE',				'Torna all\'amministrazione di Nucleus');


// END introduced after v1.1 END




// charset to use
define('_CHARSET',					'iso-8859-1');

// global stuff
define('_LOGOUT',					'Disconnettiti');
define('_LOGIN',					'Connettiti');
define('_YES',						'Si');
define('_NO',						'No');
define('_SUBMIT',					'Invia');
define('_ERROR',					'Errore');
define('_ERRORMSG',					'Si &egrave; verificato un errore!');
define('_BACK',						'Go Back');
define('_NOTLOGGEDIN',				'Non sei collegato');
define('_LOGGEDINAS',				'Sei collegato come');
define('_ADMINHOME',				'Home Page Amministrativa');
define('_NAME',						'Nome');
define('_BACKHOME',					'Torna alla pagina di amministrazione');
define('_BADACTION',				'E\' stato richiesto di eseguire un\'azione non esistente');
define('_MESSAGE',					'Messaggio');
define('_HELP_TT',					'Aiuto!');
define('_YOURSITE',					'Il tuo sito');


define('_POPUP_CLOSE',				'Chiudi la finestra');

define('_LOGIN_PLEASE',				'Connettiti per poter utilizzare quest\'opzione');

// commentform
define('_COMMENTFORM_YOUARE',		'Sei collegato come');
define('_COMMENTFORM_SUBMIT',		'Aggiungi un commento');
define('_COMMENTFORM_COMMENT',		'Il tuo commento');
define('_COMMENTFORM_NAME',			'Nome');
define('_COMMENTFORM_MAIL',			'E-mail/HTTP');
define('_COMMENTFORM_REMEMBER',		'Ricordami');

// loginform
define('_LOGINFORM_NAME',			'Nome utente');
define('_LOGINFORM_PWD',			'Password');
define('_LOGINFORM_YOUARE',			'Collegato come');
define('_LOGINFORM_SHARED',			'Computer condiviso');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'Invia messaggio');

// search form
define('_SEARCHFORM_SUBMIT',		'Cerca');

// add item form
define('_ADD_ADDTO',				'Aggiungi un nuovo articolo in');
define('_ADD_CREATENEW',			'Crea un nuovo articolo');
define('_ADD_BODY',					'Corpo');
define('_ADD_TITLE',				'Titolo');
define('_ADD_MORE',					'Corpo esteso (opzionale)');
define('_ADD_CATEGORY',				'Categoria');
define('_ADD_PREVIEW',				'Anteprima');
define('_ADD_DISABLE_COMMENTS',		'Disabilitare i commenti?');
define('_ADD_DRAFTNFUTURE',			'Bozza &amp; articoli futuri');
define('_ADD_ADDITEM',				'Aggiungi un articolo');
define('_ADD_ADDNOW',				'Aggiungi ora');
define('_ADD_ADDLATER',				'Aggiungi dopo');
define('_ADD_PLACE_ON',				'Place on');
define('_ADD_ADDDRAFT',				'Aggiungi alle bozze');
define('_ADD_NOPASTDATES',			'(date ed orari passati NON sono validi, in tal caso verr&agrave; automaticamente aggiunta la data attuale)');
define('_ADD_BOLD_TT',				'Grassetto');
define('_ADD_ITALIC_TT',			'Inclinato');
define('_ADD_HREF_TT',				'Crea un link');
define('_ADD_MEDIA_TT',				'Aggiungi elemento media');
define('_ADD_PREVIEW_TT',			'Mostra/nascondi anteprima');
define('_ADD_CUT_TT',				'Taglia');
define('_ADD_COPY_TT',				'Copia');
define('_ADD_PASTE_TT',				'Incolla');


// edit item form
define('_EDIT_ITEM',				'Modifica un articolo');
define('_EDIT_SUBMIT',				'Modifica articolo');
define('_EDIT_ORIG_AUTHOR',			'Autore originale');
define('_EDIT_BACKTODRAFTS',		'Rimetti nelle bozze');
define('_EDIT_COMMENTSNOTE',		'(nota: disabilitare i commenti non canceller&agrave;/nasconder&agrave; i commenti precedentemente inseriti)');

// used on delete screens
define('_DELETE_CONFIRM',			'Conferma la cancellazione');
define('_DELETE_CONFIRM_BTN',		'Conferma cancellazione');
define('_CONFIRMTXT_ITEM',			'Stai per eliminare il seguente articolo:');
define('_CONFIRMTXT_COMMENT',		'Stai per eliminare il seguente commento:');
define('_CONFIRMTXT_TEAM1',			'Stai per cancellare ');
define('_CONFIRMTXT_TEAM2',			' dal gruppo membri del blog ');
define('_CONFIRMTXT_BLOG',			'Il blog che stai per eliminare &egrave;: ');
define('_WARNINGTXT_BLOGDEL',		'Attenzione! L\'eliminazione di un blog porter&agrave; alla cancellazione di TUTTI gli articoli ed i commenti del blog. Per maggiore sicurezza sei pregato di confermare l\'azione di cancellazione.!<br />Non interrompere Nucleus mentre effettuer&agrave; l\'eliminazione del blog.');
define('_CONFIRMTXT_MEMBER',		'Stai per cancellare il seguente utente: ');
define('_CONFIRMTXT_TEMPLATE',		'Stai per cancellare il modello chiamato ');
define('_CONFIRMTXT_SKIN',			'Stai per cancellare il tema chiamato ');
define('_CONFIRMTXT_BAN',			'Stai per cancellare il ban per il seguente range di IP');
define('_CONFIRMTXT_CATEGORY',		'Stai per cancellare la categoria ');

// some status messages
define('_DELETED_ITEM',				'Articolo cancellato');
define('_DELETED_MEMBER',			'Utente cancellato');
define('_DELETED_COMMENT',			'Commento cancellato');
define('_DELETED_BLOG',				'Blog eliminato');
define('_DELETED_CATEGORY',			'Categoria cancellata');
define('_ITEM_MOVED',				'Articolo spostato');
define('_ITEM_ADDED',				'Articolo aggiunto');
define('_COMMENT_UPDATED',			'Commento aggiornato');
define('_SKIN_UPDATED',				'le modifiche effettuate al tema sono state salvate');
define('_TEMPLATE_UPDATED',			'le modifiche effettuate al modello sono state salvate');

// errors
define('_ERROR_COMMENT_LONGWORD',	'Non utilizzare parole pi&ugrave; lunghe di 90 caratteri nei commenti');
define('_ERROR_COMMENT_NOCOMMENT',	'Inserisci un commento');
define('_ERROR_COMMENT_NOUSERNAME',	'Nome utente non valido');
define('_ERROR_COMMENT_TOOLONG',	'Il commento inserito &egrave; troppo lungo (max. 5000 caratteri)');
define('_ERROR_COMMENTS_DISABLED',	'I commenti per questo blog sono attualmente disabilitati.');
define('_ERROR_COMMENTS_NONPUBLIC',	'Devi essere collegato come memro per poter aggiungere commenti in questo blog');
define('_ERROR_COMMENTS_MEMBERNICK','Il nome che hai scelto di utilizzare per pubblicare i tuoi commenti &egrave; gi&agrave; usato da un membro del blog. Scegli un nome diverso.');
define('_ERROR_SKIN',				'Errore Skin');
define('_ERROR_ITEMCLOSED',			'Questo articolo &egrave; stato chiuso, non &egrave; possibile aggiungervi commenti/voti');
define('_ERROR_NOSUCHITEM',			'Articolo inesistente');
define('_ERROR_NOSUCHBLOG',			'Blog inesistente');
define('_ERROR_NOSUCHSKIN',			'Tema inesistente');
define('_ERROR_NOSUCHMEMBER',		'membro inesistente');
define('_ERROR_NOTONTEAM',			'Non sei nel gruppo membri di questo blog.');
define('_ERROR_BADDESTBLOG',		'Il blog di destinazione non esiste');
define('_ERROR_NOTONDESTTEAM',		'Articolo impossibile da spostare in quanto non sei nel gruppo membri del blog di destinazione');
define('_ERROR_NOEMPTYITEMS',		'Impossibile aggiungere articoli vuoti!');
define('_ERROR_BADMAILADDRESS',		'Indirizzo email non valido');
define('_ERROR_BADNOTIFY',			'Uno o pi&ugrave; degli indirizzi di notifica forniti non &egrave; un indirizzo email valido');
define('_ERROR_BADNAME',			'Nome non valido (sono permessi solo caratteri a-z e 0-9 e niente spazi iniziali/finali)');
define('_ERROR_NICKNAMEINUSE',		'Un altro membro sta gi &agrave; utilizzando il nickname che hai scelto');
define('_ERROR_PASSWORDMISMATCH',	'Le due password devono coincidere');
define('_ERROR_PASSWORDTOOSHORT',	'La password deve essere lunga ameno 6 caratteri');
define('_ERROR_PASSWORDMISSING',	'Il campo della password non pu&ograve; essere lasciato vuoto');
define('_ERROR_REALNAMEMISSING',	'Devi inserire un nome reale');
define('_ERROR_ATLEASTONEADMIN',	'Deve sempre esistere almeno un utente super-amministratore che possa connettersi all\'area di amministrazione.');
define('_ERROR_ATLEASTONEBLOGADMIN','Eseguendo questa azione potresti rendere il tuo weblog inutilizzabile. Assicurati che ci sia sempre almeno un utente amministratore del blog.');
define('_ERROR_ALREADYONTEAM',		'Non &egrave; possibile aggiungere un membro che &egrave; gi&agrave; parte del gruppo');
define('_ERROR_BADSHORTBLOGNAME',	'Il nome breve del blog pu&ograve; contenere solo caratteri a-z e 0-9, senza spazi');
define('_ERROR_DUPSHORTBLOGNAME',	'Il nome-breve scelto &egrave; gi&agrave; utilizzato da un altro blog. Questi nomi devono essere univoci');
define('_ERROR_UPDATEFILE',			'Cannot get write access to the update-file. Make sure the file permissions are set ok (try chmodding it to 666). Also note that the location is relative to the admin-area directory, so you might want to use an absolute path (something like /your/path/to/nucleus/)');
define('_ERROR_DELDEFBLOG',			'E\' Impossibile cancellare il blog di default');
define('_ERROR_DELETEMEMBER',		'questo membro on pu&ograve; essere cancellato, probabilmente perch&eacute; &egrave; autore articoli o commenti');
define('_ERROR_BADTEMPLATENAME',	'Il nome scelto per il modello non &egrave; valido, utilizza solo caratteri a-z e 0-9 e niente spazi iniziali/finali');
define('_ERROR_DUPTEMPLATENAME',	'Gi&agrave; esiste un altro modello con questo nome');
define('_ERROR_BADSKINNAME',		'Il nome scelto per il tema non &egrave; valido (sono permessi solo caratteri a-z e 0-9 e niente spazi iniziali/finali)');
define('_ERROR_DUPSKINNAME',		'Gi&agrave; esiste un altro tema con questo nome');
define('_ERROR_DEFAULTSKIN',		'Deve sempre esistere un tema chiamato &quot;default&quot;');
define('_ERROR_SKINDEFDELETE',		'Impossibile eliminare il tema selezionao poich&eacute; &egrave; il tema di default del seguente weblog: ');
define('_ERROR_DISALLOWED',			'Non hai le abilitazioni necessarie per effettuare questa azione');
define('_ERROR_DELETEBAN',			'Si &egrave; verificato un errore durante l\'eliminazione del ban (ban inesistente)');
define('_ERROR_ADDBAN',				'Si &egrave; verificato un errore durante l\'aggiunta di un nuovo ban. Il ban potrebbe NON essere stato correttamente aggiunto in tutti i tuoi blog.');
define('_ERROR_BADACTION',			'L\'azione richiesta non esiste');
define('_ERROR_MEMBERMAILDISABLED',	'L\'invio di email tra membri &egrave; disabilitato');
define('_ERROR_MEMBERCREATEDISABLED','La creazione di nuovi account utente &egrave; disabilitata');
define('_ERROR_INCORRECTEMAIL',		'indirizzo email non corretto');
define('_ERROR_VOTEDBEFORE',		'Hai gi&agrave; espresso il tuo voto per questo articolo');
define('_ERROR_BANNED1',			'Non posso eseguire l\'azione richiesta in quanto il tuo indirizzo IP (intervallo ip ');
define('_ERROR_BANNED2',			') risulta bannato. Il messaggio &egrave;: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'Devi essere collegato al blog per effettuare questa azione');
define('_ERROR_CONNECT',			'Errore di connessione');
define('_ERROR_FILE_TOO_BIG',		'Il file &egrave; troppo grande!');
define('_ERROR_BADFILETYPE',		'Il caricamento di questo tipo di file non &egrave; permesso');
define('_ERROR_BADREQUEST',			'Richiesta di caricamento errata');
define('_ERROR_DISALLOWEDUPLOAD',	'Non sei presente in nessuno dei gruppi del blog, per questo motivo non puoi caricare file');
define('_ERROR_BADPERMISSIONS',		'I permessi per il file/la directry non sono stati impostati correttamente');
define('_ERROR_UPLOADMOVEP',		'Si &egrave; verificato un errore durante lo spostamento del file');
define('_ERROR_UPLOADCOPY',			'Si &egrave; verificato un errore durante la copia del file');
define('_ERROR_UPLOADDUPLICATE',	'E\' gi&agrave; present eun altro file con questo nome. Prova a rinominare il file prima di caricarlo.');
define('_ERROR_LOGINDISALLOWED',	'Non sei ablitato all\'accesso all\'area amministrativa del blog. Puoi connetterti come altro utente');
define('_ERROR_DBCONNECT',			'Non &egrave; possibile connettersi al server mySQL');
define('_ERROR_DBSELECT',			'Non &egrave; possibile selezionare il database di Nucleus.');
define('_ERROR_NOSUCHLANGUAGE',		'Il file della lingua non esiste');
define('_ERROR_NOSUCHCATEGORY',		'La categoria non esiste');
define('_ERROR_DELETELASTCATEGORY',	'Ci deve essere almeno una categoria');
define('_ERROR_DELETEDEFCATEGORY',	'Non puoi cancellare la categoria di default');
define('_ERROR_BADCATEGORYNAME',	'Nome della categoria non valido');
define('_ERROR_DUPCATEGORYNAME',	'Una categoria con questo nome &egrave; gi&agrave; presente');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'Attenzione: il valore inserito non &egrave; una directory!');
define('_WARNING_NOTREADABLE',		'Attenzione: il valore inserito &egrave; una directory non leggibile dal webserver!');
define('_WARNING_NOTWRITABLE',		'Attenzione: il valore inserito NON &egrave; una directory scrivibile dal webserver!');

// media and upload
define('_MEDIA_UPLOADLINK',			'Carica un nuovo file');
define('_MEDIA_MODIFIED',			'modificato');
define('_MEDIA_FILENAME',			'nome file');
define('_MEDIA_DIMENSIONS',			'dimensioni');
define('_MEDIA_INLINE',				'Inline');
define('_MEDIA_POPUP',				'Popup');
define('_UPLOAD_TITLE',				'Seleziona il file');
define('_UPLOAD_MSG',				'Seleziona il file che vuoi caricare e fai clic sul pulsante \'Carica\'.');
define('_UPLOAD_BUTTON',			'Carica');

// some status messages
//define('_MSG_ACCOUNTCREATED',		'\'account &egrave; stato creato, la password ti verr&agrave; spedita via email');
//define('_MSG_PASSWORDSENT',			'La password &egrave; stata spedita per email.');
define('_MSG_LOGINAGAIN',			'Devi effettuare nuovamente la connessione poch&eacute; le tue impostazioni sono state modificate');
define('_MSG_SETTINGSCHANGED',		'Impostazioni Modificate');
define('_MSG_ADMINCHANGED',			'Amministratore Modificato');
define('_MSG_NEWBLOG',				'Il nuovo blog &egrave; stato creato');
define('_MSG_ACTIONLOGCLEARED',		'Il log delle azioni &egrave; stato azzerato');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'Azione disabilitata: ');
define('_ACTIONLOG_PWDREMINDERSENT','Una nuova password &egrave; stata inviata per ');
define('_ACTIONLOG_TITLE',			'Log delle azioni');
define('_ACTIONLOG_CLEAR_TITLE',	'Azzera il log delle azioni');
define('_ACTIONLOG_CLEAR_TEXT',		'Azzera il log delle azioni ora!');

// team management
define('_TEAM_TITLE',				'Gestisci i gruppi dei blog ');
define('_TEAM_CURRENT',				'Gruppo attuale');
define('_TEAM_ADDNEW',				'Aggiungi un nuovo membro al gruppo');
define('_TEAM_CHOOSEMEMBER',		'Scegli un membro');
define('_TEAM_ADMIN',				'Privilegi di amministrazione? ');
define('_TEAM_ADD',					'Aggiungi al gruppo');
define('_TEAM_ADD_BTN',				'Aggiungi al gruppo');

// blogsettings
define('_EBLOG_TITLE',				'Modifica le Impostazioni del Blog');
define('_EBLOG_TEAM_TITLE',			'modifica gruppo');
define('_EBLOG_TEAM_TEXT',			'Clicca qui per modificare il tuo gruppo...');
define('_EBLOG_SETTINGS_TITLE',		'Impostazioni blog');
define('_EBLOG_NAME',				'Nome blog');
define('_EBLOG_SHORTNAME',			'Nome blog (breve)');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(deve contenere solo caratteri a-z senza spazi)');
define('_EBLOG_DESC',				'Descrizione blog');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'Tema di default');
define('_EBLOG_DEFCAT',				'Categoria di default');
define('_EBLOG_LINEBREAKS',			'Converti gli &quot;a capo&quot;');
define('_EBLOG_DISABLECOMMENTS',	'Commenti abilitati?<br /><small>(Non sar&agrave; possibile inserire commenti agli articoli con questa opzione disabilitata.)</small>');
define('_EBLOG_ANONYMOUS',			'Abilitare i non-iscritti a scrivere commenti?');
define('_EBLOG_NOTIFY',				'Indirizzo\i per la notifica (usa ; come separatore)');
define('_EBLOG_NOTIFY_ON',			'Notifica i seguenti eventi');
define('_EBLOG_NOTIFY_COMMENT',		'Nuovi commenti');
define('_EBLOG_NOTIFY_KARMA',		'Nuovi voti karma');
define('_EBLOG_NOTIFY_ITEM',		'Nuovi articoli');
define('_EBLOG_PING',				'Inviare un ping a Weblogs.com dopo un aggiornamento?');
define('_EBLOG_MAXCOMMENTS',		'Max numero di commenti');
define('_EBLOG_UPDATE',				'Update file');
define('_EBLOG_OFFSET',				'Compensazione orario');
define('_EBLOG_STIME',				'L\'ora attuale del server &egrave;');
define('_EBLOG_BTIME',				'L\'ora attuale del blog &egrave;');
define('_EBLOG_CHANGE',				'Modifica le impostazioni');
define('_EBLOG_CHANGE_BTN',			'Modifica impostazioni');
define('_EBLOG_ADMIN',				'Amministratore blog');
define('_EBLOG_ADMIN_MSG',			'Ti verranno assegnati privilegi di amministrazione');
define('_EBLOG_CREATE_TITLE',		'Crea un nuovo weblog');
define('_EBLOG_CREATE_TEXT',		'Per creare un nuovo weblog compila il modulo riportato qui sotto. <br /><br /> <b>Nota:</b> sono presenti solo le opzioni necessarie alla creazione di un nuovo weblog. Se vuoi impostare opzioni aggiuntive, utilizza la pagina delle impostazioni del blog dopo la sua creazioni.');
define('_EBLOG_CREATE',				'Crea il nuovo weblog!');
define('_EBLOG_CREATE_BTN',			'Crea weblog');
define('_EBLOG_CAT_TITLE',			'Categorie');
define('_EBLOG_CAT_NAME',			'Nome categoria');
define('_EBLOG_CAT_DESC',			'Descrizione categoria');
define('_EBLOG_CAT_CREATE',			'Crea una nuova categoria');
define('_EBLOG_CAT_UPDATE',			'Aggiorna la categoria');
define('_EBLOG_CAT_UPDATE_BTN',		'Aggiorna categoria');

// templates
define('_TEMPLATE_TITLE',			'Modifica i modelli');
define('_TEMPLATE_AVAILABLE_TITLE',	'Modelli disponibili');
define('_TEMPLATE_NEW_TITLE',		'Nuovo modello');
define('_TEMPLATE_NAME',			'Nome del modello');
define('_TEMPLATE_DESC',			'Descrizione del modello');
define('_TEMPLATE_CREATE',			'Crea un modello');
define('_TEMPLATE_CREATE_BTN',		'Crea modello');
define('_TEMPLATE_EDIT_TITLE',		'Modifica il modello');
define('_TEMPLATE_BACK',			'Torna alla pagina principale della gestione dei modelli');
define('_TEMPLATE_EDIT_MSG',		'Non tutte le parti del modello sono necessarie al suo corretto funzionamento; lascia vuote quelle che non intendi utilizzare.');
define('_TEMPLATE_SETTINGS',		'Impostazioni del modello');
define('_TEMPLATE_ITEMS',			'Articoli');
define('_TEMPLATE_ITEMHEADER',		'Intestazione articolo');
define('_TEMPLATE_ITEMBODY',		'Corpo articolo');
define('_TEMPLATE_ITEMFOOTER',		'Fine articolo');
define('_TEMPLATE_MORELINK',		'Link alla parte estesa dell\'articolo');
define('_TEMPLATE_NEW',				'Indicazione di un nuovo articolo');
define('_TEMPLATE_COMMENTS_ANY',	'Commenti (se presenti)');
define('_TEMPLATE_CHEADER',			'Intestazione commenti');
define('_TEMPLATE_CBODY',			'Corpo commenti');
define('_TEMPLATE_CFOOTER',			'Fine commenti');
define('_TEMPLATE_CONE',			'Un commento');
define('_TEMPLATE_CMANY',			'Due (o pi&ugrave;) commenti');
define('_TEMPLATE_CMORE',			'&quot;Leggi tutti&quot; i commenti');
define('_TEMPLATE_CMEXTRA',			'Voce extra per utenti iscritti');
define('_TEMPLATE_COMMENTS_NONE',	'Commenti (se non presenti)');
define('_TEMPLATE_CNONE',			'Nessun commento');
define('_TEMPLATE_COMMENTS_TOOMUCH','Commenti (se presenti, ma troppi da mostrarli tutti insieme)');
define('_TEMPLATE_CTOOMUCH',		'Molti commenti');
define('_TEMPLATE_ARCHIVELIST',		'Liste archivio');
define('_TEMPLATE_AHEADER',			'Intestazione lista archivio');
define('_TEMPLATE_AITEM',			'Elemento lista archivio');
define('_TEMPLATE_AFOOTER',			'Fine lista archivio');
define('_TEMPLATE_DATETIME',		'Data ed ora');
define('_TEMPLATE_DHEADER',			'Intestazione data');
define('_TEMPLATE_DFOOTER',			'Fine data');
define('_TEMPLATE_DFORMAT',			'Formato data');
define('_TEMPLATE_TFORMAT',			'Formato ora');
define('_TEMPLATE_LOCALE',			'Locale');
define('_TEMPLATE_IMAGE',			'Imagini popup');
define('_TEMPLATE_PCODE',			'Codice per link popup');
define('_TEMPLATE_ICODE',			'Codice per Immagine in linea');
define('_TEMPLATE_MCODE',			'Codice per Link elemento media');
define('_TEMPLATE_SEARCH',			'Ricerca');
define('_TEMPLATE_SHIGHLIGHT',		'Evidenziazione');
define('_TEMPLATE_SNOTFOUND',		'Nessun risultato per la ricerca');
define('_TEMPLATE_UPDATE',			'Aggiorna');
define('_TEMPLATE_UPDATE_BTN',		'Aggiorna il modello');
define('_TEMPLATE_RESET_BTN',		'Azzera dati');
define('_TEMPLATE_CATEGORYLIST',	'Liste categorie');
define('_TEMPLATE_CATHEADER',		'Testata lista categoria');
define('_TEMPLATE_CATITEM',			'Elemento lista categoria');
define('_TEMPLATE_CATFOOTER',		'Fine lista categoria');

// skins
define('_SKIN_EDIT_TITLE',			'Modifica il tema');
define('_SKIN_AVAILABLE_TITLE',		'Temi disponibili');
define('_SKIN_NEW_TITLE',			'Nuovo tema');
define('_SKIN_NAME',				'Nome');
define('_SKIN_DESC',				'Descrizione');
define('_SKIN_TYPE',				'Content Type');
define('_SKIN_CREATE',				'Cre');
define('_SKIN_CREATE_BTN',			'Crea tema');
define('_SKIN_EDITONE_TITLE',		'Modifica il tema');
define('_SKIN_BACK',				'Torna alla pagina principale della gestione dei temi');
define('_SKIN_PARTS_TITLE',			'Parti del tema');
define('_SKIN_PARTS_MSG',			'Non tutte le parti del tema sono necessarie. Lascia vuote quelle che non ti servono. Seleziona la parte da modificare dall\'elenco qui sotto:');
define('_SKIN_PART_MAIN',			'Indice principale');
define('_SKIN_PART_ITEM',			'Pagine articolo');
define('_SKIN_PART_ALIST',			'Lista archivio');
define('_SKIN_PART_ARCHIVE',		'Archivio');
define('_SKIN_PART_SEARCH',			'Cerca');
define('_SKIN_PART_ERROR',			'Errori');
define('_SKIN_PART_MEMBER',			'Dettagli utente');
define('_SKIN_PART_POPUP',			'Popup immagine');
define('_SKIN_GENSETTINGS_TITLE',	'Impostazioni generali');
define('_SKIN_CHANGE',				'Cambia');
define('_SKIN_CHANGE_BTN',			'Cambia queste impostazioni');
define('_SKIN_UPDATE_BTN',			'Aggiorna il tema');
define('_SKIN_RESET_BTN',			'Reimposta Dati');
define('_SKIN_EDITPART_TITLE',		'Modifica tema');
define('_SKIN_GOBACK',				'Torna indietro');
define('_SKIN_ALLOWEDVARS',			'Variabili Disponibili (clicca sul nome della variabile per maggiori informazioni):');

// global settings
define('_SETTINGS_TITLE',			'Impostazioni generali');
define('_SETTINGS_SUB_GENERAL',		'Impostazioni generali');
define('_SETTINGS_DEFBLOG',			'Blog di default');
define('_SETTINGS_ADMINMAIL',		'Email amministratore');
define('_SETTINGS_SITENAME',		'Nome sito');
define('_SETTINGS_SITEURL',			'URL del sito (deve terminare con uno slash)');
define('_SETTINGS_ADMINURL',		'URL dell\'area di amministrazione (deve terminare con uno slash)');
define('_SETTINGS_DIRS',			'Directory di Nucleus');
define('_SETTINGS_MEDIADIR',		'Directory media (upload)');
define('_SETTINGS_SEECONFIGPHP',	'(vedi config.php)');
define('_SETTINGS_MEDIAURL',		'Url della directory media (deve terminare con uno slash)');
define('_SETTINGS_ALLOWUPLOAD',		'Consenti il caricamento dei file?');
define('_SETTINGS_ALLOWUPLOADTYPES','Consenti il caricamento dei seguenti tipi di file');
define('_SETTINGS_CHANGELOGIN',		'Abilita gli utenti alla modifica della login/password');
define('_SETTINGS_COOKIES_TITLE',	'Impostazioni cookie');
define('_SETTINGS_COOKIELIFE',		'Durata del cookie');
define('_SETTINGS_COOKIESESSION',	'Sessione');
define('_SETTINGS_COOKIEMONTH',		'Un mese');
define('_SETTINGS_COOKIEPATH',		'Percorso cookie (avanzato)');
define('_SETTINGS_COOKIEDOMAIN',	'Dominio cookie (avanzato)');
define('_SETTINGS_COOKIESECURE',	'Cookie sicuro (avanzato)');
define('_SETTINGS_LASTVISIT',		'Salva il cookie dell\'ultima visita');
define('_SETTINGS_ALLOWCREATE',		'Consenti ai visitatori di creare un account utente');
define('_SETTINGS_NEWLOGIN',		'Abilita il login all\'area amministrativa per gli account creati dagli utenti');
define('_SETTINGS_NEWLOGIN2',		'(questa impostazione verr&agrave; applicata solo ai nuovi account)');
define('_SETTINGS_MEMBERMSGS',		'Abilita i servizi tra i membri del blog');
define('_SETTINGS_LANGUAGE',		'Linguaggio di default');
define('_SETTINGS_DISABLESITE',		'Disabilita il weblog');
define('_SETTINGS_DBLOGIN',			'Connessione mySQL &amp; database');
define('_SETTINGS_UPDATE',			'Aggiorna le impostazioni');
define('_SETTINGS_UPDATE_BTN',		'Aggiorna impostazioni');
define('_SETTINGS_DISABLEJS',		'Disabilita la barra degli strumenti in JavaScript');
define('_SETTINGS_MEDIA',			'Impostazioni media/caricamento');
define('_SETTINGS_MEDIAPREFIX',		'Aggiungi un prefisso con la data ai file caricati');
define('_SETTINGS_MEMBERS',			'Impostazioni utente');

// bans
define('_BAN_TITLE',				'Lista ban per');
define('_BAN_NONE',					'Nessun ban per questo weblog');
define('_BAN_NEW_TITLE',			'Aggiungi un nuovo ban');
define('_BAN_NEW_TEXT',				'Aggiungi un nuovo ban ora');
define('_BAN_REMOVE_TITLE',			'Rimuovi ban');
define('_BAN_IPRANGE',				'Range IP');
define('_BAN_BLOGS',				'In quali blog?');
define('_BAN_DELETE_TITLE',			'Cancella ban');
define('_BAN_ALLBLOGS',				'Tutti i blog nei quali hai privilegi di amministrazione.');
define('_BAN_REMOVED_TITLE',		'Ban rimosso');
define('_BAN_REMOVED_TEXT',			'Il ban &egrave; stato rimosso dai seguenti blog:');
define('_BAN_ADD_TITLE',			'Aggiungi ban');
define('_BAN_IPRANGE_TEXT',			'Scegli il range di IP che vuoi bloccare. Minori sono i numeri inseriti, maggiori saranno gli indirizzi bloccati.');
define('_BAN_BLOGS_TEXT',			'Puoi selezionare di aggiungere un ban in un blog solamente, oppure puoi selezionare di bloccare gli IP sopra indicati in tutti i blog nei quali hai i diritti di amministrazione. Effettua la tua scelta qui sotto.');
define('_BAN_REASON_TITLE',			'Motivo del ban');
define('_BAN_REASON_TEXT',			'Puoi fornire una spiegazione al ban. Questa verr&agrave; visualizzata ai proprietari degli IP che tenteranno di aggiungere un commento o un voto karma negli articoli dei blog sopra selezionati. La lunghezza massima della spiegazione &egrave; di 256 caratteri.');
define('_BAN_ADD_BTN',				'Aggiungi ban');

// LOGIN screen
define('_LOGIN_MESSAGE',			'Messaggio');
define('_LOGIN_NAME',				'Nome');
define('_LOGIN_PASSWORD',			'Password');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'Hai dimenticato la password?');

// membermanagement
define('_MEMBERS_TITLE',			'Gestione utenti');
define('_MEMBERS_CURRENT',			'Utenti registrati');
define('_MEMBERS_NEW',				'Nuovo utente');
define('_MEMBERS_DISPLAY',			'Nome utente');
define('_MEMBERS_DISPLAY_INFO',		'(questo &egrave; il nome che dovrai utilizzare per la connessione)');
define('_MEMBERS_REALNAME',			'Nome reale');
define('_MEMBERS_PWD',				'Password');
define('_MEMBERS_REPPWD',			'Reinserisci la password');
define('_MEMBERS_EMAIL',			'Indirizzo email');
define('_MEMBERS_EMAIL_EDIT',		'(modificando l\'indirizzo email verr&agrave; automaticamente spedita una nuova password all\'indirizzo inserito)');
define('_MEMBERS_URL',				'Indirizzo sito web (URL)');
define('_MEMBERS_SUPERADMIN',		'Privilegi di amministrazione');
define('_MEMBERS_CANLOGIN',			'Pu&ograve; connettersi all\'area amministrativa del sito');
define('_MEMBERS_NOTES',			'Note');
define('_MEMBERS_NEW_BTN',			'Aggiungi utente');
define('_MEMBERS_EDIT',				'Modifica dati utente');
define('_MEMBERS_EDIT_BTN',			'Invia le modifiche');
define('_MEMBERS_BACKTOOVERVIEW',	'Torna alla pagina principale della gestione degli utenti');
define('_MEMBERS_DEFLANG',			'Linguaggio');
define('_MEMBERS_USESITELANG',		'- usa le impostazioni standard del weblog -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'Visita il sito');
define('_BLOGLIST_ADD',				'Aggiungi un articolo');
define('_BLOGLIST_TT_ADD',			'Aggiungi un nuovo articolo in questo weblog');
define('_BLOGLIST_EDIT',			'Modifica/elimina gli articoli');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Bookmarklet');
define('_BLOGLIST_TT_BMLET',		'Gestisci il tuo blog con un solo click');
define('_BLOGLIST_SETTINGS',		'Impostazioni');
define('_BLOGLIST_TT_SETTINGS',		'Modifica le impostazioni e gestisci gli utenti');
define('_BLOGLIST_BANS',			'Ban');
define('_BLOGLIST_TT_BANS',			'Visualizza, aggiungi o rimuovi IP da BANnare');
define('_BLOGLIST_DELETE',			'Cancella tutto');
define('_BLOGLIST_TT_DELETE',		'Elimina questo weblog');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'I tuoi weblog');
define('_OVERVIEW_YRDRAFTS',		'Le tue bozze');
define('_OVERVIEW_YRSETTINGS',		'Le tue impostazioni');
define('_OVERVIEW_GSETTINGS',		'Impostazioni generali');
define('_OVERVIEW_NOBLOGS',			'Non sei presente nelle liste degli utenti di alcun weblog');
define('_OVERVIEW_NODRAFTS',		'Nessuna bozza presente');
define('_OVERVIEW_EDITSETTINGS',	'Modifica le tue impostazioni...');
define('_OVERVIEW_BROWSEITEMS',		'Gestisci i tuoi articoli...');
define('_OVERVIEW_BROWSECOMM',		'Gestisci i tuoi commenti...');
define('_OVERVIEW_VIEWLOG',			'Visualizza i log delle azioni...');
define('_OVERVIEW_MEMBERS',			'Gestisci i membri...');
define('_OVERVIEW_NEWLOG',			'Crea un nuovo weblog...');
define('_OVERVIEW_SETTINGS',		'Modifica le impostazioni...');
define('_OVERVIEW_TEMPLATES',		'Modifica i modelli...');
define('_OVERVIEW_SKINS',			'Modifica i temi...');
define('_OVERVIEW_BACKUP',			'Salva/ripristina...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'Articoli del blog');
define('_ITEMLIST_YOUR',			'I tuoi articolo');

// Comments
define('_COMMENTS',					'Commenti');
define('_NOCOMMENTS',				'Non sono presenti commenti per questo articolo');
define('_COMMENTS_YOUR',			'I tuoi commenti');
define('_NOCOMMENTS_YOUR',			'Non hai scritto alcun commento');

// LISTS (general)
define('_LISTS_NOMORE',				'Nessun risultato/Non ci sono altri risultati');
define('_LISTS_PREV',				'Precedente');
define('_LISTS_NEXT',				'Prossimo');
define('_LISTS_SEARCH',				'Cerca');
define('_LISTS_CHANGE',				'Cambia');
define('_LISTS_PERPAGE',			'articoli/pagina');
define('_LISTS_ACTIONS',			'Azioni');
define('_LISTS_DELETE',				'Cancella');
define('_LISTS_EDIT',				'Modifica');
define('_LISTS_MOVE',				'Sposta');
define('_LISTS_CLONE',				'Clona');
define('_LISTS_TITLE',				'Titolo');
define('_LISTS_BLOG',				'Blog');
define('_LISTS_NAME',				'Nome');
define('_LISTS_DESC',				'Descrizione');
define('_LISTS_TIME',				'Ora');
define('_LISTS_COMMENTS',			'Commenti');
define('_LISTS_TYPE',				'Tipo');


// member list
define('_LIST_MEMBER_NAME',			'Nome Utente');
define('_LIST_MEMBER_RNAME',		'Nome Reale');
define('_LIST_MEMBER_ADMIN',		'Super-admin? ');
define('_LIST_MEMBER_LOGIN',		'Pu&ograve; connettersi? ');
define('_LIST_MEMBER_URL',			'Sito Web');

// banlist
define('_LIST_BAN_IPRANGE',			'Range IP');
define('_LIST_BAN_REASON',			'Motivo');

// actionlist
define('_LIST_ACTION_MSG',			'Messaggio');

// commentlist
define('_LIST_COMMENT_BANIP',		'Ban IP');
define('_LIST_COMMENT_WHO',			'Autore');
define('_LIST_COMMENT',				'Commento');
define('_LIST_COMMENT_HOST',		'Host');

// itemlist
define('_LIST_ITEM_INFO',			'Informazioni');
define('_LIST_ITEM_CONTENT',		'Titolo e testo');


// teamlist
define('_LIST_TEAM_ADMIN',			'Amministratore ');
define('_LIST_TEAM_CHADMIN',		'Modifica amministratore');

// edit comments
define('_EDITC_TITLE',				'Modifica commenti');
define('_EDITC_WHO',				'Autore');
define('_EDITC_HOST',				'Da dove?');
define('_EDITC_WHEN',				'Quando?');
define('_EDITC_TEXT',				'Testo');
define('_EDITC_EDIT',				'Modifica commento');
define('_EDITC_MEMBER',				'utente');
define('_EDITC_NONMEMBER',			'utente non registrato');

// move item
define('_MOVE_TITLE',				'Sposta in quale blog?');
define('_MOVE_BTN',					'Sposta articolo');

?>