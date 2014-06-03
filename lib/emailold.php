<?php
function sendemail($to,$from,$subject,$message)
{
$MP = "/var/qmail/bin/sendmail -t";
$fd = popen($MP,"w");
fputs($fd, "To: $to\n");
fputs($fd, "Reply-to: $from\n");
fputs($fd, "From: $from\n");
// if($bcc){fputs($fd, "Bcc: $bcc\n");}
fputs($fd, "Subject: $subject\n");
fputs($fd, "X-Mailer: PHP4\n");
fputs($fd, $message);
pclose($fd);
}



?>
