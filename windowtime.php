<?php include("consulta.php");
  $wtime=$conexion->query("SELECT * FROM registro_posicion  WHERE envio BETWEEN 'inicial' AND 'final'");
  
?>  