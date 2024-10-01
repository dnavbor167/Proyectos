<?php 

    function todo_letras($texto) {
        $todo_l = true;
        for($i = 0; $i < strlen($texto); $i++) {
            if (ord($texto[$i]) < ord("A") || ord($texto[$i]) > ord("z")) {
                $todo_l = false;
                break;
            }
        }
        return $todo_l;
    }

    if (isset($_POST["btnComparar"])) {
        $texto1 = trim($_POST["palabra1"]);
        $texto2 = trim($_POST["palabra2"]);
        $l_texto1 = strlen($texto1);
        $l_texto2 = strlen($texto2);

        $error_texto1 =  $texto1 == "" || $l_texto1 < 3 || !todo_letras($texto1);
        $error_texto2 =  $texto2 == "" || $l_texto2 < 3 || !todo_letras($texto2);

        $error_form = $error_texto1 || $error_texto2;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ripios - Formulario</title>
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

        p {
            margin-left: .5rem;
        }

        form {
            margin-left: 1rem;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <?php 
        if(isset($_POST["btnComparar"]) && !$error_form) {
            require "vistas/vista_formulario.php";
            require "vistas/vista_respuesta.php";
        } else {
            require "vistas/vista_formulario.php";
        }
    ?>
</body>
</html>