<?php
include('../../db/db.php');

$id = $_POST['id'];
$name = "";
$getInfo = "SELECT * FROM tbl_account WHERE id = ".$id;
$process = $db->query($getInfo);
$result = $process->fetch_assoc();


?>
<form method="POST" id="edituserform">
	<input type="hidden" name="id" id="id" value="<?php echo $result['id']?>" form='edituserform'>
	<div class="form-group">
		<label>Name</label>
		<input type="text" name="fullname" id="fullname" class="form-control" form="edituserform" required value="<?php echo $result['name']?>">
	</div>
	<div class="form-group">
		<label>Username</label>
		<input type="text" name="username" id="username" class="form-control" form="edituserform" required value="<?php echo $result['username']?>">
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="password" name="password" id="password" class="form-control" form="edituserform" required value="<?php echo $result['password']?>">
	</div>
	<div class="form-group">
		<label>Priviledge</label>
		<input type="text" name="priviledge" id="priviledge" class="form-control" form="edituserform" readonly value="<?php echo $result['priviledge']?>">
	</div>
	<div class="form-group">
		<input type="submit" class="btn btn-success pull-right" name="updateuser" id="submit" value="Submit" form="edituserform">
	</div>
</form>
