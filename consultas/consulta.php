<?php

require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable('varen/');
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


  ?>