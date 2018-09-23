<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Simple marker1s</title>
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

var marker1;

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
  setmarker1s(map);
}

var facilities = [
  ['Regent Park Community Centre', 43.6639563, -79.3796164, 4],
  ['John Innes Community Recreation Centre', 43.6543626, -79.3836505, 5],
  ['Toronto Harrison Pool Community center', 43.6597343, -79.4021410, 3],
  ['Parkdale Queen West Community Health Centre', 43.6442782, -79.4255369, 1],
  ['Scadding Court Community Centre', 43.6608772, -79.4175799, 4],
  ['Toronto Harrison Pool Community center', 43.6513591, -79.3935492, 3],
  ['Wellesley Community Centre', 43.6700481, -79.3920190, 2],
  ['Parkdale Queen West Community Health Centre', 43.6529738, -79.4155430, 1]
];


function setmarker1s(map) {
  var image = {
    url: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
  };


  var shape = {
    coords: [1, 1, 1, 20, 18, 20, 18, 1],
    type: 'poly'
  };



  for (var i = 0; i < facilities.length; i++) {
    var facility = facilities[i];
    marker1 = new google.maps.Marker({
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
