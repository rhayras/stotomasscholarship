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
            url     :  'edituser.php',
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
                title: "Are you sure to delete this User?",
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
                        url     :   'deleteuser.php',
                        method  :   'POST',
                        data    :   {id:id},
                        success :   function(data)
                        {
                          swal("Deleted", "User Deleted!", "success");
                          window.location.replace("../accounts/");
                        }
                  })
                } else {
                  window.location.replace("../accounts/");
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
if(isset($_POST['adduser']))
{
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $fullname = $_POST['fullname'];
    $priviledge = $_POST['priviledge'];
    //check if exist
    $check = "SELECT * FROM tbl_account where name = '".$fullname."' AND status = 0";
    $processCheck =  $db->query($check);
    if($processCheck->num_rows > 0)
    {
      ?>
        <script>
            swal({
                  title: "Error",
                  text: "This User already exist",
                  type: "error",
                  showCancelButton: false,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Okay"
                },
                function(isConfirm) {
                  if (isConfirm) {
                    window.location.replace("../accounts/");
                  } 
                });
          </script>
      <?php
    }
    else
    {
      //insert
     $insert = "INSERT INTO tbl_account (username,password,priviledge,`name`)
            VALUES('".$username."','".$password."','".$priviledge."','".$fullname."')";
      $processInsert = $db->query($insert);
      if($processInsert)
      {
        ?>
          <script>
            swal({
                  title: "Success",
                  text: "User Added Successfully",
                  type: "success",
                  showCancelButton: false,
                  confirmButtonClass: "btn-success",
                  confirmButtonText: "Okay"
                },
                function(isConfirm) {
                  if (isConfirm) {
                    window.location.replace("../accounts/");
                  } 
                });
          </script>
        <?php   
      }
    }
}

if(isset($_POST['updateuser']))
{
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $fullname = $_POST['fullname'];
    $priviledge = $_POST['priviledge'];
    $id = $_POST['id'];

    $update = "UPDATE tbl_account set `name` = '".$fullname."',username = '".$username."',password = '".$password."'
    ,priviledge = '".$priviledge."' WHERE id  = ".$id."";
    $process = $db->query($update);
    if($process)
    {
    ?>
      <script>
          swal({
                title: "Success",
                text: "User updated!",
                type: "success",
                showCancelButton: false,
                confirmButtonClass: "btn-success",
                confirmButtonText: "Okay"
              },
              function(isConfirm) {
                if (isConfirm) {
                  window.location.replace("../accounts/");
                } 
              });
        </script>
    <?php
    }
}