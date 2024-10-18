<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
    <style>
        .error {
            color: red;
        }

        table,
        th,
        td {
            border: solid 1px black;
            padding: 0.6em;
        }

        table {
            width: 80%;
            margin: 0;
            border-collapse: collapse;
            margin-top: 2em;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php 
        @$file = fopen("http://dwese.icarosproject.com/PHP/datos_ficheros.txt", "r");
        if (!$file) {
            die("<p class='error'>Error al cargar el fichero</p>");
        }
        $linea = fgets($file);
        $datos_primera_linea = explode("\t",$linea);
    ?>
    <form action="ejer6MiguelÁngel.php" method="post" entype="multipart/form-data">
        <label for="pais">Seleccione el paía para ver el PIB</label>
        <select name="pais" id="pais">
            <?php
            $contador = 1;
            while($linea = fgets($file)) {
                $datos_linea = explode("\t",$linea);
                $datos_primera_columna = explode(",",$datos_linea[0]);
                 
                if(isset($_POST["pais"]) && $_POST["pais"] == $contador) {
                    echo "<option selected value='".$contador."'>".end($datos_primera_columna)."</option>";
                    $datos_a_mostrar = $datos_linea;
                    $pais_seleccionado = end($datos_primera_columna);
                } else {
                    echo "<option value='".$contador."'>".end($datos_primera_columna)."</option>";
                }
                $contador++;
            }            
            fclose($file);
            ?>
        </select>
        <br>
        <button type="submit" name="btnPib">Mostrar PIB</button>
    </form>

    <?php
    if (isset($_POST["btnPib"])) {
        //hay una mejora y esque no lo abro de nuevo para buscar la línea
        $n_col = count($datos_primera_linea);
        echo "<h1>Per por cápita de ".$_POST["pais"]."</h1>";
        echo "<table>";
        echo "<tr>";
        for ($i=0; $i < $n_col; $i++) { 
            echo "<th>".$datos_primera_linea[$i]."</th>";
        }
        echo "</tr>";
        echo "<tr>";
        for ($i=0; $i < $n_col; $i++) { 
            if(isset($datos_a_mostrar[$i])) {
                echo "<td>".$datos_a_mostrar[$i]."</td>";
            } else {
                echo "<td></td>";
            }
        }
        echo "</tr>";
        echo "</table>";
    }
    ?>
</body>

</html>