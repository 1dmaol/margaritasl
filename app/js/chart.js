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
        },
        animation: {
            duration: 1,
            onComplete: function () {
                var chartInstance = this.chart,
                    ctx = chartInstance.ctx;
                ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                ctx.textAlign = 'center';
                ctx.textBaseline = 'bottom';

                this.data.datasets.forEach(function (dataset, i) {
                    var meta = chartInstance.controller.getDatasetMeta(i);
                    meta.data.forEach(function (bar, index) {
                        var data = dataset.data[index];
                        ctx.fillText(data, bar._model.x, bar._model.y - 5);
                    });
                });
            }
        }

    }
});

function random_rgba() {
    var o = Math.round,
        r = Math.random,
        s = 255;
    return 'rgba(' + o(r() * s) + ',' + o(r() * s) + ',' + o(r() * s) + ',';
}

function llenarDiagrama(id) {
    var lista = []
    mediciones.forEach(medicion => {
        console.log(medicion)
        if (medicion.id == id) lista.push(medicion.temperatura, medicion.humedad, medicion.salinidad, medicion.iluminacion, medicion.presion)
    });
    console.log(lista)
    var colorAl = random_rgba();
    var backgroundAl = colorAl + 0.5 + ')';
    var borderAl = colorAl + 1 + ')';

    var myNewDataset = {
        label: "Sonda (Numero)",
        data: lista,
        borderWidth: 1,
        borderColor: borderAl,
        backgroundColor: backgroundAl
    }


    var labels = ['Temperatura', 'Humedad', 'Salinidad', 'Iluminación', 'Presión'];
    myChart.options.title.text = "Parcela";
    myChart.data.labels = labels;
    myChart.data.datasets.push(myNewDataset)
    myChart.update();

}