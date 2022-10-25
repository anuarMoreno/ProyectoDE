<!DOCTYPE html>

<head>
    <html lang="en" dir="ltr"></html>
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

    <script type="text/javascript" src="script3.js"></script>

    <title>Location Tracker</title>
</head>
<body>

  

  <div id="container">
    <header>
      <img class="logo" src="images/logo.png" width="60">
      <nav>
        <ul class="nav__links">
          <li><label>Consultando Vehículo n°2</label></li>
          <li><button id=button4 type="button">Posición actual</button></li>
          <li><button id=button5 type="button">Busqueda personalizada</button></li>
          <li><button id=button5 type="button"><a href="index.php">Ir a Carro 1</a></button></li>

        </ul>

      </nav>

      <a class="cta" href="https://www.uninorte.edu.co/" target="_blank"><img class="logo" src="images/uninorte.png" width="60"></a>

    </header>
    

    <div class="clearfix"></div>

    <div id="overlay2" hidden>
      <h3>Ultima Ubicación (Fecha/lat/lon):</h3>
    <ul class="nav__links">
      <li><a id="envio"></a></li>
      <li><a id="lat"></a></li>
      <li><a id="lon"></a></li>
    </ul>
    <p><button id=centerview type="button" onclick="map.setView([lat1, lon1], 16);">Centrar vista</button></p>
    </div>

    <div id="overlay1" hidden>
      <p><h4>Busqueda por Ubicación</h4></p>
      <p>Lat: <input id=latsch class=input placeholder="Latitud" readonly> Lon: 
        <input id=lonsch class=input placeholder="Longitud" readonly> Radio: <input id=radius class=input placeholder="Radio" onchange="" readonly></p>
        <button id=button3 type="button">Buscar</button> 
        <p><h4>Busqueda por Fecha</h4></p>
        <p>desde <input id=calendar class=calendar placeholder="Seleccione fecha"> hasta 
          <input id=calendar2 class=calendar2 placeholder="Seleccione fecha"></p>
          <p>
          <button id=button1 type="button">Buscar</button> 
          <button id=button2 type="button" onclick="clearmap()">Limpiar mapa</button> 
          </p>

    </div>

    <div id="map"></div>

    <footer>
      <div id="footnames">
      <h2>Universidad del norte</h2>
      <h3>
        David A. Arrieta Ricardo,
        Jhonatan A. Chasoy Vasquez,
        Sebastian Duque Mantilla,
        Anuar D. Moreno Navarro
      </h3>
    </div>
    </footer>


    <dialog id="noresults">
      <img class="logo" src="images/alert.png" width="100">
      <p><h2>No se encontraron resultados</h2></p>
      <p><button id="closealert">Aceptar</button></p>



    </dialog>

    <dialog id="restable">
      <p><h2>Fechas:</h2></p>
    <div id="table2"></div>
    <p><button id="closealert2">Aceptar</button></p>
  </dialog>
  </div>
        

  <script type="text/javascript" src="script4.js"></script>




</html>                    