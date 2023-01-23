<?php
session_start();
require_once("perpage.php");	
include 'dbconnector.php';

if( isset($_POST['addform']) ) {
			$sql = "SHOW TABLE STATUS LIKE 'tbl_stations'";
			$result = $conn->query($sql);
			$count = mysqli_num_rows($result);
			$row=$result->fetch_assoc();
			$next_increment = $row['Auto_increment'];
			$station_id = "POL-0" . $next_increment;	


			
			$station_name = trim($_POST['station_name']);
			$station_name = strip_tags($station_name);
			$station_name = htmlspecialchars($station_name);
			
			$station_address = trim($_POST['station_address']);
			$station_address = strip_tags($station_address);
			$station_address = htmlspecialchars($station_address);
			
			$district_id = $_POST['district_id'];
			
	
			$sql = "SELECT * FROM tbl_stations where police_station_name = '" . $station_name . "'";
			$result = $conn->query($sql);
			$count = mysqli_num_rows($result);
			
			if ($count >= 1){
					echo "<script>alert('Police Station Already Exist!');		</script>";
			}else{
				$query = "INSERT INTO tbl_stations(police_station_id,police_station_name,address,district_id) VALUES('$station_id','$station_name','$station_address','$district_id')";
				$res = mysqli_query($conn,$query);
					
				if ($res) {
					echo "<script>alert('Station Added to Database');		</script>";
				} else {
					echo "<script>alert('Something went wrong, try again later...');</script>";
				}	
				
			}
	}else if( isset($_POST['editform']) ) {	
			$station_id = $_POST['station_id'];	
			
			$station_name = trim($_POST['station_name']);
			$station_name = strip_tags($station_name);
			$station_name = htmlspecialchars($station_name);
			
			$station_address = trim($_POST['station_address']);
			$station_address = strip_tags($station_address);
			$station_address = htmlspecialchars($station_address);
			
			$district_id = $_POST['district_id'];
			$update_id = $_POST['c_no'];
			$sql = "SELECT * FROM tbl_stations where police_station_name = '" . $station_name . "' where c_no <> " . $update_id ;
			$result = $conn->query($sql);
			$count = mysqli_num_rows($result);
			
			if ($count >= 1){
				echo "<script>alert('Police Station Already Exist!');		</script>";
				
			}else{
				$query = "update tbl_stations set police_station_name = '$station_name',address= '$station_address',district_id = '$district_id' where c_no ="  . $_POST['c_no'] ;
				$res = mysqli_query($conn,$query);
				if ($res) {
					echo "<script>alert('Police Station Updated');		</script>";
				} else {
					echo "<script>alert('Something went wrong, try again later...');</script>";
				}	
					
			}
			
	}	
$queryCondition = "";
if(!empty($_POST["go"])) {
	
	$queryCondition = " where police_station_name like '%" . $_POST['name'] . "%' ";
}
$orderby = " ORDER BY a.c_no desc"; 
$sql = "SELECT * ,a.c_no as station_id from tbl_stations as a left join tbl_district as b on a.district_id = b.c_no" . $queryCondition;
$href = 'manage_station.php';					
	
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
    <title>Roadar v2.0 - Manage Stations</title>

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
        <h5 class="modal-title" id="exampleModalLabel">Add Station</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="RegisterForm" method="post">
	  
        <div class="modal-body">
          
     
          <div class="form-group">
            <label for="password1">Station-ID</label>
            <input type="text" class="form-control" id="station_id" name="station_id"  placeholder="Auto generated" readonly>
          </div>
		   <div class="form-group">
            <label for="password1">Station Name</label>
            <input type="text" class="form-control" id="station_name" name="station_name" required="" >
          </div>
          <div class="form-group">
            <label for="password1">Address</label>
            <input type="text" class="form-control" id="station_address" name="station_address" required="" >
          </div>
		   <div class="form-group">
           <label for="schoolyear">District Name</label>
			<select class="form-control" id="district_id" name="district_id" required="">
			<option value="" disabled="disabled" selected >select district</option>
			<?php
				$sql2= "SELECT * FROM tbl_district";
				$result2 = $conn->query($sql2);
				
				while ($row2 = $result2->fetch_assoc()) {
					?>
						<option value="<?php echo $row2['c_no']; ?>"><?php echo $row2['district']; ?></option>
				
			 <?php } ?>
			 
			</select>
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
        <h5 class="modal-title" id="exampleModalLabel">Modify Station</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="RegisterForm" method="post">
	  
        <div class="modal-body">
          
     
          <div class="form-group">
            <label for="password1">Station-ID</label>
            <input type="text" class="form-control" id="station_id2" name="station_id"  placeholder="Not editable" readonly>
          </div>
		   <div class="form-group">
            <label for="password1">Station Name</label>
            <input type="text" class="form-control" id="station_name2" name="station_name" required="" >
          </div>
          <div class="form-group">
            <label for="password1">Address</label>
            <input type="text" class="form-control" id="station_address2" name="station_address" required="" >
          </div>
		   <div class="form-group">
           <label for="schoolyear">District Name</label>
			<select class="form-control" id="district_id" name="district_id" required="">
			<option value="" disabled="disabled" selected >select district</option>
			<?php
				$sql2= "SELECT * FROM tbl_district";
				$result2 = $conn->query($sql2);
				
				while ($row2 = $result2->fetch_assoc()) {
					?>
						<option value="<?php echo $row2['c_no']; ?>"><?php echo $row2['district']; ?></option>
				
			 <?php } ?>
			 
			</select>
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
                            <a class="nav-link" href="manage_officer.php" tabindex="-1">
                                <div class="avatar avatar-40 rounded icon"><i class="bi bi-shield-fill"></i></div>
                                <div class="col">Manage Officer</div>
                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" href="manage_station.php" tabindex="-1">
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
					<h1 class="titleheader"> Manage Stations </h1>
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
			<button type="button" class="btn btn-info" data-toggle="modal" data-target="#addform" style="font-size:12px;font-weight:bold">
   Add New Station
  </button>
  </br>  </br>
  </div>
		<form name="frmlogs" method="post" action="manage_station.php" >
            <div class="table-title">
                <div class="row">
                    <p><i class="material-icons">&#xE8B6;</i><input type="text" class="form-controls" name="name" placeholder="Search&hellip;" style="width:30%">
					<input type="submit" name="go" class="btn btn-default btn-sm w-20 shadow-sm" value="Search"style="width:10%" >
					<input type="reset" name="go" class="btn btn-default btn-sm w-20 shadow-sm" value="Reset" onclick="window.location='manage_station.php'" ></p>
                </div>
            </div>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Station ID</th>
                        <th>Police Station Name <i class="fa fa-sort"></i></th>
                        <th>Address</th>
                        <th>District <i class="fa fa-sort"></i></th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
				<?php
					while ($row = $result->fetch_assoc()) {
					?>
                    <tr>
                        <td><?php echo $row['police_station_id']; ?></td>
                        <td><?php echo $row['police_station_name']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['district']; ?></td>
                        <td>
                            <a href="view_station.php?id=<?php echo  $row['police_station_id'] ?>" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                            <a href="#" class="edit" title="Edit" data-toggle="modal" data-target="#editform"  data-id="<?php echo  $row['station_id'] ?>"><i class="material-icons">&#xE254;</i></a>
                            <a href="#" class="delete" title="Delete" id="<?php echo  $row['station_id'] ?>"><i class="material-icons">&#xE872;</i></a>
                        </td>
                    </tr>
                    <?php } ?>      
                </tbody>
            </table>
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
			   document.getElementById("station_id2").value =  nameArr[1];
			   document.getElementById("station_name2").value =  nameArr[2];
			   document.getElementById("station_address2").value =  nameArr[3];
			   document.getElementById("c_no").value =  nameArr[0];

			   
			   
			   
			  }
			};
			
			xmlhttp.open("GET", "query_station.php?id=" + str, true);
			xmlhttp.send();
		  }
		}
	</script>
	<script type="text/javascript">
        $(document).ready( function() {
            $('.delete').click( function() {
                var id = $(this).attr("id");
				
                if(confirm("Are you sure you want to delete this Station?")){
                           window.location = "delete_station.php?id=" + id ;
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