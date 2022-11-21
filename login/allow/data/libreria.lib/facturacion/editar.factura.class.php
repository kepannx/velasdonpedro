<?php
class editarFacturacion extends conectar {


/****************Datos de una  factura ****************************/


public function datosFactura($parametro, $vector)
{
  conectar::conexiones();
  $facturaConvenioId=$this->filtroNumerico($parametro);
  $sql="SELECT *  FROM facturaConvenio WHERE facturaConvenioId='".$facturaConvenioId."'";
  $query=mysql_query($sql);
  $rs=mysql_fetch_array($query);
  

  switch ($vector) {


    case 'facturaConvenioNumero':
      # code...
      return $rs["facturaConvenioNumero"];
      break;


    case 'facturaConvenioFecha':
      # code...
      return $rs["facturaConvenioFecha"];
      break;

    case 'facturaConvenioDescripcion':
      # code...
      return $rs["facturaConvenioDescripcion"];
      break;

    case 'facturaConvenioValor':
      # code...
      return $rs["facturaConvenioValor"];
      break;

    case 'facturaConvenioEstado':
      # code...
      return $rs["facturaConvenioEstado"];
      break;


    case 'convenioId':
      # code...
      return $rs["convenioId"];
      break;

    case 'clienteId':
      # code...
      return $rs["clienteId"];
      break;
    
    default:
      # code...
      return "No hay datos :(";
      break;
  }

  conectar::desconectar();
}





public function consultaDatosCliente($parametro, $vector)
{
  
  conectar::conexiones();

  $idCliente=$this->filtroNumerico($parametro);
  $sql="SELECT *  FROM cliente WHERE clienteId='".$idCliente."'";
  $query=mysql_query($sql);
  $rs=mysql_fetch_array($query);
  

  switch ($vector) {


    case 'clienteIdentidadTipo':
      # code...
      return $rs["clienteIdentidadTipo"];
      break;


    case 'clienteIdEntidadNumero':
      # code...
      return $rs["clienteIdEntidadNumero"];
      break;


    case 'clienteNombres':
      # code...
      return $rs["clienteNombres"];
      break;


    case 'clienteApellidosPrimero':
      # code...
      return $rs["clienteApellidosPrimero"];
      break;

    case 'clienteApellidosSegundo':
      # code...
      return $rs["clienteApellidosSegundo"];
      break;


    case "clienteDireccion":
      # clienteCupoCredito...
      echo $rs["clienteDireccion"];
      break;


    case 'clienteCupoCredito':
      # ...
      return $rs["clienteCupoCredito"];
      break;



    
    default:
      # code...
      return "No hay datos :(";
      break;
  }

  conectar::desconectar();
}







//Ingreso los abonos hechos en forma global
public  function ingresarAbonos($parametros)
{
  extract($parametros);
  //unset($_SESSION['sesionControl']);

  $deuda=$this->filtroNumerico($valorDeuda);
  $abono=$this->filtroNumerico($this->normalizacionDeCaracteres($abono));
  $idCliente=$this->filtroNumerico($this->decrypt($idCliente, publickey));

  //VERIFICO SI EL VALOR QUE SE ABONÓ ES IGUAL O MAYOR A LA DEUDA ACTUAL
  if ($deuda>$abono) {
    # debo hacer el proceso de verficación de las facturas que debe hasta que abono = 0...
     //$residuo=$deuda-$abono;//diferencia en caso que haya

     //Filtro las facturas con deuda
    $sql="SELECT idFactura, idCliente, estadoFactura, valorFactura, deudaFactura FROM facturacion WHERE idCliente='".$idCliente."' AND estadoFactura='en credito'";
    $query=mysql_query($sql);
    $bucket=0;//Recojo la suma de los valores adeudados en la factura
    $controlAbono=$abono;//Con esta variable controlo los ciclos hasta donde puedo abonar
    while ($rs=mysql_fetch_array($query)) {
      # code...
       if($bucket<$controlAbono){
          $bucket=$bucket+$rs['deudaFactura'];
          $deudaFactura=$rs['deudaFactura'];
          if ($deudaFactura<=$abono) {
            # code...
              $abono=$abono-$deudaFactura;//Resto el valor abonado al abono
              $deudaFactura=0;
              $estadoFactura='pagada';
              $abonoTotal=$rs['deudaFactura'];

          }
          else//En caso que la deuda a la factura sea mayor a la del abono
          {
            $abonoTotal=$abono;
            $deudaFactura=$deudaFactura-$abono;
            $abono=0;
            $estadoFactura='en credito';
          }

          $sqlAbono="UPDATE facturacion SET deudaFactura=$deudaFactura, `estadoFactura` = '".$estadoFactura."' WHERE idFactura='".$rs['idFactura']."'";
          mysql_query($sqlAbono);

          $sqlAbonoFactura="INSERT INTO abonoFacturas SET idFactura=".$rs['idFactura'].", valorAbono='".$abonoTotal."' ,  fechaAbono='".date('Y-m-d')."'  , tipoPago='efectivo'";
          mysql_query($sqlAbonoFactura);

       }
      
    }

     
  } 


  elseif ($deuda<=$abono) {
    # Cancelo todas las deudas que el cliente tiene y las igualo a cero ...
    //Verifico diferencias
    $residuo=abs($deuda-$abono);//diferencia en caso que haya

    //Filtro las facturas con deuda
    $sql="SELECT idFactura, idCliente, estadoFactura, valorFactura, deudaFactura FROM facturacion WHERE idCliente='".$idCliente."' AND estadoFactura='en credito'";
    $query=mysql_query($sql);

    while ($rs=mysql_fetch_array($query)) {
      # code...
      $deudaFactura=$rs['deudaFactura'];
      $abonoTotal=$rs['deudaFactura']-$abono;//lo que abonaré a la factura
      $residuo=abs($rs['deudaFactura']-$abono);//si queda un residuo este es el nuevo valor del abono para el próximo
      
      //Igualo los valores para el abono de esa factura
      if ($residuo>=0) {
        # code...
        $abonoTotal=$rs['deudaFactura'];//Existe aun residuo para abonar
      }

      //Actualizo la factura
      $sqlAbono="UPDATE facturacion SET deudaFactura='0', `estadoFactura` = 'pagada' WHERE idFactura='".$rs['idFactura']."'";
      mysql_query($sqlAbono);
      //Ingreso el abono a estas facturas
      $sqlAbonoFactura="INSERT INTO abonoFacturas SET idFactura=".$rs['idFactura'].", valorAbono='".$abonoTotal."' ,  fechaAbono='".date('Y-m-d')."'  , tipoPago='efectivo'";
      mysql_query($sqlAbonoFactura);

    }//Fin del ciclo de cancelación de facturas


  }//fin del los else que verifican los valores de deuda y abono
}











//Generar Factura

public  function generarFactura($facturaConvenioId, $convenioId, $valorFactura)
{
  //$facturaId=$facturaId;

  $sql="INSERT INTO itemConvenio SET  itemConvenioProducto=0, itemConvenioTipo=1, 
                                      itemConvenioValorUnidad='".$valorFactura."',
                                      itemConvenioCantidad=1,
                                      convenioId='".$convenioId."',
                                      itemfacturaConvenioId='".$facturaConvenioId."'
                                      ";
  mysql_query($sql);


echo '<div class="white-box">
                      <script type="text/javascript">
                        <!--
                          window.print();
                          //-->
                      </script>';

 echo '<table width="320" border="0" style="font-family:arial; font-size:15px;" align="center" topMargin="0" style="display:block">
                              <tr>
                                <td colspan="4" align="center">
                                    <img src="'.$this->datospagina(9).'/images/logo.png" width="150" align="center">
                                  <br>
                               
                                  <b>'.$this->datospagina(0).'</br>'.$this->datospagina(4).' <b> <br>'.$this->datospagina(1).'</td>
                                </tr>
                              <tr>
                        
                          <tr>
                            <td colspan="1">Remisión:</td>
                            <td colspan="3" align="right"><b class="text-danger">'.$this->datosFactura($facturaConvenioId, "facturaConvenioNumero").'</b></td>
                          </tr>

                          <tr>
                            <td colspan="1">Fecha:</td>
                            <td colspan="3" align="right"><b class="text-danger">'.$this->fechaHumana(date("Y-m-d", $this->datosFactura($facturaConvenioId, "facturaConvenioFecha"))).'</b></td>
                          </tr>

                          <tr>
                            <td colspan="1">Cliente</td>
                            <td colspan="3" align="right"><b class="text-danger">'.$this->consultaDatosCliente($this->datosFactura($facturaConvenioId, "clienteId"), "clienteNombres").'</b></td>
                          </tr>
                    </table>  
                    <hr>
                    <table width="320" border="0" style="font-family:arial; font-size:15px;" align="center" topMargin="0">

                          <!--Productos Adquiridos-->
                         <td colspan="4">
                            <table width="110%" border="0" style="font-size:13px" align="center">
                              <tr>
                                <td width="43%" align="center" class="text-danger"><b>Producto</b></td>
                                <td width="21%" align="center" class="text-danger"><b>Valor</b></td>
                                <td width="12%" align="center" class="text-danger"><b>Cant</b></td>
                                <td width="24%" align="center" class="text-danger"><b>Sub</b></td>
                              </tr>

                    ';

         $sql="SELECT itemConvenioProducto, itemConvenioValorUnidad, itemConvenioCantidad, itemConvenioTipo   FROM itemConvenio WHERE itemfacturaConvenioId='".$facturaConvenioId."'";
                   $query=mysql_query($sql);
                    $valorFinal=0;

        while ($rs=mysql_fetch_array($query)) {
            # code...
            echo '<tr>
                                <td><b>Abono Credito</b></td>
                                <td align="center"><b> $ '.number_format($rs["itemConvenioValorUnidad"]).'</b></td>
                                <td align="center"><b>'.$rs["itemConvenioCantidad"].'</b></td>
                                <td align="center"><b>$ '.number_format(($rs["itemConvenioCantidad"]*$rs["itemConvenioValorUnidad"])).'</b></td>
                              </tr>';
                              $valorFinal=$valorFinal+(($rs["itemConvenioCantidad"]*$rs["itemConvenioValorUnidad"]));
        }
            

         echo '</table>



                         </td>
                      </table>


                         <hr>

                        <table width="320" border="0" style="font-family:arial; font-size:15px;" align="center" topMargin="0">
                         <!-- Fin  Productos Adquiridos-->

                          <tr>
                            <td colspan="1">Total:</td>
                            <td colspan="3" align="right"><b class="text-danger">$'.number_format($valorFinal).'</b></td>
                          </tr>


                          <tr>
                            <td colspan="1">Efectivo:</td>
                            <td colspan="3" align="right"><b class="text-danger">$'.number_format($this->filtroNumerico($this->normalizacionDeCaracteres($_REQUEST["abono"]))).'</b></td>
                          </tr>

                          <tr>
                            <td colspan="1">Cambio:</td>
                            <td colspan="3" align="right"><b class="text-danger">$ '.number_format($this->analizarDevuelta($valorFinal,$this->filtroNumerico($this->normalizacionDeCaracteres($_REQUEST["abono"])))).'</b></td>
                          </tr>


                          <tr>
                            <td colspan="1">Estado:</td>
                            <td colspan="3" align="right"><b class="text-danger">Pagado</b></td>
                          </tr>


                          <tr>
                            <td colspan="4" align="center" class="text-muted" style="font-size:10px;"> '.piePaginaFacturas.'</td>
                          </tr>
                          
                      

                          </table>

                      ';
echo '<a href="javascript:window.print()" id="noPrint"  >
                              <div class="btn btn-primary">Imprime</div>
                            </a>
                  </div>';

}






//String para las medidas
public  function stringMedidas($parametro)
{
  if ($parametro==1) {
    # unidades...
    return "Unidades";
  }
  elseif ($parametro==2) {
    # Gramos...
    return "Gramos";
  }
  elseif ($parametro==3) {
    # Kilos...
    return "Kilos";
  }
  elseif ($parametro==4) {
    # Litros...
    return "Litros";
  }

  elseif ($parametro==5) {
    # Mililitros...
    return "MiliLitros";
  }
}






//SACO LA PROXIMA FACTURA
private function proximaNumeroFactura($convenioId)
{

     $sql="SELECT facturaConvenioNumero, convenioId FROM facturaConvenio WHERE convenioId ='".$convenioId."' order by(facturaConvenioNumero) DESC";
    $rs=mysql_fetch_array(mysql_query($sql));
    return $rs["facturaConvenioNumero"]+1;
}








//retorno el valor que tiene que devolver
private  function analizarDevuelta($valorFinal, $efectivo)
{
    $efectivo=$this->filtroNumerico($this->normalizacionDeCaracteres($efectivo));   
    $valorFinal=$this->filtroNumerico($this->normalizacionDeCaracteres($valorFinal));
    $valorFinal=$efectivo-$valorFinal;
     if ($valorFinal>=0) {
       # code...
        return $valorFinal;
     }
     else
     {
        return 0;
     }

}



//Fechas


/********FECHAS*************/



public   function fechaHumana($parametro)
{
  $fecha=explode('-',$parametro);
  if($fecha[2]>0){                 
  return $fecha[2].' de '.$this->meses($fecha[1]). ' del '.$fecha[0] ; 
  }
  else
  {
    return "No se ha asignado fecha";
  }
}
  



//Convierto los números de los meses en los meses string
private function meses($parametro)
  {
  switch($parametro)
    {
    
    case 01:
    return 'Enero';
    break;
    
    
    case 02:
    return 'Febrero';
    break;
    
    
    case 03:
    return 'Marzo';
    break;
    
    
    case 04:
    return 'Abril';
    break;
    
    
    case 05:
    return 'Mayo';
    break;
    
    
    case 06:
    return 'Junio';
    break;
    
    
    case 07:
    return 'Julio';
    break;
    
    
    case "08":
    return 'Agosto';
    break;
    
    
    case "09":
    return 'Septiembre';
    break;
    
    
    case "10":
    return 'Octubre';
    break;
    
    
    case "11":
    return 'Noviembre';
    break;
    
    
    case "12":
    return 'Diciembre';
    break;
    
    }
  
  }








/*******************************[FILTROS]*******************************************/
//Filtro Strings
private function filtroStrings($parametro, $tipo)
{
  //tipo[0]=minuscula  [1]=MAYUSCULA [2]=Tipo Oracion

  if($tipo==0)
  {
    //Minúscula
    return mb_convert_case(filter_var($parametro, FILTER_SANITIZE_STRING), MB_CASE_LOWER , "UTF-8");
  }
  elseif ($tipo==1) {
    # MAYÚSCULA...
    return mb_convert_case(filter_var($parametro, FILTER_SANITIZE_STRING), MB_CASE_UPPER , "UTF-8");
  }
  elseif ($tipo==2) {
    # Tipo Oración...
    return mb_convert_case(filter_var($parametro, FILTER_SANITIZE_STRING), MB_CASE_TITLE , "UTF-8");
  }
  else
  {
    //Tipo Oración
    return mb_convert_case(filter_var($parametro, FILTER_SANITIZE_STRING), MB_CASE_TITLE , "UTF-8");
  }
}

//Filtro de numeros

private function filtroNumerico($parametro)
{
  if(intval(filter_var($parametro, FILTER_VALIDATE_INT)==TRUE))
  {
    return intval($parametro);
  }
  elseif(intval(filter_var($parametro, FILTER_VALIDATE_INT)==FALSE))
  {
    return 0;
  }
}





//Filtro con decimal en punto (.) 
private function filtroNumericoDecimal($parametro)
{
  
  if(intval(filter_var($parametro, FILTER_SANITIZE_NUMBER_FLOAT)==TRUE))
  {
    return intval($parametro);
  }
  elseif(intval(filter_var($parametro, FILTER_SANITIZE_NUMBER_FLOAT)==FALSE))
  {
    return 0;
  }

}




//Filtro  todos los emails
private function filtrarEmail($original_email)
{
  $original_email=$this->filtroStrings($original_email, 0);
  $clean_email = filter_var($original_email,FILTER_SANITIZE_EMAIL);
  if ($original_email == $clean_email && filter_var($original_email,FILTER_VALIDATE_EMAIL))
  {
  return $original_email;
  }

}

private function filtrocaracteres($parametro){
      $encontrar    = array( ".", ",", " ", "=", "_"," ", "#","`:","+", "-", "(", ")");
      $remplazar = array( "");
      return str_ireplace($encontrar, $remplazar,$parametro);
  
}

private function remplazartildesyotros($parametro) {
    $encontrar = array("á", "é", "í", "ó", "ú", " ", "ñ", "Á", "É", "Í", "Ó", "Ú", "Ä", "Ë", "Ï", "Ö", "Ü", "ä", "ë", "ï", "ö", "ü");
    $remplazar = array("a", "e", "i", "o", "u", "_", "n", "A", "E", "I", "O", "U", "A", "E", "I", "O", "U", "a", "e", "i", "o", "u");
    return str_ireplace($encontrar, $remplazar, $parametro);
  }

public  function normalizacionDeCaracteres($parametros)
{

  return $this->remplazartildesyotros($this->filtrocaracteres(mb_convert_case($parametros, MB_CASE_LOWER , "UTF-8")));

}

}