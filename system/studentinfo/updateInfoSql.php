<?php
session_start();
include('../../db/db.php');

$fname=$_POST['fname'];
$mname=$_POST['mname'];
$lname=$_POST['lname'];
$address=$_POST['address'];
$bday=$_POST['bday'];
$bplace=$_POST['bplace'];
$religion=$_POST['religion'];
$gender=$_POST['gender'];
$age=$_POST['age'];
$email=$_POST['email'];
$mobileno=$_POST['mobileno'];
$fathername =$_POST['fathername'];
$fatherAge=$_POST['fatherAge'];
$fatherwork=$_POST['fatherwork'];
$mothername=$_POST['mothername'];
$motherAge=$_POST['motherAge'];
$motherwork=$_POST['motherwork'];
$gross=$_POST['gross'];
$studentId=$_POST['studentId'];


$parentsAddress=$_POST['parentsAddress'];
$totalFamMember=$_POST['totalFamMember'];
$brothers=$_POST['brothers'];
$sisters=$_POST['sisters'];

$sibling1	=$_POST['sibling1'];
$sibling2	=$_POST['sibling2'];
$sibling3	=$_POST['sibling3'];

$sibling1Scholarship	=$_POST['sibling1Scholarship'];
$sibling2Scholarship	=$_POST['sibling2Scholarship'];
$sibling3Scholarship	=$_POST['sibling3Scholarship'];

$sibling1CourseYear	=$_POST['sibling1CourseYear'];
$sibling2CourseYear	=$_POST['sibling2CourseYear'];
$sibling3CourseYear	=$_POST['sibling3CourseYear'];

$citizenship	=$_POST['citizenship'];



$update = "UPDATE tbl_student set
			firstname = '".$fname."', 
			middlename = '".$mname."',
			surname = '".$lname."',
			address = '".$address."',
			bday = '".$bday."',
			bplace = '".$bplace."',
			religion = '".$religion."',
			gender = '".$gender."',
			age = '".$age."',
			email = '".$email."',
			contactno = '".$mobileno."',
			fathername = '".$fathername."',
			fatherAge = '".$fatherAge."',
			fatherwork = '".$fatherwork."',
			mothername = '".$mothername."',
			motherAge = '".$motherAge."',
			motherwork = '".$motherwork."',
			grosspermonth = '".$gross."',
			parentsAddress = '".$parentsAddress."',
			totalFamMember = '".$totalFamMember."',
			brothers = '".$brothers."',
			sibling1 = '".$sibling1."',
			sibling2 = '".$sibling2."',
			sibling3 = '".$sibling3."',
			sibling1Scholarship = '".$sibling1Scholarship."',
			sibling2Scholarship = '".$sibling2Scholarship."',
			sibling3Scholarship = '".$sibling3Scholarship."',
			sibling1CourseYear = '".$sibling1CourseYear."',
			sibling2CourseYear = '".$sibling2CourseYear."',
			sibling3CourseYear = '".$sibling3CourseYear."',
			citizenship = '".$citizenship."'
			WHERE id = ".$studentId;
$process = $db->query($update);
if($process)
{
	?>
    <script>
    	alert("Personal Information updated!");
    	window.location.href = '../studentinfo';
    </script>
    <?php
}
else
{
	echo $update;
}