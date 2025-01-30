<?php 
$headers[]="Authorization: Bearer ".$_SESSION["token"];
$url=DIR_SERV."/obtenerLibro/".$_POST["btnDetalles"];
$respuesta=consumir_servicios_JWT_REST($url,"GET",$headers);
$json_libro=json_decode($respuesta,true);
if(!$json_libro)
{
     session_destroy();
     die(error_page("Gestión Libros","<h1>Librería</h1><p>Error consumiendo el servicio Rest: <strong>".$url."</strong></p>"));
}
if(isset($json_libro["error"]))
{
     session_destroy();
     die(error_page("Gestión Libros","<h1>Librería</h1><p>".$json_libro["error"]."</p>"));
}

if(isset($json_libro["no_auth"]))
{
    session_unset();
    $_SESSION["mensaje_seguridad"]="El tiempo de sesión de la API ha expirado";
    header("Location:index.php");
    exit;
}
if(isset($json_libro["mensaje_baneo"]))
{
    session_unset();
    $_SESSION["mensaje_seguridad"]="Usted ya no se encuentra registrado en la BD";
    header("Location:index.php");
    exit;
}
?>