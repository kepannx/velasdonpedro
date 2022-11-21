<?php
extract($_REQUEST);
if (isset($usuario) && isset($password)) {
	require  '../punto/data/libreria.lib/libreria.class.php';

	
	$validar=new conectar();
	if($usuario!==NULL){
		switch ($tipo) {
			case 'privada':
				return $validar->decrypt($usuario, key);
				// code...
				break;

			case 'publica':
				return $validar->decrypt($usuario, publickey);
				// code...

				break;
			
			default:
				// code...
				break;
		}
	}
	
?>