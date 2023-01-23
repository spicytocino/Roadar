<?php

	session_start();
	include 'save_logs.php';
	include 'dbconnector.php';
	date_default_timezone_set('Asia/Manila');
	if (!isset($_SESSION['myuser_id'])) {
		header("Location: index.html");
	} else if(isset($_SESSION['myuser_id'])!="") {
		header("Location: signin.php");
	}
	
	if (isset($_GET['logout'])) {
		save_logs($_SESSION['myuser_name'] ,"Logout to System");
		unset($_SESSION['usertype']);
		session_unset();
		session_destroy();
		header("Location: signin.php");
		exit;
	}