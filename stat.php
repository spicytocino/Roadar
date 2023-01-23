<?php
session_start();
include_once 'dbconnector.php';

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

    $the_date = date("m-d", $tm);
	$the_date = "2021-" . $the_date;
	
	$sql = "SELECT * FROM `tbl_incident_report` WHERE date(report_datetime) = '" . $the_date . "'"; 
	$result = $conn->query($sql);
	$count = $count . ", " . mysqli_num_rows($result) ;
	
	
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

    <!-- style css for this template -->
    <link href="assets/css/style.css" rel="stylesheet" id="style">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
</head>

<body class="body-scroll" data-page="index">

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
                            <a class="nav-link active" aria-current="page" href="main.php">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-house-door"></i></div>
                                <div class="col">Dashboard</div>
                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                            </a>
                        </li>
						<li class="nav-item">
                            <a class="nav-link" href="#" tabindex="-1">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-newspaper"></i></div>
                                <div class="col">News and Updates</div>
                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="#" tabindex="-1">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-shield-fill"></i></div>
                                <div class="col">Manage Officer</div>
                                <div class="arrow"><i class="bi bi-shield-right"></i></div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#" tabindex="-1">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-house-fill"></i></div>
                                <div class="col">Manage Stations</div>
                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                            </a>
                        </li>
						<li class="nav-item">
                            <a class="nav-link" href="#" tabindex="-1">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-folder"></i></div>
                                <div class="col">Manage Records</div>
                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                            </a>
                        </li>
                      

                        

                        <li class="nav-item">
                            <a class="nav-link" href="#" tabindex="-1">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-file-earmark-text"></i></div>
                                <div class="col">Reports</div>
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
                                <li><a class="dropdown-item nav-link" href="#">
                                        <div class="avatar avatar-40 rounded icon"><i class="bi bi-calendar2"></i></div>
                                        <div class="col">Profile</div>
                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                                    </a></li>
                                <li><a class="dropdown-item nav-link" href="#">
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
                <div class="col align-self-center text-center">
                   <img src="assets/img/logo2.png" alt="" class="logo2">
                </div>
                
            </div>
        </header>
        <!-- Header ends -->

        <!-- main page content -->
        <div class="main-container container">
            <!-- welcome user -->
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
			   <ul class="nav nav-pills nav-justified tabs mb-3" id="assetstabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#cards"
                        type="button" role="tab" aria-controls="cards" aria-selected="true">Cards</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="currency-tab" data-bs-toggle="tab" data-bs-target="#currency"
                        type="button" role="tab" aria-controls="currency" aria-selected="false">Currency</button>
                </li>
            </ul>
			 <div class="tab-content" id="assetstabsContent">
                <div class="tab-pane fade show active" id="cards" role="tabpanel" >
                    <div class="row">
						<div class="col-12 col-md-6">
							 <div class="card mb-4">
							 
											<div class="card-header">
												<i class="fas fa-chart-bar me-1"></i>
												Bar Chart Example
											</div>
											<div class="card-body"><canvas id="myBarChart" width="100%" height="50"></canvas></div>
											<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
										</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="row">
								<div class="col-6 col-md-12">
									<div class="card shadow-sm mb-4">
										<div class="card-body">
											<div class="row">
												<div class="col-auto">
													<div class="avatar avatar-40 alert-success text-success rounded-circle">
														<i class="bi bi-arrow-down-left-circle"></i>
													</div>
												</div>
												<div class="col px-0 align-self-center">
													<p class="text-muted size-12 mb-0">Overall</p>
													<p>1544</p>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-6 col-md-12">
									<div class="card shadow-sm mb-4">
										<div class="card-body">
											<div class="row">
												<div class="col-auto">
													<div class="avatar avatar-40 alert-danger text-danger rounded-circle">
														<i class="bi bi-arrow-up-right-circle"></i>
													</div>
												</div>
												<div class="col px-0 align-self-center">
													<p class="text-muted size-12 mb-0">Success</p>
													<p>1424</p>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-6 col-md-12">
									<div class="card shadow-sm mb-4">
										<div class="card-body">
											<div class="row">
												<div class="col-auto">
													<div class="avatar avatar-40 alert-primary text-primary rounded-circle">
														<i class="bi bi-arrow-down-left-circle"></i>
													</div>
												</div>
												<div class="col px-0 align-self-center">
													<p class="text-muted size-12 mb-0">On Revision</p>
													<p>1600</p>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-6 col-md-12">
									<div class="card shadow-sm mb-4">
										<div class="card-body">
											<div class="row">
												<div class="col-auto">
													<div class="avatar avatar-40 alert-warning text-warning rounded-circle">
														<i class="bi bi-arrow-up-right-circle"></i>
													</div>
												</div>
												<div class="col px-0 align-self-center">
													<p class="text-muted size-12 mb-0">Pending</p>
													<p>1254</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
                </div>
                <div class="tab-pane fade" id="currency" role="tabpanel" aria-labelledby="currency-tab">
                    
                </div>
            </div>

           <!-- chart js areachart-->
            

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
                    <div class="chartdoughnut mb-4">
                        <div class="datadisplay text-center shadow">
                            <h1 class="fw-normal">15.56k</h1>
                            <p class="text-muted">Expense</p>
                        </div>
                        <canvas id="doughnutchart"></canvas>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="circle-small">
                                        <div id="circleprogressfour"></div>
                                        <div class="avatar avatar-30 alert-warning text-warning rounded-circle">
                                            <i class="bi bi-basket"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto align-self-center ps-0">
                                    <p class="small mb-1 text-muted">Grocery</p>
                                    <p>55<span class="small">%</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="smallchart">
                            <canvas id="smallchart4"></canvas>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="circle-small">
                                        <div id="circleprogressthree"></div>
                                        <div class="avatar avatar-30 alert-danger text-danger rounded-circle">
                                            <i class="bi bi-house"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto align-self-center ps-0">
                                    <p class="small mb-1 text-muted">Rent</p>
                                    <p>10<span class="small">%</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="smallchart">
                            <canvas id="smallchart3"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="circle-small">
                                        <div id="circleprogresstwo"></div>
                                        <div class="avatar avatar-30 alert-success text-success rounded-circle">
                                            <i class="bi bi-truck"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto align-self-center ps-0">
                                    <p class="small mb-1 text-muted">Travel</p>
                                    <p>25<span class="small">%</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="smallchart">
                            <canvas id="smallchart2"></canvas>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="circle-small">
                                        <div id="circleprogressone"></div>
                                        <div class="avatar avatar-30 alert-primary text-primary rounded-circle">
                                            <i class="bi bi-gear"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto align-self-center ps-0">
                                    <p class="small mb-1 text-muted">Other</p>
                                    <p>10<span class="small">%</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="smallchart">
                            <canvas id="smallchart1"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- News and Updates -->
            <div class="row mb-3">
                <div class="col">
                    <h6 class="title">News and Updates</h6>
                </div>
                <div class="col-auto align-self-center">
                    <a href="blog.html" class="small">Read more</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <a href="blog-details.html" class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="avatar avatar-60 shadow-sm rounded-10 coverimg">
                                        <img src="assets/img/news.jpg" alt="">
                                    </div>
                                </div>
                                <div class="col align-self-center ps-0">
                                    <p class="text-color-theme mb-1">Do share and Earn a lot</p>                                   
                                    <p class="text-muted size-12">Get $10 instant as reward while your friend or invited member join FiMobile</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-12 col-md-6 col-lg-4">
                    <a href="blog-details.html" class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="avatar avatar-60 shadow-sm rounded-10 coverimg">
                                        <img src="assets/img/news1.jpg" alt="">
                                    </div>
                                </div>
                                <div class="col align-self-center ps-0">
                                    <p class="text-color-theme mb-1">Walmart news latest picks</p>                                   
                                    <p class="text-muted size-12">Get $10 instant as reward while your friend or invited member join FiMobile</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-12 col-md-6 col-lg-4">
                    <a href="blog-details.html" class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="avatar avatar-60 shadow-sm rounded-10 coverimg">
                                        <img src="assets/img/news2.jpg" alt="">
                                    </div>
                                </div>
                                <div class="col align-self-center ps-0">
                                    <p class="text-color-theme mb-1">Do share and Help us</p>                                   
                                    <p class="text-muted size-12">Get $10 instant as reward while your friend or invited member join FiMobile</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
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
			labels: [<?php echo $data; ?>],
			datasets: [{
			  label: "Revenue",
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
				  maxTicksLimit: 30
				}
			  }],
			  yAxes: [{
				ticks: {
				  min: 0,
				  max: 10,
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