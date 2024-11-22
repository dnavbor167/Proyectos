<form action="index.php" method="post">
    <label for="nom_user">Horario del Profesor: </label>
    <select name="nom_user" id="nom_user">
        <?php
        while ($tupla_usuarios = mysqli_fetch_assoc($result_datos_usuario)) {
            if (isset($_POST["btnVerHorario"]) && $_POST["nom_user"] == $tupla_usuarios["id_usuario"]) {
                $nombre_profesor = $tupla_usuarios["nombre"];
                echo "<option selected value='" . $tupla_usuarios["id_usuario"] . "'>" . $tupla_usuarios["nombre"] . "</option>";
            } else
                echo "<option value='" . $tupla_usuarios["id_usuario"] . "'>" . $tupla_usuarios["nombre"] . "</option>";
        }
        ?>
    </select>
    <button type="submit" name="btnVerHorario">Ver Horario</button>
</form>