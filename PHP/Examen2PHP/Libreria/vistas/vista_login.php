<?php
if (isset($_POST["btnEntrar"])) {
    $error_usuario = $_POST["usuario"] == "";
    $error_clave = $_POST["clave"] == "";
    $error_login = $error_usuario || $error_clave;

    //consulta para loguearnos
    try {
        $consulta = "select * from usuarios where lector = '" . $_POST["usuario"] . "' and clave = '" . md5($_POST["clave"]) . "'";
        $result_login_usuarios = mysqli_query($conexion, $consulta);
        $esta_logueado = mysqli_num_rows($result_login_usuarios);
        $user_log = mysqli_fetch_assoc($result_login_usuarios);
    } catch (Exception $e) {
        mysqli_close($conexion);
        session_destroy();
        die(error_page("Examen2", "<p>Error al hacer la consulta con la base de datos: " . $e . "</p>"));
    }

    if ($esta_logueado <= 0) {
        $error_login = true;
    }

    if (!$error_login) {
        //si no hay errores en el login guardamos 3 variables de session
        $_SESSION["usuario"] = $_POST["usuario"];
        $_SESSION["tipo"] = $user_log["tipo"];
        $_SESSION["clave"] = $_POST["clave"];
        $_SESSION["ult_acc"] = time();
        header("Location:index.php");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicio</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <form action="index.php" method="post">
        <label for="usuario">Usuario: </label>
        <input type="text" name="usuario" id="usuario" value="<?php if (isset($_POST["usuario"])) echo $_POST["usuario"] ?>">
        <?php
        if (isset($_POST["btnEntrar"]) && $error_login) {
            if ($_POST["usuario"] == "")
                echo "<span class='error'>* Debes rellenar el campo *</span>";
            else
                echo "<span class='error'>* Usuario y/o contraseña incorrectos *</span>";
        }
        ?>
        <br>
        <label for="clave">Contraseña: </label>
        <input type="password" name="clave" id="clave">
        <?php
        if (isset($_POST["btnEntrar"]) && $error_login) {
            if ($_POST["clave"] == "")
                echo "<span class='error'>* Debes rellenar el campo *</span>";
            else
                echo "<span class='error'>* Usuario y/o contraseña incorrectos *</span>";
        }
        ?>
        <br>

        <button type="submit" name="btnEntrar">Entrar</button>
    </form>
</body>

</html>