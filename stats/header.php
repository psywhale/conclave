<?php

function DoHeader( $linkarray )
{
echo '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <title>Western Oklahoma State Moodle Moot and Tech Fest</title>
  <meta name="GENERATOR" content="Quanta Plus">
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<META NAME="DESCRIPTION"
CONTENT="Quartz Mountain Moodle Moot and Tech Fest 2006. Learn about an open source course management system called Moodle.">
<META NAME="KEYWORDS"
CONTENT="moodle, technology, cms, couses, online, course, online courses, online course, webct, Moodle, modle, mudle, tech, fest, quartz mountain, mountain, quartz, education, moot, meeting, conference">

   <link rel="stylesheet" href="styles.css" media="screen">
   <link rel="stylesheet" href="print.css" media="print">
   <link rel="stylesheet" href="handheld.css" media="handheld">


   </head>
<body>
<div id="container">
<div id="logo">' .
		'<div id="logotxt">
<h1> WOSC  <br/> Moodle Moot and Tech Fest</h1></div>
<!--<IMG src="images/logo2.gif" alt="Quartz Mountain Moodle Moot and Tech Fest" width="589" height="106" border="0" />-->
</div>
<div id="menu">
<ul>';
foreach($linkarray as $name => $link) {
	echo "<LI><a href=\"$link\">$name</a></li>";

}

echo '</ul></div>';
echo '<div id="menu2">' .
		'<ul>' .
		'<li><a href="index.php?z=proposal">Proposals</a></li>' .
		'<li><a href="index.php?z=fity">First 50 Non-WOSC</a></li>' .
		'<li><a href="index.php?z=email">Email Addresses</a></li>' .
		'<li><a href="index.php?z=comments">Comments</a></li>' .
		'</ul>' .
		'</div>';
echo '
<br clear="left">
<div id="content">';
}
?>
