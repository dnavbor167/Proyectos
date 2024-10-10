<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theory Upload Files</title>
</head>
<body>
    <h1>Theroy Upload Files</h1>

    <form action="index.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="foto">Seleccione un archivo imagen (Máximo 500KB): </label>
            <input type="file" name="foto" id="foto" accept="image/*">
        </p>

        <p>
            <button type="submit" name="btnEnviar">Send</button>
        </p>
    </form>

    <?php 
        //YA NO USAREMOS $_POST[] PARA IMAGENES O FILES
        //USAREMOS UNA VARIABLE NUEVA LLAMADA:
        //$_FILES[]
        if (isset($_FILES["foto"])) {
            if (!$_FILES["foto"]["error"]) {
                echo "Se ha subido con éxito el archivo";
            } else {
                echo "No se ha subido con éxito el archivo";
            }
        }
    ?>
</body>
</html>