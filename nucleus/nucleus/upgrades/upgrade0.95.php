<?php
function upgrade_do95() {

	if (upgrade_checkinstall(95))
		return "already installed";

	if(!upgrade_checkIfColumnExists('blog', 'bconvertbreaks')){
		$query =  'ALTER TABLE '.sql_table('blog')
			   . " ADD bsendping tinyint(2) NOT NULL default '0',"
			   . " ADD bconvertbreaks tinyint(2) NOT NULL default '1'";
		upgrade_query("Adding 'send ping' and convert linebreaks options",$query);
	}else{
		echo "<li>Adding 'send ping' and convert linebreaks options ... <span class=\"warning\">NOT EXECUTED</span>\n<blockquote>Errors occurred during upgrade process.</blockquote>";
	}
}

?>