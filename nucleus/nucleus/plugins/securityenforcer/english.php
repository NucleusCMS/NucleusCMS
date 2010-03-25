<?php
/** English language file for NP_SECURITYENFORCER Plugin
*/

// Plugin Options
define('_SECURITYENFORCER_OPT_QUICKMENU',			'Show Admin Area in quick menu?');
define('_SECURITYENFORCER_OPT_DEL_UNINSTALL_DATA',	'Delete NP_SecurityEnforcer data table on uninstall?');
define('_SECURITYENFORCER_OPT_ENABLE',				'Enable NP_SecurityEnforcer password and login checks?');
define('_SECURITYENFORCER_OPT_PWD_MIN_LENGTH',		'Minimum Length in characters of a user password. Integer. 8 is the default and 6 the minimum value:');
define('_SECURITYENFORCER_OPT_PWD_COMPLEXITY',		'Password Complexity Check. (How many character types should be present out of a-z, A-Z, 0-9, punctuation marks?):');
//define('_SECURITYENFORCER_OPT_SELECT_OFF_COMP',		'Off');
//define('_SECURITYENFORCER_OPT_SELECT_ONE_COMP',		'One character type');
//define('_SECURITYENFORCER_OPT_SELECT_TWO_COMP',		'Two character types');
//define('_SECURITYENFORCER_OPT_SELECT_THREE_COMP',		'Three character types');
//define('_SECURITYENFORCER_OPT_SELECT_FOUR_COMP',		'Four character types');
define('_SECURITYENFORCER_OPT_SELECT',				'Off|0|One character type|1|Two character types|2|Three character types|3|Four character types|4');
define('_SECURITYENFORCER_OPT_MAX_FAILED_LOGIN',	'How many failed login attempts before locking the user account?');
define('_SECURITYENFORCER_OPT_LOGIN_LOCKOUT',		'After how many minutes should a locked account be released?');

//QuickMenu
define('_SECURITYENFORCER_ADMIN_TOOLTIP',			'Manage NP_SecurityEnforcer Plugin');
define('_SECURITYENFORCER_ADMIN_UNLOCKED',			' has been unlocked. Remember to unlock the corresponding IP or Login Name.');
define('_SECURITYENFORCER_ADMIN_NONE_LOCKED',		'No Records Found.');

// ERRORS
define('_SECURITYENFORCER_ACCOUNT_CREATED',			'Account has been created,but that password does not meet site requirements for length or complexity. <br />');
define('_SECURITYENFORCER_INSUFFICIENT_COMPLEXITY',	'This password does not meet site requirements for length or complexity. <br />');
define('_SECURITYENFORCER_MIN_PWD_LENGTH',			'<br />Minimum password length:');
define('_SECURITYENFORCER_PWD_COMPLEXITY',			'<br />Minimum number of character types ([a-z], [A-Z], [0-9], [-~!@#$%^&*()_+=,.<>?:;|]):');

//random words
define('_SECURITYENFORCER_UNLOCK',					'Unlock');
define('_SECURITYENFORCER_ENTITY',					'Entity');
define('_SECURITYENFORCER_LOCKED_ENTITIES',			'Currently Locked Entities');

// Plugin desc
define('_SECURITYENFORCER_DESCRIPTION',				'Enforces some password complexity rules and sets a maximum number of failed logins.');

// Log info
define('_SECURITYENFORCER_LOGIN_DISALLOWED',		'login disallowed by NP_SecurityEnforcer. login: %1$s, ip: %2$s');

// QuickMenu title
define('_SECURITYENFORCER_ADMIN_TITLE',				'Security Enforcer Administration');

?>