<?php
const SERVIDOR_BD = "localhost";
const USUARIO_BD = "jose";
const CLAVE_BD =  "josefa";
const NOMBRE_BD = "bd_foro";

function error_page($title, $body)
{
    return '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>' . $title . '</title>
</head>
<body>' . $body . '</body>
</html>';
}

try {
    @$conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
    mysqli_set_charset($conexion, "utf8");
} catch (Exception $e) {
    die(error_page("Primer CRUD", "<p>No se ha podido conectar a la BD: " . $e->getMessage() . "</p>"));
}

if (isset($_POST["btnDetalles"])) {
    try {
        $consulta = "select * from usuarios where id_usuario = '" . $_POST["btnDetalles"] . "'";
        $detalle_usuario = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        die(error_page("Primer CRUD", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
    }
}

if (isset($_POST["btnBorrar"])) {
    try {
        $consulta = "select * from usuarios where id_usuario = '" . $_POST["btnBorrar"] . "'";
        $borrar_usuario = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        die(error_page("Primer CRUD", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
    }
}

if (isset($_POST["btnBorrarDefinitivo"])) {
    try {
        $consulta = "delete from usuarios where id_usuario = '" . $_POST["btnBorrarDefinitivo"] . "'";
        mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        die(error_page("Primer CRUD", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
    }
}

try {
    $consulta = "select * from usuarios";
    $datos_usuarios = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    die(error_page("Primer CRUD", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
}

mysqli_close($conexion)
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica CRUD</title>
    <style>
        table {
            border-collapse: collapse;
        }

        table,
        td,
        th {
            border: solid 1px black;
            padding: 1rem;
            text-align: center;
        }

        .enlace {
            border: none;
            background: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h1>Listado de los usuarios</h1>

    <table>
        <tr>
            <th>Nombre de usuario</th>
            <th>Borrar</th>
            <th>Editar</th>
        </tr>
        <?php
        while ($tupla = mysqli_fetch_assoc($datos_usuarios)) {
            echo "<tr>";
            echo "<td><form action='index.php' method='post'><button type='submit' name='btnDetalles' title='Usuario' class='enlace' value=" . $tupla["id_usuario"] . ">" . $tupla["nombre"] . "</button></form></td>";
            echo "<td><form action='index.php' method='post'><button type='submit' name='btnBorrar' class='enlace' title='Borrar Usuario' value=" . $tupla["id_usuario"] . "><image src='images/borrar.png' alt='imagen borrar' width='50px'></button></form></td>";
            echo "<td>Editar</td>";
            echo "</tr>";
        }
        mysqli_free_result($datos_usuarios);
        ?>
    </table>

    <?php
    if (isset($_POST["btnDetalles"])) {
        echo "<h2>Detalles del usuario " . $_POST["btnDetalles"] . "</h2>";
        if (mysqli_num_rows($detalle_usuario) > 0) {
            $tupla_detalles = mysqli_fetch_assoc($detalle_usuario);

            echo "<p>";
            echo "<strong>Nombre: </strong>" . $tupla_detalles["nombre"] . "<br>";
            echo "<strong>Usuario: </strong>" . $tupla_detalles["usuario"] . "<br>";
            echo "<strong>Clave: </strong><br>";
            echo "<strong>Email: </strong>" . $tupla_detalles["email"] . "<br>";
            echo "</p>";
        } else {
            echo "<p>El usuario ya no se encuentra registrado en la BD</p>";
        }
        mysqli_free_result($detalle_usuario);
    }

    if (isset($_POST["btnBorrar"])) {
        if (mysqli_num_rows($borrar_usuario) > 0) {
            $tupla_borrar = mysqli_fetch_assoc($borrar_usuario);
            echo "<p>Se dispone usted a borrar al usuario <strong>".$tupla_borrar["nombre"]."</strong></p>";
            echo "<form action='index.php' method='post'>";
            echo "<button type='submit' name='btnBorrarDefinitivo' value=" . $tupla_borrar["id_usuario"] . ">Continuar</button>";
            echo "<button type='submit' name='btnAtras' title='Atras'>Atras</button>";
            echo "</form>";
        } else {
            echo "<p>El usuario ya no se encuentra registrado en la BD</p>";
        }

        if (mysqli_num_rows($borrar_usuario) < 1) {
            echo "<p>El usuario Se ha borrado con éxito</p>";
        }

        mysqli_free_result($borrar_usuario);
    }
    ?>
</body>

</html>