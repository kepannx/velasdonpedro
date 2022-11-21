<?php
require('data/libreria.lib/libreria.clases.php');
$datos=$_REQUEST;
extract($_REQUEST);
if(isset($usuario))
  {
    $validar=new validar();
    $validar->superAdmin($datos);
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="codream software cloud solution">
<link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
<title><?php echo titulo; ?></title>
<!-- Bootstrap Core CSS -->
<link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- animation CSS -->
<link href="../css/animate.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="../css/style.css" rel="stylesheet">


</head>
<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="login-register login-register-superAdmin">
  <div class="login-box">
    <div class="white-box">
      <form class="form-horizontal form-material" id="loginform" action="" method="POST">
        <h3 class="box-title m-b-20">Ingresar</h3>
        <div class="form-group ">
          <div class="col-xs-12">
            <input class="form-control" name="usuario" type="text" required="" placeholder="¿Cuál es tu usuario?">
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" name="contrasena" type="password" required="" placeholder="Ahora necesito tu contraseña">
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">

            <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i>Olvidaste Tu Contraseña? </a> </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Listo! Valídame</button>
          </div>
        </div>


      </form>
      <form class="form-horizontal" id="recoverform" action="index.html">
        <div class="form-group ">
          <div class="col-xs-12">
            <h3>Recuperar Mi Contraseña</h3>
            <p class="text-muted">Dame el número de celular que tienes  registrado para mandarte la contraseña allí</p>
          </div>
        </div>
        <div class="form-group ">
          <div class="col-xs-12">
            <input class="form-control" type="number" required="" placeholder="Dame el número de celular que tienes registrado">
          </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Enviame La contraseña</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
<script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
<script src="../js/jquery.slimscroll.js"></script>
<script src="../js/custom.min.js"></script>
</body>
</html>
