<?php 

    function todo_letras($texto) {
        $texto_upper = strtoupper($texto);
        $patron = '/^[MDCLXVI]+$/';
        $todo_l = true;
        
        if (!preg_match($patron, $texto_upper)) {
            $todo_l = false;
        }
        return $todo_l;
    }

    function repeticiones($texto) {
        $romanos_l = true;
        $contador = 0;

        for ($i=0; $i < strlen($texto); $i++) { 
            $contador++;
            if ($texto[$i] == $texto[$i-1]) {
                $contador++;
            } else {
                $contador = 0;
            }
            if ($contador>=4) {
                $romanos_l = false;
            }
        }
        return $romanos_l;
    }

    if (isset($_POST["btnComprobar"])) {
        $texto1 = trim($_POST["palabra1"]);
        $todo_letra = todo_letras($texto1);
        $romanos_l = repeticiones($texto1);
        $l_texto1 = strlen($texto1);

        $error_form =  $texto1 == "" || !$todo_letra || !$romanos_l;
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
        if(isset($_POST["btnComprobar"]) && !$error_form) {
            require "vistas/vista_formulario.php";
            require "vistas/vista_respuesta.php";
        } else {
            require "vistas/vista_formulario.php";
        }
    ?>
</body>
</html>