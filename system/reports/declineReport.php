<?php
include('../../db/db.php');
include('../fpdf/fpdf.php');

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
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 14);
$pdf->setXY(210,80);
$pdf->Cell(160, 20, "DECLINED APPLICATIONS",'','C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->setXY(215,100);
$pdf->Cell(160, 20, strtoupper($sem)." SY ".$schoolyear,'','C');

$pdf->Ln(20);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(150, 15, "STUDENT NAME",1,'TBLR','C');
$pdf->Cell(100, 15, "STUDENT TYPE",1,'TBLR','C');
$pdf->Cell(120, 15, "SCHOOL",1,'TBLR','C');
$pdf->Cell(175, 15, "REASON",1,'TBLR','C');
$pdf->Ln();
$x = 1;

$sql = "SELECT * FROM tbl_student WHERE status = 3 AND semester = '".$sem."' AND schoolyear = '".$schoolyear."' ";
$process = $db->query($sql);
if($process->num_rows > 0)
{
	while($result = $process->fetch_assoc())
	{
		$getSchool = "SELECT * FROM tbl_school WHERE id =".$result['school'];
		$processSchool = $db->query($getSchool);
		$resultSchool = $processSchool->fetch_assoc();

		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(20, 15, $x++,1,'TBLR','L');
		$pdf->Cell(130, 15, $result['firstname']." ".$result['surname'],1,'TBLR','L');
		$pdf->Cell(100, 15, $result['studenttype'],1,'TBLR','L');
		$pdf->Cell(120, 15, $resultSchool['schoolalias'],1,'TBLR','L');
		$pdf->Cell(175, 15, $result['declineReason'],1,'TBLR','L');
		$pdf->Ln();
	}
}
else
{
	$pdf->Cell(545, 15,'No Data Found',1,'TBLR','C');
}


$pdf->Output();	