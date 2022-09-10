<?php
include('../../db/db.php');

$id = $_POST['id'];

$getInfo = "DELETE FROM tbl_schedule WHERE id = ".$id;
$process = $db->query($getInfo);

?>