<?php
 ?>
<?php
include_once "cors.php";
include_once "funciones.php";
$venta = obtenerMaxSale();
echo json_encode($venta);
