<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>e-Ambulance Location Map (Yellow)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
        #map { height: 90vh; width: 100%; border: 3px solid #FFD600; border-radius: 10px; }
        body { background: #fffbe6; color: #333; font-family: Arial, sans-serif; }
        .leaflet-marker-icon.yellow-marker {
            filter: hue-rotate(60deg) brightness(1.2) saturate(1.5);
        }
        .header { background: #FFD600; padding: 1rem; text-align: center; font-weight: bold; font-size: 1.3rem; border-radius: 0 0 10px 10px; margin-bottom: 1rem; }
    </style>
</head>
<body>
    
    <div id="map"></div>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
    // API Key (not required for Leaflet/OpenStreetMap, included as per request)
    const API_KEY = "IkJtFMZYiCJSKpJ5jhYq";
    // Get coordinates from URL (default to London if not provided)
    function getQueryParam(name) {
        const url = new URL(window.location.href);
        return url.searchParams.get(name);
    }
    const lat = parseFloat(getQueryParam('lat')) || 51.505;
    const lng = parseFloat(getQueryParam('lng')) || -0.09;
    const name = getQueryParam('name') || 'Ambulance User';
    const landmark = getQueryParam('landmark') || '';

    var map = L.map('map').setView([lat, lng], 15);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Custom yellow marker
    var yellowIcon = new L.Icon({
      iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-yellow.png',
      shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
      iconSize: [25, 41],
      iconAnchor: [12, 41],
      popupAnchor: [1, -34],
      shadowSize: [41, 41]
    });

    L.marker([lat, lng], {icon: yellowIcon, title: name, alt: name}).addTo(map)
        .bindPopup(`<b>${name}</b><br>${landmark ? 'Landmark: ' + landmark + '<br>' : ''}Lat: ${lat}, Lng: ${lng}`)
        .openPopup();
    </script>
</body>
</html>
