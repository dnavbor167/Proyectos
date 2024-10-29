<?php
const DIAS = ["", "Lunes", "Martes", "Miercoles", "Jueves", "viernes"];
const HORAS = ["", "8:15-9:15", "9:15-10:15", "10:15-11:15", "11:15-11:45", "11:45-12:45", "12:45-13:45", "13:45-14:45"];
//Control de errores
if (isset($_POST["btnSubir"])) {
    $error_fichero = $_FILES["fichero"]["error"] || $_FILES["fichero"]["type"] != "text/plain" || $_FILES["fichero"]["size"] > 500 * 1024;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
    <style>
        .error {
            color: red;
        }

        textarea {
            height: 500px;
            width: 600px;
        }

        h3 {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            margin: 0 auto;
        }

        table,
        td,
        th {
            border: solid 1px black;
            padding: 1rem;
        }
    </style>
</head>

<body>
    <h1>Ejercicio 4</h1>
    <?php
    @$fc = fopen("Aulas/aulas.txt", "r");

    if (!$fc) {
    ?>
        <h2>No se encuentra el fichero <em>Aulas/aulas.txt</em></h2>
        <form action="ejercicio4.php" method="post" enctype="multipart/form-data">
            <label for="fichero">Seleccione un fichero de texto plano para agregar el fichero aulas.txt (Máx. 500KB) </label>
            <input type="file" name="fichero" id="fichero">
            <?php
            if (isset($_POST["btnSubir"]) && $error_fichero) {
                if ($_FILES["fichero"]["name"] == "") {
                    echo "<span class='error'>Debes introducir un ficihero de texto</span>";
                } else if ($_FILES["fichero"]["type"] != "text/plain") {
                    echo "<span class='error'>Debes introducir un ficihero TXT</span>";
                } else {
                    echo "<span class='error'>Debes introducir un ficihero no mayor de 500KB</span>";
                }
            }
            ?>
            <br><br>
            <button type="submit" name="btnSubir">Subir</button>
        </form>
    <?php
    } else {
        //Mostramos formulario para que el usuario escoja en un section que día de la semana quiere
    ?>
        <h2>Aulas Libres</h2>
        <form action="ejercicio4.php" method="post">
            <label for="libre">Seleccione una semana: </label>
            <select name="libre" id="libre">
                <?php
                $contendo = file_get_contents("Aulas/aulas.txt");
                $semanas_separadas = explode("\n", $contendo);
                //como las semanas tienen exactamente 5 días incremento en 6 para coger el valor de la semana
                for ($i = 0; $i < count($semanas_separadas); $i += 6) {
                    if ($semanas_separadas[$i] != "")
                        $nombre_semanas[] = explode(";", $semanas_separadas[$i]);
                }
                //lo muestro en un option
                for ($i = 0; $i < count($nombre_semanas); $i++) {
                    if (isset($_POST["btnVer"]) && $_POST["libre"] == $nombre_semanas[$i][0])
                        echo "<option selected value='" . $nombre_semanas[$i][0] . "'>" . $nombre_semanas[$i][0] . "</option>";
                    else {
                        echo "<option value='" . $nombre_semanas[$i][0] . "'>" . $nombre_semanas[$i][0] . "</option>";
                        $semana_concreta = $nombre_semanas[$i];
                    }
                }
                ?>
            </select>
            <button type="submit" name="btnVer">Ver Semana</button>
        </form>
    <?php
        if (isset($_POST["btnVer"])) {
            echo "<h3>" . $semana_concreta[1] . "</h3>";

            echo "<table>";
            echo "<tr>";
            for ($i = 0; $i < count(DIAS); $i++) {
                echo "<th>" . DIAS[$i] . "</th>";
            }
            echo "</tr>";


            for ($j = 1; $j < count(HORAS); $j++) {
                echo "<tr>";
                echo "<th>" . HORAS[$j] . "</th>";
                for ($y = 0; $y < count(DIAS) - 1; $y++) {
                    if ($j == 4)
                        echo "<td colspan='5'></td>";
                    else
                        echo "<td></td>";
                }
                echo "</tr>";
            }

            echo "</table>";
        }
        fclose($fc);
    }

    ?>
</body>

</html>