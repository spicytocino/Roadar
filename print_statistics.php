<?php
include_once 'dbconnector.php';
require('fpdf/fpdf1.php');
	 $logdate = date("Y-m-d");
	 $logtime = date("h:i:s");

$year = $_GET['year'];
$pdf = new FPDF();
$pdf->AddPage();
$pdf->Ln(13);
$pdf->SetFont('Arial','B',12);
$pdf->Write(5,"Date:" . $logdate);
$pdf->Ln(5);
$pdf->Write(5,"Time:" . $logtime);
$pdf->Ln(5);
$pdf->Write(5,"Prepared by: Juan Santos Dela Cruz");
$pdf->Ln(10);
$sql = "SELECT accident_severity,count(c_no) as total_count FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' group by accident_severity";
$result = $conn->query($sql);
$rowcount=mysqli_num_rows($result);
$grand_total = 0;
$pdf->SetFont('Arial','B',8);	
//$pdf->Write(5,"Pending Order Reports");
$pdf->Ln(10);
		$pdf->Cell(50,10,"General Statistics",1);
		$pdf->Cell(20,10,"Damage",1);
		$pdf->Cell(20,10,"Fatal",1);
		$pdf->Cell(20,10,"Non Fatal",1);
		$pdf->Cell(20,10,"Grand Total",1);
		$pdf->Ln(10);
		$pdf->Cell(50,10,"January-December " . $year,1);
		while ($row = $result->fetch_assoc()) {
			$pdf->Cell(20,10,$row['total_count'],1);
			$grand_total = $grand_total + $row['total_count'];
		}
		$pdf->Cell(20,10,$grand_total,1);
		$pdf->Ln();
$pdf->Ln(10);
$sql = "SELECT accident_severity,count(c_no) as total_count FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' group by accident_severity";
$result = $conn->query($sql);
$rowcount=mysqli_num_rows($result);
$grand_total = 0;
$pdf->SetFont('Arial','B',8);	
$pdf->Write(5,"Classification by City");
$pdf->Ln(10);
$pdf->Cell(50,10,"City",1);
$pdf->Cell(20,10,"Damage",1);
$pdf->Cell(20,10,"Fatal",1);
$pdf->Cell(20,10,"Non Fatal",1);
$pdf->Cell(20,10,"Grand Total",1);
$pdf->Ln(10);
	 $city ="Quezon City";
	 $x = 0;
	 while($x <= 16) {
		switch ($x) {
			case 1:
				$city = "Mandaluyong";
			break;
			case 2:
				$city = "Marikina";
			break;
			case 3:
				$city = "Pasig";
			break;
			case 4:
				$city = "San Juan";
			break;
			case 5:
				$city = "Caloocan";
			break;
			case 6:
				$city = "Malabon";
			break;
			case 7:
				$city = "Navotas";
			break;
			case 8:
				$city = "Valenzuela";
			break;
			case 9:
				$city = "Las Pinas";
			break;
			case 10:
				$city = "Makati";
			break;
			case 11:
				$city = "Muntinlupa";
			break;
			case 12:
				$city = "Paranaque";
			break;
			case 13:
				$city = "Pasay";
			break;
			case 14:
				$city = "Pateros";
			break;
			case 15:
				$city = "Taguig";
			break;
			case 16:
				$city = "Manila";
			break;
		}
		
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(50,8,$city,1);
		$sql = "SELECT accident_severity,count(c_no) as total_count FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' group by accident_severity";
		$result = $conn->query($sql);
		$count = mysqli_num_rows($result);
		$pdf->Cell(20,8,$count,1);
		$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' and city = '" . $city . "' and accident_severity = 'Fatal Accident'";
		$result = $conn->query($sql);
		$count = mysqli_num_rows($result);
		$pdf->Cell(20,8,$count,1);
		$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' and city = '" . $city . "' and accident_severity = 'Non-fatal Accident'";
		$result = $conn->query($sql);
		$count = mysqli_num_rows($result);
		$pdf->Cell(20,8,$count,1);
		$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' and city = '" . $city . "'";
		$result = $conn->query($sql);
		$count = mysqli_num_rows($result);
		$pdf->Cell(20,8,$count,1);
		$pdf->Ln();
		$x++;
	}
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(50,8,"Grand Total",1);
	$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' and accident_severity = 'Damage to Property'";
	$result = $conn->query($sql);
	$count = mysqli_num_rows($result);
	$pdf->Cell(20,8,$count,1);
	$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' and accident_severity = 'Fatal Accident'";
	$result = $conn->query($sql);
	$count = mysqli_num_rows($result);
	$pdf->Cell(20,8,$count,1);
	$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' and accident_severity = 'Non-fatal Accident'";
	$result = $conn->query($sql);
	$count = mysqli_num_rows($result);
	$pdf->Cell(20,8,$count,1);
	$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' ";
	$result = $conn->query($sql);
	$count = mysqli_num_rows($result);
	$pdf->Cell(20,8,$count,1);
$pdf->Ln(10);

$pdf->AddPage();
$grand_total = 0;
$pdf->SetFont('Arial','B',8);	
//$pdf->Write(5,"Pending Order Reports");
$pdf->Ln(20);
		$pdf->Cell(50,10,"",1);
		$pdf->Cell(20,10,"Damage",1);
		$pdf->Cell(20,10,"Fatal",1);
		$pdf->Cell(20,10,"Non Fatal",1);
		$pdf->Cell(20,10,"Grand Total",1);
		$pdf->Ln(10);
		$pdf->Cell(50,8,"",1);
		$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' and accident_severity = 'Damage to Property'";
		$result = $conn->query($sql);
		$count = mysqli_num_rows($result);
		$q1 = $count / 365;
		$pdf->Cell(20,8,$count,1);
		$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' and accident_severity = 'Fatal Accident'";
		$result = $conn->query($sql);
		$count = mysqli_num_rows($result);
		$q2 = $count / 365;
		$pdf->Cell(20,8,$count,1);
		$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' and accident_severity = 'Non-fatal Accident'";
		$result = $conn->query($sql);
		$count = mysqli_num_rows($result);
		$q3 = $count / 365;
		$pdf->Cell(20,8,$count,1);
		$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' ";
		$result = $conn->query($sql);
		$count = mysqli_num_rows($result);
		$q4 = $count / 365;
		$pdf->Cell(20,8,$count,1);
		$pdf->Ln();
		$pdf->Cell(50,8,"Average Accident Rate per Day",1);
		$pdf->Cell(20,8,round($q1,2) . " Cases",1);
		$pdf->Cell(20,8,round($q2,2) . " Cases",1);
		$pdf->Cell(20,8,round($q3,2) . " Cases",1);
		$pdf->Cell(20,8,round($q4,2) . " Cases",1);
		$pdf->Ln();
$pdf->Ln(10);
$sql = "SELECT accident_severity,count(c_no) as total_count FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' group by accident_severity";
$result = $conn->query($sql);
$rowcount=mysqli_num_rows($result);
$grand_total = 0;
$pdf->SetFont('Arial','B',8);	
$pdf->Write(5,"Classification by Month");
$pdf->Ln(5);
$pdf->Cell(50,10,"Month",1);
$pdf->Cell(20,10,"Damage",1);
$pdf->Cell(20,10,"Fatal",1);
$pdf->Cell(20,10,"Non Fatal",1);
$pdf->Cell(20,10,"Grand Total",1);
$pdf->Ln(10);
	 $x = 1;
	 while($x <= 12) {
		switch ($x) {
			case 1:
				$city = "January";
			break;
			case 2:
				$city = "February";
			break;
			case 3:
			$city = "March";
			break;
			case 4:
			$city = "April";
			break;
			case 5:
			$city = "May";
			break;
			case 6:
			$city = "June";
			break;
			case 7:
			$city = "July";
			break;
			case 8:
			$city = "August";
			break;
			case 9:
			$city = "September";
			break;
			case 10:
			$city = "October";
			break;
			case 11:
			$city = "November";
			break;
			case 12:
			$city = "December";
			break;
			
		}
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(50,8,$city,1);
		$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' and MONTH(report_date) = '" . $x . "' and accident_severity = 'Damage to Property'";
		$result = $conn->query($sql);
		$count = mysqli_num_rows($result);
		$pdf->Cell(20,8,$count,1);
		$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' and MONTH(report_date) = '" . $x . "' and accident_severity = 'Fatal Accident'";
		$result = $conn->query($sql);
		$count = mysqli_num_rows($result);
		$pdf->Cell(20,8,$count,1);
		$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' and MONTH(report_date) = '" . $x . "' and accident_severity = 'Non-fatal Accident'";
		$result = $conn->query($sql);
		$count = mysqli_num_rows($result);
		$pdf->Cell(20,8,$count,1);
		$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' and MONTH(report_date) = '" . $x . "'";
		$result = $conn->query($sql);
		$count = mysqli_num_rows($result);
		$pdf->Cell(20,8,$count,1);
		$pdf->Ln();
		$x++;
	}
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(50,8,"Grand Total",1);
	$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' and accident_severity = 'Damage to Property'";
	$result = $conn->query($sql);
	$count = mysqli_num_rows($result);
	$pdf->Cell(20,8,$count,1);
	$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' and accident_severity = 'Fatal Accident'";
	$result = $conn->query($sql);
	$count = mysqli_num_rows($result);
	$pdf->Cell(20,8,$count,1);
	$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' and accident_severity = 'Non-fatal Accident'";
	$result = $conn->query($sql);
	$count = mysqli_num_rows($result);
	$pdf->Cell(20,8,$count,1);
	$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' ";
	$result = $conn->query($sql);
	$count = mysqli_num_rows($result);
	$pdf->Cell(20,8,$count,1);
$pdf->Ln(10);
$pdf->AddPage();
$sql = "SELECT accident_severity,count(c_no) as total_count FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' group by accident_severity";
$result = $conn->query($sql);
$rowcount=mysqli_num_rows($result);
$grand_total = 0;
$pdf->SetFont('Arial','B',8);
$pdf->Ln(15);	
$pdf->Write(5,"Total Number of Vehicle Involved ");
$pdf->Ln(5);
$pdf->Cell(50,10,"Month",1);
$pdf->Cell(20,10,"Damage",1);
$pdf->Cell(20,10,"Fatal",1);
$pdf->Cell(20,10,"Non Fatal",1);
$pdf->Cell(20,10,"Grand Total",1);
$pdf->Cell(20,10,"Percentage",1);
$pdf->Ln(10);
	$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "'  ";
	$result = $conn->query($sql);
	$count = mysqli_num_rows($result);
	$total_vehicle = $count;
						
	 $x = 1;
	 while($x <= 12) {
		switch ($x) {
			case 1:							
			$city = "Bicycle";
			break;
			case 2:
			$city = "Pedicab";
			break;
			case 3:
			$city = "Motorcycle";
			break;
			case 4:
			$city = "Tricycle";
			break;
			case 5:
			$city = "Car";
			break;
			case 6:
			$city = "Jeepney";
			break;
			case 7:
			$city = "Bus";
			break;
			case 8:
			$city = "Truck (Rigid)";
			break;
			case 9:
			$city = "Truck (Artic)";
			break;
			case 10:
			$city = "Van";
			break;
			case 11:
			$city = "Animal";
			break;
			case 12:
			$city = "Other";
			break;
		}
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(50,8,$city,1);
		$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "' and `type` = '" . $city . "' and accident_severity = 'Damage to Property'";
		$result = $conn->query($sql);
		$count = mysqli_num_rows($result);
		$pdf->Cell(20,8,$count,1);
		$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "' and `type` = '" . $city . "' and accident_severity = 'Fatal Accident'";
		$result = $conn->query($sql);
		$count = mysqli_num_rows($result);
		$pdf->Cell(20,8,$count,1);
		$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "' and `type` = '" . $city . "' and accident_severity = 'Non-fatal Accident'";
		$result = $conn->query($sql);
		$count = mysqli_num_rows($result);
		$pdf->Cell(20,8,$count,1);
		$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "' and `type` = '" . $city . "'";
		$result = $conn->query($sql);
		$count = mysqli_num_rows($result);
		$total_percent = ($count / $total_vehicle) * 100;
		$pdf->Cell(20,8,$count,1);
		$pdf->Cell(20,8,round($total_percent,2) . "%",1);
		$pdf->Ln();
		$x++;
	}
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(50,8,"Grand Total",1);
	$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "' and accident_severity = 'Damage to Property'";
	$result = $conn->query($sql);
	$count = mysqli_num_rows($result);
	$pdf->Cell(20,8,$count,1);
	$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "'  and accident_severity = 'Fatal Accident'";
	$result = $conn->query($sql);
	$count = mysqli_num_rows($result);
	$pdf->Cell(20,8,$count,1);
	$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "'  and accident_severity = 'Non-fatal Accident'";
	$result = $conn->query($sql);
	$count = mysqli_num_rows($result);
	$pdf->Cell(20,8,$count,1);$total_percent = ($count / $total_vehicle) * 100;
	$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "'  ";
	$result = $conn->query($sql);
	$count = mysqli_num_rows($result);
	$pdf->Cell(20,8,$count,1);
	$pdf->Cell(20,8,"100%",1);
$pdf->Ln(10);
$sql = "SELECT collision_type,(sum(driver_casualties) + sum(passenger_casualties) + sum(pedestrian_casualties)) as total_casualties FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' group by collision_type";
$result = $conn->query($sql);
$count = mysqli_num_rows($result);
$grand_total = 0;
while ($row = $result->fetch_assoc()) {
	$grand_total = $grand_total + $row['total_casualties'];
}
$sql = "SELECT collision_type,(sum(driver_casualties) + sum(passenger_casualties) + sum(pedestrian_casualties)) as total_casualties FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' group by collision_type";
$result = $conn->query($sql);
$count = mysqli_num_rows($result);

$pdf->SetFont('Arial','B',8);	
$pdf->Ln(10);
$pdf->Write(5,"Type of Collision with the highest number of fatalities");
$pdf->Ln(5);
		$pdf->Cell(50,10,"Collision Type",1);
		$pdf->Cell(40,10,"No. of Casualties",1);
		$pdf->Cell(40,10,"Percentage",1);
		$pdf->Ln(10);
		while ($row = $result->fetch_assoc()) {
			$pdf->Cell(50,10,$row['collision_type'],1);
			$pdf->Cell(40,10,$row['total_casualties'],1);
		    $pdf->Cell(40,10,round(($row['total_casualties'] / $grand_total ) * 100,2) . "%",1);
			$pdf->Ln();
		}
		
		$pdf->Cell(50,10,"Grand Total",1);
		$pdf->Cell(40,10,$grand_total,1);
		$pdf->Cell(40,10,"100%",1);
$pdf->Ln(10);
$pdf->AddPage();
$pdf->SetFont('Arial','B',8);	
$pdf->Ln(15);	
$pdf->Write(5,"Accident Causation ");
$pdf->Ln(5);
$pdf->Cell(50,10,"Accident Factor",1);
$pdf->Cell(20,10,"Damage",1);
$pdf->Cell(20,10,"Fatal",1);
$pdf->Cell(20,10,"Non Fatal",1);
$pdf->Cell(20,10,"Grand Total",1);
$pdf->Ln(10);
		$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "'  ";
		$result = $conn->query($sql);
		$count = mysqli_num_rows($result);
		$total_vehicle = $count;
						
	  $x = 1;
	 while($x <= 4) {
		switch ($x) {
			case 1:							
			$city = "Human Error";
			break;
			case 2:
			$city = "Road Defect";
			break;
			case 3:
			$city = "Vehicle Defect";
			break;
			case 4:
			$city = "Other";
			break;
			
		}
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(50,8,$city,1);
		$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "' and `accident_causation` = '" . $city . "' and accident_severity = 'Damage to Property'";
		$result = $conn->query($sql);
		$count = mysqli_num_rows($result);
		$pdf->Cell(20,8,$count,1);
		$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "' and `accident_causation` = '" . $city . "' and accident_severity = 'Fatal Accident'";
		$result = $conn->query($sql);
		$count = mysqli_num_rows($result);
		$pdf->Cell(20,8,$count,1);
		$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "' and `accident_causation` = '" . $city . "' and accident_severity = 'Non-fatal Accident'";
		$result = $conn->query($sql);
		$count = mysqli_num_rows($result);
		$pdf->Cell(20,8,$count,1);
		$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "' and `accident_causation` = '" . $city . "'";
		$result = $conn->query($sql);
		$count = mysqli_num_rows($result);
		$pdf->Cell(20,8,$count,1);
		$pdf->Ln();
		$x++;
	}
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(50,8,"Grand Total",1);
	$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "' and accident_severity = 'Damage to Property'";
	$result = $conn->query($sql);
	$count = mysqli_num_rows($result);
	$pdf->Cell(20,8,$count,1);
	$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "'  and accident_severity = 'Fatal Accident'";
	$result = $conn->query($sql);
	$count = mysqli_num_rows($result);
	$pdf->Cell(20,8,$count,1);
	$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "'  and accident_severity = 'Non-fatal Accident'";
	$result = $conn->query($sql);
	$count = mysqli_num_rows($result);
	$pdf->Cell(20,8,$count,1);$total_percent = ($count / $total_vehicle) * 100;
	$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "'  ";
	$result = $conn->query($sql);
	$count = mysqli_num_rows($result);
	$pdf->Cell(20,8,$count,1);
$pdf->Ln(10);
$pdf->Output();
?>
	
	


