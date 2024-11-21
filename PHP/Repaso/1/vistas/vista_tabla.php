<h1>Listado de los usuarios</h1>

    <table>
        <tr>
            <th>Nombre de usuario</th>
            <th>Borrar</th>
            <th>Editar</th>
        </tr>
        <?php
        while ($tupla = mysqli_fetch_assoc($result_datos_usuario)) {
            echo "<tr>";
            echo "<td><form action='index.php' method='post'><button type='submit' class='enlace' name='btnListar' value='".$tupla["id_usuario"]."'>".$tupla["nombre"]."</button></form></td>";
            echo "<td><form action='index.php' method='post'><button type='submit' class='enlace' name='btnBorrar' value='".$tupla["id_usuario"]."'><img src='images/borrar.png' alt='Imagen 1'></button></form></td>";
            echo "<td><form action='index.php' method='post'><button type='submit' class='enlace' name='btnEditar' value='".$tupla["id_usuario"]."'><img src='images/editar.png' alt='Imagen 2'></button></form></td>";
            echo "</tr>";
        }
        ?>
    </table>