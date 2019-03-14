<?php
    include_once("php/conexion.php");
    session_start();

	include("php/bienvenida.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Montserrat:300,400,700"rel="stylesheet'>
  <style>
    /* Always set the map height explicitly to define the size of the div
     * element that contains the map. */
    #map {
      height: 100%;
    }
    /* Optional: Makes the sample page fill the window. */
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
    /* Popup container */
    .popup {
      position: relative;
      display: inline-block;
      cursor: pointer;
    }

    /* The actual popup (appears on top) */
    .popup .popuptext {
      visibility: hidden;
      width: 160px;
      background-color: #555;
      color: #fff;
      text-align: center;
      border-radius: 6px;
      padding: 8px 0;
      position: absolute;
      z-index: 1;
      bottom: 125%;
      left: 50%;
      margin-left: -80px;
    }

    /* Popup arrow */
    .popup .popuptext::after {
      content: "";
      position: absolute;
      top: 100%;
      left: 50%;
      margin-left: -5px;
      border-width: 5px;
      border-style: solid;
      border-color: #555 transparent transparent transparent;
    }

    /* Toggle this class when clicking on the popup container (hide and show the popup) */
    .popup .show {
      visibility: visible;
      -webkit-animation: fadeIn 1s;
      animation: fadeIn 1s
    }

    /* Add animation (fade in the popup) */
    @-webkit-keyframes fadeIn {
      from {opacity: 0;}
      to {opacity: 1;}
    }

    @keyframes fadeIn {
      from {opacity: 0;}
      to {opacity:1 ;}
    }
  </style>
</head>

<body style="min-height:300px">
 <h1><?php echo "Hola " . $nombre . ", eres un " . $rol; ?></h1>

    <a href="./home.php?salir">Salir</a>
    <div id="map"></div>
    <div class="popup" onclick="myFunction()">Click me!
      <span class="popuptext" id="myPopup">Popup text...</span>
    </div>
    <script>

      // This example creates a simple polygon representing the Bermuda Triangle.

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 5,
          //GANDIA (38.9680° N, 0.1845° W)
          center: {lat: 24.886, lng: -70.268},
          mapTypeId: 'terrain'
        });

        // Define the LatLng coordinates for the polygon's path.
        var triangleCoords = [
          {lat: 25.774, lng: -80.190},
          {lat: 18.466, lng: -66.118},
          {lat: 32.321, lng: -64.757},
          {lat: 25.774, lng: -80.190}
        ];

        // Construct the polygon.
        var bermudaTriangle = new google.maps.Polygon({
          paths: triangleCoords,
          strokeColor: '#FF0000',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#FF0000',
          fillOpacity: 0.35
        });

        // OnClick Event
        google.maps.event.addListener(bermudaTriangle, 'click', function (event) {
          alert("Conet");
        });

        bermudaTriangle.setMap(map);
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcqlElzw-O8fCTHF0AX3KX6XpG0TNfrxY&callback=initMap">
    </script>
</body>

</html>
