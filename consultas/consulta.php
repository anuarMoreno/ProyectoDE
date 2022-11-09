<?php

    $conexion = mysqli_connect('ddatabase.ct8hfoibhvoa.us-east-1.rds.amazonaws.com', 'admin', 'Meteoritos21', 'davidserver');

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