$(document).ready(function() { 
	var options = { 
			target:   '#output',   // target element(s)  
			beforeSubmit:  beforeSubmit,  // pre-submit callback 
			success:       afterSuccess,  // post-submit callback 
			uploadProgress: OnProgress, //upload progress callback 
			resetForm: true        // reseteo  form despues que cargue con exito 
		}; 
		
	 $('#MyUploadForm').submit(function() { 
			$(this).ajaxSubmit(options);  
					
			// Retorno siempre falso para evitar re-recargas 
			return false; 
		}); 
		

//function despues de subir el archivo (cuando el server responde)
function afterSuccess()
{
	$('#submit-btn').show(); //hide submit button
	$('#loading-img').hide(); //hide submit button
	$('#progressbox').delay( 1000 ).fadeOut(); //hide progress bar

}

//function para chequear el tamaño del archivo antes de subirlo
function beforeSubmit(){
    
   if (window.File && window.FileReader && window.FileList && window.Blob)
	{
		
		if( !$('#logo').val()) //Chequeo que el archivo que pasaré no esté vacio
		{
			swal("Ops!", "No puedo subir nada si no seleccionas nada, aun no leo mentes ", "error");
			return false
		}
		
		var fsize = $('#logo')[0].files[0].size; //get El tamaño del archivo
		var ftype = $('#logo')[0].files[0].type; // get el tipo del archivo
		

		//Archivos Que permito
		switch(ftype)
        {
            case 'image/png': 
			case 'image/gif': 
			case 'image/jpeg': 
			case 'image/pjpeg':
			
                break;
            default:
                swal("Ops!", "El tipo de archivo que cargaste no lo soporto, necesito que lo cambies si lo quieres subir ", "error");
				return false
        }
		
		//Permito archivos menores a 5 MB (1048576)
		if(fsize>1024000) 
		{
			swal("Ops!", "El archivo pesa mas de 1 Mega, Es muy grande y no te lo puedo cargar, intenta comprimirlo ", "error");
			return false
		}
				
		$('#submit-btn').hide(); //hide submit button
		$('#loading-img').show(); //hide submit button
		$("#output").html("");
		$('#mensaje').hide(3000);

	}
	else
	{
		//si el navegador es muy viejo como para cargar HTML5 File API
		swal("Oye!!", "Este navegador es muy viejo, por tu seguridas y de paso para que yo funcione mejor actualizalo, intenta bajar chrome o mozilla", "error");
		return false;
	}
}

//progress bar function
function OnProgress(event, position, total, percentComplete)
{
    //Progress bar
	$('#progress-bar').show();
    $('#progress-bar').width(percentComplete + '%') //update progressbar porcentaje completo
    $('#statustxt').html(percentComplete + '%'); //update status text
    if(percentComplete>50)
        {
            $('#statustxt').css('color','#000'); //cambiar status text despues del  50%
        }
}

//function to format bites bit.ly/19yoIPO
function bytesToSize(bytes) {
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
   if (bytes == 0) return '0 Bytes';
   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}

}); 