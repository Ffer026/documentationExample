<?php
include "DVD.php";//Se include los datos del archivo DVD.php a este documento

$miDvd= new Dvd("Origen", 24, 15, "es , es , fr", "16 : 9");//Con la creacion de la variab miDvd la igualamos al objeto Dvd
//Con los valores del objeto Dvd mostramos por pantalla las siguientes lineas
echo "<strong>" . $miDvd->titulo . "</strong>";
echo "<br>Precio: " . $miDvd->getPrecio() . " euros";
echo "<br>Precio IVA incluido: " . $miDvd->getPrecioConIVA() . " euros <br>";
//Usando los valores del objeto Dvd ejecutamos la funcion muestraResumen
$miDvd->muestraResumen();
