<?php
/*
 * Created on 1-May-06
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

require("functions.php");

if($_REQUEST){
	$input = $_REQUEST;
	$name = $_REQUEST["name"];
}

mysql_start();
//var_dump($input);
foreach ($input as $qu => $data){
	//var_dump($qu);
	$string = "";
	if($qu != "name")
	{
		if(preg_match("/[A-Za-z]/",$qu)){
			if(!preg_match("/^__/",$qu)){
				$string = "$data";
				$query = "insert into survey_a values(\"$name\",12,\"$string\");";
				echo "<!--$qu-->\n";
				mysql_query($query) or die(mysql_error());
			}

		}else{
			$query = "insert into survey_a values(\"$name\",$qu,\"$data\");";
			mysql_query($query) or die("$query\n".mysql_error());
		}
	}


}

mysql_stop();

include_once("header.php");
echo "<h2>Thank you</h2><p>Thank you for completing the survey.</p>" .
		"<p>An email has been sent to you with your invoice. Please make payment before June 6th</p>";
include_once("footer.php");










?>
