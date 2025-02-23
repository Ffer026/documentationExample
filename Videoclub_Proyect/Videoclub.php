<?php
include_once "CintaVideo.php";
include_once "Dvd.php";
include_once "Juego.php";
include_once "Cliente.php";
class Videoclub { //Por facilidad de lectura del resultado voy a hacer que cada paso imprima un mensaje
    private string $nombre;
    private array $productos = [];
    private int $numProductos = 0;
    private array $socios = [];
    private int $numSocios = 0;
    
    public function __construct($nombre) {
        $this -> nombre = $nombre;
        echo ("<br>Videoclub <b>{$nombre}</b> creado.<br>");
    }
    
    private function incluirProducto(Soporte $producto) : void {
        array_push($this -> productos, $producto);
        $this -> numProductos++;
        echo ("<br><b>{$producto -> titulo}</b> añadido al videoclub {$this -> nombre}.<br>");
    }
    
    public function incluirCintaVideo (string $titulo, float $precio, float $duracion) : void {
        $numero = 1; //Le asignamos un número ya que no nos lo dan por parámetro.
        for ($i = 0; $i < count($this -> productos); $i++) { //Recorremos el array de productos
            //Si algún producto tiene el número igual a $número, aumentamos $numero en 1 y reiniciamos el bucle
            if ($this -> productos[$i] -> getNumero() === $numero) {
                $i = 0; //Reinicia el bucle
                $numero++; //Aumenta número en 1 y volvemos a comprobar
            }
        }
        //Cuando hayamos encontrado un número que no coincida con ninguno en la lista, creamos CintaVideo con ese número y los parámetros dados
        $nuevaCintaVideo = new CintaVideo($titulo, $numero, $precio, $duracion);
        //Metemos la nueva CintaVideo en productos
        $this -> incluirProducto($nuevaCintaVideo);
    }
    
    public function incluirDvd (string $titulo, float $precio, string $idiomas, string $pantalla) : void {
        //Funciona de forma similar al anterior
        $numero = 1;
        for ($i = 0; $i < count($this -> productos); $i++) {
            if ($this -> productos[$i] -> getNumero() === $numero) {
                $i = 0;
                $numero++;
            }
        }
        $nuevoDvd = new Dvd($titulo, $numero, $precio, $idiomas, $pantalla);
        $this -> incluirProducto($nuevoDvd);
    }
    
    public function incluirJuego (string $titulo, float $precio, string $consola, int $minJ, int $maxJ) : void {
        //Funciona de forma similar a los otros 2
        $numero = 1;
        for ($i = 0; $i < count($this -> productos); $i++) {
            if ($this -> productos[$i] -> getNumero() === $numero) {
                $i = 0;
                $numero++;
            }
        }
        $nuevoJuego = new Juego($titulo, $numero, $precio, $consola, $minJ, $maxJ);
        $this -> incluirProducto($nuevoJuego);
    }
    
    public function incluirSocio (string $nombre, int $maxAlquileresConcurrentes = 3) : void {
        $numero = 1;
        for ($i = 0; $i < count($this -> socios); $i++) {
            if ($this -> socios[$i] -> getNumero() === $numero) {
                $i = 0;
                $numero++;
            }
        }
        
        $nuevoSocio = new Cliente($nombre, $numero, $maxAlquileresConcurrentes);
        array_push($this -> socios, $nuevoSocio);
        echo ("<br><b>{$nombre}</b> añadido a la lista de socios con número {$numero}.<br>");
    }
    
    public function listarProductos() : void {
        echo ("<br>Lista de productos disponibles en el videoclub:</br>");
        foreach ($this -> productos as $producto) {
            echo ("<br>");
            $producto -> muestraResumen();
            echo ("<br>");
        }
    }
    
    public function listarSocios() : void {
        foreach ($this -> socios as $socio) {
            echo ("<br>");
            $socio -> muestraResumen();
            echo ("<br>");
        }
    }
    
    public function alquilaSocioProducto(int $numeroCliente, int $numeroSoporte) : void{
        $posicionCliente = -1; //Inicializamos en -1 porque es un valor imposible para una posición en un array, así podemos comprobar si se ha encontrado...
        $posicionSoporte = -1; //... Así -1 es no encontrado y cualquier otro valor es encontrado
        //Recorremos socios hasta que acabemos o encontremos la posición del cliente y la guardemos (es decir, que su valor sea distinto a -1
        for ($i = 0; $i < count($this -> socios) && $posicionCliente == -1; $i++) {
            if ($this -> socios[$i] -> getNumero() === $numeroCliente) {
                $posicionCliente = $i; //Cuando lo encontremos guardamos el valor y sale del bucle
            }
        }
        //Este bucle funciona igual que el anterior pero para soportes en vez de clientes
        for ($i = 0; $i < count($this -> productos) && $posicionSoporte == -1; $i++) {
            if ($this -> productos[$i] -> getNumero() === $numeroSoporte) {
                $posicionSoporte = $i;
            }
        }
        
        if ($posicionCliente == -1 && $posicionSoporte == -1) {
            echo ("<br>No se ha encontrado ni el cliente ni el soporte especificados<br>");
        } elseif ($posicionCliente == -1) {
            echo ("<br>No se ha encontrado el cliente especificado<br>");
        } elseif ($posicionSoporte == -1) {
            echo ("<br>No se ha encontrado el soporte especificado<br>");
        } else {
            //El cliente deseado alquila el soporte, si todo va bien ese método devuelve true y nos metemos en el if
            if ($this -> socios[$posicionCliente] -> alquilar($this -> productos[$posicionSoporte])) {
                //Estas tres líneas sirven para que cada soporte no pueda ser alquilado por varios clientes a la vez, simulando que solo hay una copia de cada uno
                //unset($this -> productos[$posicionSoporte]); //Borramos el producto de la lista disponible del videoclub
                //$this -> productos = array_values($this -> productos); //Reindexamos
                //$this -> numProductos--; //Actualizamos el número de productos
            }
            //Si el método anterior ha funcionado borramos el soporte de la lista del videoclub
            //Actualizamos el numProductos
        }
    }
}
?>