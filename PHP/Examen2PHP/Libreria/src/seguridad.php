<?php
//consulta para loguearnos
try {
    $consulta = "select * from usuarios where lector = '" . $_SESSION["usuario"] . "'";
    $result_login_usuarios = mysqli_query($conexion, $consulta);
    $esta_logueado = mysqli_num_rows($result_login_usuarios);
} catch (Exception $e) {
    mysqli_close($conexion);
    session_destroy();
    die(error_page("Examen2", "<p>Error al hacer la consulta con la base de datos: " . $e . "</p>"));
}

//control de banneo
if ($esta_logueado <= 0) {
    session_unset();
    $_SESSION["mensaje"] = "Has sido banneado";
    header("Location:index.php");
    exit;
}

//controlamos el tiempo y mostramos mensaje
if (time() - $_SESSION["ult_acc"] > INACTIVIDAD * 60) {
    session_unset();
    $_SESSION["mensaje"] = "El tiempo ha expirado";
    header("Location:index.php");
    exit;
}

//si no entra e el if anterior renovamos el tiempo
$_SESSION["ult_acc"] = time();
?>