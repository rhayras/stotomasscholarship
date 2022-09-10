<?php
session_start();
if($_SESSION['priviledge'] != "admin")
{
  header("Location:../");
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
  <div class="modal fade bd-example-modal-lg" id="examModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Announcement</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <form method="POST" id="addAnnouncementForm">
            <div class="form-group">
              <label>Who</label>
              <select name="who" id="who" class="form-control" form="addAnnouncementForm">
                <option>All</option>
                  <option>Senior High School</option>
                  <option>College</option>
              </select>
            </div>
            <div class="form-group">
              <label>What</label>
              <textarea class="form-control" name="what" id="what" form="addAnnouncementForm" required></textarea>
            </div>
            <div class="form-group">
              <label>When</label><br>
              <label>Date</label>
              <input type="date" name="whenDate" id="whenDate" form="addAnnouncementForm" style="border: 1px solid gray;" required>
              <label>Time</label>
              <input type="time" name="whenTime" id="whenTime" form="addAnnouncementForm" style="border: 1px solid gray;" required>
            </div>
            <div class="form-group">
              <label>Where</label>
              <textarea class="form-control" name="where" id="where" form="addAnnouncementForm" required></textarea>
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-success pull-right" name="newAnnouncement" id="submit" value="Submit" form="addAnnouncementForm">
            </div>
          </form>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>

      <!--edit modal -->
   <div class="modal fade bd-example-modal-lg" id="editModal">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Edit User</h5>
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