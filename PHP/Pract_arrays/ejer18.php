<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 18</title>
</head>
<body>
    <h1>Ejercicio 18</h1>
    <?php 
        $deportes = ["fútbol", "baloncesto", "natación", "tenis"];

        //mostramos sus valores con un for
        for ($i = 0; $i < count($deportes); $i++) {
            echo "<p>" . $deportes[$i] . "</p>";
        }

        //mostramos el valor total que contiene este array
        echo "<p>El valor total que contiene este array es de " . count($deportes) . " elementos</p>";

        //mostramos el valor actual del puntero
        echo "<p>El valor actual del puntero es " . current($deportes) . "</p>";

        //avanzamos una posición y mostramos el valor actual
        echo "<p>El valor siguiente del puntero es " . next($deportes) . "</p>";

        //colocamos el puntero en la última posición y lo mostramos
        echo "<p>El valor de la última posición es " . end($deportes) . "</p>";

        //retrocedemos una posición y lo mostramos
        echo "<p>El valor anterior de la última posición es " . prev($deportes) . "</p>";
    ?>
</body>
</html>