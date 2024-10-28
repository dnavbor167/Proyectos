<?php
if (isset($_POST["btnSubir"])) {
    $error_fichero = $_FILES["fichero"]["error"] || $_FILES["fichero"]["type"] != "text/plain" || $_FILES["fichero"]["size"] > 1024 * 1024;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
</head>

<body>
    <h1>Ejercicio 4</h1>

    <?php
    @$fichero = fopen("Horario/horarios.txt", "r");

    if (!$fichero) {
    ?>
        <h2>No se encuentra el archivo <em>Horario\horarios.txt</em></h2>
        <form action="ejercicio4.php" method="post" enctype="multipart/form-data">
            <label for="fichero">Introduzca el fichero (Máx 1MB y txt): </label>
            <input type="file" name="fichero" id="fichero" accept=".txt">
            <?php
            if ($error_fichero) {
                if ($_FILES["fichero"]["name"] == "") {
                    echo "<span class='error'>* Debe seleccionar un fichero *</span>";
                } else if ($_FILES["fichero"]["type"] != "text/plain") {
                    echo "<span class='error'>* Debe seleccionar un fichero txt *</span>";
                } else {
                    echo "<span class='error'>* Debe seleccionar un fichero txt de hasta 1MB*</span>";
                }
            }
            ?>
            <br><br>
            <button type="submit" name="btnSubir">Subir</button>
        </form>
        <?php
        if (isset($_POST["btnSubir"]) && !$error_fichero) {
            echo "<h2>Respuesta</h2>";
            @$fichero = move_uploaded_file($_FILES["fichero"]["tmp_name"], "Horario/horarios.txt");

            if (!$fichero) {
                echo "<p class='error'>Error al subir el fichero al servidor</p>";
            } else {
                echo "<p id='correcto'>Fichero subido con éxito</p>";
            }
        }
        ?>
    <?php
    } else {
    ?>
        <h2>Horario de los Profesores</h2>
        <label for="profesores">Horario del profesor: </label>
        <select name="profesores" id="profesores">
            <?php
            while ($linea = fgets($fichero)) {
                $datos_linea = explode("\t", $linea);
                if (isset($_POST["btnHorario"]) && $datos_linea[0] == $_POST["profesores"]) {
                    echo "<option selected value='" . $datos_linea[0] . "'>" . $datos_linea[0] . "</option>";
                    
                } else {
                    echo "<option value='" . $datos_linea[0] . "'>" . $datos_linea[0] . "</option>";
                }
            }
            ?>
        </select>
        <button type="submit" name="btnHorario">Ver Horario</button>
    <?php

        if (isset($_POST["btnHorario"])) {
            for ($i = 1; $i < count($datos_linea); $i+=3) {
                
            }
        }
        fclose($fichero);
    }
    ?>
</body>

</html>