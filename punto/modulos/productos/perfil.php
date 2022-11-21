<?php
require_once '../../data/libreria.lib/libreria.class.php';
extract($_REQUEST);
$validar=new validar();
$validar->validador();
$validar->validarIdPerfilaciones($idP);
$consultaComun=new queryComun();
$consulta=new queryAjax();
$objHtm=new objetosHtml();
$datoUsuario=$consultaComun->datosUsuario($_SESSION['datos']);
$datosProductoServicio=$consulta->datosProductoServicio($idP);
$_SESSION['idProductoServicio']=$idP;
$paginaActual=productosServicios;
$breadcrumb = array(0 => productosServicios, 1=>detalleProducto );
?>
<!DOCTYPE html>
<html lang="es">
<head>
<?php 
    require_once "../../data/comunes/headercode.php";
?>
<link href="<?php echo BASEPATH; ?>plugins/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" />
<link href="<?php echo BASEPATH; ?>plugins/bower_components/typeahead.js-master/dist/typehead-min.css" rel="stylesheet">
<link href="<?php echo BASEPATH; ?>plugins/bower_components/multiselect/css/multi-select.css"  rel="stylesheet" type="text/css" />


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
      
      <!-- BODY -->
      <div class="row">

      <!-- -->
        <div class="col-md-12 col-lg-12 col-sm-12 white-box">
         
            <h3>
              <i class="fa fa-file"></i> Detalles de <?php echo $datosProductoServicio['nombreProductosServicios'] ; ?>
            </h3>

          
          <!--==============================================================
          =            TABLAS DE OPCIONES DE PERFIL DE PRODUCTO            =
          ===============================================================-->
          <section class="m-t-40">
                  <div class="sttabs tabs-style-flip">
                    <nav>
                      <ul>
                       
                        <li><a href="" class="sticon fa fa-arrows-h"><span>Panel Informativo</span></a></li>
                        <li><a href="" class="sticon fa fa-arrow-h"><span>Recepción y Traslados</span></a></li>
                        <li><a href="" class="sticon fa fa-certificate"><span>Garantías</span></a>
                        </li>
                      </ul>
                    </nav>
                    <div class="content-wrap">
                      <!-- MOVIMIENTOS -->
                      <section id="movimientosProducto">
                          <!-- INICIO INDICADORES BÁSICOS -->
                          <div class="row">
                              <!-- INDICADOR DE PORCENTAJES EN PROMEDIO DE EXSTENCIA POR PUNTO DE VENTA -->
                              <div class="col-md-6 col-lg-6 col-sm-12">
                                <div class="white-box bg-purple"  style="height: 170px">
                                    <h5 align="center" class="text text-white">Existencia Global</h5>
                                    <div align="center" >
                                      <h1 class="text text-white"  id="existenciaGlobal"></h1>
                                      <h4 class="text text-white"> En Existencia </h4>
                                      
                                    </div>
                                </div>
                              </div>

                              <!-- EXISTENCIA GLOBAL -->
                              <div class="col-md-6 col-lg-6 col-sm-12">
                                <div class="white-box bg-red "  style="height: 170px">
                                    <h4 align="center" class="text text-white">Existencia En Punto de Venta</h4>
                                    <div align="center">
                                      <h1 class="text text-white" ></h1>
                                     <h4 class="text text-white"> En Existencia</h4>
                                    </div>
                                </div>
                              </div>
                              <!-- INDICADOR DE VALOR DE INVENTARIO -->                              
                          </div>
                          <!-- FIN INDICADORES BASICOS -->
                          <!-- Lista de las compras para ese producto -->                          
                          <!-- MOVIMIENTOS Y GRÁFICAS -->
                          <div class="col-md-12">
                            <div class="col-md-6">
                              <h3> <i class="fa fa-shopping-cart"></i> Movimientos En Ventas</h3>
                              <div id="movimientoVentaProducto"></div>
                            </div>
                            <div class="col-md-6">
                              <h3> <i class="fa fa-bar-chart-o"></i>Gráficas Comparativas</h3>
                              <div id="graficaComportamientoVenta"></div>
                            </div>
                          </div>
                          <!-- FIN MOVIMIENTOS Y GRÁFICAS -->
                      </section>
                    <!-- FIN DE MOVIMIENTOS -->
                    <!-- MOVIMIENTOS DE COMPRAS -->
                    
                    <section id="movimientosCompras">
                      <div class="col-md-12">
                           <div id="listaComprasProducto"></div>
                      </div>
                      <div align="center">
                        Lista de todas las compras registradas que se han hecho de este producto a los provedores
                      </div>
                    </section>
                    <!-- FIN DE MOVIMIENTOS DE COMPRAS -->
                    

                      
                    <!-- Garantías -->
                    <section id="Garantías">
                         <div class="col-md-12">
                           <div class="col-md-6">
                             <h3><i class="fa fa-certificate"></i> Garantías</h3>
                           </div>
                           <div class="col-md-6"></div>
                         </div>
                         <div class="col-md12">
                          <div id="listaGarantias"></div>
                         </div>
                    </section>
                    <!-- Garantías -->


    
                      <!-- DATOS BASICOS -->
                      
                    </div><!-- /content -->
                  </div><!-- /tabs -->
                </section>
          
          
          <!--====  End of TABLAS DE OPCIONES DE PERFIL DE PRODUCTO  ====-->
          


            
          



        
        </div>


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
<script src="<?php echo BASEPATH; ?>js/validator.js"></script>
<script src="<?php echo BASEPATH ?>js/cbpFWTabs.js"></script>
<script type="text/javascript" src="<?php echo BASEPATH ?>plugins/bower_components/multiselect/js/jquery.multi-select.js"></script>

<script src="<?php echo PATH; ?>js/acciones/validaciones.js"></script>

<!-- Typehead Plugin JavaScript -->

<!-- TABLES -->
<script src="<?php echo BASEPATH; ?>plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
<!-- JS PLUGINGS-->
<script src="<?php echo PATH; ?>js/acciones/customPerfilProductos.js"></script>
<script src="<?php echo BASEPATH; ?>plugins/bower_components/switchery/dist/switchery.min.js"></script>


<script>


  $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());

        });
        $('#ventaCruzada').multiSelect();      

  (function() {

                [].slice.call( document.querySelectorAll( '.sttabs' ) ).forEach( function( el ) {
                    new CBPFWTabs( el );
                });

            })();
</script>
<!-- FIN PLUGIN JS-->
</body>
</html>



