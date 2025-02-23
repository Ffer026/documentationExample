<?php
include "CintaVideo.php"; //Se le dice al archivo que lea CintaVideo.php con la clase CintaVideo para que pueda usarla

$miCinta = new CintaVideo("Los cazafantasmas", 23, 3.5, 107); //Hacemos una nueva variable $miCinta que es un objeto de la clase CintaVideo
echo "<strong>" . $miCinta->titulo . "</strong>"; //Imprimimos la variable titulo del objeto $miCinta en negrita
echo "<br>Precio: " . $miCinta->getPrecio() . " euros"; //Imprimimos la variable precio del objeto $miCinta
echo "<br>Precio IVA incluido: " . $miCinta->getPrecioConIVA() . " euros<br>"; //Imprimimos el resultado del método getPrecioConIVA del objeto $miCinta
//He puesto un salto de línea al final del echo anterior por motivos estéticos
$miCinta->muestraResumen(); //Ejecutamos la función muestraResumen() del $miCinta
?>
