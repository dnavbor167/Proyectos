<?php 

    // function todo_letras($texto) {
    //     $texto_upper = strtoupper($texto);
    //     $patron = '/^[MDCLXVI]+$/';
    //     $todo_l = true;
        
    //     if (!preg_match($patron, $texto_upper)) {
    //         $todo_l = false;
    //     }
    //     return $todo_l;
    // }

    const VALORES = [
        "M" => 1000,
        "D" => 500,
        "C" => 100,
        "L" => 50,
        "X" => 10,
        "V" => 5,
        "I" => 1
    ];

    function repite_bien($texto) {
        $cont["M"]=4;
        $cont["D"]=1;
        $cont["C"]=4;
        $cont["L"]=1;
        $cont["X"]=4;
        $cont["V"]=1;
        $cont["I"]=4;

        $bueno = true;

        for ($i=0; $i < strlen($texto); $i++) { 
            $cont[$texto[$i]]--;
            if ($cont[$texto[$i]] < 0) {
                $bueno = false;
                break;
            }
        }

        return $bueno;
    }

    function letras_correcta($texto) {
        $correcto = true;
        for ($i=0; $i < strlen($texto); $i++) { 
            if (!isset(VALORES[$texto[$i]])) {
                $correcto = false;
                break;
            }
        }
        return $correcto;
    }

    function orden_bueno($texto) {
        $bueno = true;
        for ($i=0; $i < strlen($texto) - 1; $i++) { 
            if (VALORES[$texto[$i]] < VALORES[$texto[$i+1]]) {
                $bueno = false;
                break;
            }
        }
        return $bueno;
    }

    function bien_escrito_romano($texto) {
        
        return letras_correcta($texto) && orden_bueno($texto) && repite_bien($texto);
    }

    if (isset($_POST["btnConvertir"])) {
        $texto1 = trim($_POST["palabra1"]);
        $texto1_m = strtoupper($texto1);

        $error_form =  $texto1 == "" || !bien_escrito_romano($texto1_m);
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
        if(isset($_POST["btnConvertir"]) && !$error_form) {
            require "vistas/vista_formulario.php";
            require "vistas/vista_respuesta.php";
        } else {
            require "vistas/vista_formulario.php";
        }
    ?>
</body>
</html>