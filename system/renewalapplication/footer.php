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
       $('#grantDiv').hide();
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
        $(document).on('change','#fullradio',function(){
        $('#grantDiv').hide();
      })
      $(document).on('change','#assistanceradio',function(){
        $('#grantDiv').show();
      })
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

   $realReason = mysqli_escape_string($db,$declinereason);

   $update = "UPDATE tbl_student set renewalDeclineReason = '".$realReason."',status = 9 WHERE id = ".$studentid;
  $process = $db->query($update);
  if($process)
  {
    $sqlKey = "SELECT * FROM tbl_apikey";
    $processKey = $db->query($sqlKey);
    $resultKey = $processKey->fetch_assoc();
    $theKey = $resultKey['apiKey'];
    //get number 
    $sqlNumber = "SELECT contactno FROM tbl_student WHERE id = ".$studentid;
    $processNumber = $db->query($sqlNumber);
    $resultNumber = $processNumber->fetch_assoc();
    $contactNo = $resultNumber['contactno'];

    $message = "Good Day! Your renewal application was disapproved. Reason: ".$declinereason." This message is from EPS Scholarship.";
      $ch = curl_init();
      $parameters = array(
          'apikey' => $theKey, 
          'number' => $contactNo,
          'message' => $message,
          'sendername' => 'SEMAPHORE'
      );
      curl_setopt( $ch, CURLOPT_URL,'http://api.semaphore.co/api/v4/messages' );
      curl_setopt( $ch, CURLOPT_POST, 1 );
      curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );
      curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
      $output = curl_exec( $ch );
      curl_close ($ch);
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
              window.location.replace("../renewalapplication/");
            } 
          });
    </script>
  <?php  
  }
  else
  {
    echo $update;
  }
}

if(isset($_POST['submitApprove']))
{
  $studentId = $_POST['studentid'];
  $scholarshiptype = $_POST['scholarshiptype'];
  $amount = $_POST['amount'];

  //update first status then insert into history
  $update = "UPDATE tbl_student set status = 7,scholarType = ".$scholarshiptype.",grantprice = '".$amount."' WHERE id = ".$studentId;
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

    $insertHistory = "INSERT INTO tbl_scholarhistory (studentId,studenttype,schoolyear,sem,yearOrgrade,schoolid,gwa,scholartype,grantprice,year)
      VALUES (".$studentId.",'".$resultStudentInfo['studenttype']."','".$schyear."','".$sem."','".$resultStudentInfo['yearOrgrade']."','".$resultStudentInfo['school']."','".$resultStudentInfo['gwa']."','".$scholarshiptype."','".$amount."','".date('Y')."')";
    $processInsertHistory = $db->query($insertHistory);
    if($insertHistory)
    {
        $sqlKey = "SELECT * FROM tbl_apikey";
        $processKey = $db->query($sqlKey);
        $resultKey = $processKey->fetch_assoc();
        $theKey = $resultKey['apiKey'];
        //get number 
        $sqlNumber = "SELECT contactno FROM tbl_student WHERE id = ".$studentId;
        $processNumber = $db->query($sqlNumber);
        $resultNumber = $processNumber->fetch_assoc();
        $contactNo = $resultNumber['contactno'];

        $message = "Congratulations! Your renewal application was approved. You are now an EPS Scholar again. This message is from EPS Scholarship.";
          $ch = curl_init();
          $parameters = array(
              'apikey' => $theKey, 
              'number' => $contactNo,
              'message' => $message,
              'sendername' => 'SEMAPHORE'
          );
          curl_setopt( $ch, CURLOPT_URL,'http://api.semaphore.co/api/v4/messages' );
          curl_setopt( $ch, CURLOPT_POST, 1 );
          curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );
          curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
          $output = curl_exec( $ch );
          curl_close ($ch);
        ?>
    <script>
      swal({
            title: "Success",
            text: "Student Application was Approved! This student is now EPS Scholar again",
            type: "success",
            showCancelButton: false,
            confirmButtonClass: "btn-success",
            confirmButtonText: "Okay"
          },
          function(isConfirm) {
            if (isConfirm) {
              window.location.replace("../scholars/");
            } 
          });
    </script>
  <?php  
    }
  }
}


?>