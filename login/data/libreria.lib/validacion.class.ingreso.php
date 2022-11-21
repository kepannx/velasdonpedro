<?php
class validar extends conectar
	{
	public function superAdmin($datos)
		{
		conectar::conexiones();
		extract($datos);
		//Filtro los datos enviados desde los campos de texto
		$u_ser=filter_var($usuario,FILTER_SANITIZE_SPECIAL_CHARS);
		$p_sword=filter_var($contrasena, FILTER_SANITIZE_SPECIAL_CHARS);
		//hago la consulta del sql
		$rs=mysql_fetch_array($this->consultaadmin($u_ser,$p_sword));

		if(isset($rs[0]))
			{


			session_start();
			
			$token=$_SESSION["autenticar"]=$this->token(rand(23,88),TRUE,TRUE,FALSE);
			//Si el usuario y la contraseña son correctas, ingresar el token de validación.
			if($this->ingresotoken($token,$rs[0],$this->conexion)=="ok")
				//si el token se genera y se guarda con éxito, envieme a la pagina del panel.
				{
				$_SESSION['datos']=$this->encrypt($rs[0], key);
				$done="allow/";
				header('Location: '.$done.'');
				}
			
			}
		else
			{
			//Si el usuario y la contraseña no son correctas,  VALIDEME SI ES UN  SUPERTECNICO, TECNICO O ASESOR.
			//$this->usuario($datos);
			echo '<div style="width:100%; height:40px; background-color:#ba0505; color:#fff; font-size:20px; text-align:center; padding:5px; ">Ops! algo anda mal con tu usuario o contraseña :/ </div>';
			}


		conectar::desconectar();
		}
	
	

		
	
	
	//Selecciona y  filtra  los usuarios a partir de  su usuario y contrasena
	public function consultaadmin($u_ser,$p_sword)
		{
			conectar::conexiones();
		   $sql="SELECT * FROM usuarios WHERE usuario='".$this->encrypt($u_ser, key)."' AND contrasena='".$this->encrypt($p_sword, key)."'";
		  return mysql_query($sql);

		  conectar::desconectar();
		}
		
		
	
	
	
	//ingreso la llave al administrador que acaba de iniciar sesion
	private function ingresotoken($token,$id, $conexion)
		{
		$sql="UPDATE usuarios SET validacion='".$token."', ipReal='".$this->getRealIP()."'  WHERE idusuario='".mysql_real_escape_string($id)."'";
		if(mysql_query($sql,$conexion)){return "ok";} else { echo "no";};
		}
	
	



	//VALIDACION DE USUARIOS QUE NO SON ADMINISTRADOR
	
	
	//Generador  de token
private function token()
		{
		session_start();
		return hash("sha256",session_id());
		}
	


//Obtengo la direccion ip mas  real posible de la conexion	
public function getRealIP()
{
 
   if( $_SERVER['HTTP_X_FORWARDED_FOR'] != '' )
   {
      $client_ip = 
         ( !empty($_SERVER['REMOTE_ADDR']) ) ? 
            $_SERVER['REMOTE_ADDR'] 
            : 
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ? 
               $_ENV['REMOTE_ADDR'] 
               : 
               "unknown" );
 
      // los proxys van añadiendo al final de esta cabecera
      // las direcciones ip que van "ocultando". Para localizar la ip real
      // del usuario se comienza a mirar por el principio hasta encontrar 
      // una dirección ip que no sea del rango privado. En caso de no 
      // encontrarse ninguna se toma como valor el REMOTE_ADDR
 
      $entries = preg_split('/[, ]/', $_SERVER['HTTP_X_FORWARDED_FOR']);
 
      reset($entries);
      while (list(, $entry) = each($entries)) 
      {
         $entry = trim($entry);
         if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list) )
         {
            // http://www.faqs.org/rfcs/rfc1918.html
            $private_ip = array(
                  '/^0\./', 
                  '/^127\.0\.0\.1/', 
                  '/^192\.168\..*/', 
                  '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/', 
                  '/^10\..*/');
 
            $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);
 
            if ($client_ip != $found_ip)
            {
               $client_ip = $found_ip;
               break;
            }
         }
      }
   }
   else
   {
      $client_ip = 
         ( !empty($_SERVER['REMOTE_ADDR']) ) ? 
            $_SERVER['REMOTE_ADDR'] 
            : 
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ? 
               $_ENV['REMOTE_ADDR'] 
               : 
               "unknown" );
   }
 
   return $client_ip;
 
}
		

	}

 ?>