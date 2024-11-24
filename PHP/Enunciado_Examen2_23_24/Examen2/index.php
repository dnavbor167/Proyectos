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

//edicion de los horarios

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
        th {
            background-color: lightgray;
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

        .tabla_editar {
            width: 20rem;
            margin: 0;
        }
    </style>
</head>

<body>
    <h1>Examen2 PHP</h1>
    <h2>Horario de los Profesores</h2>
    <?php
    require "vistas/vista_seleccion.php";

    if (isset($_POST["btnVerHorario"]) || isset($_POST["nom_user"])) {
        require "vistas/vista_tabla_horario.php";
    }

    if (isset($_POST["btnEditar"])) {
        $hora_dia = explode("|", $_POST["btnEditar"]);
        echo "<h2>Editando la ".$hora_dia[0]."º hora (".HORAIO_SEMANA[$hora_dia[0]].") del ".DIAS_SEMANA[$hora_dia[1]]."</h2>";
        echo "<table class='tabla_editar'>";
        echo "<tr><th>Grupo</th><th>Acción</th></tr>";
        echo "<tr><td></td></tr>";
        echo "</table>";
    }
    ?>

</body>

</html>