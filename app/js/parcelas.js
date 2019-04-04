var usuario;
var parcelas = [];
var vertices = [];
var sondas = [];
var selector = [];
var all = true;

function getParcelas(id) {
    fetch("http://localhost/margaritafinal/api/v1.0/parcelas?usuario=" + id)
        .then(
            function (response) {
                return response.json()
            }
        )
        .then(function (json) {
            crearListaParcelas(json.datos)
            parcelas = json.datos;
        })
}

function getVertices(id) {
    fetch("http://localhost/margaritafinal/api/v1.0/vertices?usuario=" + id)
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
    fetch("http://localhost/margaritafinal/api/v1.0/sondas?usuario=" + id)
        .then(
            function (response) {
                return response.json()
            }
        )
        .then(function (json) {
            sondas = json.datos;
        })
}

function buscarParcela() {
    setTimeout(() => {
        var buscador = document.getElementById("buscador");
        filtrarParcelas(buscador.value);
    }, 10);
}

function crearListaParcelas(json) {
    console.log(json)
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
            var contenido = '<div id="content">' + '<h4>Sensor ' + sonda.id + ' </h4>' +
                '<div id="bodyContent">' +
                '<p><b>Mediciones</b> tomadas de los sensores de la parcela ' + id + '</p>' +
                '<p><a href="https://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">' +
                'Informacion avanzada</a> ' +
                '</div>' +
                '</div>';
            ponerPunto(new google.maps.LatLng(parseFloat(sonda.lat), parseFloat(sonda.lng)), contenido, id)
        }
    });
}