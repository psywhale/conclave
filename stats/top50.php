<?php
/*
 * Created on 22-Jun-06
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 mysql_start();
 $query = "select ndx, first_name, last_name, company_district from registration where company_district not like \"%WOSC%\" and company_district not like \"Western Oklahoma St%\" limit 0,50;";


 $counter = 0;
 echo "<p><h3>First 50 non WOSC Participants</h3></p><p><table class=\"special\">" .
 		"<tr><th></th><th>Name</th><th>Institution</th></tr>";
 $results = mysql_query($query);	
 while($row = mysql_fetch_assoc($results))
 {
 	$counter++;
 	echo "<tr><td>$counter</td><td><a href=\"index.php?z=name&d=$row[ndx]\">$row[first_name] $row[last_name]</td><td>$row[company_district]</td></tr>";
 	
 }
 
 mysql_stop();

  
 
 
 
?>
