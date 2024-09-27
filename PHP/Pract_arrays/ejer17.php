<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 15</title>
</head>
<body>
    <h1>Ejercicio 17</h1>
    <?php 
        $numeros = array(5=>1,12=>2,13=>56,"x"=>42);

        echo "<p>El número de elementos que tiene el array es " . count($numeros) . "</p>";
        echo "<p>Primer array</p>";
        foreach($numeros as $key=>$value) {
            echo "<p>" . $value . "</p>";
        }  

        unset($numeros[5]);

        echo "<p>Segundo array</p>";
        foreach($numeros as $key=>$value) {
            echo "<p>" . $value . "</p>";
        }  
    ?>
</body>
</html>