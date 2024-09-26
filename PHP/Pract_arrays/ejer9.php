<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 8</title>
    <style>
        table, td, th {border: 1px solid black;}
        table {border-collapse: collapse; margin-bottom: 1.5rem;}
        td, th {padding: 1.5rem;}
    </style>
</head>
<body>
    <?php 
        $lenguajes_cliente[0] = "Español";
        $lenguajes_cliente[1] = "Inglés";
        $lenguajes_cliente[2] = "Alemán";
        $lenguajes_cliente[3] = "Chino";

        $lenguajes_servidor[0] = "php";
        $lenguajes_servidor[1] = "javascript";
        $lenguajes_servidor[2] = "docker";
        $lenguajes_servidor[3] = "python";

        $lenguajes = array_merge($lenguajes_cliente, $lenguajes_servidor);
        print_r(($lenguajes));

        echo "<table><tr><th>Cliente</th><th>Servidor</th></tr>";
        for($i = 0; $i < count($lenguajes); $i++) {
            echo "<tr>";
            if ($i < count($lenguajes_cliente)) {
                echo "<td>" . $lenguajes[$i] . "</td>";
                echo "<td>" . $lenguajes[count($lenguajes) / 2  + $i] . "</td>";
            } 
            echo "</tr>";
        }
        echo "</table>";
    ?>
</body>
</html>