		//checking
		$score = 1;
		$getQuestionAnswer = "SELECT * from tbl_question where examtypeid =".$examId;
		$processQuestionAnswer = $db->query($getQuestionAnswer);
		if($processQuestionAnswer->num_rows > 0)
		{
			while($resultQuestionAnswer = $processQuestionAnswer->fetch_assoc())
			{
				$questionId = $resultQuestionAnswer['id'];
				$questionAnswer = $resultQuestionAnswer['answer'];
				$getStudentAnswer = "SELECT * FROM tbl_answer where studentNumber =  1 AND question = ".$questionId."";
				$processStudentAnswer = $db->query($getStudentAnswer);
				if($processStudentAnswer->num_rows > 0)
				{
					$resultStudentAnswer = $processStudentAnswer->fetch_assoc();
					$studentAnswer = $resultStudentAnswer['answer'];
				}

					$ifEqual = strcmp($questionAnswer,$studentAnswer);
					if($ifEqual == 0)
					{
						$score = $score+1;
					}
			}
		}