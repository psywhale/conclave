<?php
function mysql_start()
{
        global $CFG;
	 mysql_connect("$CFG->dbhost","$CFG->dbuser","$CFG->dbpassword") or die(mysql_error());
	 mysql_select_db("$CFG->dbname") or die(mysql_error());
}

function mysql_stop()
{
	mysql_close();
}

function mysql_sql($query = "") {
   
   
}

?>
