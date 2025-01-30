<?php
echo '<form action="index.php" method="post">';
echo '<p>¿Estás seguro de que desea eliminarlo?</p>';
echo '<button type="submit" name="btnBorrarSi" value="' . $_POST["btnBorrar"] . '>">Sí</button><button type="submit">No</button></form>';
