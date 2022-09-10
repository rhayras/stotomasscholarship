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
		                 <a href="#" class='btn btn-custom btn-sm' style='color:white;' data-toggle="modal" data-target="#examModal"><i class="fa fa-plus"></i> Add New Announcement</a> 
		             </div><br>
						<h3 style="color:gray;">Announcement List</h3>
						<div class="pull-left">Total Records: 
							<?php

								//get sem
								$sql1 = "SELECT * FROM tbl_currentyear WHERE status != 2";
								$process1 = $db->query($sql1);
								$result1 = $process1->fetch_assoc();

								$sql = "SELECT * FROM tbl_memo WHERE schyear = '".$result1['schyear']."' AND semester = '".$result1['semester']."' ORDER BY id DESC ";
								$process = $db->query($sql);
								echo $process->num_rows;
							?>
						</div>
					<div class="table-responsive">
						<table class="table table-bordered " id="dataTableId">
							<thead >
								<th style="text-align:center">#</th>
								<th >Who</th>
								<th >What</th>
								<th >When</th>
								<th >Where</th>
								<th style="text-align: center;width:100px;">Action</th>
							</thead>
							<tbody style="font-size: 15px;">
								<?php

									$sql1 = "SELECT * FROM tbl_currentyear WHERE status != 2";
									$process1 = $db->query($sql1);
									$result1 = $process1->fetch_assoc();
									
									$examType = "";
									$counter = 0;
									$name = "";
									$getMemo = "SELECT * FROM tbl_memo WHERE schyear = '".$result1['schyear']."' AND semester = '".$result1['semester']."' ORDER BY id DESC";
									$processGetMemo = $db->query($getMemo);
									if($processGetMemo->num_rows > 0)
									{
										while($resultMemo = $processGetMemo->fetch_assoc())
										{
											echo 
											"<tr>
												<td style='	text-align:center'>".++$counter."</td>
												<td>".$resultMemo['who']."</td>
												<td>".$resultMemo['what']."</td>
												<td>".$resultMemo['whenDate']."</td>
												<td>".$resultMemo['wherePlace']."</td>
												<td style='width:100px;text-align:center'> <button class ='btn btn-danger btn-sm delbtn' data-id='".$resultMemo['id']."' title='Delete'>Delete</button></td>
											</tr>";
											//<button class ='btn btn-primary btn-sm edtbtn' data-id='".$resultMemo['id']."' title='Edit'>Edit </button>
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