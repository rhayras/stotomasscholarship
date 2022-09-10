<?php
include('../db/db.php');
session_start();
$studentId = $_SESSION['studentId'];
	
$examId = $_POST['examId'];
$questionId = $_POST['questionId'];
$questionNo = $_POST['questionNo'];
$questionType = $_POST['questionType'];
$display = "";
$getQuestionCount = "SELECT * FROM tbl_exam where id = ".$examId;
$processCount = $db->query($getQuestionCount);
$resultCount = $processCount->fetch_assoc();

$totalItem = $resultCount['itemcount'];
?>
<div class="row">
	<div class="col-md-1 col-lg-1"></div>
	<div class="col-md-10 col-lg-10">
		<?php
		if($questionNo <= $totalItem)
		{
			?>
				<h3><?php echo $questionNo." / ".$totalItem?></h3>
			<?php
		}
		?>
	</div>
	<div class="col-md-1 col-lg-1"></div>
</div>
<?php
if($questionType == "proceed")
{
	$resultQUestionId = "";
	if($questionId == "")
	{
		$category = '';
		$getFirst = "SELECT * FROM tbl_question where examtypeid = ".$examId." ORDER BY id ASC LIMIT 1";
		$processFirst = $db->query($getFirst);
		$resultFirst = $processFirst->fetch_assoc();
		$resultQUestionId = $resultFirst['id'];

		if($resultFirst['questionCategory'] == 0) $category = 'Mathematics';
		if($resultFirst['questionCategory'] == 1) $category = 'English';
			//if has answer
		$getAnswer = "SELECT * FROM tbl_answer where question = ".$resultQUestionId." and studentNumber = ".$studentId;
		$processAnswer = $db->query($getAnswer);
		if($processAnswer->num_rows > 0)
		{
			$resultAnswer = $processAnswer->fetch_assoc();

			if($resultFirst['questionType'] == 0)
			{
				?>
				<br>
				<div class="row">
					<div class="col-md-1 col-lg-1"></div>
					<div class="col-md-10 col-lg-10">
						<h5><?php echo $category?></h5>
						<form  method="POST" id="questionForm"></form>
						<input type="hidden" name="current" value="<?php echo $resultQUestionId?>" id="current" form="questionForm">
						<input type="hidden" name="ans" value=" " id="blank" form="questionForm">
						<p style="font-size:20px;"><?php echo $questionNo.". ".$resultFirst['question']?></p>
						<div class="form-group">
							<input type="radio" name="ans" id="a" value='a' form="questionForm" <?php if($resultAnswer['answer'] == 'a'){echo 'checked';}?>>
							<label for="a"><?php echo $resultFirst['a']?></label>
							<br>
							<input type="radio" name="ans" id="b" value='b' form="questionForm" <?php if($resultAnswer['answer'] == 'b'){echo 'checked';}?>>
							<label for="b"><?php echo $resultFirst['b']?></label>
							<br>
							<input type="radio" name="ans" id="c" value='c' form="questionForm" <?php if($resultAnswer['answer'] == 'c'){echo 'checked';}?>>
							<label for="c"><?php echo $resultFirst['c']?></label>
							<br>
							<input type="radio" name="ans" id="d" value='d' form="questionForm" <?php if($resultAnswer['answer'] == 'd'){echo 'checked';}?>>
							<label for="d"><?php echo $resultFirst['d']?></label>
						</div>
						<div class="form-group">
							<input type="submit"  name="submit" id="submit" class="btn btn-success" value="Next"  form="questionForm">
						</div>
						<form  method="POST" id="backForm"></form>
						<input type="hidden" name="current" value="" form="backForm">
					</div>
					<div class="col-md-1 col-lg-1"></div>
				</div>
				<?php
			}
			else
			{
				?>
				<br>
				<div class="row">
					<div class="col-md-1 col-lg-1"></div>
					<div class="col-md-10 col-lg-10">
						<h5><?php echo $category?></h5>
						<form  method="POST" id="questionForm"></form>
						<input type="hidden" name="current" value="<?php echo $resultQUestionId?>" id="current" form="questionForm">
						<input type="hidden" name="ans" value=" " id="blank" form="questionForm">
						<p style="font-size:20px;"><?php echo $questionNo.". ".$resultFirst['question']?></p>
						<div class="form-group">
							<label>
								Answer
							</label>
							<textarea name="ans" id="ans" class="form-control" form="questionForm"><?php echo $resultAnswer['answer']?></textarea>
						</div>
						<div class="form-group">
							<input type="submit"  name="submit" id="submit" class="btn btn-success" value="Next"  form="questionForm">
						</div>
						<form  method="POST" id="backForm"></form>
						<input type="hidden" name="current" value="" form="backForm">
					</div>
					<div class="col-md-1 col-lg-1"></div>
				</div>
				<?php
			}
		}
		else
		{
			if($resultFirst['questionType'] == 0)
			{
				?>
					<br>
					<div class="row">
						<div class="col-md-1 col-lg-1"></div>
						<div class="col-md-10 col-lg-10">
							<h5><?php echo $category?></h5>
							<form method="POST" id="questionForm"></form>
							<input type="hidden" name="current" value="<?php echo $resultQUestionId?>" id="current" form="questionForm">
							<input type="hidden" name="ans" value=" " id="ans" form="questionForm">
							<p style="font-size:20px;"><?php echo $questionNo.". ".$resultFirst['question']?></p>
							<div class="form-group">
								<input type="radio" name="ans" id="a" value='a' form="questionForm">
								<label for="a"><?php echo $resultFirst['a']?></label>
								<br>
								<input type="radio" name="ans" id="b" value='b' form="questionForm">
								<label for="b"><?php echo $resultFirst['b']?></label>
								<br>
								<input type="radio" name="ans" id="c" value='c' form="questionForm">
								<label for="c"><?php echo $resultFirst['c']?></label>
								<br>
								<input type="radio" name="ans" id="d" value='d' form="questionForm">
								<label for="d"><?php echo $resultFirst['d']?></label>
							</div>
							<div class="form-group">
								<input type="submit"  name="submit" id="submit" class="btn btn-success" value="Next" form="questionForm">
							</div>
						</div>
						<div class="col-md-1 col-lg-1"></div>
					</div>
				<?php
			}
			else
			{
				?>
				<br>
				<div class="row">
					<div class="col-md-1 col-lg-1"></div>
					<div class="col-md-10 col-lg-10">
						<h5><?php echo $category?></h5>
						<form  method="POST" id="questionForm"></form>
						<input type="hidden" name="current" value="<?php echo $resultQUestionId?>" id="current" form="questionForm">
						<input type="hidden" name="ans" value=" " id="ans" form="questionForm">
						<p style="font-size:20px;"><?php echo $questionNo.". ".$resultFirst['question']?></p>
						<div class="form-group">
							<label>
								Answer
							</label>
							<textarea name="ans" id="ans" class="form-control" form="questionForm"></textarea>
						</div>
						<div class="form-group">
							<input type="submit"  name="submit" id="submit" class="btn btn-success" value="Next"  form="questionForm">
						</div>
						<form  method="POST" id="backForm"></form>
						<input type="hidden" name="current" value="" form="backForm">
					</div>
					<div class="col-md-1 col-lg-1"></div>
				</div>
				<?php
			}
		}
	}
	else
	{
		//get the last question
		$sql = "SELECT * FROM tbl_question where examtypeid = ".$examId." ORDER BY id DESC LIMIT 1";
		$processSql = $db->query($sql);
		$resultSql = $processSql->fetch_assoc();
		$finalItem = $resultSql['id'];

		if($questionId == $finalItem)
		{
			?>
			<br><br>
			<div class="row">
				<div class="col-md-2 col-lg-2"></div>
				<div class="col-md-8 col-lg-8">
					<center>
						<h1>You've completed the examination. Kindly wait until the admin get the result. Thank you. Have a nice day!</h1>
						<img src="../system/images/check.png" style="width:40%;height:200px;">
					</center>
				</div>
				<div class="col-md-2 col-lg-2"></div>
			</div>
			<?php
			//update examstatus
			$update = "UPDATE tbl_account set examstatus = 1 WHERE studentId = ".$_SESSION['studentId'];
			$processUpdate = $db->query($update);
			echo 
			"<script>
				window.setTimeout(function(){
			        window.close();
			    }, 5000);
			</script>";
		}
		else
		{
			$btnSubmitValue = "";
			$areYouSureAttr = "";
			$beforeFinalItem = "SELECT * FROM tbl_question where examtypeid = ".$examId." AND id = (SELECT MAX(id) from tbl_question where id < ".$finalItem.")";
			$processBeforeFinal = $db->query($beforeFinalItem);
			$ressultBeforeFinal = $processBeforeFinal->fetch_assoc();
			$beforeFinalId = $ressultBeforeFinal['id'];
			if($questionId == $beforeFinalId)
			{
				$btnSubmitValue = "Submit";
			}else{$btnSubmitValue = "Next";}
			
			$category = '';
			$getNext = "SELECT * FROM tbl_question where examtypeid = ".$examId." AND id > ".$questionId." LIMIT 1";
			$processNext = $db->query($getNext);
			$resultNext = $processNext->fetch_assoc();
			$resultQUestionId = $resultNext['id'];

			if($resultNext['questionCategory'] == 0) $category = 'Mathematics';
			if($resultNext['questionCategory'] == 1) $category = 'English';

			$getAnswer = "SELECT * FROM tbl_answer where question = ".$resultQUestionId." and studentNumber = ".$studentId;
			$processAnswer = $db->query($getAnswer);
			if($processAnswer->num_rows > 0)
			{
				$resultAnswer = $processAnswer->fetch_assoc();

				if($resultNext['questionType'] == 0)
				{
					?>
					<br>
					<div class="row">
						<div class="col-md-1 col-lg-1"></div>
						<div class="col-md-10 col-lg-10">
							<h5><?php echo $category?></h5>
							<form  method="POST" id="questionForm"></form>
							<input type="hidden" name="current" value="<?php echo $resultQUestionId?>" id="current" form="questionForm">
							<input type="hidden" name="ans" value=" " id="blank" form="questionForm">
							<p style="font-size:20px;"><?php echo $questionNo.". ".$resultNext['question']?></p>
							<div class="form-group">
								<input type="radio" name="ans" id="a" value='a' form="questionForm" <?php if($resultAnswer['answer'] == 'a'){echo 'checked';}?>>
								<label for="a"><?php echo $resultNext['a']?></label>
								<br>
								<input type="radio" name="ans" id="b" value='b' form="questionForm" <?php if($resultAnswer['answer'] == 'b'){echo 'checked';}?>>
								<label for="b"><?php echo $resultNext['b']?></label>
								<br>
								<input type="radio" name="ans" id="c" value='c' form="questionForm" <?php if($resultAnswer['answer'] == 'c'){echo 'checked';}?>>
								<label for="c"><?php echo $resultNext['c']?></label>
								<br>
								<input type="radio" name="ans" id="d" value='d' form="questionForm" <?php if($resultAnswer['answer'] == 'd'){echo 'checked';}?>>
								<label for="d"><?php echo $resultNext['d']?></label>
							</div>
							<div class="form-group">
								<button data-id= "<?php echo $resultQUestionId?>" class="btn btn-success" id="prevBtn">Prev</button>
								<?php
								if($btnSubmitValue == 'Submit')
								{
									?>
									<input type="button"  name="submit" id="submit" class="btn btn-success" value="<?php echo $btnSubmitValue?>" onclick="verifyAnswers()" form="questionForm">
									<?php
								}
								else
								{
									?>
									<input type="submit"  name="submit" id="submit" class="btn btn-success" value="<?php echo $btnSubmitValue?>" form="questionForm">
									<?php
								}
								?>
								
							</div>
							<form  method="POST" id="backForm"></form>
							<input type="hidden" name="current" value="" form="backForm">
						</div>
						<div class="col-md-1 col-lg-1"></div>
					</div>
					<?php
				}
				else
				{
					?>
					<br>
					<div class="row">
						<div class="col-md-1 col-lg-1"></div>
						<div class="col-md-10 col-lg-10">
							<h5><?php echo $category?></h5>
							<form  method="POST" id="questionForm"></form>
							<input type="hidden" name="current" value="<?php echo $resultQUestionId?>" id="current" form="questionForm">
							<input type="hidden" name="ans" value=" " id="blank" form="questionForm">
							<p style="font-size:20px;"><?php echo $questionNo.". ".$resultNext['question']?></p>
							<div class="form-group">
								<label>
									Answer
								</label>
								<textarea name="ans" id="ans" class="form-control" form="questionForm"><?php echo $resultAnswer['answer']?></textarea>
							</div>
							<div class="form-group">
								<button data-id= "<?php echo $resultQUestionId?>" class="btn btn-success" id="prevBtn">Prev</button>
								<?php
								if($btnSubmitValue == 'Submit')
								{
									?>
									<input type="button"  name="submit" id="submit" class="btn btn-success" value="<?php echo $btnSubmitValue?>" onclick="verifyAnswers()" form="questionForm">
									<?php
								}
								else
								{
									?>
									<input type="submit"  name="submit" id="submit" class="btn btn-success" value="<?php echo $btnSubmitValue?>" form="questionForm">
									<?php
								}
								?>
							</div>
							<form  method="POST" id="backForm"></form>
							<input type="hidden" name="current" value="" form="backForm">
						</div>
						<div class="col-md-1 col-lg-1"></div>
					</div>
					<?php
				}
			}
			else
			{
				if($resultNext['questionType'] == 0)
				{
					?>
						<br>
						<div class="row">
							<div class="col-md-1 col-lg-1"></div>
							<div class="col-md-10 col-lg-10">
								<h5><?php echo $category?></h5>
								<form method="POST" id="questionForm"></form>
								<input type="hidden" name="current" value="<?php echo $resultQUestionId?>" id="current" form="questionForm">

								<input type="hidden" name="ans" value=" " id="blank" form="questionForm">
								<p style="font-size:20px;"><?php echo $questionNo.". ".$resultNext['question']?></p>
								<div class="form-group">
									<input type="radio" name="ans" id="a" value='a' form="questionForm">
									<label for="a"><?php echo $resultNext['a']?></label>
									<br>
									<input type="radio" name="ans" id="b" value='b' form="questionForm">
									<label for="b"><?php echo $resultNext['b']?></label>
									<br>
									<input type="radio" name="ans" id="c" value='c' form="questionForm">
									<label for="c"><?php echo $resultNext['c']?></label>
									<br>
									<input type="radio" name="ans" id="d" value='d' form="questionForm">
									<label for="d"><?php echo $resultNext['d']?></label>
								</div>
								<div class="form-group">
									<button data-id= "<?php echo $resultQUestionId?>" class="btn btn-success" id="prevBtn">Prev</button>
									<?php
									if($btnSubmitValue == 'Submit')
									{
										?>
										<input type="button"  name="submit" id="submit" class="btn btn-success" value="<?php echo $btnSubmitValue?>" onclick="verifyAnswers()" form="questionForm">
										<?php
									}
									else
									{
										?>
										<input type="submit"  name="submit" id="submit" class="btn btn-success" value="<?php echo $btnSubmitValue?>" form="questionForm">
										<?php
									}
									?>
								</div>
							</div>
							<div class="col-md-1 col-lg-1"></div>
						</div>
					<?php
				}
				else
				{
					?>
					<br>
					<div class="row">
						<div class="col-md-1 col-lg-1"></div>
						<div class="col-md-10 col-lg-10">
							<h5><?php echo $category?></h5>
							<form  method="POST" id="questionForm"></form>
							<input type="hidden" name="current" value="<?php echo $resultQUestionId?>" id="current" form="questionForm">
							<input type="hidden" name="ans" value=" " id="ans" form="questionForm">
							<p style="font-size:20px;"><?php echo $questionNo.". ".$resultNext['question']?></p>
							<div class="form-group">
								<label>
									Answer
								</label>
								<textarea name="ans" id="ans" class="form-control" form="questionForm"></textarea>
							</div>
							<div class="form-group">
								<button data-id= "<?php echo $resultQUestionId?>" class="btn btn-success" id="prevBtn">Prev</button>
								<?php
								if($btnSubmitValue == 'Submit')
								{
									?>
									<input type="button"  name="submit" id="submit" class="btn btn-success" value="<?php echo $btnSubmitValue?>" onclick="verifyAnswers()" form="questionForm">
									<?php
								}
								else
								{
									?>
									<input type="submit"  name="submit" id="submit" class="btn btn-success" value="<?php echo $btnSubmitValue?>" form="questionForm">
									<?php
								}
								?>
							</div>
							<form  method="POST" id="backForm"></form>
							<input type="hidden" name="current" value="" form="backForm">
						</div>
						<div class="col-md-1 col-lg-1"></div>
					</div>
					<?php
				}
			}
		}
	}

}
elseif ($questionType == "previous")
{
	if($questionId == "")
	{
		$category = '';
		
		$getFirst = "SELECT * FROM tbl_question where examtypeid = ".$examId." ORDER BY id ASC LIMIT 1";
		$processFirst = $db->query($getFirst);
		$resultFirst = $processFirst->fetch_assoc();
		$resultQUestionId = $resultFirst['id'];

		if($resultFirst['questionCategory'] == 0) $category = 'Mathematics';
		if($resultFirst['questionCategory'] == 1) $category = 'English';
			//if has answer
		$getAnswer = "SELECT * FROM tbl_answer where question = ".$resultQUestionId." and studentNumber = ".$studentId;
		$processAnswer = $db->query($getAnswer);
		if($processAnswer->num_rows > 0)
		{
			$resultAnswer = $processAnswer->fetch_assoc();

			if($resultFirst['questionType'] == 0)
			{
				?>
				<br><br>
				<div class="row">
					<div class="col-md-1 col-lg-1"></div>
					<div class="col-md-10 col-lg-10">
						<form  method="POST" id="questionForm"></form>
						<input type="hidden" name="current" value="<?php echo $resultQUestionId?>" id="current" form="questionForm">
						<input type="hidden" name="ans" value=" " id="blank" form="questionForm">
						<p style="font-size:20px;"><?php echo $questionNo.". ".$resultFirst['question']?></p>
						<div class="form-group">
							<input type="radio" name="ans" id="a" value='a' form="questionForm" <?php if($resultAnswer['answer'] == 'a'){echo 'checked';}?>>
							<label for="a"><?php echo $resultFirst['a']?></label>
							<br>
							<input type="radio" name="ans" id="b" value='b' form="questionForm" <?php if($resultAnswer['answer'] == 'b'){echo 'checked';}?>>
							<label for="b"><?php echo $resultFirst['b']?></label>
							<br>
							<input type="radio" name="ans" id="c" value='c' form="questionForm" <?php if($resultAnswer['answer'] == 'c'){echo 'checked';}?>>
							<label for="c"><?php echo $resultFirst['c']?></label>
							<br>
							<input type="radio" name="ans" id="d" value='d' form="questionForm" <?php if($resultAnswer['answer'] == 'd'){echo 'checked';}?>>
							<label for="d"><?php echo $resultFirst['d']?></label>
						</div>
						<div class="form-group">
							<input type="submit"  name="submit" id="submit" class="btn btn-success" value="Next"  form="questionForm">
						</div>
						<form  method="POST" id="backForm"></form>
						<input type="hidden" name="current" value="" form="backForm">
					</div>
					<div class="col-md-1 col-lg-1"></div>
				</div>
				<?php
			}
			else
			{
				?>
				<br>
				<div class="row">
					<div class="col-md-1 col-lg-1"></div>
					<div class="col-md-10 col-lg-10">
						<h5><?php echo $category?></h5>
						<form  method="POST" id="questionForm"></form>
						<input type="hidden" name="current" value="<?php echo $resultQUestionId?>" id="current" form="questionForm">
						<input type="hidden" name="ans" value=" " id="blank" form="questionForm">
						<p style="font-size:20px;"><?php echo $questionNo.". ".$resultFirst['question']?></p>
						<div class="form-group">
							<label>
								Answer
							</label>
							<textarea name="ans" id="ans" class="form-control" form="questionForm"><?php echo $resultAnswer['answer']?></textarea>
						</div>
						<div class="form-group">
							<input type="submit"  name="submit" id="submit" class="btn btn-success" value="Next"  form="questionForm">
						</div>
						<form  method="POST" id="backForm"></form>
						<input type="hidden" name="current" value="" form="backForm">
					</div>
					<div class="col-md-1 col-lg-1"></div>
				</div>
				<?php
			}
		}
		else
		{
			if($resultFirst['questionType'] == 0)
			{
				?>
					<br><br>
					<div class="row">
						<div class="col-md-1 col-lg-1"></div>
						<div class="col-md-10 col-lg-10">
							<form method="POST" id="questionForm"></form>
							<input type="hidden" name="current" value="<?php echo $resultQUestionId?>" id="current" form="questionForm">

							<p style="font-size:20px;"><?php echo $questionNo.". ".$resultFirst['question']?></p>
							<input type="hidden" name="ans" value=" " id="ans" form="questionForm">
							<div class="form-group">
								<input type="radio" name="ans" id="a" value='a' form="questionForm">
								<label for="a"><?php echo $resultFirst['a']?></label>
								<br>
								<input type="radio" name="ans" id="b" value='b' form="questionForm">
								<label for="b"><?php echo $resultFirst['b']?></label>
								<br>
								<input type="radio" name="ans" id="c" value='c' form="questionForm">
								<label for="c"><?php echo $resultFirst['c']?></label>
								<br>
								<input type="radio" name="ans" id="d" value='d' form="questionForm">
								<label for="d"><?php echo $resultFirst['d']?></label>
							</div>
							<div class="form-group">
								<input type="submit"  name="submit" id="submit" class="btn btn-success" value="Next" form="questionForm">
							</div>
						</div>
						<div class="col-md-1 col-lg-1"></div>
					</div>
				<?php
			}
			else
			{
				?>
				<br>
				<div class="row">
					<div class="col-md-1 col-lg-1"></div>
					<div class="col-md-10 col-lg-10">
						<h5><?php echo $category?></h5>
						<form  method="POST" id="questionForm"></form>
						<input type="hidden" name="current" value="<?php echo $resultQUestionId?>" id="current" form="questionForm">
						<p style="font-size:20px;"><?php echo $questionNo.". ".$resultFirst['question']?></p>
						<input type="hidden" name="ans" value=" " id="ans" form="questionForm">
						<div class="form-group">
							<label>
								Answer
							</label>
							<textarea name="ans" id="ans" class="form-control" form="questionForm"></textarea>
						</div>
						<div class="form-group">
							<input type="submit"  name="submit" id="submit" class="btn btn-success" value="Next"  form="questionForm">
						</div>
						<form  method="POST" id="backForm"></form>
						<input type="hidden" name="current" value="" form="backForm">
					</div>
					<div class="col-md-1 col-lg-1"></div>
				</div>
				<?php
			}
		}
	}
	else
	{
		$category = '';
		
		$getNext = "SELECT * FROM tbl_question where examtypeid = ".$examId." AND id = (SELECT MAX(id) from tbl_question where id < ".$questionId.")";
		$processNext = $db->query($getNext);
		$resultNext = $processNext->fetch_assoc();
		$resultQUestionId = $resultNext['id'];

		if($resultNext['questionCategory'] == 0) $category = 'Mathematics';
		if($resultNext['questionCategory'] == 1) $category = 'English';

		$getAnswer = "SELECT * FROM tbl_answer where question = ".$resultQUestionId." and studentNumber = ".$studentId;
		$processAnswer = $db->query($getAnswer);
		if($processAnswer->num_rows > 0)
		{
			$resultAnswer = $processAnswer->fetch_assoc();
			if($resultNext['questionType'] == 0)
			{
				?>
				<br>
				<div class="row">
					<div class="col-md-1 col-lg-1"></div>
					<div class="col-md-10 col-lg-10">
						<h5><?php echo $category?></h5>
						<form  method="POST" id="questionForm"></form>
						<input type="hidden" name="current" value="<?php echo $resultQUestionId?>" id="current" form="questionForm">
						<input type="hidden" name="ans" value=" " id="blank" form="questionForm">
						<p style="font-size:20px;"><?php echo $questionNo.". ".$resultNext['question']?></p>
						<div class="form-group">
							<input type="radio" name="ans" id="a" value='a' form="questionForm" <?php if($resultAnswer['answer'] == 'a'){echo 'checked';}?>>
							<label for="a"><?php echo $resultNext['a']?></label>
							<br>
							<input type="radio" name="ans" id="b" value='b' form="questionForm" <?php if($resultAnswer['answer'] == 'b'){echo 'checked';}?>>
							<label for="b"><?php echo $resultNext['b']?></label>
							<br>
							<input type="radio" name="ans" id="c" value='c' form="questionForm" <?php if($resultAnswer['answer'] == 'c'){echo 'checked';}?>>
							<label for="c"><?php echo $resultNext['c']?></label>
							<br>
							<input type="radio" name="ans" id="d" value='d' form="questionForm" <?php if($resultAnswer['answer'] == 'd'){echo 'checked';}?>>
							<label for="d"><?php echo $resultNext['d']?></label>
						</div>
						<div class="form-group">
							<button data-id= "<?php echo $resultQUestionId?>" class="btn btn-success" id="prevBtn">Prev</button>
							<input type="submit"  name="submit" id="submit" class="btn btn-success" value="Next"  form="questionForm">
						</div>
						<form  method="POST" id="backForm"></form>
						<input type="hidden" name="current" value="" form="backForm">
					</div>
					<div class="col-md-1 col-lg-1"></div>
				</div>
				<?php
			}
			else
			{
				?>
				<br>
				<div class="row">
					<div class="col-md-1 col-lg-1"></div>
					<div class="col-md-10 col-lg-10">
						<h5><?php echo $category?></h5>
						<form  method="POST" id="questionForm"></form>
						<input type="hidden" name="current" value="<?php echo $resultQUestionId?>" id="current" form="questionForm">
						<input type="hidden" name="ans" value=" " id="blank" form="questionForm">
						<p style="font-size:20px;"><?php echo $questionNo.". ".$resultNext['question']?></p>
						<div class="form-group">
							<label>
								Answer
							</label>
							<textarea name="ans" id="ans" class="form-control" form="questionForm"><?php echo $resultAnswer['answer']?></textarea>
						</div>
						<div class="form-group">
								<button data-id= "<?php echo $resultQUestionId?>" class="btn btn-success" id="prevBtn">Prev</button>
								<input type="submit"  name="submit" id="submit" class="btn btn-success" value="Next"  form="questionForm">
							</div>
							<form  method="POST" id="backForm"></form>
							<input type="hidden" name="current" value="" form="backForm">
					</div>
					<div class="col-md-1 col-lg-1"></div>
				</div>
				<?php
			}
		}
		else
		{
			if($resultNext['questionType'] == 0)
			{
				?>
					<br>
					<div class="row">
						<div class="col-md-1 col-lg-1"></div>
						<div class="col-md-10 col-lg-10">
							<h5><?php echo $category?></h5>
							<form method="POST" id="questionForm"></form>
							<input type="hidden" name="current" value="<?php echo $resultQUestionId?>" id="current" form="questionForm">
							<input type="hidden" name="ans" value=" " id="ans" form="questionForm">
							<p style="font-size:20px;"><?php echo $questionNo.". ".$resultNext['question']?></p>
							<div class="form-group">
								<input type="radio" name="ans" id="a" value='a' form="questionForm">
								<label for="a"><?php echo $resultNext['a']?></label>
								<br>
								<input type="radio" name="ans" id="b" value='b' form="questionForm">
								<label for="b"><?php echo $resultNext['b']?></label>
								<br>
								<input type="radio" name="ans" id="c" value='c' form="questionForm">
								<label for="c"><?php echo $resultNext['c']?></label>
								<br>
								<input type="radio" name="ans" id="d" value='d' form="questionForm">
								<label for="d"><?php echo $resultNext['d']?></label>
							</div>
							<div class="form-group">
								<button data-id= "<?php echo $resultQUestionId?>" class="btn btn-success" id="prevBtn">Prev</button>
								<input type="submit"  name="submit" id="submit" class="btn btn-success" value="Next" form="questionForm">
							</div>
						</div>
						<div class="col-md-1 col-lg-1"></div>
					</div>
				<?php
			}
			else
			{
				?>
				<br>
				<div class="row">
					<div class="col-md-1 col-lg-1"></div>
					<div class="col-md-10 col-lg-10">
						<h5><?php echo $category?></h5>
						<form  method="POST" id="questionForm"></form>
						<input type="hidden" name="current" value="<?php echo $resultQUestionId?>" id="current" form="questionForm">
						<input type="hidden" name="ans" value=" " id="ans" form="questionForm">
						<p style="font-size:20px;"><?php echo $questionNo.". ".$resultNext['question']?></p>
						<div class="form-group">
							<label>
								Answer
							</label>
							<textarea name="ans" id="ans" class="form-control" form="questionForm"></textarea>
						</div>
						<div class="form-group">
								<button data-id= "<?php echo $resultQUestionId?>" class="btn btn-success" id="prevBtn">Prev</button>
								<input type="submit"  name="submit" id="submit" class="btn btn-success" value="Next"  form="questionForm">
							</div>
							<form  method="POST" id="backForm"></form>
							<input type="hidden" name="current" value="" form="backForm">
					</div>
					<div class="col-md-1 col-lg-1"></div>
				</div>
				<?php
			}
		}
	}
}