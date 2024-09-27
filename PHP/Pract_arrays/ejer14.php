<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 14</title>
    <style>
        table, td, th {border: 1px solid black;}
        table {border-collapse: collapse; margin-bottom: 1.5rem;}
        td, th {padding: 1.5rem;}
    </style>
</head>
<body>
    <h1>Ejercicio 14</h1>
    <?php 
        $estadio_futbol["Barcelona"] = "Camp Nou";
        $estadio_futbol["Real Madrid"] = "Santiago Bernabeu";
        $estadio_futbol["Valencia"] = "Mestalla";
        $estadio_futbol["Real Sociedad"] = "Anoeta";

        echo "<table>";
        foreach($estadio_futbol as $key=>$value) {
            echo "<tr>";
            echo "<th>" . $key . "</th>";
            echo "<td>" . $value . "</td>";
            echo "</tr>";
        }
        echo "</table>";

        unset($estadio_futbol['Barcelona']);

        echo "<table>";
        foreach($estadio_futbol as $key=>$value) {
            echo "<tr>";
            echo "<th>" . $key . "</th>";
            echo "<td>" . $value . "</td>";
            echo "</tr>";
        }
        echo "</table>";

    ?>
</body>
</html>