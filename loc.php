<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Google Maps Example</title>
    <style>
        /* Style the map container */
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
    <h1>My Google Map</h1>
    <!-- Create a div to hold the map. Give it an id for JavaScript to target. -->
    <div id="map"></div>

    <script>
        // Initialize the map
        function initMap() {
            // Define the map options (centered on New York City)
            var mapOptions = {
                center: { lat: 40.7128, lng: -74.0060 }, // New York City coordinates
                zoom: 10, // Adjust the zoom level as needed
            };

            // Create a new map in the specified div
            var map = new google.maps.Map(document.getElementById('map'), mapOptions);
        }
    </script>

    <!-- Load the Google Maps JavaScript API with your API key and callback function -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>
</body>
</html>
