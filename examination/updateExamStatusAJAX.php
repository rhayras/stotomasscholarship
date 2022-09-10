<?php
include('../db/db.php');
session_start();

//update examstatus
$update = "UPDATE tbl_account set examstatus = 1 WHERE studentId = ".$_SESSION['studentId'];
$processUpdate = $db->query($update);

if($processUpdate)
{
	echo 'ok';
}
else
{
	echo 'failed';
}