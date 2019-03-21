
var usuario;
var parcelas = [];
var puntos = [];

function crearListaParcelas(json, usuario){
  var element = document.getElementById("parcelas");
  console.log(json)
  for (parcela of json) {
      element.options[element.options.length] = new Option(parcela.nombre, parcela.id);}
}

function seleccionarParcela(json, sondas, id) {
  var parcela = document.getElementById("parcelas").value;
 // console.log(parcela + " , " + id)
  var lista = []
  var posiciones = []
  if (parcela != "null"){
    for (let i=0; i<json.length; i++){
//      console.log(i+": " + json[i].id_parcela)
      if (json[i].id_parcela == parcela){
        lista.push(json[i])
      }
    }
    vaciarMapa()
    dibujarParcela(lista)
    mostrarPosicionesMapa(posiciones)
  }
}

function dibujarParcela(json) {
var lista = []
var identificadores = []

for (let i=0; i<json.length; i++){
  if (i!=0){
    if (json[i-1].id_parcela != json[i].id_parcela){
      identificadores.push(json[i].id_parcela)
    }
  } else {
    identificadores.push(json[0].id_parcela)
  }
}

for (let i=0; i<identificadores.length; i++){
  lista = []
  for (let j=0; j<json.length; j++){
    if(json[j].id_parcela == identificadores[i]){
      lista.push(new google.maps.LatLng(parseFloat(json[j].lat),parseFloat(json[j].lng)))
    }
  }
  
  dibujarPoligono(lista)
}
 // });

}

function mostrarPosicionesMapa(json) {
  var lista = []
  for (posicion of json) {
    lista.push(new google.maps.LatLng(parseFloat(posicion.lat),parseFloat(posicion.lng)));
  }
  ponerPuntos(lista)
}
