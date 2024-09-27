<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 19</title>
</head>
<body>
    <h1>Ejercicio 19</h1>
    <?php 
        $amigos["Madrir"] = [
            [
                "Nombre" => "Pedro",
                "Edad" => 32,
                "Teléfono" => "91-999-99-99"
            ],
            [
                "Nombre" => "Antonio",
                "Edad" => 32,
                "Teléfono" => "00-999-99-99"
            ],
            [
                "Nombre" => "Alguien",
                "Edad" => 32,
                "Teléfono" => "00-999-99-99"
            ]
        ];

        $amigos["Barcelona"] = [
            [
                "Nombre" => "Susana",
                "Edad" => 34,
                "Teléfono" => "93-000.00.00"
            ]
            
        ];

        $amigos["Toledo"] = [
            [
                "Nombre" => "Sonia",
                "Edad" => 42,
                "Teléfono" => "925-09.09.09"
            ],
            [
                "Nombre" => "Nombre",
                "Edad" => 43,
                "Teléfono" => "925-09.09.09"
            ],
            [
                "Nombre" => "Nombre3",
                "Edad" => 41,
                "Teléfono" => "925-09.09.09"
            ]
        ];

        //Primer foreach para poder coger la key (Que es Madrid, barcelona, etc)
        //value es un array
        foreach($amigos as $key => $value) {
            echo "<p>Amigos en " . $key . "</p>";
            echo "<ol>";
            //hacemos este foreach para poder acceder a los 3 arrays que hay dentro del array principal
            //$key2 es el indice del array(0,1,2,etc)
            //$value2 es cada array de forma individual
            foreach($value as $key2 => $value2) {
                echo "<li>";
                //hacemos un foreach para poder acceder al contenido de los 3 arrays
                //$key3 = Nombre, Edad y Teléfono
                //$value3 = el contenido de cada array
                foreach($value2 as $key3 => $value3) {
                    echo "<strong>" . $key3 . "</strong>" . ": " . $value3 . ". ";
                }
                echo "</li>";
            }
            echo "</ol>";
        }

        foreach($amigos as $key => $value) {
            echo "<p>".$key.$value."</p>";
            foreach($value as $key2=>$value2){
                echo "<p>".$key2.$value2."</p>";
                foreach($value2 as $key3=>$value3) {
                    echo "<p>".$key3.$value3."</p>";
                }
            }
        }
    ?>
</body>
</html>