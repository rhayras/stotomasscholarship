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

    $sqlKey = "SELECT * FROM tbl_apikey";
    $processKey = $db->query($sqlKey);
    $resultKey = $processKey->fetch_assoc();
    $theKey = $resultKey['apiKey'];
    //get number 
    $sqlNumber = "SELECT contactno FROM tbl_student WHERE id = ".$studentid;
    $processNumber = $db->query($sqlNumber);
    $resultNumber = $processNumber->fetch_assoc();
    $contactNo = $resultNumber['contactno'];

    $message = "Congratulations! Your application was approved. Kindly wait for the schedule of your examination. This message is from EPS Scholarship.";
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
      //echo $output;
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
    $update = "UPDATE tbl_student set declineReason = '".$realReason."',status = 3 WHERE id = ".$studentid;
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

        $message = "Good Day! Your application was declined. Reason: ".$realReason." This message is from EPS Scholarship.";
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
          //echo $output;
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

      $message = "Congratulations! You are now a scholar of EPS Scholarship. Be with us by visiting your EPS account. This message is from EPS Scholarship.";
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
        //echo $output;
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

if(isset($_POST['submitScore']))
{
  $studentid = $_POST['studentid'];
  $score = $_POST['score'];

  $sql = "SELECT studenttype FROM tbl_student WHERE id =".$studentid;
  $process = $db->query($sql);

  $result = $process->fetch_assoc();
  $studentType  = $result['studenttype'];
  $studentTypeNumber = 0;
  if($studentType == 'Senior High School'){ $studentTypeNumber = 1;}
  if($studentType == 'College'){ $studentTypeNumber = 2;}
  $passing = 0;
  $examResult = '';
  $remarks = '';
  $sqlCheck = "SELECT * FROM tbl_exam WHERE examtype = ".$studentTypeNumber;
  $processCheck = $db->query($sqlCheck);
  if($processCheck->num_rows > 0)
  {
    $resultCheck = $processCheck->fetch_assoc();
    $passing = $resultCheck['passingscore'];

    if($score >= $passing){$examResult = 'PASSED';$remarks = "qualified";}
    else{$examResult = 'FAILED';$remarks = "not qualified";}

    $getCurrent = "SELECT * FROM tbl_currentyear";
    $processCurrent = $db->query($getCurrent);
    $resultCurrent = $processCurrent->fetch_assoc();
    $schoolyear = $resultCurrent['schyear'];
    $sem = $resultCurrent['semester'];

    $insert = "INSERT INTO tbl_examevaluation (studentId,examresult,score,remarks,schoolyear,semester,studenttype)
          VALUES (".$studentid.",'".$examResult."','".$score."','".$remarks."','".$schoolyear."','".$sem."','".$studentType."')";
    $processInsert = $db->query($insert);
    if($processInsert)
    {
      if($examResult != "FAILED")
      {
          $updateStatus = "UPDATE tbl_student set status = 2 WHERE id =".$studentid;
          $processStatus = $db->query($updateStatus);

          $sqlKey = "SELECT * FROM tbl_apikey";
          $processKey = $db->query($sqlKey);
          $resultKey = $processKey->fetch_assoc();
          $theKey = $resultKey['apiKey'];
          //get number 
          $sqlNumber = "SELECT contactno FROM tbl_student WHERE id = ".$studentid;
          $processNumber = $db->query($sqlNumber);
          $resultNumber = $processNumber->fetch_assoc();
          $contactNo = $resultNumber['contactno'];

          $message = "Good Day! Congratulations! You've passed the examination. Kindly wait for the schedule of Interview. This message is from EPS Scholarship.";
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
      }
      else
      {
        $updateStatus = "UPDATE tbl_student set status = 5 WHERE id =".$studentid;
        $processStatus = $db->query($updateStatus);

        $sqlKey = "SELECT * FROM tbl_apikey";
            $processKey = $db->query($sqlKey);
            $resultKey = $processKey->fetch_assoc();
            $theKey = $resultKey['apiKey'];
            //get number 
            $sqlNumber = "SELECT contactno FROM tbl_student WHERE id = ".$studentid;
            $processNumber = $db->query($sqlNumber);
            $resultNumber = $processNumber->fetch_assoc();
            $contactNo = $resultNumber['contactno'];

            $message = "Good Day! You've failed to passed the examination. You can reapply for scholarship the next semester. This message is from EPS Scholarship.";
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
      }

      $updateAccountExam = "UPDATE tbl_account set examstatus = 1 WHERE studentId = ".$studentid;
      $processUpdateAccountExam = $db->query($updateAccountExam);
      ?>
        <script>
          swal({
                title: "Success",
                text: "Student Score Submitted!",
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

?>
<script>
  $(document).on('change','#scoreExam',function()
  {
      var studentId = '<?php echo $resultApplicant['id']?>';
      var score = $(this).val();
      $.ajax({
        url     :   'checkPassingAJAX.php',
        method  :   'POST',
        data    :   {studentId:studentId,score:score},
        success :   function(data)
        {
            if(data == 'success')
            {
              $('#examResultP').css('color','green');
              $('#examResultP').html('Exam Result : PASSED');
            }
            else
            {
              $('#examResultP').css('color','red');
              $('#examResultP').html('Exam Result : FAILED' );
            }
        }
      })
  });
</script>