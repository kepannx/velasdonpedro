<?php
require('../../../../data/libreria.lib/libreria.clases.php');
$cComun=new consultasComunes();
$cComun->listaCuentaCobro($_REQUEST);
?>