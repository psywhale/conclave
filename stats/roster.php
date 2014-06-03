<?php

mysql_start();

if($d) {
   $event_name = getEventName($d);
   echo '<h2>'.$event_name.'</h2><table border=1><tr>'.
   '<th>Name</th><th>Age</th><th>Gender</th><th>Phones</th><th>Special Needs (if any)</th></tr>';
   
   $query = "select * from attendance where event_code =\"$d\";";
   mysql_start();
   $results = mysql_query($query);
   while($attending = mysql_fetch_object($results)) {
      if($attending->paid == "Y"){
            $user_info = getUser("$attending->user_code");
            echo "<tr><td>".$user_info["first_name"]." &nbsp;";
            echo $user_info["last_name"]."</td>";
            echo "<td>".$user_info["age"]."</td>";
            echo "<td>".$user_info["gender"]."</td>";
            echo "<td>H:". $user_info["phone"]."<br/>";
            echo "W: ".$user_info["workphone"]."<br/>";
            echo "E: ".$user_info["911phone"]."</td>";
            echo "<td>".$user_info["special_needs"]."</td></tr>";
       }
   }
   echo '</table>';

}
else{
mysql_start();
$result = mysql_query("select * from conferences;");
 printheader($a);
 echo "<p> Click Event Name to print roster" .
 		"<table class=\"special\">" .
 		"<tr><th>Event</th></tr>";
 
 while($conferences = mysql_fetch_object($result)){
     $query_attendance = "select count(*) from attendance where event_code = \"$conferences->event_code\";";
     $attendance_results = mysql_query($query_attendance);
     $attend_total = mysql_fetch_array($attendance_results);
     if($attend_total[0] > 0)
     echo "<tr><td><a href=\"$CFG->wwwsite/stats/index.php?z=roster&d=$conferences->event_code\">$conferences->title</a></td></tr>";
     
 } 		
}
// mysql_stop();
echo "</table><a href=$CFG->wwwsite/stats/index.php?z=roster>Back to Rosters</a>";
?>

