<?php

require_once '/var/www/html/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable('/var/www/html/varen/');
$dotenv->load();

$host=$_ENV['RDS_HOST'];
$usuario=$_ENV['RDS_USER'];
$contraseña=$_ENV['RDS_PASSWORD'];
$base=$_ENV['RDS_DATABASE'];

$conexion= new mysqli($host, $usuario, $contraseña, $base);

$tabla = $_GET["var3"];
$str = '2022-09-10 13:00';
$fnsh =  '2022-09-15 17:00';

if (isset($_GET["var1"]) && isset($_GET["var2"])) {

    $str = $_GET["var1"];
    $fnsh = $_GET["var2"];
}

$sql = mysqli_query($conexion, "SELECT latitud, longitud FROM $tabla WHERE envio >= '$str' AND envio <= '$fnsh' ");

$result = mysqli_fetch_all($sql, MYSQLI_ASSOC);

exit(json_encode($result));





?>