<?php

namespace com\github\nucleuscms\core\Upgrade;

class UpgradeTo
{
    public $coredbversion = 0;
    public $success       = false;
    public array $errors  = [];

    public function version()
    {
        return 0;
    }

    public function __construct()
    {
        global $CONF;

        // 呼び出す前に古いものにフィルターしているので、新しいものは基本的にここには登場しない
        if (empty($CONF['DatabaseVersion']) || (371 > (int) $CONF['DatabaseVersion'])) {
            exit;
        }
        if ( ! \defined('NUCLEUS_DATABASE_VERSION_ID')) {
            exit;
        }

        $this->coredbversion = \constant('NUCLEUS_DATABASE_VERSION_ID');
        // 古い場合は doUpgrade を呼ぶ
        if ($this->coredbversion > $this->version()
            || ((int) $CONF['DatabaseVersion'] < $this->version())) {
            $this->doUpgrade();
            // 失敗したので 中断する
            if ( ! $this->success || ! empty($this->errors)) {
                return;
            }
        } else {
            // skip
        }
        //　失敗している場合はこの行には出現しない
        //
        // 次のステップの登録がない場合は、アップグレード終端なのでコアのバージョンを登録して終了する
        if ( ! method_exists($this, 'doNextUpgrade')) {
            $this->endUpgrade();
            return ;
        }
        // 古い場合は doNextUpgrade を呼ぶ
        if (($this->coredbversion > $CONF['DatabaseVersion'])) {
            $this->doNextUpgrade();
        }
    }

    protected function updateOrInsertConfig($name, $value)
    {
        global $CONF;
        if ( ! class_exists('ADMIN')) {
            include_libs('ADMIN.php');
        }
        \ADMIN::updateOrInsertConfig($name, $value);
        $CONF[$name] = $value;
    }

    protected function updateVersion(int $version)
    {
        global $CONF;
        getOrmQueryBuilder()
                ->update(sql_table('config'))
                ->set('value', $version)
                ->where('name = :name')
                ->setParameter('name', 'DatabaseVersion')
                ->executeStatement();
        $CONF['DatabaseVersion'] = $version;
        $this->success           = true;
    }

    protected function doUpgrade()
    {
        // do nothing
        // $this->updateVersion($this->version());
    }

    private function endUpgrade()
    {
        // アップグレードの終了処理

        // データベースバージョンを更新して終了する
        // コアより新しい場合はスキップする
        // コアのバージョンより古ければ、コアのバージョンへ更新する
        if ($this->success) {
            $sql = sprintf("UPDATE %s SET value = :value WHERE name = :name ", sql_table('config'))
                  . ' AND CAST(value AS UNSIGNED) < CAST(:value AS UNSIGNED)';
            sql_prepare_execute($sql, ['name' => 'DatabaseVersion', 'value' => NUCLEUS_VERSION_ID]);
        }
    }

    protected function upgradeQueryExecute($sql, $params = [])
    {
        try {
            // if error, throws Exception
            $res = getOrmConnection()->executeQuery($sql, $params);
        } catch (Exception $exc) {
            $this->errors[] = $exc->getMessage();
            return false;
        }
        return true;
    }

    public static function isOldVersion()
    {
        $sql    = sprintf("SELECT value FROM %s WHERE name = :name ", sql_table('config'));
        $params = ['name' => 'DatabaseVersion'];// , 'value' => NUCLEUS_VERSION_ID
        $ver    = (int) sql_direct_getValue_AsInt($sql, $params);
        if ($ver >= NUCLEUS_VERSION_ID) {
            global $CONF;
            $CONF['DatabaseVersion'] = $ver;
        }
        return ($ver < NUCLEUS_VERSION_ID);
    }
}

include_once(__DIR__ . '/UpgradeTo380.php');
