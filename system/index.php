<?php

include('../db/db.php');
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
	  .effect1{
    -webkit-box-shadow: 0 10px 6px -6px #777;
       -moz-box-shadow: 0 10px 6px -6px #777;
            box-shadow: 0 10px 6px -6px #777;
}
</style>
<div class="row">
	<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
		<?php
		include('sidebar.php');
		?>
		<?php
		if($_SESSION['priviledge'] == "student")
		{
			$sql = "SELECT * FROM tbl_student WHERE id = ".$_SESSION['studentId'];
			$process = $db->query($sql);
			$result = $process->fetch_assoc();
			$studentType = $result['studenttype'];
			$status = $result['status'];

			//get sem
			$sql1 = "SELECT * FROM tbl_currentyear WHERE status != 2";
			$process1 = $db->query($sql1);
			$result1 = $process1->fetch_assoc();

			$studentTypeNo = 0;
			if($studentType == 'Senior High School') $studentTypeNo = 1;
			if($studentType == 'College') $studentTypeNo = 2;
			?>
			<!-- <br>
			<div id="eventTable">
				<h5>EPS Scholarship Events For This School Year</h5>
				<table class=" table-bordered" style="width: 100%;background-color: white;">
					<thead style="background-color:#00C851 ;color: white;">
						<th>#</th>
						<th>Event</th>
						<th>Date</th>
						<th>Time</th>
					</thead>
					<tbody>
						<?php
						$x = 0;
						if($status != 7)
						{
							$sql2 = "SELECT * FROM tbl_schedule WHERE studentlevel IN (0,".$studentTypeNo.")  AND schyear = '".$result1['schyear']."' AND sem = '".$result1['semester']."'  AND forWhat NOT IN ('Orientation','Releasing of Grant')";
							$process2 = $db->query($sql2);
							if($process2->num_rows > 0)
							{
								while($result2 = $process2->fetch_assoc())
								{
									echo
									"<tr>
										<td>".++$x."</td>
										<td>".$result2['forWhat']."</td>
										<td>".$result2['schedDate']."</td>
										<td>".$result2['schedTime']."</td>
									</tr>";
								}
							}
							if($status == 4)
							{
								$sql2 = "SELECT * FROM tbl_schedule WHERE studentlevel IN (0,".$studentTypeNo.")  AND schyear = '".$result1['schyear']."' AND sem = '".$result1['semester']."' AND forWhat IN ('Orientation','Releasing of Grant')";
								$process2 = $db->query($sql2);
								if($process2->num_rows > 0)
								{
									while($result2 = $process2->fetch_assoc())
									{
										echo
										"<tr>
											<td>".++$x."</td>
											<td>".$result2['forWhat']."</td>
											<td>".$result2['schedDate']."</td>
											<td>".$result2['schedTime']."</td>
										</tr>";
									}
								}
								$sqlEvent = "SELECT * FROM tbl_memo WHERE schyear = '".$result1['schyear']."' AND semester = '".$result1['semester']."' AND who IN ('All','".$studentType."')";
								$processEvent = $db->query($sqlEvent);
								if($processEvent->num_rows > 0)
								{
									while($resultEvent = $processEvent->fetch_assoc())
									{
										$explode = explode(" ",$resultEvent['whenDate']);
										$eventDate = $explode[0];
										$eventTime = $explode[1];
										echo
										"<tr>
											<td>".++$x."</td>
											<td>".$resultEvent['what']."</td>
											<td>".$eventDate."</td>
											<td>".$eventTime."</td>
										</tr>";
									}
								}
							}
						}
						else
						{
							$sql2 = "SELECT * FROM tbl_schedule WHERE studentlevel IN (0,".$studentTypeNo.")  AND schyear = '".$result1['schyear']."' AND sem = '".$result1['semester']."' AND forWhat IN ('Releasing of Grant')";
							$process2 = $db->query($sql2);
							if($process2->num_rows > 0)
							{
								while($result2 = $process2->fetch_assoc())
								{
									echo
									"<tr>
										<td>".++$x."</td>
										<td>".$result2['forWhat']."</td>
										<td>".$result2['schedDate']."</td>
										<td>".$result2['schedTime']."</td>
									</tr>";
								}
							}
							$sqlEvent = "SELECT * FROM tbl_memo WHERE schyear = '".$result1['schyear']."' AND semester = '".$result1['semester']."' AND who IN ('All','".$studentType."')";
							$processEvent = $db->query($sqlEvent);
							if($processEvent->num_rows > 0)
							{
								while($resultEvent = $processEvent->fetch_assoc())
								{
									$explode = explode(" ",$resultEvent['whenDate']);
									$eventDate = $explode[0];
									$eventTime = $explode[1];
									echo
									"<tr>
										<td>".++$x."</td>
										<td>".$resultEvent['what']."</td>
										<td>".$eventDate."</td>
										<td>".$eventTime."</td>
									</tr>";
								}
							}
						}
						?>
					</tbody>
				</table>
			</div> -->

			<?php
		}
		?>
	</div>
	<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
		<br>
		<div id="calendarContainer" style="height: auto;">
			<h3>Event Calendar</h3>
	        <div id="companyCalendar"></div>
		</div>
	</div>
</div>

<?php
include('footer.php');
?>
<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
  $('#convoStudent').animate({scrollTop: $('#convoStudent').get(0).scrollHeight}, 1000);
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>
  </script>
     <script src="../js/jquery.nicescroll.js"></script>
  <script>
  $("#convoStudent").niceScroll({
      cursorwidth: '0px', 
      cursorfixedheight: 70,
      autohidemode: true, 
      zindex: 999,
      cursorcolor: 'gainsboro'
  });
</script>
<script>
        function studentConvo()
      {
        var senderId = '<?php echo $_SESSION['studentId']?>';//admin
        $.ajax({
          url     : 'displayconvo.php',
          method  : 'POST',
          data    : {senderId:senderId},
          success : function(data)
          {
            console.log(data);
            $('#convoStudent').html(data);
            
          }
        })
      }
         studentConvo();
     setInterval(function() {
      studentConvo();
       }, 2000);

    $(document).ready(function(){
      studentConvo();
       $('#studentChatForm').on('submit', function(event){
           event.preventDefault();
           var formdata = $(this).serialize();
           $.ajax({
              url     :   'saveChat.php',
              method  :   'POST',
              data    :   formdata,
              success :   function(data)
              {
                  $('#studentChatForm')[0].reset();
                  $('#convoStudent').animate({scrollTop: $('#convoStudent').get(0).scrollHeight}, 1000);
              }
           })
       })
    })
    $('#message').on('focus',function(){
          $('#convoStudent').animate({scrollTop: $('#convoStudent').get(0).scrollHeight}, 1000);
       })
  </script>