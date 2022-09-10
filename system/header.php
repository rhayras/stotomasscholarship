<?php
session_start();

if($_SESSION['priviledge'] == "")
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
    border:1px solid white;
    font-size: 18px;
  }
  .btn-custom:hover
  {
    background-color: #00C851;

  }
  #menuContainer
  {
    background-color: transparent !important;
    padding: 10px;
    border-radius: 10px;
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
  .open-button {
  background-color: #555;
  color: white;
  padding: 10px;
  border: none;
  cursor: pointer;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
  border-radius:60px;
  width:80px;
  z-index: 1;
}

/* The popup chat - hidden by default */
.chat-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  z-index: 9;
  width: 300px;
}

/* Add styles to the form container */
.form-container {
  background-color: white;
}

/* Full-width textarea */
.form-container textarea {
  width: 100%;  
  border: none;
  resize: none;
}

/* When the textarea gets focus, do something */
.form-container textarea:focus {
  outline: none;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
 #convoStudent
  {
   overflow-y: scroll;width:100%;height:200px;border-top:1px solid gainsboro;border-left:1px solid gainsboro;border-right:1px solid gainsboro;padding:10px;margin-bottom:5px;
    line-height: 1.4em;
  }
<?php
  include('btncss.css');
?>
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
      <div class="modal fade bd-example-modal-lg" id="examModal">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Add Examination</h5>
                      <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                  </div>
                  <div class="modal-body"><br>
                      <form action="php/addExam.php" method="POST" id="examForm">
                          <div class="form-group">
                            <label>Examination Type</label>
                            <select name="examtype" id="examtype" class="form-control" form="examForm" required>
                                <option></option>
                                <option value="0">Junior High School</option>
                                <option value="1">Senior High School</option>
                                <option value="2">College</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Total Number of Items</label>
                            <input type="number" name="totalcount" id="totalcount" class="form-control" min="1" form="examForm" required>
                          </div>
                          <div class="form-group">
                            <label>Passing Score</label>
                            <input type="number" name="passingscore" id="passingscore" class="form-control" min="1" form="examForm" required>
                          </div>
                          <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="submit" id="submit" value="Submit" form="examForm">
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
      <img src="../img/epslogo.png" style="width: 80px;height: 80px;">&nbsp;&nbsp;&nbsp;<a class="navbar-brand text-brand" href="index.php">EPS <span class="color-b">Scholarship</span></a>
      <button type="button" class="btn btn-link nav-search navbar-toggle-box-collapse d-md-none" data-toggle="collapse"
        data-target="#navbarTogglerDemo01" aria-expanded="false">
      </button>
      <div class="navbar navbar-collapse collapse justify-content-end" id="navbarDefault">
        <div class="pull-right">
          <ul class="navbar-nav">
            <li class="nav-item">
              <?php 
                if($_SESSION['priviledge'] == "admin")
                {
                 ?>
                    <img src="../img/admin.png" style="width:50px;height: 50px;border-radius: 50px;margin-top:10px;">
                 <?php
                }
                else
                {
                  $getInfo = "SELECT picture FROM tbl_student WHERE id = ".$_SESSION['studentId']."";
                  $processInfo = $db->query($getInfo);
                  $resultInfo = $processInfo->fetch_assoc();
                  ?>
                    <img src="profilepicture/<?php echo $resultInfo['picture']?>" style="width:50px;height: 50px;border-radius: 50px;margin-top:10px;">
                 <?php
                }
                ?>
            </li>
            <li class="nav-item">
              <p style="margin-top: 20px;" class="hidden-sm hidden-xs">
                <?php 
                if($_SESSION['priviledge'] == "admin")
                {
                   echo $_SESSION['name'];
                }
                else
                {
                  $getInfo = "SELECT firstname,surname FROM tbl_student WHERE id = ".$_SESSION['studentId']."";
                  $processInfo = $db->query($getInfo);
                  $resultInfo = $processInfo->fetch_assoc();
                  echo $resultInfo['firstname'];
                }
                ?>
                  
                </p>
            </li>
            <li class="nav-item" style="margin-top: 10px;">
              <a href="../system" class="nav-link" title="Home">Home</a>
            </li>
            <li class="nav-item" style="margin-top: 10px;">
              <a href="logout.php" class="nav-link" title="Logout">Logout</a>
            </li>
          </ul>
        </div>
        
      </div>
    </div>
  </nav><br><br><br><br>