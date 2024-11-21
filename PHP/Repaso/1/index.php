<?php
require "src/funciones_ctes.php";

//nos conectamos a la base de datos
try {
    @$conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
    mysqli_set_charset($conexion, "utf8");
} catch (Exception $e) {
    die(error_page("Primer CRUD", "<p>No se ha podido conectar a la BD: " . $e->getMessage() . "</p>"));
}

//hacemos detalles del usuario
if (isset($_POST["btnListar"]))
    try {
        $consulta = "select * from usuarios where id_usuario = " . $_POST["btnListar"] . "";
        $result_detalles_usuario = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        die(error_page("Primer CRUD", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
    }

//Nos traemos todos los datos de la BD para mostrar
//este irá el ultimo para cuando haga alguna operación aparezca actualizado
try {
    $consulta = "select * from usuarios";
    $result_datos_usuario = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    die(error_page("Primer CRUD", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primer CRUD</title>
    <style>
        table,
        td,
        th {
            border: 1px solid black
        }

        th,
        td {
            padding: 1rem;
        }

        table {
            border-collapse: collapse;
            text-align: center;
        }

        .enlace {
            border: none;
            background: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer
        }

        .btn_img {
            border: none;
            background: none;
            cursor: pointer
        }

        .mensaje {
            font-size: 1.25rem;
            color: blue
        }

        .error {
            color: red
        }

        img {
            width: 2rem;
        }
    </style>
</head>

<body>
    <?php
    require "vistas/vista_tabla.php";

    if (isset($_POST["btnListar"])) {
        $tupla = mysqli_fetch_assoc($result_detalles_usuario);
        echo "<h1>Listado del usuario " . $_POST["btnListar"] . "</h1>";
        echo "<p>";
        echo "<strong>Nombre: </strong> ".$tupla["nombre"]."<br><br>";
        echo "<strong>Usuario: </strong> ".$tupla["usuario"]." <br><br>";
        echo "<strong>Email: </strong>  ".$tupla["email"]."<br><br>";
        echo "</p>";
        echo "<form action='index.php' method='post'><button type='submit'>Volver</button></form>";
    }
    ?>
</body>

</html>