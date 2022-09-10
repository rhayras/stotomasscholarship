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
            url     :  'editschool.php',
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
                  title: "Are you sure to delete this School?",
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
                          url     :   'deleteschool.php',
                          method  :   'POST',
                          data    :   {id:id},
                          success :   function(data)
                          {
                            swal("Deleted", "School Deleted!", "success");
                            window.location.replace("../schools/");
                          }
                    })
                  } else {
                    window.location.replace("../schools/");
                  }
                });
        })
      $('#dataTableId').DataTable({
         "searching": false,
         "bInfo": false,
         "lengthChange": false,
         "pageLength": 5,
         "autoWidth":false
      });
    })
  </script>
<?php

include('../../db/db.php');
if(isset($_POST['add']))
{
    $schoolname = trim($_POST['schoolname']);
    $schoolalias = trim($_POST['schoolalias']);
    $schooltype = $_POST['schooltype'];
    //check if exist
    $check = "SELECT * FROM tbl_school where schoolname = '".$schoolname."' AND status = 0";
    $processCheck =  $db->query($check);
    if($processCheck->num_rows > 0)
    {
      ?>
        <script>
            swal({
                  title: "Error",
                  text: "This school already exist",
                  type: "error",
                  showCancelButton: false,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Okay"
                },
                function(isConfirm) {
                  if (isConfirm) {
                    window.location.replace("../schools/");
                  } 
                });
          </script>
      <?php
    }
    else
    {
      //insert
      $insert = "INSERT INTO tbl_school (schoolname,schoolalias,class,dateadded)
            VALUES('".$schoolname."','".$schoolalias."',".$schooltype.",'".date('Y-m-d')."')";
      $processInsert = $db->query($insert);
      if($processInsert)
      {
        ?>
          <script>
            swal({
                  title: "Success",
                  text: "School Added Successfully",
                  type: "success",
                  showCancelButton: false,
                  confirmButtonClass: "btn-success",
                  confirmButtonText: "Okay"
                },
                function(isConfirm) {
                  if (isConfirm) {
                    window.location.replace("../schools/");
                  } 
                });
          </script>
        <?php   
      }
    }
}

if(isset($_POST['updateschool']))
{
  $schooltype = $_POST['schooltype'];
  $schoolname = $_POST['schoolname'];
  $schoolalias = $_POST['schoolalias'];
  $schoolid = $_POST['schoolid'];

  $update = "UPDATE tbl_school set schoolname = '".$schoolname."',schoolalias = '".$schoolalias."',class = '".$schooltype."' WHERE id = ".$schoolid."";
  $process = $db->query($update);
  if($process)
  {
  ?>
    <script>
        swal({
              title: "Success",
              text: "School updated!",
              type: "success",
              showCancelButton: false,
              confirmButtonClass: "btn-success",
              confirmButtonText: "Okay"
            },
            function(isConfirm) {
              if (isConfirm) {
                window.location.replace("../schools/");
              } 
            });
      </script>
  <?php
  }
}