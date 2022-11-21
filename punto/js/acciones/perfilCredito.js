$( "#credito" ).on( "click", function() {
  if ($( "input:checked" ).val()=='on') {
  	$('#perfilCredito').html('<div class="input-group col-md-12"><div class="input-group-addon"><i class="fa fa-money"></i></div><div class="input-group col-md-12"><input type="text" id="abono" onkeyup="format(this)" onchange="format(this)"  class="form-control" value="0" placeholder="Abonará" required="" ></div></div><div class="input-group col-md-12"><div class="input-group-addon"><i class="icon-calender"></i></div><div class="input-group col-md-12"><input type="text" id="fechaCobro"  class="form-control fechaFactura" placeholder="Fecha Cobro" readonly></div></div>');
  	
    jQuery('#fechaCobro').datepicker({
        autoclose: true,
        todayHighlight: true
      });
  }
  else{
  	$('#perfilCredito').html('');
  }

  
});