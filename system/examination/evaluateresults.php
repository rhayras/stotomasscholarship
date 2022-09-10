<?php
include('../../db/db.php');
include('header.php');

$examId = $_GET['id'];

$examInfo = "SELECT * FROM tbl_exam WHERE id = ".$examId;
$processExamInfo = $db->query($examInfo);
$resultExamInfo = $processExamInfo->fetch_assoc();
$totalItemCount = $resultExamInfo['itemcount'];
$passingScore = $resultExamInfo['passingscore'];
$examType = $resultExamInfo['examtype'];
$studentType = "";
if($examType == 0)
{
	$studentType = "Junior High School";
}
elseif($examType == 1)
{
	$studentType = "Senior High School";
}
else
{
	$studentType = "College";
}

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
    	height: 520px;
    }
        #mainContainer
    {
    	background-color:white;
    	padding: 10px;
    	padding-left: 20px;
    	padding-right: 10px;
    	width: 100%;
    	height: 520px;
    }
    #maintable tbody {
    display:block;
    height:350px;
    overflow:auto;
	}
	#maintable thead, tbody tr {
	    display:table;
	    width:100%;
	    table-layout: fixed;
	}
</style>

	<div class="row" style="padding: 10px;">
		<div class="col-md-12 col-lg-12" id="mainContainer">
			<span><h5>Assessment/Evaluation Result
				<div class="pull-right">
					<form method="POST" id="evaluateForm"></form>
					<input type="submit" name="saveEvaluation" id="saveEvaluation" class="btn btn-success" value="Submit Evaluation" style="margin-bottom: 10px;" form="evaluateForm">
				</div></h5>
			</span>
			<div class="table-responsive">
				<table class="table table-bordered" id="maintable">
					<thead>
						<th>Name Of Student</th>
						<th>Address</th>
						<th>Grade / Year & Course</th>
						<th>Grade/GWA</th>
						<th>Exam Result</th>
						<th>Exam Score</th>
						<th>Remakrs</th>
					</thead>
					<tbody style="font-size: 12px;">
						<?php

						$examResult = "";
						$remarks = "";
						$studentTakesExam = array();
						$getStudent = "SELECT * FROM tbl_student WHERE studenttype = '".$studentType."' AND status = 1";
						$processStudent = $db->query($getStudent);
						if($processStudent->num_rows > 0)
						{
							while($resultStudent = $processStudent->fetch_assoc())
							{	
								
								$checkIfExam = "SELECT examstatus FROM tbl_account WHERE studentId = ".$resultStudent['id'];
								$processCheck = $db->query($checkIfExam);
								$resultCheck = $processCheck->fetch_assoc();
								if($resultCheck['examstatus'] == 1)
								{
									$studentTakesExam[] = $resultStudent['id'];
								}
							}
						}
						else
						{
							echo "<tr><td colspan='6'><center>No Data Found</center></td></tr>";
						}
						foreach($studentTakesExam as $key)
						{
							//get answers
								$score = 0;
								$getAnswer = "SELECT * FROM tbl_answer WHERE studentNumber = ".$key." AND status = 0 ";
								$processAnswer = $db->query($getAnswer);
								if($processAnswer->num_rows > 0)
								{
									while($resultAnswer = $processAnswer->fetch_assoc())
									{
										$questionId = $resultAnswer['question'];
										$studentAnswer = $resultAnswer['answer'];
										//getQuestion
										$getQuestion = "SELECT * FROM tbl_question WHERE id = ".$questionId;
										$processQuestion = $db->query($getQuestion);
										$resultQuestion = $processQuestion->fetch_assoc();
										$correctAnswer = $resultQuestion['answer'];

									//	$ifEqual = strcmp($studentAnswer,$correctAnswer);
										if(strtolower($studentAnswer) === strtolower($correctAnswer))
										{
											$score = $score+1;

										}
									}
								}
								else
								{
									$score = 0;
								}
							if($score >= $passingScore )
							{
								$examResult = "PASSED";
								$remarks = "qualified";
							}else {$examResult = "FAILED";$remarks = "not qualified"; }
							$getStudent = "SELECT * FROM tbl_student WHERE id = ".$key;
							$processStudentInfo = $db->query($getStudent);
							$resultStudentInfo = $processStudentInfo->fetch_assoc();
							echo
							"<tr>
								<td>".$resultStudentInfo['firstname']." ".$resultStudentInfo['surname']."</td>
								<td>".$resultStudentInfo['address']."</td>
								<td>".$resultStudentInfo['yearOrgrade']."  ".$resultStudentInfo['course']."</td>
								<td>".$resultStudentInfo['gwa']."</td>
								<td>".$examResult."</td>
								<td>".$score." / ".$totalItemCount."</td>
								<td>".$remarks."</td>
							</tr>";
						}

						
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

<?php
include('footer.php');

if(isset($_POST['saveEvaluation']))
{
	$examResult = "";
	$remarks = "";
	$studentTakesExam = array();
	$getStudent = "SELECT * FROM tbl_student WHERE studenttype = '".$studentType."' AND status = 1";
	$processStudent = $db->query($getStudent);
	if($processStudent->num_rows > 0)
	{
		while($resultStudent = $processStudent->fetch_assoc())
		{	
			$checkIfExam = "SELECT examstatus FROM tbl_account WHERE studentId = ".$resultStudent['id'];
			$processCheck = $db->query($checkIfExam);
			$resultCheck = $processCheck->fetch_assoc();
			if($resultCheck['examstatus'] == 1)
			{
				$studentTakesExam[] = $resultStudent['id'];
			}
		}
	}
	foreach($studentTakesExam as $key)
	{
		//get answers
			$score = 0;
			$getAnswer = "SELECT * FROM tbl_answer WHERE studentNumber = ".$key." AND status = 0 ";
			$processAnswer = $db->query($getAnswer);
			if($processAnswer->num_rows > 0)
			{
				while($resultAnswer = $processAnswer->fetch_assoc())
				{
					$questionId = $resultAnswer['question'];
					$studentAnswer = $resultAnswer['answer'];
					//update to checked 
					$update = "UPDATE tbl_answer set status = 1 WHERE studentNumber = ".$key." AND question = ".$questionId;
					$processUpdate = $db->query($update);
				
					//getQuestion
					$getQuestion = "SELECT * FROM tbl_question WHERE id = ".$questionId;
					$processQuestion = $db->query($getQuestion);
					$resultQuestion = $processQuestion->fetch_assoc();
					$correctAnswer = $resultQuestion['answer'];

				//	$ifEqual = strcmp($studentAnswer,$correctAnswer);
					if(strtolower($studentAnswer) === strtolower($correctAnswer))
					{
						$score = $score+1;

					}
				}
			}
		if($score >= $passingScore )
		{
			$examResult = "PASSED";
			$remarks = "qualified";
		}else {$examResult = "FAILED";$remarks = "not qualified"; }
		$getStudent = "SELECT * FROM tbl_student WHERE id = ".$key;
		$processStudentInfo = $db->query($getStudent);
		$resultStudentInfo = $processStudentInfo->fetch_assoc();

		$getCurrent = "SELECT * FROM tbl_currentyear";
		$processCurrent = $db->query($getCurrent);
		$resultCurrent = $processCurrent->fetch_assoc();
		$schoolyear = $resultCurrent['schyear'];
		$sem = $resultCurrent['semester'];
		//insert evaluation
		$insert = "INSERT INTO tbl_examevaluation (studentId,examresult,score,remarks,schoolyear,semester,studenttype)
					VALUES (".$key.",'".$examResult."','".$score."','".$remarks."','".$schoolyear."','".$sem."','".$resultStudentInfo['studenttype']."')";
		$processInsert = $db->query($insert);
		if($processInsert)
		{
			if($examResult != "FAILED")
			{
				$updateStatus = "UPDATE tbl_student set status = 2 WHERE id =".$key;
				$processStatus = $db->query($updateStatus);

		        $sqlKey = "SELECT * FROM tbl_apikey";
		        $processKey = $db->query($sqlKey);
		        $resultKey = $processKey->fetch_assoc();
		        $theKey = $resultKey['apiKey'];
		        //get number 
		        $sqlNumber = "SELECT contactno FROM tbl_student WHERE id = ".$key;
		        $processNumber = $db->query($sqlNumber);
		        $resultNumber = $processNumber->fetch_assoc();
		        $contactNo = $resultNumber['contactno'];

		        $message = "Good Day! Congratulations! You've passed the examination. Kindly wait for the schedule of Interview. This message is from EPS Scholarship.";
		          $ch = curl_init();
		          $parameters = array(
		              'apikey' => $theKey, 
		              'number' => $contactNo,
		              'message' => $message,
		              'sendername' => 'SEMAPHORE'
		          );
		          curl_setopt( $ch, CURLOPT_URL,'http://api.semaphore.co/api/v4/messages' );
		          curl_setopt( $ch, CURLOPT_POST, 1 );
		          curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );
		          curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		          $output = curl_exec( $ch );
		          curl_close ($ch);

			}
			else
			{
				$updateStatus = "UPDATE tbl_student set status = 5 WHERE id =".$key;
				$processStatus = $db->query($updateStatus);

						        $sqlKey = "SELECT * FROM tbl_apikey";
		        $processKey = $db->query($sqlKey);
		        $resultKey = $processKey->fetch_assoc();
		        $theKey = $resultKey['apiKey'];
		        //get number 
		        $sqlNumber = "SELECT contactno FROM tbl_student WHERE id = ".$key;
		        $processNumber = $db->query($sqlNumber);
		        $resultNumber = $processNumber->fetch_assoc();
		        $contactNo = $resultNumber['contactno'];

		        $message = "Good Day! You've failed to passed the examination. You can reapply for scholarship the next semester. This message is from EPS Scholarship.";
		          $ch = curl_init();
		          $parameters = array(
		              'apikey' => $theKey, 
		              'number' => $contactNo,
		              'message' => $message,
		              'sendername' => 'SEMAPHORE'
		          );
		          curl_setopt( $ch, CURLOPT_URL,'http://api.semaphore.co/api/v4/messages' );
		          curl_setopt( $ch, CURLOPT_POST, 1 );
		          curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );
		          curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		          $output = curl_exec( $ch );
		          curl_close ($ch);
			}
			
	  		?>
		    <script>
		      swal({
		            title: "Success",
		            text: "Evaluation Submitted",
		            type: "success",
		            showCancelButton: false,
		            confirmButtonClass: "btn-success",
		            confirmButtonText: "Okay"
		          },
		          function(isConfirm) {
		            if (isConfirm) {
		              window.location.replace("../examination/");
		            } 
		          });
		    </script>
		  <?php 
		}
	}

}
?>