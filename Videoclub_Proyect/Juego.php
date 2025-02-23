<?php
include_once "Soporte.php";
class Juego extends Soporte {
    public string $consola;
    private int $numMinJugadores;
    private int $numMaxJugadores;
    
    public function __construct(string $titulo, int $numero, float $precio, string $consola, int $numMinJugadores, int $numMaxJugadores) {
        parent::__construct($titulo, $numero, $precio);
        $this -> numMinJugadores = $numMinJugadores;
        $this -> numMaxJugadores = $numMaxJugadores;
    }
    
    public function muestraResumen() : void {
        echo "<I>" . $this -> titulo . "</I><br>";
        echo parent::getPrecio() . " € (IVA no incluido)<br>";
        if ($this -> numMinJugadores === $this -> numMaxJugadores) { //Si el número de jugadores mínimos y máximos es el mismo lo dice de una manera
            if ($this -> numMinJugadores === 1) {
                echo "Para un jugador"; //Uso el singular para un solo jugador mínimo y máximo
            } else {
                echo "Para" . $this -> numMinJugadores . "jugadores";
            }
        } else { //Si el número de jugadores mínimos y máximos es distinto se escribe de otro modo
            echo "De " . $this -> numMinJugadores . "a" . $this -> numMaxJugadores . "jugadores";
        }
    }
}
?>
