<?php
include('../../db/db.php');
include('header.php');

?>
<div class="row" style="padding: 10px;margin-top:10px;">
		<div class="col-md-12 col-lg-12" id="mainContainer">
			<div class="row">
							<div class="col-md-3 col-lg-3"></div>
			<div class="col-md-6 col-lg-6">
				<div class="divContainer" style="overflow-y: hidden;">
						<h4 style="background-color: #00C851;padding:5px;margin-bottom: 0px;color: white;">Messages</h4>
		                <div id="convoStudent" style="">
		                  <!-- convo here -->
		                </div>
	                    <form method="POST" id="studentChatForm"></form>
	                    <div class="chat">
	                        <div class="row">
	                          <div class="col-md-9 col-xs-9">
	                            <input type="hidden" value = "<?php echo date('Y-m-d h:i:s A') ?>" id="dateTime" name="dateTime" form="studentChatForm" >
	                            <input type="hidden"  id="sender" name="sender" form="studentChatForm" value="<?php echo $_SESSION['studentId']?>">
	                            <input type="hidden"  id="receiver" name="receiver" form="studentChatForm" value="admin">
	                            <textarea cols="40" row="3" name="messageAdmin" id="message" class="form-control" required placeholder = "Type a message..." style="width: 100%;" form="studentChatForm"></textarea>
	                          </div>
	                          <div class="col-md-3 col-xs-3">
	                            <input type = "submit" name="sendStudent" value="SEND" id="send" class="btn myBtn" style="height:57px;width:100%;" form="studentChatForm">
	                          </div>
	                        </div>
                         </div>
			    </div>
			</div>
			<div class="col-md-3 col-lg-3"></div>
			</div>
		</div>
	</div>

<?php
include('footer.php');
?>