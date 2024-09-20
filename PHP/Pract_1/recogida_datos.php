<?php 
    //si no existe el botón (recargo la página donde envío los datos) se redirecciona a index.html
    //esto ha de hacerse SIEMPRE ANTES DEL HTML
    if (!isset($_POST["btnEnviar"])) {
        header("Location:index.php");
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recogida de datos</title>
</head>
<body>
    <h1>Recogida de Datos</h1>
    <?php 
        //funcion para ver todo el contenido de una variable, para ahorrarme el for (solo lo usamos para depurar)
        //var_dump($_GET);

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
</body>
</html>