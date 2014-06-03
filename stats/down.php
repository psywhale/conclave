<?php
/*
 * Created on 23-May-06
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */


 mysql_start();

 $result = mysql_query("select * from registration;");

$even

 header("Content-type: application/msexcel;");
 header('Content-disposition: inline; filename="MoodleMoot.csv"');
 echo "First Name,Last Name,Title,Company,Address,City,State,Zip,Email,Phone,Content_Camp,MoodleCon\n";
 while($row = mysql_fetch_row($result))
 {
 	foreach($row as $element)
 	{
 		$element = preg_replace("/,/",";",$element);
 		echo "$element,";
 	}
 	echo "\n";
 }

 echo "\n\nChanges made here will NOT be reflected in the database.\n\n";
 mysql_stop();

?>
