<?php
// English Nucleus Language File
// 
// Author: p0wer
// Nucleus version: v1.0-v3.1
//
// Please note: if you want to translate this file to your own language, be aware
// that in a next Nucleus version, new variables might be added and some other ones
// might be deleted. Therefor, it's important to list the Nucleus version for which 
// the file was written in your document.
//
// Fully translated language file can be sent to Wouter Demuynck (nucleus@demuynck.org)
// and will be available for download (with proper credit to the author, of course)

// START changed/added after 3.1 START

// global settings 
define('_SETTINGS_JSTOOLBAR',		'Javascript Toolbar Style');
define('_SETTINGS_JSTOOLBAR_FULL',	'Пълен Toolbar (IE)');
define('_SETTINGS_JSTOOLBAR_SIMPLE','Обикновен Toolbar (Non-IE)');
define('_SETTINGS_JSTOOLBAR_NONE',	'Изключи Toolbar');
define('_SETTINGS_URLMODE_HELP',	'(Info: <a href="documentation/tips.html#searchengines-fancyurls">Как да активираме fancy URLs</a>)');

// extra plugin settings part when editing categories/members/blogs/...
define('_PLUGINS_EXTRA',			'Екстра настройки на Plugin');

// itemlist info column keys
define('_LIST_ITEM_BLOG',			'blog:');
define('_LIST_ITEM_CAT',			'cat:');
define('_LIST_ITEM_AUTHOR',			'автор:');
define('_LIST_ITEM_DATE',			'дата:');
define('_LIST_ITEM_TIME',			'време:');

// indication of registered members in comments list
define('_LIST_COMMENTS_MEMBER', 	'(член)');

// batch operations
define('_BATCH_WITH_SEL',			'Със избраните:');
define('_BATCH_EXEC',				'Изпълнявам');

// quickmenu
define('_QMENU_HOME',				'Начало');
define('_QMENU_ADD',				'Добави Item');
define('_QMENU_ADD_SELECT',			'-- избери --');
define('_QMENU_USER_SETTINGS',		'Настройки');
define('_QMENU_USER_ITEMS',			'Items');
define('_QMENU_USER_COMMENTS',		'Коментар');
define('_QMENU_MANAGE',				'Управление');
define('_QMENU_MANAGE_LOG',			'Action Log');
define('_QMENU_MANAGE_SETTINGS',	'Глобални настройки');
define('_QMENU_MANAGE_MEMBERS',		'Членове');
define('_QMENU_MANAGE_NEWBLOG',		'Нов Weblog');
define('_QMENU_MANAGE_BACKUPS',		'Backups');
define('_QMENU_MANAGE_PLUGINS',		'Plugins');
define('_QMENU_LAYOUT',				'Оформление');
define('_QMENU_LAYOUT_SKINS',		'Skins');
define('_QMENU_LAYOUT_TEMPL',		'Шаблони');
define('_QMENU_LAYOUT_IEXPORT',		'Въвеждам/Извеждам');
define('_QMENU_PLUGINS',			'Plugins');

// quickmenu on logon screen
define('_QMENU_INTRO',				'Въведение');
define('_QMENU_INTRO_TEXT',			'<p>Това е logon екрана за Nucleus CMS, the content management system(система за управление на съдържание) , което се използва за поддържането на този сайт.</p><p>Ако имате акаунт, можете да влезете и да започнете да публикувате нови items(статий, новини.</p>');

// helppages for plugins
define('_ERROR_PLUGNOHELPFILE',		'Помощния файл за този plugin не може да бъде намерен');
define('_PLUGS_HELP_TITLE',			'Помощна страница за plugin');
define('_LIST_PLUGS_HELP', 			'Помощ');

// END changed/started after 3.1

// START changed/added after v2.5beta START

// general settings (security)
define('_SETTINGS_EXTAUTH',			'Включи External Authentication(външна автентичност');
define('_WARNING_EXTAUTH',			'Внимание: Включи само ако е необходимо.');

// member profile
define('_MEMBERS_BYPASS',			'Използвай External Authentication');

// 'always include in search' blog setting (yes/no) [in v2.5beta, the 'always' part wasn't clear]
define('_EBLOG_SEARCH',				'<em>Винаги</em> въвеждай в търсене');

// END changed/added after v2.5beta

// START introduced after v2.0 START

// media library
define('_MEDIA_VIEW',				'Виж');
define('_MEDIA_VIEW_TT',			'Виж файла (отваря се в нов прозорец)');
define('_MEDIA_FILTER_APPLY',		'Приложи филтър');
define('_MEDIA_FILTER_LABEL',		'Филртър: ');
define('_MEDIA_UPLOAD_TO',			'Качи на...');
define('_MEDIA_UPLOAD_NEW',			'Качи нов файл...');
define('_MEDIA_COLLECTION_SELECT',	'Избери');
define('_MEDIA_COLLECTION_TT',		'Премини на тази категория');
define('_MEDIA_COLLECTION_LABEL',	'Сегашна колекция: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'Подреди в ляво');
define('_ADD_ALIGNRIGHT_TT',		'Подреди в дясно');
define('_ADD_ALIGNCENTER_TT',		'Подреди в центъра');


// generic upload failure
define('_ERROR_UPLOADFAILED',		'Качването се провали');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'Разреши публикуване в миналото');
define('_ADD_CHANGEDATE',			'Обнови timestamp');
define('_BMLET_CHANGEDATE',			'Обнови timestamp');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'Въведи/Изведи кожи');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Normal');
define('_PARSER_INCMODE_SKINDIR',	'Use skin dir');
define('_SKIN_INCLUDE_MODE',		'Включи mode');
define('_SKIN_INCLUDE_PREFIX',		'включи prefix');

// global settings
define('_SETTINGS_BASESKIN',		'Base Skin');
define('_SETTINGS_SKINSURL',		'URL на кожата');
define('_SETTINGS_ACTIONSURL',		'Пълно URL до action.php');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'Не може да се мести default категорията');
define('_ERROR_MOVETOSELF',			'Не може да премести категорията (destination blog is the same as source blog)');
define('_MOVECAT_TITLE',			'Избери blog ,където да преместиш категорията');
define('_MOVECAT_BTN',				'Премести категория');

// URLMode setting
define('_SETTINGS_URLMODE',			'URL Mode');
define('_SETTINGS_URLMODE_NORMAL',	'Normal');
define('_SETTINGS_URLMODE_PATHINFO','Fancy');

// Batch operations
define('_BATCH_NOSELECTION',		'Не е избрано нищо за да се изпълни действието');
define('_BATCH_ITEMS',				'Batch операция на items');
define('_BATCH_CATEGORIES',			'Batch операция на категорий');
define('_BATCH_MEMBERS',			'Batch операция на членове');
define('_BATCH_TEAM',				'Batch операция на групови членове');
define('_BATCH_COMMENTS',			'Batch операция на коментари');
define('_BATCH_UNKNOWN',			'Неизвестна batch операция: ');
define('_BATCH_EXECUTING',			'Изпълнява се');
define('_BATCH_ONCATEGORY',			'на категория');
define('_BATCH_ONITEM',				'на item');
define('_BATCH_ONCOMMENT',			'на коментар');
define('_BATCH_ONMEMBER',			'на член');
define('_BATCH_ONTEAM',				'на групов член');
define('_BATCH_SUCCESS',			'Успех!');
define('_BATCH_DONE',				'Извършено!');
define('_BATCH_DELETE_CONFIRM',		'Потвърди изтриване на Batch');
define('_BATCH_DELETE_CONFIRM_BTN',	'Потвърди изтриване на Batch');
define('_BATCH_SELECTALL',			'избери всички');
define('_BATCH_DESELECTALL',		'премахни всички');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'Изтрий');
define('_BATCH_ITEM_MOVE',			'Премести');
define('_BATCH_MEMBER_DELETE',		'Изтрйй');
define('_BATCH_MEMBER_SET_ADM',		'Дай администраторски права');
define('_BATCH_MEMBER_UNSET_ADM',	'Отнеми администраторски права');
define('_BATCH_TEAM_DELETE',		'Изтрий от групата');
define('_BATCH_TEAM_SET_ADM',		'Дай администраторски права');
define('_BATCH_TEAM_UNSET_ADM',		'Отнеми администраторски права');
define('_BATCH_CAT_DELETE',			'Изтрий');
define('_BATCH_CAT_MOVE',			'Премести до друг blog');
define('_BATCH_COMMENT_DELETE',		'Изтрий');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'Добави нов item...');
define('_ADD_PLUGIN_EXTRAS',		'Екстра настройки на Plugin');

// errors
define('_ERROR_CATCREATEFAIL',		'Не може да създаде нова категория');
define('_ERROR_NUCLEUSVERSIONREQ',	'Този plugin изисква по-нова версия на Nucleus: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Назад към blogsettings');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Въведи');
define('_SKINIE_TITLE_EXPORT',		'Изведи');
define('_SKINIE_BTN_IMPORT',		'Въведи');
define('_SKINIE_BTN_EXPORT',		'Изведи избраните кожи/шаблони');
define('_SKINIE_LOCAL',				'Въведи от локален файл:');
define('_SKINIE_NOCANDIDATES',		'Не са намерени кандидати за въвеждане в категорията на кожите');
define('_SKINIE_FROMURL',			'Въведи от URL:');
define('_SKINIE_EXPORT_INTRO',		'Избери кожи и шаблони, които искаш да изведеш');
define('_SKINIE_EXPORT_SKINS',		'Кожи');
define('_SKINIE_EXPORT_TEMPLATES',	'Шаблони');
define('_SKINIE_EXPORT_EXTRA',		'Екстра инфо');
define('_SKINIE_CONFIRM_OVERWRITE',	'Overwrite кожи, които вече съществуват (виж nameclashes)');
define('_SKINIE_CONFIRM_IMPORT',	'Да, искам да въведа тов');
define('_SKINIE_CONFIRM_TITLE',		'About to import skins and templates');
define('_SKINIE_INFO_SKINS',		'Кожи във файла:');
define('_SKINIE_INFO_TEMPLATES',	'Шаблони във файла:');
define('_SKINIE_INFO_GENERAL',		'Инфо:');
define('_SKINIE_INFO_SKINCLASH',	'Skin name clashes:');
define('_SKINIE_INFO_TEMPLCLASH',	'Template name clashes:');
define('_SKINIE_INFO_IMPORTEDSKINS','Въведени кожи:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Въведени шаблони:');
define('_SKINIE_DONE',				'Въвеждане приключено');

define('_AND',						'и');
define('_OR',						'или');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'изпразни полето (кликни за редакция)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'ВключиMode:');
define('_LIST_SKINS_INCPREFIX',		'ВключиPrefix:');
define('_LIST_SKINS_DEFINED',		'Defined parts(Определени части):');

// backup
define('_BACKUPS_TITLE',			'Backup / Възвърни');
define('_BACKUP_TITLE',				'Backup');
define('_BACKUP_INTRO',				'Кликни на бутона по-долу за да създадеш копие на твоята Nucleus база данни. You\'ll be prompted to save a backup file. Запазете го на сигурно място.');
define('_BACKUP_ZIP_YES',			'Пробвай да използваш компресия');
define('_BACKUP_ZIP_NO',			'Не използвай компресия');
define('_BACKUP_BTN',				'Създай Backup');
define('_BACKUP_NOTE',				'<b>Забележка:</b> Само съдържанието на базата данни се съхранява в backup. Медия файловете и настройките на config.php са thus <b>НЕ</b> се включват в backup.');
define('_RESTORE_TITLE',			'Възвърни');
define('_RESTORE_NOTE',				'<b>Внимание:</b> Възвръщайки от backup ще <b>ИЗТРИЕ</b> всичките сегашни данни в Nucleus база данни! Направете това само, ако сте наистина сигурни!	<br />	<b>Забележка:</b> Уверете се, че версията на Nucleus, в която сте създали backup е същата като версията, която използвате в момента! В противен случай няма да работи');
define('_RESTORE_INTRO',			'Избери backup файла долу (той ще бъде качен на сървъра) и натиснете "Restore" бутона за да започне.');
define('_RESTORE_IMSURE',			'Да, сигурен съм, че искам да направя това!');
define('_RESTORE_BTN',				'Възвърни от Файл');
define('_RESTORE_WARNING',			'(уверете се, че възвръщате правилния backup, може да направите нов backup преди да започнете)');
define('_ERROR_BACKUP_NOTSURE',		'Трябва да маркирате \'I\'m sure\' testbox');
define('_RESTORE_COMPLETE',			'Възвръщане извършено');

// new item notification
define('_NOTIFY_NI_MSG',			'Нов item беше публикуван:');
define('_NOTIFY_NI_TITLE',			'Нов Item!');
define('_NOTIFY_KV_MSG',			'Karma гласуване на item:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'Коментар на item:');
define('_NOTIFY_NC_TITLE',			'Nucleus comment:');
define('_NOTIFY_USERID',			'Потребителско ID:');
define('_NOTIFY_USER',				'Потребител:');
define('_NOTIFY_COMMENT',			'Коментар:');
define('_NOTIFY_VOTE',				'Гласуване:');
define('_NOTIFY_HOST',				'Хост:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'Член:');
define('_NOTIFY_TITLE',				'Заглавие:');
define('_NOTIFY_CONTENTS',			'Contents:');

// member mail message
define('_MMAIL_MSG',				'Съобщението е изпратено до вас от');
define('_MMAIL_FROMANON',			'анонимен посетител');
define('_MMAIL_FROMNUC',			'Публикувано от Nucleus weblog at');
define('_MMAIL_TITLE',				'Съобщение от');
define('_MMAIL_MAIL',				'Съобщение:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'Добави Item');
define('_BMLET_EDIT',				'Редактирай Item');
define('_BMLET_DELETE',				'Изтрий Item');
define('_BMLET_BODY',				'Body(Тяло)');
define('_BMLET_MORE',				'Extended(Обширен)');
define('_BMLET_OPTIONS',			'Опции');
define('_BMLET_PREVIEW',			'Предварителен изглед');

// used in bookmarklet
define('_ITEM_UPDATED',				'Item беше updated');
define('_ITEM_DELETED',				'Item беше изтрит');

// plugins
define('_CONFIRMTXT_PLUGIN',		'Сигурни ли сте, че искате да изтриете plugin named(наименивания');
define('_ERROR_NOSUCHPLUGIN',		'Няма такъв plugin');
define('_ERROR_DUPPLUGIN',			'Съжалявам, този plugin вече е инсталиран');
define('_ERROR_PLUGFILEERROR',		'Не съществува такъв plugin, или достъпите са некоректно зададени');
define('_PLUGS_NOCANDIDATES',		'Не са намерени plugin кандидати');

define('_PLUGS_TITLE_MANAGE',		'Управление на Plugins');
define('_PLUGS_TITLE_INSTALLED',	'Инсталирани');
define('_PLUGS_TITLE_UPDATE',		'Update subscription list');
define('_PLUGS_TEXT_UPDATE',		'Nucleus пази в cache event subscriptions на plugins. Когато подобрите(upgrade) plugin заменяйки неговия файл, вие ще трябва да направите този update(обновяване) за да сте сигурни, че верния subscriptions са cached');
define('_PLUGS_TITLE_NEW',			'Инсталирай нов Plugin');
define('_PLUGS_ADD_TEXT',			'По-долу се напира списъка на всички файлове във вашата plugins директория, това може и да са неинсталирани plugins. Уверете се, че <strong>наистина сте сигурни</strong> ,че това е plugin преди да го добавите.');
define('_PLUGS_BTN_INSTALL',		'Инсталирай Plugin');
define('_BACKTOOVERVIEW',			'Върни се на overview');

// editlink
define('_TEMPLATE_EDITLINK',		'Редактирай Item Link');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'Добави ляв box(кутия)');
define('_ADD_RIGHT_TT',				'Добави десен box(кутия)');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'Нова категория...');

// new settings
define('_SETTINGS_PLUGINURL',		'Plugin URL');
define('_SETTINGS_MAXUPLOADSIZE',	'Max. upload файлов размер (bytes)');
define('_SETTINGS_NONMEMBERMSGS',	'Разреши на non-members да изпращат съобщения');
define('_SETTINGS_PROTECTMEMNAMES',	'Пази имената на членовете');

// overview screen
define('_OVERVIEW_PLUGINS',			'Manage Plugins...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'New member registration:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'Your email address:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'You do not have admin rights on any of the blogs that have the destination member on the teamlist. Therefor, you\'re not allowed to upload files to this member\'s media directory');

// plugin list
define('_LISTS_INFO',				'Информация');
define('_LIST_PLUGS_AUTHOR',		'От:');
define('_LIST_PLUGS_VER',			'Версия:');
define('_LIST_PLUGS_SITE',			'Посети сайт');
define('_LIST_PLUGS_DESC',			'Описание:');
define('_LIST_PLUGS_SUBS',			'Subscribes до следните events:');
define('_LIST_PLUGS_UP',			'move up');
define('_LIST_PLUGS_DOWN',			'move down');
define('_LIST_PLUGS_UNINSTALL',		'деинсталирай');
define('_LIST_PLUGS_ADMIN',			'admin');
define('_LIST_PLUGS_OPTIONS',		'edit&nbsp;options');

// plugin option list
define('_LISTS_VALUE',				'Стойност');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'този plugin няма никакви направени опций');
define('_PLUGS_BACK',				'Обратно към Plugin Overview');
define('_PLUGS_SAVE',				'Запази Options');
define('_PLUGS_OPTIONS_UPDATED',	'Plugin options updated');

define('_OVERVIEW_MANAGEMENT',		'Управление');
define('_OVERVIEW_MANAGE',			'Nucleus управление...');
define('_MANAGE_GENERAL',			'Генерално управление');
define('_MANAGE_SKINS',				'Кожи и шаблони');
define('_MANAGE_EXTRA',				'Екстра особености');

define('_BACKTOMANAGE',				'Обратно към Nucleus управление');


// END introduced after v1.1 END




// charset to use 
define('_CHARSET',					'iso-8859-5');

// global stuff
define('_LOGOUT',					'Log Out');
define('_LOGIN',					'Log In');
define('_YES',						'Да');
define('_NO',						'Не');
define('_SUBMIT',					'Submit');
define('_ERROR',					'Грешка');
define('_ERRORMSG',					'Появи се грешка!');
define('_BACK',						'Върни се');
define('_NOTLOGGEDIN',				'Not logged in');
define('_LOGGEDINAS',				'Logged in като');
define('_ADMINHOME',				'Admin Home');
define('_NAME',						'Име');
define('_BACKHOME',					'Върни се към Admin Home');
define('_BADACTION',				'Изисква се несъществуваща дейност');
define('_MESSAGE',					'Съобщение');
define('_HELP_TT',					'Помощ!');
define('_YOURSITE',					'Вашия сайт');


define('_POPUP_CLOSE',				'Затвори прозореца');

define('_LOGIN_PLEASE',				'Моля първо се логнете');

// commentform
define('_COMMENTFORM_YOUARE',		'Вие сте');
define('_COMMENTFORM_SUBMIT',		'Добави коментар');
define('_COMMENTFORM_COMMENT',		'Вашия коментар');
define('_COMMENTFORM_NAME',			'Име');
define('_COMMENTFORM_MAIL',			'E-mail/HTTP');
define('_COMMENTFORM_REMEMBER',		'Запомни ме');

// loginform
define('_LOGINFORM_NAME',			'Потребителско име');
define('_LOGINFORM_PWD',			'Парола');
define('_LOGINFORM_YOUARE',			'Logged in като');
define('_LOGINFORM_SHARED',			'Shared Computer');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'Изпрати съобщение');

// search form
define('_SEARCHFORM_SUBMIT',		'Търси');

// add item form
define('_ADD_ADDTO',				'Добави нов item към');
define('_ADD_CREATENEW',			'Създай item');
define('_ADD_BODY',					'Body');
define('_ADD_TITLE',				'Заглавие');
define('_ADD_MORE',					'Extended (по избор)');
define('_ADD_CATEGORY',				'Категория');
define('_ADD_PREVIEW',				'Preview');
define('_ADD_DISABLE_COMMENTS',		'Забрани коментари?');
define('_ADD_DRAFTNFUTURE',			'Draft &amp; Future Items');
define('_ADD_ADDITEM',				'Добави Item');
define('_ADD_ADDNOW',				'Добави сега');
define('_ADD_ADDLATER',				'Добави по-късно');
define('_ADD_PLACE_ON',				'Постави на');
define('_ADD_ADDDRAFT',				'Добави към drafts');
define('_ADD_NOPASTDATES',			'(дати и време в миналото НЕ са валидни, в такъв случай ще се използва сегашното време)');
define('_ADD_BOLD_TT',				'Bold');
define('_ADD_ITALIC_TT',			'Italic');
define('_ADD_HREF_TT',				'Направи Линк');
define('_ADD_MEDIA_TT',				'Добави медиа');
define('_ADD_PREVIEW_TT',			'Покажи/Скрий Preview');
define('_ADD_CUT_TT',				'Cut');
define('_ADD_COPY_TT',				'Copy');
define('_ADD_PASTE_TT',				'Paste');


// edit item form
define('_EDIT_ITEM',				'Редактирай Item');
define('_EDIT_SUBMIT',				'Редактирай Item');
define('_EDIT_ORIG_AUTHOR',			'Оригинален автор');
define('_EDIT_BACKTODRAFTS',		'Add back to drafts');
define('_EDIT_COMMENTSNOTE',		'(забележка: изключвайки коментарите няма _да_ скрие предишно добавени коментари)');

// used on delete screens
define('_DELETE_CONFIRM',			'Моля, потвърдете изтриването');
define('_DELETE_CONFIRM_BTN',		'Потвърди изтриване');
define('_CONFIRMTXT_ITEM',			'Вие сте на път да изтриете the item следния item:');
define('_CONFIRMTXT_COMMENT',		'Вие сте на път да изтриете следния коментар:');
define('_CONFIRMTXT_TEAM1',			'Вие сте на път да изтриете ');
define('_CONFIRMTXT_TEAM2',			' от teamlist за blog ');
define('_CONFIRMTXT_BLOG',			'Blog-a , който ще изтриете е: ');
define('_WARNINGTXT_BLOGDEL',		'Внимание! Изтривайки blog ще изтриете ВСИЧКИ items от този blog, и всички коментари. Моля потвърдете, че сте СИГУРЕН какво правите!<br />Също така, не прекъсвайте Nucleus , когато премахва вашия blog.');
define('_CONFIRMTXT_MEMBER',		'На път сте да изтриете профила на следния член: ');
define('_CONFIRMTXT_TEMPLATE',		'На път сте да изтриете template named ');
define('_CONFIRMTXT_SKIN',			'На път сте да изтриете skin named ');
define('_CONFIRMTXT_BAN',			'На път сте да изтриете ban-а за ip range');
define('_CONFIRMTXT_CATEGORY',		'На път сте да изтриете категорията ');

// some status messages
define('_DELETED_ITEM',				'Item изтрит');
define('_DELETED_MEMBER',			'Член изтрит');
define('_DELETED_COMMENT',			'Коментар изтрит');
define('_DELETED_BLOG',				'Blog изтрит');
define('_DELETED_CATEGORY',			'Категория изтрита');
define('_ITEM_MOVED',				'Item преместен');
define('_ITEM_ADDED',				'Item добавен');
define('_COMMENT_UPDATED',			'Коментар обновен');
define('_SKIN_UPDATED',				'Skin data has been saved');
define('_TEMPLATE_UPDATED',			'Template data has been saved');

// errors
define('_ERROR_COMMENT_LONGWORD',	'Моля не използвайте думи с дължина по-голяма от 90 символа във вашите коментари');
define('_ERROR_COMMENT_NOCOMMENT',	'Моля напишете коментар');
define('_ERROR_COMMENT_NOUSERNAME',	'Лошо потебителско име');
define('_ERROR_COMMENT_TOOLONG',	'Вашият коментар е много дълъг (max. 5000 символа)');
define('_ERROR_COMMENTS_DISABLED',	'Коментарите за този блог са понастоящем са спрени.');
define('_ERROR_COMMENTS_NONPUBLIC',	'Трябва да сте се логнали като член за да добавяте коментари към този blog');
define('_ERROR_COMMENTS_MEMBERNICK','Името, което искате да използвате за да публикувате коментари се използва от член на сайта. Изберете нещо друго.');
define('_ERROR_SKIN',				'Skin error');
define('_ERROR_ITEMCLOSED',			'Този item е затворен, не е възможно да добавяте нови коментари към него или да гласувате на него');
define('_ERROR_NOSUCHITEM',			'Не съществува такъв item');
define('_ERROR_NOSUCHBLOG',			'Няма такъв blog');
define('_ERROR_NOSUCHSKIN',			'Няма такава кожа');
define('_ERROR_NOSUCHMEMBER',		'Няма такъв член');
define('_ERROR_NOTONTEAM',			'Ти не си към груповата листа на този weblog.');
define('_ERROR_BADDESTBLOG',		'Назначения blog не съществува');
define('_ERROR_NOTONDESTTEAM',		'Не можете да местите items, докато не сте на груповата листа на назначения blog');
define('_ERROR_NOEMPTYITEMS',		'Не можете да добавяте празни items!');
define('_ERROR_BADMAILADDRESS',		'Email адреса не е валиден');
define('_ERROR_BADNOTIFY',			'Един или няколко от предоставените за известяване адреси не е валиден email адрес');
define('_ERROR_BADNAME',			'Името не е валидно (само a-z и 0-9 са разрешени, без празно място в началото/края)');
define('_ERROR_NICKNAMEINUSE',		'Друг член вече използва това потребителско име');
define('_ERROR_PASSWORDMISMATCH',	'Паролите трябва да съвпадат');
define('_ERROR_PASSWORDTOOSHORT',	'Паролата трябва да е минимум 6 знака');
define('_ERROR_PASSWORDMISSING',	'Паролата не може да е празна');
define('_ERROR_REALNAMEMISSING',	'Трябва да въведете истинско име');
define('_ERROR_ATLEASTONEADMIN',	'Винаги трябва да има поне един супер админ за да може да се логва към администраторската ареа.');
define('_ERROR_ATLEASTONEBLOGADMIN','Изпълнявайки тази операция ще остави вашия weblog неподдържаем. Моля уверете се , че винаги има поне един администратор.');
define('_ERROR_ALREADYONTEAM',		'Не можете да добавяте член , който вече е в групата');
define('_ERROR_BADSHORTBLOGNAME',	'Краткото име на blog-а трябва да съдържа само a-z and 0-9, без разстояния');
define('_ERROR_DUPSHORTBLOGNAME',	'Друг blog вече има същото кратко име. Тези имена трябва да са уникални');
define('_ERROR_UPDATEFILE',			'Cannot get write access to the update-file. Уверете се, че достъпите до файла са сложени както трябва (използвайте chmodding it to 666). Също така отбележете, че местонахождението се отнася до admin-area директорията, така, че може да искате да използвате absolute path (нещо като /your/path/to/nucleus/)');
define('_ERROR_DELDEFBLOG',			'Не можете да изтриете default blog');
define('_ERROR_DELETEMEMBER',		'Този член не може да бъде изтрир, сигурно защото той/тя е автор на items или коментари');
define('_ERROR_BADTEMPLATENAME',	'Невалидно име за шаблон, използвайте само a-z и 0-9, без разстояния');
define('_ERROR_DUPTEMPLATENAME',	'Друг шаблон с това име вече съществува');
define('_ERROR_BADSKINNAME',		'Невалидно име за кожа (само a-z, 0-9 са разрешени, без разстояния)');
define('_ERROR_DUPSKINNAME',		'Друга кожа с това име вече съществува');
define('_ERROR_DEFAULTSKIN',		'Винаги трябва да има кожа с име "default"');
define('_ERROR_SKINDEFDELETE',		'Не може да изтрие кожа докато тя е default skin за следния/те weblog: ');
define('_ERROR_DISALLOWED',			'Съжалявам, вие нямате разрешение да извършите това действие');
define('_ERROR_DELETEBAN',			'Грешка при опита да се изтрие ban (ban не съществува)');
define('_ERROR_ADDBAN',				'Грешка при опита да се добави ban. Ban може да не е добавен коректно до всички blogs.');
define('_ERROR_BADACTION',			'Изисканото действие не съществува');
define('_ERROR_MEMBERMAILDISABLED',	'Emails от член към член са забранени');
define('_ERROR_MEMBERCREATEDISABLED','Създаването на членски акаунти е изключено');
define('_ERROR_INCORRECTEMAIL',		'Невалиден mail адрес');
define('_ERROR_VOTEDBEFORE',		'Вече гласувахте за този item');
define('_ERROR_BANNED1',			'Не може да извърши действието докато вие (ip range ');
define('_ERROR_BANNED2',			') сте banned да правите това. Съобщението беше: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'Вие трябва да се логнете, за да извършите това действие');
define('_ERROR_CONNECT',			'Connect Error');
define('_ERROR_FILE_TOO_BIG',		'Файла е твърде голям!');
define('_ERROR_BADFILETYPE',		'Съжалявам, това разширение на файла не е разрешено');
define('_ERROR_BADREQUEST',			'Лощо upload искане');
define('_ERROR_DISALLOWEDUPLOAD',	'Вие не сте в груповата листа на никой weblog. Следователно нямате разрешение да качвате файлове');
define('_ERROR_BADPERMISSIONS',		'File/Dir достъпите не са нагласени вярно');
define('_ERROR_UPLOADMOVEP',		'Грешка при местенето на качения файл');
define('_ERROR_UPLOADCOPY',			'Грешка при копиране на файла');
define('_ERROR_UPLOADDUPLICATE',	'Друг файл със същото име вече съществува. Опитайте се да го преименувате преди да го качите.');
define('_ERROR_LOGINDISALLOWED',	'Sorry, you\'re not allowed to log in to the admin area. You can log in as another user, though');
define('_ERROR_DBCONNECT',			'Не може да се свърже с mySQL сървъра');
define('_ERROR_DBSELECT',			'Не може да избере nucleus базата данни.');
define('_ERROR_NOSUCHLANGUAGE',		'Не съществува такъв езиков файл');
define('_ERROR_NOSUCHCATEGORY',		'не съществува такава категория');
define('_ERROR_DELETELASTCATEGORY',	'Трябва да има поне една категория');
define('_ERROR_DELETEDEFCATEGORY',	'Не можете да изтриете default категорията');
define('_ERROR_BADCATEGORYNAME',	'Лошо име на категорията');
define('_ERROR_DUPCATEGORYNAME',	'Друга категория с това име вече съществува');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'Внимание: Текущата стойност не е дитектория!');
define('_WARNING_NOTREADABLE',		'Внимание: Текущата стойност е non-readable directory!');
define('_WARNING_NOTWRITABLE',		'Внимание: Текущата стойност НЕ е a writable directory!');

// media and upload
define('_MEDIA_UPLOADLINK',			'Качи нов файл');
define('_MEDIA_MODIFIED',			'изменено');
define('_MEDIA_FILENAME',			'име на файла');
define('_MEDIA_DIMENSIONS',			'размери');
define('_MEDIA_INLINE',				'Inline');
define('_MEDIA_POPUP',				'Popup');
define('_UPLOAD_TITLE',				'Избери Файл');
define('_UPLOAD_MSG',				'избери файла който искате да качите , и натиснете \'Upload\' бутона.');
define('_UPLOAD_BUTTON',			'Качи');

// some status messages
define('_MSG_ACCOUNTCREATED',		'Акаунта е създаден. Паролата ще бъде изпратена чрез e-mail');
define('_MSG_PASSWORDSENT',			'Паролата беше изпратена с e-mail.');
define('_MSG_LOGINAGAIN',			'Ще трябва да се логнете отново, защото вашата инсформация се промени');
define('_MSG_SETTINGSCHANGED',		'Опций променени');
define('_MSG_ADMINCHANGED',			'Администратор променен');
define('_MSG_NEWBLOG',				'Нов Blog е създаден');
define('_MSG_ACTIONLOGCLEARED',		'Action Log изчистен');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'Неразрешено действие: ');
define('_ACTIONLOG_PWDREMINDERSENT','Нова парола е изпратена за ');
define('_ACTIONLOG_TITLE',			'Action Log');
define('_ACTIONLOG_CLEAR_TITLE',	'Изчисти Action Log');
define('_ACTIONLOG_CLEAR_TEXT',		'Изчисти action log сега');

// team management
define('_TEAM_TITLE',				'Управлявай група за blog ');
define('_TEAM_CURRENT',				'Сегашна група');
define('_TEAM_ADDNEW',				'Добави нов член към група');
define('_TEAM_CHOOSEMEMBER',		'Избери член');
define('_TEAM_ADMIN',				'Администраторски привилегий? ');
define('_TEAM_ADD',					'Добави към група');
define('_TEAM_ADD_BTN',				'Добави към група');

// blogsettings
define('_EBLOG_TITLE',				'Редактирай опцийте на Blog');
define('_EBLOG_TEAM_TITLE',			'Редактирай група');
define('_EBLOG_TEAM_TEXT',			'Натисни тук за да редактираш своята група...');
define('_EBLOG_SETTINGS_TITLE',		'Опций на Blog');
define('_EBLOG_NAME',				'Име на Blog');
define('_EBLOG_SHORTNAME',			'Кратко име на Blog');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(трябва да съдержа само a-z и без разстояния)');
define('_EBLOG_DESC',				'Описание на Blog');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'Default Кожа');
define('_EBLOG_DEFCAT',				'Default Категория');
define('_EBLOG_LINEBREAKS',			'Convert line breaks');
define('_EBLOG_DISABLECOMMENTS',	'Разреши коментари?<br /><small>(Забранявайки коментари означава, че добавянето на коментари не е разрешено.)</small>');
define('_EBLOG_ANONYMOUS',			'Разреши коментари от non-members?');
define('_EBLOG_NOTIFY',				'Съобщавай адрес(си) (use ; as separator)');
define('_EBLOG_NOTIFY_ON',			'Notify on');
define('_EBLOG_NOTIFY_COMMENT',		'Нови коментари');
define('_EBLOG_NOTIFY_KARMA',		'Нови karma гласувания');
define('_EBLOG_NOTIFY_ITEM',		'Нови weblog items');
define('_EBLOG_PING',				'Ping Weblogs.com на обновяване?');
define('_EBLOG_MAXCOMMENTS',		'Максимален обем на коментарите');
define('_EBLOG_UPDATE',				'Обнови файл');
define('_EBLOG_OFFSET',				'Time Offset');
define('_EBLOG_STIME',				'Текущото време на сървъра е');
define('_EBLOG_BTIME',				'Текущото време на blog е');
define('_EBLOG_CHANGE',				'Промени настройки');
define('_EBLOG_CHANGE_BTN',			'Промени настройки');
define('_EBLOG_ADMIN',				'Blog Admin');
define('_EBLOG_ADMIN_MSG',			'Ще ви бъдат предоставени администраторски привлиегий');
define('_EBLOG_CREATE_TITLE',		'Създай нов weblog');
define('_EBLOG_CREATE_TEXT',		'Попълни формата по-долу за да съдадеш нов weblog. <br /><br /> <b>Забележка:</b> Само важните опции са показани. Ако искате на нагласите екстра опции, влзете в страницата на blogsettings след като сте създали вашия блог.');
define('_EBLOG_CREATE',				'Създай!');
define('_EBLOG_CREATE_BTN',			'Създай Weblog');
define('_EBLOG_CAT_TITLE',			'Категорий');
define('_EBLOG_CAT_NAME',			'Име на категорията');
define('_EBLOG_CAT_DESC',			'Описание на категорията');
define('_EBLOG_CAT_CREATE',			'Създай нова категория');
define('_EBLOG_CAT_UPDATE',			'Обнови категория');
define('_EBLOG_CAT_UPDATE_BTN',		'Обнови категория');

// templates
define('_TEMPLATE_TITLE',			'Редактирай шаблони');
define('_TEMPLATE_AVAILABLE_TITLE',	'Налични шаблони');
define('_TEMPLATE_NEW_TITLE',		'Нов шаблон');
define('_TEMPLATE_NAME',			'Име на шаблона');
define('_TEMPLATE_DESC',			'Описание на шаблона');
define('_TEMPLATE_CREATE',			'Създай шаблон');
define('_TEMPLATE_CREATE_BTN',		'Създай шаблон');
define('_TEMPLATE_EDIT_TITLE',		'Редактирай шаблон');
define('_TEMPLATE_BACK',			'Обратно към Template Overview');
define('_TEMPLATE_EDIT_MSG',		'Не всички части на шаблона са нужни, остави празни тези които не са обходими.');
define('_TEMPLATE_SETTINGS',		'Настройки на шаблона');
define('_TEMPLATE_ITEMS',			'Items');
define('_TEMPLATE_ITEMHEADER',		'Item Header');
define('_TEMPLATE_ITEMBODY',		'Item Body');
define('_TEMPLATE_ITEMFOOTER',		'Item Footer');
define('_TEMPLATE_MORELINK',		'Link to extended entry');
define('_TEMPLATE_NEW',				'Indication of new item');
define('_TEMPLATE_COMMENTS_ANY',	'Коментари (ако има)');
define('_TEMPLATE_CHEADER',			'Comments Header');
define('_TEMPLATE_CBODY',			'Comments Body');
define('_TEMPLATE_CFOOTER',			'Comments Footer');
define('_TEMPLATE_CONE',			'Един коментар');
define('_TEMPLATE_CMANY',			'Два (или повече) коментара');
define('_TEMPLATE_CMORE',			'Прочети още коментари');
define('_TEMPLATE_CMEXTRA',			'Member Extra');
define('_TEMPLATE_COMMENTS_NONE',	'Коментари (ако няма)');
define('_TEMPLATE_CNONE',			'Няма коментари');
define('_TEMPLATE_COMMENTS_TOOMUCH','Коментари (ако има, но са твърде много да се покажат inline)');
define('_TEMPLATE_CTOOMUCH',		'Твърде много коментари');
define('_TEMPLATE_ARCHIVELIST',		'Archive Lists');
define('_TEMPLATE_AHEADER',			'Archive List Header');
define('_TEMPLATE_AITEM',			'Archive List Item');
define('_TEMPLATE_AFOOTER',			'Archive List Footer');
define('_TEMPLATE_DATETIME',		'Дата and време');
define('_TEMPLATE_DHEADER',			'Date Header');
define('_TEMPLATE_DFOOTER',			'Date Footer');
define('_TEMPLATE_DFORMAT',			'Дата формат');
define('_TEMPLATE_TFORMAT',			'Време формат');
define('_TEMPLATE_LOCALE',			'Locale');
define('_TEMPLATE_IMAGE',			'Image popups');
define('_TEMPLATE_PCODE',			'Popup Link Code');
define('_TEMPLATE_ICODE',			'Inline Image Code');
define('_TEMPLATE_MCODE',			'Media Object Link Code');
define('_TEMPLATE_SEARCH',			'Търси');
define('_TEMPLATE_SHIGHLIGHT',		'Highlight');
define('_TEMPLATE_SNOTFOUND',		'Търсенето не даде резултатуи');
define('_TEMPLATE_UPDATE',			'Обнови');
define('_TEMPLATE_UPDATE_BTN',		'Обнови Шаблон');
define('_TEMPLATE_RESET_BTN',		'Reset Data');
define('_TEMPLATE_CATEGORYLIST',	'Списък на категорийте');
define('_TEMPLATE_CATHEADER',		'Category List Header');
define('_TEMPLATE_CATITEM',			'Category List Item');
define('_TEMPLATE_CATFOOTER',		'Category List Footer');

// skins
define('_SKIN_EDIT_TITLE',			'Редактирай кожи');
define('_SKIN_AVAILABLE_TITLE',		'Налични кожи');
define('_SKIN_NEW_TITLE',			'Нова кожа');
define('_SKIN_NAME',				'Име');
define('_SKIN_DESC',				'Описание');
define('_SKIN_TYPE',				'Content Type');
define('_SKIN_CREATE',				'Създай');
define('_SKIN_CREATE_BTN',			'Създай кожа');
define('_SKIN_EDITONE_TITLE',		'Редактирай кожа');
define('_SKIN_BACK',				'Обратно към Skin Overview');
define('_SKIN_PARTS_TITLE',			'Части на кожата');
define('_SKIN_PARTS_MSG',			'Не всички части са необходими за всяка кожа. Остави празни тези, от който нямаш нужда. Choose the skin type to edit below:');
define('_SKIN_PART_MAIN',			'Main Index');
define('_SKIN_PART_ITEM',			'Item Pages');
define('_SKIN_PART_ALIST',			'Списък на Архива');
define('_SKIN_PART_ARCHIVE',		'Архив');
define('_SKIN_PART_SEARCH',			'Търски');
define('_SKIN_PART_ERROR',			'Грешки');
define('_SKIN_PART_MEMBER',			'Детайли на члена');
define('_SKIN_PART_POPUP',			'Image Popups');
define('_SKIN_GENSETTINGS_TITLE',	'Генерални настройки');
define('_SKIN_CHANGE',				'Промени');
define('_SKIN_CHANGE_BTN',			'Промени тези настройки');
define('_SKIN_UPDATE_BTN',			'Обнови кожа');
define('_SKIN_RESET_BTN',			'Reset Data');
define('_SKIN_EDITPART_TITLE',		'Редактирай кожа');
define('_SKIN_GOBACK',				'Върни се назад');
define('_SKIN_ALLOWEDVARS',			'Разрешени променливи (натисни за инфо):');

// global settings
define('_SETTINGS_TITLE',			'Генерални настойки');
define('_SETTINGS_SUB_GENERAL',		'Генерални настойки');
define('_SETTINGS_DEFBLOG',			'Default Blog');
define('_SETTINGS_ADMINMAIL',		'Email на администратора');
define('_SETTINGS_SITENAME',		'Име на сайта');
define('_SETTINGS_SITEURL',			'URL на сайта (трябва да зъвешва със slash(наклонена линия))');
define('_SETTINGS_ADMINURL',		'URL на Admin Area (трябва да зъвешва със slash(наклонена линия))');
define('_SETTINGS_DIRS',			'Nucleus директории');
define('_SETTINGS_MEDIADIR',		'Media директория');
define('_SETTINGS_SEECONFIGPHP',	'(виж config.php)');
define('_SETTINGS_MEDIAURL',		'Media URL (трябва да зъвешва със slash(наклонена линия))');
define('_SETTINGS_ALLOWUPLOAD',		'Разреши качване на файлове?');
define('_SETTINGS_ALLOWUPLOADTYPES','Разреши видовете файлови за качване');
define('_SETTINGS_CHANGELOGIN',		'Разреши на членовете да сменят Потребителско име/Парола');
define('_SETTINGS_COOKIES_TITLE',	'Cookie настройки');
define('_SETTINGS_COOKIELIFE',		'Login Cookie Lifetime');
define('_SETTINGS_COOKIESESSION',	'Session Cookies');
define('_SETTINGS_COOKIEMONTH',		'Lifetime of a Month');
define('_SETTINGS_COOKIEPATH',		'Cookie Path (advanced)');
define('_SETTINGS_COOKIEDOMAIN',	'Cookie Domain (advanced)');
define('_SETTINGS_COOKIESECURE',	'Secure Cookie (advanced)');
define('_SETTINGS_LASTVISIT',		'Запази Cookies от последното посещение');
define('_SETTINGS_ALLOWCREATE',		'Разреши на посетителите да създават членски акаунт');
define('_SETTINGS_NEWLOGIN',		'Login разрешен за Потребителски-Създадени акаунти');
define('_SETTINGS_NEWLOGIN2',		'(отнася се само за новосъздадени акаунти)');
define('_SETTINGS_MEMBERMSGS',		'Разреши Member-2-Member услугата');
define('_SETTINGS_LANGUAGE',		'Default Language');
define('_SETTINGS_DISABLESITE',		'Спри сайта');
define('_SETTINGS_DBLOGIN',			'mySQL Login &amp; Database');
define('_SETTINGS_UPDATE',			'Обновени настройки');
define('_SETTINGS_UPDATE_BTN',		'Обновени настройки');
define('_SETTINGS_DISABLEJS',		'Изключи JavaScript Toolbar');
define('_SETTINGS_MEDIA',			'Media/Upload настройки');
define('_SETTINGS_MEDIAPREFIX',		'Prefix качените файлове с дата');
define('_SETTINGS_MEMBERS',			'Настройки на членовете');

// bans
define('_BAN_TITLE',				'Ban списък за');
define('_BAN_NONE',					'Няма bans за този weblog');
define('_BAN_NEW_TITLE',			'Добави нов Ban');
define('_BAN_NEW_TEXT',				'Добави нов ban веднага');
define('_BAN_REMOVE_TITLE',			'Премахни Ban');
define('_BAN_IPRANGE',				'IP Range');
define('_BAN_BLOGS',				'Кои blogs?');
define('_BAN_DELETE_TITLE',			'Изтрий Ban');
define('_BAN_ALLBLOGS',				'Всички блогове, до които имаш администраторски привилегий.');
define('_BAN_REMOVED_TITLE',		'Ban премахнат');
define('_BAN_REMOVED_TEXT',			'Ban беше премахнта за следните блогове:');
define('_BAN_ADD_TITLE',			'Добави Ban');
define('_BAN_IPRANGE_TEXT',			'Избери IP range който искаш да блокираш. Колкото по-малко числа, повече адреси ще бъдат блокирани.');
define('_BAN_BLOGS_TEXT',			'Можете да изберете да ban IP на един блог само, или може да изберете да блокирате IP на всички blogs където имате администраторски привилегий. Make your choice below.');
define('_BAN_REASON_TITLE',			'Причина');
define('_BAN_REASON_TEXT',			'Може да предоставите причина за бан, която ще се показва когато собственика на това IP се опита да добави коментар или се опита да гласува с karma. Максималната дължина е 256 символа.');
define('_BAN_ADD_BTN',				'Добави Ban');

// LOGIN screen
define('_LOGIN_MESSAGE',			'Съобщение');
define('_LOGIN_NAME',				'Име');
define('_LOGIN_PASSWORD',			'Парола');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'Забравена парола?');

// membermanagement
define('_MEMBERS_TITLE',			'Управление на члена');
define('_MEMBERS_CURRENT',			'Текущи членове ');
define('_MEMBERS_NEW',				'Нов член');
define('_MEMBERS_DISPLAY',			'Покажи име');
define('_MEMBERS_DISPLAY_INFO',		'(Това е името, което използвате за login)');
define('_MEMBERS_REALNAME',			'Истинско име');
define('_MEMBERS_PWD',				'парола');
define('_MEMBERS_REPPWD',			'Повтори парола');
define('_MEMBERS_EMAIL',			'Email адрес');
define('_MEMBERS_EMAIL_EDIT',		'(Когато промениш е-мейл адрес, нова парола ще бъде автоматично изпратена до този адрес)');
define('_MEMBERS_URL',				'Website адрес (URL)');
define('_MEMBERS_SUPERADMIN',		'Администраторски Привилегии');
define('_MEMBERS_CANLOGIN',			'Може да се login до администраторската ареа');
define('_MEMBERS_NOTES',			'Бележки');
define('_MEMBERS_NEW_BTN',			'Добави член');
define('_MEMBERS_EDIT',				'Редактирай член');
define('_MEMBERS_EDIT_BTN',			'Промени настройки');
define('_MEMBERS_BACKTOOVERVIEW',	'Обратно към Member Overview');
define('_MEMBERS_DEFLANG',			'Език');
define('_MEMBERS_USESITELANG',		'- използвай настройките на сайта -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'Посети сайт');
define('_BLOGLIST_ADD',				'добави Item');
define('_BLOGLIST_TT_ADD',			'Добави нов item до този weblog');
define('_BLOGLIST_EDIT',			'Редактирай/Изтрий Items');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Bookmarklet');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'Настройки');
define('_BLOGLIST_TT_SETTINGS',		'Редактирай настройки или управлявай група');
define('_BLOGLIST_BANS',			'Bans');
define('_BLOGLIST_TT_BANS',			'Виж, доба или премахни banned IP-та');
define('_BLOGLIST_DELETE',			'Изтрий всички');
define('_BLOGLIST_TT_DELETE',		'Изтрий този  weblog');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'Твоите weblogs');
define('_OVERVIEW_YRDRAFTS',		'Твоите drafts');
define('_OVERVIEW_YRSETTINGS',		'Твоите настройки');
define('_OVERVIEW_GSETTINGS',		'Генерални настройки');
define('_OVERVIEW_NOBLOGS',			'Вие не сте в груповата листана никой weblogs');
define('_OVERVIEW_NODRAFTS',		'Няма drafts');
define('_OVERVIEW_EDITSETTINGS',	'Редактирай твоите настройки...');
define('_OVERVIEW_BROWSEITEMS',		'Разгледай твоите items...');
define('_OVERVIEW_BROWSECOMM',		'Разгледай твоите коментари...');
define('_OVERVIEW_VIEWLOG',			'Виж Action Log...');
define('_OVERVIEW_MEMBERS',			'Управлявай членовете...');
define('_OVERVIEW_NEWLOG',			'Създай нов Weblog...');
define('_OVERVIEW_SETTINGS',		'Редактирай Настройки...');
define('_OVERVIEW_TEMPLATES',		'Редактирай Шаблони...');
define('_OVERVIEW_SKINS',			'Редактирай кожи...');
define('_OVERVIEW_BACKUP',			'Backup/Restore...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'Items за blog'); 
define('_ITEMLIST_YOUR',			'Твоите items');

// Comments
define('_COMMENTS',					'Comments');
define('_NOCOMMENTS',				'No comments for this item');
define('_COMMENTS_YOUR',			'Your Comments');
define('_NOCOMMENTS_YOUR',			'You didn\'t write any comments');

// LISTS (general)
define('_LISTS_NOMORE',				'No more results, or no results at all');
define('_LISTS_PREV',				'Previous');
define('_LISTS_NEXT',				'Next');
define('_LISTS_SEARCH',				'Search');
define('_LISTS_CHANGE',				'Change');
define('_LISTS_PERPAGE',			'items/page');
define('_LISTS_ACTIONS',			'Actions');
define('_LISTS_DELETE',				'Delete');
define('_LISTS_EDIT',				'Edit');
define('_LISTS_MOVE',				'Move');
define('_LISTS_CLONE',				'Clone');
define('_LISTS_TITLE',				'Title');
define('_LISTS_BLOG',				'Blog');
define('_LISTS_NAME',				'Name');
define('_LISTS_DESC',				'Description');
define('_LISTS_TIME',				'Time');
define('_LISTS_COMMENTS',			'Коментари');
define('_LISTS_TYPE',				'Type');


// member list 
define('_LIST_MEMBER_NAME',			'Покажи име');
define('_LIST_MEMBER_RNAME',		'Истинско име');
define('_LIST_MEMBER_ADMIN',		'Супер-админ? ');
define('_LIST_MEMBER_LOGIN',		'Може да се login? ');
define('_LIST_MEMBER_URL',			'Website');

// banlist
define('_LIST_BAN_IPRANGE',			'IP Range');
define('_LIST_BAN_REASON',			'Причина');

// actionlist
define('_LIST_ACTION_MSG',			'Съобщение');

// commentlist
define('_LIST_COMMENT_BANIP',		'Ban IP');
define('_LIST_COMMENT_WHO',			'Автор');
define('_LIST_COMMENT',				'Програма');
define('_LIST_COMMENT_HOST',		'Хост');

// itemlist
define('_LIST_ITEM_INFO',			'Инфо');
define('_LIST_ITEM_CONTENT',		'Заглавие и текст');


// teamlist
define('_LIST_TEAM_ADMIN',			'Админ ');
define('_LIST_TEAM_CHADMIN',		'Смени Админ');

// edit comments
define('_EDITC_TITLE',				'Редактирай коментари');
define('_EDITC_WHO',				'Автор');
define('_EDITC_HOST',				'От къде?');
define('_EDITC_WHEN',				'Кога?');
define('_EDITC_TEXT',				'Текст');
define('_EDITC_EDIT',				'Редактирай коментар');
define('_EDITC_MEMBER',				'член');
define('_EDITC_NONMEMBER',			'non member');

// move item
define('_MOVE_TITLE',				'Премести към кой blog?');
define('_MOVE_BTN',					'Премести Item');

?>