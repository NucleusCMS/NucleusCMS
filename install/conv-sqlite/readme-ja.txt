* convtool

�������ŕϊ����s�����@

(1) web���炱�̃t�H���_�ɃA�N�Z�X���܂�

(2) ���O�C�����ĕϊ������܂�

(3) config.php�̕ύX �����܂�
    $MYSQL_HANDLER = array('pdo','sqlite');
    if ($MYSQL_HANDLER[1]=='sqlite')
    {
       $MYSQL_DATABASE = dirname(__FILE__) . str_replace('/', DIRECTORY_SEPARATOR, '/settings/db_nucleus.sqlite');
//     $MYSQL_DATABASE = 'pathto/' . 'db_nucleus.sqlite';
    }

���蓮�ōs�����@
�E�^�C���A�E�g���Ă��܂��ꍇ
�E�G���[���o��ꍇ
�E�ҏW�������ꍇ
�́A������𐄏��B

(1) config_conv_test.php ���쐬
   config.php����R�s�[

(2) �f�[�^�x�[�X��sqlite�ɕϊ�
php conv_sql_mysql_to_sqlite.php > nucleus-sqlite.sql
sqlite3 db_nucleus.sqlite < nucleus-sqlite.sql
�܂���
php conv_sql_mysql_to_sqlite.php | sqlite3 db_nucleus.sqlite

(3) db_nucleus.sqlite �� settings�t�H���_�Ɉړ����܂�

(4) config.php�̕ύX
    $MYSQL_HANDLER = array('pdo','sqlite');
    if ($MYSQL_HANDLER[1]=='sqlite')
    {
       $MYSQL_DATABASE = dirname(__FILE__) . str_replace('/', DIRECTORY_SEPARATOR, '/settings/db_nucleus.sqlite');
//     $MYSQL_DATABASE = 'pathto/' . 'db_nucleus.sqlite';
    }
 