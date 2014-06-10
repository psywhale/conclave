<?php
/*
 * Created on 23-May-06
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

 mysql_start();
 

/* $result = mysql_query("select count(*) from registration where content_camp=\"Y\";");
 $content_count = mysql_fetch_array($result);
*/
  if($d) {

  	 $event_count_result = mysql_query("select event_code from attendance where event_code=\"$d\";");
  	 $event_title_q = mysql_query("select title from conferences where event_code = \"$d\"");
  	 
  	 $total_rows = mysql_num_rows($event_count_result);
  	 $event_title = mysql_fetch_row($event_title_q);
  	 $teh_limit = $total_rows / 5;
  	 $teh_limit = ceil($teh_limit);
  	 $rw =0;
  	 $col=0;
  	 $starter = 0;
  	 $tablearray = array(array());
  	 
  	 while($total_rows > $starter)
  	 {
  	   $result1 = mysql_query("select first_name, last_name, registration.ndx,security from registration, attendance where security=attendance.user_code and attendance.event_code = \"$d\" and attendance.paid != \"D\" order by last_name limit $starter,$teh_limit;") or die(mysql_error());
  	   while($row = mysql_fetch_object($result1))
           {
              if($col >=$teh_limit){
                 $rw++;
                 $col=0;
              }
              
             if(isPaid($row->security,$d) == "Y" || isPaid($row->security,$d) == "S")
             {
               $imgsrc ="<img src=\"$CFG->wwwsite/template/images/check.png\">";
               
             }
             else {
               $imgsrc ="";
             } 
             $tablearray[$rw][$col] = "<a href=\"$CFG->wwwsite/stats/index.php?z=name&d=$row->ndx\" title=\"$row->first_name $row->last_name\">$row->first_name $row->last_name</a> $imgsrc";
             $col++;
           
            
           }
           //$col++;
           $starter += $teh_limit;
         }
	 echo "<p><table id=nohl >" .
  			"<tr><th colspan=5>Participants for $event_title[0]</th></tr><tr><td colspan=5></td></tr>";
  			
     
       			
        foreach($tablearray as $row)
        {
         echo "<tr>";
           foreach($row as $cell){
     	     echo "<td>$cell</td>";
     	   }
     	 echo "</tr>";
        }
        
     

     echo "</table></p>";
 }




 		
 $result = getEvents();
 
 echo "<p>" .
 		"<table class=\"special\">" .
 		"<tr><th>Event</th><th>Participant Count<br/>Paid / Total</th></tr>";
 
 foreach($result as $conferences){
   mysql_start();
     $query_attendance = "select count(*) from attendance where event_code = \"$conferences->event_code\";";
     $attendance_results = mysql_query($query_attendance);
     $attend_total = mysql_fetch_array($attendance_results);
     if($attend_total[0] > 0){
	if($date !== $conferences->date) { echo "<tr><td><hr/>Week of $conferences->date</td></tr>"; }\
        $date = $conferences->date;
        $paid_total_q = mysql_query("select count(*) from attendance where event_code = \"$conferences->event_code\" and paid = \"Y\";");
        $compd_total_q = mysql_query("select count(*) from attendance where event_code = \"$conferences->event_code\" and paid = \"S\";");
        $paid_total = mysql_fetch_array($paid_total_q);
        $comped_total = mysql_fetch_array($compd_total_q);
        if($comped_total[0] > 0) { $comp_string = "($comped_total[0])"; }
        
        echo "<tr><td>$conferences->title : $conferences->date</td><td><a href=\"$CFG->wwwsite/stats/index.php?z=con&d=$conferences->event_code\">$paid_total[0] / $attend_total[0] $comp_string</a></td></tr>";
        $comp_string ="";
     }
    mysql_stop();
 } 		

 mysql_stop();
echo "</table>";


?>
