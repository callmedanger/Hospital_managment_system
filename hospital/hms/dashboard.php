<?php
session_start();
//error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>User  | Dashboard</title>
		
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />


	</head>
	<body>
		<div id="app">		
<?php include('include/sidebar.php');?>
			<div class="app-content">
				
						<?php include('include/header.php');?>
						
				<!-- end: TOP NAVBAR -->
				<div class="main-content" >
					<div class="wrap-content container" id="container">
				   <!-- ...existing code... -->
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">User | Dashboard</h1>
																	</div>
								<ol class="breadcrumb">
									<li>
										<span>User</span>
									</li>
									<li class="active">
										<span>Dashboard</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
							<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-sm-4">
									<div class="panel panel-white no-radius text-center">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-smile-o fa-stack-1x fa-inverse"></i> </span>
											<h2 class="StepTitle">My Profile</h2>
											
											<p class="links cl-effect-1">
												<a href="edit-profile.php">
													Update Profile
												</a>
											</p>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="panel panel-white no-radius text-center">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-paperclip fa-stack-1x fa-inverse"></i> </span>
											<h2 class="StepTitle">My Appointments</h2>
										
											<p class="cl-effect-1">
												<a href="appointment-history.php">
													View Appointment History
												</a>
											</p>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="panel panel-white no-radius text-center">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-terminal fa-stack-1x fa-inverse"></i> </span>
											<h2 class="StepTitle"> Book My Appointment</h2>
											
											<p class="links cl-effect-1">
												<a href="book-appointment.php">
													Book Appointment
												</a>
											</p>
										</div>
									</div>
								</div>
								<!-- New Card: Online Care -->
								<div class="col-sm-4">
									<div class="panel panel-white no-radius text-center">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-stethoscope fa-stack-1x fa-inverse"></i> </span>
											<h2 class="StepTitle">Online Care</h2>
											<p class="links cl-effect-1">
												<a href="online-care.php">
													Chat Now
												</a>
											</p>
										</div>
									</div>
								</div>
								<!-- New Card: Booking Ambulance -->
								<div class="col-sm-4">
									<div class="panel panel-white no-radius text-center">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-ambulance fa-stack-1x fa-inverse"></i> </span>
											<h2 class="StepTitle">Book Ambulance</h2>
											<p class="links cl-effect-1">
												<a href="booking-ambulance.php">
													Book Now
												</a>
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
			
					
					
						
						
					
						<!-- end: SELECT BOXES -->
						
					</div>
				</div>
			</div>
			<!-- start: FOOTER -->
	<?php include('include/footer.php');?>
			<!-- end: FOOTER -->
		
			<!-- start: SETTINGS -->
	<?php include('include/setting.php');?>
			<>
			<!-- end: SETTINGS -->
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="vendor/autosize/autosize.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/form-elements.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->

		<script>
		// Geolocation function
		function getLocation() {
			var status = document.getElementById('locationStatus');
			if (navigator.geolocation) {
				status.innerHTML = 'Getting location...';
				navigator.geolocation.getCurrentPosition(function(position) {
					document.getElementById('latitude').value = position.coords.latitude;
					document.getElementById('longitude').value = position.coords.longitude;
					status.innerHTML = '<span style="color:green">Location fetched!</span>';
				}, function(error) {
					status.innerHTML = '<span style="color:red">Unable to fetch location.</span>';
				});
			} else {
				status.innerHTML = '<span style="color:red">Geolocation is not supported by this browser.</span>';
			}
		}
		</script>

		<?php
		// Ambulance booking form submission
		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['phone'], $_POST['address'], $_POST['latitude'], $_POST['longitude'])) {
			$name = mysqli_real_escape_string($con, $_POST['name']);
			$phone = mysqli_real_escape_string($con, $_POST['phone']);
			$address = mysqli_real_escape_string($con, $_POST['address']);
			$latitude = mysqli_real_escape_string($con, $_POST['latitude']);
			$longitude = mysqli_real_escape_string($con, $_POST['longitude']);
			$userid = $_SESSION['id'];
			$query = "INSERT INTO ambulance_bookings (user_id, name, phone, address, latitude, longitude, created_at) VALUES ('$userid', '$name', '$phone', '$address', '$latitude', '$longitude', NOW())";
			if (mysqli_query($con, $query)) {
				echo '<script>alert("Ambulance booked successfully!");</script>';
			} else {
				echo '<script>alert("Error booking ambulance. Please try again.");</script>';
			}
		}
		?>
	</body>
</html>
