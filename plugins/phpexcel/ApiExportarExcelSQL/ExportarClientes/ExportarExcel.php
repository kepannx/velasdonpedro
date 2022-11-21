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

$datos = PHPepeExcel::xls2sql('Clientes.xls', array(
    "clienteIdEntidadNumero", # Campos del excel
    "clienteNombres", # Campos del excel
    null,
    "clienteCelular", # Campos del excel
    null, # Campos vacios de excel :)
    null, # Campos vacios de excel :)
    null, # Campos vacios de excel :)
    null, # Campos vacios de excel :)
    null, # Campos vacios de excel :)
    "clienteFechaContrato", # Campos del excel 
    null, # Campos vacios de excel :)
    "clienteEmail", # Campos del excel
    null, # Campos vacios de excel :)
    null, # Campos vacios de excel :)
    null, # Campos vacios de excel :)
    null, # Campos vacios de excel :)
    null, # Campos vacios de excel :)
    null, # Campos vacios de excel :)
    null, # Campos vacios de excel :)
    null, # Campos vacios de excel :)
    null, # Campos vacios de excel :)
    null, # Campos vacios de excel :)
    null, # Campos vacios de excel :)
    "planId" # Campos del excel
  ), "cliente", $options); # Nombre tabla Sql - Parametros de Opciones

  if($ingresarAsociado->ExportarExcelaSql($datos)==1)
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
