<?php
//cargamos el src de funciones y constantes a usar
require "src/funciones_cts.php";

//conexión a la BD
try {
    @$conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
    mysqli_set_charset($conexion, "utf8");
} catch (Exception $e) {
    die(error_page("Examen Año pasado", "<p>No se ha podido cargar la BD: " . $e->getMessage() . "</p>"));
}

//consulta para ver los horarios de los profesores
if (isset($_POST["btnVerHorario"])) {
    try {
        $consulta = "select * from horario_lectivo where usuario = '".$_POST["nom_user"]."'"; //falla aqui
        $result_horario_profesor = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        mysqli_close($conexion);
        die(error_page("Examen Año pasado", "<p>No se ha podido cargar la BD: " . $e->getMessage() . "</p>"));
    }
}

//una vez lo tenemos conectado hacemos la primera consulta parar traer la id del profe
try {
    $consulta = "select * from usuarios";
    $result_datos_usuario = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    mysqli_close($conexion);
    die(error_page("Examen Año pasado", "<p>No se ha podido cargar la BD: " . $e->getMessage() . "</p>"));
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen2 PHP</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black
        }

        table {
            border-collapse: collapse;
            width: 90%;
            margin: 0 auto;
            text-align: center
        }
        .enlace{
            background:none;
            border:none;
            color:blue;
            text-decoration: underline;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h1>Examen2 PHP</h1>
    <h2>Horario de los Profesores</h2>
    <?php
    require "vistas/vista_seleccion.php";

    if (isset($_POST["btnVerHorario"])) {
        echo "<h3>Horario del Profesor: " . $nombre_profesor . "</h3>";
        echo "<table>";
        echo "<tr>";
        for ($dias = 0; $dias < count(DIAS_SEMANA); $dias++) {
            echo "<th>" . DIAS_SEMANA[$dias] . "</th>";
        }
        echo "</tr>";

        for ($horario = 0; $horario < count(HORAIO_SEMANA); $horario++) {
            echo "<tr>";
            echo "<th>" . HORAIO_SEMANA[$horario] . "</th>";
            if ($horario == 3)
                echo "<td colspan='5'></td>";
            else {
                for ($clases = 0; $clases < 5; $clases++) {
                    echo "<td><form action='index.php' method='post'><button type='submit' class='enlace' name='btnEditar'>Editar</button></form></td>";
                }
            }

            echo "</tr>";
        }
        echo "</table>";

        while($tupla_horario_prof=mysqli_fetch_assoc($result_horario_profesor)) {
            echo "<p>".$tupla_horario_prof["hora"]."</p>";
        }
    }
    ?>

</body>

</html>