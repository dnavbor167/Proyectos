<?php 
    function LetraNIF($dni) 
    {  
        return substr("TRWAGMYFPDXBNJZSQVHLCKEO", $dni % 23, 1); 
    }
    //Modo miguelAngel:
    //function dni_bien_escrito($texto) {
        //$dni = strtoupper($texto);
        //return strlen($dni) == 9 && is_numeric(substr($dni, 0, 8)) && substr($dni,-1)>="A" && substr($dni,-1)>="Z";
    //}

    function dni_valido($texto) {
        $valido = true;
        $dniNumero = "";
        if (strlen($texto) != 9) {
            $valido = false;
        } else {
            for ($i = 0; $i < strlen($texto)-1; $i++) {
                if (!is_numeric($texto[$i])) {
                    $valido = false;
                    break;
                }
                $dniNumero .= $texto[$i];
            }
            if (LetraNIF($dniNumero) != strtoupper($texto[strlen($texto)-1])) {
                $valido = false;
            }
        }
        return $valido;
        
    }

    function tiene_extension($texto) {
        $array_nombre = explode(".",$texto);
        if (count($array_nombre) <= 1) {
            //si no tiene extensión devuelve falso
            $respuesta = false;
        } else {
            //si tiene extensión devuelve que extensión es
            $respuesta = end($array_nombre);
        }
        return $respuesta;
    }

    if (isset($_POST["btnBorrar"])) {
        header("Location:index.php");
        exit;
    }

    
//aquí debe de estar para controlar los errores
    if (isset($_POST["btnEnviar"])) {
        //compruebo los errores del formulario
        $error_nombre = $_POST["name"] == "";
        $error_apellidos = $_POST["apellidos"] == "";
        $error_clave = $_POST["pass"] == "";
        $error_dni = $_POST["dni"] == "" || !dni_valido($_POST["dni"]);
        $error_sexo = !isset($_POST["sexo"]);
        $error_comentarios = $_POST["comentarios"] == "";
        //error foto
        $erro_foto = $_FILES["foto"]["name"] != "" && 
        ($_FILES["foto"]["error"] || 
        !tiene_extension($_FILES["foto"]["name"]) || 
        !getimagesize($_FILES["foto"]["tmp_name"]) || 
        $_FILES["foto"]["size"] > 500*1024);

        $errores_form = $error_nombre || $error_apellidos || $error_clave || $error_dni || $error_sexo || $error_comentarios || $erro_foto;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 1</title>
    <style>div{background-color: #;}</style>
    <style>
        .error {color: red;}
    </style>
</head>
<body>
    <?php 
        //debo controlar lo serrores
        if (!isset($_POST["btnEnviar"]) || $errores_form) {
            //el require no es mas que para ir a donde está el otro código y copiarlo
            require "vistas/vista_formulario.php";
        } else {
            require "vistas/vista_recogida.php";
        }
                
    ?>
</body>
</html>