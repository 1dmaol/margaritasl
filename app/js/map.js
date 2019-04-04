var map;
var puntos = [];
var poligonos = [];
var idPoligonos = []

function initMap() {
    map = new google
        .maps
        .Map(document.getElementById('map'), {
            center: {
                lat: 38.99414,
                lng: -0.1536891
            },
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.HYBRID
        });
}

function ponerPunto(posicion, contenido, id) {
        var marca = new google
            .maps
            .Marker({
                position: posicion,
                map: map,
                id: id,
                animation: google.maps.Animation.DROP,
                clickable: true});

                marca.info = new google.maps.InfoWindow({
                  content: contenido
                });
                
        google
            .maps
            .event
            .addListener(marca,'click', function () {
                var marker_map = this.getMap();
                this.info.open(marker_map, this);
            });
        puntos.push(marca)
}

function vaciarMapa() {
    poligonos.forEach(poligono => {
        poligono.setMap(null)
    });

    puntos.forEach(punto => {
        punto.setMap(null)
    })

    /*
  map = new google.maps.Map(document.getElementById('map'), {
    center: {
      lat: 38.99414,
      lng: -0.1536891
    },
    zoom: 13,
    mapTypeId: google.maps.MapTypeId.HYBRID
  });
  parcelas = []
  puntos = []
  */
}

function mostrarOcultarPoligono(parcela) {
    poligonos.forEach(poligono => {
        if (poligono.id == parcela) {
            //poligono.setMap(null);
            if (poligono.getMap() == null) {
                poligono.setMap(map);
            } else {
                poligono.setMap(null);
            }
        }
    });
    puntos.forEach(punto => {
        if (punto.id == parcela) {
            //poligono.setMap(null);
            if (punto.getMap() == null) {
                punto.setMap(map);
            } else {
                punto.setMap(null);
            }
        }
    })
}

function dibujarPoligono(vertices, color, parcela) {

    var poligono = new google
        .maps
        .Polygon({
            paths: vertices,
            map: map,
            strokeColor: color,
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: color,
            fillOpacity: 0.35,
            editable: false,
            id: parcela
        });

    poligono.addListener('mouseup', function () {
        vaciarMapa();
        var selector = document
            .getElementById("parcelas")
            .childNodes;

        selector.forEach(element => {
            if (element.firstChild.value == parcela) {
                element.firstChild.checked = true;
            } else {
                element.firstChild.checked = false;
            }
        });
        mostrarOcultarPoligono(parcela);
    })

    poligonos.push(poligono)
}