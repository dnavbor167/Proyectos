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
    <title>Ejercicio 2</title>
    <style>
        .error {
            color:red;
        }
        #correcto {
            color:green;
        }
    </style>
</head>
<body>
    <form action="ejercicio2.php" method="post" enctype="multipart/form-data">
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
            @$fichero = move_uploaded_file($_FILES["fichero"]["tmp_name"], "Ficheros/archivo.txt");

            if (!$fichero) {
                echo "<p class='error'>Error al subir el fichero al servidor</p>";
            } else {
                echo "<p id='correcto'>Fichero subido con éxito</p>";
            }
        }
    ?>
</body>
</html>