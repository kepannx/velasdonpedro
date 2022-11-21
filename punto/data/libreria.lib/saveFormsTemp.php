<?php
$objResponse = new stdClass();
date_default_timezone_set('america/bogota');
class saveForms  extends conect {

	public function checkExistencias(){

		if (!isset($_SESSION['contador'])) {
  				$_SESSION['contador']=time()+10;
			}
			if ($_SESSION['contador']<(time())) {
				$_SESSION['contador']+10;
				setcookie("invTemp[".$_SESSION['contador']."]", "".(time()*2)."", time()+100);
			}
	}


	//Creo un identificador
	public function guardarIdentificadores(){
			if (isset($_COOKIE['cookie'])) {
    			foreach ($_COOKIE['cookie'] as $name => $value) 
    			{
        				$name = htmlspecialchars($name);
        				$value = htmlspecialchars($value);

        				echo "$name < $value <br />\n";

    			}

		}

	}

public function editarCookie($nombreCookie){
		echo "sss: ".$nombreCookie;
		var_dump();

}



}