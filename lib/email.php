<?php

/**
 * Emailer class to send email with proper headers.
 * constructor pulls values from config.php
 * 
 * $emailer->new Emailer();
 * $emailer->Body = "body text";
 * $emailer->Subject= "subject text";
 * $emailer->To = "some address";
 * $emailer->Send();
 * 
 * @package emailer
 * @author Brian Carpenter
 * 
 */
class Emailer {
  /**
   * @var string
   */
   var $Host = "";
  /**
   * @var string
   */
   var $FromAddress = "";
 
   var $FromName = "";

   var $To = '';

   var $Subject = "";
   /**
    * @var string
    */
   var $Body = "";

   var $CC = "";

   var $BCC = "";

   var $Signature = "";

   var $header = "";
   
   var $sendHtml = false;
   /**
    * Constructor
    * @return 
    */
   function __construct() {
   global $CFG;
       $this->Host = $CFG->smtphost;
       $this->FromAddress = $CFG->emailaddress;
       $this->FromName = $CFG->emailname;
       $this->Signature = $CFG->emailsig;
       $this->sendHtml = $CFG->htmlemail;
   }
/**
 * Sends email  
 * @return 
 */
   function Send() {

       $this->header = "X-Mailer: PHPAwesome\n";
       if($this->sendHtml) {
          $this->header .= 'MIME-Version: 1.0' . "\r\n";
          $this->header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
          $this->Body = preg_replace("/\n/","<br/>",$this->Body);
       }
       

       if($this->FromAddress)
          {
	    $this->header .= "From: \"$this->FromName\" <$this->FromAddress>\n";
	  }
       if($this->CC)
         {
	   $this->header .= "CC: $this->CC\n";
         }
       if($this->BCC)
        {
           $this->header .= "BCC: $this->BCC\n";
        }

       if($this->To)
       {
          mail($this->To,$this->Subject,$this->Body,$this->header);
	}
       else {
         die("Cannot email: no To address");
	 }
   }
}


?>
