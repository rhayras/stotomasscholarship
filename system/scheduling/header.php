<?php
session_start();
include('../../db/db.php');
if($_SESSION['priviledge'] != "admin")
{
  header("Location:../");
}
$getCurrent = "SELECT * FROM tbl_currentyear";
$processCurrent = $db->query($getCurrent);
$resultCurrent = $processCurrent->fetch_assoc();
$schyear = $resultCurrent['schyear'];
$sem = $resultCurrent['semester'];
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
  <link href="../../lib/bootstrap/css/bootstrap.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="../../lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="../../lib/animate/animate.min.css" rel="stylesheet">
  <link href="../../lib/ionicons/css/ionicons.min.css" rel="stylesheet">
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
    #calendarContainer
    {
      background-color: white;
      padding: 10px;
      border-radius: 10px;
      border:1px solid #00C851;
      height:485px;
    }
    .navbar-default {
     
     padding-top: 10px;
     padding-bottom: 10px;
   }
   .table-scroll thead > tr > th {
   }
/*  .dataTables_paginate a
  {
    background-color:#00C851;
    color: white;
    }*/


  </style>
  <div class="modal fade bd-example-modal-lg" id="addsched">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Add Schedule</h5>
                  <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
              </div>
              <div class="modal-body ">
                  <form method="POST" id="schedForm"></form>
                  <input type="hidden" name="schyear" form="schedForm" value="<?php echo $schyear?>">
                  <input type="hidden" name="sem" form="schedForm" value="<?php echo $sem?>">
                  <div class="form-group">
                    <label>For </label>
                    <select name="forwhat" id="forwhat" class="form-control" form="schedForm">
                      <option></option>
                        <option>Examination</option>
                        <option>Interview</option>
                        <option>Orientation</option>
                        <option>Releasing of Grant</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Student Level </label>
                    <select name="studentlevel" id="studentlevel" class="form-control" form="schedForm">
                      <option value="0">All</option>
                        <option value="1">Senior High School</option>
                        <option value="2">College</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Date</label>
                    <input type="date" class="form-control" name="myDate" id="dateTime" form="schedForm">
                  </div>
                  <div class="form-group">
                    <label>Time</label>
                    <input type="time" class="form-control" name="myTime" id="dateTime" form="schedForm">
                  </div>
                  <div class="form-group">
                    <div class="pull-right">
                      <input type="submit" name="setSched" value="Set Schedule" class="btn btn-success" form="schedForm">
                    </div>
                  </div>
              </div>
              <div class="modal-footer">

              </div>
          </div>
      </div>
  </div>

    <div class="modal fade bd-example-modal-lg" id="editModal">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Edit Schedule</h5>
                  <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
              </div>
              <div class="modal-body formedithere">

              </div>
              <div class="modal-footer">

              </div>
          </div>
      </div>
  </div>
</head>
<body>
  <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top"  style="padding-bottom:1px;margin-bottom:">
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
        <img src="../../img/admin.png" style="width:50px;height: 50px;border-radius: 50px;margin-top:10px;">
      </li>
      <li class="nav-item">
        <p style="margin-top: 20px;"><?php echo $_SESSION['name']?></p>
      </li>
      <li class="nav-item" style="margin-top: 10px;">
        <a href="../index.php" class="nav-link" title="Home">Home</a>
      </li>
      <li class="nav-item" style="margin-top: 10px;">
        <a href="../logout.php" class="nav-link" title="Logout">Logout</a>
      </li>
    </ul>
  </div>
  
</div> 
</div>
</nav><br><br><br><br>