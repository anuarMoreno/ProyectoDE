var defdate1;
var defdate2;
var gotlocations;
var polyline2;
var circle;
var selctlat;
var selctlon;
var mark2 = L.marker([22, 22], {icon: myIcon});

    fecha = flatpickr('#calendar', {
    dateFormat: "Y-m-d H:i",
    maxDate: "today",
    enableTime: true,
    defaultDate: "2022-09-17 16:50",

    onChange: function (selectedDates) {
        if (selectedDates.length === 1) {
            defdate1 = flatpickr.formatDate(fecha.selectedDates[0], "Y-m-d H:i")
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
        }
    }
    });
    defdate2 = flatpickr.formatDate(fecha2.selectedDates[0], "Y-m-d H:i");


    document.getElementById("button1").onclick = function(){

        defdefdate1 = defdate1.toString();
        defdefdate2 = defdate2.toString();

        $.getJSON('consultas/2consulta3.php', {var1: defdefdate1, var2: defdefdate2}, function (data, textStatus, jqXHR) {
            let latgot = data.map(a => a.latitud);
            let longot = data.map(a => a.longitud);

            latgot = latgot.map(e => parseFloat(e));
            longot = longot.map(e => parseFloat(e));


            var gotlocations = []
            for (var i = 0; i < latgot.length; i++) {
            gotlocations[i] = [latgot[i],longot[i]];
            }

            if (!gotlocations.length){
                document.getElementById("noresults").showModal();
                
            }
            else{
                clearmap()
                polyline2 = L.polyline(gotlocations, {color: 'rgba(0, 136, 169, 0.8)'}).addTo(map);
                map.setView(gotlocations[0], 15);
            }
        });


    };

    
    function clearmap(){

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
            .setContent("Seleccionaste la ubicación: " + e.latlng.toString() + '<br><button id=addcircle type="button" onclick="addcircle()">Agregar circulo</button>')
            .openOn(map);
            selctlat = e.latlng.lat;
            selctlon = e.latlng.lng;
    }

    function addcircle(){
        if (circle != undefined) {
            circle.remove();
        };
        document.getElementById("latsch").value = selctlat;
        document.getElementById("lonsch").value = selctlon;
        circle = L.circle([document.getElementById("latsch").value, document.getElementById("lonsch").value], {
            color: 'rgba(0, 136, 169, 0.8)',
            fillColor: 'rgba(0, 136, 169, 0.6)',
            fillOpacity: 0.5,
            radius: 120
        }).addTo(map);
        circle.bindPopup("Radio: " + '<input id=radiusc class=input placeholder="Radio en metros">' + '<br><button id=setradiusb type="button" onclick="setradius()">Cambiar</button>');
        document.getElementById("radius").value = 120;
        popup.close();

    }

    function setradius(){
        
        circle.setRadius(document.getElementById("radiusc").value);
        document.getElementById("radius").value = document.getElementById("radiusc").value;
        circle.closePopup()
    }

    document.getElementById("button3").onclick = function(){

        sendlat2 = document.getElementById("latsch").value;
        sendlon2 = document.getElementById("lonsch").value;

        sendlat2 = parseFloat(sendlat2);
        sendlon2 = parseFloat(sendlon2);

        if (sendlat2 != "" && !isNaN(sendlat2) && !isNaN(sendlon2)){

            sendlat2 = +sendlat2.toFixed(4);
            sendlon2 = +sendlon2.toFixed(4);
            radius= (document.getElementById("radius").value/1000);
            $.getJSON('consultas/2consulta4.php', {var1: sendlat2, var2: sendlon2, var3: radius}, function (data, textStatus, jqXHR) {
            let recdates = data.map(a => a.envio);
            if (!recdates.length){
                document.getElementById("noresults").showModal();

            }
            else{
                var table2 = "<table><tr>";
                recdates.forEach((value, i) => {
                    table2 += `<td>${value}</td>`;
                    var next = i + 1;
                    if (next%1==0 && next!=recdates.length) { table2 += "</tr><tr>"; }
                });
                table2 += "</tr></table>";
                document.getElementById("table2").innerHTML = table2;
                document.getElementById("restable").showModal();
            
            }
            
            
        });

        }


    }




    
    $( "#button4" ).click(function() {
        $( "#overlay2" ).toggle();
    });

    $( "#button5" ).click(function() {
        $( "#overlay1" ).toggle();
    });

    $( "#closealert" ).click(function() {
        document.getElementById("noresults").close();
    });

    $( "#closealert2" ).click(function() {
        document.getElementById("restable").close();
    });

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

