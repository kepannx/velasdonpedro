<?php
class conexion  {
	public function conectar()
	{
		//CONEXIÓN PARA INGRESO DE LOS USUARIOS
		define('CHARSET', 'ISO-8859-1');
		$servername = "localhost";
    	$username   = "bWDigital";
    	$password   = "DYFUNszt4yX5frmS";
    	$dbname     = "billware_digital";

		return $conn = new mysqli($servername, $username, $password, $dbname);
	}
}
?>