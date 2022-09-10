<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <div id="preloader"></div>

  <!-- JavaScript Libraries -->
  <script src="../../lib/jquery/jquery.min.js"></script>
  <script src="../../lib/jquery/jquery-migrate.min.js"></script>
  <script src="../../lib/popper/popper.min.js"></script>
  <script src="../../lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="../../lib/easing/easing.min.js"></script>
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
      // $('#dataTableId1').DataTable({
      //    "searching": false,
      //    "bInfo": false,
      //    "lengthChange": false,
      //    "pageLength": 5,
      //    "autoWidth": false
      // });
      
      $(".edtbtn").click(function(){
        var id = $(this).attr('data-id');
        $.ajax({
            url     :  'editquestion.php',
            method  :  'POST',
            data    :  {id:id},
            success : function(data)
            {
                $(".formedithere").html(data);
                $('#editModal').modal('toggle');
            }    
        })
      })
      $(".delbtn").click(function(){
        var id = $(this).attr('data-id');
        var examtypeid = $(this).attr('data-id2');
        var questionCategory = $(this).attr('data-id3');
        //alert(examtypeid);
          swal({
                  title: "Are you sure to delete this Question?",
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
                          url     :   'deletequestion.php',
                          method  :   'POST',
                          data    :   {id:id,examtypeid:examtypeid,questionCategory:questionCategory},
                          success :   function(data)
                          {
                            //alert(data);
                            swal("Deleted", "Question Deleted!", "success");
                            window.location.replace("../examination/viewquestions.php?id=<?php echo $_GET['id']?>");
                          }
                    })
                  } else {
                    window.location.replace("../examination/viewquestions.php?id=<?php echo $_GET['id']?>");
                  }
                });
      })

      
      $('#dataTableId').DataTable({
         "bInfo": false,
         "lengthChange": false,
         "pageLength": 5,
         "autoWidth": false,
         "columnDefs": 
              [
                { "width": "5%", "targets": 0 },
                { "width": "35%", "targets": 3 },
                { "width": "15%", "targets": 9 }
              ]
      });

    })
  </script>
<?php
  if(isset($_POST['updateQuestion']))
  {
    $question = $_POST['question'];
    $questionType = $_POST['questionType'];
    
    $id = $_POST['id']; 
    $ans = $_POST['ans']; 

    if($questionType == 0)
    {
      $a = $_POST['a'];
      $b = $_POST['b'];
      $c = $_POST['c'];
      $d = $_POST['d'];
      $update = "UPDATE tbl_question set question = '".$question."',a='".$a."',b='".$b."',c='".$c."',d='".$d."',answer = '".$ans."' WHERE id = ".$id;
    }
    else
    {
      $update = "UPDATE tbl_question set question = '".$question."',answer = '".$ans."' WHERE id = ".$id;
    }
    $process = $db->query($update);
    if($process)
    {
    ?>
      <script>
          swal({
                title: "Success",
                text: "Question updated!",
                type: "success",
                showCancelButton: false,
                confirmButtonClass: "btn-success",
                confirmButtonText: "Okay"
              },
              function(isConfirm) {
                if (isConfirm) {
                  window.location.replace("../examination/viewquestions.php?id=<?php echo $_GET['id']?>");
                } 
              });
        </script>
    <?php
    }
  }


  if(isset($_POST['addQuestion']))
  {
      $questionCategory = $_POST['questionCategory'];
      $questionType = $_POST['questionType'];

      if($questionType == 0)
      {
          $a = $_POST['a'];
          $b = $_POST['b'];
          $c = $_POST['c'];
          $d = $_POST['d'];
          $examtypeid = $_POST['examtypeid'];
          $question = $_POST['question'];
          $ans = $_POST['ans'];

          if($questionCategory == 0)
          {
            $id = '';
            $goFlag = 1;
             $sql = "SELECT * FROM tbl_question WHERE questionCategory = ".$questionCategory." AND examtypeid = ".$examtypeid."  ORDER BY id DESC LIMIT 1";
             $process = $db->query($sql);
             if($process->num_rows > 0)
             {
                $result = $process->fetch_assoc();
                $id = $result['id'];
                $nextId = $result['id'] + 1;
             }

             // add 1 to each id after question
             $sql1 = "SELECT * FROM tbl_question WHERE id > ".$id."  AND examtypeid = ".$examtypeid." ORDER BY id DESC";
             $process1 = $db->query($sql1);
             if($process1->num_rows > 0)
             {
                while($result1 = $process1->fetch_assoc())
                {
                  $realId = $result1['id'];
                  $realIdAddOne= $realId+1;
                  $update = "UPDATE tbl_question set id = ".$realIdAddOne." WHERE id = ".$realId."";
                  $processUpdate = $db->query($update);
                  if($processUpdate)
                  {
                    $goFlag = 1;
                  }
                }
             }
             
              $insertQuestion = "INSERT INTO tbl_question (id,examtypeid,question,a,b,c,d,answer,questionCategory,questionType)
                        VALUES (".$nextId.",".$examtypeid.",'".$question."','".$a."','".$b."','".$c."','".$d."'
                        ,'".$ans."',".$questionCategory.",".$questionType.")";
          }
          else
          {
            //if english just add to the end.
           $insertQuestion = "INSERT INTO tbl_question (examtypeid,question,a,b,c,d,answer,questionCategory,questionType)
                        VALUES (".$examtypeid.",'".$question."','".$a."','".$b."','".$c."','".$d."'
                        ,'".$ans."',".$questionCategory.",".$questionType.")";
          }
      }
      else
      {
          $examtypeid = $_POST['examtypeid'];
          $questionQA = $_POST['questionQA'];
          $ansQA = $_POST['ansQA'];
          if($questionCategory == 0)
          {
            $id = '';
            $goFlag = 1;
             $sql = "SELECT * FROM tbl_question WHERE questionCategory = ".$questionCategory." AND examtypeid = ".$examtypeid."  ORDER BY id DESC LIMIT 1";
             $process = $db->query($sql);
             if($process->num_rows > 0)
             {
                $result = $process->fetch_assoc();
                $id = $result['id'];
                $nextId = $result['id'] + 1;
             }

             // add 1 to each id after question
              $sql1 = "SELECT * FROM tbl_question WHERE id > ".$id."  AND examtypeid = ".$examtypeid." ORDER BY id DESC";
             $process1 = $db->query($sql1);
             if($process1->num_rows > 0)
             {
                while($result1 = $process1->fetch_assoc())
                {
                  $realId = $result1['id'];
                  $realIdAddOne= $realId+1;
                  $update = "UPDATE tbl_question set id = ".$realIdAddOne." WHERE id = ".$realId."";
                  $processUpdate = $db->query($update);
                  if($processUpdate)
                  {
                    $goFlag = 1;
                  }
                  else
                  {
                    echo $update."<br>";
                  }
                }
             }
             
             $insertQuestion = "INSERT INTO tbl_question (id,examtypeid,question,answer,questionCategory,questionType)
                        VALUES (".$nextId.",".$examtypeid.",'".$questionQA."','".$ansQA."',".$questionCategory.",".$questionType.")";
          }
          else
          {
             $insertQuestion = "INSERT INTO tbl_question (examtypeid,question,a,b,c,d,answer,questionCategory,questionType)
                        VALUES (".$examtypeid.",'".$questionQA."','','','',''
                        ,'".$ansQA."',".$questionCategory.",".$questionType.")";
          }
       
      }
      
      $processInsert = $db->query($insertQuestion);

      //plus 1 to total and passing score
      $getExamInfo = "SELECT * FROM tbl_exam WHERE id = ".$examtypeid;
      $processInfo = $db->query($getExamInfo);
      $resultInfo = $processInfo->fetch_assoc();


      $newItemCount = $resultInfo['itemcount']+1;
      $newPassing = $resultInfo['passingscore']+1;
       if($questionCategory == 0)
        {
          $newMathCount = $resultInfo['mathCount']+1;
          $update = "UPDATE tbl_exam set itemcount = ".$newItemCount.",passingscore = ".$newPassing.",mathCount = ".$newMathCount." WHERE id = ".$examtypeid;
        }
        else
        {
          $newEngCount = $resultInfo['engCount']+1;
          $update = "UPDATE tbl_exam set itemcount = ".$newItemCount.",passingscore = ".$newPassing.",engCount = ".$newEngCount." WHERE id = ".$examtypeid;
        }

      $processUpdate = $db->query($update);

      if($processInsert)
      {
      ?>
        <script>
            swal({
                  title: "Success",
                  text: "Question Added!",
                  type: "success",
                  showCancelButton: false,
                  confirmButtonClass: "btn-success",
                  confirmButtonText: "Okay"
                },
                function(isConfirm) {
                  if (isConfirm) {
                    window.location.replace("../examination/viewquestions.php?id=<?php echo $_GET['id']?>");
                  } 
                });
          </script>
      <?php
      }
      
  }
?>