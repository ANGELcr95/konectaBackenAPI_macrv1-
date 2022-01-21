<?php
 ?>
<?php
include_once "cors.php";
include_once "funciones.php";
$ventas = obtenerventas();
echo json_encode($ventas);
