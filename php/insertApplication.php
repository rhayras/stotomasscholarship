  <link href="../css/sweetalert.css" rel="stylesheet">
 <script src="../js/sweetalert.min.js"></script>
<?php

include('../db/db.php');


$studentLevel = $_POST['studentLevel'];
$school =$_POST['school'];
$schyear=$_POST['schyear'];
$semester=$_POST['semester'];
$gradeyear=$_POST['gradeyear'];
$course=$_POST['course'];
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
$fatherwork=$_POST['fatherwork'];
$mothername=$_POST['mothername'];
$motherwork=$_POST['motherwork'];
$gross=$_POST['gross'];
$username=$_POST['username'];
$password	=$_POST['password'];

$lastSchoolAttended	=$_POST['lastSchoolAttended'];
$lastSchoolAddress	=$_POST['lastSchoolAddress'];
$highestYear	=$_POST['highestYear'];
$lastGwa	=$_POST['lastGwa'];
$schoolEntranceExam	=$_POST['schoolEntranceExam'];
$parentsAddress	=$_POST['parentsAddress'];
$totalFamMember	=$_POST['totalFamMember'];
$brothers	=$_POST['brothers'];
$sisters	=$_POST['sisters'];
$otherScholarship	=$_POST['otherScholarship'];


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
$fatherAge	=$_POST['fatherAge'];
$motherAge	=$_POST['motherAge'];


	
$targetfolder = "../system/profilepicture/";
$targetfolder = $targetfolder . basename( $_FILES['file']['name']) ;
$fileName = basename( $_FILES['file']['name']);
	
//check if student exist
$check = "SELECT * FROM tbl_student where firstname LIKE '".$fname."' AND middlename LIKE '".$mname."' AND surname LIKE '".$lname."' and status NOT IN (3,5)";
$process = $db->query($check);
if($process->num_rows > 0)
{
	?>
     <script>
     	alert("You already have account.Kindly sign in to your account to see your status.");
     	window.location.href = '../';
    </script>
  <?php
}
else
{
	if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder))
    {
    	//insert student
		$insert = "INSERT INTO tbl_student
					(firstname,middlename,surname,address,bday,age,bplace,contactno,email,gender,religion,fathername,fatherwork,mothername,motherwork,grosspermonth,studenttype,semester,schoolyear,school,course,yearOrgrade,dateapplied,year,month,status,lastSchoolAttended,lastSchoolAddress,highestYear,lastGwa,schoolEntranceExam,parentsAddress,totalFamMember,brothers,sisters,otherScholarship,sibling1,sibling2,sibling3,sibling1Scholarship,sibling2Scholarship,sibling3Scholarship,sibling1CourseYear,sibling2CourseYear,sibling3CourseYear,picture,citizenship,fatherAge,motherAge) VALUES 
					('".$fname."','".$mname."','".$lname."','".$address."','".$bday."','".$age."','".$bplace."','".$mobileno."','".$email."','".$gender."','".$religion."','".$fathername."','".$fatherwork."','".$mothername."','".$motherwork."','".$gross."','".$studentLevel."','".$semester."','".$schyear."','".$school."','".$course."','".$gradeyear."','".date('Y-m-d')."','".date('Y')."','".date('m')."',0,'".$lastSchoolAttended."','".$lastSchoolAddress."','".$highestYear."','".$lastGwa."','".$schoolEntranceExam."','".$parentsAddress."','".$totalFamMember."','".$brothers."','".$sisters."','".$otherScholarship."','".$sibling1."','".$sibling2."','".$sibling3."','".$sibling1Scholarship."','".$sibling2Scholarship."','".$sibling3Scholarship."','".$sibling1CourseYear."','".$sibling2CourseYear."','".$sibling3CourseYear."','".$fileName."','".$citizenship."','".$fatherAge."','".$motherAge."')";
		$processInsert = $db->query($insert);
		if($processInsert)
		{	
			$id = $db->insert_id;

	        $sqlKey = "SELECT * FROM tbl_apikey";
	        $processKey = $db->query($sqlKey);
	        $resultKey = $processKey->fetch_assoc();
	        $theKey = $resultKey['apiKey'];
	        //get number 
	        $sqlNumber = "SELECT contactno FROM tbl_student WHERE id = ".$id;
	        $processNumber = $db->query($sqlNumber);
	        $resultNumber = $processNumber->fetch_assoc();
	        $contactNo = $resultNumber['contactno'];

	       	$message = "Good Day! Your account user name is ".$username." and password is ".$password.". This message is from EPS Scholarship.";
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

			//insert account
			$insertAcount = "INSERT INTO tbl_account (username,password,priviledge,studentId,status)
				VALUES('".$username."','".$password."','student',".$id.",0)";
			$processAccount = $db->query($insertAcount);
			if($insertAcount)
			{

				?>
			    <script>
			    	//alert("Sign in your account to submit your requirements.");
			    	window.location.href = '../downloadApplicationForm.php?studentId=<?php echo $id?>';
			    </script>
			    <?php
			}
		}
		else
		{
		    echo $insert;
		}
    }
	
}

	
	
		
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
