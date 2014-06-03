<?php
/*
 * Created on 23-May-06
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

 function error($errorcode,$string) {
	Header("Location: registration.php?error=$errorcode&$string");
	die;
}

/**
 * sends email via qmail
 */
function sendemail($to,$from,$subject,$message)
{
/*$MP = "/var/qmail/bin/sendmail -t";
$fd = popen($MP,"w");
fputs($fd, "To: $to\n");
fputs($fd, "Reply-to: $from\n");
fputs($fd, "From: $from\n");
// if($bcc){fputs($fd, "Bcc: $bcc\n");}
fputs($fd, "Subject: $subject\n");
fputs($fd, "X-Mailer: PHP4\n");
fputs($fd, $message);
pclose($fd);
*/
mail($to,$subject,$message,"From: $from","Reply-to: $from");
}



function makePass() {
    $cons = "bcdfghjklmnpqrstvwxyz";
    $vocs = "aeiou";
    for ($x=0; $x < 6; $x++) {
        mt_srand ((double) microtime() * 1000000);
        $con[$x] = substr($cons, mt_rand(0, strlen($cons)-1), 1);
        $voc[$x] = substr($vocs, mt_rand(0, strlen($vocs)-1), 1);
    }
    $makepass = $con[0] . $voc[0] .$con[2] . $con[1] . $voc[1] . $con[3] . $voc[3] . $con[4];
    return($makepass);
}

function mysql_start()
{
	 mysql_connect("localhost","ogec","Y34hRight") or die(mysql_error());
	 mysql_select_db("ogec") or die(mysql_error());
}

function mysql_stop()
{
	mysql_close();
}

?>
