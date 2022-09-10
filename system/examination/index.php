<?php
include('../../db/db.php');
include('header.php');
?>
<style>
	#myNav
	{
		/*background-color: #2e7d32;*/
		height:100px;
		padding: 20px;
		background-color: #00C851;
		color: white;
	}
	body
	{
		background-color:#f5f5f5;
	}
	.navbar-default {
	   padding-top: 10px;
	  padding-bottom: 10px;
	}
   body
    {
      background-image: linear-gradient(to top, #a5d6a7 , #a5d6a7 );
    }
    #mainContainer
    {
    	background-color:white;
    	padding: 10px;
    	padding-left: 20px;
    	padding-right: 10px;
    	width: 100%;
    	height: 520px;
    }
</style>
	<div class="row" style="padding: 10px;">
		<div class="col-md-12 col-lg-12" id="mainContainer">
			<div class="pull-right">
	             <a href="#" class='btn btn-custom btn-sm' style='color:white;' data-toggle="modal" data-target="#examModal"><i class="fa fa-plus"></i> Add Examination</a> 
	         </div><br>
			<h3 style="color:gray;">Examination List</h3>
				<div class="table-responsive">
				<table class="table table-bordered" id="dataTableId1">
					<thead>
						<th>#</th>
						<th>Examination Type</th>
						<th>Total Items</th>
						<th>Passing Score</th>
						<th>Math Items</th>
						<th>English Items</th>
						<th style="text-align: center;">Action</th>
					</thead>
					<tbody>
						<?php
							$examType = "";
							$counter = 0;
							$status = "";
							$btnValue = "";
							$getExams = "SELECT * FROM tbl_exam ORDER BY id";
							$processGetExams = $db->query($getExams);
							if($processGetExams->num_rows > 0)
							{
								while($resultGetExams = $processGetExams->fetch_assoc())
								{
									if($resultGetExams['examtype'] == 0)
									{
										$examtype = "Junior High School";
									}
									elseif ($resultGetExams['examtype'] == 1)
									{
										$examtype = "Senior High School";
									}
									elseif ($resultGetExams['examtype'] == 2)
									{
										$examtype = "College";
									}
									if($resultGetExams['status'] == 0)
									{
										$status = "Inactive";
										$btnValue = "Activate";
									}
									else
									{
										$status = "Active";
										$btnValue = "Inactivate";
									}
									echo 
									"<tr>
										<td>".++$counter."</td>
										<td>".$examtype."</td>
										<td>".$resultGetExams['itemcount']."</td>
										<td contenteditable='true'>".$resultGetExams['passingscore']."</td>
										<td contenteditable='true'>".$resultGetExams['mathCount']."</td>
										<td contenteditable='true'>".$resultGetExams['engCount']."</td>
										<td style='text-align:center'><a target='_blank' href='printEvaluation.php?examtype=".$examtype."' class='btn btn-success btn-sm '>Print Evaluation</a> <a href='evaluateresults.php?id=".$resultGetExams['id']."' class='btn btn-success btn-sm '>Evaluate Results</a> <a href='viewquestions.php?id=".$resultGetExams['id']."' class='btn btn-success btn-sm '>Manage Questions</a> <a href='#' class='btn btn-primary btn-sm activateBtn' data-id='".$resultGetExams['id']."' btnValue='".$resultGetExams['status']."'>".$btnValue."</a> <a href='#' class='btn btn-danger btn-sm btnDeleteExam'  data-id='".$resultGetExams['id']."'>Delete</a></td>
									</tr>";
								}
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>	


<?php
include('footer.php');
?>
<script type="text/javascript">
	                  //activate exam
      $(".activateBtn").click(function(){
	        var id = $(this).attr('data-id');
	        var status = $(this).attr('btnValue');
	        $.ajax({
	                url     :   'updateExamStatus.php',
	                method  :   'POST',
	                data    :   {id:id,status:status},
	                success :   function(data)
	                {
	                    if(data === "ok")
	                    {
	                        swal("Updated", "Exam activated!", "success");
	                     	  window.location.replace("../examination/");
	                    }
	                    else
	                    {
	                    	console.log(data);
	                    }
	                }
	        })
	      })
      $(".btnDeleteExam").click(function(){
        var id = $(this).attr('data-id');
             swal({
                title: "Are you sure to delete this Examination?",
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
                        url     :   'deleteExamination.php',
                        method  :   'POST',
                        data    :   {id:id},
                        success :   function(data)
                        {
                          swal("Deleted", "Examination Deleted!", "success");
                          window.location.replace("../examination/");
                        }
                  })
                } else {
                  window.location.replace("../examination/");
                }
              });
      })
</script>