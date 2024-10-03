<?php 
    function todo_numeros($texto) {
        $todo_n = true;
        for($i = 0; $i < strlen($texto); $i++) {
            if (!is_numeric($texto[$i])) {
                $todo_n = false;
                break;
            }
        }
        return $todo_n;
    }

    if (isset($_POST["btnConvertir"])) {
        $texto1 = trim($_POST["palabra1"]);

        $error_form =  $texto1 == "" || !todo_numeros($texto1) || $texto1 > 5000;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Árabes a romanos - Formulario</title>
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
        if(isset($_POST["btnConvertir"]) && !$error_form) {
            require "vistas/vista_formulario.php";
            require "vistas/vista_respuesta.php";
        } else {
            require "vistas/vista_formulario.php";
        }
    ?>
</body>
</html>