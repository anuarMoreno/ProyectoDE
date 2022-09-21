<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin=""/>

    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
    integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
    crossorigin=""></script>

    <link rel="stylesheet" href="estilos.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script
			  src="https://code.jquery.com/jquery-3.6.1.js"
			  integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
			  crossorigin="anonymous"></script>

    <title>Página Web DE</title>
    <style>
        table, th, td {
            border: 1px solid black;
        }
        #map { height: 800px; width: 1600px;}
        
    </style>


    <script type="text/javascript">
                var map = {};
                var lat1;
                var lon1;
                var lat;
                var lon;
                var marker = {};
                var ref = {};
                var line = {};
                var inimarker;
                var popup = L.popup();



                async function tiempoReal()
                {
                    const response = await fetch("consulta.php");
                    const data = await response.json()

                    document.getElementById("lat").innerHTML = data.latitud;
                    document.getElementById("lon").innerHTML = data.longitud;
                    document.getElementById("envio").innerHTML = data.envio;

                    lat=parseFloat(document.getElementById("lat").innerHTML);
                    lon=parseFloat(document.getElementById("lon").innerHTML);
                    ref = L.marker([lat, lon], {icon: myIcon});

                    if (marker != ref) {
                        map.removeLayer(marker);
                    };
                    
                    marker = L.marker([lat, lon], {icon: myIcon}).addTo(map);

                    line.addLatLng([lat, lon]);

                }
                setInterval(tiempoReal, 1000);
                


                setTimeout(inivalues, 1500);
                function inivalues()
                {   
                    lat1=lat;
                    lon1=lon;
                    map = L.map('map').setView([lat1, lon1], 17);
                        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '© OpenStreetMap'
                    }).addTo(map);
                    map.on('click', onMapClick);
                    inimarker = L.marker([lat1, lon1], {icon: myIcon0}).addTo(map);
                    line = L.polyline([], {color: 'blue'}).addTo(map);

                }

                function onMapClick(e) {
                    popup
                        .setLatLng(e.latlng)
                        .setContent("You clicked the map at " + e.latlng.toString())
                        .openOn(map);
                }
                

                </script>
</head>
<body>

  <div id="lienzo">
    <header >
      <h1 id= titulo >Cosulta GPS Sitema de Rastreo</h1>

    </header>
    <nav>
        <section id="miTabla">
            <table class="table" style="font-size:24px;">
                <h2>Ubicación en tiempo real</h2>
                <tr class="active">
                    <th>Fecha de envio</th>
                    <th>Latitud</th>
                    <th>Longitud</th>
                </tr>
                <tr>
                    <td id="envio"></td>
                    <td id="lat"></td>
                    <td id="lon"></td>
                </tr>
            </table>
            <p>. </p>
            <p><h3>¿Cuando estuvo el vehiculo en esta posicion?</h3></p>
            <p>Haga click en el lugar deseado del mapa o digite los datos.</p>
            <p>Lat:<input id=latsch class=input placeholder="Latitud">Lon:
            <input id=lonsch class=input placeholder="Longitud">
            </p>
            <button id=button3 type="button">Buscar</button> 
            <p><h3>¿Donde estuvo el vehiculo en la esta fecha?</h3></p>
            <p>desde <input id=calendar class=calendar placeholder="Seleccione fecha"> hasta 
            <input id=calendar2 class=calendar2 placeholder="Seleccione fecha"></p>
            <p>
            <button id=button1 type="button">Buscar</button> 
            <button id=button2 type="button">Limpiar mapa</button> 
            </p>

          </section>
          
          <aside>
          <div id="map"></div>
        
          
          

    <script>

            var defdate1;
            var defdate2;
            var gotlocations;
            var polyline2;
            var mark2 = L.marker([22, 22], {icon: myIcon});

                fecha = flatpickr('#calendar', {
                dateFormat: "Y-m-d H:i",
                maxDate: "today",
                enableTime: true,
                defaultDate: "2022-09-17 16:50",

                onChange: function (selectedDates) {
                    if (selectedDates.length === 1) {
                        defdate1 = flatpickr.formatDate(fecha.selectedDates[0], "Y-m-d H:i")
                        console.log(defdate1);
                        fecha2.set('minDate', fecha.selectedDates[0]);
                    }
                }
                });
                defdate1 = flatpickr.formatDate(fecha.selectedDates[0], "Y-m-d H:i");


                fecha2 = flatpickr('#calendar2', {
                dateFormat: "Y-m-d H:i",
                minDate: fecha.selectedDates[0],
                maxDate: "today",
                enableTime: true,
                defaultDate: "2022-09-17 17:00",

                onChange: function (selectedDates) {
                    if (selectedDates.length === 1) {
                        defdate2 = flatpickr.formatDate(fecha2.selectedDates[0], "Y-m-d H:i")
                        console.log(defdate2);
                    }
                }
                });
                defdate2 = flatpickr.formatDate(fecha2.selectedDates[0], "Y-m-d H:i");


                document.getElementById("button1").onclick = function(){

                    defdefdate1 = defdate1.toString();
                    defdefdate2 = defdate2.toString();

                    $.getJSON('consulta3.php', {var1: defdefdate1, var2: defdefdate2}, function (data, textStatus, jqXHR) {
                        console.log(data);
                        let latgot = data.map(a => a.latitud);
                        let longot = data.map(a => a.longitud);

                        latgot = latgot.map(e => parseFloat(e));
                        longot = longot.map(e => parseFloat(e));


                        var gotlocations = []
                        for (var i = 0; i < latgot.length; i++) {
                        gotlocations[i] = [latgot[i],longot[i]];
                        }
                        console.log(gotlocations);
                        polyline2 = L.polyline(gotlocations, {color: 'blue'}).addTo(map);
                    });

           
                };


                document.getElementById("button2").onclick = function(){

                    for(i in map._layers) {
                    if(map._layers[i]._path != undefined) {
                        try {
                            map.removeLayer(map._layers[i]);
                        }
                        catch(e) {
                            console.log("problem with " + e + map._layers[i]);
                        }
                    }
                }
                
                inimarker.remove();
                mark2.remove();
                mark2 = L.marker([lat, lon], {icon: myIcon0}).addTo(map);
                line = L.polyline([], {color: 'blue'}).addTo(map);


                }

                function onMapClick(e) {
                    popup
                        .setLatLng(e.latlng)
                        .setContent("You clicked the map at " + e.latlng.toString())
                        .openOn(map);
                        document.getElementById("latsch").value = e.latlng.lat;
                        document.getElementById("lonsch").value = e.latlng.lng;
                }

                document.getElementById("button3").onclick = function(){

                    sendlat2 = document.getElementById("latsch").value = document.getElementById("latsch").value
                    sendlon2 = document.getElementById("lonsch").value = document.getElementById("lonsch").value

                    sendlat2 = parseFloat(sendlat2);
                    sendlon2 = parseFloat(sendlon2);

                    if (sendlat2 != "" && !isNaN(sendlat2) && !isNaN(sendlon2)){

                        sendlat2 = +sendlat2.toFixed(4);
                        sendlon2 = +sendlon2.toFixed(4);
                        maxlat2 = sendlat2+0.0005;
                        minlat2 = sendlat2-0.0005;
                        maxlon2 = sendlon2+0.0005;
                        minlon2 = sendlon2-0.0005;

                        $.getJSON('consulta4.php', {var1: maxlat2, var2: minlat2, var3: maxlon2, var4: minlon2}, function (data, textStatus, jqXHR) {
                        let recdates = data.map(a => a.envio);
                        alert(recdates.join("\n"));

                        
                    });

                    }



                }





            var myIcon = L.icon({
                iconUrl: 'https://leafletjs.com/examples/custom-icons/leaf-green.png',
                shadowUrl: 'https://leafletjs.com/examples/custom-icons/leaf-shadow.png',
                iconSize:     [38, 95], // size of the icon
            shadowSize:   [50, 64], // size of the shadow
            iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62],  // the same for the shadow
            popupAnchor:  [-3, -76]

            });

            var myIcon0 = L.icon({
                iconUrl: 'https://leafletjs.com/examples/custom-icons/leaf-red.png',
                shadowUrl: 'https://leafletjs.com/examples/custom-icons/leaf-shadow.png',
                iconSize:     [38, 95], // size of the icon
            shadowSize:   [50, 64], // size of the shadow
            iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62],  // the same for the shadow
            popupAnchor:  [-3, -76]

    });


  </script>
  <p id="p1"></p>

</aside>

</nav>


</div>

<footer>
    <h3>Universidad del norte</h3>
    <h4>
        David A. Arrieta Ricardo,
        Jhonatan A. Chasoy Vasquez,
        Sebastian Duque Mantilla,
        Anuar D. Moreno Navarro
    </h4>
</footer>
</html>                    