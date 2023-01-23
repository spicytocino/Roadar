<?php
//set font to arial, bold, 14pt
include_once 'dbconnector.php';
$sql = "SELECT * FROM tbl_incident_report where report_no = '" . $_GET['id'] . "'";
$result = $conn->query($sql);
$count = mysqli_num_rows($result);		
$row=$result->fetch_assoc();



require('mc_table.php');

function GenerateWord()
{
    //Get a random word
    $nb=rand(3,10);
    $w='';
    for($i=1;$i<=$nb;$i++)
        $w.=chr(rand(ord('a'),ord('z')));
    return $w;
}

function GenerateSentence()
{
    //Get a random sentence
    $nb=rand(1,10);
    $s='';
    for($i=1;$i<=$nb;$i++)
        $s.=GenerateWord().' ';
    return substr($s,0,-1);
}

$pdf=new PDF_MC_Table();
	$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->Image('incident_summary.png',0,0,212,);
$pdf->Image('MMDA.png',170,250,30,);
//Cell(width , height , text , border , end line , [align] )
$pdf->Ln(15);
$pdf->Cell(100 ,5,'Report Details',0,0);
$pdf->Cell(59 ,5,'Accident Details',0,1);//end of line
//Line 1
$pdf->SetFont('Arial','B',10);
$pdf->Cell(25 ,5,'Incident Date: ' ,0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(75 ,5,$row['report_date'],0,0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(27 ,5,'Junction Type: ',0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(73 ,5,$row['junction_type'],0,1);
//line 2
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10 ,5,'Time: ',0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(90 ,5,$row['incident_time'],0,0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(27 ,5,'Traffic Control: ' ,0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(73 ,5,$row['traffic_control'],0,1);
//line 3
$pdf->SetFont('Arial','B',10);
$pdf->Cell(25 ,5,'Day of Week: ' ,0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(75 ,5,$row['report_day'],0,0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(27 ,5,'Collision Type: ' ,0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(70 ,5,$row['collision_type'],0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(20 ,5,'Report No.: ',0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(80 ,5,$row['report_no'],0,0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(19 ,5,'Movement:',0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(70 ,5, $row['movement'],0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(25 ,5,'Police Station: ' ,0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(75 ,5, $row['police_station'],0,0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(16 ,5,'Weather: ' ,0,0);//end of line
$pdf->SetFont('Arial','',10);
$pdf->Cell(70 ,5, $row['weather'],0,1);//end of line

$pdf->SetFont('Arial','B',10);
$pdf->Cell(31 ,5,'Accident Severity: ',0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(69 ,5, $row['accident_severity'],0,0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,5,'Separation: ',0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(70 ,5,$row['separation'],0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(35 ,5,'Accident Causation: ' ,0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(65 ,5,$row['accident_causation'],0,0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(15 ,5,'Light: ' ,0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(70 ,5,$row['light'],0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(27 ,5,'Specific Cause:' ,0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(73 ,5,$row['specific_cause'],0,0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(29 ,5,'Road Character: ' ,0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(70 ,5,$row['road_character'],0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(31 ,5,'Vehicles Involved:  ' ,0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(69 ,5,$row['vehicles_involved'],0,0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(32 ,5,'Surface Condition: ' ,0,0);//end of line
$pdf->SetFont('Arial','',10);
$pdf->Cell(70 ,5, $row['surface_condition'],0,1);//end of line

$pdf->SetFont('Arial','B',10);
$pdf->Cell(31 ,5,'Driver Casualties: ',0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(69 ,5,$row['driver_casualties'],0,0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(24 ,5,'Surface Type: ' ,0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(70 ,5,$row['surface_type'],0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(38 ,5,'Passenger Casualties',0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(62 ,5,$row['passenger_casualties'],0,0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(25 ,5,'Road Repairs: ',0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(70 ,5, $row['road_repairs'],0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(38 ,5,'Pedestrian Casualties: ',0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(62 ,5,$row['pedestrian_casualties'],0,0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(20 ,5,'Hit & Run: ' ,0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(70 ,5,$row['hit_and_run'],0,1);


$pdf->Ln(10);
$pdf->SetFont('Arial','B',12);

$pdf->Cell(100 ,5,'Location Details',0,0);
$pdf->Cell(59 ,5,'Accident Coordinates',0,1);//end of line

$pdf->SetFont('Arial','',10);


$pdf->SetFont('Arial','B',10);
$pdf->Cell(17 ,5,'Province:',0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(83 ,5,$row['province'],0,0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(25 ,5,'Map Address: ',0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(70 ,5, $row['map_address'],0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(8 ,5,'City: ',0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(92 ,5,$row['city'],0,0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(20 ,5,'Latitude: ' ,0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(70 ,5,$row['latitude'],0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(18 ,5,'Barangay: ',0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(82 ,5,$row['barangay'],0,0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(20 ,5,'Longitude: ' ,0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(70 ,5,$row['longitude'],0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(28 ,5,'Name of Road: ' ,0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(70 ,5,$row['name_of_road1'],0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(20 ,5,'Landmark: ' ,0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(70 ,5,$row['landmark1'],0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(20 ,5,'Distance: ' ,0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(70 ,5,$row['distance1'],0,1);

$pdf->Ln(10);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(100 ,5,'Junction Accident Only',0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(40 ,5,'Name of Second Road: ' ,0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(70 ,5,$row['name_of_road2'],0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(20 ,5,'Landmark: ' ,0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(70 ,5,$row['landmark2'],0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(20 ,5,'Distance: ' ,0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(70 ,5,$row['distance2'],0,1);

$pdf->Ln(10);
$pdf->SetFont('Arial','B',12);

$pdf->Cell(100 ,5,'Person Involved',0,1);

$pdf->SetFont('Arial','',10);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(38 ,5,'Investigating Officer: ' ,0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(100 ,5,$row['investigating_officer'],0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(38 ,5,'Supervising Officer: ' ,0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(100 ,5,$row['supervising_officer'],0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(30 ,5,'Witness Name: ' ,0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(100 ,5,$row['witness_name'],0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(100 ,5,'Police description of accident: ' ,0,1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(100 ,5,$row['accident_description'],0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(100 ,5,'Driver 1 Statement' ,0,1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(100 ,5,$row['driver1_statement'],0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(100 ,5,'Driver 2 Statement: ' ,0,1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(100 ,5,$row['driver2_statement'],0,1);
$pdf->Ln(10);
//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line



	$pdf->AddPage('o');
	

    
$pdf->SetFont('Arial','B',12);
$pdf->Cell(100 ,5,'Driver Details',0,1);
//invoice contents
$pdf->SetFont('Arial','B',7);
$pdf->SetWidths(array(80,60,25,25,10,22,15,20,23));
$pdf->Row(array('Driver Name','Address','License','Type','Age','Injury','Error','Alchol/Drugs','Seatbelt/Helmet'));
$pdf->SetFont('Arial','',7);
$sql = "SELECT * FROM tbl_driver_details where report_no = '" . $_GET['id'] . "'";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$pdf->Row(array($row['driver_name'],$row['driver_address'],$row['driver_license'],$row['driver_license_type'],$row['age'],$row['injury'],$row['error'],$row['alcohol_drugs'],$row['seatbelt_helmet']));
}


$pdf->SetFont('Arial','B',12);
$pdf->Cell(100 ,5,'Vehicle Details',0,1);
//invoice contents
$pdf->SetFont('Arial','B',7);
$pdf->SetWidths(array(20,30,25,25,25,22,35,20,23,23));
$pdf->Row(array('Vehicle No','Plate No.','Chasis No.','Engine No.','Insurance','ORCR','Model','Type','Defect','Damage'));
$pdf->SetFont('Arial','',7);
$sql = "SELECT * FROM tbl_vehicle_details where report_no = '" . $_GET['id'] . "'";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$pdf->Row(array($row['vehicle_no'],$row['plate_no'],$row['chasis_no'],$row['engine_no'],$row['insurance'],$row['orcr'],$row['model'],$row['type'],$row['defect'],$row['damage']));
}

$pdf->SetFont('Arial','B',12);
$pdf->Cell(100 ,5,'Passenger Casualties',0,1);
//invoice contents
$pdf->SetFont('Arial','B',7);
$pdf->SetWidths(array(60,80,20,15,15,22,35,20,23,23));
$pdf->Row(array('Passenger Name','Address','Vehicle No.','Gender','Age','Injury','Position','Action'));
$pdf->SetFont('Arial','',7);
$sql = "SELECT * FROM tbl_passenger_casualties_details where report_no = '" . $_GET['id'] . "'";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$pdf->Row(array($row['passenger_name'],$row['passenger_address'],$row['passenger_vehicle_no'],$row['passenger_gender'],$row['passenger_age'],$row['passenger_injury'],$row['passenger_position'],$row['passenger_action']));
}

$pdf->SetFont('Arial','B',12);
$pdf->Cell(100 ,5,'Pedestrian Casualties',0,1);
//invoice contents
$pdf->SetFont('Arial','B',7);
$pdf->SetWidths(array(60,80,15,15,22,35,20,23,23));
$pdf->Row(array('Pedestrian Name','Address','Gender','Age','Injury','Position','Action'));
$pdf->SetFont('Arial','',7);
$sql = "SELECT * FROM tbl_pedestrian_casualties_details where report_no = '" . $_GET['id'] . "'";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
	$pdf->Row(array($row['pedestrian_name'],$row['pedestrian_address'],$row['pedestrian_gender'],$row['pedestrian_age'],$row['pedestrian_injury'],$row['pedestrian_position'],$row['pedestrian_action']));
}
$pdf->Output();
?>