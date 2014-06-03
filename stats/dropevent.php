<?php
require("../config.php");

$u = preg_replace("/[^0-9A-Fa-f]/","",$_REQUEST["u"]);
$e = preg_replace("/[^0-9]/","",$_REQUEST["e"]);
$z = preg_replace("/[^0-9A-Fa-z]/","",$_REQUEST["z"]);
$d = preg_replace("/[^0-9]/","",$_REQUEST["d"]);

$ref=@$HTTP_REFERER;

dropPaidEvent($u,$e);



header("Location: $CFG->wwwsite/stats/index.php?z=$z&d=$d");
?>
