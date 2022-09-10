<?php
include('../../db/db.php');

$studentId = $_POST['studentId'];
$score = $_POST['score'];

$sql = "SELECT studenttype FROM tbl_student WHERE id =".$studentId;
$process = $db->query($sql);

$result = $process->fetch_assoc();
$studentType  = $result['studenttype'];
$studentTypeNumber = 0;
if($studentType == 'Senior High School'){ $studentTypeNumber = 1;}
if($studentType == 'College'){ $studentTypeNumber = 2;}
$passing = 0;
$sqlCheck = "SELECT * FROM tbl_exam WHERE examtype = ".$studentTypeNumber;
$processCheck = $db->query($sqlCheck);
if($processCheck->num_rows > 0)
{
	$resultCheck = $processCheck->fetch_assoc();
	$passing = $resultCheck['passingscore'];

	if($score >= $passing)
	{
		echo 'success';
	}
	else
	{
		echo $passing;
	}
}