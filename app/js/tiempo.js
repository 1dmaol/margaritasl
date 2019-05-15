//api para obtener el codigo de la ciudad perteneciente a las coordenadas
var appLocalizacion = {};
var latitud = "38.97";
var longitud = "-0.179";
var apiKey = "6oEFxmyxB4dtACKnUc2yf5azWHfPbEw0";
appLocalizacion.url = "http://dataservice.accuweather.com/locations/v1/cities/geoposition/search?apikey=" + apiKey + "&q=" + latitud + "%2C" + longitud + "&language=es";



appLocalizacion.cargaDatos = function () {
    $.ajax({
        url: appLocalizacion.url,
        success: function (data) {
            appLocalizacion.datos = data;
            appLocalizacion.procesaDatos();
        },
        error: function () {
            alert("algo va mal");
        }
    });
}
appLocalizacion.procesaDatos = function () {
    appLocalizacion.codigo = appLocalizacion.datos.Key;
    appLocalizacion.ciudad = appLocalizacion.datos.LocalizedName;
    appLocalizacion.comunidad = appLocalizacion.datos.AdministrativeArea.LocalizedName;
    appLocalizacion.muestra();

}
appLocalizacion.muestra = function () {
    appPrediccion.cargaDatos();
}

//---------------------------------------------
//---------------------------------------------
//---------------------------------------------
//---------------------------------------------

// el 306359 es el appLocalizaciin.codigo pero no logro que haya una forma de pasarselo ya que da error al pasarselo directamente
var appPrediccion = {};

appPrediccion.url =

    appPrediccion.cargaDatos = function () {
        console.log(appLocalizacion.codigo);
        $.ajax({
            url: "http://dataservice.accuweather.com/forecasts/v1/daily/5day/" + appLocalizacion.codigo + "?apikey=" +
                apiKey + "&language=es&metric=true",
            success: function (data) {
                appPrediccion.datos = data;
                appPrediccion.procesaDatos();
            },
            error: function () {
                alert("algo va mal 2");
            }
        });
    }
// se generan la temperatura máxima y mínima de cada día además, obtenemos el icono correspondiente a la situación climática
appPrediccion.procesaDatos = function () {
    appPrediccion.temperaturaMinDia1 = appPrediccion.datos.DailyForecasts[0].Temperature.Minimum.Value;
    appPrediccion.temperaturaMaxDia1 = appPrediccion.datos.DailyForecasts[0].Temperature.Maximum.Value;
    var condicionIcono = appPrediccion.datos.DailyForecasts[0].Day.Icon;
    appPrediccion.iconoDia1 = appPrediccion.obtenIcono(condicionIcono);
    appPrediccion.temperaturaMinDia2 = appPrediccion.datos.DailyForecasts[1].Temperature.Minimum.Value;
    appPrediccion.temperaturaMaxDia2 = appPrediccion.datos.DailyForecasts[1].Temperature.Maximum.Value;
    condicionIcono = appPrediccion.datos.DailyForecasts[1].Day.Icon;
    appPrediccion.iconoDia2 = appPrediccion.obtenIcono(condicionIcono);
    appPrediccion.temperaturaMinDia3 = appPrediccion.datos.DailyForecasts[2].Temperature.Minimum.Value;
    appPrediccion.temperaturaMaxDia3 = appPrediccion.datos.DailyForecasts[2].Temperature.Maximum.Value;
    condicionIcono = appPrediccion.datos.DailyForecasts[2].Day.Icon;
    appPrediccion.iconoDia3 = appPrediccion.obtenIcono(condicionIcono);
    appPrediccion.muestra();

}

//función utilizada para mostrar los datos en el html
appPrediccion.muestra = function () {
    if (document.getElementById("js_w_mmDia1"+extra).childElementCount != 0)
        vaciarTiempo();
    $('#js_w_mmDia1' + extra).append(appPrediccion.iconoDia1 + "<p>Hoy : <p class='minimo'> " + Math.floor(appPrediccion.temperaturaMinDia1) + "</p><p>/</p><p class='maximo'>" + Math.floor(appPrediccion.temperaturaMaxDia1) + "</p> <p>ºC</p></p>");
    $('#js_w_mmDia2' + extra).append(appPrediccion.iconoDia2 + "<p>Mañana : <p class='minimo'> " + Math.floor(appPrediccion.temperaturaMinDia2) + "</p><p>/</p><p class='maximo'>" + Math.floor(appPrediccion.temperaturaMaxDia2) + "</p> <p>ºC</p></p>");
    $('#js_w_mmDia3' + extra).append(appPrediccion.iconoDia3 + "<p>Pasado mañana : <p class='minimo'> " + Math.floor(appPrediccion.temperaturaMinDia3) + "</p><p>/</p><p class='maximo'>" + Math.floor(appPrediccion.temperaturaMaxDia3) + "</p> <p>ºC</p></p>");
    }

function vaciarTiempo() {
    for(let i=1; i<=3; i++){
        var e = document.getElementById("js_w_mmDia"+i+""+extra);
        console.log("js_w_mmDia"+i+""+extra);
        var child = e.lastElementChild;  
        while (child) { 
            e.removeChild(child); 
            child = e.lastElementChild; 
        } 
    }
}


// se devuelve  el icono solicitado en procesaDatos
appPrediccion.obtenIcono = function (weatherIcon) {

    var icon;
    switch (weatherIcon) {
        //cielo despejado
        case 1:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/01-s.png' class='wi'>";
            break;
        case 2:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/02-s.png' class='wi'>";
            break;
            //pocas nubes
        case 3:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/03-s.png' class='wi'>";
            break;
        case 4:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/04-s.png' class='wi'>";
            break;
            //nublado
        case 5:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/05-s.png' class='wi'>";
            break;
        case 6:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/06-s.png' class='wi'>";
            break;
            //nubes de lluvia
        case 7:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/07-s.png' class='wi'>";
            break;
        case 8:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/08-s.png' class='wi'>";
            break;
            //lluvia
        case 9:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/09-s.png' class='wi'>";
            break;

        case 10:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/10-s.png' class='wi'>";
            break;
            //parcialmente nublado pero con lluvia
        case 11:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/11-s.png' class='wi'>";
            break;
        case 12:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/12-s.png' class='wi'>";
            break;
            //tormenta
        case 13:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/13-s.png' class='wi'>";
            break;
        case 14:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/14-s.png' class='wi'>";
            break;
            //nieve
        case 15:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/15-s.png' class='wi'>";
            break;
        case 16:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/16-s.png' class='wi'>";
            break;
            //niebla
        case 17:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/17-s.png' class='wi'>";
            break;
        case 18:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/18-s.png' class='wi'>";
            break;
        case 19:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/19-s.png' class='wi'>";
            break;
        case 20:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/20-s.png' class='wi'>";
            break;
        case 21:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/21-s.png' class='wi'>";
            break;
        case 22:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/22-s.png' class='wi'>";
            break;
        case 23:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/23-s.png' class='wi'>";
            break;
        case 24:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/24-s.png' class='wi'>";
            break;
        case 25:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/25-s.png' class='wi'>";
            break;
        case 26:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/26-s.png' class='wi'>";
            break;
        case 27:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/27-s.png' class='wi'>";
            break;
        case 28:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/28-s.png' class='wi'>";
            break;
        case 29:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/29-s.png' class='wi'>";
            break;
        case 30:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/30-s.png' class='wi'>";
            break;
        case 31:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/31-s.png' class='wi'>";
            break;
        case 32:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/32-s.png' class='wi'>";
        case 33:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/33-s.png' class='wi'>";
            break;
        case 34:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/34-s.png' class='wi'>";
            break;
        case 35:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/35-s.png' class='wi'>";
            break;
        case 36:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/36-s.png' class='wi'>";
            break;
        case 37:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/37-s.png' class='wi'>";
            break;
        case 38:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/38-s.png' class='wi'>";
            break;
        case 39:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/39-s.png' class='wi'>";
            break;
        case 40:
            icon = " <img src = 'https://developer.accuweather.com/sites/default/files/40-s.png' class='wi'>";
            break;
        default:
            icon = " <img src = 'http://openweathermap.org/img/w/01d.png' class='wi'>";
            break;

    }

    return icon;
}
var appTiempoActual = {};
appTiempoActual.apikey = "5b3c09d60a42dc1abfe0d01a110a9f22";

appTiempoActual.cargaDatos = function () {
    $.ajax({
        url: "http://api.openweathermap.org/data/2.5/weather?lat=" + latitud + "&lon=" + longitud + "&APPID=" + appTiempoActual.apikey + "&units=metric&lang=es",
        success: function (data) {
            appTiempoActual.datos = data;
            appTiempoActual.procesaDatos();
        },
        error: function () {
            alert("algo va mal ");
        }
    });
}
appTiempoActual.procesaDatos = function () {
    appTiempoActual.temperatura = appTiempoActual.datos.main.temp;
    appTiempoActual.ciudad = appTiempoActual.datos.name;
    appTiempoActual.pais = appTiempoActual.datos.sys.country;
    appTiempoActual.muestra();

}
appTiempoActual.muestra = function () {
    document.getElementById("js_w_temp" + extra).innerHTML = Math.floor(appTiempoActual.temperatura) + "ºC - " + appTiempoActual.ciudad + ", " + appTiempoActual.pais;
}
