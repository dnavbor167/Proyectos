<div id="verde" >
    <?php 
        echo "<h1>Palíndromos / capicúas - Resultado</h1>";
        $texto1_m = strtoupper($texto1);

        $respuesta = true;

        for ($i = 0; $i < $l_texto1; $i++) {
            if ($texto_m[$i] != $texto_m[$l_texto1 - 1 - $i] {
                $respuesta = false;
            })
        }

        if ($todo_letra) {
            if ($respuesta) {
                echo "<p>" . $texto1 . " es un palíndromo</p>";
            } else {
                echo "<p>" . $texto1 . " no es un palíndromo</p>";
            }  
        } else if ($todo_numeros) {
            if ($respuesta) {
                echo "<p>" . $texto1 . " es un número capicúa</p>";
            } else {
                echo "<p>" . $texto1 . " no es un número capicúa</p>";
            }
        }
    ?>
</div>