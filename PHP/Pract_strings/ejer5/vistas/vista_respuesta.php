<div id="verde">
    <h1>Árabes a romanos - Resultado</h1>
    <?php
        $respuesta = '';
        $temporal_number = $texto1;

        while ($temporal_number > 0) {
            if ($temporal_number > 1000) {
                $temporal_number -= 1000;
                $respuesta .= 'M';
            } else if ($temporal_number > 500) {
                $temporal_number -= 500;
                $respuesta .= 'D';
            } else if ($temporal_number > 100) {
                $temporal_number -= 100;
                $respuesta .= 'C';
            } else if ($temporal_number > 50) {
                $temporal_number -= 50;
                $respuesta .= 'L';
            } else if ($temporal_number > 10) {
                $temporal_number -= 10;
                $respuesta .= 'X';
            } else if ($temporal_number > 5) {
                $temporal_number -= 5;
                $respuesta .= 'V';
            } else {
                $temporal_number -= 1;
                $respuesta .= 'I';
            }
        }


        echo "<p>El número <strong>" . $texto1 . "</strong> se escribe en números romanos: <strong>" . $respuesta . "</strong></p>";
    ?>
</div>