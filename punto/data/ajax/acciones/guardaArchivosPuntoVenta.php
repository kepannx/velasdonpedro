<?php
extract($_REQUEST);



if(isset($_FILES["FileInput"]) && $_FILES["FileInput"]["error"]== UPLOAD_ERR_OK)
{
	############ Edit settings ##############
	$UploadDirectory	= 'imagenes/'; //specify upload directory ends with / (slash)
	##########################################
	
	/*
	Note : You will run into errors or blank page if "memory_limit" or "upload_max_filesize" is set to low in "php.ini". 
	Open "php.ini" file, and search for "memory_limit" or "upload_max_filesize" limit 
	and set them adequately, also check "post_max_size".
	*/
	
	//check if this is an ajax request
	if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
		die();
	}
	
	
	//Is file size is less than allowed size.
	if ($_FILES["FileInput"]["size"] > 5242880) {
		die("Archivo Muy Grande!");
	}
	
	//allowed file type Server side check
	switch(strtolower($_FILES['FileInput']['type']))
		{
			//allowed file types
            case 'image/png': 
			case 'image/gif': 
			case 'image/jpeg': 
			case 'image/pjpeg':
			case 'text/plain':
			case 'text/html': //html file
			case 'application/x-zip-compressed':
			case 'application/pdf':
			case 'application/msword':
			case 'application/vnd.ms-excel':
			case 'video/mp4':
				break;
			default:
				die('Archivo Incompatible!'); //output error
	}
	
	$File_Name          = strtolower($_FILES['FileInput']['name']);
	$File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention
	$Random_Number      = rand(0, 9999999999); //Random number to be added to name.
	$NewFileName 		= $Random_Number.$File_Ext; //new file name
	
	if(move_uploaded_file($_FILES['FileInput']['tmp_name'], $UploadDirectory.$NewFileName ))
	   {
	   	/*
	   	require('../../libreria.lib/libreria.class.php');
		$archivos=new guardarAjax();
		if (strlen($nombreArchivo)<=1) {
			# code...
			$nombreArchivo=$NewFileName;
		}*/
		//$archivos->guardarRegistroArchivos($idBanco, $idCliente, $nombreArchivo,$NewFileName, $tipo);
		die('<script>swal("Listo", "Ya subí el archivo", "success");</script>');
	}else{
		die('error uploading File!');
	}
	
}
else
{
	die('<div id="mensaje" class="alert alert-warnign"><i class="fa fa-warning"></i>Ops! Algo salió mal, intentalo de nuevo</div>');
}






?>