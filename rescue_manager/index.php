<?php


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


            document.getElementById("plot").addEventListener("click", function(){
                log.console(points);
                //addMarker(-34.397, 150.644);
                //for (i in points){
                //   list = points[0];
                //  addMarker(list[0]['lat'], points[i]['lon']);
                //   log.console(list[0]);
                //}
                //alert(flags);
            });



            function addMarker(lat, lon) {
                mCoordinate = new google.maps.LatLng(lat, lon);
                var mrker = new google.maps.Marker({
                    position:mCoordinate,
                    map: map
                });
            }
        }



    </script>

</head>
<body>
<form action="index.php?hello=true" method="POST"">
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


<table>
    <tr>
        <th>Party</th>
        <th>Description</th>
        <th>Type</th>
        <th>latitude</th>
        <th>Longitude</th>
        <th>Vessel</th>
    </tr>


<?php

if($_POST['party_id'] != ""){

    include 'php/pull.php';
    $result = pull('f', $_POST['party_id']);
    if ($result->num_rows > 0) {
        // output data of each row

        while($row = $result->fetch_assoc()) {
            echo '<tr>';
           echo  '<td>'. $row['party']. '</td>';
           echo  '<td>'. $row['description']. '</td>';
           echo  '<td>'. $row['type']. '</td>';
           echo  '<td>'. $row['lat']. '</td>';
           echo  '<td>'. $row['lon']. '</td>';
           echo  '<td>'. $row['vessel']. '</td>';
            echo '</tr>';


        echo '<script>';
       // echo 'log.console('.$row['lat'].', '.$row['lon'].');';
          echo 'addMarker('.$row['lat'].', '.$row['lon'].');';
                // list = points[];
                //  addMarker(list[0][\'lat\'], points[i][\'lon\']);
                 //log.console(points[0]); //};
            echo '  function addMarker(lat, lon) {
              mCoordinate = new google.maps.LatLng(lat, lon);
              var mrker = new google.maps.Marker({
                  position:mCoordinate,
                  map: map
              });
          }';
        echo '</script>';
        //echo json_encode($result,array_diff_assoc());
             }
    }


?>

    <?php
function runMyFunction()
{
    include 'php/pullpaths.php';
   $result2 = run();



            while ($row2 = $result2->fetch_assoc()) {

                echo '<script type="text/javascript">';
                echo 'addMarker('.$row2['lat'].', '.$row2['lon'].');';
                echo '  function addMarker(lat, lon, labels) {
              mCoordinate = map.LatLng(lat, lon);
              var mrker = map.maps.Marker({
                  position:mCoordinate,
                  map: map
              });
          }';
                echo '</script>';
                //echo 'var flightPlanCoordinates = [';
                //'{lat:' . $row2['lat'] . ', lng:' . $row2['lon'] . '},';
            }
          //  echo '];   map.drawPolyline({
            //      path: flightPlanCoordinates,
           //       strokeColor: \'#FF0000\',
           //       strokeOpacity: 0.6,
           //       strokeWeight: 6
           //   });

            //  flightPath.setMap(map);';






}


            //echo json_encode($result,array_diff_assoc());

    if (isset($_GET['hello'])) {
        runMyFunction();
    }


}

?>
    <script type="text/javascript">

    </script>

</table>

</body>
</html>