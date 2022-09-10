<?php
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
    	padding-left: 20px;
    	padding-right: 10px;
    	width: 100%;
    	height: 520px;
    }
    #schedExam
    {
    	font-size:40px;
    	background-color: #00C851;
    	color: white;
    	cursor: pointer;
    	border-radius: 10px;
    	padding: 20px;
    }
</style>
	<div class="row" style="padding: 10px;">
		<div class="col-md-12 col-lg-12" id="mainContainer">
			<div class="pull-right">
                 <a href="#" class='btn btn-custom btn-sm' style='color:white;' data-toggle="modal" data-target="#addsched"><i class="fa fa-plus"></i> Add Schedule</a> 
             </div><br>
				<h3 style="color:gray;">Schedule For this schoolyear/semester</h3>
			<div class="table-responsive">
				<table class="table table-bordered table-hover" id="dataTableId">
					<thead>
						<th style="text-align:center">#</th>
						<th >For</th>
						<th >Student Level</th>
						<th >Date</th>
						<th >Time</th>
						<th >Remarks</th>
						<th style="text-align: center;">Action</th>
					</thead>
					<tbody style="font-size: 15px;">
						<?php
							$examType = "";
							$counter = 0;
							$studentlevel = "";
							$remarks = "";
							$getCurrent = "SELECT * FROM tbl_currentyear";
							$processCurrent = $db->query($getCurrent);
							$resultCurrent = $processCurrent->fetch_assoc();
							$schyear = $resultCurrent['schyear'];
							$sem = $resultCurrent['semester'];

							$getSched = "SELECT * FROM tbl_schedule WHERE schyear = '".$schyear."' and sem = '".$sem."' ORDER BY schedDate DESC";
							$processSched = $db->query($getSched);
							if($processSched->num_rows > 0)
							{
								while($resultSched = $processSched->fetch_assoc())
								{
									if($resultSched['studentlevel'] == 0)
									{
										$studentlevel = "All";
									}
									elseif($resultSched['studentlevel'] == 1)
									{
										$studentlevel = "Senior High School";
									}
									elseif($resultSched['studentlevel'] == 2)
									{
										$studentlevel = "College";
									}
									if($resultSched['status'] == 0)
									{
										$remarks = "Not Yet Conducted";
									}
									else
									{
										$remarks = "Conducted";
									}
									echo 
									"<tr>
										<td style='text-align:center'>".++$counter."</td>
										<td>".$resultSched['forWhat']."</td>
										<td>".$studentlevel."</td>
										<td>".$resultSched['schedDate']."</td>
										<td>".$resultSched['schedTime']."</td>
										<td>".$remarks."</td>
										<td style='text-align:center'>
										";
									if($resultSched['status'] == 0)
									{
										echo "
										<button style='color:white' class='btn btn-success btn-sm doneBtn' title='Finish' data-level='".$studentlevel."' data-for='".$resultSched['forWhat']."'data-id='".$resultSched['id']."'>Done</button>
										<button style='color:white' class='btn btn-primary btn-sm edtbtn' title='Edit' data-id='".$resultSched['id']."'>Edit</button> ";

									}
									echo "
										
										<button class='btn btn-danger btn-sm delbtn' title='Delete' data-id='".$resultSched['id']."'>Delete</button></td>
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