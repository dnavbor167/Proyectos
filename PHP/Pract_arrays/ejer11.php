<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 11</title>
</head>
<body>
    <h1>Ejercicio merge</h1>
    <?php 
        $primer_array[] = "Lagartija";
        $primer_array[] = "Araña";
        $primer_array[] = "Perro";
        $primer_array[] = "Gato";
        $primer_array[] = "Ratón";

        $segundo_array[] = "12";
        $segundo_array[] = "34";
        $segundo_array[] = "45";
        $segundo_array[] = "52";
        $segundo_array[] = "12";

        $tercero_array[] = "Sauce";
        $tercero_array[] = "Pino";
        $tercero_array[] = "Naranjo";
        $tercero_array[] = "Chopo";
        $tercero_array[] = "Perro";
        $tercero_array[] = "34";

        $nuevo_array = array_merge($primer_array, $segundo_array, $tercero_array);

        foreach($nuevo_array as $value)
            echo "<p>" . $value . "</p>";
    ?>
</body>
</html>