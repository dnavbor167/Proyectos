<?php 
    function my_explode($sep, $texto) {
        $aux = [];
        $i = 0;
        $l_frase = strlen($texto);
        
        while($i < $l_frase && $texto[$i] == $sep) {
            $i++;
        }

        if ($i < $l_frase) {
            $j = 0;
            $aux[$j] = $texto[$i];

            for($i = $i + 1; $i < $l_frase;$i++) {
                if ($texto[$i] != $sep) {
                    $aux[$j].=$texto[$i];
                } else {
                    while ($i < $l_frase && $texto[$i] == $sep) {
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
        $error_texo = $_POST["texto"] == "";
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
    <form action="ejercicio3.php" method="post">
        <label for="texto">Introduce el texto para hacer explode:</label>
        <input type="text" name="texto" id="texto" value="<?php if (isset($_POST["texto"])) echo $_POST["texto"] ?>">
        <?php 
            if (isset($_POST["btnContar"]) && $error_texo) {
                echo "<span class='error'>* Debes escrbir al menos una palabra *</span>";
            }
        ?>
        <br><br>

        <select name="separador" id="separador">
            <option <?php if (isset($_POST["btnContar"]) && $_POST["separador"] == ",") echo "selected" ?> value=",">Coma</option>
            <option <?php if (isset($_POST["btnContar"]) && $_POST["separador"] == ";") echo "selected" ?> value=";">Punto y coma</option>
            <option <?php if (isset($_POST["btnContar"]) && $_POST["separador"] == " ") echo "selected" ?> value=" ">Espacio</option>
            <option <?php if (isset($_POST["btnContar"]) && $_POST["separador"] == ":") echo "selected" ?> value=":">Dos puntos</option>
        </select>

        <br><br>
        <button type="submit" name="btnContar">Contar</button>
    </form>

    <?php 
        if (isset($_POST["btnContar"]) && !$error_texo) {
            echo "<h2>Respuesta</h2>";
            echo "<p>El texto introducido tiene: ".count(my_explode($_POST["separador"], $_POST["texto"]))." palabras</p>";
        }
    ?>
</body>
</html>