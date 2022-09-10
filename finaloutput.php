<?php
include('db/db.php');
session_start();

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
  <link href="img/logo.jpg" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->

  <link href="css/sweetalert.css" rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet">
  <!-- loing modal -->
  <div class="modal fade bd-example-modal-lg" id="loginModal">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">EPS <span class="color-b">Scholarship</span></h5>
                      <button type="button" class="close" data-dismiss="modal" id="closeModal"><span>&times;</span></button>
                  </div>
                  <div class="modal-body">
                    <p>Sign In your account here.</p>
                    <p id="errormessage" style="color: red;"></p>
                      <form action="" method="POST" id="loginForm"></form>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" id="username" class="form-control" form="loginForm" />
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" id="password" class="form-control" form="loginForm" />
                        </div>
                        <div class="row">
                          <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                            <input type="submit" name="login" id="btnLogin" class="btn btn-success" value="LOGIN" style="width: 100%;" form="loginForm" >
                          </div>
                          <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                            <button class="btn btn-default" style="width: 100%" id="cancelBtn">CANCEL</button>
                          </div>
                        </div>
                  </div>
                  <div class="modal-footer">

                  </div>
              </div>
          </div>
      </div>
      <style>
        <?php
          include('system/style.php');
        ?>
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
</head>

<body>

  <div class="click-closed"></div>
  <?php
include("footerscripts.php");

$id = $_GET['id'];

$getStudentInfo = "SELECT * FROM tbl_student where id = ".$id."";
$process = $db->query($getStudentInfo);
$result = $process->fetch_assoc();

$getAccount = "SELECT * FROM tbl_account where studentId = ".$id."";
$processAccount = $db->query($getAccount);
$resultAcct = $processAccount->fetch_assoc();
?>
<br><br>
<br><br>
<div class="row">
	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
	</div>
	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
		<center><h3>Thank You For Joining Us!</h3>
			<p>Now you have to sign in with your account. You need to upload PDF file of your requirements for your application. Your username is <?php echo $resultAcct['username']?> and your password is <?php echo $resultAcct['password']?><br><br>Thanks and Godbless.</p></center>
	</div>
	<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
	</div>
</div>