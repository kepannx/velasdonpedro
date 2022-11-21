<?php 
require('../../data/libreria.lib/libreria.clases.php');
require('../../data/libreria.lib/contabilidad/libreria.clases.php');

$datos=$_REQUEST;
extract($datos);
$validar=new validar();
$validar->validador($id);

$consultaComun=new consultasComunes();
$consultaContable=new consultaContabilidad();
//Aqui viene el condicional para saber si es empleado del convenio o  es administrador
$datoUsuario=mysql_fetch_array($consultaComun->sqlConvenioAdmin($id));

/*breadcrumb */
$paginaActual=cajas;
$breadcrumb = array(0 => index, 1 => misBancos);
?>

<!DOCTYPE html>

<html lang="es">
<head>
<?php 
//links de librerias  css y javascript
require_once("../../data/comunes/headercode.php");
?>
<!-- CSS PLUGIN sweet alert -->
    <link href="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
      <!-- CSS-->
    <link href="<?php echo BASEPATH ?>plugins/bower_components/typeahead.js-master/dist/typehead-min.css" rel="stylesheet">
</head>



<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<div id="wrapper">
  <!-- Navigación -->
  <?php 
    require("../../data/comunes/headerMenu.php");
  ?>


  <!-- Menu Lateral Izquierdo-->
  <?php 
    require("../../data/comunes/menuLateral.php");
  ?>
  <!-- Fin Menu Lateral Izquierdo-->

  



  <!-- Contenedor de Pagina -->
  <div id="page-wrapper">
    <div class="container-fluid">
      
      
      <!-- breadcrumb -->
      <div class="row bg-title">
        <?php 
          require("../../data/comunes/breadcrumb.php");
        ?>
      </div>

      <!-- Fin breadcrumb -->
      

      <!--Inicio del cuerpo  -->
        
        <div class="row" data-toggle="validator">
          <div class="col-md-12 white-box">
            


            <div class="col-md-12">
            <div class="col-md-6">
              <h2><i class="fa fa-bank"></i> <?php echo misBancos ?></h2>
            </div>


            <div class="col-md-6" align="right">
              
                <button class="btn btn-success waves-effect waves-light" id="crearUsuario" type="button" data-toggle="modal" data-target="#creacionBancos"><span class="btn-label"><i class="fa fa-bank"></i></span>¿Necesitas Crear Otro Banco?</button>
               
            </div>  




            </div>




            
             <div class="panel-body">
              Puedes ingresar nuevos bancos o buscar alguno creado y acceder a ellos para visualizar sus movimientos
             </div>
          <div class="col-md-12" align="center">
            <h1>
               <hr>
              <i class="fa fa-list"></i> Lista de los Bancos Registrados</h1>
          </div>

          <?php
              $consultaComun->listaBancos();
          ?>

         
        </div>
      
      <!-- Fin del cuerpo-->

      
    </div>
    <!-- /.container-fluid -->

    <?php 
      require("../../data/comunes/footer.php");
      require("../../data/comunes/modal/contabilidad/guardarBancos.php");
    ?>
  </div>
  <!-- /#page-wrapper -->
</div>

  
<!-- /#wrapper -->
    <script src="<?php echo PATH ?>js/guardar/nuevoBanco.js" type="text/javascript" charset="utf-8" async defer></script>

    <script src="<?php echo BASEPATH ?>js/validator.js"></script>
      <!-- sweer alerts-->
    <script src="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>

<!-- jQuery -->
<script src="<?php echo PATH ?>js/custom.js"></script>
<?php 
//Links de librerias js 
require("../../data/comunes/js.php");
?>

 

</body>
</html>
