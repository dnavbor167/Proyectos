<?php 
    echo "<h1>Estos son los datos enviados</h1>";
    echo "<p><strong>El nombre enviado ha sido: </strong>" . $_POST["nombre"] .  "</p>";
    echo "<p><strong>Ha nacido en: </strong>" . $_POST["nacido"] .  "</p>";
    echo "<p><strong>El sexo es: </strong>" . $_POST["sexo"] .  "</p>";
    if (!isset($_POST["aficiones"])) {
        echo "<p><strong>No has seleccionado ninguna afición</strong></p>";
    }

    //voy a hacer 3 if porque se pueden cumplir los 3 a la vez
    echo "<ol>";
    //como llamar a un array:
    if(isset($_POST["aficiones"][0])) {
        echo "<li>" . $_POST["aficiones"][0] . "</li>";
    }
    if(isset($_POST["aficiones"][1])) {
        echo "<li>" . $_POST["aficiones"][1] . "</li>";
    }
    if(isset($_POST["aficiones"][2])) {
        echo "<li>" . $_POST["aficiones"][2] . "</li>";
    }
    echo "</ol>";

    if (isset($_POST["comentarios"])) {
        echo "<p><strong>El comentario enviado ha sido: </strong>" . $_POST["comentarios"] .  "</p>";
    } else {
        echo "<p><strong>No has hecho ningun comentario</strong></p>";
    }
?>