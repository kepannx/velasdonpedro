<?php 
require '../../data/libreria.lib/libreria.clases.php';
$datos=$_REQUEST;
extract($datos);
$validar=new validar();
$validar->validando();
require '../../data/libreria.lib/70/libreria.class.php';
$consultaComun=new consultasComunes();
$objHtm=new objetosHtml();
$consulta=new queryAjax();
//Aqui viene el condicional para saber si es empleado del convenio o  es administrador
$datoUsuario=mysql_fetch_array($consultaComun->sqlConvenioAdmin($_SESSION['datos']));
/*breadcrumb */
$paginaActual=puntosVenta;
$breadcrumb = array(0 => puntosVenta, 1=> nuevoPuntoVenta );
?>

<!DOCTYPE html>
<html lang="es">
<head>
<?php 
//links de librerias  css y javascript
require_once "../../data/comunes/headercode.php";
?>
<link href="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo BASEPATH ?>plugins/bower_components/dropify/dist/css/dropify.min.css">
<link href="<?php echo BASEPATH ?>plugins/bower_components/summernote/dist/summernote.css" rel="stylesheet" />
<link href="<?php echo BASEPATH ?>plugins/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" />
<link href="<?php echo BASEPATH ?>plugins/bower_components/custom-select/custom-select.css" rel="stylesheet" type="text/css" />

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
             <div class="col-md-6">
                <h2><i class="fa fa-fort-awesome"></i> <?php  echo nuevoPuntoVenta;?></h2>
             </div>
          </div>
          <!-- Formulario de Punto De Venta -->
      <div class="col-md-12">
            <!-- DATOS BÁSICOS -->
          <div class="col-md-12">
            <h3><i class="fa fa-info-circle"></i>Información Básica Del Punto</h3>
          </div>

        <form name= "formObj" data-toggle="validator">
              <?php include '../../data/comunes/formularios/puntosVenta/formularioDatosBasicos.php'; ?>
          <!-- FIN DATOS BÁSICOS -->
          <div class="col-md-12">
            <hr>
            <h3><i class="fa fa-legal"></i>Información Tributaria  Y De Facturación Del Punto</h3>
          </div>
        <!-- DATOS TRIBUTARIOS -->
          <?php include '../../data/comunes/formularios/puntosVenta/formularioInformacionTributaria.php'; ?>
        <!-- FIN DE DATOS TRIBUTARIOS-->

        <input type="hidden" id="id" value="<?php echo $id; ?>">
        

        <div class="col-md-12" align="center">
          <button class="btn btn-success waves-effect waves-light " id="confirmaDatos"
              data-toggle="modal" data-target="#confirmaDatosPuntoVenta" type="submit">
              <span class="btn-label"><i class="fa fa-save"></i></span>Guardardame El Punto</button>
        </div>
      
        </form>
        

      </div>
          <!-- Fin Formulario de punto de venta -->
          

        </div>
    <!-- /.container-fluid -->

    <?php 
      require "../../data/comunes/footer.php" ;
      require "../../data/comunes/modal/confirmaciones/confirmacionDatosPuntoVenta.html";
    ?>
  </div>

</div>
<!-- /#wrapper -->
<!-- jQuery -->
<?php 
//Links de librerias js 
require "../../data/comunes/js.php" ;
?>
<script src="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>



<script src="<?php echo BASEPATH ?>plugins/bower_components/summernote/dist/summernote.min.js"></script>
<script src="<?php echo BASEPATH ?>plugins/bower_components/dropify/dist/js/dropify.min.js"></script>
<script src="<?php echo BASEPATH ?>js/validator.js"></script>
<script src="<?php echo BASEPATH ?>plugins/bower_components/switchery/dist/switchery.min.js"></script>
<script src="<?php echo BASEPATH ?>plugins/bower_components/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo BASEPATH ?>plugins/bower_components/custom-select/custom-select.min.js" type="text/javascript"></script>
<script src="<?php echo PATH ?>js/acciones/validaciones.js" type="text/javascript" charset="utf-8" async defer></script>
<script type="text/javascript" src="<?php  echo $consultaComun->datosPagina(5)?>js/jquery.form.min.js"></script>

<!-- ACCIONES -->
<script src="<?php echo PATH ?>js/acciones/compararNitIdentificacion.js" type="text/javascript" charset="utf-8" async defer></script>
<script src="<?php echo PATH ?>js/acciones/compararUsernames.js" type="text/javascript" charset="utf-8" async defer></script>


<script src="<?php echo PATH ?>js/acciones/confirmacionPuntoVenta.js" type="text/javascript" charset="utf-8" async defer></script>
<script src="<?php echo PATH ?>js/guardar/guardarPuntoVenta.js" type="text/javascript" charset="utf-8" async defer></script>

<!-- JQUERYS-->
<script>
     jQuery(document).ready(function(){

        $('.summernote').summernote({
            height: 220,                 
            minHeight: null,             
            maxHeight: null,          
            focus: false                 
        });
        $('.dropify').dropify();
        $(".ciudades").select2();
        $(".departamentos").select2();
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());

        });

      });
</script>
</body>
</html>
