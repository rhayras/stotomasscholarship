<?php
session_start();
if (isset($_GET['day'])){
	$day =$_GET['day'];
}else{
	$day = date("j");
}
if (isset($_GET['month'])){
	$month =$_GET['month'];
}else {
	$month= date("n");    
}
if(isset($_GET['year'])){
	$year= $_GET['year'];
}else {
	$year = date("Y");
}

$currentTimeStamp = strtotime("$year-$month-$day");
$monthName = date("F",$currentTimeStamp );
$numDays = date("t",$currentTimeStamp );
$counter=0;
?>
<style type="text/css">
#myDateLink:hover{
	background-color: #1f1f1f;
	color:white;
	border-radius:10px;
	padding:10px;
}
</style>
<div style="background-color:whitesmoke;padding:5px;border-radius: 10px;">
	<div class="row"  style="padding:5px;">
		<div class="col-md-2 col-xs-2 col-sm-2">
			<center><a style="color:#00C851;font-size:17px;cursor:hand;" name="previousbutton"onclick="goLastMonth(<?php echo $month.",".$year;?>);"><i class="fa fa-chevron-left"></i></a></center>
		</div>
		<div class="col-md-8 col-xs-8 col-sm-8">
			<center><h3 style="color:#00C851;"><?php echo $monthName." ".$year;?></h3></center>
		</div>
		<div class="col-md-2 col-xs-2 col-sm-2">
			<center><a style="color:#00C851;font-size:17px;cursor:hand;" name="nextbutton"onclick="goNextMonth(<?php echo $month.",".$year;?>);"><i class="fa fa-chevron-right"></i></a></center>
		</div>
	</div>
	<table class="table table-responsive">
		<thead style="padding:10px;">
			<tr >
				<th style="border:1px solid transparent;padding:10px;text-align: center;color:#00C851;"><strong>Sun</strong></th>
				<th style="border:1px solid transparent;padding:10px;text-align: center;color:#00C851;"><strong>Mon</strong></th>
				<th style="border:1px solid transparent;padding:10px;text-align: center;color:#00C851;"><strong>Tue</strong></th>
				<th style="border:1px solid transparent;padding:10px;text-align: center;color:#00C851;"><strong>Wed</strong></th>
				<th style="border:1px solid transparent;padding:10px;text-align: center;color:#00C851;"><strong>Thu</strong></th>
				<th style="border:1px solid transparent;padding:10px;text-align: center;color:#00C851;"><strong>Fri</strong></th>
				<th style="border:1px solid transparent;padding:10px;text-align: center;color:#00C851;"><strong>Sat</strong></th>
			</tr>
		</thead>
		<tbody>
			<?php
			include('../db/db.php');
			$calDate = "";
			echo "<tr id='num' style='height:50px;width:300px;'>";
			for ($i =1;$i<$numDays+1;$i++,$counter++){
				$bgColor = 'white';
				$disabled = '';
				$color = '';
				$pointer = "" ;
				$cursor = "";
				$myEvent = "";
				$timeStamp =strtotime("$year-$month-$i");
				if ($i == 1){
					$firstDay = date ("w",$timeStamp);
					for($j =0;$j<$firstDay;$j++,$counter++){
						echo "<td  style='border:1px solid transparent;height:50px;width:300px;'>&nbsp;</td>";
					}
				}
				$monthstring = $month;
				$monthlength = strlen($monthstring);

				$daystring = $i;
				$daylength = strlen($daystring);

				$calDate = $month."-".$i."-".$year;
				if($calDate == date('n-j-Y'))
				{
					$bgColor = "#00C851";
					$color = "white";
					$pointer = "none";
					$cursor = "default";
					$myEvent = 'Today';
				}
				else
				{
					$bgColor = "";
				}
			//get holidays
				if ($monthlength <=1){
					$monthstring = "0".$monthstring;
				}
				if ($daylength <=1){
					$daystring = "0".$daystring;
				}
				$calendarDate=date("Y-m-d",strtotime($year."-".$month."-".$i));
				if($_SESSION['priviledge'] == 'student')
				{
					$studentInfo = "SELECT * FROM tbl_student WHERE id = ".$_SESSION['studentId'];
					$processInfo = $db->query($studentInfo);
					$resultInfo = $processInfo->fetch_assoc();
					$studenttype = "";
					if($resultInfo['studenttype'] == 'Senior High School')
					{
						$studenttype = 1;
					}
					else
					{
						$studenttype = 2;
					}

					//get sem
					$sql1 = "SELECT * FROM tbl_currentyear WHERE status != 2";
					$process1 = $db->query($sql1);
					$result1 = $process1->fetch_assoc();

					if($resultInfo['status'] != 7)
					{
						$getAllEvents = "SELECT * FROM tbl_schedule WHERE studentlevel IN (0,".$studenttype.") AND schedDate = '".$calendarDate."'  AND forWhat NOT IN ('Orientation','Releasing of Grant') AND schyear = '".$result1['schyear']."' AND schyear = '".$result1['semester']."' ";
						$processEvents = $db->query($getAllEvents);
						if($processEvents->num_rows > 0)
						{
							$resultEvents = $processEvents->fetch_assoc();
							$myEvent = $resultEvents['forWhat'];
							$bgColor = "#ff4444";
							$color = "white";
						}
						if($resultInfo['status'] == 4)
						{
							$getAllEvents = "SELECT * FROM tbl_schedule WHERE studentlevel IN (0,".$studenttype.") AND schedDate = '".$calendarDate."' AND forWhat IN ('Orientation','Releasing of Grant')  AND schyear = '".$result1['schyear']."' AND schyear = '".$result1['semester']."' ";
							$processEvents = $db->query($getAllEvents);
							if($processEvents->num_rows > 0)
							{
								$resultEvents = $processEvents->fetch_assoc();
								$myEvent = $resultEvents['forWhat'];
								$bgColor = "#ff4444";
								$color = "white";
							}
							$sqlEvent = "SELECT * FROM tbl_memo WHERE schyear = '".$result1['schyear']."' AND semester = '".$result1['semester']."' AND who IN ('All','".$resultInfo['studenttype']."') AND whenDate LIKE '".$calendarDate."%' ";
							$processEvent = $db->query($sqlEvent);
							if($processEvent->num_rows > 0)
							{
								$resultEvent = $processEvent->fetch_assoc();
								$myEvent = $resultEvent['what'];
								$bgColor = "#ff4444";
								$color = "white";
							}
						}
					}
					else
					{
						$getAllEvents = "SELECT * FROM tbl_schedule WHERE studentlevel IN (0,".$studenttype.") AND schedDate = '".$calendarDate."' AND forWhat IN ('Releasing of Grant')  AND schyear = '".$result1['schyear']."' AND schyear = '".$result1['semester']."' ";
						$processEvents = $db->query($getAllEvents);
						if($processEvents->num_rows > 0)
						{
							$resultEvents = $processEvents->fetch_assoc();
							$myEvent = $resultEvents['forWhat'];
							$bgColor = "#ff4444";
							$color = "white";
						}
						$sqlEvent = "SELECT * FROM tbl_memo WHERE schyear = '".$result1['schyear']."' AND semester = '".$result1['semester']."' AND who IN ('All','".$resultInfo['studenttype']."') AND whenDate LIKE '".$calendarDate."%' ";
						$processEvent = $db->query($sqlEvent);
						if($processEvent->num_rows > 0)
						{
							$resultEvent = $processEvent->fetch_assoc();
							$myEvent = $resultEvent['what'];
							$bgColor = "#ff4444";
							$color = "white";
						}
					}

				}
				else
				{
					$sql1 = "SELECT * FROM tbl_currentyear WHERE status != 2";
					$process1 = $db->query($sql1);
					$result1 = $process1->fetch_assoc();
					
					$studentAlias = '';
					$getAllEvents = "SELECT * FROM tbl_schedule WHERE schedDate = '".$calendarDate."'  AND schyear = '".$result1['schyear']."' AND schyear = '".$result1['semester']."' ";
					$processEvents = $db->query($getAllEvents);
					if($processEvents->num_rows > 0)
					{
						$resultEvents = $processEvents->fetch_assoc();
						if($resultEvents['studentlevel'] == 1) $studentAlias = 'SHS';
						if($resultEvents['studentlevel'] == 2) $studentAlias = 'College';
						$myEvent = $studentAlias.' '.$resultEvents['forWhat'];
						$bgColor = "#ff4444";
						$color = "white";
					}
					$sqlEvent = "SELECT * FROM tbl_memo WHERE schyear = '".$result1['schyear']."' AND semester = '".$result1['semester']."' AND whenDate LIKE '".$calendarDate."%' ";
						$processEvent = $db->query($sqlEvent);
						if($processEvent->num_rows > 0)
						{
							$resultEvent = $processEvent->fetch_assoc();
							$myEvent = $resultEvent['what'];
							$bgColor = "#ff4444";
							$color = "white";
						}
				}

				if ($counter % 7==0 )
				{
	
					echo "</tr><tr>";
					echo"<td align='center' id='days' style='border:1px solid transparent;height:50px;border-radius:10px;width:300px;background-color:".$bgColor.";'><a href='#' data='".$year."-".$month."-".$i."' class='dayBtn' style='color:".$color.";font-size:12px;'>".$i."<br>".$myEvent."</a></td>";
				}
				else {
					echo "<td align='center' id='days'  style='border:1px solid transparent;height:50px;border-radius:10px;width:300px;background-color:".$bgColor.";color:".$color."'><a href='#' data='".$year."-".$month."-".$i."'  class='dayBtn'  style='color:".$color.";font-size:12px;'>".$i."<br>".$myEvent."</a></td>";
				}
			}
			echo "</tr>";
			?>
		</tbody>
	</table>
</div>
