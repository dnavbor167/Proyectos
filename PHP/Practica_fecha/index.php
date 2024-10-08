<?php 
    function dia_de_semana($fecha) {
        switch($fecha) {
            case 0:
                echo "Domingo";
                break;
            case 1:
                echo "Lunes";
                break;
            case 2:
                echo "Martes";
                break;
            case 3:
                echo "Miércoles";
                break;
            case 4:
                echo "Jueves";
                break;
            case 5:
                echo "Viernes";
                break;
            case 6:
                echo "Sábado";
                break;

        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva de Aulas</title>
    
</head>
<body>
    <h1>Reserva de aulas</h1>
    <form action="index.php" method="post">
        
        <label for="diaSemana" id="label_dia">
            <?php 
                if (isset($_POST["btnDia"])) {
                    $fecha_select = $_POST["diaSemana"];
                    $fecha_format = strtotime($fecha_select);
                    $fecha_final = dia_de_semana(date('w',$fecha_format));
                    echo $fecha_final;
                } else {
                    dia_de_semana(date('w'));
                }
            ?>
        </label>
            

        <input type="date" name="diaSemana" id="diaSemana" value="<?php if (!isset($_POST["btnDia"])) echo date('Y-m-d', time()); else echo $_POST["diaSemana"]; ?>">
        <button type="submit" name="btnDia">Cambiar</button>

        <?php 
            if (isset($_POST['btnDia'])) {
                //si es lunes exactamente pongo en el strtotime monday y sino last monday
                if (date('w',$fecha_format) == 1) {
                    $inicio_semana = date('d-m-Y', strtotime('Monday', $fecha_format));
                } else {
                    $inicio_semana = date('d-m-Y', strtotime('last Monday', $fecha_format));
                }
                //la función strtotime permite poner en el primer parametro el último dia y el proximo día
                
                $fin_semana = date('d-m-Y', strtotime('Sunday', $fecha_format));
                echo "<p>Semana del ".$inicio_semana." al ".$fin_semana."</p>";
            }
        ?>
    </form>

    <table>
            <?php 
                for ($i=0;$i<7;$i++) {
                    echo "<tr>";
                    for ($j=0;$j<=5;$j++) {
                        if ($i = 0 || $j>0) {
                            $dia_tabla = dia_de_semana($j);
                            echo "<td>".$dia_tabla."</td>";
                        }
                    }
                    echo "</tr>";
                }
            ?>
    </table>
</body>
</html>