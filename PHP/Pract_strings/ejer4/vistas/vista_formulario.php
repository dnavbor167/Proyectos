<div id="azul">
    <h1>Romanos a árabes - Formulario</h1>
    <p>Dime un número en números romanos y lo convertiré a cifras árabes.</p>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="palabra1">Número:</label>
            <input type="text" name="palabra1" id="palabra1" value="<?php if(isset($_POST["palabra1"])) echo $texto1?>">
            <?php 
                if (isset($texto1) && $error_form) {
                    if ($texto1 == "") {
                        echo "<span class='error'>* Campo vacío *</span>";
                    } else {
                        echo "<span class='error'>* No has escrito un número romano en notación antigua correctamente *</span>";
                    } 
                }
            ?>
        </p>

        <button type="submit" name="btnConvertir">Convertir</button>
    </form>
</div>