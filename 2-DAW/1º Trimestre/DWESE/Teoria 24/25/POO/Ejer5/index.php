<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5 POO</title>
</head>

<body>
    <h1>Ejercicio 5 POO</h1>
    <?php
    require 'class_empleado.php';

    $empleado1 = new Empleados("Daniel", 3500);
    $empleado2 = new Empleados("Pepe", 2500);

    $empleado1->impuestos();
    $empleado2->impuestos();
    ?>
</body>

</html>