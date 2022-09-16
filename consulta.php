<?php

require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable('/var/www/varen/');
$dotenv->load();

$host=$_ENV['RDS_HOST'];
$usuario=$_ENV['RDS_USER'];
$contraseña=$_ENV['RDS_PASSWORD'];
$base=$_ENV['RDS_DATABASE'];



$conexion= new mysqli($host, $usuario, $contraseña, $base);
if ($conexion -> connect_errno)
{
        die("Fallo la conexion:(".$conexion -> mysqli_connect_errno().")".$conexion->
                mysqli_connect_error());
}

/////////////////////// CONSULTA A LA BASE DE DATOS ////////////////////////
$resPosicion=$conexion->query("SELECT * FROM registro_posicion  WHERE id = (SELECT max(id) FROM registro_posicion)");

while ($filaMensaje = $resPosicion->fetch_array(MYSQLI_BOTH))
{
    $data = array(
        "latitud" => $filaMensaje["latitud"],
        "longitud" => $filaMensaje["longitud"],
        "envio" => $filaMensaje["envio"]
    );

    echo json_encode($data);
  }

  ///TABLA DONDE SE DESPLIEGAN LOS REGISTROS //////////////////////////////
  /*echo '<table class="table" style="font-size:24px;">
                                  <h2>Ubicación en tiempo real</h2>
                                  <tr class="active">
                                          <th>Enviado</th>
                      <th>Latitud</th>
                      <th>Longitud</th>
  
                                  </tr>';
                                  <tr>
                                              <td>'.$filaMensaje['envio'].'</td>
                                               <td id="lat"> '.$filaMensaje['latitud'].' </td>
                                               <td id="lon"> '.$filaMensaje['longitud'].' </td>
  
  
                                               </tr>';
  */
  
  ?> 