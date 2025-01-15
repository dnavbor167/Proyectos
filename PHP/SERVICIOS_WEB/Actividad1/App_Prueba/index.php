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

//controlamos los errores del formulario
if (isset($_POST["btnInsertar"])) 
    $error_form = $_POST["cod"] = "" || $_POST["nombre"] = "" || $_POST["nombre_corto"] = "" || $_POST["descripcion"] = "" || $_POST["pvp"] = "" || $_POST["familia"] = "";

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba de los Servicios Actividad 1</title>
</head>

<body>
    <h1>Productos de la Tienda</h1>
    <?php
    //Ejercicio A
    $url = DIR_SERV . "/productos";
    $respuesta = consumir_servicios_REST($url, "GET");
    //Si le pongo true en json_decode en vez de hacerme el array como si fuese un objeto, lo pone como array asociativo
    //en vez de llamarlo como $obj->error se llamaría como $obj["error"]
    $obj = json_decode($respuesta, true);
    if(!$obj)
        die("<p>Error consumiendo el servicio web <strong>".$url."</strong></p></body></html>");

    if(isset($obj["error"])) 
        die("<p>".$obj->error."</p></body></html>");

    echo "<table>";
    echo "<tr><th>Código</th><th>Nombre Corto</th><th>PVP</th></tr>";

    foreach($obj["productos"] as $tupla){
        echo "<tr>";
        echo "<td>".$tupla["cod"]."</td>";
        echo "<td>".$tupla["nombre_corto"]."</td>";
        echo "<td>".$tupla["PVP"]."</td>";
        echo "</tr>";
    }

    echo "</table>";

    // Ejercicio C
    $url = DIR_SERV . "/producto/insertar";
    $respuesta = consumir_servicios_REST($url, "POST");

    echo '<form action="index.php" method="post" placeholder="">';
    echo '<input type="text" name="cod" id="cod">';
    echo '<input type="text" name="nombre" id="nombre">';
    echo '<input type="text" name="nombre_corto" id="nombre_corto">';
    echo '<input type="text" name="descripcion" id="descripcion">';
    echo '<input type="text" name="pvp" id="pvp">';
    echo '<input type="text" name="familia" id="familia">';
    echo '<button type="submit" name="btnInsertar">Insertar</button>';
    ?>
   
    </form>
</body>

</html>