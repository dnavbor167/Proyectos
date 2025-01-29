<?php 
session_name("Repas_Examen");
session_start();
require "src/funciones_ctes.php";

if (isset($_SESSION["token"])) {
    require "vistas/vista_logueado.php";
} else {
    require "vistas/vista_login.php";
}
?>