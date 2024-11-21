<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primer Login</title>
    <style>
        .enlinea {display: inline;}
        .enlace {
            background: none;
            border: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }
        .mensaje {
            font-size: 1.25rem;
            color: blue
        }
    </style>
</head>
<body>
    <h1>Primer Login</h1>
    <div>
        Bienvenido <strong><?php echo $_SESSION["usuario"] ?></strong> - <form class="enlinea" action="index.php" method="post"><button class="enlace" type="submit" name="btnCerrarSesion">Salir</button></form>
    </div>
    <h3>Eres normal</h3>
    <?php 
    if (isset($_SESSION["mensaje_accion"])) {
        echo "<p class='mensaje'>".$_SESSION["mensaje_accion"]."</p>";
    }
    ?>
</body>
</html>