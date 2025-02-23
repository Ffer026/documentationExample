## Videoclub Proyect. DAW 2º Y I.E.S. Kursaal
### Realizado por Victor Patrick Tonna Lara y Francisco Fernando Gaitán Pérez

Este es un proyecto para el módulo de Desarrollo en Entorno Servidor del Grado Superior de Desarrollo de Aplicaciones Web en el I.E.S. Kursaal.

La actividad consiste en realizar varias clases en PHP que se relacionan entre si con herencias, implementaciones o interfaces entre otras herramientas.

En este README explicaremos cómo se utilizan estas clases y cuál es la estructura de los datos.

Las clases que tenemos son:
* `inicio*.php`: Todas las clases que empiezan por inicio sirven para probar las clases. inicioSoporte.php no funciona ya que Soporte es una clase abstracta. inicioVideoclub.php lo prueba todo ya que videoclub usa todas las clases del proyecto.
* `Resumible.php`: Esta interfaz es implementada por Soporte, e incluye el método muestraResumen, que sirve para que imprima datos de los soportes.
* `Soporte.php`: Esta clase es abstracta, y es el padre de las clases de los soportes que pueden alquilarse en el videoclub. Contiene los métodos y propiedades comunes.
* `CintaVideo.php`, `Dvd.php` y `Juego.php`: Estas clases heredan Soporte y le añaden métodos y propiedades características de cada soporte específico.
* `Cliente.php`: Esta clase tiene propiedades y métodos propias de un cliente, además de tener un array de soportes poseídos.
* `Videoclub.php`: Esta es la clase que debe usarse en útimo lugar. Implementa las demás para permitir interacciones complejas entre ellas y consigo misma. Contiene propiedades y métodos que emulan un videoclub, incluyendo listas de usuarios y stock de soportes.

## Documentación

### inicio*.php

Los archivos que empiezan por inicio solo sirven para ejecutarse y probar las demás clases, correspondiendo cada inicio a cada clase según indica su nombre. Como ya se ha dicho inicioSoporte.php no funciona ya que Soporte es una clase abstracta. inicioVideoclub.php lo prueba todo ya que videoclub usa todas las clases del proyecto.

### Resumible.php (Interfaz)

* muestraResumen() : void

### Soporte.php (Abstracta)

* __construct(string $titulo, int $numero, float $precio)
* getPrecio() : float
* getPrecioConIVA() : float
* getNumero() : int
* muestraResumen() : void

### CintaVideo.php
* __construct(string $titulo, int $numero, float $precio, float $duracion)
* muestraResumen() : void

### Dvd.php
* __construct(string $titulo, int $numero, float $precio, string $idiomas, string $formatPantalla)
* muestraResumen() : void

### Juego.php
* __construct(string $titulo, int $numero, float $precio, string $consola, int $numMinJugadores, int $numMaxJugadores)
* muestraResumen() : void

### Cliente
* __construct(string $nombre, int $numero, int $maxAlquilerConcurrente = 3)
* getNumero() : int
* setNumero(int $numero) : void
* getNumeroSoportesAlquilados() : int
* muestraResumen() : void
* tieneAlquilado(Soporte $s) : bool
* alquilar(Soporte $s) : bool
* devolver(int $numSoporte) : bool
* listarAlquileres() : void

### Videoclub
* __construct($nombre)
* incluirProducto(Soporte $producto) : void
* incluirCintaVideo (string $titulo, float $precio, float $duracion) : void
* incluirDvd (string $titulo, float $precio, string $idiomas, string $pantalla) : void
* incluirJuego (string $titulo, float $precio, string $consola, int $minJ, int $maxJ) : void
* incluirSocio (string $nombre, int $maxAlquileresConcurrentes = 3) : void
* listarProductos() : void
* listarSocios() : void
* alquilaSocioProducto(int $numeroCliente, int $numeroSoporte) : void
