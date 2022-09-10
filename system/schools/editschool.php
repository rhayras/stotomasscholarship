<?php
include('../../db/db.php');

$id = $_POST['id'];

$getInfo = "SELECT * FROM tbl_school WHERE id = ".$id;
$process = $db->query($getInfo);
$result = $process->fetch_assoc();
?>
<form method="POST" id="editForm"></form>
<input type="hidden" name="schoolid" id="schoolid"form="editForm" value="<?php echo $result['id']?>">
<div class="form-group">
	<label>School Type</label>
	<select name="schooltype" id="schooltype" class="form-control" form="editForm" required>
		<option></option>
		<option value="0" <?php if($result['class'] == 0){echo "selected";}?> >Public School</option>
		<option value="1" <?php if($result['class'] == 1){echo "selected";}?>>Semi-Private School</option>
		<option value="2" <?php if($result['class'] == 2){echo "selected";}?>>Private School</option>
	</select>
</div>
<div class="form-group">
	<label>School Name</label>
	<input type="text" name="schoolname" id="schoolname" class="form-control" form="editForm" required value="<?php echo $result['schoolname']?>">
</div>
<div class="form-group">
	<label>School Alias</label>
	<input type="text" name="schoolalias" id="schoolalias" class="form-control" form="editForm" required value="<?php echo $result['schoolalias']?>">
</div>
<div class="form-group">
	<input type="submit" class="btn btn-success pull-right" name="updateschool" id="submit" value="Update" form="editForm">
</div>
