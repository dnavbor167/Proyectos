<?php

require __DIR__ . '/Slim/autoload.php';

require "src/funciones_servicios.php";

$app = new \Slim\App;

$app->get('/logueado', function () {

    $test = validateToken();
    if (is_array($test)) {
        echo json_encode($test);
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});


$app->get('/login', function ($request) {
    /*$datos_login[] = $request->getParam("usuario");
    $datos_login[] = $request->getParam("clave");*/

    $datos_login[] = "masantos76";
    $datos_login[] = md5("123456");

    echo json_encode(login($datos_login));
});


// Una vez creado servicios los pongo a disposición
$app->run();
