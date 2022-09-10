<?php
include('../../db/db.php');

$id = $_POST['id'];

$delete = "DELETE FROM tbl_exam WHERE id = ".$id;
$processDelete = $db->query($delete);
if($processDelete)
{
	
}