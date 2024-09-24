<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multidimensional</title>
</head>
<body>
    <?php 
        $notas["Dani"]["DWESE"] = 7;
        $notas["Dani"]["DWECLI"] = 9;
        $notas["Dani"]["DISEÑO"] = 9;
        $notas["Dani"]["DESPLIEGE"] = 10;
        $notas["Tomas"]["DESPLIEGE"] = 6;

        echo "<h1>Nota de los alumnos de 2º DAW</h1>";

        //EXPLICACIÓN:
        //key: ["Dani"] value: array del nombre de la nota como key y el valor de la nota como value

        echo "<ol>";
        foreach($notas as $alumno=>$asignaturas) {
            //en $asignaturas va otro array, en este caso el array será "DAWESE" = 7
            echo "<li>" . $alumno;
            echo "<ul>";
            foreach($asignaturas as $asignatura=>$nota) {
                echo "<li>" . $asignatura . ": " . $nota . "</li>";
            }
            echo "</ul>";
            echo "</li>";

            
            
        }
        echo "</ol>";
    ?>
</body>
</html>