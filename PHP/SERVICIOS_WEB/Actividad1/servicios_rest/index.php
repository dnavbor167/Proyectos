<?php

require __DIR__ . '/Slim/autoload.php';

require "src/funciones_cts.php";

$app = new \Slim\App;

//a)
$app->get('/productos', function () {

    echo json_encode(obtener_productos());
});

//b)
$app->get('/producto/{codigo}', function($request) {
    $cod=$request->getAttribute("codigo");
    echo json_encode(obtener_producto($cod));
});

//C)
$app->post('/producto/insertar', function ($request) {
    $cod = $request->getParam("cod");
    $nombre = $request->getParam("nombre");
    $nombre_corto = $request->getParam("nombre_corto");
    $descripcion = $request->getParam("descripcion");
    $pvp = $request->getParam("pvp");
    $familia = $request->getParam("familia");
    echo json_encode(insertar_producto($cod, $nombre, $nombre_corto, $descripcion, $pvp, $familia));
});

$app->run();

?>