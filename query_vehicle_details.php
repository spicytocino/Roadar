 <?php
	session_start();
	include_once 'dbconnector.php';
	$sql = "SELECT * FROM tbl_vehicle_details where c_no = " . $_GET['id']   ;
	
	$result = $conn->query($sql);
	$row=$result->fetch_assoc();
	
	echo $row['report_no'] . "|" . $row['vehicle_no']  . "|" . $row['plate_no'] . "|" . $row['chasis_no'] . "|" . $row['engine_no'] . "|" . $row['insurance'] . "|" . $row['model'] . "|" . $row['type'] . "|" . $row['defect'] . "|" . $row['damage'];
	
?>



