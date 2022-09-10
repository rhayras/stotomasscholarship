<?php
session_start();
include('../db/db.php');
if($_SESSION['priviledge'] == 'student')
{
	$update = "UPDATE tbl_account set activeStatus = 0 WHERE studentId = ".$_SESSION['studentId'];
	$process = $db->query($update);

}

$_SESSION['username'] = "";
$_SESSION['priviledge'] = "";
$_SESSION['studentId'] = "";
$_SESSION['name'] = "";

header("Location:../");