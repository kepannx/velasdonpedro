<?php 
session_start();
require '../../data/libreria.lib/libreria.clases.php';
$datos=$_REQUEST;
extract($datos);
$validar=new validar();
$validar->validando();
require('../../data/libreria.lib/70/libreria.class.php');

$consultaComun=new consultasComunes();
//Aqui viene el condicional para saber si es empleado del convenio o  es administrador
$datoUsuario=mysql_fetch_array($consultaComun->sqlConvenioAdmin($id));
/*breadcrumb */
$paginaActual=index;
$breadcrumb = array(0 => index );
?>

<!DOCTYPE html>

<html lang="es">
<head>
<?php 
//links de librerias  css y javascript
require_once "../../data/comunes/headercode.php" ;
?>
</head>
<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<div id="wrapper">
  <!-- Navigación -->
  <?php 
    require "../../data/comunes/headerMenu.php";
  ?>
<link href="<?php echo BASEPATH; ?>plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

<link href="<?php echo BASEPATH; ?>plugins/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />

<link href="<?php echo BASEPATH ?>plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">


  <!-- Menu Lateral Izquierdo-->
  <?php 
    require "../../data/comunes/menuLateral.php";
  ?>
  <!-- Fin Menu Lateral Izquierdo-->

  



  <!-- Contenedor de Pagina -->
  <div id="page-wrapper">
    <div class="container-fluid">      
      <!-- breadcrumb -->
      <div class="row bg-title">
        <?php 
          require "../../data/comunes/breadcrumb.php";
        ?>
      </div>
      <!-- Fin breadcrumb -->
    
      <!--Inicio del cuerpo  -->
        <div class="row white-box"> 
          <div class="col-md-12">
            <div class="col-md-12">
              <h3 class="box-title"> <i class="fa fa-list"></i> Lista de Puntos de Venta</h3>
            </div>


                  <div class="col-md-12">
                    <div id="fechaFactura"></div>
                      <div id="listaPuntosVenta"></div>
                  </div>
          </div>
        </div>
      <!-- FIN DEL CUERPO -->

    <?php 
      require "../../data/comunes/footer.php" ;
    ?>
  </div>

</div>
<!-- /#wrapper -->
<!-- jQuery -->
<?php 
//Links de librerias js 
require "../../data/comunes/js.php" ;
?>

<script src="<?php echo BASEPATH ?>plugins/bower_components/moment/moment.js"></script>
<script src="<?php echo BASEPATH ?>plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="<?php echo BASEPATH ?>plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

<script src="<?php echo PATH; ?>js/acciones/customPuntosVenta.js"></script>
<script>
 
</script>
</body>
</html>
