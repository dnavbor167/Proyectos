<?php 
    function mi_in_array($elemento, $array) {
        $esta = false;
        for ($i = 0;$i < count($array); $i++) {
            if ($array[$i] == $elemento) {
                $esta = true;
                break;
            }
        }
        return $esta;
    }

    if(isset($_POST["btnEnviar"])) {
        $error_nombre = $_POST["nombre"] == "";
        $error_sexo = !isset($_POST["sexo"]);
        $errores_form = $error_nombre || $error_sexo;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
    <style>
        .errores {
            color:red;
        }
    </style>
</head>
<body>
    <?php 
        if (isset($_POST["btnEnviar"]) && !$errores_form) {
            require "vistas/vista_recogida.php";
        } else {
            require "vistas/vista_formularios.php";
        }
    ?>
</body>
</html>