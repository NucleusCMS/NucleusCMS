<?php
/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 *
 * Scripts to create/restore a backup of the Nucleus database
 *
 * Based on code in phpBB (http://phpBB.sourceforge.net)
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) The Nucleus Group
 */

class Backup
{ 

    private $is_support_utf8mb4;
    private $charsetOfDB;
    private $collationOfDB;
    private $export_db_charset;
    private $mode_en;
    private $export_db_collation;
    public $mySqlVer;
    /**
     * Constructor
     */
    public function __construct() { $this->Backup(); }
    function Backup()
    {
        // do nothing

        ob_start();
        // get mysql version
        $this->mySqlVer = sql_get_server_version();
        // check utf8mb4 support
        $res = sql_query("SHOW COLLATION like 'utf8mb4_general_ci'");
        if ($res && ($row = sql_fetch_row($res ))) {
            $this->is_support_utf8mb4 = true;
        } else {
            $this->is_support_utf8mb4 = false;
        }
        ob_end_clean();
    }

    private function init_do_backup()
    {
        global $DB_PHP_MODULE_NAME;

        $this->mode_en = true; // If it is false, the output file may be corrupted.
        ob_start();
        // get database table charset and collation
        $this->charsetOfDB   = getCharSetFromDB(sql_table('item'),   'ibody');
        $this->collationOfDB = getCollationFromDB(sql_table('item'), 'ibody');

        $this->export_db_charset   = 'utf8mb4';
        $this->export_db_collation = 'utf8mb4_general_ci';
        if (!$this->is_support_utf8mb4 && ($this->charsetOfDB != 'utf8mb4'))
        {
            $this->export_db_charset   = 'utf8';
            $this->export_db_collation = 'utf8_general_ci';
        }
        ini_set('default_charset', 'UTF-8');
        if (!empty($this->charsetOfDB) && ($this->charsetOfDB != 'utf8mb4'))
        {
            if (($this->charsetOfDB == 'utf8') && $this->is_support_utf8mb4)
            { // utf8 utf32
                $this->export_db_charset   = 'utf8mb4';
                $this->export_db_collation = 'utf8mb4_general_ci';
            }
            else
            {
                if ($this->charsetOfDB == 'ujis')
                {
                    $this->export_db_charset   = $this->charsetOfDB;
                    $this->export_db_collation = $this->collationOfDB;
                    ini_set('default_charset', 'EUC-JP'); // todo: eucJP-win
                }
                // else : force utf8 mode
            }
        }
        if ($DB_PHP_MODULE_NAME == 'pdo') {
            sql_query('SET CHARACTER SET ' . $this->export_db_charset);
        } else {
            if ( function_exists( 'mysql_set_charset' ) )
                mysql_set_charset( $this->export_db_charset );
            else
                sql_query('SET CHARACTER SET ' . $this->export_db_charset);
        }
        // output text setteing
        if (_CHARSET == 'UTF-8' && preg_match('/^utf8/i', $this->export_db_charset))
            $this->mode_en = false;
        else if (_CHARSET != 'UTF-8') {
            switch (_CHARSET)
            {
                case 'EUC-JP':
                // case '':
                    if (get_mysql_charset_from_php_charset(_CHARSET) == $this->export_db_charset)
                        $this->mode_en = false;
                break;
            }
        }
        ob_end_clean();
//        exit(sprintf("_CHARSET(%s) , export_db_charset(%s) , mode_en(%s)", _CHARSET, $this->export_db_charset, $this->mode_en ? 'true' : 'false'));
    }


    /**
     * This function creates an sql dump of the database and sends it to
     * the user as a file (can be gzipped if they want)
     *
     * @requires
     *        no output may have preceded (new headers are sent)
     * @param int $gzip
     */
    public function do_backup($gzip = 0) {
        global $manager;

        $this->init_do_backup();

        // tables of which backup is needed
        $tables = array(
                        sql_table('actionlog'),
                        sql_table('ban'),
                        sql_table('blog'),
                        sql_table('comment'),
                        sql_table('config'),
                        sql_table('item'),
                        sql_table('karma'),
                        sql_table('member'),
                        sql_table('skin'),
                        sql_table('skin_desc'),
                        sql_table('team'),
                        sql_table('template'),
                        sql_table('template_desc'),
                        sql_table('plugin'),
                        sql_table('plugin_event'),
                        sql_table('plugin_option'),
                        sql_table('plugin_option_desc'),
                        sql_table('category'),
                        sql_table('activation'),
                        sql_table('tickets'),
                );
        if ( sql_existTableName( sql_table('cached_data') ))
            $tables[] = sql_table('cached_data');
        if ( sql_existTableName( sql_table('systemlog') ))
            $tables[] = sql_table('systemlog');

        // add tables that plugins want to backup to the list
        // catch all output generated by plugins
        ob_start();
        $res = sql_query('SELECT pfile FROM '.sql_table('plugin'));
        while ($plugName = sql_fetch_object($res)) {
            $plug =& $manager->getPlugin($plugName->pfile);
            if ($plug) $tables = array_merge($tables, (array) $plug->getTableList());
        }
        ob_end_clean();
        
        // remove duplicates
        $tables = array_unique($tables);
        
        // make sure browsers don't cache the backup
        header("Pragma: no-cache");
        
        // don't allow gzip compression when extension is not loaded
        if (($gzip != 0) && !extension_loaded("zlib")) {
            $gzip = 0;
        }
        
        if ($gzip) {
            // use an output buffer
            @ob_start();
            @ob_implicit_flush(0);
        
        // set filename
        $filename = 'nucleus_db_backup_'.strftime("%Y-%m-%d-%H-%M-%S", time()).".sql.gz";
        } else {
        $filename = 'nucleus_db_backup_'.strftime("%Y-%m-%d-%H-%M-%S", time()).".sql";
        }
        
        
        // send headers that tell the browser a file is coming
        header("Content-Type: text/x-delimtext; name=\"$filename\"");
        header("Content-disposition: attachment; filename=$filename");
        
        // dump header
        echo "#\n";
        echo "# " . ( !$this->mode_en && defined('_BACKUP_BACKUPFILE_TITLE') ? _BACKUP_BACKUPFILE_TITLE : 'This is a backup file generated by Nucleus') . " \n";
        echo "# " . ( !$this->mode_en && defined('_ADMINPAGEFOOT_OFFICIALURL') ? _ADMINPAGEFOOT_OFFICIALURL : 'http://www.nucleuscms.org/') . " \n";
        echo "#\n";
        if ( !$this->mode_en && defined('_BACKUP_BACKUPFILE_BACKUPDATE'))
            echo "# " . _BACKUP_BACKUPFILE_BACKUPDATE .  gmdate("d-m-Y H:i:s", time()) . " GMT\n";
        else
            echo "# backup-date: " .  gmdate("d-m-Y H:i:s", time()) . " GMT\n";

        if ( !$this->mode_en && defined('_BACKUP_BACKUPFILE_NUCLEUSVERSION'))
            echo "# " . _BACKUP_BACKUPFILE_NUCLEUSVERSION . CORE_APPLICATION_VERSION . "\n";
        else
            echo "# Nucleus CMS version: " . CORE_APPLICATION_VERSION . "\n";
        echo "#\n";
        if ( !$this->mode_en && defined('_BACKUP_WARNING_NUCLEUSVERSION'))
            echo "# " . _BACKUP_WARNING_NUCLEUSVERSION . "\n";
        else
            echo "# WARNING: Only try to restore on servers running the exact same version of Nucleus\n";
        echo "#\n";
        
        // dump all tables
        reset($tables);
        array_walk($tables, array($this, '_backup_dump_table'));
        
        if($gzip) {
            $Size = ob_get_length();
            $Crc = crc32(ob_get_contents());
            $contents = gzcompress(ob_get_contents());
            ob_end_clean();
            echo "\x1f\x8b\x08\x00\x00\x00\x00\x00".substr($contents, 0, strlen($contents) - 4). Backup::gzip_PrintFourChars($Crc) . Backup::gzip_PrintFourChars($Size);
        }
        
        exit;
    
    }


    /**
     * Creates a dump for a single table
     * ($tablename is filled in by array_walk)
     * @param $table_name
     */
    private function _backup_dump_table($table_name) {
    
        echo "#\n";
        if ( !$this->mode_en && defined('_BACKUP_BACKUPFILE_TABLE_NAME'))
            echo "# " . _BACKUP_BACKUPFILE_TABLE_NAME . $table_name . "\n";
        else
            echo "# TABLE: " . $table_name . "\n";
        echo "#\n";
    
        // dump table structure
        $this->_backup_dump_structure($table_name);
    
        // dump table contents
        $this->_backup_dump_contents($table_name);
    }

    /**
     * Creates a dump of the table structure for one table
     * @param $tablename
     */
    private function _backup_dump_structure($tablename) {

        $charset   = $this->export_db_charset;
        $collation = $this->export_db_collation;

        // add command to drop table on restore
        echo "DROP TABLE IF EXISTS $tablename;\n";
        $result = sql_query("SHOW CREATE TABLE $tablename");
        $create = sql_fetch_assoc($result);
        $CreateTable = $create['Create Table'];
        $CreateTable = preg_replace('@\s+COLLATE\s+([0-9a-zA-Z_]+)@'," COLLATE ${collation}", $CreateTable);
        $CreateTable = preg_replace('@CHARSET=([0-9a-zA-Z_]+)@',"CHARSET=${charset}", $CreateTable);
        $CreateTable = preg_replace('@COLLATE=([0-9a-zA-Z_]+)@',"COLLATE=${collation}", $CreateTable);

        echo $CreateTable;
        echo ";\n\n";
    }

    /**
     * Returns the field named for the given table in the
     * following format:
     *
     * (column1, column2, ..., columnn)
     * @param $result
     * @param $num_fields
     * @return string
     */
    private static function _backup_get_field_names($result, $num_fields) {
    
    /*    if (function_exists('mysqli_fetch_fields') ) {
            
            $fields = mysqli_fetch_fields($result);
            for ($j = 0; $j < $num_fields; $j++)
                $fields[$j] = $fields[$j]->name;
    
        } else {*/
    
            $fields = array();
            for ($j = 0; $j < $num_fields; $j++) {
                $fields[] = sql_field_name($result, $j);
            }
    
    /*    }*/
        
        return '(`' . implode('`, `', $fields) . '`)';    
    }

    /**
     * Creates a dump of the table content for one table
     * @param $table_name
     */
    private function _backup_dump_contents($table_name) {
        //
        // Grab the data from the table.
        //
        $row_count = intval(quickQuery("SELECT count(*) AS result FROM $table_name"));
        $result = sql_query("SELECT * FROM $table_name");
        if (!$result) return;
    
        if($row_count > 0)
        {
            if ( !$this->mode_en && defined('_BACKUP_BACKUPFILE_TABLEDATAFOR'))
                echo "\n#\n# " . sprintf(_BACKUP_BACKUPFILE_TABLEDATAFOR, $table_name) . "\n#\n";
            else
                echo "\n#\n# Table Data for $table_name\n#\n";
        }

        $num_fields = sql_num_fields($result);
        
        //
        // Compose fieldname list
        //
        $tablename_list = Backup::_backup_get_field_names($result, $num_fields);
            
        //
        // Loop through the resulting rows and build the sql statement.
        //
        while ($row = sql_fetch_array($result))
        {
            // Start building the SQL statement.
    
            echo "INSERT INTO `".$table_name."` $tablename_list VALUES(";
    
            // Loop through the rows and fill in data for each column
            for ($j = 0; $j < $num_fields; $j++) {
                if(!isset($row[$j])) {
                    // no data for column
                    echo ' NULL';
                } elseif ($row[$j] != '') {
                    // data
                    echo ' ' . sql_quote_string($row[$j]);
                } else {
                    // empty column (!= no data!)
                    echo "''";
                }
    
                // only add comma when not last column
                if ($j != ($num_fields - 1))
                    echo ',';
            }
    
            echo ");\n";
    
        }
    
    
        echo "\n";
    
    }

    /**
     * copied from phpBB
     * @param $Val
     * @return string
     */
    private static function gzip_PrintFourChars($Val)
    {
        $return = '';
        for ($i = 0; $i < 4; $i ++)
        {
            $return .= chr($Val % 256);
            $Val = floor($Val / 256);
        }
        return $return;
    }

    /**
     * Restores a database backup
     */    
    function do_restore() {
    
        $uploadInfo = postFileInfo('backup_file');
    
        // first of all: get uploaded file:
        if (empty($uploadInfo['name']))
            return ( !$this->mode_en && defined('_BACKUP_RESTOR_NOFILEUPLOADED') ? _BACKUP_RESTOR_NOFILEUPLOADED : 'No file uploaded');
        if (!is_uploaded_file($uploadInfo['tmp_name']))
            return ( !$this->mode_en && defined('_BACKUP_RESTOR_NOFILEUPLOADED') ? _BACKUP_RESTOR_NOFILEUPLOADED : 'No file uploaded');
    
        $backup_file_name = $uploadInfo['name'];
        $backup_file_tmpname = $uploadInfo['tmp_name'];
        $backup_file_type = $uploadInfo['type'];
    
        if (!is_file($backup_file_tmpname))
            return ( !$this->mode_en && defined('_BACKUP_RESTOR_UPLOAD_ERROR') ? _BACKUP_RESTOR_UPLOAD_ERROR : 'File Upload Error');
    
        if($backup_file_type==='application/download') $backup_file_type = 'application/octet-stream'; // For firefox
        if (!preg_match('@^(text/[a-zA-Z]+)|(application/(x\-)?gzip(\-compressed)?)|(application/octet-stream)$@is', $backup_file_type) )
            return sprintf("%s(%s)",
                    ( !$this->mode_en && defined('_BACKUP_RESTOR_UPLOAD_NOCORRECTTYPE') ? _BACKUP_RESTOR_UPLOAD_NOCORRECTTYPE : 'The uploaded file is not of the correct type'),
                    $backup_file_type);
    
    
        if (preg_match("/\.gz/is",$backup_file_name))
            $gzip = 1;
        else
            $gzip = 0;
    
        if (!extension_loaded("zlib") && $gzip)
            return ( !$this->mode_en && defined('_BACKUP_RESTOR_UPLOAD_NOZLIB') ? _BACKUP_RESTOR_UPLOAD_NOZLIB : 'Cannot decompress gzipped backup (zlib package not installed)');
    
        // get sql query according to gzip setting (either decompress, or not)
        if($gzip)
        {
            // decompress and read
            $gz_ptr = gzopen($backup_file_tmpname, 'rb');
            $sql_query = "";
            while( !gzeof($gz_ptr) )
                $sql_query .= gzgets($gz_ptr, 100000);
        } else {
            // just read
            $fsize = filesize($backup_file_tmpname);
            if ($fsize <= 0)
                $sql_query = '';
            else
                $sql_query = fread(fopen($backup_file_tmpname, 'r'), $fsize);
        }
    
        // remove utf-8 bom
        if (substr($sql_query, 0, 3) == "\xEF\xBB\xBF") {
            $sql_query = (strlen($sql_query)>3 ? substr($sql_query, 3) : '');
        }

        // time to execute the query
        $this->_execute_queries($sql_query);
        return '';
    }

    /**
     * Executes a SQL query
     * @param $sql_query
     */
    private function _execute_queries($sql_query) {
        if (!$sql_query) return;
    
        // Strip out sql comments...
        $sql_query = Backup::remove_remarks($sql_query);
        $pieces = $this->split_sql_file($sql_query);
    
        $sql_count = count($pieces);
        for($i = 0; $i < $sql_count; $i++)
        {
            $sql = trim($pieces[$i]);
    
            if(!empty($sql) and $sql[0] != "#")
            {
//                DEBUG
//                debug("Executing: " . hsc($sql) . "\n");
                $result = sql_query($sql);
                if (!$result) debug(_BACKUP_RESTOR_SQL_ERROR . sql_error());
    
            }
        }
    
    }

    /**
     * remove_remarks will strip the sql comment lines
     * out of an uploaded sql file
     * @param $sql
     * @return string
     */
    private static function remove_remarks($sql)
    {
        $lines = explode("\n", $sql);
    
        $linecount = count($lines);
        $output = "";
    
        for ($i = 0; $i < $linecount; $i++)
        {
            if (($i != ($linecount - 1)) || (strlen($lines[$i]) > 0))
            {
                // Notice: Uninitialized string offset: 0
                if (!isset($lines[$i][0]) || $lines[$i][0] != "#")
                {
                    $output .= $lines[$i] . "\n";
                }
                else
                {
                    $output .= "\n";
                }
                // Trading a bit of speed for lower mem. use here.
                $lines[$i] = '';
            }
        }
    
        return $output;
    
    }

    /**
     * split_sql_file will split an uploaded sql file
     * into single sql statements.
     *
     * Note: expects trim() to have already been run on $sql.
     * taken from phpBB
     * @param $sql
     * @return array
     */
    private function split_sql_file($sql)
    {
        // Split up our string into "possible" SQL statements.
        $tokens = explode( ';', $sql);
        $output = array();
    
        // this is faster than calling count($tokens) every time thru the loop.
        $token_count = count($tokens);
        for ($i = 0; $i < $token_count; $i++)
        {
            // Don't wanna add an empty string as the last thing in the array.
            if (($i != ($token_count - 1)) || (strlen($tokens[$i] > 0)))
            {
    
                // even number of quotes means a complete SQL statement
                if ($this->_evenNumberOfQuotes($tokens[$i]))
                {
                    $output[] = $tokens[$i];
                    $tokens[$i] = "";     // save memory.
                }
                else
                {
                    // incomplete sql statement. keep adding tokens until we have a complete one.
                    // $temp will hold what we have so far.
                    $temp = $tokens[$i] .  ";";
                    $tokens[$i] = "";    // save memory..
    
                    // Do we have a complete statement yet?
                    $complete_stmt = false;
    
                    for ($j = $i + 1; (!$complete_stmt && ($j < $token_count)); $j++)
                    {
                        // odd number of quotes means a completed statement
                        // (in combination with the odd number we had already)
                        if (!$this->_evenNumberOfQuotes($tokens[$j]))
                        {
                            $output[] = $temp . $tokens[$j];
    
                            // save memory.
                            $tokens[$j] = '';
                            $temp = '';
    
                            // exit the loop.
                            $complete_stmt = true;
                            // make sure the outer loop continues at the right point.
                            $i = $j;
                        }
                        else
                        {
                            // even number of unescaped quotes. We still don't have a complete statement.
                            // (1 odd and 1 even always make an odd)
                            $temp .= $tokens[$j] . ';';
                            // save memory.
                            $tokens[$j] = '';
                        }
    
                    } // for..
                } // else
            }
        }

        return $output;
    }

    /**
     * sub function of split_sql_file
     *
     * taken from phpBB
     * @param $text
     * @return bool
     */
    private function _evenNumberOfQuotes($text) {
            // This is the total number of single quotes in the token.
            $total_quotes = preg_match_all("/'/", $text, $matches);
            // Counts single quotes that are preceded by an odd number of backslashes,
            // which means they're escaped quotes.
            $escaped_quotes = preg_match_all("/(?<!\\\\)(\\\\\\\\)*\\\\'/", $text, $matches);
    
            $unescaped_quotes = $total_quotes - $escaped_quotes;
    //        debug($total_quotes . "-" . $escaped_quotes . "-" . $unescaped_quotes);
            return (($unescaped_quotes % 2) == 0);
    }
}

