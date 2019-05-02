function isMobileDevice() {    
    if( navigator.userAgent.match(/Android/i)
    || navigator.userAgent.match(/webOS/i)
    || navigator.userAgent.match(/iPhone/i)
    || navigator.userAgent.match(/iPad/i)
    || navigator.userAgent.match(/iPod/i)
    || navigator.userAgent.match(/BlackBerry/i)
    || navigator.userAgent.match(/Windows Phone/i))
   return true;
   return false;
};

if(!isMobileDevice()){
    console.log("pc")
    var ctx = document.getElementById('myChart');
    var extra = ""
} else {
    console.log("mobile")
    var ctx = document.getElementById('myChartR');
    var extra = "-responsive"
}

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {

    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    max: 100
                }
            }]
        }


    }
});

function random_rgba() {
    var o = Math.round,
        r = Math.random,
        s = 255;
    return 'rgba(' + o(r() * s) + ',' + o(r() * s) + ',' + o(r() * s) + ',';
}

var datos = [];

function llenarGrafica(id_sonda, nombre_parcela) {
    if (extra != "-responsive"){
        if(document.getElementById("grafica").style.display == "") mostrarGrafica(extra);}
    else {
        if(document.getElementById("grafica-responsive").style.display == "") mostrarGrafica(extra);
    }

    document.getElementById("contenedor-tiempo").style.visibility = "visible";


    var lista = []
    var identificador;
    porcentajes.forEach(porcentaje => {
        if (porcentaje.id == id_sonda && porcentaje.nombre == nombre_parcela) {
            lista.push(porcentaje.temperatura, porcentaje.humedad, porcentaje.salinidad, porcentaje.iluminacion, porcentaje.presion)
            nombre = porcentaje.nombre;
        }
    });
    sondas.forEach(sonda => {
        if (sonda.id == id_sonda){
            latitud = sonda.lat;
            longitud = sonda.lng;
        }
    });
    appLocalizacion.cargaDatos();
    appTiempoActual.cargaDatos();
    identificador = "Sonda " + id_sonda + " (" + nombre_parcela + ")";
    var myNewDataset = {
        label: identificador,
        data: lista,
    }
    if (!datos.includes(identificador)) {
        var colorAl = random_rgba();
        var backgroundAl = colorAl + 0.5 + ')';
        var borderAl = colorAl + 1 + ')';

        myNewDataset.borderWidth = 1;
        myNewDataset.borderColor = borderAl;
        myNewDataset.backgroundColor = backgroundAl;

        var labels = ['Temperatura', 'Humedad', 'Salinidad', 'Iluminación', 'Presión'];
        myChart.options.title.text = "Parcela";
        myChart.data.labels = labels;
        myChart.data.datasets.push(myNewDataset)
        myChart.update();
        datos.push(identificador);

    aumentarContador(id_sonda, nombre_parcela);
    }else{
        alert("Los datos de la sonda ya se muestran en la gráfica.");
    }
}

function vaciarGrafica() {
    datos = [];
    myChart.data.labels = [];
    myChart.data.datasets = [];
    myChart.update();
}