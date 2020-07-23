<?php

// created by piyoyo 2017


class CoreCachedData
{
    const base_tablename = 'cached_data';

    function __construct()
    {
    }

    public static function existTable()
    {
        static $ret = null;
        if (!is_null($ret)) {
            return $ret;
        }
        $tablename = sql_table(self::base_tablename);
        $ret = sql_existTableName($tablename);
        if (!$ret) {
            // force create table
            self::CreateTable();
            $ret = sql_existTableName($tablename);
        }
        return $ret;
    }
//    function CleanAll()
//    function CleanBy_type($type)
//    function CleanBy_subtype($type, $sub_type)
//    function CleanBy_Id($type, $sub_type, $sub_id)

    public static function existDataEx($type, $sub_type, $sub_id, $name, $expire_time = null)
    {
        global $DB_PHP_MODULE_NAME;
        $tablename = sql_table(self::base_tablename);

        $type = strval($type);
        $sub_type = strval($sub_type);
        $name = strval($name);
        $sub_id = intval($sub_id);

        $expire_datetime = (is_null($expire_time) ? '' : sql_gmDateTime_from_utime($expire_time));
        if ($DB_PHP_MODULE_NAME == 'pdo') {
            $sql = "SELECT count(*) FROM `$tablename`"
                . " WHERE `cd_type` = ? AND `cd_sub_type` = ? AND `cd_sub_id` = ? "
                . " AND `cd_name` = ? ";
            $input_parameters = array($type, $sub_type, $sub_id, $name);
            if (!empty($expire_datetime)) {
                // cd_datetime      : time when data was saved
                // $expire_datetime : Expired time
                //                    $expire_datetime = now - (Effective time)
                //                    If it is larger than cd_datetime, data expired                
                // check if saved time > $expire_datetime
                $sql .= " AND `cd_datetime` > ?";
                $input_parameters[] = $expire_datetime;
            }
            $sql .= " LIMIT 1";
            $res = sql_prepare_execute($sql, $input_parameters);
            if ($res && ($row = sql_fetch_row($res))) {
                return ($row[0] > 0);
            }
        } else {
            $sql = "SELECT count(*) as result FROM `$tablename`"
                . sprintf(" WHERE `cd_type` = '%s' AND `cd_sub_type` = '%s' AND `cd_sub_id` = %d AND `cd_name` = '%s' ",
                    sql_real_escape_string($type),
                    sql_real_escape_string($sub_type),
                    $sub_id,
                    sql_real_escape_string($name)
                );
            if (!empty($expire_datetime)) {
                // check if saved time > $expire_datetime
                $sql .= sprintf(" AND `cd_datetime` > '%s'",
                    sql_real_escape_string($expire_datetime));
            }
            $res = quickQuery($sql);
            return intval($res) > 0;
        }
        return false;
    }

    public static function setDataEx($type, $sub_type, $sub_id, $name, $value)
    {
        global $CONF;
        $tablename = sql_table(self::base_tablename);

        $type = strval($type);
        $sub_type = strval($sub_type);
        $name = strval($name);
        $value = strval($value);
        $sub_id = intval($sub_id);

        if ($CONF['debug']) {
            if (strlen($type) > 50) {
                SYSTEMLOG::addUnique('error', 'Error',
                    sprintf('%s : $type is to long:%d : %s', __FUNCTION__, strlen($type), $type));
            }
            if (strlen($sub_type) > 50) {
                SYSTEMLOG::addUnique('error', 'Error',
                    sprintf('%s : $sub_type is to long:%d : %s', __FUNCTION__, strlen($sub_type), $sub_type));
            }
            if (strlen($name) > 100) {
                SYSTEMLOG::addUnique('error', 'Error',
                    sprintf('%s : $name is to long:%d : %s', __FUNCTION__, strlen($name), $name));
            }
        }

        $datetime = sql_gmDateTime_from_utime($_SERVER['REQUEST_TIME']);
        if (self::existDataEx($type, $sub_type, $sub_id, $name)) {
            // update data
            $sql = "UPDATE `{$tablename}`"
                . sprintf(" SET `cd_value` = '%s', `cd_datetime` = '%s'",
                    sql_real_escape_string($value),
                    sql_real_escape_string($datetime))
                . sprintf(" WHERE `cd_type` = '%s' AND `cd_sub_type` = '%s' AND `cd_sub_id` = %d AND `cd_name` = '%s' ",
                    sql_real_escape_string($type),
                    sql_real_escape_string($sub_type),
                    $sub_id,
                    sql_real_escape_string($name)
                );
            sql_query($sql);
            return;
        }

        // insert data
        $sql = "INSERT INTO `{$tablename}`"
            . "(`cd_type`, `cd_sub_type`, `cd_sub_id`, `cd_name`, `cd_value`, `cd_datetime`)"
            . sprintf(" VALUES('%s', '%s', %d, '%s', '%s', '%s') ",
                sql_real_escape_string($type),
                sql_real_escape_string($sub_type),
                $sub_id,
                sql_real_escape_string($name),
                sql_real_escape_string($value),
                sql_real_escape_string($datetime)
            );
        sql_query($sql);
    }

    public static function getDataEx($type, $sub_type, $sub_id, $name, $expire_time = null)
    {
        $tablename = sql_table(self::base_tablename);

        $type = strval($type);
        $sub_type = strval($sub_type);
        $name = strval($name);
        $sub_id = intval($sub_id);

        $sql = "SELECT *, ";
        $expire_datetime = (is_null($expire_time) ? '' : sql_gmDateTime_from_utime($expire_time));
        if (empty($expire_datetime)) {
            $sql .= " 0 AS 'expired'";
        } else {
            $sql .= sprintf(" `cd_datetime` < '%s' AS 'expired'", sql_real_escape_string($expire_datetime));
        }
        $sql .= " FROM `{$tablename}`"
            . sprintf(" WHERE `cd_type` = '%s' AND `cd_sub_type` = '%s' AND `cd_sub_id` = %d AND `cd_name` = '%s' ",
                sql_real_escape_string($type),
                sql_real_escape_string($sub_type),
                $sub_id,
                sql_real_escape_string($name)
            );
        $sql .= " LIMIT 1";
        $res = sql_query($sql);
        if ($res && ($row = sql_fetch_assoc($res))) {
            $ret = array_merge($row);
            $ret['name'] =& $ret['cd_name'];
            $ret['value'] =& $ret['cd_value'];
            $ret['expired'] = intval($ret['expired']);
            return $ret;
        }
        return array();
    }

    public static function deleteDataEx($type, $sub_type, $sub_id, $name, $expire_time = null)
    {
        $tablename = sql_table(self::base_tablename);

        $type = strval($type);
        $sub_type = strval($sub_type);
        $name = strval($name);
        $sub_id = intval($sub_id);

        if (!self::existDataEx($type, $sub_type, $sub_id, $name)) {
            return;
        }

        $sql = "DELETE FROM `{$tablename}`"
            . sprintf(" WHERE `cd_type` = '%s' AND `cd_sub_type` = '%s' AND `cd_sub_id` = %d AND `cd_name` = '%s' ",
                sql_real_escape_string($type),
                sql_real_escape_string($sub_type),
                $sub_id,
                sql_real_escape_string($name)
            );
        sql_query($sql);
    }

    private static function CreateTable()
    {
        global $DB_DRIVER_NAME;
        if ($DB_DRIVER_NAME == 'sqlite') {
            self::CreateTable_sqlite();
        } else {
            self::CreateTable_mysql();
        }
    }

    private static function CreateTable_sqlite()
    {
        $tablename = sql_table(self::base_tablename);
        $sql = <<<EOD
CREATE TABLE IF NOT EXISTS `{$tablename}` (
  `cd_type`        varchar(50)   NOT NULL default '' COLLATE NOCASE,
  `cd_sub_type`    varchar(50)   NOT NULL default '' COLLATE NOCASE,
  `cd_sub_id`      int(11)       NOT NULL,
  `cd_allow_auto_clean`  tinyint(2)   NOT NULL default '1',
  `cd_name`        varchar(100)  NOT NULL COLLATE NOCASE,
  `cd_value`       mediumtext    NOT NULL,
  `cd_datetime`    datetime      NOT NULL,
  PRIMARY KEY  (`cd_type`, `cd_sub_type`, `cd_sub_id`, `cd_name`)
);
EOD;
        sql_query($sql);
    }

    private static function CreateTable_mysql()
    {
        $tablename = sql_table(self::base_tablename);
        $sql = <<<EOD
CREATE TABLE `{$tablename}` (
  `cd_type`        varchar(50)   NOT NULL default '',
  `cd_sub_type`    varchar(50)   NOT NULL default '',
  `cd_sub_id`      int(11)       NOT NULL,
  `cd_allow_auto_clean`  tinyint(2)   NOT NULL default '1',
  `cd_name`        varchar(100)  NOT NULL,
  `cd_value`       mediumtext    NOT NULL,
  `cd_datetime`    datetime      NOT NULL,
  PRIMARY KEY  (`cd_type`, `cd_sub_type`, `cd_sub_id`, `cd_name`)
) ENGINE=MyISAM;
EOD;
        sql_query($sql);
    }

}
