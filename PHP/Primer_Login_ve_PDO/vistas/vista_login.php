<?php
if(isset($_POST["btnLogin"]))
{
    //compruebo errores
    $error_usuario=$_POST["usuario"]=="";
    $error_clave=$_POST["clave"]=="";
    $error_form_login=$error_usuario || $error_clave;
    if(!$error_form_login)
    {

        //consulta a la BD y si está inicio sesión y salto a index
        try{
            $conexion=new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        }
        catch(PDOException $e)
        {
            session_destroy();
            die(error_page("Primer Login b","<p>No se ha podido conectar a la BD: ".$e->getMessage()."</p>"));
        }

        // Me he conectado y ahora hago la consulta
        try
        {
            $consulta="select tipo from usuarios where usuario=? AND clave=?";
         
            $sentencia=$conexion->prepare($consulta);
            $sentencia->execute([$_POST["usuario"],md5($_POST["clave"])]);
            if($sentencia->rowCount()>0)
            {
                //El usuario se encuentra registrado y tengo que iniciar session
                $tupla=$sentencia->fetch(PDO::FETCH_ASSOC);
                $sentencia=null;
                $conexion=null;
                $_SESSION["usuario"]=$_POST["usuario"];
                $_SESSION["clave"]=md5($_POST["clave"]);
                $_SESSION["ultm_accion"]=time();
                if($tupla["tipo"]=="normal")
                    header("Location:index.php");
                else
                    header("Location:admin/index.php");
                exit;

            }
            else
            {
                $sentencia=null;
                $conexion=null;
                $error_usuario=true;
            }

        }
        catch(PDOException $e)
        {
            $sentencia=null;
            $conexion=null;
            session_destroy();
            die(error_page("Primer Login b","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
        }



        
       

    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primer Login b</title>
    <style>
        .error{color:red}
        .mensaje{color:blue;font-size:1.25rem}
    </style>
</head>
<body>
    <h1>Primer Login b</h1>
    <form action="index.php" method="post">
        <p>
            <label for="usuario">Usuario: </label>
            <input type="text" id="usuario" name="usuario" value="<?php if(isset($_POST["usuario"])) echo $_POST["usuario"];?>"/>
            <?php
            if(isset($_POST["btnLogin"]) && $error_usuario)
            {
                if($_POST["usuario"]=="")
                    echo "<span class='error'>* Campo vacío *</span>";
                else
                    echo "<span class='error'>* Usuario y/o contraseña incorrectos  *</span>";
            }
            ?>
        </p>
        <p>
            <label for="clave">Contraseña: </label>
            <input type="password" name="clave" id="clave"/>
            <?php
            if(isset($_POST["btnLogin"]) && $error_clave)
            {
                echo "<span class='error'>* Campo vacío *</span>";
            }
            ?>
        </p>
        <p><button name="btnLogin" type="submit">Login</button></p>
    </form>
    <?php
    if(isset($_SESSION["mensaje_seguridad"]))
    {
        echo "<p class='mensaje'>".$_SESSION["mensaje_seguridad"]."</p>";
        session_destroy();
    }
    ?>
</body>
</html>