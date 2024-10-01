<div id="azul">
    <h1>Palíndromos / capícuas - Formulario</h1>
    <p>Dime una palabra o un número y te drié si es un palíndromo o un número capicúa.</p>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="palabra1">Primera o número:</label>
            <input type="text" name="palabra1" id="palabra1" value="<?php if(isset($_POST["palabra1"])) echo $texto1?>">
            <?php 
                if (isset($texto1) && $error_form) {
                    if ($texto1 == "") {
                        echo "<span class='error'>* Campo vacío *</span>";
                    } else if (strlen($texto1) < 3) {
                        echo "<span class='error'>* Introduce almenos 3 letras o 3 dígitos *</span>";
                    } else {
                        echo "<span class='error'>* Debe escribir o letras o números *</span>";
                    } 
                }
            ?>
        </p>

        <button type="submit" name="btnComprobar">Comprobar</button>
    </form>
</div>