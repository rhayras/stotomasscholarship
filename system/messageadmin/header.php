<?php
session_start();
include('../../db/db.php');
if($_SESSION['priviledge'] != "student")
{
header("Location:../");
}
  $getStudentInfo = "SELECT * FROM tbl_student where id = ".$_SESSION['studentId']."";
  $process = $db->query($getStudentInfo);
  $result = $process->fetch_assoc();
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
  <link href="../../img/logo.jpg" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="../../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="../../lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="../../lib/animate/animate.min.css" rel="stylesheet">
  <link href="../../lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="../../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <!-- Main Stylesheet File -->
   <link href="../../css/sweetalert.css" rel="stylesheet">
  <link href="../../css/style.css" rel="stylesheet">

  <style>
    <?php
    include('style.php');
    ?>
    body
    {
      background-image: linear-gradient(to top, #a5d6a7 , #a5d6a7 );
    }
    .row
    {
      margin-right: 0;
      margin-left: 0;
    }
    .btn-custom
    {
      background-color: #007E33;
      padding: 15px;

    }
    .btn-custom:hover
    {
      background-color: #00C851;

    }
    #menuContainer
    {
      background-color: white;
      padding: 10px;
      border-radius: 10px;
      border:1px solid #00C851;
      height:485px;
    }

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
  .divContainer
  {
    background-color: #f5f5f5;
    width: 100%;
    height: 450px;
    overflow-y: scroll;
  }
  #individual
  {
    padding: 5px;
    border:1px solid #00C851;
    cursor: pointer;
  }
  #individual img
  {
    height: 40px;
    width: 40px;
    border-radius: 50px;
  }
  .dot {
    height: 10px;
    width: 10px;
    border-radius: 50%;
    display: inline-block;
  }
  .active
  {
    background-image: linear-gradient(to top, #a5d6a7 , #a5d6a7 );
    color: white;
  }
  #convoAdmin {
    overflow-y: scroll;width:100%;height:345px;border-top:1px solid gainsboro;border-left:1px solid gainsboro;border-right:1px solid gainsboro;padding:10px;margin-bottom:5px;
    line-height: 1.4em;
  }
  #convoStudent
  {
       overflow-y: scroll;width:100%;height:345px;border-top:1px solid gainsboro;border-left:1px solid gainsboro;border-right:1px solid gainsboro;padding:10px;margin-bottom:5px;
    line-height: 1.4em;
  }
  .effect1{
    -webkit-box-shadow: 0 10px 6px -6px #777;
       -moz-box-shadow: 0 10px 6px -6px #777;
            box-shadow: 0 10px 6px -6px #777;
}
</style>
</head>
</head>
<body>
    <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
    <div class="container">
      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault"
        aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <img src="../../img/epslogo.png" style="width: 80px;height: 80px;">&nbsp;&nbsp;&nbsp;<a class="navbar-brand text-brand" href="../index.php">EPS <span class="color-b">Scholarship</span></a>
      <button type="button" class="btn btn-link nav-search navbar-toggle-box-collapse d-md-none" data-toggle="collapse"
        data-target="#navbarTogglerDemo01" aria-expanded="false">
      </button>
      <div class="navbar navbar-collapse collapse justify-content-end" id="navbarDefault">
        <div class="pull-right" style="ma">
          <ul class="navbar-nav">
            <li class="nav-item">
              <img src="../profilepicture/<?php echo $result['picture']?>" style="width:50px;height: 50px;border-radius: 50px;margin-top:10px;">
            </li>
            <li class="nav-item">
              <p style="margin-top: 20px;"><?php echo $result['firstname']?></p>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="../" style="margin-top: 10px;"> Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../logout.php" style="margin-top: 10px;"> Logout</a>
            </li>
          </ul>
        </div>
        
      </div>
    </div>
  </nav><br><br><br><br>