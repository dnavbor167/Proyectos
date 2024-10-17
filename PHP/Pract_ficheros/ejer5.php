<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5</title>
    <style>.error{color:red;}</style>
</head>
<body>
    <?php 
        @$file = fopen("http://dwese.icarosproject.com/PHP/datos_ficheros.txt","r");
        
        if (!$file) {
            die("<p class='error'>Error al cargar el fichero</p>");
        }
        
        echo "<table>";
        $contador_linea = 0;
        $contador_fila = 0;
        while ($linea = fgets($file)) {
            $linea_separada = explode("\t", $linea);

            for ($i = 0; $i < count($linea_separada); $i++) {
                if ($contador_linea == 0 || $contador_fila == 0) {
                    echo "<th>".$linea_separada[$i]."</th>";
                }
                $contador_fila++;

                
            }

            $contador++;
        }
        echo "</table>";
        fclose($file);
    ?>
</body>
</html>