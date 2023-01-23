<?php
session_start();
require_once("perpage.php");	
include 'dbconnector.php';
date_default_timezone_set('Asia/Manila');
$post_date = date("Y-m-d");
$year = $_GET['year'];
if( isset($_POST['statform']) ) {
	
	header("Location: print_statistics.php?year=" . $_POST['year'] );
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>Roadar v2.0 - Manage News</title>

    <!-- manifest meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="assets/img/favicon180.png" sizes="180x180">
    <link rel="icon" href="assets/img/favicon32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="assets/img/favicon16.png" sizes="16x16" type="image/png">

    <!-- Google fonts-->

    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&amp;display=swap" rel="stylesheet">

    <!-- bootstrap icons -->
    <link rel="stylesheet" href="../../../../cdn.jsdelivr.net/npm/bootstrap-icons%401.5.0/font/bootstrap-icons.css">

    <!-- date rage picker -->
    <link rel="stylesheet" href="assets/vendor/daterangepicker/daterangepicker.css">

    <!-- swiper carousel css -->
    <link rel="stylesheet" href="assets/vendor/swiperjs-6.6.2/swiper-bundle.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- style css for this template -->
    <link href="assets/css/style.css" rel="stylesheet" id="style">
</head>

<body class="body-scroll" data-page="stats">
<div class="modal fade" id="statform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">Select Statistics Year</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="RegisterForm" action="statistic_report.php" method="get" enctype="multipart/form-data">
	  
        <div class="modal-body">
          
     

		   <div class="form-group">
			<label style="font-weight:bold">Year</label>
			<select class="form-select" name="year" aria-label="Default select example">
				<option >2022</option>
				<option >2021</option>
				<option >2020</option>
				<option >2019</option>
				<option >2018</option>
				<option >2017</option>
				<option >2016</option>
				<option >2015</option>
				<option >2014</option>
			  
			</select>
		  </div>
        </div>
		
        <div class="modal-footer border-top-0 d-flex justify-content-center">
		<input type="submit" name="statform" class="form_submit" id="submit" value="View Report" />
          
        </div>
      </form>
    </div>
  </div>
  </div>
 
  <!--
    <div class="container-fluid loader-wrap">
        <div class="row h-100">
            <div class="col-10 col-md-6 col-lg-5 col-xl-3 mx-auto text-center align-self-center">
                <div class="loader-cube-wrap loader-cube-animate mx-auto">
                    <img src="assets/img/logo.png" alt="Logo">
                </div>
                <p class="mt-4">It's time for track assets<br><strong>Please wait...</strong></p>
            </div>
        </div>
    </div>
     -->

    <!-- Sidebar main menu -->
    <div class="sidebar-wrap  sidebar-pushcontent">
        <!-- Add overlay or fullmenu instead overlay -->
        <div class="closemenu text-muted">Close Menu</div>
        <div class="sidebar dark-bg">
            <!-- user information -->
            <div class="row my-3">
                <div class="col-12 ">
                    <div class="card shadow-sm bg-opac text-white border-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <figure class="avatar avatar-44 rounded-15">
                                        <img src="pictures/<?php echo $_SESSION['picture']; ?>" alt="">
                                    </figure>
                                </div>
                                <div class="col px-0 align-self-center">
                                    <p class="mb-1"><?php echo $_SESSION['log_name']; ?></p>
                                    <p class="text-muted size-12"><?php echo $_SESSION['user_type']; ?></p>
                                </div>
 
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>

            <!-- user emnu navigation -->
            <div class="row">
                <div class="col-12">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="main.php">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-house-door"></i></div>
                                <div class="col">Dashboard</div>
                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                            </a>
                        </li>
						<li class="nav-item">
                            <a class="nav-link active" href="manage_news.php" tabindex="-1">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-newspaper"></i></div>
                                <div class="col">Manage News</div>
                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link " href="manage_officer.php" tabindex="-1">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-shield-fill"></i></div>
                                <div class="col">Manage Officer</div>
                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " href="manage_station.php" tabindex="-1">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-house-fill"></i></div>
                                <div class="col">Manage Stations</div>
                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                            </a>
                        </li>
						<li class="nav-item">
                            <a class="nav-link" href="manage_record.php" tabindex="-1">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-folder"></i></div>
                                <div class="col">Manage Records</div>
                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                                aria-expanded="false">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-printer"></i></div>
                                <div class="col">Reports</div>
                                <div class="arrow"><i class="bi bi-plus plus"></i> <i class="bi bi-dash minus"></i>
                                </div>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item nav-link" href="#"  data-toggle="modal" data-target="#statform"  >
                                        <div class="avatar avatar-40 rounded icon"><i class="bi bi-calendar2"></i></div>
                                        <div class="col">Statistics Report</div>
                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                                    </a></li>
                                 <li><a class="dropdown-item nav-link" href="print_officers.php"  target="_blank" >
                                        <div class="avatar avatar-40 rounded icon"><i class="bi bi-calendar2"></i></div>
                                        <div class="col">Officer Report</div>
                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                                    </a></li>
								<li><a class="dropdown-item nav-link" href="print_stations.php"  target="_blank">
                                        <div class="avatar avatar-40 rounded icon"><i class="bi bi-calendar2"></i></div>
                                        <div class="col">Station Report</div>
                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                                    </a></li>
                            </ul>
                        </li>
                        

                       
						
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php?logout" tabindex="-1">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-box-arrow-right"></i></div>
                                <div class="col">Logout</div>
                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Sidebar main menu ends -->

    <!-- Begin page -->
    <main class="h-100">

        <!-- Header -->
        <header class="header position-fixed">
            <div class="row">
                <div class="col-auto">
                    <a href="javascript:void(0)" target="_self" class="btn btn-light btn-44 menu-btn">
                        <i class="bi bi-list"></i>
                    </a>
                </div>
                <div class="mylogo">
                    <img src="assets/img/logo2.png" class="logo2" alt=""></br>
					
                </div>
                
            </div>
        </header>
        <!-- Header ends -->

        <!-- main page content -->
        <div class="main-container container">
        <div class="container-xl">
		
    <div class="table-responsive">
  
        <div class="table-wrapper">
	<div style="text-align:left">
			<a class="btn btn-success" href="print_statistics.php?year=<?php echo $_GET['year']; ?>" target="blank_" style="font-size:12px">Download PDF Version</a></br></br>
  </br>  </br>
  </div>
		<?php 
		
		$sql = "SELECT accident_severity,count(c_no) as total_count FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' group by accident_severity";
		$result = $conn->query($sql);
		$count = mysqli_num_rows($result);
		$grand_total = 0;
		
		?>
           
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>General Statistics</th>
                        <th>Damage to Property</th>
                        <th>Fatal</th>
                        <th>Non Fatal</th>
						<th>Grand Total</th>
                    </tr>
                </thead>
                <tbody>
				     <tr>
					 <td>January-December <?php echo $year; ?></td>
				<?php
					while ($row = $result->fetch_assoc()) {
					?>
               
                        <td><?php echo $row['total_count']; ?></td>
                 
                        
                        
                   
                    <?php 
					$grand_total = $grand_total + $row['total_count'];
					} ?>  
					<td><?php echo $grand_total; ?></td>
					</tr>					
                </tbody>
            </table>
		 
		
           Classification by City </br>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>City</th>
                        <th>Damage to Property</th>
                        <th>Fatal</th>
                        <th>Non Fatal</th>
						<th>Grand Total</th>
                    </tr>
                </thead>
                <tbody>
				    
					 <?php 
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
					 ?>
					 <tr>
					  <td><?php echo $city; ?></td>
					<?php 
						$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' and city = '" . $city . "' and accident_severity = 'Damage to Property'";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$grand_total = 0;
						
					?>
						<td><?php echo $count; ?></td>
					<?php 
						$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' and city = '" . $city . "' and accident_severity = 'Fatal Accident'";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$grand_total = 0;
						
					?>
                        <td><?php echo $count; ?></td>
					<?php 
						$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' and city = '" . $city . "' and accident_severity = 'Non-fatal Accident'";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$grand_total = 0;
						
					?>
                        <td><?php echo $count; ?></td>
                    <?php 
						$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' and city = '" . $city . "'";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$grand_total = 0;
						
					?>
                        <td><?php echo $count; ?></td>  
					</tr>
					 <?php 
					 $x++;
					 } ?>
					  <td>Grand Total</td>
					
					<?php 
						$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' and accident_severity = 'Damage to Property'";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$grand_total = 0;
						
					?>
						<td><?php echo $count; ?></td>
					<?php 
						$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' and accident_severity = 'Fatal Accident'";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$grand_total = 0;
						
					?>
                        <td><?php echo $count; ?></td>
					<?php 
						$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' and accident_severity = 'Non-fatal Accident'";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$grand_total = 0;
						
					?>
                        <td><?php echo $count; ?></td>
                    <?php 
						$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' ";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$grand_total = 0;
						
					?>
                        <td><?php echo $count; ?></td>  						
                </tbody>
            </table>
		
		Average Road Crash Per Day</br>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th>Damage to Property</th>
                        <th>Fatal</th>
                        <th>Non Fatal</th>
						<th>Grand Total</th>
                    </tr>
                </thead>
                <tbody>
				    <tr>
					<td></td>
					<?php 
						$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' and accident_severity = 'Damage to Property'";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$q1 = $count / 365;
						
					?>
						<td><?php echo $count; ?></td>
					<?php 
						$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' and accident_severity = 'Fatal Accident'";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$q2 = $count / 365;
						
					?>
                        <td><?php echo $count; ?></td>
					<?php 
						$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' and accident_severity = 'Non-fatal Accident'";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$q3 = $count / 365;
						
					?>
                        <td><?php echo $count; ?></td>
                    <?php 
						$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' ";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$q4 = $count / 365;
						
					?>
                        <td><?php echo $count; ?></td>  					
					</tr>
					<tr>
					<td>Average Accident Rate per Day</td>
					<td><?php echo round($q1,2); ?></td>
					<td><?php echo round($q2,2); ?></td>
					<td><?php echo round($q3,2); ?></td>
					<td><?php echo round($q4,2); ?></td>
					</tr>
                </tbody>
            </table>
			
			
			
			Classification by Month </br>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Month</th>
                        <th>Damage to Property</th>
                        <th>Fatal</th>
                        <th>Non Fatal</th>
						<th>Grand Total</th>
                    </tr>
                </thead>
                <tbody>
				    
					 <?php 
					 
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
					 ?>
					 <tr>
					  <td><?php echo $city; ?></td>
					<?php 
						$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' and MONTH(report_date) = '" . $x . "' and accident_severity = 'Damage to Property'";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$grand_total = 0;

					?>
						<td><?php echo $count; ?></td>
					<?php 
						$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' and MONTH(report_date) = '" . $x . "' and accident_severity = 'Fatal Accident'";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$grand_total = 0;
						
					?>
                        <td><?php echo $count; ?></td>
					<?php 
						$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' and MONTH(report_date) = '" . $x . "' and accident_severity = 'Non-fatal Accident'";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$grand_total = 0;
						
					?>
                        <td><?php echo $count; ?></td>
                    <?php 
						$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' and MONTH(report_date) = '" . $x . "'";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$grand_total = 0;
						
					?>
                        <td><?php echo $count; ?></td>  
					</tr>
					 <?php 
					 $x++;
					 } ?>
					  <td>Grand Total</td>
					
					<?php 
						$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' and accident_severity = 'Damage to Property'";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$grand_total = 0;
						
					?>
						<td><?php echo $count; ?></td>
					<?php 
						$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' and accident_severity = 'Fatal Accident'";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$grand_total = 0;
						
					?>
                        <td><?php echo $count; ?></td>
					<?php 
						$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' and accident_severity = 'Non-fatal Accident'";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$grand_total = 0;
						
					?>
                        <td><?php echo $count; ?></td>
                    <?php 
						$sql = "SELECT city,accident_severity FROM `tbl_incident_report` where YEAR(report_date) = '" . $year . "' ";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$grand_total = 0;
						
					?>
                        <td><?php echo $count; ?></td>  						
                </tbody>
            </table>
			
			
				
			Total Number of Vehicle Involved </br>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Vehicle Type</th>
                        <th>Damage to Property</th>
                        <th>Fatal</th>
                        <th>Non Fatal</th>
						<th>Total Vehicle</th>
						<th>Percentage</th>
                    </tr>
                </thead>
                <tbody>
				    
					 <?php 
					
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
					 ?>
					 <tr>
					  <td><?php echo $city; ?></td>
					<?php 
						$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "' and `type` = '" . $city . "' and accident_severity = 'Damage to Property'";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$grand_total = 0;
						
					?>
						<td><?php echo $count; ?></td>
					<?php 
						$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "' and `type` = '" . $city . "' and accident_severity = 'Fatal Accident'";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$grand_total = 0;
						
					?>
                        <td><?php echo $count; ?></td>
					<?php 
						$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "' and `type` = '" . $city . "' and accident_severity = 'Non-fatal Accident'";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$grand_total = 0;
						
					?>
                        <td><?php echo $count; ?></td>
                    <?php 
						$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "' and `type` = '" . $city . "'";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$total_percent = ($count / $total_vehicle) * 100;
						
					?>
                        <td><?php echo $count; ?></td>  
						<td><?php echo round($total_percent,2); ?></td>  
					</tr>
					 <?php 
					 $x++;
					 } ?>
					  <td>Grand Total</td>
					
					<?php 
						$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "' and accident_severity = 'Damage to Property'";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$grand_total = 0;
						
					?>
						<td><?php echo $count; ?></td>
					<?php 
						$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "'  and accident_severity = 'Fatal Accident'";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$grand_total = 0;
						
					?>
                        <td><?php echo $count; ?></td>
					<?php 
						$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "'  and accident_severity = 'Non-fatal Accident'";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$grand_total = 0;
						
					?>
                        <td><?php echo $count; ?></td>
                    <?php 
						$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "'  ";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$grand_total = 0;
						
					?>
                        <td><?php echo $count; ?></td>  
<td>100%</td> 						
                </tbody>
            </table>
			
			<?php 
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
	
		?>
           </br>Type of Collision with the highest number of fatalities </br>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Collision Type</th>
                        <th>Number of Casualties</th>
                        <th>Percentage</th>
                    </tr>
                </thead>
                <tbody>
				     <tr>
					 <?php
					while ($row = $result->fetch_assoc()) {
					?>
					 <td><?php echo $row['collision_type']; ?></td>
				
               
                        <td><?php echo $row['total_casualties']; ?></td>
                 
                        
                        
                   
                   
					<td><?php echo round(($row['total_casualties'] / $grand_total ) * 100,2) ; ?>%</td>
					</tr>	
					<?php 	} ?>  					
					<tr>
					<td><strong>Grand Total</strong></td>
					<td><?php echo $grand_total; ?></td>
					<td>100%</td>
					</tr>
                </tbody>
            </table>
			
			</br>Accident Causation </br>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Accident Factor</th>
                        <th>Damage to Property</th>
                        <th>Fatal</th>
                        <th>Non Fatal</th>
						<th>Grand Total</th>
						
                    </tr>
                </thead>
                <tbody>
				    
					 <?php 
					
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
					 ?>
					 <tr>
					  <td><?php echo $city; ?></td>
					<?php 
						$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "' and `accident_causation` = '" . $city . "' and accident_severity = 'Damage to Property'";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$grand_total = 0;
						
					?>
						<td><?php echo $count; ?></td>
					<?php 
						$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "' and `accident_causation` = '" . $city . "' and accident_severity = 'Fatal Accident'";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$grand_total = 0;
						
					?>
                        <td><?php echo $count; ?></td>
					<?php 
						$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "' and `accident_causation` = '" . $city . "' and accident_severity = 'Non-fatal Accident'";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$grand_total = 0;
						
					?>
                        <td><?php echo $count; ?></td>
                    <?php 
						$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "' and `accident_causation` = '" . $city . "'";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$total_percent = ($count / $total_vehicle) * 100;
						
					?>
                        <td><?php echo $count; ?></td>  
						
					</tr>
					 <?php 
					 $x++;
					 } ?>
					  <td>Grand Total</td>
					
					<?php 
						$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "' and accident_severity = 'Damage to Property'";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$grand_total = 0;
						
					?>
						<td><?php echo $count; ?></td>
					<?php 
						$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "'  and accident_severity = 'Fatal Accident'";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$grand_total = 0;
						
					?>
                        <td><?php echo $count; ?></td>
					<?php 
						$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "'  and accident_severity = 'Non-fatal Accident'";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$grand_total = 0;
						
					?>
                        <td><?php echo $count; ?></td>
                    <?php 
						$sql = "SELECT * FROM `tbl_incident_report` as a left join tbl_vehicle_details as b on a.report_no = b.report_no where YEAR(report_date) = '" . $year . "'  ";
						$result = $conn->query($sql);
						$count = mysqli_num_rows($result);
						$grand_total = 0;
						
					?>
                        <td><?php echo $count; ?></td>  
				
                </tbody>
            </table>
			
			
			
			
			
        </div>
    </div>  
</div>   
            


        </div>
        <!-- main page content ends -->


    </main>
    <!-- Page ends-->

    
    <!-- Footer ends-->
	<script>
		$(document).ready(function() {
		$('a[data-toggle=modal], button[data-toggle=modal]').click(function () {
			var data_id = '';
			if (typeof $(this).data('id') !== 'undefined') {
				data_id = $(this).data('id');
			}	
			showValue(data_id);
			$('#c_no').val(data_id);
			})
		});
	</script>
	<script>
		function showValue(str) {
		  if (str.length == 0) {
			document.getElementById("establishment_name").value = "";
			document.getElementById("mobile").value = "";

			return;
		  } else {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
			  if (this.readyState == 4 && this.status == 200) {
			   var nameArr = this.responseText.split('|');
			   document.getElementById("c_no").value =  nameArr[0];
			   document.getElementById("title2").value =  nameArr[1];
			   document.getElementById("details2").value =  nameArr[2];
		

			   
			   
			   
			  }
			};
			
			xmlhttp.open("GET", "query_news.php?id=" + str, true);
			xmlhttp.send();
		  }
		}
	</script>
	<script type="text/javascript">
        $(document).ready( function() {
            $('.delete').click( function() {
                var id = $(this).attr("id");
				
                if(confirm("Are you sure you want to delete this news?")){
                           window.location = "delete_news.php?id=" + id ;
                }else{
                    return false;}
            });				
        });
    </script>
    <!-- Required jquery and libraries -->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/vendor/bootstrap-5/js/bootstrap.bundle.min.js"></script>

    <!-- cookie js -->
    <script src="assets/js/jquery.cookie.js"></script>

    <!-- Customized jquery file  -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/color-scheme.js"></script>

    <!-- Chart js script -->
    <script src="assets/vendor/chart-js-3.3.1/chart.min.js"></script>

    <!-- Progress circle js script -->
    <script src="assets/vendor/progressbar-js/progressbar.min.js"></script>

    <!-- swiper js script -->
    <script src="assets/vendor/swiperjs-6.6.2/swiper-bundle.min.js"></script>

    <!-- daterange picker script -->
    <script src="../../../../cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="assets/vendor/daterangepicker/daterangepicker.js"></script>

    <!-- page level custom script -->
    <script src="assets/js/app.js"></script>

</body>

</html>