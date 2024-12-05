<?php
session_name("examen2_24_25");
session_start();
require "src/funciones_cts.php";

try {
    @$conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
    mysqli_set_charset($conexion, "utf8");
} catch (Exception $e) {
    session_destroy();
    die(error_page("Examen2", "<p>Error al conectarse con la base de datos: " . $e . "</p>"));
}

//si le ha dado a salir hacemos un session unset
if (isset($_POST["btnSalir"])) {
    session_unset();
    $_SESSION["mensaje"] = "Sesión cerrada con éxito";
    header("Location:index.php");
    exit;
}

//hacemos la primera consulta para traernos las fotos
try {
    $consulta = "select * from libros";
    $result_listado_libros = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    mysqli_close($conexion);
    session_destroy();
    die(error_page("Examen2", "<p>Error al hacer la consulta con la base de datos: " . $e . "</p>"));
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicio</title>
    <style>
        * {
            box-sizing: border-box;
            overflow: auto;
        }

        .error {
            color: red;
        }

        div#padre {
            width: 90%;
            margin: 0 auto;
            padding: 0;
            display: flex;
            flex-flow: row wrap;
        }

        img {
            width: 100%;
            border: solid 1px gray;
        }

        .centrado {
            font-size: 1rem;
            text-align: center;
        }

        .flotado {
            flex: 0 0 30%;
            display: flex;
            flex-flow: column;
            align-items: center;
            margin-right: 3%;
        }

        .enlace {
            background: none;
            border: none;
            color: blue;
            text-decoration: underline;
        }

        .mensaje {
            color: blue;
            font-size: 1.3rem;
        }

        table#list_lib {
            border-collapse: collapse;
            width: 80%;
            margin: 0 auto;
        }

        table#list_lib th {
            background-color: lightgray;
        }

        table#list_lib,
        table#list_lib th,
        table#list_lib td {
            border: solid 1px black;
            text-align: center;
        }

        table#list_lib th,
        table#list_lib td {
            padding: .5rem 4rem;
        }

        table#tabla_2 tr td:nth-child(2){
           height: 3rem;
        }

        table#tabla_2 tr td,
        table#tabla_2 tr th {
            text-align: left;
        }

        table#tabla_2 tr input,
        table#tabla_2 tr textarea {
            width: 13rem;
        }
    </style>
</head>

<body>
    <h1>Librería</h1>
    <?php
    if (isset($_SESSION["usuario"])) {
        require "src/seguridad.php";
        echo "<form action='index.php' method='post'><label>Bienvenido <strong><i>" . $_SESSION["usuario"] . "</i></strong> - </label><button type='submit' class='enlace' name='btnSalir'>Salir</button></form>";
        if ($_SESSION["tipo"] == "admin") {
            require "admin/gest_libros.php";
        } else {
            //esto se mostra siempre menos en modo admin
            require "vistas/vista_lista_libros.php";
        }
    } else {
        //esto estará siempre hasta que se loguee
        require "vistas/vista_login.php";
        if (isset($_SESSION["mensaje"])) {
            echo "<p class='mensaje'>" . $_SESSION["mensaje"] . "</p>";
            session_destroy();
        }
        //esto se mostra siempre menos en modo admin
        require "vistas/vista_lista_libros.php";
    }
    ?>


</body>

</html>