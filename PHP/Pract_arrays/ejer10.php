<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 10</title>
</head>
<body>
    <h1>Ejercicio de medias</h1>
    <?php 
        $array_enteros = array();
        const N_PARES = 10;
        $media = 0;
        for ($i = 1; $i <= N_PARES; $i++) {
            $array_enteros[] = $i;
            if ($i % 2 == 0)
                $media += $i;

                
        }

        echo "<p>La media de los números pares es: " . $media / 2 . "</p>";
            

    ?>
</body>
</html>