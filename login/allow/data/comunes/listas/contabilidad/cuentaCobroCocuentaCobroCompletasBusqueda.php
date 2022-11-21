<?php
require('../../../../data/libreria.lib/libreria.clases.php');
$cComun=new consultasComunes();
$cComun->listaCuentaCobroBusqueda($_REQUEST);
?>