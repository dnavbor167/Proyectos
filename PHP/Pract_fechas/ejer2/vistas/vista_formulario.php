<div id="azul">
    <h1>Fechas - Formulario</h1>
    <form action="index.php" method="post" enctype="multipart/form-data">

        <p>
            <label for="fecha1">Introduzca una fecha (DD/MM/AAAA):</label>
        </p>
            
        <?php 
            $array_mes[1]="Enero";
            $array_mes[]="Febrero";
            $array_mes[]="Marzo";
            $array_mes[]="Abril";
            $array_mes[]="Mayo";
            $array_mes[]="Junio";
            $array_mes[]="Julio";
            $array_mes[]="Agosto";
            $array_mes[]="Septiembre";
            $array_mes[]="Octubre";
            $array_mes[]="Nobiembre";
            $array_mes[]="Diciembre";
            $anio_actual = date("Y");
            const N_ANIOS = 50;

            //Dias
            echo "<label for='dial1'>Día </label>";
            echo "<select name='dial1' id='dial1'>";
            for ($i = 1; $i <= 31; $i++) {
                if (isset($_POST["dial1"]) && $_POST["dial1"] == $i) {
                    echo "<option selected value='".$i."'>".sprintf("%02d", $i)."</option>";
                } else {
                    echo "<option value='".$i."'>".sprintf("%02d", $i)."</option>";
                }
                
            }
            echo "</select>";

            //Meses
            echo "<label for='mes1'> Mes: </label>";
            echo "<select name='mes1' id='mes1'>";
            for ($i = 1; $i <= 12; $i++) {
                if (isset($_POST["mes1"]) && $_POST["mes1"] == $i) {
                    echo "<option selected value='".$i."'>".$array_mes[$i]."</option>";
                } else {
                    echo "<option value='".$i."'>".$array_mes[$i]."</option>";
                }
            }
            echo "</select>";

            //Añons
            echo "<label for='anyio1'> Año: </label>";
            echo "<select name='anyio1' id='anyio1'>";
            for ($i = $anio_actual-floor(N_ANIOS/2); $i <= $anio_actual+floor(N_ANIOS/2); $i++) {
                if (isset($_POST["anyio1"]) && $_POST["anyio1"] == $i) {
                    echo "<option selected value='".$i."'>".$i."</option>";
                } else {
                    echo "<option value='".$i."'>".$i."</option>";
                }
                
            }
            echo "</select>";

            if (isset($_POST["btnCalcular"]) && $error_fecha1) {
                     
            }
        ?>


        <p>
            <label for="fecha1">Introduzca una fecha (DD/MM/AAAA):</label>
        </p>
            
        <?php 

            //Dias
            echo "<label for='dial2'>Día </label>";
            echo "<select name='dial2' id='dial2'>";
            for ($i = 1; $i <= 31; $i++) {
                if (isset($_POST["dial2"]) && $_POST["dial2"] == $i) {
                    echo "<option selected value='".$i."'>".sprintf("%02d", $i)."</option>";
                } else {
                    echo "<option value='".$i."'>".sprintf("%02d", $i)."</option>";
                }
                
            }
            echo "</select>";

            //Meses
            echo "<label for='mes2'> Mes: </label>";
            echo "<select name='mes2' id='mes2'>";
            for ($i = 1; $i <= 12; $i++) {
                if (isset($_POST["mes2"]) && $_POST["mes2"] == $i) {
                    echo "<option selected value='".$i."'>".$array_mes[$i]."</option>";
                } else {
                    echo "<option value='".$i."'>".$array_mes[$i]."</option>";
                }
            }
            echo "</select>";

            //Añons
            echo "<label for='anyio2'> Año: </label>";
            echo "<select name='anyio2' id='anyio2'>";
            for ($i = $anio_actual-floor(N_ANIOS/2); $i <= $anio_actual+floor(N_ANIOS/2); $i++) {
                if (isset($_POST["anyio2"]) && $_POST["anyio2"] == $i) {
                    echo "<option selected value='".$i."'>".$i."</option>";
                } else {
                    echo "<option value='".$i."'>".$i."</option>";
                }
                
            }
            echo "</select>";

            if (isset($_POST["btnCalcular"]) && $error_fecha2) {
                     
            }
        ?>

        <br><br>
        <button type="submit" name="btnCalcular">Calcular</button>
    </form>
</div>