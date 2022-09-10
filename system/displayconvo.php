<?php
include ('../db/db.php');
$senderId = $_POST['senderId'];//admin
$output = "";
echo "<table style='width:100%;'>";
$sql = "SELECT * from tbl_chat order by id ASC";
$processQuery = $db->query($sql);
if($processQuery->num_rows > 0)
{
	while ($resultQuery = $processQuery-> fetch_assoc())
	{
		if ($resultQuery['receiverId'] == $senderId)
		{
			echo '<tr>
				<td>
				<div class="pull-left" style="margin-right:5px;"><img src="../img/admin.png" style="height:30px;width:30px;border-radius:50px;"></div>
				<div class="pull-left">
					<div id="myChat" class="effect1" style="background-color:white;padding:10px;border-radius:8px;max-width:400px;margin-bottom:10px;">
					<p style="font-size:10px;">'.$resultQuery['message'].'<br><font size="1">'.$resultQuery['dateTime'].'</font></p>
					</div>
				</div></td></tr>
				';
		}
		elseif ($resultQuery['senderId'] == $senderId)
		{
			echo '<tr>
				<td>
				<div class="pull-right">
					<div>
						<div id="myChat" class="effect1" style="background-color:#00C851;padding:10px;max-width:400px;border-radius:8px;margin-bottom:10px; -webkit-box-shadow: 0 10px 6px -6px #777;
       -moz-box-shadow: 0 10px 6px -6px #777;
            box-shadow: 0 10px 6px -6px #777;">
						<p style="font-size:10px;color:white">'.$resultQuery['message'].'<br><font size="1">'.$resultQuery['dateTime'].'</font></p>
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