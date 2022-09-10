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
    	margin-top: 10px;
    }
</style>
	<div class="row" style="padding: 10px;">
		<div class="col-md-12 col-lg-12" id="mainContainer">
			<center>
			<?php
			$btnText = "";
			$btnLink = "";
			$disabled = "";
			$getSchYear = "SELECT * FROM tbl_currentyear ";
			$processSchyear = $db->query($getSchYear);
			if($processSchyear->num_rows > 0)
			{
				$result = $processSchyear->fetch_assoc();
				if($result['status'] == 0)
				{
					$btnText = "Close Application";
					$btnLink = "close";
					?>
					<h3>SY <?php echo $result['schyear']?></h3>
					<h4><?php echo $result['semester']?></h4>
					<?php
				}
				elseif($result['status'] == 1)
				{
					$btnText = "Finish Current Semester";
					$btnLink = "finish";
					?>
					<h3>SY <?php echo $result['schyear']?></h3>
					<h4><?php echo $result['semester']?></h4>
					<?php
				}
				else
				{
					$btnText = "Start New SchoolYear";
					$btnLink = "start";
					$disabled = 'disabled';
				}
			}
			?>
				<button class="btn btn-success" btnLink = "<?php echo $btnLink?>" id="scholarbtn"><?php echo $btnText?></button>
			</center><br><br>
			<!-- scheduling for application-->
			<div class="row" style="padding: 10px;">
				<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
					<span>Date of Application
						<div class="pull-right">
							<button data-toggle="modal" data-target="#applicationModal" class="btn btn-success btn-sm" style="color: white;margin-bottom:5px;" <?php echo $disabled?>><i class="fa fa-plus"></i> | Add New</button>
						</div>
					</span>
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<th>Scholar Type</th>
								<th>Start</th>
								<th>Deadline</th>
								<th style='text-align:center'>Action</th>
							</thead>
							<tbody style="font-size: 13px;">
								<?php
								$scholartype = "";
								$getSchYear = "SELECT * FROM tbl_currentyear WHERE status != 2";
								$processSchyear = $db->query($getSchYear);
								$resultYear = $processSchyear->fetch_assoc();

								$getApplyDate = "SELECT * FROM tbl_applydate WHERE schyear = '".$resultYear['schyear']."' AND semester = '".$resultYear['semester']."' ";
								$processApplyDate = $db->query($getApplyDate);
								if($processApplyDate->num_rows > 0)
								{
									while($resultApplyDate = $processApplyDate->fetch_assoc())
									{
										if($resultApplyDate['scholartype'] == 0)
										{
											$scholartype = 'Junior High School';
										}
										elseif ($resultApplyDate['scholartype'] == 1)
										{
											$scholartype = 'Senior High School';
										}
										else
										{
											$scholartype = 'College';
										}
										echo
										"<tr>
											<td>".$scholartype."</td>
											<td>".$resultApplyDate['fromdate']."</td>
											<td>".$resultApplyDate['todate']."</td>
											<td style='text-align:center'><a href='#' class='btn-primary btn-sm edtbtn' data-1='".$resultApplyDate['id']."'>Edit</a></td>
										</tr>";
									}
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
					<span>Submission of Requirements for Renewal
						<div class="pull-right">
							<button data-toggle="modal" data-target="#renewalModal" class="btn btn-success btn-sm" style="color: white;margin-bottom:5px;" <?php echo $disabled?>><i class="fa fa-plus"></i> | Add New</button>
						</div>
					</span>
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<th>Scholar Type</th>
								<th>Start</th>
								<th>Deadline</th>
								<th>Action</th>
							</thead>
							<tbody style="font-size: 13px;">
								<?php
								$scholartype = "";
								$getSchYear = "SELECT * FROM tbl_currentyear WHERE status != 2";
								$processSchyear = $db->query($getSchYear);
								$resultYear = $processSchyear->fetch_assoc();

								$getApplyDate = "SELECT * FROM tbl_submission WHERE schyear = '".$resultYear['schyear']."' AND semester = '".$resultYear['semester']."' ";
								$processApplyDate = $db->query($getApplyDate);
								if($processApplyDate->num_rows > 0)
								{
									while($resultApplyDate = $processApplyDate->fetch_assoc())
									{
										if($resultApplyDate['scholartype'] == 0)
										{
											$scholartype = 'Junior High School';
										}
										elseif ($resultApplyDate['scholartype'] == 1)
										{
											$scholartype = 'Senior High School';
										}
										else
										{
											$scholartype = 'College';
										}
										echo
										"<tr>
											<td>".$scholartype."</td>
											<td>".$resultApplyDate['fromdate']."</td>
											<td>".$resultApplyDate['todate']."</td>
											<td style='text-align:center'><a href='#' class='btn-primary btn-sm edtSubmissionBtn' data-1='".$resultApplyDate['id']."'>Edit</a></td>
										</tr>";
									}
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>


<?php
include('footer.php');
?>