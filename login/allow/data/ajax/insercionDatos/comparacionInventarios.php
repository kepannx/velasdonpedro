<?php
require('../../libreria.lib/libreria.clases.php');
require('../../libreria.lib/70/libreria.class.php');
$validar=new validar();
$validar->validando();
$listas=new guardarAjax();
$listas->comparacionInventarios($_REQUEST);
?>