<?php
// English Nucleus Language File
//
// Author: Wouter Demuynck
// Nucleus version: v1.0-v3.2
//
// Please note: if you want to translate this file to your own language, be aware
// that in a next Nucleus version, new variables might be added and some other ones
// might be deleted. Therefor, it's important to list the Nucleus version for which
// the file was written in your document.
//
// Fully translated language file can be sent to us and will be made
// available for download (with proper credit to the author, of course)

// START changed/added after 3.15 START

define('_LIST_PLUG_SUBS_NEEDUPDATE','Используйте кнопку \'Обновление листа подписки\' чтобы обновить список плагинов подписки.');
define('_LIST_PLUGS_DEP',			'Необходим плагин(ы):');

// END changed/added after 3.15

// START changed/added after 3.1 START

// comments list per weblog
define('_COMMENTS_BLOG',			'Все комментарии дневника');
define('_NOCOMMENTS_BLOG',			'У этого журнала нет комментариев');
define('_BLOGLIST_COMMENTS',		'Комментарии');
define('_BLOGLIST_TT_COMMENTS',		'Список всех комментариев этого дневника');


// for use in archivetype-skinvar
define('_ARCHIVETYPE_DAY',			'день');
define('_ARCHIVETYPE_MONTH',		'месяц');

// tickets (prevents malicious users to trick an admin to perform actions he doesn't want)
define('_ERROR_BADTICKET',			'Облом, товарищ.');

// plugin dependency
define('_ERROR_INSREQPLUGIN',		'Установка плагина не прокатила, ему надо ');
define('_ERROR_DELREQPLUGIN',		'Удаление плагина не прокатило, он нужен ');

// cookie prefix
define('_SETTINGS_COOKIEPREFIX',	'Префикс Cookie');

// account activation
define('_ERROR_NOLOGON_NOACTIVATE',	'Не удалось послать ссылку активации. У вас не получится войти.');
define('_ERROR_ACTIVATE',			'Ссылки активации не существует, она неправильна, или кончилась. Такие дела.');
define('_ACTIONLOG_ACTIVATIONLINK', 'Ссылка активации послана');
define('_MSG_ACTIVATION_SENT',		'Ссылка активации ушла на почту.');

// activation link emails
define('_ACTIVATE_REGISTER_MAIL',	"Здравствуйте <%memberName%>,\n\nВам необходимо активировать свой аккаунт на <%siteName%> (<%siteUrl%>).\nВы можете сделать это щелкнув по ссылке: \n\n\t<%activationUrl%>\n\n . У вас всего два дня, поторопитесь.");
define('_ACTIVATE_REGISTER_MAILTITLE',	"'<%memberName%>', активируйте свой аккаунт.");
define('_ACTIVATE_REGISTER_TITLE',	'Добро пожаловать <%memberName%>');
define('_ACTIVATE_REGISTER_TEXT',	'Вы близко. Выберите пароль для своего аккаунта.');
define('_ACTIVATE_FORGOT_MAIL',		"Здравствуйте, <%memberName%>,\n\nИспользуя ссылку ниже, вы можете выбрать новый пароль для <%siteName%> (<%siteUrl%>).\n\n\t<%activationUrl%>\n\nУ. После этого ссылка активации будет недоступна.");
define('_ACTIVATE_FORGOT_MAILTITLE',"'<%memberName%>', активируйте свой аккаунт еще раз.");
define('_ACTIVATE_FORGOT_TITLE',	'Добро пожаловать, <%memberName%>');
define('_ACTIVATE_FORGOT_TEXT',		'Вы можете выбрать новый пароль для своего аккаунта ниже:');
define('_ACTIVATE_CHANGE_MAIL',		"Здравствуйте, <%memberName%>,\n\nНасколько мы знаем, вы поменяли свой e-mail адрес, поэтому вам придется заново активировать свой аккаунт на <%siteName%> (<%siteUrl%>).\nВы можете сделать это, используя ссылку: \n\n\t<%activationUrl%>\n\n . У вас всего два дня, поторопитесь.");
define('_ACTIVATE_CHANGE_MAILTITLE',"'<%memberName%>', активируйте свой аккаунт еще раз.");
define('_ACTIVATE_CHANGE_TITLE',	'Добро пожаловать, <%memberName%>');
define('_ACTIVATE_CHANGE_TEXT',		'Смена вашего e-mail адреса прошла успешно.');
define('_ACTIVATE_SUCCESS_TITLE',	'Активация прошла успешно.');
define('_ACTIVATE_SUCCESS_TEXT',	'Ваш аккаунт был успешно активирован. Мы тоже этому несказанно рады.');
define('_MEMBERS_SETPWD',			'Установить пароль');
define('_MEMBERS_SETPWD_BTN',		'Установить пароль');
define('_QMENU_ACTIVATE',			'Активация аккаунта');
define('_QMENU_ACTIVATE_TEXT',		'<p>После активации своего аккаунта, вы можете начать вести свой дневник, пройдя на страницу <a href="index.php?action=showlogin">входа в систему</a>.</p>');

define('_PLUGS_BTN_UPDATE',			'Обновить список подписки');

// global settings
define('_SETTINGS_JSTOOLBAR',		'Javascript тулбар');
define('_SETTINGS_JSTOOLBAR_FULL',	'Модный тулбар (IE)');
define('_SETTINGS_JSTOOLBAR_SIMPLE','Простой тулбар (Non-IE)');
define('_SETTINGS_JSTOOLBAR_NONE',	'Без тулбара');
define('_SETTINGS_URLMODE_HELP',	'(Информация: <a href="documentation/tips.html#searchengines-fancyurls">Как включить ЧПУ</a>)');

// extra plugin settings part when editing categories/members/blogs/...
define('_PLUGINS_EXTRA',			'Настройки экстра-плагинов');

// itemlist info column keys
define('_LIST_ITEM_BLOG',			'дневник:');
define('_LIST_ITEM_CAT',			'категория:');
define('_LIST_ITEM_AUTHOR',			'автор:');
define('_LIST_ITEM_DATE',			'дата:');
define('_LIST_ITEM_TIME',			'время:');

// indication of registered members in comments list
define('_LIST_COMMENTS_MEMBER', 	'(дневниковод)');

// batch operations
define('_BATCH_WITH_SEL',			'С выбранными:');
define('_BATCH_EXEC',				'Выполнить');

// quickmenu
define('_QMENU_HOME',				'В начало');
define('_QMENU_ADD',				'Написать');
define('_QMENU_ADD_SELECT',			'-- выбрать --');
define('_QMENU_USER_SETTINGS',		'Настройки');
define('_QMENU_USER_ITEMS',			'Записи');
define('_QMENU_USER_COMMENTS',		'Комментарии');
define('_QMENU_MANAGE',				'Управление');
define('_QMENU_MANAGE_LOG',			'Лог активации');
define('_QMENU_MANAGE_SETTINGS',	'Глобальные настройки');
define('_QMENU_MANAGE_MEMBERS',		'Дневниководы');
define('_QMENU_MANAGE_NEWBLOG',		'Новый дневник');
define('_QMENU_MANAGE_BACKUPS',		'Бэкап');
define('_QMENU_MANAGE_PLUGINS',		'Плагины');
define('_QMENU_LAYOUT',				'Макет');
define('_QMENU_LAYOUT_SKINS',		'Скины');
define('_QMENU_LAYOUT_TEMPL',		'Шаблоны');
define('_QMENU_LAYOUT_IEXPORT',		'Импорт/Экспорт');
define('_QMENU_PLUGINS',			'Плагины');

// quickmenu on logon screen
define('_QMENU_INTRO',				'Введение');
define('_QMENU_INTRO_TEXT',			'<p>Это экран входа для нашего движка, который помогает настроить сайт.</p><p>Если у вас есть аккаунт, вы можете войти и начать писать заметки.</p>');

// helppages for plugins
define('_ERROR_PLUGNOHELPFILE',		'Для этого плагина не найден файл помощи');
define('_PLUGS_HELP_TITLE',			'Помощь к плагину');
define('_LIST_PLUGS_HELP', 			'помощь');


// END changed/started after 3.1

// START changed/added after v2.5beta START

// general settings (security)
define('_SETTINGS_EXTAUTH',			'Включить внешний доступ');
define('_WARNING_EXTAUTH',			'Предупреждение: просто так не включайте.');

// member profile
define('_MEMBERS_BYPASS',			'Использовать внешний доступ');

// 'always include in search' blog setting (yes/no) [in v2.5beta, the 'always' part wasn't clear]
define('_EBLOG_SEARCH',				'<em>Всегда</em> включать в поиск');

// END changed/added after v2.5beta

// START introduced after v2.0 START

// media library
define('_MEDIA_VIEW',				'просмотр');
define('_MEDIA_VIEW_TT',			'Просмотр файла (в новом окне)');
define('_MEDIA_FILTER_APPLY',		'Применить фильтр');
define('_MEDIA_FILTER_LABEL',		'Фильтр: ');
define('_MEDIA_UPLOAD_TO',			'Загрузить в...');
define('_MEDIA_UPLOAD_NEW',			'Загрузить новый файл...');
define('_MEDIA_COLLECTION_SELECT',	'Выбрать');
define('_MEDIA_COLLECTION_TT',		'Выбор категории');
define('_MEDIA_COLLECTION_LABEL',	'Текущая коллекция: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'Слева');
define('_ADD_ALIGNRIGHT_TT',		'Справа');
define('_ADD_ALIGNCENTER_TT',		'По центру');


// generic upload failure
define('_ERROR_UPLOADFAILED',		'Загрузка не прошла');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'Разрешить записи в прошлое (включить машину времени)');
define('_ADD_CHANGEDATE',			'Обновить время создания');
define('_BMLET_CHANGEDATE',			'Обновить время создания');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'Импорт/эспорт скинов...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Нормальный');
define('_PARSER_INCMODE_SKINDIR',	'Использовать каталог скинов');
define('_SKIN_INCLUDE_MODE',		'Включить режим');
define('_SKIN_INCLUDE_PREFIX',		'Включить префикс');

// global settings
define('_SETTINGS_BASESKIN',		'Основной скин');
define('_SETTINGS_SKINSURL',		'Адрес скина');
define('_SETTINGS_ACTIONSURL',		'Полный адрес к action.php');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'Не получается переместить категорию по умолчанию.');
define('_ERROR_MOVETOSELF',			'Не получается переместить категорию (дневник назначения совпадает с исходным)');
define('_MOVECAT_TITLE',			'Выберите журнал для перемещения в категорию');
define('_MOVECAT_BTN',				'Переместить категорию');

// URLMode setting
define('_SETTINGS_URLMODE',			'Вид URL');
define('_SETTINGS_URLMODE_NORMAL',	'Обычный');
define('_SETTINGS_URLMODE_PATHINFO','ЧПУ');

// Batch operations
define('_BATCH_NOSELECTION',		'Уже выделите что-нибудь');
define('_BATCH_ITEMS',				'Групповая операция над записями');
define('_BATCH_CATEGORIES',			'Групповая операция над категориями');
define('_BATCH_MEMBERS',			'Групповая операция над дневниководами');
define('_BATCH_TEAM',				'Групповая операция над группами дневниководов');
define('_BATCH_COMMENTS',			'Групповая операция над комментариями');
define('_BATCH_UNKNOWN',			'Неизвестная групповая операция: ');
define('_BATCH_EXECUTING',			'Выполняется');
define('_BATCH_ONCATEGORY',			'над категорией');
define('_BATCH_ONITEM',				'над записью');
define('_BATCH_ONCOMMENT',			'над комментарием');
define('_BATCH_ONMEMBER',			'над дневниководом');
define('_BATCH_ONTEAM',				'над групповым дневниководом');
define('_BATCH_SUCCESS',			'Ура!');
define('_BATCH_DONE',				'Готово!');
define('_BATCH_DELETE_CONFIRM',		'Подтвердите групповое удаление');
define('_BATCH_DELETE_CONFIRM_BTN',	'Подтвердите групповое удаление');
define('_BATCH_SELECTALL',			'выбрать все');
define('_BATCH_DESELECTALL',		'выбрать ничто');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'Удалить');
define('_BATCH_ITEM_MOVE',			'Переместить');
define('_BATCH_MEMBER_DELETE',		'Удалить');
define('_BATCH_MEMBER_SET_ADM',		'Сделать крутым (админом)');
define('_BATCH_MEMBER_UNSET_ADM',	'Сделать лохом (неадмином)');
define('_BATCH_TEAM_DELETE',		'Удалить из группы');
define('_BATCH_TEAM_SET_ADM',		'Сделать крутым (админом)');
define('_BATCH_TEAM_UNSET_ADM',		'Сделать лохом (неадмином)');
define('_BATCH_CAT_DELETE',			'Удалить');
define('_BATCH_CAT_MOVE',			'Переместить в другой дневник');
define('_BATCH_COMMENT_DELETE',		'Удалить');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'Добавить запись...');
define('_ADD_PLUGIN_EXTRAS',		'Опции экстра-плагина');

// errors
define('_ERROR_CATCREATEFAIL',		'Новая категория не создаётся');
define('_ERROR_NUCLEUSVERSIONREQ',	'Этому плагину нужен движок поновее: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Назад к настройкам дневника');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Импорт');
define('_SKINIE_TITLE_EXPORT',		'Экспорт');
define('_SKINIE_BTN_IMPORT',		'Импорт');
define('_SKINIE_BTN_EXPORT',		'Экспорт выбранных скинов/шаблонов');
define('_SKINIE_LOCAL',				'Импорт из файла:');
define('_SKINIE_NOCANDIDATES',		'В каталоге скинов ничего подходящего нет');
define('_SKINIE_FROMURL',			'Импорт с URL:');
define('_SKINIE_EXPORT_INTRO',		'Выберите скины и шаблоны для экспорта ниже');
define('_SKINIE_EXPORT_SKINS',		'Скины');
define('_SKINIE_EXPORT_TEMPLATES',	'Шаблоны');
define('_SKINIE_EXPORT_EXTRA',		'Дополнительная информация');
define('_SKINIE_CONFIRM_OVERWRITE',	'Заменять существующие скины (см. nameclashes)');
define('_SKINIE_CONFIRM_IMPORT',	'Да-да, я хочу это импортировать');
define('_SKINIE_CONFIRM_TITLE',		'About to import skins and templates');
define('_SKINIE_INFO_SKINS',		'Скин в файле:');
define('_SKINIE_INFO_TEMPLATES',	'Шаблон в файле:');
define('_SKINIE_INFO_GENERAL',		'Информация:');
define('_SKINIE_INFO_SKINCLASH',	'Конфликт имён скина:');
define('_SKINIE_INFO_TEMPLCLASH',	'Конфликт имён шаблона:');
define('_SKINIE_INFO_IMPORTEDSKINS','Импортированные скины:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Импортированные шаблоны:');
define('_SKINIE_DONE',				'Импорт завершён');

define('_AND',						'и');
define('_OR',						'или');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'пустое поле (нажмите, чтобы редактировать)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'IncludeMode:');
define('_LIST_SKINS_INCPREFIX',		'IncludePrefix:');
define('_LIST_SKINS_DEFINED',		'Defined parts:');

// backup
define('_BACKUPS_TITLE',			'Забэкапить / восстановить');
define('_BACKUP_TITLE',				'Бэкап');
define('_BACKUP_INTRO',				'Нажмите кнопочку, чтобы забэкапить вашу БД. Храните под замком в чулане.');
define('_BACKUP_ZIP_YES',			'Попробовать сжать');
define('_BACKUP_ZIP_NO',			'Не сжимать');
define('_BACKUP_BTN',				'Создать бэкап');
define('_BACKUP_NOTE',				'<b>Примечание:</b> сохраняется только БД, вся ерунда из папки media и файл config.php сохраняйте ручками.');
define('_RESTORE_TITLE',			'Восстановить');
define('_RESTORE_NOTE',				'<b>Предупреждение:</b> Когда восстанавливаете, всё старое стирается! Не наломайте дров.	<br />	<b>Примечание:</b> версия движка должна совпадать с той, в котоой вы делали бэкап.');
define('_RESTORE_INTRO',			'Выберите файл, нажмите "Восстановить".');
define('_RESTORE_IMSURE',			'Да-да, я уверен!');
define('_RESTORE_BTN',				'Восстановить из файла');
define('_RESTORE_WARNING',			'(убедитесь, что вы восстанавливаете хороший бэкап, а то всё закосячите нафиг)');
define('_ERROR_BACKUP_NOTSURE',		'Скажите, что уверены (а то мало ли)');
define('_RESTORE_COMPLETE',			'Восстановление завершено');

// new item notification
define('_NOTIFY_NI_MSG',			'Новая запись размещена:');
define('_NOTIFY_NI_TITLE',			'Новая запись!');
define('_NOTIFY_KV_MSG',			'Карма записи:');
define('_NOTIFY_KV_TITLE',			'Nucleus карма:');
define('_NOTIFY_NC_MSG',			'Комментировать:');
define('_NOTIFY_NC_TITLE',			'Nucleus комментировать:');
define('_NOTIFY_USERID',			'ID дневниковода:');
define('_NOTIFY_USER',				'Дневниковод:');
define('_NOTIFY_COMMENT',			'Комментарий:');
define('_NOTIFY_VOTE',				'Голос:');
define('_NOTIFY_HOST',				'Хост:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'Дневниковод:');
define('_NOTIFY_TITLE',				'Заголовок:');
define('_NOTIFY_CONTENTS',			'Содержание:');

// member mail message
define('_MMAIL_MSG',				'Сообщение послал вам');
define('_MMAIL_FROMANON',			'некто, пожелавший остаться неизвестным.');
define('_MMAIL_FROMNUC',			'Сообщение послано с хрясь-дневников ');
define('_MMAIL_TITLE',				'Сообщение от');
define('_MMAIL_MAIL',				'Сообщение:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'Добавить запись');
define('_BMLET_EDIT',				'Редактировать запись');
define('_BMLET_DELETE',				'Удалить запись');
define('_BMLET_BODY',				'Тело');
define('_BMLET_MORE',				'Расширенный');
define('_BMLET_OPTIONS',			'Опции');
define('_BMLET_PREVIEW',			'Предварительный просмотр');

// used in bookmarklet
define('_ITEM_UPDATED',				'Запись обновлена');
define('_ITEM_DELETED',				'Запись удалена');

// plugins
define('_CONFIRMTXT_PLUGIN',		'Вы уверены, что хотите удалить плагин');
define('_ERROR_NOSUCHPLUGIN',		'Нет такого плагина');
define('_ERROR_DUPPLUGIN',			'Ничем помочь не можем, но такой плагин уже установлен');
define('_ERROR_PLUGFILEERROR',		'Или прав у вас мало или такого плагина нет');
define('_PLUGS_NOCANDIDATES',		'Не нашлось плагинов');

define('_PLUGS_TITLE_MANAGE',		'Управление плагинами');
define('_PLUGS_TITLE_INSTALLED',	'Уже установлены');
define('_PLUGS_TITLE_UPDATE',		'Обновить лист подписки');
define('_PLUGS_TEXT_UPDATE',		'Nucleus keeps a cache of the event subscriptions of the plugins. When you upgrade a plugin by replacing it\'s file, you should run this update to make sure that the correct subscriptions are cached (делать нехуй столько переводить)');
define('_PLUGS_TITLE_NEW',			'Установить новый плагин');
define('_PLUGS_ADD_TEXT',			'Ниже список файлов каталоге плагинов, которые по идее можно установить. Только <strong>будьте уверены</strong>, что это плагин, а не левый файл перед установкой.');
define('_PLUGS_BTN_INSTALL',		'Установить плагин');
define('_BACKTOOVERVIEW',			'Назад к обзору');

// editlink
define('_TEMPLATE_EDITLINK',		'Редактировать ссылку записи');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'Добавить колонку слева');
define('_ADD_RIGHT_TT',				'Добавить колонку справа');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'Новая категория...');

// new settings
define('_SETTINGS_PLUGINURL',		'Адрес плагина');
define('_SETTINGS_MAXUPLOADSIZE',	'Максимальный размер файла (байт)');
define('_SETTINGS_NONMEMBERMSGS',	'Разрешить недневниководам посылать сообщения.');
define('_SETTINGS_PROTECTMEMNAMES',	'Защитить имена (и честь) дневниководов');

// overview screen
define('_OVERVIEW_PLUGINS',			'Управление плагинами...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'Регистрация нового дневниковода:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'Адрес вашей почты (e-mail в народе):');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'У вас нет прав загружать файлы в каталоги групп дневниководов. Даже не пытайтесь.');

// plugin list
define('_LISTS_INFO',				'Информация');
define('_LIST_PLUGS_AUTHOR',		'Автор:');
define('_LIST_PLUGS_VER',			'Версия:');
define('_LIST_PLUGS_SITE',			'Сайт');
define('_LIST_PLUGS_DESC',			'Описание:');
define('_LIST_PLUGS_SUBS',			'Подписывает на события:');
define('_LIST_PLUGS_UP',			'вверх');
define('_LIST_PLUGS_DOWN',			'вниз');
define('_LIST_PLUGS_UNINSTALL',		'деинсталлировать');
define('_LIST_PLUGS_ADMIN',			'админ');
define('_LIST_PLUGS_OPTIONS',		'редактировать настройки');

// plugin option list
define('_LISTS_VALUE',				'Оценка');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'у этого плагина нет опций');
define('_PLUGS_BACK',				'Назад к обзору плагинов');
define('_PLUGS_SAVE',				'Сохранить опции');
define('_PLUGS_OPTIONS_UPDATED',	'Опции плагина обновлены');

define('_OVERVIEW_MANAGEMENT',		'Управление');
define('_OVERVIEW_MANAGE',			'Управление ядром...');
define('_MANAGE_GENERAL',			'Общее управление');
define('_MANAGE_SKINS',				'Скин и шаблоны');
define('_MANAGE_EXTRA',				'Дополнительные возможности');

define('_BACKTOMANAGE',				'Назад к управление ядром');


// END introduced after v1.1 END




// charset to use
define('_CHARSET',					'windows-1251');

// global stuff
define('_LOGOUT',					'Выход');
define('_LOGIN',					'Вход');
define('_YES',						'Да');
define('_NO',						'Нет');
define('_SUBMIT',					'Подтвердить');
define('_ERROR',					'Ошибка');
define('_ERRORMSG',					'Ужас! Произошла ошибка!');
define('_BACK',						'Назад');
define('_NOTLOGGEDIN',				'Вы не вошли');
define('_LOGGEDINAS',				'Ваш логин');
define('_ADMINHOME',				'Админка');
define('_NAME',						'Имя');
define('_BACKHOME',					'Назад к началу админки');
define('_BADACTION',				'Существующих действий не запрошено');
define('_MESSAGE',					'Сообщение');
define('_HELP_TT',					'Помогите мне!');
define('_YOURSITE',					'Ваш сайт');


define('_POPUP_CLOSE',				'Закрыть окно');

define('_LOGIN_PLEASE',				'Сначала войдите');

// commentform
define('_COMMENTFORM_YOUARE',		'Вы');
define('_COMMENTFORM_SUBMIT',		'Добавить комментарий');
define('_COMMENTFORM_COMMENT',		'Ваш комментарий');
define('_COMMENTFORM_NAME',			'Имя');
define('_COMMENTFORM_MAIL',			'E-mail/сайт');
define('_COMMENTFORM_REMEMBER',		'Запомнить');

// loginform
define('_LOGINFORM_NAME',			'Логин');
define('_LOGINFORM_PWD',			'Пароль');
define('_LOGINFORM_YOUARE',			'Ваш логин');
define('_LOGINFORM_SHARED',			'Чужой компьютер');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'Отправить сообщение');

// search form
define('_SEARCHFORM_SUBMIT',		'Поиск');

// add item form
define('_ADD_ADDTO',				'Добавить новую запись в');
define('_ADD_CREATENEW',			'Создать новую запись');
define('_ADD_BODY',					'Тело');
define('_ADD_TITLE',				'Заголовок');
define('_ADD_MORE',					'Расширенный режим (опционально)');
define('_ADD_CATEGORY',				'Категория');
define('_ADD_PREVIEW',				'Предварительный просмотр');
define('_ADD_DISABLE_COMMENTS',		'Запретить комментарии?');
define('_ADD_DRAFTNFUTURE',			'Черновик на будущее');
define('_ADD_ADDITEM',				'Добавить запись');
define('_ADD_ADDNOW',				'Добавить сейчас');
define('_ADD_ADDLATER',				'Добавить позже');
define('_ADD_PLACE_ON',				'Поместить в');
define('_ADD_ADDDRAFT',				'Добавить в черновики');
define('_ADD_NOPASTDATES',			'(дата и время прошлого кривые, придётся заменить текущими)');
define('_ADD_BOLD_TT',				'Жирный');
define('_ADD_ITALIC_TT',			'Курсив');
define('_ADD_HREF_TT',				'Ссылка');
define('_ADD_MEDIA_TT',				'Добавить картинку');
define('_ADD_PREVIEW_TT',			'Скрыть/показать превью');
define('_ADD_CUT_TT',				'Вырезать');
define('_ADD_COPY_TT',				'Копировать');
define('_ADD_PASTE_TT',				'Вставить');


// edit item form
define('_EDIT_ITEM',				'Редактировать запись');
define('_EDIT_SUBMIT',				'Редактировать запись');
define('_EDIT_ORIG_AUTHOR',			'Автор');
define('_EDIT_BACKTODRAFTS',		'Добавить в черновики');
define('_EDIT_COMMENTSNOTE',		'(примечание: запрещение комментариев не спрячет уже написанные)');

// used on delete screens
define('_DELETE_CONFIRM',			'Будьте добры, подтвердите удаление');
define('_DELETE_CONFIRM_BTN',		'Подтвердите удаление');
define('_CONFIRMTXT_ITEM',			'Вы сейчас удалите эту запись:');
define('_CONFIRMTXT_COMMENT',		'Вы сейчас удалите этот комментарий:');
define('_CONFIRMTXT_TEAM1',			'Вы сейчас удалите ');
define('_CONFIRMTXT_TEAM2',			' из группы журнала ');
define('_CONFIRMTXT_BLOG',			'Вы сейчас удалите журнал: ');
define('_WARNINGTXT_BLOGDEL',		'Что творишь?! Удаляя блог, ты удаляешь все записи, комментарии и часы работы человека!<br />Ну раз такой смелый, не тревожь движок, пока трёт.');
define('_CONFIRMTXT_MEMBER',		'Вы сейчас удалите профиль этого дневниковода: ');
define('_CONFIRMTXT_TEMPLATE',		'Вы сейчас удалите шаблон ');
define('_CONFIRMTXT_SKIN',			'Вы сейчас удалите скин ');
define('_CONFIRMTXT_BAN',			'Вы сейчас удалите ранг банов');
define('_CONFIRMTXT_CATEGORY',		'Вы сейчас удалите категорию ');

// some status messages
define('_DELETED_ITEM',				'Запись удалена');
define('_DELETED_MEMBER',			'Дневниковод удалён');
define('_DELETED_COMMENT',			'Комментарий удалён');
define('_DELETED_BLOG',				'Блог удалён');
define('_DELETED_CATEGORY',			'Категория удалена');
define('_ITEM_MOVED',				'Запись перемещена');
define('_ITEM_ADDED',				'Запись добавлена');
define('_COMMENT_UPDATED',			'Комментарий обновлён');
define('_SKIN_UPDATED',				'Информация скина сохранена');
define('_TEMPLATE_UPDATED',			'Информация шаблона сохранена');

// errors
define('_ERROR_COMMENT_LONGWORD',	'Не используйте слова длиннее 90 символов. В русском языке таких слов нет!');
define('_ERROR_COMMENT_NOCOMMENT',	'Введите комментарий');
define('_ERROR_COMMENT_NOUSERNAME',	'Неверный логин');
define('_ERROR_COMMENT_TOOLONG',	'Куда расписались? Слишком длинный комментарий (max. 5000 символов)');
define('_ERROR_COMMENTS_DISABLED',	'А в этом дневнике комментарии отключены. Облом-с.');
define('_ERROR_COMMENTS_NONPUBLIC',	'Вы должны иметь статус дневниковода, чтобы добавить комментарий.');
define('_ERROR_COMMENTS_MEMBERNICK','Имя, которое вы ввели, занято нашим дневниководом. Выберите другое.');
define('_ERROR_SKIN',				'Ошибка скина');
define('_ERROR_ITEMCLOSED',			'Запись закрыта. К ней нельзя добавлять комментарии. И вообще ничего с ней делать нельзя.');
define('_ERROR_NOSUCHITEM',			'Такой записи не существует');
define('_ERROR_NOSUCHBLOG',			'Такого дневника не существует');
define('_ERROR_NOSUCHSKIN',			'Такого скина не существует');
define('_ERROR_NOSUCHMEMBER',		'Такого дневниковода не существует');
define('_ERROR_NOTONTEAM',			'Вы не входите в группу этого дневника.');
define('_ERROR_BADDESTBLOG',		'Дневник назначения не существует');
define('_ERROR_NOTONDESTTEAM',		'Запись нельзя переместить, т.к. вы не входите в группу дневника назначения');
define('_ERROR_NOEMPTYITEMS',		'Нельзя добавлять пустые записи!');
define('_ERROR_BADMAILADDRESS',		'Кривой e-mail');
define('_ERROR_BADNOTIFY',			'Один или несколько из данных e-mail адресов кривой');
define('_ERROR_BADNAME',			'Логин неверен (используйте буквы a-z и цифры 0-9 без пробелов)');
define('_ERROR_NICKNAMEINUSE',		'Этот логин уже занят другим дневниководом');
define('_ERROR_PASSWORDMISMATCH',	'Пароли должны совпадать');
define('_ERROR_PASSWORDTOOSHORT',	'Длина пароля должны быть не меньше 6 символов (для вас же лучше!)');
define('_ERROR_PASSWORDMISSING',	'Пароль ну никак не может быть пустым');
define('_ERROR_REALNAMEMISSING',	'Вы должны ввести реальное имя');
define('_ERROR_ATLEASTONEADMIN',	'Должен быть хотя бы один модный админ, чтобы он мог заходить в админку.');
define('_ERROR_ATLEASTONEBLOGADMIN','Это действие сделает ваш блог неуправляемым (как в Терминаторе). Убедитесь, чтобы был хотя бы один админ.');
define('_ERROR_ALREADYONTEAM',		'Вы не можете добавить дневниковода в группу, в которой он уже состоит');
define('_ERROR_BADSHORTBLOGNAME',	'Короткое имя дневника может содержать только буквы a-z и цифры 0-9 без пробелов');
define('_ERROR_DUPSHORTBLOGNAME',	'Какой-то пронырливый дневниковод уже занял это имя, придумывайте другое.');
define('_ERROR_UPDATEFILE',			'Cannot get write access to the update-file. Make sure the file permissions are set ok (try chmodding it to 666). Also note that the location is relative to the admin-area directory, so you might want to use an absolute path (something like /your/path/to/nucleus/) (ебануться, сколько переводить)');
define('_ERROR_DELDEFBLOG',			'Нельзя удалить дневник по умолчанию');
define('_ERROR_DELETEMEMBER',		'Это автор не может быть удалён, возможно, помому что является автором записей или комментариев.');
define('_ERROR_BADTEMPLATENAME',	'Имя шаблона может содержать только буквы a-z и цифры 0-9 без пробелов');
define('_ERROR_DUPTEMPLATENAME',	'Уже есть шаблон с таким именем');
define('_ERROR_BADSKINNAME',		'Имя скина может содержать только буквы a-z и цифры 0-9 без пробелов');
define('_ERROR_DUPSKINNAME',		'Уже есть скин с таким именем');
define('_ERROR_DEFAULTSKIN',		'Скин с именем "default" должен быть по-любому, не удаляйте его');
define('_ERROR_SKINDEFDELETE',		'Нельзя удалить скин, потому это скин по умолчанию для дневника: ');
define('_ERROR_DISALLOWED',			'У вас нет прав для этого действия. Или карма плохая');
define('_ERROR_DELETEBAN',			'Ошибка снятия бана (бан не существует)');
define('_ERROR_ADDBAN',				'Ошибка установки бана. Он мог установиться не во все дневники.');
define('_ERROR_BADACTION',			'Запрошенное действие не существует');
define('_ERROR_MEMBERMAILDISABLED',	'Послания дневниководов друг другу запрещены');
define('_ERROR_MEMBERCREATEDISABLED','Создание аккаунтов дневниководов запрещено');
define('_ERROR_INCORRECTEMAIL',		'Неверный адрес e-mail');
define('_ERROR_VOTEDBEFORE',		'Вы уже голосовали за эту запись');
define('_ERROR_BANNED1',			'Ничего не получится (ваш ip ');
define('_ERROR_BANNED2',			'), вы забанены. Сообщение было: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'Вы должны войти, чтобы выполнить это действие');
define('_ERROR_CONNECT',			'Ошибка соединения');
define('_ERROR_FILE_TOO_BIG',		'Сильно большой файл! Знай меру!');
define('_ERROR_BADFILETYPE',		'Уж простите, но этот тип файлов запрещен');
define('_ERROR_BADREQUEST',			'Кривой запрос загрузки');
define('_ERROR_DISALLOWEDUPLOAD',	'Вы не состоите ни в одной группе дневниководов. А поэтому и файлы загружать не можете');
define('_ERROR_BADPERMISSIONS',		'Права на закачку проставлены криво');
define('_ERROR_UPLOADMOVEP',		'Ошибка при перемещении загруженных файлов');
define('_ERROR_UPLOADCOPY',			'Ошибка при копировании файлов');
define('_ERROR_UPLOADDUPLICATE',	'Уже есть файл с таким именем. Придумывайте другое.');
define('_ERROR_LOGINDISALLOWED',	'Куда нос суешь? Нет у тебя прав, нет.');
define('_ERROR_DBCONNECT',			'Ошибка соединения с сервером mySQL');
define('_ERROR_DBSELECT',			'Не могу найти БД движка.');
define('_ERROR_NOSUCHLANGUAGE',		'Такого языкового файла не существует');
define('_ERROR_NOSUCHCATEGORY',		'Такой категории не существует');
define('_ERROR_DELETELASTCATEGORY',	'Должна быть хотя бы одна категория');
define('_ERROR_DELETEDEFCATEGORY',	'Нельзя удалить категорию по умолчанию');
define('_ERROR_BADCATEGORYNAME',	'Неправильное имя для категории');
define('_ERROR_DUPCATEGORYNAME',	'Уже есть категория с таким именем');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'Предупреждение: текущее место не является каталогом!');
define('_WARNING_NOTREADABLE',		'Предупреждение: текущее место не читается!');
define('_WARNING_NOTWRITABLE',		'Предупреждение: в текущее место не записывается!');

// media and upload
define('_MEDIA_UPLOADLINK',			'Загрузить новый файл');
define('_MEDIA_MODIFIED',			'изменено');
define('_MEDIA_FILENAME',			'имя файла');
define('_MEDIA_DIMENSIONS',			'расширения');
define('_MEDIA_INLINE',				'В строку');
define('_MEDIA_POPUP',				'Всплывающее окно');
define('_UPLOAD_TITLE',				'Выбрать файл');
define('_UPLOAD_MSG',				'Выберите файл для загрузки ниже и нажмите кнопочку \'Загрузить\'.');
define('_UPLOAD_BUTTON',			'Загрузить');

// some status messages
//define('_MSG_ACCOUNTCREATED',		'Аккаун создан, пароль будет отправлен на почту');
//define('_MSG_PASSWORDSENT',			'Пароль отправлен на почту');
define('_MSG_LOGINAGAIN',			'Вам необходимо войти снова, потому что ваша информация изменилась');
define('_MSG_SETTINGSCHANGED',		'Настройки изменены');
define('_MSG_ADMINCHANGED',			'Админ изменён');
define('_MSG_NEWBLOG',				'Новый журнал создан');
define('_MSG_ACTIONLOGCLEARED',		'Лог действий очищен');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'Запрещенное действие: ');
define('_ACTIONLOG_PWDREMINDERSENT','Новый пароль послан ');
define('_ACTIONLOG_TITLE',			'Лог действий');
define('_ACTIONLOG_CLEAR_TITLE',	'Очистить лог действий');
define('_ACTIONLOG_CLEAR_TEXT',		'Очистить лог действий сейчас');

// team management
define('_TEAM_TITLE',				'Управление групповым журналом ');
define('_TEAM_CURRENT',				'Текущая группа');
define('_TEAM_ADDNEW',				'Добавить нового дневниковода в группу');
define('_TEAM_CHOOSEMEMBER',		'Выбрать дневниковода');
define('_TEAM_ADMIN',				'Права админа? ');
define('_TEAM_ADD',					'Добавить в группу');
define('_TEAM_ADD_BTN',				'Добавить в группу');

// blogsettings
define('_EBLOG_TITLE',				'Редактирование настроек журнала');
define('_EBLOG_TEAM_TITLE',			'Редактирование группы');
define('_EBLOG_TEAM_TEXT',			'Нажмите здесь для редактирования группы...');
define('_EBLOG_SETTINGS_TITLE',		'Настройки журнала');
define('_EBLOG_NAME',				'Имя журнала');
define('_EBLOG_SHORTNAME',			'Короткое имя журнала');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(допустимы буквы a-z без пробелов)');
define('_EBLOG_DESC',				'Описание журнала');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'Скин по умолчанию');
define('_EBLOG_DEFCAT',				'Категория по умолчанию');
define('_EBLOG_LINEBREAKS',			'Преобразовать переносы строки');
define('_EBLOG_DISABLECOMMENTS',	'Запретить комментарии?<br /><small>(Вам никто не сможет написать ни одного комментария. Лучше разрешите.)</small>');
define('_EBLOG_ANONYMOUS',			'Разрешить комментарии недневниководам?');
define('_EBLOG_NOTIFY',				'Адрес(а) уведомоления (используйте ; как разграничитель)');
define('_EBLOG_NOTIFY_ON',			'Уведомлять при');
define('_EBLOG_NOTIFY_COMMENT',		'Новых комментариях');
define('_EBLOG_NOTIFY_KARMA',		'Голосах к карме');
define('_EBLOG_NOTIFY_ITEM',		'Новых записях в журнале');
define('_EBLOG_PING',				'Ping Weblogs.com при обновлениях?');
define('_EBLOG_MAXCOMMENTS',		'Максимальное число комментариев');
define('_EBLOG_UPDATE',				'Обновить файлы');
define('_EBLOG_OFFSET',				'Временная разница с сервером');
define('_EBLOG_STIME',				'Сейчас на сервере');
define('_EBLOG_BTIME',				'Сейчас в журнале');
define('_EBLOG_CHANGE',				'Изменить настройки');
define('_EBLOG_CHANGE_BTN',			'Изменить настройки');
define('_EBLOG_ADMIN',				'Админ журнала');
define('_EBLOG_ADMIN_MSG',			'Вам будут даны права админа журнала');
define('_EBLOG_CREATE_TITLE',		'Создать новый журнал');
define('_EBLOG_CREATE_TEXT',		'Заполните поля ниже, чтобы создать свой журнал.<br /><br /> <b>Примечание:</b> Все поля обязательны. После создания журнала, вы сможете заполнить дополнительные поля.');
define('_EBLOG_CREATE',				'Создать!');
define('_EBLOG_CREATE_BTN',			'Создать журнал!');
define('_EBLOG_CAT_TITLE',			'Категории');
define('_EBLOG_CAT_NAME',			'Имя категории');
define('_EBLOG_CAT_DESC',			'Описание категории');
define('_EBLOG_CAT_CREATE',			'Создать новую категорию');
define('_EBLOG_CAT_UPDATE',			'Обновить категорию');
define('_EBLOG_CAT_UPDATE_BTN',		'Обновить категорию');

// templates
define('_TEMPLATE_TITLE',			'Редактировать шаблоны');
define('_TEMPLATE_AVAILABLE_TITLE',	'Доступные шаблоны');
define('_TEMPLATE_NEW_TITLE',		'Новый шаблон');
define('_TEMPLATE_NAME',			'Имя шаблона');
define('_TEMPLATE_DESC',			'Описание шаблона');
define('_TEMPLATE_CREATE',			'Создать шаблон');
define('_TEMPLATE_CREATE_BTN',		'Создать шаблон');
define('_TEMPLATE_EDIT_TITLE',		'Редактировать шаблон');
define('_TEMPLATE_BACK',			'Назад к обзору шаблонов');
define('_TEMPLATE_EDIT_MSG',		'Не все части шаблона необходимы. Оставьте пустыми те, которые не необходимы.');
define('_TEMPLATE_SETTINGS',		'Настройки шаблона');
define('_TEMPLATE_ITEMS',			'Записи');
define('_TEMPLATE_ITEMHEADER',		'Заголовок записи');
define('_TEMPLATE_ITEMBODY',		'Тело записи');
define('_TEMPLATE_ITEMFOOTER',		'Конец записи');
define('_TEMPLATE_MORELINK',		'Ссылка на полный вариант записи');
define('_TEMPLATE_NEW',				'Обозначение новой записи');
define('_TEMPLATE_COMMENTS_ANY',	'Комментарии (если они есть)');
define('_TEMPLATE_CHEADER',			'Заголовок комментария');
define('_TEMPLATE_CBODY',			'Тело комментария');
define('_TEMPLATE_CFOOTER',			'Конец комментария');
define('_TEMPLATE_CONE',			'Один комментарий');
define('_TEMPLATE_CMANY',			'Два или больше комментариев');
define('_TEMPLATE_CMORE',			'Читать дальше для комментариев');
define('_TEMPLATE_CMEXTRA',			'Member Extra');
define('_TEMPLATE_COMMENTS_NONE',	'Комментарии (если их нет)');
define('_TEMPLATE_CNONE',			'Нет комментариев');
define('_TEMPLATE_COMMENTS_TOOMUCH','Комментарии (если их слишком много, чтобы показать все)');
define('_TEMPLATE_CTOOMUCH',		'Слишком много комментариев');
define('_TEMPLATE_ARCHIVELIST',		'Списки архива');
define('_TEMPLATE_AHEADER',			'Заголовок листов архива');
define('_TEMPLATE_AITEM',			'Запись листов архива');
define('_TEMPLATE_AFOOTER',			'Конец листов архива');
define('_TEMPLATE_DATETIME',		'Дата и время');
define('_TEMPLATE_DHEADER',			'Заголовок даты');
define('_TEMPLATE_DFOOTER',			'Конец даты');
define('_TEMPLATE_DFORMAT',			'Формат даты');
define('_TEMPLATE_TFORMAT',			'Формат времени');
define('_TEMPLATE_LOCALE',			'Место');
define('_TEMPLATE_IMAGE',			'Всплывающие окна с изображениями');
define('_TEMPLATE_PCODE',			'Всплывающее окно со ссылкой');
define('_TEMPLATE_ICODE',			'Код изображения');
define('_TEMPLATE_MCODE',			'Код ссылки изображения');
define('_TEMPLATE_SEARCH',			'Поиск');
define('_TEMPLATE_SHIGHLIGHT',		'Заголовок');
define('_TEMPLATE_SNOTFOUND',		'Ничего не найдено');
define('_TEMPLATE_UPDATE',			'Обновить');
define('_TEMPLATE_UPDATE_BTN',		'Обновить шаблон');
define('_TEMPLATE_RESET_BTN',		'Сбросить');
define('_TEMPLATE_CATEGORYLIST',	'Списки категорий');
define('_TEMPLATE_CATHEADER',		'Заголовок списка категорий');
define('_TEMPLATE_CATITEM',			'Запись списка категорий');
define('_TEMPLATE_CATFOOTER',		'Конец списка категорий');

// skins
define('_SKIN_EDIT_TITLE',			'Редактировать скины');
define('_SKIN_AVAILABLE_TITLE',		'Доступные скины');
define('_SKIN_NEW_TITLE',			'Новые скины');
define('_SKIN_NAME',				'Имя');
define('_SKIN_DESC',				'Описание');
define('_SKIN_TYPE',				'Тип содержания');
define('_SKIN_CREATE',				'Создать');
define('_SKIN_CREATE_BTN',			'Создать скин');
define('_SKIN_EDITONE_TITLE',		'Редактировать скин');
define('_SKIN_BACK',				'Назад к обзору скинов');
define('_SKIN_PARTS_TITLE',			'Блоки скина');
define('_SKIN_PARTS_MSG',			'Не все части нужны для скинов, некоторые вы можете оставить пустыми. Выберите тип скина для редактирования:');
define('_SKIN_PART_MAIN',			'Главная страница');
define('_SKIN_PART_ITEM',			'Страницы записей');
define('_SKIN_PART_ALIST',			'Список архива');
define('_SKIN_PART_ARCHIVE',		'Архив');
define('_SKIN_PART_SEARCH',			'Поиск');
define('_SKIN_PART_ERROR',			'Ошибка');
define('_SKIN_PART_MEMBER',			'Данные дневниковода');
define('_SKIN_PART_POPUP',			'Всплывающее окно изображения');
define('_SKIN_GENSETTINGS_TITLE',	'Общие настройки');
define('_SKIN_CHANGE',				'Изменить');
define('_SKIN_CHANGE_BTN',			'Изменить эти настройки');
define('_SKIN_UPDATE_BTN',			'Обновить скин');
define('_SKIN_RESET_BTN',			'Сбросить');
define('_SKIN_EDITPART_TITLE',		'Редактировать скин');
define('_SKIN_GOBACK',				'Назад');
define('_SKIN_ALLOWEDVARS',			'Доступные переменные (нажмите для информации):');

// global settings
define('_SETTINGS_TITLE',			'Общие настройки');
define('_SETTINGS_SUB_GENERAL',		'Общие настройки');
define('_SETTINGS_DEFBLOG',			'Журнал по умолчанию');
define('_SETTINGS_ADMINMAIL',		'E-mail админа');
define('_SETTINGS_SITENAME',		'Имя сайта');
define('_SETTINGS_SITEURL',			'Адрес сайта (должен кончаться на слеш)');
define('_SETTINGS_ADMINURL',		'Адрес админки (должен кончаться на слеш)');
define('_SETTINGS_DIRS',			'Каталоги движка');
define('_SETTINGS_MEDIADIR',		'Каталог изображение');
define('_SETTINGS_SEECONFIGPHP',	'(см. config.php)');
define('_SETTINGS_MEDIAURL',		'Адрес картинок (должен кончаться на слеш)');
define('_SETTINGS_ALLOWUPLOAD',		'Разрешить загрузку файлов?');
define('_SETTINGS_ALLOWUPLOADTYPES','Допустимые форматы файлов для загрузки');
define('_SETTINGS_CHANGELOGIN',		'Разрешить дневниководам менять логин и пароль');
define('_SETTINGS_COOKIES_TITLE',	'Настройки Cookie');
define('_SETTINGS_COOKIELIFE',		'Жизнь Cookie для логина');
define('_SETTINGS_COOKIESESSION',	'Сессии Cookies');
define('_SETTINGS_COOKIEMONTH',		'Время жизни месяца');
define('_SETTINGS_COOKIEPATH',		'Cookie путь (для крутых)');
define('_SETTINGS_COOKIEDOMAIN',	'Cookie домен (для крутых)');
define('_SETTINGS_COOKIESECURE',	'Безопасные Cookie (для крутых)');
define('_SETTINGS_LASTVISIT',		'Сохранять Cookies последнего посещения');
define('_SETTINGS_ALLOWCREATE',		'Разрешить гостям создавать аккаунты дневниководов');
define('_SETTINGS_NEWLOGIN',		'Вход доступен для созданных посетителями аккаунтов');
define('_SETTINGS_NEWLOGIN2',		'(только для новосозданных аккаунтов)');
define('_SETTINGS_MEMBERMSGS',		'Разрешить систему внутренних сообщений');
define('_SETTINGS_LANGUAGE',		'Язык');
define('_SETTINGS_DISABLESITE',		'Выключить сайт');
define('_SETTINGS_DBLOGIN',			'mySQL логин &amp; БД');
define('_SETTINGS_UPDATE',			'Обновить настройки');
define('_SETTINGS_UPDATE_BTN',		'Обновить настройки');
define('_SETTINGS_DISABLEJS',		'Выключить JavaScript Toolbar');
define('_SETTINGS_MEDIA',			'Настройки загрузки');
define('_SETTINGS_MEDIAPREFIX',		'Добавлять дату к загружаемым файлам');
define('_SETTINGS_MEMBERS',			'Настройки дневниковода');

// bans
define('_BAN_TITLE',				'Список банов для');
define('_BAN_NONE',					'Нет банов для этого дневника');
define('_BAN_NEW_TITLE',			'Добавить бан');
define('_BAN_NEW_TEXT',				'Добавить новый бан сейчас');
define('_BAN_REMOVE_TITLE',			'Удалить бан');
define('_BAN_IPRANGE',				'IP область');
define('_BAN_BLOGS',				'Какие журналы?');
define('_BAN_DELETE_TITLE',			'Удаление бана');
define('_BAN_ALLBLOGS',				'Все журналы, в которых у вас есть права админа.');
define('_BAN_REMOVED_TITLE',		'Бан удалён');
define('_BAN_REMOVED_TEXT',			'Бан удалён в следующих журналах:');
define('_BAN_ADD_TITLE',			'Добавить бан');
define('_BAN_IPRANGE_TEXT',			'Выберите область IP для блокировки ниже. Меньше номеров - больше адресов.');
define('_BAN_BLOGS_TEXT',			'Вы можете забанить только в одном журнале или во всех, где у вас есть права админа. Выбирайте.');
define('_BAN_REASON_TITLE',			'Причина');
define('_BAN_REASON_TEXT',			'Вы можете указать причину бана, которую злостный нарушитель увидит, когда попытается добавить комментарий или проголосовать. Максимальная длина 256 символов.');
define('_BAN_ADD_BTN',				'Добавить бан');

// LOGIN screen
define('_LOGIN_MESSAGE',			'Сообщение');
define('_LOGIN_NAME',				'Имя');
define('_LOGIN_PASSWORD',			'Пароль');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'Забыли пароль?');

// membermanagement
define('_MEMBERS_TITLE',			'Управление дневниководами');
define('_MEMBERS_CURRENT',			'Текущие дневниководы');
define('_MEMBERS_NEW',				'Новый дневниковод');
define('_MEMBERS_DISPLAY',			'Отображаемое имя');
define('_MEMBERS_DISPLAY_INFO',		'(логин)');
define('_MEMBERS_REALNAME',			'Реальное имя');
define('_MEMBERS_PWD',				'Пароль');
define('_MEMBERS_REPPWD',			'Еще раз пароль');
define('_MEMBERS_EMAIL',			'Email');
define('_MEMBERS_EMAIL_EDIT',		'(При смене e-mail, вам будет выслан новый пароль)');
define('_MEMBERS_URL',				'Сайт');
define('_MEMBERS_SUPERADMIN',		'Права');
define('_MEMBERS_CANLOGIN',			'Возможность логиниться в админку');
define('_MEMBERS_NOTES',			'Примечание');
define('_MEMBERS_NEW_BTN',			'Добавить дневниковода');
define('_MEMBERS_EDIT',				'Редактировать дневниковода');
define('_MEMBERS_EDIT_BTN',			'Изменить настройки');
define('_MEMBERS_BACKTOOVERVIEW',	'Назад к обзору дневниководов');
define('_MEMBERS_DEFLANG',			'Язык');
define('_MEMBERS_USESITELANG',		'- использовать настройки сайта -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'Посетить сайт');
define('_BLOGLIST_ADD',				'Добавить запись');
define('_BLOGLIST_TT_ADD',			'Добавить новую запись в этот дневник');
define('_BLOGLIST_EDIT',			'Редактирование/удаление записи');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Закладки');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'Настройки');
define('_BLOGLIST_TT_SETTINGS',		'Редактирование настроек или управление групповым дневником');
define('_BLOGLIST_BANS',			'Баны');
define('_BLOGLIST_TT_BANS',			'Просмотр, добавление или удаление банов');
define('_BLOGLIST_DELETE',			'Удалить все');
define('_BLOGLIST_TT_DELETE',		'Удалить этот дневник');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'Ваши дневники');
define('_OVERVIEW_YRDRAFTS',		'Ваши черновики');
define('_OVERVIEW_YRSETTINGS',		'Ваши настройки');
define('_OVERVIEW_GSETTINGS',		'Общие настройки');
define('_OVERVIEW_NOBLOGS',			'Вы не состоите ни в одном групповом дневнике');
define('_OVERVIEW_NODRAFTS',		'Черновики отсутствуют');
define('_OVERVIEW_EDITSETTINGS',	'Редактирование настроек...');
define('_OVERVIEW_BROWSEITEMS',		'Просмотр ваших записей...');
define('_OVERVIEW_BROWSECOMM',		'Просмотр ваших комментариев...');
define('_OVERVIEW_VIEWLOG',			'Смотреть лог действий...');
define('_OVERVIEW_MEMBERS',			'Управление дневниководами...');
define('_OVERVIEW_NEWLOG',			'Создать новый дневник...');
define('_OVERVIEW_SETTINGS',		'Редактировать настройки...');
define('_OVERVIEW_TEMPLATES',		'Редактировать шаблоны...');
define('_OVERVIEW_SKINS',			'Редактировать скины...');
define('_OVERVIEW_BACKUP',			'Бэкап/восстановление...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'Записи в дневнике');
define('_ITEMLIST_YOUR',			'Ваши записи');

// Comments
define('_COMMENTS',					'Комментарии');
define('_NOCOMMENTS',				'У этой записи нет комментариев');
define('_COMMENTS_YOUR',			'Ваши комментарии');
define('_NOCOMMENTS_YOUR',			'Вы еще не написали ни одного комментария');

// LISTS (general)
define('_LISTS_NOMORE',				'Нет результатов');
define('_LISTS_PREV',				'Назад');
define('_LISTS_NEXT',				'Вперёд');
define('_LISTS_SEARCH',				'Поиск');
define('_LISTS_CHANGE',				'Изменить');
define('_LISTS_PERPAGE',			'записи/страницы');
define('_LISTS_ACTIONS',			'Действия');
define('_LISTS_DELETE',				'Удалить');
define('_LISTS_EDIT',				'Редактировать');
define('_LISTS_MOVE',				'Переместить');
define('_LISTS_CLONE',				'Клонирование');
define('_LISTS_TITLE',				'Заголовок');
define('_LISTS_BLOG',				'Дневник');
define('_LISTS_NAME',				'Имя');
define('_LISTS_DESC',				'Описание');
define('_LISTS_TIME',				'Время');
define('_LISTS_COMMENTS',			'Комментарии');
define('_LISTS_TYPE',				'Тип');


// member list
define('_LIST_MEMBER_NAME',			'Отображаемое имя');
define('_LIST_MEMBER_RNAME',		'Реальное имя');
define('_LIST_MEMBER_ADMIN',		'Модный? ');
define('_LIST_MEMBER_LOGIN',		'Может входить? ');
define('_LIST_MEMBER_URL',			'Сайт');

// banlist
define('_LIST_BAN_IPRANGE',			'IP область');
define('_LIST_BAN_REASON',			'Причина');

// actionlist
define('_LIST_ACTION_MSG',			'Сообщение');

// commentlist
define('_LIST_COMMENT_BANIP',		'Бан IP');
define('_LIST_COMMENT_WHO',			'Автор');
define('_LIST_COMMENT',				'Комментарий');
define('_LIST_COMMENT_HOST',		'Хост');

// itemlist
define('_LIST_ITEM_INFO',			'Информация');
define('_LIST_ITEM_CONTENT',		'Заголовок и текст');


// teamlist
define('_LIST_TEAM_ADMIN',			'Админ ');
define('_LIST_TEAM_CHADMIN',		'Поменять админа');

// edit comments
define('_EDITC_TITLE',				'Редактирование комментариев');
define('_EDITC_WHO',				'Автор');
define('_EDITC_HOST',				'Откуда?');
define('_EDITC_WHEN',				'Когда?');
define('_EDITC_TEXT',				'Текст');
define('_EDITC_EDIT',				'Редактировать комментарий');
define('_EDITC_MEMBER',				'дневниковод');
define('_EDITC_NONMEMBER',			'недневниковод');

// move item
define('_MOVE_TITLE',				'В какой дневник переместить?');
define('_MOVE_BTN',					'Переместить запись');

?>
