<?php 
    echo "<p><strong>Nombre: </strong>" . $_POST["name"] . "</p>";
    echo "<p><strong>Apellidos: </strong>" . $_POST["apellidos"] . "</p>";
    echo "<p><strong>Contraseña: </strong>" . $_POST["pass"] . "</p>";
    echo "<p><strong>DNI: </strong>" . $_POST["dni"] . "</p>";
    echo "<p><strong>Sexo: </strong>";
    if (isset($_POST["sexo"])) {
        echo $_POST["sexo"];
    }
    echo"</p>";

    if (isset($_POST["btnEnviar"]) && $_FILES["foto"]["name"]!="" && !$erro_foto) {
        echo "<h1>Información de la imatgen subida</h1>";
        //GENERACIÓN DE ID ÚNICO
        $numero_unico = md5(uniqid(uniqid(), true));
        $ext = tiene_extension($_FILES["foto"]["name"]);
        $nombre_imagen = "img_".$numero_unico.".".$ext;

        //para mover archivos del formulario
        //la @ es para poder predefinir posteriormente los warning
        //OJO PORQUE TENGO QUE DARLE PERMISOS TOTALES A AL CARPETA DESTENIO sudo chmod 777 -R 'CARPETA DESTINO'
        @$var = move_uploaded_file($_FILES["foto"]["tmp_name"],"images/".$nombre_imagen);
        if (!$var) {
            echo "<p>Error al cargar la imagen en el servidor</p>";
        } else {
            echo "<p><strong>Nombre Original: </strong>".$_FILES["foto"]["name"]."</p>";
            echo "<p><strong>Tipo: </strong>".$_FILES["foto"]["type"]."</p>";
            echo "<p><strong>Tamaño: </strong>".$_FILES["foto"]["size"]."</p>";
            echo "<p><strong>Archivo subido temporalmente: </strong>".$_FILES["foto"]["tmp_name"]."</p>";
            echo "<p><img src='images/".$nombre_imagen."' alt='Imagen' title='Imagen subida' width='300px'></p>";
        }
    }

    echo "<p><strong>Nacido en: </strong>" . $_POST["localidad"] . "</p>";
    echo "<p><strong>Comentarios: </strong>" . $_POST["comentarios"] . "</p>";
    echo "<p><strong>Subcripción: </strong>";
    if (isset($_POST["suscribete"])) {
        echo "Sí";
    } else {
        echo "No";
    }
    echo "</p>";
?>