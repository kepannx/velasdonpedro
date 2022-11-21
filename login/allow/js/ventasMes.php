<script>
var months = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

Morris.Area({
        element: 'ventasMesGrafica',
        data: [{
            period: '2010-01',
            mensualidad: 50,
            Trimestral: 80,
            Tiquetera: 20
        }, {
            period: '2010-02',
            mensualidad: 130,
            Trimestral: 100,
            Tiquetera: 80
        }, {
            period: '2010-03',
            mensualidad: 80,
            Trimestral: 60,
            Tiquetera: 70
        }, {
            period: '2010-04',
            mensualidad: 70,
            Trimestral: 200,
            Tiquetera: 140
        }, {
            period: '2010-05',
            mensualidad: 180,
            Trimestral: 150,
            Tiquetera: 140
        }, {
            period: '2010-06',
            mensualidad: 105,
            Trimestral: 100,
            Tiquetera: 80
        },
         {
            period: '2010-07',
            mensualidad: 250,
            Trimestral: 150,
            Tiquetera: 200
        }],
        xkey: 'period',
        ykeys: ['mensualidad', 'Trimestral', 'Tiquetera'],
        labels: ['Mensualidad', 'Trimestral', 'Tiquetera'],
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