<?php
require("../config.php");

$u = preg_replace("/[^0-9A-Fa-f]/","",$_REQUEST["u"]);
$e = preg_replace("/[^0-9]/","",$_REQUEST["e"]);
$z = preg_replace("/[^0-9A-Fa-z]/","",$_REQUEST["z"]);
$d = preg_replace("/[^0-9]/","",$_REQUEST["d"]);
$ndx = preg_replace("/[^0-9]/","",$_REQUEST["i"]);

$ref=@$HTTP_REFERER;

removeUserfromEvent($u,$e,$ndx);



header("Location: $CFG->wwwsite/stats/index.php?z=$z&d=$d");
?>
