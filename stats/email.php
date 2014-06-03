<?php
/*
 * Created on 6-Jul-06
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
if($_REQUEST[send]=="Send Email")
{
 mysql_start();
 
 $body = strip_tags($_REQUEST[emailbody],'<p><a><ul><li><font><table><strong><span>');
 $subject = preg_replace("/[^A-Za-z0-9\ ]/","",$_REQUEST[subject]);
 $body .= "<br/>$CFG->emailsig";
 $query = "select email from registration;";
 $emailer = new Emailer(); 
 $results = mysql_query($query);
/* while($row = mysql_fetch_object($results)) {
       $emailer->To=$row->email;
       $emailer->Body=$body;
       $emailer->Subject=$subject;
       $emailer->Send();
     
     }
*/
        $emailer->To="brian.carpenter@wosc.edu";
       $emailer->Body=$body;
       $emailer->Subject=$subject;
       $emailer->Send();
     

 mysql_stop();

echo "<h2>Email Sent</h2>";

}
else{
 
 echo "<h2>Send an email to all registrants</h2>
         <p>From: $CFG->emailname [ $CFG->emailaddress ]</p>
         <p><form method=post action=\"$CFG->wwwsite/stats/index.php?z=email\">Subject: <input type=text name=subject /><br/><br/>";
  
 htmlarea("emailbody");
 echo "<br/><input type=submit name=send value=\"Send Email\"/></p></form>";
 }
 
?>
