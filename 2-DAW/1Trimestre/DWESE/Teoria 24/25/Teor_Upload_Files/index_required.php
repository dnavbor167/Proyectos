<?php 

    function tiene_extension($texto) {
        $array_nombre = explode(".",$texto);
        if (count($array_nombre) <= 1) {
            //si no tiene extensión devuelve falso
            $respuesta = false;
        } else {
            //si tiene extensión devuelve que extensión es
            $respuesta = end($array_nombre);
        }
        return $respuesta;
    }
    if (isset($_POST["btnEnviar"])) {
        //getimagesize($_FILES["foto"]["temp_name"]
        //eso es para saber si es un archivo imagen o no
        $erro_foto = $_FILES["foto"]["error"] || !tiene_extension($_FILES["foto"]["name"]) || !getimagesize($_FILES["foto"]["tmp_name"]) || $_FILES["foto"]["size"] > 500*1024;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theory Upload Files</title>
    <style>
        .error {color:red;}
    </style>
</head>
<body>
    <h1>Theroy Upload Files</h1>

    <form action="index_required.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="foto">Seleccione un archivo imagen con extensión (Máximo 500KB): </label>
            <input type="file" name="foto" id="foto" accept="image/*">
            <?php 
                if (isset($_POST["btnEnviar"]) && $erro_foto) {
                    if ($_FILES["foto"]["name"] == "") {
                        echo "<span class='error'> *Debes seleccionar un fichero* </span>";
                    } else if($_FILES["foto"]["error"]) {
                        echo "<span class='error'> *No se ha subido el archivo seleccionado al servidor* </span>";
                    } else if(!tiene_extension($_FILES["foto"]["name"])) {
                        echo "<span class='error'> *Has seleccionado un fichero sin extensión* </span>";
                    } else if(!getimagesize($_FILES["foto"]["tmp_name"])) {
                        echo "<span class='error'> *No has seleccionado un fichero imagen* </span>";
                    } else {
                        echo "<span class='error'> *El fichero seleccionado es mayor a 500KB* </span>";
                    }
                }
            ?>
        </p>

        <p>
            <button type="submit" name="btnEnviar">Send</button>
        </p>
    </form>

    <?php 
        if (isset($_POST["btnEnviar"]) && !$erro_foto) {
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
                echo "<p>Error al cargar la foto</p>";
            } else {
                echo "<p><strong>Nombre Original: </strong>".$_FILES["foto"]["name"]."</p>";
                echo "<p><strong>Tipo: </strong>".$_FILES["foto"]["type"]."</p>";
                echo "<p><strong>Tamaño: </strong>".$_FILES["foto"]["size"]."</p>";
                echo "<p><strong>Archivo subido temporalmente: </strong>".$_FILES["foto"]["tmp_name"]."</p>";
                echo "<p><img src='images/".$nombre_imagen."' alt='Imagen' title='Imagen subida'</p>";
            }
        }
    ?>

   
</body>
</html>