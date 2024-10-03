<?php 

    // function todo_letras($texto) {
    //     $patron = '/^[a-zA-Z\s]+$/';
    //     $todo_l = true;
    //     if (!preg_match($patron, $texto)) {
    //         $todo_l = false;
    //     } 
    //     return $todo_l;
    // }

    function quitar_espacios($texto) {
        $cadena = "";
        for ($i=0; $i < strlen($texto); $i++) { 
            if ($texto[$i] != " ") {
                $cadena .= $texto[$i];
            }
        }
        return $cadena;
    }

    function todo_letras2($texto) {
        $texto_sin_espacios = quitar_espacios($texto);
        $todo_l = true;
        for($i = 0; $i < strlen($texto_sin_espacios); $i++) {
            if (ord($texto_sin_espacios[$i]) < ord("A") || ord($texto_sin_espacios[$i]) > ord("z")) {
                $todo_l = false;
                break;
            }
        }
        return $todo_l;
    }

    if (isset($_POST["btnComprobar"])) {
        $texto1 = trim($_POST["palabra1"]); //el trim lo dejo por si alguien da un trim
        $todo_letra = todo_letras($texto1);
        $frase_formulada = todo_letras2($texto1);
        $l_texto1 = strlen($frase_formulada);

        $error_form =  $texto1 == "" || strlen($texto1) < 3 || !$frase_formulada;
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