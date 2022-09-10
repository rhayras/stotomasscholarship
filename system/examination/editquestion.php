<?php
include('../../db/db.php');
$id = $_POST['id'];

$getInfo = "SELECT * FROM tbl_question WHERE id = ".$id;
$process = $db->query($getInfo);

$result = $process->fetch_assoc();



?>
<form method="POST" id="editQuestionForm"></form>
<?php

if($result['questionType'] == 0)
{
	?>
	<div class="form-group">
		<input type="hidden" name="id" value="<?php echo $result['id']?>" form="editQuestionForm">
		<input type="hidden" name="questionType" value="<?php echo $result['questionType']?>" form="editQuestionForm">
		<label>Question <?php echo $result['questionnumber']?></label>
		<textarea class="form-control" name="question" id="question" form="editQuestionForm" required style="height:100px;border:1px solid gray"><?php echo $result['question']?></textarea>
	</div>
	<p>Multiple Choices</p>
	<div class="row">
		<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
			<div class="form-group">
				<label>Choice A</label>
				<input type="text" name="a" id="a" class="form-control" form="editQuestionForm" required value="<?php echo $result['a'] ?>">
			</div>
			<div class="form-group">
				<label>Choice B</label>
				<input type="text" name="b" id="b" class="form-control" form="editQuestionForm" required value="<?php echo $result['b'] ?>">
			</div>
		</div>
		<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
			<div class="form-group">
				<label>Choice C</label>
				<input type="text" name="c" id="c" class="form-control" form="editQuestionForm" required value="<?php echo $result['c'] ?>">
			</div>
			<div class="form-group">
				<label>Choice D</label>
				<input type="text" name="d" id="d" class="form-control" form="editQuestionForm" required value="<?php echo $result['d'] ?>">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
			<div class="form-group">
				<label>Answer</label>
				<input type="text" name="ans" id="ans" class="form-control" form="editQuestionForm" placeholder="Enter only the Letter of Answer"  required value="<?php echo $result['answer'] ?>">
			</div>
		</div>
	</div>
	<?php
}
else
{
	?>
	<div class="form-group">
		<input type="hidden" name="id" value="<?php echo $result['id']?>" form="editQuestionForm">
		<input type="hidden" name="questionType" value="<?php echo $result['questionType']?>" form="editQuestionForm">
		<label>Question <?php echo $result['questionnumber']?></label>
		<textarea class="form-control" name="question" id="question" form="editQuestionForm" required style="height:100px;border:1px solid gray"><?php echo $result['question']?></textarea>
	</div>
	<div class="form-group">
		<label>Answer</label>
		<textarea name="ans" id="ans" class="form-control" form="editQuestionForm" required><?php echo $result['answer']?></textarea>
	</div>
	<?php
}
?>
<div class="form-group pull-right">
	<input type="submit"  name="updateQuestion" id="submit" class="btn btn-success" form="editQuestionForm">
</div>