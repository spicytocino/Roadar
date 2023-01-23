<?php
session_start();
require_once("perpage.php");	
include 'dbconnector.php';

if( isset($_POST['addform']) ) {
			$salutation = trim($_POST['salutation']);
			$salutation = strip_tags($salutation);
			$salutation = htmlspecialchars($salutation);
			
			$firstname = trim($_POST['firstname']);
			$firstname = strip_tags($firstname);
			$firstname = htmlspecialchars($firstname);
			
			$middlename = trim($_POST['middlename']);
			$middlename = strip_tags($middlename);
			$middlename = htmlspecialchars($middlename);
			
			$lastname = trim($_POST['lastname']);
			$lastname = strip_tags($lastname);
			$lastname = htmlspecialchars($lastname);
			
			$suffix = trim($_POST['suffix']);
			$suffix = strip_tags($suffix);
			$suffix = htmlspecialchars($suffix);
			
			$street = trim($_POST['street']);
			$street = strip_tags($street);
			$street = htmlspecialchars($street);
			
			$barangay = trim($_POST['barangay']);
			$barangay = strip_tags($barangay);
			$barangay = htmlspecialchars($barangay);
			
			$city = trim($_POST['city']);
			$city = strip_tags($city);
			$city = htmlspecialchars($city);
			
			$province = trim($_POST['province']);
			$province = strip_tags($province);
			$province = htmlspecialchars($province);
			
			$postal = trim($_POST['postal']);
			$postal = strip_tags($postal);
			$postal = htmlspecialchars($postal);
	
			$birthday = trim($_POST['birthday']);
			$birthday = strip_tags($birthday);
			$birthday = htmlspecialchars($birthday);
			
			$age = trim($_POST['age']);
			$age = strip_tags($age);
			$age = htmlspecialchars($age);
			
			$gender = trim($_POST['gender']);
			$gender = strip_tags($gender);
			$gender = htmlspecialchars($gender);
			
			$marital = trim($_POST['marital']);
			$marital = strip_tags($marital);
			$marital = htmlspecialchars($marital);

			$citizenship = trim($_POST['citizenship']);
			$citizenship = strip_tags($citizenship);
			$citizenship = htmlspecialchars($citizenship);
			
			$mobile = trim($_POST['mobile']);
			$mobile = strip_tags($mobile);
			$mobile = htmlspecialchars($mobile);
			
			$position = trim($_POST['position']);
			$position = strip_tags($position);
			$position = htmlspecialchars($position);
			
			$role = trim($_POST['role']);
			$role = strip_tags($role);
			$role = htmlspecialchars($role);
			
			$username = trim($_POST['username']);
			$username = strip_tags($username);
			$username = htmlspecialchars($username);
			
			$password = trim($_POST['password']);
			$password = strip_tags($password);
			$password = htmlspecialchars($password);
			$password = hash('sha256', $password);
			
			$station_id = trim($_POST['station_id']);
			$station_id = strip_tags($station_id);
			$station_id = htmlspecialchars($station_id);

			$sql = "SELECT * FROM tbl_officer where firstname = '" . $firstname . "' and middlename = '" . $middlename . "' and lastname = '" . $lastname . "'";
			
			$result = $conn->query($sql);
			$count = mysqli_num_rows($result);
			
			if ($count >= 1){
					echo "<script>alert('Officer Already Exist!');		</script>";
			}else{
				$target_dir = "pictures/";
				$filetype =  pathinfo($_FILES["fileToUpload"]["name"])['extension'];
				$newfile = "roadar-" . date("Ymdhis") . "." . $filetype;
			
				$target_file = $target_dir . $newfile;

				$uploadOk = 1;

				// Check if file already exists
				if (file_exists($target_file)) {
				echo "Sorry, file already exists.";
				$uploadOk = 0;
				}
				if ($uploadOk == 0) {
				echo "Sorry, your file was not uploaded.";
					// if everything is ok, try to upload file
				}else{
					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
						$query = "INSERT INTO tbl_officer(salutation,firstname,middlename,lastname,suffix,street,barangay,city,province,postal_code,birthday,age,gender,marital_status,citizenship,mobile_no,position,role,username,password,station_id,picture) VALUES('$salutation','$firstname','$middlename','$lastname','$suffix','$street','$barangay','$city','$province','$postal','$birthday','$age','$gender','$marital','$citizenship','$mobile','$position','$role','$username','$password','$station_id','$newfile')";
						$res = mysqli_query($conn,$query);
						if ($res) {
							echo "<script>alert('Officer Added to Database');		</script>";
						} else {
							echo "<script>alert('Something went wrong, try again later...');</script>";
						}	
					}else{
						echo "<script>alert('Error Uploading File!');		</script>";
					}
				}
				
			}
	}else if( isset($_POST['denyform']) ) {
		$query = "update  tbl_incident_report set report_status = 'Denied', reason = '" . $_POST['reason'] . "' where report_no = '"  . $_POST['c_nox'] . "'" ;
						$res = mysqli_query($conn,$query);
						if ($res) {
							echo "<script>alert('Report Denied');		</script>";
						} else {
							echo "<script>alert('Something went wrong, try again later...');</script>";
						}	
	}else if( isset($_POST['editform']) ) {	
			
			$salutation = trim($_POST['salutation']);
			$salutation = strip_tags($salutation);
			$salutation = htmlspecialchars($salutation);
			
			$firstname = trim($_POST['firstname']);
			$firstname = strip_tags($firstname);
			$firstname = htmlspecialchars($firstname);
			
			$middlename = trim($_POST['middlename']);
			$middlename = strip_tags($middlename);
			$middlename = htmlspecialchars($middlename);
			
			$lastname = trim($_POST['lastname']);
			$lastname = strip_tags($lastname);
			$lastname = htmlspecialchars($lastname);
			
			$suffix = trim($_POST['suffix']);
			$suffix = strip_tags($suffix);
			$suffix = htmlspecialchars($suffix);
			
			$street = trim($_POST['street']);
			$street = strip_tags($street);
			$street = htmlspecialchars($street);
			
			$barangay = trim($_POST['barangay']);
			$barangay = strip_tags($barangay);
			$barangay = htmlspecialchars($barangay);
			
			$city = trim($_POST['city']);
			$city = strip_tags($city);
			$city = htmlspecialchars($city);
			
			$province = trim($_POST['province']);
			$province = strip_tags($province);
			$province = htmlspecialchars($province);
			
			$postal = trim($_POST['postal']);
			$postal = strip_tags($postal);
			$postal = htmlspecialchars($postal);
	
			$birthday = trim($_POST['birthday']);
			$birthday = strip_tags($birthday);
			$birthday = htmlspecialchars($birthday);
			
			$age = trim($_POST['age']);
			$age = strip_tags($age);
			$age = htmlspecialchars($age);
			
			$gender = trim($_POST['gender']);
			$gender = strip_tags($gender);
			$gender = htmlspecialchars($gender);
			
			$marital = trim($_POST['marital']);
			$marital = strip_tags($marital);
			$marital = htmlspecialchars($marital);

			$citizenship = trim($_POST['citizenship']);
			$citizenship = strip_tags($citizenship);
			$citizenship = htmlspecialchars($citizenship);
			
			$mobile = trim($_POST['mobile']);
			$mobile = strip_tags($mobile);
			$mobile = htmlspecialchars($mobile);
			
			$position = trim($_POST['position']);
			$position = strip_tags($position);
			$position = htmlspecialchars($position);
			
			$role = trim($_POST['role']);
			$role = strip_tags($role);
			$role = htmlspecialchars($role);
			
			$username = trim($_POST['username']);
			$username = strip_tags($username);
			$username = htmlspecialchars($username);
			
			$password = trim($_POST['password']);
			$password = strip_tags($password);
			$password = htmlspecialchars($password);
			$password = hash('sha256', $password);
			
			$station_id = trim($_POST['station_id']);
			$station_id = strip_tags($station_id);
			$station_id = htmlspecialchars($station_id);
			$update_id = $_POST['c_no'];
			$sql = "SELECT * FROM tbl_officer where firstname = '" . $firstname . "' and middlename = '" . $middlename . "' and lastname = '" . $lastname . "'  and c_no <> " . $update_id ;
			
			$result = $conn->query($sql);
			$count = mysqli_num_rows($result);
			if ($count >= 1){
					echo "<script>alert('Officer Already Exist!');		</script>";
			}else{
				$target_dir = "pictures/";
				$filetype =  pathinfo($_FILES["fileToUpload"]["name"])['extension'];
				$newfile = "roadar-" . date("Ymdhis") . "." . $filetype;
			
				$target_file = $target_dir . $newfile;

				$uploadOk = 1;

				// Check if file already exists
				if (file_exists($target_file)) {
				echo "Sorry, file already exists.";
				$uploadOk = 0;
				}
				if ($uploadOk == 0) {
				echo "Sorry, your file was not uploaded.";
					// if everything is ok, try to upload file
				}else{
					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
						$query = "update tbl_officer set salutation = '$salutation',firstname = '$firstname',middlename = '$middlename',lastname = '$lastname',suffix = '$suffix',street = '$street',barangay = '$barangay',city = '$city',postal_code = '$postal',birthday = '$birthday',age = '$age',gender = '$gender',marital_status = '$marital',citizenship = '$citizenship',mobile_no = '$mobile',position = '$position',role = '$role',username = '$username',password = '$password',station_id = '$station_id',picture = '$newfile' where c_no ="  . $_POST['c_no'] ;
						$res = mysqli_query($conn,$query);
						if ($res) {
							echo "<script>alert('Officer Updated');		</script>";
						} else {
							echo "<script>alert('Something went wrong, try again later...');</script>";
						}	
					}else{
						echo "<script>alert('Error Uploading File!');		</script>";
					}
				}
				
			}
					
			
			
	}	
$queryCondition = "";
if(!empty($_POST["go"])) {
	
	$queryCondition = " where report_no like '%" . $_POST['name'] . "%' or report_date like '%" . $_POST['name'] . "%'";
}
 $orderby = " ORDER BY CASE report_status
WHEN 'Pending' THEN 4
WHEN 'Revision' THEN 3
WHEN 'Success' THEN 2
WHEN 'Denied' THEN 1
ELSE 0
END DESC, c_no ASC";
$sql = "select * from tbl_incident_report" . $queryCondition;
$href = 'manage_records.php';					
	
$perPage = 8; 
$page = 1;
if(isset($_POST['page'])){
	$page = $_POST['page'];
}
$start = ($page-1)*$perPage;

if($start < 0) $start = 0;
	
$query =  $sql . $orderby .  " limit " . $start . "," . $perPage; 

$result = $conn->query($query);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>Roadar v2.0 - Manage Officers</title>

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
<div class="modal fade" id="addform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">Add Officer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="RegisterForm" method="post" enctype="multipart/form-data">
	  
        <div class="modal-body">
          
     
          <div class="form-group">
            <label for="password1">Salutation</label>
            <input type="text" class="form-control" id="salutation" name="salutation"  required="">
          </div>
		   <div class="form-group">
            <label for="password1">First Name</label>
            <input type="text" class="form-control" id="firstname" name="firstname" required="" >
          </div>
		    <div class="form-group">
            <label for="password1">Middle Name</label>
            <input type="text" class="form-control" id="middlename" name="middlename" required="" >
          </div>
		    <div class="form-group">
            <label for="password1">Last Name</label>
            <input type="text" class="form-control" id="lastname" name="lastname" required="" >
          </div>
          <div class="form-group">
            <label for="password1">Suffix</label>
            <input type="text" class="form-control" id="suffix" name="suffix" required="" >
          </div>
		  <div class="form-group">
            <label for="password1">Street</label>
            <input type="text" class="form-control" id="street" name="street" required="" >
          </div>
		  <div class="form-group">
            <label for="password1">Barangay</label>
            <input type="text" class="form-control" id="barangay" name="barangay" required="" >
          </div>
		  <div class="form-group">
            <label for="password1">City</label>
            <input type="text" class="form-control" id="city" name="city" required="" >
          </div>
		  		  <div class="form-group">
            <label for="password1">Province</label>
            <input type="text" class="form-control" id="province" name="province" required="" >
          </div>
		  <div class="form-group">
            <label for="password1">Postal Code</label>
            <input type="text" class="form-control" id="postal" name="postal" required="" >
          </div>
		  <div class="form-group">
            <label for="password1">Birthday</label>
            <input type="date" class="form-control" id="birthday" name="birthday" required="" >
          </div>
		   <div class="form-group">
            <label for="password1">Age</label>
            <input type="text" class="form-control" id="age" name="age" required="" >
          </div>
		   <div class="form-group">
           <label for="schoolyear">Gender</label>
			<select class="form-control" id="gender" name="gender" required="">
			<option value="" disabled="disabled" selected >select gender</option>
				<option value="Male">Male</option>
				<option value="Female">Female</option>
			
			</select>
          </div>
			<div class="form-group">
           <label for="schoolyear">Marital Status</label>
			<select class="form-control" id="marital" name="marital" required="">
			<option value="" disabled="disabled" selected >select Marital Status</option>
				<option value="Single">Single</option>
				<option value="Married">Married</option>
				<option value="Widowed">Widowed</option>
			
			</select>
          </div>
		   <div class="form-group">
            <label for="password1">Citizenship</label>
            <input type="text" class="form-control" id="citizenship" name="citizenship" required="" >
          </div>
		   <div class="form-group">
            <label for="password1">Mobile Number</label>
            <input type="text" class="form-control" id="mobile" name="mobile" required="" >
          </div>
		  <div class="form-group">
           <label for="schoolyear">Position</label>
			<select class="form-control" id="position" name="position" required="">
			<option value="" disabled="disabled" selected >select position</option>
				<option value="Officer I">Officer I</option>
				<option value="Officer II">Officer II</option>
				<option value="Police Corp">Police Corp</option>
				<option value="Chief">Chief</option>
			
			</select>
          </div>
		    <div class="form-group">
           <label for="schoolyear">Role</label>
			<select class="form-control" id="role" name="role" required="">
			<option value="" disabled="disabled" selected >select role</option>
				<option value="Administrator">Administrator</option>
				<option value="Officer">Officer</option>
				
			
			</select>
          </div>
		   <div class="form-group">
            <label for="password1">Username</label>
            <input type="text" class="form-control" id="username" name="username" required="" >
          </div>
		   <div class="form-group">
            <label for="password1">Password</label>
            <input type="password" class="form-control" id="password" name="password" required="" >
          </div>
		   <div class="form-group">
           <label for="schoolyear">Station</label>
			<select class="form-control" id="station_id" name="station_id" required="">
			<option value="" disabled="disabled" selected >select station</option>
			<?php
				$sql2= "SELECT * FROM tbl_stations";
				$result2 = $conn->query($sql2);
				
				while ($row2 = $result2->fetch_assoc()) {
					?>
						<option value="<?php echo $row2['c_no']; ?>"><?php echo $row2['police_station_name']; ?></option>
				
			 <?php } ?>
			 
			</select>
          </div>
		   <div class="form-group">
		    <label for="schoolyear">Picture</label>
            <input type="file" name="fileToUpload" id="fileToUpload">
            
          </div>
        </div>
		
        <div class="modal-footer border-top-0 d-flex justify-content-center">
		<input type="submit" name="addform" class="form_submit" id="submit" value="Apply Changes" />
          
        </div>
      </form>
    </div>
  </div>
  </div>
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
 <div class="modal fade" id="editform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">Modify Officer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="RegisterForm" method="post" enctype="multipart/form-data">
	  
        <div class="modal-body">
          
      <div class="form-group">
            <label for="password1">Salutation</label>
            <input type="text" class="form-control" id="salutation2" name="salutation"  required="">
          </div>
		   <div class="form-group">
            <label for="password1">First Name</label>
            <input type="text" class="form-control" id="firstname2" name="firstname" required="" >
          </div>
		    <div class="form-group">
            <label for="password1">Middle Name</label>
            <input type="text" class="form-control" id="middlename2" name="middlename" required="" >
          </div>
		    <div class="form-group">
            <label for="password1">Last Name</label>
            <input type="text" class="form-control" id="lastname2" name="lastname" required="" >
          </div>
          <div class="form-group">
            <label for="password1">Suffix</label>
            <input type="text" class="form-control" id="suffix2" name="suffix" required="" >
          </div>
		  <div class="form-group">
            <label for="password1">Street</label>
            <input type="text" class="form-control" id="street2" name="street" required="" >
          </div>
		  <div class="form-group">
            <label for="password1">Barangay</label>
            <input type="text" class="form-control" id="barangay2" name="barangay" required="" >
          </div>
		  <div class="form-group">
            <label for="password1">City</label>
            <input type="text" class="form-control" id="city2" name="city" required="" >
          </div>
		  		  <div class="form-group">
            <label for="password1">Province</label>
            <input type="text" class="form-control" id="province2" name="province" required="" >
          </div>
		  <div class="form-group">
            <label for="password1">Postal Code</label>
            <input type="text" class="form-control" id="postal2" name="postal" required="" >
          </div>
		  <div class="form-group">
            <label for="password1">Birthday</label>
            <input type="date" class="form-control" id="birthday2" name="birthday" required="" >
          </div>
		   <div class="form-group">
            <label for="password1">Age</label>
            <input type="text" class="form-control" id="age2" name="age" required="" >
          </div>
		   <div class="form-group">
           <label for="schoolyear">Gender</label>
			<select class="form-control" id="gender2" name="gender" required="">
			<option value="" disabled="disabled" selected >select gender</option>
				<option value="Male">Male</option>
				<option value="Female">Female</option>
			
			</select>
          </div>
			<div class="form-group">
           <label for="schoolyear">Marital Status</label>
			<select class="form-control" id="marital2" name="marital" required="">
			<option value="" disabled="disabled" selected >select Marital Status</option>
				<option value="Single">Single</option>
				<option value="Married">Married</option>
				<option value="Widowed">Widowed</option>
			
			</select>
          </div>
		   <div class="form-group">
            <label for="password1">Citizenship</label>
            <input type="text" class="form-control" id="citizenship2" name="citizenship" required="" >
          </div>
		   <div class="form-group">
            <label for="password1">Mobile Number</label>
            <input type="text" class="form-control" id="mobile2" name="mobile" required="" >
          </div>
		  <div class="form-group">
           <label for="schoolyear">Position</label>
			<select class="form-control" id="position" name="position" required="">
			<option value="" disabled="disabled" selected >select position</option>
				<option value="Officer I">Officer I</option>
				<option value="Officer II">Officer II</option>
				<option value="Police Corp">Police Corp</option>
				<option value="Chief">Chief</option>
			
			</select>
          </div>
		    <div class="form-group">
           <label for="schoolyear">Role</label>
			<select class="form-control" id="role" name="role" required="">
			<option value="" disabled="disabled" selected >select role</option>
				<option value="Administrator">Administrator</option>
				<option value="Officer">Officer</option>
				
			
			</select>
          </div>
		   <div class="form-group">
            <label for="password1">Username</label>
            <input type="text" class="form-control" id="username2" name="username" required="" >
          </div>
		   <div class="form-group">
            <label for="password1">Password</label>
            <input type="password" class="form-control" id="password2" name="password" required="" >
          </div>
		   <div class="form-group">
           <label for="schoolyear">Station</label>
			<select class="form-control" id="station_id" name="station_id" required="">
			<option value="" disabled="disabled" selected >select station</option>
			<?php
				$sql2= "SELECT * FROM tbl_stations";
				$result2 = $conn->query($sql2);
				
				while ($row2 = $result2->fetch_assoc()) {
					?>
						<option value="<?php echo $row2['c_no']; ?>"><?php echo $row2['police_station_name']; ?></option>
				
			 <?php } ?>
			 
			</select>
          </div>
		   <div class="form-group">
		    <label for="schoolyear">Picture</label>
            <input type="file" name="fileToUpload" id="fileToUpload">
            
          </div>
        </div>
      
		   <div class="form-group">
             
            <input type="hidden" class="form-control" id="c_no" name="c_no" >
            
          </div>
        
		
        <div class="modal-footer border-top-0 d-flex justify-content-center">
		<input type="submit" name="editform" class="form_submit" id="submit" value="Apply Changes" />
          
        </div>
      </form>
    </div>
  </div>
   </div>
  <div class="modal fade" id="denyform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">Deny Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="RegisterForm" method="post" enctype="multipart/form-data">
	  
        <div class="modal-body">
          
       <div class="form-group">
            <label for="password1">Reason</label>
            <input type="text" class="form-control" id="reason" name="reason" required="" >
          </div>
          
		   <div class="form-group">
             
            <input type="text" class="form-control" id="c_nox" name="c_nox" >
            
          </div>
        
		
        <div class="modal-footer border-top-0 d-flex justify-content-center">
		<input type="submit" name="denyform" class="form_submit" id="submit" value="Apply Changes" />
          
        </div>
      </form>
    </div>
  </div>
  </div>   
    </div> 
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
                            <a class="nav-link" href="manage_news.php" tabindex="-1">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-newspaper"></i></div>
                                <div class="col">Manage News</div>
                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link active" href="manage_officer.php" tabindex="-1">
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
					<h1 class="titleheader"> Manage Records</h1>
                </div>
                
            </div>
        </header>
        <!-- Header ends -->

        <!-- main page content -->
        <div class="main-container container">
		
		<form name="frmlogs" method="post" action="manage_record.php" >
		<div class="input-group mb-3">
		  <input type="text" class="form-control" name="name"  placeholder="Search" aria-label="Recipient's username" aria-describedby="basic-addon2">
		  <div class="input-group-append">
			<input type="submit" name="go" class="btn btn-outline-secondary" value="Search" >
			<input type="reset" name="go" class="btn btn-outline-secondary" value="Reset" onclick="window.location='manage_record.php'" >
		  </div>
		</div>
         
           
			<?php
				while ($row = $result->fetch_assoc()) {
			?>
            <div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-auto">
							<div class="avatar avatar-60 shadow-sm rounded-10 bg-dark text-white">
								<img src="pictures/collision.png" alt="">
							</div>
						</div>
						<div class="col align-self-center ps-0">

							<p class="mb-1 text-color-theme" style="font-size:18px;font-weight:bold"><?php echo $row['accident_severity'] . " in " . $row['city'] . "," . $row['province'] ; ?>
								
								<?php if ( $row['report_status'] == "Pending"){ ?>
									 <span class="tag bg-warning text-white border-warning py-1 px-2 float-end mt-1"><?php echo $row['report_status']; ?></span>
								<?php } else if ( $row['report_status'] == "Denied"){ ?>
									<span class="tag bg-danger text-white border-danger py-1 px-2 float-end mt-1"><?php echo $row['report_status']; ?></span>
								<?php } else if ( $row['report_status'] == "Revision"){ ?>
									<span class="tag bg-info text-white border-info py-1 px-2 float-end mt-1"><?php echo $row['report_status']; ?></span>
								<?php } else if ( $row['report_status'] == "Success"){ ?>
									<span class="tag bg-success text-white border-success py-1 px-2 float-end mt-1"><?php echo $row['report_status']; ?></span>
								<?php } ?>
								
							</p>

							<div class="row">
								<div class="col">Report No.: <?php echo $row['report_no']; ?></div>
								<div class="col-auto align-self-center text-end">
									
									<a href="view_incident_summary.php?id=<?php echo  $row['report_no'] ?>" taget="blank_" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
									
				<?php if ( $row['report_status'] == "Denied" || $row['report_status'] == "Revision"  || $row['report_status'] == "Success" ){ ?>
				<?php }else{ ?>
									<a href="" class="approve" title="Approve" onclick="myFunction2('<?php echo  $row['report_no'] ?>')"><i class="material-icons">check</i></a>
									<a href="#" class="delete2" title="Delete" data-toggle="modal" data-target="#denyform"  data-id="<?php echo  $row['report_no'] ?>"><i class="material-icons">&#xE872;</i></a>
				<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			</br>
			<?php
				}
			?>
			<?php
			if(!empty($result)) {
			
			$row["perpage"] = showperpage($conn,$sql, $perPage, $href);
			}?>
			<?php
					if(isset($row["perpage"])) {
					?>
					
					<table>
					<td colspan="6"  align=right> <?php echo $row["perpage"]; ?></td>
					</table>
	
					<?php } ?>
    </form>	
			


        </div>
        <!-- main page content ends -->


    </main>
    <!-- Page ends-->

    
    <!-- Footer ends-->
	<script>
		$(document).ready(function() {
		$('a[data-toggle=modal], button[data-toggle=modal]').click(function () {
			var data_id = '';
			var myClass = $(this).attr("class");
			if (myClass == 'delete2'){
				
				document.getElementById("c_nox").value = $(this).data('id');
			}
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
			   document.getElementById("salutation2").value =  nameArr[1];
			   document.getElementById("firstname2").value =  nameArr[2];
			   document.getElementById("middlename2").value =  nameArr[3];
			   document.getElementById("lastname2").value =  nameArr[4];
			   document.getElementById("suffix2").value =  nameArr[5];
document.getElementById("street2").value =  nameArr[6];
document.getElementById("barangay2").value =  nameArr[7];
document.getElementById("city2").value =  nameArr[8];
document.getElementById("province2").value =  nameArr[9];
document.getElementById("postal2").value =  nameArr[10];
document.getElementById("birthday2").value =  nameArr[11];
document.getElementById("age2").value =  nameArr[12];
document.getElementById("gender2").value =  nameArr[13];
document.getElementById("citizenship2").value =  nameArr[14];
document.getElementById("mobile2").value =  nameArr[15];
document.getElementById("username2").value =  nameArr[16];
document.getElementById("password2").value =  nameArr[17];

			   
			   
			   
			  }
			};
			
			xmlhttp.open("GET", "query_officer.php?id=" + str, true);
			xmlhttp.send();
		  }
		}
	</script>
	<script type="text/javascript">
        $(document).ready( function() {
            $('.delete').click( function() {
                var id = $(this).attr("id");
				
                if(confirm("Are you sure you want to delete this officer?")){
                           window.location = "delete_officer.php?id=" + id ;
                }else{
                    return false;}
            });				
        });
		
    </script>
	<script type="text/javascript">
	
	function myFunction(x) {
        let confirmAction = confirm("Editing this will make status 'On Revision' and will be subject for admin approval again. Are you sure you want to edit?");
        if (confirmAction) {
          window.location = "modify_incident_report.php?id=" + x ;
        } 
		
	}
	
	</script>
	
	<script type="text/javascript">
	
	function myFunction2(z) {
        let confirmAction2 = confirm("Are you sure you want to approve this report?");
        if (confirmAction2) {
			
			q =  "update_report.php?id=" + z ;
		
          window.location =q;
		  
        } 
		
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

</body>

</html>