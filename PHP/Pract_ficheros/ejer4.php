<?php 
    function extension_txt($texto) {
        $array_nombre = explode(".",$texto);
        if (count($array_nombre) <= 1) {
            $respuesta = false;
        } else {
            $respuesta = strtolower(end($array_nombre)) == "txt";
        }
        return $respuesta;
    }
    if (isset($_POST["btnContar"])) {
        $error_fichero = $_FILES["fichero"]["error"] || !extension_txt($_FILES["fichero"]["name"]) || $_FILES["fichero"]["size"] > 2.5*1024*1024;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>.error{color:red;}</style>
</head>
<body>
    <h1>Ejercicio 4</h1>
    <form action="ejer4.php" method="post" enctype="multipart/form-data">
        <label for="fichero">Introduzca un fichero para contar (Máx. 2.5 MB)</label>
        <input type="file" name="fichero" id="fichero" accept=".txt">
        <?php 
            if (isset($_POST["btnContar"]) && $error_fichero) {
                if ($_FILES["fichero"]["name"] == "") {
                    echo "<span class='error'> *Debes seleccionar un fichero* </span>";
                } else if($_FILES["fichero"]["error"]) {
                    echo "<span class='error'> *No se ha subido el archivo seleccionado al servidor* </span>";
                } else if(!extension_txt($_FILES["fichero"]["name"])) {
                    echo "<span class='error'> *No has seleccionado un archivo de texto* </span>";
                } else {
                    echo "<span class='error'> *El fichero seleccionado es mayor a 2.5 MB* </span>";
                }
            }
        ?>
        <br>
        <button type="submit" name="btnContar">Contar palabras</button>
    </form>

    <?php 
        if (isset($_POST["btnContar"]) && !$error_fichero) {
            $todo = file_get_contents($_FILES["fichero"]["tmp_name"]);
            $contar = str_word_count($todo);
            echo "<p>El fichero ".$_FILES["fichero"]["name"]." tiene ".$contar." palabras</p>";
        }
    ?>
</body>
</html>