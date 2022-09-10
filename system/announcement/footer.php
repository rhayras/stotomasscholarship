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
       $(".edtbtn").click(function(){
        var id = $(this).attr('data-id');
        $.ajax({
            url     :  'editAnnouncement.php',
            method  :  'POST',
            data    :  {id:id},
            success : function(data)
            {
                $(".formedithere").html(data);
                $('#editModal').modal('toggle');
            }    
        })
      })

       $('.delbtn').click(function(){
        var id = $(this).attr('data-id');
        swal({
                title: "Are you sure to delete this Announcement?",
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
                        url     :   'deleteannouncement.php',
                        method  :   'POST',
                        data    :   {id:id},
                        success :   function(data)
                        {
                          swal("Deleted", "Announcement Deleted!", "success");
                          window.location.replace("../announcement/");
                        }
                  })
                } else {
                  window.location.replace("../announcement/");
                }
              });
        })
     $('#dataTableId').DataTable({
         "searching": false,
         "bInfo": false,
         "lengthChange": false,
         "pageLength": 5,
         "autoWidth": false,
         "columnDefs": 
              [
                { "width": "5%", "targets": 0 },
                { "width": "20%", "targets": 1 },
                { "width": "20%", "targets": 2 },
                { "width": "10%", "targets": 3 },
                { "width": "30%", "targets": 4 }
              ]
      });
    })
  </script>
<?php

include('../../db/db.php');
if(isset($_POST['newAnnouncement']))
{

    $who = mysqli_escape_string($db,$_POST['who']);
    $what = mysqli_escape_string($db,$_POST['what']);
    $where = mysqli_escape_string($db,$_POST['where']);
    $whenDate = $_POST['whenDate'];
    $whenTime = $_POST['whenTime'];

    $realDate = $whenDate." ".$whenTime;

    $sqlYear = "SELECT * FROM tbl_currentyear";
    $processYear = $db->query($sqlYear);
    $resultYear = $processYear->fetch_assoc();

    //check if exist
    $check = "SELECT * FROM tbl_memo where who = '".$who."' AND what = '".$what."' AND wherePlace = '".$where."' AND whenDate = '".$whenDate."' AND status = 0";
    $processCheck =  $db->query($check);
    if($processCheck->num_rows > 0)
    {
      ?>
        <script>
            swal({
                  title: "Error",
                  text: "This Announcement already exist",
                  type: "error",
                  showCancelButton: false,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Okay"
                },
                function(isConfirm) {
                  if (isConfirm) {
                    window.location.replace("../announcement/");
                  } 
                });
          </script>
      <?php
    }
    else
    {
      //insert
      $receiver = "";
     $insert = "INSERT INTO tbl_memo (who,what,whenDate,wherePlace,schyear,semester,dateAdded)
            VALUES('".$who."','".$what."','".$realDate."','".$where."','".$resultYear['schyear']."','".$resultYear['semester']."',now())";
      $processInsert = $db->query($insert);
      if($processInsert)
      {

        if($who == "All")
        {
          $sql = "SELECT * FROM tbl_student WHERE status IN (4,7)";
          $receiver = "All Scholars";
        }
        else
        {
          $sql = "SELECT * FROM tbl_student WHERE status IN (4,7) and studenttype = '".$who."' ";
          $receiver = $who." Scholars";
        }
          $process = $db->query($sql);
          if($process->num_rows > 0)
          {
              while($result = $process->fetch_assoc())
              {
                $contactno = $result['contactno'];
                $message = "Announcement. For ".$receiver.". ".$what.". Date & Time : ".$realDate.":00. Where : ".$where.". ";
                $sqlKey = "SELECT * FROM tbl_apikey";
                $processKey = $db->query($sqlKey);
                $resultKey = $processKey->fetch_assoc();
                $theKey = $resultKey['apiKey'];
                $ch = curl_init();
                $parameters = array(
                    'apikey' => $theKey, 
                    'number' => $contactno,
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
        ?>
          <script>
            swal({
                  title: "Success",
                  text: "Announcement Added Successfully",
                  type: "success",
                  showCancelButton: false,
                  confirmButtonClass: "btn-success",
                  confirmButtonText: "Okay"
                },
                function(isConfirm) {
                  if (isConfirm) {
                    window.location.replace("../announcement/");
                  } 
                });
          </script>
        <?php   
      }
    }
}

if(isset($_POST['updateAnnouncement']))
{
    $title = mysqli_escape_string($db,$_POST['title']);
    $content = mysqli_escape_string($db,$_POST['content']);
    $id = $_POST['id'];

    $update = "UPDATE tbl_memo set `title` = '".$title."',content  = '".$content ."' WHERE id  = ".$id."";
    $process = $db->query($update);
    if($process)
    {
    ?>
      <script>
          swal({
                title: "Success",
                text: "Announcement updated!",
                type: "success",
                showCancelButton: false,
                confirmButtonClass: "btn-success",
                confirmButtonText: "Okay"
              },
              function(isConfirm) {
                if (isConfirm) {
                  window.location.replace("../announcement/");
                } 
              });
        </script>
    <?php
    }
}