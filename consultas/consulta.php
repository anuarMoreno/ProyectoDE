<?php

    require_once '/var/www/html/vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable('/var/www/html/varen/');
    $dotenv->load();

    $host=$_ENV['RDS_HOST'];
    $usuario=$_ENV['RDS_USER'];
    $contraseña=$_ENV['RDS_PASSWORD'];
    $base=$_ENV['RDS_DATABASE'];

    $conexion= mysqli_connect($host, $usuario, $contraseña, $base);

    $resPosicion=$conexion->query("SELECT * FROM registro_posicion  WHERE id = (SELECT max(id) FROM registro_posicion)");
    $resPosicion2=$conexion->query("SELECT * FROM registro_posicion2  WHERE id = (SELECT max(id) FROM registro_posicion2)");

    while ($filaMensaje = $resPosicion->fetch_array(MYSQLI_BOTH))
    {
        $filaMensaje2 = $resPosicion2->fetch_array(MYSQLI_BOTH);
        $data = array(
            "latitud" => $filaMensaje["latitud"],
            "longitud" => $filaMensaje["longitud"],
            "envio" => $filaMensaje["envio"],
            "latitud2" => $filaMensaje2["latitud"],
            "longitud2" => $filaMensaje2["longitud"],
            "envio2" => $filaMensaje2["envio"]
            
        );

        echo json_encode($data);
    }


  ?>