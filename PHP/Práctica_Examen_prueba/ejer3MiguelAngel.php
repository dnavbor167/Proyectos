<?php
if (isset($_POST["btnContar"])) {
    $error_texto = $_POST["texto"] == "";
}

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
    <form action="ejer3MiguelAngel.php" method="post" enctype="multipar/form-data">
        <label for="texto">Introduzca las palabras a contar: </label>
        <input type="text" name="texto" id="texto" value="<?php if (isset($_POST["texto"])) echo $_POST["texto"]; ?>">
        <?php
        if (isset($_POST["btnContar"]) && $error_texto) {
            echo "<span class='error'>* Debes introducir al menos una palabra *</span>";
        }
        ?>
        <br>
        <label for="separador">Introduzca el separador</label>
        <select name="separador" id="separador">
            <option <?php if (isset($_POST["separador"]) && $_POST["separador"] == ",") echo "selected"; ?> value=",">,</option>
            <option <?php if (isset($_POST["separador"]) && $_POST["separador"] == ";") echo "selected"; ?> value=";">;</option>
            <option <?php if (isset($_POST["separador"]) && $_POST["separador"] == " ") echo "selected"; ?> value=" ">Espacio</option>
            <option <?php if (isset($_POST["separador"]) && $_POST["separador"] == ":") echo "selected"; ?> value=":">:</option>
        </select>
        <br>
        <button type="submit" name="btnContar">Contar</button>
    </form>
    <?php
    if (isset($_POST["btnContar"]) && !$error_texto) {
        $text = $_POST["texto"];
        $sep = $_POST["separador"];
        $array = my_explode($text, $sep);
        echo "<p>El texto " . $text . " tiene " . count($array) . " palabras</p>";
    }
    ?>
</body>

</html>