<?php

function errorconsole($string) {
echo "<script> console.log(".json_encode($string).");</script>";
}
