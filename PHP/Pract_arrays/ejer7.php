<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 7</title>
</head>
<body>
    <?php 
        $ciudades["MD"] = "Madrid";
        $ciudades["BC"] = "Barcelona";
        $ciudades["LN"] = "Londres";
        $ciudades["NY"] = "New York";
        $ciudades["AN"] = "Los Ángeles";
        $ciudades["CG"] = "Chicago";

        foreach($ciudades as $key=>$value)
            echo "<p>El índice del array que contiene como valor " . $value . " es " . $key . "</p>";
    ?>
</body>
</html>