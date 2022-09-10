<?php
include('../../db/db.php');
include('header.php');

//check the current sem and schyear
$schyear = "";
$sem = "";
$getCurrent = "SELECT * FROM tbl_currentyear";
$processCurrent = $db->query($getCurrent);
if($processCurrent->num_rows > 0)
{
	$resultCurrent = $processCurrent->fetch_assoc();
	$schyear = $resultCurrent['schyear'];
	$sem = $resultCurrent['semester'];
}

//get applicants info
$applicantIdArray = array();
$getApplicant = "SELECT * FROM tbl_student WHERE id = ".$_GET['id']."";
$processApplicant = $db->query($getApplicant);
$resultApplicant = $processApplicant->fetch_assoc();

//get school
//get school
$getSchool = "SELECT * FROM tbl_school WHERE id = ".$resultApplicant['school']."";
$processSchool = $db->query($getSchool);
$resultSchool = $processSchool->fetch_assoc();
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
    .approved
    {
    	color: #00C851;
    }
    .declined
    {
    	color:red;
    }
</style>

 <div class="modal fade bd-example-modal-lg" id="scoreModal">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Student's Examination Score</h5>
                  <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
              </div>
              <div class="modal-body">
              	<small>Note : Press TAB Button after entering the score, to view Remarks</small>
                  <form action="" method="POST" id="scoreForm">
                    <div class="form-group">
                    	<input type="hidden" name="studentid" form="scoreForm" id="student" value="<?php echo $resultApplicant['id']?>">
                    	<label>Enter Student's Examination Score</label>
                      	<input type="number" name="score" id="scoreExam" form="scoreForm" class="form-control" required  style="text-align: center">
                      	<p id="examResultP"> </p>
                    </div>
                    <center>
                    	<div class="form-group">
	                      <input type="submit" value="Submit Score" name="submitScore" class="btn btn-success" form="scoreForm">
	                    </div>
                    </center>
                  </form>
              </div>
              <div class="modal-footer">
              </div>
          </div>
      </div>
  </div>

 <div class="modal fade bd-example-modal-lg" id="approvemodal">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Enter Student Grade GWA</h5>
                  <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
              </div>
              <div class="modal-body">
                  <form action="" method="POST" id="gradeform">
                    <div class="form-group">
                    	<input type="hidden" name="studentid" form="gradeform" id="student" value="<?php echo $resultApplicant['id']?>">
                      <input type="text" name="gwa" id="gwa" form="gradeform" class="form-control" required placeholder="Enter GWA of student" style="text-align: center">
                    </div>
                    <div class="pull-right">
                    	<div class="form-group">
	                      <input type="submit" value="Approve" name="submitgwa" class="btn btn-success" form="gradeform">
	                    </div>
                    </div>
                  </form>
              </div>
              <div class="modal-footer">
              </div>
          </div>
      </div>
  </div>
  <!--DECLINE REASON -->
  <div class="modal fade bd-example-modal-lg" id="declinemodal">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Decline Reason</h5>
                  <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
              </div>
              <div class="modal-body">
                  <p><small>Enter the reason in declining this application.</small></p>
                  <form action="" method="POST" id="reasonform">
                    <div class="form-group">
                    	<input type="hidden" name="studentid" form="reasonform" id="student" value="<?php echo $resultApplicant['id']?>">
                      <textarea name="declinereason" id="declinereason" class="form-control" form="reasonform"></textarea>
                    </div>
                    <div class="pull-right">
                    	<div class="form-group">
	                      <input type="submit" value="Decline" name="submitreason" class="btn btn-danger" form="reasonform">
	                    </div>
                    </div>
                  </form>
              </div>
              <div class="modal-footer">
              </div>
          </div>
      </div>
  </div>
  <div class="modal fade bd-example-modal-lg" id="requirementsModal">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Student Requirements</h5>
                  <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
              </div>
              <div class="modal-body">
					<div class="row">
						<div class="col-md-1 col-lg-1"></div>
						<div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
							Requirements
							<div class="table-responsive">
								<table class="table-bordered table-striped" style="table-layout: fixed;width: 100%;font-size: 13px;">
						<tr>
							<td>Application Form</td>
							<?php
								$remarks = "";
								$enabled = "";
								$check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$resultApplicant['id']." AND applicationForm != ''";
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
								$check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$resultApplicant['id']." AND bcert != ''";
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
								$check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$resultApplicant['id']." AND form138 != ''";
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
								$check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$resultApplicant['id']." AND goodMoral != ''";
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
								$check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$resultApplicant['id']." AND brgyclearance != ''";
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
								$check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$resultApplicant['id']." AND houseSketch != ''";
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
								$check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$resultApplicant['id']." AND votersId != ''";
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
								$check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$resultApplicant['id']." AND parentCert != ''";
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
							$check = "SELECT * FROM tbl_schoolrequirements WHERE studentid = ".$resultApplicant['id']." AND regform != '' AND status = 0 AND schoolyear = '".$schyear."' AND semester = '".$sem."'";
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
							$check = "SELECT * FROM tbl_schoolrequirements WHERE studentid = ".$resultApplicant['id']." AND gradecard != '' AND status = 0 AND schoolyear = '".$schyear."' AND semester = '".$sem."'";
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
							$check = "SELECT * FROM tbl_schoolrequirements WHERE studentid = ".$resultApplicant['id']." AND schoolid != '' AND status = 0 AND schoolyear = '".$schyear."' AND semester = '".$sem."'";
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
						<div class="col-md-1 col-lg-1"></div>
					</div>
	              </div>
              <div class="modal-footer">
              </div>
          </div>
      </div>
  </div>
    <div class="modal fade bd-example-modal-lg" id="approvalModal">
      <div class="modal-dialog modal-md">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Approval Form</h5>
                  <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
              </div>
              <div class="modal-body">
					<div class="row">
						<div class="col-md-1 col-lg-1"></div>
						<div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
							<form method="POST" id="approvalForm"></form>
							<input type="hidden" name="studentId" value="<?php echo $resultApplicant['id']?>" form="approvalForm">
							<div class="form-group">
								<label>What type of scholarship to be granted?</label><br>
								<input type="radio" name="scholarshiptype" id="fullradio" form="approvalForm" value="0">
								<label for="fullradio">Full</label>&nbsp;&nbsp;&nbsp;
								<input type="radio" name="scholarshiptype" id="assistanceradio" form="approvalForm" value="1">
								<label for="assistanceradio">Assistance</label>
							</div>
							<div class="form-group" id="grantDiv">
								<label>Amount to be granted</label>
								<input type="text" name="amount" id="amount" class="form-control" form="approvalForm">
							</div>
							<div class="form-group pull-right">
								<input type="submit" name="approveApplication" id="approveApplication" class="btn btn-success" form="approvalForm">
							</div>
						</div>
						<div class="col-md-1 col-lg-1"></div>
					</div>
	              </div>
              <div class="modal-footer">
              </div>
          </div>
      </div>
  </div>
<div class="row" style="padding: 10px;">
	<div class="col-md-12 col-lg-12" id="mainContainer">
		<div class="row" style="margin-bottom:-25px;">
			<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
				<center>
					<img src='../profilepicture/<?php echo $resultApplicant['picture']?>' class="img-responsive" style='width: 200px;height: 200px;'>
					<h3 style="color:gray;"><?php echo $resultApplicant['surname'].", ".$resultApplicant['firstname']?></h3>
					<p style="font-size: 15px;">
							<?php echo $resultSchool['schoolname']?><br>
							<?php echo $resultApplicant['studenttype']?><br>
							<?php echo $resultApplicant['yearOrgrade']?><br>
							School Year <?php echo $schyear?> / <?php echo $sem?><br>
							GWA <b><?php echo $resultApplicant['gwa']?></b>
							<?php
							$sqlExam = "SELECT * FROM tbl_examevaluation WHERE studentId = ".$resultApplicant['id'];
							$processExam = $db->query($sqlExam);
							if($processExam->num_rows > 0)
							{
								$resultExam = $processExam->fetch_assoc();
								echo "<br>EPS Examination Score : <b>".$resultExam['score']."</b>
								      <br>Examination Remarks : <b>".$resultExam['examresult']."</b>";
							}
							?>
					</p>
					<?php
					if($resultApplicant['status'] == 0)
					{
						?>
							<button class="btn btn-primary" data-toggle="modal" data-target="#approvemodal">Approve</button>
							<button class="btn btn-danger" data-toggle="modal" data-target="#declinemodal">Decline</button>
						<?php
					}
					if($resultApplicant['status'] == 1)
					{
						$examDateTime = $resultApplicant['examDate'];
						$explodeExam = explode(" ",$examDateTime);
						$examDate = $explodeExam[0];
						$examTime = $explodeExam[1];

						if($examDate <= date('Y-m-d'))
						{
							?>
							<button class="btn btn-primary" data-id = "<?php echo $resultApplicant['id'] ?>" data-toggle="modal" data-target="#scoreModal">Input Exam Result</button>
							<?php
						}
					}
					?>
				<!-- <button class="btn btn-success" data-toggle="modal" data-target="#requirementsModal">Student Requirements</button> -->
				<?php
					if($resultApplicant['status'] == 6)
					{
						?><br>
						<button class="btn btn-success" data-toggle="modal" data-target="#approvalModal" style="margin-top: 10px;margin-bottom: 10px;">Approve Application</button>
						<?php
					}
				?>
				</center>
			</div>
			<div class="col-md-8 col-lg-8 col-xs-12 col-sm-12"  style="height:450px;overflow-y: scroll">
				<div class="row">
					<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12" style="background-color: #a5d6a7;">
						<center><h5>Application Information</h5></center>
<?php
								$for = "";
								if($resultApplicant['status'] == 0)
								{
									echo "Status : Pending";
								}
								elseif ($resultApplicant['status'] == 1)
								{
									//check
									$sql = "SELECT examstatus FROM tbl_account WHERE studentId =".$resultApplicant['id'];
									$processSql = $db->query($sql);
									$resultSql = $processSql->fetch_assoc();

									if($resultSql['examstatus'] != 1)
									{
										echo "Status : For Examination";
									}else{echo "Status : Waiting For Exam Result";}
									$for = "Examination";
								}
								elseif ($resultApplicant['status'] == 2)
								{
									echo "Status : For Interview";
									$for = "Interview";
								}
								elseif ($resultApplicant['status'] == 3)
								{
									echo "Status : Decline";
								}
								elseif ($resultApplicant['status'] == 6)
								{
									echo "Status : For Approval";
									$for = "Orientation";
								}
								elseif ($resultApplicant['status'] == 5)
								{
									echo "Status : Exam Failed";
								}
								elseif ($resultApplicant['status'] == 4)
								{
									echo "Status : EPS Scholar ";
								}

								$studentlevel = "";
								if($resultApplicant['studenttype'] == 'Senior High School')
								{
									$studentlevel = 1;
								}
								else
								{
									$studentlevel = 2;
								}
								if($resultApplicant['status'] != 6)
								{
									//get sched
								$select = "SELECT * FROM tbl_schedule where schyear = '".$schyear."' AND sem = '".$sem."' AND status = 0 AND forWhat LIKE '".$for."' AND studentlevel IN ('0','".$studentlevel."') ";
									$processSelect = $db->query($select);
									if($processSelect->num_rows > 0)
									{
										$resultSelect = $processSelect->fetch_assoc();
										$date = $resultSelect['schedDate'];
										$time = $resultSelect['schedTime'];
										?>
										<p style="font-size:25px;margin-bottom:-1px;"><?php echo $resultSelect['forWhat']?> Schedule</p>
										<table class="table table-bordered" style="background-color: white;table-layout: fixed">
											<tr>
												<td><?php echo $resultSelect['forWhat']?> Date</td><td><?php echo $date?></td>
											</tr>
											<tr>
												<td><?php echo $resultSelect['forWhat']?> Time</td><td><?php echo $time?></td>
											</tr>
										</table>
										<?php
									}
									else
									{
										echo "<br>No Schedule Set";
									}
								}
							?>
					</div>
				</div><br>
				Personal Information
				<table class=" table-striped table-bordered" style="table-layout: fixed;width: 100%;font-size: 13px;">
					<tr>
						<td style="padding:5px;">Address</td>
						<td><?php echo $resultApplicant['address']?></td>
					</tr>
					<tr>
						<td style="padding:5px;">Birth Date</td>
						<td><?php echo $resultApplicant['bday']?></td>
					</tr>
					<tr>
						<td style="padding:5px;">Age</td>
						<td><?php echo $resultApplicant['age']?> Years Old</td>
					</tr>
					<tr>
						<td style="padding:5px;">Gender</td>
						<td><?php echo $resultApplicant['gender']?></td>
					</tr>
					<tr>
						<td style="padding:5px;">Religion</td>
						<td><?php echo $resultApplicant['religion']?></td>
					</tr>
					<tr>
						<td style="padding:5px;">Contact No</td>
						<td><?php echo $resultApplicant['contactno']?></td>
					</tr>
					<tr>
						<td style="padding:5px;">Email</td>
						<td><?php echo $resultApplicant['email']?></td>
					</tr>
					<tr>
						<td style="padding:5px;">Father's Name</td>
						<td><?php echo $resultApplicant['fathername']?></td>
					</tr>
					<tr>
						<td style="padding:5px;">Father's Age</td>
						<td><?php echo $resultApplicant['fatherAge']?></td>
					</tr>
					<tr>
						<td style="padding:5px;">Father's Occupation</td>
						<td><?php echo $resultApplicant['fatherwork']?></td>
					</tr>
					<tr>
						<td style="padding:5px;">Mother's Name</td>
						<td><?php echo $resultApplicant['mothername']?></td>
					</tr>
					<tr>
						<td style="padding:5px;">Mother's Age</td>
						<td><?php echo $resultApplicant['motherAge']?></td>
					</tr>
					<tr>
						<td style="padding:5px;">Mother's Occupation</td>
						<td><?php echo $resultApplicant['motherwork']?></td>
					</tr>
					<tr>
						<td style="padding:5px;">Monthly Gross Income</td>
						<td><?php echo $resultApplicant['grosspermonth']?></td>
					</tr>	
				</table>
				<br>
			</div>
		</div>
		<br><br><br>
		<div class="row">
			<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
				<h4>Review Applicant's Requirements</h4><br>
				<div class="table-responsive">
					<table class="table table-bordered table-hovered">
						<thead>
							<th>#</th>
							<th>Requirements</th>
							<th>Action</th>
						</thead>
						<tbody>
							<?php
							$x=0;
							$reqName = "";
							$status = "";
							$sql = "SELECT * FROM tbl_reqstatus WHERE studentId = ".$_GET['id'];
							$process = $db->query($sql);
							if($process->num_rows > 0)
							{
								while($result = $process->fetch_assoc())
								{
									if($result['requirements'] == 'applicationForm') $reqName = "Application Form";
									if($result['requirements'] == 'bcert') $reqName = "Birth Certificate";
									if($result['requirements'] == 'form138') $reqName = "Form 138";
									if($result['requirements'] == 'goodMoral') $reqName = "Good Moral";
									if($result['requirements'] == 'brgyclearance') $reqName = "Barangay Clearance";
									if($result['requirements'] == 'houseSketch') $reqName = "House Sketch";
									if($result['requirements'] == 'votersId') $reqName = "Parent's Voter's ID";
									if($result['requirements'] == 'parentCert') $reqName = "Certificate of Employement/Unemployment of Parent";
									if($result['requirements'] == 'regform') $reqName = "Previous Registration Form";
									if($result['requirements'] == 'gradecard') $reqName = "Previous Grade Card";
									if($result['requirements'] == 'schoolid') $reqName = "School Id";
									$color= '';
									if($result['status'] == 0) $color = "(For Approval)";
									if($result['status'] == 1) $color = "(Approved)";
									if($result['status'] == 2) $color = "(Declined)";

									$schoolReqArray = array('regform','gradecard','schoolid');
									if(!in_array($result['requirements'], $schoolReqArray))
									{
										$getFile = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$_GET['id'];
										$processFile = $db->query($getFile);
										$resultFile = $processFile->fetch_assoc();

										$Attachment = "<a href='../requirements/barangayrequirements/".$resultFile[$result['requirements']]."' target='_blank' class='btn btn-primary btn-sm'><i class='fa fa-eye'></i></a>";
									}
									else
									{
										$getFile = "SELECT * FROM tbl_schoolrequirements WHERE studentid = ".$_GET['id'];
										$processFile = $db->query($getFile);
										$resultFile = $processFile->fetch_assoc();

										$Attachment = "<a href='../requirements/schoolrequirements/".$resultFile[$result['requirements']]."' target='_blank' class='btn btn-primary btn-sm'><i class='fa fa-eye'></i></a>";
									}
									$btns = "<button class='btn btn-success btn-sm' id='approve'  requirement='".$result['requirements']."' student='".$_GET['id']."'  title='Approve'><i class='fa fa-check'></i></button>";
									$btns .= " <button class='btn btn-danger btn-sm' id='decline'  requirement='".$result['requirements']."' student='".$_GET['id']."' title='Decline'><i class='fa fa-times'></i></button>";
									echo 
									"<tr>
										<td>".++$x."</td>
										<td><p id='reqName".$result['requirements']."'>".$reqName." ".$color."</p></td>
										<td>".$Attachment." ".$btns."</td>
									</tr>";
								}
							} 
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	include('footer.php');
?>
<script>
	$(document).on('click','#approve',function(){
		var studentId = $(this).attr('student');
		var requirements = $(this).attr('requirement');
		var actionType = '0';
		$.ajax({
			url		: 	'validateRequirements.php',
			method 	: 	'POST',
			data 	: 	{studentId:studentId,requirements:requirements,actionType:actionType},
			success : 	function(data)
			{
			 	$('#reqName'+requirements).addClass('approved');
			}
		})
	})
	$(document).on('click','#decline',function(){
		var studentId = $(this).attr('student');
		var requirements = $(this).attr('requirement');
		var actionType = '1';
		$.ajax({
			url		: 	'validateRequirements.php',
			method 	: 	'POST',
			data 	: 	{studentId:studentId,requirements:requirements,actionType:actionType},
			success : 	function(data)
			{
			 	$('#reqName'+requirements).addClass('declined');
			}
		})
	})


</script>