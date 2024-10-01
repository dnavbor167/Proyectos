<div id="verde" >
    <?php 
        echo "<h1>Palíndromos / capicúas - Resultado</h1>";
        $texto1_m = strtoupper($texto1);

        $i = 0;
        $j = $l_texto1 - 1;
        $respuesta = true;

        while ($i < $j) {
            if ($texto1_m[$i] != $texto1_m[$j]) {
                $respuesta = false;
                break;
            }
            $i++;
            $j--;
        }

        if ($todo_letra) {
            if ($respuesta) {
                echo "<p>" . $texto1 . " es un palíndromo</p>";
            } else {
                echo "<p>" . $texto1 . " no es un palíndromo</p>";
            }  
        } else {
            if ($respuesta) {
                echo "<p>" . $texto1 . " es un número capicúa</p>";
            } else {
                echo "<p>" . $texto1 . " no es un número capicúa</p>";
            }
        }
    ?>
</div>