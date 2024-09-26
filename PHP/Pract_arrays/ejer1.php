<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<body>
    <?php
        //definir constantes, PONEMOS EL NOMBRE ENTRE COMILLAS Y LUEGO EL VALOR Y LUEGO SE USA SIN COMILLAS
        //otra forma es const N_PARES = 30; USO ESTE
        define("N_PARES", 10);
        for ($i = 0;$i < N_PARES;$i++)
            $num_pares[] = $i * 2;

        echo "<h1>Los " . N_PARES . " primeros números</h1>";
        for ($i = 0;$i < N_PARES; $i++)
            echo "<p>" . $num_pares[$i] . "</p>";
    ?>
</body>
</html>