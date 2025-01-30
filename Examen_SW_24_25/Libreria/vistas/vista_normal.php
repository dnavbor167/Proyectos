<?php
require "vistas/vista_libros.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Libros</title>
    <style>
        .enlinea {
            display: inline
        }

        .enlace {
            background: none;
            border: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }

        #libros_login {
            display: flex;
            flex-flow: row wrap;
        }

        img {
            width: 40%;
        }

        #libros_login div {
            flex: 0 0 30%;
            display: flex;
            flex-flow: column;
            align-items: center;
        }
    </style>
</head>

<body>
    <h1>Librería</h1>
    <div>
        Bienvenido <strong><?php echo $datos_usu_log["lector"]; ?></strong> - <form class="enlinea" action="index.php" method="post"><button class="enlace" type="submit" name="btnSalir">Salir</button></form>
    </div>

    <?php
    echo "<div id='libros_login'>";
    foreach ($json_libros["libros"] as $tupla) {

        echo "<div><img src='images/" . $tupla["portada"] .  "' alt='imgenLibro'> <p>" . $tupla["titulo"] . " - " . $tupla["precio"] . "</p></div>";
    }
    echo "</div>";
    ?>
</body>

</html>