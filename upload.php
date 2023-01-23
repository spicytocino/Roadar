<?php
session_start();
include 'dbconnector.php';
$output_dir = "uploads/";
date_default_timezone_set('Asia/Manila');
$sql = "SELECT * FROM tbl_locations where login_id= " .  $_SESSION['myuser_id']  ;

	$result = $conn->query($sql);
	$count = mysqli_num_rows($result);
	$row=$result->fetch_assoc();
	$location_id = $row['c_no'];
if(isset($_FILES["myfile"]))
{
	$ret = array();

	$error =$_FILES["myfile"]["error"];
	//You need to handle  both cases
	//If Any browser does not support serializing of multiple files using FormData() 
	if(!is_array($_FILES["myfile"]["name"])) //single file
	{
 	 	$filetype =  pathinfo($_FILES["myfile"]["name"])['extension'];
		$fileName = "adventurista-" . date("Ymdhis") . "." . $filetype;

 		move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$fileName);
		
		$description = "image";
		$picture = $fileName;
		$query = "INSERT INTO tbl_photos(location_id,description,picture) VALUES('$location_id','$description','$picture')";
				
				$res = mysqli_query($conn,$query);
						
				
    	$ret[]= $fileName;
	}
	else  //Multiple files, file[]
	{
	  $fileCount = count($_FILES["myfile"]["name"]);
	  for($i=0; $i < $fileCount; $i++)
	  {
	  	
		$filetype =  pathinfo($_FILES["myfile"]["name"][$i]['extension']);
		$fileName = "adventurista-" . date("Ymdhis") . "." . $filetype;
		move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$fileName);
		
		$description = "image";
		$picture = $fileName;
		$query = "INSERT INTO tbl_photos(location_id,description,picture) VALUES('$location_id','$description','$picture')";
				
				$res = mysqli_query($conn,$query);
	  	$ret[]= $fileName;
	  }
	
	}
    echo json_encode($ret);
 }
 
 ?>
 
 