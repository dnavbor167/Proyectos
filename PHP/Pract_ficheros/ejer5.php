<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5</title>
    <style>
        .error{color:red;}
        table,th,td{border:solid 1px black;padding: 0.6em;rem;}
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
        $contador_primera_linea = 0;
        $contador_linea = 0;

        while ($linea = fgets($file)) {
            $linea_separada = explode("\t", $linea);

            if ($contador_linea == 0) {
                echo "<tr>";
                for ($i = 0; $i < count($linea_separada); $i++) {
                        echo "<th>".$linea_separada[$i]."</th>";
                        $contador_primera_linea++;
                }
            echo "</tr>";
            } else {
                echo "<tr>";
                for($j = 0; $j < $contador_primera_linea; $j++) {
                    if ($j == 0) {
                        echo "<th>".$linea_separada[$j]."</th>";
                    } else {
                        echo "<td>".$linea_separada[$j]."</td>";
                    }
                }
            echo "</tr>";
            }
            $contador_linea++;

            

        }
        echo "</table>";
        fclose($file);
    ?>
</body>
</html>