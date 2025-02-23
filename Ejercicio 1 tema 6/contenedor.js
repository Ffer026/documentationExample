class Contenedor {
    constructor(id, peso, contenido, destino) {
        this.id = id;
        this.peso = peso;
        this.contenido = contenido;
        this.destino = destino;
    }

    mostrarInfo() {
        return `\{id: ${this.id}, peso: ${this.peso}, contenido: ${this.contenido}, destino: ${this.destino}\}`;
    }
}
