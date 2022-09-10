<?php
include('headerNav.php');
?>

  <section class="section-services section-t8">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title-wrap d-flex justify-content-between">
            <div class="title-box">
              <center><h2 class="title-a">Recover Account Password</h2></center>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 col-lg-12">
          <p>Kindly enter the registered phone number in your account to recover your password. You will receive a text message that contains your password</a><br>
      	 </div>
      </div>
      <div class="row">
      	<div class="col-md-3"></div>
      	<div class="col-md-6">
      		<center>
          		<form action="forgotpassword.php" method="POST">
          			<div class="form-group">
          				<label>Phone Number</label>
          				<input placeholder="Enter your phone number here..." onkeypress="return isNumber(event)"  type= "text" name="mobileno" maxlength="11" style="height: 50px;font-size: 20px;text-align: center;" required>
          			</div>
          			<div class="form-group">
          				<input type="submit" name="submit" class="btn btn-success" value="Submit">
          			</div>
          		</form>
          	</center>
      	</div>
      	<div class="col-md-3"></div>
      </div>
    </div>
  </section>
<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <div id="preloader"></div>

  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/popper/popper.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/scrollreveal/scrollreveal.min.js"></script>
  <!-- Contact Form JavaScript File -->
  <script src="js/sweetalert.min.js"></script>

  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>

</body>
</html>
  <!--/ Services End /-->
<?php

if(isset($_POST['submit']))
{
	$mobileno = $_POST['mobileno'];

	$sqlCheck = "SELECT * FROM tbl_student WHERE contactno = ".$mobileno;
	$processCheck = $db->query($sqlCheck);
	if($processCheck->num_rows > 0)
	{
		$result = $processCheck->fetch_assoc();
		$studentId = $result['id'];
		$sqlAccount = "SELECT * FROM tbl_account WHERE studentId =".$studentId;
		$processAccount = $db->query($sqlAccount);
		if($processAccount->num_rows > 0)
		{
			$resultAccount = $processAccount->fetch_assoc();
			$password = $resultAccount['password'];
			$username = $resultAccount['username'];

			$sqlKey = "SELECT * FROM tbl_apikey";
	        $processKey = $db->query($sqlKey);
	        $resultKey = $processKey->fetch_assoc();
	        $theKey = $resultKey['apiKey'];
			$message = "Good Day! Your account username is ".$username." and password is ".$password." This message is from EPS Scholarship";
            $ch = curl_init();
            $parameters = array(
                'apikey' => $theKey, 
                'number' => $mobileno,
                'message' => $message,
                'sendername' => 'SEMAPHORE'
            );
            curl_setopt( $ch, CURLOPT_URL,'http://api.semaphore.co/api/v4/messages' );
            curl_setopt( $ch, CURLOPT_POST, 1 );
            curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            $output = curl_exec( $ch );
            curl_close ($ch);
            //echo $output;
            ?>
			<script>
				swal("Success", "You will receive a text message containing your password.", "success");
			</script>
			<?php
		}
	}
	else
	{
		?>
		<script>
			swal("Error", "Phone number doesn't exist. Please try again.", "error");
		</script>
		<?php
	}

}

?>
  	<script>
		function isNumber(evt) {
			evt = (evt) ? evt : window.event;
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if (charCode > 31 && (charCode < 48 || charCode > 57)) {
				return false;
			}
			return true;
		}
	</script>