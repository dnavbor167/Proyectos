<div id="azul">
    <h1>Ripios - Formulario</h1>
    <p>Dime dos palabras y de diré si riman o no.</p>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="palabra1">Primera palabra:</label>
            <input type="text" name="palabra1" id="palabra1" value="<?php if(isset($_POST["palabra1"])) echo $texto1?>">
            <?php 
                if (isset($texto1) && $error_texto1) {
                    if ($texto1 == "") {
                        echo "<span class='error'>* Campo vacío *</span>";
                    } else if ($l_texto1 < 3) {
                        echo "<span class='error'>* Debe teclear al menos tres letras *</span>";
                    } else {
                        echo "<span class='error'>* No has tecleado solo letras *</span>";
                    }
                }
            ?>
        </p>

        <p>
            <label for="palabra2">Segunda palabra:</label>
            <input type="text" name="palabra2" id="palabra2" value="<?php if(isset($_POST["palabra2"])) echo $texto2?>"> <!--Podría usar if(isset($texto2)) ya que lo he creado en index-->
            <?php 
                if (isset($texto2) && $error_texto2) {
                    if ($texto2 == "") {
                        echo "<span class='error'>* Campo vacío *</span>";
                    } else if ($l_texto2 < 3) {
                        echo "<span class='error'>* Debe teclear al menos tres letras *</span>";
                    } else {
                        echo "<span class='error'>* No has tecleado solo letras *</span>";
                    }
                }
            ?>
        </p>

        <button type="submit" name="btnComparar">Comparar</button>
    </form>
</div>