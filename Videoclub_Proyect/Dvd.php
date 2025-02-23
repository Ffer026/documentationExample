<?php
   include_once "Soporte.php";
   class Dvd extends Soporte{
       //La clase Dvd es hija de Soporte
        public string $idiomas;//Se añade las propiedades idiomas y...
        private string $formatPantalla;//... formatPantalla
        
        
        public function __construct(string $titulo, int $numero, float $precio, string $idiomas, string $formatPantalla) { 
            parent::__construct($titulo, $numero, $precio);
            $this -> idiomas = $idiomas;
            $this -> formatPantalla = $formatPantalla;
            //En el constructor que se ve arriba se ve la creacion y la asigancion de valores de los objetos ... 
            //... usando propiedades de la clase Soporte y propiedades de la clase Dvd
        }
        
        //En muestraResumen se sobreescriben los resultados de los objetos anterior mencionados...
        //... el unico objetivo de esta clase es imprimir
        public function muestraResumen() : void {
            echo "Pelicula en DVD : <br>" ."<I>". $this -> titulo ."</I>". "<br>";
            echo parent::getPrecio() ." ( IVA no incluido )" .  "<br>";
            echo "Idiomas: " . $this -> idiomas . "<br>";
            echo "Format Pantalla: " . $this -> formatPantalla;
        }
    }
?>
