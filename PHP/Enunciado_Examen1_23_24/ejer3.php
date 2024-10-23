<?php 
    if (isset($_POST["btnCodificar"])) {
        $error_texto = $_POST["texto"] == "";
        $error_numero = $_POST["desplazar"] < 1 || $_POST["desplazar"] > 26;
        $error_file = $_FILES["fichero"]["error"] || $_FILES["fichero"]["size"] > 1.25*1024;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
    <style>.error{color:red;}</style>
</head>
<body>
    <h1>Ejercicio 3. Codifica una frase</h1>
    <form action="ejer3.php" method="post" enctype="multipart/form-data">
        <label for="texto">Introduzca un Texto: </label>
        <input type="text" name="texto" id="texto">
        <br><br>

        <label for="desplazar">Desplazamiento :</label>
        <input type="text" name="desplazar" id="desplazar">
        <?php 
            if (isset($_POST["btnCodificar"]) && $error_numero) {
                echo "<span class='error'>* Introduzca un número entre el 1 y el 26 *</span>";
            }
        ?>
        <br><br>
        
        <label for="fichero">Seleccione el archivo de claves (.txt y menor a 1'25MB)</label>
        <input type="file" name="fichero" id="fichero" accept=".txt">
        <br><br>

        <button type="submit" name="btnCodificar">Codificar</button>
    </form>

</body>
</html>