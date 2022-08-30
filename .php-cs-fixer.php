<?php

// https://github.com/FriendsOfPHP/PHP-CS-Fixer
//   see Editor Integration
//
// command line
// php-cs-fixer fix 
// php-cs-fixer --config=.php-cs-fixer.php fix 
// php php-cs-fixer.phar --config=.php-cs-fixer.php fix


// --version=3
$rules = [
//  '@PSR12'            => true,  // 適用 PHP7.1 以上 // PHP[5-7.0] Class public const で エラーになる
    '@PSR2'             => true,
    'phpdoc_separation' => false,
    'phpdoc_align' => ['align' => 'vertical',], // 垂直揃え
    'multiline_whitespace_before_semicolons' => ['strategy' => 'no_multi_line'],
    'blank_line_after_opening_tag' => true, // php開始タグの後ろに改行を入れる , doc/rules/php_tag/
    'no_spaces_around_offset' => ['positions'=>['inside']],  // [  'outside' ] -->  ['inside']
    'function_typehint_space' => true, // function abc(string   $a) -->  (string $a)
    'braces' => ['allow_single_line_anonymous_class_with_empty_body' => true, 'allow_single_line_closure' => true],
    'no_trailing_comma_in_singleline_array' => true, // single-line arrays should not have trailing comma.
   ];

// https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/master/doc/list.rst
// php-cs-fixer list-sets
$rules_array = [
//    'array_syntax' => ['syntax' => 'short'],  // PHP[5.4-] array() を [] に変換
    'array_syntax' => ['syntax' => 'long'],   // [] を array()に変換
    'no_trailing_comma_in_list_call'                => true, // Remove trailing commas in list function calls.
    'no_trailing_comma_in_singleline_array'         => true, // single-line arrays should not have trailing comma.
    'no_trailing_comma_in_singleline_function_call' => true, // When making a method or function call on a single line there MUST NOT be a trailing comma after the last argument.
//    'trailing_comma_in_multiline' => ['elements' => ['arrays']], // 配列の最後にコンマを付与する
//    'concat_space' => ['spacing' => 'one'],
//    'no_spaces_around_offset' => ['positions' => ['inside']], 
    'no_spaces_inside_parenthesis' => true, // ( $a )  --> ($a)
//    'not_operator_with_space' => !true, //  (!$bar) --> ( ! $bar)
//    'not_operator_with_successor_space'  => !true, //  (!$bar) --> (! $bar)
    'no_whitespace_in_blank_line' => true,
    'no_extra_blank_lines' => ['tokens' => ['extra']], // https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/master/doc/rules/whitespace/no_extra_blank_lines.rst
];

// https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/master/doc/rules/operator/binary_operator_spaces.rst
$rules_array['binary_operator_spaces'] = ['operators' => [
        '=>' => 'align_single_space_minimal',
        '=' => 'align_single_space_minimal',
    ]];

$rules_array += [
    'declare_strict_types' => false, // declare(strict_types=1);
    'modernize_strpos'     => false, // Replace strpos() calls with str_starts_with() or str_contains() if possible.
    'no_php4_constructor'  => false, // remove old style class constructor
];

//
// php-cs-fixer fix --allow-risky=yes
// 
// use --allow-risky=yes option
global $argv;
$allow_risky = in_array('--allow-risky=yes', $argv);
if ($allow_risky) {
    $rules_risky = [
        'implode_call' => true, // auto fix - PHP8.0 : Fatal error: Uncaught TypeError: implode()
        'no_alias_functions' => true, // sizeをcountに置換など
//        'no_unreachable_default_argument_value'  => true, // https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/master/doc/rules/function_notation/no_unreachable_default_argument_value.rst
        'random_api_migration' => ['replacements'=>['getrandmax' => 'mt_getrandmax', 'rand' => 'mt_rand', 'srand' => 'mt_srand']], // https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/master/doc/rules/alias/random_api_migration.rst
        'explicit_string_variable' => true, //  "$bar" --> "{$bar}"
        ];
    $rules = array_merge($rules, $rules_risky);
//    $rules = $rules_risky;
}

$rules += $rules_array;


$excludes = [
    'build', 'archives',
    'extra', 'skins', 'settings', 'styles',
    '_upgrades/langs', '_upgrades\\langs', // _upgrades\langs\ : [v380 - ]
    'nucleus/convert', 'nucleus\\convert', // nucleus\convert  : [ - v371]
    'documentation', 'nucleus/documentation', 'nucleus\\documentation',
    'images', 'nucleus/images', 'nucleus\\images',
    'language', 'nucleus/language', 'nucleus\\language',
    'javascript', 'nucleus/javascript', 'nucleus\\javascript',
    'nbproject',
];

sort($excludes);

$notPath = [
    '/^archives/', // 正規表現
    '/^build/',    // 正規表現
    '/_lang_/',    // 正規表現
];

$notName = [
    '.php-cs-fixer.php',
    '*utf8.php', 
    'japanese.php', '*euc.php',
    'english.php',
];

if ($allow_risky) {
    $notPath[] = '/phpfunctions.php$/';
    $notName[] = 'phpfunctions.php';
}

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude($excludes) // not work
    ->notPath($notPath)
     ->notName('README.md')
     ->notName('*.xml')
     ->notName('*.yml')
     ->notName('*.json')
     ->notName('*.ctp')
     ->notName('*.js')
     ->notName($notName)
;

//var_dump($finder);

return (new PhpCsFixer\Config())
    ->setRules($rules)
    // ->setIndent("\t")
    ->setLineEnding("\n")
    ->setFinder($finder);


//  コマンドから 引数渡すと 全部にマッチ　(除外指定が働かない : 肯定が優先？)
//  OK : php-cs-fixer fix
//  NG : php-cs-fixer fix .
//  NG : php-cs-fixer fix ./
//  NG : php-cs-fixer fix path

//  https://symfony.com/doc/current/components/finder.html
//$finder->path('foo/bar');      string
//$finder->path('/^foo\/bar/');  regular expression
