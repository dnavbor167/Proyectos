<?php
session_start();
require "src/funciones_ctes.php";

//conexión con bd
try {
    @$conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
    mysqli_set_charset($conexion, "utf8");
} catch (Exception $e) {
    session_destroy();
    die(error_page("Práctica 8", "<p>No se ha podido conectar a la BD: " . $e->getMessage() . "</p>"));
}

//Agregar usuario
if (isset($_POST["btnAgregar"])) {
    try {
        $consulta = "insert into `usuarios`(`usuario`, `clave`, `nombre`, `dni`, `sexo`, `foto`) values ('[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]')";
        mysqli_query($conexion, $consulta);
        $_SESSION["mensaje_accion"]="Usuario insertador con éxito";
        header("Location:index.php");
        exit;
    } catch (Exception $e) {
        mysqli_close($conexion);
        session_destroy();
        die(error_page("Práctica 8", "<p>No se ha podido realizar la inserción: " . $e->getMessage() . "</p>"));
    }
}

//Borrar usuario
if (isset($_POST["btnContBorrar"])) {
    try {
        $consulta = "delete from usuarios where id_usuario='" . $_POST["btnContBorrar"] . "'";
        mysqli_query($conexion, $consulta);
        $_SESSION["mensaje_accion"]="Usuario borrado con éxito";
        header("Location:index.php");
        exit;
    } catch (Exception $e) {
        mysqli_close($conexion);
        session_destroy();
        die(error_page("Práctica 8", "<p>No se ha podido realizar el borrado: " . $e->getMessage() . "</p>"));
    }
}

//Detalles usuario
if (isset($_POST["btnDetalles"]) || isset($_POST["btnBorrar"]) || isset($_POST["btnEditar"])) {
    if (isset($_POST["btnDetalles"]))
        $id_usuario = $_POST["btnDetalles"];
    elseif (isset($_POST["btnBorrar"]))
        $id_usuario = $_POST["btnBorrar"];
    else
        $id_usuario = $_POST["btnEditar"];

    try {
        $consulta = "select * from usuarios where id_usuario='" . $id_usuario . "'";
        $detalle_usuario = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        mysqli_close($conexion);
        session_destroy();
        die(error_page("Práctica 8", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
    }
}

//consulta para listar los datos del usuarios
try {
    $consulta = "select * from usuarios";
    $datos_usuarios = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    mysqli_close($conexion);
    session_destroy();
    die(error_page("Práctica 8", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
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
            width: 90%;
            margin: 0 auto;
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
    if (isset($_SESSION["mensaje_accion"])) {
        echo "<p class='mensaje'>".$_SESSION["mensaje_accion"]."</p>";
        session_destroy();
    }
    if (isset($_POST["btnAgregar"])) {
        require "vistas/vista_agregar.php";
    }
    if (isset($_POST["btnDetalles"])) {
        require "vistas/vista_detalles.php";
    }
    if (isset($_POST["btnBorrar"])) {
        require "vistas/vista_borrar.php";
    }

    require "vistas/vista_tabla_principal.php";

    ?>

</body>

</html>