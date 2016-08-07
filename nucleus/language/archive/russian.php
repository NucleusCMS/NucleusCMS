<?php
// Russian Nucleus Language File
//
// Author: Andrey Serebryakov - saahov@gmail.com
// Nucleus version: v1.0-v3.2
// Update: 19.10.2005
// Вопросы по управлению, настройке и модернизации Nucleus можно
// задать на форуме сообщества русских пользователей: http://nucleus.net.ru .


// START changed/added after 3.15 START

define('_LIST_PLUG_SUBS_NEEDUPDATE','Нажмите \'Обновить список\'-button to update the plugin\'s subscription list.');
define('_LIST_PLUGS_DEP',			'Плагину требуется:');

// END changed/added after 3.15

// START changed/added after 3.1 START

// comments list per weblog
define('_COMMENTS_BLOG',			'Все комментарии в разделе');
define('_NOCOMMENTS_BLOG',			'В этом разделе нет комментариев');
define('_BLOGLIST_COMMENTS',		'Комментарии');
define('_BLOGLIST_TT_COMMENTS',		'Список всех комментариев, сделанных к сообщениям этого раздела');


// for use in archivetype-skinvar
define('_ARCHIVETYPE_DAY',			'день');
define('_ARCHIVETYPE_MONTH',		'месяц');

// tickets (prevents malicious users to trick an admin to perform actions he doesn't want)
define('_ERROR_BADTICKET',			'Неправильная или используемая повторно ссылка.');

// plugin dependency
define('_ERROR_INSREQPLUGIN',		'Ошибка при установке плагина, требуется ');
define('_ERROR_DELREQPLUGIN',		'Не удалось выполнить удаление плагина, требуется ');

// cookie prefix
define('_SETTINGS_COOKIEPREFIX',	'Префикс Cookie');

// account activation
define('_ERROR_NOLOGON_NOACTIVATE',	'Ссылка активации не отослана. Вам запрещено входить на сайт.');
define('_ERROR_ACTIVATE',			'Ключ активации не существует, неправильный или используется повторно.');
define('_ACTIONLOG_ACTIVATIONLINK', 'Ссылка активации была отослана');
define('_MSG_ACTIVATION_SENT',		'Ссылка для активации была отослана на e-mail.');

// activation link emails
define('_ACTIVATE_REGISTER_MAIL',	"Здравствуйте, <%memberName%>,\n\nВам необходимо активировать свою эккаунт на <%siteName%> (<%siteUrl%>).\nДля этого перйдите по ссылке: \n\n\t<%activationUrl%>\n\nУ вас есть 2 дня, по истечение этого срока ссылка становится недействительной.");
define('_ACTIVATE_REGISTER_MAILTITLE',	"Активация эккаунта '<%memberName%>'");
define('_ACTIVATE_REGISTER_TITLE',	'Добро пожаловать <%memberName%>');
define('_ACTIVATE_REGISTER_TEXT',	'Вы почти прошли процедуру регистрации. Пожалуйста, введите пароль для Вашей учётной записи.');
define('_ACTIVATE_FORGOT_MAIL',		"Здравствуйте, <%memberName%>,\n\nПерейдя по следующей ссылке, вы можете выбрать новый пароль для своего аккаунта на <%siteName%> (<%siteUrl%>)\n\n\t<%activationUrl%>\n\nУ вас есть 2 дня, по истечение этого срока ссылка становится недействительной.");
define('_ACTIVATE_FORGOT_MAILTITLE',"Переактивация эккаунта '<%memberName%>'");
define('_ACTIVATE_FORGOT_TITLE',	'Добро пожаловать <%memberName%>');
define('_ACTIVATE_FORGOT_TEXT',		'Вы можете ввести новый пароль для Вашего эккаунта:');
define('_ACTIVATE_CHANGE_MAIL',		"Здравствуйте, <%memberName%>,\n\nПосле изменения Вашего e-mail требуется переактивация эккаунта на <%siteName%> (<%siteUrl%>).\nВы можете сделать это перейдя по следующей ссылке: \n\n\t<%activationUrl%>\n\nУ Вас есть 2 дня, по истечение этого срока ссылка становится недействительной.");
define('_ACTIVATE_CHANGE_MAILTITLE',"Переактивация эккаунта '<%memberName%>'");
define('_ACTIVATE_CHANGE_TITLE',	'Добро пожаловать <%memberName%>');
define('_ACTIVATE_CHANGE_TEXT',		'Ваш изменённый адрес был проверен. Спасибо!');
define('_ACTIVATE_SUCCESS_TITLE',	'Активация прошла успешно');
define('_ACTIVATE_SUCCESS_TEXT',	'Ваш эккаунт был успешно активирован.');
define('_MEMBERS_SETPWD',			'Введите пароль');
define('_MEMBERS_SETPWD_BTN',		'Введите пароль');
define('_QMENU_ACTIVATE',			'Активация эккаунта');
define('_QMENU_ACTIVATE_TEXT',		'<p>После активации эккаунта, Вы сможете использовать свои логин и пароль для <a href="index.php?action=showlogin"><strong>входа</strong></a>.</p>');

define('_PLUGS_BTN_UPDATE',			'Обновить список');

// global settings
define('_SETTINGS_JSTOOLBAR',		'Javascript панель');
define('_SETTINGS_JSTOOLBAR_FULL',	'Полная панель (IE)');
define('_SETTINGS_JSTOOLBAR_SIMPLE','Мини-панель (не IE)');
define('_SETTINGS_JSTOOLBAR_NONE',	'Выключить панель');
define('_SETTINGS_URLMODE_HELP',	'(Info: <a href="documentation/tips.html#searchengines-fancyurls">Как включить fancy URLs (ЧПУ)</a>)');

// extra plugin settings part when editing categories/members/blogs/...
define('_PLUGINS_EXTRA',			'Дополнительные опции плагинов');

// itemlist info column keys
define('_LIST_ITEM_BLOG',			'раздел:');
define('_LIST_ITEM_CAT',			'категория:');
define('_LIST_ITEM_AUTHOR',			'автор:');
define('_LIST_ITEM_DATE',			'дата:');
define('_LIST_ITEM_TIME',			'время:');

// indication of registered members in comments list
define('_LIST_COMMENTS_MEMBER', 	'(пользователь)');

// batch operations
define('_BATCH_WITH_SEL',			'С выбранными:');
define('_BATCH_EXEC',				'Сделать');

// quickmenu
define('_QMENU_HOME',				'Начало');
define('_QMENU_ADD',				'Добавить сообщение в:');
define('_QMENU_ADD_SELECT',			'-- выбрать --');
define('_QMENU_USER_SETTINGS',		'Профиль');
define('_QMENU_USER_ITEMS',			'Свои сообщения');
define('_QMENU_USER_COMMENTS',		'Свои комментарии');
define('_QMENU_MANAGE',				'Управление');
define('_QMENU_MANAGE_LOG',			'Лог действий');
define('_QMENU_MANAGE_SETTINGS',	'Конфигурация');
define('_QMENU_MANAGE_MEMBERS',		'Пользователи');
define('_QMENU_MANAGE_NEWBLOG',		'Создать раздел');
define('_QMENU_MANAGE_BACKUPS',		'Бэкап');
define('_QMENU_MANAGE_PLUGINS',		'Плагины');
define('_QMENU_LAYOUT',				'Дизайн');
define('_QMENU_LAYOUT_SKINS',		'Скины');
define('_QMENU_LAYOUT_TEMPL',		'Шаблоны');
define('_QMENU_LAYOUT_IEXPORT',		'Импорт/Экспорт');
define('_QMENU_PLUGINS',			'Плагины');

// quickmenu on logon screen
define('_QMENU_INTRO',				'Необходимо авторизоваться');
define('_QMENU_INTRO_TEXT',			'<p>Для продолжения работы с сайтом необходима авторизация.</p><p>После авторизации Вы сможете добавлять новые сообщения.</p>');

// helppages for plugins
define('_ERROR_PLUGNOHELPFILE',		'Документация не найдена');
define('_PLUGS_HELP_TITLE',			'Документация к плагину');
define('_LIST_PLUGS_HELP', 			'помощь');


// END changed/started after 3.1

// START changed/added after v2.5beta START

// general settings (security)
define('_SETTINGS_EXTAUTH',			'Включить внешнюю аутентификацию');
define('_WARNING_EXTAUTH',			'Внимание: Включать только при необходимости.');

// member profile
define('_MEMBERS_BYPASS',			'Включить внешнюю аутентификацию');

// 'always include in search' blog setting (yes/no) [in v2.5beta, the 'always' part wasn't clear]
define('_EBLOG_SEARCH',				'<em>Всегда</em> включать в поиск');

// END changed/added after v2.5beta

// START introduced after v2.0 START

// media library
define('_MEDIA_VIEW',				'просмотр');
define('_MEDIA_VIEW_TT',			'Просмотр файл (откроется в новом окне)');
define('_MEDIA_FILTER_APPLY',		'Применить фильтр');
define('_MEDIA_FILTER_LABEL',		'Фильтр: ');
define('_MEDIA_UPLOAD_TO',			'Закачать в ...');
define('_MEDIA_UPLOAD_NEW',			'Закачать новый файл...');
define('_MEDIA_COLLECTION_SELECT',	'Выбрать');
define('_MEDIA_COLLECTION_TT',		'Переключить на эту категорию');
define('_MEDIA_COLLECTION_LABEL',	'Текущая коллекция: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'Выровнять влево');
define('_ADD_ALIGNRIGHT_TT',		'Выровнять вправо');
define('_ADD_ALIGNCENTER_TT',		'Выровнять по-центру');


// generic upload failure
define('_ERROR_UPLOADFAILED',		'Ошибка закачки');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'Разрешить размещение сообщений в прошлое');
define('_ADD_CHANGEDATE',			'Обновить время');
define('_BMLET_CHANGEDATE',			'Обновить время');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'Импорт/экспорт скинов...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Обычный');
define('_PARSER_INCMODE_SKINDIR',	'Папка скина');
define('_SKIN_INCLUDE_MODE',		'Include mode');
define('_SKIN_INCLUDE_PREFIX',		'Include prefix');

// global settings
define('_SETTINGS_BASESKIN',		'Скин по-умолчанию');
define('_SETTINGS_SKINSURL',		'URL скинов');
define('_SETTINGS_ACTIONSURL',		'Полный URL к action.php');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'Нельзя перемещать заданную по умолчанию категорию');
define('_ERROR_MOVETOSELF',			'Нельзя перемещать категорию в тот же раздел');
define('_MOVECAT_TITLE',			'Выберите раздел, в который хотите переместить категорию');
define('_MOVECAT_BTN',				'Переместить категорию');

// URLMode setting
define('_SETTINGS_URLMODE',			'Тип URL');
define('_SETTINGS_URLMODE_NORMAL',	'Обычный');
define('_SETTINGS_URLMODE_PATHINFO','ЧПУ');

// Batch operations
define('_BATCH_NOSELECTION',		'Ничего не выбрано для выполнения действия');
define('_BATCH_ITEMS',				'Массовая обработка сообщений');
define('_BATCH_CATEGORIES',			'Массовая операция с категориями');
define('_BATCH_MEMBERS',			'Массовая операция с пользователями');
define('_BATCH_TEAM',				'Массовая операция с участниками команды авторов');
define('_BATCH_COMMENTS',			'Массовая операция с комментариями');
define('_BATCH_UNKNOWN',			'Неизвестная массовая операция: ');
define('_BATCH_EXECUTING',			'Выполнение');
define('_BATCH_ONCATEGORY',			'с категориями');
define('_BATCH_ONITEM',				'с сообщениями');
define('_BATCH_ONCOMMENT',			'с комментариями');
define('_BATCH_ONMEMBER',			'с пользователями');
define('_BATCH_ONTEAM',				'с участником команды авторов');
define('_BATCH_SUCCESS',			'Успешно!');
define('_BATCH_DONE',				'Выполнено!');
define('_BATCH_DELETE_CONFIRM',		'Потвердите массовое удаление');
define('_BATCH_DELETE_CONFIRM_BTN',	'Потвердите массовое удаление');
define('_BATCH_SELECTALL',			'выделить все');
define('_BATCH_DESELECTALL',		'снять выделение');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'Удалить');
define('_BATCH_ITEM_MOVE',			'Переместить');
define('_BATCH_MEMBER_DELETE',		'Удалить');
define('_BATCH_MEMBER_SET_ADM',		'Назначить права администратора');
define('_BATCH_MEMBER_UNSET_ADM',	'Снять права администратора');
define('_BATCH_TEAM_DELETE',		'Удалить из команды авторов');
define('_BATCH_TEAM_SET_ADM',		'Назначить права администратора');
define('_BATCH_TEAM_UNSET_ADM',		'Снять права администратора');
define('_BATCH_CAT_DELETE',			'Удалить');
define('_BATCH_CAT_MOVE',			'Переместить в другой раздел');
define('_BATCH_COMMENT_DELETE',		'Удалить');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'Добавить новое сообщение ...');
define('_ADD_PLUGIN_EXTRAS',		'Дополнительные опции плагинов');

// errors
define('_ERROR_CATCREATEFAIL',		'Не удалось создать новую категорию');
define('_ERROR_NUCLEUSVERSIONREQ',	'Этот плагин предназначен для более поздней версии Nucleus: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Вернуться к настройкам раздела');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Импорт');
define('_SKINIE_TITLE_EXPORT',		'Экспорт');
define('_SKINIE_BTN_IMPORT',		'Импорт');
define('_SKINIE_BTN_EXPORT',		'Экспортировать выбранные скины/шаблоны');
define('_SKINIE_LOCAL',				'Импортировать с файла на сервере:');
define('_SKINIE_NOCANDIDATES',		'Ничего не найдено для импорта в папке скина');
define('_SKINIE_FROMURL',			'Импортировать из URL:');
define('_SKINIE_EXPORT_INTRO',		'Выберите скины и шаблоны, которые вы хотите экспортировать');
define('_SKINIE_EXPORT_SKINS',		'Скины');
define('_SKINIE_EXPORT_TEMPLATES',	'Шаблоны');
define('_SKINIE_EXPORT_EXTRA',		'Дополнительная информация');
define('_SKINIE_CONFIRM_OVERWRITE',	'Перезаписать уже существующие скины (смотрите совпадающие названия)');
define('_SKINIE_CONFIRM_IMPORT',	'Да, я хочу импортировать это');
define('_SKINIE_CONFIRM_TITLE',		'Об импортируемых скинах и шаблонах');
define('_SKINIE_INFO_SKINS',		'Скины в файле:');
define('_SKINIE_INFO_TEMPLATES',	'Шаблоны в файле:');
define('_SKINIE_INFO_GENERAL',		'Информация:');
define('_SKINIE_INFO_SKINCLASH',	'Совпадающие названия скинов:');
define('_SKINIE_INFO_TEMPLCLASH',	'Совпадающие названия шаблонов:');
define('_SKINIE_INFO_IMPORTEDSKINS','Импортированные скины:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Импортрованные шаблоны:');
define('_SKINIE_DONE',				'Импорт произведён');

define('_AND',						'и');
define('_OR',						'или');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'пустое поле (нажмите для редактирования)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'IncludeMode:');
define('_LIST_SKINS_INCPREFIX',		'IncludePrefix:');
define('_LIST_SKINS_DEFINED',		'Используемые части:');

// backup
define('_BACKUPS_TITLE',			'Резервное копирование базы данных / Восстановление');
define('_BACKUP_TITLE',				'Резервное копирование');
define('_BACKUP_INTRO',				'Нажмите кнопку ниже, чтобы сделать резервное копирование базы данных. Сохраните файл в безопасном месте.');
define('_BACKUP_ZIP_YES',			'Попробовать использовать сжатие');
define('_BACKUP_ZIP_NO',			'Не использовать сжатие');
define('_BACKUP_BTN',				'Создать бэкап');
define('_BACKUP_NOTE',				'<b>Примечание:</b> В резервную копию включено только содержание базы данных. Файлы из папки MEDIA и настройки из файла config.php <b>НЕ</b> включены в резервную копию.');
define('_RESTORE_TITLE',			'Восстановление');
define('_RESTORE_NOTE',				'<b>Предупреждение:</b> Восстановление из резервной копии <b>СОТРЁТ</b> все текущии данные Nucleus в базе данных! Вы должны быть уверены в правильности своих действий!	<br />	<b>Примечание:</b> Удостоверитесь, что используемая сейчас версия Nucleus та же самая, какая была при резервном копировании. Иначе могут возникнуть ошибки в работе сайта.');
define('_RESTORE_INTRO',			'Выберите файл с резервной копией (он будет загружен на сервер) и нажмите кнопку "Восстановить из файла", чтобы запустить процесс востановления.');
define('_RESTORE_IMSURE',			'Да, я уверен, что хочу сделать это!');
define('_RESTORE_BTN',				'Восстановить из файла');
define('_RESTORE_WARNING',			'(Убедитесь, что файл резервной копии не повреждён. Возможно следует сделать новую резервную копию.)');
define('_ERROR_BACKUP_NOTSURE',		'Вы не отметили поле "Да, я уверен, что хочу сделать это"');
define('_RESTORE_COMPLETE',			'Восстановление завершено');

// new item notification
define('_NOTIFY_NI_MSG',			'Новое сообщение было добавлено:');
define('_NOTIFY_NI_TITLE',			'Новое сообщение!');
define('_NOTIFY_KV_MSG',			'Karma-голос к сообщению:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'Комментарии к сообщению:');
define('_NOTIFY_NC_TITLE',			'Комментарии Nucleus:');
define('_NOTIFY_USERID',			'ID пользователя:');
define('_NOTIFY_USER',				'Пользователь:');
define('_NOTIFY_COMMENT',			'Комментарий:');
define('_NOTIFY_VOTE',				'Голос:');
define('_NOTIFY_HOST',				'Хост:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'Пользователь:');
define('_NOTIFY_TITLE',				'Заголовок:');
define('_NOTIFY_CONTENTS',			'Содержание:');

// member mail message
define('_MMAIL_MSG',				'Вам послано письмо от:');
define('_MMAIL_FROMANON',			'гость');
define('_MMAIL_FROMNUC',			'Пользователь');
define('_MMAIL_TITLE',				'Сообщение от:');
define('_MMAIL_MAIL',				'Сообщение:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'Добавить сообщение');
define('_BMLET_EDIT',				'Редактировать сообщение');
define('_BMLET_DELETE',				'Удалить сообщение');
define('_BMLET_BODY',				'Превью');
define('_BMLET_MORE',				'Основная часть');
define('_BMLET_OPTIONS',			'Опции');
define('_BMLET_PREVIEW',			'Просмотр');

// used in bookmarklet
define('_ITEM_UPDATED',				'Сообщение изменено');
define('_ITEM_DELETED',				'Сообщение удалено');

// plugins
define('_CONFIRMTXT_PLUGIN',		'Вы действительно хотите удалить плагин');
define('_ERROR_NOSUCHPLUGIN',		'Нет такого плагина');
define('_ERROR_DUPPLUGIN',			'Жаль, но этот плагин уже установлен');
define('_ERROR_PLUGFILEERROR',		'Такого плагина не существует или CHMOD установлен неверно');
define('_PLUGS_NOCANDIDATES',		'Нет плагинов для установки');

define('_PLUGS_TITLE_MANAGE',		'Управление плагинами');
define('_PLUGS_TITLE_INSTALLED',	'Установленные плагины');
define('_PLUGS_TITLE_UPDATE',		'Обновить список');
define('_PLUGS_TEXT_UPDATE',		'В Nucleus сохраняется кэшированный список плагинов. Если вы заменили или удалили какой-то плагин, обновите список.');
define('_PLUGS_TITLE_NEW',			'Установить новый плагин');
define('_PLUGS_ADD_TEXT',			'Ниже приведён список всех файлов, находящихся в папке plugins, которые могут быть установлены. Удостоверьтесь перед установкой, что выбранный Вами файл действительно является плагином.');
define('_PLUGS_BTN_INSTALL',		'Установить плагин');
define('_BACKTOOVERVIEW',			'Вернуться к управлению плагинами');

// editlink
define('_TEMPLATE_EDITLINK',		'Ссылка на редактирование поста');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'Добавить левую колонку');
define('_ADD_RIGHT_TT',				'Добавить правую колонку');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'Новая категория...');

// new settings
define('_SETTINGS_PLUGINURL',		'URL плагина');
define('_SETTINGS_MAXUPLOADSIZE',	'Максимальный размер закачиваемых файлов (в байтах)');
define('_SETTINGS_NONMEMBERMSGS',	'Разрешить гостям посылать сообщения');
define('_SETTINGS_PROTECTMEMNAMES',	'Защитить имена пользователей');

// overview screen
define('_OVERVIEW_PLUGINS',			'Управление плагинами...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'Новый пользователь зарегистрирован:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'Ваш e-mail:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'Вы не имеете прав для закачки файлов. С вопросами обращайтесь к администратору');

// plugin list
define('_LISTS_INFO',				'Информация');
define('_LIST_PLUGS_AUTHOR',		'Автор:');
define('_LIST_PLUGS_VER',			'версия:');
define('_LIST_PLUGS_SITE',			'сайт');
define('_LIST_PLUGS_DESC',			'Описание:');
define('_LIST_PLUGS_SUBS',			'Зависит от:');
define('_LIST_PLUGS_UP',			'вверх');
define('_LIST_PLUGS_DOWN',			'вниз');
define('_LIST_PLUGS_UNINSTALL',		'удалить');
define('_LIST_PLUGS_ADMIN',			'управление');
define('_LIST_PLUGS_OPTIONS',		'настроить');

// plugin option list
define('_LISTS_VALUE',				'Значение');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'Нет настроек для плагина');
define('_PLUGS_BACK',				'Вернуться к обзору плагинов');
define('_PLUGS_SAVE',				'Сохранить настройки');
define('_PLUGS_OPTIONS_UPDATED',	'Настройки плагина обновлены');

define('_OVERVIEW_MANAGEMENT',		'Управление сайтом');
define('_OVERVIEW_MANAGE',			'Все настройки...');
define('_MANAGE_GENERAL',			'Основные настройки');
define('_MANAGE_SKINS',				'Скины и шаблоны');
define('_MANAGE_EXTRA',				'Дополнительные настройки');

define('_BACKTOMANAGE',				'Вернуться к управлению сайтом');


// END introduced after v1.1 END




// charset to use
define('_CHARSET',					'windows-1251');

// global stuff
define('_LOGOUT',					'Выход');
define('_LOGIN',					'Вход');
define('_YES',						'Да');
define('_NO',						'Нет');
define('_SUBMIT',					'Отправить');
define('_ERROR',					'Ошибка');
define('_ERRORMSG',					'Произошла ошибка!');
define('_BACK',						'Вернуться');
define('_NOTLOGGEDIN',				'Не авторизованы');
define('_LOGGEDINAS',				'Вошли как');
define('_ADMINHOME',				'Начало');
define('_NAME',						'Имя');
define('_BACKHOME',					'Вернуться на главную страницу управления сайтом');
define('_BADACTION',				'Запрашивается несуществующее действие');
define('_MESSAGE',					'Сообщение');
define('_HELP_TT',					'Помощь!');
define('_YOURSITE',					'На сайт');


define('_POPUP_CLOSE',				'Закрыть окно');

define('_LOGIN_PLEASE',				'Необходимо сначала авторизоваться');

// commentform
define('_COMMENTFORM_YOUARE',		'Вы');
define('_COMMENTFORM_SUBMIT',		'Комментировать!');
define('_COMMENTFORM_COMMENT',		'Ваш комментарий');
define('_COMMENTFORM_NAME',			'Имя');
define('_COMMENTFORM_MAIL',			'E-mail/HTTP');
define('_COMMENTFORM_REMEMBER',		'Запомнить меня');

// loginform
define('_LOGINFORM_NAME',			'Логин');
define('_LOGINFORM_PWD',			'Пароль');
define('_LOGINFORM_YOUARE',			'Вы вошли как');
define('_LOGINFORM_SHARED',			'Чужой компьютер');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'Отправить');

// search form
define('_SEARCHFORM_SUBMIT',		'Найти!');

// add item form
define('_ADD_ADDTO',				'Добавить сообщение в');
define('_ADD_CREATENEW',			'Создать новое сообщение');
define('_ADD_BODY',					'Анонс (превью)');
define('_ADD_TITLE',				'Заголовок');
define('_ADD_MORE',					'Основная часть');
define('_ADD_CATEGORY',				'Категория');
define('_ADD_PREVIEW',				'Предпросмотр');
define('_ADD_DISABLE_COMMENTS',		'Выключить комментарии?');
define('_ADD_DRAFTNFUTURE',			'Черновики &amp; Будущие сообшения');
define('_ADD_ADDITEM',				'Добавить сообщение');
define('_ADD_ADDNOW',				'Добавить сейчас');
define('_ADD_ADDLATER',				'Добавить позже');
define('_ADD_PLACE_ON',				'Выберите дату');
define('_ADD_ADDDRAFT',				'Добавить в черновики');
define('_ADD_NOPASTDATES',			'(дата и время в прошлом недействительны, будут использовано текущее время)');
define('_ADD_BOLD_TT',				'Жирный');
define('_ADD_ITALIC_TT',			'Курсив');
define('_ADD_HREF_TT',				'Ссылка');
define('_ADD_MEDIA_TT',				'Добавить media');
define('_ADD_PREVIEW_TT',			'Показать/Спрятать предпросмотр');
define('_ADD_CUT_TT',				'Вырезать');
define('_ADD_COPY_TT',				'Копировать');
define('_ADD_PASTE_TT',				'Вставить');


// edit item form
define('_EDIT_ITEM',				'Редактировать сообщение');
define('_EDIT_SUBMIT',				'Сохранить изменения');
define('_EDIT_ORIG_AUTHOR',			'Первоначальный автор');
define('_EDIT_BACKTODRAFTS',		'Добавить в черновики');
define('_EDIT_COMMENTSNOTE',		'(примечание: выключение комментариев не уберёт оставленные ранее комментарии)');

// used on delete screens
define('_DELETE_CONFIRM',			'Потдверждение удаления');
define('_DELETE_CONFIRM_BTN',		'Удалить!');
define('_CONFIRMTXT_ITEM',			'Вы собираетесь удалить следующие сообщения:');
define('_CONFIRMTXT_COMMENT',		'Вы собираетесь удалить следующие комментарии:');
define('_CONFIRMTXT_TEAM1',			'Вы собираетесь удалить ');
define('_CONFIRMTXT_TEAM2',			' из команды авторов раздела ');
define('_CONFIRMTXT_BLOG',			'Раздел, который вы собираетесь удалить: ');
define('_WARNINGTXT_BLOGDEL',		'Внимание! Удалив раздел, Вы удалите вместе с ним все сообщения и комментарии, находящиеся в нём.<br />Убедитесь, что такие действия необходимы.');
define('_CONFIRMTXT_MEMBER',		'Вы собираетесь удалить следующего пользователя: ');
define('_CONFIRMTXT_TEMPLATE',		'Вы собираетесь удалить шаблон ');
define('_CONFIRMTXT_SKIN',			'Вы собираетесь удалить скин ');
define('_CONFIRMTXT_BAN',			'Вы собираетесь снять бан для следующего диапозона IP');
define('_CONFIRMTXT_CATEGORY',		'Вы собираетесь удалить категорию ');

// some status messages
define('_DELETED_ITEM',				'Сообщение удалено');
define('_DELETED_MEMBER',			'Пользователь удалён');
define('_DELETED_COMMENT',			'Комментарий удалён');
define('_DELETED_BLOG',				'Раздел удалён');
define('_DELETED_CATEGORY',			'Категория удалена');
define('_ITEM_MOVED',				'Сообщение перемещено');
define('_ITEM_ADDED',				'Сообщение добавлено');
define('_COMMENT_UPDATED',			'Комментарий обновлён');
define('_SKIN_UPDATED',				'Скин был изменён');
define('_TEMPLATE_UPDATED',			'Шаблон был изменён');

// errors
define('_ERROR_COMMENT_LONGWORD',	'Пожалуйста, не используйте слова длинной более 90 знаков в ваших комментариях');
define('_ERROR_COMMENT_NOCOMMENT',	'Введите комментарий');
define('_ERROR_COMMENT_NOUSERNAME',	'Введите другое имя');
define('_ERROR_COMMENT_TOOLONG',	'Ваш комментарий слишком большой (макс. 5000 знаков)');
define('_ERROR_COMMENTS_DISABLED',	'Комментарии для этого раздела запрещены.');
define('_ERROR_COMMENTS_NONPUBLIC',	'Вы должны быть зарегистрированным пользователем, чтобы добавлять комментарии в этом разделе');
define('_ERROR_COMMENTS_MEMBERNICK','Имя, которое Вы хотите использовать, уже занято другим пользователем. Придумайте любое другое.');
define('_ERROR_SKIN',				'Ошибка скина');
define('_ERROR_ITEMCLOSED',			'Это сообщение закрыто для добавления комментариев.');
define('_ERROR_NOSUCHITEM',			'Нет такого сообщения');
define('_ERROR_NOSUCHBLOG',			'Нет такого раздела');
define('_ERROR_NOSUCHSKIN',			'Нет такого скина');
define('_ERROR_NOSUCHMEMBER',		'Нет такого пользователя');
define('_ERROR_NOTONTEAM',			'Вы не входите в команду авторов этого раздела.');
define('_ERROR_BADDESTBLOG',		'Запрашиваемый раздел не существует');
define('_ERROR_NOTONDESTTEAM',		'Нельзя перемещать сообщения, пока Вы не вступили в команду авторов');
define('_ERROR_NOEMPTYITEMS',		'Нельзя добавлять пустые сообщения!');
define('_ERROR_BADMAILADDRESS',		'Неправильный адрес e-mail');
define('_ERROR_BADNOTIFY',			'Один или несколько email адресов неправильны');
define('_ERROR_BADNAME',			'Не допустимое имя (только символы a-z и 0-9, без пробелов)');
define('_ERROR_NICKNAMEINUSE',		'Такой ник уже используется другим пользователем');
define('_ERROR_PASSWORDMISMATCH',	'Пароли должны соответствовать');
define('_ERROR_PASSWORDTOOSHORT',	'Пароль должен быть не менее 6 символов');
define('_ERROR_PASSWORDMISSING',	'Пароль не ожет быть пустым');
define('_ERROR_REALNAMEMISSING',	'Вы не ввели настоящее имя');
define('_ERROR_ATLEASTONEADMIN',	'Всегда должен быть хотя бы один супер-администратор, который сможет входить в админку');
define('_ERROR_ATLEASTONEBLOGADMIN','Выполнение этого действия сделало бы раздел неуправляемым. Должен быть хотя бы один администратор.');
define('_ERROR_ALREADYONTEAM',		'Вы не можете добавить пользователя, который уже находится в команде авторов.');
define('_ERROR_BADSHORTBLOGNAME',	'Короткое название раздела может состоять из символов a-z, 0-9, без пробелов');
define('_ERROR_DUPSHORTBLOGNAME',	'Короткое название раздела совпадает с другим разделом. Короткое название раздела должно быть уникальным. ');
define('_ERROR_UPDATEFILE',			'Невозможно получить доступ к файлу обновлений. Убедитесь что CHMOD установлен правильно (попробуйте поставить 666). Также обратите внимание на расположение файла относительно admin-area папки, возможно лучше использовать абсолютные пути (например /vash/put/k/nucleus/)');
define('_ERROR_DELDEFBLOG',			'Нельзя удалить раздел по умолчанию');
define('_ERROR_DELETEMEMBER',		'Этот пользователь не может быть удалён, вероятно потому, что он автор сообщений или комментариев');
define('_ERROR_BADTEMPLATENAME',	'Недопустимое имя шаблона, используйте символы a-z, 0-9, без пробелов');
define('_ERROR_DUPTEMPLATENAME',	'Шаблон с таким именем уже существует');
define('_ERROR_BADSKINNAME',		'Недопустимое имя скина, используйте символы a-z, 0-9, без пробелов');
define('_ERROR_DUPSKINNAME',		'Скин с таким именем уже существует');
define('_ERROR_DEFAULTSKIN',		'Всегда должен быть существовать скин с названием "default"');
define('_ERROR_SKINDEFDELETE',		'Невозможно удалить скин, т.к. он используется по умолчанию в следующем разделе: ');
define('_ERROR_DISALLOWED',			'Жаль, но Вы не можете выполнить это действие');
define('_ERROR_DELETEBAN',			'Ошибка при удалении бана (бана не существует)');
define('_ERROR_ADDBAN',				'Ошибка при добавлении бана. Возможно, бан добавился не корректно во всех разделах.');
define('_ERROR_BADACTION',			'Запрашиваемое действие не существует');
define('_ERROR_MEMBERMAILDISABLED',	'Сообщения между пользователями запрещены');
define('_ERROR_MEMBERCREATEDISABLED','Создание эккаунтов отключено');
define('_ERROR_INCORRECTEMAIL',		'Неправильный e-mail адрес');
define('_ERROR_VOTEDBEFORE',		'Вы уже проголосовали за это сообщение');
define('_ERROR_BANNED1',			'Это действие запрещено пока Ваш (ip ');
define('_ERROR_BANNED2',			') забанен.<br> Причина: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'Вы должны авторизоваться, чтобы выполнить это действие');
define('_ERROR_CONNECT',			'Ошибка подключения');
define('_ERROR_FILE_TOO_BIG',		'Файл слишком большой!');
define('_ERROR_BADFILETYPE',		'Жаль, это расширение запрещено');
define('_ERROR_BADREQUEST',			'Неверный запрос закачки');
define('_ERROR_DISALLOWEDUPLOAD',	'Вы не входите ни в одну команду авторов, следовательно, Вам запрещено закачивать файлы.');
define('_ERROR_BADPERMISSIONS',		'Права доступа к файлу/папке установлены неправильно');
define('_ERROR_UPLOADMOVEP',		'Ошибка при перемещении загруженного файла');
define('_ERROR_UPLOADCOPY',			'Ошибка при копировании файла');
define('_ERROR_UPLOADDUPLICATE',	'Файл с таким именем уже существует. Попробуйте переименовать файл перед закачкой.');
define('_ERROR_LOGINDISALLOWED',	'Жаль, но Вам запрещено входить в панель управления сайтом.');
define('_ERROR_DBCONNECT',			'Невозможно соединиться с MySQL сервером');
define('_ERROR_DBSELECT',			'Невозможно выбрать базу данных Nucleus.');
define('_ERROR_NOSUCHLANGUAGE',		'Нет такого языкового файла');
define('_ERROR_NOSUCHCATEGORY',		'Нет такой категории');
define('_ERROR_DELETELASTCATEGORY',	'Должна быть хотя бы одна категория');
define('_ERROR_DELETEDEFCATEGORY',	'Нельзя удалить заданную по умолчанию категорию');
define('_ERROR_BADCATEGORYNAME',	'Неправильное имя категории');
define('_ERROR_DUPCATEGORYNAME',	'Категория с таким именем уже существует');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'Предупреждение: Текущее значение - не директория!');
define('_WARNING_NOTREADABLE',		'Предупреждение: Текущее значение - нечитаемая директория!');
define('_WARNING_NOTWRITABLE',		'Warning: Текущее значение - не перезаписываемая директория!');

// media and upload
define('_MEDIA_UPLOADLINK',			'Закачать файл');
define('_MEDIA_MODIFIED',			'изменён');
define('_MEDIA_FILENAME',			'имя файла');
define('_MEDIA_DIMENSIONS',			'размеры');
define('_MEDIA_INLINE',				'Встроенный');
define('_MEDIA_POPUP',				'Popup');
define('_UPLOAD_TITLE',				'Выберите файл');
define('_UPLOAD_MSG',				'Выберите файл, который вы хотите закачать и нажмите кнопку "Закачать".');
define('_UPLOAD_BUTTON',			'Закачать');

// some status messages
//define('_MSG_ACCOUNTCREATED',		'Account created, password will be sent through email');
//define('_MSG_PASSWORDSENT',			'Password has been sent by e-mail.');
define('_MSG_LOGINAGAIN',			'Вы должны войти снова, потому что информация о Вас изменена.');
define('_MSG_SETTINGSCHANGED',		'Настройки сохранены');
define('_MSG_ADMINCHANGED',			'Администратор изменён');
define('_MSG_NEWBLOG',				'Новый раздел создан');
define('_MSG_ACTIONLOGCLEARED',		'Лог действий очищен');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'Запрещённые действия: ');
define('_ACTIONLOG_PWDREMINDERSENT','Отослан новый пароль для ');
define('_ACTIONLOG_TITLE',			'Лог действий');
define('_ACTIONLOG_CLEAR_TITLE',	'Очистить лог действий');
define('_ACTIONLOG_CLEAR_TEXT',		'Запустить процесс очистки');

// team management
define('_TEAM_TITLE',				'Управление командой авторов для раздела ');
define('_TEAM_CURRENT',				'Текущая команда');
define('_TEAM_ADDNEW',				'Добавить пользователя в команду авторов');
define('_TEAM_CHOOSEMEMBER',		'Выберите пользователя');
define('_TEAM_ADMIN',				'Привилегии администратора? ');
define('_TEAM_ADD',					'Добавить в команду');
define('_TEAM_ADD_BTN',				'Добавить в команду');

// blogsettings
define('_EBLOG_TITLE',				'Настройка раздела');
define('_EBLOG_TEAM_TITLE',			'Управление командой авторов');
define('_EBLOG_TEAM_TEXT',			'Изменить команду авторов для этого раздела...');
define('_EBLOG_SETTINGS_TITLE',		'Настройки раздела');
define('_EBLOG_NAME',				'Название раздела');
define('_EBLOG_SHORTNAME',			'Короткое имя');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(символы a-z без пробелов)');
define('_EBLOG_DESC',				'Описание раздела');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'Скин по умолчанию');
define('_EBLOG_DEFCAT',				'Основная категория');
define('_EBLOG_LINEBREAKS',			'Автоматическая конвертация пустых срок в br');
define('_EBLOG_DISABLECOMMENTS',	'Разрешить комментарии?<br /><small>(Если "Нет", то комментировать будет невозможно.)</small>');
define('_EBLOG_ANONYMOUS',			'Разрешить комментирование гостям?');
define('_EBLOG_NOTIFY',				'Адрес (а) e-mail для уведомлений<br /> (знак ; как разделитель)');
define('_EBLOG_NOTIFY_ON',			'Уведомлять при');
define('_EBLOG_NOTIFY_COMMENT',		'Новых комментариях');
define('_EBLOG_NOTIFY_KARMA',		'Новых карма голосах');
define('_EBLOG_NOTIFY_ITEM',		'Новых сообщениях');
define('_EBLOG_PING',				'Пинговать Weblogs.com при обновлении?');
define('_EBLOG_MAXCOMMENTS',		'Максимум комментариев');
define('_EBLOG_UPDATE',				'Файл обновлений');
define('_EBLOG_OFFSET',				'Корректировка времени');
define('_EBLOG_STIME',				'Время сервера');
define('_EBLOG_BTIME',				'Время раздела');
define('_EBLOG_CHANGE',				'Применить изменения');
define('_EBLOG_CHANGE_BTN',			'Применить изменения');
define('_EBLOG_ADMIN',				'Администратор раздела');
define('_EBLOG_ADMIN_MSG',			'Вам будут назначены права администратора');
define('_EBLOG_CREATE_TITLE',		'Создать новый раздел');
define('_EBLOG_CREATE_TEXT',		'Заполните форму для создания блога. <br /><br /> <b>Примечание:</b> В форме только самые необходимые опции. Чтобы изменить и настроить раздел, перейдите на страницу настроек после создания раздела.');
define('_EBLOG_CREATE',				'Создать!');
define('_EBLOG_CREATE_BTN',			'Создать раздел');
define('_EBLOG_CAT_TITLE',			'Категории');
define('_EBLOG_CAT_NAME',			'Имя категории');
define('_EBLOG_CAT_DESC',			'Описание категории');
define('_EBLOG_CAT_CREATE',			'Создать новую категорию');
define('_EBLOG_CAT_UPDATE',			'Обновить категорию');
define('_EBLOG_CAT_UPDATE_BTN',		'Обновить категорию');

// templates
define('_TEMPLATE_TITLE',			'Управление шаблонами');
define('_TEMPLATE_AVAILABLE_TITLE',	'Доступные шаблоны');
define('_TEMPLATE_NEW_TITLE',		'Новый шаблон');
define('_TEMPLATE_NAME',			'Имя шаблона');
define('_TEMPLATE_DESC',			'Описание шаблона');
define('_TEMPLATE_CREATE',			'Создать шаблон');
define('_TEMPLATE_CREATE_BTN',		'Создать шаблон');
define('_TEMPLATE_EDIT_TITLE',		'Изменить шаблон');
define('_TEMPLATE_BACK',			'Вернуться к обзору шаблонов');
define('_TEMPLATE_EDIT_MSG',		'Не все части шаблона необходимы. Некоторые поля можно оставить незаполненными.');
define('_TEMPLATE_SETTINGS',		'Главные настройки шаблона');
define('_TEMPLATE_ITEMS',			'Сообщение');
define('_TEMPLATE_ITEMHEADER',		'"Шапка" сообщения');
define('_TEMPLATE_ITEMBODY',		'Краткое описание');
define('_TEMPLATE_ITEMFOOTER',		'"Подвал" сообщения');
define('_TEMPLATE_MORELINK',		'Ссылка на полное сообщение');
define('_TEMPLATE_NEW',				'Индикация новых сообщений');
define('_TEMPLATE_COMMENTS_ANY',	'Комментарии (если есть)');
define('_TEMPLATE_CHEADER',			'"Шапка" комментария ');
define('_TEMPLATE_CBODY',			'Тело комменатрия');
define('_TEMPLATE_CFOOTER',			'"Подвал" комментария');
define('_TEMPLATE_CONE',			'Один комментарий');
define('_TEMPLATE_CMANY',			'2 или больше комментариев');
define('_TEMPLATE_CMORE',			'Ссылка на все комментарии');
define('_TEMPLATE_CMEXTRA',			'Extra настройки пользователей');
define('_TEMPLATE_COMMENTS_NONE',	'Комментарии (если нет)');
define('_TEMPLATE_CNONE',			'Нет комментариев');
define('_TEMPLATE_COMMENTS_TOOMUCH','Комментарии (если есть, но больше, чем положено)');
define('_TEMPLATE_CTOOMUCH',		'Слишком много комментариев');
define('_TEMPLATE_ARCHIVELIST',		'Список архива');
define('_TEMPLATE_AHEADER',			'"Шапка" списка архива');
define('_TEMPLATE_AITEM',			'Пункт списка архива');
define('_TEMPLATE_AFOOTER',			'"Подвал" списка архива');
define('_TEMPLATE_DATETIME',		'Время и дата');
define('_TEMPLATE_DHEADER',			'"Шапка" даты');
define('_TEMPLATE_DFOOTER',			'"Подвал" даты');
define('_TEMPLATE_DFORMAT',			'Формат даты');
define('_TEMPLATE_TFORMAT',			'Формат времени');
define('_TEMPLATE_LOCALE',			'Регион (язык)');
define('_TEMPLATE_IMAGE',			'Картинка Popup');
define('_TEMPLATE_PCODE',			'Ссылка Popup');
define('_TEMPLATE_ICODE',			'Код встроенного изображения');
define('_TEMPLATE_MCODE',			'Код ссылки media-объектов');
define('_TEMPLATE_SEARCH',			'Поиск');
define('_TEMPLATE_SHIGHLIGHT',		'Подстветка');
define('_TEMPLATE_SNOTFOUND',		'Ничего не найдено при поиске');
define('_TEMPLATE_UPDATE',			'Обновить');
define('_TEMPLATE_UPDATE_BTN',		'Обновить шаблон');
define('_TEMPLATE_RESET_BTN',		'Сбросить данные');
define('_TEMPLATE_CATEGORYLIST',	'Список категорий');
define('_TEMPLATE_CATHEADER',		'"Шапка" списка категорий');
define('_TEMPLATE_CATITEM',			'Пункт списка категорий');
define('_TEMPLATE_CATFOOTER',		'"Подвал" списка категорий');

// skins
define('_SKIN_EDIT_TITLE',			'Редактировать скин');
define('_SKIN_AVAILABLE_TITLE',		'Доступные скины');
define('_SKIN_NEW_TITLE',			'Новый скин');
define('_SKIN_NAME',				'Имя');
define('_SKIN_DESC',				'Описание');
define('_SKIN_TYPE',				'Тип контента');
define('_SKIN_CREATE',				'Создать');
define('_SKIN_CREATE_BTN',			'Создать скин');
define('_SKIN_EDITONE_TITLE',		'Изменить скин');
define('_SKIN_BACK',				'Вернуться к обзору скинов');
define('_SKIN_PARTS_TITLE',			'Части скина');
define('_SKIN_PARTS_MSG',			'Не все составляющие необходимы для скинов. Оставте пустыми те, которые Вам не нужны. <br>Выберите скин, который Вы хотите отредактировать:');
define('_SKIN_PART_MAIN',			'Главная страница');
define('_SKIN_PART_ITEM',			'Страница с сообщением');
define('_SKIN_PART_ALIST',			'Список архива');
define('_SKIN_PART_ARCHIVE',		'Архив');
define('_SKIN_PART_SEARCH',			'Поиск');
define('_SKIN_PART_ERROR',			'Ошибки');
define('_SKIN_PART_MEMBER',			'Информация о пользователе');
define('_SKIN_PART_POPUP',			'Картинка Popups');
define('_SKIN_GENSETTINGS_TITLE',	'Основные настройки');
define('_SKIN_CHANGE',				'Изменить');
define('_SKIN_CHANGE_BTN',			'Изменить настройки');
define('_SKIN_UPDATE_BTN',			'Обновить скин');
define('_SKIN_RESET_BTN',			'Сбосить данные');
define('_SKIN_EDITPART_TITLE',		'Редактировать скин');
define('_SKIN_GOBACK',				'Вернуться');
define('_SKIN_ALLOWEDVARS',			'Доступные переменные (нажмите для информации):');

// global settings
define('_SETTINGS_TITLE',			'Основные настройки');
define('_SETTINGS_SUB_GENERAL',		'Основные настройки');
define('_SETTINGS_DEFBLOG',			'Раздел по умолчанию');
define('_SETTINGS_ADMINMAIL',		'E-mail администратора');
define('_SETTINGS_SITENAME',		'Название сайта');
define('_SETTINGS_SITEURL',			'URL сайта (должен заканчиваться слэшом "/")');
define('_SETTINGS_ADMINURL',		'URL администраторской части (должен заканчиваться слэшом "/")');
define('_SETTINGS_DIRS',			'Nucleus - абсолютный путь на сервере');
define('_SETTINGS_MEDIADIR',		'Media - абсолютный путь на сервере');
define('_SETTINGS_SEECONFIGPHP',	'(см. config.php)');
define('_SETTINGS_MEDIAURL',		'Media URL (должен заканчиваться слэшом "/")');
define('_SETTINGS_ALLOWUPLOAD',		'Разрешить загрузку?');
define('_SETTINGS_ALLOWUPLOADTYPES','Разрешённые расширения');
define('_SETTINGS_CHANGELOGIN',		'Разрешить пользователям менять логин/пароль');
define('_SETTINGS_COOKIES_TITLE',	'Настройки Cookie');
define('_SETTINGS_COOKIELIFE',		'Срок действия Cookie');
define('_SETTINGS_COOKIESESSION',	'По сессиям');
define('_SETTINGS_COOKIEMONTH',		'Один месяц');
define('_SETTINGS_COOKIEPATH',		'Путь Cookie (расширенные настройки)');
define('_SETTINGS_COOKIEDOMAIN',	'Домен Cookie (расширенные настройки)');
define('_SETTINGS_COOKIESECURE',	'Безопасные Cookie (расширенные настройки)');
define('_SETTINGS_LASTVISIT',		'Сохранять Cookies последнего посещения');
define('_SETTINGS_ALLOWCREATE',		'Разрешить самостоятельную регистрацию');
define('_SETTINGS_NEWLOGIN',		'Разрешить зарегистрированным пользователям входить в админку');
define('_SETTINGS_NEWLOGIN2',		'(только для новых эккаунтов)');
define('_SETTINGS_MEMBERMSGS',		'Разрешить сообщения между пользователями');
define('_SETTINGS_LANGUAGE',		'Язык по умолчанию');
define('_SETTINGS_DISABLESITE',		'Выключить сайт');
define('_SETTINGS_DBLOGIN',			'mySQL данные');
define('_SETTINGS_UPDATE',			'Сохранить изменения');
define('_SETTINGS_UPDATE_BTN',		'Сохранить изменения');
define('_SETTINGS_DISABLEJS',		'Выключить панель JavaScript');
define('_SETTINGS_MEDIA',			'Настройки Media/Upload');
define('_SETTINGS_MEDIAPREFIX',		'Префикс даты для загружаемых файлов');
define('_SETTINGS_MEMBERS',			'Настройки пользователей');

// bans
define('_BAN_TITLE',				'Список бана для');
define('_BAN_NONE',					'Нет банов для этого раздела');
define('_BAN_NEW_TITLE',			'Установить бан');
define('_BAN_NEW_TEXT',				'Установить бан');
define('_BAN_REMOVE_TITLE',			'Удалить бан');
define('_BAN_IPRANGE',				'Диапозон IP');
define('_BAN_BLOGS',				'Для каких разделов?');
define('_BAN_DELETE_TITLE',			'Удалить бан');
define('_BAN_ALLBLOGS',				'Все разделы, в которых Вы имеете администраторские привилегии.');
define('_BAN_REMOVED_TITLE',		'Удалить бан');
define('_BAN_REMOVED_TEXT',			'Бан был снят для следующих разделов:');
define('_BAN_ADD_TITLE',			'Установить бан');
define('_BAN_IPRANGE_TEXT',			'Выберите диапозон IP, который Вы хотите заблокировать. Чем меньше чисел будет в диапозоне, тем больше адресов будет заблокировано.');
define('_BAN_BLOGS_TEXT',			'Вы можете выбрать, как забанить IP - в одном разделе или в всех разделах, в которых вы обладаете привилегиями администратора.');
define('_BAN_REASON_TITLE',			'Причина');
define('_BAN_REASON_TEXT',			'Причина бана (появится при попытке обладателя IP-адреса оставить комментарий или сделать голос кармы, максимум 256 знаков)');
define('_BAN_ADD_BTN',				'Установить бан');

// LOGIN screen
define('_LOGIN_MESSAGE',			'Сообщение');
define('_LOGIN_NAME',				'Имя');
define('_LOGIN_PASSWORD',			'Пароль');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'Вспомнить пароль');

// membermanagement
define('_MEMBERS_TITLE',			'Управление пользователями');
define('_MEMBERS_CURRENT',			'Текущие пользователи');
define('_MEMBERS_NEW',				'Новый пользователь');
define('_MEMBERS_DISPLAY',			'Отображаемое имя');
define('_MEMBERS_DISPLAY_INFO',		'(Это имя используется для входа)');
define('_MEMBERS_REALNAME',			'Настоящее имя');
define('_MEMBERS_PWD',				'Пароль');
define('_MEMBERS_REPPWD',			'Повторите пароль');
define('_MEMBERS_EMAIL',			'E-mail');
define('_MEMBERS_EMAIL_EDIT',		'(Когда Вы изменяте e-mail, новый пароль будет выслан автоматически на новый адрес)');
define('_MEMBERS_URL',				'Сайт (URL)');
define('_MEMBERS_SUPERADMIN',		'Администратор');
define('_MEMBERS_CANLOGIN',			'Может входить в админку');
define('_MEMBERS_NOTES',			'Заметки');
define('_MEMBERS_NEW_BTN',			'Добавить пользователя');
define('_MEMBERS_EDIT',				'Изменить профиль пользователя');
define('_MEMBERS_EDIT_BTN',			'Внести изменения');
define('_MEMBERS_BACKTOOVERVIEW',	'Вернуться к обзору пользователей');
define('_MEMBERS_DEFLANG',			'Язык');
define('_MEMBERS_USESITELANG',		'- использовать настройки сайта -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'Посетить сайт');
define('_BLOGLIST_ADD',				'Добавить сообщение');
define('_BLOGLIST_TT_ADD',			'Добавить сообщение в этот раздел');
define('_BLOGLIST_EDIT',			'Ред./Уд. сообщения');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Bookmarklet');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'Настройки');
define('_BLOGLIST_TT_SETTINGS',		'Настройки и управление командой авторов');
define('_BLOGLIST_BANS',			'Bans');
define('_BLOGLIST_TT_BANS',			'Просмотреть, добавить или удалить забаненные IP-адресы');
define('_BLOGLIST_DELETE',			'Удалить');
define('_BLOGLIST_TT_DELETE',		'Удалить раздел');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'Разделы сайта');
define('_OVERVIEW_YRDRAFTS',		'Ваши черновики');
define('_OVERVIEW_YRSETTINGS',		'Ваши настройки');
define('_OVERVIEW_GSETTINGS',		'Конфигурация сайта');
define('_OVERVIEW_NOBLOGS',			'Вы не входите ни в одну команду авторов');
define('_OVERVIEW_NODRAFTS',		'Черновиков нет');
define('_OVERVIEW_EDITSETTINGS',	'Настроить профиль ...');
define('_OVERVIEW_BROWSEITEMS',		'Посмотреть свои сообщения ...');
define('_OVERVIEW_BROWSECOMM',		'Посмотреть свои комментарии ...');
define('_OVERVIEW_VIEWLOG',			'Посмотреть лог действий ...');
define('_OVERVIEW_MEMBERS',			'Управление пользователями ...');
define('_OVERVIEW_NEWLOG',			'Создать новый раздел ...');
define('_OVERVIEW_SETTINGS',		'Изменить настройки ...');
define('_OVERVIEW_TEMPLATES',		'Изменить шаблоны ...');
define('_OVERVIEW_SKINS',			'Изменить скины ...');
define('_OVERVIEW_BACKUP',			'Бэкап/Восстановление ...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'Сообщения в разделе');
define('_ITEMLIST_YOUR',			'Ваши сообщения');

// Comments
define('_COMMENTS',					'Комментарии');
define('_NOCOMMENTS',				'Нет комментариев к этому сообщению');
define('_COMMENTS_YOUR',			'Ваши комментарии');
define('_NOCOMMENTS_YOUR',			'Вы не оставляли комментариев');

// LISTS (general)
define('_LISTS_NOMORE',				'No more results, or no results at all');
define('_LISTS_PREV',				'Предыдущая');
define('_LISTS_NEXT',				'Следующая');
define('_LISTS_SEARCH',				'Поиск');
define('_LISTS_CHANGE',				'Показать');
define('_LISTS_PERPAGE',			'сообщений на странице');
define('_LISTS_ACTIONS',			'Действия');
define('_LISTS_DELETE',				'Удалить');
define('_LISTS_EDIT',				'Редактировать');
define('_LISTS_MOVE',				'Переместить');
define('_LISTS_CLONE',				'Копировать');
define('_LISTS_TITLE',				'Название');
define('_LISTS_BLOG',				'Раздел');
define('_LISTS_NAME',				'Имя');
define('_LISTS_DESC',				'Описание');
define('_LISTS_TIME',				'Время');
define('_LISTS_COMMENTS',			'Комментарии');
define('_LISTS_TYPE',				'Тип');


// member list
define('_LIST_MEMBER_NAME',			'Отображаемое имя');
define('_LIST_MEMBER_RNAME',		'RНастоящее имя');
define('_LIST_MEMBER_ADMIN',		'Супер-админ? ');
define('_LIST_MEMBER_LOGIN',		'Может входить в админку? ');
define('_LIST_MEMBER_URL',			'Сайт');

// banlist
define('_LIST_BAN_IPRANGE',			'Диапозон IP');
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
define('_LIST_TEAM_ADMIN',			'Администратор ');
define('_LIST_TEAM_CHADMIN',		'Сделать администратором');

// edit comments
define('_EDITC_TITLE',				'Изменить комментарии');
define('_EDITC_WHO',				'Автор');
define('_EDITC_HOST',				'Откуда');
define('_EDITC_WHEN',				'Когда');
define('_EDITC_TEXT',				'Текст комментария');
define('_EDITC_EDIT',				'Изменить комментарий');
define('_EDITC_MEMBER',				'пользователь');
define('_EDITC_NONMEMBER',			'гость');

// move item
define('_MOVE_TITLE',				'Выберите раздел для перемещения');
define('_MOVE_BTN',					'Переместить сообщение');

?>
