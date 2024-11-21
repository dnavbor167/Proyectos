<?php
try {
    @$conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
    mysqli_set_charset($conexion, "utf8");
} catch (Exception $e) {
    session_destroy();
    die(error_page("Práctica 8", "<p>No se ha podido conectar a la BD: " . $e->getMessage() . "</p>"));
}

//Me he conectado y ahora hago la consulta
try {
    $consulta = "select * from usuarios where usuario = '" . $_SESSION["usuario"] . "' and clave = '" . $_SESSION["clave"] . "'";
    $datos_usuarios = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    mysqli_close($conexion);
    session_destroy();
    die(error_page("Práctica 8", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
}
if (mysqli_num_rows($datos_usuarios) <= 0) {
    //Usuario banneado
    mysqli_free_result($datos_usuarios);
    session_unset();
    $_SESSION["mensaje_seguridad"] = "Usted ya no se encuentra registrado en la base de datos";
    header("Location:index.php");
    exit;
} else {
    $datos_usuario_log = mysqli_fetch_assoc($datos_usuarios);
    mysqli_free_result($datos_usuarios);
}

//He pasado el control de banneo
//Ahora controlo el tiempo de inactividad

if (time() - $_SESSION["ultm_accion"] > INACTIVIDAD * 60) {
    session_unset();
    $_SESSION["mensaje_seguridad"] = "Su tiempo de sesión ha expirado";
    header("Location:index.php");
    exit;
}

$_SESSION["ultm_accion"] = time();
