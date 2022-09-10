<?php
include('db/db.php');
include('system/fpdf/fpdf.php');

$studentId = $_GET['studentId'];

$sql = "SELECT * FROM tbl_student WHERE id = ".$studentId;
$process = $db->query($sql);
$result = $process->fetch_assoc();
$schoolId = $result['school'];

$sqlSchool = "SELECT * FROM tbl_school WHERE id = ".$schoolId;
$processSchool = $db->query($sqlSchool);
$resultSchool = $processSchool->fetch_assoc();

$schoolAlias = $resultSchool['schoolalias'];

$studentName = $result['surname'].", ".$result['firstname']." ".$result['middlename'];

class PDF extends FPDF
{
	// Page header
	function Header()
	{
	    // Logo
		$this->Image('img/logo.jpg', 120, 25, 70, 70);
		$this->SetFont('Arial', 'B', 15); 

		$this->Ln(15);
		$this->setXY(220,30);
		$this->SetFont('Times', 'B', 14);
		$this->Cell(100, 10, "Republic of the Philippines",'','C');
		$this->setXY(245,45);
		$this->SetFont('Times', 'B', 13);
		$this->Cell(100, 10, "Province of Batangas",'','C');
		$this->setXY(197,65);
		$this->SetFont('Times', 'B', 13);
		$this->Cell(100, 10, "MUNICIPALITY OF STO. TOMAS",'','C');
		$this->Ln(15);
		$this->setXY(180,90);
		$this->SetFont('Times', 'B', 14);
		$this->Cell(100, 10, "OFFICE OF THE MUNICIPAL MAYOR",'','C');
	}
}

$pdf = new PDF('P', 'pt', 'Letter');
$pdf->AddPage(); 
$pdf->SetTopMargin('40'); 
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 14);
$pdf->setXY(210,80);
$pdf->Cell(160, 20, "",'','C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->setXY(150,115);
$pdf->Cell(160, 20, "STO. TOMAS EDUCATIONAL ASSISTANCE PROGRAM",'','C');
$pdf->setXY(165,130);
$pdf->Cell(160, 20, '"Edukasyon Pahalagahan Sagot sa Kinabukasan"','','C');
$pdf->setXY(230,155);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(160, 20, 'APPLICATION FORM','','C');

$pdf->Image("system/profilepicture/".$result['picture'], 450, 200, 70, 70);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Ln(125);
$pdf->setX(50);
$pdf->Cell(40, 20, "NAME:",'','C');
$pdf->Cell(270, 15, "",'B','C');
$pdf->Cell(75, 20, "CONTACT NO:",'','C');
$pdf->Cell(105, 15, "",'B','C');


// 1st line
$pdf->SetFont('Arial', '', 11);
$pdf->setX(100);
$pdf->Cell(270, 15, $studentName,'','C');
$pdf->setX(440);
$pdf->Cell(270, 15, $result['contactno'],'','C');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Ln();
$pdf->setX(50);
$pdf->Cell(85, 20, "DATE OF BIRTH:",'','C');
$pdf->Cell(220, 15, "",'B','C');
$pdf->Cell(30, 20, "AGE:",'','C');
$pdf->Cell(50, 15, "",'B','C');
$pdf->Cell(30, 20, "SEX:",'','C');
$pdf->Cell(75, 15, "",'B','C');

// 2nd line
$pdf->SetFont('Arial', '', 11);
$pdf->setX(150);
$pdf->Cell(270, 15, $result['bday'],'','C');
$pdf->setX(400);
$pdf->Cell(270, 15, $result['age'],'','C');
$pdf->setX(480);
$pdf->Cell(270, 15, $result['gender'],'','C');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Ln();
$pdf->setX(50);
$pdf->Cell(90, 20, "PLACE OF BIRTH:",'','C');
$pdf->Cell(230, 15, "",'B','C');
$pdf->Cell(70, 20, "CITIZENSHIP:",'','C');
$pdf->Cell(100, 15, "",'B','C');

// 3rd line
$pdf->SetFont('Arial', '', 11);
$pdf->setX(140);
$pdf->Cell(270, 15, $result['bplace'],'','C');
$pdf->setX(445);
$pdf->Cell(90, 15, $result['citizenship'],'','C');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Ln();
$pdf->setX(50);
$pdf->Cell(105, 20, "PRESENT ADDRESS:",'','C');
$pdf->Cell(385, 15, "",'B','C');

//4th line
$pdf->SetFont('Arial', '', 11);
$pdf->setX(155);
$pdf->Cell(270, 15, $result['address']." Sto. Tomas Batangas",'','C');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Ln();
$pdf->setX(50);
$pdf->Cell(135, 20, "LAST SCHOOL ATTENDED:",'','C');
$pdf->Cell(355, 15, "",'B','C');

//5th line
$pdf->SetFont('Arial', '', 11);
$pdf->setX(185);
$pdf->Cell(270, 15, $result['lastSchoolAttended'],'','C');


$pdf->SetFont('Arial', 'B', 10);
$pdf->Ln();
$pdf->setX(50);
$pdf->Cell(100, 20, "SCHOOL ADDRESS:",'','C');
$pdf->Cell(390, 15, "",'B','C');

//6th line
$pdf->SetFont('Arial', '', 11);
$pdf->setX(150);
$pdf->Cell(270, 15, $result['lastSchoolAddress'],'','C');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Ln();
$pdf->setX(50);
$pdf->Cell(150, 20, "HIGHEST YEAR COMPLETED:",'','C');
$pdf->Cell(90, 15, "",'B','C');
$pdf->Cell(140, 20, "GEN WEIGHTED AVERAGE:",'','C');
$pdf->Cell(110, 15, "",'B','C');

//7th line
$pdf->SetFont('Arial', '', 11);
$pdf->setX(200);
$pdf->Cell(270, 15, $result['highestYear'],'','C');
$pdf->setX(450);
$pdf->Cell(270, 15, $result['lastGwa'],'','C');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Ln();
$pdf->setX(50);
$pdf->Cell(200, 20, "FACEBOOK ACCOUNT/EMAIL ADDRESS:",'','C');
$pdf->Cell(290, 15, "",'B','C');

//8th line
$pdf->SetFont('Arial', '', 11);
$pdf->setX(255);
$pdf->Cell(270, 15, $result['email'],'','C');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Ln();
$pdf->setX(50);
$pdf->Cell(165, 20, "SCHOOL INTENDED TO ENROLL:",'','C');
$pdf->Cell(130, 15, "",'B','C');
$pdf->Cell(140, 20, "ENTRANCE EXAM RATINGS:",'','C');
$pdf->Cell(55, 15, "",'B','C');

//9th line
$pdf->SetFont('Arial', '', 11);
$pdf->setX(215);
$pdf->Cell(270, 15, $schoolAlias,'','C');
$pdf->setX(490);
$pdf->Cell(270, 15, $result['schoolEntranceExam'],'','C');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Ln();
$pdf->setX(50);
$pdf->Cell(150, 20, "COURSE INTENDED TO TAKE:",'','C');
$pdf->Cell(200, 15, "",'B','C');
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(150, 20, "FOUR(4) YEAR COURSE",'','C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Ln();
$pdf->setX(50);
$pdf->Cell(150, 20, "",'','C');
$pdf->Cell(200, 15, "",'B','C');
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(150, 20, "FIVE(5) YEAR COURSE",'','C');
$pdf->SetFont('Arial', 'B', 10);

//10th line
$pdf->SetFont('Arial', '', 11);
$pdf->setXY(200,415);
$pdf->Cell(270, 15, $result['course'],'','C');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Ln(37);
$pdf->setX(50);
$pdf->Cell(200, 20, "OTHER BURSARY OR GRANT ENJOYED:",'','C');
$pdf->Cell(290, 15, "",'B','C');

//11th line
$pdf->SetFont('Arial', '', 11);
$pdf->setX(255);
$pdf->Cell(270, 15, $result['otherScholarship'],'','C');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Ln();
$pdf->setX(50);
$pdf->Cell(95, 20, "NAME OF FATHER:",'','C');
$pdf->Cell(160, 15, "",'B','C');
$pdf->Cell(30, 20, "AGE:",'','C');
$pdf->Cell(30, 15, "",'B','C');
$pdf->Cell(75, 20, "OCCUPATION:",'','C');
$pdf->Cell(100, 15, "",'B','C');

//12th line
$pdf->SetFont('Arial', '', 11);
$pdf->setX(147);
$pdf->Cell(270, 15, $result['fathername'],'','C');
$pdf->setX(335);
$pdf->Cell(270, 15, $result['fatherAge'],'','C');
$pdf->setX(435);
$pdf->Cell(270, 15, $result['fatherwork'],'','C');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Ln();
$pdf->setX(50);
$pdf->Cell(95, 20, "NAME OF MOTHER:",'','C');
$pdf->Cell(160, 15, "",'B','C');
$pdf->Cell(30, 20, "AGE:",'','C');
$pdf->Cell(30, 15, "",'B','C');
$pdf->Cell(75, 20, "OCCUPATION:",'','C');
$pdf->Cell(100, 15, "",'B','C');

//13th line
$pdf->SetFont('Arial', '', 11);
$pdf->setX(147);
$pdf->Cell(270, 15, $result['mothername'],'','C');
$pdf->setX(335);
$pdf->Cell(270, 15, $result['motherAge'],'','C');
$pdf->setX(435);
$pdf->Cell(270, 15, $result['motherwork'],'','C');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Ln();
$pdf->setX(50);
$pdf->Cell(160, 20, "PARENTS PRESENT ADDRESS:",'','C');
$pdf->Cell(330, 15, "",'B','C');

//14th line
$pdf->SetFont('Arial', '', 11);
$pdf->setX(210);
$pdf->Cell(270, 15, $result['parentsAddress'],'','C');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Ln();
$pdf->setX(50);
$pdf->Cell(190, 20, "TOTAL NUMBER OF FAMILY MEMBER:",'','C');
$pdf->Cell(60, 15, "",'B','C');
$pdf->Cell(65, 20, "BROTHERS:",'','C');
$pdf->Cell(60, 15, "",'B','C');
$pdf->Cell(50, 20, "SISTERS:",'','C');
$pdf->Cell(65, 15, "",'B','C');

//15th line
$pdf->SetFont('Arial', '', 11);
$pdf->setX(260);
$pdf->Cell(270, 15, $result['totalFamMember'],'','C');
$pdf->setX(385);
$pdf->Cell(270, 15, $result['brothers'],'','C');
$pdf->setX(495);
$pdf->Cell(270, 15, $result['sisters'],'','C');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Ln();
$pdf->setX(50);
$pdf->Cell(230, 20, "PARENT'S TOTAL GROSS INCOME PER YEAR:",'','C');
$pdf->Cell(260, 15, "",'B','C');

//16th line
$pdf->SetFont('Arial', '', 11);
$pdf->setX(285);
$pdf->Cell(270, 15,'P '.number_format($result['grosspermonth'],2) ,'','C');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Ln();
$pdf->setX(50);
$pdf->Cell(20, 20, "EDUCATIONAL ASSISTANCE ENJOYED BY BROTHERS/SISTERS:",'','C');

$pdf->Ln();
$pdf->setX(100);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(150, 20, "Name",'','C');
$pdf->Cell(160, 20, "Educational Assistance",'','C');
$pdf->Cell(150, 20, "Course & Year",'','C');

$pdf->Ln();
$pdf->setX(60);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(150, 20, "",'B','C');
$pdf->setX(220);
$pdf->Cell(150, 20, "",'B','C');
$pdf->setX(380);
$pdf->Cell(160, 20, "",'B','C');

//16th line
$pdf->SetFont('Arial', '', 9);
$pdf->setX(60);
$pdf->Cell(270, 20, $result['sibling1'],'','L');
$pdf->setX(220);
$pdf->Cell(270, 20, $result['sibling1Scholarship'],'','L');
$pdf->setX(380);
$pdf->Cell(270, 20, $result['sibling1CourseYear'],'','L');

$pdf->Ln();
$pdf->setX(60);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(150, 20, "",'B','C');
$pdf->setX(220);
$pdf->Cell(150, 20, "",'B','C');
$pdf->setX(380);
$pdf->Cell(160, 20, "",'B','C');

//17th line
$pdf->SetFont('Arial', '', 9);
$pdf->setX(60);
$pdf->Cell(270, 20, $result['sibling2'],'','L');
$pdf->setX(220);
$pdf->Cell(270, 20, $result['sibling2Scholarship'],'','L');
$pdf->setX(380);
$pdf->Cell(270, 20, $result['sibling2CourseYear'],'','L');

$pdf->Ln();
$pdf->setX(60);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(150, 20, "",'B','C');
$pdf->setX(220);
$pdf->Cell(150, 20, "",'B','C');
$pdf->setX(380);
$pdf->Cell(160, 20, "",'B','C');

//17th line
$pdf->SetFont('Arial', '', 9);
$pdf->setX(60);
$pdf->Cell(270, 20, $result['sibling3'],'','L');
$pdf->setX(220);
$pdf->Cell(270, 20, $result['sibling3Scholarship'],'','L');
$pdf->setX(380);
$pdf->Cell(270, 20, $result['sibling3CourseYear'],'','L');

$pdf->Ln();
$pdf->setX(50);
$pdf->Cell(500, 20,'','B','L');
$pdf->Ln(30);
$pdf->setX(50);
$pdf->SetFont('Arial', '', 9);
$pdf->MultiCell(500, 10,'This is to certify that i have personally filled out all the entries from this application. Any false data given, misreprensentation and concealment of facts and/or withholding any relevant information will mean disqualification from the scholarship applied for.','','L');
$pdf->Output();	