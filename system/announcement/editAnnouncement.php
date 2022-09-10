<?php
include('../../db/db.php');

$id = $_POST['id'];
$name = "";
$getInfo = "SELECT * FROM tbl_memo WHERE id = ".$id;
$process = $db->query($getInfo);
$result = $process->fetch_assoc();

?>
<form method="POST" id="editAnnouncementForm">
	<input type="hidden" name="id" id="id" value="<?php echo $result['id']?>" form='editAnnouncementForm'>
	<div class="form-group">
		<label>Title</label>
		<input type="text" name="title" id="title" class="form-control" form="editAnnouncementForm" required value="<?php echo $result['title']?>">
	</div>
	<div class="form-group">
		<label>Content</label>
		<textarea class="form-control" name="content" id="content" form="editAnnouncementForm"><?php echo $result['content']?></textarea>
	</div>
	<div class="form-group">
		<input type="submit" class="btn btn-success pull-right" name="updateAnnouncement" id="submit" value="Submit" form="editAnnouncementForm">
	</div>
</form>
