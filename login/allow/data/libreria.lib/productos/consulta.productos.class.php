<?php
class consultaProductos extends conectar {



/*SQL DE PRODUCTOS*/
public  function sqlProductos($idProducto){
conectar::conexiones();
$idProducto=$this->decrypt($idProducto, publickey);
$sql="SELECT * FROM PRODUCTOSERVICIOS WHERE idproductosServicios='".$idProducto."' AND idproductosServicios!=0";
return  mysql_query($sql);
conectar::desconectar();
}





//Asocio a  receta

public function asocioReceta($idProducto)
{
  conectar::conexiones();
  $sql="SELECT productosConvenioId FROM itemReceta WHERE productosConvenioId='".intval($idProducto)."'";
  return mysql_num_rows(mysql_query($sql));
  conectar::desconectar();
}






//******************************[HISTORIAL DE TRASLADOS DE UN PRODUCTO]*********************************/

public function historicosTraslados($productoId)
{
  conectar::conexiones();
  //Saco los traslados hechos hacia el punto de venta
        $sqlTrasladosAPuntoVenta="SELECT productoId, convenioId, productosTrasladosFechaTraslado, productosTrasladosUnidadesTrasladadas FROM productosTraslados WHERE productoId='".$this->filtroNumerico($productoId)."'
    ";

    //Saco los traslados hechos hacia la bodega
      $sqlTrasladosABodega="SELECT productoId, inventarioConvenioRetraslado, inventarioConvenioFecha, inventarioConvenioCantidadComprada FROM inventarioConvenio 
                                          WHERE productoId='".$this->filtroNumerico($productoId)."' AND inventarioConvenioRetraslado=1";
    


  
    $queryPuntoVenta=mysql_query($sqlTrasladosAPuntoVenta);
    $queryBodega=mysql_query($sqlTrasladosABodega);

    $par=0;
    $impar=1;
    $bucket= array();
    $bucket2= array();

  while ($rs=mysql_fetch_array($queryPuntoVenta)) {
    # code...
     
         $bucket[$par]="'-".$rs["productosTrasladosFechaTraslado"]."-".$rs["productosTrasladosUnidadesTrasladadas"]."-Bodega-Punto De Venta";
        $par++;
  }

   while ($rsBodega=mysql_fetch_array($queryBodega)) {
      # code...

         $bucket[$par]="1-".$rsBodega["inventarioConvenioFecha"]."-".$rsBodega["inventarioConvenioCantidadComprada"]."-Punto de Venta-Bodega";
  
      $par++;
    }

   $t=sizeof($bucket);
   $n=0;
  
   echo '<div class="table-responsive">';
    echo '<table id="historialTraslados" class="display nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Fecha del Traslado</th>
                                    <th>Cantidad</th>
                                    <th>Origen</th>
                                    <th>Destino</th>
                                    
                                </tr>
                            </thead>
    ';

    echo '<tbody>';


   // echo $this->listaTraslados($n, $t, $bucket);
   while ($t>$n) {
      # code...
      $rs=explode("-", $bucket[$n]);
       echo '
                                <tr>
                                    <td>'.$this->fechaHumana(date("Y-m-d",$rs[1])).'</td>
                                    <td>'.$rs[2].'</td>
                                    <td>'.$rs[3].'</td>
                                    <td>'.$rs[4].'</td>
                                </tr>
                               
                            <br>
                      ';
    $n++;
    }
 

    echo ' </tbody>';

         echo '</table>';

         echo '</div>';
conectar::desconectar();

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