<?php
include('../db/db.php');
session_start();

if($_SESSION['studentId'] == "")
{
	header("Location:../examination/");
}
else
{
	$studentId = $_SESSION['studentId'];
	$getInfo = "SELECT * FROM tbl_student where id = ".$studentId;
	$processInfo = $db->query($getInfo);
	$result = $processInfo->fetch_assoc();
	$examType = "";
	if($result['studenttype'] == "Junior High School")
	{
		$examType = "0";
	}
	elseif($result['studenttype'] == "Senior High School")
	{
		$examType = "1";
	}
	else
	{
		$examType = "2";
	}
	$activated = 0; //inactive
	$checkifexamActivated ="SELECT * FROM tbl_exam WHERE examType = ".$examType." AND status = 1";
	$processCheck = $db->query($checkifexamActivated);
	if($processCheck->num_rows > 0)
	{
		$activated = 1;
		$resultExamInfo = $processCheck->fetch_assoc();
		$examId = $resultExamInfo['id'];
	}
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Sto Tomas Batangas</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="../img/logo.jpg" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="../lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="../lib/animate/animate.min.css" rel="stylesheet">
  <link href="../lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <!-- Main Stylesheet File -->
  <link href="../css/sweetalert.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
  <style>
  	body
  	{
  		background-color: gainsboro;
  	}
    .row
    {
      margin-left: 0;
      margin-right: 0;
    }
    #myNav
    {
    	background-color: white;
    	padding: 10px;
    	border-bottom: 2px solid #00C851;
    }
  </style>
</head>
<body>
<div id="myNav">
	<div class="row">
		<div class="col-md-4 col-lg-4">
			<h3 style="margin-top: 10px;">EPS <span class="color-b">Scholarship Examination</span></h3>
		</div>
		<div class="col-md-4 col-lg-4"></div>
		<div class="col-md-4 col-lg-4">
			<div class="pull-right">
				<span>
					<p>
					<img src="../system/profilepicture/<?php echo $result['picture']?>" style="width: 50px;height: 50px;">
					&nbsp;&nbsp;&nbsp;<?php echo $result['firstname']?>
					&nbsp;&nbsp;&nbsp;<a href="logout.php" style="font-size:20px;"><i class="fa fa-sign-out"></i></a>
					</p>
				</span>
			</div>
		</div>
	</div>
</div>
<br>
<div class="mainContainer" style="background-color: white;min-height:500px;padding: 10px;">
	<?php
	if($activated == 0)
	{
		?>	
		<div class="row">
			<div class="col-md-3 col-lg-3"></div>
			<div class="col-md-6 col-lg-6">
				<center>
					<h4>Examination is not yet activated by admin. Please wait for admin to activate it.</h4>
				</center>
			</div>
			<div class="col-md-3 col-lg-3"></div>
		</div>
		<?php
	}
	else
	{
		?><br><br><br>
		<div class="row">
			<div class="col-md-3 col-lg-3"></div>
			<div class="col-md-6 col-lg-6">
				<center>
					<h3>Examination is now activated. Click Start to proceed to examination. You have 60 minutes to answer the examination. Answer each question carefully. Once you've clicked the Start button, you cannot pause the examination. Godbless</h3>
					<small><b>Note : </b> You are not allowed to leave the page. Once you leave the page, your examination will automatically be submitted.</small><br>
					<a href="#" class="btn btn-success btn-lg btnStart">START</a>
				</center>
			</div>
			<div class="col-md-3 col-lg-3"></div>
		</div>
		<?php
	}
	?>
</div>
<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <div id="preloader"></div>

  <!-- JavaScript Libraries -->
  <script src="../lib/jquery/jquery.min.js"></script>
  <script src="../lib/jquery/jquery-migrate.min.js"></script>
  <script src="../lib/popper/popper.min.js"></script>
  <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="../lib/easing/easing.min.js"></script>
  <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="../lib/scrollreveal/scrollreveal.min.js"></script>
  <!-- Contact Form JavaScript File -->
   <script src="../js/sweetalert.min.js"></script>

  <!-- Template Main Javascript File -->
  <script src="../js/main.js"></script>


</body>
</html>
<script>
	$(document).on('click','.btnStart',function(){
		window.location.replace('../');
     	window.open('questions.php?examId=<?php echo $examId?>', '','_blank', 'toolbar=no,menubar=no,directories=no,status=no, scrollbars=no, resizable=no, fullscreen="yes"'); return false; 
	})
</script>