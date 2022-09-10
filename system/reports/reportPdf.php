<?php
include('../../db/db.php');
include('../fpdf/fpdf.php');

$schyear = "";
$sem = "";
$getCurrent = "SELECT * FROM tbl_currentyear";
$processCurrent = $db->query($getCurrent);
if($processCurrent->num_rows > 0)
{
	$resultCurrent = $processCurrent->fetch_assoc();
	$schyear = $resultCurrent['schyear'];
	$sem = $resultCurrent['semester'];
}

$studenttype = (isset($_POST['studenttype'])) ? $_POST['studenttype'] : '';
$schoolid = (isset($_POST['schoolname'])) ? $_POST['schoolname'] : '';
$schoolyear = (isset($_POST['schoolyear'])) ? $_POST['schoolyear'] : $schyear;
$semester = (isset($_POST['semester'])) ? $_POST['semester'] : $sem;
$barangay = (isset($_POST['barangay'])) ? $_POST['barangay'] : '';

$sqlFilterArray = array();
$title = '';
if($studenttype != "All")
{
	$sqlFilterArray[] = " studenttype LIKE '".$studenttype."'";
	$title .= $studenttype;
}
if($schoolid != "All")
{
	$sqlFilterArray[] = " school LIKE '".$schoolid."'";
	$query = "SELECT * FROM tbl_school WHERE id = ".$schoolid;
	$processQuery = $db->query($query);
	$resultQuery = $processQuery->fetch_assoc();
	$schoolName = $resultQuery['schoolalias'];
	$title .= $schoolName;

}
if($barangay != "All")
{
	$sqlFilterArray[] = " trim(address) LIKE '".trim($barangay)."'";
	$title .= $barangay;
}


$sqlFilter = "";
if(count($sqlFilterArray) > 0)
{
	$sqlFilter = "AND";
}
$sqlFilter .= implode('AND',$sqlFilterArray);

class PDF extends FPDF
{
	// Page header
	function Header()
	{
	    // Logo
		$this->Image('../../img/logo.jpg', 210, 25, 70, 70);
		// $this->SetFont('Arial', 'B', 15); 

		 $this->Ln(15);
		 $this->setXY(310,30);
		 $this->SetFont('Times', 'B', 15);
		 $this->Cell(200, 10, "Republic of the Philippines",'','C');
		 $this->setXY(330,45);
		 $this->SetFont('Times', 'B', 14);
		 $this->Cell(100, 10, "Province of Batangas",'','C');
		 $this->setXY(285,65);
		 $this->SetFont('Times', 'B', 14);
		 $this->Cell(100, 10, "MUNICIPALITY OF STO. TOMAS",'','C');
		 $this->Ln(15);
		 $this->setXY(310,85);
		 $this->SetFont('ARIAL', 'B', 14);
		 $this->Cell(100, 10, "SCHOLARSHIP REPORT",'','C');

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
$pdf = new PDF('L', 'pt', 'Letter');
$pdf->AddPage(); 
$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 14);
$pdf->setXY(300,100);
$pdf->Cell(150, 30,$semester." SY ".$schoolyear,'','C');
$pdf->Ln(20);
$pdf->Cell(737, 30,$title,0,'','C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Ln(30);
$pdf->Cell(150, 30, "STUDENT NAME",1,'TBLR','C');
$pdf->Cell(105, 30, "ADDRESS",1,'TBLR','C');
$pdf->Cell(100, 30, "SCHOOL",1,'TBLR','C');
$pdf->Cell(100, 30, "STUDENT LEVEL",1,'TBLR','C');
$pdf->Cell(155, 30, "YEAR & COURSE",1,'TBLR','C');
$pdf->Cell(127, 30, "SCHOLARSHIP",1,'TBLR','C');
$pdf->Ln();
$x = 1;
$scholarship = '';

$studentArray = array();

$getAllInHistory = "SELECT * FROM tbl_scholarhistory WHERE schoolyear = '".$schoolyear."' AND sem = '".$semester."'";
$processAllInHistory = $db->query($getAllInHistory);
if($processAllInHistory->num_rows > 0)
{
	while($resultHistory = $processAllInHistory->fetch_assoc())
	{
		$studentArray[] = $resultHistory['studentId'];
	}
}

$mainQuery = "SELECT * FROM tbl_student WHERE id IN (".implode(',',$studentArray).") ".$sqlFilter." ";
$processMainQuery = $db->query($mainQuery);
if($processMainQuery->num_rows > 0)
{
	while($result = $processMainQuery->fetch_assoc())
	{
		$getSchool = "SELECT * FROM tbl_school WHERE id = ".$result['school'];
		$processSchool = $db->query($getSchool);
		$resultSchool = $processSchool->fetch_assoc();

		if($result['scholarType'] == 0){$scholarship='Full Scholarship';}
		if($result['scholarType'] == 1){$scholarship='Assistance Scholarship';}


		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(20, 12, $x++,1,'TBLR','L');
		$pdf->Cell(130, 12, $result['firstname']." ".$result['surname'],1,'TBLR','L');
		$pdf->Cell(105, 12, $result['address'].", STB ",1,'TBLR','L');
		$pdf->Cell(100, 12, $resultSchool['schoolalias'],1,'TBLR','C');
		$pdf->Cell(100, 12, $result['studenttype'],1,'TBLR','C');
		$pdf->Cell(155, 12, $result['yearOrgrade'].' '.$result['course'],1,'TBLR','C');
		$pdf->Cell(127, 12, $scholarship,1,'TBLR','C');
		$pdf->Ln();
	}
}
else
{
	$pdf->Cell(737, 12, 'No Data Found',1,'TBLR','C');
}


$pdf->Output();	