document.getElementById('identificacionCliente').addEventListener('change', function(){
	if (identificacionCliente.value.length>1) {
	$.ajax({
        url: '../../data/ajax/acciones/checkDatosRegistroClientes.php',
        type: 'POST',
        dataType: 'JSON',
        data: {id: ''+id.value+'', identificacionCliente: ''+identificacionCliente.value+''},
    })
    .done(function(data) {

    	if(data.idcliente.length != undefined){
    			$("#nombreCliente").val(data.nombreCliente).prop("readonly",true);
    			$("#direccion").val(data.direccionCliente).prop("readonly",true);
    			$("#emailCliente").val(data.emailCliente).prop("readonly",true);
    			$("#telefonosCliente").val(data.telefonosCliente).prop("readonly",true);
    			$("#ciudadCliente option[value="+data.ciudadCliente+"]").attr('selected','selected');
    			$("#ciudadCliente").attr('readonly','readonly');
    			$("#deptoCliente option[value="+data.deptoCliente+"]").attr('selected','selected');
    			$("#deptoCliente").attr('readonly','readonly');
    			//regimenCliente
    			$("#regimenCliente option[value='"+data.regimenCliente+"']").attr({
    				selected: 'selected',
    				readonly: true
    			});
    			$("#idCliente").val(data.idcliente);
                nombre = data.nombreCliente.split(" ");

               $("#elcliente").html(" a "+nombre[0]);


    	}
    	else
    	{
    		$("#nombreCliente").val(data.nombreCliente).prop("readonly",false);
    		$("#emailCliente").val(data.emailCliente).prop("readonly",false);
    		$("#ciudadCliente option[value=Envidado]").attr('selected','selected');
    		$("#deptoCliente option[value=Antioquia]").attr('selected','selected');
    		$("#deptoCliente").attr('readonly',false );
    		$("#ciudadCliente").attr('readonly',false );
    		$("#telefonosCliente").val(data.telefonosCliente).prop("readonly",false);
    		$("#regimenCliente option[value='persona natural']").attr({
    				selected: 'selected',
    			});
    		$("#idCliente").val(0);
            $("#elcliente").html("Al Cliente ");
    	}
    });
   };
   });
