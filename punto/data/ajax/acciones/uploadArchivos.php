<?php
require_once '../../libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador($_SESSION['datos']);

if(isset($_FILES["FileInput"]) && $_FILES["FileInput"]["error"]== UPLOAD_ERR_OK)
{

	$UploadDirectory	= '../../../modulos/uploads/archivosPuntoVenta/';
	##########################################
	
	
	
	//check if this is an ajax request
	if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
		die();
	}
	
	
	//Is file size is less than allowed size.
	if ($_FILES["FileInput"]["size"] > 5242880) {
		die('<script>swal("Auch!", " el archivo esta muy grande! necesito que le bajes el tamaño o comprímelo a menos de 5 Megas", "error");</script>');
	}
	
	//allowed file type Server side check
	switch(strtolower($_FILES['FileInput']['type']))
		{
			//Archivos Permitidos
            case 'image/png': 
			case 'image/gif': 
			case 'image/jpeg': 
			case 'image/pjpeg':
			case 'text/plain':
			case 'text/html': //html file
			case 'application/x-zip-compressed':
			case 'application/pdf':
			case 'application/msword':
			case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
			case 'application/vnd.ms-excel':
			case 'video/mp4':
				break;
			default:
				die('<script>swal("Auch!", " Ese formato no lo puedo subir. convierte ese archivo en un formato que pueda subir ", "error");</script>'); //output error
	}
	
	$File_Name          = strtolower($_FILES['FileInput']['name']);
	$File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention
	$Random_Number      = rand(0, 9999999999); //Random number to be added to name.
	$NewFileName 		= $Random_Number.$File_Ext; //new file name
	
	if(move_uploaded_file($_FILES['FileInput']['tmp_name'], $UploadDirectory.$NewFileName ))
	   {
	   	$registrarArchivosPuntoVenta=new guardarAjax();
	   	$registrarArchivosPuntoVenta->ingresarDocumentosPuntosVentas($NewFileName, $_POST['nombreArchivo']);

		die('<script>swal("Listo", "Ya subí el archivo", "success");</script>');
	}else{
		die('<script>swal("Ops!", " el archivo no se subió, intentalo de nuevo", "error");</script>');
	}
	
}
else
{
	$validar->logOut();
}