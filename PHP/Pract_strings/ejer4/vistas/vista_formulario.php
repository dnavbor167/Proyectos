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
                    } else if (!$romanos_l) { 
                        echo "<span class='error'>* Puedes poner 4 letras máxima de cada *</span>";
                    } else {
                        echo "<span class='error'>* Solo puedes introducir letras romanas *</span>";
                    } 
                }
            ?>
        </p>

        <button type="submit" name="btnComprobar">Comprobar</button>
    </form>
</div>