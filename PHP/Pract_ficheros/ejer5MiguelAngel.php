<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5</title>
    <style>
        .error{color:red;}
        table,th,td{border:solid 1px black;padding: 0.6em;}
        table{width:80%;margin:0;border-collapse:collapse;margin-top:2em;text-align: center;}
    </style>
</head>
<body>
    <?php 
        @$file = fopen("http://dwese.icarosproject.com/PHP/datos_ficheros.txt","r");
        
        if (!$file) {
            die("<p class='error'>Error al cargar el fichero</p>");
        }
        
        echo "<table>";
        echo "<caption>PIB per cápita de los países de la Unión Europea</caption>";
        $linea = fgets($file);
        $datos_linea = explode("\t", $linea);
        $n_col = count($datos_linea);
        echo "<tr>";
        for ($i=0; $i < $n_col; $i++) { 
            echo "<th>".$datos_linea[$i]."</th>";
        }
        echo "</tr>";

        while($linea = fgets($file)) {
            $datos_linea = explode("\t", $linea);
            echo "<tr>";
            echo "<th>".$datos_linea[0]."</th>";
            for ($i=1; $i < $n_col; $i++) { 
                if(isset($datos_linea[$i])) {
                    echo "<td>".$datos_linea[$i]."</td>";
                } else {
                    echo "<td></td>";
                }
            }
            echo "</tr>";
        }
        echo "</table>";
        
        fclose($file);
    ?>
</body>
</html>