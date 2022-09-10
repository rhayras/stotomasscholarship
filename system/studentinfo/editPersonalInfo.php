<?php
include('header.php');
if($_SESSION['priviledge'] != "student")
{
header("Location:../");
}

$studentId = $_GET['studentId'];

$sql = "SELECT * FROM tbl_student WHERE id = ".$studentId;
$process = $db->query($sql);
$result = $process->fetch_assoc();

?>
<style>
	        * {
  box-sizing: border-box;
}
.row{
  margin-left: 0;
  margin-right: 0;
}
body {
  background-color: #f1f1f1;
}

#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  padding: 40px;
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

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
  border:1px solid #ff4444;
}
select.invalid {
    background-color: #ffdddd;
    border:1px solid #ff4444;
}
/* Hide all steps by default: */
.tab {
  display: none;
}

.btns {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  cursor: pointer;
}
.btns:hover {
  opacity: 0.8;
}
#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  display: inline-block;
}

.step.active {
  background-color: #4CAF50;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #bbbbbb;
}
</style>
<br>
<div style="background-color: white;">
	<br>
	<h4 style="padding-left: 40px;">Update Personal Information</h4>
	<form method="POST" id="updateInfoForm" action="updateInfoSql.php"></form>
	<input type="hidden" name="studentId" value="<?php echo $result['id']?>" form="updateInfoForm">
	<div class="row" style="padding: 10px;">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="tab"> <!--Personal Info -->
				<div class="row">
			  	  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-4">
			  	  		<div class="form-group">
			  	  			<label>First Name</label>
				   			<input placeholder="First name..." type= "text" onkeypress="return alphaOnly(event)" oninput="this.className = ''" name="fname" form="updateInfoForm" value="<?php echo $result['firstname']?>">
			  	  		</div>
			  	  	</div>
			  	  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-4">
			  	  		<div class="form-group">
			  	  			<label>Middle Name</label>
				    		<input placeholder="Middle name..." type= "text" onkeypress="return alphaOnly(event)" oninput="this.className = ''" name="mname"form="updateInfoForm" value="<?php echo $result['middlename']?>">
				    	</div>
			  	  	</div>
			  	  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-4">
			  	  		<div class="form-group">
			  	  			<label>Last Name</label>
				    		<input placeholder="Last name..." type= "text" onkeypress="return alphaOnly(event)" oninput="this.className = ''" name="lname" form="updateInfoForm" value="<?php echo $result['surname']?>">
				    	</div>
			  	  	</div>
			    </div>
			    <div class="row">
				  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-4">
			  	  		<div class="form-group">
			  	  			<label>Barangay</label>
			  	  			<select type= "text" oninput="this.className = ''" name="address" style="width: 100%;" form="updateInfoForm" >
			  	  				<option></option>
			  	  				<?php 

			  	  				$barangayArray = array('Poblacion 1','Poblacion 2','Poblacion 3','Poblacion 4','San Agustin','San Antonio','San Bartolome','San Felix','San Fernando','San Francisco','San Isidro Norte','San Isidro Sur','San Joaquin','San Jose','San Juan','San Luis','San Miguel','San Pablo','San Pedro','San Rafael','San Roque','San Vicente','Santa Ana','Santa Anastacia','Santa Clara','Santa Cruz','Santa Elena','Santa Maria','Santiago','Santa Teresita');

			  	  				foreach($barangayArray as $key)
			  	  				{
			  	  					if($result['address'] == $key) {echo "<option selected>".$key."</option>";}
			  	  					if($result['address'] != $key) {echo "<option>".$key."</option>";}
			  	  					
			  	  				}

			  	  				?>
			  	  			</select>
			  	  		</div>
			  	  	</div>
			  	  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-4">
			  	  		<div class="form-group">
			  	  			<label>Birthdate</label>
			  	  			<input oninput="this.className = ''" type= "date" name="bday" form="updateInfoForm" value="<?php echo $result['bday']?>">
			  	  		</div>
			  	  	</div>
			  	  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-4">
			  	  		<div class="form-group">
			  	  			<label>Birthplace</label>
			  	  			<input placeholder="Birth Place" oninput="this.className = ''" type= "text" name="bplace" form="updateInfoForm" value="<?php echo $result['bplace']?>">
			  	  		</div>
			  	  	</div>
				</div>
				<div class="row">
				  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-4">
			  	  		<div class="form-group">
			  	  			<label>Religion</label>
			  	  			<input placeholder="Religion" type= "text" onkeypress="return alphaOnly(event)" oninput="this.className = ''" name="religion" style="width: 100%;" form="updateInfoForm" value="<?php echo $result['religion']?>">
			  	  		</div>
			  	  	</div>
			  	  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-4">
			  	  		<div class="form-group">
			  	  			<label>Gender</label>
			  	  			<select  onchange="this.className = ''"  name="gender" form="updateInfoForm">
			  	  				<option></option>
			  	  				<option <?php if($result['gender'] == 'Male') echo 'selected';?>>Male</option>
			  	  				<option <?php if($result['gender'] == 'Female') echo 'selected';?>>Female</option>
			  	  			</select>
			  	  		</div>
			  	  	</div>
			  	  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-4">
			  	  		<div class="form-group">
			  	  			<label>Age</label>
			  	  			<input placeholder="Age" oninput="this.className = ''" type= "number" name="age" form="updateInfoForm" value="<?php echo $result['age']?>">
			  	  		</div>
			  	  	</div>
			    </div>
			    <div class="row">
				  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
				  		<div class="form-group">
			  	  			<label>Email</label>
			  	  			<input placeholder="Email Address" oninput="this.className = ''" type= "email" name="email" form="updateInfoForm" value="<?php echo $result['email']?>">
			  	  		</div>
				  	</div>
				  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
				  		<div class="form-group">
			  	  			<label>Contact Number</label>
			  	  			<input placeholder="Contact Number" onkeypress="return isNumber(event)" oninput="this.className = ''" type= "text" name="mobileno" maxlength="11" form="updateInfoForm" value="<?php echo $result['contactno']?>">
			  	  		</div>
				  	</div>
				  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
				  		<div class="form-group">
			  	  			<label>Citizenship</label>
			  	  			<input oninput="this.className = ''" type= "text" form="updateInfoForm" name="citizenship" value="<?php echo $result['citizenship']?>">
			  	  		</div>
				  	</div>
				</div>
			</div>
			<div class="tab">
			  								  	<div class="row">
							  		<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								  		<div class="form-group">
							  	  			<label>Father's Name</label>
							  	  			<input  onkeypress="return alphaOnly(event)" oninput="this.className = ''" type= "text" name="fathername" value="<?php echo $result['fathername']?>" form="updateInfoForm">
							  	  		</div>
								  	</div>
								  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								  		<div class="form-group">
							  	  			<label>Father's Age</label>
							  	  			<input onkeypress="return isNumber(event)" oninput="this.className = ''" type= "text" name="fatherAge"value="<?php echo $result['fatherAge']?>" form="updateInfoForm">
							  	  		</div>
								  	</div>
								  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								  		<div class="form-group">
							  	  			<label>Father's Work</label>
							  	  			<input onkeypress="return alphaOnly(event)" oninput="this.className = ''" type= "text" name="fatherwork" value="<?php echo $result['fatherwork']?>" form="updateInfoForm">
							  	  		</div>
								  	</div>
							  	</div>
							  	<div class="row">
							  		<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								  		<div class="form-group">
							  	  			<label>Mother's Name</label>
							  	  			<input onkeypress="return alphaOnly(event)" oninput="this.className = ''" type= "text" name="mothername" value="<?php echo $result['mothername']?>"form="updateInfoForm">
							  	  		</div>
								  	</div>
								  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								  		<div class="form-group">
							  	  			<label>Mother's Age</label>
							  	  			<input onkeypress="return isNumber(event)" oninput="this.className = ''" type= "text" name="motherAge"value="<?php echo $result['motherAge']?>" form="updateInfoForm">
							  	  		</div>
								  	</div>
								  	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								  		<div class="form-group">
							  	  			<label>Mother's Work</label>
							  	  			<input  onkeypress="return alphaOnly(event)" oninput="this.className = ''" type= "text" name="motherwork" value="<?php echo $result['motherwork']?>" form="updateInfoForm">
							  	  		</div>
								  	</div>
							  	</div>
							  	<div class="row">
							  		<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
							  			<div class="form-group">
							  				<label>Parents Present Address</label>
							  				<input  oninput="this.className = ''" type= "text" name="parentsAddress" value="<?php echo $result['parentsAddress']?>" form="updateInfoForm">
							  			</div>
							  		</div>
							  		<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
							  			<div class="form-group">
							  				<label>Total Number of Family Member</label>
							  				<input  oninput="this.className = ''" type= "text" name="totalFamMember" onkeypress="return isNumber(event)" value="<?php echo $result['totalFamMember']?>" form="updateInfoForm">
							  			</div>
							  		</div>
							  		<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
							  			<div class="row">
							  				<div class="col-md-6 col-lg-6 col-xs-6 col-sm-6">
							  					<div class="form-group">
									  				<label>Brothers</label>
									  				<input  oninput="this.className = ''" type= "text" name="brothers" onkeypress="return isNumber(event)" value="<?php echo $result['brothers']?>" form="updateInfoForm">
									  			</div>
							  				</div>
							  				<div class="col-md-6 col-lg-6 col-xs-6 col-sm-6">
							  					<div class="form-group">
									  				<label>Sisters</label>
									  				<input  oninput="this.className = ''" type= "text" name="sisters" onkeypress="return isNumber(event)" value="<?php echo $result['sisters']?>" form="updateInfoForm">
									  			</div>
							  				</div>
							  			</div>
							  		</div>
							  	</div>
							  	<div class="row">
							  		<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
								  		<div class="form-group">
							  	  			<label>Family Yearly Gross Income</label>
							  	  			<input  oninput="this.className = ''" type= "number" name="gross" value="<?php echo $result['grosspermonth']?>" form="updateInfoForm">
							  	  		</div>
								  	</div>
							  	</div>
							  	<br>
						  		<h5>Educational Assistance Enjoyed by Brothers/Sisters</h5>
							  	<div class="row">
							  		<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
							  			<label>Name</label><br>
							  			<input type= "text" name="sibling1"value="<?php echo $result['sibling1']?>" form="updateInfoForm"><br><br>
							  			<input type= "text" name="sibling2"value="<?php echo $result['sibling2']?>" form="updateInfoForm"><br><br>
							  			<input type= "text" name="sibling3"value="<?php echo $result['sibling3']?>" form="updateInfoForm">
							  		</div>
							  		<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
							  			<label>Educational Assistance</label><br>
							  			<input type= "text" name="sibling1Scholarship" value="<?php echo $result['sibling1Scholarship']?>" form="updateInfoForm"><br><br>
							  			<input type= "text" name="sibling2Scholarship" value="<?php echo $result['sibling2Scholarship']?>" form="updateInfoForm"><br><br>
							  			<input type= "text" name="sibling3Scholarship" value="<?php echo $result['sibling3Scholarship']?>" form="updateInfoForm">
							  		</div>
							  		<div class="col-md-4 col-lg-4 col-xs-12 col-sm-6">
							  			<label>Course and Year</label><br>
							  			<input type= "text" name="sibling1CourseYear" value="<?php echo $result['sibling1CourseYear']?>"form="updateInfoForm"><br><br>
							  			<input type= "text" name="sibling2CourseYear" value="<?php echo $result['sibling2CourseYear']?>" form="updateInfoForm"><br><br>
							  			<input type= "text" name="sibling3CourseYear" value="<?php echo $result['sibling3CourseYear']?>" form="updateInfoForm"><br><br>
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
			</div>
		</div>
	</div>
</div>
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
    document.getElementById("updateInfoForm").submit();
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