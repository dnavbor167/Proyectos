<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6 POO</title>
</head>

<body>
    <h1>Ejercicio 6 POO</h1>
    <?php
    require 'class_menu.php';

    $menu = new Menu;
    $menu->cargar("https://www.marca.com/", "Marca");
    $menu->cargar("https://www.google.com/", "Google");
    $menu->cargar("https://www.marvel.com/", "Marvel");

    $menu->vertical();
    $menu->horizontal();
    ?>
</body>

</html>