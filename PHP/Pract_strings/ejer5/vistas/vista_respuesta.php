<div id="verde">
    <h1>Árabes a romanos - Resultado</h1>
    <?php
        $cont["M"]=4;
        $cont["D"]=1;
        $cont["C"]=4;
        $cont["L"]=1;
        $cont["X"]=4;
        $cont["V"]=1;
        $cont["I"]=4;
        $respuesta = '';
        $temporal_number = $texto1;

        while ($temporal_number > 0) {
            if ($temporal_number > 1000 && $cont["M"] > 0) {
                $temporal_number -= 1000;
                $respuesta .= 'M';
                $cont["M"]--;
            } else if ($temporal_number > 500 && $cont["D"] > 0) {
                $temporal_number -= 500;
                $respuesta .= 'D';
                $cont["D"]--;
            } else if ($temporal_number > 100 && $cont["C"] > 0) {
                $temporal_number -= 100;
                $respuesta .= 'C';
                $cont["C"]--;
            } else if ($temporal_number > 50 && $cont["L"] > 0) {
                $temporal_number -= 50;
                $respuesta .= 'L';
                $cont["L"]--;
            } else if ($temporal_number > 10 && $cont["X"] > 0) {
                $temporal_number -= 10;
                $respuesta .= 'X';
                $cont["X"]--;
            } else if ($temporal_number > 5 && $cont["V"] > 0) {
                $temporal_number -= 5;
                $respuesta .= 'V';
                $cont["V"]--;
            } else {
                $temporal_number -= 1;
                $respuesta .= 'I';
                $cont["I"]--;
            }
        }


        echo "<p>El número <strong>" . $texto1 . "</strong> se escribe en números romanos: <strong>" . $respuesta . "</strong></p>";
    ?>
</div>