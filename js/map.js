var map;
var puntos = [];
var parcelas = [];

function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: {
      lat: 38.99414,
      lng: -0.1536891
    },
    zoom: 13,
    mapTypeId: google.maps.MapTypeId.HYBRID
  });
}


function ponerPuntos(puntos) {
  var limitesMapa = map.getBounds();

  for (var i = 0; i <= puntos.length - 1; i++) {
    var marca = new google.maps.Marker({
      position: puntos[i],
      map: map
    });
  }
  map.fitBounds(limitesMapa);
}

function vaciarMapa() {
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
}

function dibujarPoligono(vertices) {
  var poligono = new google.maps.Polygon({
    paths: vertices,
    map: map,
    strokeColor: '#FF0000',
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: '#FF0000',
    fillOpacity: 0.35,
    editable: true
  });

  poligono.addListener('mouseup', function() {
    parcelaChange();
  })
}
