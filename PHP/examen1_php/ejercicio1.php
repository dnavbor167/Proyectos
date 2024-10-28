<?php
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
    <h1>Ejercicio 1</h1>
    <form action="ejercicio1.php" method="post" enctype="multipart/form-data">
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
        //Vamos a agregar el contenido a aulas.txt
        //guardamos en una variable el contenido que tiene el fichero
        $contenido = file_get_contents("Aulas/aulas.txt");
        @$af = fopen("Aulas/aulas.txt", "w");
        if (!$af) {
            echo "<p class='error'>No se puede abrir el fichero <em>'aulas.txt'</em></p>";
        } else {
            $texto_formateado = file_get_contents($_FILES["fichero"]["tmp_name"]) . PHP_EOL . $contenido;
            fputs($af, $texto_formateado);
            fclose($af);
        }
        //mostramos el resultado 
        echo "<h2>El fichero <em>aulas.txt</em> tras esta operación tiene el siguiente contenido: </h2>";
        echo "<textarea>" . file_get_contents("Aulas/aulas.txt") . "</textarea>";
    }
    ?>
</body>

</html>