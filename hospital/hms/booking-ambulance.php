<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>e-Ambulance</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
</head>
<body>
<div id="app">
<?php include('include/sidebar.php'); ?>
    <div class="app-content">
        <?php include('include/header.php'); ?>
        <div class="main-content">
            <div class="wrap-content container" id="container">
                <section id="e-ambulance">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2 class="mainTitle">E-Ambulance</h2>
                            <form id="ambulanceForm" method="post" action="">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" required>
                                </div>
                                <div class="form-group">
                                    <label for="address">Famous Landmark</label>
                                    <input type="text" class="form-control" id="address" name="address" required>
                                </div>
                                <div class="form-group">
                                    <label for="day">Day</label>
                                    <input type="date" class="form-control" id="day" name="day" required>
                                </div>
                                <div class="form-group">
                                    <label for="latitude">Latitude</label>
                                    <input type="text" class="form-control" id="latitude" name="latitude" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="longitude">Longitude</label>
                                    <input type="text" class="form-control" id="longitude" name="longitude" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="type">Ambulance Type</label>
                                    <select class="form-control" id="type" name="type" required onchange="updateFees()">
                                        <option value="">Select Type</option>
                                        <option value="Road Basic">Road Ambulance (Basic Life Support)</option>
                                        <option value="Road Advanced">Road Ambulance (Advanced Life Support)</option>
                                        <option value="Air Helicopter">Air Ambulance (Helicopter)</option>
                                        <option value="Air Charter">Air Ambulance (Charter Plane)</option>
                                        <option value="ICU">ICU Ambulance</option>
                                        <option value="Neonatal">Neonatal Ambulance</option>
                                        <option value="Mortuary">Mortuary Ambulance</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label><input type="checkbox" id="with_doctor" name="with_doctor" value="1" onchange="updateFees()"> With Doctor</label>
                                    <label style="margin-left:15px;"><input type="checkbox" id="with_paramedic" name="with_paramedic" value="1" onchange="updateFees()"> With Paramedic</label>
                                </div>
                                <div class="form-group">
                                    <label><input type="checkbox" id="oxygen" name="oxygen" value="1" onchange="updateFees()"> Oxygen Support</label>
                                    <label style="margin-left:15px;"><input type="checkbox" id="ventilator" name="ventilator" value="1" onchange="updateFees()"> Ventilator Support</label>
                                </div>
                                <div class="form-group">
                                    <label for="fees">Fees (PKR)</label>
                                    <input type="text" class="form-control" id="fees" name="fees" readonly required>
                                </div>
                                <button type="button" class="btn btn-info" onclick="getLocation()">Get Coordinates</button>
                                <button type="submit" class="btn btn-primary">Book Ambulance</button>
                            </form>
                            <div id="locationStatus" style="margin-top:10px;"></div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <?php include('include/footer.php'); ?>
    <?php include('include/setting.php'); ?>
</div>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script>
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

function updateFees() {
    var type = document.getElementById('type').value;
    var withDoctor = document.getElementById('with_doctor').checked ? 1 : 0;
    var withParamedic = document.getElementById('with_paramedic').checked ? 1 : 0;
    var oxygen = document.getElementById('oxygen').checked ? 1 : 0;
    var ventilator = document.getElementById('ventilator').checked ? 1 : 0;
    var base = 0;
    switch(type) {
        case 'Road Basic': base = 2000; break;
        case 'Road Advanced': base = 4000; break;
        case 'Air Helicopter': base = 50000; break;
        case 'Air Charter': base = 80000; break;
        case 'ICU': base = 7000; break;
        case 'Neonatal': base = 6000; break;
        case 'Mortuary': base = 3000; break;
        default: base = 0;
    }
    if (withDoctor) base += 1500;
    if (withParamedic) base += 1000;
    if (oxygen) base += 500;
    if (ventilator) base += 2000;
    document.getElementById('fees').value = base;
}
document.getElementById('type').addEventListener('change', updateFees);
document.getElementById('with_doctor').addEventListener('change', updateFees);
document.getElementById('with_paramedic').addEventListener('change', updateFees);
document.getElementById('oxygen').addEventListener('change', updateFees);
document.getElementById('ventilator').addEventListener('change', updateFees);
</script>
<?php
// Ambulance booking form submission
if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['name'], $_POST['phone'], $_POST['address'], $_POST['latitude'], $_POST['longitude'], $_POST['day'], $_POST['type'], $_POST['fees'])
) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $latitude = mysqli_real_escape_string($con, $_POST['latitude']);
    $longitude = mysqli_real_escape_string($con, $_POST['longitude']);
    $day = mysqli_real_escape_string($con, $_POST['day']);
    $type = mysqli_real_escape_string($con, $_POST['type']);
    $with_doctor = isset($_POST['with_doctor']) ? 1 : 0;
    $with_paramedic = isset($_POST['with_paramedic']) ? 1 : 0;
    $oxygen = isset($_POST['oxygen']) ? 1 : 0;
    $ventilator = isset($_POST['ventilator']) ? 1 : 0;
    $fees = intval($_POST['fees']);
    $userid = $_SESSION['id'];
    $query = "INSERT INTO ambulance_bookings (user_id, name, phone, address, latitude, longitude, day, type, with_doctor, with_paramedic, oxygen, ventilator, fees, created_at) VALUES ('$userid', '$name', '$phone', '$address', '$latitude', '$longitude', '$day', '$type', '$with_doctor', '$with_paramedic', '$oxygen', '$ventilator', '$fees', NOW())";
    if (mysqli_query($con, $query)) {
        echo '<div id="ambulanceStatusCard" class="animated fadeInDown" style="position:fixed;top:30px;left:50%;transform:translateX(-50%);z-index:9999;min-width:320px;max-width:90vw;">'
            .'<div style="background:#e6fff0;border-radius:12px;padding:30px 30px 20px 30px;box-shadow:0 4px 24px rgba(0,200,100,0.15);text-align:center;">'
            .'<span style="color:#21b573;font-size:3em;display:inline-block;animation:bounce 1s;">'
            .'<i class="fa fa-check-circle"></i>'
            .'</span><br>'
            .'<span style="color:#21b573;font-size:1.5em;font-weight:600;">Ambulance On The Way</span>'
            .'</div>'
            .'</div>';
        echo '<style>@keyframes bounce{0%{transform:scale(0.7);}50%{transform:scale(1.2);}100%{transform:scale(1);}}</style>';
        echo '<script>document.getElementById("ambulanceForm").style.display = "none";setTimeout(function(){window.location.href = "booking-ambulance.php";},4000);</script>';
    } else {
        echo '<script>alert("Error booking ambulance. Please try again.");</script>';
    }
}
?>
</body>
</html>
