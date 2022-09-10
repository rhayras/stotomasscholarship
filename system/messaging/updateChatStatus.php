<?php
include('../../db/db.php');

$studentId =$_POST['studentId'];

$update = "UPDATE tbl_chat set status = 0 WHERE senderId = ".$studentId;
$processUpdate = $db->query($update);
