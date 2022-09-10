<?php
include('../db/db.php');

$sender = $_POST['sender'];
$receiver = 'admin';
$dateTime = $_POST['dateTime'];
$realText = mysqli_real_escape_string($db,$_POST['messageAdmin']);


$insert = "INSERT INTO tbl_chat (senderId,receiverId,message,`dateTime`,status)
		VALUES ('".$sender."','".$receiver."','".$realText."','".$dateTime."','1')";
$process = $db->query($insert);

if($process)
{
	echo "ok";
}else{echo "failed";}
?>