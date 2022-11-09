<?php

$conn = mysqli_connect('ddatabase.ct8hfoibhvoa.us-east-1.rds.amazonaws.com', 'admin', 'Meteoritos21', 'davidserver');

$tabla = $_GET["var3"];
$str = '2022-09-10 13:00';
$fnsh =  '2022-09-15 17:00';

if (isset($_GET["var1"]) && isset($_GET["var2"])) {

    $str = $_GET["var1"];
    $fnsh = $_GET["var2"];
}

$sql = mysqli_query($conn, "SELECT latitud, longitud FROM $tabla WHERE envio >= '$str' AND envio <= '$fnsh' ");

$result = mysqli_fetch_all($sql, MYSQLI_ASSOC);

exit(json_encode($result));





?>