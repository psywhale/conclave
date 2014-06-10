<?php
/*
 * Created on 23-May-06
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 mysql_start();

 if($d)
 {
 	//add code for detailed stuff for particpant
 	$results = mysql_query("select * from registration where ndx=\"$d\";");
 	$data = mysql_fetch_array($results);
 	echo "<p>" .
 			"<table>" .
 			"<tr><td>Name:</td><td>$data[first_name] $data[last_name]</td></tr>" .
 			"<tr><td>Age:</td><td>$data[age]</td></tr>" .
 			"<tr><td>Gender:</td><td>$data[gender]</td></tr>" .
 			"<tr><td>Address:</td><td>$data[address]</td></tr>" .
 			"<tr><td></td><td>$data[city] ,$data[state] $data[zip]</td></tr>" .
 			"<tr><td>Email:</td><td>$data[email]</td</tr>" .
 			"<tr><td>Phone:</td><td>$data[phone]</td></tr>" .
 			"<tr><td>Work Phone:</td><td>$data[workphone]</td></tr>" .
 			"<tr><td>Emergency Phone:</td><td>".$data["911phone"]."</td></tr>" .
 			"<tr><td>Special Needs:</td><td>".$data["special_needs"]."</td></tr>" .
 			"<tr><td colspan='2'><input type=button value='Display Invoice' onClick=\"window.location='$CFG->wwwsite/statement.php?z=$data[security]'\"/></td></tr>" .
 			"<tr><td colspan='2'><input type=button value='Medical Release Form' onClick=\"javascript:window.open('$CFG->wwwsite/stats/index.php?z=form&d=$d','Print','height=600','width=760');\"/></td></tr>" .
                        "<tr><td colspan='2'><input type=button value='Photo Release Form' onClick=\"javascript:window.open('$CFG->wwwsite/pdf/minorphotoform.pdf','Print','height=600','width=760');\"/></td></tr>" .
 			"</table></p>" .
 			"" .
 			"<p>" .
 			"<table>" .
 			"<tr><th>Attending Events</th><th>Paid?</th></tr>";
        $events = getAttendance($data[security]);
         foreach($events as $event) {
            if(isPaid($data[security],$event->event_code) == "N")
            {  $payButton = "<input type=button value='Yes' onClick=\"window.location='$CFG->wwwsite/stats/pay4event.php?u=$data[security]&e=$event->event_code&d=$d&z=$z'\"/>";
               $payButton .= "&nbsp;  <input type=button value='REMOVE from Invoice' onClick=\"window.location='$CFG->wwwsite/stats/rmevent.php?u=$data[security]&e=$event->event_code&i=$event->ndx&d=$d&z=$z'\"/>";
            }
            elseif(isPaid($data[security],$event->event_code) == "Y") {
               $payButton = "<img src=\"$CFG->wwwsite/template/images/check.png\"/> &nbsp;  <input type=button value='DROP for refund' onClick=\"window.location='$CFG->wwwsite/stats/dropevent.php?u=$data[security]&e=$event->event_code&d=$d&z=$z'\"/>";
            }
            elseif(isPaid($data[security],$event->event_code) == "D") {
               $payButton = "<strong>Paid for but DROPPED</strong>";
            }
            elseif(isPaid($data[security],$event->event_code) == "S") {
               $payButton = "<strong>DISCOUNTED</strong>";
            }
            echo "<tr><td><a href=\"$CFG->wwwsite/stats/index.php?z=con&d=$event->event_code\">$event->title</a></td><td>$payButton</td></tr>";
         }
         echo "</table></p>";
         echo "<p><hr/><table><tr><th>Events Not Attending</th><th>Add?</th></tr>";
         $events = getEventsNotAttending($data[security]);
         foreach($events as $event) {
            if($date !== $event->date) {
		echo "<tr><td colspan=2><hr/></td></tr>";
	    }
            $payButton = "<input type=button value='Add' onClick=\"window.location='$CFG->wwwsite/stats/adduser2event.php?u=$data[security]&e=$event->event_code&d=$d&z=$z'\"/>";
                 
            echo "<tr><td><a href=\"$CFG->wwwsite/stats/index.php?z=con&d=$event->event_code\">$event->title $event->date $event->time</a></td><td>$payButton</td></tr>";
	    $date = $event->date;
         }
         
         
         
 	echo "</table></p>";




 }
 else
 {
 	//Just list names of all participants with links to detailed versions
 	echo "<p>" .
 			"<table class=\"special\">" .
 			"<tr><th>Alphabetic listing of Participants</th><th># of Attending Events</th></tr>" .
 			"";
 	$allreg_q = mysql_query("select * from registration order by last_name;");
 	while($row=mysql_fetch_object($allreg_q)){
 	    
 	
 	   $events = getAttendance($row->security);
 	   $count = sizeof($events);
 	   /*echo "<pre>";
 	   var_dump($events);
 	   echo "</pre>";*/
 	   echo "<tr><td><a href=\"index.php?z=name&d=$row->ndx\">$row->first_name $row->last_name</a></td><td>$count</td></tr>";
 	   
 	}//end of while loop
 	echo "</table>";

 }


 mysql_stop();
?>
