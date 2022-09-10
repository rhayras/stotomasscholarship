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
      
      $(document).on('click','#reUploadBtn',function(){
          var reqType = $(this).attr('reqType');
          var studentId = "<?php echo $_SESSION['studentId']?>";
          $.ajax({
            url     :   'reUpload.php',
            method  :   'POST',
            data    :   {studentId:studentId,reqType:reqType},
            success :   function(data)
            {
                $('#resultHere').html(data);
                $('#reUploadModal').modal('toggle');
            }
          })
      })
    })
  </script>
<?php

include('../../db/db.php');
if(isset($_POST['submitAppForm']))
{
  $targetfolder = "barangayrequirements/";
  $targetfolder = $targetfolder . basename( $_FILES['file']['name']) ;
  $fileName = basename( $_FILES['file']['name']);

  $explode=  explode('.',$fileName);
   if($explode[1] == 'pdf')
   {
       if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder))
       {
          $check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$_SESSION['studentId']."";
          $processCheck = $db->query($check);
          if($processCheck->num_rows > 0)
          {
            $update = "UPDATE tbl_municipalrequirements SET applicationForm = '".$fileName."' WHERE studentid = ".$_SESSION['studentId']."";
            $processUpdate = $db->query($update);
            if($processUpdate)
            {
              ?>
                <script>
                  swal({
                        title: "Success",
                        text: "Application Form Uploaded",
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
          else
          {
            $insert = "INSERT INTO tbl_municipalrequirements (studentid,applicationForm)VALUES (".$_SESSION['studentId'].",'".$fileName."')";
            $process = $db->query($insert);
            if($process)
            {
              ?>
                  <script>
                    swal({
                          title: "Success",
                          text: "Application Form Uploaded",
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
          $sql = "SELECT * FROM tbl_reqstatus WHERE studentId = ".$_SESSION['studentId']." AND requirements = 'applicationForm'";
          $process = $db->query($sql);
          if($process->num_rows > 0)
          {
            $updateStatus = "UPDATE tbl_reqstatus SET status = 0 WHERE studentId = ".$_SESSION['studentId']." AND requirements = 'applicationForm'";
            $processUpdateStatus = $db->query($updateStatus);

          }
          else
          {
            $insertStatus = "INSERT INTO tbl_reqstatus (studentId,requirements) VALUES ('".$_SESSION['studentId']."','applicationForm')";
            $processInsertStatus = $db->query($insertStatus);
          }
       }
   }
   else
   {
     ?>
      <script>
        swal({
              title: "ERROR",
              text: "Requirement should be a pdf file!",
              type: "error",
              showCancelButton: false,
              confirmButtonClass: "btn-danger",
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

if(isset($_POST['submitBcert']))
{
  $targetfolder = "barangayrequirements/";
  $targetfolder = $targetfolder . basename( $_FILES['file']['name']) ;
  $fileName = basename( $_FILES['file']['name']);

  //check if pdf file
  $explode=  explode('.',$fileName);
  if($explode[1] == 'pdf')
  {
     if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder))
     {
        $check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$_SESSION['studentId']."";
        $processCheck = $db->query($check);
        if($processCheck->num_rows > 0)
        {
          $update = "UPDATE tbl_municipalrequirements SET bcert = '".$fileName."' WHERE studentid = ".$_SESSION['studentId']."";
          $processUpdate = $db->query($update);
          if($processUpdate)
          {
            ?>
              <script>
                swal({
                      title: "Success",
                      text: "Birth Certificate Uploaded",
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
        else
        {
          $insert = "INSERT INTO tbl_municipalrequirements (studentid,bcert)VALUES (".$_SESSION['studentId'].",'".$fileName."')";
          $process = $db->query($insert);
          if($process)
          {
            ?>
                <script>
                  swal({
                        title: "Success",
                        text: "Birth Certificate Uploaded",
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
        $sql = "SELECT * FROM tbl_reqstatus WHERE studentId = ".$_SESSION['studentId']." AND requirements = 'bcert'";
        $process = $db->query($sql);
        if($process->num_rows > 0)
        {
          $updateStatus = "UPDATE tbl_reqstatus SET status = 0 WHERE studentId = ".$_SESSION['studentId']." AND requirements = 'bcert'";
          $processUpdateStatus = $db->query($updateStatus);

        }
        else
        {
          $insertStatus = "INSERT INTO tbl_reqstatus (studentId,requirements) VALUES ('".$_SESSION['studentId']."','bcert')";
          $processInsertStatus = $db->query($insertStatus);
        }
     }
  }
  else
  {
     ?>
      <script>
        swal({
              title: "ERROR",
              text: "Requirement should be a pdf file!",
              type: "error",
              showCancelButton: false,
              confirmButtonClass: "btn-danger",
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

if(isset($_POST['submitForm138']))
{
  $targetfolder = "barangayrequirements/";
  $targetfolder = $targetfolder . basename( $_FILES['file']['name']) ;
  $fileName = basename( $_FILES['file']['name']);
  $explode=  explode('.',$fileName);

  if($explode[1] == 'pdf')
  {
      if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder))
      {
          $check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$_SESSION['studentId']."";
          $processCheck = $db->query($check);
          if($processCheck->num_rows > 0)
          {
            $update = "UPDATE tbl_municipalrequirements SET form138 = '".$fileName."' WHERE studentid = ".$_SESSION['studentId']."";
            $processUpdate = $db->query($update);
            if($processUpdate)
            {
              ?>
                <script>
                  swal({
                        title: "Success",
                        text: "Form 138 Uploaded",
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
          else
          {
            $insert = "INSERT INTO tbl_municipalrequirements (studentid,form138)VALUES (".$_SESSION['studentId'].",'".$fileName."')";
            $process = $db->query($insert);
            if($process)
            {
              ?>
                  <script>
                    swal({
                          title: "Success",
                          text: "Form 138 Uploaded",
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
          $sql = "SELECT * FROM tbl_reqstatus WHERE studentId = ".$_SESSION['studentId']." AND requirements = 'form138'";
          $process = $db->query($sql);
          if($process->num_rows > 0)
          {
            $updateStatus = "UPDATE tbl_reqstatus SET status = 0 WHERE studentId = ".$_SESSION['studentId']." AND requirements = 'form138'";
            $processUpdateStatus = $db->query($updateStatus);

          }
          else
          {
            $insertStatus = "INSERT INTO tbl_reqstatus (studentId,requirements) VALUES ('".$_SESSION['studentId']."','form138')";
            $processInsertStatus = $db->query($insertStatus);
          }
      }
  }
  else
  {
     ?>
      <script>
        swal({
              title: "ERROR",
              text: "Requirement should be a pdf file!",
              type: "error",
              showCancelButton: false,
              confirmButtonClass: "btn-danger",
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

if(isset($_POST['submitGoodMoral']))
{
  $targetfolder = "barangayrequirements/";
  $targetfolder = $targetfolder . basename( $_FILES['file']['name']) ;
  $fileName = basename( $_FILES['file']['name']);
  $explode=  explode('.',$fileName);

  if($explode[1] == 'pdf')
  {
     if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder))
     {
        $check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$_SESSION['studentId']."";
        $processCheck = $db->query($check);
        if($processCheck->num_rows > 0)
        {
          $update = "UPDATE tbl_municipalrequirements SET goodMoral = '".$fileName."' WHERE studentid = ".$_SESSION['studentId']."";
          $processUpdate = $db->query($update);
          if($processUpdate)
          {
            ?>
              <script>
                swal({
                      title: "Success",
                      text: "Certificate of Good Moral Uploaded",
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
        else
        {
          $insert = "INSERT INTO tbl_municipalrequirements (studentid,goodMoral)VALUES (".$_SESSION['studentId'].",'".$fileName."')";
          $process = $db->query($insert);
          if($process)
          {
            ?>
                <script>
                  swal({
                        title: "Success",
                        text: "Certificate of Good Moral Uploaded",
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
        $sql = "SELECT * FROM tbl_reqstatus WHERE studentId = ".$_SESSION['studentId']." AND requirements = 'goodMoral'";
          $process = $db->query($sql);
          if($process->num_rows > 0)
          {
            $updateStatus = "UPDATE tbl_reqstatus SET status = 0 WHERE studentId = ".$_SESSION['studentId']." AND requirements = 'goodMoral'";
            $processUpdateStatus = $db->query($updateStatus);

          }
          else
          {
            $insertStatus = "INSERT INTO tbl_reqstatus (studentId,requirements) VALUES ('".$_SESSION['studentId']."','goodMoral')";
            $processInsertStatus = $db->query($insertStatus);
          }
     }
  }
  else
  {
     ?>
      <script>
        swal({
              title: "ERROR",
              text: "Requirement should be a pdf file!",
              type: "error",
              showCancelButton: false,
              confirmButtonClass: "btn-danger",
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

if(isset($_POST['submitHouseSketch']))
{
  $targetfolder = "barangayrequirements/";
  $targetfolder = $targetfolder . basename( $_FILES['file']['name']) ;
  $fileName = basename( $_FILES['file']['name']);
  $explode=  explode('.',$fileName);

  if($explode[1] == 'pdf')
  {
     if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder))
     {
        $check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$_SESSION['studentId']."";
        $processCheck = $db->query($check);
        if($processCheck->num_rows > 0)
        {
          $update = "UPDATE tbl_municipalrequirements SET houseSketch = '".$fileName."' WHERE studentid = ".$_SESSION['studentId']."";
          $processUpdate = $db->query($update);
          if($processUpdate)
          {
            ?>
              <script>
                swal({
                      title: "Success",
                      text: "Vicinity Map/House Sketch Uploaded",
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
        else
        {
          $insert = "INSERT INTO tbl_municipalrequirements (studentid,houseSketch)VALUES (".$_SESSION['studentId'].",'".$fileName."')";
          $process = $db->query($insert);
          if($process)
          {
            ?>
                <script>
                  swal({
                        title: "Success",
                        text: "Vicinity Map/House Sketch Uploaded",
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
        $sql = "SELECT * FROM tbl_reqstatus WHERE studentId = ".$_SESSION['studentId']." AND requirements = 'houseSketch'";
          $process = $db->query($sql);
          if($process->num_rows > 0)
          {
            $updateStatus = "UPDATE tbl_reqstatus SET status = 0 WHERE studentId = ".$_SESSION['studentId']." AND requirements = 'houseSketch'";
            $processUpdateStatus = $db->query($updateStatus);

          }
          else
          {
            $insertStatus = "INSERT INTO tbl_reqstatus (studentId,requirements) VALUES ('".$_SESSION['studentId']."','houseSketch')";
            $processInsertStatus = $db->query($insertStatus);
          }
     }
  }
  else
  {
     ?>
      <script>
        swal({
              title: "ERROR",
              text: "Requirement should be a pdf file!",
              type: "error",
              showCancelButton: false,
              confirmButtonClass: "btn-danger",
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

if(isset($_POST['submitbrgyclearance']))
{
  $targetfolder = "barangayrequirements/";
  $targetfolder = $targetfolder . basename( $_FILES['file']['name']) ;
  $fileName = basename( $_FILES['file']['name']);
  $explode=  explode('.',$fileName);

  if($explode[1] == 'pdf')
  {
     if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder))
     {
        $check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$_SESSION['studentId']."";
        $processCheck = $db->query($check);
        if($processCheck->num_rows > 0)
        {
          $update = "UPDATE tbl_municipalrequirements SET brgyclearance = '".$fileName."' WHERE studentid = ".$_SESSION['studentId']."";
          $processUpdate = $db->query($update);
          if($processUpdate)
          {
            ?>
              <script>
                swal({
                      title: "Success",
                      text: "Barangay Clearance Uploaded",
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
        else
        {
          $insert = "INSERT INTO tbl_municipalrequirements (studentid,brgyclearance)VALUES (".$_SESSION['studentId'].",'".$fileName."')";
          $process = $db->query($insert);
          if($process)
          {
            ?>
                <script>
                  swal({
                        title: "Success",
                        text: "Barangay Clearance Uploaded",
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
        $sql = "SELECT * FROM tbl_reqstatus WHERE studentId = ".$_SESSION['studentId']." AND requirements = 'brgyclearance'";
          $process = $db->query($sql);
          if($process->num_rows > 0)
          {
            $updateStatus = "UPDATE tbl_reqstatus SET status = 0 WHERE studentId = ".$_SESSION['studentId']." AND requirements = 'brgyclearance'";
            $processUpdateStatus = $db->query($updateStatus);

          }
          else
          {
            $insertStatus = "INSERT INTO tbl_reqstatus (studentId,requirements) VALUES ('".$_SESSION['studentId']."','brgyclearance')";
            $processInsertStatus = $db->query($insertStatus);
          }
     }
  }
  else
  {
     ?>
      <script>
        swal({
              title: "ERROR",
              text: "Requirement should be a pdf file!",
              type: "error",
              showCancelButton: false,
              confirmButtonClass: "btn-danger",
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

if(isset($_POST['submitVotersId']))
{
  $targetfolder = "barangayrequirements/";
  $targetfolder = $targetfolder . basename( $_FILES['file']['name']) ;
  $fileName = basename( $_FILES['file']['name']);
  $explode=  explode('.',$fileName);

  if($explode[1] == 'pdf')
  {
       if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder))
       {
          $check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$_SESSION['studentId']."";
          $processCheck = $db->query($check);
          if($processCheck->num_rows > 0)
          {
            $update = "UPDATE tbl_municipalrequirements SET votersId = '".$fileName."' WHERE studentid = ".$_SESSION['studentId']."";
            $processUpdate = $db->query($update);
            if($processUpdate)
            {
              ?>
                <script>
                  swal({
                        title: "Success",
                        text: "Parents Voter's ID Uploaded",
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
          else
          {
            $insert = "INSERT INTO tbl_municipalrequirements (studentid,votersId)VALUES (".$_SESSION['studentId'].",'".$fileName."')";
            $process = $db->query($insert);
            if($process)
            {
              ?>
                  <script>
                    swal({
                          title: "Success",
                          text: "Parents Voter's ID Uploaded",
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
          $sql = "SELECT * FROM tbl_reqstatus WHERE studentId = ".$_SESSION['studentId']." AND requirements = 'votersId'";
          $process = $db->query($sql);
          if($process->num_rows > 0)
          {
            $updateStatus = "UPDATE tbl_reqstatus SET status = 0 WHERE studentId = ".$_SESSION['studentId']." AND requirements = 'votersId'";
            $processUpdateStatus = $db->query($updateStatus);

          }
          else
          {
            $insertStatus = "INSERT INTO tbl_reqstatus (studentId,requirements) VALUES ('".$_SESSION['studentId']."','votersId')";
            $processInsertStatus = $db->query($insertStatus);
          }
       }
  }
  else
  {
     ?>
      <script>
        swal({
              title: "ERROR",
              text: "Requirement should be a pdf file!",
              type: "error",
              showCancelButton: false,
              confirmButtonClass: "btn-danger",
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

if(isset($_POST['submitParentCert']))
{
  $targetfolder = "barangayrequirements/";
  $targetfolder = $targetfolder . basename( $_FILES['file']['name']) ;
  $fileName = basename( $_FILES['file']['name']);

  $explode=  explode('.',$fileName);

  if($explode[1] == 'pdf')
  {
     if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder))
     {
        $check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$_SESSION['studentId']."";
        $processCheck = $db->query($check);
        if($processCheck->num_rows > 0)
        {
          $update = "UPDATE tbl_municipalrequirements SET parentCert = '".$fileName."' WHERE studentid = ".$_SESSION['studentId']."";
          $processUpdate = $db->query($update);
          if($processUpdate)
          {
            ?>
              <script>
                swal({
                      title: "Success",
                      text: "Parents Employement/Unemployement Certificate Uploaded",
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
        else
        {
          $insert = "INSERT INTO tbl_municipalrequirements (studentid,parentCert)VALUES (".$_SESSION['studentId'].",'".$fileName."')";
          $process = $db->query($insert);
          if($process)
          {
            ?>
                <script>
                  swal({
                        title: "Success",
                        text: "Parents Employement/Unemployement Certificate Uploaded",
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
         $sql = "SELECT * FROM tbl_reqstatus WHERE studentId = ".$_SESSION['studentId']." AND requirements = 'parentCert'";
          $process = $db->query($sql);
          if($process->num_rows > 0)
          {
            $updateStatus = "UPDATE tbl_reqstatus SET status = 0 WHERE studentId = ".$_SESSION['studentId']." AND requirements = 'parentCert'";
            $processUpdateStatus = $db->query($updateStatus);

          }
          else
          {
            $insertStatus = "INSERT INTO tbl_reqstatus (studentId,requirements) VALUES ('".$_SESSION['studentId']."','parentCert')";
            $processInsertStatus = $db->query($insertStatus);
          }
     }
  }
  else
  {
     ?>
      <script>
        swal({
              title: "ERROR",
              text: "Requirement should be a pdf file!",
              type: "error",
              showCancelButton: false,
              confirmButtonClass: "btn-danger",
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

if(isset($_POST['submitRegForm']))
{
    $targetfolder = "schoolrequirements/";
    $targetfolder = $targetfolder . basename( $_FILES['file']['name']) ;
    $fileName = basename( $_FILES['file']['name']);

    $explode=  explode('.',$fileName);

    if($explode[1] == 'pdf')
    {
      if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder))
      {
          $check = "SELECT * FROM tbl_schoolrequirements WHERE studentid = ".$_SESSION['studentId']." AND status = 0 AND schoolyear = '".$resultSem['schyear']."' AND semester = '".$resultSem['semester']."'";
          $processCheck = $db->query($check);
          if($processCheck->num_rows > 0)
          {
            $resultCheck = $processCheck->fetch_assoc();
            $dataId = $resultCheck['id'];
            $update = "UPDATE tbl_schoolrequirements SET regform = '".$fileName."' WHERE id = ".$dataId."";
            $processUpdate = $db->query($update);
            if($processUpdate)
            {
              ?>
                <script>
                  swal({
                        title: "Success",
                        text: "Regform Uploaded",
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
          else
          {
              $insert = "INSERT INTO tbl_schoolrequirements(studentId,schoolyear,semester,regform) 
                          VALUES (".$_SESSION['studentId'].",'".$resultSem['schyear']."','".$resultSem['semester']."','".$fileName."')";
              $process = $db->query($insert);
              if($process)
              {
              ?>
                <script>
                  swal({
                        title: "Success",
                        text: "Regform Uploaded",
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
          $sql = "SELECT * FROM tbl_reqstatus WHERE studentId = ".$_SESSION['studentId']." AND requirements = 'regform'";
          $process = $db->query($sql);
          if($process->num_rows > 0)
          {
            $updateStatus = "UPDATE tbl_reqstatus SET status = 0 WHERE studentId = ".$_SESSION['studentId']." AND requirements = 'regform'";
            $processUpdateStatus = $db->query($updateStatus);

          }
          else
          {
            $insertStatus = "INSERT INTO tbl_reqstatus (studentId,requirements) VALUES ('".$_SESSION['studentId']."','regform')";
            $processInsertStatus = $db->query($insertStatus);
          }
      }
    }
    else
    {
       ?>
        <script>
          swal({
                title: "ERROR",
                text: "Requirement should be a pdf file!",
                type: "error",
                showCancelButton: false,
                confirmButtonClass: "btn-danger",
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

if(isset($_POST['submitGradeCard']))
{
    $targetfolder = "schoolrequirements/";
    $targetfolder = $targetfolder . basename( $_FILES['file']['name']) ;
    $fileName = basename( $_FILES['file']['name']);
    $explode=  explode('.',$fileName);

    if($explode[1] == 'pdf')
    {
      if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder))
      {
          $check = "SELECT * FROM tbl_schoolrequirements WHERE studentid = ".$_SESSION['studentId']." AND status = 0 AND schoolyear = '".$resultSem['schyear']."' AND semester = '".$resultSem['semester']."'";
          $processCheck = $db->query($check);
          if($processCheck->num_rows > 0)
          {
            $resultCheck = $processCheck->fetch_assoc();
            $dataId = $resultCheck['id'];
            $update = "UPDATE tbl_schoolrequirements SET gradecard = '".$fileName."' WHERE id = ".$dataId."";
            $processUpdate = $db->query($update);
            if($processUpdate)
            {
              ?>
                <script>
                  swal({
                        title: "Success",
                        text: "Grade Card Uploaded",
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
          else
          {
              $insert = "INSERT INTO tbl_schoolrequirements(studentId,schoolyear,semester,gradecard) 
                          VALUES (".$_SESSION['studentId'].",'".$resultSem['schyear']."','".$resultSem['semester']."','".$fileName."')";
              $process = $db->query($insert);
              if($process)
              {
              ?>
                <script>
                  swal({
                        title: "Success",
                        text: "Grade Card Uploaded",
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
          $sql = "SELECT * FROM tbl_reqstatus WHERE studentId = ".$_SESSION['studentId']." AND requirements = 'gradecard'";
          $process = $db->query($sql);
          if($process->num_rows > 0)
          {
            $updateStatus = "UPDATE tbl_reqstatus SET status = 0 WHERE studentId = ".$_SESSION['studentId']." AND requirements = 'gradecard'";
            $processUpdateStatus = $db->query($updateStatus);

          }
          else
          {
            $insertStatus = "INSERT INTO tbl_reqstatus (studentId,requirements) VALUES ('".$_SESSION['studentId']."','gradecard')";
            $processInsertStatus = $db->query($insertStatus);
          }
      }
    }
    else
    {
       ?>
        <script>
          swal({
                title: "ERROR",
                text: "Requirement should be a pdf file!",
                type: "error",
                showCancelButton: false,
                confirmButtonClass: "btn-danger",
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

if(isset($_POST['submitId']))
{
    $targetfolder = "schoolrequirements/";
    $targetfolder = $targetfolder . basename( $_FILES['file']['name']) ;
    $fileName = basename( $_FILES['file']['name']);
    $explode=  explode('.',$fileName);

    if($explode[1] == 'pdf')
    {
        if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder))
        {
            $check = "SELECT * FROM tbl_schoolrequirements WHERE studentid = ".$_SESSION['studentId']." AND status = 0 AND schoolyear = '".$resultSem['schyear']."' AND semester = '".$resultSem['semester']."'";
            $processCheck = $db->query($check);
            if($processCheck->num_rows > 0)
            {
              $resultCheck = $processCheck->fetch_assoc();
              $dataId = $resultCheck['id'];
              $update = "UPDATE tbl_schoolrequirements SET schoolid = '".$fileName."' WHERE id = ".$dataId."";
              $processUpdate = $db->query($update);
              if($processUpdate)
              {
                ?>
                  <script>
                    swal({
                          title: "Success",
                          text: "School Id Uploaded",
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
            else
            {
                $insert = "INSERT INTO tbl_schoolrequirements(studentId,schoolyear,semester,schoolid) 
                            VALUES (".$_SESSION['studentId'].",'".$resultSem['schyear']."','".$resultSem['semester']."','".$fileName."')";
                $process = $db->query($insert);
                if($process)
                {
                ?>
                  <script>
                    swal({
                          title: "Success",
                          text: "School Id Uploaded",
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
              $sql = "SELECT * FROM tbl_reqstatus WHERE studentId = ".$_SESSION['studentId']." AND requirements = 'schoolid'";
              $process = $db->query($sql);
              if($process->num_rows > 0)
              {
                $updateStatus = "UPDATE tbl_reqstatus SET status = 0 WHERE studentId = ".$_SESSION['studentId']." AND requirements = 'schoolid'";
                $processUpdateStatus = $db->query($updateStatus);

              }
              else
              {
                $insertStatus = "INSERT INTO tbl_reqstatus (studentId,requirements) VALUES ('".$_SESSION['studentId']."','schoolid')";
                $processInsertStatus = $db->query($insertStatus);
              }
        }
    }
    else
    {
       ?>
        <script>
          swal({
                title: "ERROR",
                text: "Requirement should be a pdf file!",
                type: "error",
                showCancelButton: false,
                confirmButtonClass: "btn-danger",
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


