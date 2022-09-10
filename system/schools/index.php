<?php
include('../../db/db.php');
include('header.php');


$filter = (isset($_POST['filterbox'])) ? $_POST['filterbox'] : '';
$sqlFilter = "";
if($filter != "")
{
	$sqlFilter = "WHERE schoolname LIKE '".$filter."' and status = 0";
}
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
</style>
			<div class="row" style="padding: 10px;">
				<div class="col-md-12 col-lg-12" id="mainContainer">
					<div class="pull-right">
		                 <a href="#" class='btn btn-custom btn-sm' style='color:white;' data-toggle="modal" data-target="#examModal"><i class="fa fa-plus"></i> Add School</a> 
		             </div><br>
						<h3 style="color:gray;">School List</h3>
						<div class="pull-left">Total Records: 
							<?php
								$sql = "SELECT DISTINCT schoolname from tbl_school ".$sqlFilter." ORDER BY schoolname";
								$process = $db->query($sql);
								echo $process->num_rows;
							?>
						</div>
						<div class="pull-right" style="margin-bottom: -5px;">
							<form action="" method="POST" id="filterForm"></form>
							<label>Search</label>
							<input type="text" name="filterbox" id="filterbox" list='schoolist' form="filterForm" onchange="this.form.submit()" value="<?php echo $filter?>" style='margin-bottom: 10px;'>
							<datalist id="schoolist">
								<?php
								$sql = "SELECT DISTINCT schoolname from tbl_school ".$sqlFilter." ORDER BY schoolname";
								$process = $db->query($sql);
								if($process->num_rows > 0)
								{
									while($result = $process->fetch_assoc())
									{
										echo
										"<option>".$result['schoolname']."</option>";
									}
								}
								?>
							</datalist>
						</div>
					<div class="table-responsive">
						<table class="table table-bordered table-hover" id="dataTableId">
							<thead>
								<th style="width:50px;text-align:center">#</th>
								<th style="width:350px;">School Name</th>
								<th style="width:200px;">School Alias</th>
								<th style="width:200px;">School Type</th>
								<th style="text-align: center;width:100px;">Action</th>
							</thead>
							<tbody style="font-size: 15px;">
								<?php

									$examType = "";
									$counter = 0;
									$schoolType = "";
									$getSchools = "SELECT * FROM tbl_school ".$sqlFilter." ORDER BY schoolname";
									$processGetSchools = $db->query($getSchools);
									if($processGetSchools->num_rows > 0)
									{
										while($resultSchools = $processGetSchools->fetch_assoc())
										{
											if($resultSchools['class'] == 0)
											{
												$schoolType = "Public School";
											}
											elseif($resultSchools['class'] == 1)
											{
												$schoolType = "Semi-Private School";
											}
											elseif($resultSchools['class'] == 2)
											{
												$schoolType = "Private School";
											}
											echo 
											"<tr>
												<td style='width:50px;text-align:center'>".++$counter."</td>
												<td style='width:350px;'>".$resultSchools['schoolname']."</td>
												<td style='width:200px;'>".$resultSchools['schoolalias']."</td>
												<td style='width:200px;'>".$schoolType."</td>
												<td style='width:100px;text-align:center'><button style='color:white' class='btn btn-primary btn-sm edtbtn' title='Edit' data-id='".$resultSchools['id']."'>Edit</button> <button class='btn btn-danger btn-sm delbtn' title='Delete' data-id='".$resultSchools['id']."'>Delete</button></td>
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