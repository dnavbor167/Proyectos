<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3 POO</title>
</head>
<body>
    <h1>Ejercicio 3 POO</h1>
    <?php 
    require 'class_fruta.php';

    echo "<h2>Información de mis frutas</h2>";
    echo "<p>Frutas creadas hasta el momento: ".Fruta::cuantaFruta()."</p>";
    $pera = new Fruta("Verde", "Mediano");
    $melon = new Fruta("Amarillo", "Grande");
    echo "<p>Frutas creadas hasta el momento: ".Fruta::cuantaFruta()."</p>";
    //unset($melon);
    $melon = null;
    echo "<p>Frutas creadas hasta el momento: ".Fruta::cuantaFruta()."</p>";

    ?>
</body>
</html>