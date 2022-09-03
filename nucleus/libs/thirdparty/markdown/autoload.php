<?php

if (!class_exists('\cebe\markdown\Markdown')) {
    spl_autoload_register(
        function ($className) {
        $m = [];
        if (preg_match('/^\\\\?cebe\\\\markdown((?:\\\\[\w]+){1,3})$/', $className, $m)) {
            $f = __DIR__ . "/{$m[1]}.php";
            if (@is_file($f)) {
                include_once($f);
            }
        }
    }
    );
}
