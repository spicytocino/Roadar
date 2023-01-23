<?php
session_start();
include 'dbconnector.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>Roadar v2.0 - Cities</title>

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

    
    
</head>

<body class="body-scroll" data-page="index">
<div class="modal fade" id="contactform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">City Station and Hotline</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	    <div class="modal-body">
			<div id="mytable">
			</div>
		</div>
		
    </div>
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
         

            <!-- user emnu navigation -->
            <div class="row">
                <div class="col-12">
                    <ul class="nav nav-pills">
                       <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="cities.php">
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
                            <a class="nav-link" href="map_view_user.php" tabindex="-1">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-house-fill"></i></div>
                                <div class="col">Accident Map</div>
                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                            </a>
                        </li>
						
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php?logout" tabindex="-1">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-box-arrow-right"></i></div>
                                <div class="col">Back to Login</div>
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
        <header class="header position-fixed" style="width:100px">
            <div class="row">
                <div class="col-auto">
                    <a href="javascript:void(0)" target="_self" class="btn btn-light btn-44 menu-btn">
                        <i class="bi bi-list" style="color:black"></i>
                    </a>
                </div>
               

      
      </div>                
            </div>
        </header>
		
        <!-- Header ends -->



        <!-- main page content -->
       <div class="main-container container" >
	         <div class="title-content text-center mb-lg-5 mb-4">
			  <div class="mylogo">
                   <img src="assets/img/logo2.png" alt="" class="logo2">
                </div>
        <h6 class="sub-title">Area of Jurisdiction</h6>
        <h3 class="hny-title">Police Stations</h3>
		   <section class="w3l-team-main" >
  <div class="team py-5">
    <div class="container py-lg-4">
		<div class="row team-row">
			<div class="col-lg-3 col-6 team-wrap">
			  <div class="team-info text-center">
				<div class="column position-relative">
				  <a href="#" data-toggle="modal" data-target="#contactform"  data-id="Caloocan"><img src="myimages/caloocan.jpg" alt=""
					  class="img-fluid team-image" /></a>
				</div>
				<div class="column">
				  
				  <h3 class="name-pos"><a href="#url">Caloocan</a></h3>
				 

				</div>
			  </div>
			</div>
        <!-- end team member -->

			<div class="col-lg-3 col-6 team-wrap">

			  <div class="team-info text-center">
				<div class="column position-relative">
				  <a href="#"  data-toggle="modal" data-target="#contactform"  data-id="Laspinas"><img src="myimages/laspinas.jpg" alt=""
					  class="img-fluid team-image" /></a>
				</div>
				<div class="column">
				  
				  <h3 class="name-pos"><a href="#url">Las Piñas</a></h3>
				  
				</div>
			  </div>
			</div>
        <!-- end team member -->

			<div class="col-lg-3 col-6 team-wrap">
			  <div class="team-info text-center">
				<div class="column position-relative">
				 <a href="#"  data-toggle="modal" data-target="#contactform"  data-id="Makati"><img src="myimages/makati.jpg" alt=""
					  class="img-fluid team-image" /></a>
				</div>
				<div class="column">
				  
				  <h3 class="name-pos"><a href="#url">Makati</a></h3>
				  
				</div>
			  </div>

			</div>
        <!-- end team member -->
        <!-- end team member -->

			<div class="col-lg-3 col-6 team-wrap">
			  <div class="team-info text-center">
				<div class="column position-relative">
				  <a href="#"  data-toggle="modal" data-target="#contactform"  data-id="Malabon"><img src="myimages/malabon.jpg" alt=""
					  class="img-fluid team-image" /></a>
				</div>
				<div class="column">
				  
				  <h3 class="name-pos"><a href="#url">Malabon</a></h3>
				  
				</div>
			  </div>
			</div>
		</div>
		





		<div class="row team-row">
			<div class="col-lg-3 col-6 team-wrap">
			  <div class="team-info text-center">
				<div class="column position-relative">
				  <a href="#"  data-toggle="modal" data-target="#contactform"  data-id="Manila"><img src="myimages/manila.jpg" alt=""
					  class="img-fluid team-image" /></a>
				</div>
				<div class="column">
				  
				  <h3 class="name-pos"><a href="#url">Manila</a></h3>
				 

				</div>
			  </div>
			</div>
        <!-- end team member -->

			<div class="col-lg-3 col-6 team-wrap">

			  <div class="team-info text-center">
				<div class="column position-relative">
				   <a href="#"  data-toggle="modal" data-target="#contactform"  data-id="Marikina"><img src="myimages/marikina.jpg" alt=""
					  class="img-fluid team-image" /></a>
				</div>
				<div class="column">
				  
				  <h3 class="name-pos"><a href="#url">Marikina</a></h3>
				  
				</div>
			  </div>
			</div>
        <!-- end team member -->

			<div class="col-lg-3 col-6 team-wrap">
			  <div class="team-info text-center">
				<div class="column position-relative">
				  <a href="#"  data-toggle="modal" data-target="#contactform"  data-id="Muntinlupa"><img src="myimages/muntinlupa.jpg" alt=""
					  class="img-fluid team-image" /></a>
				</div>
				<div class="column">
				  
				  <h3 class="name-pos"><a href="#url">Muntinlupa</a></h3>
				  
				</div>
			  </div>

			</div>
        <!-- end team member -->
        <!-- end team member -->

			<div class="col-lg-3 col-6 team-wrap">
			  <div class="team-info text-center">
				<div class="column position-relative">
				   <a href="#"  data-toggle="modal" data-target="#contactform"  data-id="Navotas"><img src="myimages/navotas.jpg" alt=""
					  class="img-fluid team-image" /></a>
				</div>
				<div class="column">
				  
				  <h3 class="name-pos"><a href="#url">Navotas</a></h3>
				  
				</div>
			  </div>
			</div>
		</div>
		





		<div class="row team-row">
			<div class="col-lg-3 col-6 team-wrap">
			  <div class="team-info text-center">
				<div class="column position-relative">
				   <a href="#"  data-toggle="modal" data-target="#contactform"  data-id="Paranaque"><img src="myimages/paranaque.jpg" alt=""
					  class="img-fluid team-image" /></a>
				</div>
				<div class="column">
				  
				  <h3 class="name-pos"><a href="#url">Parañaque</a></h3>
				 

				</div>
			  </div>
			</div>
        <!-- end team member -->

			<div class="col-lg-3 col-6 team-wrap">

			  <div class="team-info text-center">
				<div class="column position-relative">
				   <a href="#"  data-toggle="modal" data-target="#contactform"  data-id="Pasay"><img src="myimages/pasay.jpg" alt=""
					  class="img-fluid team-image" /></a>
				</div>
				<div class="column">
				  
				  <h3 class="name-pos"><a href="#url">Pasay</a></h3>
				  
				</div>
			  </div>
			</div>
        <!-- end team member -->

			<div class="col-lg-3 col-6 team-wrap">
			  <div class="team-info text-center">
				<div class="column position-relative">
				  <a href="#"  data-toggle="modal" data-target="#contactform"  data-id="Pasig"><img src="myimages/pasig.jpg" alt=""
					  class="img-fluid team-image" /></a>
				</div>
				<div class="column">
				  
				  <h3 class="name-pos"><a href="#url">Pasig</a></h3>
				  
				</div>
			  </div>

			</div>
        <!-- end team member -->
        <!-- end team member -->

			<div class="col-lg-3 col-6 team-wrap">
			  <div class="team-info text-center">
				<div class="column position-relative">
				   <a href="#"  data-toggle="modal" data-target="#contactform"  data-id="Pateros"><img src="myimages/pateros.jpg" alt=""
					  class="img-fluid team-image" /></a>
				</div>
				<div class="column">
				  
				  <h3 class="name-pos"><a href="#url">Pateros</a></h3>
				  
				</div>
			  </div>
			</div>
		</div>
		<div class="row team-row">
			<div class="col-lg-3 col-6 team-wrap">
			  <div class="team-info text-center">
				<div class="column position-relative">
				   <a href="#"  data-toggle="modal" data-target="#contactform"  data-id="Quezon"><img src="myimages/qc.jpg" alt=""
					  class="img-fluid team-image" /></a>
				</div>
				<div class="column">
				  
				  <h3 class="name-pos"><a href="#url">Quezon City</a></h3>
				 

				</div>
			  </div>
			</div>
        <!-- end team member -->



			<div class="col-lg-3 col-6 team-wrap">

			  <div class="team-info text-center">
				<div class="column position-relative">
				  <a href="#"  data-toggle="modal" data-target="#contactform"  data-id="Sanjuan"><img src="myimages/sanjuan.jpg" alt=""
					  class="img-fluid team-image" /></a>
				</div>
				<div class="column">
				  
				  <h3 class="name-pos"><a href="#url">San Juan</a></h3>
				  
				</div>
			  </div>
			</div>
        <!-- end team member -->

			<div class="col-lg-3 col-6 team-wrap">
			  <div class="team-info text-center">
				<div class="column position-relative">
				   <a href="#"  data-toggle="modal" data-target="#contactform"  data-id="Taguig"><img src="myimages/taguig.jpg" alt=""
					  class="img-fluid team-image" /></a>
				</div>
				<div class="column">
				  
				  <h3 class="name-pos"><a href="#url">Taguig</a></h3>
				  
				</div>
			  </div>

			</div>
        <!-- end team member -->
        <!-- end team member -->

			<div class="col-lg-3 col-6 team-wrap">
			  <div class="team-info text-center">
				<div class="column position-relative">
				   <a href="#"  data-toggle="modal" data-target="#contactform"  data-id="Valenzuela"><img src="myimages/valenzuela.jpg" alt=""
					  class="img-fluid team-image" /></a>
				</div>
				<div class="column">
				  
				  <h3 class="name-pos"><a href="#url">Valenzuela</a></h3>
				  
				</div>
			  </div>
			</div>
		</div>
    </div>
  </div>
</section>
           


        </div>
        <!-- main page content ends -->


    </main>
    <!-- Page ends-->
	<script>
		// Set new default font family and font color to mimic Bootstrap's default styling
		
		Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
		Chart.defaults.global.defaultFontColor = '#292b2c';

		// Bar Chart Example
		var ctx = document.getElementById("myBarChart3");
		var myLineChart = new Chart(ctx, {
		  type: 'bar',
		  data: {
			labels: ['Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sept','Oct','Nov','Dec'],
			datasets: [{
			  label: "Revenue",
			  backgroundColor: "rgba(2,117,216,1)",
			  borderColor: "rgba(2,117,216,1)",
			  data: [<?php echo $total; ?>],
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
    labels: [ "Pending", "On Revision", "Success"],
    datasets: [{
      data: [1.19, 2.18, 96.81],
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
			   
			   document.getElementById("mytable").innerHTML  =  nameArr[0];
			 
			   
			   
			   
			  }
			};
			
			xmlhttp.open("GET", "query_contacts.php?id=" + str, true);
			xmlhttp.send();
		  }
		}
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
	
	function myFunction2(qq) {
        let confirmAction3 = confirm("Are you sure you want to approve this report?");
        if (confirmAction3) {
			
			zz =  "update_report2.php?id=" + qq ;
		
          window.location.href = zz;
		  
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