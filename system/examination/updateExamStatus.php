<?php
include('../../db/db.php');

$id = $_POST['id'];
$status = $_POST['status'];

if($status == 0)
{
	$activate = "UPDATE tbl_exam set status = 1 WHERE id =".$id;
	$processActivate = $db->query($activate);
	if($processActivate)
	{
		echo "ok";
	}
		else
	{
		echo "no";
	}
}
else
{
	$deActivate = "UPDATE tbl_exam set status = 0 WHERE id =".$id;
	$processDeActivate = $db->query($deActivate);
	if($processDeActivate)
	{
		echo "ok";
	}
	else
	{
		echo "no";
	}
}