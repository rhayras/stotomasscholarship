<?php

include('../../db/db.php');
include('header.php');

$examId = $_GET['examId'];
$display = "";
$getQuestionCount = "SELECT * FROM tbl_exam where id = ".$examId;
$processQuestionCount = $db->query($getQuestionCount);
if($processQuestionCount->num_rows > 0)
{
	$resultQuestionCount = $processQuestionCount->fetch_assoc();
	$totalCount = $resultQuestionCount['itemcount'];

	$currentQuestion = (isset($_POST['current'])) ? $_POST['current'] : 1;
	$redirectpage = "examination.php?examId=".$examId;
	if($currentQuestion == 1)
	{
		$display = "none";
	}
	if($totalCount >= $currentQuestion)
	{
		$getQuestion = "SELECT * FROM tbl_question where examtypeid = ".$examId." AND questionnumber = ".$currentQuestion."";
		$processQuestion = $db->query($getQuestion);
		if($processQuestion->num_rows > 0)
		{
			$resultQuestion = $processQuestion->fetch_assoc();
			$questionDbId = $resultQuestion['id'];
			//if has answer
			$getAnswer = "SELECT * FROM tbl_answer where question = ".$questionDbId." and studentNumber = 1";
			$processAnswer = $db->query($getAnswer);
			if($processAnswer->num_rows > 0)
			{
				$resultAnswer = $processAnswer->fetch_assoc();
				?>
				<br><br>
				<div class="row">
					<div class="col-md-1 col-lg-1"></div>
					<div class="col-md-10 col-lg-10">
						<form action="<?php echo $redirectpage?>" method="POST" id="questionForm"></form>
						<input type="hidden" name="current" value="<?php echo ($currentQuestion + 1 )?>" form="questionForm">
						<p style="font-size:20px;"><?php echo $currentQuestion.". ".$resultQuestion['question']?></p>
						<div class="form-group">
							<input type="radio" name="ans" id="a" value='a' form="questionForm" <?php if($resultAnswer['answer'] == 'a'){echo 'checked';}?>>
							<label for="a"><?php echo $resultQuestion['a']?></label>
							<br>
							<input type="radio" name="ans" id="b" value='b' form="questionForm" <?php if($resultAnswer['answer'] == 'b'){echo 'checked';}?>>
							<label for="b"><?php echo $resultQuestion['b']?></label>
							<br>
							<input type="radio" name="ans" id="c" value='c' form="questionForm" <?php if($resultAnswer['answer'] == 'c'){echo 'checked';}?>>
							<label for="c"><?php echo $resultQuestion['c']?></label>
							<br>
							<input type="radio" name="ans" id="d" value='d' form="questionForm" <?php if($resultAnswer['answer'] == 'd'){echo 'checked';}?>>
							<label for="d"><?php echo $resultQuestion['d']?></label>
						</div>
						<div class="form-group">
							<input type="submit"  name="submit" id="submit" class="btn btn-success" value="Back"  form="backForm" style="display:<?php echo $display?>">
							<input type="submit"  name="submit" id="submit" class="btn btn-success" value="Next"  form="questionForm">
						</div>
						<form action="<?php echo $redirectpage?>" method="POST" id="backForm"></form>
						<input type="hidden" name="current" value="<?php echo ($currentQuestion - 1 )?>" form="backForm">
					</div>
					<div class="col-md-1 col-lg-1"></div>
				</div>
				<?php
			}
			else
			{
			?>
				<br><br>
				<div class="row">
					<div class="col-md-1 col-lg-1"></div>
					<div class="col-md-10 col-lg-10">
						<form action="<?php echo $redirectpage?>" method="POST" id="questionForm"></form>
						<input type="hidden" name="current" value="<?php echo ($currentQuestion + 1 )?>" form="questionForm">
						<p style="font-size:20px;"><?php echo $currentQuestion.". ".$resultQuestion['question']?></p>
						<div class="form-group">
							<input type="radio" name="ans" id="a" value='a' form="questionForm">
							<label for="a"><?php echo $resultQuestion['a']?></label>
							<br>
							<input type="radio" name="ans" id="b" value='b' form="questionForm">
							<label for="b"><?php echo $resultQuestion['b']?></label>
							<br>
							<input type="radio" name="ans" id="c" value='c' form="questionForm">
							<label for="c"><?php echo $resultQuestion['c']?></label>
							<br>
							<input type="radio" name="ans" id="d" value='d' form="questionForm">
							<label for="d"><?php echo $resultQuestion['d']?></label>
						</div>
						<div class="form-group">
							<input type="submit"  name="submit" id="submit" class="btn btn-success" value="Back" form="backForm" style="display:<?php echo $display?>">
							<input type="submit"  name="submit" id="submit" class="btn btn-success" value="Next" form="questionForm">
						</div>
						<form action="<?php echo $redirectpage?>" method="POST" id="backForm"></form>
						<input type="hidden" name="current" value="<?php echo ($currentQuestion - 1 )?>" form="backForm">
					</div>
					<div class="col-md-1 col-lg-1"></div>
				</div>
				<?php
			}
		}
	}
	else
	{
		?><br><br>
		<div class="row">
			<div class="col-md-2 col-lg-2"></div>
			<div class="col-md-8 col-lg-8">
				<center>
					<h1>You've completed the exam</h1>
					<img src="../images/check.png" style="width:40%;height:300px;">
				</center>
			</div>
			<div class="col-md-2 col-lg-2"></div>
		</div>
		<?php
	}
	if(isset($_POST['submit']))
	{
		if($currentQuestion > 1)
		{
			$getQuestionId = "SELECT * FROM tbl_question where examtypeid = ".$examId." AND questionnumber = ".($currentQuestion - 1)."";
		}
		else
		{
			$getQuestionId = "SELECT * FROM tbl_question where examtypeid = ".$examId." AND questionnumber = ".$currentQuestion."";
		}
		$processQuestionId = $db->query($getQuestionId);
		$resultQuestionId = $processQuestionId->fetch_assoc();

		$questionDbId = $resultQuestionId['id'];
		$studentNumber = 1;
		$ans = (isset($_POST['ans'])) ? $_POST['ans'] :'';
		if($ans != "")
		{
			$checkifAnswer = "SELECT * FROM tbl_answer where studentNumber ='".$studentNumber."' AND question = ".$questionDbId." AND answer != ''";
			$processCheck = $db->query($checkifAnswer);
			if($processCheck->num_rows > 0)
			{
				$sql = "UPDATE tbl_answer set answer = '".$ans."' WHERE studentNumber = '".$studentNumber."' AND question = ".$questionDbId."";
			}
			else
			{
				$sql = "INSERT INTO tbl_answer (studentNumber,question,answer) VALUES ('".$studentNumber."',".$questionDbId.",'".$ans."')";
			}
			$processSql = $db->query($sql);
		}
		//echo $sql;
	}
}

?>
<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <div id="preloader"></div>

  <!-- JavaScript Libraries -->
  <script src="../../lib/jquery/jquery.min.js"></script>
  <script src="../../lib/jquery/jquery-migrate.min.js"></script>
  <script src="../../lib/popper/popper.min.js"></script>
  <script src="../../lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="../../lib/easing/easing.min.js"></script>
  <script src="../../lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="../../lib/scrollreveal/scrollreveal.min.js"></script>
  <!-- Contact Form JavaScript File -->
  <script src="../../contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="../../js/main.js"></script>

</body>
</html>