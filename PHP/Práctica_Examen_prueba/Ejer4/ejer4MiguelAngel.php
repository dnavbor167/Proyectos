<?php
if (isset($_POST["btnSubir"])) {
    $error_fichero = $_FILES["fichero"]["error"] || $_FILES["fichero"]["type"] != "text/plain" || $_FILES["fichero"]["size"] > 1000 * 1024;
}
?>
<?php
function extension_txt($archivo)
{
    $sep = explode(".", $archivo);
    if (count($sep) <= 1) {
        $extension = false;
    } else {
        $extension = strtolower(end($sep));
    }
    return $extension;
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
    <title>Ejercicio 4</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Ejercicio 4</h1>
    <form action="ejer4.php" method="post" enctype="multipart/form-data">
        <?php
        if (isset($_POST["btnSubir"]) && !$error_fichero) {
            echo "<h2>Respuesta</h2>";
            @$var = move_uploaded_file($_FILES["fichero"]["tmp_name"], "Horario/horarios.txt");
            if (!$var) {
                echo "<span class='error'>* Error al cargar el fichero *</span>";
            }
        }

        @$fd = fopen("Horario/horarios.txt", "r");
        if ($fd) {
            echo "<h2>Horario de los profesores</h2>";
        ?>
        <form action="ejer4MiguelAngel.php" method="post" enctype="multipart/form-data">
            <label for="profesores">Horario del profesor: </label>
            <select name="profesor" id="profesor">
                <?php 
                    while ($linea = fgets($fd)) {
                        $opcion = explode("\t", $linea);
                        
                        echo "<option value='".$opcion[0]."'>".$opcion[0]."</option>";
                    }
                ?>
            </select>
            <button type="button" name="btnVer">Ver horario</button>
        </form>
        <?php
            fclose($fd);
        } else {
            echo "<h2>No se encuentra el fichero <em>Horario/horarios.txt</em></h2>";
        ?>

            <form action="ejer4MiguelAngel.php" method="post" enctype="multipart/form-data">
                <label for="fichero">Introduzca un fichero de texto (Máx 1MB)</label>
                <input type="file" name="fichero" id="fichero" accept=".txt">
                <?php
                if (isset($_POST["btnSubir"]) && $error_fichero) {
                    if ($_FILES["fichero"]["name"] == "") {
                        echo "<span class='error'>* Debe seleccionar un fichero *</span>";
                    } else if ($_FILES["fichero"]["error"]) {
                        echo "<span class='error'>* Error al subir el fichero al servidor *</span>";
                    } else if ($_FILES["fichero"]["type"] != "text/plain") {
                        echo "<span class='error'>* Debe seleccionar un fichero TXT *</span>";
                    } else {
                        echo "<span class='error'>* Debe seleccionar un fichero de 1MB como máximo *</span>";
                    }
                }
                ?>
                <button type="submit" name="btnSubir">Subir</button>
            </form>
        <?php
        }
        ?>
    </form>
</body>

</html>