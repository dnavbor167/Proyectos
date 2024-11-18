<?php
session_start();
require "src/funciones_ctes.php";

if (isset($_POST["btnCerrarSesion"])) {
    session_destroy();
    header("Location:index.php");
    exit;
}

if (isset($_SESSION["usuario"])) {

    //Hay que hacer un un control de banneo 
    //consulta a la BD y si está inicio sesión y salto a index
    //conexión con bd
    require "src/seguridad.php";
    
    //Muestro vista después de login
    require "vistas/vista_logueado.php";

    mysqli_close($conexion);
} else {
    require "vistas/vista_login.php";
}
