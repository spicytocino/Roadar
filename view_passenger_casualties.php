<?php
session_start();
require_once("perpage.php");	
include 'dbconnector.php';
$report_no = $_GET['id'];
if( isset($_POST['addform']) ) {
	$report_number= $_POST['report_no'];
	$passenger_name = $_POST['passenger_name'];
	$passenger_address = $_POST['passenger_address'];
	$passenger_vehicle_no = $_POST['passenger_vehicle_no'];
	$passenger_gender = $_POST['passenger_gender'];
	$passenger_age = $_POST['passenger_age'];
	$passenger_injury = $_POST['passenger_injury'];
	$passenger_position = $_POST['passenger_position'];
	$passenger_action = $_POST['passenger_action'];


	$query = "INSERT INTO tbl_passenger_casualties_details(report_no, passenger_name, passenger_address, passenger_vehicle_no, passenger_gender, passenger_age, passenger_injury, passenger_position, passenger_action) VALUES('$report_number','$passenger_name','$passenger_address','$passenger_vehicle_no','$passenger_gender','$passenger_age','$passenger_injury','$passenger_position','$passenger_action')";
	
	$res = mysqli_query($conn,$query);
		
	if ($res) {
		echo "<script>alert('Passenger Added to Database');		</script>";
	} else {
		echo "<script>alert('Something went wrong, try again later...');</script>";
	}	

	}

$orderby = " ORDER BY c_no desc"; 
$sql = "SELECT * from tbl_passenger_casualties_details where report_no = '" . $_GET['id'] . "' ";
$href = 'view_passenger_casualties.php';					
	
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
    <title>Roadar v2.0 - Passenger Casualties</title>

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
 
</head>

<body class="body-scroll" data-page="stats" style="font-size:12px">
<div class="modal fade" id="addform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">Add Passenger</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="RegisterForm" method="post">
	  
        <div class="modal-body">
		  <div class="form-group">
            <label for="password1">Report Number</label>
            <input type="text" class="form-control" id="report_no" name="report_no"  value="<?php echo $report_no; ?>" required="" readonly>
          </div>
		   <div class="form-group">
            <label for="password1">Passenger Name</label>
            <input type="text" class="form-control" id="passenger_name" name="passenger_name" required="" >
          </div>
          <div class="form-group">
            <label for="password1">Passenger Address</label>
            <input type="text" class="form-control" id="passenger_address" name="passenger_address" required="" >
          </div>
		  <div class="form-group">
            <label for="password1">Vehicle No.</label>
            <input type="text" class="form-control" id="passenger_vehicle_no" name="passenger_vehicle_no" required="" >
          </div>
		  <div class="form-group">
           <label for="schoolyear">Gender</label>
			<select class="form-control" id="passenger_gender" name="passenger_gender" required="">
			<option value="" disabled="disabled" selected >select gender</option>
				<option>Male</option>
				<option>Female</option>
			</select>
          </div>
		  <div class="form-group">
            <label for="password1">Age</label>
            <input type="number" class="form-control" id="passenger_age" name="passenger_age" required="" >
          </div>
		  <div class="form-group">
           <label for="schoolyear">Injury</label>
			<select class="form-control" id="passenger_injury" name="passenger_injury" required="">
			<option value="" disabled="disabled" selected >select injury</option>
				<option>Fatal</option>
				<option>Serious</option>
				<option>Minor</option>
				<option>Not Injured</option>
			</select>
          </div>
		  <div class="form-group">
           <label for="schoolyear">Position</label>
			<select class="form-control" id="passenger_position" name="passenger_position" required="">
			<option value="" disabled="disabled" selected >select position</option>
				<option>Front Seat</option>
				<option>Rear Seat</option>
				<option>M/C Passenger</option>
				<option>Bus Passenger</option>
				<option>Outside Sitting</option>
				<option>Outside Standing</option>
			</select>
          </div>
		   <div class="form-group">
           <label for="schoolyear">Action</label>
			<select class="form-control" id="passenger_action" name="passenger_action" required="">
			<option value="" disabled="disabled" selected >select action</option>
				<option>None</option>
				<option>Boarding</option> 
				<option>Alighting</option>
				<option>Falling</option>
				<option>Other</option>
			</select>
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
        <h5 class="modal-title" id="exampleModalLabel">View Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="RegisterForm" method="post">
	  
        <div class="modal-body">
			<div class="form-group">
				<label for="password1">Report Number</label>
				<input type="text" class="form-control" id="report_no2" name="report_no"  value="<?php echo $report_no; ?>"readonly >
			  </div>
			   <div class="form-group">
				<label for="password1">Passenger Name</label>
				<input type="text" class="form-control" id="passenger_name2" name="passenger_name"readonly >
			  </div>
			  <div class="form-group">
				<label for="password1">Passenger Address</label>
				<input type="text" class="form-control" id="passenger_address2" name="passenger_address"readonly >
			  </div>
			  <div class="form-group">
				<label for="password1">Vehicle No.</label>
				<input type="text" class="form-control" id="passenger_vehicle_no2" name="passenger_vehicle_no"readonly >
			  </div>
			  <div class="form-group">
				<label for="password1">Gender</label>
				<input type="text" class="form-control" id="passenger_gender2" name="passenger_gender"readonly >
			  </div>
			  <div class="form-group">
				<label for="password1">Age</label>
				<input type="text" class="form-control" id="passenger_age2" name="passenger_age"readonly >
			  </div>
			  <div class="form-group">
				<label for="password1">Injury</label>
				<input type="text" class="form-control" id="passenger_injury2" name="passenger_injury"readonly >
			  </div>
			  <div class="form-group">
				<label for="password1">Position</label>
				<input type="text" class="form-control" id="passenger_position2" name="passenger_position"readonly >
			  </div>
			  <div class="form-group">
				<label for="password1">Action</label>
				<input type="text" class="form-control" id="passenger_action2" name="passenger_action"readonly >
			  </div>  
     
          
		  <div class="form-group">
             
            <input type="hidden" class="form-control" id="c_no" name="c_no" readonly>
            
          </div>
        </div>
		
      </form>
    </div>
  </div>
  </div>   
 

		
    <div class="table-responsive">
  
        <div class="table-wrapper">
	<div style="text-align:left">
			<button type="button" class="btn btn-info" data-toggle="modal" data-target="#addform" style="font-size:12px;font-weight:bold">
   Add New Passenger
  </button>
  </br>  </br>
  </div>
		<form name="frmlogs" method="post" action="view_passenger_casualties.php" >
            <div class="table-title">
               
            </div>
            <table class="table table-striped table-hover table-bordered" style="font-size:12px">
                <thead>
                    <tr>
                        <th>Passenger Name</th>
                        <th>Passenger Injury <i class="fa fa-sort"></i></th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
				<?php
					while ($row = $result->fetch_assoc()) {
					?>
                    <tr>
                        <td><?php echo $row['passenger_name']; ?></td>
                        <td><?php echo $row['passenger_injury']; ?></td>
                        <td>
						
                            <a href="#" class="view" title="View" data-toggle="modal" data-target="#editform"  data-id="<?php echo $row['c_no']; ?>"><i class="material-icons">&#xE417;</i></a>
                            <a href="#" class="delete" title="Delete" id="<?php echo  $row['c_no']; ?>"><i class="material-icons">&#xE872;</i></a>
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
			

			return;
		  } else {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
			  if (this.readyState == 4 && this.status == 200) {
			   var nameArr = this.responseText.split('|');
			   
				document.getElementById("report_no2").value =  nameArr[0];
				document.getElementById("passenger_name2").value =  nameArr[1];
				document.getElementById("passenger_address2").value =  nameArr[2];
				document.getElementById("passenger_vehicle_no2").value =  nameArr[3];
				document.getElementById("passenger_gender2").value =  nameArr[4];
				document.getElementById("passenger_age2").value =  nameArr[5];
				document.getElementById("passenger_injury2").value =  nameArr[6];
				document.getElementById("passenger_position2").value =  nameArr[7];
				document.getElementById("passenger_action2").value =  nameArr[8];



			   
			   
			   
			  }
			};
			
			xmlhttp.open("GET", "query_passenger_casualties.php?id=" + str, true);
			xmlhttp.send();
		  }
		}
	</script>
	<script type="text/javascript">
        $(document).ready( function() {
            $('.delete').click( function() {
                var id = $(this).attr("id");
				
                if(confirm("Are you sure you want to delete this passenger?")){
                           window.location = "delete_passenger_casualties.php?id=" + id + "&id2=<?php echo $_GET['id']; ?>";
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