<?php

if($_SESSION['priviledge'] == 'admin')
{
	?><br>
	<!--  style=" overflow-y: scroll;" -->
	<div id="menuContainer" style=" overflow-y: scroll;">
		<h3>Menu</h3>
		<div class="row">
			<div class="col-md-6 col-lg-4 col-xs-12 col-sm-12">
				<a href="schoolyear/" class="btn btn-custom btn-block" style="color: white;text-decoration: none;width: 100%;margin-bottom:5px;"><i class="fa fa-calendar" aria-hidden="true"></i> | School Year</a>
			</div>
			<div class="col-md-6 col-lg-4 col-xs-12 col-sm-12">
				<a href="schools/" class="btn btn-custom btn-block" style="color: white;text-decoration: none;width: 100%;margin-bottom:5px;"><i class="fa fa-home" aria-hidden="true"></i> | Schools</a>
			</div>
			<div class="col-md-6 col-lg-4 col-xs-12 col-sm-12">
				<a href="accounts/" class="btn btn-custom btn-block" style="color: white;text-decoration: none;width: 100%;margin-bottom:5px;"><i class="fa fa-lock" aria-hidden="true"></i> | Accounts</a>
			</div>
			<div class="col-md-6 col-lg-4 col-xs-12 col-sm-12">
				<a href="newapplicants/" class="btn btn-custom btn-block" style="color: white;text-decoration: none;width: 100%;margin-bottom:5px;"><i class="fa fa-users" aria-hidden="true"></i> | Applicants <span class="badge applicantnotif" style="background-color: red;color: white;border-radius: 50%;"></span></a>
			</div>
			<div class="col-md-6 col-lg-4 col-xs-12 col-sm-12">
				<a href="renewalapplication/" class="btn btn-custom btn-block" style="color: white;text-decoration: none;width: 100%;margin-bottom:5px;"><i class="fa fa-users" aria-hidden="true"></i> | Renewal <span class="badge renewalBadge" style="background-color: red;color: white;border-radius: 50%;"></span></a>
			</div>
			<div class="col-md-6 col-lg-4 col-xs-12 col-sm-12">
				<a href="scholars/" class="btn btn-custom btn-block" style="color: white;text-decoration: none;width: 100%;margin-bottom:5px;"><i class="fa fa-users" aria-hidden="true"></i> | Scholars</a>
			</div>
			<div class="col-md-6 col-lg-4 col-xs-12 col-sm-12">
				<a href="examination/" class="btn btn-custom btn-block" style="color: white;text-decoration: none;width: 100%;margin-bottom:5px;"><i class="fa fa-file" aria-hidden="true"></i> | Examination</a>
			</div>
			<div class="col-md-6 col-lg-4 col-xs-12 col-sm-12">
				<a href="scheduling/" class="btn btn-custom btn-block" style="color: white;text-decoration: none;width: 100%;margin-bottom:5px;"><i class="fa fa-calendar" aria-hidden="true"></i> | Scheduling</a>
			</div>
			<div class="col-md-6 col-lg-4 col-xs-12 col-sm-12">
				<a href="messaging/" class="btn btn-custom btn-block" style="color: white;text-decoration: none;width: 100%;margin-bottom:5px;"><i class="fa fa-envelope" aria-hidden="true"></i> | Messaging <span class="badge chatNotif" style="background-color: red;color: white;border-radius: 50%;"></span></a>
			</div>
			<div class="col-md-6 col-lg-4 col-xs-12 col-sm-12">
				<a href="announcement/" class="btn btn-custom  btn-block" style="font-size:15px;color: white;text-decoration: none;width: 100%;margin-bottom:5px;"><i class="fa fa-clipboard" aria-hidden="true"></i> | Announcement</a>
			</div>
			<div class="col-md-6 col-lg-4 col-xs-12 col-sm-12">
				<a href="reports/" class="btn btn-custom  btn-block" style="color: white;text-decoration: none;width: 100%;margin-bottom:5px;"><i class="fa fa-list" aria-hidden="true"></i> | Reports</a>
			</div>
			<div class="col-md-6 col-lg-4 col-xs-12 col-sm-12">
				<a href="analytic/" class="btn btn-custom  btn-block" style="color: white;text-decoration: none;width: 100%;margin-bottom:5px;"><i class="fa fa-area-chart" aria-hidden="true"></i> | Analytics</a>
			</div>
		</div>
	</div>
	<?php
}
else
{
	$studentid = $_SESSION['studentId'];
	$getCurrentSem = "SELECT * FROM tbl_currentyear";
	$process = $db->query($getCurrentSem);
	$result = $process->fetch_assoc();

	$getStudentInfo = "SELECT * FROM tbl_student WHERE id = ".$studentid;
	$processStudentInfo = $db->query($getStudentInfo);
	$resultStudentInfo = $processStudentInfo->fetch_assoc();
	$studenttype = $resultStudentInfo['studenttype'];
	$studentTypeNo = '';
	if($studenttype == 'Junior High School') $studentTypeNo = 0;
	if($studenttype == 'Senior High School') $studentTypeNo = 1;
	if($studenttype == 'College') $studentTypeNo = 2;

	//check req
	?><br><br>
	<div id="menuContainer" style="max-height: 200px;">
		<h3>Menu</h3>
		<div class="row">
			<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
				<a href="studentinfo/" class="btn btn-custom " style="color: white;text-decoration: none;width: 100%;margin-bottom:5px;"><i class="fa fa-user" aria-hidden="true"></i> | Information</a>
			</div>
			<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
				<a href="requirements/" class="btn btn-custom " style="color: white;text-decoration: none;width: 100%;margin-bottom:5px;"><i class="fa fa-file" aria-hidden="true"></i> | Requirements</a>
			</div>
			<?php 
			if($resultStudentInfo['status'] == 4 OR $resultStudentInfo['status'] == 7)
			{
				?>
				<button class="open-button" onclick="openForm()" style="background-color: #0099CC;color: white;font-size:30px;"><i class="fa fa-envelope" aria-hidden="true"></i></button>
				<div class="chat-popup" id="myForm">
				  <form method="POST" id="studentChatForm" class="form-container">
						<input type="hidden" value = "<?php echo date('Y-m-d h:i:s A') ?>" id="dateTime" name="dateTime" form="studentChatForm" >
		             	<input type="hidden"  id="sender" name="sender" form="studentChatForm" value="<?php echo $_SESSION['studentId']?>">
						<input type="hidden"  id="receiver" name="receiver" form="studentChatForm" value="admin">
					    <span>
					    	<h4 style="padding: 10px;background-color: #00C851;color: white;">
					    		Admin
					    		<div class="pull-right">
					    			<a href="#" onclick="closeForm()" style="font-size:20px;color: white">X</a>
					    		</div>
					    	</h4>
					    </span>
					    <div id="convoStudent" style="border:1px solid gainsboro;">
				                  <!-- convo here -->
		                </div>
		                <div class="row" style="">
		                	<div class="col-md-9 col-lg-9 col-xs-6 col-sm-6">
					    		<textarea placeholder="Type message.." name="messageAdmin" id="message" form="studentChatForm" required></textarea>
		                	</div>
		                	<div class="col-md-3 col-lg-3 col-xs-6 col-sm-6">
		                		<button type="submit" name="sendStudent" id="send" class="btn"form="studentChatForm" style="min-height: 50px;background-color: white; "><i class="fa fa-paper-plane" aria-hidden="true" style="color: #00C851;font-size: 25px;"></i></button>
						    	<!-- <input type = "submit" name="sendStudent" value="SEND" id="send" class="btn btn-success"form="studentChatForm"> -->
		                	</div>
		                </div>
				    </form>
				</div>
				<?php
			}

			if($result['status'] == 0)
			{
				if($resultStudentInfo['schoolyear'] != $result['schyear'] OR $resultStudentInfo['semester'] != $result['semester'])
				{
					?>
					<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
						<a href="renewal/" class="btn btn-custom " style="color: white;text-decoration: none;width: 100%;margin-bottom:5px;">Renew Scholar</a>
					</div>
					<?php
				}
			}
			if($resultStudentInfo['status'] == 1)
			{
				$sqlCheckSched = "SELECT * FROM tbl_schedule WHERE studentlevel IN(0,".$studentTypeNo.") AND schyear = '".$result['schyear']."' AND sem = '".$result['semester']."' AND status = 0";
				$processCheck = $db->query($sqlCheckSched);
				if($processCheck->num_rows > 0)
				{
					$resultSched = $processCheck->fetch_assoc();
					$schedDate = $resultSched['schedDate'];
					$schedTime = $resultSched['schedTime'];
					$examTime = date("H:i:s", strtotime($schedTime));
					$timeToday = date("H:i:s");
					$endTimeStamp = strtotime($timeToday)+ 60*60;
					$endTime = date('H:i:s', $endTimeStamp);


					if($schedDate == date('Y-m-d'))
					{
						$checkTake = "SELECT * FROM tbl_account WHERE studentId = ".$resultStudentInfo['id'];
						$processTake = $db->query($checkTake);
						$resultTake = $processTake->fetch_assoc();
						if($resultTake['examstatus'] != 1)
						{
			// 				?>
							<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
								<a href="../examination" class="btn btn-custom " style="color: white;text-decoration: none;width: 100%;margin-bottom:5px;">Examination</a>
			 				</div>
			 				<?php
							  $sqlKey = "SELECT * FROM tbl_apikey";
			                  $processKey = $db->query($sqlKey);
			                  $resultKey = $processKey->fetch_assoc();
			                  $theKey = $resultKey['apiKey'];
			                  //get number 
			                  $sqlNumber = "SELECT contactno FROM tbl_student WHERE id = ".$studentid;
			                  $processNumber = $db->query($sqlNumber);
			                  $resultNumber = $processNumber->fetch_assoc();
			                  $contactNo = $resultNumber['contactno'];

			                  $sqlCheck = "SELECT * FROM tbl_account WHERE studentId = ".$studentid;
			                  $processCheckSms = $db->query($sqlCheck);
			                  $resultCheckSms = $processCheckSms->fetch_assoc();

			                  if($resultCheckSms['todaySmsStatus'] != 1)
			                  {
			                    $update = "UPDATE tbl_account set todaySmsStatus = 1 WHERE studentId = ".$studentid;
			                    $processUpdate = $db->query($update);
			                    if($processUpdate)
			                    {
			                    	$message = "Good Day! Today is your examination day. Godbless to your exam. This message is from EPS Scholarship.";
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
			                  }
			                  
						}
					}
					elseif($schedDate < date('Y-m-d'))
					{
						$update = "UPDATE tbl_account set examstatus = 1 WHERE studentId = ".$resultStudentInfo['id'];
						$processUpdate = $db->query($update);
						if($processUpdate)
						{
							$updateStudent = "UPDATE tbl_student set status = 5 WHERE id = ".$resultStudentInfo['id'];
							$processStudent = $db->query($updateStudent);
							if($processStudent)
							{
								$insertExamLog = "INSERT INTO tbl_examevaluation (studentId,examresult,score,remarks,schoolyear,semester,studenttype)
								VALUES(".$resultStudentInfo['id'].",'FAILED',0,'not qualified','".$result['schyear']."','".$result['semester']."','".$resultStudentInfo['studenttype']."')";
								$processInsertLog = $db->query($insertExamLog);
							}
						}
						echo "You've failed to take the Scholarship Examination";
						$sqlCheckStatus = "SELECT * FROM tbl_account WHERE studentId = ".$resultStudentInfo['id'];
						$processCheckStatus = $db->query($sqlCheckStatus);
						$resultCheckStatus = $processCheckStatus->fetch_assoc();

						if($resultCheckStatus['examstatus'] != 1)
						{
							$sqlKey = "SELECT * FROM tbl_apikey";
			                  $processKey = $db->query($sqlKey);
			                  $resultKey = $processKey->fetch_assoc();
			                  $theKey = $resultKey['apiKey'];
			                  //get number 
			                  $sqlNumber = "SELECT contactno FROM tbl_student WHERE id = ".$studentid;
			                  $processNumber = $db->query($sqlNumber);
			                  $resultNumber = $processNumber->fetch_assoc();
			                  $contactNo = $resultNumber['contactno'];
			 
			                  $message = "Good Day! You've failed to take the Scholarship Examination. You will be avail to apply again next semester. This message is from EPS Scholarship.";
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
					}
				}
				else
				{
					//echo $sqlCheckSched;
				}
				
			}
			?>
		</div>
	</div>
	<?php
}
?>