El txt viene primero el nombre, luego vienen de tres en tres los datos de los profesores (dia, hora, grupo)
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
        $ruta_archivo = "Horario/horario.txt";
        @$file = fopen($ruta_archivo, "r");
        //Si existe el boton subir y no hay errores significa que la dirección ha cambiado
        if (isset($_POST["btnSubir"]) && !$error_fichero) {
            if ($_FILES["fichero"]["name"] == "horarios.txt") {
                @$file = fopen($_FILES["fichero"]["tmp_name"], "r");
            } else {
                echo "<h2>Error: El archivo seleccionado no es 'Horario/horarios.txt'</h2>";
                echo "<label for='fichero'>Seleccione el archivo correcto: </label>";
                echo "<input type='file' name='fichero' id='fichero' accept='.txt'>";
                die("<button type='submit' name='btnSubir'>subir</button>");
            }
        }

        if (!$file) {
            echo "<h2>No se encuentra el archivo " . $file . "</h2>";
            echo "<label for='fichero'>Seleccione un archivo txt no superior a 1MB: </label>";
            echo "<input type='file' name='fichero' id='fichero' accept='.txt'>";
            if (isset($_POST["btnSubir"]) && $error_fichero) {
                if ($_FILES["fichero"]["name"] == "") {
                    echo "<span class='error'>* Debes introducir un fichero *</span>";
                } else if ($_FILES["fichero"]["error"]) {
                    echo "<span class='error'>* Error al subir el fichero al servidor *</span>";
                } else if (!extension_txt($_FILES["fichero"]["name"])) {
                    echo "<span class='error'>* Debes introducir un fichero txt *</span>";
                } else {
                    echo "<span class='error'>* Debes introducir un fichero de máximo 1MB *</span>";
                }
            }
            echo "<br>";
            die("<button type='submit' name='btnSubir'>subir</button>");
        }
        
        //Si existe el fichero lo procesamos
        echo "<h2>Horario de los profesores</h2>";
        echo "<label for='horario'>Horario del profesor: </label>";
        while ($linea = fgets($file)) {
            $nombre
        }

        fclose($file);
        ?>
    </form>
</body>

</html>