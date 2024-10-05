<div id="azul">
    <h1>Quita acentos - Formulario</h1>
    <p>Escribe un texto y le quitaré los acentos.</p>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="palabra1">Texto:</label>
            <textarea name="palabra1" id="palabra1" rows="5"><?php if(isset($_POST["palabra1"])) echo $texto1?></textarea>
            <?php 
                if (isset($texto1) && $error_form) {
                    if ($texto1 == "") {
                        echo "<span class='error'>* Campo vacío *</span>";
                    } else if (algun_numero($texto1)) {
                        echo "<span class='error'>* Has escrito algún número *</span>";
                    } else {
                        echo "<span class='error'>* Debes escribir al menos 3 letras *</span>";
                    } 
                }
            ?>
        </p>

        <button type="submit" name="btnAcentos">Quitar acentos</button>
    </form>
</div>