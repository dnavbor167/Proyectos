<?php
if (isset($_POST["btnLogin"])) {
    //compruebo errores
    $error_usuario = $_POST["usuario"] == "";
    $error_clave = $_POST["clave"] == "";
    $error_form_login = $error_usuario || $error_clave;
    if (!$error_form_login) {
        $url = DIR_SERV . "/login";
        $datos_env["lector"] = $_POST["usuario"];
        $datos_env["clave"] = md5($_POST["clave"]);
        $respuesta = consumir_servicios_REST($url, "POST", $datos_env);
        $json_respuesta = json_decode($respuesta, true);
        if (!$json_respuesta) {
            session_destroy();
            die(error_page("Gestión Libros", "<h1>Librería</h1><p>Error consumiendo el servicio Rest: <strong>" . $url . "</strong></p>"));
        }
        if (isset($json_respuesta["error"])) {
            session_destroy();
            die(error_page("Gestión Libros", "<h1>Librería</h1><p>" . $json_respuesta["error"] . "</p>"));
        }
        if (isset($json_respuesta["mensaje"])) {
            $error_usuario = true;
        } else {
            $_SESSION["token"] = $json_respuesta["token"];
            $_SESSION["ultm_accion"] = time();
            header("Location:index.php");
            exit;
        }
    }
}


require "vistas/vista_libros.php";


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Libros</title>
    <style>
        .error {
            color: red
        }

        .mensaje {
            color: blue;
            font-size: 1.25rem
        }

        #libros_login {
            display: flex;
            flex-flow: row wrap;
        }

        img {
            width: 40%;
        }

        #libros_login div {
            flex: 0 0 30%;
            display: flex;
            flex-flow: column;
            align-items: center;
        }
    </style>
</head>

<body>
    <h1>Librería</h1>
    <form action="index.php" method="post">
        <p>
            <label for="usuario">Usuario: </label>
            <input type="text" id="usuario" name="usuario" value="<?php if (isset($_POST["usuario"])) echo $_POST["usuario"]; ?>" />
            <?php
            if (isset($_POST["btnLogin"]) && $error_usuario) {
                if ($_POST["usuario"] == "")
                    echo "<span class='error'>* Campo vacío *</span>";
                else
                    echo "<span class='error'>* Usuario y/o contraseña incorrectos  *</span>";
            }
            ?>
        </p>
        <p>
            <label for="clave">Contraseña: </label>
            <input type="password" name="clave" id="clave" />
            <?php
            if (isset($_POST["btnLogin"]) && $error_clave) {
                echo "<span class='error'>* Campo vacío *</span>";
            }
            ?>
        </p>
        <p>
            <button name="btnLogin" type="submit">Login</button>
        </p>
    </form>
    <?php
    if (isset($_SESSION["mensaje_seguridad"])) {
        echo "<p class='mensaje'>" . $_SESSION["mensaje_seguridad"] . "</p>";
        unset($_SESSION["mensaje_seguridad"]);
    }

    echo "<div id='libros_login'>";
    foreach ($json_libros["libros"] as $tupla) {

        echo "<div><img src='images/" . $tupla["portada"] .  "' alt='imgenLibro'> <p>" . $tupla["titulo"] . " - " . $tupla["precio"] . "</p></div>";
    }
    echo "</div>";
    ?>
</body>

</html>