<?php
include('../../db/db.php');
include('header.php');


$filter = (isset($_POST['filterbox'])) ? $_POST['filterbox'] : '';
$usertype = (isset($_POST['usertype'])) ? $_POST['usertype'] : '';
$sqlFilter = "";
if($usertype != "")
{
	$sqlFilter = "WHERE priviledge LIKE '".$usertype."'";
}
if($filter != "")
{
	$sqlFilter = "WHERE username LIKE '".$filter."' and status = 0";
}
if($usertype != "" and $filter != "")
{
	$sqlFilter = "WHERE priviledge LIKE '".$usertype."' AND username LIKE '".$filter."' and status = 0";
}

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
		                 <a href="#" class='btn btn-custom btn-sm' style='color:white;' data-toggle="modal" data-target="#examModal"><i class="fa fa-plus"></i> Add New Account</a> 
		             </div><br>
						<h3 style="color:gray;">Accounts List</h3>
						<div class="pull-left">Total Records: 
							<?php
								$sql = "SELECT DISTINCT username from tbl_account ".$sqlFilter." ORDER BY id";
								$process = $db->query($sql);
								echo $process->num_rows;
							?>
						</div>
						<div class="pull-right" style="margin-bottom: -5px;">
							<form action="" method="POST" id="filterForm"></form>
							<label>User type</label>
							<select name="usertype" id="usertype" form="filterForm" onchange="this.form.submit()" style='margin-bottom: 10px;'>
								<option></option>
								<option value="admin" <?php if($usertype == 'admin'){echo 'selected';}?>>ADMIN</option>
								<option value="student" <?php if($usertype == 'student'){echo 'selected';}?>>STUDENT</option>
							</select>
							<label>Search</label>
							<input type="text" name="filterbox" id="filterbox" list='acclist' form="filterForm" onchange="this.form.submit()" value="<?php echo $filter?>" style='margin-bottom: 10px;'>
							<datalist id="acclist">
								<?php
								$sql = "SELECT DISTINCT username from tbl_account ".$sqlFilter." ORDER BY id";
								$process = $db->query($sql);
								if($process->num_rows > 0)
								{
									while($result = $process->fetch_assoc())
									{
										echo
										"<option>".$result['username']."</option>";
									}
								}
								?>
							</datalist>
						</div>
					<div class="table-responsive">
						<table class="table table-bordered " id="dataTableId">
							<thead >
								<th style="width:50px;text-align:center">#</th>
								<th style="width:350px;">Username</th>
								<th style="width:200px;">Password</th>
								<th style="width:200px;">Privilege</th>
								<th style="width:100px;">Name</th>
								<th style="text-align: center;width:100px;">Action</th>
							</thead>
							<tbody style="font-size: 15px;">
								<?php

									$examType = "";
									$counter = 0;
									$name = "";
									$getAccounts = "SELECT * FROM tbl_account ".$sqlFilter." ORDER BY id";
									$processgetAccounts = $db->query($getAccounts);
									if($processgetAccounts->num_rows > 0)
									{
										while($resultAccounts = $processgetAccounts->fetch_assoc())
										{
											if($resultAccounts['priviledge'] == 'student')
											{
												$getStudentInfo = "SELECT * FROM tbl_student WHERE id = ".$resultAccounts['studentId'];
												$processStudent = $db->query($getStudentInfo);
												$resultStudent = $processStudent->fetch_assoc();
												$name = $resultStudent['firstname']." ".$resultStudent['surname'];
											}
											else
											{
												$name = $resultAccounts['name'];
											}
											echo 
											"<tr>
												<td style='width:50px;text-align:center'>".++$counter."</td>
												<td style='width:350px;'>".$resultAccounts['username']."</td>
												<td style='width:200px;'>".$resultAccounts['password']."</td>
												<td style='width:200px;'>".strtoupper($resultAccounts['priviledge'])."</td>
												<td style='width:100px;'>".$name."</td>
												<td style='width:100px;text-align:center'><button class ='btn btn-primary btn-sm edtbtn' data-id='".$resultAccounts['id']."' title='Edit'>Edit </button> <button class ='btn btn-danger btn-sm delbtn' data-id='".$resultAccounts['id']."' title='Delete'>Delete</button></td>
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