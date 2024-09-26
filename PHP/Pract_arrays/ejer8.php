<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 8</title>
</head>
<body>
    <?php 
        $nombres[] = "Pedro";
        $nombres[] = "Ismael";
        $nombres[] = "Sonia";
        $nombres[] = "Clara";
        $nombres[] = "Susana";
        $nombres[] = "Alfonso";
        $nombres[] = "Teresa";

        echo "<p>El número de elementos que contiene el array es de " . count($nombres) ."</p>";
        echo "<ul>";
        foreach($nombres as $value) 
            echo "<li>" . $value . "</li>";
        echo "</ul>";
    ?>
</body>
</html>