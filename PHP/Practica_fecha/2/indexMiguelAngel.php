<?php 
    const SEGUNDOS_DIA = 60*60*24;
    const DIAS_SEMANAS = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");

    if (isset($_POST["fecha"]) && $_POST["fecha"] != "") {
        $fecha = $_POST["fecha"];
    } else {
        $fecha = date("Y-m-d");
    }

    $segundos_dia = strtotime($fecha);
    $dia_semana = date("w", $segundos_dia);
    
    $dias_pasados = $dia_semana - 1;
    if ($dias_pasados == -1) {
        $dias_pasados = 6;
    }

    //para calcular el primer dia es los segundos - los dias que han pasado * los segundos que tiene un dia
    $primer_dia = $segundos_dia - ($dias_pasados*SEGUNDOS_DIA);
    $ultimo_dia = $primer_dia+(6*SEGUNDOS_DIA);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resolucón Miguel Ángel</title>
    <style>
        table,th,td{border:solid 1px black;}
        table{width:80%;margin:0;border-collapse:collapse;margin-top:2em;text-align: center;}
        th{background-color:#CCC;}
    </style>
</head>
<body>
    <form action="indexMiguelAngel.php" method="post" id="form_fecha">
        <h2>Reserva de aulas</h2>
        <p>
            <label for="fecha"><?php echo DIAS_SEMANAS[$dia_semana]?></label>
            <input type="date" name="fecha" onchange="document.getElementById('form_fecha').submit();" id="fecha" value="<?php echo $fecha;?>">
        </p>

        <p>
            Semana del <?php echo date("d/m/Y", $primer_dia); ?> al <?php echo date("d/m/Y",$ultimo_dia);?>
        </p>
    </form>

    <?php 
        $horas[1] ="8:15 - 9:15";
        $horas[] ="9:15 - 10:15";
        $horas[] ="10:15 - 11:15";
        $horas[] ="11:15 - 11:45";
        $horas[] ="11:45 - 12:45";
        $horas[] ="12:45 - 13:45";
        $horas[] ="13:45 - 14:45";

        echo "<table>";
        echo "<tr>";
        echo "<th></th>";
        for ($i = 1; $i <= 5; $i++) {
            echo "<th>".DIAS_SEMANAS[$i]."</th>";
        }
        echo "</tr>";

        for ($j = 1; $j <= 7; $j++) {
            echo "<tr>";
            echo "<th>".$horas[$j]."</th>";
            if ($j == 4) {
                echo "<td colspan='5'>RECREO</td>";
            } else {
                for ($col = 1; $col <= 5; $col++) {
                    echo "<td></td>";
                }
            }
            echo "</tr>";
        }
        echo "</table>";
    ?>
</body>
</html>