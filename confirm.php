<?php
/*
 * Created on 3-May-06
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 require("functions.php");
$zcode = $_REQUEST["z"];
if(!$zcode)
{
	ShowPage('<h2>OOPS</h2><p>There was no confirmation code sent.</p>');
}
else
{
	mysql_start();

	$status = CheckCode($zcode);
	if($status == 0)
	{// no code
		ShowPage('<h2>OOPS</h2><p>That confirmation code does not exist in my memory banks or has already been confirmed.</p>');
	}
	if($status > 1)
	{//multiple codes
		ShowPage('<h2>OOPS</h2><p>Illegal code</p>');
	}
	if($status == 1)
	{//do good stuff
		ConfirmProposal($zcode);
		ShowPage('<h2>Proposal Confirmed</h2><p>A notice of your proposal has been sent to the responsible parties.<br/>Thank you for your interest.</p>');
	}
	mysql_stop();
}


function CheckCode($code)
{
	$resultres = mysql_query("select * from proposals where securekey = \"$code\" and confirmed = \"N\";");
	$count = mysql_num_rows($resultres);

	return($count);

}

function ConfirmProposal($zcode)
{
	mysql_query("update proposals set confirmed=\"Y\" where securekey=\"$zcode\";");
	$results4 = mysql_query("select * from proposals where securekey = \"$zcode\";");
	$proposal = mysql_fetch_object($results4);
	$kentsmessage = "The following proposal has been submitted and confirmed.\n" .
			"Title: $proposal->title\n" .
			"Format: $proposal->format\n" .
			"Strands: $proposal->strands\n" .
			"Description:\n" .
			"$proposal->description\n\n" .
			"Outline:\n" .
			"$proposal->outline\n\n" .
			"Methods:\n" .
			"$proposal->methods\n\n" .
			"Lead Presenter:\n" .
			"--------------------\n" .
			"Name: $proposal->presenter_name\n" .
			"Title: $proposal->presenter_title\n" .
			"Organization: $proposal->presenter_org\n" .
			"Address: $proposal->presenter_addr\n" .
			"City: $proposal->presenter_city\n" .
			"State: $proposal->presenter_state\n" .
			"Zip: $proposal->presenter_zip\n" .
			"Phone: $proposal->presenter_phone\n" .
			"Email: $proposal->presenter_email\n" .
			"Other Presenters:\n" .
			"$proposal->other_presenters\n" .
			"Is a product or service being offered? $proposal->sales_job\n" .
			"Priority: $proposal->priority\n" .
			"(1 Being Highest)\n";

	$submitter_message = "Your Proposal $proposal->title is now under review, thank you\n";

	sendemail("moodlemoot@wosc.edu","$proposal->presenter_email","MoodleMoot Proposal","$kentsmessage");
	sendemail("$proposal->presenter_email","moodlemoot.robot@wosc.edu","Proposal Confirmed, Thank You","$submitter_message");


}



function ShowPage($message='')
{
	include_once("header.php");
	echo $message;
	include_once("footer.php");
	die;
}


?>
