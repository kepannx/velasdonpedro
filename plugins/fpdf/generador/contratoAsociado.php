<?php
require('generador.php');
require '../../../superAdmin/allow/data/libreria.lib/libreria.clases.php'; //Aqui estan las clases comunes para toda la app
require '../../../superAdmin/allow/data/libreria.lib/asociados/libreria.clases.php'; //Aquí estan las clases para los asociados

$datos         = $_REQUEST;
extract($datos);
if(isset($datos))
{
  $validar       = new validar();
  $consultaAsociado=new consultaAsociados();
  $asociado = $consultaAsociado->getAsociado($id);
  $data_uri = $asociado["clienteFirma"];
  $data_uri = $asociado["clienteFirma"];
  #Generamos Firma digital
  $encoded_image = explode(",", $data_uri)[1];
  $decoded_image = base64_decode($encoded_image);
  file_put_contents("firma.png", $decoded_image);
  // Abrir fichero de texto
  $body = '<b>Nombre completo: '.$asociado["clienteApellidosPrimero"].' '.$asociado["clienteApellidosSegundo"].' '.$asociado["clienteNombres"].'
  dirección redidencia '.$asociado["clienteDireccion"].' ciudad #ciudad celular '.$asociado["clienteCelular"].'
  teléfono '.$asociado["clienteTelefono"].' genero '.$asociado["clienteGenero"].'
  fecha de nacimiento '.$asociado["clienteFechaNacimiento"].' estado civil '.$asociado["clienteEstadoCivil"].'
  empresa donde labora '.$asociado["empresaNombre"].' cargo '.$asociado["clienteCargo"].'
  teléfono #telefono ocupación '.$asociado["clienteOcupacion"].'
  Autoriza recibir información #recibiremail correo electrónico #email mensajes sms #autosms
  Informacion general objetivos generales
  Verme mejor: bajar,mantener o subir de peso, tonificar musculos, mejorar apariencia ect. <img src="firma.png" width="184"><br>';

  $pdf = new createPDF(
      utf8_decode($body),   // html text to publish

      time()
  );
  $pdf->run();

    #Eliminamos la firma generada
    unlink('firma.png');
    exit;
}
?>
