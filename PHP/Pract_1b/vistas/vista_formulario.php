<h1>Rellena tu cv</h1>
    <!--A recordar:
        maxlength
        required
        placeholder
        size, normalmente se hace en el css
        value-->
    <form action="index.php" method="post" enctype="multipart/form-data">
        <label for="name">Nombre</label><br>
        <input type="text" name="name" id="name" value="<?php if (isset($_POST["name"])) echo $_POST["name"] ?>"> 
        <?php 
            if (isset($_POST["btnEnviar"]) && $error_nombre) {
                echo "<span class='error'>Campo vacío</span>";
            }
        ?>
        <br>

        <label for="apellidos">Apellidos</label><br>
        <input type="text" name="apellidos" id="apellidos" size=40 value="<?php if (isset($_POST["apellidos"])) echo $_POST["apellidos"] ?>"> 
        <?php 
            if (isset($_POST["btnEnviar"]) && $error_apellidos) {
                echo "<span class='error'>Campo vacío</span>";
            }
        ?>
        <br>

        <label for="pass">Contraseña</label><br>
        <input type="password" name="pass" id="pass" value="<?php if (isset($_POST["pass"])) echo $_POST["pass"] ?>">
        <?php 
            if (isset($_POST["btnEnviar"]) && $error_clave) {
                echo "<span class='error'>Campo vacío</span>";
            }
        ?>
        <br>

        <label for="dni">DNI</label><br>
        <input type="text" name="dni" id="dni" size=10 value="<?php if (isset($_POST["dni"])) echo $_POST["dni"] ?>">
        <?php 
            if (isset($_POST["btnEnviar"]) && $error_dni) {
                echo "<span class='error'>Campo vacío</span>";
            }
        ?>
        <br>

        <label for="sexo">Sexo</label> 
        <?php 
            if (isset($_POST["btnEnviar"]) && $error_sexo) {
                echo "<span class='error'>Campo vacío</span>";
            }
        ?>
        <br>
        <input type="radio" name="sexo" id="mujer" <?php if (isset($_POST["sexo"]) && $_POST["sexo"] == "mujer") echo "checked"; ?> value="mujer"> <label for="mujer">Mujer</label> <br>
        <input type="radio" name="sexo" id="hombre" <?php if (isset($_POST["sexo"]) && $_POST["sexo"] == "hombre") echo "checked"; ?> value="hombre"> <label for="hombre">Hombre</label>
        <br> <br>

        <label for="foto">Incluir mi foto:</label>
        <input type="file" name="foto" id="foto" accept="image/*"> <br> <br>

        <label for="localidad">Nacido en:</label>   
        <select name="localidad" id="localidad">
            <option <?php if (isset($_POST["localidad"]) && $_POST["localidad"] == "estepona") echo "selected"; ?> value="estepona">Estepona</option>
            <option <?php if (isset($_POST["localidad"]) && $_POST["localidad"] == "laLinea") echo "selected"; ?> value="laLinea">La linea</option>
            <option <?php if (isset($_POST["localidad"]) && $_POST["localidad"] == "algeciras") echo "selected"; ?> value="algeciras">Algeciras</option>
        </select> <br> <br>

        <label for="comentarios">Comentarios:</label>
        <textarea  name="comentarios" id="comentarios" cols="40" rows="10"><?php if (isset($_POST["comentarios"])) echo $_POST["comentarios"] ?></textarea>
        <?php 
            if (isset($_POST["btnEnviar"]) && $error_comentarios) {
                echo "<span class='error'>Campo vacío</span>";
            }
        ?>
        <br><br>
    
        <input type="checkbox" name="suscribete" id="suscribete" <?php if (isset($_POST["suscribete"])) echo "checked"; ?>>
        <label for="suscribete">Suscribirse al boletín de Novedades</label>
        <br><br>

        <input type="submit" value="Guardar cambios" name="btnEnviar">
        <input type="submit" value="Borrar los datos introducidos" name="btnBorrar">
    </form>