<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 17</title>
</head>
<body>
    <h1>Ejercicio 17</h1>
    <?php 
        $familia["Los Simpson"] = [
            "Padre" => "Hommer",
            "Madre" => "Marge",
            "Hijos" => [
                "Hijo1" => "Bart",
                "Hijo2" => "Lisa",
                "Hijo3" => "Maggie"
            ]
        ];

        $familia["Los Griffin"] = [
            "Padre" => "Peter",
            "Madre" => "Lois",
            "Hijos" => [
                "Hijo1" => "Chris",
                "Hijo2" => "Meg",
                "Hijo3" => "Stewie"
            ]
        ];

        echo "<ul>";
        foreach($familia as $key=>$value) {
            echo "<li>" . $key . "</li>";
            echo "<ul>";
            foreach($value as $key2=>$value2) {
                if (!is_array($value2)) {
                    echo "<li>" . $key2 . ": " . $value2 . "</li>";
                } else {
                    echo "<li>" . $key2 . ": " . "</li>";
                    echo "<ul>";
                    foreach($value2 as $key3=>$value3) {
                        echo "<li>" . $key3 . ": " . $value3 . "</li>";
                    }
                    echo "</ul>";
                }
            }
            echo "</ul>";
        }
        echo "</ul>";
    ?>
</body>
</html>