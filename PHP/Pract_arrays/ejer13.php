<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 13</title>
</head>
<body>
    <h1>Ejercicio 13</h1>
    <?php 
        $primer_array[] = "Lagartija";
        array_push($primer_array, "Araña", "Perro", "Gato", "Ratón");

        $segundo_array[] = "12";
        array_push($segundo_array, "34", "45", "52", "12");

        $tercero_array[] = "Sauce";
        array_push($tercero_array, "Pino", "Naranjo", "Chopo", "Perro", "34");

        $array_nuevo = array_merge($primer_array, $segundo_array, $tercero_array);

        //Se puede hacer de la siguiente forma:
        //$array_inverso = array_reverse($array_nuevo);
        for ($i = count($array_nuevo) - 1; $i >= 0; $i--) {
            echo "<p>" . $array_nuevo[$i] . "</p>";
        }

    ?>
</body>
</html>