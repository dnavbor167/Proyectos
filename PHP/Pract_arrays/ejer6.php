<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
</head>
<body>
    <?php 
        $ciudades[] = "Madrid";
        $ciudades[] = "Barcelona";
        $ciudades[] = "Londres";
        $ciudades[] = "New York";
        $ciudades[] = "Los Ángeles";
        $ciudades[] = "Chicago";

        foreach($ciudades as $key=>$value)
            echo "<p>La ciudad con el indice " . $key . " tiene el nombre de " . $value . "</p>";

        
    ?>
</body>
</html>