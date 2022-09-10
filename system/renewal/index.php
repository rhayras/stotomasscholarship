<?php
include('../../db/db.php');
include('header.php');

$flag = (isset($_GET['flag'])) ? $_GET['flag'] :"";
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
    input {
  padding: 8px;
  width: 100%;
  font-size: 13px;
  border: 1px solid #aaaaaa;
}
select {
  padding: 8px;
  width: 100%;
  font-size: 13px;
  border: 1px solid #aaaaaa;
}

</style>
	<div class="row" style="padding: 10px;margin-top:10px;">
		<div class="col-md-12 col-lg-12" id="mainContainer">
			<h4 style="padding: 10px;">Scholarship Renewal</h4>
			<?php
			if($flag == '')
			{
				?>
					<div class="row" style="background-color: white;border-radius:10px;padding: 10px;">
						<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
							<center><h1>Please select your level.</h1></center>
							<div class="row">
								<div class="col-md-4 col-lg-4"></div>
								<div class="col-md-4 col-lg-4">
									<form action="" method="POST" id="studenttypeForm"></form>
									<select name="studenttype" id="studenttype" class="form-control" form="studenttypeForm" required>
										<option></option>
										<option value="1">Senior High School</option>
										<option value="2">College</option>
									</select><br>
									<div class="form-group">
										<input type="submit" name="submittype" class="btn btn-success" style="height:50px;width: 100%;" value="Submit" form="studenttypeForm">
									</div>
								</div>
								<div class="col-md-4 col-lg-4"></div>
							</div>
						</div>
					</div>
				<?php
			}
			else
			{
			    $check = "SELECT * FROM tbl_currentyear";
			    $processCheck = $db->query($check);
			    if($processCheck->num_rows > 0)
			    {
			      $resultCheck = $processCheck->fetch_assoc();
			    }
				$studenttype = "";
				if($flag == 0)
				{
					$studenttype = "Junior High School";
				}
				elseif($flag == 1)
				{
					$studenttype = "Senior High School";
				}
				else
				{
					$studenttype = "College";
				}
				$getStudent = "SELECT * FROM tbl_student WHERE id =".$_SESSION['studentId'];
				$processStudent = $db->query($getStudent);
				$resultStudent = $processStudent->fetch_assoc();
				?>
				<div class="row">
					<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
						<form method="POST" id="renewForm"></form>
						<input type='hidden' name="studentId" value="<?php echo $_SESSION['studentId']?>" form="renewForm" >
						<p>Fill up this form to apply for renewal.<br>
							<small><b>NOTE: </b> You need to submit your previous School Registration Form, previousGrade Card and your School ID as PDF File.</small></p>
						<div class="row">
							<div class="col-md-1 col-lg-1"></div>
							<div class="col-md-5 col-lg-5">
								<div class="form-group">
					  	  			<label>Student Type</label><br>
						    		<input type="text" name="studenttype" id="studenttype" value="<?php echo $studenttype?>" readonly style='width: 100%;' form="renewForm">
						    	</div>
						    	<div class="form-group">
					  	  			<label>Grade Level</label><br>
						    		<input type="text" name="gradelevel" id="gradelevel" style='width: 100%;'form="renewForm" required>
						    	</div>
						    	<div class="form-group">
					  	  			<label>Course</label><br>
						    		<input type="text" name="course" value="<?php echo $resultStudent['course']?>" id="course" style='width: 100%;'form="renewForm" required>
						    	</div>
						    	<div class="form-group">
					  	  			<label>Previous GWA</label><br>
						    		<input type="text" name="gwa" id="gwa" style='width: 100%;'form="renewForm" required>
						    	</div>
							</div>
							<div class="col-md-5 col-lg-5">
				    			<div class="form-group">
					  	  			<label>School</label>
					  	  			<select  name="school" id="school" style='width: 100%;'form="renewForm" required>
					  	  				<option></option>
					  	  				<?php
					  	  				$selected = "";
					  	  				$getSchool = "SELECT * FROM tbl_school where status = 0";
					  	  				$processSchool = $db->query($getSchool);
					  	  				if($processSchool->num_rows > 0)
					  	  				{
					  	  					while($schoolResult = $processSchool->fetch_assoc())
					  	  					{
					  	  						?>
					  	  						<option value="<?php echo $schoolResult['id']?>" <?php if($resultStudent['school'] == $schoolResult['id']){echo 'selected';}?>><?php echo $schoolResult['schoolname']?></option>
					  	  						<?php
					  	  						
					  	  					}
					  	  				}
					  	  				?>
					  	  			</select>
						    	</div>
								<div class="form-group">
					  	  			<label>School Year</label><br>
						    		<input type="text" name="schyear" id="schyear" value="<?php echo $resultCheck['schyear']?>" readonly style='width: 100%;'form="renewForm">
						    	</div>
						    	<div class="form-group">
					  	  			<label>Semester</label><br>
						    		<input type="text" name="sem" id="sem" value="<?php echo $resultCheck['semester']?>" readonly style='width: 100%;'form="renewForm">
						    	</div>
							</div>
							<div class="col-md-1 col-lg-1"></div>
						</div>
						<div class="row">
							<div class="col-md-1 col-lg-1"></div>
							<div class="col-md-10 col-lg-10">
								<div class="pull-right">
									<input type="submit" name="renew" id="renew" value="Submit Application" class="btn btn-success" form="renewForm">
								</div>
							</div>
							<div class="col-md-1 col-lg-1"></div>
						</div>
					</div>
					
				</div>
				<?php
			}
			?>
		</div>
	</div>

<?php
include('footer.php');
?>