<?
// Japanese Nucleus Language File
// 
// Author: chrome (chrome@cgi.no-ip.org)
// Nucleus version: v1.0-v2.0 (v2.0beta/January 18, 2003)
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
define('_EBLOG_ALLOWPASTPOSTING',	'�ߋ��ւ̓��e��������');
define('_ADD_CHANGEDATE',			'�^�C���X�^���v���X�V');
define('_BMLET_CHANGEDATE',			'�^�C���X�^���v���X�V');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'�X�L���� import/export...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'Normal');
define('_PARSER_INCMODE_SKINDIR',	'Use skin dir');
define('_SKIN_INCLUDE_MODE',		'Include ���[�h');
define('_SKIN_INCLUDE_PREFIX',		'Include prefix');

// global settings
define('_SETTINGS_BASESKIN',		'�x�[�X skin');
define('_SETTINGS_SKINSURL',		'�X�L��URL');
define('_SETTINGS_ACTIONSURL',		'action.php �ւ̃t��URL');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'default�J�e�S���[�͈ړ��ł��܂���');
define('_ERROR_MOVETOSELF',			'�J�e�S���[���ړ��ł��܂��� (�ړ����blog���ړ����Ɠ����ł�)');
define('_MOVECAT_TITLE',			'�J�e�S���[���ړ�����blog��I�����Ă�������');
define('_MOVECAT_BTN',				'�J�e�S���[���ړ�');

// URLMode setting
define('_SETTINGS_URLMODE',			'URL ���[�h');
define('_SETTINGS_URLMODE_NORMAL',	'Normal');
define('_SETTINGS_URLMODE_PATHINFO','Fancy');

// Batch operations
define('_BATCH_NOSELECTION',		'�Ώۂ��I������Ă��܂���');
define('_BATCH_ITEMS',				'�A�C�e���@�@�@�ɑ΂��Ẵo�b�`����');
define('_BATCH_CATEGORIES',			'�J�e�S���[�@�@�ɑ΂��Ẵo�b�`����');
define('_BATCH_MEMBERS',			'�����o�[�@�@�@�ɑ΂��Ẵo�b�`����');
define('_BATCH_TEAM',				'�`�[�������o�[�ɑ΂��Ẵo�b�`����');
define('_BATCH_COMMENTS',			'�R�����g�@�@�@�ɑ΂��Ẵo�b�`����');
define('_BATCH_UNKNOWN',			'���m�̃o�b�`����: ');
define('_BATCH_EXECUTING',			'���s��');
define('_BATCH_ONCATEGORY',			'on �J�e�S���[');
define('_BATCH_ONITEM',				'on �A�C�e��');
define('_BATCH_ONCOMMENT',			'on �R�����g');
define('_BATCH_ONMEMBER',			'on �����o�[');
define('_BATCH_ONTEAM',				'on �`�[�������o�[');
define('_BATCH_SUCCESS',			'����!');
define('_BATCH_DONE',				'�I��!');
define('_BATCH_DELETE_CONFIRM',		'�o�b�`�폜�̊m�F');
define('_BATCH_DELETE_CONFIRM_BTN',	'�o�b�`�폜�̊m�F');
define('_BATCH_SELECTALL',			'�S�đI��');
define('_BATCH_DESELECTALL',		'�S�Ă̑I��������');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'�폜');
define('_BATCH_ITEM_MOVE',			'�ړ�');
define('_BATCH_MEMBER_DELETE',		'�폜');
define('_BATCH_MEMBER_SET_ADM',		'�Ǘ��Ҍ�����^����');
define('_BATCH_MEMBER_UNSET_ADM',	'�Ǘ��Ҍ������O��');
define('_BATCH_TEAM_DELETE',		'�`�[������폜');
define('_BATCH_TEAM_SET_ADM',		'�Ǘ��Ҍ�����^����');
define('_BATCH_TEAM_UNSET_ADM',		'�Ǘ��Ҍ������O��');
define('_BATCH_CAT_DELETE',			'�폜');
define('_BATCH_CAT_MOVE',			'����blog�Ɉړ�');
define('_BATCH_COMMENT_DELETE',		'�폜');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'�V�����A�C�e���̒ǉ�...');
define('_ADD_PLUGIN_EXTRAS',		'�ǉ�Plugin�I�v�V����');

// errors
define('_ERROR_CATCREATEFAIL',		'�V�����J�e�S���[���쐬�ł��܂���');
define('_ERROR_NUCLEUSVERSIONREQ',	'���̃v���O�C���͐V�����o�[�W������ Nucleus ���K�v�ł�: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'blog�Z�b�e�B���O�ɖ߂�');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'Import');
define('_SKINIE_TITLE_EXPORT',		'Export');
define('_SKINIE_BTN_IMPORT',		'Import');
define('_SKINIE_BTN_EXPORT',		'�I�����ꂽ�X�L��/�e���v���[�g�� Export');
define('_SKINIE_LOCAL',				'���[�J���t�@�C������ Import :');
define('_SKINIE_NOCANDIDATES',		'skins�f�B���N�g������ import ��₪������܂���');
define('_SKINIE_FROMURL',			'URL ���� Import :');
define('_SKINIE_EXPORT_INTRO',		'������ export ����X�L��/�e���v���[�g��I�����Ă�������');
define('_SKINIE_EXPORT_SKINS',		'�X�L��');
define('_SKINIE_EXPORT_TEMPLATES',	'�e���v���[�g');
define('_SKINIE_EXPORT_EXTRA',		'�ǉ����');
define('_SKINIE_CONFIRM_OVERWRITE',	'���ɑ��݂���X�L�����㏑������ (nameclashes ���Q��)');
define('_SKINIE_CONFIRM_IMPORT',	'�͂��A�����import���܂�');
define('_SKINIE_CONFIRM_TITLE',		'�X�L���ƃe���v���[�g��import���悤�Ƃ��Ă��܂�');
define('_SKINIE_INFO_SKINS',		'�t�@�C�����̃X�L��:');
define('_SKINIE_INFO_TEMPLATES',	'�t�@�C�����̃e���v���[�g:');
define('_SKINIE_INFO_GENERAL',		'���:');
define('_SKINIE_INFO_SKINCLASH',	'Skin name clashes:');
define('_SKINIE_INFO_TEMPLCLASH',	'Template name clashes:');
define('_SKINIE_INFO_IMPORTEDSKINS','Import ���ꂽ�X�L��:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','Import ���ꂽ�e���v���[�g:');
define('_SKINIE_DONE',				'Import ����');

define('_AND',						'and');
define('_OR',						'or');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'����(�N���b�N�ŕҏW)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'Include���[�h:');
define('_LIST_SKINS_INCPREFIX',		'Include Prefix:');
define('_LIST_SKINS_DEFINED',		'��`�ς݃p�[�c:');

// backup
define('_BACKUPS_TITLE',			'�o�b�N�A�b�v / ���X�g�A');
define('_BACKUP_TITLE',				'�o�b�N�A�b�v');
define('_BACKUP_INTRO',				'���̃{�^���������Ƃ��Ȃ��� Nucleus �f�[�^�x�[�X���o�b�N�A�b�v���܂��B�o�b�N�A�b�v�t�@�C���͈��S�ȏꏊ�ɕۑ����Ă������Ƃ������߂��܂��B');
define('_BACKUP_ZIP_YES',			'���k����');
define('_BACKUP_ZIP_NO',			'���k���Ȃ�');
define('_BACKUP_BTN',				'�o�b�N�A�b�v���쐬����');
define('_BACKUP_NOTE',				'<b>����:</b> �o�b�N�A�b�v�����̂̓f�[�^�x�[�X�̓��e�����ł��B���f�B�A�t�@�C���� config.php ���̐ݒ�̓o�b�N�A�b�v<b>����܂���</b>�B');
define('_RESTORE_TITLE',			'���X�g�A');
define('_RESTORE_NOTE',				'<b>�x��:</b> �o�b�N�A�b�v����̃��X�g�A�͌��݂̃f�[�^�x�[�X���� Nucleus �f�[�^��S��<b>�폜</b>���܂��I�ǂ����ӂ��Ďg�p���Ă��������I	<br />	<b>����:</b> �o�b�N�A�b�v���쐬���� Nucleus �̃o�[�W������ ���ݎg�p���Ă��� Nucleus �̃o�[�W�����Ɠ������m�F���Ă��������I�����łȂ���ΐ��������삵�܂���B');
define('_RESTORE_INTRO',			'�ȉ�����o�b�N�A�b�v�t�@�C���i�T�[�o�ɃA�b�v���[�h����܂��j��I������"���X�g�A"�{�^���������ƊJ�n���܂��B');
define('_RESTORE_IMSURE',			'�͂��A�m���ɂ��̑���̎��s�����F���܂��I');
define('_RESTORE_BTN',				'�t�@�C�����烊�X�g�A');
define('_RESTORE_WARNING',			'�i�������o�b�N�A�b�v�����X�g�A���悤�Ƃ��Ă��邩�m�F���A�n�߂�O�Ɍ��݂̃o�b�N�A�b�v������Ă����Ă��������j');
define('_ERROR_BACKUP_NOTSURE',		'"���F"�e�X�g�{�b�N�X���`�F�b�N����K�v������܂�');
define('_RESTORE_COMPLETE',			'���X�g�A����');

// new item notification
define('_NOTIFY_NI_MSG',			'�V�����A�C�e�������e����܂���:');
define('_NOTIFY_NI_TITLE',			'�V�����A�C�e��!');
define('_NOTIFY_KV_MSG',			'Karma vote on item:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'�A�C�e���ɃR�����g����:');
define('_NOTIFY_NC_TITLE',			'Nucleus�R�����g:');
define('_NOTIFY_USERID',			'���[�U�[ID:');
define('_NOTIFY_USER',				'���[�U�[:');
define('_NOTIFY_COMMENT',			'�R�����g:');
define('_NOTIFY_VOTE',				'���[:');
define('_NOTIFY_HOST',				'Host:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'�����o�[:');
define('_NOTIFY_TITLE',				'�^�C�g��:');
define('_NOTIFY_CONTENTS',			'�R���e���c:');

// member mail message
define('_MMAIL_MSG',				'A message sent to you by');
define('_MMAIL_FROMANON',			'an anonymous visitor');
define('_MMAIL_FROMNUC',			'Posted from a Nucleus weblog at');
define('_MMAIL_TITLE',				'A message from');
define('_MMAIL_MAIL',				'Message:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'�A�C�e���̒ǉ�');
define('_BMLET_EDIT',				'�A�C�e���̕ҏW');
define('_BMLET_DELETE',				'�A�C�e���̍폜');
define('_BMLET_BODY',				'�{��');
define('_BMLET_MORE',				'�g��');
define('_BMLET_OPTIONS',			'�I�v�V����');
define('_BMLET_PREVIEW',			'�v���r���[');

// used in bookmarklet
define('_ITEM_UPDATED',				'�A�C�e�����X�V����܂���');
define('_ITEM_DELETED',				'�A�C�e�����폜����܂���');

// plugins
define('_CONFIRMTXT_PLUGIN',		'���̃v���O�C�����폜���܂���?');
define('_ERROR_NOSUCHPLUGIN',		'���̂悤�ȃv���O�C���͂���܂���');
define('_ERROR_DUPPLUGIN',			'���̃v���O�C���͊��ɃC���X�g�[������Ă��܂�');
define('_ERROR_PLUGFILEERROR',		'���̂悤�ȃv���O�C���͑��݂��Ȃ����A�p�[�~�b�V�������������ݒ肳��Ă��܂���');
define('_PLUGS_NOCANDIDATES',		'�v���O�C����₪������܂���');

define('_PLUGS_TITLE_MANAGE',		'�v���O�C���̊Ǘ�');
define('_PLUGS_TITLE_INSTALLED',	'�C���X�g�[���ς�');
define('_PLUGS_TITLE_UPDATE',		'�o�^���X�g�̃A�b�v�f�[�g');
define('_PLUGS_TEXT_UPDATE',		'Nucleus�̓v���O�C���̃C�x���g�o�^��ێ����܂��B �t�@�C�����㏑�����ăv���O�C���̃A�b�v�f�[�g������ꍇ�A�o�^���������L���b�V������邽�߂ɂ��̃A�b�v�f�[�g�����s���Ă��������B');
define('_PLUGS_TITLE_NEW',			'�V�����v���O�C�����C���X�g�[��');
define('_PLUGS_ADD_TEXT',			'�ȉ���plugins�f�B���N�g�����́A�S�ẴC���X�g�[������Ă��Ȃ��\���̂���v���O�C���̃t�@�C���̃��X�g�ł��B�ǉ�����O�Ƀv���O�C�����ǂ�����<strong>��������m�F</strong>���Ă��������B');
define('_PLUGS_BTN_INSTALL',		'�v���O�C���̃C���X�g�[��');
define('_BACKTOOVERVIEW',			'�T�v�ɖ߂�');

// editlink
define('_TEMPLATE_EDITLINK',		'�A�C�e�������N�̕ҏW');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'left box��ǉ�');
define('_ADD_RIGHT_TT',				'right box��ǉ�');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'�V�����J�e�S���[...');

// new settings
define('_SETTINGS_PLUGINURL',		'�v���O�C��URL');
define('_SETTINGS_MAXUPLOADSIZE',	'�A�b�v���[�h�t�@�C���̍ő�T�C�Y (bytes)');
define('_SETTINGS_NONMEMBERMSGS',	'�����o�[�ȊO����̃��b�Z�[�W���t������');
define('_SETTINGS_PROTECTMEMNAMES',	'�����o�[���̕ی�');

// overview screen
define('_OVERVIEW_PLUGINS',			'�v���O�C���̊Ǘ�...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'�V���������o�[�̓o�^:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'���Ȃ���e-mail�A�h���X:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'�`�[�����X�g���ɑΏۃ����o�[�����ǂ�blog�ւ̊Ǘ��Ҍ����������Ă��܂���B���̂��߂ɁA���̃����o�[�̃��f�B�A�E�f�B���N�g���[�ւ̃t�@�C���̃A�b�v���[�h��F�߂��܂���B');

// plugin list
define('_LISTS_INFO',				'���');
define('_LIST_PLUGS_AUTHOR',		'By:');
define('_LIST_PLUGS_VER',			'�o�[�W����:');
define('_LIST_PLUGS_SITE',			'�T�C�g');
define('_LIST_PLUGS_DESC',			'����:');
define('_LIST_PLUGS_SUBS',			'�ȉ��̃C�x���g�ɓo�^:');
define('_LIST_PLUGS_UP',			'���');
define('_LIST_PLUGS_DOWN',			'����');
define('_LIST_PLUGS_UNINSTALL',		'�A���C���X�g�[��');
define('_LIST_PLUGS_ADMIN',			'�Ǘ�');
define('_LIST_PLUGS_OPTIONS',		'�ҏW&nbsp;�I�v�V����');

// plugin option list
define('_LISTS_VALUE',				'�l');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'���̃v���O�C���̃I�v�V�����͂���܂���');
define('_PLUGS_BACK',				'�v���O�C���̊T�v�ɖ߂�');
define('_PLUGS_SAVE',				'�I�v�V�����̕ۑ�');
define('_PLUGS_OPTIONS_UPDATED',	'�v���O�C���I�v�V�������X�V����܂���');

define('_OVERVIEW_MANAGEMENT',		'�Ǘ�');
define('_OVERVIEW_MANAGE',			'Nucleus�̊Ǘ�...');
define('_MANAGE_GENERAL',			'�Ǘ�');
define('_MANAGE_SKINS',				'�X�L��/�e���v���[�g');
define('_MANAGE_EXTRA',				'�ǉ��@�\\');

define('_BACKTOMANAGE',				'Nucleus�̊Ǘ��ɖ߂�');


// END introduced after v1.1 END




// charset to use 
define('_CHARSET',					'UTF-8');

// global stuff
define('_LOGOUT',					'���O�A�E�g');
define('_LOGIN',					'���O�C��');
define('_YES',						'�͂�');
define('_NO',						'������');
define('_SUBMIT',					'���M');
define('_ERROR',					'�G���[');
define('_ERRORMSG',					'�G���[���������܂���!');
define('_BACK',						'�߂�');
define('_NOTLOGGEDIN',				'���O�C�����Ă��܂���');
define('_LOGGEDINAS',				'���O�C��:');
define('_ADMINHOME',				'�Ǘ��z�[��');
define('_NAME',						'���O');
define('_BACKHOME',					'�Ǘ��z�[���ɖ߂�');
define('_BADACTION',				'���݂��Ȃ��A�N�V�������v������܂���');
define('_MESSAGE',					'���b�Z�[�W');
define('_HELP_TT',					'�w���v!');
define('_YOURSITE',					'�T�C�g�̊m�F');


define('_POPUP_CLOSE',				'�E�B���h�E�����');

define('_LOGIN_PLEASE',				'�܂����O�C�����Ă�������');

// commentform
define('_COMMENTFORM_YOUARE',		'You are: ');
define('_COMMENTFORM_SUBMIT',		'�R�����g��ǉ�');
define('_COMMENTFORM_COMMENT',		'comment');
define('_COMMENTFORM_NAME',			'Name');
define('_COMMENTFORM_MAIL',			'E-mail/HTTP');
define('_COMMENTFORM_REMEMBER',		'�����L�����Ă���');

// loginform
define('_LOGINFORM_NAME',			'���[�U�[��');
define('_LOGINFORM_PWD',			'�p�X���[�h');
define('_LOGINFORM_YOUARE',			'Logged in as');
define('_LOGINFORM_SHARED',			'Shared Computer');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'���b�Z�[�W���M');

// search form
define('_SEARCHFORM_SUBMIT',		'����');

// add item form
define('_ADD_ADDTO',				'�A�C�e���̒ǉ�:');
define('_ADD_CREATENEW',			'�V�����A�C�e��');
define('_ADD_BODY',					'�{��');
define('_ADD_TITLE',				'�^�C�g��');
define('_ADD_MORE',					'�g�� (optional)');
define('_ADD_CATEGORY',				'�J�e�S���[');
define('_ADD_PREVIEW',				'�v���r���[');
define('_ADD_DISABLE_COMMENTS',		'�R�����g�𖳌��ɂ��܂���?');
define('_ADD_DRAFTNFUTURE',			'Draft &amp; Future Items');
define('_ADD_ADDITEM',				'�A�C�e����ǉ�');
define('_ADD_ADDNOW',				'�������ǉ�');
define('_ADD_ADDLATER',				'��Œǉ�');
define('_ADD_PLACE_ON',				'����:');
define('_ADD_ADDDRAFT',				'�h���t�g�ɒǉ�');
define('_ADD_NOPASTDATES',			'(�ߋ��̓����͎w��ł��܂���B�w�肳�ꂽ�ꍇ�͌��݂̓������g�p����܂�)');
define('_ADD_BOLD_TT',				'����');
define('_ADD_ITALIC_TT',			'�Α�');
define('_ADD_HREF_TT',				'�����N�쐬');
define('_ADD_MEDIA_TT',				'Media�̒ǉ�');
define('_ADD_PREVIEW_TT',			'�v���r���[�̕\��/��\��');
define('_ADD_CUT_TT',				'�J�b�g');
define('_ADD_COPY_TT',				'�R�s�[');
define('_ADD_PASTE_TT',				'�y�[�X�g');


// edit item form
define('_EDIT_ITEM',				'�A�C�e���̕ҏW');
define('_EDIT_SUBMIT',				'�A�C�e���̕ҏW');
define('_EDIT_ORIG_AUTHOR',			'�����');
define('_EDIT_BACKTODRAFTS',		'Add back to drafts');
define('_EDIT_COMMENTSNOTE',		'(����: �R�����g�̔�\���͈ȑO�ɒǉ����ꂽ�R�����g���B���͂��܂���)');

// used on delete screens
define('_DELETE_CONFIRM',			'�폜�̊m�F�����Ă�������');
define('_DELETE_CONFIRM_BTN',		'�폜�̊m�F');
define('_CONFIRMTXT_ITEM',			'�ȉ��̃A�C�e�����폜���悤�Ƃ��Ă��܂�:');
define('_CONFIRMTXT_COMMENT',		'�ȉ��̃R�����g���폜���悤�Ƃ��Ă��܂�:');
define('_CONFIRMTXT_TEAM1',			'����blog�̃`�[�����X�g����');
define('_CONFIRMTXT_TEAM2',			'�폜���悤�Ƃ��Ă��܂�');
define('_CONFIRMTXT_BLOG',			'�폜����blog: ');
define('_WARNINGTXT_BLOGDEL',		'�x��! blog���폜����Ƃ���Ɋ܂܂�Ă���S�ẴA�C�e���A�R�����g�͍폜����܂��B���̓_���m�F������ōs���Ă��������B<br />����ɁAblog�̍폜����Nucleus�𒆒f�����Ȃ��ł��������B');
define('_CONFIRMTXT_MEMBER',		'�ȉ��̃����o�[�v���t�@�C�����폜���悤�Ƃ��Ă��܂�: ');
define('_CONFIRMTXT_TEMPLATE',		'���̃e���v���[�g���폜���悤�Ƃ��Ă��܂�: ');
define('_CONFIRMTXT_SKIN',			'���̃X�L�����폜���悤�Ƃ��Ă��܂�: ');
define('_CONFIRMTXT_BAN',			'���̋֎~IP�͈͂��폜���悤�Ƃ��Ă��܂�: ');
define('_CONFIRMTXT_CATEGORY',		'���̃J�e�S���[���폜���悤�Ƃ��Ă��܂�: ');

// some status messages
define('_DELETED_ITEM',				'�A�C�e�����폜����܂���');
define('_DELETED_MEMBER',			'�����o�[���폜����܂���');
define('_DELETED_COMMENT',			'�R�����g���폜����܂���');
define('_DELETED_BLOG',				'Blog���폜����܂���');
define('_DELETED_CATEGORY',			'�J�e�S���[���폜����܂���');
define('_ITEM_MOVED',				'�A�C�e�����ړ�����܂���');
define('_ITEM_ADDED',				'�A�C�e�����ǉ�����܂���');
define('_COMMENT_UPDATED',			'�R�����g���X�V����܂���');
define('_SKIN_UPDATED',				'�X�L���f�[�^���ۑ�����܂���');
define('_TEMPLATE_UPDATED',			'�e���v���[�g�f�[�^���ۑ�����܂���');

// errors
define('_ERROR_COMMENT_LONGWORD',	'�R�����g�ɂ͔��p��90�����ȏ�̌���g��Ȃ��ŉ�����');
define('_ERROR_COMMENT_NOCOMMENT',	'�R�����g����͂��Ă�������');
define('_ERROR_COMMENT_NOUSERNAME',	'�������Ȃ����[�U���ł�');
define('_ERROR_COMMENT_TOOLONG',	'�R�����g���������܂�(���p��5000�����܂�)');
define('_ERROR_COMMENTS_DISABLED',	'����Blog�ւ̃R�����g�͌��ݎg�p�ł��܂���');
define('_ERROR_COMMENTS_NONPUBLIC',	'����Blog�փR�����g��ǉ�����ɂ̓����o�[�Ƃ��ă��O�C�����Ȃ���΂����܂���');
define('_ERROR_COMMENTS_MEMBERNICK','���Ȃ����g�����Ƃ������O�͊��Ɏg���Ă��܂��B���̖��O��I��ł��������B');
define('_ERROR_SKIN',				'�X�L���@�G���[');
define('_ERROR_ITEMCLOSED',			'���̃A�C�e���͕�����܂����B���̃A�C�e���ւ̃R�����g�̒ǉ��A���[�͂ł��܂���B');
define('_ERROR_NOSUCHITEM',			'���̂悤�ȃA�C�e���͑��݂��܂���');
define('_ERROR_NOSUCHBLOG',			'���̂悤��blog�͑��݂��܂���');
define('_ERROR_NOSUCHSKIN',			'���̂悤�ȃX�L���͑��݂��܂���');
define('_ERROR_NOSUCHMEMBER',		'���̂悤�ȃ����o�[�͑��݂��܂���');
define('_ERROR_NOTONTEAM',			'���Ȃ��͂���weblog�̃`�[�����X�g�Ɋ܂܂�Ă��܂���');
define('_ERROR_BADDESTBLOG',		'������blog�����݂��܂���');
define('_ERROR_NOTONDESTTEAM',		'���Ȃ���������blog�̃`�[�����X�g�ɓ����Ă��Ȃ����߁A�A�C�e�����ړ��ł��܂���');
define('_ERROR_NOEMPTYITEMS',		'��̃A�C�e���͒ǉ��ł��܂���!');
define('_ERROR_BADMAILADDRESS',		'Email�A�h���X���s���ł�');
define('_ERROR_BADNOTIFY',			'�^����ꂽ1�ȏ�̒ʒm�A�h���X���s����Email�A�h���X�ł�');
define('_ERROR_BADNAME',			'���O���g�p�ł��܂��� ( a�`z �A0�`9 �̉p���������g���܂���)');
define('_ERROR_NICKNAMEINUSE',		'���̃����o�[�����̃j�b�N�l�[�����g�p���Ă��܂�');
define('_ERROR_PASSWORDMISMATCH',	'�p�X���[�h���}�b�`���܂���');
define('_ERROR_PASSWORDTOOSHORT',	'�p�X���[�h��6�����ȏ�łȂ���΂Ȃ�܂���');
define('_ERROR_PASSWORDMISSING',	'�p�X���[�h����ł�');
define('_ERROR_REALNAMEMISSING',	'�{������͂��Ă�������');
define('_ERROR_ATLEASTONEADMIN',	'�Ǘ��җ̈�Ƀ��O�C���ł���super-admin�����Ȃ��Ƃ�1�l�͂��Ȃ��Ă͂����܂���B');
define('_ERROR_ATLEASTONEBLOGADMIN','���̃A�N�V���������s����Ƃ��Ȃ���weblog�̓����e�i���X�s�\�ɂȂ�܂��B���Ȃ��Ƃ�1�l�̊Ǘ��҂�����悤�ɂ��Ă��������B');
define('_ERROR_ALREADYONTEAM',		'���Ƀ`�[���ɂ��郁���o�[�͒ǉ��ł��܂���');
define('_ERROR_BADSHORTBLOGNAME',	'�Z��blog���ɂ� a�`z �A0�`9�A�̉p�����̂ݎg�p�ł��܂��B�X�y�[�X�͎g�p�ł��܂���B');
define('_ERROR_DUPSHORTBLOGNAME',	'����blog�œ����Z�k�����g���Ă��܂��B�������O�͎g�p�ł��܂���B');
define('_ERROR_UPDATEFILE',			'�X�V�t�@�C���ɏ������߂܂���B�t�@�C���̃p�[�~�b�V�������������Z�b�g����Ă��邩�m�F���Ă������� (chmod 666 �������Ă݂Ă�������)�B�܂��A���ꂪ�Ǘ��̈�f�B���N�g������̑��Έʒu�ł���ꍇ�A(/your/path/to/nucleus/ �̂悤��)��΃p�X�Ŏw�肵�Ă݂Ă�������');
define('_ERROR_DELDEFBLOG',			'default blog�͍폜�ł��܂���');
define('_ERROR_DELETEMEMBER',		'���̃����o�[�̓A�C�e�����R�����g�������Ă��邽�ߍ폜�ł��܂���');
define('_ERROR_BADTEMPLATENAME',	'�s���ȃe���v���[�g���ł� (a�`z �A0�`9 �̉p�����̂ݎg�p�B�X�y�[�X�͎g�p�s��)');
define('_ERROR_DUPTEMPLATENAME',	'�������O�̃e���v���[�g�����ɑ��݂��܂�');
define('_ERROR_BADSKINNAME',		'�s���ȃX�L�����ł� (a�`z �A0�`9 �̉p�����̂ݎg�p�B�X�y�[�X�͎g�p�s��)');
define('_ERROR_DUPSKINNAME',		'�������O�̃X�L�������ɑ��݂��܂�');
define('_ERROR_DEFAULTSKIN',		'��� "default" �Ƃ������O�̃X�L�������݂��Ȃ���΂����܂���');
define('_ERROR_SKINDEFDELETE',		'�ȉ���weblog��default�X�L���̂��߁A�X�L�����폜�ł��܂���: ');
define('_ERROR_DISALLOWED',			'���̃A�N�V�����̎��s��������Ă��܂���');
define('_ERROR_DELETEBAN',			'�֎~�҂̍폜���ɃG���[���������܂��� (�֎~�҂����݂��܂���)');
define('_ERROR_ADDBAN',				'�֎~�҂̒ǉ����ɃG���[���������܂����B�S�Ă�blog�ɐ������ǉ�����Ă��Ȃ���������܂���B');
define('_ERROR_BADACTION',			'�v�����ꂽ�A�N�V���������݂��܂���');
define('_ERROR_MEMBERMAILDISABLED',	'�����o�[�Ԃ̃��[�����b�Z�[�W���g�p�s�ɂȂ��Ă��܂�');
define('_ERROR_MEMBERCREATEDISABLED','�����o�[�̍쐬���g�p�s�ɂȂ��Ă��܂�');
define('_ERROR_INCORRECTEMAIL',		'�������Ȃ����[���A�h���X�ł�');
define('_ERROR_VOTEDBEFORE',		'���̃A�C�e���Ɋ��ɓ��[�ς݂ł�');
define('_ERROR_BANNED1',			'���Ȃ� (ip�͈� ');
define('_ERROR_BANNED2',			') �͂��̃A�N�V�����̎��s���֎~����Ă��܂��B���b�Z�[�W: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'���̃A�N�V���������s���邷��ɂ̓��O�C�����K�v�ł�');
define('_ERROR_CONNECT',			'�ڑ��G���[');
define('_ERROR_FILE_TOO_BIG',		'�t�@�C�����傫�����܂�!');
define('_ERROR_BADFILETYPE',		'���̃t�@�C���^�C�v�͔F�߂��Ă��܂���');
define('_ERROR_BADREQUEST',			'�s���ȃA�b�v���[�h�v���ł�');
define('_ERROR_DISALLOWEDUPLOAD',	'���Ȃ��͂ǂ�weblog�`�[�����X�g�ɂ������Ă��Ȃ��̂ŁA�t�@�C�����A�b�v���[�h�ł��܂���܂���');
define('_ERROR_BADPERMISSIONS',		'�t�@�C��/�f�B���N�g���̃p�[�~�b�V�������������Z�b�g����Ă��܂���');
define('_ERROR_UPLOADMOVEP',		'�A�b�v���[�h�t�@�C���̈ړ����ɃG���[���������܂���');
define('_ERROR_UPLOADCOPY',			'�t�@�C���̃R�s�[���ɃG���[���������܂���');
define('_ERROR_UPLOADDUPLICATE',	'�������O�̃t�@�C�������ɑ��݂��܂��B�A�b�v���[�h����O�ɖ��O��ύX���Ă��Ă��������B');
define('_ERROR_LOGINDISALLOWED',	'���Ȃ��͊Ǘ��җ̈�ւ̃��O�C�����F�߂��Ă��܂���B�������A���̃��[�U�[�Ƃ��ă��O�C�����邱�Ƃ͏o���܂�');
define('_ERROR_DBCONNECT',			'mySQL�T�[�o�ɐڑ��ł��܂���');
define('_ERROR_DBSELECT',			'nucleus�f�[�^�x�[�X��I���ł��܂���');
define('_ERROR_NOSUCHLANGUAGE',		'���̂悤��language�t�@�C���͑��݂��܂���');
define('_ERROR_NOSUCHCATEGORY',		'���̂悤�ȃJ�e�S���[�͑��݂��܂���');
define('_ERROR_DELETELASTCATEGORY',	'���Ȃ��Ƃ�1�̃J�e�S���[���K�v�ł�');
define('_ERROR_DELETEDEFCATEGORY',	'default�J�e�S���[�͍폜�ł��܂���');
define('_ERROR_BADCATEGORYNAME',	'�J�e�S���[���Ƃ��Ďg���܂���');
define('_ERROR_DUPCATEGORYNAME',	'�������O�̃J�e�S���[�����ɑ��݂��܂�');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'�x��: ���݂̒l�̓f�B���N�g���ł͂���܂���!');
define('_WARNING_NOTREADABLE',		'�x��: ���݂̒l�͓ǂݎ��s�\�ȃf�B���N�g���ł�!');
define('_WARNING_NOTWRITABLE',		'�x��: ���݂̒l�͏������ݕs�\�ȃf�B���N�g���ł�!');

// media and upload
define('_MEDIA_UPLOADLINK',			'�V�����t�@�C���̃A�b�v���[�h');
define('_MEDIA_MODIFIED',			'modified');
define('_MEDIA_FILENAME',			'�t�@�C����');
define('_MEDIA_DIMENSIONS',			'dimensions');
define('_MEDIA_INLINE',				'���ߍ���');
define('_MEDIA_POPUP',				'�|�b�v�A�b�v');
define('_UPLOAD_TITLE',				'�t�@�C���I��');
define('_UPLOAD_MSG',				'�A�b�v���[�h����t�@�C����I�����āA\'�A�b�v���[�h\' �{�^���������Ă�������');
define('_UPLOAD_BUTTON',			'�A�b�v���[�h');

// some status messages
define('_MSG_ACCOUNTCREATED',		'�A�J�E���g���쐬����܂����B�p�X���[�h��Email�ő��M����܂�');
define('_MSG_PASSWORDSENT',			'�p�X���[�h��e-mail�ő��M����܂����B');
define('_MSG_LOGINAGAIN',			'���Ȃ��̏�񂪕ύX���ꂽ�ׁA���O�C�����Ȃ����K�v������܂�');
define('_MSG_SETTINGSCHANGED',		'�ݒ肪�ύX����܂���');
define('_MSG_ADMINCHANGED',			'�Ǘ��Ҍ��� ���ύX����܂���');
define('_MSG_NEWBLOG',				'�V����blog���쐬����܂���');
define('_MSG_ACTIONLOGCLEARED',		'Action Log ����������܂���');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'������Ă��Ȃ��A�N�V����: ');
define('_ACTIONLOG_PWDREMINDERSENT','�V�����p�X���[�h�̑����: ');
define('_ACTIONLOG_TITLE',			'Action Log');
define('_ACTIONLOG_CLEAR_TITLE',	'Action Log�̏���');
define('_ACTIONLOG_CLEAR_TEXT',		'action log������������');

// team management
define('_TEAM_TITLE',				'blog�̃`�[�����Ǘ����� ');
define('_TEAM_CURRENT',				'���݂̃`�[��');
define('_TEAM_ADDNEW',				'�`�[���ɐV���������o�[��ǉ�����');
define('_TEAM_CHOOSEMEMBER',		'�����o�[��I��');
define('_TEAM_ADMIN',				'�Ǘ��Ҍ�����^���� ');
define('_TEAM_ADD',					'�`�[���ɒǉ�');
define('_TEAM_ADD_BTN',				'�`�[���ɒǉ�');

// blogsettings
define('_EBLOG_TITLE',				'Blog�ݒ�̕ҏW');
define('_EBLOG_TEAM_TITLE',			'�`�[���̕ҏW');
define('_EBLOG_TEAM_TEXT',			'�`�[���̕ҏW...');
define('_EBLOG_SETTINGS_TITLE',		'Blog�ݒ�');
define('_EBLOG_NAME',				'Blog�̖��O');
define('_EBLOG_SHORTNAME',			'Blog�̒Z�k��');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(a�`z�̉p�����݂̂��g�p�ł��A�X�y�[�X�͎g�p�ł��܂���)');
define('_EBLOG_DESC',				'Blog�̐���');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'�W���̃X�L��');
define('_EBLOG_DEFCAT',				'�W���̃J�e�S��');
define('_EBLOG_LINEBREAKS',			'���s��ϊ�����');
define('_EBLOG_DISABLECOMMENTS',	'�R�����g�𖳌��ɂ��܂���?<br /><small>(�R�����g�𖳌��ɂ���ƃR�����g�̒ǉ��͂ł��Ȃ��Ȃ�܂��B)</small>');
define('_EBLOG_ANONYMOUS',			'�񃁃��o�[�̃R�����g�������܂���?');
define('_EBLOG_NOTIFY',				'�ʒm���郁�[���A�h���X ( ; �ŋ�؂��Ă�������)');
define('_EBLOG_NOTIFY_ON',			'�ȉ���ʒm����');
define('_EBLOG_NOTIFY_COMMENT',		'�V�����R�����g');
define('_EBLOG_NOTIFY_KARMA',		'�V���� karma votes');
define('_EBLOG_NOTIFY_ITEM',		'�V���� weblog �A�C�e��');
define('_EBLOG_PING',				'�X�V���� Weblogs.com ��Ping�𑗂�܂���?');
define('_EBLOG_MAXCOMMENTS',		'�R�����g�̍ő��');
define('_EBLOG_UPDATE',				'�A�b�v���[�h�t�@�C��');
define('_EBLOG_OFFSET',				'Time Offset');
define('_EBLOG_STIME',				'���݂̃T�[�o����: ');
define('_EBLOG_BTIME',				'���݂�blog����: ');
define('_EBLOG_CHANGE',				'�ݒ�̕ύX');
define('_EBLOG_CHANGE_BTN',			'�ݒ�̕ύX');
define('_EBLOG_ADMIN',				'Blog �Ǘ��Ҍ���');
define('_EBLOG_ADMIN_MSG',			'���Ȃ��ɂ͊Ǘ��Ҍ��������蓖�Ă��܂�');
define('_EBLOG_CREATE_TITLE',		'�V����weblog�̍쐬');
define('_EBLOG_CREATE_TEXT',		'�V����weblog���쐬����ׂɈȉ��̃t�H�[���ɏ�������ł��������B<br /><br /> <b>����:</b> �K�v�ȃI�v�V�����݂̂��\������Ă��܂��B�ǉ��̃I�v�V������ݒ肵�����ꍇ�́Aweblog���쐬�������blog�ݒ�y�[�W�ɍs���Đݒ肵�Ă��������B');
define('_EBLOG_CREATE',				'�쐬!');
define('_EBLOG_CREATE_BTN',			'Weblog���쐬');
define('_EBLOG_CAT_TITLE',			'�J�e�S���[');
define('_EBLOG_CAT_NAME',			'�J�e�S���[��');
define('_EBLOG_CAT_DESC',			'�J�e�S���[�̐���');
define('_EBLOG_CAT_CREATE',			'�V�����J�e�S���[�����');
define('_EBLOG_CAT_UPDATE',			'�J�e�S���[�̍X�V');
define('_EBLOG_CAT_UPDATE_BTN',		'�J�e�S���[���X�V');

// templates
define('_TEMPLATE_TITLE',			'�e���v���[�g�̕ҏW');
define('_TEMPLATE_AVAILABLE_TITLE',	'�g�p�\�ȃe���v���[�g');
define('_TEMPLATE_NEW_TITLE',		'�V�����e���v���[�g');
define('_TEMPLATE_NAME',			'�e���v���[�g��');
define('_TEMPLATE_DESC',			'�e���v���[�g�̐���');
define('_TEMPLATE_CREATE',			'�e���v���[�g�̍쐬');
define('_TEMPLATE_CREATE_BTN',		'�e���v���[�g���쐬');
define('_TEMPLATE_EDIT_TITLE',		'�e���v���[�g�̕ҏW');
define('_TEMPLATE_BACK',			'�e���v���[�g�̊T�v�ɖ߂�');
define('_TEMPLATE_EDIT_MSG',		'�S�Ẵe���v���[�g�p�[�c���K�v�Ȗ�ł͂���܂���B�K�v�Ȃ��ꍇ�͋󗓂̂܂܂ɂ��Ă����Ă��������B');
define('_TEMPLATE_SETTINGS',		'�e���v���[�g�ݒ�');
define('_TEMPLATE_ITEMS',			'�A�C�e��');
define('_TEMPLATE_ITEMHEADER',		'�A�C�e���� Header');
define('_TEMPLATE_ITEMBODY',		'�A�C�e���� Body');
define('_TEMPLATE_ITEMFOOTER',		'�A�C�e���� Footer');
define('_TEMPLATE_MORELINK',		'�g���G���g���[�ւ̃����N');
define('_TEMPLATE_NEW',				'�V�����A�C�e���̎w��');
define('_TEMPLATE_COMMENTS_ANY',	'�R�����g (����ꍇ)');
define('_TEMPLATE_CHEADER',			'�R�����g�� Header');
define('_TEMPLATE_CBODY',			'�R�����g�� Body');
define('_TEMPLATE_CFOOTER',			'�R�����g�� Footer');
define('_TEMPLATE_CONE',			'�R�����g��1�̎�');
define('_TEMPLATE_CMANY',			'�R�����g��2�ȏ�̎�');
define('_TEMPLATE_CMORE',			'����ɃR�����g��ǂ�');
define('_TEMPLATE_CMEXTRA',			'Member Extra');
define('_TEMPLATE_COMMENTS_NONE',	'�R�����g (�����ꍇ)');
define('_TEMPLATE_CNONE',			'�R�����g��������');
define('_TEMPLATE_COMMENTS_TOOMUCH','�R�����g (�C�����C���\���ɂ͒�������ꍇ)');
define('_TEMPLATE_CTOOMUCH',		'��������R�����g�̎�');
define('_TEMPLATE_ARCHIVELIST',		'�A�[�J�C�u���X�g');
define('_TEMPLATE_AHEADER',			'�A�[�J�C�u���X�g Header');
define('_TEMPLATE_AITEM',			'�A�[�J�C�u���X�g Item');
define('_TEMPLATE_AFOOTER',			'�A�[�J�C�u���X�g Footer');
define('_TEMPLATE_DATETIME',		'���t�Ǝ���');
define('_TEMPLATE_DHEADER',			'���t Header');
define('_TEMPLATE_DFOOTER',			'���t Footer');
define('_TEMPLATE_DFORMAT',			'���t Format');
define('_TEMPLATE_TFORMAT',			'���� Format');
define('_TEMPLATE_LOCALE',			'Locale');
define('_TEMPLATE_IMAGE',			'�C���[�W�̃|�b�v�A�b�v');
define('_TEMPLATE_PCODE',			'�|�b�v�A�b�v�摜�ւ̃����N�R�[�h');
define('_TEMPLATE_ICODE',			'�C�����C���摜�̃R�[�h');
define('_TEMPLATE_MCODE',			'���f�B�A�I�u�W�F�N�g�ւ̃����N�R�[�h');
define('_TEMPLATE_SEARCH',			'����');
define('_TEMPLATE_SHIGHLIGHT',		'�n�C���C�g�\��');
define('_TEMPLATE_SNOTFOUND',		'�����ŉ���������Ȃ������ꍇ');
define('_TEMPLATE_UPDATE',			'�X�V');
define('_TEMPLATE_UPDATE_BTN',		'�e���v���[�g�̍X�V');
define('_TEMPLATE_RESET_BTN',		'���Z�b�g');
define('_TEMPLATE_CATEGORYLIST',	'�J�e�S���[���X�g');
define('_TEMPLATE_CATHEADER',		'�J�e�S���[���X�g Header');
define('_TEMPLATE_CATITEM',			'�J�e�S���[���X�g Item');
define('_TEMPLATE_CATFOOTER',		'�J�e�S���[���X�g Footer');

// skins
define('_SKIN_EDIT_TITLE',			'�X�L���̕ҏW');
define('_SKIN_AVAILABLE_TITLE',		'�g�p�\�ȃX�L��');
define('_SKIN_NEW_TITLE',			'�V�����X�L��');
define('_SKIN_NAME',				'���O');
define('_SKIN_DESC',				'����');
define('_SKIN_TYPE',				'Content Type');
define('_SKIN_CREATE',				'�쐬');
define('_SKIN_CREATE_BTN',			'�X�L���̍쐬');
define('_SKIN_EDITONE_TITLE',		'�X�L���̕ҏW');
define('_SKIN_BACK',				'�X�L���̊T�v�ɖ߂�');
define('_SKIN_PARTS_TITLE',			'�X�L���p�[�c');
define('_SKIN_PARTS_MSG',			'���ꂼ��̃X�L���ɑS�Ẵ^�C�v���K�v�Ƃ͌���܂���B�K�v�Ȃ��ꍇ�͋󗓂̂܂܂ɂ��Ă����Ă��������B�ȉ�����ҏW����X�L����I��ł�������:');
define('_SKIN_PART_MAIN',			'Main Index');
define('_SKIN_PART_ITEM',			'Item Pages');
define('_SKIN_PART_ALIST',			'Archive List');
define('_SKIN_PART_ARCHIVE',		'Archive');
define('_SKIN_PART_SEARCH',			'Search');
define('_SKIN_PART_ERROR',			'Errors');
define('_SKIN_PART_MEMBER',			'Member Details');
define('_SKIN_PART_POPUP',			'Image Popups');
define('_SKIN_GENSETTINGS_TITLE',	'��ʐݒ�');
define('_SKIN_CHANGE',				'�ύX');
define('_SKIN_CHANGE_BTN',			'�ݒ�̕ύX');
define('_SKIN_UPDATE_BTN',			'�X�L���̍X�V');
define('_SKIN_RESET_BTN',			'���Z�b�g');
define('_SKIN_EDITPART_TITLE',		'�X�L���̕ҏW');
define('_SKIN_GOBACK',				'�߂�');
define('_SKIN_ALLOWEDVARS',			'�g�p�\�ȕϐ� (�N���b�N�Ő����\��):');

// global settings
define('_SETTINGS_TITLE',			'��ʐݒ�');
define('_SETTINGS_SUB_GENERAL',		'��ʐݒ�');
define('_SETTINGS_DEFBLOG',			'�K��� Blog');
define('_SETTINGS_ADMINMAIL',		'�Ǘ��҂� Email');
define('_SETTINGS_SITENAME',		'�T�C�g��');
define('_SETTINGS_SITEURL',			'�T�C�g��URL (�Ō�ɃX���b�V�� "/" ��t���Ă�������)');
define('_SETTINGS_ADMINURL',		'�Ǘ��җ̈��URL (�Ō�ɃX���b�V�� "/" ��t���Ă�������)');
define('_SETTINGS_DIRS',			'Nucleus �f�B���N�g��');
define('_SETTINGS_MEDIADIR',		'Media �f�B���N�g��');
define('_SETTINGS_SEECONFIGPHP',	'(config.php ���Q��)');
define('_SETTINGS_MEDIAURL',		'Media URL (�Ō�ɃX���b�V�� "/" ��t���Ă�������)');
define('_SETTINGS_ALLOWUPLOAD',		'�t�@�C���̃A�b�v���[�h�������܂���?');
define('_SETTINGS_ALLOWUPLOADTYPES','�A�b�v���[�h��������t�@�C���^�C�v');
define('_SETTINGS_CHANGELOGIN',		'�����o�[�ɂ�郍�O�C����/�p�X���[�h�̕ύX��������');
define('_SETTINGS_COOKIES_TITLE',	'Cookie �ݒ�');
define('_SETTINGS_COOKIELIFE',		'���O�C�� Cookie �̗L������');
define('_SETTINGS_COOKIESESSION',	'�Z�b�V��������');
define('_SETTINGS_COOKIEMONTH',		'�ꃖ��');
define('_SETTINGS_COOKIEPATH',		'Cookie �p�X (advanced)');
define('_SETTINGS_COOKIEDOMAIN',	'Cookie �h���C�� (advanced)');
define('_SETTINGS_COOKIESECURE',	'�Z�L���A Cookie (advanced)');
define('_SETTINGS_LASTVISIT',		'Last Visit Cookies �̕ۑ�');
define('_SETTINGS_ALLOWCREATE',		'�r�W�^�[�Ƀ����o�[�A�J�E���g�쐬��������');
define('_SETTINGS_NEWLOGIN',		'���[�U�[���쐬�����A�J�E���g�ɂ�郍�O�C��������');
define('_SETTINGS_NEWLOGIN2',		'(�V�����쐬���ꂽ�A�J�E���g�̂�)');
define('_SETTINGS_MEMBERMSGS',		'�����o�[�ԃT�[�r�X������');
define('_SETTINGS_LANGUAGE',		'�K��̌���');
define('_SETTINGS_DISABLESITE',		'���̃T�C�g�ւ̃��_�C���N�g�i��펞�p�j');
define('_SETTINGS_DBLOGIN',			'mySQL ���O�C�� &amp; �f�[�^�x�[�X');
define('_SETTINGS_UPDATE',			'�ݒ�̍X�V');
define('_SETTINGS_UPDATE_BTN',		'�ݒ���X�V');
define('_SETTINGS_DISABLEJS',		'JavaScript�c�[���o�[�𖳌��ɂ���');
define('_SETTINGS_MEDIA',			'���f�B�A/�A�b�v���[�h�ݒ�');
define('_SETTINGS_MEDIAPREFIX',		'�A�b�v���[�h����t�@�C�����̓��ɓ��t��t������');
define('_SETTINGS_MEMBERS',			'�����o�[�ݒ�');

// bans
define('_BAN_TITLE',				'�֎~���X�g:');
define('_BAN_NONE',					'����weblog�̋֎~�҂͂��܂���');
define('_BAN_NEW_TITLE',			'�֎~�҂�ǉ�����');
define('_BAN_NEW_TEXT',				'�������֎~�҂�ǉ�����');
define('_BAN_REMOVE_TITLE',			'�֎~�҂̍폜');
define('_BAN_IPRANGE',				'IP�͈̔�');
define('_BAN_BLOGS',				'�֎~����blog: ');
define('_BAN_DELETE_TITLE',			'�֎~�҂̍폜');
define('_BAN_ALLBLOGS',				'���Ȃ����Ǘ��ғ��������S�Ă�blog�B');
define('_BAN_REMOVED_TITLE',		'�֎~�҂��폜����܂���');
define('_BAN_REMOVED_TEXT',			'�ȉ���blog�ւ̋֎~�҂��폜����܂���:');
define('_BAN_ADD_TITLE',			'�֎~�҂̒ǉ�');
define('_BAN_IPRANGE_TEXT',			'�ȉ��Ńu���b�N������IP�͈̔͂�I��ł��������B�w�肷��͈͂��������������̃A�h���X���u���b�N����܂��B');
define('_BAN_BLOGS_TEXT',			'1��blog�݂̂ŋ֎~���邩�A���Ȃ����Ǘ��ғ��������S�Ă�blog�ŋ֎~���邩��I�����邱�Ƃ��o���܂��B�ȉ�����I��ł��������B');
define('_BAN_REASON_TITLE',			'���R');
define('_BAN_REASON_TEXT',			'�Y������IP�֎~�҂��R�����g��ǉ�������karma vote��cast���悤�Ƃ����Ƃ��ɕ\�������֎~���R�������Ă������Ƃ��ł��܂� (���256����)�B');
define('_BAN_ADD_BTN',				'�֎~�҂̒ǉ�');

// LOGIN screen
define('_LOGIN_MESSAGE',			'Message');
define('_LOGIN_NAME',				'Name');
define('_LOGIN_PASSWORD',			'Password');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'�p�X���[�h��Y�ꂽ�ꍇ');

// membermanagement
define('_MEMBERS_TITLE',			'�����o�[�̊Ǘ�');
define('_MEMBERS_CURRENT',			'���݂̃����o�[');
define('_MEMBERS_NEW',				'�V���������o�[�̒ǉ�');
define('_MEMBERS_DISPLAY',			'�\������閼�O');
define('_MEMBERS_DISPLAY_INFO',		'(���̖��O�̓��O�I�����Ɏg���܂�)');
define('_MEMBERS_REALNAME',			'�{��');
define('_MEMBERS_PWD',				'�p�X���[�h');
define('_MEMBERS_REPPWD',			'�p�X���[�h�i�m�F�j');
define('_MEMBERS_EMAIL',			'Email�A�h���X');
define('_MEMBERS_EMAIL_EDIT',		'(Email�A�h���X���ύX�����ƁA���̃A�h���X�֎����I�ɐV�����p�X���[�h�����M����܂�)');
define('_MEMBERS_URL',				'Web�T�C�g�A�h���X (URL)');
define('_MEMBERS_SUPERADMIN',		'Super-admin(�ō��Ǘ�)������^����');
define('_MEMBERS_CANLOGIN',			'�Ǘ��җ̈�ւ̃��O�C��');
define('_MEMBERS_NOTES',			'���l');
define('_MEMBERS_NEW_BTN',			'�����o�[�̒ǉ�');
define('_MEMBERS_EDIT',				'�����o�[�̕ҏW');
define('_MEMBERS_EDIT_BTN',			'�ݒ�̕ύX');
define('_MEMBERS_BACKTOOVERVIEW',	'�����o�[�̊T�v�ɖ߂�');
define('_MEMBERS_DEFLANG',			'����');
define('_MEMBERS_USESITELANG',		'- �T�C�g�̐ݒ���g�� -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'�T�C�g������');
define('_BLOGLIST_ADD',				'�A�C�e���̒ǉ�');
define('_BLOGLIST_TT_ADD',			'����weblog�ɐV�����A�C�e����ǉ����܂�');
define('_BLOGLIST_EDIT',			'�A�C�e���̕ҏW/�폜');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'Bookmarklet');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'�ݒ�');
define('_BLOGLIST_TT_SETTINGS',		'�ݒ�̕ҏW/�`�[���̊Ǘ�');
define('_BLOGLIST_BANS',			'�֎~');
define('_BLOGLIST_TT_BANS',			'�֎~IP�̊m�F/�ǉ�/�폜');
define('_BLOGLIST_DELETE',			'�S�č폜');
define('_BLOGLIST_TT_DELETE',		'����weblog���폜');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'���Ȃ��� weblog');
define('_OVERVIEW_YRDRAFTS',		'�h���t�g');
define('_OVERVIEW_YRSETTINGS',		'�ݒ�');
define('_OVERVIEW_GSETTINGS',		'��{�ݒ�');
define('_OVERVIEW_NOBLOGS',			'���Ȃ��͂ǂ�weblog�`�[�����X�g�ɂ������Ă��܂���');
define('_OVERVIEW_NODRAFTS',		'�h���t�g�i�ҏW���j�̋L���͂���܂���');
define('_OVERVIEW_EDITSETTINGS',	'���Ȃ��̐ݒ��ҏW...');
define('_OVERVIEW_BROWSEITEMS',		'���Ȃ��̃A�C�e��������...');
define('_OVERVIEW_BROWSECOMM',		'���Ȃ��̃R�����g������...');
define('_OVERVIEW_VIEWLOG',			'Action Log������...');
define('_OVERVIEW_MEMBERS',			'�����o�[�̊Ǘ�...');
define('_OVERVIEW_NEWLOG',			'�V����Weblog�����...');
define('_OVERVIEW_SETTINGS',		'�ݒ�̕ҏW...');
define('_OVERVIEW_TEMPLATES',		'�e���v���[�g�̕ҏW...');
define('_OVERVIEW_SKINS',			'�X�L���̕ҏW...');
define('_OVERVIEW_BACKUP',			'�o�b�N�A�b�v/���X�g�A...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'blog �A�C�e���̕ҏW: ');
define('_ITEMLIST_YOUR',			'���Ȃ��̃A�C�e��');

// Comments
define('_COMMENTS',					'�R�����g');
define('_NOCOMMENTS',				'���̃A�C�e���ւ̃R�����g�͂���܂���');
define('_COMMENTS_YOUR',			'���Ȃ��̃R�����g');
define('_NOCOMMENTS_YOUR',			'���Ȃ��̃R�����g�͂���܂���');

// LISTS (general)
define('_LISTS_NOMORE',				'��������܂���');
define('_LISTS_PREV',				'�O��');
define('_LISTS_NEXT',				'����');
define('_LISTS_SEARCH',				'����');
define('_LISTS_CHANGE',				'�ύX');
define('_LISTS_PERPAGE',			'�A�C�e��/�y�[�W');
define('_LISTS_ACTIONS',			'�A�N�V����');
define('_LISTS_DELETE',				'�폜');
define('_LISTS_EDIT',				'�ҏW');
define('_LISTS_MOVE',				'�ړ�');
define('_LISTS_CLONE',				'����');
define('_LISTS_TITLE',				'�^�C�g��');
define('_LISTS_BLOG',				'Blog');
define('_LISTS_NAME',				'���O');
define('_LISTS_DESC',				'����');
define('_LISTS_TIME',				'����');
define('_LISTS_COMMENTS',			'�R�����g');
define('_LISTS_TYPE',				'type');


// member list 
define('_LIST_MEMBER_NAME',			'���O');
define('_LIST_MEMBER_RNAME',		'�{��');
define('_LIST_MEMBER_ADMIN',		'Super-admin���� ');
define('_LIST_MEMBER_LOGIN',		'���O�C���\\');
define('_LIST_MEMBER_URL',			'Web�T�C�g');

// banlist
define('_LIST_BAN_IPRANGE',			'IP�͈̔�');
define('_LIST_BAN_REASON',			'���R');

// actionlist
define('_LIST_ACTION_MSG',			'���b�Z�[�W');

// commentlist
define('_LIST_COMMENT_BANIP',		'�֎~IP');
define('_LIST_COMMENT_WHO',			'���');
define('_LIST_COMMENT',				'�R�����g');
define('_LIST_COMMENT_HOST',		'�z�X�g');

// itemlist
define('_LIST_ITEM_INFO',			'���');
define('_LIST_ITEM_CONTENT',		'�^�C�g���Ɩ{��');


// teamlist
define('_LIST_TEAM_ADMIN',			'�Ǘ��Ҍ��� ');
define('_LIST_TEAM_CHADMIN',		'�Ǘ��Ҍ����̕ύX');

// edit comments
define('_EDITC_TITLE',				'�R�����g�̕ҏW');
define('_EDITC_WHO',				'���');
define('_EDITC_HOST',				'Host');
define('_EDITC_WHEN',				'����');
define('_EDITC_TEXT',				'�{��');
define('_EDITC_EDIT',				'�R�����g�̕ҏW');
define('_EDITC_MEMBER',				'�����o�[');
define('_EDITC_NONMEMBER',			'�񃁃��o�[');

// move item
define('_MOVE_TITLE',				'�ǂ�blog�Ɉړ����܂���?');
define('_MOVE_BTN',					'�A�C�e�����ړ�����');

?>
