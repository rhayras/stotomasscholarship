<?php
include('../../db/db.php');
include('../fpdf/fpdf.php');

$examtype = $_POST['studenttype'];
$schoolyear = $_POST['schoolyear'];
$sem = $_POST['semester'];
// $getCurrent = "SELECT * FROM tbl_currentyear";
// $processCurrent = $db->query($getCurrent);
// $resultCurrent = $processCurrent->fetch_assoc();
// $schoolyear = $resultCurrent['schyear'];
// $sem = $resultCurrent['semester'];

class PDF extends FPDF
{
	// Page header
	function Header()
	{
	    // Logo
		$this->Image('../../img/logo.jpg', 120, 25, 70, 70);
		$this->SetFont('Arial', 'B', 15); 

		$this->Ln(15);
		$this->setXY(220,30);
		$this->SetFont('Times', 'B', 14);
		$this->Cell(100, 10, "Republic of the Philippines",'','C');
		$this->setXY(245,45);
		$this->SetFont('Times', 'B', 13);
		$this->Cell(100, 10, "Province of Batangas",'','C');
		$this->setXY(197,65);
		$this->SetFont('Times', 'B', 14);
		$this->Cell(100, 10, "MUNICIPALITY OF STO. TOMAS",'','C');
	}

	// Page footer
	function Footer()
	{

		$this->Ln(40);
		$this->SetFont('Arial', '', 9);
		$this->Cell(175, 15,'Prepared:','','L');
		$this->Cell(230, 15,'Recommending Approval:','','L');
		$this->Cell(175, 15,'Approved:','','L');

		$this->Ln(50);
		$this->SetFont('Arial', 'B', 9);
		$this->Cell(175, 15,'CATHERINE V. MENDOZA','','L');
		$this->Cell(230, 15,'MR. SALVADOR M. GELING','','L');
		$this->Cell(175, 15,'HON. EDNA P. SANCHEZ','','L');
		$this->Ln();
		$this->SetFont('Arial', '', 9);
		$this->Cell(175, 15,'Youth Development Officer II','','L');
		$this->Cell(230, 15,'City Administrator ICO','','L');
		$this->Cell(175, 15,'City Mayor','','L');
	}
}
$pdf = new PDF('P', 'pt', 'Letter');
$pdf->AddPage(); 
$pdf->SetTopMargin('40'); 
$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 14);
$pdf->setXY(177,100);
$pdf->Cell(160, 20, "SCHOLARS SCHOLARSHIP GRANTS",'','C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->setXY(250,115);
$pdf->Cell(160, 20, "EPS SCHOLARS",'','C');
$pdf->setXY(220,130);
$pdf->Cell(160, 20, strtoupper($sem)." SY ".$schoolyear,'','C');
$pdf->SetFont('Arial', '', 12);
$pdf->setXY(175,150);
$pdf->Cell(160, 20,'"Edukasyon Pahalagahan Sagot sa Kinabukasan"','','C');
$pdf->SetFont('Arial', 'B', 13);
$pdf->setXY(20,170);
$pdf->Cell( 0, 10, $examtype, 0, 0, 'C' ); 

$pdf->Ln(20);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(150, 15, "STUDENT NAME",1,'TBLR','C');
$pdf->Cell(100, 15, "STUDENT TYPE",1,'TBLR','C');
$pdf->Cell(125, 15, "SCHOOL",1,'TBLR','C');
$pdf->Cell(80, 15, "SCHOLARSHIP",1,'TBLR','C');
$pdf->Cell(100, 15, "GRANT AMOUNT",1,'TBLR','C');
$pdf->Ln();
$x = 1;
$grandTotalArray = array();
if($examtype == "All")
{
$getStudents = "SELECT * FROM tbl_scholarhistory WHERE schoolyear = '".$schoolyear."' AND sem = '".$sem."' ";
}
else
{
$getStudents = "SELECT * FROM tbl_scholarhistory WHERE studenttype = '".$examtype."' AND schoolyear = '".$schoolyear."' AND sem = '".$sem."' ";

}
$processStudents = $db->query($getStudents);
if($processStudents->num_rows > 0)
{
	while($resultStudents = $processStudents->fetch_assoc())
	{
		$grantAmount = '';
		//getName
		$grandTotalArray[] = $resultStudents['grantprice'];
		$getInfo = "SELECT firstname,surname,address,gwa,school,studenttype FROM tbl_student WHERE id =".$resultStudents['studentId'];
		$processInfo = $db->query($getInfo);
		$resultInfo = $processInfo->fetch_assoc();
		//get school
		$getSchool = "SELECT * FROM tbl_school WHERE id =".$resultInfo['school'];
		$processSchool = $db->query($getSchool);
		$resultSchool = $processSchool->fetch_assoc();

		$scholarshipType = '';
		if($resultStudents['scholartype'] == 0) $scholarshipType = 'Full';
		if($resultStudents['scholartype'] == 1) $scholarshipType = 'Assistance';
		

		if($resultStudents['grantprice'] != '')
		{
			$grantAmount = "Php ".number_format($resultStudents['grantprice'],2);
		}
		else
		{
			$grantAmount = "Php 0.00";
		}

		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(20, 15, $x++,1,'TBLR','L');
		$pdf->Cell(130, 15, $resultInfo['firstname']." ".$resultInfo['surname'],1,'TBLR','L');
		$pdf->Cell(100, 15, $resultStudents['studenttype'],1,'TBLR','L');
		$pdf->Cell(125, 15, $resultSchool['schoolalias'],1,'TBLR','L');
		$pdf->Cell(80, 15, $scholarshipType,1,'TBLR','L');
		$pdf->Cell(100, 15, $grantAmount,1,'TBLR','C');

		$pdf->Ln();
	}
}
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(150, 15,'Grand Total','TBL','L');
$pdf->Cell(305, 15,'','TB','C');
$pdf->Cell(100, 15,"Php ".number_format(array_sum($grandTotalArray),2),1,'TBLR','C');
$pdf->Output();	