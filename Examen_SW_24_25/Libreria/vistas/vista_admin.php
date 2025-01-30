<?php
require "vistas/vista_libros.php";

if (isset($_POST["btnBorrarSi"])) {
    $headers[] = "Authorization: Bearer " . $_SESSION["token"];
    $url = DIR_SERV . "/borrarLibro/" . $_POST["btnBorrarSi"];
    $respuesta = consumir_servicios_JWT_REST($url, "DELETE", $headers);
    $json_borrar_libro = json_decode($respuesta, true);
    if (!$json_borrar_libro) {
        session_destroy();
        die(error_page("Gestión Libros", "<h1>Librería</h1><p>Error consumiendo el servicio Rest: <strong>" . $url . "</strong></p>"));
    }
    if (isset($json_borrar_libro["error"])) {
        session_destroy();
        die(error_page("Gestión Libros", "<h1>Librería</h1><p>" . $json_borrar_libro["error"] . "</p>"));
    }

    if (isset($json_borrar_libro["no_auth"])) {
        session_unset();
        $_SESSION["mensaje_seguridad"] = "El tiempo de sesión de la API ha expirado";
        header("Location:index.php");
        exit;
    }
    if (isset($json_borrar_libro["mensaje_baneo"])) {
        session_unset();
        $_SESSION["mensaje_seguridad"] = "Usted ya no se encuentra registrado en la BD";
        header("Location:index.php");
        exit;
    }

    $_SESSION["mensaje"] = $json_borrar_libro["mensaje"];
    header("location:index.php");
    exit;
}
if (isset($_POST["btnAgregar"])) {
    //Controlamos errores formulario agregar
    $error_referencia = $_POST["referencia"] == "" || $_POST["referencia"] <= 0 || !is_numeric($_POST["referencia"]);
    //comprobamos si está repetido o no la referencia llamando al servicio creado

    if (!$error_referencia) {
        $headers[] = "Authorization: Bearer " . $_SESSION["token"];
        $url = DIR_SERV . "/repetido/libros/referencia/" . $_POST["referencia"];
        $respuesta = consumir_servicios_JWT_REST($url, "GET", $headers);
        $json_repetido = json_decode($respuesta, true);
        if (!$json_repetido) {
            session_destroy();
            die(error_page("Gestión Libros", "<h1>Librería</h1><p>Error consumiendo el servicio Rest: <strong>" . $url . "</strong></p>"));
        }
        if (isset($json_repetido["error"])) {
            session_destroy();
            die(error_page("Gestión Libros", "<h1>Librería</h1><p>" . $json_repetido["error"] . "</p>"));
        }

        if (isset($json_repetido["no_auth"])) {
            session_unset();
            $_SESSION["mensaje_seguridad"] = "El tiempo de sesión de la API ha expirado";
            header("Location:index.php");
            exit;
        }
        if (isset($json_repetido["mensaje_baneo"])) {
            session_unset();
            $_SESSION["mensaje_seguridad"] = "Usted ya no se encuentra registrado en la BD";
            header("Location:index.php");
            exit;
        }
        $error_referencia = $json_repetido["repetido"];
    }

    $error_titulo = $_POST["titulo"] == "";
    $error_autor = $_POST["autor"] == "";
    $error_descripcion = $_POST["descripcion"] == "";
    $error_precio = $_POST["precio"] == "" || $_POST["precio"] <= 0 || !is_numeric($_POST["precio"]);
    $errores_form_agregar = $error_referencia || $error_titulo || $error_autor || $error_descripcion || $error_precio;
}


if (isset($_POST["btnAgregar"]) && !$errores_form_agregar) {
    $headers[] = "Authorization: Bearer " . $_SESSION["token"];
    $url = DIR_SERV . "/crearLibro";
    $datos_env["referencia"] = $_POST["referencia"];
    $datos_env["titulo"] = $_POST["titulo"];
    $datos_env["autor"] = $_POST["autor"];
    $datos_env["descripcion"] = $_POST["descripcion"];
    $datos_env["precio"] = $_POST["precio"];
    $respuesta = consumir_servicios_JWT_REST($url, "POST", $headers, $datos_env);
    $json_crear_libro = json_decode($respuesta, true);
    if (!$json_crear_libro) {
        session_destroy();
        die(error_page("Gestión Libros", "<h1>Librería</h1><p>Error consumiendo el servicio Rest: <strong>" . $url . "</strong></p>"));
    }
    if (isset($json_crear_libro["error"])) {
        session_destroy();
        die(error_page("Gestión Libros", "<h1>Librería</h1><p>" . $json_crear_libro["error"] . "</p>"));
    }

    if (isset($json_crear_libro["no_auth"])) {
        session_unset();
        $_SESSION["mensaje_seguridad"] = "El tiempo de sesión de la API ha expirado";
        header("Location:index.php");
        exit;
    }
    if (isset($json_crear_libro["mensaje_baneo"])) {
        session_unset();
        $_SESSION["mensaje_seguridad"] = "Usted ya no se encuentra registrado en la BD";
        header("Location:index.php");
        exit;
    }
    $_SESSION["mensaje"] = $json_crear_libro["mensaje"];
    header("location:index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Libros</title>
    <style>
        .enlinea {
            display: inline
        }

        .enlace {
            background: none;
            border: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }

        .mensaje {
            color: blue;
            font-size: 1.25rem
        }

        .error {
            color: red;
        }

        table,
        td,
        th {
            border: solid 1px black;
        }

        th {
            background-color: lightgray;
        }

        th,
        td {
            text-align: center;
        }

        table {
            width: 90%;
            margin: 0 auto;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <h1>Librería</h1>
    <div>
        Bienvenido <strong><?php echo $datos_usu_log["lector"]; ?></strong> - <form class="enlinea" action="index.php" method="post"><button class="enlace" type="submit" name="btnSalir">Salir</button></form>
    </div>

    <?php
    require "vistas/vista_libros_admin.php";

    if (isset($_SESSION["mensaje"])) {
        echo "<p class='mensaje'>" . $_SESSION["mensaje"] . "</p>";
        unset($_SESSION["mensaje"]);
    }

    if (isset($_POST["btnBorrar"])) {
        require "vistas/vista_borrar.php";
    } else  if (isset($_POST["btnEditar"])) {
    } else
        include "vistas/vista_agregar_libro.php";

    ?>

</body>

</html>