<!DOCTYPE html>
<html>
    <head>
        <title>Simple Map</title>
        <meta name="viewport" content="initial-scale=1.0">
        <meta charset="utf-8">
        <style>
            /* Always set the map height explicitly to define the size of the div
             * element that contains the map. */
            #map {
                width: 1000px;
                height: 400px;
                float: left;
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
        <div class="container"> <div id="map"></div></div>

        <script>

            function initMap() {
                var mapCanvas = document.getElementById('map');
                var mapOptions = {
                    center: new google.maps.LatLng(50.410759, 30.634161),
                    zoom: 15,
                };
                var map = new google.maps.Map(mapCanvas, mapOptions);
                var markers = [],
                        myPlaces = [];
                //myPlaces.push(new Place('Киев', 50.453242, 30.525513, 'Столица Украины'));
                myPlaces.push(new Place('TOOMAN', 50.442056, 30.517135, 'Адрес, контакты тумана'));
                myPlaces.push(new Place('Київ, Анни Ахматової вул, 14-А', 50.410759, 30.634161, '9:00-21:00'));


                for (var i = 0, n = myPlaces.length; i < n; i++) {
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(myPlaces[i].latitude, myPlaces[i].longitude),
                        map: map,
                        title: myPlaces[i].name
                    });
                    var infowindow = new google.maps.InfoWindow({
                        content: '<h4>' + myPlaces[i].name + '</h4><br/>' + myPlaces[i].description
                    });
                    makeInfoWindowEvent(map, infowindow, marker);
                    markers.push(marker);
                }
            }
            function makeInfoWindowEvent(map, infowindow, marker) {
                google.maps.event.addListener(marker, 'click', function () {
                    infowindow.open(map, marker);
                });
            }
            function Place(name, latitude, longitude, description) {
                this.name = name;  // название
                this.latitude = latitude;  // широта
                this.longitude = longitude;  // долгота
                this.description = description;  // описание места
            }

            google.maps.event.addDomListener(window, 'load', initialize);
        </script>

        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBY08Bb_Bz5c0xR-PdG_fd0R_bps9-KqdY&callback=initMap"
        type="text/javascript"></script>
    </body>
</html>