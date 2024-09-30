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

    function todo_numeros($texto) {
        $todo_n = true;
        for($i = 0; $i < strlen($texto); $i++) {
            if (ord($texto[$i]) < ord(0) || ord($texto[$i]) > ord(57)) {
                $todo_n = false;
                break;
            }
        }
        return $todo_n;
    }

    if (isset($_POST["btnComparar"])) {
        $texto1 = trim($_POST["palabra1"]);
        $l_texto1 = strlen($texto1);
        $todo_letra = todo_letras($texto1);
        $todo_numeros = todo_letras($texto1);

        $error_texto1 =  $texto1 == "" && (!$todo_letra || !$todo_numeros);
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Palíndromos / capicúas - Formulario</title>
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
        if(isset($_POST["btnComparar"]) && !$error_texto1) {
            require "vistas/vista_formulario.php";
            require "vistas/vista_respuesta.php";
        } else {
            require "vistas/vista_formulario.php";
        }
    ?>
</body>
</html>