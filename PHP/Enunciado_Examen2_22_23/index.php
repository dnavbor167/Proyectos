<?php
session_name("Examen2_22_23");
session_start();

require "src/funciones_ctes.php";

//hacemos la conexión a la base de datos
try {
    @$conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
    mysqli_set_charset($conexion, "utf8");
} catch (Exception $e) {
    session_destroy();
    die(error_page("Practica examen", "<p>Error al conectar a la BD</p>"));
}

//consulta a la bd para consultar los alumnos
try {
    $consulta = "select * from alumnos";
    $result_select_alumnos = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    session_destroy();
    mysqli_close($conexion);
    die(error_page("Practica examen", "<p>Error al hacer la consulta</p>"));
}

//consulta para las notas
if (isset($_POST["alumnos"])) {
    try {
        $consulta = "select notas.cod_alu, asignaturas.denominacion, notas.nota from notas join asignaturas on notas.cod_asig = asignaturas.cod_asig where notas.cod_alu = ".$_POST["alumnos"]."";
        $result_notas_alumnos = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        session_destroy();
        mysqli_close($conexion);
        die(error_page("Practica examen", "<p>Error al hacer la consulta</p>"));
    }
}

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen colegio</title>
</head>

<body>
    <h1>Notas de los Alumnos</h1>
    <?php 
    if (mysqli_num_rows($result_select_alumnos) <= 0) {
        echo "<p>En estos momentos no tenemos ningún alumno registrado en la BD</p>";
    } else {
        ?>
        <form action="index.php" method="post">
            <label for="alumnos">Seleccione un Alumno:</label>
            <select name="alumnos" id="alumnos">
                <?php 
                while($tupla = mysqli_fetch_assoc($result_select_alumnos)) {
                    if (isset($_POST["alumnos"]) && $_POST["alumnos"] == $tupla["cod_alu"]) {
                        echo "<option selected value='".$tupla["cod_alu"]."'>".$tupla["nombre"]."</option>";
                        $nombre_alumno = $tupla["nombre"];
                    } else 
                        echo "<option value='".$tupla["cod_alu"]."'>".$tupla["nombre"]."</option>";
                }
                ?>
            </select>
            <button type="submit" name="btnVerNotas">Ver Notas</button>
        </form>
        <?php
        if (isset($_POST["alumnos"])) {
            echo "<h2>Notas del alumno ".$nombre_alumno."</h2>";
        }
    }
    ?>
</body>

</html>