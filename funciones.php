<?php
 ?>
<?php

function eliminarProducto($id)
{
    $bd = obtenerConexion();
    $sentencia = $bd->prepare("DELETE FROM productos_cafeteria WHERE id = ?");
    return $sentencia->execute([$id]);
}

function actualizarProducto($producto)
{
    $bd = obtenerConexion();
    $sentencia = $bd->prepare("UPDATE productos_cafeteria SET nombre = ?, referencia = ?, precio = ?, peso = ?, categoria = ?, stock = ?, fecha = ? WHERE id = ?");
    return $sentencia->execute([$producto->nombre, $producto->referencia, $producto->precio, $producto->peso, $producto->categoria, $producto->stock, $producto->fecha, $producto->id]);
}

function actualizarStock($producto)
{
    $bd = obtenerConexion();
    $sentencia = $bd->prepare("UPDATE productos_cafeteria SET stock = ? WHERE id = ?");
    return $sentencia->execute([$producto->stock, $producto->id]);
}

function obtenerProductoPorId($id)
{
    $bd = obtenerConexion();
    $sentencia = $bd->prepare("SELECT id, nombre, referencia, precio, peso, categoria, stock, fecha FROM productos_cafeteria WHERE id = ?");
    $sentencia->execute([$id]);
    return $sentencia->fetchObject();
}

function obtenerProductos()
{
    $bd = obtenerConexion();
    $sentencia = $bd->query("SELECT id, nombre, referencia, precio, peso, categoria, stock, fecha FROM productos_cafeteria");
    return $sentencia->fetchAll();
}

function obtenerventas()
{
    $bd = obtenerConexion();
    $sentencia = $bd->query("SELECT id, nombre, uds_vendidas, precio, ingresos FROM ventas_cafeteria");
    return $sentencia->fetchAll();
}

function obtenerMaxSale()
{
    $bd = obtenerConexion();
    $sentencia = $bd->query("SELECT id, nombre, uds_vendidas, precio, ingresos FROM ventas_cafeteria WHERE uds_vendidas = ( SELECT MAX(uds_vendidas) FROM ventas_cafeteria)");
    return $sentencia->fetchAll();
}

function obtenerMaxStock()
{
    $bd = obtenerConexion();
    $sentencia = $bd->query("SELECT id, nombre, referencia, precio, peso, categoria, stock, fecha FROM productos_cafeteria WHERE stock = ( SELECT MAX(stock) FROM productos_cafeteria)");
    return $sentencia->fetchAll();
}

function agregarProducto($producto)
{
    $bd = obtenerConexion();
    $sentencia = $bd->prepare("INSERT INTO productos_cafeteria(nombre, referencia, precio, peso, categoria, stock, fecha) VALUES (?, ?, ?, ?, ?, ?, ?)");
    return $sentencia->execute([$producto->nombre, $producto->referencia, $producto->precio, $producto->peso, $producto->categoria, $producto->stock, $producto->fecha]);
}

function agregarventa($venta)
{
    $bd = obtenerConexion();
    $sentencia = $bd->prepare("INSERT INTO ventas_cafeteria(nombre, uds_vendidas, precio, ingresos) VALUES (?, ?, ?, ?)");
    return $sentencia->execute([$venta->nombre, $venta->uds_vendidas, $venta->precio, $venta->ingresos]);
}

function obtenerVariableDelEntorno($key)
{
    if (defined("_ENV_CACHE")) {
        $vars = _ENV_CACHE;
    } else {
        $file = "env.php";
        if (!file_exists($file)) {
            throw new Exception("El archivo de las variables de entorno ($file) no existe. Favor de crearlo");
        }
        $vars = parse_ini_file($file);
        define("_ENV_CACHE", $vars);
    }
    if (isset($vars[$key])) {
        return $vars[$key];
    } else {
        throw new Exception("La clave especificada (" . $key . ") no existe en el archivo de las variables de entorno");
    }
}
function obtenerConexion()
{
    $password = obtenerVariableDelEntorno("MYSQL_PASSWORD");
    $user = obtenerVariableDelEntorno("MYSQL_USER");
    $dbName = obtenerVariableDelEntorno("MYSQL_DATABASE_NAME");
    $database = new PDO('mysql:host=localhost;dbname=' . $dbName, $user, $password);
    $database->query("set names utf8;");
    $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    return $database;
}
