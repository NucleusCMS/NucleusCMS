<?php

if (!class_exists('\eftec\bladeone\BladeOne')) {
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
