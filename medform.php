<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'config.php';

$d = $_REQUEST["d"];
printHeader("none",true);

 mysql_start();

 if($d)
 {
 	//add code for detailed stuff for particpant
 	$results = mysql_query("select * from registration where security=\"$d\";");
 	$reg = mysql_fetch_array($results);
 	$ephone = $reg["911phone"];
 	echo "<h2> Emergency Contact / Medical Release  Form</h2>";
 	echo "<table style=border-collapse:separate><tr><td width=50%></td><td width=50%></td></tr>";
echo <<<END
<tr style="height:70px"><td style="border-bottom:2px solid; vertical-align:bottom" >Child: $reg[first_name] $reg[last_name] </td><td style="border-bottom:2px solid; vertical-align:bottom;"> Age: $reg[age]   Sex: $reg[gender]</td></tr>
<tr style="height:70px"><td style="border-bottom:2px solid; vertical-align:bottom;">Parent/Gaurdian:</td><td style="border-bottom:2px solid; vertical-align:bottom;">Emergency Contact:</td></tr>
<tr style="height:70px"><td style="border-bottom:2px solid; vertical-align:bottom;">Home Phone: $reg[phone]&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Work Phone: $reg[workphone]</td><td style="border-bottom:2px solid; vertical-align:bottom;">Emergency Phone: $ephone</td></tr>
<tr style="height:70px"><td style="border-bottom:2px solid; vertical-align:bottom;">Address: $reg[address]</td><td style="border-bottom:2px solid; vertical-align:bottom;">Address:</td></tr> 	
<tr style="height:70px"><td style="border-bottom:2px solid; vertical-align:bottom;">City,St, Zip:  $reg[city] , $reg[state] , $reg[zip]</td><td style="border-bottom:2px solid; vertical-align:bottom;">City,St, Zip:  </td></tr> 	
<tr style="height:70px"><td style="border-bottom:2px solid; vertical-align:bottom;">Email: $reg[email]</td><td style="border-bottom:2px solid; vertical-align:bottom;">Email: </td></tr> 
<tr style="height:70px"><td style="border-bottom:2px solid; vertical-align:bottom;" colspan=2>Allergies/Special Health Conditions: $reg[special_needs]</td></tr>
<tr style="height:70px"><td style="border-bottom:2px solid; vertical-align:bottom;" colspan=2>
<p>My child is physically fit to participate in vigorous physical activity and I authorize all medical and surgical treatment, X-ray, laboratory, anesthesia, and other medical and/or hospital procedures as may be performed or prescribed by the attending physician and/or paramedics for my child and waive my right to informed consent of treatment.  I understand I am responsible for all hospital, lab, and doctors fees. This waiver applies only in the event that neither parent/guardian can be reached in the case of an emergency. </p>
</td></tr>

<tr style="height:70px"><td style="border-bottom:2px solid; vertical-align:bottom;">Parent/Gaurdian Signature</td><td style="border-bottom:2px solid; vertical-align:bottom;">Date</td></tr>
</table> 	
END;

 	
 	

 }
 printFooter();
?>
