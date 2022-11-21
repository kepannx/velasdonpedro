<?php 
require('data/libreria.lib/libreria.clases.php');
$sesion=new validar();
extract($_REQUEST);
$sesion->cerrarSesion($id);
?>