<?php
// Korean Nucleus Language File
// 
// Author: 노정용(Jungyong Ro) (http://www.ibizkorea.com, laotzu@ibizkorea.com)
// Nucleus version: v1.0-v2.5 based with enamu & sicrone
//

// START changed/added after 3.1 START

// account activation
define('_ERROR_NOLOGON_NOACTIVATE',	'화설화 링크를 보낼수 없습니다. 로그인 하실수 없습니다.');
define('_ERROR_ACTIVATE',			'활성화 키가 없거나 맞지않거나 폐기되었습니다.');
define('_ACTIONLOG_ACTIVATIONLINK', '활성화 링크를 보냈음');
define('_MSG_ACTIVATION_SENT',		'활성화 링크가 이메일로 보내졌습니다.');

// activation link emails
define('_ACTIVATE_REGISTER_MAIL',	"안녕하세요 <%memberName%>님,\n\n<%siteName%> (<%siteUrl%>)의 계정을 활성화 하기 위해서는\n다음의 링크를 클릭하십시오: \n\n\t<%activationUrl%>\n\n이 메일을 받은지 2일이 지날경우 활성화 링크가 옯바르지 않다고 표시됩니다.");
define('_ACTIVATE_REGISTER_MAILTITLE',	"'<%memberName%>'의 계정 활성화");
define('_ACTIVATE_REGISTER_TITLE',	'환영합니다 <%memberName%>님');
define('_ACTIVATE_REGISTER_TEXT',	'아래의 계정에 맞는 암호를 선택해 주십시오');
define('_ACTIVATE_FORGOT_MAIL',		"안녕하세요 <%memberName%>님,\n\n 아래의 링크를 이용해서 <%siteName%> (<%siteUrl%>)의 계정의 새암호를 선택해 주십시오.\n\n\t<%activationUrl%>\n\n이틀이 경과하면 이 활성화 링크는 사용할수 없게됩니다.");
define('_ACTIVATE_FORGOT_MAILTITLE',"'<%memberName%>' 계정 재활성화");
define('_ACTIVATE_FORGOT_TITLE',	'환영합니다 <%memberName%>');
define('_ACTIVATE_FORGOT_TEXT',		'아래 귀하의 계정을 위한 새 암호를 선택하십시오:');
define('_ACTIVATE_CHANGE_MAIL',		"안녕하세요 <%memberName%>님,\n\n귀하의 이메일 주소가 변경되었습니다. 이에따라 <%siteName%> (<%siteUrl%>)의 계정 재활성화가 필요합니다..\n아래의 링크를 방문하십시오: \n\n\t<%activationUrl%>\n\n이틀이 경과하면 이 활성화 링크는 사용할수 없게됩니다.");
define('_ACTIVATE_CHANGE_MAILTITLE'," '<%memberName%>' 계정 재활성화");
define('_ACTIVATE_CHANGE_TITLE',	'환영합니다 <%memberName%>님');
define('_ACTIVATE_CHANGE_TEXT',		'바뀐 메일주소가 확인되었습니다. 감사합니다!');
define('_ACTIVATE_SUCCESS_TITLE',	'활성화 성공');
define('_ACTIVATE_SUCCESS_TEXT',	'귀하의 계정은 성공적으로 활성화 되었습니다.');
define('_MEMBERS_SETPWD',			'암호 설정');
define('_MEMBERS_SETPWD_BTN',		'암호 설정');
define('_QMENU_ACTIVATE',			'계정 활성화');
define('_QMENU_ACTIVATE_TEXT',		'<p>귀하의 계정을 활성화 시겼다면 다음의 링크를 클릭하셔서 <a href="index.php?action=showlogin">로그인</a>하십시오..</p>');

define('_PLUGS_BTN_UPDATE',			'구독 리스트 갱신');

// global settings 
define('_SETTINGS_JSTOOLBAR',		'자바스크립트 툴바 스타일');
define('_SETTINGS_JSTOOLBAR_FULL',	'풀 툴바 (IE)');
define('_SETTINGS_JSTOOLBAR_SIMPLE','심플 툴바 (Non-IE)');
define('_SETTINGS_JSTOOLBAR_NONE',	'툴바 사용않함');
define('_SETTINGS_URLMODE_HELP',	'(Info: <a href="documentation/tips.html#searchengines-fancyurls">팬시 URL을 사용하는 방법</a>)');

// extra plugin settings part when editing categories/members/blogs/...
define('_PLUGINS_EXTRA',			'추가 플러그인');

// itemlist info column keys
define('_LIST_ITEM_BLOG',			'블로그:');
define('_LIST_ITEM_CAT',			'범주:');
define('_LIST_ITEM_AUTHOR',			'저자:');
define('_LIST_ITEM_DATE',			'날짜:');
define('_LIST_ITEM_TIME',			'시간:');

// indication of registered members in comments list
define('_LIST_COMMENTS_MEMBER', 	'(회원)');

// batch operations
define('_BATCH_WITH_SEL',			'선택된 것:');
define('_BATCH_EXEC',				'실행');

// quickmenu
define('_QMENU_HOME',				'홈');
define('_QMENU_ADD',				'글 올리기');
define('_QMENU_ADD_SELECT',			'-- 선택 --');
define('_QMENU_USER_SETTINGS',		'당신의 정보');
define('_QMENU_USER_ITEMS',			'당신의 글들');
define('_QMENU_USER_COMMENTS',		'당신의 코멘트');
define('_QMENU_MANAGE',				'관리');
define('_QMENU_MANAGE_LOG',			'액션로그');
define('_QMENU_MANAGE_SETTINGS',	'일반설정');
define('_QMENU_MANAGE_MEMBERS',		'회원관리');
define('_QMENU_MANAGE_NEWBLOG',		'새 웹로그');
define('_QMENU_MANAGE_BACKUPS',		'백업');
define('_QMENU_MANAGE_PLUGINS',		'플러그인');
define('_QMENU_LAYOUT',				'화면배치');
define('_QMENU_LAYOUT_SKINS',		'스킨');
define('_QMENU_LAYOUT_TEMPL',		'템플릿');
define('_QMENU_LAYOUT_IEXPORT',		'내보내기/가져오기');
define('_QMENU_PLUGINS',			'플러그인');

// quickmenu on logon screen
define('_QMENU_INTRO',				'소개');
define('_QMENU_INTRO_TEXT',			'<p>이곳은 뉴클리어스를 위한 로그온 화면입니다.</p><p>계정을 가지고 있으면 로그온 한뒤 새로운 글을 올릴수 있습니다.</p>');

// helppages for plugins
define('_ERROR_PLUGNOHELPFILE',		'이 플러그인을 위한 도움글 파일이 업습니다.');
define('_PLUGS_HELP_TITLE',			'플러그인을 위한 도움글');
define('_LIST_PLUGS_HELP', 			'도움말');

// END changed/started after 3.1
// START changed/added after v2.5beta START

// general settings (security)
define('_SETTINGS_EXTAUTH',			'외부인증받기');
define('_WARNING_EXTAUTH',			'경고: 필요한 경우에만 사용.');

// member profile
define('_MEMBERS_BYPASS',			'외부인증 사용');

// 'always include in search' blog setting (yes/no) [in v2.5beta, the 'always' part wasn't clear]
define('_EBLOG_SEARCH',				'<em>항상</em> 검색에 포함');

// END changed/added after v2.5beta

// START introduced after v2.0 START

// media library
define('_MEDIA_VIEW',				'보기');
define('_MEDIA_VIEW_TT',			'파일 보기 (새창으로 열기)');
define('_MEDIA_FILTER_APPLY',		'필터 적용');
define('_MEDIA_FILTER_LABEL',		'필터: ');
define('_MEDIA_UPLOAD_TO',			'업로드할곳...');
define('_MEDIA_UPLOAD_NEW',			'새파일 업로드...');
define('_MEDIA_COLLECTION_SELECT',	'선택');
define('_MEDIA_COLLECTION_TT',		'이 카테고리로 변경');
define('_MEDIA_COLLECTION_LABEL',	'현재모음: ');

// tooltips on toolbar
define('_ADD_ALIGNLEFT_TT',			'왼쪽 정렬');
define('_ADD_ALIGNRIGHT_TT',		'오른쪽 정렬');
define('_ADD_ALIGNCENTER_TT',		'가운데 정렬');


// generic upload failure
define('_ERROR_UPLOADFAILED',		'업로드 실패');

// END introduced after v2.0 END

// START introduced after v1.5 START

// posting to the past/edit timestamps
define('_EBLOG_ALLOWPASTPOSTING',	'과거시간으로 글올리기 허락');
define('_ADD_CHANGEDATE',			'시간기록 갱신');
define('_BMLET_CHANGEDATE',			'시간기록 갱신');

// skin import/export
define('_OVERVIEW_SKINIMPORT',		'스킨 불러오기/내보내기...');

// skin settings
define('_PARSER_INCMODE_NORMAL',	'일반');
define('_PARSER_INCMODE_SKINDIR',	'사용자 스킨 디렉토리');
define('_SKIN_INCLUDE_MODE',		'모드포함');
define('_SKIN_INCLUDE_PREFIX',		'두문포함');

// global settings
define('_SETTINGS_BASESKIN',		'기본스킨');
define('_SETTINGS_SKINSURL',		'스킨 주소');
define('_SETTINGS_ACTIONSURL',		'action.php의 전체주소');

// category moves (batch)
define('_ERROR_MOVEDEFCATEGORY',	'지정된 카테고리로 이동할수 없습니다');
define('_ERROR_MOVETOSELF',			'카테고리를 이동할수 없습니다 (이동할 블로그와 현재 블로그가 같습니다)');
define('_MOVECAT_TITLE',			'이동할 카테고리를 선택하시오');
define('_MOVECAT_BTN',				'카테고리 이동');

// URLMode setting
define('_SETTINGS_URLMODE',			'URL 모드');
define('_SETTINGS_URLMODE_NORMAL',	'일반');
define('_SETTINGS_URLMODE_PATHINFO','팬시');

// Batch operations
define('_BATCH_NOSELECTION',		'실행할 것이 선택되지 않았습니다');
define('_BATCH_ITEMS',				'아이템에 대한 일괄실행작업');
define('_BATCH_CATEGORIES',			'카테고리에 대한 일괄실행작업');
define('_BATCH_MEMBERS',			'회원에 대한 일괄실행작업');
define('_BATCH_TEAM',				'팀멤버에 대한 일괄실행작업');
define('_BATCH_COMMENTS',			'커맨터에 대한 일괄실행작업');
define('_BATCH_UNKNOWN',			'알수없는 일괄실행작업: ');
define('_BATCH_EXECUTING',			'실행');
define('_BATCH_ONCATEGORY',			'카테고리');
define('_BATCH_ONITEM',				'아이템');
define('_BATCH_ONCOMMENT',			'커맨터');
define('_BATCH_ONMEMBER',			'회원');
define('_BATCH_ONTEAM',				'팀멤버');
define('_BATCH_SUCCESS',			'성공!');
define('_BATCH_DONE',				'완료!');
define('_BATCH_DELETE_CONFIRM',		'일괄삭제 확인');
define('_BATCH_DELETE_CONFIRM_BTN',	'일괄삭제 확인');
define('_BATCH_SELECTALL',			'모두 선택');
define('_BATCH_DESELECTALL',		'모두 비선택');

// batch operations: options in dropdowns
define('_BATCH_ITEM_DELETE',		'삭제');
define('_BATCH_ITEM_MOVE',			'이동');
define('_BATCH_MEMBER_DELETE',		'삭제');
define('_BATCH_MEMBER_SET_ADM',		'운영자 권한 부여');
define('_BATCH_MEMBER_UNSET_ADM',	'운영자 권한 박탈');
define('_BATCH_TEAM_DELETE',		'팀에서 삭제');
define('_BATCH_TEAM_SET_ADM',		'운영자 권한 부여');
define('_BATCH_TEAM_UNSET_ADM',		'운영자 권한 박탈');
define('_BATCH_CAT_DELETE',			'삭제');
define('_BATCH_CAT_MOVE',			'다른 블로그로 이동');
define('_BATCH_COMMENT_DELETE',		'삭제');

// itemlist: Add new item...
define('_ITEMLIST_ADDNEW',			'새로운 아이템 추가...');
define('_ADD_PLUGIN_EXTRAS',		'추가 플러그인 옵션');

// errors
define('_ERROR_CATCREATEFAIL',		'새로운 카테고리 생성에 실패했습니다');
define('_ERROR_NUCLEUSVERSIONREQ',	'이 플러그인은 새 Nucleus버전이 필요합니다.: ');

// backlinks
define('_BACK_TO_BLOGSETTINGS',		'블로그 제어판으로 돌아가기');

// skin import export
define('_SKINIE_TITLE_IMPORT',		'가져오기');
define('_SKINIE_TITLE_EXPORT',		'내보내기');
define('_SKINIE_BTN_IMPORT',		'가져오기');
define('_SKINIE_BTN_EXPORT',		'선택된 스킨/템플릿 내보내기');
define('_SKINIE_LOCAL',				'파일로 부터 가져오기:');
define('_SKINIE_NOCANDIDATES',		'스킨디렉토리에 가져올 스킨이 없습니다');
define('_SKINIE_FROMURL',			'URL로부터 가져오기:');
define('_SKINIE_EXPORT_INTRO',		'아래에서 내보낼 스킨과 템플릿을 선택하십시오');
define('_SKINIE_EXPORT_SKINS',		'스킨');
define('_SKINIE_EXPORT_TEMPLATES',	'템플릿');
define('_SKINIE_EXPORT_EXTRA',		'추가정보');
define('_SKINIE_CONFIRM_OVERWRITE',	'기존에 있는 스킨 덮어쓰기 (이름 충돌)');
define('_SKINIE_CONFIRM_IMPORT',	'예, 이것을 가져오겠습니다.');
define('_SKINIE_CONFIRM_TITLE',		'내보낼 스킨과 템플릿에 대해');
define('_SKINIE_INFO_SKINS',		'파일에 있는 스킨:');
define('_SKINIE_INFO_TEMPLATES',	'파일에 있는 템플릿:');
define('_SKINIE_INFO_GENERAL',		'정보:');
define('_SKINIE_INFO_SKINCLASH',	'스킨 이름 충돌:');
define('_SKINIE_INFO_TEMPLCLASH',	'템플릿 이름 충돌:');
define('_SKINIE_INFO_IMPORTEDSKINS','스킨 내보내기:');
define('_SKINIE_INFO_IMPORTEDTEMPLS','템플릿 내보내기:');
define('_SKINIE_DONE',				'내보내기 완료');

define('_AND',						'and');
define('_OR',						'or');

// empty fields on template edit
define('_EDITTEMPLATE_EMPTY',		'빈 필드(편집하려면 클릭)');

// skin overview list
define('_LIST_SKINS_INCMODE',		'모드포함:');
define('_LIST_SKINS_INCPREFIX',		'서두포함:');
define('_LIST_SKINS_defineD',		'부분정의:');

// backup
define('_BACKUPS_TITLE',			'백업하기 / 복원하기');
define('_BACKUP_TITLE',				'백업');
define('_BACKUP_INTRO',				'Nucleus자료를 백업하려면 아래의 버튼을 누르세요.그러면 백업파일이 생성됩니다. 그것을 안전한 장소에 보관하십시오.');
define('_BACKUP_ZIP_YES',			'압축 하십시오');
define('_BACKUP_ZIP_NO',			'압축하지 마십시오');
define('_BACKUP_BTN',				'백업생성');
define('_BACKUP_NOTE',				'<b>주의:</b> 데이터내용만 백업에 저장됩니다. config.php에 포함된 미디어파일과 셋팅은 백업파일에 저장되지 않습니다.');
define('_RESTORE_TITLE',			'복원하기');
define('_RESTORE_NOTE',				'<b>경고:</b> 백업파일로 부터 복원하면 기존의 파일은 모두 삭제됩니다. 그래도 실행하시겠습니까?  <br />	<b>주의:</b> Nucleus에 복원하려는 파일이 현재의 버전과 같아야 합니다. 버전이 다르면 정상적으로 작동하지 않습니다.');
define('_RESTORE_INTRO',			'아래에서 백업파일을 선택하시오. (서버에 업로드 합니다) 복원버튼을 누르면 시작합니다.');
define('_RESTORE_IMSURE',			'예, 이작업을 실행하겠습니다!');
define('_RESTORE_BTN',				'파일로 부터 복원');
define('_RESTORE_WARNING',			'(정상적으로 백업작업을 완료했으면 시작하기 전에 새로운 백업을 실시하기를 권장합니다.)');
define('_ERROR_BACKUP_NOTSURE',		'확인 테스트박스를 체크하십시오');
define('_RESTORE_COMPLETE',			'복원 완료');

// new item notification
define('_NOTIFY_NI_MSG',			'새로운 글이 올려졌습니다:');
define('_NOTIFY_NI_TITLE',			'새글!');
define('_NOTIFY_KV_MSG',			'글에 대한 Karma 투표:');
define('_NOTIFY_KV_TITLE',			'Nucleus karma:');
define('_NOTIFY_NC_MSG',			'글에 대한 커맨트:');
define('_NOTIFY_NC_TITLE',			'Nucleus 커맨트:');
define('_NOTIFY_USERID',			'이용자 ID:');
define('_NOTIFY_USER',				'이용자:');
define('_NOTIFY_COMMENT',			'커맨트:');
define('_NOTIFY_VOTE',				'투표:');
define('_NOTIFY_HOST',				'호스트:');
define('_NOTIFY_IP',				'IP:');
define('_NOTIFY_MEMBER',			'회원:');
define('_NOTIFY_TITLE',				'제목:');
define('_NOTIFY_CONTENTS',			'내용:');

// member mail message
define('_MMAIL_MSG',				'메시지가 당신에게 도착했습니다');
define('_MMAIL_FROMANON',			'익명의 방문자');
define('_MMAIL_FROMNUC',			'Nucleus 웹로그에 글올리기');
define('_MMAIL_TITLE',				'메시지');
define('_MMAIL_MAIL',				'메시지:');

// END introduced after v1.5 END


// START introduced after v1.1 START

// bookmarklet buttons
define('_BMLET_ADD',				'새글 쓰기');
define('_BMLET_EDIT',				'글 수정');
define('_BMLET_DELETE',				'글 삭제');
define('_BMLET_BODY',				'본문');
define('_BMLET_MORE',				'확장본문');
define('_BMLET_OPTIONS',			'옵션');
define('_BMLET_PREVIEW',			'미리보기');

// used in bookmarklet
define('_ITEM_UPDATED',				'글이 업데이트되었습니다.');
define('_ITEM_DELETED',				'글이 삭제되었습니다.');

// plugins
define('_CONFIRMTXT_PLUGIN',		'다음 플러그인을 정말로 삭제하시겠습니까');
define('_ERROR_NOSUCHPLUGIN',		'그런 플러그인은 없습니다');
define('_ERROR_DUPPLUGIN',			'이 플러그인은 이미 설치되어있습니다');
define('_ERROR_PLUGFILEERROR',		'그런 플러그인이 없거나 권한설정이 잘못되어 있습니다');
define('_PLUGS_NOCANDIDATES',		'플러그인 후보를 찾지 못했습니다');

define('_PLUGS_TITLE_MANAGE',		'플러그인 관리');
define('_PLUGS_TITLE_INSTALLED',	'현재 설치된 플러그인');
define('_PLUGS_TITLE_UPDATE',		'구독목록 갱신');
define('_PLUGS_TEXT_UPDATE',		'Nucleus는 플러그인들의 이벤트 구독을 캐시로 보관합니다. 플러그인 파일을 대치하여 업그레이드하려면, 구독 내용이 정확히 캐시되도록 이 업데이트를 수행해야만 합니다.');
define('_PLUGS_TITLE_NEW',			'새 플러그인 설치');
define('_PLUGS_ADD_TEXT',			'다음은 사용자의 플러그인 디렉토리에 있는 모든 파일들의 목록입니다. 설치되지 않은 플러그인이 포함되어있을 수도 있습니다. 추가하기 전에 <strong>반드시</strong> 그것이 적절한 플러그인인지 확인하시기 바랍니다.');
define('_PLUGS_BTN_INSTALL',		'플러그인 설치');
define('_BACKTOOVERVIEW',			'상위메뉴로 돌아가기');

// editlink
define('_TEMPLATE_EDITLINK',		'글의 링크 수정');

// add left / add right tooltips
define('_ADD_LEFT_TT',				'글 박스 추가');
define('_ADD_RIGHT_TT',				'오른쪽 박스 추가');

// add/edit item: new category (in dropdown box)
define('_ADD_NEWCAT',				'새 카테고리');

// new settings
define('_SETTINGS_PLUGINURL',		'플러그인 URL');
define('_SETTINGS_MAXUPLOADSIZE',	'업로드 파일의 최대크기 (바이트)');
define('_SETTINGS_NONMEMBERMSGS',	'비회원에게 메시지 전송 허락');
define('_SETTINGS_PROTECTMEMNAMES',	'회원의 실명 보호');

// overview screen
define('_OVERVIEW_PLUGINS',			'플러그인 관리...');

// actionlog
define('_ACTIONLOG_NEWMEMBER',		'신규회원 등록:');

// membermail (when not logged in)
define('_MEMBERMAIL_MAIL',			'당신의 이메일 주소:');

// file upload
define('_ERROR_DISALLOWEDUPLOAD2',	'당신은 팀리스트의 해당 회원이 속한 블로그의 관리자가 아닙니다. 그러므로 이 멤버의 미디어 디렉토리에 파일을 업로드 할 수 없습니다.');

// plugin list
define('_LISTS_INFO',				'정보');
define('_LIST_PLUGS_AUTHOR',		'저자:');
define('_LIST_PLUGS_VER',			'버전:');
define('_LIST_PLUGS_SITE',			'사이트 방문');
define('_LIST_PLUGS_DESC',			'안내:');
define('_LIST_PLUGS_SUBS',			'다음 이벤트 구독:');
define('_LIST_PLUGS_UP',			'위로 이동');
define('_LIST_PLUGS_DOWN',			'아래로 이동');
define('_LIST_PLUGS_UNINSTALL',		'제거하기');
define('_LIST_PLUGS_ADMIN',			'관리');
define('_LIST_PLUGS_OPTIONS',		'옵션& 변경');

// plugin option list
define('_LISTS_VALUE',				'값');

// plugin options
define('_ERROR_NOPLUGOPTIONS',		'플러그인에 대한 아무런 옵션도 설정되지 않았습니다');
define('_PLUGS_BACK',				'플러그인 전체보기로 돌아가기');
define('_PLUGS_SAVE',				'옵션 저장');
define('_PLUGS_OPTIONS_UPDATED',	'플러그인 옵션을 갱신하였습니다');

define('_OVERVIEW_MANAGEMENT',		'관리');
define('_OVERVIEW_MANAGE',			'뉴클리어스 관리...');
define('_MANAGE_GENERAL',			'일반적 관리');
define('_MANAGE_SKINS',				'스킨과 템플릿');
define('_MANAGE_EXTRA',				'추가 기능들');

define('_BACKTOMANAGE',				'Nucleus 관리화면으로 돌아가기');


// END introduced after v1.1 END




// charset to use 
define('_CHARSET',					'utf-8');

// global stuff
define('_LOGOUT',					'로그아웃');
define('_LOGIN',					'로그인');
define('_YES',						'예');
define('_NO',						'아니오');
define('_SUBMIT',					'확인');
define('_ERROR',					'오류');
define('_ERRORMSG',					'오류가 발생했습니다!');
define('_BACK',						'돌아가기');
define('_NOTLOGGEDIN',				'로그인을 하지 않았습니다.');
define('_LOGGEDINAS',				'로그인 이름:');
define('_ADMINHOME',				'관리페이지');
define('_NAME',						'이름');
define('_BACKHOME',					'관리페이지로 돌아가기');
define('_BADACTION',				'요청한 작업을 수행할 수 없습니다.');
define('_MESSAGE',					'메시지');
define('_HELP_TT',					'도움말 보기');
define('_YOURSITE',					'당신의 사이트');


define('_POPUP_CLOSE',				'팝업창 닫기');

define('_LOGIN_PLEASE',				'먼저 로그인 해주세요.');

// commentform
define('_COMMENTFORM_YOUARE',		'당신은');
define('_COMMENTFORM_SUBMIT',		'코멘트 추가');
define('_COMMENTFORM_COMMENT',		'당신의 코멘트');
define('_COMMENTFORM_NAME',			'이름');
define('_COMMENTFORM_MAIL',			'이메일/홈페이지');
define('_COMMENTFORM_REMEMBER',		'내정보 기억');

// loginform
define('_LOGINFORM_NAME',			'사용자ID');
define('_LOGINFORM_PWD',			'암호');
define('_LOGINFORM_YOUARE',			'로그인 이름:');
define('_LOGINFORM_SHARED',			'공유 컴퓨터');

// member mailform
define('_MEMBERMAIL_SUBMIT',		'메시지 보내기');

// search form
define('_SEARCHFORM_SUBMIT',		'검색');

// add item form
define('_ADD_ADDTO',				'새글 등록:');
define('_ADD_CREATENEW',			'새글 쓰기');
define('_ADD_BODY',					'본문');
define('_ADD_TITLE',				'제목');
define('_ADD_MORE',					'확장본문(옵션)');
define('_ADD_CATEGORY',				'카테고리');
define('_ADD_PREVIEW',				'미리보기');
define('_ADD_DISABLE_COMMENTS',		'코멘트 금지?');
define('_ADD_DRAFTNFUTURE',			'초안 &amp; 미리 써두기');
define('_ADD_ADDITEM',				'글 등록');
define('_ADD_ADDNOW',				'지금 등록');
define('_ADD_ADDLATER',				'나중에 등록');
define('_ADD_PLACE_ON',				'다음과 같이 등록:');
define('_ADD_ADDDRAFT',				'초안으로 등록');
define('_ADD_NOPASTDATES',			'(날짜나 시간을 현재 이전으로 설정할 수는 없으며, 그런 경우 현재 시간으로 설정됩니다)');
define('_ADD_BOLD_TT',				'볼드체');
define('_ADD_ITALIC_TT',			'이탤릭체');
define('_ADD_HREF_TT',				'링크 만들기');
define('_ADD_MEDIA_TT',				'미디어 추가');
define('_ADD_PREVIEW_TT',			'미리보기 보기/가리기');
define('_ADD_CUT_TT',				'잘라내기');
define('_ADD_COPY_TT',				'복사하기');
define('_ADD_PASTE_TT',				'붙이기');


// edit item form
define('_EDIT_ITEM',				'글 수정');
define('_EDIT_SUBMIT',				'글 수정');
define('_EDIT_ORIG_AUTHOR',			'첫 작성자');
define('_EDIT_BACKTODRAFTS',		'다시 초안으로 등록');
define('_EDIT_COMMENTSNOTE',		'(참고: 코멘트를 금지해도 기존의 코멘트는 볼 수 있습니다)');

// used on delete screens
define('_DELETE_CONFIRM',			'정말로 삭제하시겠습니까?');
define('_DELETE_CONFIRM_BTN',		'삭제 확인');
define('_CONFIRMTXT_ITEM',			'다음 글을 삭제하려합니다:');
define('_CONFIRMTXT_COMMENT',		'다음 코멘트를 삭제하려합니다.:');
define('_CONFIRMTXT_TEAM1',			'삭제하려합니다 ');
define('_CONFIRMTXT_TEAM2',			' 블로그의 팀 목록으로부터 ');
define('_CONFIRMTXT_BLOG',			'다음 블로그를 삭제하려합니다: ');
define('_WARNINGTXT_BLOGDEL',		'경고! 블로그를 삭제하면 블로그에 저장된 모든 글과 코멘트가 삭제됩니다. 정말로 이 모든 내용을 삭제하시겠습니까?<br />그리고, Nucleus가 블로그를 삭제하는 동안 아무 것도 누르지 마십시오.');
define('_CONFIRMTXT_MEMBER',		'다음 회원의 프로필을 삭제하려합니다: ');
define('_CONFIRMTXT_TEMPLATE',		'다음 템플릿을 삭제하려합니다: ');
define('_CONFIRMTXT_SKIN',			'다음 스킨을 삭제하려합니다: ');
define('_CONFIRMTXT_BAN',			'다음 IP 접근금지 설정을 삭제하려합니다: ');
define('_CONFIRMTXT_CATEGORY',		'다음 카테고리를 삭제하려합니다: ');

// some status messages
define('_DELETED_ITEM',				'글을 삭제하였습니다');
define('_DELETED_MEMBER',			'회원를 삭제하였습니다');
define('_DELETED_COMMENT',			'코멘트를 삭제하였습니다');
define('_DELETED_BLOG',				'블로그를 삭제하였습니다');
define('_DELETED_CATEGORY',			'카테고리를 삭제하였습니다');
define('_ITEM_MOVED',				'글을 이동하였습니다');
define('_ITEM_ADDED',				'글을 추가하였습니다');
define('_COMMENT_UPDATED',			'코멘트를 갱신하였습니다');
define('_SKIN_UPDATED',				'스킨 데이터를 저장하였습니다');
define('_TEMPLATE_UPDATED',			'템플릿 데이터를 저장하였습니다');

// errors
define('_ERROR_COMMENT_LONGWORD',	'코멘트의 한 단어는 45자를 넘을 수 없습니다');
define('_ERROR_COMMENT_NOCOMMENT',	'코멘트를 입력하세요');
define('_ERROR_COMMENT_NOUSERNAME',	'잘못된 사용자 이름');
define('_ERROR_COMMENT_TOOLONG',	'코멘트가 너무 깁니다(영문 기준 최대 5,000자).');
define('_ERROR_COMMENTS_DISABLED',	'이 블로그는 현재 코멘트 기능을 사용하지 않습니다.');
define('_ERROR_COMMENTS_NONPUBLIC',	'이 블로그에 코멘트를 달기 위해선 먼저 로그인을 해야합니다');
define('_ERROR_COMMENTS_MEMBERNICK','사용하려는 이름은 이미 사이트의 회원이 사용중인 이름입니다. 다른 이름을 선택하세요.');
define('_ERROR_SKIN',				'스킨 오류');
define('_ERROR_ITEMCLOSED',			'이 글은 폐쇄되었으므로, 더 이상 코멘트를 달거나 투표할 수 없습니다');
define('_ERROR_NOSUCHITEM',			'그런 글이 없습니다');
define('_ERROR_NOSUCHBLOG',			'그런 블로그가 없습니다');
define('_ERROR_NOSUCHSKIN',			'그런 스킨이 없습니다');
define('_ERROR_NOSUCHMEMBER',		'그런 회원이 없습니다');
define('_ERROR_NOTONTEAM',			'이 웹로그의 팀리스트에 가입되지 않았습니다.');
define('_ERROR_BADDESTBLOG',		'이동하려는 블로그가 없습니다');
define('_ERROR_NOTONDESTTEAM',		'이동하려는 블로그의 팀리스트에 가입되지 않았으므로, 글을 옮길 수 없습니다');
define('_ERROR_NOEMPTYITEMS',		'내용이 비어있습니다!');
define('_ERROR_BADMAILADDRESS',		'제대로 된 이메일 주소가 아닙니다');
define('_ERROR_BADNOTIFY',			'입력한 이메일 주소 중에 틀린 이메일 주소가 있습니다');
define('_ERROR_BADNAME',			'잘못된 이름입니다 ( a-z 또는 0-9 만 사용하실 수 있으며, 처음과 끝에 여백이 없어야 합니다)');
define('_ERROR_NICKNAMEINUSE',		'다른 회원이 이미 그 이름을 사용중입니다');
define('_ERROR_PASSWORDMISMATCH',	'암호가 일치해야합니다');
define('_ERROR_PASSWORDTOOSHORT',	'암호는 최소한 6자 이상이어야합니다');
define('_ERROR_PASSWORDMISSING',	'암호를 입력해야합니다');
define('_ERROR_REALNAMEMISSING',	'실명을 입력해야합니다');
define('_ERROR_ATLEASTONEADMIN',	'관리자 영역에 접근할 수 있는 수퍼-관리자가 적어도 한 명은 있어야 합니다.');
define('_ERROR_ATLEASTONEBLOGADMIN','이렇게 하면 웹로그를 관리할 수 없게 됩니다. 관리자가 적어도 한 명은 있어야 합니다.');
define('_ERROR_ALREADYONTEAM',		'추가하려는 회원은 이미 리스트에 가입되어 있습니다');
define('_ERROR_BADSHORTBLOGNAME',	'짧은 블로그 이름에는 공백없이 a-z 또는 0-9 만 사용할 수 있습니다');
define('_ERROR_DUPSHORTBLOGNAME',	'이 짧은 이름은 이미 사용중입니다. 다른 이름을 선택하세요');
define('_ERROR_UPDATEFILE',			'갱신할 파일에 대한 쓰기 권한이 없습니다. 파일 권한을 확인해보세요 (chmod 666으로 권한을 설정해주세요). 또한 주소는 관리자 영역 디렉토리에 대한 상대경로이므로, 절대경로로 설정해도 좋습니다 (예를 들어 /your/path/to/nucleus/)');
define('_ERROR_DELDEFBLOG',			'기본설정된 블로그는 삭제할 수 없습니다');
define('_ERROR_DELETEMEMBER',		'이 회원은 삭제할 수 없습니다. 글이나 코멘트를 쓴 회원일지도 모릅니다');
define('_ERROR_BADTEMPLATENAME',	'템플릿 이름에는 공백없이 a-z 또는 0-9 만 사용할 수 있습니다');
define('_ERROR_DUPTEMPLATENAME',	'이 템플릿 이름은 이미 사용중입니다');
define('_ERROR_BADSKINNAME',		'스킨 이름에는 공백없이 a-z 또는 0-9 만 사용할 수 있습니다');
define('_ERROR_DUPSKINNAME',		'이 스킨 이름은 이미 사용중입니다');
define('_ERROR_DEFAULTSKIN',		'"default"라는 이름의 스킨은 항상 존재해야만 합니다');
define('_ERROR_SKINDEFDELETE',		'이 스킨은 다음 웹로그의 기본 스킨이므로 삭제할 수 없습니다 : ');
define('_ERROR_DISALLOWED',			'죄송합니다. 이 작업에 대한 권한이 없습니다');
define('_ERROR_DELETEBAN',			'삭제할 접근금지 설정이 없습니다');
define('_ERROR_ADDBAN',				'접근금지 설정을 추가하는 도중 오류가 발생했습니다. 설정이 제대로 추가되지 않았을수도 있습니다.');
define('_ERROR_BADACTION',			'요청한 작업은 존재하지 않습니다');
define('_ERROR_MEMBERMAILDISABLED',	'회원간 메일전송 기능이 꺼져있습니다');
define('_ERROR_MEMBERCREATEDISABLED','회원 계정 생성 기능이 꺼져있습니다');
define('_ERROR_INCORRECTEMAIL',		'틀린 이메일 주소입니다');
define('_ERROR_VOTEDBEFORE',		'이미 이 글에 투표했습니다');
define('_ERROR_BANNED1',			'다음 사용자는 (ip range ');
define('_ERROR_BANNED2',			') 해당 작업을 할 수 없습니다. 메시지는: \'');
define('_ERROR_BANNED3',			'\'');
define('_ERROR_LOGINNEEDED',		'이 작업을 하려면 먼저 로그인해야합니다');
define('_ERROR_CONNECT',			'접속 오류');
define('_ERROR_FILE_TOO_BIG',		'파일이 너무 큽니다!');
define('_ERROR_BADFILETYPE',		'죄송합니다. 이 유형의 파일은 올릴 수 없습니다');
define('_ERROR_BADREQUEST',			'잘못된 업로드 요청입니다');
define('_ERROR_DISALLOWEDUPLOAD',	'어떤 웹로그 팀에도 가입되지 않았으므로 파일을 업로드할 수 없습니다');
define('_ERROR_BADPERMISSIONS',		'파일/디렉토리 권한이 잘못 설정되어있습니다');
define('_ERROR_UPLOADMOVEP',		'업로드된 파일을 이동하는 중 오류가 발생했습니다');
define('_ERROR_UPLOADCOPY',			'파일을 복사하는 중 오류가 발생했습니다');
define('_ERROR_UPLOADDUPLICATE',	'같은 이름의 파일이 이미 존재합니다. 이름을 바꾼 후 다시 업로드하세요.');
define('_ERROR_LOGINDISALLOWED',	'관리자 영역에는 들어갈 수 없습니다. 하지만 다른 유저로는 로그인할 수 있습니다');
define('_ERROR_DBCONNECT',			'MySQL 서버에 연결하지 못했습니다');
define('_ERROR_DBSELECT',			'Nucleus 데이터베이스를 선택하지 못했습니다.');
define('_ERROR_NOSUCHLANGUAGE',		'그런 언어 파일은 없습니다');
define('_ERROR_NOSUCHCATEGORY',		'그런 카테고리는 없습니다');
define('_ERROR_DELETELASTCATEGORY',	'카테고리가 적어도 한 개는 있어야합니다');
define('_ERROR_DELETEDEFCATEGORY',	'기본설정 카테고리는 삭제할 수 없습니다');
define('_ERROR_BADCATEGORYNAME',	'잘못된 카테고리 이름입니다');
define('_ERROR_DUPCATEGORYNAME',	'같은 이름의 카테고리가 이미 존재합니다');

// some warnings (used for mediadir setting)
define('_WARNING_NOTADIR',			'경고: 디렉토리가 아닙니다!');
define('_WARNING_NOTREADABLE',		'경고: 읽을 수 있는 디렉토리가 아닙니다!');
define('_WARNING_NOTWRITABLE',		'경고: 쓸 수 있는 디렉토리가 아닙니다!');

// media and upload
define('_MEDIA_UPLOADLINK',			'새 파일 업로드');
define('_MEDIA_MODIFIED',			'날짜');
define('_MEDIA_FILENAME',			'파일이름');
define('_MEDIA_DIMENSIONS',			'크기');
define('_MEDIA_INLINE',				'삽입');
define('_MEDIA_POPUP',				'팝업');
define('_UPLOAD_TITLE',				'파일 선택');
define('_UPLOAD_MSG',				'업로드할 파일을 선택한 후, \'업로드\' 버튼을 누르세요.');
define('_UPLOAD_BUTTON',			'업로드');

// some status messages
define('_MSG_ACCOUNTCREATED',		'계정이 생성되었습니다. 암호는 이메일로 전송됩니다');
define('_MSG_PASSWORDSENT',			'암호가 이메일로 전송되었습니다.');
define('_MSG_LOGINAGAIN',			'설정을 변경하였으므로 다시 로그인해야 합니다');
define('_MSG_SETTINGSCHANGED',		'설정을 변경하였습니다');
define('_MSG_ADMINCHANGED',			'관리자를 변경하였습니다');
define('_MSG_NEWBLOG',				'새 블로그를 생성하였습니다');
define('_MSG_ACTIONLOGCLEARED',		'작업로그를 비웠습니다');

// actionlog in admin area
define('_ACTIONLOG_DISALLOWED',		'작업 허용하지않음: ');
define('_ACTIONLOG_PWDREMINDERSENT','새암호 보냄 ');
define('_ACTIONLOG_TITLE',			'작업로그');
define('_ACTIONLOG_CLEAR_TITLE',	'작업로그 삭제');
define('_ACTIONLOG_CLEAR_TEXT',		'지금 작업로그 삭제');

// team management
define('_TEAM_TITLE',				'다음 블로그에 대한 팀 관리 ');
define('_TEAM_CURRENT',				'현재 팀');
define('_TEAM_ADDNEW',				'팀에 새 회원 추가');
define('_TEAM_CHOOSEMEMBER',		'회원 선택');
define('_TEAM_ADMIN',				'관리자 권한? ');
define('_TEAM_ADD',					'팀에 추가');
define('_TEAM_ADD_BTN',				'팀에 추가');

// blogsettings
define('_EBLOG_TITLE',				'블로그 설정 변경');
define('_EBLOG_TEAM_TITLE',			'팀 변경');
define('_EBLOG_TEAM_TEXT',			'팀을 변경하려면 여기를 클릭하세요.');
define('_EBLOG_SETTINGS_TITLE',		'블로그 설정');
define('_EBLOG_NAME',				'블로그 이름');
define('_EBLOG_SHORTNAME',			'짧은 블로그 이름');
define('_EBLOG_SHORTNAME_EXTRA',	'<br />(여백없이 a-z 만 사용해야합니다)');
define('_EBLOG_DESC',				'블로그 설명');
define('_EBLOG_URL',				'URL');
define('_EBLOG_DEFSKIN',			'기본설정 스킨');
define('_EBLOG_DEFCAT',				'기본설정 카테고리');
define('_EBLOG_LINEBREAKS',			'줄바꿈 자동변환');
define('_EBLOG_DISABLECOMMENTS',	'코멘트 기능 사용?<br /><small>(코멘트 기능을 끄면 코멘트를 남길 수 없습니다.)</small>');
define('_EBLOG_ANONYMOUS',			'비회원도 코멘트 추가 가능?');
define('_EBLOG_NOTIFY',				'알림 주소(들) (;로 구분하세요)');
define('_EBLOG_NOTIFY_ON',			'알림 조건');
define('_EBLOG_NOTIFY_COMMENT',		'새 코멘트');
define('_EBLOG_NOTIFY_KARMA',		'새 카르마 투표');
define('_EBLOG_NOTIFY_ITEM',		'새 글');
define('_EBLOG_PING',				'갱신시 Weblogs.com에 ping을 날릴까요?');
define('_EBLOG_MAXCOMMENTS',		'최대 코멘트 갯수');
define('_EBLOG_UPDATE',				'갱신 파일');
define('_EBLOG_OFFSET',				'시간 조정');
define('_EBLOG_STIME',				'현재 서버 타임');
define('_EBLOG_BTIME',				'현재 블로그 타임');
define('_EBLOG_CHANGE',				'설정 변경');
define('_EBLOG_CHANGE_BTN',			'설정 변경');
define('_EBLOG_ADMIN',				'블로그 관리자');
define('_EBLOG_ADMIN_MSG',			'관리자 권한이 주어집니다');
define('_EBLOG_CREATE_TITLE',		'새 웹로그 생성');
define('_EBLOG_CREATE_TEXT',		'아래의 양식을 통해 새 웹로그를 만들 수 있습니다. <br /><br /> <b>주의:</b> 꼭 필요한 설정만 표시되었습니다. 먼저 웹로그를 만든 후 설정페이지로 이동하여 다른 설정들을 변경할 수 있습니다.');
define('_EBLOG_CREATE',				'생성!');
define('_EBLOG_CREATE_BTN',			'웹로그 생성');
define('_EBLOG_CAT_TITLE',			'카테고리');
define('_EBLOG_CAT_NAME',			'카테고리 이름');
define('_EBLOG_CAT_DESC',			'카테고리 설명');
define('_EBLOG_CAT_CREATE',			'새 카테고리 생성');
define('_EBLOG_CAT_UPDATE',			'카테고리 갱신');
define('_EBLOG_CAT_UPDATE_BTN',		'카테고리 갱신');

// templates
define('_TEMPLATE_TITLE',			'템플릿 수정');
define('_TEMPLATE_AVAILABLE_TITLE',	'사용가능한 템플릿들');
define('_TEMPLATE_NEW_TITLE',		'새 템플릿');
define('_TEMPLATE_NAME',			'템플릿 이름');
define('_TEMPLATE_DESC',			'템플릿 설명');
define('_TEMPLATE_CREATE',			'템플릿 생성');
define('_TEMPLATE_CREATE_BTN',		'템플릿 생성');
define('_TEMPLATE_EDIT_TITLE',		'템플릿 수정');
define('_TEMPLATE_BACK',			'템플릿 오버뷰로 돌아가기');
define('_TEMPLATE_EDIT_MSG',		'꼭 필요하지 않은 부분은 비워두어도 괜찮습니다.');
define('_TEMPLATE_SETTINGS',		'템플릿 설정');
define('_TEMPLATE_ITEMS',			'글들');
define('_TEMPLATE_ITEMHEADER',		'글의 헤더');
define('_TEMPLATE_ITEMBODY',		'글의 본문');
define('_TEMPLATE_ITEMFOOTER',		'글의 푸터');
define('_TEMPLATE_MORELINK',		'확장된 본문으로의 링크');
define('_TEMPLATE_NEW',				'새 글 표시');
define('_TEMPLATE_COMMENTS_ANY',	'코멘트 (있을 경우)');
define('_TEMPLATE_CHEADER',			'코멘트 헤더');
define('_TEMPLATE_CBODY',			'코멘트 본문');
define('_TEMPLATE_CFOOTER',			'코멘트 푸터');
define('_TEMPLATE_CONE',			'코멘트 한 개');
define('_TEMPLATE_CMANY',			'두 개 이상의 코멘트');
define('_TEMPLATE_CMORE',			'코멘트 더 읽어보기');
define('_TEMPLATE_CMEXTRA',			'회원 엑스트라');
define('_TEMPLATE_COMMENTS_NONE',	'코멘트 (없을 경우)');
define('_TEMPLATE_CNONE',			'코멘트 없음');
define('_TEMPLATE_COMMENTS_TOOMUCH','코멘트 (삽입하기에는 너무 긴 경우)');
define('_TEMPLATE_CTOOMUCH',		'코멘트 너무 많음');
define('_TEMPLATE_ARCHIVELIST',		'아카이브 목록');
define('_TEMPLATE_AHEADER',			'아카이브 목록 헤더');
define('_TEMPLATE_AITEM',			'아카이브 목록 본문');
define('_TEMPLATE_AFOOTER',			'아카이브 목록 푸터');
define('_TEMPLATE_DATETIME',		'날짜와 시간');
define('_TEMPLATE_DHEADER',			'날짜 헤더');
define('_TEMPLATE_DFOOTER',			'날짜 푸터');
define('_TEMPLATE_DFORMAT',			'날짜 형식');
define('_TEMPLATE_TFORMAT',			'시간 형식');
define('_TEMPLATE_LOCALE',			'로케일');
define('_TEMPLATE_IMAGE',			'이미지 팝업');
define('_TEMPLATE_PCODE',			'팝업 링크 코드');
define('_TEMPLATE_ICODE',			'이미지 삽입 코드');
define('_TEMPLATE_MCODE',			'미디어 개체 링크 코드');
define('_TEMPLATE_SEARCH',			'검색');
define('_TEMPLATE_SHIGHLIGHT',		'하이라이트');
define('_TEMPLATE_SNOTFOUND',		'검색결과가 없습니다');
define('_TEMPLATE_UPDATE',			'갱신');
define('_TEMPLATE_UPDATE_BTN',		'템플릿 갱신');
define('_TEMPLATE_RESET_BTN',		'데이터 초기화');
define('_TEMPLATE_CATEGORYLIST',	'카테고리 목록');
define('_TEMPLATE_CATHEADER',		'카테고리 목록 헤더');
define('_TEMPLATE_CATITEM',			'카테고리 목록 본문');
define('_TEMPLATE_CATFOOTER',		'카테고리 목록 푸터');

// skins
define('_SKIN_EDIT_TITLE',			'스킨 수정');
define('_SKIN_AVAILABLE_TITLE',		'사용가능한 스킨들');
define('_SKIN_NEW_TITLE',			'새 스킨');
define('_SKIN_NAME',				'이름');
define('_SKIN_DESC',				'설명');
define('_SKIN_TYPE',				'내용 유형');
define('_SKIN_CREATE',				'생성');
define('_SKIN_CREATE_BTN',			'스킨 생성');
define('_SKIN_EDITONE_TITLE',		'스킨 수정');
define('_SKIN_BACK',				'스킨 오버뷰로 돌아가기');
define('_SKIN_PARTS_TITLE',			'스킨의 각 부분들');
define('_SKIN_PARTS_MSG',			'꼭 필요하지 않은 부분은 비워두어도 괜찮습니다. 수정할 스킨 유형을 선택하세요:');
define('_SKIN_PART_MAIN',			'메인 인덱스');
define('_SKIN_PART_ITEM',			'단일 글 보기');
define('_SKIN_PART_ALIST',			'아카이브 목록');
define('_SKIN_PART_ARCHIVE',		'아카이브');
define('_SKIN_PART_SEARCH',			'검색');
define('_SKIN_PART_ERROR',			'오류들');
define('_SKIN_PART_MEMBER',			'회원 등록정보');
define('_SKIN_PART_POPUP',			'이미지 팝업창');
define('_SKIN_GENSETTINGS_TITLE',	'일반 설정');
define('_SKIN_CHANGE',				'변경');
define('_SKIN_CHANGE_BTN',			'다음 설정을 변경합니다');
define('_SKIN_UPDATE_BTN',			'스킨 갱신');
define('_SKIN_RESET_BTN',			'데이터 초기화');
define('_SKIN_EDITPART_TITLE',		'스킨 수정');
define('_SKIN_GOBACK',				'돌아가기');
define('_SKIN_ALLOWEDVARS',			'사용가능한 변수들 (클릭하면 도움말):');

// global settings
define('_SETTINGS_TITLE',			'일반 설정');
define('_SETTINGS_SUB_GENERAL',		'일반 설정');
define('_SETTINGS_DEFBLOG',			'기본 블로그');
define('_SETTINGS_ADMINMAIL',		'관리자 이메일');
define('_SETTINGS_SITENAME',		'사이트 이름');
define('_SETTINGS_SITEURL',			'사이트의 URL (마지막에 슬래시 첨가)');
define('_SETTINGS_ADMINURL',		'관리자 영역의 URL (마지막에 슬래시 첨가)');
define('_SETTINGS_DIRS',			'Nucleus 디렉토리들');
define('_SETTINGS_MEDIADIR',		'미디어 디렉토리');
define('_SETTINGS_SEECONFIGPHP',	'(config.php를 보세요)');
define('_SETTINGS_MEDIAURL',		'미디어 URL (마지막에 슬래시 첨가)');
define('_SETTINGS_ALLOWUPLOAD',		'파일 업로드 가능?');
define('_SETTINGS_ALLOWUPLOADTYPES','업로드 가능한 파일 유형들');
define('_SETTINGS_CHANGELOGIN',		'회원들이 로그인/암호 수정 가능?');
define('_SETTINGS_COOKIES_TITLE',	'쿠키 설정');
define('_SETTINGS_COOKIELIFE',		'로그인 쿠키의 지속기간');
define('_SETTINGS_COOKIESESSION',	'세션 쿠키');
define('_SETTINGS_COOKIEMONTH',		'한 달 지속');
define('_SETTINGS_COOKIEPATH',		'쿠키 경로 (고급설정)');
define('_SETTINGS_COOKIEDOMAIN',	'쿠키 도메인 (고급설정)');
define('_SETTINGS_COOKIESECURE',	'쿠키 암호화 (고급설정)');
define('_SETTINGS_LASTVISIT',		'마지막 방문 쿠키 저장');
define('_SETTINGS_ALLOWCREATE',		'방문자가 회원 계정 생성 가능?');
define('_SETTINGS_NEWLOGIN',		'방문자가 생성한 계정으로 로그인 가능?');
define('_SETTINGS_NEWLOGIN2',		'(새로 만든 계정에만 해당)');
define('_SETTINGS_MEMBERMSGS',		'회원간 서비스 가능');
define('_SETTINGS_LANGUAGE',		'기본설정 언어');
define('_SETTINGS_DISABLESITE',		'사이트 닫기');
define('_SETTINGS_DBLOGIN',			'mySQL 로그인 & 데이터베이스');
define('_SETTINGS_UPDATE',			'설정 갱신');
define('_SETTINGS_UPDATE_BTN',		'설정 갱신');
define('_SETTINGS_DISABLEJS',		'자바스크립트 툴바 사용안함');
define('_SETTINGS_MEDIA',			'미디어/업로드 설정');
define('_SETTINGS_MEDIAPREFIX',		'업로드한 파일이름 앞에 날짜 추가');
define('_SETTINGS_MEMBERS',			'회원 설정');

// bans
define('_BAN_TITLE',				'접근금지 목록');
define('_BAN_NONE',					'이 웹로그에는 접근금지 없음');
define('_BAN_NEW_TITLE',			'새 접근금지 설정 추가');
define('_BAN_NEW_TEXT',				'새 접근금지 설정을 지금 추가합니다');
define('_BAN_REMOVE_TITLE',			'접근금지 설정 삭제');
define('_BAN_IPRANGE',				'IP 범위');
define('_BAN_BLOGS',				'어떤 블로그?');
define('_BAN_DELETE_TITLE',			'접근금지 설정 삭제');
define('_BAN_ALLBLOGS',				'운영자 권한을 가진 모든 블로그.');
define('_BAN_REMOVED_TITLE',		'접근금지 설정이 삭제되었습니다');
define('_BAN_REMOVED_TEXT',			'다음 블로그에 대한 접근금지 설정을 삭제했습니다:');
define('_BAN_ADD_TITLE',			'접근금지 설정 추가');
define('_BAN_IPRANGE_TEXT',			'접근을 막으려는 IP 범위를 고르세요. 숫자들이 적을수록 더 많은 주소들을 막게 됩니다.');
define('_BAN_BLOGS_TEXT',			'특정 블로그에만 접근을 막을 수도 있고, 운영자 권한을 가진 모든 블로그에 대한 접근을 막을 수도 있습니다. 어떻게 하시겠습니까?.');
define('_BAN_REASON_TITLE',			'이유');
define('_BAN_REASON_TEXT',			'접근이 금지된 사용자에게 표시할 안내문을 표시할 수 있습니다. 최고 256자- 한글로는 128자까지 입력하실 수 있습니다.');
define('_BAN_ADD_BTN',				'접근금지 설정 추가');

// LOGIN screen
define('_LOGIN_MESSAGE',			'메시지');
define('_LOGIN_NAME',				'이름');
define('_LOGIN_PASSWORD',			'암호');
define('_LOGIN_SHARED',				_LOGINFORM_SHARED);
define('_LOGIN_FORGOT',				'암호를 잊으셨다면?');

// membermanagement
define('_MEMBERS_TITLE',			'회원 관리');
define('_MEMBERS_CURRENT',			'현재 회원들');
define('_MEMBERS_NEW',				'신규 회원');
define('_MEMBERS_DISPLAY',			'ID');
define('_MEMBERS_DISPLAY_INFO',		'(로그인 할 때 사용하는 이름입니다)');
define('_MEMBERS_REALNAME',			'실명');
define('_MEMBERS_PWD',				'암호');
define('_MEMBERS_REPPWD',			'암호 확인');
define('_MEMBERS_EMAIL',			'이메일 주소');
define('_MEMBERS_EMAIL_EDIT',		'(이메일 주소를 변경할 경우, 새 암호가 이메일로 발송됩니다.)');
define('_MEMBERS_URL',				'웹사이트 주소 (URL)');
define('_MEMBERS_SUPERADMIN',		'관리자 권한');
define('_MEMBERS_CANLOGIN',			'관리자 영역에 접근 가능');
define('_MEMBERS_NOTES',			'참고');
define('_MEMBERS_NEW_BTN',			'회원 추가');
define('_MEMBERS_EDIT',				'회원 수정');
define('_MEMBERS_EDIT_BTN',			'설정 변경');
define('_MEMBERS_BACKTOOVERVIEW',	'회원 보기로 돌아가기');
define('_MEMBERS_DEFLANG',			'언어');
define('_MEMBERS_USESITELANG',		'- 사이트 설정 사용 -');

// List of blogs (TT = tooltip)
define('_BLOGLIST_TT_VISIT',		'사이트 방문');
define('_BLOGLIST_ADD',				'글 추가');
define('_BLOGLIST_TT_ADD',			'이 웹로그에 새 글을 추가합니다');
define('_BLOGLIST_EDIT',			'글의 수정/삭제');
define('_BLOGLIST_TT_EDIT',			'');
define('_BLOGLIST_BMLET',			'북마크렛');
define('_BLOGLIST_TT_BMLET',		'');
define('_BLOGLIST_SETTINGS',		'설정');
define('_BLOGLIST_TT_SETTINGS',		'설정을 바꾸거나 팀을 관리합니다');
define('_BLOGLIST_BANS',			'접근금지');
define('_BLOGLIST_TT_BANS',			'특정 IP에 대한 접근금지를 추가하거나 해제합니다');
define('_BLOGLIST_DELETE',			'모두 삭제');
define('_BLOGLIST_TT_DELETE',		'이 웹로그를 삭제합니다');

// OVERVIEW screen
define('_OVERVIEW_YRBLOGS',			'웹로그들');
define('_OVERVIEW_YRDRAFTS',		'초안들');
define('_OVERVIEW_YRSETTINGS',		'설정들');
define('_OVERVIEW_GSETTINGS',		'일반 설정들');
define('_OVERVIEW_NOBLOGS',			'어떤 웹로그의 팀목록에도 가입되지 않았습니다');
define('_OVERVIEW_NODRAFTS',		'초안이 없습니다');
define('_OVERVIEW_EDITSETTINGS',	'회원정보 수정...');
define('_OVERVIEW_BROWSEITEMS',		'글 보기...');
define('_OVERVIEW_BROWSECOMM',		'코멘트 보기...');
define('_OVERVIEW_VIEWLOG',			'액션 로그 보기...');
define('_OVERVIEW_MEMBERS',			'회원 관리...');
define('_OVERVIEW_NEWLOG',			'새 웹로그 만들기...');
define('_OVERVIEW_SETTINGS',		'설정 고치기...');
define('_OVERVIEW_TEMPLATES',		'템플릿 고치기...');
define('_OVERVIEW_SKINS',			'스킨 고치기...');
define('_OVERVIEW_BACKUP',			'백업/리스토어...');

// ITEMLIST
define('_ITEMLIST_BLOG',			'블로그 내 글들'); 
define('_ITEMLIST_YOUR',			'당신의 글들');

// Comments
define('_COMMENTS',					'코멘트');
define('_NOCOMMENTS',				'이 글에는 코멘트가 없습니다');
define('_COMMENTS_YOUR',			'당신의 코멘트');
define('_NOCOMMENTS_YOUR',			'쓴 코멘트가 없습니다');

// LISTS (general)
define('_LISTS_NOMORE',				'더 이상 (또는 아무런) 결과가 없습니다');
define('_LISTS_PREV',				'이전');
define('_LISTS_NEXT',				'다음');
define('_LISTS_SEARCH',				'검색');
define('_LISTS_CHANGE',				'변경');
define('_LISTS_PERPAGE',			'페이지당 글 수');
define('_LISTS_ACTIONS',			'액션(action)');
define('_LISTS_DELETE',				'삭제');
define('_LISTS_EDIT',				'수정');
define('_LISTS_MOVE',				'이동');
define('_LISTS_CLONE',				'복제');
define('_LISTS_TITLE',				'제목');
define('_LISTS_BLOG',				'블로그');
define('_LISTS_NAME',				'이름');
define('_LISTS_DESC',				'설명');
define('_LISTS_TIME',				'시간');
define('_LISTS_COMMENTS',			'코멘트');
define('_LISTS_TYPE',				'유형');


// member list 
define('_LIST_MEMBER_NAME',			'ID');
define('_LIST_MEMBER_RNAME',		'실제이름');
define('_LIST_MEMBER_ADMIN',		'수퍼운영자? ');
define('_LIST_MEMBER_LOGIN',		'로그인 가능? ');
define('_LIST_MEMBER_URL',			'웹사이트');

// banlist
define('_LIST_BAN_IPRANGE',			'IP 범위');
define('_LIST_BAN_REASON',			'이유');

// actionlist
define('_LIST_ACTION_MSG',			'메시지');

// commentlist
define('_LIST_COMMENT_BANIP',		'접근금지 IP');
define('_LIST_COMMENT_WHO',			'작성자');
define('_LIST_COMMENT',				'코멘트');
define('_LIST_COMMENT_HOST',		'호스트');

// itemlist
define('_LIST_ITEM_INFO',			'정보');
define('_LIST_ITEM_CONTENT',		'제목과 내용');


// teamlist
define('_LIST_TEAM_ADMIN',			'관리자 ');
define('_LIST_TEAM_CHADMIN',		'관리자 변경');

// edit comments
define('_EDITC_TITLE',				'코멘트 수정');
define('_EDITC_WHO',				'작성자');
define('_EDITC_HOST',				'어디로부터?');
define('_EDITC_WHEN',				'언제?');
define('_EDITC_TEXT',				'텍스트');
define('_EDITC_EDIT',				'코멘트 수정');
define('_EDITC_MEMBER',				'회원');
define('_EDITC_NONMEMBER',			'비회원');

// move item
define('_MOVE_TITLE',				'어느 블로그로 이동할까요?');
define('_MOVE_BTN',					'아이템 이동');

?>