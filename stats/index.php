<?php
/*
 * Created on 23-May-06
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
include("../config.php");



$a=array(
"Stats Home"=>"index.php",
"By Event"=>"index.php?z=con",
"By Name"=>"index.php?z=name",
"Print Rosters"=>"index.php?z=roster",
"Revenue Report"=>"index.php?z=report",
"Dashboard"=>"index.php?z=dash",
"Send Email"=>"index.php?z=email",
"Add Event" =>"index.php?z=addevents"



);


$z=$_REQUEST["z"];
$z= preg_replace("/[^a-z]/","",$z);

$d=$_REQUEST["d"];
$d = preg_replace("/[^a-z0-9]/","",$d);
$x="none";
if($z == "con")
{
	printHeader($a);
	require("con.php");
	
}
elseif($z == "addevents")
{
        printHeader($a);
	include_once("addevent.php");
	
}
elseif($z == "email")
{
        printHeader($a);
	include_once("email.php");
	
}
elseif($z == "roster")
{
        printHeader($a);
	include_once("roster.php");
	
}
elseif($z == "name")
{
        printHeader($a);
	include_once("name.php");
	
}
elseif($z == "dist"){
	printHeader($a);
	include_once("dist.php");
	
}
elseif($z == "proposal"){
	printHeader($a);
	include_once("proposal.php");
        
}
elseif($z == "fity"){
	printHeader($a);
	include_once("top50.php");
	
}
elseif($z == "email"){
	printHeader($a);
	include_once("email.php");
	
}
elseif($z == "down") {
	include_once("down.php");

}
elseif($z == "dash") {
        printHeader($x);
	include_once("dashboard.php");

}
elseif($z == "form") {
        printHeader($x,true);
	include_once("form.php");

}
elseif($z == "report") {
        printHeader($a);
	include_once("report.php");

}
else {
	printHeader($a);
	mysql_start();
	$result = mysql_query("select count(*) from registration;" );
	$row = mysql_fetch_array($result);
	echo "<h3>Stats for $CFG->event_title</h3><p>Total Number of Participants == $row[0]</p><a href=\"$CFG->wwwsite\">back to website</a>" .
	                "<p><h5>June 1, 2009</h5>Added <b>Print Rosters</b> and <b>Dashboard</b> functions</p>" .
			"<p><h5>May 18, 2009</h5>Converted old site to new one.</p>" .
			"</p><p>Stay tuned for updates.</p>";
	mysql_stop();
        printFooter();
}

printFooter();




?>
