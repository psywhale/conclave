<?php
/*
 * Created on 28-Apr-06
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 require_once("config.php");

 $rawcode=$_REQUEST["z"];
 $stdFontSize=6;

 mysql_start();
 
$results = mysql_query("select * from registration where security=\"$rawcode\" limit 1;");
$row = mysql_fetch_object($results);


 require("fpdf153/fpdf.php");

 $pdf=new FPDF();
 $pdf->SetTopMargin(9);
//second page Statement
 $pdf->AddPage();

 $pdf->SetFont('Arial','B',$stdFontSize);
  $pdf->Image("images/wosclogo.png",150,10,26,26);
 $pdf->Cell(40,5,"Western Oklahoma State College");
 $pdf->Ln();
 $pdf->SetFont('Arial','',$stdFontSize-2);
 $pdf->Cell(40,3,"2801 N. Main",0,1);
 $pdf->Cell(40,3,"Altus, Oklahoma 73521",0,1);
 $pdf->Cell(40,3,"Tel: (580) 477-7907 Fax: (580) 477-7733",0,1);
 $pdf->Cell(40,3,"FEI:  73-6017987",0,1);
 $pdf->Cell(40,3,"$CFG->emailaddress",0,1);
 $pdf->SetFont('Arial', "u");
 $pdf->SetTextColor(0, 0, 255);
 $pdf->Cell(40,3,"www.wosc.edu",0,1,'',0,"http://www.wosc.edu");
 $pdf->SetTextColor(0, 0, 0);
  $pdf->SetFont('Arial','',$stdFontSize);
 $pdf->Ln(5);
 $pdf->SetX(15);
 $pdf->Cell(40,4,"$row->first_name $row->last_name",0,1);
 $pdf->SetX(15);
 //$pdf->Cell(40,4,"$row->title",0,1);
// $pdf->SetX(15);
 $pdf->Cell(40,4,"$row->address",0,1);
 $pdf->SetX(15);
 $pdf->Cell(40,4,"$row->city $row->state $row->zip",0,1);
 $pdf->SetX(15);
 $pdf->Cell(40,4,"$row->phone",0,1);
 $pdf->Ln(3);
 $pdf->SetFont('Arial','B',$stdFontSize+4);
 $pdf->Cell(0,5,"$CFG->event_title",0,1,'C');
 $pdf->Cell(0,5,"Invoice",0,1,'C');
 $pdf->Cell(0,0,"",1,1,'C');
 $pdf->SetFont('Arial','',$stdFontSize);
 $pdf->SetX(40);
 $pdf->Cell(40,5,"Description");
 //$pdf->Write(5,"                    Description                                                                                                                 Cost");
 $pdf->SetX(-40);
 $pdf->Cell(20,5,"Cost");
 $pdf->Ln(5);
 $pdf->Cell(0,0,"",1,1,'C');
 $pdf->ln(3);
 $total=0;

 $query="select * from attendance where user_code = \"$rawcode\" and paid !=\"R\";";
 $result= mysql_query($query) or die("Failed" . mysql_error());
 while($attending = mysql_fetch_object($result))
 {
    $con = mysql_query("select * from conferences where event_code=\"$attending->event_code\" limit 1;");
    $newrow = mysql_fetch_object($con);
 
 
 

 //	$query = mysql_query("select title, price from conferences where code='ogec_con';") or die(mysql_error());
// 	$newrow = mysql_fetch_object($query);
        if($attending->paid == "D") {
             $ListItem = "$newrow->title **DROPPED**";
             $fill = 200;
             $drops_money += $newrow->price;
             $total += $newrow->price;              
             }
        elseif($attending->paid == "S") { 
             $ListItem = "$newrow->title **DISCOUNTED**";
             $fill = 255;
             $total += 0;
             $newrow->price = "0.00";
             } 
        elseif($attending->paid == "Y") { 
             $ListItem = "$newrow->title **PAID**";
             $fill = 220;
             $drops_money += $newrow->price;
             //$total += 0;
             $total += $newrow->price;              
             
             }      
        else {
             $ListItem = "$newrow->title";
             $fill = 255;
             $total += $newrow->price;
             }     
        $pdf->SetFillColor($fill);     
 	$pdf->SetX(30);
 	$pdf->Cell(130,5,"$ListItem",0,0,"L",1);
 	$pdf->SetX(-40);
 	$pdf->Cell(30,5,"$ $newrow->price",0,0,"L",1);
 	$pdf->Ln(2);
 	$pdf->SetX(30);
 	$pdf->Cell(30,5,"$newrow->date  $newrow->time");
 	$pdf->Ln(4);
 	$pdf->Cell(0,0,"",1,1,'C');
 	$gtotal = $total - $drops_money;
 	
 }
/* if($row->content_camp == 'Y')
 {
 	$query = mysql_query("select title, price from conferences where code='content_camp';") or die(mysql_error());
 	$newrow = mysql_fetch_object($query);
 	$pdf->SetX(30);
 	$pdf->Cell(40,5,"$newrow->title");
 	$pdf->SetX(-40);
 	$pdf->Cell(30,5,"$ $newrow->price");
 	$pdf->Ln(8);
 	$total += $newrow->price;
 }*/
 $pdf->SetX(-50);
 $pdf->Cell(30,5,"Grand Total: \$ $gtotal",'T',1);
 $pdf->SetFont('Arial','B',$stdFontSize);
 $pdf->Cell(0,5,"Payment Options",0,1);
 $pdf->SetFont('Arial','',$stdFontSize);
 $pdf->Ln(2);
 $blurb ="Please select your payment method of choice.\n\nNOTE: We do not take online orders for $CFG->event_title. If you wish to pay by credit card please call: (580) 477 - 7952 .\n\n" .
 		"If you are mailing your check please include a copy of your invoice.\n\n" .
 		"REFUNDS and CANCELLATION:\n Registration fees will automatically be refunded if the workshop is cancelled by the Community Education Department.\n".
 		"Refunds may be requested by calling the *Community Education Department or filling out a Community Education Refund Request Form if the request is submitted 1 week prior to the workshop start date.";
 $pdf->MultiCell(0,3,$blurb);
 $pdf->Ln(5);
$pdf->Cell(0,0,"",1,1,'C');
//$pdf->ln(5);
//$pdf->SetFont('Arial','',$stdFontSize+4);
//$pdf->Cell(180,5,"First 50 paid registrations recieve a voucher for a free WOSC T-shirt",0,0,'C');
$pdf->Ln(8);
$pdf->SetFont('Arial','',$stdFontSize);
$pdf->Cell(5,5,'',1);
$pdf->Cell(40,5,"Cash");
$pdf->MultiCell(0,5,"Do not send cash my Mail. Please come by Western Oklahoma State College Business Office Monday thru Thurday 8am-5pm.\nYou can pay at the Business Office for the workshop but advance registration is recommended as space is limited and is available on a first-come, first-serve basis. ");
$pdf->Ln($stdFontSize);
$pdf->Cell(5,5,'',1);
$pdf->Cell(40,5,"Credit Card");
$pdf->Cell(40,5,"Call 477-7952 ");
//$pdf->Ln(5);
/*
$pdf->Cell(45,5,"");
$pdf->Cell(10,5,"Visa");
$pdf->Cell(3,3,"",1);
$pdf->Cell(3,3,"",0);
$pdf->Cell(20,5,"MasterCard");
$pdf->Cell(3,3,"",1);
$pdf->Cell(3,3,"",0);
$pdf->Cell(15,5,"Discover");
$pdf->Cell(3,3,"",1);
  
 */
//$pdf->Ln(5);
//$pdf->Cell(112,5,"* Include a copy of this Invoice in the FAX",0,0,"R");
$pdf->Ln($stdFontSize);
$pdf->Cell(5,5,'',1);
$pdf->Cell(40,5,"Mail Check to:");
$pdf->Cell(40,5,"Continuing Education Registration",0,1);
$pdf->Cell(45,5,"");
$pdf->Cell(40,5,"Business Office",0,1);
$pdf->Cell(45,5,"");
$pdf->Cell(40,5,"Attention: $CFG->event_title",0,1);
$pdf->Cell(45,5,"");
$pdf->Cell(40,5,"2801 N. Main",0,1);
$pdf->Cell(45,5,"");
$pdf->Cell(40,5,"Altus, OK 73521",0,1);
$pdf->Cell(45,5,"");
$pdf->Cell(40,5,"* Include a copy of this Invoice",0,1);
$pdf->Ln(4);
$pdf->Cell(30,5,"To complete enrollment: complete and attach the following forms then return them to the Helpdesk");
$pdf->Ln(6);
$pdf->Cell(5,5,'',1);
 $pdf->SetFont('Arial', "u",$stdFontSize);
 $pdf->SetTextColor(0, 0, 255);
$pdf->Cell(40,5,"Medical Release (see email or click me)",0,1,'',0,"https://kids.wosc.edu/medform.php?d=$rawcode");
//$pdf->Cell($w, $h, $txt, $border, $ln, $align, $fill, $link);
$pdf->SetFont('Arial',"",$stdFontSize);
$pdf->SetTextColor(0, 0, 0);
$pdf->Ln(6);
$pdf->Cell(5,5,'',1);
$pdf->SetFont('Arial', "u",$stdFontSize);
 $pdf->SetTextColor(0, 0, 255);
$pdf->Cell(40,5,"Photo Release (see email or click me)",0,1,'',0,"https://kids.wosc.edu/pdf/minorphotoform.pdf");
$pdf->SetFont('Arial',"",$stdFontSize);
$pdf->SetTextColor(0, 0, 0);
$pdf->Ln(6);
$pdf->Cell(5,5,'',1);
$pdf->Cell(40,5,"Reciept #");




mysql_stop();
 $pdf->Output("$row->first_name$row->last_name.pdf","D");
?>
