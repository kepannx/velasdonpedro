var i=$('table tr').length;
$("#addItems").on('click',function(){
    html = '<tr>';
    html += '<td><input type="checkbox"  class="case"><input type="hidden" id="idProducto_'+i+'"  data-type="idProducto" value=""></td>';
    html += '<td><input type="text" id="sku_'+i+'"  class="form-control autocompletar skucode" data-type="sku" placeholder="SKU" autocomplete="off"></td>';
    html += '<td><input type="text" id="productoServicio_'+i+'" data-type="productoServicio" class="form-control autocompletarItem" placeholder="Qué Mas Llevará El Cliente" autocomplete="off"></td>';
    html += '<td><div class="input-group"><input type="text"  id="valorItem_'+i+'" value="" class="form-control changesNo valorBruto" min="0" ><span class="input-group-addon">DS<input type="checkbox" class="changesNo" id="porMayor_'+i+'" ></span></div></td>';
    html += '<td align="center"><h3> <div class="text text-danger" id="impuesto_'+i+'">0%</div></h3></div><input type="hidden" id="tax_'+i+'" class="impuestos" value="0"></td>';
    html += '<td><input type="number" id="cantidad_'+i+'" min="1" value="1" class="form-control changesNo cantidades"></td>';
    html += '<td align="center"><input class="subtotal inputNone"  id="subTotal_'+i+'"></td>';
    html += '</tr>';
    $('#tablaComun').append(html);
    i++;
});



//deletes the selected table rows
$("#borrarItems").on('click', function() {

    $('.case:checkbox:checked').parents("tr").remove();
   
    //calculateTotal();
});


//json
//var prices = ["S10_1678|1969 Harley Davidson Ultimate Chopper|48.81", "S10_1949|1952 Alpine Renault 1300|98.58"];    
function productos(){

    $.ajax({
        url: '../../data/ajax/acciones/productosServiciosJson.php',
        type: 'POST',
        dataType: 'JSON',
        data: {id: id.value},
    })
    .done(function(data) {
         return prices = data;
    })


 //   return prices = ["1|C-AS12|1969 Harley Davidson Ultimate Chopper|1000000|900000|10", "2|B-AS12|Mustang 76|100000|80000|20"];

}










//LISTAS               
$(document).on('focus','.autocompletar',function(){
    productos();
    type = $(this).data('type');
    if(type =='idProducto' )autoTypeNo=1;
    if(type =='sku' )autoTypeNo=1;
    if(type =='productoServicio' )autoTypeNo=1;
    $(this).autocomplete({
        source: function( request, response ) {  
             var array = $.map(prices, function (item) {
                 var code = item.split("|");
                 return {
                     label: code[autoTypeNo],
                     value: code[autoTypeNo],
                     data : item
                 }
             });
             //Llamo Al Filtro
             response($.ui.autocomplete.filter(array, request.term));
        },
        autoFocus: true,            
        minLength: 2,

        select: function( event, ui ) {
            productos();
            var names = ui.item.data.split("|");                        
            id_arr = $(this).attr('id');
            id = id_arr.split("_");
            $('#idProducto_'+id[1]).val(names[0]);
            $('#productoServicio_'+id[1]).val(names[2]).attr('readonly', true);;
            $('#valorItem_'+id[1]).val(names[3]).attr('readonly', true);
            $('#impuesto_'+id[1]).html(names[5]+' %');
            
            cantidad = $('#cantidad_'+id[1]).val();
            impuesto = names[5];
            valor = names[3];
            valorIva= (valor*cantidad)*impuesto/100;
            $('#tax_'+id[1]).val(valorIva);
            subtotal =  (1*((parseFloat(valor)*parseFloat(cantidad)*parseFloat(impuesto))/100)+(parseFloat(valor))*cantidad)
            $('#subTotal_'+id[1]).val(subtotal);


            $( "#porMayor_"+id[1]).on( "click", function() {
                productos();
                if ($('[id=porMayor_'+id[1]+']')[0].checked===true) {
                    $('#valorItem_'+id[1]).val(names[4]).attr('readonly', true);
                    valor = names[4];
                    valorIva= (valor*cantidad)*impuesto/100;
                    $('#tax_'+id[1]).val(valorIva);
                     subtotal =  (1*((parseFloat(valor)*parseFloat(cantidad)*parseFloat(impuesto))/100)+(parseFloat(valor))*cantidad)
                    $('#subTotal_'+id[1]).val(subtotal);
                    calcular();
                }
                else{
                    $('#valorItem_'+id[1]).val(names[3]).attr('readonly', true);
                    valor = names[3];
                    valorIva= (valor*cantidad)*impuesto/100;
                    $('#tax_'+id[1]).val(valorIva);
                    subtotal =  (1*((parseFloat(valor)*parseFloat(cantidad)*parseFloat(impuesto))/100)+(parseFloat(valor))*cantidad)
                    $('#subTotal_'+id[1]).val(subtotal);
                    calcular();
                }  
            });

            calcular();


        }
    });
});     


$(document).on('focus','.autocompletarItem',function(){
    productos();
    type = $(this).data('type');
    if(type =='idProducto' )autoTypeNo=1;
    if(type =='productoServicio' )autoTypeNo=2;
    $(this).autocomplete({
        source: function( request, response ) {  
             var array = $.map(prices, function (item) {
                 var code = item.split("|");
                 return {
                     label: code[autoTypeNo],
                     value: code[autoTypeNo],
                     data : item
                 }
             });

             //Llamo Al Filtro
             response($.ui.autocomplete.filter(array, request.term));
        },
        autoFocus: true,            
        minLength: 2,

        select: function( event, ui ) {
            var names = ui.item.data.split("|");                        
            id_arr = $(this).attr('id');
            id = id_arr.split("_");
            $('#idProducto_'+id[1]).val(names[0]);
            $('#sku_'+id[1]).val(names[1]).attr('readonly', true);
            $('#valorItem_'+id[1]).val(names[3]).attr('readonly', true);
            $('#impuesto_'+id[1]).html(names[5]+' %');
            $('#tax_'+id[1]).val(names[5]);
            cantidad = $('#cantidad_'+id[1]).val();
            impuesto = names[5];
            valor = names[3];
            valorIva= (valor*cantidad)*impuesto/100;
            $('#tax_'+id[1]).val(valorIva);
            subtotal =  (1*((parseFloat(valor)*parseFloat(cantidad)*parseFloat(impuesto))/100)+(parseFloat(valor))*cantidad)
           $('#subTotal_'+id[1]).val(subtotal);
            $( "#porMayor_"+id[1]).on( "click", function() {
                productos();
                if ($('[id=porMayor_'+id[1]+']')[0].checked===true) {
                    $('#valorItem_'+id[1]).val(names[4]).attr('readonly', true);
                    valor = names[4];
                    valorIva= (valor*cantidad)*impuesto/100;
                    $('#tax_'+id[1]).val(valorIva);
                    subtotal =  (1*((parseFloat(valor)*parseFloat(cantidad)*parseFloat(impuesto))/100)+(parseFloat(valor))*cantidad)
                    $('#subTotal_'+id[1]).val(subtotal);
                    calcular();
                }
                else{
                    $('#valorItem_'+id[1]).val(names[3]).attr('readonly', true);
                    valor = names[3];
                    valorIva= (valor*cantidad)*impuesto/100;
                    $('#tax_'+id[1]).val(valorIva);
                    subtotal =  (1*((parseFloat(valor)*parseFloat(cantidad)*parseFloat(impuesto))/100)+(parseFloat(valor))*cantidad)
                    $('#subTotal_'+id[1]).val(subtotal);
                    calcular();
                }  

            });
            calcular();
        }
    });
});



/*----------  CONTROL DE VALORES  ----------*/


//control de precios por item
$(document).on('change keyup blur','.changesNo',function(){
    if (impuesto == undefined) {
        impuesto=0;
    }
    id_arr = $(this).attr('id');
    id = id_arr.split("_");
    cantidad = $('#cantidad_'+id[1]).val();
    valor = $('#valorItem_'+id[1]).val();
    //subtotal = ((cantidad*valor));
    
    if( cantidad!='' && valor !='' ){
      subtotal =  (1*((parseFloat(valor)*parseFloat(cantidad)*parseFloat(impuesto))/100)+(parseFloat(valor))*cantidad)
    }
    valorIva= (valor*cantidad)*impuesto/100;
    $('#tax_'+id[1]).val(valorIva);
    $('#subTotal_'+id[1]).val(subtotal);
    //calculateTotal();
    calcular();
});



//Calculo todos los valores que hay en el final de la factura o remisión
function calcular(){

        valorFinal =0;
        valorBruto=0;
        valorImpuestos =0;

        //Calculo El Valor Del Iva

    //Resuelvo Valores Globales Brutos
    $('.subtotal').each(function(){
        if($(this).val() != '' )valorFinal += parseFloat( $(this).val() );

    });
    //Fin de Valores Globales Brutos
    valorBruto =valorFinal;
    $('#totalGlobal').html(format(valorFinal));


    //Resuelvo Impuestos globales
    $('.impuestos').each(function(){
        if ($(this).val() != '') {
            valorImpuestos += parseFloat($(this).val());
        };
    });

    $("#taxGlobal").html(format(valorImpuestos));

    //Fin de resolución impuestos globales
    subTotal= valorFinal-valorImpuestos;
    $('#subTotalGlobal').html(format(subTotal));



    //Calculo el valor neto
  
    //subtotal= valorFinal-totalImpuestos;
    //$('#subTotalGlobal').html(subtotal);

function format(input)
{

var num = input;

num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
num = num.split('').reverse().join('').replace(/^[\.]/,'');
return num;


}





}

