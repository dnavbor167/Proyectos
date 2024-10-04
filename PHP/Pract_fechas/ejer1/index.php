<?php 
    function comprobar_fecha($fecha) {
        $fecha_valida = true;
        if (strlen($fecha) === 10) {
            if ($fecha[2] != "/" && $fecha[5] != "/") {
                $fecha_valida = false;
            } else {
                if (!checkdate((int)substr($fecha,3,2),(int)substr($fecha,0,2), (int)substr($fecha,6,4))) {
                    $fecha_valida = false;
                }
            }
        } else {
            $fecha_valida = false;
        }
        return $fecha_valida;
    }

    if (isset($_POST["btnCalcular"])) {
        $fecha1 = trim($_POST["fecha1"]);
        $fecha2 = trim($_POST["fecha2"]);
        $fecha1_formato = comprobar_fecha($fecha1);
        $fecha2_formato = comprobar_fecha($fecha2);

        $error_form =  $fecha1 == "" || $fecha2 == "" || !$fecha1_formato || !$fecha2_formato;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Romanos a árabes - Formulario</title>
    <style>
        div {
            border: solid 2px black;
        }

        #azul {
            background-color: lightblue;
        }

        #verde {
            margin-top: 1rem;
            background-color: lightgreen;
        }

        .error {
            color: red;
        }

        h1 {
            text-align: center;
        }

        p, button {
            margin-left: .5rem;
        }

        form {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <?php 
        if(isset($_POST["btnCalcular"]) && !$error_form) {
            require "vistas/vista_formulario.php";
            require "vistas/vista_respuesta.php";
        } else {
            require "vistas/vista_formulario.php";
        }
    ?>
</body>
</html>