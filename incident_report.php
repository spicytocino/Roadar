<?php
session_start();
require_once("perpage.php");	
include 'dbconnector.php';
$report_no = "rd-" . date("YmdHis");
date_default_timezone_set('Asia/Manila');
$post_date = date("Y-m-d");
if (!empty($_POST)){
	$report_date = $post_date;
	$report_datetime = date("Y-m-d h:i:s a");
	$report_day = $_POST['report_day'];
	$report_number = $_POST['report_no'];
	$police_station = $_POST['police_station'];
	$accident_severity = $_POST['accident_severity'];
	$accident_causation = $_POST['accident_causation'];
	$specific_cause = $_POST['specific_cause'];
	$vehicles_involved = $_POST['vehicles_involved'];
	$driver_casualties = $_POST['driver_casualties'];
	$sql = "SELECT * FROM tbl_passenger_casualties_details where report_no = '" . $report_no . "'";
	
	$result = $conn->query($sql);
	$count1 = mysqli_num_rows($result);
	$passenger_casualties = $count1;
	$sql = "SELECT * FROM tbl_pedestrian_casualties_details where report_no = '" . $report_no . "'";
	
	$result = $conn->query($sql);
	$count2 = mysqli_num_rows($result);
	$pedestrian_casualties = $count2;
	$junction_type = $_POST['junction_type'];
	$traffic_control = $_POST['traffic_control'];
	$collision_type = $_POST['collision_type'];
	$movement = $_POST['movement'];
	$separation = $_POST['separation'];
	$weather = $_POST['weather'];
	$light = $_POST['light'];
	$road_character = $_POST['road_character'];
	$surface_condition = $_POST['surface_condition'];
	$surface_type = $_POST['surface_type'];
	$road_repairs = $_POST['road_repairs'];
	$hit_and_run = $_POST['hit_and_run'];
	$province = $_POST['province'];
	$city = $_POST['city'];
	$barangay = $_POST['barangay'];
	$name_of_road1 = $_POST['name_of_road1'];
	$landmark1 = $_POST['landmark1'];
	$distance1 = $_POST['distance1'];
	$name_of_road2 = $_POST['name_of_road2'];
	$landmark2 = $_POST['landmark2'];
	$distance2 = $_POST['distance2'];
	$map_address = $_POST['distance2'];
	$latitude = $_POST['latitude'];
	$longitude = $_POST['longitude'];
	$investigating_officer = $_POST['investigating_officer'];
	$supervising_officer = $_POST['supervising_officer'];
	$witness_name = $_POST['witness_name'];
	$accident_description = $_POST['accident_description'];
	$driver1_statement = $_POST['driver1_statement'];
	$driver2_statement = $_POST['driver2_statement'];
	$report_status = "Pending";
	
	
	$sql = "SELECT * FROM tbl_incident_report where report_no = '" . $report_no . "'";
	
	$result = $conn->query($sql);
	$count = mysqli_num_rows($result);
	$reporting_officer_id = $_SESSION['myuser_id'];
	if ($count >= 1){
		echo "<script>alert('Incident Report already exists');		</script>";
	}else{
		$query = "INSERT INTO tbl_incident_report(report_date, report_datetime, report_day, report_no, police_station, accident_severity, accident_causation, specific_cause, vehicles_involved, driver_casualties, passenger_casualties, pedestrian_casualties, junction_type, traffic_control, collision_type, movement, separation, weather, light, road_character, surface_condition, surface_type, road_repairs, hit_and_run, province, city, barangay, name_of_road1, landmark1, distance1, name_of_road2, landmark2, distance2,map_address,latitude,longitude, investigating_officer, supervising_officer, witness_name, accident_description, driver1_statement, driver2_statement, report_status,reporting_officer_id) VALUES('$report_date', '$report_datetime', '$report_day', '$report_number', '$police_station', '$accident_severity', '$accident_causation', '$specific_cause', '$vehicles_involved', '$driver_casualties', '$passenger_casualties', '$pedestrian_casualties', '$junction_type', '$traffic_control', '$collision_type', '$movement', '$separation', '$weather', '$light', '$road_character', '$surface_condition', '$surface_type', '$road_repairs', '$hit_and_run', '$province', '$city', '$barangay', '$name_of_road1', '$landmark1', '$distance1', '$name_of_road2', '$landmark2', '$distance2','$map_address','$latitude','$longitude', '$investigating_officer', '$supervising_officer', '$witness_name', '$accident_description', '$driver1_statement', '$driver2_statement', '$report_status','$reporting_officer_id')";
		
		$res = mysqli_query($conn,$query);
			
		if ($res) {
			echo '<script type="text/javascript">'; 
			echo 'alert("Incident Report added to database");'; 
			echo 'window.location.href = "manage_record_officer.php";';
			echo '</script>';
			
		} else {
			echo "<script>alert('Something went wrong, try again later...');</script>";
		}	
		
	}
			
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
    <title>Roadar v2.0 - Incident Report</title>

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
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

    <!-- bootstrap icons -->
    <link rel="stylesheet" href="../../../../cdn.jsdelivr.net/npm/bootstrap-icons%401.5.0/font/bootstrap-icons.css">

    <!-- date rage picker -->
    <link rel="stylesheet" href="assets/vendor/daterangepicker/daterangepicker.css">

    <!-- swiper carousel css -->
	<script src="PlacePicker.js"></script>
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
	<script type="text/javascript">
    $(document).ready(function () {

        var navListItems = $('div.setup-panel div a'),
                allWells = $('.setup-content'),
                allNextBtn = $('.nextBtn');
                allWells.hide();

        navListItems.click(function (e) {
            e.preventDefault();
            var $target = $($(this).attr('href')),
                    $item = $(this);
                 
            if (!$item.hasClass('disabled')) {
                navListItems.removeClass('btn-primary').addClass('btn-default');
                $item.addClass('btn-primary');
                allWells.hide();
                $target.show();
                $target.find('input:eq(0)').focus();
            }
        });

        allNextBtn.click(function(){
            var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                curInputs = curStep.find("input[type='text'],input[type='email'],input[type='password'],input[type='url']"),
                isValid = true;

            $(".form-group").removeClass("has-error");
            for(var i=0; i<curInputs.length; i++){
                if (!curInputs[i].validity.valid){
                    isValid = false;
                    $(curInputs[i]).closest(".form-group").addClass("has-error");
                }
            }

            if (isValid)
                nextStepWizard.removeAttr('disabled').trigger('click');
        });

        $('div.setup-panel div a.btn-primary').trigger('click');
});
</script>
<style>
* {
  box-sizing: border-box;
}

body {
  background-color: #f1f1f1;
}

#regForm {
  background-color: #ffffff;

  font-family: Raleway;
  padding: 40px;
  width: 100%;
  min-width: 300px;
}

h1 {
  text-align: center;  
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #04AA6D;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #04AA6D;
}
</style>
</head>

<body class="body-scroll" data-page="stats">
<div class="modal fade" id="addform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0" >
        <h5 class="modal-title" id="exampleModalLabel">Add Contact</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="RegisterForm" method="post" >
	  
        <div class="modal-body">
		   <div class="form-group">
            <label for="password1">Holder</label>
            <input type="text" class="form-control" id="holder" name="holder" required="" >
          </div>
          <div class="form-group">
            <label for="password1">Contact</label>
            <input type="text" class="form-control" id="contact" name="contact" required="" >
          </div>
		  
		   <div class="form-group">
            
            
          </div>
        </div>
		
        <div class="modal-footer border-top-0 d-flex justify-content-center">
		<input type="submit" name="addform" class="form_submit" id="submit" value="Apply Changes" />
          
        </div>
      </form>
    </div>
  </div>
  </div>
 <div class="modal fade" id="editform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">Modify Contact</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="RegisterForm" method="post">
	  
        <div class="modal-body">
		  <div class="form-group">
            <label for="password1">Holder</label>
            <input type="text" class="form-control" id="holder2" name="holder" required="" >
          </div>
          <div class="form-group">
            <label for="password1">Contact Number</label>
            <input type="text" class="form-control" id="contact2" name="contact" required="" >
          </div>
		   
		   <div class="form-group">
             
            <input type="hidden" class="form-control" id="c_no" name="c_no" >
            
          </div>
        </div>
		
        <div class="modal-footer border-top-0 d-flex justify-content-center">
		<input type="submit" name="editform" class="form_submit" id="submit" value="Apply Changes" />
          
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

           
        </div>
    </div>
    <!-- Sidebar main menu ends -->

    <!-- Begin page -->
    <main class="h-100">
	

        <!-- Header -->
        <header class="header position-fixed">
            <div class="row">
                <div class="col-auto">
                    <button class="btn btn-light btn-44 back-btn" onclick="window.location.replace('manage_station.php');">
                        <i class="bi bi-arrow-left"></i>
                    </button>
                </div>
                <div class="col align-self-center text-center">
                    <img src="assets/img/logo2.png" class="logo2" alt=""></br>
					<h1 class="titleheader">Incident Report - <?php echo $report_no; ?></h1>
                </div>
                
            </div>
        </header>
        <!-- Header ends -->

        <!-- main page content -->
        <div class="main-container container">
			<form id="regForm" method="post">
			  <!-- One "tab" for each step in the form: -->
			  <div class="tab">
					
					<p style="font-weight:bold">Introduction</p>
					<h3 style="text-align:center"> Good Day,<?php echo $_SESSION['log_fullname']; ?>!</h3>
					<blockquote class="blockquote text-center">
						<p class="mb-0">Something Happened? Make a report right away..</p>
					</blockquote>
				
					
			  </div>
			  <div class="tab">
					<p style="font-weight:bold">Report Details</p>
					<div class="form-group">
						<label for="exampleInputEmail1">Incident Date</label>
						<input type="date" class="form-control" oninput="this.className = ''" name="report_date" required="required">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Incident Time</label>
						<input type="time" class="form-control" oninput="this.className = ''" name="report_time"  required="required">
					</div>
					<div class="form-group">
						<label for="exampleFormControlSelect1">Day of the Week</label>
						<select class="form-select"  id="day" name="report_day" required="required" aria-label="Default select example">
							<option>Monday</option>
							<option>Tuesday</option>
							<option>Wednesday</option>
							<option>Thursday</option>
							<option>Friday</option>
							<option>Saturday</option>
							<option>Sunday</option>
						</select>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Report No. (Auto Generated)</label>
						<input type="text" class="form-control" oninput="this.className = ''" name="report_no" value="<?php echo $report_no; ?>" readonly required="required">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Police Station (Auto Fill)</label>
						<input type="text" class="form-control" oninput="this.className = ''" name="police_station" value="<?php echo $_SESSION['station_name']; ?>" readonly required="required">
					</div>
					<div class="form-group">
						<label for="exampleFormControlSelect1">Accident Severity</label>
						<select class="form-select"  id="severity" name="accident_severity" required="required" aria-label="Default select example">
							<option>Fatal Accident</option>
							<option>Non-fatal Accident</option>
							<option>Damage to Property</option>
						</select>
					</div>
					<div class="form-group">
						<label for="exampleFormControlSelect1">Accident Causation</label>
						<select class="form-select"  id="causation" name="accident_causation" required="required" aria-label="Default select example">
							<option>Human Error</option>
							<option>Road Defect</option>
							<option>Vehicle Defect</option>
							<option>Other</option>
						</select>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Specific Cause</label>
						<input type="text"  class="form-control" oninput="this.className = ''" name="specific_cause" aria-describedby="emailHelp" placeholder="Enter Specific Cause" required="required">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Driver Casualties</label>
						<input type="number" class="form-control" oninput="this.className = ''" name="driver_casualties" aria-describedby="emailHelp" placeholder="Driver Casualties" required="required">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Number of Vehicles Involved</label>
						<input type="number" class="form-control" oninput="this.className = ''" name="vehicles_involved" aria-describedby="emailHelp" placeholder="Number of Vehicles Involved" required="required">
					</div>
					
			  </div>
			  <div class="tab">
			     <p style="font-weight:bold">Accident Details</p>
				 <div class="form-group">
					<label for="exampleFormControlSelect1">Junction type</label>
					<select  class="form-select" id="exampleFormControlSelect1" name="junction_type" required="required" aria-label="Default select example" >
						<option>Not at Junction</option>
						<option>T-junction</option>
						<option>Y-junction</option>
						<option>Staggered junction</option>
						<option>Crossroads</option>
						<option>Roundabouts</option>
						<option>Railway</option>
						<option>Other</option>
					</select>
				</div>
				<div class="form-group">
					<label for="exampleFormControlSelect1">Traffic Control</label>
					<select  class="form-select" id="exampleFormControlSelect1" name="traffic_control" required="required" aria-label="Default select example">
						<option>None</option>
						<option>Centerline</option>
						<option>Pedestrian Crossing</option>
						<option>School Crossing</option>
						<option>Police Controlled</option>
						<option>Traffic Lights</option>
						<option>Stop Sign</option>
						<option>Give Way</option>
						<option>Other</option> 
					</select>
				</div>
				<div class="form-group">
					<label for="exampleFormControlSelect1">Collision Type</label>
					<select  class="form-select" id="exampleFormControlSelect1" name="collision_type" required="required" aria-label="Default select example">
						<option>Head On</option>
						<option>Rear End</option>
						<option>Side Swipe</option>
						<option>Overtuned Vehicle</option>
						<option>Hit Object In Road</option>
						<option>Hit Object Off Road</option>
						<option>Hit Parked Vehicle</option>
						<option>Hit Pedestrian</option>
						<option>Hit Animal</option>
						<option>Other</option>
					</select>
				</div>
				<div class="form-group">
					<label for="exampleFormControlSelect1">Movement</label>
					<select  class="form-select" id="exampleFormControlSelect1" name="movement" required="required" aria-label="Default select example">
						<option>1 - Way</option>
						<option>2 - Way</option>
					</select>
				</div>
				<div class="form-group">
					<label for="exampleFormControlSelect1">Separation</label>
					<select  class="form-select" id="exampleFormControlSelect1" name="separation" required="required" aria-label="Default select example">
						<option>Median</option> 
						<option>Not Median</option>
					</select>
				</div>
				<div class="form-group">
					<label for="exampleFormControlSelect1">Weather</label>
					<select  class="form-select" id="exampleFormControlSelect1" name="weather" required="required" aria-label="Default select example">
						<option>Fair</option>
						<option>Rain</option>
						<option>Wind</option>
						<option>Smoke</option>
						<option>Fog</option>
						<option>Dizzle</option>
						<option>Storm</option>
					</select>
				</div>
				<div class="form-group">
					<label for="exampleFormControlSelect1">Light</label>
					<select  class="form-select" id="exampleFormControlSelect1" name="light" required="required" aria-label="Default select example">
						<option>Daylight</option> 
						<option>Dawn/Dust</option>
						<option>Night(lit)</option>
						<option>Night(unlit)</option>
					</select>
				</div>
				<div class="form-group">
					<label for="exampleFormControlSelect1">Road Character</label>
					<select  class="form-select" id="exampleFormControlSelect1" name="road_character" required="required" aria-label="Default select example">
						<option>Straight+Flat</option>
						<option>Curve Only</option>
						<option>Incline Only</option>
						<option>Curve+Incline</option>
						<option>Bridge</option>
						<option>Crest</option>
					</select>
				</div>
				<div class="form-group">
					<label for="exampleFormControlSelect1">Surface Condition</label>
					<select  class="form-select" id="exampleFormControlSelect1" name="surface_condition" required="required" aria-label="Default select example">
						<option>Dry</option>
						<option>Wet</option>
						<option>Muddy</option>
						<option>Flooded</option>
						<option>Other</option>
					</select>
				</div>
				<div class="form-group">
					<label for="exampleFormControlSelect1">Surface Type</label>
					<select  class="form-select" id="exampleFormControlSelect1" name="surface_type" required="required" aria-label="Default select example">
						<option>Concrete</option>
						<option>Asphalt</option>
						<option>Gravel</option>
						<option>Earth</option>
					</select>
				</div>
				<div class="form-group">
					<label for="exampleFormControlSelect1">Road Repairs</label>
					<select  class="form-select" id="exampleFormControlSelect1" name="road_repairs" required="required" aria-label="Default select example">
						<option>Yes</option>
						<option>No</option> 
					</select>
				</div>
				<div class="form-group">
					<label for="exampleFormControlSelect1">Hit & Run</label>
					<select  class="form-select" id="exampleFormControlSelect1" name="hit_and_run" required="required" aria-label="Default select example">
						<option>Yes</option>
						<option>No</option>
					</select>
				</div>
			  </div>
			  <div class="tab">
			  
					<p style="font-weight:bold">Location Details</p>
					<div class="form-group">
						   <label for="getField">Province </label>
						   <input type="text" class="form-control" id="getField" name="province" required="required" placeholder="Province" required="required">
					</div>
					
					
					<div class="form-group">
						   <label for="getField">City </label>
						   <input type="text" class="form-control" id="getField" name="city" required="required" placeholder="City" required="required">
					</div>
					<div class="form-group">
						   <label for="getField">Barangay </label>
						   <input type="text" class="form-control" id="getField" name="barangay" required="required" placeholder="Barangay" required="required">
					</div>
					
					<div class="form-group">
						   <label for="getField">Name of Road </label>
						   <input type="text" class="form-control" id="getField" name="name_of_road1" required="required" placeholder="Name of Road" required="required">
					</div>
					<div class="form-group">
						   <label for="getField">Landmark </label>
						   <input type="text" class="form-control" id="getField" name="landmark1" required="required" placeholder="Landmark" required="required">
					</div>
					<div class="form-group">
						   <label for="getField">Distance </label>
						   <input type="text" class="form-control" id="getField" name="distance1" required="required" placeholder="Distance" required="required">
					</div>
					<h3> Junction Accident Only</h3>
					<div class="form-group">
						   <label for="getField">Name of Second Road </label>
						   <input type="text" class="form-control" id="getField" name="name_of_road2" required="required" placeholder="Name of Second Road" required="required">
					</div>
					<div class="form-group">
						   <label for="getField">Landmark </label>
						   <input type="text" class="form-control" id="getField" name="landmark2" required="required" placeholder="Landmark" required="required">
					</div>
					<div class="form-group">
						   <label for="getField">Distance </label>
						   <input type="text" class="form-control" id="getField" name="distance2" required="required" placeholder="Distance" required="required">
					</div>
					<div class="form-group">
						   <label for="getField">Location (Map Place Picker) </label>
						   <input type="text" class="form-control"  id="pickup_country" name="map_address" class="form_input" required="required" autofocus>
					</div>
					<div class="form-group">
						   <label for="getField">Latitude (Auto Fill)</label>
						   <input type="text" class="form-control" id="latitude" name="latitude" required="required" placeholder="Latitude" readonly required="required">
					</div>
					<div class="form-group">
						   <label for="getField">Longitude (Auto Fill) </label>
						   <input type="text" class="form-control" id="longitude" name="longitude" required="required" placeholder="Longitude" readonly required="required">
					</div>

					
			  </div>
			  <div class="tab">
			    <p style="font-weight:bold">Person Involved</p>
				<div class="form-group">
					   <label for="getField">Investigating Officer </label>
					   
					    <input type="text" class="form-control" id="getField" name="investigating_officer" required="required" value="<?php echo $_SESSION['log_fullname']; ?>" readonly>
				</div>
				
				
				<div class="form-group">
					   <label for="getField">Supervising Officer </label>
					     <input type="text" class="form-control" id="getField" name="supervising_officer" required="required" value="Juan Dela Cruz" readonly>
				</div>
				
				<div class="form-group">
					   <label for="getField">Witness Name </label>
					   <input type="text" class="form-control" id="getField" name="witness_name" required="required" placeholder="Witness Name">
				</div>
				
				<div class="form-group">
					<label for="exampleFormControlTextarea1">Police Description of Accident</label>
					<textarea class="form-control" id="exampleFormControlTextarea1" name="accident_description"rows="3"></textarea>
					<input type="file" name="image" accept="image/*" capture="environment">
				</div>
				<div class="form-group">
					<label for="exampleFormControlTextarea1">Driver 1 Statement</label>
					<textarea class="form-control" id="exampleFormControlTextarea1" name="driver1_statement" rows="3"></textarea>
					<input type="file" name="image" accept="image/*" capture="environment">
				</div>
				<div class="form-group">
					<label for="exampleFormControlTextarea1">Driver 2 Statement</label>
					<textarea class="form-control" id="exampleFormControlTextarea1" name="driver2_statement" rows="3"></textarea>
					<input type="file" name="image" accept="image/*" capture="environment">
				</div>
				
			  </div>
			  <div class="tab">
				<p style="font-weight:bold">Vehicle Details</p>
				<iframe src="view_vehicle_details.php?id=<?php echo $report_no; ?>" id="myIframe" style="width:100%;height:500px" title="description"></iframe>
			  </div>
			  <div class="tab">
				<p style="font-weight:bold">Driver Details</p>
				<iframe src="view_driver_details.php?id=<?php echo $report_no; ?>" id="myIframe" style="width:100%;height:500px" title="description"></iframe>
			  </div>
			  <div class="tab">
				<p style="font-weight:bold">Passenger Casualties Details</p>
				<iframe src="view_passenger_casualties.php?id=<?php echo $report_no; ?>" id="myIframe" style="width:100%;height:500px" title="description"></iframe>
			  </div>
			  <div class="tab">
				<p style="font-weight:bold">Pedestrian Casualties Details</p>
				<iframe src="view_pedestrian_casualties.php?id=<?php echo $report_no; ?>" id="myIframe" style="width:100%;height:500px" title="description"></iframe>
			  </div>
			  <div class="tab">
					<h3 style="text-align:center"> Attention</h3>
					<blockquote class="blockquote text-center">
						<p class="mb-0">By checking the box below, you are certify that you have read, understood, and agree to the Roadar terms and conditions, that you are dedicated in providing thruthful data, and will not alter any accident related information. </p>
					</blockquote>
					<div class="form-check">
					<input type="checkbox" id="agree" name="agree" checked >
					<label class="form-check-label" >I have read, understand and agreed to the Terms of Service and Privacy Policy</label>
					</div>
			  </div>
			  </br>
			  <div style="overflow:auto;">
				<div style="float:right;">
				  <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
				  <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
				</div>
			  </div>
			  <!-- Circles which indicates the steps of the form: -->
			  <div style="text-align:center;margin-top:40px;">
				<span class="step"></span>
				<span class="step"></span>
				<span class="step"></span>
				<span class="step"></span>
				<span class="step"></span>
				<span class="step"></span>
				<span class="step"></span>
				<span class="step"></span>
				<span class="step"></span>
				<span class="step"></span>
			  </div>
			</form>
		</div>	
	</main>
    <!-- Page ends-->

<script type="text/javascript">
    $(document).ready(function(){
    	$("#pickup_country").PlacePicker({
    		btnClass:"btn btn-lg btn-default",
    		key:"AIzaSyBib2oCqcxbztagAoozHJk2qMuRzlpKVrM",
    		center: {lat: 14.800118, lng: 120.923304},
    		success:function(data,address){
    			//data contains address elements and
    			//address conatins you searched text
    			//Your logic here
    			$("#pickup_country").val(data.formatted_address);
				$("#latitude").val(data.latitude);
				$("#longitude").val(data.longitude);
    		}
    	});
    });
</script>

  <script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var checkBox = document.getElementById("agree");
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  if (checkBox.checked == false){
	  valid=false;
  }

	
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
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
<script src="PlacePicker.js"></script>
</body>

</html>