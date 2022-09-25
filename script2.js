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

        $.getJSON('consultas/consulta3.php', {var1: defdefdate1, var2: defdefdate2}, function (data, textStatus, jqXHR) {
            clearmap()
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

            $.getJSON('consultas/consulta4.php', {var1: maxlat2, var2: minlat2, var3: maxlon2, var4: minlon2}, function (data, textStatus, jqXHR) {
            let recdates = data.map(a => a.envio);
            alert(recdates.join("\n"));

            
        });

        }



    }

    
    $( "#button4" ).click(function() {
        $( "#overlay2" ).toggle();
    });

    $( "#button5" ).click(function() {
        $( "#overlay1" ).toggle();
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

