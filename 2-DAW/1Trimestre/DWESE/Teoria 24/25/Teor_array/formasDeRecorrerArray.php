<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formas de recorrer un array</title>
    <style>
        table, td, th {border: 1px solid black;}
        table {border-collapse: collapse; margin-bottom: 1.5rem;}
        td, th {padding: 1.5rem;}
    </style>
</head>
<body>
    <?php 
        $notas["Dani"] = 7;
        $notas["Tomas"] = 3;
        $notas["Clara"] = 5.5;

        echo "<h1>Notas de los alumnos de 2ºDAW en una asignatura DWESE</h1>";

        echo "<table>";
        echo "<tr><th>Alumno</th><th>Nota</th></tr>";
        //una de las primeras formas es con un bucle for o foreach usaremos habitualemente esta
        foreach($notas as $nombre=>$valor_nota) {
            echo "<tr>";
            echo "<td>" . $nombre . "</td>";
            echo "<td>" . $valor_nota . "</td>";
            echo "</tr>";
        }
        echo "</table>";

        //USAREMOS MÁS: end(array)
        //current(array) key(array) next(array) prev(array) reset(array) end(array)

        echo "<table>";
        echo "<tr><th>Alumno</th><th>Nota</th></tr>";
        //una de las primeras formas es con un bucle for o foreach usaremos habitualemente esta
        while(current($notas)) {
            echo "<tr>";
            echo "<td>" . key($notas) . "</td>";
            echo "<td>" . current($notas) . "</td>";
            echo "</tr>";
            next($notas);
        }
        echo "</table>";
    ?>
</body>
</html>