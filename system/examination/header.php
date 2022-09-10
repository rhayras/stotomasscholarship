<?php
session_start();

if($_SESSION['priviledge'] == "")
{
  header("Location:../index.php");
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
    overflow-y: scroll;
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
</style>
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
                          <div class="row">
                            <div class="col-md-6 col-lg-6">
                              <div class="form-group">
                                <label>Math Count</label>
                                <input type="number" name="mathcount" id="mathcount" class="form-control" form="examForm" required>
                              </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                              <div class="form-group">
                                <label>English Count</label>
                                <input type="number" name="englishcount" id="englishcount" class="form-control" form="examForm" required>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <center><input type="submit" class="btn btn-primary" name="submit" id="submit" value="Submit" form="examForm"></center>
                          </div>
                      </form>
                  </div>
                  <div class="modal-footer">

                  </div>
              </div>
          </div>
      </div>
       <div class="modal fade bd-example-modal-lg" id="editModal">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Edit Question</h5>
                      <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                  </div>
                  <div class="modal-body formedithere">

                  </div>
              </div>
          </div>
      </div>
          <div class="modal fade bd-example-modal-lg" id="questionModal">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Add Question</h5>
                      <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                  </div>
                  <div class="modal-body">
                      <form action="" method="POST" id="questionForms"></form>
                      <div class="row">
                        <div class="col-md-6 col-lg-6">
                          <div class="form-group">
                            <label>Question Category</label>
                            <select name="questionCategory" id="questionCategory" form="questionForms" class="form-control">
                                <option selected disabled>---SELECT ONE---</option>
                                <option value="0">Mathematics</option>
                                <option value="1">English</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                          <div class="form-group">
                            <label>Question Type</label>
                            <select name="questionType" id="questionType" form="questionForms"  class="form-control">
                                <option selected disabled>---SELECT ONE---</option>
                                <option value="0">Multiple Choice</option>
                                <option value="1">Q & A</option>
                            </select>
                          </div> 
                        </div>
                      </div>
                      <div id="multipleDiv" style="display: none;">
                           <div class="form-group">
                              <input type="hidden" name="examtypeid" value="<?php echo $_GET['id']?>" form="questionForms">
                              <label>Question</label>
                              <textarea class="form-control" name="question" id="question" form="questionForms"  style="height:100px;border:1px solid gray"></textarea>
                            </div>
                            <p>Multiple Choices</p>
                            <div class="row">
                              <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                  <label>Choice A</label>
                                  <input type="text" name="a" id="a" class="form-control" form="questionForms"  >
                                </div>
                                <div class="form-group">
                                  <label>Choice B</label>
                                  <input type="text" name="b" id="b" class="form-control" form="questionForms"  >
                                </div>
                              </div>
                              <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                  <label>Choice C</label>
                                  <input type="text" name="c" id="c" class="form-control" form="questionForms"  >
                                </div>
                                <div class="form-group">
                                  <label>Choice D</label>
                                  <input type="text" name="d" id="d" class="form-control" form="questionForms"  >
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                <div class="form-group">
                                  <label>Answer</label>
                                  <input type="text" name="ans" id="ans" class="form-control" form="questionForms" placeholder="Enter only the Letter of Answer"  form="questionForms" >
                                </div>
                              </div>
                            </div>
                      </div>
                      <div id="QandADiv"  style="display: none;">
                        <div class="form-group">
                              <input type="hidden" name="examtypeid" value="<?php echo $_GET['id']?>" form="questionForms">
                              <label>Question</label>
                              <textarea class="form-control" name="questionQA" id="questionQA" form="questionForms"  style="height:100px;border:1px solid gray"></textarea>
                        </div>
                        <div class="form-group">
                              <label>Answer</label>
                              <textarea class="form-control" name="ansQA" id="ansQA" form="questionForms"  style="height:100px;border:1px solid gray"></textarea>
                        </div>
                      </div>

                        <div class="form-group pull-right">
                          <input type="submit"  name="addQuestion" id="submit" class="btn btn-success" form="questionForms">
                        </div>
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
