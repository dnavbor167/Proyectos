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
    require 'class_peliculas.php';


    $piratas_del_caribe_1 = new Pelicula("Piratas del Caribe: La maldición de la Perla Negra", 2003, "Gore Verbinski", false, 18.95, false);
    $piratas_del_caribe_2 = new Pelicula("Piratas del Caribe: El cofre de la muerte", 2006, "Gore Verbinski", true, 20, "24-05-2025");
    $piratas_del_caribe_3 = new Pelicula("Piratas del Caribe: En el fin del mundo", 2007, "Gore Verbinski", true, 22.50, "16-10-2024");
    $piratas_del_caribe_4 = new Pelicula("Piratas del Caribe: Navegando aguas misteriosas", 2011, "Rob Marshall", false, 25, false);
    $piratas_del_caribe_5 = new Pelicula("Piratas del Caribe: La venganza de Salazar", 2017, "Joachim Rønning", true, 18, "16-12-2024");

    $peliculas = [$piratas_del_caribe_1, $piratas_del_caribe_1, $piratas_del_caribe_2, $piratas_del_caribe_3, $piratas_del_caribe_4, $piratas_del_caribe_5];

    echo '<form action="index.php" method="post">';
    echo "<label for='pelis'>Selecciona película: </label>";
    echo "<select name='pelis' id='pelis'>";
    foreach ($peliculas as $pelicula) {
        if (isset($_POST["btnVer"]) && $_POST["pelis"] == $pelicula->getTitulo()) {
            echo "<option selected value='" . $pelicula->getTitulo() . "'>" . $pelicula->getTitulo() . "</option>";
            $peli_seleccionada = $pelicula;
            break;
        } else
            echo "<option value='" . $pelicula->getTitulo() . "'>" . $pelicula->getTitulo() . "</option>";
    }
    echo "</select>";

    echo '<button type="submit" name="btnVer">Ver ahora</button>';
    echo "</form>";

    $estaAlquilada = $peli_seleccionada->getAlquilada() ? "Sí" : "No";
    echo "<p>El título de la película seleccionada es <strong>" . $_POST["pelis"] . "</strong> es del año <strong>" . $peli_seleccionada->getAnyo() . "</strong></p>";
    echo "<p>y la ha dirigido el director <strong>" . $peli_seleccionada->getDirector() . "</strong>, <strong> " . $estaAlquilada . " está alquilada</strong> y tiene un precio de <strong>" . $peli_seleccionada->getPrecio() . "€</strong></p>";

    if ($peli_seleccionada->getAlquilada()) {
        echo "<p>Tiene una fecha prevista de devolución para el <strong>" . $peli_seleccionada->getFechaDevolucion() . "</strong></p>";
        $dias_restantes = $peli_seleccionada->calcularDias();
        if (is_string($dias_restantes))
            echo "<p>" . $dias_restantes . "</p>";
        else
            echo "<p>Le quedan " . $dias_restantes . " días para devolverlo.</p>";
    }


    ?>
</body>

</html>