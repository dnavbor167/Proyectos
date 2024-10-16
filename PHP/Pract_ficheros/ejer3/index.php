<?php 
    if (isset($_POST["btnMostrar"])) {
        $error_input1 = $_POST["numero"] == "" || !is_numeric($_POST["numero"]) || $_POST["numero"] < 1 || $_POST["numero"] >10;
        $error_input2 = $_POST["numero_linea"] == "" || !is_numeric($_POST["numero_linea"]) || $_POST["numero_linea"] < 1 || $_POST["numero_linea"] >10;
        $error_tabla = $error_input1 || $error_input2;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
    <style>.error{color:red;}</style>
</head>
<body>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <label for="numero">Introduzca un número entre 1 y el 10 (Ambos Inclusivos) </label>
        <input type="text" name="numero" id="numero">
        <?php 
            //controlamos errores de input 1
            if (isset($_POST["btnMostrar"]) && $error_input1) {
                if ($_POST["numero"] == "") {
                    echo "<p class='error'>* Campo vacío *</p>";
                } else {
                    echo "<p class='error'>* Debes introducir un número entre el 1 y el 10 *</p>";
                }
            }
        ?>
        <br>
        <label for="numero_linea">Introduzca El número de línea a mostrar </label>
        <input type="text" name="numero_linea" id="numero_linea">
        <?php 
            //controlamos errores de input 1
            if (isset($_POST["btnMostrar"]) && $error_input2) {
                if ($_POST["numero_linea"] == "") {
                    echo "<p class='error'>* Campo vacío *</p>";
                } else {
                    echo "<p class='error'>* Debes introducir un número entre el 1 y el 10 *</p>";
                }
            }
        ?>
        <br>
        <button type="submit" name="btnMostrar">Mostrar línea</button>
    </form>

    <?php 
        if (isset($_POST["btnMostrar"]) && !$error_tabla) {
            $ruta_archivo = "Tablas/tabla_".$_POST["numero"].".txt";
            @$file = fopen($ruta_archivo, "r");

            if (!$file) {
                die("<p class='error'>Error al leer el fichero</p>");
            }

            fseek($file,$_POST["numero_linea"]-1);
            $linea = fgets($file);
            echo $linea;

            fclose($file);
        } 
    ?>

</body>
</html>