<?php

if (!class_exists('\eftec\bladeone\BladeOne')) {
    if (PHP_VERSION_ID < 50600) {
        trigger_error('Error : blade template requires php 5.6 or higher.', E_USER_WARNING);
    } else {
        spl_autoload_register(
            function ($className) {
                $m = [];
                if (preg_match('/^\\\\?eftec\\\\bladeone\\\\(BladeOne(?:|Cache|CacheRedis|Custom))$/', $className, $m)) {
                    $f = __DIR__ . "/{$m[1]}.php";
                    if (@is_file($f)) {
                        include_once($f);
                    }
                }
            }
        );
    }
}
