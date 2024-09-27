<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 12</title>
</head>
<body>
    <h1>Ejercicio 12</h1>
    <?php 
        $primer_array[] = "Lagartija";
        array_push($primer_array, "Araña", "Perro", "Gato", "Ratón");

        $segundo_array[] = "12";
        array_push($segundo_array, "34", "45", "52", "12");

        $tercero_array[] = "Sauce";
        array_push($tercero_array, "Pino", "Naranjo", "Chopo", "Perro", "34");

        $array_nuevo = array_merge($primer_array, $segundo_array, $tercero_array);

        foreach($array_nuevo as $value)
            echo "<p>" . $value . "</p>";
    ?>
</body>
</html>