<?php
    function my_strlen($texto) {
        $cont = 0;
        while(isset($texto[$cont])) {
            $cont++;
        }
        return $cont;
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
    <form action="ejer1.php" method="post">
        <input type="text" name="texto" id="texto" placeholder="Escribe Aquí" value="<?php if (isset($_POST["texto"])) echo $_POST["texto"]; ?>">
        <button type="submit" name="btnContar">Contar</button>
    </form>

    <?php 
        if (isset($_POST["btnContar"])) {
            echo "<p>Hay ".my_strlen($_POST["texto"])." palabras</p>";
        }
    ?>
</body>

</html>