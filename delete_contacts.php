<?php
include_once 'dbconnector.php';
if(!empty($_GET["id"])) {
	$query ="delete from tbl_contacts WHERE c_no=".$_GET["id"];
	$result = mysqli_query($conn,$query);
	
	if(!empty($result)){
		header("Location:view_station.php?id=" . $_GET['s_id']);
	}
}
?>