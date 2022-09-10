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
         "pageLength": 5
      });

      $(".edtbtn").click(function(){
        var id = $(this).attr('data-1');
        $.ajax({
            url     :  'editApplydate.php',
            method  :  'POST',
            data    :  {id:id},
            success : function(data)
            {
                $(".formedithere").html(data);
                $('#editModal').modal('toggle');
            }    
        })
      })

      $('.edtSubmissionBtn').click(function(){
          var id = $(this).attr('data-1');
          $.ajax({
              url     :  'editSubmissionDate.php',
              method  :  'POST',
              data    :  {id:id},
              success : function(data)
              {
                  $(".formedithere").html(data);
                  $('#editModal').modal('toggle');
              }    
          })
      })

      $("#scholarbtn").click(function(){
        var btnLink = $(this).attr('btnLink');
        if(btnLink == "finish")
        {
            swal({
              title: "Are you sure to finish current School Year/ Semester?",
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
                    url     :   'updatescholarship.php',
                    method  :   'POST',
                    data    :   {btnLink:btnLink},
                    success :   function(data)
                    {
                      console.log(data);
                     swal({
                      title: data,
                      showCancelButton: false,
                      confirmButtonClass: "btn-success",
                      confirmButtonText: "Okay"
                    },
                    function(isConfirm) {
                      if (isConfirm) {
                        window.location.replace("../schoolyear/");
                      } 
                    });
                    }
              })
              } else {
                window.location.replace("../schoolyear/");
              }
            });
        }
        else if(btnLink == 'start')
        {
            $("#startNewModal").modal('toggle');
        }
        else
        {
           swal({
              title: "Are you sure to close the application for Scholarship?",
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
                    url     :   'updatescholarship.php',
                    method  :   'POST',
                    data    :   {btnLink:btnLink},
                    success :   function(data)
                    {
                      console.log(data);
                     swal({
                      title: data,
                      showCancelButton: false,
                      confirmButtonClass: "btn-success",
                      confirmButtonText: "Okay"
                    },
                    function(isConfirm) {
                      if (isConfirm) {
                        window.location.replace("../schoolyear/");
                      } 
                    });
                    }
                 })
              } else {
                window.location.replace("../schoolyear/");
              }
            });
        }
      })

    })
  </script>
<?php

include('../../db/db.php');

if(isset($_POST['applyAdd']))
{
  $schoolYear = $_POST['schyear'];
  $semester = $_POST['semester'];
  $scholartype = $_POST['scholartype'];
  $startdate = $_POST['startdate'];
  $enddate = $_POST['enddate'];

  $check = "SELECT * FROM tbl_applydate WHERE scholartype = ".$scholartype." AND schyear = '".$schoolYear."' AND semester = '".$semester."'";
  $processCheck = $db->query($check);
  if($processCheck->num_rows > 0)
  {
    ?>
      <script>
          swal({
                title: "Error",
                text: "Application Date already set",
                type: "error",
                showCancelButton: false,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Okay"
              },
              function(isConfirm) {
                if (isConfirm) {
                  window.location.replace("../schoolyear/");
                } 
              });
        </script>
    <?php
  }
  else
  {
    $insert = "INSERT INTO tbl_applydate(fromdate,todate,scholartype,schyear,semester,year)
              VALUES ('".$startdate."','".$enddate."',".$scholartype.",'".$schoolYear."','".$semester."','".date('Y')."')";
    $processInsert = $db->query($insert);
    if($processInsert)
    {
      ?>
      <script>
          swal({
                title: "Success",
                text: "Application Date set successfully",
                type: "success",
                showCancelButton: false,
                confirmButtonClass: "btn-success",
                confirmButtonText: "Okay"
              },
              function(isConfirm) {
                if (isConfirm) {
                  window.location.replace("../schoolyear/");
                } 
              });
        </script>
      <?php
    }
  }
}
if(isset($_POST['editApplyDate']))
{
    $id = $_POST['id'];
    $schyear = $_POST['schyear'];
    $semester = $_POST['semester'];
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];

    $update = "UPDATE tbl_applydate set fromdate = '".$startdate."',todate = '".$enddate."' WHERE id = ".$id."";
    $process = $db->query($update);
    if($process)
    {
    ?>
      <script>
          swal({
                title: "Success",
                text: "Application Date updated",
                type: "success",
                showCancelButton: false,
                confirmButtonClass: "btn-success",
                confirmButtonText: "Okay"
              },
              function(isConfirm) {
                if (isConfirm) {
                  window.location.replace("../schoolyear/");
                } 
              });
        </script>
    <?php
    }
    else
    {
     ?>
     <script>
       swal({
              title: "Error",
              text: "Something went wrong. Try again",
              type: "error",
              showCancelButton: false,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Okay"
            },
            function(isConfirm) {
              if (isConfirm) {
                window.location.replace("../schoolyear/");
              } 
            });
     </script>
     <?php
    }
}

if(isset($_POST['editSubmissionDate']))
{
    $id = $_POST['id'];
    $schyear = $_POST['schyear'];
    $semester = $_POST['semester'];
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];

    $update = "UPDATE tbl_submission set fromdate = '".$startdate."',todate = '".$enddate."' WHERE id = ".$id."";
    $process = $db->query($update);
    if($process)
    {
    ?>
      <script>
          swal({
                title: "Success",
                text: "Submission of Requirements for renewal Date updated",
                type: "success",
                showCancelButton: false,
                confirmButtonClass: "btn-success",
                confirmButtonText: "Okay"
              },
              function(isConfirm) {
                if (isConfirm) {
                  window.location.replace("../schoolyear/");
                } 
              });
        </script>
    <?php
    }
    else
    {
     ?>
     <script>
       swal({
              title: "Error",
              text: "Something went wrong. Try again",
              type: "error",
              showCancelButton: false,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Okay"
            },
            function(isConfirm) {
              if (isConfirm) {
                window.location.replace("../schoolyear/");
              } 
            });
     </script>
     <?php
    }
}

if(isset($_POST['startNewSemester']))
{
  $sem = $_POST['semester'];
  $fromYear = $_POST['fromYear'];
  $toYear = $_POST['toYear'];
  $schyear = $fromYear."-".$toYear;

  $update = "UPDATE tbl_currentyear set schyear = '".$schyear."',semester = '".$sem."',year = '".date('Y')."',status = 0 ";
  $process = $db->query($update);
  if($process)
  {
  ?>
      <script>
          swal({
                title: "Success",
                text: "New Scholarship Started!",
                type: "success",
                showCancelButton: false,
                confirmButtonClass: "btn-success",
                confirmButtonText: "Okay"
              },
              function(isConfirm) {
                if (isConfirm) {
                  window.location.replace("../schoolyear/");
                } 
              });
        </script>
    <?php
  }
}

if(isset($_POST['submissionAdd']))
{
  $schoolYear = $_POST['schyear'];
  $semester = $_POST['semester'];
  $scholartype = $_POST['scholartype'];
  $startdate = $_POST['startdate'];
  $enddate = $_POST['enddate'];

  $check = "SELECT * FROM tbl_submission WHERE scholartype = ".$scholartype." AND schyear = '".$schoolYear."' AND semester = '".$semester."'";
  $processCheck = $db->query($check);
  if($processCheck->num_rows > 0)
  {
    ?>
      <script>
          swal({
                title: "Error",
                text: "Submission Date for Renewal already set",
                type: "error",
                showCancelButton: false,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Okay"
              },
              function(isConfirm) {
                if (isConfirm) {
                  window.location.replace("../schoolyear/");
                } 
              });
        </script>
    <?php
  }
  else
  {
    $insert = "INSERT INTO tbl_submission(fromdate,todate,scholartype,schyear,semester,year)
              VALUES ('".$startdate."','".$enddate."',".$scholartype.",'".$schoolYear."','".$semester."','".date('Y')."')";
    $processInsert = $db->query($insert);
    if($processInsert)
    {
      ?>
      <script>
          swal({
                title: "Success",
                text: "Submission Date for Renewal set successfully",
                type: "success",
                showCancelButton: false,
                confirmButtonClass: "btn-success",
                confirmButtonText: "Okay"
              },
              function(isConfirm) {
                if (isConfirm) {
                  window.location.replace("../schoolyear/");
                } 
              });
        </script>
      <?php
    }
  }
}
?>