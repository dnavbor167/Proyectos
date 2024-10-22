<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 PHP</title>
    <style>
        .error {
            color: red;
        }
        textarea {
            width: 589px;
            height: 438px;
            resize: none;
        }
    </style>
</head>
<body>
    <h1>Ejercicio 1. Generador de "claves_cesar.txt"</h1>
    <form action="ejer1.php" method="post">
        <button type="submit" name="btnGenerar">Generar</button>
        <?php 
        const RUTA = "claves_cesar.txt";
        $letra = "A";
            //Generación de fichero 
            $texto = "Letra/Desplazamiento";
            for ($i = 1; $i < 26; $i++) {
                $texto .= ";".$i;
            }
            $texto.="\n";
            @$cf = fopen(RUTA, "a");
            for ($x = 0; $x < 26; $x++) {
                $letra = chr(ord("A") + $x);
                for ($y = 0; $y < 26; $y++) {
                    $letra = chr(ord($letra) + 1);
                    $texto.= $letra.";";

                    if ($y == 25) {
                        $texto.="\n";
                    }
                }
            }
            fclose($cf);

            if (isset($_POST["btnGenerar"])){




                //mostrar fichero:
                @$fd = fopen("claves_cesar.txt","r");
                if (!$fd) {
                    die("<span class='error'>Error al cargar el fichero</span>");
                }

                echo "<h2>Respuesta</h2>";
                $fichero = file_get_contents("claves_cesar.txt");
                echo "<textarea>".$fichero."</textarea>"; 
                fclose($fd);
            }
        ?>
    </form>
</body>
</html>