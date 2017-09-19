<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="container" >  
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
    <div id="map" style="width: 500px; height: 400px; float: left;"></div>
    </div>

        <script>

            function initMap() {
                var mapCanvas = document.getElementById('map');
                var mapOptions = {
                    center: new google.maps.LatLng(50.424036, 30.698766),
                    zoom: 15,
                };
                var map = new google.maps.Map(mapCanvas, mapOptions);
                var markers = [],
                        myPlaces = [];
                //myPlaces.push(new Place('Киев', 50.453242, 30.525513, 'Столица Украины'));
                myPlaces.push(new Place('ТОВ "СУМАТРА-ЛТД"', 50.424036, 30.698766, 'вул. Бориспільська, 19 літера Б"'));


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
    

<div class="col-lg-6 col-md-6 col-sm-6">
    <p><strong>ТОВ "СУМАТРА-ЛТД"</strong></p>

    <p><strong>Центральний офіс:</strong></p>

    вул. Бориспільська, 19 літера Б", м. Київ, 02093, Україна
    <br>
    тел.: +38 (044) 206-2177



    <p><strong>ІНФОРМАЦІЙНА СЛУЖБА "КОСМО":</strong></p>

    телефон: 0 800 308 808*
    <br>
    *усі дзвінки зі стаціонарних телефонів на території України безкоштовні 
</div>
    </div>
</div>