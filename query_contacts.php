 <?php
	session_start();
	include_once 'dbconnector.php';
	$sql = "SELECT * FROM `tbl_stations` as a left join tbl_contacts as b on a.police_station_id = b.station_id left join tbl_district as c on a.district_id = c.c_no where city = '" . $_GET['id'] . "'"  ;

	$result = $conn->query($sql);
	$q = 0;
	$head = "<table><tbody>";
				$data = "";
				$old_station = "";
	while ($row = $result->fetch_assoc()) {
		if ($q == 0){
			$station_name = $row['police_station_name'] ;
			$station_address = $row['address'];
			$data = $data . "<tr><td colspan='2'><strong>Police Station Name:</strong> " . $station_name . "</td></tr><tr><td colspan='2'><strong>Address: " . $station_address . "</strong></td></tr><tr><th>Contact</th><th>Holder</th></tr>";
			$old_station = $row['police_station_name'] ;
			$q = 1;
		}
	
					
				$data = $data . "<tr><td>" . $row['contact'] . "</td><td>" . $row['holder'] . "</td><tr>";
				if ($old_station != $row['police_station_name']){
					$data = $data. "<tr><td colspan='2'>&nbsp</td></tr>";
					$q=0;
				}
				
	} 
	//echo $row['police_station_name'] . "|" . $row['address'] . "|" . $row['district'] . "|" . $row['contact'] . "|" . $row['holder'] . "|" . $row['police_station_id'];
	$footer = "</tbody></table>";
	echo $head . $data . $footer;

?>



