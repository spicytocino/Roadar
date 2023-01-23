<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="PlacePicker.png">

    <title>Google Place Picker For Bootstrap Example</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/flatly/bootstrap.min.css">

    <!-- Custom styles for this template -->
    
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="PlacePicker.js"></script>
  </head>

  <body>
    <form class="form-signin">
</div>
</br>
      <label for="inputEmail" class="sr-only">Address</label>
      <input type="email" id="pickup_country" class="form-control" placeholder="Address"  autofocus>
    </form>
<script type="text/javascript">
    $(document).ready(function(){
    	$("#pickup_country").PlacePicker({
    		btnClass:"btn btn-xs btn-default",
    		key:"AIzaSyBib2oCqcxbztagAoozHJk2qMuRzlpKVrM",
    		center: {lat: 17.6868, lng: 83.2185},
    		success:function(data,address){
    			//data contains address elements and
    			//address conatins you searched text
    			//Your logic here
    			$("#pickup_country").val(data.formatted_address);
    		}
    	});
    });
</script>
<style>
.form-signin {
    width: 300px;
    
}
</style>

  </body>
</html>
