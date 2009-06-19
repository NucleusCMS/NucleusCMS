<?php
/** English language file for NP_SECURITYENFORCER Plugin
*/

// Plugin Options
define('_SECURITYENFORCER_OPT_QUICKMENU',			'クイックメニューに表示しますか？');
define('_SECURITYENFORCER_OPT_DEL_UNINSTALL_DATA',	'アンインストール時にデータベースのテーブルを削除しますか？');
define('_SECURITYENFORCER_OPT_ENABLE',				'パスワードのチェックとログインチェックのときにSecurityEnforcerを有効にしますか？');
define('_SECURITYENFORCER_OPT_PWD_MIN_LENGTH',		'パスワードの最小文字数(デフォルトは8文字。6文字未満には指定できません：');
define('_SECURITYENFORCER_OPT_PWD_COMPLEXITY',		'パスワード強度のチェック(a-z, A-Z, 0-9, 句読点以外に何種類の文字タイプが存在するべきですか?):');
define('_SECURITYENFORCER_OPT_SELECT_OFF_COMP',		'Off');
define('_SECURITYENFORCER_OPT_SELECT_ONE_COMP',		'一つ目の文字タイプ');
define('_SECURITYENFORCER_OPT_SELECT_TWO_COMP',		'二つ目の文字タイプ');
define('_SECURITYENFORCER_OPT_SELECT_THREE_COMP',	'三つ目の文字タイプ');
define('_SECURITYENFORCER_OPT_SELECT_FOUR_COMP',	'四つ目の文字タイプ');
define('_SECURITYENFORCER_OPT_MAX_FAILED_LOGIN',	'何度目のログイン失敗でアカウントをロックしますか？');
define('_SECURITYENFORCER_OPT_LOGIN_LOCKOUT',		'アカウントをロックしてから何分でロック解除しますか？');


// QuickMenu
define('_SECURITYENFORCER_ADMIN_TOOLTIP',			'SecurityEnforcerプラグインの管理');
define('_SECURITYENFORCER_ADMIN_UNLOCKED',			'ロック解除されました。対応するＩＰアドレス、またはログイン名のロックを解除するのを忘れないでください。');
define('_SECURITYENFORCER_ADMIN_NONE_LOCKED',		'該当なし');

// ERRORS
define('_SECURITYENFORCER_INSUFFICIENT_COMPLEXITY',	'入力されたパスワードは、このサイトで要求される文字数、または強度を満たしていません。<br />');
define('_SECURITYENFORCER_MIN_PWD_LENGTH',			'<br />パスワードが短すぎます：');
define('_SECURITYENFORCER_PWD_COMPLEXITY',			'<br />文字タイプが少なすぎます([a-z], [A-Z], [0-9], [-~!@#$%^&*()_+=,.<>?:;|]): ');

// random words
define('_SECURITYENFORCER_UNLOCK',					'アンロック');
define('_SECURITYENFORCER_ENTITY',					'エンティティ');
define('_SECURITYENFORCER_LOCKED_ENTITIES',			'現在ロック中のエンティティ');

// Plugin desc
define('_SECURITYENFORCER_DESCRIPTION',				'パスワードの最小文字数や強度の制限、ログイン失敗可能回数などを設定します');

// Log info
define('_SECURITYENFORCER_LOGIN_DISALLOWED',		'リモートホスト「%2$s」からのログイン名「%1$s」のログインはSecurityEnforcerプラグインによって拒絶されました');

?>