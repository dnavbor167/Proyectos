<?php 
echo "<h4>Listado de los libros</h4>";
echo "<table>";
echo "<tr><th>Ref</th><th>Título</th><th>Acción</th></tr>";
foreach($json_libros["libros"] as $tupla) {
    echo "<tr>";
    echo "<td>".$tupla["referencia"]."</td>";
    echo "<td><form action='index.php' method='post'><button type='submit' class='enlace' name='btnDetalles' value='".$tupla['referencia']."'>".$tupla['titulo']."</button></form></td>";
    echo "<td><form action='index.php' method='post'><button type='submit' class='enlace' name='btnBorrar' value='".$tupla['referencia']."'>Borrar</button>-<button type='submit' class='enlace' name='btnEditar' value='".$tupla['referencia']."'>Editar</button></form></td>";
    echo "</tr>";
}
echo "</table>";
?>