<?php
include('../../db/db.php');
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
$scholartype = (isset($_POST['studentScholarshipType'])) ? $_POST['studentScholarshipType'] : '';
$gradeOrYear = (isset($_POST['gradeyear'])) ? $_POST['gradeyear'] : '';

$sqlFilterArray = array();
if($studenttype != "")
{
	$sqlFilterArray[] = " studenttype LIKE '".$studenttype."'";
}
if($schoolid != "")
{
	$sqlFilterArray[] = " school LIKE '".$schoolid."'";
}
if($scholartype != "")
{
	$sqlFilterArray[] = " scholarType LIKE '".$scholartype."'";
}

if($gradeOrYear != "")
{
	$sqlFilterArray[] = " yearOrgrade LIKE '".$gradeOrYear."'";
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
$totalRecords = "SELECT * FROM tbl_student WHERE status IN (4,7) AND semester = '".$sem."' AND schoolyear = '".$schyear."' ".$sqlFilter." ";
$processTotalRecords = $db->query($totalRecords);
$totalScholars = $processTotalRecords->num_rows;

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
    .maintable tbody {
    display:block;
    height:300px;
    overflow:auto;
	}
	.maintable thead,  .maintable tr {
	    display:table;
	    width:100%;
	}


</style>
<div class="row" style="padding: 10px;">
	<div class="col-md-12 col-lg-12" id="mainContainer">
		<span>
			<h4 style="color:gray;">
				EPS Scholars
				<div class="pull-right">
					  <a href='#' class="btn btn-primary btn-sm" data-toggle='modal' data-target='#filterModal'><i class='fa fa-search'></i> | Filter </a>
				</div>
		 	</h4>
		</span>
			
		<span style="margin-top:5px;">Total Records: <?php echo $totalScholars?></span>
		<div class="table-responsive">
			<table class="table table-bordered maintable" >
				<thead>
					<th style="width:100px;text-align:center"></th>
					<th style="width:250px;">Student Name</th>
					<th style="width:200px;">Student Type</th>
					<th style="width:150px;">Grade/Year</th>
					<th style="width:200px;">Course</th>
					<th style="width:200px;">School</th>
					<th style="width:200px;">Scholarship</th>
					<th style="text-align: center;width:100px;">Action</th>
				</thead>
				<tbody style="font-size: 13px;">
					<?php
					$x = 0;
					$status = "";
					$scholartype = "";
					$getApplicant = "SELECT * FROM tbl_student WHERE status IN (4,7) AND semester = '".$sem."' AND schoolyear = '".$schyear."' ".$sqlFilter." ORDER BY studenttype DESC";
					$processApplicant = $db->query($getApplicant);
					if($processApplicant->num_rows > 0)
					{
						while($resultApplicant = $processApplicant->fetch_assoc())
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
								<td style='width:90px;text-align:center'><img src='../profilepicture/".$resultApplicant['picture']."' style='width:50px;height:50px;'></td>
								<td style='width:230px;'>".$resultApplicant['firstname']." ".$resultApplicant['surname']."</td>
								<td style='width:187px;'>".$resultApplicant['studenttype']."</td>
								<td style='width:146px;'>".$resultApplicant['yearOrgrade']."</td>
								<td style='width:188px;'>".$resultApplicant['course']."</td>
								<td style='width:186px;'>".$resultSchool['schoolalias']."</td>
								<td style='width:190px;'>".$scholartype."</td>
								<td style='text-align:center;'><a href='viewapplicant.php?id=".$resultApplicant['id']."' class=' btn-primary btn-sm' style='color:white;'>View</a></td>
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