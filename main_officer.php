<?php
session_start();
include_once 'dbconnector.php';
if( isset($_POST['updateprofile']) ) {	
			
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
						$query = "update tbl_officer set salutation = '$salutation',firstname = '$firstname',middlename = '$middlename',lastname = '$lastname',suffix = '$suffix',street = '$street',barangay = '$barangay',city = '$city',postal_code = '$postal',birthday = '$birthday',age = '$age',gender = '$gender',marital_status = '$marital',citizenship = '$citizenship',mobile_no = '$mobile',position = '$position',username = '$username',password = '$password',station_id = '$station_id',picture = '$newfile' where c_no ="  . $_POST['c_no'] ;
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
$data = "";
for ($i = 0; $i < 30; $i++)
{
    $timestamp = time();
    $tm = 86400 * $i; // 60 * 60 * 24 = 86400 = 1 day in seconds
    $tm = $timestamp - $tm;

    $the_date = date("M j", $tm);
	$data = $data . "\" $the_date  \",";
	
	
}
$data = rtrim($data, ", ");

$data2 = "";
$count = 0;
for ($i = 0; $i < 30; $i++)
{
    $timestamp = time();
    $tm = 86400 * $i; // 60 * 60 * 24 = 86400 = 1 day in seconds
    $tm = $timestamp - $tm;

    $the_date = date("Y-m-d", $tm);
	
	$sql = "SELECT * FROM `tbl_incident_report` WHERE date(report_datetime) = '" . $the_date . "'"; 
	$result = $conn->query($sql);
	$count = $count . ", " . mysqli_num_rows($result) ;
	
	
}
$data3 = "";
$data4 = "";
 	$sql = "SELECT accident_causation as ac,COUNT(accident_causation) as accident_count, count(accident_causation) / (Select count(accident_causation) from tbl_incident_report) * 100 as percent FROM `tbl_incident_report` group by accident_causation order by accident_count desc; "; 
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
		if ($data3 == ""){
			$data3 = "'" . $row['ac'];
			$data4 = $row['percent'];
			
		}else{
			$data3 = $data3 . "','" . $row['ac'];
			$data4 = $data4 . "," . $row['percent'];
		}
	}
	$data3 = $data3 . "'";
$cities[] ="";
$total_accident[] = "";
$mypercent[] = "";	
	
$sql = "SELECT * FROM `tbl_incident_report` where report_date = '" . date("Y-m-d") . "' and reporting_officer_id = " . $_SESSION['myuser_id']; 

$result = $conn->query($sql);
$total_count = mysqli_num_rows($result);

$sql = "SELECT * FROM `tbl_incident_report` where reporting_officer_id = " . $_SESSION['myuser_id'] . " order by c_no desc"; 

$result = $conn->query($sql);
$mycount = mysqli_num_rows($result);
$row=$result->fetch_assoc();
$sample_report_no = $row['report_no'];
$sample_report_status = $row['report_status'];
$sql = "SELECT city,COUNT(city) as accident_count, count(city) / (Select count(city) from tbl_incident_report) * 100 as percent FROM `tbl_incident_report` group by city order by accident_count desc"; 
	$result = $conn->query($sql);
	
	while ($row = $result->fetch_assoc()) {
		array_push($cities,$row['city']);
		array_push($total_accident,$row['accident_count']);
		array_push($mypercent,$row['percent']);
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
    <title>Roadar v2.0 - Main Page</title>

    <!-- manifest meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="manifest" href="manifest.json" />

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

    <!-- swiper carousel css -->
    <link rel="stylesheet" href="assets/vendor/swiperjs-6.6.2/swiper-bundle.min.css">
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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
	
	

    <!-- date rage picker -->
    <link rel="stylesheet" href="assets/vendor/daterangepicker/daterangepicker.css">

 <style>
 .progress{
    width: 150px;
    height: 150px;
    line-height: 150px;
    background: none;
    margin: 0 auto;
    box-shadow: none;
    position: relative;
}
.progress:after{
    content: "";
    width: 100%;
    height: 100%;
    border-radius: 50%;
    border: 12px solid #fff;
    position: absolute;
    top: 0;
    left: 0;
}
.progress > span{
    width: 50%;
    height: 100%;
    overflow: hidden;
    position: absolute;
    top: 0;
    z-index: 1;
}
.progress .progress-left{
    left: 0;
}
.progress .progress-bar{
    width: 100%;
    height: 100%;
    background: none;
    border-width: 12px;
    border-style: solid;
    position: absolute;
    top: 0;
}
.progress .progress-left .progress-bar{
    left: 100%;
    border-top-right-radius: 80px;
    border-bottom-right-radius: 80px;
    border-left: 0;
    -webkit-transform-origin: center left;
    transform-origin: center left;
}
.progress .progress-right{
    right: 0;
}
.progress .progress-right .progress-bar{
    left: -100%;
    border-top-left-radius: 80px;
    border-bottom-left-radius: 80px;
    border-right: 0;
    -webkit-transform-origin: center right;
    transform-origin: center right;
    animation: loading-1 1.8s linear forwards;
}
.progress .progress-value{
    width: 90%;
    height: 90%;
    border-radius: 50%;
    background: #44484b;
    font-size: 24px;
    color: #fff;
    line-height: 135px;
    text-align: center;
    position: absolute;
    top: 5%;
    left: 5%;
}
.progress.blue .progress-bar{
    border-color: #049dff;
}
.progress.blue .progress-left .progress-bar{
    animation: loading-2 1.5s linear forwards 1.8s;
}
.progress.yellow .progress-bar{
    border-color: #fdba04;
}
.progress.yellow .progress-left .progress-bar{
    animation: loading-3 1s linear forwards 1.8s;
}
.progress.pink .progress-bar{
    border-color: #ed687c;
}
.progress.pink .progress-left .progress-bar{
    animation: loading-4 0.4s linear forwards 1.8s;
}
.progress.green .progress-bar{
    border-color: #1abc9c;
}
.progress.green .progress-left .progress-bar{
    animation: loading-5 1.2s linear forwards 1.8s;
}
@keyframes loading-1{
    0%{
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100%{
        -webkit-transform: rotate(180deg);
        transform: rotate(180deg);
    }
}
@keyframes loading-2{
    0%{
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100%{
        -webkit-transform: rotate(144deg);
        transform: rotate(144deg);
    }
}
@keyframes loading-3{
    0%{
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100%{
        -webkit-transform: rotate(90deg);
        transform: rotate(90deg);
    }
}
@keyframes loading-4{
    0%{
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100%{
        -webkit-transform: rotate(36deg);
        transform: rotate(36deg);
    }
}
@keyframes loading-5{
    0%{
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100%{
        -webkit-transform: rotate(126deg);
        transform: rotate(126deg);
    }
}
@media only screen and (max-width: 990px){
    .progress{ margin-bottom: 20px; }
}

</style> 
    
</head>

<body class="body-scroll" data-page="index">
<div class="modal fade" id="editform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">Modify Your Profile</h5>
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
		<input type="submit" name="updateprofile" class="form_submit" id="submit" value="Apply Changes" />
          
        </div>
      </form>
    </div>
  </div>
  </div>   
    <!-- loader section -->
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
    <!-- loader section ends -->

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
                            <a class="nav-link " aria-current="page" href="main_officer.php">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-house-door"></i></div>
                                <div class="col">Dashboard</div>
                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                            </a>
                        </li>
						<li class="nav-item">
                            <a class="nav-link " href="news2.php" tabindex="-1">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-newspaper"></i></div>
                                <div class="col">News and Updates</div>
                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link active" href="manage_record_officer.php" tabindex="-1">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-house-fill"></i></div>
                                <div class="col">Activities</div>
                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                            </a>
                        </li>
						<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                                aria-expanded="false">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-person"></i></div>
                                <div class="col">Account</div>
                                <div class="arrow"><i class="bi bi-plus plus"></i> <i class="bi bi-dash minus"></i>
                                </div>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item nav-link" href="#"  data-toggle="modal" data-target="#editform"  data-id="<?php echo  $_SESSION['myuser_id'] ?>">
                                        <div class="avatar avatar-40 rounded icon"><i class="bi bi-calendar2"></i></div>
                                        <div class="col">Profile</div>
                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                                    </a></li>
                                <li><a class="dropdown-item nav-link" href="style2.php">
                                        <div class="avatar avatar-40 rounded icon"><i class="bi bi-calendar-check"></i>
                                        </div>
                                        <div class="col">Settings</div>
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
                        <i class="bi bi-list" style="color:black"></i>
                    </a>
                </div>
                <div class="mylogo">
                   <img src="assets/img/logo2.png" alt="" class="logo2">
				   <h1 class="titleheader"> Overview </h1>
                </div>
                
            </div>
        </header>
		
        <!-- Header ends -->

        <!-- main page content -->
       <div class="main-container container">
            <!-- chart js areachart-->
			<div class="row mb-4">
                <div class="col-auto">
                    <div class="avatar avatar-50 shadow rounded-10">
                        <img src="pictures/<?php echo $_SESSION['picture']; ?>" alt="">
                    </div>
                </div>
                <div class="col align-self-center ps-0">
                    <h4 class="text-color-theme"><span class="fw-normal">Hi</span>, <?php echo $_SESSION['log_name']; ?></h4>
                    <p class="text-muted">Welcome</p>
                </div>
            </div>
            <div class="row">
				<div class="row mb-3">
					<div class="col">
						<h6 class="title">News and Updates</h6>
					</div>
					<div class="col-auto align-self-center">
						<a href="news.php" class="small">Read more</a>
					</div>
				</div>
				<div class="row">
				<?php
					$sql2= "SELECT * FROM tbl_news  order by c_no desc limit 3";
					$result2 = $conn->query($sql2);
	
					while ($row2 = $result2->fetch_assoc()) {
				?>
					<div class="col-12 col-md-6 col-lg-4">
						<a href="news_details.php?id=<?php echo $row2['c_no']; ?>" class="card mb-3">
							<div class="card-body">
								<div class="row">
									<div class="col-auto">
										<div class="avatar avatar-60 shadow-sm rounded-10 coverimg">
											<img src="pictures/<?php echo $row2['picture']; ?>" alt="">
										</div>
									</div>
									<div class="col align-self-center ps-0">
										<p class="text-color-theme mb-1"><?php echo substr($row2['title'], 0, 65); ?> ..</p>                                   
										<p class="text-muted size-12"><?php echo substr($row2['details'], 0, 80);  ?> ..</p>
									</div>
								</div>
							</div>
						</a>
					</div>
					<?php } ?>
					
				</div>
				<div class="container">
  <div class="row">
    <div class="col-sm">
		  <div class="col-12 col-md-6">
			<div class="card mb-4">
				<div class="card-header">
					<i class="fas fa-chart-bar me-1"></i>
						Monthly Performance
					</div>
					<div class="card-body"><canvas id="myBarChart" width="100%" height="50"></canvas></div>
					<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
				</div>
			</div>
    </div>
    <div class="col-sm">
			<div class="card shadow-sm mb-4">
								<div class="card-body">
									<div class="row">
										<div class="col-auto">
											<div class="avatar avatar-40 alert-success text-success rounded-circle">
												<i class="bi bi-arrow-down-left-circle"></i>
											</div>
										</div>
										<div class="col px-0 align-self-center">
											<p class="text-muted size-12 mb-0">Reported Today</p>
											<p style="font-size:32px;font-weight:bold"><?php echo $total_count; ?></p>
										</div>
									</div>
								</div>
							</div>
    </div>
   
  </div>
</div>
                
                <div class="col-12 col-md-6">
                    <div class="card shadow-md mb-4">
								<div class="card-body">
									<div class="row">
										<div class="col-auto">
											<div class="avatar avatar-40 alert-success text-success rounded-circle">
												<i class="bi bi-arrow-down-left-circle"></i>
											</div>
										</div>
										<div class="col px-0 align-self-center">
											<div class="card-header">
														<i class="fas fa-chart-pie me-1"></i>
														Accident Causation Level
													</div>
													<div class="card-body"><canvas id="myPieChart" width="100%" height="50"></canvas></div>
													<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
										</div>
									</div>
								</div>
							</div>
                </div>
            </div>
		

            <!-- Saving targets -->
            <div class="row mb-3">
                <div class="col">
                    <h6 class="title">Top Categories</h6>
                </div>
                <div class="col-auto">

                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 align-self-center">
                   <div class="card mb-4" style="height:240px">
                        <div class="card-body">
                          
                                <div class="card shadow-sm mb-4 alert-warning">
                                    <div class="card-body" style="height:90px">
                                        <div class="row">
                                           <div class="col-auto">
                                                <div class="avatar avatar-40 bg-warning text-white rounded-circle">
                                                    <i class="bi bi-stack"></i>
                                                </div>
                                            </div>
                                            <div class="col px-0">
                                                <h6 class="mb-0">11</h6>
                                                <p class="text-muted small">On Revisions</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                          
                                <div class="card shadow-sm mb-4 alert-danger">
                                    <div class="card-body" style="height:90px">
                                        <div class="row">
                                            <div class="col-auto">
                                                <div class="avatar avatar-40 bg-danger text-white rounded-circle">
                                                    <i class="bi bi-bar-chart"></i>
                                                </div>
                                            </div>
                                            <div class="col px-0">
                                                <h6 class="mb-0">6</h6>
                                                <p class="text-muted small">Pending</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                        </div>
                        <div class="smallchart">
                            <canvas id="smallchart2"></canvas>
                        </div>
                    </div>
                </div>

             
                <div class="col-6 col-md-3">
                    <div class="card mb-4" style="height:240px">
                         
                        <div class="card-body" >
                            
                            <h4 class="mb-0"><?php echo $sample_report_no; ?></h4>
                            <p class="text-muted mb-3 small"><?php echo $sample_report_status ; ?> </p>
                               <p class="text-muted mb-0">
                               
                                <br> <a href="manage_record_officer.php">View All</a>
                               
                            </p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="modify_incident_report.php?id=<?php echo $sample_report_no; ?>" <button class="btn btn-default btn-lg w-100">Edit Now!</button></a>
                        </div>
                    </div>
                    
                </div> 
					<h1>Top 3 Accident Prone City</h1></br>
						
						<div class="container">
  <div class="row">
    <div class="col-sm">
	<?php echo $cities[1] . " - " . $total_accident[1]; ?></br></br>
		 <div class="col-md-3 col-sm-6">
            <div class="progress blue">
			
                <span class="progress-left">
                    <span class="progress-bar"></span>
                </span>
				
                <span class="progress-right">
                    <span class="progress-bar"></span>
                </span>
                <div class="progress-value"><?php echo $mypercent[1]; ?></div>
            </div>
        </div>
    </div>
    <div class="col-sm">
	<?php echo $cities[2] . " - " . $total_accident[2];  ?></br></br>
        <div class="col-md-3 col-sm-6">
            <div class="progress yellow">
                <span class="progress-left">
                    <span class="progress-bar"></span>
                </span>
				
                <span class="progress-right">
                    <span class="progress-bar"></span>
                </span>
                <div class="progress-value"><?php echo $mypercent[2]; ?></div>
            </div>
        </div>
    </div>
    <div class="col-sm">
    <?php echo $cities[3] . " - " . $total_accident[3];  ?></br></br>
        <div class="col-md-3 col-sm-6">
            <div class="progress pink">
                <span class="progress-left">
                    <span class="progress-bar"></span>
                </span>
				
                <span class="progress-right">
                    <span class="progress-bar"></span>
                </span>
                <div class="progress-value"><?php echo $mypercent[3]; ?></div>
            </div>
        </div>
    </div>
  </div>
</div>
</br>
            </div>

           


        </div>
        <!-- main page content ends -->


    </main>
    <!-- Page ends-->
	<script>
		// Set new default font family and font color to mimic Bootstrap's default styling
		
		Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
		Chart.defaults.global.defaultFontColor = '#292b2c';

		// Bar Chart Example
		var ctx = document.getElementById("myBarChart");
		var myLineChart = new Chart(ctx, {
		  type: 'bar',
		  data: {
			labels: ['Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sept','Oct','Nov','Dec'],
			datasets: [{
			  label: "Total",
			  backgroundColor: "rgba(2,117,216,1)",
			  borderColor: "rgba(2,117,216,1)",
			  data: [<?php echo $count; ?>],
			}],
		  },
		  options: {
			scales: {
			  xAxes: [{
				time: {
				  unit: 'month'
				},
				gridLines: {
				  display: false
				},
				ticks: {
				  maxTicksLimit: 12
				}
			  }],
			  yAxes: [{
				ticks: {
				  min: 0,
				  max: 50,
				  maxTicksLimit: 5
				},
				gridLines: {
				  display: true
				}
			  }],
			},
			legend: {
			  display: false
			}
		  }
		});

	</script>
	<script>
		// Set new default font family and font color to mimic Bootstrap's default styling
		Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
		Chart.defaults.global.defaultFontColor = '#292b2c';

		// Bar Chart Example
		var ctx = document.getElementById("myBarChart2");
		var myLineChart = new Chart(ctx, {
		  type: 'bar',
		  data: {
			labels: ['Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sept','Oct','Nov','Dec'],
			datasets: [{
			  label: "Total",
			  backgroundColor: "rgba(2,117,216,1)",
			  borderColor: "rgba(2,117,216,1)",
			  data: [<?php echo $total2; ?>],
			}],
		  },
		  options: {
			scales: {
			  xAxes: [{
				time: {
				  unit: 'month'
				},
				gridLines: {
				  display: false
				},
				ticks: {
				  maxTicksLimit: 12
				}
			  }],
			  yAxes: [{
				ticks: {
				  min: 0,
				  max: 100,
				  maxTicksLimit: 5
				},
				gridLines: {
				  display: true
				}
			  }],
			},
			legend: {
			  display: false
			}
		  }
		});

	</script>
    <script>
	// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: [ <?php echo $data3; ?>],
    datasets: [{
      data: [<?php echo $data4; ?>],
      backgroundColor: ['#dc3545', '#ffc107', '#28a745'],
    }],
  },
});
</script>
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
   <!-- Required jquery and libraries -->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/vendor/bootstrap-5/js/bootstrap.bundle.min.js"></script>
	<script src="assets/js/scripts.js"></script>

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

    <!-- page level custom script -->
    <script src="assets/js/app.js"></script>

</body>

</html>