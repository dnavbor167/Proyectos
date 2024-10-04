<div id="verde">
    <h1>Romanos a árabes - Resultado</h1>
    <?php
        $respuesta = 0;
        for ($i=0; $i < strlen($texto1_m); $i++) { 
            $respuesta += VALORES[$texto1_m[$i]];
        }


        echo "<p>El número romano <strong>" . $texto1 . "</strong> es es árabe: <strong>" . $respuesta . "</strong></p>";
    ?>
</div>