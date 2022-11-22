<?php
class conect {
	public function conectar()
		{
			define('CHARSET', 'ISO-8859-1');
			  $servername = "localhost";
        $username   = "bWDigital";
        $password   = "DYFUNszt4yX5frmS";
        $dbname     = "billware_velas";

			return $conn = new mysqli($servername, $username, $password, $dbname);
		}

  
  
	public function decrypt($string, $key) {
		$result = '';
		$string = base64_decode($string);
		for ($i = 0; $i < strlen($string); $i++) {
			$char    = substr($string, $i, 1);
			$keychar = substr($key, ($i%strlen($key))-1, 1);
			$char    = chr(ord($char)-ord($keychar));
			$result .= $char;
		}
		return $result;
	}


	public function encrypt($string, $key) {
		$result = '';
		for ($i = 0; $i < strlen($string); $i++) {
			$char    = substr($string, $i, 1);
			$keychar = substr($key, ($i%strlen($key))-1, 1);
			$char    = chr(ord($char)+ord($keychar));
			$result .= $char;
		}
		return base64_encode($result);
	}


	/*FILTROS*/


//Filtro Strings
public function filtroStrings($parametro, $tipo)
{
  //tipo[0]=minuscula  [1]=MAYUSCULA [2]=Tipo Oracion

  if($tipo==0)
  {
    //Minúscula
    return mb_convert_case(filter_var(strip_tags($parametro), FILTER_SANITIZE_STRING), MB_CASE_LOWER , "UTF-8");
  }
  elseif ($tipo==1) {
    # MAYÚSCULA...
    return mb_convert_case(filter_var(strip_tags($parametro), FILTER_SANITIZE_STRING), MB_CASE_UPPER , "UTF-8");
  }
  elseif ($tipo==2) {
    # Tipo Oración...
    return mb_convert_case(filter_var(strip_tags($parametro), FILTER_SANITIZE_STRING), MB_CASE_TITLE , "UTF-8");
  }
  else
  {
    //Tipo Oración
    return mb_convert_case(filter_var(strip_tags($parametro), FILTER_SANITIZE_STRING), MB_CASE_TITLE , "UTF-8");
  }
}

//Filtro con decimal en punto (.) 
public function filtroNumericoDecimal($parametro)
{
  
  if(intval(filter_var(strip_tags($parametro), FILTER_SANITIZE_NUMBER_FLOAT)==TRUE))
  {
    return $parametro;
  }
  elseif(intval(filter_var(strip_tags($parametro), FILTER_SANITIZE_NUMBER_FLOAT)==FALSE))
  {
    return 0;
  }

}


public  function normalizacionDeCaracteres($parametros)
{

  return $this->remplazartildesyotros($this->filtrocaracteres(mb_convert_case(strip_tags($parametros), MB_CASE_LOWER , "UTF-8")));

}

public  function remplazartildesyotros($parametro) {
    $encontrar = array("á", "é", "í", "ó", "ú", " ", "ñ", "Á", "É", "Í", "Ó", "Ú", "Ä", "Ë", "Ï", "Ö", "Ü", "ä", "ë", "ï", "ö", "ü");
    $remplazar = array("a", "e", "i", "o", "u", "_", "n", "A", "E", "I", "O", "U", "A", "E", "I", "O", "U", "a", "e", "i", "o", "u");
    return str_ireplace($encontrar, $remplazar, $parametro);
  }
public  function filtrocaracteres($parametro){
      $encontrar    = array( ".", ",", " ", "=", "_"," ", "#","`:","+", "-", "(", ")");
      $remplazar = array( "");
      return str_ireplace($encontrar, $remplazar,strip_tags($parametro));
  
}


public function filtroNumerico($parametro)
{
  if(intval(filter_var($parametro, FILTER_VALIDATE_INT)==TRUE))
  {
    return strip_tags($parametro);
  }
  elseif(intval(filter_var(strip_tags($parametro), FILTER_VALIDATE_INT)==FALSE))
  {
    return 0;
  }
}


//[REFORMATEO LA ESTRUCTURA INICIAL DE LA FECHA PASADA  EN M/D/Y A  Y-M-D]
public function formatoFecha($parametro)
{

  $f=explode(' ',$parametro);
  if (sizeof($f)==1) {
  	$fecha=explode("/", $f[0]);
  	return $fecha[2].'-'.$fecha[0].'-'.$fecha[1]; //[retorno fecha Y-M-D formato sql]
  }else{
  	$fecha=explode("/", $f[1]);
  	return $fecha[2].'-'.$fecha[0].'-'.$fecha[1]." ".$f[1]; //[retorno fecha Y-M-D :00:00:00 formato sql]
  }
  
}


public function formatoFecha2($parametro){
$parametro=trim($parametro);
$fecha=explode('/', $parametro);
return $fecha[2].'-'.$fecha[0].'-'.$fecha[1];

}

public function comillaSimplePorGuion($parametro){
      $encontrar    = array( "'", "'", "&#39;");
      $remplazar = array( "-", "-", "-");
      return str_ireplace($encontrar, $remplazar,$parametro);
}

public  function espacioPorGuion($parametro){
      $encontrar    = array( " ");
      $remplazar = array( "_");
      return str_ireplace($encontrar, $remplazar,$parametro);
  
}

public  function espacioPorNada($parametro){
      $encontrar    = array( " ");
      $remplazar = array( "");
      return str_ireplace($encontrar, $remplazar,$parametro);
  
}


//Defino cual de los option select es el elegido como predeterminado según el parametro que le pase
	public function selected($parametro, $value)
	  {
	    if($parametro==$value)
	    {
	      return 'selected="select"';
	    }
	    else
	    {
	      return '';
	    }
	  }



	//Me checkea o   descheckea los parametros
	  public function selectedCheckbox($parametro)
	  {
	    if($parametro=='no')
	    {
	      return '';
	    }
	    else if ($parametro=='si') 
	    {
	      return 'checked';
	    }
	  }





//Me pone circulo rojo o verde segun el parametro que le envien
public function alertaCirculo($parametro){
	if ($parametro=='si') {
		return '<i class="fa fa-circle text-info"></i>';
	}elseif ($parametro=='no') {
		return '<i class="fa fa-circle text-danger"></i>';
	}
}

//registrar log
public function write_log($cadena,$tipo)
{
  $arch = fopen("logs/.biiWareLog_".date("Y-m-d")."", "a+"); 

  fwrite($arch, "[".date("Y-m-d H:i:s")." ".$_SERVER['REMOTE_ADDR']." ".
                   $_SERVER['HTTP_X_FORWARDED_FOR']." - $tipo ] ".$cadena."\n");
  fclose($arch);
}

	
}
?>