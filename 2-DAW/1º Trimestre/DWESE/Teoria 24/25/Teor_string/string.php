<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría String</title>
</head>
<body>
    <?php 


        $texto1 = "Me llamo Juan";

        echo $texto1[0];

        //funcion para saber la longitud de una cadena
        //la mayoría de funciones de String, empieza por
        //str
        strlen($texto1);

        //strtoupper($texto1);
        //strtolower($texto1);

        //para hacer filtros (obtiene el array de un string):
        //explode(delimitador, texto [,limite])

        //implode(array) le pasas un array y te devuelve un string de todo eso

        //quitar de alante y de atras
        //trim(texto, [caracteres])

        //substr(texto, donde empiezo, cuantos cojo)
        //mejor echar un vistazo, porque tiene muchas funcionalidades
        substr($texto1, 3, 5);

        //Cuenta las palabras de un texto por lo que es muy útil
        str_word_count($texto);
    ?>
</body>
</html>