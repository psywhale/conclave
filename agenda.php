<?php
/*
 * Created on 17-Apr-06
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
require_once("config.php");

$callforproposals = '<a href="proposal.php">Call for Proposals</a>.<br/> <font style="text-decoration: line-through;">Deadline for proposals is June 5th.';


printHeader();
mysql_start();

echo <<< EOT
<h1>Schedule</h1>


<div style="text-align:center">
<table  cellspacing="0" width="100%" border=1px>
<tr><td colspan="7" align="center"><b>$CFG->event_title </b>
  <p align="center"><b>Kids 
  College</b><br/>All classes are Monday through Thursday and the cost of the class is per class, not per day. All 4H members that attend a 4H sponsored class must see <u>April Sirmons</u> or <u>Gary Strickland</u> for a letter to receive a reduced price.</p>
  <p><u>Bring the letter to Pay! 4-H  classes are denoted with **</u></p>
  </td>
  </tr>

<tr><td>Weekly 
  Offerings</td>
  <td>Title</td>
  <td>Instructor</td>

  <td>Times</td>
  <td>Age</td>
  <td>Cost</td>
  <td>Location</td>
  </tr>
<!--<tr><td><b>June 
  7-10</b></td>
  <td>Rise and Shine!</td>
  <td>WOSC staff</td>

  <td>M-Th
  <p>7:30 -8:45</p></td>
  <td>Grades 2-8</td>
  <td>25</td>
  <td></td>
  </tr>
-->
 
EOT;

//$query = "select conferences.*,descriptions.description from conferences ".
 //        "left join descriptions on conferences.event_code = descriptions.event_code order by conferences.date;";
$data = getConferenceEventData(null,"order by conferences.date");
//var_dump($data);
//$results = mysql_query($query);
$hiddendivs = "";
foreach($data as $row){
    
    echo "<tr> <td> $row->date</td>";
    if($row->description) {
    echo "<td> <a id=\"inline\" href=\"#$row->billing_code\">$row->title</a></td>";
    $hiddendivs .= "<div style=\"display:none\"><div id=\"$row->billing_code\">$row->description</div></div>\n";
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
    echo " <td> $row->Location</td></tr>\n";
}
echo "</table></div>\n";
echo $hiddendivs;


printFooter();

?>
