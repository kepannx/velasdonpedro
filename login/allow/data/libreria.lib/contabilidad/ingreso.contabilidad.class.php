<?php
class ingresoContabilidad extends conectar {


/***************consultas clientes */

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




/***************consultas de productos */
public function consultaDatosProducto($parametro, $vector)
{
  conectar::conexiones();
  $productosConvenioId=$this->filtroNumerico($parametro);
  $sql="SELECT *  FROM productosConvenio WHERE productosConvenioId='".$productosConvenioId."'";
  $query=mysql_query($sql);
  $rs=mysql_fetch_array($query);
  

  switch ($vector) {


    case 'productosConvenioNombre':
      # code...
      return $rs["productosConvenioNombre"];
      break;


    case 'productosConvenioValor':
      # code...
      return $rs["productosConvenioValor"];
      break;

    case 'productosConvenioMinimo':
      # code...
      return $rs["productosConvenioMinimo"];
      break;

    case 'productosConvenioProductoReceta':
      # code...
      return $rs["productosConvenioProductoReceta"];
      break;


    case 'productoConvenioMedida':
      return $rs["productoConvenioMedida"];
      break;

    case 'convenioId':
      # code...
      return $rs["convenioId"];
      break;
    
    default:
      # code...
      return "No hay datos :(";
      break;
  }

  conectar::desconectar();
}





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




//*******************************CAJAS****************************************//

//Control de apertura de caja
public  function BotonAperturaCaja($id)
{

  //Te digo si hay una caja abierta o  no
  $convenioId=$this->decrypt($id, key);

    $sql="SELECT * FROM  cajas where estado= '1' ";
    $query=mysql_query($sql);
    if (mysql_num_rows($query)==0) {
      # code...
      echo '
          <div class="col-md-12">
            <button class="btn btn-block btn-info" data-toggle="modal" data-target="#aperturaCaja"  >Necesitas Abrir Caja Primero</button>
            <br>
          </div>
          ';

    }
    else
    {

    }

}








/************************GASTOS*****************************/

public function ingresoGastos($parametros)
{
  extract($parametros);
  $gastoConvenioNombre=$this->filtroStrings($gastoConvenioNombre, 2);
  $gastoConvenioCaja=$this->filtroNumerico($gastoConvenioCaja);
  $gastoConvenioNumeroComprobante=$this->filtroNumerico($gastoConvenioNumeroComprobante);
  $gastoConvenioValor=$this->filtroNumerico($this->normalizacionDeCaracteres($gastoConvenioValor));
  $convenioId=$this->filtroNumerico($this->decrypt($id, key));
  $sql="INSERT INTO gastoConvenio SET gastoConvenioNombre='".$gastoConvenioNombre."', 
                                      gastoConvenioValor='".$gastoConvenioValor."',
                                      gastoConvenioFecha='".fechaActualFija."',
                                      gastoConvenioCaja='".$gastoConvenioCaja."',
                                      gastoConvenioLiquidadoEnCaja='1',
                                      convenioId='".$convenioId."',
                                      gastoConvenioNumeroComprobante='".$gastoConvenioNumeroComprobante."',
                                      break='".$break."'";
  if (mysql_query($sql)) {
    # code...
    return 1;
  }
  else
  {
    $this->errorLog("02-00-03-00"); //Error al ingresar el gasto
    return 0;
  }

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



private function recetaProductoNombre($itemConvenioProducto, $itemConvenioTipo)
{
  if($itemConvenioTipo==1)
  {
   
    return $this->consultaDatosProducto($itemConvenioProducto, "productosConvenioNombre");
  }
  elseif ($itemConvenioTipo==2) {
    # code...

   return  $this->consultaDatosRecetas($itemConvenioProducto, "recetasConvenioNombre");
  }
}
//Averigui el número  siguiente de la factura

private function proximaNumeroFactura($convenioId)
{
    $convenioId=$this->decrypt($convenioId, key);
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




//Retorno en string el estado de la factura

public  function analizarEstadoFactura($parametro)
{
    if($parametro==1)
    {
        return "Pagado";
    }
    elseif ($parametro==2) {
        # code...
        return "Crédito";
    }
    elseif ($parametro==3) {
        # code...
        return "Anulada";
    }
}



//Cálculo la existencia de un producto en el punto de venta.
public  function cantidadesExistentesPuntoDeVenta($productoId)
{

 echo $sql="SELECT SUM(productosTrasladosExistenciaActual) AS cantidadesExistentes 
                                                      FROM productosTraslados WHERE
                                                      productoId='".$this->filtroNumerico($productoId)."'"; //METER AQUI EL BETWEN
 $resultado = mysql_fetch_assoc(mysql_query($sql));  
  return $resultado["cantidadesExistentes"];

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