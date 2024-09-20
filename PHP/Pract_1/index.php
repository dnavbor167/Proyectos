<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 1</title>
    <style>div{background-color: #;}</style>
</head>
<body>
    <h1>Rellena tu cv</h1>
    <!--A recordar:
        maxlength
        required
        placeholder
        size, normalmente se hace en el css
        value-->
    <form action="recogida_datos.php" method="post" enctype="multipart/form-data">
        <label for="name">Nombre</label><br>
        <input type="text" name="name" id="name"> <br>

        <label for="apellidos">Apellidos</label><br>
        <input type="text" name="apellidos" id="apellidos" size=40> <br>

        <label for="pass">Contraseña</label><br>
        <input type="password" name="pass" id="pass" required> <br>

        <label for="dni">DNI</label><br>
        <input type="text" name="dni" id="dni" size=10 required> <br>

        <label for="sexo">Sexo</label> <br>
        <input type="radio" name="sexo" id="mujer" value="Mujer"> <label for="mujer">Mujer</label> <br>
        <input type="radio" name="sexo" id="hombre" value="Hombre"> <label for="hombre">Hombre</label> <br> <br>

        <label for="foto">Incluir mi foto:</label>
        <input type="file" name="foto" id="foto" accept="image/*"> <br> <br>

        <label for="localidad">Nacido en:</label>   
        <select name="localidad" id="localidad">
            <option value="estepona">Estepona</option>
            <option value="laLinea">La linea</option>
            <option value="algeciras">Algeciras</option>
        </select> <br> <br>

        <label for="comentarios">Comentarios:</label>
        <textarea  name="comentarios" id="comentarios" cols="40" rows="10"></textarea>
        <br> <br>
    
        <input type="checkbox" name="suscribete" id="suscribete">
        <label for="suscribete">Suscribirse al boletín de Novedades</label>

        <br><br>

        <input type="submit" value="Guardar cambios">
        <input type="reset" value="Borrar los datos introducidos">
    </form>
</body>
</html>