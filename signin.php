<?php
session_start();
include_once 'dbconnector.php';
if(isset($_POST['submit'])){
	$username = trim($_POST['username']);
	$username = strip_tags($username);
	$username = htmlspecialchars($username);
	
	$password = trim($_POST['password']);
	$password = strip_tags($password);
	$password = htmlspecialchars($password);
	
	$password = hash('sha256', $password); // password hashing using SHA256
	$sql = "SELECT * FROM tbl_officer WHERE username='$username'";
	
	$result = $conn->query($sql);
	$count = mysqli_num_rows($result);
	$row=$result->fetch_assoc();
	
		
			
	if( $count == 1 && $row['password']==$password ) {
		$_SESSION['myuser_id'] = $row['c_no'];
		$_SESSION['user_type'] = $row['role'];
		$role = $row['role'];
		$_SESSION['log_name'] = $row['firstname'];
		$_SESSION['log_fullname'] = $row['firstname'] . " " . $row['middlename'] . " " . $row['lastname'];
		$_SESSION['picture'] = $row['picture'];
		$sql = "SELECT * FROM tbl_stations WHERE c_no=" . $row['station_id'];
		$result = $conn->query($sql);
		$count = mysqli_num_rows($result);
		$row=$result->fetch_assoc();
		$_SESSION['station_name'] = $row['police_station_name'];
		if ($role == "Officer"){
			echo "<script>window.location.href='main_officer.php';	</script>";
		}else{
			echo "<script>window.location.href='main.php';	</script>";
		}
	} else {
		echo "<script>alert('Incorrect Credentials, Try again...');</script>";
	}
}
?>
<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>Roadar v2.0 - Login</title>

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
	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- style css for this template -->
    <link href="assets/css/style.css" rel="stylesheet" id="style">
</head>

<body class="body-scroll d-flex flex-column h-100" data-page="signin">

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

    <!-- Begin page content -->
    <main class="container-fluid h-100">
        <div class="row h-100 overflow-auto">
            <div class="col-12 text-center mb-auto px-0">
                <header class="header">
                    <div class="row">
                        <div class="col-auto"></div>
                        <div class="col">
                         
                        </div>
                        <div class="col-auto"></div>
                    </div>
                </header>
            </div>
            <div class="col-10 col-md-6 col-lg-5 col-xl-3 mx-auto align-self-center text-center py-4">
                    <img src="assets/img/logo2.png" class="logo2" alt="">
                <form class="was-validated needs-validation" novalidate method="post">
                    <div class="form-group form-floating mb-3 is-valid">
                        <input type="text" class="form-control" value="" id="username" name="username" required placeholder="Username">
                        <label class="form-control-label" for="username">Username</label>
                    </div>

                    <div class="form-group form-floating is-invalid mb-3">
                        <input type="password" class="form-control " id="password" name="password" required placeholder="Password">
                        <label class="form-control-label" for="password">Password</label>
                       
                    </div>
                    
					<input type="submit" name="submit" class="btn btn-lg btn-default w-100 mb-4 shadow" id="submit" value="SIGN IN" />
                    
                </form>
               

            </div>
            <div class="col-12 text-center mt-auto">
                <div class="row justify-content-center footer-info">
                    <div class="col-auto">
                        <p class="text-muted">Or you can continue as  </p>
						 <button type="button" class="btn btn-lg btn-default w-100 mb-4 shadow"
                        onclick="window.location.replace('cities.php');">
                        Guest
                    </button>
                    </div>
                   
                </div>
            </div>
        </div>
    </main>


    <!-- Required jquery and libraries -->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/vendor/bootstrap-5/js/bootstrap.bundle.min.js"></script>

    <!-- cookie js -->
    <script src="assets/js/jquery.cookie.js"></script>

    <!-- Customized jquery file  -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/color-scheme.js"></script>

    <!-- page level custom script -->
    <script src="assets/js/app.js"></script>

</body>

</html>