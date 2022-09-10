<?php
include('../../db/db.php');

$id = $_POST['id'];

$getInfo = "SELECT * FROM tbl_schedule WHERE id = ".$id;
$process = $db->query($getInfo);
$result = $process->fetch_assoc();
$formattedtime = date('h:i', strtotime($result['schedTime']));

$getCurrent = "SELECT * FROM tbl_currentyear";
$processCurrent = $db->query($getCurrent);
$resultCurrent = $processCurrent->fetch_assoc();
$schyear = $resultCurrent['schyear'];
$sem = $resultCurrent['semester'];

?>
<form method="POST" id="editForm"></form>
<input type="hidden" name="schyear" form="editForm" value="<?php echo $schyear?>">
<input type="hidden" name="sem" form="editForm" value="<?php echo $sem?>">
<input type="hidden" name="id" form="editForm" value="<?php echo $result['id']?>">
<div class="form-group">
	<label>For </label>
	<select name="forwhat" id="forwhat" class="form-control" form="editForm">
		<option></option>
		<option <?php if($result['forWhat'] == "Examination"){echo "selected";}?>>Examination</option>
		<option <?php if($result['forWhat'] == "Interview"){echo "selected";}?>>Interview</option>
		<option <?php if($result['forWhat'] == "Orientation"){echo "selected";}?>>Orientation</option>
		<option <?php if($result['forWhat'] == "Releasing of Grant"){echo "selected";}?>>Releasing of Grant</option>
	</select>
</div>
<div class="form-group">
	<label>Student Level </label>
	<select name="studentlevel" id="studentlevel" class="form-control" form="editForm">
		<option value="0" <?php if($result['studentlevel'] == "0"){echo "selected";}?>>All</option>
		<option value="1" <?php if($result['studentlevel'] == "1"){echo "selected";}?>>Senior High School</option>
		<option value="2" <?php if($result['studentlevel'] == "2"){echo "selected";}?>>College</option>
	</select>
</div>
<div class="form-group">
	<label>Date</label>
	<input type="date" class="form-control" name="myDate" id="dateTime" form="editForm" value="<?php echo $result['schedDate']?>">
</div>
<div class="form-group">
	<label>Time</label>
	<input type="time" class="form-control" name="myTime" id="dateTime" form="editForm" value="<?php echo $formattedtime?>">
</div>
<div class="form-group">
	<div class="pull-right">
		<input type="submit" name="updateSched" value="Set Schedule" class="btn btn-success" form="editForm">
	</div>
</div>