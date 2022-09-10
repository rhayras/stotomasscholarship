<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <div id="preloader"></div>

  <!-- JavaScript Libraries -->
  <script src="../../lib/jquery/jquery.min.js"></script>
  <script src="../../lib/jquery/jquery-migrate.min.js"></script>
  <script src="../../lib/popper/popper.min.js"></script>
  <script src="../../lib/bootstrap/js/bootstrap.js"></script>
  <script src="../../lib/easing/easing.min.js"></script>
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

      $(".edtbtn").click(function(){
        var id = $(this).attr('data-id');
        $.ajax({
            url     :  'editsched.php',
            method  :  'POST',
            data    :  {id:id},
            success : function(data)
            {
                $(".formedithere").html(data);
                $('#editModal').modal('toggle');
            }    
        })
      })
      $(".doneBtn").click(function(){
        var studentlevel = $(this).attr('data-level');
        var dataFor = $(this).attr('data-for');
         var id = $(this).attr('data-id');
        $.ajax({
            url     :  'finishSched.php',
            method  :  'POST',
            data    :  {id:id,studentlevel:studentlevel,dataFor:dataFor},
            success : function(data)
            {
                if(data == "success")
                {
                  swal({
                        title: "Success",
                        text: "Event Done",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "Okay"
                      },
                      function(isConfirm) {
                        if (isConfirm) {
                          window.location.replace("../scheduling/");
                        } 
                      });
                }
                else
                {
                  alert(data);
                }
            }    
        })
      })
      $('.delbtn').click(function(){
          var id = $(this).attr('data-id');
          swal({
                  title: "Are you sure to delete this Schedule?",
                  text: "You will not be able to recover this data",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Yes",
                  cancelButtonText: "No",
                  closeOnConfirm: false,
                  closeOnCancel: false
                },
                function(isConfirm) {
                  if (isConfirm) {
                    $.ajax({
                          url     :   'deleteschedule.php',
                          method  :   'POST',
                          data    :   {id:id},
                          success :   function(data)
                          {
                            swal("Deleted", "Schedule Deleted!", "success");
                            window.location.replace("../scheduling/");
                          }
                    })
                  } else {
                    window.location.replace("../scheduling/");
                  }
                });
      })
      $('#dataTableId').DataTable({
         "searching": false,
         "bInfo": false,
         "lengthChange": false,
         "pageLength": 5,
         "autoWidth": false
      });

    })
  </script>
<?php

if(isset($_POST['setSched']))
{
  $schyear = $_POST['schyear'];
  $sem = $_POST['sem'];
  $forwhat = $_POST['forwhat'];
  $studentlevel = $_POST['studentlevel'];
  $date = $_POST['myDate'];
  $formattedtime = date('h:i A', strtotime($_POST['myTime']));



  $explodeExamdateTime = explode(' ',$date);
  $explodeDate = explode('-',$explodeExamdateTime[0]);
  $monthNum = $explodeDate[1];
  $examDay = $explodeDate[2];
  $examYear = $explodeDate[0];
  $monthName =  date("F", mktime(0, 0, 0, $monthNum, 10));

  $check = "SELECT * FROM tbl_schedule WHERE studentlevel = '".$studentlevel."' AND forWhat = '".$forwhat."' AND schyear = '".$schyear."' 
  AND sem = '".$sem."' AND status = 0";
  $processCHeck = $db->query($check);
  if($processCHeck->num_rows > 0)
  {
    ?>
      <script>
          swal({
                title: "Error",
                text: "Schedule Already Set!",
                type: "error",
                showCancelButton: false,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Okay"
              },
              function(isConfirm) {
                if (isConfirm) {
                  window.location.replace("../scheduling/");
                } 
              });
        </script>
    <?php
  }
  else
  {
    $studenttype = "";
    $studentStatus = 0;
    $insert = "INSERT INTO tbl_schedule (studentlevel,forWhat,schyear,sem,schedDate,schedTime)
              VALUES ('".$studentlevel."','".$forwhat."','".$schyear."','".$sem."','".$date."','".$formattedtime."')";
    $processInsert = $db->query($insert);
    if($processInsert)
    {
      $formattedSchedTime = date('h:i:s', strtotime($_POST['myTime']));
      if($forwhat == "Examination")
      {
         $studentStatus = 1;

         if ($studentlevel == 0)
         {
            $sql = "SELECT * FROM tbl_student WHERE status = 1 AND schoolyear = '".$schyear."' AND semester = '".$sem."'";
         }
         else
         {
            if($studentlevel == 1){$studenttype = "Senior High School";}
            elseif($studentlevel == 2){$studenttype = "College";}
            $sql = "SELECT * FROM tbl_student WHERE status = 1 AND schoolyear = '".$schyear."' AND semester = '".$sem."' AND studenttype = '".$studenttype."'";
         }
          $process = $db->query($sql);
          if($process->num_rows > 0)
          {
            while($result = $process->fetch_assoc())
            {
              $studentId = $result['id'];
              //check if taken
              $check = "SELECT examstatus FROM tbl_account WHERE studentId = ".$studentId;
              $processCheck = $db->query($check);
              $resultCheck = $processCheck->fetch_assoc();
              $examstatus = $resultCheck['examstatus'];

              if($examstatus != 1)
              {
                //insert schedule
                  $insertSched = "UPDATE tbl_student set examDate = '".$date." ".$formattedSchedTime."' WHERE id = ".$studentId;
                  $processInsertSched = $db->query($insertSched);

                  $sqlKey = "SELECT * FROM tbl_apikey";
                  $processKey = $db->query($sqlKey);
                  $resultKey = $processKey->fetch_assoc();
                  $theKey = $resultKey['apiKey'];
                  //get number 
                  $sqlNumber = "SELECT contactno FROM tbl_student WHERE id = ".$studentId;
                  $processNumber = $db->query($sqlNumber);
                  $resultNumber = $processNumber->fetch_assoc();
                  $contactNo = $resultNumber['contactno'];
 
                  $message = "Good Day! Your schedule of examination is on ".$monthName." ".$examDay." ".$examYear." ".$formattedSchedTime.". Examination will be held on Sto Tomas City Hall. This message is from EPS Scholarship";
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
              }
            }
          }
          else
          {
            $sql;
          }
      }
      elseif($forwhat == "Interview")
      {
             $studentStatus = 1;

             if ($studentlevel == 0)
             {
                $sql = "SELECT * FROM tbl_student WHERE status = 2 AND schoolyear = '".$schyear."' AND semester = '".$sem."'";
             } 
             else
             {
                if($studentlevel == 1){$studenttype = "Senior High School";}
                elseif($studentlevel == 2){$studenttype = "College";}
                $sql = "SELECT * FROM tbl_student WHERE status = 2 AND schoolyear = '".$schyear."' AND semester = '".$sem."' AND studenttype = '".$studenttype."'";
             }
             
              $process = $db->query($sql);
              if($process->num_rows > 0)
              {
                while($result = $process->fetch_assoc())
                {
                  $studentId = $result['id'];
                  $insertSched = "UPDATE tbl_student set interviewDate = '".$date." ".$formattedSchedTime."' WHERE id = ".$studentId;
                  $processInsertSched = $db->query($insertSched);

                  $sqlKey = "SELECT * FROM tbl_apikey";
                  $processKey = $db->query($sqlKey);
                  $resultKey = $processKey->fetch_assoc();
                  $theKey = $resultKey['apiKey'];
                  //get number 
                  $sqlNumber = "SELECT contactno FROM tbl_student WHERE id = ".$studentId;
                  $processNumber = $db->query($sqlNumber);
                  $resultNumber = $processNumber->fetch_assoc();
                  $contactNo = $resultNumber['contactno'];

                  $message = "Good Day! Your schedule of interview is on ".$monthName." ".$examDay." ".$examYear." ".$formattedSchedTime.". Interiview will be held on Sto Tomas City Hall. This message is from EPS Scholarship";
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

                }
              }
              else
              {
                $sql;
              }
      }
      elseif($forwhat == "Orientation")
      {
        if ($studentlevel == 0)
        {
            $sql = "SELECT * FROM tbl_student WHERE status = 4 AND schoolyear = '".$schyear."' AND semester = '".$sem."'";
        }
        else
        {
            if($studentlevel == 1){$studenttype = "Senior High School";}
            elseif($studentlevel == 2){$studenttype = "College";}
            $sql = "SELECT * FROM tbl_student WHERE status = 4 AND schoolyear = '".$schyear."' AND semester = '".$sem."' AND studenttype = '".$studenttype."'";
        }
         $process = $db->query($sql);
          if($process->num_rows > 0)
          {
            while($result = $process->fetch_assoc())
            {
              $sqlKey = "SELECT * FROM tbl_apikey";
              $processKey = $db->query($sqlKey);
              $resultKey = $processKey->fetch_assoc();
              $theKey = $resultKey['apiKey'];
              $contactNo = $result['contactno'];
              $message = "Good Day! Your schedule of orientation is on ".$monthName." ".$examDay." ".$examYear." ".$formattedSchedTime.". Orientation will be held on Sto Tomas City Hall. This message is from EPS Scholarship";
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
            }
          }
      }
      elseif($forwhat == "Releasing of Grant")
      {
          if ($studentlevel == 0)
          {
              $sql = "SELECT * FROM tbl_student WHERE status IN (4,7) AND schoolyear = '".$schyear."' AND semester = '".$sem."'";
          }
          else
          {
              if($studentlevel == 1){$studenttype = "Senior High School";}
              elseif($studentlevel == 2){$studenttype = "College";}
              $sql = "SELECT * FROM tbl_student WHERE status IN (4,7) AND schoolyear = '".$schyear."' AND semester = '".$sem."' AND studenttype = '".$studenttype."'";
          }
          $process = $db->query($sql);
          if($process->num_rows > 0)
          {
            while($result = $process->fetch_assoc())
            {
              $sqlKey = "SELECT * FROM tbl_apikey";
              $processKey = $db->query($sqlKey);
              $resultKey = $processKey->fetch_assoc();
              $theKey = $resultKey['apiKey'];
              $contactNo = $result['contactno'];
              $message = "Good Day! Your schedule of releasing of grant is on ".$monthName." ".$examDay." ".$examYear." ".$formattedSchedTime.". Releasing of Grant will be held on Sto Tomas City Hall. This message is from EPS Scholarship";
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
            }
          }
      }
     ?>
      <script>
          swal({
                title: "Success",
                text: "Schedule Set!",
                type: "success",
                showCancelButton: false,
                confirmButtonClass: "btn-success",
                confirmButtonText: "Okay"
              },
              function(isConfirm) {
                if (isConfirm) {
                  window.location.replace("../scheduling/");
                } 
              });
        </script>
    <?php
    }
  }
}

if(isset($_POST['updateSched']))
{ 
     $schyear = $_POST['schyear'];
      $sem = $_POST['sem'];
      $forwhat = $_POST['forwhat'];
      $studentlevel = $_POST['studentlevel'];
      $date = $_POST['myDate'];
      $formattedtime = date('h:i A', strtotime($_POST['myTime']));



      $explodeExamdateTime = explode(' ',$date);
      $explodeDate = explode('-',$explodeExamdateTime[0]);
      $monthNum = $explodeDate[1];
      $examDay = $explodeDate[2];
      $examYear = $explodeDate[0];
      $monthName =  date("F", mktime(0, 0, 0, $monthNum, 10));
        $id = $_POST['id'];

        $update = "UPDATE tbl_schedule SET studentlevel = '".$studentlevel."',forWhat = '".$forwhat."'
        ,schyear = '".$schyear."', sem = '".$sem."',schedDate = '".$date."',schedTime = '".$formattedtime."' WHERE id =".$id;
        $processUpdate = $db->query($update);
        if($update)
        {
          $formattedSchedTime = date('h:i:s', strtotime($_POST['myTime']));
          if($forwhat == "Examination")
          {
             $studentStatus = 1;
               //get all student who are for exam
              if($studentlevel == 1){$studenttype = "Senior High School";}
              elseif($studentlevel == 2){$studenttype = "College";}

              if ($studentlevel == 0)
              {
                $sql = "SELECT * FROM tbl_student WHERE status = 1 AND schoolyear = '".$schyear."' AND semester = '".$sem."'";
              }
              else
              {
                 $sql = "SELECT * FROM tbl_student WHERE status = 1 AND schoolyear = '".$schyear."' AND semester = '".$sem."' AND studenttype = '".$studenttype."'";
              }
              $process = $db->query($sql);
              if($process->num_rows > 0)
              {
                while($result = $process->fetch_assoc())
                {
                  $studentId = $result['id'];
                  //check if taken
                  $check = "SELECT examstatus FROM tbl_account WHERE studentId = ".$studentId;
                  $processCheck = $db->query($check);
                  $resultCheck = $processCheck->fetch_assoc();
                  $examstatus = $resultCheck['examstatus'];

                  if($examstatus != 1)
                  {
                    //insert schedule
                      $insertSched = "UPDATE tbl_student set examDate = '".$date." ".$formattedSchedTime."' WHERE id = ".$studentId;
                      $processInsertSched = $db->query($insertSched);

                      $sqlKey = "SELECT * FROM tbl_apikey";
                      $processKey = $db->query($sqlKey);
                      $resultKey = $processKey->fetch_assoc();
                      $theKey = $resultKey['apiKey'];
                      //get number 
                      $sqlNumber = "SELECT contactno FROM tbl_student WHERE id = ".$studentId;
                      $processNumber = $db->query($sqlNumber);
                      $resultNumber = $processNumber->fetch_assoc();
                      $contactNo = $resultNumber['contactno'];
     
                      $message = "Good Day! Sorry for the inconvenience. The schedule of examination is on ".$monthName." ".$examDay." ".$examYear." ".$formattedSchedTime.". Examination will be held on Sto Tomas City Hall. This message is from EPS Scholarship";
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
                }
              }
              else
              {
                $sql;
              }
          }
          elseif($forwhat == "Interview")
          {
                 $studentStatus = 1;
                  if ($studentlevel == 0)
                  {
                      $sql = "SELECT * FROM tbl_student WHERE status = 2 AND schoolyear = '".$schyear."' AND semester = '".$sem."'";
                  }
                  else
                  {
                     if($studentlevel == 1){$studenttype = "Senior High School";}
                    elseif($studentlevel == 2){$studenttype = "College";}
                    $sql = "SELECT * FROM tbl_student WHERE status = 2 AND schoolyear = '".$schyear."' AND semester = '".$sem."' AND studenttype = '".$studenttype."'";
                  }
                  $process = $db->query($sql);
                  if($process->num_rows > 0)
                  {
                      while($result = $process->fetch_assoc())
                      {
                        $studentId = $result['id'];
                        $insertSched = "UPDATE tbl_student set interviewDate = '".$date." ".$formattedSchedTime."' WHERE id = ".$studentId;
                        $processInsertSched = $db->query($insertSched);

                        $sqlKey = "SELECT * FROM tbl_apikey";
                        $processKey = $db->query($sqlKey);
                        $resultKey = $processKey->fetch_assoc();
                        $theKey = $resultKey['apiKey'];
                        //get number 
                        $sqlNumber = "SELECT contactno FROM tbl_student WHERE id = ".$studentId;
                        $processNumber = $db->query($sqlNumber);
                        $resultNumber = $processNumber->fetch_assoc();
                        $contactNo = $resultNumber['contactno'];

                        $message = "Good Day! Sorry for the inconvenience. The schedule of interview is on ".$monthName." ".$examDay." ".$examYear." ".$formattedSchedTime.". Interview will be held on Sto Tomas City Hall. This message is from EPS Scholarship";
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
                  }
                  else
                  {
                    $sql;
                  }
          }
          elseif($forWhat == "Releasing of Grant")
          {
              if ($studentlevel == 0)
              {
                  $sql = "SELECT * FROM tbl_student WHERE status IN (4,7) AND schoolyear = '".$schyear."' AND semester = '".$sem."'";
              }
              else
              {
                  if($studentlevel == 1){$studenttype = "Senior High School";}
                  elseif($studentlevel == 2){$studenttype = "College";}
                  $sql = "SELECT * FROM tbl_student WHERE status IN (4,7) AND schoolyear = '".$schyear."' AND semester = '".$sem."' AND studenttype = '".$studenttype."'";
              }
              $process = $db->query($sql);
              if($process->num_rows > 0)
              {
                while($result = $process->fetch_assoc())
                {
                  $sqlKey = "SELECT * FROM tbl_apikey";
                  $processKey = $db->query($sqlKey);
                  $resultKey = $processKey->fetch_assoc();
                  $theKey = $resultKey['apiKey'];
                  $contactNo = $result['contactno'];
                  $message = "Good Day! Sorry for the inconvenience. The schedule of releasing of grant is on ".$monthName." ".$examDay." ".$examYear." ".$formattedSchedTime.". Releasing of Grant will be held on Sto Tomas City Hall. This message is from EPS Scholarship";
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
                }
              }
          }
          elseif($forwhat == "Orientation")
          {
            if ($studentlevel == 0)
            {
                $sql = "SELECT * FROM tbl_student WHERE status = 4 AND schoolyear = '".$schyear."' AND semester = '".$sem."'";
            }
            else
            {
                if($studentlevel == 1){$studenttype = "Senior High School";}
                elseif($studentlevel == 2){$studenttype = "College";}
                $sql = "SELECT * FROM tbl_student WHERE status = 4 AND schoolyear = '".$schyear."' AND semester = '".$sem."' AND studenttype = '".$studenttype."'";
            }
             $process = $db->query($sql);
              if($process->num_rows > 0)
              {
                while($result = $process->fetch_assoc())
                {
                  $sqlKey = "SELECT * FROM tbl_apikey";
                  $processKey = $db->query($sqlKey);
                  $resultKey = $processKey->fetch_assoc();
                  $theKey = $resultKey['apiKey'];
                  $contactNo = $result['contactno'];
                  $message = "Good Day! Sorry for the inconvenience. The schedule of orientation is on ".$monthName." ".$examDay." ".$examYear." ".$formattedSchedTime.". Orientation will be held on Sto Tomas City Hall. This message is from EPS Scholarship";
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
                }
              }
          }
          ?>
            <script>
                swal({
                      title: "Success",
                      text: "Schedule Updated!",
                      type: "success",
                      showCancelButton: false,
                      confirmButtonClass: "btn-success",
                      confirmButtonText: "Okay"
                    },
                    function(isConfirm) {
                      if (isConfirm) {
                        window.location.replace("../scheduling/");
                      } 
                    });
              </script>
          <?php
        }
}
?>