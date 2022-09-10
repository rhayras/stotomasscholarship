<?php

include('../db/db.php');

$sql = "SELECT * FROM tbl_chat WHERE receiverId = 'admin' AND status = 1";
$process = $db->query($sql);

if($process->num_rows > 0)
{
	echo $process->num_rows;
}