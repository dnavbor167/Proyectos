<?php
if (isset($_POST["btnEntrar"])) {
    $error_usuario = $_POST["usuario"] == "";
    $error_clave = $_POST["clave"] == "";
    $error_form = $error_usuario || $error_clave;

    if (!$error_form) {
        $url = DIR_SERV . "/login";
        $datos_env["usuario"] = $_POST["usuario"];
        $datos_env["clave"] = md5($_POST["clave"]);
        $respuesta = consumir_servicios_REST($url, "POST", $datos_env);
        $json_respuesta = json_decode($respuesta, true);

        if (!$json_respuesta) {
            session_destroy();
            die(error_page("Examen php", "<p>Error consumiendo servicio Rest: " . $url . "</p>"));
        }

        if (isset($json_respuesta["error"])) {
            session_destroy();
            die(error_page("Examen php", "<p>" . $json_respuesta["error"] . "</p>"));
        }

        if (isset($json_respuesta["mensaje"]))
            $error_usuario = true;
        else {
            $_SESSION["token"] = $json_respuesta["token"];
            $_SESSION["ultm_accion"] = time();

            header("Location:index.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Guardias</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Gestion de Guardias</h1>

    <form action="index.php" method="post">
        <label for="usuario">Usuario: </label>
        <input type="text" name="usuario" id="usuario">
        <?php
        if (isset($_POST["btnEntrar"]) && $error_usuario) {
            if ($_POST["usuario"] == "") {
                echo "<span class='error'>* Campo vacío *</span>";
            }
        }
        ?>
        <br><br>
        <label for="clave">Contraseña: </label>
        <input type="password" name="clave" id="clave">
        <?php
        if (isset($_POST["btnEntrar"]) && $error_clave) {
            echo "<span class='error'>* Campo vacío *</span>";
        }
        ?>
        <br><br>
        <button type="submit" name="btnEntrar">Entrar</button>
    </form>
</body>

</html>