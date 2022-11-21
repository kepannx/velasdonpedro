<?php

require '../../../../superAdmin/allow/data/libreria.lib/libreria.clases.php'; //Aqui estan las clases comunes para toda la app
require '../../../../superAdmin/allow/data/libreria.lib/asociados/libreria.clases.php'; //Aquí estan las clases para los asociados

$ingresarAsociado=new ingresoAsociados();

# Incluimos la libreria Excel php
include_once 'PHPepeExcel.php';

$options = array(
    'start' => 1, # Min Cantdad de registros
    'limit' => 50 # Max Cantidad de registros
);

$datos = PHPepeExcel::xls2sql('Planes.xls', array(
    planId,
    "planNombre", # Campos del excel
    null,
    "planDiasCorte", # Capos del excel
    null, # Campos del excel
    null, # Campos del excel
    null, # Campos del excel
    null, # Campos del excel
    null, # Campos del excel
    null, # Campos del excel
    null, # Campos del excel
    null, # Campos del excel
    null, # Campos del excel
    "planDiascongelacion", # Campos del excel
  ), "plan", $options); # Nombre tabla Sql - Parametros de Opciones

  if($ingresarAsociado->ExportarExcelaSqlPlan($datos)==1)
  {
    //Confirmación
    echo 'La exportacion se realizo correctamente :) ';
  }
  else
  {
    //Reportar error
    echo mysql_error();
    echo "<br> Error Ops! ocurrió un error, Intentalo de nuevo, si el error sigue, comunicate con el ingeniero, y dile que tienes un error con el número [00-00-00-00], seguro el sabrá que hacer  <i class='fa  fa-smile-o'></i>";
  }
