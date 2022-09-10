<?php
include('../../db/db.php');
include('header.php');

//check the current sem and schyear
$schyear = "";
$sem = "";
$getCurrent = "SELECT * FROM tbl_currentyear";
$processCurrent = $db->query($getCurrent);
if($processCurrent->num_rows > 0)
{
	$resultCurrent = $processCurrent->fetch_assoc();
	$schyear = $resultCurrent['schyear'];
	$sem = $resultCurrent['semester'];
}

$studenttype = (isset($_POST['studenttype'])) ? $_POST['studenttype'] : '';
$schoolid = (isset($_POST['schoolname'])) ? $_POST['schoolname'] : '';
$surname = (isset($_POST['surname'])) ? $_POST['surname'] : '';
$firstname = (isset($_POST['firstname'])) ? $_POST['firstname'] : '';

$sqlFilterArray = array();
if($studenttype != "")
{
	$sqlFilterArray[] = " studenttype LIKE '".$studenttype."'";
}
if($schoolid != "")
{
	$sqlFilterArray[] = " school LIKE '".$schoolid."'";
}
if($surname != "")
{
	$sqlFilterArray[] = " surname LIKE '".$surname."'";
}
if($firstname != "")
{
	$sqlFilterArray[] = " firstname LIKE '".$firstname."'";
}
$sqlFilter = "";
if(count($sqlFilterArray) > 0)
{
	$sqlFilter = "AND";
}
$sqlFilter .= implode('AND',$sqlFilterArray);
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
    #maintable tbody {
    display:block;
    height:300px;
    overflow:auto;
	}
	#maintable thead, tbody tr {
	    display:table;
	    width:100%;
	}


</style>
<div class="row" style="padding: 10px;">
	<div class="col-md-12 col-lg-12" id="mainContainer">
		<span><h4 style="color:gray;">Old Scholars Not Yet Renewing 
		<div class="pull-right">
		</div></h4></span>
		<br>
		<div class="table-responsive">
			<table class="table table-bordered " id="maintable">
				<thead>
					<th style="width:50px;text-align:center">#</th>
					<th style="width:250px;">Student Name</th>
					<th style="width:200px;">Student Type</th>
					<th style="width:150px;">Grade/Year</th>
					<th style="width:200px;">Course</th>
					<th style="width:200px;">School</th>
					<th style="width:200px;">S.Y/Semester</th>
					<th style="text-align: center;width:100px;">Action</th>
				</thead>
				<tbody style="font-size: 13px;">
					<?php
					$x = 0;
					$status = "";
					$scholartype = "";
					$graduateArray = array('4th Year');
					$getApplicant = "SELECT * FROM tbl_student WHERE status IN (10) ";
					$processApplicant = $db->query($getApplicant);
					if($processApplicant->num_rows > 0)
					{
						while($resultApplicant = $processApplicant->fetch_assoc())
						{	

							if($resultApplicant['semester'] == '2nd Semester')
							{
								if(in_array($resultApplicant['yearOrgrade'],$graduateArray))
								{
									//graduates
								}
								else
								{
									$checkAccount = 'SELECT * FROM tbl_account WHERE studentId = '.$resultApplicant['id'];
									$processAccount = $db->query($checkAccount);
									$resultAccount = $processAccount->fetch_assoc();

									if($resultAccount['renewstatus'] == 0)
									{
										if($resultApplicant['scholarType'] == 0)
										{
											$scholartype = "Full";
										}else{$scholartype = "Assistance";}
										$applicantId = $resultApplicant['id'];
										$getSchool = "SELECT schoolalias from tbl_school WHERE id = ".$resultApplicant['school'];
										$processSchool = $db->query($getSchool);
										$resultSchool = $processSchool->fetch_assoc();
										echo 
										"<tr>
											<td style='width:45px;text-align:center'>".++$x."</td>
											<td style='width:245px;'>".$resultApplicant['firstname']." ".$resultApplicant['surname']."</td>
											<td style='width:194px;'>".$resultApplicant['studenttype']."</td>
											<td style='width:149px;'>".$resultApplicant['yearOrgrade']."</td>
											<td style='width:194px;'>".$resultApplicant['course']."</td>
											<td style='width:194px;'>".$resultSchool['schoolalias']."</td>
											<td style='width:195px;'>".$resultApplicant['schoolyear']."/".$resultApplicant['semester']."</td>
											<td style='text-align:center;'><a href='viewOldScholar.php?id=".$resultApplicant['id']."' class=' btn-primary btn-sm' style='color:white;'>View</a></td>
										</tr>";
									}
								}
							}
							else
							{
								$checkAccount = 'SELECT * FROM tbl_account WHERE studentId = '.$resultApplicant['id'];
								$processAccount = $db->query($checkAccount);
								$resultAccount = $processAccount->fetch_assoc();

								if($resultAccount['renewstatus'] == 0)
								{
									if($resultApplicant['scholarType'] == 0)
									{
										$scholartype = "Full";
									}else{$scholartype = "Assistance";}
									$applicantId = $resultApplicant['id'];
									$getSchool = "SELECT schoolalias from tbl_school WHERE id = ".$resultApplicant['school'];
									$processSchool = $db->query($getSchool);
									$resultSchool = $processSchool->fetch_assoc();
									echo 
									"<tr>
										<td style='width:45px;text-align:center'>".++$x."</td>
										<td style='width:245px;'>".$resultApplicant['firstname']." ".$resultApplicant['surname']."</td>
										<td style='width:194px;'>".$resultApplicant['studenttype']."</td>
										<td style='width:149px;'>".$resultApplicant['yearOrgrade']."</td>
										<td style='width:194px;'>".$resultApplicant['course']."</td>
										<td style='width:194px;'>".$resultSchool['schoolalias']."</td>
										<td style='width:195px;'>".$resultApplicant['schoolyear']."/".$resultApplicant['semester']."</td>
										<td style='text-align:center;'><a href='viewOldScholar.php?id=".$resultApplicant['id']."' class=' btn-primary btn-sm' style='color:white;'>View</a></td>
									</tr>";
								}
							}

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