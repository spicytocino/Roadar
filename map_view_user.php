<?php
session_start();
	
include 'dbconnector.php';
//echo "</br>";echo "</br>";echo "</br>";echo "</br>";echo "</br>";echo "</br>";echo "</br>";
//"SELECT *, (DATE(NOW()) - INTERVAL 7 DAY) AS diff FROM tbl_incident_report WHERE report_date >= (DATE(NOW()) - INTERVAL 7 DAY) ORDER BY report_date DESC"
if (isset($_POST['advancesearch'])){
	if ($_POST['location'] == ""){
		if ($_POST['year'] == "All"){
			if ($_POST['severity'] == "All"){
				$sql = "SELECT * FROM tbl_incident_report ";
			}else{
				$sql = "SELECT * FROM tbl_incident_report where accident_severity = '" . $_POST['severity'] . "'";
			}
		}else{
			if ($_POST['severity'] == "All"){
				$sql = "SELECT * FROM tbl_incident_report where YEAR(report_date) = '" . $_POST['year'] . "'";
			}else{
				$sql = "SELECT * FROM tbl_incident_report where YEAR(report_date) = '" . $_POST['year'] . "' and accident_severity = '" . $_POST['severity'] . "'";;
			}
		}
	}else{
		if ($_POST['year'] == "All"){
			if ($_POST['severity'] == "All"){
				$sql = "SELECT * FROM tbl_incident_report where province like '%" . $_POST['location'] . "%' or city like '%" . $_POST['location'] . "%' or barangay like '%" . $_POST['location'] . "%'  or name_of_road1 like '%" . $_POST['location'] . "%'  or landmark1 like '%" . $_POST['location'] . "%'";
			}else{
				$sql = "SELECT * FROM tbl_incident_report where (province like '%" . $_POST['location'] . "%' or city like '%" . $_POST['location'] . "%' or barangay like '%" . $_POST['location'] . "%'  or name_of_road1 like '%" . $_POST['location'] . "%'  or landmark1 like '%" . $_POST['location'] . "%') and (accident_severity = '" . $_POST['severity'] . "'";
			}
		}else{
			if ($_POST['severity'] == "All"){
				$sql = "SELECT * FROM tbl_incident_report where province like '%" . $_POST['location'] . "%' or city like '%" . $_POST['location'] . "%' or barangay like '%" . $_POST['location'] . "%'  or name_of_road1 like '%" . $_POST['location'] . "%'  or landmark1 like '%" . $_POST['location'] . "%' and YEAR(report_date) = '" . $_POST['year'] . "'";
			}else{
				$sql = "SELECT * FROM tbl_incident_report where province like '%" . $_POST['location'] . "%' or city like '%" . $_POST['location'] . "%' or barangay like '%" . $_POST['location'] . "%'  or name_of_road1 like '%" . $_POST['location'] . "%'  or landmark1 like '%" . $_POST['location'] . "%' and YEAR(report_date) = '" . $_POST['year'] . "' and accident_severity = '" . $_POST['severity'] . "'";;
			}
		}
	}
	//echo $sql;
	$data = "";
	$result = $conn->query($sql);
	if($result->num_rows > 0){ 
		while($row = $result->fetch_assoc()){ 
			if ($data == ""){
				$data = '["'.$row['accident_severity'].'", '.$row['latitude'].', '.$row['longitude'].', "'. "marker.png" .'"]'; 
			}else{
				$data = $data . ", " . '["'.$row['accident_severity'].'", '.$row['latitude'].', '.$row['longitude'].', "'. "marker.png" .'"]'; 
			}
		} 
	}
	$data = rtrim($data, ",");	
}else{
	$data = "";
	$sql = "SELECT *, (DATE(NOW()) - INTERVAL 7 DAY) AS diff FROM tbl_incident_report WHERE report_date >= (DATE(NOW()) - INTERVAL 7 DAY) and report_status = 'Success' ORDER BY report_date DESC";
	$result = $conn->query($sql);
	if($result->num_rows > 0){ 
		while($row = $result->fetch_assoc()){ 
			if ($data == ""){
				$data = '["'.$row['accident_severity'].'", '.$row['latitude'].', '.$row['longitude'].', "'. "marker.png" .'"]'; 
			}else{
				$data = $data . ", " . '["'.$row['accident_severity'].'", '.$row['latitude'].', '.$row['longitude'].', "'. "marker.png" .'"]'; 
			}
		} 
	}
	$data = rtrim($data, ",");		
}
?>
<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	
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
	
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
	  
	  
	  .modal-title
	  {
	  
	  text-align:center;
	  
	  }
	  
	  #containme{  
    position:relative;
    margin:0 auto;
    clear:left;
    height:auto;
    
    text-align:center;/* Add This*/
	#loader{  
	width:300px;
    position:relative;
    margin:0 auto;
    clear:left;
    height:auto;
    
    text-align:center;/* Add This*/
}​
    </style>
  </head>
  <header class="header position-fixed">
            <div class="row">
                <div class="col-auto">
                    <a href="javascript:void(0)" target="_self" class="btn btn-light btn-44 menu-btn">
                        <i class="bi bi-list" style="color:black"></i>
                    </a>
                </div>
              
				<div style="background-color: white;width:200px">
                   <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#searchform" style="font-size:12px;font-weight:bold;width:170px">
				   Advance Search
				  </button>
				  </div>
                
                
            </div>
        </header>
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
                            <a class="nav-link " aria-current="page" href="cities.php">
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
                            <a class="nav-link active" href="map_view_user.php" tabindex="-1">
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
<body class="body-scroll" data-page="index" style="height:100%">

    <div id="map"></div>
<div class="modal fade" id="searchform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">Advance Search</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="RegisterForm" method="post" >
	  
        <div class="modal-body">
		  <div class="form-group">
		    <div class="form-group">
            <label style="font-weight:bold">Location</label>
			<input type="text" class="form-control" name="location" placeholder="Location">
			</div>
            <label style="font-weight:bold">Year</label>
			<select class="form-select" name="year" aria-label="Default select example">
				<option >All</option>
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
		<label style="font-weight:bold">Severity</label>
			<select class="form-select" name="severity" aria-label="Default select example">
				<option >All</option>
				<option >Fatal Accident</option>
				<option >Non-fatal Accident</option>
				<option >Damage to Property</option>
			</select>
		</div>
          <div class="modal-footer border-top-0 d-flex justify-content-center">
		<input type="submit" name="advancesearch" class="form_submit" id="submit" value="Apply Changes" />
          
        </div>
       </div>
      </form>
    </div>
  </div>
  </div>  
  <div class="modal fade" id="detailform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered-lg" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">View Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="RegisterForm" method="post" enctype="multipart/form-data">
	  
        <div class="modal-body">
          
		  <div class="form-group">
            <label style="font-weight:bold">Reported Date:</label>
            <label id="report_date"></label>
          </div>
		     <div class="form-group">
            <label style="font-weight:bold">Reported Time:</label>
            <label id="report_time"></label>
          </div>
		      <div class="form-group">
            <label style="font-weight:bold">Location:</label>
            <label id="report_location"></label>
          </div>
		  <iframe id="mymap" src="" class="h-190 w-100 rounded mb-3" allowfullscreen="" loading="lazy"></iframe>
		  <div class="row">
			<div class="col-sm">
			  <div class="form-group">
					<label style="font-weight:bold">Latitude:</label>
					<label id="latitude"></label>
				  </div>
			</div>
			<div class="col-sm">
			  <div class="form-group">
					<label style="font-weight:bold">Longitude:</label>
					<label id="longitude"></label>
				  </div>
			</div>
		  </div>
		   	<div class="row">
			<div class="col-sm">
			  <div class="form-group">
					<label style="font-weight:bold">Weather:</label>
					<label id="weather"></label>
				  </div>
			</div>
			<div class="col-sm">
			  <div class="form-group">
					<label style="font-weight:bold">Surface Condition:</label>
					<label id="surface"></label>
				  </div>
			</div>
		  </div>
		 <div class="row">
			<div class="col-sm">
			  <div class="form-group">
					<label style="font-weight:bold">Severity:</label>
					<label id="severity"></label>
				  </div>
			</div>
			<div class="col-sm">
			  <div class="form-group">
					<label style="font-weight:bold">Main Cause:</label>
					<label id="cause"></label>
				  </div>
			</div>
		  </div>
		  <div class="row">
			<div class="col-sm">
			  <div class="form-group">
					<label style="font-weight:bold">Collision Type:</label>
					<label id="collision"></label>
				  </div>
			</div>
			<div class="col-sm">
			  <div class="form-group">
					<label style="font-weight:bold">Vehicle Involved:</label>
					<label id="involved"></label>
				  </div>
			</div>
		  </div>
		   <div class="form-group">
					<label style="font-weight:bold">Description:</label>
					<label id="description"></label>
				  </div>
		
        </div>
      
		   <div class="form-group">
             
            <input type="hidden" class="form-control" id="c_no" name="c_no" >
            
          </div>
        
		
        
      </form>
    </div>
  </div>
  </div> 
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title"></h4>
</div>
<div class="modal-body">
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
    <script>
       function initMap() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap',
		disableDefaultUI: true
    };
                    
    /* Display a map on the web page */
    map = new google.maps.Map(document.getElementById("map"), mapOptions);
    map.setTilt(100);
        
    /* Multiple markers location, latitude, and longitude */
    var markers = [
        <?php 
			echo $data;
        ?>
	];
                        
    /* Info window content */
    var infoWindowContent = [
        <?php 
			
			$result2 = $conn->query($sql);
			if($result2->num_rows > 0){ 
            while($row = $result2->fetch_assoc()){ ?>
                ['<div class="info_content">' +
                '<h3><?php echo $row['accident_severity']; ?></h3>' +
                '<p><?php echo $row['name_of_road1']; ?></p>' + 
				'<p><button type="button" id="viewdetail" class="btn btn-info" data-toggle="modal" data-target="#detailform"  onclick= "myFunction()" data-id="<?php echo  $row['c_no'] ?>" style="font-size:12px;font-weight:bold">View Details</button></p>' + '</div>'],
        <?php } 
        } 
        ?>
    ];
        
     /* Add multiple markers to map */
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
     /* Place each marker on the map  */
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
			icon: markers[i][3],
            title: markers[i][0]
			
        });
        
         /* Add info window to marker   */
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

       /* Center the map to fit all markers on the screen */
        map.fitBounds(bounds);
    }

   /* Set zoom level */
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(12);
        google.maps.event.removeListener(boundsListener);
    });
}

/* Load initialize function */
google.maps.event.addDomListener(window, 'load', initMap);
function myFunction() {
	var btn_id = document.getElementById('viewdetail');
var data_id = btn_id.getAttribute('data-id'); // fruitCount = '12'
  showValue(data_id);
}
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBib2oCqcxbztagAoozHJk2qMuRzlpKVrM&callback=initMap">
    </script>

	<script>
	
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
			   document.getElementById("report_date").innerHTML  =  nameArr[1];
			   document.getElementById("report_time").innerHTML  =  nameArr[2];
			   document.getElementById("report_location").innerHTML  =  nameArr[10];
			   document.getElementById("latitude").innerHTML  =  nameArr[11];
			   document.getElementById("longitude").innerHTML  =  nameArr[12];
			   	document.getElementById("weather").innerHTML  =  nameArr[17];
			   document.getElementById("surface").innerHTML  =  nameArr[18];
			   	document.getElementById("severity").innerHTML  =  nameArr[3];
			   document.getElementById("cause").innerHTML  =  nameArr[5];
			   	document.getElementById("collision").innerHTML  =  nameArr[7];
			   document.getElementById("involved").innerHTML  =  nameArr[6];
			   document.getElementById("description").innerHTML  =  nameArr[8];
			  document.getElementById('mymap').src = 'https://www.google.com/maps/embed/v1/streetview?key=AIzaSyBib2oCqcxbztagAoozHJk2qMuRzlpKVrM&location=' + nameArr[11] + ',' + nameArr[12] + '&heading=210&pitch=10&fov=35';
			   
			   
			   
			  }
			};
			
			xmlhttp.open("GET", "query_incident_report.php?id=" + str, true);
			xmlhttp.send();
		  }
		}
	</script>
	

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
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
	
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
</body>

</html>