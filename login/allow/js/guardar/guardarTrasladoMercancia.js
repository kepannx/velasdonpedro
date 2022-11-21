
function guardarTraslado()
{

     skus=[];
     idProductoServicios=[];
     unidades = [];
     bucketSerials = [];

     if (($('[id=sku_]').length)>0) {
            for (var i = $('[id=sku_]').length - 1; i >= 0; i--) {
                skus.push(limpiadorCaracteres($('[id=sku_]')[i].value));
            };

          };
    if (($('[id=idproductosServicios_]').length)>0) {
            for (var i = $('[id=idproductosServicios_]').length - 1; i >= 0; i--) {
                idProductoServicios.push(limpiadorCaracteres($('[id=idproductosServicios_]')[i].value));
            };
          };


    if (($('[id=unidades]').length)>0) {
            for (var i = $('[id=unidades]').length - 1; i >= 0; i--) {
                unidades.push(limpiadorCaracteres($('[id=unidades]')[i].value));
            };
          };


   

    if (($('[id=imeisandserials]').length)>0) {
            //console.log($('[id=imeisandserials]').length);
            for (var i = $('[id=imeisandserials]').length -  1; i >= 0; i--) {
               // console.log("Imei: "+ $('[id=imeisandserials]')[i].value + " "+);
                bucketSerials.push('%'+($('[id=imeisandserials]')[i].value)+"|"+limpiadorCaracteres($('[id=idproductosServicios_]')[i].value));
            };
          };




$.ajax({
            url: '../../data/ajax/insercionDatos/guardarTraslado.php',
            type: 'POST',
            dataType: 'JSON',
            data: { 
                    destinoId: ""+limpiadorCaracteres(destinoId.value)+"", 
                    origenId: ""+limpiadorCaracteres(origenId.value)+"",  
                    id : ""+id.value+"",
                    skus : ""+skus+"",
                    idProductoServicios : ""+idProductoServicios+"",
                    unidades : ""+unidades+"",
                    bucketSerials:  ""+bucketSerials+"",
                   
            },                                    
        })
        .done(function(data) { 
            

            console.log(destinoId.value+' '+origenId.value+' '+skus+' '+idProductoServicios+' '+unidades+' '+bucketSerials );
          

        swal({
            title: "listo! ",
            text: "Ya Guarde Estos Productos En El Inventario de la tienda",
            timer: 2000,  
            type: "success"
        });
            })
        .fail(function() {
            swal("Error", "Ops! ocurrió un error inesperado! intentalo de nuevo", "error");
        })
        .always(function() {
            //clear
            
            $('#listadoProductos').html("");
            $('#sku').val('');
            $('#cantidades').val('');
            $('#volumenesSeriales').html('');
            $('#saveTraslado').css('display', 'none');
            $('#destinoId option:eq(0)').attr('selected', 'selected');
       
        });
}



document.getElementById('saveTraslado').addEventListener('click', function(){
        guardarTraslado();
    /*
        if(validarDatosInventatio()==true){
		  guardarPuntosVenta();
		};
        */
  });
