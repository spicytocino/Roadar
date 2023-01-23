<?php
include_once 'dbconnector.php';
if(!empty($_GET["id"])) {
	$query ="update tbl_incident_report set report_status = 'Success' WHERE report_no='".$_GET["id"] . "'";
	$result = mysqli_query($conn,$query);
	
	if(!empty($result)){
		echo ("<script LANGUAGE='JavaScript'>
									window.alert('Report Approval Successful');
									window.location.href='main.php' ;
									</script>");
							
	}
}
?>