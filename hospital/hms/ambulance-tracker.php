<?php
// ambulance-tracker.php?booking_id=123
$booking_id = isset($_GET['booking_id']) ? intval($_GET['booking_id']) : 0;
if (!$booking_id) { die('Booking ID required'); }
// Hospital default location
$hospitalLat = 24.8920057;
$hospitalLng = 66.9305198;
// Fetch user/booking details
include 'include/config.php';
$booking = null;
if ($booking_id) {
    $res = mysqli_query($con, "SELECT ab.*, u.fullName FROM ambulance_bookings ab LEFT JOIN users u ON ab.user_id = u.id WHERE ab.id=$booking_id");
    $booking = mysqli_fetch_assoc($res);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ambulance Live Tracker</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>#map { height: 400px; width: 100%; }</style>
</head>
<body>
    <h2>Ambulance Live Location Sharing (Booking #<?php echo $booking_id; ?>)</h2>
    <?php if($booking): ?>
    <div style="background:#f8f9fa;padding:10px 15px;margin-bottom:10px;border-radius:6px;max-width:500px;">
        <b>Patient Name:</b> <?php echo htmlentities($booking['fullName']); ?><br>
        <b>Phone:</b> <?php echo htmlentities($booking['phone']); ?><br>
        <b>Address:</b> <?php echo htmlentities($booking['address']); ?><br>
        <b>Type:</b> <?php echo htmlentities($booking['type']); ?><br>
        <b>Day:</b> <?php echo htmlentities($booking['day']); ?><br>
        <b>With Doctor:</b> <?php echo $booking['with_doctor'] ? 'Yes' : 'No'; ?><br>
        <b>With Paramedic:</b> <?php echo $booking['with_paramedic'] ? 'Yes' : 'No'; ?><br>
        <b>Oxygen:</b> <?php echo $booking['oxygen'] ? 'Yes' : 'No'; ?><br>
        <b>Ventilator:</b> <?php echo $booking['ventilator'] ? 'Yes' : 'No'; ?><br>
        <b>Fees:</b> <?php echo htmlentities($booking['fees']); ?> PKR<br>
    </div>
    <?php endif; ?>
    <div id="status">Waiting for location...</div>
    <a href="admin/admin-ambulance-track.php?booking_id=<?php echo $booking_id; ?>" target="_blank" class="btn btn-info" style="margin:10px 0;display:inline-block;">View Live Tracking (Admin)</a>
    <div id="map"></div>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
    var bookingId = <?php echo $booking_id; ?>;
    var hospitalLat = <?php echo $hospitalLat; ?>;
    var hospitalLng = <?php echo $hospitalLng; ?>;
    var userLat = <?php echo $booking ? $booking['latitude'] : 'null'; ?>;
    var userLng = <?php echo $booking ? $booking['longitude'] : 'null'; ?>;
    var patientName = <?php echo json_encode($booking ? $booking['fullName'] : 'Patient'); ?>;
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
    if(userLat && userLng) {
        L.marker([userLat, userLng], {icon: blueIcon}).addTo(map).bindPopup('Patient: ' + patientName);
        // Red polyline
        var routeLine = L.polyline([[hospitalLat, hospitalLng], [userLat, userLng]], {color: 'red', dashArray: '5, 10'}).addTo(map);
    }
    // Ambulance marker (ambulance icon)
    var ambulanceIcon = L.icon({
        iconUrl: 'https://cdn-icons-png.flaticon.com/512/2967/2967350.png',
        iconSize: [40, 40],
        iconAnchor: [20, 40],
        popupAnchor: [0, -40]
    });
    // DEMO: Smooth ambulance movement from hospital to user
    var ambulanceMarker = null;
    var userPos = (userLat && userLng) ? [parseFloat(userLat), parseFloat(userLng)] : null;
    var startPos = [hospitalLat, hospitalLng]; // Always start at hospital
    if (userPos) {
        // Draw red line
        var routeLine = L.polyline([startPos, userPos], {color: 'red', dashArray: '5, 10'}).addTo(map);
        // Place ambulance at hospital
        ambulanceMarker = L.marker(startPos, {icon: ambulanceIcon}).addTo(map).bindPopup('Ambulance');
        // Move along the line
        var t = 0; // 0=start, 1=end
        var moveInterval = setInterval(function() {
            t += 0.04; // step size (smaller = smoother/slower)
            if (t >= 1) {
                t = 1;
                clearInterval(moveInterval);
            }
            var lat = startPos[0] + (userPos[0] - startPos[0]) * t;
            var lng = startPos[1] + (userPos[1] - startPos[1]) * t;
            ambulanceMarker.setLatLng([lat, lng]);
        }, 4000);
    }
    // --- Helper function ---
    function randomPointNear(lat, lng, km) {
        var r = km / 111;
        var u = Math.random();
        var v = Math.random();
        var w = r * Math.sqrt(u);
        var t = 2 * Math.PI * v;
        var x = w * Math.cos(t);
        var y = w * Math.sin(t);
        return [lat + x, lng + y];
    }
    function fetchAmbulanceLocation() {
        fetch('get_ambulance_location.php?booking_id=' + bookingId)
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
    // Driver location update logic (keep as is, but do not show extra marker)
    function updateLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;
                fetch('update_ambulance_location.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        booking_id: bookingId,
                        lat: lat,
                        lng: lng
                    })
                })
                .then(res => res.json())
                .then(data => {
                    document.getElementById('status').innerText = 'Location sent: ' + lat + ', ' + lng;
                });
            });
        } else {
            document.getElementById('status').innerText = 'Geolocation not supported.';
        }
    }
    setInterval(updateLocation, 5000);
    updateLocation();
    </script>
</body>
</html> 