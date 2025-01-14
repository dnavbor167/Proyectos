<?php
echo "<div id='borrarId'>";
echo "<p>Se dispone a borrar el producto: " . $_POST["btnBorrar"] . "</p>";
echo "<p>¿Estás Seguro?</p>";
echo "<form action='index.php' method='post'><button type='submit'>Cancelar</button><button type='submit' name='btnBorrarDef' value='" . $_POST["btnBorrar"] . "'>Continuar</button></form>";
echo "</div>";
