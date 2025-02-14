<?php
//Esto lo ejecutaremos siempre para saber si tiene alguna guardia en el calendario o no
$headers[] = "Authorization: Bearer " . $_SESSION["token"];
$url = DIR_SERV . "/deGuardia/" . $datos_usu_log["id_usuario"];
$respuesta = consumir_servicios_JWT_REST($url, "GET", $headers);
$json_deGuardia = json_decode($respuesta, true);
if (!$json_deGuardia) {
    session_destroy();
    die(error_page("Gestión de Guardias", "<h1>Gestión de Guardias</h1><p>Error consumiendo el servicio Rest: <strong>" . $url . "</strong></p>"));
}
if (isset($json_deGuardia["error"])) {
    session_destroy();
    die(error_page("Gestión de Guardias", "<h1>Gestión de Guardias</h1><p>" . $json_deGuardia["error"] . "</p>"));
}

if (isset($json_deGuardia["no_auth"])) {
    session_unset();
    $_SESSION["mensaje_seguridad"] = "El tiempo de sesión de la API ha expirado";
    header("Location:index.php");
    exit;
}
if (isset($json_deGuardia["mensaje_baneo"])) {
    session_unset();
    $_SESSION["mensaje_seguridad"] = "Usted ya no se encuentra registrado en la BD";
    header("Location:index.php");
    exit;
}

$usuario_de_guardia = $json_deGuardia["de_guardia"];

if (isset($_POST["btnGuardia"])) {
    //Esto lo ejecutaremos cuando se pulse el botón "btnGuardia" y llamaremos al servicio para obtener todos los usuarios
    $headers[] = "Authorization: Bearer " . $_SESSION["token"];
    $url = DIR_SERV . "/usuariosGuardia/" . $_POST["btnGuardia"][0] . "/" . $_POST["btnGuardia"][1];
    $respuesta = consumir_servicios_JWT_REST($url, "GET", $headers);
    $json_usuarios_de_guardia = json_decode($respuesta, true);
    if (!$json_usuarios_de_guardia) {
        session_destroy();
        die(error_page("Gestión de Guardias", "<h1>Gestión de Guardias</h1><p>Error consumiendo el servicio Rest: <strong>" . $url . "</strong></p>"));
    }
    if (isset($json_usuarios_de_guardia["error"])) {
        session_destroy();
        die(error_page("Gestión de Guardias", "<h1>Gestión de Guardias</h1><p>" . $json_usuarios_de_guardia["error"] . "</p>"));
    }

    if (isset($json_usuarios_de_guardia["no_auth"])) {
        session_unset();
        $_SESSION["mensaje_seguridad"] = "El tiempo de sesión de la API ha expirado";
        header("Location:index.php");
        exit;
    }
    if (isset($json_usuarios_de_guardia["mensaje_baneo"])) {
        session_unset();
        $_SESSION["mensaje_seguridad"] = "Usted ya no se encuentra registrado en la BD";
        header("Location:index.php");
        exit;
    }

    $usuarios_de_guardia = $json_usuarios_de_guardia["usuarios"];
}

if (isset($_POST["btnInformacion"])) {
    $headers[] = "Authorization: Bearer " . $_SESSION["token"];
    $url = DIR_SERV . "/usuario/" . $_POST["btnInformacion"];
    $respuesta = consumir_servicios_JWT_REST($url, "GET", $headers);
    $json_info_user = json_decode($respuesta, true);
    if (!$json_info_user) {
        session_destroy();
        die(error_page("Gestión de Guardias", "<h1>Gestión de Guardias</h1><p>Error consumiendo el servicio Rest: <strong>" . $url . "</strong></p>"));
    }
    if (isset($json_info_user["error"])) {
        session_destroy();
        die(error_page("Gestión de Guardias", "<h1>Gestión de Guardias</h1><p>" . $json_info_user["error"] . "</p>"));
    }

    if (isset($json_info_user["no_auth"])) {
        session_unset();
        $_SESSION["mensaje_seguridad"] = "El tiempo de sesión de la API ha expirado";
        header("Location:index.php");
        exit;
    }
    if (isset($json_info_user["mensaje_baneo"])) {
        session_unset();
        $_SESSION["mensaje_seguridad"] = "Usted ya no se encuentra registrado en la BD";
        header("Location:index.php");
        exit;
    }

    $info_user = $json_info_user["usuario"];
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Guardias</title>
    <style>
        .enlinea {
            display: inline
        }

        .enlace {
            background: none;
            border: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }

        table,
        th,
        td {
            border: solid 1px black;
        }

        table {
            border-collapse: collapse;
            width: 90%;
            margin: 0 auto;
        }

        th {
            background-color: lightgray;
        }

        th,
        td {
            padding: .5rem 1rem;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Gestión de Guardias</h1>
    <div>
        Bienvenido <strong><?php echo $datos_usu_log["usuario"]; ?></strong> - <form class="enlinea" action="index.php" method="post"><button class="enlace" type="submit" name="btnSalir">Salir</button></form>
    </div>

    <h2>Equipos de Guardia del IES Mar de Alborán</h2>

    <?php
    $numero_equipo = 0;
    echo "<table>";
    echo "<tr><th></th><th>Lunes</th><th>Martes</th><th>Miércoles</th><th>Jueves</th><th>Viernes</th></tr>";

    for ($hora = 1; $hora <= 7; $hora++) {
        echo "<tr>";
        if ($hora == 4)
            echo "<td colspan='7'>RECREO</td>";
        else {
            $hora_dsp_recreo = $hora;
            if ($hora > 4)
                $hora_dsp_recreo = $hora - 1;

            echo "<td>" . $hora_dsp_recreo . "º Hora</td>";
            for ($dia = 1; $dia <= 5; $dia++) {
                $numero_equipo++;
                $td_rep = false;
                foreach ($usuario_de_guardia as $value) {
                    if ($value["dia"] == $dia && $value["hora"] == $hora_dsp_recreo) {
                        $td_rep = true;
                        echo "<td><form action='index.php' method='post'><button name='btnGuardia' value='" . $value["dia"], $value["hora"] . "' class='enlace'>Equipo " . $numero_equipo . "</button></form></td>";
                    }
                }
                if (!$td_rep) {
                    echo "<td></td>";
                } else
                    $td_rep = false;
            }
        }
        echo "</tr>";
    }
    echo "</table>";


    if (isset($_POST["btnGuardia"])) {
        $dia_semana = ["", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes"];

        echo "<h1>EQUIPO DE GUARDIA</h1>";
        echo "<h3>" . $dia_semana[$_POST["btnGuardia"][0]] . " a " . $_POST["btnGuardia"][1] . " hora</h3>";
        echo "<table>";
        echo "<tr><th>Profesores de Guardia</th><th>Información del profesor con id_usuario:</th></tr>";

        $row = count($usuarios_de_guardia);
        $tabla_td = true;
        foreach ($usuarios_de_guardia as $value) {

            echo "<tr>";
            //Aquí escribiremos un hidden para no perder esta tabla, en el que guardaremos el dia y la hora con el mismo name
            echo "<td><form action='index.php' method='post'><input type='hidden' name='btnGuardia' value='" . $_POST["btnGuardia"] . "'><button name='btnInformacion' value='" . $value["id_usuario"] . "' class='enlace'>Equipo " . $value["nombre"] . "</button></form></td>";
            if ($tabla_td) {
                echo "<td rowspan='" . $row . "'>";
                if (isset($info_user)) {
                    echo "<p><strong>Nombre: </strong>" . $info_user["nombre"] . "</p>";
                    echo "<p><strong>Usuario: </strong>" . $info_user["usuario"] . "</p>";
                    echo "<p><strong>Contraseña: </strong></p>";
                    echo "<p><strong>Email: </strong>" . $info_user["email"] . "</p>";
                }

                echo "</td>";
                $tabla_td = false;
            }
            echo "</tr>";
        }


        echo "</table>";
    }
    ?>
</body>

</html>