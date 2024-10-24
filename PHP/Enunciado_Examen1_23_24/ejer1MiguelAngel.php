<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 Miguel Ángel</title>
</head>
<body>
    <h1>Ejercicio 1. Generador de "claves_cesar.txt"</h1>
    <form action="ejer1MiguelAngel.php" method="post">
        <button type="submit" name="btnGenerar">Generar</button>
    </form>

    <?php 
        if (isset($_POST["btnGenerar"])) {
            echo "<h1>Respuesta</h1>";
            @$fd = fopen("claves_cesar.txt", "w");
            if (!$fd) {
                echo "<p>No tiene los permisos para crear o abrir el fichero 'claves_cesar.txt'</p>";
            } else {

                $primera_linea="Letra/Desplazamiento";
                for($i = 1;$i <= ord("Z")-ord("A")+1; $i++) {
                    $primera_linea.=";".$i;
                }
                fputs($fd,$primera_linea.PHP_EOL);

                for($i = ord("A");$i <= ord("Z"); $i++) {
                    $linea = chr($i);
                    for($j = 1;$j <= ord("Z")-ord("A")+1; $j++) {
                        if ($i+$j <= ord("Z")) {
                            $linea.=";".chr($i+$j);
                        } else {
                            $linea.=";".chr(ord("A")-1+($i+$j)-ord("Z"));
                        }
                        
                    } 
                    fputs($fd,$linea.PHP_EOL);
                }

                fclose($fd);
                echo "<textarear>".file_get_contents("claves_cesar.txt")."</textarea>";
                echo "<p>Fichero generado con éxito</p>";
            }  
        }
    ?>
</body>
</html>