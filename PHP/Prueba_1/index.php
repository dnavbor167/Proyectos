<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primera web PHP</title>
</head>
<body>
    <?php
        $texto1 = "Juan";
        $texto2 = "María";
        $a = 8;
        $b = 10;
        echo "<h1>Mi primera web PHP</h1>";
        echo "<p>Hello, this is an a p</p>";
        //El punto es para concatenar, RECALCAR QUE SIEMPRE SE TERMINA CON ;
        echo "<p> Hola " . $texto1 . " Y " . $texto2 . ", y adios</p>";
        //Puede funcionar sin paréntesis, pero mejor siempre ponerlos
        echo "<p>El resultado de sumar " . $a . " + " . $b . " es igual a " . ($a+$b) . "</p>";

        // la variable $p no está inicializada, pero no da error, lo pone como valor de 0
        //para saber si una variable está inicializada:
        if(isset($p) && 5==5 || 7<=8) {
            $c = $p + $a;
        } elseif(6==8) {
            $c = 15;
        } else {
            echo "<p>Entraste en el else</p>";
        }

        //Estructura switch:
        switch($a) {
            case $a<1:

                break;
            case $a<2:

                break;
            default: ;
        }


        //Si entre las llaves de un if o un bucle solo hay una linea o una sentencia, no hace falta poner llave {}
        if ($a+$b >10) {
            echo "<p>La suma de a + b es mayor que 10</p>";
        } else
            echo "<p>La suma de a + b NO es mayor que 10</p>";

        echo "<p>Esto lo escribe siempre</p>";


        //Funcion for:
        for ($i = 0; $i < 10; $i++) {
            echo "<span>" . $i ."</span>";
        }
        //La i sale después del bucle con el último valor que ha obtenido
        echo "<p>Después del bucle for la i vale " . $i . "</p>";

        //Funcion while:
        //siempre hay que inicializar antes del while la variable
        $i = 0;
        while ($i < 5) {
            echo "<span>" . $i ."</span>";
            $i++;
        }
    ?>
</body>
</html>