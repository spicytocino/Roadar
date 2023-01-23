<?php
include_once 'dbconnector.php';
if(!empty($_GET["id"])) {
	$query ="delete from tbl_pedestrian_casualties_details WHERE c_no=".$_GET["id"];
	$result = mysqli_query($conn,$query);
	
	if(!empty($result)){
		header("Location:view_pedestrian_casualties.php?id=" .$_GET["id2"]);
	}
}
?>