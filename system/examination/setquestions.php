<?php
include('../../db/db.php');
include('header.php');
?>
<style>
	#myNav
	{
		/*background-color: #2e7d32;*/
		height:100px;
		padding: 20px;
		background-color: #00C851;
		color: white;
	}
	body
	{
		background-color:#f5f5f5;
	}
	.navbar-default {
	   padding-top: 10px;
	  padding-bottom: 10px;
	}
   body
    {
      background-image: linear-gradient(to top, #a5d6a7 , #a5d6a7 );
    }
    #mainContainer
    {
    	background-color:white;
    	padding: 10px;
    	padding-left: 20px;
    	padding-right: 10px;
    	width: 100%;
    	height: auto;
    }
    input[type="text"]
    {
    	border:1px solid gray;
    }
</style>
	<div class="row" style="padding: 10px;">
		<div class="col-md-12 col-lg-12" id="mainContainer" style="min-height: 520px;">
			<?php
			$examId = $_GET['examId'];
			$examType = "";
			$getQuestionCount = "SELECT * FROM tbl_exam where id = ".$examId;
			$processQuestionCount = $db->query($getQuestionCount);
			if($processQuestionCount->num_rows > 0)
			{
				$resultQuestionCount = $processQuestionCount->fetch_assoc();
				$totalCount = $resultQuestionCount['itemcount'];
				$mathCount = $resultQuestionCount['mathCount'];
				$engCount = $resultQuestionCount['engCount'];
				if($resultQuestionCount['examtype'] == 0)
				{
					$examType = "Junior High School";
				}
				elseif ($resultQuestionCount['examtype'] == 1)
				{
					$examType = "Senior High School";
				}
				elseif ($resultQuestionCount['examtype'] == 2)
				{
					$examType = "College";
				}

				$currentQuestion = (isset($_POST['current'])) ? $_POST['current'] : 1;
				$questionCategory = '';
				$redirectpage = "setquestions.php?examId=".$examId;
				?>
				<form action="<?php echo $redirectpage?>" method="POST" id="questionFormAdd"></form>
				<input type="hidden" name="current" value="<?php echo ($currentQuestion + 1 )?>" form="questionFormAdd">
				<?php
				if($totalCount >= $currentQuestion)
				{

					if($mathCount >= $currentQuestion)
					{
						$questionCategory = 0;
						?>
						<input type='hidden' name="questionCategory" id="questionCategory" value="0" form="questionFormAdd">
						<div class="row">
							<div class="col-md-1 col-lg-1"></div>
							<div class="col-md-10 col-lg-10">
								<h4>Math Questions <?php echo $currentQuestion.' / '.$totalCount?></h4>
							</div>
							<div class="col-md-1 col-lg-1"></div>
						</div>
						<?php
					}
					else
					{
						$questionCategory = 1;
						?>
						<input type='hidden' name="questionCategory" id="questionCategory" value="1" form="questionFormAdd">
						<div class="row">
							<div class="col-md-1 col-lg-1"></div>
							<div class="col-md-10 col-lg-10">
								<h4>English Questions <?php echo $currentQuestion.' / '.$totalCount?></h4>
							</div>
							<div class="col-md-1 col-lg-1"></div>
						</div>
						<?php
					}
					?>
					<div class="form-group">
						<label>
							Select Question Type
						</label>
						<select name="questionType" id="questionType" form="questionFormAdd">
							<option selected disabled>---SELECT ONE---</option>
							<option value="0">Multiple Choice</option>
							<option value="1">Question & Answer</option>
						</select>
					</div>
					<div class="row multipleDiv" style="display: none;margin-top: -30px; " id="multipleDiv">
						<div class="col-md-1 col-lg-1"></div>
						<div class="col-md-10 col-lg-10">
							<div class="form-group">
								<label>Question</label> 
								<textarea class="form-control" name="question" id="question" form="questionFormAdd"  style="height:100px;border:1px solid gray"></textarea>
							</div>
							<p>Multiple Choices</p>
							<div class="row">
								<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label>Choice A</label>
										<input type="text" name="a" id="a" class="form-control" form="questionFormAdd" >
									</div>
									<div class="form-group">
										<label>Choice B</label>
										<input type="text" name="b" id="b" class="form-control" form="questionFormAdd" >
									</div>
								</div>
								<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
									<div class="form-group">
										<label>Choice C</label>
										<input type="text" name="c" id="c" class="form-control" form="questionFormAdd" >
									</div>
									<div class="form-group">
										<label>Choice D</label>
										<input type="text" name="d" id="d" class="form-control" form="questionFormAdd" >
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
									<div class="form-group">
										<label>Answer</label>
										<input type="text" name="ans" id="ans" class="form-control" form="questionFormAdd" placeholder="Enter only the Letter of Answer"  form="questionFormAdd" >
									</div>
								</div>
							</div>
							<div class="form-group pull-right">
								<input type="submit"  name="submit" id="submit" class="btn btn-success" form="questionFormAdd">
							</div>
						</div>
						<div class="col-md-1 col-lg-1"></div>
					</div>

					<div class="row" style="display: none;" id="blankDiv">
						<div class="col-md-1 col-lg-1"></div>
						<div class="col-md-10 col-lg-10">
							<div class="form-group">
								<label>Question</label> 
								<textarea class="form-control" name="questionBlank" id="questionBlank" form="questionFormAdd"  style="height:100px;border:1px solid gray"></textarea>
							</div>
							<div class="form-group">
								<label>Answer</label> 
								<textarea class="form-control" name="answerBlank" id="answerBlank" form="questionFormAdd"  style="height:100px;border:1px solid gray"></textarea>
							</div>
							<div class="form-group pull-right">
								<input type="submit"  name="submit" id="submit" class="btn btn-success" form="questionFormAdd">
							</div>
						</div>
						<div class="col-md-1 col-lg-1"></div>
					</div>
					<?php
				}
				else
				{
					?><br><br>
					<div class="row">
						<div class="col-md-2 col-lg-2"></div>
						<div class="col-md-8 col-lg-8">
							<center>
								<h1>You've completed the questionare for <?php echo $examType?></h1>
								<img src="../images/check.png" style="width:40%;height:300px;">
							</center>
						</div>
						<div class="col-md-2 col-lg-2"></div>
					</div>
					<?php
					echo 
					"<script>
						window.setTimeout(function(){
					        window.location.href = '../examination/';
					    }, 5000);
					</script>";
				}


				if(isset($_POST['submit']))
				{
					$examTypeId = $examId;
					$questionNumber = ($_POST['current'] -1);
					$questionType = $_POST['questionType'];
					$questionCategory = $_POST['questionCategory'];

					if($questionType == 0)
					{
						$question = mysqli_escape_string($db,$_POST['question']);
						$a = mysqli_escape_string($db,$_POST['a']);
						$b = mysqli_escape_string($db,$_POST['b']);
						$c = mysqli_escape_string($db,$_POST['c']);
						$d = mysqli_escape_string($db,$_POST['d']);
						$ans = mysqli_escape_string($db,$_POST['ans']);
						$insertQuestion = "INSERT INTO tbl_question (examtypeid,questionnumber,question,a,b,c,d,answer,questionCategory,questionType)
											VALUES (".$examTypeId.",".$questionNumber.",'".$question."','".$a."','".$b."','".$c."','".$d."'
											,'".$ans."',".$questionCategory.",0)";
						$processInsert = $db->query($insertQuestion);
					}
					else
					{
						$questionBlank = mysqli_escape_string($db,$_POST['questionBlank']);
						$answerBlank = mysqli_escape_string($db,$_POST['answerBlank']);

						$insertQuestion = "INSERT INTO tbl_question (examtypeid,questionnumber,question,answer,questionCategory,questionType)
											VALUES (".$examTypeId.",".$questionNumber.",'".$questionBlank."','".$answerBlank."',".$questionCategory.",1)";
						$processInsert = $db->query($insertQuestion);
					}
				
				}
			}
				?>
		</div>
	</div>
<?php
include('footer.php');
?>
<script>
	$(document).on('change','#questionType',function(){
         var questionType = $(this).val();
          if(questionType == "0")
          {
              $('.multipleDiv').show();
              $('#blankDiv').hide();
              $('questionBlank').prop('required',false);
              $('answerBlank').prop('required',false);

               $('question').prop('required',true);
              $('a').prop('required',true);
              $('b').prop('required',true);
              $('c').prop('required',true);
              $('d').prop('required',true);
              $('ans').prop('required',true);
          }
          else
          {
              $('#blankDiv').show();
              $('.multipleDiv').hide();

              $('question').prop('required',false);
              $('a').prop('required',false);
              $('b').prop('required',false);
              $('c').prop('required',false);
              $('d').prop('required',false);
              $('ans').prop('required',false);

              $('questionBlank').prop('required',true);
              $('answerBlank').prop('required',true);
          }
      })
</script>