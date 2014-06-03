<?php

if($_REQUEST[addingevent] == "Add Class")
{
    require("../config.php");
// addConferenceEvent($title,$presenter,$price,$date,$time,$age,$limit=20,$description)
   if(addConferenceEvent($_REQUEST['eventName'],$_REQUEST['eventPresenter'],$_REQUEST['eventPrice'],$_REQUEST['eventDate'],$_REQUEST['eventTime'],$_REQUEST['eventAges'],$_REQUEST['eventLimit'],$_REQUEST['eventDescription']))
   {
   echo "<h2>Event ".$_REQUEST['eventName']." added</h2>";
   }
   else { echo "FAIL TRAIN";}
}
else
{
echo "
<h2>Adding an Event</h2>
<form method=post action=\"$CFG->wwwsite/stats/addevent.php\">
<table>
<tr><td>Name</td><td><input type=text name=eventName size=50 maxlength=40/></td></tr>
<tr><td>Presenter </td><td><input type=text name=eventPresenter size=50  maxlength=40/></td></tr>
<tr><td>Price </td><td>$<input type=text name=eventPrice size=5 maxlength=3 value=\"75\"/> </td></tr>
<tr><td>Date(s) </td><td><select name=eventDate>
<option value=\"June 02nd - 5th\">June 02nd - 5th</option>
<option value=\"June 09 - 12th\">June 09 - 12th</option>
<option value=\"June 16 - 19th\">June 16 - 19rd</option>
<option value=\"June 23 - 26th\">June 23 - 26th</option>
</select>
 </td></tr>
 <tr><td>Time </td><td><select name=eventTime>
<option value=\"9am - 12pm\">Morning</option>
<option value=\"1pm - 4pm\">Afternoon</option>
<option value=\"7:30am - 8:45am\">Rise and Shine</option>
<option value=\"4pm - 5:30pm\">Afternoon Aftercare</option>
</select>
 </td></tr>
 <tr><td>Ages</td><td><input type=text name=eventAges size=8 maxlength=7> </td></tr>
 <tr><td>Class Size</td><td><input type=text name=eventLimit size=5 maxlength=3/> </td></tr>
 <tr><td colspan=2>Description: </td></tr>
 <tr><td colspan=2> 
 ";
 htmlarea("eventDescription");
 echo"
 </td></tr>
 <tr><td colspan=2><input type=submit name=addingevent value=\"Add Class\"/></td></tr></table>

 </form>
 ";
}

?>
