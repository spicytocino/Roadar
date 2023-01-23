<?php
	session_start();
	include_once 'dbconnector.php';
	$sql = "SELECT * FROM tbl_stations where c_no = " . $_GET['id']  ;
	
	$result = $conn->query($sql);
	$row=$result->fetch_assoc();
	
	echo $row['c_no'] . "|" . $row['police_station_id'] . "|" . $row['police_station_name'] . "|" . $row['address'] . "|" . $row['district_id'];
	
?>