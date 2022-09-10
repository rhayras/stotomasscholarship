<?php
include('header.php');
$x =0;

$getInfo = "SELECT * FROM tbl_student WHERE id = ".$_SESSION['studentId']."";
$process = $db->query($getInfo);
$result = $process->fetch_assoc();
$studenttype = $result['studenttype'];
$studentTypeNo = '';
if($studenttype == 'Junior High School') $studentTypeNo = 0;
if($studenttype == 'Senior High School') $studentTypeNo = 1;
if($studenttype == 'College') $studentTypeNo = 2;

//get schoolyear and sem

$getSem = "SELECT * FROM `tbl_currentyear`";
$processSem = $db->query($getSem);
if($processSem->num_rows > 0)
{
	$resultSem = $processSem->fetch_assoc();
}
//get school
$getSchool = "SELECT * FROM tbl_school WHERE id = ".$result['school']."";
$processSchool = $db->query($getSchool);
$resultSchool = $processSchool->fetch_assoc();

?>
<style>
	
	#myNav
	{
		background-color: white;
		height:100px;
		padding: 20px;
	}
	body
	{
		background-color:#f5f5f5;
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
		top: 10px;
	}
	h5
	{
		color: #00C851;
	}
	.card {
		background-color: #ffffff;
		border: 1px solid rgba(0, 34, 51, 0.1);
		box-shadow: 2px 4px 10px 0 rgba(0, 34, 51, 0.05), 2px 4px 10px 0 rgba(0, 34, 51, 0.05);
		border-radius: 0.15rem;
	}

	/* Tabs Card */

	.tab-card {
		border:1px solid #eee;
	}

	.tab-card-header {
		background:none;
	}
	/* Default mode */
	.tab-card-header > .nav-tabs {
		border: none;
		margin: 0px;
	}
	.tab-card-header > .nav-tabs > li {
		margin-right: 2px;
	}
	.tab-card-header > .nav-tabs > li > a {
		border: 0;
		border-bottom:2px solid transparent;
		margin-right: 0;
		color: #737373;
		padding: 2px 15px;
	}

	.tab-card-header > .nav-tabs > li > a.show {
		border-bottom:2px solid #00C851;
		color: #00C851;
	}
	.tab-card-header > .nav-tabs > li > a:hover {
		color: #00C851;
		border-bottom:2px solid #00C851;
	}

	.tab-card-header > .tab-content {
		padding-bottom: 0;
	}
</style>
<div class="row" style="padding: 10px;">
	<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12" id="mainContainer">
		<div class="row">
			<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
				<center><?php
				if($result['picture'] != "")
				{
					?>
					<img src='../profilepicture/<?php echo $result['picture']?>' class="img-responsive" style='width: 250px;height: 250px;'>
					<?php
				}
				else
				{
					?>
					<!-- <form action="" method="POST" enctype="multipart/form-data" id="picform">
						<input type="hidden" name="id" value="<?php echo $result['id']?>" form="picform">
						<label>You need to upload a 1x1 formal picture here.</label>
						<span><p>
							<input type="file" name="file" required form="picform">
							<input type="submit" name="upload" value="Upload" class="btn-success btn-sm" form="picform">
						</p></span>
					</form> -->
					<?php
				}
				?><br><br>
				<p style="font-size: 20px;"><?php echo $result['firstname']." ".$result['middlename']." ".$result['surname']?></p>
				<p style="font-size: 15px;">
					<?php echo $resultSchool['schoolname']?><br>
					<?php echo $result['studenttype']?><br>
					<?php echo $result['yearOrgrade']?><br>
					School Year <?php echo $result['schoolyear']?> / <?php echo $result['semester']?><br>
					<?php
					if($result['studenttype'] != 'Junior High School')
					{
						?>
						Course <?php echo $result['course']?><br>
						<?php
					}
					?>
					GWA <b><?php echo $result['gwa']?></b>
					<?php
					$sqlExam = "SELECT * FROM tbl_examevaluation WHERE studentId = ".$result['id'];
					$processExam = $db->query($sqlExam);
					if($processExam->num_rows > 0)
					{
						$resultExam = $processExam->fetch_assoc();
						echo "<br>EPS Examination Score : <b>".$resultExam['score']."</b>
						      <br>Examination Remarks : <b>".$resultExam['examresult']."</b>";
					}
					?>
				</p>
				<a href="editPersonalInfo.php?studentId=<?php echo $result['id']?>" class="btn btn-success btn-sm" style="margin-top:-10px;">Edit Information</a>
				<!-- <button class="btn btn-success btn-sm" style="margin-top:-10px;">Edit Information</button> -->
			</center>
		</div>
		<div class="col-md-8 col-lg-8 col-xs-12 col-sm-12" style="height:450px;overflow-y: scroll">
			<div class="card mt-3 tab-card">
				<div class="card-header tab-card-header">
					<ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
						<li class="nav-item">
							<a class="nav-link" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="One" aria-selected="true">Scholarship Info</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="Two" aria-selected="false">Personal Info</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="three-tab" data-toggle="tab" href="#three" role="tab" aria-controls="Three" aria-selected="false">Requirements</a>
						</li>
					</ul>
				</div>

				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active p-3" id="one" role="tabpanel" aria-labelledby="one-tab">
						<?php
						if($resultSem['status'] == 2) // school year finished
						{
							?>
							<h5 class="card-title">Scholarship was finished for this School Year/ Semester.</h5>
							<p>Kindly wait for the EPS Scholarship to start a new School Year/ Semester.</p>
							<?php
						}
						elseif($resultSem['status'] == 0 ) // application on going
						{

							if($result['schoolyear'] == $resultSem['schyear'] AND $result['semester'] == $resultSem['semester'])
							{
								if($result['status'] != 4 AND $result['status'] != 7) //if not scholars
								{
									if($result['status'] == 0) // new apply
									{
										$check = "SELECT * FROM tbl_schoolrequirements WHERE studentid = ".$result['id']." AND regform != '' AND gradecard != '' AND schoolid != '' AND status = 0  AND schoolyear = '".$resultSem['schyear']."' AND semester = '".$resultSem['semester']."'";
										$processCheck = $db->query($check);
										if($processCheck->num_rows == 0)
										{
											?>
											<h5 class="card-title">Please Submit requirements.</h5>
											<p>You need to submit your requirements to process your application.</p>
											<?php
										}
										else
										{
											?>
											<h5 class="card-title">Your application is on process.</h5>
											<p>Kindly wait for the approval of the EPS Scholarship.</p>
											<?php
										}
									}
									elseif($result['status'] == 1) // for exam
									{
										$account = "SELECT examstatus FROM tbl_account WHERE studentId = ".$result['id'];
										$process = $db->query($account);
										$resultProcess = $process->fetch_assoc();

										if($resultProcess['examstatus'] == 1)
										{
											?>
											<h5 class="card-title">Status : Waiting For Exam Result</h5>
											<small><p>Kindly wait for the evaluation of your examination.</p></small>
											<?php
										}
										else
										{
											$sqlCheckSched = "SELECT * FROM tbl_schedule WHERE studentlevel IN (0,".$studentTypeNo.")  AND schyear = '".$resultSem['schyear']."' AND sem = '".$resultSem['semester']."' AND status = 0";
											$processCheck = $db->query($sqlCheckSched);
											if($processCheck->num_rows > 0)
											{
												$resultSched = $processCheck->fetch_assoc();
												$schedDate = $resultSched['schedDate'];
												$schedTime = $resultSched['schedTime'];

												if($result['examDate'] != "")
												{
													$explodeExam = explode(" ",$result['examDate']);
													?>
													<h5 class="card-title">Status : For Examination</h5>
													<small><p>You need to go to Sto Tomas City Hall for your Examination.</p></small>
													<table class="table table-striped table-bordered">
														<tr>
															<td>Examination Date</td>
															<td><?php echo $explodeExam[0]?></td>
														</tr>
														<tr>
															<td>Examination Time</td>
															<td><?php echo $explodeExam[1]?></td>
														</tr>
													</table>
													<?php
												}
												else
												{
													?>
													<p>Kindly wait for the schedule of your examination.</p>
													<?php
												}
											}
											else
											{
												?>
												<h5 class="card-title">Status : Waiting For Exam Schedule</h5>
											<small><p>Kindly wait for the schedule of your examination.</p></small>
												<?php
											}
										}
									}
									elseif($result['status'] == 2) // for interview
									{
										?>
										<h5 class="card-title">Status : For Interview</h5>
										<small><p>You need to go to Sto Tomas City Hall for your Interview.</p></small>
										<?php
										if($result['interviewDate'] != "")
										{
											$explodeInterview= explode(" ",$result['interviewDate']);
											?>
											<table class="table table-striped table-bordered">
												<tr>
													<td>Interview Date</td>
													<td><?php echo $explodeInterview[0]?></td>
												</tr>
												<tr>
													<td>Interview Time</td>
													<td><?php echo $explodeInterview[1]?></td>
												</tr>
											</table>
											<?php
										}
										else
										{
											?>
											<p>Kindly wait for the schedule of your Interview.</p>
											<?php
										}
									}
									elseif($result['status'] == 6) // for approval
									{
										?>
										<h5 class="card-title">Status : For Approval</h5>
										<small><p>Kindly wait for the approval of your Scholarship Application.</p></small>
										<?php
									}
									elseif($result['status'] == 3) // denied
									{
										?>
										<h5 class="card-title" style="color: red;">Status : Application Denied</h5>
										<p><b>Reason : </b><?php echo $result['declineReason']?></p>
										<small><p>You will be able to reapply for scholarship next semester.</p></small>
										<?php
									}
									elseif($result['status'] == 5) // exam failed
									{
										?>
										<h5 class="card-title" style="color: red;">Status : Application Denied</h5>
										<p><b>Reason : </b>You fail to pass the Examination for Scholarship.</p>
										<small><p>You will be able to reapply for scholarship next semester.</p></small>
										<?php
									}
									elseif($result['status'] == 9) // renewal denied
									{
										?>
										<h5 class="card-title" style="color: red;">Status : Renewal Application Disapproved</h5>
										<p style="color: red;"><b>Reason : </b><?php echo $result['renewalDeclineReason']?></p>
										<small><p>You will be able to reapply for scholarship next semester.</p></small>
										<?php
									}
									elseif($result['status'] == 8) // renewal denied
									{
										?>
										<h5 class="card-title" style="color: orange;">Status : Renewal Application On Process</h5>
										<small><p>Your renewal is now on process. Kindly wait for the evaluation of EPS Scholarship</p></small>
										<?php
									}
								}
								else
								{
									if($result['grantprice'] == "")
									{
										?>
										<h5 class="card-title">Scholarship Information</h5>
										<small><p>Congratulations! You are now a EPS Scholar. You need to submit your newest copy of Registration Form in our Office. This is for EPS Scholarship to know how much will be your scholarship grant. This will also proof that you are enrolled in your school. Thank you!</p></small>
										<?php
									}
									else
									{
									?>
									<h5 class="card-title">Scholarship Information</h5>
									<table class=" table-striped table-bordered" style="table-layout: fixed;width: 100%;font-size: 13px;">
										<tr>
											<td>Scholarship Type</td>
											<td>
												<?php
												if($result['scholarType'] == 0)
												{
													echo "Full Scholarship";
												}else{echo "Assistance Scholarship";}
												?>
											</td>
										</tr>
										<tr>
											<td>Scholarship Grant</td>
											<td>
												<?php
												if($result['grantprice'] != "")
												{
													?>
													&#8369; <?php echo number_format($result['grantprice'],2)?>
													<?php
												}
												?>
											</td>
										</tr>
									</table><br>
									<?php
									}
	
								}
							}
							else
							{
								if($result['status'] == 10) // if renewal
								{
									//checkaccount
									$account = "SELECT * FROM tbl_account WHERE studentId = ".$result['id'];
									$processAccount = $db->query($account);
									$resultAccount = $processAccount->fetch_assoc();

									if($resultAccount['renewstatus'] != 1)
									{
										?>
										<h5 class="card-title">Scholarship Information</h5>
										<small><p>New Schoolyear/Semester was Started by EPS Scholarship.</p></small>
										<?php
									}
									else
									{
										$inc = 0;
										//check requirements
										 $check = "SELECT * FROM tbl_schoolrequirements WHERE studentid = ".$result['id']." AND regform != '' AND status = 0 AND schoolyear = '".$resultSem['schyear']."' AND semester = '".$resultSem['semester']."'";
										$processCheck = $db->query($check);
										if($processCheck->num_rows == 0)
										{
											$inc = 1;
										}
										$check1 = "SELECT * FROM tbl_schoolrequirements WHERE studentid = ".$result['id']." AND gradecard != '' AND status = 0 AND schoolyear = '".$resultSem['schyear']."' AND semester = '".$resultSem['semester']."'";
										$processCheck1 = $db->query($check1);
										if($processCheck1->num_rows  == 0)
										{
											$inc = 1;
										}
										$check2 = "SELECT * FROM tbl_schoolrequirements WHERE studentid = ".$result['id']." AND schoolid != '' AND status = 0 AND schoolyear = '".$resultSem['schyear']."' AND semester = '".$resultSem['semester']."'";
										$processCheck2 = $db->query($check2);
										if($processCheck2->num_rows  == 0)
										{
											$inc = 1;
										}

										if($inc == 1)
										{
											?>
											<h5 class="card-title">Renewal of Scholarship Status</h5>
											<p>You need to submit your requirements before the deadline. </p>
											<?php												
										}
										else
										{
											?>
											<h5 class="card-title">Renewal of Scholarship Status</h5>
											<p>You application is being processed. Kindly wait for the evaluation day. </p>
											<?php
										}
									}
								}
							}
						}
						elseif($resultSem['status'] == 1) // application closed // school year on going
						{
							if($result['schoolyear'] == $resultSem['schyear'] AND $result['semester'] == $resultSem['semester'])
							{
								if($result['status'] != 4 AND $result['status'] != 7)
								{
									if($result['status'] == 10)
									{
										//checkaccount
										$account = "SELECT * FROM tbl_account WHERE studentId = ".$result['id'];
										$processAccount = $db->query($account);
										$resultAccount = $processAccount->fetch_assoc();

										if($resultAccount['renewstatus'] != 1)
										{
											?>
											<h5 class="card-title">Scholarship Information</h5>
											<?php
										}
										else
										{
											$inc = 0;
											//check requirements
											 $check = "SELECT * FROM tbl_schoolrequirements WHERE studentid = ".$result['id']." AND regform != '' AND status = 0 AND schoolyear = '".$resultSem['schyear']."' AND semester = '".$resultSem['semester']."'";
											$processCheck = $db->query($check);
											if($processCheck->num_rows == 0)
											{
												$inc = 1;
											}
											$check1 = "SELECT * FROM tbl_schoolrequirements WHERE studentid = ".$result['id']." AND gradecard != '' AND status = 0 AND schoolyear = '".$resultSem['schyear']."' AND semester = '".$resultSem['semester']."'";
											$processCheck1 = $db->query($check1);
											if($processCheck1->num_rows  == 0)
											{
												$inc = 1;
											}
											$check2 = "SELECT * FROM tbl_schoolrequirements WHERE studentid = ".$result['id']." AND schoolid != '' AND status = 0 AND schoolyear = '".$resultSem['schyear']."' AND semester = '".$resultSem['semester']."'";
											$processCheck2 = $db->query($check2);
											if($processCheck2->num_rows  == 0)
											{
												$inc = 1;
											}

											if($inc == 1)
											{
												?>
												<h5 class="card-title">Renewal of Scholarship Status</h5>
												<p>You need to submit your requirements before the deadline. </p>
												<?php												
											}
											else
											{
												?>
												<h5 class="card-title">Renewal of Scholarship Status</h5>
												<p>You application is being processed. Kindly wait for the evaluation day. </p>
												<?php
											}
										}
									}
								}
								else
								{
									?>
									<h5 class="card-title">Scholarship Information</h5>
									<table class=" table-striped table-bordered" style="table-layout: fixed;width: 100%;font-size: 13px;">
										<tr>
											<td>Scholarship Type</td>
											<td>
												<?php
												if($result['scholarType'] == 0)
												{
													echo "Full Scholarship";
												}else{echo "Assistance Scholarship";}
												?>
											</td>
										</tr>
										<tr>
											<td>Scholarship Grant</td>
											<td>
												<?php
												if($result['grantprice'] != "")
												{
													?>
													&#8369; <?php echo number_format($result['grantprice'],2)?>
													<?php
												}else{?>
													&#8369; <?php echo number_format(0,2);
												}
												?>
											</td>
										</tr>
									</table><br>
									<?php
								}
							}
						}
						?>
						<h5 class="card-title" style="color: #1f1f1f;">Scholarship History</h5> 
						<div class="table-responsive"> 
						<table class="table table-striped table-bordered" style="width: 100%;font-size: 13px;">
							<thead>
								<th>#</th>
								<th>Student Type</th>
								<th>Year/Level</th>
								<th>School Year/Sem</th>
								<th>GWA</th>
								<th>Scholarship Type</th>
								<th>Grant</th>
							</thead>
							<tbody>
								<?php
								$x = 0;
								$scholartype = "";
								$grant = "";
								$getHistory = "SELECT * FROM tbl_scholarhistory WHERE studentId = ".$result['id']." ORDER BY id DESC";
								$processHistory = $db->query($getHistory);
								if($processHistory->num_rows > 0)
								{
									while($resultHistory = $processHistory->fetch_assoc())
									{
										if($resultHistory['scholartype'] == 0)
										{
											$scholartype = "Full Scholarship";
										}else{$scholartype = "Assistance Scholarship";}

										if($resultHistory['grantprice'] != "")
										{
											$grant = " &#8369;".number_format($resultHistory['grantprice'],2);

										}else{
											$grant = " &#8369;".number_format(0,2);
										}
										echo
										"<tr>
										<td>".++$x."</td>
										<td>".$resultHistory['studenttype']."</td>
										<td>".$resultHistory['yearOrgrade']."</td>
										<td>".$resultHistory['schoolyear']."/".$resultHistory['sem']."</td>
										<td>".$resultHistory['gwa']."</td>
										<td>".$scholartype."</td>
										<td>".$grant."</td>
										</tr>";
									}
								}
								else
								{
									echo 
									"<tr >
										<td colspan = '7'><center>No Data Found</center></td>
									</tr>";
								}
								
								?>
							</tbody>
						</table>
					</div>
					</div>
					<!-- TAB 2 -->
					<div class="tab-pane fade p-3" id="two" role="tabpanel" aria-labelledby="two-tab">
						<h5 class="card-title">Personal Information</h5>
						<table class=" table-striped table-bordered" style="table-layout: fixed;width: 100%;font-size: 13px;">
							<tr>
								<td style="padding:5px;">Address</td>
								<td><?php echo $result['address']?></td>
							</tr>
							<tr>
								<td style="padding:5px;">Birth Date</td>
								<td><?php echo $result['bday']?></td>
							</tr>
							<tr>
								<td style="padding:5px;">Age</td>
								<td><?php echo $result['age']?> Years Old</td>
							</tr>
							<tr>
								<td style="padding:5px;">Gender</td>
								<td><?php echo $result['gender']?></td>
							</tr>
							<tr>
								<td style="padding:5px;">Religion</td>
								<td><?php echo $result['religion']?></td>
							</tr>
							<tr>
								<td style="padding:5px;">Contact No</td>
								<td><?php echo $result['contactno']?></td>
							</tr>
							<tr>
								<td style="padding:5px;">Email</td>
								<td><?php echo $result['email']?></td>
							</tr>
							<tr>
								<td style="padding:5px;">Father's Name</td>
								<td><?php echo $result['fathername']?></td>
							</tr>
							<tr>
								<td style="padding:5px;">Father's Age</td>
								<td><?php echo $result['fatherAge']?></td>
							</tr>
							<tr>
								<td style="padding:5px;">Father's Occupation</td>
								<td><?php echo $result['fatherwork']?></td>
							</tr>
							<tr>
								<td style="padding:5px;">Mother's Name</td>
								<td><?php echo $result['mothername']?></td>
							</tr>
							<tr>
								<td style="padding:5px;">Mother's Age</td>
								<td><?php echo $result['motherAge']?></td>
							</tr>
							<tr>
								<td style="padding:5px;">Mother's Occupation</td>
								<td><?php echo $result['motherwork']?></td>
							</tr>
							<tr>
								<td style="padding:5px;">Monthly Gross Income</td>
								<td><?php echo $result['grosspermonth']?></td>
							</tr>	
						</table>
					</div>
					<!-- END TAB 2 -->
					<!-- TAB 3 -->
					<div class="tab-pane fade p-3" id="three" role="tabpanel" aria-labelledby="three-tab">
						<h5 class="card-title">Student Requirements</h5>
						<div class="table-responsive">
							<table class="table-bordered table-striped" style="table-layout: fixed;width: 100%;font-size: 13px;">
								<tr>
							<td>Application Form</td>
							<?php
								$remarks = "";
								$enabled = "";
								$check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$result['id']." AND applicationForm != ''";
								$processCheck = $db->query($check);
								if($processCheck->num_rows > 0)
								{
									$resultCheck = $processCheck->fetch_assoc();
									$remarks = "<a target='_blank' href='../requirements/barangayrequirements/".$resultCheck['applicationForm']."'>View Document</a>";
									$enabled = "disabled";
								}
								else
								{
									$remarks = "No Document Found";
								}
							?>
							<td><?php echo $remarks?></td>
						</tr>
						<tr>
							<td>Birth Certificate</td>
							<?php
								$remarks = "";
								$enabled = "";
								$check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$result['id']." AND bcert != ''";
								$processCheck = $db->query($check);
								if($processCheck->num_rows > 0)
								{
									$resultCheck = $processCheck->fetch_assoc();
									$remarks = "<a target='_blank' href='../requirements/barangayrequirements/".$resultCheck['bcert']."'>View Document</a>";
									$enabled = "disabled";
								}
								else
								{
									$remarks = "No Document Found";
								}
							?>
							<td><?php echo $remarks?></td>
						</tr>
						<tr>
							<td>High School Card/Form 138</td>
							<?php
								$remarks = "";
								$enabled = "";
								$check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$result['id']." AND form138 != ''";
								$processCheck = $db->query($check);
								if($processCheck->num_rows > 0)
								{
									$resultCheck = $processCheck->fetch_assoc();
									$remarks = "<a target='_blank' href='../requirements/barangayrequirements/".$resultCheck['form138']."'>View Document</a>";
									$enabled = "disabled";
								}
								else
								{
									$remarks = "No Document Found";
								}
							?>
							<td><?php echo $remarks?></td>
						</tr>
						<tr>
							<td>Certificate of Good Moral Character</td>
							<?php
								$remarks = "";
								$enabled = "";
								$check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$result['id']." AND goodMoral != ''";
								$processCheck = $db->query($check);
								if($processCheck->num_rows > 0)
								{
									$resultCheck = $processCheck->fetch_assoc();
									$remarks = "<a target='_blank' href='../requirements/barangayrequirements/".$resultCheck['goodMoral']."'>View Document</a>";
									$enabled = "disabled";
								}
								else
								{
									$remarks = "No Document Found";
								}
							?>
							<td><?php echo $remarks?></td>
						</tr>
						<tr>
							<td>Barangay Clearance</td>
							<?php
								$remarks = "";
								$enabled = "";
								$check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$result['id']." AND brgyclearance != ''";
								$processCheck = $db->query($check);
								if($processCheck->num_rows > 0)
								{
									$resultCheck = $processCheck->fetch_assoc();
									$remarks = "<a target='_blank' href='../requirements/barangayrequirements/".$resultCheck['brgyclearance']."'>View Document</a>";
									$enabled = "disabled";
								}
								else
								{
									$remarks = "No Document Found";
								}
							?>
							<td><?php echo $remarks?></td>
						</tr>
						<tr>
							<td>Vicinity Map/House Sketch</td>
							<?php
								$remarks = "";
								$enabled = "";
								$check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$result['id']." AND houseSketch != ''";
								$processCheck = $db->query($check);
								if($processCheck->num_rows > 0)
								{
									$resultCheck = $processCheck->fetch_assoc();
									$remarks = "<a target='_blank' href='../requirements/barangayrequirements/".$resultCheck['houseSketch']."'>View Document</a>";
									$enabled = "disabled";
								}
								else
								{
									$remarks = "No Document Found";
								}
							?>
							<td><?php echo $remarks?></td>
						</tr>
						<tr>
							<td>Parents Voter's ID</td>
							<?php
								$remarks = "";
								$enabled = "";
								$check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$result['id']." AND votersId != ''";
								$processCheck = $db->query($check);
								if($processCheck->num_rows > 0)
								{
									$resultCheck = $processCheck->fetch_assoc();
									$remarks = "<a target='_blank' href='../requirements/barangayrequirements/".$resultCheck['votersId']."'>View Document</a>";
									$enabled = "disabled";
								}
								else
								{
									$remarks = "No Document Found";
								}
							?>
							<td><?php echo $remarks?></td>
						</tr>
						<tr>
							<td>Certificate of Employement/Certificate of Unemployment (If parent is employed or unemployed)</td>
							<?php
								$remarks = "";
								$enabled = "";
								$check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$result['id']." AND parentCert != ''";
								$processCheck = $db->query($check);
								if($processCheck->num_rows > 0)
								{
									$resultCheck = $processCheck->fetch_assoc();
									$remarks = "<a target='_blank' href='../requirements/barangayrequirements/".$resultCheck['parentCert']."'>View Document</a>";
									$enabled = "disabled";
								}
								else
								{
									$remarks = "No Document Found";
								}
							?>
							<td><?php echo $remarks?></td>
						</tr>
							<tr>
							<td>Previous School Registration Form</td>
							<?php
							$remarks = "";
							$enabled = "";
							$check = "SELECT * FROM tbl_schoolrequirements WHERE studentid = ".$result['id']." AND regform != '' AND status = 0 AND schoolyear = '".$resultSem['schyear']."' AND semester = '".$resultSem['semester']."'";
							$processCheck = $db->query($check);
							if($processCheck->num_rows > 0)
							{
								$resultCheck = $processCheck->fetch_assoc();
								$remarks = "<a target='_blank' href='../requirements/schoolrequirements/".$resultCheck['regform']."'>View Document</a>";
									$enabled = "disabled";
							}
							else
							{
								$remarks = "No Document Found";
							}
							?>
							<td><?php echo $remarks?></td>
						</tr>
						<tr>
							<td>Previous Grade Card</td>
							<?php
							$remarks = "";
							$enabled = "";
							$check = "SELECT * FROM tbl_schoolrequirements WHERE studentid = ".$result['id']." AND gradecard != '' AND status = 0 AND schoolyear = '".$resultSem['schyear']."' AND semester = '".$resultSem['semester']."'";
							$processCheck = $db->query($check);
							if($processCheck->num_rows > 0)
							{
								$resultCheck = $processCheck->fetch_assoc();
								$remarks = "<a target='_blank' href='../requirements/schoolrequirements/".$resultCheck['gradecard']."'>View Document</a>";
									$enabled = "disabled";
							}
							else
							{
								$remarks = "No Document Found";
							}
							?>
							<td><?php echo $remarks?></td>
						</tr>
						<tr>
							<td>School ID</td>
							<?php
							$remarks = "";
							$enabled = "";
							$check = "SELECT * FROM tbl_schoolrequirements WHERE studentid = ".$result['id']." AND schoolid != '' AND status = 0 AND schoolyear = '".$resultSem['schyear']."' AND semester = '".$resultSem['semester']."'";
							$processCheck = $db->query($check);
							if($processCheck->num_rows > 0)
							{
								$resultCheck = $processCheck->fetch_assoc();
								$remarks = "<a target='_blank' href='../requirements/schoolrequirements/".$resultCheck['schoolid']."'>View Document</a>";
									$enabled = "disabled";
							}
							else
							{
								$remarks = "No Document Found";
							}
							?>
							<td><?php echo $remarks?></td>
						</tr>
							</table>
						</div>             
					</div>
					<!-- END TAB 3 -->
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<?php
include('footer.php');
?>
