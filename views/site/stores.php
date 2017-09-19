
<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;

$this->title = 'Магазины';
$this->params['breadcrumbs'][] = $this->title;
?>
        <div class="container"> <div id="map" style="width: 100%; height: 400px; float: left;"></div></div>

        <script>

            function initMap() {
                var mapCanvas = document.getElementById('map');
                var mapOptions = {
                    center: new google.maps.LatLng(50.410759, 30.634161),
                    zoom: 11,
                };
                var map = new google.maps.Map(mapCanvas, mapOptions);
                var markers = [],
                        myPlaces = [];
                //myPlaces.push(new Place('Киев', 50.453242, 30.525513, 'Столица Украины'));
                myPlaces.push(new Place('Київ, Анни Ахматової вул, 14-А', 50.410759, 30.634161, '9:00-21:00'));
                myPlaces.push(new Place('Київ, Мишуги Олександра вул, 6', 50.396004, 30.637264, '9:00-21:00'));
                myPlaces.push(new Place('Київ, Срібнокільська вул., 11', 50.398292, 30.619258, '9:00-21:00'));


                for (var i = 0, n = myPlaces.length; i < n; i++) {
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(myPlaces[i].latitude, myPlaces[i].longitude),
                        map: map,
                        title: myPlaces[i].name
                    });
                    var infowindow = new google.maps.InfoWindow({
                        content: '<p><b>' + myPlaces[i].name + '</b></p><br/>' + myPlaces[i].description
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
 