<?php
require('../../data/libreria.lib/libreria.clases.php');
$consulta= new consultasAjax();
$consulta->ajaxProductosJson($_REQUEST);
?>