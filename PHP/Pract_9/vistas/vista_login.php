<?php
if (isset($_POST["btnLogin"])) {
    //Comprobar errores login
    $error_usuario = $_POST["usuario"] == "";
    $error_clave = $_POST["clave"] == "";
    $error_login = $error_usuario || $error_clave;

    if (!$error_login) {
        //consulta a la BD y si está inicio sesión y salto a index
        //conexión con bd
        try {
            @$conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
            mysqli_set_charset($conexion, "utf8");
        } catch (Exception $e) {
            session_destroy();
            die(error_page("Práctica 8", "<p>No se ha podido conectar a la BD: " . $e->getMessage() . "</p>"));
        }

        //Me he conectado y ahora hago la consulta
        try {
            $consulta = "select usuario from usuarios where usuario = '" . $_POST["usuario"] . "' and clave = '" . md5($_POST["clave"]) . "'";
            $datos_usuarios = mysqli_query($conexion, $consulta);
            $n_tuplas = mysqli_num_rows($datos_usuarios);
            mysqli_free_result($datos_usuarios);
            if ($n_tuplas > 0) {
                //El usuario se encuentra registrado y tengo que iniciar sesión
                mysqli_close($conexion);
                $_SESSION["usuario"] = $_POST["usuario"];
                $_SESSION["clave"] = md5($_POST["clave"]);
                $_SESSION["ultm_accion"] = time();
                header("Location:index.php");
                exit;
            } else {
                $error_usuario = true;
                mysqli_close($conexion);
            }
        } catch (Exception $e) {
            mysqli_close($conexion);
            session_destroy();
            die(error_page("Práctica 8", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primer Login</title>
    <style>
        .error {
            color: red;
        }
        .mensaje {
            color: blue;
            font-size: 2rem;
        }
    </style>
</head>

<body>
    <h1>Primer Login</h1>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="usuario">Usuario: </label>
            <input type="text" name="usuario" id="usuario" value="<?php if (isset($_POST["usuario"])) echo $_POST["usuario"]; ?>">
            <?php
            if (isset($_POST["btnLogin"]) && $error_usuario) {
                if ($_POST["usuario"] == "")
                    echo "<span class='error'>* Campo vacío *</span>";
                else
                    echo "<span class='error'>* Usuario y/o contraseña incorrecta *</span>";
            }
            ?>
        </p>

        <p>
            <label for="clave">Contraseña: </label>
            <input type="password" name="clave" id="clave">
            <?php
            if (isset($_POST["btnLogin"]) && $error_clave) {
                echo "<span class='error'>* Campo vacío *</span>";
            }
            ?>
        </p>
        <p>
            <button type="submit" name="btnLogin">Login</button>
            <button type="submit" name="btnRegistro">Registrarse</button>
        </p>
    </form>

    <?php 
    if (isset($_SESSION["mensaje_seguridad"])) {
        echo "<p class='mensaje'>".$_SESSION["mensaje_seguridad"]."</p>";
        session_destroy();
    }
    ?>
</body>

</html>