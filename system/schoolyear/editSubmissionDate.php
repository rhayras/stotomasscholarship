<?php
include('../../db/db.php');

$id = $_POST['id'];

$getInfo = "SELECT * FROM tbl_submission WHERE id = ".$id;
$process = $db->query($getInfo);
$result = $process->fetch_assoc();
?>
	<form method="POST" id="editForm"></form>
	<input type="hidden" name="id" id="id" value="<?php echo $result['id']?>" form="editForm">
    <input type="hidden" name="schyear" id="schyear" value="<?php echo $result['schyear']?>" form="editForm">
    <input type="hidden" name="semester" id="semester" value="<?php echo $result['semester']?>" form="editForm">
    <div class="form-group">
          <label>Student Type</label>
	      <select name="scholartype" id="scholartype" class="form-control" form="editForm" disabled>
	          <option></option>
	          <option value="1" <?php if($result['scholartype']== 1){echo "selected";} ?>>Senior High School</option>
	          <option value="2" <?php if($result['scholartype']== 2){echo "selected";} ?>>College</option>
	      </select>
   </div>
   <div class="form-group">
	    <label>Start Date</label>
	    <input type="date" name="startdate" id="startdate" value="<?php echo $result['fromdate']?>" class="form-control" form="editForm" required>
   </div>
   <div class="form-group">
	    <label>End Date</label>
	    <input type="date" name="enddate" id="enddate" class="form-control" value="<?php echo $result['todate']?>" form="editForm" required>
   </div>
  <div class="form-group">
    	<input type="submit" class="btn btn-success pull-right" name="editSubmissionDate" id="submit" value="Update" form="editForm">
  </div>
