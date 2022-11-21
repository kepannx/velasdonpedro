<?php
require('../../../data/libreria.lib/libreria.clases.php');
$consulta= new consultasAjax();
extract($_REQUEST);
$consulta->checkCreditos($identificacion);
?>