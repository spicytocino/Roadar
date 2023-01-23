<?php
session_start();
require_once("perpage.php");	
include 'dbconnector.php';
$report_no = $_GET['id'];
if( isset($_POST['addform']) ) {
	$report_number= $_POST['report_no'];
	$vehicle_no= $_POST['vehicle_no'];
	$plate_no= $_POST['plate_no'];
	$chasis_no= $_POST['chasis_no'];
	$engine_no= $_POST['engine_no'];
	$insurance= $_POST['insurance'];
	$orcr= $_POST['orcr'];
	$model= $_POST['model'];
	$type = $_POST['vehicle_type'];
	$defect = $_POST['defect'];
	$damage= $_POST['damage'];

	$query = "INSERT INTO tbl_vehicle_details(report_no,vehicle_no,plate_no,chasis_no,engine_no,insurance,orcr,model,type,defect,damage) VALUES('$report_number','$vehicle_no','$plate_no','$chasis_no','$engine_no','$insurance','$orcr','$model','$type','$defect','$damage')";
	
	$res = mysqli_query($conn,$query);
		
	if ($res) {
		echo "<script>alert('Vehicle Added to Database');		</script>";
	} else {
		echo "<script>alert('Something went wrong, try again later...');</script>";
	}	

	}
$orderby = " ORDER BY c_no desc"; 
$sql = "SELECT * from tbl_vehicle_details where report_no = '" . $_GET['id'] . "' ";
$href = 'view_vehicle_details.php';					
	
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
    <title>Roadar v2.0 - Vehicle Details</title>

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
        <h5 class="modal-title" id="exampleModalLabel">Add Vehicle</h5>
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
            <label for="password1">Vehicle No.</label>
            <input type="text" class="form-control" id="vehicle_no" name="vehicle_no" required="" >
          </div>
          <div class="form-group">
            <label for="password1">Plate Number</label>
            <input type="text" class="form-control" id="plate_no" name="plate_no" required="" >
          </div>
		  <div class="form-group">
            <label for="password1">Chasis No.</label>
            <input type="text" class="form-control" id="chasis_no" name="chasis_no" required="" >
          </div>
		  <div class="form-group">
            <label for="password1">Engine Number</label>
            <input type="text" class="form-control" id="engine_no" name="engine_no" required="" >
          </div>
		  <div class="form-group">
            <label for="password1">Insurance</label>
            <input type="text" class="form-control" id="insurance" name="insurance" required="" >
          </div>
		  <div class="form-group">
            <label for="password1">OR / CR</label>
            <input type="text" class="form-control" id="orcr" name="orcr" required="" >
          </div>
		  <div class="form-group">
            <label for="password1">Model</label>
            <input type="text" class="form-control" id="model" name="model" required="" >
          </div>
		   <div class="form-group">
           <label for="schoolyear">Vehicle Type</label>
			<select class="form-control" id="vehicle_type" name="vehicle_type" required="">
			<option value="" disabled="disabled" selected >select type</option>
				<option>Bicycle</option>
				<option>Pedicab</option>
				<option>Motorcycle</option>
				<option>Tricycle</option>
				<option>Car</option>
				<option>Jeepney</option>
				<option>Bus</option>
				<option>Truck (Rigid)</option>
				<option>Truck (Artic)</option>
				<option>Van</option>
				<option>Animal</option>
				<option>Other</option>
			</select>
          </div>
		  <div class="form-group">
           <label for="schoolyear">Defect</label>
			<select class="form-control" id="defect" name="defect" required="">
			<option value="" disabled="disabled" selected >select defect</option>
				<option>Left Turn</option>
				<option>Right Turn</option>
				<option>U Turn</option> 
				<option>Cross Traffic</option>
				<option>Merging</option> 
				<option>Diverging</option> 
				<option>Overtaking</option> 
				<option>Going Ahead</option>
				<option>Reversing</option>
				<option>Sudden Start</option>
				<option>Sudden Stop</option>
				<option>Parked off Road</option>
				<option>Parked on Road</option>
				<option>Other</option>
			</select>
          </div>
		   <div class="form-group">
           <label for="schoolyear">Damage</label>
			<select class="form-control" id="damage" name="damage" required="">
			<option value="" disabled="disabled" selected >select damage</option>
				<option>Front</option>
				<option>Rear</option>
				<option>Right</option>
				<option>Left</option>
				<option>Multiple</option> 
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
            <input type="text" class="form-control" id="report_no2" name="report_no"  value="<?php echo $report_no; ?>" required="" readonly>
          </div>
		   <div class="form-group">
            <label for="password1">Vehicle No.</label>
            <input type="text" class="form-control" id="vehicle_no2" name="vehicle_no"  readonly>
          </div>
          <div class="form-group">
            <label for="password1">Plate Number</label>
            <input type="text" class="form-control" id="plate_no2" name="plate_no" readonly >
          </div>
		  <div class="form-group">
            <label for="password1">Chasis No.</label>
            <input type="text" class="form-control" id="chasis_no2" name="chasis_no"  readonly>
          </div>
		  <div class="form-group">
            <label for="password1">Engine Number</label>
            <input type="text" class="form-control" id="engine_no2" name="engine_no"  readonly>
          </div>
		  <div class="form-group">
            <label for="password1">Insurance</label>
            <input type="text" class="form-control" id="insurance2" name="insurance"  readonly>
          </div>
		  <div class="form-group">
            <label for="password1">OR / CR</label>
            <input type="text" class="form-control" id="orcr2" name="orcr"  readonly>
          </div>
		  <div class="form-group">
            <label for="password1">Model</label>
            <input type="text" class="form-control" id="model2" name="model" readonly>
          </div>
		  <div class="form-group">
            <label for="password1">Vehicle Type</label>
            <input type="text" class="form-control" id="vehicle_type2" name="vehicle_type"  readonly>
          </div>
		  <div class="form-group">
            <label for="password1">Defect</label>
            <input type="text" class="form-control" id="defect2" name="defect"  readonly>
          </div>
		  <div class="form-group">
            <label for="password1">Damage</label>
            <input type="text" class="form-control" id="damage2" name="damage"  readonly>
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
   Add New Vehicle
  </button>
  </br>  </br>
  </div>
		<form name="frmlogs" method="post" action="view_vehicle_details.php" >
            <div class="table-title">
               
            </div>
            <table class="table table-striped table-hover table-bordered" style="font-size:12px">
                <thead>
                    <tr>
                        <th>Car Model</th>
                        <th>Plate Number <i class="fa fa-sort"></i></th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
				<?php
					while ($row = $result->fetch_assoc()) {
					?>
                    <tr>
                        <td><?php echo $row['model']; ?></td>
                        <td><?php echo $row['plate_no']; ?></td>
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
				document.getElementById("vehicle_no2").value =  nameArr[1];
				document.getElementById("plate_no2").value =  nameArr[2];
				document.getElementById("chasis_no2").value =  nameArr[3];
				document.getElementById("engine_no2").value =  nameArr[4];
				document.getElementById("insurance2").value =  nameArr[5];
				document.getElementById("model2").value =  nameArr[6];
				document.getElementById("vehicle_type2").value =  nameArr[7];
				document.getElementById("defect2").value =  nameArr[8];
				document.getElementById("damage2").value =  nameArr[9];


			   
			   
			   
			  }
			};
			
			xmlhttp.open("GET", "query_vehicle_details.php?id=" + str, true);
			xmlhttp.send();
		  }
		}
	</script>
	<script type="text/javascript">
        $(document).ready( function() {
            $('.delete').click( function() {
                var id = $(this).attr("id");
				
                if(confirm("Are you sure you want to delete this vehicle?")){
                           window.location = "delete_vehicle_details.php?id=" + id + "&id2=<?php echo $_GET['id']; ?>";
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