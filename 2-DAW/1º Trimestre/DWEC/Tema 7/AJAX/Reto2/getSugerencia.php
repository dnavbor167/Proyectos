<?php
// Array de nombres de ciudades
$usuario = "admin";
$clave = "1234";
$user = $_REQUEST["param1"];
$key = $_REQUEST["param2"];
$sugerencia = "";
if ($user !== "" && $key !== "") {
    if ($clave == $key && $usuario == $user) {
        $sugerencia = "USUARIO VÁLIDO";
    } else {
        $sugerencia = "USUARIO NO VÁLIDO";
    }
} else
    $sugerencia = "USUARIO NO VÁLIDO";
echo $sugerencia;
