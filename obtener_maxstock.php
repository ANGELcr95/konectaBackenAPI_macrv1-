<?php
 ?>
<?php
include_once "cors.php";
include_once "funciones.php";
$producto = obtenerMaxStock();
echo json_encode($producto);
