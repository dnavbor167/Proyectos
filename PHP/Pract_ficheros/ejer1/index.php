<?php 
    if (isset($_POST["btnCrear"])) {
        $error_tabla = $_POST["numero"] = "" || !is_numeric($_POST["numero"]) || $_POST["numero"] < 1 || $_POST["numero"] > 10;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
    <style>
        .error {
            color:red;
        }
    </style>
</head>
<body>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <label for="numero">Introduzca u número entre el 1 y el 10 (Ambos inclusivos)</label>
        <input type="text" name="numero" id="numero">
        <?php 
            if (isset($_POST["btnCrear"]) && $error_tabla) {
                if ($_POST["numero"] = "") {
                    echo "<span class='error'>* Campo vacío *</span>";
                } else {
                    echo "<span class='error'>* Debes introducir un número entre 1 y 10 *</span>";
                }
            }
        ?>
        <br>
        <button type="submit" name="btnCrear">Crear Tabla</button>
    </form>

    <?php 
        if (isset($_POST["numero"])) {
            $nombre_archivo = "tabla_".$_POST["numero"].".txt";
            //si no existe el archivo pasado
            if (!file_exists($nombre_archivo)) {
                @$file = fopen($nombre_archivo, "w");
                fclose($file);
            }
        }
    ?>
    
</body>
</html>