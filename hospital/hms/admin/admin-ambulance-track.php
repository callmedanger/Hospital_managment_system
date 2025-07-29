<?php
// admin-ambulance-track.php?booking_id=123
include '../include/config.php';
$booking_id = isset($_GET['booking_id']) ? intval($_GET['booking_id']) : 0;
if (!$booking_id) die('Booking ID required');
$res = mysqli_query($con, "SELECT ab.*, u.fullName FROM ambulance_bookings ab LEFT JOIN users u ON ab.user_id = u.id WHERE ab.id=$booking_id");
$booking = mysqli_fetch_assoc($res);
$hospitalLat = 24.8920057;
$hospitalLng = 66.9305198;
$userLat = $booking['latitude'];
$userLng = $booking['longitude'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Live Ambulance Tracking (Admin)</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>#map { height: 500px; width: 100%; }</style>
</head>
<body>
    <h2>Live Ambulance Tracking (Booking #<?php echo $booking_id; ?>)</h2>
    <div id="map"></div>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
    var hospitalLat = <?php echo $hospitalLat; ?>;
    var hospitalLng = <?php echo $hospitalLng; ?>;
    var userLat = <?php echo $userLat; ?>;
    var userLng = <?php echo $userLng; ?>;
    var map = L.map('map').setView([hospitalLat, hospitalLng], 12);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);
    // Hospital marker (red)
    var redIcon = L.icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
        shadowUrl: 'https://unpkg.com/leaflet@1.7.1/dist/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });
    L.marker([hospitalLat, hospitalLng], {icon: redIcon}).addTo(map).bindPopup('NEXA HEALTH');
    // User marker (blue)
    var blueIcon = L.icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-blue.png',
        shadowUrl: 'https://unpkg.com/leaflet@1.7.1/dist/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });
    L.marker([userLat, userLng], {icon: blueIcon}).addTo(map).bindPopup('Patient: <?php echo addslashes($booking['fullName']); ?>');
    // Polyline (optional)
    var routeLine = L.polyline([[hospitalLat, hospitalLng], [userLat, userLng]], {color: 'red', dashArray: '5, 10'}).addTo(map);
    // Ambulance marker (ambulance icon)
    var ambulanceIcon = L.icon({
        iconUrl: 'https://cdn-icons-png.flaticon.com/512/2967/2967350.png', // Example ambulance icon
        iconSize: [40, 40],
        iconAnchor: [20, 40],
        popupAnchor: [0, -40]
    });
    var ambulanceMarker = null;
    function fetchAmbulanceLocation() {
        fetch('../get_ambulance_location.php?booking_id=<?php echo $booking_id; ?>')
        .then(res => res.json())
        .then(data => {
            if (data.lat && data.lng) {
                var pos = [parseFloat(data.lat), parseFloat(data.lng)];
                if (ambulanceMarker) {
                    ambulanceMarker.setLatLng(pos);
                } else {
                    ambulanceMarker = L.marker(pos, {icon: ambulanceIcon}).addTo(map).bindPopup('Ambulance');
                }
            }
        });
    }
    setInterval(fetchAmbulanceLocation, 5000);
    fetchAmbulanceLocation();
    </script>
</body>
</html> 