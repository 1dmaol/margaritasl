var ctx = document.getElementById('myChart');

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
    mostrarGrafica();
    var lista = []
    var identificador;
    porcentajes.forEach(porcentaje => {
        if (porcentaje.id == id_sonda && porcentaje.nombre == nombre_parcela) {
            lista.push(porcentaje.temperatura, porcentaje.humedad, porcentaje.salinidad, porcentaje.iluminacion, porcentaje.presion)
            nombre = porcentaje.nombre;
        }
    });
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