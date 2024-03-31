<?php

// UpgradeDB.php

global $CONF;

// 直接起動などを終了する
if (empty($CONF) || ! \defined('NUCLEUS_DATABASE_VERSION_ID')) {
    exit;
}

// インストールまたはアップグレードスクリプト起動中なので 呼び出し元に戻す
if (\defined('NC_MTN_MODE')) {
    if (('upgrade' === NC_MTN_MODE) || ('install' === NC_MTN_MODE)) {
        return;
    }
}

// データベースバージョンがかなり古いので アップグレードを案内して終了する
if (empty($CONF['DatabaseVersion']) || (371 > (int) $CONF['DatabaseVersion'])) {
    ExitDbTooOldGoto371();
}

// 現在のバージョン または より新しいので 呼び出し元に戻す
if (NUCLEUS_DATABASE_VERSION_ID <= (int) $CONF['DatabaseVersion']) {
    return;
}
// この行以降は、データベースバージョンが古いのでアップグレード対象

// 必要なファイルがそろっているか確認する
// アップロード中？
foreach ([
    'UpgradeDB.php', 'UpgradeTo.php', 'UpgradeTo380.php',
   ] as $f
) {
    if ( ! @is_file(__DIR__ . "/{$f}") || empty(@filesize(__DIR__ . "/{$f}"))) {
        ExitUnderMaintenance();
    }
}

// 自動更新中で30分経過: おかしいので解除
if ( ! empty($CONF['AutoUpdating']) && (60 * 30 < time() - (int) $CONF['AutoUpdating'])) {
    ToggleAutoUpdating(false);
    $lock = __DIR__ . '/update.lock';
    if (@is_file($lock)) {
        @unlink($lock);
    }
}

// 更新中メインテナンスに切り替え
if ( ! empty($CONF['AutoUpdating'])) {
    ExitUnderMaintenance();
}

$lock = __DIR__ . '/update.lock';
if (@is_file($lock)) {
    ExitUnderMaintenance();
}

try {
    ToggleAutoUpdating(true);
    @touch($lock);
    // アップグレード開始
    include_once(__DIR__ . '/UpgradeTo.php');
} catch (Exception $exc) {
    //echo $exc->getTraceAsString();
    // 終了後の処理
    if (@is_file($lock)) {
        @unlink($lock);
    }
    ToggleAutoUpdating(false);
    ExitUnderMaintenance();
} finally {
    // 終了後の処理
    if (@is_file($lock)) {
        @unlink($lock);
    }
    ToggleAutoUpdating(false);
}

if ( ! class_exists('\com\github\nucleuscms\core\Upgrade\UpgradeTo') || \com\github\nucleuscms\core\Upgrade\UpgradeTo::isOldVersion()) {
    // メンテナンス中にする
    ExitUnderMaintenance();
}
