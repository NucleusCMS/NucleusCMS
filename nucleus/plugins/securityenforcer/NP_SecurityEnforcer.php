<?php
/**
 * Attach plugin for Nucleus CMS
 * Version 0.9.5 (1.0 RC) for PHP5
 * Written by Cacher, Jan.16, 2011
 * Original code was written by Frank Truscott, Nov. 01, 2009
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 3
 * of the License, or (at your option) any later version.
 */

class NP_SecurityEnforcer extends NucleusPlugin
{
    public $enable_security;
    public $login_lockout;
    public int $max_failed_login;
    public $pwd_min_length;
    public $pwd_complexity;

    public function getName()
    {
        return 'SecurityEnforcer';
    }
    public function getAuthor()
    {
        return 'Misc authors';
    } // Frank Truscott + Cacher
    public function getURL()
    {
        return '';
    } // https://github.com/NucleusCMS/NP_SecurityEnforcer
    public function getVersion()
    {
        return '3.80.0';
    }
    public function getDescription()
    {
        return _SECURITYENFORCER_DESCRIPTION;
    }
    public function getTableList()
    {
        return [sql_table('plug_securityenforcer')];
    }
    public function hasAdminArea()
    {
        return 1;
    }
    public function getMinNucleusVersion()
    {
        return 380;
    }
    public function supportsFeature($feature)
    {
        return in_array($feature, [
                   'pluginadmin',
                   ]);
    }
    public function getEventList()
    {
        return ['QuickMenu','PrePasswordSet','CustomLogin','LoginSuccess','LoginFailed','PostRegister','PrePluginOptionsEdit'];
    }

    public function getTablenameMain(): string
    {
        return sql_table('plug_securityenforcer');
    }

    public function install()
    {
        $this->loadLanguage();
        $this->installOptions();
        $this->installTable();
    }

    private function installOptions()
    {
        $this->createOption('quickmenu', '_SECURITYENFORCER_OPT_QUICKMENU', 'yesno', 'yes');
        $this->createOption('del_uninstall_data', '_SECURITYENFORCER_OPT_DEL_UNINSTALL_DATA', 'yesno', 'no');
        $this->createOption('enable_security', '_SECURITYENFORCER_OPT_ENABLE', 'yesno', 'yes');
        $this->createOption('pwd_min_length', '_SECURITYENFORCER_OPT_PWD_MIN_LENGTH', 'text', '8');
        //$this->createOption('pwd_complexity', _SECURITYENFORCER_OPT_PWD_COMPLEXITY, 'select','0',_SECURITYENFORCER_OPT_SELECT_OFF_COMP.'|0|'._SECURITYENFORCER_OPT_SELECT_ONE_COMP.'|1|'._SECURITYENFORCER_OPT_SELECT_TWO_COMP.'|2|'._SECURITYENFORCER_OPT_SELECT_THREE_COMP.'|3|'._SECURITYENFORCER_OPT_SELECT_FOUR_COMP.'|4');
        $this->createOption('pwd_complexity', '_SECURITYENFORCER_OPT_PWD_COMPLEXITY', 'select', '0', '_SECURITYENFORCER_OPT_SELECT');
        $this->createOption('max_failed_login', '_SECURITYENFORCER_OPT_MAX_FAILED_LOGIN', 'text', '5');
        $this->createOption('login_lockout', '_SECURITYENFORCER_OPT_LOGIN_LOCKOUT', 'text', '15');
    }

    private function installTable()
    {
        $table = $this->getTablenameMain();
        $Schema = getOrmSchemaManager();
        if ($Schema && $Schema->tablesExist([$table])) {
            return ;
        }

        //  login       varchar(255),
        //  fails       int(11)  NOT NULL default '0',
        //  lastfail    bigint   NOT NULL default '0',
        //  PRIMARY KEY login (login));
        $TableSchema = new \Doctrine\DBAL\Schema\Table($table);
        // name, Doctrine\DBAL\Types\Types, options
        $TableSchema->addColumn('login', 'string', ['Length' => 255]);
        $TableSchema->addColumn('fails', 'integer', ['Notnull' => true, 'Default' => 0]);
        $TableSchema->addColumn('lastfail', 'bigint', ['Notnull' => true, 'Default' => 0]);
        $TableSchema->setPrimaryKey(['login']);
        //if (getOrmSchemaManager() instanceof \Doctrine\DBAL\Schema\MySQLSchemaManager) {
        //}
        //if (getOrmSchemaManager() instanceof \Doctrine\DBAL\Schema\PostgreSQLSchemaManager) {
        //}
        //if (getOrmSchemaManager() instanceof \Doctrine\DBAL\Schema\SQLiteSchemaManager) {
        //}
        // Create Table
        ormCreateTable($TableSchema);

        // Debug
        // sqlite3 db_nucleus.sqlite ".schema nucleus_plug_securityenforcer"
    }

    public function unInstall()
    {
        if ('yes' == $this->getOption('del_uninstall_data')) {
            $Schema = getOrmSchemaManager();
            if ($Schema && $Schema->tableExists($this->getTablenameMain())) {
                $Schema->dropTable($this->getTablenameMain());
            }
        }
    }

    private function loadLanguage()
    {
        if (defined('_SECURITYENFORCER_OPT_QUICKMENU')) {
            return ;
        }
        $language = str_replace(["\\",'/', DIRECTORY_SEPARATOR ], '', getLanguageName());

        if (file_exists($this->getDirectory().$language.'.php')) {
            include_once($this->getDirectory().$language.'.php');
        } else {
            include_once($this->getDirectory().'english-utf8.php');
        }
    }

    public function init()
    {
        $this->loadLanguage();

        $this->enable_security  = $this->getOption('enable_security');
        $this->pwd_min_length   = (int) ($this->getOption('pwd_min_length'));
        $this->pwd_complexity   = (int) ($this->getOption('pwd_complexity'));
        $this->max_failed_login = (int) ($this->getOption('max_failed_login'));
        $this->login_lockout    = (int) ($this->getOption('login_lockout'));

        // debug
        if (CONF::asBool('debug')) {
            //$this->test();
        }
    }

    protected function test()
    {
        //        $data = ['login' => '::1'];
        $data = ['login' => '127.0.0.1'];
        foreach (['127.0.0.1','::1',$_SERVER['REMOTE_ADDR']] as $ip) {
            $sql = sprintf('Insert into %s (login,fails) Values(?,?)', $this->getTablenameMain());
            sql_prepare_execute($sql, [$ip, 100]);
        }
        $this->event_CustomLogin($data);
    }

    public function event_QuickMenu(&$data)
    {
        global $member;
        if ('yes' != $this->getOption('quickmenu') || ! $member->isAdmin()) {
            return;
        }
        if ( ! ($member->isLoggedIn())) {
            return;
        }

        $this->loadLanguage();

        array_push(
            $data['options'],
            [ 'title'   => 'Security Enforcer',
              'url'     => $this->getAdminURL(),
              'tooltip' => _SECURITYENFORCER_ADMIN_TOOLTIP,
            ]
        );
    }

    public function event_PrePasswordSet(&$data)
    {
        //password, errormessage, valid
        if ('yes' == $this->enable_security) {
            $password = $data['password'];

            // conditional below not needed in 3.60 or higher. Used to keep from setting off error when password not being changed
            if ('changemembersettings' == postVar('action')) {
                $emptyAllowed = true;
            } else {
                $emptyAllowed = false;
            }
            if (( ! $emptyAllowed) || $password) {
                $message = $this->_validate_and_messsage($password, $this->pwd_min_length, $this->pwd_complexity);
                if ($message) {
                    $data['errormessage'] = _SECURITYENFORCER_INSUFFICIENT_COMPLEXITY . $message. "<br /><br />\n";
                    $data['valid']        = false;
                }
            }
        }
    }

    public function event_PostRegister(&$data)
    {
        if ('yes' == $this->enable_security) {
            $password = postVar('password');
            if ('memberadd' == postVar('action')) {
                $message = $this->_validate_and_messsage($password, $this->pwd_min_length, $this->pwd_complexity);
                if ($message) {
                    $errormessage = _SECURITYENFORCER_ACCOUNT_CREATED. $message. "<br /><br />\n";
                    global $admin;
                    $admin->error($errormessage);
                }
            }
        }
    }

    public function event_CustomLogin(&$data)
    {
        //login,password,success,allowlocal
        if ('yes' == $this->enable_security && $this->max_failed_login > 0) {
            global $_SERVER;
            $login = strtolower((string) $data['login']);
            $ip    = strtolower((string) $_SERVER['REMOTE_ADDR']);

            // Clear
            $qb = getOrmQueryBuilder();
            if ($qb) {
                $qb->delete($this->getTablenameMain())
                    ->where('lastfail < :lastfail')
                    ->setParameter('lastfail', time() - ($this->login_lockout * 60))
                    ->executeStatement();
            }

            $qb = getOrmQueryBuilder();
            if ($qb) {
                $qb->select('fails')
                    ->from($this->getTablenameMain())
                    ->where('login = :login');
            }
            $flogin = $qb ? (int) $qb->setParameters(['login' => $login])->executeQuery()->fetchOne() : 0;
            $fip    = $qb ? (int) $qb->setParameters(['login' => $ip])->executeQuery()->fetchOne() : 0;

            if ($flogin >= $this->max_failed_login || $fip >= $this->max_failed_login) {
                $data['success']    = 0;
                $data['allowlocal'] = 0;
                if ( ! defined('_CHARSET')) {
                    define('_CHARSET', 'UTF-8');
                }
                $info = sprintf(_SECURITYENFORCER_LOGIN_DISALLOWED, htmlspecialchars($login, ENT_QUOTES, _CHARSET), htmlspecialchars($ip, ENT_QUOTES, _CHARSET));
                ACTIONLOG::add(INFO, $info);
            }
        }
    }

    public function event_LoginSuccess(&$data)
    {
        if ('yes' == $this->enable_security && $this->max_failed_login > 0) {
            global $_SERVER;
            $login = strtolower((string) $data['username']);
            $ip    = strtolower((string) $_SERVER['REMOTE_ADDR']);
            $sql   = sprintf("DELETE FROM %s WHERE login=? or login=?", sql_tableQuote('plug_securityenforcer'));
            sql_prepare_execute($sql, [$login, $ip]);
        }
    }

    public function event_LoginFailed(&$data)
    {
        if ('yes' == $this->enable_security && $this->max_failed_login > 0) {
            global $_SERVER;
            $login = strtolower((string) $data['username']);
            $ip    = strtolower((string) $_SERVER['REMOTE_ADDR']);

            $sql   = sprintf("SELECT count(*) AS result FROM %s WHERE login=?", sql_tableQuote('plug_securityenforcer'));
            $count = (int) (sql_direct_getValue_AsInt($sql, [$login]));
            if ($count > 0) {
                $sql = sprintf("UPDATE %s SET fails=fails+1, lastfail=:lastfail WHERE login=:login", sql_tableQuote('plug_securityenforcer'));
            } else {
                $sql = sprintf("INSERT INTO %s (login,fails,lastfail) VALUES (:login,1,:lastfail)", sql_tableQuote('plug_securityenforcer'));
            }
            sql_prepare_execute($sql, [':lastfail' => time(), ':login' => $login]);

            $sql   = sprintf("SELECT count(*) AS result FROM %s WHERE login=?", sql_tableQuote('plug_securityenforcer'));
            $count = (int) (sql_direct_getValue_AsInt($sql, [$ip]));
            if ($count > 0) {
                $sql = sprintf("UPDATE %s SET fails=fails+1, lastfail=:lastfail WHERE login=:login", sql_tableQuote('plug_securityenforcer'));
            } else {
                $sql = sprintf("INSERT INTO %s (login,fails,lastfail) VALUES (:login,1,:lastfail)", sql_tableQuote('plug_securityenforcer'));
            }
            sql_prepare_execute($sql, [':lastfail' => time(), ':login' => $ip]);
        }
    }

    public function event_PrePluginOptionsEdit($data)
    {
        if (isset($data['plugid'])
             && ($data['plugid'] === $this->getID())
        ) {
            foreach ($data['options'] as $key => $value) {
                if (defined($value['description'])) {
                    $data['options'][$key]['description'] = constant($value['description']);
                }
                if ( ! strcmp($value['type'], 'select') && defined($value['typeinfo'])) {
                    $data['options'][$key]['typeinfo'] = constant($value['typeinfo']);
                }
            }
        }
    }

    /* Helper Functions */

    private function _validate_passwd($passwd, $minlength = 6, $complexity = 0)
    {
        $minlength  = (int) $minlength;
        $complexity = (int) $complexity;

        if ($minlength < 6) {
            $minlength = 6;
        }
        if (strlen($passwd) < $minlength) {
            return false;
        }

        if ($complexity > 4) {
            $complexity = 4;
        }
        $ucchars   = "[A-Z]";
        $lcchars   = "[a-z]";
        $numchars  = "[0-9]";
        $ochars    = "[-~!@#$%^&*()_+=,.<>?:;|]";
        $chartypes = [$ucchars, $lcchars, $numchars, $ochars];
        $tot       = [0,0,0,0];
        $i         = 0;
        foreach ($chartypes as $value) {
            $tot[$i] = preg_match("/".$value."/", $passwd);
            $i       = $i + 1;
        }

        if (array_sum($tot) >= $complexity) {
            return true;
        } else {
            return false;
        }
    }

    private function _validate_and_messsage($passwd, $minlength = 6, $complexity = 0)
    {
        $minlength  = (int) $minlength;
        $complexity = (int) $complexity;

        $message = '';
        if ($minlength < 6) {
            $minlength = 6;
        }
        if (strlen($passwd) < $minlength) {
            $message .= _SECURITYENFORCER_MIN_PWD_LENGTH . $this->pwd_min_length;
        }

        if ($complexity > 4) {
            $complexity = 4;
        }
        $ucchars   = "[A-Z]";
        $lcchars   = "[a-z]";
        $numchars  = "[0-9]";
        $ochars    = "[-~!@#$%^&*()_+=,.<>?:;|]";
        $chartypes = [$ucchars, $lcchars, $numchars, $ochars];
        $tot       = [0,0,0,0];
        $i         = 0;
        foreach ($chartypes as $value) {
            $tot[$i] = preg_match("/".$value."/", $passwd);
            $i       = $i + 1;
        }

        if (array_sum($tot) < $complexity) {
            $message .= _SECURITYENFORCER_PWD_COMPLEXITY . $this->pwd_complexity;
        }
        return $message;
    }
}
