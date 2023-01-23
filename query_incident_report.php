 <?php
	session_start();
	include_once 'dbconnector.php';
	$sql = "SELECT * FROM tbl_incident_report where c_no = " . $_GET['id']   ;
	
	$result = $conn->query($sql);
	$row=$result->fetch_assoc();
	$date = date_create($row['report_date']);
	$incident_time = strtotime( $row['report_datetime'] );
	$incident_time = date( 'H:i:s', $incident_time );
	
	echo $row['c_no'] . "|" . date_format($date,"l jS \of F Y") . "|" . $incident_time . "|" . $row['accident_severity'] . "|" . $row['accident_causation'] . "|" . $row['specific_cause'] . "|" . $row['vehicles_involved'] . "|" . $row['collision_type'] . "|" . $row['accident_description'] . "|" . $row['pedestrian_casualties'] . "|" . $row['name_of_road1'] . " " . $row['barangay'] . " " . $row['city'] . " " . $row['province'] . "|" . $row['latitude'] . "|" . $row['longitude'] . "|" . $row['name_of_road1'] . "|" . $row['landmark1'] . "|" . $row['distance1'] . "|" . $row['name_of_road1'] . "|" . $row['weather'] . "|" . $row['surface_condition'];

?>



