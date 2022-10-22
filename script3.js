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
    const response = await fetch("consultas/2consulta.php");
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

