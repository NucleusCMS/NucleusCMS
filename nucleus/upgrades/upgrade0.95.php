<?

function upgrade_do95() {

$query =  "ALTER TABLE nucleus_blog"
       . " ADD bsendping tinyint(2) NOT NULL default '0'";
upgrade_query("Adding 'send ping' option",$query);

$query =  "ALTER TABLE nucleus_blog"
       . " ADD bconvertbreaks tinyint(2) NOT NULL default '1'";
upgrade_query("Adding convert linebreaks option",$query);

}

?>