<?

// Italian Nucleus Language File
// 
// Author: MrShark - Antonio Fragola (http://www.mrshark.it/)
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
define('_EBLOG_ALLOWPASTPOSTING',	'Permetti l\'invio di post nel passato');
define('_ADD_CHANGEDATE',		'Aggiorna timestamp');
define('_BMLET_CHANGEDATE',		'Aggiorna timestamp');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'Importa/esporta Skin...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Normale');
define('_PARSER_INCMODE_SKINDIR',	'Usa la dir skin');
define('_SKIN_INCLUDE_MODE',		'Includi modo');
define('_SKIN_INCLUDE_PREFIX',		'Includi prefisso');

// global settings
define('_SETTINGS_BASESKIN',		'Skin Base');
define('_SETTINGS_SKINSURL',		'URL delle Skin');
define('_SETTINGS_ACTIONSURL',		'URL completo di action.php');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'Impossibile spostare la categoria predefinita');
define('_ERROR_MOVETOSELF',		'Impossibile spostare la categoria (il blog di destinazione è lo stesso di quello di origine)');
define('_MOVECAT_TITLE',		'Seleziona il blog in cui spostare la categoria');
define('_MOVECAT_BTN',			'Sposta categoria');

// URLMode setting
define('_SETTINGS_URLMODE',		'Modo URL');
define('_SETTINGS_URLMODE_NORMAL',	'Normale');
define('_SETTINGS_URLMODE_PATHINFO',	'Fancy');

// Batch operations
define('_BATCH_NOSELECTION',		'Nessuna selezione su cui operare');
define('_BATCH_ITEMS',			'Operazione in automatico sugli articoli');
define('_BATCH_CATEGORIES',		'Operazione in automatico sulle categorie');
define('_BATCH_MEMBERS',		'Operazione in automatico sui membri');
define('_BATCH_TEAM',			'Operazione in automatico sui membri del team');
define('_BATCH_COMMENTS',		'Operazione in automatico sui commenti');
define('_BATCH_UNKNOWN',		'Operazione in automatico sconosciuta: ');
define('_BATCH_EXECUTING',		'Esecuzione');
define('_BATCH_ONCATEGORY',		'sulla categoria');
define('_BATCH_ONITEM',			'sull\'articolo');
define('_BATCH_ONCOMMENT',		'sul commento');
define('_BATCH_ONMEMBER',		'sul membro');
define('_BATCH_ONTEAM',			'sul membro del team');
define('_BATCH_SUCCESS',		'Completato!');
define('_BATCH_DONE',			'Fatto!');
define('_BATCH_DELETE_CONFIRM',		'Conferma cancellazione automatica');
define('_BATCH_DELETE_CONFIRM_BTN',	'Conferma cancellazione automatica');
define('_BATCH_SELECTALL',		'seleziona tutto');
define('_BATCH_DESELECTALL',		'deseleziona tutto');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'Cancella');
define('_BATCH_ITEM_MOVE',		'Sposta');
define('_BATCH_MEMBER_DELETE',		'Cancella');
define('_BATCH_MEMBER_SET_ADM',		'Dai i permessi di amministratore');
define('_BATCH_MEMBER_UNSET_ADM',	'Togli i permessi di amministratore');
define('_BATCH_TEAM_DELETE',		'Cancella dal team');
define('_BATCH_TEAM_SET_ADM',		'Dai i permessi di amministratore');
define('_BATCH_TEAM_UNSET_ADM',		'Togli i permessi di amministratore');
define('_BATCH_CAT_DELETE',		'Cancella');
define('_BATCH_CAT_MOVE',		'Sposta in un altro blog');
define('_BATCH_COMMENT_DELETE',		'Cancella');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',		'Aggiungi un nuovo articolo...');
define('_ADD_PLUGIN_EXTRAS',		'Opzioni Plugin Extra');

// errors
define('_ERROR_CATCREATEFAIL',		'Impossibile creare la nuova categoria');
define('_ERROR_NUCLEUSVERSIONREQ',	'Questo plugin richiede una versione più recente di Nucleus:
');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Torna alle impostazioni del Blog');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Importa');
define('_SKINIE_TITLE_EXPORT',		'Esporta');
define('_SKINIE_BTN_IMPORT',		'Importa');
define('_SKINIE_BTN_EXPORT',		'Esporta le skin/modelli selezionati');
define('_SKINIE_LOCAL',			'Importa da un file locale:');
define('_SKINIE_NOCANDIDATES',		'Nessun candidato all\'importazione trovato nella directory delle skins');
define('_SKINIE_FROMURL',		'Importa dall\'URL:');
define('_SKINIE_EXPORT_INTRO',		'Seleziona le skin e i modelli da esportare in basso');
define('_SKINIE_EXPORT_SKINS',		'Skin');
define('_SKINIE_EXPORT_TEMPLATES',	'Modelli');
define('_SKINIE_EXPORT_EXTRA',		'Informazioni Extra');
define('_SKINIE_CONFIRM_OVERWRITE',	'Sovrascrivi le skin già esistenti (guarda le collisioni)');
define('_SKINIE_CONFIRM_IMPORT',	'Sì, voglio importare questo');
define('_SKINIE_CONFIRM_TITLE',		'Sto per importare skin e modelli');
define('_SKINIE_INFO_SKINS',		'Skin nel file:');
define('_SKINIE_INFO_TEMPLATES',	'Modelli nel file:');
define('_SKINIE_INFO_GENERAL',		'Informazioni:');
define('_SKINIE_INFO_SKINCLASH',	'Collisioni nomi skin:');
define('_SKINIE_INFO_TEMPLCLASH',	'Collisioni nomi modelli:');
define('_SKINIE_INFO_IMPORTEDSKINS',	'Skin importate:');
define('_SKINIE_INFO_IMPORTEDTEMPLS',	'Modelli importati:');
define('_SKINIE_DONE',			'Importazione completata');

define('_AND',				'e');
define('_OR',				'o');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'campo vuoto (click per modificare)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'IncludeMode:');
define('_LIST_SKINS_INCPREFIX',		'IncludePrefix:');
define('_LIST_SKINS_DEFINED',		'Parti definite:');

// backup
define('_BACKUPS_TITLE',		'Backup / Ripristino');
define('_BACKUP_TITLE',			'Backup');
define('_BACKUP_INTRO',			'Click sul pulsante seguente per creare un backup del tuo database Nucleus. Ti sarà chiesto dove salvare il file. Conservalo in un posto sicuro.');
define('_BACKUP_ZIP_YES',		'Prova ad usare la compressione');
define('_BACKUP_ZIP_NO',		'Non usare la compressione');
define('_BACKUP_BTN',			'Crea Backup');
define('_BACKUP_NOTE',			'<b>Nota:</b> Nel backup viene salvato solo il contenuto del database. I file multimediali e le impostazioni in config.php sono quindi <b>NON</b> incluse nel backup.');
define('_RESTORE_TITLE',		'Ripristina');
define('_RESTORE_NOTE',			'<b>ATTENZIONE:</b> Il ripristino da un backup <b>CANCELLERà</b> tutti i dati attualmente nel database! Fallo solo se sei realmente sicuro!	<br />	<b>Nota:</b> Assicurati che la versione di Nucleus in cui è stato creato il backup sia la stessa della versione che stai usando ora! Non funzionerà altrimenti');
define('_RESTORE_INTRO',		'Seleziona il file di backup in basso (sarà inviato al server) e clicka il pulsante "Ripristina" per iniziare.');
define('_RESTORE_IMSURE',		'Sì, sono sicuro di volerlo fare!');
define('_RESTORE_BTN',			'Ripristino dal File');
define('_RESTORE_WARNING',		'(assicurati di ripristinare il backup corretto, forse crea un nuovo backup prima di iniziare)');
define('_ERROR_BACKUP_NOTSURE',		'Devi controllare la casella di testo \'Sono sicuro\'');
define('_RESTORE_COMPLETE',		'Ripristino Completato');

// new item notification
define('_NOTIFY_NI_MSG',		'Un nuovo articolo è stato inviato:');
define('_NOTIFY_NI_TITLE',		'Nuovo articolo!');
define('_NOTIFY_KV_MSG',		'Voto Karma sull\'articolo:');
define('_NOTIFY_KV_TITLE',		'Nucleus karma:');
define('_NOTIFY_NC_MSG',		'Commento sull\'articolo:');
define('_NOTIFY_NC_TITLE',		'Commento Nucleus:');
define('_NOTIFY_USERID',		'ID utente:');
define('_NOTIFY_USER',			'Utente:');
define('_NOTIFY_COMMENT',		'Commento:');
define('_NOTIFY_VOTE',			'Voto:');
define('_NOTIFY_HOST',			'Host:');
define('_NOTIFY_IP',			'IP:');
define('_NOTIFY_MEMBER',		'Membro:');
define('_NOTIFY_TITLE',			'Titolo:');
define('_NOTIFY_CONTENTS',		'Contenuti:');

// member mail message
define('_MMAIL_MSG',			'Un messaggio per te da');
define('_MMAIL_FROMANON',		'un visitore anonimo');
define('_MMAIL_FROMNUC',		'Inviato da un weblog Nucleus a');
define('_MMAIL_TITLE',			'Un messaggio da');
define('_MMAIL_MAIL',			'Messaggio:');

// END introduced after v1.5 END

// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'Aggiungi articolo');
define('_BMLET_EDIT',				'Modifica articolo');
define('_BMLET_DELETE',				'Cancella articolo');
define('_BMLET_BODY',				'Corpo');
define('_BMLET_MORE',				'Esteso');
define('_BMLET_OPTIONS',			'Opzioni');
define('_BMLET_PREVIEW',			'Anteprima');

// used in bookmarklet
define('_ITEM_UPDATED',				'L\'articolo &egrave; stato aggiornato');
define('_ITEM_DELETED',				'L\'articolo &egrave; stato cancellato');

// plugins
define('_CONFIRMTXT_PLUGIN',		'Sei sicuro di voler cancellare il plugin chiamato ');
define('_ERROR_NOSUCHPLUGIN',		'Plugin inesistente');
define('_ERROR_DUPPLUGIN',			'Spiacente, questo plugin &egrave; gi&agrave; installato');
define('_ERROR_PLUGFILEERROR',		'Plugin inesistente, o permessi non impostati correttamente');
define('_PLUGS_NOCANDIDATES',		'Nessun plugin candidato trovato');

define('_PLUGS_TITLE_MANAGE',		'Gestisci Plugins');
define('_PLUGS_TITLE_INSTALLED',	'Attualmente installati');
define('_PLUGS_TITLE_UPDATE',		'Aggiorna elenco sottoscrittori');
define('_PLUGS_TEXT_UPDATE',		'Nucleus tiene una cache degli eventi sottoscritti dai plugins. Quando aagiorni un plugin sostituendo il suo file, devi avviare questo aggiornamento per assicurarti che siano memorizzate le sottoscrizioni corrette.');
define('_PLUGS_TITLE_NEW',			'Installa nuovo Plugin');
define('_PLUGS_ADD_TEXT',			'Qu&igrave; sotto c\'&egrave; un elenco di tutti i file nella tua directory dei plugin, che potrebbero essere ancora non installati. Accertati di essere <strong>veramente sicuro</strong> che sia un plugin prima di installarlo.');
define('_PLUGS_BTN_INSTALL',		'Installa Plugin');
define('_BACKTOOVERVIEW',			'Torna indietro');

// editlink
define('_TEMPLATE_EDITLINK',		'Modifica collegamento dell\'articolo');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'Aggiungi riquadro a sinistra');
define('_ADD_RIGHT_TT',				'Aggiungi riquadro a destra');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'Nuova Categoria');

// new settings
define('_SETTINGS_PLUGINURL',		'URL Plugin');
define('_SETTINGS_MAXUPLOADSIZE',	'Dimensione massima per i file in upload (bytes)');
define('_SETTINGS_NONMEMBERMSGS',	'Permetti ai non membri di inviare messaggi');
define('_SETTINGS_PROTECTMEMNAMES',	'Proteggi i nomi dei membri');

// overview screen
define('_OVERVIEW_PLUGINS',			'Gestione Plugins...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'Registratione nuovo membro:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'Tuo indirizzo email:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'Non hai i permessi di amministrazione su nessuno dei blog che hanno il membro di destinazione nella loro teamlist. Quindi, non ti &egrave; permesso fare l\'upload di file nella directory media dei membri');

// plugin list
define('_LISTS_INFO',				'Informazioni');
define('_LIST_PLUGS_AUTHOR',		'Autore:');
define('_LIST_PLUGS_VER',			'Versione:');
define('_LIST_PLUGS_SITE',			'Visita il sito');
define('_LIST_PLUGS_DESC',			'Descrizione:');
define('_LIST_PLUGS_SUBS',			'Sottoscrive i seguenti eventi:');
define('_LIST_PLUGS_UP',			'muovi su');
define('_LIST_PLUGS_DOWN',			'muovi gi&ugrave;');
define('_LIST_PLUGS_UNINSTALL',		'disinstalla');
define('_LIST_PLUGS_ADMIN',			'amministra');
define('_LIST_PLUGS_OPTIONS',		'modifica&nbsp;opzioni');

// plugin option list
define('_LISTS_VALUE',				'Valore');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'questo plugin non ha alcune opzione impostata');
define('_PLUGS_BACK',				'Torna indietro ai plugin');
define('_PLUGS_SAVE',				'Salva opzioni');
define('_PLUGS_OPTIONS_UPDATED',	'Opzioni plugin aggiornate');

define('_OVERVIEW_MANAGEMENT',		'Gestione');
define('_OVERVIEW_MANAGE',			'Gestione Nucleus...');
define('_MANAGE_GENERAL',			'Gestione Generale');
define('_MANAGE_SKINS',				'Skin e Modelli');
define('_MANAGE_EXTRA',				'Caratteristiche Extra');

define('_BACKTOMANAGE',				'Torna alla gestione Nucleus');


// END introduced after v1.1 END


// charset to use 
define('_CHARSET',				'iso-8859-15');

// global stuff
define('_LOGOUT',				'Log Out');
define('_LOGIN',				'Log In');
define('_YES',					'S&igrave;');
define('_NO',					'No');
define('_SUBMIT',				'Invia');
define('_ERROR',				'Errore');
define('_ERRORMSG',				'Si &egrave; verificato un errore!');
define('_BACK',					'Torna indietro');
define('_NOTLOGGEDIN',				'Non sei ancora loggato');
define('_LOGGEDINAS',				'Loggato come');
define('_ADMINHOME',				'Amministrazione');
define('_NAME',					'Nome');
define('_BACKHOME',				'Torna all\'Amministrazione');
define('_BADACTION',				'Azione richiesta inesistente');
define('_MESSAGE',				'Messaggio');
define('_HELP_TT',				'Aiuto!');
define('_YOURSITE',				'Il tuo sito');


define('_POPUP_CLOSE',				'Chiudi finestra');

define('_LOGIN_PLEASE',				'Per favore prima loggati');

// commentform
define('_COMMENTFORM_YOUARE',			'Tu sei');
define('_COMMENTFORM_SUBMIT',			'Aggiungi commento');
define('_COMMENTFORM_COMMENT',			'Il tuo commento');
define('_COMMENTFORM_NAME',			'Nome');
define('_COMMENTFORM_MAIL',			'E-mail/HTTP');
define('_COMMENTFORM_REMEMBER',			'Ricordami');

// loginform
define('_LOGINFORM_NAME',			'Nome utente');
define('_LOGINFORM_PWD',			'Password');
define('_LOGINFORM_YOUARE',			'Loggato come');
define('_LOGINFORM_SHARED',			'Computer condiviso');

// member mailform
define('_MEMBERMAIL_SUBMIT',			'Invia Messaggio');

// search form
define('_SEARCHFORM_SUBMIT',			'Ricerca');

// add item form
define('_ADD_ADDTO',				'Aggiungi un nuovo articolo');
define('_ADD_CREATENEW',			'Crea un nuovo articolo');
define('_ADD_BODY',				'Corpo');
define('_ADD_TITLE',				'Titolo');
define('_ADD_MORE',				'Esteso (opzionale)');
define('_ADD_CATEGORY',				'Categoria');
define('_ADD_PREVIEW',				'Anteprima');
define('_ADD_DISABLE_COMMENTS',			'Disabilita i commenti?');
define('_ADD_DRAFTNFUTURE',			'Bozze &amp; articoli futuri');
define('_ADD_ADDITEM',				'Aggiungi articolo');
define('_ADD_ADDNOW',				'Aggiungi adesso');
define('_ADD_ADDLATER',				'Aggiungi pi&ugrave; tardi');
define('_ADD_PLACE_ON',				'Posiziona in');
define('_ADD_ADDDRAFT',				'Aggiungi alle bozze');
define('_ADD_NOPASTDATES',			'(date e ore nel passato NON sono valide, nel caso saranno usate quelle correnti)');
define('_ADD_BOLD_TT',				'Grassetto');
define('_ADD_ITALIC_TT',			'Corsivo');
define('_ADD_HREF_TT',				'Crea un collegamento');
define('_ADD_MEDIA_TT',				'Aggiungi un Media');
define('_ADD_PREVIEW_TT',			'Mostra/Nascondi Anteprima');
define('_ADD_CUT_TT',				'Taglia');
define('_ADD_COPY_TT',				'Copia');
define('_ADD_PASTE_TT',				'Incolla');


// edit item form
define('_EDIT_ITEM',				'Modifica articolo');
define('_EDIT_SUBMIT',				'Modifica articolo');
define('_EDIT_ORIG_AUTHOR',			'Autore originale');
define('_EDIT_BACKTODRAFTS',			'Rimetti nelle bozze');
define('_EDIT_COMMENTSNOTE',			'(nota: la disabilitazione dei commenti _non_ nasconde i commenti aggiunti precedentemente)');

// used on delete screens
define('_DELETE_CONFIRM',			'Per favore conferma la cancellazione');
define('_DELETE_CONFIRM_BTN',			'Conferma');
define('_CONFIRMTXT_ITEM',			'Stai per cancellare l\'articolo seguente:');
define('_CONFIRMTXT_COMMENT',			'Stai per cancellare il commento seguente:');
define('_CONFIRMTXT_TEAM1',			'Stai per cancellare ');
define('_CONFIRMTXT_TEAM2',			' dalla teamlist del blog ');
define('_CONFIRMTXT_BLOG',			'Stai per cancellare il blog: ');
define('_WARNINGTXT_BLOGDEL',			'Attenzione! La cancellazione di un blog canceller&agrave; TUTTI gli articoli collegati al blog, e tutti i commenti. Per favore conferma, per essere CERTO di quello che stai facendo!<br />Inoltre, NON interrompere Nucleus durante la rimozione del blog.');
define('_CONFIRMTXT_MEMBER',			'Stai per cancellare il profilo del seguente membro: ');
define('_CONFIRMTXT_TEMPLATE',			'Stai per cancellare il modello chiamato ');
define('_CONFIRMTXT_SKIN',			'Stai per cancellare la skin chiamata ');
define('_CONFIRMTXT_BAN',			'Stai per cancellare il ban per l\'intervallo di ip');
define('_CONFIRMTXT_CATEGORY',			'Stai per cancellare la categoria ');

// some status messages
define('_DELETED_ITEM',				'Articolo cancellato');
define('_DELETED_MEMBER',			'Membro cancellato');
define('_DELETED_COMMENT',			'Commento cancellato');
define('_DELETED_BLOG',				'Blog cancellato');
define('_DELETED_CATEGORY',			'Categoria cancellata');
define('_ITEM_MOVED',				'Articolo spostato');
define('_ITEM_ADDED',				'Articolo aggiunto');
define('_COMMENT_UPDATED',			'Commento aggiornato');
define('_SKIN_UPDATED',				'Dati della Skin salvati');
define('_TEMPLATE_UPDATED',			'Dati del Modello salvati');

// errors
define('_ERROR_COMMENT_LONGWORD',		'Per favore non usare parole di lunghezza superiore a 90 caratteri nei tuoi commenti');
define('_ERROR_COMMENT_NOCOMMENT',		'Per favore inserisci un commento');
define('_ERROR_COMMENT_NOUSERNAME',		'Nome utente non valido');
define('_ERROR_COMMENT_TOOLONG',		'Il tuo commento &egrave; troppo lungo (max. 5000 car.)');
define('_ERROR_COMMENTS_DISABLED',		'I commenti per questo blog sono attualmente disabilitati.');
define('_ERROR_COMMENTS_NONPUBLIC',		'Devi essere loggato come membro per aggiungere commenti a questo blog');
define('_ERROR_COMMENTS_MEMBERNICK',		'Il nome da te scelto per inviare commenti &egrave; usato da un altro membro del sito. Scegline qualcun altro.');
define('_ERROR_SKIN',				'Errore nella skin');
define('_ERROR_ITEMCLOSED',			'L\'articolo &egrave; chiuso, non &egrave; possibile aggiungere nuovi commenti ad esso o votarlo');
define('_ERROR_NOSUCHITEM',			'L\'articolo non esiste');
define('_ERROR_NOSUCHBLOG',			'Il blog non esiste');
define('_ERROR_NOSUCHSKIN',			'La skin non esiste');
define('_ERROR_NOSUCHMEMBER',			'Il Membro non esiste');
define('_ERROR_NOTONTEAM',			'Non sei nella teamlist di questo weblog.');
define('_ERROR_BADDESTBLOG',			'Il blog di destinazione non esiste');
define('_ERROR_NOTONDESTTEAM',			'Non posso spostare l\'articolo, poich&eacute; non sei nella teamlist del blog di destinazione');
define('_ERROR_NOEMPTYITEMS',			'Impossibile aggiungere articoli vuoti!');
define('_ERROR_BADMAILADDRESS',			'Indirizzo email non valido');
define('_ERROR_BADNOTIFY',			'Uno o pi&ugrave; degli indirizzi di notifica forniti non &egrave; un indirizzo email valido');
define('_ERROR_BADNAME',			'Il nome non &egrave; valido (ammessi solo a-z e 0-9 , senza spazi iniziali/finali)');
define('_ERROR_NICKNAMEINUSE',			'Un altro membro sta gi&agrave; usando quel nickname');
define('_ERROR_PASSWORDMISMATCH',		'Le password devono coincidere');
define('_ERROR_PASSWORDTOOSHORT',		'La password deve essere di almeno 6 caratteri');
define('_ERROR_PASSWORDMISSING',		'La password non pu&ograve; essere vuota');
define('_ERROR_REALNAMEMISSING',		'Devi inserire un nome reale');
define('_ERROR_ATLEASTONEADMIN',		'Deve esserci sempre almeno un super-amministratore che possa loggarsi nell\'area amministrazione.');
define('_ERROR_ATLEASTONEBLOGADMIN',		'Completando questa operazione renderai il tuo weblog inutilizzabile. Per favore assicurati che ci sia sempre almeno un amministratore.');
define('_ERROR_ALREADYONTEAM',			'Non puoi aggiungere un membro che &egrave; gi&agrave; nel gruppo');
define('_ERROR_BADSHORTBLOGNAME',		'Il nome breve del blog pu&ograve; contenere solo a-z e 0-9, senza spazi');
define('_ERROR_DUPSHORTBLOGNAME',		'Un altro blog ha gi&agrave; il nome breve scelto. Questi nomi devono essere univoci');
define('_ERROR_UPDATEFILE',			'Impossibile avere accesso in scrittura al file di aggiornamento. Assicurati che i permessi del file siano esatti (prova a fare un chmod 666 su di esso). Inoltre nota che la posizione &egrave; relativa alla directory dell\'area di amministrazione, quindi &egrave; meglio se usi un percorso assoluto (qualcosa come /tuo/percorso/verso/nucleus/)');
define('_ERROR_DELDEFBLOG',			'Impossibile cancellare il blog predefinito');
define('_ERROR_DELETEMEMBER',			'Questo membro non pu&ograve; essere cancellato, probabilmente perch&eacute; &egrave; l\'autore dell\'articolo o commento');
define('_ERROR_BADTEMPLATENAME',		'Nome del modello non valido, usare solo a-z e 0-9, senza spazi');
define('_ERROR_DUPTEMPLATENAME',		'Esiste gi&agrave; un altro modello con lo stesso nome');
define('_ERROR_BADSKINNAME',			'Nome della skin non valido, usare solo a-z e 0-9, senza spazi )');
define('_ERROR_DUPSKINNAME',			'Esiste gi&agrave; un\'altra skin con lo stesso nome');
define('_ERROR_DEFAULTSKIN',			'Deve sempre esistere una skin chiamata "default"');
define('_ERROR_SKINDEFDELETE',			'Impossibile rimuovere la skin perch&eacute; &egrave; quella predefinita per il seguente weblog: ');
define('_ERROR_DISALLOWED',			'Spiacente, non puoi eseguire questa operazione');
define('_ERROR_DELETEBAN',			'Errore durante la cancellazione del ban (ban inesistente)');
define('_ERROR_ADDBAN',				'Errore durante l\'aggiunta di un ban. Il ban potrebbe non essere stato aggiunto in modo corretto a tutti i tuoi blog.');
define('_ERROR_BADACTION',			'L\'azione richiesta non esiste');
define('_ERROR_MEMBERMAILDISABLED',		'I messaggi da membro a membro sono disabilitati');
define('_ERROR_MEMBERCREATEDISABLED',		'La creazione degli account dei membri &egrave; disabilitata');
define('_ERROR_INCORRECTEMAIL',			'Indirizzo email non corretto');
define('_ERROR_VOTEDBEFORE',			'Hai gi&agrave; votato per questo articolo');
define('_ERROR_BANNED1',			'Impossibile eseguire l\'azione perch&eacute; (intervallo IP ');
define('_ERROR_BANNED2',			') sei bannato dall\'eseguirla. Il messaggio era: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',			'Devi essere loggato per poter eseguire quest\'azione');
define('_ERROR_CONNECT',			'Errore di connessione');
define('_ERROR_FILE_TOO_BIG',			'Il file &egrave; troppo grande!');
define('_ERROR_BADFILETYPE',			'Spiacente, questo tipo di file non &egrave; permesso');
define('_ERROR_BADREQUEST',			'Richiesta di upload errata');
define('_ERROR_DISALLOWEDUPLOAD',		'Non fai parte della teamlist di alcun weblog. Quindi, non ti &egrave; permesso fare upload di file');
define('_ERROR_BADPERMISSIONS',			'I permessi per File/Dir non sono impostati correttamente');
define('_ERROR_UPLOADMOVEP',			'Errore durante lo spostamento del file uploadato');
define('_ERROR_UPLOADCOPY',			'Errore durante la copia del file');
define('_ERROR_UPLOADDUPLICATE',		'Esiste gi&agrave; un altro file con quel nome. Prova a rinominarlo prima di uploadarlo.');
define('_ERROR_LOGINDISALLOWED',		'Spiacente, non hai il permesso di loggarti nell\'area amministrazione. Puoi comunque loggarti come altro utente');
define('_ERROR_DBCONNECT',			'Impossibile collegarsi al server MySQL');
define('_ERROR_DBSELECT',			'Impossibile collegarsi as database nucleus.');
define('_ERROR_NOSUCHLANGUAGE',			'Lingua inesistente');
define('_ERROR_NOSUCHCATEGORY',			'Categoria inesistente');
define('_ERROR_DELETELASTCATEGORY',		'Deve esistere almeno una categoria');
define('_ERROR_DELETEDEFCATEGORY',		'Impossibile cancellare la categoria predefinita');
define('_ERROR_BADCATEGORYNAME',			'Nome di categoria errato');
define('_ERROR_DUPCATEGORYNAME',		'Esiste gi&agrave; un\'altra categoria con questo nome');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'Attenzione: Il valore corrente non &egrave; una directory!');
define('_WARNING_NOTREADABLE',			'Attenzione: Il valore corrente &egrave; una directory non leggibile!');
define('_WARNING_NOTWRITABLE',			'Attenzione: Il valore corrente NON &egrave; una directory scrivibile!');

// media and upload
define('_MEDIA_UPLOADLINK',			'Upload di un nuovo file');
define('_MEDIA_MODIFIED',			'modificato');
define('_MEDIA_FILENAME',			'nome file');
define('_MEDIA_DIMENSIONS',			'dimensioni');
define('_MEDIA_INLINE',				'Inline');
define('_MEDIA_POPUP',				'Popup');
define('_UPLOAD_TITLE',				'Scegli file');
define('_UPLOAD_MSG',				'Seleziona il file di cui fare l\'upload in basso, e premi il pulsante \'Upload\'.');
define('_UPLOAD_BUTTON',			'Upload');

// some status messages
define('_MSG_ACCOUNTCREATED',			'Account creato, la password sar&agrave; inviata per email');
define('_MSG_PASSWORDSENT',			'La password &egrave; stata inviata per email.');
define('_MSG_LOGINAGAIN',			'Devi rifare il login, a causa delle modifiche delle tue informazioni');
define('_MSG_SETTINGSCHANGED',			'Impostazioni cambiate');
define('_MSG_ADMINCHANGED',			'Amministratore cambiato');
define('_MSG_NEWBLOG',				'Nuovo Blog creato');
define('_MSG_ACTIONLOGCLEARED',			'Log delle azioni ripulite');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',			'Azione non consentita: ');
define('_ACTIONLOG_PWDREMINDERSENT',		'Inviata nuova password per ');
define('_ACTIONLOG_TITLE',			'Log delle azioni');
define('_ACTIONLOG_CLEAR_TITLE',		'Ripulisci log delle azioni');
define('_ACTIONLOG_CLEAR_TEXT',			'Ripulisci log delle azioni adesso');

// team management
define('_TEAM_TITLE',				'Gestisci gruppi per i blog ');
define('_TEAM_CURRENT',				'Gruppo attuale');
define('_TEAM_ADDNEW',				'Aggiungi nuovo membro al gruppo');
define('_TEAM_CHOOSEMEMBER',			'Scegli membro');
define('_TEAM_ADMIN',				'Privilegi di amministrazione? ');
define('_TEAM_ADD',					'Aggiungi al gruppo');
define('_TEAM_ADD_BTN',				'Aggiungi al gruppo');

// blogsettings
define('_EBLOG_TITLE',				'Modifica impostazioni blog');
define('_EBLOG_TEAM_TITLE',			'Modifica gruppo');
define('_EBLOG_TEAM_TEXT',			'Clicca qu&igrave; per modificare il gruppo.');
define('_EBLOG_SETTINGS_TITLE',			'Impostazioni blog');
define('_EBLOG_NAME',				'Nome blog');
define('_EBLOG_SHORTNAME',			'Nome breve blog');
define('_EBLOG_SHORTNAME_EXTRA',		'<br />(deve contenere a-z senza spazi)');
define('_EBLOG_DESC',				'Descrizione blog');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'Skin predefinita');
define('_EBLOG_DEFCAT',				'Categoria predefinita');
define('_EBLOG_LINEBREAKS',			'Converti interruzioni di linea');
define('_EBLOG_DISABLECOMMENTS',		'Commenti abilitati?<br /><small>(Disabilitando i commenti non sar&agrave; possibile aggiungerne di nuovi.)</small>');
define('_EBLOG_ANONYMOUS',			'Permetti i commenti ai non membri?');
define('_EBLOG_NOTIFY',				'Indirizzi di notifica (usa ; come separatore)');
define('_EBLOG_NOTIFY_ON',			'Notifica attiva');
define('_EBLOG_NOTIFY_COMMENT',			'Nuovi commenti');
define('_EBLOG_NOTIFY_KARMA',			'Nuovi voti karma');
define('_EBLOG_NOTIFY_ITEM',			'Nuovi articoli weblog');
define('_EBLOG_PING',				'Ping Weblogs.com aggiornando?');
define('_EBLOG_MAXCOMMENTS',			'Numero massimo di commenti');
define('_EBLOG_UPDATE',				'Aggiorna file');
define('_EBLOG_OFFSET',				'Time Offset');
define('_EBLOG_STIME',				'L\'ora attuale del server &egrave;');
define('_EBLOG_BTIME',				'L\'ora attuale del blog &egrave;');
define('_EBLOG_CHANGE',				'Cambia impostazioni');
define('_EBLOG_CHANGE_BTN',			'Cambia impostazioni');
define('_EBLOG_ADMIN',				'Amministrazione blog');
define('_EBLOG_ADMIN_MSG',			'Ti verranno assegnati i privilegi di amministrazione');
define('_EBLOG_CREATE_TITLE',			'Crea un nuovo weblog');
define('_EBLOG_CREATE_TEXT',			'Compila il modulo in basso per creare un nuovo weblog. <br /><br /> <b>Nota:</b> Sono elencate solo le opzioni necessarie. Se vuoi impostare opzioni aggiuntive, entra nella pagina delle impostazioni del blog dopo la sua creazioni.');
define('_EBLOG_CREATE',				'Crea!');
define('_EBLOG_CREATE_BTN',			'Crea Weblog');
define('_EBLOG_CAT_TITLE',			'Categorie');
define('_EBLOG_CAT_NAME',			'Nome categoria');
define('_EBLOG_CAT_DESC',			'Descrizione categoria');
define('_EBLOG_CAT_CREATE',			'Crea una nuova category');
define('_EBLOG_CAT_UPDATE',			'Aggiorna la categoria');
define('_EBLOG_CAT_UPDATE_BTN',			'Aggiorna la categoria');

// templates
define('_TEMPLATE_TITLE',			'Modifica i modelli');
define('_TEMPLATE_AVAILABLE_TITLE',		'Modelli disponibili');
define('_TEMPLATE_NEW_TITLE',			'Nuovo modello');
define('_TEMPLATE_NAME',			'Nome modello');
define('_TEMPLATE_DESC',			'Descrizione modello');
define('_TEMPLATE_CREATE',			'Crea modello');
define('_TEMPLATE_CREATE_BTN',			'Crea modello');
define('_TEMPLATE_EDIT_TITLE',			'Modifica modello');
define('_TEMPLATE_BACK',			'Ritorna alla gestione modelli');
define('_TEMPLATE_EDIT_MSG',			'Non tutte le parti di un modello sono necessarie, lascia vuote quelle che non ti servono.');
define('_TEMPLATE_SETTINGS',			'Impostazioni modello');
define('_TEMPLATE_ITEMS',			'Articoli');
define('_TEMPLATE_ITEMHEADER',			'Intestazione dell\'articolo');
define('_TEMPLATE_ITEMBODY',			'Corpo dell\'articolo');
define('_TEMPLATE_ITEMFOOTER',			'Piede dell\'articolo');
define('_TEMPLATE_MORELINK',			'Collegamento alla versione estesa');
define('_TEMPLATE_NEW',				'Indicazione di un nuovo articolo');
define('_TEMPLATE_COMMENTS_ANY',		'Commenti (se esistenti)');
define('_TEMPLATE_CHEADER',			'Intestazione dei commenti');
define('_TEMPLATE_CBODY',			'Corpo dei commenti');
define('_TEMPLATE_CFOOTER',			'Piede dei commenti');
define('_TEMPLATE_CONE',			'Un commento');
define('_TEMPLATE_CMANY',			'Due (o pi&ugrave;) commenti');
define('_TEMPLATE_CMORE',			'Leggi altri commenti');
define('_TEMPLATE_CMEXTRA',			'Membro extra');
define('_TEMPLATE_COMMENTS_NONE',		'Commenti (se inesistenti)');
define('_TEMPLATE_CNONE',			'Nessun commento');
define('_TEMPLATE_COMMENTS_TOOMUCH',		'Commenti (se esistenti, ma troppo grandi per mostrarli inline)');
define('_TEMPLATE_CTOOMUCH',			'Troppi commenti');
define('_TEMPLATE_ARCHIVELIST',			'Elenco archivi');
define('_TEMPLATE_AHEADER',			'Intestazione dell\'elenco archivi');
define('_TEMPLATE_AITEM',			'Articolo dell\'elenco archivi');
define('_TEMPLATE_AFOOTER',			'Piede dell\'elenco archivi');
define('_TEMPLATE_DATETIME',			'Data e ora');
define('_TEMPLATE_DHEADER',			'Intestazione della data');
define('_TEMPLATE_DFOOTER',			'Piede della data');
define('_TEMPLATE_DFORMAT',			'Formato della data');
define('_TEMPLATE_TFORMAT',			'Formato dell\'ora');
define('_TEMPLATE_LOCALE',			'Locale');
define('_TEMPLATE_IMAGE',			'Immagini popup');
define('_TEMPLATE_PCODE',			'Codice del collegamento popup');
define('_TEMPLATE_ICODE',			'Codice dell\'immagine inline');
define('_TEMPLATE_MCODE',			'Codice del collegamento dell\'oggetto Media');
define('_TEMPLATE_SEARCH',			'Ricerca');
define('_TEMPLATE_SHIGHLIGHT',			'Evidenzia');
define('_TEMPLATE_SNOTFOUND',			'Nessun risultato dalla ricerca');
define('_TEMPLATE_UPDATE',			'Aggiorna');
define('_TEMPLATE_UPDATE_BTN',			'Aggiorna modello');
define('_TEMPLATE_RESET_BTN',			'Azzera i dati');
define('_TEMPLATE_CATEGORYLIST',		'Elenco categorie');
define('_TEMPLATE_CATHEADER',			'Intestazione dell\'elenco categorie');
define('_TEMPLATE_CATITEM',			'Articolo dell\'elenco categorie');
define('_TEMPLATE_CATFOOTER',			'Piede dell\'elenco categorie');

// skins
define('_SKIN_EDIT_TITLE',			'Modifica skin');
define('_SKIN_AVAILABLE_TITLE',			'Skin disponibili');
define('_SKIN_NEW_TITLE',			'Nuova skin');
define('_SKIN_NAME',				'Nome');
define('_SKIN_DESC',				'Descrizione');
define('_SKIN_TYPE',				'Tipo di contenuto');
define('_SKIN_CREATE',				'Crea');
define('_SKIN_CREATE_BTN',			'Crea skin');
define('_SKIN_EDITONE_TITLE',			'Modifica skin');
define('_SKIN_BACK',				'Ritorna alla gestione skin');
define('_SKIN_PARTS_TITLE',			'Parti della skin');
define('_SKIN_PARTS_MSG',			'Non tutte le parti di una skin sono necessarie, lascia vuote quelle che non ti servono. Scegli di seguito il tipo di skin da modificare:');
define('_SKIN_PART_MAIN',			'Indice principale');
define('_SKIN_PART_ITEM',			'Pagine dell\'articolo');
define('_SKIN_PART_ALIST',			'Elenco dell\'archivio');
define('_SKIN_PART_ARCHIVE',			'Archivio');
define('_SKIN_PART_SEARCH',			'Ricerca');
define('_SKIN_PART_ERROR',			'Errori');
define('_SKIN_PART_MEMBER',			'Dettagli dei membri');
define('_SKIN_PART_POPUP',			'Immagini popup');
define('_SKIN_GENSETTINGS_TITLE',		'Impostazioni generali');
define('_SKIN_CHANGE',				'Cambia');
define('_SKIN_CHANGE_BTN',			'Cambia queste impostazioni');
define('_SKIN_UPDATE_BTN',			'Aggiorna la skin');
define('_SKIN_RESET_BTN',			'Azzera i dati');
define('_SKIN_EDITPART_TITLE',			'Modifica la skin');
define('_SKIN_GOBACK',				'Torna indietro');
define('_SKIN_ALLOWEDVARS',			'Variabili ammesse (click per informazioni):');

// global settings
define('_SETTINGS_TITLE',			'Impostazioni generali');
define('_SETTINGS_SUB_GENERAL',			'Impostazioni generali');
define('_SETTINGS_DEFBLOG',			'Blog predefinito');
define('_SETTINGS_ADMINMAIL',			'Email dell\'amministratore');
define('_SETTINGS_SITENAME',			'Nome del sito');
define('_SETTINGS_SITEURL',			'URL del sito (deve finire con uno slash)');
define('_SETTINGS_ADMINURL',			'URL dell\'area di amministrazione (deve finire con uno slash)');
define('_SETTINGS_DIRS',			'Directory di Nucleus');
define('_SETTINGS_MEDIADIR',			'Directory dei Media');
define('_SETTINGS_SEECONFIGPHP',		'(guarda config.php)');
define('_SETTINGS_MEDIAURL',			'URL dei Media (deve finire con uno slash)');
define('_SETTINGS_ALLOWUPLOAD',			'Permetti l\'upload di file?');
define('_SETTINGS_ALLOWUPLOADTYPES',		'Tipi di file ammessi per l\'upload');
define('_SETTINGS_CHANGELOGIN',			'Permetti ai membri di cambiare Login/Password');
define('_SETTINGS_COOKIES_TITLE',		'Impostazioni cookie');
define('_SETTINGS_COOKIELIFE',			'Durata dei cookie');
define('_SETTINGS_COOKIESESSION',		'Cookie di sessione');
define('_SETTINGS_COOKIEMONTH',			'Durata di un mese');
define('_SETTINGS_COOKIEPATH',			'Percorso del cookie (avanzato)');
define('_SETTINGS_COOKIEDOMAIN',		'Dominio del cookie (avanzato)');
define('_SETTINGS_COOKIESECURE',		'Cookie sicuro (avanzato)');
define('_SETTINGS_LASTVISIT',			'Salva i cookie dell\'ultima visita');
define('_SETTINGS_ALLOWCREATE',			'Permetti ai visitatori di creare account come membro');
define('_SETTINGS_NEWLOGIN',			'Login permesso agli account creati dagli utenti');
define('_SETTINGS_NEWLOGIN2',			'(vale solo per i nuovi account creati)');
define('_SETTINGS_MEMBERMSGS',			'Permetti i servizi da membro a membro');
define('_SETTINGS_LANGUAGE',			'Lingua predefinita');
define('_SETTINGS_DISABLESITE',			'Disabilita il sito');
define('_SETTINGS_DBLOGIN',			'mySQL Login &amp; Database');
define('_SETTINGS_UPDATE',			'Aggiorna impostazioni');
define('_SETTINGS_UPDATE_BTN',			'Aggiorna impostazioni');
define('_SETTINGS_DISABLEJS',			'Disabilita la toolbar JavaScript');
define('_SETTINGS_MEDIA',			'Impostazioni per Media/Upload');
define('_SETTINGS_MEDIAPREFIX',			'Prefissa i file uploadati con la data');
define('_SETTINGS_MEMBERS',			'Impostazioni dei membri');

// bans
define('_BAN_TITLE',				'Elenco ban per');
define('_BAN_NONE',				'Nessun ban per questo weblog');
define('_BAN_NEW_TITLE',			'Aggiungi un nuovo ban');
define('_BAN_NEW_TEXT',				'Aggiungi un nuovo ban adesso');
define('_BAN_REMOVE_TITLE',			'Rimuovi ban');
define('_BAN_IPRANGE',				'Intervallo IP');
define('_BAN_BLOGS',				'Quali blog?');
define('_BAN_DELETE_TITLE',			'Cancella ban');
define('_BAN_ALLBLOGS',				'Tutti i blog su cui hai i privilegi di amministrazione.');
define('_BAN_REMOVED_TITLE',			'Ban rimosso');
define('_BAN_REMOVED_TEXT',			'Il ban &egrave; stato rimosso dai seguenti blog:');
define('_BAN_ADD_TITLE',			'Aggiungi ban');
define('_BAN_IPRANGE_TEXT',			'Scegli di seguito l\'intervallo di IP che vuoi bloccare. Minore &egrave; il numero al loro interno, maggiori saranno gli IP bloccati.');
define('_BAN_BLOGS_TEXT',			'Puoi o selezionare di bannare l\'IP in un solo blog, o selezionare di bloccare l\'IP su tutti i blog su cui hai i privilegi di amministrazione. Fai la tua scelta di seguito.');
define('_BAN_REASON_TITLE',			'Motivo');
define('_BAN_REASON_TEXT',			'Puoi fornire un motivo per il ban, che sar&agrave; visualizzato quando il possessore dell\'IP prover&agrave; ad aggiungere un altro commento o votare un karma. La lunghezza massima &egrave; di 256 caratteri.');
define('_BAN_ADD_BTN',				'Aggiungi Ban');

// LOGIN screen
define('_LOGIN_MESSAGE',			'Messaggio');
define('_LOGIN_NAME',				'Nome');
define('_LOGIN_PASSWORD',			'Password');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'Hai dimenticato la password?');

// membermanagement
define('_MEMBERS_TITLE',			'Gestione membri');
define('_MEMBERS_CURRENT',			'Membri attuali');
define('_MEMBERS_NEW',				'Nuovo membro');
define('_MEMBERS_DISPLAY',			'Nome visualizzato');
define('_MEMBERS_DISPLAY_INFO',			'(Questo &egrave; il nome da usare per il login)');
define('_MEMBERS_REALNAME',			'Nome reale');
define('_MEMBERS_PWD',				'Password');
define('_MEMBERS_REPPWD',			'Ripeti Password');
define('_MEMBERS_EMAIL',			'Indirizzo email');
define('_MEMBERS_EMAIL_EDIT',			'(Quando cambi indirizzo email, automaticamente ti verr&agrave; inviata una nuova password al nuovo indirizzo)');
define('_MEMBERS_URL',				'Indirizzo sito web (URL)');
define('_MEMBERS_SUPERADMIN',			'Privilegi di amministratore');
define('_MEMBERS_CANLOGIN',			'Pu&ograve; fare il login all\'area di amministrazione');
define('_MEMBERS_NOTES',			'Note');
define('_MEMBERS_NEW_BTN',			'Aggiungi un membro');
define('_MEMBERS_EDIT',				'Modifica un membro');
define('_MEMBERS_EDIT_BTN',			'Cambia le impostazioni');
define('_MEMBERS_BACKTOOVERVIEW',		'Ritorna all\'elenco dei membri');
define('_MEMBERS_DEFLANG',			'Lingua');
define('_MEMBERS_USESITELANG',			'- usa le impostazioni del sito -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',			'Visita il sito');
define('_BLOGLIST_ADD',				'Aggiungi un articolo');
define('_BLOGLIST_TT_ADD',			'Aggiungi un nuovo articolo a questo weblog');
define('_BLOGLIST_EDIT',			'Modifica/Cancella articoli');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Bookmarklet');
define('_BLOGLIST_TT_BMLET',			'');
define('_BLOGLIST_SETTINGS',			'Impostazioni');
define('_BLOGLIST_TT_SETTINGS',			'Modifica impostazioni o gestisci un gruppo');
define('_BLOGLIST_BANS',			'Ban');
define('_BLOGLIST_TT_BANS',			'Visualizza, aggiungi o rimuovi IP bannati');
define('_BLOGLIST_DELETE',			'Cancella tutto');
define('_BLOGLIST_TT_DELETE',			'Cancella questo weblog');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'I tuoi weblog');
define('_OVERVIEW_YRDRAFTS',			'Le tue bozze');
define('_OVERVIEW_YRSETTINGS',			'Le tue impostazioni');
define('_OVERVIEW_GSETTINGS',			'Impostazioni generali');
define('_OVERVIEW_NOBLOGS',			'Tu non sei nella teamlist di nessun weblog');
define('_OVERVIEW_NODRAFTS',			'Nessuna bozza');
define('_OVERVIEW_EDITSETTINGS',		'Modifica le tue impostazioni...');
define('_OVERVIEW_BROWSEITEMS',			'Sfoglia i tuoi articoli...');
define('_OVERVIEW_BROWSECOMM',			'Sfoglia i tuoi commenti...');
define('_OVERVIEW_VIEWLOG',			'Visualizza il log delle azioni...');
define('_OVERVIEW_MEMBERS',			'Gestisci i membri...');
define('_OVERVIEW_NEWLOG',			'Crea un nuovo Weblog...');
define('_OVERVIEW_SETTINGS',			'Modifica impostazioni...');
define('_OVERVIEW_TEMPLATES',			'Modifica modelli...');
define('_OVERVIEW_SKINS',			'Modifica Skin...');
define('_OVERVIEW_BACKUP',			'Backup/Restore...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'Articoli del blog'); 
define('_ITEMLIST_YOUR',			'I tuoi articoli');

// Comments
define('_COMMENTS',				'Commenti');
define('_NOCOMMENTS',				'Nessun commento per questo articolo');
define('_COMMENTS_YOUR',			'I tuoi commenti');
define('_NOCOMMENTS_YOUR',			'Non hai scritto alcun commento');

// LISTS (general)
define('_LISTS_NOMORE',				'Fine risultati, o nessun risultato');
define('_LISTS_PREV',				'Precedente');
define('_LISTS_NEXT',				'Prossimo');
define('_LISTS_SEARCH',				'Ricerca');
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
define('_LIST_MEMBER_NAME',			'Nome visualizzato');
define('_LIST_MEMBER_RNAME',			'Nome reale');
define('_LIST_MEMBER_ADMIN',			'Super-amministratore? ');
define('_LIST_MEMBER_LOGIN',			'Pu&ograve; fare login? ');
define('_LIST_MEMBER_URL',			'Sito web');

// banlist
define('_LIST_BAN_IPRANGE',			'Intervallo IP');
define('_LIST_BAN_REASON',			'Motivo');

// actionlist
define('_LIST_ACTION_MSG',			'Messaggio');

// commentlist
define('_LIST_COMMENT_BANIP',			'Ban IP');
define('_LIST_COMMENT_WHO',			'Autore');
define('_LIST_COMMENT',				'Commento');
define('_LIST_COMMENT_HOST',			'Host');

// itemlist
define('_LIST_ITEM_INFO',			'Informazioni');
define('_LIST_ITEM_CONTENT',			'Titolo e testo');


// teamlist
define('_LIST_TEAM_ADMIN',			'Amministratore ');
define('_LIST_TEAM_CHADMIN',			'Cambia amministratore');

// edit comments
define('_EDITC_TITLE',				'Modifica i commenti');
define('_EDITC_WHO',				'Autore');
define('_EDITC_HOST',				'Da dove?');
define('_EDITC_WHEN',				'Quando?');
define('_EDITC_TEXT',				'Testo');
define('_EDITC_EDIT',				'Modifica il commento');
define('_EDITC_MEMBER',				'membro');
define('_EDITC_NONMEMBER',			'non membro');

// move item
define('_MOVE_TITLE',				'Sposta in quale blog?');
define('_MOVE_BTN',				'Sposta articolo');

?>