<?php
 ?>
<?php
include_once "cors.php";
$producto = json_decode(file_get_contents("php://input"));
include_once "funciones.php";
$resultado = agregarProducto($producto);
echo json_encode($resultado);
