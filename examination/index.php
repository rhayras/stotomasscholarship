<?php
include('../db/db.php');
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
    .row
    {
      margin-left: 0;
      margin-right: 0;
    }
  </style>
</head>
<body>
<center>
  <img src="../img/logo.jpg">
  <p style="font-size: 25px;">EPS Scholarship Examination</p>
</center>
<div class="row">
  <div class="col-md-4 col-lg-4"></div>
  <div class="col-md-4 col-lg-4">
     <form method="POST" id="loginForm"></form>
      <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" id="username" form="loginForm" class="form-control">
      </div>
     <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" id="password" form="loginForm" class="form-control">
      </div>
      <div class="form-group">
        <input type="submit" name="login" id="login" form="loginForm" class="btn btn-success"style="width: 100%;" value="Sign In">
      </div>
  </div>
  <div class="col-md-4 col-lg-4"></div>
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

<?php
if(isset($_POST['login']))
{
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    $loginQuery = "SELECT * FROM tbl_account WHERE username = '".$username."' AND password = '".$password."' AND status = 0";
    $processLogin = $db->query($loginQuery);
    if($processLogin->num_rows > 0)
    {
      //check if already answered
      $resultLogin = $processLogin->fetch_assoc();
      $_SESSION['priviledge'] = $resultLogin['priviledge'];
      $_SESSION['studentId'] = $resultLogin['studentId'];
      $check = "SELECT examstatus FROM tbl_account WHERE studentId = ".$resultLogin['studentId'];
      $processCheck = $db->query($check);
      $resultCheck = $processCheck->fetch_assoc();
      if($resultCheck['examstatus'] != 0)
      {
        ?>
        <script>
          alert("Failed to Login. You already taken this examination");
        </script>
        <?php
      }
      else
      {
          header("Location:examination.php");
      } 
    }
}


?>