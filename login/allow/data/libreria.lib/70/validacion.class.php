<?php
$objResponse = new stdClass();
date_default_timezone_set('america/bogota');
class validar extends conect


	{
	public function validador(){

		session_start();
		$kick=BASEPATH.'login/';
		if (sizeof($_SESSION['datos'])== 0) {

			header('Location:'.$kick);
		}
		else{
			$id=$this->decrypt($_SESSION['datos'], key);//Desencripto el ID
			$conn=$this->conectar();
    			$sql = "SELECT validacion FROM  puntosVenta  where  idPunto =  '".$id."' ";
    			$query=$conn->query($sql);
    			if (mysqli_num_rows($query)==0) {
    				# no valida el token...
    				session_destroy();
					header('Location:'.$kick);
    			}
		}
	}

	//Verifica si cuando me entra a la hoja de un perfil de punto de venta o cliente etc pase un parametro válido para consultar, si no lo saca.
	public function validarIdPerfilaciones($parametro){
		if ($this->filtroNumerico($this->decrypt($parametro, publickey))===0) {
  				$this->logOut();
  			}
	}

	//LogOut

	public function logOut(){
		session_start();
		session_destroy();
		$kick=BASEPATH.'/puntoventa/';
		header('Location:'.$kick);
	}



	

}
?>