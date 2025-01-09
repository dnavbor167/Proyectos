<?php

require __DIR__ . '/Slim/autoload.php';

$app= new \Slim\App;

$app->get('/saludo',function(){

    $respuesta["mensaje"]="Hola que tal?";
    echo json_encode($respuesta);
});

$app->get('/saludo/{nombre}',function($request){
    $nombre=$request->getAttribute("nombre");
    $respuesta["mensaje"]="Hola que tal, ".$nombre."?";
    echo json_encode($respuesta);
});

$app->post('/saludo',function($request){
    //Se manda por abajo (no por la url)
    $nombre=$request->getParam("nombre");
    $respuesta["mensaje"]="Hola que tal, ".$nombre."?";
    echo json_encode($respuesta);

});

//hacer dos metodos, uno delete y otro put
//delete('/borrar_saludo/{id}') esto borrará de un array de elementos el saludo con ese id
$app->delete('/borrar_saludo/{id}', function ($request) {
    $id = $request->getAttribute("id");
    $respuesta["mensaje"] = "Mensaje con id: " . $id . " borrado correctamente";
    echo json_encode($respuesta);
});

//put('/cambiar_saludo/{id}') cambiará el saludo en esa posicion del array
$app->put('/cambiar_saludo/{id}', function ($request) {
    $id = $request->getAttribute("id");
    $nombre_nuevo = $request->getParam("name");
    $respuesta["mensaje"] = "Mensaje con id: " . $id . " actualizado correctamente al valor: " . $nombre_nuevo;
    echo json_encode($respuesta);
});

$app->run();

?>