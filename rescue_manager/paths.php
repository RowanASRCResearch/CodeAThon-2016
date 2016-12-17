<?php
include 'php/functions.php';
$dbncx = db_connect_sel();
include 'php/pullpaths.php';
$result2 = run();



while ($row = $result2->fetch_assoc()) {

    echo '<script type="text/javascript">';
    echo 'paths('.$row['lat'].', '.$row['lon'].');';
    echo '  function addMarker(lat, lon, labels) {
              mCoordinate = map.LatLng(lat, lon);
              var mrker = map.maps.Marker({
                  position:mCoordinate,
                  map: map
              });
          }';
    echo '</script>';
    echo 'var flightPlanCoordinates = {lat:' . $row['lat'] . ', lng:' . $row['lon'] . '},';

  echo 'paths(flightPlanCoordinates);';






}



?>

<!DOCTYPE html>
<html>
<head>
    <title>Rescue Manager</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <LINK REL=StyleSheet HREF="style.css" TYPE="text/css" >
    <!--<script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script-->
    <script type="text/javascript">
        var map;
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -34.397, lng: 150.644},
                zoom: 8
            });

            function paths(flightPlanCoordinates) {
                new google.maps.Polyline({
                    path: flightPlanCoordinates,
                    geodesic: true,
                    strokeColor: '#FF0000',
                    strokeOpacity: 1.0,
                    strokeWeight: 2
                }).setMap(map);
            }
            }


    </script>

</head>
<body>
<form action="." method="POST"">
<label>Search Party ID</label> <br>
<input type="text" name="party_id" id = "party_id" placeholder="INSERT SEARCH PARTY ID">
<input type="submit" value="LOOK UP!" onclick="refresh()">
<input type="button" value="Plot Points!" id="plot" name="plot"> </form>





<div id="map"></div>
<script>
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAF3SHmIIP4zCebX2eGl5YFD_Eevrh1mqA&callback=initMap"
        async defer></script>
<script src="script.js"></script>
<script src="jquery.js"></script>


</body>
</html>