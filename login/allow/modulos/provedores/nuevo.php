<?php 
require '../../data/libreria.lib/libreria.clases.php';
require '../../data/libreria.lib/70/libreria.class.php';
$datos=$_REQUEST;
extract($datos);
$validar=new validar();
$validar->validando();
$consultaComun=new consultasComunes();
$objHtm=new objetosHtml();
$consulta=new queryAjax();
//Aqui viene el condicional para saber si es empleado del convenio o  es administrador
$datoUsuario=mysql_fetch_array($consultaComun->sqlConvenioAdmin($id));

/*breadcrumb */
$paginaActual=provedor;
$breadcrumb = array(0 => provedor, 1=> nuevoProvedor);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<?php 
//links de librerias  css y javascript
require_once "../../data/comunes/headercode.php";
?>
<link href="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
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
                <h2><i class="fa fa-fort-awesome"></i> <?php  echo nuevoProvedor;?></h2>
             </div>
          </div>
          <!-- Formulario de Punto De Venta -->
      <div class="col-md-12">

          <div class="col-md-12  col-sm-12 col-xs-12">
             <h2 > <i class="fa fa-arrow-both"></i>Traslado de Mercancía e Historicos</h2>
                <section class="m-t-40">
                  <div class="sttabs tabs-style-flip">
                    <nav>
                      <ul>
                        <li><a href="#section-flip-1" class="fa fa-info"><span>Info Básica</span></a></li>
                        <li><a href="#section-flip-2"   class="fa fa-bank"><span>Historico Compras</span></a></li>
                        <li><a href="#section-flip-3"   class="fa fa-tag"><span>Garantías</span></a></li>
                        <li><a href="#section-flip-4"   class="fa fa-money"><span>Cuentas por Pagar</span></a></li>
                        <li><a href="#section-flip-5"   class="fa fa-fort-awesome"><span>Anticipos</span></a></li>
                      </ul>
                    </nav>
                    <div class="content-wrap">
                      <section id="section-flip-1">
                        <h2>Datos Básicos Provedor</h2>
                          <?php
                          require '../../data/comunes/formularios/provedores/datosProvedor.php';
                          ?>
                      </section>
                      <!-- fin de los formularios de traslado de productos-->


                      
                      <section id="section-flip-2">
                        <h2>Historial de Compras</h2>
                          <div id="historialCompras"></div>
                      </section><!-- fin de los historicos de los traslados-->


                      <section id="section-flip-3">
                        <h2>Garantías y Devoluciones</h2>
                          <div id="historialCompras"></div>
                      </section><!-- fin devoluciones-->

                      <section id="section-flip-4">
                        <h2>Cuentas por Pagar</h2>
                          <div id="historialCompras"></div>
                      </section><!-- fin cuentas por pagar-->

                      <section id="section-flip-5">
                        <h2>Anticipos y Notas Crédito</h2>
                          <div id="historialCompras"></div>
                      </section><!-- fin anticipos-->

                    </div><!-- /content -->
                  </div><!-- /tabs -->
                </section>

        </div>























            <!-- DATOS BÁSICOS -->
          
        

      </div>
          <!-- Fin Formulario de punto de venta -->
          

        </div>
    <!-- /.container-fluid -->

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
<script src="<?php echo BASEPATH ?>plugins/bower_components/sweetalert/sweetalert.min.js"></script>



<script src="<?php echo BASEPATH ?>plugins/bower_components/summernote/dist/summernote.min.js"></script>
<script src="<?php echo BASEPATH ?>plugins/bower_components/dropify/dist/js/dropify.min.js"></script>
<script src="<?php echo BASEPATH; ?>js/cbpFWTabs.js"></script>
<script src="<?php echo BASEPATH ?>js/validator.js"></script>
<script src="<?php echo BASEPATH ?>plugins/bower_components/custom-select/custom-select.min.js" type="text/javascript"></script>
<script src="<?php echo PATH ?>js/acciones/validaciones.js" type="text/javascript" charset="utf-8" async defer></script>

<!-- ACCIONES -->

<!-- JQUERYS-->

<script>
   (function() {

                [].slice.call( document.querySelectorAll( '.sttabs' ) ).forEach( function( el ) {
                    new CBPFWTabs( el );
                });

            })();
</script>

</body>
</html>
