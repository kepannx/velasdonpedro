<script>

var i=$('table tr').length;
$(".addmore").on('click',function(){
	html = '<tr>';
	html += '<td><input class="case" st type="checkbox"/><input type="hidden" data-type="productCode"  name="itemNo[]" id="itemNo_'+i+'" class="form-control autocomplete_txt" autocomplete="off"></td>';

	html +='<td><input type="text" data-type="skuProducto" name="sku[]" id="sku_'+i+'" class="form-control autocomplete_txt" autocomplete="off" required data-error="Al menos necesito un producto" placeholder="Código Producto"><div class="help-block with-errors"></div></td>';


	html += '<td><input type="text" data-type="productName" name="itemName[]" id="itemName_'+i+'" class="form-control autocomplete_txt changesNo" autocomplete="off" required data-error="Al menos necesito un producto" placeholder="Escribe el producto"><div class="help-block with-errors"></div></td>';



	html += '<td><input type="text" name="price[]" id="price_'+i+'" class="special changesNo"   autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';



	html += '<td><input type="text" name="quantity[]" id="quantity_'+i+'" min="0" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';

	html += '<td><input type="text" name="impuesto[]" id="impuesto_'+i+'" min="0" class="form-control changesNo" autocomplete="off " onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';

	html += '<td><input type="text" name="imei[]" id="imei_'+i+'"  class="form-control"  ondrop="return false;" onpaste="return false;" placeholder="Imei Celular"></td>';


	html += '<td><input type="text" name="total[]" id="total_'+i+'" class="special totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" readonly onpaste="return false;"></td>';



	html += '</tr>';
	$('table').append(html);
	i++;
});

//to check all checkboxes
$(document).on('change','#check_all',function(){
	$('input[class=case]:checkbox').prop("checked", $(this).is(':checked'));
});

//deletes the selected table rows
$(".delete").on('click', function() {
	$('.case:checkbox:checked').parents("tr").remove();
	$('#check_all').prop("checked", false); 
	calculateTotal();
});

<?php 
	$variable= $consultaComun->jsonProductos();

?>
var prices = [<?php echo ''.$variable.''; ?>]

//autocomplete script
$(document).on('focus','.autocomplete_txt',function(){
	type = $(this).data('type');
	
	if(type =='productCode' )autoTypeNo=0;
	if(type =='skuProducto' )autoTypeNo=1;
	if(type =='productName' )autoTypeNo=2; 	
	
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
             //call the filter here
             response($.ui.autocomplete.filter(array, request.term));
		},
		autoFocus: true,	      	
		minLength: 2,
		select: function( event, ui ) {
			var names = ui.item.data.split("|");						
			id_arr = $(this).attr('id');
	  		id = id_arr.split("_");
			$('#itemNo_'+id[1]).val(names[0]);
			$('#sku_'+id[1]).val(names[1]);
			$('#itemName_'+id[1]).val(names[2]);
			$('#quantity_'+id[1]).val(1);
			$('#impuesto_'+id[1]).val(names[4]);
			$('#price_'+id[1]).val(names[3]);
			$('#total_'+id[1]).val(1*((parseInt(names[3])*parseFloat((names[3])))/100)+parseInt(names[4]));
			valorNeto=parseFloat(names[4])*parseFloat(names[3])/100;
			impuesto=parseFloat(names[4]);
			valorProducto=parseFloat(names[3]);

			$('#total_'+id[1]).val(((valorNeto*impuesto)/100)+valorProducto);

			calculateTotal();
		}		      	
	});
});

//price change
$(document).on('change keyup blur','.changesNo',function(){
	id_arr = $(this).attr('id');
	id = id_arr.split("_");
	quantity = $('#quantity_'+id[1]).val();
	price = $('#price_'+id[1]).val();
	impuesto = $('#impuesto_'+id[1]).val();

	if( quantity!='' && price !='' ) $('#total_'+id[1]).val(1*((parseFloat(price)*parseFloat(quantity)*parseFloat(impuesto))/100)+(parseFloat(price))*quantity);



	calculateTotal();
});

$(document).on('change keyup blur','#impuesto',function(){
	calculateTotal();
});

//total price calculation 
function calculateTotal(){
	valorNeto = 0 ; total = 0; 
	$('.totalLinePrice').each(function(){
		if($(this).val() != '' )valorNeto += parseFloat( $(this).val() );
	});

	impuesto = 0 ; totalImpuesto = 0; 
	$('.taxes').each(function(){
		if($(this).val() != '' )impuesto += parseFloat( $(this).val() );
	});

	//taxes


	$('#subTotal').val( valorNeto.toFixed(0) );
	impuesto = $('#impuesto').val();



	if(impuesto != '' && typeof(impuesto) != "undefined" ){
		totalImpuestos = valorNeto * ( parseFloat(impuesto) /100 );
		$('#totalImpuestos').val(totalImpuestos.toFixed(0));
		total = valorNeto + totalImpuestos;
	}else{
		//$('#taxAmount').val(0);
		$('#totalImpuestos').val(0);
		total = valorNeto;
	}
	console.log();


	$('#totalAftertax').val( total.toFixed(0) );
	calculateAmountDue();
}

$(document).on('change keyup blur','#amountPaid',function(){
	calculateAmountDue();
});

//due amount calculation
function calculateAmountDue(){
	amountPaid = $('#amountPaid').val();
	total = $('#totalAftertax').val();
	if(amountPaid != '' && typeof(amountPaid) != "undefined" ){
		amountDue = parseFloat(total) - parseFloat( amountPaid );
		$('.amountDue').val( amountDue.toFixed(0) );
	}else{
		total = formatNumber(parseFloat(total).toFixed(0));
		$('.amountDue').val( total);
	}
}


//It restrict the non-numbers
var specialKeys = new Array();
specialKeys.push(8,46); //Backspace
function IsNumeric(e) {
    var keyCode = e.which ? e.which : e.keyCode;
    console.log( keyCode );
    var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
    return ret;
}




var formatNumber = {
 separador: ".", // separador para los miles
 sepDecimal: ',', // separador para los decimales
 formatear:function (num){
 num +='';
 var splitStr = num.split('.');
 var splitLeft = splitStr[0];
 var splitRight = splitStr.length &gt; 1 ? this.sepDecimal + splitStr[1] : '';
 var regx = /(\d+)(\d{3})/;
 while (regx.test(splitLeft)) {
 splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
 }
 return this.simbol + splitLeft +splitRight;
 },
 new:function(num, simbol){
 this.simbol = simbol ||'';
 return this.formatear(num);
 }
}
</script>