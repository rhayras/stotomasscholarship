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

$schyear1 = "";
$sem1 = "";
$getCurrent = "SELECT * FROM tbl_currentyear";
$processCurrent = $db->query($getCurrent);
if($processCurrent->num_rows > 0)
{
  $resultCurrent = $processCurrent->fetch_assoc();
  $schyear1 = $resultCurrent['schyear'];
  $sem1 = $resultCurrent['semester'];
}

$accountSql = "SELECT * FROM `tbl_account` WHERE studentId = ".$_SESSION['studentId']."";
$processAccount = $db->query($accountSql);
if($processAccount->num_rows > 0)
{
  $resultAccount = $processAccount->fetch_assoc();
  $renewstatus = $resultAccount['renewstatus'];
  if($renewstatus == 1)
  {
    if($result['status'] != 7)
    {
         $checkSchoolReq = "SELECT * FROM tbl_schoolrequirements WHERE schoolyear = '".$schyear1."' AND semester = '".$sem1."' AND status = 0 
          AND regform != '' AND gradecard != '' AND schoolid != '' AND studentId = ".$_SESSION['studentId']."";
          $processCheck = $db->query($checkSchoolReq);
          if($processCheck->num_rows > 0)
          {
            $resultCheck = $processCheck->fetch_assoc();
            $student = $resultCheck['studentId'];

            $update = "UPDATE tbl_student SET status = 8 WHERE id = ".$student;
            $processUpdate = $db->query($update);
            
          }
    }
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




      <div class="modal fade bd-example-modal-lg" id="applicationFormModal">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Upload Application Form</h5>
                      <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                  </div>
                  <div class="modal-body">
                      <form action="" method="POST" id="applicationForm" enctype="multipart/form-data">
                        <div class="form-group">
                          <label>Application Form</label>
                          <input type="file" name="file" id="application" form="applicationForm" class="form-control" required accept="application/pdf">
                        </div>
                        <div class="form-group">
                          <input type="submit" name="submitAppForm" class="btn btn-success" form="applicationForm">
                        </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                  </div>
              </div>
          </div>
      </div>

       <div class="modal fade bd-example-modal-lg" id="bcertModal">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Upload Birth Certificate</h5>
                      <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                  </div>
                  <div class="modal-body">
                      <form action="" method="POST" id="bcertForm" enctype="multipart/form-data">
                        <div class="form-group">
                          <label>Birth Certificate</label>
                          <input type="file" name="file" id="bcert" form="bcertForm" class="form-control" required accept="application/pdf">
                        </div>
                        <div class="form-group">
                          <input type="submit" name="submitBcert" class="btn btn-success" form="bcertForm">
                        </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade bd-example-modal-lg" id="form138Modal">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Upload Form 138</h5>
                      <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                  </div>
                  <div class="modal-body">
                      <form action="" method="POST" id="form138Form" enctype="multipart/form-data">
                        <div class="form-group">
                          <label>Form 138</label>
                          <input type="file" name="file" id="bcert" form="form138Form" class="form-control" required accept="application/pdf">
                        </div>
                        <div class="form-group">
                          <input type="submit" name="submitForm138" class="btn btn-success" form="form138Form">
                        </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade bd-example-modal-lg" id="goodMoralModal">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Upload Certificate of Good Moral</h5>
                      <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                  </div>
                  <div class="modal-body">
                      <form action="" method="POST" id="goodMoralForm" enctype="multipart/form-data">
                        <div class="form-group">
                          <label>Certificate of Good Moral</label>
                          <input type="file" name="file" id="goodMoral" form="goodMoralForm" class="form-control" required accept="application/pdf">
                        </div>
                        <div class="form-group">
                          <input type="submit" name="submitGoodMoral" class="btn btn-success" form="goodMoralForm">
                        </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade bd-example-modal-lg" id="houseSketchModal">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Upload Vicinity Map/House Sketch</h5>
                      <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                  </div>
                  <div class="modal-body">
                      <form action="" method="POST" id="houseSketchForm" enctype="multipart/form-data">
                        <div class="form-group">
                          <label>Vicinity Map/House Sketch</label>
                          <input type="file" name="file" id="houseSketch" form="houseSketchForm" class="form-control" required accept="application/pdf">
                        </div>
                        <div class="form-group">
                          <input type="submit" name="submitHouseSketch" class="btn btn-success" form="houseSketchForm">
                        </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade bd-example-modal-lg" id="votersIdModal">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Upload Parents Voter's ID</h5>
                      <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                  </div>
                  <div class="modal-body">
                      <form action="" method="POST" id="votersIdForm" enctype="multipart/form-data">
                        <div class="form-group">
                          <label>Parents Voter's ID</label>
                          <input type="file" name="file" id="votersId" form="votersIdForm" class="form-control" required accept="application/pdf">
                        </div>
                        <div class="form-group">
                          <input type="submit" name="submitVotersId" class="btn btn-success" form="votersIdForm">
                        </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade bd-example-modal-lg" id="parentCertModal">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Upload Certificate of Employement/Unemployment of Parent</h5>
                      <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                  </div>
                  <div class="modal-body">
                      <form action="" method="POST" id="parentCertForm" enctype="multipart/form-data">
                        <div class="form-group">
                          <label>Certificate of Employement/Unemployment of Parent</label>
                          <input type="file" name="file" id="parentCert" form="parentCertForm" class="form-control" required accept="application/pdf">
                        </div>
                        <div class="form-group">
                          <input type="submit" name="submitParentCert" class="btn btn-success" form="parentCertForm">
                        </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade bd-example-modal-lg" id="brgyclearanceModal">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Upload Barangay Clearance</h5>
                      <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                  </div>
                  <div class="modal-body">
                      <form action="" method="POST" id="brgyclearanceForm" enctype="multipart/form-data">
                        <div class="form-group">
                          <label>Barangay Clearance</label>
                          <input type="file" name="file" id="brgyclearance" form="brgyclearanceForm" class="form-control" required accept="application/pdf">
                        </div>
                        <div class="form-group">
                          <input type="submit" name="submitbrgyclearance" class="btn btn-success" form="brgyclearanceForm">
                        </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade bd-example-modal-lg" id="regformModal">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Upload Previous Reg Form</h5>
                      <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                  </div>
                  <div class="modal-body">
                      <form action="" method="POST" id="regForm" enctype="multipart/form-data">
                        <div class="form-group">
                          <label>Previous Reg Form</label>
                          <input type="file" name="file" id="regForm" form="regForm" class="form-control" required accept="application/pdf">
                        </div>
                        <div class="form-group">
                          <input type="submit" name="submitRegForm" class="btn btn-success" form="regForm">
                        </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                  </div>
              </div>
          </div>
      </div>

      <div class="modal fade bd-example-modal-lg" id="gradecardModal">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Upload Previous Grade Card</h5>
                      <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                  </div>
                  <div class="modal-body">
                      <form action="" method="POST" id="gradecard" enctype="multipart/form-data">
                        <div class="form-group">
                          <label>Previous Reg Form</label>
                          <input type="file" name="file" id="file" form="gradecard" class="form-control" required accept="application/pdf">
                        </div>
                        <div class="form-group">
                          <input type="submit" name="submitGradeCard" class="btn btn-success" form="gradecard">
                        </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                  </div>
              </div>
          </div>
      </div>

       <div class="modal fade bd-example-modal-lg" id="schoolidModal">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Upload School ID</h5>
                      <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                  </div>
                  <div class="modal-body">
                      <form action="" method="POST" id="schoolidForm" enctype="multipart/form-data">
                        <div class="form-group">
                          <label>School Id</label>
                          <input type="file" name="file" id="file" form="schoolidForm" class="form-control" required accept="application/pdf">
                        </div>
                        <div class="form-group">
                          <input type="submit" name="submitId" class="btn btn-success" form="schoolidForm">
                        </div>
                      </form>
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