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

//get applicants info
$applicantIdArray = array();
$getApplicant = "SELECT * FROM tbl_student WHERE id = ".$_GET['id']."";
$processApplicant = $db->query($getApplicant);
$resultApplicant = $processApplicant->fetch_assoc();

//get school
//get school
$getSchool = "SELECT * FROM tbl_school WHERE id = ".$resultApplicant['school']."";
$processSchool = $db->query($getSchool);
$resultSchool = $processSchool->fetch_assoc();
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
    	height: auto;
    }
    .card {
    background-color: #ffffff;
    border: 1px solid rgba(0, 34, 51, 0.1);
    box-shadow: 2px 4px 10px 0 rgba(0, 34, 51, 0.05), 2px 4px 10px 0 rgba(0, 34, 51, 0.05);
    border-radius: 0.15rem;
}

/* Tabs Card */

.tab-card {
  border:1px solid #eee;
}

.tab-card-header {
  background:none;
}
/* Default mode */
.tab-card-header > .nav-tabs {
  border: none;
  margin: 0px;
}
.tab-card-header > .nav-tabs > li {
  margin-right: 2px;
}
.tab-card-header > .nav-tabs > li > a {
  border: 0;
  border-bottom:2px solid transparent;
  margin-right: 0;
  color: #737373;
  padding: 2px 15px;
}

.tab-card-header > .nav-tabs > li > a.show {
    border-bottom:2px solid #00C851;
    color: #00C851;
}
.tab-card-header > .nav-tabs > li > a:hover {
    color: #00C851;
    border-bottom:2px solid #00C851;
}

.tab-card-header > .tab-content {
  padding-bottom: 0;
}
</style>
 <div class="modal fade bd-example-modal-lg" id="approvemodal">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Approve Renewal</h5>
                  <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
              </div>
              <div class="modal-body">
                  <form action="" method="POST" id="approveForm">
                    <div class="form-group">
                    	<input type="hidden" name="studentid" form="approveForm" id="student" value="<?php echo $_GET['id']?>">
                    </div>
          					<div class="form-group">
          						<label>What type of scholarship to be granted?</label><br>
          						<input type="radio" name="scholarshiptype" id="fullradio" form="approveForm" value="0">
          						<label for="fullradio">Full</label>&nbsp;&nbsp;&nbsp;
          						<input type="radio" name="scholarshiptype" id="assistanceradio" form="approveForm" value="1">
          						<label for="assistanceradio">Assistance</label>
          					</div>
          					<div class="form-group" id="grantDiv">
          						<label>Amount to be granted</label>
          						<input type="text" name="amount" id="amount" class="form-control" form="approveForm">
          					</div>
                    <div class="pull-right">
                    	<div class="form-group">
	                      <input type="submit" value="Submit" name="submitApprove" class="btn btn-success" form="approveForm">
	                    </div>
                    </div>
                  </form>
              </div>
              <div class="modal-footer">
              </div>
          </div>
      </div>
  </div>
<div class="row" style="padding: 10px;">
	<div class="col-md-12 col-lg-12" id="mainContainer">
		<div class="row" style="margin-bottom:-25px;">
			<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
				<center>
					<img src='../profilepicture/<?php echo $resultApplicant['picture']?>' class="img-responsive" style='width: 200px;height: 200px;'>
					<h3 style="color:gray;"><?php echo $resultApplicant['surname'].", ".$resultApplicant['firstname']?></h3>
				</center>
			</div>
			<div class="col-md-8 col-lg-8 col-xs-12 col-sm-12"  style="height:450px;overflow-y: scroll">
				<div class="card mt-3 tab-card">
        <div class="card-header tab-card-header">
          <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="One" aria-selected="true">Scholarship Info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="Two" aria-selected="false">Personal Info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="three-tab" data-toggle="tab" href="#three" role="tab" aria-controls="Three" aria-selected="false">Requirements</a>
            </li>
          </ul>
        </div>

        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active p-3" id="one" role="tabpanel" aria-labelledby="one-tab">
             <h5 class="card-title">Scholarship History</h5>  
                <table class="table table-striped table-bordered" style="width: 100%;font-size: 13px;">
                  <thead>
                    <th>#</th>
                    <th>Student Type</th>
                    <th>Year/Level</th>
                    <th>School Year/Sem</th>
                    <th>GWA</th>
                    <th>Scholarship Type</th>
                    <th>Grant</th>
                  </thead>
                  <tbody>
                  <?php
                  $x = 0;
                  $scholartype = "";
                  $grant = "";
                  $getHistory = "SELECT * FROM tbl_scholarhistory WHERE studentId = ".$resultApplicant['id']." ORDER BY id DESC";
                  $processHistory = $db->query($getHistory);
                  if($processHistory->num_rows > 0)
                  {
                    while($resultHistory = $processHistory->fetch_assoc())
                    {
                      if($resultHistory['scholartype'] == 0)
                      {
                        $scholartype = "Full Scholarship";
                      }else{$scholartype = "Assistance Scholarship";}

                      if($resultHistory['grantprice'] != "")
                      {
                         $grant = " &#8369;".number_format($resultHistory['grantprice'],2);
                        
                      }else{
                          $grant = " &#8369;".number_format(0,2);
                      }
                      echo
                      "<tr>
                        <td>".++$x."</td>
                        <td>".$resultHistory['studenttype']."</td>
                        <td>".$resultHistory['yearOrgrade']."</td>
                        <td>".$resultHistory['schoolyear']."/".$resultHistory['sem']."</td>
                        <td>".$resultHistory['gwa']."</td>
                        <td>".$scholartype."</td>
                        <td>".$grant."</td>
                      </tr>";
                    }
                  }
                  ?>
                </tbody>
                </table>
          </div>
          <!-- TAB 2 -->
          <div class="tab-pane fade p-3" id="two" role="tabpanel" aria-labelledby="two-tab">
              <h5 class="card-title">Personal Information</h5>
              <table class=" table-striped table-bordered" style="table-layout: fixed;width: 100%;font-size: 13px;">
            <tr>
              <td style="padding:5px;">Address</td>
              <td><?php echo $resultApplicant['address']?></td>
            </tr>
            <tr>
              <td style="padding:5px;">Birth Date</td>
              <td><?php echo $resultApplicant['bday']?></td>
            </tr>
            <tr>
              <td style="padding:5px;">Age</td>
              <td><?php echo $resultApplicant['age']?> Years Old</td>
            </tr>
            <tr>
              <td style="padding:5px;">Gender</td>
              <td><?php echo $resultApplicant['gender']?></td>
            </tr>
            <tr>
              <td style="padding:5px;">Religion</td>
              <td><?php echo $resultApplicant['religion']?></td>
            </tr>
            <tr>
              <td style="padding:5px;">Contact No</td>
              <td><?php echo $resultApplicant['contactno']?></td>
            </tr>
            <tr>
              <td style="padding:5px;">Email</td>
              <td><?php echo $resultApplicant['email']?></td>
            </tr>
            <tr>
              <td style="padding:5px;">Father's Name</td>
              <td><?php echo $resultApplicant['fathername']?></td>
            </tr>
            <tr>
              <td style="padding:5px;">Father's Age</td>
              <td><?php echo $resultApplicant['fatherAge']?></td>
            </tr>
            <tr>
              <td style="padding:5px;">Father's Work</td>
              <td><?php echo $resultApplicant['fatherwork']?></td>
            </tr>
            <tr>
              <td style="padding:5px;">Mother's Name</td>
              <td><?php echo $resultApplicant['mothername']?></td>
            </tr>
            <tr>
              <td style="padding:5px;">Mother's Age</td>
              <td><?php echo $resultApplicant['motherAge']?></td>
            </tr>
            <tr>
              <td style="padding:5px;">Mother's Work</td>
              <td><?php echo $resultApplicant['motherwork']?></td>
            </tr>
            <tr>
              <td style="padding:5px;">Monthly Gross Income</td>
              <td><?php echo $resultApplicant['grosspermonth']?></td>
            </tr> 
        </table>
          </div>
          <!-- END TAB 2 -->
          <!-- TAB 3 -->
          <div class="tab-pane fade p-3" id="three" role="tabpanel" aria-labelledby="three-tab">
              <h5 class="card-title">Student Requirements</h5>
              <div class="table-responsive">
                  <table class="table-bordered table-striped" style="table-layout: fixed;width: 100%;font-size: 13px;">
                      <tr>
              <td>Application Form</td>
              <?php
                $remarks = "";
                $enabled = "";
                $check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$resultApplicant['id']." AND applicationForm != ''";
                $processCheck = $db->query($check);
                if($processCheck->num_rows > 0)
                {
                  $resultCheck = $processCheck->fetch_assoc();
                  $remarks = "<a target='_blank' href='../requirements/barangayrequirements/".$resultCheck['applicationForm']."'>View Document</a>";
                  $enabled = "disabled";
                }
                else
                {
                  $remarks = "No Document Found";
                }
              ?>
              <td><?php echo $remarks?></td>
            </tr>
            <tr>
              <td>Birth Certificate</td>
              <?php
                $remarks = "";
                $enabled = "";
                $check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$resultApplicant['id']." AND bcert != ''";
                $processCheck = $db->query($check);
                if($processCheck->num_rows > 0)
                {
                  $resultCheck = $processCheck->fetch_assoc();
                  $remarks = "<a target='_blank' href='../requirements/barangayrequirements/".$resultCheck['bcert']."'>View Document</a>";
                  $enabled = "disabled";
                }
                else
                {
                  $remarks = "No Document Found";
                }
              ?>
              <td><?php echo $remarks?></td>
            </tr>
            <tr>
              <td>High School Card/Form 138</td>
              <?php
                $remarks = "";
                $enabled = "";
                $check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$resultApplicant['id']." AND form138 != ''";
                $processCheck = $db->query($check);
                if($processCheck->num_rows > 0)
                {
                  $resultCheck = $processCheck->fetch_assoc();
                  $remarks = "<a target='_blank' href='../requirements/barangayrequirements/".$resultCheck['form138']."'>View Document</a>";
                  $enabled = "disabled";
                }
                else
                {
                  $remarks = "No Document Found";
                }
              ?>
              <td><?php echo $remarks?></td>
            </tr>
            <tr>
              <td>Certificate of Good Moral Character</td>
              <?php
                $remarks = "";
                $enabled = "";
                $check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$resultApplicant['id']." AND goodMoral != ''";
                $processCheck = $db->query($check);
                if($processCheck->num_rows > 0)
                {
                  $resultCheck = $processCheck->fetch_assoc();
                  $remarks = "<a target='_blank' href='../requirements/barangayrequirements/".$resultCheck['goodMoral']."'>View Document</a>";
                  $enabled = "disabled";
                }
                else
                {
                  $remarks = "No Document Found";
                }
              ?>
              <td><?php echo $remarks?></td>
            </tr>
            <tr>
              <td>Barangay Clearance</td>
              <?php
                $remarks = "";
                $enabled = "";
                $check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$resultApplicant['id']." AND brgyclearance != ''";
                $processCheck = $db->query($check);
                if($processCheck->num_rows > 0)
                {
                  $resultCheck = $processCheck->fetch_assoc();
                  $remarks = "<a target='_blank' href='../requirements/barangayrequirements/".$resultCheck['brgyclearance']."'>View Document</a>";
                  $enabled = "disabled";
                }
                else
                {
                  $remarks = "No Document Found";
                }
              ?>
              <td><?php echo $remarks?></td>
            </tr>
            <tr>
              <td>Vicinity Map/House Sketch</td>
              <?php
                $remarks = "";
                $enabled = "";
                $check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$resultApplicant['id']." AND houseSketch != ''";
                $processCheck = $db->query($check);
                if($processCheck->num_rows > 0)
                {
                  $resultCheck = $processCheck->fetch_assoc();
                  $remarks = "<a target='_blank' href='../requirements/barangayrequirements/".$resultCheck['houseSketch']."'>View Document</a>";
                  $enabled = "disabled";
                }
                else
                {
                  $remarks = "No Document Found";
                }
              ?>
              <td><?php echo $remarks?></td>
            </tr>
            <tr>
              <td>Parents Voter's ID</td>
              <?php
                $remarks = "";
                $enabled = "";
                $check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$resultApplicant['id']." AND votersId != ''";
                $processCheck = $db->query($check);
                if($processCheck->num_rows > 0)
                {
                  $resultCheck = $processCheck->fetch_assoc();
                  $remarks = "<a target='_blank' href='../requirements/barangayrequirements/".$resultCheck['votersId']."'>View Document</a>";
                  $enabled = "disabled";
                }
                else
                {
                  $remarks = "No Document Found";
                }
              ?>
              <td><?php echo $remarks?></td>
            </tr>
            <tr>
              <td>Certificate of Employement/Certificate of Unemployment (If parent is employed or unemployed)</td>
              <?php
                $remarks = "";
                $enabled = "";
                $check = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$resultApplicant['id']." AND parentCert != ''";
                $processCheck = $db->query($check);
                if($processCheck->num_rows > 0)
                {
                  $resultCheck = $processCheck->fetch_assoc();
                  $remarks = "<a target='_blank' href='../requirements/barangayrequirements/".$resultCheck['parentCert']."'>View Document</a>";
                  $enabled = "disabled";
                }
                else
                {
                  $remarks = "No Document Found";
                }
              ?>
              <td><?php echo $remarks?></td>
            </tr>
              <tr>
              <td>Previous School Registration Form</td>
              <?php
              $remarks = "";
              $enabled = "";
              $check = "SELECT * FROM tbl_schoolrequirements WHERE studentid = ".$resultApplicant['id']." AND regform != '' AND status = 0 AND schoolyear = '".$schyear."' AND semester = '".$sem."'";
              $processCheck = $db->query($check);
              if($processCheck->num_rows > 0)
              {
                $resultCheck = $processCheck->fetch_assoc();
                $remarks = "<a target='_blank' href='../requirements/schoolrequirements/".$resultCheck['regform']."'>View Document</a>";
                  $enabled = "disabled";
              }
              else
              {
                $remarks = "No Document Found";
              }
              ?>
              <td><?php echo $remarks?></td>
            </tr>
            <tr>
              <td>Previous Grade Card</td>
              <?php
              $remarks = "";
              $enabled = "";
              $check = "SELECT * FROM tbl_schoolrequirements WHERE studentid = ".$resultApplicant['id']." AND gradecard != '' AND status = 0 AND schoolyear = '".$schyear."' AND semester = '".$sem."'";
              $processCheck = $db->query($check);
              if($processCheck->num_rows > 0)
              {
                $resultCheck = $processCheck->fetch_assoc();
                $remarks = "<a target='_blank' href='../requirements/schoolrequirements/".$resultCheck['gradecard']."'>View Document</a>";
                  $enabled = "disabled";
              }
              else
              {
                $remarks = "No Document Found";
              }
              ?>
              <td><?php echo $remarks?></td>
            </tr>
            <tr>
              <td>School ID</td>
              <?php
              $remarks = "";
              $enabled = "";
              $check = "SELECT * FROM tbl_schoolrequirements WHERE studentid = ".$resultApplicant['id']." AND schoolid != '' AND status = 0 AND schoolyear = '".$schyear."' AND semester = '".$sem."'";
              $processCheck = $db->query($check);
              if($processCheck->num_rows > 0)
              {
                $resultCheck = $processCheck->fetch_assoc();
                $remarks = "<a target='_blank' href='../requirements/schoolrequirements/".$resultCheck['schoolid']."'>View Document</a>";
                  $enabled = "disabled";
              }
              else
              {
                $remarks = "No Document Found";
              }
              ?>
              <td><?php echo $remarks?></td>
            </tr>
                  </table>
              </div>             
          </div>
          <!-- END TAB 3 -->
        </div>
      </div>
			</div>
		</div>
		<br><br><br>
	</div>
</div>
<?php
	include('footer.php');
?>
<script>
  $(document).ready(function(){
    $('#one-tab').click();
  })
</script>