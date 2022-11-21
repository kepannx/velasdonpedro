<?php
extract($_REQUEST);
if (isset($usuario) && isset($password)) {
	require  'bkend/libreria.clases.php';
	$conect= new conexion();
	$conn=$conect->conectar();
	$cryp=new encriptacion();
	$usuario= $cryp->encrypt(trim($usuario));
	$password= $cryp->encrypt(trim($password));

	  $sql="SELECT idPunto, usuario,contrasena 
								FROM   puntosVenta WHERE 
								usuario='".$usuario."' 
								AND contrasena='".$password."'
	";
	$query=$conn->query($sql);

	if (mysqli_num_rows($query)==1) {
		# code...
		$rs=mysqli_fetch_array($query, MYSQL_ASSOC);
		session_start();
		$_SESSION['datos']=$cryp->encrypt($rs['idPunto']);
		$_SESSION['token']=crypt($rs['idPunto']);
		$sqlToken='UPDATE puntosVenta SET validacion="'.$_SESSION['token'].'" WHERE idPunto='.$rs["idPunto"].'';
		$conn->query($sqlToken);

		$datos = true;	
	}
	else
	{
		$datos = false;
	}
}
else
{
	$datos = false;
}

echo json_encode($datos);
?>