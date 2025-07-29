<?php
// ambulance-map-all.php
// Show all ambulance booking locations on a single map
require_once 'config.php'; // adjust path if needed
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) { die('Database error'); }
$sql = "SELECT name, landmark, latitude, longitude FROM ambulance_bookings WHERE latitude IS NOT NULL AND longitude IS NOT NULL";
$result = $conn->query($sql);
$locations = [];
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $locations[] = $row;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All e-Ambulance Locations</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #map { height: 90vh; width: 100%; border: 3px solid #FFD600; border-radius: 10px; }
        body { background: #fffbe6; color: #333; font-family: Arial, sans-serif; }
        .header { background: #FFD600; padding: 1rem; text-align: center; font-weight: bold; font-size: 1.3rem; border-radius: 0 0 10px 10px; margin-bottom: 1rem; }
        .btn-back { display: inline-block; margin: 1rem; padding: 0.5rem 1.2rem; background: #FFD600; color: #333; border: none; border-radius: 5px; font-weight: bold; text-decoration: none; }
        .btn-back:hover { background: #ffe066; }
    </style>
</head>
<body>
    <div class="header">All e-Ambulance User Locations</div>
    <a href="e-ambulance-bookings.php" class="btn-back">&larr; Back to Bookings</a>
    <div id="map"></div>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
    const locations = <?php echo json_encode($locations); ?>;
    var map = L.map('map').setView([25.0, 68.0], 5);
    L.tileLayer('https://api.maptiler.com/maps/satellite/{z}/{x}/{y}.jpg?key=IkJtFMZYiCJSKpJ5jhYq', {
        attribution: '&copy; <a href="https://www.maptiler.com/copyright/">MapTiler</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        tileSize: 256,
        maxZoom: 20
    }).addTo(map);
    var yellowIcon = new L.Icon({
      iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-yellow.png',
      shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
      iconSize: [25, 41],
      iconAnchor: [12, 41],
      popupAnchor: [1, -34],
      shadowSize: [41, 41]
    });
    locations.forEach(function(loc) {
        if(loc.latitude && loc.longitude) {
            L.marker([loc.latitude, loc.longitude], {icon: yellowIcon, title: loc.name, alt: loc.name})
                .addTo(map)
                .bindPopup(`<b>${loc.name}</b><br>${loc.landmark ? 'Landmark: ' + loc.landmark + '<br>' : ''}Lat: ${loc.latitude}, Lng: ${loc.longitude}`);
        }
    });
    </script>
</body>
</html>
