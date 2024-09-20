<?php 
    echo "<p><strong>Nombre: </strong>" . $_POST["name"] . "</p>";
    echo "<p><strong>Apellidos: </strong>" . $_POST["apellidos"] . "</p>";
    echo "<p><strong>Contraseña: </strong>" . $_POST["pass"] . "</p>";
    echo "<p><strong>DNI: </strong>" . $_POST["dni"] . "</p>";
    echo "<p><strong>Sexo: </strong>";
    if (isset($_POST["sexo"])) {
        echo $_POST["sexo"];
    }
    echo"</p>";
    echo "<p><strong>Nacido en: </strong>" . $_POST["localidad"] . "</p>";
    echo "<p><strong>Comentarios: </strong>" . $_POST["comentarios"] . "</p>";
    echo "<p><strong>Subcripción: </strong>";
    if (isset($_POST["suscribete"])) {
        echo "Sí";
    } else {
        echo "No";
    }
    echo "</p>";
?>