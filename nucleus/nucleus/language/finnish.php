<?php
// Finnish Nucleus Language File
// 
// Author: Jukka Kolehmainen, www.timetombs.net(v2.0)
// Author: Marko Seppänen, http://hoito.org (v1.5,v1.1)
// Nucleus version: v2.5beta
//
// Please note: if you want to translate this file to your own language, be aware
// that in a next Nucleus version, new variables might be added and some other ones
// might be deleted. Therefor, it's important to list the Nucleus version for which 
// the file was written in your document.
//
// Fully translated language file can be sent to Wouter Demuynck (nucleus@demuynck.org)
// and will be available for download (with proper credit to the author, of course)

// START introduced after v2.0 START

// media library
define('_MEDIA_VIEW',				'Tarkastele');
define('_MEDIA_VIEW_TT',			'Katso tiedostoa (avautuu uuteen ikkunaan)');
define('_MEDIA_FILTER_APPLY',		'Ota Filtteri käyttöön');
define('_MEDIA_FILTER_LABEL',		'Filtteri: ');
define('_MEDIA_UPLOAD_TO',			'Lähetä...');
define('_MEDIA_UPLOAD_NEW',			'Lähetä uusi tiedosto...');
define('_MEDIA_COLLECTION_SELECT',	'Valitse');
define('_MEDIA_COLLECTION_TT',		'Hyppää tähän kategoriaan');
define('_MEDIA_COLLECTION_LABEL',	'Nykyinen lajitelma: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'Tasaa vasemmalle');
define('_ADD_ALIGNRIGHT_TT',		'Tasaa oikealle');
define('_ADD_ALIGNCENTER_TT',		'Keskitä');

// searchable blog setting (yes/no)
define('_EBLOG_SEARCH',				'Sisällytä hakuun');

// generic upload failure
define('_ERROR_UPLOADFAILED',		'Lähettäminen epäonnistui');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'Salli menneille päiville postitus');
define('_ADD_CHANGEDATE',			'Päivitä aikaleima');
define('_BMLET_CHANGEDATE',			'Päivitä aikaleima');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'Tuominen / vieminen...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Normaali');
define('_PARSER_INCMODE_SKINDIR',	'Käytä sivurunkohakemistoa');
define('_SKIN_INCLUDE_MODE',		'Moodi');
define('_SKIN_INCLUDE_PREFIX',		'Etuliite');

// global settings
define('_SETTINGS_BASESKIN',		'Perussivurunko');
define('_SETTINGS_SKINSURL',		'Perussivurunkojen URL');
define('_SETTINGS_ACTIONSURL',		'Koko URL action.php:lle');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'Vakiokategoriaa ei voi siirtää');
define('_ERROR_MOVETOSELF',			'Kategoriaa ei voi voida siirtää (kohdeblogi on sama kuin lähdeblogi)');
define('_MOVECAT_TITLE',			'Valitse blogi johon kategoria siirretään');
define('_MOVECAT_BTN',				'Siirrä kategoria');

// URLMode setting
define('_SETTINGS_URLMODE',			'URL moodi');
define('_SETTINGS_URLMODE_NORMAL',	'Normaali');
define('_SETTINGS_URLMODE_PATHINFO','Kokonainen');

// Batch operations
define('_BATCH_NOSELECTION',		'Ei valintoja, joihin kohdistuu toimintoja');
define('_BATCH_ITEMS',				'Joukkotoiminne blogiartikkeleille');
define('_BATCH_CATEGORIES',			'Joukkotoiminne kategorioille');
define('_BATCH_MEMBERS',			'Joukkotoiminne jäsenille');
define('_BATCH_TEAM',				'Joukkotoiminne hallintaryhmille');
define('_BATCH_COMMENTS',			'Joukkotoiminne kommenteille');
define('_BATCH_UNKNOWN',			'Tuntematon joukkotoiminne: ');
define('_BATCH_EXECUTING',			'Suorittaa..');
define('_BATCH_ONCATEGORY',			'kategorialle');
define('_BATCH_ONITEM',				'blogiartikkelille');
define('_BATCH_ONCOMMENT',			'kommentille');
define('_BATCH_ONMEMBER',			'jäsenelle');
define('_BATCH_ONTEAM',				'hallintaryhmän jäsenelle');
define('_BATCH_SUCCESS',			'Onnistui!');
define('_BATCH_DONE',				'Valmis!');
define('_BATCH_DELETE_CONFIRM',		'Vahvista joukkopoistaminen');
define('_BATCH_DELETE_CONFIRM_BTN',	'Vahvista joukkopoistaminen');
define('_BATCH_SELECTALL',			'valitse kaikki');
define('_BATCH_DESELECTALL',		'poista valinnat');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'Poista');
define('_BATCH_ITEM_MOVE',			'Siirrä');
define('_BATCH_MEMBER_DELETE',		'Poista');
define('_BATCH_MEMBER_SET_ADM',		'Anna järjestelmänvalvojan oikeudet');
define('_BATCH_MEMBER_UNSET_ADM',	'Ota pois järjestelmänvalvojan oikeudet');
define('_BATCH_TEAM_DELETE',		'Poista hallintaryhmästä');
define('_BATCH_TEAM_SET_ADM',		'Anna järjestelmänvalvojan oikeudet');
define('_BATCH_TEAM_UNSET_ADM',		'Ota pois järjestelmänvalvojan oikeudet');
define('_BATCH_CAT_DELETE',			'Poista');
define('_BATCH_CAT_MOVE',			'Siirrä toiseen blogiin');
define('_BATCH_COMMENT_DELETE',		'Poista');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'Lisää uusi blogiartikkeli...');
define('_ADD_PLUGIN_EXTRAS',		'Pluginille lisävalinnat');

// errors
define('_ERROR_CATCREATEFAIL',		'Ei pystytty luomaan uutta kategoriaa');
define('_ERROR_NUCLEUSVERSIONREQ',	'Tämä plugini vaatii uudemman Nucleuksen version: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Takaisin blogiasetuksiin');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Tuo');
define('_SKINIE_TITLE_EXPORT',		'Vie');
define('_SKINIE_BTN_IMPORT',		'Tuo valitut sivurungot / templaatit');
define('_SKINIE_BTN_EXPORT',		'Vie valitut sivurungot / templaatit');
define('_SKINIE_LOCAL',				'Tuo paikallisesta tiedostosta:');
define('_SKINIE_NOCANDIDATES',		'Ei ehdokkaita tuotavaksi sivurunko -hakemistossa');
define('_SKINIE_FROMURL',			'Tuo URL:sta:');
define('_SKINIE_EXPORT_INTRO',		'Valitse sivurungot ja templaatit, jotka haluavat viedä');
define('_SKINIE_EXPORT_SKINS',		'Sivurungot');
define('_SKINIE_EXPORT_TEMPLATES',	'Templaatit');
define('_SKINIE_EXPORT_EXTRA',		'Lisätietoa');
define('_SKINIE_CONFIRM_OVERWRITE',	'Ylikirjoita sivurungot, jotka ovat jo olemassa (katso nimien päällekkäisyydet)');
define('_SKINIE_CONFIRM_IMPORT',	'Kyllä, haluan tuoda tämän ');
define('_SKINIE_CONFIRM_TITLE',		'Valmis tuomaan sivurungon ja templaatit');
define('_SKINIE_INFO_SKINS',		'Sivurungot tiedostossa:');
define('_SKINIE_INFO_TEMPLATES',	'Templaatit tiedostossa:');
define('_SKINIE_INFO_GENERAL',		'Tietoa:');
define('_SKINIE_INFO_SKINCLASH',	'Sivirunkonimien päällekkäisyydet:');
define('_SKINIE_INFO_TEMPLCLASH',	'Templaattinimien päällekkäisyydet:');
define('_SKINIE_INFO_IMPORTEDSKINS','Tuodut sivurungot:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Tuodut templaatit:');
define('_SKINIE_DONE',				'Tuominen valmis');

define('_AND',						'ja');
define('_OR',						'tai');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'tyhjä kenttä (klikkaa editoidaksesi)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'IncludeMode:');
define('_LIST_SKINS_INCPREFIX',		'IncludePrefix:');
define('_LIST_SKINS_DEFINED',		'Määritellyt osat:');

// backup
define('_BACKUPS_TITLE',			'Varmuuskopioi / Palauta');
define('_BACKUP_TITLE',				'Varmuuskopioi');
define('_BACKUP_INTRO',				'Klikkaa alla olevaa painiketta luodaksesi varmuuskopio Nucleus tietokannastasi. Tallennusikkuna tulee esiin ja voit valita minne haluat tallettaa varmuuskopiotiedoston. Säilö se varmaan paikkaan.');
define('_BACKUP_ZIP_YES',			'Yritä käyttää tiedonpakkausta');
define('_BACKUP_ZIP_NO',			'Älä käytä tiedonpakkausta');
define('_BACKUP_BTN',				'Luo varmuuskopio');
define('_BACKUP_NOTE',				'<b>Huomaa:</b> Vain tietokannan sisältö on talletettuna varmuuskopioon. Mediatiedostot ja asetukset tiedostossa config.php <b>eivät</b> täten sisälly varmuuskopioon.');
define('_RESTORE_TITLE',			'Palauta');
define('_RESTORE_NOTE',				'<b>VAROITUS:</b> Varmuuskopiosta palauttaminen tulee <b>TYHJENTÄMÄÄN</b> kaiken nykyisen Nucleus datan tietokannasta! Toteuta tämä vain, jos olet ehdottaman varma, että haluat tehdä tämän!	<br />	<b>Huomaa:</b> Varmista, että Nucleuksen versio, jossa varmuuskopion loit, pitäisi olla sama kuin versio, jota käytät juuri nyt! Muuten se ei toimi.');
define('_RESTORE_INTRO',			'Valitse varmuuskopiotiedosto alta (se tullaan lataamaan serverille) ja klikkaa "Palauta tiedostosta" painiketta aloittaaksesi.');
define('_RESTORE_IMSURE',			'Kyllä, olen varma, että haluan tehdä tämän!');
define('_RESTORE_BTN',				'Palauta tiedostosta');
define('_RESTORE_WARNING',			'(varmista, että olet palauttamassa oikeaa varmuuskopiota, kenties kannattaa tehdä uusi varmuuskopio ennen kuin aloitat)');
define('_ERROR_BACKUP_NOTSURE',		'Sinun täytyy ruksittaa \'Olen varma, että haluan tehdä tämän\' -kohta');
define('_RESTORE_COMPLETE',			'Palautus valmis');

// new item notification
define('_NOTIFY_NI_MSG',			'Uusi blogiartikkeli on postitettu:');
define('_NOTIFY_NI_TITLE',			'Uusi blogiartikkeli!');
define('_NOTIFY_KV_MSG',			'Karma-äänestä blogiartikkelia:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'Kommentoi blogiartikkelia:');
define('_NOTIFY_NC_TITLE',			'Nucleus kommentti:');
define('_NOTIFY_USERID',			'Käyttäjän ID:');
define('_NOTIFY_USER',				'Käyttäjä:');
define('_NOTIFY_COMMENT',			'Kommentti:');
define('_NOTIFY_VOTE',				'Äänestys:');
define('_NOTIFY_HOST',				'Host:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'Jäsen:');
define('_NOTIFY_TITLE',				'Otsikko:');
define('_NOTIFY_CONTENTS',			'Sisältö:');

// member mail message
define('_MMAIL_MSG',				'Viesti sinulle, jonka on lähettänyt');
define('_MMAIL_FROMANON',			'nimetön vierailija');
define('_MMAIL_FROMNUC',			'Postitettu Nucleus weblogista osoitteessa');
define('_MMAIL_TITLE',				'Viesti jäseneltä');
define('_MMAIL_MAIL',				'Viesti:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'Lisää merkintä');
define('_BMLET_EDIT',				'Muokkaa merkintää');
define('_BMLET_DELETE',				'Poista merkintä');
define('_BMLET_BODY',				'Sisältö');
define('_BMLET_MORE',				'Laajennettu');
define('_BMLET_OPTIONS',			'Optiot');
define('_BMLET_PREVIEW',			'Esikatselu');

// used in bookmarklet
define('_ITEM_UPDATED',				'Merkintä päivitetty');
define('_ITEM_DELETED',				'Merkintä poistettu');

// plugins
define('_CONFIRMTXT_PLUGIN',		'Oletko varma, että haluat poistaa pluginin nimeltä');
define('_ERROR_NOSUCHPLUGIN',		'Kyseistä pluginia ei ole');
define('_ERROR_DUPPLUGIN',			'Tämä plugini on jo asennettu');
define('_ERROR_PLUGFILEERROR',		'Kyseistä pluginia ei ole, tai oikeudet ovat väärin asetetut');
define('_PLUGS_NOCANDIDATES',		'Pluginehdokkaita ei löytynyt');

define('_PLUGS_TITLE_MANAGE',		'Hallitse plugineita');
define('_PLUGS_TITLE_INSTALLED',	'Asennetut pluginit');
define('_PLUGS_TITLE_UPDATE',		'Päivitä tapahtumalistaa');
define('_PLUGS_TEXT_UPDATE',		'Nucleus pitää yllä listaa pluginien tapahtumatilauksista. Kun päivität pluginin ylikirjoittamalla sen tiedoston, sinun täytyisi ajaa tämä päivitys varmistaaksesi, että listassa olisi oikeat tilaukset');
define('_PLUGS_TITLE_NEW',			'Asenna uusi plugini');
define('_PLUGS_ADD_TEXT',			'Alla on lista kaikista tiedostoista Plugins -hakemistossasi, jotka voivat olla ei-asennettuja plugineja. Varmista että olet <strong>aivan varma</strong>, että kyseessä on plugini ennen kuin lisäät sen.');
define('_PLUGS_BTN_INSTALL',		'Asenna plugini');
define('_BACKTOOVERVIEW',			'Takaisin');

// editlink
define('_TEMPLATE_EDITLINK',		'Muokkaa merkintää -linkki');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'Lisää vasen palsta');
define('_ADD_RIGHT_TT',				'Lisää oikea palsta');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'Uusi kategoria');

// new settings
define('_SETTINGS_PLUGINURL',		'Pluginin osoite (URL)');
define('_SETTINGS_MAXUPLOADSIZE',	'Ladatun tiedoston maksimikoko (bitteinä)');
define('_SETTINGS_NONMEMBERMSGS',	'Salli ei-jäsenten lähettää viestejä');
define('_SETTINGS_PROTECTMEMNAMES',	'Suojaa jäsenten nimet');

// overview screen
define('_OVERVIEW_PLUGINS',			'Hallitse plugineita...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'Uuden jäsenen rekisteröinti:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'Sähköpostiosoitteesi:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'Sinulla ei ole ylläpitäjän oikeuksia mihinkään blogiin, joilla on kohdejäsen listallaan. Täten, et ole oikeutettu lataamaan tiedostoja tämän jäsenen media -hakemistoon');

// plugin list
define('_LISTS_INFO',				'Tiedot');
define('_LIST_PLUGS_AUTHOR',		'Tekijä:');
define('_LIST_PLUGS_VER',			'Versio:');
define('_LIST_PLUGS_SITE',			'WWW-sivut');
define('_LIST_PLUGS_DESC',			'Kuvaus');
define('_LIST_PLUGS_SUBS',			'Liittyy seuraaviin tapahtumiin:');
define('_LIST_PLUGS_UP',			'Siirrä ylös');
define('_LIST_PLUGS_DOWN',			'Siirrä alas');
define('_LIST_PLUGS_UNINSTALL',		'Poista&nbsp;installointi');
define('_LIST_PLUGS_ADMIN',			'Ylläpito');
define('_LIST_PLUGS_OPTIONS',		'Säädä&nbsp;asetuksia');

// plugin option list
define('_LISTS_VALUE',				'Arvo');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'Tällä pluginilla ei ole asetuksia säädettävänä
');
define('_PLUGS_BACK',				'Takaisin Pluginit -sivulle');
define('_PLUGS_SAVE',				'Tallenna asetukset');
define('_PLUGS_OPTIONS_UPDATED',	'Pluginin asetukset päivitetty');

define('_OVERVIEW_MANAGEMENT',		'Hallinta');
define('_OVERVIEW_MANAGE',			'Nucleuksen hallinta...');
define('_MANAGE_GENERAL',			'Yleinen hallinta');
define('_MANAGE_SKINS',				'Sivurungot ja templaatit');
define('_MANAGE_EXTRA',				'Lisäominaisuudet');

define('_BACKTOMANAGE',				'Takaisin Nucleuksen hallintaan');


// END introduced after v1.1 END

// charset to use 
define('_CHARSET',					'iso-8859-1');

// global stuff
define('_LOGOUT',					'Kirjaudu ulos');
define('_LOGIN',					'Kirjaudu sisään');
define('_YES',						'Kyllä');
define('_NO',						'Ei');
define('_SUBMIT',					'Lähetä');
define('_ERROR',					'Virhe');
define('_ERRORMSG',					'Virhe esiintyi!');
define('_BACK',						'Takaisin');
define('_NOTLOGGEDIN',				'Et ole kirjautunut sisään');
define('_LOGGEDINAS',				'Olet kirjautunut sisään tunnuksella');
define('_ADMINHOME',				'Järjestelmänvalvoja-asetukset');
define('_NAME',						'Nimi');
define('_BACKHOME',					'Takaisin järjestelmänvalvoja-asetuksiin');
define('_BADACTION',				'Pyydettyä toimintoa ei ole');
define('_MESSAGE',					'Viesti');
define('_HELP_TT',					'Apua!');
define('_YOURSITE',					'Sivustosi');


define('_POPUP_CLOSE',				'Sulje ikkuna');

define('_LOGIN_PLEASE',				'Kirjaudu ensin sisään');

// commentform
define('_COMMENTFORM_YOUARE',		'Olet');
define('_COMMENTFORM_SUBMIT',		'Lisää kommentti');
define('_COMMENTFORM_COMMENT',		'Kommenttisi');
define('_COMMENTFORM_NAME',			'Nimi');
define('_COMMENTFORM_MAIL',			'Sähköpostiosoite');
define('_COMMENTFORM_REMEMBER',		'Muista minut');

// loginform
define('_LOGINFORM_NAME',			'Tunnus');
define('_LOGINFORM_PWD',			'Salasana');
define('_LOGINFORM_YOUARE',			'Olet kirjautuneena<br />sisään tunnuksella<br />');
define('_LOGINFORM_SHARED',			'Usean käyttäjän tietokone');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'Lähetä viesti');

// search form
define('_SEARCHFORM_SUBMIT',		'Etsi');

// add item form
define('_ADD_ADDTO',				'Merkintä blogiin ');
define('_ADD_CREATENEW',			'Luo uusi merkintä');
define('_ADD_BODY',					'Sisältö');
define('_ADD_TITLE',				'Otsikko');
define('_ADD_MORE',					'Laajennettu (optionaalinen)');
define('_ADD_CATEGORY',				'Kategoria');
define('_ADD_PREVIEW',				'Esikatselu');
define('_ADD_DISABLE_COMMENTS',		'Kommentit pois käytöstä?');
define('_ADD_DRAFTNFUTURE',			'Vedos &amp; tulevat merkinnät');
define('_ADD_ADDITEM',				'Lisää merkintä');
define('_ADD_ADDNOW',				'Lisää nyt');
define('_ADD_ADDLATER',				'Lisää myöhemmin');
define('_ADD_PLACE_ON',				'Place on');
define('_ADD_ADDDRAFT',				'Lisää vedoksiin');
define('_ADD_NOPASTDATES',			'(dates and times in the past are NOT valid, the current time will be used in that case)');
define('_ADD_BOLD_TT',				'Lihavoitu');
define('_ADD_ITALIC_TT',			'Kursivoitu');
define('_ADD_HREF_TT',				'Luo linkki');
define('_ADD_MEDIA_TT',				'Lisää media');
define('_ADD_PREVIEW_TT',			'Näytä/Piilota esikatselu');
define('_ADD_CUT_TT',				'Leikkaa');
define('_ADD_COPY_TT',				'Kopioi');
define('_ADD_PASTE_TT',				'Liitä');


// edit item form
define('_EDIT_ITEM',				'Muokkaa merkintää');
define('_EDIT_SUBMIT',				'Muokkaa');
define('_EDIT_ORIG_AUTHOR',			'Alkuperäinen kirjoittaja');
define('_EDIT_BACKTODRAFTS',		'Tallenna takaisin vedokseen');
define('_EDIT_COMMENTSNOTE',		'(huomaa: kommenttien pois päältä kytkeminen _ei_ piilota aiemmin lisättyjä kommentteja)');

// used on delete screens
define('_DELETE_CONFIRM',			'Varmista poistaminen');
define('_DELETE_CONFIRM_BTN',		'Varmista poistaminen');
define('_CONFIRMTXT_ITEM',			'Olet poistamassa seuraavan merkinnän:');
define('_CONFIRMTXT_COMMENT',		'Olet poistamassa seuraavan kommentin:');
define('_CONFIRMTXT_TEAM1',			'Olet poistamassa ');
define('_CONFIRMTXT_TEAM2',			' blogin hallintaryhmässä ');
define('_CONFIRMTXT_BLOG',			'Olet poistamassa blogia: ');
define('_WARNINGTXT_BLOGDEL',		'Varoitus! Blogin poisto tulee tuhoamaan kaikki merkinnät ja kommentit kyseisessä blogissa. Vahvista että olet AIVAN VARMA siitä mitä olet tekemässä!<br />Älä myöskään keskeytä Nucleusta sen poistaessa blogiasi.');
define('_CONFIRMTXT_MEMBER',		'Olet poistamassa seuraavan käyttäjän profiilin: ');
define('_CONFIRMTXT_TEMPLATE',		'Olet poistamassa templaatin nimeltä ');
define('_CONFIRMTXT_SKIN',			'Olet poistamassa sivurungon nimeltä ');
define('_CONFIRMTXT_BAN',			'Olet poistamassa eston ip-osoitteelle ');
define('_CONFIRMTXT_CATEGORY',		'Olet poistamassa kategorian ');

// some status messages
define('_DELETED_ITEM',				'Merkintä poistettu');
define('_DELETED_MEMBER',			'Käyttäjä poistettu');
define('_DELETED_COMMENT',			'Kommentti poistettu');
define('_DELETED_BLOG',				'Blogi poistettu');
define('_DELETED_CATEGORY',			'Kategoria poistettu');
define('_ITEM_MOVED',				'Merkintä siirretty');
define('_ITEM_ADDED',				'Merkintä lisätty');
define('_COMMENT_UPDATED',			'Kommentti päivitetty');
define('_SKIN_UPDATED',				'Sivurunkodata on tallennettu');
define('_TEMPLATE_UPDATED',			'Templaattidata on tallennettu');

// errors
define('_ERROR_COMMENT_LONGWORD',	'Älä käytä kuin korkeintaan 60 merkkiä pitkiä sanoja kommenteissasi');
define('_ERROR_COMMENT_NOCOMMENT',	'Kirjoita kommentti');
define('_ERROR_COMMENT_NOUSERNAME',	'Ei hyväksyttävä tunnus');
define('_ERROR_COMMENT_TOOLONG',	'Kommenttisi on liian pitkä (max. 5000 merkkiä)');
define('_ERROR_COMMENTS_DISABLED',	'Kommentointimahdollisuus tälle blogille on pois käytöstä.');
define('_ERROR_COMMENTS_NONPUBLIC',	'Sinun täytyy olla kirjautunut käyttäjä lisätäksesi kommentin tähän blogiin');
define('_ERROR_COMMENTS_MEMBERNICK','Tunnus, jota haluat käyttää lähettääksesi kommentin on registeröityneen käyttäjän käytössä. Valitse jokin toinen tunnus.');
define('_ERROR_SKIN',				'Sivurunkovirhe');
define('_ERROR_ITEMCLOSED',			'Tämä merkintä on suljettu, et voi lisätä uusia kommentteja siihen tai äänestää siinä');
define('_ERROR_NOSUCHITEM',			'Kyseistä merkintää ei ole');
define('_ERROR_NOSUCHBLOG',			'Kyseistä blogia ei ole');
define('_ERROR_NOSUCHSKIN',			'Kyseistä sivurunkoa ei ole');
define('_ERROR_NOSUCHMEMBER',		'Kyseistä käyttäjää ei ole');
define('_ERROR_NOTONTEAM',			'Et ole tämän webblogin hallintaryhmässä.');
define('_ERROR_BADDESTBLOG',		'Kohdeblogia ei ole');
define('_ERROR_NOTONDESTTEAM',		'Merkintää ei voi siirtää, sillä et ole kohdeblogin hallintaryhmässä');
define('_ERROR_NOEMPTYITEMS',		'Tyhjiä merkintöjä ei voi lisätä!');
define('_ERROR_BADMAILADDRESS',		'Sähköpostiosoite ei ole kelvollinen');
define('_ERROR_BADNOTIFY',			'Yksi (tai useampi) annettu sähköposti-ilmoitusosoite on epäkelpo sähköpostiosoite');
define('_ERROR_BADNAME',			'Nimi ei ole hyväksyttävä (vain a-z ja 0-9 ovat hyväksyttäviä merkkejä, ei välilyöntejä alussa/lopussa)');
define('_ERROR_NICKNAMEINUSE',		'Jo registeröitynyt käyttää käyttää jo kyseistä nimeä');
define('_ERROR_PASSWORDMISMATCH',	'Salasanojen täytyy olla samoja');
define('_ERROR_PASSWORDTOOSHORT',	'Salasanan pitäisi olla ainakin 6 merkkiä pitkä');
define('_ERROR_PASSWORDMISSING',	'Salasana on valittava');
define('_ERROR_REALNAMEMISSING',	'Sinun täytyy antaa oikea nimesi');
define('_ERROR_ATLEASTONEADMIN',	'Aina pitäisi olla ainakin yksi ylijärjestelmänvalvoja, joka voi kirjautua järjestelmänvalvoja alueelle.');
define('_ERROR_ATLEASTONEBLOGADMIN','Tämä toiminnon suorittaminen jättäisi blogisi mahdottomaksi ylläpitää. Varmista että järjestelmänvalvojia on ainakin yksi.');
define('_ERROR_ALREADYONTEAM',		'Et voi lisätä käyttäjää joka on jo hallintaryhmässä');
define('_ERROR_BADSHORTBLOGNAME',	'Blogin id-nimi saisi sisältää vain merkkejä a-z ja 0-9, ilman välilyöntejä');
define('_ERROR_DUPSHORTBLOGNAME',	'Toisella blogilla on jo valittu id-nimi. Näiden nimien tulisi erota toisistaan');
define('_ERROR_UPDATEFILE',			'Päivitystiedostoon ei voi saada kirjoitusoikeutta. Tarkista että tiedosto-oikeudet ovat ok (kokeile chmod 666). Huomaa myös, että sijainti on suhteellinen järjestelmänvalvoja hakemistoon nähden, joten saattanet haluta käyttää absoluuttista polkua (kuten /sinun/polkusi/nucleukseen/)');
define('_ERROR_DELDEFBLOG',			'Oletusblogia ei voi poistaa');
define('_ERROR_DELETEMEMBER',		'Tätä käyttäjää ei voi poistaa, koska hän on merkintöjen tai kommenttien luoja');
define('_ERROR_BADTEMPLATENAME',	'Epäkelpo nimi templaatille, käytä vain merkkejä a-z ja 0-9, ilman välilyöntejä');
define('_ERROR_DUPTEMPLATENAME',	'Toinen templaatti käyttää jo tätä nimeä');
define('_ERROR_BADSKINNAME',		'Epäkelpo nimi sivurungolle (käytä vain merkkejä a-z ja 0-9, ilman välilyöntejä)');
define('_ERROR_DUPSKINNAME',		'Toinen sivurunko tällä nimellä on jo olemassa');
define('_ERROR_DEFAULTSKIN',		'Sivurunko nimeltä "default" täytyy olla olemassa');
define('_ERROR_SKINDEFDELETE',		'Sivurunkoa ei voi poistaa, koska se on vakiosivurunko seuraavalle weblogille: ');
define('_ERROR_DISALLOWED',			'Valitettavasti et ole oikeutettu suorittamaan tätä toimintoa');
define('_ERROR_DELETEBAN',			'Virhe poistettaessa estoa (estoa ei ole olemassa)');
define('_ERROR_ADDBAN',				'Virhe lisättäessä estoa. Estoa ei ehkei ole lisätty oikein kaikissa blogeissasi.');
define('_ERROR_BADACTION',			'Pyydettyä toimintoa ei ole');
define('_ERROR_MEMBERMAILDISABLED',	'Käyttäjältä käyttäjälle -viestit ovat poissa käytöstä');
define('_ERROR_MEMBERCREATEDISABLED','Käyttäjien luomismahdollisuus on poissa käytöstä');
define('_ERROR_INCORRECTEMAIL',		'Epäkelpo osoite');
define('_ERROR_VOTEDBEFORE',		'Olet jo antanut äänesi tälle merkinnälle');
define('_ERROR_BANNED1',			'Toimintoa ei voi suorittaa johtuen siitä, että (esto ip:lle ');
define('_ERROR_BANNED2',			') olet estetty tekemästä niin. Viesti oli: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'Sinun täytyy olla kirjautunut sisään suorittaaksesi tämän toiminnon');
define('_ERROR_CONNECT',			'Yhdistämisvirhe');
define('_ERROR_FILE_TOO_BIG',		'Tiedosto on liian iso!');
define('_ERROR_BADFILETYPE',		'Valitettavasti tämä tiedostotyyppi ei ole sallittujen joukossa');
define('_ERROR_BADREQUEST',			'Epäkelpo tiedostonsiirto-pyyntö');
define('_ERROR_DISALLOWEDUPLOAD',	'Et ole minkään weblogin hallintaryhmässä. Täten, et ole oikeutettu lataamaan tiedostoja blogiin');
define('_ERROR_BADPERMISSIONS',		'Tiedosto/hakemisto -oikeudet eivät ole oikein asetetut');
define('_ERROR_UPLOADMOVEP',		'Virhe tiedostoa siirrettäessä');
define('_ERROR_UPLOADCOPY',			'Virhe tiedostoa kopioidessa');
define('_ERROR_UPLOADDUPLICATE',	'Toinen samanniminen tiedosto on jo olemassa. Kokeile sen uudelleennimeästä ennen tiedostonsiirtoa.');
define('_ERROR_LOGINDISALLOWED',	'Valitettavasti et ole oikeutettu kirjautumaan järjestelmänvalvoja alueelle. Toisaalta, voit kirjautua sisään toisena käyttäjänä');
define('_ERROR_DBCONNECT',			'MySQL serveriin ei saatu yhteyttä');
define('_ERROR_DBSELECT',			'Nucleus tietokantaa ei voitu valita.');
define('_ERROR_NOSUCHLANGUAGE',		'Kyseistä kielitiedostoa ei ole olemassa');
define('_ERROR_NOSUCHCATEGORY',		'Kyseistä kategoriaa ei ole olemassa');
define('_ERROR_DELETELASTCATEGORY',	'Ainakin yksi kategoria täytyy olla olemassa');
define('_ERROR_DELETEDEFCATEGORY',	'Vakiokategoriaa ei voi tuhota');
define('_ERROR_BADCATEGORYNAME',	'Epäkelpo kategorian nimi');
define('_ERROR_DUPCATEGORYNAME',	'Toinen samanniminen kategoria samaisella nimellä on jo olemassa');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'Varoitus: Nykyinen arvo ei ole hakemisto!');
define('_WARNING_NOTREADABLE',		'Varoitus: Nykyinen arvo on ei-lukuoikeudellinen hakemisto!');
define('_WARNING_NOTWRITABLE',		'Varoitus: Nykyinen arvo EI ole kirjoitusoikeudellinen hakemisto!');

// media and upload
define('_MEDIA_UPLOADLINK',			'Lataa uusi tiedosto');
define('_MEDIA_MODIFIED',			'muokattu');
define('_MEDIA_FILENAME',			'tiedoston nimi');
define('_MEDIA_DIMENSIONS',			'mittasuhteet');
define('_MEDIA_INLINE',				'Inline');
define('_MEDIA_POPUP',				'Popup');
define('_UPLOAD_TITLE',				'Valitse tiedosto');
define('_UPLOAD_MSG',				'Valitse alta tiedosto, jonka haluat ladata ja paina \'Lataa\' nappia.');
define('_UPLOAD_BUTTON',			'Lataa');

// some status messages
define('_MSG_ACCOUNTCREATED',		'Käyttäjätili luotu, salasana lähetetään sähköpostitse');
define('_MSG_PASSWORDSENT',			'Salasana on lähetettyä sähköpostitse.');
define('_MSG_LOGINAGAIN',			'Sinun täytyy kirjautua sisään uudelleen, johtuen vaihtuneista tiedoista');
define('_MSG_SETTINGSCHANGED',		'Asetuksia muutettu');
define('_MSG_ADMINCHANGED',			'Järjestelmänvalvoja muutettu');
define('_MSG_NEWBLOG',				'Uusi blogi luotu');
define('_MSG_ACTIONLOGCLEARED',		'Toimintologi tyhjennetty');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'Ei hyväksyttävä toiminto: ');
define('_ACTIONLOG_PWDREMINDERSENT','Uusi salasana on lähetetty käyttäjälle ');
define('_ACTIONLOG_TITLE',			'Toimintologi');
define('_ACTIONLOG_CLEAR_TITLE',	'Tyhjennä toimintologi');
define('_ACTIONLOG_CLEAR_TEXT',		'Tyhjennä toimintologi nyt');

// team management
define('_TEAM_TITLE',				'Käsittele blogin hallintaryhmää ');
define('_TEAM_CURRENT',				'Nykyinen hallintaryhmä');
define('_TEAM_ADDNEW',				'Lisää uusi käyttäjä hallintaryhmään');
define('_TEAM_CHOOSEMEMBER',		'Valitse käyttäjä');
define('_TEAM_ADMIN',				'Ylläpitäjän oikeudet? ');
define('_TEAM_ADD',					'Lisää hallintaryhmään');
define('_TEAM_ADD_BTN',				'Lisää hallintaryhmään');

// blogsettings
define('_EBLOG_TITLE',				'Säädä blogin asetuksia');
define('_EBLOG_TEAM_TITLE',			'Käsittele hallintaryhmää');
define('_EBLOG_TEAM_TEXT',			'Klikkaa täällä käsitelläksesi hallintaryhmääsi.');
define('_EBLOG_SETTINGS_TITLE',		'Blogin asetukset');
define('_EBLOG_NAME',				'Blogin nimi');
define('_EBLOG_SHORTNAME',			'Blogin id-nimi');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(saisi sisältää vain merkkejä a-z ja 0-9, ilman välilyöntejä)');
define('_EBLOG_DESC',				'Blogin kuvaus');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'Vakiosivurunko');
define('_EBLOG_DEFCAT',				'Vakiokategoria');
define('_EBLOG_LINEBREAKS',			'Konvertoi rivinvaihdot');
define('_EBLOG_DISABLECOMMENTS',	'Kommentit sallittuja?<br /><small>(Estämällä kommenttien kirjoittaminen, kommenttien lisääminen ei ole mahdollista.)</small>');
define('_EBLOG_ANONYMOUS',			'Salli kommentit ei-käyttäjiltä?');
define('_EBLOG_NOTIFY',				'Ilmoitussähköpostiosoite/-osoitteet (käytä merkkiä ; erottajana)');
define('_EBLOG_NOTIFY_ON',			'Ilmoitukset päällä');
define('_EBLOG_NOTIFY_COMMENT',		'Uusista kommenteista');
define('_EBLOG_NOTIFY_KARMA',		'Uusista karma äänestyksistä');
define('_EBLOG_NOTIFY_ITEM',		'Uusista weblogin merkinnöistä');
define('_EBLOG_PING',				'Pingaa Weblogs.com päivityksistä?');
define('_EBLOG_MAXCOMMENTS',		'Kommenttien maksimimäärä');
define('_EBLOG_UPDATE',				'Päivitystiedosto');
define('_EBLOG_OFFSET',				'Ajan muutos');
define('_EBLOG_STIME',				'Nykyinen serverin aika on');
define('_EBLOG_BTIME',				'Nykyinen blogin aika on');
define('_EBLOG_CHANGE',				'Muuta asetuksia');
define('_EBLOG_CHANGE_BTN',			'Muuta asetuksia');
define('_EBLOG_ADMIN',				'Blogin ylläpito');
define('_EBLOG_ADMIN_MSG',			'Sinulle asetetaan järjestelmänvalvoja oikeudet');
define('_EBLOG_CREATE_TITLE',		'Uusi weblogi');
define('_EBLOG_CREATE_TEXT',		'Täytä alla oleva kaavake luodaksesi uusi weblogi. <br /><br /> <b>Huomaa:</b> Vain tarvittavat kentät on listattu. Jos haluat säätää muita optioita, siirry blogin asetussivulle weblogin luomisen jälkeen.');
define('_EBLOG_CREATE',				'Luo!');
define('_EBLOG_CREATE_BTN',			'Luo weblogi');
define('_EBLOG_CAT_TITLE',			'Kategoriat');
define('_EBLOG_CAT_NAME',			'Kategorian nimi');
define('_EBLOG_CAT_DESC',			'Kategorian kuvaus');
define('_EBLOG_CAT_CREATE',			'Luo uusi kategoria');
define('_EBLOG_CAT_UPDATE',			'Päivitä kategoria');
define('_EBLOG_CAT_UPDATE_BTN',		'Päivitä kategoria');

// templates
define('_TEMPLATE_TITLE',			'Templaatit');
define('_TEMPLATE_AVAILABLE_TITLE',	'Tarjolla olevat templaatit');
define('_TEMPLATE_NEW_TITLE',		'Uusi templaatti');
define('_TEMPLATE_NAME',			'Templaatin nimi');
define('_TEMPLATE_DESC',			'Templaatin kuvaus');
define('_TEMPLATE_CREATE',			'Luo templaatti');
define('_TEMPLATE_CREATE_BTN',		'Luo templaatti');
define('_TEMPLATE_EDIT_TITLE',		'Templaatit');
define('_TEMPLATE_BACK',			'Takaisin templaatit -sivulle');
define('_TEMPLATE_EDIT_MSG',		'Kaikkia templaatteja ei tarvita, jätä tyhjäksi ne joita ei tarvita.');
define('_TEMPLATE_SETTINGS',		'Templaattien asetukset');
define('_TEMPLATE_ITEMS',			'Merkinnät');
define('_TEMPLATE_ITEMHEADER',		'Merkinnän ylätunniste');
define('_TEMPLATE_ITEMBODY',		'Merkinnän sisältö');
define('_TEMPLATE_ITEMFOOTER',		'Merkinnän alatunniste');
define('_TEMPLATE_MORELINK',		'Linkki laajennettuun merkintään');
define('_TEMPLATE_NEW',				'Uuden merkinnän merkki');
define('_TEMPLATE_COMMENTS_ANY',	'Kommentit (jos niitä on)');
define('_TEMPLATE_CHEADER',			'Kommentin ylätunniste');
define('_TEMPLATE_CBODY',			'Kommentin sisältö');
define('_TEMPLATE_CFOOTER',			'Kommentin alatunniste');
define('_TEMPLATE_CONE',			'Yksi kommentti');
define('_TEMPLATE_CMANY',			'Kaksi (tai useampi) kommenttia');
define('_TEMPLATE_CMORE',			'Kommentin lue_lisää');
define('_TEMPLATE_CMEXTRA',			'Käyttäjäextrat');
define('_TEMPLATE_COMMENTS_NONE',	'Kommentit (jos niitä ei ole)');
define('_TEMPLATE_CNONE',			'Ei kommentteja');
define('_TEMPLATE_COMMENTS_TOOMUCH','Kommentit (jos niitä on, mutta liikaa jotta ne voitaisiin näyttää)');
define('_TEMPLATE_CTOOMUCH',		'Liikaa kommentteja');
define('_TEMPLATE_ARCHIVELIST',		'Arkistolistaukset');
define('_TEMPLATE_AHEADER',			'Arkistolistauksen ylätunniste');
define('_TEMPLATE_AITEM',			'Arkistolistauksen merkintä');
define('_TEMPLATE_AFOOTER',			'Arkistolistauksen alatunniste');
define('_TEMPLATE_DATETIME',		'Päiväys ja kellonaika');
define('_TEMPLATE_DHEADER',			'Päiväyksen ylätunniste');
define('_TEMPLATE_DFOOTER',			'Päiväyksen alatunniste');
define('_TEMPLATE_DFORMAT',			'Päiväyksen formaatti');
define('_TEMPLATE_TFORMAT',			'Kellonajan formaatti');
define('_TEMPLATE_LOCALE',			'Paikallinen päiväys');
define('_TEMPLATE_IMAGE',			'Kuva popupit');
define('_TEMPLATE_PCODE',			'Popupin linkkikoodi');
define('_TEMPLATE_ICODE',			'Inline kuvan koodi');
define('_TEMPLATE_MCODE',			'Media objektin linkkikoodi');
define('_TEMPLATE_SEARCH',			'Etsi');
define('_TEMPLATE_SHIGHLIGHT',		'Korosta');
define('_TEMPLATE_SNOTFOUND',		'Haku ei palauttanut mitään');
define('_TEMPLATE_UPDATE',			'Päivitä');
define('_TEMPLATE_UPDATE_BTN',		'Päivitä templaatti');
define('_TEMPLATE_RESET_BTN',		'Resetoi data');
define('_TEMPLATE_CATEGORYLIST',	'Kategorialistaus');
define('_TEMPLATE_CATHEADER',		'Kategorialistan ylätunniste');
define('_TEMPLATE_CATITEM',			'Kategorialistan kategoria');
define('_TEMPLATE_CATFOOTER',		'Kategorialistan alatunniste');

// skins
define('_SKIN_EDIT_TITLE',			'Sivurungot');
define('_SKIN_AVAILABLE_TITLE',		'Tarjolla olevat sivurungot');
define('_SKIN_NEW_TITLE',			'Uusi sivurunko');
define('_SKIN_NAME',				'Nimi');
define('_SKIN_DESC',				'Kuvaus');
define('_SKIN_TYPE',				'Sisällön tyyppi');
define('_SKIN_CREATE',				'Luo');
define('_SKIN_CREATE_BTN',			'Luo sivurunko');
define('_SKIN_EDITONE_TITLE',		'Muokkaa sivurunkoa');
define('_SKIN_BACK',				'Takaisin sivurunko -sivulle');
define('_SKIN_PARTS_TITLE',			'Sivurungon osat');
define('_SKIN_PARTS_MSG',			'Kaikkia osia ei tarvita jokaiselle sivurungolle. Jätä tyhjäksi ne joita et tarvitse. Valitse muokattava sivurunko alta:');
define('_SKIN_PART_MAIN',			'Merkinnät (indeksi)');
define('_SKIN_PART_ITEM',			'Yksittäiset merkintäsivut');
define('_SKIN_PART_ALIST',			'Arkisto (indeksi)');
define('_SKIN_PART_ARCHIVE',		'Arkistolistaukset');
define('_SKIN_PART_SEARCH',			'Etsi');
define('_SKIN_PART_ERROR',			'Virheet');
define('_SKIN_PART_MEMBER',			'Käyttäjän tiedot');
define('_SKIN_PART_POPUP',			'Kuva popupit');
define('_SKIN_GENSETTINGS_TITLE',	'Yleiset asetukset');
define('_SKIN_CHANGE',				'Muuta');
define('_SKIN_CHANGE_BTN',			'Muuta näitä asetuksia');
define('_SKIN_UPDATE_BTN',			'Päivitä sivurunko');
define('_SKIN_RESET_BTN',			'Resetoi data');
define('_SKIN_EDITPART_TITLE',		'Muokkaa sivurunkoa');
define('_SKIN_GOBACK',				'Palaa takaisin');
define('_SKIN_ALLOWEDVARS',			'Sallitut muuttujat (klikkaa saadaksesi infoa):');

// global settings
define('_SETTINGS_TITLE',			'Yleiset asetukset');
define('_SETTINGS_SUB_GENERAL',		'Yleiset asetukset');
define('_SETTINGS_DEFBLOG',			'Vakioblogi');
define('_SETTINGS_ADMINMAIL',		'Ylläpitäjän sähköpostiosoite');
define('_SETTINGS_SITENAME',		'Sivuston nimi');
define('_SETTINGS_SITEURL',			'Sivuston URL (pitäisi loppua kauttaviivaan)');
define('_SETTINGS_ADMINURL',		'Järjestelmänvalvoja-alueen osoite (pitäisi loppua kauttaviivaan)');
define('_SETTINGS_DIRS',			'Nucleus -hakemisto');
define('_SETTINGS_MEDIADIR',		'Media -hakemisto');
define('_SETTINGS_SEECONFIGPHP',	'(katso config.php)');
define('_SETTINGS_MEDIAURL',		'Media URL (pitäisi loppua kauttaviivaan)');
define('_SETTINGS_ALLOWUPLOAD',		'Salli tiedostojen lataus blogiin?');
define('_SETTINGS_ALLOWUPLOADTYPES','Sallitut tiedostomuodot ladatessa');
define('_SETTINGS_CHANGELOGIN',		'Salli käyttäjien vaihtaa tunnusta/salasanaa');
define('_SETTINGS_COOKIES_TITLE',	'Eväste asetukset');
define('_SETTINGS_COOKIELIFE',		'Kirjautumisevästeen elinaika');
define('_SETTINGS_COOKIESESSION',	'Sessioevästeet');
define('_SETTINGS_COOKIEMONTH',		'Kuukauden elinaika');
define('_SETTINGS_COOKIEPATH',		'Evästepolku (edistykselliset)');
define('_SETTINGS_COOKIEDOMAIN',	'Cookie Domain (edistykselliset)');
define('_SETTINGS_COOKIESECURE',	'Secure Cookie (edistykselliset)');
define('_SETTINGS_LASTVISIT',		'Tallenna edellisen käynnin evästeet');
define('_SETTINGS_ALLOWCREATE',		'Salli käyttäjien luoda käyttäjätili');
define('_SETTINGS_NEWLOGIN',		'Sisäänkirjautuminen sallittu käyttäjän luomilla tileillä');
define('_SETTINGS_NEWLOGIN2',		'(koskee vain vasta luotuja tilejä)');
define('_SETTINGS_MEMBERMSGS',		'Salli käyttäjältä-käyttäjälle palvelu');
define('_SETTINGS_LANGUAGE',		'Vakiokieli');
define('_SETTINGS_DISABLESITE',		'Sivusto pois käytöstä');
define('_SETTINGS_DBLOGIN',			'mySQL -kirjautuminen &amp; -tietokanta');
define('_SETTINGS_UPDATE',			'Päivitä asetukset');
define('_SETTINGS_UPDATE_BTN',		'Päivitä asetukset');
define('_SETTINGS_DISABLEJS',		'JavaScript -työkalurivi pois käytöstä');
define('_SETTINGS_MEDIA',			'Media/lataus -asetukset');
define('_SETTINGS_MEDIAPREFIX',		'Päiväysetuliite ladatuille tiedostoille');
define('_SETTINGS_MEMBERS',			'Käyttäjäasetukset');

// bans
define('_BAN_TITLE',				'Estolistasi');
define('_BAN_NONE',					'Ei estoja tälle weblogille');
define('_BAN_NEW_TITLE',			'Lisää uusi esto');
define('_BAN_NEW_TEXT',				'Lisää uusi esto nyt');
define('_BAN_REMOVE_TITLE',			'Poista esto');
define('_BAN_IPRANGE',				'IP-osoite');
define('_BAN_BLOGS',				'Mitkä blogit?');
define('_BAN_DELETE_TITLE',			'Poista esto');
define('_BAN_ALLBLOGS',				'Kaikki blogit joihin sinulla on järjestelmänvalvojan oikeudet.');
define('_BAN_REMOVED_TITLE',		'Esto poistettu');
define('_BAN_REMOVED_TEXT',			'Esto poistettu seuraavista blogeista:');
define('_BAN_ADD_TITLE',			'Lisää esto');
define('_BAN_IPRANGE_TEXT',			'Valitse ip-osoite, jonka haluat blokata. Mitä vähemmän numeroita siinä on, sitä enemmän osoitteita tullaan blokkaamaan.');
define('_BAN_BLOGS_TEXT',			'Voit estää ip:n vain yhdellä blogilla tai voit estää ip:n kaikilla niillä blogeilla, joihin sinulla järjestelmänvalvojan oikeudet. Tee valintasi alla.');
define('_BAN_REASON_TITLE',			'Syy');
define('_BAN_REASON_TEXT',			'Voit osoittaa syyn estolle, joka näytetään kun ip:n haltija yrittää lisätä uuden kommentin tai antaa karma äänen. Maksimipituus on 256 merkkiä.');
define('_BAN_ADD_BTN',				'Lisää esto');

// LOGIN screen
define('_LOGIN_MESSAGE',			'Viesti');
define('_LOGIN_NAME',				'Tunnus');
define('_LOGIN_PASSWORD',			'Salasana');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'Unohditko salasanasi?');

// membermanagement
define('_MEMBERS_TITLE',			'Käyttäjät');
define('_MEMBERS_CURRENT',			'Nykyiset käyttäjät');
define('_MEMBERS_NEW',				'Uusi käyttäjä');
define('_MEMBERS_DISPLAY',			'Tunnus');
define('_MEMBERS_DISPLAY_INFO',		'(Tämä on tunnus jota käytät kirjautumiseen)');
define('_MEMBERS_REALNAME',			'Oikea nimi');
define('_MEMBERS_PWD',				'Salasana');
define('_MEMBERS_REPPWD',			'Toista salasana');
define('_MEMBERS_EMAIL',			'Sähköpostiosoite');
define('_MEMBERS_EMAIL_EDIT',		'(Kun vaihdat sähköpostiosoitetta, uusi salasana tullaan automaattisesti postittamaan siihen osoitteeseen)');
define('_MEMBERS_URL',				'Sivuston osoite (URL)');
define('_MEMBERS_SUPERADMIN',		'Järjestelmänvalvojan oikeudet');
define('_MEMBERS_CANLOGIN',			'Voi kirjautua järjestelmänvalvoja alueelle');
define('_MEMBERS_NOTES',			'Tietoja');
define('_MEMBERS_NEW_BTN',			'Lisää käyttäjä');
define('_MEMBERS_EDIT',				'Käyttäjän muokkaus');
define('_MEMBERS_EDIT_BTN',			'Muuta asetuksia');
define('_MEMBERS_BACKTOOVERVIEW',	'Takaisin käyttäjät -sivulle');
define('_MEMBERS_DEFLANG',			'Kieli');
define('_MEMBERS_USESITELANG',		'- käytä sivuston vakioasetusta -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'Käy sivustolla');
define('_BLOGLIST_ADD',				'Lisää merkintä');
define('_BLOGLIST_TT_ADD',			'Lisää merkintä tähän weblogiin');
define('_BLOGLIST_EDIT',			'Muokkaa/poista merkintöjä');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Bookmarklet');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'Asetukset');
define('_BLOGLIST_TT_SETTINGS',		'Säädä asetuksia tai käsittele hallintaryhmää');
define('_BLOGLIST_BANS',			'Estot');
define('_BLOGLIST_TT_BANS',			'Tarkastele, lisää tai poista estettyjä ip:itä');
define('_BLOGLIST_DELETE',			'Poista kaikki');
define('_BLOGLIST_TT_DELETE',		'Poista tämä weblogi');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'Weblogisi');
define('_OVERVIEW_YRDRAFTS',		'Vedoksesi');
define('_OVERVIEW_YRSETTINGS',		'Asetuksesi');
define('_OVERVIEW_GSETTINGS',		'Yleiset asetukset');
define('_OVERVIEW_NOBLOGS',			'Et ole minkään weblogin hallintaryhmässä');
define('_OVERVIEW_NODRAFTS',		'Ei vedoksia');
define('_OVERVIEW_EDITSETTINGS',	'Muokkaa omia tietojasi...');
define('_OVERVIEW_BROWSEITEMS',		'Selaa merkintöjäsi...');
define('_OVERVIEW_BROWSECOMM',		'Selaa kommenttejasi...');
define('_OVERVIEW_VIEWLOG',			'Tarkastele toimintologia...');
define('_OVERVIEW_MEMBERS',			'Hallitse käyttäjiä...');
define('_OVERVIEW_NEWLOG',			'Luo uusi weblogi...');
define('_OVERVIEW_SETTINGS',		'Säädä yleisiä asetuksia...');
define('_OVERVIEW_TEMPLATES',		'Muokkaa templaatteja...');
define('_OVERVIEW_SKINS',			'Muokkaa sivurunkoja...');
define('_OVERVIEW_BACKUP',			'Tee varmuuskopio / palauta varmuuskopio...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'Merkinnät blogiin'); 
define('_ITEMLIST_YOUR',			'Merkintäsi');

// Comments
define('_COMMENTS',					'Kommentteja');
define('_NOCOMMENTS',				'Ei kommentteja tähän merkintään');
define('_COMMENTS_YOUR',			'Kommenttisi');
define('_NOCOMMENTS_YOUR',			'Et ole kirjoittanut kommentteja');

// LISTS (general)
define('_LISTS_NOMORE',				'Ei enää hakuvastauksia tai ei hakuvastauksia ollenkaan');
define('_LISTS_PREV',				'Edellinen');
define('_LISTS_NEXT',				'Seuraava');
define('_LISTS_SEARCH',				'Etsi');
define('_LISTS_CHANGE',				'Muuta');
define('_LISTS_PERPAGE',			'merkintää/sivu');
define('_LISTS_ACTIONS',			'Toiminnot');
define('_LISTS_DELETE',				'Poista');
define('_LISTS_EDIT',				'Muokkaa');
define('_LISTS_MOVE',				'Siirrä');
define('_LISTS_CLONE',				'Monista');
define('_LISTS_TITLE',				'Otsikko');
define('_LISTS_BLOG',				'Blogi');
define('_LISTS_NAME',				'Nimi');
define('_LISTS_DESC',				'Kuvaus');
define('_LISTS_TIME',				'Päiväys');
define('_LISTS_COMMENTS',			'Kommentit');
define('_LISTS_TYPE',				'Tyyppi');


// member list 
define('_LIST_MEMBER_NAME',			'Tunnus');
define('_LIST_MEMBER_RNAME',		'Oikea nimi');
define('_LIST_MEMBER_ADMIN',		'Ylijärjestelmänvalvoja? ');
define('_LIST_MEMBER_LOGIN',		'Voi kirjautua sisään? ');
define('_LIST_MEMBER_URL',			'Verkkosivut');

// banlist
define('_LIST_BAN_IPRANGE',			'IP-osoite');
define('_LIST_BAN_REASON',			'Syy');

// actionlist
define('_LIST_ACTION_MSG',			'Viesti');

// commentlist
define('_LIST_COMMENT_BANIP',		'Estä IP');
define('_LIST_COMMENT_WHO',			'Kirjoittaja');
define('_LIST_COMMENT',				'Kommentti');
define('_LIST_COMMENT_HOST',		'Isäntäkone');

// itemlist
define('_LIST_ITEM_INFO',			'Info');
define('_LIST_ITEM_CONTENT',		'Otsikko ja teksti');


// teamlist
define('_LIST_TEAM_ADMIN',			'Järjestelmänvalvoja ');
define('_LIST_TEAM_CHADMIN',		'Vaihda järjestelmänvalvoja');

// edit comments
define('_EDITC_TITLE',				'Muokkaa kommentteja');
define('_EDITC_WHO',				'Kirjoittaja');
define('_EDITC_HOST',				'Mistä?');
define('_EDITC_WHEN',				'Milloin?');
define('_EDITC_TEXT',				'Teksti');
define('_EDITC_EDIT',				'Muokkaa kommenttia');
define('_EDITC_MEMBER',				'käyttäjä');
define('_EDITC_NONMEMBER',			'ei-käyttäjä');

// move item
define('_MOVE_TITLE',				'Siirrä mihin blogiin?');
define('_MOVE_BTN',					'Siirrä merkintä');

?>