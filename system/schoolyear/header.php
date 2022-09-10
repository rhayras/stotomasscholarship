<?php
session_start();
include('../../db/db.php');
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
<script>
    function goLastMonth(month,year){
      if (month == 1){
        --year;
        month=13;
      }
      --month;
      var monthstring=""+month+"";
      var monthlength =monthstring.length;
      if (monthlength<-1){
        monthstring = "0"+monthstring;
      }
      $.ajax({
        url     :   '../php/calendar.php',
        method  :   'GET',
        data    :   {month:monthstring,year:year},
        success :   function(data)
        {
          $('#companyCalendar').html(data);
        }
      })
    }
    function goNextMonth(month,year){
      if (month == 12){ 
        ++year;
        month = 0;
      }
      ++month;
      var monthstring=""+month+"";
      var monthlength =monthstring.length;
      if (monthlength<-1){
        monthstring = "0"+monthstring;
      }
      $.ajax({
        url     :   '../php/calendar.php',
        method  :   'GET',
        data    :   {month:monthstring,year:year},
        success :   function(data)
        {
          $('#companyCalendar').html(data);
        }
      })
    }

</script>
      <div class="modal fade bd-example-modal-lg" id="applicationModal">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Add Application Date</h5>
                      <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                  </div>
                  <div class="modal-body">
                      <form action="" method="POST" id="applicationForm">
                        <?php
                        $getSchYear = "SELECT * FROM tbl_currentyear";
                        $processSchyear = $db->query($getSchYear);
                        if($processSchyear->num_rows > 0)
                        {
                          $result = $processSchyear->fetch_assoc();
                        }
                        ?>
                        <input type="hidden" name="schyear" id="schyear" value="<?php echo $result['schyear']?>" form="applicationForm">
                        <input type="hidden" name="semester" id="semester" value="<?php echo $result['semester']?>" form="applicationForm">
                          <div class="form-group">
                              <label>Student Type</label>
                              <select name="scholartype" id="scholartype" class="form-control" form="applicationForm" required>
                                  <option></option>
                                  <option value="1">Senior High School</option>
                                  <option value="2">College</option>
                              </select>
                          </div>
                          <div class="form-group">
                            <label>Start Date</label>
                            <input type="date" name="startdate" id="startdate" class="form-control" form="applicationForm" required>
                          </div>
                          <div class="form-group">
                            <label>End Date</label>
                            <input type="date" name="enddate" id="enddate" class="form-control" form="applicationForm" required>
                          </div>
                          <div class="form-group">
                            <input type="submit" class="btn btn-success pull-right" name="applyAdd" id="submit" value="Submit" form="applicationForm">
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
                      <h5 class="modal-title">Edit Application Date</h5>
                      <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                  </div>
                  <div class="modal-body formedithere">

                  </div>
                  <div class="modal-footer">

                  </div>
              </div>
          </div>
      </div>


      <!-- RENEWAL DATE-->
      <div class="modal fade bd-example-modal-lg" id="renewalModal">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Add Submission Date</h5>
                      <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                  </div>
                  <div class="modal-body">
                      <form action="" method="POST" id="submissionForm">
                        <?php
                        $getSchYear = "SELECT * FROM tbl_currentyear";
                        $processSchyear = $db->query($getSchYear);
                        if($processSchyear->num_rows > 0)
                        {
                          $result = $processSchyear->fetch_assoc();
                        }
                        ?>
                        <input type="hidden" name="schyear" id="schyear" value="<?php echo $result['schyear']?>" form="submissionForm">
                        <input type="hidden" name="semester" id="semester" value="<?php echo $result['semester']?>" form="submissionForm">
                          <div class="form-group">
                              <label>Student Type</label>
                              <select name="scholartype" id="scholartype" class="form-control" form="submissionForm" required>
                                  <option></option>
                                  <option value="1">Senior High School</option>
                                  <option value="2">College</option>
                              </select>
                          </div>
                          <div class="form-group">
                            <label>Start Date</label>
                            <input type="date" name="startdate" id="startdate" class="form-control" form="submissionForm" required>
                          </div>
                          <div class="form-group">
                            <label>End Date</label>
                            <input type="date" name="enddate" id="enddate" class="form-control" form="submissionForm" required>
                          </div>
                          <div class="form-group">
                            <input type="submit" class="btn btn-success pull-right" name="submissionAdd" id="submit" value="Submit" form="submissionForm">
                          </div>
                      </form>
                  </div>
                  <div class="modal-footer">

                  </div>
              </div>
          </div>
      </div>

      <!-- start new modal -->
      <div class="modal fade bd-example-modal-lg" id="startNewModal">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Start New Scholarship</h5>
                      <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                  </div>
                  <div class="modal-body ">
                    <?php
                    $sql = "SELECT * FROM tbl_currentyear WHERE status = 2";
                    $process = $db->query($sql);
                    $result = $process->fetch_assoc();


                    ?>
                    <h5>Previous Scholarship</h5>
                    <p><?php echo $result['schyear']." / ".$result['semester']?></p>
                    <form method="POST" id="startForm"></form>
                    <div class="form-group">
                      <label>School Year</label>
                      <div class="row">
                        <div class="col-md-6 col-lg-6 col-xs-6 col-sm-6">
                          From
                          <select name="fromYear" id="fromYear" class="form-control" form="startForm" required>
                            <option></option>
                            <option>2018</option><option>2019</option><option>2020</option>
                            <option>2021</option><option>2022</option><option>2023</option>
                            <option>2024</option><option>2025</option><option>2026</option>
                          </select>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xs-6 col-sm-6">
                          To
                          <select name="toYear" id="toYear" class="form-control" form="startForm" required>
                            <option></option>
                            <option>2018</option><option>2019</option><option>2020</option>
                            <option>2021</option><option>2022</option><option>2023</option>
                            <option>2024</option><option>2025</option><option>2026</option>
                          </select>
                        </div>
                      </div>
                      <!-- <input type="text" name="schyear" id="schyear" class="form-control" form="startForm" required> -->
                    </div>
                    <div class="form-group">
                      <label>Semester</label>
                      <select name="semester" id="semester" class="form-control" form="startForm"required>
                        <option>1st Semester</option>
                        <option>2nd Semester</option>
                      </select>
                    </div>
                    <div class="form-group pull-right">
                      <input type="submit" name="startNewSemester" id="startNewSemester" form="startForm" value="Start New Scholarship" class="btn btn-success">
                    </div>
                  </div>
                  <div class="modal-footer">

                  </div>
              </div>
          </div>
      </div>
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