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
   #myTh
   {
    padding: 1px;text-align: center;font-weight: normal;font-family: arial;font-size: 13px;
   }
/*  .dataTables_paginate a
  {
    background-color:#00C851;
    color: white;
    }*/


  </style>
        <div class="modal fade bd-example-modal-lg" id="filterModal">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Filter Scholars</h5>
              </div>
              <form method="POST" id="filterForm"></form>
              <div class="modal-body formedithere">
                  <div class="row">
                      <div class="col-md-12 col-lg-12">
                        <form method="POST" id="filterForm"></form>
                        <center>
                          <table class="table-bordered" id="filtertable">
                          <thead style="background-color:#4caf50;color: white;">
                            <th id='myTh'>Student Type</th>
                            <th id='myTh'>School</th>
                            <th id='myTh'>Scholarship Type</th>
                            <th id='myTh'>Grade/Year Level</th>
                            <th id='myTh'>Surname</th>
                            <th id='myTh'>First Name</th>
                          </thead>
                          <tbody style="font-size: 12px;">
                            <tr>
                              <td style="padding: 1px;">
                                <select name="studenttype" id="studenttype" form="filterForm"  style="width: 100%;">
                                  <option></option>
                                  <?php
                                  $sql = "SELECT DISTINCT studenttype from tbl_student  WHERE status IN(4,7) ".$sqlFilter."";
                                  $process = $db->query($sql);
                                  if($process->num_rows > 0)
                                  {
                                    while($result = $process->fetch_assoc())
                                    {
                                    ?>
                                      <option <?php if($studenttype == $result['studenttype']){echo 'selected';}?>><?php echo $result['studenttype']?></option>
                                    <?php
                                    }
                                  }
                                  ?>
                                </select>
                              </td>
                              <td style="padding: 1px;">
                                <select name="schoolname" id="schoolname" form="filterForm" style="width: 100%;" >
                                  <option></option>
                                  <?php
                                  $sql = "SELECT DISTINCT school from tbl_student  WHERE status IN(4,7) ".$sqlFilter."";
                                  $process = $db->query($sql);
                                  if($process->num_rows > 0)
                                  {
                                    while($result = $process->fetch_assoc())
                                    {
                                      $getSchools = "SELECT schoolname FROM tbl_school WHERE id= ".$result['school'];
                                      $processSchools = $db->query($getSchools);
                                      $resultSchool = $processSchools->fetch_assoc();
                                      ?>
                                      <option value='<?php echo $result['school']?>' <?php if($schoolid == $result['school']){echo 'selected';}?>><?php echo $resultSchool['schoolname']?></option>
                                    <?php
                                    }
                                  }
                                  ?>
                                </select>
                              </td>
                              <td style="padding: 1px;">
                                <select name="studentScholarshipType" id="studentScholarshipType" form="filterForm"  style="width: 100%;" >
                                  <option></option>
                                  <?php
                                  $sql = "SELECT DISTINCT scholarType from tbl_student  WHERE status IN(4,7) ".$sqlFilter."";
                                  $process = $db->query($sql);
                                  if($process->num_rows > 0)
                                  {
                                    while($result = $process->fetch_assoc())
                                    {
                                      if($result['scholarType'] == 1)
                                      {
                                        $studentScholarshipType = 'Assistance';
                                      }else {$studentScholarshipType = 'Full Scholarship';}
                                      ?>
                                      <option value='<?php echo $result['scholarType']?>' <?php if($scholartype == $result['scholarType']){echo 'selected';}?>><?php echo $studentScholarshipType?></option>
                                      <?php
                                    }
                                  }
                                  ?>
                                </select>
                              </td>
                              <td style="padding: 1px;">
                                <select name="gradeyear" id="gradeyear" form="filterForm"  style="width: 100%;" >
                                  <option></option>
                                  <?php
                                  $sql = "SELECT DISTINCT yearOrgrade from tbl_student  WHERE status IN(4,7) ".$sqlFilter."";
                                  $process = $db->query($sql);
                                  if($process->num_rows > 0)
                                  {
                                    while($result = $process->fetch_assoc())
                                    {
                                      ?>
                                      <option value='<?php echo $result['yearOrgrade']?>' <?php if($gradeOrYear == $result['yearOrgrade']){echo 'selected';}?>><?php echo $result['yearOrgrade']?></option>
                                      <?php
                                    }
                                  }
                                  ?>
                                </select>
                              </td>
                              <td style="padding: 1px;">
                                <input type="text" name="surname" id="surname" list='surnamelist' form="filterForm" value="<?php echo $surname?>"  style="width: 100%;">
                                <datalist id="surnamelist">
                                  <?php
                                  $sql = "SELECT DISTINCT surname from tbl_student  WHERE status IN(4,7) ".$sqlFilter."";
                                  $process = $db->query($sql);
                                  if($process->num_rows > 0)
                                  {
                                    while($result = $process->fetch_assoc())
                                    {
                                      echo
                                      "<option>".$result['surname']."</option>";
                                    }
                                  }
                                  ?>
                                </datalist>
                              </td>
                              <td style="padding: 1px;">
                                <input type="text" name="firstname" id="firstname" list='namelist' form="filterForm"  value="<?php echo $firstname?>"  style="width: 100%;">
                                <datalist id="namelist">
                                  <?php
                                  $sql = "SELECT DISTINCT firstname from tbl_student WHERE status IN(4,7) ".$sqlFilter."";
                                  $process = $db->query($sql);
                                  if($process->num_rows > 0)
                                  {
                                    while($result = $process->fetch_assoc())
                                    {
                                      echo
                                      "<option>".$result['firstname']."</option>";
                                    }
                                  }
                                  ?>
                                </datalist>
                              </td>
                            </tr>
                          </tbody>
                          </table>
                        </center>
                      </div>
                    </div>
              </div>
             <div class="row">
               <div class="col-md-4 col-lg-4"></div>
               <div class="col-md-4 col-lg-4">
                  <center>
                    <input type="submit" name="submit" form="filterForm" class="btn btn-success btn-sm" value="Search">
                    <button id="clrBtn" class="btn btn-danger btn-sm " data-dismiss="modal">Close</button>
                  </center>
               </div>
               <div class="col-md-4 col-lg-4"></div>
             </div><br>
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