<?php
include "Soporte.php"; //Se le dice al archivo que lea Soporte.php con la clase Soporte para aque pueda usarla
$soporte1 = new Soporte("Tenet", 22, 3); //Hacemos una nueva variable $soporte1 que es un objeto Soporte
echo "<strong>" . $soporte1->titulo . "</strong>"; //Imprimimos la variable titulo del objeto soporte1 en negrita
echo "<br>Precio: " . $soporte1->getPrecio() . " euros"; //Imprimimos la variable precio del objeto soporte1
echo "<br>Precio IVA incluido: " . $soporte1->getPrecioConIVA() . " euros<br>"; //Imprimimos el resultado del método getPrecioConIVA del objeto soporte1
//He puesto un salto de línea al final del echo anterior por motivos estéticos
$soporte1->muestraResumen(); //Ejecutamos la función muestraResumen() del soporte1
?>
