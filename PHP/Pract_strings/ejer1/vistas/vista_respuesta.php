<div id="verde" >
    <h1>Ripios - Resultado</h1>
    <?php 
        $texto1_m = strtoupper($texto1);
        $texto2_m = strtoupper($texto2);

        $respuesta = "no riman.";

        if ($texto1_m[$l_texto1 - 1] == $texto2_m[$l_texto2 - 1] && $texto1_m[$l_texto1 - 2] == $texto2_m[$l_texto2 - 2]) {
            $respuesta = "riman un poco.";
            if ($texto1_m[$l_texto1 - 3] == $texto2_m[$l_texto2 - 3]) {
                $respuesta = "riman.";
            }
        }
        echo "<p><strong>" . $texto1 . "</strong> y <strong>" . $texto2 . "</strong> " . $respuesta . "</p>";
    ?>
</div>