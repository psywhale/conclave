<?php
global $CFG;
$CFG->libroot = "$CFG->dirroot/lib";
require_once("$CFG->libroot/db.php");
require_once("$CFG->libroot/web.php");
require_once("$CFG->libroot/data.php");
require_once("$CFG->libroot/email.php"); //change this to email.php when ready
?>
