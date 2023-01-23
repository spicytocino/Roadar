<?php
	session_start();
	include_once 'dbconnector.php';
	$sql = "SELECT * FROM tbl_officer where c_no = " . $_GET['id']  ;
	
	$result = $conn->query($sql);
	$row=$result->fetch_assoc();
	
	echo $row['c_no'] . "|" . $row['salutation'] . "|" . $row['firstname'] . "|" . $row['middlename'] . "|" . $row['lastname'] . "|" . $row['suffix'] . "|" . $row['street'] . "|" . $row['barangay'] . "|" . $row['city']  . "|" . $row['province'] . "|" . $row['postal_code'] . "|" . $row['birthday'] . "|" . $row['age'] . "|" . $row['gender'] . "|" . $row['citizenship']  . "|" . $row['mobile_no'] . "|" . $row['username'] . "|" . $row['password'];
	












?>