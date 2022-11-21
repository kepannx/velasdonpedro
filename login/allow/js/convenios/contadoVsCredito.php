<script>
var months = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

Morris.Area({
        element: 'ventasMesGrafica',
        data: [{
            period: '2010-01',
            contado: 81,
            credito: 80,
        }, {
            period: '2010-02',
            contado: 130,
            credito: 100,
        }, {
            period: '2010-03',
            contado: 80,
            credito: 60,
        }, {
            period: '2010-04',
            contado: 70,
            credito: 200,
        }, {
            period: '2010-05',
            contado: 180,
            credito: 150,
        }, {
            period: '2010-06',
            contado: 105,
            credito: 100,
        },
         {
            period: '2010-07',
            contado: 250,
            credito: 150,
        }],
        xkey: 'period',
        ykeys: ['contado', 'credito'],
        labels: ['Contado', 'Crédito'],
        xLabelFormat: function(x) { // <--- x.getMonth() Retorno el mes en el index
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
</script>