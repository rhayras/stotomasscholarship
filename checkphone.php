<?php

include('db/db.php');

$mobileNo = $_POST['mobileno'];

$sql = "SELECT * FROM tbl_student WHERE contactno = '".$mobileNo."' and status NOT IN (3,5)";
$process = $db->query($sql);
if($process->num_rows > 0)
{
	echo "Phone number already used! Try another one";
}