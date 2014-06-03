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
 	$reg = mysql_fetch_array($results);
 	$ephone = $reg["911phone"];
 	echo "<h2> Emergency Contact / Medical Release  Form</h2>";
 	echo "<table style=border-collapse:separate><tr><td width=50%></td><td width=50%></td></tr>";
echo <<<END
<tr style="height:30px"><td style="border-bottom:2px solid; vertical-align:bottom" >Child: $reg[first_name] $reg[last_name] </td><td style="border-bottom:2px solid; vertical-align:bottom;"> Age: $reg[age]   Sex: $reg[gender]</td></tr>
<tr style="height:30px"><td style="border-bottom:2px solid; vertical-align:bottom;">Parent/Gaurdian:</td><td style="border-bottom:2px solid; vertical-align:bottom;">Emergency Contact:</td></tr>
<tr style="height:30px"><td style="border-bottom:2px solid; vertical-align:bottom;">Home Phone: $reg[phone]&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Work Phone: $reg[workphone]</td><td style="border-bottom:2px solid; vertical-align:bottom;">Emergency Phone: $ephone</td></tr>
<tr style="height:30px"><td style="border-bottom:2px solid; vertical-align:bottom;">Address: $reg[address]</td><td style="border-bottom:2px solid; vertical-align:bottom;">Address:</td></tr> 	
<tr style="height:30px"><td style="border-bottom:2px solid; vertical-align:bottom;">City,St, Zip:  $reg[city] , $reg[state] , $reg[zip]</td><td style="border-bottom:2px solid; vertical-align:bottom;">City,St, Zip:  </td></tr> 	
<tr style="height:30px"><td style="border-bottom:2px solid; vertical-align:bottom;">Email: $reg[email]</td><td style="border-bottom:2px solid; vertical-align:bottom;">Email: </td></tr> 
<tr style="height:30px"><td style="border-bottom:2px solid; vertical-align:bottom;" colspan=2>Allergies/Special Health Conditions: $reg[special_needs]</td></tr>
<tr style="height:70px"><td style="border-bottom:2px solid; vertical-align:bottom;" colspan=2>
<p>My child is physically fit to participate in vigorous physical activity and I authorize all medical and surgical treatment, X-ray, laboratory, anesthesia, and other medical and/or hospital procedures as may be performed or prescribed by the attending physician and/or paramedics for my child and waive my right to informed consent of treatment.  I understand I am responsible for all hospital, lab, and doctors fees. This waiver applies only in the event that neither parent/guardian can be reached in the case of an emergency. </p>
</td></tr>

<tr style="height:70px"><td style="border-bottom:2px solid; vertical-align:bottom;">Parent/Gaurdian Signature</td><td style="border-bottom:2px solid; vertical-align:bottom;">Date</td></tr>

<tr style="height:70px"><td style="border-bottom:2px solid; vertical-align:bottom;" colspan=2>
<p>Dear Parent/Guardian,<br/>Pond Scum and Water Critters class is going on a field trip to the Reservoir. They will be observing the pond life and will collect samples for experiments. College will provide transportation to and from the Reservoir. This trip is included in the cost, and the instructor should provide everything that is needed for this trip. In addition to the instructor a bus driver/staff member will accompany them.</p>
</td></tr>

<tr style="height:70px"><td style="border-bottom:2px solid; vertical-align:bottom;">Parent/Gaurdian Signature</td><td style="border-bottom:2px solid; vertical-align:bottom;">Date</td></tr>

</table> 	
END;

 	
 	

 }
 else
 {
 	//Just list names of all participants with links to detailed versions
 	echo "<p>" .
 			"<table class=\"special\">" .
 			"<tr ><th>Alphabetic listing of Participants</th><th># of Attending Events</th></tr>" .
 			"";
 	$allreg_q = mysql_query("select * from registration order by last_name;");
 	while($row=mysql_fetch_object($allreg_q)){
 	    
 	
 	   $events = getAttendance($row->security);
 	   $count = sizeof($events);
 	   /*echo "<pre>";
 	   var_dump($events);
 	   echo "</pre>";*/
 	   echo "<tr><td ><a href=\"index.php?z=name&d=$row->ndx\">$row->first_name $row->last_name</a></td><td >$count</td></tr>";
 	   
 	}//end of while loop
 	echo "</table>";

 }


 mysql_stop();
?>
