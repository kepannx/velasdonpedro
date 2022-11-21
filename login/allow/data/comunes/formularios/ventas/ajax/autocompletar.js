var ajax = new sack();
	var currentClientID=false;
	var codebar=false;
	

	function getClientData()
	{
		var clientId = document.getElementById('nombresApellidos').value.replace("%",'');
		if(clientId!=currentClientID){
			currentClientID = clientId
			ajax.requestFile = 'ajax/loadDatosCliente.php?idCliente='+clientId;	// Specifying which file to get
			ajax.onCompletion = showClientData;	// Specify function that will be executed after file has been found
			ajax.runAJAX();		// Execute AJAX function			
		}
		
	}




	
	function showClientData()
	{
		var formObj = document.forms['clientForm'];	
		eval(ajax.response);
	}
	
	
	function initFormEvents()
	{
		document.getElementById('nombresApellidos').onblur = getClientData;
		document.getElementById('nombresApellidos').focus();


	}
	



	
	window.onload = initFormEvents;