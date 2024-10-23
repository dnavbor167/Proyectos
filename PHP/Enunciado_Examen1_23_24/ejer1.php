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
            width: 800px;
            height: 600px;
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

        //Generación de fichero 
        $texto = "Letra/Desplazamiento";
        for ($i = 1; $i <= 26; $i++) {
            $texto .= ";" . $i;
        }
        $texto .= "\n";
        
        for ($x = 0; $x < 26; $x++) {
            //cuando pase por aquí le sumo al ord de A el valor de x
            //para saber que letra
            $letra = ord("A") + $x;
            for ($y = 0; $y <= 26; $y++) {
                $letraActual = chr($letra + $y);

                if ($letra + $y > ord('Z')) {
                    $letraActual = chr(ord('A') + (($letra + $y) - ord('A')) % 26);
                }
                
                if ($y == 26 && $x != 25) {
                    $texto .= $letraActual . "\n";
                } else {
                    $texto .= $letraActual . ";";
                }
            }
        }
        @$cf = fopen(RUTA, "w");
        fputs($cf, $texto);
        fclose($cf);

        if (isset($_POST["btnGenerar"])) {

            //mostrar fichero:
            @$fd = fopen("claves_cesar.txt", "r");
            if (!$fd) {
                die("<span class='error'>Error al cargar el fichero</span>");
            }

            echo "<h2>Respuesta</h2>";
            $fichero = file_get_contents("claves_cesar.txt");
            echo "<textarea>" . $fichero . "</textarea>";
            fclose($fd);
        }
        ?>
    </form>
</body>

</html>