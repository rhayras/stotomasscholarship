<?php
include('../../db/db.php');

$id = $_POST['id'];
$examtypeid = $_POST['examtypeid'];
$questionCategory = $_POST['questionCategory'];
$getInfo = "DELETE FROM tbl_question WHERE id = ".$id;
$process = $db->query($getInfo);


//minus 1 to total and passing score
$getExamInfo = "SELECT * FROM tbl_exam WHERE id = ".$examtypeid;
$processInfo = $db->query($getExamInfo);
$resultInfo = $processInfo->fetch_assoc();

$newItemCount = $resultInfo['itemcount']-1;
$newPassing = $resultInfo['passingscore']-1;

if($questionCategory == 0)
{
	$newMathCount = $resultInfo['mathCount']-1;
	$update = "UPDATE tbl_exam set itemcount = ".$newItemCount.",passingscore = ".$newPassing.",mathCount = ".$newMathCount." WHERE id = ".$examtypeid;

}
else
{
	$engCount = $resultInfo['engCount']-1;
	$update = "UPDATE tbl_exam set itemcount = ".$newItemCount.",passingscore = ".$newPassing.",engCount = ".$engCount." WHERE id = ".$examtypeid;

}
//echo $update;	
$processUpdate = $db->query($update);
?>