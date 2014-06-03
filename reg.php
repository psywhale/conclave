<?php
include("config.php");
//require("functions.php");
$firstname = $_REQUEST["first"];
$lastname = $_REQUEST["last"];
$age = $_REQUEST["age"];
$gender = $_REQUEST["gender"];
$address = $_REQUEST["address"];
$city = $_REQUEST["city"];
$state = $_REQUEST["state"];
$zip = $_REQUEST["zip"];
$email = $_REQUEST["email"];
$phone = $_REQUEST["phone"];
$workphone = $_REQUEST["workphone"];
$e_phone = $_REQUEST["emergphone"];
$special_needs = $_REQUEST["specialneeds"];


$errorstring = "";

mysql_start();                          
$bill_codes = mysql_query('SELECT billing_code FROM conferences') or die(mysql_error());
$event_checked = array();
 while($events = mysql_fetch_array($bill_codes)) {
   $event_checked["$events[0]"] = $_REQUEST["$events[0]"];
 }

//var_export($event_check);


$signed_up = "No";

foreach($event_checked as $checky) {
   if($checky == "yes") $signed_up = "yes";
   
}


if($signed_up == "No") { $errorflag =1; $errorstring .="m";}
if(!$firstname){$errorflag =1; $errorstring .="f";}
if(!$lastname) {$errorflag =1; $errorstring .="l";}
if(!$age) {$errorflag =1; $errorstring .="t";}
if(!$gender) {$errorflag =1; $errorstring .="c";}
if(!$address) {$errorflag =1; $errorstring .="a";}
if(!$city) {$errorflag =1; $errorstring .="y";}
if(!$state) {$errorflag =1; $errorstring .="s";}
if(!$zip) {$errorflag =1; $errorstring .="z";}
if(!$email) {$errorflag =1; $errorstring .="e";}
if(!$phone) {$errorflag =1; $errorstring .="p";}


if($errorflag){
    $error_form_state = "first=$firstname&last=$lastname&age=$age&gender=$gender&address=$address&city=$city&state=$state&zip=$zip&email=$email";
    foreach($event_checked as $event_key => $event_check) {
       $error_form_state .= "&$event_key=$event_check";
    }
    reg_error($errorstring,$error_form_state);
    
}





$zip =preg_replace("/[^0-9]/","",$zip);
$emailformysql = preg_replace("/\@/","\\\@",$email);
$safe_phone = preg_replace("/[^0-9]/","",$phone);
$safe_wphone = preg_replace("/[^0-9]/","",$workphone);
$safe_ephone = preg_replace("/[^0-9]/","",$e_phone);
//if(strlength($safe_ephone) > 7) {/*throw error of dumbassery*/}
$safe_sneeds = strip_tags($special_needs);
$safe_sneeds = mysql_real_escape_string($safe_sneeds);
// Build Insert query
$securekey = md5(makePass());

$query="insert into registration values(\"\",\"$firstname\",\"$lastname\",\"$age\",\"$gender\",\"$address\",\"$city\",\"$state\",\"$zip\",\"$emailformysql\",\"$safe_phone\",".
        "\"$safe_wphone\",\"$safe_ephone\",\"$safe_sneeds\",\"$securekey\");";
	//$query .= ");";



foreach($event_checked as $event_key => $event_check)
 {
 	if($event_check == 'yes')
 	{
 	        $event_code_num = getEventCode("$event_key");
 		$attend_query = "insert into attendance values(\"\",\"$securekey\",$event_code_num,\"N\");";
 		//die("$attend_query");
                mysql_start();
 		mysql_query($attend_query); 
 		$event_name = getEventName($event_code_num);
 		writeLog("$firstname $lastname ($securekey) registered for this event $event_name");
 	}
 }
//die("$attend_query");
mysql_start();

$result = mysql_query($query) or die('Failed:'. "$query" . mysql_error());
$needs = stripslashes($safe_sneeds);
$adminmessage = "A new registration for $CFG->event_title.\n$firstname $lastname\n$title\n$company\n$address\n$city $zip\n$email\n$phone\nSpecial Needs if any:\n$needs\n";
$address = preg_replace("/ /","\%20",$address);
$city = preg_replace("/ /","\%20",$city);
$message =
  "$firstname,\nThank you for registering for $CFG->event_title.\n\n" .
  "Your seat(s) will not be resevered until payment is rendered! \n\n".
  "" .
  "Your Invoice and payment instructions can be found by clicking the following link:\n" .
  "$CFG->wwwsite/statement.php?z=$securekey\n".
  "\nPlease Print and Fill out the following release forms\n".      
        "Photo release form:\n  $CFG->wwwsite/pdf/minorphotoform.pdf\n".
        "Medical Release Form:\n $CFG->wwwsite/medform.php?d=$securekey\n".
  "\n$CFG->emailsig\n";

//sendemail($email,"$CFG->emailaddress","Confirmation and Invoice",$message);


//sendemail("$CFG->emailadmin","$CFG->emailaddress",,$adminmessage);

$emailer = new Emailer();
$emailer->To = $email;
$emailer->Subject = "Confirmation and Invoice";
$emailer->Body = $message;
$emailer->Send();

$emailer->To = $CFG->emailadmin;
$emailer->Subject = "A new Register for $CFG->event_title";
$emailer->Body = $adminmessage;
$emailer->Send();


printHeader();;
echo <<<ENG

<h1>Thank You</h1>
<h2>You have been registered for $CFG->title please check your email for your statement.</h2>
<h2>Your seat(s) will not be reserved until payment is rendered!</h2>
ENG;



if($CFG->Survey == "yes"){
echo '<p>Please take the time to complete the following survey</p>
<form action="demographics.php">
<table>';

$query = "select * from survey_q;";
$results_q = mysql_query($query);

while($q = mysql_fetch_object($results_q)){
	if(preg_match("/yn/i",$q->type)){
		echo "<tr><td>$q->question</td><td><select name=$q->question_id><option value=\"Y\">Yes</option><option value=\"N\">No</option>" .
				"</select></td></tr>";
	}
	if(preg_match("/fib/i",$q->type)){
		echo "<tr><td>$q->question</td><td><input type=text name=$q->question_id />" .
				"</select></td></tr>";
	}
	if(preg_match("/mc/i",$q->type)){
		echo "<tr><td>$q->question</td><td></td></tr>" .
				"<tr>" .
				"<td><input type=checkbox name=pod value=\"Podcasting\">Podcasting</td>" .
				"<td><input type=checkbox name=mp3 value=\"MP3\">MP3 Audio Recording</td>" .
				"</tr><tr>" .
				"<td><input type=checkbox name=avatar value=\"avatars\">Virtual Avatars</td>" .
				"<td><input type=checkbox name=cam value=\"camtasia\">Camtasia</td>" .
				"</tr><tr>" .
				"<td><input type=checkbox name=sb value=\"smartboards\">Smart Boards</td>" .
				"<td><input type=checkbox name=aud value=\"Audacity\">Audacity</td>" .
				"</tr><tr>" .
				"<td><input type=checkbox name=smate value=\"studymate\">StudyMate</td>" .
				"<td><input type=checkbox name=freecont value=\"freecontent\">Free Course Content</td>" .
				"</tr>" .
				"";
	}


}

echo<<<ENDOFLINE
<tr><td></td><td><input type=submit value=Finish /></td></tr>
</table><input type=hidden name="name" value="$firstname $lastname" />
</form>
ENDOFLINE;
}
printFooter();


die;


function reg_error($errorcode,$string) {
	Header("Location: registration.php?error=$errorcode&$string");
	die;
}



?>
