<div id="verde">
    <h1>Quita acentos - Resultado</h1>
    <?php

        function quitar_acentos($texto) {
            $texto_formateado = "";
            $valores = [
                "á" => "a",
                "é" => "e",
                "í" => "i",
                "ó" => "o",
                "ú" => "u",
                "ü" => "u",
                "Á" => "A",
                "É" => "E",
                "Í" => "I",
                "Ó" => "O",
                "Ú" => "U",
                "Ü" => "U"
            ];

            foreach ($valores as $key=>$value) {
                $texto = str_replace($key, $value, $texto);
            }
            return $texto;
        }
        //preguntar al profesor sobre mb_strlen, por qué si pongo strlen normal y hay acentos
        //me las cuenta doble
        //echo "<p>".mb_strlen($texto1)."</p>";

        echo "<dl>";
        echo "<dt>Texto original</dt>";
        echo "<dd>".$texto1."</dd>";
        echo "<dt>Texto sin acentos</dt>";
        echo "<dd>".quitar_acentos($texto1)."</dd>";
        echo "<dl>";
    ?>
</div>