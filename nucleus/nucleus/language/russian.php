<?php
// Russian Nucleus Language File (cyrillic charset Windows-1251)
// 
// Author: *** diarchy *** (andy@diarchy.ru)
// Inserted and corrected by * elLf * (ellf@ellf.ru)
// File version: 3.15
// Nucleus version: v3.15
//
//=========================================================================
//
// Файл поддержки русского языка движка Nucleus (кодировка Windows-1251)
//
// Автор: *** diarchy *** (andy@diarchy.ru)
// Дополнено и исправлено: * elLf * (ellf@ellf.ru)
// Версия файла: 3.15
// Версия движка Nucleus: v3.15
//
// START changed/added after v2.5beta START

// general settings (security)
define('_SETTINGS_EXTAUTH',			'Включить внешнюю авторизацию');
define('_WARNING_EXTAUTH',			'Внимание: включайте только при необходимости.');

// member profile
define('_MEMBERS_BYPASS',			'Использовать внешнюю авторизацию');

// 'always include in search' blog setting (yes/no) [in v2.5beta, the 'always' part wasn't clear]
define('_EBLOG_SEARCH',				'<em>Всегда</em> включать в поиск');

// END changed/added after v2.5beta

// START introduced after v2.0 START

// media library
define('_MEDIA_VIEW',				'посмотреть');
define('_MEDIA_VIEW_TT',			'Посмотреть файл (открывается в новом окне)');
define('_MEDIA_FILTER_APPLY',		'Применить фильтр');
define('_MEDIA_FILTER_LABEL',		'Фильтр: ');
define('_MEDIA_UPLOAD_TO',			'Закачать в...');
define('_MEDIA_UPLOAD_NEW',			'Закачать новый файл...');
define('_MEDIA_COLLECTION_SELECT',	'Выбрать');
define('_MEDIA_COLLECTION_TT',		'Переключиться в эту категорию');
define('_MEDIA_COLLECTION_LABEL',	'Текущая коллекция: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'Выровнять по левому краю');
define('_ADD_ALIGNRIGHT_TT',		'Выровнять по правому краю');
define('_ADD_ALIGNCENTER_TT',		'Выровнять по центру');

// searchable blog setting (yes/no)
define('_EBLOG_SEARCH',				'Включить в поиск по сайту');

// generic upload failure
define('_ERROR_UPLOADFAILED',		'Загрузка не удалась');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'Разрешить постинг с прошедшими датами');
define('_ADD_CHANGEDATE',			'Обновить метку времени');
define('_BMLET_CHANGEDATE',			'Обновить метку времени');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'Импорт/Экспорт скина...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Нормальный');
define('_PARSER_INCMODE_SKINDIR',	'Используйте каталог скинов');
define('_SKIN_INCLUDE_MODE',		'Include mode');
define('_SKIN_INCLUDE_PREFIX',		'Include prefix');

// global settings
define('_SETTINGS_BASESKIN',		'Основной скин');
define('_SETTINGS_SKINSURL',		'URL скина');
define('_SETTINGS_ACTIONSURL',		'Полный URL для action.php');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'Невозможно переместить категорию по-умолчанию');
define('_ERROR_MOVETOSELF',			'Невозможно переместить категорию (блог назначения тот же что и блог источник)');
define('_MOVECAT_TITLE',			'Выберите блог для перемещения категории');
define('_MOVECAT_BTN',				'Переместить категорию');

// URLMode setting
define('_SETTINGS_URLMODE',			'Режим URL');
define('_SETTINGS_URLMODE_NORMAL',	'Нормальный');
define('_SETTINGS_URLMODE_PATHINFO','Fancy');

// Batch operations
define('_BATCH_NOSELECTION',		'Ничего не выбрано для выполнения операции');
define('_BATCH_ITEMS',				'Групповая операция с темами');
define('_BATCH_CATEGORIES',			'Групповая операция с категориями');
define('_BATCH_MEMBERS',			'Групповая операция с членами');
define('_BATCH_TEAM',				'Групповая операция с группами членов');
define('_BATCH_COMMENTS',			'Групповая операция с комментариями');
define('_BATCH_UNKNOWN',			'Неизвестная групповая операция: ');
define('_BATCH_EXECUTING',			'Выполнение');
define('_BATCH_ONCATEGORY',			'on category');
define('_BATCH_ONITEM',				'on item');
define('_BATCH_ONCOMMENT',			'on comment');
define('_BATCH_ONMEMBER',			'on member');
define('_BATCH_ONTEAM',				'on team member');
define('_BATCH_SUCCESS',			'Выполненно!');
define('_BATCH_DONE',				'Готово!');
define('_BATCH_DELETE_CONFIRM',		'Подтвердите групповое удаление');
define('_BATCH_DELETE_CONFIRM_BTN',	'Подтвердите групповое удаление');
define('_BATCH_SELECTALL',			'выбрать все');
define('_BATCH_DESELECTALL',		'отменить выбор');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'Удалить');
define('_BATCH_ITEM_MOVE',			'Переместить');
define('_BATCH_MEMBER_DELETE',		'Удалить');
define('_BATCH_MEMBER_SET_ADM',		'Дать права администратора');
define('_BATCH_MEMBER_UNSET_ADM',	'Отобрать права администратора');
define('_BATCH_TEAM_DELETE',		'Удалить из группы');
define('_BATCH_TEAM_SET_ADM',		'Дать права администратора');
define('_BATCH_TEAM_UNSET_ADM',		'Отобрать права администратора');
define('_BATCH_CAT_DELETE',			'Удалить');
define('_BATCH_CAT_MOVE',			'Переместить в другой блог');
define('_BATCH_COMMENT_DELETE',		'Удалить');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'Добавить новую запись...');
define('_ADD_PLUGIN_EXTRAS',		'Дополнительные настройки плагина');

// errors
define('_ERROR_CATCREATEFAIL',		'Невозможно создать новую категорию');
define('_ERROR_NUCLEUSVERSIONREQ',	'Этот плагин требует новой версии Nucleus: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'Назад к настройкам блога');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Импорт');
define('_SKINIE_TITLE_EXPORT',		'Экспорт');
define('_SKINIE_BTN_IMPORT',		'Импорт');
define('_SKINIE_BTN_EXPORT',		'Экспорт выбранных скинов/шаблонов');
define('_SKINIE_LOCAL',				'Импорт из локального файла:');
define('_SKINIE_NOCANDIDATES',		'Не найдены кандидаты для импорта в каталоге скинов');
define('_SKINIE_FROMURL',			'Импорт с адреса (URL):');
define('_SKINIE_EXPORT_INTRO',		'Выберите скины и шаблоны которы вы хотите экспортировать');
define('_SKINIE_EXPORT_SKINS',		'Скины');
define('_SKINIE_EXPORT_TEMPLATES',	'Шаблоны');
define('_SKINIE_EXPORT_EXTRA',		'Дополнительная информация');
define('_SKINIE_CONFIRM_OVERWRITE',	'Презаписать скины, которые уже существуют (см. совпадающие имена)');
define('_SKINIE_CONFIRM_IMPORT',	'Да, я хочу это импортировать');
define('_SKINIE_CONFIRM_TITLE',		'Об импорте скинов и шаблонов');
define('_SKINIE_INFO_SKINS',		'Скины в файл:');
define('_SKINIE_INFO_TEMPLATES',	'Шаблоны в файл:');
define('_SKINIE_INFO_GENERAL',		'Информация:');
define('_SKINIE_INFO_SKINCLASH',	'Имена скинов повторяются:');
define('_SKINIE_INFO_TEMPLCLASH',	'Имена шаблонов повторяются:');
define('_SKINIE_INFO_IMPORTEDSKINS','Импортирование скинов:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Импортирование шаблонов:');
define('_SKINIE_DONE',				'Успешное импортирование');

define('_AND',						'и');
define('_OR',						'или');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'пустое поле (нажмите для редактирования)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'IncludeMode:');
define('_LIST_SKINS_INCPREFIX',		'IncludePrefix:');
define('_LIST_SKINS_DEFINED',		'Defined parts:');

// backup
define('_BACKUPS_TITLE',			'Архивирование / Восстановление');
define('_BACKUP_TITLE',				'Архивирование');
define('_BACKUP_INTRO',				'Нажмите на кнопку расположенную ниже для создания архива базы данных Nucleus. Вам будет задан вопрос где сохранить файл архива. Сохраните его в безопасном месте.');
define('_BACKUP_ZIP_YES',			'Использовать компрессию');
define('_BACKUP_ZIP_NO',			'Не использовать компрессию');
define('_BACKUP_BTN',				'Создать архив');
define('_BACKUP_NOTE',				'<b>Замечание:</b> В архиве сохраняется только содержимое базы данных. Медиа-файлы и настройки из config.php  <b>НЕ</b> включаются в архив.');
define('_RESTORE_TITLE',			'Восстановление');
define('_RESTORE_NOTE',				'<b>ВНИМАНИЕ:</b> Восстановление из архива приведет к <b>УДАЛЕНИЮ</b> всей текущей информации из базы данных! Выполняете эту операцию только если Вы действительно уверены!	<br />	<b>Замечание:</b> Убедитесь, что версия  Nucleus вашего архива совпадает с версией, которая работает сейчас');
define('_RESTORE_INTRO',			'Выберите файл архива (его необходимо загрузить на сервер) и нажмите кнопку "Восстановить" для выполнения восстановления.');
define('_RESTORE_IMSURE',			'Да, я уверен что нужно это сделать!');
define('_RESTORE_BTN',				'Восстановление из файла');
define('_RESTORE_WARNING',			'(Удостоверитесь, что вы восстанавливаете нужную резервную копию, возможно нужно сделаеть резервную копию текущего состояния прежде, чем выполнять восстановление)');
define('_ERROR_BACKUP_NOTSURE',		'Нужно отметить поле \'Я уверен\'');
define('_RESTORE_COMPLETE',			'Востановление завершено');

// new item notification
define('_NOTIFY_NI_MSG',			'Создана новая тема:');
define('_NOTIFY_NI_TITLE',			'Новая тема!');
define('_NOTIFY_KV_MSG',			'Оценка темы:');
define('_NOTIFY_KV_TITLE',			'Оценка:');
define('_NOTIFY_NC_MSG',			'Комментарий темы:');
define('_NOTIFY_NC_TITLE',			'Комментарий:');
define('_NOTIFY_USERID',			'ID пользователя:');
define('_NOTIFY_USER',				'Пользователь:');
define('_NOTIFY_COMMENT',			'Коментарий:');
define('_NOTIFY_VOTE',				'Оценка:');
define('_NOTIFY_HOST',				'Хост:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'Член:');
define('_NOTIFY_TITLE',				'Заголовок:');
define('_NOTIFY_CONTENTS',			'Содержание:');

// member mail message
define('_MMAIL_MSG',				'Сообщение послано вам от');
define('_MMAIL_FROMANON',			'анонимного пользователя');
define('_MMAIL_FROMNUC',			'Написано в  блоге');
define('_MMAIL_TITLE',				'Сообщение от');
define('_MMAIL_MAIL',				'Сообщение:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'Добавить запись');
define('_BMLET_EDIT',				'Сохранить');
define('_BMLET_DELETE',				'Удалить');
define('_BMLET_BODY',				'Текст');
define('_BMLET_MORE',				'Добавочный текст');
define('_BMLET_OPTIONS',			'Опции');
define('_BMLET_PREVIEW',			'Предпросмотр');

// used in bookmarklet
define('_ITEM_UPDATED',				'Запись сохранена.');
define('_ITEM_DELETED',				'Запись удалена.');

// plugins
define('_CONFIRMTXT_PLUGIN',		'Вы действительно хотите удалить плагин ');
define('_ERROR_NOSUCHPLUGIN',		'Нет такого плагина');
define('_ERROR_DUPPLUGIN',			'Извините, этот плагин уже установлен');
define('_ERROR_PLUGFILEERROR',		'Плагина не существует, или неправельно установлены права доступа');
define('_PLUGS_NOCANDIDATES',		'Не найдены плагины для установки');

define('_PLUGS_TITLE_MANAGE',		'Управление плагинами');
define('_PLUGS_TITLE_INSTALLED',	'Установленные плагины');
define('_PLUGS_TITLE_UPDATE',		'Обновить версии плагинов');
define('_PLUGS_TEXT_UPDATE',		'Когда вы модернизируете плагин заменой его файла, вы должны запустить это обновление');
define('_PLUGS_TITLE_NEW',			'Установить новый плагин');
define('_PLUGS_ADD_TEXT',			'Список файлов в директории плагинов, которые могут быть неустановленными плагинами. Перед установкой убедитесь, что файл <strong>на самом деле</strong> является плагином.');
define('_PLUGS_BTN_INSTALL',		'Установить плагин');
define('_BACKTOOVERVIEW',			'Назад к списку плагинов');

// editlink
define('_TEMPLATE_EDITLINK',		'Редактировать ссылку на запись');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'Текст на полях слева');
define('_ADD_RIGHT_TT',				'Текст на полях справа');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'НОВАЯ КАТЕГОРИЯ');

// new settings
define('_SETTINGS_PLUGINURL',		'URL плагина');
define('_SETTINGS_MAXUPLOADSIZE',	'Максимальный размер закачиваемого файла (в байтах)');
define('_SETTINGS_NONMEMBERMSGS',	'Разрешить незарегистрированным пользователям отправлять сообщения');
define('_SETTINGS_PROTECTMEMNAMES',	'Защищать имена зарегистрированных пользователей');

// overview screen
define('_OVERVIEW_PLUGINS',			'Управление плагинами...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'Регистрация нового пользователя:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'Ваш email:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'У вас нет привилегий администратора ни в одном из журналов, членом которых является указанный пользователь. Поэтому вы не можете закачивать файлы в директорию этого пользователя.');

// plugin list
define('_LISTS_INFO',				'Информация');
define('_LIST_PLUGS_AUTHOR',		'Автор:');
define('_LIST_PLUGS_VER',			'Версия:');
define('_LIST_PLUGS_SITE',			'Посетить сайт:');
define('_LIST_PLUGS_DESC',			'Описание:');
define('_LIST_PLUGS_SUBS',			'Использует события:');
define('_LIST_PLUGS_UP',			'сдвинуть вверх');
define('_LIST_PLUGS_DOWN',			'сдвинуть вниз');
define('_LIST_PLUGS_UNINSTALL',		'удалить');
define('_LIST_PLUGS_ADMIN',			'администратор');
define('_LIST_PLUGS_OPTIONS',		'настройки');

// plugin option list
define('_LISTS_VALUE',				'Значение');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'у этого плагина нет опций');
define('_PLUGS_BACK',				'Назад к списку плагинов');
define('_PLUGS_SAVE',				'Сохранить настройки');
define('_PLUGS_OPTIONS_UPDATED',	'Настройки сохранены');

define('_OVERVIEW_MANAGEMENT',		'Управление');
define('_OVERVIEW_MANAGE',			'Управление движком Nucleus...');
define('_MANAGE_GENERAL',			'Общее управление');
define('_MANAGE_SKINS',				'Скины и шаблоны');
define('_MANAGE_EXTRA',				'Дополнительные возможности');

define('_BACKTOMANAGE',				'Назад к управлению движком Nucleus');


// END introduced after v1.1 END




// charset to use 
define('_CHARSET',					'Windows-1251');

// global stuff
define('_LOGOUT',					'Выйти');
define('_LOGIN',					'Войти');
define('_YES',						'Да');
define('_NO',						'Нет');
define('_SUBMIT',					'Сохранение');
define('_ERROR',					'Ошибка');
define('_ERRORMSG',					'Произошла ошибка!');
define('_BACK',						'Вернуться назад');
define('_NOTLOGGEDIN',				'Вы не вошли в систему.');
define('_LOGGEDINAS',				'Вы вошли как ');
define('_ADMINHOME',				'Управление');
define('_NAME',						'Имя');
define('_BACKHOME',					'Вернуться к управлению');
define('_BADACTION',				'Затребовано несуществующее действие');
define('_MESSAGE',					'Сообщение');
define('_HELP_TT',					'Помощь');
define('_YOURSITE',					'Ваш сайт');


define('_POPUP_CLOSE',				'Закрыть окно');

define('_LOGIN_PLEASE',				'Сначала вы должны войти в систему.');

// commentform
define('_COMMENTFORM_YOUARE',		'Ваше имя - ');
define('_COMMENTFORM_SUBMIT',		'Добавить комментарий');
define('_COMMENTFORM_COMMENT',		'Ваш комментарий');
define('_COMMENTFORM_NAME',			'Имя');
define('_COMMENTFORM_MAIL',			'E-mail/HTTP');
define('_COMMENTFORM_REMEMBER',		'Запомнить вас');

// loginform
define('_LOGINFORM_NAME',			'Имя');
define('_LOGINFORM_PWD',			'Пароль');
define('_LOGINFORM_YOUARE',			'Ваше имя:');
define('_LOGINFORM_SHARED',			'Чужой компьютер');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'Послать сообщение');

// search form
define('_SEARCHFORM_SUBMIT',		'Искать');

// add item form
define('_ADD_ADDTO',				'Добавить запись в ');
define('_ADD_CREATENEW',			'Создать запись');
define('_ADD_BODY',					'Текст');
define('_ADD_TITLE',				'Заголовок');
define('_ADD_MORE',					'Добавочный текст (опционально)');
define('_ADD_CATEGORY',				'Категория');
define('_ADD_PREVIEW',				'Предпросмотр');
define('_ADD_DISABLE_COMMENTS',		'Запретить комментарии?');
define('_ADD_DRAFTNFUTURE',			'Черновики и отложенные записи');
define('_ADD_ADDITEM',				'Добавить запись');
define('_ADD_ADDNOW',				'Добавить сейчас');
define('_ADD_ADDLATER',				'Добавить позже');
define('_ADD_PLACE_ON',				'Дата добавления');
define('_ADD_ADDDRAFT',				'Сохранить как черновик');
define('_ADD_NOPASTDATES',			'(если указать время в прошлом, будет использовано текущее время)');
define('_ADD_BOLD_TT',				'Жирный');
define('_ADD_ITALIC_TT',			'Курсив');
define('_ADD_HREF_TT',				'Гиперссылка');
define('_ADD_MEDIA_TT',				'Добавить медиа-файл');
define('_ADD_PREVIEW_TT',			'Показать/скрыть предпросмотр');
define('_ADD_CUT_TT',				'Вырезать');
define('_ADD_COPY_TT',				'Копировать');
define('_ADD_PASTE_TT',				'Вставить');


// edit item form
define('_EDIT_ITEM',				'Править запись');
define('_EDIT_SUBMIT',				'Сохранить изменения');
define('_EDIT_ORIG_AUTHOR',			'Автор оригинала');
define('_EDIT_BACKTODRAFTS',		'Вернуть запись в черновики');
define('_EDIT_COMMENTSNOTE',		'(внимание: запрет комментариев не удалит уже оставленные комментарии)');

// used on delete screens
define('_DELETE_CONFIRM',			'Подтвердите удаление');
define('_DELETE_CONFIRM_BTN',		'Подтвердить');
define('_CONFIRMTXT_ITEM',			'Вы собираетесь удалить следующую запись:');
define('_CONFIRMTXT_COMMENT',		'Вы собираетесь удалить следующий комментарий:');
define('_CONFIRMTXT_TEAM1',			'Вы собираетесь удалить ');
define('_CONFIRMTXT_TEAM2',			' из редакции журнала ');
define('_CONFIRMTXT_BLOG',			'Журнал, который вы хотите удалить: ');
define('_WARNINGTXT_BLOGDEL',		'Внимание! Удаление журнала повлечет удаление ВСЕХ его записей и оставленных комментариев. Убедитесь, что вы УВЕРЕНЫ в том, что хотите удалить журнал!<br />Кроме того, не прерывайте процесс удаления журнала: он может занять некоторое время.');
define('_CONFIRMTXT_MEMBER',		'Вы собираетесь удалить профиль пользователя: ');
define('_CONFIRMTXT_TEMPLATE',		'Вы собираетесь удалить шаблон ');
define('_CONFIRMTXT_SKIN',			'Вы собираетесь удалить скин ');
define('_CONFIRMTXT_BAN',			'Вы собираетесь удалить бан для диапазона IP-адресов ');
define('_CONFIRMTXT_CATEGORY',		'Вы собираетесь удалить категорию ');

// some status messages
define('_DELETED_ITEM',				'Запись удалена');
define('_DELETED_MEMBER',			'Пользователь удален');
define('_DELETED_COMMENT',			'Комментарий удален');
define('_DELETED_BLOG',				'Журнал удален');
define('_DELETED_CATEGORY',			'Категория удалена');
define('_ITEM_MOVED',				'Запись перемещена');
define('_ITEM_ADDED',				'Запись добавлена');
define('_COMMENT_UPDATED',			'Комментарий обновлен');
define('_SKIN_UPDATED',				'Скин обновлен');
define('_TEMPLATE_UPDATED',			'Шаблон обновлен');

// errors
define('_ERROR_COMMENT_LONGWORD',	'Не используйте в комментариях слова длиннее 90 символов');
define('_ERROR_COMMENT_NOCOMMENT',	'Введите текст комментария');
define('_ERROR_COMMENT_NOUSERNAME',	'Плохое имя пользователя');
define('_ERROR_COMMENT_TOOLONG',	'Слишком длинный комментарий (максимальная длина - 5000 символов)');
define('_ERROR_COMMENTS_DISABLED',	'Комментарии к этому журналу в данный момент запрещены.');
define('_ERROR_COMMENTS_NONPUBLIC',	'Вы должны войти как зарегистрированный пользователь, чтобы оставлять комментарии к этому журналу.');
define('_ERROR_COMMENTS_MEMBERNICK','Имя, которым вы хотите подписаться, принадлежит зарегистрированному пользователю. Выберите другое имя.');
define('_ERROR_SKIN',				'Ошибка скина');
define('_ERROR_ITEMCLOSED',			'Запись заблокирована: больше нельзя комментировать ее или изменять ее рейтинг.');
define('_ERROR_NOSUCHITEM',			'Такой записи не существует');
define('_ERROR_NOSUCHBLOG',			'Такого журнала не существует');
define('_ERROR_NOSUCHSKIN',			'Такого скина не существует');
define('_ERROR_NOSUCHMEMBER',		'Такого пользователя не существует');
define('_ERROR_NOTONTEAM',			'Вы не являетесь членом редакции этого журнала.');
define('_ERROR_BADDESTBLOG',		'Указанный журнал не существует.');
define('_ERROR_NOTONDESTTEAM',		'Невозможно переместить запись, поскольку вы не являетесь членом редакции указанного журнала.');
define('_ERROR_NOEMPTYITEMS',		'Нельзя добавлять пустые записи!');
define('_ERROR_BADMAILADDRESS',		'Неверный адрес электронной почты');
define('_ERROR_BADNOTIFY',			'Один или несколько e-mail адресов уведомления введены некорректно');
define('_ERROR_BADNAME',			'Неправильное имя (имя должно содержать только буквы a-z, A-Z и цифры, пробелы не допускаются)');
define('_ERROR_NICKNAMEINUSE',		'Имя уже занято другим пользователем');
define('_ERROR_PASSWORDMISMATCH',	'Пароли должны совпадать');
define('_ERROR_PASSWORDTOOSHORT',	'Пароль должен быть длиннее 5 символов');
define('_ERROR_PASSWORDMISSING',	'Отсутствует пароль');
define('_ERROR_REALNAMEMISSING',	'Отсутствует настоящее имя');
define('_ERROR_ATLEASTONEADMIN',	'Всегда должен быть хотя бы один супер-администратор, который может входить в режим управления.');
define('_ERROR_ATLEASTONEBLOGADMIN','Это действие оставит ваш журнал неуправляемым. Убедитесь, что среди пользователей есть хотя бы один администратор.');
define('_ERROR_ALREADYONTEAM',		'Указанный пользователь уже является членом редакции.');
define('_ERROR_BADSHORTBLOGNAME',	'Короткое имя журнала должно состоять только из букв a-z и цифр, без пробелов');
define('_ERROR_DUPSHORTBLOGNAME',	'Это короткое имя уже занято другим журналом');
define('_ERROR_UPDATEFILE',			'Не удается получить доступ на запись файла. Убедитесь, что права установлены правильно (попробуйте команду chmod 666). Также учтите, что пути указываются относительно администраторского каталога, поэтому вам может понадобиться использовать абсолютный путь (что-то наподобие /your/path/to/nucleus/)');
define('_ERROR_DELDEFBLOG',			'Нельзя удалить журнал, выбранный для показа по умолчанию');
define('_ERROR_DELETEMEMBER',		'Пользователь не может быть удален - возможно, потому, что он является автором записей или комментариев');
define('_ERROR_BADTEMPLATENAME',	'Неверное имя шаблона - используйте только буквы a-z и цифры');
define('_ERROR_DUPTEMPLATENAME',	'Шаблон с таким именем уже существует');
define('_ERROR_BADSKINNAME',		'Неверное имя скина - используйте только буквы a-z и цифры');
define('_ERROR_DUPSKINNAME',		'Скин с таким именем уже существует');
define('_ERROR_DEFAULTSKIN',		'Скин с именем "default" должен существовать всегда');
define('_ERROR_SKINDEFDELETE',		'Не удалось удалить скин - он выбран скином по умолчанию в следующем журнале: ');
define('_ERROR_DISALLOWED',			'У вас нет прав для совершения этого действия');
define('_ERROR_DELETEBAN',			'Ошибка при попытке удалить бан (бан не существует)');
define('_ERROR_ADDBAN',				'Ошибка при попытке добавить бан. Бан не можен быть корректно установлен на все журналы.');
define('_ERROR_BADACTION',			'Требуемое действие не существует');
define('_ERROR_MEMBERMAILDISABLED',	'Служба обмена личными сообщениями отключена');
define('_ERROR_MEMBERCREATEDISABLED','Создание учетной записи пользователя отключено');
define('_ERROR_INCORRECTEMAIL',		'Неправильный почтовый адрес');
define('_ERROR_VOTEDBEFORE',		'Вы уже проголосовали за эту запись');
define('_ERROR_BANNED1',			'Не удалось произвести выбранное действие, поскольку ваш IP-адрес принадлежит диапазону ');
define('_ERROR_BANNED2',			' и является забаненным. Сообщение: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'Вы должны войти как пользователь, чтобы произвести выбранное действие');
define('_ERROR_CONNECT',			'Ошибка соединения');
define('_ERROR_FILE_TOO_BIG',		'Слишком большой файл!');
define('_ERROR_BADFILETYPE',		'Файлы этого типа не разрешается закачивать');
define('_ERROR_BADREQUEST',			'Плохой запрос на закачку');
define('_ERROR_DISALLOWEDUPLOAD',	'Вы не входите в редакцию ни одного журнала, поэтому вам нельзя закачивать файлы');
define('_ERROR_BADPERMISSIONS',		'Права на файл/папку установлены некорректно');
define('_ERROR_UPLOADMOVEP',		'Ошибка при попытке перемещения закачанного файла');
define('_ERROR_UPLOADCOPY',			'Ошибка при попытке копирования файла');
define('_ERROR_UPLOADDUPLICATE',	'Файл с таким именем уже существует. Попробуйте переименовать файл перед закачкой');
define('_ERROR_LOGINDISALLOWED',	'К сожалению, вам не разрешено входить в область управления. Попробуйте войти под именем другого пользователя');
define('_ERROR_DBCONNECT',			'Не удалось подключиться к серверу mySQL');
define('_ERROR_DBSELECT',			'Не удается выбрать базу данных Nucleus. Возможно, ее не существует');
define('_ERROR_NOSUCHLANGUAGE',		'Файл поддержки такого языка не найден');
define('_ERROR_NOSUCHCATEGORY',		'Не существует такой категории');
define('_ERROR_DELETELASTCATEGORY',	'В журнале должна быть хотя бы одна категория');
define('_ERROR_DELETEDEFCATEGORY',	'Нельзя удалить категорию, установленную по умолчанию');
define('_ERROR_BADCATEGORYNAME',	'Плохое имя категории');
define('_ERROR_DUPCATEGORYNAME',	'Категория с таким именем уже существует');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'Внимание! Текущее значение не является директорией!');
define('_WARNING_NOTREADABLE',		'Внимание! Текущее значения является директорией, закрытой для чтения!');
define('_WARNING_NOTWRITABLE',		'Внимание! Текущее значение является категорией, закрытой для записи!');

// media and upload
define('_MEDIA_UPLOADLINK',			'Закачать новый файл');
define('_MEDIA_MODIFIED',			'изменен');
define('_MEDIA_FILENAME',			'имя файла');
define('_MEDIA_DIMENSIONS',			'размеры');
define('_MEDIA_INLINE',				'Показывать внутри записи');
define('_MEDIA_POPUP',				'Показывать в отдельном окне');
define('_UPLOAD_TITLE',				'Выберите файл');
define('_UPLOAD_MSG',				'Выберите файл, который вы хотите закачать, и нажмите кнопку \'Закачать\'.');
define('_UPLOAD_BUTTON',			'Закачать');

// some status messages
define('_MSG_ACCOUNTCREATED',		'Учетная запись пользователя создана, пароль будет выслан вам по электронной почте');
define('_MSG_PASSWORDSENT',			'Пароль был выслан по электронной почте.');
define('_MSG_LOGINAGAIN',			'Вы должны войти заново, потому что ваши настройки были изменены');
define('_MSG_SETTINGSCHANGED',		'Настройки изменены');
define('_MSG_ADMINCHANGED',			'Администратор изменен');
define('_MSG_NEWBLOG',				'Создан новый журнал');
define('_MSG_ACTIONLOGCLEARED',		'Отчет о действиях очищен');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'Недопустимое действие: ');
define('_ACTIONLOG_PWDREMINDERSENT','Новый пароль отослан пользователю ');
define('_ACTIONLOG_TITLE',			'Отчет о действиях');
define('_ACTIONLOG_CLEAR_TITLE',	'Очистка отчета о действиях');
define('_ACTIONLOG_CLEAR_TEXT',		'Очистить отчет о действиях');

// team management
define('_TEAM_TITLE',				'Управление редакцией журнала ');
define('_TEAM_CURRENT',				'Текущий состав редакции');
define('_TEAM_ADDNEW',				'Добавить пользователя в редакцию');
define('_TEAM_CHOOSEMEMBER',		'Выбрать пользователя');
define('_TEAM_ADMIN',				'Дать привилегии администратора? ');
define('_TEAM_ADD',					'Добавление пользователя в редакцию');
define('_TEAM_ADD_BTN',				'Добавить пользователя');

// blogsettings
define('_EBLOG_TITLE',				'Изменение настроек журнала');
define('_EBLOG_TEAM_TITLE',			'Состав редакции');
define('_EBLOG_TEAM_TEXT',			'Щелкните здесь, чтобы поменять состав редакции...');
define('_EBLOG_SETTINGS_TITLE',		'Настройки журнала');
define('_EBLOG_NAME',				'Название журнала');
define('_EBLOG_SHORTNAME',			'Короткое имя журнала');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(должно состоять только из букв a-z)');
define('_EBLOG_DESC',				'Описание журнала');
define('_EBLOG_URL',				'URL журнала');
define('_EBLOG_DEFSKIN',			'Скин по умолчанию');
define('_EBLOG_DEFCAT',				'Категория по умолчанию');
define('_EBLOG_LINEBREAKS',			'Преобразовывать переводы строки');
define('_EBLOG_DISABLECOMMENTS',	'Разрешить комментарии?<br /><small>(Если не разрешить комментарии, посетители не смогут комментировать записи.)</small>');
define('_EBLOG_ANONYMOUS',			'Разрешить комментарии незарегистрированным пользователям?');
define('_EBLOG_NOTIFY',				'Адрес(а) уведомления (используйте ; для разделения)');
define('_EBLOG_NOTIFY_ON',			'Уведомлять о');
define('_EBLOG_NOTIFY_COMMENT',		'Новых комментариях');
define('_EBLOG_NOTIFY_KARMA',		'Новых рейтинговых голосах');
define('_EBLOG_NOTIFY_ITEM',		'Новых записях');
define('_EBLOG_PING',				'Пинговать Weblogs.com при обновлениях?');
define('_EBLOG_MAXCOMMENTS',		'Максимальное число комментариев');
define('_EBLOG_UPDATE',				'Имя файла со временем обновлений (необязательно)');
define('_EBLOG_OFFSET',				'Сдвиг времени');
define('_EBLOG_STIME',				'Текущее время сервера');
define('_EBLOG_BTIME',				'Текущее время журнала');
define('_EBLOG_CHANGE',				'Изменение настроек');
define('_EBLOG_CHANGE_BTN',			'Изменить настройки');
define('_EBLOG_ADMIN',				'Администратор журнала');
define('_EBLOG_ADMIN_MSG',			'Вы получите привилегии администратора');
define('_EBLOG_CREATE_TITLE',		'Создание нового журнала');
define('_EBLOG_CREATE_TEXT',		'Заполните форму, чтобы создать новый журнал. <br /><br /> <b>Учтите:</b> здесь перечислены только необходимые параметры. Чтобы отредактиорвать остальные, измените настройки журнала после его создания.');
define('_EBLOG_CREATE',				'Создать!');
define('_EBLOG_CREATE_BTN',			'Создать журнал');
define('_EBLOG_CAT_TITLE',			'Категории');
define('_EBLOG_CAT_NAME',			'Имя категории');
define('_EBLOG_CAT_DESC',			'Описание категории');
define('_EBLOG_CAT_CREATE',			'Создать новую категорию');
define('_EBLOG_CAT_UPDATE',			'Сохранить категорию');
define('_EBLOG_CAT_UPDATE_BTN',		'Сохранить');

// templates
define('_TEMPLATE_TITLE',			'Редактировать шаблоны');
define('_TEMPLATE_AVAILABLE_TITLE',	'Доступные шаблоны');
define('_TEMPLATE_NEW_TITLE',		'Новый шаблон');
define('_TEMPLATE_NAME',			'Имя шаблона');
define('_TEMPLATE_DESC',			'Описание шаблона');
define('_TEMPLATE_CREATE',			'Создать новый шаблон');
define('_TEMPLATE_CREATE_BTN',		'Создать шаблон');
define('_TEMPLATE_EDIT_TITLE',		'Редактирование шаблона');
define('_TEMPLATE_BACK',			'Назад к списку шаблонов');
define('_TEMPLATE_EDIT_MSG',		'Не все части шаблона необходимы - оставьте ненужные пустыми.');
define('_TEMPLATE_SETTINGS',		'Параметры шаблона');
define('_TEMPLATE_ITEMS',			'Записи');
define('_TEMPLATE_ITEMHEADER',		'Заголовок записи');
define('_TEMPLATE_ITEMBODY',		'Текст записи');
define('_TEMPLATE_ITEMFOOTER',		'Подвал записи');
define('_TEMPLATE_MORELINK',		'Ссылка на добавочный текст');
define('_TEMPLATE_NEW',				'Индикация новой записи');
define('_TEMPLATE_COMMENTS_ANY',	'Комментарии (если есть)');
define('_TEMPLATE_CHEADER',			'Заголовок комемнтария');
define('_TEMPLATE_CBODY',			'Тело комментария');
define('_TEMPLATE_CFOOTER',			'Подвал комментария');
define('_TEMPLATE_CONE',			'Один комментарий');
define('_TEMPLATE_CMANY',			'Два и больше комментариев');
define('_TEMPLATE_CMORE',			'Читать комментарии дальше');
define('_TEMPLATE_CMEXTRA',			'Индикация авторского комментария');
define('_TEMPLATE_COMMENTS_NONE',	'Комментарии (если есть)');
define('_TEMPLATE_CNONE',			'Нет комментариев');
define('_TEMPLATE_COMMENTS_TOOMUCH','Комментарии (есть, но слишком много, чтобы отображать вместе с текстом)');
define('_TEMPLATE_CTOOMUCH',		'Слишком много сомментариев');
define('_TEMPLATE_ARCHIVELIST',		'Архивные списки');
define('_TEMPLATE_AHEADER',			'Заголовок архивного списка');
define('_TEMPLATE_AITEM',			'Элемент архивного списка');
define('_TEMPLATE_AFOOTER',			'Подвал архивного списка');
define('_TEMPLATE_DATETIME',		'Дата и время');
define('_TEMPLATE_DHEADER',			'Заголовок даты');
define('_TEMPLATE_DFOOTER',			'Подвал даты');
define('_TEMPLATE_DFORMAT',			'Формат даты');
define('_TEMPLATE_TFORMAT',			'Формат времени');
define('_TEMPLATE_LOCALE',			'Локаль');
define('_TEMPLATE_IMAGE',			'Изображения в новом окне');
define('_TEMPLATE_PCODE',			'Ссылка на окно с изображением');
define('_TEMPLATE_ICODE',			'Код изображения в тексте');
define('_TEMPLATE_MCODE',			'Код ссылки на медиа-файл');
define('_TEMPLATE_SEARCH',			'Поиск');
define('_TEMPLATE_SHIGHLIGHT',		'Подсветка');
define('_TEMPLATE_SNOTFOUND',		'Поиск не дал результатов');
define('_TEMPLATE_UPDATE',			'Сохранение');
define('_TEMPLATE_UPDATE_BTN',		'Сохранить шаблон');
define('_TEMPLATE_RESET_BTN',		'Сбросить изменения');
define('_TEMPLATE_CATEGORYLIST',	'Списки категорий');
define('_TEMPLATE_CATHEADER',		'Заголовок списка категорий');
define('_TEMPLATE_CATITEM',			'Элемент списка категорий');
define('_TEMPLATE_CATFOOTER',		'Подвал списка категорий');

// skins
define('_SKIN_EDIT_TITLE',			'Редактирование скинов');
define('_SKIN_AVAILABLE_TITLE',		'Доступные скины');
define('_SKIN_NEW_TITLE',			'Новый скин');
define('_SKIN_NAME',				'Имя');
define('_SKIN_DESC',				'Описание');
define('_SKIN_TYPE',				'Тип содержимого');
define('_SKIN_CREATE',				'Создание');
define('_SKIN_CREATE_BTN',			'Создать скин');
define('_SKIN_EDITONE_TITLE',		'Редактирование скина');
define('_SKIN_BACK',				'Назад к списку скинов');
define('_SKIN_PARTS_TITLE',			'Части скина');
define('_SKIN_PARTS_MSG',			'Не все части нужны каждому скину. Оставьте ненужные пустыми. Выберите тип скина для редактирования:');
define('_SKIN_PART_MAIN',			'Главная страница');
define('_SKIN_PART_ITEM',			'Страница записи');
define('_SKIN_PART_ALIST',			'Архивный список');
define('_SKIN_PART_ARCHIVE',		'Архив');
define('_SKIN_PART_SEARCH',			'Поиск');
define('_SKIN_PART_ERROR',			'Ошибки');
define('_SKIN_PART_MEMBER',			'Информация о пользователе');
define('_SKIN_PART_POPUP',			'Изображения в новом окне');
define('_SKIN_GENSETTINGS_TITLE',	'Общие настройки');
define('_SKIN_CHANGE',				'Сохранение');
define('_SKIN_CHANGE_BTN',			'Сохранить настройки');
define('_SKIN_UPDATE_BTN',			'Сохранить скин');
define('_SKIN_RESET_BTN',			'Сбросить изменения');
define('_SKIN_EDITPART_TITLE',		'Редактирование скина');
define('_SKIN_GOBACK',				'Назад');
define('_SKIN_ALLOWEDVARS',			'Доступные переменные (щелкните для получения подсказки):');

// global settings
define('_SETTINGS_TITLE',			'Общие настройки');
define('_SETTINGS_SUB_GENERAL',		'Общие настройки');
define('_SETTINGS_DEFBLOG',			'Журнал по умолчанию');
define('_SETTINGS_ADMINMAIL',		'E-Mail администратора');
define('_SETTINGS_SITENAME',		'Имя сайта');
define('_SETTINGS_SITEURL',			'URL сайта (должен оканчиваться слэшем)');
define('_SETTINGS_ADMINURL',		'URL области управления (должен оканчиваться слэшем)');
define('_SETTINGS_DIRS',			'Директория движка Nucleus');
define('_SETTINGS_MEDIADIR',		'Директория для закачки файлов');
define('_SETTINGS_SEECONFIGPHP',	'(смотри config.php)');
define('_SETTINGS_MEDIAURL',		'URL медиа-файлов (должен оканчиваться слэшем)');
define('_SETTINGS_ALLOWUPLOAD',		'Разрешить закачку файлов?');
define('_SETTINGS_ALLOWUPLOADTYPES','Разрешенные для закачки типы файлов');
define('_SETTINGS_CHANGELOGIN',		'Разрешить пользователям менять логин/пароль');
define('_SETTINGS_COOKIES_TITLE',	'Настройки куков');
define('_SETTINGS_COOKIELIFE',		'Время жизни логина в куках');
define('_SETTINGS_COOKIESESSION',	'Куки сессии');
define('_SETTINGS_COOKIEMONTH',		'Время жизни месяца');
define('_SETTINGS_COOKIEPATH',		'Путь к кукам (дополнительно)');
define('_SETTINGS_COOKIEDOMAIN',	'Домен куков (дополнительно)');
define('_SETTINGS_COOKIESECURE',	'Обезопасить куки (дополнительно)');
define('_SETTINGS_LASTVISIT',		'Сохранять куки последнего посещения');
define('_SETTINGS_ALLOWCREATE',		'Разрешить посетителям регистрироваться');
define('_SETTINGS_NEWLOGIN',		'Разрешить вход пользователям, созданным посетителями');
define('_SETTINGS_NEWLOGIN2',		'(только для новых учетных записей)');
define('_SETTINGS_MEMBERMSGS',		'Разрешить обмен частными сообщениями');
define('_SETTINGS_LANGUAGE',		'Язык по умолчанию');
define('_SETTINGS_DISABLESITE',		'Отключить сайт');
define('_SETTINGS_DBLOGIN',			'Логин и база данных mySQL');
define('_SETTINGS_UPDATE',			'Сохранение настроек');
define('_SETTINGS_UPDATE_BTN',		'Сохранить настройки');
define('_SETTINGS_DISABLEJS',		'Отключить панель управления JavaScript');
define('_SETTINGS_MEDIA',			'Настройки закачки медиа-файлов');
define('_SETTINGS_MEDIAPREFIX',		'Добавлять дату к именам закачанных файлов');
define('_SETTINGS_MEMBERS',			'Настройки пользователей');

// bans
define('_BAN_TITLE',				'Бан-лист для');
define('_BAN_NONE',					'Для этого журнала нет банов');
define('_BAN_NEW_TITLE',			'Добавление бана');
define('_BAN_NEW_TEXT',				'Добавить бан');		   
define('_BAN_REMOVE_TITLE',			'Снятие бана');
define('_BAN_IPRANGE',				'Диапазон IP-адресов');
define('_BAN_BLOGS',				'Какие журналы?');
define('_BAN_DELETE_TITLE',			'Удаление бана');
define('_BAN_ALLBLOGS',				'Все журналы, в которых у вас есть привилеги администратора.');
define('_BAN_REMOVED_TITLE',		'Бан снят');
define('_BAN_REMOVED_TEXT',			'Бан снят для следующих журналов:');
define('_BAN_ADD_TITLE',			'Добавление бана');
define('_BAN_IPRANGE_TEXT',			'Укажите диапазон IP-адресов для блокирования. Чем меньше в нем чисел, тем больше адресов будет блокировано');
define('_BAN_BLOGS_TEXT',			'Можно забанить IP-адрес только в одном журнале или сразу во всех, где у вас есть привилегии администратора.');
define('_BAN_REASON_TITLE',			'Причина');
define('_BAN_REASON_TEXT',			'Вы можете указать причину бана, которая будет отображаться при попытке оставить комментарий или изменить рейтинг записи. Максимальная длина - 256 символов.');
define('_BAN_ADD_BTN',				'Добавить бан');

// LOGIN screen
define('_LOGIN_MESSAGE',			'Сообщение');
define('_LOGIN_NAME',				'Имя');
define('_LOGIN_PASSWORD',			'Пароль');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'Забыли пароль?');

// membermanagement
define('_MEMBERS_TITLE',			'Управление пользователями');
define('_MEMBERS_CURRENT',			'Текущие пользователи');
define('_MEMBERS_NEW',				'Новый пользователь');
define('_MEMBERS_DISPLAY',			'Отображаемое имя');
define('_MEMBERS_DISPLAY_INFO',		'(оно используется для входа)');
define('_MEMBERS_REALNAME',			'Настоящее имя');
define('_MEMBERS_PWD',				'Пароль');
define('_MEMBERS_REPPWD',			'Введите пароль еще раз');
define('_MEMBERS_EMAIL',			'E-Mail');
define('_MEMBERS_EMAIL_EDIT',		'(когда вы измените этот адрес, пароль автоматически будет выслан на новый адрес)');
define('_MEMBERS_URL',				'URL сайта');
define('_MEMBERS_SUPERADMIN',		'Привилегии администратора');
define('_MEMBERS_CANLOGIN',			'Может входить в область управления');
define('_MEMBERS_NOTES',			'Примечания');
define('_MEMBERS_NEW_BTN',			'Добавить пользователя');
define('_MEMBERS_EDIT',				'Редактировать пользователя');
define('_MEMBERS_EDIT_BTN',			'Изменить настройки');
define('_MEMBERS_BACKTOOVERVIEW',	'Назад к списку пользователей');
define('_MEMBERS_DEFLANG',			'Язык');
define('_MEMBERS_USESITELANG',		'- использовать настройки сайта -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'Перейти на сайт');
define('_BLOGLIST_ADD',				'Добавить запись');
define('_BLOGLIST_TT_ADD',			'Добавить новую запись в журнал');
define('_BLOGLIST_EDIT',			'Править/удалять записи');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Закладки');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'Настройки');
define('_BLOGLIST_TT_SETTINGS',		'Изменить настройки и состав редакции журнала');
define('_BLOGLIST_BANS',			'Баны');
define('_BLOGLIST_TT_BANS',			'Просмотреть, добавить или удалить забаненные IP-адреса');
define('_BLOGLIST_DELETE',			'Удалить');
define('_BLOGLIST_TT_DELETE',		'Удалить журнал');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'Ваши журналы');
define('_OVERVIEW_YRDRAFTS',		'Ваши черновики');
define('_OVERVIEW_YRSETTINGS',		'Личные настройки');
define('_OVERVIEW_GSETTINGS',		'Общие настройки');
define('_OVERVIEW_NOBLOGS',			'Вы не входите в редакцию ни одного журнала');
define('_OVERVIEW_NODRAFTS',		'Нет черновиков');
define('_OVERVIEW_EDITSETTINGS',	'Редактировать личные настройки...');
define('_OVERVIEW_BROWSEITEMS',		'Просмотреть ваши записи...');
define('_OVERVIEW_BROWSECOMM',		'Просмотреть ваши комментарии...');
define('_OVERVIEW_VIEWLOG',			'Просмотреть отчет о действиях...');
define('_OVERVIEW_MEMBERS',			'Управление пользователями...');
define('_OVERVIEW_NEWLOG',			'Создание нового журнала...');
define('_OVERVIEW_SETTINGS',		'Редактировать настройки...');
define('_OVERVIEW_TEMPLATES',		'Редактировать шаблоны...');
define('_OVERVIEW_SKINS',			'Редактировать скины...');
define('_OVERVIEW_BACKUP',			'Сохранить/восстановить базу данных...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'Записи журнала'); 
define('_ITEMLIST_YOUR',			'Ваши записи');

// Comments
define('_COMMENTS',					'Комментарии');
define('_NOCOMMENTS',				'Нет комментариев к этой записи');
define('_COMMENTS_YOUR',			'Ваши комментарии');
define('_NOCOMMENTS_YOUR',			'Вы не оставляли никаких комментариев');

// LISTS (general)
define('_LISTS_NOMORE',				'Нет больше результатов, или вообще нет результатов');
define('_LISTS_PREV',				'Предыдущий');
define('_LISTS_NEXT',				'Следующий');
define('_LISTS_SEARCH',				'Поиск');
define('_LISTS_CHANGE',				'Изменить');
define('_LISTS_PERPAGE',			'Записей на странице');
define('_LISTS_ACTIONS',			'Действия');
define('_LISTS_DELETE',				'Удалить');
define('_LISTS_EDIT',				'Правка');
define('_LISTS_MOVE',				'Переместить');
define('_LISTS_CLONE',				'Клонировать');
define('_LISTS_TITLE',				'Заголовок');
define('_LISTS_BLOG',				'Журнал');
define('_LISTS_NAME',				'Имя');
define('_LISTS_DESC',				'Описание');
define('_LISTS_TIME',				'Время');
define('_LISTS_COMMENTS',			'Комментарии');
define('_LISTS_TYPE',				'Тип');


// member list 
define('_LIST_MEMBER_NAME',			'Отображаемое имя');
define('_LIST_MEMBER_RNAME',		'Настоящее имя');
define('_LIST_MEMBER_ADMIN',		'Супер-администратор? ');
define('_LIST_MEMBER_LOGIN',		'Может входить? ');
define('_LIST_MEMBER_URL',			'Вебсайт');

// banlist
define('_LIST_BAN_IPRANGE',			'Диапазон IP-адресов');
define('_LIST_BAN_REASON',			'Причина');

// actionlist
define('_LIST_ACTION_MSG',			'Сообщение');

// commentlist
define('_LIST_COMMENT_BANIP',		'Забанить IP');
define('_LIST_COMMENT_WHO',			'Автор');
define('_LIST_COMMENT',				'Комментарий');
define('_LIST_COMMENT_HOST',		'Хост');

// itemlist
define('_LIST_ITEM_INFO',			'Информация');
define('_LIST_ITEM_CONTENT',		'Заголовок и текст');


// teamlist
define('_LIST_TEAM_ADMIN',			'Администратор ');
define('_LIST_TEAM_CHADMIN',		'Дать/отобрать права администратора');

// edit comments
define('_EDITC_TITLE',				'Редактирование комментариев');
define('_EDITC_WHO',				'Автор');
define('_EDITC_HOST',				'Откуда?');
define('_EDITC_WHEN',				'Когда?');
define('_EDITC_TEXT',				'Текст');
define('_EDITC_EDIT',				'Редактировать');
define('_EDITC_MEMBER',				'пользователь');
define('_EDITC_NONMEMBER',			'не пользователь');

// move item
define('_MOVE_TITLE',				'В какой журнал переместить?');
define('_MOVE_BTN',					'Переместить запись');

?>