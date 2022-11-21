<?php
class consultaContabilidad extends conectar {









//DATOS DE LOS PROVEDORES
public function consultaDatosProvedores($parametro, $vector)
{
  conectar::conexiones();
  $idprovedor=$this->filtroNumerico($parametro);
  $sql="SELECT *  FROM  provedores WHERE idprovedor='".$idprovedor."'";
  $query=mysql_query($sql);
  $rs=mysql_fetch_array($query);
  switch ($vector) {


    case 'nombreProvedor':
      # code...
      return $rs["nombreProvedor"];
      break;


    case 'ideProvedor':
      # code...
      return $rs["ideProvedor"];
      break;

    case 'direccionProvedor':
      # code...
      return $rs["direccionProvedor"];
      break;

    case 'ciudadProvedor':
      # code...
      return $rs["ciudadProvedor"];
      break;


    case 'emailProvedor':
      # code...
      return $rs["emailProvedor"];
      break;


    case 'telefonoProvedor':
      # code...
      return $rs["telefonoProvedor"];
      break;


    case 'contactoProvedor':
      # code...
      return $rs["contactoProvedor"];
      break;

   
    default:
      # code...
      return "No hay datos :(";
      break;
  }

  conectar::desconectar();
}




//String para las medidas
/*
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

*/




/*****************GASTOS****************************/

//Listo todos los convenios que tengo  registrados
public  function listaGastos($id, $vector)
{
  //conectar::conexiones();
  $convenioId=$this->filtroNumerico($this->decrypt($id, key));
  if ($vector==1) {
    # code...
     $sql="SELECT * FROM egresosGastos    ORDER BY (fechaEgresoGasto) DESC";
  }
  elseif ($vector==2) {
    # PARA EL FILTRO DE BUSQUEDA DE LOS GASTOS...
    $sql="SELECT * FROM egresosGastos  WHERE  fechaEgresoGasto BETWEEN ($fecha1 AND $fecha2) ORDER BY (fechaEgresoGasto) DESC";
  }
  $query=mysql_query($sql);
  echo '<table id="tablaGastos" class="table table-striped">
              <thead>
                <tr>
                  <th>Nombre Gasto</th>
                  <th>Fecha</th>
                  <th>Valor</th>
                  <th>Estado</th><!-- Si esta Liquidado o no-->
                  <th></th>
                </tr>
              </thead>
              <tbody>
             ';

             $t=mysql_num_rows($query);
       while ($rs=mysql_fetch_array($query)) {
        # code... 
          echo '<tr style="'; if($rs["liquidada"]==2){  echo 'text-decoration:line-through;'; } echo '">
                  <td>'.$rs["descripcion"].'</td>
                  <td>'.$rs["fechaEgresoGasto"].'</td>

                  <td><strong class="text-muted">$ '.number_format($rs["valorEgresoGasto"]).'</strong></td><!-- Valor del gasto-->
                  <td>'.$this->estadoGasto($rs["liquidada"]).'</td><!-- Estado -->

                  <td> 
                      <input type="radio" name="idEgresosGasto[]" id="idEgresosGasto_'.$n.'"  value="'.$rs["idegresosGasto"].'" >
                    
                    '.$this->botonAnularRestaurarEgresoGasto($rs["liquidada"]).'
                  </td>
                </tr>
                </tr>
               ';
               $n++;

               }

     echo '  </tbody>
            </table>
              <input type="hidden" id="numRows" value="'.$t.'">
                

            ';
  //conectar::desconectar();

}





private function estadoGasto($parametro)
{
  if ($parametro==1) {
    # code...
    return '<strong class="text-danger">Sin Liquidar</strong>';
  }
  elseif ($parametro==0) {
    # code...
    return '<strong class="text-muted">Liquidado</strong>';
  }

  elseif ($parametro==2) {
    # code...
    return '<strong class="text-danger"><i class="fa fa-minus-circle"></i> Anulada</strong>';
  }
}






/*********************************CAJAS*************************************/




//Chequeo de  existencia de cajas abiertas
public function checkAperturaCaja($id)
{
  $sql="SELECT * FROM  cajas where estado= '1' ";
  if (mysql_num_rows(mysql_query($sql))>0) {
    # code...
    return 1; //si hay cajas abiertas
  }
  else
  {
    return 0; //No hay cajas abiertas
  }
}




//DATOS DE LAS CAJAS 

public function consultaDatosCaja($vector)
{
  conectar::conexiones();
  $sql="SELECT *  FROM cajas WHERE estado='1' ORDER BY(estado) desc";
  $query=mysql_query($sql);
  $rs=mysql_fetch_array($query);
  

  switch ($vector) {

    case 'idcaja':
      # code...
      return $rs["idcaja"];
      break;

    case 'fechaAperturaCaja':
      # code...
      return $rs["fechaAperturaCaja"];
      break;

    case 'fechaCierreCaja':
      # code...
      return $rs["fechaCierreCaja"];
      break;

    case 'valorBase':
      # code...
      return $rs["valorBase"];
      break;

    case 'valorGastosEgresos':
      # code...
      return $rs["valorGastosEgresos"];
      break;

    case 'valorEfectivo':
      # code...
      return $rs["valorEfectivo"];
      break;

    case 'valorEnDocumentos':
      # code...
      return $rs["valorEnDocumentos"];
      break;

    case 'diferencia':
      # code...
      return $rs["diferencia"];
      break;

    case 'tokenCierre':
      # code...
      return $rs["tokenCierre"];
      break;

    case 'estado':
      # code...
      return $rs["estado"];
      break;

    default:
      # code...
      return "No hay datos :(";
      break;


    }
}





/************************[HISTORIAL DE VENTAS]**************************************/

//Listo todos los convenios que tengo  registrados
public  function listaHistoricoVentas()
{


  $sql="SELECT idcaja, fechaAperturaCaja, fechaCierreCaja, valorBase, valorGastosEgresos, valorEfectivo, valorEnDocumentos,  estado, diferencia FROM cajas  WHERE  estado ='0'";
  $query=mysql_query($sql);
  echo '<table id="tablaGastos" class="table table-striped">
              <thead>
                <tr>
                  <th></th><!-- Alerta si esta descuadrada o no-->
                  <th>Fecha Apertura</th>
                  <th>Fecha Cierre</th>
                  <th>Recaudo</th>
                  <th>Gastos</th><!-- Si esta Liquidado o no-->
                  <th></th>
                </tr>
              </thead>
              <tbody>
             ';

       while ($rs=mysql_fetch_array($query)) {
        # code... 
          echo '<tr>
                  <td>'.$this->alertaDiferenciaCajas($rs['diferencia']).'</td>
                  <td>'.$rs["fechaAperturaCaja"].'</td>
                  <td>'.$rs["fechaCierreCaja"].'</td>

                  <td><strong class="text-muted">$ '.number_format(($rs["valorEfectivo"]+$rs["valorEnDocumentos"])).'</strong></td>
                  <td>'.number_format($rs["valorGastosEgresos"]).'</td><!-- Estado -->

                  <td> 
                    <a href="'.$this->datospagina(5).'/modulos/contabilidad/verHojaHistorica.php?id='.$_REQUEST['id'].'&historial='.$this->encrypt($rs['idcaja'], publickey).'">
                     <button type="button" id="noPrint" class="btn btn-success"><i class="fa fa-plus"></i>Muestrame Mas</button>
                     </a>
                  </td>
                </tr>
                </tr>
               ';

               }

     echo '  </tbody>
            </table>
        
                

            ';
  //conectar::desconectar();

}














/*********************************** [FACTURAS] *******************************************/



//Lista de facturas sin cancelar
public function listaFacturasSinCancelar(){

  $sql="SELECT * FROM facturasProvedores WHERE estadoFactura='credito' AND deudaFacturaProvedor>0";
  $query=mysql_query($sql);
  echo '<table id="tablaRelacionFacturas" class="table table-striped">
              <thead>
                <tr>
                  <th>Provedor</th>
                  <th>Fecha Compra</th>
                  <th>Nro Factura</th>
                  <th>Valor Factura</th>
                  <th>Valor Factura</th>
                  <th>Estado</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
             ';
       while ($rs=mysql_fetch_array($query)) {
        # code...
          echo '<tr>
                  <td>'.$this->consultaDatosProvedores($rs["idProvedor"], 'nombreProvedor').'</td>
                  <td align="center">'.$rs["fechaFacturaProvedor"].'</td>
                  <td align="center">'.$rs["nroFacturaProvedor"].'</td>
                  <td align="center">$ '.number_format($rs["valorFacturaProvedor"]).'</td>
                  <td align="center">$ '.number_format($rs["deudaFacturaProvedor"]).'</td>
                  <td>'.$this->estadoFactura($rs["estadoFactura"]).'</td>
                  
                  <td>
                    <a href="'.$this->datospagina(5).'modulos/contabilidad/facturaProvedor.php?id='.$_GET['id'].'&idFactura='.$this->encrypt($rs["idfacturaProvedor"], publickey).'" >
                    <button class="btn btn-outline btn-info waves-effect waves-light">
                      <i class="fa  fa-search-plus m-r-5"></i>
                      <span>Muestrame Mas</span>
                    </button>
                    </a>
                  </td>
                </tr>
                </tr>
               ';
               }

     echo '  </tbody>
            </table>';

}

//fin Lista de facturas sin cancelar


public function listaMisFacturas($id, $vector)
{
  $convenioId=$this->filtroNumerico($this->decrypt($id, key));
  
/*sqls*****************/
  if ($vector==1) { //Todas las facturas de compra del ultimo trimestre
    # code...
    $trimestre=strtotime(date('Ym01',strtotime("-3 month")))+7200;
   $sql="SELECT idConvenioFacturaCompra, convenioId, provedorConvenioId, convenioFacturasComprasFecha, nroFactura, valorFactura, convenioFacturasComprasDeudaActual, estado  FROM convenioFacturasCompras WHERE convenioId='".$convenioId."' AND  convenioFacturasComprasFecha > '".$trimestre."'";

  }
  elseif ($vector==2) { //Todas las facturas de compra que esten dentro del rángo de la búsqueda de meses
    # code...
    $fecha1="";
    $fecha2="";
    $sql="SELECT idConvenioFacturaCompra, convenioId, provedorConvenioId, convenioFacturasComprasFecha, nroFactura, valorFactura, convenioFacturasComprasDeudaActual, estado  FROM convenioFacturasCompras WHERE convenioId='".$convenioId."' AND  convenioFacturasComprasFecha BETWEEN  '".$fecha1."' AND  '".$fecha1."'";
  }


    echo '<table id="todasLasFacturas" class="display nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Provedor</th>
                                    <th>Nro Factura</th>
                                    <th>Fecha</th>
                                    <th>Valor</th>
                                    <th>Deuda</th>
                                    <th id="noPrint">Estado</th>
                                    <th></th><!--[ACCIÓN] -->
                                </tr>
                            </thead>
    ';

    echo '<tbody>';

    $query=mysql_query($sql);
    while ($rs=mysql_fetch_array($query)) {
      # code...
        echo '<tr>
                  <td>'.$this->consultaDatosProvedores($rs["provedorConvenioId"], "provedorConvenioNombre").'</td><!-- PROVEDOR -->
                  <td>'.$rs["nroFactura"].'</td><!-- NROFACTURA -->
                  <td>'.$this->fechaHumana(date("Y-m-d", $rs["convenioFacturasComprasFecha"])).'</td><!-- FECHAFACTURA -->
                  <td>$ '.number_format($rs["valorFactura"]).'</td><!-- VALORFACTURA -->
                  <td class="text-danger"> $ '.number_format($rs["convenioFacturasComprasDeudaActual"]).'</td><!-- DEUDA -->
                  <td>'.$this->alertaEstadosFacturacion($rs["estado"]).'</td><!-- ESTADO -->
                  <td id="noPrint"><button  class="btn btn-block btn-outline btn-info"><i class="fa fa-search"></i> Muestrame Mas</button></td><!-- ACCION -->
              </tr>';

    }

   
    echo ' </tbody>';

         echo '</table>';



//***************TABLA*********************//



}













//Alerta sobre los minimos de cada producto
public function alertaEstadosFacturacion($estado)
{

  switch ($estado) {
    case 1:
      # code...
      return "<p class='text-danger'> <i class='fa fa-warning'></i><b>Crédito</b></p>";
      break;

    case 0:
     return "<p class='text-muted'> <i class='fa fa-thumbs-up'></i><b>Pagada</b></p>";
      # code...
      break;

  }
 

}


//Muestro en visual en que estado esta cada factur
private function estadoFactura($vector){

  if ($vector=='cancelado') {
    # code...
    return '<span class="label-rouded label-success"  style="color:#fff;">Cancelado</span>';
  }
  elseif ($vector=='credito') {
    # code...
    return '<span class="label-rouded label-danger"  style="color:#fff;">Crédito</span>';
  }
  elseif ($vector=='consignacion') {
    # code...
    return '<span class="label-rouded label-warning" style="color:#fff;">Consignación</span>';
  }
}



//Boton que me permite hacer una restauración del egreso o el gasto
public function botonAnularRestaurarEgresoGasto($tipoEstado){


  if ($tipoEstado==2) {
    # code...
    return  '<button type="button" class="btn btn-danger" id="anular"><i class="fa fa-warning"></i> Anular</button>';
  }
  elseif($tipoEstado==1)
  {
    return  '<button type="button" class="btn btn-success" id="restaurar"><i class="fa fa-magic"></i> Restaurar</button>';
  }
}




//Saco el icono que simboliza si una caja esta en orden o esta descuadrada
public function alertaDiferenciaCajas($vector){
  if ($vector==0) {
    # code...
    return '<i class="fa fa-check-circle text-success" title="La caja se cerró en orden"></i>';
  }
  elseif ($vector>0) {
    # code...
    return '<i class="fa fa-circle text-warning" title="Al cerrar esta caja hubo una diferencia en positivo"></i>';
  }
  elseif ($vector<0) {
    # code...
    return '<i class="fa fa-warning text-danger" title="Al cerrar esta caja hubo una diferencia en negativo"></i>';
  }
}


/*****************************[SUMATORIAS]*****************************/

public  function valorVendidoUltimoTrimestre($codigoVendedor)
{
  $codigoVendedor=$this->filtroNumerico($codigoVendedor);

  $sql="SELECT SUM(valorFactura) AS valorTotal FROM  facturacion WHERE
                                                      codigoVendedor='".$codigoVendedor."'"; //METER AQUI EL BETWEN
 $resultado = mysql_fetch_assoc(mysql_query($sql));  
  return $resultado["valorTotal"];

}
//Fechas




public  function totalCreditosUltimoTrimestre($convenioId)
{
  $convenioId=$this->decrypt($convenioId, key);

  $sql="SELECT SUM(convenioFacturasComprasDeudaActual) AS convenioFacturasComprasDeudaActual 
                                                      FROM convenioFacturasCompras WHERE
                                                      convenioId='".$this->filtroNumerico($convenioId)."' AND estado=1"; //METER AQUI EL BETWEN
 $resultado = mysql_fetch_assoc(mysql_query($sql));  
  return $resultado["convenioFacturasComprasDeudaActual"];

}



//SUMATORIA DE LOS EGRESOS SIN LIQUIDAR
public function valorEgresosSinLiquidar($vector){

  //[0]=GASTOS LIQUIDADOS[1]GASTOS SIN LIQUIDAR[2]:[NULL]
  if ($vector==1) {
    # Gastos sin liquidar...
    $sql="SELECT SUM(valorEgresoGasto) AS valorTotal 
                                                      FROM egresosGastos WHERE
                                                      liquidada='1'";
  }
  elseif ($vector==0) {
    # Gastos y egresos liquidados...
    $sql="SELECT SUM(valorEgresoGasto) AS valorTotal 
                                                      FROM egresosGastos WHERE
                                                      liquidada='0'";
  }
  elseif($vector==2)
  {//Gastos y egresos anulados
    $sql="SELECT SUM(valorEgresoGasto) AS valorTotal 
                                                      FROM egresosGastos WHERE
                                                      liquidada='2'";
  }
  else
  {
    //Gastos y egresos que no estan anulados
    $sql="SELECT SUM(valorEgresoGasto) AS valorTotal 
                                                      FROM egresosGastos WHERE
                                                      liquidada!='2'";
  }
 //METER AQUI EL BETWEN
 $resultado = mysql_fetch_assoc(mysql_query($sql));  
  return $resultado["valorTotal"];
}




//Egresos Liquidados
public function valorEgresosLiquidados($idCaja, $vector){

  $idCaja=$this->filtroNumerico($idCaja);
  //[0]=GASTOS LIQUIDADOS[1]GASTOS SIN LIQUIDAR[2]:[NULL]
    
    # Gastos y egresos sin liquidar...
    $sql="SELECT SUM(valorEgresoGasto) AS valorTotal 
                                                      FROM egresosGastos WHERE
                                                      idCajaCierre=$idCaja AND tipoEgresoGasto='$vector'";
     $resultado = mysql_fetch_assoc(mysql_query($sql));  
     return $resultado["valorTotal"];
 
}






//Valores liquidados por tarjetas crédito
  public function valorLiquidadosIngresosPorTarjetasCredito($idCaja){
    $idCaja=$this->filtroNumerico($idCaja);
    # Gastos y egresos sin liquidar...
    $sql="SELECT idFactura,  SUM(valorFactura) AS valorTotal 
                                                      FROM facturacion WHERE
                                                      idCajaCierre=$idCaja AND tipoPago ='tarjeta credito'  AND separada='no'";
    $resultado = mysql_fetch_assoc(mysql_query($sql));  
     return $resultado["valorTotal"];
  }



//Valores liquidados por tarjetas crédito
  public function valorLiquidadosIngresosPorTarjetasDebito($idCaja){
    $idCaja=$this->filtroNumerico($idCaja);
    # Gastos y egresos sin liquidar...
    $sql="SELECT SUM(valorFactura) AS valorTotal 
                                                      FROM facturacion WHERE
                                                      idCajaCierre=$idCaja AND  tipoPago='tarjeta debito' AND separada='no'";




    $resultado = mysql_fetch_assoc(mysql_query($sql));  
     return $resultado["valorTotal"];


  }




//Valores liquidados por cheques

    public function valorLiquidadosIngresosPorCheques($idCaja){
    $idCaja=$this->filtroNumerico($idCaja);
    # Gastos y egresos sin liquidar...
    $sql="SELECT SUM(valorFactura) AS valorTotal FROM facturacion WHERE
                                                      idCajaCierre=$idCaja AND tipoPago ='cheque' AND separada='no'";
    $resultado = mysql_fetch_assoc(mysql_query($sql));  
     return $resultado["valorTotal"];


  }



  //SUMATORIA DE LOS EGRESOS SIN LIQUIDAR
public function valorFacturasProvedorSinLiquidar($vector){

    $sql="SELECT SUM(deudaFacturaProvedor) AS valorTotal 
                                                      FROM  facturasProvedores WHERE
                                                      estadoFactura='credito' AND deudaFacturaProvedor>0";

     $resultado = mysql_fetch_assoc(mysql_query($sql));  
     return $resultado["valorTotal"];

}
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