class Puerto {
    constructor(nombre, contenedores = []) {
        this.nombre = nombre;
        this.contenedores = contenedores;
    }

    mostrarInfo() {
        return `\{nombre: ${this.nombre}, contenedores: ${this.contenedores}\}`;
    }

    agregarContenedor(contenedor) {
        let alreadyExists = this.contenedores.some(contenedorExistente => contenedorExistente.id === contenedor.id);

        if (!alreadyExists) {
            this.contenedores.push(contenedor);
            return 1;
        } else {
            console.log("Ya hay un contenedor con esta identificación, pruebe de nuevo.")
            return -1;
        }
    }

    eliminarContenedor(id) {
        let targetPosition = this.contenedores.indexOf(id);

        if (targetPosition === -1) {
            //Mensaje de error
            console.log("Este contenedor no ha sido encontrado.");
            return -1;
        } else {
            this.contenedores.splice(id, 1);
            console.log("Este contenedor ha sido borrado.");
            return 1;
        }
    }
    
}
