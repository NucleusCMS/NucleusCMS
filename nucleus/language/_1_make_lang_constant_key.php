<?php

// Extract names of Nucleus constants and save to ./lang_const_keys.json

$files = ['japanese-utf8.php', 'english-utf8.php'];

$orig = get_defined_constants();
foreach ($files as $filename) {
    $filename = __DIR__ . DIRECTORY_SEPARATOR . $filename;
    if (is_file($filename)) {
        include_once($filename);
    }
}
$new = get_defined_constants();

$keys         = [];
$keys['lang'] = array_diff(array_keys($new), array_keys($orig));
natsort($keys['lang']);

$json = json_encode(array_merge($keys['lang']), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
file_put_contents(__DIR__ . '/lang_const_keys.json', $json);
var_export($json);

printf("\n\n");
printf("lang_const_keys.json\n");
printf("lang    : %d\n", count($keys['lang']));

function try_define($name, $value)
{
    if ( ! defined($name)) {
        define($name, $value);
    }
}
