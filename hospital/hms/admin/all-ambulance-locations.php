<?php
session_start();
include('../include/config.php');
include('../include/checklogin.php');
check_login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>All Ambulance Locations</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
    <style>
        #map { width: 100%; height: 80vh; min-height: 400px; border-radius: 12px; }
    </style>
</head>
<body>
<div class="container" style="margin-top:30px;">
    <h2>All Ambulance Booking Locations</h2>
    <div id="map"></div>
    <a href="e-ambulance-bookings.php" class="btn btn-primary" style="margin-top:20px;">Back to Bookings</a>
</div>
<?php
// Fetch all bookings with location
$data = array();
$q = "SELECT ab.*, u.fullName FROM ambulance_bookings ab LEFT JOIN users u ON ab.user_id = u.id WHERE ab.latitude IS NOT NULL AND ab.longitude IS NOT NULL AND ab.latitude != '' AND ab.longitude != ''";
$res = mysqli_query($con, $q);
while($row = mysqli_fetch_assoc($res)) {
    $data[] = array(
        'name' => $row['fullName'],
        'address' => $row['address'],
        'phone' => $row['phone'],
        'lat' => $row['latitude'],
        'lng' => $row['longitude'],
        'day' => $row['day'],
        'created_at' => $row['created_at']
    );
}
?>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
<script>
const locations = <?php echo json_encode($data); ?>;
const defaultCenter = locations.length ? [parseFloat(locations[0].lat), parseFloat(locations[0].lng)] : [24.8607, 67.0011]; // Default Karachi
const map = L.map('map').setView(defaultCenter, 11);
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);
locations.forEach(loc => {
    if (!loc.lat || !loc.lng) return;
    const marker = L.marker([parseFloat(loc.lat), parseFloat(loc.lng)]).addTo(map);
    const info = `<b>${loc.name}</b><br>Phone: ${loc.phone}<br>Address: ${loc.address}<br>Day: ${loc.day}<br>Booked: ${loc.created_at}`;
    marker.bindPopup(info);
});
</script>
</body>
</html> 