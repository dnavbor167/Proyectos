<?php
echo "<table>";
echo "<tr>";
echo "<th>#</th>";
echo "<th>Foto</th>";
echo "<th>Nombre</th>";
echo "<th><form action='index.php' method='post'><button class='enlace' type='submit' name='btnAgregar'>Usuario+</button></form></th>";
echo "</tr>";
while ($tupla = mysqli_fetch_assoc($datos_usuarios)) {
    echo "<tr>";
    echo "<td>" . $tupla["id_usuario"] . "</td>";
    echo "<td><img src='Img/" . $tupla["foto"] . "' alt='Foto' title='Foto'></td>";
    echo "<td><form action='index.php' method='post'><button class='enlace' type='submit' value='".$tupla["id_usuario"]."' name='btnDetalles'>" . $tupla["nombre"] . "</button></form></td>";
    echo "<td><form action='index.php' method='post'><button class='enlace' value='" . $tupla["id_usuario"] . "' type='submit' name='btnBorrar'>Borrar</button><span>-</span><button class='enlace' value='" . $tupla["id_usuario"] . "' type='submit' name='btnEditar'>Editar</button></form></td>";
    echo "</tr>";
}
echo "</table>";
mysqli_free_result($datos_usuarios);
