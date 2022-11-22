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
		$this->base = "billware_velas";


		}

	public function conexiones()
		{
		$this->conexion=mysql_connect($this->nombre,$this->usuario,$this->pass);
		mysql_select_db($this->base,$this->conexion);
		}
	public function desconectar(){

		mysql_close($this->conexion);
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
define(url, "donpedro/login");


?>
