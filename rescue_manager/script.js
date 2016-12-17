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



          function addMarker(lat, lon, map) {
              mCoordinate = new google.maps.LatLng(lat, lon);
              var mrker = new google.maps.Marker({
                  position:mCoordinate,
                  map: map,

              });
          }




      }



