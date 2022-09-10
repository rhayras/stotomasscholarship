<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <div id="preloader"></div>

  <!-- JavaScript Libraries -->
  <script src="../../lib/jquery/jquery.min.js"></script>
  <script src="../../lib/jquery/jquery-migrate.min.js"></script>
  <script src="../../lib/popper/popper.min.js"></script>
  <script src="../../lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="../../lib/easing/easing.min.js"></script>
  <script src="../../lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="../../lib/scrollreveal/scrollreveal.min.js"></script>
  <!-- Contact Form JavaScript File -->
   <script src="../../js/sweetalert.min.js"></script>

  <!-- Template Main Javascript File -->
  <script src="../../js/main.js"></script>


</body>
</html>
  <script src="../DataTables/datatables-real/js/jquery.dataTables.min.js"></script> 
  <script src="../DataTables/datatables-real/js/dataTables.bootstrap4.min.js"></script>
  <link rel="stylesheet" href="../DataTables/datatables-real/css/dataTables.bootstrap4.css" />  
  <script>
    $(document).ready(function(){
      $('#dataTableId').DataTable({
         "searching": false,
         "bInfo": false,
         "lengthChange": false,
         "pageLength": 5,
         "autoWidth": false,
         // "columnDefs": 
         //      [
         //        { "width": "5%", "targets": 0 },
         //        { "width": "20%", "targets": 1 },
         //        { "width": "20%", "targets": 2 },
         //        { "width": "10%", "targets": 3 },
         //        { "width": "30%", "targets": 4 }
         //      ]
      });
    })
  </script>
<?php
if(isset($_POST['submitgwa']))
{
  $studentid = $_POST['studentid'];
  $gwa = $_POST['gwa'];
  $update = "UPDATE tbl_student set gwa = '".$gwa."',status = 1 WHERE id = ".$studentid;
  $process = $db->query($update);
  if($process)
  {
  ?>
    <script>
      swal({
            title: "Success",
            text: "Student Application was approved!",
            type: "success",
            showCancelButton: false,
            confirmButtonClass: "btn-success",
            confirmButtonText: "Okay"
          },
          function(isConfirm) {
            if (isConfirm) {
              window.location.replace("../newapplicants/");
            } 
          });
    </script>
  <?php  
  }
}

if(isset($_POST['submitreason']))
{
   $studentid = $_POST['studentid'];
   $declinereason = $_POST['declinereason'];
   $update = "UPDATE tbl_student set declineReason = '".$declinereason."',status = 3 WHERE id = ".$studentid;
  $process = $db->query($update);
  if($process)
  {
  ?>
    <script>
      swal({
            title: "Success",
            text: "Student Application was declined!",
            type: "success",
            showCancelButton: false,
            confirmButtonClass: "btn-success",
            confirmButtonText: "Okay"
          },
          function(isConfirm) {
            if (isConfirm) {
              window.location.replace("../newapplicants/");
            } 
          });
    </script>
  <?php  
  }
}

if(isset($_POST['approveApplication']))
{
  $studentId = $_POST['studentId'];
  $scholarshiptype = $_POST['scholarshiptype'];
  $amount = $_POST['amount'];

  //update first status then insert into history
  $update = "UPDATE tbl_student set status = 4,scholarType = ".$scholarshiptype.",grantprice = '".$amount."' WHERE id = ".$studentId;
  $processUpdate = $db->query($update);
  if($processUpdate)
  {
    //insert into history
    $getSem = "SELECT * from tbl_currentyear";
    $processSem = $db->query($getSem);
    $resultSem = $processSem->fetch_assoc();
    $sem = $resultSem['semester'];
    $schyear = $resultSem['schyear'];

    $getStudentInfo = "SELECT * FROM tbl_student WHERE id = ".$studentId;
    $processStudentInfo = $db->query($getStudentInfo);
    $resultStudentInfo = $processStudentInfo->fetch_assoc();

    $insertHistory = "INSERT INTO tbl_scholarhistory (studentId,studenttype,schoolyear,sem,yearOrgrade,schoolid,gwa,scholartype,grantprice)
      VALUES (".$studentId.",'".$resultStudentInfo['studenttype']."','".$schyear."','".$sem."','".$resultStudentInfo['yearOrgrade']."','".$resultStudentInfo['school']."','".$resultStudentInfo['gwa']."','".$scholarshiptype."','".$amount."')";
    $processInsertHistory = $db->query($insertHistory);
    if($insertHistory)
    {
        ?>
    <script>
      swal({
            title: "Success",
            text: "Student Application was Approved! This student is now EPS Scholar",
            type: "success",
            showCancelButton: false,
            confirmButtonClass: "btn-success",
            confirmButtonText: "Okay"
          },
          function(isConfirm) {
            if (isConfirm) {
              window.location.replace("../newapplicants/");
            } 
          });
    </script>
  <?php  
    }
  }
}

if(isset($_POST['submitGrant']))
{
  $studentId = $_POST['studentid'];
  $grant = $_POST['grant'];

  //update GRANT
  //get the sch and sem first
  $updateGrant = "UPDATE tbl_student set grantprice = '".$grant."' WHERE id = ".$studentId;
  $processUpdateGrant = $db->query($updateGrant);
  if($processUpdateGrant)
  {
    //update history
    $updateHistory = "UPDATE tbl_scholarhistory set grantprice = '".$grant."' WHERE studentId = ".$studentId." AND schoolyear = '".$schyear."' AND sem = '".$sem."'";
    $processHistory = $db->query($updateHistory);
    if($processHistory)
    {
    ?>
      <script>
        swal({
              title: "Success",
              text: "Student's Scholarship Grant Updated!",
              type: "success",
              showCancelButton: false,
              confirmButtonClass: "btn-success",
              confirmButtonText: "Okay"
            },
            function(isConfirm) {
              if (isConfirm) {
                window.location.replace("../scholars/viewapplicant.php?id=<?php echo $studentId?>");
              } 
            });
      </script>
    <?php 
    }
  }
 
}
?>