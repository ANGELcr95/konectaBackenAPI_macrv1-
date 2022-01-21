<?php
 ?>
<?php
include_once "cors.php";
$venta = json_decode(file_get_contents("php://input"));
include_once "funciones.php";
$resultado = agregarventa($venta);
echo json_encode($resultado);
