<?php

include('../db/db.php');

//get current schyear and sem
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
//get all applicants info
$applicantIdArray = array();
$getApplicant = "SELECT * FROM tbl_student WHERE status = 0 AND semester = '".$sem."' AND schoolyear = '".$schyear."'";
$processApplicant = $db->query($getApplicant);
if($processApplicant->num_rows > 0)
{
	while($resultApplicant = $processApplicant->fetch_assoc())
	{
		//check municipal requirements
		$applicantId = $resultApplicant['id'];
		$checkMunicipal = "SELECT * FROM `tbl_municipalrequirements` WHERE studentid = ".$applicantId."";
		$processMunicipal = $db->query($checkMunicipal);
		if($processMunicipal->num_rows > 0)
		{
			//check school requirements
			$checkSchoolReq = "SELECT * FROM tbl_schoolrequirements WHERE studentid = ".$applicantId."
			AND schoolyear = '".$schyear."' AND semester = '".$sem."' AND status = 0 
			AND regform != '' AND gradecard != '' AND schoolid != ''";
			$processSchoolReq = $db->query($checkSchoolReq);
			if($processSchoolReq->num_rows > 0)
			{
				$applicantIdArray[] = $applicantId;
			}
		}
	}
}

if (count($applicantIdArray) == 0)
{
	echo "";
}
else
{
	echo count($applicantIdArray);
}