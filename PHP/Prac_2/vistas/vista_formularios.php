<h1>Esta es mi super página</h1>

<form action="index.php" method="post" enctype="multipart/form-data">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" value="<?php if (isset($_POST["nombre"])) echo $_POST["nombre"]; ?>"><br><br>

    <label for="nacido">Nacido en:</label>
    <select name="nacido" id="nacido">
        <option <?php if (isset($_POST["nacido"]) && $_POST["nacido"] == "laLinea") echo "selected"; ?> value="laLinea">La Línea</option>
        <option <?php if (isset($_POST["nacido"]) && $_POST["nacido"] == "algeciras") echo "selected"; ?> value="algeciras">Algeciras</option>
        <option <?php if (isset($_POST["nacido"]) && $_POST["nacido"] == "tarifa") echo "selected"; ?> value="tarifa">Tarifa</option>
    </select><br><br>

    <label for="sexo">Sexo:</label>
    <label for="hombre">Hombre</label>
    <input type="radio" name="sexo" id="hombre" <?php if (isset($_POST["sexo"]) && $_POST["sexo"] == "hombre") echo "checked"; ?> value="hombre">
    <label for="mujer">Mujer</label>
    <input type="radio" name="sexo" id="mujer" <?php if (isset($_POST["sexo"]) && $_POST["sexo"] == "mujer") echo "checked"; ?> value="mujer"> <br><br>

    <label for="aficiones">Aficiones:</label>
    <label for="deportes">Deportes</label>
<!--Declaración de array en un name:-->
    <input type="checkbox" name="aficiones[]" id="deportes" <?php if (isset($_POST["aficiones"][0])) echo "checked"; ?> value="Deportes">
    <label for="lectura">Lectura</label>
    <input type="checkbox" name="aficiones[]" id="lectura" <?php if (isset($_POST["aficiones"][1])) echo "checked"; ?> value="Lectura">
    <label for="otros">Otros</label>
    <input type="checkbox" name="aficiones[]" id="otros" <?php if (isset($_POST["aficiones"][2])) echo "checked"; ?> value="Otros"> <br><br>

    <label for="comentarios">Comentarios:</label>
    <textarea name="comentarios" id="comentarios"></textarea> <br><br>

    <input type="submit" value="Enviar" name="btnEnviar">
</form>