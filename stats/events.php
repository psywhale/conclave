<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("../config.php");




printHeader();
mysql_start();

echo <<< EOT
<h1>Schedule</h1>
<p>

<center>
<table  cellspacing="0" width="728" border=1px>
<tbody><tr><td colspan="9"><b>$CFG->event_title </b>
  <p align="center">Press Edit button to Edit the class, Delete to Delete or <input type="button" value="Add Event" onClick="window.location='$CFG->wwwsite/stats/index.php?z=addevents';"></input></p></td>
  </tr>

<tr><td>Weekly 
  Offerings</td>
  <td>Title</td>
  <td>Instructor</td>

  <td>Times</td>
  <td>Age</td>
  <td>Cost</td>
  <td>Location</td>
  <td>Edit</td>
  <td>Delete</td>
  </tr>

 
EOT;

//$query = "select conferences.*,descriptions.description from conferences ".
         //"left join descriptions on conferences.event_code = descriptions.event_code order by conferences.date;";
$data = getConferenceEventData();
//var_dump($data);
//$results = mysql_query($query);
$hiddendivs = "";
foreach($data as $row){
    
    echo "<tr> <td> $row->date</td>";
    if($row->description) {
    echo "<td> <a id=\"inline\" href=\"#$row->billing_code\">$row->title</a></td>";
    $hiddendivs .= "<div style=\"display:none\"><div id=\"$row->billing_code\">$row->description</div></div>";
    }
    else {
    echo " <td> $row->title</td>";
    }
    echo " <td> $row->presenter</td>";
    echo " <td> $row->time</td>";
    
    
    echo " <td> $row->Age</td>";
    //$limit = getEventLimit($row->event_code);
    echo " <td>$ $row->price</td>";
    //echo " <td>$limit</td></tr>";
    echo " <td> $row->Location</td>";
    echo " <td> <input type=\"button\" value=\"Edit\" onClick=\"window.location='$CFG->wwwsite/stats/index.php?z=editevent&code=$row->event_code';\"></input> </td>";
    echo " <td> <input type=\"button\" value=\"DELETE\" onClick=\"window.location='$CFG->wwwsite/stats/index.php?z=delevent&code=$row->event_code';\"></input> </td>";
    echo "</tr>";
}
echo "</tbody></table></center></p>";
echo $hiddendivs;

printFooter();
?>
