<?php
extract($_REQUEST);
	if (isset($id)) { //Pendiente la capa de seguridad
		require('../../../../data/libreria.lib/libreria.clases.php');
		$cComun=new consultasComunes();
		$cComun->listaFacturas($_REQUEST);
	}
?>