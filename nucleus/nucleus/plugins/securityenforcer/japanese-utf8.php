<?php
/** Japanese-UTF8 language file for NP_SECURITYENFORCER Plugin
*/

// Plugin Options
define('_SECURITYENFORCER_OPT_QUICKMENU',			'クイックメニューに表示しますか？');
define('_SECURITYENFORCER_OPT_DEL_UNINSTALL_DATA',	'アンインストール時にデータベースのテーブルを削除しますか？');
define('_SECURITYENFORCER_OPT_ENABLE',				'パスワードとログインチェック時にSecurityEnforcerを有効にしますか？');
define('_SECURITYENFORCER_OPT_PWD_MIN_LENGTH',		'パスワードの最小文字数(デフォルトは8文字。6文字未満には指定できません：');
define('_SECURITYENFORCER_OPT_PWD_COMPLEXITY',		'パスワード強度のチェック(a-z, A-Z, 0-9, 半角記号から何種類の文字タイプが存在するべきですか?):');
//define('_SECURITYENFORCER_OPT_SELECT_OFF_COMP',		'Off');
//define('_SECURITYENFORCER_OPT_SELECT_ONE_COMP',		'一種類の文字タイプ');
//define('_SECURITYENFORCER_OPT_SELECT_TWO_COMP',		'二種類の文字タイプ');
//define('_SECURITYENFORCER_OPT_SELECT_THREE_COMP',	'三種類の文字タイプ');
//define('_SECURITYENFORCER_OPT_SELECT_FOUR_COMP',	'四種類の文字タイプ');
define('_SECURITYENFORCER_OPT_SELECT',				'オフ|0|1種類の文字タイプ|1|2種類の文字タイプ|2|3種類の文字タイプ|3|4種類の文字タイプ|4');
define('_SECURITYENFORCER_OPT_MAX_FAILED_LOGIN',	'何度目のログイン失敗でアカウントをロックしますか？');
define('_SECURITYENFORCER_OPT_LOGIN_LOCKOUT',		'アカウントをロックしてから何分でロック解除しますか？');

// QuickMenu
define('_SECURITYENFORCER_ADMIN_TOOLTIP',			'SecurityEnforcerプラグインの管理');
define('_SECURITYENFORCER_ADMIN_UNLOCKED',			'ロック解除されました。対応するIPアドレス、またはログイン名のロックを解除するのを忘れないでください。');
define('_SECURITYENFORCER_ADMIN_NONE_LOCKED',		'該当なし');

// ERRORS
define('_SECURITYENFORCER_ACCOUNT_CREATED',			'アカウントは作成されましたが、パスワードがこのサイトで要求される文字数、または強度を満たしていません。<br />');
define('_SECURITYENFORCER_INSUFFICIENT_COMPLEXITY',	'入力されたパスワードは、このサイトで要求される文字数、または強度を満たしていません。<br />');
define('_SECURITYENFORCER_MIN_PWD_LENGTH',			'<br />最小文字数: ');
define('_SECURITYENFORCER_PWD_COMPLEXITY',			'<br />最小文字タイプ数([a-z], [A-Z], [0-9], [-~!@#$%^&*()_+=,.<>?:;|]): ');

// random words
define('_SECURITYENFORCER_UNLOCK',					'アンロック');
define('_SECURITYENFORCER_ENTITY',					'エンティティ');
define('_SECURITYENFORCER_LOCKED_ENTITIES',			'現在ロック中のエンティティ');

// Plugin desc
define('_SECURITYENFORCER_DESCRIPTION',				'パスワードの最小文字数や強度の制限、ログイン失敗可能回数などを設定します');

// Log info
define('_SECURITYENFORCER_LOGIN_DISALLOWED',		'SecurityEnforcerによってログインが拒絶されました。login: %1$s, ip: %2$s');

// QuickMenu title
define('_SECURITYENFORCER_ADMIN_TITLE',				'SecurityEnforcerプラグインの管理');

?>