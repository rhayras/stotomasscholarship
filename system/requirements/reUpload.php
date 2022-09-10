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
    	top: 10px;
    }
</style>
<?php
$studentId = $_SESSION['studentId'];
$reqType = $_GET['reqType'];


$schoolReqArray = array('schoolid','gradecard','regform');
$folder= "";
if(!in_array($reqType,$schoolReqArray))
{
	$myFile = "";
	$sql = "SELECT * FROM tbl_municipalrequirements WHERE studentid = ".$studentId;
	$process = $db->query($sql);
	if($process->num_rows > 0)
	{
		$result = $process->fetch_assoc();
		$folder = "barangayrequirements";
	}
}
else
{	
	$folder = "schoolrequirements";
	$myFile = "";
	$sql = "SELECT * FROM tbl_schoolrequirements WHERE studentid = ".$studentId;
	$process = $db->query($sql);
	if($process->num_rows > 0)
	{
		$result = $process->fetch_assoc();
		$folder = "schoolrequirements";
	}
}
?>
<div class="row" style="padding: 10px;">
	<div class="col-md-12 col-lg-12" id="mainContainer">
		<h3>Re Upload Requirement</h3>
		<div class="row">
			<div class="col-md-6 col-lg-6">
				<p><small>Existing File</small></p>
				<iframe src="<?php echo $folder?>/<?php echo $result[$reqType]?>" style='height:450px;width: 100%;'></iframe>
			</div>
			<div class="col-md-6 col-lg-6">
				<p><small>Reupload here.</small></p>
				<form action="" method="POST" id="reuploadFormPLEASE" enctype="multipart/form-data">
					<input type="hidden" name="studentId" value="<?php echo $studentId?>" form="reuploadFormPLEASE">
					<input type="hidden" name="reqType" value="<?php echo $reqType?>" form="reuploadFormPLEASE">
					<div class="form-group">
						<input type="file" name="reupFile" id="file" form="reuploadFormPLEASE" required class="form-control" accept="application/pdf">
					</div>
					<div class="form-group">
						<input type="submit" name="submitReupload" class="btn btn-success" form="reuploadFormPLEASE">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
include('footer.php');


$schoolReqArray = array('schoolid','gradecard','regform');

if(isset($_POST['submitReupload']))
{
    $targetfolder = "barangayrequirements/";
    $targetfolder = $targetfolder . basename( $_FILES['reupFile']['name']) ;
    $fileName = basename( $_FILES['reupFile']['name']);
    $studentId = $_POST['studentId'];
    $reqType = $_POST['reqType'];

    $explode=  explode('.',$fileName);
	if($explode[1] == 'pdf')
	{
	    if(!in_array($reqType, $schoolReqArray))
	    {
	    	 
	  		 	 if(move_uploaded_file($_FILES['reupFile']['tmp_name'], $targetfolder))
			     {
			        $update = "UPDATE tbl_municipalrequirements set ".$reqType." = '".$fileName."' WHERE studentid = ".$studentId;
			        $process = $db->query($update);
			        if($process)
			        {
			        	$checkStatus = "SELECT * FROM tbl_reqstatus WHERE studentId = ".$studentId." AND requirements = '".$reqType."'";
			        	$processStatus = $db->query($checkStatus);
			        	if($processStatus->num_rows > 0)
			        	{
			        		$resultStatus = $processStatus->fetch_assoc();
			        		if($resultStatus['status'] == 2)
			        		{
			        			$updateStatus = "UPDATE tbl_reqstatus SET status = 0 WHERE studentId = ".$studentId." AND requirements = '".$reqType."'";
			        			$processUpdateStatus = $db->query($updateStatus);
			        		}
			        	}
			            ?>
			              <script>
			                swal({
			                      title: "Success",
			                      text: "Requirements  Re Uploaded",
			                      type: "success",
			                      showCancelButton: false,
			                      confirmButtonClass: "btn-success",
			                      confirmButtonText: "Okay"
			                    },
			                    function(isConfirm) {
			                      if (isConfirm) {
			                        window.location.replace("../requirements/");
			                      } 
			                    });
			              </script>
			            <?php 
			        }
			        else
			        {
			          ?>
			          <script>
			            alert("<?php echo $update ?>");
			          </script>
			          <?php
			        }
			     }
	    }
	    else
	    {
	    	if(move_uploaded_file($_FILES['reupFile']['tmp_name'], $targetfolder))
		    {
		        $update = "UPDATE tbl_schoolrequirements set ".$reqType." = '".$fileName."' WHERE studentid = ".$studentId;
		        $process = $db->query($update);
		        if($process)
		        {
		        	$checkStatus = "SELECT * FROM tbl_reqstatus WHERE studentId = ".$studentId." AND requirements = '".$reqType."'";
		        	$processStatus = $db->query($checkStatus);
		        	if($processStatus->num_rows > 0)
		        	{
		        		$resultStatus = $processStatus->fetch_assoc();
		        		if($resultStatus['status'] == 2)
		        		{
		        			$updateStatus = "UPDATE tbl_reqstatus SET status = 0 WHERE studentId = ".$studentId." AND requirements = '".$reqType."'";
		        			$processUpdateStatus = $db->query($updateStatus);
		        		}
		        	}
		            ?>
		              <script>
		                swal({
		                      title: "Success",
		                      text: "Requirements  Re Uploaded",
		                      type: "success",
		                      showCancelButton: false,
		                      confirmButtonClass: "btn-success",
		                      confirmButtonText: "Okay"
		                    },
		                    function(isConfirm) {
		                      if (isConfirm) {
		                        window.location.replace("../requirements/");
		                      } 
		                    });
		              </script>
		            <?php 
		        }
		        else
		        {
		          ?>
		          <script>
		            alert("<?php echo $update ?>");
		          </script>
		          <?php
		        }
		    }
	    }
	}
	else
	{
	     ?>
	      <script>
	        swal({
	              title: "ERROR",
	              text: "Requirement should be a pdf file!",
	              type: "error",
	              showCancelButton: false,
	              confirmButtonClass: "btn-danger",
	              confirmButtonText: "Okay"
	            },
	            function(isConfirm) {
	              if (isConfirm) {
	                window.location.replace("../requirements/");
	              } 
	            });
	      </script>
	    <?php 
	}
}
?>