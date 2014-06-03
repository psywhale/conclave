<?php
/*
 * Created on 23-May-06
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

mysql_start();
mysql_query("create temporary table test select company_district,count(*) from registration group by company_district;")or die(mysql_error());
mysql_query("alter table test add ndx int(4) primary key auto_increment;")or die(mysql_error());
if($d) 
{
	
	
	$results=mysql_query("select company_district from test where ndx = \"$d\";");
	$data = mysql_fetch_object($results);
	echo "<p><table><tr><th>List of people from $data->company_district</th></tr>";
	$results = mysql_query("select * from registration where company_district = \"$data->company_district\";");
	while($row=mysql_fetch_object($results))
	{
		echo "<tr><td><a href=\"index.php?z=name&d=$row->ndx\">$row->first_name $row->last_name</a></td></tr>";
	}
	echo "</table></p>";
		
}

echo  "<p>" .
			"<table class=\"special\">" .
			"<tr><th>Institution</th><th># of People</th></tr>" .
			"";

$results = mysql_query("select * from test;") or die(mysql_error());
while($districts = mysql_fetch_array($results))
{
	echo "<tr><td>$districts[0]</td><td><a href=\"index.php?z=dist&d=$districts[2]\">$districts[1]</a></td></tr>";
}
echo "</table></p>";	



mysql_stop();
?>	