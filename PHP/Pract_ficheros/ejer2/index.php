<?php 
    if (isset($_POST["btnMostrar"])) {
        $error_tabla = $_POST["numero"] == "" || !is_numeric($_POST["numero"]) || $_POST["numero"] < 1 || $_POST["numero"] >10;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
    <style>.error{color:red;}</style>
</head>
<body>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <label for="numero">Introduzca un número entre 1 y el 10 (Ambos Inclusivos) </label>
        <input type="text" name="numero" id="numero">
        <?php 
            if (isset($_POST["btnMostrar"]) && $error_tabla) {
                if ($_POST["numero"] == "") {
                    echo "<p class='error'>* Campo vacío *</p>";
                } else {
                    echo "<p class='error'>* Debes introducir un número entre el 1 y el 10 *</p>";
                }
            }
        ?>
        <br>
        <button type="submit" name="btnMostrar">Mostrar Tabla</button>
    </form>

    <?php 
        if (isset($_POST["btnMostrar"]) && !$error_tabla) {
            $nombre_fichero = "Tablas/tabla_".$_POST["numero"].".txt";

            @$file = fopen($nombre_fichero, "r");
            if (!$file) {
                die("<p class='error'>El fichero no existe</p>");
            }

            echo "<h2>El fichero ".$nombre_fichero." contiene:</h2>";
            $contenido_fichero = file_get_contents($nombre_fichero);
            echo nl2br($contenido_fichero);

            //cerramos el fichero
            fclose($file);
        }
    ?>
</body>
</html>