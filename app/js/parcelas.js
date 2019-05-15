var usuario;
var parcelas = [];
var vertices = [];
var sondas = [];
var mediciones = [];
var notas = [];
var porcentajes = [];
var selector = [];
var all = true;

var qSondas = 0;

function getParcelas(id) {
    fetch("../api/v1.0/parcelas?id=" + id)
        .then(
            function (response) {
                console.log(response)
                return response.json()
            }
        )
        .then(function (json) {
            parcelas = json.datos;
            if (extra != "-responsive") crearListaParcelas();
            else {
                $("[data-toggle=popover]").popover();
            }

        })
}

function getVertices(id) {
    fetch("../api/v1.0/vertices?id=" + id)
        .then(
            function (response) {
                return response.json()
            }
        )
        .then(function (json) {
            vertices = json.datos;
        })
}

function getSondas(id) {
    fetch("../api/v1.0/sondas?id=" + id)
        .then(
            function (response) {
                return response.json()
            }
        )
        .then(function (json) {
            sondas = json.datos;
        })
}

// Se podrían cargar las mediciones dependiendo de la sondas que has
// seleccionado para no sobrecargar tanto la memoría en caso de haber
// muchas mediciones.
/* En este caso se cargarán todas las mediciones al principio */
function getMediciones(id) {
    fetch("../api/v1.0/mediciones?id=" + id)
        .then(
            function (response) {
                return response.json()
            }
        )
        .then(function (json) {
            mediciones = json.datos;
            pasarAPorcentaje();
        })
}


function getNotas(id) {
    fetch("../api/v1.0/notas?id=" + id)
        .then(
            function (response) {
                return response.json()
            }
        )
        .then(function (json) {
            notas = json.datos;
            if (extra != "-responsive") llenarNotas();
            $("[data-toggle=popover]").popover();
        })
}

function llenarNotas() {
    document.getElementById("añadirNota").setAttribute("href", "javascript: añadirNota('" + id + "')")
    document.getElementById("borrarNota").setAttribute("href", "javascript: borrarNota()")
    document.getElementById("editarNota").setAttribute("href", "javascript: editarNota()")
    notas.forEach(nota => {
        var elemento = document.createElement("div");
        var encabezado = document.createElement("div");
        var asunto = document.createElement("div");
        var fecha = document.createElement("div");
        var contenido = document.createElement("div");
        asunto.innerHTML = nota.asunto;
        asunto.className = "asunto";
        fecha.innerHTML = nota.fecha;
        encabezado.appendChild(asunto);
        encabezado.appendChild(fecha);
        encabezado.className = "encabezadoNota";
        contenido.innerHTML = nota.descripcion;
        contenido.className = "contenidoNota";
        elemento.appendChild(encabezado);
        elemento.appendChild(contenido);
        elemento.className = "nota";
        elemento.onclick = function () {
            if (this.lastChild.className != "contenidoNota expansion") this.lastChild.className = this.lastChild.className + " expansion";
            else this.lastChild.className = "contenidoNota";
        };
        document.getElementById("notas" + extra).appendChild(elemento);
    })
}

function fechaActual() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    return yyyy + '-' + mm + '-' + dd;
}

var nota;
var elemento;

function borrarNota() {
    console.log(this)
    var elementos = document.getElementById("notas-responsive").childNodes;
    for (let i = 0; i < elementos.length; i++) {
        if (elementos[i].className != "borrarNota") {
            elementos[i].className = "borrarNota";
            document.getElementById("tituloNota").innerHTML = "Borrar notas";
            elementos[i].onclick = function () {
                $('#myModal').modal('show');
                nota = notas[i];
                elemento = elementos[i];
            }
        } else {
            elementos[i].className = "nota";
            document.getElementById("tituloNota").innerHTML = "Notas";
            elementos[i].onclick = function () {
                if (this.lastChild.className != "contenidoNota expansion") this.lastChild.className = this.lastChild.className + " expansion";
                else this.lastChild.className = "contenidoNota";
            };
        }
    }
    /*
    elementos.forEach(elemento => {
        if (elemento.className != "borrarNota") {
            elemento.className = "borrarNota";
            document.getElementById("tituloNota").innerHTML = "Borrar notas";
            elemento.onclick = function () {
                $('#myModal').modal('show')
                nota = elemento;
            }
        } else {
            elemento.className = "nota";
            document.getElementById("tituloNota").innerHTML = "Notas";
            elemento.onclick = function () {
                if (this.lastChild.className != "contenidoNota expansion") this.lastChild.className = this.lastChild.className + " expansion";
                else this.lastChild.className = "contenidoNota";
            };
        }
    })*/
}

function eliminarNota() {
    fetch("../api/v1.0/notas?id=" + nota.id, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id: '5bdcdfa40f0a326f858feae0'
            })
        })
        .then(res => res.text()) // OR res.json()
        .then(res => {elemento.remove(); 
            $('#myModal').modal('hide');})
}

function editarNota(codigo) {

    var elementos = document.getElementById("notas-responsive").childNodes;
    elementos.forEach(elemento => {
        if (elemento.className != "editarNota") {
            elemento.className = "editarNota";
            document.getElementById("tituloNota").innerHTML = "Editar notas";
            elemento.onclick = function () {
                actualizarNota(codigo, elemento);
            }
        } else {
            elemento.className = "nota";
            document.getElementById("tituloNota").innerHTML = "Notas";
            elemento.onclick = function () {
                if (this.lastChild.className != "contenidoNota expansion") this.lastChild.className = this.lastChild.className + " expansion";
                else this.lastChild.className = "contenidoNota";
            };
        }
    })
}

function actualizarNota(codigo, datos){
    console.log(datos)
    document.getElementById("borrarNota").style.visibility = "hidden"
    document.getElementById("editarNota").style.visibility = "hidden"
    document.getElementById("añadirNota").style.visibility = "hidden"
    var elementos = document.getElementById("notas-responsive").childNodes;
    elementos.forEach(elemento => {
        elemento.style.display = "none";
    })
    var createform = document.createElement('form'); // Create New Element Form
    createform.setAttribute("action", "../api/v1.0/notas"); // Setting Action Attribute on Form
    createform.setAttribute("method", "post"); // Setting Method Attribute on Form
    /*
        var namelabel = document.createElement('label'); // Create Label for Name Field
        namelabel.innerHTML = "Your Name : "; // Set Field Labels
        createform.appendChild(namelabel);
        */
    let method = document.createElement('input');
    method.setAttribute("type", "hidden");
    method.setAttribute("name", "method");
    method.value = "put";
    createform.appendChild(method);
    let id = document.createElement('input');
    id.setAttribute("type", "hidden");
    id.setAttribute("name", "id");
    id.value = codigo;
    createform.appendChild(id);
    let fecha = document.createElement('input');
    fecha.setAttribute("type", "hidden");
    fecha.setAttribute("name", "fecha");
    fecha.value = fechaActual();
    createform.appendChild(fecha);
    var encabezado = document.createElement('div');
    var asunto = document.createElement('input'); // Create Input Field for Name
    asunto.setAttribute("type", "text");
    asunto.setAttribute("name", "asunto");
    asunto.placeholder = "Asunto...";
    asunto.value = datos.childNodes[0].childNodes[0].innerHTML;
    asunto.className = "nuevoAsunto";

    encabezado.appendChild(asunto);
    encabezado.className = "encabezadoNota";

    createform.appendChild(encabezado);
    var contenido = document.createElement('textarea');
    contenido.setAttribute("name", "contenido");
    contenido.placeholder = "Contenido...";
    contenido.value = datos.childNodes[1].innerHTML;
    contenido.className = "contenidoNuevaNota";

    contenido.oninput = function () {
        if (asunto.value != "" && contenido.value != "") {
            submitelement.disabled = false;
            submitelement.className = "boton-sm float-right"
        } else {
            submitelement.disabled = true;
            submitelement.className = "botonUnset float-right"
        }
    }
    createform.appendChild(contenido);

    var cancelelement = document.createElement('button');
    cancelelement.onclick = function () {
        var elementos = document.getElementById("notas-responsive").childNodes;

        document.getElementById("borrarNota").style.visibility = "visible"
        document.getElementById("editarNota").style.visibility = "visible"
        elementos.forEach(elemento => {
            if (elemento.style.display == "none") elemento.style.display = "block";
            else elemento.remove();
        })
    }
    cancelelement.innerHTML = "Cancelar";
    cancelelement.setAttribute("class", "boton-sm");
    createform.appendChild(cancelelement);

    var submitelement = document.createElement('input'); // Append Submit Button
    submitelement.setAttribute("type", "submit");
    submitelement.setAttribute("name", "enviar");
    submitelement.setAttribute("value", "Guardar");
    submitelement.setAttribute("class", "botonUnset float-right");
    //submitelement.id = "submitelement";
    submitelement.disabled = true;
    createform.appendChild(submitelement);


    createform.className = "nota";

    document.getElementById("notas" + extra).appendChild(createform);
}

function añadirNota(codigo) {
    document.getElementById("borrarNota").style.visibility = "hidden"
    document.getElementById("editarNota").style.visibility = "hidden"
    var elementos = document.getElementById("notas-responsive").childNodes;
    elementos.forEach(elemento => {
        elemento.style.display = "none";
    })
    var createform = document.createElement('form'); // Create New Element Form
    createform.setAttribute("action", "../api/v1.0/notas"); // Setting Action Attribute on Form
    createform.setAttribute("method", "post"); // Setting Method Attribute on Form
    /*
        var namelabel = document.createElement('label'); // Create Label for Name Field
        namelabel.innerHTML = "Your Name : "; // Set Field Labels
        createform.appendChild(namelabel);
        */

    let id = document.createElement('input');
    id.setAttribute("type", "hidden");
    id.setAttribute("name", "id");
    id.value = codigo;
    createform.appendChild(id);
    let fecha = document.createElement('input');
    fecha.setAttribute("type", "hidden");
    fecha.setAttribute("name", "fecha");
    fecha.value = fechaActual();
    createform.appendChild(fecha);
    var encabezado = document.createElement('div');
    var asunto = document.createElement('input'); // Create Input Field for Name
    asunto.setAttribute("type", "text");
    asunto.setAttribute("name", "asunto");
    asunto.placeholder = "Asunto...";
    asunto.className = "nuevoAsunto";

    encabezado.appendChild(asunto);
    encabezado.className = "encabezadoNota";

    createform.appendChild(encabezado);
    var contenido = document.createElement('textarea');
    contenido.setAttribute("name", "contenido");
    contenido.placeholder = "Contenido...";
    contenido.className = "contenidoNuevaNota";

    contenido.oninput = function () {
        if (asunto.value != "" && contenido.value != "") {
            submitelement.disabled = false;
            submitelement.className = "boton-sm float-right"
        } else {
            submitelement.disabled = true;
            submitelement.className = "botonUnset float-right"
        }
    }
    createform.appendChild(contenido);

    var cancelelement = document.createElement('button');
    cancelelement.onclick = function () {
        var elementos = document.getElementById("notas-responsive").childNodes;

        document.getElementById("borrarNota").style.visibility = "visible"
        document.getElementById("editarNota").style.visibility = "visible"
        elementos.forEach(elemento => {
            if (elemento.style.display == "none") elemento.style.display = "block";
            else elemento.remove();
        })
    }
    cancelelement.innerHTML = "Cancelar";
    cancelelement.setAttribute("class", "boton-sm");
    createform.appendChild(cancelelement);

    var submitelement = document.createElement('input'); // Append Submit Button
    submitelement.setAttribute("type", "submit");
    submitelement.setAttribute("name", "enviar");
    submitelement.setAttribute("value", "Guardar");
    submitelement.setAttribute("class", "botonUnset float-right");
    //submitelement.id = "submitelement";
    submitelement.disabled = true;
    createform.appendChild(submitelement);


    createform.className = "nota";

    document.getElementById("notas" + extra).appendChild(createform);
}

function pasarAPorcentaje() {
    let temperatura, humedad, salinidad, iluminacion, presion;
    mediciones.forEach(medicion => {
        temperatura = 100 * 0 / (0 - 40) - medicion.temperatura * 100 / (0 - 40);
        humedad = 100 * 0 / (0 - 100) - medicion.humedad * 100 / (0 - 100);
        salinidad = 100 * 0 / (0 - 200) - medicion.salinidad * 100 / (0 - 200);
        iluminacion = 100 * 0 / (2000 - 10000) - medicion.iluminacion * 100 / (2000 - 10000);
        presion = 100 * 0 / (0 - 10000) - medicion.presion * 100 / (0 - 10000);
        porcentajes.push({
            "nombre": medicion.nombre,
            "id": medicion.id,
            "tiempo": medicion.tiempo,
            "temperatura": temperatura,
            "humedad": humedad,
            "salinidad": salinidad,
            "iluminacion": iluminacion,
            "presion": presion
        });
    });
}

function buscarParcela() {
    setTimeout(() => {
        var buscador = document.getElementById("buscador" + extra);
        filtrarParcelas(buscador.value);
    }, 10);
}

function crearListaParcelas() {
    var element = document.getElementById("parcelas" + extra);
    if (extra == "-responsive") {
        var buscador = document.createElement("input");
        buscador.id = "buscador" + extra;
        buscador.type = "text";
        buscador.placeholder = "Buscar...";
        buscador.oninput = function () {
            buscarParcela();
        }
        element.appendChild(buscador);
    }
    for (parcela of parcelas) {
        var input = document.createElement("input");
        var label = document.createElement("label");
        var div = document.createElement("div");
        input.setAttribute("type", "checkbox");
        input.setAttribute("id", "parcela" + parcela.id);
        input.setAttribute("onchange", "mostrarParcela(" + parcela.id + ")")
        input.setAttribute("value", parcela.id);
        input.setAttribute("checked", true);
        console.log(input)
        label.textContent = parcela.nombre;
        label.setAttribute("class", "form-check-label");
        label.setAttribute("for", "parcela" + parcela.id);
        div.appendChild(input);
        div.appendChild(label);
        div.setAttribute("class", "parcela");
        element.appendChild(div);
    }
}

function filtrarParcelas(filtrado) {
    var selector = document.getElementById("parcelas" + extra).childNodes;
    selector.forEach(parcela => {
        if (parcela.id != "buscador" + extra) {
            if (!parcela.lastChild.innerText.includes(filtrado)) {
                parcela.hidden = true;
            } else {
                parcela.hidden = false;
            }
        }
    });
}

function mostrarParcela(id) {
    mostrarOcultarPoligono(id);
}

function fullscreen() {
    var element = document.getElementById("contenedor-grafica-responsive");
    if (element.style.position != "relative") {
        element.style.position = "relative";
        element.style.bottom = "83.6%";
        element.style.height = "83.6%";
        element.style.marginBottom = "-900%";
        document.getElementById("desplegableGrafica").style.visibility = "hidden";
        document.getElementById("fsBox").style.display = "block";
    } else {
        element.style.position = "fixed";
        element.style.bottom = "0";
        element.style.height = "auto";
        element.style.marginBottom = "";
        document.getElementById("desplegableGrafica").style.visibility = "visible";
        document.getElementById("fsBox").style.display = "none";
    }
}


function seleccionarParcela(json, sondas, parcela) {
    var lista = []
    var posiciones = []
    if (parcela != "null") {
        for (let i = 0; i < json.length; i++) {
            if (json[i].id_parcela == parcela) {
                lista.push(json[i])
                for (let j = 0; j < sondas.length; j++) {
                    if (sondas[j].id_parcela == parcela) {
                        posiciones.push(sondas[j]);
                    }
                }
            }
        }

        vaciarMapa()
        mostrarOcultarPoligono(lista)
    }
}

function dibujarParcelas() {
    var poligono = []
    parcelas.forEach(parcela => {
        poligono = []
        vertices.forEach(vertice => {
            if (vertice.id_parcela == parcela.id) {
                poligono.push(
                    new google.maps.LatLng(parseFloat(vertice.lat), parseFloat(vertice.lng))
                )
            }
        });
        dibujarPoligono(poligono, parcela.color, parcela.id)
        mostrarPosicionesMapa(parcela.id)
    });
}



function mostrarPosicionesMapa(id) {
    sondas.forEach(sonda => {
        if (sonda.id_parcela == id) {
            var parcela = parcelas.find(x => x.id === sonda.id_parcela);
            var porcentaje = porcentajes.find(x => x.id === sonda.id && x.nombre === parcela.nombre);
            var contenido = '<div id="content">' + '<h4>Sensor ' + sonda.id + ' </h4>' +
                '<div id="bodyContent" style="text-align:center;">' +
                '<p><button class="low-btn"><img src="images/temperature.svg" alt="Temperatura" width="30px" height="30px"></img>' + Math.floor(porcentaje.temperatura) +
                '%</button> <button class="low-btn"><img src="images/sun.svg" alt="Iluminacion" width="30px" height="30px"></img>' + Math.floor(porcentaje.iluminacion) +
                '%</button> <button class="low-btn"><img src="images/salt.svg" alt="Salinidad" width="30px" height="30px"></img>' + Math.floor(porcentaje.salinidad) +
                '%</button> <button class="low-btn"><img src="images/water.svg" alt="Humedad" width="30px" height="30px"></img>' + Math.floor(porcentaje.humedad) +
                '%</button> <button class="low-btn"><img src="images/preasure.svg" alt="Presion" width="30px" height="30px"></img>' + Math.floor(porcentaje.presion) + '% </button><br></p>' +
                '<p> Ultima medida: ' + porcentaje.tiempo + '<br></p>' +
                '<p><a href="javascript:llenarGrafica(\'' + sonda.id + '\', \'' + parcela.nombre + '\')">' +
                '<button class="boton">Seleccionar sonda</button></a> ' +
                '<button id="graficaBoton" class="boton" data-toggle="collapse" data-target="#contenedor-grafica" aria-expanded="false" aria-controls="contenedor-grafica"><img id="miniatura" src="images/chart.svg" alt="Grafica" height="25px" width="25px"> Mostrar gráfica </button>' +
                '</div>' +
                '</div>';
            ponerPunto(new google.maps.LatLng(parseFloat(sonda.lat), parseFloat(sonda.lng)), contenido, id)
        }
    });
}

function aumentarContador(id_sonda, nombre_parcela) {
    qSondas++;

    var element = document.getElementById("sondas");
    var input = document.createElement("input");
    var label = document.createElement("label");
    var div = document.createElement("div");
    input.setAttribute("type", "checkbox");
    input.setAttribute("id", "sonda_" + id_sonda);
    //    input.setAttribute("onchange", "mostrarParcela(" + parcela.id + ")")
    input.setAttribute("value", id_sonda);
    input.setAttribute("checked", true);
    console.log(input)
    label.textContent = nombre_parcela + ", sonda: " + id_sonda;
    label.setAttribute("class", "form-check-label");
    label.setAttribute("for", "sonda_" + id_sonda);
    div.appendChild(input);
    div.appendChild(label);
    div.setAttribute("class", "sonda");
    element.appendChild(div);
    /*
    var element = document.getElementById("qSondas");
    element.style.display = "block";
    element.innerText = qSondas;
    */
}

function reiniciarContador() {
    qSondas = 0;
    var element = document.getElementById("sondas");
    element.innerHTML = "";
    /*
    var element = document.getElementById("qSondas");
    element.style.display = "none";
    element.innerText = qSondas;
    */
}

/*
function controlContenedorGrafica(){
    
    //if(window.innerWidth <= 600 && window.innerHeight <= 900){
    //    document.getElementById("map").style.height = "30vh";
    //}
    var element = document.getElementById("contenedor-grafica");
    var img = document.getElementById("miniatura");
    var text= document.getElementById("text");
    var flecha= document.getElementById("bajar");
    if (element.style.display != "block") {
        element.style.display = "block";
        img.src = "images/close.svg";
        document.getElementById("qSondas").style.display = "none";
        text.innerText = "Ocultar grafica";
        if(window.innerWidth <= 900) flecha.style.display = "block";
    }else{ 
        element.style.display = ""
        img.src = "images/chart.svg";
        document.getElementById("qSondas").style.display = "block";
        flecha.style.display = "none";
        text.innerText = "Mostrar grafica"
    }
}

function cambiarVisualizacion(eleccion){
    for(var element of document.getElementById("navSonda").childNodes){
        element.getElementsByTagName("a")[0].className = "botonUnset"
        };
    eleccion.setAttribute("class", "boton");
    if(eleccion.innerHTML == "Tiempo"){
        document.getElementById("grafica-responsive").style.display = "none";
        document.getElementById("contenedor-tiempo").style.display = "flex";
    }else{
        document.getElementById("grafica-responsive").style.display = "flex";
        document.getElementById("contenedor-tiempo").style.display = "none";
    }
}
*/


function mostrarGrafica(extra) {
    var element = document.getElementById("grafica" + extra);
    element.style.display = "flex";
    var element = document.getElementById("nografica" + extra);
    element.style.display = "none";
}

function quitarGrafica() {
    //if(window.innerWidth <= 600 && window.innerHeight <= 900){
    //    document.getElementById("map").style.height = "67vh";
    //}
    reiniciarContador();
    var element = document.getElementById("grafica");
    element.style.display = "";
    var element = document.getElementById("nografica");
    element.style.display = "block";
    document.getElementById("desplegableGrafica").style.visibility = "hidden";
    document.getElementById("contenedor-tiempo" + extra).style.visibility = "hidden";
    document.getElementById("contenedor-grafica" + extra).classList.remove("show");
    vaciarGrafica();
}

window.onscroll = function () {
    scrollFunction()
};

function scrollFunction() {
    document
        .getElementById("bajar")
        .style
        .display = "none";
}