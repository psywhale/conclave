<?php
require("../config.php");

$u = preg_replace("/[^0-9A-Fa-f]/","",$_REQUEST["u"]);
$e = preg_replace("/[^0-9]/","",$_REQUEST["e"]);
$z = preg_replace("/[^0-9A-Fa-z]/","",$_REQUEST["z"]);
$d = preg_replace("/[^0-9]/","",$_REQUEST["d"]);

$ref=@$HTTP_REFERER;
mysql_start();

$results = mysql_query("update attendance set paid = \"Y\" where user_code=\"$u\" and event_code=\"$e\";") or die(mysql_error());

header("Location: $CFG->wwwsite/stats/index.php?z=$z&d=$d");

