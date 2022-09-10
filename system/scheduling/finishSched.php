<?php
include('../../db/db.php');

$studentlevel = $_POST['studentlevel'];
$dataFor = $_POST['dataFor'];
$id = $_POST['id'];

$outputs = "";
if($dataFor == "Interview")
{
	//update all student to orientation status

	$sql = "SELECT * FROM tbl_schedule WHERE id = ".$id;
	$process = $db->query($sql);
	$result = $process->fetch_assoc();

	$studentlevelNumber = $result['studentlevel'];

	if($studentlevelNumber == 0)
	{
		$select = "SELECT * FROM tbl_student WHERE status = 2";
	}
	else
	{
		$select = "SELECT * FROM tbl_student WHERE studenttype = '".$studentlevel."' AND status = 2";
	}
	$processSelect = $db->query($select);
	if($processSelect->num_rows > 0)
	{
		while($resultSelect = $processSelect->fetch_assoc())
		{
			$update = "UPDATE tbl_student set status = 6 WHERE id = ".$resultSelect['id'];
			$processUpdate = $db->query($update);
			if($processUpdate)
			{
				$update1  = "UPDATE tbl_schedule set status = 1 WHERE id = ".$id;
				$processUpdate1 = $db->query($update1);
				echo "success";
			}
			else
			{
				echo $select;
			}

			  $sqlKey = "SELECT * FROM tbl_apikey";
		      $processKey = $db->query($sqlKey);
		      $resultKey = $processKey->fetch_assoc();
		      $theKey = $resultKey['apiKey'];
		      //get number 
		      $sqlNumber = "SELECT contactno FROM tbl_student WHERE id = ".$resultSelect['id'];
		      $processNumber = $db->query($sqlNumber);
		      $resultNumber = $processNumber->fetch_assoc();
		      $contactNo = $resultNumber['contactno'];

		      $message = "Good Day! Your scholarship application is now for approval. EPS Scholarship will notify you through sms when it is approved. This message is from EPS Scholarship";
		        $ch = curl_init();
		        $parameters = array(
		            'apikey' => $theKey, 
		            'number' => $contactNo,
		            'message' => $message,
		            'sendername' => 'SEMAPHORE'
		        );
		        curl_setopt( $ch, CURLOPT_URL,'http://api.semaphore.co/api/v4/messages' );
		        curl_setopt( $ch, CURLOPT_POST, 1 );
		        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );
		        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		        $output = curl_exec( $ch );
		        curl_close ($ch);
		}
	}
}

else
{
	$update  = "UPDATE tbl_schedule set status = 1 WHERE id = ".$id;
	$processUpdate = $db->query($update);
	if($processUpdate)
	{
		echo "success";
		
	}
	else
	{
		echo $update;
	}

}
