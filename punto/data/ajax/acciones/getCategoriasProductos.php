<?php
require_once '../../libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador($_SESSION['datos']);
$tablas=new queryAjax();
extract($_REQUEST);
if ($tipo==0) {
	# code...
		$tablas->loadSelectCategorias('categoria', NULL);

}else {
		$tablas->loadSelectCategorias('subCategoria', $tipo);
}

?>