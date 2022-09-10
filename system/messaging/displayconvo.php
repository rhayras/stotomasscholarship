<?php
include ('../../db/db.php');
$senderId = $_POST['senderId'];//admin
$receiver = $_POST['receiver'];//student
echo "<table style='width:100%;border:none'>";
$sql = "SELECT * from tbl_chat order by id ASC";
$processQuery = $db->query($sql);
if($processQuery->num_rows > 0)
{
	while ($resultQuery = $processQuery-> fetch_assoc())
	{
		if ($resultQuery['senderId'] == $receiver and $resultQuery['receiverId'] == $senderId)
		{
			$getImage = "SELECT picture FROM tbl_student WHERE id = ".$receiver;
			$process = $db->query($getImage);
			$resultPic = $process->fetch_assoc();
			$image = $resultPic['picture'];
			echo '<tr>
				<td>
				<div class="pull-left " style="margin-right:5px;"><img src="../profilepicture/'.$image.'" style="height:40px;width:40px;border-radius:50px;"></div>
				<div class="pull-left">
					<div id="myChat"  title="'.$resultQuery['dateTime'].'"class="effect1" style="background-color:gainsboro;padding:10px;border-radius:8px;max-width:400px;margin-bottom:10px;">
					<p style="font-size:14px;color:#1f1f1f;">'.$resultQuery['message'].'</p>
					</div>
				</div></td></tr>
				';
		}
		elseif ($resultQuery['receiverId'] == $receiver and $resultQuery['senderId'] == $senderId)
		{
			echo '<tr>
				<td>
				<div class="pull-right">
					<div>
						<div id="myChat" title="'.$resultQuery['dateTime'].'" class="effect1" style="background-color:#00C851;padding:10px;max-width:400px;border-radius:8px;margin-bottom:10px; -webkit-box-shadow: 0 10px 6px -6px #777;
       -moz-box-shadow: 0 10px 6px -6px #777;
            box-shadow: 0 10px 6px -6px #777;">
						<p style="font-size:14px;color:white">'.$resultQuery['message'].'</p>
						</div>
					</div>
				</div></td></tr>
				';
		}
		else
		{

		}
	}
}
else
{

}
echo "</table>";
?>