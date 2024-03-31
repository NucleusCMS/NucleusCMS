<?php

/*
 * license GNU General Public License
 * Copyright (C) torisanbird
 */

class ComposerCmd
{
    public static function doError($msg)
    {
        global $manager;
        if ( ! empty($manager)) {
            \doError($msg);
        }
        exit($msg);
    }

    public static function CheckAndInstall()
    {
        $filelock = __DIR__.'/composer.lock';
        if (@ ! is_file($filelock) && ! @is_file(__DIR__.'/vendor/autoload.php')) {
            self::RunComposer('install');
            if ( ! @is_file(__DIR__.'/vendor/autoload.php')) {
                if ( ! \defined('NC_MTN_MODE') || ('install' !== \constant('NC_MTN_MODE'))) {
                    \ExitUnderMaintenance();
                }
                $msg = 'オートロードを設定開始できませんでした。手動で設定してください';
                self::doError($msg);
            }
        } else {
            $mtime = (@ ! is_file($filelock) ? (int) filemtime($filelock) : 0);
            if (60 * 60 * 1 < time() - $mtime) {
                // RunComposer('update');
            }
        }
    }

    public static function RunComposer($param)
    {
        $composer = __DIR__.'/composer.phar';
        if (@( ! is_file($composer) || (60 * 60 * 24 <= time() - (int) filemtime($composer)))) {
            @copy('https://getcomposer.org/composer.phar', $composer);
        }
        if (@ ! is_file($composer)) {
            return;
        }
        $php = self::GetPathPHP();
        if (empty($php) || (false === strpos($php, 'php'))) {
            return;
        }
        $DIR   = str_replace("\\", '/', __DIR__);
        $cmd   = [];
        $cmd[] = sprintf('chdir %s', escapeshellarg(__DIR__));
        $isWin = ('win' === strtolower(substr(PHP_OS, 0, 3)));
        //$cmd[] = ($isWin ? 'set' : 'export')." COMPOSER_HOME=./.composer"; // .composer
        foreach (self::GetComposerEnv() as $k => $v) {
            $cmd[] = ($isWin ? 'set' : 'export') . " " . escapeshellarg("{$k}={$v}");
        }
        $cmd[] = escapeshellarg($php)." -d memory_limit=512M {$composer} {$param} 2>&1";
        $cmd   = implode('&&', $cmd);
        @exec($cmd, $out);
        //var_dump($cmd, implode("<br>\n", $out));
    }

    public static function GetPathPHP()
    {
        global $CONF;
        if ( ! empty($CONF['PHP_BIN'])) {
            $php = strtr((string) $CONF['PHP_BIN'], ['|' => '', '>' => '', '<' => '', '&' => '']);
            if (0 !== strcmp($php, (string) $CONF['PHP_BIN'])) {
                return;
            }
            return $php;
        }
        if ('win' === strtolower(substr(PHP_OS, 0, 3))) {
            $extdir = ini_get('extension_dir');
            $php    = dirname($extdir) . DIRECTORY_SEPARATOR . 'php.exe';
            if (@ ! is_file($php)) {
                $php = 'php.exe';
            }
        } else {
            foreach ([
                '/usr/local/bin/php',
                '/usr/bin/php',
                '/usr/local/php/bin/php',
                '/usr/local/php/8.3/bin/php',
                '/usr/local/php/8.2/bin/php',
                ] as $php) {
                if (@ is_file($php)) {
                    break;
                }
            }
            if (@ ! is_file($php)) {
                $php = 'php';
            }
        }
        return $php;
    }

    public static function GetComposerEnv()
    {
        //global $DIR_LIBS;
        $path = __DIR__ . DIRECTORY_SEPARATOR;
        //if (! empty($DIR_LIBS) && @is_dir(realpath($DIR_LIBS)) ) {
        //    $path = realpath($DIR_LIBS) . DIRECTORY_SEPARATOR;
        //}
        $env = [
            'COMPOSER_HOME' => $path . 'composer',
            //'COMPOSER_CACHE_DIR' => $path . 'composer' . DIRECTORY_SEPARATOR . 'cache',
            //'COMPOSER_CACHE_DIR' => $path . '../cache/composer' . DIRECTORY_SEPARATOR . 'cache',
            'COMPOSER_VENDOR_DIR' => $path . 'vendor',
        ];
        //        foreach ($env as $k => $v) {
        //            putenv($k . "=" . escapeshellarg($v));
        //        }
        return $env;
    }
}

ComposerCmd::CheckAndInstall();
