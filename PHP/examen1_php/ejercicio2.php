<?php
$nombre_ficheros["semana1.txt"] = 0;
$nombre_ficheros["semana2.txt"] = 0;
$nombre_ficheros["semana3.txt"] = 0;
$nombre_ficheros["semana4.txt"] = 0;
//Control de errores
if (isset($_POST["btnAgregar"])) {
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
    </style>
</head>

<body>
    <h1>Ejercicio 2</h1>
    <form action="ejercicio2.php" method="post" enctype="multipart/form-data">
        <label for="fichero">Seleccione un fichero de texto plano para agregar el fichero aulas.txt (Máx. 500KB) </label>
        <input type="file" name="fichero" id="fichero">
        <?php
        if (isset($_POST["btnAgregar"]) && $error_fichero) {
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
        <button type="submit" name="btnAgregar">Agregar</button>
        <button type="submit" name="btnCrear">Crear/Vaciar</button>
    </form>

    <?php
    if (isset($_POST["btnCrear"])) {
        //Creamos el fichero llamado aulas.txt 
        @$cf = fopen("Aulas/aulas.txt", "w");
        if (!$cf)
            echo "<p class='error'>Fichero <em>'aulas.txt'</em> no ha sido creado</p>";
        else {
            echo "<p><strong>Fichero <em>'aulas.txt'</em> creado/vaciado con éxito</strong></p>";
            fclose($cf);
        }
    }

    if (isset($_POST["btnAgregar"]) && !$error_fichero) {
        @$af = fopen("Aulas/aulas.txt", "a");
        if (!$af) {
            echo "<p class='error'>No se puede abrir el fichero <em>'aulas.txt'</em></p>";
        } else {
            //si el fichero (array) que se pasa tiene valor 0 no ha sido vistado por lo que se puede añadir
            //en cambio, si el fichero (array) tiene valor 1 ya ha sido visitado por lo que no lo pondrá
            if ($nombre_ficheros[$_FILES["fichero"]["name"]] == 0) {
                $texto_formateado = file_get_contents($_FILES["fichero"]["tmp_name"]) . PHP_EOL;
                fputs($af, $texto_formateado);
                $nombre_ficheros[$_FILES["fichero"]["name"]] = 1;
            }
            fclose($af);
        }
        //mostramos el resultado 
        echo "<h2>El fichero <em>aulas.txt</em> tras esta operación tiene el siguiente contenido: </h2>";
        echo "<textarea>" . file_get_contents("Aulas/aulas.txt") . "</textarea>";
    }
    ?>
</body>

</html>