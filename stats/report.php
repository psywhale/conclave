<?php
/*
 * Created on 23-May-06
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 mysql_start();

 echo "<h2>Revenue Report</h2><table><tr><th>Class</th><th>Revenue</th></tr>";
 
 $events= getEvents();
 foreach($events as $event) {
    $revenue = getEventPrice($event->event_code) * getSeatsTaken($event->event_code);
    $total += $revenue;
    echo "<tr><td>$event->title</td><td>$ $revenue</td></tr>";
 }
 
 echo "<tr><td colspan=2 align=right>Grand Total: $ $total</td></tr></table>";
 
  

 mysql_stop();
?>
