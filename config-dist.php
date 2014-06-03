<?php
unset($CFG);

//$CFG = stdClass();

$CFG->dbuser="";
$CFG->dbpassword="";
$CFG->dbhost="";
$CFG->dbname="";

$CFG->wwwsite="http://example.com";
$CFG->dirroot="/var/www/htdocs"; //your document root
$CFG->event_title="Conclave Example"; //title of event

$CFG->smtphost="localhost";
$CFG->emailaddress="me@example.com";
$CFG->emailadmin="me@example.com";
$CFG->emailsig="Me @ $CFG->event_title"; //your email signature
$CFG->emailname="Example Name";
$CFG->htmlemail = true;
$CFG->survey="No";
$CFG->themedir = "$CFG->dirroot/template/rwd2012"; //template to use

$CFG->showmenu = true; // turn on / off menu
$CFG->printpage = false; //show printable page link
// turn on / off registration
$CFG->registration = true;

$CFG->menu= array(
"Overview"=>"$CFG->wwwsite",
"Schedule"=>"$CFG->wwwsite/agenda.php",
//"Class Descriptions"=>"$CFG->wwwsite/classes.php",
"Contact Us"=>"$CFG->wwwsite/contact.php",
"Registration"=>"$CFG->wwwsite/registration.php",
//"Downloads"=>"$CFG->wwwsite/downloads.php",
//"Evaluation"=>"$CFG->wwwsite/eval.php",
"Refund Policy"=>"$CFG->wwwsite/refund.php",
"Mailing List"=>"$CFG->wwwsite/mail.php");

/*
$CFG->menu = array(
"Home"=>"$CFG->wwwsite"
);

/*
$CFG->menu= array(
"Overview"=>"$CFG->wwwsite",
"Parent Survey" => "$CFG->wwwsite/survey.php",
"Class Proposal"=>"$CFG->wwwsite/proposal.php",
"Mailing List"=>"$CFG->wwwsite/mail.php");
*/




require("$CFG->dirroot/lib/setup.php");

?>
