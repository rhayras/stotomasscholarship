<?php
include('header.php');
$x =0;

$getInfo = "SELECT * FROM tbl_student WHERE id = ".$_SESSION['studentId']."";
$process = $db->query($getInfo);
$result = $process->fetch_assoc();

//get schoolyear and sem

$getSem = "SELECT * FROM `tbl_currentyear`";
$processSem = $db->query($getSem);
if($processSem->num_rows > 0)
{
	$resultSem = $processSem->fetch_assoc();
}
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
    	height: auto;
    	top: 10px;
    }
</style>
	<div class="row" style="padding: 10px;">
		<div class="col-md-12 col-lg-12" id="mainContainer">
			<p style="font-size: 20px;">List of Requirements For New Application</p>
			<p><b>Note:</b> All requirements should be PDF file.</p>
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<th>#</th>
						<th>Requirement</th>
						<th>Status</th>
						<th>Remarks</th>
						<th>Action</th>
					</thead>
					<tbody>
						<tr>
							<td><?php echo ++$x?></td>
							<td>Application Form</td>
							<?php
								$remarks = "";
								$enabled = "";
								$check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$result['id']." AND applicationForm != ''";
								$processCheck = $db->query($check);
								if($processCheck->num_rows > 0)
								{
									$resultCheck = $processCheck->fetch_assoc();
									$remarks = "<a target='_blank' href='barangayrequirements/".$resultCheck['applicationForm']."'>View Document</a>";
									$enabled = "disabled";
								}
								else
								{
									$remarks = "No Document Found";
								}
								$sql = "SELECT status FROM tbl_reqstatus WHERE studentId = ".$result['id']." AND requirements = 'applicationForm'";
								$process = $db->query($sql);
								if($process->num_rows > 0)
								{
									$resultStatus = $process->fetch_assoc();
									if($resultStatus['status'] == 0)
									{
										echo "<td>For Approval</td>";
									}
									elseif($resultStatus['status'] == 1)
									{
										echo "<td>Approved</td>";
									}
									else
									{
										echo "<td>Declined</td>";
									}
								}
								else
								{
									echo "<td>------</td>";
								}
							?>
							<td><?php echo $remarks?></td>
							<td><button class="btn btn-success btn-sm" id="uploadAppForm" data-toggle="modal" data-target="#applicationFormModal"<?php echo $enabled?> >Upload</button>
							<?php
							if($enabled == 'disabled')
							{
								?>
								<a href="reUpload.php?reqType=applicationForm" class="btn btn-primary btn-sm" style="color: white">Edit</a>
								<!-- <button class="btn btn-primary btn-sm" id="reUploadBtn"  reqType="applicationForm">Edit</button> -->
								<?php
							}
							?>
							</td>
						</tr>
						<tr>
							<td><?php echo ++$x?></td>
							<td>Birth Certificate</td>
							<?php
								$remarks = "";
								$enabled = "";
								$check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$result['id']." AND bcert != ''";
								$processCheck = $db->query($check);
								if($processCheck->num_rows > 0)
								{
									$resultCheck = $processCheck->fetch_assoc();
									$remarks = "<a target='_blank' href='barangayrequirements/".$resultCheck['bcert']."'>View Document</a>";
									$enabled = "disabled";
								}
								else
								{
									$remarks = "No Document Found";
								}
								$sql = "SELECT status FROM tbl_reqstatus WHERE studentId = ".$result['id']." AND requirements = 'bcert'";
								$process = $db->query($sql);
								if($process->num_rows > 0)
								{
									$resultStatus = $process->fetch_assoc();
									if($resultStatus['status'] == 0)
									{
										echo "<td>For Approval</td>";
									}
									elseif($resultStatus['status'] == 1)
									{
										echo "<td>Approved</td>";
									}
									else
									{
										echo "<td>Declined</td>";
									}
								}
								else
								{
									echo "<td>------</td>";
								}
							?>
							<td><?php echo $remarks?></td>
							<td><button class="btn btn-success btn-sm" id="uploadBCert" data-toggle="modal" data-target="#bcertModal"<?php echo $enabled?> >Upload</button>
							<?php
							if($enabled == 'disabled')
							{
								?>
								<a href="reUpload.php?reqType=bcert" class="btn btn-primary btn-sm" style="color: white">Edit</a>
								<?php
							}
							?>
							</td>
						</tr>
						<tr>
							<td><?php echo ++$x?></td>
							<td>High School Card/Form 138</td>
							<?php
								$remarks = "";
								$enabled = "";
								$check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$result['id']." AND form138 != ''";
								$processCheck = $db->query($check);
								if($processCheck->num_rows > 0)
								{
									$resultCheck = $processCheck->fetch_assoc();
									$remarks = "<a target='_blank' href='barangayrequirements/".$resultCheck['form138']."'>View Document</a>";
									$enabled = "disabled";
								}
								else
								{
									$remarks = "No Document Found";
								}
								$sql = "SELECT status FROM tbl_reqstatus WHERE studentId = ".$result['id']." AND requirements = 'form138'";
								$process = $db->query($sql);
								if($process->num_rows > 0)
								{
									$resultStatus = $process->fetch_assoc();
									if($resultStatus['status'] == 0)
									{
										echo "<td>For Approval</td>";
									}
									elseif($resultStatus['status'] == 1)
									{
										echo "<td>Approved</td>";
									}
									else
									{
										echo "<td>Declined</td>";
									}
								}
								else
								{
									echo "<td>------</td>";
								}
							?>
							<td><?php echo $remarks?></td>
							<td><button class="btn btn-success btn-sm" id="uploadform138" data-toggle="modal" data-target="#form138Modal"<?php echo $enabled?> >Upload</button>
							<?php
							if($enabled == 'disabled')
							{
								?>
								<a href="reUpload.php?reqType=form138" class="btn btn-primary btn-sm" style="color: white">Edit</a>
								<?php
							}
							?>
							</td>
						</tr>
						<tr>
							<td><?php echo ++$x?></td>
							<td>Certificate of Good Moral Character</td>
							<?php
								$remarks = "";
								$enabled = "";
								$check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$result['id']." AND goodMoral != ''";
								$processCheck = $db->query($check);
								if($processCheck->num_rows > 0)
								{
									$resultCheck = $processCheck->fetch_assoc();
									$remarks = "<a target='_blank' href='barangayrequirements/".$resultCheck['goodMoral']."'>View Document</a>";
									$enabled = "disabled";
								}
								else
								{
									$remarks = "No Document Found";
								}
								$sql = "SELECT status FROM tbl_reqstatus WHERE studentId = ".$result['id']." AND requirements = 'goodMoral'";
								$process = $db->query($sql);
								if($process->num_rows > 0)
								{
									$resultStatus = $process->fetch_assoc();
									if($resultStatus['status'] == 0)
									{
										echo "<td>For Approval</td>";
									}
									elseif($resultStatus['status'] == 1)
									{
										echo "<td>Approved</td>";
									}
									else
									{
										echo "<td>Declined</td>";
									}
								}
								else
								{
									echo "<td>------</td>";
								}
							?>
							<td><?php echo $remarks?></td>
							<td><button class="btn btn-success btn-sm" id="uploadGoodMoral" data-toggle="modal" data-target="#goodMoralModal"<?php echo $enabled?> >Upload</button>
							<?php
							if($enabled == 'disabled')
							{
								?>
								<a href="reUpload.php?reqType=goodMoral" class="btn btn-primary btn-sm" style="color: white">Edit</a>
								<?php
							}
							?>
							</td>
						</tr>
						<tr>
							<td><?php echo ++$x?></td>
							<td>Barangay Clearance</td>
							<?php
								$remarks = "";
								$enabled = "";
								$check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$result['id']." AND brgyclearance != ''";
								$processCheck = $db->query($check);
								if($processCheck->num_rows > 0)
								{
									$resultCheck = $processCheck->fetch_assoc();
									$remarks = "<a target='_blank' href='barangayrequirements/".$resultCheck['brgyclearance']."'>View Document</a>";
									$enabled = "disabled";
								}
								else
								{
									$remarks = "No Document Found";
								}
								$sql = "SELECT status FROM tbl_reqstatus WHERE studentId = ".$result['id']." AND requirements = 'brgyclearance'";
								$process = $db->query($sql);
								if($process->num_rows > 0)
								{
									$resultStatus = $process->fetch_assoc();
									if($resultStatus['status'] == 0)
									{
										echo "<td>For Approval</td>";
									}
									elseif($resultStatus['status'] == 1)
									{
										echo "<td>Approved</td>";
									}
									else
									{
										echo "<td>Declined</td>";
									}
								}
								else
								{
									echo "<td>------</td>";
								}
							?>
							<td><?php echo $remarks?></td>
							<td><button class="btn btn-success btn-sm" id="uploadbrgyclearance" data-toggle="modal" data-target="#brgyclearanceModal"<?php echo $enabled?> >Upload</button>
							<?php
							if($enabled == 'disabled')
							{
								?>
								<a href="reUpload.php?reqType=brgyclearance" class="btn btn-primary btn-sm" style="color: white">Edit</a>
								<?php
							}
							?></td>
						</tr>
						<tr>
							<td><?php echo ++$x?></td>
							<td>Vicinity Map/House Sketch</td>
							<?php
								$remarks = "";
								$enabled = "";
								$check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$result['id']." AND houseSketch != ''";
								$processCheck = $db->query($check);
								if($processCheck->num_rows > 0)
								{
									$resultCheck = $processCheck->fetch_assoc();
									$remarks = "<a target='_blank' href='barangayrequirements/".$resultCheck['houseSketch']."'>View Document</a>";
									$enabled = "disabled";
								}
								else
								{
									$remarks = "No Document Found";
								}
								$sql = "SELECT status FROM tbl_reqstatus WHERE studentId = ".$result['id']." AND requirements = 'houseSketch'";
								$process = $db->query($sql);
								if($process->num_rows > 0)
								{
									$resultStatus = $process->fetch_assoc();
									if($resultStatus['status'] == 0)
									{
										echo "<td>For Approval</td>";
									}
									elseif($resultStatus['status'] == 1)
									{
										echo "<td>Approved</td>";
									}
									else
									{
										echo "<td>Declined</td>";
									}
								}
								else
								{
									echo "<td>------</td>";
								}
							?>
							<td><?php echo $remarks?></td>
							<td><button class="btn btn-success btn-sm" id="uploadhouseSketch" data-toggle="modal" data-target="#houseSketchModal"<?php echo $enabled?> >Upload</button>
							<?php
							if($enabled == 'disabled')
							{
								?>
								<a href="reUpload.php?reqType=houseSketch" class="btn btn-primary btn-sm" style="color: white">Edit</a>
								<?php
							}
							?></td>
						</tr>
						<tr>
							<td><?php echo ++$x?></td>
							<td>Parents Voter's ID</td>
							<?php
								$remarks = "";
								$enabled = "";
								$check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$result['id']." AND votersId != ''";
								$processCheck = $db->query($check);
								if($processCheck->num_rows > 0)
								{
									$resultCheck = $processCheck->fetch_assoc();
									$remarks = "<a target='_blank' href='barangayrequirements/".$resultCheck['votersId']."'>View Document</a>";
									$enabled = "disabled";
								}
								else
								{
									$remarks = "No Document Found";
								}
								$sql = "SELECT status FROM tbl_reqstatus WHERE studentId = ".$result['id']." AND requirements = 'votersId'";
								$process = $db->query($sql);
								if($process->num_rows > 0)
								{
									$resultStatus = $process->fetch_assoc();
									if($resultStatus['status'] == 0)
									{
										echo "<td>For Approval</td>";
									}
									elseif($resultStatus['status'] == 1)
									{
										echo "<td>Approved</td>";
									}
									else
									{
										echo "<td>Declined</td>";
									}
								}
								else
								{
									echo "<td>------</td>";
								}
							?>
							<td><?php echo $remarks?></td>
							<td><button class="btn btn-success btn-sm" id="uploadvotersId" data-toggle="modal" data-target="#votersIdModal"<?php echo $enabled?> >Upload</button>
							<?php
							if($enabled == 'disabled')
							{
								?>
								<a href="reUpload.php?reqType=votersId" class="btn btn-primary btn-sm" style="color: white">Edit</a>
								<?php
							}
							?></td>
						</tr>
						<tr>
							<td><?php echo ++$x?></td>
							<td>Certificate of Employement/Unemployment of Parents</td>
							<?php
								$remarks = "";
								$enabled = "";
								$check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$result['id']." AND parentCert != ''";
								$processCheck = $db->query($check);
								if($processCheck->num_rows > 0)
								{
									$resultCheck = $processCheck->fetch_assoc();
									$remarks = "<a target='_blank' href='barangayrequirements/".$resultCheck['parentCert']."'>View Document</a>";
									$enabled = "disabled";
								}
								else
								{
									$remarks = "No Document Found";
								}
								$sql = "SELECT status FROM tbl_reqstatus WHERE studentId = ".$result['id']." AND requirements = 'parentCert'";
								$process = $db->query($sql);
								if($process->num_rows > 0)
								{
									$resultStatus = $process->fetch_assoc();
									if($resultStatus['status'] == 0)
									{
										echo "<td>For Approval</td>";
									}
									elseif($resultStatus['status'] == 1)
									{
										echo "<td>Approved</td>";
									}
									else
									{
										echo "<td>Declined</td>";
									}
								}
								else
								{
									echo "<td>------</td>";
								}
							?>
							<td><?php echo $remarks?></td>
							<td><button class="btn btn-success btn-sm" id="uploadParentCert" data-toggle="modal" data-target="#parentCertModal"<?php echo $enabled?> >Upload</button>
							<?php
							if($enabled == 'disabled')
							{
								?>
								<a href="reUpload.php?reqType=parentCert" class="btn btn-primary btn-sm" style="color: white">Edit</a>
								<?php
							}
							?></td>
						</tr>
						<tr>
							<td><?php echo ++$x?></td>
							<td>Previous School Registration Form</td>
							<?php
							$remarks = "";
							$enabled = "";
							$check = "SELECT * FROM tbl_schoolrequirements WHERE studentid = ".$result['id']." AND regform != '' AND status = 0 AND schoolyear = '".$resultSem['schyear']."' AND semester = '".$resultSem['semester']."'";
							$processCheck = $db->query($check);
							if($processCheck->num_rows > 0)
							{
								$resultCheck = $processCheck->fetch_assoc();
								$remarks = "<a target='_blank' href='schoolrequirements/".$resultCheck['regform']."'>View Document</a>";
									$enabled = "disabled";
							}
							else
							{
								$remarks = "No Document Found";
							}
							$sql = "SELECT status FROM tbl_reqstatus WHERE studentId = ".$result['id']." AND requirements = 'regform'";
							$process = $db->query($sql);
							if($process->num_rows > 0)
							{
								$resultStatus = $process->fetch_assoc();
								if($resultStatus['status'] == 0)
								{
									echo "<td>For Approval</td>";
								}
								elseif($resultStatus['status'] == 1)
								{
									echo "<td>Approved</td>";
								}
								else
								{
									echo "<td>Declined</td>";
								}
							}
							else
							{
								echo "<td>------</td>";
							}
							?>
							<td><?php echo $remarks?></td>
							<td><button class="btn btn-success btn-sm" id="uploadregform" data-toggle="modal" data-target="#regformModal"<?php echo $enabled?> >Upload</button>
							<?php
							if($enabled == 'disabled')
							{
								?>
								<a href="reUpload.php?reqType=regform" class="btn btn-primary btn-sm" style="color: white">Edit</a>
								<?php
							}
							?></td>
						</tr>
						<tr>
							<td><?php echo ++$x?></td>
							<td>Previous Grade Card</td>
							<?php
							$remarks = "";
							$enabled = "";
							$check = "SELECT * FROM tbl_schoolrequirements WHERE studentid = ".$result['id']." AND gradecard != '' AND status = 0 AND schoolyear = '".$resultSem['schyear']."' AND semester = '".$resultSem['semester']."'";
							$processCheck = $db->query($check);
							if($processCheck->num_rows > 0)
							{
								$resultCheck = $processCheck->fetch_assoc();
								$remarks = "<a target='_blank' href='schoolrequirements/".$resultCheck['gradecard']."'>View Document</a>";
									$enabled = "disabled";
							}
							else
							{
								$remarks = "No Document Found";
							}
							$sql = "SELECT status FROM tbl_reqstatus WHERE studentId = ".$result['id']." AND requirements = 'gradecard'";
							$process = $db->query($sql);
							if($process->num_rows > 0)
							{
								$resultStatus = $process->fetch_assoc();
								if($resultStatus['status'] == 0)
								{
									echo "<td>For Approval</td>";
								}
								elseif($resultStatus['status'] == 1)
								{
									echo "<td>Approved</td>";
								}
								else
								{
									echo "<td>Declined</td>";
								}
							}
							else
							{
								echo "<td>------</td>";
							}
							?>
							<td><?php echo $remarks?></td>
							<td><button class="btn btn-success btn-sm" id="uploadgradecard" data-toggle="modal" data-target="#gradecardModal"<?php echo $enabled?> >Upload</button>
							<?php
							if($enabled == 'disabled')
							{
								?>
								<a href="reUpload.php?reqType=gradecard" class="btn btn-primary btn-sm" style="color: white">Edit</a>
								<?php
							}
							?></td>
						</tr>
						<tr>
							<td><?php echo ++$x?></td>
							<td>School ID</td>
							<?php
							$remarks = "";
							$enabled = "";
							$check = "SELECT * FROM tbl_schoolrequirements WHERE studentid = ".$result['id']." AND schoolid != '' AND status = 0 AND schoolyear = '".$resultSem['schyear']."' AND semester = '".$resultSem['semester']."'";
							$processCheck = $db->query($check);
							if($processCheck->num_rows > 0)
							{
								$resultCheck = $processCheck->fetch_assoc();
								$remarks = "<a target='_blank' href='schoolrequirements/".$resultCheck['schoolid']."'>View Document</a>";
									$enabled = "disabled";
							}
							else
							{
								$remarks = "No Document Found";
							}
							$sql = "SELECT status FROM tbl_reqstatus WHERE studentId = ".$result['id']." AND requirements = 'schoolid'";
							$process = $db->query($sql);
							if($process->num_rows > 0)
							{
								$resultStatus = $process->fetch_assoc();
								if($resultStatus['status'] == 0)
								{
									echo "<td>For Approval</td>";
								}
								elseif($resultStatus['status'] == 1)
								{
									echo "<td>Approved</td>";
								}
								else
								{
									echo "<td>Declined</td>";
								}
							}
							else
							{
								echo "<td>------</td>";
							}
							?>
							<td><?php echo $remarks?></td>
							<td><button class="btn btn-success btn-sm" id="uploadschoolId" data-toggle="modal" data-target="#schoolidModal"<?php echo $enabled?> >Upload</button>
							<?php
							if($enabled == 'disabled')
							{
								?>
								<a href="reUpload.php?reqType=schoolid" class="btn btn-primary btn-sm" style="color: white">Edit</a>
								<?php
							}
							?></td>
						</tr>
					</tbody>	
				</table>
			</div>
		</div>
	</div>

<?php
include('footer.php');
?>