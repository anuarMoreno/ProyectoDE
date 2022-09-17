<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
    integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
    crossorigin=""/>

    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin="">
    </script>

    <link rel="stylesheet" href="estilos.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
    </script>

    <title>Página Web DE</title>
    <style>
        table, th, td {
            border: 1px solid black;
        }
        #map { height: 300px; }
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
                

        setTimeout(inivalues, 1500);
        async function inivalues(){
            const response = await fetch("consulta.php");
            const data = await response.json()
            lat1=parseFloat(document.getElementById("lat").innerHTML);
            lon1=parseFloat(document.getElementById("lon").innerHTML);
            map = L.map('map').setView([lat1, lon1], 17);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
            }).addTo(map);
            L.marker([lat1, lon1], {icon: myIcon}).addTo(map);
            line = L.polyline([], {color: 'red'}).addTo(map);
        }
                

        async function tiempoReal(){
            const response = await fetch("consulta.php");
            const data = await response.json()
 
            document.getElementById("lat").innerHTML = data.latitud;
            document.getElementById("lon").innerHTML = data.longitud;
            document.getElementById("envio").innerHTML = data.envio;
 
            console.log(document.getElementById("miTabla").innerHTML);
            lat=parseFloat(document.getElementById("lat").innerHTML);
            lon=parseFloat(document.getElementById("lon").innerHTML);
            ref = L.marker([lat, lon], {icon: myIcon});
        }
        setInterval(tiempoReal, 1000);
        setTimeout(live, 2000);


        function live(){
                    
            if (marker != ref) {
             map.removeLayer(marker);
            };
     
            marker = L.marker([lat, lon], {icon: myIcon}).addTo(map);
            line.addLatLng([lat, lon]);
        }
        setInterval(live, 3000);

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
                    <th>Enviado modificado</th>
                    <th>Latitud prueba</th>
                    <th>Longitud ultima mod</th>
                </tr>
                <tr>
                    <td id="envio"></td>
                    <td id="lat"></td>
                    <td id="lon"></td>
                </tr>
            </table>
            </section>
            <aside>
                <h2>Cartografía para monitoreo</h2>
                <div id="map"></div>
                <script>
                    setTimeout(mapa, 2000);
    
                    function mapa(){ 
                    }
     
                    var myIcon = L.icon({
                    iconUrl: 'https://raw.githubusercontent.com/iconic/open-iconic/master/png/map-marker-8x.png',
                    iconSize: [32, 32],
                    iconAnchor: [16,32]
                    });

                    var polylinePoints = [
                    [11.016550, -74.849849],
                    [11.017007, -74.851782],
                    [11.017154, -74.853788],
                    [11.016949, -74.855703],
                    [11.016638, -74.858026]
                    ];

                    //var polyline = L.polyline(polylinePoints).addTo(map);
    
                </script>

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