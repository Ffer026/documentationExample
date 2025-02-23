document.addEventListener("DOMContentLoaded", function () {
    //Este es el puerto sobre el que trabajaremos
    //Se podría hacer que se puedan introducir también puertos, pero por ahora sólo se pueden añadir contenedores
    let puertoPrueba = new Puerto("Puerto de Pruebalandia");

    //Al darle a Submit
    document.getElementById("agregarContenedor").addEventListener("submit", function(event) {
        event.preventDefault();//La acción por defecto de submit, el envío, se previene
        //Creamos un nuevo contenedor con los datos pasados. Quizás podría poner unas validaciones antes
        let nuevoContenedor = new Contenedor(id.value.trim(), peso.value, contenido.value.trim(), destino.value.trim());

        //Agregamos el contenedor a contenedores dentro de puertoPrueba
        puertoPrueba.agregarContenedor(nuevoContenedor);
        //Actualizamos la lista en el HTML con los nuevos datos de contenedores
        actualizarLista();
        //this.reset(); //Para limpiar el formulario
    });

    function addTdToTable(contenedor, characteristicName, tr, content) { //Añade un td a un tr de una tabla
        let newTd = document.createElement("td"); //Crea el td

        //El name y el id es el id del contenedor al que se refiere más la característica a la que se refiere
        newTd.setAttribute("name", `${contenedor.id}` + characteristicName);
        newTd.setAttribute("id", `${contenedor.id}` + characteristicName);
        newTd.textContent = content;

        newTd.addEventListener("mouseover", function() { //Al pasar el ratón por encima cambia de color...
            newTd.setAttribute("style", "background-color: aquamarine;");
        });

        newTd.addEventListener("mouseout", function() { //...Y después vuelve a su color original
            newTd.setAttribute("style", "background-color: none;");
        });

        tr.appendChild(newTd); //Y lo metemos en el tr

        if (content !== null && characteristicName !== "Destino") {
            //Si el contenido no es nulo, o sea, todos los que no sean el td de imagen
            //Y si no es destino, ya que destino es select, no input
            //Creamos las cosas que queremos poner dentro cuando se haga doble click
            let newForm = document.createElement("form");
            let newInput = document.createElement("input");
            let hiddenNewSubmit = document.createElement("input");
            //Y guardamos la información que había antes de modificarla
            let placeholder = newTd.textContent;

            newTd.addEventListener("dblclick", function() { //Añadimos evento para escuchar el doble click en cada ccelda
                //Que meta el input de texto con placeholder de la información anterior
                newInput.setAttribute("type", "text");
                newInput.setAttribute("placeholder", placeholder);
                //El botón de submit escondido, para mayor elegancia
                hiddenNewSubmit.setAttribute("type", "submit");
                hiddenNewSubmit.style.display = "none";

                newForm.setAttribute("name", contenedor.id + characteristicName + "Form")
                newForm.setAttribute("id", contenedor.id + characteristicName + "Form")

                hiddenNewSubmit.setAttribute("name", contenedor.id + characteristicName + "Submit")
                hiddenNewSubmit.setAttribute("id", contenedor.id + characteristicName + "Submit")

                newInput.setAttribute("name", contenedor.id + characteristicName + "Input")
                newInput.setAttribute("id", contenedor.id + characteristicName + "Input")

                newForm.appendChild(newInput);
                newForm.appendChild(hiddenNewSubmit);

                newTd.textContent = null; //Cuidado con esta función que borra más de lo que parece, da problemas

                newTd.appendChild(newForm);

                newInput.focus(); //Hacemos que el usuario ya esté con el foco para escribir en la caja de texto
            });

            newForm.addEventListener("submit", function(event) { //Si en el nuevo input le da a intro
                endingParameterSubmition(event, newInput, newTd, contenedor, characteristicName, placeholder);
            });

            newInput.addEventListener("blur", function(event) { //Si en el nuevo input pierde el foco (Guarda información)
                endingParameterSubmition(event, newInput, newTd, contenedor, characteristicName, placeholder);
            });

        } else if (content !== null) { //Si es destino (select)
            let newForm = document.createElement("form");
            let newInput = document.createElement("select");
            let newOptionEuropa = document.createElement('OPTION');
            let newOptionUsa = document.createElement('OPTION');
            let newOptionOriente = document.createElement('OPTION');
            let newOptionAfrica = document.createElement('OPTION');
            let hiddenNewSubmit = document.createElement("input");
            let placeholder = newTd.textContent;

            newTd.addEventListener("dblclick", function() {

                newOptionEuropa.setAttribute("value", "Europa");
                newOptionUsa.setAttribute("value", "USA");
                newOptionOriente.setAttribute("value", "Oriente");
                newOptionAfrica.setAttribute("value", "Africa");

                newInput.appendChild(newOptionEuropa);
                newInput.appendChild(newOptionUsa);
                newInput.appendChild(newOptionOriente);
                newInput.appendChild(newOptionAfrica);
                //En cada doble click hay que borrar el texto
                newOptionEuropa.textContent = null;
                newOptionUsa.textContent = null;
                newOptionOriente.textContent = null;
                newOptionAfrica.textContent = null;

                newOptionEuropa.appendChild(document.createTextNode("Europa"));
                newOptionUsa.appendChild(document.createTextNode("USA"));
                newOptionOriente.appendChild(document.createTextNode("Oriente"));
                newOptionAfrica.appendChild(document.createTextNode("Africa"));                

                hiddenNewSubmit.setAttribute("type", "submit");
                hiddenNewSubmit.style.display = "none";

                newForm.setAttribute("name", contenedor.id + characteristicName + "Form")
                newForm.setAttribute("id", contenedor.id + characteristicName + "Form")

                hiddenNewSubmit.setAttribute("name", contenedor.id + characteristicName + "Submit")
                hiddenNewSubmit.setAttribute("id", contenedor.id + characteristicName + "Submit")

                newInput.setAttribute("name", contenedor.id + characteristicName + "Input")
                newInput.setAttribute("id", contenedor.id + characteristicName + "Input")

                newForm.appendChild(newInput);
                newForm.appendChild(hiddenNewSubmit);

                newTd.textContent = null;

                newTd.appendChild(newForm);

                newInput.focus();
            });

            newForm.addEventListener("submit", function(event) {
                endingParameterSubmition(event, newInput, newTd, contenedor, characteristicName, placeholder);
            });

            newInput.addEventListener("blur", function(event) {
                endingParameterSubmition(event, newInput, newTd, contenedor, characteristicName, placeholder);
            });
        }
    }

    function endingParameterSubmition(event, newInput, newTd, contenedor, characteristicName, placeholder) {
        //Esto se ejecuta cuando en el input o select creado del doble click en la celda, se sale con un intro o dejando el foco
        //Prevenimos la acción de envío por defecto de submit
        event.preventDefault();
                if (newInput.value !== "") { //Si se ha escrito algo
                    //El texto pasa a ser lo introducido
                    newTd.textContent = newInput.value;

                    switch (characteristicName) {//Se busca en qué característica del contenedor estamos
                        //Y se actualiza el contenedor del array del puerto
                        case "Id":
                            contenedor.id  = newTd.textContent;
                            break;
                    
                        case "Peso":
                            contenedor.peso  = newTd.textContent;
                            break;
                    
                        case "Contenido":
                            contenedor.contenido  = newTd.textContent;
                            break;
                    
                        case "Destino":
                            contenedor.destino  = newTd.textContent;
                            break;
                    
                        default:
                            console.log("Error al actualizar el puerto");
                            break;
                    }
                } else {//Si no se ha escrito nada
                    //El mismo valor que tenía antes
                    newTd.textContent = placeholder;
                }
    }

    function addImageEliminar(contenedor, td, src) { //Para añadir la imagen que clickas y eliminas el contenedor
        let imageEliminar = document.createElement("img");
        let imageIdOrName = `${contenedor.id}` + "ImageEliminar";

        imageEliminar.setAttribute("src", src);
        imageEliminar.setAttribute("name", imageIdOrName);
        imageEliminar.setAttribute("id", imageIdOrName);

        td.appendChild(imageEliminar);

        document.getElementById(imageIdOrName).addEventListener("click", function() {
            //Buscamos en contenedores el contenedor cuyo id coincida con el atributo id del abuelo de la imagen
            //La imagen tiene como padre un td y como abuelo un tr. El tr tiene como atributo id el id del contenedor que representa
            let index = puertoPrueba.contenedores.findIndex(contenedor => contenedor.id === document.getElementById(imageIdOrName).parentElement.parentElement.id);
            //Eliminamos el contenedor del array
            puertoPrueba.contenedores.splice(index, 1);
            
            actualizarLista();
        });
    }

    function actualizarLista() {
        let list = document.querySelector("table");

        while (list.childElementCount > 1) {
            //Borramos el último niño hasta que solo queda 1, el header de la tabla
            //O sea que borramos los elementos de la tabla
            list.removeChild(list.lastChild);
        }

        puertoPrueba.contenedores.forEach(contenedor => {
            
            let tr = document.createElement("tr"); //Creo el tr
            
            tr.setAttribute("name", `${contenedor.id}`);
            tr.setAttribute("id", `${contenedor.id}`);
            
            list.appendChild(tr);

            addTdToTable(contenedor, "Id", tr, contenedor.id);
            addTdToTable(contenedor, "Peso", tr, contenedor.peso);
            addTdToTable(contenedor, "Contenido", tr, contenedor.contenido);
            addTdToTable(contenedor, "Destino", tr, contenedor.destino);
            addTdToTable(contenedor, "Eliminar", tr, null);
            addImageEliminar(contenedor, document.getElementById(contenedor.id + "Eliminar"), "https://cdn-icons-png.flaticon.com/256/12632/12632639.png");

        });
    };
});