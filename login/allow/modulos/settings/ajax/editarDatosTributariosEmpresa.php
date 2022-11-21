<?php
require('../../../data/libreria.lib/ajax/backend.ajax.php');
$provedor=new edicionAjax();
$provedor->editarDatosTriburariosEmpresa($_REQUEST);
?>