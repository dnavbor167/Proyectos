<?php 

?>

<h2>Creando un Producto</h2>
<form action="index.php" method="post">
    <label for="codigo">Código:</label>
    <input type="text" name="codigo" id="codigo"> <br><br>

    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre"> <br><br>

    <label for="nombre_corto">Nombre Corto:</label>
    <input type="text" name="nombre_corto" id="nombre_corto"> <br><br>
    
    <label for="descripcion">Descripción:</label>
    <input type="text" name="descripcion" id="descripcion"> <br><br>

    <label for="pvp">PVP:</label>
    <input type="text" name="pvp" id="pvp"> <br><br>

    <label for="familia">Seleccione una familia:</label>
    <select name="familia" id="familia">
        
    </select> <br><br>

    <button type="submit">Volver</button>
    <button type="submit" name="btnCrear">Continuar</button> 
</form>