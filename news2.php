<?php
session_start();
include 'dbconnector.php';
date_default_timezone_set('Asia/Manila');
$logdate = date("Y-m-d");
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>Roadar v2.0 - News & Updates</title>

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

    <!-- swiper carousel css -->
    <link rel="stylesheet" href="assets/vendor/swiperjs-6.6.2/swiper-bundle.min.css">

    <!-- style css for this template -->
    <link href="assets/css/style.css" rel="stylesheet" id="style">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body class="body-scroll" data-page="blogs">

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

    <!-- Begin page -->
    <main class="h-100 has-header">

        <!-- Header -->
        <header class="header position-fixed">
            <div class="row">
                <div class="col-auto">
                    <button class="btn btn-light btn-44 back-btn" onclick="window.location.replace('main_officer.php');">
                        <i class="bi bi-arrow-left"></i>
                    </button>
                </div>
                <div class="col align-self-center text-center">
                    <h5>News & Updates</h5>
                </div>
               
            </div>
        </header>
        <!-- Header ends -->

        <!-- main page content -->
        <div class="main-container container">
            <!-- Blogs news pages -->
            <div class="row mb-3">
                <div class="col">
                    <h5 class="mb-1">Today </h5>
                    <p class="text-muted small"><?php echo $logdate; ?></p>
                </div>
            </div>

           
           


            <div class="row">
			<?php
				$sql2= "SELECT * FROM tbl_news order by post_date desc";
				$result2 = $conn->query($sql2);

				while ($row2 = $result2->fetch_assoc()) {
			?>
                <div class="col-12 col-md-6 mb-3">
                    <div class="row">
                        <div class="col-5">
                            <figure class="rounded-15 position-relative h-190 overflow-hidden shadow-sm">
                                <div class="coverimg h-100 w-100 position-absolute start-0 top-0">
                                    <img src="pictures/<?php echo $row2['picture']; ?>" alt="">
                                </div>
                            </figure>
                        </div>
                        <div class="col align-self-center">
							<p class="small text-muted"><?php echo $row2['post_date']; ?></p>
                            <a href="news_details.php?id=<?php echo $row2['c_no']; ?>" class="h5 d-block text-normal mb-2"><?php echo $row2['title']; ?></a>
                            <p class="small text-muted"><?php echo substr($row2['details'], 0, 120); ?></p>
                            <a href="news_details.php?id=<?php echo $row2['c_no']; ?>" class="text-normal small">Read More <i
                                    class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
				<?php } ?>
            </div>
        </div>
        <!-- main page content ends -->

    </main>
    <!-- Page ends-->


    <!-- Required jquery and libraries -->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/vendor/bootstrap-5/js/bootstrap.bundle.min.js"></script>

    <!-- cookie js -->
    <script src="assets/js/jquery.cookie.js"></script>

    <!-- Customized jquery file  -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/color-scheme.js"></script>

    <!-- Sparklines js  -->
    <script src="assets/vendor/sparklines/jquery.sparkline.min.js"></script>

    <!-- swiper js script -->
    <script src="assets/vendor/swiperjs-6.6.2/swiper-bundle.min.js"></script>

    <!-- page level custom script -->
    <script src="assets/js/app.js"></script>

</body>

</html>