 <?php
	session_start();
	include_once 'dbconnector.php';
	$sql = "SELECT * FROM tbl_passenger_casualties_details where c_no = " . $_GET['id']   ;
	
	$result = $conn->query($sql);
	$row=$result->fetch_assoc();
	
	echo $row['report_no'] . "|" . $row['passenger_name'] . "|" . $row['passenger_address'] . "|" . $row['passenger_vehicle_no'] . "|" . $row['passenger_gender'] . "|" . $row['passenger_age'] . "|" . $row['passenger_injury'] . "|" . $row['passenger_position'] . "|" . $row['passenger_action'];



?>



