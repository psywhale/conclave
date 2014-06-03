<?php
/*
 * Created on 28-Apr-06
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 
 require("fpdf153/fpdf.php");
 
 $pdf=new FPDF();
 $pdf->AddPage();
 $pdf->SetFont('Arial','B',10);
 $pdf->Cell(40,5,"Western Oklahoma State College");
 $pdf->Ln();
 $pdf->SetFont('Arial','',8);
 $pdf->Cell(40,3,"2801 N. Main",0,1);
 $pdf->Cell(40,3,"Altus, Oklahoma 73521",0,1);
 $pdf->Cell(40,3,"Tel: (580) 477-2000 Fax: (580) 477-7777",0,1);
 $pdf->Cell(40,3,"moodlemoot@wosc.edu",0,1);
 $pdf->Cell(40,3,"www.wosc.edu",0,1,'',0,"http://www.wosc.edu/index2.asp");
 $pdf->Ln(5);
 $pdf->SetX(15);
 $pdf->Cell(40,3,"Ned Spillman",0,1);
 $pdf->SetX(15);
 $pdf->Cell(40,3,"IT Test User",0,1);
 $pdf->SetX(15);
 $pdf->Cell(40,3,"2801 N. Main",0,1);
 $pdf->SetX(15);
 $pdf->Cell(40,3,"Altus OK 73521",0,1);
 $pdf->Ln(10);
 $pdf->SetFont('Arial','B',16);
 $pdf->Cell(0,5,"Quartz Mountain Moodle Moot and Tech Fest",0,1,'C');
 $pdf->Cell(0,5,"STATEMENT",0,1,'C');
 $pdf->Cell(0,0,"",1,1,'C');
 $pdf->SetFont('Arial','',10);
 $pdf->SetX(40);
 $pdf->Cell(40,3,"Description");
 //$pdf->Write(5,"                    Description                                                                                                                 Cost");
 $pdf->SetX(-40);
 $pdf->Cell(20,3,"Cost");
 $pdf->Ln(5);
 $pdf->Cell(0,0,"",1,1,'C');
 
 $pdf->Output();
?>
