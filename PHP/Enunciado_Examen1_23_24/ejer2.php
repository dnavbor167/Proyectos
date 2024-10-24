<?php 
    if (isset($_POST["btnContar"])) {
        $error_texto = $_POST["texto"] == "";
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Ejercicio 2. Contar Palabras sin las vocales (a, e, i, o, u, A, E, I, O, U)</h1>
    <form action="ejer2.php" method="post" enctype="multipart/form-data">
        <label for="texto">Introduzca un Texto</label>
        <input type="text" name="texto" id="texto">
        <?php 
            if (isset($_POST["btnContar"]) && $error_texto) {
                echo "<span class='error'>* Debes introducir al menos un caracter *</span>";
            }
        ?>
        <br>
        <label for="separador">Elija el Separador</label>
        <select name="separador" id="separador">
            <option value=",">Coma</option>
            <option value=";">Punto y Coma</option>
            <option value=" ">Espacio</option>
            <option value=":">Dos puntos</option>
        </select>
        <br>
        <button type="submit" name="btnContar">Contar</button>
    </form>
</body>
</html>