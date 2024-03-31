<?php

namespace com\github\nucleuscms\core\Upgrade;

class UpgradeTo380 extends UpgradeTo
{
    public function version()
    {
        return 380;
    }

    //    protected function doNextUpgrade()
    //    {
    //        include_once(__DIR__ . '/UpgradeTo390.php');
    //        new UpgradeTo390(); // 芋づる式更新
    //    }

    protected function doUpgrade()
    {
        // do nothing
        $list    = \get_class_methods($this);
        $success = true;
        foreach ($list as $name) {
            if (\str_starts_with($name, 'doUpdate')) {
                $success = ($success && \call_user_func([$this, $name]));
            }
        }
        if ($success && empty($this->errors)) {
            $this->updateVersion($this->version());
        }
    }

    protected function doUpdateConfig()
    {
        $this->updateOrInsertConfig('DatabaseName', 'Nucleus');
        $this->updateOrInsertConfig('ENABLE_PLUGIN_ADMIN_V1', '1');
        $this->updateOrInsertConfig('ENABLE_PLUGIN_UPDATE_CHECK', '1');

        global $DB_DRIVER_NAME;
        $cols = [
          'name'  => "varchar(200)  NOT NULL default ''",
          'value' => "varchar(255)           default NULL",
        ];
        $tablename = sql_table('config');
        foreach ($cols as $colname => $value) {
            if ('sqlite' === $DB_DRIVER_NAME) {
                $value .= ' COLLATE NOCASE';
                break; // SQLSTATE[HY000]: General error: near "MODIFY": syntax error
            }
            $sql = "ALTER TABLE `{$tablename}` MODIFY `{$colname}` {$value}";
            $this->upgradeQueryExecute($sql);
        }
        //  ->modifyColumn('name', ['Length' => 200, 'Notnull' => true, 'Default' => ''])
        //  ->modifyColumn('value', ['Length' => 255, 'Default' => null]);
        return true;
    }

    protected function doUpdateBlog()
    {
        global $DB_DRIVER_NAME;
        $tablename = sql_table('blog');

        if ( ! sql_existTableColumnName($tablename, 'bauthorvisible')) {
            $sql = "ALTER TABLE `{$tablename}` ADD COLUMN `bauthorvisible` tinyint(2) NOT NULL default '1'";
            $this->upgradeQueryExecute($sql);
        }

        // mysql only. because sqlite not support MODIFY COLUMN
        $mode = (sql_existTableColumnName($tablename, 'ballowpast') ? 'MODIFY' : 'ADD');
        if (('ADD' === $mode) || ('sqlite' !== $DB_DRIVER_NAME)) {
            $sql = "ALTER TABLE `{$tablename}` {$mode} COLUMN `ballowpast` tinyint(2) NOT NULL default '1'";
            $this->upgradeQueryExecute($sql);
        }
        return true;
    }

    protected function doUpdateItem()
    {
        global $DB_DRIVER_NAME;
        $tablename = sql_table('item');

        $cols = [
            'ipublic'                   => "tinyint(2)   NOT NULL default '1'",
            'ipublic_enable_term_start' => "tinyint(2)   NOT NULL default '0'",
            'ipublic_enable_term_end'   => "tinyint(2)   NOT NULL default '0'",
            'ipublic_term_start'        => "datetime    NOT NULL default '2000-01-01 00:00:00'",
            'ipublic_term_end'          => "datetime    NOT NULL default '2099-01-01 00:00:00'",
        ];

        foreach ($cols as $colname => $value) {
            $ct = 0;
            if ( ! sql_existTableColumnName($tablename, $colname)) {
                $sql = "ALTER TABLE `{$tablename}` ADD COLUMN `{$colname}` {$value}";
                $this->upgradeQueryExecute($sql);
                $ct = 1;
            }

            // create index
            if ('sqlite' === $DB_DRIVER_NAME) {
                $sql = "CREATE INDEX IF NOT EXISTS `{$tablename}_idx_{$colname}` on `{$tablename}` (`{$colname}`);";
                $this->upgradeQueryExecute($sql);
            } else {
                if ($ct) {
                    $sql = "ALTER TABLE `{$tablename}` ADD INDEX `{$colname}` (`{$colname}`)";
                    $this->upgradeQueryExecute($sql);
                }
            }
        }
        return true;
    }

    protected function doUpdateSkin()
    {
        global $DB_DRIVER_NAME;
        if ('sqlite' === $DB_DRIVER_NAME) {
            // SQLSTATE[HY000]: General error: near "MODIFY": syntax error
            return true;
        }
        $tablename = sql_table('skin');
        if (sql_existTableColumnName($tablename, 'spartstype')) {
            $sql = "SELECT count(*) FROM `{$tablename}`"
                . " WHERE stype NOT IN ('index', 'item', 'error', 'search', 'archive', 'archivelist', 'imagepopup', 'member')"
                . " AND spartstype='parts' Limit 1";
            if ((int) quickQueryNoCache($sql)) {
                $sql = "UPDATE `{$tablename}` set spartstype='specialpage'"
                    . "WHERE stype NOT IN ('index', 'item', 'error', 'search', 'archive', 'archivelist', 'imagepopup', 'member')";
                $this->upgradeQueryExecute($sql);
            }
            return true;
        }

        $sql = "ALTER TABLE `{$tablename}` ADD COLUMN `spartstype` varchar(20) NOT NULL default 'parts'";
        $this->upgradeQueryExecute($sql);

        return true;
    }

    protected function doUpdateMember()
    {
        global $DB_DRIVER_NAME;
        $tablename = sql_table('member');
        if ( ! sql_existTableColumnName($tablename, 'mhalt')) {
            $sql = "ALTER TABLE `{$tablename}` ADD COLUMN `mhalt` tinyint(2) NOT NULL default '0'";
            $this->upgradeQueryExecute($sql);
        }
        if ( ! sql_existTableColumnName($tablename, 'mhalt_reason')) {
            $sql = "ALTER TABLE `{$tablename}` ADD COLUMN `mhalt_reason` varchar(100) NOT NULL default ''";
            $this->upgradeQueryExecute($sql);
        }

        if ( ! sql_existTableColumnName($tablename, 'mimage')) {
            $sql = "ALTER TABLE `{$tablename}` ADD COLUMN `mimage` varchar(500) NOT NULL default ''";
            $this->upgradeQueryExecute($sql);
        }
        return true;
    }

    protected function doUpdateMemberOption()
    {
        global $DB_DRIVER_NAME;
        $tablename = sql_table('member_option');

        if ('sqlite' === $DB_DRIVER_NAME) {
            return true;
        }
        if ( ! sql_existTableName($tablename)) {
            $sql = "
                CREATE TABLE `{$tablename}` (
                  `omember`  int(11)      NOT NULL,
                  `ocontext` varchar(20)  NOT NULL default '',
                  `name`     varchar(100) NOT NULL,
                  `value`    varchar(255) NOT NULL default '',
                  PRIMARY KEY (`omember`, `ocontext`, `name`)
                ) ENGINE=InnoDB;";
            $this->upgradeQueryExecute($sql);
        }
        return true;
    }

    protected function doUpdatePluginOptionDesc()
    {
        global $DB_DRIVER_NAME;
        if ('sqlite' === $DB_DRIVER_NAME) {
            // SQLSTATE[HY000]: General error: near "MODIFY": syntax error
            return true;
        }
        $tablename = sql_table('plugin_option_desc');
        $sql       = "ALTER TABLE `{$tablename}` MODIFY `oname` varchar(200) NOT NULL default ''";
        if ('sqlite' === $DB_DRIVER_NAME) {
            $sql .= ' COLLATE NOCASE';
        }
        $this->upgradeQueryExecute($sql);

        return true;
    }
}

new UpgradeTo380(); // 芋づる式更新
