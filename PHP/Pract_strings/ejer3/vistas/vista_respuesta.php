<div id="verde">
    <h1>Palíndromos / capicúas - Resultado</h1>
    <?php
        $texto1_m = strtoupper($frase_formulada);

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


        if ($respuesta) {
            echo "<p>La frase <strong>" . $texto1 . "</strong> es un palíndroma</p>";
        } else {
            echo "<p>La frase <strong>" . $texto1 . "</strong> no es un palíndroma</p>";
        }
    ?>
</div>