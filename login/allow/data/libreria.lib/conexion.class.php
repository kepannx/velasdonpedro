<?php 
class conectar
{
	
		protected $nombre;
		protected $usuario;
		protected $pass;
		protected $base;
		protected $conexion;
	

	function  __construct()
		{
		
		$this->nombre ="localhost";
		$this->usuario= "bWDigital"; //SuperAdministrador
		$this->pass ="DYFUNszt4yX5frmS";
		$this->base = "billware_digital";
		
		
		}

	public function conexiones()
		{
		$this->conexion=mysql_connect($this->nombre,$this->usuario,$this->pass);
		mysql_select_db($this->base,$this->conexion);
		}
	public function desconectar(){
		
		mysql_close($this->conexion);
		}
	




//Datos Pagina
		public function datospagina($vector)
		{
		conectar::conexiones();


		$sql='SELECT * FROM datosEmpresa';
		$query=mysql_query($sql,$this->conexion);
		$rs=mysql_fetch_array($query);
			switch($vector)
				{
					case 0:
					return $rs['nombreEmpresa'];
					break;
					
					case 1:
					return $rs['direccionEmpresa'];
					break;
					
					case 2:
					return $rs['telefonosEmpresa'];
					break;
					
					case 3:
					return $rs['emailEmpresa'];
					break;
					
					case 4:
					return $rs['identificacionTributaria'];
					break;

					case 5:
					return "http://".$_SERVER['HTTP_HOST']."/".url."login/allow/";
					break;

					case 7: //Logo de la empresa
					return $rs['logoEmpresa'];
					break;

					case 8:
					return $rs['terminosCondicionesFactura'];
					break;
					

					case 9:
					return "http://".$_SERVER['HTTP_HOST']."/".url.""; //Esta es ubicación raiz
					break;

					case 10:
						# code...
						return $rs['terminosCondicionesFactura'];
						break;

					case 11:
						# code...
						return $rs['representanteEmpresa'];
						break;

					case 12:
						# code...
						return $rs['maximoUsuarios'];
						break;

					case 13:
						# code...
						return $rs['maximoPuntosVenta'];
						break;

					

				
				}

		
		conectar::desconectar();
		}






//saco los avisos de confirmación o  error  
public function avisos($tipo, $mensaje)
{
	if ($tipo=="done") {
		echo '<div class="alert alert-success" id="noPrint" align="center" style="font-size:18px;">'.$mensaje.'</div>';
		# code...
	}
	elseif ($tipo=="aviso") {
		# code...
		echo '<div class="alert alert-warning" role="alert" align="center" style="font-size:18px;"> <i class="fa fa-exclamation-circle"></i> '.$mensaje.'</div>';
	}
	elseif ($tipo=="error") {
		# code...
		echo '<div class="alert alert-danger" id="noPrint" align="center" style="font-size:18px;">'.$mensaje.'</div>';
	}
	else
	{
		echo '<div class="alert alert-danger" id="noPrint" align="center" style="font-size:18px;">'.$mensaje.'</div>';
	}
}



//Registro los errores en un archivo  .log oculto
public function errorLog($parametro)
{
	$fecha=date("Y-m-d h:m:i");
	$file=fopen("".dirname(__DIR__)."/.errorLog.log","a");
	$error="Error: ".$parametro."-Presentado el:".$fecha."-Desde:".$_REQUEST["id"]."| ";
	fputs($file,$error); 
	fclose($file); 
}



//Averiguo cuantos usuarios tiene creado

public function checkNumeroUsuarios(){
  $sql="SELECT idusuario, activada FROM usuarios WHERE activada = 'si'";
  return mysql_num_rows(mysql_query($sql));
}




//Encriptar

	//ENCRIPTO INFORMACION
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

	//desencripto el parametro
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


}
define(key, "SpufraK3858EpechUkU4rajAjuWrapRapH3hep6desebrekeb2crux6c87hEsA3rned4EwredRaPr2B7t5ekega2a73xupen");
define(publickey, "5663284166397124291158310398993993");
define(url, "billware/");


?>