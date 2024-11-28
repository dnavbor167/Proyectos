<?php
//Por si reutilizo código hay que ponerle un nombre único sino puede ser que se guarde
//las session y cuando hagas otra se habra sesión directamente si hay abierta
session_name("Primer_Login_Ve");
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
    if ($datos_usuario_log["tipo"] == "normal")
        require "vistas/vista_normal.php";
    else {
        mysqli_close($conexion);
        header("Location:admin/index.php");
        exit;
    }

    mysqli_close($conexion);
} else {
    require "vistas/vista_login.php";
}
