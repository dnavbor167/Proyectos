<h2>Listado de los Libros</h2>

<div id="padre">
    <?php
    while ($tupla = mysqli_fetch_assoc($result_listado_libros)) {
        echo "<div class='flotado'><img src='Images/" . $tupla["portada"] . "' alt='imagen_libro'><p class='centrado'>" . $tupla["titulo"] . " - " . $tupla["precio"] . "</p></div>";
    }
    ?>
</div>