<?php
echo "<div class='centrado'>";
echo "<h2>Información del Producto: " . $_POST["btnDetalles"] . "</h2>";
if (isset($json_detalles["mensaje"]))
    echo "<p>El producto seleccionado ya no se encuentra en la BD</p>";
else {
    echo "<p>";
    echo "<strong>Nombre: </strong>" . $json_detalles["producto"]["nombre"] . "<br/>";
    echo "<strong>Nombre corto: </strong>" . $json_detalles["producto"]["nombre_corto"] . "<br/>";
    echo "<strong>Descripción: </strong>" . $json_detalles["producto"]["descripcion"] . "<br/>";
    echo "<strong>PVP: </strong>" . $json_detalles["producto"]["PVP"] . " €<br/>";
    echo "<strong>Familia: </strong>" . $json_detalles["producto"]["nombre_familia"];
    echo "</p>";
}
echo "<form action='index.php' method='post'><button>Volver</button></form>";
echo "</div>";
