<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5</title>
</head>
<body>
    <?php 
        $persona["Nombre"] = "Pedro Torres";
        $persona["Dirección"] = "C/ Mayor, 37";
        $persona["Telefono"] = 123456789;

        foreach($persona as $key=>$value) 
            echo "<p><strong>" . $key . ":</strong> " . $value ."</p>";
        
    ?>
</body>
</html>