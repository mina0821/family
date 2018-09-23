<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Simple Markers</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
          min-width: 300px;
          width: 50%;
          min-height: 300px;
          height: 80%;
          margin-top: 100px;
          margin-left: 300px;
          border: 1px solid blue;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div> <a href="index.php"><button type="button">Home Page</button></a> </div>
    <div id="map"></div>
    <script>

var marker;

function initMap() {
  var myLatLng = {lat: 43.6595764, lng: -79.3912134}
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 13,
    center: myLatLng
  });

  var location = new google.maps.Marker({
    map: map,
    draggable: false,
    animation: google.maps.Animation.DROP,
    position: myLatLng //get from the user dataset
  });
  setMarkers(map);
}

var facilities = [
  ['Scadding Court Community Centre', 43.6608772, -79.4175799, 4],
  ['Cecil Community Centre', 43.6628092, -79.4038582, 5],
  ['Toronto Harrison Pool Community center', 43.6597343, -79.4021402, 3],
  ['Wellesley Community Centre', 43.6700487, -79.3920198, 2],
  ['Parkdale Queen West Community Health Centre', 43.6442782, -79.4255369, 1]
];
function setMarkers(map) {
  var image = {
    url: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
    size: new google.maps.Size(20, 32),
    origin: new google.maps.Point(0, 0),
    anchor: new google.maps.Point(0, 32)
  };
  var shape = {
    coords: [1, 1, 1, 20, 18, 20, 18, 1],
    type: 'poly'
  };
  for (var i = 0; i < facilities.length; i++) {
    var facility = facilities[i];
    marker = new google.maps.Marker({
      position: {lat: facility[1], lng: facility[2]},
      map: map,
      draggable: false,
      icon: image,
      shape: shape,
      title: facility[0],
      zIndex: facility[3],
      animation: google.maps.Animation.DROP
    });
  }


  
}
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDbkK_HexfOTi3ltESbPLpFyDqe2sd32jI&callback=initMap">
    </script>
  </body>
</html>
