<?php
include('../../db/db.php');
include('header.php');
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

$studenttype = (isset($_POST['studenttype'])) ? $_POST['studenttype'] : '';
$schoolid = (isset($_POST['schoolname'])) ? $_POST['schoolname'] : '';
$schoolyear = (isset($_POST['schoolyear'])) ? $_POST['schoolyear'] : $schyear;
$semester = (isset($_POST['semester'])) ? $_POST['semester'] : '';
$barangay = (isset($_POST['barangay'])) ? $_POST['barangay'] : '';
$oldOrNew = (isset($_POST['oldOrNew'])) ? $_POST['oldOrNew'] : '';
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
</style>
<div class="row" style="padding: 10px;">
	<div class="col-md-12 col-lg-12" id="mainContainer">
		<div class="row">
			<div class="col-md-3 col-lg-3"></div>
			<div class="col-md-6 col-lg-6">
				<center>
					<h4>Filter Report</h4>
					<form action='reportPdf.php' method="POST" id="reportForm" target='_blank'></form>
					<div class="form-group">
						<label>Report</label>
						<select name="reporttype" id="reporttype" class="form-control" form="reportForm" > 
							<option selected disabled>--Select One--</option>
							<option value="0">Exam Result</option>
							<option value="1">Scholars List</option>
							<option value="2">Scholars Grant List</option>
							<option value="3">List of Graduated EPS Scholars</option>
							<option value="4">Declined Applications</option>
						</select>
					</div>
					<div id="scholarlistDiv" style="display: none;">
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>School Year</label>
									<select name="schoolyear" class='form-control' id="schoolyear" form="reportForm"  style="width: 100%;">
		                                  <option></option>
		                                  <?php
		                                  $sql = "SELECT DISTINCT schoolyear from tbl_scholarhistory";
		                                  $process = $db->query($sql);
		                                  if($process->num_rows > 0)
		                                  {
		                                    while($result = $process->fetch_assoc())
		                                    {
		                                    ?>
		                                      <option <?php if($schyear == $result['schoolyear']){echo 'selected';}?>><?php echo $result['schoolyear']?></option>
		                                    <?php
		                                    }
		                                  }
		                                  ?>
		                            </select>
								</div>
								<div class="form-group">
									<label>Semester</label>
									<select name="semester" class='form-control' id="semester" form="reportForm"  style="width: 100%;">
		                                  <option></option>
		                                  <?php
		                                  $sql = "SELECT DISTINCT sem from tbl_scholarhistory";
		                                  $process = $db->query($sql);
		                                  if($process->num_rows > 0)
		                                  {
		                                    while($result = $process->fetch_assoc())
		                                    {
		                                    ?>
		                                      <option <?php if($sem == $result['sem']){echo 'selected';}?>><?php echo $result['sem']?></option>
		                                    <?php
		                                    }
		                                  }
		                                  ?>
		                            </select>
								</div>
							</div>
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>Student Type</label>
									<select name="studenttype" class='form-control' id="studenttype" form="reportForm"  style="width: 100%;">
		                                  <option>All</option>
		                                  <?php
		                                  $sql = "SELECT DISTINCT studenttype from tbl_scholarhistory ";
		                                  $process = $db->query($sql);
		                                  if($process->num_rows > 0)
		                                  {
		                                    while($result = $process->fetch_assoc())
		                                    {
		                                    ?>
		                                      <option <?php if($studenttype == $result['studenttype']){echo 'selected';}?>><?php echo $result['studenttype']?></option>
		                                    <?php
		                                    }
		                                  }
		                                  ?>
		                            </select>
								</div>
								<div class="form-group">
									<label>School</label>
									<select name="schoolname" class='form-control' id="schoolname" form="reportForm" style="width: 100%;" >
		                                  <option>All</option>
		                                  <?php
		                                  $query = "SELECT DISTINCT studentId FROM tbl_scholarhistory";
		                                  $processQuery = $db->query($query);
		                                  $sql = "SELECT DISTINCT school from tbl_student  WHERE status IN(4,7,8,10) ";
		                                  $process = $db->query($sql);
		                                  if($process->num_rows > 0)
		                                  {
		                                    while($result = $process->fetch_assoc())
		                                    {
		                                      $getSchools = "SELECT schoolname FROM tbl_school WHERE id= ".$result['school'];
		                                      $processSchools = $db->query($getSchools);
		                                      $resultSchool = $processSchools->fetch_assoc();
		                                      ?>
		                                      <option value='<?php echo $result['school']?>' <?php if($schoolid == $result['school']){echo 'selected';}?>><?php echo $resultSchool['schoolname']?></option>
		                                    <?php
		                                    }
		                                  }
		                                  ?>
		                                </select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-lg-12">
								<div class="form-group">
									<label>Barangay</label>
									<select name="barangay" id="barangay" class="form-control" form="reportForm">
										<option>All</option>

										<?php
										$barangayArray = array('Poblacion 1','Poblacion 2','Poblacion 3','Poblacion 4','San Agustin','San Antonio','San Bartolome','San Felix','San Fernando','San Francisco','San Isidro Norte','San Isidro Sur','San Joaquin','San Jose','San Juan','San Luis','San Miguel','San Pablo','San Pedro','San Rafael','San Roque','San Vicente','Santa Ana','Santa Anastacia','Santa Clara','Santa Cruz','Santa Elena','Santa Maria','Santiago','Santa Teresita');
					  	  				foreach($barangayArray as $key)
					  	  				{
					  	  					echo "<option>".$key."</option>";
					  	  				}
										?>
									</select>
								</div>
								<center>
									<input type="submit" name="submit" id="submit" value='Filter Report' class="btn btn-success" form="reportForm">
								</center>
							</div>
						</div>
					</div>

					<div id="examResultDiv" style="display: none;">
						<form action='examReportPdf.php' method="POST" id="examreportForm" target='_blank'></form>
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>School Year</label>
									<select name="schoolyear" class='form-control' id="schoolyear" form="examreportForm"  style="width: 100%;">
		                                  <option></option>
		                                  <?php
		                                  $sql = "SELECT DISTINCT schoolyear from tbl_scholarhistory";
		                                  $process = $db->query($sql);
		                                  if($process->num_rows > 0)
		                                  {
		                                    while($result = $process->fetch_assoc())
		                                    {
		                                    ?>
		                                      <option <?php if($schyear == $result['schoolyear']){echo 'selected';}?>><?php echo $result['schoolyear']?></option>
		                                    <?php
		                                    }
		                                  }
		                                  ?>
		                            </select>
								</div>
							</div>
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>Semester</label>
									<select name="semester" class='form-control' id="semester" form="examreportForm"  style="width: 100%;">
		                                  <option>All</option>
		                                  <?php
		                                  $sql = "SELECT DISTINCT sem from tbl_scholarhistory";
		                                  $process = $db->query($sql);
		                                  if($process->num_rows > 0)
		                                  {
		                                    while($result = $process->fetch_assoc())
		                                    {
		                                    ?>
		                                      <option <?php if($sem == $result['sem']){echo 'selected';}?>><?php echo $result['sem']?></option>
		                                    <?php
		                                    }
		                                  }
		                                  ?>
		                            </select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-lg-12">
								<div class="form-group">
									<label>Student Type</label>
									<select name="studenttype" class='form-control' id="studenttype" form="examreportForm"  style="width: 100%;">
		                                  <option>All</option>
		                                  <?php
		                                  $sql = "SELECT DISTINCT studenttype from tbl_scholarhistory ";
		                                  $process = $db->query($sql);
		                                  if($process->num_rows > 0)
		                                  {
		                                    while($result = $process->fetch_assoc())
		                                    {
		                                    ?>
		                                      <option <?php if($studenttype == $result['studenttype']){echo 'selected';}?>><?php echo $result['studenttype']?></option>
		                                    <?php
		                                    }
		                                  }
		                                  ?>
		                            </select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-lg-12">
								<center>
									<input type="submit" name="submit" id="submit" value='Filter Report' class="btn btn-success" form="examreportForm">
								</center>
							</div>
						</div>
					</div>

					<div id="grantDiv" style="display: none;">
						<form action='grantReport.php' method="POST" id="grantForm" target='_blank'></form>
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>School Year</label>
									<select name="schoolyear" class='form-control' id="schoolyear" form="grantForm"  style="width: 100%;">
		                                  <option></option>
		                                  <?php
		                                  $sql = "SELECT DISTINCT schoolyear from tbl_scholarhistory";
		                                  $process = $db->query($sql);
		                                  if($process->num_rows > 0)
		                                  {
		                                    while($result = $process->fetch_assoc())
		                                    {
		                                    ?>
		                                      <option <?php if($schyear == $result['schoolyear']){echo 'selected';}?>><?php echo $result['schoolyear']?></option>
		                                    <?php
		                                    }
		                                  }
		                                  ?>
		                            </select>
								</div>
							</div>
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>Semester</label>
									<select name="semester" class='form-control' id="semester" form="grantForm"  style="width: 100%;">
		                                  <option></option>
		                                  <?php
		                                  $sql = "SELECT DISTINCT sem from tbl_scholarhistory";
		                                  $process = $db->query($sql);
		                                  if($process->num_rows > 0)
		                                  {
		                                    while($result = $process->fetch_assoc())
		                                    {
		                                    ?>
		                                      <option <?php if($sem == $result['sem']){echo 'selected';}?>><?php echo $result['sem']?></option>
		                                    <?php
		                                    }
		                                  }
		                                  ?>
		                            </select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-lg-12">
								<div class="form-group">
									<label>Student Type</label>
									<select name="studenttype" class='form-control' id="studenttype" form="grantForm"  style="width: 100%;">
		                                  <option>All</option>
		                                  <?php
		                                  $sql = "SELECT DISTINCT studenttype from tbl_student  WHERE status IN(4,7,8,10) ";
		                                  $process = $db->query($sql);
		                                  if($process->num_rows > 0)
		                                  {
		                                    while($result = $process->fetch_assoc())
		                                    {
		                                    ?>
		                                      <option <?php if($studenttype == $result['studenttype']){echo 'selected';}?>><?php echo $result['studenttype']?></option>
		                                    <?php
		                                    }
		                                  }
		                                  ?>
		                            </select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-lg-12">
								<center>
									<input type="submit" name="submit" id="submit" value='Filter Report' class="btn btn-success" form="grantForm">
								</center>
							</div>
						</div>
					</div>

					<div id='graduateDiv' style="display: none;">
						<form action='graduatedReport.php' method="POST" id="graduateForm" target='_blank'></form>
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>School Year</label>
									<select name="schoolyear" class='form-control' id="schoolyear" form="graduateForm"  style="width: 100%;">
		                                  <option></option>
		                                  <?php
		                                  $sql = "SELECT DISTINCT schoolyear from tbl_scholarhistory";
		                                  $process = $db->query($sql);
		                                  if($process->num_rows > 0)
		                                  {
		                                    while($result = $process->fetch_assoc())
		                                    {
		                                    ?>
		                                      <option <?php if($schyear == $result['schoolyear']){echo 'selected';}?>><?php echo $result['schoolyear']?></option>
		                                    <?php
		                                    }
		                                  }
		                                  ?>
		                            </select>
								</div>
							</div>
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>Student Type</label>
									<select name="studenttype" class='form-control' id="studenttype" form="graduateForm"  style="width: 100%;">
		                                  <option>All</option>
		                                  <?php
		                                  $sql = "SELECT DISTINCT studenttype from tbl_student  WHERE status IN(4,7,8,10) ";
		                                  $process = $db->query($sql);
		                                  if($process->num_rows > 0)
		                                  {
		                                    while($result = $process->fetch_assoc())
		                                    {
		                                    ?>
		                                      <option <?php if($studenttype == $result['studenttype']){echo 'selected';}?>><?php echo $result['studenttype']?></option>
		                                    <?php
		                                    }
		                                  }
		                                  ?>
		                            </select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-lg-12">
								<center>
									<input type="submit" name="submit" id="submit" value='Filter Report' class="btn btn-success" form="graduateForm">
								</center>
							</div>
						</div>
					</div>

					<div id="declineDiv" style="display: none;">
						<form action='declineReport.php' method="POST" id="declineForm" target='_blank'></form>
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>School Year</label>
									<select name="schoolyear" class='form-control' id="schoolyear" form="declineForm"  style="width: 100%;">
		                                  <option></option>
		                                  <?php
		                                  $sql = "SELECT DISTINCT schoolyear from tbl_scholarhistory";
		                                  $process = $db->query($sql);
		                                  if($process->num_rows > 0)
		                                  {
		                                    while($result = $process->fetch_assoc())
		                                    {
		                                    ?>
		                                      <option <?php if($schyear == $result['schoolyear']){echo 'selected';}?>><?php echo $result['schoolyear']?></option>
		                                    <?php
		                                    }
		                                  }
		                                  ?>
		                            </select>
								</div>
							</div>
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>Semester</label>
									<select name="semester" class='form-control' id="semester" form="declineForm"  style="width: 100%;">
		                                  <option></option>
		                                  <?php
		                                  $sql = "SELECT DISTINCT sem from tbl_scholarhistory";
		                                  $process = $db->query($sql);
		                                  if($process->num_rows > 0)
		                                  {
		                                    while($result = $process->fetch_assoc())
		                                    {
		                                    ?>
		                                      <option <?php if($sem == $result['sem']){echo 'selected';}?>><?php echo $result['sem']?></option>
		                                    <?php
		                                    }
		                                  }
		                                  ?>
		                            </select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-lg-12">
								<center>
									<input type="submit" name="submit" id="submit" value='Filter Report' class="btn btn-success" form="declineForm">
								</center>
							</div>
						</div>
					</div>
				</center>
			</div>
			<div class="col-md-3 col-lg-3"></div>
		</div>
	</div>
</div>
<?php
include('footer.php');
?>
