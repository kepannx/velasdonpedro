<?php
$objResponse = new stdClass();

class ingresoProvedores  {

	public function ingresarProvedor($parametros){
		define('CHARSET', 'ISO-8859-1');
		$servername = "localhost";
		$username   = "billWare";
		$password   = "KB2LAwrFN3269wHF";
		$dbname     = "billWare";


		//Objeto para almacenar en el datos
		
		//crear la conexion
		$conn = new mysqli($servername, $username, $password, $dbname);
		extract($parametros);
		$nombreProvedor=$this->filtroStrings($nombreProvedor,2);
		$ideProvedor=$this->filtroStrings($ideProvedor, 1);
		$direccionProvedor=$this->filtroStrings($direccionProvedor, 1);
		$ciudadProvedor=$this->filtroStrings($ciudadProvedor,2);
		$telefonoProvedor=$this->filtroStrings($telefonoProvedor, 2);
		$emailProvedor=$this->filtrarEmail($emailProvedor);
		$contactoProvedor=$this->filtroStrings($contactoProvedor, 1);


		//Consulta sql
		$sql="INSERT INTO provedores SET nombreProvedor='".$nombreProvedor."',
										ideProvedor='".$ideProvedor."',
										direccionProvedor='".$direccionProvedor."',
										ciudadProvedor='".$ciudadProvedor."', 
										emailProvedor='".$emailProvedor."',
										telefonoProvedor='".$telefonoProvedor."', 
										contactoProvedor='".$contactoProvedor."'";

		if ($conn->query($sql) === TRUE) {
			$objResponse->Registrado = 1;
		} else {
			$objResponse->Registrado = 0;
		}

		$conn->close();

		echo json_encode($objResponse);

	}



    //Ingreso servicios y productos










    //Fin del ingreso de servicios y productos





    //Filtro Strings
    private function filtroStrings($parametro, $tipo)
    {
        //tipo[0]=minuscula  [1]=MAYUSCULA [2]=Tipo Oracion

        if ($tipo == 0) {
            //Minúscula
            return mb_convert_case(filter_var($parametro, FILTER_SANITIZE_STRING), MB_CASE_LOWER, 'UTF-8');
        } elseif ($tipo == 1) {
            # MAYÚSCULA...
            return mb_convert_case(filter_var($parametro, FILTER_SANITIZE_STRING), MB_CASE_UPPER, 'UTF-8');
        } elseif ($tipo == 2) {
            # Tipo Oración...
            return mb_convert_case(filter_var($parametro, FILTER_SANITIZE_STRING), MB_CASE_TITLE, 'UTF-8');
        } else {
            //Tipo Oración
            return mb_convert_case(filter_var($parametro, FILTER_SANITIZE_STRING), MB_CASE_TITLE, 'UTF-8');
        }
    }

    //Filtro de numeros

    private function filtroNumerico($parametro)
    {
        if (intval(filter_var($parametro, FILTER_VALIDATE_INT) == true)) {
            return intval($parametro);
        } elseif (intval(filter_var($parametro, FILTER_VALIDATE_INT) == false)) {
            return 0;
        }
    }

    //Filtro con decimal en punto (.)
    private function filtroNumericoDecimal($parametro)
    {
        if (intval(filter_var($parametro, FILTER_SANITIZE_NUMBER_FLOAT) == true)) {
            return intval($parametro);
        } elseif (intval(filter_var($parametro, FILTER_SANITIZE_NUMBER_FLOAT) == false)) {
            return 0;
        }
    }

    //Filtro  todos los emails
    private function filtrarEmail($original_email)
    {
        $original_email = $this->filtroStrings($original_email, 0);
        $clean_email    = filter_var($original_email, FILTER_SANITIZE_EMAIL);
        if ($original_email == $clean_email && filter_var($original_email, FILTER_VALIDATE_EMAIL)) {
            return $original_email;
        }
    }

    //Filtro int
	private function filtroInt($parametro) {
		if (settype($parametro, int) == 1) {
			# code...
			return $parametro;
		} else {
			return NULL;
		}
	}


	
    private function filtrocaracteres($parametro)
    {
        $encontrar = array(
            '.', ',', ' ', '=', '_', ' ', '#', '`:', '+', '-', '(', ')'
        );
        $remplazar = array(
            ''
        );

        return str_ireplace($encontrar, $remplazar, $parametro);
    }

    private function remplazartildesyotros($parametro)
    {
        $encontrar = array(
            'á', 'é', 'í', 'ó', 'ú', ' ', 'ñ', 'Á', 'É', 'Í', 'Ó', 'Ú', 'Ä', 'Ë', 'Ï', 'Ö', 'Ü', 'ä', 'ë', 'ï', 'ö', 'ü', "'"
        );
        $remplazar = array(
            'a', 'e', 'i', 'o', 'u', '_', 'n', 'A', 'E', 'I', 'O', 'U', 'A', 'E', 'I', 'O', 'U', 'a', 'e', 'i', 'o', 'u', ""
        );

        return str_ireplace($encontrar, $remplazar, $parametro);
    }

    public function normalizacionDeCaracteres($parametros)
    {
        return $this->remplazartildesyotros($this->filtrocaracteres(mb_convert_case($parametros, MB_CASE_LOWER, 'UTF-8')));
    }

}
?>