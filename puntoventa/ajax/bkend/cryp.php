<?php 
class encriptacion  {
public function encrypt($string) {
		$result = '';
		for ($i = 0; $i < strlen($string); $i++) {
			$char    = substr($string, $i, 1);
			$keychar = substr(key, ($i%strlen(key))-1, 1);
			$char    = chr(ord($char)+ord($keychar));
			$result .= $char;
		}
		return base64_encode($result);
	}



//Filtro Emails
public function filtrarEmail($original_email)
	{
	  $original_email=$this->filtroStrings($original_email, 0);
	  $clean_email = filter_var($original_email,FILTER_SANITIZE_EMAIL);
	  if ($original_email == $clean_email && filter_var($original_email,FILTER_VALIDATE_EMAIL))
	  {
	  return $original_email;
	  }

}

}
define(key, "SpufraK3858EpechUkU4rajAjuWrapRapH3hep6desebrekeb2crux6c87hEsA3rned4EwredRaPr2B7t5ekega2a73xupen");
?>