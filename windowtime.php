
<?php require_once 'vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable('varen/');
    $dotenv->load();

    $host=$_ENV['RDS_HOST'];
    $usuario=$_ENV['RDS_USER'];
    $contraseña=$_ENV['RDS_PASSWORD'];
    $base=$_ENV['RDS_DATABASE'];



    $conexion= new mysqli($host, $usuario, $contraseña, $base);
    if ($conexion -> connect_errno){
        die("Fallo la conexion:(".$conexion -> mysqli_connect_errno().")".$conexion->
        mysqli_connect_error());
    }

    $inicial = $_POST['inicial'];


    $final = $_POST['final'];

    $wtime=$conexion->query("SELECT * FROM registro_posicion  WHERE envio BETWEEN '$inicial' AND '$final'");
    echo "SELECT * FROM registro_posicion  WHERE envio BETWEEN '$inicial' AND '$final'";
    while ($filaMensaje = $wtime->fetch_array(MYSQLI_BOTH)){
         $data = array(
        "latitud" => $filaMensaje["latitud"],
        "longitud" => $filaMensaje["longitud"],
    
        ); 
    }
    echo json_encode($data);
?>  