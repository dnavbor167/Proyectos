<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría Ficheros de Texto</title>
</head>
<body>
    <?php 
        //Función para abrir un fichero
        //Parámetros => ruta y modo(r,w,a) TAMBIEN ESTA EL r+ QUE ES LECTURA Y ESCRITURA
        //si yo pongo w elimina todo lo que haya y poner algo nuevo
        //a para añadir
        //si le pongo como parametro un valor que no existe y le pongo w
        //crea ese nuevo fichero
        @$file = fopen("prueba.txt", "r");
        if (!$file) {
            //El die y el exit funcionan igual
            die("<p>No se ha podido abrir el fichero</p>");
        }

        echo "<h1>Primera Formas</h1>";
        //dame la primera línea y pone el puntero e la siguiente
        //Primera Línea: 
        $linea =fgets($file);
        echo "<p>".$linea."</p>";
        //Segunda Línea:
        $linea =fgets($file);
        echo "<p>".$linea."</p>";
        //Tercera Línea:
        $linea =fgets($file);
        echo "<p>".$linea."</p>";

        //Cuarta Línea(no existe esta línea) no muestra nada:
        $linea =fgets($file);
        echo "<p>".$linea."</p>";

        //para irse al principio del fichero
        fseek($file,0);

        echo "<h1>Segunda Formas</h1>";
        //como recorrerlo todo sin ir linea a linea:
        //mientras no sea la última línea:
        while(!feof($file)) {
            $linea2 = fgets($file);
            echo "<p>".$linea2."</p>";
        }
        echo "<h2>Fin del fichero</h2>";
        fseek($file, 0);

        echo "<h1>Tercera Formas</h1>";
        //si es capaz de asignar la línea a $linea3 entra en el while
        //MUY MUY MUY USADO
        while($linea3 = fgets($file)) {
            echo "<p>".$linea3."</p>";
        }
        echo "<h2>Fin del fichero</h2>";

        //Cuando abramos un fichero debemos cerrarlo
        fclose($file);

        //AÑADIR NUEVA LÍNEA A PRUEBA
        @$file = fopen("prueba.txt", "a");
        if (!$file) {
            //El die y el exit funcionan igual
            die("<p>No se ha podido abrir el fichero</p>");
        }

        //1º FORMA para poner una línea
        //constante php para salto de línea = PHP_EOL.
        fputs($file, PHP_EOL."Cuarta línea");
        fputs($file, PHP_EOL."Quinta línea");

        fclose($file);

        //LEER FICHERO DEL TIRÓN Y GUARDARLO EN UN STRING
        echo "<h2>Lectura entera de un fichero pre</h2>";
        $todo = file_get_contents("prueba.txt");
        echo "<pre>".$todo."</pre>";

        echo "<h2>Lectura entera de un fichero BR</h2>";
        $todo = file_get_contents("prueba.txt");
        //todo lo que encuentre salto de línea le pone un br
        echo nl2br($todo);


        echo "<h3>Lectura de una web</h3>";
        $web = file_get_contents("https://www.google.com");
        echo $web;
        //para escribir todo en un fichero
        file_put_contents();

        //Para saber si existe un archivo:
        file_exists("direccion");
    ?>
</body>
</html>