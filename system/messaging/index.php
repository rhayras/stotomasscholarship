<?php
include('../../db/db.php');
include('header.php');

?>
<style>
	
</style>
	<div class="row" style="padding: 10px;margin-top:10px;">
		<div class="col-md-12 col-lg-12" id="mainContainer">
			<div class="row">
				<div class="col-md-4 col-lg-4">
					<div class="divContainer">
						<h4 style="padding:5px;margin-bottom: 0px;">Scholar List</h4>
						<?php
							$color = "";
							$studentId = "";
							$getScholars = "SELECT * FROM tbl_student WHERE status IN (4,7) ORDER by firstname";
							$processScholars = $db->query($getScholars);
							if($processScholars->num_rows > 0)
							{
								while($resultScholars = $processScholars->fetch_assoc())
								{
									$studentId = $resultScholars['id'];
									$checkOnline = "SELECT activeStatus FROM tbl_account WHERE studentId = ".$resultScholars['id'];
									$processCheck = $db->query($checkOnline);
									$resultCheck = $processCheck->fetch_assoc();
									$activeStatus = $resultCheck['activeStatus'];
									if($activeStatus == 1)
									{
										$color = "#00C851";
									}else{$color = "gainsboro";}
									?>
									<div id="individual" class="individual container<?php echo $studentId?>" studentId="<?php echo $studentId?>" studentName = "<?php echo $resultScholars['firstname']." ".$resultScholars['surname']?>">
										<div class="row">
											<div class="col-md-2 col-lg-2 col-xs-4 col-sm-4">
												<img src="../profilepicture/<?php echo $resultScholars['picture']?>">
											</div>
											<div class="col-md-10 col-lg-10 col-xs-8 col-sm-8">
												<p style="line-height:15px;"><?php echo $resultScholars['firstname']." ".$resultScholars['surname']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="dot" style="background-color: <?php echo $color?>"></span> <?php
												$sql = "SELECT * FROM tbl_chat WHERE status = 1 AND senderId = ".$resultScholars['id']." GROUP BY senderId";
												$process = $db->query($sql);
												if($process->num_rows > 0)
												{
													$resultChat = $process->fetch_assoc();
													?>
													<span class="badge myChatNotif" style="background-color: red;color: white;border-radius: 50%;"><?php echo $process->num_rows?></span>
													<?php
												}
												?><br >
													<small><?php echo $resultScholars['studenttype']." / ".$resultScholars['yearOrgrade']?></small></p>

											</div>

										</div>
									</div>
									<?php
								}
							}
						?>
					</div>

				</div>
				<div class="col-md-8 col-lg-8">
					<div class="divContainer" style="overflow-y: hidden;">
						<h4 style="background-color: #00C851;padding:10px;min-height:45px;margin-bottom: 0px;color: white;" id="studentName"></h4>
	                    <div id="convoAdmin" style="border: 1px solid gainsboro;margin-bottom: 10px;">
	                      <!-- convo here -->
	                    </div>
	                    <form method="POST" id="adminChatForm"></form>
	                    <div class="chat" style="padding: 5px;margin-top: -10px;border: 1px solid gainsboro">
	                        <div class="row">
	                          <div class="col-md-11 col-xs-11 col-sm-11 col-lg-11">
	                          	<input type="hidden" name="receiver" id="receiver" form="adminChatForm">
	                          	<input type="hidden" name="sender" id="sender" form="adminChatForm" value="<?php echo $_SESSION['adminId']?>">

	                            <input type="hidden" value = "<?php echo date('Y-m-d h:i:s A') ?>" id="dateTime" name="dateTime" form="adminChatForm" >
	                            <textarea  name="messageAdmin" id="message" required placeholder = "Type a message..."  form="adminChatForm"></textarea>
	                          </div>
	                          <div class="col-md-1 col-xs-1 col-sm-1 col-lg-1">
	                          	<button type = "submit" name="sendAdmin" value="SEND" id="send" class="btn myBtn" form="adminChatForm" style="margin-left:-20px; min-height: 50px;background-color: white; margin-top: 8px;"><i class="fa fa-paper-plane" aria-hidden="true" style="color: #00C851;font-size: 25px;"></i></button>
	                          </div>
	                        </div>
                         </div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php
include('footer.php');
?>