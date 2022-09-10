<?php
include('../db/db.php');
session_start();

if($_SESSION['studentId'] == "")
{
	header("Location:../examination/");
}
	$studentId = $_SESSION['studentId'];
	$examId = $_GET['examId'];
	$getInfo = "SELECT * FROM tbl_student where id = ".$studentId;
	$processInfo = $db->query($getInfo);
	$result = $processInfo->fetch_assoc();
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
  <link href="animate.css" rel="stylesheet">
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
<body oncontextmenu="return false" onselectstart="return false" ondragstart="return false">
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
<div class="row" style="background-color: white;">
  <div class="col-md-4 col-lg-4"></div>
  <div class="col-md-4 col-lg-4"></div>
  <div class="col-md-4 col-lg-4">
    Time Left<p id="timer" style="font-size:40px;font-weight: bold;"></p>
  </div>
</div>
<div class="mainContainer" style="background-color: white;min-height:450px;padding: 10px;margin-top: -50px;">
	<div class="questionDiv">

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
  <script>
    function progress(timeleft, timetotal) {
      $('#timer').html(Math.floor(timeleft/60) + " : "+ timeleft%60);
      if(timeleft > 0) {
          setTimeout(function() {
              progress(timeleft - 1, timetotal);

          }, 1000);
      }
      if(timeleft == 0)
      {
          $.ajax({
            url     :   'updateExamStatusAJAX.php',
            method  :   'POST',
            success :   function(data)
            {
              if(data == 'ok')
              {
                  swal("Times Up! ", "Your time has ended. You will be automatically logged out.", "warning")
                   window.setTimeout(function(){
                      window.location.href = '../examination/';
                  }, 7000);
              }
            }
          })
      }
      if(timeleft <= 20)
      {
        $('#timer').addClass("animated heartBeat");
        $('#timer').css("color",'red');
      }
  };

  progress(3600, 3600);

  function disableF5(e) 
  { if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 18)   e.preventDefault(); 
  };
  </script>
  <script>
  	$(document).ready(function(){

     $(document).on("keydown", disableF5);
  		//get firstquestion
  		var questionNoVar = 1;
  		var examId = "<?php echo $examId?>";
  		var questionNo = questionNoVar;
  		var questionType = "proceed";
  		$.ajax({
  			url	 		: 		'questionsAJAX.php',
  			method 		: 		'POST',
  			data 		: 		{questionId:"",examId:examId,questionNo:questionNo,questionType:questionType},
        beforeSend : function()
        {
          $('.mainContainer').html("<center><img src='../img/loading.gif' style='width:280px;height:200px;margin-top:80px;'></center>");
        },
  			success 	: 		function(data)
  			{
  				$(".mainContainer").html(data);
  				console.log(data);
  				questionNoVar =  questionNoVar +1;
  			}
  		})

  		$(document).on("submit","#questionForm",function(e){
  			e.preventDefault();
  			console.log(questionNoVar);
  			var formdata = $(this).serialize();
  			$.ajax({
  					url 	: 	'insertanswer.php',
  					method 	: 	'POST',
  					data 	: 	formdata,
            beforeSend : function()
            {
              $('.mainContainer').html("<center><img src='../img/loading.gif' style='width:280px;height:200px;margin-top:80px;'></center>");
            },
  					success : 	function(data)
  					{
  						var questionId = data;
				  		var examId = "<?php echo $examId?>";
				  		var questionNo =  questionNoVar;
				  		var questionType = "proceed";
				  		$.ajax({
				  			url	 		: 		'questionsAJAX.php',
				  			method 		: 		'POST',
				  			data 		: 		{questionId:questionId,examId:examId,questionNo:questionNo,questionType:questionType},
				  			success 	: 		function(data)
				  			{
				  				$(".mainContainer").html(data);
				  				questionNoVar =  questionNoVar +1;
				  			}
				  		})
  					}
  			})
  		})
  		$(document).on("click","#prevBtn",function(){
  			questionNoVar =  questionNoVar -2;
  			console.log(questionNoVar);	
	  		var examId = "<?php echo $examId?>";
	  		var questionNo =  questionNoVar;
	  		var questionType = "previous";
	  		var formdata = $("#questionForm").serialize();
	  		var dataFrombtn = $(this).attr("data-id");
  			$.ajax({
				url 	: 	'insertanswer.php',
				method 	: 	'POST',
				data 	: 	formdata,
        beforeSend : function()
        {
          $('.mainContainer').html("<center><img src='../img/loading.gif' style='width:280px;height:200px;margin-top:80px;'></center>");
        },
				success : 	function(data)
				{
			  		if(questionNoVar == 1)
			  		{
		  				var questionId = "";
			  		}
			  		else
			  		{
		  				var questionId = dataFrombtn;
			  		}
			  		$.ajax({
			  			url	 		: 		'questionsAJAX.php',
			  			method 		: 		'POST',
			  			data 		: 		{questionId:questionId,examId:examId,questionNo:questionNo,questionType:questionType},
			  			success 	: 		function(data)
			  			{
			  				$(".mainContainer").html(data);
			  				questionNoVar =  questionNoVar + 1;
			  			}
			  		})
				}
  			})

  		})
  	})
  </script>
<script>

// NO LEAVING PAGE
window.onblur = function() {
  //alert('LOST focus');
     $.ajax({
      url     :   'updateExamStatusAJAX.php',
      method  :   'POST',
      success :   function(data)
      {
        if(data == 'ok')
        {
            swal("Exam Submitted", "Your exam was automatically submitted due to leaving the examination page.", "error")
             window.setTimeout(function(){
                window.location.href = '../examination/';
            }, 7000);
        }
      }
    })
    return false;
}
function verifyAnswers()
{
  //questionForm
    swal({
          title: "Are you sure to submit your answers?",
          text: "You will not be able to retake this examination",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-success",
          confirmButtonText: "Yes",
          cancelButtonText: "No",
          closeOnConfirm: true,
          closeOnCancel: true
        },
        function(isConfirm) {
          if (isConfirm) {
            $('#questionForm').submit();
          } else {
            return false;
          }
        });
}
</script>
</body>
</html>
