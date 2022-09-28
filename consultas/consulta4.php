<?php

require_once '/var/www/html/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable('/var/www/html/varen/');
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


if (isset($_GET["var1"]) && isset($_GET["var2"]) && isset($_GET["var3"])) {

    $sendlat2 = $_GET["var1"];
    $sendlon2 = $_GET["var2"];
    $radius = $_GET["var3"];


    

    $sql = mysqli_query($conn, "SELECT envio, ( 6371 * acos( cos( radians($sendlat2) ) * cos( radians( latitud ) ) 
    * cos( radians( longitud ) - radians($sendlon2) ) + sin( radians($sendlat2) ) * sin(radians(latitud)) ) ) AS distance 
    FROM registro_posicion
    HAVING distance < $radius");
    $result = mysqli_fetch_all($sql, MYSQLI_ASSOC);
    
    exit(json_encode($result));




}


?>