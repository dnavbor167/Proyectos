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
        $consulta = "select * from horario_lectivo join grupos on horario_lectivo.grupo = grupos.id_grupo where usuario = " . $_POST["nom_user"] . " order by dia asc, hora asc";
        $result_horario_profesor = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        mysqli_free_result($result_horario_profesor);
        die(error_page("Examen Año pasado", "<p>No se ha podido cargar la BD: " . $e->getMessage() . "</p>"));
    }
}

//una vez lo tenemos conectado hacemos la primera consulta parar traer la id del profe
try {
    $consulta = "select * from usuarios";
    $result_datos_usuario = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    mysqli_free_result($result_datos_usuario);
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

        h3 {
            text-align: center;
        }

        .enlace {
            background: none;
            border: none;
            color: blue;
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
        $horarios = [];
        while ($tupla_horario_tabla = mysqli_fetch_assoc($result_horario_profesor)) {
            $horarios[] = $tupla_horario_tabla;
        }

        echo "<h3>Horario del Profesor: " . $nombre_profesor . "</h3>";
        echo "<table>";
        echo "<tr>";
        for ($dias = 0; $dias < count(DIAS_SEMANA); $dias++) {
            echo "<th>" . DIAS_SEMANA[$dias] . "</th>";
        }
        echo "</tr>";

        for ($horario = 1; $horario < count(HORAIO_SEMANA); $horario++) {
            echo "<tr>";
            echo "<th>" . HORAIO_SEMANA[$horario] . "</th>";
            if ($horario == 3)
                echo "<td colspan='5'>RRECREO</td>";
            else {
                for ($clases = 1; $clases < 6; $clases++) {
                    echo "<td>";
                    $contenido_celda = [];
                    foreach ($horarios as $tupla_horario_tabla) {
                        if ($tupla_horario_tabla["dia"] == $clases && $tupla_horario_tabla["hora"] == $horario) {
                            $contenido_celda[] = $tupla_horario_tabla["nombre"];
                        }
                    }
                    echo implode("/", $contenido_celda);
                    echo "<form action='index.php' method='post'><button type='submit' class='enlace' name='btnEditar'>Editar</button></form></td>";
                }
            }

            echo "</tr>";
        }
        echo "</table>";
    }
    ?>

</body>

</html>