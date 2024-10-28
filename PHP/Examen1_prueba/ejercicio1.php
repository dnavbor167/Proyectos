<?php 
    function my_length($texto) {
        $contador = 0;
        while(isset($texto[$contador])) {
            $contador++;
        }
        return $contador;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<body>
    <form action="ejercicio1.php" method="post">
        <label for="texto">Introduce los caracteres a contar: </label>
        <input type="text" name="texto" id="texto" value="<?php if (isset($_POST["texto"])) echo $_POST["texto"]?>">
        <br><br>
        <button type="submit" name="btnContar">Contar</button>
    </form>

    <?php 
        if (isset($_POST["btnContar"])) {
            echo "<p>La palabra ".$_POST["texto"]." tiene ".my_length($_POST["texto"])." caracteres</p>";
        }
    ?>
</body>
</html>