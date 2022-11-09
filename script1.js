var map = {};
var inilat;
var inilon;
var inilat2;
var inilon2;
var lat;
var lon;
var lat2;
var lon2;
var marker = {};
var marker2 = {};
var ref = {};
var ref2 = {};
var line = {};
var line2 = {};
var inimarker;
var inimarker2;
var popup = L.popup();



async function tiempoReal()
{
    const response = await fetch("consultas/consulta.php");
    const data = await response.json()

    document.getElementById("lat").innerHTML = data.latitud;
    document.getElementById("lon").innerHTML = data.longitud;
    document.getElementById("envio").innerHTML = data.envio;

    document.getElementById("lat2").innerHTML = data.latitud2;
    document.getElementById("lon2").innerHTML = data.longitud2;
    document.getElementById("envio2").innerHTML = data.envio2;

    lat=parseFloat(document.getElementById("lat").innerHTML);
    lon=parseFloat(document.getElementById("lon").innerHTML);

    lat2=parseFloat(document.getElementById("lat2").innerHTML);
    lon2=parseFloat(document.getElementById("lon2").innerHTML);

    ref = L.marker([lat, lon], {icon: myIcon});
    ref2 = L.marker([lat2, lon2], {icon: myIcon});

    if (marker != ref) {
        map.removeLayer(marker);
    };

    if (marker2 != ref2) {
        map.removeLayer(marker2);
    };
    
    marker = L.marker([lat, lon], {icon: myIcon}).addTo(map);
    marker2 = L.marker([lat2, lon2], {icon: myIcon}).addTo(map);

    line.addLatLng([lat, lon]);
    line2.addLatLng([lat2, lon2]);

}
setInterval(tiempoReal, 1000);



setTimeout(inivalues, 1500);
function inivalues()
{   
    inilat=lat;
    inilon=lon;
    inilat2=lat2;
    inilon2=lon2;

    map = L.map('map', {gestureHandling: true}).setView([inilat, inilon], 17);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);
    map.on('click', onMapClick);
    inimarker = L.marker([inilat, inilon], {icon: myIcon0}).addTo(map);
    inimarker2 = L.marker([inilat2, inilon2], {icon: myIcon0}).addTo(map);
    line = L.polyline([], {color: 'blue'}).addTo(map);
    line2 = L.polyline([], {color: 'red'}).addTo(map);

}

