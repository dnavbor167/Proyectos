<?php
//conectamos al servidor
const SERVIDOR_BD = "localhost";
const USUARIO_BD = "jose";
const CLAVE_BD = "josefa";
const NOMBRE_BD = "bd_tienda";

function obtener_productos()
{
    //Conexión con base de datos
    try {
        //El último parámetro es opcional (el array)
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "No se ha podido acceder a la base de datos: " . $e->getMessage();
        return $respuesta;
    }

    //Consulta:
    try {
        $consulta = "select * from producto";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No se ha podido hacer la consulta: " . $e->getMessage();
        return $respuesta;
    }

    $respuesta["productos"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    $sentencia = null;
    $conexion = null;
    return $respuesta;
}

function obtener_producto($cod)
{
    //Conexión con base de datos
    try {
        //El último parámetro es opcional (el array)
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "No se ha podido acceder a la base de datos: " . $e->getMessage();
        return $respuesta;
    }

    //Consulta:
    try {
        $consulta = "select * from producto where cod = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$cod]);
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No se ha podido hacer la consulta: " . $e->getMessage();
        return $respuesta;
    }

    if ($sentencia->rowCount() <= 0)
        $respuesta["mensaje"] = "El producto con cod " . $cod . " no se encuentra en la BD";
    else
        $respuesta["producto"] = $sentencia->fetch(PDO::FETCH_ASSOC);

    $sentencia = null;
    $conexion = null;
    return $respuesta;
}

function insertar_producto($cod, $nombre, $nombre_corto, $descripcion, $pvp, $familia) {
//Conexión con base de datos
try {
    //El último parámetro es opcional (el array)
    $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
} catch (PDOException $e) {
    $respuesta["error"] = "No se ha podido acceder a la base de datos: " . $e->getMessage();
    return $respuesta;
}

//inserción:
try {
    $consulta = "insert into `producto`(`cod`, `nombre`, `nombre_corto`, `descripcion`, `PVP`, `familia`) values ('?','?','?','?','?','?')";
    $sentencia = $conexion->prepare($consulta);
    $sentencia->execute([$cod, $nombre, $nombre_corto, $descripcion, $pvp, $familia]);
} catch (PDOException $e) {
    $sentencia = null;
    $conexion = null;
    $respuesta["error"] = "No se ha podido hacer la inserción: " . $e->getMessage();
    return $respuesta;
}
}
