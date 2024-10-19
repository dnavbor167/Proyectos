<?php 
    if (isset($_POST["btnContar"])) {
        $error_texto = $_POST["texto"] == "";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <form action="ejer3.php" method="post" enctype="multipar/form-data">
        <label for="texto">Introduzca las palabras a contar: </label>
        <input type="text" name="texto" id="texto" value="<?php if (isset($_POST["texto"])) echo $_POST["texto"];?>">
        <?php 
            if (isset($_POST["btnContar"]) && $error_texto) {
                echo "<span class='error'>* Debes introducir al menos una palabra *</span>";
            }
        ?>
        <br>
        <label for="separador">Introduzca el separador</label>
        <select name="separador" id="separador">
            <option value=",">,</option>
            <option value=";">;</option>
            <option value=" ">Espacio</option>
            <option value=":">:</option>
        </select>
        <br>
        <button type="submit" name="btnContar">Contar</button>
    </form>
    <?php 
        if (isset($_POST["btnContar"]) && !$error_texto) {
            $texto = $_POST["texto"];
            $sep = $_POST["separador"];
            $cont = 1;
            for ($i = 0; $i < strlen($texto); $i++) {
                if ($texto[$i] == $sep) {
                    $cont++;
                }
            }
            echo "<p>El texto ".$texto." tiene ".$cont." palabras</p>";
        }
    ?>
</body>
</html>