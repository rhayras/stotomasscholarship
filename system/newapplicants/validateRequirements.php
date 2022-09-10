<?php
include('../../db/db.php');


$studentId = $_POST['studentId'];
$requirements = $_POST['requirements'];
$actionType = $_POST['actionType'];


if($actionType == 0)
{
	$update  = "UPDATE tbl_reqstatus SET status = 1 WHERE studentId = ".$studentId." AND requirements = '".$requirements."'";
	$process = $db->query($update);
	if($process)
	{
		echo "Requirement Approved!";
	}
}
else
{
	$update  = "UPDATE tbl_reqstatus SET status = 2 WHERE studentId = ".$studentId." AND requirements = '".$requirements."'";
	$process = $db->query($update);
	if($process)
	{
		echo "Requirement Declined!";
	}
	$reqName = "";
	//send sms to notify the student
	if($requirements == 'applicationForm') $reqName = "Application Form";
	if($requirements == 'bcert') $reqName = "Birth Certificate";
	if($requirements == 'form138') $reqName = "Form 138";
	if($requirements == 'goodMoral') $reqName = "Good Moral";
	if($requirements == 'brgyclearance') $reqName = "Barangay Clearance";
	if($requirements == 'houseSketch') $reqName = "House Sketch";
	if($requirements == 'votersId') $reqName = "Parent's Voter's ID";
	if($requirements == 'parentCert') $reqName = "Certificate of Employement/Unemployment of Parent";
	if($requirements == 'regform') $reqName = "Previous Registration Form";
	if($requirements == 'gradecard') $reqName = "Previous Grade Card";
	if($requirements == 'schoolid') $reqName = "School Id";

	$sql = "SELECT contactno FROM tbl_student WHERE id = ".$studentId;
	$process = $db->query($sql);
	$result = $process->fetch_assoc();

	  $contactno = $result['contactno'];
	  $sqlKey = "SELECT * FROM tbl_apikey";
	  $processKey = $db->query($sqlKey);
	  $resultKey = $processKey->fetch_assoc();
	  $theKey = $resultKey['apiKey'];
	  //get number 
	  $sqlNumber = "SELECT contactno FROM tbl_student WHERE id = ".$studentId;
	  $processNumber = $db->query($sqlNumber);
	  $resultNumber = $processNumber->fetch_assoc();
	  $contactNo = $resultNumber['contactno'];

	  $message = "Good Day! Your ".$reqName." was declined. Kindly check your requirements then reupload the right one. This message is from EPS Scholarship.";
	    $ch = curl_init();
	    $parameters = array(
	        'apikey' => $theKey, 
	        'number' => $contactNo,
	        'message' => $message,
	        'sendername' => 'SEMAPHORE'
	    );
	    curl_setopt( $ch, CURLOPT_URL,'http://api.semaphore.co/api/v4/messages' );
	    curl_setopt( $ch, CURLOPT_POST, 1 );
	    curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );
	    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	    $output = curl_exec( $ch );
	    curl_close ($ch);

}