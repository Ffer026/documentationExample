<?php
include "Juego.php";

$miJuego = new Juego("The Last Of Us Part II", 26, 49.99, "PS4", 1, 1);
echo "<strong>" . $miJuego->titulo . "</strong>";
echo "<br>Precio: " . $miJuego->getPrecio() . " euros";
echo "<br>Precio IVA incluido: " . $miJuego->getPrecioConIVA() . " euros<br>";

$miJuego->muestraResumen();
?>
