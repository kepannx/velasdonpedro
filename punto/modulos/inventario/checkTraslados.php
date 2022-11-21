<?php
require_once '../../data/libreria.lib/libreria.class.php';
$validar=new validar();
$validar->validador();
$consultaComun=new queryComun();
$saveTemp = new saveForms();
$datoUsuario=$consultaComun->datosUsuario($_SESSION['datos']);
?>

<!DOCTYPE html>

<html lang="es">
<head>
<?php 
//links de librerias  css y javascript
require_once "../../data/comunes/headercode.php";

?>

<script src="<?php echo BASEPATH ?>plugins/bower_components/moment/moment.js"></script>
<link href="<?php echo BASEPATH ?>plugins/bower_components/footable/css/footable.core.css" rel="stylesheet">
<link href="<?php echo BASEPATH; ?>plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo BASEPATH ?>plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
</head>
<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"  ></div>
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
      
      <!-- BODY -->
      <div class="row white-box">
        
       <div class="col-md-12  col-sm-12 col-xs-12">
             <h2 > <i class="fa fa-arrow-both"></i>Traslados Pendientes e Historial de Traslados</h2>
                <section class="m-t-40">
                  <div class="sttabs tabs-style-flip">
                    <nav>
                      <ul>
                        <li><a href="#trasladarProuctor" class="sticon ti-time"><span>Traslados Pendientes</span></a></li>
                        <li><a href="#section-flip-4"   class="sticon ti-book"><span>Historial de Traslados</span></a></li>
                      </ul>
                    </nav>
                    <div class="content-wrap">
                      <section id="trasladarProuctor">
                        <h2>Trasladar Productos</h2>
                          <div id="trasladosPendientes"></div>
                         <p align="center"> <i class="fa fa-warning"></i>
                          <strong class="text text-danger"> LOS PRODUCTOS TRASLADADOS TIENEN QUE SER CONFIRMADOS POR EL PUNTO DE DESTINO ANTES DE 6 HORAS! DE LO CONTRARIO NO SE REALIZARÁ EL TRASLADO</strong>
                         </p>
                      </section><!-- fin de los formularios de traslado de productos-->
                      
                      <section id="section-flip-2">
                        <h2>Historial de Traslados</h2>

                      <div class="col-md-12">
                      <div class="col-sm-12 col-md-8">
                          <div class="col-md-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="icon-calender"></i>Busca En Rango de Fechas</span>
                                <input type="text" class="form-control input-daterange-datepicker" id="fechaFiltro" placeholder="<?php echo date('m/d/Y'); ?>-<?php $time= strtotime(date('m/d/Y')); echo date("m/d/Y", strtotime("+1 month", $time)); ?>" value="" readonly />
                            </div>
                           

                        </div>

                      </div>
                      <div class="col-md-4">
                         <div class="col-md-12">
                               <button type="button" id="filtrar" class="btn btn-info col-md-12"><i class="fa fa-filter"></i> Filtrame Este Rángo</button>
                            </div>
                      </div>
                    </div>
                        <div id="historicoTraslados"></div>
                      </section><!-- fin de los historicos de los traslados-->

                    </div><!-- /content -->
                  </div><!-- /tabs -->
                </section>


      </div>
    <!-- FIN BODY -->
      
    </div>
    <!-- FIN CONTENEDOR -->
    <!-- /.container-fluid -->

    <?php 
       require "../../data/comunes/footer.php";
    ?>
  </div>
  <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<?php 
//Links de librerias js 
require "../../data/comunes/js.php" ;
?>
<!-- JS PLUGINGS-->
<script src="<?php echo BASEPATH; ?>plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo BASEPATH ?>plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?php echo BASEPATH; ?>plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="<?php echo PATH; ?>js/acciones/validaciones.js" type="text/javascript" charset="utf-8" async defer></script>



<script src="<?php  echo BASEPATH ?>js/cbpFWTabs.js"></script>
      <script src="<?php echo PATH; ?>js/acciones/customCheckTraslados.js"></script>



<script src="<?php  echo BASEPATH ?>plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>

<!--FIN PLUGIN TABLAS -->
<!-- FIN PLUGIN JS-->
</body>
</html>