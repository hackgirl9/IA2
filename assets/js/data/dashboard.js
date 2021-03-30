var ventasChart = document.querySelector("#ventas");
var gananciasChart = document.querySelector("#ganancias");

var url = localStorage.getItem('url');

$('document').ready(function () {

    $.ajax({
        method: "GET",
        url: url + 'Home/ingreso',
        dataType: 'json',

        beforeSend: function () {
            console.log('hola2');
        },
        success: function (data) {
            console.log('hola3');
            console.log(data);
                estadistica(data);
        },
        error: function (e) {
            console.log('hola4');
            console.log(e);

        }


    });
});

function estadistica(data){

var ventas = new Chart(ventasChart, {
    type: "line", // Tipo de chart
    data: { // Incluye lo referente a datos
        "labels": [ // Etiquetas para la leyenda
            "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"
        ],
        "datasets": [{ // Sets de datos que tendra la chart
            "label": "Ventas",
            "data": [data ["enero"]       [0]['ventas'],
                     data ["febrero"]     [0]['ventas'],
                     data ["marzo"]       [0]['ventas'],
                     data ["abril"]       [0]['ventas'],
                     data ["mayo"]        [0]['ventas'],
                     data ["junio"]       [0]['ventas'],
                     data ["julio"]       [0]['ventas'],
                     data ["agosto"]      [0]['ventas'],
                     data ["septiembre"]  [0]['ventas'],
                     data ["octubre"]     [0]['ventas'],
                     data ["noviembre"]   [0]['ventas'],
                     data ["diciembre"]   [0]['ventas'],],
            "fill": false,
            "borderColor": "rgb(75, 192, 192)",
            "lineTension": 0.1
        }]
    },
    options: {
        title: {
            display: true,
            text: "Ventas anuales",
            fontSize: 25
        },
        legend: {
            position: 'bottom'
        }
    }
});

}


var ganancias = new Chart(gananciasChart, {
    type: "pie",
    data: {
        "labels": ["Enero", "Febrero", "Marzo", "Abril"],
        "datasets": [{
            "label": "Ganancias",
            "data": [430, 20, 55, 70],
            "backgroundColor": [
                "#e91e63",
                "#9c27b0",
                "#4caf50",
                "#03a9f4"
            ]
        }]
    },
    options: {
        title: {
            display: true,
            text: "Ganancias anuales",
            fontSize: 25
        },
        legend: {
            position: "bottom"
        }
    }
});


$(document).ready(function() {
     $('.timer').countTo({
         speed: 2000
     });
});

