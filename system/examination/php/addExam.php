<?php

include('../../../db/db.php');

$examType = $_POST['examtype'];
$totalCount = $_POST['totalcount'];
$passingScore = $_POST['passingscore'];
$mathcount = $_POST['mathcount'];
$englishcount = $_POST['englishcount'];


//insert exam

//check if exist

$check = "SELECT * FROM tbl_exam WHERE examtype = '".$examType."'";
$processCheck = $db->query($check);
if($processCheck->num_rows > 0)
{
	?>
	<script>
		alert("Failed to insert. Examination already exist.");
		window.location.href = "../../examination/"
	</script>
	<?php
}
else
{
	$insertExam = "INSERT INTO tbl_exam (examtype,itemcount,passingscore,mathCount,engCount)
				VALUES (".$examType.",".$totalCount.",".$passingScore.",".$mathcount.",".$englishcount.")";
	$processInsertExam = $db->query($insertExam);

	$last_id = $db->insert_id;
	if($processInsertExam)
	{
		header("Location:../setquestions.php?examId=".$last_id);
	}
}
