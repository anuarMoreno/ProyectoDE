<?php


if (isset($_GET["var1"]) && isset($_GET["var2"]) && isset($_GET["var3"]) && isset($_GET["var4"]) && isset($_GET["var5"]) && isset($_GET["var6"])) {

    $sendlat2 = $_GET["var1"];
    $sendlon2 = $_GET["var2"];
    $radius = $_GET["var3"];
    $date1 = $_GET["var4"];
    $date2 = $_GET["var5"];
    $tabla = $_GET["var6"];


    $conn = mysqli_connect('ddatabase.ct8hfoibhvoa.us-east-1.rds.amazonaws.com', 'admin', 'Meteoritos21', 'davidserver');

    $sql = mysqli_query($conn, "SELECT envio, ( 6371 * acos( cos( radians($sendlat2) ) * cos( radians( latitud ) ) 
    * cos( radians( longitud ) - radians($sendlon2) ) + sin( radians($sendlat2) ) * sin(radians(latitud)) ) ) AS distance 
    FROM $tabla
    WHERE envio >= '$date1' AND envio <= '$date2'
    HAVING distance < $radius ");
    $result = mysqli_fetch_all($sql, MYSQLI_ASSOC);
    
    exit(json_encode($result));




}


?>