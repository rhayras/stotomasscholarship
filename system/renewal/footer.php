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
if(isset($_POST['submittype']))
{
  $check = "SELECT * FROM tbl_currentyear";
  $processCheck = $db->query($check);
  if($processCheck->num_rows > 0)
  {
    $resultCheck = $processCheck->fetch_assoc();
  }
  $studenttype = $_POST['studenttype'];
  $checkapplydate = "SELECT * FROM tbl_submission WHERE scholartype = ".$studenttype." AND schyear ='".$resultCheck['schyear']."' and semester = '".$resultCheck['semester']."'";
  $processApplydate = $db->query($checkapplydate);
  if($processApplydate->num_rows > 0)
  {
    $result = $processApplydate->fetch_assoc();
    if(date('Y-m-d') == $result['fromdate'])
    {
      ?>
      <script>
        window.location.href = "index.php?flag="+<?php echo $result['scholartype']?>;
      </script>
      <?php       
    }
    elseif (date('Y-m-d') < $result['fromdate'])
    {
      ?>
         <script>
              swal({
                    title: "Warning",
                    text: "Renewal of scholarship will start on <?php echo $result['fromdate']?>.",
                    type: "warning",
                    showCancelButton: false,
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Okay"
                  },
                  function(isConfirm) {
                    if (isConfirm) {
                      window.location.replace("../");
                    } 
                  });
          </script>
        <?php
    }
    elseif (date('Y-m-d') > $result['todate'])
    {
    ?>
         <script>
              swal({
                    title: "Warning",
                    text: "Renewal of scholarship ended last <?php echo $result['todate']?>.",
                    type: "warning",
                    showCancelButton: false,
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Okay"
                  },
                  function(isConfirm) {
                    if (isConfirm) {
                      window.location.replace("../");
                    } 
                  });
          </script>
        <?php
    }
    else
    {
      ?>
      <script>
        window.location.href = "index.php?flag="+<?php echo $result['scholartype']?>;
      </script>
      <?php
    }
  }
  else
  {
        ?>
        <script>
            swal({
                  title: "Warning",
                  text: "Renewal for scholarship is not been set by admin.",
                  type: "warning",
                  showCancelButton: false,
                  confirmButtonClass: "btn-success",
                  confirmButtonText: "Okay"
                },
                function(isConfirm) {
                  if (isConfirm) {
                    window.location.replace("../");
                  } 
                });
          </script>
        <?php
  }
}

if(isset($_POST['renew']))
{
  $studentId = $_POST['studentId'];
  $studenttype = $_POST['studenttype'];
  $gradelevel = $_POST['gradelevel'];
  $course = $_POST['course'];
  $school = $_POST['school'];
  $schyear = $_POST['schyear'];
  $sem = $_POST['sem'];
  $gwa = $_POST['gwa'];

  //update tbl_student
  $updateInfo = "UPDATE tbl_student set studenttype = '".$studenttype."',yearOrgrade = '".$gradelevel."',course = '".$course."',semester = '".$sem."',schoolyear = '".$schyear."',gwa = '".$gwa."' WHERE id = '".$studentId."'";
  $processUpdate = $db->query($updateInfo);
  if($processUpdate)
  {
    //update tbl_account
    $updateAccount = "UPDATE tbl_account set renewstatus = 1 WHERE studentId = ".$studentId;
    $processAccount = $db->query($updateAccount);
    if($processAccount)
    {
    ?>
        <script>
            swal({
                  title: "Success",
                  text: "To complete your renewal application, submit the requirements needed.",
                  type: "success",
                  showCancelButton: false,
                  confirmButtonClass: "btn-success",
                  confirmButtonText: "Okay"
                },
                function(isConfirm) {
                  if (isConfirm) {
                    window.location.replace("../requirements/");
                  } 
                });
          </script>
     <?php
    }
  }
}

?>