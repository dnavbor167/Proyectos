<h3>Listado de los Libros</h3>
<table id="list_lib">
    <tr><th>Ref</th><th>Título</th><th>Acción</th></tr>

<?php 
//No hace falta que hagamos la consulta ya que lo hemos hecho anteriormente
while($tupla = mysqli_fetch_assoc($result_listado_libros)) {
    echo "<tr>";
    echo "<td>".$tupla["referencia"]."</td>";
    echo "<td>".$tupla["titulo"]."</td>";
    echo "<td><form action='index.php' method='post'><button type='submit' name='btnBorrar' class='enlace'>Borrar</button> - <button type='submit' name='btnEditar' class='enlace'>Editar</button></form></td>";
    echo "</tr>";
}
?>
</table>

<h3>Agregar un nuevo Libro</h3>
<form action="index.php" method="post">
    <table id="tabla_2">
        <tr>
            <td><label for="referencia">Referencia: </label></td>
            <td><input type="text" name="referencia" id="referencia"></td>
        </tr>
        <tr>
            <td><label for="titulo">Título: </label></td>
            <td><input type="text" name="titulo" id="titulo"></td>
        </tr>
        <tr>
            <td><label for="autor">Autor: </label></td>
            <td><input type="text" name="autor" id="autor"></td>
        </tr>
        <tr>
            <td><label for="descripcion">Descripción: </label></td>
            <td><textarea name="descripcion" id="descripcion"></textarea></td>
        </tr>
        <tr>
            <th><label for="precio">Precio: </label></th>
            <th><input type="text" name="precio" id="precio"></th>
        </tr>
        <tr>
            <th><label for="portada">Portada: </label></th>
            <th><input type="file" name="portada" id="portada" accept="image/*"></th>
        </tr>
        <tr>
            <th><button type="submit">Agregar</button></th>
            <th></th>
        </tr>
    </table>
</form>