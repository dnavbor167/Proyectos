<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría BD</title>
    <style>
        table,
        th,
        td {
            border: solid 1px black;
            padding: 1rem;
        }

        table {
            border-collapse: collapse;
            text-align: center;
        }

        th {
            background-color: #CCC;
        }
    </style>
</head>

<body>
    <h1>Teoría BD</h1>

    <?php
    //funciones servidor:
    /*
        mysqli_connect(servidor_bd, user, password, name_db);
        mysqli_close(conexion);
        mysqli_set_charset(conexion, utf8);
        mysqli_query(conexion, consulta);
        mysqli_num_rows(resultado query);
        mysqli_fetch_assoc(resultado query) te devuelve un array asociativo, coge la primera tupla, si la vuelves a llamar coge la segunda ...
        mysqli_fetch_row(resultado query) te devuelve un array escalar, coge la primera tupla, si la vuelves a llamar coge la segunda ...
        mysqli_fetch_object(resultado query) como el assoc pero se accede con -> porque es un objeto
        mysqli_fetch_array(resultado query) obtiene los datos dobles (te lo guarda en array asociativo y en escalar)
        mysqli_data_seek(resultado query,posición); //para que vaya a la tupla que yo quiera
        
        SIEMPRE QUE HAGAMOS UN SELECT HAY QUE LIBERAR EL RESULTADO
        mysqli_free_result(resultado query);
    */

    const SERVIDOR_BD = "localhost";
    const USUARIO_BD = "jose";
    const CLAVE_BD =  "josefa";
    const NOMBRE_BD = "bd_teoria";

    //la conexión debe ir en un try catch, POR AHORA LE PONEMOS LA @ POR SI FALLA EN EL SERVIDOR
    try {
        //Orden de argumentos: donde quiero concectarme / usuario / contraseña / database
        @$conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
        //Debemos decirle que use los caracteres generales UTF-8
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {
        //la "->" equivale al punto en java
        die("<p>No se ha podido conectar a la BD: " . $e->getMessage() . "</p></body></html>"); //DEBEMOS PONER FIN DE BODY Y FIN DE HTML PORQUE AL MORIR NO LO RELLENA EL SERVIDOR
    }

    echo "<h2>Conexión bien</h2>";

    try {
        //Para hacer una consulta hacemos:
        $consulta = "select * from t_alumnos";
        $resultado = mysqli_query($conexion, $consulta); //Esto devuelve un recurso
    } catch (Exception $e) {
        //una vez conectado si produce error, hay que cerrar la conexion
        mysqli_close($conexion);
        die("<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p></body></html>");
    }

    echo "<h2>Consulta bien</h2>";

    //saber cuantas tuplas tiene el resultado
    $n_tuplas = mysqli_num_rows($resultado);
    echo "<p>El número de alumnos en la tabla t_alumnos es ahora mismo de: " . $n_tuplas . "</p>";

    echo "<h3>Mostrando las tuplas</h3>";
    $tupla = mysqli_fetch_assoc($resultado); //primera tupla del resultado la lee asociativamente

    echo "<p>El nombre del primer alumno obtenido es: " . $tupla["nombre"] . "</p>";

    $tupla = mysqli_fetch_row($resultado); //igual que el assoc pero en vez de hacertelo asociativo te lo hace escalar
    echo "<p>El teléfono del segundo alumno obtenido es: " . $tupla[2] . "</p>";

    $tupla = mysqli_fetch_object($resultado); //igual que el assoc pero se accede como objeto
    echo "<p>El código postal del tercer alumno obtenido es: " . $tupla->cp . "</p>";

    mysqli_data_seek($resultado, 1); //para que vaya a la tupla que yo quiera
    $tupla = mysqli_fetch_array($resultado); //obtiene los datos dobles (te lo guarda en array asociativo y en escalar)

    echo "<p>El Nombre del segundo alumno obtenido es: " . $tupla[1] . " y su teléfono es: " . $tupla["telefono"] . "</p>";

    mysqli_data_seek($resultado, 0);
    echo "<table>";
    echo "<tr><th>Código</th><th>Nombre</th><th>Teléfono</th><th>Código postal</th></tr>";
    while ($tupla = mysqli_fetch_assoc($resultado)) {
        echo "<tr>";
        echo "<td>" . $tupla["cod_alu"] . "</td>";
        echo "<td>" . $tupla["nombre"] . "</td>";
        echo "<td>" . $tupla["telefono"] . "</td>";
        echo "<td>" . $tupla["cp"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";

    mysqli_free_result($resultado); //CUANDO HAGAMOS UN SELECT HAY QUE LIBERARLO, PORLO QUE CUANDO TERMINEMOS DE USAR EL SELECT LO LIBERAMOS

    $consulta = "select * from `t_alumnos` 
    join t_notas on t_notas.cod_alu = t_alumnos.cod_alu 
    join t_asignaturas on t_asignaturas.cod_asig = t_notas.cod_asig 
    where t_asignaturas.denominacion = 'DIWEB'";
    $resultado = mysqli_query($conexion, $consulta); //Esto devuelve un recurso
    echo "<table>";
    echo "<tr><th>Nombre</th><th>Asignatura</th><th>Nota</th></tr>";
    while ($tupla = mysqli_fetch_assoc($resultado)) {
        echo "<tr>";
        echo "<td>" . $tupla["nombre"] . "</td>";
        echo "<td>" . $tupla["denominacion"] . "</td>";
        echo "<td>" . $tupla["nota"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";

    mysqli_free_result($resultado); //CUANDO HAGAMOS UN SELECT HAY QUE LIBERARLO, PORLO QUE CUANDO TERMINEMOS DE USAR EL SELECT LO LIBERAMOS

    //lo último que tenemos que hacer es cerrar la conexión
    mysqli_close($conexion);

    echo "<h2>Cierre de conexión</h2>";


    //obtener última id de la conexión de insercion
    mysqli_insert_id($conexion);
    ?>
</body>

</html>