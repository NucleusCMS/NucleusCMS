<p><a href="index.php?action=manage">({{ _BACKTOMANAGE }})</a></p>

<h2>{{ _OVERVIEW_COMPOSER }}</h2>

<a href="?action=composeroverview">リロード</a> <div>Composerコマンド実行:

@php
    $cmdlist = [
        ['パッケージ更新', 'update', 'update'],
        ['selfupdate', 'selfupdate', 'self-update --2'],
        ['show', 'show', 'show'],
        ['バージョン', 'version', '--version'],
        ['ヘルプ', 'help', '--help'],
    ];
    $tidx = 20;
@endphp

@foreach ($cmdlist as $items)
    <form method='post' action='index.php' class="composer-command-form"><p>
    <input type='hidden' name='action' value='composeroverview' />
    <input type='hidden' name='mode'   value='{{ $items[1] }}' />
    <input type='submit' value='{{ $items[0] }}' tabindex='{{ $tidx++ }}' />
    </p></form>
@endforeach
        
<?php

$cmd = '';
if (isset($_POST['mode'])) {
    foreach ($cmdlist as $item) {
        if ($item[1] === (string) $_POST['mode']) {
            $cmd = $item[2];
            break;
        }
    }
}

if ( ! empty($cmd)) {
    echo '<pre class="composer-output">';
    $o = ComposerCmd::RunComposer($cmd);
    if (is_array($o)) {
        echo implode("\n", $o);
    } else {
        echo $o;
    }
    echo '</pre>';
}
?>

</div>

<br />
Composer https://getcomposer.org/ <a href="https://getcomposer.org/download/" target="_blank" rel="nofollow">ダウンロード</a>
| <a href="https://getcomposer.org/doc/" target="_blank" rel="nofollow">ヘルプ</a>
