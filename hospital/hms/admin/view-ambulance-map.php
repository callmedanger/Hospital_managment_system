<?php
// view-ambulance-map.php
// Usage: view-ambulance-map.php?lat=...&lng=...&name=...
$lat = isset($_GET['lat']) ? floatval($_GET['lat']) : 0;
$lng = isset($_GET['lng']) ? floatval($_GET['lng']) : 0;
$name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : 'User Location';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>e-Ambulance User Location Map</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
    <style>
        #map { height: 90vh; width: 100%; margin: 0 auto; }
        body { margin:0; padding:0; }
    </style>
</head>
<body>
    <div id="map"></div>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
    <script>
        var lat = <?php echo json_encode($lat); ?>;
        var lng = <?php echo json_encode($lng); ?>;
        var name = <?php echo json_encode($name); ?>;
        var map = L.map('map').setView([lat, lng], 15);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        L.marker([lat, lng]).addTo(map)
            .bindPopup('<b>' + name + '</b><br>Ambulance Location').openPopup();
    </script>
</body>
</html>
