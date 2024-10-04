<div id="azul">
    <h1>Fechas - Formulario</h1>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="fecha1">Introduzca una fecha: (DD/MM/YYYY)</label>
            <input type="text" name="fecha1" id="fecha1" value="<?php if(isset($_POST["fecha1"])) echo $fecha1?>">
            
            <?php 
                if (isset($fecha1) && $error_form) {
                    if ($fecha1 == "") {
                        echo "<span class='error'>* Campo vacío *</span>";
                    } else if(!$fecha1_formato) {
                        echo "<span class='error'>* Formato de fecha incorrecto, por favor usa el formato DD/MM/YYY *</span>";
                        echo "<p>Hola".comprobar_fecha("01/23/2005")."</p>";
                    } 
                }
            ?>
        </p>

        <p>
            <label for="fecha2">Introduzca una fecha: (DD/MM/YYYY)</label>
            <input type="text" name="fecha2" id="fecha2" value="<?php if(isset($_POST["fecha2"])) echo $fecha2?>"> 
            <?php 
                if (isset($fecha2) && $error_form) {
                    if ($fecha2 == "") {
                        echo "<span class='error'>* Campo vacío *</span>";
                    } else {
                        echo "<span class='error'>* Formato de fecha incorrecto, por favor usa el formato DD/MM/YYY *</span>";
                    } 
                }
            ?>
        </p>

        <button type="submit" name="btnCalcular">Calcular</button>
    </form>
</div>