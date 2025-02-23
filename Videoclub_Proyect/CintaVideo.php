<?php
include_once "Soporte.php"; //include_once para importar la clase Soporte y que si lo volvemos a importar en otra clase solo se importe una vez
class CintaVideo extends Soporte {
        //CintaVideo es el hijo de Soporte, y por tanto Soporte es el padre de CintaVideo
        //CintaVideo hereda propiedades y métodos de su padre Soporte, y además puede añadirlos y reescribirlos
        private float $duracion; //Se añade una nueva propiedad solo de CintaVideo
        
        public function __construct(string $titulo, int $numero, float $precio, float $duracion) {
            //Se da el valor de cada argumento a su variable de clase correspondiente
            parent::__construct($titulo, $numero, $precio); //Se utiliza el constructor del padre para asignar valores a las variables heredadas
            $this -> duracion = $duracion;
        }
        
        public function muestraResumen() : void { 
                //El método muestraResumen se sobreescribe al método muestraResumen de la clase padre, sustituyéndolo
                //Este método no devuelve nada, solo imprime
                echo "<I>" . $this -> titulo . "</I><br>";
                //Para acceder a las variables privadas heredadas se usa un getter. Se puede poner como parent...
                echo parent::getPrecio() . " (IVA no incluido)<br>";
                //... o como el nombre de la clase, Soporte, como en este ejemplo comentado.
                // echo "Precio + IVA: " . Soporte::getPrecioConIva() . "<br>";
                echo "Duración: " . $this -> duracion . " minutos";
        }
}
?>
