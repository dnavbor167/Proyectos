<?php
session_name("Examen2_23_24");
session_start();

require "src/funciones_ctes.php";

try {
    @$conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
    mysqli_set_charset($conexion, "utf8");
} catch (Exception $e) {
    session_destroy();
    die(error_page("Examen2 PHP", "<p>No se ha podido conectar a la BD: " . $e->getMessage() . "</p>"));
}

if (isset($_POST["btnAgregar"])) {
    try {
        $consulta = "insert into horario_lectivo (usuario, dia, hora, grupo) values('" . $_POST["profesor"] . "','" . $_POST["dia"] . "','" . $_POST["hora"] . "','" . $_POST["grupo"] . "')";
        mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        session_destroy();
        mysqli_close($conexion);
        die(error_page("Examen2 PHP", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
    }

    $_SESSION["mensaje_accion"] = "Grupo insertado con éxito";
    $_SESSION["profesor"] = $_POST["profesor"];
    $_SESSION["dia"] = $_POST["dia"];
    $_SESSION["hora"] = $_POST["hora"];
    header("Location:index.php");
    exit;
}

if (isset($_POST["btnQuitar"])) {
    try {
        $consulta = "delete from horario_lectivo where id_horario='" . $_POST["btnQuitar"] . "'";
        mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        session_destroy();
        mysqli_close($conexion);
        die(error_page("Examen2 PHP", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
    }

    $_SESSION["mensaje_accion"] = "Grupo borrado con éxito";
    $_SESSION["profesor"] = $_POST["profesor"];
    $_SESSION["dia"] = $_POST["dia"];
    $_SESSION["hora"] = $_POST["hora"];
    header("Location:index.php");
    exit;
}

if (isset($_SESSION["profesor"])) {
    $_POST["dia"] = $_SESSION["dia"];
    $_POST["hora"] = $_SESSION["hora"];
    $_POST["profesor"] = $_SESSION["profesor"];
    $mensaje_accion = $_SESSION["mensaje_accion"];
    session_unset($_SESSION["profesor"]);
    session_unset($_SESSION["hora"]);
    session_unset($_SESSION["dia"]);
    session_unset($_SESSION["mensaje_accion"]);
}



try {
    $consulta = "select id_usuario, nombre from usuarios";
    $result_profesores = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    session_destroy();
    mysqli_close($conexion);
    die(error_page("Examen2 PHP", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
}

if (isset($_POST["profesor"])) {
    try {
        $consulta = "select dia,hora,nombre from horario_lectivo, grupos where horario_lectivo.grupo=grupos.id_grupo AND horario_lectivo.usuario='" . $_POST["profesor"] . "'";
        $result_horario_profe = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        session_destroy();
        mysqli_close($conexion);
        die(error_page("Examen2 PHP", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
    }


    while ($tupla = mysqli_fetch_assoc($result_horario_profe)) {
        if (isset($horario[$tupla["dia"]][$tupla["hora"]]))
            $horario[$tupla["dia"]][$tupla["hora"]] .= "/" . $tupla["nombre"];
        else
            $horario[$tupla["dia"]][$tupla["hora"]] = $tupla["nombre"];
    }
    mysqli_free_result($result_horario_profe);
}

if (isset($_POST["dia"])) {
    try {
        $consulta = "select id_horario, nombre from horario_lectivo, grupos where horario_lectivo.grupo=grupos.id_grupo AND horario_lectivo.dia='" . $_POST["dia"] . "' AND horario_lectivo.hora='" . $_POST["hora"] . "' AND horario_lectivo.usuario='" . $_POST["profesor"] . "'";
        $result_horario_profe_dia_hora = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        session_destroy();
        mysqli_close($conexion);
        die(error_page("Examen2 PHP", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
    }

    try {
        $consulta = "select * from grupos where id_grupo not in (select grupo from horario_lectivo where dia='" . $_POST["dia"] . "' AND hora='" . $_POST["hora"] . "' AND usuario='" . $_POST["profesor"] . "')";
        $result_grupos_libres_profesor_dia_hora = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        session_destroy();
        mysqli_close($conexion);
        die(error_page("Examen2 PHP", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
    }
}

if (isset($_POST["btnLogin"])) {
    //Comprobar errores login
    $error_usuario = $_POST["usuario"] == "";
    $error_clave = $_POST["clave"] == "";
    $error_login = $error_usuario || $error_clave;

    if (!$error_login) {
        //Me he conectado y ahora hago la consulta
        try {
            $consulta = "select usuario from usuarios where usuario = '" . $_POST["usuario"] . "' and clave = '" . md5($_POST["clave"]) . "'";
            $datos_usuarios = mysqli_query($conexion, $consulta);
            $n_tuplas = mysqli_num_rows($datos_usuarios);
            mysqli_free_result($datos_usuarios);
            if ($n_tuplas > 0) {
                //El usuario se encuentra registrado y tengo que iniciar sesión
                mysqli_close($conexion);
                $_SESSION["usuario"] = $_POST["usuario"];
                $_POST["profesor"] = $_SESSION["usuario"];
                $_SESSION["clave"] = md5($_POST["clave"]);
                $_SESSION["ultm_accion"] = time();
                header("Location:index.php");
                exit;
            } else {
                $error_usuario = true;
                mysqli_close($conexion);
            }
        } catch (Exception $e) {
            mysqli_close($conexion);
            session_destroy();
            die(error_page("Práctica 10", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
        }
    }
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
        .centrado {
            text-align: center
        }

        table,
        td,
        th {
            border: 1px solid black
        }

        table {
            border-collapse: collapse;
            margin: 0 auto;
            width: 90%
        }

        th {
            background-color: #CCC
        }

        .enlace {
            background: none;
            border: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer
        }

        .mensaje {
            font-size: 1.25rem;
            color: blue
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <?php
    //SI EXISTE SESION
    if (isset($_SESSION["usuario"])) {
        require "src/seguridad.php";
        if ($datos_usuario_log["tipo"] == "normal") {
        if (isset($_POST["profesor"])) {
            echo "<h3 class='centrado'>Horario del Profesor:" . $nombre_profesor . "</h3>";
            echo "<table class='centrado'>";
            echo "<tr>";
            echo "<th></th>";
            for ($i = 1; $i <= count(DIAS); $i++)
                echo "<th>" . DIAS[$i] . "</th>";
            echo "</tr>";

            for ($hora = 1; $hora <= count(HORAS); $hora++) {
                echo "<tr>";
                echo "<th>" . HORAS[$hora] . "</th>";
                if ($hora == 4) {
                    echo "<td colspan='5'>RECREO</td>";
                } else {
                    for ($dia = 1; $dia <= count(DIAS); $dia++) {
                        echo "<td>";
                        if (isset($horario[$dia][$hora])) {
                            echo $horario[$dia][$hora];
                        }
                        echo "<form action='index.php' method='post'>";
                        echo "<input type='hidden' name='dia' value='" . $dia . "'/>";
                        echo "<input type='hidden' name='hora' value='" . $hora . "'/>";
                        echo "<input type='hidden' name='profesor' value='" . $_POST["profesor"] . "'/>";
                        echo "</form>";
                        echo "</td>";
                    }
                }

                echo "</tr>";
            }
            echo "</table>";
        }else {
    ?>
            <h1>Examen2 PHP</h1>
            <h2>Horario de los Profesores</h2>
            <form action="index.php" method="post">
                <p>
                    <label for="profesor">Horario del Profesor: </label>
                    <select name="profesor" id="profesor">
                        <?php
                        while ($tupla = mysqli_fetch_assoc($result_profesores)) {
                            if (isset($_POST["profesor"]) && $_POST["profesor"] == $tupla["id_usuario"]) {
                                echo "<option selected value='" . $tupla["id_usuario"] . "'>" . $tupla["nombre"] . "</option>";
                                $nombre_profesor = $tupla["nombre"];
                            } else
                                echo "<option value='" . $tupla["id_usuario"] . "'>" . $tupla["nombre"] . "</option>";
                        }
                        mysqli_free_result($result_profesores);
                        ?>
                    </select>
                    <button type="submit" name="btnVerHorario">Ver Horario</button>
                </p>
            </form>
        <?php
            if (isset($_POST["profesor"])) {
                echo "<h3 class='centrado'>Horario del Profesor:" . $nombre_profesor . "</h3>";
                echo "<table class='centrado'>";
                echo "<tr>";
                echo "<th></th>";
                for ($i = 1; $i <= count(DIAS); $i++)
                    echo "<th>" . DIAS[$i] . "</th>";
                echo "</tr>";

                for ($hora = 1; $hora <= count(HORAS); $hora++) {
                    echo "<tr>";
                    echo "<th>" . HORAS[$hora] . "</th>";
                    if ($hora == 4) {
                        echo "<td colspan='5'>RECREO</td>";
                    } else {
                        for ($dia = 1; $dia <= count(DIAS); $dia++) {
                            echo "<td>";
                            if (isset($horario[$dia][$hora])) {
                                echo $horario[$dia][$hora];
                            }
                            echo "<form action='index.php' method='post'>";
                            echo "<input type='hidden' name='dia' value='" . $dia . "'/>";
                            echo "<input type='hidden' name='hora' value='" . $hora . "'/>";
                            echo "<input type='hidden' name='profesor' value='" . $_POST["profesor"] . "'/>";
                            echo "<button class='enlace' name='btnEditar' type='submit'>Editar</button>";
                            echo "</form>";
                            echo "</td>";
                        }
                    }

                    echo "</tr>";
                }
                echo "</table>";

                if (isset($_POST["dia"])) {
                    if ($_POST["hora"] <= 3)
                        echo "<h2>Editando la " . $_POST["hora"] . "º hora (" . HORAS[$_POST["hora"]] . ") del " . DIAS[$_POST["dia"]] . "</h2>";
                    else
                        echo "<h2>Editando la " . ($_POST["hora"] - 1) . "º hora (" . HORAS[$_POST["hora"]] . ") del " . DIAS[$_POST["dia"]] . "</h2>";

                    if (isset($mensaje_accion))
                        echo "<p class='mensaje'>" . $mensaje_accion . "</p>";


                    echo "<table class='centrado'>";
                    echo "<tr><th>Grupo</th><th>Acción</th></tr>";
                    while ($tupla = mysqli_fetch_assoc($result_horario_profe_dia_hora)) {
                        echo "<tr>";
                        echo "<td>" . $tupla["nombre"] . "</td>";
                        echo "<td>";
                        echo "<form action='index.php' method='post'>";
                        echo "<input type='hidden' name='dia' value='" . $_POST["dia"] . "'/>";
                        echo "<input type='hidden' name='hora' value='" . $_POST["hora"] . "'/>";
                        echo "<input type='hidden' name='profesor' value='" . $_POST["profesor"] . "'/>";
                        echo "<button name='btnQuitar' class='enlace' value='" . $tupla["id_horario"] . "' type='submit'>Quitar</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    mysqli_free_result($result_horario_profe_dia_hora);

                    echo "<form action='index.php' method='post'>";
                    echo "<input type='hidden' name='dia' value='" . $_POST["dia"] . "'/>";
                    echo "<input type='hidden' name='hora' value='" . $_POST["hora"] . "'/>";
                    echo "<input type='hidden' name='profesor' value='" . $_POST["profesor"] . "'/>";
                    echo "<p>";
                    echo "<select name='grupo'>";
                    while ($tupla = mysqli_fetch_assoc($result_grupos_libres_profesor_dia_hora)) {
                        echo "<option value='" . $tupla["id_grupo"] . "'>" . $tupla["nombre"] . "</option>";
                    }
                    echo "</select>";
                    echo "<button type='submit' name='btnAgregar'>Añadir</button>";
                    echo "</p>";
                    echo "</form>";
                }
            }
        }
    } else {
        //LOGIN 
        ?>
        <h1>Login</h1>
        <form action="index.php" method="post" enctype="multipart/form-data">
            <p>
                <label for="usuario">Usuario: </label>
                <input type="text" name="usuario" id="usuario" value="<?php if (isset($_POST["usuario"])) echo $_POST["usuario"]; ?>">
                <?php
                if (isset($_POST["btnLogin"]) && $error_usuario) {
                    if ($_POST["usuario"] == "")
                        echo "<span class='error'>* Campo vacío *</span>";
                    else
                        echo "<span class='error'>* Usuario y/o contraseña incorrecta *</span>";
                }
                ?>
            </p>

            <p>
                <label for="clave">Contraseña: </label>
                <input type="password" name="clave" id="clave">
                <?php
                if (isset($_POST["btnLogin"]) && $error_clave) {
                    echo "<span class='error'>* Campo vacío *</span>";
                }
                ?>
            </p>
            <p>
                <button type="submit" name="btnLogin">Login</button>
            </p>
        </form>

        <?php
        if (isset($_SESSION["mensaje_seguridad"])) {
            echo "<p class='mensaje'>" . $_SESSION["mensaje_seguridad"] . "</p>";
            session_destroy();
        }
        ?>
    <?php
    }

    ?>
</body>

</html>