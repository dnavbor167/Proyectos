<?php
session_name("Examen4_SW_23_24");
session_start();

require "../src/funciones_ctes.php";

if (isset($_SESSION["token"])) {
    $salto = "../index.php";
    require "../src/seguridad.php";
    if ($datos_usu_log["tipo"] == "tutor")
        require "../vistas/vista_admin.php";
} else {
    header("Location:../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>normal</title>
</head>

<body>
    <p>Eres normal</p>
</body>

</html>