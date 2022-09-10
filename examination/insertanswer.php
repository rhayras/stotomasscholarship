<?php
include('../db/db.php');
session_start();
$studentId = $_SESSION['studentId'];

$current = $_POST['current'];
$ans = $_POST['ans'];


$check = "SELECT * FROM tbl_answer WHERE studentNumber = ".$studentId." AND question = ".$current."";
$processCheck = $db->query($check);
if($processCheck->num_rows > 0)
{
	$update = "UPDATE tbl_answer set answer= '".$ans."' WHERE studentNumber = ".$studentId." AND question = ".$current."";
	$processUpdate = $db->query($update);
	if($processUpdate)
	{
		echo $current;
	}
}
else
{
	$insert = "INSERT INTO tbl_answer (studentNumber,question,answer) VALUES (".$studentId.",'".$current."','".$ans."')";
	$processInsert = $db->query($insert);
	if($processInsert)
	{
		echo $current;
	}
}