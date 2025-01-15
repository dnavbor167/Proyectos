<?php
require "src/funciones_ctes.php";
session_name("Servicios_Web");
session_start();

if (isset($_POST["btnCrearProducto"])) {
    $url = DIR_SERV . "/familias";
    $respuesta = consumir_servicios_REST($url, "GET");
    $json_familias = json_decode($respuesta, true);
    if (!$json_familias)
        die(error_page("Actividad 2", "<p>Error consumiendo el servico rest: <strong>" . $url . "</strong></p>"));
    if (isset($json_familias["error"]))
        die(error_page("Actividad 2", "<p>" . $json_familias["error"] . "</p>"));
}

if (isset($_POST["btnBorrarDef"])) {
    $url = DIR_SERV . "/producto/borrar/" . $_POST["btnBorrarDef"];
    $respuesta = consumir_servicios_REST($url, "DELETE");
    $json_eliminar = json_decode($respuesta, true);
    if (!$json_eliminar)
        die(error_page("Actividad 2", "<p>Error consumiendo el servico rest: <strong>" . $url . "</strong></p>"));

    if (isset($json_eliminar["error"]))
        die(error_page("Actividad 2", "<p>" . $json_eliminar["error"] . "</p>"));

    $_SESSION["mensaje"] = "Producto borrado con éxito";
}

if (isset($_POST["btnDetalles"])) {
    $url = DIR_SERV . "/producto/" . $_POST["btnDetalles"];
    $respuesta = consumir_servicios_REST($url, "GET");
    $json_detalles = json_decode($respuesta, true);
    if (!$json_detalles)
        die(error_page("Actividad 2", "<p>Error consumiendo el servico rest: <strong>" . $url . "</strong></p>"));

    if (isset($json_detalles["error"]))
        die(error_page("Actividad 2", "<p>" . $json_detalles["error"] . "</p>"));
}


//Esto se va a hacer siempre
$url = DIR_SERV . "/productos";
$respuesta = consumir_servicios_REST($url, "GET");
$json_productos = json_decode($respuesta, true);
if (!$json_productos)
    die(error_page("Actividad 2", "<p>Error consumiendo el servico rest: <strong>" . $url . "</strong></p>"));

if (isset($json_productos["error"]))
    die(error_page("Actividad 2", "<p>" . $json_productos["error"] . "</p>"));

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 2</title>
    <style>
        table,
        td,
        th {
            border: 1px solid black;
            text-align: center;
            padding: 1rem;
        }

        h1 {
            text-align: center;
        }

        th {
            background-color: lightgray;
        }

        table {
            border-collapse: collapse;
            width: 90%;
            margin: 0 auto;
        }

        button.enlace {
            border: none;
            background: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }

        #borrarId {
            text-align: center;
            margin: 1rem auto;
        }

        .sesionEnlace {
            text-align: center;
            color: blue;
            font-size: 1rem;
        }
    </style>
</head>

<body>
    <h1 class="centrado txt_centrado">Listado de los productos</h1>
    <?php

    if (isset($_SESSION["mensaje"])) {
        echo "<p class='sesionEnlace'>" . $_SESSION["mensaje"] . "</p>";
        session_destroy();
    }

    if (isset($_POST["btnBorrar"]))
        require "vistas/vista_borrar.php";

    if (isset($_POST["btnDetalles"]))
        require "vistas/vista_detalles.php";

    if (isset($_POST["btnCrearProducto"]))
        require "vistas/vista_agregar.php";

    if (isset($_POST["btnEditar"])) {
        require "vistas/vista_editar.php";
    }


    echo "<table id='tb_pricipal'>";
    echo "<tr><th>Código</th><th>Nombre Corto</th><th>PVP</th><th><form action='index.php' method='post'><button class='enlace' name='btnCrearProducto'>Producto+</button></form></th></tr>";

    foreach ($json_productos["productos"] as $tupla) {
        echo "<tr>";
        echo "<td><form action='index.php' method='post'><button class='enlace' name='btnDetalles' type='submit' value='" . $tupla["cod"] . "'>" . $tupla["cod"] . "</button></form></td>";
        echo "<td>" . $tupla["nombre_corto"] . "</td>";
        echo "<td>" . $tupla["PVP"] . "</td>";
        echo "<td><form action='index.php' method='post'><button type='submit' class='enlace' name='btnBorrar' value='" . $tupla["cod"] . "'>Borrar</button> - <button type='submit' class='enlace' name='btnEditar' value='" . $tupla["cod"] . "'>Editar</button></form></td>";
        echo "</tr>";
    }

    echo "</table>";
    ?>
</body>

</html>