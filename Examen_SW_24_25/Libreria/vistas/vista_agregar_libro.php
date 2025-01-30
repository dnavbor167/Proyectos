<h4>Agregar un nuevo libro</h4>

<form action="index.php" method="post" enctype="multipart/form-data">
    <label for="referencia">Referencia:</label>
    <input type="text" name="referencia" id="referencia" value="<?php if (isset($_POST["btnAgregar"]) && !isset($error_referencia)) echo $_POST["referencia"] ?>">
    <?php
    if (isset($_POST["btnAgregar"]) && $error_referencia) {
        if ($_POST["referencia"] == "")
            echo "<span class='error'>* Campo vacío *</span>";
        else
            echo "<span class='error'>* Referencia repetida *</span>";
    }
    ?>
    <br>

    <label for="titulo">Título:</label>
    <input type="text" name="titulo" id="titulo" value="<?php if (isset($_POST["btnAgregar"]) && !isset($error_titulo)) echo $_POST["titulo"] ?>">
    <?php
    if (isset($_POST["btnAgregar"]) && $error_titulo) {
        echo "<span class='error'>* Campo vacío *</span>";
    }
    ?>
    <br>

    <label for="autor">Autor:</label>
    <input type="text" name="autor" id="autor" value="<?php if (isset($_POST["btnAgregar"]) && !isset($error_autor)) echo $_POST["autor"] ?>">
    <?php
    if (isset($_POST["btnAgregar"]) && $error_autor) {
        echo "<span class='error'>* Campo vacío *</span>";
    }
    ?>
    <br>

    <label for="descripcion">Descripción</label>
    <input type="text" name="descripcion" id="descripcion" value="<?php if (isset($_POST["btnAgregar"]) && !isset($error_descripcion)) echo $_POST["descripcion"] ?>">
    <?php
    if (isset($_POST["btnAgregar"]) && $error_descripcion) {
        echo "<span class='error'>* Campo vacío *</span>";
    }
    ?>
    <br>

    <label for="precio">Precio</label>
    <input type="text" name="precio" id="precio" value="<?php if (isset($_POST["btnAgregar"]) && !isset($error_precio)) echo $_POST["precio"] ?>">

    <?php
    if (isset($_POST["btnAgregar"]) && $error_precio) {
        echo "<span class='error'>* Campo vacío *</span>";
    }
    ?>
    <br>

    <button type="submit" name="btnAgregar">Agregar</button>
</form>