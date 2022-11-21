<?php
require_once '../../libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador();
$eliminar=new queryAjax();
extract($_REQUEST);
$eliminar->deleteRowTraslado($idRow);
?>