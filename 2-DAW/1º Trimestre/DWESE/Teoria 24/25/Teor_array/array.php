<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría arrays php</title>
</head>
<body>
    <?php 

        //En un array se puede usar más de un tipo 4, 0.4, String etc
        $nota6[0] = 5;
        $nota6[1] = 5.6;
        $nota6[0] = "Hola";

        $nota[0] = 5;
        $nota[1] = 12;
        $nota[2] = 9;
        $nota[3] = 8;
        $nota[4] = 7;
        $nota[5] = 6;

        echo "<p>El número de elementos que tiene el array nota es: " . count($nota) . "</p>";

        echo "<h2>Elementos del array nota</h2>";
        echo "<ol>";
        
        for ($i = 0; $i < count($nota); $i++) {
            echo "<li>" . $nota[$i] . "</li>";
        }

        echo "</ol>";

        //impresión general:
        //var_dump($nota);

        //echo "<br>";
        //Para imprimir los array usamos print_r
        //print_r($nota);

        //si no ponemos entre [] ningún número coge el siguiente
        //se puede poner $nota[13] y lo demas no lo usamos
        //sigue con $nota[14] etc (no se suele usar).
        //se pueden poner arrays escalar y asociativo
        //$nota[13] = 5;
        //$nota[] = 12;
        //$nota[] = 9;
        //$nota["Juan"] = 8;
        //$nota[] = 7;
        //$nota[] = 6;

        //echo "<br>";
        //print_r($nota);

        $nota1 = array(5,9,8,5,6,7);
        
        echo "<h2>Elementos del array nota1</h2>";
        echo "<ol>";
        
        for ($i = 0; $i < count($nota1); $i++) {
            echo "<li>" . $nota1[$i] . "</li>";
        }

        echo "</ol>";

        $nota3[13] = 5;
        $nota3[] = 12;
        $nota3[] = 9;
        $nota3["Juan"] = 8;
        $nota3[] = 7;
        $nota3[] = 6;

        echo "<h2>Elementos del array nota3</h2>";
        echo "<ul>";
        
        //si solo quiero el valor sería ($nota3 as $valor)
        //de la siguiente forma podemos coger la clave y el valor:
        foreach ($nota3 as $key=>$valor) {
            echo "<li>Clave: " . $key ." Valor:" . $valor . "</li>";
        }

        echo "</ul>";

        //Especificar la posición y el valor de un array array(posición=>valor)
        $nota4 = array(0=>1,1=>4,9=>6);

    ?>
</body>
</html>