<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map User Location </title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>

    <!-- Leaflet Routing Machine CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.12/leaflet-routing-machine.css" />

<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

    <!-- Leaflet Routing Machine JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.12/leaflet-routing-machine.js"></script>

     <style>
        #map {
  height: 350px;
  width: 100%;
  max-width: 800px; /* adjust the maximum width as needed */
}
     </style>
     
</head>
<body>


<h1>Map  User Location</h1>

<div id="map"></div>
    
</body>


<script>

var map = L.map('map');
map.setView([9.5292, 76.7436], 13);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

var routingControl = L.Routing.control({
  waypoints: [
    L.latLng(9.5292, 76.7436), // Amal Jyothi College of Engineering coordinates
  ],
  routeWhileDragging: true,
  show: false // Hide route by default
}).addTo(map);

navigator.geolocation.watchPosition(success, error);

let marker, circle , zoomed;

function success(pos) {

    const lat = pos.coords.latitude;
    const lng = pos.coords.longitude;   
    const accuracy = pos.coords.accuracy;

    if (marker) {
        map.removeLayer(marker);
        map.removeLayer(circle);
    }

    // Create a marker for the user's location  
    marker = L.marker([lat, lng]).addTo(map);
    circle = L.circle([lat, lng], {radius : accuracy }).addTo(map);

    if(!zoomed){
        zoomed = map.fitBounds(circle.getBounds());
    }

    map.setView([lat , lng]);

    // Update routing control waypoints
    routingControl.setWaypoints([
        L.latLng(lat, lng), // User's location coordinates
        L.latLng(9.5292, 76.7436) // Amal Jyothi College of Engineering coordinates
    ]);
}

function error(err){
    if(err.code === 1) {
        alert('Please enable your location service');
    } else{
        alert("Cannot get current location ");
    }
}

</script>
</html>
