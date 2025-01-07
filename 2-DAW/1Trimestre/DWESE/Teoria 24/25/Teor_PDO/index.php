<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría PDO</title>
</head>

<body>
    <h1>Teoría PDO</h1>
    <?php
    const SERVIDOR_BD = "localhost";
    const USUARIO_BD = "jose";
    const CLAVE_BD = "josefa";
    const NOMBRE_BD = "bd_foro";

    try {
        //El último parámetro es opcional (el array)
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        die("<p>No se ha podido acceder a la base de datos: " . $e->getMessage() . "</p></body></html>");
    }

    echo "<h2>Conectado</h2>";

    $usuario = "dani123";
    $clave = md5("123456");

    //Consulta:
    try {
        $consulta = "select * from usuarios where usuario = ? and clave = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$usuario, $clave]);
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        die("<p>No se ha podido hacer la consulta: " . $e->getMessage() . "</p></body></html>");
    }

    //Preguntar si tiene entradas la consulta:
    if($sentencia->rowCount()<=0) {
        echo "<p>No hay usuarios en la BD </p>";
    } else {
        $tupla = $sentencia->fetch(PDO::FETCH_ASSOC);//PDO::FETCH_NUM, PDO::FETCH_OBJECT
        echo "<p>El nombre del usuario logueado es: <strong>".$tupla["nombre"]."</stron></p>";
    }

    try{
        $consulta="select * from usuarios";
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute();

    }
    catch(PDOException $e)
    {
        $senetencia=null;
        $conexion=null;
        die("<p>No he podido conectarse a la base de batos: ".$e->getMessage()."</p></body></html>");
    }

    if($sentencia->rowCount()<=0)
    {
        echo "<p>No hay usuarios en la BD</p>";
    }
    else
    {
        $usuarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);// PDO::FETCH_NUM, PDO::FETCH_OBJECT
        echo "<h3>Listado de los usuarios</h3>";
        echo "<ol>";
        foreach($usuarios as $tupla)
        {
            echo "<li>".$tupla["nombre"]."</li>";
        }
        echo "</ol>";
    }

    $nombre="Pepe Castro";
    $usuario="pepe88";
    $clave=md5("123456");
    $email="sdjfhds@jsj.es";


    try{
        $consulta="insert into usuarios(nombre,usuario,clave,email) values(?,?,?,?)";
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute([$nombre,$usuario,$clave,$email]);
    }
    catch(PDOException $e)
    {
        $sentencia=null;
        $conexion=null;
        die("<p>No he podido conectarse a la base de batos: ".$e->getMessage()."</p></body></html>");
    }

    echo "<p>Usuario insertado con éxito con la id_usuario:<strong>".$conexion->lastInsertId()."</strong></p>";//equ. mysli_insert_id($conexion)

    //Cerramos sentencia
    $sentencia=null;
    //Cerramos conexión
    $conexion=null;

    ?>
</body>

</html>