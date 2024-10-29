#!/bin/bash

#Crear directorio
mkdir -p directorio

#Crear 2 archivos
touch directorio/archivo1.txt
touch directorio/archivo2.txt

#Crear tar
tar -cvf backup.tar directorio

#Mostrar tar
tar -tf backup.tar

#Borrar directorio 
rm -rf directorio

#Extraer tar
tar -xvf backup.tar

#Comprobar si se extrajeron correctamente
if [-d "directorio"] && [-f "directorio/archivo1.txt"] && [-f "directorio/archivo2.txt"]; then
    echo "Se ha extraido correctamente"
else
    echo "Error en la extracción"
fi