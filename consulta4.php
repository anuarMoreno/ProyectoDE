<?php


<<<<<<< HEAD
=======
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
>>>>>>> develop

if (isset($_GET["var1"]) && isset($_GET["var2"]) && isset($_GET["var3"]) && isset($_GET["var4"])) {

    $maxlat2 = $_GET["var1"];
    $minlat2 = $_GET["var2"];
    $maxlon2 = $_GET["var3"];
    $minlon2 = $_GET["var4"];


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

       // include('consulta.php');
    

    $sql = mysqli_query($conexion, "SELECT envio FROM registro_posicion  WHERE latitud >= '$minlat2' AND latitud <= '$maxlat2' AND longitud >= '$minlon2' AND longitud <= '$maxlon2' ");

    $result = mysqli_fetch_all($sql, MYSQLI_ASSOC);
    
    exit(json_encode($result));




}


?>