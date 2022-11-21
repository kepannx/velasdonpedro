

// Dashboard 1 Morris-chart
var months = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

Morris.Area({
        element: 'ventasMesGrafica',
        data: [{
            period: '2010-01',
            iphone: 50,
            ipad: 80,
            itouch: 20
        }, {
            period: '2010-02',
            iphone: 130,
            ipad: 100,
            itouch: 80
        }, {
            period: '2010-03',
            iphone: 80,
            ipad: 60,
            itouch: 70
        }, {
            period: '2010-04',
            iphone: 70,
            ipad: 200,
            itouch: 140
        }, {
            period: '2010-05',
            iphone: 180,
            ipad: 150,
            itouch: 140
        }, {
            period: '2010-06',
            iphone: 105,
            ipad: 100,
            itouch: 80
        },
         {
            period: '2010-07',
            iphone: 250,
            ipad: 150,
            itouch: 200
        }],
        xkey: 'period',
        ykeys: ['iphone', 'ipad', 'itouch'],
        labels: ['iPhone', 'iPad', 'iPod Touch'],
        xLabelFormat: function(x) { // <--- x.getMonth() returns valid index
    var month = months[x.getMonth()];
    return month;
  },
   dateFormat: function(x) {
    var month = months[new Date(x).getMonth()];
    return month;
  },
        pointSize: 3,
        fillOpacity: 0,
        pointStrokeColors:['#00bfc7', '#fb9678', '#9675ce'],
        behaveLikeLine: true,
        gridLineColor: '#e0e0e0',
        lineWidth: 3,
        hideHover: 'auto',
        lineColors: ['#00bfc7', '#fb9678', '#9675ce'],
        resize: true

        
    });
