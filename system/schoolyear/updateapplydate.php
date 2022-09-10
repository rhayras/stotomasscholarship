<?php
include('../../db/db.php');

$id = $_POST['id'];
$schyear = $_POST['schyear'];
$semester = $_POST['semester'];
$startdate = $_POST['startdate'];
$enddate = $_POST['enddate'];

$update = "UPDATE tbl_applydate set fromdate = '".$startdate."',todate = '".$enddate."' WHERE id = ".$id."";
$process = $db->query($update);
if($process)
{
	echo "0";
}
else
{
	echo "1";
}
