 <?php
	session_start();
	include_once 'dbconnector.php';
	$sql = "SELECT * FROM tbl_driver_details where c_no = " . $_GET['id']   ;
	
	$result = $conn->query($sql);
	$row=$result->fetch_assoc();
	
	echo $row['report_no'] . "|" . $row['driver_name'] . "|" . $row['driver_address'] . "|" . $row['driver_license'] . "|" . $row['driver_license_type'] . "|" . $row['age'] . "|" . $row['injury'] . "|" . $row['error'] . "|" . $row['alcohol_drugs'] . "|" . $row['seatbelt_helmet'];

?>



