<?php 
    echo "<h1>Estos son los datos enviados</h1>";
    echo "<p><strong>El nombre enviado ha sido: </strong>" . $_POST["nombre"] .  "</p>";
    echo "<p><strong>Ha nacido en: </strong>" . $_POST["nacido"] .  "</p>";
    echo "<p><strong>El sexo es: </strong>" . $_POST["sexo"] .  "</p>";
    
    //como llamar a un array:
    if (isset($_POST["aficiones"])) {
        
        if (count($_POST["aficiones"]) == 1) {
            echo "<p><strong>La afición seleccionada es: </strong></p>"; 
        } else {
            echo "<p><strong>Las aficiones seleccionadas han sido:</strong></p>";
        }
        echo "<ol>";
        for ($i = 0; $i < count($_POST["aficiones"]); $i++) {
            echo "<li>" . $_POST["aficiones"][$i] . "</li>";
        }
        echo "</ol>";
    } else {
        echo "<p><strong>No ha elegido ninguna afición</strong></p>";
    }

    if (isset($_POST["comentarios"]) && $_POST["comentarios"] != "") {
        echo "<p><strong>El comentario enviado ha sido: </strong>" . $_POST["comentarios"] .  "</p>";
    } else {
        echo "<p><strong>No has hecho ningun comentario</strong></p>";
    }
?>