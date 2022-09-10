<?php

include('../db/db.php');
session_start();
$username = mysqli_real_escape_string($db, $_POST['username']);
$password = mysqli_real_escape_string($db, $_POST['password']);

$loginQuery = "SELECT * FROM tbl_account WHERE username = '".$username."' AND password = '".$password."' AND status = 0";
$processLogin = $db->query($loginQuery);
if($processLogin->num_rows > 0)
{
	$resultLogin = $processLogin->fetch_assoc();
	if($resultLogin['priviledge'] == 'admin')
	{
		$_SESSION['adminId'] = $resultLogin['id'];
		$_SESSION['username'] = $resultLogin['username'];
		$_SESSION['priviledge'] = $resultLogin['priviledge'];
		$_SESSION['studentId'] = $resultLogin['studentId'];
		$_SESSION['name'] = $resultLogin['name'];

		$updateActiveStatus = "UPDATE tbl_account set activeStatus = 1 WHERE username = '".$username."' AND password = '".$password."' AND status = 0";
		$processActive = $db->query($updateActiveStatus);
		echo "success";
	}
	else
	{
		$sql = "SELECT status FROM tbl_student WHERE id = ".$resultLogin['studentId'];
		$process = $db->query($sql);
		$result = $process->fetch_assoc();
		$status = $result['status'];

		if($status == 3)
		{
			echo "This account is not available due to declination of your account.";
		}
		elseif($status == 5)
		{
			echo "This account is not available due to failed result in examination.";
		}
		else
		{
			$_SESSION['adminId'] = $resultLogin['id'];
			$_SESSION['username'] = $resultLogin['username'];
			$_SESSION['priviledge'] = $resultLogin['priviledge'];
			$_SESSION['studentId'] = $resultLogin['studentId'];
			$_SESSION['name'] = $resultLogin['name'];

			$updateActiveStatus = "UPDATE tbl_account set activeStatus = 1 WHERE username = '".$username."' AND password = '".$password."' AND status = 0";
			$processActive = $db->query($updateActiveStatus);
			echo "success";
		}
	}

}
else
{
	echo "failed";
}

