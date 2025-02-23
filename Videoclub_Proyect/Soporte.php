<?php //A partir de aquí lee el intérprete de PHP
include "Resumible.php";
abstract class Soporte implements Resumible { //Es declara la clase padre Soporte
    public string $titulo; //Hemos puesto el tipo de cada variable para evitar errores
    protected int $numero;
    private float $precio;
    
    public function __construct(string $titulo, int $numero, float $precio) { //Se da el valor de cada argumento a su variable de clase correspondiente
        $this -> titulo = $titulo;
        $this -> numero = $numero;
        $this -> precio = $precio;
    }
    
    public function getPrecio() : float { //Hemos puesto el tipo que devuelve cada método para evitar errores
        return $this -> precio;
    }
    
    public function getPrecioConIVA() : float {
        return $this -> precio * 1.21; //Aquí se supone un IVA del 21%
    }
    
    public function getNumero() : int {
        return $this -> numero;
    }
    
    public function muestraResumen() : void { //Este método no devuelve nada, solo imprime
        echo "<I>" . $this -> titulo . "</I><br>";
        echo $this -> precio . " (IVA no incluido)<br>";
    }
}
?>
