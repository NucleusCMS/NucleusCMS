* convtool

◆自動で変換を行う方法

(1) webからこのフォルダにアクセスします

(2) ログインして変換をします

(3) config.phpの変更 をします
    $MYSQL_HANDLER = array('pdo','sqlite');
    if ($MYSQL_HANDLER[1]=='sqlite')
    {
       $MYSQL_DATABASE = dirname(__FILE__) . str_replace('/', DIRECTORY_SEPARATOR, '/settings/db_nucleus.sqlite');
//     $MYSQL_DATABASE = 'pathto/' . 'db_nucleus.sqlite';
    }

◆手動で行う方法
・タイムアウトしてしまう場合
・エラーが出る場合
・編集したい場合
は、こちらを推奨。

(1) config_conv_test.php を作成
   config.phpからコピー

(2) データベースをsqliteに変換
php conv_sql_mysql_to_sqlite.php > nucleus-sqlite.sql
sqlite3 db_nucleus.sqlite < nucleus-sqlite.sql
または
php conv_sql_mysql_to_sqlite.php | sqlite3 db_nucleus.sqlite

(3) db_nucleus.sqlite を settingsフォルダに移動します

(4) config.phpの変更
    $MYSQL_HANDLER = array('pdo','sqlite');
    if ($MYSQL_HANDLER[1]=='sqlite')
    {
       $MYSQL_DATABASE = dirname(__FILE__) . str_replace('/', DIRECTORY_SEPARATOR, '/settings/db_nucleus.sqlite');
//     $MYSQL_DATABASE = 'pathto/' . 'db_nucleus.sqlite';
    }
 