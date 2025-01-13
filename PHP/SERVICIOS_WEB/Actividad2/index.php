<?php
function consumir_servicios_REST($url, $metodo, $datos = null)
{
    $llamada = curl_init();
    curl_setopt($llamada, CURLOPT_URL, $url);
    curl_setopt($llamada, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($llamada, CURLOPT_CUSTOMREQUEST, $metodo);
    if (isset($datos))
        curl_setopt($llamada, CURLOPT_POSTFIELDS, http_build_query($datos));
    $respuesta = curl_exec($llamada);
    curl_close($llamada);
    return $respuesta;
}

define("DIR_SERV", "http://localhost/Proyectos/PHP/SERVICIOS_WEB/Actividad1/servicios_rest");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba de los Servicios Actividad 1</title>
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
    </style>
</head>

<body>

    <?php
    echo "<h1>Listado de los Productos</h1>";

    //Obtener información
    if (isset($_POST["btnInfoProducto"])) {
    }

    $url = DIR_SERV . "/producto/" . $_POST["btnInfoProducto"];
    $respuesta = consumir_servicios_REST($url, "GET");

    $obj = json_decode($respuesta, true);
    if (!$obj)
        die("<p>Error consumiendo el servicio web <strong>" . $url . "</strong></p></body></html>");

    if (isset($obj["error"]))
        die("<p>" . $obj->error . "</p></body></html>");
    

    $url = DIR_SERV . "/productos";
    $respuesta = consumir_servicios_REST($url, "GET");
    //Si le pongo true en json_decode en vez de hacerme el array como si fuese un objeto, lo pone como array asociativo
    //en vez de llamarlo como $obj->error se llamaría como $obj["error"]
    $obj = json_decode($respuesta, true);
    if (!$obj)
        die("<p>Error consumiendo el servicio web <strong>" . $url . "</strong></p></body></html>");

    if (isset($obj["error"]))
        die("<p>" . $obj->error . "</p></body></html>");

    echo "<table>";
    echo "<tr><th>Código</th><th>Nombre Corto</th><th>PVP</th><th><form action='index.php' method='post'><button class='enlace' name='btnCrearProducto'>Producto+</button></form></th></tr>";

    foreach ($obj["productos"] as $tupla) {
        echo "<tr>";
        echo "<td><form action='index.php' method='post'><button class='enlace' name='btnInfoProducto' value='" . $tupla[$cod] . "'>" . $tupla["cod"] . "</button></form></td>";
        echo "<td>" . $tupla["nombre_corto"] . "</td>";
        echo "<td>" . $tupla["PVP"] . "</td>";
        echo "<td><form action='index.php' method='post'><button class='enlace' name='btnBorrar' value='" . $tupla[$cod] . "'>Borrar</button> - <button class='enlace' name='btnEditar' value='" . $tupla[$cod] . "'>Editar</button></form></td>";
        echo "</tr>";
    }

    echo "</table>";
    ?>
</body>

</html>