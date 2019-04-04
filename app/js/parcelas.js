var usuario;
var parcelas = [];
var vertices = [];
var sondas = [];
var mediciones = [];
var porcentajes = [];
var selector = [];
var all = true;

function getParcelas(id) {
    fetch("../api/v1.0/parcelas?id=" + id)
        .then(
            function (response) {
                console.log(response)
                return response.json()
            }
        )
        .then(function (json) {
            crearListaParcelas(json.datos)
            parcelas = json.datos;
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
function getMediciones(id){
    fetch("../api/v1.0/mediciones?id=" + id)
    .then(
        function (response){
            return response.json()
        }
    )
    .then(function (json) {
        mediciones = json.datos;
        pasarAPorcentaje();
    })
}

function pasarAPorcentaje(){
    let temperatura, humedad, salinidad, iluminacion, presion;
    mediciones.forEach(medicion => {
        temperatura = 100*0/(0-40)-medicion.temperatura*100/(0-40);
        humedad = 100*0/(0-100)-medicion.humedad*100/(0-100);
        salinidad = 100*0/(0-200)-medicion.salinidad*100/(0-200);
        iluminacion = 100*0/(2000-10000)-medicion.iluminacion*100/(2000-10000);
        presion = 100*0/(0-10000)-medicion.presion*100/(0-10000);
        porcentajes.push({"nombre":medicion.nombre, "id":medicion.id, "tiempo":medicion.tiempo, "temperatura":temperatura, "humedad":humedad, "salinidad":salinidad, "iluminacion":iluminacion, "presion":presion});
    });
}

function buscarParcela() {
    setTimeout(() => {
        var buscador = document.getElementById("buscador");
        filtrarParcelas(buscador.value);
    }, 10);
}

function crearListaParcelas(json) {
    var element = document.getElementById("parcelas");
    for (parcela of json) {
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
    var selector = document.getElementById("parcelas").childNodes;
    console.log(selector)
    selector.forEach(parcela => {
        if (!parcela.lastChild.innerText.includes(filtrado)) {
            parcela.hidden = true;
        } else {
            parcela.hidden = false;
        }
    });
}

function mostrarParcela(id) {
    mostrarOcultarPoligono(id);
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
                '<p><img src="images/temperature.svg" alt="Temperatura" width="30px" height="30px"></img>' + Math.floor(porcentaje.temperatura) + '%  <img src="images/sun.svg" alt="Iluminacion" width="30px" height="30px"></img>' + Math.floor(porcentaje.iluminacion) + '%  <img src="images/salt.svg" alt="Salinidad" width="30px" height="30px"></img>' + Math.floor(porcentaje.salinidad) + '%  <img src="images/water.svg" alt="Humedad" width="30px" height="30px"></img>' + Math.floor(porcentaje.humedad) + '%  <img src="images/preasure.svg" alt="Presion" width="30px" height="30px"></img>' + Math.floor(porcentaje.presion) + '%  <br></p>' +
                '<p> Ultima medida: '+ porcentaje.tiempo +'<br></p>' +
                '<p><a href="javascript:llenarGrafica(\'' + sonda.id + '\', \'' + parcela.nombre + '\')">' +
                '<button class="boton">Comparar</button></a> ' +
                '</div>' +
                '</div>';
            ponerPunto(new google.maps.LatLng(parseFloat(sonda.lat), parseFloat(sonda.lng)), contenido, id)
        }
    });
}

function mostrarGrafica(){
    var element = document.getElementById("grafica");
    if(element.style.display == "") element.style.display = "flex";
}

function esconderGrafica(){
    
    var element = document.getElementById("grafica");
    if(element.style.display == "flex") element.style.display = "";
}
