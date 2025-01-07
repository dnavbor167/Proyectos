<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría de fechas en PHP</title>
</head>
<body>
    <h1>Teoría de Fechas</h1>

    <?php
        //time() te dice los segundos que ha pasado desde enero de 1970 
        echo "<p>".time()."</p>";

        //date() le paso un string (formato de fecha) y un número (el número de segundos y se convierte en fecha) 
        //y = año corto Y = año largo
        //si quiero la fecha actual en el número pongo la función time()
        //si no le pongo el segundo argumento o parámetro, me pone el time() por defecto
        $fecha = date("d/m/Y H:i:s",time());
        echo "<p>".$fecha."</p>";
        echo "<p>".date("d/m/Y H:i:s")."</p>";
        
        //checkdate(month, day, year), devuelve si existe o no la fecha (True or False)

        if (checkdate(2, 29, 2004)) {
            echo "<p>La fecha existe</p>";
        } else {
            echo "<p>La fecha no existe</p>";
        }

        //mktime(hour, minutes, seconds, month, day, year) te devuelve cuantos segundos han pasado desde 1970, tiene 6 argumenos
        echo "<p>".mktime(0, 0, 0, 4, 27, 2004)."</p>";
        echo "<p>".date("d/m/Y",1083016800)."</p>";

        //strtotime() parecido a mktime
        //el orden de los prámetros strtotime("m/d/y") o strtotime("y/m/d")
        echo "<p>".strtotime("2007/04/27")."</p>";

        //Para calcular el valor absoluto
        echo "<p>".abs(-8)."</p>";

        //Trunca para abajo
        echo "<p>".floor(9.67)."</p>";

        //Trunca para arriba
        echo "<p>".ceil(9.67)."</p>";
    ?>
</body>
</html>