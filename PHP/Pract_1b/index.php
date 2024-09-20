<?php 
//aquí debe de estar para controlar los errores
    if (isset($_POST["btnEnviar"])) {
        //compruebo los errores del formulario
        $error_nombre = $_POST["name"] == "";
        $error_apellidos = $_POST["apellidos"] == "";
        $error_clave = $_POST["pass"] == "";
        $error_dni = $_POST["dni"] == "";
        $error_sexo = !isset($_POST["sexo"]);
        $error_comentarios = $_POST["comentarios"] == "";

        $errores_form = $error_nombre || $error_apellidos || $error_clave || $error_dni || $error_sexo || $error_comentarios;
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
        if (!isset($_POST["btnEnviar"]) || !$errores_form) {
            //el require no es mas que para ir a donde está el otro código y copiarlo
            require "vistas/vista_formulario.php";
        } else {
            require "vistas/vista_recogida.php";
        }
                
    ?>
</body>
</html>