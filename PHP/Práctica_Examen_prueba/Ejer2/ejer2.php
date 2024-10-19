<?php 
    function extension_txt($archivo) {
        $extension = explode(".",$archivo);
        if (count($extension) <= 1) {
            $respuesta = false;
        } else {
            $respuesta = strtolower(end($extension)) == "txt";
        }
        return $respuesta;
    }
    if (isset($_POST["btnSubir"])) {
        $error_fichero = $_FILES["fichero"]["error"] || !extension_txt($_FILES["fichero"]["name"]) || $_FILES["fichero"]["size"] > 1024 * 1024;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
    <style>
        .error {color:red;}
        .correcto{color:green;}
    </style>
</head>
<body>
    <form action="ejer2.php" method="post" enctype="multipart/form-data">
        <label for="fichero">Introduzca un fichero de texto (Máx 1MB)</label>
        <input type="file" name="fichero" id="fichero" accept=".txt">
        <?php 
            if (isset($_POST["btnSubir"]) && $error_fichero) {
                if ($_FILES["fichero"]["name"] == "") {
                    echo "<span class='error'>* Debe seleccionar un fichero *</span>";
                } else if ($_FILES["fichero"]["error"]) {
                    echo "<span class='error'>* Error al subir el fichero al servidor *</span>";
                } else if (!extension_txt($_FILES["fichero"]["name"])) {
                    echo "<span class='error'>* Debe seleccionar un fichero TXT *</span>";
                } else {
                    echo "<span class='error'>* Debe seleccionar un fichero de 1MB como máximo *</span>";
                }
            }
        ?>
        <button type="submit" name="btnSubir">Subir</button>
    </form>

    <?php 
        if (isset($_POST["btnSubir"]) && !$error_fichero) {
            @$var = move_uploaded_file($_FILES["fichero"]["tmp_name"], "Ficheros/archivo.txt");
            if (!$var) {
                echo "<span class='error'>* Error al cargar el fichero *</span>";
            } else {
                echo "<p class='correcto'>Fichero subido correctamente</p>";
            }
        }
    ?>
</body>
</html>