<?php

include('../../db/db.php');


$btnLink = $_POST['btnLink'];

if($btnLink == 'close')
{
	$update = "UPDATE tbl_currentyear set status = 1";
	$processUpdate = $db->query($update);
	if($processUpdate)
	{
		echo "Application Closed. Scholarship is now ongoing.";
	}
}
elseif($btnLink == 'finish')
{
	$update = "UPDATE tbl_currentyear set status = 2";
	$processUpdate = $db->query($update);
	if($processUpdate)
	{
		//update all scholars status
		$updateScholars = "UPDATE tbl_student set status = 10 WHERE status IN(4,7)";
		$processScholars = $db->query($updateScholars);
		if($processScholars)
		{
			$updateRenewStatus = "UPDATE tbl_account set renewstatus = 0";
			$processRenewStatus = $db->query($updateRenewStatus);
			if($processRenewStatus)
			{
				echo "Scholarship Finish for this School Year.";
			}
		}
	}
}
