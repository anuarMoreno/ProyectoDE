<?php
require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable('/var/www/varen/');
$dotenv->load();

$host=$_ENV['RDS_HOST'];
$usuario=$_ENV['RDS_USER'];
$contraseña=$_ENV['RDS_PASSWORD'];
$base=$_ENV['RDS_DATABASE'];

$conn = mysqli_connect('RDS_HOST', 'RDS_USER', 'RDS_PASSWORD', 'RDS_DATABASE');

$str = '2022-09-10 13:00';
$fnsh =  '2022-09-15 17:00';

if (isset($_GET["var1"]) && isset($_GET["var2"])) {

    $str = $_GET["var1"];
    $fnsh = $_GET["var2"];
}

$sql = mysqli_query($conn, "SELECT latitud, longitud FROM registro_posicion  WHERE envio >= '$str' AND envio <= '$fnsh' ");

$result = mysqli_fetch_all($sql, MYSQLI_ASSOC);

exit(json_encode($result));





?>