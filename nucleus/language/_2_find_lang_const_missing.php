<?php

// usage:
//  php (language)-utf8.php
//      check only
//  php (language)-utf8.php add
//      Add missing definitions to end of the file

$mode_add = false;
for ($i = 2; $i < $argc; $i++) {
    if ('add' === $argv[$i]) {
        $mode_add = true;
        break;
    }
}

$argv[1] = strtolower($argv[1]);
$defalut = ['english-utf8.php', 'japanese-utf8.php'];
if (in_array($argv[1], $defalut)) {
    foreach ($defalut as $name) {
        if ($argv[1] !== $name) {
            $defalut = $name;
            break;
        }
    }
}
if (is_array($defalut)) {
    $defalut = $defalut[0];
}

$targetfilename = __DIR__ . DIRECTORY_SEPARATOR . $argv[1];
if ($argc > 0 && is_file($targetfilename) && preg_match('/-utf8.php$/i', $targetfilename)) {
    $keys = [];
    $orig = get_defined_constants();
    include_once($targetfilename);
    $new = get_defined_constants();

    if (empty($orig) || empty($new)) {
        printf('Error: $orig:%d $new:%d', count($orig), count($new));
        exit;
    }

    $keys['lang']     = array_diff(array_keys($new), array_keys($orig));
    $keys['all']      = json_decode(file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'lang_const_keys.json'));
    $keys['$missing'] = array_merge(array_diff($keys['all'], $keys['lang']));

    include_once(__DIR__ . '/' . $defalut);

    if (count($keys['$missing'])) {
        $data_missing = [];
        $data         = [];
        foreach ($keys['$missing'] as $name) {
            if (defined($name)) {
                $data[] = sprintf("try_define('%s', %s);", $name, var_export(constant($name), true));
            } else {
                $data_missing[] = sprintf("// try_define('%s', '');", $name);
            }
        }
        $data         = "\n\n".implode("\n", $data). "\n";
        $data_missing = 0 == count($data_missing) ? '' : implode("\n", $data_missing). "\n";
        if ($mode_add) {
            $fh = fopen($targetfilename, 'a+');
            if ($fh) {
                fwrite($fh, $data);
                fclose($fh);
            }
        }
        printf("%s\n", $data);
        printf("%s\n", $data_missing);
    }
    printf("total   : %d\n", count($keys['all']));
    printf("lang    : %d / %s\n", count($keys['lang']), $argv[1]);
    printf("missing : %d\n", count($keys['$missing']));

    if (count($keys['all']) < count($keys['lang'])) {
        printf("\n ***** unknown constant ***** in %s\n", basename($targetfilename));
        $diff = array_merge(array_diff($keys['lang'], $keys['all']));
        sort($diff);
        var_export($diff);
    }
}

function try_define($name, $value)
{
    if ( ! defined($name)) {
        define($name, $value);
    }
}
