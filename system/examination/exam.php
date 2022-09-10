<?php
include('../../db/db.php');
include('header.php');
?>
<style>
	
	#myNav
	{
		background-color: white;
		height:100px;
		padding: 20px;
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
    	height:450px;
    	border-radius: 10px;
    	border:1px solid green;
    	margin-left: 20px;
    	margin-right: 20px;
    }
</style>
		<br>
		<div id="mainContainer">
			<div class="row">
				<div class="col-md-1 col-lg-1"></div>
				<div class="col-md-10 col-lg-10">
					<div class="pull-right">
		                 <a href="#" class='btn btn-custom btn-sm' style='color:white;' data-toggle="modal" data-target="#examModal"><i class="fa fa-plus"></i> Add Examination</a> 
		             </div><br>
						<h3 style="color:gray;">Examination List</h3>
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<th>#</th>
								<th>Examination Type</th>
								<th>Total Items</th>
								<th>Passing Score</th>
								<th style="text-align: center;">Action</th>
							</thead>
							<tbody>
								<?php
									$examType = "";
									$counter = 0;
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
											echo 
											"<tr>
												<td>".++$counter."</td>
												<td>".$examtype."</td>
												<td>".$resultGetExams['itemcount']."</td>
												<td>".$resultGetExams['passingscore']."</td>
												<td style='text-align:center'><a href='' class='btn btn-primary btn-sm'><i class='fa fa-pencil'></i> Edit</a> <a href='' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i> Delete</a></td>
											</tr>";
										}
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-md-1 col-lg-1"></div>
			</div>
		</div>


<?php
include('footer.php');
?>