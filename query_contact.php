 <?php
	session_start();
	include_once 'dbconnector.php';
	$sql = "SELECT * FROM tbl_contacts where c_no = '" . $_GET['id']   . "'";
	
	$result = $conn->query($sql);
	$row=$result->fetch_assoc();
	
	echo $row['c_no'] . "|" . $row['station_id'] . "|" . $row['contact'] . "|" . $row['holder'];
	
?>