<div id="verde">
    <h1>Romanos a árabes - Resultado</h1>
    <?php
        $fecha1_arr = explode("/", $_POST["fecha1"]);
        $fecha2_arr = explode("/", $_POST["fecha2"]);

        $tiempo1 = mktime(0,0,0,$fecha1_arr[1], $fecha1_arr[0],$fecha1_arr[2]);
        $tiempo2 = mktime(0,0,0,$fecha2_arr[1], $fecha2_arr[0],$fecha2_arr[2]);

        $diff_segundos = abs($tiempo1 - $tiempo2);
        $dias_pasados = $diff_segundos/(60*60*24);

        echo "<p>La diferencia en días entre las dos fechas introducidas es de <strong>" . floor($dias_pasados) . "</strong></p>";
    ?>
</div>