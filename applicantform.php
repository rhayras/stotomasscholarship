<?php
include('headerNav.php');
include("footerscripts.php");

?>
<br><br>
<?php
//check schoolyear status; 0-pede mag apply;1-ongoing na;2 finished need to reset
$flag = (isset($_GET['flag'])) ? $_GET['flag'] :"";
$check = "SELECT * FROM tbl_currentyear";
$processCheck = $db->query($check);
if($processCheck->num_rows > 0)
{
	$resultCheck = $processCheck->fetch_assoc();

	// pwede pa mag apply
	if($resultCheck['status'] == 0)
	{
		if($flag == '')
		{
			?>
				<div class="row" style="margin-top:100px;background-color: white;border-radius:10px;padding: 10px;">
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
									<input type="submit" name="submittype" class="btn btn-success" style="height:50px;" value="Submit" form="studenttypeForm">
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
			?>
				<div class="row">
					<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
						<form id="regForm" action="php/insertApplication.php" method="POST" enctype="multipart/form-data"> 
							  <h3>Apply as EPS Scholar</h3>
							  <p style="font-size: 15px;"><b>NOTE:</b> Please fill up this form.</p><br>
							  <!-- One "tab" for each step in the form: -->
		
							  <div class="tab">
							  	<h5>Educational Information</h5>
							    <?php
							   	if($flag == 1) // senior high
							    {
							    	?>
							    	<div class="row">
								    	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								    		<div class="form-group">
								  	  			<label>Student Type</label>
									    		<input type="text" name="studentLevel" id="studentLevel" value="Senior High School" readonly oninput="this.className = ''">
									    	</div>
								    	</div>
								    	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
							    			<div class="form-group">
								  	  			<label>School</label>
								  	  			<select  onchange="this.className = ''"  name="school">
								  	  				<option></option>
								  	  				<?php
								  	  				$getSchool = "SELECT * FROM tbl_school where status = 0";
								  	  				$processSchool = $db->query($getSchool);
								  	  				if($processSchool->num_rows > 0)
								  	  				{
								  	  					while($resultSchool = $processSchool->fetch_assoc())
								  	  					{
								  	  						echo 
								  	  						"<option value='".$resultSchool['id']."'>".$resultSchool['schoolname']."</option>";
								  	  					}
								  	  				}
								  	  				?>
								  	  			</select>
									    	</div>
								    	</div>
								    	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								    		<div class="form-group">
								  	  			<label>For School Year</label>
									    		<input type="text" name="schyear" id="schyear" value="<?php echo $resultCheck['schyear']?>" readonly oninput="this.className = ''">
									    	</div>
								    	</div>
								    </div>
								    <div class="row">
								    	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								    		<div class="form-group">
								  	  			<label>Semester</label>
									    		<input type="text" name="semester" id="semester" value="<?php echo $resultCheck['semester']?>" readonly oninput="this.className = ''">
									    	</div>
								    	</div>
								    	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								    		<div class="form-group">
								  	  			<label>Grade/ Year Level</label>
								  	  			<select name= "gradeyear" id="gradeyear"  oninput="this.className = ''">
								  	  				<option></option>
								  	  				<option>Grade 11</option>
								  	  				<option>Grade 12</option>
								  	  			</select>
									    	</div>
								    	</div>
								    	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								    		<div class="form-group">
								  	  			<label>Track</label>
									    		<input type="text" name="course" id="course" value=" " oninput="this.className = ''">
									    	</div>
								    	</div>
								    </div>
								    <div class="row">
								    	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								    		<div class="form-group">
								    			<label>Entrance Exam Rating <small>(From your intended school)</small></label>
								    			<input type="text" name="schoolEntranceExam" id="schoolEntranceExam"  oninput="this.className = ''">
								    		</div>
								    	</div>
								    	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								    		<div class="form-group">
								    			<label>Last School Attended</label>
								    			<input type="text" name="lastSchoolAttended" id="lastSchoolAttended"  oninput="this.className = ''">
								    		</div>
								    	</div>
								    	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								    		<div class="form-group">
								    			<label>School Address <small>(For Last School Attended)</small></label>
								    			<input type="text" name="lastSchoolAddress" id="lastSchoolAddress"  oninput="this.className = ''">
								    		</div>
								    	</div>
								    </div>
								    <div class="row">
								    	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								    		<div class="form-group">
								    			<label>Highest Year/Grade Completed</label>
								    			<input type="text" name="highestYear" id="highestYear"  oninput="this.className = ''">
								    		</div>
								    	</div>
								    	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								    		<div class="form-group">
								    			<label>GWA <small>(From your Highest Year/Grade Completed)</small></label>
								    			<input type="text" name="lastGwa" id="lastGwa"  oninput="this.className = ''">
								    		</div>
								    	</div>
								    </div>
							    	<?php
							    }
							    elseif($flag == 2) // college
							    {
							    	?>
							    	<div class="row">
								    	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								    		<div class="form-group">
								  	  			<label>Student Type</label>
									    		<input type="text" name="studentLevel" id="studentLevel" value="College" readonly oninput="this.className = ''">
									    	</div>
								    	</div>
								    	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
							    			<div class="form-group">
								  	  			<label>School</label>
								  	  			<select  onchange="this.className = ''"  name="school">
								  	  				<option></option>
								  	  				<?php
								  	  				$getSchool = "SELECT * FROM tbl_school where status = 0";
								  	  				$processSchool = $db->query($getSchool);
								  	  				if($processSchool->num_rows > 0)
								  	  				{
								  	  					while($resultSchool = $processSchool->fetch_assoc())
								  	  					{
								  	  						echo 
								  	  						"<option value='".$resultSchool['id']."'>".$resultSchool['schoolname']."</option>";
								  	  					}
								  	  				}
								  	  				?>
								  	  			</select>
									    	</div>
								    	</div>
								    	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								    		<div class="form-group">
								  	  			<label>For School Year</label>
									    		<input type="text" name="schyear" id="schyear" value="<?php echo $resultCheck['schyear']?>" readonly oninput="this.className = ''">
									    	</div>
								    	</div>
								    </div>
								    <div class="row">
								    	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								    		<div class="form-group">
								  	  			<label>Semester</label>
									    		<input type="text" name="semester" id="semester" value="<?php echo $resultCheck['semester']?>" readonly oninput="this.className = ''">
									    	</div>
								    	</div>
								    	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								    		<div class="form-group">
								  	  			<label>Grade/ Year Level</label>
									    		<select name= "gradeyear" id="gradeyear"  oninput="this.className = ''">
								  	  				<option></option>
								  	  				<option>1st Year</option>
								  	  				<option>2nd Year</option>
								  	  				<option>3rd Year</option>
								  	  				<option>4th Year</option>
								  	  			</select>
									    	</div>
								    	</div>
								    	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								    		<div class="form-group">
								  	  			<label>Course</label>
									    		<input type="text" name="course" id="course" value=" " oninput="this.className = ''">
									    	</div>
								    	</div>
								    </div>
								    <div class="row">
								    	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								    		<div class="form-group">
								    			<label>Entrance Exam Rating <small>(From your intended school)</small></label>
								    			<input type="text" name="schoolEntranceExam" id="schoolEntranceExam"  oninput="this.className = ''">
								    		</div>
								    	</div>
								    	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								    		<div class="form-group">
								    			<label>Last School Attended</label>
								    			<input type="text" name="lastSchoolAttended" id="lastSchoolAttended"  oninput="this.className = ''">
								    		</div>
								    	</div>
								    	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								    		<div class="form-group">
								    			<label>School Address <small>(For Last School Attended)</small></label>
								    			<input type="text" name="lastSchoolAddress" id="lastSchoolAddress"  oninput="this.className = ''">
								    		</div>
								    	</div>
								    </div>
								    <div class="row">
								    	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								    		<div class="form-group">
								    			<label>Highest Year/Grade Completed</label>
								    			<input type="text" name="highestYear" id="highestYear"  oninput="this.className = ''">
								    		</div>
								    	</div>
								    	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								    		<div class="form-group">
								    			<label>GWA <small>(From your Highest Year/Grade Completed)</small></label>
								    			<input type="text" name="lastGwa" id="lastGwa"  oninput="this.className = ''">
								    		</div>
								    	</div>
								    </div>
							    	<?php
							    }
							    ?>
							  </div>
				  		  	  <div class="tab">
							  	  	<h5>Personal Information</h5>
									  <div class="row">
								  	  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-4">
								  	  		<div class="form-group">
								  	  			<label>First Name</label>
									   			<input type= "text" onkeypress="return alphaOnly(event)" oninput="this.className = ''" name="fname">
								  	  		</div>
								  	  	</div>
								  	  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-4">
								  	  		<div class="form-group">
								  	  			<label>Middle Name</label>
									    		<input type= "text" onkeypress="return alphaOnly(event)" oninput="this.className = ''" name="mname">
									    	</div>
								  	  	</div>
								  	  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-4">
								  	  		<div class="form-group">
								  	  			<label>Last Name</label>
									    		<input type= "text" onkeypress="return alphaOnly(event)" oninput="this.className = ''" name="lname">
									    	</div>
								  	  	</div>
									  </div>
									  <div class="row">
									  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-4">
								  	  		<div class="form-group">
								  	  			<label>Barangay</label>
								  	  			<select type= "text" oninput="this.className = ''" name="address" style="width: 100%;">
								  	  				<option></option>
								  	  				<?php 
								  	  				$barangayArray = array('Poblacion 1','Poblacion 2','Poblacion 3','Poblacion 4','San Agustin','San Antonio','San Bartolome','San Felix','San Fernando','San Francisco','San Isidro Norte','San Isidro Sur','San Joaquin','San Jose','San Juan','San Luis','San Miguel','San Pablo','San Pedro','San Rafael','San Roque','San Vicente','Santa Ana','Santa Anastacia','Santa Clara','Santa Cruz','Santa Elena','Santa Maria','Santiago','Santa Teresita');

								  	  				foreach($barangayArray as $key)
								  	  				{
								  	  					echo "<option>".$key."</option>";
								  	  				}

								  	  				?>
								  	  			</select>
								  	  		</div>
								  	  	</div>
								  	  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-4">
								  	  		<div class="form-group">
								  	  			<label>Birthdate</label>
								  	  			<input oninput="this.className = ''" type= "date" name="bday"  id="bday" onchange="submitBday()">
								  	  		</div>
								  	  	</div>
								  	  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-4">
								  	  		<div class="form-group">
								  	  			<label>Birthplace</label>
								  	  			<input oninput="this.className = ''" type= "text" name="bplace">
								  	  		</div>
								  	  	</div>
									  </div>
									  <div class="row">
									  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-4">
								  	  		<div class="form-group">
								  	  			<label>Religion</label>
								  	  			<input type= "text" onkeypress="return alphaOnly(event)" oninput="this.className = ''" name="religion" style="width: 100%;">
								  	  		</div>
								  	  	</div>
								  	  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-4">
								  	  		<div class="form-group">
								  	  			<label>Gender</label>
								  	  			<select  onchange="this.className = ''"  name="gender">
								  	  				<option></option>
								  	  				<option>Male</option>
								  	  				<option>Female</option>
								  	  			</select>
								  	  		</div>
								  	  	</div>
								  	  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-4">
								  	  		<div class="form-group">
								  	  			<label>Age</label>
								  	  			<input oninput="this.className = ''" type= "text"  onkeypress="return isNumber(event)" name="age" id="myAge" readonly>
								  	  		</div>
								  	  	</div>
									  </div>
									  <div class="row">
									  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
									  		<div class="form-group">
								  	  			<label>Contact Number</label>
								  	  			<input onkeypress="return isNumber(event)" oninput="this.className = ''" type= "text" name="mobileno" id="mobileno" maxlength="11" onchange="checkContact();">
								  	  		</div>
									  		
									  	</div>
									  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
									  		<div class="form-group">
								  	  			<label>Email</label>
								  	  			<input oninput="this.className = ''" type= "email" name="email">
								  	  		</div>
									  	</div>
									  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
									  		<div class="form-group">
								  	  			<label>Other Bursary or Granted Enjoyed</label>
								  	  			<input oninput="this.className = ''" type= "text" name="otherScholarship">
								  	  		</div>
									  	</div>
									  </div>
									  <div class="row">
									  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
									  		<div class="form-group">
								  	  			<label>Citizenship</label>
								  	  			<input oninput="this.className = ''" type= "text" name="citizenship">
								  	  		</div>
									  	</div>
									  </div>
						  		  </div>
							  <div class="tab">
							  	<h5>Family Background</h5>
							  	<div class="row">
							  		<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								  		<div class="form-group">
							  	  			<label>Father's Name</label>
							  	  			<input  onkeypress="return alphaOnly(event)" oninput="this.className = ''" type= "text" name="fathername">
							  	  		</div>
								  	</div>
								  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								  		<div class="form-group">
							  	  			<label>Father's Age</label>
							  	  			<input onkeypress="return isNumber(event)" oninput="this.className = ''" type= "text" name="fatherAge">
							  	  		</div>
								  	</div>
								  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								  		<div class="form-group">
							  	  			<label>Father's Occupation</label>
							  	  			<input onkeypress="return alphaOnly(event)" oninput="this.className = ''" type= "text" name="fatherwork">
							  	  		</div>
								  	</div>
							  	</div>
							  	<div class="row">
							  		<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								  		<div class="form-group">
							  	  			<label>Mother's Name</label>
							  	  			<input onkeypress="return alphaOnly(event)" oninput="this.className = ''" type= "text" name="mothername">
							  	  		</div>
								  	</div>
								  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								  		<div class="form-group">
							  	  			<label>Mother's Age</label>
							  	  			<input onkeypress="return isNumber(event)" oninput="this.className = ''" type= "text" name="motherAge">
							  	  		</div>
								  	</div>
								  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								  		<div class="form-group">
							  	  			<label>Mother's Occupation</label>
							  	  			<input  onkeypress="return alphaOnly(event)" oninput="this.className = ''" type= "text" name="motherwork">
							  	  		</div>
								  	</div>
							  	</div>
							  	<div class="row">
							  		<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
							  			<div class="form-group">
							  				<label>Parents Present Address</label>
							  				<input  oninput="this.className = ''" type= "text" name="parentsAddress">
							  			</div>
							  		</div>
							  		<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
							  			<div class="form-group">
							  				<label>Total Number of Family Member</label>
							  				<input  oninput="this.className = ''" type= "text" name="totalFamMember" onkeypress="return isNumber(event)">
							  			</div>
							  		</div>
							  		<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
							  			<div class="row">
							  				<div class="col-md-6 col-lg-6 col-xs-6 col-sm-6">
							  					<div class="form-group">
									  				<label>Brothers</label>
									  				<input  oninput="this.className = ''" type= "text" name="brothers" onkeypress="return isNumber(event)">
									  			</div>
							  				</div>
							  				<div class="col-md-6 col-lg-6 col-xs-6 col-sm-6">
							  					<div class="form-group">
									  				<label>Sisters</label>
									  				<input  oninput="this.className = ''" type= "text" name="sisters" onkeypress="return isNumber(event)">
									  			</div>
							  				</div>
							  			</div>
							  		</div>
							  	</div>
							  	<div class="row">
							  		<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								  		<div class="form-group">
							  	  			<label>Family Yearly Gross Income</label>
							  	  			<input  oninput="this.className = ''" type= "number" name="gross">
							  	  		</div>
								  	</div>
							  	</div>
							  	<br>
						  		<h5>Educational Assistance Enjoyed by Brothers/Sisters</h5>
						  		<p><small>Put "n/a" if not applicable.</small></p>
							  	<div class="row">
							  		<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
							  			<label>Name</label><br>
							  			<input type= "text" name="sibling1"  oninput="this.className = ''"><br><br>
							  			<input type= "text" name="sibling2"  oninput="this.className = ''"><br><br>
							  			<input type= "text" name="sibling3"  oninput="this.className = ''">
							  		</div>
							  		<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
							  			<label>Educational Assistance</label><br>
							  			<input type= "text" name="sibling1Scholarship" oninput="this.className = ''"><br><br>
							  			<input type= "text" name="sibling2Scholarship"  oninput="this.className = ''"><br><br>
							  			<input type= "text" name="sibling3Scholarship" oninput="this.className = ''">
							  		</div>
							  		<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
							  			<label>Course and Year</label><br>
							  			<input type= "text" name="sibling1CourseYear"  oninput="this.className = ''"><br><br>
							  			<input type= "text" name="sibling2CourseYear"  oninput="this.className = ''"><br><br>
							  			<input type= "text" name="sibling3CourseYear" oninput="this.className = ''"><br><br>
							  		</div>
							  	</div>
							  </div>
							  <div class="tab">
							  	<h5>Account Information</h5>
							  	<p>Please fill up this for your account.</p>
							  	<div class="row">
							  		<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
							  			<div class="form-group">
							  				<label>You need to upload a 1x1 formal picture here.</label>
							  				<input type="file" name="file" >
							  			</div>
							  		</div>
					  		  		<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								  		<div class="form-group">
							  	  			<label>Username</label>
							  	  			<input  oninput="this.className = ''" type= "text" name="username">
							  	  		</div>
							  	  	</div>
							  	  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
							  	  		<div class="form-group">
							  	  			<label>Password</label>
							  	  			<input  oninput="this.className = ''" type= "password" name="password">
							  	  		</div>
								  	</div>
							  	</div>
							  </div>
							  <div style="overflow:auto;">
							    <div style="float:right;">
							      <button type="button" id="prevBtn" class="btn btn-custom btns" onclick="nextPrev(-1)">Previous</button>
							      <button type="button" id="nextBtn" class="btn btn-custom btns" onclick="nextPrev(1)">Next</button>
							    </div>
							  </div>
							  <!-- Circles which indicates the steps of the form: -->
							  <div style="text-align:center;margin-top:40px;">
							    <span class="step"></span>
							    <span class="step"></span>
							    <span class="step"></span>
							    <span class="step"></span>
							  </div>
						</form>
					</div>
				</div>
			<?php
		}
	}
	// on going na. di na pede mag apply
	elseif($resultCheck['status'] == 1)
	{
		?>
			<div class="row" style="margin-top:100px;background-color: white;border-radius:10px;padding: 10px;">
				<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
					<center>
						<h1>Scholarship is on going.</h1>
							<p>EPS Scholarship is currently ongoing. You will be able to apply for scholarship next semester. Thank you.</p>
							<a href="../stotomasscholarship/" class="btn btn-success btn-lg" style="color:white;">Okay</a>
					</center>
				</div>
			</div>
		<?php
	}
	elseif($resultCheck['status'] == 2)
	{
		?>
			<div class="row" style="margin-top:100px;background-color: white;border-radius:10px;padding: 10px;">
				<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
					<center>
						<h1>Scholarship just ended.</h1>
							<p>EPS Scholarship just ended. Kindly wait for the administration to start the application for scholarship. Thank you.</p>
							<a href="../stotomasscholarship/" class="btn btn-success btn-lg" style="color:white;">Okay</a>
					</center>
				</div>
			</div>
		<?php
	}
	if(isset($_POST['submittype']))
	{
		$studenttype = $_POST['studenttype'];
		$checkapplydate = "SELECT * FROM tbl_applydate WHERE scholartype = ".$studenttype." AND schyear ='".$resultCheck['schyear']."' and semester = '".$resultCheck['semester']."'";
		$processApplydate = $db->query($checkapplydate);
		if($processApplydate->num_rows > 0)
		{
			$result = $processApplydate->fetch_assoc();
			if(date('Y-m-d') == $result['fromdate'])
			{
				?>
				<script>
					window.location.href = "applicantform.php?flag="+<?php echo $result['scholartype']?>;
				</script>
				<?php				
			}
			elseif (date('Y-m-d') < $result['fromdate'])
			{
				?>
			     <script>
			          swal({
			                title: "Warning",
			                text: "Application will start on <?php echo $result['fromdate']?>.",
			                type: "warning",
			                showCancelButton: false,
			                confirmButtonClass: "btn-success",
			                confirmButtonText: "Okay"
			              },
			              function(isConfirm) {
			                if (isConfirm) {
			                  window.location.replace("../stotomasscholarship/");
			                } 
			              });
		        </script>
		      <?php
			}
			elseif (date('Y-m-d') > $result['todate'])
			{
			?>
			     <script>
			          swal({
			                title: "Warning",
			                text: "Application ended last <?php echo $result['todate']?>.",
			                type: "warning",
			                showCancelButton: false,
			                confirmButtonClass: "btn-success",
			                confirmButtonText: "Okay"
			              },
			              function(isConfirm) {
			                if (isConfirm) {
			                  window.location.replace("../stotomasscholarship/");
			                } 
			              });
		        </script>
		      <?php
			}
			else
			{
				?>
				<script>
					window.location.href = "applicantform.php?flag="+<?php echo $result['scholartype']?>;
				</script>
				<?php
			}
		}
		else
		{
	      	?>
		      <script>
		          swal({
		                title: "Warning",
		                text: "Application Date is not been set by admin.",
		                type: "warning",
		                showCancelButton: false,
		                confirmButtonClass: "btn-success",
		                confirmButtonText: "Okay"
		              },
		              function(isConfirm) {
		                if (isConfirm) {
		                  window.location.replace("../stotomasscholarship/");
		                } 
		              });
		        </script>
		      <?php
		}
	}
}
?>
<script>

var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i,j, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  z = x[currentTab].getElementsByTagName('select');
 for (j = 0; j < z.length; j++) {
    // If a field is empty...
    if (z[j].value == "") {
      // add an "invalid" class to the field:
      z[j].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }

  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }


  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>

	<script>
		function isNumber(evt) {
			evt = (evt) ? evt : window.event;
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if (charCode > 31 && (charCode < 48 || charCode > 57)) {
				return false;
			}
			return true;
		}
	</script>
	<script>
		function alphaOnly(evt) {
    var charCode = (evt.which) ? evt.which : window.event.keyCode;

    if (charCode <= 13) {
        return true;
    }
    else {
        var keyChar = String.fromCharCode(charCode);
        var re = /^[a-zA-Z .,]+$/
        return re.test(keyChar);
    }
}
	</script>
	<script>

	</script>
  <script src="lib/jquery/jquery.min.js"></script>
	<script>
		function checkContact()
		{
			var mobileno = $('#mobileno').val();
			$.ajax({
				url  	: 	'checkphone.php',
				method 	: 	'POST',
				data 	: 	{mobileno:mobileno},
				success : 	function(data)
				{
					if(data != "")
					{
						alert(data);
						$('#mobileno').val("");
					}
				}
			})
		}
		function submitBday()
		{
			//myAge
		    var Bdate = $('#bday').val(); 
		    var Bday = +new Date(Bdate);
		    var age = ~~ ((Date.now() - Bday) / (31557600000));
		    $('#myAge').val(age);
		    console.log(age);
		}
	</script>