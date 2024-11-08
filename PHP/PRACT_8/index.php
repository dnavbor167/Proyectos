<?php
//conexión con bd
const SERVIDOR_BD = "localhost";
const USUARIO_BD = "jose";
const CLAVE_BD = "josefa";
const NOMBRE_BD = "bd_cv";

try {
    @$conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
    mysqli_set_charset($conexion, "utf8");
} catch (Exception $e) {
    die(error_page("Primer CRUD", "<p>No se ha podido conectar a la BD: " . $e->getMessage() . "</p>"));
}

//consulta para listar los datos del usuarios
try {
    $consulta = "select * from usuarios";
    $datos_usuarios = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    mysqli_close($conexion);
    die(error_page("Primer CRUD", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 8</title>
    <style>
        table,
        td,
        th {
            border: 1px solid black;
            padding: 1rem 2rem;
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

        .error {
            color: red
        }

        img {
            width: 10rem;
            height: auto;
        }
    </style>
</head>

<body>
    <h1>Práctica 8</h1>
    <h3>Listado de los usuarios</h3>

    <?php
    require "vistas/vista_tabla_principal.php";

    if (isset($_POST["btnBorrar"])) {
        echo "<h2>Borrado del usuario " . $_POST["btnBorrar"] . "</h2>";
        if (mysqli_num_rows($detalle_usuario) > 0) {
            $tupla_detalles = mysqli_fetch_assoc($detalle_usuario);
            echo "<p>¿Estás seguro que quires borrar al usuario <strong>" . $tupla_detalles["nombre"] . "</strong>?</p>";
            echo "<form action='index.php' method='post'>";
            echo "<button type='submit' value='" . $_POST["btnBorrar"] . "' name='btnContBorrar'>Continuar</button> ";
            echo " <button type='submit'>Atrás</button>";
            echo "</form>";
        } else {
            echo "<p>El usuario ya no se encuentra registrado en la BD</p>";
        }
        mysqli_free_result($detalle_usuario);
    }
    ?>

</body>

</html>