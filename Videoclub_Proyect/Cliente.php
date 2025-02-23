<?php
class Cliente{
    public string $nombre;
    private int $numero;
    private array $soportesAlquilados = [];
    private int $numeroSoportesAlquilados = 0;//Ponemos el número de soportes en 0 por defecto para evitar errores al consultarlo con el getter
    private int $maxAlquilerConcurrente;
    
    public function __construct(string $nombre, int $numero, int $maxAlquilerConcurrente = 3) {
        $this -> nombre = $nombre;
        $this -> numero = $numero;
        $this -> maxAlquilerConcurrente = $maxAlquilerConcurrente;
    }
    
    public function getNumero() : int {
        return $this -> numero;
    }
    public function setNumero(int $numero) : void {
        $this -> numero = $numero;
    }
    public function getNumeroSoportesAlquilados() : int {
        return $this -> numeroSoportesAlquilados;
    }
    
    public function muestraResumen() : void {
        echo $this -> nombre . ", alquilados " . count($this -> soportesAlquilados) . " soportes.";
    }
    
    public function tieneAlquilado(Soporte $s) : bool { //Suponemos que el número del soporte es un identificador único
        $alquilado = false;
        //Recorremos el array $soportesAlquilados hasta terminarlo o hasta que $alquilado sea verdadero
        for ($i = 0; $i < count($this -> soportesAlquilados) && !$alquilado; $i++) {
            if ($s == $this -> soportesAlquilados[$i]) {
                $alquilado = true;
            }
        }
        return $alquilado;
    }
    
    public function alquilar(Soporte $s) : bool { //Esta función va a devolver true si se ha alquilado y false si no se ha podido alquilar
        $estado = false;
        if (in_array($s, $this -> soportesAlquilados)) { //Si ya tiene alquilado ese soporte no alquila
            $estado = false;
            //Imprimimos el problema
            echo ("<br>El cliente ya tiene alquilado el soporte <b>{$s -> titulo}</b><br><br>");            
        } elseif ($this -> numeroSoportesAlquilados >= $this -> maxAlquilerConcurrente ) { //Si el número de soportes alquilados es el máximo o mayor no alquila
            $estado = false;
            //Imprimimos el problema
            echo ("<br>Este cliente tiene {$this -> numeroSoportesAlquilados} elementos alquilados. No puede alquilar más en este videoclub hasta que no devuelva algo</b><br>");
        } else { //Si se puede alquilar se hace, y se añade uno al número de soportes alquilados
            array_push($this -> soportesAlquilados, $s); //Se añade el nuevo soporte al array
            $this -> numeroSoportesAlquilados ++; //Se suma uno al número de soportes alquilados
            $estado = true; //Se cambia el estado a true para indicar que la operación se ha realizado con éxito
            //Imprimimos la información
            echo ("<br><b>Alquilado soporte a:</b> {$this -> nombre}<br><br>");
            $s -> muestraResumen();
            echo ("<br><br><br>");
        }
        return $estado;
    }
    
    public function devolver(int $numSoporte) : bool { //Devolverá true si se ha devuelto y false si no se ha podido devolver
        $estado = false; //Se empieza con el estado que devolveremos en false por defecto
        for ($i = 0; $i < count($this -> soportesAlquilados) && !$estado; $i++) { //Se recorre el array hasta terminarlo o encontrar el soporte
            //Si el número del soporte de la posición $i del array es igual al número de soporte dado...
            if ($this -> soportesAlquilados[$i] -> getNumero() === $numSoporte) {
                //... se elimina el soporte de la posición $i,...
                unset($this -> soportesAlquilados[$i]);
                //... se reindexa para que el array tenga un número de posiciones igual al número de soportes alquilados,...
                $this -> soportesAlquilados[] = array_values($this -> soportesAlquilados);
                //... se resta uno al número de soportes alquilados...
                $this -> numeroSoportesAlquilados --;
                //... y finalmente estado cambia a true y para que salga del for al acabar.
                $estado = true;
                // Imprimimos
                echo ("<b>Soporte de número {$numSoporte} por:</b> {$this -> nombre}<br><br><br>");
                echo ("<br><br><br>");
            }
        }
        if (!$estado && $this -> numeroSoportesAlquilados <= 0) { //Si no tiene nada alquilado no lo puede devolver, lo imprimimos
            echo ("Este cliente no tiene alquilado ningún elemento<br>");
        } elseif (!$estado) { //Si no lo tiene alquilado no lo puede devolver, lo imprimimos
            echo ("<br>No se ha podido encontrar el soporte en los alquileres de este cliente<br>");
        }
        return $estado;
    }
    
    public function listarAlquileres() : void {
        //Muestra un mensaje según si tiene alquilados varios, uno o cero soportes
        if ($this -> numeroSoportesAlquilados > 1) {
            echo ("<br><b>El cliente tiene {$this -> numeroSoportesAlquilados} soportes alquilados</b><br><br><br>");
        } elseif ($this -> numeroSoportesAlquilados = 1) {
            echo ("<br><b>El cliente tiene 1 soporte alquilado</b><br><br><br>");
        } else {
            echo("<br><b>El cliente no tiene alquilado ningún elemento</b><br><br><br>");
        }
        
        foreach ($this -> soportesAlquilados as $soporte) { //Muestra el resumen de cada soporte
            $soporte -> muestraResumen();
            echo ("<br><br><br>");
        }
    }
}
?>
