<?php

class SYSTEMLOG
{

    const MAX_MSG_LEN = 1000000;

    public static function checkWritable()
    {
        static $table_exists = null;
        global $CONF;
        // no table
        if (is_null($table_exists)) {
            if (empty($CONF['DatabaseVersion']) || ((int)$CONF['DatabaseVersion'] < 380)) {
                $table_exists = false;
            } else {
                self::checkAndCreateTable();
                $table_exists = sql_existTableName(sql_table('systemlog'));
            }
        }
        if (!$table_exists) {
            return false;
        }
        return true;
    }

    public static function add($type, $subtype, $message, $options = array())
    {
        global $member, $CONF, $DB_DRIVER_NAME, $DB_PHP_MODULE_NAME;

        if (!self::checkWritable()) {
            return;
        }

        if (is_string($message)) {
            $message = (string)$message;
        }

        $tablename = sql_table('systemlog');
        $query = <<< EOL
            INSERT INTO `$tablename`
            (logyear, logtype, subtype, mnumber, timestamp_utc, message, message_hash)
            VALUES(:logyear , :logtype, :subtype, :mnumber, :timestamp_utc, :message, :message_hash)
EOL;
        $ph = array();
        $ph[':logyear'] = (int)gmdate('Y', $_SERVER['REQUEST_TIME']);
        $ph[':logtype'] = (string)$type;
        $ph[':subtype'] = (string)$subtype;
        $ph[':mnumber'] = (int)max(0, empty($options['mnumber']) ? 0 : (int)$options['mnumber']);
        $ph[':timestamp_utc'] = (string)gmdate('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
        $ph[':message'] = (string)((strlen($message) > self::MAX_MSG_LEN) ? substr(
            $message,
            0,
            self::MAX_MSG_LEN
        ) : $message);
        $ph[':message_hash'] = (string)sha1($ph[':message']);

        if ($DB_DRIVER_NAME == 'sqlite') {
            $query = <<< EOL
            INSERT INTO `$tablename`
            (logyear, logtype, subtype, mnumber, timestamp_utc, message, message_hash, logid)
            SELECT :logyear , :logtype, :subtype, :mnumber, :timestamp_utc, :message, :message_hash
                    , ifnull((SELECT MAX(logid) FROM `$tablename` WHERE logyear=:logyear),0)+1
EOL;
        }

        if ($DB_PHP_MODULE_NAME == 'pdo') {
            $res = sql_prepare_execute($query, $ph);
        } else {
            $query = preg_replace("/:(\w+)/ims", "'[@\\1@]'", $query);
            foreach (array_keys($ph) as $key) {
                $new_key = substr($key, 1);
                $ph[$new_key] =& $ph[$key];
                unset($ph[$key]);
            }
            $query = parseQuery($query, $ph);
            $res = sql_query($query);
        }
        if (isDebugMode() && $member->isAdmin()) {
            if (empty($res) || sql_affected_rows($res) == 0) {
                $msg = sprintf('SYSTEMLOG::add query error: %s : %s', hsc(sql_error()), hsc($query));
                trigger_error($msg, E_USER_WARNING);
            }
        }
        self::autoClean();
    }

    public static function addUnique($type, $subtype, $message, $options = array())
    {
        global $DB_PHP_MODULE_NAME;
        $message = (string)((strlen($message) > self::MAX_MSG_LEN) ? substr($message, 0, self::MAX_MSG_LEN) : $message);

        $ph = array();
        $ph[':logtype'] = (string)$type;
        $ph[':subtype'] = (string)$subtype;
        $ph[':message_hash'] = (string)sha1($message);

        $tablename = sql_table('systemlog');
        $query = <<< EOL
            DELETE FROM `$tablename`
            WHERE logtype=:logtype AND subtype=:subtype AND message_hash=:message_hash
EOL;
        if ($DB_PHP_MODULE_NAME == 'pdo') {
            sql_prepare_execute($query, $ph);
        } else {
            $query = preg_replace("/:(\w+)/ims", "'[@\\1@]'", $query);
            foreach (array_keys($ph) as $key) {
                $new_key = substr($key, 1);
                $ph[$new_key] =& $ph[$key];
                unset($ph[$key]);
            }
            $query = parseQuery($query, $ph);
            sql_query($query);
        }
        self::add($type, $subtype, $message, $options);
    }

    public static function clearAll()
    {
        global $DB_DRIVER_NAME;
        if (!self::checkWritable()) {
            return;
        }
        if ($DB_DRIVER_NAME == 'mysql') {
            $query = 'TRUNCATE TABLE ' . sql_table('systemlog');
        } else {
            $query = 'DELETE FROM ' . sql_table('systemlog');
        }
        sql_query($query);
    }

    /*
     * auto clean
     *   The target of clean
             type: error ,
    */
    public static function autoClean()
    {
        static $checked = false;
        global $DB_DRIVER_NAME;
        if (!self::checkWritable() || $checked) {
            return;
        }
        $checked = true;

        $tablename = sql_table('systemlog');
        $offset = -3600 * 24 * 7; // sec, 7 days
        $date = gmdate('Y-m-d H:i:s', $_SERVER['REQUEST_TIME'] + $offset);

        $query = 'DELETE FROM ' . $tablename
            . sprintf(' WHERE timestamp_utc <=%s ', sql_quote_string($date))
            . " AND logtype='error'";
        sql_query($query);

        $query = "SELECT COUNT(*) FROM `{$tablename}` WHERE logtype='error'";
        $ct = intval(quickQuery($query));
        if ($ct < 20) {
            return;
        }
        $query = <<<EOL
            SELECT timestamp_utc FROM `{$tablename}` WHERE logtype='error'
            ORDER BY timestamp_utc DESC LIMIT 19,1
EOL;
        $res = sql_query($query);
        if ($res && ($obj = sql_fetch_object($res))) {
            $query = 'DELETE FROM ' . $tablename
                . sprintf(' WHERE timestamp_utc <=%s ', sql_quote_string($obj->timestamp_utc))
                . " AND logtype='error'";
            sql_query($query);
        }
    }

    public static function checkAndCreateTable()
    {
        static $checked = false;
        if ($checked) {
            return;
        }
        $checked = true;
        if (sql_existTableName(sql_table('systemlog'))) {
            return;
        }
        if (!sql_existTableName(sql_table('config'))) {
            return;
        }
        $query = array();
        $tablename = sql_table('systemlog');
        $query['mysql'] = <<<EOL
CREATE TABLE `{$tablename}` (
  `logyear`        SMALLINT     NOT NULL,
  `logid`          BIGINT       NOT NULL AUTO_INCREMENT,
  `logtype`        varchar(30)  NOT NULL,
  `subtype`        varchar(30)  NOT NULL default '',
  `mnumber`        varchar(30)  NOT NULL default '0',
  `timestamp_utc`  datetime     NOT NULL,
  `message`        MEDIUMTEXT   NOT NULL default '',
  `message_hash`   varchar(64)  NOT NULL,
   PRIMARY KEY  (`logyear`, `logid`),
   INDEX `logtype` (`logtype`)
) ENGINE=MyISAM;
EOL;

        $query['sqlite'] = <<<EOL
CREATE TABLE `{$tablename}` (
  `logyear`        SMALLINT     NOT NULL,
  `logid`          BIGINT       NOT NULL,
  `logtype`        varchar(30)  NOT NULL,
  `subtype`        varchar(30)  NOT NULL default '',
  `mnumber`        varchar(30)  NOT NULL default '0',
  `timestamp_utc`  datetime     NOT NULL,
  `message`        MEDIUMTEXT   NOT NULL default '',
  `message_hash`   varchar(64)  NOT NULL,
   PRIMARY KEY  (`logyear`, `logid`)
);
CREATE INDEX IF NOT EXISTS `{$tablename}_idx_logtype` on `{$tablename}` (`logtype`)
EOL;

        global $DB_DRIVER_NAME;
        if ($DB_DRIVER_NAME == 'sqlite') {
            $items = explode(';', $query['sqlite']);
            foreach ($items as $query) {
                sql_query($query);
            }
        } else {
            sql_query($query['mysql']);
        }
    }
}
