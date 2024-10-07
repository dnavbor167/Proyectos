<?php 
    function buenos_separadores($fecha) {
        return $fecha[2] == "/" && $fecha[5] == "/";
    }
    function buenos_numeros($texto) {
        return is_numeric(substr($texto,0,2)) && is_numeric(substr($texto,3,2)) && is_numeric(substr($texto,6,2));
    }

    function fecha_valida($texto) {
        return checkdate(substr($texto,3,2),substr($texto,0,2),substr($texto,6,2));
    }

    if (isset($_POST["btnCalcular"])) {
        $fecha1 = trim($_POST["fecha1"]);
        $fecha2 = trim($_POST["fecha2"]);

        $error_fecha1 = $fecha1 == "" || strlen($fecha1) != 10 || !buenos_separadores($fecha1) || !buenos_numeros($fecha1) || !fecha_valida($fecha1);
        $error_fecha2 = $fecha2 == "" || strlen($fecha2) != 10 || !buenos_separadores($fecha2) || !buenos_numeros($fecha2) || !fecha_valida($fecha2);

        $error_form = $error_fecha1 || $error_fecha2;
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