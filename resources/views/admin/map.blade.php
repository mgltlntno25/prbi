<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" type="image/x-icon" href="{{asset("/img/islaw.png")}}" />
  <title>Pinoy Road Biker Inc.</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>



</head>

<body>



    <div id="mapid" style="width: 100%; height: 100vh;"></div>
    <script>
        // navigator.geolocation.getCurrentPosition(function(location) {
        //     var latlng = new L.LatLng(location.coords.latitude, location.coords.longitude);
        //     // var mymap = L.map('mapid').setView(latlang, 13);
        //     var mymap = L.map('mapid').setView(latlng, 13)

        //     L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        //         maxZoom: 18,
        //         attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
        //             '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
        //             'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        //         id: 'mapbox.streets'
        //     }).addTo(mymap);

        //     L.marker([51.5, -0.09]).addTo(mymap)
        //         .bindPopup("<b>Hello world!</b><br />I am a popup.").openPopup();
        //     L.marker([51.9, -0.09]).addTo(mymap)
        //         .bindPopup("<b>Hello world!</b><br />I am a popup.").openPopup();
        //     L.marker([51.6, -0.09]).addTo(mymap)
        //         .bindPopup("<b>Hello world !</b><br />I am a popup.").openPopup();



        //     var popup = L.popup();

        //     function onMapClick(e) {
        //         popup
        //             .setLatLng(e.latlng)
        //             .setContent("You clicked the map at " + e.latlng.toString())
        //             .openOn(mymap);
        //     }

        //     mymap.on('click', onMapClick);
        //     var marker = L.marker(latlng).addTo(mymap);
        // });

        navigator.geolocation.getCurrentPosition(function(location) {
            var latlng = new L.LatLng(location.coords.latitude, location.coords.longitude);

            var mymap = L.map('mapid').setView(latlng, 13)
            L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://mapbox.com">Mapbox</a>',
                maxZoom: 18,
                id: 'mapbox.streets',
                accessToken: 'pk.eyJ1IjoiYmJyb29rMTU0IiwiYSI6ImNpcXN3dnJrdDAwMGNmd250bjhvZXpnbWsifQ.Nf9Zkfchos577IanoKMoYQ'
            }).addTo(mymap);
            L.marker([14.64, 120.99]).addTo(mymap)
                .bindPopup("USER1").openPopup();
            L.marker([14.60, 121.07]).addTo(mymap)
                .bindPopup("USER2").openPopup();
            L.marker([14.57, 120.99]).addTo(mymap)
                .bindPopup("USER3").openPopup();



            var popup = L.popup();

            function onMapClick(e) {
                popup
                    .setLatLng(e.latlng)
                    .setContent("You clicked the map at " + e.latlng.toString())
                    .openOn(mymap);
            }

            mymap.on('click', onMapClick);

            var marker = L.marker(latlng).addTo(mymap)
            .bindPopup("THIS IS YOU").openPopup();;
        });
    </script>



</body>

</html>