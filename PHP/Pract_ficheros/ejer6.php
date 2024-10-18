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
    <form action="ejer6.php" method="post" entype="multipart/form-data">
        <label for="pais">Seleccione el paía para ver el PIB</label>
        <select name="pais" id="pais">
            <?php
            @$file = fopen("http://dwese.icarosproject.com/PHP/datos_ficheros.txt", "r");
            if (!$file) {
                die("<p class='error'>Error al cargar el fichero</p>");
            }
            $identificador_pais = 0;
            while ($linea = fgets($file)) {
                $array_separado_comas = explode(",", $linea);
                $array_separado_tabuladores = explode("\t", $array_separado_comas[2]);
                $letra_pais = $array_separado_tabuladores[0];
                if ($identificador_pais != 0) {
                    echo "<option value='" . $identificador_pais . "'>" . $letra_pais . "</option>";
                }
                $identificador_pais++;
            }
            fclose($file);

            ?>
        </select>
        <button type="submit" name="btnPib">Mostrar PIB</button>
    </form>

    <?php
    if (isset($_POST["btnPib"])) {
        @$file = fopen("http://dwese.icarosproject.com/PHP/datos_ficheros.txt", "r");

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
                    echo "<th>" . $linea_separada[$i] . "</th>";
                    $contador_primera_linea++;
                }
                echo "</tr>";
            } else {
                echo "<tr>";
                for ($j = 0; $j < $contador_primera_linea; $j++) {
                    if ($contador_linea == $_POST["pais"]) {
                        if ($j == 0) {
                            echo "<th>".$linea_separada[$j]."</th>";
                        } else {
                            echo "<td>".$linea_separada[$j]."</td>";
                        }
                    }
                }
                echo "</tr>";
            }
            $contador_linea++;
        }
        echo "</table>";
        fclose($file);
    }
    ?>
</body>

</html>