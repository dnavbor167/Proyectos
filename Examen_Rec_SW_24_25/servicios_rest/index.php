<?php

require __DIR__ . '/Slim/autoload.php';

require "src/funciones_CTES.php";

$app = new \Slim\App;

$app->get('/logueado', function () {

    $test = validateToken();
    if (is_array($test)) {
        echo json_encode($test);
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});


$app->post('/login', function ($request) {

    $datos_login[] = $request->getParam("usuario");
    $datos_login[] = $request->getParam("clave");


    echo json_encode(login($datos_login));
});

$app->get('/usuario/{id_usuario}', function ($request) {
    $user = $request->getAttribute("id_usuario");
    echo (json_encode(datos_usuario($user)));
    
});

$app->get('/usuariosGuardia/{dia}/{hora}', function ($request) {

    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            $datos[] = $request->getAttribute("dia");
            $datos[] = $request->getAttribute("hora");
            echo (json_encode(usuarios_de_guardia($datos)));
        } else {
            echo (json_encode(($test)));
        }
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});

$app->get('/deGuardia/{id_usuario}', function ($request) {

    $test = validateToken();
    if (is_array($test)) {
        if (isset($test["usuario"])) {
            $datos = $request->getAttribute("id_usuario");
            echo (json_encode(guardias_de_un_usuario($datos)));
        } else {
            echo (json_encode(($test)));
        }
    } else
        echo json_encode(array("no_auth" => "No tienes permiso para usar el servicio"));
});



$app->run();
