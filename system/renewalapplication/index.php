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

$studenttype = (isset($_POST['studenttype'])) ? $_POST['studenttype'] : '';
$schoolid = (isset($_POST['schoolname'])) ? $_POST['schoolname'] : '';
$surname = (isset($_POST['surname'])) ? $_POST['surname'] : '';
$firstname = (isset($_POST['firstname'])) ? $_POST['firstname'] : '';

$sqlFilterArray = array();
if($studenttype != "")
{
	$sqlFilterArray[] = " studenttype LIKE '".$studenttype."'";
}
if($schoolid != "")
{
	$sqlFilterArray[] = " school LIKE '".$schoolid."'";
}
if($surname != "")
{
	$sqlFilterArray[] = " surname LIKE '".$surname."'";
}
if($firstname != "")
{
	$sqlFilterArray[] = " firstname LIKE '".$firstname."'";
}
$sqlFilter = "";
if(count($sqlFilterArray) > 0)
{
	$sqlFilter = "AND";
}
$sqlFilter .= implode('AND',$sqlFilterArray);
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
    #maintable tbody {
    display:block;
    height:300px;
    overflow:auto;
	}
	#maintable thead, tbody tr {
	    display:table;
	    width:100%;
	}


</style>
<div class="row" style="padding: 10px;">
	<div class="col-md-12 col-lg-12" id="mainContainer">
		<span><h4 style="color:gray;">Renewal Applications 
		<div class="pull-right">
			<a href="oldscholars.php" class="btn btn-primary btn-sm">Old Scholars</a>
			<a href="disapproved.php" class="btn btn-danger btn-sm">Disapproved Renewals</a>
		</div></h4></span>
		<br>
		<div class="row">
			<form method="POST" id="filterForm"></form>
			<div class="col-md-3 col-lg-3">
				<label>Student Type</label>
				<select name="studenttype" id="studenttype" form="filterForm" onchange="this.form.submit()">
					<option></option>
					<option <?php if($studenttype == "Senior High School"){echo 'selected';}?>>Senior High School</option>
					<option <?php if($studenttype == "College"){echo 'selected';}?>>College</option>
				</select>
			</div>
			<div class="col-md-3 col-lg-3">
				<label>School</label>
				<select name="schoolname" id="schoolname" form="filterForm" style="width: 230px;"  onchange="this.form.submit()">
					<option></option>
					<?php
					$getSchools = "SELECT id,schoolname FROM tbl_school WHERE status = 0 ";
					$processSchools = $db->query($getSchools);
					if($processSchools->num_rows > 0)
					{
						while($resultSchool = $processSchools->fetch_assoc())
						{
							$selected = '';
							if($schoolid == $resultSchool['id']){$selected = 'selected';}
 							echo "<option value='".$resultSchool['id']."' ".$selected.">".$resultSchool['schoolname']."</option>";
						}
					}
					?>
				</select>
			</div>
			<div class="col-md-3 col-lg-3">
				<label>Surname</label>
				<input type="text" name="surname" id="surname" list='surnamelist' form="filterForm" onchange="this.form.submit()" value="<?php echo $surname?>">
				<datalist id="surnamelist">
					<?php
					$sql = "SELECT DISTINCT surname from tbl_student  WHERE status IN (8) ".$sqlFilter."";
					$process = $db->query($sql);
					if($process->num_rows > 0)
					{
						while($result = $process->fetch_assoc())
						{
							echo
							"<option>".$result['surname']."</option>";
						}
					}
					?>
				</datalist>
			</div>
			<div class="col-md-3 col-lg-3">
				<label>First Name</label>
				<input type="text" name="firstname" id="firstname" list='namelist' form="filterForm" onchange="this.form.submit()" value="<?php echo $firstname?>">
				<datalist id="namelist">
					<?php
					$sql = "SELECT DISTINCT firstname from tbl_student WHERE status IN (8) ".$sqlFilter."";
					$process = $db->query($sql);
					if($process->num_rows > 0)
					{
						while($result = $process->fetch_assoc())
						{
							echo
							"<option>".$result['firstname']."</option>";
						}
					}
					?>
				</datalist>
			</div>
		</div>
		<div class="table-responsive">
			<table class="table table-bordered " id="maintable">
				<thead>
					<th style="width:50px;text-align:center">#</th>
					<th style="width:250px;">Student Name</th>
					<th style="width:200px;">Student Type</th>
					<th style="width:150px;">Grade/Year</th>
					<th style="width:200px;">Course</th>
					<th style="width:200px;">School</th>
					<th style="width:200px;">S.Y/Semester</th>
					<th style="text-align: center;width:100px;">Action</th>
				</thead>
				<tbody style="font-size: 13px;">
					<?php
					$x = 0;
					$status = "";
					$scholartype = "";
					$getApplicant = "SELECT * FROM tbl_student WHERE status IN (8) AND semester = '".$sem."' AND schoolyear = '".$schyear."' ".$sqlFilter." ";
					$processApplicant = $db->query($getApplicant);
					if($processApplicant->num_rows > 0)
					{
						while($resultApplicant = $processApplicant->fetch_assoc())
						{
							if($resultApplicant['scholarType'] == 0)
							{
								$scholartype = "Full";
							}else{$scholartype = "Assistance";}
							$applicantId = $resultApplicant['id'];
							$getSchool = "SELECT schoolalias from tbl_school WHERE id = ".$resultApplicant['school'];
							$processSchool = $db->query($getSchool);
							$resultSchool = $processSchool->fetch_assoc();
							echo 
							"<tr>
								<td style='width:45px;text-align:center'>".++$x."</td>
								<td style='width:245px;'>".$resultApplicant['firstname']." ".$resultApplicant['surname']."</td>
								<td style='width:194px;'>".$resultApplicant['studenttype']."</td>
								<td style='width:149px;'>".$resultApplicant['yearOrgrade']."</td>
								<td style='width:194px;'>".$resultApplicant['course']."</td>
								<td style='width:194px;'>".$resultSchool['schoolalias']."</td>
								<td style='width:195px;'>".$resultApplicant['schoolyear']."/".$resultApplicant['semester']."</td>
								<td style='text-align:center;'><a href='viewapplicant.php?id=".$resultApplicant['id']."' class=' btn-primary btn-sm' style='color:white;'>View</a></td>
							</tr>";
						}
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php
	include('footer.php');
?>