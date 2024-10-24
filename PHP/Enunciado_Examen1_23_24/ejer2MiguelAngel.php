<?php
function my_explode($texto, $separador)
{
    $aux = [];
    $i = 0;
    $l_frase = strlen($texto);

    while ($i < $l_frase && $texto[$i] == $separador) {
        $i++;
    }

    if ($i < $l_frase) {
        $j = 0;
        $aux[$j] = $texto[$i];

        for ($i = $i + 1; $i < $l_frase; $i++) {
            if ($texto[$i] != $separador) {
                $aux[$j] .= $texto[$i];
            } else {
                while ($i < $l_frase && $texto[$i] == $separador) {
                    $i++;
                }
                if ($i < $l_frase) {
                    $j++;
                    $aux[$j] = $texto[$i];
                }
            }
        }
    }
    return $aux;
}



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
            <option <?php if (isset($_POST["btnContar"]) && $_POST["separador"] == ",") echo "selected"; ?> value=",">Coma</option>
            <option <?php if (isset($_POST["btnContar"]) && $_POST["separador"] == ";") echo "selected"; ?> value=";">Punto y Coma</option>
            <option <?php if (isset($_POST["btnContar"]) && $_POST["separador"] == " ") echo "selected"; ?> value=" ">Espacio</option>
            <option <?php if (isset($_POST["btnContar"]) && $_POST["separador"] == ":") echo "selected"; ?> value=":">Dos puntos</option>
        </select>
        <br>
        <button type="submit" name="btnContar">Contar</button>
    </form>

    <?php
    if (isset($_POST["btnContar"]) && !$error_texto) {
        $palabra_por_separador = my_explode();
        $palabra_sin_vocales = ;
    }
    ?>
</body>

</html>