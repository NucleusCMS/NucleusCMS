<?php
// Finnish Nucleus Language File
// 
// Author: Toni Ruuska, http://www.feldon.net 
// Based on earlier translations by Marko Sepp�nen (http://hoito.org) 
// and Jussi Josefsson (http://www.nominaali.com).
// Nucleus version: v1.0-v3.2 
//
// Please note: if you want to translate this file to your own language, be aware
// that in a next Nucleus version, new variables might be added and some other ones
// might be deleted. Therefore, it's important to list the Nucleus version for which
// the file was written in your document.
//
// Fully translated language file can be sent to us and will be made
// available for download (with proper credit to the author, of course)

// START changed/added after 3.15 START

define('_LIST_PLUG_SUBS_NEEDUPDATE','Paina \'P�ivit� laajennuslista\'-nappulaa p�ivitt��ksesi listan kaikista laajennuksista.');
define('_LIST_PLUGS_DEP',			'Laajennus vaatii:');

// END changed/added after 3.15

// START changed/added after 3.1 START

// comments list per weblog
define('_COMMENTS_BLOG',			'Kaikki kommentit kohteessa ');
define('_NOCOMMENTS_BLOG',			'Ei kommentteja');
define('_BLOGLIST_COMMENTS',		'Kommentit');
define('_BLOGLIST_TT_COMMENTS',		'Lista kommenteista');


// for use in archivetype-skinvar
define('_ARCHIVETYPE_DAY',			'p�iv�');
define('_ARCHIVETYPE_MONTH',		'kuukausi');

// tickets (prevents malicious users to trick an admin to perform actions he doesn't want)
define('_ERROR_BADTICKET',			'Vanhentunut tai virheellinen tunniste.');

// plugin dependency
define('_ERROR_INSREQPLUGIN',		'Laajennuksen asennus ei onnistunut, syyn� ');
define('_ERROR_DELREQPLUGIN',		'Laajennuksen poistaminen ei onnistunut, syyn� ');

// cookie prefix
define('_SETTINGS_COOKIEPREFIX',	'Ev�steen tunniste');

// account activation
define('_ERROR_NOLOGON_NOACTIVATE',	'Aktivointiin tarvittavaa linkki� ei voida l�hett��. Sis��nkirjautumista ei ole sallittu.');
define('_ERROR_ACTIVATE',			'Aktivointiin tarvittavaa avainta ei ole olemassa, se ei ole voimassa tai se on mennyt vanhaksi.');
define('_ACTIONLOG_ACTIVATIONLINK', 'Aktivointilinkki on l�hetetty');
define('_MSG_ACTIVATION_SENT',		'Aktivointilinkki on l�hetetty s�hk�postitse.');

// activation link emails
define('_ACTIVATE_REGISTER_MAIL',	"Terve <%memberName%>,\n\nSinun tulee aktivoida k�ytt�j�tilisi sivustolla <%siteName%> (<%siteUrl%>).\nVoit tehd� t�m�n valitsemalla oheisen linkin: \n\n\t<%activationUrl%>\n\nSinulla on kaksi p�iv�� aikaa tehd� n�in. T�m�n j�lkeen aktivointilinkki menee vanhaksi.");
define('_ACTIVATE_REGISTER_MAILTITLE',	"Aktivoi tilisi nimelle '<%memberName%>'");
define('_ACTIVATE_REGISTER_TITLE',	'Tervetuloa <%memberName%>');
define('_ACTIVATE_REGISTER_TEXT',	'Olet melkein valmis. Valitse salasana tilille.');
define('_ACTIVATE_FORGOT_MAIL',		"Terve <%memberName%>,\n\nOheisella linkill� voit vaihtaa uuden salasanan tilillesi sivustolle <%siteName%> (<%siteUrl%>), valitsemalla uusi salasana.\n\n\t<%activationUrl%>\n\nSinulla on kaksi p�iv�� aikaa k�ytt�� linkki�, t�m�n j�lkeen linkki vanhenee.");
define('_ACTIVATE_FORGOT_MAILTITLE',"Aktivoi '<%memberName%>' tilisi uudestaan");
define('_ACTIVATE_FORGOT_TITLE',	'Tervetuloa <%memberName%>');
define('_ACTIVATE_FORGOT_TEXT',		'Valitse uusi salasana tilillesi:');
define('_ACTIVATE_CHANGE_MAIL',		"Terve <%memberName%>,\n\nKoska s�hk�postiosoitteesi on vaihtunut, sinun tulee aktivoida tilisi uudelleen sivustolle <%siteName%> (<%siteUrl%>).\nVoit tehd� t�m�n oheisella linkill�: \n\n\t<%activationUrl%>\n\nSinulla on kaksi p�iv�� aikaa tehd� n�in, t�m�n j�lkeen linkki menee vanhaksi.");
define('_ACTIVATE_CHANGE_MAILTITLE',"Aktivoi tilisi '<%memberName%>' uudestaan");
define('_ACTIVATE_CHANGE_TITLE',	'Tervetuloa <%memberName%>');
define('_ACTIVATE_CHANGE_TEXT',		'Osoitteesi on tarkistettu. Kiitokset!');
define('_ACTIVATE_SUCCESS_TITLE',	'Onnistunut aktivointi');
define('_ACTIVATE_SUCCESS_TEXT',	'Tilisi on aktivoitu onnistuneesti.');
define('_MEMBERS_SETPWD',			'Aseta salasana');
define('_MEMBERS_SETPWD_BTN',		'Aseta salasana');
define('_QMENU_ACTIVATE',			'Tilin aktivointi');
define('_QMENU_ACTIVATE_TEXT',		'<p>Kun olet aktivoinut tilisi, voit alkaa k�ytt�� sit� <a href="index.php?action=showlogin">kirjautumalla sis��n</a>.</p>');

define('_PLUGS_BTN_UPDATE',			'P�ivit� laajennuslista');

// global settings 
define('_SETTINGS_JSTOOLBAR',		'Javascript valikon tyyli');
define('_SETTINGS_JSTOOLBAR_FULL',	'T�ydellinen valikko (IE)');
define('_SETTINGS_JSTOOLBAR_SIMPLE','Yksinkertainen valikko (Non-IE)');
define('_SETTINGS_JSTOOLBAR_NONE',	'Poista valikko k�yt�st�');
define('_SETTINGS_URLMODE_HELP',	'(Lis�tietoja: <a href="documentation/tips.html#searchengines-fancyurls">How to activate fancy URLs</a>)');

// extra plugin settings part when editing categories/members/blogs/...
define('_PLUGINS_EXTRA',			'Laajennuksen lis�asetukset');

// itemlist info column keys
define('_LIST_ITEM_BLOG',			'blog:');
define('_LIST_ITEM_CAT',			'cat:');
define('_LIST_ITEM_AUTHOR',			'author:');
define('_LIST_ITEM_DATE',			'date:');
define('_LIST_ITEM_TIME',			'time:');

// indication of registered members in comments list
define('_LIST_COMMENTS_MEMBER', 	'(j�sen)');

// batch operations
define('_BATCH_WITH_SEL',			'Valituille:');
define('_BATCH_EXEC',				'Suorita');

// quickmenu
define('_QMENU_HOME',				'P��sivu');
define('_QMENU_ADD',				'Lis�� artikkeli');
define('_QMENU_ADD_SELECT',			'-- valitse --');
define('_QMENU_USER_SETTINGS',		'Tiedot');
define('_QMENU_USER_ITEMS',			'Artikkelit');
define('_QMENU_USER_COMMENTS',		'Kommentit');
define('_QMENU_MANAGE',				'Hallinta');
define('_QMENU_MANAGE_LOG',			'Toimintaloki');
define('_QMENU_MANAGE_SETTINGS',		'Asetukset');
define('_QMENU_MANAGE_MEMBERS',		'K�ytt�j�t');
define('_QMENU_MANAGE_NEWBLOG',		'Uusi blogi');
define('_QMENU_MANAGE_BACKUPS',		'Varmuuskopiot');
define('_QMENU_MANAGE_PLUGINS',		'Laajennukset');
define('_QMENU_LAYOUT',				'Ulkoasu');
define('_QMENU_LAYOUT_SKINS',		'Sivurungot');
define('_QMENU_LAYOUT_TEMPL',		'Asettelut');
define('_QMENU_LAYOUT_IEXPORT',		'Tuo/Vie');
define('_QMENU_PLUGINS',			'Laajennukset');

// quickmenu on logon screen
define('_QMENU_INTRO',				'Esittely');
define('_QMENU_INTRO_TEXT',			'<p>T�m� on kirjautumisruutu Nucleus-sis�ll�nhallintaj�rjestelm�n yll�pitoalueelle.</p><p>Jos sinulla on tili sivustolle, voit kirjautua sis��n ja lis�t� uusia artikkeleita tai muuttaa asetuksia.</p>');

// helppages for plugins
define('_ERROR_PLUGNOHELPFILE',		'Avustustiedostoa laajennukselle ei l�ytynyt');
define('_PLUGS_HELP_TITLE',			'Laajennuksen avustussivu');
define('_LIST_PLUGS_HELP', 			'apua');

// END changed/started after 3.1

// START changed/added after v2.5beta START

// general settings (security)
define('_SETTINGS_EXTAUTH',			'Salli ulkoinen varmennus');
define('_WARNING_EXTAUTH',			'Varoitus: salli vain jos tarvitset t�t�.');

// member profile
define('_MEMBERS_BYPASS',			'K�yt� ulkoista varmennusta');

// 'always include in search' blog setting (yes/no) [in v2.5beta, the 'always' part wasn't clear]
define('_EBLOG_SEARCH',				'Sis�llyt� <em>aina</em> hakuun');

// END changed/added after v2.5beta


// START introduced after v2.0 START

// media library
define('_MEDIA_VIEW',				'Tarkastele');
define('_MEDIA_VIEW_TT',			'Tarkastele tiedostoa (avautuu uuteen ikkunaan)');
define('_MEDIA_FILTER_APPLY',		'Ota suodatin k�ytt��n');
define('_MEDIA_FILTER_LABEL',		'Suodatin: ');
define('_MEDIA_UPLOAD_TO',			'L�het�...');
define('_MEDIA_UPLOAD_NEW',			'L�het� uusi tiedosto...');
define('_MEDIA_COLLECTION_SELECT',	'Valitse');
define('_MEDIA_COLLECTION_TT',		'Vaihda t�h�n kategoriaan');
define('_MEDIA_COLLECTION_LABEL',	'Valittu kokoelma: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'Tasaa vasemmalle');
define('_ADD_ALIGNRIGHT_TT',		'Tasaa oikealle');
define('_ADD_ALIGNCENTER_TT',		'Keskit�');

// searchable blog setting (yes/no)
define('_EBLOG_SEARCH',				'Sis�llyt� hakuun');

// generic upload failure
define('_ERROR_UPLOADFAILED',		'L�hetys ep�onnistui');

// END introduced after v2.0 END


// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'Salli menneille p�iville postitus');
define('_ADD_CHANGEDATE',			'P�ivit� aikaleima');
define('_BMLET_CHANGEDATE',			'P�ivit� aikaleima');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'Tuominen / vieminen...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Normaali');
define('_PARSER_INCMODE_SKINDIR',	'K�yt� sivurunkohakemistoa');
define('_SKIN_INCLUDE_MODE',		'Moodi');
define('_SKIN_INCLUDE_PREFIX',		'Etuliite');

// global settings
define('_SETTINGS_BASESKIN',		'Perussivurunko');
define('_SETTINGS_SKINSURL',		'Perussivurunkojen URL');
define('_SETTINGS_ACTIONSURL',		'Koko URL action.php:lle');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'Vakiokategoriaa ei voi siirt��');
define('_ERROR_MOVETOSELF',			'Kategoriaa ei voi voida siirt�� (kohdeblogi on sama kuin l�hdeblogi)');
define('_MOVECAT_TITLE',			'Valitse blogi johon kategoria siirret��n');
define('_MOVECAT_BTN',				'Siirr� kategoria');

// URLMode setting
define('_SETTINGS_URLMODE',			'URL moodi');
define('_SETTINGS_URLMODE_NORMAL',	'Normaali');
define('_SETTINGS_URLMODE_PATHINFO','Tarkka');

// Batch operations
define('_BATCH_NOSELECTION',		'Ei valintoja, joihin kohdistuu toimintoja');
define('_BATCH_ITEMS',				'Joukkotoiminne blogiartikkeleille');
define('_BATCH_CATEGORIES',			'Joukkotoiminne kategorioille');
define('_BATCH_MEMBERS',			'Joukkotoiminne j�senille');
define('_BATCH_TEAM',				'Joukkotoiminne hallintaryhmille');
define('_BATCH_COMMENTS',			'Joukkotoiminne kommenteille');
define('_BATCH_UNKNOWN',			'Tuntematon joukkotoiminne: ');
define('_BATCH_EXECUTING',			'Suorittaa..');
define('_BATCH_ONCATEGORY',			'kategorialle');
define('_BATCH_ONITEM',				'blogiartikkelille');
define('_BATCH_ONCOMMENT',			'kommentille');
define('_BATCH_ONMEMBER',			'j�senelle');
define('_BATCH_ONTEAM',				'hallintaryhm�n j�senelle');
define('_BATCH_SUCCESS',			'Onnistui!');
define('_BATCH_DONE',				'Valmis!');
define('_BATCH_DELETE_CONFIRM',		'Vahvista joukkopoistaminen');
define('_BATCH_DELETE_CONFIRM_BTN',	'Vahvista joukkopoistaminen');
define('_BATCH_SELECTALL',			'valitse kaikki');
define('_BATCH_DESELECTALL',		'poista valinnat');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'Poista');
define('_BATCH_ITEM_MOVE',			'Siirr�');
define('_BATCH_MEMBER_DELETE',		'Poista');
define('_BATCH_MEMBER_SET_ADM',		'Anna j�rjestelm�nvalvojan oikeudet');
define('_BATCH_MEMBER_UNSET_ADM',	'Ota pois j�rjestelm�nvalvojan oikeudet');
define('_BATCH_TEAM_DELETE',		'Poista hallintaryhm�st�');
define('_BATCH_TEAM_SET_ADM',		'Anna j�rjestelm�nvalvojan oikeudet');
define('_BATCH_TEAM_UNSET_ADM',		'Ota pois j�rjestelm�nvalvojan oikeudet');
define('_BATCH_CAT_DELETE',			'Poista');
define('_BATCH_CAT_MOVE',			'Siirr�� toiseen blogiin');
define('_BATCH_COMMENT_DELETE',		'Poista');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'Lis�� uusi blogiartikkeli...');
define('_ADD_PLUGIN_EXTRAS',		'Laajennuksen lis�valinnat');

// errors
define('_ERROR_CATCREATEFAIL',		'Ei pystytty luomaan uutta kategoriaa');
define('_ERROR_NUCLEUSVERSIONREQ',	'T�m� laajennus vaatii uudemman Nucleuksen version: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Takaisin blogiasetuksiin');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Tuo');
define('_SKINIE_TITLE_EXPORT',		'Vie');
define('_SKINIE_BTN_IMPORT',		'Tuo valitut sivurungot / asettelut');
define('_SKINIE_BTN_EXPORT',		'Vie valitut sivurungot / asettelut');
define('_SKINIE_LOCAL',				'Tuo paikallisesta tiedostosta:');
define('_SKINIE_NOCANDIDATES',		'Ei ehdokkaita tuotavaksi sivurunko -hakemistossa');
define('_SKINIE_FROMURL',			'Tuo URL:sta:');
define('_SKINIE_EXPORT_INTRO',		'Valitse sivurungot ja asettelut, jotka haluavat vied�');
define('_SKINIE_EXPORT_SKINS',		'Sivurungot');
define('_SKINIE_EXPORT_TEMPLATES',	'Asettelut');
define('_SKINIE_EXPORT_EXTRA',		'Lis�tietoa');
define('_SKINIE_CONFIRM_OVERWRITE',	'Ylikirjoita sivurungot, jotka ovat jo olemassa (katso nimien p��llekk�isyydet)');
define('_SKINIE_CONFIRM_IMPORT',	'Kyll�, haluan tuoda t�m�n ');
define('_SKINIE_CONFIRM_TITLE',		'Valmis tuomaan sivurungon ja asettelut');
define('_SKINIE_INFO_SKINS',		'Sivurungot tiedostossa:');
define('_SKINIE_INFO_TEMPLATES',	'Asettelut tiedostossa:');
define('_SKINIE_INFO_GENERAL',		'Tietoa:');
define('_SKINIE_INFO_SKINCLASH',	'Sivirunkonimien p��llekk�isyydet:');
define('_SKINIE_INFO_TEMPLCLASH',	'Asettelunimien p��llekk�isyydet:');
define('_SKINIE_INFO_IMPORTEDSKINS','Tuodut sivurungot:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Tuodut asettelut:');
define('_SKINIE_DONE',				'Tuominen valmis');

define('_AND',						'ja');
define('_OR',						'tai');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'tyhj� kentt� (klikkaa editoidaksesi)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'IncludeMode:');
define('_LIST_SKINS_INCPREFIX',		'IncludePrefix:');
define('_LIST_SKINS_DEFINED',		'M��ritellyt osat:');

// backup
define('_BACKUPS_TITLE',			'Varmuuskopioi / Palauta');
define('_BACKUP_TITLE',				'Varmuuskopioi');
define('_BACKUP_INTRO',				'Klikkaa alla olevaa painiketta luodaksesi varmuuskopion Nucleus-tietokannastasi. Tallennusikkuna tulee esiin ja voit valita minne haluat tallettaa varmuuskopiotiedoston. S�il� se varmaan paikkaan.');
define('_BACKUP_ZIP_YES',			'Yrit� k�ytt�� tiedonpakkausta');
define('_BACKUP_ZIP_NO',			'�l� k�yt� tiedonpakkausta');
define('_BACKUP_BTN',				'Luo varmuuskopio');
define('_BACKUP_NOTE',				'<b>Huomaa:</b> Vain tietokannan sis�lt� on talletettuna varmuuskopioon. Mediatiedostot ja asetukset tiedostossa config.php <b>eiv�t</b> t�ten sis�lly varmuuskopioon.');
define('_RESTORE_TITLE',			'Palauta');
define('_RESTORE_NOTE',				'<b>VAROITUS:</b> Varmuuskopiosta palauttaminen tulee <b>TYHJENT�M��N</b> kaiken nykyisen Nucleus-tietokannan kokonaan! �l� jatka ellet ole ehdottoman varma siit� mit� olet tekem�ss�!	<br />	<b>Huom!</b> Varmista, ett� Nucleuksen versio, jossa varmuuskopion loit, pit�isi olla sama kuin versio, jota k�yt�t juuri nyt! Muuten se ei toimi.');
define('_RESTORE_INTRO',			'Valitse varmuuskopiotiedosto alta (se tullaan lataamaan serverille) ja klikkaa "Palauta tiedostosta" -painiketta aloittaaksesi.');
define('_RESTORE_IMSURE',			'Kyll�, olen varma, ett� haluan tehd� t�m�n!');
define('_RESTORE_BTN',				'Palauta tiedostosta');
define('_RESTORE_WARNING',			'(varmista, ett� olet palauttamassa oikeaa varmuuskopiota. Kenties kannattaisi tehd� uusi varmuuskopio ennen kuin aloitat...)');
define('_ERROR_BACKUP_NOTSURE',		'Sinun t�ytyy ruksittaa \'Olen varma, ett� haluan tehd� t�m�n\' -kohta');
define('_RESTORE_COMPLETE',			'Palautus valmis');

// new item notification
define('_NOTIFY_NI_MSG',			'Uusi blogiartikkeli on postitettu:');
define('_NOTIFY_NI_TITLE',			'Uusi blogiartikkeli!');
define('_NOTIFY_KV_MSG',			'Karma-��nest� blogiartikkelia:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'Kommentoi blogiartikkelia:');
define('_NOTIFY_NC_TITLE',			'Nucleus kommentti:');
define('_NOTIFY_USERID',			'K�ytt�j�n ID:');
define('_NOTIFY_USER',				'K�ytt�j�:');
define('_NOTIFY_COMMENT',			'Kommentti:');
define('_NOTIFY_VOTE',				'��nestys:');
define('_NOTIFY_HOST',				'Host:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'J�sen:');
define('_NOTIFY_TITLE',				'Otsikko:');
define('_NOTIFY_CONTENTS',			'Sis�lt�:');

// member mail message
define('_MMAIL_MSG',				'Viesti sinulle, jonka on l�hett�nyt');
define('_MMAIL_FROMANON',			'nimet�n vierailija');
define('_MMAIL_FROMNUC',			'Postitettu Nucleus weblogista osoitteessa');
define('_MMAIL_TITLE',				'Viesti j�senelt�');
define('_MMAIL_MAIL',				'Viesti:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'Lis�� artikkeli');
define('_BMLET_EDIT',				'Muokkaa artikkelia');
define('_BMLET_DELETE',				'Poista artikkeli');
define('_BMLET_BODY',				'Sis�lt�');
define('_BMLET_MORE',				'Laajennettu');
define('_BMLET_OPTIONS',			'Optiot');
define('_BMLET_PREVIEW',			'Esikatselu');

// used in bookmarklet
define('_ITEM_UPDATED',				'Artikkeli p�ivitetty');
define('_ITEM_DELETED',				'Artikkeli poistettu');

// plugins
define('_CONFIRMTXT_PLUGIN',		'Oletko varma, ett� haluat poistaa laajennuksen nimelt�');
define('_ERROR_NOSUCHPLUGIN',		'Kyseist� laajennusta ei ole');
define('_ERROR_DUPPLUGIN',			'T�m� laajennus on jo asennettu');
define('_ERROR_PLUGFILEERROR',		'Kyseist� laajennusta ei ole, tai oikeudet ovat v��rin asetetut');
define('_PLUGS_NOCANDIDATES',		'Haluttuja laajennuksia ei l�ytynyt');

define('_PLUGS_TITLE_MANAGE',		'Laajennustenhallinta');
define('_PLUGS_TITLE_INSTALLED',	'Asennetut laajennukset');
define('_PLUGS_TITLE_UPDATE',		'P�ivit� tapahtumalistaa');
define('_PLUGS_TEXT_UPDATE',		'Nucleus pit�� yll� listaa laajennusten tapahtumatilauksista. Kun p�ivit�t laajennuksen ylikirjoittamalla sen tiedoston, sinun t�ytyisi ajaa t�m� p�ivitys varmistaaksesi, ett� listassa olisi oikeat tilaukset');
define('_PLUGS_TITLE_NEW',			'Asenna uusi laajennus');
define('_PLUGS_ADD_TEXT',			'Alla on lista kaikista tiedostoista Plugins -hakemistossasi, jotka voivat olla laajennuksia, joita ei viel� ole asennettu. Varmista ett� olet <strong>aivan varma</strong>, ett� kyseess� on laajennus, ennen kuin lis��t sen.');
define('_PLUGS_BTN_INSTALL',		'Asenna laajennus');
define('_BACKTOOVERVIEW',			'Takaisin');

// editlink
define('_TEMPLATE_EDITLINK',		'Muokkaa artikkelia -linkki');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'Lis�� vasen palsta');
define('_ADD_RIGHT_TT',				'Lis�� oikea palsta');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'Uusi kategoria');

// new settings
define('_SETTINGS_PLUGINURL',		'Laajennuksen osoite (URL)');
define('_SETTINGS_MAXUPLOADSIZE',	'L�hetetyn tiedoston maksimikoko (bittein�)');
define('_SETTINGS_NONMEMBERMSGS',	'Salli ei-j�senten l�hett�� viestej�');
define('_SETTINGS_PROTECTMEMNAMES',	'Suojaa j�senten nimet');

// overview screen
define('_OVERVIEW_PLUGINS',			'Laajennuksien hallinta');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'Uuden j�senen rekister�inti:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'S�hk�postiosoitteesi:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'Sinulla ei ole yll�pit�j�n oikeuksia mihink��n blogiin, joilla on kohdej�sen listallaan. T�ten, et ole oikeutettu l�hett�m��n tiedostoja t�m�n j�senen media -hakemistoon');

// plugin list
define('_LISTS_INFO',				'Tiedot');
define('_LIST_PLUGS_AUTHOR',		'Tekij�:');
define('_LIST_PLUGS_VER',			'Versio:');
define('_LIST_PLUGS_SITE',			'WWW-sivut');
define('_LIST_PLUGS_DESC',			'Kuvaus');
define('_LIST_PLUGS_SUBS',			'Liittyy seuraaviin tapahtumiin:');
define('_LIST_PLUGS_UP',			'Siirr� yl�s');
define('_LIST_PLUGS_DOWN',			'Siirr� alas');
define('_LIST_PLUGS_UNINSTALL',		'Poista&nbsp;installointi');
define('_LIST_PLUGS_ADMIN',			'Yll�pito');
define('_LIST_PLUGS_OPTIONS',		'S��d�&nbsp;asetuksia');

// plugin option list
define('_LISTS_VALUE',				'Arvo');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'T�ll� laajennuksella ei ole asetuksia s��dett�v�n�
');
define('_PLUGS_BACK',				'Takaisin Laajennukset -sivulle');
define('_PLUGS_SAVE',				'Tallenna asetukset');
define('_PLUGS_OPTIONS_UPDATED',	'Laajennuksen asetukset p�ivitetty');

define('_OVERVIEW_MANAGEMENT',		'Hallinta');
define('_OVERVIEW_MANAGE',			'Nucleuksen hallinta...');
define('_MANAGE_GENERAL',			'Yleinen hallinta');
define('_MANAGE_SKINS',				'Sivurungot ja asettelut');
define('_MANAGE_EXTRA',				'Lis�ominaisuudet');

define('_BACKTOMANAGE',				'Takaisin Nucleuksen hallintaan');


// END introduced after v1.1 END




// charset to use 
define('_CHARSET',					'iso-8859-1');

// global stuff
define('_LOGOUT',					'Kirjaudu ulos');
define('_LOGIN',					'Kirjaudu sis��n');
define('_YES',						'Kyll�');
define('_NO',						'Ei');
define('_SUBMIT',					'L�het�');
define('_ERROR',					'Virhe');
define('_ERRORMSG',					'Virhe esiintyi!');
define('_BACK',						'Takaisin');
define('_NOTLOGGEDIN',				'Et ole kirjautunut sis��n');
define('_LOGGEDINAS',				'Olet kirjautunut sis��n tunnuksella');
define('_ADMINHOME',				'J�rjestelm�nvalvoja-asetukset');
define('_NAME',						'Nimi');
define('_BACKHOME',					'Takaisin j�rjestelm�nvalvoja-asetuksiin');
define('_BADACTION',				'Pyydetty� toimintoa ei ole');
define('_MESSAGE',					'Viesti');
define('_HELP_TT',					'Apua!');
define('_YOURSITE',					'Sivustosi');


define('_POPUP_CLOSE',				'Sulje ikkuna');

define('_LOGIN_PLEASE',				'Kirjaudu ensin sis��n');

// commentform
define('_COMMENTFORM_YOUARE',		'Olet');
define('_COMMENTFORM_SUBMIT',		'Lis�� kommentti');
define('_COMMENTFORM_COMMENT',		'Kommenttisi');
define('_COMMENTFORM_NAME',			'Nimi');
define('_COMMENTFORM_MAIL',			'S�hk�postiosoite tai WWW-osoite');
define('_COMMENTFORM_REMEMBER',		'Muista minut');

// loginform
define('_LOGINFORM_NAME',			'Tunnus');
define('_LOGINFORM_PWD',			'Salasana');
define('_LOGINFORM_YOUARE',			'Olet kirjautuneena<br />sis��n tunnuksella<br />');
define('_LOGINFORM_SHARED',			'Usean k�ytt�j�n tietokone');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'L�het� viesti');

// search form
define('_SEARCHFORM_SUBMIT',		'Etsi');

// add item form
define('_ADD_ADDTO',				'Uusi artikkeli blogiin ');
define('_ADD_CREATENEW',			'Luo uusi artikkeli');
define('_ADD_BODY',					'Sis�lt�');
define('_ADD_TITLE',				'Otsikko');
define('_ADD_MORE',					'Laajennettu (optionaalinen)');
define('_ADD_CATEGORY',				'Kategoria');
define('_ADD_PREVIEW',				'Esikatselu');
define('_ADD_DISABLE_COMMENTS',		'Kommentit pois k�yt�st�?');
define('_ADD_DRAFTNFUTURE',			'Vedos &amp; tulevat artikkelit');
define('_ADD_ADDITEM',				'Lis�� artikkeli');
define('_ADD_ADDNOW',				'Lis�� nyt');
define('_ADD_ADDLATER',				'Lis�� my�hemmin');
define('_ADD_PLACE_ON',				'Place on');
define('_ADD_ADDDRAFT',				'Lis�� vedoksiin');
define('_ADD_NOPASTDATES',			'(Menneet p�iv�ykset ja kellonajat EIV�T kelpaa, k�yt� meneill��n olevaa aikaa.)');
define('_ADD_BOLD_TT',				'Lihavoitu');
define('_ADD_ITALIC_TT',			'Kursivoitu');
define('_ADD_HREF_TT',				'Luo linkki');
define('_ADD_MEDIA_TT',				'Lis�� media');
define('_ADD_PREVIEW_TT',			'N�yt�/Piilota esikatselu');
define('_ADD_CUT_TT',				'Leikkaa');
define('_ADD_COPY_TT',				'Kopioi');
define('_ADD_PASTE_TT',				'Liit�');


// edit item form
define('_EDIT_ITEM',				'Muokkaa artikkelia');
define('_EDIT_SUBMIT',				'Muokkaa');
define('_EDIT_ORIG_AUTHOR',			'Alkuper�inen kirjoittaja');
define('_EDIT_BACKTODRAFTS',		'Tallenna takaisin vedokseen');
define('_EDIT_COMMENTSNOTE',		'(huomaa: kommenttien pois p��lt� kytkeminen _ei_ piilota aiemmin lis�ttyj� kommentteja)');

// used on delete screens
define('_DELETE_CONFIRM',			'Varmista poistaminen');
define('_DELETE_CONFIRM_BTN',		'Varmista poistaminen');
define('_CONFIRMTXT_ITEM',			'Olet poistamassa seuraavan artikkelin:');
define('_CONFIRMTXT_COMMENT',		'Olet poistamassa seuraavan kommentin:');
define('_CONFIRMTXT_TEAM1',			'Olet poistamassa ');
define('_CONFIRMTXT_TEAM2',			' blogin hallintaryhm�ss� ');
define('_CONFIRMTXT_BLOG',			'Olet poistamassa blogia: ');
define('_WARNINGTXT_BLOGDEL',		'Varoitus! Blogin poisto tulee tuhoamaan kaikki artikkelit ja kommentit kyseisess� blogissa. Vahvista ett� olet AIVAN VARMA siit� mit� olet tekem�ss�!<br />�l� my�sk��n keskeyt� Nucleusta sen poistaessa blogiasi.');
define('_CONFIRMTXT_MEMBER',		'Olet poistamassa seuraavan k�ytt�j�n profiilin: ');
define('_CONFIRMTXT_TEMPLATE',		'Olet poistamassa sivuasetuksen nimelt� ');
define('_CONFIRMTXT_SKIN',			'Olet poistamassa sivurungon nimelt� ');
define('_CONFIRMTXT_BAN',			'Olet poistamassa eston ip-osoitteelle ');
define('_CONFIRMTXT_CATEGORY',		'Olet poistamassa kategorian ');

// some status messages
define('_DELETED_ITEM',				'Artikkeli poistettu');
define('_DELETED_MEMBER',			'K�ytt�j� poistettu');
define('_DELETED_COMMENT',			'Kommentti poistettu');
define('_DELETED_BLOG',				'Blogi poistettu');
define('_DELETED_CATEGORY',			'Kategoria poistettu');
define('_ITEM_MOVED',				'Artikkeli siirretty');
define('_ITEM_ADDED',				'Artikkeli lis�tty');
define('_COMMENT_UPDATED',			'Kommentti p�ivitetty');
define('_SKIN_UPDATED',				'Sivurunkodata on tallennettu');
define('_TEMPLATE_UPDATED',			'Asettelu on tallennettu');

// errors
define('_ERROR_COMMENT_LONGWORD',	'�l� k�yt� yli 60 merkki� pitki� sanoja kommenteissasi');
define('_ERROR_COMMENT_NOCOMMENT',	'Kommentti puuttuu');
define('_ERROR_COMMENT_NOUSERNAME',	'Nimi puuttuu');
define('_ERROR_COMMENT_TOOLONG',	'Kommenttisi on liian pitk� (max. 5000 merkki�)');
define('_ERROR_COMMENTS_DISABLED',	'Kommentointimahdollisuus t�lle blogille on pois k�yt�st�.');
define('_ERROR_COMMENTS_NONPUBLIC',	'Sinun t�ytyy olla kirjautunut k�ytt�j� lis�t�ksesi kommentin t�h�n blogiin');
define('_ERROR_COMMENTS_MEMBERNICK','Tunnus, jota haluat k�ytt�� l�hett��ksesi kommentin on register�ityneen k�ytt�j�n k�yt�ss�. Valitse jokin toinen tunnus.');
define('_ERROR_SKIN',				'Sivurunkovirhe');
define('_ERROR_ITEMCLOSED',			'T�m� artikkeli on suljettu, et voi lis�t� uusia kommentteja siihen tai ��nest�� siin�');
define('_ERROR_NOSUCHITEM',			'Kyseist� artikkelia ei ole');
define('_ERROR_NOSUCHBLOG',			'Kyseist� blogia ei ole');
define('_ERROR_NOSUCHSKIN',			'Kyseist� sivurunkoa ei ole');
define('_ERROR_NOSUCHMEMBER',		'Kyseist� k�ytt�j�� ei ole');
define('_ERROR_NOTONTEAM',			'Et ole t�m�n webblogin hallintaryhm�ss�.');
define('_ERROR_BADDESTBLOG',		'Kohdeblogia ei ole');
define('_ERROR_NOTONDESTTEAM',		'Artikkelia ei voi siirt��, sill� et ole kohdeblogin hallintaryhm�ss�');
define('_ERROR_NOEMPTYITEMS',		'Tyhji� artikkeleita ei voi lis�t�!');
define('_ERROR_BADMAILADDRESS',		'S�hk�postiosoite ei ole kelvollinen');
define('_ERROR_BADNOTIFY',			'Yksi (tai useampi) annettu s�hk�posti-ilmoitusosoite on ep�kelpo s�hk�postiosoite');
define('_ERROR_BADNAME',			'Nimi ei ole hyv�ksytt�v� (vain a-z ja 0-9 ovat hyv�ksytt�vi� merkkej�, ei v�lily�ntej� alussa eik� lopussa)');
define('_ERROR_NICKNAMEINUSE',		'Jo register�itynyt k�ytt�� k�ytt�� jo kyseist� nime�');
define('_ERROR_PASSWORDMISMATCH',	'Salasanojen t�ytyy olla samoja');
define('_ERROR_PASSWORDTOOSHORT',	'Salasanan pit�isi olla ainakin 6 merkki� pitk�');
define('_ERROR_PASSWORDMISSING',	'Salasana on valittava');
define('_ERROR_REALNAMEMISSING',	'Sinun t�ytyy antaa oikea nimesi');
define('_ERROR_ATLEASTONEADMIN',	'Aina pit�isi olla ainakin yksi ylij�rjestelm�nvalvoja, joka voi kirjautua j�rjestelm�nvalvoja alueelle.');
define('_ERROR_ATLEASTONEBLOGADMIN','T�m� toiminnon suorittaminen j�tt�isi blogisi mahdottomaksi yll�pit��. Varmista ett� j�rjestelm�nvalvojia on ainakin yksi.');
define('_ERROR_ALREADYONTEAM',		'Et voi lis�t� k�ytt�j�� joka on jo hallintaryhm�ss�');
define('_ERROR_BADSHORTBLOGNAME',	'Blogin id-nimi saisi sis�lt�� vain merkkej� a-z ja 0-9, ilman v�lily�ntej�');
define('_ERROR_DUPSHORTBLOGNAME',	'Toisella blogilla on jo valittu id-nimi. N�iden nimien tulisi erota toisistaan');
define('_ERROR_UPDATEFILE',			'P�ivitystiedostoon ei voi saada kirjoitusoikeutta. Tarkista ett� tiedosto-oikeudet ovat ok (kokeile chmod 666). Huomaa my�s, ett� sijainti on suhteellinen j�rjestelm�nvalvoja hakemistoon n�hden, joten saattanet haluta k�ytt�� absoluuttista polkua (kuten /sinun/polkusi/nucleukseen/)');
define('_ERROR_DELDEFBLOG',			'Oletusblogia ei voi poistaa');
define('_ERROR_DELETEMEMBER',		'K�ytt�j�� ei voi poistaa, koska h�n on kirjoittanut artikkeleita ja/tai kommentteja tietokantaan');
define('_ERROR_BADTEMPLATENAME',	'Sivuasetukselle antamasi nimi ei kelpaa. K�yt� vain merkkej� a-z ja 0-9, ilman v�lily�ntej�');
define('_ERROR_DUPTEMPLATENAME',	'Toinen asettelu k�ytt�� jo t�t� nime�');
define('_ERROR_BADSKINNAME',		'Ep�kelpo nimi sivurungolle (k�yt� vain merkkej� a-z ja 0-9, ilman v�lily�ntej�)');
define('_ERROR_DUPSKINNAME',		'Toinen sivurunko t�ll� nimell� on jo olemassa');
define('_ERROR_DEFAULTSKIN',		'Sivurunko nimelt� "default" t�ytyy olla olemassa');
define('_ERROR_SKINDEFDELETE',		'Sivurunkoa ei voi poistaa, koska se on vakiosivurunko seuraavalle weblogille: ');
define('_ERROR_DISALLOWED',			'Valitettavasti et ole oikeutettu suorittamaan t�t� toimintoa');
define('_ERROR_DELETEBAN',			'Virhe poistettaessa estoa (estoa ei ole olemassa)');
define('_ERROR_ADDBAN',				'Virhe lis�tt�ess� estoa. Estoa ei ehkei ole lis�tty oikein kaikissa blogeissasi.');
define('_ERROR_BADACTION',			'Pyydetty� toimintoa ei ole');
define('_ERROR_MEMBERMAILDISABLED',	'K�ytt�j�lt� k�ytt�j�lle -viestit ovat poissa k�yt�st�');
define('_ERROR_MEMBERCREATEDISABLED','K�ytt�jien luomismahdollisuus on poissa k�yt�st�');
define('_ERROR_INCORRECTEMAIL',		'Ep�kelpo osoite');
define('_ERROR_VOTEDBEFORE',		'Olet jo antanut ��nesi t�lle artikkelille');
define('_ERROR_BANNED1',			'Toimintoa ei voi suorittaa johtuen siit�, ett� (esto ip:lle ');
define('_ERROR_BANNED2',			') olet estetty tekem�st� niin. Viesti oli: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'Sinun t�ytyy olla kirjautunut sis��n suorittaaksesi t�m�n toiminnon');
define('_ERROR_CONNECT',			'Yhdist�misvirhe');
define('_ERROR_FILE_TOO_BIG',		'Tiedosto on liian iso!');
define('_ERROR_BADFILETYPE',		'Valitettavasti t�m� tiedostotyyppi ei ole sallittujen joukossa');
define('_ERROR_BADREQUEST',			'Ep�kelpo tiedostonsiirto-pyynt�');
define('_ERROR_DISALLOWEDUPLOAD',	'Et ole mink��n weblogin hallintaryhm�ss�. T�ten, et ole oikeutettu l�hett�m��n tiedostoja blogiin');
define('_ERROR_BADPERMISSIONS',		'Tiedosto/hakemisto -oikeudet eiv�t ole oikein asetetut');
define('_ERROR_UPLOADMOVEP',		'Virhe tiedostoa siirrett�ess�');
define('_ERROR_UPLOADCOPY',			'Virhe tiedostoa kopioidessa');
define('_ERROR_UPLOADDUPLICATE',	'Toinen samanniminen tiedosto on jo olemassa. Kokeile sen uudelleennime�st� ennen tiedostonsiirtoa.');
define('_ERROR_LOGINDISALLOWED',	'Valitettavasti et ole oikeutettu kirjautumaan j�rjestelm�nvalvoja alueelle. Toisaalta, voit kirjautua sis��n toisena k�ytt�j�n�');
define('_ERROR_DBCONNECT',			'MySQL-palvelimeen ei saatu yhteytt�');
define('_ERROR_DBSELECT',			'Nucleus tietokantaa ei voitu valita.');
define('_ERROR_NOSUCHLANGUAGE',		'Kyseist� kielitiedostoa ei ole olemassa');
define('_ERROR_NOSUCHCATEGORY',		'Kyseist� kategoriaa ei ole olemassa');
define('_ERROR_DELETELASTCATEGORY',	'Ainakin yksi kategoria t�ytyy olla olemassa');
define('_ERROR_DELETEDEFCATEGORY',	'Vakiokategoriaa ei voi tuhota');
define('_ERROR_BADCATEGORYNAME',	'Ep�kelpo kategorian nimi');
define('_ERROR_DUPCATEGORYNAME',	'Toinen samanniminen kategoria samaisella nimell� on jo olemassa');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'Varoitus: Nykyinen arvo ei ole hakemisto!');
define('_WARNING_NOTREADABLE',		'Varoitus: Nykyinen arvo on ei-lukuoikeudellinen hakemisto!');
define('_WARNING_NOTWRITABLE',		'Varoitus: Nykyinen arvo EI ole kirjoitusoikeudellinen hakemisto!');

// media and upload
define('_MEDIA_UPLOADLINK',			'L�het� uusi tiedosto');
define('_MEDIA_MODIFIED',			'muokattu');
define('_MEDIA_FILENAME',			'tiedoston nimi');
define('_MEDIA_DIMENSIONS',			'mittasuhteet');
define('_MEDIA_INLINE',				'Inline');
define('_MEDIA_POPUP',				'Popup');
define('_UPLOAD_TITLE',				'Valitse tiedosto');
define('_UPLOAD_MSG',				'Valitse alta tiedosto, jonka haluat l�hett�� ja paina \'Lataa\' nappia.');
define('_UPLOAD_BUTTON',			'L�het�');

// some status messages
define('_MSG_ACCOUNTCREATED',		'K�ytt�j�tili luotu, salasana l�hetet��n s�hk�postitse');
define('_MSG_PASSWORDSENT',			'Salasana on l�hetetty� s�hk�postitse.');
define('_MSG_LOGINAGAIN',			'Sinun t�ytyy kirjautua sis��n uudelleen, johtuen vaihtuneista tiedoista');
define('_MSG_SETTINGSCHANGED',		'Asetuksia muutettu');
define('_MSG_ADMINCHANGED',			'J�rjestelm�nvalvoja muutettu');
define('_MSG_NEWBLOG',				'Uusi blogi luotu');
define('_MSG_ACTIONLOGCLEARED',		'Toimintologi tyhjennetty');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'Ei hyv�ksytt�v� toiminto: ');
define('_ACTIONLOG_PWDREMINDERSENT','Uusi salasana on l�hetetty k�ytt�j�lle ');
define('_ACTIONLOG_TITLE',			'Toimintologi');
define('_ACTIONLOG_CLEAR_TITLE',	'Tyhjenn� toimintologi');
define('_ACTIONLOG_CLEAR_TEXT',		'Tyhjenn� toimintologi nyt');

// team management
define('_TEAM_TITLE',				'K�sittele blogin hallintaryhm�� ');
define('_TEAM_CURRENT',				'Nykyinen hallintaryhm�');
define('_TEAM_ADDNEW',				'Lis�� uusi k�ytt�j� hallintaryhm��n');
define('_TEAM_CHOOSEMEMBER',		'Valitse k�ytt�j�');
define('_TEAM_ADMIN',				'Yll�pit�j�n oikeudet? ');
define('_TEAM_ADD',					'Lis�� hallintaryhm��n');
define('_TEAM_ADD_BTN',				'Lis�� hallintaryhm��n');

// blogsettings
define('_EBLOG_TITLE',				'S��d� asetuksia blogiin');
define('_EBLOG_TEAM_TITLE',			'K�sittele hallintaryhm��');
define('_EBLOG_TEAM_TEXT',			'Klikkaa t�st� k�sitell�ksesi hallintaryhm��si.');
define('_EBLOG_SETTINGS_TITLE',		'Blogin asetukset');
define('_EBLOG_NAME',				'Blogin nimi');
define('_EBLOG_SHORTNAME',			'Blogin id-nimi');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(saisi sis�lt�� vain merkkej� a-z ja 0-9, ilman v�lily�ntej�)');
define('_EBLOG_DESC',				'Blogin kuvaus');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'Vakiosivurunko');
define('_EBLOG_DEFCAT',				'Vakiokategoria');
define('_EBLOG_LINEBREAKS',			'Konvertoi rivinvaihdot');
define('_EBLOG_DISABLECOMMENTS',	'Kommentit sallittuja?<br /><small>(Est�m�ll� kommenttien kirjoittaminen, kommenttien lis��minen ei ole mahdollista.)</small>');
define('_EBLOG_ANONYMOUS',			'Salli kommentit ei-k�ytt�jilt�?');
define('_EBLOG_NOTIFY',				'Ilmoituss�hk�postiosoite/-osoitteet (k�yt� puolipistemerkki� ; erottajana)');
define('_EBLOG_NOTIFY_ON',			'Ilmoitukset p��ll�');
define('_EBLOG_NOTIFY_COMMENT',		'Uusista kommenteista');
define('_EBLOG_NOTIFY_KARMA',		'Uusista karma ��nestyksist�');
define('_EBLOG_NOTIFY_ITEM',		'Uusista weblogin artikkeleista');
define('_EBLOG_PING',				'Pingaa Weblogs.com p�ivityksist�?');
define('_EBLOG_MAXCOMMENTS',		'Kommenttien maksimim��r�');
define('_EBLOG_UPDATE',				'P�ivitystiedosto');
define('_EBLOG_OFFSET',				'Ajan muutos');
define('_EBLOG_STIME',				'Nykyinen serverin aika on');
define('_EBLOG_BTIME',				'Nykyinen blogin aika on');
define('_EBLOG_CHANGE',				'Muuta asetuksia');
define('_EBLOG_CHANGE_BTN',			'Muuta asetuksia');
define('_EBLOG_ADMIN',				'Blogin yll�pito');
define('_EBLOG_ADMIN_MSG',			'Sinulle asetetaan j�rjestelm�nvalvoja oikeudet');
define('_EBLOG_CREATE_TITLE',		'Uusi weblogi');
define('_EBLOG_CREATE_TEXT',		'T�yt� alla oleva kaavake luodaksesi uuden weblogin. <br /><br /> <b>Huomaa:</b> Vain tarvittavat kent�t on listattu. Jos haluat s��t�� muita optioita, siirry blogin asetussivulle weblogin luomisen j�lkeen.');
define('_EBLOG_CREATE',				'Luo!');
define('_EBLOG_CREATE_BTN',			'Luo weblogi');
define('_EBLOG_CAT_TITLE',			'Kategoriat');
define('_EBLOG_CAT_NAME',			'Kategorian nimi');
define('_EBLOG_CAT_DESC',			'Kategorian kuvaus');
define('_EBLOG_CAT_CREATE',			'Luo uusi kategoria');
define('_EBLOG_CAT_UPDATE',			'P�ivit� kategoria');
define('_EBLOG_CAT_UPDATE_BTN',		'P�ivit� kategoria');

// templates
define('_TEMPLATE_TITLE',			'Asettelut');
define('_TEMPLATE_AVAILABLE_TITLE',	'Tarjolla olevat asettelut');
define('_TEMPLATE_NEW_TITLE',		'Uusi asettelu');
define('_TEMPLATE_NAME',			'Asettelun nimi');
define('_TEMPLATE_DESC',			'Asettelun kuvaus');
define('_TEMPLATE_CREATE',			'Luo asettelu');
define('_TEMPLATE_CREATE_BTN',		'Luo asettelu');
define('_TEMPLATE_EDIT_TITLE',		'Asettelut');
define('_TEMPLATE_BACK',			'Takaisin asettelut -sivulle');
define('_TEMPLATE_EDIT_MSG',		'Kaikkia asetteluja ei tarvita. Voit j�tt�� osan tyhj�ksi.');
define('_TEMPLATE_SETTINGS',		'Asettelun asetukset');
define('_TEMPLATE_ITEMS',			'Artikkelit');
define('_TEMPLATE_ITEMHEADER',		'Artikkelin yl�tunniste');
define('_TEMPLATE_ITEMBODY',		'Artikkelin sis�lt�');
define('_TEMPLATE_ITEMFOOTER',		'Artikkelin alatunniste');
define('_TEMPLATE_MORELINK',		'Linkki laajennettuun artikkeliin');
define('_TEMPLATE_NEW',				'Uuden artikkelin merkki');
define('_TEMPLATE_COMMENTS_ANY',	'Kommentit (jos niit� on)');
define('_TEMPLATE_CHEADER',			'Kommentin yl�tunniste');
define('_TEMPLATE_CBODY',			'Kommentin sis�lt�');
define('_TEMPLATE_CFOOTER',			'Kommentin alatunniste');
define('_TEMPLATE_CONE',			'Yksi kommentti');
define('_TEMPLATE_CMANY',			'Kaksi (tai useampi) kommenttia');
define('_TEMPLATE_CMORE',			'Kommentin lue_lis��');
define('_TEMPLATE_CMEXTRA',			'K�ytt�j�extrat');
define('_TEMPLATE_COMMENTS_NONE',	'Kommentit (jos niit� ei ole)');
define('_TEMPLATE_CNONE',			'Ei kommentteja');
define('_TEMPLATE_COMMENTS_TOOMUCH','Kommentit (jos niit� on, mutta liikaa jotta ne voitaisiin n�ytt��)');
define('_TEMPLATE_CTOOMUCH',		'Liikaa kommentteja');
define('_TEMPLATE_ARCHIVELIST',		'Arkistolistaukset');
define('_TEMPLATE_AHEADER',			'Arkistolistauksen yl�tunniste');
define('_TEMPLATE_AITEM',			'Arkistolistauksen artikkeli');
define('_TEMPLATE_AFOOTER',			'Arkistolistauksen alatunniste');
define('_TEMPLATE_DATETIME',		'P�iv�ys ja kellonaika');
define('_TEMPLATE_DHEADER',			'P�iv�yksen yl�tunniste');
define('_TEMPLATE_DFOOTER',			'P�iv�yksen alatunniste');
define('_TEMPLATE_DFORMAT',			'P�iv�yksen formaatti');
define('_TEMPLATE_TFORMAT',			'Kellonajan formaatti');
define('_TEMPLATE_LOCALE',			'Paikallinen p�iv�ys');
define('_TEMPLATE_IMAGE',			'Kuva popupit');
define('_TEMPLATE_PCODE',			'Popupin linkkikoodi');
define('_TEMPLATE_ICODE',			'Inline kuvan koodi');
define('_TEMPLATE_MCODE',			'Media objektin linkkikoodi');
define('_TEMPLATE_SEARCH',			'Etsi');
define('_TEMPLATE_SHIGHLIGHT',		'Korosta');
define('_TEMPLATE_SNOTFOUND',		'Haku ei palauttanut mit��n');
define('_TEMPLATE_UPDATE',			'P�ivit�');
define('_TEMPLATE_UPDATE_BTN',		'P�ivit� asettelu');
define('_TEMPLATE_RESET_BTN',		'Resetoi data');
define('_TEMPLATE_CATEGORYLIST',	'Kategorialistaus');
define('_TEMPLATE_CATHEADER',		'Kategorialistan yl�tunniste');
define('_TEMPLATE_CATITEM',			'Kategorialistan kategoria');
define('_TEMPLATE_CATFOOTER',		'Kategorialistan alatunniste');

// skins
define('_SKIN_EDIT_TITLE',			'Sivurungot');
define('_SKIN_AVAILABLE_TITLE',		'Tarjolla olevat sivurungot');
define('_SKIN_NEW_TITLE',			'Uusi sivurunko');
define('_SKIN_NAME',				'Nimi');
define('_SKIN_DESC',				'Kuvaus');
define('_SKIN_TYPE',				'Sis�ll�n tyyppi');
define('_SKIN_CREATE',				'Luo');
define('_SKIN_CREATE_BTN',			'Luo sivurunko');
define('_SKIN_EDITONE_TITLE',		'Muokkaa sivurunkoa');
define('_SKIN_BACK',				'Takaisin sivurunko -sivulle');
define('_SKIN_PARTS_TITLE',			'Sivurungon osat');
define('_SKIN_PARTS_MSG',			'Kaikkia osia ei tarvita jokaiselle sivurungolle. J�t� tyhj�ksi ne joita et tarvitse. Valitse muokattava sivurunko alta:');
define('_SKIN_PART_MAIN',			'Artikkelit (indeksi)');
define('_SKIN_PART_ITEM',			'Yksitt�iset artikkelisivut');
define('_SKIN_PART_ALIST',			'Arkisto (indeksi)');
define('_SKIN_PART_ARCHIVE',		'Arkistolistaukset');
define('_SKIN_PART_SEARCH',			'Etsi');
define('_SKIN_PART_ERROR',			'Virheet');
define('_SKIN_PART_MEMBER',			'K�ytt�j�n tiedot');
define('_SKIN_PART_POPUP',			'Kuva popupit');
define('_SKIN_GENSETTINGS_TITLE',	'Yleiset asetukset');
define('_SKIN_CHANGE',				'Muuta');
define('_SKIN_CHANGE_BTN',			'Muuta n�it� asetuksia');
define('_SKIN_UPDATE_BTN',			'P�ivit� sivurunko');
define('_SKIN_RESET_BTN',			'Resetoi data');
define('_SKIN_EDITPART_TITLE',		'Muokkaa sivurunkoa');
define('_SKIN_GOBACK',				'Palaa takaisin');
define('_SKIN_ALLOWEDVARS',			'Sallitut muuttujat (klikkaa saadaksesi infoa):');

// global settings
define('_SETTINGS_TITLE',			'Yleiset asetukset');
define('_SETTINGS_SUB_GENERAL',		'Yleiset asetukset');
define('_SETTINGS_DEFBLOG',			'Vakioblogi');
define('_SETTINGS_ADMINMAIL',		'Yll�pit�j�n s�hk�postiosoite');
define('_SETTINGS_SITENAME',		'Sivuston nimi');
define('_SETTINGS_SITEURL',			'Sivuston URL (pit�isi loppua kauttaviivaan)');
define('_SETTINGS_ADMINURL',		'J�rjestelm�nvalvoja-alueen osoite (pit�isi loppua kauttaviivaan)');
define('_SETTINGS_DIRS',			'Nucleus -hakemisto');
define('_SETTINGS_MEDIADIR',		'Media -hakemisto');
define('_SETTINGS_SEECONFIGPHP',	'(katso config.php)');
define('_SETTINGS_MEDIAURL',		'Media URL (pit�isi loppua kauttaviivaan)');
define('_SETTINGS_ALLOWUPLOAD',		'Salli tiedostojen l�hetys blogiin?');
define('_SETTINGS_ALLOWUPLOADTYPES','Sallitut tiedostomuodot l�hett�ess�');
define('_SETTINGS_CHANGELOGIN',		'Salli k�ytt�jien vaihtaa tunnusta/salasanaa');
define('_SETTINGS_COOKIES_TITLE',	'Ev�steasetukset');
define('_SETTINGS_COOKIELIFE',		'Kirjautumisev�steen elinaika');
define('_SETTINGS_COOKIESESSION',	'Istuntoev�ste');
define('_SETTINGS_COOKIEMONTH',		'Kuukauden elinaika');
define('_SETTINGS_COOKIEPATH',		'Ev�stepolku (edistykselliset)');
define('_SETTINGS_COOKIEDOMAIN',	'Cookie Domain (edistykselliset)');
define('_SETTINGS_COOKIESECURE',	'Secure Cookie (edistykselliset)');
define('_SETTINGS_LASTVISIT',		'Tallenna edellisen k�ynnin ev�steet');
define('_SETTINGS_ALLOWCREATE',		'Salli k�ytt�jien luoda k�ytt�j�tili');
define('_SETTINGS_NEWLOGIN',		'Sis��nkirjautuminen sallittu k�ytt�j�n luomilla tileill�');
define('_SETTINGS_NEWLOGIN2',		'(koskee vain vasta luotuja tilej�)');
define('_SETTINGS_MEMBERMSGS',		'Salli k�ytt�j�lt�-k�ytt�j�lle palvelu');
define('_SETTINGS_LANGUAGE',		'Vakiokieli');
define('_SETTINGS_DISABLESITE',		'Sivusto pois k�yt�st�');
define('_SETTINGS_DBLOGIN',			'MySQL -kirjautuminen &amp; -tietokanta');
define('_SETTINGS_UPDATE',			'P�ivit� asetukset');
define('_SETTINGS_UPDATE_BTN',		'P�ivit� asetukset');
define('_SETTINGS_DISABLEJS',		'JavaScript -ty�kalurivi pois k�yt�st�');
define('_SETTINGS_MEDIA',			'Media/lataus -asetukset');
define('_SETTINGS_MEDIAPREFIX',		'P�iv�ysetuliite ladatuille tiedostoille');
define('_SETTINGS_MEMBERS',			'K�ytt�j�asetukset');

// bans
define('_BAN_TITLE',				'Estolistasi blogissa');
define('_BAN_NONE',					'Ei estoja t�lle weblogille');
define('_BAN_NEW_TITLE',			'Lis�� uusi esto');
define('_BAN_NEW_TEXT',				'Lis�� uusi esto nyt');
define('_BAN_REMOVE_TITLE',			'Poista esto');
define('_BAN_IPRANGE',				'IP-osoite');
define('_BAN_BLOGS',				'Mitk� blogit?');
define('_BAN_DELETE_TITLE',			'Poista esto');
define('_BAN_ALLBLOGS',				'Kaikki blogit joihin sinulla on j�rjestelm�nvalvojan oikeudet.');
define('_BAN_REMOVED_TITLE',		'Esto poistettu');
define('_BAN_REMOVED_TEXT',			'Esto poistettu seuraavista blogeista:');
define('_BAN_ADD_TITLE',			'Lis�� esto');
define('_BAN_IPRANGE_TEXT',			'Valitse ip-osoite, jonka haluat blokata. Mit� v�hemm�n numeroita siin� on, sit� enemm�n osoitteita tullaan blokkaamaan.');
define('_BAN_BLOGS_TEXT',			'Voit est�� ip:n vain yhdell� blogilla tai voit est�� ip:n kaikilla niill� blogeilla, joihin sinulla j�rjestelm�nvalvojan oikeudet. Tee valintasi alla.');
define('_BAN_REASON_TITLE',			'Syy');
define('_BAN_REASON_TEXT',			'Voit osoittaa syyn estolle, joka n�ytet��n kun ip:n haltija yritt�� lis�t� uuden kommentin tai antaa karma ��nen. Maksimipituus on 256 merkki�.');
define('_BAN_ADD_BTN',				'Lis�� esto');

// LOGIN screen
define('_LOGIN_MESSAGE',			'Viesti');
define('_LOGIN_NAME',				'Tunnus');
define('_LOGIN_PASSWORD',			'Salasana');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'Unohditko salasanasi?');

// membermanagement
define('_MEMBERS_TITLE',			'K�ytt�j�t');
define('_MEMBERS_CURRENT',			'Nykyiset k�ytt�j�t');
define('_MEMBERS_NEW',				'Uusi k�ytt�j�');
define('_MEMBERS_DISPLAY',			'Tunnus');
define('_MEMBERS_DISPLAY_INFO',		'(T�m� on tunnus jota k�yt�t kirjautumiseen)');
define('_MEMBERS_REALNAME',			'Oikea nimi');
define('_MEMBERS_PWD',				'Salasana');
define('_MEMBERS_REPPWD',			'Toista salasana');
define('_MEMBERS_EMAIL',			'S�hk�postiosoite');
define('_MEMBERS_EMAIL_EDIT',		'(Kun vaihdat s�hk�postiosoitetta, uusi salasana tullaan automaattisesti postittamaan siihen osoitteeseen)');
define('_MEMBERS_URL',				'Sivuston osoite (URL)');
define('_MEMBERS_SUPERADMIN',		'J�rjestelm�nvalvojan oikeudet');
define('_MEMBERS_CANLOGIN',			'Voi kirjautua j�rjestelm�nvalvoja alueelle');
define('_MEMBERS_NOTES',			'Tietoja');
define('_MEMBERS_NEW_BTN',			'Lis�� k�ytt�j�');
define('_MEMBERS_EDIT',				'K�ytt�j�tietojen muokkaus');
define('_MEMBERS_EDIT_BTN',			'Muuta asetuksia');
define('_MEMBERS_BACKTOOVERVIEW',	'Takaisin k�ytt�j�t -sivulle');
define('_MEMBERS_DEFLANG',			'Kieli');
define('_MEMBERS_USESITELANG',		'- k�yt� sivuston vakioasetusta -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'K�y sivustolla');
define('_BLOGLIST_ADD',				'Lis�� artikkeli');
define('_BLOGLIST_TT_ADD',			'Lis�� artikkeli t�h�n weblogiin');
define('_BLOGLIST_EDIT',			'Muokkaa/poista artikkeleita');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Bookmarklet');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'Asetukset');
define('_BLOGLIST_TT_SETTINGS',		'S��d� asetuksia tai k�sittele hallintaryhm��');
define('_BLOGLIST_BANS',			'Estot');
define('_BLOGLIST_TT_BANS',			'Tarkastele, lis�� tai poista estettyj� ip:it�');
define('_BLOGLIST_DELETE',			'Poista kaikki');
define('_BLOGLIST_TT_DELETE',		'Poista t�m� weblogi');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'Weblogisi');
define('_OVERVIEW_YRDRAFTS',		'Vedoksesi');
define('_OVERVIEW_YRSETTINGS',		'Asetuksesi');
define('_OVERVIEW_GSETTINGS',		'Yleiset asetukset');
define('_OVERVIEW_NOBLOGS',			'Et ole mink��n weblogin hallintaryhm�ss�');
define('_OVERVIEW_NODRAFTS',		'Ei vedoksia');
define('_OVERVIEW_EDITSETTINGS',	'Muokkaa omia tietojasi...');
define('_OVERVIEW_BROWSEITEMS',		'Selaa artikkeleitasi...');
define('_OVERVIEW_BROWSECOMM',		'Selaa kommenttejasi...');
define('_OVERVIEW_VIEWLOG',			'Tarkastele toimintologia...');
define('_OVERVIEW_MEMBERS',			'Hallitse k�ytt�ji�...');
define('_OVERVIEW_NEWLOG',			'Luo uusi weblogi...');
define('_OVERVIEW_SETTINGS',		'S��d� yleisi� asetuksia...');
define('_OVERVIEW_TEMPLATES',		'Muokkaa asetteluja...');
define('_OVERVIEW_SKINS',			'Muokkaa sivurunkoja...');
define('_OVERVIEW_BACKUP',			'Tee varmuuskopio / palauta varmuuskopio...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'Artikkelit blogiin'); 
define('_ITEMLIST_YOUR',			'Artikkelisi');

// Comments
define('_COMMENTS',					'Kommentteja');
define('_NOCOMMENTS',				'Ei kommentteja t�h�n artikkeliin');
define('_COMMENTS_YOUR',			'Kommenttisi');
define('_NOCOMMENTS_YOUR',			'Et ole kirjoittanut kommentteja');

// LISTS (general)
define('_LISTS_NOMORE',				'Ei en�� hakuvastauksia tai ei hakuvastauksia ollenkaan');
define('_LISTS_PREV',				'Edellinen');
define('_LISTS_NEXT',				'Seuraava');
define('_LISTS_SEARCH',				'Etsi');
define('_LISTS_CHANGE',				'Muuta');
define('_LISTS_PERPAGE',			'artikkelia/sivu');
define('_LISTS_ACTIONS',			'Toiminnot');
define('_LISTS_DELETE',				'Poista');
define('_LISTS_EDIT',				'Muokkaa');
define('_LISTS_MOVE',				'Siirr�');
define('_LISTS_CLONE',				'Monista');
define('_LISTS_TITLE',				'Otsikko');
define('_LISTS_BLOG',				'Blogi');
define('_LISTS_NAME',				'Nimi');
define('_LISTS_DESC',				'Kuvaus');
define('_LISTS_TIME',				'P�iv�ys');
define('_LISTS_COMMENTS',			'Kommentit');
define('_LISTS_TYPE',				'Tyyppi');


// member list 
define('_LIST_MEMBER_NAME',			'Tunnus');
define('_LIST_MEMBER_RNAME',		'Oikea nimi');
define('_LIST_MEMBER_ADMIN',		'Ylij�rjestelm�nvalvoja? ');
define('_LIST_MEMBER_LOGIN',		'Voi kirjautua sis��n? ');
define('_LIST_MEMBER_URL',			'Verkkosivut');

// banlist
define('_LIST_BAN_IPRANGE',			'IP-osoite');
define('_LIST_BAN_REASON',			'Syy');

// actionlist
define('_LIST_ACTION_MSG',			'Viesti');

// commentlist
define('_LIST_COMMENT_BANIP',		'Est� IP');
define('_LIST_COMMENT_WHO',			'Kirjoittaja');
define('_LIST_COMMENT',				'Kommentti');
define('_LIST_COMMENT_HOST',		'Is�nt�kone');

// itemlist
define('_LIST_ITEM_INFO',			'Info');
define('_LIST_ITEM_CONTENT',		'Otsikko ja teksti');


// teamlist
define('_LIST_TEAM_ADMIN',			'J�rjestelm�nvalvoja ');
define('_LIST_TEAM_CHADMIN',		'Vaihda j�rjestelm�nvalvoja');

// edit comments
define('_EDITC_TITLE',				'Muokkaa kommentteja');
define('_EDITC_WHO',				'Kirjoittaja');
define('_EDITC_HOST',				'Mist�?');
define('_EDITC_WHEN',				'Milloin?');
define('_EDITC_TEXT',				'Teksti');
define('_EDITC_EDIT',				'Muokkaa kommenttia');
define('_EDITC_MEMBER',				'k�ytt�j�');
define('_EDITC_NONMEMBER',			'ei-k�ytt�j�');

// move item
define('_MOVE_TITLE',				'Siirr� mihin blogiin?');
define('_MOVE_BTN',					'Siirr� artikkeli');

?>

