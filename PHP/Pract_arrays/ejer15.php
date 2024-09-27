<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 15</title>
    <style>
        table, td, th {border: 1px solid black;}
        table {border-collapse: collapse; margin-bottom: 1.5rem;}
        td, th {padding: 1.5rem;}
    </style>
</head>
<body>
    <h1>Ejercicio 15</h1>
    <?php 
        $numeros = array("uno"=>3,"dos"=>2,"tres"=>8,"cuatro"=>123,"cinco"=>5,"seis"=>1);

        //si usamos un sort los arrays asociativos te cambia a alfanumerico
        asort($numeros);

        echo "<table>";
        foreach($numeros as $key=>$value) {
            echo "<tr>";
            echo "<th>" . $key . "</th>";
            echo "<td>" . $value . "</td>";
            echo "</tr>";
        }
        echo "<table>";
    ?>
</body>
</html>